<?php 
require_once('stripe-php-master/init.php');

defined('BASEPATH') OR exit('No direct script access allowed');
class CardController extends CI_Controller {
	 public function __construct(){
      parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->model('SettingModel');

		$this->load->model('SettingModel');
		$this->load->model('Preview_model');
		$this->load->model('RegisterModel');
		$this->load->model('Tutor_model');
        $this->load->model('Admin_model');
	}
	public function card_form_submit(){		

        
        if ($_POST['cardName'] == "derect_deposite" ) {
			redirect('direct-request');
		}

		if(!empty($_POST['stripeToken'])){

			$token  = $_POST['stripeToken'];
			$userID = $this->session->userdata('user_id');
			$courseUser = $userID;
			$check_student = $this->db->where('id',$userID)->get('tbl_useraccount')->row();
			if ($check_student->user_type == 6) {
			 	$parentDetails = $this->db->where('id',$check_student->parent_id)->get('tbl_useraccount')->row();
			 	//$userID = $parentDetails->id;
			 	$user_email = $parentDetails->user_email;
			}else{
			 	$user_email = $this->session->userdata('user_email');
			}

			$total_cost=$this->session->userdata('totalCost') * 100;
            $payment_process = $this->session->userdata('payment_process');
            
            
			
			// echo $payment_process;die();
			//set api key
			/*$this->db->select('*');
			$this->db->from('tbl_stripe_api_key');
			$this->db->where('type',0);
			$api_key=$this->db->get()->result_array();
			fi4*/
			$publish_key=$this->SettingModel->getStripeKey('publish');
		    $sereet_key=$this->SettingModel->getStripeKey('seccreet');
			/*$stripe = array(
			  "secret_key"      => "sk_test_XxfxLa9eNGyO4BMFo3EXcrGl",
			  "publishable_key" => "pk_test_8d5s2El2JNAMmyL1xc87EpcH"
			);*/
			$stripe = array(
			  "secret_key"      => $sereet_key,// $api_key[0]['sereet_key'],
			  "publishable_key" => $publish_key //$api_key[0]['publish_key']
			);

			\Stripe\Stripe::setApiKey($stripe['secret_key']);

			//add customer to stripe
			$checkCustomer = $this->db->where('user_id',$userID)->get('stripe_customer')->row();

			if (isset($checkCustomer)) {
				$customer = $checkCustomer;
				// echo "<pre>";print_r($customer->id);die();
			}else{
				$customer = \Stripe\Customer::create(array(
					'email' => $user_email,
					'source'  => $token
				));
				$this->db->insert('stripe_customer',['user_id' =>$userID,'id'=> $customer->id]);
				// echo "<pre>";print_r($customer);die();
			}
			// echo    $user_email;die();   
			// subscription here
			if ($payment_process == 1) {

				$product_variation=rand(100, 999);
				$product = \Stripe\Product::create([
					'name' => 'My SaaS Platform'.'_'. $product_variation,
					'type' => 'service',
				]);
				
				$paymentType = $this->session->userdata('paymentType');
				if($paymentType == 1){
		            $interval_count=1;
				}elseif($paymentType == 2){
		            $interval_count=6;
				}elseif($paymentType == 3){
		            $interval_count=12;
				}elseif($paymentType == 4){
		            $interval_count=3;
				}
				$plan = \Stripe\Plan::create([
					'currency' => 'usd',
					'interval' => 'month',
		            'interval_count' => $interval_count,
					'product' => $product->id,
					'nickname' => 'Pro Plan',
					'amount' => $total_cost,
				]);
				
				$subscription = \Stripe\Subscription::create([
					'customer' =>  $customer->id,
					'items' => [['plan' =>  $plan->id]],
					
				]);

			}

			//echo '<pre>';print_r($subscription);die();
			//item information
			$itemName = "Rs";
			$itemNumber = "1";
			$itemPrice = $total_cost;
			$currency = "usd";
			$orderID = "SKA92712382139";
			
			if ($payment_process == 2) {
			    
				//charge a credit or a debit card
				$charge = \Stripe\Charge::create(array(
					'customer' => $customer->id,
					'amount'   => $itemPrice,
					'currency' => $currency,
					'description' => $itemName,
					'metadata' => array(
					    'order_id' => $orderID,
					)
				));

				$chargeJson = $charge->jsonSerialize();
			}
			// $invoice=\Stripe\InvoiceItem::create([
			// 	'amount' => $total_cost,
			// 	'currency' => 'usd',
			// 	'customer' => $customer->id,
			// 	'description' => 'One-time setup fee',
			// ]);
			
			//retrieve charge details
			//check whether the charge is successful
			$rs_course = $this->session->userdata('courses');
			$register_courses = $this->db->select('course_id')->where('user_id',$userID)->where('cost <>',0)->where('endTime >',time())->group_by('course_id')->get('tbl_registered_course')->result_array();

			//echo "<pre>";print_r($register_courses);die();
			$registerCourse = [];
			foreach($register_courses as $key => $course){
				$registerCourse[$key] = $course['course_id'];
			}
		    
			$paymentType = $this->session->userdata('paymentType');
			if($paymentType == 1){
				$month_added=1;
			}elseif($paymentType == 2){
				$month_added=6;
			}elseif($paymentType == 3){
				$month_added=12;
			}elseif($paymentType == 4){
				$month_added=3;
			}
			$total_course = count($rs_course);
			$total_registered_course = count($registerCourse);
			$match =0;
			$course_matched = 0;
			
			if(!empty($rs_course)){
				foreach($rs_course as $singleCourse){
					if(in_array($singleCourse,$registerCourse)){
						$match++;
					}
				}
			}
			// echo "<pre>";print_r($registerCourse);
			// echo $match.'//'.$total_course;die();
			
			if($total_course>$total_registered_course){
				if($total_registered_course==0){
					$course_matched=0;
				}elseif($match==$total_course){
					$course_matched=1;
				}
			}else{
				if($total_registered_course==0){
					$course_matched=0;
				}elseif($match==$total_registered_course){
					$course_matched=1;
				}
			}
		    //  echo $course_matched;die();


			if($subscription->object == "subscription" && $subscription->status == "active"){
				
				// order details 
				// $amount = $chargeJson['amount'];
				// $balance_transaction = $chargeJson['balance_transaction'];
				// $currency = $chargeJson['currency'];
				// $status = $chargeJson['status'];
				// $date = date("Y-m-d H:i:s");
				
				//include database config file
				//include_once 'dbConfig.php';
				$data['user_id']=$userID;
				$data['PaymentDate'] = time();
				$paymentType = $this->session->userdata('paymentType');
				if($paymentType == 1){
					//$second = 24 * 3600;
					$second = 30 * 24 * 3600;
				}elseif($paymentType == 2){
					$second = 30 * 6 * 24 * 3600;
				}elseif($paymentType == 3){
					$second = 30 * 12 * 24 * 3600;
				}elseif($paymentType == 4){
					$second = 30 * 3 * 24 * 3600;
				}

				$data['PaymentEndDate']   = $data['PaymentDate'] + $second;
				$data['total_cost']		  = ($subscription->plan->amount)/100;
				$data['payment_duration'] = $paymentType;
				$data['payment_status']   = $subscription->status;
				$data['SenderEmail'] 	  = $user_email;
				$data['customerId']       = $subscription->customer;
				$data['subscriptionId']   = $subscription->id;
				$data['paymentType'] 	  = 1;
				$data['invoiceId']        = $subscription->latest_invoice;
				
				// $userID = $this->session->userdata('userType');
				// echo '<pre>';echo $userID;die();
				$this->db->insert('tbl_payment', $data);
			 	$paymentId = $this->db->insert_id();
				$rs_course = $this->session->userdata('courses');
                $today_timestamp = time();
				// echo '<pre>';print_r($rs_course);die();
				foreach($rs_course as $singleCourse)
				{
					$pay['paymentId']=$paymentId;
					$pay['courseId']=$singleCourse;
					$this->db->insert('tbl_payment_details', $pay);
				}


                // $this->db->where('user_id',$courseUser)->delete('tbl_registered_course');
                $this->db->where('user_id',$courseUser)->where('endTime <',$today_timestamp)->update('tbl_registered_course',['status'=>0]);

                foreach ($rs_course as $singleCourse) {
                    $course['course_id']=$singleCourse;
                    $rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
                    $course['cost']    = $rs_course_cost[0]['courseCost'];
                    $course['user_id'] = $courseUser;
                    $course['created'] = time();
                    $course['endTime'] = $data['PaymentEndDate'];
                    $this->RegisterModel->basicInsert('tbl_registered_course', $course);
                }

				if ($data['payment_status'] == 'active') {
					$x = "Completed";
				}
				$user_data['payment_status'] = $x;
				$user_data['subscription_type'] = 'signup';
				$sub_end_date = date('Y-m-d',$data['PaymentEndDate']);
				
                if($check_student->end_subscription != null){
                    $end_subscription = $check_student->end_subscription;
                    if($course_matched==1){
						$toAddDay = $month_added*30;
				        $new_date = date('Y-m-d', strtotime($check_student->end_subscription. ' + '.$toAddDay.' days'));
						$user_data['end_subscription']  =$new_date;
					}else{
						$user_data['end_subscription']  = $sub_end_date;
					}

                    // if($sub_end_date > $end_subscription){
                    //     $user_data['end_subscription']  = $sub_end_date;
                    // }else{
                    //     $user_data['end_subscription']  = $end_subscription;
                    // }
                }else{
                    $user_data['end_subscription']  = $sub_end_date;
                }
	           
	            // $this->db->set('payment_status', $data['payment_status']);
	            $this->db->where('id', $data['user_id']);
	            $this->db->update('tbl_useraccount',$user_data);

	            if ($check_student->user_type == 6) {
	            	$parent_id = $check_student->parent_id;
	            	$this->db->where('id', $parent_id);
	            	$this->db->update('tbl_useraccount',$user_data);
	            	$this->session->set_userdata('userType',6);
	            	//redirect('/student');
	            }

	            $refUsers = $this->db->where('user_id',$userID)->where('status',0)->get('tbl_referral_users')->row();
            
	            if (!empty($refUsers)) {

	                $reffInUser     = $refUsers->user_id;
	                $refferByUser   = $refUsers->refferalUser;

	                $point = $this->db->where('id',1)->get('tbl_admin_points')->row();
	                $referralPoint   = $point->referral_point;
	                $ref_taken_point = $point->ref_taken_point;


	                $checkreffUsers = $this->db->where('user_id',$reffInUser)->get('product_poinits')->row();


	                if (!empty($checkreffUsers)) {
	                 $totalPoint = $checkreffUsers->total_point;
	                 $old_referral_point = $checkreffUsers->referral_point;
	                 $ckrfuser['referral_point'] = $old_referral_point + $referralPoint;
	                 $ckrfuser['total_point']    = $referralPoint + $totalPoint;
	                 $this->db->where('user_id',$reffInUser)->update('product_poinits',$ckrfuser);
	                }else{
	                 $ckrfuser['user_id'] = $reffInUser;
	                 $ckrfuser['referral_point'] = $referralPoint;
	                 $ckrfuser['total_point']    = $referralPoint;
	                 $this->db->insert('product_poinits',$ckrfuser);
	                }


	                $checkrefferByUser = $this->db->where('user_id',$refferByUser)->get('product_poinits')->row();

	                if (!empty($checkrefferByUser)) {
	                 $totalByPoint = $checkrefferByUser->total_point;
	                 $old_referral_point = $checkrefferByUser->referral_point;
	                 $ckrfByuser['referral_point'] = $old_referral_point + $referralPoint;
	                 $ckrfByuser['total_point']    = $ref_taken_point + $totalByPoint;
	                 $this->db->where('user_id',$refferByUser)->update('product_poinits',$ckrfByuser);
	                }else{
	                 $ckrfByuser['user_id'] = $refferByUser;
	                 $ckrfByuser['referral_point'] = $ref_taken_point;
	                 $ckrfByuser['total_point']    = $ref_taken_point;
	                 $this->db->insert('product_poinits',$ckrfByuser);
	                }

	                $this->db->where('user_id',$userID)->update('tbl_referral_users',['status' => 1]);
	               
	            }

	            
				// echo '<pre>';print_r($chargeJson);
				//insert tansaction data into the database			
				//if order inserted successfully
				// if($last_insert_id && $status == 'succeeded'){
				// 	$statusMsg = "<h2>The transaction was successful.</h2><h4>Order ID: {$last_insert_id}</h4>";
				// }else{
				// 	$statusMsg = "Transaction has been failed";
				// }
				redirect('/');

			}elseif($chargeJson['object'] == "charge" && $chargeJson['status'] == "succeeded"){
				// order details 
				// $amount = $chargeJson['amount'];
				// $balance_transaction = $chargeJson['balance_transaction'];
				// $currency = $chargeJson['currency'];
				// $status = $chargeJson['status'];
				// $date = date("Y-m-d H:i:s");
				
				//include database config file
				//include_once 'dbConfig.php';
				$data['user_id']=$userID;
				$data['PaymentDate'] = time();
				$paymentType = $this->session->userdata('paymentType');
				if($paymentType == 1){
					//$second = 24 * 3600;
					$second = 30 * 24 * 3600;
				}elseif($paymentType == 2){
					$second = 30 * 6 * 24 * 3600;
				}elseif($paymentType == 3){
					$second = 30 * 12 * 24 * 3600;
				}elseif($paymentType == 4){
					$second = 30 * 3 * 24 * 3600;
				}

				$data['PaymentEndDate']   = $data['PaymentDate'] + $second;
				$data['total_cost']		  = ($chargeJson['amount'])/100;
				$data['payment_duration'] = $paymentType;
				$data['payment_status']   = $chargeJson['status'];
				$data['SenderEmail'] 	  = $user_email;
				$data['customerId']       = $chargeJson{'customer'};
				$data['subscriptionId']   = 'No debit';
				$data['paymentType'] 	  = 1;
				$data['invoiceId']        = $chargeJson['balance_transaction'];
				
				// $userID = $this->session->userdata('userType');
				//echo '<pre>';print_r($data);die();
				$this->db->insert('tbl_payment', $data);
			 	$paymentId = $this->db->insert_id();
                $today_timestamp = time();
				$rs_course = $this->session->userdata('courses');
				// echo '<pre>';print_r($rs_course);die();
				foreach($rs_course as $singleCourse)
				{
					$pay['paymentId']=$paymentId;
					$pay['courseId']=$singleCourse;
					$this->db->insert('tbl_payment_details', $pay);
				}
				
                // $this->db->where('user_id',$courseUser)->delete('tbl_registered_course');
                $this->db->where('user_id',$courseUser)->where('endTime <',$today_timestamp)->update('tbl_registered_course',['status'=>0]);

                foreach ($rs_course as $singleCourse) {
                    $course['course_id']=$singleCourse;
                    $rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
                    $course['cost']    = $rs_course_cost[0]['courseCost'];
                    $course['user_id'] = $courseUser;
                    $course['created'] = time();
                    $course['endTime'] = $data['PaymentEndDate'];
                    $this->RegisterModel->basicInsert('tbl_registered_course', $course);
                }

                
				if ($data['payment_status'] == 'succeeded') {
					$x = "Completed";
				}
				$user_data['payment_status'] = $x;
				$user_data['subscription_type'] = 'signup';
				$sub_end_date = date('Y-m-d',$data['PaymentEndDate']);
				
				
				
				// $data['register_course'] = $registerCourse;
				// $date1=date_create(date("Y-m-d"));
				// $date2=date_create($check_student->end_subscription);
				// $diff=date_diff($date1,$date2);
				// $toAddDay = $diff->format("%a");
				
				
				// echo $sub_end_date.'///2/'.$check_student->end_subscription;die();
                if($check_student->end_subscription != null){
                    $end_subscription = $check_student->end_subscription;
					if($course_matched==1){
						$toAddDay = $month_added*30;
				        $new_date = date('Y-m-d', strtotime($check_student->end_subscription. ' + '.$toAddDay.' days'));
						$user_data['end_subscription']  =$new_date;
					}else{
						$user_data['end_subscription']  = $sub_end_date;
					}
                    // if($sub_end_date > $end_subscription){
                    //     $user_data['end_subscription']  = $sub_end_date;
                    // }else{
                    //     $user_data['end_subscription']  = $end_subscription;
                    // }
                }else{
                    $user_data['end_subscription']  = $sub_end_date;
                }
	           
	            // $this->db->set('payment_status', $data['payment_status']);
	            $this->db->where('id', $userID);
	            $this->db->update('tbl_useraccount',$user_data);

	            if ($check_student->user_type == 6) {
	            	$parent_id = $check_student->parent_id;
	            	$this->db->where('id', $parent_id);
	            	$this->db->update('tbl_useraccount',$user_data);
	            	$this->session->set_userdata('userType',6);
	            	//redirect('/student');
	            }


	            $refUsers = $this->db->where('user_id',$userID)->where('status',0)->get('tbl_referral_users')->row();
            
	            if (!empty($refUsers)) {

	                $reffInUser     = $refUsers->user_id;
	                $refferByUser   = $refUsers->refferalUser;

	                $point = $this->db->where('id',1)->get('tbl_admin_points')->row();
	                $referralPoint   = $point->referral_point;
	                $ref_taken_point = $point->ref_taken_point;


	                $checkreffUsers = $this->db->where('user_id',$reffInUser)->get('product_poinits')->row();


	                if (!empty($checkreffUsers)) {
	                 $totalPoint = $checkreffUsers->total_point;
	                 $old_referral_point = $checkreffUsers->referral_point;
	                 $ckrfuser['referral_point'] = $old_referral_point + $referralPoint;
	                 $ckrfuser['total_point']    = $referralPoint + $totalPoint;
	                 $this->db->where('user_id',$reffInUser)->update('product_poinits',$ckrfuser);
	                }else{
	                 $ckrfuser['user_id'] = $reffInUser;
	                 $ckrfuser['referral_point'] = $referralPoint;
	                 $ckrfuser['total_point']    = $referralPoint;
	                 $this->db->insert('product_poinits',$ckrfuser);
	                }


	                $checkrefferByUser = $this->db->where('user_id',$refferByUser)->get('product_poinits')->row();

	                if (!empty($checkrefferByUser)) {
	                 $totalByPoint = $checkrefferByUser->total_point;
	                 $old_referral_point = $checkrefferByUser->referral_point;
	                 $ckrfByuser['referral_point'] = $old_referral_point + $referralPoint;
	                 $ckrfByuser['total_point']    = $ref_taken_point + $totalByPoint;
	                 $this->db->where('user_id',$refferByUser)->update('product_poinits',$ckrfByuser);
	                }else{
	                 $ckrfByuser['user_id'] = $refferByUser;
	                 $ckrfByuser['referral_point'] = $ref_taken_point;
	                 $ckrfByuser['total_point']    = $ref_taken_point;
	                 $this->db->insert('product_poinits',$ckrfByuser);
	                }

	                $this->db->where('user_id',$userID)->update('tbl_referral_users',['status' => 1]);
	               
	            }

	            
				redirect('/');
			}else{
				echo 'php error';die();
				$statusMsg = "Transaction has been failed";
			}
		}else{
			echo 'Form error';die();
			$statusMsg = "Form submission error.......";
		}

		//show success or error message
		//echo $statusMsg;
	}

