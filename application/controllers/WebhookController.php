<?php
require_once('stripe-php-master/init.php');

class WebhookController extends CI_Controller {

    public function __construct() {
        parent::__construct();        
        $this->load->model('Student_model');
        $this->load->model('RegisterModel');
        $this->load->model('Login_model');
        $this->load->model('SettingModel');
        
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('upload');
        
    }


    public function stripeWebhook(){
        // require_once('vendor/autoload.php');
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        //\Stripe\Stripe::setApiKey('sk_test_jAPXgtZXk3BRrCAAkaHq1aD900fWkcMUuD');
		$sereet_key=$this->SettingModel->getStripeKey('seccreet');
        \Stripe\Stripe::setApiKey($sereet_key);
        // You can find your endpoint's secret in your webhook settings
        //$endpoint_secret = 'whsec_xHbiTrH1dEcjL7vaAUN4f2nDFvUofYTD';

        //echo $sereet_key;
        
        $file = 'stripe_'.time().rand(9,9999).'.txt';
        $payload = @file_get_contents('php://input');
        file_put_contents($file, $payload);
        $sig_header = $this->input->get_request_header('Stripe-Signature');
        $event = null;
        //$payload = file_get_contents('stripe_16122676309099.txt');
        $y = json_decode($payload);
        
        // echo "<pre>";print_r($y);die();
        // Handle the checkout.session.completed event
        if ($y->type == 'charge.succeeded') {
          $object = $y->data->object;

          $data['PaymentDate'] = time(); 
          $paymentDetails = $this->db->where('customerId',$object->customer)->order_by('id','desc')->limit(1)->get('tbl_payment')->row();

          // echo "<pre>";print_r($paymentDetails);die();
          $paymentType = $paymentDetails->payment_duration;
          $endDate     = $paymentDetails->PaymentEndDate;
          if($paymentType == 1){
            //$second = 30 * 24 * 3600;
            $second = 24 * 3600;
          }elseif($paymentType == 2){
            $second = 30 * 6 * 24 * 3600;
          }elseif($paymentType == 3){
            $second = 30 * 12 * 24 * 3600;
          }
          $data['user_id']        = $paymentDetails->user_id;
          $data['PaymentEndDate'] = $data['PaymentDate'] + $second;
          $data['total_cost']     = $object->amount;
          $data['payment_duration']=$paymentType;
          $data['payment_status'] = $object->status;
          $data['SenderEmail']    = $paymentDetails->SenderEmail;         
          $data['customerId']     = $object->customer;
          $data['subscriptionId'] = $paymentDetails->subscriptionId;
          $data['paymentType']    = 1;
          $data['invoiceId']      = $object->invoice;
          if (date('Y-m-d',$endDate) < date('Y-m-d') ) {
          //echo date('Y-m-d',$endDate);print_r($data);die();
            $this->db->insert('tbl_payment', $data);
          }
          if ($data['payment_status'] == 'succeeded') {
            $x = "Completed";
          }
           //echo "<pre>";print_r($data);die();
          $user_data['payment_status'] = $x;
          $user_data['subscription_type'] = 'signup';
          $sub_end_date = date('Y-m-d',$data['PaymentEndDate']);
          $user_data['end_subscription'] = $sub_end_date;

          if (date('Y-m-d',$endDate) < date('Y-m-d') ) {
            $this->db->where('id', $data['user_id']);
            $this->db->update('tbl_useraccount',$user_data);
            
            //check for student/parent
            $check_student = $this->db->where('id',$paymentDetails->user_id)->get('tbl_useraccount')->row();
            
            if ($check_student->user_type == 1) {
              $get_student_id = $this->db->where('parent_id',$paymentDetails->user_id)->get('tbl_useraccount')->row();
              $std_id = $get_student_id->id;
              $this->db->where('id', $std_id);
              $this->db->update('tbl_useraccount',$user_data);
            }
            http_response_code(200);
          }

        }
        http_response_code(200);      
    }

}
?>