<?php

class Corporate_model extends CI_Model {

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
		return true;
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
    
    public function userInfo($user_id) {
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        
        $this->db->join('tbl_country','tbl_useraccount.country_id = tbl_country.id','LEFT');
        $this->db->where('tbl_useraccount.id', $user_id);

        $query = $this->db->get();
        return $query->result_array();
    }
	public function userInfoArray($user_id) {
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        
        $this->db->join('tbl_country','tbl_useraccount.country_id = tbl_country.id','LEFT');
        $this->db->where('tbl_useraccount.id', $user_id);

        $query = $this->db->get();
        return $query->result_array();
    }

}
