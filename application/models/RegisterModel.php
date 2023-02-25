<?php

class RegisterModel extends CI_Model
{
	
	public function getUserType()
	{
		$this->db->select('*');
		$this->db->from('tbl_usertype');
		return $this->db->get()->result_array();
	}
	public function getSpecificUserType($userTypeSlug)
	{
		$this->db->select('*');
		$this->db->from('tbl_usertype');
		$this->db->where('user_slug',$userTypeSlug);
		return $this->db->get()->result_array();
	}
	
	// public function getCourse($user_type, $country_id,$subscription_type) {
	public function getCourse($user_type, $country_id) {
        $this->db->select('*');
        $this->db->from('tbl_course');
        
        $this->db->where('is_enable', 1);
        $this->db->where('user_type', $user_type);
        $this->db->where('country_id', $country_id);
        // $this->db->where('subscription_type', $subscription_type);
        
        return $this->db->get()->result_array();
    }
	
	public function getCourseCost($course_id){
		$this->db->select('courseCost,courseName');
		$this->db->from('tbl_course');
		$this->db->where('id',$course_id);
		return $this->db->get()->result_array();
	}
	public function getCountry()
	{
		$this->db->select('*');
		$this->db->from('tbl_country');
		return $this->db->get()->result_array();
	}
	public function getSpecificCountry($id)
	{
		
		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->where('id',$id);
		return $this->db->get()->result_array();
	}
	public function save_random_digit($data)
	{
		return $this->db->insert('tbl_random',$data);
	}
	public function saveUser($data)
	{
		$this->db->insert('tbl_useraccount',$data);
		return $this->db->insert_id();
	}
	public function basicInsert($table_name,$data)
	{
		 $this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}
	public function getInfo($table_name,$column_name,$id)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($column_name,$id);
		return $this->db->get()->result_array();
	}


	public function refferalLinkInsert($table_name,$data)
	{
		 $this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}

	public function getTrialCourse($user_type, $country_id, $course_status) {

        $this->db->select('*');
        $this->db->from('tbl_course');
        
        $this->db->where('is_enable', 1);
        $this->db->where('user_type', $user_type);
        $this->db->where('country_id', $country_id);
		$this->db->where('course_status', $course_status);
        
        return $this->db->get()->result_array();
    }

	public function getMyCourse($user_id) {

        $this->db->select('*');
        $this->db->from('tbl_registered_course');
        $this->db->where('user_id', $user_id);
		$this->db->where('status', 1);
        
        return $this->db->get()->result_array();
    }

	
}
