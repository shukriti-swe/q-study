<?php


class Login extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        // $user_id = $this->session->userdata('id');
       //echo $role;die;
        // if($user_id != NULL){
            // redirect('dashboard');
        // }
        $this->load->model('login_model');
        $this->load->model('Student_model');
        $this->load->model('admin_model');
        $this->load->helper('commonmethods_helper');
    }

    public function loginChk()
    {
        $user_name = $this->input->post('user_name');
        $password = ($this->input->post('password'));
        $result = $this->login_model->login_check_info($user_name, $password);
        $m_data = array();
        
        if ($result) {
            if ($result->subscription_type == 'trial') {
                $trail_period = trailPeriod();
                $Date =  date("Y-m-d");
                $x = date('Y-m-d', $result->created);
                $y = strtotime($x. ' + '.$trail_period[0]['setting_value'].' days');

                if ($y <= strtotime( date('Y-m-d'))) {
                    $name_data = array();
                    $name_data['user_email'] = $result->user_email;
                    $name_data['user_id'] = $result->id;
                    $name_data['subscription_type'] = $result->subscription_type;
                    $name_data['payment_status'] = $result->payment_status;
                    $name_data['userType'] = $result->user_type;                    
                    $this->session->set_userdata($name_data);
                    echo 1;
                    //echo 2;
                }else{
                    $name_data = array();
                    $name_data['user_email'] = $result->user_email;
                    $name_data['user_id'] = $result->id;
                    $name_data['subscription_type'] = $result->subscription_type;
                    $name_data['payment_status'] = $result->payment_status;
                    $name_data['userType'] = $result->user_type;
                    
                    $this->session->set_userdata($name_data);
                    echo 1;
                }

            }else{
                $name_data = array();
                $name_data['user_email'] = $result->user_email;
                $name_data['user_id'] = $result->id;
                $name_data['subscription_type'] = $result->subscription_type;
                $name_data['payment_status'] = $result->payment_status;
                $name_data['userType'] = $result->user_type;
                
                $this->session->set_userdata($name_data);
                echo 1;
            }
            //if($name_data['subscription_type'] == 'signup' && $name_data['payment_status'] == '') {
                //echo 2;
            //} else {
             //   echo 1;
            //}
        } else {
            $error_msg = 0;
            echo $error_msg;
        }
    }


    public function parent_password_check(){
        $password = $this->input->post('password');
        $user_id = $this->session->userdata('user_id');
        $par = $this->db->where('id',$user_id)->get('tbl_useraccount')->row();
        $parent_id = $par->parent_id;
        $result = $this->login_model->parent_pw_check_info($parent_id, $password);
        echo $result;

    }


    /**
     * Forgot password form view
     * @return void
     */
    public function forgotPassView()
    {
        $this->load->view('auth/pass_reset/forgot_password');
    }

    /**
     * Responsible for sending reset password link to user email.
     * @return void
     */
    public function sendResetPassEmail()
    {

        //validate and check input email
        $email = $this->input->post('email') ? $this->input->post('email') : '';
        $userName = $this->admin_model->get_all_where('*', 'tbl_useraccount', 'user_email', $email);
    $random_number = rand(100, 999);
    $user_password = $userName[0]['name'].$random_number;
    //echo '<pre>';print_r($userName);die;
    $data['user_pawd'] = md5($user_password);
    $this->admin_model->updateInfo('tbl_useraccount', 'id', $userName[0]['id'], $data);
    
    if($userName[0]['user_type'] == 1 || $userName[0]['user_type'] == 4 || $userName[0]['user_type'] == 5) {
      $all_child_info = $this->admin_model->getInfo('tbl_useraccount', 'parent_id', $userName[0]['id']);
    }
    
    $child_list = array();
    if(isset($all_child_info) && !empty($all_child_info)){
      foreach ($all_child_info as $single_child) {
        $random_number = rand(100, 999);
        $raw_st_data['st_name'] = $single_child['user_email'];
                $raw_st_data['st_password'] = $single_child['user_email'].$random_number;
        $child['user_pawd'] = md5($raw_st_data['st_password']);
        $this->admin_model->updateInfo('tbl_useraccount', 'id', $single_child['id'], $child);
        
        $child_list[]=$raw_st_data;
      }
    }
    
        // $userName = isset($userName[0]['name'])?$userName[0]['name']:'';

        //unique authentication code for reset pass
        // $authCode = md5(uniqid(mt_rand(), true));
        // $resetLink =  base_url()."set_password/?authCode={$authCode}&email={$email}";
    
        // $templateData['user'] = $userName;
        // $templateData['resetLink'] = $resetLink;
        // $template = $this->load->view('email_templates/forgot_password', $templateData, true);
        
        // $data['to'] = $email;
        // $data['subject'] = 'Forgot password';
        // $data['message'] = $template;
        // sendMail($data);

        $this->mailTemplate($userName[0]['name'], $userName[0]['user_email'], $userName[0]['user_type'], $user_password, $child_list);

        $dataToUpdate = [
            'pass_reset_code' => $authCode,
        ];
        //saving the authcode while request for a reset link
        $this->Student_model->updateInfo('tbl_useraccount', 'user_email', $email, $dataToUpdate);
        $this->session->set_flashdata('success_msg', 'An email has been sent...');


        

        //username and password send

        $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
        $settins_sms_messsage = $this->admin_model->getSmsType("Forgot Password");

        $register_code_string = $settins_sms_messsage[0]['setting_value'];
        $message = str_replace( "{{ username }}" , $userName[0]['user_email'] , $register_code_string);
        $message = str_replace( "{{ password }}" , $user_password , $message);

        $api_key = $settins_Api_key[0]['setting_value'];
        $content = urlencode($message);

        $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $userName[0]['user_mobile'] . "&content=$content";

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
        // print_r($result);die;
        $send_msg_status = json_decode($result);


        redirect('/');
    }
  
  public function mailTemplate($parent_name, $parent_email, $user_type, $parent_password, $student_list)
    {
        
        $userName = $parent_name;
        $userEmail = $parent_email;
        $userPassword = $parent_password;
        
        $template = $this->admin_model->getInfo('table_email_template', 'email_template_type', 'forget_password');
        $child_number = sizeof($student_list);
        if ($template) {
            $subject = $template[0]['email_template_subject'];
            $template_message = $template[0]['email_template'];
          
            $st_data = '';
      
      if($child_number > 0){
        foreach ($student_list as $single_child) {
          $st_data .=
            "<div style='overflow:hidden ; margin-bottom:10px;'>
              <p style='margin-top:10px; text-align:left;'><strong>Student Limit {$child_number}:</strong></p>
              <div style='width:70%; float:left;  text-align:left;'>
                <p>Username</p>
                <p>{$single_child['st_name']}</p>
              </div>
              <div style='width:30%; float:left;  text-align:right;'>
                <p>Password</p>
                <p>{$single_child['st_password']}</p>
              </div>
            </div>";
        }
      }
      
      
        $find = array("{{student_block}}","{{parentName}}","{{parent_email}}","{{parent_password}}");
        $replace = array($st_data,$userName,$userEmail,$userPassword);
      
      
            // if($user_type == 2){
        // $find = array("{{upper_student_name}}","{{upper_student_email}}","{{upper_student_password}}");
        // $replace = array($Name,$email,$Password);
      // }
      
      // if($user_type == 3){
        // $find = array("{{tutorName}}","{{tutor_email}}","{{tutor_password}}","{{tutor_sct_link}}");
        // $replace = array($tutorName,$tutorEmail,$tutorPassword,$SCT_link);
      // }
      
      // if($user_type == 4){
        // $find = array("{{teacher_number}}","{{teacher_block}}","{{schoolName}}","{{school_email}}","{{school_password}}");
        // $replace = array($child_number,$st_data,$userName,$userEmail,$userPassword);
      // }
      // if($user_type == 5){
        // $find = array("{{teacher_number}}","{{teacher_block}}","{{corporateName}}","{{corporate_email}}","{{corporate_password}}");
        // $replace = array($child_number,$st_data,$userName,$userEmail,$userPassword);
      // }
      
            $message = str_replace($find, $replace, $template_message);
      
            $mail_data['to'] = $userEmail;
            $mail_data['subject'] = $template[0]['email_template_subject'];
            
            $mail_data['message'] = $message;
            $this->sendEmail($mail_data);
        }
    
        return true;
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


    /**
     * Save user requested password.
     * Update the user pass and blank the authcode as its used already.
     *
     * @return void [description]
     */
    public function saveNewPass()
    {

        $post = $this->input->post();

        if (!$post) {
            $arr['authCode'] = $_GET['authCode'];
            $arr['email'] = $_GET['email'];
            $this->load->view('auth/pass_reset/set_new_pass', $arr);
        } else {
            $pass            = $post['password'];
            $userEmail       = $post['email'];
            $currentAuthCode = $post['authCode'];
            $dataToUpdate    = [
                'user_pawd' => md5($pass),
                'pass_reset_code' => '',
            ];
            //if user exists and authCode matched then reset password & authcode
            $userInfo = $this->Student_model->getInfo('tbl_useraccount', 'user_email', $userEmail);
            if ($userInfo[0]['pass_reset_code']==$currentAuthCode) {
                $this->Student_model->updateInfo('tbl_useraccount', 'user_email', $userEmail, $dataToUpdate);
                $this->session->set_flashdata('success_msg', 'Password updated successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Your password doesn\'t changed !! Try another reset link');
            }

            redirect('/');
        }
    }

    /**
     * Check if a user email exists in DB or not
     * @return string  true=>exists, false=>not exists
     */
    public function emailCheck()
    {
        $email = $this->input->post('email');
        $emailExists = $this->login_model->emailCheck($email);
        if ($emailExists) {
                echo 'true'; //email exists
        } else {
            echo 'false'; //email not exists
        }
    }

    public function mailTest()
    {
        $this->load->library('email');
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.mailtrap.io',
            'smtp_port' => 2525,
            'smtp_user' => '84881ad6c84460',
            'smtp_pass' => 'f16b9599369195',
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'mailtype'=>'html',
        );
        /*$config['protocol'] = 'smtp';
            $config['smtp_host'] = 'smtp.mailtrap.io';
            $config['smtp_port'] = 2525;
            $config['smtp_user'] =  '84881ad6c84460';
        $config['smtp_pass'] =  'f16b9599369195';*/


        $this->email->initialize($config);

        $this->email->from('shakil147258@gmail.com'); // change it to yours
        $this->email->to('shakil147258@gmail.com');// change it to yours
        $this->email->subject('Resume from JobsBuddy for your Job posting');
        $this->email->message('hola madrid');
        $this->email->send();
        //mail('shakil147258@gmail.com', 'test', 'test msg');
        //echo 'sent';
        print_r($this->email->print_debugger(array('headers')));
    }

    public function phoneCheck()
    {

        $email = $this->input->post('phone');
        $emailExists = $this->login_model->phoneChk($email);

        if ($emailExists) {
            echo 1; 
        } else {
            echo 0; 
        }
    }

    public function passwdCheck()
    {

        $phone = $this->input->post('phone');
        $email = $this->input->post('email');

        $ck = $this->login_model->passwdChk($email , $phone );
        
        if ($ck) {
            echo 1; 
        } else {
            echo 0; 
        }
    }
  
}
