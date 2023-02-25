<?php

class Student extends CI_Controller
{
    public $loggedUserId, $loggedUserType;
    public function __construct()
    {
        parent::__construct();

        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        $this->loggedUserId = $this->session->userdata('user_id');
        $this->loggedUserType = $this->session->userdata('userType');
        if ($user_id == null && $user_type == null) {
            redirect('welcome');
        }
        
        $this->load->model('Student_model');
        $this->load->model('ModuleModel');
        $this->load->model('tutor_model');
		$this->load->model('Admin_model');
        $this->load->model('Preview_model');
        $this->load->model('FaqModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('user_agent');

        $this->loggedUserId = $this->session->userdata('user_id');
        
        $user_info = $this->Preview_model->userInfo($user_id);

        if ($user_info[0]['countryCode'] == 'any') {
            $user_info[0]['zone_name'] = 'Australia/Lord_Howe';
        }

        $this->site_user_data = array(
            'userType' => $user_type,
            'zone_name' => $user_info[0]['zone_name'],
            'student_grade' => $user_info[0]['student_grade'],
        );
    }

    public function index()
    {
        //removing tutorial module answer

        if ($this->session->userdata('userType') == 6) {
            $data['video_help'] = $this->FaqModel->videoSerialize(4, 'video_helps');
            $data['video_help_serial'] = 4;
        }

        $_SESSION['prevUrl'] = base_url('/').'student';
        
        $this->Student_model->deleteInfo('tbl_temp_tutorial_mod_ques', 'st_id', $this->session->userdata('user_id'));
        
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        $havtutor_2 = array();

        $havtutor = $this->Student_model->getInfo_tutor('tbl_enrollment', 'st_id', $this->session->userdata('user_id'));
        foreach ($havtutor as $key => $value) {
            $havtutor_2[] = $this->Student_model->getInfo('tbl_classrooms', 'tutor_id', $value['sct_id'] );
        }

        $links = array();

        foreach ($havtutor_2 as $key => $value) {
            if (count($value)) {
                if ($value[0]['all_student_checked']) {
                    $link[0] = base_url('/yourClassRoom/').$value[0]['id'];
                    $link[1] = $value[0]['tutor_name'];
                    $links[] = $link;
                    $link = array();
                }else{
                    $x = json_decode($value[0]['students']);
                    foreach ($x as $key => $val) {
                        if ($val == $this->session->userdata('user_id') ) {
                            $link[0] = base_url('/yourClassRoom/').$value[0]['id'];
                            $link[1] = $value[0]['tutor_name'];
                            $links[] = $link;
                            $link = array();
                        }
                    }
                }
            }
        }

        $data['class_rooms'] = $links;

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('students/students_dashboard', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function student_setting()
    {
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('students/student_setting', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function student_details()
    {
        $data['user_info'] = $this->Student_model->userInfo($this->session->userdata('user_id'));
        $data['studentRefLink'] = $this->Student_model->getStudentRefLink($this->session->userdata('user_id'));
        $data['student_course'] = $this->Student_model->studentCourses($this->session->userdata('user_id'));
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('students/student_details', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function update_student_details()
    {
        // $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]');
        // $this->form_validation->set_rules('passconf', 'passconf', 'trim|matches[password]');
        // if ($this->form_validation->run() == false) {
            // redirect('student_details');
        // } else {
            // $password = md5($this->input->post('password'));
            // $grade = $this->input->post('student_grade');

            // $data = array(
                // 'user_pawd' => $password,
                // 'student_grade' => $grade,
            // );
            // $this->Student_model->updateInfo('tbl_useraccount', 'id', $this->loggedUserId, $data);
            // $this->session->set_flashdata('success_msg', 'Account updated successfully!');
            // redirect('student_details');
        // }
        
        if ($this->input->post('password')) {
            $data['user_pawd'] = md5($this->input->post('password'));
        }
        
        $data['student_grade'] = $this->input->post('student_grade');

        $this->Student_model->updateInfo('tbl_useraccount', 'id', $this->loggedUserId, $data);
        $this->session->set_flashdata('success_msg', 'Account updated successfully!');
        redirect('student_details');
    }

    public function my_enrollment()
    {
        $data['user_info'] = $this->Student_model->userInfo($this->session->userdata('user_id'));
        $data['get_involved_teacher'] = $this->Student_model->get_sct_enrollment_info($this->session->userdata('user_id'), 3);
        $data['get_involved_school'] = $this->Student_model->get_sct_enrollment_info($this->session->userdata('user_id'), 4);
        $data['get_involved_corporate'] = $this->Student_model->get_sct_enrollment_info($this->session->userdata('user_id'), 5);
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('students/my_enrollment_list', $data, true);
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
                    $get_link_validate = $this->Student_model->getLinkInfo('tbl_useraccount', 'SCT_link', 'user_type', $single_link, $userType);
                    if (!$get_link_validate) {
                        $j++;
                    }
                }
            }
            
            if ($j > 0) {
                echo 2;
            } else {
                //                $this->Student_model->delete_enrollment($userType, $this->session->userdata('user_id'));
                foreach ($data_link as $single_link) {
                    $get_link_status = $this->Student_model->getInfo('tbl_useraccount', 'SCT_link', $single_link);
                    //                    $get_link_status = $this->Student_model->getLinkInfo('tbl_useraccount', 'SCT_link', 'user_type', $single_link, $userType);

                    if ($get_link_status) {
                        foreach ($get_link_status as $row) {
                            $enrollment_info = $this->Student_model->getLinkInfo('tbl_enrollment', 'sct_id', 'st_id', $row['id'], $this->session->userdata('user_id'));
                            if (!$enrollment_info) {
                                $link['sct_id'] = $row['id'];
                                $link['sct_type'] = $row['user_type'];
                                $link['st_id'] = $this->session->userdata('user_id');
                                $this->Student_model->insertInfo('tbl_enrollment', $link);
                            }
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
        $enrollment_info = $this->Student_model->get_sct_enrollment_info($st_id, $user_type);
        echo json_encode($enrollment_info);
    }

    public function removeRefLink()
    {
        $post = $this->input->post();
        $ref= $post['sct_link'];
        // $tutorInfo = $this->Student_model->search('tbl_useraccount', ['sct_link'=>$ref]);
        // if (!isset($tutorInfo[0]['id'])) {
        //     echo 'Tutor not exists';
        //     return 0;
        // }
        // $tutorId = $tutorInfo[0]['id'];

        $conditions = [
            'st_id'=>$this->loggedUserId,
            'sct_id' =>$ref,
        ];
        $this->Student_model->delete('tbl_enrollment', $conditions);
        echo $this->db->last_query();
    }

    public function student_upload_photo()
    {
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('students/upload', $data, true);
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
            $rs['res'] = $this->Student_model->updateInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'), $data);
            echo 1;
        }
    }
    
    public function view_course()
    {
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('students/student_course/view_course', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function q_study_course()
    {
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['tutor_type'] = 7;

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('students/student_course/q_study_course', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function all_module_by_type($tutorType, $module_type)
    {
        $session_module_info = $this->session->userdata('data');
        
        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $session_module_info[1]['module_id'], $this->session->userdata('user_id'));
        if ($tutorial_ans_info) {
            $this->Student_model->deleteInfo('tbl_temp_tutorial_mod_ques', 'id', $tutorial_ans_info[0]['id']);
        }
        
        $this->session->unset_userdata('data');
        $this->session->unset_userdata('obtained_marks');
        $this->session->unset_userdata('total_marks');
        $this->session->unset_userdata('isFirst');
        
        $user_country = $this->session->userdata('country_id');
        $data['user_info'] = $this->Student_model->userInfo($this->session->userdata('user_id'));
        $data['subject_info'] = $this->Student_model->subjectInfo($tutorType);
        $data['tutorType']    = $tutorType;
        $data['moduleType']   = $module_type;

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['studentSubjects'] = $this->Student_model->studentSubjects($this->loggedUserId);

        if ($tutorType == 7) {
            $data['tutorInfo'] = $this->Student_model->getInfo('tbl_useraccount', 'user_type', 7);
            $data['tutorImage'] = isset($data['tutorInfo'])?$data['tutorInfo'][0]['image'] : '';


            $data['all_subject_qStudy'] =$this->Student_model->get_all_subject($tutorType);

            $data['all_subject_student'] =$this->Student_model->get_all_subject_for_registered_student($this->session->userdata('user_id'));

            $first_array_q = array_column($data['all_subject_qStudy'], 'subject_id');
            $second_array_st = array_column($data['all_subject_student'], 'subject_id');

            $desired_result = '';
            $result = array_intersect($first_array_q, $second_array_st);
            if ($result) {
                $desired_result = implode(', ', $result);
            }

            $conditions = [];
            $data['all_module'] = $this->Student_model->all_module_by_type($tutorType, $module_type, $desired_result, $conditions);
            $data['maincontent'] = $this->load->view('students/qstudy_module/all_tutorial_list', $data, true);
        }
        
        if ($tutorType == 3) {
            if ($module_type == 1) { //tutorial
                $data['maincontent'] = $this->load->view('students/qstudy_module/all_tutorial_list', $data, true);
            } else { //everyday study, special exam, assignment
                $loggedStudentId  = $this->loggedUserId;
                $studentsTutor = $this->Student_model->allTutor($loggedStudentId);

                $data['sct_info'] = $studentsTutor;

                $allTutors = $data['sct_info'];
                $data['module_info'] = $data['sct_info'];

                $studentClass = $this->Student_model->studentClass($this->loggedUserId);

                $studentMods = [];
                foreach ($allTutors as $tutor) {
                    //get all module by tutor_id and logged student class
                    $allModuleConditions = ['user_id'=>$tutor['id'], 'studentGrade'=>$data['user_info'][0]['student_grade'],'moduleType'=>$module_type];

                    $mods = $this->ModuleModel->allModule($allModuleConditions);

                    $sct_info = array();
                    //$sct_info[$tutor['name']]['tutor_id']=$tutor['sct_id'];
                    //if module checked for all students then following students obviously there, so grab it
                    //if module checked for individual student, then check if student id is there -> if yes grab it
                    foreach ($mods as $module) {
                        if ($module['isAllStudent']) {
                            $sct_info[$tutor['name']][] = $module;
                        } elseif (sizeof($module['individualStudent'])) {
                            if ($module['individualStudent']) {
                                $stIds = json_decode($module['individualStudent']);

                                if (in_array($loggedStudentId, $stIds)) {
                                    $sct_info[$tutor['name']][] = $module;
                                }
                            }
                        }
                    }
                }
                
                $data['module_info'] = isset($sct_info)?$sct_info:null;
                // echo "<pre>";
                // print_r($data['module_info']);

                // die;
                
                $data['maincontent'] = $this->load->view('students/tutor_module/tutor_list', $data, true);
            }
        }

        $this->load->view('master_dashboard', $data);
    }

    public function tutorial($tutorType)
    {
        $user_country = $this->session->userdata('country_id');
        $data['user_info'] = $this->Student_model->userInfo($this->session->userdata('user_id'));
        $data['subject_info'] = $this->Student_model->subjectInfo($tutorType);

        if ($tutorType == 7) {
            $data['all_module'] = $this->Student_model->all_module_by_type($user_country, $tutorType);
        }
        if ($tutorType == 3) {
            $sct_info = $this->Student_model->get_sct_enrollment_info($this->session->userdata('user_id'), $this->session->userdata('userType'));
            $data['all_module'] = $this->Student_model->module_by_type($user_country, $sct_info[0]['sct_id']);
        }


        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('students/tutorial/all_tutorial_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function tutor_course()
    {
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['tutor_type'] = 3;
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        if ($_SESSION['userType'] == 2) {
            $data['tutor_list'] = 1;
        }

        $data['maincontent'] = $this->load->view('students/student_course/q_study_course', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    
    public function video_link($module_id, $module_type)
    {
        redirect('get_tutor_tutorial_module/'.$module_id.'/'.$module_type.'');
        $this->session->unset_userdata('data');
        $this->session->unset_userdata('obtained_marks');
        $this->session->unset_userdata('total_marks');

        $data['user_info'] = $this->Student_model->userInfo($this->session->userdata('user_id'));

        $data['module_info'] = $this->Student_model->module_info($module_id, $module_type, $data['user_info'][0]['student_grade']);
        $data['tutor_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $data['module_info'][0]['user_id']);
        
        date_default_timezone_set($data['user_info'][0]['zone_name']);
        $module_time = time();
        //        if($data['module_info'][0]['exam_date'] == $module_time){
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('students/tutor_module/video_link_by_module', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    // added by sobuj
    private function openModuleByTutorialBased($modle_id, $question_order_id)
    {
        $data['order'] = $this->uri->segment('3'); 
        $_SESSION['q_order'] = $this->uri->segment('3'); 
        $_SESSION['q_order_module'] = $this->uri->segment('2'); 

        $data['module_info'] = $this->Student_model->getInfo('tbl_module', 'id', $modle_id);
        if (!$data['module_info'][0]) {
            show_404();
        }
		if ($data['module_info'][0]['user_type'] == 7) {
           
           $data['qstudy_module_videos'] = $this->ModuleModel->getInfoByOrder('module_instruction_video', 'module_id',$modle_id,'serial_num','ASC');
        }
        $isFirst = 1;
        
        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        
        // Special Exam
        if (!$this->session->userdata('isFirst')) {
            $this->session->set_userdata('isFirst', $isFirst);
            if ($question_order_id == 1) {
                date_default_timezone_set($this->site_user_data['zone_name']);
                //echo 'Exam Time: '.$data['module_info'][0]['exam_start'].'<br>';
                $exact_time = time();
                $this->session->set_userdata('exact_time', $exact_time);
                $this->session->set_userdata('exam_start', $exact_time);
            }
        }
        
        // Everyday Study & Tutorial
        if ($data['module_info'][0]['moduleType'] == 1
            || $data['module_info'][0]['moduleType'] == 2
            || $data['module_info'][0]['moduleType'] == 4
        ) {
            date_default_timezone_set($this->site_user_data['zone_name']);
            $exact_time = time();
            $this->session->set_userdata('exact_time', $exact_time);
            // echo date('Y-m-d H:i:s',$exact_time);die;
            if ($question_order_id == 1) {
                $this->session->set_userdata('exam_start', $exact_time);
            }
        }

        //****** Get Temp table data for Tutorial Module Type ******
    
        if ($data['module_info'][0]['moduleType'] == 2) {
            $table = 'tbl_student_answer';
        } else {
            $table = 'tbl_temp_tutorial_mod_ques';
        }
    
        $data['tutorial_ans_info'] = $this->Student_model->getTutorialAnsInfo($table, $modle_id, $data['user_info'][0]['id']);
    
        $data['question_info_s'] = $this->tutor_model->getModuleQuestion($modle_id, $question_order_id, null);

       
        /*if (!isset($data['question_info_s'][0])) {
            //question not exists
            show_404();
        }*/
        
        if (!$data['question_info_s'][0]['id']) {
            $question_order_id = $question_order_id + 1;
            redirect('get_tutor_tutorial_module/'.$modle_id.'/'.$question_order_id);
        }
        $data['total_question'] = $this->tutor_model->getModuleQuestion($modle_id, null, 1);
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        //video link classify
        $moduleVidLinks = json_decode($data['module_info'][0]['video_link']);
        
        $data['moduleVid'] = count($moduleVidLinks) ? trim($moduleVidLinks[0]):'';
        
        $url = $data['moduleVid'];
        $regex_pattern = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";
        $match;

        if (preg_match($regex_pattern, $url, $match)) {
            //echo "Youtube video id is: ".$match[4];
            $data['moduleVidType'] = 'youtube';
        } else {
            //echo "Sorry, not a youtube URL";
            $data['moduleVidType'] = 'general';
        }
        
        
        
        if ($data['question_info_s'][0]['question_type'] == 1) {
            $_SESSION['q_order_2'] = $this->uri->segment('3'); 
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_general', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 2) {
            $_SESSION['q_order_2'] = $this->uri->segment('3'); 
          
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_true_false', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 3) {
            $_SESSION['q_order_2'] = $this->uri->segment('3'); 
            
            $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_vocabulary', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 4) {
            $_SESSION['q_order_2'] = $this->uri->segment('3'); 
           
            $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_multiple_choice', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 5) {
            $_SESSION['q_order_2'] = $this->uri->segment('3'); 
           
            $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_multiple_response', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 6) {
            $_SESSION['q_order_2'] = $this->uri->segment('3'); 
            $quesInfo = $this->tutor_model->getModuleQuestion($modle_id, $question_order_id, null);

            $data['question_info_s'] = $quesInfo;
            $questionType = $quesInfo[0]['questionType'];
            $quesInfo = json_decode($quesInfo[0]['questionName']);
            $data['question_info_skip'] = json_decode($data['question_info_s'][0]['questionName']);

            $data['numOfRows'] = isset($quesInfo->numOfRows) ? $quesInfo->numOfRows : 0;
            $data['numOfCols'] = isset($quesInfo->numOfCols) ? $quesInfo->numOfCols : 0;
            $data['questionBody'] = isset($quesInfo->question_body) ? $quesInfo->question_body : '';

            $data['questionId'] = $data['question_info_s'][0]['question_id'];
            $data['question_id'] = $data['question_info_s'][0]['question_id'];
            
            $quesAnsItem = $quesInfo->skp_quiz_box;
            $items = $this->indexQuesAns($quesAnsItem);
            $data['skp_box'] = $this->renderSkpQuizPrevTable($items, $data['numOfRows'], $data['numOfCols']);

            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_skip', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 7) {
            $_SESSION['q_order_2'] = $this->uri->segment('3'); 
            
            $data['question_info_left_right'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_matching', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 8) {
            $_SESSION['q_order_2'] = $this->uri->segment('3'); 
            
            $quesInfo     = json_decode($data['question_info_s'][0]['questionName']);
            $questionBody            = isset($quesInfo->question_body) ? $quesInfo->question_body : '';
            $data['questionBody']    = $questionBody;
            $items                   = $quesInfo->assignment_tasks;
            $data['totalItems']      = count($items);
            $data['assignment_list'] = $this->renderAssignmentTasks($items);
            
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_assignment', $data, true);
            $this->load->view('master_dashboard', $data);
        } elseif ($data['question_info_s'][0]['questionType'] == 9) {
            $_SESSION['q_order_2'] = $this->uri->segment('3'); 
            $info = array();
            $titles = array();
            $title = array();

            // print_r(json_decode($data['question_info'][0]['questionName'])); die();
            //title
            foreach (json_decode($data['question_info_s'][0]['questionName'])->wrongTitles as $key => $value) {
                $title[0] = $value;
                $title[1] = json_decode($data['question_info_s'][0]['questionName'])->wrongTitlesIncrement[$key];
                $titles[] = $title;
            }

            $title[0] = json_decode($data['question_info_s'][0]['questionName'])->rightTitle;
            $title[1] = "right_ones_xxx";
            $titles[] = $title;
            shuffle($titles);
            $info['titles'] = $titles;

            //intro

            $titles = array();
            $title = array();

            foreach (json_decode($data['question_info_s'][0]['questionName'])->wrongIntro as $key => $value) {
                $title[0] = $value;
                $title[1] = json_decode($data['question_info_s'][0]['questionName'])->wrongIntroIncrement[$key];
                $titles[] = $title;
            }

            $title[0] = json_decode($data['question_info_s'][0]['questionName'])->rightIntro;
            $title[1] = "right_ones_xxx";
            $titles[] = $title;
            shuffle($titles);
            $info['Intro'] = $titles;

            //picture

            $titles = array();
            $title = array();

            foreach (json_decode($data['question_info_s'][0]['questionName'])->pictureList as $key => $value) {
                $title[0] = $value;
                $title[1] = "wrong_ones_xxx";
                $titles[] = $title;
            }

            $title[0] = json_decode($data['question_info_s'][0]['questionName'])->lastpictureSelected;
            $title[1] = "right_ones_xxx";
            $titles[] = $title;
            shuffle($titles);
            $info['picture'] = $titles;

            //paragraph
            $titles = array();
            $title = array();

            foreach (json_decode($data['question_info_s'][0]['questionName'])->Paragraph as $key => $value) {
                $title[0] = $value;
                $title[1] = "right_ones_xxx";
                $titles[$key] = $title;
            }
            foreach (json_decode($data['question_info_s'][0]['questionName'])->PuzzleParagraph as $key => $value) {
                $title[0] = $value;
                $title[1] = "wrong_ones_xxx";
                $titles[$key] = $title;
            }

            ksort($titles);
            $i = 1;

            $paragraph =array();
            foreach ($titles as $key => $value) {
                $paragraph[$i] = $value;
                $i++;
            }
            
            $info['paragraph'] = $paragraph;
            //picture

            $titles = array();
            $title = array();

            foreach (json_decode($data['question_info_s'][0]['questionName'])->wrongConclution as $key => $value) {
                $title[0] = $value;
                $title[1] = "wrong_ones_xxx";
                $titles[] = $title;
            }

            $title[0] = json_decode($data['question_info_s'][0]['questionName'])->rightConclution;
            $title[1] = "right_ones_xxx";
            $titles[] = $title;
            shuffle($titles);

            $info['conclution'] = $titles;

            $data['question'] = $info;

            $data['maincontent']     = $this->load->view('students/question_module_type_tutorial/ans_storyWrite', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 10) {
            $_SESSION['q_order_2'] = $this->uri->segment('3'); 
            
            $data['question_info']   = json_decode($data['question_info_s'][0]['questionName'], true);
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_times_table', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 11) {
            $_SESSION['q_order_2'] = $this->uri->segment('3'); 
            
            $data['question_info']   = json_decode($data['question_info_s'][0]['questionName'], true);
            //                echo '<pre>';print_r($data['question_info']);die;
            $data['maincontent']     = $this->load->view('students/question_module_type_tutorial/ans_algorithm', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 12) {
            $_SESSION['q_order_2'] = $this->uri->segment('3'); 
            
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_workout_quiz', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 13) {
            $_SESSION['q_order_2'] = $this->uri->segment('3'); 
            
            $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_matching_workout', $data, true);
        }elseif ($data['question_info_s'][0]['question_type'] == 14) {
         
            $_SESSION['q_order_2'] = $this->uri->segment('3'); 
            if (!empty($_SERVER['HTTP_REFERER'])) {
                $_SESSION["previous_page"] = $_SERVER['HTTP_REFERER'];

                $data["last_question_order"] = $_SESSION['q_order_2'];
                // print_r($_SESSION["previous_page"]); die();
                $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
                // print_r(['question_info_vcabulary']); die();
				$tutorialId = $data['question_info_s'][0]['question_id'];
                $data['tutorialInfo'] = $this->tutor_model->getInfo('for_tutorial_tbl_question', 'tbl_ques_id', $tutorialId);
                $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_tutorial', $data, true);
            }
            else{
                // print_r($_SESSION["previous_page"]); die();
                redirect($_SESSION["previous_page"]);

            }
            
        }elseif ($data['question_info_s'][0]['questionType'] == 15)
        {
            $data['question_item']=$data['question_info_s'][0]['questionType'];
            $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['question_info_ind'] = $data['question_info'];
			if (isset($data['question_info_ind']->percentage_array))
            {
                $data['ans_count'] = count((array)$data['question_info_ind']->percentage_array);
            }else
            {
                $data['ans_count'] = 0;
            }
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_workout_quiz_two', $data, true);

        }elseif ($data['question_info_s'][0]['questionType'] == 16)
        {
            $data['question_item']=$data['question_info_s'][0]['questionType'];
            $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['question_info_ind'] = $data['question_info'];

            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_memorization', $data, true);

        }

        if ($data['question_info_s'][0]['question_type'] != 8) {
            $this->load->view('master_dashboard', $data);
        }
    }
    
    public function renderAssignmentTasks(array $items)
    {
        $row = '';
        foreach ($items as $task) {
            $task = json_decode($task);
            $row .= '<tr id="'.($task->serial + 1).'">';
            $row .= '<td>'.($task->serial + 1).'</td>';
            $row .= '<td>'.$task->qMark.'</td>';
            $row .= '<td>'.$task->qMark.'</td>';
            $row .= '<td><a class="qDtlsOpenModIcon"><img src="assets/images/icon_details.png"></a></td>';
            $row .= '<input type="hidden" id="hiddenTaskDesc" value="'.$task->description.'">';
            $row .= '</tr>';
        }

        return $row;
    }//end renderAssignmentTasks()

    public function get_tutor_tutorial_module($modle_id, $question_order_id)
    {
        
        $select = '*';
        $table = 'tbl_module';
        
        $columnName = 'id';
        $columnValue = $modle_id;

		$this->session->unset_userdata('memorization_one');
        $this->session->unset_userdata('memorization_two');
        $this->session->unset_userdata('memorization_three');
        $this->session->unset_userdata('memorization_std_ans');
        $this->session->unset_userdata('memorization_three_part');
        $this->session->unset_userdata('memorization_two_part');
        $this->session->unset_userdata('memorization_one_part');
        $this->session->unset_userdata('memorization_answer_right');
		$this->session->unset_userdata('memorization_answer_wrong');
		
        $data['user_info'] = $this->Student_model->userInfo($this->session->userdata('user_id'));
        $module_type = $this->tutor_model->get_all_where($select, $table, $columnName, $columnValue);
        // Get Student Ans From tbl_student_answer
        $flag = 0;
        $get_student_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_student_answer', $modle_id, $this->session->userdata('user_id'));
        // print_r($get_student_ans_info);
        if ($module_type[0]['moduleType'] != 2) {
            if ($get_student_ans_info) {
                $flag = 1;
            }
        }
		
		if ($module_type[0]['moduleType'] == 2) {
            $repition_days = json_decode($module_type[0]['repetition_days']);
            function fix($n)
            {
                if ($n) {
                    $val = (explode('_', $n));
                    return $val[1];
                }
            }
            $b = array();
            if ($repition_days) {
                $b = array_map("fix", $repition_days);
            }
            
            $today = date('Y-m-d');
            
            if (in_array($today, $b) && $get_student_ans_info) {
                $st_ans = json_decode($get_student_ans_info[0]['st_ans'], true);
                
                foreach ($st_ans as $row) {
                    $get_specific_error_ans = $this->Student_model->get_specific_error_ans($row['question_id'], $question_order_id, $modle_id, $this->session->userdata('user_id'));
                    
                    if ($row['question_order_id'] == $question_order_id && !$get_specific_error_ans) {
                        //$flag = 1;
                    }
                    
                    if ($row['ans_is_right'] == 'correct' && $row['question_order_id'] == $question_order_id) {
                        $flag = 1;
                    }
                }
            }
        }
        
        if (!$module_type || $flag) {
            redirect('error_page');
        }
        
        if ($module_type[0]['moduleType'] == 1) {
            $tbl_module_ans = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques_two', $modle_id, $this->session->userdata('user_id'));

            if (count($tbl_module_ans)) {
                $data =array();
                foreach (json_decode($tbl_module_ans[0]['st_ans']) as $key => $value) {
                    $ind_ans = array(
                       'question_order_id' => $value->question_order_id,
                       'module_type' => $value->module_type,
                       'module_id' => $value->module_id,
                       'question_id' => $value->question_id,
                       'link' => $value->link,
                       'student_ans' => $value->student_ans,
                       'workout' => $value->workout,
                       'student_taken_time' => $value->student_taken_time,
                       'student_question_marks' => $value->student_question_marks,
                       'student_marks' => $value->student_marks,
                       'ans_is_right' => $value->ans_is_right
                    );

                    $data[$key] = $ind_ans;
                }
                $this->session->set_userdata('data', $data);
                $this->session->set_userdata('obtained_marks', $tbl_module_ans[0]['obtained_marks']);
                $this->session->set_userdata('total_marks', $tbl_module_ans[0]['total_marks']);
            }

            $this->openModuleByTutorialBased($modle_id, $question_order_id);
            
        } elseif ($module_type[0]['moduleType'] == 2) {

            $x = $_SESSION;

            if (isset($x['data_exist_session']) && $x['data_exist_session'] ==1 ) {
                $tbl_module_ans = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques_two', $modle_id, $this->session->userdata('user_id'));

                if (count($tbl_module_ans)) {
                    $data =array();
                    foreach (json_decode($tbl_module_ans[0]['st_ans']) as $key => $value) {
                        $ind_ans = array(
                           'question_order_id' => $value->question_order_id,
                           'module_type' => $value->module_type,
                           'module_id' => $value->module_id,
                           'question_id' => $value->question_id,
                           'link' => $value->link,
                           'student_ans' => $value->student_ans,
                           'workout' => $value->workout,
                           'student_taken_time' => $value->student_taken_time,
                           'student_question_marks' => $value->student_question_marks,
                           'student_marks' => $value->student_marks,
                           'ans_is_right' => $value->ans_is_right
                        );

                        $data[$key] = $ind_ans;
                    }
                    $this->session->set_userdata('data', $data);
                    $this->session->set_userdata('obtained_marks', $tbl_module_ans[0]['obtained_marks']);
                    $this->session->set_userdata('total_marks', $tbl_module_ans[0]['total_marks']);
                }
            }
            
            $this->openModuleByTutorialBased($modle_id, $question_order_id);
        } elseif ($module_type[0]['moduleType'] == 3) {
            $data['module_info'] = $this->Student_model->module_info($modle_id, $module_type[0]['moduleType'], $data['user_info'][0]['student_grade']);
            
            date_default_timezone_set($data['user_info'][0]['zone_name']);
            // date_default_timezone_set('Asia/Dhaka');
            $module_time = time();

            $date_now = date('Y-m-d');


            
            if ((strtotime($data['module_info'][0]['exam_start']) < $module_time) && (strtotime($data['module_info'][0]['exam_end']) > $module_time)) {
                $this->openModuleByTutorialBased($modle_id, $question_order_id);
            } elseif ($date_now == trim($data['module_info'][0]['exam_start']) && $data['module_info'][0]['optionalTime'] >0 ) {
     
                $this->openModuleByTutorialBased($modle_id, $question_order_id);
            }
             elseif (strtotime($data['module_info'][0]['exam_end']) < $module_time && $data['module_info'][0]['optionalTime'] ==0 ) {
                show_404();
            } else {
                $this->session->set_flashdata('message_name', 'Your exam will start at '.date('h:i A', strtotime($data['module_info'][0]['exam_start'])));
                redirect('all_tutors_by_type/'.$module_type[0]['user_id'].'/'.$data['module_info'][0]['moduleType']);
            }
        } elseif ($module_type[0]['moduleType'] == 4) {
            $this->openModuleByTutorialBased($modle_id, $question_order_id);
        }
    }

    private function check_browser_back_next_previlige($gurd_array, $question_order_id)
    {
        if (is_array($gurd_array)) {
            if (array_key_exists($question_order_id, $gurd_array)) {
                $has_module_type = $gurd_array[$question_order_id]['module_type'];
                if ($has_module_type) {
                    if ($has_module_type == 1) {
                        return;
                    } else {
                        $hasData = $gurd_array[$question_order_id]['question_id'];
                        if ($hasData) {
                            $redirect_order_id = $question_order_id + 1;
                            redirect('get_tutor_tutorial_module/' . $gurd_array[$question_order_id]['module_id'] . '/' . $redirect_order_id);
                        } else {
                            return;
                        }
                    }
                }
            }
        } else {
            return;
        }
    }

    /**
     * before passing items to renderSkpQuizPrevTable() index it first with this func
     *
     * @param  array $items json object array
     * @return array        array with proper indexing
     */
    public function indexQuesAns($items)
    {
        // print_r($items);die;
        $arr = [];
        foreach ($items as $item) {
            $temp = json_decode($item);
            if ($temp == '')
            {

            }else{
                $cr = explode('_', $temp->cr);
                //print_r($cr);die;
                $col = $cr[0];
                $row = $cr[1];
                $arr[$col][$row] = array(
                    'type' => $temp->type,
                    'val' => $temp->val
                );
            }
        }
        return $arr;
    }

    /**
     * Render the indexed item to table data for preview
     *
     * @param array   $items   ques ans as indexed item
     * @param int     $rows    num of row in table
     * @param int     $cols    num of cols in table
     * @param integer $showAns optional, set 1 will show the answers too
     *
     * @return string           table item
     */
    public function renderSkpQuizPrevTable($items, $rows, $cols, $showAns = 0)
    {
        //print_r($items);die;
        $row = '';
        for ($i = 1; $i <= $rows; $i++) {
            $row .='<div class="sk_out_box">';
            for ($j = 1; $j <= $cols; $j++) {
                if ($items[$i][$j]['type'] == 'q') {
                    $row .= '<div class="sk_inner_box"><input type="button" data_q_type="0" data_num_colofrow="" value="' . $items[$i][$j]['val'] . '" name="skip_counting[]" class="form-control input-box  rsskpinpt' . $i . '_' . $j . '" readonly style="min-width:50px; max-width:50px"></div>';
                } else {
                    $ansObj = array(
                        'cr' => $i . '_' . $j,
                        'val' => $items[$i][$j]['val'],
                        'type' => 'a',
                    );
                    $ansObj = json_encode($ansObj);
                    $val = ($showAns == 1) ? ' value="' . $items[$i][$j]['val'] . '"' : '';

                    $row .= '<div class="sk_inner_box"><input autocomplete="off" type="text" ' . $val . ' data_q_type="0" data_num_colofrow="' . $i . '_' . $j . '" value="" name="skip_counting[]" class="form-control input-box ans_input  rsskpinpt' . $i . '_' . $j . '"  style="min-width:50px; max-width:50px">';
                    $row .= '<input type="hidden" value="" name="given_ans[]" id="given_ans">';
                    $row .='</div>';
                }
            }
            $row .= '</div>';
        }

        return $row;
    }

    private function take_decesion_1_old_22_6($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, $answer_info = null)
    {
        // $this->session->unset_userdata('data');
        //****** Get Temp table data for Tutorial Module Type ******
        $question_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

        $question_info_type = '';
        $question_info_type = $question_info[0]['questionType'];
        $question_info_pattern = '';
        $question_info_pattern = json_decode($question_info[0]['questionName']);
        if (isset($question_info_pattern->pattern_type))
        {
            $question_info_pattern = $question_info_pattern->pattern_type;
        }
        $user_id = $this->session->userdata('user_id');
        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $module_id, $user_id);
        //        print_r($tutorial_ans_info);die;
        $obtained_marks = $this->session->userdata('obtained_marks');
        $total_marks = $this->session->userdata('total_marks');
        $ans_array = $this->session->userdata('data');
        
        $flag = 0;
        
        if (!is_array($ans_array)) {
            $ans_array = array();
            $obtained_marks = 0;
            $total_marks = 0;
            $flag = 0;
        } else {
            $question_idd = '';
            if (isset($ans_array[$question_order_id]['question_id'])) {
                $question_idd = $ans_array[$question_order_id]['question_id'];
            }

            if ($question_id == $question_idd) {
                $flag = 1;
            } else {
                $flag = 0;
            }
            if ($question_info_type == 16)
            {
                if ($question_info_pattern == 1)
                {
                    $memorization_answer = $this->input->post('memorization_answer');
                    $memorization_part = $this->input->post('memorization_one_part');
                    if ($memorization_part == 1)
                    {
                        if (isset($_SESSION['memorization_one_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_one_part',1);
                            $ans_is_right = $memorization_answer;
                        }
                    }elseif($memorization_part == 2){
                        if (isset($_SESSION['memorization_two_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_two_part',2);
                            $ans_is_right = $memorization_answer;
                        }
                    }elseif ($memorization_part == 3){
                        if (isset($_SESSION['memorization_three_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_three_part',3);
                            $ans_is_right = $memorization_answer;
                        }
                    }
                }else
                {
                    $this->session->unset_userdata('memorization_three_part');
                    $this->session->unset_userdata('memorization_two_part');
                    $this->session->unset_userdata('memorization_one_part');
                }
            }else
            {
                $this->session->unset_userdata('memorization_three_part');
                $this->session->unset_userdata('memorization_two_part');
                $this->session->unset_userdata('memorization_one_part');
            }
        }
        
        $student_ans = '';
        if ($this->input->post('answer')) {
            $student_ans = $this->input->post('answer');
        }
        
        if ($tutorial_ans_info) {
            $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'], true);
            $flag = 2;
        }
        

        if ($ans_is_right == 'correct') {
            //            echo $ans_is_right;die;
           
            if ($answer_info != null) {
                $student_ans = $answer_info;
                echo $answer_info;
            } else {
                //                    if ($flag != 2) {
                echo 2;
                //                    }
            }
        } else {
            if ($answer_info != null) {
                $student_ans = $answer_info;
                echo $answer_info;
            } else {
                //                if ($flag != 2) {
                echo 3;
                //                }
            }
     
            $question_marks = 0;
        }

        if ($flag == 0) {
            $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);

            $link1 = base_url();
    
            $obtained_marks = $obtained_marks + $question_marks;
            $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];
            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;
            $student_question_time_add = '';
            if (isset($_POST['student_question_time']))
            {
                $student_question_time_add =  $_POST['student_question_time'];
            }
            $ind_ans = array(
               'question_order_id' => $question_info_ai[0]['question_order'],
               'module_type' => $question_info_ai[0]['moduleType'],
               'module_id' => $question_info_ai[0]['module_id'],
               'question_id' => $question_info_ai[0]['question_id'],
               'link' => $link2,
               'student_ans' => json_encode($student_ans),
               'workout' => isset($_POST['workout']) ? $_POST['workout'] : '',
               'student_taken_time' => $student_question_time_add,
               'student_question_marks' => $question_marks,
               'student_marks' => $obtained_marks,
               'ans_is_right' => $ans_is_right
            );
            $ans_array[$question_order_id] = $ind_ans;

            $this->session->set_userdata('data', $ans_array);
            $this->session->set_userdata('obtained_marks', $obtained_marks);
            $this->session->set_userdata('total_marks', $total_marks);

            $ck_tmp_module =  $this->Student_model->get_all_where('id', 'tbl_temp_tutorial_mod_ques_two', 'module_id' , $question_info_ai[0]['module_id'] );

           if (count($ck_tmp_module)) {
            $insert_data['st_ans'] = json_encode($ans_array);


            $this->Student_model->update_tmp_module_tbl('tbl_temp_tutorial_mod_ques_two', 'module_id', $question_info_ai[0]['module_id'] , 'st_id' , $this->session->userdata('user_id') , $insert_data );
           }else{
            $insert_data['st_ans'] = json_encode($ans_array);
            $insert_data['module_id'] = $question_info_ai[0]['module_id'];
            $insert_data['st_id'] = $this->session->userdata('user_id');

            $this->Student_model->insertInfo('tbl_temp_tutorial_mod_ques_two', $insert_data);
           }
    
            if ($_POST['next_question'] == 0) {
                $total_ans = $this->session->userdata('data', $ans_array);

                $data['st_ans'] = json_encode($total_ans);
                $data['st_id'] = $this->session->userdata('user_id');
                $data['module_id'] = $module_id;

                if (!$tutorial_ans_info) {
                    $this->db->insert('tbl_temp_tutorial_mod_ques', $data);
                }
        
                //                $dec = $this->decesion_redirect($this->session->userdata('user_id'), $module_id);
                //                echo $dec;
            }
        }

        if ($flag != 0) {
            
            $ans_array = array();
            $ck_tmp_module =  $this->Student_model->get_all_where('*', 'tbl_temp_tutorial_mod_ques_two', 'module_id' , $module_id );

            $ans_array = json_decode($ck_tmp_module[0]['st_ans']);

            $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);

            $link1 = base_url();

            $obtained_marks = $obtained_marks + $question_marks;
            $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];            
            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;
            $student_question_time_add = '';
            if (isset($_POST['student_question_time']))
            {
                $student_question_time_add =  $_POST['student_question_time'];
            }


            $ind_ans = array(
               'question_order_id' => $question_info_ai[0]['question_order'],
               'module_type' => $question_info_ai[0]['moduleType'],
               'module_id' => $question_info_ai[0]['module_id'],
               'question_id' => $question_info_ai[0]['question_id'],
               'link' => $link2,
               'student_ans' => json_encode($student_ans),
               'workout' => isset($_POST['workout']) ? $_POST['workout'] : '',
               'student_taken_time' => $student_question_time_add,
               'student_question_marks' => $question_marks,
               'student_marks' => $obtained_marks,
               'ans_is_right' => $ans_is_right
            );

            $ans_array->$question_order_id = $ind_ans;  
            $insert_data['st_ans'] = json_encode($ans_array);

            if (!empty($_SESSION['data']) ) {
                foreach ($_SESSION['data'] as $key => $value) {

                    if (is_object($_SESSION['data'])) {
                        if (!empty($value->question_order_id)  ) {
                            if ( $value->question_order_id == $ind_ans['question_order_id'] && $value->question_id == $ind_ans['question_id'] ) {
                                $isset_session_data = 1;
                            }
                        }
                    }else{
                        if (!empty($value['question_order_id'])  ) {
                            if ( $value['question_order_id'] == $ind_ans['question_order_id'] && $value['question_id'] == $ind_ans['question_id'] ) {
                                $isset_session_data = 1;
                            }
                        }
                    }
                }
            }


            if (!isset($isset_session_data) ) {

                // $this->session->set_userdata('data', $ans_array );
                // $this->session->set_userdata('obtained_marks', $obtained_marks);
                // $this->session->set_userdata('total_marks', $total_marks);

                $this->Student_model->update_tmp_module_tbl('tbl_temp_tutorial_mod_ques_two', 'module_id', $question_info_ai[0]['module_id'] , 'st_id' , $this->session->userdata('user_id') , $insert_data );
            }
        }

        if ($flag == 2) {
            //            for ($i = 1; $i <= count($temp_table_ans_info); $i++) {
            foreach ($temp_table_ans_info as $key => $val) {
                //                echo $question_order_id.'<pre>';
                //                echo '<pre>';print_r($temp_table_ans_info[$key]);
                if ($temp_table_ans_info[$key]['question_order_id'] == $question_order_id) {
                    $temp_table_ans_info[$key]['ans_is_right'] = $ans_is_right;
                }
            }
            $update_value = json_encode($temp_table_ans_info);
            $st_ans['st_ans'] = $update_value;
            $this->Student_model->updateInfo('tbl_temp_tutorial_mod_ques', 'id', $tutorial_ans_info[0]['id'], $st_ans);
    
            //            echo 6;
        }


        $x = $_SESSION;

        if (isset($x['data']) ) {
            $this->session->set_userdata('data_exist_session', 1);
            $ck_tmp_module =  $this->Student_model->get_all_where('id', 'tbl_temp_tutorial_mod_ques_two', 'module_id' , $question_info_ai[0]['module_id'] );

           if (count($ck_tmp_module)) {
            $insert_data['st_ans'] = json_encode($ans_array);
            $insert_data['obtained_marks'] = $_SESSION['obtained_marks'];
            $insert_data['total_marks'] = $_SESSION['total_marks'];


            $this->Student_model->update_tmp_module_tbl('tbl_temp_tutorial_mod_ques_two', 'module_id', $question_info_ai[0]['module_id'] , 'st_id' , $this->session->userdata('user_id') , $insert_data );
           }else{
            $insert_data['st_ans'] = json_encode($_SESSION['data']);
            $insert_data['module_id'] = $question_info_ai[0]['module_id'];
            $insert_data['st_id'] = $this->session->userdata('user_id');
            $insert_data['obtained_marks'] = $_SESSION['obtained_marks'];
            $insert_data['total_marks'] = $_SESSION['total_marks'];

            $this->Student_model->insertInfo('tbl_temp_tutorial_mod_ques_two', $insert_data);
           }

        }else{
            $this->session->set_userdata('data_exist_session', 0);
        }

        $datass['obtained_marks'] = $_SESSION['obtained_marks'];
        $datass['total_marks'] = $_SESSION['total_marks'];
        $this->Student_model->update_tmp_module_tbl('tbl_temp_tutorial_mod_ques_two', 'module_id', $question_info_ai[0]['module_id'] , 'st_id' , $this->session->userdata('user_id') , $datass );
    }

    private function take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, $answer_info = null)
    {
        // $this->session->unset_userdata('data');
        //****** Get Temp table data for Tutorial Module Type ******
        $question_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

        $question_info_type = '';
        $question_info_type = $question_info[0]['questionType'];
        $question_info_pattern = '';
        $question_info_pattern = json_decode($question_info[0]['questionName']);
        if (isset($question_info_pattern->pattern_type))
        {
            $question_info_pattern = $question_info_pattern->pattern_type;
        }
        $user_id = $this->session->userdata('user_id');
        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $module_id, $user_id);
        //        print_r($tutorial_ans_info);die;
        $obtained_marks = $this->session->userdata('obtained_marks');
        $total_marks = $this->session->userdata('total_marks');
        $ans_array = $this->session->userdata('data');
        
        $flag = 0;
        
        if (!is_array($ans_array)) {
            $ans_array = array();
            $obtained_marks = 0;
            $total_marks = 0;
            $flag = 0;
        } else {
            $question_idd = '';
            if (isset($ans_array[$question_order_id]['question_id'])) {
                $question_idd = $ans_array[$question_order_id]['question_id'];
            }

            if ($question_id == $question_idd) {
                $flag = 1;
            } else {
                $flag = 0;
            }
            if ($question_info_type == 16)
            {
                if ($question_info_pattern == 1)
                {
                    $memorization_answer = $this->input->post('memorization_answer');
                    $memorization_part = $this->input->post('memorization_one_part');
                    if ($memorization_part == 1)
                    {
                        if (isset($_SESSION['memorization_one_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_one_part',1);
                            $ans_is_right = $memorization_answer;
                        }
                    }elseif($memorization_part == 2){
                        if (isset($_SESSION['memorization_two_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_two_part',2);
                            $ans_is_right = $memorization_answer;
                        }
                    }elseif ($memorization_part == 3){
                        if (isset($_SESSION['memorization_three_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_three_part',3);
                            $ans_is_right = $memorization_answer;
                        }
                    }
                }else
                {
                    $this->session->unset_userdata('memorization_three_part');
                    $this->session->unset_userdata('memorization_two_part');
                    $this->session->unset_userdata('memorization_one_part');
                }
            }else
            {
                $this->session->unset_userdata('memorization_three_part');
                $this->session->unset_userdata('memorization_two_part');
                $this->session->unset_userdata('memorization_one_part');
            }
        }
        
        $student_ans = '';
        if ($this->input->post('answer')) {
            $student_ans = $this->input->post('answer');
        }
        
        if ($tutorial_ans_info) {
            $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'], true);
            $flag = 2;
        }
        

        if ($ans_is_right == 'correct') {
            //            echo $ans_is_right;die;
           
            if ($answer_info != null) {
                $student_ans = $answer_info;
                echo $answer_info;
            } else {
                //                    if ($flag != 2) {
                echo 2;
                //                    }
            }
        } else {
            if ($answer_info != null) {
                $student_ans = $answer_info;
                echo $answer_info;
            } else {
                //                if ($flag != 2) {
                echo 3;
                //                }
            }
     
            $question_marks = 0;
        }

        if ($flag == 0) {
            $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);

            $link1 = base_url();
    
            $obtained_marks = $obtained_marks + $question_marks;
            $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];
            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;
            $student_question_time_add = '';
            if (isset($_POST['student_question_time']))
            {
                $student_question_time_add =  $_POST['student_question_time'];
            }
            $ind_ans = array(
               'question_order_id' => $question_info_ai[0]['question_order'],
               'module_type' => $question_info_ai[0]['moduleType'],
               'module_id' => $question_info_ai[0]['module_id'],
               'question_id' => $question_info_ai[0]['question_id'],
               'link' => $link2,
               'student_ans' => json_encode($student_ans),
               'workout' => isset($_POST['workout']) ? $_POST['workout'] : '',
               'student_taken_time' => $student_question_time_add,
               'student_question_marks' => $question_marks,
               'student_marks' => $obtained_marks,
               'ans_is_right' => $ans_is_right
            );
            $ans_array[$question_order_id] = $ind_ans;

            $this->session->set_userdata('data', $ans_array);
            $this->session->set_userdata('obtained_marks', $obtained_marks);
            $this->session->set_userdata('total_marks', $total_marks);
    
            if ($_POST['next_question'] == 0) {
                $total_ans = $this->session->userdata('data', $ans_array);

                $data['st_ans'] = json_encode($total_ans);
                $data['st_id'] = $this->session->userdata('user_id');
                $data['module_id'] = $module_id;

                if (!$tutorial_ans_info) {
                    $this->db->insert('tbl_temp_tutorial_mod_ques', $data);
                }
        
                //                $dec = $this->decesion_redirect($this->session->userdata('user_id'), $module_id);
                //                echo $dec;
            }
        }

        if ($flag == 2) {
            //            for ($i = 1; $i <= count($temp_table_ans_info); $i++) {
            foreach ($temp_table_ans_info as $key => $val) {
                //                echo $question_order_id.'<pre>';
                //                echo '<pre>';print_r($temp_table_ans_info[$key]);
                if ($temp_table_ans_info[$key]['question_order_id'] == $question_order_id) {
                    $temp_table_ans_info[$key]['ans_is_right'] = $ans_is_right;
                }
            }
            $update_value = json_encode($temp_table_ans_info);
            $st_ans['st_ans'] = $update_value;
            $this->Student_model->updateInfo('tbl_temp_tutorial_mod_ques', 'id', $tutorial_ans_info[0]['id'], $st_ans);
    
            //            echo 6;
        }


        $x = $_SESSION;
        

        if (isset($x['data']) ) {
            $this->session->set_userdata('data_exist_session', 1);
            $ck_tmp_module =  $this->Student_model->get_all_where_two('id', 'tbl_temp_tutorial_mod_ques_two', 'module_id' , $module_id , $_SESSION['user_id'] );

           if (count($ck_tmp_module)) {
            $insert_data['st_ans'] = json_encode($ans_array);
            $insert_data['obtained_marks'] = $_SESSION['obtained_marks'];
            $insert_data['total_marks'] = $_SESSION['total_marks'];


            $this->Student_model->update_tmp_module_tbl('tbl_temp_tutorial_mod_ques_two', 'module_id', $module_id , 'st_id' , $this->session->userdata('user_id') , $insert_data );
           }else{
            $insert_data['st_ans'] = json_encode($_SESSION['data']);
            $insert_data['module_id'] = $module_id;
            $insert_data['st_id'] = $this->session->userdata('user_id');
            $insert_data['obtained_marks'] = $_SESSION['obtained_marks'];
            $insert_data['total_marks'] = $_SESSION['total_marks'];

            $this->Student_model->insertInfo('tbl_temp_tutorial_mod_ques_two', $insert_data);
           }

        }
    }
    

    private function take_decesion_1_old($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, $answer_info = null)
    {
        //****** Get Temp table data for Tutorial Module Type ******
		$question_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

        $question_info_type = '';
        $question_info_type = $question_info[0]['questionType'];
        $question_info_pattern = '';
        $question_info_pattern = json_decode($question_info[0]['questionName']);
        if (isset($question_info_pattern->pattern_type))
        {
            $question_info_pattern = $question_info_pattern->pattern_type;
        }
        $user_id = $this->session->userdata('user_id');
        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $module_id, $user_id);
        //        print_r($tutorial_ans_info);die;
        $obtained_marks = $this->session->userdata('obtained_marks');
        $total_marks = $this->session->userdata('total_marks');
        $ans_array = $this->session->userdata('data');
        
        $flag = 0;
        
        if (!is_array($ans_array)) {
            $ans_array = array();
            $obtained_marks = 0;
            $total_marks = 0;
            $flag = 0;
        } else {
            $question_idd = '';
            if (isset($ans_array[$question_order_id]['question_id'])) {
                $question_idd = $ans_array[$question_order_id]['question_id'];
            }

            if ($question_id == $question_idd) {
                $flag = 1;
            } else {
                $flag = 0;
            }
			if ($question_info_type == 16)
            {
                if ($question_info_pattern == 1)
                {
                    $memorization_answer = $this->input->post('memorization_answer');
                    $memorization_part = $this->input->post('memorization_one_part');
                    if ($memorization_part == 1)
                    {
                        if (isset($_SESSION['memorization_one_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_one_part',1);
                            $ans_is_right = $memorization_answer;
                        }
                    }elseif($memorization_part == 2){
                        if (isset($_SESSION['memorization_two_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_two_part',2);
                            $ans_is_right = $memorization_answer;
                        }
                    }elseif ($memorization_part == 3){
                        if (isset($_SESSION['memorization_three_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_three_part',3);
                            $ans_is_right = $memorization_answer;
                        }
                    }
                }else
                {
                    $this->session->unset_userdata('memorization_three_part');
                    $this->session->unset_userdata('memorization_two_part');
                    $this->session->unset_userdata('memorization_one_part');
                }
            }else
            {
                $this->session->unset_userdata('memorization_three_part');
                $this->session->unset_userdata('memorization_two_part');
                $this->session->unset_userdata('memorization_one_part');
            }
        }
        
        $student_ans = '';
        if ($this->input->post('answer')) {
            $student_ans = $this->input->post('answer');
        }
        
        if ($tutorial_ans_info) {
            $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'], true);
            $flag = 2;
        }
        

        if ($ans_is_right == 'correct') {
            //            echo $ans_is_right;die;
           
            if ($answer_info != null) {
                $student_ans = $answer_info;
                echo $answer_info;
            } else {
                //                    if ($flag != 2) {
                echo 2;
                //                    }
            }
        } else {
            if ($answer_info != null) {
                $student_ans = $answer_info;
                echo $answer_info;
            } else {
                //                if ($flag != 2) {
                echo 3;
                //                }
            }
     
            $question_marks = 0;
        }

        if ($flag == 0) {
            $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);

            $link1 = base_url();
    
            $obtained_marks = $obtained_marks + $question_marks;
            $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];
            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;
			$student_question_time_add = '';
            if (isset($_POST['student_question_time']))
            {
                $student_question_time_add =  $_POST['student_question_time'];
            }
            $ind_ans = array(
               'question_order_id' => $question_info_ai[0]['question_order'],
               'module_type' => $question_info_ai[0]['moduleType'],
               'module_id' => $question_info_ai[0]['module_id'],
               'question_id' => $question_info_ai[0]['question_id'],
               'link' => $link2,
               'student_ans' => json_encode($student_ans),
               'workout' => $_POST['workout'],
               'student_taken_time' => $student_question_time_add,
               'student_question_marks' => $question_marks,
               'student_marks' => $obtained_marks,
               'ans_is_right' => $ans_is_right
            );
            $ans_array[$question_order_id] = $ind_ans;

            $this->session->set_userdata('data', $ans_array);
            $this->session->set_userdata('obtained_marks', $obtained_marks);
            $this->session->set_userdata('total_marks', $total_marks);

            $ck_tmp_module =  $this->Student_model->get_all_where('id', 'tbl_temp_tutorial_mod_ques', 'module_id' , $question_info_ai[0]['module_id'] );

           if (count($ck_tmp_module)) {
            $insert_data['st_ans'] = json_encode($ans_array);

            $this->Student_model->update_tmp_module_tbl('tbl_temp_tutorial_mod_ques', 'module_id', $question_info_ai[0]['module_id'] , 'st_id' , $this->session->userdata('user_id') , $insert_data );
           }else{
            $insert_data['st_ans'] = json_encode($ans_array);
            $insert_data['module_id'] = $question_info_ai[0]['module_id'];
            $insert_data['st_id'] = $this->session->userdata('user_id');

            $this->Student_model->insertInfo('tbl_temp_tutorial_mod_ques', $insert_data);
           }
    
            if ($_POST['next_question'] == 0) {
                $total_ans = $this->session->userdata('data', $ans_array);

                $data['st_ans'] = json_encode($total_ans);
                $data['st_id'] = $this->session->userdata('user_id');
                $data['module_id'] = $module_id;

                if (!$tutorial_ans_info) {
                    $this->db->insert('tbl_temp_tutorial_mod_ques', $data);
                }
        
                //                $dec = $this->decesion_redirect($this->session->userdata('user_id'), $module_id);
                //                echo $dec;
            }
        }

        if ($flag == 2) {
            //            for ($i = 1; $i <= count($temp_table_ans_info); $i++) {
            foreach ($temp_table_ans_info as $key => $val) {
                //                echo $question_order_id.'<pre>';
                //                echo '<pre>';print_r($temp_table_ans_info[$key]);
                if ($temp_table_ans_info[$key]['question_order_id'] == $question_order_id) {
                    $temp_table_ans_info[$key]['ans_is_right'] = $ans_is_right;
                }
            }
            $update_value = json_encode($temp_table_ans_info);
            $st_ans['st_ans'] = $update_value;
            $this->Student_model->updateInfo('tbl_temp_tutorial_mod_ques', 'id', $tutorial_ans_info[0]['id'], $st_ans);
    
            //            echo 6;
        }

        $datass['obtained_marks'] = $_SESSION['obtained_marks'];
        $datass['total_marks'] = $_SESSION['total_marks'];
        $this->Student_model->update_tmp_module_tbl('tbl_temp_tutorial_mod_ques_two', 'module_id', $question_info_ai[0]['module_id'] , 'st_id' , $this->session->userdata('user_id') , $datass );
    }
private function take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, $answer_info = null)
    {
           // print_r($text_1);die;
        $obtained_marks = $this->session->userdata('obtained_marks');
        $total_marks = $this->session->userdata('total_marks');
        $ans_array = $this->session->userdata('data');
        $user_id = $this->session->userdata('user_id');
        $question_info = $this->Student_model->getInfo('tbl_question', 'id', $question_id);
        $question_type = $question_info[0]['questionType'];
        $question_info_pattern = '';
        $question_pattern = '';
        $memorization_part = '';
        $memorization_obtaine_mark_check = 1;
        $question_pattern = json_decode($question_info[0]['questionName']);

        if (isset($question_pattern->pattern_type))
        {
            $question_info_pattern = $question_pattern->pattern_type;
        }
        $memorization_question_mark = $question_info[0]['questionMarks'];
        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_student_answer', $module_id, $user_id);
        $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);

        $flag = 0;
    
        if ($tutorial_ans_info) {
            $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'], true);
            $flag = 2;
        }
    
        if (!is_array($ans_array)) {
            $ans_array = array();
            $obtained_marks = 0;
            $total_marks = 0;
        } else {
            $question_idd = '';
            if (isset($ans_array[$question_order_id]['question_id'])) {
                $question_idd = $ans_array[$question_order_id]['question_id'];
            }

            if ($question_id == $question_idd) {
                $flag = 1;
            } else {
                $flag = 0;
            }
            if ($question_type == 16)
            {
                if ($question_info_pattern == 1)
                {
                    $memorization_answer = $this->input->post('memorization_answer');
                    $memorization_part = $this->input->post('memorization_one_divider');
				
                    $memorization_answer_right = '';
					$memorization_answer_wrong = 'correct';
                    if ($memorization_part == 1)
                    {
                        if (isset($_SESSION['memorization_one_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_one_part',1);
                            $memorization_answer_right = $memorization_answer;
							if ($memorization_answer_right == 'wrong')
                            {
                                $memorization_answer_wrong = $memorization_answer_right;
                                $this->session->set_userdata('memorization_answer_wrong',$memorization_answer_wrong);
                            }
                            $this->session->set_userdata('memorization_answer_right',$memorization_answer_right);
                        }
                    }elseif($memorization_part == 2){
                        if (isset($_SESSION['memorization_two_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_two_part',2);
                            $memorization_answer_right = $memorization_answer;
							if ($memorization_answer_right == 'wrong')
                            {
                                $memorization_answer_wrong = $memorization_answer_right;
                                $this->session->set_userdata('memorization_answer_wrong',$memorization_answer_wrong);
                            }
                            $this->session->set_userdata('memorization_answer_right',$memorization_answer_right);
                        }
                    }elseif ($memorization_part == 3){
                        if (isset($_SESSION['memorization_three_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_three_part',3);
                            $memorization_answer_right = $memorization_answer;
							if ($memorization_answer_right == 'wrong')
                            {
                                $memorization_answer_wrong = $memorization_answer_right;
                                $this->session->set_userdata('memorization_answer_wrong',$memorization_answer_wrong);
                            }
                            $this->session->set_userdata('memorization_answer_right',$memorization_answer_right);
                            $memorization_obtaine_mark_check = 2;
                        }
                    }
					if (isset($_SESSION['memorization_answer_wrong']))
                    {
                        $memorization_answer_right = $this->session->userdata('memorization_answer_wrong');
                        $this->session->set_userdata('memorization_answer_right',$memorization_answer_right);
                    }

                }else
                {
                    $this->session->unset_userdata('memorization_three_part');
                    $this->session->unset_userdata('memorization_two_part');
                    $this->session->unset_userdata('memorization_one_part');
                }
            }else
            {
                $this->session->unset_userdata('memorization_three_part');
                $this->session->unset_userdata('memorization_two_part');
                $this->session->unset_userdata('memorization_one_part');
            }
        }

        $student_ans = '';
    
        if (isset($_POST['answer'])) {
            $student_ans = $_POST['answer'];
        }
		if ($student_ans == '' && isset($_POST['given_ans']))
        {
            $student_ans = $_POST['given_ans'];

        }
    
        if ($ans_is_right == 'correct') {
            if ($answer_info != null && $question_info_ai[0]['moduleType'] == 2) {
                echo $answer_info;
                $student_ans = $answer_info;
            }
        
            if ($answer_info == null && $question_info_ai[0]['moduleType'] == 2) {
                echo 2;
            }
        } else {
            if ($question_info_ai[0]['moduleType'] == 2) {
                if ($answer_info != null && $question_info_ai[0]['moduleType'] == 2) {
                    echo $answer_info;
                    $student_ans = $answer_info;
                } if ($answer_info == null && $question_info_ai[0]['moduleType'] == 2) {
                    echo 3;
                }
            }
        
            $question_marks = 0;
        }
    
        // echo $text;echo 'Flag: ';echo $flag;die;
    
        if ($flag == 2) {
            foreach ($temp_table_ans_info as $key => $val) {
                if ($temp_table_ans_info[$key]['question_order_id'] == $question_order_id) {
                    $temp_table_ans_info[$key]['ans_is_right'] = $ans_is_right;
                    $temp_table_ans_info[$key]['student_ans'] = json_encode($student_ans);
                }
            }
        
            $update_value = json_encode($temp_table_ans_info);
            $st_ans['st_ans'] = $update_value;
            // $this->Student_model->updateInfo('tbl_student_answer', 'id', $tutorial_ans_info[0]['id'], $st_ans);
        
            $count_std_error_ans = $this->Student_model->get_count_std_error_ans($question_order_id, $module_id, $user_id);
        
            if (isset($count_std_error_ans[0]['error_count']) && $count_std_error_ans[0]['error_count'] == 3) {
                $this->Student_model->delete_st_error_ans($question_order_id, $module_id, $user_id);
            } else {
                if ($ans_is_right == 'wrong') {
                    $this->Student_model->update_st_error_ans($question_order_id, $module_id, $user_id);
                }
                if ($ans_is_right == 'correct') {
                    $this->Student_model->delete_st_error_ans($question_order_id, $module_id, $user_id);
                }
            }
        
            if ($question_info_ai[0]['moduleType'] != 2) {
                echo 5;
            }
        }


//        die;
//        die;
        if ($flag == 1 && $question_type == 16 && $question_info_pattern == 1) {
            $link1 = base_url();
            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;

            if (isset($_POST['student_question_time']) && $_POST['student_question_time'] != '')
            {
                $student_question_time = $_POST['student_question_time'];
            }else
            {
                $student_question_time ='';
            }
            if ($question_type == 16)
            {
                if ($question_info_pattern == 1)
                {
                    $memorization_std_ans = $this->session->userdata('memorization_std_ans');
                    $student_ans = $memorization_std_ans;
                }
            }
            $memorization_answer_right = $this->session->userdata('memorization_answer_right');
            if ($memorization_answer_right == 'correct')
            {
                $question_marks = $memorization_question_mark;
                //$obtained_marks = $memorization_question_mark;
            }else{
                $question_marks = 0;
                //$obtained_marks = 0;
            }
            if ($memorization_part == 3 && $memorization_obtaine_mark_check == 2)
            {
                $obtained_marks = $obtained_marks + $question_marks;
            }
            $ind_ans = array(
                'question_order_id' => $question_info_ai[0]['question_order'],
                'module_type' => $question_info_ai[0]['moduleType'],
                'module_id' => $question_info_ai[0]['module_id'],
                'question_id' => $question_info_ai[0]['question_id'],
                'link' => $link2,
                'student_ans' => json_encode($student_ans),
                'workout' => isset($_POST['workout']) ? $_POST['workout']:'',
                'student_taken_time' => $student_question_time,
                'student_question_marks' => $question_marks,
                'student_marks' => $obtained_marks,
                'ans_is_right' => $memorization_answer_right
            );
            //echo '<pre>';print_r($ind_ans);die;
            $ans_array[$question_order_id] = $ind_ans;

            $this->session->set_userdata('data', $ans_array);
            $this->session->set_userdata('obtained_marks', $obtained_marks);
            $this->session->set_userdata('total_marks', $total_marks);
            if ($question_info_ai[0]['moduleType'] != 2) {
                echo 5;
            }

            if ($_POST['next_question'] == 0) {
                date_default_timezone_set($this->site_user_data['zone_name']);
                $end_time = time();
                $this->session->set_userdata('end_time', $end_time);

                $this->save_student_answer($module_id);
            }
        }
        //echo '<pre>';
        //print_r($_SESSION);
        if ($flag == 0) {
            $link1 = base_url();
            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;

            if ($question_type != 16  && $question_info_pattern != 1)
            {
                $obtained_marks = $obtained_marks + $question_marks;
            }

            $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];
            if (isset($_POST['student_question_time']) && $_POST['student_question_time'] != '')
            {
                $student_question_time = $_POST['student_question_time'];
            }else
            {
                $student_question_time ='';
            }

            if ($question_type == 15)
            {
                $answer_info = $this->Student_model->getInfo('tbl_question', 'id', $question_id);
                $percentage = $answer_info[0]['questionName'];
                $percentage = json_decode($percentage);
                $percentage_array = array();
                $percentage_ans = array();
                if (isset($percentage->percentage_array))
                {
                    $percentage_array = $percentage->percentage_array;
                }
                foreach($percentage_array as $key=>$value)
                {
                    if (isset($_POST[$key]))
                    {
                        $percentage_ans[$key]['0'] = $_POST[$key];
                        $percentage_ans[$key]['1'] = $value;
                    }
                }
                $student_ans = $percentage_ans;
            }
            if ($question_type ==16)
            {

                if ($question_info_pattern == 2)
                {
                    $pattern_two = array();
                    $left_memorize_p_two = $this->input->post('left_memorize_p_two');
                    $right_memorize_p_two = $this->input->post('right_memorize_p_two');
                    $pattern_two['left_memorize_p_two']=$left_memorize_p_two;
                    $pattern_two['right_memorize_p_two']=$right_memorize_p_two;
                    $student_ans = $pattern_two;
                }
                if ($question_info_pattern == 3)
                {
                    $pattern_three = array();
                    $left_memorize_p_two = $this->input->post('left_image_ans');
                    $right_memorize_p_two = $this->input->post('right_image_ans');
                    $pattern_three['left_image_ans']= $left_memorize_p_two;
                    $pattern_three['right_image_ans']= $right_memorize_p_two;
                    $student_ans = $pattern_three;
                }

            }
        if ($question_type == 16)
        {
            if ($question_info_pattern == 1)
            {
                $memorization_std_ans = $this->session->userdata('memorization_std_ans');
                $student_ans = $memorization_std_ans;
            }
        }

            $ind_ans = array(
            'question_order_id' => $question_info_ai[0]['question_order'],
            'module_type' => $question_info_ai[0]['moduleType'],
            'module_id' => $question_info_ai[0]['module_id'],
            'question_id' => $question_info_ai[0]['question_id'],
            'link' => $link2,
            'student_ans' => json_encode($student_ans),
            'workout' => isset($_POST['workout']) ? $_POST['workout']:'',
            'student_taken_time' => $student_question_time,
            'student_question_marks' => $question_marks,
            'student_marks' => $obtained_marks,
            'ans_is_right' => $ans_is_right
            );
            //echo '<pre>';print_r($ind_ans);die;
            $ans_array[$question_order_id] = $ind_ans;

            $this->session->set_userdata('data', $ans_array);
            $this->session->set_userdata('obtained_marks', $obtained_marks);
            $this->session->set_userdata('total_marks', $total_marks);
            if ($question_info_ai[0]['moduleType'] != 2) {
                echo 5;
            }

            if ($_POST['next_question'] == 0) {
                date_default_timezone_set($this->site_user_data['zone_name']);
                $end_time = time();
                $this->session->set_userdata('end_time', $end_time);
            
                $this->save_student_answer($module_id);
            }
        }

        $x = $_SESSION;

        if (isset($x['data']) ) {
            $this->session->set_userdata('data_exist_session', 1);
            $ck_tmp_module =  $this->Student_model->get_all_where_two('id', 'tbl_temp_tutorial_mod_ques_two', 'module_id' , $module_id , $_SESSION['user_id'] );

           if (count($ck_tmp_module)) {
            $insert_data['st_ans'] = json_encode($ans_array);
            $insert_data['obtained_marks'] = $_SESSION['obtained_marks'];
            $insert_data['total_marks'] = $_SESSION['total_marks'];


            $this->Student_model->update_tmp_module_tbl('tbl_temp_tutorial_mod_ques_two', 'module_id', $question_info_ai[0]['module_id'] , 'st_id' , $this->session->userdata('user_id') , $insert_data );
           }else{
            $insert_data['st_ans'] = json_encode($_SESSION['data']);
            $insert_data['module_id'] = $question_info_ai[0]['module_id'];
            $insert_data['st_id'] = $this->session->userdata('user_id');
            $insert_data['obtained_marks'] = $_SESSION['obtained_marks'];
            $insert_data['total_marks'] = $_SESSION['total_marks'];

            $this->Student_model->insertInfo('tbl_temp_tutorial_mod_ques_two', $insert_data);
           }

        }else{
            $this->session->set_userdata('data_exist_session', 0);
        }
    }
    private function take_decesion_4($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, $answer_info = null)
    {
           // print_r($text_1);die;
		$question_info = $this->Student_model->getInfo('tbl_question', 'id', $question_id);
        $question_type = $question_info[0]['questionType'];
        $question_info_pattern = '';
		$question_pattern = '';
		$memorization_part = '';
        $memorization_obtaine_mark_check = 1;
        $question_pattern = json_decode($question_info[0]['questionName']);
        if (isset($question_pattern->pattern_type))
        {
            $question_info_pattern = $question_pattern->pattern_type;
        }
		
        $obtained_marks = $this->session->userdata('obtained_marks');
        $total_marks = $this->session->userdata('total_marks');
        $ans_array = $this->session->userdata('data');
        $user_id = $this->session->userdata('user_id');
		$memorization_question_mark = $question_info[0]['questionMarks'];
        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_student_answer', $module_id, $user_id);
        $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);
    
        $flag = 0;
    
        if ($tutorial_ans_info) {
            $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'], true);
            $flag = 2;
        }
    
        if (!is_array($ans_array)) {
            $ans_array = array();
            $obtained_marks = 0;
            $total_marks = 0;
        } else {
            $question_idd = '';
            if (isset($ans_array[$question_order_id]['question_id'])) {
                $question_idd = $ans_array[$question_order_id]['question_id'];
            }

            if ($question_id == $question_idd) {
                $flag = 1;
            } else {
                $flag = 0;
            }
			if ($question_type == 16)
            {
                if ($question_info_pattern == 1)
                {
                    $memorization_answer = $this->input->post('memorization_answer');
                    $memorization_part = $this->input->post('memorization_one_divider');
                    $memorization_answer_right = '';
                    if ($memorization_part == 1)
                    {
                        if (isset($_SESSION['memorization_one_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_one_part',1);
                            $memorization_answer_right = $memorization_answer;
                            $this->session->set_userdata('memorization_answer_right',$memorization_answer_right);
                        }
                    }elseif($memorization_part == 2){
                        if (isset($_SESSION['memorization_two_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_two_part',2);
                            $memorization_answer_right = $memorization_answer;
                            $this->session->set_userdata('memorization_answer_right',$memorization_answer_right);
                        }
                    }elseif ($memorization_part == 3){
                        if (isset($_SESSION['memorization_three_part']))
                        {

                        }else{
                            $this->session->set_userdata('memorization_three_part',3);
                            $memorization_answer_right = $memorization_answer;
                            $this->session->set_userdata('memorization_answer_right',$memorization_answer_right);
							$memorization_obtaine_mark_check = 2;
                        }
                    }

                }else
                {
                    $this->session->unset_userdata('memorization_three_part');
                    $this->session->unset_userdata('memorization_two_part');
                    $this->session->unset_userdata('memorization_one_part');
                }
            }else
            {
                $this->session->unset_userdata('memorization_three_part');
                $this->session->unset_userdata('memorization_two_part');
                $this->session->unset_userdata('memorization_one_part');
            }
        }

        $student_ans = '';
    
        if (isset($_POST['answer'])) {
            $student_ans = $_POST['answer'];
        }
		if ($student_ans == '' && isset($_POST['given_ans']))
        {
            $student_ans = $_POST['given_ans'];

        }
    
        if ($ans_is_right == 'correct') {
            if ($answer_info != null && $question_info_ai[0]['moduleType'] == 2) {
                echo $answer_info;
                $student_ans = $answer_info;
            }
        
            if ($answer_info == null && $question_info_ai[0]['moduleType'] == 2) {
                echo 2;
            }
        } else {
            if ($question_info_ai[0]['moduleType'] == 2) {
                if ($answer_info != null && $question_info_ai[0]['moduleType'] == 2) {
                    echo $answer_info;
                    $student_ans = $answer_info;
                } if ($answer_info == null && $question_info_ai[0]['moduleType'] == 2) {
                    echo 3;
                }
            }
        
            $question_marks = 0;
        }
    
        // echo $text;echo 'Flag: ';echo $flag;die;
    
        if ($flag == 2) {
            foreach ($temp_table_ans_info as $key => $val) {
                if ($temp_table_ans_info[$key]['question_order_id'] == $question_order_id) {
                    $temp_table_ans_info[$key]['ans_is_right'] = $ans_is_right;
                    $temp_table_ans_info[$key]['student_ans'] = json_encode($student_ans);
                }
            }
        
            $update_value = json_encode($temp_table_ans_info);
            $st_ans['st_ans'] = $update_value;
            // $this->Student_model->updateInfo('tbl_student_answer', 'id', $tutorial_ans_info[0]['id'], $st_ans);
        
            $count_std_error_ans = $this->Student_model->get_count_std_error_ans($question_order_id, $module_id, $user_id);
        
            if (isset($count_std_error_ans[0]['error_count']) && $count_std_error_ans[0]['error_count'] == 3) {
                $this->Student_model->delete_st_error_ans($question_order_id, $module_id, $user_id);
            } else {
                if ($ans_is_right == 'wrong') {
                    $this->Student_model->update_st_error_ans($question_order_id, $module_id, $user_id);
                }
                if ($ans_is_right == 'correct') {
                    $this->Student_model->delete_st_error_ans($question_order_id, $module_id, $user_id);
                }
            }
        
            if ($question_info_ai[0]['moduleType'] != 2) {
                echo 5;
            }
        } 
			
			if ($flag == 1 && $question_type == 16 && $question_info_pattern == 1) {
            $link1 = base_url();
            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;

            //$obtained_marks = $obtained_marks + $question_marks;
            //$total_marks = $total_marks + $question_info_ai[0]['questionMarks'];
            if (isset($_POST['student_question_time']) && $_POST['student_question_time'] != '')
            {
                $student_question_time = $_POST['student_question_time'];
            }else
            {
                $student_question_time ='';
            }
            if ($question_type == 16)
            {
                if ($question_info_pattern == 1)
                {
                    $memorization_std_ans = $this->session->userdata('memorization_std_ans');
                    $student_ans = $memorization_std_ans;
                }
            }
			$memorization_answer_right = $this->session->userdata('memorization_answer_right');
            if ($memorization_answer_right == 'correct')
            {
                $question_marks = $memorization_question_mark;
                //$obtained_marks = $memorization_question_mark;
            }else{
                $question_marks = 0;
                //$obtained_marks = 0;
            }
            if ($memorization_part == 3 && $memorization_obtaine_mark_check == 2)
            {
                $obtained_marks = $obtained_marks + $question_marks;
            }
            $ind_ans = array(
                'question_order_id' => $question_info_ai[0]['question_order'],
                'module_type' => $question_info_ai[0]['moduleType'],
                'module_id' => $question_info_ai[0]['module_id'],
                'question_id' => $question_info_ai[0]['question_id'],
                'link' => $link2,
                'student_ans' => json_encode($student_ans),
                'workout' => isset($_POST['workout']) ? $_POST['workout']:'',
                'student_taken_time' => $student_question_time,
                'student_question_marks' => $question_marks,
                'student_marks' => $obtained_marks,
                'ans_is_right' => $memorization_answer_right
            );
            //echo '<pre>';print_r($ind_ans);die;
            $ans_array[$question_order_id] = $ind_ans;

            $this->session->set_userdata('data', $ans_array);
            $this->session->set_userdata('obtained_marks', $obtained_marks);
            $this->session->set_userdata('total_marks', $total_marks);
            if ($question_info_ai[0]['moduleType'] != 2) {
                echo 5;
            }

            if ($_POST['next_question'] == 0) {
                date_default_timezone_set($this->site_user_data['zone_name']);
                $end_time = time();
                $this->session->set_userdata('end_time', $end_time);

                $this->save_student_answer($module_id);
            }
        }
	
		if ($flag == 0) {
            $link1 = base_url();
            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;
        
			if ($question_type != 16  && $question_info_pattern != 1)
            {
                $obtained_marks = $obtained_marks + $question_marks;
            }
            //$obtained_marks = $obtained_marks + $question_marks;
            $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];
			
			if ($question_type == 15)
            {
                $answer_info = $this->Student_model->getInfo('tbl_question', 'id', $question_id);
                $percentage = $answer_info[0]['questionName'];
                $percentage = json_decode($percentage);
                $percentage_array = array();
                $percentage_ans = array();
                if (isset($percentage->percentage_array))
                {
                    $percentage_array = $percentage->percentage_array;
                }
                foreach($percentage_array as $key=>$value)
                {
                    if (isset($_POST[$key]))
                    {
                        $percentage_ans[$key]['0'] = $_POST[$key];
                        $percentage_ans[$key]['1'] = $value;
                    }
                }
                $student_ans = $percentage_ans;
            }
			
			if ($question_type ==16)
            {

                if ($question_info_pattern == 2)
                {
                    $pattern_two = array();
                    $left_memorize_p_two = $this->input->post('left_memorize_p_two');
                    $right_memorize_p_two = $this->input->post('right_memorize_p_two');
                    $pattern_two['left_memorize_p_two']=$left_memorize_p_two;
                    $pattern_two['right_memorize_p_two']=$right_memorize_p_two;
                    $student_ans = $pattern_two;
                }elseif ($question_info_pattern == 3)
                {
                    $pattern_three = array();
                    $left_memorize_p_two = $this->input->post('left_image_ans');
                    $right_memorize_p_two = $this->input->post('right_image_ans');
                    $pattern_three['left_image_ans']= $left_memorize_p_two;
                    $pattern_three['right_image_ans']= $right_memorize_p_two;
                    $student_ans = $pattern_three;
                }

            }
        
            $ind_ans = array(
            'question_order_id' => $question_info_ai[0]['question_order'],
            'module_type' => $question_info_ai[0]['moduleType'],
            'module_id' => $question_info_ai[0]['module_id'],
            'question_id' => $question_info_ai[0]['question_id'],
            'link' => $link2,
            'student_ans' => json_encode($student_ans),
            'workout' => isset($_POST['workout']) ? $_POST['workout']:'',
            'student_taken_time' => $_POST['student_question_time'],
            'student_question_marks' => $question_marks,
            'student_marks' => $obtained_marks,
            'ans_is_right' => $ans_is_right
            );
            //echo '<pre>';print_r($ind_ans);die;
            $ans_array[$question_order_id] = $ind_ans;

            $this->session->set_userdata('data', $ans_array);
            $this->session->set_userdata('obtained_marks', $obtained_marks);
            $this->session->set_userdata('total_marks', $total_marks);
            if ($question_info_ai[0]['moduleType'] != 2) {
                echo 5;
            }
        
            if ($_POST['next_question'] == 0) {
                date_default_timezone_set($this->site_user_data['zone_name']);
                $end_time = time();
                $this->session->set_userdata('end_time', $end_time);
            
                $this->save_student_answer($module_id);
            }
        }
    }

    public function save_student_answer($module_id)
    {
        $get_module_info = $this->Student_model->getInfo('tbl_module', 'id', $module_id);
		$courseId = $get_module_info[0]['course_id'];
        $ans_array = $this->session->userdata('data');
        $obtained_marks = $this->session->userdata('obtained_marks');
        $total_marks = $this->session->userdata('total_marks');
    
        $student_taken_time = $this->session->userdata('end_time') - $this->session->userdata('exam_start');
        foreach ($ans_array as $ans) {
            if ($ans['ans_is_right'] == 'wrong') {
                $data_er['st_id'] = $this->session->userdata('user_id');
                $data_er['question_id'] = $ans['question_id'];
                $data_er['question_order_id'] = $ans['question_order_id'];
                $data_er['module_id'] = $ans['module_id'];
                $data_er['error_count'] = 1;

                $this->db->insert('tbl_st_error_ans', $data_er);
            }
        
            // $student_taken_time = $student_taken_time + $ans['student_taken_time'];
        }
    
        //        $total_ans = $this->session->userdata('data', $ans_array);
    
        $time['user_info'] = $this->Student_model->userInfo($this->session->userdata('user_id'));
    
        date_default_timezone_set($time['user_info'][0]['zone_name']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['st_ans'] = json_encode($ans_array);
        $data['st_id'] = $this->session->userdata('user_id');
        $data['module_id'] = $module_id;
        $this->db->insert('tbl_student_answer', $data);
    
        $p_data['timeTaken'] = $student_taken_time;
        $p_data['answerTime'] = $this->session->userdata('exam_start');
        $p_data['originalMark'] = $total_marks;
        $p_data['studentMark'] = $obtained_marks;
        $p_data['student_id'] = $data['st_id'];
        $p_data['module'] = $data['module_id'];
        $p_data['percentage'] = ($obtained_marks * 100) / $total_marks;
        $p_data['moduletype'] = $get_module_info[0]['moduleType'];
    
        $this->db->insert('tbl_studentprogress', $p_data);
    
        $this->session->unset_userdata('data', $ans_array);
    
        //      *****  For Send SMS Message to Parents  *****
        if ($get_module_info[0]['isSMS'] == 1) {
            $v_hours = floor($student_taken_time / 3600);
            $remain_seconds = $student_taken_time - $v_hours * 3600;
            $v_minutes = floor($remain_seconds / 60);
            $v_seconds = $remain_seconds - $v_minutes * 60;
            $time_hour_minute_sec = $v_hours . " : "  . $v_minutes . " : " . $v_seconds ;
        
            $settins_Api_key = $this->Student_model->getSmsApiKeySettings();
            $settins_sms_messsage = $this->Student_model->get_sms_response_after_module();

            $user_email = $this->session->userdata('user_email');
            //$totProgress = $this->Student_model->getInfo('tbl_studentprogress', 'student_id', $data['st_id']);
            
			$get_module_info = $this->Student_model->getInfo('tbl_module', 'id', $module_id);
			$course_id = '';
			if ($get_module_info[0]['course_id'] !=0)
			{
				$course_id = $get_module_info[0]['course_id'];
			}
			$module_type = $get_module_info[0]['moduleType'];
			$module_user_type = $get_module_info[0]['user_type'];
			$conditions['student_id'] = $data['st_id'];
			$conditions['moduletype'] = $module_type;
			$totProgress = $this->Student_model->studentProgressStd($conditions,$module_user_type,$course_id);
			
            $avg_mark = 0 ;
			$totPercentage = 0;
            if (count($totProgress)) {
				$examAttended = count($totProgress);
                $tot = 0;
                foreach ($totProgress as $progress) {
					if ($progress['studentMark'] == 0 )
					{
						$percentGained = 0;
					}else
					{
						$percentGained = (float)($progress['studentMark']/$progress['originalMark'])*100;
					}
					$percentGained = round($percentGained, 2);
					$totPercentage += $percentGained;
                    //$tot+=$progress['percentage'];
                }
				 $avg_mark = ($examAttended>0) ? round((float)($totPercentage / $examAttended), 2) : 0.0;
                //$avg_mark = round($tot/count($totProgress), 2);
            }
			$courseName = $this->Student_model->getInfo('tbl_course', 'id', $courseId);
            $get_all_module_question = $this->Student_model->getInfo('tbl_modulequestion', 'module_id', $module_id);
            $get_child_parent_info = $this->Student_model->getInfo('tbl_useraccount', 'id', $time['user_info'][0]['parent_id']);

            $register_code_string = $settins_sms_messsage[0]['setting_value'];
            if (!empty($courseName))
            {
                $courseName = $courseName[0]['courseName'];
                $find = array("{{user_email}}", "{{marks}}", "{{total_marks}}","{{student_taken_time}}","{{course_name}}","{{avg_mark}}");
                $replace = array($user_email, $obtained_marks, $total_marks, $time_hour_minute_sec,$courseName, $avg_mark);

            }else
            {
                //$register_code_string = str_replace('in “course :{{course_name}}”',"",$register_code_string);
				$register_code_string = str_replace('in “course:{{course_name}}”',"",$register_code_string);
                $find = array("{{user_email}}", "{{marks}}", "{{total_marks}}","{{student_taken_time}}","{{avg_mark}}");
                $replace = array($user_email, $obtained_marks, $total_marks, $time_hour_minute_sec, $avg_mark);
            }
			
            $message = str_replace($find, $replace, $register_code_string);
            $api_key = $settins_Api_key[0]['setting_value'];
            $content = urlencode($message);
            $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $get_child_parent_info[0]['user_mobile'] . "&content=$content";
            
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
    
        //      *****  End For Sending SMS Message to Parents  *****
    
        if ($get_module_info[0]['moduleType'] != 2) {
            // $dec = $this->decesion_redirect($data['st_id'], $data['module_id']);
            // echo $dec;
        }
    }

    private function decesion_redirect($st_id, $module_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_module');
        $this->db->where('id', $module_id);
        $info = $this->db->get()->result_array();
        //        if($info[0]['moduleType'] == 1 || $info[0]['moduleType'] == 2){
        //            return 6;
        //        }
        ////        elseif($info[0]['moduleType'] == 2){
        ////            return 7;
        ////        }
        //        elseif($info[0]['moduleType'] == 3){
        //            return 8;
        //        }
        return 6;
    }

    public function st_answer_matching()
    {
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        //$question_order_id = $_POST['check_order_id'] - 1;
        $question_order_id = $this->input->post('current_order');
        $text = $this->input->post('answer');
        //
        $find = array('&nbsp;', '\n', '\t', '\r');
        $repleace = array('', '', '', '');
        $text = strip_tags($text);
        $text = str_replace($find, $repleace, $text);
        $text = trim($text);

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);


        $question_marks = $answer_info[0]['questionMarks'];

        $text_1 = $answer_info[0]['answer'];
        $find = array('&nbsp;', '\n', '\t', '\r');
        $repleace = array('', '', '', '');
        $text_1 = strip_tags($text_1);
        $text_1 = str_replace($find, $repleace, $text_1);
        $text_1 = trim($text_1);
    
        $ans_is_right = 'correct';
        if ($text != $text_1) {
            $ans_is_right = 'wrong';
        }

        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }

    public function st_answer_matching_true_false()
    {
        //        echo '<pre>';print_r($_POST);
        $text = $this->input->post('answer');
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $question_order_id = $this->input->post('current_order');
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

        $text_1 = $answer_info[0]['answer'];
    
        $ans_is_right = 'correct';
        if ($text != $text_1) {
            $ans_is_right = 'wrong';
        }
    
        $question_marks = $answer_info[0]['questionMarks'];
        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }

    public function st_answer_matching_vocabolary()
    {

        $text = strtolower($this->input->post('answer'));
        $question_id = $this->input->post('question_id');
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

        $module_id = $_POST['module_id'];
        // $question_order_id = $_POST['next_question'] - 1;
        $question_order_id = $_POST['current_order'];
        $text_1 = strtolower($answer_info[0]['answer']);
        $question_marks = $this->input->post('obtain_marks');
    
        $ans_is_right = 'correct';
        if ($text != $text_1) {
            $ans_is_right = 'wrong';
        }

        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }

    public function st_answer_matching_multiple_choice()
    {
        //print_r($_POST);die;

        $question_id = $_POST['id'];
        if (isset($_POST['answer'])) {
            $text_1 = $_POST['answer'];
        } else {
            $text_1 = '';
        }

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
    
        $text = $answer_info[0]['answer'];
        $question_marks = $answer_info[0]['questionMarks'];
        $module_id = $_POST['module_id'];
        $question_order_id = $_POST['current_order'];
    
        $ans_is_right = 'correct';
        if ($text != $text_1) {
            $ans_is_right = 'wrong';
        }
    
        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }

    public function st_answer_matching_multiple_response()
    {
        $question_id = $_POST['id'];
        if (isset($_POST['answer'])) {
            $text_1 = $_POST['answer'];
        } else {
            $text_1 = array();
        }

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

        $question_marks = $answer_info[0]['questionMarks'];
        $text = json_decode($answer_info[0]['answer']);
        $result_count = 1;
        if ($text_1) {
            $result_count = count(array_intersect($text_1, $text));
        }

        $module_id = $_POST['module_id'];
        $question_order_id = $_POST['current_order'];
    
        $ans_is_right = 'correct';
        if (count($text_1) != $result_count) {
            $ans_is_right = 'wrong';
        }

        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }

    public function st_answer_multiple_matching()
    {
        $total = $_POST['total_ans'];

        $question_id = $_POST['id'];
        $st_ans = array();
        for ($i = 1; $i <= $total; $i++) {
            $ans_id = 'answer_' . $i;
            $st_ans[] = $_POST[$ans_id];
        }
        $answer = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $answer_info['tutor_ans'] = json_decode($answer[0]['answer']);
        $question_marks = $answer[0]['questionMarks'];
        $answer_info['student_ans'] = $st_ans;

        $module_id = $_POST['module_id'];
        //$question_order_id = $_POST['next_question'] - 1;
        $question_order_id = $_POST['current_order'];
        $text = 0;
        $text_1 = 0;
        for ($k = 0; $k < sizeof($answer_info['student_ans']); $k++) {
            if ($answer_info['student_ans'][$k] != $answer_info['tutor_ans'][$k]) {
                $text++;
            }
        }
    
        $ans_is_right = 'correct';
        if ($text != $text_1) {
            $ans_is_right = 'wrong';
        }

        if ($_POST['module_type'] == 1) {
            //echo 11111111;die;
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, json_encode($answer_info));
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, json_encode($answer_info));
        }
    }

    public function st_answer_skip()
    {
        $module_id = $_POST['module_id'];
        //$question_order_id = $_POST['next_question'] - 1;
        $question_order_id = $_POST['current_order'];
        $post = $this->input->post();
        $questionId = $this->input->post('id');
        $text = 0;
        $text_1 = 0;
    
        $temp = $this->tutor_model->getInfo('tbl_question', 'id', $questionId);
    
        $answer_info = array();
    
        $question_marks = $temp[0]['questionMarks'];
    
        if (strlen(implode($post['given_ans'])) != 0) {
            $givenAns = $this->indexQuesAns($post['given_ans']);
        
            $savedAns = $this->indexQuesAns(json_decode($temp[0]['answer']));

            $temp2 = json_decode($temp[0]['questionName']);
            $numOfRows = $temp2->numOfRows;
            $numOfCols = $temp2->numOfCols;
            //echo $numOfRows .' ' . $numOfCols;
            $wrongAnsIndices = [];

            $answer_info = $givenAns;
        
            for ($row = 1; $row <= $numOfRows; $row++) {
                for ($col = 1; $col <= $numOfCols; $col++) {
                    if (isset($savedAns[$row][$col])) {
                        if (isset($givenAns[$row][$col]))
                        {
                            $wrongAnsIndices[] = ($savedAns[$row][$col] != $givenAns[$row][$col]) ? $row . '_' . $col : null;
                        }else {
                            $wrongAnsIndices[] = $row . '_' . $col;

                        }
                    }
                }
            }

            $wrongAnsIndices = array_filter($wrongAnsIndices);
            if (count($wrongAnsIndices)) {//For False Condition
                $text_1 = 1;
            }
        } if (strlen(implode($post['given_ans'])) == 0) {
            $text_1 = 1;
        }
        
        $ans_is_right = 'correct';
        if ($text != $text_1) {
            $ans_is_right = 'wrong';
        }

        if ($_POST['module_type'] == 1) {
            //echo $text_1;die;
            $this->take_decesion_1($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
        } else {
            $this->take_decesion_2($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
        }
    }
    
    public function st_answer_creative_quiz()
    {
        $question_id = $this->input->post('question_id');
        $student_ans = $this->input->post('answer');
        $paragraph = $this->input->post('paragraph');
        
        $answer = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        
        $answer_info['questionName'] = json_decode($answer[0]['questionName']);
        $answer_info['tutor_ans'] = json_decode($answer[0]['answer']);
        $question_marks = $answer[0]['questionMarks'];
        
        $module_id = $this->input->post('module_id');
        //$question_order_id = $_POST['next_question'] - 1;
        $question_order_id = $this->input->post('current_order');
        $text = 0;
        $text_1 = 0;
        if(count($student_ans) != count($answer_info['tutor_ans'])){
            $text++;
        } else {
            for ($k = 0; $k < sizeof($answer_info['tutor_ans']); $k++) {
                if ($student_ans[$k] != $answer_info['tutor_ans'][$k]) {
                    $text++;
                }
            }
            
            for ($k = 0; $k < sizeof($answer_info['questionName']->paragraph_order); $k++) {
                if ($paragraph[$k] != $answer_info['questionName']->paragraph_order[$k]) {
                    $text++;
                }
            }
        }
        
        $ans_is_right = 'correct';
        if ($text != $text_1) {
            $ans_is_right = 'wrong';
        }

        if ($this->input->post('module_type') == 1) {
            //echo 11111111;die;
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, array());
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, array());
        }
    }
    
    public function st_answer_times_table()
    {
        $question_id = $this->input->post('question_id');
        $result = $this->input->post('answer');
        
        $answer = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $answer_info['tutor_ans'] = json_decode($answer[0]['answer']);
        $question_marks = $answer[0]['questionMarks'];
        $answer_info['student_ans'] = $result;
        
        $module_id = $this->input->post('module_id');
        //$question_order_id = $_POST['next_question'] - 1;
        $question_order_id = $this->input->post('current_order');
        $text = 0;
        $text_1 = 0;
        $flag = 1;
        
        for ($k = 0; $k < sizeof($answer_info['student_ans']); $k++) {
            if ($answer_info['student_ans'][$k] != $answer_info['tutor_ans'][$k]) {
                $text++;
                $flag = 0;
            }
        }
        // echo 'Flag: ';echo $flag;die;
        $ans_is_right = 'correct';
        if ($flag == 0) {
            $ans_is_right = 'wrong';
        }
        
        $answer_info['student_ans'] = $result;
        $answer_info['flag'] = $flag;

        if ($this->input->post('module_type') == 1) {
            //echo 11111111;die;
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, array());
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, array());
        }
    }
    
    public function st_answer_algorithm()
    {
        $question_id = $this->input->post('question_id');
        $result = $this->input->post('answer');
        //        $result['reminder'] = $this->input->post('reminder');

        if (isset($result[0]))
        {
            $ans_one = $result[0];
        }else
        {
            $ans_one = $result;
        }

        if (isset($result[1]))
        {
            $reminder_answer = $result[1];
        }else
        {
            $reminder_answer = '';
        }
        
        $answer = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $question_info = json_decode($answer[0]['questionName'], true);
        $answer_info['tutor_ans'] = json_decode($answer[0]['answer']);
        //        $question_marks = $answer[0]['questionMarks'];
        $question_marks = $answer[0]['questionMarks'];
        //        $answer_info['student_ans'] = $result;
        
        $module_id = $this->input->post('module_id');
        $question_order_id = $this->input->post('current_order');
        
        
        if ($question_info['operator'] != '/' && $result == $answer_info['tutor_ans']) {
            $ans_is_right = 'correct';
        } elseif ($question_info['operator'] == '/' && $question_info['quotient'] == $ans_one && $question_info['remainder'] == $reminder_answer) {
            $ans_is_right = 'correct';
        } else {
            $ans_is_right = 'wrong';
        }
        //        echo $ans_is_right;die;
        if ($this->input->post('module_type') == 1) {
            //echo 11111111;die;
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, array());
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, array());
        }
    }
    
    public function st_answer_workout_quiz()
    {
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        //$question_order_id = $_POST['check_order_id'] - 1;
        $question_order_id = $this->input->post('current_order');
        $text = $this->input->post('answer');
        

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $ans_is_right = 'correct';

        $question_marks = 0;


        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }
	public function st_answer_matching_without_form_workout_two()
    {
        $student_answer = $_POST['checkAllFiled'];
        $question_id = $_POST['question_id'];
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $correct_ans = $answer_info[0]['answer'];
        $percentage_array = json_decode($answer_info[0]['questionName'])->percentage_array;
        $data['student_answer'] = $student_answer;
        $data['correct_ans'] = $correct_ans;
        $data['percentage_array'] = $percentage_array;
        $correct = 1;
        $i =1;
        foreach($student_answer as $ans)
        {
            $object = 'percentage_'.$i;
            if ($ans != $percentage_array->$object)
            {
                $correct = 0;
            }
            $i++;
        }

        if ($_POST['ansFiled'] != $correct_ans)
        {
            $correct = 0;
        }
        $data['correct'] = $correct;

        echo json_encode($data);
    }
	
	public function st_answer_matching_workout_two()
    {
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        //$question_order_id = $_POST['check_order_id'] - 1;
        $question_order_id = $this->input->post('current_order');
         $provide_ans = $this->input->post('answer');

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $ans_is_right = 'correct';

        $question_marks = $answer_info[0]['questionMarks'];
        $qus_ans = $answer_info[0]['answer'];
        if ($provide_ans == 'correct')
        {
            $ans_is_right = 'correct';

        }else{
            $ans_is_right = 'wrong';
            $question_marks = 0;
        }

        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }
    
    public function st_answer_assignment()
    {
        //        echo '<pre>';print_r($_POST);die;
        $module_id = $this->input->post('module_id');
        //$question_order_id = $_POST['next_question'] - 1;
        $question_order_id = $this->input->post('current_order');
        $questionId = $this->input->post('question_id');
        $answer_info = $this->input->post('answer');
        $module_type = $this->input->post('module_type');
        
        $this->take_decesion_for_assignment($questionId, $module_id, $question_order_id, json_encode($answer_info));
    }
    
    public function take_decesion_for_assignment($questionId, $module_id, $question_order_id, $answer_info)
    {
        
        $ans_array = $this->session->userdata('data');
        $user_id = $this->session->userdata('user_id');
        
        $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);
		$totMarks = 0;
        $questionName = json_decode($question_info_ai[0]['questionName']);
        if (isset($questionName->totMarks))
        {
            $totMarks = $questionName->totMarks;
        }
        
        $link1 = base_url();
        $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;
        $obtained_marks = 0;
        $ans_is_right = 'correct';
        
        $ind_ans = array(
            'question_order_id' => $question_info_ai[0]['question_order'],
            'module_type' => $question_info_ai[0]['moduleType'],
            'module_id' => $question_info_ai[0]['module_id'],
            'question_id' => $question_info_ai[0]['question_id'],
            'link' => $link2,
            'student_ans' => $answer_info,
            'workout' => $this->input->post('workout'),
            'student_taken_time' => $this->input->post('student_question_time'),
            'student_question_marks' => 0,
            'student_marks' => $obtained_marks,
            'ans_is_right' => $ans_is_right
        );

        $ans_array[$question_order_id] = $ind_ans;

        $this->session->set_userdata('data', $ans_array);

        if ($this->input->post('next_question') == 0) {
            $ans_array = $this->session->userdata('data');
            
            date_default_timezone_set($this->site_user_data['zone_name']);
            $end_time = time();
            
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['st_ans'] = json_encode($ans_array);
            $data['st_id'] = $user_id;
            $data['module_id'] = $module_id;
            $this->db->insert('tbl_student_answer', $data);
            
            //            Save on Student Progress Table
            $student_taken_time = $end_time - $this->session->userdata('exam_start');
            $p_data['timeTaken'] = $student_taken_time;
            $p_data['answerTime'] = $this->session->userdata('exam_start');
            $p_data['originalMark'] = $totMarks;
            $p_data['studentMark'] = 0;
            $p_data['student_id'] = $data['st_id'];
            $p_data['module'] = $data['module_id'];
            $p_data['percentage'] = 0;
            $p_data['moduletype'] = $question_info_ai[0]['moduleType'];

            $this->db->insert('tbl_studentprogress', $p_data);

            $this->session->unset_userdata('data', $ans_array);
        }
        
        echo 2;
    }

    public function error()
    {
        $module_id = $this->session->userdata('module_id');

        $student_id = $this->session->userdata('user_id');

        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $student_id);
        $data['student_marks'] = $this->Student_model->student_marks($student_id, $module_id);
        $data['data_error'] = $this->session->userdata('error_data');


        $total_question = json_decode($data['student_marks'][0]['st_ans']);

        $data['total_question'] = count((array) $total_question);

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('error_question_templete/error', $data, true);

        $this->load->view('master_dashboard', $data);
    }

    public function all_tutors_by_type($tutor_id, $module_type)
    {
        $data['tutor_id'] = $tutor_id;
        $data['module_type'] = $module_type;
        $session_module_info = $this->session->userdata('data');
        
        /*if ($session_module_info) {
            $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $session_module_info[1]['module_id'], $this->session->userdata('user_id'));
        }

        if (isset($tutorial_ans_info) && !empty($tutorial_ans_info)) {*/
        //wrong answers by student on tutorial section
        // $this->Student_model->deleteInfo('tbl_temp_tutorial_mod_ques', 'st_id', $this->session->userdata('user_id'));
        //}
        
        $this->session->unset_userdata('data');
        $this->session->unset_userdata('obtained_marks');
        $this->session->unset_userdata('total_marks');
        $this->session->unset_userdata('isFirst');
        
        
        $data['moduleType'] = $module_type;
        $data['tutorInfo'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $tutor_id);
        
        //If not match with today date
        //$this->delete_st_error_ans(date('Y-m-d'));
        

        $data['user_info'] = $this->Student_model->userInfo($this->loggedUserId);
        if ($module_type == 2 && $data['tutorInfo'][0]['user_type'] == 7) {
            $get_all_course = $this->Student_model->studentCourses($this->loggedUserId);
            $course_match_with_subject_key_val = array();
            foreach ($get_all_course as $course) {
                $course['subject_id'] = $course['course_id'];
                $course['subject_name'] = $course['courseName'];
                $course_match_with_subject_key_val[] = $course;
            }
        } else {
            if ($data['tutorInfo'][0]['user_type'] == 7) {
                //            $data['studentSubjects'] = $this->Student_model->studentSubjects($this->loggedUserId);
                //$subject_with_course = $this->Student_model->studentSubjects($this->loggedUserId);
				
				$registered_courses = $this->Student_model->registeredCourse($this->session->userdata('user_id'));
                $studentSubjects = array();
                if(count($registered_courses) > 0)
                {
                    $oreder_s = 0;

                    foreach($registered_courses as $sub)
                    {

                        $assign_course = $this->Student_model->getInfo('tbl_assign_subject', 'course_id',$sub['id']);

                        if (!empty($assign_course))
                        {
                            $subjectId = json_decode($assign_course[0]['subject_id']);

                            foreach($subjectId as $key=>$value)
                            {

                                $sb =  $this->Student_model->getInfo('tbl_subject', 'subject_id',$value);

                                if (!empty($sb))
                                {
                                    $studentSubjects[$oreder_s]['subject_id'] = $sb[0]['subject_id'];
                                    $studentSubjects[$oreder_s]['subject_name'] = $sb[0]['subject_name'];
                                    $studentSubjects[$oreder_s]['created_by'] = $sb[0]['created_by'];
                                }
                                 $oreder_s++;
                            }

                        }
                       
                       
                    }
                }
                $subject_with_course = $studentSubjects;
            }

            // if ($data['tutorInfo'][0]['user_type'] == 3) {
                // $data['studentSubjects'] = $this->Student_model->getInfo('tbl_subject', 'created_by', $tutor_id);
            // }

            if ($data['tutorInfo'][0]['user_type'] == 3) {
                
                //$subject_with_course = $this->Student_model->get_tutor_subject($tutor_id);
                //$data['studentSubjects'] = $subject_with_course;
                // $data['studentSubjects'] = array_values(array_column($students_all_subject, null, 'subject_id'));
				$subject_with_course = $this->Student_model->getInfo('tbl_subject', 'created_by',$tutor_id);
            }
			$data['studentSubjects'] = $subject_with_course;
            //$students_all_subject = array();

            //foreach ($subject_with_course as $subject_course) {
               // $set_subject = 1;
                //if ($subject_course['isAllStudent'] == 0) {
                    //$individualStudent = json_decode($subject_course['individualStudent']);
                    //$individualStudent = is_null($individualStudent) ? [] : $individualStudent;
                    //if (sizeof($individualStudent) && in_array($this->loggedUserId, $individualStudent)) {
                    //    $set_subject = 1;
                   // } else {
                     //   $set_subject = 0;
                   // }
                //}
                //if ($set_subject == 1) {
                //    $students_all_subject[] = $subject_course;
               // }
            //}

            //$data['studentSubjects'] = array_values(array_column($students_all_subject, null, 'subject_id'));
        }
        
		if ($tutor_id == 2)
        {
            $data['registered_courses'] = $this->Student_model->registeredCourse($this->session->userdata('user_id'));

        $first_course_subjects = array();
        if (isset($data['registered_courses'][0]['id']))
        {
            $first_course = $data['registered_courses'][0]['id'];
            $course_id = $first_course;
            if (isset($course_id) && $course_id != '')
            {
                $assign_course = $this->Student_model->getInfo('tbl_assign_subject', 'course_id',$course_id);
                if (!empty($assign_course))
                {
                    $subjectId = json_decode($assign_course[0]['subject_id']);

                    $sb =  $this->Student_model->getInfo_subjects('tbl_subject', 'subject_id',$subjectId);
                  

                }
            }
        }
        
        if (isset($sb) && $sb != '')
        {
            $data['first_course_subjects'] = $sb;
            $data['first_course_id'] = $first_course;
            //$data['studentSubjects'] = $sb;
        }
        }

        if (!empty($_SERVER['HTTP_REFERER'])) {
            if (strpos($_SERVER['HTTP_REFERER'],"/show_tutorial_result/") || strpos($_SERVER['HTTP_REFERER'],"/get_tutor_tutorial_module/")) {
                if (!empty($_SESSION['prevUrl_after_student_finish_buton'])) {
                    $_SESSION['prevUrl'] = $_SESSION['prevUrl_after_student_finish_buton'];
                }
            }else{
                $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
            }
        }
		
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('students/module/all_module_list', $data, true);

        $this->load->view('master_dashboard', $data);
    }
	public function studentsModuleByQStudyNew()
    {
        $data['student_error_ans'] = $this->Student_model->getInfo('tbl_st_error_ans', 'st_id', $this->session->userdata('user_id'));

        $post         = $this->input->post();
        $subjectId    = isset($post['subjectId']) ? $post['subjectId'] : '';
        $courseId    = isset($post['courseId']) ? $post['courseId'] : '';
        $chapterId    = isset($post['chapterId']) ? $post['chapterId'] : '';
        $moduleType   = isset($post['moduleType']) ? $post['moduleType'] : '';
        //        $tutorType  = isset($post['tutorId']) ? $post['tutorId'] : '';
        $tutorId      = isset($post['tutorId']) ? $post['tutorId'] : '';
        $tutorInfo = $this->Student_model->getInfo('tbl_useraccount', 'id', $tutorId);

        // $studentGrade = $this->Student_model->studentClass($this->loggedUserId);

        $studentGrade_country = $this->Student_model->studentClass($this->loggedUserId);
        $studentGrade = $studentGrade_country[0]['student_grade'];

        if ($subjectId == 'all') {
            $subjectId = '';
        }

        if (isset($tutorInfo[0]['user_type']) && $tutorInfo[0]['user_type'] == 7) {//q-study
            $conditions = array(
            'subject'              => $subjectId,
            'course_id'            => $courseId,
            'chapter'              => $chapterId,
            'moduleType'           => $moduleType,
            'tbl_module.user_type' => 7,
            'studentGrade'         => $studentGrade,
            );
//            if ($moduleType == 2) {
//                $conditions['course_id'] = $subjectId;
//            } else {
//                $conditions['subject'] = $subjectId;
//            }

            $conditions = array_filter($conditions);
            // Newly Added
            $data['all_subject_student'] =$this->Student_model->getInfo('tbl_registered_course', 'user_id', $this->session->userdata('user_id'));
            $result = array_column($data['all_subject_student'], 'course_id');

            $registered_course = implode(', ', $result);
            if ($subjectId == 'all' || $subjectId == '') {
                $desired_result = '';
            } else {
                $desired_result = $subjectId;
            }

            // $data['all_subject_qStudy'] =$this->Student_model->get_all_subject($tutorInfo[0]['user_type']);
            // $data['all_subject_student'] =$this->Student_model->get_all_subject_for_registered_student($this->session->userdata('user_id'));

            // if ($subjectId == 'all' || $subjectId == '') {
                // $first_array_q = array_column($data['all_subject_qStudy'], 'subject_id');
                // $second_array_st = array_column($data['all_subject_student'], 'subject_id');

                // $desired_result = '';
                // $result = array_intersect($first_array_q, $second_array_st);
                // if ($result) {
                    // $desired_result = implode(', ', $result);
                // }
            // } else {
                // $desired_result = $subjectId;
            // }


            if ($moduleType == 2 || $moduleType == 1) {
                // $all_module = $this->ModuleModel->allModule(array_filter($conditions));
                $all_module = $this->ModuleModel->allModule(array_filter($conditions) ,$studentGrade_country[0]['country_id'] );
            } else {
                $all_module = $this->Student_model->all_module_by_type($tutorInfo[0]['user_type'], $desired_result, $result, $conditions);
            }
            // echo '<pre>';print_r($all_module);die;
            // $data['maincontent'] = $this->load->view('students/qstudy_module/all_tutorial_list', $data, true);
        } else { //module created by general tutor
            $conditions = array(
            'subject'              => $subjectId,
            'chapter'              => $chapterId,
            'moduleType'           => $moduleType,
            //            'tbl_module.user_type' => $tutorType,
            'studentGrade'         => $studentGrade,
            'user_id'              => $tutorId,
            );

            $conditions = array_filter($conditions);
            // $all_module = $this->ModuleModel->allModule(array_filter($conditions));
            $all_module = $this->ModuleModel->allModule(array_filter($conditions) ,$studentGrade_country[0]['country_id'] );
        }

        // $all_module = $this->ModuleModel->allModule(array_filter($conditions));

        $new_array  = array();
        $sct_info  = array();

        //echo '<pre>';print_r($all_module);die;

        foreach ($all_module as $module) {
            if ($module['isAllStudent']) {
                $sct_info[] = $module;
            } elseif (strlen($module['individualStudent'])) {
                if ($module['individualStudent']) {
                    $stIds = json_decode($module['individualStudent']);

                    if (in_array($this->loggedUserId, $stIds)) {
                        $sct_info[] = $module;
                    }
                }
            }
        }

        if ($moduleType == 2) {
            foreach ($sct_info as $idx => $module) {
                $get_student_ans_by_module = $this->Student_model->student_module_ans_info($this->session->userdata('user_id'), $module['id']);

                if ($this->site_user_data['student_grade'] != $module['studentGrade']) {
                    unset($sct_info[$idx]);
                } elseif ($module['repetition_days']) {
                    $repition_days = json_decode($module['repetition_days']);

                    $b = array_map(array($this, 'get_repitition_days'), $repition_days);//array_map("fix1", $repition_days);

                    date_default_timezone_set($this->site_user_data['zone_name']);
                    $today = date('Y-m-d');

                    // If Date match with repeated date And module ans is available for this student
                    if (in_array($today, $b) && $get_student_ans_by_module) {
                        $get_answer_repeated_module = $this->Student_model->get_answer_repeated_module($this->session->userdata('user_id'), $module['id'], $today);
                        $st_ans = json_decode($get_student_ans_by_module[0]['st_ans'], true);

                        // If no ans is available for wrong and data is found in tbl_answer_repeated_module for this user id, module id and today date
                        if (!in_array('wrong', array_column($st_ans, 'ans_is_right')) || $get_answer_repeated_module) { // search value in the array
                            unset($sct_info[$idx]);
                        } else { // If wrong ans is available
                            $this->insert_error_question('', $st_ans);
                            $sct_info[$idx]['is_repeated'] = 1;
                        }
                    }

                    // If today not match with repeated date But module ans is available for this student
                    elseif ($get_student_ans_by_module) {
                        unset($sct_info[$idx]);
                    }
                } elseif (($module['repetition_days'] == '' && $get_student_ans_by_module)) {
                    unset($sct_info[$idx]);
                }
            }

            // Keep array with same index to match for all type of module
            foreach ($sct_info as $module) {
                $new_array[] = $module;
            }

            $this->show_all_module($new_array);
        } else {
            $this->show_all_module($all_module);
        }
    }
    
    /**
     * All module added by Q-study for student(ajax hit).
     *
     * First we picked students enrolled course and match the course with subject recorded.
     * We can choose subject and chapter to filter module search
     *
     * @return string render module items with table tag
     */
    public function studentsModuleByQStudy()
    {
        $data['student_error_ans'] = $this->Student_model->getInfo('tbl_st_error_ans', 'st_id', $this->session->userdata('user_id'));
        
        $post         = $this->input->post();
        $subjectId    = isset($post['subjectId']) ? $post['subjectId'] : '';
        $chapterId    = isset($post['chapterId']) ? $post['chapterId'] : '';
        $moduleType   = isset($post['moduleType']) ? $post['moduleType'] : '';
        //        $tutorType  = isset($post['tutorId']) ? $post['tutorId'] : '';
        $tutorId      = isset($post['tutorId']) ? $post['tutorId'] : '';
        $tutorInfo = $this->Student_model->getInfo('tbl_useraccount', 'id', $tutorId);
        
        $studentGrade_country = $this->Student_model->studentClass($this->loggedUserId);
        $studentGrade = $studentGrade_country[0]['student_grade'];

        if ($subjectId == 'all') {
            $subjectId = '';
        }
        
        if (isset($tutorInfo[0]['user_type']) && $tutorInfo[0]['user_type'] == 7) {//q-study
            $conditions = array(
//            'subject'              => $subjectId,
//            'course_id'            => ($moduleType == 2) ? $subjectId : 0,
            'chapter'              => $chapterId,
            'moduleType'           => $moduleType,
            'tbl_module.user_type' => 7,
            'studentGrade'         => $studentGrade,
            );
            if ($moduleType == 2) {
                $conditions['course_id'] = $subjectId;
            } else {
                $conditions['subject'] = $subjectId;
            }

            $conditions = array_filter($conditions);
            
            // Newly Added
            $data['all_subject_student'] =$this->Student_model->getInfo('tbl_registered_course', 'user_id', $this->session->userdata('user_id'));
            $result = array_column($data['all_subject_student'], 'course_id');
           
            $registered_course = implode(', ', $result);
            if ($subjectId == 'all' || $subjectId == '') {
                $desired_result = '';
            } else {
                $desired_result = $subjectId;
            }
        
            // $data['all_subject_qStudy'] =$this->Student_model->get_all_subject($tutorInfo[0]['user_type']);
            // $data['all_subject_student'] =$this->Student_model->get_all_subject_for_registered_student($this->session->userdata('user_id'));

            // if ($subjectId == 'all' || $subjectId == '') {
                // $first_array_q = array_column($data['all_subject_qStudy'], 'subject_id');
                // $second_array_st = array_column($data['all_subject_student'], 'subject_id');

                // $desired_result = '';
                // $result = array_intersect($first_array_q, $second_array_st);
                // if ($result) {
                    // $desired_result = implode(', ', $result);
                // }
            // } else {
                // $desired_result = $subjectId;
            // }
        
        
            if ($moduleType == 2) {
                // $all_module = $this->ModuleModel->allModule(array_filter($conditions));
                $all_module = $this->ModuleModel->allModule(array_filter($conditions) ,$studentGrade_country[0]['country_id'] );
            } else {
                $all_module = $this->Student_model->all_module_by_type($tutorInfo[0]['user_type'], $desired_result, $result, $conditions);
            }
            // echo '<pre>';print_r($all_module);die;
            // $data['maincontent'] = $this->load->view('students/qstudy_module/all_tutorial_list', $data, true);
        } else { //module created by general tutor
            $conditions = array(
            'subject'              => $subjectId,
            'chapter'              => $chapterId,
            'moduleType'           => $moduleType,
            //            'tbl_module.user_type' => $tutorType,
            'studentGrade'         => $studentGrade,
            'user_id'              => $tutorId,
            );

            $conditions = array_filter($conditions);
            // $all_module = $this->ModuleModel->allModule(array_filter($conditions));
            $all_module = $this->ModuleModel->allModule(array_filter($conditions) ,$studentGrade_country[0]['country_id'] );
        }
    
        // $all_module = $this->ModuleModel->allModule(array_filter($conditions));
    
        $new_array  = array();
        $sct_info  = array();
    
        //echo '<pre>';print_r($all_module);die;
    
        foreach ($all_module as $module) {
            if ($module['isAllStudent']) {
                $sct_info[] = $module;
            } elseif (strlen($module['individualStudent'])) {
                if ($module['individualStudent']) {
                    $stIds = json_decode($module['individualStudent']);

                    if (in_array($this->loggedUserId, $stIds)) {
                        $sct_info[] = $module;
                    }
                }
            }
        }
    
        if ($moduleType == 2) {
            foreach ($sct_info as $idx => $module) {

                $get_student_ans_by_module = $this->Student_model->student_module_ans_info($this->session->userdata('user_id'), $module['id']);
            
                if ($this->site_user_data['student_grade'] != $module['studentGrade']) {
                    unset($sct_info[$idx]);
                } elseif (json_decode($module['repetition_days']) !='' && $module['repetition_days'] !='null') {
                    $repition_days = json_decode($module['repetition_days']);
                
                    if ($repition_days != '') {
                        $b = array_map(array($this, 'get_repitition_days'), $repition_days);//array_map("fix1", $repition_days);
                    
                        date_default_timezone_set($this->site_user_data['zone_name']);
                        $today = date('Y-m-d');
                        
                        // If Date match with repeated date And module ans is available for this student
                        if (in_array($today, $b) && $get_student_ans_by_module) {
                            $get_answer_repeated_module = $this->Student_model->get_answer_repeated_module($this->session->userdata('user_id'), $module['id'], $today);

                           // $ck_answer_repeated_today = $this->Student_model->ck_answer_repeated_module($this->session->userdata('user_id'), $module['id'], $today);

                            $st_ans = json_decode($get_student_ans_by_module[0]['st_ans'], true);
                            
                            // If no ans is available for wrong and data is found in tbl_answer_repeated_module for this user id, module id and today date
                            if (!in_array('wrong', array_column($st_ans, 'ans_is_right')) ) { // search value in the array
                                unset($sct_info[$idx]);
                            } else { // If wrong ans is available
                                $this->insert_error_question('', $st_ans);
                                $sct_info[$idx]['is_repeated'] = 1;
                            }
                        }

                        // If today not match with repeated date But module ans is available for this student
                        elseif ($get_student_ans_by_module) {
                            unset($sct_info[$idx]);
                        }
                    }
                    
                } elseif (( ($module['repetition_days'] == '' && $get_student_ans_by_module) || $module['repetition_days'] == 'null' )) {
                    unset($sct_info[$idx]);
                }
            }
            
            // Keep array with same index to match for all type of module
            foreach ($sct_info as $module) {
                $new_array[] = $module;
            }
            
            $this->show_all_module($new_array);
        } else {
            $this->show_all_module($all_module);
        }
    }
    
    function get_repitition_days($n)
    {
        if ($n) {
            $val = (explode('_', $n));
            return $val[1];
        }
    }
    
    
    public function show_all_module($allModule)
    {
        date_default_timezone_set($this->site_user_data['zone_name']);
        $now_time = date('Y-m-d H:i:s');
        
        $now_time_for_additional = date("Y-m-d",strtotime($now_time)); 

        // echo $allModule[0]['exam_end'].'<pre>';
        // echo strtotime($now_time);die;
        $count = 0;
        
        $row = '';
        if ($allModule) {

            if($allModule[0]['moduleType'] != 3){
             $row .= '<input type="hidden" id="first_module_id" value="'.$allModule[0]['id'].'">';
            }
            
            foreach ($allModule as $module) {
                $now_time_for_additional_2 = date("Y-m-d",strtotime($module['exam_end'])); 
                if ($module['moduleType'] != 3 || ( $module['optionalTime'] == 0 && $module['moduleType'] == 3 && strtotime($now_time) < strtotime($module['exam_end']))) {
                    
                    if($module['moduleType'] == 3 && $count==0){
                        // print_r($module);
                             $row .= '<input type="hidden" id="first_module_id" value="'.$module['id'].'">';
                             $count++;
                     }
                    $is_repeated = '';
                    if (isset($module['is_repeated']) && $module['is_repeated'] == 1) {
                        $is_repeated = '(Repeated Module)';
                    }
                    
                    $video_link = json_decode($module['video_link']);
                    $link = 'get_tutor_tutorial_module/'.$module['id'].'/1';
                    /*if ($video_link) {
                        $link = 'video_link/'.$module['id'].'/'.$module['moduleType'];
                    }*/
                    
                    $row .= '<tr>';
                    //$row .= '<td><a onclick="get_permission('.$module['id'].')" href="' . $link .'">' . $module['moduleName'] . '</a></td>';
                    if (isset($module['is_repeated'])) {
                        $row .= '<td><a onclick="get_permission('.$module['id'].')" href="javascript:;">' . $module['moduleName'] . ' <span style="color:red;">( Repeat )</span> </a></td>';
                    }
                    else{
                        $row .= '<td><a onclick="get_permission('.$module['id'].')" href="javascript:;">' . $module['moduleName'] . '</a></td>';
                    }
                    //$row .= '<td style="cursor:pointer;"><a onclick="get_permission('.$module['id'].')">' . $module['moduleName'] . $is_repeated . '</a></td>';
                    // $row .= '<td>'.$module['creatorName'].'</td>';
                    $row .= '<td>' . $module['trackerName'] . '</td>';
                    $row .= '<td>' . $module['individualName'] . '</td>';
                    if ($module['moduleType'] ==2 &&  $module['user_id'] ==2) {
                    
                    }else{
                        $row .= '<td>' . $module['subject_name'] . '</td>';
                        $row .= '<td>' . $module['chapterName'] . '</td>';
                    }
                    $row .= '</tr>';
                }
                if ( $module['optionalTime'] != 0 && $module['moduleType'] == 3 && ($now_time_for_additional_2 == $now_time_for_additional  )) {
            

                     if($module['moduleType'] == 3 && $count==0){
                        // print_r($module);
                             $row .= '<input type="hidden" id="first_module_id" value="'.$module['id'].'">';
                             $count++;
                     }

                    // $count++;
                    $is_repeated = '';
                    if (isset($module['is_repeated']) && $module['is_repeated'] == 1) {
                        $is_repeated = '(Repeated Module)';
                    }
                    
                    $video_link = json_decode($module['video_link']);
                    $link = 'get_tutor_tutorial_module/'.$module['id'].'/1';
                    /*if ($video_link) {
                        $link = 'video_link/'.$module['id'].'/'.$module['moduleType'];
                    }*/
                    
                    $row .= '<tr>';
                    //$row .= '<td><a onclick="get_permission('.$module['id'].')" href="' . $link .'">' . $module['moduleName'] . '</a></td>';
                    $row .= '<td><a onclick="get_permission('.$module['id'].')" href="javascript:;">' . $module['moduleName'] . '</a></td>';
                    //$row .= '<td style="cursor:pointer;"><a onclick="get_permission('.$module['id'].')">' . $module['moduleName'] . $is_repeated . '</a></td>';
                    // $row .= '<td>'.$module['creatorName'].'</td>';
                    $row .= '<td>' . $module['trackerName'] . '</td>';
                    $row .= '<td>' . $module['individualName'] . '</td>';
                    $row .= '<td>' . $module['subject_name'] . '</td>';
                    $row .= '<td>' . $module['chapterName'] . '</td>';
                    $row .= '</tr>';
                }
            }
        }
        echo strlen($row)?$row:'no module found';
    }
    

    public function module_details($module_id)
    {
        echo $module_id;
    }

    public function get_draw_image()
    {
        $this->load->library('image_lib');
        $img = $_POST['imageData'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $path = 'assets/uploads/draw_images/';
        $draw_file_name = 'draw' . uniqid();
        $file = $path . $draw_file_name . '.png';
        file_put_contents($file, $data);

        $config['image_library'] = 'gd2';
        $config['source_image'] = $file;
        $config['maintain_ratio'] = true;
        $config['width'] = 400;
        $config['height'] = 250;

        $this->image_lib->initialize($config);
        $this->image_lib->resize();

        echo base_url().$file;
    }
    
    public function show_tutorial_result($module)
    {
        $user_id = $this->session->userdata('user_id');
        $data['module_info'] = $this->tutor_model->getInfo('tbl_module', 'id', $module);
        $data['obtained_marks'] = $this->Student_model->get_student_progress($user_id, $module);
        if ($data['module_info'][0]['moduleType'] == 2 && $data['module_info'][0]['optionalTime'] !=0 && empty($data['obtained_marks']))
        {
            $std_ans = json_encode($this->session->userdata('data'));
            $obtained_marks = $this->session->userdata('obtained_marks');
            $total_marks = $this->session->userdata('total_marks');
            $student_taken_time = $this->session->userdata('end_time') - $this->session->userdata('exam_start');
            $std_ans_module_data['st_id'] = $user_id;
            $std_ans_module_data['st_ans'] = $std_ans;
            $std_ans_module_data['module_id'] = $module;
            $this->db->insert('tbl_student_answer', $std_ans_module_data);
            $p_data['timeTaken'] = $student_taken_time;
            $p_data['answerTime'] = $this->session->userdata('exam_start');
            $p_data['originalMark'] = $total_marks;
            $p_data['studentMark'] = $obtained_marks;
            $p_data['student_id'] = $user_id;
            $p_data['module'] = $module;
            $p_data['percentage'] = ($obtained_marks * 100) / $total_marks;
            $p_data['moduletype'] = 2;
            $this->db->insert('tbl_studentprogress', $p_data);
            $data['obtained_marks'] = $this->Student_model->get_student_progress($user_id, $module);

        }
        $get_dialogue = $this->Student_model->get_today_dialogue(date('m/d/Y'));
        // if (!$get_dialogue) {
            // $get_dialogue = $this->Student_model->get_whole_year_dialogue(date('Y'));
        // }
        if (!$get_dialogue) {
            $get_dialogue = $this->Student_model->get_auto_repeat_dialogue();
        }
        $data['dialogue'] = $get_dialogue;
        
        // echo date('m/d/Y');
        // echo '<pre>';print_r($data['dialogue']);die;
        
        $tutorial_ans_info = array();
        if ($data['module_info']) {
            if ($data['module_info'][0]['moduleType'] == 1) {
                $get_tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $module, $user_id);
                $tutorial_ans_info = json_decode($get_tutorial_ans_info[0]['st_ans'], true);
                
                $data['obtained_marks'] = $this->session->userdata('obtained_marks');
                $data['total_marks'] = $this->session->userdata('total_marks');
            } elseif ($data['module_info'][0]['moduleType'] == 2) {
                $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_st_error_ans', $module, $user_id);
                //            $tutorial_ans_info = json_decode($get_tutorial_ans_info[0]['st_ans'],TRUE);
                $module_id = $module;
            } else {
                $get_tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_student_answer', $module, $user_id);
                $tutorial_ans_info = json_decode($get_tutorial_ans_info[0]['st_ans'], true);
            }
            
            // if($tutorial_ans_info) {
            $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $user_id);
            
            $data['tutorial_ans_info'] = $tutorial_ans_info;
            $data['module_info'] = $this->tutor_model->getInfo('tbl_module', 'id', $module);
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['header'] = '';
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

            $data['maincontent'] = $this->load->view('students/show_module_result', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            redirect('error');
        }
    }

    /**
     * All chapters of a subject(ajax hit)
     *
     * @param  integer $subjectId subject id
     * @return string             rendered chapter items
     */
    public function renderedChapters($subjectId)
    {
        $chapters = $this->Student_model->chaptersOfSubject($subjectId);
        $row ='<option value="">Select Chapter</option>';
        foreach ($chapters as $chapter) {
            $row .= '<option value="'.$chapter['id'].'">'.$chapter['chapterName'].'</option>';
        }
        echo $row;
    }
    
    public function get_permission()
    {
        $module_id = $this->input->post('module_id');
        $get_student_ans_by_module = $this->Student_model->student_module_ans_info($this->session->userdata('user_id'), $module_id);
        $get_student_error_ans_info = $this->Student_model->student_error_ans_info($this->session->userdata('user_id'), $module_id);
        $module = $this->Student_model->getInfo('tbl_module', 'id', $module_id);
        
        $link = '';
        $b = [];
        
        
        // First check module's repitition availability
        // IF match with repeated date and data found in student ans table
        // Do insert on st_error_ans
        
        if ($module[0]['repetition_days'] && $module[0]['repetition_days'] !='null') {
            $repition_days = strlen($module[0]['repetition_days']) ? json_decode($module[0]['repetition_days']) : [1,2,3];
            
            function fix($n)
            {
                if ($n) {
                    $val = (explode('_', $n));
                    return $val[1];
                }
            }
            
            $b = array_map("fix", $repition_days);
            $b = count($b) ? $b : [];
            
            date_default_timezone_set($this->site_user_data['zone_name']);
            $today = date('Y-m-d');
            
            if (in_array($today, $b) && $get_student_ans_by_module) {
                $st_ans = json_decode($get_student_ans_by_module[0]['st_ans'], true);
                if ($st_ans) {
                    $this->insert_error_question($get_student_error_ans_info, $st_ans);
                    
                    foreach ($st_ans as $row) {
                        if ($row['ans_is_right'] == 'wrong') {
                            $link = 'get_tutor_tutorial_module/'. $module_id . '/' . $row['question_order_id'];
                            break;
                        }
                    }
                }
            }
            
            if (!$get_student_ans_by_module) {
                $link = 'get_tutor_tutorial_module/'. $module_id . '/1';
            }
        } else {
            $video_link = json_decode($module[0]['video_link']);
            $link = 'get_tutor_tutorial_module/' . $module[0]['id'] . '/1';
            if ($video_link) {
                $link = 'video_link/' . $module[0]['id'] . '/' . $module[0]['moduleType'];
            }
        }
        
        echo $link;
    }
    
    public function insert_error_question($get_student_error_ans_info, $st_ans)
    {
        foreach ($st_ans as $row) {
            // Insert only when 'tbl_st_error_ans' is empty for this student and for this module and if the worng answer is available
            if ($row['ans_is_right'] == 'wrong') {
                $data_err['st_id'] = $this->session->userdata('user_id');
                $data_err['question_id'] = $row['question_id'];
                $data_err['question_order_id'] = $row['question_order_id'];
                $data_err['module_id'] = $row['module_id'];
                $data_err['error_count'] = 1;
                
                $get_specific_error_data = $this->Student_model->get_count_std_error_ans($row['question_order_id'], $row['module_id'], $this->session->userdata('user_id'));
                
                if (!$get_specific_error_data) {
                    $this->db->insert('tbl_st_error_ans', $data_err);
                }
            }
        }
    }
    
    
    public function finish_all_module_question($module_id)
    {
        $user_id = $this->session->userdata('user_id');
        $module = $this->Student_model->getInfo('tbl_module', 'id', $module_id);

        $this->Student_model->deleteInfo_mod_ques_2($user_id , $module_id);
        
        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $module_id, $user_id);
        if ($tutorial_ans_info) {
            $this->Student_model->deleteInfo('tbl_temp_tutorial_mod_ques', 'id', $tutorial_ans_info[0]['id']);
        }
        
        $b = array();
        date_default_timezone_set($this->site_user_data['zone_name']);
        $today = date('Y-m-d');
        
        //        First check in module has repitition days
        //        Second check if available then check is repitition days match with today

        if ($module[0]['repetition_days']) {
            $repition_days = strlen($module[0]['repetition_days']) ? json_decode($module[0]['repetition_days']) : [1, 2, 3];

            function fix($n)
            {
                if ($n) {
                    $val = (explode('_', $n));
                    return $val[1];
                }
            }

            $b = array_map("fix", $repition_days);
            $b = count($b) ? $b : [];
        }
        
        //        if today is not available in repitition days then delete
        //        Delete tbl_st_error_ans data for Everyday Study

	
        if (!in_array($today, $b)) {
            $student_error_ans_info = $this->Student_model->student_error_ans_info($user_id, $module_id);
            if ($student_error_ans_info) {
                if ($module[0]['moduleType'] == 2 && $module[0]['optionalTime'] !=0)
                {
                    $this->Student_model->delete_all_st_error_ans($module_id, $user_id);

                }else {
                    $this->Student_model->delete_all_st_error_ans($module_id, $user_id);
                }
            }
        }
        
        if (in_array($today, $b)) {
            $data['std_id'] = $user_id;
            $data['repeat_module_id'] = $module_id;
            $data['answered_date'] = $today;
            
            $this->db->insert('tbl_answer_repeated_module', $data);
        }

        $ck_module_data = $this->Student_model->ck_module_date('tbl_module', $module_id);

        $ck_module_data_2 = json_decode($ck_module_data[0]['repetition_days']);

        foreach ($ck_module_data_2 as $key => $value) {
           $a = explode('_',$value);
           if ($a[1] !=  $today) {
               $var[] = $value;
           }
        }

        $this->Student_model->repete_date_module_index($module_id, json_encode($var));
        
        redirect('all_tutors_by_type/'.$module[0]['user_id'].'/'.$module[0]['moduleType']);
    }

    public function student_view($id)
    {
        
        $data_4 = array();
        
        // $order_id  = $this->input->post('order_id', true);
        // // print_r($order_id); die();
        $back  = $this->input->post('bk', true);
        $next = $this->input->post('nxt', true);
        $previous_page_server = $_SESSION["previous_page"];
        // print_r($_SESSION["previous_page"]);
        
        $order_no_pre =  $_SESSION['q_order']-1; 
        $order_no_nxt =  $_SESSION['q_order']+1; 
        $order_no_module =  $_SESSION['q_order_module']; 
        $order_previsous_url = $_SESSION['q_order_2'];
        $order_current_url =$_SESSION['q_order'];
        $add_order = $order_previsous_url+1;
        $url_base = base_url();
        $next_page =$url_base."get_tutor_tutorial_module/".$_SESSION['q_order_module']."/".$add_order;  
        // print_r($next_page); die();
        
        if (empty($back) && empty($next) ) {

            $datas = $this->ModuleModel->tutor_infos($id,0);
            $_SESSION["order"] = $datas[0]->orders;
            $output ='';
            $output .='<h4>Add The followings:</h4>';
            $output .='<img src="assets/uploads/'.$datas[0]->img.'" width="100%" height="100%"><br>';
            $output .='</div>'; 

            $output .='<div class="row">';
            $output .='<div class="col-md-6">';
            if ($datas[0]->audio !="none" && $datas[0]->speech !="none") {
                $output .='Audio file: <audio controls>';
                $output .='<source src ="assets/uploads/question_media/'.$datas[0]->audio.'" type="audio/mpeg">';
                $output .='</audio><br><br>';
                $output .='</div>';
                $output .='Speech to text :
                      <i class="fa fa-volume-up" onclick="speak()"></i>
                      <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                      <input type="hidden" id="wordToSpeak" value="'.$datas[0]->speech.'">';
                $output .='</div>';           
                $output .='</div>';       
            }

            if ($datas[0]->audio !="none" && $datas[0]->speech =="none") {
                $output .='Audio file: <audio controls>';
                $output .='<source src ="assets/uploads/question_media/'.$datas[0]->audio.'" type="audio/mpeg">';
                $output .='</audio><br><br>';
                $output .='</div>';           
                $output .='</div>'; 
            }
            if ($datas[0]->audio =="none" && $datas[0]->speech !="none") {
                $output .='Speech to text :
                      <i class="fa fa-volume-up" onclick="speak()"></i>
                      <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                      <input type="hidden" id="wordToSpeak" value="'.$datas[0]->speech.'">';
                $output .='</div>';           
                $output .='</div>';
            }          

            $output .='<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
            <script>
            function speak() {
                var word = $("#wordToSpeak").val();
                responsiveVoice.speak(word);
              }
            </script>'; 
            print_r($output);
        }
        if (!empty($back)) {
           $bk = $_SESSION["order"] - 1; 
           $_SESSION["order"] = $bk; 
           $datas = $this->ModuleModel->tutor_infos($id,$bk);
           if (!empty($datas)) {
                $output ='';
                $output .='<h4>Add The followings:</h4>';
                $output .='<img src="assets/uploads/'.$datas[0]->img.'" width="100%" height="100%"><br>';
                $output .='</div>'; 

                $output .='<div class="row">';
                $output .='<div class="col-md-6">';
                if ($datas[0]->audio !="none" && $datas[0]->speech !="none") {
                $output .='Audio file: <audio controls>';
                $output .='<source src ="assets/uploads/question_media/'.$datas[0]->audio.'" type="audio/mpeg">';
                $output .='</audio><br><br>';
                $output .='</div>';
                $output .='Speech to text :
                      <i class="fa fa-volume-up" onclick="speak()"></i>
                      <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                      <input type="hidden" id="wordToSpeak" value="'.$datas[0]->speech.'">';
                $output .='</div>';           
                $output .='</div>';       
                }

                if ($datas[0]->audio !="none" && $datas[0]->speech =="none") {
                    $output .='Audio file: <audio controls>';
                    $output .='<source src ="assets/uploads/question_media/'.$datas[0]->audio.'" type="audio/mpeg">';
                    $output .='</audio><br><br>';
                    $output .='</div>';           
                    $output .='</div>'; 
                }
                if ($datas[0]->audio =="none" && $datas[0]->speech !="none") {
                    $output .='Speech to text :
                          <i class="fa fa-volume-up" onclick="speak()"></i>
                          <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                          <input type="hidden" id="wordToSpeak" value="'.$datas[0]->speech.'">';
                    $output .='</div>';           
                    $output .='</div>';
                }

                $output .='<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
                <script>
                function speak() {
                    var word = $("#wordToSpeak").val();
                    responsiveVoice.speak(word);
                  }
                </script>'; 
                print_r($output);
           }
           else{
            $var = [
                "first"=>0,
                "module_id"=>$order_no_module,
                "order"=>$_SESSION["previous_page"]
            ];
            array_push($data_4, $var);
            echo json_encode($data_4);
           }
        }

        if (!empty($next)) {
           $nxt = $_SESSION["order"] + 1; 
           $_SESSION["order"] = $nxt; 
           $datas = $this->ModuleModel->tutor_infos($id,$nxt);
           if (!empty($datas)) {
                $output ='';
                $output .='<h4>Add The followings:</h4>';
                $output .='<img src="assets/uploads/'.$datas[0]->img.'" width="100%" height="100%"><br>';
                $output .='</div>'; 

                $output .='<div class="row">';
                $output .='<div class="col-md-6">';
                if ($datas[0]->audio !="none" && $datas[0]->speech !="none") {
                $output .='Audio file: <audio controls>';
                $output .='<source src ="assets/uploads/question_media/'.$datas[0]->audio.'" type="audio/mpeg">';
                $output .='</audio><br><br>';
                $output .='</div>';
                $output .='Speech to text :
                      <i class="fa fa-volume-up" onclick="speak()"></i>
                      <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                      <input type="hidden" id="wordToSpeak" value="'.$datas[0]->speech.'">';
                $output .='</div>';           
                $output .='</div>';       
                }

                if ($datas[0]->audio !="none" && $datas[0]->speech =="none") {
                    $output .='Audio file: <audio controls>';
                    $output .='<source src ="assets/uploads/question_media/'.$datas[0]->audio.'" type="audio/mpeg">';
                    $output .='</audio><br><br>';
                    $output .='</div>';           
                    $output .='</div>'; 
                }
                if ($datas[0]->audio =="none" && $datas[0]->speech !="none") {
                    $output .='Speech to text :
                          <i class="fa fa-volume-up" onclick="speak()"></i>
                          <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                          <input type="hidden" id="wordToSpeak" value="'.$datas[0]->speech.'">';
                    $output .='</div>';           
                    $output .='</div>';
                }

                $output .='<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
                <script>
                function speak() {
                    var word = $("#wordToSpeak").val();
                    responsiveVoice.speak(word);
                  }
                </script>'; 
                print_r($output);
           }
           else{

                $order_previsous_url =  substr($_SESSION["previous_page"], -1);

            if ( ( strstr( $_SESSION["previous_page"] , '/get_tutor_tutorial_module/' ) && $order_current_url < $order_previsous_url) ) {




            $var = [
                "first"=>0,
                "module_id"=>$order_no_module,
                "order"=>$_SESSION["previous_page"]
            ];
            array_push($data_4, $var);
            echo json_encode($data_4);
            }
            else{
                $var = [
                "first"=>0,
                "module_id"=>$order_no_module,
                "order"=>$next_page
            ];
            array_push($data_4, $var);
            echo json_encode($data_4);
            }
            
           }
        }
    }
	
	public function student_creative_quiz_ans_matching()
    {
        $response=array(
            'success'=> false,
            'error'=> false,
            'msg'=>'',
            'array_sequence' => '',
        );
        $clue_value = $this->input->post('clue_id');
        if ($clue_value >= 3)
        {
            $clue_id = $clue_value;
        }else
        {
            $clue_id = $clue_value+1;
        }

        $valueOfContent = $this->input->post('valueOfContent');
        $idOfContent = json_decode($this->input->post('idOfContent'));
        $AnswerData = array();
        $questionId = $this->input->post('questionId');
        $CreateParagraph = $this->input->post('createParagraphData');
        $data = $this->input->post('Pdata');
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $questionId);
        $question_name = json_decode($question_info[0]['questionName']);
        $question_description = json_decode($question_info[0]['questionDescription']);
        $answer = json_decode($question_info[0]['answer']);
        $paragraphOrder = $question_name->paragraph_order;
        $sentences = $question_name->sentence;



        $ContentId = array();
        $matchResult = array();
        $NotMatchResult = array();
        if (!empty($idOfContent))
        {
            $idcount = count($idOfContent);

            for ($i=0;$i<$idcount;$i++)
            {
                $idJcount = count($idOfContent[$i]);
                for ($j=0;$j<$idJcount;$j++)
                {
                    $ContentId[] = $idOfContent[$i][$j]+1;
                }
            }
        }

        $notInParagraph =array();
		$ContentId_length = count($ContentId);
        $answer_length = count($answer);
        $test = array();
        for ($x = 0;$x<$answer_length;$x++)
        {
            if (isset($ContentId[$x]))
            {
                if($answer[$x] != $ContentId[$x])
                {
                    $test[] = $ContentId[$x];
                }
            }
        }

        $notInParagraph = $test;
        $notInParagraphR = array();
        $ncount = count($notInParagraph);
        for ($n = 0;$n<$ncount;$n++)
        {
            $notInParagraphR[] = $notInParagraph[$n]-1;
        }

        $Idlength = count($answer);
        for($i =0;$i<$Idlength;$i++)
        {
            $ansValue =  $answer[$i];

            if (!empty($ContentId[$i]))
            {
                if ($ansValue == $ContentId[$i])
                {
                    $matchResult[]=$ContentId[$i];
                }else
                {
                    $NotMatchResult[]=$ContentId[$i];
                }
            }

        }


//        $NotMatchResult this array for answer sequence are not match id

        $matchingError = array();
        $paraIndex = array();

        $ansCount = count($paragraphOrder);
        for ($i = 0;$i<$ansCount;$i++)
        {
            if ($paragraphOrder[$i] == '')
            {
                $paraIndex[0][] = $i;
            }else{
                $paraIndex[$paragraphOrder[$i]][] = $i;
            }
        }

        $countIndex = count($paraIndex);


        if (!empty($paraIndex[0]))
        {
            for ($x = 0;$x<$countIndex;$x++)
            {
                if (!empty($idOfContent[$x]))
                {
                    $acb  = array_diff($idOfContent[$x],$paraIndex[$x]);
                    $matchingError[$x]= array_values($acb);
                }else
                {
                    $matchingError[$x] = [];
                }

            }
        }else
        {
            for ($x = 1;$x<$countIndex;$x++)
            {
                if (!empty($idOfContent[$x]))
                {
                    $acb  = array_diff($idOfContent[$x],$paraIndex[$x]);
                    $matchingError[$x]= array_values($acb);
                }else
                {
                    $matchingError[$x] = [];
                }
            }
        }

//        $matchingError this array is paragraph sequence id


        $NotMatchResults = array();
        if (!empty($NotMatchResult))
        {
            $idcount = count($NotMatchResult);

            for ($i=0;$i<$idcount;$i++)
            {
                $NotMatchResults[]=$NotMatchResult[$i]-1;
            }
        }

        $matchingErrors = array();
        if (!empty($matchingError))
        {
            $idcount = count($matchingError);

            for ($i=0;$i<$idcount;$i++)
            {
                if(!empty($matchingError[$i]))
                {
                    $countK = count($matchingError[$i]);
                    for ($k = 0;$k<$countK;$k++)
                    {
                        $matchingErrors[]=$matchingError[$i][$k];
                    }
                }
            }
        }

        $ErrorMessage = array();
        $userId = array();
        if (!empty($idOfContent))
        {
            $idcount = count($idOfContent);

            for ($i=0;$i<$idcount;$i++)
            {
                $idJcount = count($idOfContent[$i]);
                for ($j=0;$j<$idJcount;$j++)
                {
                    $userId[] = $idOfContent[$i][$j];
                }
            }
        }

        $cCount = count($userId);
        for ($c = 0;$c<$cCount;$c++)
        {
            $id = $userId[$c];
            $msg = $this->MessageCheck($id,$question_description,$test);
            if (!empty($msg))
            {
                $ErrorMessage[$id]=$msg;
            }
        }

        $msgArrayId = array_values($ErrorMessage);
        $TestMsg = array();
        $msgCount = count($msgArrayId);

        for ($f = 0;$f<$msgCount;$f++)
        {
            if ($msgArrayId[$f] == '')
            {

            }else
            {
                $TestMsg = $msgArrayId[$f];
            }
        }

        $data = array();

        $data['ErrorMessage'] = $ErrorMessage;

        $questionId = $this->input->post('questionId');
        $question_order_id = $this->input->post('current_order');
        $module_id = $this->input->post('module_id');
        $module_type = $this->input->post('module_type');
        $question_marks =$question_info[0]['questionMarks'];


        if (!empty($TestMsg) && !empty($test))
        {
            if (!empty($NotMatchResults))
            {
				$ans_is_right = 'wrong';

				if ($module_type == 1) {
					$this->creative_take_decesion_1($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
				} else {
					$this->creative_take_decesion_2($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
				}
                $response=array(
                    'success'=> false,
                    'error'=> false,
                    'msg'=>'failed',
                    'data'=>$data,
                    'clue_id'=>$clue_id,
                    'array_sequence' => 'Paragraph order is Not correct.',
                );
            }else
            {

					$ans_is_right = 'wrong';

					if ($module_type == 1) {
						$this->creative_take_decesion_1($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
					} else {
						$this->creative_take_decesion_2($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
					}
                $response = array(
                    'success'=> false,
                    'error'=> true,
                    'msg'=>'failed',
                    'data'=>$data,
                    'clue_id'=>$clue_id,
					'array_sequence' => '',
                );
            }

        }elseif ($ContentId_length != $answer_length ) {
			$ans_is_right = 'wrong';

            if ($module_type == 1) {
                $this->creative_take_decesion_1($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
            } else {
                $this->creative_take_decesion_2($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
            }
					$response=array(
						'success'=> false,
						'error'=> true,
						'msg'=>'failed',
						'data'=>$data,
						'clue_id'=>$clue_id,
						'array_sequence' => 'Paragraph order is Not correct.',
					);
				}else
        {
            $text = 0;
            $text_1 = 0;
            $ans_is_right = 'correct';

            if ($module_type == 1) {
                $this->creative_take_decesion_1($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
            } else {
                $this->creative_take_decesion_2($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
            }

            $response=array(
                'success'=> true,
                'error'=> false,
                'msg'=>'success',
                'clue_id'=>$clue_id,
            );
        }

		
        echo json_encode($response);

    }

    public function MessageCheck($id,$question_description,$matchingErrors)
    {

        $desCount = count($question_description);
        for ($d=0;$d<$desCount;$d++)
        {
            if ($question_description[$id])
            {
                return $question_description[$id];
            }else
            {
                $notCP =  $this->checkNotCP($id,$matchingErrors);
                return $notCP;
            }
        }
    }
    public function checkNotCP($id,$matchingErrors)
    {
        $mECount = count($matchingErrors);
        for ($x=0;$x<$mECount;$x++)
        {
            if ($matchingErrors[$x] == $id)
            {
                return 'not in the right paragraph.';
            }
        }
    }
    public function ParaCheck($id,$notInParagraphR)
    {
        $pCount = count($notInParagraphR);
        for ($p = 0;$p<$pCount;$p++)
        {
            if ($notInParagraphR[$p] == $id)
            {
                return $id;
            }
        }
    }
	private function creative_take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, $answer_info = null)
    {
        //****** Get Temp table data for Tutorial Module Type ******
        $user_id = $this->session->userdata('user_id');
        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $module_id, $user_id);
        //        print_r($tutorial_ans_info);die;
        $obtained_marks = $this->session->userdata('obtained_marks');
        $total_marks = $this->session->userdata('total_marks');
        $ans_array = $this->session->userdata('data');

        $flag = 0;

        if (!is_array($ans_array)) {
            $ans_array = array();
            $obtained_marks = 0;
            $total_marks = 0;
            $flag = 0;
        } else {
            $question_idd = '';
            if (isset($ans_array[$question_order_id]['question_id'])) {
                $question_idd = $ans_array[$question_order_id]['question_id'];
            }

            if ($question_id == $question_idd) {
                $flag = 1;
            } else {
                $flag = 0;
            }
        }

        $student_ans = '';
        if ($this->input->post('answer')) {
            $student_ans = $this->input->post('answer');
        }

        if ($tutorial_ans_info) {
            $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'], true);
            $flag = 2;
        }


        if ($ans_is_right == 'correct') {
            //            echo $ans_is_right;die;

            if ($answer_info != null) {
                $student_ans = $answer_info;
//                echo $answer_info;
            } else {
                //                    if ($flag != 2) {
//                echo 2;
                //                    }
            }
        } else {
            if ($answer_info != null) {
                $student_ans = $answer_info;
//                echo $answer_info;
            } else {
                //                if ($flag != 2) {
//                echo 3;
                //                }
            }

            $question_marks = 0;
        }

        if ($flag == 0) {
            $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);

            $link1 = base_url();

            $obtained_marks = $obtained_marks + $question_marks;
            $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];
            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;

            $ind_ans = array(
                'question_order_id' => $question_info_ai[0]['question_order'],
                'module_type' => $question_info_ai[0]['moduleType'],
                'module_id' => $question_info_ai[0]['module_id'],
                'question_id' => $question_info_ai[0]['question_id'],
                'link' => $link2,
                'student_ans' => json_encode($student_ans),
//                'workout' => $_POST['workout'],
//                'student_taken_time' => $_POST['student_question_time'],
                'student_question_marks' => $question_marks,
                'student_marks' => $obtained_marks,
                'ans_is_right' => $ans_is_right
            );
            $ans_array[$question_order_id] = $ind_ans;

            $this->session->set_userdata('data', $ans_array);
            $this->session->set_userdata('obtained_marks', $obtained_marks);
            $this->session->set_userdata('total_marks', $total_marks);

            if ($_POST['next_question'] == 0) {
                $total_ans = $this->session->userdata('data', $ans_array);

                $data['st_ans'] = json_encode($total_ans);
                $data['st_id'] = $this->session->userdata('user_id');
                $data['module_id'] = $module_id;

                if (!$tutorial_ans_info) {
                    $this->db->insert('tbl_temp_tutorial_mod_ques', $data);
                }

                //                $dec = $this->decesion_redirect($this->session->userdata('user_id'), $module_id);
                //                echo $dec;
            }
        }

        if ($flag == 2) {
            //            for ($i = 1; $i <= count($temp_table_ans_info); $i++) {
            foreach ($temp_table_ans_info as $key => $val) {
                //                echo $question_order_id.'<pre>';
                //                echo '<pre>';print_r($temp_table_ans_info[$key]);
                if ($temp_table_ans_info[$key]['question_order_id'] == $question_order_id) {
                    $temp_table_ans_info[$key]['ans_is_right'] = $ans_is_right;
                }
            }
            $update_value = json_encode($temp_table_ans_info);
            $st_ans['st_ans'] = $update_value;
            $this->Student_model->updateInfo('tbl_temp_tutorial_mod_ques', 'id', $tutorial_ans_info[0]['id'], $st_ans);

            //            echo 6;
        }
    }
	private function creative_take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, $answer_info = null)
    {
        // print_r($text_1);die;
        $obtained_marks = $this->session->userdata('obtained_marks');
        $total_marks = $this->session->userdata('total_marks');
        $ans_array = $this->session->userdata('data');
        $user_id = $this->session->userdata('user_id');

        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_student_answer', $module_id, $user_id);
        $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);
		$question_info = $this->Student_model->getInfo('tbl_question', 'id', $question_id);
        $question_type = $question_info[0]['questionType'];

        $flag = 0;

        if ($tutorial_ans_info) {
            $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'], true);
            $flag = 2;
        }

        if (!is_array($ans_array)) {
            $ans_array = array();
            $obtained_marks = 0;
            $total_marks = 0;
        } else {
            $question_idd = '';
            if (isset($ans_array[$question_order_id]['question_id'])) {
                $question_idd = $ans_array[$question_order_id]['question_id'];
            }

            if ($question_id == $question_idd) {
                $flag = 1;
            } else {
                $flag = 0;
            }
        }

        if (isset($_POST['answer'])) {
            $student_ans = $_POST['answer'];
        }

        if ($ans_is_right == 'correct') {
            if ($answer_info != null && $question_info_ai[0]['moduleType'] == 2) {
//                echo $answer_info;
                $student_ans = $answer_info;
            }

            if ($answer_info == null && $question_info_ai[0]['moduleType'] == 2) {
//                echo 2;
            }
        } else {
            if ($question_info_ai[0]['moduleType'] == 2) {
                if ($answer_info != null && $question_info_ai[0]['moduleType'] == 2) {
//                    echo $answer_info;
                    $student_ans = $answer_info;
                } if ($answer_info == null && $question_info_ai[0]['moduleType'] == 2) {
//                    echo 3;
                }
            }

            $question_marks = 0;
        }

        // echo $text;echo 'Flag: ';echo $flag;die;

        if ($flag == 2) {
            foreach ($temp_table_ans_info as $key => $val) {
                if ($temp_table_ans_info[$key]['question_order_id'] == $question_order_id) {
                    $temp_table_ans_info[$key]['ans_is_right'] = $ans_is_right;
                    $temp_table_ans_info[$key]['student_ans'] = json_encode($student_ans);
                }
            }

            $update_value = json_encode($temp_table_ans_info);
            $st_ans['st_ans'] = $update_value;
            // $this->Student_model->updateInfo('tbl_student_answer', 'id', $tutorial_ans_info[0]['id'], $st_ans);

            $count_std_error_ans = $this->Student_model->get_count_std_error_ans($question_order_id, $module_id, $user_id);

            if (isset($count_std_error_ans[0]['error_count']) && $count_std_error_ans[0]['error_count'] == 3) {
                $this->Student_model->delete_st_error_ans($question_order_id, $module_id, $user_id);
            } else {
                if ($ans_is_right == 'wrong') {
                    $this->Student_model->update_st_error_ans($question_order_id, $module_id, $user_id);
                }
                if ($ans_is_right == 'correct') {
                    $this->Student_model->delete_st_error_ans($question_order_id, $module_id, $user_id);
                }
            }

            if ($question_info_ai[0]['moduleType'] != 2) {
//                echo 5;
            }
        } if ($flag == 0) {
        $link1 = base_url();
        $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;

        $obtained_marks = $obtained_marks + $question_marks;
        $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];
		if ($question_type == 9)
        {
            $idOfContent = json_decode($this->input->post('idOfContent'));
            $student_ans = $idOfContent;
        }

        $ind_ans = array(
            'question_order_id' => $question_info_ai[0]['question_order'],
            'module_type' => $question_info_ai[0]['moduleType'],
            'module_id' => $question_info_ai[0]['module_id'],
            'question_id' => $question_info_ai[0]['question_id'],
            'link' => $link2,
            'student_ans' => json_encode($student_ans),
            'workout' => isset($_POST['workout']) ? $_POST['workout']:'',
//            'student_taken_time' => $_POST['student_question_time'],
            'student_question_marks' => $question_marks,
            'student_marks' => $obtained_marks,
            'ans_is_right' => $ans_is_right
        );
        //echo '<pre>';print_r($ind_ans);die;
        $ans_array[$question_order_id] = $ind_ans;

        $this->session->set_userdata('data', $ans_array);
        $this->session->set_userdata('obtained_marks', $obtained_marks);
        $this->session->set_userdata('total_marks', $total_marks);
        if ($question_info_ai[0]['moduleType'] != 2) {
//            echo 5;
        }

        if ($_POST['next_question'] == 0) {
            date_default_timezone_set($this->site_user_data['zone_name']);
            $end_time = time();
            $this->session->set_userdata('end_time', $end_time);

            $this->save_student_answer($module_id);
        }
    }
    }
	
	public function student_progress_step()
    {
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['types'] = $this->Student_model->get_organizing('tbl_enrollment', $this->session->userdata('user_id'));

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('students/student_progress_step', $data, true);
        $this->load->view('master_dashboard', $data);
    }
	
	public function student_progress_step_7()
    {

        $data['registered_courses'] = $this->Student_model->registeredCourse($this->session->userdata('user_id'));

        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('students/student_progress_step_qstudy', $data, true);
        $this->load->view('master_dashboard', $data);
    }
	
	//preview_memorization
     public function memorization_hide_data($question_name)
    {
        $show_data_array = array();
        $left_memorize_h_p_one = $question_name->left_memorize_h_p_one;
        $left_memorize_p_one = $question_name->left_memorize_p_one;
        $left_memorize_p_one = array_map('strtolower', $left_memorize_p_one);
        foreach ($left_memorize_p_one as $key=>$item) {
            if ($left_memorize_h_p_one[$key] == 0)
            {
                $show_data_array[] = $item;
            }else
            {
                $show_data_array[] = '';
            }
        }
        return $show_data_array;
    }
    public function memorization_ans_data($question_name)
    {

        $show_data_array = array();
        $left_memorize_h_p_one = $question_name->left_memorize_h_p_one;
        $left_memorize_p_one = $question_name->left_memorize_p_one;
        $left_memorize_p_one = array_map('strtolower', $left_memorize_p_one);
        foreach ($left_memorize_p_one as $key=>$item) {
            if ($left_memorize_h_p_one[$key] == 0)
            {
                $show_data_array[$key][0] = $item;
                $show_data_array[$key][1] = 0;
            }else
            {
                $show_data_array[$key][0] = $item;
                $show_data_array[$key][1] = 1;
            }
        }
        return $show_data_array;
    }

    public function preview_memorization_pattern_one_matching()
    {
        $show_data_array = array();
        $question_id = $this->input->post('question_id');
        $start_memorization_one_value = $this->input->post('start_memorization_one_value');
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $question_id);
        $question_name = json_decode($question_info[0]['questionName']);
        if ($start_memorization_one_value == 1)
        {
            $show_data_array['show_data_array'] = $this->memorization_ans_data($question_name);
            $show_data_array['all_correct'] = 1;
        }else
        {
            $show_data_array['show_data_array'] = $this->memorization_hide_data($question_name);
            $show_data_array['all_correct'] = 0;
        }
        echo json_encode($show_data_array);
    }
    public function preview_memorization_pattern_one_ans_matching()
    {
        $data = array();
        $question_id = $this->input->post('question_id');
        $word_matching = $this->input->post('word_matching');
        $submit_cycle = $this->input->post('submit_cycle');
        $pattern = $this->input->post('pattern');
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $question_id);
        $question_name = json_decode($question_info[0]['questionName']);
        $show_data_array = array();
        $word_matching_answer = array();
        $all_correct_status = 1;
        $left_memorize_h_p_one = $question_name->left_memorize_h_p_one;
        $left_memorize_p_one = $question_name->left_memorize_p_one;
        $left_memorize_p_one = array_map('strtolower', $left_memorize_p_one);
		
		$question_type = $question_info[0]['questionType'];
        $question_info_pattern = '';
        $question_info_pattern = json_decode($question_info[0]['questionName']);
        if (isset($question_info_pattern->pattern_type))
        {
            $question_info_pattern = $question_info_pattern->pattern_type;
        }
        if ($question_type == 16)
        {
            if ($question_info_pattern == 1)
            {
                $set_array = array();
                $memorization_std_ans = array();
                $memorization_part = $this->input->post('memorization_one_part');
                $memorization_answer = $this->input->post('word_matching');
                $set_array = $this->session->userdata('memorization_std_ans');
                if ($memorization_part == 1)
                {
                    if (isset($_SESSION['memorization_one']))
                    {

                    }else{
                        $memorization_std_ans[0] = $memorization_answer;
                        $this->session->set_userdata('memorization_one',1);
                        $this->session->set_userdata('memorization_std_ans',$memorization_std_ans);
                    }
                }elseif($memorization_part == 2){
                    if (isset($_SESSION['memorization_two']))
                    {

                    }else{
                        $memorization_std_ans[0] = $set_array[0];
                        $memorization_std_ans[1] = $memorization_answer;
                        $this->session->set_userdata('memorization_two',1);
                        $this->session->set_userdata('memorization_std_ans',$memorization_std_ans);
                    }
                }
            }
        }
		
        if ($submit_cycle != 1)
        {
            foreach ($left_memorize_p_one as $key=>$item) {
                if ($left_memorize_h_p_one[$key] == 1)
                {
                    $show_data_array[] = $item;
                }else
                {
                    $show_data_array[] = '';
                }
            }
            foreach($show_data_array as $key=>$show_data)
            {
                if ($show_data != '')
                {
                    $word_matching_item = $word_matching[$key];
                    if ($show_data == $word_matching_item)
                    {
                        $word_matching_answer[]=1;
                    }else
                    {
                        $word_matching_answer[]=0;
                        $all_correct_status = 0;
                    }
                }else
                {
                    $word_matching_answer[]=2;
                }
            }
            $data_array = array();
            foreach ($word_matching_answer as $key=>$value)
            {
                if ($value != 1)
                {
                    $data_array[] =$left_memorize_p_one[$key];
                }else
                {
                    $data_array[] = '';
                }
            }
            $data['word_matching_answer'] =$word_matching_answer;
            $data['data_array'] =$data_array;
            $data['all_correct_status'] =$all_correct_status;
            $data['status'] =  0;
        }else{
            $word_matching = $this->input->post('word_matching');
            $show_data_array = array();
            $left_memorize_h_p_one = $question_name->left_memorize_h_p_one;
            $left_memorize_p_one = $question_name->left_memorize_p_one;
            $left_memorize_p_one = array_map('strtolower', $left_memorize_p_one);
            $correct_status = 1;
            $leftSileData = array();
            $word_matching_answer = array();
            foreach ($left_memorize_p_one as $key=>$item) {
                if ($left_memorize_p_one[$key] == $word_matching[$key])
                {
                    $show_data_array[$key][0] = $item;
                    $show_data_array[$key][1] = 1;
                    $leftSileData[$key][0] = '';
                    $leftSileData[$key][1] = 1;
                    $word_matching_answer[] = 1;

                }else
                {
                    $correct_status = 0;
                    $show_data_array[$key][0] = '';
                    $show_data_array[$key][1] = 0;
                    $leftSileData[$key][0] = $item;
                    $leftSileData[$key][1] = 0;
                    $word_matching_answer[] = 0;
                }
            }
            $data['word_matching_answer'] =  $word_matching_answer;
            $data['leftSileData'] =  $leftSileData;
            $data['all_correct_ans'] =  $show_data_array;
            $data['status'] =  1;
            $data['correct_status'] =  $correct_status;
        }

        echo json_encode($data);
    }
    public function preview_memorization_pattern_one_try()
    {
        $data = array();
        $all_check_hint = $this->input->post('all_check_hint');
        $question_id = $this->input->post('question_id');
        $correctAnswerStd = $this->input->post('correctAnswer');
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $question_id);
        $question_name = json_decode($question_info[0]['questionName']);
        $correctAnswer = explode(",",$correctAnswerStd);
        $show_data_array = $this->memorization_hide_data($question_name);
        $left_memorize_p_one = $question_name->left_memorize_p_one;
        $left_memorize_p_one = array_map('strtolower', $left_memorize_p_one);
        $show_correct_ans = array();
        $show_error_ans = array();

        foreach ($correctAnswer as $key=>$item) {
            if ($item == 1)
            {
                $show_correct_ans[] = $left_memorize_p_one[$key];
            }else
            {
                $show_correct_ans[] = '';
            }
        }
        $data['show_data_array']=$show_data_array;
        if ($all_check_hint == 1)
        {
            foreach ($correctAnswer as $key=>$item) {
                if ($item != 1) {
                    $show_error_ans[] = $left_memorize_p_one[$key];
                } else {
                    $show_error_ans[] = '';
                }
            }
            $data['show_data_array']=$show_error_ans;
            $data['all_check_hint']=1;
        }

        $data['show_correct_ans']=$show_correct_ans;

        echo json_encode($data);
    }
    public function preview_memorization_pattern_one_ok()
    {

        $qus_ans =0;
        $question_marks = 0;
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $question_order_id = $this->input->post('current_order');
        $submit_cycle = $this->input->post('submit_cycle');
		$memorization_answer = $this->input->post('memorization_answer');
        $text = 0;
        $text_1 = 0;

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        if (isset($answer_info[0]['questionMarks']))
        {
            $question_marks = $answer_info[0]['questionMarks'];
        }
        $ans_is_right = 'correct';
		if ($memorization_answer == 'correct')
        {
            if (isset($answer_info[0]['questionMarks']))
            {
                $question_marks = $answer_info[0]['questionMarks'];
            }
        }else{
            $ans_is_right = 'wrong';
        }
        
        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }
    public function preview_memorization_pattern_three_take_decesion()
    {
        $qus_ans =0;
        $question_marks = 0;
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $question_order_id = $this->input->post('current_order');
        //$submit_cycle = $this->input->post('submit_cycle');
		$memorization_answer = $this->input->post('memorization_answer');
        $text = 0;
        $text_1 = 0;

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        if (isset($answer_info[0]['questionMarks']))
        {
            $question_marks = $answer_info[0]['questionMarks'];
        }
        $ans_is_right = 'correct';

		if ($memorization_answer == 'correct')
        {
            
            if (isset($answer_info[0]['questionMarks']))
            {
                $question_marks = $answer_info[0]['questionMarks'];
            }
        }else{

            $ans_is_right = 'wrong';
        }
        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }
    public function preview_memorization_pattern_two_take_decesion()
    {
        $qus_ans =0;
        $question_marks = 0;
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $question_order_id = $this->input->post('current_order');
        //$submit_cycle = $this->input->post('submit_cycle');
		$memorization_answer = $this->input->post('memorization_answer');
        $text = 0;
        $text_1 = 0;

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        if (isset($answer_info[0]['questionMarks']))
        {
            $question_marks = $answer_info[0]['questionMarks'];
        }
        $ans_is_right = 'correct';

		if ($memorization_answer == 'correct')
        {
            $ans_is_right = 'correct';
            if (isset($answer_info[0]['questionMarks']))
            {
                $question_marks = $answer_info[0]['questionMarks'];
            }
        }else{
            $ans_is_right = 'wrong';
            $text_1 =1;
        }
        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }

    public function preview_memorization_pattern_two_matching()
    {
        $data = array();
        $question_id = $this->input->post('question_id');
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $question_id);
        $question_name = json_decode($question_info[0]['questionName']);
        $left_memorize_p_one = $question_name->left_memorize_p_one;
        $first_alph = array();
        $col = array();
        $row = array();
        $i = 1;
        foreach ($left_memorize_p_one as $item)
        {
            $split_array = str_split(trim($item), 1);
            $col[] = count($split_array);
            $row[] = $i;
            $first_alph[] = $split_array[0];
            $i++;
        }
        $data['col'] = $col;
        $data['row'] = count($row);
        $data['first_alph'] = $first_alph;
        echo json_encode($data);
    }
    public function preview_memorization_pattern_two_ans_matching()
    {
        $data = array();
        $question_id = $this->input->post('question_id');
        $submit_cycle = $this->input->post('submit_cycle');
        $left_memorize_p_one_alpha_ans = $this->input->post('left_memorize_p_one_alpha_ans');
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $question_id);
        $question_name = json_decode($question_info[0]['questionName']);
        $left_memorize_p_one = $question_name->left_memorize_p_one;
		$question_type = $question_info[0]['questionType'];
        $question_info_pattern = '';
        $question_info_pattern = json_decode($question_info[0]['questionName']);
        if (isset($question_info_pattern->pattern_type))
        {
            $question_info_pattern = $question_info_pattern->pattern_type;
        }
        if ($question_type == 16)
        {
            if ($question_info_pattern == 1)
            {
                $set_array = array();
                $memorization_std_ans = array();
                $memorization_part = $this->input->post('memorization_one_part');
                $memorization_answer = $this->input->post('left_memorize_p_one_alpha_ans');
                $set_array = $this->session->userdata('memorization_std_ans');
                if ($memorization_part == 3)
                {
                    if (isset($_SESSION['memorization_three']))
                    {

                    }else{
                        if (isset($set_array[0]))
                        {
                            $memorization_std_ans[0] = $set_array[0];
                        }else{
                            $memorization_std_ans[0] = '';
                        }
                        if (isset($set_array[1]))
                        {
                            $memorization_std_ans[1] = $set_array[1];
                        }else{
                            $memorization_std_ans[1] = '';
                        }
                        $memorization_std_ans[2] = $memorization_answer;
                        $this->session->set_userdata('memorization_three',1);
                        $this->session->set_userdata('memorization_std_ans',$memorization_std_ans);
                    }
                }
            }
        }
//        $left_memorize_p_one = array_map('strtolower', $left_memorize_p_one);
        $reply_ans = array();
        $reply_hints = array();
        $correct = 1;
        $correctAnswer = array();
        foreach ($left_memorize_p_one as $key=>$item)
        {
            if (isset($left_memorize_p_one_alpha_ans[$key]) && $left_memorize_p_one_alpha_ans[$key] != '')
            {
                if ($item == $left_memorize_p_one_alpha_ans[$key])
                {
                    $reply_ans[$key][0] = $item;
                    $reply_ans[$key][1] = 1;
                    $correctAnswer[] = 1;
                }else{
                    $reply_ans[$key][0] = $left_memorize_p_one_alpha_ans[$key];
                    $reply_ans[$key][1] = 0;
                    $correct = 0;
                    $correctAnswer[] = 0;
                }
            }else
            {
                $reply_ans[$key][0] = $left_memorize_p_one_alpha_ans[$key];
                $reply_ans[$key][1] = 0;
                $correct = 0;
                $correctAnswer[] = 0;
            }

        }

        foreach($left_memorize_p_one as $key=>$item)
        {

            if ($reply_ans[$key][1] == 0)
            {
                $split_array = str_split(trim($item), 1);
                $countHints = count($split_array);

                $maxShow = $countHints -3;
                for($hints = 0;$hints<$countHints;$hints++)
                {
                    //if ($hints<$maxShow)
                    //{
                    if (isset($split_array[$hints]))
                    {
                        //$cycle = $submit_cycle;
                        $cycle = $submit_cycle;
                        if ( $hints <= $cycle)
                        {
                            $reply_hints[$key][0][] = $split_array[$hints];
                        }else{
                            $reply_hints[$key][0][] = '';
                        }
                    }
                    //}
                }
                $reply_hints[$key][1] = 1;
            }else{
                $split_array = str_split(trim($item), 1);
                $reply_hints[$key][0] = $split_array;
                $reply_hints[$key][1] = 0;
            }
        }

        if ($correct == 0)
        {
            $submit_cycle = $submit_cycle + 1;
        }
        $data['submit_cycle'] = $submit_cycle ;
        $data['correct'] = $correct ;
        $data['correctAnswer'] = $correctAnswer ;
        $data['reply_ans'] = $reply_ans;
        $data['reply_hints'] = $reply_hints;
        echo json_encode($data);
    }

    public function preview_memorization_pattern_two_try()
    {
        $data = array();
        $question_id = $this->input->post('question_id');
        $correctAnswer = $this->input->post('correctAnswer');
        $submit_cycle = $this->input->post('submit_cycle');
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $question_id);
        $question_name = json_decode($question_info[0]['questionName']);
        $correctAnswer = explode(",",$correctAnswer);
        $left_memorize_p_one = $question_name->left_memorize_p_one;
        $show_correct_ans = array();
        $next = array();
        foreach ($correctAnswer as $key=>$item) {
            if ($item == 1)
            {
                $show_correct_ans[] = $left_memorize_p_one[$key];
            }else
            {
                $show_correct_ans[] = '';
            }
        }
        foreach ($correctAnswer as $key=>$value)
        {
            if ($value == 1)
            {
                $item = $left_memorize_p_one[$key];
                $split_array = str_split(trim($item), 1);
                $next[$key][0] = $split_array;
                $next[$key][1] = 1;
            }else
            {
                $item = $left_memorize_p_one[$key];
                $split_array = str_split(trim($item), 1);
                $countHints = count($split_array);
                $maxShow = $countHints - 3;
                for($hints = 0;$hints<$countHints;$hints++)
                {
                    if (isset($split_array[$hints]))
                    {
                        $cycle = $submit_cycle;
                        $cycle = $submit_cycle - 1;
                        if ( $hints <= $cycle && $hints <$maxShow)
                        {
                            $next[$key][0] = $split_array[$hints];
                        }else{
                            $next[$key][0] = '';
                        }
                    }
                }
                $next[$key][1] = 0;
            }
        }

        $data['next'] = $next;
        $data['show_correct_ans'] = $show_correct_ans;
        echo json_encode($data);
    }
    public function getQuestionById($question_id)
    {
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $question_id);
        $question_name = json_decode($question_info[0]['questionName']);
        return $question_name;
    }
    public function preview_memorization_p_two_start_memorization()
    {
        $question_id = $this->input->post('question_id');
        $question_name = $this->getQuestionById($question_id);

        $left_memorize_p_two = $question_name->left_memorize_p_two;
        $left_memorize_h_p_two = $question_name->left_memorize_h_p_two;
        $right_memorize_p_two = $question_name->right_memorize_p_two;
        $right_memorize_h_p_two = $question_name->right_memorize_h_p_two;
        $left_content = array();
        $right_content = array();
        if (isset($question_name->hide_pattern_two_left))
        {
            $hide_pattern_two_left = $question_name->hide_pattern_two_left;
            $left_content = $this->contentModifyByHidden($left_memorize_p_two,$left_memorize_h_p_two);
        }else
        {
            $hide_pattern_two_left = 0;
            $left_content = $this->contentModify($left_memorize_p_two);
        }
        if (isset($question_name->hide_pattern_two_right))
        {
            $hide_pattern_two_right = $question_name->hide_pattern_two_right;
            $right_content = $this->contentModifyByHidden($right_memorize_p_two,$right_memorize_h_p_two);
        }else{
            $hide_pattern_two_right = 0;
            $right_content = $this->contentModify($right_memorize_p_two);
        }

        $data['right_content'] = $right_content;
        $data['left_content'] = $left_content;
        echo json_encode($data);
    }

    public function preview_memorization_p_two_ans_matching()
    {
        $data = array();
        $question_id = $this->input->post('question_id');
        $left_memorize_p_two_ans = $this->input->post('left_memorize_p_two');
        $right_memorize_p_two_ans = $this->input->post('right_memorize_p_two');
        $cycle = $this->input->post('pattern_two_cycle');
        $question_name = $this->getQuestionById($question_id);
        $left_memorize_p_two = $question_name->left_memorize_p_two;
        $left_memorize_h_p_two = $question_name->left_memorize_h_p_two;
        $right_memorize_p_two = $question_name->right_memorize_p_two;
        $right_memorize_h_p_two = $question_name->right_memorize_h_p_two;

        $left_content = array();
        $right_content = array();
        if (isset($question_name->hide_pattern_two_left))
        {
            $hide_pattern_two_left = $question_name->hide_pattern_two_left;
            $left_content = $this->MemorizationAnswerMatching($cycle,$left_memorize_p_two,$left_memorize_p_two_ans,$left_memorize_h_p_two);
        }
        if (isset($question_name->hide_pattern_two_right))
        {
            $hide_pattern_two_right = $question_name->hide_pattern_two_right;
            $right_content = $this->MemorizationAnswerMatching($cycle,$right_memorize_p_two,$right_memorize_p_two_ans,$right_memorize_h_p_two);
        }
        $cycle = $cycle + 2;
        $data['cycle'] = $cycle;
        $data['left_content'] = $left_content;
        $data['right_content'] = $right_content;
        echo json_encode($data);
    }
    public function MemorizationAnswerMatching($cycle,$tutorAns,$stdAns,$hiddenContent)
    {
        $data = array();
        $matchingAnswer = array();
        $correct = 1;
        $singleSentences = array();
        $word = array();
        foreach($hiddenContent as $key=>$item)
        {
            $TAns = str_replace(array('.', ' ', "\n", "\t", "\r"), '', strip_tags($tutorAns[$key][0]));
            
            $SAns = str_replace(array('.', ' ', "\n", "\t", "\r"), '', $stdAns[$key]);
            

            if ($item[0] == 1)
            {
                if ($TAns === $SAns)
                {
                    $matchingAnswer[$key][0] =  strip_tags($tutorAns[$key][0]);
                    $matchingAnswer[$key][1] =  1;
                }else{
                    $matchingAnswer[$key][0] =  $stdAns[$key];
                    $matchingAnswer[$key][1] =  0;
                    $correct = 0;
                }
            }else
            {
                $matchingAnswer[$key][0] = strip_tags($tutorAns[$key][0]);
                $matchingAnswer[$key][1] = 2;
            }

        }
        if ($correct == 0)
        {
            foreach ($tutorAns as $key=>$tutorAn) {

                if ($hiddenContent[$key][0] == 1)
                {
                    $word[$key][] = explode(" ",trim($tutorAn[0]));
                }
            }
            $data['clue']= $this->clueArray($cycle,$word);
        }
        $data['matchingAnswer']=$matchingAnswer;
        $data['correct']=$correct;
        return $data;
    }
    public function clueArray($cycle,$words)
    {
        $html ='';
        foreach ($words as $word)
        {
            $countW = count($word);
            $html .= '<div style="overflow: hidden">';
            for($i = 0;$i<$countW;$i++)
            {
                $countT = count($word[$i]);
                for($j = 0;$j<=$countT;$j++)
                {
                    if (isset($word[$i][$j]))
                    {
                        if ($j <= $cycle)
                        {
                            $html .= '<div style="float:left;height: 35px;min-width: 30px;margin-bottom:5px;margin-right:5px;display: inline-block;padding: 5px;border: 1px solid #ccc;">'.$word[$i][$j].'</div>';
                        }else
                        {
                            $html .= '<div style="float:left;height: 35px;min-width: 30px;margin-bottom:5px;margin-right:5px;display: inline-block;padding: 5px;border: 1px solid #ccc;"> </div>';
                        }

                    }
                }
              
            }
            $html .= '</div>';
        }
        return $html;
    }
    public function contentModifyByHidden($data,$checkData)
    {
        $modifyData = array();
        foreach($data as $key=>$value)
        {
            if ($checkData[$key][0] == 1)
            {
                $modifyData[] = '';
            }else
            {
                $modifyData[] = strip_tags($value[0]);
            }
        }
        return $modifyData;
    }
    public function contentModify($data)
    {
        $modifyData = array();
        foreach($data as $value)
        {
            $modifyData[] = strip_tags($value[0]);
        }
        return $modifyData;
    }

    public function preview_memorization_pattern_two_try_again()
    {
        $data = array();
        $question_id = $this->input->post('question_id');
        $question_name = $this->getQuestionById($question_id);
        $left_memorize_p_two = $question_name->left_memorize_p_two;
        $right_memorize_p_two = $question_name->right_memorize_p_two;
        $pattern_two_hidden_ans_left = $this->input->post('pattern_two_hidden_ans_left');
        $pattern_two_hidden_ans_right = $this->input->post('pattern_two_hidden_ans_right');
        $pattern_two_hidden_ans_left = explode(",",$pattern_two_hidden_ans_left);
        $pattern_two_hidden_ans_right = explode(",",$pattern_two_hidden_ans_right);
        $stdAnsLeft = array();
        $stdAnsRight = array();
        $returnLeft = array();
        $returnRight = array();
        $countL = count($pattern_two_hidden_ans_left);
        $countR = count($pattern_two_hidden_ans_right);
        if ($countL >1)
        {
            for ($i = 1;$i<$countL;$i = $i+2)
            {
                $stdAnsLeft[] = $pattern_two_hidden_ans_left[$i];
            }
            foreach ($left_memorize_p_two as $key=>$item)
            {
                if ($stdAnsLeft[$key] == 0)
                {
                    $returnLeft[] = '';
                }else{
                    $returnLeft[] = $item[0];
                }
            }
        }
        if ($countR >1)
        {
            for ($i = 1;$i<$countR;$i = $i+2)
            {
                $stdAnsRight[] = $pattern_two_hidden_ans_right[$i];
            }
            foreach ($right_memorize_p_two as $key=>$item)
            {
                if ($stdAnsRight[$key] == 0)
                {
                    $returnRight[] = '';
                }else{
                    $returnRight[] = $item[0];
                }
            }
        }
        $data['returnLeft'] = $returnLeft;
        $data['returnRight'] = $returnRight;
        $data['stdAnsLeft'] = $stdAnsLeft;
        $data['stdAnsRight'] = $stdAnsRight;
        echo json_encode($data);
    }

    public function preview_memorization_p_three_start_memorization()
    {
        $data = array();
        $question_id = $this->input->post('question_id');
        $question_name = $this->getQuestionById($question_id);
        $left_memorize_h_p_three = $question_name->left_memorize_h_p_three;
        $right_memorize_h_p_three = $question_name->right_memorize_h_p_three;
        $left_memorize_p_three = $question_name->left_memorize_p_three;
        $right_memorize_p_three = $question_name->right_memorize_p_three;
        $html = '';
        $i = 1;
        foreach($left_memorize_p_three as $key=>$left_data)
        {
            $html .= '<div class="row" style="margin-bottom: 10px;">';
            if ($left_memorize_h_p_three[$key] == 1)
            {
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';
                $html .= '<button valueId="left_image_ans_'.$i.'" imageId ="left_'.$i.'" type="button" class="show_all_images left_'.$i.'" style="width: 100%;height: 150px;">click</button>';
                $html .='<img src="" id="left_'.$i.'" style="margin: auto;" class="img-responsive">';
                $html .= '<input type="hidden" name="left_image_ans[]" class="left_image_ans_'.$i.'">';
                $html .= '</div>';

            }else{
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';
                $html .= '<img style="height:150px;margin: auto;" class="img-responsive" src="'.base_url().'/assets/uploads/'.$left_data.'">';
                $html .= '<input type="hidden" name="left_image_ans[]" class="left_image_ans_'.$i.'">';
                $html .= '</div>';
            }

            $html .= '<div class="col-sm-1">
                                            <span class="left_r_p_box_two_'.$i.'" style="display:none;position: absolute;font-weight:bold;top: 5px;color: green;">✓</span><span class="left_w_p_box_two_'.$i.'" style="display:none;position: absolute;font-weight:bold;top: 5px;color: red;">✖</span>
                                        </div>';

            if ($right_memorize_h_p_three[$key] == 1)
            {
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';
                $html .= '<button valueId="right_image_ans_'.$i.'" imageId ="right_'.$i.'" type="button" class="show_all_images right_'.$i.'" style="width: 100%;height: 150px;">click</button>';
                $html .='<img src="" id="right_'.$i.'" style="margin: auto;" class="img-responsive">';
                $html .= '<input type="hidden" name="right_image_ans[]" class="right_image_ans_'.$i.'">';
                $html .= '</div>';

            }else{
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';
                $html .= '<img style="height:150px;margin: auto;" class="img-responsive" src="'.base_url().'/assets/uploads/'.$right_memorize_p_three[$key].'">';
                $html .= '<input type="hidden" name="right_image_ans[]" class="right_image_ans_'.$i.'">';
                $html .= '</div>';
            }

            $html .= '<div class="col-sm-1">
                                            <span class="right_r_p_box_two_'.$i.'" style="display:none;position: absolute;font-weight:bold;top: 5px;color: green;">✓</span><span class="right_w_p_box_two_'.$i.'" style="display:none;position: absolute;font-weight:bold;top: 5px;color: red;">✖</span>
                                        </div>';
            $html .= '</div>';
            $i++;
        }

        echo json_encode($html);
    }

    public function preview_memorization_pattern_three_ans_matching()
    {
        $data = array();
        $question_id = $this->input->post('question_id');
        $left_image_ans = $this->input->post('left_image_ans');
        $right_image_ans = $this->input->post('right_image_ans');
        $question_name = $this->getQuestionById($question_id);
        $left_memorize_h_p_three = $question_name->left_memorize_h_p_three;
        $right_memorize_h_p_three = $question_name->right_memorize_h_p_three;
        $left_memorize_p_three = $question_name->left_memorize_p_three;
        $right_memorize_p_three = $question_name->right_memorize_p_three;

        $leftAnsMatching = array();
        $rightAnsMatching = array();
        $correct = 1;
        foreach($left_memorize_p_three as $key=>$leftData)
        {
            if ($left_memorize_h_p_three[$key] == 1)
            {
                if ($leftData == $left_image_ans[$key])
                {
                    $leftAnsMatching[] = 1;
                }else
                {
                    $leftAnsMatching[] = 0;
                    $correct = 0;
                }

            }else{
                $leftAnsMatching[] = 2;
            }

        }
        foreach($right_memorize_p_three as $key=>$rightData)
        {
            if ($right_memorize_h_p_three[$key] == 1)
            {
                if ($rightData == $right_image_ans[$key])
                {
                    $rightAnsMatching[] = 1;
                }else
                {
                    $rightAnsMatching[] = 0;
                    $correct = 0;
                }

            }else{
                $rightAnsMatching[] = 2;
            }

        }
        $data['leftAnsMatching'] = $leftAnsMatching;
        $data['rightAnsMatching'] = $rightAnsMatching;
        if ($correct == 0)
        {
            $data['correct'] = $correct;
        }else{
            $data['correct'] = $correct;
        }

        echo json_encode($data);
    }

    public function preview_memorization_pattern_three_try_again()
    {

        $data = array();
        $leftAns = explode(",",$this->input->post('leftAns'));
        $rightAns = explode(',',$this->input->post('rightAns'));

        $question_id = $this->input->post('question_id');
        $left_image_ans = $this->input->post('left_image_ans');
        $right_image_ans = $this->input->post('right_image_ans');
        $question_name = $this->getQuestionById($question_id);
        $left_memorize_h_p_three = $question_name->left_memorize_h_p_three;
        $right_memorize_h_p_three = $question_name->right_memorize_h_p_three;
        $left_memorize_p_three = $question_name->left_memorize_p_three;
        $right_memorize_p_three = $question_name->right_memorize_p_three;

        $html = '';
        $i = 1;
        foreach($left_memorize_p_three as $key=>$left_data)
        {
            $html .= '<div class="row" style="margin-bottom: 10px;">';
            if ($left_memorize_h_p_three[$key] == 1)
            {
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';

                if ($leftAns[$key] == 1)
                {
                    $html .= '<button valueId="left_image_ans_'.$i.'" imageId ="left_'.$i.'" type="button" class="show_all_images left_'.$i.'" style="width: 100%;height: 150px;position: absolute;opacity: 0;">click</button>';

                    $html .='<img sid="left_'.$i.'" style="margin: auto;height:150px;" class="img-responsive" src="'.base_url().'/assets/uploads/'.$left_data.'">';
                    $html .= '<input type="hidden" name="left_image_ans[]" class="left_image_ans_'.$i.'" value="'.$left_data.'">';
                }else
                {
                    $html .= '<button valueId="left_image_ans_'.$i.'" imageId ="left_'.$i.'" type="button" class="show_all_images left_'.$i.'" style="width: 100%;height: 150px;">click</button>';

                    $html .='<img src="" id="left_'.$i.'" style="margin: auto;" class="img-responsive">';
                    $html .= '<input type="hidden" name="left_image_ans[]" class="left_image_ans_'.$i.'">';
                }
                $html .= '</div>';

            }else{
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';
                $html .= '<img style="height:150px;margin: auto;" class="img-responsive" src="'.base_url().'/assets/uploads/'.$left_data.'">';

                $html .= '<input type="hidden" name="left_image_ans[]" class="left_image_ans_'.$i.'">';

                $html .= '</div>';
            }
            if ($leftAns[$key] == 1)
            {
                $html .= '<div class="col-sm-1">
                                            <span class="left_r_p_box_two_'.$i.'" style="display:block;position: absolute;font-weight:bold;top: 5px;color: green;">✓</span><span class="left_w_p_box_two_'.$i.'" style="display:none;position: absolute;font-weight:bold;top: 5px;color: red;">✖</span>
                                        </div>';
            }else
            {
                $html .= '<div class="col-sm-1">
                                            <span class="left_r_p_box_two_'.$i.'" style="display:none;position: absolute;font-weight:bold;top: 5px;color: green;">✓</span><span class="left_w_p_box_two_'.$i.'" style="display:none;position: absolute;font-weight:bold;top: 5px;color: red;">✖</span>
                                        </div>';
            }


            if ($right_memorize_h_p_three[$key] == 1)
            {
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';

                if ($rightAns[$key] == 1)
                {
                    $html .= '<button valueId="right_image_ans_'.$i.'" imageId ="right_'.$i.'" type="button" class="show_all_images right_'.$i.'" style="width: 100%;height: 150px;position: absolute;opacity: 0;">click</button>';
                    $html .='<img  id="right_'.$i.'" style="margin: auto;height:150px;" class="img-responsive" src="'.base_url().'/assets/uploads/'.$right_memorize_p_three[$key].'">';
                    $html .= '<input type="hidden" name="right_image_ans[]" class="right_image_ans_'.$i.'" value="'.$right_memorize_p_three[$key].'">';
                }else
                {
                    $html .= '<button valueId="right_image_ans_'.$i.'" imageId ="right_'.$i.'" type="button" class="show_all_images right_'.$i.'" style="width: 100%;height: 150px;">click</button>';
                    $html .='<img src="" id="right_'.$i.'" style="margin: auto;" class="img-responsive">';
                    $html .= '<input type="hidden" name="right_image_ans[]" class="right_image_ans_'.$i.'">';
                }

                $html .= '</div>';

            }else{
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';
                $html .= '<img style="height:150px;margin: auto;" class="img-responsive" src="'.base_url().'/assets/uploads/'.$right_memorize_p_three[$key].'">';

                $html .= '<input type="hidden" name="right_image_ans[]" class="right_image_ans_'.$i.'">';
                $html .= '</div>';
            }

            if ($rightAns[$key] == 1)
            {
                $html .= '<div class="col-sm-1">
                                            <span class="right_r_p_box_two_'.$i.'" style="display:block;position: absolute;font-weight:bold;top: 5px;color: green;">✓</span><span class="right_w_p_box_two_'.$i.'" style="display:none;position: absolute;font-weight:bold;top: 5px;color: red;">✖</span>
                                        </div>';
            }else
            {
                $html .= '<div class="col-sm-1">
                                            <span class="right_r_p_box_two_'.$i.'" style="display:none;position: absolute;font-weight:bold;top: 5px;color: green;">✓</span><span class="right_w_p_box_two_'.$i.'" style="display:none;position: absolute;font-weight:bold;top: 5px;color: red;">✖</span>
                                        </div>';
            }

            $html .= '</div>';
            $i++;
        }

        echo json_encode($html);
    }
    public function preview_memorization_pattern_three_ok()
    {
        echo '<pre>';
        print_r($_POST);
        echo '<br>';
        die();
    }

	public function question_tutorial_preview()
    {
        $html = '';
        $question_id  = $this->input->post('question_id', true);
        $tutorialInfo = $this->tutor_model->getInfo('tbl_question_tutorial', 'question_id', $question_id);

        foreach($tutorialInfo as $key=>$item)
        {
            $active = '';
            if ($key == 0)
            {
                $active = 'active';
            }
            $html .= '<div class="item '.$active.'" id="'.$item["speech"].'">';
            $html .= '<img width="100%" height="100%" style="max-height: 78vh;" src="'.base_url('/').'assets/uploads/'.$item["img"].'" alt="Tutorial Image">';
            $html .= '<input type="hidden" id="wordToSpeak" value="'.$item["speech"].'">';
            $html .= '</div>';
        }

        echo $html;
    }

    public function organization()
    {
        if ($this->session->userdata('userType') == 6) {
            $data['video_help'] = $this->FaqModel->videoSerialize(4, 'video_helps');
            $data['video_help_serial'] = 4;
        }

        $_SESSION['prevUrl'] = base_url('/').'student';   
        $data['types'] = $this->Student_model->get_organizing('tbl_enrollment', $this->session->userdata('user_id'));

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('students/organize_type', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function studyType($id)
    {
        if ($this->session->userdata('userType') == 6) {
            $data['video_help'] = $this->FaqModel->videoSerialize(4, 'video_helps');
            $data['video_help_serial'] = 4;
        }

        $_SESSION['prevUrl'] = base_url('/').'student/organization';
        $_SESSION['prevUrl_after_student_finish_buton'] = base_url('/').$_SERVER['PATH_INFO'];
        
        $data['types'] = $id;

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('students/study_type', $data, true);
        $this->load->view('master_dashboard', $data);
    }
	
	public function whiteboard_items()
    {

        if ($this->session->userdata('userType') == 3) {
            $data['video_help'] = $this->FaqModel->videoSerialize(6, 'video_helps');
        }if ($this->session->userdata('userType') == 4) {
            $data['video_help'] = $this->FaqModel->videoSerialize(8, 'video_helps');
        }
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true); 
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $data['maincontent'] = $this->load->view('students/whiteboard_items', $data, true);
        $this->load->view('master_dashboard', $data);
    
    }

    public function std_question_store()
    {
        $data['user_info'] = $this->Student_model->userInfo($this->loggedUserId);
        $data['allCountry']        = $this->Admin_model->search('tbl_country', [1=>1]);
        
        $subject_with_course = $this->Student_model->studentSubjects($this->loggedUserId);
        $students_all_subject = array();
        foreach ($subject_with_course as $subject_course) {
                $set_subject = 1;
                if ($subject_course['isAllStudent'] == 0) {
                    $individualStudent = json_decode($subject_course['individualStudent']);
                    $individualStudent = is_null($individualStudent) ? [] : $individualStudent;
                    if (sizeof($individualStudent) && in_array($this->loggedUserId, $individualStudent)) {
                        $set_subject = 1;
                    } else {
                        $set_subject = 0;
                    }
                }
                if ($set_subject == 1) {
                    $students_all_subject[] = $subject_course;
                }
            }
            $data['studentSubjects'] = array_values(array_column($students_all_subject, null, 'subject_id'));
            $data['registered_courses'] = $this->Student_model->registeredCourse($this->session->userdata('user_id'));
            $std_subjects =  array();
            if (isset($data['registered_courses'][0]['id'])){

            $courses = $data['registered_courses'];
            foreach($courses as $course)
            {
                $assign_course = $this->Student_model->getInfo('tbl_assign_subject', 'course_id',$course['id']);
                if (!empty($assign_course))
                {
                    $subjectId = json_decode($assign_course[0]['subject_id']);
                    $i = 0;
                    foreach($subjectId as $value)
                    {
                        $sb =  $this->Student_model->getInfo('tbl_subject', 'subject_id',$value);
                        if (!empty($sb))
                        {
                            $std_subjects[] = $sb;
                        }
                        $i++;
                    }
                }
            }      
        }
        $data['std_subjects'] =  $this->Student_model->getInfo('tbl_question_store_subject', 'created_by',2);
        $first_subject = $std_subjects[0][0]['subject_id'];
        $chapter =  $this->Student_model->getInfo('tbl_chapter', 'subjectId',$first_subject);
        $first_chapter = $chapter[0]['id'];
        $data['chapterName'] = $chapter[0]['chapterName'];
        $grade = $data['user_info'][0]['student_grade'];
        $conditions['grade']     = $grade;
        $conditions['subject']   = $first_subject;
        // $conditions['chapter']   = $first_chapter;
        
        $data['store_data'] = $this->Student_model->getQuestionStore($conditions);
       
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header']     = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $data['maincontent'] = $this->load->view('students/question_store', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function get_question_store_data()
    {
        $subject_id = 0;
        $grade      = 0;
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        $subject_id = $clean['sub_id'];
        $grade      = $clean['grade'];
        $result['error'] = 0;
        $result['msg'] = '';
        if($subject_id != 0 && $grade != 0)
        {
            $conditions['grade']     = $grade;
            $conditions['subject']   = $subject_id;
            $store_data = $this->Student_model->getQuestionStore($conditions);
            $html = '';
            if (!empty($store_data)) {
                foreach ($store_data as $key => $item) {
                    $chapter_id = $item['chapter'];
                    $chapter =  $this->Student_model->getInfo('tbl_question_store_chapter', 'id',$chapter_id);
                    $html .= '<tr>';
                    $html .= '<td><a href="download_question_store/'.$item['id'].'" store-id'.$item['id'].'>'.$chapter[0]['chapter_name'].'</a></td>';
                    $html .= '<td><img style="width:25px;"src="'.base_url('/').'assets/images/pdf-icon2.png"></td>';
                    $html .= '</tr>';
                } 
            }else
            {
                $html .= '<tr>';
                $html .= '<td></td>';
                $html .= '<td>No data found!</td>';
                $html .= '</tr>';
            }
            $result['error'] = 0;
            $result['data'] = $html;
            echo json_encode($result);
            die;
        }
        $result['error'] = 1;
        $result['msg'] = 'Invalid data!';
        echo json_encode($result);
        die;
    }

    public function search_question_store()
    {
        
        $subject_id = 0;
        $country    = 0;
        $grade      = 0;
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        
        if($clean['grade'] != '')
        {
            $grade      = $clean['grade'];
        }
        if($clean['subject_id'] != '')
        {
            $subject_id      = $clean['subject_id'];
        }
        if($clean['country'] != '')
        {
            $country      = $clean['country'];
        }
        
        $result['error'] = 0;
        $result['msg'] = '';
        if($subject_id != 0 && $grade != 0 &&  $country != 0)
        {
            $conditions['country']   = $country;
            $conditions['grade']     = $grade;
            $conditions['subject']   = $subject_id;
            
            $store_data = $this->Student_model->getQuestionStore($conditions);
            $html = '';
            if (!empty($store_data)) {
                foreach ($store_data as $key => $item) {
                    $chapter_id = $item['chapter'];
                    $chapter =  $this->Student_model->getInfo('tbl_question_store_chapter', 'id',$chapter_id);
                    $html .= '<tr>';
                    $html .= '<td><a href="download_question_store/'.$item['id'].'" store-id'.$item['id'].'>'.$chapter[0]['chapter_name'].'</a></td>';
                    $html .= '<td><img style="width:25px;"src="'.base_url('/').'assets/images/pdf-icon2.png"></td>';
                    $html .= '</tr>';
                } 
            }else
            {
                $html .= '<tr>';
                $html .= '<td></td>';
                $html .= '<td>No data found!</td>';
                $html .= '</tr>';
            }
            $result['error'] = 0;
            $result['data'] = $html;
            echo json_encode($result);
            die;
        }
        $result['error'] = 1;
        $result['msg'] = 'Invalid data!';
        echo json_encode($result);
        die;
    }
    public function download_question_store($id)
    {
        if (is_numeric($id)) {

           $store = $this->Student_model->getInfo('tbl_questions_store', 'id',$id);
           
           if (isset($store[0]['student_file'])) {
            $chapter =  $this->Student_model->getInfo('tbl_question_store_chapter', 'id',$store[0]['chapter']);
              $this->load->helper('download');
              $url = $store[0]['student_file'];
              $path = base_url().$url;
              $content = file_get_contents($path);
              force_download($chapter[0]['chapter_name'].'.pdf',$content);
           }
        }
    }

    public function yourClassRoom($id)
    {
        $roomInfo = $this->Student_model->getInfo('tbl_classrooms', 'id', $id );

        $havtutor = $this->Student_model->getInfo_tutor('tbl_enrollment', 'st_id', $this->session->userdata('user_id'));
        foreach ($havtutor as $key => $value) {
            $havtutor_2[] = $this->Student_model->getInfo('tbl_classrooms', 'tutor_id', $value['sct_id'] );
        }

        $links = array();

        foreach ($havtutor_2 as $key => $value) {
            if (count($value)) {
                if ($value[0]['all_student_checked']) {
                    $link[0] = base_url('/yourClassRoom/').$value[0]['id'];
                    $link[1] = $value[0]['tutor_name'];
                    $links[] = $link;
                    $link = array();
                }else{
                    $x = json_decode($value[0]['students']);
                    foreach ($x as $key => $val) {
                        if ($val == $this->session->userdata('user_id') ) {
                            $link[0] = base_url('/yourClassRoom/').$value[0]['id'];
                            $link[1] = $value[0]['tutor_name'];
                            $links[] = $link;
                            $link = array();
                        }
                    }
                }
            }
        }

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        if (count($links)) {
            $user_info = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
            $data['ifram'] = '<iframe src="//www.groupworld.net/room/'.$roomInfo[0]['class_url'].'/conf1?need_password=false&janus=true&hide_playback=true&username='.$user_info[0]['name'].'" allow="camera;microphone" width="100%" height="600" scrolling="no" frameborder="0"></iframe>';
        }else{
            redirect("404_override");
        }
        
        $data['maincontent'] = $this->load->view('students/whiteboardDashboard', $data, true);
        $this->load->view('master_dashboard', $data);
    }


    /*public function test()
    {
        $this->load->library('email');
        $config['protocol']    = 'smtp';
        $config['smtp_crypto']    = 'ssl';
        $config['smtp_port']    = '465';
        $config['mailtype']    = 'text';
        $config['smtp_host']    = 'email-smtp.us-east-1.amazonaws.com';
        $config['smtp_user']    = 'AKIAJASMGQXCHUGFOX2A';
        $config['smtp_pass']    = 'AhQPyL02MEAjbohY82vZLikIwY1O2sU4sOrdI6vC3HYk';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
         $this->email->initialize($config);

        $this->email->from('admin@q-study.com', 'myname');
        $this->email->to('shakil147258@gmail.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();

        echo $this->email->print_debugger();

        //mail('shakil147258@gmail.com', 'hit', 'hit');
    }*/
}
