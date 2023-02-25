<?php

class Upper_Level extends CI_Controller{
    public function __construct() {
        parent::__construct();
        
         $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
		//echo $user_id; echo '<br>';echo  $user_type;die;
        if($user_id == NULL && $user_type == NULL){
            redirect('welcome');
        }
        if($user_type != 2){
            redirect('welcome');
        }
		$this->load->model('Admin_model');
        $this->load->model('Uper_level_model');
        $this->load->model('tutor_model');
        $this->load->library('upload');
		$this->load->library('form_validation');
    }
    
    public function index() {
		//echo "pp".$this->session->userdata('user_id');die();
		$data['user_info']=$this->Uper_level_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
		//echo "<pre>";print_r($data['user_info']);die();
		
		
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
        
        $data['maincontent'] = $this->load->view('upper_level/upper_level_dashboard', $data, TRUE);
        $this->load->view('master_dashboard', $data);
        
    }
	public function u_level_studen_setting(){
		$data['user_info']=$this->Uper_level_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		$data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('upper_level/upper_level_setting', $data, TRUE);
        $this->load->view('master_dashboard', $data);
	}
	public function u_level_student_details(){
		$data['user_info']=$this->Uper_level_model->userInfo($this->session->userdata('user_id'));
		$data['studentRefLink']=$this->Uper_level_model->getStudentRefLink($this->session->userdata('user_id'));
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		$data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('upper_level/u_level_student_details', $data, TRUE);
        $this->load->view('master_dashboard', $data);
	}
	public function update_u_level_student_details()
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
			$this->Uper_level_model->updateInfo('tbl_useraccount','id',$this->session->userdata('user_id'),$data);
			echo 1;
		}
	}
	public function u_level_upload_photo(){
		$data['user_info']=$this->Uper_level_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		$data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('upper_level/upload', $data, TRUE);
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
	public function u_level_file_upload()
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
			$rs['res']=$this->Uper_level_model->updateInfo('tbl_useraccount','id',$this->session->userdata('user_id'),$data);
			echo 1;
		 }
		
	}
	public function u_level_enrollment(){
		$data['user_info']=$this->Uper_level_model->userInfo($this->session->userdata('user_id'));
		$data['get_involved_teacher']=$this->Uper_level_model->get_sct_enrollment_info($this->session->userdata('user_id'),3);
		$data['get_involved_school']=$this->Uper_level_model->get_sct_enrollment_info($this->session->userdata('user_id'),4);
		$data['get_involved_corporate']=$this->Uper_level_model->get_sct_enrollment_info($this->session->userdata('user_id'),5);
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		$data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('upper_level/u_level_enrollment_list', $data, TRUE);
        $this->load->view('master_dashboard', $data);
	}
}
