<?php

class Student extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        if ($user_id == null && $user_type == null) {
            redirect('welcome');
        }
        $this->load->model('Student_model');
        $this->load->model('ModuleModel');
        $this->load->model('tutor_model');
        $this->load->model('Preview_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('upload');

        $this->loggedUserId = $this->session->userdata('user_id');
    }

    public function index()
    {
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

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
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[6]|min_length[5]');
        $this->form_validation->set_rules('passconf', 'passconf', 'trim|required|matches[password]');
        if ($this->form_validation->run() == false) {
            echo 0;
        } else {
            $password = md5($this->input->post('password'));
            $data = array(
                'user_pawd' => $password
                );
            $this->Student_model->updateInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'), $data);
            echo 1;
        }
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
                $this->Student_model->delete_enrollment($userType, $this->session->userdata('user_id'));
                foreach ($data_link as $single_link) {
                    $get_link_status = $this->Student_model->getLinkInfo('tbl_useraccount', 'SCT_link', 'user_type', $single_link, $userType);

                    if ($get_link_status) {
                        $enrollment_info = $this->Student_model->getLinkInfo('tbl_enrollment', 'sct_id', 'st_id', $get_link_status[0]['id'], $this->session->userdata('user_id'));
                        //echo '<pre>';print_r($get_link_status);die;
                        if (!$enrollment_info) {
                            $link['sct_id'] = $get_link_status[0]['id'];
                            $link['sct_type'] = $get_link_status[0]['user_type'];
                            $link['st_id'] = $this->session->userdata('user_id');
                            $this->Student_model->insertInfo('tbl_enrollment', $link);
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

            //echo '<pre>';print_r($desired_result);die;

            $data['all_module'] = $this->Student_model->all_module_by_type($tutorType, $module_type, $desired_result);
              // echo '<pre>';print_r($data['all_module']);die;
            $data['maincontent'] = $this->load->view('students/qstudy_module/all_tutorial_list', $data, true);
        }
        
        if ($tutorType == 3) {
            $data['maincontent'] = $this->load->view('students/qstudy_module/all_tutorial_list', $data, true);
            /*$loggedStudentId  = $this->loggedUserId;
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
                //if module checked for all students then following students obviously there, so grab it
                //if module checked for individual student, then check if student id is there -> if yes grab it
                foreach($mods as $module) {
                    if($module['isAllStudent']) {
                        $sct_info[$tutor['name']][] = $module;
                    } else if(sizeof($module['individualStudent'])) {
                        if($module['individualStudent']){
                            $stIds = json_decode($module['individualStudent']);

                            if (in_array($loggedStudentId, $stIds)) {
                                $sct_info[$tutor['name']][] = $module;
                            }
                        }
                    }
                }
            }

            $data['module_info'] = isset($sct_info)?$sct_info:NULL;
            $data['maincontent'] = $this->load->view('students/tutor_module/tutor_list', $data, true);*/
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

    //        echo '<pre>';print_r($data['subject_info']);die;

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

        $data['maincontent'] = $this->load->view('students/student_course/q_study_course', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    
    public function video_link($module_id, $module_type)
    {
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
//        $data['module_info'] = $this->Student_model->module_info($modle_id, $module_type, $student_grade);
        $data['module_info'] = $this->Student_model->getInfo('tbl_module', 'id', $modle_id);
//       echo '<pre>';print_r($data['module_info']);die;
        if (!$data['module_info']) {
            redirect('error');
        }
        $isFirst = 1;
      
        if (!$this->session->userdata('isFirst')) {
            $this->session->set_userdata('isFirst', $isFirst);
            if ($question_order_id == 1) {
                date_default_timezone_set('Asia/Dhaka');
                //echo 'Exam Time: '.$data['module_info'][0]['exam_start'].'<br>';
                $exact_time = time();
                $this->session->set_userdata('exact_time', $exact_time);
            }
        }

        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        //****** Get Temp table data for Tutorial Module Type ******
        if ($data['module_info'][0]['moduleType'] == 2) {
            $table = 'tbl_student_answer';
        } else {
            $table = 'tbl_temp_tutorial_mod_ques';
        }
        $data['tutorial_ans_info'] = $this->Student_model->getTutorialAnsInfo($table, $modle_id, $data['user_info'][0]['id']);
        
        $data['question_info_s'] = $this->tutor_model->getModuleQuestion($modle_id, $question_order_id, null);
        $data['total_question'] = $this->tutor_model->getModuleQuestion($modle_id, null, 1);
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        //echo '<pre>';print_r($data['question_info_s']);die;
        if ($data['question_info_s'][0]['question_type'] == 1) {
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_general', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 2) {
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_true_false', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 3) {
            $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_vocabulary', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 4) {
            $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_multiple_choice', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 5) {
            $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_multiple_response', $data, true);
        } elseif ($data['question_info_s'][0]['question_type'] == 6) {
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
            $data['question_info_left_right'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_matching', $data, true);
        }
        $this->load->view('master_dashboard', $data);
    }

    public function get_tutor_tutorial_module($modle_id, $question_order_id)
    {
        $select = '*';
        $table = 'tbl_module';
        
        $columnName = 'id';
        $columnValue = $modle_id;

        $data['user_info'] = $this->Student_model->userInfo($this->session->userdata('user_id'));
        $module_type = $this->tutor_model->get_all_where($select, $table, $columnName, $columnValue);
//        Get Student Ans From tbl_student_answer
        $flag = 0;
        $get_tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_student_answer', $modle_id, $this->session->userdata('user_id'));
        if ($module_type[0]['moduleType'] != 2) {
            if ($get_tutorial_ans_info) {
                $flag = 1;
            }
        } if ($module_type[0]['moduleType'] == 2) {
            $get_std_error_ans = $this->Student_model->student_error_ans_info($this->session->userdata('user_id'),$modle_id);
            $get_std_error_ans_flag = 0;
			// if (!$get_std_error_ans && $get_tutorial_ans_info) {
			if ($get_tutorial_ans_info) {
				
                $student_ans_info = json_decode($get_tutorial_ans_info[0]['st_ans'], true);
                foreach ($student_ans_info as $row) {
                    if ($row['ans_is_right'] == 'wrong') {
                        // $data_err['st_id'] = $this->session->userdata('user_id');
                        // $data_err['question_id'] = $row['question_id'];
                        // $data_err['question_order_id'] = $row['question_order_id'];
                        // $data_err['module_id'] = $row['module_id'];
                        // $data_err['error_count'] = 1;
                        
                        // $this->db->insert('tbl_st_error_ans', $data_err);
                        $get_std_error_ans_flag = 1;
                    }
                }
            }
//            if(!$get_std_error_ans || $get_tutorial_ans_info){
//                $flag = 1;
//            }
        }
       // print_r($module_type);die;
       // echo $flag;die;
        
        if (!$module_type || $flag) {
            redirect('error');
        }
        
        if ($module_type[0]['moduleType'] == 1) {
            $this->openModuleByTutorialBased($modle_id, $question_order_id);
        } elseif ($module_type[0]['moduleType'] == 2) {
            //  ***** For Checking Repetition and Check Erro ans Module *****
            $std_error_ans_by_order = $this->Student_model->get_std_error_ans($this->session->userdata('user_id'),$modle_id,$question_order_id);

            if($module_type[0]['repetition_days']){
                $repition_days = json_decode($module_type[0]['repetition_days']);
                function fix($n) {
                    if($n){
                        $val = (explode('_',$n));
                        return $val[1];
                    }
                }
                $b = array_map("fix", $repition_days);
                $today = date('Y-m-d');
                if(in_array($today,$b) && ($std_error_ans_by_order) && $std_error_ans_by_order[0]['is_count_3'] == 0){
                    $question_order_id = $std_error_ans_by_order[0]['question_order_id'];
//                    redirect('show_tutorial_result/'.$modle_id);
                }if(in_array($today,$b) && !($std_error_ans_by_order) && $get_std_error_ans_flag == 1){
					$question_order_id = $get_std_error_ans[0]['question_order_id'];
				}
            }
            //  ***** For Checking Repetition and Check Erro ans Module *****
            
            $this->openModuleByTutorialBased($modle_id, $question_order_id);
        } elseif ($module_type[0]['moduleType'] == 3) {
            $data['module_info'] = $this->Student_model->module_info($modle_id, $module_type[0]['moduleType'], $data['user_info'][0]['student_grade']);
            
            // date_default_timezone_set($data['user_info'][0]['zone_name']);
            date_default_timezone_set('Asia/Dhaka');
            $module_time = time();
//            echo strtotime($data['module_info'][0]['exam_start']);die;
            if (strtotime($data['module_info'][0]['exam_start']) < $module_time && strtotime($data['module_info'][0]['exam_end']) > $module_time) {
//                $this->openModuleBySpecialExamBased($modle_id, $question_order_id,$module_type[0]['moduleType'],$data['user_info'][0]['student_grade']);
            
                $this->openModuleByTutorialBased($modle_id, $question_order_id);
            } else {
                $this->all_module_by_type($data['module_info'][0]['user_type'], $data['module_info'][0]['moduleType']);
            }
//            $this->openModuleBySpecialExamBased($modle_id, $question_order_id);
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
     * @param  array $items json object array
     * @return array        array with proper indexing
     */
    public function indexQuesAns($items)
    {
        //print_r($items);die;
        $arr = [];
        foreach ($items as $item) {
            $temp = json_decode($item);
            $cr = explode('_', $temp->cr);
            //print_r($cr);die;
            $col = $cr[0];
            $row = $cr[1];
            $arr[$col][$row] = array(
                'type' => $temp->type,
                'val' => $temp->val
            );
        }
        return $arr;
    }

    /**
     * render the indexed item to table data for preview
     * @param  array  $items   ques ans as indexed item
     * @param  int  $rows    num of row in table
     * @param  int  $cols    num of cols in table
     * @param  integer $showAns optional, set 1 will show the answers too
     * @return string           table item
     */
    public function renderSkpQuizPrevTable($items, $rows, $cols, $showAns = 0)
    {
        //print_r($items);die;
        $row = '';
        for ($i = 1; $i <= $rows; $i++) {
            $row .='<tr>';
            for ($j = 1; $j <= $cols; $j++) {
                if ($items[$i][$j]['type'] == 'q') {
                    $row .= '<td><input type="button" data_q_type="0" data_num_colofrow="" value="' . $items[$i][$j]['val'] . '" name="skip_counting[]" class="form-control input-box  rsskpinpt' . $i . '_' . $j . '" readonly style="min-width:50px; max-width:50px"></td>';
                } else {
                    $ansObj = array(
                        'cr' => $i . '_' . $j,
                        'val' => $items[$i][$j]['val'],
                        'type' => 'a',
                    );
                    $ansObj = json_encode($ansObj);
                    $val = ($showAns == 1) ? ' value="' . $items[$i][$j]['val'] . '"' : '';

                    $row .= '<td><input autocomplete="off" type="text" ' . $val . ' data_q_type="0" data_num_colofrow="' . $i . '_' . $j . '" value="" name="skip_counting[]" class="form-control input-box ans_input  rsskpinpt' . $i . '_' . $j . '"  style="min-width:50px; max-width:50px">';
                    $row .= '<input type="hidden" value="" name="given_ans[]" id="given_ans">';
                    $row .='</td>';
                }
            }
            $row .= '</tr>';
        }

        return $row;
    }

    private function take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, $answer_info = null)
    {
        //****** Get Temp table data for Tutorial Module Type ******
        $user_id = $this->session->userdata('user_id');
        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $module_id, $user_id);
        
        
        $obtained_marks = $this->session->userdata('obtained_marks');
        $total_marks = $this->session->userdata('total_marks');
        $ans_array = $this->session->userdata('data');

//        echo '<pre>';print_r($ans_array[$question_order_id]['question_id']);die;
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
        if ($tutorial_ans_info) {
            $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'], true);
            $flag = 2;
        }

        if ($text == $text_1) {
            $ans_is_right = 'correct';
            //echo $text;die;
            if ($_POST['next_question'] == 0) {
                $total_ans = $this->session->userdata('data', $ans_array);

                $data['st_ans'] = json_encode($total_ans);
                $data['st_id'] = $this->session->userdata('user_id');
                $data['module_id'] = $module_id;

                $this->db->insert('tbl_temp_tutorial_mod_ques', $data);
                $dec = $this->decesion_redirect($this->session->userdata('user_id'), $module_id);
                echo $dec;
            } else {
                if ($answer_info != null) {
                    echo $answer_info;
                } else {
                    if ($flag != 2) {
                        echo 2;
                    }
                }
            }
        } else {
            $ans_is_right = 'wrong';
            if ($answer_info != null) {
                echo $answer_info;
            } else {
                if ($flag != 2) {
                    echo 3;
                }
            }
            $question_marks = 0;
        }

        if ($flag == 0) {
            $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);

            $link1 = base_url();
            $total_marks = $total_marks + $question_marks;
            $obtained_marks = $obtained_marks + $question_marks;

            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;

            $ind_ans = array(
                'question_order_id' => $question_info_ai[0]['question_order'],
                'module_type' => $question_info_ai[0]['moduleType'],
                'module_id' => $question_info_ai[0]['module_id'],
                'question_id' => $question_info_ai[0]['question_id'],
                'link' => $link2,
                'ans_is_right' => $ans_is_right
                );
            $ans_array[$question_order_id] = $ind_ans;

            $this->session->set_userdata('data', $ans_array);
            $this->session->set_userdata('obtained_marks', $obtained_marks);
            $this->session->set_userdata('total_marks', $total_marks);
        }
        
        if ($flag == 2) {
            for ($i = 1; $i <= count($temp_table_ans_info); $i++) {
                if ($temp_table_ans_info[$i]['question_order_id'] == $question_order_id) {
                    $temp_table_ans_info[$i]['ans_is_right'] = $ans_is_right;
                }
            }
            $update_value = json_encode($temp_table_ans_info);
            $st_ans['st_ans'] = $update_value;
            $this->Student_model->updateInfo('tbl_temp_tutorial_mod_ques', 'id', $tutorial_ans_info[0]['id'], $st_ans);
        
//            echo 6;
        }
    }

    private function take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1)
    {
        $obtained_marks = $this->session->userdata('obtained_marks');
        $total_marks = $this->session->userdata('total_marks');
 
        $user_id = $this->session->userdata('user_id');
        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_student_answer', $module_id, $user_id);
        
        if (!$obtained_marks) {
            $obtained_marks = 0;
        }
 
        if (!$total_marks) {
            $total_marks = 0;
        }
 
        $ans_array = $this->session->userdata('data');
        $flag = 0;
        if ($tutorial_ans_info) {
            $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'], true);
            $flag = 2;
        }
        // echo '<pre>';echo $flag;die;
       // echo '<pre>';print_r($temp_table_ans_info);die;
        if (!is_array($ans_array)) {
            $ans_array = array();
        }
 
        if ($text == $text_1) {
            $ans_is_right = 'correct';
        } else {
            $ans_is_right = 'wrong';
        }
        if ($flag == 2) {
            for ($i = 1; $i <= count($temp_table_ans_info); $i++) {
                if ($temp_table_ans_info[$i]['question_order_id'] == $question_order_id) {
                    $temp_table_ans_info[$i]['ans_is_right'] = $ans_is_right;
                    $temp_table_ans_info[$i]['student_ans'] = json_encode($text);
                }
            }
            
            $update_value = json_encode($temp_table_ans_info);
            $st_ans['st_ans'] = $update_value;
            $this->Student_model->updateInfo('tbl_student_answer', 'id', $tutorial_ans_info[0]['id'], $st_ans);
            
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
//            die;
            echo 5;
        } else {
            if ($_POST['next_question'] == 0) {
                $this->save_student_answer($module_id, $question_order_id, $text, $text_1);
            } else {
                $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);
                $link1 = base_url();
                $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;

                if ($text != $text_1) {
                    $data['st_id'] = $this->session->userdata('user_id');
                    $data['question_id'] = $question_id;
                    $data['question_order_id'] = $question_order_id;
                    $data['module_id'] = $module_id;
                    $data['error_count'] = 1;
                    
                    $ans_is_right = 'wrong';

                    if ($question_info_ai[0]['moduleType'] == 2) {
                        $this->db->insert('tbl_st_error_ans', $data);
                    }

                    $total_marks = $total_marks + $question_marks;

                    $this->session->set_userdata('total_marks', $total_marks);
                    $this->session->set_userdata('obtained_marks', $obtained_marks);
                } else {
                    $ans_is_right = 'correct';
                    
                    $total_marks = $total_marks + $question_marks;

                    $obtained_marks = $obtained_marks + $question_marks;

                    $this->session->set_userdata('obtained_marks', $obtained_marks);
                    $this->session->set_userdata('total_marks', $total_marks);
                }
                $ind_ans = array(
                        'question_order_id' => $question_info_ai[0]['question_order'],
                        'module_type' => $question_info_ai[0]['moduleType'],
                        'module_id' => $question_info_ai[0]['module_id'],
                        'question_id' => $question_info_ai[0]['question_id'],
                        'link' => $link2,
                        'student_ans' => json_encode($text),
                        'ans_is_right' => $ans_is_right
                    );
//                echo '<pre>';print_r($ind_ans);die;
                $ans_array[$question_order_id] = $ind_ans;
                $this->session->set_userdata('data', $ans_array);
                echo 5;
            }
        }
    }

    public function st_answer_matching()
    {
//        echo '<pre>';print_r($_POST);die;
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

//        echo '<pre>';print_r($text);die;

        $question_marks = $answer_info[0]['questionMarks'];

        $text_1 = $answer_info[0]['answer'];
        $find = array('&nbsp;', '\n', '\t', '\r');
        $repleace = array('', '', '', '');
        $text_1 = strip_tags($text_1);
        $text_1 = str_replace($find, $repleace, $text_1);
        $text_1 = trim($text_1);

        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
        }
    }

    public function st_answer_matching_vocabolary()
    {

        $this->form_validation->set_rules('answer', 'answer', 'required');

        if ($this->form_validation->run() == false) {
            echo 1;
        } else {
            $text = strtolower($this->input->post('answer'));
            $question_id = $this->input->post('question_id');
            $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

            $module_id = $_POST['module_id'];
            // $question_order_id = $_POST['next_question'] - 1;
            $question_order_id = $_POST['current_order'];
            $text_1 = strtolower($answer_info[0]['answer']);

            $question_marks = $answer_info[0]['questionMarks'];

            if ($_POST['module_type'] == 1) {
                $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
            } else {
                $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
            }
        }
    }

    public function st_answer_matching_true_false()
    {
        //echo 111111111;die;
        $this->form_validation->set_rules('answer', 'answer', 'required');
        if ($this->form_validation->run() == false) {
            echo 1;
        } else {
            $text = $this->input->post('answer');
            $question_id = $this->input->post('question_id');

            $module_id = $_POST['module_id'];
            // $question_order_id = $_POST['next_question'] - 1;
            $question_order_id = $_POST['current_order'];
            $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
            $text_1 = $answer_info[0]['answer'];
            $question_marks = $answer_info[0]['questionMarks'];
            if ($_POST['module_type'] == 1) {
                $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
            } else {
                $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
            }
        }
    }

    public function st_answer_matching_multiple_choice()
    {
        //print_r($_POST);die;

        $question_id = $_POST['id'];
        if (!$_POST['answer_reply']) {
            die;
        } else {
            $text_1 = $_POST['answer_reply'];
        }

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $text = $answer_info[0]['answer'];
        $question_marks = $answer_info[0]['questionMarks'];
        $module_id = $_POST['module_id'];
        //$question_order_id = $_POST['next_question'] - 1;
        $question_order_id = $_POST['current_order'];
        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
        }
    }

    public function st_answer_matching_multiple_response()
    {
        $question_id = $_POST['id'];
        if (!$_POST['answer_reply']) {
            die;
        } else {
            $text_1 = $_POST['answer_reply'];
        }

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        //$text = $answer_info[0]['answer'];
        $question_marks = $answer_info[0]['questionMarks'];
        $text = json_decode($answer_info[0]['answer']);
        $result_count = count(array_intersect($text_1, $text));
//echo '<pre>';print_r(count($text_1));die;

        $module_id = $_POST['module_id'];
        // $question_order_id = $_POST['next_question'] - 1;
        $question_order_id = $_POST['current_order'];

        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, count($text), $result_count);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
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

        if ($_POST['module_type'] == 1) {
            //echo 11111111;die;
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, json_encode($answer_info));
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
        }
    }

    public function st_answer_skip()
    {
        //echo '<pre>';print_r($_POST);die;
        $module_id = $_POST['module_id'];
        //$question_order_id = $_POST['next_question'] - 1;
        $question_order_id = $_POST['current_order'];
        $post = $this->input->post();
        $questionId = $this->input->post('id');
        $givenAns = $this->indexQuesAns($post['given_ans']);

        $temp = $this->tutor_model->getInfo('tbl_question', 'id', $questionId);
        //echo '<pre>';print_r($temp);die;
        $question_marks = $temp[0]['questionMarks'];
        $savedAns = $this->indexQuesAns(json_decode($temp[0]['answer']));

        $temp2 = json_decode($temp[0]['questionName']);
        $numOfRows = $temp2->numOfRows;
        $numOfCols = $temp2->numOfCols;
        //echo $numOfRows .' ' . $numOfCols;
        $wrongAnsIndices = [];

        $text = 0;
        $text_1 = 0;
        for ($row = 1; $row <= $numOfRows; $row++) {
            for ($col = 1; $col <= $numOfCols; $col++) {
                if (isset($savedAns[$row][$col])) {
                    $wrongAnsIndices[] = ($savedAns[$row][$col] != $givenAns[$row][$col]) ? $row . '_' . $col : null;
                }
            }
        }

        $wrongAnsIndices = array_filter($wrongAnsIndices);
        if (count($wrongAnsIndices)) {//For False Condition
            $text_1 = 1;
        }

        if ($_POST['module_type'] == 1) {
            //echo $text_1;die;
            $this->take_decesion_1($question_marks, $questionId, $module_id, $question_order_id, $text, $text_1);
        } else {
            $this->take_decesion_2($question_marks, $questionId, $module_id, $question_order_id, $text, $text_1);
        }
    }

    private function save_student_answer($module_id, $question_order_id, $text, $text_1)
    {
        $ans_array = $this->session->userdata('data');
        $obtained_marks = $this->session->userdata('obtained_marks');
        $total_marks = $this->session->userdata('total_marks');
 
        if (!$obtained_marks) {
            $obtained_marks = 0;
        }
 
        if (!$total_marks) {
            $total_marks = 0;
        }
 
        if (!is_array($ans_array)) {
            $ans_array = array();
        }
 
        $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);
        
        
        if ($text == $text_1) {
            $obtained_marks = $obtained_marks + $question_info_ai[0]['questionMarks'];
 
            $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];
 
            $ind_ans = array('question_order_id' => $question_info_ai[0]['question_order'], 'module_type' => $question_info_ai[0]['moduleType'], 'module_id' => $question_info_ai[0]['module_id'], 'question_id' => $question_info_ai[0]['question_id'], 'ans_is_right' => 'correct');
        } else {
            $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];
            $ind_ans = array('question_order_id' => $question_info_ai[0]['question_order'], 'module_type' => $question_info_ai[0]['moduleType'], 'module_id' => $question_info_ai[0]['module_id'], 'question_id' => $question_info_ai[0]['question_id'], 'ans_is_right' => 'wrong');
 
            $data_er['st_id'] = $this->session->userdata('user_id');
            $data_er['question_id'] = $question_info_ai[0]['question_id'];
            $data_er['question_order_id'] = $question_order_id;
            $data_er['module_id'] = $question_info_ai[0]['module_id'];
            $data_er['error_count'] = 1;
 
            $this->db->insert('tbl_st_error_ans', $data_er);
        }
 
        $ans_array[$question_order_id] = $ind_ans;
        $this->session->set_userdata('data', $ans_array);
 
        $total_ans = $this->session->userdata('data', $ans_array);
         
        $time['user_info'] = $this->Student_model->userInfo($this->session->userdata('user_id'));
         //echo '<pre>';print_r($time['user_info']);die;
          
        date_default_timezone_set($time['user_info'][0]['zone_name']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['st_ans'] = json_encode($total_ans);
        $data['st_id'] = $this->session->userdata('user_id');
        $data['module_id'] = $module_id;
        $this->db->insert('tbl_student_answer', $data);
         
        $this->session->unset_userdata('data', $ans_array);
 
        $p_data['originalMark'] = $total_marks;
        $p_data['studentMark'] = $obtained_marks;
        $p_data['student_id'] = $data['st_id'];
        $p_data['module'] = $data['module_id'];
        $p_data['percentage'] = ($obtained_marks * 100) / $total_marks;
        $p_data['moduletype'] = $question_info_ai[0]['moduleType'];
 
        $this->db->insert('tbl_studentprogress', $p_data);
 
        // $this->session->unset_userdata('total_marks');
        // $this->session->unset_userdata('obtained_marks');
 
        $dec = $this->decesion_redirect($data['st_id'], $data['module_id']);
 
        echo $dec;
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

    public function error()
    {
        $module_id = $this->session->userdata('module_id');

        $student_id = $this->session->userdata('user_id');

        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $student_id);
        $data['student_marks'] = $this->Student_model->student_marks($student_id, $module_id);
        $data['data_error'] = $this->session->userdata('error_data');

        // echo '<pre>';print_r($data['student_marks']);die;

        $total_question = json_decode($data['student_marks'][0]['st_ans']);

        $data['total_question'] = count((array) $total_question);

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('error_question_templete/error', $data, true);

        $this->load->view('master_dashboard', $data);
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
    
        $post = $this->input->post();
        $subjectId = $post['subjectId'];
        $chapterId = $post['chapterId'];
        $moduleType = $post['moduleType'];
        $tutorType  = $post['tutorType'];
        $studentGrade = $this->Student_model->studentClass($this->loggedUserId);

        $conditions = array(
            'subject'              => $subjectId,
            'chapter'              => $chapterId,
            'moduleType'           => $moduleType,
            'tbl_module.user_type' => $tutorType,
            'studentGrade'         => $studentGrade,
        );

        $allModule = $this->ModuleModel->allModule(array_filter($conditions));
		// echo '<pre>';print_r($allModule);
        $moduleIdWithWrongAns = array_unique(array_column($data['student_error_ans'], 'module_id'));
        //common module which he/she belongs and answered wrong
        $moduleIdWithWrongAns = array_intersect(array_column($allModule, 'id'), $moduleIdWithWrongAns);
        $moduleRepeatToday    = [];
        $todayDate            = date('Y-m-d');

        //module for repetition
        foreach ($allModule as $module) {
            //if module not exits in wrong ans given list then skip
            if (!in_array($module['id'], $moduleIdWithWrongAns)) {
                continue;
            }

            $temp     = json_decode($module['repetition_days']);
            $sl_dates = count($temp) ? $temp : [];
			// echo '<pre>';print_r($sl_dates);
            foreach ($sl_dates as $sl_date) {
                $repeatDate = explode('_', $sl_date);
                $repeatDate = date('Y-m-d', strtotime($repeatDate[1]));
                if ($repeatDate == $todayDate) {
                    $moduleRepeatToday[] = $module;
                    break;
                }
            }
        }
		// echo '<pre>';print_r($allModule);
		// echo '<pre>';print_r($moduleRepeatToday);die;

        $row = '';
		$row .= '<input type="hidden" id="first_module_id" value="'.$allModule[0]['id'].'">';
        //previously answered wrong, Now these module will repeat
        foreach ($moduleRepeatToday as $wrongAnsGiven) {
            $video_link = json_decode($wrongAnsGiven['video_link']);
            $link       = 'get_tutor_tutorial_module/' . $wrongAnsGiven['id'] . '/1';
            if ($video_link) {
                $link = 'video_link/' . $wrongAnsGiven['id'] . '/' . $wrongAnsGiven['moduleType'];
            }

            $row .= '<tr>';
            $row .= '<td><a onclick="get_permission(' . $wrongAnsGiven['id'] . ')">' . 'Repetition for : [' . $wrongAnsGiven['moduleName'] . ']</a></td>';
            $row .= '<td>' . $wrongAnsGiven['creatorName'] . '</td>';
            $row .= '<td>' . $wrongAnsGiven['trackerName'] . '</td>';
            $row .= '<td>' . $wrongAnsGiven['individualName'] . '</td>';
            $row .= '<td>' . $wrongAnsGiven['subject_name'] . '</td>';
            $row .= '<td>' . $wrongAnsGiven['chapterName'] . '</td>';
            $row .= '</tr>';
        }
        
        
        // if ($data['student_error_ans'] && $moduleType == 2) {
            // foreach ($data['student_error_ans'] as $error_ans) {
                // $row .= '<tr>
                    // <td colspan="6">
                        // <a href="get_tutor_tutorial_module/'.$error_ans['module_id'].'/'.$error_ans['question_order_id'].'" style="font-size: 13px;">
                            // Repetition for [Q-'.$error_ans['question_order_id'].']
                        // </a>
                    // </td>
                // </tr>';
            // }
        // }
        $i = 0;
		
        foreach ($allModule as $module) {
			 $flag = 0;
			if(isset($moduleRepeatToday[$i]['id']) && $moduleRepeatToday[$i]['id'] == $module['id']){
				 $flag = 1;
				
			}
			if($flag != 1){
				$video_link = json_decode($module['video_link']);
				$link = 'get_tutor_tutorial_module/'.$module['id'].'/1';
				if ($video_link) {
					$link = 'video_link/'.$module['id'].'/'.$module['moduleType'];
				}
				
				$row .= '<tr>';
				//$row .= '<td><a href="' . $link .'">' . $module['moduleName'] . '</a></td>';
				$row .= '<td><a onclick="get_permission('.$module['id'].')">' . $module['moduleName'] . '</a></td>';
				$row .= '<td>'.$module['creatorName'].'</td>';
				$row .= '<td>' . $module['trackerName'] . '</td>';
				$row .= '<td>' . $module['individualName'] . '</td>';
				$row .= '<td>' . $module['subject_name'] . '</td>';
				$row .= '<td>' . $module['chapterName'] . '</td>';
				$row .= '</tr>';
				
			}
			$i++;
		
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
    
    public function show_tutorial_result($module) {
        $user_id = $this->session->userdata('user_id');
        $data['module_info'] = $this->tutor_model->getInfo('tbl_module', 'id', $module);
        if($data['module_info'][0]['moduleType'] == 1){
            $get_tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $module, $user_id);
            $tutorial_ans_info = json_decode($get_tutorial_ans_info[0]['st_ans'],TRUE);
            $module_id = $tutorial_ans_info[1]['module_id'];
        }
        else if($data['module_info'][0]['moduleType'] == 2){
            $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_st_error_ans', $module, $user_id);
//            $tutorial_ans_info = json_decode($get_tutorial_ans_info[0]['st_ans'],TRUE);
            $module_id = $tutorial_ans_info[0]['module_id'];
        } else {
            $get_tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_student_answer', $module, $user_id);
            $tutorial_ans_info = json_decode($get_tutorial_ans_info[0]['st_ans'],TRUE);
            $module_id = $tutorial_ans_info[1]['module_id'];
        }
        
//        echo '<pre>';print_r($tutorial_ans_info);die;
        if($tutorial_ans_info) {
            $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $user_id);
            $data['obtained_marks'] = $this->session->userdata('obtained_marks');
            $data['tutorial_ans_info'] = $tutorial_ans_info;
    //        echo '<pre>';print_r($data['obtained_marks']);die;
            $data['module_info'] = $this->tutor_model->getInfo('tbl_module', 'id', $module_id);
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['header'] = '';
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

            $data['maincontent'] = $this->load->view('students/show_module_result', $data, TRUE);
            $this->load->view('master_dashboard', $data);
        } else {
            redirect('error');
        }
        
    }

    /**
     * All chapters of a subject(ajax hit)
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
        $get_std_error_ans = $this->Student_model->getInfo('tbl_st_error_ans', 'st_id', $this->loggedUserId);
//        echo '<pre>';print_r($get_std_error_ans);die;
        if ($get_std_error_ans) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
