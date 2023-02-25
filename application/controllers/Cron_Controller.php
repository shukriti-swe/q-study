<?php
require_once('stripe-php-master/init.php');


class Cron_Controller extends CI_Controller {

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

    public function subscription_mail()
    {
        //subscription  end
        $template = $this->RegisterModel->getInfo('table_email_template', 'email_template_type', 'Subscription Finish');
        $result = $this->Student_model->get_subs_data(date('Y-m-d') , 'signup');

        foreach ($result as $key => $value) {
            $mail_data['to'] = $value['user_email'];
            $mail_data['subject'] = $template[0]['email_template_subject'];
            ;
            $mail_data['message'] = $template[0]['email_template'];
            $this->sendEmail($mail_data);
        }

        
        // trail end

        $template = $this->RegisterModel->getInfo('table_email_template', 'email_template_type', 'Trail Finish');
        $trail_data = $this->Student_model->get_trail_data('trial');

        foreach ($trail_data as $key => $value) {
            $result = $this->Login_model->login_check_info_trail($value['user_email'], $value['user_pawd']);

            if ($result) {
                $trial =  $this->Login_model->trial();

                $total_time =  date("Y-m-d", strtotime( $trial[0]['setting_value']." day" , $result->created ));

                
                if (date("Y-m-d", strtotime("now"))  == $total_time ) {

                    $mail_data['to'] = $result->user_email;
                    $mail_data['subject'] = $template[0]['email_template_subject'];
                    ;
                    $mail_data['message'] = $template[0]['email_template'];
                    $this->sendEmail($mail_data);
                }
            }
        }
        
    }


