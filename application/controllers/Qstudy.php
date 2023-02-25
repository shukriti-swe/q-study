<?php

class Qstudy extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();

        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        if ($user_id == null && $user_type == null) {
            redirect('welcome');
        }
        $this->load->model('qstudy_model');
        $this->load->model('Student_model');
        $this->load->model('Admin_model');
        $this->load->library('upload');
    }

    public function index()
    {
        
        $data['user_info'] = $this->qstudy_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $this->session->unset_userdata('selCountry');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('qstudy/qstudy_dashboard', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function student_setting()
    {
        $data['user_info'] = $this->qstudy_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('qstudy/student_setting', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function student_details()
    {
        $data['user_info'] = $this->qstudy_model->userInfo($this->session->userdata('user_id'));
        $data['studentRefLink'] = $this->qstudy_model->getStudentRefLink($this->session->userdata('user_id'));
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('qstudy/student_details', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function update_student_details()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[6]|min_length[5]');
        $this->form_validation->set_rules('passconf', 'passconf', 'trim|required|matches[password]');
        if ($this->form_validation->run() == false) {
            echo 0;
        } else {
            $password = md5($this->input->post('password'));
            $data = array(
                'user_pawd' => $password
            );
            $this->qstudy_model->updateInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'), $data);
            echo 1;
        }
    }

    public function my_enrollment()
    {
        $data['user_info'] = $this->qstudy_model->userInfo($this->session->userdata('user_id'));
        $data['get_involved_teacher'] = $this->qstudy_model->get_sct_enrollment_info($this->session->userdata('user_id'), 3);
        $data['get_involved_school'] = $this->qstudy_model->get_sct_enrollment_info($this->session->userdata('user_id'), 4);
        $data['get_involved_corporate'] = $this->qstudy_model->get_sct_enrollment_info($this->session->userdata('user_id'), 5);
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('qstudy/my_enrollment_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function save_ref_link()
    {
        $data_link = $this->input->post('link');
        if (!empty($data_link)) {
            $userType = $this->input->post('userType');
            $j = 0;
            foreach ($data_link as $single_link) {
                if ($single_link) {
                    $get_link_validate = $this->qstudy_model->getLinkInfo('tbl_useraccount', 'SCT_link', 'user_type', $single_link, $userType);
                    if (!$get_link_validate) {
                        $j++;
                    }
                }
            }
            if ($j > 0) {
                echo 2;
            } else {
                $this->qstudy_model->delete_enrollment($userType, $this->session->userdata('user_id'));
                foreach ($data_link as $single_link) {
                    $get_link_status = $this->qstudy_model->getLinkInfo('tbl_useraccount', 'SCT_link', 'user_type', $single_link, $userType);

                    if ($get_link_status) {
                        $enrollment_info = $this->qstudy_model->getLinkInfo('tbl_enrollment', 'sct_id', 'st_id', $get_link_status[0]['id'], $this->session->userdata('user_id'));
                        //echo '<pre>';print_r($get_link_status);die;
                        if (!$enrollment_info) {
                            $link['sct_id'] = $get_link_status[0]['id'];
                            $link['sct_type'] = $get_link_status[0]['user_type'];
                            $link['st_id'] = $this->session->userdata('user_id');
                            $this->qstudy_model->insertInfo('tbl_enrollment', $link);
                        }
                    }
                }

                echo 1;
            }
        } else {
            echo 0;
        }
    }

    public function get_ref_link()
    {
        $user_type = $this->input->post('user_type');
        $st_id = $this->session->userdata('user_id');
        $enrollment_info = $this->qstudy_model->get_sct_enrollment_info($st_id, $user_type);
        echo json_encode($enrollment_info);
    }

    public function student_upload_photo()
    {
        $data['user_info'] = $this->qstudy_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('qstudy/upload', $data, true);
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
        $config['overwrite'] = false;
        return $config;
    }

    public function sure_student_photo_upload()
    {
        $this->upload->initialize($this->upload_user_photo_options());
        if (!$this->upload->do_upload('file')) {
            echo 0;
        } else {
            $imageName = $this->upload->data();
            $user_profile_picture = $imageName['file_name'];
            $data = array(
                'image' => $user_profile_picture
            );
            $rs['res'] = $this->qstudy_model->updateInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'), $data);
            echo 1;
        }
    }

    public function courseCountrySelect()
    {
        $this->session->unset_userdata('modInfo');
        $this->session->unset_userdata('selCountry');

        $data['countries'] = $this->Admin_model->search('tbl_country', [1=>1]);
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('qstudy/course_country', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function view_course()
    {
		if(isset($_SESSION['list_submit']) && $_SESSION['list_submit'] == 1)
        {
            unset($_SESSION['list_submit']);
        }
        $data['countryScope'] = isset($_GET['country']) ? '?country='.$_GET['country'] : '';
        if (isset($_GET['country'])) {
            $this->session->set_userdata('selCountry', $_GET['country']);
            $countries = $this->Admin_model->getCountry($_GET['country']);
            
            if($_GET['country']==1){
                $this->session->set_userdata('setCountryName','Australia');
            }else{
                $this->session->set_userdata('setCountryName',$countries['countryName']);
            }
            
        }
        $data['user_info'] = $this->qstudy_model->userInfo($this->session->userdata('user_id'));
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
		$data['user_type'] = $data['user_info'][0]['user_type'];
        $data['maincontent'] = $this->load->view('tutors/view_course', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function duplicateQuestionRemove()
    {
        $questions = $this->Admin_model->search('tbl_question', [1=>1]);
        foreach ($questions as $question) {
            $conditions = [
                'questionName' => $question['questionName'],
                'answer' => $question['answer'],
                'questionType' => $question['questionType'],
                'subject' => $question['subject'],
                'chapter' => $question['chapter'],
            ];
            $duplicates = $this->Admin_model->search('tbl_question', $conditions);
            $duplicateIds = array_column($duplicates, 'id');
            $duplicateIds = array_diff($duplicateIds, [$question['id']]);
            if ($duplicateIds) {
                $this->Admin_model->delMulti('tbl_question', $duplicateIds);
            }
        }
    }

    public function duplicateModuleRemove()
    {
        $modules = $this->Admin_model->search('tbl_module', [1=>1]);
        foreach ($modules as $module) {
            $conditions = [
                'moduleName' => $module['moduleName'],
                'trackerName' => $module['trackerName'],
                'moduleType' => $module['moduleType'],
                'subject' => $module['subject'],
                'chapter' => $module['chapter'],
            ];
            $duplicates = $this->Admin_model->search('tbl_module', $conditions);
            $duplicateIds = array_column($duplicates, 'id');
            $duplicateIds = array_diff($duplicateIds, [$module['id']]);
            if ($duplicateIds) {
                $this->Admin_model->delMulti('tbl_module', $duplicateIds);
            }
        }
    }

    public function data_input()
    {

         $this->session->unset_userdata('modInfo');
         $data['countries'] = $this->Admin_model->get_all_where('*', 'tbl_useraccount' , 'subscription_type' , 'data_input' );

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('qstudy/data_input_people', $data, true);
        $this->load->view('master_dashboard', $data);

    }

    public function data_input_personal($id)
    {

        $var =array();

        $this->session->unset_userdata('modInfo');

        $all_type_question = $this->Admin_model->getAllInfo('tbl_questiontype');

        foreach ($all_type_question as $key => $value) {
            $all_type_and_question = $this->Admin_model->get_questions($id , $value['id']);

            $var[] = [

                "id" => $value['id'],
                "questionType" => $value['questionType'],
                "all_question" => $all_type_and_question,

            ];
        }

        $data['all_question_type'] = $var;
        $data['user_id'] = $id;

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('qstudy/data_input_question', $data, true);
        $this->load->view('master_dashboard', $data);

    }
}
