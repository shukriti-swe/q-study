<?php

class ModuleModel extends CI_Model {

	public function moduleName($moduleId)
	{
		$res = $this->db
		->select('moduleName')
		->where('id', $moduleId)
		->get('tbl_module')
		->result_array();

		return isset($res[0]['moduleName'])?$res[0]['moduleName']:'';
	}

	public function moduleTypeName($moduleTypeId)
	{
		$res = $this->db
		->select('module_type')
		->where('id', $moduleTypeId)
		->get('tbl_moduletype')
		->result_array();

		return isset($res[0]['module_type'])?$res[0]['module_type']:'';
	}

	/**
     * return all module type 
     * @return array          all module type
     */
	public function allModuleType(  )
	{
		$this->db->select('*');

		$res = $this->db
		->get('tbl_moduletype')
		->result_array();
		return $res;
	}
}