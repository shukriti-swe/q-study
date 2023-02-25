<?php

class Preview_model extends CI_Model {

    public function insertInfo($table, $data) {
        $this->db->insert($table, $data);
    }

    public function insertId($table, $data) {
        $this->db->insert($table, $data);

        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function getAllInfo($table) {
        $this->db->select('*');
        $this->db->from($table);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_where($select, $table, $columnName, $columnValue) {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($columnName, $columnValue);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSelectItem($select, $table) {
        $this->db->select($select);
        $this->db->from($table);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function updateInfo($table, $colName, $colValue, $data) {
        $this->db->where($colName, $colValue);
        $this->db->update($table, $data);
    }

    public function deleteInfo($table, $colName, $colValue) {
        $this->db->where($colName, $colValue);
        $this->db->delete($table);
    }

    public function getInfo($table, $colName, $colValue) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRow($table, $colName, $colValue) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);

        $query = $this->db->get();
        return $query->row_array();
    }
    
    
    //    Module Section
    public function userInfo($user_id) 
    {
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        
        $this->db->join('tbl_country','tbl_useraccount.country_id = tbl_country.id','LEFT');
		$this->db->join('zone', 'UPPER(tbl_country.countryCode) = zone.country_code', 'LEFT');
		
        $this->db->where('tbl_useraccount.id', $user_id);

        $query = $this->db->get();
        return $query->result_array();
    }
	
    public function get_sct_enrollment_info($stId,$sctType)
    {
        $this->db->select('tbl_useraccount.*,tbl_enrollment.sct_id,tbl_enrollment.st_id');
        $this->db->from('tbl_useraccount');
        $this->db->join('tbl_enrollment','tbl_useraccount.id=tbl_enrollment.sct_id');
        $this->db->where('tbl_useraccount.user_type',$sctType);
        $this->db->where('tbl_enrollment.st_id',$stId);
        return $this->db->get()->result_array();
    }
    public function getLinkInfo($table, $colName1, $colName2, $colValue1,$colValue2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName1, $colValue1);
        $this->db->where($colName2, $colValue2);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function delete_enrollment($userType,$user_id){
        $this->db->where('sct_type', $userType);
        $this->db->where('st_id', $user_id);	
        $this->db->delete('tbl_enrollment');
        return;
    }
    public function getStudentRefLink($stId){
        $this->db->select('tbl_useraccount.*,tbl_enrollment.sct_id,tbl_enrollment.st_id');
        
        $this->db->from('tbl_useraccount');
        $this->db->join('tbl_enrollment','tbl_useraccount.id=tbl_enrollment.sct_id');
        
        $this->db->where('tbl_enrollment.st_id',$stId);
        return $this->db->get()->result_array();
    }

    public function studentProgress( $conditions )
    {
        $res = $this->db
        ->where($conditions)
        ->get('tbl_studentprogress')
        ->result_array();

        return $res;
    }

    public function studentByClass($class)
    {
        $res = $this->db
        ->where('student_grade', $class)
        ->get('tbl_studentgrade')
        ->result_array();

        return $res;
    }

    public function studentName($studentId)
    {
        $res = $this->db
        ->select('name')
        ->where('id', $studentId)
        ->get('tbl_useraccount')
        ->result_array();

        return isset($res[0]['name'])?$res[0]['name']:'';
    }

    /**
     * get all students of a specific tutor/school/corporate/parent
     * @param  array $conditions [column_name=>value,...]
     * @return array             studentIds ex:[1,2,3,4,5]
     */
    public function allStudents( $conditions )
    {
        $loggedUserId = $this->session->userdata('user_id');
        $loggedUserType = $this->session->userdata('userType');
        
        if($loggedUserType == 1){ //parent
            $res = $this->db
            ->select('id as `st_id`')
            ->where('parent_id', $loggedUserId)
            ->get('tbl_useraccount')
            ->result_array();

        }else{ //corporate/school/tutor
            $res = $this->db
            ->select('st_id')
            ->where($conditions)
            ->get('tbl_enrollment')
            ->result_array();
        }

        return array_column($res, 'st_id');
    }
    
    
//    Preview Section
    public function tutorial_info($question_id, $orders) {

      $this->db->select('*');
      $this->db->from('for_tutorial_tbl_question');
      $this->db->where('tbl_ques_id', $question_id); 
      $this->db->where('orders', $orders);
      $this->db->limit(1);
      $query = $this->db->get()->result();
        
        return $query;
    }

    public function tutorial_count($question_id) {

      $this->db->select('orders');
      $this->db->from('for_tutorial_tbl_question');
      $this->db->where('tbl_ques_id', $question_id);
      $this->db->order_by('orders', 'DESC');
      $this->db->limit(1);
      $query = $this->db->get()->result();
        
        return $query;
    }

    public function getIdeaInfo($table, $ques_id) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where("question_id", $ques_id);

        $query = $this->db->get();
        return $query->result_array();
    }
    public function getIdeaDescription($table, $ques_id) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where("question_id", $ques_id);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPreviewIdeaInfo($ques_id,$idea_no) {
        $this->db->select('*');
        $this->db->from("idea_tutor_ans ita");
        $this->db->join("tbl_useraccount u","u.id = ita.tutor_id");
        $this->db->where("question_id", $ques_id);
        $this->db->where("idea_no", $idea_no);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getQuestionDetails($table,$question_id) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id', $question_id);

        $query = $this->db->get();
        return $query->result_array();
    }

    
    public function getStudentIdeas($question_id)
    {
        $this->db->select('*');
        $this->db->from('question_ideas');
        $this->db->where('tutor_question_id', $question_id);
        $query = $this->db->get();
        $result = $query->result_array();

        if(!empty($result)){
            $this->db->select('*');
            $this->db->from('question_ideas');
            $this->db->where('type',2);
            $this->db->where('question_id', $result[0]['question_id']);
            
            $query = $this->db->get();
            return $query->result_array();
        }else{
            $this->db->select('*');
            $this->db->from('question_ideas');
            $this->db->where('type',2);
            $this->db->where('question_id', $question_id);
            
            $query = $this->db->get();
            return $query->result_array();
        }
        
    }
    public function getTutorIdeas($question_id)
    {
        $this->db->select('*');
        $this->db->from('question_ideas');
        $this->db->where('tutor_question_id', $question_id);
        $query = $this->db->get();
        $result = $query->result_array();

        if(!empty($result)){
            $this->db->select('*');
            $this->db->from('question_ideas');
            $this->db->where('type',1);
            $this->db->where('question_id', $result[0]['question_id']);
            
            $query = $this->db->get();
            return $query->result_array();
        }else{
            $this->db->select('*');
            $this->db->from('question_ideas');
            $this->db->where('type',1);
            $this->db->where('question_id', $question_id);
            
            $query = $this->db->get();
            return $query->result_array();
        }

    }
}