	public function signup_card_form_submit(){		

        if ($_POST['cardName'] == "derect_deposite" ) {
			redirect('direct-request');
		}

		if(!empty($_POST['stripeToken'])){

			$parent_id =$this->session->userdata('user_id');
			$email =$this->session->userdata('user_email');
			$check_student = $this->db->where('parent_id',$parent_id)->get('tbl_useraccount')->row();
			$userID = $check_student->id;
		


			$token  = $_POST['stripeToken'];
			// $userID = $this->session->userdata('user_id');
			$courseUser = $userID;
			$check_student = $this->db->where('id',$userID)->get('tbl_useraccount')->row();
			if ($check_student->user_type == 6) {
			 	$parentDetails = $this->db->where('id',$check_student->parent_id)->get('tbl_useraccount')->row();
			 	//$userID = $parentDetails->id;
			 	$user_email = $parentDetails->user_email;
			}else{
			 	$user_email = $check_student->id;
			}

			$total_cost=$this->session->userdata('totalCost') * 100;
            $payment_process = $this->session->userdata('payment_process');
            
                    
			
			//echo $payment_process;die();
			//set api key
			/*$this->db->select('*');
			$this->db->from('tbl_stripe_api_key');
			$this->db->where('type',0);
			$api_key=$this->db->get()->result_array();
			fi4*/
			$publish_key=$this->SettingModel->getStripeKey('publish');
		    $sereet_key=$this->SettingModel->getStripeKey('seccreet');
			/*$stripe = array(
			  "secret_key"      => "sk_test_XxfxLa9eNGyO4BMFo3EXcrGl",
			  "publishable_key" => "pk_test_8d5s2El2JNAMmyL1xc87EpcH"
			);*/
			$stripe = array(
			  "secret_key"      => $sereet_key,// $api_key[0]['sereet_key'],
			  "publishable_key" => $publish_key //$api_key[0]['publish_key']
			);

			\Stripe\Stripe::setApiKey($stripe['secret_key']);

			//add customer to stripe
			$checkCustomer = $this->db->where('user_id',$userID)->get('stripe_customer')->row();

			if (isset($checkCustomer)) {
				$customer = $checkCustomer;
				// echo "<pre>";print_r($customer->id);die();
			}else{
				$customer = \Stripe\Customer::create(array(
					'email' => $user_email,
					'source'  => $token
				));
				$this->db->insert('stripe_customer',['user_id' =>$userID,'id'=> $customer->id]);
				// echo "<pre>";print_r($customer);die();
			}

			// subscription here
			if ($payment_process == 1) {

				$product_variation=rand(100, 999);
				$product = \Stripe\Product::create([
					'name' => 'My SaaS Platform'.'_'. $product_variation,
					'type' => 'service',
				]);
				
				$paymentType = $this->session->userdata('paymentType');
				if($paymentType == 1){
		            $interval_count=1;
				}elseif($paymentType == 2){
		            $interval_count=6;
				}elseif($paymentType == 3){
		            $interval_count=12;
				}elseif($paymentType == 4){
		            $interval_count=3;
				}
				$plan = \Stripe\Plan::create([
					'currency' => 'usd',
					'interval' => 'month',
		            'interval_count' => $interval_count,
					'product' => $product->id,
					'nickname' => 'Pro Plan',
					'amount' => $total_cost,
				]);
				
				$subscription = \Stripe\Subscription::create([
					'customer' =>  $customer->id,
					'items' => [['plan' =>  $plan->id]],
					
				]);

			}

			//echo '<pre>';print_r($subscription);die();
			//item information
			$itemName = "Rs";
			$itemNumber = "1";
			$itemPrice = $total_cost;
			$currency = "usd";
			$orderID = "SKA92712382139";
			
			if ($payment_process == 2) {
			    
				//charge a credit or a debit card
				$charge = \Stripe\Charge::create(array(
					'customer' => $customer->id,
					'amount'   => $itemPrice,
					'currency' => $currency,
					'description' => $itemName,
					'metadata' => array(
					    'order_id' => $orderID,
					)
				));

				$chargeJson = $charge->jsonSerialize();
			}
			// $invoice=\Stripe\InvoiceItem::create([
			// 	'amount' => $total_cost,
			// 	'currency' => 'usd',
			// 	'customer' => $customer->id,
			// 	'description' => 'One-time setup fee',
			// ]);
			
			//retrieve charge details
			//check whether the charge is successful
			if($subscription->object == "subscription" && $subscription->status == "active"){
				
				// order details 
				// $amount = $chargeJson['amount'];
				// $balance_transaction = $chargeJson['balance_transaction'];
				// $currency = $chargeJson['currency'];
				// $status = $chargeJson['status'];
				// $date = date("Y-m-d H:i:s");
				
				//include database config file
				//include_once 'dbConfig.php';
				$data['user_id']=$userID;
				$data['PaymentDate'] = time();
				$paymentType = $this->session->userdata('paymentType');
				if($paymentType == 1){
					//$second = 24 * 3600;
					$second = 30 * 24 * 3600;
				}elseif($paymentType == 2){
					$second = 30 * 6 * 24 * 3600;
				}elseif($paymentType == 3){
					$second = 30 * 12 * 24 * 3600;
				}elseif($paymentType == 4){
					$second = 30 * 3 * 24 * 3600;
				}

				$data['PaymentEndDate']   = $data['PaymentDate'] + $second;
				$data['total_cost']		  = ($subscription->plan->amount)/100;
				$data['payment_duration'] = $paymentType;
				$data['payment_status']   = $subscription->status;
				$data['SenderEmail'] 	  = $user_email;
				$data['customerId']       = $subscription->customer;
				$data['subscriptionId']   = $subscription->id;
				$data['paymentType'] 	  = 1;
				$data['invoiceId']        = $subscription->latest_invoice;
				
				// $userID = $this->session->userdata('userType');
				// echo '<pre>';echo $userID;die();
				$this->db->insert('tbl_payment', $data);
			 	$paymentId = $this->db->insert_id();
				$rs_course = $this->session->userdata('courses');
                $today_timestamp = time();
				// echo '<pre>';print_r($rs_course);die();
				foreach($rs_course as $singleCourse)
				{
					$pay['paymentId']=$paymentId;
					$pay['courseId']=$singleCourse;
					$this->db->insert('tbl_payment_details', $pay);
				}


                // $this->db->where('user_id',$courseUser)->delete('tbl_registered_course');
                $this->db->where('user_id',$courseUser)->where('endTime <',$today_timestamp)->update('tbl_registered_course',['status'=>0]);

                foreach ($rs_course as $singleCourse) {
                    $course['course_id']=$singleCourse;
                    $rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
                    $course['cost']    = $rs_course_cost[0]['courseCost'];
                    $course['user_id'] = $courseUser;
                    $course['created'] = time();
                    $course['endTime'] = $data['PaymentEndDate'];
                    $this->RegisterModel->basicInsert('tbl_registered_course', $course);
                }

				if ($data['payment_status'] == 'active') {
					$x = "Completed";
				}
				$user_data['payment_status'] = $x;
				$user_data['subscription_type'] = 'signup';
				$sub_end_date = date('Y-m-d',$data['PaymentEndDate']);
				
                if($check_student->end_subscription != null){
                    $end_subscription = $check_student->end_subscription;
                    if($sub_end_date > $end_subscription){
                        $user_data['end_subscription']  = $sub_end_date;
                    }else{
                        $user_data['end_subscription']  = $end_subscription;
                    }
                }else{
                    $user_data['end_subscription']  = $sub_end_date;
                }
	           
	            // $this->db->set('payment_status', $data['payment_status']);
	            $this->db->where('id', $data['user_id']);
	            $this->db->update('tbl_useraccount',$user_data);

	            if ($check_student->user_type == 6) {
	            	$parent_id = $check_student->parent_id;
	            	$this->db->where('id', $parent_id);
	            	$this->db->update('tbl_useraccount',$user_data);
	            	$this->session->set_userdata('userType',6);
	            	//redirect('/student');
	            }

	            $refUsers = $this->db->where('user_id',$userID)->where('status',0)->get('tbl_referral_users')->row();
            
	            if (!empty($refUsers)) {

	                $reffInUser     = $refUsers->user_id;
	                $refferByUser   = $refUsers->refferalUser;

	                $point = $this->db->where('id',1)->get('tbl_admin_points')->row();
	                $referralPoint   = $point->referral_point;
	                $ref_taken_point = $point->ref_taken_point;


	                $checkreffUsers = $this->db->where('user_id',$reffInUser)->get('product_poinits')->row();


	                if (!empty($checkreffUsers)) {
	                 $totalPoint = $checkreffUsers->total_point;
	                 $old_referral_point = $checkreffUsers->referral_point;
	                 $ckrfuser['referral_point'] = $old_referral_point + $referralPoint;
	                 $ckrfuser['total_point']    = $referralPoint + $totalPoint;
	                 $this->db->where('user_id',$reffInUser)->update('product_poinits',$ckrfuser);
	                }else{
	                 $ckrfuser['user_id'] = $reffInUser;
	                 $ckrfuser['referral_point'] = $referralPoint;
	                 $ckrfuser['total_point']    = $referralPoint;
	                 $this->db->insert('product_poinits',$ckrfuser);
	                }


	                $checkrefferByUser = $this->db->where('user_id',$refferByUser)->get('product_poinits')->row();

	                if (!empty($checkrefferByUser)) {
	                 $totalByPoint = $checkrefferByUser->total_point;
	                 $old_referral_point = $checkrefferByUser->referral_point;
	                 $ckrfByuser['referral_point'] = $old_referral_point + $referralPoint;
	                 $ckrfByuser['total_point']    = $ref_taken_point + $totalByPoint;
	                 $this->db->where('user_id',$refferByUser)->update('product_poinits',$ckrfByuser);
	                }else{
	                 $ckrfByuser['user_id'] = $refferByUser;
	                 $ckrfByuser['referral_point'] = $ref_taken_point;
	                 $ckrfByuser['total_point']    = $ref_taken_point;
	                 $this->db->insert('product_poinits',$ckrfByuser);
	                }

	                $this->db->where('user_id',$userID)->update('tbl_referral_users',['status' => 1]);
	               
	            }

	            
				// echo '<pre>';print_r($chargeJson);
				//insert tansaction data into the database			
				//if order inserted successfully
				// if($last_insert_id && $status == 'succeeded'){
				// 	$statusMsg = "<h2>The transaction was successful.</h2><h4>Order ID: {$last_insert_id}</h4>";
				// }else{
				// 	$statusMsg = "Transaction has been failed";
				// }
				//redirect('/');
				redirect('/parents');

			}elseif($chargeJson['object'] == "charge" && $chargeJson['status'] == "succeeded"){
				// order details 
				// $amount = $chargeJson['amount'];
				// $balance_transaction = $chargeJson['balance_transaction'];
				// $currency = $chargeJson['currency'];
				// $status = $chargeJson['status'];
				// $date = date("Y-m-d H:i:s");
				
				//include database config file
				//include_once 'dbConfig.php';
				$data['user_id']=$userID;
				$data['PaymentDate'] = time();
				$paymentType = $this->session->userdata('paymentType');
				if($paymentType == 1){
					//$second = 24 * 3600;
					$second = 30 * 24 * 3600;
				}elseif($paymentType == 2){
					$second = 30 * 6 * 24 * 3600;
				}elseif($paymentType == 3){
					$second = 30 * 12 * 24 * 3600;
				}elseif($paymentType == 4){
					$second = 30 * 3 * 24 * 3600;
				}

				$data['PaymentEndDate']   = $data['PaymentDate'] + $second;
				$data['total_cost']		  = ($chargeJson['amount'])/100;
				$data['payment_duration'] = $paymentType;
				$data['payment_status']   = $chargeJson['status'];
				$data['SenderEmail'] 	  = $user_email;
				$data['customerId']       = $chargeJson{'customer'};
				$data['subscriptionId']   = 'No debit';
				$data['paymentType'] 	  = 1;
				$data['invoiceId']        = $chargeJson['balance_transaction'];
				
				// $userID = $this->session->userdata('userType');
				//echo '<pre>';print_r($data);die();
				$this->db->insert('tbl_payment', $data);
			 	$paymentId = $this->db->insert_id();
                $today_timestamp = time();
				$rs_course = $this->session->userdata('courses');
				// echo '<pre>';print_r($rs_course);die();
				foreach($rs_course as $singleCourse)
				{
					$pay['paymentId']=$paymentId;
					$pay['courseId']=$singleCourse;
					$this->db->insert('tbl_payment_details', $pay);
				}
				
                // $this->db->where('user_id',$courseUser)->delete('tbl_registered_course');
                $this->db->where('user_id',$courseUser)->where('endTime <',$today_timestamp)->update('tbl_registered_course',['status'=>0]);

                foreach ($rs_course as $singleCourse) {
                    $course['course_id']=$singleCourse;
                    $rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
                    $course['cost']    = $rs_course_cost[0]['courseCost'];
                    $course['user_id'] = $courseUser;
                    $course['created'] = time();
                    $course['endTime'] = $data['PaymentEndDate'];
                    $this->RegisterModel->basicInsert('tbl_registered_course', $course);
                }

                
				if ($data['payment_status'] == 'succeeded') {
					$x = "Completed";
				}
				$user_data['payment_status'] = $x;
				$user_data['subscription_type'] = 'signup';
				$sub_end_date = date('Y-m-d',$data['PaymentEndDate']);
				
                if($check_student->end_subscription != null){
                    $end_subscription = $check_student->end_subscription;
                    if($sub_end_date > $end_subscription){
                        $user_data['end_subscription']  = $sub_end_date;
                    }else{
                        $user_data['end_subscription']  = $end_subscription;
                    }
                }else{
                    $user_data['end_subscription']  = $sub_end_date;
                }
	           
	            // $this->db->set('payment_status', $data['payment_status']);
	            $this->db->where('id', $userID);
	            $this->db->update('tbl_useraccount',$user_data);

	            if ($check_student->user_type == 6) {
	            	$parent_id = $check_student->parent_id;
	            	$this->db->where('id', $parent_id);
	            	$this->db->update('tbl_useraccount',$user_data);
	            	$this->session->set_userdata('userType',6);
	            	//redirect('/student');
	            }


	            $refUsers = $this->db->where('user_id',$userID)->where('status',0)->get('tbl_referral_users')->row();
            
	            if (!empty($refUsers)) {

	                $reffInUser     = $refUsers->user_id;
	                $refferByUser   = $refUsers->refferalUser;

	                $point = $this->db->where('id',1)->get('tbl_admin_points')->row();
	                $referralPoint   = $point->referral_point;
	                $ref_taken_point = $point->ref_taken_point;


	                $checkreffUsers = $this->db->where('user_id',$reffInUser)->get('product_poinits')->row();


	                if (!empty($checkreffUsers)) {
	                 $totalPoint = $checkreffUsers->total_point;
	                 $old_referral_point = $checkreffUsers->referral_point;
	                 $ckrfuser['referral_point'] = $old_referral_point + $referralPoint;
	                 $ckrfuser['total_point']    = $referralPoint + $totalPoint;
	                 $this->db->where('user_id',$reffInUser)->update('product_poinits',$ckrfuser);
	                }else{
	                 $ckrfuser['user_id'] = $reffInUser;
	                 $ckrfuser['referral_point'] = $referralPoint;
	                 $ckrfuser['total_point']    = $referralPoint;
	                 $this->db->insert('product_poinits',$ckrfuser);
	                }


	                $checkrefferByUser = $this->db->where('user_id',$refferByUser)->get('product_poinits')->row();

	                if (!empty($checkrefferByUser)) {
	                 $totalByPoint = $checkrefferByUser->total_point;
	                 $old_referral_point = $checkrefferByUser->referral_point;
	                 $ckrfByuser['referral_point'] = $old_referral_point + $referralPoint;
	                 $ckrfByuser['total_point']    = $ref_taken_point + $totalByPoint;
	                 $this->db->where('user_id',$refferByUser)->update('product_poinits',$ckrfByuser);
	                }else{
	                 $ckrfByuser['user_id'] = $refferByUser;
	                 $ckrfByuser['referral_point'] = $ref_taken_point;
	                 $ckrfByuser['total_point']    = $ref_taken_point;
	                 $this->db->insert('product_poinits',$ckrfByuser);
	                }

	                $this->db->where('user_id',$userID)->update('tbl_referral_users',['status' => 1]);
	               
	            }

	            redirect('/parents');
				// redirect('/');     aaaaaaaaaaaaaaaaaaaa
			}else{
				echo 'php error';die();
				$statusMsg = "Transaction has been failed";
			}
		}else{
			echo 'Form error';die();
			$statusMsg = "Form submission error.......";
		}

		//show success or error message
		//echo $statusMsg;
	}

