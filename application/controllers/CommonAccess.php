<?php


class CommonAccess extends CI_Controller
{

    public $loggedUserId,$loggedUserType;
    
    /**
     * CommonAccess should be accecible without authentication
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->loggedUserId = $this->session->userdata('user_id');
        $this->loggedUserType = $this->session->userdata('userType');
        
        $this->load->model('Parent_model');
        $this->load->model('Student_model');
        $this->load->model('ModuleModel');
        $this->load->model('Tutor_model');
        $this->load->model('Admin_model');
        $this->load->model('QuestionModel');
        $this->load->model('MessageModel');
        $this->load->model('FaqModel');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    /**
     * Redirect a suspended user to a custom page
     *
     * @return void
     */
    public function suspendUserRedirection()
    {

        $this->load->view('user_suspended');
    }

    /**
     * Redirect a payment defaulter user to a custom page
     *
     * @return void
     */
    public function paymentDefaulterRedirection()
    {
        // echo $this->loggedUserType;die();
        
        //to get payment defaulter status user need to login
        if (!$this->loggedUserId) {
            redirect('/');
        }

        $data['userId'] = $this->loggedUserId;
        $data['userType'] = $this->loggedUserType;
        $data['paymentUrl'] = '';
        $userInfo = $this->tutor_model->userInfo($data['userId']);
        $this->session->set_userdata('countryId', $userInfo[0]['country_id']);
        if ($data['userType']==1) {       //parent
            $data['paymentUrl']='select_course';
        } elseif ($data['userType']==6) { //1-12 lvl student
            $data['paymentUrl']=null;
        } elseif ($data['userType']==3) { //tutor
            $data['paymentUrl']='select_course';
        } elseif ($data['userType']==2) { //upper lvl student
            $data['paymentUrl']='select_course';
        }
// echo "<pre>";print_r($data);
// echo "<pre>";print_r($userInfo[0]);die();

        $this->load->view('payment_defaulter', $data);
    }


