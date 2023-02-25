<?php

class Subject extends CI_Controller
{
    public $loggedUserId;
    public function __construct()
    {
        parent::__construct();
        
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        $this->loggedUserId = $user_id;
        
        if ($user_id == null && $user_type == null) {
            redirect('welcome');
        }
        
        $this->load->model('SubjectModel');
        $this->load->model('Tutor_model');
    }

    public function showAllSubject()
    {
        $this->load->model('FaqModel');
        $data['video_help'] = $this->FaqModel->videoSerialize(24, 'video_helps'); //rakesh
        $data['video_help_serial'] = 24;

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        $data['allSubs'] = $this->renderSubs();
        $data['maincontent'] = $this->load->view('subjects/all_subjects', $data, true);
        $this->load->view('master_dashboard', $data);
    }

    public function renderSubs()
    {
        $conditions = ['created_by'=>$this->loggedUserId];
        $allSubs = $this->SubjectModel->all($conditions);
        $html = '';
        foreach ($allSubs as $sub) {
            $allchaps = $this->SubjectModel->chaptersOfSubject([$sub['subject_id']]);

           $html .= '<h3>'.$sub['subject_name'].'<button class="subject-edit-btn subject_edit_btn" data-subjectid="'.$sub['subject_id'].'" data-subject_name="'.$sub['subject_name'].'"><i class="fa fa-pencil subject-edit-icon"></i>Edit</button>'.'<button style="float:right;" subId="'.$sub['subject_id'].'" class="btn btn-default delSubBtn"><i class="fa fa-times" ></i> Delete</button></h3>';
            //$html .= '<input type="hidden" id="subId" value="'.$sub['subject_id'].'">';
            $html .= '<div>';
            $html .= '<table class="table">';
            if (count($allchaps)) {
                $html .= '<thead style="background-color:#CACACA"><tr> <td>Chapter Name</td> <td>Action</td></tr> </thead>';
            }
            $html .= '<tbody>';
            
            foreach ($allchaps as $chap) {
                $html .= '<tr>';
                $html .= '<td>'.$chap['chapterName'].'</td>';
                $html .= '<td  id="'.$chap['id'].'"><i class="fa fa-times delChapIcon"></i></td>';
                $html .= '</tr>';
            }
            $html .='</tbody></table></div>';
        }
        return $html;
    }

    /**
     * Responsible for deleting a chapter created by tutor
     * All question associated with that subject will be deleted
     *
     * @param integer $chapterId chapter to delete
     *
     * @return string true/false
     */
    public function deleteChapter($chapterId)
    {
        $chapterExists = $this->SubjectModel->search('tbl_chapter', ['id'=>$chapterId]);
        if (count($chapterExists)) {
            $this->SubjectModel->deleteChapter($chapterId);
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /**
     * Responsible for deleting a subject created by tutor
     * All chapter and question associated with that subject will be deleted
     *
     * @param integer $subjectId subject to delete
     *
     * @return string true/false
     */
    public function deleteSubject($subjectId)
    {
        $subjectExists = $this->SubjectModel->search('tbl_subject', ['subject_id'=>$subjectId]);
        if (count($subjectExists)) {
            $this->SubjectModel->deleteSubject($subjectId);
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /**
     * For auto complete suggestion
     *
     * @return string json encoded word items
     */
    public function suggestSubject()
    {
        $keyword = $this->input->get('query');
        $data['suggestions'] = $this->SubjectModel->suggestSubject($keyword);
        $tempArray = [];
        foreach ($data['suggestions'] as $suggestion) {
            $tempArray['suggestions'][] = [
                'value' => html_entity_decode($suggestion['value'], ENT_QUOTES),
                'data' =>  html_entity_decode($suggestion['data'], ENT_QUOTES)
            ];
        }
        
        echo json_encode($tempArray);
    }
	public function update_subject_name(){
        $data = array();
        $data['subject_name'] = $this->input->post('subject-name');
        $subject_id = $this->input->post('subject-id');
        $result = $this->SubjectModel->updateSubject($data,$subject_id);
        echo json_encode('Subject Updated Successfully');
    }
}
