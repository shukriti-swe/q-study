<?php
defined('BASEPATH') or exit('No direct script access allowed');


class RegisterController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE));
        $this->load->library('form_validation');
        $this->load->model('RegisterModel');
        $this->load->model('admin_model');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));
        $this->load->model('SettingModel');
        $this->load->model('FaqModel'); // rakesh
    }
    
    
    // public function test(){
    //     $this->load->view('test');
    // }
    
    public function showSignUp()
    {

        $this->session->sess_destroy();
        $data['registration_slug_type']=$this->uri->segment(1);
        
        $data['user']=$this->RegisterModel->getUserType();
        $data['back_url'] = 'welcome';

        //rakesh
        if (strpos(current_url(), 'trial') == false) { 
            $data['video_help'] = $this->FaqModel->videoSerialize(1, 'video_helps');
            $data['video_help_serial'] = 1;
        } 
        else { 
            $data['video_help'] = $this->FaqModel->videoSerialize(5, 'video_helps');
            $data['video_help_serial'] = 5;
        } 
        
        $data['header']=$this->load->view('common/header', '', true);
        $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
        $data['footer']=$this->load->view('common/footer', '', true);
        $this->load->view('registration/signup', $data);

    }
    
    
    public function showSignUpPlan()
    {

        $registrationType=$this->uri->segment(1);
        $userTypeSlug=$this->uri->segment(2);
        
        $userTypeId=$this->RegisterModel->getSpecificUserType($userTypeSlug);
        $this->session->set_userdata('registrationType', $registrationType);
        $this->session->set_userdata('userType', $userTypeId[0]['id']);
        
        $data['back_url'] = base_url() . 'signup';
        if ($registrationType == 'trial') {
            $data['back_url'] = base_url() . 'trial';
        }
        
        $data['header']=$this->load->view('common/header', '', true);
        $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
        $data['footer']=$this->load->view('common/footer', '', true);
        
        $this->load->view('registration/sign_up_plan', $data);
    }
    
    public function selectCountry($registrationType  , $userType)
    {
        $_SESSION['userType'] = $userType;
        $_SESSION['registrationType'] = $registrationType;

        if (!$this->session->userdata('userType')) {
            redirect('/signup');
        } else {
            $data['country_db']=$this->RegisterModel->getCountry();
            $registrationType = $this->session->userdata('registrationType');
            $userType = $this->session->userdata('userType');
            if ($userType == 1) {
                $user = 'parent';
            } elseif ($userType == 2) {
                $user = 'upper_level_student';
            } elseif ($userType == 3) {
                $user = 'tutor';
            } elseif ($userType == 4) {
                $user = 'school';
            } elseif ($userType == 5) {
                $user = 'corporate';
            }


            if ($_SERVER['HTTP_REFERER'] == base_url('/signup')) {
                $data['back_url'] = $_SERVER['HTTP_REFERER'];
            }else{
                $data['back_url'] = base_url('/signup');
            }
            
            $data['header']=$this->load->view('common/header', '', true);
            $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
            $data['footer']=$this->load->view('common/footer', '', true);
            
            $this->load->view('registration/select_country', $data);
        }
    }
    
    public function selectCourse()
    {

        if ($this->input->post('submit')  == "submit")
        {
            // echo "<pre>";print_r($this->input->post());die();
        
            $course_data['courses'] =$this->input->post('course');
            $course_data['totalCost'] =$this->input->post('totalCost');
            $course_data['token'] =$this->input->post('token');
            $course_data['paymentType'] = $this->input->post('paymentType'); 
            $course_data['children'] = $this->input->post('children');

            if (!empty($this->input->post('direct_debit'))) {
                $course_data['payment_process'] = $this->input->post('direct_debit');
            }
            if (!empty($this->input->post('no_direct_debit'))) {
                $course_data['payment_process'] = $this->input->post('no_direct_debit');
            }
            if (!empty($this->input->post('direct_deposit'))) {
                $course_data['payment_process'] = $this->input->post('direct_deposit');
            }
            
            
            // echo "<pre>";print_r($course_data);die();
            // $tbl_payment = $this->db->where('user_id',$user_id)->order_by('id','desc')->limit(1)->get('tbl_payment')->row();
            // if($tbl_payment){
            //     $startDate = $tbl_payment->PaymentDate;
            //     $endDate   = $tbl_payment->PaymentEndDate;
            //     $total_cost   = $tbl_payment->total_cost;
            //     $today = time();
            //     if($endDate > $today){
            //         $diff = $endDate - $startDate;
            //         $remainingDiff = $endDate - $today;
            //         $totalDay = floor($diff/(60*60*24));
            //         $remainingDays = floor($remainingDiff/(60*60*24));
                    
            //         $perDayCost = $total_cost/$totalDay;
            //         $remainingCost = $remainingDays * $perDayCost;
            //         if($remainingCost > $this->input->post('totalCost')){
            //             $course_data['totalCost'] = 0;
            //         }else{
            //             $cost = $this->input->post('totalCost') - $remainingCost;
            //             $course_data['totalCost'] = $cost;
                        
            //         }
                    
            //     }
                
            //     $register_courses = $this->db->where('user_id',$user_id)->where('cost <>',0)->get('tbl_registered_course')->result_array();
            //     $registerCourse = [];
            //     foreach($register_courses as $key => $course){
            //         $registerCourse[$key] = $course['course_id'];
            //     }
                
            // }
            
            
            // echo $this->session->userdata('registrationType');
            // echo "<br>";
            // echo $this->session->userdata('userType');
           

            $this->session->set_userdata($course_data);

            if ($this->session->userdata('registrationType') == 'trial') {
                if ($this->session->userdata('userType')==1) {
                    redirect('/student_form');
                }elseif ($this->session->userdata('userType')==6) {
                    redirect('/student_form');
                } elseif ($this->session->userdata('userType')==2) {
                    redirect('/upper_level_student_form');
                } elseif ($this->session->userdata('userType')==3) {
                    redirect('/tutor_form');
                } elseif ($this->session->userdata('userType')==4) {
                    redirect('/school_form');
                } elseif ($this->session->userdata('userType')==5) {
                    redirect('/corporate_form');
                }
            }else if($this->session->userdata('registrationType') == 'signup'){
                if ($this->session->userdata('userType')==1) {
                    redirect('/signup_student_form');
                }elseif ($this->session->userdata('userType')==6) {
                    redirect('/signup_student_form');
                } elseif ($this->session->userdata('userType')==2) {
                    redirect('/signup_upper_level_student_form');
                } elseif ($this->session->userdata('userType')==3) {
                    redirect('/tutor_form');
                } elseif ($this->session->userdata('userType')==4) {
                    redirect('/school_form');
                } elseif ($this->session->userdata('userType')==5) {
                    redirect('/corporate_form');
                }
            }else{
                if ($course_data['payment_process'] == 3) {
                    redirect('/direct_deposit');                    
                }else{
                    redirect('/paypal_new');
                }
            }
        }






        if ( !empty($_SESSION['registrationType']) && $_SESSION['registrationType'] == "trial") { //rakesh
            $data['video_help'] = $this->FaqModel->videoSerialize(6, 'video_helps');
            $data['video_help_serial'] = 6;
        }else{
            $data['video_help'] = $this->FaqModel->videoSerialize(2, 'video_helps');
            $data['video_help_serial'] = 2;
        }


        if (($_SERVER['HTTP_REFERER'] == base_url('/corporate_form') ) || ( $_SERVER['HTTP_REFERER'] == base_url('/tutor_form') ) || ($_SERVER['HTTP_REFERER'] == base_url('/school_form') ) || ($_SERVER['HTTP_REFERER'] == base_url('/student_form') ) || ($_SERVER['HTTP_REFERER'] == base_url('/upper_level_student_form') ) || ($_SERVER['HTTP_REFERER'] == base_url('/student_form') ) ) {
            echo "string";
            $data['back_url'] =  $this->session->userdata('back_urlRegistration');
        }else{
            $data['back_url'] = $_SERVER['HTTP_REFERER'];
            $this->session->set_userdata('back_urlRegistration', $_SERVER['HTTP_REFERER']);
        }
        $user_id = $this->session->userdata('user_id');
        $countryIdd = $this->db->where('id',$user_id)->get('tbl_useraccount')->row('country_id');

        $data['user_info'] = $this->RegisterModel->getInfo('tbl_useraccount', 'id', $user_id);
        // echo "<pre>";print_r($data['user_info']);die();
        if (isset($_POST['country'])) {
                $countryIdd = $_POST['country'];
        }
        if (isset($countryIdd)) {
            // echo $countryIdd;
            // $countryIdd =$this->session->userdata('countryId');
            if (isset($_POST['country'])) {
                $countryIdd = $_POST['country'];
            }
            
            $this->session->set_userdata('countryId', $countryIdd);
            $user_id = $this->session->userdata('user_id');
            // $subscription_type = ($this->session->userdata('registrationType') == 'trial' ? 2 : 1);
            $data['subscription_type'] = ($this->session->userdata('registrationType') == 'trial' ? 2 : 1);
            if(!empty($user_id)){
                $data['subscription_type'] = ($this->session->userdata('registrationType') == 'trial' ? 1 : 1);
                $this->session->set_userdata('registrationType', '');
            }
            $tbl_setting = $this->db->where('setting_key','days')->get('tbl_setting')->row();
            $duration = $tbl_setting->setting_value;
            $date = date('Y-m-d');
            $d1  = date('Y-m-d', strtotime('-'.$duration.' days', strtotime($date)));
            $trialEndDate = strtotime($d1);
            //if($this->session->userdata('userType') != 4 && $this->session->userdata('userType') != 5)
            //if ($this->session->userdata('userType') != 4 && $this->session->userdata('userType') != 5) {
            // $data['course_details'] = $this->RegisterModel->getCourse($this->session->userdata('userType'), $countryIdd, $subscription_type);
            
            
            //added AS 
            if ($this->session->userdata('userType') == 6) {
                $this->session->set_userdata('userType', 1);
            }
            
            
            $data['course_details'] = $this->RegisterModel->getCourse($this->session->userdata('userType'), $countryIdd);

            if($_SESSION['registrationType']=='signup'){
                $course_status = 1;
            }else if($_SESSION['registrationType']=='trial'){
                $course_status = 2;
            }else{
                $course_status = 1;
            }

            $data['courses'] = $this->RegisterModel->getTrialCourse($this->session->userdata('userType'), $countryIdd,$course_status);
            
            // echo "<pre>";print_r($data['courses']);die();
            
            $register_courses = $this->db->select('course_id')->where('user_id',$user_id)->where('cost <>',0)->where('endTime >',time())->get('tbl_registered_course')->result_array();
            $registerCourse = [];
            foreach($register_courses as $key => $course){
                $registerCourse[$key] = $course['course_id'];
            }
            
            // echo '<pre>';
            // print_r($registerCourse);die();
            $data['register_course'] = $registerCourse;
            if (!$data['course_details'] && $this->session->userdata('userType') != 4 && $this->session->userdata('userType') != 5) {
                $this->session->set_userdata('country_error', 'Actually we have no service for this country that you select. Please select another country');
                redirect('/select_country');
            }
            //}
            $checkDepositDetails = $this->db->where('country_id',$countryIdd)->get('direct_deposit_admin_setting')->row();
            if(isset($checkDepositDetails)){
                $data['direct_deposit_by_contry'] = $checkDepositDetails->active_status;
            }
            // $data['back_url'] = base_url().'select_country';
            $data['refferalUser'] = $this->db->where('user_id',$user_id)->where('status',0)->get('tbl_referral_users')->row();
            $data['header']=$this->load->view('common/header', '', true);
            $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
            $data['footer']=$this->load->view('common/footer', '', true);

            
            if ($this->session->userdata('userType')==1) {
                $this->load->view('registration/select_course', $data);
            }elseif ($this->session->userdata('userType')==6) {
                $this->load->view('registration/select_course', $data);
            } elseif ($this->session->userdata('userType')==2) {
                $this->load->view('registration/select_course_for_upper_level', $data);
            } elseif ($this->session->userdata('userType')==3) {
                // echo "<pre>";print_r($data);die();
                $this->load->view('registration/select_course_for_tutor', $data);
            } elseif ($this->session->userdata('userType')==4) {
                //echo $this->session->userdata('userType');die();
                $this->load->view('registration/select_course_for_school', $data);
            } elseif ($this->session->userdata('userType')==5) {
                $this->load->view('registration/select_course_for_corporate', $data);
            } 
        } else {
            
            redirect('/signup');
        }
    }
    
    private function validate_student_course_signup()
    {

        $this->form_validation->set_rules('paymentType', 'paymentType', 'required');
        $this->form_validation->set_rules('totalCost', 'totalCost', 'required');
        $flag=0;
        $error='';
        if ($this->form_validation->run()==false) {
            $error.= validation_errors();
            $flag++;
        }
        $children = $this->input->post('children');
        if ($children < 1) {
            $error.= '<p>children number can not be less than 1</p>';
            $flag++;
        }
        $course = $this->input->post('course');
        if (! $course) {
            $error.= '<p>At least Select One course</p>';
            $flag++;
        }
        if ($flag > 0) {
            redirect('/select_course');
            exit;
        } else {
            return true;
        }
    }
    
    private function validate_student_course_trial()
    {
        $flag=0;
        $error='';
        $children = $this->input->post('children');
        if ($children < 1) {
            $error.= '<p>children number can not be less than 1</p>';
            $flag++;
        }
        $course = $this->input->post('course');
        if (! $course) {
            $error.= '<p>At least Select One course</p>';
            $flag++;
        }
        if ($flag > 0) {
            redirect('/select_course');
            exit;
        } else {
            return true;
        }
    }
    
    public function student_form()
    {
        // echo "bfgjghjh<pre>";print_r($this->session->userdata('courses'));die();
        if (!empty($_SESSION['trail_suspend']) && $_SESSION['trail_suspend'] == 1 ) {
            redirect('/paypal_new');
        }
        if ($_SESSION['registrationType'] == "trial") {
            $data['video_help'] = $this->FaqModel->videoSerialize(7, 'video_helps');
            $data['video_help_serial'] = 7;
        }else{
            $data['video_help'] = $this->FaqModel->videoSerialize(3, 'video_helps');
            $data['video_help_serial'] = 3;
        }

        if (isset($_POST['token'])) {
            if ($this->session->userdata('registrationType') !='trial') {
                $this->validate_student_course_signup();
            } else {
                $this->validate_student_course_trial();
            }
        }
        if ($this->session->userdata('userType')==1 || $this->session->userdata('userType')==6) {
            $data['back_url'] = base_url().'redirect_url';
            if (isset($_POST['children']) || $this->session->userdata('childrens') || $this->session->userdata('children')) {
                $children =$this->session->userdata('childrens');
                if (empty($children)) {
                   $children =$this->session->userdata('children'); 
                }
                if (isset($_POST['children']) && $_POST['children'] && $_POST['course']) {
                    $children = $_POST['children'];
                    if ($children < 1) {
                        redirect('signup');
                    }
                    $this->session->set_userdata('childrens', $children);
                    $this->session->set_userdata('courses', $_POST['course']);
                    if ($this->session->userdata('registrationType') != 'trial') {
                        $this->session->set_userdata('paymentType', $_POST['paymentType']);
                        $this->session->set_userdata('totalCost', $_POST['totalCost']);
                    }
                }
                if ($children) {
                    $data['country_db']=$this->RegisterModel->getSpecificCountry($this->session->userdata('countryId'));
                    $data['chil_number']=$children;
                    $data['header']=$this->load->view('common/header', '', true);
                    $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
                    $data['footer']=$this->load->view('common/footer', '', true);
                    $this->load->view('registration/student_form', $data);
                }
            } else {
                redirect('/signup');
            }
        } else {
            redirect('/signup');
        }
    }
    public function signup_student_form()
    {

        // echo "bfgjghjh<pre>";print_r($this->session->userdata('courses'));die();
        if (!empty($_SESSION['trail_suspend']) && $_SESSION['trail_suspend'] == 1 ) {
            redirect('/paypal_new');
        }
        if ($_SESSION['registrationType'] == "trial") {
            $data['video_help'] = $this->FaqModel->videoSerialize(7, 'video_helps');
            $data['video_help_serial'] = 7;
        }else{
            $data['video_help'] = $this->FaqModel->videoSerialize(3, 'video_helps');
            $data['video_help_serial'] = 3;
        }

        if (isset($_POST['token'])) {
            if ($this->session->userdata('registrationType') !='trial') {
                $this->validate_student_course_signup();
            } else {
                $this->validate_student_course_trial();
            }
        }
        if ($this->session->userdata('userType')==1 || $this->session->userdata('userType')==6) {
            $data['back_url'] = base_url().'redirect_url';
            if (isset($_POST['children']) || $this->session->userdata('childrens') || $this->session->userdata('children')) {
                $children =$this->session->userdata('childrens');
                if (empty($children)) {
                   $children =$this->session->userdata('children'); 
                }
                if (isset($_POST['children']) && $_POST['children'] && $_POST['course']) {
                    $children = $_POST['children'];
                    if ($children < 1) {
                        redirect('signup');
                    }
                    $this->session->set_userdata('childrens', $children);
                    $this->session->set_userdata('courses', $_POST['course']);
                    if ($this->session->userdata('registrationType') != 'trial') {
                        $this->session->set_userdata('paymentType', $_POST['paymentType']);
                        $this->session->set_userdata('totalCost', $_POST['totalCost']);
                    }
                }
                if ($children) {
                    $data['country_db']=$this->RegisterModel->getSpecificCountry($this->session->userdata('countryId'));
                    $data['chil_number']=$children;
                    $data['header']=$this->load->view('common/header', '', true);
                    $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
                    $data['footer']=$this->load->view('common/footer', '', true);
                    $this->load->view('registration/signup-student_form', $data);
                }
            } else {
                redirect('/signup');
            }
        } else {
            redirect('/signup');
        }
    }
    
    public function redirect_url()
    {
        redirect('/select_course');
    }
    
    public function checkPasswordConfirmPassword($pass, $confirm)
    {
        $i=0;
        $j=0;
        foreach ($pass as $singlePass) {
            if ($singlePass != $confirm[$i]) {
                return false;
            } else {
                $j++;
            }
            $i++;
        }
        if ($j != 0) {
            return true;
        }
    }

    public function myValidation($student)
    {
        foreach ($student as $singleSt) {
            if ($singleSt) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function save_student()
    {
        //echo "bfgjghjh<pre>";print_r($this->session->userdata('courses'));die();
        $this->form_validation->set_rules('parent_name', 'parent_name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('cnfpassword', 'cnfpassword', 'required|matches[password]');

        $student=$this->input->post('student');

        $flag=0;
        $error='';
        if ($this->form_validation->run()==false) {
            //$error.= validation_errors();
            $flag++;
        }

        $mobile = $this->input->post('mobile');
        // echo $_POST['full_number']; die;
        $mobileExists = $this->admin_model->getInfo('tbl_useraccount', 'user_mobile', $_POST['full_number']);
        if (count($mobileExists)) {
           echo json_encode("mobile_number_error");
           exit();
        }

        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[tbl_useraccount.user_email]');
        if ($this->form_validation->run()==false) {
            $error.= '<p style="color:red">Email already exists in out database, Please login to your account</p>';
            $flag++;
        }

        if ($this->myValidation($student) == false) {
            $error.= '<p>student name can not be blank</p>';
            $flag++;
        }
        if ($flag > 0) {
            echo json_encode($error);
            exit;
        }

        // echo '<pre>';print_r($_POST);die;

        $data['number'] = rand(10000, 99999);
        // $content = urlencode("Q-Study Registration Code: ".$data['number']);
        // $url = "https://platform.clickatell.com/messages/http/send?apiKey=iyypKonpQNOHUBMv4wngVA==&to=" . $_POST['full_number'] . "&content=$content";
        $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
        $settins_sms_messsage = $this->admin_model->getSmsMessageSettings();

        $register_code_string = $settins_sms_messsage[0]['setting_value'];
        $find = array("{{register_code}}");
        $replace = array($data['number']);
        $message = str_replace($find, $replace, $register_code_string);

        $api_key = $settins_Api_key[0]['setting_value'];
        $content = urlencode($message);
        //echo '<pre>';print_r($_POST);echo $_POST['full_number'];die;
        $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $_POST['full_number'] . "&content=$content";

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
        //print_r($result);die;
        $send_msg_status = json_decode($result);

       //if (count($send_msg_status->messages) > 0 && $send_msg_status->messages[0]->accepted == 1) {
            $this->session->set_userdata('random_number', $data['number']);
        //}

        $this->RegisterModel->save_random_digit($data);

        $this->session->set_userdata('parent_name', $_POST['parent_name']);
        $this->session->set_userdata('email', $_POST['email']);
        $this->session->set_userdata('password', $_POST['password']);
        $this->session->set_userdata('mobile', $_POST['full_number']);

        $rs_data=array();
        for ($i = 0; $i < count($_POST['student']); $i++) {
            $data_std['name'] = $_POST['student'][$i];
            $data_std['grade'] = $_POST['grade'][$i];
            $data_std['SCT'] = $_POST['SCT'][$i];
            $rs_data[]=$data_std;
        }

        $this->session->set_userdata('students', $rs_data);
        echo json_encode('success');
    }
    public function signup_save_student()
    {
        // echo "bfgjghjh<pre>";print_r($this->input->post());die();
        $this->form_validation->set_rules('parent_name', 'parent_name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('cnfpassword', 'cnfpassword', 'required|matches[password]');

        $student=$this->input->post('student');

        $flag=0;
        $error='';
        if ($this->form_validation->run()==false) {
            //$error.= validation_errors();
            $flag++;
        }

        $mobile = $this->input->post('mobile');
        // echo $_POST['full_number']; die;
        $mobileExists = $this->admin_model->getInfo('tbl_useraccount', 'user_mobile', $_POST['full_number']);
        if (count($mobileExists)) {
           echo json_encode("mobile_number_error");
           exit();
        }

        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[tbl_useraccount.user_email]');
        if ($this->form_validation->run()==false) {
            $error.= '<p style="color:red">Email already exists in out database, Please login to your account</p>';
            $flag++;
        }

        if ($this->myValidation($student) == false) {
            $error.= '<p>student name can not be blank</p>';
            $flag++;
        }
        if ($flag > 0) {
            echo json_encode($error);
            exit;
        }

        // echo '<pre>';print_r($_POST);die;

        $data['number'] = rand(10000, 99999);
        // $content = urlencode("Q-Study Registration Code: ".$data['number']);
        // $url = "https://platform.clickatell.com/messages/http/send?apiKey=iyypKonpQNOHUBMv4wngVA==&to=" . $_POST['full_number'] . "&content=$content";
        $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
        $settins_sms_messsage = $this->admin_model->getSmsMessageSettings();

        $register_code_string = $settins_sms_messsage[0]['setting_value'];
        $find = array("{{register_code}}");
        $replace = array($data['number']);
        $message = str_replace($find, $replace, $register_code_string);

        $api_key = $settins_Api_key[0]['setting_value'];
        $content = urlencode($message);
        //echo '<pre>';print_r($_POST);echo $_POST['full_number'];die;
        $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $_POST['full_number'] . "&content=$content";

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
        //print_r($result);die;
        $send_msg_status = json_decode($result);

       //if (count($send_msg_status->messages) > 0 && $send_msg_status->messages[0]->accepted == 1) {
            $this->session->set_userdata('random_number', $data['number']);
        //}

        $this->RegisterModel->save_random_digit($data);

        $this->session->set_userdata('parent_name', $_POST['parent_name']);
        $this->session->set_userdata('email', $_POST['email']);
        $this->session->set_userdata('user_email', $_POST['email']);
        $this->session->set_userdata('password', $_POST['password']);
        $this->session->set_userdata('mobile', $_POST['full_number']);

        $rs_data=array();
        for ($i = 0; $i < count($_POST['student']); $i++) {
            $data_std['name'] = $_POST['student'][$i];
            $data_std['grade'] = $_POST['grade'][$i];
            $data_std['SCT'] = $_POST['SCT'][$i];
            $rs_data[]=$data_std;
        }

        $this->session->set_userdata('students', $rs_data);
        echo json_encode('success');
    }
    
    public function sure_data_save()
    {
        //print_r($this->session->userdata('random_number')); die();
        if ($_POST['random'] == $this->session->userdata('random_number')) {
            if ($this->session->userdata('registrationType') !='trial') {
                
                if ($this->session->userdata('paymentType')==1 ) {
                $data['end_subscription'] = date('Y-m-d', strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +30 day"));
                }

                if ($this->session->userdata('paymentType')==2) {
                $data['end_subscription'] = date('Y-m-d', strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +182 day"));
                }

                if ($this->session->userdata('paymentType')==3) {
                $data['end_subscription'] = date('Y-m-d', strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +365 day"));
                }
            }

            $rs_student = $this->session->userdata('students');
            $rs_course  = $this->session->userdata('courses');
            // echo "<pre>";print_r($rs_course);die();
            $data['children_number']  = $this->session->userdata('childrens');
            $data['subscription_type']= $this->session->userdata('registrationType');
            $data['user_type']        = $this->session->userdata('userType');
            $data['country_id']       = $this->session->userdata('countryId');
            $data['name']             = $this->session->userdata('parent_name');
            $data['user_email']       = $this->session->userdata('email');
            $data['user_pawd']        = md5($this->session->userdata('password'));
            $data['user_mobile']      = $this->session->userdata('mobile');
            $data['created']          = time();
            $this->load->helper('string');
            $data['SCT_link'] = random_string('alnum', 10);
            //echo "<pre>"; print_r($data);die();
            $parent_id  = $this->RegisterModel->saveUser($data);
            $student_list = array();
            
            foreach ($rs_student as $singleStudent) {

                $raw_st_data=array();
                $st['name']    = $singleStudent['name'];
                $pieces        = explode(" ", $st['name']);
                $random_number = rand(100, 999);
                $st['user_email']=$pieces[0];
                $raw_st_data['st_name']    =$pieces[0];
                $raw_st_data['st_password']=$pieces[0].$random_number;
                $st['user_pawd']=md5($pieces[0].$random_number);

                $user_pswd[]    = ($pieces[0].$random_number);
                $this->session->set_userdata('st_password', $user_pswd);
                $st['parent_id']=$parent_id;
                $st['user_type']=6;
                $st['country_id']       = $this->session->userdata('countryId');
                $st['subscription_type']= $this->session->userdata('registrationType');

                $st['student_grade']    = $singleStudent['grade'];
                $st['created']          = time();
                $this->load->helper('string');
                $st['SCT_link'] = random_string('alnum', 10);
                $student_id = $this->RegisterModel->basicInsert('tbl_useraccount', $st);
                
                foreach ($rs_course as $singleCourse) {
                    $course['course_id']=$singleCourse;
                    $rs_course_cost     =$this->RegisterModel->getCourseCost($course['course_id']);
                    $course['cost']    = $rs_course_cost[0]['courseCost'];
                    
                    if($st['subscription_type']=='trial'){
                        $course['endTime'] = time()+24*3600;
                    }else if($st['subscription_type']=='signup'){
                        $course['endTime'] = time();
                    }
                    $course['user_id'] = $student_id;
                    $course['created'] = time();
                    
                    $this->RegisterModel->basicInsert('tbl_registered_course', $course);
                    
                }
                
                $st['SCT_link'] = $singleStudent['SCT'];
                if ($st['SCT_link']) {
                    $sct_link=$this->RegisterModel->getInfo('tbl_useraccount', 'SCT_link', $st['SCT_link']);

                    if ($sct_link) {
                        $usertype = $sct_link[0]['user_type'];
                        if ($usertype == 6) {
                            $referral['user_id']      = $student_id;
                            $referral['refferalUser'] = $sct_link[0]['id'];
                            $referral['refferalLink'] = $st['SCT_link'];
                            $this->RegisterModel->refferalLinkInsert('tbl_referral_users', $referral);
                            
                        }else{

                            $enrl['sct_id'] = $sct_link[0]['id'];
                            $enrl['st_id'] = $student_id;
                            $enrl['sct_type'] = $sct_link[0]['user_type'];
                            $this->RegisterModel->basicInsert('tbl_enrollment', $enrl);

                        }
                    }
                }
                $student_list[]=$raw_st_data;
                $this->session->set_userdata('student_list', $student_list );
            }
            
            $courseName='';
            foreach ($rs_course as $singleCourse) {
                $course['course_id']=$singleCourse;
                $rs_course_cost=$this->RegisterModel->getCourseCost($course['course_id']);
                $course['cost']=$rs_course_cost[0]['courseCost'];
                $courseName .= $rs_course_cost[0]['courseName'];
                $course['user_id']=$parent_id;
                $course['created']=time();
                //$this->RegisterModel->basicInsert('tbl_registered_course', $course);
            }
            
            
            $this->session->set_userdata('user_id', $parent_id);
            $this->session->set_userdata('courseName', $courseName);

            

            //username and password send
            $settins_sms_status   = $this->admin_model->getSmsType("Template Activate Status");

            if ($settins_sms_status[0]['setting_value'] ) {
                
                $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
                $settins_sms_messsage = $this->admin_model->getSmsType("Parent Registration");
                

                $register_code_string = $settins_sms_messsage[0]['setting_value'];
                $message = str_replace( "{{ username }}" , $this->session->userdata('email') , $register_code_string);
                $message = str_replace( "{{ password }}" , $this->session->userdata('password') , $message);
                $message = str_replace( "{{ C_username }}" , $st['user_email'] , $message);
                $message = str_replace( "{{ C_password }}" , $pieces[0].$random_number , $message);

                $api_key = $settins_Api_key[0]['setting_value'];
                $content = urlencode($message);

                $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $this->session->userdata('mobile') . "&content=$content";

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

            }
            
            if ($this->session->userdata('registrationType') != 'trial') {

                if ($this->session->userdata('registrationType') == 'signup') {
                    
                    echo $this->session->userdata('payment_process');
                }else{
                    echo 1;
                }
                
            } else {
                echo 2;
            }

            $this->mailTemplate($this->session->userdata('parent_name'), $this->session->userdata('email'), $this->session->userdata('password'), $student_list);
            
        } else {
            echo 0;
        }
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
    
    /**
     * Haven't read it all
     *
     * @param  integer $type 1=send to payment page; 0=complete page
     * @return void
     */
    private function after_send_mail_user_show_view($type)
    {
        $registrationType = $this->session->userdata('registrationType');

        $mail_data['reg_type'] = $registrationType;
        $mail_data['registration_type'] = $type;
        $mail_data['mail_user_info'] = $this->RegisterModel->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $mail_data['header']=$this->load->view('common/header', '', true);
        $mail_data['header_sign_up']=$this->load->view('common/header_sign_up', '', true);
        $mail_data['footer']=$this->load->view('common/footer', '', true);
        $this->load->view('registration_compleate', $mail_data);
    }

    public function parent_trial_mail()
    {
        $type=0;
        $this->after_send_mail_user_show_view($type);
    }
    public function parent_signup_mail()
    {
        $type=1;
        $this->after_send_mail_user_show_view($type);
    }
    public function school_mail()
    {
        $type=4; //school type
        $this->after_send_mail_user_show_view($type);
    }
    public function show_paypal_form()
    {        
        $data['video_help'] = $this->FaqModel->videoSerialize(4, 'video_helps');
        $data['video_help_serial'] = 4;
        
        // echo 'ppppppp';echo $this->session->userdata('user_id');die();
        if ($this->session->userdata('user_id') != '') {
            $data['publish_key']=$this->SettingModel->getStripeKey('publish');
            $data['header']=$this->load->view('common/header', '', true);
            $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
            $data['footer']=$this->load->view('common/footer', '', true);
            $this->load->view('payment_option', $data);
        } else {
            redirect('/signup');
        }
    }
    public function go_paypal()
    {
        // $rs_course=$this->session->userdata('courses');
        // echo $this->session->userdata('totalCost');
        // echo '<pre>';print_r($rs_course);die();
        if ($this->session->userdata('user_id') != '') {
            $data['url']=$this->SettingModel->getPaypalKey('url');
            $data['business_key']=$this->SettingModel->getPaypalKey('business_account');
            $data['paymentType'] = $this->session->userdata('paymentType');//p3 te bosbe
            $data['amount'] = $this->session->userdata('totalCost');
            $data['payment_process'] = $this->session->userdata('payment_process');
            $data['user_id'] = $this->session->userdata('user_id');
            $userType = $this->session->userdata('userType');
            $rs_course = $this->session->userdata('courses');
            $data['courseId'] = implode(",", $rs_course);
            if($userType == 1){
               $this->session->set_userdata('userType',6);
            }

            $rs_course = $this->session->userdata('courses');
            //echo "<pre>";print_r($rs_course);die();
            // echo "<pre>";
            // print_r($data); die();
            // if ($userType == 1 || $userType == 2) {
            //     $rs_course = $this->session->userdata('courses');
            //     $data['courseId'] = implode(",", $rs_course);
            // } else {
            //     $data['courseId']='';
            // }
            // $this->session->unset_userdata('userType');
            $data['package']=$this->session->userdata('courseName');
            $data['header']=$this->load->view('common/header', '', true);
            $data['header_sign_up']=$this->load->view('common/header_sign_up', '', true);
            $data['footer']=$this->load->view('common/footer', '', true);
            //echo "<pre>";
            //print_r($data); die();
            $data['package']=$data['courseId'];
            $this->load->view('paypal-form', $data);
        } else {
            redirect('/signup');
        }
    }
    public function signup_go_paypal()
    {

        // $rs_course=$this->session->userdata('courses');
        // echo $this->session->userdata('totalCost');
        //  echo $this->session->userdata('user_id');die();

        if ($this->session->userdata('user_id') != '') {
            $parent_id = $this->session->userdata('user_id');
            $check_student = $this->db->where('parent_id',$parent_id)->get('tbl_useraccount')->row();
            $data['url']=$this->SettingModel->getPaypalKey('url');
            $data['business_key']=$this->SettingModel->getPaypalKey('business_account');
            $data['paymentType'] = $this->session->userdata('paymentType');//p3 te bosbe
            $data['amount'] = $this->session->userdata('totalCost');
            $data['payment_process'] = $this->session->userdata('payment_process');
            $data['user_id'] = $check_student->id;
            $userType = $this->session->userdata('userType');
            $rs_course = $this->session->userdata('courses');
            $data['courseId'] = implode(",", $rs_course);
            if($userType == 1){
               $this->session->set_userdata('userType',6);
            }
            // echo "<pre>";
            // print_r($data); die();
            // if ($userType == 1 || $userType == 2) {
            //     $rs_course = $this->session->userdata('courses');
            //     $data['courseId'] = implode(",", $rs_course);
            // } else {
            //     $data['courseId']='';
            // }
            // $this->session->unset_userdata('userType');
            $data['package']=$this->session->userdata('courseName');
            $data['header']=$this->load->view('common/header', '', true);
            $data['header_sign_up']=$this->load->view('common/header_sign_up', '', true);
            $data['footer']=$this->load->view('common/footer', '', true);
            //echo "<pre>";
            //print_r($data); die();
            $data['package']=$data['courseId'];
            $this->load->view('signup-paypal-form', $data);
        } else {
            redirect('/signup');
        }
    }
    public function signup_upper_go_paypal()
    {

        // $rs_course=$this->session->userdata('courses');
        // echo $this->session->userdata('totalCost');
        //  echo $this->session->userdata('user_id');die();

        if ($this->session->userdata('user_id') != '') {
            $data['url']=$this->SettingModel->getPaypalKey('url');
            $data['business_key']=$this->SettingModel->getPaypalKey('business_account');
            $data['paymentType'] = $this->session->userdata('paymentType');//p3 te bosbe
            $data['amount'] = $this->session->userdata('totalCost');
            $data['payment_process'] = $this->session->userdata('payment_process');
            $data['user_id'] = $this->session->userdata('user_id');
            $userType = $this->session->userdata('userType');
            $rs_course = $this->session->userdata('courses');
            $data['courseId'] = implode(",", $rs_course);
            if($userType == 2){
               $this->session->set_userdata('userType',2);
            }
            // echo 'vvv'.$this->session->userdata('userType');die();
            // echo "<pre>";
            // print_r($data); die();

            $data['package']=$this->session->userdata('courseName');
            $data['header']=$this->load->view('common/header', '', true);
            $data['header_sign_up']=$this->load->view('common/header_sign_up', '', true);
            $data['footer']=$this->load->view('common/footer', '', true);
            //echo "<pre>";
            //print_r($data); die();
            $data['package']=$data['courseId'];
            $this->load->view('signup-upper-paypal-form', $data);
        } else {
            redirect('/signup');
        }
    }




    public function go_paypal_qusStore(){

        if ($this->session->userdata('user_id') != '') {
            
            $data['url']=$this->SettingModel->getPaypalKey('url');
            $data['business_key']=$this->SettingModel->getPaypalKey('business_account');
            $data['paymentType'] = $this->session->userdata('paymentType');//p3 te bosbe
            $data['amount'] = $this->session->userdata('totalCost');
            $data['payment_process'] = $this->session->userdata('payment_process');
            $data['rs_subject'] = $this->session->userdata('rs_subject');
            $data['user_id'] = $this->session->userdata('user_id');
            $userType = $this->session->userdata('userType');

            $data['package']=$this->session->userdata('courseName');
            $data['header']=$this->load->view('common/header', '', true);
            $data['header_sign_up']=$this->load->view('common/header_sign_up', '', true);
            $data['footer']=$this->load->view('common/footer', '', true);
            //echo "<pre>";
            //print_r($data); die();
            $this->load->view('paypal-form-qusStore', $data);
        }else {
            redirect('/signup');
        }
    }
    

    private function validate_upper_student_course_signup()
    {
        $this->form_validation->set_rules('paymentType', 'paymentType', 'required');
        $this->form_validation->set_rules('totalCost', 'totalCost', 'required');
        $flag=0;
        $error='';
        if ($this->form_validation->run()==false) {
            $error.= validation_errors();
            $flag++;
        }
        
        $course = $this->input->post('course');
        if (! $course) {
            $error.= '<p>At least Select One course</p>';
            $flag++;
        }
        if ($flag > 0) {
            redirect('/select_course');
            exit;
        } else {
            return true;
        }
    }
    
    private function validate_upper_student_course_trial()
    {
        $flag=0;
        $error='';
        $course = $this->input->post('course');
        if (! $course) {
            $error.= '<p>At least Select One course</p>';
            $flag++;
        }
        if ($flag > 0) {
            redirect('/select_course');
            exit;
        } else {
            return true;
        }
    }
    
    public function upper_level_student_form()
    {
        if (!empty($_SESSION['trail_suspend']) && $_SESSION['trail_suspend'] == 1 ) {
            redirect('/paypal_new');
        }
        if ($_SESSION['registrationType'] == "trial") {
            $data['video_help'] = $this->FaqModel->videoSerialize(7, 'video_helps');
            $data['video_help_serial'] = 7;
        }else{
            $data['video_help'] = $this->FaqModel->videoSerialize(3, 'video_helps');
            $data['video_help_serial'] = 3;
        }
        if (isset($_POST['token'])) {
            if ($this->session->userdata('registrationType') !='trial') {
                $this->validate_upper_student_course_signup();
            } else {
                $this->validate_upper_student_course_trial();
            }
        }
        if ($this->session->userdata('userType')==2) {
            if (isset($_POST['paymentType']) || $this->session->userdata('paymentType') || $this->session->userdata('registrationType') == 'trial') {
                $data['back_url'] = base_url().'redirect_url';
                if (isset($_POST['paymentType'])) {
                    $this->session->set_userdata('courses', $_POST['course']);
                    $this->session->set_userdata('paymentType', $_POST['paymentType']);
                    $this->session->set_userdata('totalCost', $_POST['totalCost']);
                }
                if ($this->session->userdata('registrationType') == 'trial' && isset($_POST['course'])) {
                    $this->session->set_userdata('courses', $_POST['course']);
                }
                $data['country_db']=$this->RegisterModel->getSpecificCountry($this->session->userdata('countryId'));
                
                $data['header']=$this->load->view('common/header', '', true);
                $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
                $data['footer']=$this->load->view('common/footer', '', true);
                $this->load->view('registration/upper_level_student_form', $data);
            } else {
                redirect('/signup');
            }
        } else {
            redirect('/signup');
        }
    }

    public function signup_upper_level_student_form()
    {
        if (!empty($_SESSION['trail_suspend']) && $_SESSION['trail_suspend'] == 1 ) {
            redirect('/paypal_new');
        }
        if ($_SESSION['registrationType'] == "trial") {
            $data['video_help'] = $this->FaqModel->videoSerialize(7, 'video_helps');
            $data['video_help_serial'] = 7;
        }else{
            $data['video_help'] = $this->FaqModel->videoSerialize(3, 'video_helps');
            $data['video_help_serial'] = 3;
        }
        if (isset($_POST['token'])) {
            if ($this->session->userdata('registrationType') !='trial') {
                $this->validate_upper_student_course_signup();
            } else {
                $this->validate_upper_student_course_trial();
            }
        }
        if ($this->session->userdata('userType')==2) {
            if (isset($_POST['paymentType']) || $this->session->userdata('paymentType') || $this->session->userdata('registrationType') == 'trial') {
                $data['back_url'] = base_url().'redirect_url';
                if (isset($_POST['paymentType'])) {
                    $this->session->set_userdata('courses', $_POST['course']);
                    $this->session->set_userdata('paymentType', $_POST['paymentType']);
                    $this->session->set_userdata('totalCost', $_POST['totalCost']);
                }
                if ($this->session->userdata('registrationType') == 'trial' && isset($_POST['course'])) {
                    $this->session->set_userdata('courses', $_POST['course']);
                }
                $data['country_db']=$this->RegisterModel->getSpecificCountry($this->session->userdata('countryId'));
                
                $data['header']=$this->load->view('common/header', '', true);
                $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
                $data['footer']=$this->load->view('common/footer', '', true);
                $this->load->view('registration/signup_upper_level_student_form', $data);
            } else {
                redirect('/signup');
            }
        } else {
            redirect('/signup');
        }
    }
    
    public function save_upper_student()
    {
        $this->form_validation->set_rules('upper_student_name', 'upper_student_name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('cnfpassword', 'cnfpassword', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[tbl_useraccount.user_email]');
        $student=$this->input->post('student');


        $mobile = $this->input->post('mobile');
        $mobileExists = $this->admin_model->getInfo('tbl_useraccount', 'user_mobile', $_POST['full_number']);
        if (count($mobileExists)) {
           echo json_encode("mobile_number_error");
           exit();
        }
        
        $flag=0;
        $error='';
        if ($this->form_validation->run()==false) {
            $error.= validation_errors();
            $flag++;
        }
        if ($flag > 0) {
            echo json_encode($error);
            exit;
        }
        $data['number'] = rand(10000, 99999);
        $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
        $settins_sms_messsage = $this->admin_model->getSmsMessageSettings();

        $register_code_string = $settins_sms_messsage[0]['setting_value'];
        $find = array("{{register_code}}");
        $replace = array($data['number']);
        $message = str_replace($find, $replace, $register_code_string);

        $api_key = $settins_Api_key[0]['setting_value'];
        $content = urlencode($message);
        //echo '<pre>';print_r($_POST);echo $_POST['full_number'];die;
        $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $_POST['full_number'] . "&content=$content";

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
        // echo "<pre>";print_r(count($send_msg_status->messages));die();
        if (count($send_msg_status->messages) > 0 && $send_msg_status->messages[0]->accepted == 1) {
            $this->session->set_userdata('random_number', $data['number']);
            //echo 'message send';
        }
        // echo $this->session->userdata('random_number');die();
        $this->session->set_userdata('random_number', $data['number']);

     
        $this->RegisterModel->save_random_digit($data);

        $this->session->set_userdata('upper_student_name', $_POST['upper_student_name']);
        $this->session->set_userdata('email', $_POST['email']);
        $this->session->set_userdata('user_email', $_POST['email']);
        $this->session->set_userdata('password', $_POST['password']);
        $this->session->set_userdata('mobile', $_POST['full_number']);
        echo json_encode('success');
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
    
    public function upper_student_trial_mail()
    {
        $type=0;
        $this->after_send_mail_user_show_view($type);
    }
    
    public function upper_student_signup_mail()
    {
        $type=1;
        $this->after_send_mail_user_show_view($type);
    }
    
    public function sure_upper_student_data_save()
    { 
        //echo $this->session->userdata('random_number');die();
        if ($_POST['random']==$this->session->userdata('random_number')) {
            $rs_course=$this->session->userdata('courses');
            $data['subscription_type']=$this->session->userdata('registrationType');
            $data['user_type']=$this->session->userdata('userType');
            $data['country_id']=$this->session->userdata('countryId');
            $data['name']=$this->session->userdata('upper_student_name');
            $data['user_email']=$this->session->userdata('email');
            $data['user_pawd']=md5($this->session->userdata('password'));
            $data['user_mobile']=$this->session->userdata('mobile');
            $data['student_grade']=13;
            $data['created']=time();
            $upper_student_id = $this->RegisterModel->saveUser($data);
            $courseName='';
            foreach ($rs_course as $singleCourse) {
                $course['course_id']=$singleCourse;
                $rs_course_cost=$this->RegisterModel->getCourseCost($course['course_id']);
                if($data['user_type'] == 'trial'){
                    $course['cost'] = 0;
                }else{
                    $course['cost'] = $rs_course_cost[0]['courseCost'];
                }
                $courseName .= $rs_course_cost[0]['courseName'];
                $course['user_id']=$upper_student_id;
                $course['created']=time();
                $this->RegisterModel->basicInsert('tbl_registered_course', $course);
            }
            
            
            $this->session->set_userdata('user_id', $upper_student_id);
            $this->session->set_userdata('courseName', $courseName);

            $settins_sms_status   = $this->admin_model->getSmsType("Template Activate Status");
            if ($settins_sms_status[0]['setting_value'] ) {

                $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
                $settins_sms_messsage = $this->admin_model->getSmsType("Upper level student");

                $register_code_string = $settins_sms_messsage[0]['setting_value'];
                $message = str_replace( "{{ username }}" , $this->session->userdata('email') , $register_code_string);
                $message = str_replace( "{{ password }}" , ($this->session->userdata('password')) , $message);

                $api_key = $settins_Api_key[0]['setting_value'];
                $content = urlencode($message);

                $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $this->session->userdata('mobile') . "&content=$content";

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

            }

            if ($this->session->userdata('registrationType') != 'trial') {
                if ($this->session->userdata('registrationType') == 'signup') {
                    
                    echo $this->session->userdata('payment_process');
                }else{
                    echo 1;
                }
            } else {
                $this->student_mailTemplate($this->session->userdata('upper_student_name'), $this->session->userdata('email'), $this->session->userdata('password'));
                echo 2;
            }
        } else {
            echo 0;
        }
    }
    
    public function tutor_form()
    {

        if (!empty($_SESSION['trail_suspend']) && $_SESSION['trail_suspend'] == 1 ) {
            redirect('/paypal_new');
        }

        if (  !empty($_SESSION['registrationType']) && $_SESSION['registrationType'] == "trial" ) {
            $data['video_help'] = $this->FaqModel->videoSerialize(7, 'video_helps');
            $data['video_help_serial'] = 7;
        }else{
            $data['video_help'] = $this->FaqModel->videoSerialize(3, 'video_helps');
            $data['video_help_serial'] = 3;
        }
        if ($this->session->userdata('userType') == 3) {
            // if (isset($_POST['paymentType']) || $this->session->userdata('paymentType')) {
            $data['back_url'] = base_url().'redirect_url';
            // echo "string";die;
            if (isset($_POST['paymentType'])) {
                $this->session->set_userdata('paymentType', $_POST['paymentType']);
                $this->session->set_userdata('totalCost', $_POST['totalCost']);
            }
            if (isset($_POST['course']))
            {
                $this->session->set_userdata('tutor_course', $_POST['course']);
            }
            $data['country_db']=$this->RegisterModel->getSpecificCountry($this->session->userdata('countryId'));
            $data['header']=$this->load->view('common/header', '', true);
            $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
            $data['footer']=$this->load->view('common/footer', '', true);
            $this->load->view('registration/tutor_form', $data);
            // }
        } else {

            redirect('/signup');
        }
    }
    
    public function save_tutor()
    {
        $this->form_validation->set_rules('tutor_name', 'tutor_name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('cnfpassword', 'cnfpassword', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[tbl_useraccount.user_email]');
        $this->form_validation->set_rules('mobile', 'mobile',  'required|is_unique[tbl_useraccount.user_mobile]');
        
        $student = $this->input->post('student');
        $mobile = $this->input->post('mobile');

        // echo '<pre>';print_r($this->session->userdata('courses'));die;

        $mobileExists = $this->admin_model->getInfo('tbl_useraccount', 'user_mobile', $_POST['full_number']);

        if (count($mobileExists)) {
           echo json_encode("mobile_number_error");
           exit();
        }

        
        $flag = 0;
        $error = '';
        if ($this->form_validation->run() == false) {
            $error.= validation_errors();
            $flag++;
        }
        if ($flag > 0) {
            echo json_encode($error);
            exit;
        }

        $this->session->set_userdata('tutor_name', $_POST['tutor_name']);
        $this->session->set_userdata('email', $_POST['email']);
        $this->session->set_userdata('password', $_POST['password']);
        $this->session->set_userdata('user_mobile', $_POST['full_number']);
        $data['number'] = rand(10000, 99999);
        // $content = urlencode("Q-Study Registration Code: ".$data['number']);
        // $url = "https://platform.clickatell.com/messages/http/send?apiKey=iyypKonpQNOHUBMv4wngVA==&to=" . $_POST['full_number'] . "&content=$content";
        $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
        $settins_sms_messsage = $this->admin_model->getSmsMessageSettings();

        $register_code_string = $settins_sms_messsage[0]['setting_value'];
        $find = array("{{register_code}}");
        $replace = array($data['number']);
        $message = str_replace($find, $replace, $register_code_string);

        $api_key = $settins_Api_key[0]['setting_value'];
        $content = urlencode($message);


        //echo '<pre>';print_r($_POST);echo $_POST['full_number'];die;
        $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $_POST['full_number'] . "&content=$content";

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

        if (count($send_msg_status->messages) > 0 && $send_msg_status->messages[0]->accepted == 1) {
            $this->session->set_userdata('random_number', $data['number']);
        }
        $this->RegisterModel->save_random_digit($data);

        echo json_encode('success');
    }

    public function sure_save_tutor()
    {
        //print_r($this->session->userdata('random_number')); die();
        if ($_POST['random']==$this->session->userdata('random_number')) { 

            $data['subscription_type'] = $this->session->userdata('registrationType');
            $data['user_type'] = $this->session->userdata('userType');
            $data['country_id'] = $this->session->userdata('countryId');
            $data['name'] = $this->session->userdata('tutor_name');
            $data['user_email'] = $this->session->userdata('email');
            $data['user_pawd'] = md5($this->session->userdata('password'));
            $data['user_mobile'] = $this->session->userdata('user_mobile');
            $data['SCT_link'] = $this->randomString();
            $data['created'] = time();
            
            $tutor_id = $this->RegisterModel->saveUser($data);
            // $tutor_course = $this->session->userdata('tutor_course');
            $tutor_course = $this->session->userdata('courses');
            //echo "<pre>";print_r($tutor_course);die();
            $additionalTableData = array();
            $additionalTableData['tutor_id'] = $tutor_id;
            $additionalTableData['created_at'] = date('Y-m-d h:i:s');
            $additionalTableData['updated_at'] = date('Y-m-d h:i:s');
            $this->RegisterModel->basicInsert('additional_tutor_info', $additionalTableData);
            if (count($tutor_course)){
                $courseUserMap = [];
                foreach ($tutor_course as $course) {
                    $course_info = $this->RegisterModel->getInfo('tbl_course', 'id', $course);
                    $courseUserMap = [
                        'course_id' => $course,
                        'user_id' => $tutor_id,
                        'created' => time(),
                        'cost'    => $course_info[0]['courseCost'],
                    ];
                    $this->RegisterModel->basicInsert('tbl_registered_course', $courseUserMap);
                }
            }

            $this->session->set_userdata('user_id', $tutor_id);
            $this->session->set_userdata('SCT_link', $data['SCT_link'] );
            $this->session->set_userdata('courseName', 'You paid as a tutor');


            //username and password send

            $settins_sms_status   = $this->admin_model->getSmsType("Template Activate Status");

            if ($settins_sms_status[0]['setting_value'] ) {

                $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
                $settins_sms_messsage = $this->admin_model->getSmsType("Tutor Registration");

                $register_code_string = $settins_sms_messsage[0]['setting_value'];
                $message = str_replace( "{{ username }}" , $this->session->userdata('email') , $register_code_string);
                $message = str_replace( "{{ password }}" , ($this->session->userdata('password')) , $message);

                $api_key = $settins_Api_key[0]['setting_value'];
                $content = urlencode($message);

                $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $this->session->userdata('user_mobile') . "&content=$content";

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

            }

            if ($this->session->userdata('registrationType') != 'trial') {
                echo "paypal";
                
            } else {
                $this->tutor_mailTemplate($this->session->userdata('tutor_name'), $this->session->userdata('email'), $this->session->userdata('password'), $data['SCT_link']);
                echo "tutor_trial_mail";
            }


        }else{
            echo 0;
        }

    }
    
    
    public function tutor_trial_mail()
    {
        $type=0;
        $this->after_send_mail_user_show_view($type);
    }
    public function tutor_signup_mail()
    {
        $type=1;
        $this->after_send_mail_user_show_view($type);
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
    
    private function randomString($length = 10)
    {
        $str = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }
    
    public function school_form()
    {
        // echo "<pre>";print_r($this->input->post());die();
        if ($_SESSION['registrationType'] == "trial") {
            $data['video_help'] = $this->FaqModel->videoSerialize(7, 'video_helps');
            $data['video_help_serial'] = 7;
        }else{
            $data['video_help'] = $this->FaqModel->videoSerialize(3, 'video_helps');
            $data['video_help_serial'] = 3;
        }
        if (isset($_POST['teacher']) || $this->session->userdata('teacher_number')) {
            $data['back_url'] = base_url().'/select_country/signup/4';
            if (isset($_POST['teacher'])) {
                $this->form_validation->set_rules('teacher', 'teacher', 'callback_teacher_number_check');
                if ($this->form_validation->run()==false) {
                    $this->session->set_userdata('teacher_number_error', 'Number of teacher can not be less than 1');
                    redirect('/select_course');
                } else {
                    $this->session->set_userdata('teacher_number', $_POST['teacher']);
                    if (isset($_POST['paymentType'])) {
                        $this->session->set_userdata('paymentType', $_POST['paymentType']);
                        $this->session->set_userdata('totalCost', $_POST['totalCost']);
                    }
                    $data['teacher_number']=$_POST['teacher'];
                    $data['country_db']=$this->RegisterModel->getSpecificCountry($this->session->userdata('countryId'));
                    $data['header']=$this->load->view('common/header', '', true);
                    $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
                    $data['footer']=$this->load->view('common/footer', '', true);
                    $this->load->view('registration/school_form', $data);
                }
            } else {
                if (isset($_POST['paymentType'])) {
                    $this->session->set_userdata('paymentType', $_POST['paymentType']);
                    $this->session->set_userdata('totalCost', $_POST['totalCost']);
                }
                $data['country_db']=$this->RegisterModel->getSpecificCountry($this->session->userdata('countryId'));
                $data['teacher_number']=$this->session->userdata('teacher_number');
                $data['header']=$this->load->view('common/header', '', true);
                $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
                $data['footer']=$this->load->view('common/footer', '', true);
                $this->load->view('registration/school_form', $data);
            }
        } else {
            redirect('/signup');
        }
    }
    
    public function teacher_number_check($val)
    {
        if ($val < 1) {
            return false;
        }
    }
    
    public function save_school()
    {
        $this->form_validation->set_rules('school_name', 'school_name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('cnfpassword', 'cnfpassword', 'required|matches[password]');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[tbl_useraccount.user_email]');
        $teacher = $this->input->post('teacher');

        $password_teacher = $this->input->post('password_teacher');
        $confirm_password_teacher = $this->input->post('confirm_password_teacher');
        
        
        $mobileExists = $this->admin_model->getInfo('tbl_useraccount', 'user_mobile', $_POST['full_number']);

        if (count($mobileExists)) {
           echo json_encode("mobile_number_error");
           exit();
        }

        $flag = 0;
        $error = '';
        if ($this->form_validation->run() == false) {
            $error.= validation_errors();
            $flag++;
        }
        if ($this->myValidation($teacher) == false) {
            $error.= '<p>teacher name can not be blank</p>';
            $flag++;
        }

        if ($this->checkPasswordConfirmPassword($password_teacher, $confirm_password_teacher) == false) {
            $error.= '<p>confirm_password_teacher error</p>';
            $flag++;
        }
        if ($flag > 0) {
            echo json_encode($error);
            exit;
        }
        // $data['number'] = rand(10000, 99999);
        // $this->session->set_userdata('random_number',$data['number']);
        // $this->RegisterModel->save_random_digit($data);

        $this->session->set_userdata('school_name', $_POST['school_name']);
        $this->session->set_userdata('email', $_POST['email']);
        $this->session->set_userdata('password', $_POST['password']);
        $this->session->set_userdata('full_number', $_POST['full_number']);
        $this->session->set_userdata('website', $_POST['website']);
        $this->session->set_userdata('user_mobile', $_POST['full_number']);
        $this->session->set_userdata('user_phone', $_POST['phone']);
        //$this->session->set_userdata('mobile',$_POST['mobile']);
        $rs_data = array();
        for ($i = 0; $i < count($_POST['teacher']); $i++) {
            $data_std['name'] = $_POST['teacher'][$i];
            $data_std['user_pawd'] = $_POST['password_teacher'][$i];
            $rs_data[] = $data_std;
        }
        $this->session->set_userdata('teachers', $rs_data);



        $data['number'] = rand(10000, 99999);
        // $content = urlencode("Q-Study Registration Code: ".$data['number']);
        // $url = "https://platform.clickatell.com/messages/http/send?apiKey=iyypKonpQNOHUBMv4wngVA==&to=" . $_POST['full_number'] . "&content=$content";
        $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
        $settins_sms_messsage = $this->admin_model->getSmsMessageSettings();

        $register_code_string = $settins_sms_messsage[0]['setting_value'];
        $find = array("{{register_code}}");
        $replace = array($data['number']);
        $message = str_replace($find, $replace, $register_code_string);

        $api_key = $settins_Api_key[0]['setting_value'];
        $content = urlencode($message);


        //echo '<pre>';print_r($_POST);echo $_POST['full_number'];die;
        $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $_POST['full_number'] . "&content=$content";

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

        if (count($send_msg_status->messages) > 0 && $send_msg_status->messages[0]->accepted == 1) {
            $this->session->set_userdata('random_number', $data['number']);
        }

        $this->RegisterModel->save_random_digit($data);
        echo json_encode('success');
        //echo json_encode($this->session->set_userdata('random_number', $data['number']));
    }



    public function school_mailTemplate($school_name, $schoolEmail, $schoolPassword, $teacherList)
    {

        $template = $this->RegisterModel->getInfo('table_email_template', 'email_template_type', $this->session->userdata('userType'));
        $teacher_number = sizeof($teacherList);
        if ($template) {
              $subject = $template[0]['email_template_subject']; //->email_template_subject;
              $template_message = $template[0]['email_template']; //->email_template;
              
              $te_data = '';
            foreach ($teacherList as $single_teacher) {
                $te_data .=
                "<div style='overflow:hidden ;  margin-bottom:20px;'>
                <div style='width:70%; float:left; text-align:left;'>
                <p>Username</p>
                <p>{$single_teacher['teacher_user_name']}</p>
                </div>
                <div style='width:30%; float:left; text-align:right;'>
                <p>Password</p>
                <p>{$single_teacher['teacher_password']}</p>
                </div>
                </div>";
            }
            
            $find = array("{{teacher_number}}","{{teacher_block}}","{{schoolName}}","{{school_email}}","{{school_password}}");
            $replace = array($teacher_number,$te_data,$school_name,$schoolEmail,$schoolPassword);
            $message = str_replace($find, $replace, $template_message);
            $mail_data['to'] = $schoolEmail;
            $mail_data['subject'] = $template[0]['email_template_subject'];
            ;
            $mail_data['message'] = $message;
            $this->sendEmail($mail_data);
        }
        return true;
    }
    
    
    // public function sure_school_data_save()
    // {
    ////if($_POST['random']==$this->session->userdata('random_number')){
        // $rs_teachers = $this->session->userdata('teachers');
        // $data['children_number'] = $this->session->userdata('teacher_number');
        // $data['subscription_type'] = $this->session->userdata('registrationType');
        // $data['user_type'] = $this->session->userdata('userType');
        // $data['country_id'] = $this->session->userdata('countryId');
        // $data['name'] = $this->session->userdata('school_name');
        // $data['user_email'] = $this->session->userdata('email');
        // $data['user_pawd'] = md5($this->session->userdata('password'));
    ////$data['user_mobile']=$this->session->userdata('mobile');
        // $data['SCT_link'] = $this->randomString();
        // $data['created'] = time();
        // $school_id = $this->RegisterModel->saveUser($data);
        // $teacher_list = array();
        // foreach ($rs_teachers as $singleTeacher) {
            // $raw_te_data = array();
            // $st['name'] = $singleTeacher['name'];
            // $pieces = explode(" ", $st['name']);
            // $random_number = rand(100, 999);
            // $st['user_email'] = $pieces[0];
            // $raw_te_data['teacher_user_name'] = $pieces[0];
            // $raw_te_data['teacher_password'] = $pieces[0] . $random_number;
            // $st['user_pawd'] = md5($pieces[0] . $random_number);
            // $st['country_id'] = $this->session->userdata('countryId');
            // $st['user_type'] = 3;
            // $st['parent_id'] = $school_id;
            // $st['SCT_link'] = $this->randomString();
            // $st['created'] = time();
            // $this->RegisterModel->basicInsert('tbl_useraccount', $st);
            // $teacher_list[] = $raw_te_data;
        // }

        // $this->session->set_userdata('user_id', $school_id);
        // $this->school_mailTemplate($this->session->userdata('school_name'), $this->session->userdata('email'), $this->session->userdata('password'), $teacher_list);

    ////echo 1;
        // redirect('school_mail');
    ////}else{
    //// echo 0;
    ////}
    // }
    
    public function sure_school_data_save()
    {
		//print_r($this->session->userdata('random_number'));die();
        if($_POST['random']==$this->session->userdata('random_number')){
        $rs_teachers = $this->session->userdata('teachers');

        $data['children_number'] = $this->session->userdata('teacher_number');
        //$data['subscription_type'] = $this->session->userdata('registrationType');
        $data['user_type'] = $this->session->userdata('userType');
        $data['country_id'] = $this->session->userdata('countryId');
        $data['name'] = $this->session->userdata('school_name');
        $data['user_email'] = $this->session->userdata('email');
        $data['user_pawd'] = md5($this->session->userdata('password'));
        $data['user_mobile'] = ($this->session->userdata('user_mobile'));
        $data['user_phone'] = ($this->session->userdata('user_phone'));
        $data['website'] = ($this->session->userdata('website'));
        //  $data['user_mobile'] = $this->session->userdata('mobile');
        $data['SCT_link'] = $this->randomString();
        $data['created'] = time();
        $school_id = $this->RegisterModel->saveUser($data);
        $teacher_list = array();
        foreach ($rs_teachers as $singleTeacher) {
            $raw_te_data = array();
            $st['name'] = $singleTeacher['name'];

              //$pieces = explode(" ", $st['name']);

            $random_number = rand(100, 999);

            $st['user_email'] = $singleTeacher['name'];
            $raw_te_data['teacher_user_name'] = $singleTeacher['name'];
            $raw_te_data['teacher_password'] = $singleTeacher['user_pawd'];
            $st['user_pawd'] = md5($singleTeacher['user_pawd']);
            $st['country_id'] = $this->session->userdata('countryId');
            $st['user_type'] = 3;
            $st['parent_id'] = $school_id;
              $st['SCT_link'] = $data['SCT_link'];//$this->randomString();
              $st['created'] = time();
              $this->RegisterModel->basicInsert('tbl_useraccount', $st);
              $teacher_list[] = $raw_te_data;
        }

             $settins_sms_status   = $this->admin_model->getSmsType("Template Activate Status");

            if ($settins_sms_status[0]['setting_value'] ) { 

                //username and password send

                $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
                $settins_sms_messsage = $this->admin_model->getSmsType("School Registration");

                $register_code_string = $settins_sms_messsage[0]['setting_value'];
                $message = str_replace( "{{ username }}" , $this->session->userdata('email') , $register_code_string);
                $message = str_replace( "{{ password }}" , ($this->session->userdata('password')) , $message);
                $message = str_replace( "{{ T_username }}" , $st['user_email'] , $message);
                $message = str_replace( "{{ T_password }}" , $singleTeacher['user_pawd'] , $message);

                $api_key = $settins_Api_key[0]['setting_value'];
                $content = urlencode($message);

                $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . ($this->session->userdata('user_mobile')) . "&content=$content";

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

            }

            echo 1;


            $this->session->set_userdata('user_id', $school_id);
            $this->school_mailTemplate($this->session->userdata('school_name'), $this->session->userdata('email'), $this->session->userdata('password'), $teacher_list);

        }  
    }

    public function corporate_form()
    {
        if ($_SESSION['registrationType'] == "trial") {
            $data['video_help'] = $this->FaqModel->videoSerialize(7, 'video_helps');
            $data['video_help_serial'] = 7;
        }else{
            $data['video_help'] = $this->FaqModel->videoSerialize(3, 'video_helps');
            $data['video_help_serial'] = 3;
        }

        if ($this->session->userdata('userType') == 5) {

            if (isset($_POST['course']))
            {
                $this->session->set_userdata('corporate_course', $_POST['course']);
            }
            
            if (isset($_POST['teacher']) || $this->session->userdata('teacher_number')) {
                if (isset($_POST['paymentType'])) {
                    $this->session->set_userdata('paymentType', $_POST['paymentType']);
                    $this->session->set_userdata('totalCost', $_POST['totalCost']);
                }
                $data['back_url'] = base_url().'/select_country/signup/5';

                if (isset($_POST['teacher'])) {
                    $this->form_validation->set_rules('teacher', 'teacher', 'callback_teacher_number_check');
                    if ($this->form_validation->run()==false) {
                        $this->session->set_userdata('teacher_number_error', 'Number of teacher can not be less than 1');
                        redirect('/select_course');
                    } else {
                        $this->session->set_userdata('teacher_number', $_POST['teacher']);
                        $data['teacher_number'] = $_POST['teacher'];
                        $data['country_db']=$this->RegisterModel->getSpecificCountry($this->session->userdata('countryId'));

                        $data['header']=$this->load->view('common/header', '', true);
                        $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
                        $data['footer']=$this->load->view('common/footer', '', true);

                        $this->load->view('registration/corporate_form', $data);
                    }
                } else {
                    $data['country_db']=$this->RegisterModel->getSpecificCountry($this->session->userdata('countryId'));
                    $data['teacher_number']=$this->session->userdata('teacher_number');

                    $data['header']=$this->load->view('common/header', '', true);
                    $data['header_sign_up']=$this->load->view('common/header_sign_up', '', true);
                    $data['footer']=$this->load->view('common/footer', '', true);

                    $this->load->view('registration/corporate_form', $data);
                }
            } else {
                redirect('/signup');
            }
        } else {
            redirect('/signup');
        }
    }

    public function save_corporate()
    {
        $this->form_validation->set_rules('corporate_name', 'corporate_name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('cnfpassword', 'cnfpassword', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[tbl_useraccount.user_email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $teacher = $this->input->post('teacher');
        // add
        $mobile = $this->input->post('mobile');
        $mobileExists = $this->admin_model->getInfo('tbl_useraccount', 'user_mobile', $_POST['full_number']);
        if (count($mobileExists)) {
           echo json_encode("mobile_number_error");
           exit();
        }

        
        $flag = 0;
        $error = '';
        if ($this->form_validation->run() == false) {
            $error.= validation_errors();
            $flag++;
        }
        if ($this->myValidation($teacher) == false) {
            $error.= '<p>teacher name can not be blank</p>';
            $flag++;
        }
        if ($flag > 0) {
            echo json_encode($error);
            exit;
        }
        // $data['number'] = rand(10000, 99999);
        // $this->session->set_userdata('random_number',$data['number']);
        // $this->RegisterModel->save_random_digit($data);

        $this->session->set_userdata('corporate_name', $_POST['corporate_name']);
        $this->session->set_userdata('email', $_POST['email']);
        $this->session->set_userdata('password', $_POST['password']);

        $this->session->set_userdata('full_number', $_POST['full_number']);
        $this->session->set_userdata('website', $_POST['website']);
        $this->session->set_userdata('user_mobile', $_POST['full_number']);
        $this->session->set_userdata('user_phone', $_POST['phone']);
        //$this->session->set_userdata('mobile',$_POST['mobile']);
        $rs_data = array();
        for ($i = 0; $i < count($_POST['teacher']); $i++) {
            $data_std['name'] = $_POST['teacher'][$i];
            $rs_data[] = $data_std;
        }
        $this->session->set_userdata('teachers', $rs_data);

        //confirmation code sent

        $data['number'] = rand(10000, 99999);
        $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
        $settins_sms_messsage = $this->admin_model->getSmsMessageSettings();

        $register_code_string = $settins_sms_messsage[0]['setting_value'];
        $find = array("{{register_code}}");
        $replace = array($data['number']);
        $message = str_replace($find, $replace, $register_code_string);

        $api_key = $settins_Api_key[0]['setting_value'];
        $content = urlencode($message);

        //echo '<pre>';print_r($_POST);echo $_POST['full_number'];die;
        $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $_POST['full_number'] . "&content=$content";

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

        if (count($send_msg_status->messages) > 0 && $send_msg_status->messages[0]->accepted == 1) {
            $this->session->set_userdata('random_number', $data['number']);
        }

        $this->RegisterModel->save_random_digit($data);

        echo json_encode('success');
    }

    public function corporate_mail()
    {
        $type=5;
        $this->after_send_mail_user_show_view($type);
    }

    public function corporate_mailTemplate($corporateName, $corporateEmail, $corporatePassword, $teacherList)
    {
        $template = $this->RegisterModel->getInfo('table_email_template', 'email_template_type', $this->session->userdata('userType'));
        $teacher_number = sizeof($teacherList);
        if ($template) {
            $subject = $template[0]['email_template_subject'];
            $template_message = $template[0]['email_template'];
            $te_data = '';
            foreach ($teacherList as $single_teacher) {
                $te_data .=
                "<div style='overflow:hidden ;  margin-bottom:20px;'>
            <div style='width:70%; float:left; text-align:left;'>
            <p>Username</p>
            <p>{$single_teacher['teacher_user_name']}</p>
            </div>
            <div style='width:30%; float:left; text-align:right;'>
            <p>Password</p>
            <p>{$single_teacher['teacher_password']}</p>
            </div>
            </div>";
            }

            $find = array("{{teacher_number}}","{{teacher_block}}","{{corporateName}}","{{corporate_email}}","{{corporate_password}}");
            $replace = array($teacher_number,$te_data,$corporateName,$corporateEmail,$corporatePassword);
            $message = str_replace($find, $replace, $template_message);
            $mail_data['to'] = $corporateEmail ;//$userEmail;
            $mail_data['subject'] = $template[0]['email_template_subject'];
            ;
            $mail_data['message'] = $message;
            $this->sendEmail($mail_data);
        }
        return true;
    }
    
    
    public function sure_corporate_data_save()
    {
		//print_r($this->session->userdata('random_number'));die();
        // if($_POST['random']==$this->session->userdata('random_number')){ 
            $rs_teachers = $this->session->userdata('teachers');

            $data['children_number'] = $this->session->userdata('teacher_number');
            $data['subscription_type'] = $this->session->userdata('registrationType');
            $data['user_type'] = $this->session->userdata('userType');
            $data['country_id'] = $this->session->userdata('countryId');
            $data['name'] = $this->session->userdata('corporate_name');
            $data['user_email'] = $this->session->userdata('email');
            $data['user_pawd'] = md5($this->session->userdata('password'));

            $data['user_mobile'] = ($this->session->userdata('full_number'));
            $data['user_mobile'] = ($this->session->userdata('user_phone'));
            $data['website'] = ($this->session->userdata('website'));
            
            //$data['user_mobile']=$this->session->userdata('mobile');
            $data['SCT_link'] = $this->randomString();
            $data['created'] = time();
            $corporate_id = $this->RegisterModel->saveUser($data);
            
            $teacher_list = array();
            foreach ($rs_teachers as $singleTeacher) {
                $teacher_raw_data = array();
                $st['name'] = $singleTeacher['name'];
                $pieces = explode(" ", $st['name']);
                $random_number = rand(100, 999);
                $st['user_email'] = $pieces[0];
                $st['user_pawd'] = md5($pieces[0] . $random_number);
                $teacher_raw_data['teacher_user_name'] = $pieces[0];
                $teacher_raw_data['teacher_password'] = $pieces[0] . $random_number;
                $st['parent_id'] = $corporate_id;
                $st['country_id'] = $this->session->userdata('countryId');
                $st['user_type'] = 3;
                $st['SCT_link'] = $data['SCT_link'];
                $st['created'] = time();
                
                //rakesh corporate

                $tutor_id = $this->RegisterModel->saveUser($st);

                $tutor_course = $this->session->userdata('corporate_course');


                if (count($tutor_course)){
                    $courseUserMap = [];
                    foreach ($tutor_course as $course) {
                        $course_info = $this->RegisterModel->getInfo('tbl_course', 'id', $course);
                        $courseUserMap = [
                            'course_id' => $course,
                            'user_id' => $tutor_id,
                            'created' => time(),
                            'cost' => $course_info[0]['courseCost'],
                        ];

                        $this->RegisterModel->basicInsert('tbl_registered_course', $courseUserMap);
                    }
                }

                $teacher_list[] = $teacher_raw_data;
            }

            //username and password send

            $settins_sms_status   = $this->admin_model->getSmsType("Template Activate Status");

            if ($settins_sms_status[0]['setting_value'] ) { 

                $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
                $settins_sms_messsage = $this->admin_model->getSmsType("Corparate Registration");

                $register_code_string = $settins_sms_messsage[0]['setting_value'];
                $message = str_replace( "{{ username }}" , $this->session->userdata('email') , $register_code_string);
                $message = str_replace( "{{ password }}" , ($this->session->userdata('password')) , $message);
                $message = str_replace( "{{ C_username }}" , $st['user_email'] , $message);
                $message = str_replace( "{{ C_password }}" , $pieces[0] . $random_number , $message);

                $api_key = $settins_Api_key[0]['setting_value'];
                $content = urlencode($message);

                $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . ($this->session->userdata('user_mobile')) . "&content=$content";

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
                
            }

            $this->session->set_userdata('user_id', $corporate_id);
            $this->corporate_mailTemplate($this->session->userdata('corporate_name'), $this->session->userdata('email'), $this->session->userdata('password'), $teacher_list);


            if ($this->session->userdata('registrationType') != 'trial') {
            
             echo 1;

            } else {
				echo 2;
                //redirect('corporate_mail');
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
        $config['smtp_host']    = 'smtppro.zoho.com';
        $config['smtp_user']    = 'contact@q-study.com';
        $config['smtp_pass']    = 'Mn876#%2dq';
        $config['charset']    = 'utf-8';
        $config['mailtype']    = 'html';
        $config['newline']    = "\r\n";
        $this->email->initialize($config);
        
        
        $this->email->from('contact@q-study.com');
        $this->email->to($mailTo);
        $this->email->subject($mailSubject);
        $this->email->message($message);
        
        
        $this->email->send();
       // $this->email->print_debugger();
        return true;
    }
    
    public function home_page()
    {
        redirect('dashboard');
    }


    // added AS 
    public function upper_student_free_reg(){
        $user_data['payment_status'] = "Completed";
        $user_data['subscription_type'] = 'signup';
        $sub_end_date = date('Y-m-d', strtotime('+1 month'));
        $user_data['end_subscription'] = $sub_end_date;
       
        $userID = $this->session->userdata('user_id');
        $this->db->where('id', $userID);
        $this->db->update('tbl_useraccount',$user_data);
        redirect('/');
    }

    public function show_signup_paypal_form()
    {        
        $data['video_help'] = $this->FaqModel->videoSerialize(4, 'video_helps');
        $data['video_help_serial'] = 4;
        
        // echo 'ppppppp';echo $this->session->userdata('user_id');die();
        if ($this->session->userdata('user_id') != '') {
            $data['publish_key']=$this->SettingModel->getStripeKey('publish');
            $data['header']=$this->load->view('common/header', '', true);
            $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
            $data['footer']=$this->load->view('common/footer', '', true);
            $this->load->view('signup_payment_option', $data);
        } else {
            redirect('/signup');
        }
    }
    public function signup_upper_paypal_form()
    {        
        $data['video_help'] = $this->FaqModel->videoSerialize(4, 'video_helps');
        $data['video_help_serial'] = 4;
        
        // echo 'ppppppp';echo $this->session->userdata('user_id');die();
        if ($this->session->userdata('user_id') != '') {
            $data['publish_key']=$this->SettingModel->getStripeKey('publish');
            $data['header']=$this->load->view('common/header', '', true);
            $data['header_sign_up']=$this->load->view('common/header_sign_up', $data, true);
            $data['footer']=$this->load->view('common/footer', '', true);
            $this->load->view('signup_upper_payment_option', $data);
        } else {
            redirect('/signup');
        }
    }

}
