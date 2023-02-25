<?php


class Parents extends CI_Controller{
    public function __construct() {
        parent::__construct();
        
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        if($user_id == NULL && $user_type == NULL){
            redirect('welcome');
        }
         $this->load->model('Parent_model');
		 $this->load->helper(array('form', 'url'));
	     $this->load->library('form_validation');
		 $this->load->library('upload');
         $this->load->model('RegisterModel');
         $this->load->model('admin_model');
    }
    
     public function index() 
	 {
		$data['user_info']=$this->Parent_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		
		// echo '<pre>';print_r($data['user_info']);die;
		
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('parents/parent_dashboard', $data, TRUE);
        $this->load->view('master_dashboard', $data);
    }
	public function parent_setting()
	{
		
		$data['user_info']=$this->Parent_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
		if ($data['user_info'][0]['subscription_type'] == "direct_deposite" && $data['user_info'][0]['direct_deposite'] == 0 ) {
          	redirect($_SERVER['HTTP_REFERER']);
          }  
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		$data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('parents/parent_setting', $data, TRUE);
        $this->load->view('master_dashboard', $data);
	}
	public function my_details()
	{
		$data['user_info']=$this->Parent_model->userInfo($this->session->userdata('user_id'));
		$data['user_child_info']=$this->Parent_model->userChildInfo($this->session->userdata('user_id'));
		$data['total_child']=count($data['user_child_info']);
	   // echo "<pre>"; print_r($data);die;
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		$data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('parents/my_details', $data, TRUE);
        $this->load->view('master_dashboard', $data);
	}
	public function update_my_details()
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
			$this->Parent_model->updateInfo('tbl_useraccount','id',$this->session->userdata('user_id'),$data);
			$newChild = $this->input->post('childName');
			$childgrade = $this->input->post('childgrade');
			if($newChild != null){
			    
                $st['name'] = $newChild;
                $pieces = explode(" ", $st['name']);
                $random_number = rand(100, 999);
                $st['user_email']=$pieces[0];
                $raw_st_data['st_name']=$pieces[0];
                $raw_st_data['st_password']=$pieces[0].$random_number;
                $st['user_pawd']=md5($pieces[0].$random_number);

                $user_pswd[] = ($pieces[0].$random_number);
                $this->session->set_userdata('st_password', $user_pswd);
                $st['parent_id']=$this->session->userdata('user_id');
                $st['user_type']=6;
                $st['country_id']=$this->input->post('country_id');
                $st['subscription_type']='trial';

                $st['student_grade']=$childgrade;
                $st['created']=time();
                $this->load->helper('string');
                $st['SCT_link'] = random_string('alnum', 10);
                $student_id = $this->RegisterModel->basicInsert('tbl_useraccount', $st);
                
                //send details
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
                echo 2;
			}else{
			    echo 1;
			    
			}
		}
	}
	public function upload_photo()
	{
		$data['user_info']=$this->Parent_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
		$data['page_title'] = '.:: Q-Study :: Tutor yourself...';
		$data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);        
        $data['maincontent'] = $this->load->view('parents/upload', $data, TRUE);
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
	public function parent_dropzone_file()
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
			$rs['res']=$this->Parent_model->updateInfo('tbl_useraccount','id',$this->session->userdata('user_id'),$data);
			echo 1;
		 }
		
	}
}
