<?php

class Student_Copy extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->loggedUserId = $this->session->userdata('user_id');
        $this->loggedUserType = $this->session->userdata('userType');

        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        if ($user_id == null && $user_type == null) {
            redirect('welcome');
        }
        $this->load->model('Student_model');
        $this->load->model('ModuleModel');
        $this->load->model('Admin_model');
        $this->load->model('Tutor_model');
        $this->load->model('Preview_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('upload');

        $user_info = $this->Preview_model->userInfo($user_id);

        if ($user_info[0]['countryCode'] == 'any') {
            $user_info[0]['zone_name'] = 'Australia/Lord_Howe';
        }

        $this->site_user_data = array(
            'userType' => $user_type,
            'zone_name' => $user_info[0]['zone_name']
        );
    }

    public function check_student_copy($module_id, $student_id, $question_order_id, $student_progress_id = null)
    {
        $this->session->set_userdata('prevUrl', base_url() . 'student_progress');

        $data['module_info'] = $this->Student_model->getInfo('tbl_module', 'id', $module_id);

        if (!$data['module_info']) {
            redirect('error');
        }

        $data['user_info'] = $this->Tutor_model->getInfo('tbl_useraccount', 'id', $student_id);

        //****** Get Temp table data for Tutorial Module Type ******
        if ($data['module_info'][0]['moduleType'] != 1) {
            $table = 'tbl_student_answer';
            $data['tutorial_ans_info'] = $this->Student_model->getTutorialAnsInfo($table, $module_id, $student_id);
        } else {
            $table = 'tbl_student_answer_tutorial';
            //echo $student_progress_id;
            $data['tutorial_ans_info'] = $this->Student_model->get_all_where('*', $table, 'tbl_studentprogress_id', $student_progress_id);
            //echo "<pre>";print_r($data['tutorial_ans_info']);
            //die();
        }


        $workoutImage = isset($data['tutorial_ans_info'][0]['st_ans']) ? $data['tutorial_ans_info'][0]['st_ans'] : '';
        $workoutImage = json_decode($workoutImage);


        $data['question_info_s'] = $this->Tutor_model->getModuleQuestion($module_id, $question_order_id, null);
        
        $data['question_order_id'] = $question_order_id;
        // echo "<pre>";print_r($data['question_info_s']);die();

        if (!$data['question_info_s']) {
            $question_order_id = $question_order_id + 1;
            redirect('check_student_copy/' . $module_id . '/' . $student_id . '/' . $question_order_id);
        }

        $data['total_question'] = $this->Tutor_model->getModuleQuestion($module_id, null, 1);



        // echo "<pre>";print_r($data['question_info_s'][0]['question_type']);die();

        if ($data['question_info_s'][0]['question_type'] == 14) {
            $question_order_id = $question_order_id + 1;
            redirect('check_student_copy/' . $module_id . '/' . $student_id . '/' . $question_order_id);
        }
        if ($data['question_info_s'][0]['question_type'] == 13) {
            $question_order_id = $question_order_id + 1;
            redirect('check_student_copy/' . $module_id . '/' . $student_id . '/' . $question_order_id);
        }
        $question_box = 'tutors/check_student_copy/question_box';
        if ($data['question_info_s'][0]['question_type'] == 1) {
            $question_box .= '/general';
        }
        if ($data['question_info_s'][0]['question_type'] == 2) {
            $question_box .= '/true-false';
        }
        if ($data['question_info_s'][0]['question_type'] == 3) {
            $data['question_info_ind'] = json_decode($data['question_info_s'][0]['questionName']);
            $question_box .= '/vocabulary';
        }
        if ($data['question_info_s'][0]['question_type'] == 4) {
            $data['question_info_ind'] = json_decode($data['question_info_s'][0]['questionName']);
            $question_box .= '/multiple-choice';
        }
        if ($data['question_info_s'][0]['question_type'] == 5) {
            $data['question_info_ind'] = json_decode($data['question_info_s'][0]['questionName']);
            $question_box .= '/multiple-response';
        }
        if ($data['question_info_s'][0]['question_type'] == 7) {
            $data['question_info_ind'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['question_answer'] = json_decode($data['question_info_s'][0]['answer']);

            $data['question_info_total'] = $data['question_info_s'];
            $data['question_info_left_right'] = json_decode($data['question_info_total'][0]['questionName']);
            $data['question_info_left_right'] = json_decode($data['question_info_total'][0]['questionName']);
            $data['question_order_id'] = $question_order_id;

            $question_box .= '/matching';
        }
        if ($data['question_info_s'][0]['question_type'] == 6) {

            die;
            $quesInfo1 = json_decode($data['question_info_s'][0]['questionName']);
            $student_all_ans = json_decode($data['tutorial_ans_info'][0]['st_ans'], true);
            $student_ans = $student_all_ans[$question_order_id]['student_ans'];
            $std_ans_value = array();
            foreach ($student_ans as $std_ans) {
                $ans_data['cr']   = json_decode($std_ans)->cr;
                $ans_data['val']  = json_decode($std_ans)->val;
                $std_ans_value[$ans_data['cr']] = $ans_data;
            }
            $json_extract = new stdClass;
            foreach ($quesInfo1->skp_quiz_box as $key => $row) {
                $json_extract = json_decode($row);
                if ($json_extract->type == 'a') {
                    $qus_cr = $json_extract->cr;
                    if (isset($std_ans_value[$qus_cr])) {
                        $json_extract->val = $std_ans_value[$qus_cr]['val'];
                    }
                }
                $json_insertion[] = json_encode($json_extract);
            }

            $items = $this->indexQuesAns($json_insertion);
            $data['numOfRows'] = $quesInfo1->numOfRows;
            $data['numOfCols'] = $quesInfo1->numOfCols;
            $data['skp_box'] = $this->renderSkpQuizPrevTable($items, $data['numOfRows'], $data['numOfCols'], $showAns = 1, 'edit');

            $data['questionBody'] = $quesInfo1->question_body;
            $question_box .= '/skip_quiz';
        }

        if ($data['question_info_s'][0]['question_type'] == 8) {
            $this->check_assignment_copy($data);
        }

        if ($data['question_info_s'][0]['questionType'] == 9) {

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


            $question_box .= '/storyWrite';
        }

        if ($data['question_info_s'][0]['question_type'] == 10) {
            $data['question_info'] = json_decode($data['question_info_s'][0]['questionName'], true);
            $question_box .= '/times_table';
        }

        if ($data['question_info_s'][0]['question_type'] == 11) {
            $data['question_info'] = json_decode($data['question_info_s'][0]['questionName'], true);
            //            echo '<pre>';print_r($data['question_info']);die;
            $data['check_by_tutor'] = "yes";
            $question_box .= '/algorithm';
        }

        if ($data['question_info_s'][0]['question_type'] == 12) {
            $data['question_info'] = json_decode($data['question_info_s'][0]['questionName'], true);
            $data['workout_student_id'] = $student_id;
            $data['workout_module_id'] = $module_id;
            $data['workout_question_order_id'] = $question_order_id;
            $question_box .= '/workout_quiz';
        }

        if ($data['question_info_s'][0]['question_type'] == 15) {

            $data['all_question_answer'] = $data['tutorial_ans_info'];


            $data['question_item'] = $data['question_info_s'][0]['questionType'];
            $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['question_info_ind'] = $data['question_info'];


            if (isset($data['question_info_ind']->percentage_array)) {
                $data['ans_count'] = count((array)$data['question_info_ind']->percentage_array);
            } else {
                $data['ans_count'] = 0;
            }
            $question_box .= '/workout_quiz_two';
        }
        if ($data['question_info_s'][0]['question_type'] == 16) {
            $data['question_info_ind'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['workout_question_order_id'] = $question_order_id;
            $tutorial_ans_info = $data['tutorial_ans_info'][0]['st_ans'];
            $tutorial_ans_info = json_decode($tutorial_ans_info);

            // echo "<pre>";
            // print_r($tutorial_ans_info);
            // die();

            $data['student_answer'] = json_decode($tutorial_ans_info->$question_order_id->student_ans);

            $std_ans = array();
            if (isset($tutorial_ans_info->$question_order_id->student_ans)) {
                $std_ans = $tutorial_ans_info->$question_order_id->student_ans;
                $std_ans = is_array($std_ans) ? $std_ans : json_decode($std_ans);
                $std_ans = (array) $std_ans;
            }

            if ($data['question_info_ind']->pattern_type == 1) {
                $partOne = array();
                $partTwo = array();
                $partThree = array();
                $ans = array();
                $left_memorize_p_one = $data['question_info_ind']->left_memorize_p_one;
                $left_memorize_h_p_one = $data['question_info_ind']->left_memorize_h_p_one;
                $ans['left_memorize_p_one'] = $left_memorize_p_one;
                    if (isset($std_ans))
                    {
                        $first = $std_ans[0];
                        $new_increment=0;
                        foreach ($left_memorize_p_one as $key=>$item)
                        { 
                            if ($left_memorize_h_p_one[$key] == 1)
                            {
                                if ($item == $std_ans[$new_increment])
                                {
                                    $partOne[$key][0] = $item;
                                    $partOne[$key][1] = 1;
                                }else
                                {   
                                    $partOne[$key][0] = $std_ans[$new_increment];
                                    $partOne[$key][1] = 0;
                                }
                            }else{
                                $partOne[$key][0] = $item;
                                $partOne[$key][1] = 2;
                            }
                            $new_increment++;
                        }
                        $ans['partOne'] = $partOne;
                    }
                    if (isset($std_ans[1]))
                    {
                        $second = $std_ans[1];
                        $partTwo = $this->patternOne($left_memorize_p_one,$second);
                        $ans['partTwo'] = $partTwo;
                    }
                    if (isset($std_ans[2]))
                    {
                        $third = $std_ans[2];
                        $partThree = $this->patternOne($left_memorize_p_one,$third);
                        $ans['partThree'] = $partThree;
                    }
                    $data['std_ans'] = $ans;

            }

            if ($data['question_info_ind']->pattern_type == 2)
            {
                $ans = array();
                $left_memorize_p_two = $data['question_info_ind']->left_memorize_p_two;
                $left_memorize_h_p_two = $data['question_info_ind']->left_memorize_h_p_two;
                $right_memorize_p_two = $data['question_info_ind']->right_memorize_p_two;
                $right_memorize_h_p_two = $data['question_info_ind']->right_memorize_h_p_two;
                $left_ans = $std_ans['left'];

                $right_ans = $std_ans['student'];

                $ans['left_memorize_p_two'] =  $this->PatternTwo_left($left_memorize_p_two,$left_ans);
                $ans['right_memorize_p_two'] = $this->PatternTwo_right($right_memorize_p_two,$right_ans);

                $data['std_ans'] = $ans;
                // echo"<pre>";print_r($data['std_ans']);

            }
            if ($data['question_info_ind']->pattern_type == 3) {

                $data['question_step'] = $data['question_info_ind'];
                $data['student_answer'] = $data['tutorial_ans_info'][0]['st_ans'];

                $question_step = $data['question_info_ind']->question_step_memorize_p_three;


                $qus_setup_array = [];
                $k = 1;
                foreach ($question_step as $key => $value) {
                    $qus_setup_array[$key]['question_step'] = $value[0];
                    $qus_setup_array[$key]['clue'] = $value[1];
                    $qus_setup_array[$key]['ecplanation'] = $value[2];
                    $qus_setup_array[$key]['answer_status'] = $value[3];
                    if ($value[3] == 0) {
                        $qus_setup_array[$key]['order'] = $k;
                        $k = $k + 1;
                    } else {
                        $qus_setup_array[$key]['order'] = 0;
                    }
                }
                $data['qus_setup_array'] = $qus_setup_array;
            }
            if ($data['question_info_ind']->pattern_type == 4) {

                $ans = array();

                $ans['left_memorize_p_four'] =  $std_ans['left'];
                $ans['right_memorize_p_four'] = $std_ans['student'];

                $data['std_ans'] = $ans;
            }
            $data['pattern_type'] = $data['question_info_ind']->pattern_type;
            
            $data['m_4_std_answer'] = json_decode($tutorial_ans_info->$question_order_id->student_ans);

            $question_box .= '/memorization';
        }

        if ($data['question_info_s'][0]['question_type'] == 17) {
            $question_id = $data['question_info_s'][0]['question_id'];
            $data['student_ans_details']= $this->Student_model->get_student_ans($student_id,$question_id);
            // print_r($data['student_ans_details']);die();
            $data['question_info_ind'] = json_decode($data['question_info_s'][0]['questionName']);
            $question_box .= '/creative_quiz';
        }

        if ($data['question_info_s'][0]['question_type'] == 18) {
            $question_id = $data['question_info_s'][0]['question_id'];
            // print_r($data['student_ans_details']);die();
            $data['question_info_ind'] = json_decode($data['question_info_s'][0]['questionName']);
            $question_box .= '/sentence_match';
        }

        if ($data['question_info_s'][0]['question_type'] == 19) {
            $question_id = $data['question_info_s'][0]['question_id'];
            // print_r($data['student_ans_details']);die();
            $data['question_info_ind'] = json_decode($data['question_info_s'][0]['questionName']);
            $question_box .= '/word_memorization';
        }
        if ($data['question_info_s'][0]['question_type'] == 20) {
            $question_id = $data['question_info_s'][0]['question_id'];
            // print_r($data['student_ans_details']);die();
            $data['question_info_ind'] = json_decode($data['question_info_s'][0]['questionName']);
            $question_box .= '/comprehension';
        }
        if ($data['question_info_s'][0]['question_type'] == 21) {
            $question_id = $data['question_info_s'][0]['question_id'];
            // print_r($data['student_ans_details']);die();
            $data['question_info_ind'] = json_decode($data['question_info_s'][0]['questionName']);
            $question_box .= '/grammer';
        }
        if ($data['question_info_s'][0]['question_type'] == 22) {
            $question_id = $data['question_info_s'][0]['question_id'];
            // print_r($data['student_ans_details']);die();
            $data['question_info_ind'] = json_decode($data['question_info_s'][0]['questionName']);
            $question_box .= '/glossary';
        }

        if ($data['question_info_s'][0]['question_type'] != 8) {
            $data['question_box'] = $this->load->view($question_box, $data, true);

            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

            $data['maincontent'] = $this->load->view('tutors/check_student_copy/student_copy', $data, true);
            $this->load->view('master_dashboard', $data);
        }
    }

    public function patternOne($tutorAns, $stdAns)
    {
        $partTwo = array();
        foreach ($tutorAns as $key => $item) {
            if ($item == $stdAns[$key]) {
                $partTwo[$key][0] = $item;
                $partTwo[$key][1] = 1;
            } else {
                $partTwo[$key][0] = $stdAns[$key];
                $partTwo[$key][1] = 0;
            }
        }
        return $partTwo;
    }
    public function PatternTwo_left($main_ans, $left_answers)
    {
        $matchingAnswer = array();
        $new = array();
        $set_left_ans = array();

        foreach ($main_ans as $key => $value) {
            $TAns = str_replace(array('.',  "\n", "\t", "\r"), '', strip_tags($value[0]));
            $TAns = strtolower($TAns);
            $new[] = $TAns;
        }

        foreach ($left_answers as $key => $left_ans) {
            $left_ans = $left_ans - 1;

            foreach ($new as $key => $text) {

                if ($left_ans == $key) {
                    $set_left_ans[] = $text . "," . $left_ans;
                }
            }
        }
        return $set_left_ans;
    }
    public function PatternTwo_right($main_ans, $right_answers)
    {
        $new = array();
        $set_right_ans = array();


        foreach ($main_ans as $key => $value) {
            $TAns = str_replace(array('.',  "\n", "\t", "\r"), '', strip_tags($value[0]));
            $TAns = strtolower($TAns);
            $new[] = $TAns;
        }



        foreach ($right_answers as $key => $right_ans) {
            $right_ans = $right_ans - 1;

            foreach ($new as $key => $text) {

                if ($right_ans == $key) {
                    $set_right_ans[] = $text . "," . $right_ans;
                }
            }
        }
        //    print_r($set_right_ans);
        return $set_right_ans;
    }

    public function check_assignment_copy($data)
    {
        $quesInfo     = json_decode($data['question_info_s'][0]['questionName']);
        $questionBody            = isset($quesInfo->question_body) ? $quesInfo->question_body : '';
        $data['questionBody']    = $questionBody;
        $items                   = $quesInfo->assignment_tasks;
        $data['totalItems']      = count($items);
        $data['assignment_list'] = $this->renderAssignmentTasks($items);

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('tutors/check_student_copy/student_assignment_copy', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    /**
     * before passing items to renderSkpQuizPrevTable() index it first with this func
     *
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
            $row .= '<tr id="' . ($task->serial + 1) . '">';
            $row .= '<td>' . ($task->serial + 1) . '</td>';
            $row .= '<td>' . $task->qMark . '</td>';
            $row .= '<td>' . $task->qMark . '</td>';
            $row .= '<td><a class="qDtlsOpenModIcon" data-toggle="modal" data-target="#quesDtlsModal"><img src="assets/images/icon_details.png"></a></td>';
            $row .= '<input type="hidden" id="hiddenTaskDesc" value="' . $task->description . '">';
            $row .= '</tr>';
        }

        return $row;
    } //end renderAssignmentTasks()



    public function st_progress_update_answer_workout_quiz()
    {
        $ans_id = $this->input->post('ans_id');
        $text_answer = $this->input->post('text_answer');
        $workout_question_order_id = $this->input->post('workout_question_order_id');

        $data['student_ans_info'] = $this->Tutor_model->getInfo('tbl_student_answer', 'id', $ans_id);
        $value = json_decode($data['student_ans_info'][0]['st_ans']);

        $std_answer = array();
        $answer = array();
        foreach ($value as $key => $content) {
            $order_id = $content->question_order_id;
            $std_answer['question_order_id'] = $content->question_order_id;
            $std_answer['module_type'] = $content->module_type;
            $std_answer['module_id'] = $content->module_id;
            $std_answer['question_id'] = $content->question_id;
            $std_answer['link'] = $content->link;
            if ($order_id == $workout_question_order_id) {
                $std_answer['student_ans'] = $text_answer;
            } else {
                $std_answer['student_ans'] = $content->student_ans;
            }
            $std_answer['workout'] = $content->workout;
            $std_answer['student_taken_time'] = $content->student_taken_time;
            $std_answer['student_question_marks'] = $content->student_question_marks;
            $std_answer['student_marks'] = $content->student_marks;
            $std_answer['ans_is_right'] = $content->ans_is_right;


            $answer[$key] = $std_answer;
        }

        $up['st_ans'] = json_encode($answer);
        $result = $this->db->where('id', $ans_id)->update('tbl_student_answer', $up);

        if (!empty($result)) {
            $response = array(
                'success' => true,
                'error' => false,
                'msg' => 'successfully changed.',
            );
        } else {
            $response = array(
                'success' => false,
                'error' => true,
                'msg' => 'failed!please try again.',
            );
        }

        echo json_encode($response);
        //        echo '<pre>';
        //        print_r($up['st_ans']);
        //        print_r($answer);
        ////        print_r($answer);
        //        die();
    }

    public function st_progress_image_update_answer_workout_quiz()
    {
        $ans_id = $this->input->post('ans_id');
        $workout_question_order_id = $this->input->post('workout_question_order_id');
        $imageLink = $this->input->post('imageLink');

        $data['student_ans_info'] = $this->Tutor_model->getInfo('tbl_student_answer', 'id', $ans_id);
        $value = json_decode($data['student_ans_info'][0]['st_ans']);


        $std_answer = array();
        $answer = array();
        foreach ($value as $key => $content) {
            $order_id = $content->question_order_id;
            $std_answer['question_order_id'] = $content->question_order_id;
            $std_answer['module_type'] = $content->module_type;
            $std_answer['module_id'] = $content->module_id;
            $std_answer['question_id'] = $content->question_id;
            $std_answer['link'] = $content->link;
            $std_answer['student_ans'] = $content->student_ans;
            if ($order_id == $workout_question_order_id) {
                $std_answer['workout'] = $imageLink;
            } else {
                $std_answer['workout'] = $content->workout;
            }
            $std_answer['student_taken_time'] = $content->student_taken_time;
            $std_answer['student_question_marks'] = $content->student_question_marks;
            $std_answer['student_marks'] = $content->student_marks;
            $std_answer['ans_is_right'] = $content->ans_is_right;


            $answer[$key] = $std_answer;
        }

        $up['st_ans'] = json_encode($answer);
        $result = $this->db->where('id', $ans_id)->update('tbl_student_answer', $up);

        if (!empty($result)) {
            $response = array(
                'success' => true,
                'error' => false,
                'msg' => 'successfully updated workout.',
            );
        } else {
            $response = array(
                'success' => false,
                'error' => true,
                'msg' => 'failed!please try again.',
            );
        }

        echo json_encode($response);
    }
}
