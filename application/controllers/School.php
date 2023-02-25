<?php


class School extends CI_Controller{
	public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        if($user_id == NULL && $user_type == NULL)
		{
            redirect('welcome');
        }
       $this->load->model('School_model');
       $this->load->model('FaqModel');
	   $this->load->helper(array('form', 'url'));
	   $this->load->library('form_validation');
		 $this->load->library('upload');
    }
    
    public function index() {
    	if ($this->session->userdata('userType') == 4) {
            $data['video_help'] = $this->FaqModel->videoSerialize(18, 'video_helps');
            $data['video_help_serial'] = 18;
        }

		$data['user_info']=$this->School_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('school/school_dashboard', $data, TRUE);
        $this->load->view('master_dashboard', $data);
    }
	public function school_setting(){

		$data['video_help'] = $this->FaqModel->videoSerialize(19, 'video_helps');
        $data['video_help_serial'] = 19;

		$data['user_info']=$this->School_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		$data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('school/school_setting', $data, TRUE);
        $this->load->view('master_dashboard', $data);
	}
	
	// public function school_info_details(){
		// $data['user_info']=$this->School_model->userInfo($this->session->userdata('user_id'));
		// $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		// $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        // $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        // $data['maincontent'] = $this->load->view('school/school_details', $data, TRUE);
        // $this->load->view('master_dashboard', $data);
	// }
	
	public function school_info_details(){
		$data['user_info']=$this->School_model->userInfo($this->session->userdata('user_id'));

		$data['tutor_info']=$this->School_model->getTutorInfo($this->session->userdata('user_id'));
		//echo '<pre>';print_r($data['tutor_info']);die;
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		$data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
		$data['header'] = $this->load->view('dashboard_template/header', $data, true);
		$data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
		$data['maincontent'] = $this->load->view('school/school_details', $data, TRUE);
		$this->load->view('master_dashboard', $data);
	}
	
	// public function update_school_details(){
		// $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[6]|min_length[5]');
		// $this->form_validation->set_rules('passconf', 'passconf', 'trim|required|matches[password]');
		// if($this->form_validation->run()==false)
		// {
			// echo 0;
		// }else{
			// $password=md5($this->input->post('password'));
			// $data = array(
					// 'user_pawd' =>$password
			// );
			// $this->School_model->updateInfo('tbl_useraccount','id',$this->session->userdata('user_id'),$data);
			// echo 1;
		// }
	// }
	
	public function update_school_details() {
        $update_password_array = $this->input->post('passwords');
        $update_name_array = $this->input->post('name');
        $update_teacher_id = $this->input->post('update_teacher_id');

        $insert_passwords_array = $this->input->post('insert_passwords');
        $insert_name_array = $this->input->post('insert_name');
        $SCT_link = $this->input->post('SCT_link');
        $country_id = $this->input->post('country_id');



        if (!empty($insert_name_array)) {
            $i = 0;
            foreach ($insert_name_array as $insertName) {
                $data['name'] = $insertName;
                $data['user_pawd'] = md5($insert_passwords_array[$i]);
                $data['user_email'] = $insertName;
                $data['SCT_link'] = $SCT_link;
                $data['country_id'] = $country_id;
				$data['user_type'] = 3;
                $data['created'] = time();
                $data['parent_id'] = $this->session->userdata('user_id');
                $this->School_model->insertId('tbl_useraccount', $data);
                $i++;
            }
        }


        if (!empty($update_name_array)) {
            $j = 0;
            foreach ($update_name_array as $upName) {
                $user_pawd = md5($update_password_array[$j]);
                $teacher_own_id = $update_teacher_id [$j];
                $update_data = array(
                    'name' => $upName,
                    'user_email' => $upName,
                    'user_pawd' => $user_pawd
                );
                // $this->School_model->tutorUpdateInfo('tbl_useraccount', 'id', $teacher_own_id, $update_data);
                $this->School_model->updateInfo('tbl_useraccount', 'id', $teacher_own_id, $update_data);

                $j++;
            }
        }
		 

        if ($this->input->post('password') != '') {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[6]|min_length[5]');
            $this->form_validation->set_rules('passconf', 'passconf', 'trim|required|matches[password]');

            if ($this->form_validation->run() == false) {
                echo 0;
            } else {
                $password = md5($this->input->post('password'));
                $data = array(
                    'user_pawd' => $password
                );
                $this->School_model->updateInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'), $data);
                echo 1;
            }
        }else{	
        	echo 1;
        }
    }
	
	public function school_logo(){
		$data['user_info']=$this->School_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		$data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('school/upload', $data, TRUE);
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
	public function school_logo_upload()
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
			$rs['res']=$this->School_model->updateInfo('tbl_useraccount','id',$this->session->userdata('user_id'),$data);
			echo 1;
		 }
		
	}
}
