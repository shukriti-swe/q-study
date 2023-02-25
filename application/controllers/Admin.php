<?PHP

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
        $this->load->model('RegisterModel');
        $this->load->model('Preview_model');
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
        $contacts_all = $this->Admin_model->getAllInfo('user_message');
        $all_contacts = array();
        foreach ($contacts_all as $key => $val) {
            $all_contacts[$key]['user_name']    = $val['user_name'];
            $all_contacts[$key]['user_email']   = $val['user_email'];
            $all_contacts[$key]['message_body'] = $val['message_body'];
            $all_contacts[$key]['sent_at']      = $val['sent_at'];
            $all_contacts[$key]['updated_at']   = $val['updated_at'];
            $all_contacts[$key]['refLink']      = $val['refLink'];
            $all_contacts[$key]['feedback_topic'] = $val['feedback_topic'];
            $all_contacts[$key]['user_id']      = $val['user_id'];
            $all_contacts[$key]['status']       = $val['status'];
            $contacts_unique_id = $val['unique_id'];
            $all_contacts[$key]['files']       = $this->db->where('unique_id', $contacts_unique_id)->get('feedback_files')->result_array();
        }
        $data['all_contacts'] = $all_contacts;
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

    public function download_feedback_file($id)
    {
        if (is_numeric($id)) {
            $this->load->helper('download');
            $url = 'assets/uploads/feedback';
            $store = $this->Admin_model->getInfo('feedback_files', 'id', $id);
            $img = explode(".", $store[0]['filename']);
            $extention =  $img[1];
            $path = base_url() . $url . '/' . $store[0]['filename'];
            $content = file_get_contents($path);
            force_download($store[0]['filename'], $content);
        }
    }


    public function contact_info()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);

        if (isset($post) && !empty($post)) {
            $data['setting_value'] = $this->input->post('contact');
            $this->db->where('setting_key', 'contact_email')->update('tbl_setting', $data);

            $this->session->set_flashdata('success_msg', 'Contact email updated successfully');
        }
        $data['contacts_email'] = $this->db->where('setting_key', 'contact_email')->get('tbl_setting')->row();
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Contact Mail';
        $data['page_section'] = 'Contact';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/contacts/contact_info', $data, true);
        $this->load->view('master_dashboard', $data);
    }



    public function user_list()
    {
        // echo 11; die();
        //$this->db->where('subscription_type','guest')->where('end_subscription',null)->update('tbl_useraccount',(['unlimited'=>1]));
        if ($_GET['name'] != null || $_GET['user_type'] != null || $_GET['country_id'] != null) {

            $data['total_registered'] = $this->Admin_model->total_registered_search($_GET['name'], $_GET['user_type'], $_GET['country_id']);
            $data['today_registered'] = $this->Admin_model->today_registered_search($_GET['name'], $_GET['user_type'], $_GET['country_id']);
        } else {
            $data['total_registered'] = $this->Admin_model->total_registered();
            $data['today_registered'] = $this->Admin_model->today_registered();
        }
        $data['tutor_with_10_student'] = $this->Admin_model->tutor_with_10_student();


        $total_income =  $this->Admin_model->getTotalIncome();
        $daily_income =  $this->Admin_model->getDailyIncome();
        $total  = $total_income[0];
        $dailyIncome  = $daily_income[0];

        $data['total_income'] = (isset($total->total_cost) && $total->total_cost > 0) ? $total->total_cost : 0;
        $data['daily_income'] = (isset($dailyIncome->daily_income) && $dailyIncome->daily_income > 0) ? $dailyIncome->daily_income : 0;


        $trial = 0;
        $guest = 0;
        $pending = 0;
        $total_registeredCount = 0;
        $today_registeredCount = 0;

        foreach ($data['total_registered'] as $key => $value) {

            if (($value['subscription_type'] == 'signup' || $value['subscription_type'] == 'direct_deposite') && $value['end_subscription'] != "") {

                if ($value['end_subscription'] >= date("Y-m-d")) {
                    $total_registeredCount++;
                }
            }

            if (($value['subscription_type'] == 'signup' || $value['subscription_type'] == 'direct_deposite') && $value['end_subscription'] != "") {

                if (date("Y-m-d", $value['created']) == date("Y-m-d")) {
                    $today_registeredCount++;
                }
            }


            if ($value['subscription_type'] == "trial") {
                $trial++;
            }

            if ($value['subscription_type'] == "guest") {
                $guest++;
            }

            if ($value['subscription_type'] == "direct_deposite"  &&  $value['direct_deposite'] == 0) {
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

        foreach ($groupboard_assigner as $key => $value) {
            $groupboard_assigner_s[] = $value['user_id'];
        }

        foreach ($groupboard_taker as $key => $value) {
            $groupboard_taker_s[] = $value['id'];
        }


        $data['groupboard_require'] = $groupboard_require;
        $data['groupboard_assigner'] = isset($groupboard_assigner_s) ? $groupboard_assigner_s : [];
        $data['groupboard_taker'] = isset($groupboard_taker_s) ? $groupboard_taker_s : [];



        $signup_users = $this->db->where('subscription_type', 'signup')->where('subscription_status !=', 1)->where('end_subscription >', date('Y-m-d'))->get('tbl_useraccount')->result_array();

        foreach ($signup_users as $key => $value) {
            $this->db->where('id', $value['id'])->update('tbl_useraccount', ['subscription_status' => 1]);
        }
        //echo "<pre>";print_r($data);die();
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

            if ($clean['subscription_type'] == "guest" || $clean['subscription_type'] == "signup") {
                $guest_days = (isset($clean['guest_days'])) ? $clean['guest_days'] : null;
                if ($guest_days > 0) {
                    $d1 = date('Y-m-d');
                    $d2 = date('Y-m-d', strtotime('+' . $guest_days . ' days', strtotime($d1)));
                }
            } else if ($clean['subscription_type'] == "guest") {

                $tbl_setting = $this->db->where('setting_key', 'days')->get('tbl_setting')->row();
                $duration = $tbl_setting->setting_value;
                $d1 = date('Y-m-d');
                $d2 = null;
            } else {
                $tbl_setting = $this->db->where('setting_key', 'days')->get('tbl_setting')->row();
                $duration = $tbl_setting->setting_value;
                $d1 = date('Y-m-d');
                $d2 = date('Y-m-d', strtotime('+' . $duration . ' days', strtotime($d1)));
            }
            // echo "<pre>";print_r($post);echo $d2;die();

            $dataToSave = [
                'user_type' => $clean['userType'],
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
                'suspension_status' => (isset($clean['suspension_status']) && $clean['suspension_status'] == 1) ? 1 : 0,
                'parent_id' => isset($clean['parentId']) ? $clean['parentId'] : null,
                'token' => null,
                'image' => null,
                'payment_status' => '',
                'end_subscription' => (isset($d2)) ? $d2 : null,
                'unlimited' => isset($clean['unlimited']) ? $clean['unlimited'] : 0,
            ];

            if ($clean['subscription_type'] == "guest") {
                $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
                $settins_sms_messsage = $this->admin_model->getSmsType("Tutor Registration");

                $register_code_string = $settins_sms_messsage[0]['setting_value'];
                $message = str_replace("{{ username }}", $dataToSave['user_email'], $register_code_string);
                $message = str_replace("{{ password }}",  $clean['password'], $message);

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
                //$result = curl_exec($ch);
                curl_close($ch);
            }


            $insertedUserId = $this->Admin_model->insertId('tbl_useraccount', $dataToSave);
            $additionalTableData = array();
            $additionalTableData['tutor_id'] = $insertedUserId;
            $additionalTableData['created_at'] = date('Y-m-d h:i:s');
            $additionalTableData['updated_at'] = date('Y-m-d h:i:s');
            $this->Admin_model->insertInfo('additional_tutor_info', $additionalTableData);
            //if inserted user is not parent/child then record registered courses
            if ($clean['userType'] != 1 || $clean['userType'] != 6) { //parent, student
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
            if ($clean['userType'] == 1 && $dataToSave['children_number']) {
                $childToSave;
                $totChild = $dataToSave['children_number'];

                for ($a = 0; $a < $totChild; $a++) {
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
                        'user_mobile' => $clean['full_phone'],
                        'parent_id' => $insertedUserId,
                        'user_type' => 6,
                        'country_id' => $clean['country'],
                        'student_grade' => $clean['childGrade'][$a],
                        'SCT_link' => $clean['childSCTLink'][$a],
                        'created' => time(),
                        'subscription_type' => $clean['subscription_type'],
                        'end_subscription' => (isset($d2)) ? $d2 : null,
                        'unlimited' => isset($clean['unlimited']) ? $clean['unlimited'] : 0,
                    ];
                    $childId = $this->Admin_model->insertInfo('tbl_useraccount', $childToSave);

                    $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
                    $settins_sms_messsage = $this->admin_model->getSmsType("Parent Registration");

                    $register_code_string = $settins_sms_messsage[0]['setting_value'];
                    $message = str_replace("{{ username }}", $dataToSave['user_email'], $register_code_string);
                    $message = str_replace("{{ password }}",  $clean['password'], $message);
                    $message = str_replace("{{ C_username }}", $childToSave['user_email'], $message);
                    $message = str_replace("{{ C_password }}", $pass, $message);

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


            if ($_POST['userType'] == 2) {

                $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
                $settins_sms_messsage = $this->admin_model->getSmsType("Upper level student");

                $register_code_string = $settins_sms_messsage[0]['setting_value'];
                $message = str_replace("{{ username }}", $dataToSave['user_email'], $register_code_string);
                $message = str_replace("{{ password }}",  $clean['password'], $message);

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

            if ($_POST['userType'] == 3) {

                $settins_Api_key = $this->admin_model->getSmsApiKeySettings();
                $settins_sms_messsage = $this->admin_model->getSmsType("Tutor Registration");

                $register_code_string = $settins_sms_messsage[0]['setting_value'];
                $message = str_replace("{{ username }}", $dataToSave['user_email'], $register_code_string);
                $message = str_replace("{{ password }}",  $clean['password'], $message);

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

            $data['student_prize_list'] = $this->Admin_model->getInfoPrizeWinerUserByID($user_id, $limit, $offset);


            $tbl_setting = $this->db->where('setting_key', 'days')->get('tbl_setting')->row();
            $duration = $tbl_setting->setting_value;
            $date = date('Y-m-d');
            $d1  = date('Y-m-d', strtotime('-' . $duration . ' days', strtotime($date)));
            $trialEndDate = strtotime($d1);
            $data['activeTrilUser'] = $this->Admin_model->getInfoTrialActiveUserAdmin('tbl_useraccount', 'subscription_type', 'trial', $user_id, $trialEndDate);

            //echo "<pre>";print_r($activeTrilUser);die;
            $data['user_type'] = $this->Admin_model->getAllInfo('tbl_usertype');
            $data['all_country'] = $this->Admin_model->getAllInfo('tbl_country');

            $data['studentsRefLink'] = $this->Admin_model->getStudentsRefLink($user_id);

            $data['user_info'] = $this->Admin_model->getInfo('tbl_useraccount', 'id', $user_id);

            if ($data['user_info'][0]['user_type'] == 1) { //parent
                $conditions = ['parent_id' => $user_id];
                $data['allChild'] = $this->Admin_model->search('tbl_useraccount', $conditions);
            } elseif ($data['user_info'][0]['user_type'] == 6) { //child
                $conditions = ['id' => $user_id];
                $data['parent'] = $this->Admin_model->search('tbl_useraccount', $conditions);
                $data['tutorRefLink'] = $this->Admin_model->getTutorRefLink($user_id);
            }
            // echo "<pre>";print_r($data['tutorRefLink']);die();

            $checkCommission = $this->db->where('tutorId', $user_id)->where('status', 0)->get('tbl_tutor_commisions')->result_array();
            if ($data['user_info'][0]['user_type'] == 3) {
                $data['tutorCommision'] = count($checkCommission);
            }

            if ($data['user_info'][0]['user_type'] == 3) {
                $data['tutorpendingComissions'] = $this->Admin_model->getTutorCommission('tbl_tutor_commisions', 'status', 0, 'tutorId', $user_id);
                $data['tutorpaidComissions']    = $this->Admin_model->getTutorCommission('tbl_tutor_commisions', 'status', 1, 'tutorId', $user_id);
            }


            if ($data['user_info'][0]['user_type'] == 3) {
                $data['account_detail'] = $this->db->where('tutor_id', $user_id)->get('tbl_tutor_account_details')->row();
            }



            $vocabularyCommission = $this->QuestionModel->vocabularyCommission($user_id);
            if (isset($vocabularyCommission)) {
                $total_approved = $vocabularyCommission->total_approved;
                $total_paid = $vocabularyCommission->total_paid + VOCABULARY_PAYMENT;
                if ($total_approved > $total_paid) {
                    $data['vocabularyCommission'] = 1;
                } else {
                    $data['vocabularyCommission'] = 0;
                }
            }


            $checkStudentPercentage = $this->Admin_model->checkStudentPercentage('daily_modules', 'user_id', $user_id);
            if ($checkStudentPercentage) {
                $totalRow = $checkStudentPercentage[0]['total_row'];
                $percentage = number_format($checkStudentPercentage[0]['percentage']);
                if ($totalRow >= 2 && $percentage >= 90) {
                    $data['studentScore'] = 1;
                    $data['studentScoreDetails'] = $this->Admin_model->checkStudentPercentage('daily_modules', 'user_id', $user_id);;
                }
            }


            $messages_users = $this->db->where('user_id', $user_id)->order_by('id', 'desc')->limit(1)->get('user_message')->result_array();
            if (count($messages_users) > 0) {
                $data['user_message'] = 1;
                $data['messages_users'] = $this->db->where('user_id', $user_id)->order_by('id', 'desc')->limit(1)->get('user_message')->result_array();
            }

            $data['courses'] = $this->coursesByCountry($data['user_info'][0]['country_id'], $data['user_info'][0]['id'], $type = "edit", $data['user_info'][0]['subscription_type']);  //whiteboard rakesh

            $data['whiteboard'] = $this->Admin_model->whiteboardPurches('tbl_registered_course', $user_id);  //whiteboard rakesh 

            //echo "<pre>";print_r($data['whiteboard']);die();
            $created_at = $data['user_info'][0]['created'];
            $end_subscription = $data['user_info'][0]['end_subscription'];

            $tbl_setting = $this->db->where('setting_key', 'days')->get('tbl_setting')->row();
            $duration = $tbl_setting->setting_value;

            $d1 = date('Y-m-d', $created_at);
            $d2 = date('Y-m-d', strtotime($d1 . "+" . $duration . "days"));
            $d3 = date('Y-m-d');


            if ($data['whiteboard'] == 1 && ($d2 > $d3) && $data['user_info'][0]['user_type'] == 3 && $data['user_info'][0]['subscription_type'] == 'trial') {
                $data['groupboard_trial'] =  1;
            }


            if ($data['whiteboard'] == 1 && ($end_subscription > $d3) && $data['user_info'][0]['user_type'] == 3 && $data['user_info'][0]['subscription_type'] != 'trial') {
                $data['groupboard_signup'] =  1;
            }


            //check direct deposit resource
            $tbl_qs_payments = $this->db->where('user_id', $user_id)->where('PaymentEndDate >', time())->order_by('id', 'desc')->limit(1)->get('tbl_qs_payment')->row();

            $data['deposit_resources_status'] = 3;
            if (isset($tbl_qs_payments)) {

                $end_date = $tbl_qs_payments->PaymentEndDate;
                $payment_status = $tbl_qs_payments->payment_status;
                $data['paymentType'] = $tbl_qs_payments->paymentType;

                $d1 = date('Y-m-d', $end_date);
                $d2 = date('Y-m-d');

                if ($d1 > $d2) {
                    $data['deposit_resources'] = 1; //active
                } else {
                    $data['deposit_resources'] = 0; //inactive
                }

                if ($payment_status == 'Completed') {
                    $data['deposit_resources_status'] = 1; //active
                }

                if ($payment_status == 'Pending') {
                    $data['deposit_resources_status'] = 0; //Inactive
                }
            }


            //check direct deposit courses
            $checkDirectDepositCourse = $this->Admin_model->getDirectDepositCourse($user_id);
            $checkDirectDepositPendingCourse = $this->Admin_model->getDirectDepositPendingCourse($user_id);
            $data['checkDirectDepositCourse'] = $checkDirectDepositCourse;
            $data['checkDirectDepositCourseStatus'] = $checkDirectDepositPendingCourse;


            $data['checkUnavailableProduct'] = $this->db->where('user_id', $user_id)->where('status', 'unavailable')->get('prize_won_users')->row();

            //echo "<pre>";print_r( $data['checkUnavailableProduct']);die();

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

            $prize_unavailable = $this->input->post('student_prize_unavailable');
            if (isset($prize_unavailable)) {
                $won_product_details = $this->db->where('user_id', $user_id)->where('status', 'pending')->get('prize_won_users')->row();
                if (isset($won_product_details)) {
                    $productPoint  = $won_product_details->productPoint;
                    $point_details = $this->db->where('user_id', $user_id)->get('product_poinits')->row();
                    $data['bonus_point']   = $point_details->bonus_point + $productPoint;
                    $data['total_point']   = $point_details->total_point + $productPoint;
                    $data['use_point']     = $point_details->use_point   - $productPoint;

                    $updatePoint = $this->db->where('user_id', $user_id)->update('product_poinits', $data);

                    $this->db->where('user_id', $user_id)->where('status', 'pending')->update('prize_won_users', ['status' => 'unavailable']);
                }
            }
            // echo $prize_unavailable;die;

            $checkUserMessage = $this->input->post('checkUserMessage');
            if (isset($checkUserMessage)) {
                $this->db->where('user_id', $user_id)->update('user_message', ['status' => 'seen']);
            }
            $tutorCommisionPaid = $this->input->post('tutorCommisionPaid');
            if (isset($tutorCommisionPaid)) {
                $this->db->where('tutorId', $user_id)->update('tbl_tutor_commisions', ['status' => 1]);
            }

            $deposit_resources_status = $this->input->post('deposit_resources_status');
            if (isset($deposit_resources_status)) {
                $this->db->where('user_id', $user_id)->where('PaymentEndDate >', time())->where('paymentType', 3)->update('tbl_qs_payment', ['payment_status' => 'Completed']);
            } else {
                $this->db->where('user_id', $user_id)->where('PaymentEndDate >', time())->where('paymentType', 3)->update('tbl_qs_payment', ['payment_status' => 'Pending']);
            }

            $student_prize_list = $this->input->post('student_prize_list');
            if (isset($student_prize_list)) {
                $this->db->where('user_id', $user_id)->update('prize_won_users', ['status' => 'paid']);
            }
            // added AS 
            if ($clean['subscription_type'] == "guest" || $clean['subscription_type'] == "signup") {
                $guest_days = (isset($clean['guest_days'])) ? $clean['guest_days'] : null;
                //echo $guest_days;die();
                if ($guest_days != null) {
                    $d1 = date('Y-m-d');
                    $d2 = date('Y-m-d', strtotime('+' . $guest_days . ' days', strtotime($d1)));
                }
            } elseif ($clean['subscription_type'] == "trial") {
                $tbl_setting = $this->db->where('setting_key', 'days')->get('tbl_setting')->row();
                $duration = $tbl_setting->setting_value;
                $d1 = date('Y-m-d');
                //$d2 = date('Y-m-d', strtotime('+'.$duration.' days', strtotime($d1)));
            } else {
                $d2 = $this->db->where('id', $user_id)->get('tbl_useraccount')->row('end_subscription');
                if (empty($d2)) {
                    $tbl_setting = $this->db->where('setting_key', 'days')->get('tbl_setting')->row();
                    $duration = $tbl_setting->setting_value;
                    $d1 = date('Y-m-d');
                    $d2 = date('Y-m-d', strtotime('+' . $duration . ' days', strtotime($d1)));
                }
            }
            // echo "<pre>";print_r($clean);die();
            //$dataToUpdate = array_filter($clean);
            $ck_room_exist = $this->Admin_model->getInfo('tbl_available_rooms', 'room_id', $clean['groupboard_id']);
            if (count($ck_room_exist) || $clean['groupboard_id'] == "") {
                $ck_whiteboard_exist = $this->Admin_model->getInfo('tbl_useraccount', 'whiteboar_id', $clean['groupboard_id']);

                if (empty($clean['groupboard_id'])) {
                    $trial_end_date = null;
                    if (isset($clean['trial_end_date'])) {
                        $trial_configuration = $this->Admin_model->getInfo('tbl_setting', 'setting_key', 'days');
                        if (isset($trial_configuration[0]['setting_value'])) {
                            $Date = date('Y-m-d');
                            $trial_end_date = date('Y-m-d', strtotime($Date . ' + ' . $trial_configuration[0]['setting_value'] . ' days'));
                        }
                    }

                    if (!empty($clean['user_pawd'])) {
                        $dataToUpdate = [
                            'user_type' => $clean['user_type'],
                            'country_id' => $clean['country_id'],
                            'children_number' => isset($clean['numOfChild']) ? $clean['numOfChild'] : null,
                            'name' => $clean['name'],
                            'user_email' => $clean['user_email'],
                            'student_grade' => isset($clean['grade']) ? $clean['grade'] : null,
                            'user_mobile' => $clean['full_phone'],
                            'trial_end_date' => $trial_end_date,
                            // 'user_mobile' => $clean['user_mobile'],
                            'user_pawd' => md5($clean['user_pawd']),
                            'SCT_link' => $clean['SCT_link'],
                            'subscription_type' => $clean['subscription_type'],
                            'suspension_status' => (isset($clean['suspension_status']) && $clean['suspension_status'] == 1) ? 1 : 0,
                            'direct_deposite' => (isset($clean['direct_deposite']) && $clean['direct_deposite'] == 1) ? 1 : 0,
                            'whiteboar_id' => 0,
                            'tutor_permission' => $clean['tutor_permission'],
                            'sms_status_stop' => $clean['sms_status_stop'],
                            'end_subscription' => (isset($d2)) ? $d2 : null,
                            'unlimited' => isset($clean['unlimited']) ? $clean['unlimited'] : 0,
                        ];
                    } else {

                        $dataToUpdate = [
                            'user_type' => $clean['user_type'],
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
                            'suspension_status' => (isset($clean['suspension_status']) && $clean['suspension_status'] == 1) ? 1 : 0,
                            'direct_deposite' => (isset($clean['direct_deposite']) && $clean['direct_deposite'] == 1) ? 1 : 0,
                            'whiteboar_id' => 0,
                            'tutor_permission' => $clean['tutor_permission'],
                            'sms_status_stop' => $clean['sms_status_stop'],
                            'end_subscription' => (isset($d2)) ? $d2 : null,
                            'unlimited' => isset($clean['unlimited']) ? $clean['unlimited'] : 0,
                        ];
                    }



                    //if course requested, map as registered course with student id
                    if (count($clean['course'])) {
                        $courseUserMap = [];
                        $registerCourseStatus = 0;
                        foreach ($clean['course'] as $course) {

                            $checkCourse = $this->Admin_model->checkRegisterCourse($course, $user_id);
                            if ($checkCourse > 0) {
                                $registerCourseStatus = 1;
                            } else {
                                $registerCourseStatus = 0;
                            }
                            $rs_course_cost    = $this->RegisterModel->getCourseCost($course['course_id']);
                            $courseUserMap[] = [
                                'course_id' => $course,
                                'user_id' => $user_id,
                                'created' => time(),
                                'cost' => $rs_course_cost[0]['courseCost'],
                                'endTime' => (isset($d2)) ? $d2 : null,
                            ];
                        }

                        //remove previous records
                        //$this->Admin_model->deleteInfo('tbl_registered_course', 'user_id', $user_id);
                        //insert new courses
                        if ($registerCourseStatus == 0) {
                            //$this->Admin_model->insertBatch('tbl_registered_course', $courseUserMap);
                        }
                    }

                    $this->Admin_model->updateInfo('tbl_useraccount', 'id', $user_id, $dataToUpdate);
                    if (isset($clean['direct_deposite']) && $clean['direct_deposite'] == 1) {
                        $time = time();
                        $this->db->where('payment_status', 'pending')->where('user_id', $user_id)->where('PaymentEndDate >', $time)->where('paymentType', 3)->update('tbl_payment', ['payment_status' => 'Completed', 'PaymentDate' => $time]);
                        if ($clean['user_type'] == 6) {
                            $this->set_referral_point_deposit_user($user_id);
                        }
                    } else {
                        $time = time();
                        $this->db->where('payment_status', 'Completed')->where('user_id', $user_id)->where('PaymentEndDate >', $time)->where('paymentType', 3)->update('tbl_payment', ['payment_status' => 'pending']);
                    }

                    $this->session->set_flashdata('success_msg', 'User updated successfully');
                } else {

                    if (count($ck_whiteboard_exist) == 0 || $ck_whiteboard_exist[0]['id'] == $user_id) {

                        $trial_end_date = null;
                        if (isset($clean['trial_end_date'])) {
                            $trial_configuration = $this->Admin_model->getInfo('tbl_setting', 'setting_key', 'days');
                            if (isset($trial_configuration[0]['setting_value'])) {
                                $Date = date('Y-m-d');
                                $trial_end_date = date('Y-m-d', strtotime($Date . ' + ' . $trial_configuration[0]['setting_value'] . ' days'));
                            }
                        }

                        if (!empty($clean['user_pawd'])) {
                            $dataToUpdate = [
                                'user_type' => $clean['user_type'],
                                'country_id' => $clean['country_id'],
                                'children_number' => isset($clean['numOfChild']) ? $clean['numOfChild'] : null,
                                'name' => $clean['name'],
                                'user_email' => $clean['user_email'],
                                'student_grade' => isset($clean['grade']) ? $clean['grade'] : null,
                                'user_mobile' => $clean['full_phone'],
                                'trial_end_date' => $trial_end_date,
                                // 'user_mobile' => $clean['user_mobile'],
                                'user_pawd' => md5($clean['user_pawd']),
                                'SCT_link' => $clean['SCT_link'],
                                'subscription_type' => $clean['subscription_type'],
                                'suspension_status' => (isset($clean['suspension_status']) && $clean['suspension_status'] == 1) ? 1 : 0,
                                'direct_deposite' => (isset($clean['direct_deposite']) && $clean['direct_deposite'] == 1) ? 1 : 0,
                                'whiteboar_id' => $clean['groupboard_id'],
                                'tutor_permission' => $clean['tutor_permission'],
                                'sms_status_stop' => $clean['sms_status_stop'],
                                'end_subscription' => (isset($d2)) ? $d2 : null,
                                'unlimited' => isset($clean['unlimited']) ? $clean['unlimited'] : 0,
                            ];
                        } else {
                            $dataToUpdate = [
                                'user_type' => $clean['user_type'],
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
                                'suspension_status' => (isset($clean['suspension_status']) && $clean['suspension_status'] == 1) ? 1 : 0,
                                'direct_deposite' => (isset($clean['direct_deposite']) && $clean['direct_deposite'] == 1) ? 1 : 0,
                                'whiteboar_id' => $clean['groupboard_id'],
                                'tutor_permission' => $clean['tutor_permission'],
                                'sms_status_stop' => $clean['sms_status_stop'], 'end_subscription' => (isset($d2)) ? $d2 : null,
                                'unlimited' => isset($clean['unlimited']) ? $clean['unlimited'] : 0,
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
                            //$this->Admin_model->deleteInfo('tbl_registered_course', 'user_id', $user_id);//BY AS
                            //insert new courses
                            //$this->Admin_model->insertBatch('tbl_registered_course', $courseUserMap);//BY AS
                        }


                        $this->Admin_model->updateInfo('tbl_useraccount', 'id', $user_id, $dataToUpdate);

                        if (isset($clean['direct_deposite']) && $clean['direct_deposite'] == 1) {
                            $time = time();
                            $this->db->where('payment_status', 'pending')->where('user_id', $user_id)->where('PaymentEndDate >', $time)->where('paymentType', 3)->update('tbl_payment', ['payment_status' => 'Completed', 'PaymentDate' => $time]);
                            if ($clean['user_type'] == 6) {
                                $this->set_referral_point_deposit_user($user_id);
                            }
                        } else {
                            $time = time();
                            $this->db->where('payment_status', 'Completed')->where('user_id', $user_id)->where('PaymentEndDate >', $time)->where('paymentType', 3)->update('tbl_payment', ['payment_status' => 'pending']);
                        }
                        $this->session->set_flashdata('success_msg', 'User updated successfully');
                    } else {
                        $this->session->set_flashdata('error_msg', 'Room has been taken before to other user');
                    }
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Room does not exists');
            }

            redirect('edit_user/' . $user_id);
        }
    }


    // add for direct deposit course referral 
    public function set_referral_point_deposit_user($userID)
    {

        $refUsers = $this->db->where('user_id', $userID)->where('status', 0)->get('tbl_referral_users')->row();

        if (!empty($refUsers)) {

            $reffInUser     = $refUsers->user_id;
            $refferByUser   = $refUsers->refferalUser;

            $point = $this->db->where('id', 1)->get('tbl_admin_points')->row();
            $referralPoint   = $point->referral_point;
            $ref_taken_point = $point->ref_taken_point;


            $checkreffUsers = $this->db->where('user_id', $reffInUser)->get('product_poinits')->row();


            if (!empty($checkreffUsers)) {
                $totalPoint = $checkreffUsers->total_point;
                $old_referral_point = $checkreffUsers->referral_point;
                $ckrfuser['referral_point'] = $old_referral_point + $referralPoint;
                $ckrfuser['total_point']    = $referralPoint + $totalPoint;
                $this->db->where('user_id', $reffInUser)->update('product_poinits', $ckrfuser);
            } else {
                $ckrfuser['user_id'] = $reffInUser;
                $ckrfuser['referral_point'] = $referralPoint;
                $ckrfuser['total_point']    = $referralPoint;
                $this->db->insert('product_poinits', $ckrfuser);
            }


            $checkrefferByUser = $this->db->where('user_id', $refferByUser)->get('product_poinits')->row();

            if (!empty($checkrefferByUser)) {
                $totalByPoint = $checkrefferByUser->total_point;
                $old_referral_point = $checkrefferByUser->referral_point;
                $ckrfByuser['referral_point'] = $old_referral_point + $referralPoint;
                $ckrfByuser['total_point']    = $ref_taken_point + $totalByPoint;
                $this->db->where('user_id', $refferByUser)->update('product_poinits', $ckrfByuser);
            } else {
                $ckrfByuser['user_id'] = $refferByUser;
                $ckrfByuser['referral_point'] = $ref_taken_point;
                $ckrfByuser['total_point']    = $ref_taken_point;
                $this->db->insert('product_poinits', $ckrfByuser);
            }

            $this->db->where('user_id', $userID)->update('tbl_referral_users', ['status' => 1]);
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

        if ($uType == 6 || $uType == 2) { //1-12 lvl student, $upper lvl student
            //delete student answers
            $this->Admin_model->deleteInfo("tbl_student_answer", 'st_id', $uId);
            //delete progress
            $this->Admin_model->deleteInfo("tbl_studentprogress", 'student_id', $uId);
            //delete registered couse
            $this->Admin_model->deleteInfo("tbl_registered_course", 'user_id', $uId);
            //delete enrollment
            $this->Admin_model->deleteInfo("tbl_enrollment", 'st_id', $uId);
        } elseif ($uType == 3 || $uType == 4 || $uType == 5 || $uType == 7) { //tutor,school, corporate,q-study,
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
        } elseif ($uType == 1) { //parent
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
        // echo $oldCountry;
        // echo $newCountry;die();
        $newCountryCode = isset($post['newCountryCode']) ? $post['newCountryCode'] : '';
        $oldInfo = $this->Admin_model->search('tbl_country', ['countryName' => $oldCountry]);
        $dataToInsert = [
            'countryName' => $newCountry,
            'countryCode' => $newCountryCode,
        ];
        $newCountryId = $this->Admin_model->insertInfo('tbl_country', $dataToInsert);

        //echo $oldInfo[0]['id'];die();
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
        $oldInfo = $this->Admin_model->search('tbl_country', ['countryName' => $oldCountry]);
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
            $oldModuleQues = $this->Admin_model->search('tbl_modulequestion', ['module_id' => $map['old']]);

            if (count($oldModuleQues)) {
                foreach ($oldModuleQues as $question) {
                    if ($newGrade) {
                        $changeCol = 'studentgrade';
                        $changeVal = $newGrade;
                        $newQuesId = $this->Admin_model->copy('tbl_question', ['id' => $question['question_id']], $changeCol, $changeVal);
                    } elseif ($newCountry) {
                        $changeCol = 'country';
                        $changeVal = $newCountry;
                        $newQuesId = $this->Admin_model->copy('tbl_question', ['id' => $question['question_id']], $changeCol, $changeVal);
                    }


                    $dataToInsert = [
                        'question_id' => $newQuesId,
                        'question_type' => $question['question_type'],
                        'module_id' => $map['new'],
                        'question_order' => $question['question_order'],
                        'created' => time(),
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
        $data['subscription_type'] = -1; //$this->input->post('subscription_type');
        $data['user_type'] = $this->input->post('user_type');
        $data['country_id'] = $this->input->post('country_id');

        $data['country_info'] = $this->Admin_model->getInfo('tbl_country', 'id', $data['country_id']);
        // $data['course_info'] = $this->Admin_model->get_course($data['subscription_type'], $data['user_type'], $data['country_id']);
        $data['course_info'] = $this->Admin_model->get_course($data['user_type'], $data['country_id']);
        $data['trial_course_info'] = $this->Admin_model->get_trial_course($data['user_type'], $data['country_id']);

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
        // echo $_FILES['file']['name']."<pre>";print_r($_POST);die();
        $data['country_id'] = $_POST['country_id'];
        //$data['courseName'] = strip_tags(trim(html_entity_decode($_POST['courseName'], ENT_QUOTES)));
        $data['courseName']  = str_replace(["\r\n", "\r", "\n"], "", $_POST['courseName']);
        //$data['courseName'] = $_POST['courseName'];

        $data['courseCost'] = $_POST['courseCost'];
        $data['is_enable'] = $_POST['is_enable'];
        $data['user_type'] = $_POST['user_type'];
        $data['course_status'] = 1;
        // $data['subscription_type'] = $_POST['subscription_type'];
        $json = array();
        if($_FILES['file']['name'] != ''){
			$config['upload_path'] = './assets/course_image';
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
                $data['image_name'] = $main_image;
                $json['image_name'] = $main_image;
                
			}else{
				// $json['image_error']	= array('error' => $this->upload->display_errors());
				$json['image_name'] ='';
			}
		}

        $course_id = $_POST['course_id'];
        //        echo $course_id;print_r($data);die;
        if ($course_id != '') {
            $this->Admin_model->updateInfo('tbl_course', 'id', $course_id, $data);
        } else {
            $course_id = $this->Admin_model->insertId('tbl_course', $data);
        }


        $data['course_details'] = $this->Admin_model->getInfo('tbl_course', 'id', $course_id);
        $data['box_num'] = $_POST['box_num'];
        if(isset($data['course_details'][0]['image_name'])){
            $json['image_name'] = $data['course_details'][0]['image_name'];
        }
        
        

        
        $json['course_id'] = $course_id;
        $json['course_content_div'] = $this->load->view('admin/schedule/course_content_div', $data, true);
        echo json_encode($json);
    }

    public function save_trial_course_schedule()
    {
        // echo $_FILES['file']['name']."<pre>";print_r($_POST);die();
        $data['country_id'] = $_POST['country_id'];
        //$data['courseName'] = strip_tags(trim(html_entity_decode($_POST['courseName'], ENT_QUOTES)));
        $data['courseName']  = str_replace(["\r\n", "\r", "\n"], "", $_POST['courseName']);
        //$data['courseName'] = $_POST['courseName'];

        $data['courseCost'] = $_POST['courseCost'];
        $data['is_enable'] = $_POST['is_enable'];
        $data['user_type'] = $_POST['user_type'];
        $data['course_status'] = 2;
        // $data['subscription_type'] = $_POST['subscription_type'];
        $json = array();
        if($_FILES['file']['name'] != ''){
			$config['upload_path'] = './assets/course_image';
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
                $data['image_name'] = $main_image;
                $json['image_name'] = $main_image;
                
			}else{
				// $json['image_error']	= array('error' => $this->upload->display_errors());
				$json['image_name'] ='';
			}
		}

        $course_id = $_POST['course_id'];
        //echo $course_id;print_r($data);die;

        if ($course_id != '') {
            $this->Admin_model->updateInfo('tbl_course', 'id', $course_id, $data);
        } else {
            $course_id = $this->Admin_model->insertId('tbl_course', $data);
        }


        $data['course_details'] = $this->Admin_model->getInfo('tbl_course', 'id', $course_id);
        $data['box_num'] = $_POST['box_num'];
        if(isset($data['course_details'][0]['image_name'])){
            $json['image_name'] = $data['course_details'][0]['image_name'];
        }
        
        

        
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
        $dataToUpdate = ['suspension_status' => 1];
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
        $dataToUpdate = ['suspension_status' => 0];
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
        $dateToSet      = date("Y-m-d", strtotime($currentEndDate . ' +' . $extendDays . 'days'));
        $dataToUpdate = ['trial_end_date' => $dateToSet];
        $this->Admin_model->updateInfo('tbl_useraccount', 'id', $userId, $dataToUpdate);
    }

    public function usersCurrentPackages()
    {
        $post = $this->input->post();
        $userId = $post['userId'];

        $usersCourse = $this->Admin_model->getInfo('tbl_registered_course', 'user_id', $userId);
        $usersCourse = count($usersCourse) ? array_column($usersCourse, 'course_id') : [];
        $courseNames = '';
        foreach ($usersCourse as $courseId) {
            $courseName = $this->Admin_model->courseName($courseId);
            $courseNames .= $courseName . ', ';
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
        $usersCourse = count($usersCourse) ? array_column($usersCourse, 'course_id') : [];

        //if user taken some courses then filter the result else take all courses
        if (count($usersCourse)) {
            $courseNotTakenByUser = $this->Admin_model->whereNotIn('tbl_course', 'id', $usersCourse);
        } else {
            $courseNotTakenByUser = $this->Admin_model->getAllInfo('tbl_course');
        }

        $notTakenCourses = count($courseNotTakenByUser) ? array_column($courseNotTakenByUser, 'id') : [];
        $option = '';
        foreach ($notTakenCourses as $courseId) {
            $courseName = $this->Admin_model->courseName($courseId);
            $option .= '<option value="' . $courseId . '">' . $courseName . '</option>';
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

        $data['page'] = 'WordList';
        $data['page_section'] = 'pay Tutor';
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
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
        $data['data'] = [];
        foreach ($data['wordChunk'] as $userChunk) {
            $cnt = 0;
            foreach ($userChunk as $word) {
                $checked = $word['word_approved'] ? "checked" : "";
                $word['sl'] = ++$cnt;
                $word['ques_created_at'] = date('d M Y', $word['ques_created_at']);
                $word['view'] = '<a href="q-dictionary/approve/' . $word['word_id'] . '">View</a>';
                $word['select'] = '<input class="approvalCheck" wordId="' . $word['word_id'] . '" type="checkbox" name="" ' . $checked . '>';
                $word['delete'] = '<a href="#" wordId="' . $word['word_id'] . '" class="wordDel"> <i class="fa fa-times"></i> </a>';
                $data['data'][] = $word;
            }
        }
        //$data['draw'] =1;
        $data['recordsTotal'] = $this->QuestionModel->countDictWord();
        $data['recordsFiltered'] = $data['recordsTotal'];
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

        $word = $this->QuestionModel->search('tbl_question', ['id' => $wordId]);
        if (!$word) {
            show_404();
        }
        $data['word_info'] = json_decode($word[0]['questionName']);
        $data['word'] = $word[0]['answer'];
        $data['wordId'] = $wordId;
        $data['approvalStatus'] = $word[0]['word_approved'];
        $data['creator_info'] = $this->Tutor_model->tutorInfo(['id' => $word[0]['user_id']]);
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
        $word = $this->QuestionModel->search('tbl_question', ['id' => $wordId]);
        if (!$word) {
            show_404();
        }
        $word = $word[0];
        $creatorId = $word['user_id'];
        //approve word
        $this->QuestionModel->update('tbl_question', 'id', $wordId, ['word_approved' => 1]);

        $dicPayInfo = $this->QuestionModel->search('dictionary_payment', ['word_creator' => $creatorId]);

        //if user exists on dictionary_payment table then update approved word count
        //else insert
        if (count($dicPayInfo[0])) {
            $approvedBefore = $dicPayInfo[0]['total_approved'];
            $dataToUpdate = [
                'total_approved' => $approvedBefore + 1,
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
        $word = $this->QuestionModel->search('tbl_question', ['id' => $wordId]);
        if (!$word) {
            show_404();
        }
        $word = $word[0];
        $creatorId = $word['user_id'];

        $this->QuestionModel->update('tbl_question', 'id', $wordId, ['word_approved' => 0]);
        $dicPayInfo = $this->QuestionModel->search('dictionary_payment', ['word_creator' => $creatorId]);

        //if user exists on dictionary_payment table then update approved word count
        //else insert
        if ($dicPayInfo) {
            $approvedBefore = isset($dicPayInfo[0]['total_approved']) ? $dicPayInfo[0]['total_approved'] : 0;
            $dataToUpdate = [
                'total_approved' => max(0, $approvedBefore - 1),
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

        $data['page'] = 'payTutor';
        $data['page_section'] = 'pay Tutor';
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

        $conditions = ['word_creator' => $creator];
        $paymentHistory = $this->QuestionModel->search('dictionary_payment', $conditions);
        $payable = isset($paymentHistory) ? $paymentHistory[0]['total_approved'] - $paymentHistory[0]['total_paid'] : 0;

        //VOCABULARY_PAYMENT=50
        if ($payable >= VOCABULARY_PAYMENT) {
            $dataToUpdate = [
                'total_paid' => $paymentHistory[0]['total_paid'] + VOCABULARY_PAYMENT,
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
        $data['toPay'] = $this->QuestionModel->wordCreatorToPayCount();
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
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('error_msg', 'Dialogue body required');
                redirect('dialogue/add');
            }

            $dataToInsert = [
                'body' => $post['dialogue_body'],
                'show_whole_year' => isset($post['year']) ? $post['year'] : '',
                'date_to_show' => isset($post['date']) ? $post['date'] : '',
                'link' => isset($post['link']) ? $post['link'] : '',
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
        $result = $this->Admin_model->updateInfo('dialogue', 'id', $diaId, $data);
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

    public function coursesByCountry($countryId, $studentId = 0, $type = '', $subscription_type = '')
    {
        $courses = $this->Admin_model->search('tbl_course', ['country_id' => $countryId]);
        $html = '';

        $currentURL = current_url();
        if (strpos(current_url(), "/Admin/coursesByCountry/") !== false) {
            if (!empty($this->uri->segment(4))) {
                $add_user = 1;
            }
        }


        $conditions = [
            'user_id' => $studentId,
            'endTime >' => time(),
        ];

        if ($subscription_type == "trial") {
            $conditions = [
                'user_id' => $studentId,
            ];
        }
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

            $html .= '<li class="text-left" style="width:210px;position: relative;">
            <p style="line-height: 18px;">
            </p><p>' . $course["courseName"] . '&nbsp;</p><br>
            <p style="position: absolute;bottom: 10px;">$' . $course['courseCost'] . '
            </p>
            <p class="text-right filled-in county_by_course">
            <input class="form-check-input" id="course_1" type="checkbox" name="course[]" value="' . $course['id'] . '" ' . $checked . '>
            </p>
            </li>';
        }
        if ($type == "edit") {
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

        if (isset($_POST) && !empty($_POST)) {

            $this->form_validation->set_rules('setting_key', 'Setting Key', 'required');
            $this->form_validation->set_rules('setting_value', 'Setting Value', 'required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('Failed', 'Templete Can not be empty !');
            } else {
                $this->Admin_model->updateInfo('tbl_setting', 'setting_id', $id, $_POST);
                $this->session->set_flashdata('message', 'Successfully Updated');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {

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

        if (isset($_POST) && !empty($_POST)) {

            $this->form_validation->set_rules('setting_value', 'Setting Value', 'required');
            if ($this->form_validation->run() == true) {

                $this->Admin_model->updateInfo('tbl_setting', 'setting_key', "Template Activate Status", $_POST);
                $this->session->set_flashdata('message', 'Successfully Updated');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {

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

    public function qStudyPassword()
    {
        $getEncryptPW     = $this->db->where('setting_key', 'qstudyPasswordMainEc')->get('tbl_setting')->row()->setting_type;


        if (isset($_POST['submit']) == "submit") {

            if (isset($_POST) && !empty($_POST['qStudyPass'])) {
                $this->Admin_model->updateInfo('tbl_setting', 'setting_key', "qstudyPassword", ['setting_type' => $_POST['qStudyPass']]);
            }

            if (!empty($_POST['qStudyPassMain'])) {
                // print_r($_POST);die();
                $this->Admin_model->updateInfo('tbl_setting', 'setting_key', "qstudyPasswordMain", ['setting_type' => $_POST['qStudyPassMain']]);
                $this->db->where('user_email', 'qstudy@gmail.com')->update('tbl_useraccount', ['user_pawd' => md5($_POST['qStudyPassMain'])]);
            }
            if (empty($_POST['qStudyPass'])) {
                $this->Admin_model->updateInfo('tbl_setting', 'setting_key', "qstudyPassword", ['setting_type' => '']);
            }

            if (empty($_POST['qStudyPassMain'])) {
                $this->Admin_model->updateInfo('tbl_setting', 'setting_key', "qstudyPasswordMain", ['setting_type' => '']);
                $this->db->where('user_email', 'qstudy@gmail.com')->update('tbl_useraccount', ['user_pawd' => $getEncryptPW]);
            }


            $this->session->set_flashdata('success', 'Updated Successfully');
        }

        $data['user_info'] = $this->Admin_model->getInfo('tbl_setting', 'setting_key',  "qstudyPassword");
        $data['user_info_main'] = $this->Admin_model->getInfo('tbl_setting', 'setting_key',  "qstudyPasswordMain");
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);

        $data['maincontent'] = $this->load->view('admin/qStudyPassword', $data, true);
        // print_r($data['user_info']);die();
        $this->load->view('master_dashboard', $data);
    }

    public function qStudyPasswordForNav()
    {
        $data['user_info'] = $this->Admin_model->getInfo('tbl_setting', 'setting_key',  "qstudyPassword");
        $data['user_info_main'] = $this->Admin_model->getInfo('tbl_setting', 'setting_key',  "qstudyPasswordMain");
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);

        $data['maincontent'] = $this->load->view('admin/qStudyPassword', $data, true);
        // print_r($data['user_info']);die();
        $this->load->view('master_dashboard', $data);
    }


    public function qStudyStripeSetting()
    {
        $data['stripe_info'] = $this->Admin_model->getInfo('tbl_setting', 'setting_type',  "stripe");
        $data['user_info_main'] = $this->Admin_model->getInfo('tbl_setting', 'setting_key',  "qstudyPasswordMain");
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);

        $data['maincontent'] = $this->load->view('admin/stripeSetting', $data, true);
        // echo "<pre>";
        // print_r($data['stripe_info']);die();
        $this->load->view('master_dashboard', $data);
    }

    public function stripeDetailsUpdate()
    {
        if (isset($_POST['submit']) == "submit") {
            // echo "<pre>";
            // print_r($_POST['test_publish_key']);die();
            $this->Admin_model->updateInfoStripe('tbl_setting', 'setting_key', "test_publish_key", ['setting_value' => $_POST['test_publish_key']]);
            $this->Admin_model->updateInfoStripe('tbl_setting', 'setting_key', "test_seccreet_key", ['setting_value' => $_POST['test_seccreet_key']]);
            $this->Admin_model->updateInfoStripe('tbl_setting', 'setting_key', "live_publish_key", ['setting_value' => $_POST['live_publish_key']]);
            $this->Admin_model->updateInfoStripe('tbl_setting', 'setting_key', "live_seccreet_key", ['setting_value' => $_POST['live_seccreet_key']]);
            $this->Admin_model->updateInfoStripe('tbl_setting', 'setting_key', "mode", ['setting_value' => $_POST['mode']]);


            $this->session->set_flashdata('stripe-success', 'Updated Successfully');
        }

        $data['stripe_info'] = $this->Admin_model->getInfo('tbl_setting', 'setting_type',  "stripe");
        $data['user_info_main'] = $this->Admin_model->getInfo('tbl_setting', 'setting_key',  "qstudyPasswordMain");
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);

        $data['maincontent'] = $this->load->view('admin/stripeSetting', $data, true);
        // print_r($data['user_info']);die();
        $this->load->view('master_dashboard', $data);
    }


    public function qStudyPaypalSetting()
    {
        $data['paypal_info'] = $this->Admin_model->getInfo('tbl_setting', 'setting_type',  "paypal");
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);

        $data['maincontent'] = $this->load->view('admin/paypalSetting', $data, true);
        // echo "<pre>";
        // print_r($data['paypal_info']);die();
        $this->load->view('master_dashboard', $data);
    }



    public function paypalDetailsUpdate()
    {
        if (isset($_POST['submit']) == "submit") {
            // echo "<pre>";
            // print_r($_POST['test_publish_key']);die();
            $this->Admin_model->updateInfoPaypal('tbl_setting', 'setting_key', "test_url", ['setting_value' => $_POST['test_url']]);
            $this->Admin_model->updateInfoPaypal('tbl_setting', 'setting_key', "test_business_account", ['setting_value' => $_POST['test_business_account']]);
            $this->Admin_model->updateInfoPaypal('tbl_setting', 'setting_key', "test_paypal_secret", ['setting_value' => $_POST['test_paypal_secret']]);
            $this->Admin_model->updateInfoPaypal('tbl_setting', 'setting_key', "test_paypal_signature", ['setting_value' => $_POST['test_paypal_signature']]);
            $this->Admin_model->updateInfoPaypal('tbl_setting', 'setting_key', "mode", ['setting_value' => $_POST['mode']]);
            $this->Admin_model->updateInfoPaypal('tbl_setting', 'setting_key', "live_url", ['setting_value' => $_POST['live_url']]);
            $this->Admin_model->updateInfoPaypal('tbl_setting', 'setting_key', "live_business_account", ['setting_value' => $_POST['live_business_account']]);
            $this->Admin_model->updateInfoPaypal('tbl_setting', 'setting_key', "live_paypal_secret", ['setting_value' => $_POST['live_paypal_secret']]);
            $this->Admin_model->updateInfoPaypal('tbl_setting', 'setting_key', "live_paypal_signature", ['setting_value' => $_POST['live_paypal_signature']]);


            $this->session->set_flashdata('paypal-success', 'Updated Successfully');
        }

        $data['paypal_info'] = $this->Admin_model->getInfo('tbl_setting', 'setting_type',  "paypal");
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);

        $data['maincontent'] = $this->load->view('admin/paypalSetting', $data, true);
        // print_r($data['user_info']);die();
        $this->load->view('master_dashboard', $data);
    }


    public function userSummary($id)
    {
        $data['user_info']  = $this->Admin_model->getInfo('tbl_useraccount', 'id', $id);

        $signupUser = $this->db->where('user_id', $id)->limit(1)->get('tbl_payment')->row();
        if ($signupUser) {
            $signupDate = $signupUser->PaymentDate;
            $data['signup_date'] = date('Y-m-d', $signupDate);
        }
        $subscription_type  = $data['user_info'][0]['subscription_type'];
        if ($subscription_type == 'trial') {
            $data['trial_date'] = date('Y-m-d', $data['user_info'][0]['created']);
        }

        $data['prize_won_user'] = $this->db->where('user_id', $id)->get('prize_won_users')->num_rows();
        $data['vocabulary_point'] = $this->db->where('word_creator', $id)->get('dictionary_payment')->row();

        $data['recipe_number'] = $this->db->where('user_id', $id)->get('tutor_bank_recipt_number')->row();
        //echo "<pre>";print_r($prize_won_user);die();
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/user_summary', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function bank_recipt_number_submit()
    {

        $data['user_id'] = $this->input->post('userId');
        $data['bank_recipt_number'] = $this->input->post('bank_recipt_number');

        $check = $this->db->where('user_id', $this->input->post('userId'))->get('tutor_bank_recipt_number')->row();
        if (!empty($check)) {
            $this->db->where('user_id', $this->input->post('userId'))->update('tutor_bank_recipt_number', $data);
        } else {
            $this->db->insert('tutor_bank_recipt_number', $data);
        }

        redirect('userSummary/' . ($this->input->post('userId')));
    }

    public function notification()
    {

        $tbl_setting = $this->db->where('setting_key', 'days')->get('tbl_setting')->row();
        $duration    = $tbl_setting->setting_value;
        $date        = date('Y-m-d');
        $d1          = date('Y-m-d', strtotime('-' . $duration . ' days', strtotime($date)));
        $trialEndDate = strtotime($d1);

        //$data['direct_deposit_count'] = $this->Admin_model->getInfoDirectDepositUserCount('tbl_useraccount', 'subscription_type', 'direct_deposite');
        $data['direct_deposit_count'] = $this->Admin_model->getInfoDirectDepositUserList();

        $email_messages = $this->db->select('COUNT(user_id) as total')->where('user_id !=', null)->where('status !=', 'seen')->group_by('user_id')->get('user_message')->result_array();

        $data['email_messages'] = count($email_messages);
        $limit = 999999;
        $offset = 0;

        //$data['trial_user_info'] = $this->Admin_model->getInfoTrialUser('tbl_useraccount', 'subscription_type', 'trial',$limit,$offset);
        $data['trial_user_info'] = $this->Admin_model->getInfoTrialActiveUser('tbl_useraccount', 'subscription_type', 'trial', $trialEndDate, $limit, $offset);
        $data['trial_user_info'] = count($data['trial_user_info']);

        $inactive_user_info = $this->Admin_model->getInfoInactiveUser('tbl_useraccount', 'subscription_type', 'signup', $limit, $offset);
        $inactive_trial_user_info = $this->Admin_model->getInfoInactiveTrialUser('tbl_useraccount', 'subscription_type', 'trial', $trialEndDate, $limit, $offset);
        $margeBoughtInactiveUser = array_merge($inactive_user_info, $inactive_trial_user_info);
        $data['inactive_user_info'] = count($inactive_trial_user_info);
        //echo "<pre>";print_r($add_attributes);die();

        $signup_user_info = $this->Admin_model->getAllSignupUsers('tbl_useraccount', 'subscription_type', 'signup', $limit, $offset);
        $data['signup_user_info'] = count($signup_user_info);


        $suspend_user_info = $this->Admin_model->getInfoSuspendUser('tbl_useraccount', 'suspension_status', 1, $limit, $offset);
        $data['suspend_user_info'] = count($suspend_user_info);

        $guest_user_info = $this->Admin_model->getAllguestUsers('tbl_useraccount', 'subscription_type', 'guest', $limit, $offset);
        $data['guest_user_info'] = count($guest_user_info);


        $parent_list = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'user_type', 1, $limit, $offset);
        $data['parent_list'] = count($parent_list);


        $upper_student = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'user_type', 2, $limit, $offset);
        $data['upper_student'] = count($upper_student);


        $tutors_list = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'user_type', 3, $limit, $offset);
        $data['tutors_list'] = count($tutors_list);


        $school_list = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'user_type', 4, $limit, $offset);
        $data['school_list'] = count($school_list);


        $corporate_list = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'user_type', 5, $limit, $offset);
        $data['corporate_list'] = count($corporate_list);

        $student_list = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'user_type', 6, $limit, $offset);
        $data['student_list'] = count($student_list);

        $aus_users = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'country_id', 1, $limit, $offset);
        $data['aus_users'] = count($aus_users);


        $uk_users = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'country_id', 9, $limit, $offset);
        $data['uk_users'] = count($uk_users);

        $bd_users = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'country_id', 8, $limit, $offset);
        $data['bd_users'] = count($bd_users);

        $usa_users = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'country_id', 2, $limit, $offset);
        $data['usa_users'] = count($usa_users);

        $can_users = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'country_id', 10, $limit, $offset);
        $data['can_users'] = count($can_users);


        $deposite_resources = $this->Admin_model->getDepositeResources($limit, $offset);
        $data['deposite_resources'] = count($deposite_resources);


        // check whiteboard
        $groupboardResources = $this->Admin_model->whiteboardPurchesLists($limit, $offset);  //whiteboard AS 
        $data['groupboardResources'] = count($groupboardResources);


        $groupboardSignup = $this->Admin_model->whiteboardPurchesSignupLists('signup', $limit, $offset);  //whiteboard AS 
        $data['groupboardSignup'] = count($groupboardSignup);


        $groupboardTrialList = $this->Admin_model->whiteboardPurchesSignupLists('trial', $limit, $offset);  //whiteboard AS 
        $data['groupboardTrialList'] = count($groupboardTrialList);

        $CommissiontutorList = $this->Admin_model->tutorCommisionForAssignStudent($limit, $offset);
        // $CommissiontutorList = $this->Admin_model->getTutorCommission('tbl_tutor_commisions', 'status',0,'tutorId',$user_id);

        $data['CommissiontutorList'] = count($CommissiontutorList);


        $vocabularyCommision = $this->Admin_model->vocabularyCommisionCheck($limit, $offset);
        $data['vocabularyCommision'] = count($vocabularyCommision);


        $checkStudentPercentage = $this->Admin_model->checkStudentPercentageNotification('daily_modules', $limit, $offset);
        $ninteyPercentageMark = [];

        foreach ($checkStudentPercentage as $key => $value) {
            $total_row = $value['total_row'];
            $percentage = number_format($value['percentage']);

            if ($total_row >= 2 && $percentage >= 90) {
                //echo $percentage;die;
                $ninteyPercentageMark[$key]['user_id'] = $value['user_id'];
                $ninteyPercentageMark[$key]['name'] = $value['name'];
            }
        }

        $data['ninteyPercentageMark'] = count($ninteyPercentageMark);


        $student_prize_list = $this->Admin_model->getInfoPrizeWinerUser($limit, $offset);
        $data['student_prize_list'] = count($student_prize_list);
        // echo "<pre>"; print_r($data['ninteyPercentageMark']);die;

        $creative_registers = $this->Admin_model->getallcreative();
        $data['total_creative_reg'] = count($creative_registers);

        $idea_created_students = $this->Admin_model->idea_created_students_list();
        $data['idea_created_students'] = count($idea_created_students);
        // echo "<pre>";print_r($data['idea_created_students']);die();

        $idea_created_tutors = $this->Admin_model->idea_created_tutor_list();
        $data['ides_notification'] = $this->Admin_model->get_idea_notification();
        $data['total_tutors'] = count($idea_created_tutors);
        //echo "<pre>";print_r($data['ides_notification']);die();

        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification', $data, true);
        $this->load->view('master_dashboard', $data); 
    }


    public function userEmailList()
    {

        $email_messages = $this->db->select('COUNT(user_id) as total')->where('user_id !=', null)->where('status !=', 'seen')->group_by('user_id')->get('user_message')->result_array();

        $data['messages_users'] = $this->db->where('user_id !=', null)->where('status !=', 'seen')->group_by('user_id')->get('user_message')->result_array();
        // print_r($data['messages_users']);die;
        $data['email_messages'] = count($email_messages);
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/user_message_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function trail_list()
    {

        $limit = 30;
        $offset = 0;

        $tbl_setting = $this->db->where('setting_key', 'days')->get('tbl_setting')->row();
        $duration    = $tbl_setting->setting_value;
        $date        = date('Y-m-d');
        $d1          = date('Y-m-d', strtotime('-' . $duration . ' days', strtotime($date)));
        $trialEndDate = strtotime($d1);

        //$data['trial_user_info'] = $this->Admin_model->getInfoTrialUser('tbl_useraccount', 'subscription_type', 'trial',$limit,$offset);
        $data['trial_user_info'] = $this->Admin_model->getInfoTrialActiveUser('tbl_useraccount', 'subscription_type', 'trial', $trialEndDate, $limit, $offset);

        //$data['trial_user_info'] = $this->Admin_model->getInfoTrialUser('tbl_useraccount', 'subscription_type', 'trial',$limit,$offset);


        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/trial_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }


    public function inactive_users()
    {
        $tbl_setting = $this->db->where('setting_key', 'days')->get('tbl_setting')->row();
        $duration = $tbl_setting->setting_value;
        $date = date('Y-m-d');
        $d1  = date('Y-m-d', strtotime('-' . $duration . ' days', strtotime($date)));
        $trialEndDate = strtotime($d1);

        $limit = 30;
        $offset = 0;
        $inactive_user_info = $this->Admin_model->getInfoInactiveUser('tbl_useraccount', 'subscription_type', 'signup', $limit, $offset);
        $inactive_trial_user_info = $this->Admin_model->getInfoInactiveTrialUser('tbl_useraccount', 'subscription_type', 'trial', $trialEndDate, $limit, $offset);
        $margeBoughtInactiveUser = array_merge($inactive_user_info, $inactive_trial_user_info);

        $data['inactive_user_info'] = $inactive_trial_user_info;
        // $users = $this->Admin_model->getInfoInactiveUser('tbl_useraccount', 'subscription_type', 'signup',$limit,$offset);
        $users = $inactive_trial_user_info;
        //echo "<pre>";print_r($users);die();
        foreach ($users as $key => $value) {
            $this->db->where('id', $value['id'])->update('tbl_useraccount', ['subscription_status' => 0]);
        }
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Inactive User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/inactive_users', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function next_trial_list()
    {
        $offset = $this->input->post('offset');
        $limit = 30;
        //$data['trial_user_info'] = $this->Admin_model->getInfoTrialUser('tbl_useraccount', 'subscription_type', 'trial',$limit,$offset);
        $data['trial_user_info'] = $this->Admin_model->getInfoTrialActiveUser('tbl_useraccount', 'subscription_type', 'trial', $trialEndDate, $limit, $offset);
        if (count($data['trial_user_info']) > 0) {
            $response = $this->load->view('admin/user/list_trial_user', $data, TRUE);
            echo $response;
        } else {
            echo 'empty';
        }
    }

    public function next_inactive_users_list()
    {
        $tbl_setting = $this->db->where('setting_key', 'days')->get('tbl_setting')->row();
        $duration = $tbl_setting->setting_value;
        $date = date('Y-m-d');
        $d1  = date('Y-m-d', strtotime('-' . $duration . ' days', strtotime($date)));
        $trialEndDate = strtotime($d1);

        $offset = $this->input->post('offset');
        $limit = 30;
        $inactive_user_info = $this->Admin_model->getInfoInactiveUser('tbl_useraccount', 'subscription_type', 'signup', $limit, $offset);
        $inactive_trial_user_info = $this->Admin_model->getInfoInactiveTrialUser('tbl_useraccount', 'subscription_type', 'trial', $trialEndDate, $limit, $offset);
        $margeBoughtInactiveUser = array_merge($inactive_user_info, $inactive_trial_user_info);
        // $data['inactive_user_info'] = $margeBoughtInactiveUser;
        //print_r($inactive_user_info);

        if (count($inactive_trial_user_info) < 1) {
            echo 'empty';
            die();
        }
        $output = '';
        foreach ($inactive_trial_user_info as $key => $value) {
            $output .= '<div class="col-md-4" style="border: 1px solid lightblue;">';
            $output .= '<a href="edit_user/' . $value['id'] . '"><p>' . $value['name'] . '</p></a>';
            $output .= '</div>';
        }
        echo $output;
    }


    public function schoolTutorNext()
    {
        $offset = $this->input->post('val');
        $parent_id  = $this->input->post('parent_id');
        $limit = 30;
        $teachers = $this->db->where('parent_id', $parent_id)->limit($limit, $offset)->get('tbl_useraccount')->result_array();
        if (count($teachers) < 1) {
            echo 'empty';
            die();
        }
        $output = '';
        foreach ($teachers as $key => $value) {
            $output .= '<div class="col-sm-2">';
            $output .= '<a  href="edit_user/' . $value["id"] . '"> ' . $value['name'] . '</a>';
            $output .= '</div>';
        }
        echo $output;
    }


    public function suspend_users()
    {

        $limit = 30;
        $offset = 0;
        $data['suspend_user_info'] = $this->Admin_model->getInfoSuspendUser('tbl_useraccount', 'suspension_status', 1, $limit, $offset);

        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Suspend User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/suspend_users', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function next_suspend_users_list()
    {
        $offset     = $this->input->post('offset');
        $limit = 30;
        $inactive_user_info = $this->Admin_model->getInfoSuspendUser('tbl_useraccount', 'suspension_status', 1, $limit, $offset);
        //print_r($inactive_user_info);
        $output = '';
        foreach ($inactive_user_info as $key => $value) {
            $output .= '<div class="col-md-4" style="border: 1px solid lightblue;">';
            $output .= '<a href="edit_user/' . $value['id'] . '"><p>' . $value['name'] . '</p></a>';
            $output .= '</div>';
        }
        echo $output;
    }

    public function product_list()
    {
        $data['products'] = $this->db->get('tbl_products')->result_array();
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Product List';
        $data['page_section'] = 'Product';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/product/product_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function product_add()
    {
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Product List';
        $data['page_section'] = 'Product';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/product/add_product', $data, true);
        $this->load->view('master_dashboard', $data);
    }


    public function add_product_submit()
    {
        $post  = $this->input->post();
        $clean = $this->security->xss_clean($post);
        // print_r($clean);die;
        $config['upload_path']          = './img/product/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1024;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error['error']);
            redirect('add_product');
        } else {
            $Updata = array('image' => $this->upload->data('file_name'));
            //$data['image'] = $data['upload_data'];
        }

        $Updata['product_title'] = isset($clean['product_title']) ? $clean['product_title'] : '';
        $Updata['product_details'] = isset($clean['product_details']) ? $clean['product_details'] : '';
        $Updata['product_point'] = isset($clean['product_point']) ? $clean['product_point'] : '';

        $this->db->insert('tbl_products', $Updata);
        //echo"<pre>";print_r($data);die;
        $this->session->set_flashdata('success', 'Product Create Successfully');
        redirect('product_list');
    }

    public function edit_product($id)
    {

        $data['product'] = $this->db->where('id', $id)->get('tbl_products')->row();
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Product Edit';
        $data['page_section'] = 'Product';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/product/edit_product', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function edit_product_submit()
    {
        //load file helper
        $post  = $this->input->post();
        $clean = $this->security->xss_clean($post);
        $id = $clean['id'];

        $config['upload_path']          = './img/product/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1024;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;


        $this->load->library('upload', $config);
        if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
            if (!($this->upload->do_upload('image'))) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);
                redirect('edit_product/' . $id);
            } else {
                $Updata = array('image' => $this->upload->data('file_name'));
            }
        }

        $Updata['product_title'] = isset($clean['product_title']) ? $clean['product_title'] : '';
        $Updata['product_details'] = isset($clean['product_details']) ? $clean['product_details'] : '';
        $Updata['product_point'] = isset($clean['product_point']) ? $clean['product_point'] : '';

        //echo"<pre>";print_r($Updata);die;
        $this->db->where('id', $id)->update('tbl_products', $Updata);
        $this->session->set_flashdata('success', 'Product Update Successfully');
        redirect('product_list');
    }


    public function delete_product($id)
    {
        $product = $this->db->where('id', $id)->get('tbl_products')->row();
        $path = base_url() . 'img/product/' . $product->image;
        $update = $this->db->where('id', $id)->delete('tbl_products');
        if ($update) {
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $this->session->set_flashdata('success', 'Product Delete Successfully');
        redirect('product_list');
    }

    public function product_point_admin()
    {

        $data['point'] = $this->db->get('tbl_admin_points')->row();
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Product Point';
        $data['page_section'] = 'Product';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/product/product_point', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function update_product_point()
    {
        $data = $this->input->post();
        $this->db->where('id', 1)->update('tbl_admin_points', $data);

        $this->session->set_flashdata('success', 'Point Update Successfully');
        redirect('product_point_admin');
    }

    public function student_prize_list()
    {

        $limit = 30;
        $offset = 0;
        $data['student_prize_list'] = $this->Admin_model->getInfoPrizeWinerUser($limit, $offset);

        //echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Prize Winner User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/student_prize_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function direct_deposit_list()
    {

        $limit = 30;
        $offset = 0;
        $data['direct_deposit_list'] = $this->Admin_model->getInfoDirectDepositUserAllByList($limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Direct Deposit User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/direct_deposit_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function deleteContactMessage()
    {
        $id = $this->input->post('val');
        $this->db->where('id', $id)->delete('user_message');
        echo 1;
    }



    public function signup_users()
    {

        $limit = 30;
        $offset = 0;
        $data['signup_user_list'] = $this->Admin_model->getAllSignupUsers('tbl_useraccount', 'subscription_type', 'signup', $limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Signup User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/signup_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }


    public function guest_users()
    {

        $limit = 30;
        $offset = 0;
        $data['guest_user_list'] = $this->Admin_model->getAllguestUsers('tbl_useraccount', 'subscription_type', 'guest', $limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Signup User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/guest_user_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }


    public function parent_users()
    {
        $limit = 30;
        $offset = 0;
        $data['parent_list'] = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'user_type', 1, $limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Signup User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/parent_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function student_users()
    {
        $limit = 30;
        $offset = 0;
        $data['student_list'] = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'user_type', 6, $limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Signup User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/students', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function upper_level_users()
    {
        $limit = 30;
        $offset = 0;
        $data['upper_student_list'] = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'user_type', 2, $limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Signup User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/upper_student', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function tutor_users()
    {
        $limit = 30;
        $offset = 0;
        $data['tutors_list'] = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'user_type', 3, $limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Signup User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/tutors', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function corporateList()
    {
        $limit = 30;
        $offset = 0;
        $data['corporate_list'] = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'user_type', 5, $limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Signup User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/corporates', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function schoolList()
    {
        $limit = 30;
        $offset = 0;
        $data['schoolList'] = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'user_type', 4, $limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Signup User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/schools', $data, true);
        $this->load->view('master_dashboard', $data);
    }


    public function country_users_list($id)
    {
        // echo $id;die;
        $limit = 30;
        $offset = 0;
        if ($id == 1) {
            $data['country'] = 'Australia';
            $data['countryId'] = 1;
        } else if ($id == 2) {
            $data['country'] = 'USA';
            $data['countryId'] = 2;
        } else if ($id == 8) {
            $data['country'] = 'Bangladesh';
            $data['countryId'] = 8;
        } else if ($id == 9) {
            $data['country'] = 'UK';
            $data['countryId'] = 9;
        } else if ($id == 10) {
            $data['country'] = 'Canada';
            $data['countryId'] = 10;
        }
        $data['country_users'] = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'country_id', $id, $limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Country Wise User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/country_users', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function next_aus_users_list()
    {
        $offset = $this->input->post('offset');
        $country_id = $this->input->post('country_id');
        $limit = 30;
        $data['next_user_info'] = $this->Admin_model->getUsersTypeWaise('tbl_useraccount', 'country_id', $country_id, $limit, $offset);
        if (count($data['next_user_info']) > 0) {
            $response = $this->load->view('admin/user/notification/next_users_list', $data, TRUE);
            echo $response;
        } else {
            echo "empty";
        }
    }

    public function depositeResources()
    {
        $limit = 30;
        $offset = 0;
        $data['list_of_users'] = $this->Admin_model->getDepositeResources($limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Direct Deposit(resourse)';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/list_of_users', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function next_deposit_users_list()
    {

        $offset = $this->input->post('offset');
        $limit = 30;
        $data['next_user_info'] =  $this->Admin_model->getDepositeResources($limit, $offset);
        if (count($data['next_user_info']) > 0) {
            $response = $this->load->view('admin/user/notification/next_users_list', $data, TRUE);
            echo $response;
        } else {
            echo "empty";
        }
    }



    public function groupboardResources()
    {
        $limit = 30;
        $offset = 0;

        // check whiteboard
        $data['list_of_users'] = $this->Admin_model->whiteboardPurchesLists($limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Groupboard (resourse)';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/list_of_users', $data, true);
        $this->load->view('master_dashboard', $data);
    }


    public function groupboardSignup()
    {
        $limit = 30;
        $offset = 0;

        // check whiteboard
        $data['list_of_users'] = $this->Admin_model->whiteboardPurchesSignupLists('signup', $limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Groupboard(signup)';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/list_of_users', $data, true);
        $this->load->view('master_dashboard', $data);
    }


    public function groupboardTrialList()
    {
        $limit = 30;
        $offset = 0;

        // check whiteboard
        $data['list_of_users'] = $this->Admin_model->whiteboardPurchesSignupLists('trial', $limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Groupboard (trial)';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/list_of_users', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function tutorCommisionLists()
    {
        $limit = 30;
        $offset = 0;

        // check whiteboard
        $data['list_of_users'] = $this->Admin_model->tutorCommisionForAssignStudent($limit, $offset);
        //echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Tutor(commission)';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/list_of_users', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function vocabularyCommisionLists()
    {
        $limit = 30;
        $offset = 0;

        // check vocabularyCommisionCheck
        $data['list_of_users'] = $this->Admin_model->vocabularyCommisionCheck($limit, $offset);

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Vocabulary(commission)';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/list_of_users', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function ninteyPercentageMark()
    {
        $limit = 30;
        $offset = 0;

        $checkStudentPercentage = $this->Admin_model->checkStudentPercentageNotification('daily_modules', $limit, $offset);
        $ninteyPercentageMark = [];

        foreach ($checkStudentPercentage as $key => $value) {
            $total_row = $value['total_row'];
            $percentage = number_format($value['percentage']);

            if ($total_row >= 2 && $percentage >= 90) {
                //echo $percentage;die;
                $ninteyPercentageMark[$key]['user_id'] = $value['user_id'];
                $ninteyPercentageMark[$key]['name'] = $value['name'];
            }
        }

        // check whiteboard
        $data['list_of_users'] = $ninteyPercentageMark;

        // echo "<pre>";print_r($data);die;
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Student who score 90% up';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/notification/list_of_users', $data, true);
        $this->load->view('master_dashboard', $data);
    }


    public function sendMessageCompose()
    {
        $data['message']    = $this->input->post('textmessage');
        $data['reciver_id'] = $this->input->post('reciver_id');
        $data['date_time']  = date('Y-m-d H:i a');
        $data['date']       = date('Y-m-d');
        $data['time']       = time();

        $this->db->insert('tbl_compose_message', $data);
        $insert_id = $this->db->insert_id();
        echo $insert_id;
    }


    public function directDepositSetting($id)
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        if ($clean) {
            $country_id   = $clean['country_id'];
            $data['bank_details'] = $clean['bank_details'];
            $data['country_id']   = $clean['country_id'];
            $data['active_status']   = $clean['user_active_status'] ? $clean['user_active_status'] : 0;
            $checkDepositDetails = $this->Admin_model->checkDepositDetails('direct_deposit_admin_setting', $country_id);
            if ($checkDepositDetails > 0) {
                $checkDepositDetails = $this->Admin_model->checkDepositDetailsUpdate('direct_deposit_admin_setting', $country_id, $data);

                $this->session->set_flashdata('success_msg', 'Updated successfully');
            } else {
                $checkDepositDetails = $this->Admin_model->checkDepositDetailsInsert('direct_deposit_admin_setting', $country_id, $data);
                $this->session->set_flashdata('success_msg', 'Insert successfully');
            }
            redirect('/directDepositSetting/' . $country_id);
        } else {
            $data['country_info'] = $this->Admin_model->getInfo('tbl_country', 'id', $id);

            $data['getDepositDetails'] = $this->Admin_model->getDepositDetails('direct_deposit_admin_setting', $id);
            //echo "<pre>";print_r($data['getDepositDetails']);die();
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            $data['page'] = 'Country Wise';
            $data['page_section'] = 'Country';

            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

            $data['maincontent'] = $this->load->view('admin/schedule/directDepositSetting', $data, true);
            $this->load->view('master_dashboard', $data);
        }
    }


    public function emailBankDetails()
    {
        $data['email_message'] = $this->input->post('data');
        $data['country_id'] = $this->input->post('country_id');
        $country_id = $this->input->post('country_id');

        $checkDepositDetails = $this->Admin_model->checkDepositDetails('direct_deposit_admin_setting', $country_id);
        if ($checkDepositDetails > 0) {
            $checkDepositDetails = $this->Admin_model->checkDepositDetailsUpdate('direct_deposit_admin_setting', $country_id, $data);

            echo '<div class="alert alert-success msg_success_add">Updated successfully</div>';
        } else {
            $checkDepositDetails = $this->Admin_model->checkDepositDetailsInsert('direct_deposit_admin_setting', $country_id, $data);

            echo '<div class="alert alert-success msg_success_add">Insert successfully</div>';
        }
    }



    public function inboxBankDetails()
    {
        $data['inbox_message'] = $this->input->post('data');
        $data['country_id'] = $this->input->post('country_id');
        $country_id = $this->input->post('country_id');

        $checkDepositDetails = $this->Admin_model->checkDepositDetails('direct_deposit_admin_setting', $country_id);
        if ($checkDepositDetails > 0) {
            $checkDepositDetails = $this->Admin_model->checkDepositDetailsUpdate('direct_deposit_admin_setting', $country_id, $data);

            echo '<div class="alert alert-success msg_success_add">Updated successfully</div>';
        } else {
            $checkDepositDetails = $this->Admin_model->checkDepositDetailsInsert('direct_deposit_admin_setting', $country_id, $data);

            echo '<div class="alert alert-success msg_success_add">Insert successfully</div>';
        }
    }



    public function creativeUserList()
    { 

        $creative_registers = $this->Admin_model->getallcreativeDetails();
        $data['creative_registers'] = $creative_registers;
 
        // echo"<pre>"; print_r($creative_registers);die();

        $data['total_creative'] = count($creative_registers);
        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'User List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/creative_user_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function addExamine()
    {

        $data['selected_student'] = $this->input->post('users');

        if (!empty($data['selected_student'])) {

            $data['alltutor'] = $this->Admin_model->getalltutor();
            // echo"<pre>"; print_r($data['alltutor']);die();

            $data['date'] = date('d/m/Y');
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            $data['page'] = 'Tutor List';
            $data['page_section'] = 'User';

            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

            $data['maincontent'] = $this->load->view('admin/user/add_examine', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function saveandviewdetails()
    {

        $assigned_student = $this->input->post('assigned_student');
        $examine = $this->input->post('examine');
        // print_r($assigned_student);die();
        $data['view_assign_student'] = $this->Admin_model->assignExamine($assigned_student, $examine);
        $data['examine'] = $this->Admin_model->getExamineDetails($examine);

        // print_r($data['examine']);die();

        $data['date'] = date('d/m/Y');
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['page'] = 'Tutor List';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/view_examine_assined_students', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function  new_idea_create_student()
    {

        $data['creative_students'] = $this->Admin_model->idea_created_student_list();
        $data['created_idea_students'] = $this->Admin_model->idea_created_students();
        // echo "<pre>";print_r($data['created_idea_students']);die();
    

        $data['page_title'] = '.:: Q-Study :: New Idea created student...';
        $data['page'] = 'New Idea created student';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/new_idea_create_student', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function  idea_created_student_details($student_id, $grade)
    {

        $data['student_ideas'] = $this->Admin_model->get_all_ideas($student_id);
        $data['student_info'] = $this->Admin_model->get_student_info($student_id);
        // $data['idea_remake_info'] = $this->Admin_model->check_admin_remake_idea_info($student_id);
        $data['grade'] = $grade;


        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('admin/user/idea_created_student_details', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function admin_idea_correction_workout($idea_id, $student_id)
    {

        $data['student_ans_details'] = $this->Admin_model->get_student_ans($idea_id, $student_id);
        $data['admin_id'] = $this->session->userdata('user_id');

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('admin/user/idea_correction_workout', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function admin_workout_save()
    {
        $student_id = $this->input->post("student_id");
        $idea_id = $this->input->post("idea_id");
        $idea_no = $this->input->post("idea_no");
        $admin_id = $this->input->post("admin_id");
        $question_id = $this->input->post("question_id");
        $module_id = $this->input->post("module_id");

        $this->load->library('image_lib');
        $img = $_POST['imageData'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $path = 'assets/uploads/preview_draw_images/';
        $draw_file_name = 'draw' . uniqid();
        $file = $path . $draw_file_name . '.png';
        file_put_contents($file, $data);

        $imginfo = getimagesize($file);
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

        $image_url = base_url() . $file;


        $data2['student_id'] = $student_id;
        $data2['idea_id'] = $idea_id;
        $data2['idea_no'] = $idea_no;
        $data2['checker_id'] = $admin_id;
        $data2['question_id'] = $question_id;
        $data2['module_id'] = $module_id;
        $data2['checked_image_url'] = $image_url;
        $data2['by_admin_or_tutor'] = 1;


        // $this->db->insert('tutor_idea_check_workout',$data);
        $insert_id = $this->Admin_model->getAdminIdeaCheckId('idea_check_workout', $data2);

        echo $insert_id;
    }
    public function idea_create_student_report($checkout_id)
    {

        $data['this_idea'] = $this->Admin_model->get_this_idea($checkout_id);
        $data['all_idea']  = $this->Admin_model->get_ideas($checkout_id);
        $data['teacher_workout']  = $this->Admin_model->get_admin_workout($checkout_id);

        $data['student_id'] = $data['this_idea'][0]['student_id'];

        // print_r($data['all_idea']);die();

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('admin/user/idea_create_student_report', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function get_single_idea()
    {
        $student_id = $this->input->post("student_id");
        $idea_id = $this->input->post("idea_id");
        $get_idea = $this->tutor_model->idea_get($student_id, $idea_id);
        echo json_encode($get_idea);
    }
    public function correction_report_save()
    {

        $data['total_point'] = $this->input->post("total_point");
        $data['teacher_correction'] = $this->input->post("teacher_correction");
        if (!empty($this->input->post("teacher_comment"))) {
            $data['teacher_comment'] = $this->input->post("teacher_comment");
        } else {
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
        $data['by_admin_or_tutor'] = 1;

        $correction = $this->Admin_model->correction_report_save("idea_correction_report", $data);
        if ($correction > 1) {
            echo 1;
        } else {
            echo 2;
        }
    }
    public function idea_create_student_setting($idea_id, $idea_no, $question_id, $student_id)
    {

        $data['question_details'] = $this->Admin_model->get_question_details($question_id);
        $data['idea_details'] = $this->Admin_model->get_idea_details($idea_id);
        $data['idea_description'] = $this->Admin_model->get_idea_description($idea_id);
        $data['student_ans'] = $this->Admin_model->get_student_ans_details($student_id);
        $data['idea_no'] = $idea_no;

        // print_r($data['idea_details']);die();

        $data['page_title'] = '.:: Q-Study :: New Idea created student...';
        $data['page'] = 'New Idea created student';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        //$data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $user_id = 2;
        $data['all_grade'] = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_subject'] = $this->tutor_model->getInfo('tbl_subject', 'created_by', $user_id);
        $data['allCountry'] = $this->Admin_model->search('tbl_country', [1 => 1]);

        $data['maincontent'] = $this->load->view('admin/user/idea_create_student_setting', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function idea_view_student_report($student_id, $idea_id, $idea_no)
    {
        $data['tutor_correction'] = $this->Admin_model->getTutorCorrection($student_id, $idea_id, $idea_no);
        $data['all_ideas'] = $this->Admin_model->getIdeas($idea_id);
        $data['student_id'] = $student_id;

        // print_r($data['tutor_correction']);die();

        $data['page_title'] = '.:: Q-Study :: New Idea created student...';
        $data['page'] = 'New Idea created student';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/idea_view_student_report', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function get_indivisual_idea()
    {
        $student_id = $this->input->post("student_id");
        $idea_id = $this->input->post("idea_id");
        $get_details = $this->Admin_model->idea_get_correction($student_id, $idea_id);
        echo json_encode($get_details);
    }
    public function  new_idea_create_tutor()
    {

        $data['all_tutors'] = $this->Admin_model->get_all_tutor();
        $data['idea_created_tutor'] = $this->Admin_model->idea_created_tutor_list();

        // echo "<pre>";print_r($data['all_tutors']);die();
        // echo "<pre>";print_r($data['idea_created_tutor']);die();

        $data['page_title'] = '.:: Q-Study :: New Idea created student...';
        $data['page'] = 'New Idea created student';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/new_idea_create_tutor', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function  idea_create_tutor_list($tutor_id)
    {
        // $data['tutor_ans'] = $this->Admin_model->get_tutor_ans($tutor_id);
        $data['tutor_idea'] = $this->Admin_model->get_tutor_ideas($tutor_id);
        $data['tutor_questions'] =  $this->Admin_model->get_tutor_questions($tutor_id);
        // echo $data['tutor_questions'][0]['question_id'];die();
        if(!empty($data['tutor_questions'][0]['parent_question_id'])){
            $first_question_id = $data['tutor_questions'][0]['parent_question_id'];
        }else{
            $first_question_id = $data['tutor_questions'][0]['question_id'];
        }
        

        $data['first_question_ideas'] =  $this->Admin_model->get_first_question_ideas($first_question_id);
        // echo $this->db->last_query();die();
        $data['tutor_id']=$tutor_id;
        // echo "<pre>";print_r($data['first_question_ideas']);die();


        $data['page_title'] = '.:: Q-Study :: New Idea created student...';
        $data['page'] = 'New Idea created student';
        $data['page_section'] = 'User';

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('admin/user/tutors_idea_questions', $data, true);
        // $data['maincontent'] = $this->load->view('admin/user/idea_create_tutor_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function  idea_create_tutor_setting($tutor_id,$question_id,$idea_id)
    {
        $data['question_info'] = $this->tutor_model->getQuestionInfo(17, $question_id);
        $update_notification = $this->Admin_model->update_question_notification($question_id);
        $data['question_item'] = 17;
        $data['question_id'] = $question_id;
        $data['question_tutorial'] = $this->tutor_model->getInfo('tbl_question_tutorial', 'question_id', $question_id);
        $data['q_creator_name'] = $this->tutor_model->getIQuestionCreator($question_id); 

        $data['all_grade'] = $this->tutor_model->getAllInfo('tbl_studentgrade');
        $data['all_subject'] = $this->tutor_model->getInfo('tbl_subject', 'created_by', $tutor_id);
        $subject_id = $data['question_info'][0]['subject'];

        $data['subject_base_chapter'] = $this->tutor_model->getInfo('tbl_chapter', 'subjectId', $subject_id);
        if (count($data['question_info'])) {
            $data['allCountry'] = $this->Admin_model->search('tbl_country', [1 => 1]);
            $data['selCountry'] = $data['question_info'][0]['country'];
            $quesSub = $data['question_info'][0]['subject'];
            $quesChap = $data['question_info'][0]['chapter'];
            $chaps = $this->get_chapter_name($quesSub, $quesChap); //selected $quesChap
            $temp = [
                'subject' => $data['question_info'][0]['subject'],
                'chapter' => $chaps,
                'selChapter' => $quesChap,
                'studentGrade' => $data['question_info'][0]['studentgrade'],
            ];
            $this->session->set_flashdata('refPage', 'questionEdit');
            $this->session->set_flashdata('modInfo', $temp);
        }

        $data['ideas'] = $this->tutor_model->getIdeasByQuestion($question_id);
        $data['idea_info'] = $this->tutor_model->getIdeaInfoByQuestion($question_id);
        $data['question_info_ind'] = json_decode($data['question_info'][0]['questionName']);
        $data['tutor_id'] = $tutor_id;
        $data['idea_id'] = $idea_id;

        $qSearchParams = [
            'questionType' => 17,
            'user_id' => $tutor_id,
            'country' => $this->session->userdata('selCountry'),
        ];

        $allQuestionIds = $this->QuestionModel->search('tbl_question', $qSearchParams);
        $allQuestionIds = array_column($allQuestionIds, 'id');
        $data['qIndex'] = array_search($question_id, $allQuestionIds);
        if (!is_int($data['qIndex'])) {
            // redirect('question-list');
        } else {
            $data['qIndex'] += 1;
        }
        // echo "<pre>";print_r($data['ideas']);die();

        // $data['tutor_ans'] = $this->Admin_model->get_tutor_ans_details($tutor_id, $idea_id, $question_id, $idea_no);
        // $data['idea_infos'] = $this->Admin_model->get_tutor_idea_info($tutor_id, $idea_id, $question_id, $idea_no);
        // $data['all_ideas'] = $this->Admin_model->get_all_ideas_infos($idea_id, $question_id);
        // $data['tutor_like'] = $this->Admin_model->get_tutor_total_like($idea_id, $question_id, $tutor_id);

        $data['page_title'] = '.:: Q-Study :: New Idea created student...';
        $data['page'] = 'New Idea created student';
        $data['page_section'] = 'User'; 

        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('admin/user/idea_create_tutor_setting', $data, true);
        $this->load->view('master_dashboard', $data); 
    }
    public function set_allow_idea()
    {
        $data['allows_online'] = $this->input->post("allow_online");
        //echo $data['allow_online'];die();
        $question_id = $this->input->post("question_id");
        $idea_no = $this->input->post("idea_no");

        $this->db->where('question_id', $question_id);
        //$this->db->where('idea_no', $idea_no);
        $update =  $this->db->update("idea_info", $data);
        if ($update) {
            echo $data['allows_online'];
        }
    }
    public function set_serial_no()
    {
        $data['idea_no'] = $this->input->post("serial_no");
        $idea_no = $this->input->post("idea_no");
        $question_id = $this->input->post("question_id");


        $this->db->where('question_id', $question_id);
        $this->db->where('idea_no', $idea_no);
        //$this->db->where('idea_no', $idea_no);
        $update =  $this->db->update("idea_description", $data);

        if ($update) {
            echo 1;
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


    /*Admin new code*/
    public function get_chapter_name($subject = 0, $selected = 0)
    {
        // echo 11; die();

        $subject_id = $subject ? $subject : $this->input->post('subject_id');

        $all_subject_chapter = $this->tutor_model->getInfo('tbl_chapter', 'subjectId', $subject_id);
        $html = '<option value="">Select Chapter</option>';
        foreach ($all_subject_chapter as $chapter) {
            $sel = $chapter['id'] == $selected ? 'selected' : '';
            $html .= '<option value="' . $chapter['id'] . '" ' . $sel . '>' . $chapter['chapterName'] . '</option>';
        }
        if ($subject) {
            return $html; //within controller
        } else {
            echo $html; // ajax/form submit
        }
    }
    public function update_question_data()
    {

        $post = $this->input->post();
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
        if (isset($post['admin_approval'])) {
            $admin_approval = 1;
        } else {
            $admin_approval = 2;
        }

        $question_id = $this->input->post('question_id');
        $data['questionType'] = $this->input->post('questionType');
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
        $data_idea['allows_online'] = $admin_approval;
        //echo "<pre>";print_r($data_idea);die();

        $idea_id = $this->tutor_model->ideaUpdateId('idea_info', $data_idea, $question_id);
        $datas[] = isset($post['question_instruction']) ? $post['question_instruction'] : '';

        $idea_description = $post['idea_details'];

        $this->db->select('*');
        $this->db->from('idea_description');
        $this->db->where('question_id', $question_id);
        $this->db->where('idea_id',  $idea_id);
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
    }
    public function view_edit_idea()
    {
        $question_id = $this->input->post('question_id');
        $idea_id = $this->input->post('idea_id');
        $this->db->select('*');
        $this->db->from('question_ideas');
        $this->db->join('tbl_useraccount', 'question_ideas.user_id = tbl_useraccount.id');
        $this->db->where('question_ideas.id', $idea_id);
        $query = $this->db->get();
        $result=$query->row_array();
        echo json_encode($result);
    }
    public function save_more_idea()
    {
        $idea_title = $this->input->post('idea_title');
        $idea_question = $this->input->post('question_description');
        $question_id = $this->input->post('question_id');

        $this->db->select('*');
        $this->db->from('idea_description');
        $this->db->where('question_id', $question_id);
        $query = $this->db->get();
        $results = $query->result_array();
        $increase = count($results);
        $increase = $increase + 1;

        $data['idea_no'] = $increase;
        $data['question_id'] = $question_id;
        $data['idea_id'] = $results[0]['idea_id'];
        $data['idea_name'] = "Idea" . $increase;
        $data['idea_title'] = $idea_title;
        $data['idea_question'] = $idea_question;

        $this->db->insert('idea_description', $data);

        $this->db->select('*');
        $this->db->from('idea_description');
        $this->db->where('question_id', $question_id);
        $query = $this->db->get();
        $results = $query->result_array();
        echo json_encode($results);
    }

    public function question_preview($question_item, $question_id, $tutor_id)
    {
        // echo 11; die();
        date_default_timezone_set($this->site_user_data['zone_name']);
        $exact_time = time();
        $this->session->set_userdata('exact_time', $exact_time);

        $data['user_info'] = $this->Preview_model->getInfo('tbl_useraccount', 'id', $tutor_id);
        // echo $this->db->last_query();
        // echo "<pre>"; print_r($data['user_info']); die();

        $data['userType']  = $this->Preview_model->getInfo('tbl_usertype', 'id', 17);
        $data['userType'] = $data['userType'][0]['user_slug'];
        $data['question_info_s'] = $this->Preview_model->getInfo('tbl_question', 'id', $question_id);
        $data['question_info'] = json_decode($data['question_info_s'][0]['questionName']);
        $data['question_id'] = $question_id;
        $data['question_item'] = $question_item;
        $data['question_info_ind'] = $data['question_info'];
        $data['idea_info'] = $this->Preview_model->getIdeaInfo('idea_info', $question_id);
        $data['idea_description'] = $this->Preview_model->getIdeaDescription('idea_description', $question_id);

        // echo "<pre>"; print_r($data); die();
        
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = '';
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('preview/admin_creative_quiz_preview', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    public function save_answer_idea()
    {
        $idea_answer = $_POST['idea_answer'];
        $question_id = $_POST['question_id'];
        $idea_id = $_POST['idea_id'];
        echo 1;
    }
    public function approve_tutor_idea()
    {
        $question_id = $this->input->post('question_id');
        $idea_id = $this->input->post('idea_id');
        $approve = $this->input->post('approve');
        $data['approval'] = $approve;

        $this->db->where('question_id', $question_id);
        $this->db->where('id', $idea_id);
        $update = $this->db->update('question_ideas', $data);
        if($update){
           echo 1;
        }else{
            echo 2;
        }
    }
    public function update_tutor_idea_serial()
    {
        $question_id = $this->input->post('question_id');
        $idea_id = $this->input->post('idea_id');
        $serial = $this->input->post('serial');
        $data['serial'] = $serial;

        $this->db->where('question_id', $question_id);
        $this->db->where('id', $idea_id);
        $update = $this->db->update('question_ideas', $data);
        if($update){
           echo 1;
        }else{
            echo 2;
        }
    }
    public function get_ideas_by_question(){
        $question_id = $this->input->post('question_id');

        $this->db->select('*');
        $this->db->from('question_ideas');
        $this->db->where('question_ideas.question_id', $question_id);
        $this->db->order_by('serial','asc');

        $query = $this->db->get();
        $result = $query->result_array();
        //echo "<pre>";print_r($result);die();
        echo json_encode($result);
    }
    public function publish_tutor_idea()
    {
        $question_id = $this->input->post('question_id');
        $idea_id = $this->input->post('idea_id');
        $is_publish = $this->input->post('is_publish');
        $data['idea_publish'] = $is_publish;

        $this->db->where('question_id', $question_id);
        $this->db->where('id', $idea_id);
        $update = $this->db->update('question_ideas', $data);
        if($update){
           echo 1;
        }else{
            echo 2;
        }
    }
    public function idea_tutor_point_save(){
        $question_id = $this->input->post('question_id');
        $idea_id = $this->input->post('idea_id');
        $tutor_point = $this->input->post('tutor_point');

        $data['tutor_point'] = $tutor_point;
        $this->db->where('question_id', $question_id);
        $this->db->where('id', $idea_id);
        $update = $this->db->update('question_ideas', $data);
        if($update){
           echo 1;
        }else{
            echo 2;
        }
    }
    public function student_idea_setting($question_id,$idea_id,$student_id,$module_id){
        $data['student_idea'] = $this->admin_model->student_idea_details($question_id,$idea_id,$student_id,$module_id);
        // $data['student_info'] = $this->tutor_model->get_student_info($student_id);
        $data['grade'] = 1;
        
        // echo "<pre>";print_r($data['student_idea']);die();

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['maincontent'] = $this->load->view('admin/user/student_idea_setting', $data, true);
        $this->load->view('master_dashboard', $data);
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
        $data['submit_date']= date("Y/m/d");

        $datas['admin_seen']=1;
        // echo "<pre>";print_r($data);die();
        $this->db->select('*');
        $this->db->from('tutor_remake_idea_info');
        $this->db->where('student_id', $student_id);
        $this->db->where('idea_id', $student_id);
        
        $query = $this->db->get();
        $check = $query->result_array();
        if(empty($check)){
            $this->db->insert('tutor_remake_idea_info',$data);
            $this->db->where('student_id',$this->input->post('student_id'))->where('question_id',$this->input->post('question_id'))->update('idea_student_ans',$datas);
            $datas['success']='successfully insert';
            echo 1;
        }else{
            echo 2;
        }

        
        

        
    }
}
