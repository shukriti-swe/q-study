<?php

class Tutor extends CI_Controller
{

    public $loggedUserId, $loggedUserType;

    public function test()
    {
        $this->load->view('test');
    }
    public function __construct()
    {
        parent::__construct();

        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        $this->loggedUserId = $user_id;
        $this->loggedUserType = $user_type;

        if ($user_id == null && $user_type == null) {
            redirect('welcome');
        }
        
        if ($user_type != 3 && $user_type != 4 && $user_type != 5 && $user_type != 7) {
            redirect('welcome');
        }
        
        $this->load->model('Parent_model');
        $this->load->model('Admin_model');
        $this->load->model('tutor_model');
        $this->load->model('Student_model');
        $this->load->model('ModuleModel');
        $this->load->model('QuestionModel');
        $this->load->model('SettingModel');
        $this->load->model('FaqModel');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function index()
    {
        if ($this->session->userdata('userType') == 3) {
            $data['video_help'] = $this->FaqModel->videoSerialize(18, 'video_helps');
            $data['video_help_serial'] = 18;
        }
        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        
        $data['checkDirectDepositPendingCourse'] = $this->Admin_model->getDirectDepositPendingCourse($this->session->userdata('user_id'));
        $data['checkRegisterCourses'] = $this->Admin_model->getActiveCourse($this->session->userdata('user_id'));
        
        $tbl_setting = $this->db->where('setting_key','days')->get('tbl_setting')->row();
        $duration = $tbl_setting->setting_value;
        $date = date('Y-m-d');
        $d1  = date('Y-m-d', strtotime('-'.$duration.' days', strtotime($date)));
        $trialEndDate = strtotime($d1);
        
        $inactive_user_info = $this->Admin_model->getInfoInactiveUserCheck('tbl_useraccount', 'subscription_type', 'trial',$trialEndDate,$this->session->userdata('user_id'));
        
        $data['inactive_user_check'] = count($inactive_user_info);
        //echo $data['inactive_user_check'];die();
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('tutors/tutors_dashboard', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function tutor_setting()
    {
        $data['video_help'] = $this->FaqModel->videoSerialize(19, 'video_helps');
        $data['video_help_serial'] = 19;

        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        if ($data['user_info'][0]['subscription_type'] =="direct_deposite") {
            if ( $data['user_info'][0]['direct_deposite'] == 0 ) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('tutors/tutor_setting', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function tutor_details()
    {
        $data['user_info'] = $this->tutor_model->userInfo($this->session->userdata('user_id'));

        if ($data['user_info'][0]['subscription_type'] =="direct_deposite") {
            if ( $data['user_info'][0]['direct_deposite'] == 0 ) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        // Newly Added
        $all_subject_tutor =$this->Student_model->getInfo('tbl_registered_course', 'user_id', $this->session->userdata('user_id'));
        $whiteboard = 0;
        foreach ($all_subject_tutor as $key => $value) {
            $course_id = $value['course_id'];
            if ($course_id == 53) {
                $whiteboard = 1;
            }

        }
        $data['whiteboard'] = $whiteboard;
        //echo '<pre>';print_r($data);die;
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('tutors/tutor_details', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    
    public function tutor_bank_details(){
        $data['account_detail'] = $this->db->where('tutor_id',$this->session->userdata('user_id'))->get('tbl_tutor_account_details')->row();
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('tutors/tutor_bank_details', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function bank_details_submit_form(){
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        $data['paypal_details'] = $this->input->post('paypal_details');
        $data['bank_details']   = $this->input->post('bank_details');
        $bank_paypal_details    = $this->input->post('bank_paypal_details');
        $data['default_option'] = isset($bank_paypal_details)?$bank_paypal_details: null;
        $data['tutor_id']       = $this->session->userdata('user_id');
        
        $checkDetails = $this->db->where('tutor_id',$this->session->userdata('user_id'))->get('tbl_tutor_account_details')->row();
        if(isset($checkDetails)){
            $this->db->where('tutor_id',$this->session->userdata('user_id'))->update('tbl_tutor_account_details',$data);
            $this->session->set_flashdata('success_msg', 'User account details updated successfully');
            redirect('tutor_details');
        }else{
            $this->db->insert('tbl_tutor_account_details',$data);
            $this->session->set_flashdata('success_msg', 'User account details insert successfully');
            redirect('tutor_details');
        }
    }

    public function update_tutor_details()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('passconf', 'passconf', 'trim|required|matches[password]');
        if ($this->form_validation->run() == false) {
            echo 0;
        } else {
            $password = md5($this->input->post('password'));
            $data = array(
                'user_pawd' => $password
            );
            $this->tutor_model->updateInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'), $data);
            echo 1;
        }
    }

    public function tutor_upload_photo()
    {
        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        if ($data['user_info'][0]['subscription_type'] =="direct_deposite") {
            if ( $data['user_info'][0]['direct_deposite'] == 0 ) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('tutors/upload', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    /**
     * Tutor can set paypal,credit card info
     *
     * @return void
     */
    public function accountSettings()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        if (!$post) {
            $data['user_info'] = $this->tutor_model->userInfo($this->session->userdata('user_id'));
            $data['payment_accounts'] = isset($data['user_info'][0]['payment_accounts'])?$data['user_info'][0]['payment_accounts'] : null;
            if (strlen($data['payment_accounts'])) {
                $data['accounts'] = json_decode($data['payment_accounts']);
            }
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
            $data['maincontent'] = $this->load->view('tutors/account_settings', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            $dataToUpdate = ['payment_accounts' => json_encode($clean)];
            
        //if additional user info exist then update else insert
            $additionalInfo = $this->tutor_model->getRow('additional_tutor_info', 'tutor_id', $this->loggedUserId);
            if (count($additionalInfo)) {
                $this->tutor_model->updateInfo('additional_tutor_info', 'tutor_id', $this->loggedUserId, $dataToUpdate);
            } else {
                $dataToUpdate['tutor_id'] = $this->loggedUserId;
                $this->tutor_model->insertInfo('additional_tutor_info', $dataToUpdate);
            }
            $this->session->set_flashdata('success_msg', 'Account settings updated');
            redirect('tutor/account/settings');
        }
    }

    private function upload_user_photo_options()
    {
        $config = array();
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|docs';
    // $config['max_width'] = 1080;
    // $config['max_height'] = 640;
    // $config['min_width']  = 150;
    // $config['min_height'] = 150;
        $config['overwrite'] = false;
        return $config;
    }

    public function tutor_file_upload()
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
            $rs['res'] = $this->tutor_model->updateInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'), $data);
            echo 1;
        }
    }

    public function view_course()
    {
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        if($user_type == 3){
          $country_id = $this->tutor_model->getCountryId($user_id);
          $this->session->set_userdata('selCountry', $country_id);
        }

        $data['user_info'] = $this->tutor_model->userInfo($user_id);

        $ck_schl_corporate_exist = $this->tutor_model->ck_schl_corporate_exist($data['user_info'][0]['SCT_link'] );
        if (count($ck_schl_corporate_exist)) {
            $data['ck_schl_corporate_exist'] = $ck_schl_corporate_exist;
        }

        if ($data['user_info'][0]['subscription_type'] =="direct_deposite") {
            if ( $data['user_info'][0]['direct_deposite'] == 0 ) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        if(isset($_SESSION['list_submit']) && $_SESSION['list_submit'] == 1)
        {
            unset($_SESSION['list_submit']);
        }

        $data['video_help'] = $this->FaqModel->videoSerialize(21, 'video_helps');
        $data['video_help_serial'] = 21;

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true); 
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $data['maincontent'] = $this->load->view('tutors/view_course', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function all_module()
    {
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $user_id = $this->session->userdata('user_id');

        $data['user_info'] = $this->tutor_model->userInfo($user_id);

        if ($data['user_info'][0]['subscription_type'] =="direct_deposite") {
            if ( $data['user_info'][0]['direct_deposite'] == 0 ) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $data['all_module'] = $this->tutor_model->getInfo('tbl_module', 'user_id', $user_id);
        $data['all_grade'] = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_module_type'] = $this->tutor_model->getAllInfo('tbl_moduletype');
        $data['all_course'] = $this->tutor_model->getAllInfo('tbl_course');


        $data['maincontent'] = $this->load->view('tutors/module/all_module', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function add_module()
    {
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $user_id = $this->session->userdata('user_id');

        $data['user_info'] = $this->tutor_model->userInfo($user_id);

        if ($data['user_info'][0]['subscription_type'] =="direct_deposite") {
            if ( $data['user_info'][0]['direct_deposite'] == 0 ) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $data['all_module'] = $this->tutor_model->getInfo('tbl_module', 'user_id', $user_id);
        $data['all_module_type'] = $this->tutor_model->getAllInfo('tbl_moduletype');
        $data['all_course'] = $this->tutor_model->getAllInfo('tbl_course');

        $data['all_question_type'] = $this->tutor_model->getAllInfo('tbl_questiontype');
        foreach ($data['all_question_type'] as $row) {
            $question_list[$row['id']] = $this->tutor_model->getUserQuestion('tbl_question', $row['id'], $user_id);
        }
        
        $data['all_question'] = $question_list;

        $data['maincontent'] = $this->load->view('tutors/module/add_module', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function question_listtt()
    {
        //echo "hell9o";die();
        $data['video_help'] = $this->FaqModel->videoSerialize(22, 'video_helps');
        $data['video_help_serial'] = 22;

        $post = $this->input->post();
        $post = array_filter($post);
        $get = $this->input->get();
        $countrySelected = 0;
        $fromQuestionEditPage = 0;

        if (isset($post['list_submit']) && $post['list_submit'] ==1)
        {
            $_SESSION["list_submit"] = 1;
        }
        if(isset($_SESSION["list_submit"])){

        }else{
            unset($_SESSION["modInfo"]);
        }
        //module info in flash data for all question area search param
        //if come from module edit page
        if (isset($get['type']) && ($get['type']=='edit')) {
            $data["edit_has"] = "yes";
            $mId = $get['mId'];
            $currentURL = current_url();

            $url = $currentURL."/?type=edit&mId=".$mId;
            $_SESSION["has_edit"] = $url;
            $module = $this->Admin_model->search('tbl_module', ['id'=>$mId]);
            // print_r($module); die();
            if (count($module)) {
                $this->session->set_flashdata('modInfo', $module[0]);
            }
            $countrySelected = 1;
        } elseif (isset($get['country']) || isset($_SESSION['modInfo']['country']) || isset($_SESSION['selCountry'])) {
            
            //q-study will select country before going question-list/module, in that case need to filter by country
            
            $country = isset($get['country']) ? $get['country'] : (isset($_SESSION['modInfo']['country']) ? $_SESSION['modInfo']['country'] : (isset($_SESSION['selCountry']))?$_SESSION['selCountry']:'');
            $countrySelected = 1;
        }
        elseif (empty($get['type'])) {
            unset ($_SESSION["has_edit"]);
        }

        if (isset($_SESSION['refPage']) && $_SESSION['refPage'] == 'questionEdit') {
            $fromQuestionEditPage = 1;
        }

        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        if ($data['user_info'][0]['subscription_type'] =="direct_deposite") {
            if ( $data['user_info'][0]['direct_deposite'] == 0 ) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $user_id = $this->session->userdata('user_id');
        // added shvou
        $data['tutor_permission_check'] = $this->db->where('id',$user_id)->get('tbl_useraccount')->row();
        
        $data['user_info'] = $this->tutor_model->userInfo($user_id);
        $data['all_module'] = $this->tutor_model->getInfo('tbl_module', 'user_id', $user_id);
        $data['all_grade'] = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_module_type'] = $this->tutor_model->getAllInfo('tbl_moduletype');
        $data['all_question_type'] = $this->tutor_model->getAllInfo('tbl_questiontype');
    
        foreach ($data['all_question_type'] as $questionType) {
            $question_list[$questionType['id']] = [];
        }

        if (count($post) || ($countrySelected) || $fromQuestionEditPage) {
            //if get query string fetch question from query scoped module
            $mId = isset($_GET['mId']) ? $_GET['mId'] : null;
            $module = $this->Admin_model->search('tbl_module', ['id'=>$mId]);

            $moduleName = count($module) ? $module[0]['moduleName'] : (isset($post['moduleName']) ? $post['moduleName'] : '');
            //$country = count($module) ? $module[0]['country'] : (isset($post['country']) ? $post['country'] : (isset($get['country']) ? $get['country'] : ''));
            $country = count($module) ? $module[0]['country'] : (isset($country)?$country:'');
            $grade = isset($post['grade']) ? $post['grade'] : (isset($module[0]['studentGrade'])?$module[0]['studentGrade'] : '');
        
            $moduleType =  count($module) ? $module[0]['moduleType'] : (isset($post['moduleType']) ? $post['moduleType'] : '');
            $subject = isset($post['subject']) ? $post['subject'] :  (isset($module[0]['subject'])?$module[0]['subject'] : '');
            $chapter = isset($post['chapter']) ? $post['chapter'] :  (isset($module[0]['chapter'])?$module[0]['chapter'] : '');
            $course  = isset($post['course']) ? $post['course'] :  (isset($module[0]['course_id'])?$module[0]['course_id'] : '');
            $user_id = $this->loggedUserId;
            if ($post) {
                //save on session for filtering(ques search button click)
                $_SESSION['modInfo'] =  [
                'moduleName' => $moduleName,
                'country' =>    $country,
                'studentGrade' => $grade,
                'moduleType' => $moduleType,
                'subject'    => $subject,
                'chapter'    => $this->get_chapter_name($subject, $chapter),
                'course'    => $course,
                ];
            }
            //if request param for module/country/module_type then fetch module question
            //else fetch question from question table
            if (isset($post['moduleName']) ||  isset($post['moduleType']) || isset($_GET['mId'])) {
                $conditions = [
                'moduleName' => $moduleName,
                'country' =>    $country,
                'studentGrade' =>    $grade,
                'moduleType' => $moduleType,
                'subject'    => $subject,
                'chapter'    => $chapter,
                'course_id'    => $course,
                'user_id' =>    $user_id,
                ];
                $conditions = array_filter($conditions);
                $modules = $this->Admin_model->search('tbl_module', $conditions);
                $moduleIds = count($modules) ? array_column($modules, 'id') : -1;
                $moduleQuestions = $this->Admin_model->whereIn('tbl_modulequestion', 'module_id', $moduleIds);

                $questionIds = count($moduleQuestions) ? array_column($moduleQuestions, 'question_id') : -1;
                $conditions = !empty($grade) ? ['studentgrade'=>$grade] : [];
                $questions = $this->Admin_model->whereIn('tbl_question', 'id', $questionIds, $conditions);
            
                foreach ($questions as $question) {
                    $question_list[$question['questionType']][] = $question;
                }
                foreach ($data['all_question_type'] as $questionType) {
                    if (!($question_list[$questionType['id']])) {
                        $question_list[$questionType['id']] = [];
                    }
                }
            } else {
                //if params come from question edit page
                if (isset($_SESSION['modInfo'])) {
                    $sSub = isset($_SESSION['modInfo']['subject'])?$_SESSION['modInfo']['subject']:'';
                    $pSub = isset($post['subject'])?$post['subject']:'';
                    $sChap = isset($_SESSION['modInfo']['selChapter'])?$_SESSION['modInfo']['selChapter']:'';
                    $pChap = isset($post['chapter'])?$post['chapter']:'';
                    $sGrade = isset($_SESSION['modInfo']['studentGrade'])?$_SESSION['modInfo']['studentGrade']:'';
                    $pGrade = isset($post['grade'])?$post['grade']:'';
                    $sCountry = isset($_SESSION['modInfo']['country'])?$_SESSION['modInfo']['country']:'';
                    $pCountry = isset($post['country'])?$post['country']:'';

                    $subject      = isset($sSub) ? $sSub : (isset($pSub) ? $pSub : '');
                    $chapter      = isset($sChap) ? $sChap : (isset($pChap) ? $pChap : '');
                    $studentgrade = isset($sGrade) ? $sGrade : (isset($pGrade) ? $pGrade : '');
                    $country      = $country;//isset($sCountry) ? $sCountry : (isset($pCountry) ? $pCountry : '');
                } else {
                    $subject      = isset($post['subject']) ? $post['subject'] : '';
                    $chapter      = isset($post['chapter']) ? $post['chapter'] : '';
                    $studentgrade = isset($post['grade']) ? $post['grade'] : '';
                    $country = $country;//isset($post['country']) ? $post['country'] : '';
                }

                $conditions = [
                'subject'      => $subject,
                'chapter'      => $chapter,
                'studentgrade' => $studentgrade,
                'country'      => $country,
                ];
            
                $conditions = array_filter($conditions);
                $conditions['user_id'] = $user_id;
                foreach ($data['all_question_type'] as $questionType) {
                    $conditions['questionType'] = $questionType['id'];
                    $question_list[$questionType['id']] = $this->tutor_model->getUserQuestion('tbl_question', $conditions);
                }
            }
        } else {
            foreach ($data['all_question_type'] as $questionType) {
                $conditions = [
                'user_id' => $user_id,
                'questionType' => $questionType['id'],
                ];
                $question_list[$questionType['id']] = $this->tutor_model->getUserQuestion('tbl_question', $conditions);
            }
        }

 
        $data['all_question'] = $question_list;
        $data['user_id'] = $user_id;

        $data_2 = array();
        $data_3 = array();

        foreach ($data['all_question'] as $key => $value) {
            if (!empty($value)) {
                foreach ($value as $key2 => $value2) {

                    $ck= $this->tutor_model->chk_value($key ,$user_id);
                    
                    foreach ($ck as $key3 => $value3) {
                        if ($value3["id"] == $value2["id"] ) {
                            $var4 = [

                                "order" => $key3,
                                "question_type" =>$key,
                                "id" => $value3["id"]
                            ];

                            array_push($data_2, $var4);
                            
                            
                        }

                    }

                }

                array_push($data_3, $data_2);
                $data_2 = []; 

            }
            
        }


        if (isset($get['type']) && ($get['type']=='edit')) {
            $data["old_ques_order"] = $data_3;
            $data["last_data"] =  $this->tutor_model->last_data($user_id);
        }
        
        $data['subscription_type'] = $_SESSION['subscription_type'];

        $data['allCountry']        = $this->Admin_model->search('tbl_country', [1=>1]);
        $data['all_subject']        = $this->tutor_model->getInfo('tbl_subject', 'created_by', $user_id);
        $data['all_course']        = $this->Admin_model->search('tbl_course', [1=>1]);
        
         // check password added shvou
        $data['checkNullPw'] = $this->db->where("setting_key", "qstudyPassword")->where("setting_type !=", '')->get('tbl_setting')->result_array();

        $data['maincontent'] = $this->load->view('tutors/question/question_list', $data, true);

        $this->load->view('master_dashboard', $data);
    }
    public function question_list($id = "",$param_module_id = "",$module_edit_id = "")
    {
        if($id == 2){

            $this->session->set_userdata('module_status', $id);

            if($module_edit_id == ""){
                $this->session->unset_userdata('module_edit_id');
            }else{
                $this->session->set_userdata('module_edit_id', $module_edit_id);
            }

            if($param_module_id == ""){
                $this->session->unset_userdata('param_module_id');
            }else{
                $this->session->set_userdata('param_module_id', $param_module_id);
            }
        }else{

            if ($id == "") {
                $this->session->unset_userdata('module_status');
            } else {
                $this->session->set_userdata('module_status', $id);
            }

            if($module_edit_id == ""){
                $this->session->unset_userdata('module_edit_id');
            }else{
                $this->session->set_userdata('module_edit_id', $module_edit_id);
            }
            
            if($param_module_id == ""){
                $this->session->unset_userdata('param_module_id');
            }else{
                $this->session->set_userdata('param_module_id', $param_module_id);
            }
        }
            

        $data['video_help'] = $this->FaqModel->videoSerialize(22, 'video_helps');
        $data['video_help_serial'] = 22;

        $post = $this->input->post();
        $post = array_filter($post);
        $get = $this->input->get();
        $countrySelected = 0;
        $fromQuestionEditPage = 0;

        if (isset($post['list_submit']) && $post['list_submit'] == 1) {
            $_SESSION["list_submit"] = 1;
        }
        if (isset($_SESSION["list_submit"])) {
        } else {
            unset($_SESSION["modInfo"]);
        }
        //module info in flash data for all question area search param
        //if come from module edit page
        if (isset($get['type']) && ($get['type'] == 'edit')) {
            $data["edit_has"] = "yes";
            $mId = $get['mId'];
            $currentURL = current_url();

            $url = $currentURL . "/?type=edit&mId=" . $mId;
            $_SESSION["has_edit"] = $url;
            $module = $this->Admin_model->search('tbl_module', ['id' => $mId]);
            // print_r($module); die();
            if (count($module)) {
                $this->session->set_flashdata('modInfo', $module[0]);
            }
            $countrySelected = 1;
        } elseif (isset($get['country']) || isset($_SESSION['modInfo']['country']) || isset($_SESSION['selCountry'])) {

            //q-study will select country before going question-list/module, in that case need to filter by country

            $country = isset($get['country']) ? $get['country'] : (isset($_SESSION['modInfo']['country']) ? $_SESSION['modInfo']['country'] : (isset($_SESSION['selCountry'])) ? $_SESSION['selCountry'] : '');
            $countrySelected = 1;
        } elseif (empty($get['type'])) {
            unset($_SESSION["has_edit"]);
        }

        if (isset($_SESSION['refPage']) && $_SESSION['refPage'] == 'questionEdit') {
            $fromQuestionEditPage = 1;
        }

        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        if ($data['user_info'][0]['subscription_type'] == "direct_deposite") {
            if ($data['user_info'][0]['direct_deposite'] == 0) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $user_id = $this->session->userdata('user_id');
        // added shvou
        $data['tutor_permission_check'] = $this->db->where('id', $user_id)->get('tbl_useraccount')->row();

        $data['user_info'] = $this->tutor_model->userInfo($user_id);
        $data['all_module'] = $this->tutor_model->getInfo('tbl_module', 'user_id', $user_id);
        $data['all_grade'] = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_module_type'] = $this->tutor_model->getAllInfo('tbl_moduletype');
        $data['all_question_type'] = $this->tutor_model->getAllInfo('tbl_questiontype');

        foreach ($data['all_question_type'] as $questionType) { 
            $question_list[$questionType['id']] = [];
        }

        if (count($post) || ($countrySelected) || $fromQuestionEditPage) {
            //if get query string fetch question from query scoped module
            $mId = isset($_GET['mId']) ? $_GET['mId'] : null;
            $module = $this->Admin_model->search('tbl_module', ['id' => $mId]);

            $moduleName = count($module) ? $module[0]['moduleName'] : (isset($post['moduleName']) ? $post['moduleName'] : '');
            //$country = count($module) ? $module[0]['country'] : (isset($post['country']) ? $post['country'] : (isset($get['country']) ? $get['country'] : ''));
            $country = count($module) ? $module[0]['country'] : (isset($country) ? $country : '');
            $grade = isset($post['grade']) ? $post['grade'] : (isset($module[0]['studentGrade']) ? $module[0]['studentGrade'] : '');

            $moduleType =  count($module) ? $module[0]['moduleType'] : (isset($post['moduleType']) ? $post['moduleType'] : '');
            $subject = isset($post['subject']) ? $post['subject'] : (isset($module[0]['subject']) ? $module[0]['subject'] : '');
            $chapter = isset($post['chapter']) ? $post['chapter'] : (isset($module[0]['chapter']) ? $module[0]['chapter'] : '');
            $course  = isset($post['course']) ? $post['course'] : (isset($module[0]['course_id']) ? $module[0]['course_id'] : '');
            $user_id = $this->loggedUserId;
            
            if ($post) {
                //save on session for filtering(ques search button click)
                $_SESSION['modInfo'] =  [
                    'moduleName' => $moduleName,
                    'country' =>    $country,
                    'studentGrade' => $grade,
                    'moduleType' => $moduleType,
                    'subject'    => $subject,
                    'chapter'    => $this->get_chapter_name($subject, $chapter),
                    'course'    => $course,
                ];
            }
            //if request param for module/country/module_type then fetch module question
            //else fetch question from question table
            if (isset($post['moduleName']) ||  isset($post['moduleType']) || isset($_GET['mId'])) {
                $conditions = [
                    'moduleName' => $moduleName,
                    'country' =>    $country,
                    'studentGrade' =>    $grade,
                    'moduleType' => $moduleType,
                    'subject'    => $subject,
                    'chapter'    => $chapter,
                    'course_id'    => $course,
                    'user_id' =>    $user_id,
                ];
                $conditions = array_filter($conditions);
                $modules = $this->Admin_model->search('tbl_module', $conditions);
                $moduleIds = count($modules) ? array_column($modules, 'id') : -1;
                $moduleQuestions = $this->Admin_model->whereIn('tbl_modulequestion', 'module_id', $moduleIds);

                $questionIds = count($moduleQuestions) ? array_column($moduleQuestions, 'question_id') : -1;
                $conditions = !empty($grade) ? ['studentgrade' => $grade] : [];
                $questions = $this->Admin_model->whereIn('tbl_question', 'id', $questionIds, $conditions);

                foreach ($questions as $question) {
                    $question_list[$question['questionType']][] = $question;
                }
                foreach ($data['all_question_type'] as $questionType) {
                    if (!($question_list[$questionType['id']])) {
                        $question_list[$questionType['id']] = [];
                    }
                }
            } else {
                //if params come from question edit page
                if (isset($_SESSION['modInfo'])) {
                    $sSub = isset($_SESSION['modInfo']['subject']) ? $_SESSION['modInfo']['subject'] : '';
                    $pSub = isset($post['subject']) ? $post['subject'] : '';
                    $sChap = isset($_SESSION['modInfo']['selChapter']) ? $_SESSION['modInfo']['selChapter'] : '';
                    $pChap = isset($post['chapter']) ? $post['chapter'] : '';
                    $sGrade = isset($_SESSION['modInfo']['studentGrade']) ? $_SESSION['modInfo']['studentGrade'] : '';
                    $pGrade = isset($post['grade']) ? $post['grade'] : '';
                    $sCountry = isset($_SESSION['modInfo']['country']) ? $_SESSION['modInfo']['country'] : '';
                    $pCountry = isset($post['country']) ? $post['country'] : '';

                    $subject      = isset($sSub) ? $sSub : (isset($pSub) ? $pSub : '');
                    $chapter      = isset($sChap) ? $sChap : (isset($pChap) ? $pChap : '');
                    $studentgrade = isset($sGrade) ? $sGrade : (isset($pGrade) ? $pGrade : '');
                    $country      = $country; //isset($sCountry) ? $sCountry : (isset($pCountry) ? $pCountry : '');
                } else {
                    $subject      = isset($post['subject']) ? $post['subject'] : '';
                    $chapter      = isset($post['chapter']) ? $post['chapter'] : '';
                    $studentgrade = isset($post['grade']) ? $post['grade'] : '';
                    $country = $country; //isset($post['country']) ? $post['country'] : '';
                }

                $conditions = [
                    'subject'      => $subject,
                    'chapter'      => $chapter,
                    'studentgrade' => $studentgrade,
                    'country'      => $country,
                ];

                $conditions = array_filter($conditions);
                $conditions['user_id'] = $user_id;
                foreach ($data['all_question_type'] as $questionType) {
                    $conditions['questionType'] = $questionType['id'];
                    $question_list[$questionType['id']] = $this->tutor_model->getUserQuestion('tbl_question', $conditions);
                }
            }
        } else {
            foreach ($data['all_question_type'] as $questionType) {
                $conditions = [
                    'user_id' => $user_id,
                    'questionType' => $questionType['id'],
                ];
                $question_list[$questionType['id']] = $this->tutor_model->getUserQuestion('tbl_question', $conditions);
            }
        }


        $data['all_question'] = $question_list;
        $data['user_id'] = $user_id;

        $data_2 = array();
        $data_3 = array();

        foreach ($data['all_question'] as $key => $value) {
            if (!empty($value)) {
                foreach ($value as $key2 => $value2) {

                    $ck = $this->tutor_model->chk_value($key, $user_id);

                    foreach ($ck as $key3 => $value3) {
                        if ($value3["id"] == $value2["id"]) {
                            $var4 = [

                                "order" => $key3,
                                "question_type" => $key,
                                "id" => $value3["id"]
                            ];

                            array_push($data_2, $var4);
                        }
                    }
                }

                array_push($data_3, $data_2);
                $data_2 = [];
            }
        }


        if (isset($get['type']) && ($get['type'] == 'edit')) {
            $data["old_ques_order"] = $data_3;
            $data["last_data"] =  $this->tutor_model->last_data($user_id);
        }

        $data['subscription_type'] = $_SESSION['subscription_type'];

        $data['allCountry']        = $this->Admin_model->search('tbl_country', [1 => 1]);
        $data['all_subject']        = $this->tutor_model->getInfo('tbl_subject', 'created_by', $user_id);
        $data['all_course']        = $this->Admin_model->search('tbl_course', [1 => 1]);

        // check password added shvou
        $data['checkNullPw'] = $this->db->where("setting_key", "qstudyPassword")->where("setting_type !=", '')->get('tbl_setting')->result_array();

        $data['maincontent'] = $this->load->view('tutors/question/question_list', $data, true);

        $this->load->view('master_dashboard', $data);
    } 

    public function create_question($item)
    {
        // echo 11; die();

        if ($item==17) {
            $this->db->truncate('idea_save_temp');
        }
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
        $user_id = $this->session->userdata('user_id');
        $data['all_grade'] = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_subject'] = $this->tutor_model->getInfo('tbl_subject', 'created_by', $user_id);
        $data['allCountry'] = $this->Admin_model->search('tbl_country', [1=>1]);
        $datas['all_idea'] = $this->QuestionModel->getIdea();
        $data['question_item'] = $item;
        $question_box = 'tutors/question/question-box';

        // echo "<pre>"; print_r($datas); die();

        if ($item==1) {
            $question_box .='/general';
        } elseif ($item==2) {
            $question_box .='/true-false';
        } elseif ($item==3) {
            $question_box .= '/vocabulary';
        } elseif ($item==4) {
            $question_box .= '/multiple-choice';
        } elseif ($item == 5) {
            $question_box .= '/multiple-response';
        } elseif ($item==6) {
            $question_box .= '/skip_quiz';
        } elseif ($item==7) {
            $question_box .= '/matching';
        } elseif ($item == 8) {
            $this->add_assignment_question();
            //$question_box .= '/assignment';
        } elseif ($item == 9) {
            $question_box .= '/story_write';
        } elseif ($item == 10) {
            $question_box .= '/times_table';
        } elseif ($item == 11) {
            $question_box .= '/algorithm';
        } elseif ($item == 12) {
            $question_box .= '/workout_quiz';
        } elseif ($item == 13) {
            $question_box .= '/matching_workout';
        }
        elseif ($item == 14) {
            $data["for_disable_button"]="1";
            $question_box .= '/tutorial';
        }elseif ($item == 15) {
            $question_box .= '/workout_quiz_two';
        }elseif ($item == 16) {

            $question_box .= '/memorization';
        }elseif ($item == 17) {

            $question_box .= '/creative_quiz';
            

            $this->db->select('*');
            $this->db->from('idea_info');
            $this->db->like('image_title','Image','after');
            $query = $this->db->get();
            $results= $query->result_array();
            $image_count = count($results);
            if(empty($image_count)){
              $data['image_no']= 1;
            }else{
              $datas['image_no']= $image_count+1;
            }
            
        }elseif($item == 18){
            $question_box .= '/sentence_match';
        }elseif($item == 19){
            $question_box .= '/word_memorization';
        }elseif($item == 20){
            $question_box .= '/comprehension';
        }
        elseif($item == 21){
            $question_box .= '/grammer';
        }
        elseif($item == 22){
            $question_box .= '/glossary';
        }
        elseif($item == 23){
            $question_box .= '/image_quiz';
        }


        if ($item != 8) {
            $data['question_box']=$this->load->view($question_box, $datas, true);
            $data['maincontent'] = $this->load->view('tutors/question/create_question', $data, true);
            $this->load->view('master_dashboard', $data);
        }
    }

    public function add_assignment_question()
    {
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
        $user_id = $this->session->userdata('user_id');
        $data['all_grade'] = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_subject'] = $this->tutor_model->getInfo('tbl_subject', 'created_by', $user_id);
        $country = $this->tutor_model->get_country($_SESSION['user_id']);
        $data['country'] = $country[0]['country_id'];

        $data['maincontent'] = $this->load->view('tutors/question/create_assignment_question', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function add_subject_name()
    {
        $data['created_by'] = $this->session->userdata('user_id');
        $data['subject_name'] = $this->input->post('subject_name');

        $this->tutor_model->insertInfo('tbl_subject', $data);

        $all_tutor_subject = $this->tutor_model->getInfo('tbl_subject', 'created_by', $data['created_by']);
        echo '<option value="">Select ...</option>';
        foreach ($all_tutor_subject as $row) {
            echo '<option value="' . $row['subject_id'] . '" onchange="getChapter(' . $row['subject_id'] . ')">' . $row['subject_name'] . '</option>';
        }
    }

    public function get_chapter_name($subject = 0, $selected = 0)
    {
        $subject_id = $subject ? $subject : $this->input->post('subject_id');

        $all_subject_chapter = $this->tutor_model->getInfo('tbl_chapter', 'subjectId', $subject_id);
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

    public function save_question_data()
    {
        $post = $this->input->post();
        // echo "<pre>"; print_r($_POST); die();

        $clean = $this->security->xss_clean($post);
        $clean['media'] = isset($_FILES) ? $_FILES : [];

        $instruction_link = isset($post['question_instruction']) ? $post['question_instruction'] : '';
        $instruction_link = str_replace('</p>', '', $instruction_link);
        $instruction_array = array_filter(explode('<p>', $instruction_link));

        $instruction_new_array = array();
        foreach ($instruction_array as $row) {
            $instruction_new_array[] = strip_tags($row);
        }

        $video_link = isset($post['question_video']) ? $post['question_video'] : '';
        $video_link = str_replace('</p>', '', $video_link);
        $video_array = array_filter(explode('<p>', $video_link));

        $video_new_array = array();
        foreach ($video_array as $row) {
            $video_new_array[] = strip_tags($row);
        }

        $data['questionType'] = $this->input->post('questionType');
        $questionName = $this->input->post('questionName');
        $answer = $this->input->post('answer');
        $questionMarks = $this->input->post('questionMarks');
        $description = $this->input->post('questionDescription');
        $solution = $this->input->post('question_solution');
      
        if ($data['questionType'] == 3) {
            $questionName =  $this->processVocabulary($post);
        }
        if ($_POST['questionType'] == 4) {

            if (isset($_POST['question_tutorial_input']) && !empty($_POST['question_tutorial_input'])) {
                $img_multipleChoose = array();
                $question_tutorial_input = $_POST['question_tutorial_input'];

                $img_files = explode(",", $question_tutorial_input);

                for ($i = 0; $i < count($img_files); $i++) {
                    foreach ($img_files as $key => $value) {
                        if (strpos($img_files[$i], "IMG_" . ($key + 1) . ".")) {
                            $img_multipleChoose[] = $value;
                        }
                    }
                }
            }

            // $_POST['questionName'] = !empty($_POST['questionName_2']) ? $_POST['questionName_2'] : $_POST['questionName'];
            // add New AS
            if (isset($_POST['questionName_1_checkbox']) && isset($_POST['questionName_2_checkbox'])) {
                $_POST['questionName'] = $_POST['questionName'];
            } else {
                $_POST['questionName'] = !empty($_POST['questionName_2']) ? $_POST['questionName_2'] : $_POST['questionName'];
            }
            $questionName = $this->save_multiple_choice($_POST);
            $data['question_name_type'] = $this->input->post('question_name_type');
            if (isset($_POST['questionName_1_checkbox']) && isset($_POST['questionName_2_checkbox'])) {

                $data['question_name_type'] = 2;
            }
            $answer = json_encode($_POST['response_answer']);
            // $answer = $_POST['response_answer'];


        }
        if ($_POST['questionType'] == 5) {
            //Same as Multiple Choice
            $questionName = $this->save_multiple_response($_POST);
            if (isset($_POST['response_answer'])) {
                $answer = json_encode($_POST['response_answer']);
            }
        }
        if ($data['questionType'] == 6) { //skip quiz
            $temp['question_body'] = isset($clean['question_body']) ? $clean['question_body'] : '';
            $temp['skp_quiz_box'] = $clean['ques_ans'];
            $temp['numOfRows']     = isset($clean['numOfRows']) ? $clean['numOfRows'] : 0;
            $temp['numOfCols']     = isset($clean['numOfCols']) ? $clean['numOfCols'] : 0;
            $questionName =  json_encode($temp);
            $answer = json_encode(array_values(array_filter($clean['ans'])));
        }
        if ($_POST['questionType'] == 7) {
            $questionName = $this->ques_matching_data($_POST);
            $answer = $this->ans_matching_data($_POST);
        }
        if ($data['questionType'] == 8) {
            // assignment
            $temp          = $this->processAssignmentTasks($clean);
            $questionName  = json_encode($temp);
            $questionMarks = isset($temp['totMarks']) ? $temp['totMarks'] : 0;
        }
        if ($_POST['questionType'] == 9) {

            if (!empty($post['rightTitle']) && !empty($post['rightIntro']) && !empty($post['lastpictureSelected']) && !empty($post['Paragraph']) && !empty($post['rightConclution']) && !empty($post['wrongTitles']) && !empty($post['wrongTitlesIncrement']) && !empty($post['pictureList'])  && !empty($post['wrongIntro']) && !empty($post['wrongIntroIncrement']) &&  !empty($post['wrongConclution']) && !empty($post['wrongConclutionIncrement']) && !empty($post['wrongPictureIncrement'])) {

                $question['rightTitle'] = $post['rightTitle'];
                $question['rightIntro'] = $post['rightIntro'];
                $question['lastpictureSelected'] = $post['lastpictureSelected'];
                $question['Paragraph']  = $post['Paragraph'];
                $question['rightConclution'] = $post['rightConclution'];

                $answer = json_encode($question);
                $question['wrongTitles'] = $post['wrongTitles'];
                $question['wrongTitlesIncrement'] = $post['wrongTitlesIncrement'];
                $question['wrongPictureIncrement'] = $post['wrongPictureIncrement'];
                $question['wrongConclutionIncrement'] = $post['wrongConclutionIncrement'];
                $question['wrongIntro'] = $post['wrongIntro'];
                $question['wrongIntroIncrement'] = $post['wrongIntroIncrement'];
                $question['wrongConclution'] = $post['wrongConclution'];
                $question['wrongParagraphIncrement'] = $post['wrongParagraphIncrement'];

                if (isset($_POST['pictureList'])) {
                    foreach ($_POST['pictureList'] as $key => $value) {
                        if ($value != "" && $post['lastpictureSelected'] != $value) {
                            $pictureList[] = $value;
                        }
                    }
                }

                if (isset($pictureList)) {
                    $question['pictureList'] = $pictureList;
                    $questionName = json_encode($question);
                } else {
                    $data['errorStoryWrite'] = "Check All the Question Properly";
                }
            } else {
                $data['errorStoryWrite'] = "Check All the Question Properly";
            }
        }
        if ($data['questionType'] == 10) {
            $question_data['questionName'] = $post['questionName'];
            $question_data['factor1'] = $post['factor1'];
            $question_data['factor2'] = $post['factor2'];
            $questionName = json_encode($question_data);

            $answer = json_encode($post['result']);
        }
        if ($data['questionType'] == 11) {
            $question_data['questionName'] = $post['question_body'];
            $question_data['operator'] = $post['operator'];

            if ($post['operator'] == '/') {
                $question_data['divisor'] = $post['divisor'];
                $question_data['dividend'] = $post['dividend'];
                $question_data['remainder'] = $post['remainder'];
                $question_data['quotient'] = $post['quotient'];

                $answer = json_encode($post['remainder']);
            }
            if ($post['operator'] != '/') {
                $question_data['item'] = $post['item'];
                $answer = json_encode($post['result']);
            }

            $question_data['numOfRows']     = isset($clean['numOfRows']) ? $clean['numOfRows'] : 0;
            $question_data['numOfCols']     = isset($clean['numOfCols']) ? $clean['numOfCols'] : 0;

            $questionName = json_encode($question_data);
        }
        if ($_POST['questionType'] == 13) {
            $questionName = $this->save_multiple_choice($_POST);
            if (isset($_POST['response_answer'])) {
                $answer = $_POST['response_answer'];
            }
        }
        if ($_POST['questionType'] == 15) {
            $solution = $this->input->post('solution');
            $questionName = $this->save_workout_two($_POST);
            if (isset($_POST['answer'])) {
                $answer = $_POST['answer'];
            }
        }
        if ($_POST['questionType'] == 16) {
            $questionName = $this->save_memorization($_POST);
            if (isset($_POST['answer'])) {
                $answer = $_POST['answer'];
            } else {
                $answer = '';
            }
        }
        if ($_POST['questionType'] == 17) {

            $questionName = 'Idea';
            $answer = 'NO';
            $questionMarks = 0;
            $description = '';
            $instruction_new_array = '';
            $video_new_array = '';
            $solution = 'Nothing';
        }
        if ($_POST['questionType'] == 18) {

            $answers = $_POST['answer'];

            if (!empty($answers)) {
                $questions = array();
                $ans = array();

                foreach ($answers as $answer) {
                    $ans_with_ques = explode(",,", $answer);
                    $questions[] = $ans_with_ques[0];
                    $ans[] = $ans_with_ques[1];
                }
            }

            $questionName = json_encode($questions);
            $answer = json_encode($ans);
            $questionMarks = 15;
            $description = '';
            $instruction_new_array = '';
            $video_new_array = '';
            $solution = 'Nothing';
        }
        if ($_POST['questionType'] == 19) {
            $answers = $_POST['answer'];

            if (!empty($answers)) {
                $questions = array();
                $ans = array();


                foreach ($answers as $answer) {
                    $ans_with_ques = explode(",,", $answer);
                    $questions[] = $ans_with_ques[0];
                    $ans[] = $ans_with_ques[1];
                }
            }
            $mydata['questions'] = $questions;
            $mydata['wrong_questions'] = $post['wrong_question'];
            // print_r($mydata);die();
            $questionName = json_encode($mydata);
            $answer = json_encode($ans);
            $questionMarks = 15;
            $description = '';
            $instruction_new_array = '';
            $video_new_array = '';
            $solution = 'Nothing';
        }

        if ($_POST['questionType'] == 20) {
            
            $check_write =1;
            foreach($_POST['options'] as $option){
               if(!empty($option)){
                $check_write =2;
               }
            }

            if($check_write==2){
               $answer = $post['option_check'][0];
            }else{
               $answer = "write";
               $questionMarks = 0;

            }
            if(!empty($post['com_question'])){
                $questionName = $post['com_question'];
            }else{
                $questionName = "";
            }
            
            $com_data = array();
            $com_data['options'] = $post['options'];
            $com_data['first_hint'] = $post['first_hint'];
            $com_data['total_rows'] = $post['total_rows'];
            $com_data['title_colors'] = $post['title_colors'];
            $com_data['second_hint'] = $post['second_hint'];
            $com_data['writing_input'] = $post['writing_input'];
            $com_data['text_one_hint'] = $post['text_one_hint'];
            $com_data['text_two_hint'] = $post['text_two_hint'];
            $com_data['com_hint_type'] = $post['com_hint_type'];
            $com_data['image_ques_body'] = $post['image_ques_body'];
            $com_data['option_hint_set'] = $post['option_hint_set'];
            $com_data['text_one_hint_no'] = $post['text_one_hint_no'];
            $com_data['text_two_hint_no'] = $post['text_two_hint_no'];
            $com_data['note_description'] = $post['note_description'];
            $com_data['text_one_hint_color'] = $post['text_one_hint_color'];
            $com_data['text_two_hint_color'] = $post['text_two_hint_color'];
            $com_data['question_title_description'] = $post['question_title_description'];

            $description = json_encode($com_data); 
        }

        if ($_POST['questionType'] == 21) {

            $answer = $post['option_check'][0];

            if(!empty($post['com_question'])){
                $questionName = $post['com_question'];
            }else{
                $questionName = "";
            }

            $grammer_data = array();
            $grammer_data['options'] = $post['options'];
            $grammer_data['hint_text'] = $post['hint_text'];
            $grammer_data['total_rows'] = $post['total_rows'];
            $grammer_data['second_hint'] = $post['second_hint'];
            $grammer_data['writing_input'] = $post['writing_input'];
            $grammer_data['first_hint'] = $post['first_hint'];
            $grammer_data['second_hint'] = $post['second_hint'];
            $grammer_data['third_hint'] = $post['third_hint'];
            $grammer_data['four_hint'] = $post['four_hint'];
            $grammer_data['color_serial'] = $post['color_serial'];
            $grammer_data['note_description'] = $post['note_description'];
            $grammer_data['text_one_hint_color'] = $post['text_one_hint_color'];
            $grammer_data['text_two_hint_color'] = $post['text_two_hint_color'];
            $grammer_data['text_four_hint_color'] = $post['text_four_hint_color'];
            $grammer_data['text_three_hint_color'] = $post['text_three_hint_color'];
            $grammer_data['question_title_description'] = $post['question_title_description'];

            $description = json_encode($grammer_data);

        }
        if ($_POST['questionType'] == 22) {
            $glossary_data['title_color'] = $post['title_color'];
            $glossary_data['question_title_description'] = $post['question_title_description'];
            $glossary_data['image_ques_body'] = $post['image_ques_body'];

            $questionName = 'no';
            $answer= 'no';
            $questionMarks = 0;
            $description = json_encode($glossary_data);
        }

        if ($_POST['questionType'] == 23) {
            
            $check_write =1;
            foreach($_POST['options'] as $option){
               if(!empty($option)){
                $check_write =2;
               }
            }

            if($check_write==2){
               $answer = $post['answer'];
            }else{
               $answer = "write";
               $questionMarks = 0;

            }
            // if(!empty($post['com_question'])){
            //     $questionName = $post['com_question'];
            // }else{
            //     $questionName = "";
            // }

            $image_data['help_check_one'] = $post['help_check_one'];
            $image_data['help_check_two'] = $post['help_check_two'];
            $image_data['help_check_three'] = $post['help_check_three'];
            $image_data['image_type_one'] = $post['image_type_one'];
            $image_data['image_type_two'] = $post['image_type_two'];
            $image_data['image_type_three'] = $post['image_type_three'];

            $image_data['box_one_image'] = $post['box_one_image'];
            $image_data['box_two_image'] = $post['box_two_image'];
            $image_data['box_three_image'] = $post['box_three_image'];

            $image_data['hint_one_image'] = $post['hint_one_image'];
            $image_data['hint_two_image'] = $post['hint_two_image'];
            $image_data['hint_three_image'] = $post['hint_three_image'];

            $image_data['help_check_one'] = $post['help_check_one'];
            $image_data['help_check_two'] = $post['help_check_two'];
            $image_data['help_check_three'] = $post['help_check_three'];
            $image_data['question'] = $post['question'];

            $image_data['total_rows'] = $post['total_rows'];
            $image_data['options'] = $post['options'];
            $image_data['quiz_explaination'] = $post['quiz_explaination'];
            
            $questionName = $post['quiz_question'];
            $description = json_encode($image_data);
        }


        $data['studentgrade'] = $this->input->post('studentgrade');
        $data['user_id'] = $this->session->userdata('user_id');
        $data['subject'] = $this->input->post('subject');
        $data['chapter'] = $this->input->post('chapter');
        $data['country'] = $this->input->post('country');
        $data['questionName'] = $questionName;
        $data['answer'] = $answer;
        $data['questionMarks'] = $questionMarks;
        $data['questionDescription'] =  $description;
        if ($_POST['questionType'] == 18) {
            $data['question_instruction'] = $post['question_instruct'];
        } else {
            $data['question_instruction'] = json_encode($instruction_new_array);
        }
        $data['question_video'] = json_encode($video_new_array);
        $data['isCalculator'] = $this->input->post('isCalculator');
        $data['question_solution'] = strlen($solution) < 1 ? 'NO solution given' : $solution;

        $hour   = isset($_POST['question_time']) ? $this->input->post('hour') : "HH";
        $minute = isset($_POST['question_time']) ? $this->input->post('minute') : "MM";
        $second = isset($_POST['question_time']) ? $this->input->post('second') : "SS";

        
        if ($data['questionType'] == 14) {
            $data["question_solution"] = "NO solution given";
            $data['answer'] = "c";
            $data['questionName'] = $this->processTutorial($post);
            $data["last_id"] = "102";
        }

        $data['questionTime'] = $hour . ":" . $minute . ":" . $second;

        // echo 11; die();
        // echo "<pre>"; print_r($_POST['questionType']); die();

        $chkValidation['flag'] = 1;
        if ($data['questionType'] != 8) {
            // echo 11; die();
            $chkValidation = $this->checkValidation($data);
        }
        // echo 22; die();

        if ($chkValidation['flag'] == 0) {
            // echo 44; die();
            echo json_encode($chkValidation);
        } else {
            // echo 33; die();

            $array_one = array();
            $array_two = array();
            $array_three = array();
        
            

            if (!empty($data["last_id"])) {
                $data['questionMarks'] = "0";
                // 
                $questionId = $this->tutor_model->insertId('tbl_question', $data);

                $last_id = $this->tutor_model->last_id($data['user_id']);


                foreach (json_decode($data['questionName']) as $key => $value) {
                    if (!empty($value->speech_to_text)) {
                        $var = [

                            "speech_to_text" => $value->speech_to_text

                        ];

                        array_push($array_one, $var);
                    }
                }

                foreach (json_decode($data['questionName']) as $key => $value) {
                    if (!empty($value->image)) {
                        $var = [

                            "image" => $value->image

                        ];
                        array_push($array_two, $var);
                    }
                }

                foreach (json_decode($data['questionName']) as $key => $value) {
                    if (!empty($value->Audio)) {
                        $var = [

                            "Audio" => $value->Audio

                        ];
                        array_push($array_three, $var);
                    }
                }

                $a = count($array_one);


                for ($i = 0; $i < $a; $i++) {

                    $this->db->query('INSERT INTO `for_tutorial_tbl_question`(`speech`, `img`, `audio`, `tbl_ques_id` ,`orders` ) VALUES ("' . $array_one[$i]["speech_to_text"] . '", "' . $array_two[$i]["image"] . '" ,  "' . $array_three[$i]["Audio"] . '", ' . $last_id[0]["id"] . ', ' . $i . ' )');
                }
            } else {
                // echo "<pre>";print_r($post);die();
                $questionId = $this->tutor_model->insertId('tbl_question', $data);

                if ($data['questionType'] == 17) {
                    
                    if(!empty($post['duplicate_question_id'])){
                        $duplicate_question_id = $post['duplicate_question_id'];

                        $this->db->select('*');
                        $this->db->from('idea_info');
                        $this->db->where('question_id', $duplicate_question_id);
                        $query = $this->db->get();
                        $results = $query->result_array();

                        $this->db->select('*');
                        $this->db->from('idea_info');
                        $this->db->where('parent_question_id', $duplicate_question_id);
                        $query = $this->db->get();
                        $results2 = $query->result_array();

                        // if(empty($results2)){
                            $data_idea = $results[0];
                            $data_idea['id'] = '';
                            $data_idea['question_id'] = $questionId;
                            $data_idea['duplicate_question'] = 2;
                            $data_idea['parent_question_id'] = $duplicate_question_id;

                            $this->tutor_model->insertId('idea_info', $data_idea);
                            // echo "<pre>";print_r($data_idea);die();
 
                            $data_i['question_id'] = $duplicate_question_id;
                            $data_i['tutor_question_id'] = $questionId;
                            $data_i['user_id'] = $this->session->userdata('user_id');
                            $data_i['type'] = 1;
                            $data_i['idea_ans'] = $post['idea_main_body'];
                            $data_i['idea_title'] = $post['duplicate_title_idea'];
                            $data_i['idea_question_title'] = $post['idea_question_title_image'];
                            $data_i['total_word'] = 1;
                            $data_i['idea_publish'] = 0;
                            $data_i['approval'] = 0;
                            $data_i['submit_date'] = date("Y/m/d");
                            $this->tutor_model->insertId('question_ideas', $data_i);
                        // }else{
                        //     $chkValidation['chk_duplicate'] = 1;
                        // }


                    }else{

                        if (isset($post['short_question_allow'])) {
                            $short_question_allow = $post['short_question_allow'];
                        } else {
                            $short_question_allow = '';
                        }
                        if (isset($post['shot_question_title'])) {
                            $shot_question_title = $post['shot_question_title'];
                        } else {
                            $shot_question_title = '';
                        }
                        if (isset($post['short_ques_body'])) {
                            $short_ques_body = $post['short_ques_body'];
                        } else {
                            $short_ques_body = '';
                        }
                        if (isset($post['image_ques_body'])) {
                            $image_ques_body = $post['image_ques_body'];
                        } else {
                            $image_ques_body = '';
                        }
                        if (isset($post['large_question_allow'])) {
                            $large_question_allow = $post['large_question_allow'];
                        } else {
                            $large_question_allow = '';
                        }
                        if (isset($post['large_question_title'])) {
                            $large_question_title = $post['large_question_title'];
                        } else {
                            $large_question_title = '';
                        }
                        if (isset($post['large_ques_body'])) {
                            $large_ques_body = $post['large_ques_body'];
                        } else {
                            $large_ques_body = '';
                        }
                        if (isset($post['student_title'])) {
                            $student_title = $post['student_title'];
                        } else {
                            $student_title = '';
                        }
                        if (isset($post['word_limit'])) {
                            $word_limit = $post['word_limit'];
                        } else {
                            $word_limit = '';
                        }
                        if (isset($post['time_hour'])) {
                            $time_hour = $post['time_hour'];
                        } else {
                            $time_hour = '';
                        }
                        if (isset($post['time_min'])) {
                            $time_min = $post['time_min'];
                        } else {
                            $time_min = '';
                        }
                        if (isset($post['time_sec'])) {
                            $time_sec = $post['time_sec'];
                        } else {
                            $time_sec = '';
                        }
                        if (isset($post['allow_idea'])) {
                            $allow_idea = $post['allow_idea'];
                        } else {
                            $allow_idea = '';
                        }
                        if (isset($post['add_start_button'])) {
                            $add_start_button = $post['add_start_button'];
                        } else {
                            $add_start_button = '';
                        }

                        $uType = $this->session->userdata('userType');
                        // if ($uType == 3) {
                        //     $data_idea['allows_online'] = 2;
                        // } else {
                            $data_idea['allows_online'] = 1;
                        // }

                        $data_idea['short_question_allow'] = $short_question_allow;
                        $data_idea['shot_question_title'] = $shot_question_title;
                        $data_idea['short_ques_body'] = $short_ques_body;
                        $data_idea['image_ques_body'] = $image_ques_body;
                        $data_idea['large_question_allow'] = $large_question_allow;
                        $data_idea['large_question_title'] = $large_question_title;
                        $data_idea['large_ques_body'] = $large_ques_body;
                        $data_idea['student_title'] = $student_title;
                        $data_idea['word_limit'] = $word_limit;
                        $data_idea['time_hour'] = $time_hour;
                        $data_idea['time_min'] = $time_min;
                        $data_idea['time_sec'] = $time_sec;
                        $data_idea['allow_idea'] = $allow_idea;
                        $data_idea['add_start_button'] = $add_start_button;
                        $data_idea['question_id'] = $questionId;
                        $data_idea['duplicate_question'] = 1;

                        if (!empty($image_ques_body)) {
                            $this->db->select('*');
                            $this->db->from('idea_info');
                            $this->db->like('image_title', 'Image', 'after');
                            $query = $this->db->get();
                            $results = $query->result_array();
                            $image_count = count($results);
                            $image_count = $image_count + 1;
                            $data_idea['image_title'] = 'Image ' . $image_count;
                            $data_idea['image_no'] = $image_count;
                        }

                        $idea_id = $this->tutor_model->ideainsertId('idea_info', $data_idea);


                        $datas[] = isset($post['question_instruction']) ? $post['question_instruction'] : '';

                        $idea_description = $post['idea_details'];
                        $idea_description = $this->tutor_model->get_question_new_ideas($this->session->userdata('user_id'));
                        //echo "<pre>";print_r($idea_description);die();
                        
                        foreach ($idea_description as $key => $value) {

                            $tutor_idea['question_id'] = $questionId;
                            $tutor_idea['tutor_question_id'] = $questionId;
                            $tutor_idea['user_id'] = $this->session->userdata('user_id');
                            $tutor_idea['type'] = 1;
                            $tutor_idea['idea_ans'] = $value['question_description'];
                            $tutor_idea['idea_title'] = $value['idea_title'];
                            $tutor_idea['idea_question_title'] = $shot_question_title;
                            $tutor_idea['total_word'] = $value['total_word'];
                            $tutor_idea['idea_publish'] = 0;
                            $tutor_idea['approval'] = 0;
                            $tutor_idea['submit_date'] = date("Y/m/d");

                            $this->tutor_model->insertId('question_ideas', $tutor_idea);


                            // $idea = explode(",,,", $value);
                            // //    print_r($idea);


                            // $idea_des['question_id'] = $questionId;
                            // $idea_des['idea_id'] = $idea_id;
                            // $idea_des['idea_no'] = $idea[0];
                            // $idea_des['idea_name'] = "Idea" . $idea[0];
                            // $idea_des['idea_title'] = $idea[1];
                            // $idea_des['idea_question'] = $idea[2];


                            // $idea_des_id = $this->tutor_model->idea_des_Id('idea_description', $idea_des);

                            // $qstudy_idea['question_id'] = $questionId;
                            // $qstudy_idea['idea_id'] = $idea_id;
                            // $qstudy_idea['tutor_id'] = $this->session->userdata('user_id');
                            // $qstudy_idea['idea_no'] = $idea[0];
                            // $qstudy_idea['student_ans'] = $idea[2];
                            // $qstudy_idea['submit_date'] = date('Y/m/d');
                            // $qstudy_idea['total_word'] = $idea[2];
                            // $tutor_idea_save = $this->tutor_model->tutor_idea_save('idea_tutor_ans', $qstudy_idea);

                        }
                    }
                        $this->db->truncate('idea_save_temp');
                }
            }

            $module_status = $this->session->userdata('module_status');
            $module_edit_id = $this->session->userdata('module_edit_id');
            $param_module_id = $this->session->userdata('param_module_id');

            // echo $module_status; die();
            if ($module_status==1) {
                if(!empty($module_edit_id)){
                    $module_update['question_id'] = $questionId;
                    $module_update['question_type'] = $_POST['questionType'];
                    
                    $this->db->where('id', $module_edit_id);
                    $this->db->update('tbl_pre_module_temp', $module_update);

                }else{
                    $this->db->select('*');
                    $this->db->from('tbl_pre_module_temp');
                    $query_result = $this->db->get();
                    $results = $query_result->result_array();
                    $question_no = count($results);
                    $question_order = $question_no+1;
                    $module_insert['question_id'] = $questionId;
                    $module_insert['question_type'] = $_POST['questionType'];
                    $module_insert['question_order'] = $question_order;
                    $module_insert['question_no'] = $question_no;
                    $module_insert['question_no'] = $this->input->post('country');
                    $this->db->insert('tbl_pre_module_temp', $module_insert);
                }
                // echo $this->db->last_query(); die();
            }else if ($module_status==2) {
                if(!empty($module_edit_id)){
                    $module_update['question_id'] = $questionId;
                    $module_update['question_type'] = $_POST['questionType'];
                    
                    $this->db->where('id', $module_edit_id);
                    $this->db->update('tbl_edit_module_temp', $module_update);

                }else{
                    $this->db->select('*');
                    $this->db->from('tbl_edit_module_temp');
                    $query_result = $this->db->get();
                    $results = $query_result->result_array();
                    $question_no = count($results);
                    $question_order = $question_no+1;
                    $module_insert['module_id'] = $param_module_id;
                    $module_insert['question_id'] = $questionId;
                    $module_insert['question_type'] = $_POST['questionType'];
                    $module_insert['question_order'] = $question_order;
                    $module_insert['question_no'] = $question_no;
                    $module_insert['country'] = $this->input->post('country');
                    $this->db->insert('tbl_edit_module_temp', $module_insert);
                }
                // echo $this->db->last_query(); die();
            }

            //        $this->questionMediaUpload($questionId);
            $chkValidation['question_id'] = $questionId;

            if ($_POST['questionType'] == 9) {
                $data = array();
                $data['first_atmp_text']  = $this->input->post('first_atmp_text');
                $data['second_atmp_text'] = $this->input->post('second_atmp_text');
                $data['three_atmp_text']  = $this->input->post('three_atmp_text');
                $data['question_id']  = $questionId;

                $first_input_value  = $this->input->post('1st_input_value');
                $second_input_value  = $this->input->post('2nd_input_value');
                $three_input_value  = $this->input->post('3rd_input_value');
                $data['1st_input_value'] = json_encode($first_input_value);
                $data['2nd_input_value'] = json_encode($second_input_value);
                $data['3rd_input_value'] = json_encode($three_input_value);
                $attemptId = $this->tutor_model->insertId('tbl_question_attempt', $data);
            }
            if ($_POST['questionType'] == 4) {

                if (isset($img_multipleChoose)) {
                    foreach ($img_multipleChoose as $key => $value) {
                        $this->db->query('INSERT INTO `tbl_question_tutorial`(`speech`, `img`, `audio`, `question_id` ,`orders` ) VALUES ("none", "' . $value . '" ,  "none", ' . $questionId . ', ' . $key . ' )');
                    }
                }
            }
            echo json_encode($chkValidation);
        }
    }
    public function save_workout_two($post_data)
        {
            $percentage_array = array();
            for ($i = 1; $i <= $post_data['image_quantity']; $i++) {
                //            $image = 'vocubulary_image_' . $i . '[]';
                $desired_image[] = $post_data['vocubulary_image_'.$i];
            }
            for ($i = 1; $i <= $post_data['image_quantity']; $i++) {
                //            $image = 'vocubulary_image_' . $i . '[]';
                $percentage_array['percentage_'.$i] = $post_data['percentage_'.$i];
            }
            $arr['questionName'] = $post_data['questionName'];
            $arr['question_hint'] = $post_data['question_hint'];
             $arr['solution'] = $post_data['solution'];
            if ($desired_image) {
                $arr['vocubulary_image'] = $desired_image;
            }
            if ($percentage_array) {
                $arr['percentage_array'] = $percentage_array;
            }

            $combined_data = json_encode($arr);
            return $combined_data;
        }

        public function processTutorial($items)
    {
        $arr = array();
        $array_one = array();
        if (!empty($items['speech_to_text'])) {
            $arr['speech_to_text'] = $items['speech_to_text'];
            foreach ($arr['speech_to_text'] as $key => $value) {
                if (!empty($value["speech_to_text"])) {
                    $v = [
                        "speech_to_text" =>$value["speech_to_text"]
                    ];


                    array_push($array_one, $v);
                }
                else{
                    $v = [
                        "speech_to_text" =>"none"
                    ];
                    array_push($array_one, $v);
                }
            }
        }
        

        if (isset($items['Image'])) {

            $arr['Image'] = $items['Image'];
            foreach ($arr['Image'] as $key => $value) {
                if (!empty($value["Image"])) {

                    $v = [
                        "image" => str_replace( base_url("assets/uploads/"), "", $value["Image"] )
                    ];

                    array_push($array_one, $v);


                }
                else{
                    $v = [
                        "image" =>"none"
                    ];
                    array_push($array_one, $v);
                }
            }
        }
        
        $uType = $this->session->userdata('userType');
        
        $files = $_FILES;



           $config['upload_path'] = 'assets/uploads';
           $config['allowed_types'] = 'gif|jpg|png|jpeg';
           $config['overwrite'] = false;

         $this->load->library('upload');

         if (isset($_FILES['Image']['name'])) {
             foreach($_FILES['Image']['name'] as $k => $img){

                   $config['file_name']=rand(99,9999).time().$img["Image"];
                   $this->upload->initialize($config);

                   $_FILES['image']['name']=$img["Image"];
                   $_FILES['image']['type']=$_FILES['Image']['type'][$k]["Image"];
                   $_FILES['image']['tmp_name']=$_FILES['Image']['tmp_name'][$k]["Image"];
                   $_FILES['image']['error']=$_FILES['Image']['error'][$k]["Image"];
                   $_FILES['image']['size']=$_FILES['Image']['size'][$k]["Image"];


                   if (!$this->upload->do_upload('image')) {
                       $status = 'error';
                       $msg = $this->upload->display_errors('', '');
                       $var1 =[
                        "image"=>'none'
                      ];

                       array_push($array_one, $var1);

                   } else {

                      $imageName = $this->upload->data();
                      $arr['image'] = $imageName["file_name"];

                      $var1 =[
                        "image"=>$imageName["file_name"]
                      ];

                      array_push($array_one, $var1);
                   }
                   
            }
         }

               $config['upload_path'] = 'assets/uploads/question_media/';
               $config['allowed_types'] = 'mp3|mp4|';
               $config['overwrite'] = false;

               $this->upload->initialize($config);

               if (  !empty($_FILES['audioFile']['name'])) {
                   foreach($_FILES['audioFile']['name'] as $l => $audios){

                           $config['file_name']=rand(99,9999).time().$audios["audioFile"];
                           $this->upload->initialize($config);


                           $_FILES['audio']['name']=$audios["audioFile"];
                           $_FILES['audio']['type']=$_FILES['audioFile']['type'][$l]["audioFile"];
                           $_FILES['audio']['tmp_name']=$_FILES['audioFile']['tmp_name'][$l]["audioFile"];
                           $_FILES['audio']['error']=$_FILES['audioFile']['error'][$l]["audioFile"];
                           $_FILES['audio']['size']=$_FILES['audioFile']['size'][$l]["audioFile"];



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
                                "Audio"=>$audioFiles["file_name"]
                              ];

                              array_push($array_one, $var2);
                             
                           }
                    }
        
               }


        return json_encode($array_one);
        
    }

    public function processTutorial_old($items)
    {
        
        $arr = array();
        $array_one = array();
        $arr['speech_to_text'] = $items['speech_to_text'];
        foreach ($arr['speech_to_text'] as $key => $value) {
            if (!empty($value["speech_to_text"])) {
                $v = [
                    "speech_to_text" =>$value["speech_to_text"]
                ];


                array_push($array_one, $v);
            }
            else{
                $v = [
                    "speech_to_text" =>"none"
                ];
                array_push($array_one, $v);
            }
        }
        
        $uType = $this->session->userdata('userType');
        
        $files = $_FILES;



           $config['upload_path'] = 'assets/uploads';
           $config['allowed_types'] = 'gif|jpg|png|jpeg';
           $config['overwrite'] = false;

         $this->load->library('upload');

         foreach($_FILES['Image']['name'] as $k => $img){

               $config['file_name']=rand(99,9999).time().$img["Image"];
               $this->upload->initialize($config);

               $_FILES['image']['name']=$img["Image"];
               $_FILES['image']['type']=$_FILES['Image']['type'][$k]["Image"];
               $_FILES['image']['tmp_name']=$_FILES['Image']['tmp_name'][$k]["Image"];
               $_FILES['image']['error']=$_FILES['Image']['error'][$k]["Image"];
               $_FILES['image']['size']=$_FILES['Image']['size'][$k]["Image"];


               if (!$this->upload->do_upload('image')) {
                   $status = 'error';
                   $msg = $this->upload->display_errors('', '');
                   $var1 =[
                    "image"=>'none'
                  ];

                   array_push($array_one, $var1);

               } else {

                  $imageName = $this->upload->data();
                  $arr['image'] = $imageName["file_name"];

                  $var1 =[
                    "image"=>$imageName["file_name"]
                  ];

                  array_push($array_one, $var1);
               }
               
        }

               $config['upload_path'] = 'assets/uploads/question_media/';
               $config['allowed_types'] = 'mp3|mp4|';
               $config['overwrite'] = false;

               $this->upload->initialize($config);


        foreach($_FILES['audioFile']['name'] as $l => $audios){

               $config['file_name']=rand(99,9999).time().$audios["audioFile"];
               $this->upload->initialize($config);


               $_FILES['audio']['name']=$audios["audioFile"];
               $_FILES['audio']['type']=$_FILES['audioFile']['type'][$l]["audioFile"];
               $_FILES['audio']['tmp_name']=$_FILES['audioFile']['tmp_name'][$l]["audioFile"];
               $_FILES['audio']['error']=$_FILES['audioFile']['error'][$l]["audioFile"];
               $_FILES['audio']['size']=$_FILES['audioFile']['size'][$l]["audioFile"];



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
                    "Audio"=>$audioFiles["file_name"]
                  ];

                  array_push($array_one, $var2);
                 
               }
        }
        return json_encode($array_one);
        
    }

    public function checkValidation($data)
    {
        // echo "<pre>";print_r($data);die();
        
        $return_data['flag'] = 1;
        if (isset($data['errorStoryWrite'])) {
            $return_data['msg'] = 'Need to include each part right or wrong answer both.';
            $return_data['flag'] = 0;
        }else{
            if($data['questionType']==20 && $data['answer'] =='write'){
                if ($data['studentgrade'] == '') {
                    $return_data['msg'] = 'Student Grade Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['subject'] == '') {
                    $return_data['msg'] = 'Subject Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['chapter'] == '') {
                    $return_data['msg'] = 'Chapter Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['questionName'] == '') {
                    $return_data['msg'] = 'Question Can Not Be empty';
                    $return_data['flag'] = 0;
                } elseif ($data['answer'] == '') {
                    $return_data['msg'] = 'Answer Can Not Be empty';
                    $return_data['flag'] = 0;
                } elseif ($data['question_solution'] == '') {
                    $return_data['msg'] = 'Solution Can Not Be empty';
                    $return_data['flag'] = 0;
                }
            }else if($data['questionType']==22){
                if ($data['studentgrade'] == '') {
                    $return_data['msg'] = 'Student Grade Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['subject'] == '') {
                    $return_data['msg'] = 'Subject Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['chapter'] == '') {
                    $return_data['msg'] = 'Chapter Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['questionName'] == '') {
                    $return_data['msg'] = 'Question Can Not Be empty';
                    $return_data['flag'] = 0;
                } elseif ($data['answer'] == '') {
                    $return_data['msg'] = 'Answer Can Not Be empty';
                    $return_data['flag'] = 0;
                } elseif ($data['question_solution'] == '') {
                    $return_data['msg'] = 'Solution Can Not Be empty';
                    $return_data['flag'] = 0;
                }
            }else if($data['questionType']==17){
                if ($data['studentgrade'] == '') {
                    $return_data['msg'] = 'Student Grade Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['subject'] == '') {
                    $return_data['msg'] = 'Subject Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['chapter'] == '') {
                    $return_data['msg'] = 'Chapter Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['questionName'] == '') {
                    $return_data['msg'] = 'Question Can Not Be empty';
                    $return_data['flag'] = 0;
                } elseif ($data['answer'] == '') {
                    $return_data['msg'] = 'Answer Can Not Be empty';
                    $return_data['flag'] = 0;
                } elseif ($data['question_solution'] == '') {
                    $return_data['msg'] = 'Solution Can Not Be empty';
                    $return_data['flag'] = 0;
                }
            }else if($data['questionType']==23){
                if ($data['studentgrade'] == '') {
                    $return_data['msg'] = 'Student Grade Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['subject'] == '') {
                    $return_data['msg'] = 'Subject Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['chapter'] == '') {
                    $return_data['msg'] = 'Chapter Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['questionName'] == '') {
                    $return_data['msg'] = 'Question Can Not Be empty';
                    $return_data['flag'] = 0;
                } elseif ($data['answer'] == '') {
                    $return_data['msg'] = 'Answer Can Not Be empty';
                    $return_data['flag'] = 0;
                } elseif ($data['question_solution'] == '') {
                    $return_data['msg'] = 'Solution Can Not Be empty';
                    $return_data['flag'] = 0;
                }
            }else{
                if ($data['studentgrade'] == '') {
                    $return_data['msg'] = 'Student Grade Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['subject'] == '') {
                    $return_data['msg'] = 'Subject Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['chapter'] == '') {
                    $return_data['msg'] = 'Chapter Need To Be Selected';
                    $return_data['flag'] = 0;
                } elseif ($data['questionName'] == '') {
                    $return_data['msg'] = 'Question Can Not Be empty';
                    $return_data['flag'] = 0;
                } elseif ($data['answer'] == '') {
                    $return_data['msg'] = 'Answer Can Not Be empty';
                    $return_data['flag'] = 0;
                } elseif ($data['question_solution'] == '') {
                    $return_data['msg'] = 'Solution Can Not Be empty';
                    $return_data['flag'] = 0;
                }
                // else if($data['questionTime'] == 'HH:MM:SS'){
                //     $return_data['msg'] = 'Time Can Not Be empty';
                //     $return_data['flag'] = 0;
                // }
                elseif ($data['questionMarks'] == '' && $data['questionType'] !=14) {
                    $return_data['msg'] = 'Marks Can Not Be empty';
                    $return_data['flag'] = 0;
                }
            }
        }
        //else if($data['questionDescription'] == ''){
            // $return_data['msg'] = 'Description Can Not Be empty';
            // $return_data['flag'] = 0;
        //}
        return $return_data;
    }

    public function imageUpload()
    {
        $files = $_FILES;

        $_FILES['file']['name'] = $files['file']['name'];
        $_FILES['file']['type'] = $files['file']['type'];
        $_FILES['file']['tmp_name'] = $files['file']['tmp_name'];
        $_FILES['file']['error'] = $files['file']['error'];
        $_FILES['file']['size'] = $files['file']['size'];
        
        $config['upload_path'] = 'assets/uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|webm|doc|docx|mp4|webm|ogg|avi';
        $config['max_size'] = 0;
        $config['max_width'] = 0;
        $config['max_height'] = 0;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        //        $this->upload->do_upload();

        $error = array();
        if (!$this->upload->do_upload('file')) {
            $error = $this->upload->display_errors();
            //echo $error;
        } else {
            $imageName = $this->upload->data();
            $base = base_url() . 'assets/uploads/' . $imageName['file_name'];
            echo '{"fileName":"' . $imageName['file_name'] . '","uploaded":1,"url":"' . $base . '"}';
        }
    }
    
    /**
     * Grab item from post method for question field
     *
     * @param array $items post array
     *
     * @return string json encoded data to record as question
     */
    public function processVocabulary($items)
    {
        $arr['definition'] = $items['definition'];
        $arr['parts_of_speech'] = $items['parts_of_speech'];
        $arr['synonym'] = $items['synonym'];
        $arr['antonym'] = $items['antonym'];
        $arr['sentence'] = $items['sentence'];
        $arr['near_antonym'] = $items['near_antonym'];
        $arr['speech_to_text'] = $items['speech_to_text'];
        $arr['ytLinkInput'] = $items['ytLinkInput'];
        $arr['ytLinkTitle'] = $items['ytLinkTitle'];

        $uType = $this->session->userdata('userType');

        //$arr['vocubulary_image'] = $items['vocubulary_image'];
        for ($i = 1; $i <= $items['image_quantity']; $i++) {
            //$image = 'vocubulary_image_' . $i . '[]';
            $desired_image[] = $items['vocubulary_image_'.$i];
        }
        if ($desired_image) {
            $arr['vocubulary_image'] = $desired_image;
        }
        
        if (isset($items['existed_audio_File']) && $items['existed_audio_File'] != '') {
            $arr['audioFile'] = $items['existed_audio_File'];
        }
        
        $files = $_FILES;
        //only q-study user can upload video
        if (isset($_FILES['videoFile']) && $_FILES['videoFile']['error'][0] != 4 && $uType==7 ) {
            $_FILES['videoFile']['name'] = $files['videoFile']['name'];
            $_FILES['videoFile']['type'] = $files['videoFile']['type'];
            $_FILES['videoFile']['tmp_name'] = $files['videoFile']['tmp_name'];
            $_FILES['videoFile']['error'] = $files['videoFile']['error'];
            $_FILES['videoFile']['size'] = $files['videoFile']['size'];

            $config['upload_path'] = 'assets/uploads/question_media/';
            $config['allowed_types'] = 'mp3|mp4|3gp|ogg|wmv';
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['max_height'] = 0;
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload();

            $error = array();
            if (!$this->upload->do_upload('videoFile')) {
                $error = $this->upload->display_errors();
            } else {
                $fdata = $this->upload->data();
                $arr['videoFile'] = $config['upload_path'] . $fdata['file_name'];
            }
        }
        
        if (isset($_FILES['audioFile']) && $_FILES['audioFile']['error'][0] != 4) {
            $_FILES['audioFile']['name'] = $files['audioFile']['name'];
            $_FILES['audioFile']['type'] = $files['audioFile']['type'];
            $_FILES['audioFile']['tmp_name'] = $files['audioFile']['tmp_name'];
            $_FILES['audioFile']['error'] = $files['audioFile']['error'];
            $_FILES['audioFile']['size'] = $files['audioFile']['size'];

            $config['upload_path'] = 'assets/uploads/question_media/';
            $config['allowed_types'] = 'mp3|mp4|3gp|ogg|wmv';
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['max_height'] = 0;
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload();
            
            if (!$this->upload->do_upload('audioFile')) {
                $error = $this->upload->display_errors();
            } else {
                $fdata1 = $this->upload->data();
                $arr['audioFile'] = $config['upload_path'] . $fdata1['file_name'];
            }
        }
        
        return json_encode($arr);
    }

    
    /**
     * question media file upload and record
     *
     * @param  integer $questionId questionId for files to link with
     * @return void
     */
    public function questionMediaUpload($questionId = 0)
    {
        $files = $_FILES;
        $dataToInsert = [];
        $config['upload_path'] = "assets/uploads/question_media";
        
        $config['allowed_types']        = 'mp3|mp4|3gp|ogg|wmv';
        $config['max_size']             = 18403791;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        
        foreach ($files as $index => $item) {
            $config['file_name'] = uniqid();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload($index);
            
            $fileName = $this->upload->data('file_name');
            $filePath = $this->upload->data('file_path');
            $fileType = $this->upload->data('file_type');
            
            $dataToInsert['media_url'] = $filePath.$fileName;
            $dataToInsert['media_type'] = $fileType;
            $dataToInsert['upload_date'] = date("Y-m-d H:i:s");
            $dataToInsert['question_id'] = $questionId;
            $this->tutor_model->insertInfo('tbl_question_media', $dataToInsert);
        }
    }
    
    //    Question Edit Option
    public function question_edit($type, $question_id, $module_edit_status=null, $module_status_edit_id=null)
    { 
        // echo 11; die();
        if(!empty($module_edit_status)){
            if($module_edit_status==2){
                $this->session->set_userdata('module_edit_status', $module_edit_status);
                $this->session->set_userdata('module_status_edit_id', $module_status_edit_id);
            }
            if($module_edit_status==1){
                $this->session->set_userdata('module_edit_status', $module_edit_status);
            }
        }

        if (!empty($_SESSION["has_edit"])) {
            $data["has_back_button"] =$_SESSION["has_edit"];
        }
        else{
            unset($_SESSION["has_edit"]);
        }
        
        $data['question_info'] = $this->tutor_model->getQuestionInfo($type, $question_id);
        // echo '<pre>';print_r($data['question_info']);die;
        $data['question_item'] = $type;
        $data['question_id'] = $question_id;
        $data['question_tutorial'] = $this->tutor_model->getInfo('tbl_question_tutorial', 'question_id', $question_id);
        $user_id = $this->session->userdata('user_id');
        $data['all_grade'] = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_subject'] = $this->tutor_model->getInfo('tbl_subject', 'created_by', $user_id);
        $subject_id = $data['question_info'][0]['subject'];

        $data['subject_base_chapter'] = $this->tutor_model->getInfo('tbl_chapter', 'subjectId', $subject_id);
        if (count($data['question_info'])) {
            $data['allCountry'] = $this->Admin_model->search('tbl_country', [1=>1]);
            $data['selCountry'] = $data['question_info'][0]['country'];
            $quesSub = $data['question_info'][0]['subject'];
            $quesChap = $data['question_info'][0]['chapter'];
            $chaps = $this->get_chapter_name($quesSub, $quesChap); //selected $quesChap
            $temp = [
                'subject' =>$data['question_info'][0]['subject'],
                'chapter' =>$chaps,
                'selChapter' =>$quesChap,
                'studentGrade' =>$data['question_info'][0]['studentgrade'],
            ];
            $this->session->set_flashdata('refPage', 'questionEdit');
            $this->session->set_flashdata('modInfo', $temp);
        }
        
        $qSearchParams = [
            'questionType' =>$type,
            'user_id' =>$this->loggedUserId,
            'country' =>$this->session->userdata('selCountry'),
        ];
        
        //print_r($qSearchParams);die();
        //echo $question_id.'//';
        $allQuestionIds = $this->QuestionModel->search('tbl_question', $qSearchParams);
        //echo "<pre>";print_r($allQuestionIds);
        $allQuestionIds = array_column($allQuestionIds, 'id');
        // print_r($allQuestionIds);
        $data['qIndex'] = array_search($question_id, $allQuestionIds);
        //print_r($data['qIndex']);
        //echo $data['qIndex'].'//';die();
        //if ques not found by loggedUserId and ques type then redirect to list
        if (!is_int($data['qIndex'])) {
            redirect('question-list');
        } else {
            $data['qIndex'] += 1;
        }

        
        $question_box = 'question_edit/question-box';
        if ($type == 1) {
            $question_box .= '/general';
        }
        if ($type == 2) {
            $question_box .= '/true-false';
        }
        if ($type == 3) {
            $que_module_check = $this->tutor_model->getInfo('tbl_modulequestion', 'question_id', $question_id);
            if(count($que_module_check) > 0){
                $data['question_module_check'] = $que_module_check;
                //echo "<pre>";print_r($que_module_check);die();
            }
            
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
            $question_box .= '/edit_vocubulary';
        }
        if ($type == 4) {
            
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
            $question_box .= '/edit_multiple_choice';
        }
        if ($type == 5) {
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
            // echo "<pre>";print_r($data);die();
            $question_box .= '/edit_multiple_response';
        }
        if ($type == 7) {
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
            $data['question_answer'] = json_decode($data['question_info'][0]['answer']);
            $question_box .= '/edit_matching';
        }
        if ($type == 6) {
            $quesInfo1 = json_decode($data['question_info'][0]['questionName']);
            $items = $this->indexQuesAns($quesInfo1->skp_quiz_box);
            $data['numOfRows'] = $quesInfo1->numOfRows;
            $data['numOfCols'] = $quesInfo1->numOfCols;
            $data['skp_box'] = $this->renderSkpQuizPrevTable($items, $data['numOfRows'], $data['numOfCols'], $showAns = 1, 'edit');

            $data['questionBody'] = $quesInfo1->question_body;
            $question_box .= '/skip_quiz';
        } if ($type == 8) {
            $this->edit_assignment_question($data);
        } if ($type == 9) {
            
            
            $info = array();
            $titles = array();
            $title = array();

            // print_r(json_decode($data['question_info'][0]['questionName'])); die();
            //title

            $wrongTitles = json_decode($data['question_info'][0]['questionName'] , true);
            $wrongTitless = $wrongTitles['wrongTitles'];
            foreach ($wrongTitless as $key => $value) {
                $title[0] = $value;
                $title[1] = $wrongTitless[$key];
                $title[2] = $key;
                $titles[] = $title;
            }

            if (count($titles) > 1 ) {
                $data['titles_on'] = 1;
            }
            

            $title[0] = json_decode($data['question_info'][0]['questionName'])->rightTitle;
            $title[1] = "right_ones_xxx";
            $title[2] = "noWrongTitle";
            $titles[] = $title;
            shuffle($titles);
            $info['titles'] = $titles;

            //intro

            $titles = array();
            $title = array();

            foreach (json_decode($data['question_info'][0]['questionName'])->wrongIntro as $key => $value) {
                $title[0] = $value;
                $title[1] = json_decode($data['question_info'][0]['questionName'])->wrongIntroIncrement[$key];
                $title[2] = $key;
                $titles[] = $title;
            }

            if (count($titles) > 1 ) {
                $data['intro_on'] = 1;
            }
            
            $title[0] = json_decode($data['question_info'][0]['questionName'])->rightIntro;
            $title[1] = "right_ones_xxx";
            $title[2] = "noWrongTitle";
            $titles[] = $title;
            shuffle($titles);
            $info['Intro'] = $titles;

            //picture

            $titles = array();
            $title = array();

            foreach (json_decode($data['question_info'][0]['questionName'])->pictureList as $key => $value) {
                $title[0] = $value;
                $title[1] = "wrong_ones_xxx";
                $title[2] = $key;
                $titles[] = $title;
            }

            if (count($titles) > 1 ) {
                $data['picture_on'] = 1;
            }

            $title[0] = json_decode($data['question_info'][0]['questionName'])->lastpictureSelected;
            $title[1] = "right_ones_xxx";
            $title[2] = "noWrongTitle";
            $titles[] = $title;
            shuffle($titles);
            $info['picture'] = $titles;

            //paragraph
            $paragraph = json_decode($data['question_info'][0]['questionName'] , true);
            $paragraph = $paragraph['Paragraph'];

            $info['paragraph'] = $paragraph;

            //picture

            $titles = array();
            $title = array();

            foreach (json_decode($data['question_info'][0]['questionName'])->wrongConclution as $key => $value) {
                $title[0] = $value;
                $title[1] = "wrong_ones_xxx";
                $title[2] = $key;
                $titles[] = $title;
            }

            if (count($titles) > 1 ) {
                $data['conclusion_on'] = 1;
            }

            $title[0] = json_decode($data['question_info'][0]['questionName'])->rightConclution;
            $title[1] = "right_ones_xxx";
            $title[2] = "noWrongTitle";
            $titles[] = $title;
            shuffle($titles);

            $info['conclution'] = $titles;
            $data['question'] = $info;
            $data['question_answer'] = json_decode($data['question_info'][0]['answer']);

            $question_box .= '/edit_storyWrite';
            
        } if ($type == 10) {
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName'], true);
            $data['question_answer'] = json_decode($data['question_info'][0]['answer'], true);
            
            $question_box .= '/edit_times_table';
        } if ($type == 11) {
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName'], true);
            $data['question_answer'] = json_decode($data['question_info'][0]['answer'], true);
            
            $question_box .= '/edit_algorithm';
        } if ($type == 12) {
            $question_box .= '/workout_quiz';
        } if ($type == 13) {
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
            $question_box .= '/edit_matching_workout';
        }if ($type == 14) {
            // $last_id = $this->tutor_model->tutor_update(5620);
            // print_r(); die();
            $data['tutor_edit'] = $this->tutor_model->tutor_edit($type, $question_id);
            
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
            $question_box .= '/edit_tutor_view';
        }if ($type == 15)
            {
                $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
                $question_box .= '/workout_quiz_two';
            }
            if ($type == 16)
        {
            
            
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
            // echo "<pre>";print_r($data['question_info_ind'] ); die();
            $question_box .= '/memorization.php';

        }
        if ($type == 17)
        {
            $data['idea_info'] = $this->tutor_model->getIdeaInfoByQuestion($question_id); 
            // echo "<pre>";print_r($data['idea_info']);die();
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
            $data['q_creator_name'] = $this->tutor_model->getIQuestionCreator($question_id);
         
            $question_box .= '/edit_creative_quiz.php';

            $this->db->truncate('idea_save_temp');
            $data['ideas'] = $this->tutor_model->getIdeasByQuestion($question_id);
            $data['user_id'] = $this->session->userdata('user_id');
            $data['question_id']=$question_id;
            //echo "<pre>";print_r($data['ideas']); die();
        }
        if ($type == 18)
        {
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
            $question_box .= '/edit_sentence_match.php';
        }
        if ($type == 19)
        {
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
            $question_box .= '/edit_word_memorize.php';
        }
        if ($type == 20)
        {
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
            $question_box .= '/edit_comprehension.php';
        }
        if ($type == 21)
        {
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
            $question_box .= '/edit_grammer.php';
        }
        if ($type == 22)
        {
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
            $question_box .= '/edit_glossary.php';
        }
        if ($type == 23)
        {
            $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
            $question_box .= '/edit_image_quiz.php';
        }
        
        
        if ($type != 8) {
           
            $data['question_box'] = $this->load->view($question_box, $data, true);

            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

            $data['maincontent'] = $this->load->view('question_edit/edit_question', $data, true);
            $this->load->view('master_dashboard', $data);
        }
    }

    public function view_edit_idea(){ 
        // $question_id = $this->input->post('question_id');
        // $idea_id = $this->input->post('idea_id');


        // $get_idea = $this->tutor_model->getEditIdea($question_id,$idea_no);
        // // echo "<pre>"; print_r($get_idea); die();
        // echo json_encode($get_idea);
        $idea_id=$this->input->post('idea_id');

        $this->db->select('*');
        $this->db->from('question_ideas');
        $this->db->join('tbl_useraccount', 'question_ideas.user_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('question_ideas.id', $idea_id);
        $query = $this->db->get();
        $result=$query->row_array();
        //echo $this->db->last_query();die();
        echo json_encode($result);

    }
    
    
    public function edit_assignment_question($data)
    {
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $country = $this->tutor_model->get_country($_SESSION['user_id']);
        $data['country'] = $country[0]['country_id'];

        $data['maincontent'] = $this->load->view('question_edit/edit_assignment_question', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    
    /**
     * Before passing items to renderSkpQuizPrevTable() index it first with this func
     * basically for preview skip quiz table
     *
     * @param array $items Json object array.
     *
     * @return array        Array with proper indexing
     */
    public function indexQuesAns($items)
    {
        $arr = [];
        foreach ($items as $item) {
            $temp            = json_decode($item);
            if ($temp) {
                $cr              = explode('_', $temp->cr);
                $col             = $cr[0];
                $row             = $cr[1];
                $arr[$col][$row] = [
                    'type' => $temp->type,
                    'val'  => $temp->val,
                ];
            }
        }

        return $arr;
    }//end indexQuesAns()
    

    /**
     * Render the indexed item to table data for preview
     *
     * @param  array   $items   ques ans as indexed item(get processed items from indexQuesAns())
     * @param  integer $rows    num of row in table
     * @param  integer $cols    num of cols in table
     * @param  integer $showAns optional, set 1 will show the answers too
     * @return string           table item
     */
    public function renderSkpQuizPrevTable($items, $rows, $cols, $showAns = 0, $pageType = '')
    {
        // print_r($items);die;
        $row = '';
        for ($i = 1; $i <= $rows; $i++) {
            $row .= '<tr>';
            for ($j = 1; $j <= $cols; $j++) {
                if ($items[$i][$j]['type'] == 'q') {
                    $row .= '<td>'
                    . '<input type="text" data_q_type="0" data_num_colofrow="'.$i.'_'.$j.'" value="'.$items[$i][$j]['val'].'" name="skip_counting[]" class="form-control rsskpin input-box  rsskpinpt'.$i.'_'.$j.'" readonly style="min-width:50px; max-width:50px; background-color:#ffb7c5;">';
                    if ($pageType = 'edit') {
                        $quesObj = [
                            'cr'   => $i.'_'.$j,
                            'val'  => $items[$i][$j]['val'],
                            'type' => 'q',
                        ];
                        $quesObj = json_encode($quesObj);
                        //                        echo $quesObj.'<pre>';
                        $row    .= '<input type="hidden" value=\''.$quesObj.'\' name="ques_ans[]" id="obj">';
                        $row .= '<input type="hidden" value="" name="ans[]" id="ans_obj">';
                    }

                    $row .= '</td>';
                } else {
                    $ansObj = [
                        'cr'   => $i.'_'.$j,
                        'val'  => $items[$i][$j]['val'],
                        'type' => 'a',
                    ];
                    $ansObj = json_encode($ansObj);
                    $val    = ($showAns == 1) ? ' value="'.$items[$i][$j]['val'].'"' : '';

                    $row .= '<td>'
                    . '<input type="text" data_q_type="0" data_num_colofrow="'.$i.'_'.$j.'" value="'.$items[$i][$j]['val'].'" name="skip_counting[]" class="form-control rsskpin input-box rsskpinpt'.$i.'_'.$j.'" readonly style="min-width:50px; max-width:50px; background-color:#baffba;">';
                    //                    $row .= '<input type="hidden" value="" name="given_ans[]" id="given_ans">';
                    if ($pageType = 'edit') {
                        $row .= '<input type="hidden" value=\''.$ansObj.'\' name="ques_ans[]" id="obj">';
                        $row .= '<input type="hidden" value=\''.$ansObj.'\' name="ans[]" id="ans_obj">';
                    }

                    $row .= '</td>';
                }//end if
            }//end for

            $row .= '</tr>';
        }//end for

        return $row;
    }//end renderSkpQuizPrevTable()
    

    /**
     * view student progress by his/her tutor
     * based on search params
     *
     * @return void
     */
    public function viewStudentProgress()
    {
        $data = $this->commonPart();

        $post = $this->input->post();
        $data['st_progress'] = '';

        $this->form_validation->set_rules('studentId', 'Student Id', 'required');
        $this->form_validation->set_rules('moduleTypeId', 'Module Type', 'required');
        if ($this->form_validation->run() == true) {
            if (isset($post['studentId'])) {
                $conditions['student_id'] = $post['studentId'];
            }if (isset($post['moduleTypeId'])) {
                $conditions['moduletype'] = $post['moduleTypeId'];
            }

            $allProgress = $this->Student_model->studentProgress($conditions);
            $data['st_progress'] = $this->renderStProgress($allProgress);
        }

        $conditions = array(
            'sct_id' => $this->loggedUserId,
        );

        $studentIds = $this->tutor_model->allStudents($conditions);
        $data['students'] = $this->renderStudents($studentIds);
        $data['moduleTypes'] = $this->renderModuletypes($this->tutor_model->allModuleType());


        $data['maincontent'] = $this->load->view('students/student_progress', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    /**
     * wrap students info with option
     *
     * @param  array $studentIds student ids of tutor
     * @return string             wrapped string
     */
    public function renderStudents($studentIds)
    {

        $options = '';


        foreach ($studentIds as $studentId) {
            $student = $this->Student_model->userInfo($studentId);

            if (isset($student[0]) && !empty($student[0]) ) {
                $student = $student[0];
                $options .= '<option value="' . $studentId . '">' . $student['name'] . '</option>';
            }
            
        }
        return $options;
    }

    /**
     * wrap module types with option tag
     *
     * @param  array $moduleTypes all module type of a tutor attached with
     * @return string              wrapped string
     */
    public function renderModuletypes($moduleTypes)
    {
        $options = '';
        foreach ($moduleTypes as $moduleType) {
            $options .= '<option value="' . $moduleType['id'] . '">' . $moduleType['module_type'] . '</option>';
        }
        return $options;
    }

    public function renderStProgress($items)
    {
        $row = '';
        foreach ($items as $item) {
            $row .= '<tr>';
            $row .= '<td>' . $this->ModuleModel->moduleName($item['module']) . '</td>';
            $row .= '<td>' . $this->ModuleModel->moduleTypeName($item['moduletype']) . '</td>';
            $row .= '<td>' . date('Y-m-d', $item['answerDate']) . '</td>';
            $row .= '<td>' . $item['answerTime'] . '</td>';
            $row .= '<td>' . $item['timeTaken'] . '</td>';
            $row .= '<td>' . $item['originalMark'] . '</td>';
            $row .= '<td>' . $item['studentMark'] . '</td>';
            $row .= '<td>' . $item['percentage'] . '</td>';
            $row .= '</tr>';
        }
        return $row;
    }

    /**
     * till now seems common on all functions
     *
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

    public function get_subject()
    {
        $subject = $this->tutor_model->getInfo('tbl_subject', 'created_by', $this->session->userdata('user_id'));
        echo json_encode($subject);
    }

    public function add_chapter()
    {
        $this->form_validation->set_rules('attached_subject', 'attached_subject', 'required');
        $this->form_validation->set_rules('chapter', 'chapter', 'required');
        if ($this->form_validation->run() == false) {
            echo validation_errors();
        } else {
            //            print_r($_POST);
            $data['subjectId'] = $_POST['attached_subject'];
            $data['chapterName'] = $_POST['chapter'];
            $data['created_by'] = $this->session->userdata('user_id');
            $chapter = $this->tutor_model->insertInfo('tbl_chapter', $data);
            $all_subject_chapter = $this->tutor_model->getInfo('tbl_chapter', 'subjectId', $data['subjectId']);
            
            echo '<option value="">Select Chapter</option>';
            foreach ($all_subject_chapter as $chapter) {
                echo '<option value="' . $chapter['id'] . '">' . $chapter['chapterName'] . '</option>';
            }
        }
    }

    /**
     * check given skip box answers with the stored answers
     * can give wrong value given indices
     *
     * @return void
     */
    public function checkSkpboxAnswer()
    {
        $post = $this->input->post();
        $questionId = $this->input->post('questionId');
        $givenAns = $this->indexQuesAns($post['given_ans']);

        $temp = $this->tutor_model->getInfo('tbl_question', 'id', $questionId);
        $savedAns = $this->indexQuesAns(json_decode($temp[0]['answer']));

        $temp2 = json_decode($temp[0]['questionName']);
        $numOfRows = $temp2->numOfRows;
        $numOfCols = $temp2->numOfCols;
        //echo $numOfRows .' ' . $numOfCols;
        $wrongAnsIndices = [];
        
        for ($row=1; $row<=$numOfRows; $row++) {
            for ($col=1; $col<=$numOfCols; $col++) {
                if (isset($savedAns[$row][$col]) && isset($givenAns[$row][$col])) {
                    $wrongAnsIndices[] = ($savedAns[$row][$col] != $givenAns[$row][$col]) ? $row.'_'.$col:null;
                }
            }
        }
        
        $wrongAnsIndices = array_filter($wrongAnsIndices);
        //echo count($savedAns);
        if (count($wrongAnsIndices) || count($givenAns) != count($savedAns)) {
            echo 3;
        } else {
            echo 2;
        }
    }

    /**
     * get right answers for a question, get hit from ajax call
     *
     * @return string table item
     */
    public function getRightAns()
    { 
        $post = $this->input->post();
        $questionId = $post['qId'];
        $temp = $this->Preview_model->getInfo('tbl_question', 'id', $questionId);
        $quesAns = json_decode($temp[0]['questionName']);
        $items = $this->indexQuesAns($quesAns->skp_quiz_box);
        // print_r($items);
        $rows = $quesAns->numOfRows;
        $cols = $quesAns->numOfCols;
        $tblData = $this->renderSkpQuizPrevTable($items, $rows, $cols, $showAns = 1);
        echo $tblData;
    }
    
    public function update_question_data()
    {
        $post = $this->input->post();

        // echo "<pre>";print_r($post);die();
        $clean = $this->security->xss_clean($post);
        $clean['media'] = isset($_FILES) ? $_FILES : [];

        $instruction_link = str_replace('</p>', '', $post['question_instruction']);
        $instruction_array = array_filter(explode('<p>', $instruction_link));

        $instruction_new_array = array();
        foreach ($instruction_array as $row) {
            $instruction_new_array[] = strip_tags($row);
        }


        $video_link = isset($post['question_video']) ? $post['question_video'] : '';
        $video_link = str_replace('</p>', '', $video_link);
        $video_array = array_filter(explode('<p>', $video_link));

        $video_new_array = array();
        foreach ($video_array as $row) {
            $video_new_array[] = strip_tags($row);
        }

        $data['questionType'] = $this->input->post('questionType');
        $question_id = $this->input->post('question_id');

        $questionName = $this->input->post('questionName');
        $answer = $this->input->post('answer');
        $description = $this->input->post('questionDescription');


        $module_status = $this->session->userdata('module_status');
        $module_edit_id = $this->session->userdata('module_edit_id');
        $param_module_id = $this->session->userdata('param_module_id');
        //echo 'sssssssssss/'.$module_edit_id;die();
        if ($module_status==1) {
            if(!empty($module_edit_id)){
               
                $module_update['question_id'] = $question_id;
                $module_update['question_type'] = $_POST['questionType'];
                
                $this->db->where('id', $module_edit_id);
                $this->db->update('tbl_pre_module_temp', $module_update);
                
            }else{
                $this->db->select('*');
                $this->db->from('tbl_pre_module_temp');
                $query_result = $this->db->get();
                $results = $query_result->result_array();
                $question_no = count($results);
                $question_order = $question_no+1;
                $module_insert['question_id'] = $question_id;
                $module_insert['question_type'] = $_POST['questionType'];
                $module_insert['question_order'] = $question_order;
                $module_insert['question_no'] = $question_no;
                $module_insert['question_no'] = $this->input->post('country');
                $this->db->insert('tbl_pre_module_temp', $module_insert);
            }
            
            // echo $this->db->last_query(); die();
        }elseif($module_status==2){
          
            if(!empty($module_edit_id)){
               
                $module_update['question_id'] = $question_id;
                $module_update['question_type'] = $_POST['questionType'];
                
                $this->db->where('id', $module_edit_id);
                $this->db->update('tbl_edit_module_temp', $module_update);
                
            }else{
                $this->db->select('*');
                $this->db->from('tbl_edit_module_temp');
                $query_result = $this->db->get();
                $results = $query_result->result_array();
                $question_no = count($results);
                $question_order = $question_no+1;

                $module_insert['module_id'] = $param_module_id;
                $module_insert['question_id'] = $question_id;
                $module_insert['question_type'] = $_POST['questionType'];
                $module_insert['question_order'] = $question_order;
                $module_insert['question_no'] = $question_no;
                $module_insert['country'] = $this->input->post('country');
                $this->db->insert('tbl_edit_module_temp', $module_insert);
            }
        }
       

        if ($data['questionType'] == 14) {
            $questionName =  $this->processTutorial($post);
            // $last_id = $this->tutor_model->last_id();
            $data["last_id"] = "1000";
        }

        if ($data['questionType'] == 3) {
            $questionName =  $this->processVocabulary($post);
        }
        if ($_POST['questionType'] == 4) {
            $data['question_name_type'] = $this->input->post('question_name_type');
            if (isset($_POST['questionName_1_checkbox']) && isset($_POST['questionName_2_checkbox'])) {

                $_POST['questionName'] = $_POST['questionName'];
                $data['question_name_type'] = 2;
            } else {
                $_POST['questionName'] = !empty($_POST['questionNameClick']) ? $_POST['questionNameClick'] : $_POST['questionName'];
            }


            $questionName = $this->save_multiple_choice($_POST);
            // $answer = $_POST['response_answer'];
            $answer = json_encode($_POST['response_answer']);
        }
        if ($_POST['questionType'] == 5) {
            //Same as Multiple Choice
            $questionName = $this->save_multiple_response($_POST);
            $answer = json_encode($_POST['response_answer']);
        }
        if ($data['questionType'] == 6) {
            //skip quiz
            $temp['question_body'] = isset($clean['question_body']) ? $clean['question_body'] : '';
            $temp['skp_quiz_box'] = $clean['ques_ans'];
            $temp['numOfRows']     = isset($clean['numOfRows']) ? $clean['numOfRows'] : 0;
            $temp['numOfCols']     = isset($clean['numOfCols']) ? $clean['numOfCols'] : 0;
            $questionName =  json_encode($temp);
            $answer = json_encode(array_values(array_filter($clean['ans'])));
        }
        if ($_POST['questionType'] == 7) {
            $questionName = $this->ques_matching_data($_POST);
            $answer = $this->ans_matching_data($_POST);
        }
        if ($data['questionType'] == 8) {
            // assignment
            $temp         = $this->processAssignmentTasks($clean);
            $questionName = json_encode($temp);
        }
        if ($_POST['questionType'] == 9) {

            $x = $this->tutor_model->getQuestionInfo(9, $question_id);
            $ques_name = json_decode($x[0]['questionName'], true);

            if (isset($_POST['rightTitle']) || !empty($_POST['rightTitle'])) {
                $question_data['rightTitle'] = $_POST['rightTitle'];
            }
            if (!isset($_POST['rightTitle']) || empty($_POST['rightTitle'])) {
                $question_data['rightTitle'] = $ques_name['rightTitle'];
            }
            if (isset($_POST['rightIntro']) || !empty($_POST['rightIntro'])) {
                $question_data['rightIntro'] = $_POST['rightIntro'];
            }
            if (!isset($_POST['rightIntro']) || empty($_POST['rightIntro'])) {
                $question_data['rightIntro'] = $ques_name['rightIntro'];
            }
            if (isset($_POST['lastpictureSelected']) || !empty($_POST['lastpictureSelected'])) {
                $question_data['lastpictureSelected'] = $_POST['lastpictureSelected'];
            }

            if (isset($_POST['rightConclution']) || !empty($_POST['rightConclution'])) {
                $question_data['rightConclution'] = $_POST['rightConclution'];
            }
            if (!isset($_POST['rightConclution']) || empty($_POST['rightConclution'])) {
                $question_data['rightConclution'] = $ques_name['rightConclution'];
            }

            $wrongTitles = array();
            $wrongTitlesIncrement = array();

            if (!isset($_POST['lastpictureSelected'])) {
                $question_data['lastpictureSelected'] = $ques_name['lastpictureSelected'];
            }

            foreach ($ques_name['wrongTitlesIncrement'] as $key => $value) {
                $wrongTitlesIncrement[] = $value;
            }

            foreach ($ques_name['wrongTitles'] as $key => $value) {
                $wrongTitles[] = $value;
            }

            if (isset($_POST['wrongTitles']) || !empty($_POST['wrongTitles'])) {
                foreach ($_POST['wrongTitles'] as $key => $value) {
                    $wrongTitles[] = $value;
                }
                foreach ($_POST['wrongTitlesIncrement'] as $key => $value) {
                    $wrongTitlesIncrement[] = $value;
                }
            }

            $question_data['wrongTitles'] = $wrongTitles;
            $question_data['wrongTitlesIncrement'] = $wrongTitlesIncrement;

            $wrongIntro = array();
            $wrongIntroIncrement = array();

            foreach ($ques_name['wrongIntro'] as $key => $value) {
                $wrongIntro[] = $value;
            }
            foreach ($ques_name['wrongIntroIncrement'] as $key => $value) {
                $wrongIntroIncrement[] = $value;
            }

            if (isset($_POST['wrongIntro'])) {

                foreach ($_POST['wrongIntro'] as $key => $value) {
                    $wrongIntro[] = $value;
                }
                foreach ($_POST['wrongIntroIncrement'] as $key => $value) {
                    $wrongIntroIncrement[] = $value;
                }
            }

            $question_data['wrongIntro'] = $wrongIntro;
            $question_data['wrongIntroIncrement'] = $wrongIntroIncrement;

            $pictureList = array();
            $wrongPictureIncrement = array();
            $PuzzleParagraph = array();

            foreach ($ques_name['pictureList'] as $key => $value) {
                $pictureList[] = $value;
            }
            foreach ($ques_name['wrongPictureIncrement'] as $key => $value) {
                $wrongPictureIncrement[] = $value;
            }

            if (isset($_POST['pictureList'])) {
                foreach ($_POST['pictureList'] as $key => $value) {

                    if (isset($question_data['lastpictureSelected']) && $value != $question_data['lastpictureSelected']) {
                        $pictureList[] = $value;
                    }
                }

                foreach ($_POST['wrongPictureIncrement'] as $key => $value) {
                    $wrongPictureIncrement[] = $value;
                }
            }

            $question_data['wrongPictureIncrement'] = $wrongPictureIncrement;
            $question_data['pictureList'] = $pictureList;

            $paragraph = array();
            $PuzzleParagraph = array();
            $wrongParagraphIncrement = array();

            foreach ($ques_name['wrongParagraphIncrement'] as $key => $value) {

                $wrongParagraphIncrement[$key] = $value;
                $i = $key;
            }

            if (isset($post['wrongParagraphIncrement'])) {
                foreach ($post['wrongParagraphIncrement'] as $key => $value) {
                    $wrongParagraphIncrement[$i + 1] = $value;
                    $i++;
                }
            }
            $i = 0;

            $question_data['wrongParagraphIncrement'] = $wrongParagraphIncrement;

            $para = $ques_name['Paragraph'];
            foreach ($para as $index => $value) {
                foreach ($value as $key => $val) {
                    if (count($val) == 0) {
                        unset($para[$index][$key]);
                    }
                }
            }
            foreach ($para as $index => $value) {
                if (count($value) == 0) {
                    unset($para[$index]);
                }
            }

            $i = 1;

            foreach ($para as $key => $value) {
                $paragraph[$i] = $value;
                $i++;
            }

            if (isset($_POST['Paragraph'])) {
                foreach ($_POST['Paragraph'] as $key => $value) {
                    if ($value != "") {
                        $paragraph[$i] = $value;
                        $i++;
                    }
                }
            }
            $question_data['Paragraph'] = $paragraph;

            foreach ($ques_name['wrongConclution'] as $key => $value) {
                $wrongConclution[] =  $value;
            }

            if (isset($_POST['wrongConclution'])) {
                foreach ($_POST['wrongConclution'] as $key => $value) {
                    $wrongConclution[] =  $value;
                }
            }

            $question_data['wrongConclution'] = $wrongConclution;

            $wrongConclutionIncrement = array();
            if (isset($ques_name['wrongConclutionIncrement'])) {
                foreach ($ques_name['wrongConclutionIncrement'] as $key => $value) {
                    $wrongConclutionIncrement[] = $value;
                }
            }
            if (isset($_POST['wrongConclutionIncrement'])) {
                foreach ($_POST['wrongConclutionIncrement'] as $key => $value) {
                    $wrongConclutionIncrement[] = $value;
                }
            }
            $question_data['wrongConclutionIncrement'] = $wrongConclutionIncrement;

            if (!empty($question_data['rightTitle']) && !empty($question_data['rightIntro']) && !empty($question_data['lastpictureSelected']) && !empty($question_data['Paragraph']) && !empty($question_data['rightConclution']) && !empty($question_data['wrongTitles']) && !empty($question_data['pictureList']) && !empty($question_data['wrongIntro']) && !empty($question_data['wrongConclution'])) {

                $questionName = json_encode($question_data);
            } else {
                $questionName = "";
            }
        }
        if ($data['questionType'] == 10) {
            $question_data['questionName'] = $post['questionName'];
            $question_data['factor1'] = $post['factor1'];
            $question_data['factor2'] = $post['factor2'];
            $questionName = json_encode($question_data);

            $answer = json_encode($post['result']);
        }
        if ($data['questionType'] == 11) {
            $question_data['questionName'] = $post['question_body'];
            $question_data['operator'] = $post['operator'];

            if ($post['operator'] == '/') {
                $question_data['divisor'] = $post['divisor'];
                $question_data['dividend'] = $post['dividend'];
                $question_data['remainder'] = $post['remainder'];
                $question_data['quotient'] = $post['quotient'];

                $answer = json_encode($post['remainder']);
            }
            if ($post['operator'] != '/') {
                $question_data['item'] = $post['item'];
                $answer = json_encode($post['result']);
            }

            $question_data['numOfRows']     = isset($clean['numOfRows']) ? $clean['numOfRows'] : 0;
            $question_data['numOfCols']     = isset($clean['numOfCols']) ? $clean['numOfCols'] : 0;

            $questionName = json_encode($question_data);
        }
        if ($data['questionType'] == 15) {
            $questionName = $this->save_workout_two($_POST);
            if (isset($_POST['response_answer'])) {
                $answer = $_POST['response_answer'];
            }
        }
        if ($data['questionType'] == 16) {
            $questionName = $this->save_memorization($_POST);
            if (isset($_POST['answer'])) {
                $answer = $_POST['answer'];
            } else {
                $answer = '';
            }
        }
        if ($data['questionType'] == 18) {
            $answers = $_POST['answer'];

            if (!empty($answers)) {
                $questions = array();
                $ans = array();

                foreach ($answers as $answer) {
                    $ans_with_ques = explode(",,", $answer);
                    $questions[] = $ans_with_ques[0];
                    $ans[] = $ans_with_ques[1];
                }
            }

            $questionName = json_encode($questions);
            $answer = json_encode($ans);
            $questionMarks = 15;
            $description = '';
            $instruction_new_array = '';
            $video_new_array = '';
            $solution = 'Nothing';
            // echo "<pre>";print_r($answer);
            // echo "<pre>";print_r($questionName);
            // die();
        }
        if ($data['questionType'] == 19) {
            $answers = $_POST['answer'];

            if (!empty($answers)) {
                $questions = array();
                $ans = array();


                foreach ($answers as $answer) {
                    $ans_with_ques = explode(",,", $answer);
                    $questions[] = $ans_with_ques[0];
                    $ans[] = $ans_with_ques[1];
                }
            }
            $mydata['questions'] = $questions;
            $mydata['wrong_questions'] = $post['wrong_question'];
            // print_r($mydata);die();
            $questionName = json_encode($mydata);
            $answer = json_encode($ans);
            $questionMarks = 15;
            $description = '';
            $instruction_new_array = '';
            $video_new_array = '';
            $solution = 'Nothing';
        }

        if ($_POST['questionType'] == 20) {
            //echo "<pre>";print_r($_POST);die();
            $check_write =1;
            foreach($_POST['options'] as $option){
               if(!empty($option)){
                $check_write =2;
               }
            }
            
            if($check_write==2){
               $answer = $post['option_check'][0];
            }else{
               $answer = "write";
            }
            if(!empty($post['com_question'])){
                $questionName = $post['com_question'];
            }else{
                $questionName = "";
            }
            
            $com_data = array();
            $com_data['options'] = $post['options'];
            $com_data['first_hint'] = $post['first_hint'];
            $com_data['total_rows'] = $post['total_rows'];
            $com_data['title_colors'] = $post['title_colors'];
            $com_data['second_hint'] = $post['second_hint'];
            $com_data['writing_input'] = $post['writing_input'];
            $com_data['text_one_hint'] = $post['text_one_hint'];
            $com_data['text_two_hint'] = $post['text_two_hint'];
            $com_data['com_hint_type'] = $post['com_hint_type'];
            $com_data['image_ques_body'] = $post['image_ques_body'];
            $com_data['option_hint_set'] = $post['option_hint_set'];
            $com_data['text_one_hint_no'] = $post['text_one_hint_no'];
            $com_data['text_two_hint_no'] = $post['text_two_hint_no'];
            $com_data['note_description'] = $post['note_description'];
            $com_data['text_one_hint_color'] = $post['text_one_hint_color'];
            $com_data['text_two_hint_color'] = $post['text_two_hint_color'];
            $com_data['question_title_description'] = $post['question_title_description'];

            $description = json_encode($com_data);
        }
        if ($_POST['questionType'] == 21) {
            $answer = $post['option_check'][0];

            if(!empty($post['com_question'])){
                $questionName = $post['com_question'];
            }else{
                $questionName = "";
            }

            $grammer_data = array();
            $grammer_data['options'] = $post['options'];
            $grammer_data['hint_text'] = $post['hint_text'];
            $grammer_data['total_rows'] = $post['total_rows'];
            $grammer_data['second_hint'] = $post['second_hint'];
            $grammer_data['first_hint'] = $post['first_hint'];
            $grammer_data['second_hint'] = $post['second_hint'];
            $grammer_data['third_hint'] = $post['third_hint'];
            $grammer_data['four_hint'] = $post['four_hint'];
            $grammer_data['color_serial'] = $post['color_serial'];
            $grammer_data['writing_input'] = $post['writing_input'];
            $grammer_data['note_description'] = $post['note_description'];
            $grammer_data['text_one_hint_color'] = $post['text_one_hint_color'];
            $grammer_data['text_two_hint_color'] = $post['text_two_hint_color'];
            $grammer_data['text_four_hint_color'] = $post['text_four_hint_color'];
            $grammer_data['text_three_hint_color'] = $post['text_three_hint_color'];
            $grammer_data['question_title_description'] = $post['question_title_description'];

            $description = json_encode($grammer_data);
        }

        if ($_POST['questionType'] == 22) {
            
            $glossary_data['title_color'] = $post['title_color'];
            $glossary_data['question_title_description'] = $post['question_title_description'];
            $glossary_data['image_ques_body'] = $post['image_ques_body'];

            $questionName = 'no';
            $answer= 'no';
            $questionMarks = 0;
            $description = json_encode($glossary_data);
        }
        if ($_POST['questionType'] == 23) {
            $image_data['image_type_one'] = $post['image_type_one'];
            $image_data['image_type_two'] = $post['image_type_two'];
            $image_data['image_type_three'] = $post['image_type_three'];

            if($image_data['image_type_one']==1){
                $answer = $post['answer_one'];
            }else if($image_data['image_type_two']==1){
                $answer = $post['answer_two'];
            }else if($image_data['image_type_three']==1){
                $answer = $post['answer_three'];
            }
            
            $check_write =1;
            foreach($_POST['options'] as $option){
               if(!empty($option)){
                $check_write =2;
               }
            }

            if($check_write==2){
               $answer = $answer;
            }else{
               $answer = "write";
               $questionMarks = 0;

            }
           
            $image_data['box_one_image'] = $post['box_one_image'];
            $image_data['box_two_image'] = $post['box_two_image'];
            $image_data['box_three_image'] = $post['box_three_image'];

            $image_data['hint_one_image'] = $post['hint_one_image'];
            $image_data['hint_two_image'] = $post['hint_two_image'];
            $image_data['hint_three_image'] = $post['hint_three_image'];

            $image_data['help_check_one'] = $post['help_check_one'];
            $image_data['help_check_two'] = $post['help_check_two'];
            $image_data['help_check_three'] = $post['help_check_three'];
            $image_data['question'] = $post['question'];

            $image_data['total_rows'] = $post['total_rows'];
            $image_data['options'] = $post['options'];
            $image_data['quiz_explaination'] = $post['quiz_explaination'];
            
            $questionName = $post['quiz_question'];

            // echo "<pre>"; print_r($image_data);die();
            $description = json_encode($image_data);
        }

        $data['studentgrade'] = $this->input->post('studentgrade');
        $data['user_id'] = $this->session->userdata('user_id');
        $data['subject'] = $this->input->post('subject');
        $data['chapter'] = $this->input->post('chapter');
        $data['country'] = $this->input->post('country');
        $data['questionName'] = $questionName;
        $data['answer'] = $answer;
        $data['questionMarks'] = $this->input->post('questionMarks');
        $data['questionDescription'] = $description;
        if ($_POST['questionType'] == 18) {
            $data['question_instruction'] = $post['question_instruct'];
        } else {
            $data['question_instruction'] = json_encode($instruction_new_array);
        }
        $data['question_video'] = json_encode($video_new_array);
        $data['isCalculator'] = $this->input->post('isCalculator');
        $data['question_solution'] = $this->input->post('question_solution');
        // echo "<pre>";print_r($data);die();
        if ($data['questionType'] == 15) {
            $data['question_solution'] = $this->input->post('solution');
        }

        if ($data['questionType'] == 14) {
            $array_one = array();
            $array_two = array();
            $array_three = array();


            if (!empty($data["last_id"])) {



                $data['questionMarks'] = "0";
                // 
                // $questionId = $this->tutor_model->insertId('tbl_question', $data);

                $hour   =  $this->input->post('hour');
                $minute =  $this->input->post('minute');
                $second =  $this->input->post('second');

                $data['questionTime'] = $hour . ":" . $minute . ":" . $second;
                
                
                $this->tutor_model->updateInfo('tbl_question', 'id', $question_id, $data);



                $last_id = $this->tutor_model->tutor_update($question_id);


                foreach (json_decode($data['questionName']) as $key => $value) {
                    if (!empty($value->speech_to_text)) {
                        $var = [

                            "speech_to_text" => $value->speech_to_text

                        ];

                        array_push($array_one, $var);
                    }
                }

                foreach (json_decode($data['questionName']) as $key => $value) {
                    if (!empty($value->image)) {
                        $var = [

                            "image" => $value->image

                        ];
                        array_push($array_two, $var);
                    }
                }

                foreach (json_decode($data['questionName']) as $key => $value) {
                    if (!empty($value->Audio)) {
                        $var = [

                            "Audio" => $value->Audio

                        ];
                        array_push($array_three, $var);
                    }
                }

                $a = count($array_one);

                $this->db->select('orders');
                $this->db->from('for_tutorial_tbl_question');
                $this->db->order_by("id", "DESC");
                $this->db->limit(1);

                $orders = $this->db->get()->result_array();

                $b = $orders[0]["orders"] + 1;

                for ($i = 0; $i < $a; $i++) {

                    $this->db->query('INSERT INTO `for_tutorial_tbl_question`(`speech`, `img`, `audio`, `tbl_ques_id` ,`orders` ) VALUES ("' . $array_one[$i]["speech_to_text"] . '", "' . $array_two[$i]["image"] . '" ,  "' . $array_three[$i]["Audio"] . '", ' . $last_id[0]["id"] . ', ' . $b . ' )');

                    $b++;
                }

                echo "update";
            }
        }
        if ($data['questionType'] == 17) {



            if (isset($post['short_question_allow'])) {
                $short_question_allow = $post['short_question_allow'];
            } else {
                $short_question_allow = '';
            }
            if (isset($post['shot_question_title'])) {
                $shot_question_title = $post['shot_question_title'];
            } else {
                $shot_question_title = '';
            }
            if (isset($post['short_ques_body'])) {
                $short_ques_body = $post['short_ques_body'];
            } else {
                $short_ques_body = '';
            }
            if (isset($post['large_question_allow'])) {
                $large_question_allow = $post['large_question_allow'];
            } else {
                $large_question_allow = '';
            }
            if (isset($post['large_question_title'])) {
                $large_question_title = $post['large_question_title'];
            } else {
                $large_question_title = '';
            }
            if (isset($post['large_ques_body'])) {
                $large_ques_body = $post['large_ques_body'];
            } else {
                $large_ques_body = '';
            }
            if (isset($post['student_title'])) {
                $student_title = $post['student_title'];
            } else {
                $student_title = '';
            }
            if (isset($post['word_limit'])) {
                $word_limit = $post['word_limit'];
            } else {
                $word_limit = '';
            }
            if (isset($post['time_hour'])) {
                $time_hour = $post['time_hour'];
            } else {
                $time_hour = '';
            }
            if (isset($post['time_min'])) {
                $time_min = $post['time_min'];
            } else {
                $time_min = '';
            }
            if (isset($post['time_sec'])) {
                $time_sec = $post['time_sec'];
            } else {
                $time_sec = '';
            }
            if (isset($post['allow_idea'])) {
                $allow_idea = $post['allow_idea'];
            } else {
                $allow_idea = '';
            }
            if (isset($post['add_start_button'])) {
                $add_start_button = $post['add_start_button'];
            } else {
                $add_start_button = '';
            }

            $data_idea['short_question_allow'] = $short_question_allow;
            $data_idea['shot_question_title'] = $shot_question_title;
            $data_idea['short_ques_body'] = $short_ques_body;
            $data_idea['large_question_allow'] = $large_question_allow;
            $data_idea['large_question_title'] = $large_question_title;
            $data_idea['large_ques_body'] = $large_ques_body;
            $data_idea['student_title'] = $student_title;
            $data_idea['word_limit'] = $word_limit;
            $data_idea['time_hour'] = $time_hour;
            $data_idea['time_min'] = $time_min;
            $data_idea['time_sec'] = $time_sec;
            $data_idea['allow_idea'] = $allow_idea;
            $data_idea['add_start_button'] = $add_start_button;
            $data_idea['question_id'] = $question_id;


            $idea_id = $this->tutor_model->ideaUpdateId('idea_info', $data_idea, $question_id);



            $datas[] = isset($post['question_instruction']) ? $post['question_instruction'] : '';


            $idea_description = $post['idea_details'];

            $this->db->select('*');
            $this->db->from('idea_description');
            $this->db->where('question_id', 8324);
            $this->db->where('idea_id',  67);
            $this->db->order_by("id", "desc");
            $this->db->limit(1);

            $query = $this->db->get();
            $last_idea = $query->result_array();

            $new_idea_no = $last_idea[0]['idea_no'];

            if (!empty($idea_description)) {
                foreach ($idea_description as $key => $value) {

                    $idea = explode(",", $value);
                    //    print_r($idea);

                    $idea_des['question_id'] = $question_id;
                    $idea_des['idea_id'] = $idea_id;
                    $idea_des['idea_no'] = $new_idea_no;
                    $idea_des['idea_name'] = "Idea" . $idea[0];
                    $idea_des['idea_title'] = $idea[1];
                    $idea_des['idea_question'] = $idea[2];

                    $idea_des_id = $this->tutor_model->idea_des_Id('idea_description', $idea_des);

                    $qstudy_idea['question_id'] = $question_id;
                    $qstudy_idea['idea_id'] = $idea_id;
                    $qstudy_idea['tutor_id'] = $this->session->userdata('user_id');
                    $qstudy_idea['idea_no'] = $new_idea_no;
                    $qstudy_idea['student_ans'] = $idea[2];
                    $qstudy_idea['submit_date'] = date('Y/m/d');
                    $qstudy_idea['total_word'] = $idea[2];
                    $tutor_idea_save = $this->tutor_model->tutor_idea_save('idea_tutor_ans', $qstudy_idea);

                    $new_idea_no++;
                }
            }


            $this->db->truncate('idea_save_temp');
            echo "update";
        } else {
            //echo "<pre>";print_r($data);die();
            $hour   = $this->input->post('hour');
            $minute = $this->input->post('minute');
            $second = $this->input->post('second');

            $data['questionTime'] = $hour . ":" . $minute . ":" . $second;

            if ($_POST['questionType'] == 9) {
                if ($data['questionName']) {
                    $this->tutor_model->updateInfo('tbl_question', 'id', $question_id, $data);
                    echo "update";
                } else {
                    echo "Each part needs a right and wrong Question";
                }
            } else {
                
                $this->tutor_model->updateInfo('tbl_question', 'id', $question_id, $data);
                echo "update";
            }
        }
    }

    private function update_vocabulary()
    {
        $question_id = $this->input->post('question_id');
        $data_image_quantity = $this->input->post('image_quantity');
        $array = array();
        for ($i = 0; $i <= $data_image_quantity; $i++) {
            $image = 'vocubulary_image_' . $i . '[]';
            $desired_image = $this->input->post($image);
            if ($desired_image[0]) {
                $array[] = $desired_image;
            }
        }
        $arr['definition'] = $_POST['definition'];
        $arr['parts_of_speech'] = $_POST['parts_of_speech'];
        $arr['synonym'] = $_POST['synonym'];
        $arr['antonym'] = $_POST['antonym'];
        $arr['sentence'] = $_POST['sentence'];
        $arr['near_antonym'] = $_POST['near_antonym'];
        $arr['vocubulary_image'] = $array;
        $combined_data = json_encode($arr);
        $data['answer'] = $this->input->post['answer'];
        $data['questionName'] = $combined_data;
        $data['subject'] = $this->input->post['subject'];
        $data['chapter'] = $this->input->post['chapter'];
        $data['questionDescription'] = $this->input->post['questionDescription'];
        $this->tutor_model->updateInfo('tbl_question', 'id', $question_id, $data);
        echo $question_id;
    }
    
    
    public function ques_matching_data($post_data)
    {
        $array_1 = array();
        for ($i = 1; $i <= $post_data['image_quantity']; $i++) {
            $array_1[] = $post_data['match_image_1_'.$i];
        }
        $arr['left_side'] = $array_1;

        $array_2 = array();
        for ($i = 1; $i <= $post_data['image_quantity']; $i++) {
            $array_2[] = $post_data['match_image_2_'.$i];
        }

        $arr['right_side'] = $array_2;

        $arr['questionName'] = $post_data['questionName'];
        $combined_data = json_encode($arr);
        return $combined_data;
    }
    
    public function ans_matching_data($post_data)
    {
        $data_answer = array();
        for ($i = 1; $i <= $post_data['image_quantity']; $i++) {
            //            $answer = 'answer_' . $i;
            $data_answer[] = $post_data['answer_'.$i];
        }
        return json_encode($data_answer);
    }
    
    /**
     * process assignment type question form input
     *
     * @param  array $items form input
     * @return string        json object string
     */
    public function processAssignmentTasks(array $items)
    {
        $itemNum = count($items['qMark']);
        $arr     = [];
        $temp    = [];
        $temp['totMarks'] = 0;
        
        for ($a = 0; $a < $itemNum; $a++) {
            $arr[] = json_encode(
                [
                    'serial'      => $a,
                    'qMark'       => $items['qMark'][$a],
                //'obtnMark'    => $items['obtnMark'][$a],
                    'description' => $items['descriptions'][$a],
                ]
            );
            $temp['totMarks'] += $items['qMark'][$a];
        }

        $temp['question_body']    = $items['question_body'];
        $temp['assignment_tasks'] = $arr;
        return $temp;
    }//end processAssignmentTasks()
    
    
    private function save_multiple_choice($post_data)
    {
        for ($i = 1; $i <= $post_data['image_quantity']; $i++) {
            //            $image = 'vocubulary_image_' . $i . '[]';
            $desired_image[] = $post_data['vocubulary_image_'.$i];
        }
        $arr['questionName'] = $post_data['questionName'];
        //new Added AS
        if (isset($_POST['questionName_1_checkbox']) && isset($_POST['questionName_2_checkbox'])) {
            $arr['questionName_2'] = (isset($post_data['questionName_2']))?$post_data['questionName_2']:$post_data['questionNameClick'];
        }
        if ($desired_image) {
            $arr['vocubulary_image'] = $desired_image;
        }

        $combined_data = json_encode($arr);
        return $combined_data;
    }
    
    private function save_multiple_response($post_data)
    {
        for ($i = 1; $i <= $post_data['image_quantity']; $i++) {
            //            $image = 'vocubulary_image_' . $i . '[]';
            $desired_image[] = $post_data['vocubulary_image_'.$i];
        }
        $arr['questionName'] = $post_data['questionName'];
        if ($desired_image) {
            $arr['vocubulary_image'] = $desired_image;
        }

        $combined_data = json_encode($arr);
        return $combined_data;
    }
    // added by sobuj
    public function module_preview($modle_id, $question_order_id)
    {

        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['question_info_s'] = $this->tutor_model->getModuleQuestion($modle_id, $question_order_id, null);
        $data['total_question'] = $this->tutor_model->getModuleQuestion($modle_id, null, 1);
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        if ($data['question_info_s'][0]['question_type']==1) {
            $data['maincontent'] = $this->load->view('module_preview/preview_general', $data, true);
        } elseif ($data['question_info_s'][0]['question_type']==2) {
            $data['maincontent'] = $this->load->view('module_preview/preview_true_false', $data, true);
        } elseif ($data['question_info_s'][0]['question_type']==3) {
            $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['maincontent'] = $this->load->view('module_preview/preview_vocabulary', $data, true);
        } elseif ($data['question_info_s'][0]['question_type']==4) {
            $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['maincontent'] = $this->load->view('module_preview/preview_multiple_choice', $data, true);
        } elseif ($data['question_info_s'][0]['question_type']==5) {
            $data['question_info_vcabulary'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['maincontent'] = $this->load->view('module_preview/preview_multiple_response', $data, true);
        } elseif ($data['question_info_s'][0]['question_type']==7) {
            $data['question_info_left_right'] = json_decode($data['question_info_s'][0]['questionName']);
            $data['maincontent'] = $this->load->view('module_preview/preview_matching', $data, true);
        }
        
        $this->load->view('master_dashboard', $data);
    }

    /**
     * Update tutor account and additional info table
     *
     * @return void
     */
    public function updateProfile()
    {
        $_SESSION['prevUrl'] = base_url('/tutor_setting');
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        $this->form_validation->set_rules('name', 'Name', 'Required');
        if ($this->form_validation->run()==true) {
            $additionalTableData = [
                'address'        =>isset($clean['address'])?$clean['address']:'',
                'city'           =>isset($clean['city'])?$clean['city']:'',
                'state'          =>isset($clean['state'])?$clean['state']:'',
                'post_code'      =>isset($clean['post_code'])?$clean['post_code']:'',
                'phone_num'      =>isset($clean['phone_num'])?$clean['phone_num']:'',
                'website'        =>isset($clean['website'])?$clean['website']:'',
                'short_bio'      =>isset($clean['short_bio'])?$clean['short_bio']:'',
                'teach_subjects' =>isset($clean['teach_subjects'])?$clean['teach_subjects']:'',
                'tutoring_rates' =>isset($clean['tutoring_rates'])?$clean['tutoring_rates']:'',
                'qualification'  =>isset($clean['qualification'])?$clean['qualification']:'',
                'tuition_experience'  =>isset($clean['tuition_experience'])?$clean['tuition_experience']:'',
                'availability'   =>isset($clean['availability'])?$clean['availability']:'',
                'language'       =>isset($clean['language'])?$clean['language']:'',
                'updated_at'     =>date('Y-m-d H:i:s'),
            ];

            $userAccountTableData = [
                'name'          =>$post['name'],
                'country_id'    =>$clean['country_id'],
                'user_email'    =>isset($clean['user_email'])?$clean['user_email']:'',
                'user_mobile'   =>isset($clean['user_mobile'])?$clean['user_mobile']:'',
            ];

            $this->tutor_model->updateInfo('additional_tutor_info', 'tutor_id', $this->loggedUserId, $additionalTableData);
            $this->tutor_model->updateInfo('tbl_useraccount', 'id', $this->loggedUserId, $userAccountTableData);
            
            $this->session->set_flashdata('success_msg', 'Account Updated Successfully');
        } // update tutor account if post has data


        $conditions = [
            'tbl_useraccount.id'=>$this->loggedUserId,
            'tbl_useraccount.user_type'=>3,
        ];
        $tutor = $this->tutor_model->tutorInfo($conditions);
        $data['tutor_info'] = $tutor[0];
        $country = $this->tutor_model->getRow('tbl_country', 'id', $data['tutor_info']['country_id']);
        $data['tutor_info']['country'] = $country['countryName'];
        $data['tutor_info']['country_id'] = $country['id'];
        $studentIds           = $this->tutor_model->allStudents(['sct_id' => $this->loggedUserId]);
        $data['total_std'] = count($studentIds);
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('tutors/update_profile', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function check_student_copy($module_id, $student_id, $question_order_id)
    {
        $data['module_info'] = $this->Student_model->getInfo('tbl_module', 'id', $module_id);

        if (!$data['module_info']) {
            redirect('error');
        }

        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $student_id);

        //****** Get Temp table data for Tutorial Module Type ******
        if ($data['module_info'][0]['moduleType'] != 1) {
            $table = 'tbl_student_answer';
        } else {
            $table = 'tbl_temp_tutorial_mod_ques';
        }

        $data['tutorial_ans_info'] = $this->Student_model->getTutorialAnsInfo($table, $module_id, $student_id);

        $data['question_info_s'] = $this->tutor_model->getModuleQuestion($module_id, $question_order_id, null);

        if (!$data['question_info_s']) {
            $question_order_id = $question_order_id + 1;
            redirect('check_student_copy/' . $module_id . '/' . $student_id . '/' . $question_order_id);
        }

        $data['total_question'] = $this->tutor_model->getModuleQuestion($module_id, null, 1);
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
            $question_box .= '/matching';
        }
        if ($data['question_info_s'][0]['question_type'] == 6) {
            $quesInfo1 = json_decode($data['question_info_s'][0]['questionName']);
            $student_all_ans = json_decode($data['tutorial_ans_info'][0]['st_ans'], true);
            $student_ans = json_decode($student_all_ans[$question_order_id]['student_ans']);
            $student_ans = json_decode($student_ans, true);


            $json_extract = new stdClass;
            foreach ($quesInfo1->skp_quiz_box as $row) {
                $json_extract = json_decode($row);

                if ($json_extract->type == 'a') {
                    $col_extract = explode('_', $json_extract->cr);
                    $json_extract->val = $student_ans[$col_extract[0]][$col_extract[1]]['val'];
                }
                //
                $json_insertion[] = json_encode($json_extract);
            }


            $items = $this->indexQuesAns($json_insertion);
            $data['numOfRows'] = $quesInfo1->numOfRows;
            $data['numOfCols'] = $quesInfo1->numOfCols;
            $data['skp_box'] = $this->renderSkpQuizPrevTable($items, $data['numOfRows'], $data['numOfCols'], $showAns = 1, 'edit');

            $data['questionBody'] = $quesInfo1->question_body;
            $question_box .= '/skip_quiz';
        }
        //        if ($data['module_info'][0]['moduleType'] == 8) {
        //            $this->edit_assignment_question($data);
        //        }

        $data['question_box'] = $this->load->view($question_box, $data, true);

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('tutors/check_student_copy/student_copy', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    // public function input_tutor()
    // {
    //     $qty = $this->input->post('qty', true);

    //     $output ='';
    //     $output .='<table id="example" class="display" >
    //                 <thead>
    //                     <tr>
    //                         <th></th>
    //                     </tr>
    //                 </thead>
    //                 <tbody>';

    //     for ($i=0; $i <$qty ; $i++) { 
    //     $output .='<tr>
    //                 <td>';
    //     $output .='<div class="form-group">
    //                  <div class="col-sm-4"><label for="inputEmail3" class="col control-label">Image file</label></div>
    //                   <div class="col-sm-8">
    //                     <input type="file" id="exampleInputFile" name="Image['.$i.'][Image]" required>
    //                   </div>
    //                 </div><br><br>';              
    //     $output .='<div class="form-group">
    //                   <div class="col-sm-4"><label for="inputEmail3" class="col control-label">Audio File</label></div>
    //                   <div class="col-sm-8">
    //                     <input type="file" id="exampleInputFile" name="audioFile['.$i.'][audioFile]"  required>
    //                   </div>
    //                 </div><br><br>';            
    //     $output .='<div class="form-group">
    //                    <div class="col-sm-4"><label for="spchToTxt" class="col control-label">Speech to text</label></div>
    //                   <div class="col-sm-8">
    //                     <input type="text"  id="spchToTxt" class="form-control" name="speech_to_text['.$i.'][speech_to_text]"  required>
    //                   </div>
    //                 </div><br><br>'; 
         
    //     $output .='</td>
    //               </tr>';                                           
    //     }

    //     $output .='</tbody>
    //             </table>';

    //     $output .='<script type="text/javascript">
    //                     $(document).ready(function() {
    //                     $("#example").DataTable({
    //                         pageLength: 1,
    //                         });
    //                 } );
    //                 </script>';                  
                                
    //     print_r($output);
    // }

    public function input_tutor()
    {
        $qty = $this->input->post('qty', true);
		$qus_type = $this->input->post('qus_type', true);
		if(isset($qus_type) && $qus_type == 4){
			$style = 'none';
		}else{
			$style = 'block';
		}
        $output ='';
		$output_ ='';
        for ($i=0; $i <$qty ; $i++) { 

        $output .='<div class="tab row tabdata'.$i.'">';
        $output .= '<div class="col-md-7">';
        $output .='<div class="form-group">
                     <div class="col-sm-4"><label for="inputEmail3" class="col control-label">Image file</label></div>
                      <div class="col-sm-8">
                        <input type="file" class="img-validate" count_here="Image Field at tab [ '.($i+1).' ] " id="image_'.$i.'" name="Image['.$i.'][Image]" accept=".png"  required>
                        <p style="color:red;" id="img_id_'.$i.'"></p>
                      </div>
                    </div><br><br>';              
        $output .='<div class="form-group" style="display:'.$style.' !important">
                      <div class="col-sm-4"><label for="inputEmail3" class="col control-label">Audio File</label></div>
                      <div class="col-sm-8">
                        <input type="file"  id="audio_'.$i.'" name="audioFile['.$i.'][audioFile]"  accept=".mp3, .mp4">
                        <p style="color:red;" id="aud_id_'.$i.'"></p>
                      </div>
                    </div><br><br>';            
        $output .='<div class="form-group" style="display:'.$style.' !important">
                       <div class="col-sm-4"><label for="spchToTxt" class="col control-label">Speech to text</label></div>
                      <div class="col-sm-8">
                        <input type="text"  id="speech_'.$i.'" class="form-control" name="speech_to_text['.$i.'][speech_to_text]" >
                        <p style="color:red;" id="spch_id_'.$i.'"></p>
                      </div>
                    </div><br><br>';
        $output .='</div>';
        $output .= '<div class="col-md-5">';
        $output .= '<span style="margin-right: 10px;">Accepted Format:<b>.png</b></span>';
        $output .= '<span>Maximum File Size:<b>3MB</b></span>';
        $output .='</div>';
        $output .='</div>';                        
        }

 

        $output .='<div class="row" style="background-color: #3595d6; margin-bottom:0" >
                   
                         <div class="col-sm-12">
                         <div style="float:right; ">
                             <div class="ss_pagination" style="margin-bottom:0">
                              <div>
                                <button class="steprs" style="color: #4c4a4a; border: none; padding: 10px;font-weight: 500;" type="button" id="prevBtn" onclick="nextPrev(-999)" >Previous</button>';

                         for ($i=0; $i <$qty ; $i++) { 
                              $output .='<button style="background: none;border: none; padding: 10px;font-weight: 500;" class="steprs number_'.$i.'" style="width:45px;" id="qty" value="'.$qty.'" type="button" onclick="showFixSlide('.$i.')">'.($i+1).'</button> ';
                         }   

                            $output .='<button type="button" style="color: #4c4a4a; border: none; padding: 10px;font-weight: 500;" class="btn_work" id="nextBtn" onclick="nextPrev(99999)">Next</button>
                          </div>
                         </div>

                        </div>
                     </div>
                 </div>'; 


        // $output .='<div style="text-align:center;margin-top:40px;">';
        // for ($i=0; $i <$qty ; $i++) { 
        //     $output .='<span class="step"></span>';
        // }

        $output .='<script>
                var currentTab = 0;
                $(\'.number_\'+0).addClass("activtab");
                 // Current tab is set to be the first tab (0)
                showTab(currentTab); // Display the current tab

                var qty = $("#qty").val();

                for (i = 0; i < 4; i++) {
                          $(\'.number_\'+i).show();
                        }
                for (i = 4; i < qty; i++) {
                  $(\'.number_\'+i).hide();
                }

                function showTab(n) {
                    $(\'.tab\').hide();
                    $(\'.tabdata\'+n).show();
                }

                function showFixSlide(n) {
                      $(".steprs").each(function( index ) {
                        $(this).removeClass("activtab");
                    })
                   
                        $(\'.number_\'+n).addClass("activtab");

                    
                    console.log(n);
                    
                    currentTab = n;
                    showTab(n);
                    fixStepIndicator(n);
                }


                    function nextPrev(n){

                        //previous clicked
                        if(n <0 ){

                            currentTab = currentTab - 1;
                            if(currentTab<0) currentTab = 0;
                            console.log(currentTab);
                            fixStepIndicator(currentTab);
                            

                        }
                        //next clicked
                        else{

                           currentTab = currentTab + 1;
                           if(currentTab >= qty) currentTab = qty - 1;
                           fixStepIndicator(currentTab);
                            }
                      

                        fixStepIndicator();
                        showTab(currentTab);

                    }


                function fixStepIndicator(currentTab) {

                   x = currentTab;
      // $(".steprs").each(function( index ) {
      //                   $(this).css("background","transparent");
      //               })

                    $(\'.number_\'+parseInt(currentTab - 1)).removeClass("activtab");
                    $(\'.number_\'+parseInt(currentTab + 1)).removeClass("activtab");

                    $(\'.number_\'+currentTab).addClass("activtab");
                   if(x>=3){

                       s_1 = x+2;
                       s_2 = x-2;
                       for (i = s_2; i < s_1 + 1; i++) {
                          $(\'.number_\'+i).show();
                        }
                       for (i = 0; i < s_2; i++) {
                          $(\'.number_\'+i).hide();
                        }
                        for (i = s_1+1; i < qty; i++) {
                          $(\'.number_\'+i).hide();
                        }

                   }
                   if(x<3){

                    for (i = 0; i < 4; i++) {
                          $(\'.number_\'+i).show();
                        }
                    for (i = 4; i < qty; i++) {
                      $(\'.number_\'+i).hide();
                    }

                   }

                   if( x <= qty && x >= qty-4){
                    for (i = qty-5; i < qty; i++) {
                          $(\'.number_\'+i).show();
                        }

                    for (i = 0; i < qty-4; i++) {
                          $(\'.number_\'+i).hide();
                        }

                   }
                }
                </script>';

                                
        print_r($output);
    }

    public function get_vocabulary_word_data()
    {
        $word = $this->input->get('word');

        error_reporting(E_ALL);
        ini_set('display_errors',1);
        $ch = curl_init();
        // set url
        curl_setopt($ch, CURLOPT_URL, "http://18.222.70.201:3000/?word=".$word."");
        curl_setopt($ch,CURLOPT_POST,true);

        //curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_TIMEOUT ,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        // $output contains the output string
        $data = curl_exec($ch);
        // close curl resource to free up system resources
        curl_close($ch);
        echo json_encode($data);
    }
    
    // memorization function create by aftab
    public function save_memorization($post_data)
    {

        $arr = array();
        $arr_data = array();
        $arr['pattern_type'] = $post_data['pattern_type'];
        $arr['hide_component_left'] = $post_data['hide_component_left'];
        $arr['hide_component_right'] = $post_data['hide_component_right'];
        $arr['hide_alphabet'] = $post_data['hide_alphabet'];
        $arr['hide_word'] = $post_data['hide_word'];
        $arr['box_quantity'] = $post_data['box_quantity'];

        if (isset($post_data['questionName']))
        {
            $arr['questionName'] = $post_data['questionName'];
        }else
        {
            $arr['questionName'] = '';
        }
        if ($post_data['pattern_type'] == 1)
        {
            $left_memorize_p_one = array();
            $left_memorize_h_p_one = array();
            $right_memorize_p_one = array();
            $right_memorize_h_p_one = array();
            $checkLeftHidden = 0;
            $checkRightHidden = 0;


            for ($i = 0; $i < $post_data['box_quantity']; $i++) {

                $left_memorize_p_one[] = $post_data['left_memorize_p_one'][$i];
            }
            if ($left_memorize_p_one)
            {
                $arr['left_memorize_p_one'] = $left_memorize_p_one;
            }
            for ($i = 0; $i < $post_data['box_quantity']; $i++) {

                $left_memorize_h_p_one[] = $post_data['left_memorize_h_p_one'][$i];
                if ($post_data['left_memorize_h_p_one'][$i] == 1)
                {
                    $checkLeftHidden = 1;
                }
            }
            if (isset($post_data['hide_pattern_one_left']) && $checkLeftHidden == 0)
            {
                $left_memorize_h_p_one = array();
                for ($i = 0; $i < $post_data['box_quantity']; $i++) {

                    $left_memorize_h_p_one[] = 1;
                }
            }
            if ($left_memorize_h_p_one)
            {
                $arr['left_memorize_h_p_one'] = $left_memorize_h_p_one;
            }

            for ($i = 0; $i < $post_data['box_quantity']; $i++) {

                $right_memorize_p_one[] = $post_data['right_memorize_p_one'][$i];
            }
            if ($right_memorize_p_one)
            {
                $arr['right_memorize_p_one'] = $right_memorize_p_one;
            }
            for ($i = 0; $i < $post_data['box_quantity']; $i++) {

                $right_memorize_h_p_one[] = $post_data['right_memorize_h_p_one'][$i];
                if ($post_data['right_memorize_h_p_one'][$i] == 1)
                {
                    $checkRightHidden = 1;
                }
            }
            if (isset($post_data['hide_pattern_one_right']) && $checkRightHidden == 0)
            {
                $right_memorize_h_p_one = array();
                for ($i = 0; $i < $post_data['box_quantity']; $i++) {

                    $right_memorize_h_p_one[] = 1;
                }
            }
            if ($right_memorize_h_p_one)
            {
                $arr['right_memorize_h_p_one'] = $right_memorize_h_p_one;
            }
            if (isset($post_data['hide_pattern_one_left']) && $post_data['hide_pattern_one_left'] != '')
            {
                $arr['hide_pattern_one_left'] = $post_data['hide_pattern_one_left'];
            }
            if (isset($post_data['hide_pattern_one_right']) && $post_data['hide_pattern_one_right'] != '')
            {
                $arr['hide_pattern_one_right'] = $post_data['hide_pattern_one_right'];
            }

            $arr_data = $arr;
        }elseif ($post_data['pattern_type'] == 2)
        {
            $left_memorize_p_two = array();
            $left_memorize_h_p_two = array();
            $right_memorize_p_two = array();
            $right_memorize_h_p_two = array();
            $checkPTLeftHidden = 0;
            $checkPTRightHidden = 0;


            for ($i = 1; $i <= $post_data['box_quantity']; $i++) {
                $left_memorize_p_two[][0] =str_replace("&#39;","'",$post_data['left_memorize_p_two_'.$i][0]);
                // $left_memorize_p_two[][0] =str_replace("&#39;","'",strip_tags($post_data['left_memorize_p_two_'.$i][0])) ;
            }
            if ($left_memorize_p_two)
            {
                $arr['left_memorize_p_two'] = $left_memorize_p_two;
            }
            for ($i = 1; $i <= $post_data['box_quantity']; $i++) {
                $left_memorize_h_p_two[] = $post_data['left_memorize_h_p_two_'.$i];
                if ($post_data['left_memorize_h_p_two_'.$i][0] == 1)
                {
                    $checkPTLeftHidden = 1;
                }


            }

            if (isset($post_data['hide_pattern_two_left']) && $checkPTLeftHidden == 0)
            {
                $left_memorize_h_p_two = array();
                for ($i = 0; $i < $post_data['box_quantity']; $i++) {

                    $left_memorize_h_p_two[][0] = 1;
                }
            }

            if ($left_memorize_h_p_two)
            {
                $arr['left_memorize_h_p_two'] = $left_memorize_h_p_two;
            }
            for ($i = 1; $i <= $post_data['box_quantity']; $i++) {
                $right_memorize_p_two[][0] = str_replace("&#39;","'",$post_data['right_memorize_p_two_'.$i][0]);
                // $right_memorize_p_two[][0] = str_replace("&#39;","'",strip_tags($post_data['right_memorize_p_two_'.$i][0]));
            }
            if ($right_memorize_p_two)
            {
                $arr['right_memorize_p_two'] = $right_memorize_p_two;
            }
            for ($i = 1; $i <= $post_data['box_quantity']; $i++) {
                $right_memorize_h_p_two[] = $post_data['right_memorize_h_p_two_'.$i];
                if ($post_data['right_memorize_h_p_two_'.$i][0] == 1)
                {
                    $checkPTRightHidden = 1;
                }
            }
            if (isset($post_data['hide_pattern_two_right']) && $checkPTRightHidden == 0)
            {
                $right_memorize_h_p_two = array();
                for ($i = 0; $i < $post_data['box_quantity']; $i++) {

                    $right_memorize_h_p_two[][0] = 1;
                }
            }
            if ($right_memorize_h_p_two)
            {
                $arr['right_memorize_h_p_two'] = $right_memorize_h_p_two;
            }
            if (isset($post_data['hide_pattern_two_left']) && $post_data['hide_pattern_two_left'] != '')
            {
                $arr['hide_pattern_two_left'] = $post_data['hide_pattern_two_left'];
            }
            if (isset($post_data['hide_pattern_two_right']) && $post_data['hide_pattern_two_right'] != '')
            {
                $arr['hide_pattern_two_right'] = $post_data['hide_pattern_two_right'];
            }


            $arr_data = $arr;
        }elseif ($post_data['pattern_type'] == 3)
        {
            
            

            $arr['box_quantity_whiteboard'] = $post_data['box_quantity_whiteboard'];
        
            $whiteboard_memorize_p_three = array();
            $question_step_memorize_p_three = array();
            $clueQuestionStep = array();
            $showExplanationStep = array();

            for ($i = 0; $i < $post_data['box_quantity_whiteboard']; $i++) {
                $whiteboard_memorize_p_three[$i][0] = str_replace("&#39;","'",$post_data['whiteboard_memorize_p_three_'.($i+1)][0]);

            }



            for ($i = 0; $i < $post_data['box_quantity']; $i++) {



                $k = 0;
                for($j= 1;$j < 6;$j++){
                    $clueQuestion = str_replace("&#39;","'",$post_data['clueQuestionStep_'.($i+1).'_'.$j][0]);
                    if ($clueQuestion != null) {
                        $clueQuestionStep[$i][$k] = $clueQuestion;
                        $k = $k + 1;
                    }

                }

                $showExplanationStep[$i][0] = str_replace("&#39;","'",$post_data['showExplanationStep_'.($i+1)][0]);

                $question_step_memorize_p_three[$i][0] = str_replace("&#39;","'",$post_data['question_step_memorize_p_three_'.($i+1)][0]);
                $question_step_memorize_p_three[$i][1] = $clueQuestionStep[$i];
                $question_step_memorize_p_three[$i][2] = $showExplanationStep[$i][0];

                $question_step_memorize_p_three[$i][3]  = str_replace("&#39;","'",($post_data['wrong_answer'.($i+1)][0])?1:0);
                // $question_step_memorize_p_three[$i][4]  = str_replace("&#39;","'",($post_data['wrong_answer'.($i+1)][0])?($i+1):0);
            }


            $arr['whiteboard_memorize_p_three'] =  $whiteboard_memorize_p_three;
            $arr['question_step_memorize_p_three'] =  $question_step_memorize_p_three;
            // $arr['clueQuestionStep']    =  $clueQuestionStep;
            // $arr['showExplanationStep'] =  $showExplanationStep;
            // echo "<pre>";print_r($arr);die();
            $arr_data = json_encode($arr);
            return $arr_data;


            // $left_memorize_h_p_three = array();
            // $right_memorize_h_p_three = array();
            // $checkPThreeLeftHidden = 0;
            // $checkPThreeRightHidden = 0;
            // for ($i = 0; $i < $post_data['box_quantity']; $i++) {
            //     $left_memorize_h_p_three[] = $post_data['left_memorize_h_p_three'][$i];
            //     if ($post_data['left_memorize_h_p_three'][$i] == 1)
            //     {
            //         $checkPThreeLeftHidden = 1;
            //     }
            // }

            // if (isset($post_data['hide_pattern_three_left']) && $checkPThreeLeftHidden == 0)
            // {
            //     $left_memorize_h_p_three = array();
            //     for ($i = 0; $i < $post_data['box_quantity']; $i++) {

            //         $left_memorize_h_p_three[] = 1;
            //     }
            // }

            // if ($left_memorize_h_p_three)
            // {
            //     $arr['left_memorize_h_p_three'] = $left_memorize_h_p_three;
            // }
            // for ($i = 0; $i < $post_data['box_quantity']; $i++) {
            //     $right_memorize_h_p_three[] = $post_data['right_memorize_h_p_three'][$i];
            //     if ($post_data['right_memorize_h_p_three'][$i] == 1)
            //     {
            //         $checkPThreeRightHidden = 1;
            //     }
            // }
            // if (isset($post_data['hide_pattern_three_right']) && $checkPThreeRightHidden == 0)
            // {
            //     $right_memorize_h_p_three = array();
            //     for ($i = 0; $i < $post_data['box_quantity']; $i++) {

            //         $right_memorize_h_p_three[] = 1;
            //     }
            // }
            // if ($right_memorize_h_p_three)
            // {
            //     $arr['right_memorize_h_p_three'] = $right_memorize_h_p_three;
            // }
            // if (isset($post_data['hide_pattern_three_left']) && $post_data['hide_pattern_three_left'] != '')
            // {
            //     $arr['hide_pattern_three_left'] = $post_data['hide_pattern_three_left'];
            // }
            // if (isset($post_data['hide_pattern_three_right']) && $post_data['hide_pattern_three_right'] != '')
            // {
            //     $arr['hide_pattern_three_right'] = $post_data['hide_pattern_three_right'];
            // }
            // $arr_data = $this->pattern_image_upload($arr);
        }elseif($post_data['pattern_type'] == 4)
        {
            $left_memorize_p_four = array();
            $left_memorize_h_p_four = array();
            $right_memorize_p_four = array();
            $right_memorize_h_p_four = array();
            $checkLeftHidden = 0;
            $checkRightHidden = 0;


            for ($i = 0; $i < $post_data['box_quantity']; $i++) {

                $left_memorize_p_four[] = $post_data['left_memorize_p_four'][$i];
            }
            if ($left_memorize_p_four)
            {
                $arr['left_memorize_p_four'] = $left_memorize_p_four;
            }
            for ($i = 0; $i < $post_data['box_quantity']; $i++) {

                $left_memorize_h_p_four[] = $post_data['left_memorize_h_p_four'][$i];
                if ($post_data['left_memorize_h_p_four'][$i] == 1)
                {
                    $checkLeftHidden = 1;
                }
            }
            if (isset($post_data['hide_pattern_four_left']) && $checkLeftHidden == 0)
            {
                $left_memorize_h_p_four = array();
                for ($i = 0; $i < $post_data['box_quantity']; $i++) {

                    $left_memorize_h_p_four[] = 1;
                }
            }
            if ($left_memorize_h_p_four)
            {
                $arr['left_memorize_h_p_four'] = $left_memorize_h_p_four;
            }

            for ($i = 0; $i < $post_data['box_quantity']; $i++) {

                $right_memorize_p_four[] = $post_data['right_memorize_p_four'][$i];
            }
            if ($right_memorize_p_four)
            {
                $arr['right_memorize_p_four'] = $right_memorize_p_four;
            }
            for ($i = 0; $i < $post_data['box_quantity']; $i++) {

                $right_memorize_h_p_four[] = $post_data['right_memorize_h_p_four'][$i];
                if ($post_data['right_memorize_h_p_four'][$i] == 1)
                {
                    $checkRightHidden = 1;
                }
            }
            if (isset($post_data['hide_pattern_four_right']) && $checkRightHidden == 0)
            {
                $right_memorize_h_p_four = array();
                for ($i = 0; $i < $post_data['box_quantity']; $i++) {

                    $right_memorize_h_p_four[] = 1;
                }
            }
            if ($right_memorize_h_p_four)
            {
                $arr['right_memorize_h_p_four'] = $right_memorize_h_p_four;
            }
            if (isset($post_data['hide_pattern_four_left']) && $post_data['hide_pattern_four_left'] != '')
            {
                $arr['hide_pattern_four_left'] = $post_data['hide_pattern_four_left'];
            }
            if (isset($post_data['hide_pattern_four_right']) && $post_data['hide_pattern_four_right'] != '')
            {
                $arr['hide_pattern_four_right'] = $post_data['hide_pattern_four_right'];
            }

            $arr_data = $arr;
        }
        $combined_data = json_encode($arr_data);
        return $combined_data;
    }
    
    public function pattern_image_upload($arr){
        $left_memorize_p_three = array();
        $right_memorize_p_three = array();
        if(isset($_FILES['left_memorize_p_three']['name'])) {

            $this->load->library('upload');
            $zx_id = 1;
            for ($i = 0;$i<$_POST['box_quantity'];$i++)
            {
                $exist = $_FILES["left_memorize_p_three"]['name'][$i];
                if ($exist != '')
                {
                $config['upload_path'] = "assets/uploads";
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = date('YmdHms').'_'.rand(1, 999999);
                $this->upload->initialize($config);
                $_FILES['image']['name']     = $_FILES["left_memorize_p_three"]['name'][$i];
                $_FILES['image']['type']     = $_FILES['left_memorize_p_three']['type'][$i];
                $_FILES['image']['tmp_name'] = $_FILES['left_memorize_p_three']['tmp_name'][$i];
                $_FILES['image']['error']    = $_FILES['left_memorize_p_three']['error'][$i];
                $_FILES['image']['size']     = $_FILES['left_memorize_p_three']['size'][$i];
                if ($this->upload->do_upload('image')) {
                    $uploaded = $this->upload->data();
                    $left_memorize_p_three[] = $uploaded['file_name'];
                }
                }else
                {
                    $left_memorize_p_three[] = $_POST['left_memorize_p_three_'.$zx_id];
                }
                $zx_id++;
            }
        }
        if(isset($_FILES['right_memorize_p_three']['name'])) {
            $this->load->library('upload');
            $ex_id = 1;
            for ($i = 0;$i<$_POST['box_quantity'];$i++)
            {
                $exist = $_FILES["right_memorize_p_three"]['name'][$i];
                if ($exist != '')
                {
                $config['upload_path'] = "assets/uploads";
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = date('YmdHms').'_'.rand(1, 999999);
                $this->upload->initialize($config);
                $_FILES['image']['name']     = $_FILES["right_memorize_p_three"]['name'][$i];
                $_FILES['image']['type']     = $_FILES['right_memorize_p_three']['type'][$i];
                $_FILES['image']['tmp_name'] = $_FILES['right_memorize_p_three']['tmp_name'][$i];
                $_FILES['image']['error']    = $_FILES['right_memorize_p_three']['error'][$i];
                $_FILES['image']['size']     = $_FILES['right_memorize_p_three']['size'][$i];
                if ($this->upload->do_upload('image')) {
                    $uploaded = $this->upload->data();
                    $right_memorize_p_three[] = $uploaded['file_name'];
                }
                }else
                {
                    $right_memorize_p_three[] = $_POST['right_memorize_p_three_'.$ex_id];
                }
                $ex_id++;
            }
        }
        if ($left_memorize_p_three)
        {
            $arr['left_memorize_p_three'] = $left_memorize_p_three;
        }
        if ($right_memorize_p_three)
        {
            $arr['right_memorize_p_three'] = $right_memorize_p_three;
        }
        return $arr ;

    }
    
    public function add_question_tutorial()
    {
        $question_id  = $this->input->post('question_id', true);
        $questionType  = $this->input->post('questionType', true);
		$audioDisplay = 'display:block';
		if($questionType == 4){
			$audioDisplay = 'display:none';
		}
		//echo $audioDisplay;die();
        $tutorials = $this->processTutorial($_POST);
        $array_one = array();
        $array_two = array();
        $array_three = array();
        foreach (json_decode($tutorials) as $key => $value) {
            if (!empty($value->speech_to_text)) {
                $var = [

                    "speech_to_text"=>$value->speech_to_text

                ];

                array_push($array_one, $var);
            }
        }
        foreach (json_decode($tutorials) as $key => $value) {
            if (!empty($value->image)) {
                $var = [

                    "image"=>$value->image

                ];
                array_push($array_two, $var);
            }
        }

        foreach (json_decode($tutorials) as $key => $value) {
            if (!empty($value->Audio)) {
                $var = [

                    "Audio"=>$value->Audio

                ];
                array_push($array_three, $var);
            }
        }
        $a = count($array_one);
        for ($i=0; $i <$a ; $i++) {

            $this->db->query('INSERT INTO `tbl_question_tutorial`(`question_id`, `speech`, `img`, `audio`, `orders` ) VALUES ('.$question_id.', "'.$array_one[$i]["speech_to_text"].'", "'.$array_two[$i]["image"].'" ,  "'.$array_three[$i]["Audio"].'", '.$i.' )');

        }
        $tutorialInfo = $this->tutor_model->getInfo('tbl_question_tutorial', 'question_id', $question_id);
        $html = '';
        foreach($tutorialInfo as $key=>$value)
        {
            $display = 'display:none';
            if ($key == 0)
            {
                $display = 'display:block';
            }
            $html .= '<div class="tab_1 tabdata_1'.$key.'" style="'.$display.'">';
            $html .= '<div style="text-align: right;margin: 8px;"><span title="Delete item" class="delete-tutorial-item" style="cursor: pointer;border: 1px solid #dad9d7;background: #fff;padding: 2px 7px;font-weight: bold;color: #fc0b0b;" item-id="'.$value["id"].'">X</span></div>';
            $html .= '<div class="form-group">';
            $html .= '<div class="col-sm-4"><label for="inputEmail3" class="col control-label">Image file</label></div>';
            $html .= '<div class="col-sm-8">';
            $html .= ' <div class="ss_edit_img">';
            $html .= ' <img src="'.base_url('/').'assets/uploads/'. $value["img"].'">';
            $html .= '</div>';
            $html .= '<div style="margin:10px 0px 30px 0px;">';
            $html .= '<p style="color:red;" id="img_id_<?php echo $key ?>"></p>';
            $html .= '</div></div></div>';
            if ($value["audio"] !="none")
                {
            $html .= '<div class="form-group" style="'.$audioDisplay.'">';
            $html .= '<div class="col-sm-4"><label for="inputEmail3" class="col control-label">Audio File</label></div>';
            $html .= '<div class="col-sm-8">';
                    $html .= '<audio controls>';
                    $html .= '<source src ="'.base_url().'assets/uploads/question_media/'.$value["audio"].'" type="audio/mpeg" >';
                    $html .= '</audio>';
                
            $html .= '<div style="margin:10px 0px 30px 0px;"><p style="color:red;"></p></div>';
            $html .= '</div></div><br><br>';
				}
			
            if ($value["speech"] !="none")
            {
            $html .= '<div class="form-group" style="'.$audioDisplay.'">';
            $html .= '<div class="col-sm-4"><label for="spchToTxt" class="col control-label">Speech to text</label></div>';
            $html .= '<div class="col-sm-8">';
                $html .= 'Speech <div class="col-xs-4" style="font-size: 18px; padding-right:0px">';
                $html .= '<i class="fa fa-volume-up edit_tutorial_speech" value="'.$value["speech"].'"></i>';
                $html .= '<input type="hidden" id="wordToSpeak" value="'.$value["speech"].'"></div>';
            
            $html .= '<div style="margin:20px 0px;">';
            $html .= '<p style="color:red;" id="spch_id_'.$key.'"></p>';
            $html .= '</div></div></div><br><br>';
				}
            $html .= '</div>';
        }
        $html .= '<div class="row" style="background-color: #3595d6; margin-bottom:0; clear: both;" >';
        $html .= '<div class="col-sm-12" style="">';
        $html .= '<div style="float:right;">';
        $html .= '<div class="ss_pagination">';
        $html .= '<div>';
        $html .= '<button class="steprs_1" style="color: #4c4a4a; border: none; padding: 10px;font-weight: 500;" type="button" id="prevBtn1" onclick="nextPrev_1(-999)" >Previous</button>';
        $o = 1;
        foreach($tutorialInfo as $key=>$value)
        {
            $active = '';
            if ($key == 0)
            {
                $active = 'activtab';
            }
                $html .= '<button style="background: none; border: none; padding: 10px;font-weight: 500;" class="steprs_1 number_11'.$key.' '.$active.'" style="width:45px;" id="qty2" value="'.count($tutorialInfo).'" type="button" onclick="showFixSlide_1('.$key.')">'.$o.'</button>';
            $o++;
        }
        $html .= '<button type="button" style="color: #4c4a4a ;border: none; padding: 10px;font-weight: 500;" class="btn_work" id="nextBtn1" onclick="nextPrev_1(99999)">Next</button>';
        $html .= '</div></div></div></div></div>';

        $result = array();
        $result['id'] = '';
        $result['error'] = false;
        $result['success'] = true;
        $result['html'] = $html;
        echo json_encode($result);
    }
    public function question_tutorial_preview()
    {
        $html = '';
        $question_id  = $this->input->post('question_id', true);
        $tutorialInfo = $this->tutor_model->getInfo('tbl_question_tutorial', 'question_id', $question_id);

        foreach($tutorialInfo as $key=>$item)
        {
            $active = '';
            if ($key == 0)
            {
                $active = 'active';
            }
            $html .= '<div class="item '.$active.'" id="'.$item["speech"].'">';
            $html .= '<img width="100%" height="100%" style="max-height: 78vh;" src="'.base_url('/').'assets/uploads/'.$item["img"].'" alt="Tutorial Image">';
            $html .= '<input type="hidden" id="wordToSpeak" value="'.$item["speech"].'">';
            $html .= '</div>';
        }

        echo $html;
    }
    public function delete_question_tutorial_item()
    {
        $html = '';
        $item_id  = $this->input->post('item_id', true);
        $question_id  = $this->input->post('question_id', true);
        $tutorialInfo = $this->tutor_model->getInfo('tbl_question_tutorial', 'id', $item_id);

        if (isset($tutorialInfo[0]['img']))
        {
            $this->tutor_model->deleteInfo('tbl_question_tutorial', 'id', $item_id);
            $img = $tutorialInfo[0]['img'];
            $url = base_url('/').'assets/uploads/'.$img;
//            unlink($url);
        }
        $tutorialInfo = $this->tutor_model->getInfo('tbl_question_tutorial', 'question_id', $question_id);
        $html = '';
        foreach($tutorialInfo as $key=>$value)
        {
            $display = 'display:none';
            if ($key == 0)
            {
                $display = 'display:block';
            }
            $html .= '<div class="tab_1 tabdata_1'.$key.'" style="'.$display.'">';
            $html .= '<div style="text-align: right;margin: 8px;"><span title="Delete item" class="delete-tutorial-item" style="cursor: pointer;border: 1px solid #dad9d7;background: #fff;padding: 2px 7px;font-weight: bold;color: #fc0b0b;" item-id="'.$value["id"].'" >X</span></div>';
            $html .= '<div class="form-group">';
            $html .= '<div class="col-sm-4"><label for="inputEmail3" class="col control-label">Image file</label></div>';
            $html .= '<div class="col-sm-8">';
            $html .= ' <div class="ss_edit_img">';
            $html .= ' <img src="'.base_url('/').'assets/uploads/'. $value["img"].'">';
            $html .= '</div>';
            $html .= '<div style="margin:10px 0px 30px 0px;">';
            $html .= '<p style="color:red;" id="img_id_<?php echo $key ?>"></p>';
            $html .= '</div></div></div>';
			if ($value["audio"] !="none")
            {
				$html .= '<div class="form-group">';
				$html .= '<div class="col-sm-4"><label for="inputEmail3" class="col control-label">Audio File</label></div>';
				$html .= '<div class="col-sm-8">';

					$html .= '<audio controls>';
					$html .= '<source src ="'.base_url().'assets/uploads/question_media/'.$value["audio"].'" type="audio/mpeg" >';
					$html .= '</audio>';

				$html .= '<div style="margin:10px 0px 30px 0px;"><p style="color:red;"></p></div>';
				$html .= '</div></div><br><br>';
			}
			
            if ($value["speech"] !="none")
            {
				$html .= '<div class="form-group">';
				$html .= '<div class="col-sm-4"><label for="spchToTxt" class="col control-label">Speech to text</label></div>';
				$html .= '<div class="col-sm-8">';
				$html .= 'Speech <div class="col-xs-4" style="font-size: 18px; padding-right:0px">';
				$html .= '<i class="fa fa-volume-up edit_tutorial_speech" value="'.$value["speech"].'"></i>';
				$html .= '<input type="hidden" id="wordToSpeak" value="'.$value["speech"].'"></div>';

				$html .= '<div style="margin:20px 0px;">';
				$html .= '<p style="color:red;" id="spch_id_'.$key.'"></p>';
				$html .= '</div></div></div><br><br>';
			}
            $html .= '</div>';
        }
        $html .= '<div class="row" style="background-color: #3595d6; margin-bottom:0; clear: both;" >';
        $html .= '<div class="col-sm-12" style="">';
        $html .= '<div style="float:right;">';
        $html .= '<div class="ss_pagination">';
        $html .= '<div>';
        $html .= '<button class="steprs_1" style="color: #4c4a4a; border: none; padding: 10px;font-weight: 500;" type="button" id="prevBtn1" onclick="nextPrev_1(-999)" >Previous</button>';
        $o = 1;
        foreach($tutorialInfo as $key=>$value)
        {
            $active = '';
            if ($key == 0)
            {
                $active = 'activtab';
            }
            $html .= '<button style="background: none; border: none; padding: 10px;font-weight: 500;" class="steprs_1 number_11'.$key.' '.$active.'" style="width:45px;" id="qty2" value="'.count($tutorialInfo).'" type="button" onclick="showFixSlide_1('.$key.')">'.$o.'</button>';
            $o++;
        }
        $html .= '<button type="button" style="color: #4c4a4a ;border: none; padding: 10px;font-weight: 500;" class="btn_work" id="nextBtn1" onclick="nextPrev_1(99999)">Next</button>';
        $html .= '</div></div></div></div></div>';

        if (!empty($tutorialInfo))
        {
            echo $html;
        }else{
            $html = '<div></div>';
            echo $html;
        }

    }
    public function delete_question_type_tutorial_item()
    {
        $item_id  = $this->input->post('item_id', true);
        $question_id  = $this->input->post('question_id', true);
        $tutorialInfo = $this->tutor_model->getInfo('for_tutorial_tbl_question', 'id', $item_id);

        if (isset($tutorialInfo[0]['img']))
        {
            $this->tutor_model->deleteInfo('for_tutorial_tbl_question', 'id', $item_id);
            $img = $tutorialInfo[0]['img'];
            $url = base_url('/').'assets/uploads/'.$img;
//            unlink($url);
        }
        echo true;
    }
    
    public function question_store()
    {
        $_SESSION['prevUrl'] = base_url('/').'question-list/';
        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $user_id  = $this->session->userdata('user_id');
        $data['allCountry']        = $this->Admin_model->search('tbl_country', [1=>1]);

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
        $data['all_subject']        = $this->tutor_model->getInfo('tbl_question_store_subject', 'created_by', $user_id);
        $data['maincontent'] = $this->load->view('tutors/question/question-store', $data, true);

        $this->load->view('master_dashboard', $data);
    }
    
    public function get_store_subject_amount(){
        
        $subject       = $this->input->post('subject_id');
        $checksubject  = $this->db->where('subject_id',$subject)->get('resource_subject_amount')->row();
        $amount        = (isset($checksubject))?$checksubject->amount:0;
        echo $amount;
    }

    public function get_pdf_serial()
    {
        $country    = '';
        $grade      = '';
        $subject    = '';
        $post       = $this->input->post();
        $clean      = $this->security->xss_clean($post);
        $country    = $clean['country'];
        $grade      = $clean['grade'];
        $subject    = $clean['subject_id'];
        if($country != '' && $grade != '' && $subject != '')
        {
            $conditions['country']   = $country;
            $conditions['grade']     = $grade;
            $conditions['subject']   = $subject;
            $store_data = $this->Student_model->getQuestionStoreOrder($conditions);
            if(!empty($store_data))
            {
                $order = $store_data[0]['pdf_order'];

                $order = $order+1;
                echo $order;
                die;
            }else{

                echo 1;
                die;
            }
        }
        
        die;
    }

    public function save_question_store_data()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('country', 'country', 'required');
        $this->form_validation->set_rules('grade', 'grade', 'required');
        $this->form_validation->set_rules('subject', 'subject', 'required');
        $this->form_validation->set_rules('chapter', 'chapter', 'required');
        $this->form_validation->set_rules('tutor_title', 'tutor title', 'required');
        $this->form_validation->set_rules('student_title', 'student title', 'required');
        $this->form_validation->set_rules('pdf_order', 'pdf order', 'required');
        $this->form_validation->set_rules('student_title', 'student title', 'required');
        if($this->form_validation->run())
          {
            $post = $this->input->post();
            $clean = $this->security->xss_clean($post);
            $clean['media'] = isset($_FILES)?$_FILES:[];
            $user_id = $this->session->userdata('user_id');
            $files = $_FILES;
            $data = array();
            $data['country']        = $clean['country'];
            $data['grade']          = $clean['grade'];
            $data['subject']        = $clean['subject'];
            $data['chapter']        = $clean['chapter'];
            $data['tutor_title']    = $clean['tutor_title'];
            $data['student_title']  = $clean['student_title'];
            $data['pdf_order']      = $clean['pdf_order'];
            $data['questionStoreStatus'] = $clean['questionStoreStatus'];
            $data['tutor_file']     = '';
            $data['student_file']   = '';
            
            $amount  = $clean['amount'];
            $subject = $clean['subject'];
            
            $checksubject  = $this->db->where('subject_id',$subject)->get('resource_subject_amount')->row();
            if(isset($checksubject)){
                $this->db->where('subject_id',$subject)->update('resource_subject_amount',['amount'=>$amount]);
            }else{
                $this->db->insert('resource_subject_amount',['amount'=>$amount,'subject_id'=>$subject]);
            }
            
            foreach($clean['media'] as $key=>$file)
            {
                $config['upload_path'] = 'assets/question-store';
                $config['allowed_types'] = 'pdf';
                $config['overwrite'] = false;
                $this->load->library('upload');
                $config['file_name']=rand(100,9999).'-'.time().'-'.$file['name'];
                 
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($key)) {
                  
                   }else{

                      $imageName = $this->upload->data();
                      if($key == 'tutor_file')
                      {
                        $data['tutor_file'] = 'assets/question-store/'.$imageName["file_name"];
                      }
                      if($key == 'student_file')
                      {
                        $data['student_file'] = 'assets/question-store/'.$imageName["file_name"];
                      }
                      
                   }
            }
            
            if($data['tutor_file'] == '')
               {
                     $array = array(
                        'tutor_file_error'    => "Tutor pdf can't uploaded .please try again.",
                       );
                    $error['error'] = $array;
                    echo json_encode($error);
                    die;
               }
               if($data['student_file'] == '')
               {
                     $array = array(
                        'student_file_error'    => "Student pdf can't uploaded .please try again.",
                       );
                    $error['error'] = $array;
                    echo json_encode($error);
                    die;
               }

                $this->ModuleModel->insertInfo('tbl_questions_store', $data);
                $success['success'] = 'Successfully added';

               echo json_encode($success);
        }else{

            $array = array(
                'country_error'         => form_error('country'),
                'grade_error'           => form_error('grade'),
                'subject_error'         => form_error('subject'),
                'chapter_error'         => form_error('chapter'),
                'tutor_title_error'     => form_error('tutor_title'),
                'pdf_serial_error'      => form_error('pdf_order'),
                'student_title_error'   => form_error('student_title'),
               );
               $error['error'] = $array;
               echo json_encode($error);
               die;
        }
    }

    public function whiteboard_items()
    {

        $user_id = $this->session->userdata('user_id');

        $data['user_info'] = $this->tutor_model->userInfo($user_id);

        $ck_schl_corporate_exist = $this->tutor_model->ck_schl_corporate_exist($data['user_info'][0]['SCT_link'] );
        $data['ck_schl_corporate_exist'] =  $ck_schl_corporate_exist;
        // Newly Added
        //$all_subject_tutor =$this->Student_model->getInfo('tbl_registered_course', 'user_id', $this->session->userdata('user_id'));
        $all_subject_tutor  = $this->Student_model->registeredCourse($this->session->userdata('user_id'));
        $whiteboard = 0;
        foreach ($all_subject_tutor as $key => $value) {
            //$course_id = $value['course_id'];
            $course_id = $value['id'];
            if ($course_id == 53) {
                $whiteboard = 1;
            }

        }
        $data['whiteboard'] = $whiteboard;
        
        //echo $data['whiteboard'];die()
        
        $userInfo = $this->db->where('id',$user_id)->get('tbl_useraccount')->row();
        $parentId = $userInfo->parent_id;
        if($parentId != null){
             $info = $this->db->where('id',$parentId)->get('tbl_useraccount')->row();
             if($info->user_type == 4){
                 $data['school_tutor'] = 1;
             }else{
                 $data['school_tutor'] = 0;
             }
            
        }

        $data['video_help'] = $this->FaqModel->videoSerialize(27, 'video_helps'); //rakesh
        $data['video_help_serial'] = 27;
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true); 
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $data['maincontent'] = $this->load->view('tutors/whiteboard_items', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function tutor_question_store()
    {

        $data['video_help'] = $this->FaqModel->videoSerialize(29, 'video_helps'); //rakesh
        $data['video_help_serial'] = 29;
        
        
        $user_id = $this->session->userdata('user_id');
        //check direct deposit resource
        $tbl_qs_payments = $this->db->where('user_id',$user_id)->where('PaymentEndDate >',time())->order_by('id','desc')->limit(1)->get('tbl_qs_payment')->row();
        $payment_status = $tbl_qs_payments->payment_status;
        $data['deposit_resources_status'] = 3;
        if($payment_status == 'Completed'){
            //$data['deposit_resources_status'] = 1;//active
        }else if($payment_status == 'Pending'){
            //$data['deposit_resources_status'] = 0;//Inactive
        }
        
        $userInfo = $this->db->where('id',$user_id)->get('tbl_useraccount')->row();
        $parentId = $userInfo->parent_id;
        if($parentId != null){
             $info = $this->db->where('id',$parentId)->get('tbl_useraccount')->row();
             if($info->user_type == 4){
                 $data['school_tutor'] = 1;
             }else{
                 $data['school_tutor'] = 0;
             }
            
        }
        
        //echo "<pre>";print_r($data);die;

        $user_id = $this->session->userdata('user_id');
        $data['all_subject'] = $this->tutor_model->getInfo('tbl_question_store_subject', 'created_by',2);
        $data['store_data']  = $this->tutor_model->getQuestionStore();
        $data['user_info']          = $this->tutor_model->userInfo($user_id);
        $data['allCountry']        = $this->Admin_model->search('tbl_country', [1=>1]);
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header']     = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $data['maincontent'] = $this->load->view('tutors/question_store', $data, true);
        $this->load->view('master_dashboard', $data);
      
    }
    public function search_store_view()
    {
        $_SESSION['prevUrl'] = base_url('/').'question-store/';
        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $user_id  = $this->session->userdata('user_id');
        $data['allCountry']        = $this->Admin_model->search('tbl_country', [1=>1]);

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
        $data['all_subject']        = $this->tutor_model->getInfo('tbl_question_store_subject', 'created_by', $user_id);
        $data['maincontent'] = $this->load->view('tutors/question/search-question-store', $data, true);

        $this->load->view('master_dashboard', $data);
    }
    public function search_question_store_info()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('country', 'country', 'required');
        $this->form_validation->set_rules('grade', 'grade', 'required');
        $this->form_validation->set_rules('subject', 'subject', 'required');
        if($this->form_validation->run())
          {
            $post = $this->input->post();
            $clean = $this->security->xss_clean($post);
            $conditions['country']   = $clean['country'];
            $conditions['grade']     = $clean['grade'];
            $conditions['subject']   = $clean['subject'];
            
            $store_data = $this->Student_model->getQuestionStore($conditions);
            $html = '';
            if(!empty($store_data))
            {
                   
                foreach ($store_data as $key => $item) {
                   $chapter_id = $item['chapter'];
                   $chapter =  $this->Student_model->getInfo('tbl_question_store_chapter', 'id',$chapter_id);
                  
                   $html .= '<tr>';
                   $html .= '<td>'.$item['pdf_order'].'</td>';
                   $html .= '<input type="hidden" class="order_number" id="order_number" name="order[]" value="'.$item['id'].'">';
                   $html .= '<td >'.$chapter[0]['chapter_name'].'</td>';
                   $html .= '<td >'.$item['tutor_title'].'</td>';
                   $html .= '<td >'.$item['student_title'].'</td>';
                   $html .= '<td ><button type="button" class="btn btn-success store_edit btn-sm" store_id="'.$item['id'].'" style="margin-right: 5px;">Edit</button><button type="button" class="btn btn-danger btn-sm" onclick="deleteStore('.$item['id'].')">Delete</button></td>';
                   $html .= '</tr>';
                }
            }else
            {
                $html .= 'No data Found!';
            }
                $success['success'] = $html; 
                echo json_encode($success);
               die;
        }else{

            $array = array(
                'country_error'         => form_error('country'),
                'grade_error'           => form_error('grade'),
                'subject_error'         => form_error('subject')
               );
               $error['error'] = $array;
               echo json_encode($error);
               die;
        }
    }
    public function order_question_store()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        $order = $clean['order'];

        if(count($order) > 0)
        {
            $html = '';
            
            $i = 1;
            foreach($order as $id)
            {
                 $data = array(
                    'pdf_order' => $i
                );
                $this->tutor_model->updateInfo('tbl_questions_store', 'id',$id,$data);
                $store_item =  $this->Student_model->getInfo('tbl_questions_store', 'id',$id);
                $chapter_id = $store_item[0]['chapter'];
                $chapter    =  $this->Student_model->getInfo('tbl_question_store_chapter', 'id',$chapter_id);
                $html .= '<tr>';
                   $html .= '<td>'.$store_item[0]['pdf_order'].'</td>';
                   $html .= '<input type="hidden" class="order_number" id="order_number" name="order[]" value="'.$store_item[0]['id'].'">';
                   $html .= '<td >'.$chapter[0]['chapter_name'].'</td>';
                   $html .= '<td >'.$store_item[0]['tutor_title'].'</td>';
                   $html .= '<td >'.$store_item[0]['student_title'].'</td>';
                   $html .= '<td ><button type="button" class="btn btn-success store_edit btn-sm" store_id="'.$store_item[0]['id'].'" style="margin-right: 5px;">Edit</button><button type="button" class="btn btn-danger btn-sm" onclick="deleteStore('.$store_item[0]['id'].')">Delete</button></td>';
                   $html .= '</tr>';
             $i++;
            }

            $success['success'] = $html; 
            echo json_encode($success);
            die;
        }
    }
    public function search_question_store()
    {
        $subject_id = 0;
        $country    = 0;
        $grade      = 0;
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        $user_id = $this->session->userdata('user_id');
        
        $userInfo = $this->db->where('id',$user_id)->get('tbl_useraccount')->row();
        $parentId = $userInfo->parent_id;
        if($parentId != null){
         $info = $this->db->where('id',$parentId)->get('tbl_useraccount')->row();
         if($info->user_type == 4){
             $school_tutor = 1;
         }else{
             $school_tutor = 0;
         }
            
        }
        // echo $school_tutor;die();
        
        
        if($clean['grade'] != '')
        {
            $grade      = $clean['grade'];
        }
        if($clean['subject_id'] != '')
        {
            $subject_id      = $clean['subject_id'];
        }
        if($clean['country'] != '')
        {
            $country      = $clean['country'];
        }
        
        
        //check direct deposit resource
        $tbl_qs_payments = $this->db->where('user_id',$user_id)->where('PaymentEndDate >',time())->where('subject',$subject_id)->order_by('id','desc')->limit(1)->get('tbl_qs_payment')->row();
        $end_date = $tbl_qs_payments->PaymentEndDate;
        $payment_status = $tbl_qs_payments->payment_status;
        
        if($payment_status == 'Completed'){
            $deposit_resources_status = 1;//active
        }else if($payment_status == 'Pending'){
            $deposit_resources_status = 2;//panding
        }else{
            $deposit_resources_status = 0;//Inactive
        }
        
        
        $result['error'] = 0;
        $result['msg'] = '';
        if($subject_id != 0 && $grade != 0)
        {
            $conditions['country']   = $country;
            $conditions['grade']     = $grade;
            $conditions['subject']   = $subject_id;
            
            $resource = $this->db->where('subject_id',$subject_id)->get('resource_subject_amount')->row();
            $amount   = (isset($resource))?$resource->amount:0;

            $store_data = $this->Student_model->getQuestionStore($conditions);
            $html = '';
            if (!empty($store_data)) {
                foreach ($store_data as $key => $item) {
                    $chapter_id = $item['chapter'];
                    $chapter =  $this->Student_model->getInfo('tbl_question_store_chapter', 'id',$chapter_id);
                    $html .= '<tr>';
                    if($school_tutor == 1 ){
                        $html .= '<td><a href="download_tutor_question_store/'.$item['id'].'" store-id'.$item['id'].'>'.$chapter[0]['chapter_name'].'</a></td>';
                    }else{
                        
                        if ($item['questionStoreStatus'] == 'paid') {
                            if($deposit_resources_status == 1){
                                $html .= '<td><a href="download_tutor_question_store/'.$item['id'].'" store-id'.$item['id'].'>'.$chapter[0]['chapter_name'].'</a></td>';
                            }else{
                                $html .= '<td><a store-id'.$item['id'].'>'.$chapter[0]['chapter_name'].'</a></td>';
                            }                      
                        }else{
                            $html .= '<td><a href="download_tutor_question_store/'.$item['id'].'" store-id'.$item['id'].'>'.$chapter[0]['chapter_name'].'</a></td>';
                        }
                    }
                    
                    if($school_tutor == 1 ){
                        $html .= '<td><img style="width:25px;" src="'.base_url('/').'assets/images/pdf-icon2.png">  <p style="font-size: 13px;color: #4a4193;display:inline-block;position: relative;bottom: 7px;left: 10px;">Free</p></td>';
                        
                    }else{
                        
                        if ($item['questionStoreStatus'] == 'paid') {
                            $html .= '<td><img style="width:25px;"src="'.base_url('/').'assets/images/pdf-icon2.png">  <i style="font-size: 20px;color: #dbd526;position: relative;bottom: 7px;left: 10px;" class="fa fa-lock"></i></td>';                        
                        }else{
                            $html .= '<td><img style="width:25px;" src="'.base_url('/').'assets/images/pdf-icon2.png">  <p style="font-size: 13px;color: #4a4193;display:inline-block;position: relative;bottom: 7px;left: 10px;">Free</p></td>';
                        }
                    }
                    $html .= '</tr>';
                } 
            }else{
                $html .= '<tr>';
                $html .= '<td></td>';
                $html .= '<td>No data found!</td>';
                $html .= '</tr>';
            }
            $result['error'] = 0;
            $result['data'] = $html;
            $result['success_amount'] = $amount;
            if($deposit_resources_status == 1){
                $result['href_url'] = "<button class='btn btn-success btn-sm'>Paid</button>"; 
                
            }else if($deposit_resources_status == 2){
                $result['href_url'] = "<button class='btn btn-danger btn-sm'>Pending</button>";
                
            }else{
                $result['href_url'] = ' <a href="questionStorePaymentOption/'.$subject_id.'" style="display: inline-block;">
                          <i class="fa fa-shopping-cart" style="font-size: 35px;margin-left: 5px"></i>
                        </a>'; 
            }
            echo json_encode($result);
            die;
        }
        $result['error'] = 1;
        $result['msg'] = 'Invalid data!';
        echo json_encode($result);
        die;
    }
    public function download_tutor_question_store($id)
    {
        if (is_numeric($id)) {

           $store = $this->Student_model->getInfo('tbl_questions_store', 'id',$id);
           
           if (isset($store[0]['tutor_file'])) {
            $chapter =  $this->Student_model->getInfo('tbl_question_store_chapter', 'id',$store[0]['chapter']);
              $this->load->helper('download');
              $url = $store[0]['tutor_file'];
              $path = base_url().$url;
              $content = file_get_contents($path);
              force_download($chapter[0]['chapter_name'].'.pdf',$content);
           }
        }
    }

    public function edit_question_store()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        $store_id = $clean['store_id'];
        if($store_id != '')
        {
            $store = $this->Student_model->getInfo('tbl_questions_store', 'id',$store_id);
            $tutor_title    = $store[0]['tutor_title'];
            $student_title  = $store[0]['student_title'];

            $result['tutor_title']    = $tutor_title;
            $result['student_title']  = $student_title;
            echo  json_encode($result);
            die;
        }
    }
    public function update_question_store_data()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        $clean['media'] = isset($_FILES)?$_FILES:[];
        $store_id = $clean['store_id'];

        $update_data = array();
        $update_data['tutor_file'] = '';
        $update_data['student_file'] = '';
        foreach($clean['media'] as $key=>$file)
        {
            $config['upload_path'] = 'assets/question-store';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = false;
            $this->load->library('upload');
            $config['file_name']=rand(100,9999).'-'.time().'-'.$file['name'];
            if($file['name'] != ''){
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($key)) {
                  
                }else{

                    $imageName = $this->upload->data();
                    if($key == 'tutor_file'){
                        $update_data['tutor_file']  = 'assets/question-store/'.$imageName["file_name"];
                        $update_data['tutor_title'] = $file['name'];
                    }
                    if($key == 'student_file'){
                        $update_data['student_file']  = 'assets/question-store/'.$imageName["file_name"];
                        $update_data['student_title'] = $file['name'];
                    }
                }    
            }
        }
        $store = $this->Student_model->getInfo('tbl_questions_store', 'id',$store_id);
        $tutor_path     = FCPATH.$store[0]['tutor_file'];
        $student_path   = FCPATH.$store[0]['student_file'];
        
        $data = array();
        if ($update_data['tutor_file'] != '') {
           $data['tutor_file'] = $update_data['tutor_file'];
           $data['tutor_title'] = $update_data['tutor_title'];
           if (file_exists($tutor_path)){
             unlink($tutor_path);
            }
        }
        if ($update_data['student_file'] != '') {
           $data['student_file'] = $update_data['student_file'];
           $data['student_title'] = $update_data['student_title'];
           if (file_exists($student_path)){
             unlink($student_path);
            }
        }
        $this->tutor_model->updateInfo('tbl_questions_store', 'id',$store_id,$data);
        $success['success'] = 'Successfully Updated';
        echo json_encode($success);
        
    }
    
    public function delete_store()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        $store_id = $clean['id'];
        if($store_id)
        {
            $store = $this->Student_model->getInfo('tbl_questions_store', 'id',$store_id);
            $tutor_path     = FCPATH.$store[0]['tutor_file'];
            $student_path   = FCPATH.$store[0]['student_file'];
            if (file_exists($tutor_path)){
                unlink($tutor_path);
            }
            if (file_exists($student_path)){
                unlink($student_path);
            }
            $this->tutor_model->deleteInfo('tbl_questions_store', 'id', $store_id);
            echo 1;
            die;
        }
    }
    public function tutor_progress_type()
    {
        if ($this->session->userdata('userType') == 3) {
            $data['video_help'] = $this->FaqModel->videoSerialize(20, 'video_helps');
            $data['video_help_serial'] = 20;
        }
        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('tutors/tutor_progress_type', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function save_store_subject()
    {
        $result = array();
        $result['success'] = 0;
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        if($clean['new_subject'] != '')
        {
            $data['subject_name']   = $clean['new_subject'];
            $data['created_by']     = $this->session->userdata('user_id');
            $this->ModuleModel->insertInfo('tbl_question_store_subject', $data);
            $subjects = $this->tutor_model->getInfo('tbl_question_store_subject', 'created_by', $this->session->userdata('user_id'));
            $html = '<option>Subject</option>';
            if(count($subjects) > 0)
            {
                foreach($subjects as $subject)
                {
                    $html .= '<option value="'.$subject['id'].'">'.$subject['subject_name'].'</option>';
                }
            }
            
            $result['success'] = 1;
            $result['html'] = $html;
            echo json_encode($result);
            die;
        }
        
        echo json_encode($result);
        die;
    }

    public function save_store_chapter()
    {
        $result = array();
        $result['success'] = 0;
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        if($clean['subject'] == '')
        {
            $result['msg'] = 'Subject is required!';
            echo json_encode($result);
            die;
        }
        if($clean['new_chapter'] == '')
        {
            $result['msg'] = 'Chapter is required!';
            echo json_encode($result);
            die;
        }

        if($clean['subject'] != '' && $clean['new_chapter'])
        {
            $data['chapter_name']        = $clean['new_chapter'];
            $data['subject_id']     = $clean['subject'];
            $data['created_by']     = $this->session->userdata('user_id');
            $this->ModuleModel->insertInfo('tbl_question_store_chapter', $data);
            $chapters = $this->tutor_model->getInfo('tbl_question_store_chapter', 'created_by', $this->session->userdata('user_id'));
            $html = '<option>Chapter</option>';
            if(count($chapters) > 0)
            {
                foreach($chapters as $chapter)
                {
                    $html .= '<option value="'.$chapter['id'].'">'.$chapter['chapter_name'].'</option>';
                }
            }
            
            $result['success'] = 1;
            $result['html'] = $html;
            echo json_encode($result);
            die;
        }
        
        echo json_encode($result);
        die;
    }
    public function get_store_chapter_name()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);

        if($clean['subject_id'] != '')
        {
            $chapters = $this->tutor_model->getInfo('tbl_question_store_chapter', 'subject_id',$clean['subject_id']);

            $html = '<option value="">Chapter</option>';
            if(count($chapters) > 0)
            {
                foreach($chapters as $chapter)
                {
                    $checked = '';
                    if($clean['subject'] == $chapter['id'])
                    {
                        $checked = 'selected';
                    }
                    $html .= '<option '.$checked.' value="'.$chapter['id'].'">'.$chapter['chapter_name'].'</option>';
                }
            }
            echo $html;
        die;
        }
        
    }
    
    public function store_subject_chapter()
    {
        $_SESSION['prevUrl'] = base_url('/').'question-store/';
        
         $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $user_id  = $this->session->userdata('user_id');
        $data['allCountry']        = $this->Admin_model->search('tbl_country', [1=>1]);

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
       
        $data['allSubs'] = $this->renderSubs();
        $data['maincontent'] = $this->load->view('tutors/question/store_subject_chapter', $data, true);

        $this->load->view('master_dashboard', $data);
    }

    public function renderSubs()
    {
         $user_id  = $this->session->userdata('user_id');
         $allSubs  = $this->tutor_model->getInfo('tbl_question_store_subject', 'created_by', $user_id);
         
        $html = '';
        foreach ($allSubs as $sub) {
            $allchaps =  $this->tutor_model->getInfo('tbl_question_store_chapter', 'subject_id', $sub['id']);
           $html .= '<h3>'.$sub['subject_name'].'<button class="subject-edit-btn subject_edit_btn" data-subjectid="'.$sub['id'].'" data-subject_name="'.$sub['subject_name'].'"><i class="fa fa-pencil subject-edit-icon"></i>Edit</button>'.'<button style="float:right;" subId="'.$sub['id'].'" class="btn btn-default delSubBtn"><i class="fa fa-times" ></i> Delete</button></h3>';
            $html .= '<div>';
            $html .= '<table class="table">';
            if (count($allchaps)) {
                $html .= '<thead style="background-color:#CACACA"><tr> <td>Chapter Name</td> <td>Action</td></tr> </thead>';
            }
            $html .= '<tbody>';
            
            foreach ($allchaps as $chap) {
                $html .= '<tr>';
                $html .= '<td>'.$chap['chapter_name'].'</td>';
                $html .= '<td  id="'.$chap['id'].'"><i style="cursor:pointer;" class="fa fa-times delChapIcon"></i></td>';
                $html .= '</tr>';
            }
            $html .='</tbody></table></div>';
        }
        return $html;
    }
    public function delete_store_chapter($id)
    {
        $this->load->model('SubjectModel');
        $chapterExists = $this->SubjectModel->search('tbl_question_store_chapter', ['id'=>$id]);
        
        if (count($chapterExists)) {
            $this->tutor_model->deleteStoreChapter($id);
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function delete_store_subject($id)
    {
        $this->load->model('SubjectModel');
        $subjectExists = $this->SubjectModel->search('tbl_question_store_subject', ['id'=>$id]);

        if (count($subjectExists)) {
            $this->tutor_model->deleteStoreSubject($id);
            echo 'true';
        } else {
            echo 'false';
        }
    }
    
    public function update_store_subject_name()
    {
        $data = array();
        $data['subject_name'] = $this->input->post('subject-name');
        $subject_id = $this->input->post('subject-id');
        $result = $this->tutor_model->updateInfo('tbl_question_store_subject','id',$subject_id,$data);
        echo json_encode('Subject Updated Successfully');
    }

    //story write
    public function edit_storyWriteParts()
    {
       
        $data = $this->tutor_model->getQuestionInfo(9, $_POST['question_id']);

    
        $questionName = json_decode($data[0]['questionName']);

        if ($_POST['type'] == "paragraphBtn") {
            if ($_POST['ans'] == "right_ones_xxx") {
                $title = json_decode($data[0]['questionName'], true);
                $x =  explode("_",$_POST['orderBtn_']);
                $title['Paragraph'][$_POST['paragrapIndex_']][$x[1]] = $_POST['submit_data'];
                $questionName = $title;

            }else{
                $title = json_decode($data[0]['questionName'], true);
                $x =  explode("_",$_POST['orderBtn_']);
                $title['PuzzleParagraph'][$_POST['paragrapIndex_']][$x[1]] = $_POST['submit_data'];
                $questionName = $title;
            }
        }

        if ($_POST['type'] == "pictureBtn") {
            if ($_POST['ans'] == "right_ones_xxx") {
                $title = json_decode($data[0]['questionName'])->lastpictureSelected;
                unset($questionName->lastpictureSelected);
                $questionName->lastpictureSelected = $_POST['submit_data'];

            }else{
                $title = json_decode($data[0]['questionName'] , true);
                $title = $title['pictureList'];
                $title[$_POST['classOder_']] = $_POST['submit_data'];
                $questionName->pictureList = $title;
            }
        }

        if ($_POST['type'] == "conclutionBtn") {
            if ($_POST['ans'] == "right_ones_xxx") {
                $title = json_decode($data[0]['questionName'])->rightConclution;
                unset($questionName->rightConclution);
                $questionName->rightConclution = $_POST['submit_data'];
            }else{

                $title = json_decode($data[0]['questionName'] ,true);
                $title = $title['wrongConclution'];
                $title[$_POST['classOder_']] = $_POST['submit_data'];
                $questionName->wrongConclution = $title;
            }
        }

        if ($_POST['type'] == "introBtn") {

            if ($_POST['ans'] == "right_ones_xxx") {
                $title = json_decode($data[0]['questionName'])->rightIntro;
                unset($questionName->rightIntro);
                $questionName->rightIntro = $_POST['submit_data'];
            }else{
                $title = json_decode($data[0]['questionName'])->wrongIntro;
                $title = ($title['wrongIntro']);
                $title[$_POST['classOder_']] = $_POST['submit_data'];
                $questionName->wrongIntro = $title;
            }

        }

        if ($_POST['type'] == "titleBtn") {
            if ( isset($_POST['ans']) && $_POST['ans'] == "right_ones_xxx") {
                $title = json_decode($data[0]['questionName'])->rightTitle;
                unset($questionName->rightTitle);
                $questionName->rightTitle = $_POST['submit_data'];
            }else{
                $title = json_decode($data[0]['questionName'] , true);
                $title = $title['wrongTitles'];
                $title[$_POST['classOder_']] = $_POST['submit_data'];
                $questionName->wrongTitles = $title;
            }

        }

        $datas['questionName'] = json_encode($questionName);
        $this->tutor_model->updateInfo('tbl_question', 'id', $_POST['question_id'] , $datas);

        echo 1;
    }

    public function remove_storyWriteParts()
    {
        $data = $this->tutor_model->getQuestionInfo(9, $_POST['question_id']);
        $questionName = json_decode($data[0]['questionName']);

        $submit_data = array();

        if ($_POST['type'] == "paragraphBtn") {

            if ($_POST['ans'] == "right_ones_xxx") {
                $title = json_decode($data[0]['questionName'], true);
                //$array =  (array) $title;
                $x =  explode("_",$_POST['orderBtn_']);

                unset($title['Paragraph'][$_POST['paragrapIndex_']][$x[1]]);
                $questionName = $title;

            }else{
                $title = json_decode($data[0]['questionName'], true);
                //$array =  (array) $title;

                $x =  explode("_",$_POST['orderBtn_']);
                unset($title['PuzzleParagraph'][$_POST['paragrapIndex_']][$x[1]]);
                $questionName = $title;
            }
        }

        if ($_POST['type'] == "pictureBtn") {
            $base_url = base_url('/assets/uploads/');

            if ($_POST['ans'] != "right_ones_xxx") {
                $title = json_decode($data[0]['questionName'], true);
                $title = $title['pictureList'];
                unset($title[$_POST['classOder_']]);
                $questionName->pictureList = $title;
            }
        }

        if ($_POST['type'] == "titleBtn") {
            if ($_POST['ans'] != "right_ones_xxx") {
                $x =  $_POST['classOder_'];

                $TitlesIncrement = array();
                $title = array();

                $title = json_decode($data[0]['questionName'] , true);
                $title = $title['wrongTitles'];
                $TitlesIncrement = json_decode($data[0]['questionName'] ,true);
                $TitlesIncrement = $TitlesIncrement['wrongTitlesIncrement'];

                unset($title[$x]);
                unset($TitlesIncrement[$x]);

                $questionName->wrongTitles = $title;
                $questionName->wrongTitlesIncrement = $TitlesIncrement;


            }
        }

        if ($_POST['type'] == "conclutionBtn") {
            if ($_POST['ans'] = "right_ones_xxx") {

                $x =  $_POST['classOder_'];
                $TitlesIncrement = array();
                $title = array();

                $title = json_decode($data[0]['questionName'] , true);
                $title = $title['wrongConclution'];
                unset($title[$x]);
                $questionName->wrongConclution = $title;

            }
        }

        if ($_POST['type'] == "introBtn") {
            if ($_POST['ans'] != "right_ones_xxx") {

                $x =  $_POST['classOder_'];

                $wrongIntroIncrement = array();
                $wrongIntro = array();

                $wrongIntro = json_decode($data[0]['questionName'] , true);
                $wrongIntro = $wrongIntro['wrongIntro'];
                $wrongIntroIncrement = json_decode($data[0]['questionName'] ,true);
                $wrongIntroIncrement = $wrongIntroIncrement['wrongIntroIncrement'];

                unset($wrongIntro[$x]);
                unset($wrongIntroIncrement[$x]);

                $questionName->wrongIntro = $wrongIntro;
                $questionName->wrongIntroIncrement = $wrongIntroIncrement;



            }
        }

        $datas['questionName'] = json_encode($questionName);

        $this->tutor_model->updateInfo('tbl_question', 'id', $_POST['question_id'] , $datas);
    }

    private function upload_photos()
    {
        $config = array();
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|';
    // $config['max_width'] = 1080;
    // $config['max_height'] = 640;
    // $config['min_width']  = 150;
    // $config['min_height'] = 150;
        $config['overwrite'] = false;
        return $config;
    }

    public function upload_photos_control()
    {
        $config = array();
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|';

        $config['file_name']=rand(99,9999).time()."IMG_".$_FILES['file']['name'];

    // $config['max_width'] = 1080;
    // $config['max_height'] = 640;
    // $config['min_width']  = 150;
    // $config['min_height'] = 150;
        $config['overwrite'] = false;

        $this->upload->initialize($config);

        
        if (!$this->upload->do_upload('file')) {
            echo 0;
        } else {
            $imageName = $this->upload->data();
            $user_profile_picture = $imageName['file_name'];
            $data = array(
                'image' => $user_profile_picture
            );

            echo $imageName['file_name'];
        }
    }

    public function WhiteBoardTutor()
    {
        $ckWhiteboard  =  $this->Student_model->getAllInfo_classRoom();
        foreach ($ckWhiteboard as $key => $value) {
            $roomInfo = $this->Student_model->getInfo('tbl_classrooms', 'id', $value['id'] );
            $url_data = $roomInfo[0]['class_url']; 

            $roomInfo = $this->Student_model->deleteInfo('tbl_classrooms', 'id', $value['id']  );
            $toUpdate['in_use'] = 0;
            $this->tutor_model->updateInfo('tbl_available_rooms', 'room_id', $url_data, $toUpdate);
        }

        $data['video_help'] = $this->FaqModel->videoSerialize(28, 'video_helps'); //rakesh
        $data['video_help_serial'] = 28;

        $data['user_info'] = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));

        if ($data['user_info'][0]['subscription_type'] =="direct_deposite") {
            if ( $data['user_info'][0]['direct_deposite'] == 0 ) {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $x = $this->tutor_model->getInfo_Alstudent('tbl_enrollment', 'sct_id' , $this->session->userdata('user_id'));

        $all_student_id =array();
        $all_student_details =array();

        foreach ($x as $key => $value) {
            $all_student_id[] = $value['st_id'];
        }
        foreach ($x as $key2 => $value) {
            $id = $value['st_id'];
            $student = $this->db->where('id',$id)->get('tbl_useraccount')->row();
            $all_student_details[$key2]['id'] = $student->id;
            $all_student_details[$key2]['user_email'] = $student->user_email;
        }
        

        if (count($all_student_id)) {
            $x = $this->tutor_model->getInfo_Alstudent_two('tbl_useraccount', 'id' , $all_student_id);
            $ckExist = array();
            $ckExist = $this->tutor_model->getClassRoomsCk($this->session->userdata('user_id'));
        }else{
            $x =array();
        }
        //echo "<pre>";print_r($all_student_details);die();
        
        $data['all_student'] = $all_student_details;//$x;


        if (isset($ckExist[0]['start_time'] )) {
            $remainder = $ckExist[0]['end_time'];

            $diff = ($remainder) - time();

            if ($diff > 0) {
                $data['ckExist'] = $ckExist;
                $min_hr_sc = round($diff/60);
                $data['min_hr_sc'] = $min_hr_sc;
            }else{
                $roomInfo = $this->Student_model->getInfo('tbl_classrooms', 'id', $ckExist[0]['id'] );
   
                $url_data = $roomInfo[0]['class_url'];  
                $roomInfo = $this->Student_model->deleteInfo('tbl_classrooms', 'id', $ckExist[0]['id']  );
                $toUpdate['in_use'] = 0;
                $this->tutor_model->updateInfo('tbl_available_rooms', 'room_id', $url_data, $toUpdate);
            }
        }
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('tutors/tutor_whiteboard', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function insertClass()
    {
        $flag = 0;
        $pieces = explode("&", $_POST['data']);
        foreach ($pieces as $key => $value) {
            if ( $value == "all_student=all" ) {
                $flag = 1;
                $data['all_student_checked'] = 1;
            }
        }

        if ($flag == 0) {
            foreach ($pieces as $key => $value) {
                if ( $value != "all_student=all" ) {
                    $num[] = preg_replace('/[^0-9]/', '', $value);
                }
            }
            $data['students'] = json_encode($num);
        }
        $user_info = $this->tutor_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['tutor_id'] = $this->session->userdata('user_id');
        $data['tutor_name'] = $user_info[0]['name'];
        $data['start_time'] = time();
        $data['end_time'] = time() + 90 * 60;

        $x = $this->tutor_model->getClassRooms();
        $ckExist = $this->tutor_model->getClassRoomsCk($this->session->userdata('user_id'));

        if (count($x)) {
            if (count($ckExist) == 0) {
                $toUpdate['in_use'] = 1;
                $id = $this->tutor_model->getClassRooms();
                $this->tutor_model->updateInfo('tbl_available_rooms', 'id', $x[0]['id'], $toUpdate);
                $data['class_url'] = $x[0]['room_id'];
                $class_id =  $this->tutor_model->insertId('tbl_classrooms', $data);
                
                $class_url = base_url('/yourClassRoomTutor/').$class_id;

                echo $class_url;
            }else{
                echo 1;
            }
            
        }else{
            echo 0;
        }
    }

    public function yourClassRoom($id)
    {
        $roomInfo = $this->Student_model->getInfo('tbl_classrooms', 'id', $id );

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $user_info = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['ifram'] = '<iframe src="//www.groupworld.net/room/'.$roomInfo[0]['class_url'].'/conf1?need_password=false&janus=true&hide_playback=true&username='.$user_info[0]['name'].'" allow="camera;microphone" width="100%" height="600" scrolling="no" frameborder="0"></iframe>';
        
        $data['maincontent'] = $this->load->view('students/whiteboardDashboard', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function removeClass()
    {
        $roomInfo = $this->Student_model->getInfo('tbl_classrooms', 'id', $_POST['data'] );
       
        $url_data = $roomInfo[0]['class_url'];  
        $roomInfo = $this->Student_model->deleteInfo('tbl_classrooms', 'id', $_POST['data'] );
        $toUpdate['in_use'] = 0;

        $this->tutor_model->updateInfo('tbl_available_rooms', 'room_id', $url_data, $toUpdate);

        echo 1;
    }

    public function input_tutor_two()
    {
        $qty = $this->input->post('qty', true);

        $output ='';
        // $output .='<input class="form-control" type="number" value="'.$qty.'" id="box_qty_2" onchange="getImageBOXSS()">';

        for ($i=0; $i <$qty ; $i++) { 

        $output .='<div class="tab tabdata'.$i.'">';

        $output .='<div class="form-group">
                     <div class="col-sm-4"><label for="inputEmail3" class="col control-label">Image file</label></div>
                      <div class="col-sm-4">';

        foreach ($_POST['imgdata'] as $key => $value) {

        if (strpos($value , "IMG_".($i+1).".")) {
            $output .= '<img src ="'.base_url('/assets/uploads/'.$value).'" style="max-height: 51px;" />';
            $tmpid = $key;
        }

        }

        $output  .='</div>
                      <div class="col-sm-4">
                      <input type="hidden" readonly count_here="Image Field at tab [ '.($i+1).' ] " id="image_'.$i.'" name="Image['.$i.'][Image]" value="'.$_POST['imgdata'][$tmpid].'" required style="width: 249%;margin-left: -163px;">
                      </div>
                      <p style="color:red;" id="img_id_'.$i.'"></p>
                    </div><br><br>';              
        $output .='<div class="form-group">
                      <div class="col-sm-4"><label for="inputEmail3" class="col control-label">Audio File</label></div>
                      <div class="col-sm-8">
                        <input type="file"  id="audio_'.$i.'" name="audioFile['.$i.'][audioFile]"  accept=".mp3, .mp4">
                        <p style="color:red;" id="aud_id_'.$i.'"></p>
                      </div>
                    </div><br><br>';            
        $output .='<div class="form-group">
                       <div class="col-sm-4"><label for="spchToTxt" class="col control-label">Speech to text</label></div>
                      <div class="col-sm-8">
                        <input type="text"  id="speech_'.$i.'" class="form-control" name="speech_to_text['.$i.'][speech_to_text]" >
                        <p style="color:red;" id="spch_id_'.$i.'"></p>
                      </div>
                    </div><br><br>'; 

        $output .='</div>';                         
        }
        // $output .='<script>';
        // for ($i=0; $i <$qty ; $i++) { 
        //     $output .='var myDropzone_'.$i.' = new Dropzone("div#myId_'.$i.'", { url: "story_Upload"}); ';

        //     $output .='myDropzone_'.$i.'.on("complete", function(file) {
        //               $("#image_'.$i.'").val(file.name);
        //             });';
        // }
        //  $output .='</script>';

 

        $output .='<div class="row" style="background-color: #3595d6; margin-bottom:0" >
                   
                         <div class="col-sm-12">
                         <div style="float:right; ">
                             <div class="ss_pagination" style="margin-bottom:0">
                              <div>
                                <button class="steprs" style="color: #4c4a4a; border: none; padding: 10px;font-weight: 500;" type="button" id="prevBtn" onclick="nextPrev(-999)" >Previous</button>';

                         for ($i=0; $i <$qty ; $i++) { 
                              $output .='<button style="background: none;border: none; padding: 10px;font-weight: 500;" class="steprs number_'.$i.'" style="width:45px;" id="qty" value="'.$qty.'" type="button" onclick="showFixSlide('.$i.')">'.($i+1).'</button> ';
                         }   

                            $output .='<button type="button" style="color: #4c4a4a; border: none; padding: 10px;font-weight: 500;" class="btn_work" id="nextBtn" onclick="nextPrev(99999)">Next</button>
                          </div>
                         </div>

                        </div>
                     </div>
                 </div>'; 


        // $output .='<div style="text-align:center;margin-top:40px;">';
        // for ($i=0; $i <$qty ; $i++) { 
        //     $output .='<span class="step"></span>';
        // }

        $output .='<script>
                var currentTab = 0;
                $(\'.number_\'+0).addClass("activtab");
                 // Current tab is set to be the first tab (0)
                showTab(currentTab); // Display the current tab

                var qty = $("#qty").val();

                for (i = 0; i < 4; i++) {
                          $(\'.number_\'+i).show();
                        }
                for (i = 4; i < qty; i++) {
                  $(\'.number_\'+i).hide();
                }

                function showTab(n) {
                    $(\'.tab\').hide();
                    $(\'.tabdata\'+n).show();
                }

                function showFixSlide(n) {
                      $(".steprs").each(function( index ) {
                        $(this).removeClass("activtab");
                    })
                   
                        $(\'.number_\'+n).addClass("activtab");

                    
                    console.log(n);
                    
                    currentTab = n;
                    showTab(n);
                    fixStepIndicator(n);
                }


                    function nextPrev(n){

                        //previous clicked
                        if(n <0 ){

                            currentTab = currentTab - 1;
                            if(currentTab<0) currentTab = 0;
                            console.log(currentTab);
                            fixStepIndicator(currentTab);
                            

                        }
                        //next clicked
                        else{

                           currentTab = currentTab + 1;
                           if(currentTab >= qty) currentTab = qty - 1;
                           fixStepIndicator(currentTab);
                            }
                      

                        fixStepIndicator();
                        showTab(currentTab);

                    }


                function fixStepIndicator(currentTab) {

                   x = currentTab;
      // $(".steprs").each(function( index ) {
      //                   $(this).css("background","transparent");
      //               })

                    $(\'.number_\'+parseInt(currentTab - 1)).removeClass("activtab");
                    $(\'.number_\'+parseInt(currentTab + 1)).removeClass("activtab");

                    $(\'.number_\'+currentTab).addClass("activtab");
                   if(x>=3){

                       s_1 = x+2;
                       s_2 = x-2;
                       for (i = s_2; i < s_1 + 1; i++) {
                          $(\'.number_\'+i).show();
                        }
                       for (i = 0; i < s_2; i++) {
                          $(\'.number_\'+i).hide();
                        }
                        for (i = s_1+1; i < qty; i++) {
                          $(\'.number_\'+i).hide();
                        }

                   }
                   if(x<3){

                    for (i = 0; i < 4; i++) {
                          $(\'.number_\'+i).show();
                        }
                    for (i = 4; i < qty; i++) {
                      $(\'.number_\'+i).hide();
                    }

                   }

                   if( x <= qty && x >= qty-4){
                    for (i = qty-5; i < qty; i++) {
                          $(\'.number_\'+i).show();
                        }

                    for (i = 0; i < qty-4; i++) {
                          $(\'.number_\'+i).hide();
                        }

                   }
                }
                </script>';

                                
        print_r($output);
    }

    public function multiple_choose_q_render()
    {
        $qty = $this->input->post('qty', true);

        for ($i=0; $i < $qty; $i++) { 
            foreach ($_POST['imgdata'] as $key => $value) {
                    if (strpos($_POST['imgdata'][$i] , "IMG_".($key+1).".")) {
                       $img[] = $value;
                    }
                }
        }

        $data['img'] = $img;

        $x =  $this->load->view('tutors/question/question-box/question_multiple_render', $data, true);

        echo $x;
    }

    public function assignModule($id)
    {
        $data['all_modules'] = $this->Admin_model->getInfo('tbl_module', 'course_id', $id );
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);

        $sct_id = $this->loggedUserId;
        $country_id = '';

        $data['course_id'] = $id;

        $studentIds = $this->Student_model->allStudents($sct_id, $country_id);
        $data['students'] = $this->renderStudents($studentIds);

        $data['maincontent'] = $this->load->view('module/moduleAssign', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function moduleSearchFromReorder()
    {
        $post = $this->input->post("courseId");
        $modules = $this->ModuleModel->allModuleForAssign($post , "course_id");
        $html = $this->renderReorderModule($modules , $this->input->post("students") );
        echo count($modules)?$html:'No module found';
    }

    public function renderReorderModule($modules = [] , $std_id )
    {

        $mdlus = $this->ModuleModel->studentAssignedModule($std_id , $this->session->userdata('user_id') );
        $allModuleId = array();
        foreach ($mdlus as $key => $value) {
            $allModuleId[] = $value['assign_module'];
        }

        $row = '';
        foreach ($modules as $key=> $module) {

            if ($module['moduleType'] == 1 ) {
                $moduleType = "Tutorial";
            }if ($module['moduleType'] == 2 ) {
                $moduleType = "Everyday Study";
            }if ($module['moduleType'] == 3 ) {
                $moduleType = "Spacial Exam";
            }if ($module['moduleType'] == 4 ) {
                $moduleType = "Assignment";
            }

            $check = in_array($module["id"], $allModuleId) == 1 ? "checked": ""; 

            $row .= '<tr id="'.$module['id'].'">';
            $row .= '<td>'.date('d-M-Y', $module['exam_date']).'</td>';
            $row .= '<td id="modName"> <a href="module_preview/'.$module['id'].'/1" >'.$module['moduleName'].'</a> </td>';
            $row .= '<td>'.$moduleType .'</td>';
            $row .= '<td>'.$module['subject_name'].'</td>';
            $row .= '<td>'.$module['chapterName'].'</td>';
            $row .= '<td>  <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="'.$module['id'].'" name="assign[]" '.$check.' >
                        <label class="form-check-label">Assign</label>
                      </div>';
            $row .= '</td>';
            $row .= '<tr>';
        }
        return $row;
    }

    public function assignModuleStudent()
    {
        $data['student_id'] = $_POST['studentId'];
        $data['status'] = 1;
        $data['tutor_id'] = $this->session->userdata('user_id');

        $this->ModuleModel->deleteAssignedModule( $_POST['studentId'] , $this->session->userdata('user_id'));
        foreach ($_POST['assign'] as $key => $value) {

            $ckExist = $this->ModuleModel->studentAssignedModuleforUpdate( $_POST['studentId'] , $this->session->userdata('user_id') ,$value );

            if (count($ckExist)) {
            }else{

                $data['assign_module'] = $value;
                $x = $this->ModuleModel->allModuleForAssign($value , "module_id");
                $data['assign_subject'] = $x[0]['subject'];
                $data['subject_name']   = $x[0]['subject_name'];
                $data['chapter_name']   = $x[0]['chapterName'];
                $data['trackerName']    = $x[0]['trackerName'];
                $data['individualName'] = $x[0]['individualName'];
                $data['module_name']    = $x[0]['moduleName'];
                $data['module_type']    = $x[0]['moduleType'];
                $this->ModuleModel->insertInfo("student_homeworks" , $data );
            }
            
        }

        echo 1;
    }

    public function qstudyPassword($qstudyPassword)
    {
        $this->db->from("tbl_setting");
        $this->db->where("setting_key", "qstudyPassword");
        $this->db->where("setting_type", $qstudyPassword);

        $query = $this->db->get()->result_array();

        print_r( count($query) );
    }

    public function question_audio_delete(){
        $question_id = $this->input->post('question_id');
        $type = $this->input->post('question_item');
        $data['question_info'] = $this->tutor_model->getQuestionInfo($type, $question_id);
        $question_info_ind = json_decode($data['question_info'][0]['questionName']);
        unset($question_info_ind->audioFile);

        $upData['questionName'] = json_encode($question_info_ind);
        $this->db->where('id',$question_id)->update('tbl_question',$upData);
        echo 'success';die;
    }
    public function questionStorePaymentOption($subject){

        if ($this->input->post('submit')  == "submit")
        {
            $course_data['totalCost'] = $this->input->post('totalCost');
            $course_data['token']     = $this->input->post('token');
            $course_data['paymentType'] = $this->input->post('paymentType'); 
            $course_data['rs_subject'] = $this->input->post('rs_subject'); 

            if (!empty($this->input->post('no_direct_debit'))) {
                $course_data['payment_process'] = $this->input->post('no_direct_debit');
            }
            if (!empty($this->input->post('direct_deposit'))) {
                $course_data['payment_process'] = $this->input->post('direct_deposit');
            }
            if (!empty($this->input->post('direct_debit'))) {
                $course_data['payment_process'] = $this->input->post('direct_debit');
            }

            $this->session->set_userdata($course_data);

            // echo "<pre>";
            // print_r($course_data);
            // die();

            if ($course_data['payment_process'] == 3) {
                echo $this->session->userdata('userType');
                // echo "<pre>";
                // print_r($course_data);
                // die();
                redirect('/direct_deposit_qus_store');                    
            }else{
                redirect('/qusStorePaymentOption');
            }
        }
        
            // echo $this->session->userdata('registrationType');die;
        
        
        $resource = $this->db->where('subject_id',$subject)->get('resource_subject_amount')->row();
        $data['rs_amount'] = (isset($resource))?$resource->amount:0;
        $data['rs_subject'] = (isset($subject))?$subject:0;
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('tutors/select_payment_option', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function qusStorePaymentOption(){
        $data['video_help'] = $this->FaqModel->videoSerialize(4, 'video_helps');
        $data['video_help_serial'] = 4;

        if ($this->session->userdata('user_id') != '') {
            $data['publish_key']=$this->SettingModel->getStripeKey('publish');
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['header']     = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

            $data['maincontent']= $this->load->view('tutors/qusStore_payment_option', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            redirect('/signup');
        }

    }
    
    public function search_vocubulary_word(){
        $search = $this->input->post('search');
        //echo $search;
        $conditions = [
            'user_id' => 2,
            'questionType' => 3,
        ];
        $conditions_two = [
            'user_id' => 2,
            'questionType' => 3,
            'answer' => $search,
        ];
        $all_question_list= $this->tutor_model->getUserQuestion('tbl_question', $conditions);
        $question_list= $this->tutor_model->getUserQuestion('tbl_question', $conditions_two);
        
        $questions = array();
        $html = '';
        $html .=' <ul class="ss_question_menu" id="v_quesType_3">';
        foreach($question_list as $a => $search_ques){
            $sr_id = $search_ques['id'];
            foreach($all_question_list as $b => $question){
                $qus_id = $question['id'];
                if($sr_id == $qus_id){
                    $b=$b-1;
                    $a = $question[questionType];
                    $serial = 'Q'.($b+1);
                    $questions[$b+1]['id'] = $qus_id;
                    $questions[$b+1]['answer'] = $question[answer];
                    $questions[$b+1]['questionType'] = $question[questionType];
                    $questions[$b+1]['questionNumber'] = 'Q'.($b+1);
                    $html .= '<li class="main_li" style="background-color:#7f7f7f;" datas-id="'.$a.'_'.$qus_id.'" id="qu_'.($b+1).'_'.$qus_id.'">';
                    $html .= '<a href="question_edit/'.$a.'/'.$qus_id.'" style="position: relative;">'.$serial.'</a>';
                    $html .= '</li>';
                   
                }

            }
            
        }
        $html .= '</ul>';
        echo $html;
    }

    public function tutor_students_list(){
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('tutors/tutor_students_list', $data, true);
        $this->load->view('master_dashboard', $data);
    } 
    public function tutor_my_student_list(){
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('tutors/tutor_my_student_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function idea_create_student_details($idea_id,$student_id,$question_id){
        
        $data['student_ans_details']= $this->tutor_model->get_student_ans($idea_id,$student_id,$question_id);
        // echo "<pre>";print_r($data['student_ans_details']);die();
        $data['tutor_id'] = $this->session->userdata('user_id');
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('tutors/idea_create_student_details', $data, true);
        $this->load->view('master_dashboard', $data);
    } 
    public function tutor_qstudy_students_list(){
        
        $user_id = $this->session->userdata('user_id');
        $data['my_student'] =  $this->tutor_model->getMyStudents($user_id);
        // echo "<pre>";print_r($data['my_student']);
        // die();
 
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('tutors/tutor_qstudy_students_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function tutor_qstudy_students_list_student($grade){

        $user_id = $this->session->userdata('user_id');
        $data['get_students'] = $this->tutor_model->grade_by_students($grade,$user_id);

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('tutors/tutor_qstudy_students_list_student', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function idea_create_tutor($student_id,$grade){ 
        
        $data['student_ideas'] = $this->tutor_model->get_all_ideas($student_id);
        $data['student_info'] = $this->tutor_model->get_student_info($student_id);
        $data['grade'] = $grade;
        
        // echo "<pre>";print_r($data['student_ideas']);die();

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('tutors/idea_create_tutor', $data, true);
        $this->load->view('master_dashboard', $data);
    } 
    public function teacher_check_workout(){
        $student_id = $this->input->post("student_id");
        $idea_id = $this->input->post("idea_id");
        $idea_no = $this->input->post("idea_no");
        $tutor_id = $this->input->post("tutor_id");
        $question_id = $this->input->post("question_id");
        $module_id = $this->input->post("module_id");

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
        
        $image_url = base_url().$file;
        
        
        $data2['student_id']=$student_id; 
        $data2['idea_id']=$idea_id;
        $data2['idea_no']=$idea_no;
        $data2['checker_id']=$tutor_id;
        $data2['by_admin_or_tutor']=2;
        $data2['question_id']=$question_id;
        $data2['module_id']=$module_id;
        $data2['checked_image_url']=$image_url;
       

        // $this->db->insert('tutor_idea_check_workout',$data);
        $insert_id = $this->Tutor_model->getTutorIdeaCheckId('idea_check_workout',$data2);

        echo $insert_id;
    }
    public function idea_create_student_report($checkout_id){
        
        $data['this_idea'] = $this->tutor_model->get_this_idea($checkout_id);
        $data['all_idea']  = $this->tutor_model->get_ideas($checkout_id);
        $data['teacher_workout']  = $this->tutor_model->get_teacher_workout($checkout_id);
        
        $data['student_id'] = $data['this_idea'][0]['student_id'];
        
       
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('tutors/idea_create_student_report', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function get_single_idea(){
        $student_id = $this->input->post("student_id");
        $idea_id = $this->input->post("idea_id");
        $get_idea = $this->tutor_model->idea_get($student_id,$idea_id);
        echo json_encode($get_idea);
        
    }
    public function correction_report_save(){

       $data['total_point'] = $this->input->post("total_point");
       $data['teacher_correction'] = $this->input->post("teacher_correction");
        if(!empty($this->input->post("teacher_comment"))){
            $data['teacher_comment'] = $this->input->post("teacher_comment");
        }else{
            $data['teacher_comment'] = '';
        }
       $data['idea_correction'] = $this->input->post("idea_correction");
       $data['checked_checkbox'] = json_encode($this->input->post("checked_checkbox"));
       $data['student_id'] = $this->input->post("student_id");
       $data['idea_id'] = $this->input->post("idea_id");
       $data['idea_no'] = $this->input->post("idea_no");
       $data['question_id'] = $this->input->post("question_id");
       $data['module_id'] = $this->input->post("module_id");
       $data['significant_checkbox'] = $this->input->post("significant_checkbox");
       $data['checker_id'] = $this->session->userdata('user_id');
       $data['by_admin_or_tutor'] = 2;

       $correction = $this->tutor_model->idea_correction_report_save("idea_correction_report",$data);
       if($correction > 1){
            echo 1;
        }else{
            echo 2;
        }
    }

    public function studyType()
    {
     
        $id=1;
        $data['user_info'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        if ($id == 1) {
            $data['video_help'] = $this->FaqModel->videoSerialize(16, 'video_helps');
            $data['video_help_serial'] = 16;
        }
        if ($id == 2) {
            $data['video_help'] = $this->FaqModel->videoSerialize(17, 'video_helps');
            $data['video_help_serial'] = 17;
        }

        $_SESSION['prevUrl'] = base_url('/') . 'Tutor/organization';
        $_SESSION['prevUrl_after_student_finish_buton'] = base_url('/') . $_SERVER['PATH_INFO'];

        $data['types'] = $id;

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('tutors/study_type', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function all_tutors_by_type($tutor_id, $module_type,$is_practice=0)
    {
        
        // echo $is_practice."hello";die();
        $_SESSION['show_tutorial_result'] = 0;
        $data['tutor_id'] = $tutor_id;
        $data['module_type'] = $module_type;
        $session_module_info = $this->session->userdata('data');

       

        $this->session->unset_userdata('data');
        $this->session->unset_userdata('obtained_marks');
        $this->session->unset_userdata('total_marks');
        $this->session->unset_userdata('isFirst');


        $data['moduleType'] = $module_type;
        $data['tutorInfo'] = $this->Student_model->getInfo('tbl_useraccount', 'id', $tutor_id);
        // echo "<pre>";
        // print_r($data);die();
   
        $data['user_info'] = $this->Student_model->userInfo(754);
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
              
                $registered_courses = $this->Student_model->registeredCourse(754);

                
                $studentSubjects = array();
                if (count($registered_courses) > 0) {
                    $oreder_s = 0;

                    foreach ($registered_courses as $sub) {

                        $assign_course = $this->Student_model->getInfo('tbl_assign_subject', 'course_id', $sub['id']);
                        

                        if (!empty($assign_course)) {
                            $subjectId = json_decode($assign_course[0]['subject_id']);

                            foreach ($subjectId as $key => $value) {

                                $sb =  $this->Student_model->getInfo('tbl_subject', 'subject_id', $value);
                               
                                if (!empty($sb)) {
                                    $studentSubjects[$oreder_s]['subject_id'] = $sb[0]['subject_id'];
                                    $studentSubjects[$oreder_s]['subject_name'] = $sb[0]['subject_name'];
                                    $studentSubjects[$oreder_s]['created_by'] = $sb[0]['created_by'];
                                }
                                $oreder_s++;
                            }
                        }
                    }
                }
                $subject_with_course = $studentSubjects;
            }


            
        }

        if ($tutor_id == 2) {
            $data['registered_courses'] = $this->Student_model->registeredCourse(754);

            $first_course_subjects = array();
            if (isset($data['registered_courses'][0]['id'])) {
                $first_course = $data['registered_courses'][0]['id'];
                $course_id = $first_course;
                if (isset($course_id) && $course_id != '') {
                    $assign_course = $this->Student_model->getInfo('tbl_assign_subject', 'course_id', $course_id);
                    if (!empty($assign_course)) {
                        $subjectId = json_decode($assign_course[0]['subject_id']);

                        $sb =  $this->Student_model->getInfo_subjects('tbl_subject', 'subject_id', $subjectId);
                    }
                }
            }

            if (isset($sb) && $sb != '') {
                $data['first_course_subjects'] = $sb;
                $data['first_course_id'] = $first_course;
                //$data['studentSubjects'] = $sb;
            }
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
        
       
        $this->session->set_userdata('is_practice', $is_practice);

        $assignModuleByTutor = array();
        $assignModuleByTutor = $this->ModuleModel->tutorHomework($tutor_id, $module_type);
        $data['assignModuleByTutorSubjectID'] = $assignModuleByTutor;

        // echo "<pre>";
        // echo $module_type;die();
  
        
        $data['has_back_button'] = 'student';
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('Tutors/module/all_module_list', $data, true);

        $this->load->view('master_dashboard', $data);
    }
    
    public function studentsModuleByQStudyNew()
    {
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
            $conditions = array(
                'subject'              => $subjectId,
                'course_id'            => $courseId,
                'chapter'              => $chapterId,
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
                // $all_module = $this->ModuleModel->allModule(array_filter($conditions));
                $all_module = $this->ModuleModel->allModule(array_filter($conditions), $studentGrade_country[0]['country_id']);
            } else {
                $all_module = $this->Student_model->all_module_by_type($tutorInfo[0]['user_type'], $desired_result, $result, $conditions);
            }
            // echo '<pre>';print_r($all_module);die;
            // $data['maincontent'] = $this->load->view('students/qstudy_module/all_tutorial_list', $data, true);
        } else { //module created by general tutor
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

        // $all_module = $this->ModuleModel->allModule(array_filter($conditions));

        $new_array  = array();
        $sct_info  = array();

        //echo '<pre>';print_r($all_module);die;

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

        if ($moduleType == 2) {
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
            
            $this->show_all_module($all_module);
        }
    }
    public function show_all_module($allModule)
    {
        // echo "hello445554";
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
                        $row .= '<td><a onclick="get_permission(' . $module['id'] . ')" href="javascript:;">' . $module['moduleName'] . '</a></td>';
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
    public function tutor_student_idea_setting($question_id,$idea_id,$student_id,$module_id){
        $data['student_idea'] = $this->tutor_model->student_idea_details($question_id,$idea_id,$student_id,$module_id);
        // $data['student_info'] = $this->tutor_model->get_student_info($student_id);
        $data['grade'] = 1;
        
        // echo "<pre>";print_r($data['student_idea']);die();

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('tutors/tutor_student_idea_setting', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function view_tutor_idea()
    {
        $idea_id=$this->input->post('idea_id');
        $this->db->select('*');
        $this->db->from('question_ideas');
        $this->db->join('tbl_useraccount', 'question_ideas.user_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('question_ideas.id', $idea_id);
        $query = $this->db->get();
        $result=$query->row_array();
        echo json_encode($result);
    }

    public function teacher_given_idea_point()
    {
        $data['student_id']= $this->input->post('student_id');
        $data['module_id']= $this->input->post('module_id');
        $data['question_id']= $this->input->post('question_id');
        $data['teacher_id']=$this->input->post('user_id');
        $data['idea_id']=$this->input->post('idea_id');
        $data['title_comment']=$this->input->post('title_comment');
        $data['title_mark']= $this->input->post('total_title_mark');
        $data['spelling_error_mark']= $this->input->post('total_spelling_mark');
        $data['spelling_error']=$this->input->post('spelling_error_value');
        $data['creative_sentence_mark']=$this->input->post('creative_sentence_mark');
        $data['creative_sentence_index']=$this->input->post('creative_sentence_index');
        $data['introduction_sentence_index']= $this->input->post('every_introduction_index');
        $data['introduction_comment']= $this->input->post('introduction_auto_comment_value');
        $data['introduction_mark']=$this->input->post('introduction_point');
        $data['body_paragraph_sentence_index']=$this->input->post('every_body_index');
        $data['body_paragraph_comment']=$this->input->post('body_paragraph_auto_comment_value');
        $data['body_paragraph_mark']= $this->input->post('body_paragraph_point');
        $data['conclution_sentence_index']=$this->input->post('every_conclusion_index');
        $data['conclution_comment']=$this->input->post('conclusion_auto_comment_value');
        $data['conclution_mark']=$this->input->post('conclusion_point');

        $datas['admin_seen']=1;
        //echo "<pre>";print_r($data);die();
        $this->db->insert('tutor_remake_idea_info',$data);
        $this->db->where('student_id',$this->input->post('student_id'))->where('question_id',$this->input->post('question_id'))->update('idea_student_ans',$datas);
        $datas['success']='successfully insert';

        echo json_encode($datas);
    }

    public function upload_idea_story_options(){
        $return=array();
		if($_FILES['file']['name'] != ''){
			$config['upload_path'] = './assets/idea_image/idea_options';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES['file']['name'];
			//  $config['min_width']  = '200';
			//  $config['min_height']  = '200';

            //Load upload library and initialize here configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('file')){ 
				$uploadData = $this->upload->data();
				$main_image = $uploadData['file_name'];
				echo $main_image;
                // die();
				// $this->_create_thumbs($uploadData['file_name']);
                
			}else{
                //print_r($this->upload->display_errors());die();
				$return['main_image_error']	= array('error' => $this->upload->display_errors());
				return $return;
			}
		}
    }

    public function teacher_idea_correction_save()
    {
        $title['title_option_one']=$this->input->post('title_option_one');
        $title['title_option_one_hint']=$this->input->post('title_option_one_hint');
        $title['title_option_two']=$this->input->post('title_option_two');
        $title['title_option_two_hint']=$this->input->post('title_option_two_hint');
        $title['title_option_three']=$this->input->post('title_option_three');
        $title['title_option_three_hint']=$this->input->post('title_option_three_hint');
        $title['title_option_four']=$this->input->post('title_option_four');
        $title['title_option_four_hint']=$this->input->post('title_option_four_hint');

        $image['option_one_image']=$this->input->post('option_one_image');
        $image['option_two_image']=$this->input->post('option_two_image');
        $image['option_three_image']=$this->input->post('option_three_image');
        $image['option_four_image']=$this->input->post('option_four_image');
        $image['image_option_points']=$this->input->post('image_option_points');
        $image['image_option_ans']=$this->input->post('image_option_ans');
        $image['option_one_image_texts']=$this->input->post('option_one_image_texts');

        

        $ss_intro['ss_intro_option_one']=$this->input->post('ss_intro_option_one');
        $ss_intro['ss_intro_option_one_hint']=$this->input->post('ss_intro_option_one_hint');
        $ss_intro['ss_intro_option_two']=$this->input->post('ss_intro_option_two');
        $ss_intro['ss_intro_option_two_hint']=$this->input->post('ss_intro_option_two_hint');
        $ss_intro['ss_intro_option_three']=$this->input->post('ss_intro_option_three');
        $ss_intro['ss_intro_option_three_hint']=$this->input->post('ss_intro_option_three_hint');
        $ss_intro['ss_intro_option_four']=$this->input->post('ss_intro_option_four');
        $ss_intro['ss_intro_option_four_hint']=$this->input->post('ss_intro_option_four_hint');

        $ss_body['ss_body_paragraph_option_one']=$this->input->post('ss_body_paragraph_option_one');
        $ss_body['ss_body_paragraph_option_one_hint']=$this->input->post('ss_body_paragraph_option_one_hint');
        $ss_body['ss_body_paragraph_option_two']=$this->input->post('ss_body_paragraph_option_two');
        $ss_body['ss_body_paragraph_option_two_hint']=$this->input->post('ss_body_paragraph_option_two_hint');
        $ss_body['ss_body_paragraph_option_three']=$this->input->post('ss_body_paragraph_option_three');
        $ss_body['ss_body_paragraph_option_three_hint']=$this->input->post('ss_body_paragraph_option_three_hint');
        $ss_body['ss_body_paragraph_option_four']=$this->input->post('ss_body_paragraph_option_four');
        $ss_body['ss_body_paragraph_option_four_hint']=$this->input->post('ss_body_paragraph_option_four_hint');

        $ss_conclution['ss_conclution_option_one']=$this->input->post('ss_conclution_option_one');
        $ss_conclution['ss_conclution_option_one_hint']=$this->input->post('ss_conclution_option_one_hint');
        $ss_conclution['ss_conclution_option_two']=$this->input->post('ss_conclution_option_two');
        $ss_conclution['ss_conclution_option_two_hint']=$this->input->post('ss_conclution_option_two_hint');
        $ss_conclution['ss_conclution_option_three']=$this->input->post('ss_conclution_option_three');
        $ss_conclution['ss_conclution_option_three_hint']=$this->input->post('ss_conclution_option_three_hint');
        $ss_conclution['ss_conclution_option_four']=$this->input->post('ss_conclution_option_four');
        $ss_conclution['ss_conclution_option_four_hint']=$this->input->post('ss_conclution_option_four_hint');

        $data['module_id']= $this->input->post('module_id');
        $data['question_id']= $this->input->post('question_id');
        $data['student_id']= $this->input->post('student_id');
        $data['teacher_id']=$this->input->post('user_id');
        $data['idea_id']=$this->input->post('idea_id');

        $data['total_title_mark']= $this->input->post('total_title_mark');
        $data['spelling_error_value']= $this->input->post('spelling_error_value');
        $data['total_spelling_mark']= $this->input->post('total_spelling_mark');
        $data['creative_sentence_mark']=$this->input->post('creative_sentence_mark');
        $data['creative_sentence_index']=$this->input->post('creative_sentence_index');

        $data['introduction_point']=$this->input->post('introduction_point');
        $data['body_paragraph_point']= $this->input->post('body_paragraph_point');
        $data['conclusion_point']=$this->input->post('conclusion_point');

        $data['other_total_spelling_mark']=$this->input->post('other_total_spelling_mark');
        $data['other_spelling_error_value']=$this->input->post('other_spelling_error_value');

        $data['other_creative_sentence_index']=$this->input->post('other_creative_sentence_index');
        $data['other_creative_sentence_mark']=$this->input->post('other_creative_sentence_mark');

        $data['image']= json_encode($image);
        $data['title']= json_encode($title);
        $data['ss_intro']= json_encode($ss_intro);
        $data['ss_body']= json_encode($ss_body);
        $data['ss_conclution']= json_encode($ss_conclution);

        $data['admin_seen']=1;
        // echo "<pre>";print_r($data);die();
        $this->db->select('*');
        $this->db->from('tutor_correction_idea_info');
        $this->db->where('module_id',$this->input->post('module_id'));
        $this->db->where('student_id',$this->input->post('student_id'));
        $this->db->where('idea_id',$this->input->post('idea_id'));
        $query = $this->db->get();
        $check_insert = $query->result_array();
       
        if(empty($check_insert)){
            $this->db->insert('tutor_correction_idea_info',$data);
            $datas['success']='successfully insert';
            $datas['status']=1;
        }else{
            $datas['success']='Already insert';
            $datas['status']=2;
        }
        

        // $this->db->where('student_id',$this->input->post('student_id'))->where('question_id',$this->input->post('question_id'))->update('idea_student_ans',$datas);
        

        echo json_encode($datas);
    }

    public function get_chapter_info(){
        $subject_id = $this->input->post('subject_id');
        $chapter_id = $this->input->post('chapter_id');
        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('chapter',$chapter_id);
        $query = $this->db->get();
        $results = $query->result_array();
        // echo "<pre>";print_r($results);die();

        $this->db->select('*');
        $this->db->from('tbl_chapter');
        $this->db->where('subjectId',$subject_id);
        $query = $this->db->get();
        $result = $query->result_array();

        $data['chapter_id'] = $chapter_id;
        $data['chapter_use'] = count($results);
        $data['chapters'] = $result;
        echo json_encode($data);
        
    }

    public function chapter_moved_to_question(){
        $from_chapter_id = $this->input->post('from_chapter_id');
        $to_chapter_id = $this->input->post('to_chapter_id');

        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('chapter',$from_chapter_id);
        $query = $this->db->get();
        $results = $query->result_array();
        //echo "<pre>";print_r($results[0]);die();
        $i=0;
        if(!empty($results)){
            foreach($results as $question){
                $data['chapter'] = $to_chapter_id;

                $this->db->where('id', $question['id']);
                $this->db->update('tbl_question', $data);
            $i++;
            }
        }
        $this->db->where('id', $from_chapter_id);
        $this->db->delete('tbl_chapter');

        echo $i;
        
    }
}

