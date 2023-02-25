<?php

class Qstudy_model extends CI_Model{
    

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
        
        if($loggedUserType == 1) { //parent
            $res = $this->db
            ->select('id as `st_id`')
            ->where('parent_id', $loggedUserId)
            ->get('tbl_useraccount')
            ->result_array();

        } else { //corporate/school/tutor
            $res = $this->db
            ->select('st_id')
            ->where($conditions)
            ->get('tbl_enrollment')
            ->result_array();
        }

        return array_column($res, 'st_id');
    }
    
    public function all_module_by_type($user_country,$tutorType) {
        $this->db->select('*');
        $this->db->from('tbl_module');
        
//        $this->db->join('tbl_moduletype','tbl_moduletype.id = tbl_module.moduleType','LEFT');
        $this->db->where('moduleType',1);
        $this->db->where('country',$user_country);
        if($tutorType == 7){
            $this->db->where('user_type',$tutorType);
        }else{
            $this->db->where('user_id',$tutorType);
        }
        
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }
}