	public function signup_upper_card_form_submit(){		

        if ($_POST['cardName'] == "derect_deposite" ) {
			redirect('direct-request');
		}

		if(!empty($_POST['stripeToken'])){

		
			$user_id =$this->session->userdata('user_id');
			$email =$this->session->userdata('user_email');
			$check_student = $this->db->where('id',$user_id)->get('tbl_useraccount')->row();
			$userID = $check_student->id;
		


			$token  = $_POST['stripeToken'];
			// $userID = $this->session->userdata('user_id');
			$courseUser = $userID;
			$check_student = $this->db->where('id',$userID)->get('tbl_useraccount')->row();
			if ($check_student->user_type == 6) {
			 	$parentDetails = $this->db->where('id',$check_student->parent_id)->get('tbl_useraccount')->row();
			 	//$userID = $parentDetails->id;
			 	$user_email = $parentDetails->user_email;
			}else{
			 	$user_email = $email;
			}

			$total_cost=$this->session->userdata('totalCost') * 100;
            $payment_process = $this->session->userdata('payment_process');
            
                    
			
			//echo $payment_process;die();
			//set api key
			/*$this->db->select('*');
			$this->db->from('tbl_stripe_api_key');
			$this->db->where('type',0);
			$api_key=$this->db->get()->result_array();
			fi4*/
			$publish_key=$this->SettingModel->getStripeKey('publish');
		    $sereet_key=$this->SettingModel->getStripeKey('seccreet');
			/*$stripe = array(
			  "secret_key"      => "sk_test_XxfxLa9eNGyO4BMFo3EXcrGl",
			  "publishable_key" => "pk_test_8d5s2El2JNAMmyL1xc87EpcH"
			);*/
			$stripe = array(
			  "secret_key"      => $sereet_key,// $api_key[0]['sereet_key'],
			  "publishable_key" => $publish_key //$api_key[0]['publish_key']
			);

			\Stripe\Stripe::setApiKey($stripe['secret_key']);

			//add customer to stripe
			$checkCustomer = $this->db->where('user_id',$userID)->get('stripe_customer')->row();

			if (isset($checkCustomer)) {
				$customer = $checkCustomer;
				// echo "<pre>";print_r($customer->id);die();
			}else{
				$customer = \Stripe\Customer::create(array(
					'email' => $user_email,
					'source'  => $token
				));
				$this->db->insert('stripe_customer',['user_id' =>$userID,'id'=> $customer->id]);
				// echo "<pre>";print_r($customer);die();
			}

			// subscription here
			if ($payment_process == 1) {

				$product_variation=rand(100, 999);
				$product = \Stripe\Product::create([
					'name' => 'My SaaS Platform'.'_'. $product_variation,
					'type' => 'service',
				]);
				
				$paymentType = $this->session->userdata('paymentType');
				if($paymentType == 1){
		            $interval_count=1;
				}elseif($paymentType == 2){
		            $interval_count=6;
				}elseif($paymentType == 3){
		            $interval_count=12;
				}elseif($paymentType == 4){
		            $interval_count=3;
				}
				$plan = \Stripe\Plan::create([
					'currency' => 'usd',
					'interval' => 'month',
		            'interval_count' => $interval_count,
					'product' => $product->id,
					'nickname' => 'Pro Plan',
					'amount' => $total_cost,
				]);
				
				$subscription = \Stripe\Subscription::create([
					'customer' =>  $customer->id,
					'items' => [['plan' =>  $plan->id]],
					
				]);

			}

			//echo '<pre>';print_r($subscription);die();
			//item information
			$itemName = "Rs";
			$itemNumber = "1";
			$itemPrice = $total_cost;
			$currency = "usd";
			$orderID = "SKA92712382139";
			
			if ($payment_process == 2) {
			    
				//charge a credit or a debit card
				$charge = \Stripe\Charge::create(array(
					'customer' => $customer->id,
					'amount'   => $itemPrice,
					'currency' => $currency,
					'description' => $itemName,
					'metadata' => array(
					    'order_id' => $orderID,
					)
				));

				$chargeJson = $charge->jsonSerialize();
			}
			// $invoice=\Stripe\InvoiceItem::create([
			// 	'amount' => $total_cost,
			// 	'currency' => 'usd',
			// 	'customer' => $customer->id,
			// 	'description' => 'One-time setup fee',
			// ]);
			
			//retrieve charge details
			//check whether the charge is successful
			if($subscription->object == "subscription" && $subscription->status == "active"){
				
				// order details 
				// $amount = $chargeJson['amount'];
				// $balance_transaction = $chargeJson['balance_transaction'];
				// $currency = $chargeJson['currency'];
				// $status = $chargeJson['status'];
				// $date = date("Y-m-d H:i:s");
				
				//include database config file
				//include_once 'dbConfig.php';
				$data['user_id']=$userID;
				$data['PaymentDate'] = time();
				$paymentType = $this->session->userdata('paymentType');
				if($paymentType == 1){
					//$second = 24 * 3600;
					$second = 30 * 24 * 3600;
				}elseif($paymentType == 2){
					$second = 30 * 6 * 24 * 3600;
				}elseif($paymentType == 3){
					$second = 30 * 12 * 24 * 3600;
				}elseif($paymentType == 4){
					$second = 30 * 3 * 24 * 3600;
				}

				$data['PaymentEndDate']   = $data['PaymentDate'] + $second;
				$data['total_cost']		  = ($subscription->plan->amount)/100;
				$data['payment_duration'] = $paymentType;
				$data['payment_status']   = $subscription->status;
				$data['SenderEmail'] 	  = $user_email;
				$data['customerId']       = $subscription->customer;
				$data['subscriptionId']   = $subscription->id;
				$data['paymentType'] 	  = 1;
				$data['invoiceId']        = $subscription->latest_invoice;
				
				// $userID = $this->session->userdata('userType');
				// echo '<pre>';echo $userID;die();
				$this->db->insert('tbl_payment', $data);
			 	$paymentId = $this->db->insert_id();
				$rs_course = $this->session->userdata('courses');
                $today_timestamp = time();
				// echo '<pre>';print_r($rs_course);die();
				foreach($rs_course as $singleCourse)
				{
					$pay['paymentId']=$paymentId;
					$pay['courseId']=$singleCourse;
					$this->db->insert('tbl_payment_details', $pay);
				}


                // $this->db->where('user_id',$courseUser)->delete('tbl_registered_course');
                $this->db->where('user_id',$courseUser)->where('endTime <',$today_timestamp)->update('tbl_registered_course',['status'=>0]);

                foreach ($rs_course as $singleCourse) {
                    $course['course_id']=$singleCourse;
                    $rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
                    $course['cost']    = $rs_course_cost[0]['courseCost'];
                    $course['user_id'] = $courseUser;
                    $course['created'] = time();
                    $course['endTime'] = $data['PaymentEndDate'];
                    $this->RegisterModel->basicInsert('tbl_registered_course', $course);
                }

				if ($data['payment_status'] == 'active') {
					$x = "Completed";
				}
				$user_data['payment_status'] = $x;
				$user_data['subscription_type'] = 'signup';
				$sub_end_date = date('Y-m-d',$data['PaymentEndDate']);
				
                if($check_student->end_subscription != null){
                    $end_subscription = $check_student->end_subscription;
                    if($sub_end_date > $end_subscription){
                        $user_data['end_subscription']  = $sub_end_date;
                    }else{
                        $user_data['end_subscription']  = $end_subscription;
                    }
                }else{
                    $user_data['end_subscription']  = $sub_end_date;
                }
	           
	            // $this->db->set('payment_status', $data['payment_status']);
	            $this->db->where('id', $data['user_id']);
	            $this->db->update('tbl_useraccount',$user_data);

	            if ($check_student->user_type == 6) {
	            	$parent_id = $check_student->parent_id;
	            	$this->db->where('id', $parent_id);
	            	$this->db->update('tbl_useraccount',$user_data);
	            	$this->session->set_userdata('userType',6);
	            	//redirect('/student');
	            }

	            $refUsers = $this->db->where('user_id',$userID)->where('status',0)->get('tbl_referral_users')->row();
            
	            if (!empty($refUsers)) {

	                $reffInUser     = $refUsers->user_id;
	                $refferByUser   = $refUsers->refferalUser;

	                $point = $this->db->where('id',1)->get('tbl_admin_points')->row();
	                $referralPoint   = $point->referral_point;
	                $ref_taken_point = $point->ref_taken_point;


	                $checkreffUsers = $this->db->where('user_id',$reffInUser)->get('product_poinits')->row();


	                if (!empty($checkreffUsers)) {
	                 $totalPoint = $checkreffUsers->total_point;
	                 $old_referral_point = $checkreffUsers->referral_point;
	                 $ckrfuser['referral_point'] = $old_referral_point + $referralPoint;
	                 $ckrfuser['total_point']    = $referralPoint + $totalPoint;
	                 $this->db->where('user_id',$reffInUser)->update('product_poinits',$ckrfuser);
	                }else{
	                 $ckrfuser['user_id'] = $reffInUser;
	                 $ckrfuser['referral_point'] = $referralPoint;
	                 $ckrfuser['total_point']    = $referralPoint;
	                 $this->db->insert('product_poinits',$ckrfuser);
	                }


	                $checkrefferByUser = $this->db->where('user_id',$refferByUser)->get('product_poinits')->row();

	                if (!empty($checkrefferByUser)) {
	                 $totalByPoint = $checkrefferByUser->total_point;
	                 $old_referral_point = $checkrefferByUser->referral_point;
	                 $ckrfByuser['referral_point'] = $old_referral_point + $referralPoint;
	                 $ckrfByuser['total_point']    = $ref_taken_point + $totalByPoint;
	                 $this->db->where('user_id',$refferByUser)->update('product_poinits',$ckrfByuser);
	                }else{
	                 $ckrfByuser['user_id'] = $refferByUser;
	                 $ckrfByuser['referral_point'] = $ref_taken_point;
	                 $ckrfByuser['total_point']    = $ref_taken_point;
	                 $this->db->insert('product_poinits',$ckrfByuser);
	                }

	                $this->db->where('user_id',$userID)->update('tbl_referral_users',['status' => 1]);
	               
	            }

	            
				// echo '<pre>';print_r($chargeJson);
				//insert tansaction data into the database			
				//if order inserted successfully
				// if($last_insert_id && $status == 'succeeded'){
				// 	$statusMsg = "<h2>The transaction was successful.</h2><h4>Order ID: {$last_insert_id}</h4>";
				// }else{
				// 	$statusMsg = "Transaction has been failed";
				// }
				redirect('/');
				

			}elseif($chargeJson['object'] == "charge" && $chargeJson['status'] == "succeeded"){
				// order details 
				// $amount = $chargeJson['amount'];
				// $balance_transaction = $chargeJson['balance_transaction'];
				// $currency = $chargeJson['currency'];
				// $status = $chargeJson['status'];
				// $date = date("Y-m-d H:i:s");
				
				//include database config file
				//include_once 'dbConfig.php';
				$data['user_id']=$userID;
				$data['PaymentDate'] = time();
				$paymentType = $this->session->userdata('paymentType');
				if($paymentType == 1){
					//$second = 24 * 3600;
					$second = 30 * 24 * 3600;
				}elseif($paymentType == 2){
					$second = 30 * 6 * 24 * 3600;
				}elseif($paymentType == 3){
					$second = 30 * 12 * 24 * 3600;
				}elseif($paymentType == 4){
					$second = 30 * 3 * 24 * 3600;
				}

				$data['PaymentEndDate']   = $data['PaymentDate'] + $second;
				$data['total_cost']		  = ($chargeJson['amount'])/100;
				$data['payment_duration'] = $paymentType;
				$data['payment_status']   = $chargeJson['status'];
				$data['SenderEmail'] 	  = $user_email;
				$data['customerId']       = $chargeJson{'customer'};
				$data['subscriptionId']   = 'No debit';
				$data['paymentType'] 	  = 1;
				$data['invoiceId']        = $chargeJson['balance_transaction'];
				
				// $userID = $this->session->userdata('userType');
				//echo '<pre>';print_r($data);die();
				$this->db->insert('tbl_payment', $data);
			 	$paymentId = $this->db->insert_id();
                $today_timestamp = time();
				$rs_course = $this->session->userdata('courses');
				// echo '<pre>';print_r($rs_course);die();
				foreach($rs_course as $singleCourse)
				{
					$pay['paymentId']=$paymentId;
					$pay['courseId']=$singleCourse;
					$this->db->insert('tbl_payment_details', $pay);
				}
				
                // $this->db->where('user_id',$courseUser)->delete('tbl_registered_course');
                $this->db->where('user_id',$courseUser)->where('endTime <',$today_timestamp)->update('tbl_registered_course',['status'=>0]);

                foreach ($rs_course as $singleCourse) {
                    $course['course_id']=$singleCourse;
                    $rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
                    $course['cost']    = $rs_course_cost[0]['courseCost'];
                    $course['user_id'] = $courseUser;
                    $course['created'] = time();
                    $course['endTime'] = $data['PaymentEndDate'];
                    $this->RegisterModel->basicInsert('tbl_registered_course', $course);
                }

                
				if ($data['payment_status'] == 'succeeded') {
					$x = "Completed";
				}
				$user_data['payment_status'] = $x;
				$user_data['subscription_type'] = 'signup';
				$sub_end_date = date('Y-m-d',$data['PaymentEndDate']);
				
                if($check_student->end_subscription != null){
                    $end_subscription = $check_student->end_subscription;
                    if($sub_end_date > $end_subscription){
                        $user_data['end_subscription']  = $sub_end_date;
                    }else{
                        $user_data['end_subscription']  = $end_subscription;
                    }
                }else{
                    $user_data['end_subscription']  = $sub_end_date;
                }
	           
	            // $this->db->set('payment_status', $data['payment_status']);
	            $this->db->where('id', $userID);
	            $this->db->update('tbl_useraccount',$user_data);

	            if ($check_student->user_type == 6) {
	            	$parent_id = $check_student->parent_id;
	            	$this->db->where('id', $parent_id);
	            	$this->db->update('tbl_useraccount',$user_data);
	            	$this->session->set_userdata('userType',6);
	            	//redirect('/student');
	            }


	            $refUsers = $this->db->where('user_id',$userID)->where('status',0)->get('tbl_referral_users')->row();
            
	            if (!empty($refUsers)) {

	                $reffInUser     = $refUsers->user_id;
	                $refferByUser   = $refUsers->refferalUser;

	                $point = $this->db->where('id',1)->get('tbl_admin_points')->row();
	                $referralPoint   = $point->referral_point;
	                $ref_taken_point = $point->ref_taken_point;


	                $checkreffUsers = $this->db->where('user_id',$reffInUser)->get('product_poinits')->row();


	                if (!empty($checkreffUsers)) {
	                 $totalPoint = $checkreffUsers->total_point;
	                 $old_referral_point = $checkreffUsers->referral_point;
	                 $ckrfuser['referral_point'] = $old_referral_point + $referralPoint;
	                 $ckrfuser['total_point']    = $referralPoint + $totalPoint;
	                 $this->db->where('user_id',$reffInUser)->update('product_poinits',$ckrfuser);
	                }else{
	                 $ckrfuser['user_id'] = $reffInUser;
	                 $ckrfuser['referral_point'] = $referralPoint;
	                 $ckrfuser['total_point']    = $referralPoint;
	                 $this->db->insert('product_poinits',$ckrfuser);
	                }


	                $checkrefferByUser = $this->db->where('user_id',$refferByUser)->get('product_poinits')->row();

	                if (!empty($checkrefferByUser)) {
	                 $totalByPoint = $checkrefferByUser->total_point;
	                 $old_referral_point = $checkrefferByUser->referral_point;
	                 $ckrfByuser['referral_point'] = $old_referral_point + $referralPoint;
	                 $ckrfByuser['total_point']    = $ref_taken_point + $totalByPoint;
	                 $this->db->where('user_id',$refferByUser)->update('product_poinits',$ckrfByuser);
	                }else{
	                 $ckrfByuser['user_id'] = $refferByUser;
	                 $ckrfByuser['referral_point'] = $ref_taken_point;
	                 $ckrfByuser['total_point']    = $ref_taken_point;
	                 $this->db->insert('product_poinits',$ckrfByuser);
	                }

	                $this->db->where('user_id',$userID)->update('tbl_referral_users',['status' => 1]);
	               
	            }

	            //redirect('/parents');
				redirect('/');
			}else{
				echo 'php error';die();
				$statusMsg = "Transaction has been failed";
			}
		}else{
			echo 'Form error';die();
			$statusMsg = "Form submission error.......";
		}

		//show success or error message
		//echo $statusMsg;
	}