    /**
     * Search Tutor account
     *
     * @return void
     */
    public function searchTutor()
    {
        if($this->loggedUserId)
        {
            $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
        }else
        {
            $_SESSION['prevUrl'] = base_url().'welcome';
        }

        $post = $this->input->get();
        $clean = $this->security->xss_clean($post);

        $data['video_help'] = $this->FaqModel->videoSerialize(8, 'video_helps'); //rakesh
        $data['video_help_serial'] = 8;

        $data['country_list'] = $this->Student_model->getAllInfo(' tbl_country');
        //$data['subject_list'] = $this->tutor_model->uniqueColVals('tbl_subject', 'subject_name');
        $data['subject_list'] = $this->tutor_model->get_tutor_subject();
        $data['user_info'] = $this->tutor_model->userInfo($this->loggedUserId);
        $data['city_list'] = $this->tutor_model->uniqueColVals('additional_tutor_info', 'city');
        $data['state_list'] = $this->tutor_model->uniqueColVals('additional_tutor_info', 'state');
        
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['searchItems'] = [];
        if (!$post) {
            $data['searchItems'] = [];
        } else {
            $conditions = array_filter($clean);
            $conditions['user_type'] = 3;
            if (isset($conditions['country_id'])) {
                $conditions['country_id'] =  (int) $clean['country_id'];
            }
            
            $tutors = $this->Tutor_model->tutorInfo($conditions);
            $data['searchItems'] = $tutors;
        }
        $data['maincontent'] = $this->load->view('tutors/tutor_search', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    /**
     * Show tutor info
     *
     * @param integer $userId tutor account id
     *
     * @return void
     */

    public function showTutorProfile($userId)
    {

        $conditions = [
            'tbl_useraccount.id'=>$userId,
            'tbl_useraccount.user_type'=>3,
        ];
        $tutor = $this->tutor_model->tutorInfo($conditions);

        if (!isset($tutor[0])) {
            show_404();
        } else {
            $data['tutor_info'] = $tutor[0];
            $country = $this->tutor_model->getRow('tbl_country', 'id', $data['tutor_info']['country_id']);
            $data['tutor_info']['country'] = $country['countryName'];

            $conditions = [
                'user_id' =>$userId,
                'word_approved' =>1,
            ];
            $approvedTotal = $this->Admin_model->search('tbl_question', $conditions);
            $approvedTotal = count($approvedTotal);
            $data['word_approved'] = $approvedTotal;
            $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

            $data['maincontent'] = $this->load->view('tutors/tutor_profile', $data, true);
            $this->load->view('master_dashboard', $data);
        }
    }

    /**
     * Frontend view of search word
     *
     * @return void
     */
    public function searchDictionaryWord()
    {

        if (!isset($_SESSION['userType']) || empty($_SESSION['userType']) ) {
            $_SESSION['prevUrl'] = base_url('/');
        }

        if (isset($_SESSION['userType']) || !empty($_SESSION['userType'])  ) {

            if (($_SESSION['userType']) == 3 ) {
                $_SESSION['prevUrl'] = base_url('/tutor/view_course');
            }
        }

        if (isset($_SESSION['userType'])) {
            if ($_SESSION['userType'] == 3 || $_SESSION['userType'] == 4 || $_SESSION['userType'] == 5 ) {
                $data['video_help'] = $this->FaqModel->videoSerialize(23, 'video_helps'); //rakesh
                $data['video_help_serial'] = 23;
            }else{
                $data['video_help'] = $this->FaqModel->videoSerialize(10, 'video_helps'); //rakesh
                $data['video_help_serial'] = 10;
            }
        }

        $data['allWords'] = $this->QuestionModel->allDictionaryWord();
        $data['pageType'] = "q-dictionary";
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('tutors/question/search_dictionary_word', $data, true);
        $this->load->view('master_dashboard', $data);
    }


    /**
     * For auto complete suggestion
     *
     * @return string json encoded word items
     */
    public function ajaxSearchDicWord()
    {
        $keyword = $this->input->get('query');
        $data['suggestions'] = $this->QuestionModel->searchWord($keyword);

        echo json_encode($data);
    }

    /**
     * Initial page vie of dictionary item
     *
     * @param string $word word to show
     *
     * @return void
     */

    public function viewDictionaryWord()
    {
        $word = $this->input->post('word');
        $word = $this->getWordInfo($word, 1, 0);
        if (!$word) {

            redirect("/q-dictionary/search");

            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
            $data['pageType'] = 'q-dictionary';
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
            $data['word'] = $this->input->post('word');
            $question_box = 'preview/dictionary_word';
            $data['maincontent'] = $this->load->view($question_box, $data, true);
            $this->load->view('master_dashboard', $data);

        }else{

                $_SESSION['prevUrl'] = base_url('/').'q-dictionary/search';
        

            $data['word_info'] = json_decode($word['word_info'][0]['questionName']);
            
            $data['word'] = $word['word_info'][0]['answer'];
            $data['word_id'] = $word['word_info'][0]['id'];
            $data['creator_info'] = $word['word_creator_info'][0];
            $data['total_items'] = count($this->QuestionModel->search('tbl_question', ['answer'=>$data['word'], 'dictionary_item'=>1]));
            $wordCount = $this->QuestionModel->search(
                'tbl_question', //table
                [ // conditions
                'answer'=>$data['word'],
                'dictionary_item'=>1
                ]
            );
            $wordCount = count($wordCount);
            
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
            $data['pageType'] = 'q-dictionary';
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

            $data['pagination'] = $this->pagination($wordCount);
            $question_box = 'preview/dictionary_word';
            $data['maincontent'] = $this->load->view($question_box, $data, true);
            $this->load->view('master_dashboard', $data);
        
        }
    }


    /**
     * Get word and word creator info
     *
     * @param string  $word   word to get info
     * @param integer $limit  limit data(should always 1 as 1 item per page)
     * @param integer $offset skip item(1,2,3,...)
     *
     * @return array           word info and creator info array
     */
    public function getWordInfo($word, $limit, $offset)
    {
        $data['word_info'] = $this->QuestionModel->dicItemsByWord($word, $limit, $offset);
        if (!count($data['word_info'])) {
            return 0;
        }
        $wordCreatorId = $data['word_info'][0]['user_id'];
        $conditions = ['id'=>$wordCreatorId];
        $data['word_creator_info'] = $this->Tutor_model->tutorInfo($conditions);
        
        return $data;
    }

    /**
     * To view previous next dictionary word item
     *
     * @return string json ecoded string
     */
    public function wordInfoByAjaxCall()
    {
        $post = $this->input->post();
        $wordReq = $post['word'];
        $limit = 1;
        $offset = $post['offset'];

        $word = $this->getWordInfo($wordReq, $limit, $offset);
        if (!$word) {
            echo 0;
            die;
        }
        $data['word_info'] = json_decode($word['word_info'][0]['questionName']);
        $data['word'] = $word['word_info'][0]['answer'];
        $data['word_id'] = $word['word_info'][0]['id'];
        $data['creator_info'] = $word['word_creator_info'][0];
        
        if (isset($data['creator_info']['image']) && file_exists('assets/uploads/'.$data['creator_info']['image'])) {
            $data['creator_info']['image'] = base_url()."assets/uploads/".$data['creator_info']['image'];
        } else {
            $data['creator_info']['image'] = base_url()."assets/images/default_user.jpg";
        }
        echo json_encode($data);
    }
    
    /**
     * View a faq by all user
     * @param  integer $id faq id to view
     * @return void
     */
    public function viewFaq($id)
    {
        $this->load->model('FaqModel');
        $data['faq'] = $this->FaqModel->info(['id'=>$id]);
        if (!count($data['faq'])) {
            show_404();
        }

        // if (!empty($_SERVER['HTTP_REFERER'])) {
        //     if (strpos($_SERVER['HTTP_REFERER'],"/video")) {
        //     $_SESSION['prevUrl'] = $_SESSION['prevUrl'] = base_url('/');
        //     }else{
        //         $_SESSION['prevUrl'] = $_SERVER['HTTP_REFERER'];
        //     }
        // }

        $data['video_help'] = $this->FaqModel->videoSerialize(10, 'video_helps');
        $data['video_help_serial'] = 10;

        $_SESSION['prevUrl'] = base_url('/').'faq/view/33';

        $data['allFaqs'] = $this->FaqModel->allFaqs();
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);
        $data['leftnav'] = $this->load->view('faqs/all_faq_left_nav', $data, true);
        
        $data['maincontent'] = $this->load->view('faqs/view_faq', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    /**
     * Responsible for  pagination link
     *
     * @param  integer $totItems total item count
     * @return string
     */
    public function pagination($totItems = 0)
    {
        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = "CommonAccess/wordInfoByAjaxCall";
        $config["total_rows"] = $totItems;//$total_row;
        $config["per_page"] = 1;
        $config['use_page_numbers'] = true;
        $config['num_links'] = $totItems;//$total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="myclass page-link" href="CommonAccess/wordInfoByAjaxCall/1" data-ci-pagination-page="1">';
        $config['next_tag_open'] = '<a class="myclass page-link next" href="CommonAccess/wordInfoByAjaxCall/2" data-ci-pagination-page="2"';
        $config['cur_tag_close'] = '</a>';
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
        $config['attributes'] = array('class' => 'myclass page-link');
        
        $config['full_tag_open'] = '<li class="page-item">';
        $config['full_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    /**
     * Front page items like about us, pricing view
     * @param  string $item item name ex:pricing
     * @return void
     */
    public function viewLandPageItem($item)
    {
        $data['video_help'] = $this->FaqModel->videoSerialize(9, 'video_helps'); //rakesh
        $data['video_help_serial'] = 9;

        $this->load->model('FaqModel');
        $item = $this->FaqModel->info(['item_type'=>$item]);
        
        if (count($item)) {
            $data['item_type'] = ($item['item_type']=='how_it_works') ? 'video' : 'text';
            $data['body'] = strlen($item['body'])?$item['body'] : '';
            $data['title'] = strlen($item['title'])?$item['title'] : '';
        } else {
            $data['body'] = '';
            $data['title'] = 'Not Found';
            $data['item_type'] = '';
        }

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('faqs/frontPageItems/addOtherItemsLeftNav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('faqs/frontPageItems/viewItems', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    /**
     * User can send message to q-study.
     *
     * @return void
     */
    public function contactUs()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        if (!$post) {
            $user_id = $this->session->userdata('user_id');
            if ($user_id != '') {
                $data['user_info'] = $this->db->where('id',$user_id)->get('tbl_useraccount')->row();

                $date = date('Y-m-d H:i:s');
                $time = strtotime($date);
                $startTime = date("Y-m-d H:i:s", strtotime('-2 minutes', $time));

                $this->db->where('user_id',$user_id)->where('time <',$startTime)->where('status',0)->delete('feedback_files');

                $data['uploaded_files'] = $this->db->where('user_id',$user_id)->where('status',0)->get('feedback_files')->result_array();

            }


            $faqItem = $this->FaqModel->info(['item_type'=>'contact_us']);
            $data['qStudyContactInfo'] = isset($faqItem['body'])?$faqItem['body']:null;
            $data['contacts_email'] = $this->db->where('setting_key','contact_email')->get('tbl_setting')->row();
            // echo "<pre>";print_r($data['uploaded_files']);die;
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

            $data['maincontent'] = $this->load->view('faqs/contact_us', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            $dataToInsert = [
                'user_name' => $clean['userName'],
                'user_email' => $clean['userEmail'],
                'message_body' => $clean['userMessage'],
                'sent_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s'),
            ];
            $message = '';
            $message .= '<p>Name: '.$clean['userName'].'</p>';
            $message .= '<p>Email: '.$clean['userEmail'].'</p>';
            $message .= '<p>Message: '.$clean['userMessage'].'</p>';
            $mailData = [
                'to' => "info@q-study.com",
                'subject' => 'Contact from Q-Study',
                'message' => $message,
            ];
            $this->load->helper('commonmethods_helper');
            sendMail($mailData);
            $this->Admin_model->insertInfo('user_message', $dataToInsert);
            $this->session->set_flashdata('success_msg', 'Message Sent Successfully');
            redirect('/');
        }
    }

    /**
     * Send email notice which created by tutor to parent and child (CronJob)
     *
     * @return void
     */
    public function sendNoticeMail()
    {
        $this->load->helper('commonmethods_helper');
        
        //get all scheduled email for today
        $allNotice = $this->MessageModel->messageForToday();
        
        //loop through each notice creator
        foreach ($allNotice as $notice) {
            if ($notice['email_for_student'] == 1) {
                //get all student associated creator
                //$allStudent = $this->MessageModel->search('tbl_enrollment', ['sct_id'=>$noticeCrator]);
                $allStudent = $this->MessageModel->get_all_student_by_grade($notice['student_grade']);
            }
            if ($notice['email_for_school'] == 1) {
                $allStudent = $this->MessageModel->get_all_student_by_school($notice['student_grade']);
            }
            //$noticeCrator = $notice['created_by'];
            
            //$allStudentIds = array_column($allStudent, 'st_id');
            $allStudentIds = array_column(array_values(array_column($allStudent, null, 'st_id')), 'st_id');
            $emailToSent = $this->MessageModel->allStudentEmail($allStudentIds);
            
            //send notice to parent and student
            foreach ($emailToSent as $student) {
                $studentEmail = $student['student_email'];
                $parentEmail = $student['parent_email'];
                if ($student['type'] == 2) {
                    $mailData = [
                        'to' => $studentEmail,
                        'subject' => $notice['title'],
                        'message' => $notice['body'],
                    ];
                    sendMail($mailData);
                } else {
                    $mailData = [
                        'to' => $parentEmail,
                        'subject' => $notice['title'],
                        'message' => $notice['body'],
                    ];
                    sendMail($mailData);

                    //cc mail 2
                    $mailData = [
                        'to' => 'robelsust@gmail.com',
                        'subject' => $notice['title'],
                        'message' => $notice['body'],
                    ];
                    sendMail($mailData);
                }
            }
        }
        //send email to user associated with the notice creator
    }
    
    public function emailExists()
    {
        $post = $this->input->get();
        $email = $post['email'];

        $emailExists = $this->admin_model->getInfo('tbl_useraccount', 'user_email', $email);
        
        echo count($emailExists) ? 'true' : 'false';
    }

    public function emailNotExists()
    {
        $post = $this->input->get();
        $email = $post['email'];

        $emailExists = $this->admin_model->getInfo('tbl_useraccount', 'user_email', $email);
        echo count($emailExists) ? 'false' : 'true';
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
        $config['allowed_types'] = '*';
        // $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|PDF|webm|doc|docx|mp4|webm|ogg|avi|ppt|pptx|m4v';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        //   $this->upload->do_upload();
        $error = array();
        if (!$this->upload->do_upload('file')) {
            $error = $this->upload->display_errors();
            print_r($error);
         
        } else {
            $imageName = $this->upload->data();
            $base = base_url() . 'assets/uploads/' . $imageName['file_name'];
            
            echo '{"fileName":"' . $imageName['file_name'] . '","uploaded":1,"url":"' . $base . '"}';
        }
    }

    public function searchWord_()
    {
        $word = $this->input->post('word');
        $word = $this->getWordInfo($word, 1, 0);

        print_r($word); 

    }
    
    public function feedbackfileUpload(){
        $userId = $this->input->post('userId');
        $config = array(
            'upload_path'   => 'assets/uploads/feedback/',
            'allowed_types' => 'jpg|png|JPEG|pdf|PNG',
            'overwrite'     => 1,                       
        );
        $files = $_FILES;
        $images = array();

        $this->load->library('upload', $config);
        // echo "<pre>";print_r($files);
        foreach ($files['filename']['name'] as $key => $image) {

            $_FILES['abc']['name']= $files['filename']['name'][$key];
            $_FILES['abc']['type']= $files['filename']['type'][$key];
            $_FILES['abc']['tmp_name']= $files['filename']['tmp_name'][$key];
            $_FILES['abc']['error']= $files['filename']['error'][$key];
            $_FILES['abc']['size']= $files['filename']['size'][$key];



            $fullname = $image;

            $file_ext = pathinfo($fullname,PATHINFO_EXTENSION);

            $fileName = rand(999,000).time().'.'.$file_ext;
            $images[$key] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            // echo "<pre>";print_r($_FILES);
            if ($this->upload->do_upload('abc')) {
                $upData['filename'] = $fileName;
                $upData['user_id']  = $userId;
                $upData['time']     = date('Y-m-d H:i:s');
                $this->db->insert('feedback_files',$upData);

                $this->upload->data();
            } else {
                $error = $this->upload->display_errors();
                print_r($error);
            }

        }

        redirect('contact_us');
    }

    public function checkRefLink(){
        $refLink = $this->input->post('refLink');
        $userId  = $this->session->userdata('user_id');

        $result = $this->db->where('id',$userId)->where('SCT_link',$refLink)->get('tbl_useraccount')->result_array();
        echo count($result);
    }

    public function send_feedback(){
        $userId  = $this->session->userdata('user_id');

        $uploaded_files = $this->db->where('user_id',$userId)->where('status',0)->get('feedback_files')->result_array();
        $userInfo = $this->db->where('id',$userId)->get('tbl_useraccount')->row();

        $data['refLink'] = $this->input->post('ref_link');
        $data['feedback_topic'] = $this->input->post('feedback_topic');
        $data['details_body']   = $this->input->post('details_body');
        $messageBody   = $this->input->post('details_body');
        $data['name']   = $userInfo->name;
        $data['user_email']   = $userInfo->user_email;
        $this->load->helper('string');
        $unique_id = random_string('alnum',10);
        //echo $unique_id;die();
        $emailTo = $this->db->where('setting_key','contact_email')->get('tbl_setting')->row();
        $to = $emailTo->setting_value;

        $dataToInsert = [
            'user_name' => $userInfo->name,
            'user_email' => $userInfo->user_email,
            'message_body' => $this->input->post('details_body'),
            'refLink' => $this->input->post('ref_link'),
            'feedback_topic' => $this->input->post('feedback_topic'),
            'sent_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'user_id' =>$userId,
            'unique_id' => $unique_id,
            'status' =>'pending',
        ];
        $message = '';
        $message .= '<p>Name: '.$userInfo->name.'</p>';
        $message .= '<p>Email: '.$userInfo->user_email.'</p>';
        $message .= '<p>Message: '.$messageBody.'</p>';
        $mailData = [
            'to' => $to,
            'subject' => 'Contact from Q-Study',
            'message' => $message,
        ];
        $this->load->helper('commonmethods_helper');
        sendMailAttachment($mailData,$uploaded_files,$userId);
        $this->Admin_model->insertInfo('user_message', $dataToInsert);
        $this->session->set_flashdata('success_msg', 'Message Sent Successfully');
        $this->db->where('user_id',$userId)->where('status',0)->update('feedback_files',['status'=>1,'unique_id'=>$unique_id]);
        redirect('contact_us');

        // echo "<pre>";
        // print_r($this->input->post());
        // print_r($uploaded_files);
    }
    
    
    public function getsendMessage(){
        $userId  = $this->session->userdata('user_id');
        $data['messages'] = $this->db->where('reciver_id',$userId)->order_by('id','desc')->limit(7)->get('tbl_compose_message')->result_array();
        //echo "<pre>";print_r($data['messages']);die();
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
    
        $data['maincontent'] = $this->load->view('faqs/compose_message', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function viewSingleMessage(){
        $messageId  = $this->input->post('data');
       $this->db->where('id',$messageId)->update('tbl_compose_message',['status'=>1]);
        $messages = $this->db->where('id',$messageId)->get('tbl_compose_message')->row();
        $msg = $messages->message;
        echo $msg;
    }
    public function countMessage(){
        $userId  = $this->session->userdata('user_id');
        $messages = $this->db->where('reciver_id',$userId)->where('status',0)->order_by('id','desc')->limit(7)->get('tbl_compose_message')->result_array();
        
        if(count($messages) > 0){
            echo 1;
        }else{
            echo 0;
        }
        
        
    }
    
}
