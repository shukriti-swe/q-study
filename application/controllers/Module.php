<?php
/**
 * Module controller class
 */
class Module extends CI_Controller
{

    public $loggedUserId, $loggedUserType;


    public function __construct()
    {
        parent::__construct();

        $user_id              = $this->session->userdata('user_id');
        $user_type            = $this->session->userdata('userType');
        $this->loggedUserId   = $user_id;
        $this->loggedUserType = $user_type;

        if ($user_id == null && $user_type == null) {
            redirect('welcome');
        }
        
        $this->load->model('Parent_model');
        $this->load->model('Admin_model');
        $this->load->model('tutor_model');
        $this->load->model('Student_model');
        $this->load->model('FaqModel');
        $this->load->model('ModuleModel');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->model('Preview_model');
        $this->load->model('QuestionModel');
        $this->load->helper('CommonMethods');
        
        $user_info = $this->Preview_model->userInfo($user_id);
        
        if ($user_info[0]['countryCode'] == 'any') {
            $user_info[0]['zone_name'] = 'Australia/Lord_Howe';
        }
        
        $this->site_user_data = array(
            'userType' => $user_type,
            'zone_name' => $user_info[0]['zone_name'],
            'country_id' => $user_info[0]['country_id'],
        );
    }//end __construct()