    public function card_form_submit_qus_store(){		
		// echo $user_email=$this->session->userdata('user_email');;		
		//echo '<pre>';print_r($_POST);die();

        if ($_POST['cardName'] == "derect_deposite" ) {
			redirect('direct-request');
		}

		if(!empty($_POST['stripeToken'])){

			$token  = $_POST['stripeToken'];
			$userID = $this->session->userdata('user_id');
			$check_student = $this->db->where('id',$userID)->get('tbl_useraccount')->row();
			if ($check_student->user_type == 6) {
			 	$parentDetails = $this->db->where('id',$check_student->parent_id)->get('tbl_useraccount')->row();
			 	$user_email = $parentDetails->user_email;
			}else{
			 	$user_email = $this->session->userdata('user_email');
			}

			$total_cost=$this->session->userdata('totalCost') * 100;
            $payment_process = $this->session->userdata('payment_process');
			
			$publish_key=$this->SettingModel->getStripeKey('publish');
		    $sereet_key=$this->SettingModel->getStripeKey('seccreet');
		    
			$stripe = array(
			  "secret_key"      => $sereet_key,// $api_key[0]['sereet_key'],
			  "publishable_key" => $publish_key //$api_key[0]['publish_key']
			);

			\Stripe\Stripe::setApiKey($stripe['secret_key']);

			//add customer to stripe
			$checkCustomer = $this->db->where('user_id',$userID)->get('stripe_customer')->row();

			if (isset($checkCustomer)) {
				$customer = $checkCustomer;
			}else{
				$customer = \Stripe\Customer::create(array(
					'email' => $user_email,
					'source'  => $token
				));
				$this->db->insert('stripe_customer',['user_id' =>$userID,'id'=> $customer->id]);
			}
			
			// subscription here
			if ($payment_process == 1) {

				$product_variation=rand(100, 999);
				$product = \Stripe\Product::create([
					'name' => 'My SaaS Platform'.'_'. $product_variation,
					'type' => 'service',
				]);
				
				$paymentType = $this->session->userdata('paymentType');
				if($paymentType == 1){
		            $interval_count=1;
				}elseif($paymentType == 2){
		            $interval_count=6;
				}elseif($paymentType == 3){
		            $interval_count=12;
				}elseif($paymentType == 4){
		            $interval_count=3;
				}
				$plan = \Stripe\Plan::create([
					'currency' => 'usd',
					'interval' => 'month',
		            'interval_count' => $interval_count,
					'product' => $product->id,
					'nickname' => 'Pro Plan',
					'amount' => $total_cost,
				]);
				
				$subscription = \Stripe\Subscription::create([
					'customer' =>  $customer->id,
					'items' => [['plan' =>  $plan->id]],
				]);

			}

		
			//item information
			$itemName = "Rs";
			$itemNumber = "1";
			$itemPrice = $total_cost;
			$currency = "usd";
			$orderID = "SKA92712382139";
			
			if ($payment_process == 2) {
				//charge a credit or a debit card
				$charge = \Stripe\Charge::create(array(
					'customer' => $customer->id,
					'amount'   => $itemPrice,
					'currency' => $currency,
					'description' => $itemName,
					'metadata' => array(
					    'order_id' => $orderID
					)
				));

				$chargeJson = $charge->jsonSerialize();
			}
			
			
			if($subscription->object == "subscription" && $subscription->status == "active"){
				
				$data['user_id']=$userID;
				$data['PaymentDate'] = time();
				$paymentType = $this->session->userdata('paymentType');
				if($paymentType == 1){
					//$second = 24 * 3600;
					$second = 30 * 24 * 3600;
				}elseif($paymentType == 2){
					$second = 30 * 6 * 24 * 3600;
				}elseif($paymentType == 3){
					$second = 30 * 12 * 24 * 3600;
				}elseif($paymentType == 4){
					$second = 30 * 3 * 24 * 3600;
				}

				$data['PaymentEndDate']   = $data['PaymentDate'] + $second;
				$data['total_cost']		  = ($subscription->plan->amount)/100;
				$data['payment_duration'] = $paymentType;
				$data['payment_status']   = ($subscription->status == 'active')?'Completed':$subscription->status;
				$data['SenderEmail'] 	  = $user_email;
				$data['customerId']       = $subscription->customer;
				$data['subscriptionId']   = $subscription->id;
				$data['paymentType'] 	  = 1;
				$data['invoiceId']        = $subscription->latest_invoice;
                $data['subject']          = $this->session->userdata('rs_subject');
				
				$this->db->insert('tbl_qs_payment', $data);
				
				redirect('/');

			}elseif($chargeJson['object'] == "charge" && $chargeJson['status'] == "succeeded"){

				$data['user_id']=$userID;
				$data['PaymentDate'] = time();
				$paymentType = $this->session->userdata('paymentType');
				if($paymentType == 1){
					//$second = 24 * 3600;
					$second = 30 * 24 * 3600;
				}elseif($paymentType == 2){
					$second = 30 * 6 * 24 * 3600;
				}elseif($paymentType == 3){
					$second = 30 * 12 * 24 * 3600;
				}

				$data['PaymentEndDate']   = $data['PaymentDate'] + $second;
				$data['total_cost']		  = $chargeJson['amount']/100;
				$data['payment_duration'] = $paymentType;
				$data['payment_status']   = 'Completed';
				$data['SenderEmail'] 	  = $user_email;
				$data['customerId']       = $chargeJson{'customer'};
				$data['subscriptionId']   = 'No Debit';
				$data['paymentType'] 	  = 1;
				$data['invoiceId']        = $chargeJson['balance_transaction'];
                $data['subject']          = $this->session->userdata('rs_subject');
				
				$this->db->insert('tbl_qs_payment', $data);
                
				redirect('/');
			}else{
				echo 'php error';die();
				$statusMsg = "Transaction has been failed";
			}
		}else{
			echo 'Form error';die();
			$statusMsg = "Form submission error.......";
		}

		//show success or error message
		//echo $statusMsg;
	}

