<?php

class Login_model extends CI_Model{

	public function login_check_info($user_name,$password) {
		$this->db->select('*');
		$this->db->from('tbl_useraccount');
		$this->db->where('user_email',$user_name);
		$this->db->where('user_pawd',md5($password));
        // $this->db->where('status',1);

		$query_result = $this->db->get();
		$result = $query_result->row();
		return $result;
	}

	public function parent_pw_check_info($user_id,$password) {
		$this->db->select('*');
		$this->db->from('tbl_useraccount');
		$this->db->where('id',$user_id);
		$this->db->where('user_pawd',md5($password));
		$query_result = $this->db->get();
		$result = $query_result->row();
		return count($result);
	}

    /**
	* Check if a user email exists in DB or not
	* @param  string $email user email
	* @return boolean       0=>not exists, 1=>exists
	*/
	public function emailCheck( $email )
	{
		$res = $this->db
		->where('user_email', $email)
		->get('tbl_useraccount')
		->result_array();
		return ( count( $res )>0 ) ? 1:0;
	}

	public function trial()
	{
		$this->db->select('setting_value');
        $this->db->from('tbl_setting');
        $this->db->where('setting_type' , 'trial_period');
        $this->db->where('setting_key' , 'days');

        $query = $this->db->get();
        return $query->result_array();
    
	}

	public function login_check_info_trail($user_name,$password) {
		$this->db->select('*');
		$this->db->from('tbl_useraccount');
		$this->db->where('user_email',$user_name);
		$this->db->where('user_pawd',$password);
//        $this->db->where('status',1);

		$query_result = $this->db->get();
		$result = $query_result->row();
		return $result;
	}

	public function passwdChk( $email , $phone )
	{
		$res = $this->db
		->where('user_email', $email)
		->where('user_mobile', $phone)
		->get('tbl_useraccount')
		->result_array();
		return ( count( $res )>0 ) ? 1:0;
	}

	public function phoneChk( $email )
	{
		$res = $this->db
		->where('user_mobile', $email)
		->get('tbl_useraccount')
		->result_array();
		return ( count( $res )>0 ) ? 1:0;
	}

}
