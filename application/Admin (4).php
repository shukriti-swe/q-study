<?php

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        $this->loggedUserId = $user_id;
        
        if ($user_id == null && $user_type == null) {
            redirect('welcome');
        }
        if ($user_type != 0) {
            redirect('welcome');
        }
        
        $this->load->library('Ajax_pagination');
        $this->load->model('Admin_model');
        $this->load->model('Tutor_model');
        $this->load->model('QuestionModel');
        $this->load->helper('commonmethods_helper');
    }
    
    /**
     * Function index() doc comment
     *
     * @return void
     */
    public function index()
    {
        $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/admin_dashboard', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function course_theme()
    {
        $data['all_theme'] = $this->Admin_model->getAllInfo('tbl_course_theme');
        $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/theme/course_theme', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function save_theme()
    {
        $data['theme_name'] = $this->input->post('theme_name');
        //        print_r($data);die;
        $this->Admin_model->insertInfo('tbl_course_theme', $data);
        $data['all_theme'] = $this->Admin_model->getAllInfo('tbl_course_theme');
        
        $json = array();
        $json['themeDiv'] = $this->load->view('admin/theme/theme_div', $data, true);
        echo json_encode($json);
    }
    
    public function all_area()
    {
        //        $data['all_theme'] = $this->Admin_model->getAllInfo('tbl_course_theme');
        $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = '';
        $data['page_section'] = '';
        
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/all_area/all_area', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function contact_mail()
    {
        $data['all_contacts'] = $this->Admin_model->getAllInfo('user_message');
        $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Contact List';
        $data['page_section'] = 'Contact';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/contacts/contact_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function user_list()
    {
        $data['total_registered'] = $this->Admin_model->total_registered();
        $data['today_registered'] = $this->Admin_model->today_registered();
        $data['tutor_with_10_student'] = $this->Admin_model->tutor_with_10_student();

        $trial = 0;
        $guest = 0;
        $pending = 0;
        $total_registeredCount = 0;
        $today_registeredCount = 0;

        foreach ($data['total_registered'] as $key => $value) {

            if ( ( $value['subscription_type'] == 'signup' || $value['subscription_type'] == 'direct_deposite' ) && $value['end_subscription'] != "" ) {

                if ( $value['end_subscription'] >= date("Y-m-d") ) {
                    $total_registeredCount++;
                }

            }

            if ( ( $value['subscription_type'] == 'signup' || $value['subscription_type'] == 'direct_deposite' ) && $value['end_subscription'] != "" ) {

                if ( date("Y-m-d" , $value['created'] ) == date("Y-m-d") ) {
                    $today_registeredCount++;
                }
            }


            if ($value['subscription_type'] == "trial" ) {
                $trial++;
            }

            if ($value['subscription_type'] == "guest" ) {
                $guest++;
            }

            if ($value['subscription_type'] == "direct_deposite"  &&  $value['direct_deposite'] == 0 ) {
                $pending++;
            }
        }


        $data['trial'] = $trial;
        $data['guest'] = $guest;
        $data['pending'] = $pending;

        $data['total_registeredCount'] = $total_registeredCount;
        $data['today_registeredCount'] = $today_registeredCount;

        
        $data['tutor_with_50_vocabulary'] = $this->Admin_model->tutor_with_50_vocabulary();
        date_default_timezone_set('Australia/Canberra');
        $date = date('Y-m-d');
        $data['get_todays_data'] = $this->Admin_model->get_todays_data($date);
        
        $data['user_type'] = $this->Admin_model->getAllInfo('tbl_usertype');
        $data['all_country'] = $this->Admin_model->getAllInfo('tbl_country');
        
        $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'User List';
        $data['page_section'] = 'User';

        $groupboard_assigner = $this->Admin_model->groupboard_req();

        if (count($groupboard_assigner)) {
            $groupboard_taker = $this->Admin_model->groupboard_taker();
        }
        $groupboard_require = count($groupboard_assigner) - count($groupboard_taker);

        print_r($groupboard_assigner);
        print_r($groupboard_taker);

        die;

        $data['groupboard_require'] = $groupboard_require;
        $data['groupboard_assigner'] = array_values($groupboard_assigner[0]);
        $data['groupboard_taker'] = array_values($groupboard_taker[0]);

        $total_whiteboard = $this->Admin_model->getInfo('tbl_registered_course', 'course_id', 53 ); //rakesh

        
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/user_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function userAdd()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        if (!$post) {

            $data['user_type'] = $this->Admin_model->getAllInfo('tbl_usertype');
            $data['all_country'] = $this->Admin_model->getAllInfo('tbl_country');

            $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
            $data['parents'] = $this->Admin_model->getInfo('tbl_useraccount', 'user_type', 1);
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            $data['page'] = 'User List';
            $data['page_section'] = 'User';

            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

            $data['maincontent'] = $this->load->view('admin/user/user_add', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            $dataToSave = [
                'user_type'=> $clean['userType'],
                'country_id' => $clean['country'],
                'children_number' => isset($clean['numOfChild']) ? $clean['numOfChild'] : null,
                'name' => $clean['name'],
                'user_email' => $clean['email'],
                'user_pawd' => md5($clean['password']),
                // 'user_mobile' => $clean['mobile'],
                'user_mobile' => $clean['full_phone'],
                'SCT_link' => $clean['refLink'],
                'created' => time(),
                'subscription_type' => $clean['subscription_type'],
                'suspension_status' => (isset($clean['suspension_status']) && $clean['suspension_status']==1) ? 0:1,
                'parent_id' => isset($clean['parentId']) ? $clean['parentId']:null,
                'token' => null,
                'image' => null,
                'payment_status' => '',
            ];

            if ($clean['subscription_type'] == "guest") {
                $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
                $settins_sms_messsage = $this->admin_model->getSmsType("Tutor Registration");

                $register_code_string = $settins_sms_messsage[0]['setting_value'];
                $message = str_replace( "{{ username }}" , $dataToSave['user_email'] , $register_code_string);
                $message = str_replace( "{{ password }}" ,  $clean['password'] , $message);

                $api_key = $settins_Api_key[0]['setting_value'];
                $content = urlencode($message);

                $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $clean['full_phone'] . "&content=$content";

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

            }


            $insertedUserId=$this->Admin_model->insertId('tbl_useraccount', $dataToSave);
            $additionalTableData = array();
            $additionalTableData['tutor_id'] = $insertedUserId;
            $additionalTableData['created_at'] = date('Y-m-d h:i:s');
            $additionalTableData['updated_at'] = date('Y-m-d h:i:s');
            $this->Admin_model->insertInfo('additional_tutor_info', $additionalTableData);
            //if inserted user is not parent/child then record registered courses
            if ($clean['userType']!=1 || $clean['userType']!=6) { //parent, student
                if (count($clean['course'])) {
                    $courseUserMap = [];
                    foreach ($clean['course'] as $course) {
                        $courseUserMap[] = [
                            'course_id' => $course,
                            'user_id' => $insertedUserId,
                            'created' => time(),
                        ];
                    }
                    $this->Admin_model->insertBatch('tbl_registered_course', $courseUserMap);
                }
            }

            //if inserted user is a parent then insert his/her child too
            $userPass = [];
            if ($clean['userType']==1 && $dataToSave['children_number']) {
                $childToSave;
                $totChild = $dataToSave['children_number'];

                for ($a=0; $a<$totChild; $a++) {
                    $pass = substr(md5(rand()), 0, 7);
                    $userPass[] = [
                        'childName' => $clean['childName'][$a],
                        'childPass' => $pass,
                        'refLink'   => $clean['childSCTLink'][$a],
                    ];

                    $childToSave = [
                        'name' => $clean['childName'][$a],
                        'user_email' => explode(' ', $clean['childName'][$a])[0], //first part of a name
                        'user_pawd' => md5($pass),
                        'parent_id' => $insertedUserId,
                        'user_type' => 6,
                        'country_id' => $clean['country'],
                        'student_grade' => $clean['childGrade'][$a],
                        'SCT_link' => $clean['childSCTLink'][$a],
                        'created' => time(),
                        'subscription_type' => $clean['subscription_type'],
                    ];
                    $childId = $this->Admin_model->insertInfo('tbl_useraccount', $childToSave);

                    $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
                    $settins_sms_messsage = $this->admin_model->getSmsType("Parent Registration");

                    $register_code_string = $settins_sms_messsage[0]['setting_value'];
                    $message = str_replace( "{{ username }}" , $dataToSave['user_email'] , $register_code_string);
                    $message = str_replace( "{{ password }}" ,  $clean['password'] , $message);
                    $message = str_replace( "{{ C_username }}" , $childToSave['user_email'] , $message);
                    $message = str_replace( "{{ C_password }}" , $pass , $message);

                    $api_key = $settins_Api_key[0]['setting_value'];
                    $content = urlencode($message);

                    $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $clean['full_phone'] . "&content=$content";

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

                    //if course requested, map as registered course with student id
                    if (count($clean['course'])) {
                        $courseUserMap = [];
                        foreach ($clean['course'] as $course) {
                            $courseUserMap[] = [
                                'course_id' => $course,
                                'user_id' => $childId,
                                'created' => time(),
                            ];
                        }
                        $this->Admin_model->insertBatch('tbl_registered_course', $courseUserMap);
                    }
                }
                //$this->Admin_model->insertBatch('tbl_useraccount', $childToSave);
            }

            //send mail to registered users
            if ($clean['userType']) {
                userRegMail($clean['name'], $clean['userType'], $clean['email'], $clean['password'], $userPass);
            }
            
            
             if ($_POST['userType'] == 2 ) {
                
                $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
                $settins_sms_messsage = $this->admin_model->getSmsType("Upper level student");

                $register_code_string = $settins_sms_messsage[0]['setting_value'];
                $message = str_replace( "{{ username }}" , $dataToSave['user_email'] , $register_code_string);
                $message = str_replace( "{{ password }}" ,  $clean['password'] , $message);

                $api_key = $settins_Api_key[0]['setting_value'];
                $content = urlencode($message);

                $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $clean['full_phone'] . "&content=$content";

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

            }

            if ($_POST['userType'] == 3 ) {
                
                $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
                $settins_sms_messsage = $this->admin_model->getSmsType("Tutor Registration");

                $register_code_string = $settins_sms_messsage[0]['setting_value'];
                $message = str_replace( "{{ username }}" , $dataToSave['user_email'] , $register_code_string);
                $message = str_replace( "{{ password }}" ,  $clean['password'] , $message);

                $api_key = $settins_Api_key[0]['setting_value'];
                $content = urlencode($message);

                $url = "https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=" . $clean['full_phone'] . "&content=$content";

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

            }
            

            $this->session->set_flashdata('success_msg', 'User added successfully');
            redirect('user_list');
        }
    }

    public function edit_user($user_id)
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        if (!$clean) {
            $data['userId'] = $user_id;
            $data['user_type'] = $this->Admin_model->getAllInfo('tbl_usertype');
            $data['all_country'] = $this->Admin_model->getAllInfo('tbl_country');

            $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $user_id);

            if ($data['user_info'][0]['user_type']==1) { //parent
                $conditions = ['parent_id'=>$user_id];
                $data['allChild'] = $this->Admin_model->search('tbl_useraccount', $conditions);
            } elseif ($data['user_info'][0]['user_type']==6) { //child
                $conditions = ['id'=>$user_id];
                $data['parent'] = $this->Admin_model->search('tbl_useraccount', $conditions);
            }

            $data['courses'] = $this->coursesByCountry($data['user_info'][0]['country_id'], $data['user_info'][0]['id'], $type = "edit" , $data['user_info'][0]['subscription_type'] );  //whiteboard rakesh

            $data['whiteboard'] = $this->Admin_model->whiteboardPurches('tbl_registered_course', $user_id);  //whiteboard rakesh 

            
            $data['parents'] = $this->Admin_model->getInfo('tbl_useraccount', 'user_type', 1);
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            $data['page'] = 'Edit User';
            $data['page_section'] = 'User';

            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

            $data['maincontent'] = $this->load->view('admin/user/user_edit', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            //$dataToUpdate = array_filter($clean);

            $trial_end_date = null;
            if (isset($clean['trial_end_date']))
            {
                $trial_configuration = $this->Admin_model->getInfo('tbl_setting', 'setting_key', 'days');
                if (isset($trial_configuration[0]['setting_value']))
                {
                    $Date = date('Y-m-d');
                    $trial_end_date = date('Y-m-d', strtotime($Date. ' + '.$trial_configuration[0]['setting_value'].' days'));
                }
            }

            if (!empty( $clean['user_pawd'] )) {
                $dataToUpdate = [
                    'user_type'=> $clean['user_type'],
                    'country_id' => $clean['country_id'],
                    'children_number' => isset($clean['numOfChild']) ? $clean['numOfChild'] : null,
                    'name' => $clean['name'],
                    'user_email' => $clean['user_email'],
                    'student_grade' => isset($clean['grade']) ? $clean['grade'] : null,
                    'user_mobile' => $clean['full_phone'],
                    'trial_end_date' => $trial_end_date,
                    // 'user_mobile' => $clean['user_mobile'],
                    'user_pawd'=> md5($clean['user_pawd']),
                    'SCT_link' => $clean['SCT_link'],
                    'subscription_type' => $clean['subscription_type'],
                    'suspension_status' => (isset($clean['suspension_status']) && $clean['suspension_status']==1)? 0 : 1,
                    'direct_deposite' => (isset($clean['direct_deposite']) && $clean['direct_deposite']==1)? 1 : 0,
                ];

            }else{
                $dataToUpdate = [
                    'user_type'=> $clean['user_type'],
                    'country_id' => $clean['country_id'],
                    'children_number' => isset($clean['numOfChild']) ? $clean['numOfChild'] : null,
                    'name' => $clean['name'],
                    'user_email' => $clean['user_email'],
                    'student_grade' => isset($clean['grade']) ? $clean['grade'] : null,
                    'user_mobile' => $clean['full_phone'],
                    'trial_end_date' => $trial_end_date,
                    // 'user_mobile' => $clean['user_mobile'],
                    'SCT_link' => $clean['SCT_link'],
                    'subscription_type' => $clean['subscription_type'],
                    'suspension_status' => (isset($clean['suspension_status']) && $clean['suspension_status']==1)? 0 : 1,
                    'direct_deposite' => (isset($clean['direct_deposite']) && $clean['direct_deposite']==1)? 1 : 0,
                ];
            }
            
            
            
            //if course requested, map as registered course with student id
            if (count($clean['course'])) {
                $courseUserMap = [];
                foreach ($clean['course'] as $course) {
                    $courseUserMap[] = [
                        'course_id' => $course,
                        'user_id' => $user_id,
                        'created' => time(),
                    ];
                }
                //remove previous records
                $this->Admin_model->deleteInfo('tbl_registered_course', 'user_id', $user_id);
                //insert new courses
                $this->Admin_model->insertBatch('tbl_registered_course', $courseUserMap);
            }



            $this->Admin_model->updateInfo('tbl_useraccount', 'id', $user_id, $dataToUpdate);
            $this->session->set_flashdata('success_msg', 'User updated successfully');
            /* if ($this->db->affected_rows() == 1) {
            } else {
                $this->session->set_flashdata('error_msg', 'User account not updated, somthing is wrong.');
            }*/
            redirect('edit_user/'.$user_id);
        }
    }

    /**
     * Delete user and associated info
     *
     * @return void
     */
    public function deleteUser()
    {
        $post = $this->input->post();
        $uId = $post['uId'];
        $userInfo = $this->Admin_model->getRow("tbl_useraccount", 'id', $uId);
        $uType = $userInfo['user_type'];

        if ($uType==6 || $uType==2) { //1-12 lvl student, $upper lvl student
            //delete student answers
            $this->Admin_model->deleteInfo("tbl_student_answer", 'st_id', $uId);
            //delete progress
            $this->Admin_model->deleteInfo("tbl_studentprogress", 'student_id', $uId);
            //delete registered couse
            $this->Admin_model->deleteInfo("tbl_registered_course", 'user_id', $uId);
            //delete enrollment
            $this->Admin_model->deleteInfo("tbl_enrollment", 'st_id', $uId);
        } elseif ($uType==3 || $uType==4 || $uType==5 || $uType==7) { //tutor,school, corporate,q-study,
            //delete additional tutor info
            $this->Admin_model->deleteInfo("additional_tutor_info", 'tutor_id', $uId);
            //delete enrollment
            $this->Admin_model->deleteInfo("tbl_enrollment", 'sct_id', $uId);
            //delete module
            $this->Admin_model->deleteInfo("tbl_module", 'user_id', $uId);
            //delete module question
            $this->Admin_model->deleteInfo("tbl_question", 'user_id', $uId);
            //delete question
            $this->Admin_model->deleteInfo("tbl_question", 'user_id', $uId);
        } elseif ($uType==1) { //parent
            //get child ids of that parent
            $childIds = $this->Admin_model->get_all_where('id', "tbl_useraccount", "parent_id", $uId);
            //delete student details of those children
            foreach ($childIds as $child) {
                //delete student answers
                $this->Admin_model->deleteInfo("tbl_student_answer", 'st_id', $child['id']);
                //delete progress
                $this->Admin_model->deleteInfo("tbl_studentprogress", 'student_id', $child['id']);
                //delete registered couse
                $this->Admin_model->deleteInfo("tbl_registered_course", 'user_id', $child['id']);
                //delete enrollment
                $this->Admin_model->deleteInfo("tbl_enrollment", 'st_id', $child['id']);
            }
            //delete child account of that parent
            $this->Admin_model->deleteInfo("tbl_useraccount", 'parent_id', $uId);
        }
        //delete user account
        $this->Admin_model->deleteInfo("tbl_useraccount", 'id', $uId);
    }


    public function tutor_with_10_students()
    {
        $data['tutor_with_10_student'] = $this->Admin_model->tutor_with_10_student();

        $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'User List';
        $data['page_section'] = 'User';


        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/tutor_with_10_students', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function tutor_create_50_vocabulary()
    {
        $data['tutor_with_50_vocabulary'] = $this->Admin_model->tutor_with_50_vocabulary();

        $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'User List';
        $data['page_section'] = 'User';


        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/tutor_create_50_vocabulary', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function country_list()
    {
        $data['all_country'] = $this->Admin_model->getAllInfo('tbl_country');
        $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Country List';
        $data['page_section'] = 'Country';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/country/country_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function save_country()
    {
        $data['countryName'] = $this->input->post('countryName');
        $data['countryCode'] = $this->input->post('countryCode');
        //        print_r($data);die;
        $this->Admin_model->insertInfo('tbl_country', $data);
        $data['all_country'] = $this->Admin_model->getAllInfo('tbl_country');

        $json = array();
        $json['countryDiv'] = $this->load->view('admin/country/country_div', $data, true);
        echo json_encode($json);
    }

    public function update_country()
    {
        $data['countryName'] = $this->input->post('countryName');
        $data['countryCode'] = $this->input->post('countryCode');
        $country_id = $this->input->post('id');
        //        print_r($data);die;
        $this->Admin_model->updateInfo('tbl_country', 'id', $country_id, $data);
        $data['all_country'] = $this->Admin_model->getAllInfo('tbl_country');

        $json = array();
        $json['countryDiv'] = $this->load->view('admin/country/country_div', $data, true);
        echo json_encode($json);
    }

    public function delete_country($country_id)
    {
        $this->Admin_model->deleteInfo('tbl_country', 'id', $country_id);
        redirect('country_list');
    }

    public function duplicateCountry()
    {
        $post = $this->input->post();
        $oldCountry = isset($post['oldCountry']) ? $post['oldCountry'] : '';
        $newCountry = isset($post['newCountry']) ? $post['newCountry'] : '';
        $newCountryCode = isset($post['newCountryCode']) ? $post['newCountryCode'] : '';
        $oldInfo = $this->Admin_model->search('tbl_country', ['countryName'=>$oldCountry]);
        $dataToInsert = [
            'countryName'=>$newCountry,
            'countryCode'=>$newCountryCode,
        ];
        $newCountryId = $this->Admin_model->insertInfo('tbl_country', $dataToInsert);

        //copy all module with old country
        $conditions = [
            'country' => $oldInfo[0]['id'],
        ];
        $lastInsert = $this->Admin_model->copy('tbl_module', $conditions, 'country', $newCountryId);
        
        //old new module map
        $oldModules = $this->Admin_model->search('tbl_module', $conditions);
        $totCopy = count($oldModules);
        $moduleMap = [];
        foreach ($oldModules as $old) {
            $moduleMap[] = [
                'old' => $old['id'],
                'new' => $lastInsert++,
            ];
        }
        //module question copy
        $this->moduleQuestionCopy($moduleMap, 0, $newCountryId);
        
        $this->session->set_flashdata('success_msg', 'Country duplicated successfully');
        redirect('country_wise');
    }


    public function duplicateGrade()
    {
        $post  = $this->input->post();
        $oldCountry = isset($post['oldCountry']) ? $post['oldCountry'] : '';
        $newCountry = isset($post['newCountry']) ? $post['newCountry'] : '';
        $oldInfo = $this->Admin_model->search('tbl_country', ['countryName'=>$oldCountry]);
        $conditions = [
            'studentGrade' => $post['oldGrade'],
            'country' => $oldInfo[0]['id'],
        ];
        $changeCol = 'studentGrade';
        $changeVal = $post['newGrade'];
        $lastInsert = $this->Admin_model->copy('tbl_module', $conditions, $changeCol, $changeVal);
        
        //old new module map
        $oldModules = $this->Admin_model->search('tbl_module', $conditions);
        $totCopy = count($oldModules);
        $moduleMap = [];
        foreach ($oldModules as $old) {
            $moduleMap[] = [
                'old' => $old['id'],
                'new' => $lastInsert++,
            ];
        }

        //module question copy
        $this->moduleQuestionCopy($moduleMap, $post['newGrade'], 0);

        $this->session->set_flashdata('success_msg', 'Grade duplicated successfully');
        redirect('country_wise');
    }

    /**
     * After duplicate country/grade need to copy all related
     * module questions to new ones.
     *
     * @param array $moduleMap eg: [ [old=>12, new=>13] ].
     *
     * @return void
     */
    public function moduleQuestionCopy($moduleMap, $newGrade = 0, $newCountry = 0)
    {
        foreach ($moduleMap as $map) {
            $oldModuleQues = $this->Admin_model->search('tbl_modulequestion', ['module_id'=>$map['old']]);
            
            if (count($oldModuleQues)) {
                foreach ($oldModuleQues as $question) {
                    if ($newGrade) {
                        $changeCol='studentgrade';
                        $changeVal = $newGrade;
                        $newQuesId = $this->Admin_model->copy('tbl_question', ['id'=>$question['question_id']], $changeCol, $changeVal);
                    } elseif ($newCountry) {
                        $changeCol='country';
                        $changeVal = $newCountry;
                        $newQuesId = $this->Admin_model->copy('tbl_question', ['id'=>$question['question_id']], $changeCol, $changeVal);
                    }


                    $dataToInsert = [
                        'question_id'=>$newQuesId,
                        'question_type'=>$question['question_type'],
                        'module_id' => $map['new'],
                        'question_order' => $question['question_order'],
                        'created' =>time(),
                    ];
                    $this->Admin_model->insertInfo('tbl_modulequestion', $dataToInsert);
                }
            }
        }
    }

    public function country_wise()
    {
        $data['all_country'] = $this->Admin_model->getAllInfo('tbl_country');
        $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Country Wise';
        $data['page_section'] = 'Country';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/schedule/country_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function course_schedule($country_id)
    {
        $data['country_info'] = $this->Admin_model->getInfo('tbl_country', 'id', $country_id);

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Country Wise';
        $data['page_section'] = 'Country';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/schedule/country_wise_schedule', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function add_course_schedule()
    {
        $data['subscription_type'] = -1;//$this->input->post('subscription_type');
        $data['user_type'] = $this->input->post('user_type');
        $data['country_id'] = $this->input->post('country_id');

        $data['country_info'] = $this->Admin_model->getInfo('tbl_country', 'id', $data['country_id']);
        // $data['course_info'] = $this->Admin_model->get_course($data['subscription_type'], $data['user_type'], $data['country_id']);
        $data['course_info'] = $this->Admin_model->get_course($data['user_type'], $data['country_id']);

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Country Wise';
        $data['page_section'] = 'Country';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/schedule/add_course', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function save_course_schedule()
    {
        $data['country_id'] = $_POST['country_id'];
        $data['courseName'] = strip_tags(trim(html_entity_decode($_POST['courseName'], ENT_QUOTES)));
        $data['courseCost'] = $_POST['courseCost'];
        $data['is_enable'] = $_POST['is_enable'];
        $data['user_type'] = $_POST['user_type'];
        // $data['subscription_type'] = $_POST['subscription_type'];

        $course_id = $_POST['course_id'];
        //        echo $course_id;print_r($data);die;
        if ($course_id != '') {
            $this->Admin_model->updateInfo('tbl_course', 'id', $course_id, $data);
        } else {
            $course_id = $this->Admin_model->insertId('tbl_course', $data);
        }


        $data['course_details'] = $this->Admin_model->getInfo('tbl_course', 'id', $course_id);
        $data['box_num'] = $_POST['box_num'];

        $json = array();
        $json['course_id'] = $course_id;
        $json['course_content_div'] = $this->load->view('admin/schedule/course_content_div', $data, true);
        echo json_encode($json);
    }

    public function delete_course()
    {
        $course_id = $this->input->post('course_id');
        $this->Admin_model->deleteInfo('tbl_course', 'id', $course_id);
    }

    /**
     * Suspend a user accound
     *
     * @param integer $userId User ID to suspend
     *
     * @return void
     */
    public function suspendUser($userId)
    {
        $dataToUpdate = ['suspension_status'=>1];
        $this->Admin_model->updateInfo($table = "tbl_useraccount", "id", $userId, $dataToUpdate);

        $this->session->set_flashdata('success_msg', 'User suspended successfully.');
        redirect('user_list');
    }

    /**
     * Unsuspend a user
     *
     * @param integer $userId User ID to remove suspension
     *
     * @return [type]
     */
    public function unsuspendUser($userId)
    {
        $dataToUpdate = ['suspension_status'=>0];
        $this->Admin_model->updateInfo($table = "tbl_useraccount", "id", $userId, $dataToUpdate);

        $this->session->set_flashdata('success_msg', 'Suspension removed successfully.');
        redirect('user_list');
    }

    /**
     * Extend users trial period
     *
     * @return void [description]
     */
    public function extendTrialPeriod()
    {

        $post         = $this->input->post();
        $userId       = $post['userId'];
        $extendDays   = $post['extendAmound'];
        $user         = $this->Admin_model->getInfo('tbl_useraccount', 'id', $userId);
        $currentEndDate = isset($user[0]['trial_end_date']) ? $user[0]['trial_end_date'] : date('Y-m-d');
        $dateToSet      = date("Y-m-d", strtotime($currentEndDate. ' +'. $extendDays .'days'));
        $dataToUpdate = ['trial_end_date'=>$dateToSet];
        $this->Admin_model->updateInfo('tbl_useraccount', 'id', $userId, $dataToUpdate);
    }

    public function usersCurrentPackages()
    {
        $post = $this->input->post();
        $userId = $post['userId'];

        $usersCourse = $this->Admin_model->getInfo('tbl_registered_course', 'user_id', $userId);
        $usersCourse = count($usersCourse)?array_column($usersCourse, 'course_id'):[];
        $courseNames = '';
        foreach ($usersCourse as $courseId) {
            $courseName = $this->Admin_model->courseName($courseId);
            $courseNames .= $courseName. ', ';
        }
        $courseNames = rtrim($courseNames, ', ');
        echo $courseNames;
    }

    /**
     * All packages that not taken by user
     *
     * @return string rendered package option
     */
    public function packageNotTaken()
    {
        $post = $this->input->post();
        $userId = $post['userId'];
        $usersCourse = $this->Admin_model->getInfo('tbl_registered_course', 'user_id', $userId);
        $usersCourse = count($usersCourse)?array_column($usersCourse, 'course_id'):[];
        
        //if user taken some courses then filter the result else take all courses
        if (count($usersCourse)) {
            $courseNotTakenByUser = $this->Admin_model->whereNotIn('tbl_course', 'id', $usersCourse);
        } else {
            $courseNotTakenByUser = $this->Admin_model->getAllInfo('tbl_course');
        }
        
        $notTakenCourses = count($courseNotTakenByUser) ? array_column($courseNotTakenByUser, 'id'):[];
        $option = '';
        foreach ($notTakenCourses as $courseId) {
            $courseName = $this->Admin_model->courseName($courseId);
            $option .= '<option value="'.$courseId.'">' . $courseName . '</option>';
        }
        echo $option;
    }

    /**
     * Assign packages to a  user.
     *
     * @return void
     */
    public function addPackages()
    {
        $post = $this->input->post();
        $post = $this->security->xss_clean($post);
        $userId = $post['userId'];
        $pkgSelected = array_column($post['pkgSelected'], 'value');
        $dataToInsert = [];
        foreach ($pkgSelected as $pkgId) {
            $dataToInsert[] = [
                'course_id' => $pkgId,
                'user_id'   => $userId,
                'created'   => time(),
                'cost'      => 0,
            ];
        }
        $lastId  = $this->Admin_model->insertBatch('tbl_registered_course', $dataToInsert);
        if ($lastId) {
            echo 'success';
        }
    }

    /**
     * show list of all q-dictionary word
     *
     * @return void
     */
    public function dictionaryWordList()
    {

        $allWord = $this->QuestionModel->groupedWordItems();
        
        $data['wordChunk'] = [];
        foreach ($allWord as $word) {
            $data['wordChunk'][$word['creator_id']][] = $word;
        }
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/q-dictionary/wordlist', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    /**
     * Get all word for ajax datatable(ajax call)
     *
     * @return string json encoded string
     */
    public function wordForDataTable()
    {
        $post = $this->input->get();
        $offset = isset($post['start']) ? $post['start']  : 0;
        $limit = isset($post['length']) ? $post['length'] : 5;
        
        $allWord = $this->QuestionModel->groupedWordItems($limit, $offset);
        
        $data['wordChunk'] = [];
        //$data=0;
        foreach ($allWord as $word) {
            $data['wordChunk'][$word['creator_id']][] = $word;
        }
        $data['data'] =[];
        foreach ($data['wordChunk'] as $userChunk) {
            $cnt=0;
            foreach ($userChunk as $word) {
                $checked = $word['word_approved'] ? "checked":"";
                $word['sl'] = ++$cnt;
                $word['ques_created_at'] = date('d M Y', $word['ques_created_at']);
                $word['view'] ='<a href="q-dictionary/approve/'.$word['word_id'].'">View</a>';
                $word['select'] = '<input class="approvalCheck" wordId="'.$word['word_id'].'" type="checkbox" name="" '.$checked.'>';
                $word['delete'] = '<a href="#" wordId="'.$word['word_id'].'" class="wordDel"> <i class="fa fa-times"></i> </a>';
                $data['data'][] = $word;
            }
        }
        //$data['draw'] =1;
        $data['recordsTotal'] =$this->QuestionModel->countDictWord();
        $data['recordsFiltered'] =$data['recordsTotal'];
        echo json_encode($data);
    }

    /**
     * Dictionary word approve page
     *
     * @param int $wordId question item id
     *
     * @return void
     */
    public function dicWordApprovePage($wordId)
    {

        $word = $this->QuestionModel->search('tbl_question', ['id'=>$wordId]);
        if (!$word) {
            show_404();
        }
        $data['word_info'] = json_decode($word[0]['questionName']);
        $data['word'] = $word[0]['answer'];
        $data['wordId'] = $wordId;
        $data['approvalStatus'] = $word[0]['word_approved'];
        $data['creator_info'] = $this->Tutor_model->tutorInfo(['id'=>$word[0]['user_id']]);
        $data['creator_info'] = $data['creator_info'][0];
        /*$data['total_items'] = count($this->QuestionModel->search('tbl_question', ['answer'=>$data['word'], 'dictionary_item'=>1]));
        $wordCount = $this->QuestionModel->search(
            'tbl_question',
            [
            'answer'=>$data['word'],
            'dictionary_item'=>1
            ]
        );
        $wordCount = count($wordCount);*/

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['pageType'] = 'q-dictionary';
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $question_box = 'preview/dictionary_word_approval';
        $data['maincontent'] = $this->load->view($question_box, $data, true);
        $this->load->view('master_dashboard', $data);
    }

    /**
     * Word approval by admin(ajax call).
     *
     * @param int $wordId question id
     *
     * @return string      update status
     */
    public function wordApprove($wordId)
    {
        $word = $this->QuestionModel->search('tbl_question', ['id'=>$wordId]);
        if (!$word) {
            show_404();
        }
        $word = $word[0];
        $creatorId = $word['user_id'];
        //approve word
        $this->QuestionModel->update('tbl_question', 'id', $wordId, ['word_approved'=>1]);

        $dicPayInfo = $this->QuestionModel->search('dictionary_payment', ['word_creator'=>$creatorId]);
        
        //if user exists on dictionary_payment table then update approved word count
        //else insert
        if (count($dicPayInfo[0])) {
            $approvedBefore = $dicPayInfo[0]['total_approved'];
            $dataToUpdate = [
                'total_approved'=> $approvedBefore+1,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->QuestionModel->update(
                'dictionary_payment',
                'word_creator',
                $creatorId,
                $dataToUpdate
            );
        } else {
            $dataToInsert = [
                'word_creator' =>  $creatorId,
                'total_approved' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->QuestionModel->insert('dictionary_payment', $dataToInsert);
        }

        echo 'true';
    }

    /**
     * Word reject by admin(ajax call).
     *
     * @param int $wordId question id
     *
     * @return string      update status
     */
    public function wordReject($wordId)
    {
        $word = $this->QuestionModel->search('tbl_question', ['id'=>$wordId]);
        if (!$word) {
            show_404();
        }
        $word = $word[0];
        $creatorId = $word['user_id'];

        $this->QuestionModel->update('tbl_question', 'id', $wordId, ['word_approved'=>0]);
        $dicPayInfo = $this->QuestionModel->search('dictionary_payment', ['word_creator'=>$creatorId]);
        
        //if user exists on dictionary_payment table then update approved word count
        //else insert
        if ($dicPayInfo) {
            $approvedBefore = isset($dicPayInfo[0]['total_approved'])?$dicPayInfo[0]['total_approved'] : 0;
            $dataToUpdate = [
                'total_approved'=> max(0, $approvedBefore-1),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->QuestionModel->update(
                'dictionary_payment',
                'word_creator',
                $creatorId,
                $dataToUpdate
            );
        }
        echo 'true';
    }

    /**
     * Pay to vocabulary word creator(view)
     *
     * @return void
     */
    public function dictionaryPayment()
    {

        $data['toPay'] = $this->QuestionModel->wordCreatorToPay();
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('admin/q-dictionary/pay_tutor', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    /**
     * vocabulary payment update(ajax)
     *
     * @return void
     */
    public function payTutor()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        $creator = $clean['creator'];
        
        $conditions = ['word_creator'=>$creator];
        $paymentHistory = $this->QuestionModel->search('dictionary_payment', $conditions);
        $payable = isset($paymentHistory) ? $paymentHistory[0]['total_approved']-$paymentHistory[0]['total_paid']:0;
        
        //VOCABULARY_PAYMENT=50
        if ($payable>=VOCABULARY_PAYMENT) {
            $dataToUpdate = [
                'total_paid' => $paymentHistory[0]['total_paid']+VOCABULARY_PAYMENT,
            ];
            $this->QuestionModel->update('dictionary_payment', 'word_creator', $creator, $dataToUpdate);
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /**
     * Count on word creator to pay(ajax)
     * ajax call from leftnav
     *
     * @return void
     */
    public function dicItemCreatorToPay()
    {
        $data['toPay'] = $this->QuestionModel->wordCreatorToPay();
        echo count($data['toPay']);
    }


    
    /**
     * Add dialogue from admin that will
     * show after giving answer from student account
     *
     * @return void
     */
    public function addDialogue()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        if (!$post) {
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
            $data['maincontent'] = $this->load->view('dialogue/add_dialogue', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            date_default_timezone_set(TIME_ZONE);
            
            $this->form_validation->set_rules('dialogue_body', 'Dialogue body', 'required');
            if ($this->form_validation->run()==false) {
                $this->session->set_flashdata('error_msg', 'Dialogue body required');
                redirect('dialogue/add');
            }

            $dataToInsert = [
                'body'=>$post['dialogue_body'],
                'show_whole_year' => isset($post['year']) ? $post['year'] : '',
                'date_to_show' => isset($post['date']) ? $post['date'] : '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $insId = $this->Admin_model->insertInfo('dialogue', $dataToInsert);
            if ($insId) {
                $this->session->set_flashdata('success_msg', 'Dialogue Added Successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Dialogue Not Added');
            }
            redirect('dialogue/add');
        }
    }

    
    /**
     * Admin can view all dialogue
     *
     * @return void
     */
    public function allDialogue()
    {
        $data['allDialogue'] = $this->Admin_model->getAllInfo('dialogue');

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('dialogue/all_dialogue', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function add_auto_repeat()
    {
        $data = array();
        $diaId = $this->input->post('diaId');
    
        $data['auto_repeat'] = $this->input->post('autoRepeat');
        $repeat_log['dia_Id'] = $diaId;
        $result = $this->Admin_model->updateInfo('dialogue','id',$diaId,$data);
        echo json_encode('Insert Successfully');
    }
    
    public function deleteDialogue($id)
    {
        $this->Admin_model->deleteInfo('dialogue', 'id', $id);
    }
    
    public function smsApiAdd()
    {
        $data_ai['sms_api_key'] = $this->input->post('sms_api_key');
        $a_settings_grop = 'sms_api_settings';
        if (!$data_ai['sms_api_key']) {
            $data['settins_Api_key'] = $this->Admin_model->getSmsApiKeySettings();
            
            $data['settins_sms_messsage'] = $this->Admin_model->getSmsMessageSettings();
            
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
            $data['maincontent'] = $this->load->view('dialogue/smsSetting', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            foreach ($data_ai as $a_settings_key => $a_settings_value) {
                $rs['res'] = $this->Admin_model->updateSmsApiSettings($a_settings_grop, $a_settings_key, $a_settings_value);
            }

            $this->session->set_flashdata('success_msg', 'Updated Successfully');
            
            redirect('sms_api/add');
        }
    }
    
    public function sms_message()
    {
        $data_ai['register_sms'] = $this->input->post('register_sms');
        $data_ai['9_pm_Sms'] = $this->input->post('9_pm_Sms');
        $data_ai['user_adds_sms'] = $this->input->post('user_adds_sms');
        $a_settings_grop = 'sms_message_settings';
        foreach ($data_ai as $a_settings_key => $a_settings_value) {
            $rs['res'] = $this->Admin_model->updateSmsApiSettings($a_settings_grop, $a_settings_key, $a_settings_value);
        }
        $this->session->set_flashdata('success_msg', 'Updated Successfully');
        redirect('sms_api/add');
    }

    
    /**
     * search from any table using conditions
     *
     * @param  string $tableName table to perform search
     * @param  array  $params    conditions array
     * @return [type]            [description]
     */
    public function search($tableName, $params)
    {
        $res = $this->db
        ->where($params)
        ->get($tableName)
        ->result_array();

        return $res;
    }
    
    
    public function trial_period()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        if (!$post) {
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
            
            $data['trial_configuration'] = $this->Admin_model->getInfo('tbl_setting', 'setting_type', 'trial_period');
            // echo '<pre>';print_r($data['trial_configuration']);die;
            
            $data['maincontent'] = $this->load->view('admin/trial_period/add_trial_period', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            $trial_unlimited = [
                'setting_type' => 'trial_period',
                'setting_key' => 'unlimited',
                'setting_value' => isset($post['unlimited']) ? $post['unlimited'] : 0
            ];
            $trial_days = [
                'setting_type' => 'trial_period',
                'setting_key' => 'days',
                'setting_value' => isset($post['days']) ? $post['days'] : 0
            ];
            
            $trial_configuration = $this->Admin_model->getInfo('tbl_setting', 'setting_type', 'trial_period');
            if ($trial_configuration) {
                    //updateInfo($table, $colName, $colValue, $data)
                $this->Admin_model->updateInfo('tbl_setting', 'setting_key', 'unlimited', $trial_unlimited);
                $this->Admin_model->updateInfo('tbl_setting', 'setting_key', 'days', $trial_days);
            } else {
                $this->Admin_model->insertInfo('tbl_setting', $trial_unlimited);
                $this->Admin_model->insertInfo('tbl_setting', $trial_days);
            }
            if ($insId) {
                $this->session->set_flashdata('success_msg', 'Dialogue Added Successfully');
            }
            redirect('trial_period');
        }
    }

    public function coursesByCountry($countryId, $studentId = 0, $type = ''  , $subscription_type ='')
    {
        $courses = $this->Admin_model->search('tbl_course', ['country_id'=>$countryId]);
        $html = '';

        $currentURL = current_url();
        if (strpos(current_url(),"/Admin/coursesByCountry/") !==false) {
            if (!empty($this->uri->segment(4))) {
                $add_user = 1;
            }
        }
        

        $conditions = [
            'user_id'=>$studentId,
        ];
        $studentCourses = $this->Admin_model->search('tbl_registered_course', $conditions);
        $studentCourses = count($studentCourses) ? array_column($studentCourses, 'course_id') : [];
        
        foreach ($courses as $course) {
            $checked = in_array($course['id'], $studentCourses) ? 'checked' : '';
            // if (!isset($add_user) && $course['id'] == 44) {
            //     $checked = 'checked';

            // }

            if ($subscription_type == "trial") {
                $course['courseCost'] = 0; // rakesh
            }

            $html .= '<li class="text-left" style="width:210px">
            <p style="line-height: 18px;">
            </p><p>'.$course["courseName"].'&nbsp;</p><br>
            <p>$'.$course['courseCost'].'
            </p>
            <p class="text-right filled-in">
            <input class="form-check-input" id="course_1" type="checkbox" name="course[]" value="'.$course['id'].'" '. $checked .'>
            </p>
            </li>';
        }
        if ($type=="edit") {
            //echo 'hit';
            return $html;
        }
        echo $html;
    }

    public function add_groupboard()
    {
        $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);

        $data['maincontent'] = $this->load->view('admin/groupboard/add', $data, true);
        $this->load->view('master_dashboard', $data);
    }

     public function sms_templetes()
    {
        $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);

        $data['templets'] = $this->Admin_model->getInfo('tbl_setting', 'setting_type', "sms_message_settings_temp");

        $data['maincontent'] = $this->load->view('admin/sms/index', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function edit_templete($id)
    {

        if (isset($_POST) && !empty($_POST) ) {

            $this->form_validation->set_rules('setting_key', 'Setting Key', 'required');
            $this->form_validation->set_rules('setting_value', 'Setting Value', 'required');
            if ($this->form_validation->run()==false) {
                $this->session->set_flashdata('Failed', 'Templete Can not be empty !');
                
            }else{
                $this->Admin_model->updateInfo('tbl_setting', 'setting_id', $id , $_POST);
                $this->session->set_flashdata('message', 'Successfully Updated');
                redirect($_SERVER['HTTP_REFERER']);
            }

        }else{

            $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
            $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);

            $data['templets'] = $this->Admin_model->getInfo('tbl_setting', 'setting_id', $id);

            $data['maincontent'] = $this->load->view('admin/sms/edit', $data, true);
            $this->load->view('master_dashboard', $data);

        }
        
    }


    public function sms_templetes_status()
    {

        if (isset($_POST) && !empty($_POST) ) {

            $this->form_validation->set_rules('setting_value', 'Setting Value', 'required');
            if ($this->form_validation->run()==true) {

                $this->Admin_model->updateInfo('tbl_setting', 'setting_key', "Template Activate Status" , $_POST);
                $this->session->set_flashdata('message', 'Successfully Updated');
                redirect($_SERVER['HTTP_REFERER']);
            }

        }else{

            $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $this->session->userdata('user_id'));
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
            $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);

            $data['templets'] = $this->Admin_model->getInfo('tbl_setting', 'setting_type', "Template Activate Status");
            $data['maincontent'] = $this->load->view('admin/sms/status', $data, true);
            $this->load->view('master_dashboard', $data);

        }
        
    }

    public function check_groupboardSerial($groupboard_id)
    {
        $user_info = $this->Admin_model->getInfo('tbl_available_rooms', 'room_id', $groupboard_id );
        if ( count($user_info) ) {
            if ($user_info[0]['in_use'] == 0 ) {
                echo  $user_info[0]['id'];
            }else{
                echo "This room is not available ";
            }
            
        }else{
            echo "No rooms";
        }

    }
}
