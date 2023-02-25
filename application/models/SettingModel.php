<?php

class SettingModel extends CI_Model
{
	
	public function getStripeKey($public_or_secreet){
		$mode=$this->getStripeMode();
		return $this->getSettingVal($mode.'_'.$public_or_secreet.'_key','stripe');
	}
	public function getStripeMode(){
		$returnVal='test';		
		$r=$this->getSettingVal('mode','stripe');
		if($r !=''){
			$returnVal=$r;
		}
		return $returnVal;
	}
	public function getPaypalKey($public_or_secreet)
	{
		$mode=$this->getPaypalMode();
		return $this->getSettingVal($mode.'_'.$public_or_secreet,'paypal');
	}
	public function getPaypalMode()
	{
		 $returnVal='test';	
		$r=$this->getSettingVal('mode','paypal');
		if($r !=''){
			$returnVal=$r;
		}
		return $returnVal;
	}
	public function getSettingVal($settingKey,$settingType){
		$returnVal='';		
		$this->db->select('setting_value');
		$this->db->from('tbl_setting');
		$this->db->where('setting_type',$settingType);
		$this->db->where('setting_key',$settingKey);		
		$row=$this->db->get()->row_array();
		if(!empty($row)){			
		if($row['setting_value']!='' && $row['setting_value']!=NULL){
				$returnVal=$row['setting_value'];
			}
		}
		return $returnVal;
	}
	
}
