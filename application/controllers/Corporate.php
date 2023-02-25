<?php


class Corporate extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        if($user_id == NULL && $user_type == NULL)
		{
            redirect('welcome');
        }
       $this->load->model('Admin_model');
       $this->load->model('Corporate_model');
       $this->load->model('FaqModel');
	   $this->load->helper(array('form', 'url'));
	   $this->load->library('form_validation');
	   $this->load->library('upload');
    }
    
    public function index() {

    	if ($this->session->userdata('userType') == 5) {
            $data['video_help'] = $this->FaqModel->videoSerialize(18, 'video_helps');
            $data['video_help_serial'] = 18;
        }
        
		$data['user_info']=$this->Corporate_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
		
        $data['checkDirectDepositPendingCourse'] = $this->Admin_model->getDirectDepositPendingCourse($this->session->userdata('user_id'));
        $data['checkRegisterCourses'] = $this->Admin_model->getCheckReisterCourses($this->session->userdata('user_id'));
        
        $tbl_setting = $this->db->where('setting_key','days')->get('tbl_setting')->row();
        $duration = $tbl_setting->setting_value;
        $date = date('Y-m-d');
        $d1  = date('Y-m-d', strtotime('-'.$duration.' days', strtotime($date)));
        $trialEndDate = strtotime($d1);
        $inactive_user_info = $this->Admin_model->getInfoInactiveUserCheck('tbl_useraccount', 'subscription_type', 'trial',$trialEndDate,$this->session->userdata('user_id'));
        $data['inactive_user_check'] = count($inactive_user_info);
        
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('corporate/corporate_dashboard', $data, TRUE);
        $this->load->view('master_dashboard', $data);
    }
	public function corporate_setting()
	{
		$data['video_help'] = $this->FaqModel->videoSerialize(19, 'video_helps');
        $data['video_help_serial'] = 19;
        
		$data['user_info']=$this->Corporate_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		$data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('corporate/corporate_setting', $data, TRUE);
        $this->load->view('master_dashboard', $data);
	}
	public function corporate_details()
	{
		$data['user_info']=$this->Corporate_model->userInfo($this->session->userdata('user_id'));		
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		$data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('corporate/corporate_details', $data, TRUE);
        $this->load->view('master_dashboard', $data);
	}
	public function update_corporate_details()
	{
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[6]|min_length[5]');
		$this->form_validation->set_rules('passconf', 'passconf', 'trim|required|matches[password]');
		if($this->form_validation->run()==false)
		{
			echo 0;
		}else{
			$password=md5($this->input->post('password'));
			$data = array(
					'user_pawd' =>$password
			);
			$this->Corporate_model->updateInfo('tbl_useraccount','id',$this->session->userdata('user_id'),$data);
			echo 1;
		}
	}
	public function corporate_logo()
	{
		$data['user_info']=$this->Corporate_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		$data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('corporate/upload', $data, TRUE);
        $this->load->view('master_dashboard', $data);
	}
	private function upload_user_photo_options()
	{
		$config = array();
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		// $config['max_width'] = 1080;
		// $config['max_height'] = 640;
		// $config['min_width']  = 150;
		// $config['min_height'] = 150;
		$config['overwrite']  = FALSE;
		return $config;
	}
	public function corporate_logo_upload()
	{
		$this->upload->initialize($this->upload_user_photo_options());
		 if ( ! $this->upload->do_upload('file')){
			 echo 0;
		 }else{
			$imageName=$this->upload->data();
			$user_profile_picture=$imageName['file_name'];
			$data = array(
				'image' =>$user_profile_picture
			);
			$rs['res']=$this->Corporate_model->updateInfo('tbl_useraccount','id',$this->session->userdata('user_id'),$data);
			echo 1;
		 }
		
	}
}
