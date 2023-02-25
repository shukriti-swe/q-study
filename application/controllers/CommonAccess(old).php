<?php


class CommonAccess extends CI_Controller{
    public $loggedUserId,$loggedUserType; 
    public function __construct() {
        parent::__construct();
        
        $this->loggedUserId = $this->session->userdata('user_id');
        $this->loggedUserType = $this->session->userdata('userType');

        $this->load->model('Parent_model');
        $this->load->model('tutor_model');
        $this->load->model('Student_model');
        $this->load->model('ModuleModel');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }


    /**
     * view student progress by his/her tutor
     * based on search params
     * @return void
     */
    public function viewStudentProgress()
    {
        $data = $this->commonPart();

        $post = $this->input->post();

        //$this->form_validation->set_rules('studentId', 'Student Id', 'required');
        //$this->form_validation->set_rules('moduleTypeId', 'Module Type', 'required');
        
        $conditions = array( 'sct_id'=> $this->loggedUserId, );

        $studentIds = $this->Student_model->allStudents($conditions);
        
        $data['students'] = $this->renderStudents($studentIds);
        $data['moduleTypes'] = $this->renderModuletypes($this->ModuleModel->allModuleType());

        $data['maincontent'] = $this->load->view('students/student_progress', $data, TRUE);
        $this->load->view('master_dashboard', $data);

    }

    /**
     * wrap students info with option
     * @param  array $studentIds student ids of tutor
     * @return string             wrapped string
     */
    public function renderStudents($studentIds)
    {

        $options='';
        foreach($studentIds as $studentId){
            $student_info = $this->Student_model->userInfo($studentId);
            $student = $student_info[0];
            $options .= '<option value="'.$studentId.'">'.$student['name'].'</option>';
        }
        return $options;
    }

    /**
     * wrap module types with option tag
     * @param  array $moduleTypes all module type of a tutor attached with
     * @return string              wrapped string
     */
    public function renderModuletypes( $moduleTypes )
    {
        $options = '';
        foreach($moduleTypes as $moduleType){
            $options .= '<option value="'.$moduleType['id'].'">'.$moduleType['module_type'].'</option>';
        }
        return $options;
    }

    
    public function renderStProgress( $items )
    {
        $row = '';
        foreach($items as $item){
            $row .= '<tr>';
            $row .= '<td>'.$this->ModuleModel->moduleName($item['module']).'</td>';
            $row .= '<td>'.$this->ModuleModel->moduleTypeName($item['moduletype']).'</td>';
            $row .= '<td>'.date('Y-m-d', $item['answerDate']).'</td>';
            $row .= '<td>'.$item['answerTime'].'</td>';
            $row .= '<td>'.$item['timeTaken'].'</td>';
            $row .= '<td>'.$item['originalMark'].'</td>';
            $row .= '<td>'.$item['studentMark'].'</td>';
            $row .= '<td>'.$item['percentage'].'</td>';
            $row .= '</tr>';
        }
        return $row;
    }

    /**
     * till now seems common on all functions
     * @return array essential data/view
     */
    public function commonPart()
    {
        $user_id = $this->loggedUserId;

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $data['user_info'] = $this->tutor_model->userInfo($user_id);
        $data['all_module'] = $this->tutor_model->getInfo('tbl_module', 'user_id', $user_id);
        $data['all_grade'] = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_module_type'] = $this->tutor_model->getAllInfo('tbl_moduletype');
        $data['all_course'] = $this->tutor_model->getAllInfo('tbl_course');

        return $data;
    }

    public function studentByClass()
    {
        $post = $this->input->post();

        $class = isset($post['stClass']) ? $post['stClass'] : 0; 
        $studentsByClass = array_column($this->Student_model->studentByClass($class), 'student_id');
        $loggedUserStudents =  $this->Student_model->allStudents(['sct_id'=>$this->loggedUserId]);
        
        $students = array_intersect($studentsByClass, $loggedUserStudents); 
        $options = '';
        foreach($students as $student){
            $studentName = $this->Student_model->studentName($student);
            $options .= '<option value="'.$student.'">'. $studentName .'</option>'; 
        }
        echo $options;
    }
    

    public function StProgTableData()
    {
        $post = $this->input->post();
        if(isset($post['studentId'])){
            $conditions['student_id'] = $post['studentId'];
        }if(isset($post['moduleTypeId'])){
            $conditions['moduletype'] = $post['moduleTypeId'];
        }if(isset($post['class'])){
            $conditions['grade'] = $post['class'];
        }
//        print_r($conditions);die;
        $allProgress=$this->Student_model->studentProgress($conditions);
        $data['st_progress'] = $this->renderStProgress($allProgress);
        if(strlen($data['st_progress'])<2){
            $data['st_progress'] =  'No data found';
        }
        echo $data['st_progress'];
    }


}