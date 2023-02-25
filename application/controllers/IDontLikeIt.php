<?php

class IDontLikeIt extends CI_Controller
{

    public $loggedUserId;

    public function __construct()
    {
        parent::__construct();

        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        $this->loggedUserId = $user_id;

        if ($user_id == null && $user_type == null) {
            redirect('welcome');
        }
        if ($user_type != 3 && $user_type != 7) {
            redirect('welcome');
        }
        $this->load->model('Preview_model');
        $this->load->model('tutor_model');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function question_preview($question_item, $question_id)
    {
        // print_r($question_item);die;
        if ($question_item == 1) {
            $this->general($question_item, $question_id);
        } elseif ($question_item == 2) {
            $this->true_false($question_item, $question_id);
        } elseif ($question_item == 3) {
            $this->preview_vocubulary($question_item, $question_id);
        } elseif ($question_item==4) {
            $this->preview_multiple_choice($question_item, $question_id);
        } elseif ($question_item==5) {
            $this->preview_multiple_response($question_item, $question_id);
        } elseif ($question_item == 6) {
            $this->preview_skip($question_item, $question_id);
        } elseif ($question_item == 7) {
            $this->preview_matching($question_item, $question_id);
        } elseif ($question_item == 8) {
            $this->preview_skip($question_item, $question_id);
        }
    }
	public function answer_matching_workout_two()
    {
        $question_id = $_POST['question_id'];
        
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $answer_store = $answer_info[0]['answer'];

        
            echo 1;
       
    }

    private function general($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        //echo '<pre>';print_r($data['question_info']);die;
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('preview/question_image', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    private function true_false($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('preview/true_false', $data, true);
        
        $this->load->view('master_dashboard', $data);
    }

    private function preview_vocubulary($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        //echo '<pre>';print_r($question_id);die;
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('preview/preview_vocubulary', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    private function preview_multiple_choice($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
        
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('preview/preview_multiple_choice', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    private function preview_multiple_response($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
        
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('preview/preview_multiple_response', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    private function preview_matching($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_total'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info_left_right'] = json_decode($data['question_info_total'][0]['questionName']);

        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        
        //        echo '<pre>';print_r($data['question_info_left_right']);die;
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('preview/preview_matching', $data, true);
        
        $this->load->view('master_dashboard', $data);
    }

    /**
     * preview question type skip quiz
     *
     * @param  int $questionId questionId
     * @return void
     */
    public function preview_skip($question_item, $questionId)
    {

        $quesInfo     = $this->Preview_model->getInfo('tbl_question', 'id', $questionId);
        $data['question_info_s']   = $quesInfo;
        $questionType = $quesInfo[0]['questionType'];
        $quesInfo     = json_decode($quesInfo[0]['questionName']);
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        // common view file
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $data['question_id'] = $questionId;
        $data['question_item'] = $question_item;

        if ($questionType == 8) {
            // Assignment
            $questionBody            = isset($quesInfo->question_body) ? $quesInfo->question_body : '';
            $data['questionBody']    = $questionBody;
            $items                   = $quesInfo->assignment_tasks;
            $data['totalItems']      = count($items);
            $data['assignment_list'] = $this->renderAssignmentTasks($items);
            $data['maincontent']     = $this->load->view('preview/assignment', $data, true);
        } elseif ($questionType == 6) {
            // skip quiz
            $data['numOfRows']    = isset($quesInfo->numOfRows) ? $quesInfo->numOfRows : 0;
            $data['numOfCols']    = isset($quesInfo->numOfCols) ? $quesInfo->numOfCols : 0;
            $data['questionBody'] = isset($quesInfo->question_body) ? $quesInfo->question_body : '';
            $data['questionId']   = $questionId;
            
            //            echo '<pre>';print_r($data['question_info_s']);die;
            $quesAnsItem          = $quesInfo->skp_quiz_box;

            $items = $this->indexQuesAns($quesAnsItem);

            $data['skp_box'] = $this->renderSkpQuizPrevTable($items, $data['numOfRows'], $data['numOfCols']);

            $user_id             = $this->session->userdata('user_id');
            $data['all_grade']   = $this->tutor_model->getAllInfo('tbl_studentgrade');
            $data['all_subject'] = $this->tutor_model->getInfo('tbl_subject', 'created_by', $user_id);
            $data['maincontent'] = $this->load->view('preview/skip_quiz', $data, true);
        }//end if
        
        //        echo '<pre>';print_r($data['skp_box']);die;
        $this->load->view('master_dashboard', $data);
    }
    
    public function answer_matching()
    {
        $question_id = $_POST['id'];

        $text = $_POST['user_answer'];
        $find = array('&nbsp;', '\n', '\t', '\r');
        $repleace = array('', '', '', '');
        $text = strip_tags($text);
        $text = str_replace($find, $repleace, $text);
        $text = trim($text);
  
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

        $text_1 = $answer_info[0]['answer'];
        $find = array('&nbsp;', '\n', '\t', '\r');
        $repleace = array('', '', '', '');
        $text_1 = strip_tags($text_1);
        $text_1 = str_replace($find, $repleace, $text_1);
        $text_1 = trim($text_1);
        if ($text == $text_1) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function answer_matching_true_false()
    {
        $this->form_validation->set_rules('answer', 'answer', 'required');
        if ($this->form_validation->run() == false) {
            echo 1;
        } else {
            $answer = $this->input->post('answer');
            $question_id = $this->input->post('question_id');
            $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
            $text_1 = $answer_info[0]['answer'];
            if ($answer == $text_1) {
                echo 2;
            } else {
                echo 3;
            }
        }
    }

    public function answer_matching_vocabolary()
    {
        $this->form_validation->set_rules('answer', 'answer', 'required');
        if ($this->form_validation->run() == false) {
            echo 1;
        } else {
            $answer = strtolower($this->input->post('answer'));
            $question_id = $this->input->post('question_id');
            $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
            $text_1 = strtolower($answer_info[0]['answer']);
            if ($answer == $text_1) {
                echo 2;
            } else {
                echo 3;
            }
        }
    }
    
    public function answer_matching_multiple_choice()
    {
        $question_id = $_POST['id'];
        $answer_reply = $_POST['answer_reply'];
        
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
       
        
        // $answer_store = $answer_info[0]['answer'];
        
        // if ($answer_store == $answer_reply) {
        //     echo 1;
        // } else {
        //     echo 0;
        // }
        
        //ADDED AS
        $answer_store = json_decode($answer_info[0]['answer']);
        
        $result_count = count(array_intersect($answer_reply, $answer_store));
        
        if ($result_count == count($answer_store) && count($answer_reply) == count($answer_store)) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    public function answer_matching_multiple_response()
    {
        $question_id = $_POST['id'];
        $answer_reply = $_POST['answer_reply'];
        
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $answer_store = json_decode($answer_info[0]['answer']);
        
        $result_count = count(array_intersect($answer_reply, $answer_store));
        
        if ($result_count == count($answer_store) && count($answer_reply) == count($answer_store)) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    public function answer_creative_quiz()
    {
        $question_id = $this->input->post('question_id');
        $student_ans = $this->input->post('answer');
        $paragraph = $this->input->post('paragraph');
        
        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $answer_info['questionName'] = json_decode($answer_info[0]['questionName']);
        $answer_info['tutor_ans'] = json_decode($answer_info[0]['answer']);

//        $answer_store = json_decode($answer_info[0]['answer']);
        
//        $result_count = count(array_intersect($student_ans, $answer_store));
        $flag = 1;
        if(count($student_ans) != count($answer_info['tutor_ans'])){
            $flag = 0;
        } else {
            for ($k = 0; $k < sizeof($answer_info['tutor_ans']); $k++) {
                if ($student_ans[$k] != $answer_info['tutor_ans'][$k]) {
                    $flag = 0;
                }
            }
            
            for ($k = 0; $k < sizeof($answer_info['questionName']->paragraph_order); $k++) {
                if ($paragraph[$k] != $answer_info['questionName']->paragraph_order[$k]) {
                    $flag = 0;
                }
            }
        }
        
        //        echo $result_count;die;
//        for ($k = 0; $k < sizeof($student_ans); $k++) {
//            if ($student_ans[$k] != $answer_store[$k]) {
//                $flag = 0;
//            }
//        }
        if ($flag == 1) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    public function answer_times_table()
    {
        $question_id = $this->input->post('question_id');
        $result = $this->input->post('result');
        
        $answer = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $answer_info['tutor_ans'] = json_decode($answer[0]['answer']);
        
        $answer_info['student_ans'] = $result;
        
        $result_count = count(array_intersect($answer_info['student_ans'], $answer_info['tutor_ans']));
        
        if ($result_count == count($answer_info['tutor_ans']) && count($answer_info['student_ans']) == count($answer_info['tutor_ans'])) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    public function answer_algorithm()
    {
        
        $question_id = $this->input->post('question_id');
        $result = $this->input->post('answer');

        $answer = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $question_info = json_decode($answer[0]['questionName'], true);
        $answer_info['tutor_ans'] = json_decode($answer[0]['answer']);


        $answer_info['student_ans'] = $result;

        if ($question_info['operator'] != '/' && $answer_info['student_ans'] == $answer_info['tutor_ans']) {
            echo 1;
        } elseif ($question_info['operator'] == '/') {// && $result[1] == $answer_info['tutor_ans']
            $stGivenQuotient = $result[0];
            $stGivenRemainder = $result[1];

            $recordedQuotient = $question_info['quotient'];
            $recordedRemainder = $answer_info['tutor_ans'];

            echo ($stGivenQuotient==$recordedQuotient) && ($stGivenRemainder==$recordedRemainder) ? 1 : 0;
        } else {
            echo 0;
        }
    }

    //    Question Edit Portion

    public function question_edit($question_item, $question_id)
    {
        if ($question_item == 1) {
            $this->edit_general($question_item, $question_id);
        } elseif ($question_item == 2) {
            $this->edit_true_false($question_item, $question_id);
        } elseif ($question_item == 3) {
            $this->edit_preview_vocubulary($question_item, $question_id);
        }
    }

    private function edit_general($item, $question_id)
    {
        $data['question_info'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
        $data['question_item'] = $item;
        $data['question_id'] = $question_id;
        $user_id = $this->session->userdata('user_id');
        $data['all_grade'] = $this->Preview_model->getAllInfo('tbl_studentgrade');
        $data['all_subject'] = $this->Preview_model->getInfo('tbl_subject', 'created_by', $user_id);
        $subject_id = $data['question_info'][0]['subject'];
        $data['subject_base_chapter'] = $this->Preview_model->getInfo('tbl_chapter', 'subjectId', $subject_id);
        $data['question_box'] = $this->load->view('question_edit/question-box/general', $data, true);
        $data['maincontent'] = $this->load->view('question_edit/edit_question', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    private function edit_true_false($item, $question_id)
    {
        $data['question_info'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
        $data['question_item'] = $item;
        $data['question_id'] = $question_id;
        $user_id = $this->session->userdata('user_id');
        $data['all_grade'] = $this->Preview_model->getAllInfo('tbl_studentgrade');
        $data['all_subject'] = $this->Preview_model->getInfo('tbl_subject', 'created_by', $user_id);
        $subject_id = $data['question_info'][0]['subject'];
        $data['subject_base_chapter'] = $this->Preview_model->getInfo('tbl_chapter', 'subjectId', $subject_id);
        $data['question_box'] = $this->load->view('question_edit/question-box/true-false', $data, true);
        $data['maincontent'] = $this->load->view('question_edit/edit_question', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    private function edit_preview_vocubulary($item, $question_id)
    {
        $data['question_info'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
        $data['question_item'] = $item;
        $data['question_id'] = $question_id;
        $user_id = $this->session->userdata('user_id');
        $data['all_grade'] = $this->Preview_model->getAllInfo('tbl_studentgrade');
        $data['all_subject'] = $this->Preview_model->getInfo('tbl_subject', 'created_by', $user_id);
        $subject_id = $data['question_info'][0]['subject'];
        $data['subject_base_chapter'] = $this->Preview_model->getInfo('tbl_chapter', 'subjectId', $subject_id);
        $data['question_box'] = $this->load->view('question_edit/question-box/edit_vocubulary', $data, true);
        $data['maincontent'] = $this->load->view('question_edit/edit_question', $data, true);
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
                $show_data_array[$key][0] = '';
                $show_data_array[$key][1] = 0;
            }else
            {
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
        foreach ($left_memorize_p_four as $key=>$item) {
                if ($left_memorize_h_p_four[$key] == 0)
                {
                    $show_data_array[$key]['left'] = $item;
                    $show_data_array[$key]['right'] = $right_memorize_p_four[$key];
                }else
                {
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
        foreach ($left_memorize_p_four as $key=>$item) {
            if ($left_memorize_h_p_four[$key] == 0)
            {
                $show_data_array[$key][0] = '';
                $show_data_array[$key][1] = 0;
            }else
            {
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

    public function preview_memorization_pattern_four_matching()
    {
        $show_data_array = array();
        $question_id = $this->input->post('question_id');
        $start_memorization_four_value = $this->input->post('start_memorization_four_value');
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $question_id);
        $question_name = json_decode($question_info[0]['questionName']);
        if ($start_memorization_four_value == 1)
        {
            $show_data_array['show_data_array'] = $this->memorization_ans_data_four($question_name);
            $show_data_array['all_correct'] = 1;
        }else
        {
            $show_data_array['show_data_array'] = $this->memorization_hide_data_four($question_name);
            $show_data_array['all_correct'] = 0;
        }
        // echo "<pre>";print_r($show_data_array);die();
        echo json_encode($show_data_array);
    }
    public function preview_memorization_pattern_one_ans_matching()
    {
        $data = array();
        $question_id = $this->input->post('question_id');
        $word_matching = $this->input->post('word_matching');
        $submit_cycle = $this->input->post('submit_cycle');
        //echo $submit_cycle;
        //die();
        $pattern = $this->input->post('pattern');
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $question_id);
        $question_name = json_decode($question_info[0]['questionName']);
        $show_data_array = array();
        $word_matching_answer = array();
        $all_correct_status = 1;
        $left_memorize_h_p_one = $question_name->left_memorize_h_p_one;
        $left_memorize_p_one = $question_name->left_memorize_p_one;
        $left_memorize_p_one = array_map('strtolower', $left_memorize_p_one);

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
                    if (preg_replace('/\s+/', '', strtolower($show_data))   == preg_replace('/\s+/', '', strtolower($word_matching_item)) )
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
                    $data_array[] =trim($left_memorize_p_one[$key]);
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
                if ( preg_replace('/\s+/', '', strtolower($left_memorize_p_one[$key])) == preg_replace('/\s+/', '', strtolower($word_matching[$key] )) )
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


    // four patten
    public function preview_memorization_pattern_four_ans_matching()
    {
        $data = array();
        $question_id = $this->input->post('question_id');
        $word_matching = $this->input->post('word_matching');
        $submit_cycle = $this->input->post('submit_cycle');
        //echo $submit_cycle;
        //die();
        // echo '<pre>';
        // print_r($this->input->post());
        // die();
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
        if ($submit_cycle != 1)
        {
            foreach ($right_memorize_p_four as $key=>$item) {
                if ($right_memorize_h_p_four[$key] == 1)
                {
                    $show_data_array[] = $item;
                }else
                {
                    $show_data_array[] = '';
                }
            }
        // echo '<pre>';
        // print_r($show_data_array);
        // die();
            foreach($show_data_array as $key=>$show_data)
            {
                if ($show_data != '')
                {
                    $word_matching_item = $word_matching[$key];
                    if (preg_replace('/\s+/', '', strtolower($show_data))   == preg_replace('/\s+/', '', strtolower($word_matching_item)) )
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
                    $data_array[] =$left_memorize_p_four[$key];
                }else
                {
                    $data_array[] = '';
                }
            }
            $data['word_matching_answer'] =$word_matching_answer;
            $data['data_array'] =$data_array;
            $data['all_correct_status'] =$all_correct_status;
            $data['status'] =  0;

            // echo '<pre>';
            // print_r($data);
            // die();
        }else{

            $word_matching = $this->input->post('word_matching');
            $show_data_array = array();
            $left_memorize_h_p_four = $question_name->left_memorize_h_p_four;
            $left_memorize_p_four = $question_name->left_memorize_p_four;
            $left_memorize_p_four = array_map('strtolower', $left_memorize_p_four);
            $correct_status = 1;
            $leftSileData = array();
            $word_matching_answer = array();
            foreach ($left_memorize_p_four as $key=>$item) {
                if ( preg_replace('/\s+/', '', strtolower($left_memorize_p_four[$key])) == preg_replace('/\s+/', '', strtolower($word_matching[$key] )) )
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
    public function preview_memorization_pattern_four_try()
    {
        $data = array();
        $correctAnswerSession = $this->session->userdata('correct_answer');
        $all_check_hint = $this->input->post('all_check_hint');
        $question_id = $this->input->post('question_id');
        $correctAnswerStd = $this->input->post('correctAnswer');
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $question_id);
        $question_name = json_decode($question_info[0]['questionName']);
        $correctAnswer = explode(",",$correctAnswerStd);
        $show_data_array = $this->memorization_hide_data_four($question_name);
        $left_memorize_p_four= $question_name->left_memorize_p_four;
        $left_memorize_p_four = array_map('strtolower', $left_memorize_p_four);

        $show_correct_ans = array();
        $show_error_ans = array();

            foreach ($correctAnswer as $key=>$item) {
                if ($item == 1)
                {
                    $show_correct_ans[] = $correctAnswerSession[$key];
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
                    $show_error_ans[] = $correctAnswerSession[$key];
                } else {
                    $show_error_ans[] = '';
                }
            }
         $data['show_data_array']=$show_error_ans;
         $data['all_check_hint']=1;
        }

        $array = array();
        foreach ($show_data_array as $sda => $value) {
            $right = $value['right'];
            if (in_array($right, $show_correct_ans)) {
                $array[$sda] = $right;
            }else{
                $array[$sda] = '';
            }
        }
        $data['show_correct_ans'] = $array;
        // $data['show_correct_ans'] = $show_correct_ans;
        // echo "<pre>";print_r($data);die();

        echo json_encode($data);
    }
    public function preview_memorization_pattern_one_ok()
    {
        $data = array();
        $question_id = $this->input->post('question_id');
        $question_info = $this->tutor_model->getInfo('tbl_question', 'id', $question_id);
        $question_name = json_decode($question_info[0]['questionName']);
        $data['all_correct_ans'] =  $this->memorization_ans_data($question_name);
        echo json_encode($data);
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
        $left_memorize_p_one = array_map('strtolower', $left_memorize_p_one);
        $reply_ans = array();
        $reply_hints = array();
        $correct = 1;
        $correctAnswer = array();
        foreach ($left_memorize_p_one as $key=>$item)
        {
            if (isset($left_memorize_p_one_alpha_ans[$key]) && $left_memorize_p_one_alpha_ans[$key] != '')
            {
                if ( preg_replace('/\s+/', '', strtolower($item))  == preg_replace('/\s+/', '', strtolower($left_memorize_p_one_alpha_ans[$key])) )
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

        $this->session->set_userdata('firstleftSerial',$left_memorize_p_two_ans);
        $left_content = array();
        $right_content = array();
        if (isset($question_name->hide_pattern_two_left))
        {
            $hide_pattern_two_left = $question_name->hide_pattern_two_left;
            $left_content = $this->MemorizationAnswerMatching($cycle,$left_memorize_p_two,$left_memorize_p_two_ans,$left_memorize_h_p_two);
        }
        // if (isset($question_name->hide_pattern_two_right))
        // {
        //     $hide_pattern_two_right = $question_name->hide_pattern_two_right;
        //     $right_content = $this->MemorizationAnswerMatching($cycle,$right_memorize_p_two,$right_memorize_p_two_ans,$right_memorize_h_p_two);
        // }
        $right_content = $this->MemorizationAnswerMatchingTwo($left_memorize_p_two_ans,$right_memorize_p_two_ans);

        $cycle = $cycle + 2;
        $data['cycle'] = $cycle;
        $data['left_content'] = $left_content;
        $data['right_content'] = $right_content;
        echo json_encode($data);
    }
    public function MemorizationAnswerMatchingTwo($left_memorize_p_two_ans,$right_memorize_p_two_ans){
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
            }else{
                $matchingAnswer[$key][0] =  $right_result_val;
                $matchingAnswer[$key][1] =  0;
                $correct = 0;
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
        // echo "<pre>";print_r($right_result_val);die();
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
            $TAns = str_replace(array(' ', "\n", "\t", "\r"), '', strip_tags($tutorAns[$key][0]));
//            $TAns = strtolower($TAns);
            $SAns = str_replace(array(' ', "\n", "\t", "\r"), '', $stdAns[$key]);
//            $SAns = strtolower($SAns);

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
        
        foreach($data as $key => $value)
        {
            $modifyData[$key]['left'] = $value[0];
            $modifyData[$key]['sl']   = $key+1;
        }

        shuffle($modifyData);
        //echo "<pre>";print_r($modifyData);die();
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

        $firstleftSerial = $this->session->userdata('firstleftSerial');
        $returnLeft = array();
        foreach ($firstleftSerial as $lmpt=>$item)
        {
            $returnLeft[$lmpt]['left']  = $left_memorize_p_two[$item-1];
            $returnLeft[$lmpt]['right'] = $right_memorize_p_two[$item-1];
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
        // $left_image_ans = $this->input->post('left_image_ans');
        // $right_image_ans = $this->input->post('right_image_ans');
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
            $qus_setup_array[$key]['order'] = $key +1;
            if($value[3] == 0){
                $last_step = $last_step + 1;
            }

            if ($order == $key +1) {
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
        // echo $last_step;die();
        if ($order == $activeOrder) {

            $data['answer_status'] = 1;
            $correct = 1;

            if($activeOrder == $last_step){
                $data['next_step'] = 0;
            }else{
                $data['next_step'] = 1;
            }
            $this->session->set_userdata('question_setup_answer_order',$activeOrder + 1);

            $data['active_order'] = $activeOrder +1;
        }else{
            $data['answer_status'] = 0;
            $correct = 0;
        }


        $question_step_details = $data['qus_setup_array'];

        if ($correct == 0)
        {
            $data['correct'] = $correct;
        }else{
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
    
    /**
     * before passing items to renderSkpQuizPrevTable() index it first with this func
     *
     * @param  array $items json object array
     * @return array        array with proper indexing
     */
    public function indexQuesAns($items)
    {
        $arr = [];
        foreach ($items as $item) {
            $temp = json_decode($item);
            $cr = explode('_', $temp->cr);
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
     *
     * @param  array   $items   ques ans as indexed item
     * @param  int     $rows    num of row in table
     * @param  int     $cols    num of cols in table
     * @param  integer $showAns optional, set 1 will show the answers too
     * @return string           table item
     */
    public function renderSkpQuizPrevTable($items, $rows, $cols, $showAns = 0)
    {
        //print_r($items);die;
        $row = '';
        for ($i=1; $i<=$rows; $i++) {
            $row .='<tr>';
            for ($j=1; $j<=$cols; $j++) {
                if ($items[$i][$j]['type']=='q') {
                    $row .= '<td><input type="button" data_q_type="0" data_num_colofrow="" value="'.$items[$i][$j]['val'].'" name="skip_counting[]" class="form-control input-box  rsskpinpt'.$i.'_'.$j.'" readonly style="min-width:50px; max-width:50px"></td>';
                } else {
                    $ansObj = array(
                        'cr'=>$i.'_'.$j,
                        'val'=> $items[$i][$j]['val'],
                        'type'=> 'a',
                    );
                    $ansObj = json_encode($ansObj);
                    $val = ($showAns==1)?' value="'.$items[$i][$j]['val'].'"' : '';
                    
                    $row .= '<td><input autocomplete="off" type="text" '.$val.' data_q_type="0" data_num_colofrow="'.$i.'_'.$j.'" value="" name="skip_counting[]" class="form-control input-box ans_input  rsskpinpt'.$i.'_'.$j.'"  style="min-width:50px; max-width:50px">';
                    $row .= '<input type="hidden" value="" name="given_ans[]" id="given_ans">';
                    $row .='</td>';
                }
            }
            $row .= '</tr>';
        }
        
        return $row;
    }
    
    public function answer_multiple_matching()
    {
        $total = $_POST['total_ans'];
        $question_id = $_POST['id'];
        $st_ans = array();
        for ($i = 1; $i <= $total; $i++) {
            $ans_id = 'answer_' . $i;
            $st_ans[] = $_POST[$ans_id];
        }

        $flag = 1;
        $answer = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $answer_info['tutor_ans'] = json_decode($answer[0]['answer']);
        
        for ($i = 0; $i < count($answer_info['tutor_ans']); $i++) {
            if ($answer_info['tutor_ans'][$i] != $st_ans[$i]) {
                $flag = 0;
            }
        }
        
        $answer_info['student_ans'] = $st_ans;
        $answer_info['flag'] = $flag;
        echo (json_encode($answer_info));
    }
    
    /**
     * Make table row element with assignment tasks
     *
     * @param  array $items assignment tasks json array
     * @return string        table row element
     */
    public function renderAssignmentTasks(array $items)
    {
        $row = '';
        foreach ($items as $task) {
            $task = json_decode($task);
            $row .= '<tr id="'.($task->serial + 1).'">';
            $row .= '<td>'.($task->serial + 1).'</td>';
            $row .= '<td>'.$task->qMark.'</td>';
            //$row .= '<td>'.$task->obtnMark.'</td>';
            $row .= '<td><i class="fa fa-eye qDtlsOpenModIcon" data-toggle="modal" data-target="#quesDtlsModal"></i></td>';
            $row .= '<input type="hidden" id="hiddenTaskDesc" value="'.$task->description.'">';
            $row .= '</tr>';
        }

        return $row;
    }//end renderAssignmentTasks()

    public function answer_matching_storyWrite()
    {
        $question_id = $_POST['id'];
        $text = $_POST['user_answer'];

        if ($text) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    public function save_answer_idea()
    {
        $idea_answer = $_POST['idea_answer'];
        $question_id = $_POST['question_id'];
        $idea_id = $_POST['idea_id'];

        echo 1;

        
    }
}