    public function view_course()
    {
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header']     = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $data['maincontent'] = $this->load->view('module/view_course', $data, true);
        $this->load->view('master_dashboard', $data);
    }//end view_course()


    
    /**
     * Responsible for viewing module types(tutorial, everyday study, assignment).
     *
     * @return void
     */
    public function allModuleType()
    {
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header']     = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $data['maincontent'] = $this->load->view('module/all_module_type', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function tutorList($moduleType)
    {
        if (!strpos($_SERVER['HTTP_REFERER'],"all_tutors_by_type")) {
            $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
        }else{
            $_SESSION['prevUrl'] = base_url('/').'student/organization';
        }
        $loggedStudentId  = $this->loggedUserId;
        $studentsTutor = $this->Student_model->allTutor($loggedStudentId);
        
        //all tutor ids of a student
        $allTutorIds = array_column($studentsTutor, 'id');
        //all tutor ids of a student filtered down by module type
        // $data['allTutors'] = $this->Student_model->allTutorByModuleType($moduleType, $allTutorIds);
        $all_parents = $this->Student_model->all_assigners_new($loggedStudentId);
                
        $data['module_type'] = $moduleType;
        $i = 0;
        $allTutor = array();
        foreach ($all_parents as $row) {
            $ckSchoolCorporateExits = $this->Student_model->ckSchoolCorporateExits('tbl_useraccount', 'SCT_link' , $row['SCT_link'] );

            if (count($ckSchoolCorporateExits) == 0 ) {
                $allTutor[] = $row;
            }


            $get_child_info = $this->Student_model->getInfo('tbl_useraccount', 'parent_id', $row['id']);
            if ($get_child_info) {
                $allTutor[$i]['child_info'] = $get_child_info;
            }
            $i++;
        }


        foreach ($all_parents as $row) {
            $get_child_info = $this->Student_model->getInfo('tbl_useraccount', 'parent_id', $row['id']);
            if ($get_child_info) {
                $all_parents[$i]['child_info'] = $get_child_info;
            }
            $i++;
        }


        $data['allTutors'] = $allTutor;
        
        $data['module_type'] = $moduleType;
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header']     = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $data['maincontent'] = $this->load->view('module/tutor_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function all_module()
    {
        $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
        if ( strpos($_SESSION['prevUrl'],"edit-module") || strpos($_SESSION['prevUrl'],"add-module")  ) {
            if (!empty($_GET['country'])) {
                $_SESSION['prevUrl'] = base_url('/qstudy/view_course/?country=').$_GET['country'];
            }else{
                $_SESSION['prevUrl'] = base_url('/qstudy/view_course/');
            }
        }  

        $data['video_help'] = $this->FaqModel->videoSerialize(25, 'video_helps'); //rakesh
        $data['video_help_serial'] = 25;

        $user_id = $this->session->userdata('user_id');
        $data['user_info'] = $this->tutor_model->userInfo($user_id);
        $conditions = [
            'user_id' => $user_id,
            'country' => isset($_GET['country']) ? $_GET['country'] : '',
        ];
        $conditions = array_filter($conditions);
        //$data['all_module'] = $this->Admin_model->search('tbl_module', $conditions);
        $data['all_module'] = $this->Admin_model->getModule('tbl_module', $conditions);

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header']     = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        //set session if come from qstudy counse/country page
        if (isset($_GET['country']))
        {
            $_SESSION['modInfo']['country'] = $_GET['country'];
        }else{

            if (isset($_SESSION['modInfo']['country']))
            {
                $_SESSION['modInfo']['country'] = $_SESSION['modInfo']['country'];
            }else{
                $_SESSION['modInfo']['country'] = '';
            }
        }
        //$_SESSION['modInfo']['country'] = isset($_GET['country']) ? $_GET['country'] : '';

        
        $data['all_grade']          = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_module_type']    = $this->tutor_model->getAllInfo('tbl_moduletype');

        $data['all_subject']        = $this->tutor_model->getInfo('tbl_subject', 'created_by', $user_id);
        $data['all_course']        = $this->Admin_model->search('tbl_course', [1=>1]);
        $data['allRenderedModType'] = $this->renderAllModuleType();
        //echo "<pre>";print_r($data['all_subject']);die();

        $data['allCountry']  = $this->admin_model->search('tbl_country', [1=>1]);
 
        //$studentIds          = $this->tutor_model->allStudents(['sct_id' => $user_id]);
        //$data['allStudents'] = $this->renderStudentIds($studentIds);
        
         // check password added shvou
        $data['checkNullPw'] = $this->db->where("setting_key", "qstudyPassword")->where("setting_type !=", '')->get('tbl_setting')->result_array();
        $data['maincontent'] = $this->load->view('module/all_module', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    //end all_module()

    /**
     * Tutor can set module repetition days(works while module edit)
     *
     * @param integer $moduleId module id
     *
     * @return void
     */
    public function setRepetitionDays($moduleId)
    {
        $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
        $uType = $this->loggedUserType;
        if ($uType==1 || $uType==2 || $uType==6) {
            //user type parent, upper student,student shouldn't add module
            $this->session->set_flashdata('error_msg', "You've no access to view this page");
            redirect('/');
        }

        $post = $this->input->post();
        
        $module = $this->ModuleModel->moduleInfo($moduleId);
        if (!sizeof($module)) {
            $this->session->set_flashdata('error_msg', 'Module not exists.');
            redirect('all-module');
        }

        $user_id                = $this->session->userdata('user_id');
        $data['loggedUserType'] = $this->loggedUserType;
        $data['user_info']      = $this->tutor_model->userInfo($user_id);
        $data['module_info']    = $module;
        
        if (!$post) {
            $sl_date = json_decode($module['repetition_days']);
            $data['selectedSl'] = [];
            $sl_date = count($sl_date) ? $sl_date: [];
            foreach ($sl_date as $item) {
                $temp = explode('_', $item);
                $data['selectedSl'][] = $temp[0];
            }
            
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['header']     = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
            $data['maincontent']  = $this->load->view('module/set_module_repetition_days', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            
            $dataToUpdate[] = [
                'id'              =>$moduleId,
                'repetition_days' => json_encode($post['sl_date'])
            ];

            $this->ModuleModel->update('tbl_module', $dataToUpdate, 'id');
            $this->session->set_flashdata('success_msg', 'Repetition days added successfully');
            redirect('module/repetition/'.$moduleId);
        }
    }
    

    /**
     * Add module (view part)
     *
     * @return void
     */
    public function add_module()
    {
       
        if(array_key_exists("HTTP_REFERER",$_SERVER)){
            $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
        }else{
            $_SESSION['prevUrl'] = '';
        }

        $data['video_help'] = $this->FaqModel->videoSerialize(26, 'video_helps'); //rakesh
        $data['video_help_serial'] = 26;

        $uType = $this->loggedUserType;
        if ($uType==1 || $uType==2 || $uType==6) {
            //user type parent, upper student,student shouldn't add module
            $this->session->set_flashdata('error_msg', "You've no access to view this page");
            redirect('/');
        }

        $user_id                = $this->session->userdata('user_id');
        $data['loggedUserType'] = $this->loggedUserType;
        $data['user_info']      = $this->tutor_model->userInfo($user_id);

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header']     = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
        
        $selected_id = '';
        if ($this->loggedUserType != 7) {
            $selected_id = $data['user_info'][0]['country_id'];
        }

        $data['all_module']        = $this->tutor_model->getInfo('tbl_module', 'user_id', $user_id);
        $data['all_module_type']   = $this->tutor_model->getAllInfo('tbl_moduletype');
        $data['all_course']        = $this->tutor_model->getAllInfo('tbl_course');
        
        $data['all_country']       = $this->renderAllCountry($selected_id);
        $data['all_subjects']      = $this->renderAllSubject();
        $data['all_chapters']      = $this->renderAllChapter();
        $data['all_module_type']   = $this->renderAllModuleType();
        
        $data['all_question_type'] = $this->tutor_model->getAllInfo('tbl_questiontype');
        foreach ($data['all_question_type'] as $row) {
            $question_list[$row['id']] = $this->tutor_model->getUserQuestion('tbl_question', $row['id'], $user_id);
        }
  
        $data['all_question'] = $question_list;
        $studentIds = $this->tutor_model->allStudents(['sct_id' => $user_id]);
        //echo "<pre>"; print_r($studentIds);die;
        $data['allStudents']  = $this->renderStudentIds($studentIds);
        
        $data['maincontent']  = $this->load->view('module/add_module', $data, true);
        $this->load->view('master_dashboard', $data);
    }//end add_module()


    public function getStudentByGradeCountry()
    {
        $student_grade = $this->input->post('studentGrade');
        $country_id = $this->input->post('country_id');
        $user_id = $this->session->userdata('user_id');
        
        $students = $this->ModuleModel->getStudentByGradeCountry($student_grade, $country_id, $user_id);
        foreach ($students as $row) {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
    }
    
    public function get_course()
    {
        $student_grade = $this->input->post('studentGrade');
        if ($student_grade <= 12) {
            $get_course = $this->ModuleModel->getInfo('tbl_course', 'user_type', 1);
        } else {
            $get_course = $this->ModuleModel->getInfo('tbl_course', 'user_type', 2);
        }
        $html = '<option>Select course</option>';
        foreach ($get_course as $row) {
            $html .= '<option value="' . $row['id'] . '">' . $row['courseName'] . '</option>';
        }
        echo $html;
    }
    
    public function getIndividualStudent()
    {

        $uType = $this->loggedUserType;
        if ($uType==1 || $uType==2 || $uType==6) {
            //user type parent, upper student,student shouldn't add module
            $this->session->set_flashdata('error_msg', "You've no access to view this page");
            redirect('/');
        }

        $student_grade = $this->input->post('studentGrade');
        $tutor_type = $this->input->post('tutor_type');
        $country_id = '';
        $subject = '';
        $user_id = '';
        $subject_name = '';
        $course_id = '';
        
        if (($this->input->post('course_id'))) {
            $course_id = $this->input->post('course_id');
        }
        if ($this->input->post('country_id') != '') {
            $country_id = $this->input->post('country_id');
        }
        if ($tutor_type == 7 && $this->input->post('subject') != '') {
            // $subject = $this->input->post('subject');

            // $subject_info = $this->ModuleModel->search('tbl_subject', ['subject_id'=>$subject]);

            // $subject_name = $subject_info[0]['subject_name'];
        }if ($tutor_type == 3) {
            $user_id = $this->session->userdata('user_id');
        }
        
        $students = $this->ModuleModel->getIndividualStudent($student_grade, $tutor_type, $country_id, $subject_name, $user_id, $course_id);
        foreach ($students as $row) {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
    }

    /**
     * Responsible for saving module data.
     *
     * @return void
     */
    public function saveModuleQuestion()
    {
        echo "<pre>"; print_r($_POST); die();
        $uType = $this->loggedUserType;
        if ($uType==1 || $uType==2 || $uType==6) {
            //user type parent, upper student,student shouldn't add module
            $this->session->set_flashdata('error_msg', "You've no access to view this page");
            redirect('/');
        }

        $post              = $this->input->post();
        if ($post['moduleType'] == 1 || $post['moduleType'] == 2 || $post['moduleType'] == 5)
        {
            $post['dateCreated'] = date('Y-m-d');
        }
        $date = $post['dateCreated'];

        $startTime = date('Y-m-d', strtotime($date)).' '.$post['startTime'];
        $endTime = date('Y-m-d', strtotime($date)).' '.$post['endTime'];
        
        $video_link = str_replace('</p>', '', $_POST['video_link']);
        $video_array = array_filter(explode('<p>', $video_link));
        
        $new_array = array();
        foreach ($video_array as $row) {
            $new_array[] = strip_tags($row);
        }
        // print_r(json_encode($video_array));die;
        //$video_link[] = $this->input->post('video_link');

        $clean             = $this->security->xss_clean($post);

        $optionalTime      = explode(':', isset($clean['optTime']) ? $clean['optTime'] : "0:0");
        $optionalHour      = isset($optionalTime[0]) ? (int)$optionalTime[0]*60*60 : 0; //second
        $optionalMinute    = isset($optionalTime[1]) ? (int)$optionalTime[1]*60    : 0; //second
        
        //get users latest module order
        $mods = $this->Admin_model->search('tbl_module', ['user_id'=>$this->loggedUserId]);
        if (count($mods)) {
            $allOrders = array_column($mods, 'ordering');
            $maxOrder = max($allOrders);
            $nextOrder = $maxOrder+1;
        } else {
            $nextOrder = 0;
        }

        $moduleTableData   = [];
        $moduleTableData[] = [
            'moduleName'        => $clean['moduleName'],
            'ordering'          => $nextOrder,
            'trackerName'       => $clean['trackerName'],
            'instruction'       => $clean['instruction'],
            'individualName'    => isset($clean['individualName']) ? $clean['individualName'] : '',
            'isSMS'             => isset($clean['isSMS']) ? $clean['isSMS'] : 0,
            'isAllStudent'      => isset($clean['isAllStudent']) ? $clean['isAllStudent'] : 0,
            'individualStudent' => isset($clean['individualStudent']) ? json_encode($clean['individualStudent']) : '',
            'course_id'         => isset($clean['course_id']) ? $clean['course_id'] : '',
            'video_link'        => json_encode($new_array),
            'video_name'        => isset($_POST['video_name']) ? $_POST['video_name']:'',
            'subject'           => $clean['subject'],
            'chapter'           => $clean['chapter'],
            'country'           => isset($clean['country'])?$clean['country']:'AUS',
            'studentGrade'      => $clean['studentGrade'],
            'moduleType'        => $clean['moduleType'],
            'user_id'           => $this->loggedUserId,
            'user_type'         => $this->loggedUserType,
            'exam_date'         => isset($clean['dateCreated']) ? strtotime($clean['dateCreated']) : 0,
            'exam_start'        => isset($clean['startTime']) ? ($startTime) : 0,
            'exam_end'          => isset($clean['endTime']) ? ($endTime) : 0,
            'optionalTime'      => $optionalHour+$optionalMinute,
        ];

        // print_r($moduleTableData); die();
        // Save module info first
        $moduleId = $this->ModuleModel->insert('tbl_module', $moduleTableData);
        $module_insert_id = $this->db->insert_id();

        // If ques order set record those to tbl_modulequestion table
        $arr   = [];
        $items = isset($clean['qId_ordr']) ? array_filter($clean['qId_ordr']) : [];
        
        if (count($items)) {
            foreach ($items as $qId_ordr) {
                $temp  = explode('_', $qId_ordr);
                $question_info = $this->ModuleModel->getInfo('tbl_question', 'id', $temp[0]);
                $arr[] = [
                    'question_id'    => $temp[0],
                    'question_type'  => $question_info[0]['questionType'],
                    'module_id'      => $moduleId,
                    'question_order' => $temp[1],
                    'created'        => time(),
                ];
            }

            $this->ModuleModel->insert('tbl_modulequestion', $arr);
        }

        //no need to save module<=>student ids as the student ids storing with module
        
        //Save individual student/all student ids on tbl_module_student table
        /*$dataToInsert = [];
        if(isset($clean['isAllStudent'])){
            $allStudentIds = $this->Student_model->allStudents(['sct_id' => $this->loggedUserId]);

        } else if (isset($clean['individualStudent'])){
           $allStudentIds = $clean['individualStudent'];
        }
        foreach ($allStudentIds as $studentId) {
        $dataToInsert[] = array(
            'module_id'  => $moduleId,
            'student_id' => $studentId,
            );
        }
        $this->ModuleModel->insert('tbl_module_student', $dataToInsert);*/

        if ($clean['moduleType'] == 2) {
            $repetition_data = [];
            $a = [];
            $i = 0;
            $j = 1;
            $date = date('Y-m-d');
            while($j<365){
                $j = $i*30+1;
                $a[] =$j.'_'.date('Y-m-d', strtotime($date.' +'.$j .' days'));;
                $j+=1;
                $a[] =$j.'_'.date('Y-m-d', strtotime($date.' +'.$j .' days'));;
                $i++;
                if ($j == 362) {
                    break;
                }
            } 

            $repetition_days = json_encode($a);
            $this->db->where('id',$module_insert_id)->update('tbl_module',['repetition_days' => $repetition_days]);
        }
        
        if ($moduleId) {
            echo $moduleId;
            // Module recorded.
        } else {
            echo 'false';
            // Module record failed.
        }

        // $this->session->set_flashdata('success_msg', 'Module Saved Successfully.');
        // redirect('all-module');
    }//end saveModuleQuestion()


    /**
     * This method will duplicate  a module with additional info given
     *
     * @return void
     */
    public function moduleDuplicate()
    {
        $uType = $this->loggedUserType;
        if ($uType == 1 || $uType == 2 || $uType == 6) {
            //user type parent, upper student,student shouldn't add module
            $this->session->set_flashdata('error_msg', "You've no access to view this page");
            redirect('/');
        }

        $post   = $this->input->post();
        //$moduleType = $post['moduleType'];
        // echo "<pre>";print_r($post);die();
        $date = $post['examDate'];
        $startTime = date('Y-m-d', strtotime($date)).' '.$post['startTime'];
        $endTime = date('Y-m-d', strtotime($date)).' '.$post['endTime'];

        $optionalTime      = explode(':', isset($post['optTime'])?$post['optTime']:"0:0");
        $optionalHour      = isset($optionalTime[0]) ? (int)$optionalTime[0]*60*60 : 0; //second
        $optionalMinute    = isset($optionalTime[1]) ? (int)$optionalTime[1]*60    : 0; //second
        
        $newMod = $this->security->xss_clean($post);
        // echo '<pre>';print_r($newMod);die;
        $origModId  = $newMod['origModId'];
        $origMod    = $this->ModuleModel->moduleInfo($origModId);
        
        // $module_info =  $this->ModuleModel->moduleTypeBasedInfo($moduleType);
        
        // echo $origMod['ordering'];
        // print_r($origMod);die();

        if ($post['subject'] != '') {
            $subject_id = $post['subject'];
        }

        if ( $post['chapter'] != '') {
            $chapter_id = $post['chapter'];
        }


        if ($post['subject_name'] != '' && $post['chapterName'] != '') {

            $subject_name = $post['subject_name'];
            $chapterName = $post['chapterName'];

            $data['created_by'] = $this->session->userdata('user_id');
            $data['subject_name'] = $subject_name;

            $this->db->insert('tbl_subject', $data);
            $subject_id = $this->db->insert_id();


            $post_data['subjectId'] = $subject_id;
            $post_data['chapterName'] = $chapterName;
            $post_data['created_by'] = $this->session->userdata('user_id');
            $chapter = $this->tutor_model->insertInfo('tbl_chapter', $post_data);

            $this->db->insert('tbl_chapter', $data);
            $chapter_id = $this->db->insert_id();

        }


        if (isset($subject_id) && isset($chapter_id)) {
            $subject = $subject_id;
            $chapter = $chapter_id;
        }else{
            $subject = $origMod['subject'];
            $chapter = $origMod['chapter'];
        }


        // echo '<pre>';echo $subject;echo "<br>";echo $chapter; die;
        
        $newModName = isset($newMod['moduleName']) ? $newMod['moduleName'] : '';
        //if country name or student grade changed only then same module name permissible
        if ($newModName == $origMod['moduleName'] /*&& $origMod['country'] == $newMod['country']*/ && $origMod['studentGrade'] == $newMod['studentGrade']) {
            echo 'false';
            die;
        } else {
            $moduleTableData   = [];
            $moduleTableData[] = [
                'moduleName'        => $newMod['moduleName'],
                'trackerName'       => $origMod['trackerName'],
                'individualName'    => $origMod['individualName'],
                'isSMS'             => isset($newMod['respToSMS']) ? $newMod['respToSMS'] : 0,
                'isAllStudent'      => isset($newMod['isAllStudent']) ? $newMod['isAllStudent'] : 0,
                // 'individualStudent' => isset($newMod['individualStudent']) ? json_encode($newMod['individualStudent']) : $origMod['individualStudent'],
                'individualStudent' => isset($post['indivStIds']) ? json_encode($post['indivStIds']) : '',
                'course_id'         => isset($origMod['course_id']) ? $origMod['course_id'] : '',
                'subject'           => $subject,
                'chapter'           => $chapter,
                'country'           => $origMod['country'],
                'studentGrade'      => $newMod['studentGrade'],
                'moduleType'        => $newMod['moduleType'],
                'user_id'           => $this->loggedUserId,
                'user_type'         => $this->loggedUserType,
                'exam_date'         => isset($newMod['examDate']) ? strtotime($newMod['examDate']) : time(),
                'exam_start'        => isset($startTime)  ? ($startTime) : $origMod['exam_start'],
                'exam_end'          => isset($endTime) ? ($endTime) : $origMod['exam_end'],
                'optionalTime'      => isset( $optionalHour )  ? ( $optionalHour+$optionalMinute ) : $origMod['optionalTime'],
            ];
            
            // echo '<pre>';print_r($moduleTableData);die;
            // Save module info first
            $newModuleId = $this->ModuleModel->insert('tbl_module', $moduleTableData);
            $origModQues = $this->ModuleModel->moduleQuestion($origModId);
            $arr         = [];
            if (count($origModQues)) {
                foreach ($origModQues as $ques) {
                    $question_info = $this->ModuleModel->getInfo('tbl_question', 'id', $ques['question_id']);

                    $new_question_info = $this->ModuleModel->insertNewQus('tbl_question', 'id', $ques['question_id'],$newMod['studentGrade'],$subject,$chapter);
                    $arr[] = [
                        // 'question_id'    => $ques['question_id'], old
                        'question_id'    => $new_question_info[0]['id'],
                        'question_type'  => $new_question_info[0]['questionType'],
                        'module_id'      => $newModuleId,
                        'question_order' => $ques['question_order'],
                        'created'        => time(),
                    ];
                }

                $this->ModuleModel->insert('tbl_modulequestion', $arr);
            }

            echo 'true';
        }//end if
    }//end moduleDuplicate()

    
    public function editModule($moduleId)
    {
        $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
        $data['video_help'] = $this->FaqModel->videoSerialize(26, 'video_helps'); //rakesh
        $data['video_help_serial'] = 26;

        $_SESSION["moduleId"] = $moduleId; 
        $uType = $this->loggedUserType;
        if ($uType==1 || $uType==2 || $uType==6) {
            //user type parent, upper student,student shouldn't add module
            $this->session->set_flashdata('error_msg', "You've no access to view this page");
            redirect('/');
        }

        $this->session->unset_userdata('data');
        $this->session->unset_userdata('obtained_marks');
        $this->session->unset_userdata('total_marks');
        
        $user_id                = $this->session->userdata('user_id');
        $data['loggedUserType'] = $this->loggedUserType;
        $data['user_info']      = $this->tutor_model->userInfo($user_id);

        $module = $this->ModuleModel->moduleInfo($moduleId);
        if (!sizeof($module)) {
            $this->session->set_flashdata('error_msg', 'Module not exists.');
            redirect('all-module');
        } else {
            $chaps = $this->get_chapter_name($module['subject'], $module['chapter']);
            $data['all_chapters'] = $chaps;
            $module['chapter'] = $chaps;
            $this->session->set_userdata('modInfo', $module);
        }
        
        if ($module['studentGrade'] <= 12) {
            $data['get_course'] = $this->ModuleModel->getInfo('tbl_course', 'user_type', 1);
        } else {
            $data['get_course'] = $this->ModuleModel->getInfo('tbl_course', 'user_type', 2);
        }

        $moduleQuestion = $this->ModuleModel->moduleQuestion($moduleId);
        $quesOrdrMap    = [];
        foreach ($moduleQuestion as $temp) {
            $quesOrdrMap[$temp['question_id']] = $temp['question_order'];
        }

        $data['qoMap']      = $quesOrdrMap;
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header']     = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
        $user_id            = $this->session->userdata('user_id');

        $data['module_info']       = $module;
        $data['all_country']       = $this->renderAllCountry($module['country']);
        $data['all_subjects']      = $this->renderAllSubject($module['subject']);
        //$data['all_chapters']      = $this->renderAllChapter($module['chapter']);
        //echo '<pre>';print_r($data['all_chapters']);die;
        $data['all_module_type']   = $this->renderAllModuleType($module['moduleType']);
        $data['all_question_type'] = $this->tutor_model->getAllInfo('tbl_questiontype');

        $optionalHour              = $module['optionalTime']>3600 ? sprintf('%02d', $module['optionalTime']/3600) : "00";
        $optionalMinute            = sprintf('%02d', ($module['optionalTime']/60) - ($optionalHour*60));
        $data['optionalTime']      = (string)$optionalHour.':'.$optionalMinute;

        $data['instruction_video'] = json_decode($data['module_info']['video_link']);
        $data['instruction_video'] = (is_array($data['instruction_video']) && count($data['instruction_video'])) ? $data['instruction_video'][0] : '';
        $data['ins'] = $data["module_info"]["instruction"];
        
        foreach ($data['all_question_type'] as $row) {
            $question_list[$row['id']] = $this->tutor_model->getUserQuestion('tbl_question', $row['id'], $user_id);
        }
        $data['all_question'] = $question_list;
        
        $indivStdIds          = $module['individualStudent'];
        
        if ($this->loggedUserType==7) { //q-stydy need this kinda filter
            $conditions = [
                'subject_name'   =>$module['subject'],
                'student_grade'  =>$module['studentGrade'],
                'country_id'     => $module['country'],
            ];
            $studentIds           = $this->tutor_model->allStudents($conditions);
        } else { //others don't . I dont know if I'm getting maaad :/
            $studentIds           = $this->tutor_model->allStudents(['sct_id' => $user_id]);
        }


        $data['allStudents']  = $this->renderStudentIds($studentIds, $indivStdIds);

        $data['maincontent'] = $this->load->view('module/edit_module', $data, true);
        $this->load->view('master_dashboard', $data);
    }//end editModule()


    public function updateRequestedModule()
    {
        
        $uType = $this->loggedUserType;
        if ($uType==1 || $uType==2 || $uType==6) {
            //user type parent, upper student,student shouldn't add module
            $this->session->set_flashdata('error_msg', "You've no access to view this page");
            redirect('/');
        }

        $post = $this->input->post();
        
        $date = $post['dateCreated'];
        $startTime = date('Y-m-d', strtotime($date)).' '.$post['startTime'];
        $endTime = date('Y-m-d', strtotime($date)).' '.$post['endTime'];
        
        $video_link = str_replace('</p>', '', $_POST['video_link']);
        $video_array = array_filter(explode('<p>', $video_link));
        $new_array = array();
        foreach ($video_array as $row) {
            $new_array[] = strip_tags($row);
        }
        
        $optionalTime      = explode(':', isset($post['optTime'])?$post['optTime']:"0:0");
        $optionalHour      = isset($optionalTime[0]) ? (int)$optionalTime[0]*60*60 : 0; //second
        $optionalMinute    = isset($optionalTime[1]) ? (int)$optionalTime[1]*60    : 0; //second

        $clean             = $this->security->xss_clean($post);
        $moduleToUpdate    = $clean['moduleId'];
        $moduleTableData   = [];
        $moduleTableData[] = [
            'id'                => $moduleToUpdate,
            'moduleName'        => $clean['moduleName'],
            'trackerName'       => $clean['trackerName'],
            'individualName'    => isset($clean['individualName']) ? $clean['individualName'] : '',
            'isSMS'             => isset($clean['isSMS']) ? $clean['isSMS'] : 0,
            'video_link'        => json_encode($new_array),
            'instruction'       => $clean['instruction'],
            'video_name'        => isset($clean['video_name']) ? $clean['video_name'] : '',
            'isAllStudent'      => isset($clean['isAllStudent']) ? $clean['isAllStudent'] : 0,
            'individualStudent' => isset($clean['individualStudent']) ? json_encode($clean['individualStudent']) : '',
            'course_id'         => isset($clean['course_id']) ? $clean['course_id'] : '',
            'subject'           => $clean['subject'],
            'chapter'           => $clean['chapter'],
            'country'           => $clean['country'],
            'studentGrade'      => $clean['studentGrade'],
            'moduleType'        => $clean['moduleType'],
            'user_id'           => $this->loggedUserId,
            'user_type'         => $this->loggedUserType,
            'exam_date'         => isset($clean['dateCreated']) ? strtotime($clean['dateCreated']) : time(),
            'exam_start'        => isset($clean['startTime']) ? ($startTime) : 0,
            'exam_end'          => isset($clean['endTime']) ? ($endTime) : 0,
            'optionalTime'      => $optionalHour+$optionalMinute,
        ];

        // Update module info first
        $this->ModuleModel->update('tbl_module', $moduleTableData, 'id');

        // If ques order set, delete recorded module_question first,
        // then insert requested data to tbl_modulequestion table
        $arr   = [];
        $items = isset($clean['qId_ordr']) ? array_filter($clean['qId_ordr']) : [];
        if (count($items)) {
            $this->ModuleModel->deleteModuleQuestion($moduleToUpdate);
            foreach ($items as $qId_ordr) {
                $temp  = explode('_', $qId_ordr);
                $question_info = $this->ModuleModel->getInfo('tbl_question', 'id', $temp[0]);
                $arr[] = [
                    'question_id'    => $temp[0],
                    'question_type'  => $question_info[0]['questionType'],
                    'module_id'      => $moduleToUpdate,
                    'question_order' => $temp[1],
                    'created'        => time(),
                ];
            }

            $this->ModuleModel->insert('tbl_modulequestion', $arr);
        }

        echo 'true';
    }//end updateRequestedModule()


    /**
     * Module reorder view part
     *
     * @return void
     */
    public function reorderModule_old()
    {
        $uType = $this->loggedUserType;
        if ($uType==1 || $uType==2 || $uType==6) {
            //user type parent, upper student,student shouldn't add module
            $this->session->set_flashdata('error_msg', "You've no access to view this page");
            redirect('/');
        }

        $user_id                = $this->session->userdata('user_id');
        $data['loggedUserType'] = $this->loggedUserType;
        $data['user_info']      = $this->tutor_model->userInfo($user_id);

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header']     = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $user_id                    = $this->session->userdata('user_id');
        $data['user_info']          = $this->tutor_model->userInfo($user_id);
        $data['all_module']         = $this->ModuleModel->allModule();
        $data['all_grade']          = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_module_type']    = $this->tutor_model->getAllInfo('tbl_moduletype');
        $data['all_course']         = $this->tutor_model->getAllInfo('tbl_course');
        $data['allRenderedModType'] = $this->renderAllModuleType();
        $data['all_country']        = $this->renderAllCountry();
        $data['row']                = $this->renderReorderPageModule($data['all_module']);
        $studentIds                 = $this->tutor_model->allStudents(['sct_id' => $user_id]);
        $data['allStudents']        = $this->renderStudentIds($studentIds);

        $data['maincontent'] = $this->load->view('module/reorder_module', $data, true);
        $this->load->view('master_dashboard', $data);
    }//end reorderModule()

    public function reorderModule()
    {
        $uType = $this->loggedUserType;
        if ($uType==1 || $uType==2 || $uType==6) {
            //user type parent, upper student,student shouldn't add module
            $this->session->set_flashdata('error_msg', "You've no access to view this page");
            redirect('/');
        }

        $user_id                = $this->session->userdata('user_id');
        $data['loggedUserType'] = $this->loggedUserType;
        $data['user_info']      = $this->tutor_model->userInfo($user_id);

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header']     = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $user_id                    = $this->session->userdata('user_id');
        $data['user_info']          = $this->tutor_model->userInfo($user_id);
        $data['all_module']         = $this->ModuleModel->allModule();
        $data['all_grade']          = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_module_type']    = $this->tutor_model->getAllInfo('tbl_moduletype');
        $data['all_course']         = $this->tutor_model->getAllInfo('tbl_course');
        $data['allRenderedModType'] = $this->renderAllModuleType();
        $data['all_country']        = $this->renderAllCountry();
        $data['row']                = $this->renderReorderPageModule($data['all_module']);
        $studentIds                 = $this->tutor_model->allStudents(['sct_id' => $user_id]);
        $data['allStudents']        = $this->renderStudentIds($studentIds);
        $data['all_subject']        = $this->tutor_model->getInfo('tbl_subject', 'created_by', $user_id);

        $data['maincontent'] = $this->load->view('module/reorder_module', $data, true);
        $this->load->view('master_dashboard', $data);
    }//end reorderModule()


public function save_module_order()
    {
        $post = $this->input->post();
        $post = array_filter($post);
        $success['success'] = 0;
        $success['msg']     = 'Order Update Failed!';  
        if(isset($post['modId']) && $post['modId'] != '')
        {
            $order = 1;
            foreach ($post['modId'] as $module_id) {
                $data = array(
                    'ordering' => $order
                );
                $this->tutor_model->updateInfo('tbl_module', 'id',$module_id,$data);
                $order++;
            }

         $success['success'] = 1; 
         $success['msg']     = 'Successfully Order Updated.'; 
         
        }

        if(isset($post['subjectId']) && $post['subjectId'] != '')
        {
            $order = 1;
            foreach ($post['subjectId'] as $module_id) {
                $data = array(
                    'order' => $order
                );
                $this->tutor_model->updateInfo('tbl_subject', 'subject_id',$module_id,$data);
                $order++;
            }

         $success['success'] = 1; 
         $success['msg']     = 'Successfully Order Updated.'; 
       
        }


        echo json_encode($success);
       die; 
    }

public function moduleSearchFromReorder()
    {
        $post = $this->input->post();
        $post = array_filter($post);
        $post[' user_id'] = $this->loggedUserId;
        $modules = $this->ModuleModel->allModule($post);
        $html = $this->renderReorderModule($modules);
        echo count($modules)?$html:'No module found';
    }

public function renderReorderModule($modules = [])
    {
        $row = '';
        foreach ($modules as $key=> $module) {
            $row .= '<tr id="'.$module['id'].'">';
            $row .= '<td>'.date('d-M-Y', $module['exam_date']).'</td>';
            $row .= '<td id="modName">'.$module['moduleName'].'</td>';
            $row .= '<td>'.$module['moduleType'].'</td>';
            $row .= '<td>'.$module['subject_name'].'</td>';
            $row .= '<td>'.$module['chapterName'].'</td>';
            $row .= '<td>'.$module['ordering'];
            $row .= '<input type="hidden" id="modId" name="modId[]"  value="'.$module['id'].'">';
            $row .= '</td>';
            $row .= '<tr>';
        }
        return $row;
    }//end renderReorderPageModule()


    /**
     * Module order save(save on ajax call)
     *
     * @return string
     */
    public function saveModuleOrdering()
    {
        $uType = $this->loggedUserType;
        if ($uType==1 || $uType==2 || $uType==6) {
            //user type parent, upper student,student shouldn't add module
            $this->session->set_flashdata('error_msg', "You've no access to view this page");
            redirect('/');
        }
        
        $post  = $this->input->post();
        $clean = $this->security->xss_clean($post);

        $arr   = [];
        $items = isset($clean['modId_ordr']) ? array_filter($clean['modId_ordr']) : [];

        if (count($items)) {
            foreach ($items as $modId_ordr) {
                $temp  = explode('_', $modId_ordr);

                if ($temp[1]) {
                    $arr[] = [
                        'id'         => $temp[0],
                        'ordering'   => $temp[1],
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];

                    $this->ModuleModel->update('tbl_module', $arr, 'id');
                }else{
                    $flag = 1;
                    echo "empty";
                }
            }

            if (!isset($flag)) {
                echo "true";
            }
        }
    }//end saveModuleOrdering()


    /**
     * Wrap all students name with option tag.
     *
     * @return string Students.
     */
    public function renderStudentIds($studentIds, $selectedIds = '')
    {
        $sel    = [];
        $stdIds = [];
        if (strlen($selectedIds) > 1) {
            $stdIds = json_decode($selectedIds);
        }

        $option  = '';
        $option .= '<option value="">--Student--</option>';
        if ($studentIds) {
            foreach ($studentIds as $studentId) {
                $stInfo  = $this->Student_model->getInfo('tbl_useraccount', 'id', $studentId);
                $sel     = in_array($studentId, $stdIds) ? "selected" : "";
                $option .= '<option value="'.$studentId.'" '.$sel.'>'.$stInfo[0]['name'].'</option>';
            }
        }
       /* print_r($studentIds);
        echo '<br>';
        print_r($selectedIds);
        die;*/
        return $option;
    }//end renderStudentIds()


    /**
     * Wrap all Countries recorded in DB with option tag.
     *
     * @return string Countries.
     */
    public function renderAllCountry($selectedId = -1)
    {
        $option    = '';
        $option   .= '<option value="">--Country--</option>';
        
        $countries = $this->tutor_model->getAllInfo('tbl_country');
        if ($this->loggedUserType != 7) {
            $countries = $this->tutor_model->getInfo('tbl_country', 'id', $this->site_user_data['country_id']);
        }
        
        foreach ($countries as $country) {
            $sel     = ($country['id'] == $selectedId) ? 'selected' : '';
            $option .= '<option value="'.$country['id'].'" '.$sel.'>'.$country['countryName'].'</option>';
        }

        return $option;
    }//end renderAllCountry()


    /**
     * Wrap all Subjects with option tag.
     *
     * @return string Users created subjects.
     */
    public function renderAllSubject($selectedId = -1)
    {
        $option   = '';
        $option  .= '<option value="">--Subject--</option>';
        $subjects = $this->tutor_model->getInfo('tbl_subject', 'created_by', $this->loggedUserId);
        foreach ($subjects as $subject) {
            $sel     = ($subject['subject_id'] == $selectedId) ? 'selected' : '';
            $option .= '<option value="'.$subject['subject_id'].'" '.$sel.'>'.$subject['subject_name'].'</option>';
        }

        return $option;
    }//end renderAllSubject()


    /**
     * Wrap all chapters with option tag.
     *
     * @return string Users created chapters.
     */
    public function renderAllChapter($selectedId = -1)
    {
        $option   = '';
        $option  .= '<option value="">--Chapter--</option>';
        $chapters = $this->tutor_model->getInfo('tbl_chapter', 'created_by', $this->loggedUserId);

        foreach ($chapters as $chapter) {
            $sel     = ($chapter['id'] == $selectedId) ? 'selected' : '';
            $option .= '<option value="'.$chapter['id'].'" '.$sel.'>'.$chapter['chapterName'].'</option>';
        }

        return $option;
    }//end renderAllChapter()


    /**
     * Wrap all Module types with option tag.
     *
     * @return string All module types recorded in database.
     */
    public function renderAllModuleType($selectedId = -1)
    {
        $option      = '';
        $option     .= '<option value="">--Moduletype--</option>';
        $moduleTypes = $this->ModuleModel->allModuleType();

        foreach ($moduleTypes as $moduleType) {
            $sel     = ($moduleType['id'] == $selectedId) ? 'selected' : '';
            $option .= '<option value="'.$moduleType['id'].'" '.$sel.'>'.$moduleType['module_type'].'</option>';
        }

        return $option;
    }//end renderAllModuleType()


    /**
     * Render all module for reorder page
     *
     * @param  array $modules all modules to reorder default empty array
     * @return string          processed table items
     */
    public function renderReorderPageModule($modules = [])
    {
        $row = '';
        $maxOrder = 0;
        foreach ($modules as $key=> $module) {
            $moduleOrder = ($module['ordering'])?$module['ordering']:"";
            $maxOrder = max($maxOrder, $moduleOrder);

            $checked = ($module['ordering'])?"checked":"";
            
            $row .= '<tr id="'.$module['id'].'">';
            $row .= '<td>'.date('d-M-Y', $module['exam_date']).'</td>';
            $row .= '<td id="modName">'.$module['moduleName'].'</td>';
            $row .= '<td>'.$module['moduleType'].'</td>';
            $row .= '<td>'.$module['subject_name'].'</td>';
            $row .= '<td><input type="checkbox" id="moduleChecked" '.$checked.'><input type="number" min="1" style="max-width: 54px;margin-left: 55px; border: 1px solid #4995b5;" autocomplete="off" class="moduleOrder" disabled="" value="'.$module['ordering'].'" id="modOrdr">';
            $row .= '<input type="hidden" id="modId_ordr" name="modId_ordr[]" value="">';
            $row .= '<input type="hidden" id="modId"  value="'.$module['id'].'">';
            $row .= '<input type="hidden" id="moduleNames_'.$moduleOrder.'" value="'.$module['moduleName'].'">';
            $row .= '<input type="hidden" id="subject_name_'.$moduleOrder.'" value="'.$module['subject_name'].'">';
            $row .= '</td>';
            $row .= '<tr>';
        }

        $row .= '<input type="hidden" id="maxOrder" value="'.$maxOrder.'">';
        return $row;
    }//end renderReorderPageModule()

    public function moduleSearchFromReorderPage()
    {
        $post = $this->input->post();
        $post = array_filter($post);
        $post[' user_id'] = $this->loggedUserId;
        $modules = $this->ModuleModel->allModule($post);
        $html = $this->renderReorderPageModule($modules);
        echo count($modules)?$html:'No module found';
    }


    public function module_preview($modle_id, $question_order_id)
    {

        $data['order'] = $this->uri->segment('3'); 
        $_SESSION['q_order'] = $this->uri->segment('3'); 
        $_SESSION['q_order_module'] = $this->uri->segment('2'); 

        $data['user_info']  = $this->tutor_model->userInfo($this->session->userdata('user_id'));
        $data['userType'] = $data['user_info'][0]['user_type'];
        date_default_timezone_set($this->site_user_data['zone_name']);
        $exact_time = time();
        $this->session->set_userdata('exact_time', $exact_time);
        
        $data['question_info_s'] = $this->tutor_model->getModuleQuestion($modle_id, $question_order_id, null);
        $data['main_module'] = $this->tutor_model->getInfo('tbl_module', 'id', $modle_id);
        // print_r($data['question_info_s']); 
        
        $data['total_question'] = $this->tutor_model->getModuleQuestion($modle_id, null, 1);
        
        $data['page_title']     = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink']     = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header']         = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink']     = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['quesOrder'] = $question_order_id;
        // print_r($data['total_question']);die();
        //if question not found
        if (!$data['question_info_s'][0]['id']) {
            $question_order_id = $question_order_id + 1;
            redirect('get_tutor_tutorial_module/'.$modle_id.'/'.$question_order_id);
        }

        if (isset($data['question_info_s'][0])) {
            $quesInfo = json_decode($data['question_info_s'][0]['questionName']);
            
            if ($data['question_info_s'][0]['questionType'] == 1) {
                $_SESSION['q_order_2'] = $this->uri->segment('3'); 
                $data['maincontent'] = $this->load->view('module/preview/preview_general', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 2) {
                $_SESSION['q_order_2'] = $this->uri->segment('3'); 
                $data['maincontent'] = $this->load->view('module/preview/preview_true_false', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 3) {
                $_SESSION['q_order_2'] = $this->uri->segment('3'); 
                $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
                $data['maincontent']             = $this->load->view('module/preview/preview_vocabulary', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 4) {
                $_SESSION['q_order_2'] = $this->uri->segment('3'); 
                $data['question_info_vcabulary'] = $quesInfo;
                $data['maincontent']             = $this->load->view('module/preview/preview_multiple_choice', $data, true);
            } elseif ($data['question_info_s'][0]['question_type'] == 5) {
                $_SESSION['q_order_2'] = $this->uri->segment('3'); 
                $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
                $data['maincontent'] = $this->load->view('module/preview/preview_multiple_response', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 6) {
                $_SESSION['q_order_2'] = $this->uri->segment('3'); 
                // skip quiz
                $data['numOfRows']    = isset($quesInfo->numOfRows) ? $quesInfo->numOfRows : 0;
                $data['numOfCols']    = isset($quesInfo->numOfCols) ? $quesInfo->numOfCols : 0;
                $data['questionBody'] = isset($quesInfo->question_body) ? $quesInfo->question_body : '';
                $data['questionId']   = $data['question_info_s'][0]['question_id'];
                $quesAnsItem          = $quesInfo->skp_quiz_box;
                $items                = indexQuesAns($quesAnsItem);

                $data['skp_box']     = renderSkpQuizPrevTable($items, $data['numOfRows'], $data['numOfCols']);
                $data['maincontent'] = $this->load->view('module/preview/skip_quiz', $data, true);
            } elseif ($data['question_info_s'][0]['question_type'] == 7) {
                $_SESSION['q_order_2'] = $this->uri->segment('3'); 
                //
                $data['question_info_left_right'] = json_decode($data['question_info_s'][0]['questionName']);
                $data['maincontent'] = $this->load->view('module/preview/preview_matching', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 8) {
                $_SESSION['q_order_2'] = $this->uri->segment('3'); 
                // assignment
                $data['questionBody']    = isset($quesInfo->question_body) ? $quesInfo->question_body : '';
                $items                   = $quesInfo->assignment_tasks;
                $data['totalItems']      = count($items);
                $data['assignment_list'] = renderAssignmentTasks($items);
                $data['maincontent']     = $this->load->view('module/preview/assignment', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 9) {
                 $_SESSION['q_order_2'] = $this->uri->segment('3'); 

                $info = array();
                $titles = array();
                $title = array();
                $questionList = json_decode($data['question_info_s'][0]['questionName'] , true);
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

                $paragraph = json_decode($data['question_info_s'][0]['questionName'] , true);
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

                $data['maincontent'] = $this->load->view('module/preview/module_preview_storyWrite', $data, true);  

            } elseif ($data['question_info_s'][0]['questionType'] == 10) {
                $_SESSION['q_order_2'] = $this->uri->segment('3'); 
                $data['question_info']   = json_decode($data['question_info_s'][0]['questionName'], true);
                $data['maincontent']     = $this->load->view('module/preview/preview_times_table', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 11) {
                $_SESSION['q_order_2'] = $this->uri->segment('3'); 
                $data['question_info']   = json_decode($data['question_info_s'][0]['questionName'], true);
                $data['maincontent']     = $this->load->view('module/preview/preview_algorithm', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 12) {
                $_SESSION['q_order_2'] = $this->uri->segment('3'); 
                $data['question_info']   = json_decode($data['question_info_s'][0]['questionName'], true);
                $data['maincontent']     = $this->load->view('module/preview/workout_quiz', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 13) {
                $_SESSION['q_order_2'] = $this->uri->segment('3'); 
                $data['question_info_vcabulary'] = $quesInfo;
                $data['maincontent']             = $this->load->view('module/preview/preview_matching_workout', $data, true);
            }elseif ($data['question_info_s'][0]['questionType'] == 14) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                if (!empty($_SERVER['HTTP_REFERER'])) {
                $_SESSION["previous_page"] = $_SERVER['HTTP_REFERER'];

                $data["last_question_order"] = $_SESSION['q_order_2'];
                // print_r($_SESSION["previous_page"]); die();
                $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
                // print_r(['question_info_vcabulary']); die();
                $tutorialId = $data['question_info_s'][0]['question_id'];
                $data['tutorialInfo'] = $this->tutor_model->getInfo('for_tutorial_tbl_question', 'tbl_ques_id', $tutorialId);
                $data['maincontent'] = $this->load->view('module/preview/preview_tutorial', $data, true);
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
                $data['maincontent'] = $this->load->view('module/preview/preview_workout_quiz_two', $data, true);

            }elseif ($data['question_info_s'][0]['questionType'] == 16)
            {
                $data['question_item']=$data['question_info_s'][0]['questionType'];
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
                    $inv=0;
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

                //                echo '<pre>';
                //                print_r($data['question_info_ind']);
                //                die();
                $data['maincontent'] = $this->load->view('module/preview/preview_memorization_quiz', $data, true);

            }elseif ($data['question_info_s'][0]['questionType'] == 17) {
                $data['question_item'] = $data['question_info_s'][0]['questionType'];
                $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
                $data['question_info_ind'] = $data['question_info'];
                if (isset($data['question_info_ind']->percentage_array)) {
                    $data['ans_count'] = count((array)$data['question_info_ind']->percentage_array);
                } else {
                    $data['ans_count'] = 0;
                }
                $data['maincontent'] = $this->load->view('module/preview/preview_creative_quiz', $data, true);
            }elseif ($data['question_info_s'][0]['questionType'] == 18) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['sentence_matching'] = $quesInfo;
                //echo "<pre>";print_r($data['question_info_s'][0]['question_id']);die();
                $data['sentence_questions'] = json_decode($data['question_info_s'][0]['questionName']);
                $data['sentence_answers'] = json_decode($data['question_info_s'][0]['answer']);
                $data['maincontent'] = $this->load->view('module/preview/preview_sentence_matching', $data, true);
            }elseif ($data['question_info_s'][0]['questionType'] == 19) {
                //print_r($data['question_info_s'][0]);die();
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['word_memorization'] = $quesInfo;
                $data['word_questions'] = json_decode($data['question_info_s'][0]['questionName'], true);
                $data['word_answers'] = json_decode($data['question_info_s'][0]['answer'], true);
                
                $data['maincontent'] = $this->load->view('module/preview/preview_word_memorization', $data, true);
            }elseif ($data['question_info_s'][0]['questionType'] == 20) {
                //print_r($data['question_info_s'][0]);die();
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['comprehension_info'] = $quesInfo;
                $data['com_questions'] = json_decode($data['question_info_s'][0]['questionName'], true);
                $data['com_answers'] = json_decode($data['question_info_s'][0]['answer'], true);
                
                $data['maincontent'] = $this->load->view('module/preview/preview_comprehension', $data, true);
            }elseif ($data['question_info_s'][0]['questionType'] == 21) {
                //print_r($data['question_info_s'][0]);die();
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['grammer_info'] = $quesInfo;
                $data['grammer_questions'] = json_decode($data['question_info_s'][0]['questionName'], true);
                $data['grammer_answers'] = json_decode($data['question_info_s'][0]['answer'], true);
                
                $data['maincontent'] = $this->load->view('module/preview/preview_grammer', $data, true);
            }elseif ($data['question_info_s'][0]['questionType'] == 22) {
                //print_r($data['question_info_s'][0]);die();
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['glossary_info'] = $quesInfo;
                $data['glossary_questions'] = json_decode($data['question_info_s'][0]['questionName'], true);
                $data['glossary_answers'] = json_decode($data['question_info_s'][0]['answer'], true);
                
                $data['maincontent'] = $this->load->view('module/preview/preview_glossary', $data, true);
            }
        } else {
            $data['maincontent']     = $this->load->view('module/preview/moduleWithoutQues', $data, true);
        } // no question to preview
        

        $this->load->view('master_dashboard', $data);
    }//end module_preview()


    public function deleteModule()
    {
        $post  = $this->input->post();
        $clean = $this->security->xss_clean($post);

        $moduleId = $clean['moduleId'];
        $this->ModuleModel->delete($moduleId);

        echo 'true';
    }//end deleteModule()


    /**
     * Render all searched question(check box checked result)
     * This function could be optimized more
     *
     * @param array $quesList all question by search params
     *
     * @return string           rendered string
     */
    public function quesSearch()
    {
        $post = array_filter($this->input->post());
        $post['user_id'] = $this->loggedUserId;
        $type = 'add';
        if (isset($post['reqType']) && $post['reqType']=='edit') {
            $moduleId      = $post['moduleId'] ?$post['moduleId'] : 0;
            $moduleQues = $this->ModuleModel->moduleQuestion($moduleId);
            $qOrdr = [];
            foreach ($moduleQues as $ques) {
                $qOrdr[$ques['question_id']] = $ques['question_order'];
            }
            $moduleQuesIds = array_keys($qOrdr);
            //as post used as search params
            unset($post['reqType'], $post['moduleId']);
            $type='edit';
        }
        $quesList = $this->QuestionModel->search('tbl_question', $post);

        //echo $this->renderSearchedQuestion($quesList);

        $serachedQuesIds = array_column($quesList, 'id');
        
        $allQuestionType = $this->tutor_model->getAllInfo('tbl_questiontype');
        $questionGroup = [];
        $maxOrder = 0;
        $indexId = 0; 
        foreach ($allQuestionType as $questionType) {
            $ques_condition['questionType'] = $questionType['id'];
            $ques_condition['user_id'] = $this->loggedUserId;
            $questionGroup[$questionType['id']] = $this->tutor_model->getUserQuestion('tbl_question', $ques_condition);
        }
        //echo '<pre>';print_r($serachedQuesIds);die;
        $row = '';
        foreach ($allQuestionType as $key) {
           
            $row .= '<div class="col-md-3"><table class="table table-bordered tbl_ques" id="module_setting2"><thead><tr>';
            $row .='<th style="">'.$key['questionType'].'<p style="float:right;">Re-Order</p></th></tr></thead><tbody>';
            $i=1;
            foreach ($questionGroup[$key['id']] as $question) {
                if (!in_array($question['id'], $serachedQuesIds)) {
                    continue;
                }
                
                $checked = '';
                $quesOrder='';
                $qId_ordr = '';
                if ($type=='edit' && in_array($question['id'], $moduleQuesIds)) {
                    $checked = 'checked';
                    $quesOrder = $qOrdr[$question['id']];
                    $qId_ordr = $question['id'].'_'.$quesOrder;
                    $maxOrder = max($maxOrder, $quesOrder);
                }

                //chu**bu** change
                // if ($type == 'edit' && $checked != 'checked') {
                    // continue;
                // }

                $row .= '<tr><td><div class="form-check"><label class="form-check-label first_level" style=""><label class="form-check-label second_level" for="defaultCheck21" style="">';

                /*$row .= '<input class="form-check-input1" type="checkbox" value="'.$question['id'].'"  name="moduleQuestion[]" id="quesChecked" '.$checked.'> Q'.$i.'<i class="fa fa-info-circle" style="color:orange;"></i> <i class="fa fa-pencil"></i>';*/

                $row .= '<input class="form-check-input1" type="checkbox" value="'.$question['id'].'"  name="moduleQuestion[]" id="quesChecked" '.$checked.'>';
                $row .='<span>'.' Q'.$i.' </span>';

                $row .= '<input type="hidden" class="questionId" value="'.$question['id'].'">';
                $row .= '<input type="hidden" class="questionType" value="'.$key['questionType'].'">';
                $row .= '<i class="fa fa-info-circle quesInfoIcon" data-toggle="modal" data-target=".question-preview-modal" class="fa fa-info-circle" style="color:orange;"></i>';

                $row .= '<a style="display:inline !important" href="question_edit/'.$key['id'].'/'.$question['id'].'"><i class="fa fa-pencil"></i></a>';
                if ($this->loggedUserType == 7) {
                    $row .= '<a class="delete-question" style="display:inline !important;color:red;margin-left: 3px;cursor:pointer" data-id="'.$question['id'].'"   quesOrder="'.$quesOrder.'" id="qOrdr" module-id="'.$moduleId.'"><i class="fa fa-trash"></i></a>';
                    $row .= '<a class="duplicate-question" style="display:inline !important;color:red;margin-left: 3px;cursor:pointer" data-id="'.$question['id'].'" user-id="'.$this->loggedUserId.'"><i class="fa fa-copy"></i></a>';
                }
                $row .= '<input type="number" min="1" style="" indexId'.''.$indexId.'="'.$indexId.'" autocomplete="off" class="questionOrder" '. (!empty($quesOrder) ? '' : 'disabled="disabled"') . ' value="'.$quesOrder.'" id="qOrdr"><input type="hidden" class="qId_order" id="qId_ordr" name="qId_ordr[]" value="'.$qId_ordr.'">';
                $row .= '<input type="hidden" id="qId" class="qId" value="'.$question['id'].'">';

                $row .= '</label></div></td></tr>';
                $i++;
            }
            $row .='</tbody></table></div>';
        }
        $data['row'] = $row;
        $data['maxOrder'] = $maxOrder;
        echo json_encode($data);
        //echo  $row;
    }

    public function question_delete($questionId = 0,$moduleId = 0)
    {
        $this->db->where('question_id',$questionId)->where('module_id',$moduleId)->delete('tbl_modulequestion');
        $moduleQues = $this->ModuleModel->moduleQuestionOrder($moduleId);
        $this->ModuleModel->deleteModuleQuestion($moduleId);
        foreach ($moduleQues as $key => $qId_ordr) {
            $temp  = $key + 1;
            $question_info = $this->ModuleModel->getInfo('tbl_question', 'id', $qId_ordr['question_id']);
            $arr[] = [
                'question_id'    => $qId_ordr['question_id'],
                'question_type'  => $question_info[0]['questionType'],
                'module_id'      => $moduleId,
                'question_order' => $temp,
                'created'        => time(),
            ];
        }
        // echo "<pre>";print_r($arr);die();

        $this->ModuleModel->insert('tbl_modulequestion', $arr);
        /*delete question info from tbl_question
        delete all question module relationship*/
        $delItems = $this->QuestionModel->delete('tbl_question', 'id', $questionId);
        $this->QuestionModel->delete('tbl_modulequestion', 'question_id', $questionId);
        if ($delItems) {
            echo 'true';
        } else {
            echo 'false';
        }
    }


    /**
     * Get all student of a course(ajax hit)
     *
     * Match course with subject picked,
     * get all student of that course,
     * render students,
     * return
     *
     * @return [type] [description]
     */
    public function getStudentByCourse()
    {
        $post = $this->input->post();

        $subjectId = $post['subjectId'];
        $subject = $this->ModuleModel->search('tbl_subject', ['subject_id'=>$subjectId]);
        if (count($subject)) {
            $course = $this->ModuleModel->search('tbl_course', ['courseName'=>$subject[0]['subject_name']]);
            $courseId = $course[0]['id'];
            $temp = $this->ModuleModel->search('tbl_registered_course', ['course_id'=>$courseId]);
            $studentIds = array_unique(array_column($temp, 'user_id'));
            $students = $this->renderStudentIds($studentIds);
        } else {
            $students = '';
        }

        echo $students;
    }

    
    /**
     * From module(add/edit) section we can view the question info.
     * Clicking the info icon a modal will open up with question info.
     *
     * @return void
     */ 
    public function quesInfoForModal()
    { 
        $post = $this->input->post();
        $questionId = $post['questionId'];
        $data['quesInfo'] = $this->QuestionModel->info($questionId);
        $data['additionalInfo'] = json_decode($data['quesInfo']['questionName'],true);
        $quesType = $data['quesInfo']['questionType'];
        $previewBody = '';

        
        
        if ($quesType==1) {
            $previewBody=$this->load->view('module/modal_preview/general', $data, true);
        } elseif ($quesType==2) {
            $previewBody=$this->load->view('module/modal_preview/true_false', $data, true);
        } elseif ($quesType==3) {
            $previewBody=$this->load->view('module/modal_preview/vocabulary', $data, true);
        } elseif ($quesType==4) {
           
            $previewBody=$this->load->view('module/modal_preview/multiple_choice', $data, true);
            print_r($previewBody);die();
        } elseif ($quesType==5) {
            $previewBody=$this->load->view('module/modal_preview/multiple_response', $data, true);
        } elseif ($quesType==6) {
            $data['numOfRows']    = isset($data['additionalInfo']->numOfRows) ? $data['additionalInfo']->numOfRows : 0;
            $data['numOfCols']    = isset($data['additionalInfo']->numOfCols) ? $data['additionalInfo']->numOfCols : 0;
            $quesAnsItem         = $data['additionalInfo']['skp_quiz_box'];
            $items = $this->indexQuesAns($quesAnsItem);

            $data['skipQuizBox'] = $this->renderSkpQuizPrevTable($items, $data['numOfRows'], $data['numOfCols'], 1);
            $previewBody=$this->load->view('module/modal_preview/skip_quiz', $data, true);
        } elseif ($quesType==7) {
            $data['left_side'] = $data['additionalInfo']['left_side'];
            $data['right_side'] = $data['additionalInfo']['right_side'];
            $data['siz']=count($data['additionalInfo']['left_side']); //all side should've same num of elements.
            $data['answer'] = json_decode($data['quesInfo']['answer']);
            $data['colorA'] = [];
            $data['colorB'] = [];
            for ($i=0; $i <$data['siz']; $i++) {
                $randColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                $data['colorA'][$i] =$randColor;
                $data['colorB'][(int)$data['answer'][$i]-1] = $randColor;
            }
            $previewBody=$this->load->view('module/modal_preview/matching', $data, true);
        }elseif ($quesType==9)
        {
            $data['question_info'] = (array)($data['additionalInfo']);
            $previewBody=$this->load->view('module/modal_preview/creative_quiz', $data, true);
        }elseif ($quesType==10) {//algorithm
            $data['question_info'] = (array)($data['additionalInfo']);
            $previewBody=$this->load->view('module/modal_preview/times_table', $data, true);
        } elseif ($quesType==11) {//algorithm
            $data['additionalInfo'] = (array)($data['additionalInfo']);
            $previewBody=$this->load->view('module/modal_preview/algorithm', $data, true);
        } elseif ($quesType==12) {//workout quiz
            $previewBody=$this->load->view('module/modal_preview/workout_quiz', $data, true);
        }elseif ($quesType==13) {// matching workout quiz
            $data['additionalInfo'] = (array)($data['additionalInfo']);

            $previewBody=$this->load->view('module/modal_preview/matching_workout', $data, true);
        }elseif ($quesType==8) {// assignment
            $data['additionalInfo'] = (array)($data['additionalInfo']);
            $previewBody=$this->load->view('module/modal_preview/assignment', $data, true);
        }elseif ($quesType==14) {// tutorial
            $data['additionalInfo'] = (array)($data['additionalInfo']);
            $speech_to_text = array();
            $image = array();
            $audio = array();
            foreach($data['additionalInfo'] as $value)
            {
                if (isset($value['speech_to_text']))
                {
                    $speech_to_text[] = $value['speech_to_text'];
                }elseif (isset($value['image']))
                {
                    $image[] = $value['image'];
                }elseif (isset($value['audio']))
                {
                    $audio[] = $value['audio'];
                }
            }
            $data['speech_to_text']=$speech_to_text;
            $data['image']=$image;
            $data['audio']=$audio;
            $previewBody=$this->load->view('module/modal_preview/tutorial', $data, true);
        }elseif ($quesType==15){

            $data['answer'] = $data['quesInfo']['answer'];
            $data['question'] =json_decode($data['quesInfo']['questionName']);

            $previewBody=$this->load->view('module/modal_preview/workout_quiz_two', $data, true);

        }elseif ($quesType==16)
        {
            $data['question'] =json_decode($data['quesInfo']['questionName']);
            $previewBody=$this->load->view('module/modal_preview/memorization', $data, true);
        }
        
        echo $previewBody;
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

        $row = '';
        for ($i=1; $i<=$rows; $i++) {
            $row .='<tr>';
            for ($j=1; $j<=$cols; $j++) {
                if ($items[$i][$j]['type']=='q') {
                    $row .= '<td><input type="button" data_q_type="0" data_num_colofrow="" value="'.$items[$i][$j]['val'].'" name="skip_counting[]" class="form-control input-box  rsskpinpt'.$i.'_'.$j.'" readonly style="min-width:50px; max-width:50px; background-color: rgb(255, 183, 197);"></td>';
                } else {
                    $ansObj = array(
                        'cr'=>$i.'_'.$j,
                        'val'=> $items[$i][$j]['val'],
                        'type'=> 'a',
                    );
                    $ansObj = json_encode($ansObj);
                    $val = ($showAns==1)?' value="'.$items[$i][$j]['val'].'"' : '';
                    
                    $row .= '<td><input autocomplete="off" type="text" '.$val.' data_q_type="0" data_num_colofrow="'.$i.'_'.$j.'" value="" name="skip_counting[]" class="form-control input-box ans_input  rsskpinpt'.$i.'_'.$j.'" readonly style="min-width:50px; max-width:50px;background-color: rgb(186, 255, 186); ">';
                    $row .= '<input type="hidden" value="" name="given_ans[]" id="given_ans">';
                    $row .='</td>';
                }
            }
            $row .= '</tr>';
        }
        
        return $row;
    }
    
    public function get_draw_image()
    {
        $this->load->library('image_lib');
        $img = $_POST['imageData'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $path = 'assets/uploads/preview_draw_images/';
        $draw_file_name = 'draw'.uniqid();
        $file = $path . $draw_file_name . '.png';
        file_put_contents($file, $data);

        $imginfo = getimagesize( $file);
        $imgwidth = $imginfo[0];
        $imgheight = $imginfo[1];
        
        $config['image_library'] = 'gd2';
        $config['source_image'] = $file;
        $config['maintain_ratio'] = true;
        // $config['width'] = 400;
        // $config['height'] = 250;

        $config['width'] =  $imgwidth;
        $config['height'] = $imgheight;

        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        
        echo base_url().$file;
    }

    /**
     * Save tutors scrutinisation report
     * save drawboard image.record additional info to database
     *
     * @return string saved file path
     */
    public function saveScrutiniseReport()
    {
        $this->load->library('image_lib');
        $img = $_POST['imageData'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $path = 'assets/uploads/preview_draw_images/';
        $draw_file_name = 'draw'.uniqid();
        $file = $path . $draw_file_name . '.png';
        file_put_contents($file, $data);
        
        $config['image_library'] = 'gd2';
        $config['source_image'] = $file;
        $config['maintain_ratio'] = true;
        $config['width'] = 400;
        $config['height'] = 250;

        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        
        $upImage = base_url().$file;

        $dataToInsert[] = [
            'data' => json_encode(['scrutinize_image'=>$upImage]),
            'ans_id' => $_POST['answerId'],
            'question_id' => $_POST['questionId'],
            'examiner' =>$this->loggedUserId,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ];

        $scrutinizeReportId = $this->ModuleModel->insert('scrutinize_report', $dataToInsert);
        if ($scrutinizeReportId) {
            echo $upImage;
        } else {
            echo 'something is wrong';
        }
    }

    /**
     * Get students by grade(ajax call)
     * Get students while module duplicate
     *
     * @return string resndered students
     */
    public function getStudentByGrade()
    {

        $post = $this->input->post();
        $grade = isset($post['grade']) ? $post['grade'] : 0;
        
        //all student by sct id
        $allEnrolledStudent = $this->tutor_model->allStudents(['sct_id'=>$this->loggedUserId]);
        
        //all student by grade
        $allStudentByGrade = $this->QuestionModel->search('tbl_useraccount', ['student_grade'=>$grade]);
        $allStudentByGrade = array_column($allStudentByGrade, 'id');

        $commonIds = array_intersect($allEnrolledStudent, $allStudentByGrade);
        $renderedItem = $this->renderStudentIds($commonIds);
        echo $renderedItem;
    }

    /**
     * Module search from all module page(ajax call).
     *
     * @return string rendered table
     */
    public function searchModule()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        $conditions = array_filter($clean);
        $conditions['user_id'] = $this->loggedUserId;
        $country_id = $this->session->userdata('selCountry');
        if(!empty($post['country'])){
            $conditions['country'] = $post['country'];
        }else{
            $conditions['country'] = $country_id;
        }
        

        //$modules = $this->QuestionModel->search('tbl_module', $conditions);
        $modules = $this->Admin_model->getModule('tbl_module', $conditions);
        $modTypes = ['', 'Tutorial', 'Everyday Study', 'Special Exam', 'Assignment'];
        $rows = '';
        
        foreach ($modules as $module) {
            $rows .= '<tr id="'.$module['id'].'">';
            $rows .= '<td>'.date('d-M-Y', $module['exam_date']).'</td>';
            $rows .= '<td id="modName"><a href="edit-module/'.$module['id'].'">'.$module['moduleName'].'</a></td>';
            $rows .=   '<td>'.$module['countryName']. '</td>';
            $rows .=   '<td>'.$module['studentGrade']. '</td>';
            $rows .=   '<td>'. $modTypes[$module['moduleType']]. '</td>';
            $rows .=   '<td>'.$module['subject_name']. '</td>';
            $rows .=   '<td>'.$module['chapterName']. '</td>';
            if($this->session->userdata('selCountry')!=1){
            // $rows .=   '<td>'.$module['courseName']. '</td>';
            }
            $rows .= '<td><i class="fa fa-clipboard" id="modDuplicateIcon" data-toggle="modal" data-target="#moduleDuplicateModal" style="color:#4c8e0c;"></i></td>';

            $rows .= '<td><a href="edit-module/'.$module['id'].'"><i class="fa fa-pencil" style="color:#4c8e0c;"></i></a></td>';

            $rows.='<td><i data-toggle="modal" data-target="#moduleDelModal" class="fa fa-trash" id="dltModOpnIcon" style="color:red;"></i></td>';
            $rows .= '</tr>';
        }

        echo $rows ? $rows : 'No module found';
    }

    public function renderReorderModuleSubject()
    {
        $user_id    = $this->session->userdata('user_id');
        $all_subject = $this->tutor_model->getInfo_subject('tbl_subject', 'created_by', $user_id);

        $row = '';
        foreach ($all_subject as $key=> $module) {
            $row .= '<tr id="'.$module['subject_id'].'">';

            $row .= '<td>'.$module['subject_name'].'</td>';
            $row .= '<td>'.$module['order'].'</td>';
            $row .= '<input type="hidden" id="subjectId" name="subjectId[]"  value="'.$module['subject_id'].'">';
            $row .= '</td>';
            $row .= '<tr>';
        }
        echo $row;
    }//end renderReorderPageModule()


    /**
     * Chapter name as option value
     *
     * @param integer $subject  subject
     * @param integer $selected selected chapter
     *
     * @return string            options
     */
    public function get_chapter_name($subject = 0, $selected = 0)
    {
        $subject_id = $subject ? $subject : $this->input->post('subject_id');

        $all_subject_chapter = $this->tutor_model->getInfo('tbl_chapter', 'subjectId', $subject_id);
        //echo '<pre>';print_r($all_subject_chapter);die;
        $html = '<option value="">Select Chapter</option>';
        foreach ($all_subject_chapter as $chapter) {
            $sel = $chapter['id'] == $selected ? 'selected' : '';
            $html .= '<option value="' . $chapter['id'] . '" '.$sel.'>' . $chapter['chapterName'] . '</option>';
        }
        
        if ($subject) {
            return $html; //within controller
        } else {
            echo $html; // ajax/form submit
        }
    }
    
    public function tutorial_master_view($id)
    {
        $tutorialInfos = $this->tutor_model->getInfo('for_tutorial_tbl_question', 'tbl_ques_id', $id);
        $html = '';
        $html .= '<div id="myCarousel" class="carousel" data-ride="carousel" style="border: none;">';
        $html .= '<div class="carousel-inner">';
        foreach ($tutorialInfos as $tutorialInfo) {
            $html .= '<div class="item " id="'.$tutorialInfo["speech"].'">';
            $html .= '<img width="100%" height="100%" style="max-height: 78vh;" src="assets/uploads/' . $tutorialInfo["img"] . '" alt="Chania">';

            $html .= '</div>';
        }
        $html .= '</div>';
        $html .= '<div style="text-align: center;">
                                            <!--                            <button class="sound_play" style="position: relative;bottom: -25px;left: 28%;background: transparent;border: none;color: #2198c5;"></button>-->
                                            <a class=""  style="width:90px;display:inline-block;opacity: 1;position:relative;margin: 10px auto;">
                                                <span class=" icon-change module_sound_play" style="line-height: 30px;text-shadow: none;left:-13px;color: #6e6a6a;font-size: 17px;"><img src="'.base_url("/").'assets/images/icon_sound.png"></span>
                                                <!--                            <span class="glyphicon glyphicon-chevron-left icon-change" style="line-height: 30px;text-shadow: none;left:-13px;color: #2198c5;font-size: 17px;">Prev</span>-->
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="left carousel-control prev-btn-c" href="#myCarousel" data-slide="prev" style="width:90px;border:1px solid #62b1ce;border-radius: 4px;display:inline-block;opacity: 1;position:relative;margin: 10px auto;">
                                                <span class=" icon-change" style="line-height: 30px;text-shadow: none;left:-13px;color: #6e6a6a;font-size: 17px;">Previous</span>
                                                <!--                            <span class="glyphicon glyphicon-chevron-left icon-change" style="line-height: 30px;text-shadow: none;left:-13px;color: #2198c5;font-size: 17px;">Prev</span>-->
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control next-btn-c" href="#myCarousel" data-slide="next" style="width:90px;border:1px solid #62b1ce;border-radius: 4px;display:inline-block;opacity: 1;position:relative;margin: 10px auto;margin-right: 52px;">
                                                <span class=" icon-change" style="line-height: 30px;text-shadow: none;right:-13px;color: #6e6a6a;font-size: 17px;">Next</span>
                                                <!--                            <span class="glyphicon glyphicon-chevron-right icon-change" style="line-height: 30px;text-shadow: none;right:-13px;color: #2198c5;font-size: 17px;">Next</span>-->
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>';
        $html .= '</div>';
        $html .='<script>
            $("#myCarousel").on("slide.bs.carousel", function onSlide (ev) {
                var word = ev.relatedTarget.id;
                if (word =="none")
                {
                    return true;
                }
                speak(word);
                console.log(word);
            });
</script>';
        print_r($html);
    }
    public function tutorial_check_order_module_next()
    {
        $module_id = $this->input->post('module_id');
        $question_order = $this->input->post('question_order');
        $question_id = $this->input->post('question_id');
        if ($question_order != '')
        {
            $question_order = $question_order+1;
            $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order, null);
            if (!empty($question_info_ai))
            {
                $url = base_url('/').'module_preview/'.$module_id.'/'.$question_order;
                echo json_encode($url);
            }
        }
    }
    public function tutorial_check_order_module_prev()
    {
        $module_id = $this->input->post('module_id');
        $question_order = $this->input->post('question_order');
        $question_id = $this->input->post('question_id');
        if ($question_order != '')
        {
            $question_order = $question_order-1;
            $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order, null);
            if (!empty($question_info_ai))
            {
                $url = base_url('/').'module_preview/'.$module_id.'/'.$question_order;
                echo json_encode($url);
            }
        }
    }
    public function tutorial_check_order_module_next_std()
    {
        $module_id = $this->input->post('module_id');
        $question_order = $this->input->post('question_order');
        $question_id = $this->input->post('question_id');
        if ($question_order != '')
        {
            $question_order = $question_order+1;
            $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order, null);
            if (!empty($question_info_ai))
            {
                $url = base_url('/').'get_tutor_tutorial_module/'.$module_id.'/'.$question_order;
                echo json_encode($url);
            }
        }
    }
    public function tutorial_check_order_module_prev_std()
    {
        $module_id = $this->input->post('module_id');
        $question_order = $this->input->post('question_order');
        $question_id = $this->input->post('question_id');
        if ($question_order != '')
        {
            $question_order = $question_order-1;
            $question_info_ai = $this->tutor_model->getModuleQuestion($module_id, $question_order, null);
            if (!empty($question_info_ai))
            {
                $url = base_url('/').'get_tutor_tutorial_module/'.$module_id.'/'.$question_order;
                echo json_encode($url);
            }
        }
    }
    public function tutorial_view($id)
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
        $next_page ="https://q-study.com/module_preview/".$_SESSION['q_order_module']."/".$add_order; 
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

            if ($order_current_url < $order_previsous_url) {
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
    
    
    
    
    
    public function module_creative_quiz_ans_matching()
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
        $notInParagraph= $test;
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
        $question_marks =$question_info[0]['questionMarks'];


        if (!empty($TestMsg) && !empty($test))
        {
            if (!empty($NotMatchResults))
            {
                $text = 0;
                $text_1 = 1;
                $this->take_decesion($question_marks, $questionId, $module_id, $question_order_id, $text, $text_1, array());
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

                $text = 0;
                $text_1 = 1;
                $this->take_decesion($question_marks, $questionId, $module_id, $question_order_id, $text, $text_1, array());
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

                $text = 0;
                $text_1 = 1;
                $this->take_decesion($question_marks, $questionId, $module_id, $question_order_id, $text, $text_1, array());
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
            $this->take_decesion($question_marks, $questionId, $module_id, $question_order_id, $text, $text_1, array());
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
    public function take_decesion($question_marks, $question_id, $module_id, $question_order_id, $text, $text_1, $answer_info = null)
    {

        //****** Get Temp table data for Tutorial Module Type ******
        $user_id = $this->session->userdata('user_id');
//        $tutorial_ans_info = $this->Student_model->getTutorialAnsInfo('tbl_temp_tutorial_mod_ques', $module_id, $user_id);

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

        if ($text == $text_1) {
            $ans_is_right = 'correct';
            if ($answer_info != null) {
                $student_ans = $answer_info;
//                echo $answer_info;
            } else {

//                echo 2;
            }

        } else {
            $ans_is_right = 'wrong';
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
    
    public function assign_subject()
    {
        $data = array();
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $tbl_assign_subject   = $this->tutor_model->getAllInfo('tbl_assign_subject');
        $courseInfo = array();
        $assign_course_id = array();
        if (!empty($tbl_assign_subject))
        {
            $i =0;
            foreach ($tbl_assign_subject as $tbl_assign)
            {
                $courseInfo[$i]['id']=$tbl_assign['id'];
                $course_id = $this->Student_model->getInfo('tbl_course', 'id',$tbl_assign['course_id']);
                $courseInfo[$i]['course_name'] = $course_id[0]['courseName'];
                $subjectId = json_decode($tbl_assign['subject_id']);
                $subject_name = '';
                foreach($subjectId as $value)
                {
                    $sb =  $this->Student_model->getInfo('tbl_subject', 'subject_id',$value);
                    if (!empty($sb))
                    {
                        $subject_name .= $sb[0]['subject_name'];
                        $subject_name .= '<br>';
                    }
                }
                $courseInfo[$i]['subject_name'] = $subject_name;
                $i++;

                $assign_course_id[] = $tbl_assign['course_id'];
            }
        }
        $data['courseInfo'] = $courseInfo;
        $all_courses       = $this->tutor_model->getAllInfo('tbl_course');

        $not_assign_course = array();
        $assign_course = array();
        foreach($all_courses as $all_course )
        {
            if (in_array($all_course['id'],$assign_course_id))
            {

            }else
            {

                $assign_course['id'] = $all_course['id'];
                $assign_course['courseName'] = $all_course['courseName'];
                $not_assign_course[]=$assign_course;
            }

        }
        $data['all_course'] =$not_assign_course;
        $data['all_subjects'] = $this->tutor_model->getInfo('tbl_subject', 'created_by', $this->loggedUserId);
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('module/assign-subject', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    
    public function save_assign_subject()
    {
        $data = array();
        $response =[
            'error' =>false,
            'success' =>false,
            'message' =>''
        ];
        if (isset($_POST['course']) && !empty($_POST['course']))
        {
            $data['course_id'] = $_POST['course'];

        }else
        {
            $response =[
                'error' =>true,
                'success' =>false,
                'message' =>'Select Course'
            ];
            echo json_encode($response);
            die();
        }
        if (isset($_POST['subject_id']) && !empty($_POST['subject_id']))
        {
            $data['subject_id'] = json_encode($_POST['subject_id']);

        }else
        {
            $response =[
                'error' =>true,
                'success' =>false,
                'message' =>'The subject can not be empty.You must select at least one subject for a course.'
            ];
            echo json_encode($response);
            die();
        }
        $moduleId = $this->ModuleModel->insertId('tbl_assign_subject', $data);
        $response =[
            'error' =>false,
            'success' =>true,
            'message' =>'Successfully Inserted.'
        ];
        echo json_encode($response);
    }
    public function edit_assign_subject()
    {
        $html = '';
        $id = $this->input->post('id');
        $edit_subject_data = $this->Student_model->getInfo('tbl_assign_subject', 'id',$id);
        $course_id = $edit_subject_data[0]['course_id'];
        $course = $this->Student_model->getInfo('tbl_course', 'id',$course_id);
        $courseName = $course[0]['courseName'];
        $edit_data = json_decode($edit_subject_data[0]['subject_id']);
        $all_subjects = $this->tutor_model->getInfo('tbl_subject', 'created_by', $this->loggedUserId);

                $html = '<div class="col-md-6">
                                <div class="form-group">
                                        <label for="exampleInputEmail2" style="color:#007ac9;font-weight: bold;margin: 5px 0px;">Course</label>
                                    <div>
                                        '.$courseName.'
                                        <input type="hidden" name="assign_id" value="'.$id.'">
                             </div>
                                </div>
                  </div>';

        $html .= '
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail2" style="color:#007ac9;font-weight: bold;margin: 5px 0px;">Subject</label>
                    <div class="select">';
                   foreach ($all_subjects as $all_subject) {
                       if ($all_subject['subject_name'] != '') {
                           if (in_array($all_subject['subject_id'],$edit_data)) {

                               $html .= '<p><input class="form-check-input" name="subject_id[]" type="checkbox" checked  value="' . $all_subject['subject_id'] . '">
                        <label class="form-check-label">' . $all_subject['subject_name'] . '</label></p>';
                           }else
                           {
                               $html .= '<p><input class="form-check-input" name="subject_id[]" type="checkbox" value="' . $all_subject['subject_id'] . '">
                        <label class="form-check-label">' . $all_subject['subject_name'] . '</label></p>';;
                           }
                       }
                   }

         $html .=           '</div>
                </div>
            </div>
        ';
                   echo $html;
    }

    public function update_assign_subject()
    {
        $data = array();
        $id = $this->input->post('assign_id');

        if (isset($_POST['subject_id']) && !empty($_POST['subject_id']))
        {
            $subject_id = $this->input->post('subject_id');

        }else
        {
            $response =[
                'error' =>true,
                'success' =>false,
                'message' =>'The subject can not be empty.You must select at least one subject for a course.'
            ];
            echo json_encode($response);
            die();
        }
        $data['subject_id'] = json_encode($subject_id);
        $this->ModuleModel->updateInfo('tbl_assign_subject','id',$id, $data);
        $response =[
            'error' =>true,
            'success' =>false,
            'message' =>'Updated Successfully'
        ];
        echo json_encode($response);
    }
    public function delete_assign_subject()
    {
        $id = $this->input->post('id');
        $this->ModuleModel->deleteInfo('tbl_assign_subject','id',$id);
        echo json_encode('Delete Successfully');
    }
    public function assign_subject_by_course()
    {
        $course_id = $_POST['course_id'];
        if (isset($course_id) && $course_id != '')
        {
            $assign_course = $this->Student_model->getInfo('tbl_assign_subject', 'course_id',$course_id);
            $subjectId = json_decode($assign_course[0]['subject_id']);
            $subjects = array();
            foreach($subjectId as $value)
            {
                $sb =  $this->Student_model->getInfo('tbl_subject', 'subject_id',$value);
                if (!empty($sb))
                {
                    $subjects[] = $sb;
                }
            }
            $selectedId = -1;
            $option   = '';
            $option  .= '<option value="">--Subject--</option>';
            foreach ($subjects as $subject) {
                $sel     = ($subject[0]['subject_id'] == $selectedId) ? 'selected' : '';
                $option .= '<option value="'.$subject[0]['subject_id'].'" '.$sel.'>'.$subject[0]['subject_name'].'</option>';
            }
            echo $option;
        }
    }
    public function assign_subject_by_course_student()
    {
        $course_id = $_POST['course_id'];
        $moduleType = $_POST['moduleType'];
        if (isset($course_id) && $course_id != '')
        { 
            $html = '';
            $assign_course = $this->Student_model->getInfo('tbl_assign_subject', 'course_id',$course_id);
            
            if (!empty($assign_course))
            {
                $subjectId = json_decode($assign_course[0]['subject_id']);
                $subjects = array();
               $html .= '<span class="badge badge-pill badge-primary" courseId="'.$course_id.'" id="subjectNameQ" subjectId="all" style="width: 197px;;margin:5px 5px 5px 5px; cursor: pointer;">All</span>';
               
               $subjectId = $this->Student_model->getAllSubjectByCourse($course_id,$moduleType);
               
                foreach($subjectId as $value)
                {
                    $sb =  $this->Student_model->getInfo('tbl_subject', 'subject_id',$value);
                    
                    if (!empty($sb))
                    {
                       $html .= '<span class="badge badge-pill badge-primary" courseId="'.$course_id.'" id="subjectNameQ" subjectId="'.$sb[0]['subject_id'].'" style="width:197px;margin:5px 5px 5px 5px; cursor: pointer; text-transform: capitalize;">'.$sb[0]['subject_name'].'</span>';
                    }
                }
                
                echo $html;
            }

        }
    }
    
    
    //Qstudy Module instraction  Multiple Video section
    public function module_instruction_video($id)
    {
        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['module_id'] = $id;
        $data['maincontent'] = $this->load->view('module_videos/video_upload', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function module_instruction_video_list($id)
    {
        $data['videos'] = $this->tutor_model->getInfo('module_instruction_videos_new', 'module_id',$id);
        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['module_id'] = $id;
        
        if (count($data['videos'])) {
            $info = json_decode($data['videos'][0]['files'] , true); 
            foreach ($info as $key => $value) {
                if (isset($value['title']) ) {
                    $data['title'][] = $value['title'];
                }else{
                    $data['video'][] = $value['Audio'];
                }
            }
        }

        $data['maincontent'] = $this->load->view('module_videos/video_upload_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function processVideoHelp($items)
    {
        $arr = array();
        $array_one = array();
        $arr['speech_to_text'] = $items['title'];
        foreach ($arr['speech_to_text'] as $key => $value) {
            if (!empty($value)) {
                $v = [
                    "title" =>$value
                ];


                array_push($array_one, $v);
            }
            else{
                $v = [
                    "title" =>"none"
                ];
                array_push($array_one, $v);
            }
        }
        
        $uType = $this->session->userdata('userType');
        
        $files = $_FILES;

       $this->load->library('upload');

       $config['upload_path'] = 'assets/uploads/';
       $config['allowed_types'] = 'mp4';
       $config['overwrite'] = false;



       $this->upload->initialize($config);


        foreach($_FILES['video_file']['name'] as $l => $audios){

               $config['file_name']=rand(99,9999).time().$audios;
               $this->upload->initialize($config);


               $_FILES['audio']['name']=$audios;
               $_FILES['audio']['type']=$_FILES['video_file']['type'][$l];
               $_FILES['audio']['tmp_name']=$_FILES['video_file']['tmp_name'][$l];
               $_FILES['audio']['error']=$_FILES['video_file']['error'][$l];
               $_FILES['audio']['size']=$_FILES['video_file']['size'][$l];


               if (!$this->upload->do_upload('audio')) {
                   $status = 'error';
                   $audio = $this->upload->display_errors('', '');
                   $var1 =[
                    "Audio"=>'none'
                  ];

                   array_push($array_one, $var1);
               } else {
                   $audioFiles = $this->upload->data();

                  $var2 =[
                    "Audio"=>'assets/uploads/'.$audioFiles["file_name"]
                  ];

                  array_push($array_one, $var2);
                 
               }
        }

        return json_encode($array_one);
        
    }

    public function save_module_instract_video()
    {
        $data['user_id'] = $this->session->userdata('user_id');
        $data['module_id'] = $_POST['module_id'];
        $data['files'] = $this->processVideoHelp($_POST);

        $this->form_validation->set_rules('module_id', 'Module ID', 'is_unique[module_instruction_videos_new.module_id]');

        if($this->form_validation->run())
          {
            $data['user_id'] = $this->session->userdata('user_id');
            $data['module_id'] = $_POST['module_id'];
            $data['files'] = $this->processVideoHelp($_POST);

            if ($data['files']) {
                $id = $this->ModuleModel->insertId('module_instruction_videos_new', $data );
            }

            if ($id) {
                $this->session->set_flashdata('message', 'Successfully Added');
                redirect($_SERVER['HTTP_REFERER']);
            }else{
                $this->session->set_flashdata('Failed', 'Failed to Added');
                redirect($_SERVER['HTTP_REFERER']);
            }

          }else{
                $this->session->set_flashdata('Failed', 'This module has uploaded files already');
                redirect($_SERVER['HTTP_REFERER']);
          }

    }
    
    
    public function edit_module_instruction_video($module_id,$video_id)
    {
        $conditions = array();
        $conditions['module_id'] = $module_id;
        $conditions['id']        = $video_id;
        $data['video'] = $this->ModuleModel->get_row('module_instruction_video',$conditions);
        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['module_id'] = $module_id;
        $data['maincontent'] = $this->load->view('module_videos/edit_video_upload', $data, true);
        $this->load->view('master_dashboard', $data);
        // echo '<pre>';
        // print_r($data['video']);
        // die;
    }
     public function qstudy_module_video_preview()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        $video_id = $clean['video_id'];
        $conditions = array();
        $conditions['id']        = $video_id;
        $video = $this->ModuleModel->get_row('module_instruction_video',$conditions);
        if(!empty($video))
        {
            $result['title'] = $video[0]['name'];

            $html = '';
            $html .= '<video controls muted loop style="width:100%" id="qsi_video">';
            $html .= '<source src="'.base_url('/').$video[0]['video'].'" type="video/mp4">';
            $html .= '</video>';
            $result['content'] = $html;

            echo  json_encode($result);
            die;
        }
        
    }

    public function update_instruction()
    {
        $videos = $this->tutor_model->getInfo('module_instruction_videos_new', 'module_id',$_POST['module_id']);

        $info = json_decode($videos[0]['files'] , true); 
        foreach ($info as $key => $value) {
            if (isset($value['title']) ) {
                $title[] = $value['title'];
            }else{
                $video[] = $value['Audio'];
            }
        }
        $title[$_POST['Serial_num']] = $_POST['title'];
        $array_one =array();
        $toUpdate =array();

        $this->load->library('upload');

       $config['upload_path'] = 'assets/uploads/';
       $config['allowed_types'] = 'mp4';
       $config['overwrite'] = false;
       $this->upload->initialize($config);
       $config['file_name']=rand(99,9999).time().$_FILES['video']['name'];
       $this->upload->initialize($config);
       $_FILES['audio']['name']=rand(99,9999).time().$_FILES['video']['name'];
       $_FILES['audio']['type']=$_FILES['video']['type'];
       $_FILES['audio']['tmp_name']=$_FILES['video']['tmp_name'];
       $_FILES['audio']['error']=$_FILES['video']['error'];
       $_FILES['audio']['size']=$_FILES['video']['size'];


       if (!$this->upload->do_upload('audio')) {
           $status = 'error';
           $audio = $this->upload->display_errors('', '');
           $var1 =[
            "Audio"=>'none'
          ];

           array_push($array_one, $var1);
       } else {
           $audioFiles = $this->upload->data();

          $var2 =[
            "Audio"=>'assets/uploads/'.$audioFiles["file_name"]
          ];
       }

        $video[$_POST['Serial_num']] = $var2['Audio'];

        foreach ($title as $key => $value) {
            $toUpdate[]['title'] = $value;
        }
        foreach ($video as $key => $value) {
            $toUpdate[]['Audio'] = $value;
        }

        $dataToUpdate['files'] = json_encode($toUpdate);

        $this->ModuleModel->updateInfo('module_instruction_videos_new', 'module_id', $_POST['module_id'], $dataToUpdate);

        echo 1;
    }

    public function delete_module_instruction_video()
    {
        $post = $this->input->post();
        
        $videos = $this->tutor_model->getInfo('module_instruction_videos_new', 'module_id',$_POST['module_id']);

        $info = json_decode($videos[0]['files'] , true); 
        foreach ($info as $key => $value) {
            if (isset($value['title']) ) {
                $title[] = $value['title'];
            }else{
                $video[] = $value['Audio'];
            }
        }
        unset($title[$_POST['Serial_num']]);
        unset($video[$_POST['Serial_num']]);

        foreach ($title as $key => $value) {
            $toUpdate[]['title'] = $value;
        }
        foreach ($video as $key => $value) {
            $toUpdate[]['Audio'] = $value;
        }

        $dataToUpdate['files'] = json_encode($toUpdate);
        $this->ModuleModel->updateInfo('module_instruction_videos_new', 'module_id', $_POST['module_id'], $dataToUpdate);
        echo 1;
    }

    public function update_module_instract_video()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('module_id', 'Module Id', 'required');

        if($this->form_validation->run())
          {
            $post = $this->input->post();

            $videos = $this->tutor_model->getInfo('module_instruction_videos_new', 'module_id',$_POST['module_id']);

            $info = json_decode($videos[0]['files'] , true); 
            foreach ($info as $key => $value) {
                if (isset($value['title']) ) {
                    $title[] = $value['title'];
                }else{
                    $video[] = $value['Audio'];
                }
            }
            $files = $this->processVideoHelp($post);

            $info = json_decode($files , true); 

            foreach ($info as $key => $value) {
                if (isset($value['title']) ) {
                    $title[] = $value['title'];
                }else{
                    $video[] = $value['Audio'];
                }
            }

            foreach ($title as $key => $value) {
            $toUpdate[]['title'] = $value;
            }
            foreach ($video as $key => $value) {
                $toUpdate[]['Audio'] = $value;
            }

            $dataToUpdate['files'] = json_encode($toUpdate);
            $this->ModuleModel->updateInfo('module_instruction_videos_new', 'module_id', $_POST['module_id'], $dataToUpdate);

          }else{

               $array = array(
                
                'module_id_error'     => form_error('module_id'),
               );

               $error['error'] = $array;
               echo json_encode($error);
          }
    }

    public function instract_videoDelete()
    {
        $videos = $this->ModuleModel->deleteInfo('module_instruction_videos_new', 'module_id',$_POST['module_id']);

        echo 1;

    }

    public function SchooltutorList($moduleType)
    {
        if (!strpos($_SERVER['HTTP_REFERER'],"all_tutors_by_type")) {
            $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
        }else{
            $_SESSION['prevUrl'] = base_url('/').'student/organization';
        }
        $loggedStudentId  = $this->loggedUserId;
        // $studentsTutor = $this->Student_model->allTutor($loggedStudentId);

        $get_involved_school = $this->Student_model->get_sct_enrollment_info($this->session->userdata('user_id'), 4);

        $all_parents = $this->Student_model->all_assigners_new($loggedStudentId);
                
        $data['module_type'] = $moduleType;
        $i = 0;
        $allSchoolTutor = array();
        foreach ($all_parents as $row) {
            if ($row['SCT_link'] == $get_involved_school[0]['SCT_link'] ) {
                $allSchoolTutor[] = $row;
            }
        }

        $data['allTutors'] = $allSchoolTutor;
        
        $data['module_type'] = $moduleType;
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header']     = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $data['maincontent'] = $this->load->view('module/tutor_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function CorporatetutorList($moduleType)
    {
        if (!strpos($_SERVER['HTTP_REFERER'],"all_tutors_by_type")) {
            $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
        }else{
            $_SESSION['prevUrl'] = base_url('/').'student/organization';
        }
        $loggedStudentId  = $this->loggedUserId;
        // $studentsTutor = $this->Student_model->allTutor($loggedStudentId);

        $get_involved_school = $this->Student_model->get_sct_enrollment_info($this->session->userdata('user_id'), 5);

        $all_parents = $this->Student_model->all_assigners_new($loggedStudentId);
                
        $data['module_type'] = $moduleType;
        $i = 0;
        $allSchoolTutor = array();
        foreach ($all_parents as $row) {
            if ($row['SCT_link'] == $get_involved_school[0]['SCT_link'] ) {
                $allSchoolTutor[] = $row;
            }
        }

        $data['allTutors'] = $allSchoolTutor;
        
        $data['module_type'] = $moduleType;
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header']     = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $data['maincontent'] = $this->load->view('module/tutor_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function createModule($id="")
    {
        
        if(empty($id)){
            $this->db->truncate('tbl_pre_module_temp');
            $module_info['module_name'] = null;
            $module_info['grade_id'] = null;
            $module_info['module_type'] = null;
            $module_info['course_id'] = null;
            $module_info['show_student'] = null;
            $module_info['serial'] = null;
        
            $this->session->set_userdata('module_info_creadiential', $module_info);
        }
        $this->session->unset_userdata('module_status');
        $this->session->unset_userdata('module_edit_id');
        $this->session->unset_userdata('param_module_id');
        $data['module_cre_info'] = $this->session->userdata('module_info_creadiential');
        // echo "<pre>";print_r($data['module_cre_info']);die();
       

        $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
        if (strpos($_SESSION['prevUrl'], "edit-module") || strpos($_SESSION['prevUrl'], "add-module")) {
            if (!empty($_GET['country'])) {
                $_SESSION['prevUrl'] = base_url('/qstudy/view_course/?country=') . $_GET['country'];
            } else {
                $_SESSION['prevUrl'] = base_url('/qstudy/view_course/');
            }
        }

        $data['video_help'] = $this->FaqModel->videoSerialize(25, 'video_helps'); //rakesh
        $data['video_help_serial'] = 25;

        $user_id = $this->session->userdata('user_id');
        $data['user_info'] = $this->tutor_model->userInfo($user_id);
        $conditions = [
            'user_id' => $user_id,
            'country' => isset($_GET['country']) ? $_GET['country'] : '',
        ];
        $conditions = array_filter($conditions);
        //$data['all_module'] = $this->Admin_model->search('tbl_module', $conditions);
        $data['all_module'] = $this->Admin_model->getModule('tbl_module', $conditions);

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header']     = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);


        $data['all_grade']          = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_module_type']    = $this->tutor_model->getAllInfo('tbl_moduletype');

        $data['all_subject']        = $this->tutor_model->getInfo('tbl_subject', 'created_by', $user_id);
        $data['all_course']        = $this->Admin_model->search('tbl_course', [1 => 1]);
        $data['allRenderedModType'] = $this->renderAllModuleType();

        $data['module_types'] = $this->ModuleModel->getModuleType();
        $country_id = $this->session->userdata('selCountry');
        $data['courses'] = $this->ModuleModel->getAllCourse($country_id);

        $data['allCountry']  = $this->admin_model->search('tbl_country', [1 => 1]);

        // $data['module_types'] = $this->ModuleModel->getModuleType();

        $data['tbl_pre_module_temp'] = $this->ModuleModel->getTblPreModuleTempCourse();
        $question_list = [];
        foreach ($data['tbl_pre_module_temp'] as $key => $row) {
            $question_list[] = $this->ModuleModel->getTblQuestion($row['question_id']);
            $user_id = $this->loggedUserId;
            $find_lists = $this->ModuleModel->getQuestions($row['question_type'],$user_id,$country_id);
               $i=1;
               $order = 0;
               foreach($find_lists as $question){
                    if($question['id']==$row['question_id']){
                        $order = $i;
                      break;
                    }
               $i++;}
              // echo $order.'<br>';
            $question_list[$key]['order'] = $order;
            $question_list[$key]['question_order'] = $row['question_order'];

            $question_list[$key]['tbl_id'] = $row['id'];
        }
        // die();
        foreach ($question_list as $key => $type) {
            $question_list[$key]['question_name'] = $this->ModuleModel->getTblQuestionType($type['questionType']);
            $question_list[$key]['count'] = $this->ModuleModel->getAllTblQuestion($type['questionType']);
        }
        $data['question_list'] = $question_list;
        $data['loggedUserType'] = $this->loggedUserType;
        // echo "<pre>"; print_r($question_list); die();
        
        $studentIds = $this->tutor_model->allStudents(['sct_id' => $user_id]);
        //echo "<pre>"; print_r($studentIds);die;
        $data['allquestiontype']  = $this->ModuleModel->getQuestionType();
        $data['allStudents']  = $this->renderStudentIds($studentIds);
        $data['allsubjects']  = $this->ModuleModel->getAllSubjects($user_id);
        $data['allchapters']  = $this->ModuleModel->getAllChapters($user_id);

        // check password added shvou
        $data['checkNullPw'] = $this->db->where("setting_key", "qstudyPassword")->where("setting_type !=", '')->get('tbl_setting')->result_array();
        $data['maincontent'] = $this->load->view('module/create_module', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function detailsModule()
    { 
        // echo "hi"; die();
        // $this->session->unset_userdata('search_module_name');
        // $this->session->unset_userdata('search_student_grade');
        // $this->session->unset_userdata('search_module_type');
        // $this->session->unset_userdata('search_course_name');

        $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
        if (strpos($_SESSION['prevUrl'], "edit-module") || strpos($_SESSION['prevUrl'], "add-module")) {
            if (!empty($_GET['country'])) {
                $_SESSION['prevUrl'] = base_url('/qstudy/view_course/?country=') . $_GET['country'];
            } else {
                $_SESSION['prevUrl'] = base_url('/qstudy/view_course/');
            }
        }

        $data['video_help'] = $this->FaqModel->videoSerialize(25, 'video_helps'); //rakesh
        $data['video_help_serial'] = 25;

        $user_id = $this->session->userdata('user_id');
        $data['user_info'] = $this->tutor_model->userInfo($user_id);
        $conditions = [
            'user_id' => $user_id,
            'country' => isset($_GET['country']) ? $_GET['country'] : '',
        ];
        $conditions = array_filter($conditions);
        //$data['all_module'] = $this->Admin_model->search('tbl_module', $conditions);
        $data['all_module'] = $this->Admin_model->getModule('tbl_module', $conditions);

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header']     = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        

        $data['all_grade']   = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_modules']    = $this->tutor_model->getAllInfo('tbl_moduletype');

        $data['all_subject']        = $this->tutor_model->getInfo('tbl_subject', 'created_by', $user_id);
        $data['all_course']        = $this->Admin_model->search('tbl_course', [1 => 1]);
        // $data['allRenderedModType'] = $this->renderAllModuleType();
        // echo "<pre>";print_r($data['all_course']);die();

        $data['allsubjects']  = $this->ModuleModel->getAllSubjects($user_id);
        $data['allchapters']  = $this->ModuleModel->getAllChapters($user_id);

        $country_id = $this->session->userdata('selCountry');

        $data['courses'] = json_encode($this->ModuleModel->getAllCourse($country_id));
        // echo "<pre>";print_r($data);die();
        /*=============================================================================
                                    pagination code
        ===============================================================================*/
        $this->load->library('pagination');

        $config = array();
		$config["base_url"] = base_url() . "details-module";
		$config["total_rows"] = $this->ModuleModel->countTblNewModuleRows();
		
		$config["per_page"] = 10;
		$config["uri_segment"] = 2;

		$config['full_tag_open'] = '<ul class="module_pg pagination">';        
        $config['full_tag_close'] = '</ul>';        
        $config['first_link'] = 'First';        
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['first_tag_close'] = '</span></li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['prev_tag_close'] = '</span></li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['next_tag_close'] = '</span></li>';        
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['last_tag_close'] = '</span></li>';        
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['num_tag_close'] = '</span></li>';

		// $config['attributes'] = array('class' => 'myclass');

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        // echo $page;die();
		$data["links"] = $this->pagination->create_links();
        $data['all_module_questions'] = $this->ModuleModel->getTblNewModule($config["per_page"], $page);
        
        foreach($data['all_module_questions'] as $key => $value){
            $data['all_module_questions'][$key]['country_name'] = $this->ModuleModel->getCountryName($value['country']);
            $data['all_module_questions'][$key]['course_name'] = $this->ModuleModel->getCourseName($value['chapter']);
        }

        // $data['countryName'] = $this->ModuleModel->getAllCourse($country_id);all_module_questions

        $data['allCountry']  = $this->admin_model->search('tbl_country', [1 => 1]);
        // echo "<pre>"; print_r($data['all_module_questions']); die();


        // check password added shvou
        $data['checkNullPw'] = $this->db->where("setting_key", "qstudyPassword")->where("setting_type !=", '')->get('tbl_setting')->result_array();
        $data['maincontent'] = $this->load->view('module/details_module', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function moduleQuestionDelete($questionId = 0)
    {
        $delItems = $this->QuestionModel->delete('tbl_pre_module_temp', 'id', $questionId);
        if ($delItems) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function moduleDuplicateQuestion()
    {
        $tblpre = $this->ModuleModel->getMaxTblPreModuleTempCourse();
        // echo "<pre>"; print_r($_POST); die();

        $questionId  = $this->input->post('questionId', true);
        $questionType  = $this->input->post('qType', true);

        $created_question = $this->ModuleModel->duplicateQuestionCreate($questionId,$questionType);

        $data = [
            'question_id' => $created_question['id'],
            'question_type' => $created_question['questionType'],
            'question_no' => 1,
            'question_order' => $tblpre['max_size'] + 1,
        ];
        //echo "<pre>";print_r($data);die();
        $duplicate = $this->ModuleModel->moduleQuestionDuplicate('tbl_pre_module_temp', $data);
        
        if ($duplicate) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function moduleQuestionSorting()
    {
        $order  = $this->input->post('order', true);
        $id  = $this->input->post('tblId', true);

        $data = [
            'question_order' => $order,
        ];

        $duplicate = $this->ModuleModel->questionSorting('tbl_pre_module_temp', 'id', $id, $data);

        // echo $this->db->last_query(); die();

        if ($duplicate) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function EditmoduleQuestionSorting()
    {
        $order  = $this->input->post('order', true);
        $id  = $this->input->post('tblId', true);

        $data = [
            'question_order' => $order,
        ];

        $duplicate = $this->ModuleModel->questionSorting('tbl_edit_module_temp', 'id', $id, $data);

        // echo $this->db->last_query(); die();

        if ($duplicate) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function saveNewModuleQuestion()
    {
        // echo "<pre>"; print_r($_POST); die();
        // echo "<pre>"; print_r($_GET['country']); die();

        $uType = $this->loggedUserType;
        if ($uType == 1 || $uType == 2 || $uType == 6) {
            //user type parent, upper student,student shouldn't add module
            $this->session->set_flashdata('error_msg', "You've no access to view this page");
            redirect('/');
        }

        $post = $this->input->post();
        if ($post['moduleType'] == 1 || $post['moduleType'] == 2 || $post['moduleType'] == 5) {
            $post['dateCreated'] = date('Y-m-d');
        }
        $date = $post['dateCreated'];

        $startTime = date('Y-m-d', strtotime($date)) . ' ' . $post['startTime'];
        $endTime = date('Y-m-d', strtotime($date)) . ' ' . $post['endTime'];

        $video_link = str_replace('</p>', '', $_POST['video_link']);
        $video_array = array_filter(explode('<p>', $video_link));

        $new_array = array();
        foreach ($video_array as $row) {
            $new_array[] = strip_tags($row);
        }
        // print_r(json_encode($video_array));die;
        // $video_link[] = $this->input->post('video_link');

        $clean             = $this->security->xss_clean($post);
        $optionalTime      = explode(':', isset($clean['optTime']) ? $clean['optTime'] : "0:0");
        $optionalHour      = isset($optionalTime[0]) ? (int)$optionalTime[0] * 60 * 60 : 0; //second
        $optionalMinute    = isset($optionalTime[1]) ? (int)$optionalTime[1] * 60    : 0; //second

        //get users latest module order
        $mods = $this->Admin_model->search('tbl_module', ['user_id' => $this->loggedUserId]);
        if (count($mods)) {
            $allOrders = array_column($mods, 'ordering');
            $maxOrder = max($allOrders);
            $nextOrder = $maxOrder + 1;
        } else {
            $nextOrder = 0;
        }
        //echo $clean['moduleType'].'///'.$clean['studentGrade'];die();
        $module_check = $this->ModuleModel->get_module_serial($clean['moduleType'],$clean['studentGrade'],$clean['course_id']);
        //print_r($module_check);die();
        if(!empty($module_check)){
           $serial_no = $module_check['max_serial']+1;
        }else{
            $serial_no = 1;
        }
        
        $moduleTableData   = [];
        $moduleTableData[] = [
            'moduleName'        => $clean['moduleName'],
            'ordering'          => $nextOrder,
            'trackerName'       => $clean['trackerName'],
            'instruction'       => $clean['instruction'],
            'individualName'    => isset($clean['individualName']) ? $clean['individualName'] : '',
            'isSMS'             => isset($clean['isSMS']) ? $clean['isSMS'] : 0,
            'isAllStudent'      => isset($clean['isAllStudent']) ? $clean['isAllStudent'] : 0,
            'individualStudent' => isset($clean['individualStudent']) ? json_encode($clean['individualStudent']) : '',
            'course_id'         => isset($clean['course_id']) ? $clean['course_id'] : '',
            'video_link'        => json_encode($new_array),
            'video_name'        => isset($_POST['video_name']) ? $_POST['video_name'] : '',
            'subject'           => $clean['subject'],
            'chapter'           => $clean['chapter'],
            'country'           => $this->session->userdata('selCountry'),
            'studentGrade'      => $clean['studentGrade'],
            'moduleType'        => $clean['moduleType'],
            'user_id'           => $this->loggedUserId,
            'user_type'         => $this->loggedUserType,
            'exam_date'         => isset($clean['dateCreated']) ? strtotime($clean['dateCreated']) : 0,
            'exam_start'        => isset($clean['startTime']) ? ($startTime) : 0,
            'exam_end'          => isset($clean['endTime']) ? ($endTime) : 0,
            'optionalTime'      => $optionalHour + $optionalMinute,
            'show_student'      => isset($_POST['show_student']) ? $_POST['show_student'] : 0,
            //'serial'      => isset($_POST['serial']) ? $_POST['serial'] : 0,
            'serial'      => $serial_no,
        ];


        // echo "<pre>"; print_r($moduleTableData); die();

        // Save module info first
        $moduleId = $this->ModuleModel->insert('tbl_module', $moduleTableData);
        $module_insert_id = $this->db->insert_id();

        // If ques order set record those to tbl_modulequestion table
        $arr   = [];
        $items = $this->ModuleModel->getTblPreModuleTempCourse();
        // echo "<pre>"; print_r($items); die();

        if (count($items)) {
            foreach ($items as $item) {
                $arr[] = [
                    'question_id'    => $item['question_id'],
                    'question_type'  => $item['question_type'],
                    'module_id'      => $moduleId,
                    'question_order' => $item['question_order'],
                    'created'        => time(),
                ];
            }
            $this->ModuleModel->insert('tbl_modulequestion', $arr);
            $this->session->set_flashdata('module_msg', 'Save Successfully');

            
        }

        if ($clean['moduleType'] == 2) {
            $repetition_data = [];
            $a = [];
            $i = 0;
            $j = 1;
            $date = date('Y-m-d');
            while ($j < 365) {
                $j = $i * 30 + 1;
                $a[] = $j . '_' . date('Y-m-d', strtotime($date . ' +' . $j . ' days'));;
                $j += 1;
                $a[] = $j . '_' . date('Y-m-d', strtotime($date . ' +' . $j . ' days'));;
                $i++;
                if ($j == 362) {
                    break;
                }
            }

            $repetition_days = json_encode($a);
            $this->db->where('id', $module_insert_id)->update('tbl_module', ['repetition_days' => $repetition_days]);
        }
        $this->db->truncate('tbl_pre_module_temp');
        // echo "<pre>"; print_r($arr); die();

        redirect(base_url() . 'details-module', 'refresh');

        // $this->session->set_flashdata('success_msg', 'Module Saved Successfully.');
        // redirect('all-module');
    } //end

    public function newModulePreview($modle_id, $question_order_id)
    {
        // echo $modle_id.'//'.$question_order_id;
        // die();

        $data['order'] = $this->uri->segment('3');
        $_SESSION['q_order'] = $this->uri->segment('3');
        $_SESSION['q_order_module'] = $this->uri->segment('2');

        $data['user_info']  = $this->tutor_model->userInfo($this->session->userdata('user_id'));
        $data['userType'] = $data['user_info'][0]['user_type'];
        date_default_timezone_set($this->site_user_data['zone_name']);
        $exact_time = time();
        $this->session->set_userdata('exact_time', $exact_time);

        $data['question_info_s'] = $this->tutor_model->getNewModuleQuestion($modle_id, $question_order_id, null);
        
        $data['main_module'] = $this->tutor_model->getInfo('tbl_module', 'id', $modle_id);
        // print_r($data['question_info_s']);

        $data['total_question'] = $this->tutor_model->getNewModuleQuestion($modle_id, null, 1);

        $data['page_title']     = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink']     = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header']         = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink']     = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['quesOrder'] = $question_order_id;

        // echo "<pre>"; print_r($data); die();

        //if question not found
        if (!$data['question_info_s'][0]['id']) {
            $question_order_id = $question_order_id + 1;
            redirect('get_tutor_tutorial_module/' . $modle_id . '/' . $question_order_id);
        }

        if (isset($data['question_info_s'][0])) {
            $quesInfo = json_decode($data['question_info_s'][0]['questionName']);

            if ($data['question_info_s'][0]['questionType'] == 1) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['maincontent'] = $this->load->view('module/new_preview/preview_general', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 2) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['maincontent'] = $this->load->view('module/new_preview/preview_true_false', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 3) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
                $data['maincontent']             = $this->load->view('module/new_preview/preview_vocabulary', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 4) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['question_info_vcabulary'] = $quesInfo;
                $data['maincontent']             = $this->load->view('module/new_preview/preview_multiple_choice', $data, true);
            } elseif ($data['question_info_s'][0]['question_type'] == 5) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
                $data['maincontent'] = $this->load->view('module/new_preview/preview_multiple_response', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 6) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                // skip quiz
                $data['numOfRows']    = isset($quesInfo->numOfRows) ? $quesInfo->numOfRows : 0;
                $data['numOfCols']    = isset($quesInfo->numOfCols) ? $quesInfo->numOfCols : 0;
                $data['questionBody'] = isset($quesInfo->question_body) ? $quesInfo->question_body : '';
                $data['questionId']   = $data['question_info_s'][0]['question_id'];
                $quesAnsItem          = $quesInfo->skp_quiz_box;
                $items                = indexQuesAns($quesAnsItem);

                $data['skp_box']     = renderSkpQuizPrevTable($items, $data['numOfRows'], $data['numOfCols']);
                $data['maincontent'] = $this->load->view('module/new_preview/skip_quiz', $data, true);
            } elseif ($data['question_info_s'][0]['question_type'] == 7) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                //
                $data['question_info_left_right'] = json_decode($data['question_info_s'][0]['questionName']);
                $data['maincontent'] = $this->load->view('module/new_preview/preview_matching', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 8) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                // assignment
                $data['questionBody']    = isset($quesInfo->question_body) ? $quesInfo->question_body : '';
                $items                   = $quesInfo->assignment_tasks;
                $data['totalItems']      = count($items);
                $data['assignment_list'] = renderAssignmentTasks($items);
                $data['maincontent']     = $this->load->view('module/new_preview/assignment', $data, true);
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

                $data['maincontent'] = $this->load->view('module/new_preview/module_preview_storyWrite', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 10) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['question_info']   = json_decode($data['question_info_s'][0]['questionName'], true);
                $data['maincontent']     = $this->load->view('module/new_preview/preview_times_table', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 11) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['question_info']   = json_decode($data['question_info_s'][0]['questionName'], true);
                $data['maincontent']     = $this->load->view('module/new_preview/preview_algorithm', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 12) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['question_info']   = json_decode($data['question_info_s'][0]['questionName'], true);
                $data['maincontent']     = $this->load->view('module/new_preview/workout_quiz', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 13) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['question_info_vcabulary'] = $quesInfo;
                $data['maincontent']             = $this->load->view('module/new_preview/preview_matching_workout', $data, true);
            } elseif ($data['question_info_s'][0]['questionType'] == 14) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                if (!empty($_SERVER['HTTP_REFERER'])) {
                    $_SESSION["previous_page"] = $_SERVER['HTTP_REFERER'];

                    $data["last_question_order"] = $_SESSION['q_order_2'];
                    // print_r($_SESSION["previous_page"]); die();
                    $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
                    // print_r(['question_info_vcabulary']); die();
                    $tutorialId = $data['question_info_s'][0]['question_id'];
                    $data['tutorialInfo'] = $this->tutor_model->getInfo('for_tutorial_tbl_question', 'tbl_ques_id', $tutorialId);
                    $data['maincontent'] = $this->load->view('module/new_preview/preview_tutorial', $data, true);
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
                $data['maincontent'] = $this->load->view('module/new_preview/preview_workout_quiz_two', $data, true);
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

                //                echo '<pre>';
                //                print_r($data['question_info_ind']);
                //                die();
                $data['maincontent'] = $this->load->view('module/new_preview/preview_memorization_quiz', $data, true);
            }elseif ($data['question_info_s'][0]['questionType'] == 17) {
                $data['question_item'] = $data['question_info_s'][0]['questionType'];
                $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
                $data['question_info_ind'] = $data['question_info'];
                if (isset($data['question_info_ind']->percentage_array)) {
                    $data['ans_count'] = count((array)$data['question_info_ind']->percentage_array);
                } else {
                    $data['ans_count'] = 0;
                }
                $data['maincontent'] = $this->load->view('module/new_preview/preview_creative_quiz', $data, true);
            }elseif ($data['question_info_s'][0]['questionType'] == 18) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['sentence_matching'] = $quesInfo;
                //echo "<pre>";print_r($data['question_info_s'][0]['question_id']);die();
                $data['sentence_questions'] = json_decode($data['question_info_s'][0]['questionName']);
                $data['sentence_answers'] = json_decode($data['question_info_s'][0]['answer']);
                $data['maincontent'] = $this->load->view('module/new_preview/preview_sentence_matching', $data, true);
            }elseif ($data['question_info_s'][0]['questionType'] == 19) {
                $_SESSION['q_order_2'] = $this->uri->segment('3');
                $data['word_memorization'] = $quesInfo;
                $data['maincontent'] = $this->load->view('module/new_preview/preview_word_memorization', $data, true);
            }

        } else {
            $data['maincontent']     = $this->load->view('module/new_preview/moduleWithoutQues', $data, true);
        } // no question to preview


        $this->load->view('master_dashboard', $data);
    } //end module_preview()
    
    public function newModuleDuplicate()
    {
        // echo "<pre>"; print_r($_POST); die();


        $withQuestion = $this->input->post('with_question');
        $course_id = $this->input->post('course_id');
        $moduleType = $this->input->post('moduleType');
        $studentGrade = $this->input->post('studentGrade');
        $subject = $this->input->post('subject');
        $chapter = $this->input->post('chapter');
        $user_id = $this->session->userdata('user_id');
        
        if($withQuestion == 1){
            $moduleId = $this->input->post('module_id');
            $items = $this->ModuleModel->getTblModuleInfo($moduleId);
            $Max_serial = $this->ModuleModel->getModuleMaxSerial($course_id,$moduleType,$studentGrade);
            if(!empty($Max_serial['max_serial'])){
              $serial = $Max_serial['max_serial']+1;
            }else{
              $serial = 1; 
            }
            
            $items['id'] = null;
            $items['moduleName'] = $this->input->post('moduleName');
            $items['course_id'] = $this->input->post('course_id');
            $items['moduleType'] = $this->input->post('moduleType');
            $items['country'] = $this->input->post('country');
            $items['studentGrade'] = $this->input->post('studentGrade');
            $items['user_id'] = $user_id;

            if($this->input->post('moduleType')==1){
                $items['subject'] = $subject;
                $items['chapter'] = $chapter;
            }else{
                $items['subject'] = 0;
                $items['chapter'] = 0;
            }

            $items['serial'] = $serial;

            
            $this->db->insert('tbl_module', $items);
            $new_module_id = $this->db->insert_id();

            $moduleQuestions = $this->ModuleModel->getTblNewModuleQuestion($moduleId, $new_module_id);

            echo 1;

        }else{
            
            $moduleId = $this->input->post('module_id');
            $items = $this->ModuleModel->getTblModuleInfo($moduleId);
            $Max_serial = $this->ModuleModel->getModuleMaxSerial($course_id,$moduleType,$studentGrade);
            if(!empty($Max_serial['max_serial'])){
              $serial = $Max_serial['max_serial']+1;
            }else{
              $serial = 1; 
            }
            
            $items['id'] = null;
            $items['moduleName'] = $this->input->post('moduleName');
            $items['course_id'] = $this->input->post('course_id');
            $items['moduleType'] = $this->input->post('moduleType');
            $items['country'] = $this->input->post('country');
            $items['studentGrade'] = $this->input->post('studentGrade');
            $items['user_id'] = $user_id;

            if($this->input->post('moduleType')==1){
                $items['subject'] = $subject;
                $items['chapter'] = $chapter;
            }else{
                $items['subject'] = 0;
                $items['chapter'] = 0;
            }
            
            $items['serial'] = $serial;

            //echo "<pre>";print_r($items);die();
            $this->db->insert('tbl_module', $items);
            $insertId = $this->db->insert_id();

            $moduleQuestions = $this->ModuleModel->getTblNewModuleQuestionWithout($moduleId);

            foreach($moduleQuestions as $key => $question){
                $moduleQuestions[$key]['id'] = null;
                $moduleQuestions[$key]['module_id'] = $insertId;
            }

            foreach($moduleQuestions as $value){
                $result = $this->db->insert('tbl_modulequestion', $value);
                echo $result;
            }

        }

    }

    public function get_question_data(){

        // echo "<pre>";print_r($_POST);die();

        $question_number = $this->input->post('question_number');
        $question_type = $this->input->post('question_type');
        $student_grade = $this->input->post('studentgrade');
        $subject = $this->input->post('subject');
        $chapter = $this->input->post('chapter');
        $country = $this->session->userdata('selCountry');

        $this->db->select('*');
        $this->db->from('tbl_question');
        // $this->db->where('id', $question_id);
        $this->db->where('questionType', $question_type);
        // $this->db->where('studentgrade', $student_grade);
        // $this->db->where('subject', $subject);
        // $this->db->where('chapter', $chapter);
        // $this->db->limit(1, $question_number);
        $this->db->where('country', $country);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        // $this->db->limit(1, $question_number);
        $query_result = $this->db->get();
        $question = $query_result->result_array();


        $data = $question[$question_number-1];
        $data['module_id'] = $this->input->post('module_id');
        // echo $this->db->last_query();
        // echo "<pre>";print_r($question[$question_number-1]);die();
         
        // $temp = $this->ModuleModel->getInfo2('tbl_question', 'id', $question['id']);

        echo json_encode($data);
    }

    public function module_insert_question_data(){
        // echo "<pre>";print_r($_POST);die();

        $module_status = $this->session->userdata('module_status');
        $module_edit_id = $this->session->userdata('module_edit_id');
        //$param_module_id = $this->session->userdata('param_module_id');
        $param_module_id = $this->input->post('module_id');

        $question_id = $this->input->post('question_id');
        $module_create = $this->input->post('module_create');
        //echo $param_module_id; die();

        if($module_create==1){
            $this->db->select('*');
            $this->db->from('tbl_pre_module_temp');
            $query_result = $this->db->get();
            $results = $query_result->result_array();
            $question_no = count($results);
            $question_order = $question_no+1;
            $module_insert['question_id'] = $question_id;
            $module_insert['question_type'] = $_POST['question_type'];
            $module_insert['question_order'] = $question_order;
            $module_insert['question_no'] = $question_no;
            $module_insert['question_no'] = $this->input->post('country');
            $this->db->insert('tbl_pre_module_temp', $module_insert);
            
            
        }else{
            // echo 22; die();

            $this->db->select('*');
            $this->db->from('tbl_edit_module_temp');
            $query_result = $this->db->get();
            $results = $query_result->result_array();
            $question_no = count($results);
            $question_order = $question_no+1;

            $module_insert['module_id'] = $param_module_id;
            $module_insert['question_id'] = $question_id;
            $module_insert['question_type'] = $_POST['question_type'];
            $module_insert['question_order'] = $question_order;
            // $module_insert['question_no'] = $question_no;
            $module_insert['country'] = $this->input->post('country');

            // echo "<pre>";print_r($module_insert);die();

            $this->db->insert('tbl_edit_module_temp', $module_insert);
        }

        echo 'added';

        // die();
    }

    public function newEditModule($moduleId,$id="")
    {
        $this->session->unset_userdata('module_edit_status');
        $this->session->unset_userdata('module_status_edit_id');
        $this->session->unset_userdata('module_status');
        $this->session->unset_userdata('param_module_id');
        //echo "hello"; die();
        $module_session_info = $this->session->userdata('edit_module_info_creadiential');

        if(empty($id) && $module_session_info['module_id']!=$moduleId){
           
            $module_info['module_name'] = null;
            $module_info['grade_id'] = null;
            $module_info['module_type'] = null;
            $module_info['course_id'] = null;
            $module_info['show_student'] = null;
            $module_info['serial'] = null;
            $module_info['module_id'] = $moduleId;
        
            $this->session->set_userdata('edit_module_info_creadiential', $module_info);
        }
        if($id==2){
            $this->session->unset_userdata('edit_module_info_creadiential');
        }
        $data['module_cre_info'] = $this->session->userdata('edit_module_info_creadiential');
        
        // echo "<pre>";print_r($data['module_cre_info']);die();


        $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
        $data['video_help'] = $this->FaqModel->videoSerialize(26, 'video_helps'); //rakesh
        $data['video_help_serial'] = 26;

        $_SESSION["moduleId"] = $moduleId;
        $data["module_id"] = $moduleId;
        $uType = $this->loggedUserType;
        if ($uType == 1 || $uType == 2 || $uType == 6) {
            //user type parent, upper student,student shouldn't add module
            $this->session->set_flashdata('error_msg', "You've no access to view this page");
            redirect('/');
        }

        $this->session->unset_userdata('data');
        $this->session->unset_userdata('obtained_marks');
        $this->session->unset_userdata('total_marks');

        $user_id                = $this->session->userdata('user_id');
        $data['loggedUserType'] = $this->loggedUserType;
        $data['user_info']      = $this->tutor_model->userInfo($user_id);
        
        
        $data['questions'] = $this->ModuleModel->getEditModuleInfo($moduleId);
        $country_id = $this->session->userdata('selCountry');
        //echo "<pre>";print_r($data['questions']);die();
        foreach($data['questions'] as $key=>$ques){
            $user_id = $this->loggedUserId;
            $find_lists = $this->ModuleModel->getQuestions($ques['question_type'],$user_id,$country_id);
            if($key==3){

                //echo "<pre>";print_r($find_lists);
            }
               $i=1;
               $order = 0;
               foreach($find_lists as $question){
                    if($question['id']==$ques['question_id']){
                        $order = $i;
                      break;
                    }
               $i++;}

              $data['questions'][$key]['order'] = $order;
        }
        

        $module = $this->ModuleModel->newModuleInfo($moduleId);
        //echo '<pre>'; print_r($data['questions']); die();

        $course_id = $module['course_id'];
        $moduleType = $module['moduleType'];
        $subject = $module['subject'];

        if($moduleType ==1){
            $data['subjects'] = $this->ModuleModel->getSubjectBycourse($course_id);
            $data['chapters'] = $this->ModuleModel->getChapterBycourse($subject);
        }else{
            $data['subjects'] = null;
            $data['chapters'] = null;
        }
        //echo "<pre>";print_r($data['chapters']);die();
        $data['module_info'] = $module;
        $data['courses'] = $this->ModuleModel->getAllCourse($country_id);
        $data['module_types'] = $this->ModuleModel->getModuleType();

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header']     = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
        $user_id = $this->session->userdata('user_id');
        // echo '<pre>'; print_r($data['courses']); die();
        
        $data['loggedUserType'] = $this->loggedUserType;


        $optionalHour              = $module['optionalTime'] > 3600 ? sprintf('%02d', $module['optionalTime'] / 3600) : "00";
        $optionalMinute            = sprintf('%02d', ($module['optionalTime'] / 60) - ($optionalHour * 60));
        $data['optionalTime']      = (string)$optionalHour . ':' . $optionalMinute;

        $data['instruction_video'] = json_decode($data['module_info']['video_link']);
        $data['instruction_video'] = (is_array($data['instruction_video']) && count($data['instruction_video'])) ? $data['instruction_video'][0] : '';
        $data['ins'] = $data["module_info"]["instruction"];

        $indivStdIds          = $module['individualStudent'];

        if ($this->loggedUserType == 7) { //q-stydy need this kinda filter
            $conditions = [
                'subject_name'   => $module['subject'],
                'student_grade'  => $module['studentGrade'],
                'country_id'     => $module['country'],
            ];
            $studentIds           = $this->tutor_model->allStudents($conditions);
        } else { //others don't . I dont know if I'm getting maaad :/
            $studentIds           = $this->tutor_model->allStudents(['sct_id' => $user_id]);
        }
        $data['allsubjects']  = $this->ModuleModel->getAllSubjects($user_id);
        $data['allchapters']  = $this->ModuleModel->getAllChapters($user_id); 

        $data['allStudents']  = $this->renderStudentIds($studentIds, $indivStdIds);
        $data['allquestiontype']  = $this->ModuleModel->getQuestionType();
        //echo "<pre>";print_r($data);
        $data['maincontent'] = $this->load->view('module/new_edit_module', $data, true);
        $this->load->view('master_dashboard', $data);
    } 

    public function deleteModuleQuestion($questionId = 0)
    {
        $delItems = $this->QuestionModel->delete('tbl_modulequestion', 'id', $questionId);
        if ($delItems) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function deleteEditModuleQuestion($questionId = 0, $module_id)
    {

        $delItems = $this->QuestionModel->delete('tbl_edit_module_temp', 'id', $questionId);
       
            $this->db->select('*');
            $this->db->from('tbl_edit_module_temp');
            $query_new = $this->db->get();
            $results = $query_new->result_array();
            
            if(empty($results)){
                $this->db->where('module_id', $module_id);
                $this->db->delete('tbl_modulequestion');
            }

        if ($delItems) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function duplicateModuleQuestion()
    {
        // echo 11; die();

        $moduleId  = $this->input->post('moduleId', true);
        $tblpre = $this->ModuleModel->getMaxTblNewModuleQuestionEdit($moduleId);
        // echo "<pre>"; print_r($tblpre['max_size']); die();

        $questionId  = $this->input->post('questionId', true);
        $questionType  = $this->input->post('qType', true);
        $copy_id = $this->input->post('qId', true);
        $question_id = $this->input->post('main_questionId', true);
        //echo "<pre>"; print_r($_POST); die();
        $question  = $this->ModuleModel->getDuplicateQuestion($question_id);
        
        $data = [
            'question_id' => $question['id'],
            'question_type' => $question['questionType'],
            'module_id' => $moduleId,
            'country' => $question['country'],
            'question_order' => $tblpre['max_size'] + 1,
            'created_at'        => time(),
        ];

        $duplicate = $this->db->insert('tbl_edit_module_temp', $data);
        //echo $this->db->last_query();die();
        if ($duplicate) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function updateNewModuleQuestion()
    {
        // echo 11; die();
        // echo "<pre>"; print_r($_GET['country']); die();
        $uType = $this->loggedUserType;
        if ($uType == 1 || $uType == 2 || $uType == 6) {
            //user type parent, upper student,student shouldn't add module
            $this->session->set_flashdata('error_msg', "You've no access to view this page");
            redirect('/');
        }

        $post = $this->input->post();
        // echo "<pre>"; print_r($post); die();

        if ($post['moduleType'] == 1 || $post['moduleType'] == 2 || $post['moduleType'] == 5) {
            $post['dateCreated'] = date('Y-m-d');
        }
        $date = $post['dateCreated'];

        $startTime = date('Y-m-d', strtotime($date)) . ' ' . $post['startTime'];
        $endTime = date('Y-m-d', strtotime($date)) . ' ' . $post['endTime'];

        $video_link = str_replace('</p>', '', $_POST['video_link']);
        $video_array = array_filter(explode('<p>', $video_link));

        $new_array = array();
        foreach ($video_array as $row) {
            $new_array[] = strip_tags($row);
        }
        // print_r(json_encode($video_array));die;
        //$video_link[] = $this->input->post('video_link');

        $clean             = $this->security->xss_clean($post);
        $optionalTime      = explode(':', isset($clean['optTime']) ? $clean['optTime'] : "0:0");
        $optionalHour      = isset($optionalTime[0]) ? (int)$optionalTime[0] * 60 * 60 : 0; //second
        $optionalMinute    = isset($optionalTime[1]) ? (int)$optionalTime[1] * 60    : 0; //second

        //get users latest module order
        $mods = $this->Admin_model->search('tbl_module', ['user_id' => $this->loggedUserId]);
        if (count($mods)) {
            $allOrders = array_column($mods, 'ordering');
            $maxOrder = max($allOrders);
            $nextOrder = $maxOrder + 1;
        } else {
            $nextOrder = 0;
        }


        $this->db->select('*');
        $this->db->from('tbl_module');
        $this->db->where('moduleType', $post['moduleType']);
        $this->db->where('studentGrade', $clean['studentGrade']);
        $this->db->where('course_id', $clean['course_id']);
        $this->db->where('user_id', $this->loggedUserId);
        $this->db->where('serial', $_POST['serial']);
        $query_new = $this->db->get();
        $chk_exits = $query_new->result_array();


        $moduleTableData   = [];
        $moduleTableData = [
            'moduleName'        => $clean['moduleName'],
            'ordering'          => $nextOrder,
            'trackerName'       => $clean['trackerName'],
            'instruction'       => $clean['instruction'],
            'individualName'    => isset($clean['individualName']) ? $clean['individualName'] : '',
            'isSMS'             => isset($clean['isSMS']) ? $clean['isSMS'] : 0,
            'isAllStudent'      => isset($clean['isAllStudent']) ? $clean['isAllStudent'] : 0,
            'individualStudent' => isset($clean['individualStudent']) ? json_encode($clean['individualStudent']) : '',
            'course_id'         => isset($clean['course_id']) ? $clean['course_id'] : '',
            'video_link'        => json_encode($new_array),
            'video_name'        => isset($_POST['video_name']) ? $_POST['video_name'] : '',
            'subject'           => $clean['subject'],
            'chapter'           => $clean['chapter'],
            'country'           => $this->session->userdata('selCountry'),
            'studentGrade'      => $clean['studentGrade'],
            'moduleType'        => $clean['moduleType'],
            'user_id'           => $this->loggedUserId,
            'user_type'         => $this->loggedUserType,
            'exam_date'         => isset($clean['dateCreated']) ? strtotime($clean['dateCreated']) : 0,
            'exam_start'        => isset($clean['startTime']) ? ($startTime) : 0,
            'exam_end'          => isset($clean['endTime']) ? ($endTime) : 0,
            'optionalTime'      => $optionalHour + $optionalMinute,
            'show_student'      => isset($_POST['show_student']) ? $_POST['show_student'] : 0,
            'serial'      => isset($_POST['serial']) ? $_POST['serial'] : 0,
        ];

        $this->ModuleModel->questionSorting('tbl_module', 'id', $clean['id'], $moduleTableData);
        

        $this->db->select('MAX(serial) as max_serial');
        $this->db->from('tbl_module');
        $this->db->where('moduleType', $post['moduleType']);
        $this->db->where('studentGrade', $clean['studentGrade']);
        $this->db->where('course_id', $clean['course_id']);
        $this->db->where('user_id', $this->loggedUserId);
        $query_new = $this->db->get();
        $result_max = $query_new->result_array();


        $this->db->select('*');
        $this->db->from('tbl_module');
        $this->db->where('id', $clean['id']);
        $query_new = $this->db->get();
        $get_module = $query_new->result_array();

        $this->db->select('*');
        $this->db->from('tbl_module');
        $this->db->where('id !=', $clean['id']);
        $this->db->where('serial', $_POST['serial']);
        $this->db->where('moduleType', $post['moduleType']);
        $this->db->where('studentGrade', $clean['studentGrade']);
        $this->db->where('course_id', $clean['course_id']);
        $this->db->where('country', $this->session->userdata('selCountry'));
        $this->db->where('user_id', $this->loggedUserId);
        $query_new = $this->db->get();
        $get_serial = $query_new->result_array();
        // echo "<pre>";print_r($get_serial);die();
        // echo $_POST['serial'].'///'.$get_module[0]['serial'];die();

        if($_POST['serial']!=$get_module[0]['serial'] || !empty($get_serial)){

            if(!empty($result_max)){
                $new_sl = $result_max[0]['max_serial']+1;
            }else{
                $new_sl =1;
            }

            if(!empty($chk_exits)){
                $n_module_id=  $chk_exits[0]['id'];
                $n_data['serial']=  $new_sl;
                // echo $n_data['serial']."hello";die();
                $this->db->where('id', $n_module_id);
                $this->db->update('tbl_module', $n_data);
            }

        }





        $arr   = [];
        $items = $this->ModuleModel->getEditPreModuleTemp($clean['id']);
        // echo "<pre>"; print_r($items); die();

        if (count($items)) {
            foreach ($items as $item) {
                $arr[] = [
                    'question_id'    => $item['question_id'],
                    'question_type'  => $item['question_type'],
                    'module_id'      => $clean['id'],
                    'question_order' => $item['question_order'],
                    'created'        => time(),
                ];
            }
            $this->session->unset_userdata('edit_module_info_creadiential');
            // echo "<pre>"; print_r($arr); die();
            $this->db->where('module_id', $clean['id']);
            $this->db->delete('tbl_modulequestion');

            $this->ModuleModel->insert('tbl_modulequestion', $arr);
            $this->session->set_flashdata('module_msg', 'Save Successfully');

            
        }

        $this->db->truncate('tbl_edit_module_temp');
        redirect(base_url() . 'details-module', 'refresh');
    } //end

    public function deleteNewModule($moduleId)
    {
        // echo 11; die();
        $this->db->select('*');
        $this->db->from('tbl_module');
        $this->db->where('id', $moduleId);
        $query_new = $this->db->get();
        $chk_exits = $query_new->result_array();

        $course_id = $chk_exits[0]['course_id'];
        $grade_id = $chk_exits[0]['studentGrade'];
        $moduleType = $chk_exits[0]['moduleType'];
        $user_id = $chk_exits[0]['user_id'];
        $serial = $chk_exits[0]['serial'];

        $this->db->select('*');
        $this->db->from('tbl_module');
        $this->db->where('moduleType', $moduleType);
        $this->db->where('studentGrade', $grade_id);
        $this->db->where('course_id', $course_id);
        $this->db->where('user_id', $this->loggedUserId);
        $this->db->where('serial >', $serial);
        $query_new = $this->db->get();
        $chk_exits = $query_new->result_array();

        $this->ModuleModel->deleteTblNewModule($moduleId);
        $this->ModuleModel->deleteTblNewModuleQuestion($moduleId);

        if(!empty($chk_exits)){
             
            foreach($chk_exits as $result){
               $module_id = $result['id'];
               $new_serial = $result['serial']-1;

               $datas['serial'] = $new_serial;
               $this->db->where('id', $module_id);
               $this->db->update('tbl_module', $datas);

            }

        }

        // echo "<pre>"; print_r($items); die();
        $this->session->set_flashdata('delete_success', "Successfully Deleted !!");
        redirect(base_url() . 'details-module', 'refresh');
    } 

    public function addCourseByModule(){
        $data['courseName'] = $this->input->post('course_name');
        $data['courseCost'] = $this->input->post('course_cost');
        $data['country_id'] = $this->input->post('country_id');
        $data['is_enable'] = 1;
        $data['user_type'] = $this->session->userdata('userType');

        $this->db->select('*');
        $this->db->from('tbl_course');
        $this->db->where('courseName', $data['courseName']);
        $this->db->where('courseCost', $data['courseCost']);
        $this->db->where('country_id', $data['country_id']);
        $this->db->where('is_enable', 1);
        $this->db->where('user_type', $data['user_type']);

        $query = $this->db->get();
        $result = $query->result_array();

        if(empty($result)){
            $this->db->insert('tbl_course', $data);
            $insert_id = $this->db->insert_id();

            $this->db->select('*');
            $this->db->from('tbl_course');
            $this->db->where('id', $insert_id);

            $query = $this->db->get();
            $result = $query->result_array();
            $res['success'] = $result[0]; 
        }else{
            $res['success'] = 1; 
        }

        echo json_encode($res);

    }

    public function save_module_info(){
        $module_info['module_name'] = $this->input->post('module_name');
        $module_info['grade_id'] = $this->input->post('grade_id');
        $module_info['module_type'] = $this->input->post('module_type');
        $module_info['course_id'] = $this->input->post('course_id');
        $module_info['show_student'] = $this->input->post('show_student');
        $module_info['serial'] = $this->input->post('serial');
        $module_info['trackerName'] = $this->input->post('trackerName');
        $module_info['individualName'] = $this->input->post('individualName');
        $module_info['enterDate'] = $this->input->post('enterDate');
        $module_info['isSms'] = $this->input->post('isSms');
        $module_info['isAllStudent'] = $this->input->post('isAllStudent');
        $module_info['video_link_1'] = $this->input->post('video_link_1');
        $module_info['instruct_1'] = $this->input->post('instruct_1');
        $module_info['videoName'] = $this->input->post('videoName');
        $module_info['timeStart'] = $this->input->post('timeStart');
        $module_info['timeEnd'] = $this->input->post('timeEnd');
        $module_info['optTime'] = $this->input->post('optTime');
        $module_info['subject_id'] = $this->input->post('subject_id');
        $module_info['chapter_id'] = $this->input->post('chapter_id');
        
        
        $this->session->set_userdata('module_info_creadiential', $module_info);
    }

    public function edit_module_info(){
        $module_info['module_name'] = $this->input->post('module_name');
        $module_info['grade_id'] = $this->input->post('grade_id');
        $module_info['module_type'] = $this->input->post('module_type');
        $module_info['course_id'] = $this->input->post('course_id');
        $module_info['show_student'] = $this->input->post('show_student');
        $module_info['serial'] = $this->input->post('serial');
        $module_info['module_id'] = $this->input->post('module_id');
        $module_info['trackerName'] = $this->input->post('trackerName');
        $module_info['individualName'] = $this->input->post('individualName');
        $module_info['enterDate'] = $this->input->post('enterDate');
        $module_info['isSms'] = $this->input->post('isSms');
        $module_info['isAllStudent'] = $this->input->post('isAllStudent');
        $module_info['video_link_1'] = $this->input->post('video_link_1');
        $module_info['instruct_1'] = $this->input->post('instruct_1');
        $module_info['videoName'] = $this->input->post('videoName');
        $module_info['timeStart'] = $this->input->post('timeStart');
        $module_info['timeEnd'] = $this->input->post('timeEnd');
        $module_info['optTime'] = $this->input->post('optTime');
        $module_info['subject_id'] = $this->input->post('subject_id');
        $module_info['chapter_id'] = $this->input->post('chapter_id');
        
        $this->session->set_userdata('edit_module_info_creadiential', $module_info);
    }

    public function assign_serial_to_module(){

        $serial = $this->input->post('serial');
        $module_id= $this->input->post('module_id');
        $course_id = $this->input->post('course_id');
        $modType= $this->input->post('modType');
        $grade_id= $this->input->post('grade_id');
        $country_id = $this->session->userdata('selCountry');

        $this->session->unset_userdata('edit_module_info_creadiential');

        $loggedUserId = $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->from('tbl_module');
        $this->db->where('moduleType', $modType);
        $this->db->where('studentGrade', $grade_id);
        $this->db->where('course_id', $course_id);
        $this->db->where('user_id', $loggedUserId);
        $this->db->where('serial', $serial);
        $this->db->where('country', $country_id);
        $query_new = $this->db->get();
        $results = $query_new->result_array();
        // echo "<pre>";print_r($results);die();

        if(!empty($results)){

            $this->db->select('*');
            $this->db->from('tbl_module');
            $this->db->where('id', $module_id);
            $query_new = $this->db->get();
            $swap_results = $query_new->result_array();
            $pre_serial = $swap_results[0]['serial'];

            $found_module_id = $results[0]['id'];

            $data['serial'] = $serial;
            $this->db->where('id', $module_id);
            $this->db->update('tbl_module', $data);

            $data['serial'] = $pre_serial;
            $this->db->where('id', $found_module_id);
            $this->db->update('tbl_module', $data);
        }else{
            $this->db->select('MAX(serial) as max_serial');
            $this->db->from('tbl_module');
            $this->db->where('moduleType', $modType);
            $this->db->where('studentGrade', $grade_id);
            $this->db->where('course_id', $course_id);
            $this->db->where('user_id', $loggedUserId);
            $query_new = $this->db->get();
            $result_max = $query_new->result_array();
            if(!empty($result_max)){
                $new_sl = $result_max[0]['max_serial']+1;
            }else{
                $new_sl =1;
            }

            if(!empty($results)){
                $n_module_id=  $results[0]['id'];
                $n_data['serial']=  $new_sl;

                $this->db->where('id', $n_module_id);
                $this->db->update('tbl_module', $n_data);
            }

        }
        
        echo 1;
    }

    public function update_serial_to_module(){
        $allSerial = $this->input->post('allSerial');
        $moduleIds = $this->input->post('moduleIds');
        $grades = $this->input->post('grades');
        $moduleTypes = $this->input->post('moduleTypes');
        $courseIds = $this->input->post('courseIds');
        
        sort($allSerial);
        // print_r($moduleIds);
        // print_r($allSerial);die();
        
        foreach($moduleIds as $key => $module_id){

            $grade = $grades[$key];
            $module_type = $grades[$key];
            $module_type = $grades[$key];
            $course_id = $courseIds[$key];

            $this->ModuleModel->updateModuleSerial($module_id,$grade,$module_type,$course_id);

            // $data['serial'] = $allSerial[$key];
            // $this->db->where('id', $module_id);
            // $this->db->update('tbl_module', $data);
        }
        echo 1;
    }

    public function addNewSubject(){
        
        $data['subject_name'] = $this->input->post('subject_name');
        $data['created_by'] = $this->session->userdata('user_id');
        
        $this->db->insert('tbl_subject', $data);
        $insert_id = $this->db->insert_id();

        $this->db->select('*');
        $this->db->from('tbl_subject');
        $this->db->where('subject_id', $insert_id);
        $query_new = $this->db->get();
        $subjects = $query_new->result_array();

        echo json_encode($subjects[0]);
        
    }

    public function addNewChapter(){
        $data['chapterName'] = $this->input->post('chapter_name');
        $data['created_by'] = $this->session->userdata('user_id');
        $data['subjectId'] = $this->input->post('subject_id');
        //echo "<pre>";print_r($data);die();
        $this->db->insert('tbl_chapter', $data);
        $insert_id = $this->db->insert_id();

        $this->db->select('*');
        $this->db->from('tbl_chapter');
        $this->db->where('id', $insert_id);
        $query_new = $this->db->get();
        $Chapter = $query_new->result_array();

        echo json_encode($Chapter[0]);
        
    }

    public function deleteSubjectByModule(){
        $subject_id = $this->input->post('subject_id');

        $this->db->where('subject_id', $subject_id);
        $delete = $this->db->delete('tbl_subject');
        if($delete){
           echo 1;
        }else{
            echo 2;
        }

    }

    public function editNewSubject(){
        $data['subject_name'] = $this->input->post('subject_name');
        $subject_id = $this->input->post('subject_id');

        $this->db->where('subject_id', $subject_id);
        $update = $this->db->update('tbl_subject', $data);
        if($update){
          echo 1;
        }else{
          echo 2;
        }
    }

    public function editNewChapter(){
        $data['chapterName'] = $this->input->post('chapter_name');
        $chapter_id = $this->input->post('chapter_id');

        $this->db->where('id', $chapter_id);
        $update = $this->db->update('tbl_chapter', $data);
        if($update){
          echo 1;
        }else{
          echo 2;
        }
    }

    public function deleteChapterByModule(){
        $chapter_id = $this->input->post('chapter_id');

        $this->db->where('id', $chapter_id);
        $delete = $this->db->delete('tbl_chapter');
        if($delete){
           echo 1;
        }else{
            echo 2;
        }

    }

    public function searchModuleByOptions(){
        $module_id = $this->input->post('module_id');
        $country_id = $this->session->userdata('selCountry');
        $user_id = $this->session->userdata('user_id');
        $module_name = $this->input->post('module_name');
        $studentGrade = $this->input->post('studentGrade');
        $module_type = $this->input->post('module_type');
        $course_id = $this->input->post('course_id');
        $start_index = $this->input->post('page_index');
        $start = $start_index*10;

        $this->db->select('count(tbl_module.id) as total_module');
        $this->db->from('tbl_module');
        $this->db->join('tbl_course', 'tbl_module.course_id=tbl_course.id', 'left');
        $this->db->join('tbl_subject', 'tbl_subject.subject_id=tbl_module.subject', 'left');
        $this->db->join('tbl_chapter', 'tbl_chapter.id=tbl_module.chapter', 'left');
        $this->db->where('tbl_module.country',$country_id);
        $this->db->where('tbl_module.user_id',$user_id);
        if(!empty($studentGrade)){
            $this->db->where('studentGrade', $studentGrade);
        }
        if(!empty($module_id)){
            $this->db->where('moduleType', $module_id);
        }
        if(!empty($course_id)){
            $this->db->where('course_id', $course_id);
        }
        if(!empty($module_name)){
            $this->db->like('moduleName', $module_name,'both',false);
        }
        $query_new = $this->db->get();
        $all_module = $query_new->result_array();
        //echo "<pre>";print_r($all_module);die();
        

        $this->load->library('pagination');
        $config = array();
		$config["base_url"] = base_url() . "details-module";
		$config["total_rows"] = $all_module[0]['total_module'];
		
		$config["per_page"] = 10;
		// $config["uri_segment"] = 2;
        $config["use_page_numbers"] = true;
        $config["cur_page"] = $start_index+1;

		$config['full_tag_open'] = '<ul class="module_pg pagination">';        
        $config['full_tag_close'] = '</ul>';        
        $config['first_link'] = 'First';        
        // $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['first_tag_close'] = '</span></li>';        
        $config['prev_link'] = '&laquo';        
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['prev_tag_close'] = '</span></li>';        
        $config['next_link'] = '&raquo';        
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['next_tag_close'] = '</span></li>';        
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['last_tag_close'] = '</span></li>';        
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
        $config['cur_tag_close'] = '</a></li>';        
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
        $config['num_tag_close'] = '</span></li>';
		$this->pagination->initialize($config);
        
		$data["links"] = $this->pagination->create_links();

        
        
        
        
        $this->db->select('*,tbl_module.id as id,tbl_subject.subject_name as subject_name');
        $this->db->from('tbl_module');
        $this->db->join('tbl_course', 'tbl_module.course_id=tbl_course.id', 'left');
        $this->db->join('tbl_subject', 'tbl_subject.subject_id=tbl_module.subject', 'left');
        $this->db->join('tbl_chapter', 'tbl_chapter.id=tbl_module.chapter', 'left');
        $this->db->where('tbl_module.country',$country_id);
        $this->db->where('tbl_module.user_id',$user_id);

        if(!empty($studentGrade)){
            $this->db->where('studentGrade', $studentGrade);
        }
        if(!empty($module_id)){
            $this->db->where('moduleType', $module_id);
        }
        if(!empty($course_id)){
            $this->db->where('course_id', $course_id);
        }
        if(!empty($module_name)){
            $this->db->like('moduleName', $module_name,'both',false);
        }
        $this->db->order_by('moduleType','asc');
        $this->db->order_by('studentGrade','asc');
        $this->db->order_by('course_id','asc');
        $this->db->order_by('serial','asc');
        $this->db->limit(10, $start);
        $query_new = $this->db->get();
        $modules = $query_new->result_array();
        // echo "<pre>"; print_r($modules);die();
        //echo $this->db->last_query();
        
        $data["modules"] = $modules;
        
        echo json_encode($data);

    }

    public function update_serial_module_question_create(){
        $serial = $this->input->post('serial');
        $ids = $this->input->post('ids');
        $question_ids = $this->input->post('question_ids');

        $i=1;
        foreach($question_ids as $question){
            $data['question_order'] = $i;
            $this->db->where('question_id', $question);
            $update = $this->db->update('tbl_pre_module_temp', $data);
            // echo $this->db->last_query();die();
        $i++;
        }
        echo 1;
    }

    public function update_serial_module_question(){
        $serial = $this->input->post('serial');
        $ids = $this->input->post('ids');
        $question_ids = $this->input->post('question_ids');

        $i=1;
        foreach($question_ids as $question){
            $data['question_order'] = $i;
            $this->db->where('question_id', $question);
            $update = $this->db->update('tbl_edit_module_temp', $data);
            // echo $this->db->last_query();die();
        $i++;
        }
        echo 1;
    }

    
}//end class
