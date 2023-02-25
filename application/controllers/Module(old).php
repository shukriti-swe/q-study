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

        $user_id            = $this->session->userdata('user_id');
        $user_type          = $this->session->userdata('userType');
        $this->loggedUserId = $user_id;
        $this->loggedUserType = $user_type;

        if ($user_id == null && $user_type == null) {
            redirect('welcome');
        }

        $this->load->model('Parent_model');
        $this->load->model('tutor_model');
        $this->load->model('Student_model');
        $this->load->model('ModuleModel');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->model('Preview_model');
        $this->load->model('QuestionModel');
        $this->load->helper('commonmethods');

    }//end __construct()


    public function view_course()
    {
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header']     = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $data['maincontent'] = $this->load->view('module/view_course', $data, true);
        $this->load->view('master_dashboard', $data);

    }//end view_course()


    public function all_module()
    {
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header']     = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $user_id = $this->session->userdata('user_id');

        $data['user_info']          = $this->tutor_model->userInfo($user_id);
        $data['all_module']         = $this->tutor_model->getInfo('tbl_module', 'user_id', $user_id);
        $data['all_grade']          = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_module_type']    = $this->tutor_model->getAllInfo('tbl_moduletype');
        $data['all_course']         = $this->tutor_model->getAllInfo('tbl_course');
        $data['allRenderedModType'] = $this->renderAllModuleType();
        $data['all_country']        = $this->renderAllCountry();

        $studentIds          = $this->tutor_model->allStudents(['sct_id' => $user_id]);
        $data['allStudents'] = $this->renderStudentIds($studentIds);

        $data['maincontent'] = $this->load->view('module/all_module', $data, true);
        $this->load->view('master_dashboard', $data);

    }//end all_module()

    
    /**
     * Add module (view part)
     * 
     * @return void
     */
    public function add_module()
    {
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header']     = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
        $user_id            = $this->session->userdata('user_id');

        $data['user_info']         = $this->tutor_model->userInfo($user_id);
        $data['all_module']        = $this->tutor_model->getInfo('tbl_module', 'user_id', $user_id);
        $data['all_module_type']   = $this->tutor_model->getAllInfo('tbl_moduletype');
        $data['all_course']        = $this->tutor_model->getAllInfo('tbl_course');
        $data['all_country']       = $this->renderAllCountry();
        $data['all_subjects']      = $this->renderAllSubject();
        $data['all_chapters']      = $this->renderAllChapter();
        $data['all_module_type']   = $this->renderAllModuleType();
        $data['all_question_type'] = $this->tutor_model->getAllInfo('tbl_questiontype');
        foreach ($data['all_question_type'] as $row) {
            $question_list[$row['id']] = $this->tutor_model->getUserQuestion('tbl_question', $row['id'], $user_id);
        }

        $data['all_question'] = $question_list;
        $studentIds           = $this->tutor_model->allStudents(['sct_id' => $user_id]);
        $data['allStudents']  = $this->renderStudentIds($studentIds);

        $data['maincontent'] = $this->load->view('module/add_module', $data, true);
        $this->load->view('master_dashboard', $data);

    }//end add_module()


    /**
     * Responsible for saving module data.
     * 
     * @return void 
     */
    public function saveModuleQuestion()
    {
        $post                   = $this->input->post();
        $clean                  = $this->security->xss_clean($post);
        $moduleTableData        = [];
        $moduleTableData[] = [
            'moduleName'        => $clean['moduleName'],
            'trackerName'       => $clean['trackerName'],
            'individualName'    => $clean['individualName'],
            'isSMS'             => isset($clean['isSMS']) ? $clean['isSMS'] : 0,
            'isAllStudent'      => isset($clean['isAllStudent']) ? $clean['isAllStudent'] : 0,
            'individualStudent' => isset($clean['individualStudent']) ? json_encode($clean['individualStudent']):'',
            'subject'           => $clean['subject'],
            'chapter'           => $clean['chapter'],
            'country'           => $clean['country'],
            'studentGrade'      => $clean['studentGrade'],
            'moduleType'        => $clean['moduleType'],
            'user_id'           => $this->loggedUserId,
            'user_type'         => $this->loggedUserType,
            'created'           => isset($clean['dateCreated']) ? strtotime($clean['dateCreated']) : time(),
            
        ];
        // Save module info first
        $moduleId = $this->ModuleModel->insert('tbl_module', $moduleTableData);
        
        // If ques order set record those to tbl_modulequestion table
        $arr   = [];
        $items = isset($clean['qId_ordr']) ? array_filter($clean['qId_ordr']) : [];
        if (count($items)) {

            foreach ( $items as $qId_ordr) {
                $temp = explode('_', $qId_ordr);
                $arr[]  = [
                    'question_id'    => $temp[0],
                    'module_id'      => $moduleId,
                    'question_order' => $temp[1],
                    'created'        => time(),
                ];
            }
            $this->ModuleModel->insert('tbl_modulequestion', $arr);
        
        }

       if($moduleId){
            echo 'true'; // Module recorded.
        } else {
            echo 'false'; // Module record failed.
        }
        
        //$this->session->set_flashdata('success_msg', 'Module Saved Successfully.');
        //redirect('all-module');
        

    }//end saveModuleQuestion()

    
    /**
     * This method will duplicate  a module with additional info given
     * @return void 
     */
    public function moduleDuplicate()
    {
        $post   = $this->input->post();
        $newMod = $this->security->xss_clean($post);

        $origModId  = $newMod['origModId'];
        $origMod    = $this->ModuleModel->moduleInfo($origModId);
        $newModName = isset($newMod['moduleName']) ? $newMod['moduleName'] : '';
        if ($newModName == $origMod['moduleName']) {
            if (($origMod['country'] == $newMod['country']) && $origMod['grade'] == $newMod['grade']) {
                echo 'false';
                return 0;
            }
        } else {
            $moduleTableData   = [];
            $moduleTableData[] = [
                'moduleName'        => $newMod['moduleName'],
                'trackerName'       => $origMod['trackerName'],
                'individualName'    => $origMod['individualName'],
                'isSMS'             => isset($newMod['isSMS']) ? $newMod['isSMS'] : 0,
                'isAllStudent'      => isset($newMod['isAllStudent']) ? $newMod['isAllStudent'] : 0,
                'individualStudent' => isset($newMod['individualStudent']) ? json_encode($newMod['individualStudent']) : $origMod['individualStudent'],
                'subject'           => $origMod['subject'],
                'chapter'           => $origMod['chapter'],
                'country'           => $newMod['country'],
                'studentGrade'      => $newMod['studentGrade'],
                'moduleType'        => $newMod['moduleType'],
                'user_id'           => $this->loggedUserId,
                'user_type'         => $this->loggedUserType,
                'created'           => isset($newMod['dateCreated']) ? strtotime($newMod['dateCreated']) : time(),
            ];
            // Save module info first
            $newModuleId = $this->ModuleModel->insert('tbl_module', $moduleTableData);
            $origModQues = $this->ModuleModel->moduleQuestion($origModId);
            $arr         = [];
            if (count($origModQues)) {
                foreach ($origModQues as $ques) {
                    $arr[] = [
                        'question_id'    => $ques['question_id'],
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


    /**
     * Wrap all students name with option tag.
     *
     * @return string Students.
     */
    public function renderStudentIds($studentIds)
    {
        $option = '';
        foreach ($studentIds as $studentId) {
            $stInfo  = $this->Student_model->getInfo('tbl_useraccount', 'id', $studentId);
            $option .= '<option value="'.$studentId.'">'.$stInfo[0]['name'].'</option>';
        }

        return $option;

    }//end renderStudentIds()


    /**
     * Wrap all Countries recorded in DB with option tag.
     *
     * @return string Countries.
     */
    public function renderAllCountry()
    {
        $option    = '';
        $countries = $this->tutor_model->getAllInfo('tbl_country');
        foreach ($countries as $country) {
            $option .= '<option value="'.$country['countryCode'].'">'.$country['countryName'].'</option>';
        }

        return $option;

    }//end renderAllCountry()


    /**
     * Wrap all Subjects with option tag.
     *
     * @return string Users created subjects.
     */
    public function renderAllSubject()
    {
        $option   = '';
        $subjects = $this->tutor_model->getInfo('tbl_subject', 'created_by', $this->loggedUserId);

        foreach ($subjects as $subject) {
            $option .= '<option value="'.$subject['subject_id'].'">'.$subject['subject_name'].'</option>';
        }

        return $option;

    }//end renderAllSubject()


    /**
     * Wrap all chapters with option tag.
     *
     * @return string Users created chapters.
     */
    public function renderAllChapter()
    {
        $option   = '';
        $chapters = $this->tutor_model->getInfo('tbl_chapter', 'created_by', $this->loggedUserId);

        foreach ($chapters as $chapter) {
            $option .= '<option value="'.$chapter['id'].'">'.$chapter['chapterName'].'</option>';
        }

        return $option;

    }//end renderAllChapter()


    /**
     * Wrap all Module types with option tag.
     *
     * @return string All module types recorded in database.
     */
    public function renderAllModuleType()
    {
        $option      = '';
        $moduleTypes = $this->ModuleModel->allModuleType();

        foreach ($moduleTypes as $moduleType) {
            $option .= '<option value="'.$moduleType['id'].'">'.$moduleType['module_type'].'</option>';
        }

        return $option;

    }//end renderAllModuleType()


    public function module_preview($modle_id, $question_order_id)
    {
        
		$data['user_info']       = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['question_info_s'] = $this->tutor_model->getModuleQuestion($modle_id, $question_order_id, null);
        //print_r($data['question_info_s']);die;
        
        $data['total_question']  = $this->tutor_model->getModuleQuestion($modle_id, null, 1);
        $data['page_title']      = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink']      = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header']          = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink']      = $this->load->view('dashboard_template/footerlink', $data, true);
        // print_r($data['question_info_s']);die;
        
        if ($data['question_info_s'][0]['questionType'] == 1) 
		{
            $data['maincontent'] = $this->load->view('module/preview/preview_general', $data, true);
        } 
		else if ($data['question_info_s'][0]['questionType'] == 2) 
		{
            $data['maincontent'] = $this->load->view('module/preview/preview_true_false', $data, true);
        } 
		else if ($data['question_info_s'][0]['questionType'] == 3)
		{
            $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['maincontent']             = $this->load->view('module/preview/preview_vocabulary', $data, true);
        } 
		elseif($data['question_info_s'][0]['question_type']==4)
	   {
		
		   $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
		   $data['maincontent'] = $this->load->view('module/preview/preview_multiple_choice', $data, TRUE);   
	   }
	   elseif($data['question_info_s'][0]['question_type']==5)
	   {
		   $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
		   $data['maincontent'] = $this->load->view('module/preview/preview_multiple_response', $data, TRUE);   
	   } 
		else if($data['question_info_s'][0]['questionType'] == 6){
            //skip quiz
            $quesInfo             = json_decode($data['question_info_s'][0]['questionName']);
            $data['numOfRows']    = isset($quesInfo->numOfRows) ? $quesInfo->numOfRows : 0;
            $data['numOfCols']    = isset($quesInfo->numOfCols) ? $quesInfo->numOfCols : 0;
            $data['questionBody'] = isset($quesInfo->question_body) ? $quesInfo->question_body : '';
            $data['questionId']   = $data['question_info_s'][0]['question_id'];
            $quesAnsItem          = $quesInfo->skp_quiz_box;
            $items                = indexQuesAns($quesAnsItem);
            
            $data['skp_box']      = renderSkpQuizPrevTable($items, $data['numOfRows'], $data['numOfCols']);
            $data['maincontent']  = $this->load->view('module/preview/skip_quiz', $data, true);
        }elseif($data['question_info_s'][0]['question_type']==7){	   
			//echo '11111111111';	die;
		   $data['question_info_left_right'] = json_decode($data['question_info_s'][0]['questionName']); 		 
		   $data['maincontent'] = $this->load->view('module/preview/preview_matching', $data, TRUE);   
	   } else if($data['question_info_s'][0]['questionType'] == 8){
			$quesInfo             = json_decode($data['question_info_s'][0]['questionName']);
            //assignment
            $data['questionBody'] = isset($quesInfo->question_body) ? $quesInfo->question_body : '';
            $items                   = $quesInfo->assignment_tasks;
            $data['totalItems']      = count($items);
            $data['assignment_list'] = renderAssignmentTasks($items);
            $data['maincontent']  = $this->load->view('module/preview/assignment', $data, true);
        }

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

}//end class
