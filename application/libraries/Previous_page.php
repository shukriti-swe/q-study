<?php defined('BASEPATH') or exit('No direct script access allowed');

class Previous_page
{

    public $CI;
    public $loggedUserId;
    public $loggedUserType;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->loggedUserId = $this->CI->session->userdata('user_id');
        $this->loggedUserType = $this->CI->session->userdata('userType');
        $this->set_prev_curr_url();
    }

    /*public function set_prev_curr_url()
    {
        $this->CI->load->helper('cookie');
        //$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        $actual_link = base_url().implode('/',$this->CI->uri->segments);

        $status = isset($_SESSION['currUrl'])?1:0;
        if(!$status){
            $this->CI->session->set_userdata('currUrl', $actual_link);
        } else {
            $this->CI->session->set_userdata('prevUrl', $_SESSION['currUrl']);
            $this->CI->session->set_userdata('currUrl', $actual_link);
        }

    }*/

    public function set_prev_curr_url()
    {
        $uriSegments = $this->CI->uri->segment_array();

        /*if(commonArrayElem(['tutor_setting'], $uriSegments)){
            $this->CI->session->set_userdata('prevUrl', base_url().'tutor');
        } else if() {

        }*/
        $uType = $this->loggedUserType;
        $tempArray = [];
        if ($uType==1) { // parent
            $tempArray = [
            'parent_setting'   =>'parents',
            'student_progress' =>'parents',

            'my_details'   => 'parent_setting',
            'upload_photo' => 'parent_setting',
            ];
        } elseif ($uType==2) { // upper level
            $tempArray = [
            'u_level_studen_setting' =>'upper_level',
            'student_progress'       =>'upper_level',

            'u_level_student_details' => 'u_level_studen_setting',
            'u_level_upload_photo'    => 'u_level_studen_setting',
            'u_level_enrollment'      => 'u_level_studen_setting',
            ];
        } elseif ($uType==3) { // tutor
            $tempArray = [
            'tutor_setting'=> 'tutor',

            'tutor_details'=> 'tutor_setting',
            'tutor_upload_photo'=> 'tutor_setting',

            'student_progress' => 'tutor',
            'view_course'      => 'tutor',

            'question-list' => 'tutor/view_course',
            'all-module'    => 'tutor/view_course',

            'create-question'  => 'question-list',
            'question_edit'    => 'question-list',
            'question_preview' => 'question-list',

            'module_preview' => 'all-module',
            'add-module'     => 'all-module',
            'edit-module'    => 'all-module',
            'reorder-module' => 'all-module',

            ];
        } elseif ($uType==4) { //school
            $tempArray = [
            'school_setting'  =>'school',
            'student_progress'=>'school',

            'school_info_details' => 'school_setting',
            'school_logo'         => 'u_level_studen_setting',
            ];
        } elseif ($uType==5) { //corporate
        } elseif ($uType==6) { //student
            $tempArray = [
            'student_setting'     =>'student',
            'student_progress'    =>'student',
            'view_course' =>'student',

            'student_details'      =>'student_setting',
            'student_upload_photo' =>'student_setting',
            'my_enrollment'        =>'student_setting',

            'q_study_course'   =>'student/view_course',
            'tutor_course'     =>'student/view_course',
            'school_course'    =>'student/view_course',
            'corporate_course' =>'student/view_course',

            'all_module_by_type/7' => 'q_study_course',
            'all_module_by_type/3' => 'tutor_course',
            'all_module_by_type/4' => 'school_course',
            'all_module_by_type/5' => 'corporate_course',
            ];
        } elseif ($uType==7) { // q-study
            $tempArray = [
            'tutor_setting'      =>'qstudy',
            'student_progress'   =>'qstudy',
            'view_course'        =>'qstudy',

            'tutor_details'      =>'tutor_setting',
            'tutor_upload_photo' =>'tutor_setting',

            'question-list' =>'qstudy/view_course',
            'all-module'    =>'qstudy/view_course',
            
            'create-question'   =>'question-list',
            'question_edit'     =>'question-list',
            'question_preview' =>'question-list',

            'add-module'     =>'all-module',
            'edit-module'    =>'all-module',
            'module_preview' =>'all-module',
            'reorder-module' =>'all-module',
            ];
        }

        //backMapping = [currentUrl=>previousUrl]
        $backMapping = $tempArray;

        $mapKeys = array_keys($backMapping);
        $checked = array_values(array_intersect($mapKeys, $uriSegments));
        
        if (count($checked)) {
            $temp = $checked[0];
            $temp = isset($backMapping[$temp]) ? $backMapping[$temp] : '#';
            $this->CI->session->set_userdata('prevUrl', base_url().$temp);
        }
    }
}