	public function derect_request()
	{
		if ($this->session->userdata('user_id') != '') {

			$user_id = $this->session->userdata('user_id');
			$st_password = $this->session->userdata('st_password');
			$user_info = $this->Preview_model->userInfo($user_id);
			$template = $this->RegisterModel->getInfo('table_email_template', 'email_template_type', 10);
			//Added AS
            if($_SESSION['userType'] == 6){
                $parent_id = $user_info[0]['parent_id'];
			    $parent_user_info = $this->Preview_model->userInfo($parent_id);
			    $data['parent_email'] = $parent_user_info[0]['user_email'];
            }
		    //echo $parent_id;echo '<pre>';print_r($_SESSION['childrens']);die();
			if ( isset($_SESSION['courses'][0]) ) {
				$money = $this->RegisterModel->getInfo('tbl_course', 'id',  $_SESSION['courses'][0] );
			}
			
			$bank = $this->RegisterModel->getInfo('tbl_setting', 'setting_type', 'bank_account');

			$toUpdate['subscription_type'] = "signup";
			$toUpdate['direct_deposite'] = 0;
		    //$this->Tutor_model->updateInfo('tbl_useraccount', 'id', $user_id , $toUpdate );


			$email_template = str_replace("{{parentname}}" , $user_info[0]['name'] , $template[0]['email_template'] );

			if ( $_SESSION['countryId'] == 8 ) {

				$currency_convrt = $this->RegisterModel->getInfo('tbl_setting', 'setting_key', 'currency_convert_BDT');
				$tk = (int) $_SESSION['totalCost'] * $currency_convrt[0]['setting_value'];
				$email_template = str_replace("{{money}}" , $tk." BDT" , $email_template );
			}else{
				$email_template = str_replace("{{money}}" , $_SESSION['totalCost']." $" , $email_template );
			}
			
			$email_template = str_replace("{{acount_name}}" , $bank[0]['setting_value'] , $email_template );
			$email_template = str_replace("{{bsb}}" , $bank[1]['setting_value'] , $email_template );
			$email_template = str_replace("{{account_number}}" , $bank[2]['setting_value'] , $email_template );
			$email_template = str_replace("{{bank}}" , $bank[3]['setting_value'] , $email_template );


			if (!empty($_SESSION['trail_suspend']) && $_SESSION['trail_suspend'] == 1 ) {
	            redirect('/');
	        }

			if ($_SESSION['userType'] == 1) {
				$email_template = str_replace("{{parent_email}}" , $user_info[0]['user_email'] , $email_template );
				$email_template = str_replace("{{parent_password}}" ,$_SESSION['password'] , $email_template );
				$email_template = str_replace("{{student_number}}" , $_SESSION['childrens'] , $email_template );


				$html = '';

	            foreach ($_SESSION['students'] as $key => $value) {

		            $html .=
		                "<div style='overflow:hidden ;  margin-bottom:20px;'>
		                <div style='width:70%; float:left; text-align:left;'>
		                <p>Username</p>
		                <p>{$value['name']}</p>
		                </div>
		                <div style='width:30%; float:left; text-align:right;'>
		                <p>Password</p>
		                <p>{$st_password[$key]}</p>
		                </div>
		                </div>";          
		          }     



	            $email_template = str_replace("{{student_block}}" , $html, $email_template );

	            $this->mailTemplate($this->session->userdata('parent_name'), $this->session->userdata('email'), $this->session->userdata('password'), $this->session->userdata('student_list'));

			}
			if ($_SESSION['userType'] == 6) {
				$email_template = str_replace("{{parent_email}}" , $parent_user_info[0]['user_email'] , $email_template );
				$email_template = str_replace("{{parent_password}}" ,$_SESSION['password'] , $email_template );
				$email_template = str_replace("{{student_number}}" , $_SESSION['childrens'] , $email_template );

                $html .=
		                "<div style='overflow:hidden ;  margin-bottom:20px;'>
		                <div style='width:70%; float:left; text-align:left;'>
		                <p>Username</p>
		                <p>{$user_info[0]['name']}</p>
		                </div>
		                <div style='width:30%; float:left; text-align:right;'>
		                <p>Password</p>
		                <p>{$_SESSION['password']}</p>
		                </div>
		                </div>";   

	            $email_template = str_replace("{{student_block}}" , $html, $email_template );

	            $this->mailTemplate($parent_user_info[0]['name'] , $parent_user_info[0]['user_email'] , $this->session->userdata('password'), $this->session->userdata('student_list'));

			}

			if ($_SESSION['userType'] == 2) {
				$email_template = str_replace("{{parent_email}}" , $_SESSION['email'] , $email_template );
				$email_template = str_replace("{{parent_password}}" ,$_SESSION['password'] , $email_template );
				$email_template = str_replace("{{student_number}}" , "" , $email_template );

				$html = '';  
	            $email_template = str_replace("{{student_block}}" , $html, $email_template );
	            
	            $email_template = str_replace("Student Limit :" , $html, $email_template );

	            $this->student_mailTemplate($this->session->userdata('upper_student_name'), $this->session->userdata('email'), $this->session->userdata('password'));

			}

			if ($_SESSION['userType'] == 3) {

				$email_template = str_replace("{{parent_email}}" , $_SESSION['email'] , $email_template );
				$email_template = str_replace("{{parent_password}}" ,$_SESSION['password'] , $email_template );
				$email_template = str_replace("{{student_number}}" , "" , $email_template );

				$html = '';  
	            $email_template = str_replace("{{student_block}}" , $html, $email_template );
	            $email_template = str_replace("Student Limit :" , $html, $email_template );


				$this->tutor_mailTemplate($this->session->userdata('tutor_name'), $this->session->userdata('email'), $this->session->userdata('password'), $this->session->userdata('SCT_link') );
			}

			if ($this->session->userdata('paymentType')==1 ) {
            $toUp['end_subscription'] = date('Y-m-d', strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +30 day"));
            }

            if ($this->session->userdata('paymentType')==2) {
            $toUp['end_subscription'] = date('Y-m-d', strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +182 day"));
            }

            if ($this->session->userdata('paymentType')==3) {
            $toUp['end_subscription'] = date('Y-m-d', strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +365 day"));
            }
            if ($this->session->userdata('paymentType')==4) {
            $toUp['end_subscription'] = date('Y-m-d', strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +90 day"));
            }

			$toUp['subscription_type'] = "signup";
			$toUp['direct_deposite'] = 0;

			//$this->Tutor_model->updateInfo('tbl_useraccount', 'user_email', $this->session->userdata('email') , $toUp);

			

            $var = [
            	"to" => $user_info[0]['user_email'],
            	"subject" => $template[0]['email_template_subject'],
            	"message" => $email_template,
            ];

            

            $this->sendEmail($var);
	
			$data['user_type'] = $_SESSION['userType'];

            $data['user_info']=$user_info;
            $data['header']=$this->load->view('common/header', '', true);
            $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
            $data['footer']=$this->load->view('common/footer', '', true);
            $this->load->view('direct_request', $data);
        }
	}
	

	function tutor_mailTemplate($tutorName, $tutorEmail, $tutorPassword, $SCT_link)
    {
        $template = $this->RegisterModel->getInfo('table_email_template', 'email_template_type', $this->session->userdata('userType'));
        
        if ($template) {
            $subject = $template[0]['email_template_subject']; //->email_template_subject;
            $template_message = $template[0]['email_template']; //->email_template;
            
            $find = array("{{tutorName}}","{{tutor_email}}","{{tutor_password}}","{{tutor_sct_link}}");
            $replace = array($tutorName,$tutorEmail,$tutorPassword,$SCT_link);
            $message = str_replace($find, $replace, $template_message);
            $mail_data['to'] = $tutorEmail;
            $mail_data['subject'] = $template[0]['email_template_subject'];
            ;
            $mail_data['message'] = $message;
            
            $this->sendEmail($mail_data);
        }
        return true;
    }

	public function student_mailTemplate($upper_student_name, $email, $password)
    {

        $Name=$upper_student_name;
        $email=$email;
        $Password=$password;
        $template = $this->RegisterModel->getInfo('table_email_template', 'email_template_type', $this->session->userdata('userType'));
        if ($template) {
            $subject = $template[0]['email_template_subject'];
            $template_message = $template[0]['email_template'];
            
            $find = array("{{upper_student_name}}","{{upper_student_email}}","{{upper_student_password}}");
            $replace = array($Name,$email,$Password);
            $message = str_replace($find, $replace, $template_message);
            $mail_data['to'] = $email ;
            $mail_data['subject'] = $template[0]['email_template_subject'];
            ;
            $mail_data['message'] = $message;
            $this->sendEmail($mail_data);
        }
        return true;
    }

	public function mailTemplate($parent_name, $parent_email, $parent_password, $student_list)
    {

        $userName = $parent_name;
        $userEmail = $parent_email;
        $userPassword = $parent_password;
        
        $template = $this->RegisterModel->getInfo('table_email_template', 'email_template_type', $this->session->userdata('userType'));
        $student_number = sizeof($student_list);
        if ($template) {
            $subject = $template[0]['email_template_subject'];
            $template_message = $template[0]['email_template'];

            $firstPos = strpos('[[[studentdata]]]', $template_message);
            $lastPos = strpos('[[[/studentdata]]]', $template_message);
            $sub_str_message = substr($template_message, $firstPos, $lastPos);
            $St_message='';
            $st_data = '';
            foreach ($student_list as $single_child) {
                $st_data .=
                "<div style='overflow:hidden ;  margin-bottom:20px;'>
                <div style='width:70%; float:left; text-align:left;'>
                <p>Username</p>
                <p>{$single_child['st_name']}</p>
                </div>
                <div style='width:30%; float:left; text-align:right;'>
                <p>Password</p>
                <p>{$single_child['st_password']}</p>
                </div>
                </div>";
            }

            $find = array("{{student_number}}","{{student_block}}","{{parentName}}","{{parent_email}}","{{parent_password}}");
            $replace = array($student_number,$st_data,$userName,$userEmail,$userPassword);
            $message = str_replace($find, $replace, $template_message);
            $mail_data['to'] = $userEmail;
            $mail_data['subject'] = $template[0]['email_template_subject'];
            ;
            $mail_data['message'] = $message;
            $this->sendEmail($mail_data);
        }
        return true;
    }


	public function sendEmail($mail_data)
    {
        $mailTo        =   $mail_data['to'];
        $mailSubject   =   $mail_data['subject'];
        $message       =   $mail_data['message'];

        $this->load->library('email');
        $this->email->set_mailtype('html');

        /*$config['protocol'] ='sendmail';
        $config['mailpath'] ='/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = true;*/
        // $config['protocol']    = 'smtp';
        // $config['smtp_crypto']    = 'ssl';
        // $config['smtp_port']    = '465';
        // $config['mailtype']    = 'text';
        // $config['smtp_host']    = 'email-smtp.us-east-1.amazonaws.com';
        // $config['smtp_user']    = 'AKIAJASMGQXCHUGFOX2A';
        // $config['smtp_pass']    = 'AhQPyL02MEAjbohY82vZLikIwY1O2sU4sOrdI6vC3HYk';
        // $config['charset']    = 'utf-8';
        // $config['mailtype']    = 'html';
        // $config['newline']    = "\r\n";
        
        
        $config['protocol']    = 'smtp';
        $config['smtp_crypto']    = 'ssl';
        $config['smtp_port']    = '465';
        $config['mailtype']    = 'text';
        $config['smtp_host']    = 'q-study.com';
        $config['smtp_user']    = 'admin@q-study.com';
        $config['smtp_pass']    = '1qvm6F&2';
        $config['charset']    = 'utf-8';
        $config['mailtype']    = 'html';
        $config['newline']    = "\r\n";
        $this->email->initialize($config);
        
        
        $this->email->from('admin@q-study.com', 'Q-study');
        $this->email->to($mailTo);
        $this->email->subject($mailSubject);
        $this->email->message($message);
        
        
        $this->email->send();
        
        return true;
    }



    //added AS 
    public function direct_deposit(){
		
	    //print_r($this->session->userdata('user_email')); die();
   		$user_id =$this->session->userdata('user_id');
   		$email =$this->session->userdata('user_email');
		$check_student = $this->db->where('id',$user_id)->get('tbl_useraccount')->row();
   		$data['user_id']=$this->session->userdata('user_id');
		$data['PaymentDate'] = time();
		$paymentType = $this->session->userdata('paymentType');
		if($paymentType == 1){
			$second = 30 * 24 * 3600;
		}elseif($paymentType == 2){
			$second = 30 * 6 * 24 * 3600;
		}elseif($paymentType == 3){
			$second = 30 * 12 * 24 * 3600;
		}elseif($paymentType == 4){
			$second = 30 * 3 * 24 * 3600;
		}

		$rs_course = $this->session->userdata('courses');
		$register_courses = $this->db->select('course_id')->where('user_id',$user_id)->where('cost <>',0)->where('endTime >',time())->group_by('course_id')->get('tbl_registered_course')->result_array();
		$registerCourse = [];
		foreach($register_courses as $key => $course){
			$registerCourse[$key] = $course['course_id'];
		}
		
		$paymentType = $this->session->userdata('paymentType');
		if($paymentType == 1){
			$month_added=1;
		}elseif($paymentType == 2){
			$month_added=6;
		}elseif($paymentType == 3){
			$month_added=12;
		}elseif($paymentType == 4){
			$month_added=3;
		}
		$total_course = count($rs_course);
		$total_registered_course = count($registerCourse);
		$match =0;
		$course_matched = 0;

		//  echo $total_course.'//'.$total_registered_course."<pre>";print_r($registerCourse);
		//  echo "<pre>";print_r($rs_course);die();
	
		if(!empty($rs_course)){
			foreach($rs_course as $singleCourse){
				if(in_array($singleCourse,$registerCourse)){
					$match++;
				}
			}
		}
		//echo $match.'//'.$total_registered_course;die();
		if($total_course>$total_registered_course){
            if($total_registered_course==0){
				$course_matched=0;
			}elseif($match==$total_course){
				$course_matched=1;
			}
		}else{
			if($total_registered_course==0){
				$course_matched=0;
			}elseif($match==$total_registered_course){
				$course_matched=1;
			}
		}
		//  echo $course_matched;die();


		$endDate   = $data['PaymentDate'] + $second;
		$data['PaymentEndDate']   = $data['PaymentDate'] + $second;
		$data['total_cost']		  = $this->session->userdata('totalCost');
		$data['payment_duration'] = $paymentType;
		$data['payment_status']   = "pending";
		$data['SenderEmail'] 	  = $this->session->userdata('user_email');
		
		$data['customerId']       = null;
		$data['subscriptionId']   = null;
		$data['paymentType'] 	  = 3;
		$data['invoiceId']        = null;
		// echo "<pre>";print_r($data);die();
		$this->db->insert('tbl_payment', $data);
	 	$paymentId = $this->db->insert_id();
		$rs_course = $this->session->userdata('courses');
		
		foreach($rs_course as $singleCourse)
		{
			$pay['paymentId']=$paymentId;
			$pay['courseId']=$singleCourse;
			$this->db->insert('tbl_payment_details', $pay);
		}
		
		$courseEnd = $endDate;
        $today_timestamp = time();
        $this->db->where('user_id',$user_id)->where('endTime <',$today_timestamp)->update('tbl_registered_course',['status'=>0]);
        foreach ($rs_course as $singleCourse) {
            $course['course_id'] = $singleCourse;
            $rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
            $course['cost']    = $rs_course_cost[0]['courseCost'];
            $course['user_id'] = $user_id;
            $course['created'] = time();
            $course['endTime'] = $courseEnd;
            // echo '<pre>';print_r($course);die();
            $this->RegisterModel->basicInsert('tbl_registered_course', $course);
        }
		$user_data['payment_status'] = 'Completed';
		$user_data['subscription_type'] = 'signup';
		$sub_end_date = date('Y-m-d',$data['PaymentEndDate']);
		//$user_data['end_subscription'] = $sub_end_date;
		
        if($check_student->end_subscription != null){
            $end_subscription = $check_student->end_subscription;
            if($course_matched==1){
				$toAddDay = $month_added*30;
				$new_date = date('Y-m-d', strtotime($check_student->end_subscription. ' + '.$toAddDay.' days'));
				$user_data['end_subscription']  =$new_date;
			}else{
				$user_data['end_subscription']  = $sub_end_date;
			}
        }else{
            $user_data['end_subscription']  = $sub_end_date;
        }
        $this->db->where('id', $data['user_id']);
        $this->db->update('tbl_useraccount',$user_data);
        
        //check for student/parent
        if ($check_student->user_type == 6) {
          $this->db->where('id', $check_student->parent_id);
          $this->db->update('tbl_useraccount',$user_data);
          $this->session->set_userdata('userType', 6);
        }
        
        //mail and send message
        if ($check_student->user_type == 6) {
          $parentDetails = $this->db->where('id',$check_student->parent_id)->get('tbl_useraccount')->row();
          $par_email = $parentDetails->user_email;
          $par_name = $parentDetails->name;
          $country_id = $parentDetails->country_id;
          $this->sendInboxMessage($par_email,$par_name,$rs_course,$paymentType,$this->session->userdata('totalCost'),$country_id,$user_id);
          $this->sendEmailMessage($par_email,$par_name,$rs_course,$paymentType,$this->session->userdata('totalCost'),$country_id,$user_id);
        }else{
          $this->sendInboxMessage($email,$check_student->name,$rs_course,$paymentType,$this->session->userdata('totalCost'),$check_student->country_id,$user_id);
          $this->sendEmailMessage($email,$check_student->name,$rs_course,$paymentType,$this->session->userdata('totalCost'),$check_student->country_id,$user_id);
        }
     
        redirect('direct-request');

   }

    public function signup_direct_deposit(){
	    // print_r($this->session->userdata('user_email')); die();
	    $parent_id =$this->session->userdata('user_id');
        

	    $email =$this->session->userdata('user_email');
	    $check_student = $this->db->where('parent_id',$parent_id)->get('tbl_useraccount')->row();
		$user_id = $check_student->id;
	    $data['user_id']=$user_id;
		$data['PaymentDate'] = time();
		$paymentType = $this->session->userdata('paymentType');
		if($paymentType == 1){
			$second = 30 * 24 * 3600;
		}elseif($paymentType == 2){
			$second = 30 * 6 * 24 * 3600;
		}elseif($paymentType == 3){
			$second = 30 * 12 * 24 * 3600;
		}elseif($paymentType == 4){
			$second = 30 * 3 * 24 * 3600;
		}
		$endDate   = $data['PaymentDate'] + $second;
		$data['PaymentEndDate']   = $data['PaymentDate'] + $second;
		$data['total_cost']		  = $this->session->userdata('totalCost');
		$data['payment_duration'] = $paymentType;
		$data['payment_status']   = "pending";
		$data['SenderEmail'] 	  = $email;
		
		$data['customerId']       = null;
		$data['subscriptionId']   = null;
		$data['paymentType'] 	  = 3;
		$data['invoiceId']        = null;
		// echo "<pre>";print_r($data);die();
		$this->db->insert('tbl_payment', $data);
		$paymentId = $this->db->insert_id();
		$rs_course = $this->session->userdata('courses');
		
		foreach($rs_course as $singleCourse)
		{
			$pay['paymentId']=$paymentId;
			$pay['courseId']=$singleCourse;
			$this->db->insert('tbl_payment_details', $pay);
		}
		
		$courseEnd = $endDate;
		$today_timestamp = time();
		$this->db->where('user_id',$user_id)->where('endTime <',$today_timestamp)->update('tbl_registered_course',['status'=>0]);
		foreach ($rs_course as $singleCourse) {
			$course['course_id'] = $singleCourse;
			$rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
			$course['cost']    = $rs_course_cost[0]['courseCost'];
			$course['user_id'] = $user_id;
			$course['created'] = time();
			$course['endTime'] = $courseEnd;
			// echo '<pre>';print_r($course);die();
			$this->RegisterModel->basicInsert('tbl_registered_course', $course);
		}
		$user_data['payment_status'] = 'Completed';
		$user_data['subscription_type'] = 'signup';
		$sub_end_date = date('Y-m-d',$data['PaymentEndDate']);
		//$user_data['end_subscription'] = $sub_end_date;
		
		if($check_student->end_subscription != null){
			$end_subscription = $check_student->end_subscription;
			if($sub_end_date > $end_subscription){
				$user_data['end_subscription']  = $sub_end_date;
			}else{
				$user_data['end_subscription']  = $end_subscription;
			}
		}else{
			$user_data['end_subscription']  = $sub_end_date;
		}
		$this->db->where('id', $data['user_id']);
		$this->db->update('tbl_useraccount',$user_data);
		
		//check for student/parent
		if ($check_student->user_type == 6) {
		$this->db->where('id', $check_student->parent_id);
		$this->db->update('tbl_useraccount',$user_data);
		$this->session->set_userdata('userType', 6);
		}
		
		//mail and send message
		if ($check_student->user_type == 6) {
		$parentDetails = $this->db->where('id',$check_student->parent_id)->get('tbl_useraccount')->row();
		$par_email = $parentDetails->user_email;
		$par_name = $parentDetails->name;
		$country_id = $parentDetails->country_id;
		$this->sendInboxMessage($par_email,$par_name,$rs_course,$paymentType,$this->session->userdata('totalCost'),$country_id,$user_id);
		$this->sendEmailMessage($par_email,$par_name,$rs_course,$paymentType,$this->session->userdata('totalCost'),$country_id,$user_id);
		}else{
		$this->sendInboxMessage($email,$check_student->name,$rs_course,$paymentType,$this->session->userdata('totalCost'),$check_student->country_id,$user_id);
		$this->sendEmailMessage($email,$check_student->name,$rs_course,$paymentType,$this->session->userdata('totalCost'),$check_student->country_id,$user_id);
		}
		//echo "stop";die();
		redirect('signup-direct-request');

    }

	public function signup_upper_direct_deposit(){
	    // print_r($this->session->userdata('email')); die();  
	    $email =$this->session->userdata('email');
		$user_id = $this->session->userdata('user_id');
	    $data['user_id']=$user_id;
		$data['PaymentDate'] = time();
		$paymentType = $this->session->userdata('paymentType');
		if($paymentType == 1){
			$second = 30 * 24 * 3600;
		}elseif($paymentType == 2){
			$second = 30 * 6 * 24 * 3600;
		}elseif($paymentType == 3){
			$second = 30 * 12 * 24 * 3600;
		}elseif($paymentType == 4){
			$second = 30 * 3 * 24 * 3600;
		}
		$endDate   = $data['PaymentDate'] + $second;
		$data['PaymentEndDate']   = $data['PaymentDate'] + $second;
		$data['total_cost']		  = $this->session->userdata('totalCost');
		$data['payment_duration'] = $paymentType;
		$data['payment_status']   = "pending";
		$data['SenderEmail'] 	  = $email;
		
		$data['customerId']       = null;
		$data['subscriptionId']   = null;
		$data['paymentType'] 	  = 3;
		$data['invoiceId']        = null;
		// echo "<pre>";print_r($data);die();
		$this->db->insert('tbl_payment', $data);
		$paymentId = $this->db->insert_id();
		$rs_course = $this->session->userdata('courses');
		
		foreach($rs_course as $singleCourse)
		{
			$pay['paymentId']=$paymentId;
			$pay['courseId']=$singleCourse;
			$this->db->insert('tbl_payment_details', $pay);
		}
		
		$courseEnd = $endDate;
		$today_timestamp = time();
		$this->db->where('user_id',$user_id)->where('endTime <',$today_timestamp)->update('tbl_registered_course',['status'=>0]);
		foreach ($rs_course as $singleCourse) {
			$course['course_id'] = $singleCourse;
			$rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
			$course['cost']    = $rs_course_cost[0]['courseCost'];
			$course['user_id'] = $user_id;
			$course['created'] = time();
			$course['endTime'] = $courseEnd;
			// echo '<pre>';print_r($course);die();
			$this->RegisterModel->basicInsert('tbl_registered_course', $course);
		}
		$user_data['payment_status'] = 'Completed';
		$user_data['subscription_type'] = 'signup';
		$sub_end_date = date('Y-m-d',$data['PaymentEndDate']);
		//$user_data['end_subscription'] = $sub_end_date;
		
		if($check_student->end_subscription != null){
			$end_subscription = $check_student->end_subscription;
			if($sub_end_date > $end_subscription){
				$user_data['end_subscription']  = $sub_end_date;
			}else{
				$user_data['end_subscription']  = $end_subscription;
			}
		}else{
			$user_data['end_subscription']  = $sub_end_date;
		}
		$this->db->where('id', $data['user_id']);
		$this->db->update('tbl_useraccount',$user_data);
		
		//check for student/parent
		if ($check_student->user_type == 6) {
		$this->db->where('id', $check_student->parent_id);
		$this->db->update('tbl_useraccount',$user_data);
		$this->session->set_userdata('userType', 6);
		}
		
		//mail and send message
		if ($check_student->user_type == 6) {
		$parentDetails = $this->db->where('id',$check_student->parent_id)->get('tbl_useraccount')->row();
		$par_email = $parentDetails->user_email;
		$par_name = $parentDetails->name;
		$country_id = $parentDetails->country_id;
		$this->sendInboxMessage($par_email,$par_name,$rs_course,$paymentType,$this->session->userdata('totalCost'),$country_id,$user_id);
		$this->sendEmailMessage($par_email,$par_name,$rs_course,$paymentType,$this->session->userdata('totalCost'),$country_id,$user_id);
		}else{
		$this->sendInboxMessage($email,$check_student->name,$rs_course,$paymentType,$this->session->userdata('totalCost'),$check_student->country_id,$user_id);
		$this->sendEmailMessage($email,$check_student->name,$rs_course,$paymentType,$this->session->userdata('totalCost'),$check_student->country_id,$user_id);
		}
		//echo "stop";die();
		redirect('direct-request');

    }

	public function signup_derect_request()
	{
		if ($this->session->userdata('user_id') != '') {
			// echo $this->session->userdata('user_id');die();
			$parent_id = $this->session->userdata('user_id');
			$parent_info = $this->db->where('id',$parent_id)->get('tbl_useraccount')->row();
			$check_student = $this->db->where('parent_id',$parent_id)->get('tbl_useraccount')->row();
			$user_id = $check_student->id;
			$st_password = '123456';
			$user_info = $this->Preview_model->userInfo($user_id);
			$template = $this->RegisterModel->getInfo('table_email_template', 'email_template_type', 10);
			//Added AS
            if($_SESSION['userType'] == 6){
                $parent_id = $user_info[0]['parent_id'];
			    $parent_user_info = $this->Preview_model->userInfo($parent_id);
			    $data['parent_email'] = $parent_user_info[0]['user_email'];
            }
		    //echo $parent_id;echo '<pre>';print_r($_SESSION['childrens']);die();
			if ( isset($_SESSION['courses'][0]) ) {
				$money = $this->RegisterModel->getInfo('tbl_course', 'id',  $_SESSION['courses'][0] );
			}
			
			$bank = $this->RegisterModel->getInfo('tbl_setting', 'setting_type', 'bank_account');

			$toUpdate['subscription_type'] = "signup";
			$toUpdate['direct_deposite'] = 0;
		    //$this->Tutor_model->updateInfo('tbl_useraccount', 'id', $user_id , $toUpdate );


			$email_template = str_replace("{{parentname}}" , $user_info[0]['name'] , $template[0]['email_template'] );

			if ( $_SESSION['countryId'] == 8 ) {

				$currency_convrt = $this->RegisterModel->getInfo('tbl_setting', 'setting_key', 'currency_convert_BDT');
				$tk = (int) $_SESSION['totalCost'] * $currency_convrt[0]['setting_value'];
				$email_template = str_replace("{{money}}" , $tk." BDT" , $email_template );
			}else{
				$email_template = str_replace("{{money}}" , $_SESSION['totalCost']." $" , $email_template );
			}
			
			$email_template = str_replace("{{acount_name}}" , $bank[0]['setting_value'] , $email_template );
			$email_template = str_replace("{{bsb}}" , $bank[1]['setting_value'] , $email_template );
			$email_template = str_replace("{{account_number}}" , $bank[2]['setting_value'] , $email_template );
			$email_template = str_replace("{{bank}}" , $bank[3]['setting_value'] , $email_template );


			if (!empty($_SESSION['trail_suspend']) && $_SESSION['trail_suspend'] == 1 ) {
	            redirect('/');
	        }

			if ($_SESSION['userType'] == 1) {
				$email_template = str_replace("{{parent_email}}" , $user_info[0]['user_email'] , $email_template );
				$email_template = str_replace("{{parent_password}}" ,$_SESSION['password'] , $email_template );
				$email_template = str_replace("{{student_number}}" , $_SESSION['childrens'] , $email_template );


				$html = '';

	            foreach ($_SESSION['students'] as $key => $value) {

		            $html .=
		                "<div style='overflow:hidden ;  margin-bottom:20px;'>
		                <div style='width:70%; float:left; text-align:left;'>
		                <p>Username</p>
		                <p>{$value['name']}</p>
		                </div>
		                <div style='width:30%; float:left; text-align:right;'>
		                <p>Password</p>
		                <p>{$st_password[$key]}</p>
		                </div>
		                </div>";          
		          }     



	            $email_template = str_replace("{{student_block}}" , $html, $email_template );

	            $this->mailTemplate($check_student->name, $check_student->user_email, '123456', $this->session->userdata('student_list'));

			}
			if ($_SESSION['userType'] == 6) {
				$email_template = str_replace("{{parent_email}}" , $parent_user_info[0]['user_email'] , $email_template );
				$email_template = str_replace("{{parent_password}}" ,$_SESSION['password'] , $email_template );
				$email_template = str_replace("{{student_number}}" , $_SESSION['childrens'] , $email_template );

                $html .=
		                "<div style='overflow:hidden ;  margin-bottom:20px;'>
		                <div style='width:70%; float:left; text-align:left;'>
		                <p>Username</p>
		                <p>{$user_info[0]['name']}</p>
		                </div>
		                <div style='width:30%; float:left; text-align:right;'>
		                <p>Password</p>
		                <p>{$_SESSION['password']}</p>
		                </div>
		                </div>";   

	            $email_template = str_replace("{{student_block}}" , $html, $email_template );

	            $this->mailTemplate($parent_user_info[0]['name'] , $parent_user_info[0]['user_email'] , $this->session->userdata('password'), $this->session->userdata('student_list'));

			}

			if ($_SESSION['userType'] == 2) {
				$email_template = str_replace("{{parent_email}}" , $_SESSION['email'] , $email_template );
				$email_template = str_replace("{{parent_password}}" ,$_SESSION['password'] , $email_template );
				$email_template = str_replace("{{student_number}}" , "" , $email_template );

				$html = '';  
	            $email_template = str_replace("{{student_block}}" , $html, $email_template );
	            
	            $email_template = str_replace("Student Limit :" , $html, $email_template );

	            $this->student_mailTemplate($this->session->userdata('upper_student_name'), $this->session->userdata('email'), $this->session->userdata('password'));

			}

			if ($_SESSION['userType'] == 3) {

				$email_template = str_replace("{{parent_email}}" , $_SESSION['email'] , $email_template );
				$email_template = str_replace("{{parent_password}}" ,$_SESSION['password'] , $email_template );
				$email_template = str_replace("{{student_number}}" , "" , $email_template );

				$html = '';  
	            $email_template = str_replace("{{student_block}}" , $html, $email_template );
	            $email_template = str_replace("Student Limit :" , $html, $email_template );


				$this->tutor_mailTemplate($this->session->userdata('tutor_name'), $this->session->userdata('email'), $this->session->userdata('password'), $this->session->userdata('SCT_link') );
			}

			if ($this->session->userdata('paymentType')==1 ) {
            $toUp['end_subscription'] = date('Y-m-d', strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +30 day"));
            }

            if ($this->session->userdata('paymentType')==2) {
            $toUp['end_subscription'] = date('Y-m-d', strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +182 day"));
            }

            if ($this->session->userdata('paymentType')==3) {
            $toUp['end_subscription'] = date('Y-m-d', strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +365 day"));
            }
            if ($this->session->userdata('paymentType')==4) {
            $toUp['end_subscription'] = date('Y-m-d', strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +90 day"));
            }

			$toUp['subscription_type'] = "signup";
			$toUp['direct_deposite'] = 0;

			//$this->Tutor_model->updateInfo('tbl_useraccount', 'user_email', $this->session->userdata('email') , $toUp);

			

            $var = [
            	"to" => $user_info[0]['user_email'],
            	"subject" => $template[0]['email_template_subject'],
            	"message" => $email_template,
            ];

            

            $this->sendEmail($var);

            $data['user_info']=$user_info;
            $data['header']=$this->load->view('common/header', '', true);
            $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
            $data['footer']=$this->load->view('common/footer', '', true);
            $this->load->view('signup-direct-request', $data);
        }
	}
   
   public function sendEmailMessage($email,$name,$rs_course,$paymentType,$total_cost,$country_id,$user_id){
       
       $getDepositDetails = $this->Admin_model->getDepositDetails('direct_deposit_admin_setting',$country_id);
       if($paymentType == 1){
			$month = 1;
		}elseif($paymentType == 2){
			$month = 6;
		}elseif($paymentType == 3){
			$month = 12;
		}elseif($paymentType == 4){
			$month = 3;
		}
        $template = $this->RegisterModel->getInfo('table_email_template', 'email_template_type', 'Direct_Deposit');
		

		
		$html = '';
		foreach ($rs_course as $singleCourse) {
            $course['course_id'] = $singleCourse;
            $rs_course_cost = $this->RegisterModel->getCourseCost($course['course_id']);
            $course_cost    = $rs_course_cost[0]['courseCost'];
            $courseName     = $rs_course_cost[0]['courseName'];
		    $html .= '<span style="font-size: 14px;">'.$courseName.'  $'.$course_cost.'</span><br> ';
            
        }
		$email_template = str_replace("{{coruse_list}}" , $html , $template[0]['email_template'] );
		
		$email_template = str_replace("{{parentname}}" , $name , $email_template );
		$email_template = str_replace("{{total_amount}}" , $total_cost , $email_template );
		$email_template = str_replace("{{total_duration}}" , $month , $email_template );
		$email_template = str_replace("{{money}}" , $total_cost , $email_template);
		$email_template = str_replace("{{bank_details}}" , nl2br($getDepositDetails->inbox_message) ,$email_template);
		
		$mail_data['to'] = 'shovoua@gmail.com';//$userEmail;
        $mail_data['subject'] = 'Q-study Direct Deposit';
        ;
        $mail_data['message'] = $email_template;
        $this->sendEmail($mail_data);
		
   }
   
   public function sendInboxMessage($email,$name,$rs_course,$paymentType,$total_cost,$country_id,$user_id){
       
       $getDepositDetails = $this->Admin_model->getDepositDetails('direct_deposit_admin_setting',$country_id);
       if($paymentType == 1){
			$month = 1;
		}elseif($paymentType == 2){
			$month = 6;
		}elseif($paymentType == 3){
			$month = 12;
		}elseif($paymentType == 4){
			$month = 3;
		}
		
		$html = '';
		$html .= '<div class="mailbody" style="padding: 0px 25px;">';
		$html .= '<p>Dear : '.$name.'</p><br>';
		$html .= '<p>Thank you for subscribing Q-study </p>';
		$html .= '<p>Your Choosen Product:</p> ';
		foreach ($rs_course as $singleCourse) {
            $course['course_id'] = $singleCourse;
            $rs_course_cost = $this->RegisterModel->getCourseCost($course['course_id']);
            $course_cost    = $rs_course_cost[0]['courseCost'];
            $courseName     = $rs_course_cost[0]['courseName'];
		    $html .= '<p>'.$courseName.'  $'.$course_cost.'</p> ';
            
        }
		$html .= '<p>Duration: '.$month.' Month</p> ';
		$html .= '<p>Total $: '.$total_cost.'</p> ';
		$html .= '<p>Please make payment of <span style="color:#333192;">$'.$total_cost.'</span> to Q-study</p>';
		$html .= '<div>'.nl2br($getDepositDetails->inbox_message).'</div> <br>';
		$html .= '<p style="color:#333192;line-height: 20px;margin-bottom: 8px;">After payment has been made, please email or message to your payment information in the Q-study contact of the front page of the student so we can active your acount without delay.</p>';
		$html .= '<p style="color:#333192;line-height: 20px;margin-bottom: 8px;">Moreover, You can watch the video how to send payment information. </p>';
		$html .= '<p style="color:#333192;line-height: 20px;"> Please write your name,email address and your Ref.Link as the reference.  </p>';
		$html .= '<p>Thanks</p>';
		$html .= '<p><b>Q-Study</b></p>';
		$html .= '</div>';
		
		$data['message']    = $html;
        $data['reciver_id'] = $user_id;
        $data['date_time']  = date('Y-m-d H:i a');
        $data['date']       = date('Y-m-d');
        $data['time']       = time();
        
        $this->db->insert('tbl_compose_message',$data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
		
   }
   
   //added AS 
   public function direct_deposit_qus_store(){
   		$data['user_id']=$this->session->userdata('user_id');
		$data['PaymentDate'] = time();
		$paymentType = $this->session->userdata('paymentType');
		if($paymentType == 1){
			$second = 30 * 24 * 3600;
		}elseif($paymentType == 2){
			$second = 30 * 6 * 24 * 3600;
		}elseif($paymentType == 3){
			$second = 30 * 12 * 24 * 3600;
		}

		$data['PaymentEndDate']   = $data['PaymentDate'] + $second;
		$data['total_cost']		  = $this->session->userdata('totalCost');
		$data['payment_duration'] = $paymentType;
		$data['payment_status']   = "Pending";
		$data['SenderEmail'] 	  = $this->session->userdata('user_email');
		
		$data['customerId']       = null;
		$data['subscriptionId']   = null;
		$data['paymentType'] 	  = 3;
		$data['invoiceId']        = null;
        $data['subject']          = $this->session->userdata('rs_subject');
// 		echo '<pre>';print_r($data);die();
		$this->db->insert('tbl_qs_payment', $data);
        redirect('/');


   }
}