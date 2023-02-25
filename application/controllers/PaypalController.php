<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PaypalController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('RegisterModel');
    }
    public function paypal_notify()
    {
        
        $file = 'paypal_'.time().rand(9,9999).'.txt';
        $file2 = 'paypal/paypal222_'.time().rand(9,9999).'.txt';
        $file3 = 'paypal/paypal333_'.time().rand(9,9999).'.txt';

        $x = serialize($_POST);
        file_put_contents($file, $x);
        // paypal_16205012111000.txt
        $x = file_get_contents('paypal_16232194844410.txt');
        $y = unserialize($x);
        // echo "<pre>"; 
        // print_r($y);die;
        
        $this->load->helper('commonmethods_helper');
        /*sendmail([
            'to'=>'shakil147258@gmail.com',
            'subject'=>'subject',
            'message'=>json_encode($_POST),
        ]);*/
        
        $req = 'cmd=_notify-validate';
        //mail("ai.shobujice@gmail.com","My subject","Message Description");
        foreach($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value);
            $req .= "&$key=$value";
        }
        

        reset($_POST);
        $datas = print_r($_POST, true);
        // echo "<pre>";print_r($_POST);die();
        //mail("ai.shobujice@gmail.com","My subject",$datas);
        //die();
        /* save payer info to database */

        //$data['UserId'] = $_POST['custom'];
        $userId_courseId = explode(',', $y['custom']);
        $data['user_id'] = $userId_courseId[0];
        //check for student/parent
        $courseID = $data['user_id'];
        $check_student = $this->db->where('id',$data['user_id'])->get('tbl_useraccount')->row();
        
        
        
        if ($check_student->user_type == 6) {
          $data['user_id']=$userId_courseId[0];
        }else{
          $data['user_id']=$userId_courseId[0];
        }
        
        $data['PaymentDate'] = time();
        $paymentType = $userId_courseId[1];
        if ($paymentType == 1) {
            $second = 30 * 24 * 3600;
            //$second = 24 * 3600;
        } elseif ($paymentType == 2) {
            $second = 30 * 6 * 24 * 3600;
        } elseif ($paymentType == 3) {
            $second = 30 * 12 * 24 * 3600;
        }elseif ($paymentType == 4) {
            $second = 30 * 3 * 24 * 3600;
        }
        $endDate =  $data['PaymentDate'] + $second;
        $date = date('Y-m-d',$endDate);
        
        //echo $date;die();
        $data['PaymentEndDate'] = $data['PaymentDate'] + $second;
        $data['total_cost']     = $y['mc_gross'];
       // $data['PackageId'] = $y['item_number'];
        $data['payment_status'] = $y['payment_status'];
        $data['SenderEmail']    = $y['payer_email'];
        $data['paymentType']    = 2; //maybe paypal
        $data['subscriptionId'] = $y['subscr_id'];
        $data['customerId']     = $y['payer_id'];
        $data['payment_duration'] = $userId_courseId[1];
        $data['invoiceId']      = $y['txn_id']; 
        
        $check_tnx = $this->db->where('invoiceId',$data['invoiceId'])->get('tbl_payment')->result_array();
        if (count($check_tnx) > 0 ){
            echo "match invoice";die();
        }
        
        array_shift($userId_courseId);
        array_shift($userId_courseId);
        

        $instra = print_r($data, true);
        

        $ch = curl_init('https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        
        if (!($res = curl_exec($ch))) {
            // error_log("Got " . curl_error($ch) . " when processing IPN data");
            curl_close($ch);
            exit;
        }
        curl_close($ch);
        
        //echo "<pre>";print_r(strcmp($res, "VERIFIED"));die;
        // inspect IPN validation result and act accordingly

        $rs_course = $userId_courseId;
        file_put_contents($file2, 'ppplll');
		$register_courses = $this->db->select('course_id')->where('user_id',$data['user_id'])->where('cost <>',0)->where('endTime >',time())->group_by('course_id')->get('tbl_registered_course')->result_array();
		$registerCourse = [];
		foreach($register_courses as $key => $course){
			$registerCourse[$key] = $course['course_id'];
		}
		
	    
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

        file_put_contents($file2, $rs_course);
        file_put_contents($file3, $registerCourse);
        
		if(!empty($rs_course)){
			foreach($rs_course as $singleCourse){
				if(in_array($singleCourse,$registerCourse)){
					$match++;
				}
			}
		}
	
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
        
        if (strcmp($res, "VERIFIED") == 0){
            
            $userID = $data['user_id'];
           
            $this->db->insert('tbl_payment', $data);
            $paymentId=$this->db->insert_id();
            $today_timestamp = time();
            if ($userId_courseId) {
                foreach ($userId_courseId as $dacourseId) {
                  $pay['paymentId']= $paymentId;
                  $pay['courseId'] = $dacourseId;
                  $this->db->insert('tbl_payment_details', $pay);
                }
                
                $this->db->where('user_id',$courseID)->where('endTime <',$today_timestamp)->update('tbl_registered_course',['status'=>0]);
                
                foreach ($userId_courseId as $singleCourse) {
                    $course['course_id'] = $singleCourse;
                    $rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
                    $course['cost']    = $rs_course_cost[0]['courseCost'];
                    $course['user_id'] = $courseID;
                    $course['created'] = time();
                    $course['endTime'] = $endDate;
                    $this->RegisterModel->basicInsert('tbl_registered_course', $course);
                }
                
                
            }


            // echo "<pre>";print_r($data);die;
            
            $user_data['payment_status'] = $data['payment_status'];
            $user_data['subscription_type'] ='signup';
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
            }else{
                
                $user_data['end_subscription']  = $sub_end_date;
                
            }
            //$this->db->set('payment_status', $data['payment_status']);
            $this->db->where('id', $userID);
            $this->db->update('tbl_useraccount',$user_data);
            
            //check for student/parent
            if ($check_student->user_type == 6) {
                $this->db->where('id', $check_student->parent_id);
                $this->db->update('tbl_useraccount',$user_data);
                $this->session->set_userdata('userType', 6);
              
                $refUsers = $this->db->where('user_id',$check_student->id)->where('status',0)->get('tbl_referral_users')->row();
            
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
                     $ckrfuser['referral_point'] = $referralPoint + $old_referral_point;
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
                     $ckrfByuser['referral_point'] = $ref_taken_point + $old_referral_point;
                     $ckrfByuser['total_point']    = $ref_taken_point + $totalByPoint;
                     $this->db->where('user_id',$refferByUser)->update('product_poinits',$ckrfByuser);
                    }else{
                     $ckrfByuser['user_id'] = $refferByUser;
                     $ckrfByuser['referral_point'] = $ref_taken_point;
                     $ckrfByuser['total_point']    = $ref_taken_point;
                     $this->db->insert('product_poinits',$ckrfByuser);
                    }
    
                    $this->db->where('user_id',$check_student->id)->update('tbl_referral_users',['status' => 1]);
                }
            }

            //insert payment info
            // IPN message values depend upon the type of notification sent.
            // To loop through the &_POST array and print the NV pairs to the screen:
            foreach ($y as $key => $value) {
                echo $key . " = " . $value . "<br>";
            }
        } elseif (strcmp($res, "INVALID") == 0) {
            $file = 'paypalError_'.time().rand(9,9999).'.txt';
            $x = 'error';
            file_put_contents($file, $x);
        }
        header("HTTP/1.1 200 OK");
    }
    public function signup_paypal_notify()
    {
        
        $file = 'paypal_'.time().rand(9,9999).'.txt';
        $x = serialize($_POST);
        file_put_contents($file, $x);
        //paypal_16205012111000.txt
        // $x = file_get_contents('paypal_16232194844410.txt');
        $y = unserialize($x);
        // echo "<pre>"; 
        // print_r($y);die;
        
        $this->load->helper('commonmethods_helper');
        /*sendmail([
            'to'=>'shakil147258@gmail.com',
            'subject'=>'subject',
            'message'=>json_encode($_POST),
        ]);*/
        
        $req = 'cmd=_notify-validate';
        //mail("ai.shobujice@gmail.com","My subject","Message Description");
        foreach($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value);
            $req .= "&$key=$value";
        }
        

        reset($_POST);
        $datas = print_r($_POST, true);
        // echo "<pre>";print_r($_POST);die();
        //mail("ai.shobujice@gmail.com","My subject",$datas);
        //die();
        /* save payer info to database */

        //$data['UserId'] = $_POST['custom'];
        $userId_courseId = explode(',', $y['custom']);
        $data['user_id'] = $userId_courseId[0];
        //check for student/parent
        $courseID = $data['user_id'];
        $check_student = $this->db->where('id',$data['user_id'])->get('tbl_useraccount')->row();
        
        
        
        if ($check_student->user_type == 6) {
          $data['user_id']=$userId_courseId[0];
        }else{
          $data['user_id']=$userId_courseId[0];
        }
        
        $data['PaymentDate'] = time();
        $paymentType = $userId_courseId[1];
        if ($paymentType == 1) {
            $second = 30 * 24 * 3600;
            //$second = 24 * 3600;
        } elseif ($paymentType == 2) {
            $second = 30 * 6 * 24 * 3600;
        } elseif ($paymentType == 3) {
            $second = 30 * 12 * 24 * 3600;
        }elseif ($paymentType == 4) {
            $second = 30 * 3 * 24 * 3600;
        }
        $endDate =  $data['PaymentDate'] + $second;
        $date = date('Y-m-d',$endDate);
        
        //echo $date;die();
        $data['PaymentEndDate'] = $data['PaymentDate'] + $second;
        $data['total_cost']     = $y['mc_gross'];
       // $data['PackageId'] = $y['item_number'];
        $data['payment_status'] = $y['payment_status'];
        $data['SenderEmail']    = $y['payer_email'];
        $data['paymentType']    = 2; //maybe paypal
        $data['subscriptionId'] = $y['subscr_id'];
        $data['customerId']     = $y['payer_id'];
        $data['payment_duration'] = $userId_courseId[1];
        $data['invoiceId']      = $y['txn_id']; 
        
        $check_tnx = $this->db->where('invoiceId',$data['invoiceId'])->get('tbl_payment')->result_array();
        if (count($check_tnx) > 0 ){
            echo "match invoice";die();
        }
        
        array_shift($userId_courseId);
        array_shift($userId_courseId);
        

        $instra = print_r($data, true);
        

        $ch = curl_init('https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        
        if (!($res = curl_exec($ch))) {
            // error_log("Got " . curl_error($ch) . " when processing IPN data");
            curl_close($ch);
            exit;
        }
        curl_close($ch);
        
        //echo "<pre>";print_r(strcmp($res, "VERIFIED"));die;
        // inspect IPN validation result and act accordingly
        if (strcmp($res, "VERIFIED") == 0){
            
            $userID = $data['user_id'];
           
            $this->db->insert('tbl_payment', $data);
            $paymentId=$this->db->insert_id();
            $today_timestamp = time();
            if ($userId_courseId) {
                foreach ($userId_courseId as $dacourseId) {
                  $pay['paymentId']= $paymentId;
                  $pay['courseId'] = $dacourseId;
                  $this->db->insert('tbl_payment_details', $pay);
                }
                
                $this->db->where('user_id',$courseID)->where('endTime <',$today_timestamp)->update('tbl_registered_course',['status'=>0]);
                
                foreach ($userId_courseId as $singleCourse) {
                    $course['course_id'] = $singleCourse;
                    $rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
                    $course['cost']    = $rs_course_cost[0]['courseCost'];
                    $course['user_id'] = $courseID;
                    $course['created'] = time();
                    $course['endTime'] = $endDate;
                    $this->RegisterModel->basicInsert('tbl_registered_course', $course);
                }
                
                
            }


            // echo "<pre>";print_r($data);die;
            
            $user_data['payment_status'] = $data['payment_status'];
            $user_data['subscription_type'] ='signup';
            if($check_student->end_subscription != null){
                $end_subscription = $check_student->end_subscription;
                if($date > $end_subscription){
                    $user_data['end_subscription']  = $date;
                }else{
                    $user_data['end_subscription']  = $end_subscription;
                }
            }else{
                
                $user_data['end_subscription']  = $date;
                
            }
            //$this->db->set('payment_status', $data['payment_status']);
            $this->db->where('id', $userID);
            $this->db->update('tbl_useraccount',$user_data);
            
            //check for student/parent
            if ($check_student->user_type == 6) {
              $this->db->where('id', $check_student->parent_id);
              $this->db->update('tbl_useraccount',$user_data);
              $this->session->set_userdata('userType', 6);
              
              $refUsers = $this->db->where('user_id',$check_student->id)->where('status',0)->get('tbl_referral_users')->row();
            
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
                     $ckrfuser['referral_point'] = $referralPoint + $old_referral_point;
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
                     $ckrfByuser['referral_point'] = $ref_taken_point + $old_referral_point;
                     $ckrfByuser['total_point']    = $ref_taken_point + $totalByPoint;
                     $this->db->where('user_id',$refferByUser)->update('product_poinits',$ckrfByuser);
                    }else{
                     $ckrfByuser['user_id'] = $refferByUser;
                     $ckrfByuser['referral_point'] = $ref_taken_point;
                     $ckrfByuser['total_point']    = $ref_taken_point;
                     $this->db->insert('product_poinits',$ckrfByuser);
                    }
    
                    $this->db->where('user_id',$check_student->id)->update('tbl_referral_users',['status' => 1]);
    
                   
                }
            }

            //insert payment info
            // IPN message values depend upon the type of notification sent.
            // To loop through the &_POST array and print the NV pairs to the screen:
            foreach ($y as $key => $value) {
                echo $key . " = " . $value . "<br>";
            }
        } elseif (strcmp($res, "INVALID") == 0) {
            $file = 'paypalError_'.time().rand(9,9999).'.txt';
            $x = 'error';
            file_put_contents($file, $x);
        }

        header("HTTP/1.1 200 OK");
    }

    public function signup_upper_paypal_notify()
    {
        
        $file = 'paypal_'.time().rand(9,9999).'.txt';
        $x = serialize($_POST);
        
        // $x = file_get_contents('paypal_16232194844410.txt');
        $y = unserialize($x);
        // echo "<pre>"; 
        // print_r($y);die;
        //file_put_contents($file, $y);
       
        $this->load->helper('commonmethods_helper');
        /*sendmail([
            'to'=>'shakil147258@gmail.com',
            'subject'=>'subject',
            'message'=>json_encode($_POST),
        ]);*/
        
        $req = 'cmd=_notify-validate';
        //mail("ai.shobujice@gmail.com","My subject","Message Description");
        foreach($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value);
            $req .= "&$key=$value";
        }
        

        reset($_POST);
        $datas = print_r($_POST, true);
        // echo "<pre>";print_r($_POST);die();
        //mail("ai.shobujice@gmail.com","My subject",$datas);
        //die();
        /* save payer info to database */

        //$data['UserId'] = $_POST['custom'];
        $userId_courseId = explode(',', $y['custom']);
        $data['user_id'] = $userId_courseId[0];
        //check for student/parent
        $courseID = $data['user_id'];
        file_put_contents($file, $data);
        $check_student = $this->db->where('id',$data['user_id'])->get('tbl_useraccount')->row();
        //$aaaaaaa = 'wwwwwwwwwww'.$check_student->user_type.'ssssssssss';
        file_put_contents($file, $check_student);
     
        
        
        if ($check_student->user_type == 6) {
            $data['user_id']=$check_student->id;
        }else if($check_student->user_type == 2){
            $data['user_id']=$check_student->id;
        }else{
            $data['user_id']=$userId_courseId[0];
        }
        
        $data['PaymentDate'] = time();
        $paymentType = $userId_courseId[1];
        if ($paymentType == 1) {
            $second = 30 * 24 * 3600;
            //$second = 24 * 3600;
        } elseif ($paymentType == 2) {
            $second = 30 * 6 * 24 * 3600;
        } elseif ($paymentType == 3) {
            $second = 30 * 12 * 24 * 3600;
        }elseif ($paymentType == 4) {
            $second = 30 * 3 * 24 * 3600;
        }
        $endDate =  $data['PaymentDate'] + $second;
        $date = date('Y-m-d',$endDate);
        
        //echo $date;die();
        $data['PaymentEndDate'] = $data['PaymentDate'] + $second;
        $data['total_cost']     = $y['mc_gross'];
       // $data['PackageId'] = $y['item_number'];
        $data['payment_status'] = $y['payment_status'];
        $data['SenderEmail']    = $y['payer_email'];
        $data['paymentType']    = 2; //maybe paypal
        $data['subscriptionId'] = $y['subscr_id'];
        $data['customerId']     = $y['payer_id'];
        $data['payment_duration'] = $userId_courseId[1];
        $data['invoiceId']      = $y['txn_id']; 
        
        $check_tnx = $this->db->where('invoiceId',$data['invoiceId'])->get('tbl_payment')->result_array();
        if (count($check_tnx) > 0 ){
            echo "match invoice";die();
        }
        
        array_shift($userId_courseId);
        array_shift($userId_courseId);
        

        $instra = print_r($data, true);
        

        $ch = curl_init('https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        
        if (!($res = curl_exec($ch))) {
            // error_log("Got " . curl_error($ch) . " when processing IPN data");
            curl_close($ch);
            exit;
        }
        curl_close($ch);
        
        //echo "<pre>";print_r(strcmp($res, "VERIFIED"));die;
        // inspect IPN validation result and act accordingly
        if (strcmp($res, "VERIFIED") == 0){
            
            $userID = $data['user_id'];
           
            $this->db->insert('tbl_payment', $data);
            $paymentId=$this->db->insert_id();
            $today_timestamp = time();
            if ($userId_courseId) {
                foreach ($userId_courseId as $dacourseId) {
                  $pay['paymentId']= $paymentId;
                  $pay['courseId'] = $dacourseId;
                  $this->db->insert('tbl_payment_details', $pay);
                }
                
                $this->db->where('user_id',$courseID)->where('endTime <',$today_timestamp)->update('tbl_registered_course',['status'=>0]);
                
                foreach ($userId_courseId as $singleCourse) {
                    $course['course_id'] = $singleCourse;
                    $rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
                    $course['cost']    = $rs_course_cost[0]['courseCost'];
                    $course['user_id'] = $courseID;
                    $course['created'] = time();
                    $course['endTime'] = $endDate;
                    $this->RegisterModel->basicInsert('tbl_registered_course', $course);
                }
                
                
            }


            // echo "<pre>";print_r($data);die;
            
            $user_data['payment_status'] = $data['payment_status'];
            $user_data['subscription_type'] ='signup';
            if($check_student->end_subscription != null){
                $end_subscription = $check_student->end_subscription;
                if($date > $end_subscription){
                    $user_data['end_subscription']  = $date;
                }else{
                    $user_data['end_subscription']  = $end_subscription;
                }
            }else{
                
                $user_data['end_subscription']  = $date;
                
            }
            //$this->db->set('payment_status', $data['payment_status']);
            $this->db->where('id', $userID);
            $this->db->update('tbl_useraccount',$user_data);
            
            //check for student/parent
            if ($check_student->user_type == 6) {
                $this->db->where('id', $check_student->parent_id);
                $this->db->update('tbl_useraccount',$user_data);
                $this->session->set_userdata('userType', 6);
              
                $refUsers = $this->db->where('user_id',$check_student->id)->where('status',0)->get('tbl_referral_users')->row();
            
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
                     $ckrfuser['referral_point'] = $referralPoint + $old_referral_point;
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
                     $ckrfByuser['referral_point'] = $ref_taken_point + $old_referral_point;
                     $ckrfByuser['total_point']    = $ref_taken_point + $totalByPoint;
                     $this->db->where('user_id',$refferByUser)->update('product_poinits',$ckrfByuser);
                    }else{
                     $ckrfByuser['user_id'] = $refferByUser;
                     $ckrfByuser['referral_point'] = $ref_taken_point;
                     $ckrfByuser['total_point']    = $ref_taken_point;
                     $this->db->insert('product_poinits',$ckrfByuser);
                    }
    
                    $this->db->where('user_id',$check_student->id)->update('tbl_referral_users',['status' => 1]);
                }
            }else if($check_student->user_type == 2){
                $this->db->where('id', $check_student->id);
                $this->db->update('tbl_useraccount',$user_data);
                $this->session->set_userdata('userType', 2);
              
                $refUsers = $this->db->where('user_id',$check_student->id)->where('status',0)->get('tbl_referral_users')->row();
            
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
                     $ckrfuser['referral_point'] = $referralPoint + $old_referral_point;
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
                     $ckrfByuser['referral_point'] = $ref_taken_point + $old_referral_point;
                     $ckrfByuser['total_point']    = $ref_taken_point + $totalByPoint;
                     $this->db->where('user_id',$refferByUser)->update('product_poinits',$ckrfByuser);
                    }else{
                     $ckrfByuser['user_id'] = $refferByUser;
                     $ckrfByuser['referral_point'] = $ref_taken_point;
                     $ckrfByuser['total_point']    = $ref_taken_point;
                     $this->db->insert('product_poinits',$ckrfByuser);
                    }
    
                    $this->db->where('user_id',$check_student->id)->update('tbl_referral_users',['status' => 1]);
                }
            }

            //insert payment info
            // IPN message values depend upon the type of notification sent.
            // To loop through the &_POST array and print the NV pairs to the screen:
            foreach ($y as $key => $value) {
                echo $key . " = " . $value . "<br>";
            }
        } elseif (strcmp($res, "INVALID") == 0) {
            $file = 'paypalError_'.time().rand(9,9999).'.txt';
            $x = 'error';
            file_put_contents($file, $x);
        }
        header("HTTP/1.1 200 OK");
    }
    
    public function no_debit_paypal_notify()
    {

        $file = 'paypalnd_'.time().rand(9,9999).'.txt';
        $file2 = 'paypal/paypal222_'.time().rand(9,9999).'.txt';
        $file3 = 'paypal/paypal333_'.time().rand(9,9999).'.txt';

        $x = serialize($_POST);
        file_put_contents($file, $x);
        // $x = file_get_contents('paypalnd_16223752966217.txt');
        $y = unserialize($x);
        // echo "<pre>";
        // print_r($y);
        
        $this->load->helper('commonmethods_helper');
        /*sendmail([
            'to'=>'shakil147258@gmail.com',
            'subject'=>'subject',
            'message'=>json_encode($_POST),
        ]);*/
        
        $req = 'cmd=_notify-validate';
        //mail("ai.shobujice@gmail.com","My subject","Message Description");
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value);
            $req .= "&$key=$value";
        }

        reset($_POST);
        $datas = print_r($_POST, true);
        //mail("ai.shobujice@gmail.com","My subject",$datas);
        $userId_courseId=explode(',', $y['custom']);
        $data['user_id']=$userId_courseId[0];
        //check for student/parent
        $courseID = $data['user_id'];
        $check_student = $this->db->where('id',$data['user_id'])->get('tbl_useraccount')->row();
        if ($check_student->user_type == 6) {
          $data['user_id']=$check_student->id;
        }else{
          $data['user_id']=$userId_courseId[0];
        }
        
        $data['PaymentDate'] = time();
        $paymentType = $userId_courseId[1];
        if ($paymentType == 1) {
            $second = 30 * 24 * 3600;
            //$second = 24 * 3600;
        } elseif ($paymentType == 2) {
            $second = 30 * 6 * 24 * 3600;
        } elseif ($paymentType == 3) {
            $second = 30 * 12 * 24 * 3600;
        }elseif ($paymentType == 4) {
            $second = 30 * 3 * 24 * 3600;
        }

        $endDate =  $data['PaymentDate'] + $second;
        $date = date('Y-m-d',$endDate);
        $data['PaymentEndDate'] = $data['PaymentDate'] + $second;
        $data['total_cost']     = $y['mc_gross'];
       // $data['PackageId'] = $y['item_number'];
        $data['payment_status'] = $y['payment_status'];
        $data['SenderEmail']    = $y['payer_email'];
        $data['paymentType']    = 2; //maybe paypal
        $data['subscriptionId'] = 'No Debit';
        $data['customerId']     = $y['payer_id'];
        $data['payment_duration'] = $userId_courseId[1];
        $data['invoiceId']      = $y['txn_id']; 
        // echo "<pre>"; print_r($data);die();
        
        $check_tnx = $this->db->where('invoiceId',$data['invoiceId'])->get('tbl_payment')->result_array();
        if (count($check_tnx) > 0 ){
            echo "match invoice";die();
        }
        
        array_shift($userId_courseId);
        array_shift($userId_courseId);
        

        $instra = print_r($data, true);
        

        $ch = curl_init('https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        
        if (!($res = curl_exec($ch))) {
            // error_log("Got " . curl_error($ch) . " when processing IPN data");
            curl_close($ch);
            exit;
        }
        curl_close($ch);
        
        //   echo "<pre>"; 
        //   print_r($userId_courseId);
        //   die();
        // inspect IPN validation result and act accordingly



        $rs_course = $userId_courseId;
		$register_courses = $this->db->select('course_id')->where('user_id',$data['user_id'])->where('cost <>',0)->where('endTime >',time())->group_by('course_id')->get('tbl_registered_course')->result_array();
		$registerCourse = [];
		foreach($register_courses as $key => $course){
			$registerCourse[$key] = $course['course_id'];
		}
		
	
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

        // $aa = $total_course.'//'.$total_registered_course.'//'.$course_matched.'//'.$sub_end_date;
        // file_put_contents($file2, $rs_course);
        // file_put_contents($file3, $registerCourse);


        if (strcmp($res, "VERIFIED") == 0) {
            $this->db->insert('tbl_payment', $data);
            $paymentId=$this->db->insert_id();
            $today_timestamp = time();
            if ($userId_courseId != null) {
                foreach ($userId_courseId as $dacourseId) {
                      $pay['paymentId']=$paymentId;
                      $pay['courseId'] =$dacourseId;
                      $this->db->insert('tbl_payment_details', $pay);
                }

                $this->db->where('user_id',$courseID)->where('endTime <',$today_timestamp)->update('tbl_registered_course',['status'=>0]);

                foreach ($userId_courseId as $singleCourse) {
                    $course['course_id'] = $singleCourse;
                    $rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
                    $course['cost']    = $rs_course_cost[0]['courseCost'];
                    $course['user_id'] = $courseID;
                    $course['created'] = time();
                    $course['endTime'] = $endDate;
                    $this->RegisterModel->basicInsert('tbl_registered_course', $course);
                }
                
            }


            //$instra = print_r($data, true);
            //$notification_msg = 'Your Subscription with the Payment of $' .$_POST['mc_gross']. ' for the Package of '.$package_info[0]['PackageName'].' is complete';
            $user_data['payment_status'] = $data['payment_status'];
            $user_data['subscription_type'] ='signup';
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
            }else{
                
                $user_data['end_subscription']  = $sub_end_date;
                
            }
            
            
            $userID = $data['user_id'];
            //$this->db->set('payment_status', $data['payment_status']);
            $this->db->where('id',$userID)->update('tbl_useraccount',$user_data);

            
            //check for student/parent
            if ($check_student->user_type == 6) {
              $this->db->where('id', $check_student->parent_id);
              $this->db->update('tbl_useraccount',$user_data);
              $this->session->set_userdata('userType', 6);
              
              $refUsers = $this->db->where('user_id',$check_student->id)->where('status',0)->get('tbl_referral_users')->row();
            
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
                     $ckrfuser['referral_point'] = $referralPoint + $old_referral_point;
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
                     $ckrfByuser['referral_point'] = $referralPoint + $old_referral_point;
                     $ckrfByuser['total_point']    = $ref_taken_point + $totalByPoint;
                     $this->db->where('user_id',$refferByUser)->update('product_poinits',$ckrfByuser);
                    }else{
                     $ckrfByuser['user_id'] = $refferByUser;
                     $ckrfByuser['referral_point'] = $ref_taken_point;
                     $ckrfByuser['total_point']    = $ref_taken_point;
                     $this->db->insert('product_poinits',$ckrfByuser);
                    }
    
                    $this->db->where('user_id',$check_student->id)->update('tbl_referral_users',['status' => 1]);
    
                   
                }
            }

            //insert payment info
            // IPN message values depend upon the type of notification sent.
            // To loop through the &_POST array and print the NV pairs to the screen:
            foreach ($y as $key => $value) {
                echo $key . " = " . $value . "<br>";
            }
        } elseif (strcmp($res, "INVALID") == 0) {
        }

        header("HTTP/1.1 200 OK");
    }
    public function signup_no_debit_paypal_notify()
    {

        $file = 'paypal/paypalnd_'.time().rand(9,9999).'.txt';
        $x = serialize($_POST);

        
        // $x = file_get_contents('paypalnd_16223752966217.txt');
        $y = unserialize($x);
        // echo "<pre>"; 
        // print_r($y);
        
        $this->load->helper('commonmethods_helper');
        /*sendmail([
            'to'=>'shakil147258@gmail.com',
            'subject'=>'subject',
            'message'=>json_encode($_POST),
        ]);*/
        
        $req = 'cmd=_notify-validate';
        //mail("ai.shobujice@gmail.com","My subject","Message Description");
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value);
            $req .= "&$key=$value";
        }

        reset($_POST);
        $datas = print_r($_POST, true);
        //mail("ai.shobujice@gmail.com","My subject",$datas);
        $userId_courseId=explode(',', $y['custom']);
        $data['user_id']=$userId_courseId[0];
        //file_put_contents($file, $data);
        //check for student/parent
        $courseID = $data['user_id'];
        $check_student = $this->db->where('id',$data['user_id'])->get('tbl_useraccount')->row();
        // $aaaaaa =  'aaaaaa'.$check_student->user_type.'vvvvv';
         file_put_contents($file, $check_student->id);
        if ($check_student->user_type == 6) {
          $data['user_id']=$check_student->id;
        }else if($check_student->user_type == 2){
          $data['user_id']=$check_student->id;
        }else{
          $data['user_id']=$userId_courseId[0];
        }
        
        $data['PaymentDate'] = time();
        $paymentType = $userId_courseId[1];
        if ($paymentType == 1) {
            $second = 30 * 24 * 3600;
            //$second = 24 * 3600;
        } elseif ($paymentType == 2) {
            $second = 30 * 6 * 24 * 3600;
        } elseif ($paymentType == 3) {
            $second = 30 * 12 * 24 * 3600;
        }elseif ($paymentType == 4) {
            $second = 30 * 3 * 24 * 3600;
        }
        $endDate =  $data['PaymentDate'] + $second;
        $date = date('Y-m-d',$endDate);
        $data['PaymentEndDate'] = $data['PaymentDate'] + $second;
        $data['total_cost']     = $y['mc_gross'];
       // $data['PackageId'] = $y['item_number'];
        $data['payment_status'] = $y['payment_status'];
        $data['SenderEmail']    = $y['payer_email'];
        $data['paymentType']    = 2; //maybe paypal
        $data['subscriptionId'] = 'No Debit';
        $data['customerId']     = $y['payer_id'];
        $data['payment_duration'] = $userId_courseId[1];
        $data['invoiceId']      = $y['txn_id']; 
        // echo "<pre>"; print_r($data);die();
        
        $check_tnx = $this->db->where('invoiceId',$data['invoiceId'])->get('tbl_payment')->result_array();
        if (count($check_tnx) > 0 ){
            echo "match invoice";die();
        }
        
        array_shift($userId_courseId);
        array_shift($userId_courseId);
        

        $instra = print_r($data, true);
        

        $ch = curl_init('https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        
        if (!($res = curl_exec($ch))) {
            // error_log("Got " . curl_error($ch) . " when processing IPN data");
            curl_close($ch);
            exit;
        }
        curl_close($ch);
        
        //   echo "<pre>"; 
        //   print_r($userId_courseId);
        //   die();
        // inspect IPN validation result and act accordingly
        if (strcmp($res, "VERIFIED") == 0) {
            $this->db->insert('tbl_payment', $data);
            $paymentId=$this->db->insert_id();
            $today_timestamp = time();
            if ($userId_courseId != null) {
                foreach ($userId_courseId as $dacourseId) {
                      $pay['paymentId']=$paymentId;
                      $pay['courseId'] =$dacourseId;
                      $this->db->insert('tbl_payment_details', $pay);
                }

                $this->db->where('user_id',$courseID)->where('endTime <',$today_timestamp)->update('tbl_registered_course',['status'=>0]);

                foreach ($userId_courseId as $singleCourse) {
                    $course['course_id'] = $singleCourse;
                    $rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
                    $course['cost']    = $rs_course_cost[0]['courseCost'];
                    $course['user_id'] = $courseID;
                    $course['created'] = time();
                    $course['endTime'] = $endDate;
                    $this->RegisterModel->basicInsert('tbl_registered_course', $course);
                }
                
            }


            //$instra = print_r($data, true);
            //$notification_msg = 'Your Subscription with the Payment of $' .$_POST['mc_gross']. ' for the Package of '.$package_info[0]['PackageName'].' is complete';
            $user_data['payment_status'] = $data['payment_status'];
            $user_data['subscription_type'] ='signup';
            
            if($check_student->end_subscription != null){
                $end_subscription = $check_student->end_subscription;
                if($date > $end_subscription){
                    $user_data['end_subscription']  = $date;
                }else{
                    $user_data['end_subscription']  = $end_subscription;
                }
            }else{
                $user_data['end_subscription']  = $date;
            }
            
            
            $userID = $data['user_id'];
            //$this->db->set('payment_status', $data['payment_status']);
            $this->db->where('id',$userID)->update('tbl_useraccount',$user_data);

            
            //check for student/parent
            if ($check_student->user_type == 6) {
              $this->db->where('id', $check_student->parent_id);
              $this->db->update('tbl_useraccount',$user_data);
              $this->session->set_userdata('userType', 6);
              
              $refUsers = $this->db->where('user_id',$check_student->id)->where('status',0)->get('tbl_referral_users')->row();
            
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
                     $ckrfuser['referral_point'] = $referralPoint + $old_referral_point;
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
                     $ckrfByuser['referral_point'] = $referralPoint + $old_referral_point;
                     $ckrfByuser['total_point']    = $ref_taken_point + $totalByPoint;
                     $this->db->where('user_id',$refferByUser)->update('product_poinits',$ckrfByuser);
                    }else{
                     $ckrfByuser['user_id'] = $refferByUser;
                     $ckrfByuser['referral_point'] = $ref_taken_point;
                     $ckrfByuser['total_point']    = $ref_taken_point;
                     $this->db->insert('product_poinits',$ckrfByuser);
                    }
    
                    $this->db->where('user_id',$check_student->id)->update('tbl_referral_users',['status' => 1]);
    
                   
                }
            }else if($check_student->user_type == 2){
                $this->db->where('id', $check_student->id);
                $this->db->update('tbl_useraccount',$user_data);
                $this->session->set_userdata('userType', 2);
              
                $refUsers = $this->db->where('user_id',$check_student->id)->where('status',0)->get('tbl_referral_users')->row();
            
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
                     $ckrfuser['referral_point'] = $referralPoint + $old_referral_point;
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
                     $ckrfByuser['referral_point'] = $ref_taken_point + $old_referral_point;
                     $ckrfByuser['total_point']    = $ref_taken_point + $totalByPoint;
                     $this->db->where('user_id',$refferByUser)->update('product_poinits',$ckrfByuser);
                    }else{
                     $ckrfByuser['user_id'] = $refferByUser;
                     $ckrfByuser['referral_point'] = $ref_taken_point;
                     $ckrfByuser['total_point']    = $ref_taken_point;
                     $this->db->insert('product_poinits',$ckrfByuser);
                    }
    
                    $this->db->where('user_id',$check_student->id)->update('tbl_referral_users',['status' => 1]);
                }
            }

            //insert payment info
            // IPN message values depend upon the type of notification sent.
            // To loop through the &_POST array and print the NV pairs to the screen:
            foreach ($y as $key => $value) {
                echo $key . " = " . $value . "<br>";
            }
        } elseif (strcmp($res, "INVALID") == 0) {
        }

        header("HTTP/1.1 200 OK");
    }

    public function no_debit_paypal_notify_qusStore()
    {
        
        $file = 'paypalnd_'.time().rand(9,9999).'.txt';
        $x = serialize($_POST);
        file_put_contents($file, $x);
        // $x = file_get_contents('paypalnd_16213302463664.txt');
        $y = unserialize($x);
        echo "<pre>"; 
        //print_r($y);die;
        
        $this->load->helper('commonmethods_helper');
        
        $req = 'cmd=_notify-validate';
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value);
            $req .= "&$key=$value";
        }

        reset($_POST);
        $datas = print_r($_POST, true);
        /* save payer info to database */

        //$data['UserId'] = $_POST['custom'];
        $userId_courseId=explode(',', $y['custom']);
        $data['user_id']=$userId_courseId[0];
        //check for student/parent
        $check_student = $this->db->where('id',$data['user_id'])->get('tbl_useraccount')->row();
        if ($check_student->user_type == 6) {
          $data['user_id']=$check_student->id;
        }else{
          $data['user_id']=$userId_courseId[0];
        }
        
        $data['PaymentDate'] = time();
        $paymentType = $userId_courseId[1];
        $resource_sbject = $userId_courseId[2];
        if ($paymentType == 1) {
            $second = 30 * 24 * 3600;
            //$second = 24 * 3600;
        } elseif ($paymentType == 2) {
            $second = 30 * 6 * 24 * 3600;
        } elseif ($paymentType == 3) {
            $second = 30 * 12 * 24 * 3600;
        }
        $endDate =  $data['PaymentDate'] + $second;
        $date = date('Y-m-d',$endDate);
        //echo $date;die();
        $data['PaymentEndDate'] = $data['PaymentDate'] + $second;
        $data['total_cost']     = $y['mc_gross'];
       // $data['PackageId'] = $y['item_number'];
        $data['payment_status'] = $y['payment_status'];
        $data['SenderEmail']    = $y['payer_email'];
        $data['paymentType']    = 2; //maybe paypal
        $data['subscriptionId'] = 'No Debit';
        $data['customerId']     = $y['payer_id'];
        $data['payment_duration'] = $userId_courseId[1];
        $data['invoiceId']      = $y['txn_id']; 
        $data['subject']        = $resource_sbject; 
        
        
        
        //   echo "<pre>"; 
        //   print_r($data);
        //   die();
        $check_tnx = $this->db->where('invoiceId',$data['invoiceId'])->get('tbl_qs_payment')->result_array();
        if (count($check_tnx) > 0 ){
            echo "match invoice";die();
        }
        

        $instra = print_r($data, true);
        
        $ch = curl_init('https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        $res = curl_exec($ch);
        
        
        if (!($res = curl_exec($ch))) {
            // error_log("Got " . curl_error($ch) . " when processing IPN data");
            curl_close($ch);
            exit;
        }
        curl_close($ch);
            
        $this->db->insert('tbl_qs_payment', $data);
        $paymentId=$this->db->insert_id();
        
        // inspect IPN validation result and act accordingly
        if (strcmp($res, "VERIFIED") == 0) {

            //insert payment info
            // IPN message values depend upon the type of notification sent.
            // To loop through the &_POST array and print the NV pairs to the screen:
            foreach ($y as $key => $value) {
                echo $key . " = " . $value . "<br>";
            }
        } elseif (strcmp($res, "INVALID") == 0) {
        }

        header("HTTP/1.1 200 OK");
    }
    
    
    public function direct_debit_paypal_notify_qusStore()
    {
        
        $file = 'paypalQus_'.time().rand(9,9999).'.txt';
        $x = serialize($_POST);
        file_put_contents($file, $x);
        // $x = file_get_contents('paypal_16232194844410.txt');
        $y = unserialize($x);
        // echo "<pre>"; print_r($y);die;
        
        $this->load->helper('commonmethods_helper');
        /*sendmail([
            'to'=>'shakil147258@gmail.com',
            'subject'=>'subject',
            'message'=>json_encode($_POST),
        ]);*/
        
        $req = 'cmd=_notify-validate';
        //mail("ai.shobujice@gmail.com","My subject","Message Description");
        foreach($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value);
            $req .= "&$key=$value";
        }
        

        reset($_POST);
        $datas = print_r($_POST, true);
        
        $userId_courseId = explode(',', $y['custom']);
        $data['user_id'] = $userId_courseId[0];
        //check for student/parent
        $courseID = $data['user_id'];
        $check_student = $this->db->where('id',$data['user_id'])->get('tbl_useraccount')->row();
        
        
        if ($check_student->user_type == 6) {
          $data['user_id']=$userId_courseId[0];
        }else{
          $data['user_id']=$userId_courseId[0];
        }
        
        $data['PaymentDate'] = time();
        $paymentType = $userId_courseId[1];
        $resource_sbject = $userId_courseId[2];
        if ($paymentType == 1) {
            $second = 30 * 24 * 3600;
            //$second = 24 * 3600;
        } elseif ($paymentType == 2) {
            $second = 30 * 6 * 24 * 3600;
        } elseif ($paymentType == 3) {
            $second = 30 * 12 * 24 * 3600;
        }elseif ($paymentType == 4) {
            $second = 30 * 3 * 24 * 3600;
        }
        $endDate =  $data['PaymentDate'] + $second;
        $date = date('Y-m-d',$endDate);
        
        $data['PaymentEndDate'] = $data['PaymentDate'] + $second;
        $data['total_cost']     = $y['mc_gross'];
        $data['payment_status'] = $y['payment_status'];
        $data['SenderEmail']    = $y['payer_email'];
        $data['paymentType']    = 2; //maybe paypal
        $data['subscriptionId'] = $y['subscr_id'];
        $data['customerId']     = $y['payer_id'];
        $data['payment_duration']= $userId_courseId[1];
        $data['invoiceId']      = $y['txn_id'];
        $data['subject']        = $resource_sbject;  
        
        
        $check_tnx = $this->db->where('invoiceId',$data['invoiceId'])->get('tbl_qs_payment')->result_array();
        if (count($check_tnx) > 0 ){
            echo "match invoice";die();
        }

        $instra = print_r($data, true);

        $ch = curl_init('https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        
        if (!($res = curl_exec($ch))) {
            // error_log("Got " . curl_error($ch) . " when processing IPN data");
            curl_close($ch);
            exit;
        }
        curl_close($ch);
        
        //echo "<pre>";print_r(strcmp($res, "VERIFIED"));die;
        // inspect IPN validation result and act accordingly
        if (strcmp($res, "VERIFIED") == 0){
            
            $this->db->insert('tbl_qs_payment', $data);
            $paymentId=$this->db->insert_id();

            //insert payment info
            // IPN message values depend upon the type of notification sent.
            // To loop through the &_POST array and print the NV pairs to the screen:
            foreach ($y as $key => $value) {
                echo $key . " = " . $value . "<br>";
            }
            
        } elseif (strcmp($res, "INVALID") == 0) {
            $file = 'paypalError_'.time().rand(9,9999).'.txt';
            $x = 'error';
            file_put_contents($file, $x);
        }

        header("HTTP/1.1 200 OK");
    }


    public function paypalRetrunNotification()
    {
        $data['pagetitle'] = 'Cancel Payment';
        $data['user_id'] = $_SESSION['user_id'];


        $this->load->view('admin_template/headerlink', $data);
        $this->load->view('admin_template/header');
        $this->load->view('lawyer/payment/success_payment_form', $data);
        $this->load->view('admin_template/footerlink');
    }

    public function paypalCancelNotification()
    {
        $data['pagetitle'] = 'Cancel Payment';
        $data['user_id'] = $_SESSION['user_id'];


        $this->load->view('admin_template/headerlink', $data);
        $this->load->view('admin_template/header');
        $this->load->view('lawyer/payment/cancel_payment_form', $data);
        $this->load->view('admin_template/footerlink');
    }

    /**
     * Cancel paypal subscription
     *
     * @return void
     */
    public function cancelSubscription()
    {
        $this->load->model('Admin_model');

        $loggedUserId = $this->session->userdata('user_id');
        if (!$loggedUserId) {
            redirect('/');
        }

        $userPaymentInfo = $this->Admin_model->search('tbl_payment', ['user_id'=>$loggedUserId]);
        
        if (count($userPaymentInfo)) {
            $profileId=$userPaymentInfo[0]['subscriptionId'];
            
            $user = "shakil124_api1.gmail.com";
            $secret = "69SYZWDVXT7G49J8";
            $signature = 'Amzw67HwFOe7PrZRlpTioAViKMi0AozU6gZFHlmdXLmaGNNe-p2iRJfc';

            $api_request =  'USER=' . urlencode($user)
                            .'&PWD=' . urlencode($secret)
                            .'&SIGNATURE=' . urlencode($signature)
                            .'&VERSION=76.0'
                            .'&METHOD=ManageRecurringPaymentsProfileStatus'
                            .'&PROFILEID=' . urlencode($profileId). '&ACTION=cancel';
            
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp'); // For live transactions, change to 'https://api-3t.paypal.com/nvp'

            curl_setopt($ch, CURLOPT_VERBOSE, 1);

            // Uncomment these to turn off server and peer verification
            //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 2);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);

            // Set the API parameters for this transaction
            curl_setopt($ch, CURLOPT_POSTFIELDS, $api_request);

            // Request response from PayPal
            $response = curl_exec($ch);
            
            // If no response was received from PayPal there is no point parsing the response
            
            if (! $response) {
                //die('Calling PayPal to change_subscription_status failed: ' . curl_error($ch) . '(' . curl_errno($ch) . ')');
                echo 'subscription not canceled';
            } else { //update useraccount and tbl_payment
                $this->Admin_model->updateInfo('tbl_useraccount', 'id', $loggedUserId, ['payment_status'=>'Incomplete']);
                $this->Admin_model->updateInfo('tbl_payment', 'user_id', $loggedUserId, ['payment_status'=>'Incomplete']);
                $this->session->set_flashdata('success_msg', 'Subscription Canceled');
                redirect('/');
            }
 
            curl_close($ch);
        } else {
            echo 'User has no payment info';
        }
    }
}
