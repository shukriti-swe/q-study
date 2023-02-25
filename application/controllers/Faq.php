<?php

class Faq extends CI_Controller
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
        if ($user_type != 0) { //Only admin
            redirect('welcome');
        }

        $this->load->model('FaqModel');
    }

    public function addFaq()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        if (!$clean) {
            $data['maxSL'] = $this->FaqModel->lastItemId(); //last item id
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

            $data['maincontent'] = $this->load->view('faqs/add_faq', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            /*update all serial below requested serial by +1*/
            $this->FaqModel->reorderSerial($clean['serial_num']);

            /*insert requested faq after serial update*/
            $dataToInsert = [
                'serial'       => $clean['serial_num'],
                'title'        => $clean['title'],
                'show_in_home' => isset($clean['show_in_home'])?$clean['show_in_home']:1,
                'item_type'    => strtolower(str_replace(' ', '_', $clean['title'])),

            ];
            
            $insID = $this->FaqModel->insert($dataToInsert);
            if ($insID) {
                $this->session->set_flashdata('success_msg', 'FAQ added successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'FAQ added successfully');
            }

            redirect('faq/all');
        }
    }

    public function allFaq()
    {

        $data['allFaqs'] = $this->FaqModel->allFaqs();

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('faqs/all_faq', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function editFaq($faqId)
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        //$this->form->validation
        if (!$clean) {
            $data['maxSL'] = $this->FaqModel->lastItemId();
            $data['faq'] = $this->FaqModel->info(['id'=>$faqId]);
            
            if (!count($data['faq'])) {
                show_404();
            }

            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
            $data['maincontent'] = $this->load->view('faqs/edit_faq', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            $dataToUpdate = [
                'title' =>$clean['faq_title'],
                'body' =>$post['faq_body'],
                'show_in_home' =>isset($clean['show_in_home']) ? 1 : 0,
                'item_type'    => strtolower(str_replace(' ', '_', $clean['faq_title'])),
            ];
            
            $conditions = ['id'=>$faqId];
            $this->FaqModel->update($conditions, $dataToUpdate);
            $this->session->set_flashdata('success_msg', 'FAQ updated successfully');
            redirect("faq/edit/".$faqId);
        }
    }

    
    /**
     * Delete a faq item
     * @param integer $faqId faq id
     *
     * @return string
     */
    public function deleteFaq($faqId)
    {
        $this->FaqModel->delete($faqId);
        echo 'true';
    }

    /**
     * Pricing,How it works, About us, Disclaimer,... etc fields
     *
     * @return void
     */
    public function addLandPageItems()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);
        if (!$post) {
            $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
            $data['leftnav'] = $this->load->view('faqs/frontPageItems/addOtherItemsLeftNav', $data, true);
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

            $data['maincontent'] = $this->load->view('faqs/frontPageItems/addItems', $data, true);
            $this->load->view('master_dashboard', $data);
        } else {
            $dataToInsert = [
                'title'=>$clean['title'],
                'body'=>$post['body'],
                'item_type' => $clean['itemType'],
                'show_in_home' => 0,
            ];
            
            //video items
            if ($clean['itemType']=='how_it_works ') {
                $dataToInsert['body'] = strip_tags($clean['body']);
            }
            
            $itemExists = $this->FaqModel->info(['item_type'=>$clean['itemType']]);
            if (count($itemExists)) {
                $cond = [ 'item_type'=>$clean['itemType'] ];
                $this->FaqModel->update($cond, $dataToInsert);
            } else {
                $this->FaqModel->insert($dataToInsert);
            }
            $this->session->set_flashdata('success_msg', 'Item recorded successfully!');
            redirect('faq/add/other');
        }
    }

    /**
     * Ajax call to get front page item info(while admin add item).
     *
     * @return string item info
     */
    public function getItemInfo()
    {
        $post = $this->input->post();
        $itemExists = $this->FaqModel->info(['item_type'=>$post['itemType']]);

        if (count($itemExists)) {
            $arr = [
                'title'=> $itemExists['title'],
                'body'=> $itemExists['body'],
            ];
            echo json_encode($arr);
        } else {
            echo 'false';
        }
    }
    
    public function landPagevideoUpload()
    {
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['maincontent'] = $this->load->view('faqs/video_help/video_upload', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function landPagevideoList()
    {
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['videoList'] = $this->FaqModel->allData('video_helps');

        $data['maincontent'] = $this->load->view('faqs/video_help/video_list', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function serialize($faqId , $serial_id , $serial_id_new)
    {
        $insID = $this->FaqModel->serialize($serial_id_new);

        if (count($insID)) {
            $this->FaqModel->serialize_update($insID[0]['id'] , $serial_id);
            $this->FaqModel->serialize_update($faqId , $serial_id_new);
            echo "serialized Complete";
            
        }else{
            echo "This Serial is not available you entered";
        }
        
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

       $config['upload_path'] = 'assets/videoHelp/';
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
                    "Audio"=>'assets/videoHelp/'.$audioFiles["file_name"]
                  ];

                  array_push($array_one, $var2);
                 
               }
        }

        return json_encode($array_one);
        
    }

    public function video()
    {

        if ($this->input->post('serial_num') > 11) {
            $this->session->set_flashdata('Failed', 'Serial Number Can not bigger than 10'); 
            redirect($_SERVER['HTTP_REFERER']);
        }else{

            $this->form_validation->set_rules('serial_num', 'serial_num', 'required|is_unique[video_helps.serial_num]');
            if ($this->form_validation->run() !== FALSE)
                {
                    $files = $this->processVideoHelp($_POST);

                    $data['serial_num'] =  $this->input->post('serial_num');
                    $data['userfile'] = $files;
                    $this->FaqModel->insertTbl($data , 'video_helps');

                    $this->session->set_flashdata('message', 'successfully Uploaded');
                    redirect($_SERVER['HTTP_REFERER']);

                }else{
                    $this->session->set_flashdata('Failed', 'Serial Number Has Allready Been Taken '); 
                    redirect($_SERVER['HTTP_REFERER']);
                }

        }

    }

    public function videoEdit($id)
    {
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['data']  = $this->FaqModel->selectData( $id , 'video_helps');
        $files = json_decode($data['data'][0]['userfile'] , true);

        foreach ($files as $key => $value) {
            if (isset($value['Audio'])) {
                $video[] = $value['Audio'];
            }else{
                $title[] = $value['title'];
            }
        }

        $data['video'] = $video;
        $data['title'] = $title;
        $data['id'] = $id;

        $data['maincontent'] = $this->load->view('faqs/video_help/edit', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function deleteVideo($id)
    {
        $this->FaqModel->deleteVideo($id, 'video_helps');
        $this->session->set_flashdata('message', 'Delted Successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function videoupdate()
    {
        if ($this->input->post('serial_num') > 10) {
            $this->session->set_flashdata('Failed', 'Serial Number Can not bigger than 10'); 
            redirect($_SERVER['HTTP_REFERER']);
        }else{

            $ckId = $this->FaqModel->videoSerialize($this->input->post('serial_num') , 'video_helps');

            if (count($ckId)) {
                $ckId_file = json_decode($ckId[0]['userfile'] , true);

                foreach ($ckId_file as $key => $value) {
                    if (isset($value['title'])) {
                        $toUpdate[] = $value;
                    }else{
                        $toUpdate[] = $value;
                    }
                }

                if (isset($_POST['title'])) {
                    $files = $this->processVideoHelp($_POST);

                    $uploaded_file = json_decode($files , true);

                    foreach ($uploaded_file as $key => $value) {
                        if (isset($value['title'])) {
                            $toUpdate[] = $value;
                        }else{
                            $toUpdate[] = $value;
                        }
                    }
                }

                $data['serial_num'] = $this->input->post('serial_num');
                $data['userfile'] = json_encode($toUpdate);

                $this->FaqModel->videoSerializeUpdate($ckId[0]['id'] , 'video_helps' , $this->input->post('serial') );
                $this->FaqModel->videoHelpeUpdate( $this->input->post('id') ,  'video_helps' , $data );
             
                $this->session->set_flashdata('message', 'Updated Complete');
                redirect($_SERVER['HTTP_REFERER']);
                
            }else{
                $this->session->set_flashdata('Failed', 'This Serial is not available you entered'); 
                    redirect($_SERVER['HTTP_REFERER']);
            }

        }
    }

    public function ShowVideo($id)
    {
        $data =   $this->FaqModel->selectData($id ,'video_helps');

        $files = json_decode($data[0]['userfile'] , true);

        $title_num  = count($files) / 2 ;

        foreach ($files as $key => $value) {
            if ($key < $title_num) {
                $title[] = $value;
            }else{
                $videos[] = $value;
            }
        }

        $data['title'] =$title;
        $data['videos'] =$videos;

        $html = $this->load->view('faqs/video_help/showList', $data ,  TRUE);

        echo $html;
    }

    public function removeFile($serial_num , $FileSL)
    {
        $toUpdate =array();
        $data = $this->FaqModel->selectData( $serial_num , 'video_helps');

        $files = json_decode($data[0]['userfile'] , true);

        foreach ($files as $key => $value) {
            if (isset($value['Audio'])) {
                $video[] = $value['Audio'];
            }else{
                $title[] = $value['title'];
            }
        }

        unset($video[$FileSL]);
        unset($title[$FileSL]);

        foreach ($title as $key => $value) {
            $toUpdate[]['title'] = $value;
        }

        foreach ($video as $key => $value) {
            $toUpdate[]['Audio'] = $value;
        }

        $info['userfile'] = json_encode($toUpdate);

        $this->FaqModel->videoHelpeUpdate($serial_num, 'video_helps', $info);
        echo 1;
    }

    public function store_groupboard()
    {
        $this->form_validation->set_rules('room_id', 'Room Id', 'required|is_unique[tbl_available_rooms.room_id]');

        if ($this->form_validation->run() !== FALSE)
        {
            $this->FaqModel->insertTbl($_POST , 'tbl_available_rooms');
            $this->session->set_flashdata('message', 'successfully Uploaded');
            redirect($_SERVER['HTTP_REFERER']);

        }else{
            $this->session->set_flashdata('Failed', 'This Groupboard Number Has Allready Been Taken '); 
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function all_groupboard()
    {
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $glist = $this->FaqModel->allData('tbl_available_rooms');
        $result = array();

        foreach ($glist as $key => $value) {

            $roomIDTaken = $this->FaqModel->roomIDTaken($value['room_id']);

            if ( count($roomIDTaken) > 0 ) {
                $result[] = [
                    "id" => $value['id'],
                    "in_use" => $value['in_use'],
                    "room_id" => $value['room_id'],
                    "checked" => 1,
                    "user_email" => $roomIDTaken[0]['user_email'],
                    "subscription_type" => $roomIDTaken[0]['subscription_type']
                ]; 
            }else{

                $result[] = [
                    "id" => $value['id'],
                    "in_use" => $value['in_use'],
                    "room_id" => $value['room_id'],
                    "checked" => 0,
                    "user_email" => "",
                    "subscription_type" => ""
                ]; 

            }
        }

        $data['glist'] = $result;

        $data['maincontent'] = $this->load->view('admin/groupboard/all', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function edit_groupboard($id)
    {
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $data['data'] =   $this->FaqModel->selectData($id ,'tbl_available_rooms');

        $data['maincontent'] = $this->load->view('admin/groupboard/edit', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function deleteGroupboard($id='')
    {
        $this->FaqModel->deleteVideo($id, 'tbl_available_rooms');
        $this->session->set_flashdata('message', 'Delted Successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_groupboard()
    {
        $this->form_validation->set_rules('room_id', 'Room Id', 'required');

        if ($this->form_validation->run() !== FALSE)
        {
            $this->FaqModel->videoHelpeUpdate($_POST['id'] , 'tbl_available_rooms' , $_POST);
            $this->session->set_flashdata('message', 'successfully Updated');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function assignGroupBoard($groupboard_id)
    {
        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('dashboard_template/leftnav', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        $glist = $this->FaqModel->allData('tbl_useraccount');
        $data['glist'] = $glist;
        $data['groupboard_id'] = $groupboard_id;

        $data['maincontent'] = $this->load->view('admin/groupboard/groupBoardAssign', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function storeGroupBoard()
    {

        $this->load->model('Admin_model');
        $data['whiteboar_id'] = $_POST['groupboard_id'];
        $data_2['whiteboar_id'] = 0;

        $datass = $this->Admin_model->get_all_where('id' , 'tbl_useraccount' , 'whiteboar_id' , $_POST['groupboard_id']);

        $this->Admin_model->updateInfo('tbl_useraccount' , 'id' , $datass[0]['id'] , $data_2);
        $this->Admin_model->updateInfo('tbl_useraccount' , 'id' , $_POST['user_id'] , $data);

        $this->session->set_flashdata('message', 'Updated Successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
