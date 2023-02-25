<?php

class Message extends CI_Controller
{
    public $loggedUserId;
    public function __construct()
    {
        parent::__construct();
        
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        $this->loggedUserId = $user_id;
        
        /*if ($user_id == null && $user_type == null) {
            redirect('welcome');
        }*/
        
        $this->load->model('MessageModel');
    }

    public function selectMessageType()
    {
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        //$data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('message/select_message_type', $data, true);
        $this->load->view('master_dashboard', $data);
    }
	
	public function proceed_email()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);

        $schedule_date = explode(',', $this->input->post('dateToShow'));
        $dataToInsert['topic'] = $clean['topicId'];
        $dataToInsert['body'] = $post['body'];
        $dataToInsert['type'] = 1;
        $dataToInsert['schedule_date'] = json_encode($clean['dateToShow']);
        $dataToInsert['email_for_student'] = $this->input->post('email_for_student');
        $dataToInsert['student_grade'] = $this->input->post('student_grade');
        $dataToInsert['email_for_school'] = $this->input->post('email_for_school');
        $dataToInsert['school_id'] = $this->input->post('school_id');
        $dataToInsert['created_by'] = $this->loggedUserId;
        $dataToInsert['created_at'] = date('Y-m-d H:i:s');
        $dataToInsert['updated_at'] = date('Y-m-d H:i:s');
        $message_id = $this->input->post('message_id');

        $message_info = $this->MessageModel->getInfo('messages', 'id', $message_id);

        if (!$message_info) {
            $message_id = $this->MessageModel->insert('messages', $dataToInsert);
        } else {
            $message_id = $message_info[0]['id'];
            $this->MessageModel->updateInfo('messages', 'id', $message_id, $dataToInsert);
        }

        $this->load->helper('commonmethods_helper');

        //get all scheduled email for today
        $allNotice = $this->MessageModel->messageForToday();

        //loop through each notice creator

            if ($message_info[0]['email_for_student'] == 1) {
                //get all student associated creator
                //$allStudent = $this->MessageModel->search('tbl_enrollment', ['sct_id'=>$noticeCrator]);
                $allStudent = $this->MessageModel->get_all_student_by_grade($message_info[0]['student_grade']);
            }
            if ($message_info[0]['email_for_school'] == 1) {
                $allStudent = $this->MessageModel->get_all_student_by_school($message_info[0]['student_grade']);
            }

        $message_topic = $this->MessageModel->getInfo('message_topics', 'id', $message_info[0]['topic']);
            if (isset($message_topic[0]['topic']) && $message_topic[0]['topic'] != '')
            {
                $message_topic = $message_topic[0]['topic'];
            }else
            {
                $message_topic = 'message from q-study';
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
                        'subject' => $message_info[0]['title'],
                        'message' => $message_info[0]['body'],
                    ];
                    sendMail($mailData);
                } else {
                    $mailData = [
                        'to' => $parentEmail,
                        'subject' => $message_info[0]['title'],
                        'message' => $message_info[0]['body'],
                    ];
                    sendMail($mailData);

                    //cc mail 2
                    // $mailData = [
                        // 'to' => 'aftab@sahajjo.com',
                        // 'subject' => $message_info[0]['title'],
                        // 'message' => $message_info[0]['body'],
                    // ];
                    // sendMail($mailData);
                }
            }
			$this->session->set_flashdata('success_msg', 'Message Sent Successfully');
            return redirect('edit_message/'.$message_id);
    }

    public function showAllTopics()
    {
        $data['allTopics'] = $this->MessageModel->allTopics();

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        //$data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('message/all_topics', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function show_all_message($topic_id)
    {
        $data['all_message'] = $this->MessageModel->get_message_by_topic($topic_id);
        $data['topic_id'] = $topic_id;
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        //$data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('message/all_message', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function add_message($topic_id)
    {
        $data['topic'] = $this->MessageModel->info('message_topics', ['id'=>$topic_id]);
        $data['all_school'] = $this->MessageModel->getInfo('tbl_useraccount', 'user_type', 4);
        

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        //$data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('message/add_message', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function edit_message($message_id)
    {
        $data['message_info'] = $this->MessageModel->message_info($message_id);
//        $data['topic'] = $this->MessageModel->info('message_topics', ['id'=>$data['message_info'][0]['topic']]);
        $data['all_school'] = $this->MessageModel->getInfo('tbl_useraccount', 'user_type', 4);
        $data['schedule_date'] = [];

        if ($data['message_info']) {
            $schedule = array_column($data['message_info'], 'schedule_date');

            if (($schedule[0])) {
                $data['schedule_date'] = json_encode($schedule);
            }
        }
       
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        //$data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('message/edit_message', $data, true);
        $this->load->view('master_dashboard', $data);
    }
    
    public function setMessage()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        
        $schedule_date = explode(',', $this->input->post('dateToShow'));
        $dataToInsert['topic'] = $clean['topicId'];
        $dataToInsert['body'] = $post['body'];
        $dataToInsert['type'] = 1;
        $dataToInsert['schedule_date'] = json_encode($clean['dateToShow']);
        $dataToInsert['email_for_student'] = $this->input->post('email_for_student');
        $dataToInsert['student_grade'] = $this->input->post('student_grade');
        $dataToInsert['email_for_school'] = $this->input->post('email_for_school');
        $dataToInsert['school_id'] = $this->input->post('school_id');
        $dataToInsert['created_by'] = $this->loggedUserId;
        $dataToInsert['created_at'] = date('Y-m-d H:i:s');
        $dataToInsert['updated_at'] = date('Y-m-d H:i:s');
        
        $message_id = $this->input->post('message_id');

        $message_info = $this->MessageModel->getInfo('messages', 'id', $message_id);

        if (!$message_info) {
            $message_id = $this->MessageModel->insert('messages', $dataToInsert);
        } else {
            $message_id = $message_info[0]['id'];
            $this->MessageModel->updateInfo('messages', 'id', $message_id, $dataToInsert);
        }

        $schedule_info = $this->MessageModel->getInfo('message_schedule', 'message_id', $message_id);
        if ($schedule_info) {
            $this->MessageModel->deleteInfo('message_schedule', 'message_id', $message_id);
        }

        foreach ($schedule_date as $schedule) {
            $schedule_data['message_id'] = $message_id;
            $schedule_data['schedule_date'] = $schedule;

            $this->MessageModel->insert('message_schedule', $schedule_data);
        }

        $this->session->set_flashdata('success_msg', 'Message setted successfully');
        redirect('message/topics');
    }
    
    public function addMessageTopic()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        $this->form_validation->set_rules('messageTopic', 'messageTopic', 'required');
        if ($this->form_validation->run()==false) {
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

            $data['maincontent'] = $this->load->view('message/add_message_topic', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            $dataToInsert = [
                'topic' => $clean['messageTopic'],
                'creator_id' => $this->loggedUserId,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->MessageModel->insert('message_topics', $dataToInsert);
            $this->session->set_flashdata('success_msg', 'Message topic added successfully');
            redirect('message/topics');
        }
    }

    /**
     * Delete message topic will delete topic and associated message
     *
     * @param int $topicId topic id from message_topics table
     *
     * @return void
     */
    public function DeleteMessageTopic($topicId)
    {
        $this->MessageModel->delete('messages', ['topic'=>$topicId]);
        $status = $this->MessageModel->delete('message_topics', ['id'=>$topicId]);
        
        echo $status ? 'true' : 'false';
    }
    
    public function delete_message($message_id)
    {
        $status = $this->MessageModel->delete('messages', ['id'=>$message_id]);
        $this->MessageModel->delete('message_schedule', ['message_id'=>$message_id]);
        
        echo $status ? 'true' : 'false';
    }
}
