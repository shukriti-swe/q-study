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
        $this->load->helper('commonmethods_helper');

        $this->loggedUserId = $this->session->userdata('user_id');

        $user_info = $this->Preview_model->userInfo($user_id);

        if ($user_info[0]['countryCode'] == 'any') {
            // $user_info[0]['zone_name'] = 'Australia/Lord_Howe';
            $user_info[0]['zone_name'] = 'Australia/Sydney';
        }

        $this->site_user_data = array(
            'userType' => $user_type,
            'zone_name' => $user_info[0]['zone_name'],
            'student_grade' => $user_info[0]['student_grade'],
        );
    }

    public function index()
    {

        $data['checkUnavailableProduct'] = $this->db->where('user_id', $this->session->userdata('user_id'))->where('status', 'unavailable')->get('prize_won_users')->num_rows();

        $data['registered_courses']  = $this->Student_model->registeredCourse($this->session->userdata('user_id'));
        $checkCourseEndDate  = $this->Student_model->registeredCourseStatusUpdate($this->session->userdata('user_id'));

        $loggedStudentId  = $this->loggedUserId;

        $all_parents = $this->Student_model->all_assigners_new($loggedStudentId);
        $i = 0;
        $allTutor = array();
        foreach ($all_parents as $row) {
            $ckSchoolCorporateExits = $this->Student_model->ckSchoolCorporateExits('tbl_useraccount', 'SCT_link', $row['SCT_link']);
            if (count($ckSchoolCorporateExits) == 0) {
                $allTutor[] = $row;
            }

            $get_child_info = $this->Student_model->getInfo('tbl_useraccount', 'parent_id', $row['id']);
            if ($get_child_info) {
                $allTutor[$i]['child_info'] = $get_child_info;
            }
            $i++;
        }
        unset($allTutor[0]);
        $data['all_teachers'] = $allTutor;


        $get_involved_school = $this->Student_model->get_sct_enrollment_info($this->session->userdata('user_id'), 4);
        $all_parents = $this->Student_model->all_assigners_new($loggedStudentId);

        $i = 0;
        $allSchoolTutor = array();

        if (count($get_involved_school)) {
            foreach ($all_parents as $row) {
                if ($row['SCT_link'] == $get_involved_school[0]['SCT_link']) {
                    $allSchoolTutor[] = $row;
                }
            }
        }
        //echo "<pre>";print_r($allSchoolTutor);die();

        $data['allSchoolTutors'] = $allSchoolTutor;

        $get_involved_corporate = $this->Student_model->get_sct_enrollment_info($this->session->userdata('user_id'), 5);
        $all_parents = $this->Student_model->all_assigners_new($loggedStudentId);

        $i = 0;
        $allCorporateTutor = array();

        if (count($get_involved_corporate)) {
            foreach ($all_parents as $row) {
                if ($row['SCT_link'] == $get_involved_corporate[0]['SCT_link']) {
                    $allCorporateTutor[] = $row;
                }
            }
        }

        $data['allCorporateTutors'] = $allCorporateTutor;

        $ckWhiteboard  =  $this->Student_model->getAllInfo_classRoom();
        foreach ($ckWhiteboard as $key => $value) {
            $roomInfo = $this->Student_model->getInfo('tbl_classrooms', 'id', $value['id']);
            $url_data = $roomInfo[0]['class_url'];

            $roomInfo = $this->Student_model->deleteInfo('tbl_classrooms', 'id', $value['id']);
            $toUpdate['in_use'] = 0;
            $this->tutor_model->updateInfo('tbl_available_rooms', 'room_id', $url_data, $toUpdate);
        }

        if ($this->session->userdata('userType') == 6) {
            $data['video_help'] = $this->FaqModel->videoSerialize(12, 'video_helps');
            $data['video_help_serial'] = 12;
        }

        $_SESSION['prevUrl'] = base_url('/') . 'student';

        $this->Student_model->deleteInfo('tbl_temp_tutorial_mod_ques', 'st_id', $this->session->userdata('user_id'));

        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        $parent_id = $data['user_info'][0]['parent_id'];
        $payment_details = $this->db->where('user_id', $parent_id)->limit(1)->order_by('id', 'desc')->get('tbl_payment')->row();
        $payment_id = $payment_details->id;
        $payment_courses  = $this->Student_model->paymentCourse($payment_id);
        // print_r($payment_courses);die;
        $st_colaburation = 0;
        foreach ($payment_courses as $pc => $value) {
            $val[$pc] = $value['id'];
            if ($val[$pc] == 44) {
                $st_colaburation = $st_colaburation + 1;
            }
        }
        $data['st_colaburation'] = $st_colaburation;

        $student_colaburation = 0;
        $payCourses = $this->Student_model->payment_list_Courses($parent_id);
        foreach ($payCourses as $payCours => $value) {
            $val[$payCours] = $value['id'];
            if ($val[$payCours] == 44) {
                $student_colaburation = $student_colaburation + 1;
            }
        }
        $data['student_colaburation'] = $student_colaburation;
        //echo "<pre>";print_r($student_colaburation);die();



        $havtutor_2 = array();

        $havtutor = $this->Student_model->getInfo_tutor('tbl_enrollment', 'st_id', $this->session->userdata('user_id'));
        foreach ($havtutor as $key => $value) {
            $havtutor_2[] = $this->Student_model->getInfo('tbl_classrooms', 'tutor_id', $value['sct_id']);
        }

        $links = array();

        foreach ($havtutor_2 as $key => $value) {
            if (count($value)) {
                if ($value[0]['all_student_checked']) {
                    $link[0] = base_url('/yourClassRoom/') . $value[0]['id'];
                    $link[1] = $value[0]['tutor_name'];
                    $links[] = $link;
                    $link = array();
                } else {
                    $x = json_decode($value[0]['students']);
                    foreach ($x as $key => $val) {
                        if ($val == $this->session->userdata('user_id')) {
                            $link[0] = base_url('/yourClassRoom/') . $value[0]['id'];
                            $link[1] = $value[0]['tutor_name'];
                            $links[] = $link;
                            $link = array();
                        }
                    }
                }
            }
        }

        $data['class_rooms'] = $links;


        $user_id = $this->session->userdata('user_id');

        $data['productPoint'] = $this->db->where('user_id', $user_id)->get('product_poinits')->row();


        $data['modulePoint'] = $this->db->where('user_id', $user_id)->get('module_points')->row();
        $modulePoint = $this->db->where('user_id', $user_id)->get('module_points')->row();


        $data['numOfLession'] = $this->db->where('user_id', $user_id)->where('status', 0)->get('daily_modules')->num_rows();
        $point = $this->db->get('tbl_admin_points')->row();

        $target = $this->db->where('user_id', $user_id)->get('target_points')->num_rows();
        // echo $target;die;
        if ($target == 0) {
            $trg['user_id'] = $user_id;
            $trg['target']  = 1;
            $trg['targetPoint']  = $point->target_point;
            $trg['date'] = date('Y-m-d');

            $this->db->insert('target_points', $trg);
        }

        // update tagret
        if ($data['numOfLession'] == 30) {
            $upTarget = $this->db->where('user_id', $user_id)->get('target_points')->row();
            $target = $upTarget->target;
            $upTrg['target'] = $target + 1;
            $percentage = (300 * 10) / 100;
            if ($upTarget->targetPoint < $modulePoint->point) {
                $upTrg['targetPoint'] = $upTarget->targetPoint + $percentage;
            } else {
                $upTrg['targetPoint'] = $upTarget->targetPoint - $percentage;
            }
            $upTrg['date'] = date('Y-m-d');

            $this->db->where('user_id', $user_id)->update('target_points', $upTrg);

            $this->db->where('user_id', $user_id)->update('daily_modules', ['status' => 1]);

            $this->db->where('user_id', $user_id)->update('module_points', ['point' => 0]);
        }

        $data['gradeCheck'] = $this->db->where('user_id', $user_id)->get('student_grade_log')->row();
        $gradeCheck = $this->db->where('user_id', $user_id)->get('student_grade_log')->result_array();
        if (count($gradeCheck) == 0) {
            $user = $this->db->where('id', $user_id)->get('tbl_useraccount')->row();
            $user_grade = $user->student_grade;
            $gData['user_id'] = $user_id;
            $gData['grade']   = $user_grade;
            $this->db->insert('student_grade_log', $gData);
        }


        $data['point'] = $this->db->where('user_id', $user_id)->get('target_points')->row();


        /*==============================================================
                        Student Answer Notification
        ===============================================================*/

        $id = $this->session->userdata('user_id');
        $data['getModuleType'] = $this->Student_model->studentAnswerNotification($id);
        $data['getIdeaInfos'] = $this->Student_model->getStudentIdeaInfo($id);

        foreach($data['getModuleType'] as $key1 => $value1){
            foreach($data['getIdeaInfos'] as $key2 => $value2){
                if($key1 == $key2){
                    $data['getIdeaInfos'][$key2]['modtype'] = $value1['moduleType'];
                }
            }
        }

        //check direct deposit courses
        $checkDirectDepositCourse = $this->Admin_model->getDirectDepositCourse($user_id);
        $checkDirectDepositPendingCourse = $this->Admin_model->getDirectDepositPendingCourse($user_id);

        $data['checkRegisterCourses'] = $this->Admin_model->getActiveCourse($user_id);
        $data['checkDirectDepositCourse'] = $checkDirectDepositCourse;
        $data['checkDirectDepositCourseStatus'] = $checkDirectDepositPendingCourse;

        //echo "<pre>";print_r($data['checkRegisterCourses']);die();
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('students/students_dashboard', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function student_setting()
    {
        $data['video_help'] = $this->FaqModel->videoSerialize(13, 'video_helps');
        $data['video_help_serial'] = 13;

        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        $parent_detail = getParentIDPaymetStatus($data['user_info'][0]['parent_id']);

        if ($parent_detail[0]['subscription_type'] == "direct_deposite") {
            if ($parent_detail[0]['direct_deposite'] == 0) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $data['user_id'] = $this->session->userdata('user_id');
        $data['profile'] = $this->Student_model->get_profile_info($data['user_id']);


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

        $parent_detail = getParentIDPaymetStatus($data['user_info'][0]['parent_id']);

        if ($parent_detail[0]['subscription_type'] == "direct_deposite") {
            if ($parent_detail[0]['direct_deposite'] == 0) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $data['studentRefLink'] = $this->Student_model->getStudentRefLink($this->session->userdata('user_id'));
        $data['student_course'] = $this->Student_model->studentRegisterCourses($this->session->userdata('user_id'), $data['user_info'][0]['subscription_type']);

        // echo "<pre>";print_r($data['student_course']);die();
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

        $data['sms_status_stop'] = $this->input->post('sms_status_stop');
        $this->Student_model->updateInfo('tbl_useraccount', 'id', $this->loggedUserId, $data);
        $this->session->set_flashdata('success_msg', 'Account updated successfully!');
        redirect('student_details');
    }

    public function my_enrollment()
    {
        $data['user_info'] = $this->Student_model->userInfo($this->session->userdata('user_id'));

        $parent_detail = getParentIDPaymetStatus($data['user_info'][0]['parent_id']);

        if ($parent_detail[0]['subscription_type'] == "direct_deposite") {
            if ($parent_detail[0]['direct_deposite'] == 0) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

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

                            $checkCommission = $this->Student_model->getLinkInfo('tbl_tutor_commisions', 'tutorId', 'student_id', $row['id'], $this->session->userdata('user_id'));
                            $tutorId = $row['id'];
                            $tudorDetails = $this->db->where('id', $tutorId)->get('tbl_useraccount')->row();
                            $parentID = $tudorDetails->parent_id;
                            $userType = $tudorDetails->user_type;
                            $school_tutor = 0;
                            if ($parentID != null) {
                                $parentDetails = $this->db->where('id', $parentID)->get('tbl_useraccount')->row();
                                $parentuserType = $parentDetails->user_type;
                                if ($parentuserType == 4) {
                                    $school_tutor = 1;
                                }
                            }
                            if (!$checkCommission && $userType == 3 && $school_tutor == 0) {
                                $data['tutorId'] = $row['id'];
                                $data['amount']  = 10;
                                $data['date']  = date('Y-m-d');
                                $data['student_id'] = $this->session->userdata('user_id');
                                $this->Student_model->insertInfo('tbl_tutor_commisions', $data);
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
        $ref = $post['sct_link'];
        // $tutorInfo = $this->Student_model->search('tbl_useraccount', ['sct_link'=>$ref]);
        // if (!isset($tutorInfo[0]['id'])) {
        //     echo 'Tutor not exists';
        //     return 0;
        // }
        // $tutorId = $tutorInfo[0]['id'];

        $conditions = [
            'st_id' => $this->loggedUserId,
            'sct_id' => $ref,
        ];
        $this->Student_model->delete('tbl_enrollment', $conditions);
        echo $this->db->last_query();
    }

    public function student_upload_photo()
    {
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        $parent_detail = getParentIDPaymetStatus($data['user_info'][0]['parent_id']);

        if ($parent_detail[0]['subscription_type'] == "direct_deposite") {
            if ($parent_detail[0]['direct_deposite'] == 0) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

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

        $parent_detail = getParentIDPaymetStatus($data['user_info'][0]['parent_id']);

        if ($parent_detail[0]['subscription_type'] == "direct_deposite") {
            if ($parent_detail[0]['direct_deposite'] == 0) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('students/student_course/view_course', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function q_study_course()
    {
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        $parent_detail = getParentIDPaymetStatus($data['user_info'][0]['parent_id']);

        if ($parent_detail[0]['subscription_type'] == "direct_deposite") {
            if ($parent_detail[0]['direct_deposite'] == 0) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

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

        $parent_detail = getParentIDPaymetStatus($data['user_info'][0]['parent_id']);

        if ($parent_detail[0]['subscription_type'] == "direct_deposite") {
            if ($parent_detail[0]['direct_deposite'] == 0) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $data['subject_info'] = $this->Student_model->subjectInfo($tutorType);
        $data['tutorType']    = $tutorType;
        $data['moduleType']   = $module_type;

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['studentSubjects'] = $this->Student_model->studentSubjects($this->loggedUserId);

        if ($tutorType == 7) {
            $data['tutorInfo'] = $this->Student_model->getInfo('tbl_useraccount', 'user_type', 7);
            $data['tutorImage'] = isset($data['tutorInfo']) ? $data['tutorInfo'][0]['image'] : '';


            $data['all_subject_qStudy'] = $this->Student_model->get_all_subject($tutorType);

            $data['all_subject_student'] = $this->Student_model->get_all_subject_for_registered_student($this->session->userdata('user_id'));

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
                    $allModuleConditions = ['user_id' => $tutor['id'], 'studentGrade' => $data['user_info'][0]['student_grade'], 'moduleType' => $module_type];

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

                $data['module_info'] = isset($sct_info) ? $sct_info : null;
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

        $parent_detail = getParentIDPaymetStatus($data['user_info'][0]['parent_id']);

        if ($parent_detail[0]['subscription_type'] == "direct_deposite") {
            if ($parent_detail[0]['direct_deposite'] == 0) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

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

        $parent_detail = getParentIDPaymetStatus($data['user_info'][0]['parent_id']);

        if ($parent_detail[0]['subscription_type'] == "direct_deposite") {
            if ($parent_detail[0]['direct_deposite'] == 0) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

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
        redirect('get_tutor_tutorial_module/' . $module_id . '/' . $module_type . '');
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
        
        $start_exam_time_new = time();
        $this->session->set_userdata('start_exam_time_new', $start_exam_time_new);
        $data['order'] = $this->uri->segment('3');
        $_SESSION['q_order'] = $this->uri->segment('3');
        $_SESSION['q_order_module'] = $this->uri->segment('2');

        $data['module_info'] = $this->Student_model->getInfo('tbl_module', 'id', $modle_id);

        $data['user_infos'] = $this->Student_model->get_user_informations($data['user_id']);

        if (!$data['module_info'][0]) {
            show_404();
        }
        $qstudy_module_videos = array();
        if ($data['module_info'][0]['user_type'] == 7) {
            $qstudy_module_videos = $this->ModuleModel->getInfoByOrder('module_instruction_videos_new', 'module_id', $modle_id);
        }
        $data['qstudy_module_videos'] = $qstudy_module_videos;

        $isFirst = 1;

        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        //echo '<pre>';print_r($x);die();
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
        if (
            $data['module_info'][0]['moduleType'] == 1
            || $data['module_info'][0]['moduleType'] == 2
            || $data['module_info'][0]['moduleType'] == 4
        ) {
            date_default_timezone_set($this->site_user_data['zone_name']);
            $exact_time = time();
            $this->session->set_userdata('exact_time', $exact_time);
            // if ($question_order_id == 1) {
            //     $this->session->set_userdata('exam_start', $exact_time);
            // }

            $this->session->set_userdata('exam_start', $exact_time);
        }

        //****** Get Temp table data for Tutorial Module Type ******

        if ($data['module_info'][0]['moduleType'] == 2) {
            $table = 'tbl_student_answer';
        } else {
            $table = 'tbl_temp_tutorial_mod_ques';
        }

        $data['tutorial_ans_info'] = $this->Student_model->getTutorialAnsInfo($table, $modle_id, $data['user_info'][0]['id']);

        $data['question_info_s'] = $this->tutor_model->getModuleQuestion($modle_id, $question_order_id, null);

        //echo "<pre>".$this->db->last_query();print_r($data['question_info_s']);die();
        /*if (!isset($data['question_info_s'][0])) {
            //question not exists
            show_404();
        }*/   
        

        if (!$data['question_info_s'][0]['id']) {
            $question_order_id = $question_order_id + 1;
            redirect('get_tutor_tutorial_module/' . $modle_id . '/' . $question_order_id);
        }
        $data['total_question'] = $this->tutor_model->getModuleQuestion($modle_id, null, 1);
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        //echo "<pre>";print_r($data['total_question']);die();
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        //video link classify
        $moduleVidLinks = json_decode($data['module_info'][0]['video_link']);

        $data['moduleVid'] = count($moduleVidLinks) ? trim($moduleVidLinks[0]) : '';

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


        // echo $data['question_info_s'][0]['question_type'];die();
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
            $questionList = json_decode($data['question_info_s'][0]['questionName'], true);
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
                $title[1] = $questionList['wrongPictureIncrement'][$key];
                $titles[] = $title;
            }

            $title[0] = json_decode($data['question_info_s'][0]['questionName'])->lastpictureSelected;
            $title[1] = "right_ones_xxx";
            $titles[] = $title;
            shuffle($titles);
            $info['picture'] = $titles;

            //paragraph
            $paragraph = json_decode($data['question_info_s'][0]['questionName'], true);
            $paragraph = $paragraph['Paragraph'];

            $info['paragraph'] = $paragraph;

            $wrongParagraphIncrement = array();
            $w = 1;
            foreach ($paragraph as $key => $value) {
                if (isset($value['WrongAnswer'])) {
                    $wrongParagraphIncrement[$key] = $questionList['wrongParagraphIncrement'][$w];
                    $w++;
                }
            }
            $info['wrongParagraphIncrement'] = $wrongParagraphIncrement;

            //picture

            $titles = array();
            $title = array();

            foreach (json_decode($data['question_info_s'][0]['questionName'])->wrongConclution as $key => $value) {
                $title[0] = $value;
                $title[1] = $questionList['wrongConclutionIncrement'][$key];
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
        } elseif ($data['question_info_s'][0]['question_type'] == 14) {

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
            } else {
                // print_r($_SESSION["previous_page"]); die();
                redirect($_SESSION["previous_page"]);
            }
        } elseif ($data['question_info_s'][0]['questionType'] == 15) {
            $data['question_item'] = $data['question_info_s'][0]['questionType'];
            $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['question_info_ind'] = $data['question_info'];
            if (isset($data['question_info_ind']->percentage_array)) {
                $data['ans_count'] = count((array)$data['question_info_ind']->percentage_array);
            } else {
                $data['ans_count'] = 0; 
            }
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_workout_quiz_two', $data, true);
        } elseif ($data['question_info_s'][0]['questionType'] == 16) {
            $data['question_item'] = $data['question_info_s'][0]['questionType'];
            $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['question_info_ind'] = $data['question_info'];



            $question_info_ind = $data['question_info'];
            $pattern_type = $question_info_ind->pattern_type;
            if ($pattern_type == 4) {
                $qus_lefts = $question_info_ind->left_memorize_p_four;
                $qus_rights = $question_info_ind->right_memorize_p_four;

                $qus_array = [];
                foreach ($qus_lefts as $key => $value) {
                    $qus_array[$key]['left'] = $value;
                    $qus_array[$key]['right'] = $qus_rights[$key];
                }
                // shuffle($qus_array);
                $data['qus_array'] = $qus_array;
            }



            if ($pattern_type == 3) {
                $question_step = $question_info_ind->question_step_memorize_p_three;

                $qus_setup_array = [];
                $k = 1;
                $inv = 0;
                foreach ($question_step as $key => $value) {
                    $qus_setup_array[$key]['question_step'] = $value[0];
                    $qus_setup_array[$key]['clue'] = $value[1];
                    $qus_setup_array[$key]['ecplanation'] = $value[2];
                    $qus_setup_array[$key]['answer_status'] = $value[3];
                    if ($value[3] == 0) {
                        $qus_setup_array[$key]['order'] = $k;
                        $k = $k + 1;
                    } else {
                        $qus_setup_array[$key]['order'] = $inv;
                        $inv--;
                    }
                }
                $data['qus_setup_array'] = $qus_setup_array;


                $this->session->set_userdata('question_setup_answer_order', 1);
            }


            if (isset($data['qus_setup_array'])) {

                $question_step_details = $data['qus_setup_array'];

                shuffle($question_step_details);
                $data['question_step_details'] = $question_step_details;
            }
            //echo "<pre>";print_r($data);die();
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_memorization', $data, true);


        }elseif ($data['question_info_s'][0]['questionType'] == 17) {
            $_SESSION['q_order_2'] = $this->uri->segment('3');

            $question_id=$data['question_info_s'][0]['id'];
            $data['idea_info'] = $this->Preview_model->getIdeaInfo('idea_info', $question_id);
            $data['idea_description'] = $this->Preview_model->getIdeaDescription('idea_description', $question_id);
 
            $data['user_id'] = $this->session->userdata('user_id');
            $data['profile'] = $this->Student_model->get_profile_info($data['user_id']);
            $data['student_ideas'] = $this->Student_model->get_student_ideas($question_id,$modle_id);
            $data['tutor_ideas'] = $this->Student_model->get_tutor_ideas($question_id,$modle_id);
            // echo "<pre>";print_r($data['student_ideas']);die(); 
           
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_creative_quiz', $data, true);
        }elseif ($data['question_info_s'][0]['questionType'] == 18) {
            $_SESSION['q_order_2'] = $this->uri->segment('3');

            $data['sentence_questions'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['sentence_answers'] = json_decode($data['question_info_s'][0]['answer']);
            // print_r($data['sentence_answers']);die();
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_sentence_match', $data, true);
        }elseif ($data['question_info_s'][0]['questionType'] == 19) {
            $_SESSION['q_order_2'] = $this->uri->segment('3');

            $data['word_questions'] = json_decode($data['question_info_s'][0]['questionName'], true);
            $data['word_answers'] = json_decode($data['question_info_s'][0]['answer'], true);
            // print_r($data['sentence_answers']);die();
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_word_memorization', $data, true);
            
        }elseif ($data['question_info_s'][0]['questionType'] == 20) {
            $_SESSION['q_order_2'] = $this->uri->segment('3');

            $data['comprehension_questions'] = json_decode($data['question_info_s'][0]['questionName'], true);
            $data['comprehension_answers'] = json_decode($data['question_info_s'][0]['answer'], true);
            // print_r($data['sentence_answers']);die();
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_comprehension', $data, true);
            
        }elseif ($data['question_info_s'][0]['questionType'] == 21) {
            $_SESSION['q_order_2'] = $this->uri->segment('3');

            $data['grammer_questions'] = json_decode($data['question_info_s'][0]['questionName'], true);
            $data['grammer_answers'] = json_decode($data['question_info_s'][0]['answer'], true);
            // print_r($data['sentence_answers']);die();
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_grammer', $data, true);
            
        }
        elseif ($data['question_info_s'][0]['questionType'] == 22) {
            $_SESSION['q_order_2'] = $this->uri->segment('3');

            $data['grammer_questions'] = json_decode($data['question_info_s'][0]['questionName'], true);
            $data['grammer_answers'] = json_decode($data['question_info_s'][0]['answer'], true);
            // print_r($data['sentence_answers']);die();
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_glossary', $data, true);
            
        }
        elseif ($data['question_info_s'][0]['questionType'] == 23) {
            $_SESSION['q_order_2'] = $this->uri->segment('3');

            $data['image_questions'] = json_decode($data['question_info_s'][0]['questionName'], true);
            $data['image_answers'] = json_decode($data['question_info_s'][0]['answer'], true);
            // print_r($data['sentence_answers']);die();
            $data['maincontent'] = $this->load->view('students/question_module_type_tutorial/ans_imageQuiz', $data, true);
            
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
            $row .= '<tr id="' . ($task->serial + 1) . '">';
            $row .= '<td>' . ($task->serial + 1) . '</td>';
            $row .= '<td>' . $task->qMark . '</td>';
            $row .= '<td>' . $task->qMark . '</td>';
            $row .= '<td><a class="qDtlsOpenModIcon"><img src="assets/images/icon_details.png"></a></td>';
            $row .= '<input type="hidden" id="hiddenTaskDesc" value="' . $task->description . '">';
            $row .= '</tr>';
        }

        return $row;
    } //end renderAssignmentTasks()

    public function get_tutor_tutorial_module($modle_id, $question_order_id, $is_every_study = 0)
    {
        // echo "<pre>";print_r($_SESSION);die();

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
        $this->session->unset_userdata('memorize_pattern_pattern_two_student_answer');

        $this->session->unset_userdata('firstleftSerial');
        $this->session->unset_userdata('question_setup_answer_order');

        $this->session->unset_userdata('memorization_three_qus_part_answer');
        $this->session->unset_userdata('memorize_pattern_three_student_answer');
        
        $this->session->unset_userdata('memorize_pattern_four_student_answer');

        $data['user_info'] = $this->Student_model->userInfo($this->session->userdata('user_id'));
        $module_type = $this->tutor_model->get_all_where($select, $table, $columnName, $columnValue);
        // Get Student Ans From tbl_student_answer
        $flag = 0;
        $get_student_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_student_answer', $modle_id, $this->session->userdata('user_id'));
        // echo '<pre>';print_r($module_type[0]['moduleType']);die();
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
                $data = array();
                foreach (json_decode($tbl_module_ans[0]['st_ans']) as $key => $value) {
                    $the_first_start_time_new = time() - $this->session->userdata('start_exam_time_new');
                    $ind_ans = array(
                        'question_order_id' => $value->question_order_id,
                        'module_type' => $value->module_type,
                        'module_id' => $value->module_id,
                        'question_id' => $value->question_id,
                        'link' => $value->link,
                        'student_ans' => $value->student_ans,
                        'workout' => $value->workout,
                        'student_taken_time' => $the_first_start_time_new,
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

            if (isset($x['data_exist_session']) && $x['data_exist_session'] == 1) {
                $tbl_module_ans = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques_two', $modle_id, $this->session->userdata('user_id'));

                if (count($tbl_module_ans)) {
                    $data = array();
                    foreach (json_decode($tbl_module_ans[0]['st_ans']) as $key => $value) {
                        $the_first_start_time_new = time() - $this->session->userdata('start_exam_time_new');
                        $ind_ans = array(
                            'question_order_id' => $value->question_order_id,
                            'module_type' => $value->module_type,
                            'module_id' => $value->module_id,
                            'question_id' => $value->question_id,
                            'link' => $value->link,
                            'student_ans' => $value->student_ans,
                            'workout' => $value->workout,
                            'student_taken_time' => $the_first_start_time_new,
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
            // echo $data['user_info'][0]['zone_name'];die();
            // date_default_timezone_set('Australia/Sydney');
            $module_time = time();

            $date_now = date('Y-m-d');



            if ((strtotime($data['module_info'][0]['exam_start']) < $module_time) && (strtotime($data['module_info'][0]['exam_end']) > $module_time)) {
                $this->openModuleByTutorialBased($modle_id, $question_order_id);
            } elseif ($date_now == trim($data['module_info'][0]['exam_start']) && $data['module_info'][0]['optionalTime'] > 0) {

                $this->openModuleByTutorialBased($modle_id, $question_order_id);
            } elseif (strtotime($data['module_info'][0]['exam_end']) < $module_time && $data['module_info'][0]['optionalTime'] == 0) {

                show_404();
            } else {
                $this->session->set_flashdata('message_name', 'Your exam will start at ' . date('h:i A', strtotime($data['module_info'][0]['exam_start'])));
                redirect('all_tutors_by_type/' . $module_type[0]['user_id'] . '/' . $data['module_info'][0]['moduleType']);
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
            if ($temp == '') {
            } else {
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
            $row .= '<div class="sk_out_box">';
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
                    $row .= '</div>';
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
        if (isset($question_info_pattern->pattern_type)) {
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
            if ($question_info_type == 16) {
                if ($question_info_pattern == 1) {
                    $memorization_answer = $this->input->post('memorization_answer');
                    $memorization_part = $this->input->post('memorization_one_part');
                    if ($memorization_part == 1) {
                        if (isset($_SESSION['memorization_one_part'])) {
                        } else {
                            $this->session->set_userdata('memorization_one_part', 1);
                            $ans_is_right = $memorization_answer;
                        }
                    } elseif ($memorization_part == 2) {
                        if (isset($_SESSION['memorization_two_part'])) {
                        } else {
                            $this->session->set_userdata('memorization_two_part', 2);
                            $ans_is_right = $memorization_answer;
                        }
                    } elseif ($memorization_part == 3) {
                        if (isset($_SESSION['memorization_three_part'])) {
                        } else {
                            $this->session->set_userdata('memorization_three_part', 3);
                            $ans_is_right = $memorization_answer;
                        }
                    }
                } else {
                    $this->session->unset_userdata('memorization_three_part');
                    $this->session->unset_userdata('memorization_two_part');
                    $this->session->unset_userdata('memorization_one_part');
                }
            } else {
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
            if (isset($_POST['student_question_time'])) {
                $student_question_time_add =  $_POST['student_question_time'];
            }
            $the_first_start_time_new = time() - $this->session->userdata('start_exam_time_new');
            $ind_ans = array(
                'question_order_id' => $question_info_ai[0]['question_order'],
                'module_type' => $question_info_ai[0]['moduleType'],
                'module_id' => $question_info_ai[0]['module_id'],
                'question_id' => $question_info_ai[0]['question_id'],
                'link' => $link2,
                'student_ans' => json_encode($student_ans),
                'workout' => isset($_POST['workout']) ? $_POST['workout'] : '',
                'student_taken_time' => $the_first_start_time_new,
                'student_question_marks' => $question_marks,
                'student_marks' => $obtained_marks,
                'ans_is_right' => $ans_is_right
            );
            $ans_array[$question_order_id] = $ind_ans;

            $this->session->set_userdata('data', $ans_array);
            $this->session->set_userdata('obtained_marks', $obtained_marks);
            $this->session->set_userdata('total_marks', $total_marks);

            $ck_tmp_module =  $this->Student_model->get_all_where('id', 'tbl_temp_tutorial_mod_ques_two', 'module_id', $question_info_ai[0]['module_id']);

            if (count($ck_tmp_module)) {
                $insert_data['st_ans'] = json_encode($ans_array);


                $this->Student_model->update_tmp_module_tbl('tbl_temp_tutorial_mod_ques_two', 'module_id', $question_info_ai[0]['module_id'], 'st_id', $this->session->userdata('user_id'), $insert_data);
            } else {
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
            $ck_tmp_module =  $this->Student_model->get_all_where('*', 'tbl_temp_tutorial_mod_ques_two', 'module_id', $module_id);

            $ans_array = json_decode($ck_tmp_module[0]['st_ans']);

            $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);

            $link1 = base_url();

            $obtained_marks = $obtained_marks + $question_marks;
            $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];
            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;
            $student_question_time_add = '';
            if (isset($_POST['student_question_time'])) {
                $student_question_time_add =  $_POST['student_question_time'];
            }

            $the_first_start_time_new = time() - $this->session->userdata('start_exam_time_new');
            $ind_ans = array(
                'question_order_id' => $question_info_ai[0]['question_order'],
                'module_type' => $question_info_ai[0]['moduleType'],
                'module_id' => $question_info_ai[0]['module_id'],
                'question_id' => $question_info_ai[0]['question_id'],
                'link' => $link2,
                'student_ans' => json_encode($student_ans),
                'workout' => isset($_POST['workout']) ? $_POST['workout'] : '',
                'student_taken_time' => $the_first_start_time_new,

                'student_question_marks' => $question_marks,
                'student_marks' => $obtained_marks,
                'ans_is_right' => $ans_is_right
            );

            $ans_array->$question_order_id = $ind_ans;
            $insert_data['st_ans'] = json_encode($ans_array);

            if (!empty($_SESSION['data'])) {
                foreach ($_SESSION['data'] as $key => $value) {

                    if (is_object($_SESSION['data'])) {
                        if (!empty($value->question_order_id)) {
                            if ($value->question_order_id == $ind_ans['question_order_id'] && $value->question_id == $ind_ans['question_id']) {
                                $isset_session_data = 1;
                            }
                        }
                    } else {
                        if (!empty($value['question_order_id'])) {
                            if ($value['question_order_id'] == $ind_ans['question_order_id'] && $value['question_id'] == $ind_ans['question_id']) {
                                $isset_session_data = 1;
                            }
                        }
                    }
                }
            }


            if (!isset($isset_session_data)) {

                // $this->session->set_userdata('data', $ans_array );
                // $this->session->set_userdata('obtained_marks', $obtained_marks);
                // $this->session->set_userdata('total_marks', $total_marks);

                $this->Student_model->update_tmp_module_tbl('tbl_temp_tutorial_mod_ques_two', 'module_id', $question_info_ai[0]['module_id'], 'st_id', $this->session->userdata('user_id'), $insert_data);
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

        if (isset($x['data'])) {
            $this->session->set_userdata('data_exist_session', 1);
            $ck_tmp_module =  $this->Student_model->get_all_where('id', 'tbl_temp_tutorial_mod_ques_two', 'module_id', $question_info_ai[0]['module_id']);

            if (count($ck_tmp_module)) {
                $insert_data['st_ans'] = json_encode($ans_array);
                $insert_data['obtained_marks'] = $_SESSION['obtained_marks'];
                $insert_data['total_marks'] = $_SESSION['total_marks'];


                $this->Student_model->update_tmp_module_tbl('tbl_temp_tutorial_mod_ques_two', 'module_id', $question_info_ai[0]['module_id'], 'st_id', $this->session->userdata('user_id'), $insert_data);
            } else {
                $insert_data['st_ans'] = json_encode($_SESSION['data']);
                $insert_data['module_id'] = $question_info_ai[0]['module_id'];
                $insert_data['st_id'] = $this->session->userdata('user_id');
                $insert_data['obtained_marks'] = $_SESSION['obtained_marks'];
                $insert_data['total_marks'] = $_SESSION['total_marks'];

                $this->Student_model->insertInfo('tbl_temp_tutorial_mod_ques_two', $insert_data);
            }
        } else {
            $this->session->set_userdata('data_exist_session', 0);
        }

        $datass['obtained_marks'] = $_SESSION['obtained_marks'];
        $datass['total_marks'] = $_SESSION['total_marks'];
        $this->Student_model->update_tmp_module_tbl('tbl_temp_tutorial_mod_ques_two', 'module_id', $question_info_ai[0]['module_id'], 'st_id', $this->session->userdata('user_id'), $datass);
    }

    private function take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, $answer_info = null, $next_step_patten_two = null)
    {

        // echo $ans_is_right;die();
        // $this->session->unset_userdata('data');
        //****** Get Temp table data for Tutorial Module Type ******
        $question_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        
        
        $question_info_type = '';
        $question_info_type = $question_info[0]['questionType'];
        $question_info_pattern = '';
        $question_info_pattern = json_decode($question_info[0]['questionName']);
        
        if (isset($question_info_pattern->pattern_type)) {
            $question_info_pattern = $question_info_pattern->pattern_type;
        }
        $user_id = $this->session->userdata('user_id');
        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $module_id, $user_id);
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

            
            if ($question_info_type == 16) {
                if ($question_info_pattern == 1) {
                    $memorization_answer = $this->input->post('memorization_answer');
                    $memorization_part = $this->input->post('memorization_one_part');
                    if ($memorization_part == 1) {
                        if (isset($_SESSION['memorization_one_part'])) {
                        } else {
                            $this->session->set_userdata('memorization_one_part', 1);
                            $ans_is_right = $memorization_answer;
                        }
                    } elseif ($memorization_part == 2) {
                        if (isset($_SESSION['memorization_two_part'])) {
                        } else {
                            $this->session->set_userdata('memorization_two_part', 2);
                            $ans_is_right = $memorization_answer;
                        }
                    } elseif ($memorization_part == 3) {
                        if (isset($_SESSION['memorization_three_part'])) {
                        } else {
                            $this->session->set_userdata('memorization_three_part', 3);
                            $ans_is_right = $memorization_answer;
                        }
                    }
                } elseif ($question_info_pattern == 3) {
                    if ($ans_is_right == 'wrong') {
                        $this->session->set_userdata('memorization_three_qus_part_answer', 'wrong');
                    }
                } else {
                    $this->session->unset_userdata('memorization_three_part');
                    $this->session->unset_userdata('memorization_two_part');
                    $this->session->unset_userdata('memorization_one_part');
                }
            } else {
                $this->session->unset_userdata('memorization_three_part');
                $this->session->unset_userdata('memorization_two_part');
                $this->session->unset_userdata('memorization_one_part');
            }
        }
        
        $student_ans = '';
        if ($this->input->post('answer')) {
            $student_ans = $this->input->post('answer');
        }
        
        if ($question_info_type == 20) {
            if($_POST['answer'] == 'write_ans'){
                $student_ans = $_POST['student_answer'];
            }
        }
        

        if ($tutorial_ans_info) {
            $temp_table_ans_info = json_decode($tutorial_ans_info[0]['st_ans'], true);
            $flag = 2;
        }

        
        if($question_info_type == 17){
            $ans_is_right = 'idea';
            $flag = 0;
            $question_marks=25;

        }


        if ($ans_is_right == 'correct') {
            //   echo $ans_is_right;die;

            if ($answer_info != null) {
                $student_ans = $answer_info;
                echo $answer_info;
            } else {
                //                    if ($flag != 2) {
                echo 2;
                //                    }
            }
        } else if($ans_is_right == 'idea'){
            if ($answer_info != null) {
                $student_ans = $answer_info;
                echo $answer_info;
            } else {

                echo 2;
            }

        }else {
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
        
        // $fp = fopen(FCPATH . 'a.txt', 'a+');
        // fwrite($fp, "flag : $flag; question_info_type: $question_info_type");
        // fclose($fp);
        
        if ($flag == 0) {
            
            $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);
            

            if ($question_info_type == 11) {
                $question_info_ai[0]['questionMarks'] = $question_marks;
                $question_info_ai[0]['question_order'] = $question_order_id;
                $question_info_ai[0]['moduleType'] = $question_info_type;
                $question_info_ai[0]['module_id'] = $module_id;
                $question_info_ai[0]['question_id'] = $question_id;
            }


            if ($question_info_type == 16) {
                $ans_check = $this->session->userdata('memorization_three_qus_part_answer');
                if (isset($ans_check)) {
                    if ($ans_check == 'wrong') {
                        $ans_is_right = 'wrong';
                        $question_marks = 0;
                    }
                }
            }


            $link1 = base_url();

            $obtained_marks = $obtained_marks + $question_marks;
            $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];
            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;
            $student_question_time_add = '';
            if (isset($_POST['student_question_time'])) {
                $student_question_time_add =  $_POST['student_question_time'];
            }
               
            //////////////// echo "<pre>";print_r($ind_ans);die();
            if ($question_info_type == 16) {

                if ($question_info_pattern == 1) {
                    $memorization_part = $this->input->post('memorization_one_part');
                    if ($memorization_part == 1) {
                        if (isset($_SESSION['memorization_one_part'])) {
                        } else {
                            $this->session->set_userdata('memorization_one_part', 1);
                            $student_ans = $this->input->post('word_matching');
                        }
                        $student_ans = $this->input->post('word_matching');
                    } elseif ($memorization_part == 2) {
                        if (isset($_SESSION['memorization_one_part'])) {
                        } else {
                            $this->session->set_userdata('memorization_one_part', 1);
                            $student_ans = $this->input->post('word_matching');
                        }
                        $student_ans = $this->input->post('word_matching');
                    }
                    // $student_ans =$this->input->post('word_matching');
                }


                if ($question_info_pattern == 2) {

                    $student_ansl['student'] = $this->input->post('right_memorize_p_two');
                    $student_ansl['left'] = $this->input->post('left_memorize_p_two');

                    $student_ans = json_encode($student_ansl);

                    $this->session->set_userdata('memorize_pattern_pattern_two_student_answer', $student_ans);

                    // $p = $this->session->userdata('memorize_pattern_pattern_two_student_answer');


                    // $fp = fopen(FCPATH . 'c.txt', 'a+');
                    // fwrite($fp, print_r($p, TRUE));
                    // fclose($fp);
                }

                if ($question_info_pattern == 4) {
                    $student_ansl['student'] = $this->input->post('word_matching');
                    $student_ansl['left'] = $this->input->post('left_memorize_p_four');

                    $student_ans = json_encode($student_ansl);

                    // $fp = fopen(FCPATH . 'b.txt', 'a+');
                    // fwrite($fp, print_r($student_ans, TRUE));
                    // fclose($fp);



                    $this->session->set_userdata('memorize_pattern_four_student_answer', $student_ansl);

                    $pattern_four_data = $this->session->userdata('memorize_pattern_four_student_answer');
                    // $fp = fopen(FCPATH . 'm.txt', 'a+');
                    // fwrite($fp, print_r($pattern_four_data, TRUE));
                    // fclose($fp);


                }
                if ($question_info_pattern == 3) {
                    $pattern_three = array();
                    $pattern_three = $this->session->userdata('memorize_pattern_three_student_answer');
                    $student_ans = unserialize($pattern_three);

                    // $fp = fopen(FCPATH . 'c.txt', 'a+');
                    // fwrite($fp, print_r($student_ans, TRUE));
                    // fclose($fp);


                }

                if ($flag == 0 && $question_info_pattern == 3 && $next_step_patten_two == 0) {
                    $the_first_start_time_new = time() - $this->session->userdata('start_exam_time_new');
                    $ind_ans = array(
                        'question_order_id' => $question_info_ai[0]['question_order'],
                        'module_type' => $question_info_ai[0]['moduleType'],
                        'module_id' => $question_info_ai[0]['module_id'],
                        'question_id' => $question_info_ai[0]['question_id'],
                        'link' => $link2,
                        'student_ans' => ($student_ans),
                        'workout' => isset($_POST['workout']) ? $_POST['workout'] : '',

                        'student_taken_time' => $the_first_start_time_new,
                        'student_question_marks' => $question_marks,
                        'student_marks' => $obtained_marks,
                        'ans_is_right' => $ans_is_right
                    );
                    $ans_array[$question_order_id] = $ind_ans;

                    $this->session->set_userdata('data', $ans_array);
                    $this->session->set_userdata('obtained_marks', $obtained_marks);
                    $this->session->set_userdata('total_marks', $total_marks);
                    $this->session->unset_userdata('memorization_three_qus_part_answer');
                }

                if ($flag == 0 && $question_info_pattern != 3) {
                    $ans_check = $this->session->userdata('memorization_three_qus_part_answer');
                    if (isset($ans_check)) {
                        if ($ans_check == 'wrong') {
                            $ans_is_right = 'wrong';
                            $question_marks = 0;
                        }
                    }
                    $the_first_start_time_new = time() - $this->session->userdata('start_exam_time_new');
                    $ind_ans = array(
                        'question_order_id' => $question_info_ai[0]['question_order'],
                        'module_type' => $question_info_ai[0]['moduleType'],
                        'module_id' => $question_info_ai[0]['module_id'],
                        'question_id' => $question_info_ai[0]['question_id'],
                        'link' => $link2,
                        'student_ans' => ($student_ans),
                        'workout' => isset($_POST['workout']) ? $_POST['workout'] : '',
                        'student_taken_time' => $the_first_start_time_new,
                        'student_question_marks' => $question_marks,
                        'student_marks' => $obtained_marks,
                        'ans_is_right' => $ans_is_right
                    );
                    $ans_array[$question_order_id] = $ind_ans;

                    // echo "<pre>";print_r($ind_ans);die();
                    $this->session->set_userdata('data', $ans_array);
                    $this->session->set_userdata('obtained_marks', $obtained_marks);
                    $this->session->set_userdata('total_marks', $total_marks);
                    $this->session->set_userdata('data', $ans_array);
                    $this->session->set_userdata('obtained_marks', $obtained_marks);
                    $this->session->set_userdata('total_marks', $total_marks);
                }
            } else {
                if ($question_info_type == 15) {
                    $answer_info = $this->Student_model->getInfo('tbl_question', 'id', $question_id);
                    $percentage = $answer_info[0]['questionName'];
                    $percentage = json_decode($percentage);
                    $percentage_array = array();
                    $percentage_ans = array();
                    if (isset($percentage->percentage_array)) {
                        $percentage_array = $percentage->percentage_array;
                    }
                    foreach ($percentage_array as $key => $value) {
                        if (isset($_POST[$key])) {
                            $percentage_ans[$key]['0'] = $_POST[$key];
                            $percentage_ans[$key]['1'] = $value;
                        }
                    }
                    $student_ans = $percentage_ans;
                }
                
                
                $the_first_start_time_new = time() - $this->session->userdata('start_exam_time_new');
                $ind_ans = array(
                    'question_order_id' => $question_info_ai[0]['question_order'],
                    'module_type' => $question_info_ai[0]['moduleType'],
                    'module_id' => $question_info_ai[0]['module_id'],
                    'question_id' => $question_info_ai[0]['question_id'],
                    'link' => $link2,
                    'student_ans' => ($student_ans),
                    'workout' => isset($_POST['workout']) ? $_POST['workout'] : '',
                    'student_taken_time' => $the_first_start_time_new,
                    'student_question_marks' => $question_marks,
                    'student_marks' => $obtained_marks,
                    'ans_is_right' => $ans_is_right
                );
                $ans_array[$question_order_id] = $ind_ans;

                $this->session->set_userdata('data', $ans_array);
                $this->session->set_userdata('obtained_marks', $obtained_marks);
                $this->session->set_userdata('total_marks', $total_marks);
            }
            

            if ($_POST['next_question'] == 0) {
                $total_ans = $this->session->userdata('data', $ans_array);

                $data['st_ans'] = json_encode($total_ans);
                $data['st_id'] = $this->session->userdata('user_id');
                $data['module_id'] = $module_id;

                if (!$tutorial_ans_info) {
                    $this->db->insert('tbl_temp_tutorial_mod_ques', $data);
                }
            }
        }

       

        if ($flag == 1 && $question_info_type == 16) {

            if ($question_info_pattern == 1) {
                $memorization_std_ans = $this->session->userdata('memorization_std_ans');
                $student_ans = json_encode($memorization_std_ans);
            }

            if ($question_info_pattern == 2) {

                $student_ans = $this->session->userdata('memorize_pattern_pattern_two_student_answer');

                // $fp = fopen(FCPATH . 'h.txt', 'a+');
                // fwrite($fp, print_r($student_ans, TRUE));
                // fclose($fp);
            }

            if ($question_info_pattern == 3) {

                $pattern_three = array();

                $pattern_three = $this->session->userdata('memorize_pattern_three_student_answer');

                $student_ans = unserialize($pattern_three);

                // $fp = fopen(FCPATH . 'd.txt', 'a+');
                // fwrite($fp, print_r($student_ans, TRUE));
                // fclose($fp);
            }

            $ans_array[$question_order_id]['student_ans'] = $student_ans;

            $this->session->set_userdata('data', $ans_array);
        }

        if ($flag == 2 && $question_info_type == 16) {


            if ($question_info_pattern == 3) {

                $pattern_three = array();

                $pattern_three = $this->session->userdata('memorize_pattern_three_student_answer');

                $student_ans = unserialize($pattern_three);


            }

            if ($question_info_pattern == 4) {
                    $pattern_four = $this->session->userdata('memorize_pattern_four_student_answer');
                    $student_ans = json_encode($pattern_four);

                }

            $ans_array[$question_order_id]['student_ans'] = $student_ans;

            $this->session->set_userdata('data', $ans_array);
        }


        $show_tutorial_result = $_SESSION['show_tutorial_result'];

        if ($flag == 2  && !empty($show_tutorial_result) && ($show_tutorial_result == 1)) {

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
        if (isset($x['data'])) {
            
            $this->session->set_userdata('data_exist_session', 1);
            $ck_tmp_module =  $this->Student_model->get_all_where_two('id', 'tbl_temp_tutorial_mod_ques_two', 'module_id', $module_id, $_SESSION['user_id']);
            // print_r($ck_tmp_module);die();

            if (count($ck_tmp_module)) {
                $insert_data['st_ans'] = json_encode($ans_array);
                $insert_data['obtained_marks'] = $_SESSION['obtained_marks'];
                $insert_data['total_marks'] = $_SESSION['total_marks'];

                //echo '<pre>';print_r($insert_data);die();

                $this->Student_model->update_tmp_module_tbl('tbl_temp_tutorial_mod_ques_two', 'module_id', $module_id, 'st_id', $this->session->userdata('user_id'), $insert_data);
            } else {
                $insert_data['st_ans'] = json_encode($_SESSION['data']);
                $insert_data['module_id'] = $module_id;
                $insert_data['st_id'] = $this->session->userdata('user_id');
                $insert_data['obtained_marks'] = $_SESSION['obtained_marks'];
                $insert_data['total_marks'] = $_SESSION['total_marks'];

                $this->Student_model->insertInfo('tbl_temp_tutorial_mod_ques_two', $insert_data);
            }
        }
        
    }

    private function take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, $answer_info = null)
    {

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



        if (isset($question_pattern->pattern_type)) {
            $question_info_pattern = $question_pattern->pattern_type;
        }
        $memorization_question_mark = $question_info[0]['questionMarks'];
        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_student_answer', $module_id, $user_id);
        $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);

        if ($question_type == 11) {
            $question_info_ai[0]['questionMarks'] = $question_marks;
            $question_info_ai[0]['question_order'] = $question_order_id;
            $question_info_ai[0]['moduleType'] = 2;
            $question_info_ai[0]['module_id'] = $module_id;
            $question_info_ai[0]['question_id'] = $question_id;
        }


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
            if ($question_type == 16) {
                if ($question_info_pattern == 1) {
                    $memorization_answer = $this->input->post('memorization_answer');
                    $memorization_part = $this->input->post('memorization_one_divider');

                    $memorization_answer_right = '';
                    $memorization_answer_wrong = 'correct';
                    if ($memorization_part == 1) {
                        if (array_key_exists('memorization_one_part', $_SESSION)) {
                        } else {
                            $this->session->set_userdata('memorization_one_part', 1);
                            $memorization_answer_right = $memorization_answer;
                            //echo $memorization_answer_right;
                            if ($memorization_answer_right == 'wrong') {
                                $memorization_answer_wrong = $memorization_answer_right;
                                $this->session->set_userdata('memorization_answer_wrong', $memorization_answer_wrong);
                                //$this->session->set_userdata('memorize_qus_wrong_ans_status_get',$memorization_answer_wrong);//added AS 6/22/21

                            }
                            $this->session->set_userdata('memorization_answer_right', $memorization_answer_right);
                        }
                    } elseif ($memorization_part == 2) {
                        if (array_key_exists('memorization_two_part', $_SESSION)) {
                        } else {
                            $this->session->set_userdata('memorization_two_part', 2);
                            $memorization_answer_right = $memorization_answer;
                            if ($memorization_answer_right == 'wrong') {
                                $memorization_answer_wrong = $memorization_answer_right;
                                $this->session->set_userdata('memorization_answer_wrong', $memorization_answer_wrong);
                                //$this->session->set_userdata('memorize_qus_wrong_ans_status_get',$memorization_answer_wrong);//added AS 6/22/21
                            }
                            $this->session->set_userdata('memorization_answer_right', $memorization_answer_right);
                        }
                    } elseif ($memorization_part == 3) {
                        if (array_key_exists('memorization_three_part', $_SESSION)) {
                        } else {
                            $this->session->set_userdata('memorization_three_part', 3);
                            $memorization_answer_right = $memorization_answer;
                            if ($memorization_answer_right == 'wrong') {
                                $memorization_answer_wrong = $memorization_answer_right;
                                $this->session->set_userdata('memorization_answer_wrong', $memorization_answer_wrong);
                                //$this->session->set_userdata('memorize_qus_wrong_ans_status_get',$memorization_answer_wrong);//added AS 6/22/21
                            }
                            $this->session->set_userdata('memorization_answer_right', $memorization_answer_right);
                            $memorization_obtaine_mark_check = 2;
                        }
                    }
                    if (array_key_exists('memorization_answer_wrong', $_SESSION)) {
                        $memorization_answer_right = $this->session->userdata('memorization_answer_wrong');
                        $this->session->set_userdata('memorization_answer_right', $memorization_answer_right);
                    }
                } else {
                    $this->session->unset_userdata('memorization_three_part');
                    $this->session->unset_userdata('memorization_two_part');
                    $this->session->unset_userdata('memorization_one_part');
                    $this->session->unset_userdata('memorize_qus_wrong_ans_status_get');
                }
            } else {
                $this->session->unset_userdata('memorization_three_part');
                $this->session->unset_userdata('memorization_two_part');
                $this->session->unset_userdata('memorization_one_part');
                $this->session->unset_userdata('memorize_qus_wrong_ans_status_get');
            }
        }


        $student_ans = '';

        if (isset($_POST['answer'])) {
            $student_ans = $_POST['answer'];
        }
        if ($student_ans == '' && isset($_POST['given_ans'])) {
            $student_ans = $_POST['given_ans'];
        }

        if ($ans_is_right == 'correct') {
            if ($answer_info != null && $question_info_ai[0]['moduleType'] == 2) {
                echo $answer_info;
                $student_ans = $answer_info;
            }

            if ($question_type == 11) {
                $question_info_ai[0]['moduleType'] = 2;
            }

            if ($answer_info == null && $question_info_ai[0]['moduleType'] == 2) {
                echo 2;
            }
        } else {
            if ($question_info_ai[0]['moduleType'] == 2) {
                if ($answer_info != null && $question_info_ai[0]['moduleType'] == 2) {
                    echo $answer_info;
                    $student_ans = $answer_info;
                }
                if ($answer_info == null && $question_info_ai[0]['moduleType'] == 2) {
                    echo 3; //echo 'three';
                    if ($question_type == 16) {
                        $memorize_qus_wrong_ans_status_var = 1;
                        $this->session->set_userdata('memorize_qus_wrong_ans_status_get', 'wrong'); //added AS 6/22/21
                    }
                }
            }

            $question_marks = 0;
        }


        $show_tutorial_result = $_SESSION['show_tutorial_result'];

        $my_flag = 10;

        //echo "<br>";echo "<pre>";print_r($flag);die();
        // echo "<pre>";print_r($this->session->userdata('memorization_answer_right'));echo 'Flag: ';echo $flag;die();
        if (($flag == 2 || $flag == 1)  && !empty($show_tutorial_result) && ($show_tutorial_result == 1)) {
            // if (($flag == 2 || $flag == 1)  && !empty($show_tutorial_result) ) { //change for 17/6/21

            foreach ($temp_table_ans_info as $key => $val) {
                if ($temp_table_ans_info[$key]['question_order_id'] == $question_order_id) {
                    $temp_table_ans_info[$key]['ans_is_right'] = $ans_is_right;
                    $temp_table_ans_info[$key]['student_ans'] = json_encode($student_ans);
                }
            }

            $update_value = json_encode($temp_table_ans_info);
            $st_ans['st_ans'] = $update_value;
            //$this->Student_model->updateInfo('tbl_student_answer', 'id', $tutorial_ans_info[0]['id'], $st_ans);

            $count_std_error_ans = $this->Student_model->get_count_std_error_ans($question_order_id, $module_id, $user_id);

            if (isset($count_std_error_ans[0]['error_count']) && $count_std_error_ans[0]['error_count'] == 3) {
                $this->Student_model->delete_st_error_ans($question_order_id, $module_id, $user_id);
                $my_flag = 2;
            } else {
                if ($ans_is_right == 'wrong') {
                    $this->Student_model->update_st_error_ans($question_order_id, $module_id, $user_id);
                    $x =  $this->Student_model->getTutorialAnsInfo_("tbl_st_error_ans", $module_id, $user_id);

                    foreach ($x as $key => $value) {
                        unset($value['id']);
                        $dataToUpdate[] = $value;
                    }

                    if (isset($dataToUpdate)) {
                        $this->Student_model->getTutorialAnsInfo_delete($dataToUpdate, $module_id, $user_id);
                    }
                }
                if ($ans_is_right == 'correct') {
                    $this->Student_model->delete_st_error_ans($question_order_id, $module_id, $user_id);
                    $my_flag = 2;
                }
            }

            if ($question_info_ai[0]['moduleType'] != 2) {
                echo 5;
            }
        }



        if ($flag == 1 && $question_type == 16 && $question_info_pattern == 1) {
            $my_flag = 1;
            $link1 = base_url();
            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;

            if (isset($_POST['student_question_time']) && $_POST['student_question_time'] != '') {
                $student_question_time = $_POST['student_question_time'];
            } else {
                $student_question_time = '';
            }
            if ($question_type == 16) {
                if ($question_info_pattern == 1) {
                    $memorization_std_ans = $this->session->userdata('memorization_std_ans');
                    $student_ans = $memorization_std_ans;
                }
            }

            //echo $this->session->userdata('memorize_qus_wrong_ans_status_get');
            $memorization_answer_right = $this->session->userdata('memorization_answer_right');
            //echo $memorization_answer_right;die();
            if ($memorization_answer_right == 'correct') {
                $obtained_marks = $memorization_question_mark;
            } else {
                $question_marks = 0;
                //$obtained_marks = 0;
            }
            //echo $memorization_answer_right;die();
            if ($memorization_part == 3 && $memorization_obtaine_mark_check == 2) {
                $obtained_marks = $obtained_marks + $question_marks;
            }

            if ($memorization_answer_right == 'correct' && $question_marks == 5) {
                if ($memorization_part == 2 && $memorization_obtaine_mark_check == 1) {
                    $obtained_marks = $question_marks;
                }
            }

            $check_memorize_qus_wrong_ans = $this->session->userdata('memorize_qus_wrong_ans_status_get');

            if (($question_type == 16 && $question_info_ai[0]['moduleType'] == 2) || isset($memorize_qus_wrong_ans_status_var)) {
                if ($check_memorize_qus_wrong_ans == 'wrong') {
                    $question_marks = 0;
                    $obtained_marks = 0;
                    $memorization_answer_right = $check_memorize_qus_wrong_ans;
                }
            }

            $the_first_start_time_new = time() - $this->session->userdata('start_exam_time_new');
            $ind_ans = array(
                'question_order_id' => $question_info_ai[0]['question_order'],
                'module_type' => $question_info_ai[0]['moduleType'],
                'module_id' => $question_info_ai[0]['module_id'],
                'question_id' => $question_info_ai[0]['question_id'],
                'link' => $link2,
                'student_ans' => ($student_ans),
                'workout' => isset($_POST['workout']) ? $_POST['workout'] : '',
                'student_taken_time' => $the_first_start_time_new,        'student_question_marks' => $question_marks,
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
        }
        if ($flag == 0) {

            $my_flag = 0;
            $link1 = base_url();
            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;

            if ($question_type != 16  && $question_info_pattern != 1) {
                $obtained_marks = $obtained_marks + $question_marks;
            }
            if ($question_type == 16  && $question_info_pattern == 4) {
                $obtained_marks = $obtained_marks + $question_marks;
            }

            $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];
            if (isset($_POST['student_question_time']) && $_POST['student_question_time'] != '') {
                $student_question_time = $_POST['student_question_time'];
            } else {
                $student_question_time = '';
            }

            if ($question_type == 15) {
                $answer_info = $this->Student_model->getInfo('tbl_question', 'id', $question_id);
                $percentage = $answer_info[0]['questionName'];
                $percentage = json_decode($percentage);
                $percentage_array = array();
                $percentage_ans = array();
                if (isset($percentage->percentage_array)) {
                    $percentage_array = $percentage->percentage_array;
                }
                foreach ($percentage_array as $key => $value) {
                    if (isset($_POST[$key])) {
                        $percentage_ans[$key]['0'] = $_POST[$key];
                        $percentage_ans[$key]['1'] = $value;
                    }
                }
                $student_ans = $percentage_ans;
            }
            if ($question_type == 16) {

                if ($question_info_pattern == 2) {
                    $pattern_two = array();
                    $left_memorize_p_two = $this->input->post('left_memorize_p_two');
                    $right_memorize_p_two = $this->input->post('right_memorize_p_two');
                    $pattern_two['left_memorize_p_two'] = $left_memorize_p_two;
                    $pattern_two['right_memorize_p_two'] = $right_memorize_p_two;
                    $student_ans = $pattern_two;
                }

                if ($question_info_pattern == 4) {
                    $pattern_four = array();
                    $left_memorize_p_four = $this->input->post('left_memorize_p_four');
                    $right_memorize_p_four = $this->input->post('right_memorize_p_four');
                    $pattern_two['left_memorize_p_four'] = $left_memorize_p_four;
                    $pattern_two['right_memorize_p_four'] = $right_memorize_p_four;
                    //$student_ans = $pattern_four;

                    $student_ans = json_encode($this->session->userdata('correct_answer'));
                }
                if ($question_info_pattern == 3) {
                    $pattern_three = array();
                    $left_memorize_p_two = $this->input->post('left_image_ans');
                    $right_memorize_p_two = $this->input->post('right_image_ans');
                    $pattern_three['left_image_ans'] = $left_memorize_p_two;
                    $pattern_three['right_image_ans'] = $right_memorize_p_two;
                    $student_ans = $pattern_three;
                }
            }
            if ($question_type == 16) {
                if ($question_info_pattern == 1) {
                    $memorization_std_ans = $this->session->userdata('memorization_std_ans');
                    $student_ans = $memorization_std_ans;
                }
            }
            $the_first_start_time_new = time() - $this->session->userdata('start_exam_time_new');
            // echo '<pre>';print_r($obtained_marks);die;
            $ind_ans = array(
                'question_order_id' => $question_info_ai[0]['question_order'],
                'module_type' => $question_info_ai[0]['moduleType'],
                'module_id' => $question_info_ai[0]['module_id'],
                'question_id' => $question_info_ai[0]['question_id'],
                'link' => $link2,
                'student_ans' => ($student_ans),
                'workout' => isset($_POST['workout']) ? $_POST['workout'] : '',
                'student_taken_time' => $the_first_start_time_new,    'student_question_marks' => $question_marks,
                'student_marks' => $obtained_marks,
                'ans_is_right' => $ans_is_right
            );
            // echo '<pre>';print_r($ind_ans);die;
            $ans_array[$question_order_id] = $ind_ans;

            $this->session->set_userdata('data', $ans_array);
            $this->session->set_userdata('obtained_marks', $obtained_marks);
            $this->session->set_userdata('total_marks', $total_marks);
            if ($question_info_ai[0]['moduleType'] != 2) {
                echo 5;
            }
        }


        if ($my_flag == 10) {
            foreach ($temp_table_ans_info as $key => $val) {
                if ($temp_table_ans_info[$key]['question_order_id'] == $question_order_id) {
                    $temp_table_ans_info[$key]['ans_is_right'] = $ans_is_right;
                    $temp_table_ans_info[$key]['student_ans'] = json_encode($student_ans);
                }
            }

            $update_value = json_encode($temp_table_ans_info);
            $st_ans['st_ans'] = $update_value;
            //$this->Student_model->updateInfo('tbl_student_answer', 'id', $tutorial_ans_info[0]['id'], $st_ans);

            $count_std_error_ans = $this->Student_model->get_count_std_error_ans($question_order_id, $module_id, $user_id);

            if (isset($count_std_error_ans[0]['error_count']) && $count_std_error_ans[0]['error_count'] == 3) {
                $this->Student_model->delete_st_error_ans($question_order_id, $module_id, $user_id);
            } else {
                if ($ans_is_right == 'wrong') {
                    $this->Student_model->update_st_error_ans($question_order_id, $module_id, $user_id);
                    $x =  $this->Student_model->getTutorialAnsInfo_("tbl_st_error_ans", $module_id, $user_id);

                    foreach ($x as $key => $value) {
                        unset($value['id']);
                        $dataToUpdate[] = $value;
                    }

                    if (isset($dataToUpdate)) {
                        $this->Student_model->getTutorialAnsInfo_delete($dataToUpdate, $module_id, $user_id);
                    }
                }
                if ($ans_is_right == 'correct') {
                    $this->Student_model->delete_st_error_ans($question_order_id, $module_id, $user_id);
                }
            }

            if ($question_info_ai[0]['moduleType'] != 2) {
                echo 5;
            }
        }


        $x = $_SESSION;


        // echo "<br>";
        // echo $_POST['next_question'] ;echo "<br>";
        // echo "<pre>";print_r($x);die();
        // echo 11; die();
        if ($_POST['next_question'] == 0 && $my_flag != 2) { //new add $my_flag != 2
            date_default_timezone_set($this->site_user_data['zone_name']);
            $end_time = time();
            $this->session->set_userdata('end_time', $end_time);
            $this->save_student_answer($module_id);
        }


        // echo "<br>";
        // echo $_POST['next_question'] ;echo "<br>";
        // echo "<pre>";print_r($x);die();
        // echo 11; die();
        if (isset($x['data'])) {
            $this->session->set_userdata('data_exist_session', 1);
            $ck_tmp_module =  $this->Student_model->get_all_where_two('id', 'tbl_temp_tutorial_mod_ques_two', 'module_id', $module_id, $_SESSION['user_id']);

            if (count($ck_tmp_module)) {
                $insert_data['st_ans'] = json_encode($ans_array);
                $insert_data['obtained_marks'] = $_SESSION['obtained_marks'];
                $insert_data['total_marks'] = $_SESSION['total_marks'];
                // echo "<br>";echo "<pre>";print_r($x['data']);echo "<br>";
                // echo "<pre>";print_r($insert_data);echo "<br>";
                // echo "<pre>";print_r($ck_tmp_module);echo "<br>";
                // die();
                $this->Student_model->update_tmp_module_tbl('tbl_temp_tutorial_mod_ques_two', 'module_id', $question_info_ai[0]['module_id'], 'st_id', $this->session->userdata('user_id'), $insert_data);
            } else {
                $insert_data['st_ans'] = json_encode($_SESSION['data']);
                $insert_data['module_id'] = $question_info_ai[0]['module_id'];
                $insert_data['st_id'] = $this->session->userdata('user_id');
                $insert_data['obtained_marks'] = $_SESSION['obtained_marks'];
                $insert_data['total_marks'] = $_SESSION['total_marks'];

                $this->Student_model->insertInfo('tbl_temp_tutorial_mod_ques_two', $insert_data);
            }
        } else {
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
        if (isset($question_pattern->pattern_type)) {
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
            if ($question_type == 16) {
                if ($question_info_pattern == 1) {
                    $memorization_answer = $this->input->post('memorization_answer');
                    $memorization_part = $this->input->post('memorization_one_divider');
                    $memorization_answer_right = '';
                    if ($memorization_part == 1) {
                        if (isset($_SESSION['memorization_one_part'])) {
                        } else {
                            $this->session->set_userdata('memorization_one_part', 1);
                            $memorization_answer_right = $memorization_answer;
                            $this->session->set_userdata('memorization_answer_right', $memorization_answer_right);
                        }
                    } elseif ($memorization_part == 2) {
                        if (isset($_SESSION['memorization_two_part'])) {
                        } else {
                            $this->session->set_userdata('memorization_two_part', 2);
                            $memorization_answer_right = $memorization_answer;
                            $this->session->set_userdata('memorization_answer_right', $memorization_answer_right);
                        }
                    } elseif ($memorization_part == 3) {
                        if (isset($_SESSION['memorization_three_part'])) {
                        } else {
                            $this->session->set_userdata('memorization_three_part', 3);
                            $memorization_answer_right = $memorization_answer;
                            $this->session->set_userdata('memorization_answer_right', $memorization_answer_right);
                            $memorization_obtaine_mark_check = 2;
                        }
                    }
                } else {
                    $this->session->unset_userdata('memorization_three_part');
                    $this->session->unset_userdata('memorization_two_part');
                    $this->session->unset_userdata('memorization_one_part');
                }
            } else {
                $this->session->unset_userdata('memorization_three_part');
                $this->session->unset_userdata('memorization_two_part');
                $this->session->unset_userdata('memorization_one_part');
            }
        }

        $student_ans = '';

        if (isset($_POST['answer'])) {
            $student_ans = $_POST['answer'];
        }
        if ($student_ans == '' && isset($_POST['given_ans'])) {
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
                }
                if ($answer_info == null && $question_info_ai[0]['moduleType'] == 2) {
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
            if (isset($_POST['student_question_time']) && $_POST['student_question_time'] != '') {
                $student_question_time = $_POST['student_question_time'];
            } else {
                $student_question_time = '';
            }
            if ($question_type == 16) {
                if ($question_info_pattern == 1) {
                    $memorization_std_ans = $this->session->userdata('memorization_std_ans');
                    $student_ans = $memorization_std_ans;
                }
            }
            $memorization_answer_right = $this->session->userdata('memorization_answer_right');
            if ($memorization_answer_right == 'correct') {
                $question_marks = $memorization_question_mark;
                //$obtained_marks = $memorization_question_mark;
            } else {
                $question_marks = 0;
                //$obtained_marks = 0;
            }
            if ($memorization_part == 3 && $memorization_obtaine_mark_check == 2) {
                $obtained_marks = $obtained_marks + $question_marks;
            }
            $the_first_start_time_new = time() - $this->session->userdata('start_exam_time_new');
            $ind_ans = array(
                'question_order_id' => $question_info_ai[0]['question_order'],
                'module_type' => $question_info_ai[0]['moduleType'],
                'module_id' => $question_info_ai[0]['module_id'],
                'question_id' => $question_info_ai[0]['question_id'],
                'link' => $link2,
                'student_ans' => json_encode($student_ans),
                'workout' => isset($_POST['workout']) ? $_POST['workout'] : '',
                'student_taken_time' => $the_first_start_time_new,        'student_question_marks' => $question_marks,
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

            if ($question_type != 16  && $question_info_pattern != 1) {
                $obtained_marks = $obtained_marks + $question_marks;
            }
            //$obtained_marks = $obtained_marks + $question_marks;
            $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];

            if ($question_type == 15) {
                $answer_info = $this->Student_model->getInfo('tbl_question', 'id', $question_id);
                $percentage = $answer_info[0]['questionName'];
                $percentage = json_decode($percentage);
                $percentage_array = array();
                $percentage_ans = array();
                if (isset($percentage->percentage_array)) {
                    $percentage_array = $percentage->percentage_array;
                }
                foreach ($percentage_array as $key => $value) {
                    if (isset($_POST[$key])) {
                        $percentage_ans[$key]['0'] = $_POST[$key];
                        $percentage_ans[$key]['1'] = $value;
                    }
                }
                $student_ans = $percentage_ans;
            }

            if ($question_type == 16) {

                if ($question_info_pattern == 2) {
                    $pattern_two = array();
                    $left_memorize_p_two = $this->input->post('left_memorize_p_two');
                    $right_memorize_p_two = $this->input->post('right_memorize_p_two');
                    $pattern_two['left_memorize_p_two'] = $left_memorize_p_two;
                    $pattern_two['right_memorize_p_two'] = $right_memorize_p_two;
                    $student_ans = $pattern_two;
                } elseif ($question_info_pattern == 3) {
                    $pattern_three = array();
                    $left_memorize_p_two = $this->input->post('left_image_ans');
                    $right_memorize_p_two = $this->input->post('right_image_ans');
                    $pattern_three['left_image_ans'] = $left_memorize_p_two;
                    $pattern_three['right_image_ans'] = $right_memorize_p_two;
                    $student_ans = $pattern_three;
                }
            }
            $the_first_start_time_new = time() - $this->session->userdata('start_exam_time_new');
            $ind_ans = array(
                'question_order_id' => $question_info_ai[0]['question_order'],
                'module_type' => $question_info_ai[0]['moduleType'],
                'module_id' => $question_info_ai[0]['module_id'],
                'question_id' => $question_info_ai[0]['question_id'],
                'link' => $link2,
                'student_ans' => json_encode($student_ans),
                'workout' => isset($_POST['workout']) ? $_POST['workout'] : '',
                'student_taken_time' => $the_first_start_time_new,
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
        // echo "<pre>"; print_r($ans_array);die();
        if ($ans_array != "") {

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
            }

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
            $p_data['date_time'] = date("Y-m-d");

            $tbl_studentprogress_info = $this->Student_model->getWhereThreewoCondition("tbl_studentprogress", "student_id", $this->session->userdata('user_id'), "module", $data['module_id'], "date_time", date("Y-m-d"));

            $moduleDetails  = $this->Student_model->getInfo('tbl_module', 'id', $module_id);
            $moduleCreator = $moduleDetails[0]['user_id'];
            $user_id = $this->session->userdata('user_id');
            //echo "<pre>"; print_r($p_data);die();

            if (count($tbl_studentprogress_info) == 0) {
                $this->db->insert('tbl_studentprogress', $p_data);


                // start added for prize
                $gradeCheck   = $this->db->where('user_id', $user_id)->get('student_grade_log')->row();
                $user         = $this->db->where('id', $user_id)->get('tbl_useraccount')->row();

                $user_grade   = (isset($user->student_grade)) ? $user->student_grade : 0;
                $latest_grade = (isset($gradeCheck->grade)) ? $gradeCheck->grade : 0;

                $per = ($obtained_marks * 100) / $total_marks;
                $point = number_format($per);
                if ($user_grade == $latest_grade &&  $moduleCreator == 2) {

                    $mData['user_id']   = $user_id;
                    $mData['module_id'] = $module_id;
                    $mData['complete_date'] = date('Y-m-d');
                    $mData['percentage'] = $point;
                    $this->db->insert('daily_modules', $mData);

                    $pData['user_id'] = $user_id;
                    $getPointInfo = $this->db->where('user_id', $user_id)->get('module_points')->row();
                    if ($getPointInfo) {
                        $recent_point = $getPointInfo->point;
                        $pData['point'] = $point + $recent_point;
                        //print_r($pData);die;
                        $this->db->where('user_id', $user_id)->update('module_points', $pData);
                    } else {
                        $pData['point'] = $point;
                        $this->db->insert('module_points', $pData);
                    }


                    $getProPoint = $this->db->where('user_id', $user_id)->get('product_poinits')->row();
                    $tr_point = $this->db->where('user_id', $user_id)->get('target_points')->row();
                    $target_point = $tr_point->targetPoint;

                    //$pointCheck  = $this->db->where('user_id',$user_id)->get('product_poinits')->row();

                    if ($getProPoint) {
                        $proPoint['user_id'] = $user_id;
                        $sumPoint = ($getProPoint->recent_point +  $point);

                        if ($sumPoint >= $target_point) {
                            $proPoint['recent_point'] = $target_point;
                            $bnsPoint = ($sumPoint - $target_point);
                            $proPoint['bonus_point']  = $getProPoint->bonus_point + $bnsPoint;
                            $proPoint['total_point']  = $getProPoint->total_point + $point;
                        } else {
                            $proPoint['recent_point'] = $getProPoint->recent_point +  $point;
                            $proPoint['total_point']  = $getProPoint->total_point + $point;
                        }


                        $this->db->where('user_id', $user_id)->update('product_poinits', $proPoint);
                    } else {
                        $proPoint['user_id'] = $user_id;
                        $proPoint['recent_point'] = $point;
                        $proPoint['total_point'] = $point;
                        $this->db->insert('product_poinits', $proPoint);
                    }
                }
            }

            $this->session->unset_userdata('data', $ans_array);

            //      *****  For Send SMS Message to Parents  *****

            if ($get_module_info[0]['isSMS'] == 1) {

                $obtained_marks = number_format((float)$obtained_marks, 2, '.', '');

                $v_hours = floor($student_taken_time / 3600);
                $remain_seconds = $student_taken_time - $v_hours * 3600;
                $v_minutes = floor($remain_seconds / 60);
                $v_seconds = $remain_seconds - $v_minutes * 60;
                $time_hour_minute_sec = $v_hours . " : "  . $v_minutes . " : " . $v_seconds;

                $settins_Api_key = $this->Student_model->getSmsApiKeySettings();
                $settins_sms_messsage = $this->Student_model->get_sms_response_after_module();

                $user_email = $this->session->userdata('user_email');
                //$totProgress = $this->Student_model->getInfo('tbl_studentprogress', 'student_id', $data['st_id']);

                $get_module_info = $this->Student_model->getInfo('tbl_module', 'id', $module_id);
                $course_id = '';
                if ($get_module_info[0]['course_id'] != 0) {
                    $course_id = $get_module_info[0]['course_id'];
                }
                $module_type = $get_module_info[0]['moduleType'];
                $module_user_type = $get_module_info[0]['user_type'];
                $conditions['student_id'] = $data['st_id'];
                $conditions['moduletype'] = $module_type;
                $totProgress = $this->Student_model->studentProgressStd($conditions, $module_user_type, $course_id);

                $avg_mark = 0;
                $totPercentage = 0;
                if (count($totProgress)) {
                    $examAttended = count($totProgress);
                    $tot = 0;
                    foreach ($totProgress as $progress) {
                        if ($progress['studentMark'] == 0) {
                            $percentGained = 0;
                        } else {
                            $percentGained = (float)($progress['studentMark'] / $progress['originalMark']) * 100;
                        }
                        $percentGained = round($percentGained, 2);
                        $totPercentage += $percentGained;
                        //$tot+=$progress['percentage'];
                    }
                    $avg_mark = ($examAttended > 0) ? round((float)($totPercentage / $examAttended), 2) : 0.0;
                    //$avg_mark = round($tot/count($totProgress), 2);
                }
                $courseName = $this->Student_model->getInfo('tbl_course', 'id', $courseId);
                $get_all_module_question = $this->Student_model->getInfo('tbl_modulequestion', 'module_id', $module_id);
                $get_child_parent_info = $this->Student_model->getInfo('tbl_useraccount', 'id', $time['user_info'][0]['parent_id']);

                $register_code_string = $settins_sms_messsage[0]['setting_value'];
                if (!empty($courseName)) {
                    $courseName = $courseName[0]['courseName'];
                    $find = array("{{user_email}}", "{{marks}}", "{{total_marks}}", "{{student_taken_time}}", "{{course_name}}", "{{avg_mark}}");
                    $replace = array($user_email, $obtained_marks, $total_marks, $time_hour_minute_sec, $courseName, $avg_mark);
                } else {
                    //$register_code_string = str_replace('in “course :{{course_name}}”',"",$register_code_string);
                    $register_code_string = str_replace('in “course:{{course_name}}”', "", $register_code_string);
                    $find = array("{{user_email}}", "{{marks}}", "{{total_marks}}", "{{student_taken_time}}", "{{avg_mark}}");
                    $replace = array($user_email, $obtained_marks, $total_marks, $time_hour_minute_sec, $avg_mark);
                }



                $user_id = $this->session->userdata('user_id');
                $today_send_sms = $this->admin_model->get_all_whereTwo("*", "sms_send_to_parent_today", "user_id", $user_id, "date_", date("Y-m-d"));

                if (count($today_send_sms) == 0) {
                    $userDetails = $this->db->where('id', $user_id)->get('tbl_useraccount')->row();
                    if ($userDetails->sms_status_stop == 0 ) {
                        if( $this->session->userdata('is_practice')==0){
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

                        $send_sms['user_id'] = $this->session->userdata('user_id');
                        $send_sms['date_'] = date("Y-m-d");

                        $ck_exist_user = $this->admin_model->get_all_where("*", "sms_send_to_parent_today", "user_id", $this->session->userdata('user_id'));


                        if ($ck_exist_user) {
                            $this->admin_model->updateInfo("sms_send_to_parent_today", "user_id", $this->session->userdata('user_id'), $send_sms);
                        } else {
                            $this->admin_model->insertInfo("sms_send_to_parent_today", $send_sms);
                        }
                    }
                    }
                }
            }
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

        $text = trim(strtolower($this->input->post('answer')));
        $question_id = $this->input->post('question_id');
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

        $module_id = $_POST['module_id'];
        // $question_order_id = $_POST['next_question'] - 1;
        $question_order_id = $_POST['current_order'];
        $text_1 = trim(strtolower($answer_info[0]['answer']));
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

            $text_1 = array();
        }

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

        $question_marks = $answer_info[0]['questionMarks'];
        //$text = $answer_info[0]['answer'];

        // $ans_is_right = 'correct';
        // if ($text != $text_1) {
        //     $ans_is_right = 'wrong';
        // }

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

        if (count($text_1) != count($text)) {
            $ans_is_right = 'wrong';
        }


        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }

    public function st_answer_sentence_matching()
    {
        $question_id = $_POST['id']; 
        $module_id = $_POST['module_id'];
        $question_order_id = $_POST['current_order'];

        $student_answers = $_POST['answer'];
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $question_marks = $answer_info[0]['questionMarks'];
        $question_answers = json_decode($answer_info[0]['answer']);
        //print_r($student_answers);die();
        //echo $student_ans[1];die();
        $ans_set = array();
        $ans_is_right = 'correct';
        foreach($question_answers as $key => $question_answer){
            $ans_with_ques_no = explode(",,", $student_answers[$key]);
            $student_ans = $ans_with_ques_no[0];
            $question_no = $ans_with_ques_no[1];
            $ans_set[$key] = $student_ans;
            if($question_answer==$student_ans){

            }else{
                $ans_is_right = 'wrong';
            }

        }
        $_POST['answer'] = $ans_set;

        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }

    public function st_answer_word_memorization()
    {
        $question_id = $_POST['id']; 
        $module_id = $_POST['module_id'];
        $question_order_id = $_POST['current_order'];

        $student_answers = $_POST['answers'];
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $question_marks = $answer_info[0]['questionMarks'];
        $question_answers = json_decode($answer_info[0]['answer']);
        //print_r($student_answers);die();
        //echo $student_ans[1];die();
        $ans_set = array();
        $ans_is_right = 'correct';
        foreach($question_answers as $key => $question_answer){
            $student_ans = $student_answers[$key];
            $ans_set[$key] = $student_ans;
            //echo $question_answer.'//'.$student_ans;
            if($question_answer==$student_ans){

            }else{
                $ans_is_right = 'wrong';
            }

        }
        //echo $ans_is_right;die();
        //print_r($ans_set);die();
        $_POST['answer'] = $ans_set;

        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }

    public function st_answer_comprehension()
    {
        //echo "<pre>";print_r($_POST);die();
        //echo "hello".$_POST['ans_pattern'];die();
        $ans_patern = $_POST['ans_pattern'];
        
        $question_id = $_POST['id']; 
        $module_id = $_POST['module_id'];
        $question_order_id = $_POST['current_order'];

        $student_answers = $_POST['answer'];
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $question_marks = $answer_info[0]['questionMarks'];
        $question_answers = $answer_info[0]['answer'];
        
        $ans_set = array();
        
        if($student_answers=='write_ans'){
            $ans_is_right = 'correct';
        }else{
            $ans_is_right = 'correct';
            if($student_answers == $question_answers ){

            }else{
                $ans_is_right = 'wrong';
            }

        }

        if($ans_patern == 'skip'){
            $question_marks = 0;
            $ans_is_right = 'correct';
        }

        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }

    public function st_answer_grammer()
    {
        // echo "<pre>";print_r($_POST);die();
        $question_id = $_POST['id']; 
        $module_id = $_POST['module_id'];
        $question_order_id = $_POST['current_order'];

        $student_answers = $_POST['answer'];
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $question_marks = $answer_info[0]['questionMarks'];
        $question_answers = $answer_info[0]['answer'];
        
        $ans_set = array();
        
        
        $ans_is_right = 'correct';
        if($student_answers == $question_answers ){

        }else{
            $ans_is_right = 'wrong';
        }

        // echo $ans_is_right;die();


        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }

    public function st_answer_glossary()
    {
        // echo "<pre>";print_r($_POST);die();
        $question_id = $_POST['id']; 
        $module_id = $_POST['module_id'];
        $question_order_id = $_POST['current_order'];

        $student_answers = $_POST['answer'];
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $question_marks = $answer_info[0]['questionMarks'];
        
        $ans_set = array();
        
        
        $ans_is_right = 'correct';

        // echo $ans_is_right;die();


        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }

    public function st_answer_image_quiz()
    {
        // echo "<pre>";print_r($_POST);die();
        $question_id = $_POST['id']; 
        $module_id = $_POST['module_id'];
        $question_order_id = $_POST['current_order'];

        $student_answers = $_POST['answer'];
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $question_marks = $answer_info[0]['questionMarks'];
        $question_answers = $answer_info[0]['answer'];
        
        $ans_set = array();
        
        
        $ans_is_right = 'correct';
        if($student_answers == $question_answers ){

        }else{
            $ans_is_right = 'wrong';
        }

        // echo $ans_is_right;die();


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

        if (count($text_1) != count($text)) {
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
                        if (isset($givenAns[$row][$col])) {
                            $wrongAnsIndices[] = ($savedAns[$row][$col] != $givenAns[$row][$col]) ? $row . '_' . $col : null;
                        } else {
                            $wrongAnsIndices[] = $row . '_' . $col;
                        }
                    }
                }
            }

            $wrongAnsIndices = array_filter($wrongAnsIndices);
            if (count($wrongAnsIndices)) { //For False Condition
                $text_1 = 1;
            }
        }
        if (strlen(implode($post['given_ans'])) == 0) {
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
        if (count($student_ans) != count($answer_info['tutor_ans'])) {
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

        if (isset($result[0])) {
            $ans_one = $result[0];
        } else {
            $ans_one = $result;
        }

        if (isset($result[1])) {
            $reminder_answer = $result[1];
        } else {
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
        $i = 1;
        foreach ($student_answer as $ans) {
            $object = 'percentage_' . $i;
            if ($ans != $percentage_array->$object) {
                $correct = 0;
            }
            $i++;
        }

        if ($_POST['ansFiled'] != $correct_ans) {
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
        if ($provide_ans == 'correct') {
            $ans_is_right = 'correct';
        } else {
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
        if (isset($questionName->totMarks)) {
            $totMarks = $questionName->totMarks;
        }

        $link1 = base_url();
        $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;
        $obtained_marks = 0;
        $ans_is_right = 'correct';
        $the_first_start_time_new = time() - $this->session->userdata('start_exam_time_new');
        $ind_ans = array(
            'question_order_id' => $question_info_ai[0]['question_order'],
            'module_type' => $question_info_ai[0]['moduleType'],
            'module_id' => $question_info_ai[0]['module_id'],
            'question_id' => $question_info_ai[0]['question_id'],
            'link' => $link2,
            'student_ans' => $answer_info,
            'workout' => $this->input->post('workout'),
            'student_taken_time' => $the_first_start_time_new,
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

    public function all_tutors_by_type($tutor_id, $module_type,$is_practice=0)
    {
        // echo $is_practice."hello";die();

        $_SESSION['show_tutorial_result'] = 0;
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
                //echo "<pre>";print_r($registered_courses);die();
                $studentSubjects = array();
                $studentChapters = array();
                if (count($registered_courses) > 0) {
                    $oreder_s = 0;
                    // echo "<pre>";print_r($registered_courses);die();
                    foreach ($registered_courses as $sub) {

                        $assign_course = $this->Student_model->getInfo('tbl_assign_subject', 'course_id', $sub['id']);
                        $subject_id_by_course = $this->Student_model->getSubjectDetailsBySubject($sub['id'],$module_type);
                        $chapter_id_by_course = $this->Student_model->getChapterDetailsByChapter($sub['id'],$module_type);
                        if (!empty($subject_id_by_course)) {
                            $subjectId = json_decode($assign_course[0]['subject_id']);

                            foreach ($subject_id_by_course as $key => $value) {

                                $sb =  $this->Student_model->getInfo('tbl_subject', 'subject_id', $value);

                                if (!empty($sb)) {
                                    $studentSubjects[$oreder_s]['subject_id'] = $sb[0]['subject_id'];
                                    $studentSubjects[$oreder_s]['subject_name'] = $sb[0]['subject_name'];
                                    $studentSubjects[$oreder_s]['created_by'] = $sb[0]['created_by'];
                                }
                                $oreder_s++;
                            }
                        }
                        if (!empty($chapter_id_by_course)) {

                            foreach ($chapter_id_by_course as $key => $value) {

                                $sb =  $this->Student_model->getInfo('tbl_chapter', 'id', $value);

                                if (!empty($sb)) {
                                    $studentChapters[$oreder_s]['id'] = $sb[0]['id'];
                                    $studentChapters[$oreder_s]['chapterName'] = $sb[0]['chapterName'];
                                    $studentChapters[$oreder_s]['created_by'] = $sb[0]['created_by'];
                                }
                                $oreder_s++;
                            }
                        }
                    }
                }
                $subject_with_course = $studentSubjects;
                $chapter_with_course = $studentChapters;
            }

            // if ($data['tutorInfo'][0]['user_type'] == 3) {
            // $data['studentSubjects'] = $this->Student_model->getInfo('tbl_subject', 'created_by', $tutor_id);
            // }

            if ($data['tutorInfo'][0]['user_type'] == 3) {

                //$subject_with_course = $this->Student_model->get_tutor_subject($tutor_id);
                //$data['studentSubjects'] = $subject_with_course;
                // $data['studentSubjects'] = array_values(array_column($students_all_subject, null, 'subject_id'));
                $subject_with_course = $this->Student_model->getInfo('tbl_subject', 'created_by', $tutor_id);
            }
             $data['studentSubjects'] = $subject_with_course;
             $data['studentChapters'] = $chapter_with_course;
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

        if ($tutor_id == 2) {
            $data['registered_courses'] = $this->Student_model->registeredCourse($this->session->userdata('user_id'));
            //echo $data['registered_courses'][0]['id'].'/////'."<pre>";print_r($data['registered_courses']);die();
            $first_course_subjects = array();
            if (isset($data['registered_courses'][0]['id'])) {
                $first_course = $data['registered_courses'][0]['id'];
                $course_id = $first_course;
                if (isset($course_id) && $course_id != '') {
                    $assign_course = $this->Student_model->getInfo('tbl_assign_subject', 'course_id', $course_id);
                    if (!empty($assign_course)) {
                        $subjectId = json_decode($assign_course[0]['subject_id']);
                        // echo "<pre>";print_r($subjectId);die();
                        $subject_id_by_course = $this->Student_model->getAllSubjectByCourse($first_course,$module_type);
                        // $sb =  $this->Student_model->getInfo_subjects('tbl_subject', 'subject_id', $subjectId);
                        //echo "<pre>";print_r($subject_id_by_course);die();
                        if(!empty($subject_id_by_course)){
                        $sb =  $this->Student_model->getInfo_subjects('tbl_subject', 'subject_id', $subject_id_by_course);
                        }else{
                            $sb = null; 
                        }
                    }
                }
            }

            // shukriti new start == get all subject id
               // echo "<pre>";print_r($data['registered_courses']);die();
               $all_course_id = array();
               if(!empty($data['registered_courses'])){
                foreach($data['registered_courses'] as $course){
                    $all_course_id[] = $course['id'];
                }
                //echo "<pre>";print_r($all_course_id);die();
                $subject_id_by_course = $this->Student_model->getAllSubjectByCourse($all_course_id,$module_type);
                // echo $this->db->last_query(); die();
                
                if(!empty($subject_id_by_course)){
                    $sb =  $this->Student_model->getInfo_subjects('tbl_subject', 'subject_id', $subject_id_by_course);
                }else{
                    $sb = null; 
                }
                // echo "<pre>";print_r($sb);die();
               }
            // shukriti  end 
 
            //if (isset($sb) && $sb != '') {
                $data['first_course_subjects'] = $sb;
                $data['first_course_id'] = $first_course;
                //$data['studentSubjects'] = $sb;
            //}
        }

        if (!empty($_SERVER['HTTP_REFERER'])) {
            if (strpos($_SERVER['HTTP_REFERER'], "/show_tutorial_result/") || strpos($_SERVER['HTTP_REFERER'], "/get_tutor_tutorial_module/")) {
                if (!empty($_SESSION['prevUrl_after_student_finish_buton'])) {
                    $_SESSION['prevUrl'] = $_SESSION['prevUrl_after_student_finish_buton'];
                }
            } else {
                $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
            }
        }
        if(empty($data['first_course_id'])){
            $data['first_course_id']=0;
        }

        // echo "<pre>";print_r($data);die(); 
        //first_course_subjects
       
        $this->session->set_userdata('is_practice', $is_practice); 

        $assignModuleByTutor = array();
        $assignModuleByTutor = $this->ModuleModel->studentHomework($tutor_id, $module_type);
        $data['assignModuleByTutorSubjectID'] = $assignModuleByTutor;
        
        $data['has_back_button'] = 'student';
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('students/module/all_module_list', $data, true);

        $this->load->view('master_dashboard', $data);
    }
    public function studentsModuleByQStudyNew()
    {
        // echo 11; die();
        
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        $parent_id = $data['user_info'][0]['parent_id'];
        $payment_details = $this->db->where('user_id', $this->session->userdata('user_id'))->limit(1)->order_by('id', 'desc')->get('tbl_payment')->row();
        $payment_id = $payment_details->id;
        $payment_courses  = $this->Student_model->paymentCourse($payment_id);

        $posts         = $this->input->post();
        $tutorId      = isset($posts['tutorId']) ? $posts['tutorId'] : '';
        $st_colaburation = 0;


        $payment_courses  = $this->db->where('user_id', $this->session->userdata('user_id'))->where('cost <>', 0)->where('endTime >', time())->get('tbl_registered_course')->result_array();
        //echo "<pre>";print_r($payment_courses);die;

        foreach ($payment_courses as $pc => $value) {
            $val[$pc] = $value['id'];
            if ($val[$pc] == 44) {
                $st_colaburation = $st_colaburation + 1;
            }
        }
        $data['st_colaburation'] = $st_colaburation;

        if ($tutorId == 2) {
            if ($st_colaburation == 1) {
                echo strlen($row) ? $row : 'no module found';
                die;
            }
        }

        if (count($payment_courses) == 0) {
            echo strlen($row) ? $row : 'no module found';
            die;
        }


        $data['student_error_ans'] = $this->Student_model->getInfo('tbl_st_error_ans', 'st_id', $this->session->userdata('user_id'));

        $post         = $this->input->post();
        $subjectId    = isset($post['subjectId']) ? $post['subjectId'] : '';
        $courseId     = isset($post['courseId']) ? $post['courseId'] : '';
        $chapterId    = isset($post['chapterId']) ? $post['chapterId'] : '';
        $moduleType   = isset($post['moduleType']) ? $post['moduleType'] : '';
        //        $tutorType  = isset($post['tutorId']) ? $post['tutorId'] : '';
        $tutorId      = isset($post['tutorId']) ? $post['tutorId'] : '';
        $tutorInfo = $this->Student_model->getInfo('tbl_useraccount', 'id', $tutorId);

        // $studentGrade = $this->Student_model->studentClass($this->loggedUserId);

        $studentGrade_country = $this->Student_model->studentClass($this->loggedUserId);
        $studentGrade = $studentGrade_country[0]['student_grade'];

        if ($tutorId == 2) {
            $student_colaburation = 0;
            $payCourses = $this->Student_model->payment_list_Courses($parent_id);
            foreach ($payCourses as $payCours => $value) {
                $val[$payCours] = $value['id'];
                if ($val[$payCours] == 44) {
                    $student_colaburation = $student_colaburation + 1;
                }
            }
            $data['student_colaburation'] = $student_colaburation;
        }



        if ($student_colaburation == 1) {
            echo strlen($row) ? $row : 'no module found';
            die;
        }
        
        if ($subjectId == 'all') {
            $subjectId = '';
        }

       
        if (isset($tutorInfo[0]['user_type']) && $tutorInfo[0]['user_type'] == 7) { //q-study
            // echo 11; die();
            $conditions = array(
                'subject'              => $subjectId,
                 'course_id'            => $courseId,
                // 'chapter'              => $chapterId,
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
            $data['all_subject_student'] = $this->Student_model->getInfo('tbl_registered_course', 'user_id', $this->session->userdata('user_id'));
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
                // echo "hello1";;die();
                // $all_module = $this->ModuleModel->allModule(array_filter($conditions));
                $all_module = $this->ModuleModel->allModule(array_filter($conditions), $studentGrade_country[0]['country_id']);
            } else {

                $all_module = $this->Student_model->all_module_by_type($tutorInfo[0]['user_type'], $desired_result, $result, $conditions);
            }
            // echo '<pre>';print_r($all_module);die;
            // $data['maincontent'] = $this->load->view('students/qstudy_module/all_tutorial_list', $data, true);
        } else { //module created by general tutor
            // echo 22; die();
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
            $all_module = $this->ModuleModel->allModule(array_filter($conditions), $studentGrade_country[0]['country_id']);
        }
        //echo "ooooooooooook <pre>";print_r($all_module);die();
        // $all_module = $this->ModuleModel->allModule(array_filter($conditions));

        $new_array  = array();
        $sct_info  = array();

        // echo '<pre>';print_r($all_module);die;

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

        // echo '<pre>';print_r($sct_info);die;

        if ($moduleType == 2) {
            //  echo 44; die();
            foreach ($sct_info as $idx => $module) {
                $get_student_ans_by_module = $this->Student_model->student_module_ans_info($this->session->userdata('user_id'), $module['id']);

                if ($this->site_user_data['student_grade'] != $module['studentGrade']) {
                    unset($sct_info[$idx]);
                } elseif ($module['repetition_days']) {
                    $repition_days = json_decode($module['repetition_days']);
   
                    $b = array_map(array($this, 'get_repitition_days'), $repition_days); //array_map("fix1", $repition_days);

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
            // echo 66; die();
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
        // echo 11; die();

        $user_id = $this->session->userdata('user_id');

        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $user_info = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $parent_id = $data['user_info'][0]['parent_id'];
        $payment_details = $this->db->where('user_id', $this->session->userdata('user_id'))->limit(1)->order_by('id', 'desc')->get('tbl_payment')->row();
        $payment_id = $payment_details->id;


        $posts         = $this->input->post();
        $tutorId      = isset($posts['tutorId']) ? $posts['tutorId'] : '';
        //$payment_courses  = $this->Student_model->paymentCourse($payment_id);
        $payment_courses  = $this->db->where('user_id', $user_id)->where('cost <>', 0)->where('endTime >', time())->get('tbl_registered_course')->result_array();
        if ($tutorId == 2) {

            $st_colaburation = 0;
            foreach ($payment_courses as $pc => $value) {
                $val[$pc] = $value['id'];
                if ($val[$pc] == 44) {
                    $st_colaburation = $st_colaburation + 1;
                }
            }
            $data['st_colaburation'] = $st_colaburation;
            //echo $st_colaburation;die();
            if ($st_colaburation == 1) {
                echo strlen($row) ? $row : 'no module found';
                die;
            }
        }


        $data['student_error_ans'] = $this->Student_model->getInfo('tbl_st_error_ans', 'st_id', $this->session->userdata('user_id'));

        $post         = $this->input->post();
        $subjectId    = isset($post['subjectId']) ? $post['subjectId'] : '';
        $chapterId    = isset($post['chapterId']) ? $post['chapterId'] : '';
        $moduleType   = isset($post['moduleType']) ? $post['moduleType'] : '';
        $repetition   = isset($post['repetition']) ? $post['repetition'] : '';
        // echo $moduleType;die;
        //        $tutorType  = isset($post['tutorId']) ? $post['tutorId'] : '';
        $tutorId      = isset($post['tutorId']) ? $post['tutorId'] : '';
        $tutorInfo = $this->Student_model->getInfo('tbl_useraccount', 'id', $tutorId);

        $studentGrade_country = $this->Student_model->studentClass($this->loggedUserId);
        $studentGrade = $studentGrade_country[0]['student_grade'];


        if ($tutorId == 2) {
            $student_colaburation = 0;
            $payCourses = $this->Student_model->payment_list_Courses($parent_id);
            foreach ($payCourses as $payCours => $value) {
                $val[$payCours] = $value['id'];
                if ($val[$payCours] == 44) {
                    $student_colaburation = $student_colaburation + 1;
                }
            }
            $data['student_colaburation'] = $student_colaburation;


            $checkDirectDepositPendingCourse = $this->Admin_model->getDirectDepositPendingCourse($user_id);
            $checkActiveCourse = $this->Admin_model->getActiveCourse($user_id);
            //  echo $checkDirectDepositPendingCourse;die();
            if ($checkDirectDepositPendingCourse > 0 && $checkActiveCourse == 0) {
                echo strlen($row) ? $row : 'no module found';
                die;
            }
        }

        if ($user_info[0]['subscription_type'] == "trial") {
            $createAt = $user_info[0]['created'];
            $this->load->helper('commonmethods_helper');
            $check_trial_days = getTrailDate($createAt, $this->db);
        }
        //echo $days;die();
        if (isset($check_trial_days)) {
            if ($check_trial_days <= 0) {
                if (count($payment_courses) == 0) {
                    echo strlen($row) ? $row : 'no module found';
                    die;
                }
            }
        } else {
            if (count($payment_courses) == 0) {
                echo strlen($row) ? $row : 'no module found';
                die;
            }
        }

        if ($subjectId == 'all') {
            $subjectId = '';
        }

        if (isset($tutorInfo[0]['user_type']) && $tutorInfo[0]['user_type'] == 7) { //q-study
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
            $data['all_subject_student'] = $this->Student_model->getInfo('tbl_registered_course', 'user_id', $this->session->userdata('user_id'));
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
                $all_module = $this->ModuleModel->allModule(array_filter($conditions), $studentGrade_country[0]['country_id']);
            } else {
                $all_module = $this->Student_model->all_module_by_type($tutorInfo[0]['user_type'], $desired_result, $result, $conditions);
            }
            // $data['maincontent'] = $this->load->view('students/qstudy_module/all_tutorial_list', $data, true);
        } else { //module created by general tutor
            $conditions = array(
                'subject'              => $subjectId,
                'chapter'              => $chapterId,
                'moduleType'           => $moduleType,
                // 'tbl_module.user_type' => $tutorType,
                'studentGrade'         => $studentGrade,
                // 'user_id'              => $tutorId,
            );

            $conditions = array_filter($conditions);
            // echo '<pre>';print_r($conditions);die;
            // $all_module = $this->ModuleModel->allModule(array_filter($conditions));
            $all_module = $this->ModuleModel->allModule(array_filter($conditions), $studentGrade_country[0]['country_id']);
            // echo '<pre>';print_r($all_module);die;
            // echo $this->db->last_query();die();
        }

        // $all_module = $this->ModuleModel->allModule(array_filter($conditions));

        $new_array  = array();
        $sct_info  = array();


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

         
        // echo '<pre>';print_r($sct_info);die;
        //here change this condition for tutor assign module get by following assigning structure  Added AS
        if ($moduleType == 1 ||  $moduleType == 2) {
            foreach ($sct_info as $idx => $module) {

                $get_student_ans_by_module = $this->Student_model->student_module_ans_info($this->session->userdata('user_id'), $module['id']);

                if ($this->site_user_data['student_grade'] != $module['studentGrade']) {
                    unset($sct_info[$idx]);
                } elseif (json_decode($module['repetition_days']) != '' && $module['repetition_days'] != 'null') {
                    $repition_days = json_decode($module['repetition_days']);
                    $repet_day = $repition_days;

                    $singel_days = array();
                    $new_repetation_day = array();
                    $didnt_answered_repeted_module = array();


                    if ($repition_days != '' && $get_student_ans_by_module) {
                        $st_ans = json_decode($get_student_ans_by_module[0]['st_ans'], true);

                        if (!in_array('wrong', array_column($st_ans, 'ans_is_right'))) { // search value in the array
                        } else {

                            $moduleCreated =  date("Y-m-d", strtotime($get_student_ans_by_module[0]['created_at']));
                        }

                        $ck_repetation_update =  $this->Student_model->repete_date_module_index_ck($module['id'], $this->session->userdata('user_id'));


                        if (count($ck_repetation_update) == 0) {

                            foreach ($repet_day as $key => $value) {
                                $singel_days[] = explode("_", $value)[0];
                            }
                            foreach ($singel_days as $key => $a) {
                                $new_repetation_day[] = $a . '_' . date('Y-m-d', strtotime($moduleCreated . ' +' . $a . ' days'));
                            }

                            $b = array_map(array($this, 'get_repitition_days'), $new_repetation_day);

                            date_default_timezone_set($this->site_user_data['zone_name']);
                            $today = date('Y-m-d');
                            $didnt_answered_repeted_module = array();

                            foreach ($b as $k => $value) {
                                if ($value <= $today) {
                                    $didnt_answered_repeted_module[] = $new_repetation_day[$k];
                                }
                            }
                        } else {

                            $repition_days = json_decode($ck_repetation_update[0]['repetation'], true);

                            foreach ($repition_days as $key => $value) {
                                $singel_days[] = explode("_", $value)[0];
                            }
                            foreach ($singel_days as $key => $a) {
                                $new_repetation_day[] = $a . '_' . date('Y-m-d', strtotime($moduleCreated . ' +' . $a . ' days'));
                            }
                            $b = array_map(array($this, 'get_repitition_days'), $new_repetation_day);

                            date_default_timezone_set($this->site_user_data['zone_name']);
                            $today = date('Y-m-d');
                            $didnt_answered_repeted_module = array();

                            foreach ($b as $k => $value) {
                                if ($value <= $today) {
                                    $didnt_answered_repeted_module[] = $new_repetation_day[$k];
                                }
                            }
                        }



                        if ((in_array($today, $b) && $get_student_ans_by_module) || count($didnt_answered_repeted_module) > 0) {

                            $get_answer_repeated_module = $this->Student_model->get_answer_repeated_module($this->session->userdata('user_id'), $module['id'], $today);

                            $st_ans = json_decode($get_student_ans_by_module[0]['st_ans'], true);

                            if (!in_array('wrong', array_column($st_ans, 'ans_is_right'))) { // search value in the array
                                unset($sct_info[$idx]);
                            } else { // If wrong ans is available
                                $this->insert_error_question('', $st_ans);
                                $key = array_search($today, $b) + 1;

                                $sct_info[$idx]['is_repeated'] = 1;
                                $sct_info[$idx]['answered_date'] = $moduleCreated;
                                $sct_info[$idx]['required_repeted_module'] = json_encode($didnt_answered_repeted_module);
                            }
                        } elseif ($get_student_ans_by_module) {
                            unset($sct_info[$idx]);
                        }
                    }
                } elseif ((($module['repetition_days'] == '' && $get_student_ans_by_module) || $module['repetition_days'] == 'null')) {
                    unset($sct_info[$idx]);
                }
            }

            // Keep array with same index to match for all type of module
            foreach ($sct_info as $module) {
                $new_array[] = $module;
            }
            // echo "<pre>";print_r($new_array);die();
            if ($repetition != null) {
                $this->show_repetition_module($new_array);
            } else {
                $this->show_all_module($new_array);
            }
        } else {
           // echo "<pre>";print_r($sct_info);die();
            $this->show_all_module($sct_info);
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
        // echo "hello";print_r($allModule);die();
        $is_practice = $this->session->userdata('is_practice');
          
     
        date_default_timezone_set($this->site_user_data['zone_name']);

        //date_default_timezone_set('Australia/Sydney');
        // echo "<pre>"; print_r($allModule);

        $now_time = date('Y-m-d H:i:s');

        $now_time_for_additional = date("Y-m-d", strtotime($now_time));

        // echo $allModule[0]['exam_end'].'<pre>';
        // echo $now_time;//die;

        // if(strtotime($now_time) < strtotime($module['exam_end'])){
        //     echo 123;
        // }
        $count = 0;

        $row = '';
        if ($allModule) {

            if ($allModule[0]['moduleType'] != 3) {
                $row .= '<input type="hidden" id="first_module_id" value="' . $allModule[0]['id'] . '">';
            }

            foreach ($allModule as $module) {
                $now_time_for_additional_2 = date("Y-m-d", strtotime($module['exam_end']));
                if ($module['moduleType'] != 3 || ($module['optionalTime'] == 0 && $module['moduleType'] == 3 && strtotime($now_time) < strtotime($module['exam_end']))) {

                    if ($module['moduleType'] == 3 && $count == 0) {
                        // print_r($module);
                        $row .= '<input type="hidden" id="first_module_id" value="' . $module['id'] . '">';
                        $count++;
                    }
                    $is_repeated = '';
                    if (isset($module['is_repeated']) && $module['is_repeated'] == 1) {
                        $is_repeated = '(Repeated Module)';
                    }

                    $video_link = json_decode($module['video_link']);
                    $link = 'get_tutor_tutorial_module/' . $module['id'] . '/1';
                    /*if ($video_link) {
                        $link = 'video_link/'.$module['id'].'/'.$module['moduleType'];
                    }*/

                    $idea_chk = $this->Student_model->check_student_idea_ans_info($module['id'], $this->session->userdata('user_id'));
                    if($idea_chk==1){
                        $report = '<a style="position:absulate;text-decoration:underline;top:10px;" href="Student/student_idea_ans_report/'.$module['id'].'/'.$this->session->userdata('user_id').'">Report</a>';
                    }else{
                        $report = '';
                    }

                    $row .= '<tr>';
                    //$row .= '<td><a onclick="get_permission('.$module['id'].')" href="' . $link .'">' . $module['moduleName'] . '</a></td>';
                    if (isset($module['is_repeated'])) {

                        $date = date("d/m/Y", strtotime($module['answered_date']));
                        $required_repeted_module = json_decode($module['required_repeted_module'], true);

                        $row .= '<td> <ul> ';
                        foreach ($required_repeted_module as $key => $value) {
                            $pieces = explode("_", $value);
                            $day = $pieces[0];
                            if ($key == 0) {
                               
                                $row .= '<li> <a onclick="get_permission(' . $module['id'] . ')" href="javascript:;"> <span style="color:red;text-decoration: underline;"> Repeted wrong answer </span> <span class="text-muted" > ' . $date . ' </span> <span style="color:blue;" > ( ' . $day . ' Day) </span></a> </li>';
                            } else {
                                $row .= '<li> <a onclick="get_permission(0)" href="javascript:;"> <span style="color:red;text-decoration: underline;"> Repeted wrong answer </span> <span class="text-muted" > ' . $date . ' </span> <span style="color:blue;" > ( ' . $day . ' Day) </span></a> </li>';
                            }
                        }
                        $row .= '</ul> </td>';
                        $row .= '<td>' . $module['trackerName'] . '</td>';
                        $row .= '<td>' . $module['individualName'] . '</td>';
                    } else {
                        $row .= '<td style="position:relative;">'.$report.'<a onclick="get_permission(' . $module['id'] . ')" href="javascript:;">' . $module['moduleName'] . '</a></td>';
                        $row .= '<td>' . $module['trackerName'] . '</td>';
                        $row .= '<td>' . $module['individualName'] . '</td>';
                    }
                    //$row .= '<td style="cursor:pointer;"><a onclick="get_permission('.$module['id'].')">' . $module['moduleName'] . $is_repeated . '</a></td>';
                    // $row .= '<td>'.$module['creatorName'].'</td>';
                    if ($module['moduleType'] == 2 &&  $module['user_id'] == 2) {
                    } else {
                        $row .= '<td>' . $module['subject_name'] . '</td>';
                        $row .= '<td>' . $module['chapterName'] . '</td>';
                    }
                    $row .= '</tr>';
                }
                if ($module['optionalTime'] != 0 && $module['moduleType'] == 3 && ($now_time_for_additional_2 == $now_time_for_additional)) {


                    if ($module['moduleType'] == 3 && $count == 0) {
                        // print_r($module);
                        $row .= '<input type="hidden" id="first_module_id" value="' . $module['id'] . '">';
                        $count++;
                    }

                    // $count++;
                    $is_repeated = '';
                    if (isset($module['is_repeated']) && $module['is_repeated'] == 1) {
                        $is_repeated = '(Repeated Module)';
                    }

                    $video_link = json_decode($module['video_link']);
                    $link = 'get_tutor_tutorial_module/' . $module['id'] . '/1';
                    /*if ($video_link) {
                        $link = 'video_link/'.$module['id'].'/'.$module['moduleType'];
                    }*/
                    

                    $row .= '<tr>';
                    //$row .= '<td><a onclick="get_permission('.$module['id'].')" href="' . $link .'">' . $module['moduleName'] . '</a></td>';
                    $row .= '<td><a onclick="get_permission(' . $module['id'] .')" href="javascript:;">' . $module['moduleName'] . '</a></td>';
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
        echo strlen($row) ? $row : 'no module found';
    }
    public function show_repetition_module($allModule)
    {
        date_default_timezone_set($this->site_user_data['zone_name']);
        $now_time = date('Y-m-d H:i:s');

        $now_time_for_additional = date("Y-m-d", strtotime($now_time));

        // echo $allModule[0]['exam_end'].'<pre>';
        // echo strtotime($now_time);die;
        $count = 0;

        $row = '';
        if ($allModule) {

            if ($allModule[0]['moduleType'] != 3) {
                $row .= '<input type="hidden" id="first_module_id" value="' . $allModule[0]['id'] . '">';
            }

            foreach ($allModule as $module) {
                $now_time_for_additional_2 = date("Y-m-d", strtotime($module['exam_end']));
                if ($module['moduleType'] != 3 || ($module['optionalTime'] == 0 && $module['moduleType'] == 3 && strtotime($now_time) < strtotime($module['exam_end']))) {

                    if ($module['moduleType'] == 3 && $count == 0) {
                        // print_r($module);
                        $row .= '<input type="hidden" id="first_module_id" value="' . $module['id'] . '">';
                        $count++;
                    }
                    $is_repeated = '';
                    if (isset($module['is_repeated']) && $module['is_repeated'] == 1) {
                        $is_repeated = '(Repeated Module)';
                    }

                    $video_link = json_decode($module['video_link']);
                    $link = 'get_tutor_tutorial_module/' . $module['id'] . '/1';
                    /*if ($video_link) {
                        $link = 'video_link/'.$module['id'].'/'.$module['moduleType'];
                    }*/

                    $row .= '<tr>';
                    //$row .= '<td><a onclick="get_permission('.$module['id'].')" href="' . $link .'">' . $module['moduleName'] . '</a></td>';
                    if (isset($module['is_repeated'])) {

                        $date = date("d/m/Y", strtotime($module['answered_date']));
                        $required_repeted_module = json_decode($module['required_repeted_module'], true);

                        $row .= '<td> <ul> ';
                        foreach ($required_repeted_module as $key => $value) {
                            $pieces = explode("_", $value);
                            $day = $pieces[0];
                            if ($key == 0) {
                                $row .= '<li> <a onclick="get_permission(' . $module['id'] . ')" href="javascript:;"> <span style="color:red;text-decoration: underline;"> Repeted wrong answer </span> <span class="text-muted" > ' . $date . ' </span> <span style="color:blue;" > ( ' . $day . ' Day) </span></a> </li>';
                            } else {
                                $row .= '<li> <a onclick="get_permission(0)" href="javascript:;"> <span style="color:red;text-decoration: underline;"> Repeted wrong answer </span> <span class="text-muted" > ' . $date . ' </span> <span style="color:blue;" > ( ' . $day . ' Day) </span></a> </li>';
                            }
                        }
                        $row .= '</ul> </td>';
                        $row .= '<td>' . $module['trackerName'] . '</td>';
                        $row .= '<td>' . $module['individualName'] . '</td>';
                    } else {
                        // $row .= '<td><a onclick="get_permission('.$module['id'].')" href="javascript:;">' . $module['moduleName'] . '</a></td>';
                        // $row .= '<td>' . $module['trackerName'] . '</td>';
                        // $row .= '<td>' . $module['individualName'] . '</td>';
                    }
                    //$row .= '<td style="cursor:pointer;"><a onclick="get_permission('.$module['id'].')">' . $module['moduleName'] . $is_repeated . '</a></td>';
                    // $row .= '<td>'.$module['creatorName'].'</td>';
                    if ($module['moduleType'] == 2 &&  $module['user_id'] == 2) {
                    } else {
                        $row .= '<td>' . $module['subject_name'] . '</td>';
                        $row .= '<td>' . $module['chapterName'] . '</td>';
                    }
                    $row .= '</tr>';
                }
                if ($module['optionalTime'] != 0 && $module['moduleType'] == 3 && ($now_time_for_additional_2 == $now_time_for_additional)) {


                    if ($module['moduleType'] == 3 && $count == 0) {
                        // print_r($module);
                        $row .= '<input type="hidden" id="first_module_id" value="' . $module['id'] . '">';
                        $count++;
                    }

                    // $count++;
                    $is_repeated = '';
                    if (isset($module['is_repeated']) && $module['is_repeated'] == 1) {
                        $is_repeated = '(Repeated Module)';
                    }

                    $video_link = json_decode($module['video_link']);
                    $link = 'get_tutor_tutorial_module/' . $module['id'] . '/1';
                    /*if ($video_link) {
                        $link = 'video_link/'.$module['id'].'/'.$module['moduleType'];
                    }*/

                    $row .= '<tr>';
                    //$row .= '<td><a onclick="get_permission('.$module['id'].')" href="' . $link .'">' . $module['moduleName'] . '</a></td>';
                    $row .= '<td><a onclick="get_permission(' . $module['id'] . ')" href="javascript:;">' . $module['moduleName'] . '</a></td>';
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
        echo strlen($row) ? $row : 'no module found';
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

        echo base_url() . $file;
    }

    public function show_tutorial_result($module)
    {   
        $this->session->unset_userdata('correct_answer');
        $this->session->unset_userdata('memorize_pattern_three_student_answer');
        $this->session->unset_userdata('memorization_three_qus_part_answer');
        $this->session->unset_userdata('question_setup_answer_order');



        $_SESSION['show_tutorial_result'] = 1;
        $records = $_SESSION;
        $question_id = array_column($records['data'], 'question_id');
        $questions =  $this->Student_model->where_in($question_id, 'tbl_question', 'questionType');
        $questionType = array_column($questions, 'questionType');
        $diff_result = array_diff($questionType, [12]);

        if (count($diff_result) == 0) {
            $_SESSION['all_workout_quiz_q'] = 1;
        } else {
            $_SESSION['all_workout_quiz_q'] = 0;
        }

        if (!empty($this->session->userdata('module_id_ASSIGNmodule')) && ($this->session->userdata('module_id_ASSIGNmodule') == $module)) {
            $dta['status'] = 0;
            $this->tutor_model->updateInfo('student_homeworks', 'id', $this->session->userdata('module_id_ASSIGNmoduleID'), $dta);
        }
        
        $user_id = $this->session->userdata('user_id');
        $data['module_info'] = $this->tutor_model->getInfo('tbl_module', 'id', $module);
        $data['obtained_marks'] = $this->Student_model->get_student_progress($user_id, $module);

        // echo "<pre>";print_r($this->session->userdata('obtained_marks'));die;
        if ($data['module_info'][0]['moduleType'] == 2 && $data['module_info'][0]['optionalTime'] != 0 && empty($data['obtained_marks'])) {
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
            $p_data['date_time'] = date("Y-m-d");

            $tbl_studentprogress_info = $this->Student_model->getWhereThreewoCondition("tbl_studentprogress", "student_id", $this->session->userdata('user_id'), "module", $module, "date_time", date("Y-m-d"));



            if (count($tbl_studentprogress_info) == 0) {

                $this->db->insert('tbl_studentprogress', $p_data);

                // end added for prize
            }
            $data['obtained_marks'] = $this->Student_model->get_student_progress($user_id, $module);
        }
       
        if ($data['module_info'][0]['moduleType'] == 1) {
            
            //assignModuleByTutor
            $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $module, $user_id);

            if ($tutorial_ans_info[0]['full_complete'] == 0) {
                $all_time = $_SESSION['data'];

                // $time_taken=0;
                // foreach($all_time as $for_time){ 
                //     $time_taken= $time_taken+$for_time[student_taken_time];
                // }
                $new_times = $this->session->userdata('exact_time');
                $now_timw = time();
                $time_taken = $now_timw - $new_times;
                $std_ans = json_encode($this->session->userdata('data'));
                $obtained_marks = $this->session->userdata('obtained_marks');
                $total_marks = $this->session->userdata('total_marks');
                $student_taken_time = time() - $this->session->userdata('exam_start');
                $all_time = $_SESSION['data'];

                $time_taken = 0;
                foreach ($all_time as $for_time) {
                    // echo $for_time[student_taken_time]."<br>";
                   // $time_taken = $time_taken + $for_time[student_taken_time];
                }
                $the_new_total_taken_time=time()-$this->session->userdata('start_exam_time_new');

                $the_new_total_ans_time=$this->session->userdata('take_ans_time_new');
                
               // echo time()."now".$the_new_total_taken_time."next".$this->session->userdata('start_exam_time_new');
            //    echo 'jjjj'.$the_new_total_ans_time;die();
                

                $p_data['timeTaken'] = $the_new_total_taken_time;
                //$p_data['timeTaken'] = $student_taken_time;
                $p_data['answerTime'] = $the_new_total_ans_time;
                $p_data['originalMark'] = $total_marks;
                $p_data['studentMark'] = $obtained_marks;
                $p_data['student_id'] = $user_id;
                $p_data['module'] = $module;
                $p_data['percentage'] = ($obtained_marks * 100) / $total_marks;
                $p_data['moduletype'] = 1;
                $tbl_studentprogress_id = $this->Student_model->insertId('tbl_studentprogress', $p_data);

                $tbl_std_ans['st_id'] = $user_id;
                $tbl_std_ans['st_ans'] = json_encode($_SESSION['data']);
                $tbl_std_ans['module_id'] = $module;
                $tbl_std_ans['created_at'] = date("Y-m-d H:i:s");
                $tbl_std_ans['tbl_studentprogress_id'] = $tbl_studentprogress_id;

                $this->Student_model->insertId('tbl_student_answer_tutorial', $tbl_std_ans);

                $data['obtained_marks'] = $this->Student_model->get_student_progress($user_id, $module);

                $toUpdate['full_complete'] = 1;
                $this->Student_model->updateInfo('tbl_temp_tutorial_mod_ques', 'id', $tutorial_ans_info[0]['id'], $toUpdate);
            }
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
        // echo '<pre>';print_r($data['module_info']);die;

        $tutorial_ans_info = array();
        if ($data['module_info']) {
            if ($data['module_info'][0]['moduleType'] == 1) {
                $get_tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $module, $user_id);

                $tutorial_ans_info = array();
                if (isset($get_tutorial_ans_info[0])) {
                    $tutorial_ans_info = json_decode($get_tutorial_ans_info[0]['st_ans'], true);
                }

                $data['obtained_marks'] = $this->session->userdata('obtained_marks');
                $data['total_marks'] = $this->session->userdata('total_marks');
            } elseif ($data['module_info'][0]['moduleType'] == 2) {
                $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo_('tbl_st_error_ans', $module, $user_id);

                // $tutorial_ans_info = json_decode($get_tutorial_ans_info[0]['st_ans'],TRUE);
                //echo "<pre>";print_r($tutorial_ans_info);die;
                $module_id = $module;
            } else {
                $get_tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_student_answer', $module, $user_id);
                $tutorial_ans_info = json_decode($get_tutorial_ans_info[0]['st_ans'], true);
            }

            // if($tutorial_ans_info) {
            $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $user_id);

            if ($data['module_info'][0]['moduleType'] == 1) {
                $parent_info = $this->tutor_model->getInfo('tbl_useraccount', 'id', $data['user_info'][0]['parent_id']);
                $settins_sms_status   = $this->admin_model->getSmsType("Template Activate Status");

                if ($settins_sms_status[0]['setting_value']) {
                    $v_hours = floor($student_taken_time / 3600);
                    $remain_seconds = $student_taken_time - ($v_hours * 3600);
                    $v_minutes = floor($remain_seconds / 60);
                    $v_seconds = $remain_seconds - $v_minutes * 60;

                    $time_hour_minute_sec = $v_hours . " : "  . $v_minutes . " : " . $v_seconds;

                    $data['time_hour_minute_sec'] = $time_hour_minute_sec;
                    $data['parent_info']          = $parent_info[0]['user_mobile'];
                }
            }
            if (($module_info[0]['moduleType'] == 2 && !$tutorial_ans_info) ||
                ($module_info[0]['moduleType'] == 1 && $flag != 1) || $module_info[0]['moduleType'] == 3 || $module_info[0]['moduleType'] == 4
            ) {
            }
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

    public function sms_to_parent()
    {
        $user_id = $this->session->userdata('user_id');
        $today_send_sms = $this->admin_model->get_all_whereTwo("*", "sms_send_to_parent_today", "user_id", $user_id, "date_", date("Y-m-d"));

        if (count($today_send_sms) == 0) {
            $userDetails = $this->db->where('id', $user_id)->get('tbl_useraccount')->row();
            if ($userDetails->sms_status_stop == 0) {

                if ($_POST['module_info'] == 1 &&  $_POST['sendToParent'] == 1) {
                    $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
                    $settins_sms_messsage = $this->admin_model->getSmsType("tutorial exam sms to parents");

                    $obtained = number_format((float)($_POST['obtain_marks'] * 100) / $_POST['originalMark'], 2, '.', '');

                    $register_code_string = $settins_sms_messsage[0]['setting_value'];
                    $message = str_replace("{{ student_name }}", $_POST['user_email'], $register_code_string);
                    $message = str_replace("{{ marks }}", $_POST['obtain_marks'], $message);
                    $message = str_replace("{{ total_marks }}", $_POST['originalMark'], $message);
                    $message = str_replace("{{ total_time }}", $_POST['time_hour_minute_sec'], $message);
                    $message = str_replace("{{ mark_persent }}", $obtained, $message);

                    $api_key = $settins_Api_key[0]['setting_value'];
                    $content = urlencode($message);

                    $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $_POST['parent_mobile'] . "&content=$content";

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

                    $data['user_id'] = $this->session->userdata('user_id');
                    $data['date_'] = date("Y-m-d");

                    $ck_exist_user = $this->admin_model->get_all_where("*", "sms_send_to_parent_today", "user_id", $this->session->userdata('user_id'));

                    if ($ck_exist_user) {
                        $this->admin_model->updateInfo("sms_send_to_parent_today", "user_id", $this->session->userdata('user_id'), $data);
                    } else {
                        $this->admin_model->insertInfo("sms_send_to_parent_today", $data);
                    }
                }
            }
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
        $row = '<option value="">Select Chapter</option>';
        foreach ($chapters as $chapter) {
            $row .= '<option value="' . $chapter['id'] . '">' . $chapter['chapterName'] . '</option>';
        }
        echo $row;
    }

    public function get_permission()
    {
        // print_r($_SERVER);
        $check_url =  $_SERVER['HTTP_REFERER'];
        $word = "all_tutors_by_type";
        
        if(strpos($check_url, $word) !== false){
            $this->session->set_userdata('set_url_module_list', $check_url);
        }


        $ans_time_new = time();
        $this->session->set_userdata('take_ans_time_new', $ans_time_new);
        //echo $The_new_ans_time;

        $start_exam_time_new = time(); 
        $this->session->set_userdata('start_exam_time_new', $start_exam_time_new);
        //assignModuleByTutor 
        if (isset($_POST['assignModule'])  && !empty($_POST['assignModule'])) {
            $name_data['module_id_ASSIGNmodule'] = $this->input->post('module_id');
            $name_data['module_id_ASSIGNmoduleID'] = $this->input->post('id');
            $this->session->set_userdata($name_data);
        }


        $module_id = $this->input->post('module_id');
        $get_student_ans_by_module = $this->Student_model->student_module_ans_info($this->session->userdata('user_id'), $module_id);
        $get_student_error_ans_info = $this->Student_model->student_error_ans_info($this->session->userdata('user_id'), $module_id);
        $module = $this->Student_model->getInfo('tbl_module', 'id', $module_id);

        $link = '';
        $b = [];


        // First check module's repitition availability
        // IF match with repeated date and data found in student ans table
        // Do insert on st_error_ans
        if ($module[0]['moduleType'] != 1 && $module[0]['repetition_days'] && $module[0]['repetition_days'] != 'null') {

            if($module[0]['moduleType']==2){
                $this->session->set_userdata('set_tutor_id', 1);

            }
            // $studentProgress = $this->Student_model->studentEverydayProgree($this->session->userdata('user_id'),2);
            // if($studentProgress > 0){
            //     echo 3;die();
            // }
            $ck_repetation_update =  $this->Student_model->repete_date_module_index_ck($module_id, $this->session->userdata('user_id'));
            if (count($ck_repetation_update) > 0) {

                $moduleCreated =  date("Y-m-d", strtotime($get_student_ans_by_module[0]['created_at']));
                $repition_days = strlen($ck_repetation_update[0]['repetation']) ? json_decode($ck_repetation_update[0]['repetation']) : [1, 2, 3];
                foreach ($repition_days as $key => $value) {
                    $singel_days[] = explode("_", $value)[0];
                }
                foreach ($singel_days as $key => $a) {
                    if ($key != 0) {
                        $new_repetation_day[] = $a . '_' . date('Y-m-d', strtotime($moduleCreated . ' +' . $a . ' days'));
                    }
                }
            } else {

                $studentProgress = $this->Student_model->studentEverydayProgree($this->session->userdata('user_id'), 2);
                if ($studentProgress > 0) {
                    echo 3;
                    die();
                }
                // echo $studentProgress;die();
                $daily_modules = $this->db->where('user_id', $this->session->userdata('user_id'))->where('complete_date', date('Y-m-d'))->get('daily_modules')->row();
                if ($daily_modules) {
                    echo 3;
                    die();
                }

                $repition_days = strlen($module[0]['repetition_days']) ? json_decode($module[0]['repetition_days']) : [1, 2, 3];

                if (count($get_student_ans_by_module)) {
                    $moduleCreated =  date("Y-m-d", strtotime($get_student_ans_by_module[0]['created_at']));
                    foreach ($repition_days as $key => $value) {
                        $singel_days[] = explode("_", $value)[0];
                    }
                    foreach ($singel_days as $key => $a) {
                        $new_repetation_day[] = $a . '_' . date('Y-m-d', strtotime($moduleCreated . ' +' . $a . ' days'));
                    }
                }
            }

            function fix($n)
            {
                if ($n) {
                    $val = (explode('_', $n));
                    return $val[1];
                }
            }

            $repition_days_ = isset($new_repetation_day) ? $new_repetation_day : $repition_days;

            $b = array_map("fix", $repition_days_);
            $b = count($b) ? $b : [];

            date_default_timezone_set($this->site_user_data['zone_name']);
            $today = date('Y-m-d');

            $permission = false;

            foreach ($b as $key => $value) {
                if (strtotime($today)  >= strtotime($value)) {
                    $permission = true;
                }
            }

            if ($permission && $get_student_ans_by_module) {
                $st_ans = json_decode($get_student_ans_by_module[0]['st_ans'], true);
                if ($st_ans) {
                    $_SESSION['show_tutorial_result'] = 1;
                    $this->insert_error_question($get_student_error_ans_info, $st_ans);

                    foreach ($st_ans as $row) {
                        if ($row['ans_is_right'] == 'wrong') {
                            $link = 'get_tutor_tutorial_module/' . $module_id . '/' . $row['question_order_id'];
                            $exact_time = time();
                            $this->session->set_userdata('exact_time', $exact_time);
                            $this->session->set_userdata('exam_start', $exact_time);
                            break;
                        }
                    }
                }
            }

            if (!$permission && $get_student_ans_by_module) {
                $st_ans = json_decode($get_student_ans_by_module[0]['st_ans'], true);
                if ($st_ans) {
                    $_SESSION['show_tutorial_result'] = 1;
                    $this->insert_error_question($get_student_error_ans_info, $st_ans);

                    foreach ($st_ans as $row) {
                        if ($row['ans_is_right'] == 'wrong') {
                            $link = 'get_tutor_tutorial_module/' . $module_id . '/' . $row['question_order_id'];
                            $exact_time = time();
                            $this->session->set_userdata('exact_time', $exact_time);
                            $this->session->set_userdata('exam_start', $exact_time);
                            break;
                        }
                    }
                }
            }

            if (!$get_student_ans_by_module) {

                $tbl_module_ans = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques_two', $module_id, $this->session->userdata('user_id'));

                if (count($tbl_module_ans)) {
                    $data = json_decode($tbl_module_ans[0]['st_ans'], true);
                    $order_id = $data[count($data)]['question_order_id'];

                    $question_order_id = $order_id + 1;
                    $question_info_s = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);
                    if (count($question_info_s)) {
                        $link = 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id . '';
                    } else {
                        $link = 'get_tutor_tutorial_module/' . $module_id . '/' . $order_id . '';
                    }
                } else {
                    $link = 'get_tutor_tutorial_module/' . $module_id . '/1';
                }
            }
        } else {
            $video_link = json_decode($module[0]['video_link']);

            $tbl_module_ans = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques_two', $module_id, $this->session->userdata('user_id'));

            if (count($tbl_module_ans)) {
                // $data = json_decode($tbl_module_ans[0]['st_ans'] , true);
                $data_new = json_decode($tbl_module_ans[0]['st_ans'], true);
                foreach ($data_new as $key => $data) {
                }
                // print_r($data);die();
                // $order_id = $data[count($data)]['question_order_id'];
                $order_id = $data['question_order_id'];

                $question_order_id = $order_id + 1;
                $question_info_s = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);
                if (count($question_info_s)) {
                    $link = 'get_tutor_tutorial_module/' . $module[0]['id'] . '/' . $question_order_id . '';
                } else {
                    $link = 'get_tutor_tutorial_module/' . $module[0]['id'] . '/' . $order_id . '';
                }
            } else {
                $link = 'get_tutor_tutorial_module/' . $module[0]['id'] . '/1';
            }

            if ($video_link) {

                $tbl_module_ans = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques_two', $module_id, $this->session->userdata('user_id'));

                if (count($tbl_module_ans)) {
                    $data = json_decode($tbl_module_ans[0]['st_ans'], true);
                    $order_id = $data[count($data)]['question_order_id'];

                    $question_order_id = $order_id + 1;
                    $question_info_s = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);
                    if (count($question_info_s)) {
                        $link = 'video_link/' . $module[0]['id'] . '/' . $question_order_id;
                    } else {
                        $link = 'video_link/' . $module[0]['id'] . '/' . $order_id;
                    }
                } else {
                    $link = 'video_link/' . $module[0]['id'] . '/' . $module[0]['moduleType'];
                }
            }
        }
        //print_r($link); die();
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


    
    public function finish_all_module_question($module_id, $point)
    {
        // echo "hello";die();
       
        $this->session->unset_userdata('start_exam_time_new');
        $this->session->unset_userdata('take_ans_time_new');
       
        $_SESSION['show_tutorial_result'] = 0;
        $user_id = $this->session->userdata('user_id');
        $module  = $this->Student_model->getInfo('tbl_module', 'id', $module_id);
        $moduleCreator = $module[0]['user_id'];

         $moduleType = $module[0]['moduleType'];
       


        $this->Student_model->deleteInfo_mod_ques_2($user_id, $module_id);

        $gradeCheck = $this->db->where('user_id', $user_id)->get('student_grade_log')->row();
        $user = $this->db->where('id', $user_id)->get('tbl_useraccount')->row();

        $user_grade   = $user->student_grade;
        $latest_grade = $gradeCheck->grade;
        // echo  $user_grade;
        // echo "<br>";
        // echo $latest_grade;
        // die();

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
            $get_student_ans_by_module = $this->Student_model->student_module_ans_info($this->session->userdata('user_id'), $module[0]['id']);
            $moduleCreated =  date("Y-m-d", strtotime($get_student_ans_by_module[0]['created_at']));

            $ck_repetation_update =  $this->Student_model->repete_date_module_index_ck($module_id, $user_id);

            // $this->Student_model->repete_date_module_index($module_id, json_encode($update_new_repeted_day));
            // echo "<br>";
            // echo count($ck_repetation_update);
            // echo "<br>";

            if (count($ck_repetation_update) > 0) {

                // echo 111; print_r($ck_repetation_update); die();

                $repition_days = strlen($ck_repetation_update[0]['repetation']) ? json_decode($ck_repetation_update[0]['repetation']) : [1, 2, 3];
                foreach ($repition_days as $key => $value) {
                    $singel_days[] = explode("_", $value)[0];
                }
                foreach ($singel_days as $key => $a) {
                    if ($key != 0) {
                        $new_repetation_day[] = $a . '_' . date('Y-m-d', strtotime($moduleCreated . ' +' . $a . ' days'));
                    }
                }

                $repetation_insert['student_id'] = $user_id;
                $repetation_insert['module_id'] = $module_id;
                $repetation_insert['repetation'] = json_encode($new_repetation_day);

                if (count($new_repetation_day)) {
                    //echo 12;die;
                    $this->Student_model->updateInfo('tbl_student_repetation_day',  'id', $ck_repetation_update[0]['id'], $repetation_insert);
                }
                //die;

            } else {
                //echo 222;die();
                // start added for prize
                // if ($user_grade == $latest_grade && $moduleType == 2 && $moduleCreator == 2) {

                //     $mData['user_id']   = $user_id;
                //     $mData['module_id'] = $module_id;
                //     $mData['complete_date'] = date('Y-m-d');
                //     $mData['percentage']= $point;
                //     $this->db->insert('daily_modules',$mData);

                //     $pData['user_id'] = $user_id;
                //     $getPointInfo = $this->db->where('user_id',$user_id)->get('module_points')->row();
                //     if ($getPointInfo) {
                //         $recent_point = $getPointInfo->point;
                //         $pData['point'] = $point + $recent_point;
                //         //print_r($pData);die;
                //         $this->db->where('user_id',$user_id)->update('module_points',$pData);
                //     }else{
                //         $pData['point'] = $point;
                //         $this->db->insert('module_points',$pData);
                //     }



                //     $getProPoint = $this->db->where('user_id',$user_id)->get('product_poinits')->row();
                //     $tr_point = $this->db->where('user_id',$user_id)->get('target_points')->row();
                //     $target_point = $tr_point->targetPoint;

                //     //$pointCheck  = $this->db->where('user_id',$user_id)->get('product_poinits')->row();

                //     if ($getProPoint) {
                //         $proPoint['user_id'] = $user_id;
                //         $sumPoint = ($getProPoint->recent_point +  $point);

                //         if ($sumPoint >= $target_point) {
                //             $proPoint['recent_point'] = $target_point;
                //             $bnsPoint = ($sumPoint - $target_point);
                //             $proPoint['bonus_point']  = $getProPoint->bonus_point + $bnsPoint;
                //             $proPoint['total_point']  = $getProPoint->total_point + $point;

                //         }else{
                //             $proPoint['recent_point'] = $getProPoint->recent_point +  $point;
                //             $proPoint['total_point']  = $getProPoint->total_point + $point;
                //         }


                //         $this->db->where('user_id',$user_id)->update('product_poinits',$proPoint);

                //     }else{
                //         $proPoint['user_id'] = $user_id;
                //         $proPoint['recent_point'] = $point;
                //         $proPoint['total_point'] = $point;
                //         $this->db->insert('product_poinits',$proPoint);
                //     }
                // }

                // end added for prize


                $repition_days = strlen($module[0]['repetition_days']) ? json_decode($module[0]['repetition_days']) : [1, 2, 3];
                foreach ($repition_days as $key => $value) {
                    $singel_days[] = explode("_", $value)[0];
                }

                foreach ($singel_days as $key => $a) {
                    $new_repetation_day[] = $a . '_' . date('Y-m-d', strtotime($moduleCreated . ' +' . $a . ' days'));
                }

                // print_r($singel_days); 
                // print_r($new_repetation_day); die();
                // echo 'yes';die();

                $repetation_insert['student_id'] = $user_id;
                $repetation_insert['module_id'] = $module_id;
                $repetation_insert['repetation'] = json_encode($new_repetation_day);

                if (count($new_repetation_day)) {
                    $this->Student_model->insertInfo('tbl_student_repetation_day',  $repetation_insert);
                }
            }

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
                if ($module[0]['moduleType'] == 2 && $module[0]['optionalTime'] != 0) {
                    $this->Student_model->delete_all_st_error_ans($module_id, $user_id);
                } else {
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
        if (!$this->input->is_ajax_request()) {
        if($this->session->userdata('set_url_module_list')){
            $get_url =$this->session->userdata('set_url_module_list');
            $this->session->unset_userdata('set_url_module_list');
            redirect($get_url);
        }}
        
        if (!$this->input->is_ajax_request()) {

            redirect('/');
         }else{
             echo "success";
         }

        
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

        $order_no_pre =  $_SESSION['q_order'] - 1;
        $order_no_nxt =  $_SESSION['q_order'] + 1;
        $order_no_module =  $_SESSION['q_order_module'];
        $order_previsous_url = $_SESSION['q_order_2'];
        $order_current_url = $_SESSION['q_order'];
        $add_order = $order_previsous_url + 1;
        $url_base = base_url();
        $next_page = $url_base . "get_tutor_tutorial_module/" . $_SESSION['q_order_module'] . "/" . $add_order;
        // print_r($next_page); die();

        if (empty($back) && empty($next)) {

            $datas = $this->ModuleModel->tutor_infos($id, 0);
            $_SESSION["order"] = $datas[0]->orders;
            $output = '';
            $output .= '<h4>Add The followings:</h4>';
            $output .= '<img src="assets/uploads/' . $datas[0]->img . '" width="100%" height="100%"><br>';
            $output .= '</div>';

            $output .= '<div class="row">';
            $output .= '<div class="col-md-6">';
            if ($datas[0]->audio != "none" && $datas[0]->speech != "none") {
                $output .= 'Audio file: <audio controls>';
                $output .= '<source src ="assets/uploads/question_media/' . $datas[0]->audio . '" type="audio/mpeg">';
                $output .= '</audio><br><br>';
                $output .= '</div>';
                $output .= 'Speech to text :
                      <i class="fa fa-volume-up" onclick="speak()"></i>
                      <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                      <input type="hidden" id="wordToSpeak" value="' . $datas[0]->speech . '">';
                $output .= '</div>';
                $output .= '</div>';
            }

            if ($datas[0]->audio != "none" && $datas[0]->speech == "none") {
                $output .= 'Audio file: <audio controls>';
                $output .= '<source src ="assets/uploads/question_media/' . $datas[0]->audio . '" type="audio/mpeg">';
                $output .= '</audio><br><br>';
                $output .= '</div>';
                $output .= '</div>';
            }
            if ($datas[0]->audio == "none" && $datas[0]->speech != "none") {
                $output .= 'Speech to text :
                      <i class="fa fa-volume-up" onclick="speak()"></i>
                      <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                      <input type="hidden" id="wordToSpeak" value="' . $datas[0]->speech . '">';
                $output .= '</div>';
                $output .= '</div>';
            }

            $output .= '<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
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
            $datas = $this->ModuleModel->tutor_infos($id, $bk);
            if (!empty($datas)) {
                $output = '';
                $output .= '<h4>Add The followings:</h4>';
                $output .= '<img src="assets/uploads/' . $datas[0]->img . '" width="100%" height="100%"><br>';
                $output .= '</div>';

                $output .= '<div class="row">';
                $output .= '<div class="col-md-6">';
                if ($datas[0]->audio != "none" && $datas[0]->speech != "none") {
                    $output .= 'Audio file: <audio controls>';
                    $output .= '<source src ="assets/uploads/question_media/' . $datas[0]->audio . '" type="audio/mpeg">';
                    $output .= '</audio><br><br>';
                    $output .= '</div>';
                    $output .= 'Speech to text :
                      <i class="fa fa-volume-up" onclick="speak()"></i>
                      <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                      <input type="hidden" id="wordToSpeak" value="' . $datas[0]->speech . '">';
                    $output .= '</div>';
                    $output .= '</div>';
                }

                if ($datas[0]->audio != "none" && $datas[0]->speech == "none") {
                    $output .= 'Audio file: <audio controls>';
                    $output .= '<source src ="assets/uploads/question_media/' . $datas[0]->audio . '" type="audio/mpeg">';
                    $output .= '</audio><br><br>';
                    $output .= '</div>';
                    $output .= '</div>';
                }
                if ($datas[0]->audio == "none" && $datas[0]->speech != "none") {
                    $output .= 'Speech to text :
                          <i class="fa fa-volume-up" onclick="speak()"></i>
                          <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                          <input type="hidden" id="wordToSpeak" value="' . $datas[0]->speech . '">';
                    $output .= '</div>';
                    $output .= '</div>';
                }

                $output .= '<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
                <script>
                function speak() {
                    var word = $("#wordToSpeak").val();
                    responsiveVoice.speak(word);
                  }
                </script>';
                print_r($output);
            } else {
                $var = [
                    "first" => 0,
                    "module_id" => $order_no_module,
                    "order" => $_SESSION["previous_page"]
                ];
                array_push($data_4, $var);
                echo json_encode($data_4);
            }
        }

        if (!empty($next)) {
            $nxt = $_SESSION["order"] + 1;
            $_SESSION["order"] = $nxt;
            $datas = $this->ModuleModel->tutor_infos($id, $nxt);
            if (!empty($datas)) {
                $output = '';
                $output .= '<h4>Add The followings:</h4>';
                $output .= '<img src="assets/uploads/' . $datas[0]->img . '" width="100%" height="100%"><br>';
                $output .= '</div>';

                $output .= '<div class="row">';
                $output .= '<div class="col-md-6">';
                if ($datas[0]->audio != "none" && $datas[0]->speech != "none") {
                    $output .= 'Audio file: <audio controls>';
                    $output .= '<source src ="assets/uploads/question_media/' . $datas[0]->audio . '" type="audio/mpeg">';
                    $output .= '</audio><br><br>';
                    $output .= '</div>';
                    $output .= 'Speech to text :
                      <i class="fa fa-volume-up" onclick="speak()"></i>
                      <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                      <input type="hidden" id="wordToSpeak" value="' . $datas[0]->speech . '">';
                    $output .= '</div>';
                    $output .= '</div>';
                }

                if ($datas[0]->audio != "none" && $datas[0]->speech == "none") {
                    $output .= 'Audio file: <audio controls>';
                    $output .= '<source src ="assets/uploads/question_media/' . $datas[0]->audio . '" type="audio/mpeg">';
                    $output .= '</audio><br><br>';
                    $output .= '</div>';
                    $output .= '</div>';
                }
                if ($datas[0]->audio == "none" && $datas[0]->speech != "none") {
                    $output .= 'Speech to text :
                          <i class="fa fa-volume-up" onclick="speak()"></i>
                          <i style="color:red;" class="fa fa-exclamation-triangle"></i>
                          <input type="hidden" id="wordToSpeak" value="' . $datas[0]->speech . '">';
                    $output .= '</div>';
                    $output .= '</div>';
                }

                $output .= '<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
                <script>
                function speak() {
                    var word = $("#wordToSpeak").val();
                    responsiveVoice.speak(word);
                  }
                </script>';
                print_r($output);
            } else {

                $order_previsous_url =  substr($_SESSION["previous_page"], -1);

                if ((strstr($_SESSION["previous_page"], '/get_tutor_tutorial_module/') && $order_current_url < $order_previsous_url)) {




                    $var = [
                        "first" => 0,
                        "module_id" => $order_no_module,
                        "order" => $_SESSION["previous_page"]
                    ];
                    array_push($data_4, $var);
                    echo json_encode($data_4);
                } else {
                    $var = [
                        "first" => 0,
                        "module_id" => $order_no_module,
                        "order" => $next_page
                    ];
                    array_push($data_4, $var);
                    echo json_encode($data_4);
                }
            }
        }
    }

    public function student_creative_quiz_ans_matching()
    {
        $response = array(
            'success' => false,
            'error' => false,
            'msg' => '',
            'array_sequence' => '',
        );
        $clue_value = $this->input->post('clue_id');
        if ($clue_value >= 3) {
            $clue_id = $clue_value;
        } else {
            $clue_id = $clue_value + 1;
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
        if (!empty($idOfContent)) {
            $idcount = count($idOfContent);

            for ($i = 0; $i < $idcount; $i++) {
                $idJcount = count($idOfContent[$i]);
                for ($j = 0; $j < $idJcount; $j++) {
                    $ContentId[] = $idOfContent[$i][$j] + 1;
                }
            }
        }

        $notInParagraph = array();
        $ContentId_length = count($ContentId);
        $answer_length = count($answer);
        $test = array();
        for ($x = 0; $x < $answer_length; $x++) {
            if (isset($ContentId[$x])) {
                if ($answer[$x] != $ContentId[$x]) {
                    $test[] = $ContentId[$x];
                }
            }
        }

        $notInParagraph = $test;
        $notInParagraphR = array();
        $ncount = count($notInParagraph);
        for ($n = 0; $n < $ncount; $n++) {
            $notInParagraphR[] = $notInParagraph[$n] - 1;
        }

        $Idlength = count($answer);
        for ($i = 0; $i < $Idlength; $i++) {
            $ansValue =  $answer[$i];

            if (!empty($ContentId[$i])) {
                if ($ansValue == $ContentId[$i]) {
                    $matchResult[] = $ContentId[$i];
                } else {
                    $NotMatchResult[] = $ContentId[$i];
                }
            }
        }


        //        $NotMatchResult this array for answer sequence are not match id

        $matchingError = array();
        $paraIndex = array();

        $ansCount = count($paragraphOrder);
        for ($i = 0; $i < $ansCount; $i++) {
            if ($paragraphOrder[$i] == '') {
                $paraIndex[0][] = $i;
            } else {
                $paraIndex[$paragraphOrder[$i]][] = $i;
            }
        }

        $countIndex = count($paraIndex);


        if (!empty($paraIndex[0])) {
            for ($x = 0; $x < $countIndex; $x++) {
                if (!empty($idOfContent[$x])) {
                    $acb  = array_diff($idOfContent[$x], $paraIndex[$x]);
                    $matchingError[$x] = array_values($acb);
                } else {
                    $matchingError[$x] = [];
                }
            }
        } else {
            for ($x = 1; $x < $countIndex; $x++) {
                if (!empty($idOfContent[$x])) {
                    $acb  = array_diff($idOfContent[$x], $paraIndex[$x]);
                    $matchingError[$x] = array_values($acb);
                } else {
                    $matchingError[$x] = [];
                }
            }
        }

        //        $matchingError this array is paragraph sequence id


        $NotMatchResults = array();
        if (!empty($NotMatchResult)) {
            $idcount = count($NotMatchResult);

            for ($i = 0; $i < $idcount; $i++) {
                $NotMatchResults[] = $NotMatchResult[$i] - 1;
            }
        }

        $matchingErrors = array();
        if (!empty($matchingError)) {
            $idcount = count($matchingError);

            for ($i = 0; $i < $idcount; $i++) {
                if (!empty($matchingError[$i])) {
                    $countK = count($matchingError[$i]);
                    for ($k = 0; $k < $countK; $k++) {
                        $matchingErrors[] = $matchingError[$i][$k];
                    }
                }
            }
        }

        $ErrorMessage = array();
        $userId = array();
        if (!empty($idOfContent)) {
            $idcount = count($idOfContent);

            for ($i = 0; $i < $idcount; $i++) {
                $idJcount = count($idOfContent[$i]);
                for ($j = 0; $j < $idJcount; $j++) {
                    $userId[] = $idOfContent[$i][$j];
                }
            }
        }

        $cCount = count($userId);
        for ($c = 0; $c < $cCount; $c++) {
            $id = $userId[$c];
            $msg = $this->MessageCheck($id, $question_description, $test);
            if (!empty($msg)) {
                $ErrorMessage[$id] = $msg;
            }
        }

        $msgArrayId = array_values($ErrorMessage);
        $TestMsg = array();
        $msgCount = count($msgArrayId);

        for ($f = 0; $f < $msgCount; $f++) {
            if ($msgArrayId[$f] == '') {
            } else {
                $TestMsg = $msgArrayId[$f];
            }
        }

        $data = array();

        $data['ErrorMessage'] = $ErrorMessage;

        $questionId = $this->input->post('questionId');
        $question_order_id = $this->input->post('current_order');
        $module_id = $this->input->post('module_id');
        $module_type = $this->input->post('module_type');
        $question_marks = $question_info[0]['questionMarks'];


        if (!empty($TestMsg) && !empty($test)) {
            if (!empty($NotMatchResults)) {
                $ans_is_right = 'wrong';

                if ($module_type == 1) {
                    $this->creative_take_decesion_1($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
                } else {
                    $this->creative_take_decesion_2($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
                }
                $response = array(
                    'success' => false,
                    'error' => false,
                    'msg' => 'failed',
                    'data' => $data,
                    'clue_id' => $clue_id,
                    'array_sequence' => 'Paragraph order is Not correct.',
                );
            } else {

                $ans_is_right = 'wrong';

                if ($module_type == 1) {
                    $this->creative_take_decesion_1($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
                } else {
                    $this->creative_take_decesion_2($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
                }
                $response = array(
                    'success' => false,
                    'error' => true,
                    'msg' => 'failed',
                    'data' => $data,
                    'clue_id' => $clue_id,
                    'array_sequence' => '',
                );
            }
        } elseif ($ContentId_length != $answer_length) {
            $ans_is_right = 'wrong';

            if ($module_type == 1) {
                $this->creative_take_decesion_1($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
            } else {
                $this->creative_take_decesion_2($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
            }
            $response = array(
                'success' => false,
                'error' => true,
                'msg' => 'failed',
                'data' => $data,
                'clue_id' => $clue_id,
                'array_sequence' => 'Paragraph order is Not correct.',
            );
        } else {
            $text = 0;
            $text_1 = 0;
            $ans_is_right = 'correct';

            if ($module_type == 1) {
                $this->creative_take_decesion_1($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
            } else {
                $this->creative_take_decesion_2($question_marks, $questionId, $module_id, $question_order_id, $ans_is_right, array());
            }

            $response = array(
                'success' => true,
                'error' => false,
                'msg' => 'success',
                'clue_id' => $clue_id,
            );
        }


        echo json_encode($response);
    }

    public function MessageCheck($id, $question_description, $matchingErrors)
    {

        $desCount = count($question_description);
        for ($d = 0; $d < $desCount; $d++) {
            if ($question_description[$id]) {
                return $question_description[$id];
            } else {
                $notCP =  $this->checkNotCP($id, $matchingErrors);
                return $notCP;
            }
        }
    }
    public function checkNotCP($id, $matchingErrors)
    {
        $mECount = count($matchingErrors);
        for ($x = 0; $x < $mECount; $x++) {
            if ($matchingErrors[$x] == $id) {
                return 'not in the right paragraph.';
            }
        }
    }
    public function ParaCheck($id, $notInParagraphR)
    {
        $pCount = count($notInParagraphR);
        for ($p = 0; $p < $pCount; $p++) {
            if ($notInParagraphR[$p] == $id) {
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
            $the_first_start_time_new = time() - $this->session->userdata('start_exam_time_new');
            $ind_ans = array(
                'question_order_id' => $question_info_ai[0]['question_order'],
                'module_type' => $question_info_ai[0]['moduleType'],
                'module_id' => $question_info_ai[0]['module_id'],
                'question_id' => $question_info_ai[0]['question_id'],
                'link' => $link2,
                'student_ans' => json_encode($student_ans),
                //                'workout' => $_POST['workout'],
                //                'student_taken_time' =>$the_first_start_time_new,
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
                }
                if ($answer_info == null && $question_info_ai[0]['moduleType'] == 2) {
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
        }
        if ($flag == 0) {
            $link1 = base_url();
            $link2 = $link1 . 'get_tutor_tutorial_module/' . $module_id . '/' . $question_order_id;

            $obtained_marks = $obtained_marks + $question_marks;
            $total_marks = $total_marks + $question_info_ai[0]['questionMarks'];
            if ($question_type == 9) {
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
                'workout' => isset($_POST['workout']) ? $_POST['workout'] : '',
                //            'student_taken_time' =>$the_first_start_time_new,
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
    
    public function student_progress_report($studentId, $ideaId, $ideaNo, $questionId)
    {
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['types'] = $this->Student_model->get_organizing('tbl_enrollment', $this->session->userdata('user_id'));


        $data['specific_std_report'] = $this->Student_model->getSpecificStudentProgressReport($studentId, $ideaId, $ideaNo, $questionId);
        // echo "<pre>"; print_r($data['specific_std_report']); die();

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('students/student_progress_report', $data, true);
        $this->load->view('master_dashboard', $data);
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
        //echo "<pre>";print_r($data);die();

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
        foreach ($left_memorize_p_one as $key => $item) {
            if ($left_memorize_h_p_one[$key] == 0) {
                $show_data_array[] = $item;
            } else {
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
        foreach ($left_memorize_p_one as $key => $item) {
            if ($left_memorize_h_p_one[$key] == 0) {
                $show_data_array[$key][0] = $item;
                $show_data_array[$key][1] = 0;
            } else {
                $show_data_array[$key][0] = $item;
                $show_data_array[$key][1] = 1;
            }
        }
        return $show_data_array;
    }




    //preview_memorization
    public function memorization_hide_data_four($question_name)
    {
        $show_data_array = array();
        $left_memorize_h_p_four = $question_name->left_memorize_h_p_four;
        $left_memorize_p_four = $question_name->left_memorize_p_four;
        $right_memorize_p_four = $question_name->right_memorize_p_four;
        $left_memorize_p_four = array_map('strtolower', $left_memorize_p_four);
        $right_memorize_p_four = array_map('strtolower', $right_memorize_p_four);
        foreach ($left_memorize_p_four as $key => $item) {
            if ($left_memorize_h_p_four[$key] == 0) {
                $show_data_array[$key]['left'] = $item;
                $show_data_array[$key]['right'] = $right_memorize_p_four[$key];
            } else {
                $show_data_array[$key]['left'] = '';
                $show_data_array[$key]['right'] = '';
            }
        }

        shuffle($show_data_array);
        return $show_data_array;
    }
    public function memorization_ans_data_four($question_name)
    {

        $show_data_array = array();
        $left_memorize_h_p_four = $question_name->left_memorize_h_p_four;
        $left_memorize_p_four = $question_name->left_memorize_p_four;
        $right_memorize_p_four = $question_name->right_memorize_p_four;
        $left_memorize_p_four = array_map('strtolower', $left_memorize_p_four);
        foreach ($left_memorize_p_four as $key => $item) {
            if ($left_memorize_h_p_four[$key] == 0) {
                $show_data_array[$key][0] = '';
                $show_data_array[$key][1] = 0;
            } else {
                $show_data_array[$key][0] = $item;
                $show_data_array[$key][1] = 1;
            }
        }

        shuffle($show_data_array);
        return $show_data_array;
    }


    public function preview_memorization_pattern_one_matching()
    {
        $show_data_array = array();
        $question_id = $this->input->post('question_id');
        $start_memorization_one_value = $this->input->post('start_memorization_one_value');
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $question_id);
        $question_name = json_decode($question_info[0]['questionName']);
        if ($start_memorization_one_value == 1) {
            $show_data_array['show_data_array'] = $this->memorization_ans_data($question_name);
            $show_data_array['all_correct'] = 1;
        } else {
            $show_data_array['show_data_array'] = $this->memorization_hide_data($question_name);
            $show_data_array['all_correct'] = 0;
        }
        echo json_encode($show_data_array);
    }

    public function preview_memorization_pattern_four_matching()
    {
        $show_data_array = array();
        $question_id = $this->input->post('question_id');
        $start_memorization_four_value = $this->input->post('start_memorization_four_value');
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $question_id);
        $question_name = json_decode($question_info[0]['questionName']);
        if ($start_memorization_four_value == 1) {
            $show_data_array['show_data_array'] = $this->memorization_ans_data_four($question_name);
            $show_data_array['all_correct'] = 1;
        } else {
            $show_data_array['show_data_array'] = $this->memorization_hide_data_four($question_name);
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
        if (isset($question_info_pattern->pattern_type)) {
            $question_info_pattern = $question_info_pattern->pattern_type;
        }
        if ($question_type == 16) {
            if ($question_info_pattern == 1) {
                $set_array = array();
                $memorization_std_ans = array();
                $memorization_part = $this->input->post('memorization_one_part');
                $memorization_answer = $this->input->post('word_matching');
                $set_array = $this->session->userdata('memorization_std_ans');
                if ($memorization_part == 1) {
                    if (isset($_SESSION['memorization_one'])) {
                    } else {
                        $memorization_std_ans[0] = $memorization_answer;
                        $this->session->set_userdata('memorization_one', 1);
                        $this->session->set_userdata('memorization_std_ans', $memorization_std_ans);
                    }
                } elseif ($memorization_part == 2) {
                    if (isset($_SESSION['memorization_two'])) {
                    } else {
                        $memorization_std_ans[0] = $set_array[0];
                        $memorization_std_ans[1] = $memorization_answer;
                        $this->session->set_userdata('memorization_two', 1);
                        $this->session->set_userdata('memorization_std_ans', $memorization_std_ans);
                    }
                }
            }
        }

        if ($submit_cycle != 1) {


            foreach ($left_memorize_p_one as $key => $item) {
                if ($left_memorize_h_p_one[$key] == 1) {
                    $show_data_array[] = $item;
                } else {
                    $show_data_array[] = '';
                }
            }

            foreach ($show_data_array as $key => $show_data) {
                if ($show_data != '') {
                    $word_matching_item = $word_matching[$key];

                    if (preg_replace('/\s+/', '', strtolower($show_data)) ==  preg_replace('/\s+/', '', strtolower($word_matching_item))) {
                        $word_matching_answer[] = 1;
                    } else {
                        $word_matching_answer[] = 0;
                        $all_correct_status = 0;
                    }
                } else {
                    $word_matching_answer[] = 2;
                }
            }
            $data_array = array();
            foreach ($word_matching_answer as $key => $value) {
                if ($value != 1) {
                    $data_array[] = $left_memorize_p_one[$key];
                } else {
                    $data_array[] = '';
                }
            }
            $data['word_matching_answer'] = $word_matching_answer;
            $data['data_array'] = $data_array;
            $data['all_correct_status'] = $all_correct_status;
            $data['status'] =  0;
        } else {
            $word_matching = $this->input->post('word_matching');
            $show_data_array = array();
            $left_memorize_h_p_one = $question_name->left_memorize_h_p_one;
            $left_memorize_p_one = $question_name->left_memorize_p_one;
            $left_memorize_p_one = array_map('strtolower', $left_memorize_p_one);
            $correct_status = 1;
            $leftSileData = array();
            $word_matching_answer = array();

            foreach ($left_memorize_p_one as $key => $item) {
                if (preg_replace('/\s+/', '', strtolower($left_memorize_p_one[$key]))  == preg_replace('/\s+/', '', strtolower($word_matching[$key]))) {
                    $show_data_array[$key][0] = $item;
                    $show_data_array[$key][1] = 1;
                    $leftSileData[$key][0] = '';
                    $leftSileData[$key][1] = 1;
                    $word_matching_answer[] = 1;
                } else {
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
            $data['word_matching'] = $word_matching;
        }

        echo json_encode($data);
    }



    public function preview_memorization_pattern_four_ans_matching()
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
        $left_memorize_h_p_four = $question_name->left_memorize_h_p_four;
        $right_memorize_h_p_four = $question_name->right_memorize_h_p_four;

        $left_memorize_p_four = $question_name->left_memorize_p_four;
        $left_memorize_p_four = array_map('strtolower', $left_memorize_p_four);

        $right_memorize_p_four = $this->input->post('right_memorize_p_four');
        $right_memorize_p_four = array_map('strtolower', $right_memorize_p_four);
        $this->session->set_userdata('correct_answer', $right_memorize_p_four);


        $question_type = $question_info[0]['questionType'];
        $question_info_pattern = '';
        $question_info_pattern = json_decode($question_info[0]['questionName']);
        if (isset($question_info_pattern->pattern_type)) {
            $question_info_pattern = $question_info_pattern->pattern_type;
        }
        if ($question_type == 16) {
            if ($question_info_pattern == 4) {
                $set_array = array();
                $memorization_std_ans = array();
                $memorization_part = $this->input->post('memorization_four_part');
                $memorization_answer = $this->input->post('word_matching');
                $set_array = $this->session->userdata('memorization_std_ans');
                // echo "<pre>";print_r($set_array);die();
                if ($memorization_part == 1) {
                    if (isset($_SESSION['memorization_four'])) {
                    } else {
                        $memorization_std_ans[0] = $memorization_answer;
                        $this->session->set_userdata('memorization_four', 1);
                        $this->session->set_userdata('memorization_std_ans', $memorization_std_ans);
                    }
                } elseif ($memorization_part == 2) {
                    if (isset($_SESSION['memorization_two'])) {
                    } else {
                        $memorization_std_ans[0] = $set_array[0];
                        $memorization_std_ans[1] = $memorization_answer;
                        $this->session->set_userdata('memorization_two', 1);
                        $this->session->set_userdata('memorization_std_ans', $memorization_std_ans);
                    }
                }
            }
        }

        if ($submit_cycle != 1) {


            foreach ($right_memorize_p_four as $key => $item) {
                if ($right_memorize_h_p_four[$key] == 1) {
                    $show_data_array[] = $item;
                } else {
                    $show_data_array[] = '';
                }
            }

            foreach ($show_data_array as $key => $show_data) {
                if ($show_data != '') {
                    $word_matching_item = $word_matching[$key];

                    if (preg_replace('/\s+/', '', strtolower($show_data)) ==  preg_replace('/\s+/', '', strtolower($word_matching_item))) {
                        $word_matching_answer[] = 1;
                    } else {
                        $word_matching_answer[] = 0;
                        $all_correct_status = 0;
                    }
                } else {
                    $word_matching_answer[] = 2;
                }
            }
            $data_array = array();
            foreach ($word_matching_answer as $key => $value) {
                if ($value != 1) {
                    $data_array[] = $left_memorize_p_four[$key];
                } else {
                    $data_array[] = '';
                }
            }
            $data['word_matching_answer'] = $word_matching_answer;
            $data['data_array'] = $data_array;
            $data['all_correct_status'] = $all_correct_status;
            $data['status'] =  0;
        } else {
            $word_matching = $this->input->post('word_matching');
            $show_data_array = array();
            $left_memorize_h_p_four = $question_name->left_memorize_h_p_four;
            $left_memorize_p_four = $question_name->left_memorize_p_four;
            $left_memorize_p_four = array_map('strtolower', $left_memorize_p_four);
            $correct_status = 1;
            $leftSileData = array();
            $word_matching_answer = array();

            foreach ($left_memorize_p_four as $key => $item) {
                if (preg_replace('/\s+/', '', strtolower($left_memorize_p_four[$key]))  == preg_replace('/\s+/', '', strtolower($word_matching[$key]))) {
                    $show_data_array[$key][0] = $item;
                    $show_data_array[$key][1] = 1;
                    $leftSileData[$key][0] = '';
                    $leftSileData[$key][1] = 1;
                    $word_matching_answer[] = 1;
                } else {
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
        // echo "<pre>";print_r($data);die();
        $data['correct_answer'] =  $this->session->userdata['correct_answer'];

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
        $correctAnswer = explode(",", $correctAnswerStd);
        $show_data_array = $this->memorization_hide_data($question_name);
        $left_memorize_p_one = $question_name->left_memorize_p_one;
        $left_memorize_p_one = array_map('strtolower', $left_memorize_p_one);
        $show_correct_ans = array();
        $show_error_ans = array();

        foreach ($correctAnswer as $key => $item) {
            if ($item == 1) {
                $show_correct_ans[] = $left_memorize_p_one[$key];
            } else {
                $show_correct_ans[] = '';
            }
        }
        $data['show_data_array'] = $show_data_array;
        if ($all_check_hint == 1) {
            foreach ($correctAnswer as $key => $item) {
                if ($item != 1) {
                    $show_error_ans[] = $left_memorize_p_one[$key];
                } else {
                    $show_error_ans[] = '';
                }
            }
            $data['show_data_array'] = $show_error_ans;
            $data['all_check_hint'] = 1;
        }

        $data['show_correct_ans'] = $show_correct_ans;

        echo json_encode($data);
    }


    public function preview_memorization_pattern_four_try()
    {
        $data = array();
        $correctAnswerSession = $this->session->userdata('correct_answer');
        $all_check_hint = $this->input->post('all_check_hint');
        $question_id = $this->input->post('question_id');
        $correctAnswerStd = $this->input->post('correctAnswer');
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $question_id);
        $question_name = json_decode($question_info[0]['questionName']);
        $correctAnswer = explode(",", $correctAnswerStd);
        $show_data_array = $this->memorization_hide_data_four($question_name);
        $left_memorize_p_four = $question_name->left_memorize_p_four;
        $left_memorize_p_four = array_map('strtolower', $left_memorize_p_four);
        $show_correct_ans = array();
        $show_error_ans = array();

        foreach ($correctAnswer as $key => $item) {
            if ($item == 1) {
                // $show_correct_ans[] = $left_memorize_p_four[$key];
                $show_correct_ans[] = $correctAnswerSession[$key];
            } else {
                $show_correct_ans[] = '';
            }
        }
        $data['show_data_array'] = $show_data_array;
        if ($all_check_hint == 1) {
            foreach ($correctAnswer as $key => $item) {
                if ($item != 1) {
                    $show_error_ans[] = $correctAnswerSession[$key];
                } else {
                    $show_error_ans[] = '';
                }
            }
            $data['show_data_array'] = $show_error_ans;
            $data['all_check_hint'] = 1;
        }


        $array = array();
        foreach ($show_data_array as $sda => $value) {
            $right = $value['right'];
            if (in_array($right, $show_correct_ans)) {
                $array[$sda] = $right;
            } else {
                $array[$sda] = '';
            }
        }
        $data['show_correct_ans'] = $array;
        // $data['show_correct_ans'] = $show_correct_ans;

        echo json_encode($data);
    }


    public function preview_memorization_pattern_one_ok()
    {

        $qus_ans = 0;
        $question_marks = 0;
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $question_order_id = $this->input->post('current_order');
        $submit_cycle = $this->input->post('submit_cycle');
        $memorization_answer = $this->input->post('memorization_answer');
        $text = 0;
        $text_1 = 0;

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        if (isset($answer_info[0]['questionMarks'])) {
            $question_marks = $answer_info[0]['questionMarks'];
        }
        $ans_is_right = 'correct';
        if ($memorization_answer == 'correct') {
            if (isset($answer_info[0]['questionMarks'])) {
                $question_marks = $answer_info[0]['questionMarks'];
            }
        } else {
            $ans_is_right = 'wrong';
        }

        if ($_POST['module_type'] == 2) {
            $table = 'tbl_student_answer';
        } else {
            $table = 'tbl_temp_tutorial_mod_ques';
        }

        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo($table, $module_id, $_SESSION['user_id']);

        if (count($tutorial_ans_info) == 0) {
            if ($ans_is_right == "wrong") {

                $dataArray = $_SESSION['data'];
                if (count($dataArray)) {

                    $dataArray[$_POST['current_order']]['ans_is_right']  = "wrong";
                    $dataArray[$_POST['current_order']]['student_marks']  = 0;
                    $this->session->set_userdata('data', $dataArray);

                    $dataArray = $_SESSION['data'];
                    $total_marks = 0;

                    foreach ($dataArray as $key => $value) {
                        $total_marks += $value['student_marks'];
                    }

                    $_SESSION['obtained_marks'] = $total_marks;
                }
            }
        }
        // echo $ans_is_right;echo $_POST['module_type'];die();

        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }




    public function preview_memorization_pattern_four_ok()
    {

        $qus_ans = 0;
        $question_marks = 0;
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $question_order_id = $this->input->post('current_order');
        $submit_cycle = $this->input->post('submit_cycle');
        $memorization_answer = $this->input->post('memorization_answer');
        $text = 0;
        $text_1 = 0;

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        if (isset($answer_info[0]['questionMarks'])) {
            $question_marks = $answer_info[0]['questionMarks'];
        }
        $ans_is_right = 'correct';
        if ($memorization_answer == 'correct') {
            if (isset($answer_info[0]['questionMarks'])) {
                $question_marks = $answer_info[0]['questionMarks'];
            }
        } else {
            $ans_is_right = 'wrong';
        }

        if ($_POST['module_type'] == 2) {
            $table = 'tbl_student_answer';
        } else {
            $table = 'tbl_temp_tutorial_mod_ques';
        }

        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo($table, $module_id, $_SESSION['user_id']);

        if (count($tutorial_ans_info) == 0) {
            if ($ans_is_right == "wrong") {

                $dataArray = $_SESSION['data'];
                if (count($dataArray)) {

                    $dataArray[$_POST['current_order']]['ans_is_right']  = "wrong";
                    $dataArray[$_POST['current_order']]['student_marks']  = 0;
                    $this->session->set_userdata('data', $dataArray);

                    $dataArray = $_SESSION['data'];
                    $total_marks = 0;

                    foreach ($dataArray as $key => $value) {
                        $total_marks += $value['student_marks'];
                    }

                    $_SESSION['obtained_marks'] = $total_marks;
                }
            }
            // if ( $ans_is_right == "correct" ) {
            //     $dataArray = $_SESSION['data'];
            //     if (count($dataArray)) {
            //         $dataArray[$_POST['current_order']]['student_marks']  = $dataArray[1]['student_question_marks'];
            //         $this->session->set_userdata('data', $dataArray);
            //         $dataArray = $_SESSION['data'];
            //         $total_marks = $total_marks;
            //         foreach ($dataArray as $key => $value) {
            //             $total_marks += $value['student_marks'];
            //         }
            //         $_SESSION['obtained_marks'] = $total_marks;
            //     }
            // }
        }
        // echo "<pre>";print_r($_SESSION);die();

        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }


    public function preview_memorization_pattern_three_take_decesion()
    {
        $qus_ans = 0;
        $question_marks = 0;
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $question_order_id = $this->input->post('current_order');
        //$submit_cycle = $this->input->post('submit_cycle');
        $memorization_answer = $this->input->post('memorization_answer');
        $text = 0;
        $text_1 = 0;

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        if (isset($answer_info[0]['questionMarks'])) {
            $question_marks = $answer_info[0]['questionMarks'];
        }
        $ans_is_right = 'correct';

        if ($memorization_answer == 'correct') {

            if (isset($answer_info[0]['questionMarks'])) {
                $question_marks = $answer_info[0]['questionMarks'];
            }
        } else {

            $ans_is_right = 'wrong';
        }
        if ($_POST['module_type'] == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, $next_step_patten_two);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right, $next_step_patten_two);
        }
    }
    public function preview_memorization_pattern_two_take_decesion()
    {
        $qus_ans = 0;
        $question_marks = 0;
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $question_order_id = $this->input->post('current_order');
        //$submit_cycle = $this->input->post('submit_cycle');
        $memorization_answer = $this->input->post('memorization_answer');
        $text = 0;
        $text_1 = 0;

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        if (isset($answer_info[0]['questionMarks'])) {
            $question_marks = $answer_info[0]['questionMarks'];
        }
        $ans_is_right = 'correct';

        if ($memorization_answer == 'correct') {
            $ans_is_right = 'correct';
            if (isset($answer_info[0]['questionMarks'])) {
                $question_marks = $answer_info[0]['questionMarks'];
            }
        } else {
            $ans_is_right = 'wrong';
            $text_1 = 1;
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
        foreach ($left_memorize_p_one as $item) {
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
        if (isset($question_info_pattern->pattern_type)) {
            $question_info_pattern = $question_info_pattern->pattern_type;
        }
        if ($question_type == 16) {
            if ($question_info_pattern == 1) {
                $set_array = array();
                $memorization_std_ans = array();
                $memorization_part = $this->input->post('memorization_one_part');
                $memorization_answer = $this->input->post('left_memorize_p_one_alpha_ans');
                $set_array = $this->session->userdata('memorization_std_ans');
                if ($memorization_part == 3) {
                    if (isset($_SESSION['memorization_three'])) {
                    } else {
                        if (isset($set_array[0])) {
                            $memorization_std_ans[0] = $set_array[0];
                        } else {
                            $memorization_std_ans[0] = '';
                        }
                        if (isset($set_array[1])) {
                            $memorization_std_ans[1] = $set_array[1];
                        } else {
                            $memorization_std_ans[1] = '';
                        }
                        $memorization_std_ans[2] = $memorization_answer;
                        $this->session->set_userdata('memorization_three', 1);
                        $this->session->set_userdata('memorization_std_ans', $memorization_std_ans);
                    }
                }
            }
        }
        //        $left_memorize_p_one = array_map('strtolower', $left_memorize_p_one);
        $reply_ans = array();
        $reply_hints = array();
        $correct = 1;
        $correctAnswer = array();

        foreach ($left_memorize_p_one as $key => $item) {
            if (isset($left_memorize_p_one_alpha_ans[$key]) && $left_memorize_p_one_alpha_ans[$key] != '') {
                if (preg_replace('/\s+/', '', strtolower($item))  ==  preg_replace('/\s+/', '', strtolower($left_memorize_p_one_alpha_ans[$key]))) {
                    $reply_ans[$key][0] = $item;
                    $reply_ans[$key][1] = 1;
                    $correctAnswer[] = 1;
                } else {
                    $reply_ans[$key][0] = $left_memorize_p_one_alpha_ans[$key];
                    $reply_ans[$key][1] = 0;
                    $correct = 0;
                    $correctAnswer[] = 0;
                }
            } else {
                $reply_ans[$key][0] = $left_memorize_p_one_alpha_ans[$key];
                $reply_ans[$key][1] = 0;
                $correct = 0;
                $correctAnswer[] = 0;
            }
        }

        foreach ($left_memorize_p_one as $key => $item) {

            if ($reply_ans[$key][1] == 0) {
                $split_array = str_split(trim($item), 1);
                $countHints = count($split_array);

                $maxShow = $countHints - 3;
                for ($hints = 0; $hints < $countHints; $hints++) {
                    //if ($hints<$maxShow)
                    //{
                    if (isset($split_array[$hints])) {
                        //$cycle = $submit_cycle;
                        $cycle = $submit_cycle;
                        if ($hints <= $cycle) {
                            $reply_hints[$key][0][] = $split_array[$hints];
                        } else {
                            $reply_hints[$key][0][] = '';
                        }
                    }
                    //}
                }
                $reply_hints[$key][1] = 1;
            } else {
                $split_array = str_split(trim($item), 1);
                $reply_hints[$key][0] = $split_array;
                $reply_hints[$key][1] = 0;
            }
        }

        if ($correct == 0) {
            $submit_cycle = $submit_cycle + 1;
        }
        $data['submit_cycle'] = $submit_cycle;
        $data['correct'] = $correct;
        $data['correctAnswer'] = $correctAnswer;
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
        $correctAnswer = explode(",", $correctAnswer);
        $left_memorize_p_one = $question_name->left_memorize_p_one;
        $show_correct_ans = array();
        $next = array();
        foreach ($correctAnswer as $key => $item) {
            if ($item == 1) {
                $show_correct_ans[] = $left_memorize_p_one[$key];
            } else {
                $show_correct_ans[] = '';
            }
        }
        foreach ($correctAnswer as $key => $value) {
            if ($value == 1) {
                $item = $left_memorize_p_one[$key];
                $split_array = str_split(trim($item), 1);
                $next[$key][0] = $split_array;
                $next[$key][1] = 1;
            } else {
                $item = $left_memorize_p_one[$key];
                $split_array = str_split(trim($item), 1);
                $countHints = count($split_array);
                $maxShow = $countHints - 3;
                for ($hints = 0; $hints < $countHints; $hints++) {
                    if (isset($split_array[$hints])) {
                        $cycle = $submit_cycle;
                        $cycle = $submit_cycle - 1;
                        if ($hints <= $cycle && $hints < $maxShow) {
                            $next[$key][0] = $split_array[$hints];
                        } else {
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
        if (isset($question_name->hide_pattern_two_left)) {
            $hide_pattern_two_left = $question_name->hide_pattern_two_left;
            $left_content = $this->contentModifyByHidden($left_memorize_p_two, $left_memorize_h_p_two);
        } else {
            $hide_pattern_two_left = 0;
            $left_content = $this->contentModify($left_memorize_p_two);
        }
        if (isset($question_name->hide_pattern_two_right)) {
            $hide_pattern_two_right = $question_name->hide_pattern_two_right;
            $right_content = $this->contentModifyByHidden($right_memorize_p_two, $right_memorize_h_p_two);
        } else {
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

        $this->session->set_userdata('firstleftSerial', $left_memorize_p_two_ans);
        $left_content = array();
        $right_content = array();
        if (isset($question_name->hide_pattern_two_left)) {
            $hide_pattern_two_left = $question_name->hide_pattern_two_left;
            $left_content = $this->MemorizationAnswerMatching($cycle, $left_memorize_p_two, $left_memorize_p_two_ans, $left_memorize_h_p_two);
        }
        // if (isset($question_name->hide_pattern_two_right))
        // {
        //     $hide_pattern_two_right = $question_name->hide_pattern_two_right;
        //     $right_content = $this->MemorizationAnswerMatching($cycle,$right_memorize_p_two,$right_memorize_p_two_ans,$right_memorize_h_p_two);
        // }
        $right_content = $this->MemorizationAnswerMatchingTwo($left_memorize_p_two_ans, $right_memorize_p_two_ans);
        $cycle = $cycle + 2;
        $data['cycle'] = $cycle;
        $data['left_content'] = $left_content;
        $data['right_content'] = $right_content;
        echo json_encode($data);
    }

    public function MemorizationAnswerMatchingTwo($left_memorize_p_two_ans, $right_memorize_p_two_ans)
    {
        $data = array();
        $matchingAnswer = array();
        $correct = 1;
        $singleSentences = array();
        $word = array();
        foreach ($left_memorize_p_two_ans as $key => $value) {
            $left_result_val = $value;
            $right_result_val = $right_memorize_p_two_ans[$key];

            if ($left_result_val == $right_result_val) {
                $matchingAnswer[$key][0] =  $right_result_val;
                $matchingAnswer[$key][1] =  1;
            } else {
                $matchingAnswer[$key][0] =  $right_result_val;
                $matchingAnswer[$key][1] =  0;
                $correct = 0;
            }
        }
        if ($correct == 0) {
            foreach ($tutorAns as $key => $tutorAn) {

                if ($hiddenContent[$key][0] == 1) {
                    $word[$key][] = explode(" ", trim($tutorAn[0]));
                }
            }
            $data['clue'] = $this->clueArray($cycle, $word);
        }

        $data['matchingAnswer'] = $matchingAnswer;
        $data['correct'] = $correct;
        return $data;
        // echo "<pre>";print_r($right_result_val);die();
    }
    public function MemorizationAnswerMatching($cycle, $tutorAns, $stdAns, $hiddenContent)
    {
        $data = array();
        $matchingAnswer = array();
        $correct = 1;
        $singleSentences = array();
        $word = array();
        foreach ($hiddenContent as $key => $item) {
            $TAns = str_replace(array('.', ' ', "\n", "\t", "\r"), '', strip_tags($tutorAns[$key][0]));

            $SAns = str_replace(array('.', ' ', "\n", "\t", "\r"), '', $stdAns[$key]);


            if ($item[0] == 1) {
                if ($TAns === $SAns) {
                    $matchingAnswer[$key][0] =  strip_tags($tutorAns[$key][0]);
                    $matchingAnswer[$key][1] =  1;
                } else {
                    $matchingAnswer[$key][0] =  $stdAns[$key];
                    $matchingAnswer[$key][1] =  0;
                    $correct = 0;
                }
            } else {
                $matchingAnswer[$key][0] = strip_tags($tutorAns[$key][0]);
                $matchingAnswer[$key][1] = 2;
            }
        }
        if ($correct == 0) {
            foreach ($tutorAns as $key => $tutorAn) {

                if ($hiddenContent[$key][0] == 1) {
                    $word[$key][] = explode(" ", trim($tutorAn[0]));
                }
            }
            $data['clue'] = $this->clueArray($cycle, $word);
        }
        $data['matchingAnswer'] = $matchingAnswer;
        $data['correct'] = $correct;
        return $data;
    }
    public function clueArray($cycle, $words)
    {
        $html = '';
        foreach ($words as $word) {
            $countW = count($word);
            $html .= '<div style="overflow: hidden">';
            for ($i = 0; $i < $countW; $i++) {
                $countT = count($word[$i]);
                for ($j = 0; $j <= $countT; $j++) {
                    if (isset($word[$i][$j])) {
                        if ($j <= $cycle) {
                            $html .= '<div style="float:left;height: 35px;min-width: 30px;margin-bottom:5px;margin-right:5px;display: inline-block;padding: 5px;border: 1px solid #ccc;">' . $word[$i][$j] . '</div>';
                        } else {
                            $html .= '<div style="float:left;height: 35px;min-width: 30px;margin-bottom:5px;margin-right:5px;display: inline-block;padding: 5px;border: 1px solid #ccc;"> </div>';
                        }
                    }
                }
            }
            $html .= '</div>';
        }
        return $html;
    }
    public function contentModifyByHidden($data, $checkData)
    {
        $modifyData = array();
        foreach ($data as $key => $value) {
            if ($checkData[$key][0] == 1) {
                $modifyData[] = '';
            } else {
                $modifyData[] = strip_tags($value[0]);
            }
        }
        return $modifyData;
    }
    public function contentModify($data)
    {
        $modifyData = array();

        foreach ($data as $key => $value) {
            $modifyData[$key]['left'] = $value[0];
            $modifyData[$key]['sl']   = $key + 1;
        }

        shuffle($modifyData);
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
        $pattern_two_hidden_ans_left = explode(",", $pattern_two_hidden_ans_left);
        $pattern_two_hidden_ans_right = explode(",", $pattern_two_hidden_ans_right);
        $stdAnsLeft = array();
        $stdAnsRight = array();
        $returnLeft = array();
        $returnRight = array();
        $countL = count($pattern_two_hidden_ans_left);
        $countR = count($pattern_two_hidden_ans_right);
        if ($countL > 1) {
            for ($i = 1; $i < $countL; $i = $i + 2) {
                $stdAnsLeft[] = $pattern_two_hidden_ans_left[$i];
            }
            foreach ($left_memorize_p_two as $key => $item) {
                if ($stdAnsLeft[$key] == 0) {
                    $returnLeft[] = '';
                } else {
                    $returnLeft[] = $item[0];
                }
            }
        }
        if ($countR > 1) {
            for ($i = 1; $i < $countR; $i = $i + 2) {
                $stdAnsRight[] = $pattern_two_hidden_ans_right[$i];
            }
            foreach ($right_memorize_p_two as $key => $item) {
                if ($stdAnsRight[$key] == 0) {
                    $returnRight[] = '';
                } else {
                    $returnRight[] = $item[0];
                }
            }
        }

        $firstleftSerial = $this->session->userdata('firstleftSerial');
        $returnLeft = array();
        foreach ($firstleftSerial as $lmpt => $item) {
            $returnLeft[$lmpt]['left']  = $left_memorize_p_two[$item - 1];
            $returnLeft[$lmpt]['right'] = $right_memorize_p_two[$item - 1];
            $returnLeft[$lmpt]['result_status'] = $stdAnsRight[$lmpt];
            $returnLeft[$lmpt]['sl'] = $item;
        }

        shuffle($returnLeft);

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
        foreach ($left_memorize_p_three as $key => $left_data) {
            $html .= '<div class="row" style="margin-bottom: 10px;">';
            if ($left_memorize_h_p_three[$key] == 1) {
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';
                $html .= '<button valueId="left_image_ans_' . $i . '" imageId ="left_' . $i . '" type="button" class="show_all_images left_' . $i . '" style="width: 100%;height: 150px;">click</button>';
                $html .= '<img src="" id="left_' . $i . '" style="margin: auto;" class="img-responsive">';
                $html .= '<input type="hidden" name="left_image_ans[]" class="left_image_ans_' . $i . '">';
                $html .= '</div>';
            } else {
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';
                $html .= '<img style="height:150px;margin: auto;" class="img-responsive" src="' . base_url() . '/assets/uploads/' . $left_data . '">';
                $html .= '<input type="hidden" name="left_image_ans[]" class="left_image_ans_' . $i . '">';
                $html .= '</div>';
            }

            $html .= '<div class="col-sm-1">
                                            <span class="left_r_p_box_two_' . $i . '" style="display:none;position: absolute;font-weight:bold;top: 5px;color: green;">✓</span><span class="left_w_p_box_two_' . $i . '" style="display:none;position: absolute;font-weight:bold;top: 5px;color: red;">✖</span>
                                        </div>';

            if ($right_memorize_h_p_three[$key] == 1) {
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';
                $html .= '<button valueId="right_image_ans_' . $i . '" imageId ="right_' . $i . '" type="button" class="show_all_images right_' . $i . '" style="width: 100%;height: 150px;">click</button>';
                $html .= '<img src="" id="right_' . $i . '" style="margin: auto;" class="img-responsive">';
                $html .= '<input type="hidden" name="right_image_ans[]" class="right_image_ans_' . $i . '">';
                $html .= '</div>';
            } else {
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';
                $html .= '<img style="height:150px;margin: auto;" class="img-responsive" src="' . base_url() . '/assets/uploads/' . $right_memorize_p_three[$key] . '">';
                $html .= '<input type="hidden" name="right_image_ans[]" class="right_image_ans_' . $i . '">';
                $html .= '</div>';
            }

            $html .= '<div class="col-sm-1">
                                            <span class="right_r_p_box_two_' . $i . '" style="display:none;position: absolute;font-weight:bold;top: 5px;color: green;">✓</span><span class="right_w_p_box_two_' . $i . '" style="display:none;position: absolute;font-weight:bold;top: 5px;color: red;">✖</span>
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
        $order = $this->input->post('order');
        $question_name = $this->getQuestionById($question_id);

        $question_step = $question_name->question_step_memorize_p_three;
        $wrong_order_check = 0;
        $qus_setup_array = [];
        $last_step = 0;
        foreach ($question_step as $key => $value) {
            $qus_setup_array[$key]['question_step'] = $value[0];
            $qus_setup_array[$key]['clue'] = $value[1];
            $qus_setup_array[$key]['ecplanation'] = $value[2];
            $qus_setup_array[$key]['answer_status'] = $value[3];
            $qus_setup_array[$key]['order'] = $key + 1;
            if ($value[3] == 0) {
                $last_step = $last_step + 1;
            }

            if ($order == $key + 1) {
                if ($value[3] == 1) {
                    $wrong_order_check = 1;
                }
            }
        }
        $data1['qus_setup_array'] = $qus_setup_array;
        $data['wrong_order_check'] = $wrong_order_check;
        $data['last_answer_order'] = $order;
        $data['next_step'] = 1;
        $activeOrder =  $this->session->userdata('question_setup_answer_order');
        $data['active_order'] = $activeOrder;
        $correct = 1;
        // echo $last_step;die();
        if ($order == $activeOrder) {

            $data['answer_status'] = 1;
            $correct = 1;

            if ($activeOrder == $last_step) {
                $data['next_step'] = 0;
            } else {
                $data['next_step'] = 1;
            }

            $this->session->set_userdata('question_setup_answer_order', $activeOrder + 1);

            $data['active_order'] = $activeOrder + 1;
        } else {
            $data['answer_status'] = 0;
            $correct = 0;
        }


        $student_ans_data = $this->session->userdata('memorize_pattern_three_student_answer');

        if ($student_ans_data == '') {
            $save_ans[$activeOrder] = $order;
        } else {
            $save_ans = unserialize($student_ans_data);
            if (!array_key_exists($activeOrder, $save_ans)) {
                $save_ans[$activeOrder] = $order;
            }
        }



        $p = serialize($save_ans);


        $this->session->set_userdata('memorize_pattern_three_student_answer', $p);
        $data['p'] = $p;


        $question_step_details = $data['qus_setup_array'];

        if ($correct == 0) {
            $data['correct'] = $correct;
        } else {
            $data['correct'] = $correct;
        }

        // echo "<pre>";print_r($data);die();
        echo json_encode($data);

        // $data = array();
        // $question_id = $this->input->post('question_id');
        // $left_image_ans = $this->input->post('left_image_ans');
        // $right_image_ans = $this->input->post('right_image_ans');
        // $question_name = $this->getQuestionById($question_id);
        // $left_memorize_h_p_three = $question_name->left_memorize_h_p_three;
        // $right_memorize_h_p_three = $question_name->right_memorize_h_p_three;
        // $left_memorize_p_three = $question_name->left_memorize_p_three;
        // $right_memorize_p_three = $question_name->right_memorize_p_three;

        // $leftAnsMatching = array();
        // $rightAnsMatching = array();
        // $correct = 1;
        // foreach($left_memorize_p_three as $key=>$leftData)
        // {
        //     if ($left_memorize_h_p_three[$key] == 1)
        //     {
        //         if ($leftData == $left_image_ans[$key])
        //         {
        //             $leftAnsMatching[] = 1;
        //         }else
        //         {
        //             $leftAnsMatching[] = 0;
        //             $correct = 0;
        //         }

        //     }else{
        //         $leftAnsMatching[] = 2;
        //     }

        // }
        // foreach($right_memorize_p_three as $key=>$rightData)
        // {
        //     if ($right_memorize_h_p_three[$key] == 1)
        //     {
        //         if ($rightData == $right_image_ans[$key])
        //         {
        //             $rightAnsMatching[] = 1;
        //         }else
        //         {
        //             $rightAnsMatching[] = 0;
        //             $correct = 0;
        //         }

        //     }else{
        //         $rightAnsMatching[] = 2;
        //     }

        // }
        // $data['leftAnsMatching'] = $leftAnsMatching;
        // $data['rightAnsMatching'] = $rightAnsMatching;
        // if ($correct == 0)
        // {
        //     $data['correct'] = $correct;
        // }else{
        //     $data['correct'] = $correct;
        // }

        // echo json_encode($data);
    }

    public function preview_memorization_pattern_three_try_again()
    {

        $data = array();
        $leftAns = explode(",", $this->input->post('leftAns'));
        $rightAns = explode(',', $this->input->post('rightAns'));

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
        foreach ($left_memorize_p_three as $key => $left_data) {
            $html .= '<div class="row" style="margin-bottom: 10px;">';
            if ($left_memorize_h_p_three[$key] == 1) {
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';

                if ($leftAns[$key] == 1) {
                    $html .= '<button valueId="left_image_ans_' . $i . '" imageId ="left_' . $i . '" type="button" class="show_all_images left_' . $i . '" style="width: 100%;height: 150px;position: absolute;opacity: 0;">click</button>';

                    $html .= '<img sid="left_' . $i . '" style="margin: auto;height:150px;" class="img-responsive" src="' . base_url() . '/assets/uploads/' . $left_data . '">';
                    $html .= '<input type="hidden" name="left_image_ans[]" class="left_image_ans_' . $i . '" value="' . $left_data . '">';
                } else {
                    $html .= '<button valueId="left_image_ans_' . $i . '" imageId ="left_' . $i . '" type="button" class="show_all_images left_' . $i . '" style="width: 100%;height: 150px;">click</button>';

                    $html .= '<img src="" id="left_' . $i . '" style="margin: auto;" class="img-responsive">';
                    $html .= '<input type="hidden" name="left_image_ans[]" class="left_image_ans_' . $i . '">';
                }
                $html .= '</div>';
            } else {
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';
                $html .= '<img style="height:150px;margin: auto;" class="img-responsive" src="' . base_url() . '/assets/uploads/' . $left_data . '">';

                $html .= '<input type="hidden" name="left_image_ans[]" class="left_image_ans_' . $i . '">';

                $html .= '</div>';
            }
            if ($leftAns[$key] == 1) {
                $html .= '<div class="col-sm-1">
                                            <span class="left_r_p_box_two_' . $i . '" style="display:block;position: absolute;font-weight:bold;top: 5px;color: green;">✓</span><span class="left_w_p_box_two_' . $i . '" style="display:none;position: absolute;font-weight:bold;top: 5px;color: red;">✖</span>
                                        </div>';
            } else {
                $html .= '<div class="col-sm-1">
                                            <span class="left_r_p_box_two_' . $i . '" style="display:none;position: absolute;font-weight:bold;top: 5px;color: green;">✓</span><span class="left_w_p_box_two_' . $i . '" style="display:none;position: absolute;font-weight:bold;top: 5px;color: red;">✖</span>
                                        </div>';
            }


            if ($right_memorize_h_p_three[$key] == 1) {
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';

                if ($rightAns[$key] == 1) {
                    $html .= '<button valueId="right_image_ans_' . $i . '" imageId ="right_' . $i . '" type="button" class="show_all_images right_' . $i . '" style="width: 100%;height: 150px;position: absolute;opacity: 0;">click</button>';
                    $html .= '<img  id="right_' . $i . '" style="margin: auto;height:150px;" class="img-responsive" src="' . base_url() . '/assets/uploads/' . $right_memorize_p_three[$key] . '">';
                    $html .= '<input type="hidden" name="right_image_ans[]" class="right_image_ans_' . $i . '" value="' . $right_memorize_p_three[$key] . '">';
                } else {
                    $html .= '<button valueId="right_image_ans_' . $i . '" imageId ="right_' . $i . '" type="button" class="show_all_images right_' . $i . '" style="width: 100%;height: 150px;">click</button>';
                    $html .= '<img src="" id="right_' . $i . '" style="margin: auto;" class="img-responsive">';
                    $html .= '<input type="hidden" name="right_image_ans[]" class="right_image_ans_' . $i . '">';
                }

                $html .= '</div>';
            } else {
                $html .= '<div class="col-sm-5" style="border:1px solid #ccc;">';
                $html .= '<img style="height:150px;margin: auto;" class="img-responsive" src="' . base_url() . '/assets/uploads/' . $right_memorize_p_three[$key] . '">';

                $html .= '<input type="hidden" name="right_image_ans[]" class="right_image_ans_' . $i . '">';
                $html .= '</div>';
            }

            if ($rightAns[$key] == 1) {
                $html .= '<div class="col-sm-1">
                                            <span class="right_r_p_box_two_' . $i . '" style="display:block;position: absolute;font-weight:bold;top: 5px;color: green;">✓</span><span class="right_w_p_box_two_' . $i . '" style="display:none;position: absolute;font-weight:bold;top: 5px;color: red;">✖</span>
                                        </div>';
            } else {
                $html .= '<div class="col-sm-1">
                                            <span class="right_r_p_box_two_' . $i . '" style="display:none;position: absolute;font-weight:bold;top: 5px;color: green;">✓</span><span class="right_w_p_box_two_' . $i . '" style="display:none;position: absolute;font-weight:bold;top: 5px;color: red;">✖</span>
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

        foreach ($tutorialInfo as $key => $item) {
            $active = '';
            if ($key == 0) {
                $active = 'active';
            }
            $html .= '<div class="item ' . $active . '" id="' . $item["speech"] . '">';
            $html .= '<img width="100%" height="100%" style="max-height: 78vh;" src="' . base_url('/') . 'assets/uploads/' . $item["img"] . '" alt="Tutorial Image">';
            $html .= '<input type="hidden" id="wordToSpeak" value="' . $item["speech"] . '">';
            $html .= '</div>';
        }

        echo $html;
    }

    public function organization()
    {
        if ($this->session->userdata('userType') == 6) {
            $data['video_help'] = $this->FaqModel->videoSerialize(15, 'video_helps');
            $data['video_help_serial'] = 15;
        }

        $_SESSION['prevUrl'] = base_url('/') . 'student';
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
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        if ($id == 1) {
            $data['video_help'] = $this->FaqModel->videoSerialize(16, 'video_helps');
            $data['video_help_serial'] = 16;
        }
        if ($id == 2) {
            $data['video_help'] = $this->FaqModel->videoSerialize(17, 'video_helps');
            $data['video_help_serial'] = 17;
        }

        $_SESSION['prevUrl'] = base_url('/') . 'student/organization';
        $_SESSION['prevUrl_after_student_finish_buton'] = base_url('/') . $_SERVER['PATH_INFO'];

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
        }
        if ($this->session->userdata('userType') == 4) {
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
        $data['allCountry']        = $this->Admin_model->search('tbl_country', [1 => 1]);

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
        if (isset($data['registered_courses'][0]['id'])) {

            $courses = $data['registered_courses'];
            foreach ($courses as $course) {
                $assign_course = $this->Student_model->getInfo('tbl_assign_subject', 'course_id', $course['id']);
                if (!empty($assign_course)) {
                    $subjectId = json_decode($assign_course[0]['subject_id']);
                    $i = 0;
                    foreach ($subjectId as $value) {
                        $sb =  $this->Student_model->getInfo('tbl_subject', 'subject_id', $value);
                        if (!empty($sb)) {
                            $std_subjects[] = $sb;
                        }
                        $i++;
                    }
                }
            }
        }
        $data['std_subjects'] =  $this->Student_model->getInfo('tbl_question_store_subject', 'created_by', 2);
        $first_subject = $std_subjects[0][0]['subject_id'];
        $chapter =  $this->Student_model->getInfo('tbl_chapter', 'subjectId', $first_subject);
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
        if ($subject_id != 0 && $grade != 0) {
            $conditions['grade']     = $grade;
            $conditions['subject']   = $subject_id;
            $store_data = $this->Student_model->getQuestionStore($conditions);
            $html = '';
            if (!empty($store_data)) {
                foreach ($store_data as $key => $item) {
                    $chapter_id = $item['chapter'];
                    $chapter =  $this->Student_model->getInfo('tbl_question_store_chapter', 'id', $chapter_id);
                    $html .= '<tr>';
                    $html .= '<td><a href="download_question_store/' . $item['id'] . '" store-id' . $item['id'] . '>' . $chapter[0]['chapter_name'] . '</a></td>';
                    $html .= '<td><img style="width:25px;"src="' . base_url('/') . 'assets/images/pdf-icon2.png"></td>';
                    $html .= '</tr>';
                }
            } else {
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

        if ($clean['grade'] != '') {
            $grade      = $clean['grade'];
        }
        if ($clean['subject_id'] != '') {
            $subject_id      = $clean['subject_id'];
        }
        if ($clean['country'] != '') {
            $country      = $clean['country'];
        }

        $result['error'] = 0;
        $result['msg'] = '';
        if ($subject_id != 0 && $grade != 0 &&  $country != 0) {
            $conditions['country']   = $country;
            $conditions['grade']     = $grade;
            $conditions['subject']   = $subject_id;

            $store_data = $this->Student_model->getQuestionStore($conditions);
            $html = '';
            if (!empty($store_data)) {
                foreach ($store_data as $key => $item) {
                    $chapter_id = $item['chapter'];
                    $chapter =  $this->Student_model->getInfo('tbl_question_store_chapter', 'id', $chapter_id);
                    $html .= '<tr>';
                    $html .= '<td><a href="download_question_store/' . $item['id'] . '" store-id' . $item['id'] . '>' . $chapter[0]['chapter_name'] . '</a></td>';
                    $html .= '<td><img style="width:25px;"src="' . base_url('/') . 'assets/images/pdf-icon2.png"></td>';
                    $html .= '</tr>';
                }
            } else {
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

            $store = $this->Student_model->getInfo('tbl_questions_store', 'id', $id);

            if (isset($store[0]['student_file'])) {
                $chapter =  $this->Student_model->getInfo('tbl_question_store_chapter', 'id', $store[0]['chapter']);
                $this->load->helper('download');
                $url = $store[0]['student_file'];
                $path = base_url() . $url;
                $content = file_get_contents($path);
                force_download($chapter[0]['chapter_name'] . '.pdf', $content);
            }
        }
    }

    public function yourClassRoom($id)
    {
        $roomInfo = $this->Student_model->getInfo('tbl_classrooms', 'id', $id);

        $havtutor = $this->Student_model->getInfo_tutor('tbl_enrollment', 'st_id', $this->session->userdata('user_id'));
        foreach ($havtutor as $key => $value) {
            $havtutor_2[] = $this->Student_model->getInfo('tbl_classrooms', 'tutor_id', $value['sct_id']);
        }

        $links = array();

        foreach ($havtutor_2 as $key => $value) {
            if (count($value)) {
                if ($value[0]['all_student_checked']) {
                    $link[0] = base_url('/yourClassRoom/') . $value[0]['id'];
                    $link[1] = $value[0]['tutor_name'];
                    $links[] = $link;
                    $link = array();
                } else {
                    $x = json_decode($value[0]['students']);
                    foreach ($x as $key => $val) {
                        if ($val == $this->session->userdata('user_id')) {
                            $link[0] = base_url('/yourClassRoom/') . $value[0]['id'];
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
            $data['ifram'] = '<iframe src="//www.groupworld.net/room/' . $roomInfo[0]['class_url'] . '/conf1?need_password=false&janus=true&hide_playback=true&username=' . $user_info[0]['name'] . '" allow="camera;microphone" width="100%" height="600" scrolling="no" frameborder="0"></iframe>';
        } else {
            redirect("404_override");
        }

        $data['maincontent'] = $this->load->view('students/whiteboardDashboard', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function st_answer_matching_storyWrite()
    {
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        //$question_order_id = $_POST['check_order_id'] - 1;
        $question_order_id = $this->input->post('current_order');
        $text = $this->input->post('answerGiven');
        //
        $find = array('&nbsp;', '\n', '\t', '\r');
        $repleace = array('', '', '', '');
        $text = strip_tags($text);
        $text = str_replace($find, $repleace, $text);
        $text = trim($text);

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);


        $question_marks = $answer_info[0]['questionMarks'];

        $text_1 = 1;
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

    public function homeworkModule()
    {

        $data = $this->ModuleModel->studentHomeworkModules($_POST['subjectId'], $_POST['tutorId'], $this->session->userdata('user_id'), $_POST['moduleType']);
        $row  = '';

        if (count($data)) {
            $row .= '<input type="hidden" id="first_module_id_assign" value="' . $data[0]['id'] . '">';

            foreach ($data as $key => $module) {

                $row .= '<tr>';
                $row .= '<td><a onclick="get_permissionAssignModule(' . $module['assign_module'] . ' , ' . $module['id'] . ' )" href="javascript:;">' . $module['module_name'] . '</a></td>';
                $row .= '<td>' . $module['trackerName'] . '</td>';
                $row .= '<td>' . $module['individualName'] . '</td>';
                $row .= '<td>' . $module['subject_name'] . '</td>';
                $row .= '<td>' . $module['chapter_name'] . '</td>';
                $row .= '</tr>';
            }
        }


        echo $row;
    }


    public function AssignModuleTutuorTutorial()
    {
        $data = $this->ModuleModel->AssignModuleTutuorTutorial($_POST['tutorId'], $this->session->userdata('user_id'), $_POST['moduleType']);
        if (count($data)) {
            echo 1;
        } else {
            echo "no module found";
        }
    }

    public function AssignModuleSchoolTutuorTutorial()
    {
        //$query = $this->db->where('student_id',$this->session->userdata('user_id'))
        //->where('moduletype',$_POST['moduleType'])->get('tbl_studentprogress')->result();
        //echo '<pre>';print_r($query);die();

        $data = $this->ModuleModel->AssignModuleSchoolTutuorTutorial($_POST['tutorId'], $this->session->userdata('user_id'), $_POST['moduleType']);
        // echo '<pre>';print_r($data);die();
        if (count($data)) {
            $i = '';
            $j = 0;
            foreach ($data as $key => $value) {
                $md_id =  $value['id'];
                $query = $this->db->where('student_id', $this->session->userdata('user_id'))
                    ->where('moduletype', $_POST['moduleType'])
                    ->where('module', $md_id)
                    ->get('tbl_studentprogress')
                    ->result();

                if (count($query)) {
                    $i = "no module found";
                } else {
                    $j = 1;
                }
            }

            if ($j == 1) {
                echo 1;
                die();
            } else {
                echo "no module found";
            }
        } else {
            echo "no module found";
        }
        //echo '<pre>';print_r($data);die();

    }


    public function price_dashboard()
    {
        $limit = 14;
        $offset = 0;
        $user_id = $this->session->userdata('user_id');
        $data['modulePoint'] = $this->db->where('user_id', $user_id)->get('module_points')->row();
        $modulePoint = $this->db->where('user_id', $user_id)->get('module_points')->row();
        $total_module_point = $modulePoint->point;

        $data['products']    = $this->db->limit($limit, $offset)->get('tbl_products')->result_array();
        $data['userAddress'] = $this->db->where('user_id', $user_id)->get('pro_user_address')->row();
        $data['productPoint'] = $this->db->where('user_id', $user_id)->get('product_poinits')->row();

        $userInfo = $this->db->where('id', $user_id)->get('tbl_useraccount')->row();
        $parent_id = $userInfo->parent_id;
        $country_id = $userInfo->country_id;

        $data['country'] = $this->db->where('id', $country_id)->get('tbl_country')->row();
        $data['parentInfo'] = $this->db->where('id', $parent_id)->get('tbl_useraccount')->row();

        $data['point'] = $this->db->where('user_id', $user_id)->get('target_points')->row();
        $point = $this->db->where('user_id', $user_id)->get('target_points')->row();
        $target_point = $point->targetPoint;
        $target = ($target_point * 10) / 100;
        $data['lessTarget'] = $target_point - number_format($target);
        $data['UpTarget']   = $target_point + number_format($target);
 
        
        $data['creative_point'] = $this->Student_model->getCreativePoint();

        //echo "<pre>";print_r($data['creative_point']);die();

        if ($total_module_point >= $target_point) {
            $bnsPoint = ($total_module_point - $target_point);
            $proPoint['user_id']      = $user_id;
            $proPoint['recent_point'] = $target_point;
            $proPoint['bonus_point']  = $bnsPoint;
            $proPoint['total_point']  = $total_module_point;

            $pointCheck  = $this->db->where('user_id', $user_id)->get('product_poinits')->row();
            // if ($pointCheck) {
            //     $this->db->where('user_id',$user_id)->update('product_poinits',$proPoint);
            // }else{
            //     $this->db->insert('product_poinits',$proPoint);
            // }

        }

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('students/product/prize_dashboard', $data, TRUE);
        $this->load->view('master_dashboard', $data);
    }

    public function get_all_products()
    {

        $products   = $this->db->get('tbl_products')->result_array();
        header('Content-Type: application/json');
        echo json_encode($products);
    }

    public function product_next_priview()
    {
        $limit = 14;
        $offset = $this->input->post('offset');

        $data['products']= $this->db->limit($limit, $offset)->get('tbl_products')->result_array();
        if (count($data['products']) == 0) {
            echo 'empty';
            die();
        }
        $returnHTML = $this->load->view('students/product/product_next_priview', $data, true);
        echo $returnHTML;
    }

    public function product_price()
    {

        $user_id = $this->session->userdata('user_id');
        $data['productPoint'] = $this->db->where('user_id', $user_id)->get('product_poinits')->row();
        $product_point = $this->db->where('user_id', $user_id)->get('product_poinits')->row();

        $id = $this->input->post('val');
        $data['product'] = $this->db->where('id', $id)->get('tbl_products')->row();
        $product = $this->db->where('id', $id)->get('tbl_products')->row();
        $single_product_point =   $product->product_point;
        $total_point =   $product_point->total_point;
        // echo '<pre>'; print_r($total_point); die();
        if ($total_point >=  $single_product_point) {
            $submit = 1;
        } else {
            $submit = 0;
        }

        $returnHTML = $this->load->view('students/product/product_details', $data, true);
        echo json_encode(['success' => true, 'html' => $returnHTML, 'submit' => $submit]);
    }

    public function get_product_prize_address()
    {
        $data['name'] = $this->input->post('name');
        $data['address'] = $this->input->post('address');
        $data['sub_city_town'] = $this->input->post('sub_city_town');
        $data['state'] = $this->input->post('state');
        $data['country'] = $this->input->post('country');
        $data['email'] = $this->input->post('email');
        $data['mobile'] = $this->input->post('mobile');
        $data['user_id'] = $this->session->userdata('user_id');
        $data['optional_note'] = $this->input->post('optional_note');

        $userAddress = $this->db->where('user_id', $this->session->userdata('user_id'))->get('pro_user_address')->num_rows();
        if ($userAddress == 0) {
            $this->db->insert('pro_user_address', $data);
        } else {
            $this->db->where('user_id', $this->session->userdata('user_id'))->update('pro_user_address', $data);
        }
        echo 'success';
    }


    public function get_products_prize()
    {

        $data['productId']    = $this->input->post('productId');
        $data['productPoint'] = $this->input->post('productPoint');
        $data['user_id']      = $this->session->userdata('user_id');
        $data['date']         = date('Y-m-d');
        $user_id = $this->session->userdata('user_id');

        $userAddress = $this->db->where('user_id', $user_id)->get('pro_user_address')->num_rows();
        if ($userAddress == 0) {
            echo 'error';
            die();
        }
        // print_r($data);die;
        $prizeWon = $this->db->insert('prize_won_users', $data);
        if ($prizeWon) {
            $this->db->where('user_id', $user_id)->where('status', 'unavailable')->delete('prize_won_users');
        }


        $productPoint = $this->db->where('user_id', $user_id)->get('product_poinits')->row();

        $r1 = $productPoint->recent_point - $data['productPoint'];
        if ($r1 >= 0) {
            $proData['recent_point'] = $r1;
        } else {
            $proData['recent_point'] = 0;
            $b1 = $productPoint->bonus_point + $r1;

            if ($b1 >= 0) {
                $proData['bonus_point'] = $b1;
            } else {
                $proData['bonus_point'] = 0;
                $ref1 = $productPoint->referral_point + $b1;
                $proData['referral_point'] = $ref1;
            }
        }

        $proData['total_point'] = $productPoint->total_point - $data['productPoint'];
        $proData['use_point'] = $productPoint->use_point + $data['productPoint'];
        $this->db->where('user_id', $user_id)->update('product_poinits', $proData);
        echo 'success';
    }

    public function product_prize_address_edit()
    {
        $user_id = $this->session->userdata('user_id');
        $userAddress = $this->db->where('user_id', $user_id)->get('pro_user_address')->row();
        echo json_encode($userAddress);
        // print_r($userAddress);
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

    public function profile_update()
    {
        $return=array();
		
		if(!empty($_FILES['profile_image']['name'])){
			$config['upload_path'] = './assets/uploads/profile/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|JPG';
			$config['file_name'] = time().$_FILES['profile_image']['name'];
			
            //Load upload library and initialize here configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('profile_image')){
				$uploadData = $this->upload->data();
				$profile_image = $uploadData['file_name'];
				$image_path = $config['upload_path'];
                // echo $uploadData['file_name'];
				$this->_create_thumbs($uploadData['file_name']);

			}else{
				$return['main_image_error']	= array('error' => $this->upload->display_errors());
				print_r($return['main_image_error']);die();
			}
		}else{
			$profile_image = 'no_image';
		}

        if($this->input->post('student_name')!=''){
            $data['student_name'] = $this->input->post('student_name');
        }else{
            $data['student_name'] =''; 
        }
        if($this->input->post('school_name')!=''){
            $data['school_name'] = $this->input->post('school_name');
        }else{
            $data['school_name'] =''; 
        }
        if($this->input->post('country')!=''){
            $data['country'] = $this->input->post('country');
        }else{
            $data['country'] =''; 
        }
        $data['profile_image'] = $profile_image;
        $data['user_id']      = $this->session->userdata('user_id');

        $this->db->select('*');
        $this->db->from('profile');
        $this->db->where('user_id',$data['user_id']);
        $query = $this->db->get();
        $result = $query->result_array();
        if(!empty($result)){
            $this->db->where('user_id', $data['user_id']);
            $this->db->update('profile', $data);
            $data['success']='Update Successfully !';
                $this->session->set_userdata($data);
                redirect($_SERVER['HTTP_REFERER']);

        }else{
            $insert_id=$this->Student_model->insertId('profile', $data);
            if(isset($insert_id)){
                $data['success']='Saved Successfully !';
                $this->session->set_userdata($data);
                redirect($_SERVER['HTTP_REFERER']);
            }

        }
        
    }

    function _create_thumbs($file_name){

		$config = array(
            // Medium Image
			array(
				'image_library' => 'GD2',
				'source_image'  => './assets/uploads/profile/'.$file_name,
				'maintain_ratio'=> FALSE,
				'width'         => 150,
				'height'        => 150,
				'new_image'     => './assets/uploads/profile/thumbnail/'.$file_name
			)
		);

		$this->load->library('image_lib');
		foreach ($config as $item){
			// print_r($item);
			$this->image_lib->initialize($item);
			if(!$this->image_lib->resize()){
				echo $this->image_lib->display_errors();
				return false;
			}
			$this->image_lib->clear();
		}
	}
    public function add_profile_info()
    {
        $return=array();
		
		if(!empty($_FILES['profile_image']['name'])){
			$config['upload_path'] = './assets/uploads/profile/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|JPG';
			$config['file_name'] = time().$_FILES['profile_image']['name'];
			
            //Load upload library and initialize here configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('profile_image')){
				$uploadData = $this->upload->data();
				$profile_image = $uploadData['file_name'];
				$image_path = $config['upload_path'];
                // echo $uploadData['file_name'];
				$this->_create_thumbs($uploadData['file_name']);

			}else{
				$return['main_image_error']	= array('error' => $this->upload->display_errors());
				print_r($return['main_image_error']);die();
			}
		}else{
			$profile_image = 'no_image';
		}

        if($this->input->post('student_name')!=''){
            $data['student_name'] = $this->input->post('student_name');
        }else{
            $data['student_name'] =''; 
        }
        if($this->input->post('school_name')!=''){
            $data['school_name'] = $this->input->post('school_name');
        }else{
            $data['school_name'] =''; 
        }
        if($this->input->post('country')!=''){
            $data['country'] = $this->input->post('country');
        }else{
            $data['country'] =''; 
        }
        $data['profile_image'] = $profile_image;
        $data['user_id']      = $this->session->userdata('user_id');

        $this->db->select('*');
        $this->db->from('profile');
        $this->db->where('user_id',$data['user_id']);
        $query = $this->db->get();
        $result = $query->result_array();
        if(!empty($result)){
            $this->db->where('user_id', $data['user_id']);
            $this->db->update('profile', $data);

            $this->db->select('*');
            $this->db->from('profile');
            $this->db->where('user_id',$data['user_id']);
            $queries = $this->db->get();
            $results = $queries->result_array();

            echo json_encode($results);

        }else{
            $insert_id=$this->Student_model->insertId('profile', $data);

            $this->db->select('*');
            $this->db->from('profile');
            $this->db->where('user_id',$data['user_id']);
            $queries = $this->db->get();
            $results = $queries->result_array();
            
            echo json_encode($results);

        }
    }

    public function st_creative_ans_save()
    {
        // echo "<pre>";print_r($this->input->post());die();

        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $question_order_id = $this->input->post('question_order_id');
        $idea_id = $this->input->post('idea_id');
        $student_idea_title = $this->input->post('student_idea_title');
        $module_type = $this->input->post('module_type');
        $preview_main_body = $this->input->post('student_ans');
        $total_word = $this->input->post('total_word');
        
        
        $question = $this->Student_model->getQuestionMark($question_id); 
        // echo "<pre>";print_r($question);die();
        $question_marks= $question[0]['questionMarks'];
        $ans_is_right = 'idea';
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        
        //echo $question_id;die();
        
        $data['module_id'] = $module_id;
        $data['question_id'] = $question_id;
        $data['idea_question_title'] = $question[0]['shot_question_title'];
        $data['idea_title'] = $student_idea_title;
        $data['idea_ans'] = $preview_main_body;
        $data['submit_date'] = date("Y/m/d");
        $data['total_word'] = $total_word;

        if($user_type==3){ 
            
            $data['user_id'] = $user_id;
            $data['type'] = 1;
            $check_idea = $this->Student_model->checktutorIdeaAns($module_id,$question_id,$idea_id,$user_id);
        }else{
            
            $data['user_id'] = $user_id;
            $data['type'] = 2;
            $check_idea = $this->Student_model->checkIdeaAns($module_id,$question_id,$user_id);
        }
        
        if(empty($check_idea)){
            $idea_ans_id = $this->Student_model->getIdeaAnsId($user_type,$data);
        }else{
            echo 9;
            return;
        }

        
        
        // echo $idea_ans_id;
        //  die();
        
        if ($module_type == 1) {
            $this->take_decesion_1($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        } else {
            $this->take_decesion_2($question_marks, $question_id, $module_id, $question_order_id, $ans_is_right);
        }
    }
    public function submited_student_idea(){ 

         $student_id= $this->input->post('student_id');
         $question_id= $this->input->post('question_id');
         $idea_id= $this->input->post('idea_id');
        
        $data['get_idea'] = $this->Student_model->get_submited_student_idea($student_id,$idea_id);
        $data['profile_info'] = $this->Student_model->get_profile_information($student_id);
        $data['teacher_correction'] = $this->Student_model->get_teacher_correction($student_id,$question_id,$module_id);
        $data['country'] = $this->Student_model->get_country_info($data['profile_info'][0]['country_id']);
        //$data['idea_information'] = $this->Student_model->get_idea_information($student_id);
        
        // print_r($data['teacher_correction']);die();
        echo json_encode($data);
    }
    
    public function submited_tutor_idea(){
 
        $tutor_id= $this->input->post('tutor_id');
        $idea_id= $this->input->post('idea_id');
        $question_id= $this->input->post('question_id');
        //echo $tutor_id.'/'.$idea_id.'/'.$question_id;die();
        $data['get_idea'] = $this->Student_model->get_submited_tutor_idea($tutor_id,$idea_id);
        $data['profile_info'] = $this->Student_model->get_profile_information_tutor($tutor_id);
        $data['teacher_correction'] = $this->Student_model->get_teacher_correction_tutor($tutor_id,$idea_id);
        $data['country'] = $this->Student_model->get_country_info_tutor($data['profile_info'][0]['country_id']);
        $data['idea_information'] = $this->Student_model->get_idea_information_tutor($idea_id,$tutor_id);
        
        // echo 'hello'.$data['profile_info'][0]['country_id'];die();
        echo json_encode($data);
    }
    public function check_student_grade(){
        $data['checker_id']= $this->input->post('checker_id');
        $data['submited_student_id']= $this->input->post('submited_student_id');
        $data['question_id']= $this->input->post('question_id');

        $this->db->select('*');
        $this->db->from("idea_correction_report_student");
        $this->db->where('checker_id',  $data['checker_id']);
        $this->db->where('submited_student_id', $data['submited_student_id']);
        $this->db->where('question_id', $data['question_id']);
        
        $query = $this->db->get();
        $check = $query->row();
        if(!empty($check)){
           $res = json_encode($check);
           echo $res;
        }else{
           $res = 2;
           echo $res;
        }

    }
    public function submit_student_grade(){
        
        $data['checker_id']= $this->input->post('checker_id');
        $data['submited_student_id']= $this->input->post('submited_student_id');
        $data['idea_id']= $this->input->post('idea_id');
        $data['idea_no']= $this->input->post('idea_no');
        $data['question_id']= $this->input->post('question_id');
        $data['module_id']= $this->input->post('module_id');
        $data['checked_checkbox']= json_encode($this->input->post('checked_checkbox'));
        $data['total_point']= $this->input->post('total_point');
        
        // $this->db->insert('target_points', $data);
        $this->db->select('*');
        $this->db->from("idea_correction_report_student");
        $this->db->where('checker_id',  $data['checker_id']);
        $this->db->where('submited_student_id', $data['submited_student_id']);
        $this->db->where('idea_id', $data['idea_id']);
        $this->db->where('idea_no', $data['idea_no']);
        $this->db->where('question_id', $data['question_id']);
        $this->db->where('module_id', $data['module_id']);
        
        $query = $this->db->get();
        $check = $query->row();
        
        if(empty($check)){
            $this->db->insert("idea_correction_report_student", $data);
            $insert_id = $this->db->insert_id();
            
            $this->db->select('*');
            $this->db->from('idea_get_student_point');
            $this->db->where('student_id', $this->session->userdata('user_id'));
            $this->db->order_by('id','desc');
            $this->db->limit(1);
            $query = $this->db->get();
            $get_point = $query->row_array();
            
            $total_point = $get_point['student_point']+9;

            $data_point['question_id']=$data['question_id'];
            $data_point['student_id']=$this->session->userdata('user_id');
            $data_point['student_point']=$total_point;
            $data_point['purpose']="Put Student Grade";
            $this->db->insert('idea_get_student_point', $data_point); 

            $this->db->select('*');
            $this->db->from('idea_get_student_point');
            $this->db->where('student_id', $this->session->userdata('user_id'));
            $this->db->order_by('id','desc');
            $this->db->limit(1);
            $query = $this->db->get();
            $data2['student_point'] = $query->row_array();
            $data2['status'] = 1;
            
            echo json_encode($data2);
          
        }else{
           
            $this->db->where('id', $check->id);
            $this->db->update("idea_correction_report_student", $data);
            
            $this->db->select('*');
            $this->db->from('idea_get_student_point');
            $this->db->where('student_id', $this->session->userdata('user_id'));
            $this->db->order_by('id','desc');
            $this->db->limit(1);
            $query = $this->db->get();
            $data2['student_point'] = $query->row_array();

            $data2['status'] = 2;
            
            echo json_encode($data2);
        }
        
    }
    public function add_tutor_like(){
        
        //echo "hello";die();
        $data['question_id']= $this->input->post('question_id');
        $data['module_id']= $this->input->post('module_id');
        $data['idea_id']= $this->input->post('idea_id');
        $data['idea_no']= $this->input->post('idea_no');
        $data['tutor_id']= $this->input->post('tutor_id');
        $data['student_id'] = $this->session->userdata('user_id');
        // print_r($data);die();
        $check_like = $this->Student_model->tutor_like_save($data);
       
        if(empty($check_like)){
            $data['is_like']=1;
            $this->db->insert('tutor_like_info', $data); 


            $this->db->select('*');
            $this->db->from('idea_get_student_point');
            $this->db->where('student_id', $this->session->userdata('user_id'));
            $query = $this->db->get();
            $get_point = $query->row_array();
            
            $total_point = $get_point['student_point']+3;

            $data_point['question_id']=$data['question_id'];
            $data_point['student_id']=$this->session->userdata('user_id');
            $data_point['student_point']=$total_point;
            $data_point['purpose']="tutor like";
            $this->db->insert('idea_get_student_point', $data_point); 

            $this->db->select('*');
            $this->db->from('tutor_total_like');
            $this->db->where('tutor_id', $data['tutor_id']);
            $this->db->where('question_id', $data['question_id']);
            $query = $this->db->get();
            $result = $query->row_array();
            
            if(empty($result)){
            $like['tutor_id'] = $data['tutor_id'];
            $like['question_id'] = $data['question_id'];
            $like['total_like'] = 1;
            $this->db->insert('tutor_total_like', $like);
            }else{
                $like['total_like'] = $result['total_like']+1;
                $this->db->where('tutor_id',$data['tutor_id']);
                $this->db->update("tutor_total_like", $like);

            }
            $data2['total_like']=$like['total_like'];
            $data2['insert_or_update']=1;

            $this->db->select('*');
            $this->db->from('idea_get_student_point');
            $this->db->where('student_id', $this->session->userdata('user_id'));
            $this->db->order_by('id','desc');
            $this->db->limit(1);
            $query = $this->db->get();
            $data2['student_point'] = $query->row_array();

            echo json_encode($data2);

        }else{
            $this->db->select('*');
            $this->db->from('tutor_total_like');
            $this->db->where('tutor_id', $data['tutor_id']);
            $this->db->where('question_id', $data['question_id']);
            $this->db->order_by('id','desc');
            $this->db->limit(1);
            $query = $this->db->get();
            $result = $query->row_array();

            $data2['total_like']=$result['total_like'];
            $data2['insert_or_update']=2;

            $this->db->select('*');
            $this->db->from('idea_get_student_point');
            $this->db->where('student_id', $this->session->userdata('user_id'));
            $this->db->order_by('id','desc');
            $this->db->limit(1);
            $query = $this->db->get();
            $data2['student_point'] = $query->row_array();

            echo json_encode($data2);
        }
    }
    
    public function comment_story_title()
    {
        $data['question_id']= $this->input->post('question_id');
        $data['module_id']= $this->input->post('module_id');
        $data['student_id']= $this->input->post('student_id');

        $this->db->select('*');
        $this->db->from('tutor_remake_idea_info');
        $this->db->where('question_id',$data['question_id']);
        $this->db->where('module_id',$data['module_id']);
        $this->db->where('student_id',$data['student_id']);
        $queries = $this->db->get();
        $results = $queries->result_array();

        // echo $this->db->last_query();die();
        // echo "<pre>";print_r($results);die();

        $data['story_title_comment']= $results[0]['title_comment'];
        $data['story_title_mark']=$results[0]['title_mark'];
        echo json_encode($data);
    }
    public function student_word_get() 
    {
        $data['question_id']= $this->input->post('question_id');
        $data['module_id']= $this->input->post('module_id');
        $data['student_id']= $this->input->post('student_id');

        $this->db->select('*');
        $this->db->from('tutor_remake_idea_info');
        $this->db->where('question_id',$data['question_id']);
        $this->db->where('module_id',$data['module_id']);
        $this->db->where('student_id',$data['student_id']);
        $queries = $this->db->get();
        $results = $queries->result_array();
        
        $spelling_error = json_decode($results[0]['spelling_error'],true);
        // echo "<pre>";print_r($spelling_error);die();

        foreach($spelling_error as $spell){
            $data2['word_index'][]= $spell['word_index'];
            $data2['correct_words'][]= $spell['correct_words'];
        }
        
        // echo "<pre>";print_r($data2);die();
        // $data['word_index']=['24','60'];
        // $data['correct_words']=['different','strew'];

        echo json_encode($data2);
    }
    public function student_creative_sentence_get()
    {
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $student_id = $this->input->post('student_id');

        $this->db->select('*');
        $this->db->from('tutor_remake_idea_info');
        $this->db->where('question_id',$question_id);
        $this->db->where('module_id',$module_id);
        $this->db->where('student_id',$student_id);
        $queries = $this->db->get();
        $results = $queries->result_array();
        
        $data['sentence_index'] = explode(',',$results[0]['creative_sentence_index']);
        // echo "<pre>";print_r($creative_index);die();
        // $data['sentence_index']=['3','6','7'];

        echo json_encode($data);
    }

    public function student_conclusion_sentence_get()
    {
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $student_id = $this->input->post('student_id');

        $this->db->select('*');
        $this->db->from('tutor_remake_idea_info');
        $this->db->where('question_id',$question_id);
        $this->db->where('module_id',$module_id);
        $this->db->where('student_id',$student_id);
        $queries = $this->db->get();
        $results = $queries->result_array();

        $data['conclusion_sentence_index'] = $results[0]['conclution_sentence_index'];
        echo json_encode($data);
    }

    public function student_conclusion_comment()
    {
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $student_id = $this->input->post('student_id');

        $this->db->select('*');
        $this->db->from('tutor_remake_idea_info');
        $this->db->where('question_id',$question_id);
        $this->db->where('module_id',$module_id);
        $this->db->where('student_id',$student_id);
        $queries = $this->db->get();
        $results = $queries->result_array();

        $data['conclusion_comment']= $results[0]['conclution_comment'];
        $data['conclusion_mark']= $results[0]['conclution_mark'];
        echo json_encode($data);
    }
    
    public function student_introduction_sentence_get()
    {
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $student_id = $this->input->post('student_id');

        $this->db->select('*');
        $this->db->from('tutor_remake_idea_info');
        $this->db->where('question_id',$question_id);
        $this->db->where('module_id',$module_id);
        $this->db->where('student_id',$student_id);
        $queries = $this->db->get();
        $results = $queries->result_array();

        $data['introduction_sentence_index']= $results[0]['introduction_sentence_index'];
        echo json_encode($data);
    }

    public function student_introduction_comment()
    {
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $student_id = $this->input->post('student_id');

        $this->db->select('*');
        $this->db->from('tutor_remake_idea_info');
        $this->db->where('question_id',$question_id);
        $this->db->where('module_id',$module_id);
        $this->db->where('student_id',$student_id);
        $queries = $this->db->get();
        $results = $queries->result_array();

        $data['introduction_comment']= $results[0]['introduction_comment'];
        $data['introduction_mark']= $results[0]['introduction_mark'];
        echo json_encode($data);
    }

    public function student_body_sentence_get()
    {
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $student_id = $this->input->post('student_id');

        $this->db->select('*');
        $this->db->from('tutor_remake_idea_info');
        $this->db->where('question_id',$question_id);
        $this->db->where('module_id',$module_id);
        $this->db->where('student_id',$student_id);
        $queries = $this->db->get();
        $results = $queries->result_array();

        $data['body_sentence_index']= $results[0]['body_paragraph_sentence_index'];
        echo json_encode($data);
    }

    public function student_body_comment()
    {
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $student_id = $this->input->post('student_id');

        $this->db->select('*');
        $this->db->from('tutor_remake_idea_info');
        $this->db->where('question_id',$question_id);
        $this->db->where('module_id',$module_id);
        $this->db->where('student_id',$student_id);
        $queries = $this->db->get();
        $results = $queries->result_array();

        $data['body_comment']= $results[0]['body_paragraph_comment'];
        $data['body_mark']= $results[0]['body_paragraph_mark'];
        echo json_encode($data);
    }

    public function submited_student_idea_point()
    {
        $student_id= $this->input->post('student_id');
        $question_id= $this->input->post('question_id');
        $total_point= $this->input->post('total_point');
        $data['student_id']=$student_id;
        $data['question_id']=$question_id;
        $data['student_point']=$total_point;
        
        $this->db->insert('idea_get_student_point', $data);

        $data='successfully insert';
        echo json_encode($data);
    }

    public function student_idea_ans_report($module_id,$student_id){
        // echo $module_id.'//'.$student_id;die();
        $data['idea_infos'] = $this->Student_model->get_idea_achieve_point_info($module_id,$this->session->userdata('user_id'));
        // echo "<pre>";print_r($data['idea_infos']);die();

        $data['user_id'] = $this->session->userdata('user_id');

        $data['page_title'] = '.:: Q-Study :: Idea Report..';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('students/student_ans_idea_report', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function get_student_submited_idea_info()
    {
        $question_id = $this->input->post('question_id');
        $idea_id = $this->input->post('idea_id');
        $student_id = $this->input->post('student_id');

        $this->db->select('*');
        $this->db->from('question_ideas');
        $this->db->join('tbl_useraccount', 'question_ideas.user_id = tbl_useraccount.id', 'LEFT');
        $this->db->join('profile', 'question_ideas.user_id = profile.user_id', 'LEFT');
        $this->db->join('tbl_country', 'tbl_country.id = tbl_useraccount.country_id', 'LEFT');
        $this->db->where('question_ideas.question_id',$question_id);
        $this->db->where('question_ideas.id',$idea_id);
        $this->db->where('question_ideas.user_id',$student_id);
        $queries = $this->db->get();
        $results = $queries->result_array();
        echo $this->db->last_query();
        echo json_encode($results[0]);
    }
    public function students_get_point_save(){

        $question_id = $this->input->post('question_id');
        $idea_id = $this->input->post('idea_id');
        $get_points = $this->input->post('get_point');

        $this->db->select('*');
        $this->db->from('idea_get_student_point');
        $this->db->where('student_id', $this->session->userdata('user_id'));
        $this->db->where('question_id', $question_id);
        $this->db->where('idea_id', $idea_id);
        $queries = $this->db->get();
        $results = $queries->result_array();

        if(empty($results)){
            $this->db->select('*');
            $this->db->from('idea_get_student_point');
            $this->db->where('student_id', $this->session->userdata('user_id'));
            $this->db->order_by('id','desc');
            $this->db->limit(1);
            $query = $this->db->get();
            $get_point = $query->row_array();
            
            $total_point = $get_point['student_point']+$get_points;
    
            $data_point['question_id']=$question_id;
            $data_point['student_id']=$this->session->userdata('user_id');
            $data_point['student_point']=$total_point;
            $data_point['purpose']="Idea give point";
            $data_point['get_last_point']=$get_points;
            $data_point['idea_id']=$idea_id;
    
            $insert = $this->db->insert('idea_get_student_point', $data_point);
            if($insert){
                echo 1;
             }
        }else{
            echo 2;
        }
    }
    public function update_student_idea_serial(){
        $allSerial = $this->input->post('allSerial');
        $ideaIds = $this->input->post('ideaIds');
        $oldIdeaIds = $this->input->post('oldIdeaIds');

        // $data['allSerial'] = $allSerial;
        // $data['ideaIds'] = $ideaIds;
        // $data['oldIdeaIds'] = $oldIdeaIds;
        // echo "<pre>";print_r($data);die();

        foreach($oldIdeaIds as $key=>$oldIdeaId){
            $data2['serial'] = $allSerial[$key];
            $this->db->where('id',$oldIdeaId);
            $this->db->update('question_ideas',$data2);
        }
        //echo 1;
    }
} 
