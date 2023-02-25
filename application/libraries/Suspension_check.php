<?php defined('BASEPATH') or exit('No direct script access allowed');

class Suspension_check
{

    public $CI;
    public $loggedUserId;
    public $loggedUserType;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('admin_model');
        $this->loggedUserId = $this->CI->session->userdata('user_id');
        $this->loggedUserType = $this->CI->session->userdata('userType');
        $this->checkUserSuspension();
    }

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
                redirect('suspended');
            }
        }
    }
}
