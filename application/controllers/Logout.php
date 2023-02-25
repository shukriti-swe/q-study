<?php


class Logout extends CI_Controller{
    
    public function index() {
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('subscription_type');
        $this->session->unset_userdata('payment_status');
        $this->session->unset_userdata('userType');
		$this->session->unset_userdata('prevUrl');
        $this->session->unset_userdata('selCountry');
        

//        $m_data = array();
//        $m_data['message'] = 'You Are Logged Out Successfully';
//        $this->session->set_userdata($m_data);
        redirect('welcome');
    }
    
}
