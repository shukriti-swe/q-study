<?php


class Student_Progress extends CI_Controller
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
        $this->load->model('tutor_model');
        $this->load->model('Preview_model');
        $this->load->model('FaqModel');
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
    
    /**
     * View student progress by his/her tutor
     *
     * Based on search params
     * @return void
     */
    public function viewStudentProgress($id ='')
    {
        $data['video_help'] = $this->FaqModel->videoSerialize(14, 'video_helps');
        $data['video_help_serial'] = 14;

        if ($id == 7)
        {
            return redirect('student_progress_step_7');
        }

        $data = $this->commonPart();

        if ($this->loggedUserType==2 || $this->loggedUserType==6) { //upper,lower student will see their progress only
            $data['isStudent'] = $this->loggedUserId;
            $data['studentName'] = $this->Student_model->studentName($this->loggedUserId);
            $data['studentClass'] = $this->Student_model->studentClass($this->loggedUserId);
        }

        // $conditions = array(
            // 'sct_id'=> $this->loggedUserId,
        // );
        
        $sct_id = $this->loggedUserId;
        $country_id = '';
        
        if ($this->loggedUserType == 7) {
            $data['all_country'] = $this->Student_model->getAllInfo('tbl_country');
        }

        $studentIds = $this->Student_model->allStudents($sct_id, $country_id);
        $data['students'] = $this->renderStudents($studentIds);
        // echo $data['students'];die();
        //   $data['moduleTypes'] = $this->renderModuletypes($this->ModuleModel->allModuleType());
        if ($this->loggedUserType != 7)
        {
            $data['moduleTypes']   = $this->renderAllModuleTypeAllUser();
        }else
        {
            $data['moduleTypes']   = $this->renderAllModuleType();
        }
        $data['module_user_type'] = $id;
        $data['maincontent'] = $this->load->view('students/student_progress', $data, true);
        $this->load->view('master_dashboard', $data);
    }
	public function viewTutorStudentProgress()
    {
        $sct_id = $this->loggedUserId;
        $country_id = '';
        $studentIds = $this->Student_model->allStudents($sct_id, $country_id);
        $data['registered_courses'] = $this->Student_model->get_register_courses($studentIds);
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('students/student_progress_step_qstudy', $data, true);
        $this->load->view('master_dashboard', $data);
    }
	public function student_progress_course($course_id)
    {
        $data = $this->commonPart();

        if ($this->loggedUserType==2 || $this->loggedUserType==6) { //upper,lower student will see their progress only
            $data['isStudent'] = $this->loggedUserId;
            $data['studentName'] = $this->Student_model->studentName($this->loggedUserId);
            $data['studentClass'] = $this->Student_model->studentClass($this->loggedUserId);
        }
        $sct_id = $this->loggedUserId;
        $country_id = '';

        if ($this->loggedUserType == 7) {
            $data['all_country'] = $this->Student_model->getAllInfo('tbl_country');
        }

        $studentIds = $this->Student_model->allStudents($sct_id, $country_id);
        $data['students'] = $this->renderStudents($studentIds);
//        $data['moduleTypes'] = $this->renderModuletypes($this->ModuleModel->allModuleType());
        if ($this->loggedUserType != 7)
        {
            $data['moduleTypes']   = $this->renderAllModuleTypeAllUser();
        }else
        {
            $data['moduleTypes']   = $this->renderAllModuleType();
        }
        $data['course_id'] = $course_id;
        $data['has_back_button'] = base_url() . 'student_progress_step_7';
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['maincontent'] = $this->load->view('students/student_progress', $data, true);
        $this->load->view('master_dashboard', $data);
    }
	public function renderAllModuleTypeAllUser($selectedId = -1)
    {
        $option      = '';
        $option     .= '<option value="">--Moduletype--</option>';
        $moduleTypes = $this->ModuleModel->allModuleType(array('condition'=>'module_type !=', 'value'=>'Sliding'));

        foreach ($moduleTypes as $moduleType) {
            $sel     = ($moduleType['id'] == $selectedId) ? 'selected' : '';
            $option .= '<option value="'.$moduleType['id'].'" '.$sel.'>'.$moduleType['module_type'].'</option>';
        }

        return $option;
    }
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
     * wrap students info with option
     * @param  array $studentIds student ids of tutor
     * @return string             wrapped string
     */
    public function renderStudents($studentIds)
    {

        $options='';
        if (count($studentIds)) {
            foreach ($studentIds as $studentId) {
                $student = $this->Student_model->userInfo($studentId);
                $student = $student[0];
                $options .= '<option value="'.$studentId.'">'.$student['name'].'</option>';
            }
        }
        return $options;
    }

    /**
     * wrap module types with option tag
     * @param  array $moduleTypes all module type of a tutor attached with
     * @return string              wrapped string
     */
    public function renderModuletypes($moduleTypes)
    {
        $options = '';
        foreach ($moduleTypes as $moduleType) {
            $options .= '<option value="'.$moduleType['id'].'">'.$moduleType['module_type'].'</option>';
        }
        return $options;
    }

    public function renderStProgress($items)
    {
        $row = '';
        date_default_timezone_set($this->site_user_data['zone_name']);
        $examAttended = count($items);
        $totPercentage = 0;
		$row .='<table class="table table-bordered" id="st_progress_table">';
          $row .='<thead>';
          $row .='<tr>';
          $row .='<th style="width:90px;">Module Name</th>';
          $row .='<th>Module Type</th>';
          $row .='<th style="width:90px;">Answer Date</th>';
          $row .='<th>Answer Time</th>';
          $row .='<th>Time Taken</th>';
          $row .='<th>Original Mark</th>';
          $row .='<th>Student Mark</th>';
          $row .='<th>Percentage</th>';
        if ($this->loggedUserType == 3 || $this->loggedUserType == 7) {
            $row .= '<th>Action</th>';
        }
          $row .='</tr>';
          $row .='</thead>';
          $row .='<tbody id="stProgTableBody">';
        foreach ($items as $item) {
            $v_hours = floor($item['timeTaken'] / 3600);
            $remain_seconds = $item['timeTaken'] - ($v_hours * 3600);
            $v_minutes = floor($remain_seconds / 60);
            $v_seconds = $remain_seconds - $v_minutes * 60;
            $time_hour_minute_sec = $v_hours . " : "  . $v_minutes . " : " . $v_seconds ;
            if ($item['studentMark'] == 0 )
            {
                $percentGained = 0;
            }else
            {
                $percentGained = @(float)($item['studentMark']/$item['originalMark'])*100;
            }
			if ($item['originalMark'] == 0 )
            {
                $percentGained = 0;
            }else
            {
                $percentGained = @(float)($item['studentMark']/$item['originalMark'])*100;
            }
            $percentGained = round($percentGained, 2);
            $totPercentage += $percentGained;
            $row .= '<tr progId="'.$item['id'].'">';
            $row .= '<td>
                        <a href="check_student_copy/'.$item['module'].'/'.$item['student_id'].'/1/'.$item['id'].'">'.$this->ModuleModel->moduleName($item['module']).'</a>
                    </td>';
            $row .= '<td>'.$this->ModuleModel->moduleTypeName($item['moduletype']).'</td>';
            $row .= '<td data-order="'.$item['answerTime'].'">'.date('d M Y', $item['answerTime']).'</td>';
            $row .= '<td>'.date('h:i A', $item['answerTime']).'</td>';
            $row .= '<td>'.$time_hour_minute_sec.'</td>';
            $row .= '<td>'.$item['originalMark'].'</td>';
            $row .= '<td>'.$item['studentMark'].'</td>';
            //$row .= '<td>'.round($item['percentage'], 2).'</td>';
            $row .= '<td>'.$percentGained.'%</td>';
            if ($this->loggedUserType == 3 || $this->loggedUserType == 7) {
                $row .= '<td style="">
                            <i class="fa fa-close" onclick="delete_progress('.$item['id'].')"></i>
							<i class="fa fa-plus addMarks" data-toggle="tooltip" data-placement="top" title="Add Marks"></i>
						</td>';
            }
            $row .= '</tr>';
        }
        $avg = ($examAttended>0) ? round((float)($totPercentage / $examAttended), 2) : 0.0;
        //$row .= '<tr> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td style="background-color:#99D9EA">Total average mark</td> <td style="background-color:#99D9EA">'.$avg.'</td> <td></td></tr>';
        if ($this->loggedUserType == 3 || $this->loggedUserType == 7) {
            $row .= '<tr> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td style="background-color:#99D9EA">Total average mark</td> <td style="background-color:#99D9EA">' . $avg . '%</td> <td></td></tr>';
        }else{
            $row .= '<tr> <td></td> <td></td>  <td></td> <td></td> <td></td> <td style="background-color:#99D9EA">Total average mark</td> <td style="background-color:#99D9EA">' . $avg . '%</td> <td></td></tr>';
        }
		 $row .= '</tbody>';
        $row .= '</table>';
		return strlen($row) ? $row : 'No data found';
    }

    /**
     * till now seems common on all functions
     * @return array essential data/view
     */
    public function commonPart()
    {
        $data['video_help'] = $this->FaqModel->videoSerialize(14, 'video_helps');
        $data['video_help_serial'] = 14;
        
        $user_id = $this->loggedUserId;
        //$data['user_info'] = $this->tutor_model->userInfo($user_id);
        $data['user_info']    = $this->Student_model->userInfo($this->session->userdata('user_id'));
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $data['all_module'] = $this->tutor_model->getInfo('tbl_module', 'user_id', $user_id);
        $data['all_grade'] = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_module_type'] = $this->tutor_model->getAllInfo('tbl_moduletype');
        $data['all_course'] = $this->tutor_model->getAllInfo('tbl_course');

        return $data;
    }

    public function studentByClass()
    {
        /*$post = $this->input->post();
        $class = isset($post['stClass']) ? $post['stClass'] : 0;

        $get_user_info = $this->Parent_model->userInfo($this->loggedUserId);

        if ($get_user_info[0]['user_type'] == 1) { // parent
            $get_all_child =  $this->Parent_model->get_all_child($get_user_info[0]['id'], $class);
            $options = '';
            foreach ($get_all_child as $row) {
                $options .= '<option value="'.$row['id'].'">'. $row['name'] .'</option>';
            }
        }

        if ($get_user_info[0]['user_type'] == 3 || $get_user_info[0]['user_type'] == 4 || $get_user_info[0]['user_type'] == 5) { //3=tutor, 4=school, 5=corporate,
            $studentsByClass = array_column($this->Student_model->studentByClass($class), 'student_id');
            $loggedUserStudents =  $this->Student_model->allStudents(['sct_id'=>$this->loggedUserId]);

            $students = array_intersect($studentsByClass, $loggedUserStudents);
            $options = '';
            foreach ($students as $student) {
                $studentName = $this->Student_model->studentName($student);
                $options .= '<option value="'.$student.'">'. $studentName .'</option>';
            }
        }

        echo $options;*/

        $post = $this->input->post();
        $country_id = $post['country'];
        $sct_id = $this->loggedUserId;
        
        $class = isset($post['stClass']) ? $post['stClass'] : 0;
        $studentsByClass = array_column($this->Student_model->studentByClass($class), 'id');
        
        $loggedUserStudents = $this->Student_model->allStudents($sct_id, $country_id);
//        $loggedUserStudents =  $this->Student_model->allStudents([
//                                                        'sct_id'=>$this->loggedUserId,
//                                                        'country_id' => $country_id
//                                                    ]);
        
        $students = array_intersect($studentsByClass, $loggedUserStudents);
        $options = '';
        foreach ($students as $student) {
            $studentName = $this->Student_model->studentName($student);
            $options .= '<option value="'.$student.'">'. $studentName .'</option>';
        }
        echo $options;
    }

    public function StProgTableData()
    {
        $post = $this->input->post();
        if (isset($post['studentId'])) {
            $conditions['student_id'] = $post['studentId'];
        }if (isset($post['moduleTypeId'])) {
            $conditions['moduletype'] = $post['moduleTypeId'];
        }
        $allProgress=$this->Student_model->studentProgress($conditions);
       
        $data['st_progress'] = $this->renderStProgress($allProgress);
		
        echo $data['st_progress'];
    }
	public function TutorStProgTableDataStd()
    {
        $post = $this->input->post();
        $module_user_type = '';
        $course_id = '';
        if (isset($post['studentId'])) {
            $conditions['student_id'] = $post['studentId'];
        }if (isset($post['moduleTypeId'])) {
            $conditions['moduletype'] = $post['moduleTypeId'];
        }
        if (isset($post['module_user_type'])) {
            $module_user_type = $post['module_user_type'];
        }
        if (isset($post['course_id'])) {
            $course_id = $post['course_id'];
        }
        $allProgress=$this->Student_model->TutorStudentProgressStd($conditions,$module_user_type,$course_id);
        $data['st_progress'] = $this->renderStProgress($allProgress);
        echo $data['st_progress'];
    }
	public function StProgTableDataStd()
    {
        $post = $this->input->post();
        $module_user_type = '';
        $course_id = '';
        if (isset($post['studentId'])) {
            $conditions['student_id'] = $post['studentId'];
        }
        if (isset($post['moduleTypeId'])) {
            $conditions['moduletype'] = $post['moduleTypeId'];
        }
        if (isset($post['module_user_type'])) {
            $module_user_type = $post['module_user_type'];
        }
        if (isset($post['course_id'])) {
            $course_id = $post['course_id'];
        }
        $allProgress=$this->Student_model->studentProgressStd($conditions,$module_user_type,$course_id);

        $data['st_progress'] = $this->renderStProgress($allProgress);
        echo $data['st_progress'];
    }
    
    public function delete_progress()
    {
        $progress_id = $this->input->post('progress_id');
        $this->tutor_model->deleteInfo('tbl_studentprogress', 'id', $progress_id);
        
        $post = $this->input->post();
        if (isset($post['studentId'])) {
            $conditions['student_id'] = $post['studentId'];
        }if (isset($post['moduleTypeId'])) {
            $conditions['moduletype'] = $post['moduleTypeId'];
        }
        $allProgress=$this->Student_model->studentProgress($conditions);
        $data['st_progress'] = $this->renderStProgress($allProgress);
        echo $data['st_progress'];
    }

    public function addMarks()
    {
        $post = $this->input->post();
        $marksToAdd = $post['marksToAdd'];
        $progressId = $post['progressId'];

        $progData = $this->tutor_model->getInfo('tbl_studentprogress', 'id', $progressId);
        $currentMarks = $progData[0]['studentMark'];
        $updatedMarks =  ($currentMarks + $marksToAdd);

        $this->tutor_model->updateInfo('tbl_studentprogress', 'id', $progressId, ['studentMark'=>$updatedMarks]);

        echo '1';
    }
}
