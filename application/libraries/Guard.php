<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Check different types of check on user account
 *
 * Ex: if user made no payment and try to access the system redirect them back,
 * User suspended from admin panel redirect them back
 *
 * @author   Shakil Ahmed <shakil147258@gmail.com>
 * @category Library_Function
 * @package  Codeigniter-3.0.2
 */
class Guard
{

    public $CI;
    public $loggedUserId;
    public $loggedUserType;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('admin_model');
        $this->CI->load->model('Tutor_model');
        $this->loggedUserId = $this->CI->session->userdata('user_id');
        $this->loggedUserType = $this->CI->session->userdata('userType');
        $this->checkUserPayment();
        $this->checkUserSuspension();
        $this->checkUserTrialStatus();
        $this->checkUserDirectDeposite();
        //$this->force_ssl();
        
        $user = $this->CI->Tutor_model->userInfo($this->loggedUserId);
        //if not logged in set default
        //else if logged in and any set default
        //else set as is his/her

        if (!$this->loggedUserId) {
            $user[0]['zone_name'] = TIME_ZONE;
        } elseif ($this->loggedUserId && $user[0]['countryCode'] == 'any') {
            $user[0]['zone_name'] = TIME_ZONE;
        }

        date_default_timezone_set($user[0]['zone_name']);
    }

    /**
     * Check user made payment or not.
     *
     * @return void
     */
    public function checkUserPayment()
    {
        $currentUrl = $this->CI->uri->segment_array();
        $preventRedirection = [
            'suspended',
            'payment_defaulter',
            'select_course', //package choose
            'select_course_for_upper_level', //package choose
            'select_course_for_tutor', //package choose
            'select_course_for_school', //package choose
            'select_course_for_corporate', //package choose
            'tutor_form',
            'forgot_password',
            'signup',
            'default_controller',
            'signup',
            'logout',
        ];
        if ($this->loggedUserId) {
            $userId = (int) $this->loggedUserId;

            if ($this->loggedUserType==6) {
                //if user is a 1-12 lvl student get his/her parent payment status
                $user = $this->CI->admin_model->getInfo('tbl_useraccount', 'id', $this->loggedUserId);
                $userId = $user[0]['parent_id'];
            }
            
            //get user payment info
            $user = $this->CI->admin_model->getInfo('tbl_payment', 'user_id', $userId);
            
            $redirectionStatus = count(array_intersect($currentUrl, $preventRedirection));
            if ((isset($user[0]) && $user[0]['payment_status']!='Completed') && !$redirectionStatus) {
                //redirect('payment_defaulter');
            }
        }
    }

    /**
     * Check if user suspended from admin or not.
     *
     * @return void
     */
    
    public function checkUserSuspension()
    {
        $currentUrl = $this->CI->uri->segment_array();
        $preventRedirection = [
            'suspended',
            'forgot_password',
            'signup',
            'default_controller',
            'signup',
            'logout',
        ];
        if ($this->loggedUserId) {
            $user = $this->CI->admin_model->getInfo('tbl_useraccount', 'id', $this->loggedUserId);
            
            $redirectionStatus = count(array_intersect($currentUrl, $preventRedirection));
            if (isset($user[0]) && $user[0]['suspension_status'] && !$redirectionStatus) {
                // redirect('suspended');
            }
        }
    }

    /**
     * Check user trial exceed or not.
     *
     * @return void
     */
    public function checkUserTrialStatus_old()
    {
        $currentUrl = $this->CI->uri->segment_array();
        $preventRedirection = [
            'suspended',
            'payment_defaulter',
            'select_course', //package choose
            'select_course_for_upper_level', //package choose
            'select_course_for_tutor', //package choose
            'select_course_for_school', //package choose
            'select_course_for_corporate', //package choose
            'tutor_form',
            'forgot_password',
            'signup',
            'default_controller',
            'signup',
            'logout',
        ];
        if ($this->loggedUserId) {
            $userId = (int) $this->loggedUserId;

            if ($this->loggedUserType==6) {
                //if user is a 1-12 lvl student get his/her parent payment status
                $user = $this->CI->admin_model->getInfo('tbl_useraccount', 'id', $this->loggedUserId);
                $userId = $user[0]['parent_id'];
            }
            
            //get user payment info
            $user = $this->CI->admin_model->getInfo('tbl_useraccount', 'id', $userId);
            
            $redirectionStatus = count(array_intersect($currentUrl, $preventRedirection));
            $subscriptionType  = $user[0]['subscription_type'];
            // if ($subscriptionType == 'trial') {
                 // $checkTrialEnd = strtotime(date('Y-m-d')) <= strtotime($user[0]['trial_end_date']) ? 1 : 0;
                 
                // if ((isset($user[0]) && $user[0]['payment_status']!='Completed') && !$redirectionStatus && !$checkTrialEnd) {
                    // redirect('payment_defaulter');
                // }
            // }
            
            // echo '<pre>';print_r($user[0]);
            
            if ($subscriptionType == 'trial') {
                $trial_configuration = $this->CI->admin_model->getInfo('tbl_setting', 'setting_type', 'trial_period');
                // echo $trial_configuration[1]['setting_value'].'<br>';
                $checkTrialEnd = 0;
                if ($user[0]['trial_end_date']) {
                    $checkTrialEnd = strtotime(date('Y-m-d')) <= strtotime($user[0]['trial_end_date']) ? 1: 0;
                }
                
                if (!$user[0]['trial_end_date']) {
                    $created_date = date('Y-m-d', $user[0]['created']);
                    $trial_end_date = date('Y-m-d', strtotime($created_date. " + ".$trial_configuration[1]['setting_value']." days"));
                    
                    $checkTrialEnd = strtotime(date('Y-m-d')) <= strtotime($trial_end_date) ? 1: 0;
                    if ($trial_configuration[0]['setting_value'] == 1) {
                        $checkTrialEnd = 1;
                    }
                }
                
                // echo $checkTrialEnd;die;
                // if ((isset($user[0]) && $user[0]['payment_status']!='Completed') && !$redirectionStatus && !$checkTrialEnd) {
                if (!$redirectionStatus && !$checkTrialEnd) {
                    //redirect('payment_defaulter');
                }
            }
        }
    }

    public function checkUserDirectDeposite()
    {
        $currentUrl = $this->CI->uri->segment_array();
        $preventRedirection = [
            'suspended',
            'forgot_password',
            'signup',
            'default_controller',
            'signup',
            'logout',
            'Corporate',
            'School',
            'parents',
            'upper_level',
            'Tutor',
        ];
        if ($this->loggedUserId) {
            $user = $this->CI->admin_model->getInfo('tbl_useraccount', 'id', $this->loggedUserId);


            $url = '';

            if ($user[0]['user_type'] == 1 ) {
                $url = 'parents';
            }

            if ($user[0]['user_type'] == 2 ) {
                $url = 'upper_level';
            }

            if ($user[0]['user_type'] == 3 ) {
                $url = 'Tutor';
                $user_info = $this->CI->admin_model->getTutorOrganiseInfo('tbl_useraccount', 'SCT_link', $user[0]['SCT_link'] );

                if (count($user_info)) {

                    foreach ($user_info as $key => $value) {
                        if ($value['subscription_type'] == "direct_deposite" && $value['direct_deposite'] == 0  ) {
                            $user[0]['subscription_type'] = "direct_deposite";
                            $user[0]['direct_deposite'] = 0;
                        }
                    }
                }
                
            }

            if ($user[0]['user_type'] == 4 ) {
                $url = 'School';
            }

            if ($user[0]['user_type'] == 5 ) {
                $url = 'Corporate';
            }

            if ($user[0]['user_type'] == 6 ) {
                $url = 'student';
            }



            $redirectionStatus = count(array_intersect($currentUrl, $preventRedirection));
            if (isset($user[0]) && $user[0]['subscription_type'] == "direct_deposite" && $user[0]['direct_deposite'] == 0 && !$redirectionStatus) {

                redirect($url);
            }
        }
    }

    public function checkUserTrialStatus()
    {
        $currentUrl = $this->CI->uri->segment_array();
        $preventRedirection = [
            'suspended',
            'payment_defaulter',
            'select_course', //package choose
            'select_course_for_upper_level', //package choose
            'select_course_for_tutor', //package choose
            'select_course_for_school', //package choose
            'select_course_for_corporate', //package choose
            'tutor_form',
            'forgot_password',
            'signup',
            'default_controller',
            'signup',
            'logout',
            'paypal',
            'direct-request',
            'card_form_submit',
            'corporate_form',
            'school_mail',
            'corporate_mail',
        ];
        if ($this->loggedUserId) {
            $userId = (int) $this->loggedUserId;

            if ($this->loggedUserType==6) {
                //if user is a 1-12 lvl student get his/her parent payment status
                $user = $this->CI->admin_model->getInfo('tbl_useraccount', 'id', $this->loggedUserId);
                $userId = $user[0]['parent_id'];
            }
            
            //get user payment info
            $user = $this->CI->admin_model->getInfo('tbl_useraccount', 'id', $userId);
            
            $redirectionStatus = count(array_intersect($currentUrl, $preventRedirection));
            $subscriptionType  = $user[0]['subscription_type'];
          
            if ($subscriptionType == 'trial') {
                $trial_configuration = $this->CI->admin_model->getInfo('tbl_setting', 'setting_type', 'trial_period');
                // echo $trial_configuration[1]['setting_value'].'<br>';
                $checkTrialEnd = 0;
                if ($user[0]['trial_end_date']) {
                    $checkTrialEnd = strtotime(date('Y-m-d')) <= strtotime($user[0]['trial_end_date']) ? 1: 0;
                }
                
                if (!$user[0]['trial_end_date']) {
                    $created_date = date('Y-m-d', $user[0]['created']);
                    $trial_end_date = date('Y-m-d', strtotime($created_date. " + ".$trial_configuration[1]['setting_value']." days"));
                    
                    $checkTrialEnd = strtotime(date('Y-m-d')) <= strtotime($trial_end_date) ? 1: 0;
                    if ($trial_configuration[0]['setting_value'] == 1) {
                        $checkTrialEnd = 1;
                    }
                }
                

                if (!$redirectionStatus && !$checkTrialEnd) {
                    //redirect('payment_defaulter');
                }

            }
        }
    }

    public function force_ssl()
    {
       
       /* if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") {
            $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            redirect($url);
            exit;
        }*/
        if ($_SERVER['HTTP_X_FORWARDED_PROTO']!='https') {
            $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            redirect($url);
            exit;
        }
    }
}
