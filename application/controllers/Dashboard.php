<?php

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        //echo $user_id;echo '<br>';echo $user_type;die;
        if ($user_id == null && $user_type == null) {
            redirect('welcome');
        }
    }
    

    public function index()
    {
        // echo $this->session->userdata('user_type');
        // die;
        if ($this->session->userdata('userType') == 1) {
            redirect('parents');
        }
        if ($this->session->userdata('userType') == 2) {
            redirect('upper_level');
        }
        if ($this->session->userdata('userType') == 3) {
            redirect('tutor');
        }
        if ($this->session->userdata('userType') == 4) {
            redirect('school');
        }
        if ($this->session->userdata('userType') == 5) {
            redirect('corporate');
        }
        if ($this->session->userdata('userType') == 6) {
            redirect('student');
        }
        if ($this->session->userdata('userType') == 7) {
            redirect('qstudy');
        }
        if ($this->session->userdata('userType') == 0) {
            redirect('admin');
        }
    }
    
    public function cancel_subscription()
    {
        $data['user_id'] = $this->session->userdata('user_id');
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('cancel_subscription', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function cancel_confirm()
    {
        $data['user_id'] = $this->session->userdata('user_id');
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('cancel_confirm', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function view_course()
    {
        if ($this->session->userdata('userType') == 3 ||
                $this->session->userdata('userType') == 4 ||
                $this->session->userdata('userType') == 5 ) { //tutor, School, Corporation
            redirect('tutor/view_course');
        }
        if ($this->session->userdata('userType') == 2) { //upper level student
            redirect('student/view_course');
        }if ($this->session->userdata('userType') == 6) { //student
            redirect('student/view_course');
        }
        if ($this->session->userdata('userType') == 7) { //qstudy
            redirect('qstudy/view_course');
        }
    }


    // added AS 
    public function subscription_cancel(){
        $id = $this->session->userdata('user_id');
        $user = $this->db->where('id',$id)->get('tbl_useraccount')->row();
        if ($user->user_type == 6) {
            $data['user_id'] = $user->parent_id;
        }else{
            $data['user_id'] = $this->session->userdata('user_id');
        }
        $data['end_subscription'] = $user->end_subscription;
        $data['cancel_date'] = date('Y-m-d');

        $check_user = $this->db->where('user_id',$data['user_id'])->get('tbl_cancel_subscription')->result_array();
        if (count($check_user) == 0) {
            $result = $this->db->insert('tbl_cancel_subscription',$data);
           
        }else{
            $result = $this->db->update('tbl_cancel_subscription',$data);

        }

        if($result){
            $this->db->where('id',$data['user_id'])->update('tbl_useraccount',['payment_status'=>'Cancel']);
            if ($user->user_type == 6) {
               $this->db->where('id',$this->session->userdata('user_id'))->update('tbl_useraccount',['payment_status'=>'Cancel']);
            }
        }
        echo "success";
    }


    public function subscription_renew(){
        $id = $this->session->userdata('user_id');
        $user = $this->db->where('id',$id)->get('tbl_useraccount')->row();
        if ($user->user_type == 6) {
            $data['user_id'] = $user->parent_id;
        }else{
            $data['user_id'] = $this->session->userdata('user_id');
        }
        $result = $this->db->where('user_id',$data['user_id'])->delete('tbl_cancel_subscription');
        if($result){
            $this->db->where('id',$data['user_id'])->update('tbl_useraccount',['payment_status'=>'Completed']);

            if ($user->user_type == 6) {
               $this->db->where('id',$this->session->userdata('user_id'))->update('tbl_useraccount',['payment_status'=>'Completed']);
            }

        }
        echo "success";
    }
}