    public function get_parent_those_child_not_attend_module() {
        $get_all_time_zone = $this->Student_model->get_all_time_zone();
        foreach ($get_all_time_zone as $zone){
            $new_get_all_time_zone[$zone['id']][] = $zone;
        }
        // echo '<pre>';print_r($new_get_all_time_zone);die;
        $get_parent = array();
        foreach ($new_get_all_time_zone as $row) {
            if($row[0]['countryCode'] == 'any') {
                $row[0]['zone_name'] = 'Australia/Lord_Howe';
            }
//            foreach ($val as $row){
            if($row[0]['zone_name'] != NULL) {
                $date = new DateTime("today 9pm", new DateTimeZone($row[0]['zone_name']));
                $date1 = new DateTime("now", new DateTimeZone($row[0]['zone_name']));

                $today_9pm_time = strtotime($date->format('Y-m-d H:i:s'));
                $now_time = strtotime($date1->format('Y-m-d H:i:s'));
                // echo $row[0]['id'].'<pre>';
                // echo 'Today 9PM: ';echo $date->format('Y-m-d H:i:s').'<pre>';
                // echo 'Now: ';echo $date1->format('Y-m-d H:i:s').'<pre>';
                if($now_time >= $today_9pm_time) {
//                    echo $row[0]['id'].'<pre>';
                    $get_parent[] = $this->Student_model->get_parent_with_children($row[0]['id'],$date->format('Y-m-d H:i:s'));
                }
            }
//            }
        }
        
        $new = array();
        foreach ($get_parent as $parent => $parent_val) {
           // echo '<pre>';
           // print_r($parent_val);
            foreach ($parent_val as $p_val){
                $new[$p_val['parentid']][] = $p_val;
            }
            
        }
        
        // echo '<pre>';
        // print_r($get_parent);
        // die();
        
        foreach ($new as $key => $val) {

            $sms_permission = $this->db->where('id',$val[0]['childid'])->get('tbl_useraccount')->row('sms_status_stop');
            echo "Test name:".$val[0]['child_name']."</br>";
            echo "Test ID:".$val[0]['childid']."</br>";
            echo "Test permission:".$sms_permission."</br>";
            //print_r($val);

            //die();
            if ($sms_permission == 0) {
                echo "ID:".$val[0]['child_name']."</br>";
                echo "ID:".$val[0]['childid']."</br>";
                echo $sms_permission;

                $fp = fopen(APPPATH.'/sms.txt','a+');
                fwrite($fp, $val[0]['child_name']." ".$val[0]['childid']."\r\n");
                fclose($fp);

                //die();
                $country_code = $this->Student_model->country_code(strtoupper($val[0]['countryCode']));
                $date1 = new DateTime("now", new DateTimeZone($country_code[0]['zone_name']));
                
                $is_student_answered_module = $this->Student_model->get_student_today_ans($val[0]['childid'],$date1->format('Y-m-d'));
                $is_send_msg = $this->Student_model->send_msg($key,$date1->format('Y-m-d'));
                
                 //  print_r($is_send_msg);
                if(is_array($is_send_msg) && count($is_send_msg) == 0 && !$is_student_answered_module) {
                
                    $settins_Api_key = $this->Student_model->getSmsApiKeySettings();
                    $settins_sms_messsage = $this->Student_model->get_sms_response_after_9pm();
                    
                    $api_key = $settins_Api_key[0]['setting_value'];
                    
                    $register_code_string = $settins_sms_messsage[0]['setting_value'];
                    $find = array("{{child_name}}");
                    $replace = array($val[0]['child_name']);
                    
                    $message = str_replace($find, $replace, $register_code_string);
                    
                    $content = urlencode($message);
                    
                    //$content = urlencode("Today ".$val[0]['child_name']." didn't attend Everyday Study until now");
                    $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=".$val[0]['parent_mobile']."&content=$content";

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
                    curl_setopt($ch, CURLOPT_VERBOSE, true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                    //execute post
                    $result = curl_exec($ch);
                    curl_close($ch);
                    
                    $send_msg_status = json_decode($result);
                    
                    if(count($send_msg_status->messages) > 0 && $send_msg_status->messages[0]->accepted == 1) {
                        $send_msg['parent_id'] = $key;
                        $send_msg['created_at'] = $date1->format('Y-m-d H:i:s');
                        $this->Student_model->insertInfo('user_send_msg', $send_msg);
                    }
                    
                }
            }
        }
        
    }

    public function sendEmail($mail_data)
    {
        $mailTo        =  $mail_data['to'];
        $mailSubject   =   $mail_data['subject'];
        $message       =   $mail_data['message'];

        $this->load->library('email');
        $this->email->set_mailtype('html');

        /*$config['protocol'] ='sendmail';
        $config['mailpath'] ='/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = true;*/
        $config['protocol']    = 'smtp';
        $config['smtp_crypto']    = 'ssl';
        $config['smtp_port']    = '465';
        $config['mailtype']    = 'text';
        $config['smtp_host']    = 'email-smtp.us-east-1.amazonaws.com';
        $config['smtp_user']    = 'AKIAJASMGQXCHUGFOX2A';
        $config['smtp_pass']    = 'AhQPyL02MEAjbohY82vZLikIwY1O2sU4sOrdI6vC3HYk';
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


    public function cancelSubscription(){
        $this->load->model('Admin_model');
        $today = new DateTime();
        $compare = $today->format('Y-m-d');
        $publish_key=$this->SettingModel->getStripeKey('publish');
        $sereet_key=$this->SettingModel->getStripeKey('seccreet');
        \Stripe\Stripe::setApiKey($sereet_key);
        
        $get_cancal_subscription = $this->db->where('end_subscription <',$compare)->get('tbl_cancel_subscription')->result_array();
            // echo "<pre>";print_r($get_cancal_subscription);die();

        foreach ($get_cancal_subscription as $key => $value) {
            $id = $value['user_id'];
            $subsID = $this->db->where('user_id',$id)->order_by('id','desc')->limit(1)->get('tbl_payment')->row();
            $subscriptionId = $subsID->subscriptionId;
            
            // cancel stripe subcription 
            if ($subsID->paymentType == 1 ) {
                try {
                    $retrieve = \Stripe\Subscription::retrieve($subscriptionId);
                    $retrieve->cancel(); 
                    $this->Admin_model->updateInfo('tbl_payment', 'subscriptionId', $subscriptionId, ['payment_status'=>'Cancel']);
                    $this->db->where('id', $value['id'])->delete('tbl_cancel_subscription');
                     echo 'Subscription Canceled';
                }catch(Exception $e) {
                  echo 'Message: ' .$e->getMessage();
                }
            }
            
            // cancel paypal subcription 
            if ($subsID->paymentType == 2) {
                
                $business_account = $this->SettingModel->getPaypalKey('business_account');
                $paypal_secret    = $this->SettingModel->getPaypalKey('paypal_secret');
                $paypal_signature = $this->SettingModel->getPaypalKey('paypal_signature');
				
                $user = $business_account;
                //$user = "ashadozzaman@sahajjo.com";
                $secret = $paypal_secret;
                //$secret = "EWDB3GEFH2JHYT3V";
                $signature = $paypal_signature;
                //$signature = 'AQJCtaN7Xv31h0261ixZd2P3S1EWAE-gor5mZ.kBZ13fch62dLdrL-9G';
                $api_request =  'USER=' . urlencode($user)
                                .'&PWD=' . urlencode($secret)
                                .'&SIGNATURE=' . urlencode($signature)
                                .'&VERSION=76.0'
                                .'&METHOD=ManageRecurringPaymentsProfileStatus'
                                .'&PROFILEID=' . urlencode($subscriptionId). '&ACTION=cancel';
                
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
                    $this->Admin_model->updateInfo('tbl_useraccount', 'id', $id, ['payment_status'=>'Cancel']);
                    $this->Admin_model->updateInfo('tbl_payment', 'subscriptionId', $subscriptionId, ['payment_status'=>'Cancel']);
                    $this->db->where('id', $value['id'])->delete('tbl_cancel_subscription');
                    echo 'subscription canceled';
                }
     
                curl_close($ch);
            }
           
        }

        
    }



}