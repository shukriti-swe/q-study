<?php

class Preview extends CI_Controller
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

    public function question_preview($question_item, $question_id)
    {
    
        date_default_timezone_set($this->site_user_data['zone_name']);
        $exact_time = time();
        $this->session->set_userdata('exact_time', $exact_time);
        // echo $question_item;die();
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
        } elseif ($question_item == 9) {
            $this->preview_story_Write($question_item, $question_id);
        } elseif ($question_item == 10) {
            $this->preview_times_table($question_item, $question_id);
        } elseif ($question_item == 11) {
            $this->preview_algorithm($question_item, $question_id);
        } elseif ($question_item == 12) {
            $this->preview_workout_quiz($question_item, $question_id);
        } elseif ($question_item == 13) {
            $this->preview_multiple_choice($question_item, $question_id);
        }elseif ($question_item == 14) {
            $this->preview_tutor($question_item, $question_id);
        }elseif ($question_item == 15)
        {
            $this->preview_workout_quiz_two($question_item, $question_id);
        }elseif ($question_item == 16)
        {
            $this->preview_memorization_quiz($question_item, $question_id);
        }elseif ($question_item == 17)
        {
            $this->preview_creative_quiz($question_item, $question_id);
        }elseif ($question_item == 18)
        {
            $this->preview_sentence_match($question_item, $question_id);
        }elseif ($question_item == 19)
        {
            $this->preview_word_matching($question_item, $question_id);
        }
        elseif ($question_item == 20)
        {
            $this->preview_comprehension($question_item, $question_id);
        }
        elseif ($question_item == 21)
        {
            $this->preview_grammer($question_item, $question_id);
        }
        elseif ($question_item == 22)
        {
            $this->preview_glossary($question_item, $question_id);
        }
        elseif ($question_item == 23)
        {
            $this->preview_imageQuiz($question_item, $question_id);
        }
        
    }
    public function preview_story_Write($question_item, $question_id){
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

        $info = array();
        $titles = array();
        $title = array();
        $questionList = json_decode($data['question_info'][0]['questionName'] , true);
        //title
        foreach (json_decode($data['question_info'][0]['questionName'])->wrongTitles as $key => $value) {
            $title[0] = $value;
            $title[1] = json_decode($data['question_info'][0]['questionName'])->wrongTitlesIncrement[$key];
            $titles[] = $title;
        }

        $title[0] = json_decode($data['question_info'][0]['questionName'])->rightTitle;
        $title[1] = "right_ones_xxx";
        $titles[] = $title;
        shuffle($titles);
        $info['titles'] = $titles;
        //intro

        $titles = array();
        $title = array();

        foreach (json_decode($data['question_info'][0]['questionName'])->wrongIntro as $key => $value) {
            $title[0] = $value;
            $title[1] = json_decode($data['question_info'][0]['questionName'])->wrongIntroIncrement[$key];
            $titles[] = $title;
        }

        $title[0] = json_decode($data['question_info'][0]['questionName'])->rightIntro;
        $title[1] = "right_ones_xxx";
        $titles[] = $title;
        shuffle($titles);
        $info['Intro'] = $titles;

        //picture

        $titles = array();
        $title = array();

        foreach (json_decode($data['question_info'][0]['questionName'])->pictureList as $key => $value) {
            $title[0] = $value;
            $title[1] = $questionList['wrongPictureIncrement'][$key]; 
            $titles[] = $title;
        }

        $title[0] = json_decode($data['question_info'][0]['questionName'])->lastpictureSelected;
        $title[1] = "right_ones_xxx";
        $titles[] = $title;
        shuffle($titles);
        $info['picture'] = $titles;

        //paragraph
        $paragraph = json_decode($data['question_info'][0]['questionName'] , true);
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

        foreach (json_decode($data['question_info'][0]['questionName'])->wrongConclution as $key => $value) {
            $title[0] = $value;
            $title[1] = $questionList['wrongConclutionIncrement'][$key];
            $titles[] = $title;
        }

        $title[0] = json_decode($data['question_info'][0]['questionName'])->rightConclution;
        $title[1] = "right_ones_xxx";
        $titles[] = $title;
        shuffle($titles);

        $info['conclution'] = $titles;
        $data['question'] = $info;

        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('preview/preview_q_storyWrite', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    private function preview_workout_quiz_two($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
    
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        $data['question_info_ind'] = $data['question_info'];
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        if (isset($data['question_info_ind']->percentage_array))
        {
            $data['ans_count'] = count((array)$data['question_info_ind']->percentage_array);
        }else
        {
            $data['ans_count'] = 0;
        }
        $data['maincontent'] = $this->load->view('preview/preview_workout_quiz_two', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    private function preview_tutor($question_item, $question_id)
    {
        $array_one = array();
        $array_two = array();
        $array_three = array();

        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $tutorialId = $data['question_info_s'][0]['id'];
        $data['tutorialInfo'] = $this->tutor_model->getInfo('for_tutorial_tbl_question', 'tbl_ques_id', $tutorialId);
        $data['maincontent'] = $this->load->view('preview/preview_tutor', $data, true);
        // print_r($data); die();
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
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('preview/preview_vocubulary', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    private function general($question_item, $question_id)
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
        $data['question_info_left_right'] = json_decode($data['question_info_total'][0]['questionName']);

        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        
        
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
            // print_r($data['questionBody']); die();
            $data['questionId']   = $questionId;
            
            $quesAnsItem          = $quesInfo->skp_quiz_box;

            $items = $this->indexQuesAns($quesAnsItem);

            $data['skp_box'] = $this->renderSkpQuizPrevTable($items, $data['numOfRows'], $data['numOfCols']);

            $user_id             = $this->session->userdata('user_id');
            $data['all_grade']   = $this->tutor_model->getAllInfo('tbl_studentgrade');
            $data['all_subject'] = $this->tutor_model->getInfo('tbl_subject', 'created_by', $user_id);
            $data['maincontent'] = $this->load->view('preview/skip_quiz', $data, true);
        }//end if
        
        $this->load->view('master_dashboard', $data);
    }
    
    
    
    public function preview_times_table($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName'], true);
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('preview/preview_times_table', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function preview_algorithm($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        //print_r($data['question_info_s']);die();
        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName'], true);
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('preview/preview_algorithm', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    

    public function preview_workout_quiz($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('preview/workout_quiz', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function answer_matching()
    {
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $question_order_id = $this->input->post('current_order');
        $text = $this->input->post('answer');
        
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
        
        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
    }

    public function answer_matching_true_false()
    {
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
            
            $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
        }
    }

    public function answer_matching_vocabolary()
    {
        $this->form_validation->set_rules('answer', 'answer', 'required');
        if ($this->form_validation->run() == false) {
            echo 1;
        } else {
            
            $text = trim(strtolower($this->input->post('answer'))); 
            $question_id = $this->input->post('question_id');
            $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

            $module_id = $_POST['module_id'];
            // $question_order_id = $_POST['next_question'] - 1;
            $question_order_id = $_POST['current_order'];
            $text_1 = trim(strtolower($answer_info[0]['answer']));
            // echo $text_1.'//'.$text;die();
            $question_marks = $answer_info[0]['questionMarks'];
         
            $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
        }
    }
    
    public function answer_matching_multiple_choice()
    {
        $question_id = $_POST['question_id'];
        $text_1 = $_POST['answer_reply'];

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        // $text = $answer_info[0]['answer'];
        // Added AS
        $text = json_decode($answer_info[0]['answer']);
        $question_marks = $answer_info[0]['questionMarks'];
        
        $result_count = count(array_intersect($text_1, $text));
        
        $module_id = $_POST['module_id'];
        
        //$question_order_id = $_POST['next_question'] - 1;
        $question_order_id = $_POST['current_order'];
        
        // $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, count($text), $result_count);
    }
    
    public function answer_matching_multiple_response()
    {
        $question_id = $_POST['question_id'];
        $text_1 = $_POST['answer_reply'];

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        //$text = $answer_info[0]['answer'];
        $question_marks = $answer_info[0]['questionMarks'];
        $text = json_decode($answer_info[0]['answer']);
        $result_count = count(array_intersect($text_1, $text));

        $module_id = $_POST['module_id'];
        // $question_order_id = $_POST['next_question'] - 1;
        $question_order_id = $_POST['current_order'];

        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, count($text), $result_count);
    }
    
    public function st_answer_skip()
    {
        $module_id = $_POST['module_id'];
        //$question_order_id = $_POST['next_question'] - 1;
        $question_order_id = $_POST['current_order'];
        $post = $this->input->post();
        $questionId = $this->input->post('question_id');
        $givenAns = $this->indexQuesAns($post['given_ans']);

        $temp = $this->tutor_model->getInfo('tbl_question', 'id', $questionId);
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

        $this->take_decesion($question_marks, $questionId, $module_id, $question_order_id, $text, $text_1);
    }
    
    public function answer_multiple_matching()
    {
        $total = $_POST['total_ans'];

        $question_id = $_POST['question_id'];
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
        $flag = 1;
        for ($k = 0; $k < sizeof($answer_info['student_ans']); $k++) {
            if ($answer_info['student_ans'][$k] != $answer_info['tutor_ans'][$k]) {
                $text++;
                $flag = 0;
            }
        }
        $answer_info['student_ans'] = $st_ans;
        $answer_info['flag'] = $flag;

        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, json_encode($answer_info));
    }
    
    public function answer_creative_quiz() {
        $question_id = $this->input->post('question_id');
        $student_ans = $this->input->post('answer');
        $paragraph = $this->input->post('paragraph');
        
        $answer = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        
        $answer_info['questionName'] = json_decode($answer[0]['questionName']);
        $answer_info['tutor_ans'] = json_decode($answer[0]['answer']);
        $question_marks = $answer[0]['questionMarks'];
//        echo '<pre>';print_r($answer_info['questionName']->paragraph_order);die;
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

        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, array());
    }
    
    public function answer_matching_workout_two()
    {
        $provide_ans ='';
        $qus_ans =0;
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        //$question_order_id = $_POST['check_order_id'] - 1;
        $question_order_id = $this->input->post('current_order');
        //$text = $this->input->post('answer');
        $text = 0;
        $text_1 = 0;

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

        $ans_is_right = 'correct';
        $question_marks = 0;

        $provide_ans = $_POST['answer'];
        $qus_ans = $answer_info[0]['answer'];
        if ($provide_ans == 'correct')
        {
            $text_1 =0;
            $question_marks = $answer_info[0]['questionMarks'];
        }else{
            $ans_is_right = 'wrong';
            $text_1 =1;
        }
        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, array());

    }
    
    public function answer_workout_quiz()
    {
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
       //$question_order_id = $_POST['check_order_id'] - 1;
        $question_order_id = $this->input->post('current_order');
        //$text = $this->input->post('answer');
        $text = 0;
        $text_1 = 0;

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        
        $ans_is_right = 'correct';

        $question_marks = 0;

        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, array());
    }
    
    public function answer_times_table()
    {

        $question_id = $this->input->post('question_id');
        $result = $this->input->post('result');
        $st_ans = array();
        
        $answer = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $answer_info['tutor_ans'] = json_decode($answer[0]['answer']);
        $question_marks = $answer[0]['questionMarks'];
        $answer_info['student_ans'] = $result;
        
        $module_id = $_POST['module_id'];
        //$question_order_id = $_POST['next_question'] - 1;
        $question_order_id = $_POST['current_order'];
        $text = 0;
        $text_1 = 0;
        $flag = 1;
        
        for ($k = 0; $k < sizeof($answer_info['student_ans']); $k++) {
            if ($answer_info['student_ans'][$k] != $answer_info['tutor_ans'][$k]) {
                $text++;
                $flag = 0;
            }
        }
        
        $answer_info['student_ans'] = $result;
        $answer_info['flag'] = $flag;

//       $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, json_encode($answer_info));
        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, array());
    }
    
    public function answer_algorithm()
    {
        $question_id = $this->input->post('question_id');
        $result = $this->input->post('answer');

        $ans_one = $result[0];
        $reminder_answer = $result[1];

        $text = 1;
        $module_id = $this->input->post('module_id');
        
        $question_order_id = $this->input->post('current_order');
        $answer = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $question_info = json_decode($answer[0]['questionName'], true);

        $question_marks = $answer[0]['questionMarks'];

        $answer_info['tutor_ans'] = json_decode($answer[0]['answer']);
        $text_1 = 1;
        
        //   echo '<pre>';print_r($question_info['operator']);die;
        
        $question_marks = $answer[0]['questionMarks'];
        if ($question_info['operator'] != '/' && $result == $answer_info['tutor_ans']) {
            $text_1 = 1;
        } elseif ($question_info['operator'] == '/' && $question_info['quotient'] == $ans_one && $question_info['remainder'] == $reminder_answer) {
            $text_1 = 1;
        } else {
            $text_1++;
        }
        
        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, array());
    }

    public function answer_sentence_matching()
    {
        
        $total = count($_POST['answer']);

        $question_id = $_POST['question_id'];
        $st_ans = array();
        
        for ($i = 0; $i < $total; $i++) {
            $find_ans = explode(',,', $_POST['answer'][$i]);
            $st_ans[] = $find_ans[0];
        }
        

        $answer = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $answer_info['tutor_ans'] = json_decode($answer[0]['answer']);
        $question_marks = $answer[0]['questionMarks'];
        $answer_info['student_ans'] = $st_ans;
        
        $module_id = $_POST['module_id'];
        $question_order_id = $_POST['current_order'];
        $text = 0;
        $text_1 = 0;
        $flag = 1;
        for ($k = 0; $k < sizeof($answer_info['student_ans']); $k++) {
            if ($answer_info['student_ans'][$k] != $answer_info['tutor_ans'][$k]) {
                $text++;
                $flag = 0;
            }
        }
        if($text == 0){
            $answer_info = 2;
        }else{
            $answer_info = 3;
        }
        
        
        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, json_encode($answer_info));
    }

    public function answer_word_memorization()
    {
        $total = count($_POST['answers']);
        
        $question_id = $_POST['question_id'];
        $st_ans = array();
        
        for ($i = 0; $i < $total; $i++) {
            $st_ans[] = $_POST['answers'][$i];
        }
        

        $answer = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $answer_info['tutor_ans'] = json_decode($answer[0]['answer']);
        $question_marks = $answer[0]['questionMarks'];
        $answer_info['student_ans'] = $st_ans;
        // print_r($answer_info['student_ans']);die();

        $module_id = $_POST['module_id'];
        $question_order_id = $_POST['current_order'];
        $text = 0;
        $text_1 = 0;
        $flag = 1;
        for ($k = 0; $k < sizeof($answer_info['student_ans']); $k++) {
            if ($answer_info['student_ans'][$k] != $answer_info['tutor_ans'][$k]) {
                $text++;
                $flag = 0;
            }
        }
        //echo $text.'//'.$text_1;die();
        if($text == 0){
            $answer_info = 2;
        }else{
            $answer_info = 3;
        }
        
        
        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, json_encode($answer_info));
    }

    public function answer_matching_comprehension()
    {
        $total = count($_POST['answers']);
        
        $question_id = $_POST['question_id'];
        $st_ans = array();
        
        for ($i = 0; $i < $total; $i++) {
            $st_ans[] = $_POST['answers'][$i];
        }
        

        $answer = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $answer_info['tutor_ans'] = json_decode($answer[0]['answer']);
        $question_marks = $answer[0]['questionMarks'];
        $answer_info['student_ans'] = $st_ans;
        // print_r($answer_info['student_ans']);die();

        $module_id = $_POST['module_id'];
        $question_order_id = $_POST['current_order'];
        $text = 0;
        $text_1 = 0;
        $flag = 1;
        for ($k = 0; $k < sizeof($answer_info['student_ans']); $k++) {
            if ($answer_info['student_ans'][$k] != $answer_info['tutor_ans'][$k]) {
                $text++;
                $flag = 0;
            }
        }
        //echo $text.'//'.$text_1;die();
        if($text == 0){
            $answer_info = 2;
        }else{
            $answer_info = 3;
        }
        
        
        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, json_encode($answer_info));
    }

    public function module_answer_matching_grammer()
    {
        //echo "<pre>";print_r($_POST);die();
        
        $question_id = $_POST['question_id'];
        
        $answer = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $answer_info['tutor_ans'] = json_decode($answer[0]['answer']);
        $question_marks = $answer[0]['questionMarks'];

        $answer_info['student_ans'] = $_POST['answer'];
        // print_r($answer_info);die();

        $module_id = $_POST['module_id'];
        $question_order_id = $_POST['current_order'];
        $text = 0;
        $text_1 = 0;
        $flag = 1;
        // for ($k = 0; $k < sizeof($answer_info['student_ans']); $k++) {
        //     if ($answer_info['student_ans'][$k] != $answer_info['tutor_ans'][$k]) {
        //         $text++;
        //         $flag = 0;
        //     }
        // }

        if($answer_info['student_ans']!=$answer_info['tutor_ans']){
            $text = 1;
            $flag = 0;
        }
        //echo $text.'//'.$text_1;die();
        if($text == 0){
            $answer_info = 2;
        }else{
            $answer_info = 3;
        }
        
        
        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, json_encode($answer_info));
    }

    public function take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, $answer_info = null,$next_step_patten_two = null)
    {
        //****** Get Temp table data for Tutorial Module Type ******
        $user_id = $this->session->userdata('user_id');
        
        $question_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

        $question_info_type = '';
        $question_info_type = $question_info[0]['questionType'];
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
                            $memorization_obtaine_mark_check = 2;
                        }
                    }
                }
                
                if ($question_info_pattern == 3)
                {
                     if ($text == $text_1) {

                     }else{
                        $this->session->set_userdata('memorization_three_qus_part_answer','wrong');
                     }
                }
                
            }else
            {
                $this->session->unset_userdata('memorization_three_part');
                $this->session->unset_userdata('memorization_two_part');
                $this->session->unset_userdata('memorization_one_part');
            }
        }

        

        //  echo 'ppp'.$text."==".$text_1.'ppp';die();

        if ($text == $text_1) {
            $ans_is_right = 'correct';
            if ($answer_info != null) {
                $student_ans = $answer_info;
                echo $answer_info;
            } else {
                   echo 2;

            }

        } else {
            $ans_is_right = 'wrong';
            if ($answer_info != null) {
                $student_ans = $answer_info;
                echo $answer_info;
            } else {
                   echo 3;

            }
            $question_marks = 0;
        }
        
        if ($question_info_type == 16) {

            if ($flag == 0 && $question_info_pattern == 3 && $next_step_patten_two == 0) {

                $ans_check = $this->session->userdata('memorization_three_qus_part_answer');
                if (isset($ans_check)) {
                    if($ans_check == 'wrong'){
                        $ans_is_right = 'wrong';
                        $question_marks = 0;
                    }
                }
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
                $this->session->unset_userdata('memorization_three_qus_part_answer');
            }



             if ($flag == 0 && $question_info_pattern != 3) {
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

        }

        if ($flag == 0 && $question_info_type != 16) {
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
        

    }



    
    public function show_tutorial_result($module)
    {
        $user_id = $this->session->userdata('user_id');
        $data['module_info'] = $this->tutor_model->getInfo('tbl_module', 'id', $module);
//        $data['obtained_marks'] = $this->Student_model->get_student_progress($user_id, $module);
        $tutorial_ans_info = $this->session->userdata('data');
        $data['obtained_marks'] = $this->session->userdata('obtained_marks');
        
//        $tutorial_ans_info = array();
//        if ($data['module_info'][0]['moduleType'] == 1) {
//            $get_tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $module, $user_id);
//            $tutorial_ans_info = json_decode($get_tutorial_ans_info[0]['st_ans'], true);
//            $module_id = $tutorial_ans_info[1]['module_id'];
//            $data['obtained_marks'] = $this->session->userdata('obtained_marks');
//        } elseif ($data['module_info'][0]['moduleType'] == 2) {
//            $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_st_error_ans', $module, $user_id);
//            //            $tutorial_ans_info = json_decode($get_tutorial_ans_info[0]['st_ans'],TRUE);
//            $module_id = $tutorial_ans_info[0]['module_id'];
//        } else {
//            $get_tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_student_answer', $module, $user_id);
//            $tutorial_ans_info = json_decode($get_tutorial_ans_info[0]['st_ans'], true);
//            $module_id = $tutorial_ans_info[1]['module_id'];
//        }
        
        // if($tutorial_ans_info) {
        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $user_id);
        
        $data['tutorial_ans_info'] = $tutorial_ans_info;
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('module/preview/show_module_result', $data, true);
        $this->load->view('master_dashboard', $data);
        // } else {
            // redirect('error');
        // }
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
    
    /**
     * before passing items to renderSkpQuizPrevTable() index it first with this func
     * @param  array $items json object array
     * @return array        array with proper indexing
     */
    public function indexQuesAns($items)
    {
        $arr = [];
        foreach ($items as $item) {
            $temp = json_decode($item);
            if ($temp == '')
            {

            }else{
                $cr = explode('_', $temp->cr);
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
        for ($i=1; $i<=$rows; $i++) {
            $row .='<div class="sk_out_box">';
            for ($j=1; $j<=$cols; $j++) {
                if ($items[$i][$j]['type']=='q') {
                    $row .= '<div class="sk_inner_box"><input type="button" data_q_type="0" data_num_colofrow="" value="'.$items[$i][$j]['val'].'" name="skip_counting[]" class="form-control input-box  rsskpinpt'.$i.'_'.$j.'" readonly style="min-width:50px; max-width:50px"></div>';
                } else {
                    $ansObj = array(
                        'cr'=>$i.'_'.$j,
                        'val'=> $items[$i][$j]['val'],
                        'type'=> 'a',
                        );
                    $ansObj = json_encode($ansObj);
                    $val = ($showAns==1)?' value="'.$items[$i][$j]['val'].'"' : '';
                    $row .= '<div class="sk_inner_box"><input autocomplete="off" type="text" '.$val.' data_q_type="0" data_num_colofrow="'.$i.'_'.$j.'" value="" name="skip_counting[]" class="form-control input-box ans_input  rsskpinpt'.$i.'_'.$j.'"  style="min-width:50px; max-width:50px">';
                    $row .= '<input type="hidden" value="" name="given_ans[]" id="given_ans">';
                    $row .='</div>';
                }
            }
            $row .= '</div>';
        }
        return $row;
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

    public function tutorial_data($id)
    {
        $back  = $this->input->post('bk', true);
       
        $next = $this->input->post('nxt', true);
        if (empty($back) && empty($next) ) {

            $datas = $this->Preview_model->tutorial_info($id,0);
       
            $_SESSION["order"] = $datas[0]->orders;
            $output ='';
            $output .='<img src="assets/uploads/'.$datas[0]->img.'"  width="100%" height="100%"><br><br>';

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

            $output .='<style>

            .click_bk {
                  display: none;
                }

            </style>'; 
            print_r($output);
        }
        if (!empty($back)) {
           $bk = $_SESSION["order"] - 1; 
           $_SESSION["order"] = $bk; 
           $datas = $this->Preview_model->tutorial_info($id,$bk);
           if (!empty($datas)) {
                $output ='';
                $output .='<img src="assets/uploads/'.$datas[0]->img.'"  width="100%" height="100%"><br><br>';

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
                if ($datas[0]->orders ==0) {
                        $output .='<style>

                        .click_bk {
                              display: none;
                            }
                        </style>';
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
        }

        if (!empty($next)) {
           $nxt = $_SESSION["order"] + 1; 
           $_SESSION["order"] = $nxt; 
           $datas = $this->Preview_model->tutorial_info($id,$nxt);
           $last_data = $this->Preview_model->tutorial_count($id);
         

           if (!empty($datas)) {
                $output ='';

                if ($datas[0]->orders ==  $last_data[0]->orders) {
                        $output .='<style>

                        .click_nxt {
                              display: none;
                            }

                        </style>';
                   }

                $output .='<img src="assets/uploads/'.$datas[0]->img.'"  width="100%" height="100%"><br><br>';

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
        }
    }
    
    public function creative_quiz_ans_matching()
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
        $notInParagraphR = array();
        $notInParagraph= $test;
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

//    else
//        {
//            $msgPara =$this->ParaCheck($id,$notInParagraphR);
//            $msgParaCount = count($msgPara);
//            if (!empty($msgParaCount))
//            {
//                $ErrorMessage[$id]='Not in the paragraph';
//            }else
//            {
//                $ErrorMessage[$id] = '';
//            }
//        }
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

        if (!empty($TestMsg) && !empty($test))
        {
            if (!empty($NotMatchResults))
            {
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
    // memorization quiz create by aftab
    
    private function preview_memorization_quiz($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
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
                if($value[3] == 0){
                    $qus_setup_array[$key]['order'] = $k;
                    $k = $k + 1;
                }else{
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
        // echo '<pre>';
        // print_r($data);
        // die();
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('preview/preview_memorization_quiz', $data, true);
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
                    if ( preg_replace('/\s+/', '', strtolower($show_data))  == preg_replace('/\s+/', '', strtolower($word_matching_item)) )
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
                if ( preg_replace('/\s+/', '', strtolower($left_memorize_p_one[$key]))  == preg_replace('/\s+/', '', strtolower($word_matching[$key])) )    
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
            foreach($show_data_array as $key=>$show_data)
            {
                if ($show_data != '')
                {
                    $word_matching_item = $word_matching[$key];
                    if ( preg_replace('/\s+/', '', strtolower($show_data))  == preg_replace('/\s+/', '', strtolower($word_matching_item)) )
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
                if ( preg_replace('/\s+/', '', strtolower($left_memorize_p_four[$key]))  == preg_replace('/\s+/', '', strtolower($word_matching[$key])) )    
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
        $left_memorize_p_four = $question_name->left_memorize_p_four;
        $left_memorize_p_four = array_map('strtolower', $left_memorize_p_four);
        $show_correct_ans = array();
        $show_error_ans = array();

        foreach ($correctAnswer as $key=>$item) {
            if ($item == 1)
            {
                // $show_correct_ans[] = $left_memorize_p_four[$key];
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
                    // $show_error_ans[] = $left_memorize_p_four[$key];
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
        if ($memorization_answer == 'correct')
        {
            if (isset($answer_info[0]['questionMarks']))
            {
                $question_marks = $answer_info[0]['questionMarks'];
            }
        }else{
            $text_1 = 1;
        }
        if ( $text_1 == 0 ) {
            $dataArray = $_SESSION['data'];
            if (count($dataArray)) {
                $dataArray[$_POST['current_order']]['ans_is_right']  = "wrong";
                $this->session->set_userdata('data', $dataArray);
            }
        }

        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, array());
    }
    
    
    public function preview_memorization_pattern_four_ok()
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
        if ($memorization_answer == 'correct')
        {
            if (isset($answer_info[0]['questionMarks']))
            {
                $question_marks = $answer_info[0]['questionMarks'];
            }
        }else{
            $text_1 = 1;
        }

        // if ( $text_1 == 0 ) {
        //     $dataArray = $_SESSION['data'];
        // echo "<pre>";print_r($dataArray[$_POST['current_order']]['ans_is_right']);die();
        //     if (count($dataArray)) {
        //         $dataArray[$_POST['current_order']]['ans_is_right']  = "wrong";
        //         $this->session->set_userdata('data', $dataArray);
        //     }
        // }

        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, array());
    }
    
    
    public function preview_memorization_pattern_three_take_decesion()
    {

        $qus_ans =0;
        $question_marks = 0;
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $question_order_id = $this->input->post('current_order');
        $memorization_answer = $this->input->post('memorization_answer');
        //$submit_cycle = $this->input->post('submit_cycle');
        $text = 0;
        $text_1 = 0;

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        if ($memorization_answer == 'correct')
        {
           
            if (isset($answer_info[0]['questionMarks']))
            {
                $question_marks = $answer_info[0]['questionMarks'];
            }
        }else{

            $text_1 =1;
        }
        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, array(),$next_step_patten_two);
    }
    public function preview_memorization_pattern_two_take_decesion()
    {
        $qus_ans =0;
        $question_marks = 0;
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $question_order_id = $this->input->post('current_order');
        $memorization_answer = $this->input->post('memorization_answer');
        //$submit_cycle = $this->input->post('submit_cycle');
        $text = 0;
        $text_1 = 0;

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
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
        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, array());
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
//        $left_memorize_p_one = array_map('strtolower', $left_memorize_p_one);
        $reply_ans = array();
        $reply_hints = array();
        $correct = 1;
        $correctAnswer = array();
        foreach ($left_memorize_p_one as $key=>$item)
        {
            if (isset($left_memorize_p_one_alpha_ans[$key]) && $left_memorize_p_one_alpha_ans[$key] != '')
            {
                if ( preg_replace('/\s+/', '', strtolower($item)) == preg_replace('/\s+/', '', strtolower($left_memorize_p_one_alpha_ans[$key])) )
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
        
        foreach($data as $key => $value)
        {
            $modifyData[$key]['left'] = $value[0];
            $modifyData[$key]['sl']   = $key+1;
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

    public function answer_matching_StoryWrite()
    {
        $question_id = $this->input->post('question_id');
        $module_id = $this->input->post('module_id');
        $question_order_id = $this->input->post('current_order');
        $text = $this->input->post('answerGiven');
        
        $find = array('&nbsp;', '\n', '\t', '\r');
        $repleace = array('', '', '', '');
        $text = strip_tags($text);
        $text = str_replace($find, $repleace, $text);
        $text = trim($text);

        $answer_info = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $question_marks = $answer_info[0]['questionMarks'];
        
        // $text_1 = $answer_info[0]['answer'];
        $text_1 = 1;
        $find = array('&nbsp;', '\n', '\t', '\r');
        $repleace = array('', '', '', '');
        $text_1 = strip_tags($text_1);
        $text_1 = str_replace($find, $repleace, $text_1);
        $text_1 = trim($text_1);
        
        $this->take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1);
    }


    public function preview_creative_quiz($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        $data['question_info_ind'] = $data['question_info'];
        $data['idea_info'] = $this->Preview_model->getIdeaInfo('idea_info', $question_id);
        $data['idea_description'] = $this->Preview_model->getIdeaDescription('idea_description', $question_id);
        //$data['profile'] = $this->Student_model->get_profile_info($this->session->userdata('user_id'));
        $data['student_ideas'] = $this->Preview_model->getStudentIdeas($question_id);
        $data['tutor_ideas'] = $this->Preview_model->getTutorIdeas($question_id);
        // echo "<pre>";print_r($data['student_ideas']);die();

        $question_info_ind = $data['question_info'];
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('preview/preview_creative_quiz', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function preview_sentence_match($question_item, $question_id){
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);

        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        $data['question_info_ind'] = $data['question_info'];

        $data['sentence_info'] = $this->Preview_model->getQuestionDetails('tbl_question', $question_id);
        
        $question_info_ind = $data['question_info'];

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('preview/preview_sentence_match', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function preview_word_matching($question_item, $question_id){
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        $data['question_info_ind'] = $data['question_info'];

        $data['word_match_info'] = $this->Preview_model->getQuestionDetails('tbl_question', $question_id);
        
        $question_info_ind = $data['question_info'];

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('preview/preview_word_matching', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    private function preview_comprehension($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        $data['question_info_ind'] = $data['question_info'];

        $data['comprehension_info'] = $this->Preview_model->getQuestionDetails('tbl_question', $question_id);
        
        $question_info_ind = $data['question_info'];

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('preview/preview_comprehension', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    private function preview_grammer($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        $data['question_info_ind'] = $data['question_info'];

        $data['grammer_info'] = $this->Preview_model->getQuestionDetails('tbl_question', $question_id);
        
        $question_info_ind = $data['question_info'];

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('preview/preview_grammer', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    private function preview_glossary($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        $data['question_info_ind'] = $data['question_info'];

        $data['glossary_info'] = $this->Preview_model->getQuestionDetails('tbl_question', $question_id);
        
        $question_info_ind = $data['question_info'];

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('preview/preview_glossary', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    private function preview_imageQuiz($question_item, $question_id)
    {
        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', $this->session->userdata('userType'));
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        $data['question_info_ind'] = $data['question_info'];

        $data['image_info'] = $this->Preview_model->getQuestionDetails('tbl_question', $question_id);
        
        $question_info_ind = $data['question_info'];

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        // $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('preview/preview_image_quiz', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function get_preview_idea_info(){

       $idea = $this->input->post('idea');
       $get_idea = explode(",", $idea);
       $question_id = $get_idea[0];
       $idea_no = $get_idea[1];

       $get_idea = $this->Preview_model->getPreviewIdeaInfo($question_id,$idea_no);
       
       echo json_encode($get_idea[0]); 

    }
    public function question_answer_matching_comprehension()
    {
        $answer = strtolower($this->input->post('answer'));

        if($answer=='write_ans'){
            echo 4;
        }else{ 
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
    }
    public function question_answer_matching_grammer()
    {
            $answer = strtolower($this->input->post('answer'));

            // print_r($this->input->post());die();
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
    

    public function module_answer_matching_comprehension()
    {
        $answer = strtolower($this->input->post('answer'));
        
        // print_r($this->input->post());die();
        if($answer=='write_ans'){
            echo 4;
        }else{ 
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
    }

    public function question_answer_matching_image_quiz()
    {
        $answer = strtolower($this->input->post('answer'));

        if($answer=='write_ans'){
            echo 4;
        }else{ 
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
    }
}