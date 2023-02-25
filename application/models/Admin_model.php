<?php

class Admin_model extends CI_Model
{
 
    public function insertInfo($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function insertId($table, $data)
    {
        $this->db->insert($table, $data);

        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function getAllInfo($table)
    {
        $this->db->select('*');
        $this->db->from($table);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_where($select, $table, $columnName, $columnValue)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($columnName, $columnValue);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSelectItem($select, $table)
    {
        $this->db->select($select);
        $this->db->from($table);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function updateInfo($table, $colName, $colValue, $data)
    {
        $this->db->where($colName, $colValue);
        $this->db->update($table, $data);
    }
	
	
    public function updateInfoStripe($table, $colName, $colValue, $data)
    {
        $this->db->where($colName, $colValue);
        $this->db->where("setting_type", "stripe");
        $this->db->update($table, $data);
    }

    public function updateInfoPaypal($table, $colName, $colValue, $data)
    {
        $this->db->where($colName, $colValue);
        $this->db->where("setting_type", "paypal");
        $this->db->update($table, $data);
    }

    public function deleteInfo($table, $colName, $colValue)
    {
        //echo $table . '+' .$colName.'+'.$colValue;//die;
        $this->db->where($colName, $colValue);
        $this->db->delete($table);
    }


    
    /**
     * Copy columns
     *
     * @param strign $source_table source table
     * @param string $conditionCol where column
     * @param mixed  $ConditionVal where column val
     * @param string $changeCol    column to change
     * @param mixed  $changeVal    val of column to change
     *
     * @return void
     */
    public function copy($source_table, $conditions, $changeCol = 0, $changeVal = 0)
    {
        $condition = '';
        
        $flag = 0;
        $totCond = count($conditions);
        foreach ($conditions as $key => $value) {
            $condition .= "`". $key ."`=".$value."";
            
            if (++$flag < $totCond) {
                $condition .= ' AND ';
            }
        }
        $this->db->query("CREATE TEMPORARY TABLE temp_table AS SELECT * FROM $source_table where $condition");
        
        if ($changeCol) {
            $this->db->query("UPDATE temp_table SET $changeCol=$changeVal,id=0");
        } else {
            $this->db->query("UPDATE temp_table SET id=0");
        }

        $this->db->query("INSERT INTO $source_table SELECT * FROM temp_table");
        $insertId = $this->db->insert_id();
        
        $this->db->query("DROP TEMPORARY TABLE temp_table");

        return $insertId;
    }


    public function getInfo($table, $colName, $colValue)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);

        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }
    public function getInfoTrialUser($table, $colName, $colValue,$limit,$offset)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getInfoInactiveUser($table, $colName, $colValue,$limit,$offset)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);
        $this->db->where('end_subscription <',date('Y-m-d'));
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getInfoTrialActiveUser($table, $colName, $colValue,$endTrial,$limit,$offset)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);
        $this->db->where('created >',$endTrial);
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getInfoTrialActiveUserAdmin($table, $colName, $colValue,$user_id,$endTrial)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);
        $this->db->where('id',$user_id);
        $this->db->where('created >',$endTrial);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function getInfoInactiveTrialUser($table, $colName, $colValue,$endTrial,$limit,$offset)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);
        $this->db->where('created <',$endTrial);
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getInfoInactiveUserCheck($table, $colName, $colValue,$endTrial,$user)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);
        $this->db->where('created <',$endTrial);
        $this->db->where('id',$user);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getInfoSuspendUser($table, $colName, $colValue,$limit,$offset)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllSignupUsers($table, $colName, $colValue,$limit,$offset)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);
        $this->db->where('end_subscription >',date('Y-m-d'));
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllguestUsers($table, $colName, $colValue,$limit,$offset)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    
    public function getUsersTypeWaise($table, $colName, $colValue,$limit,$offset)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    

    public function getRow($table, $colName, $colValue)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);

        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function total_registered()
    {
        $this->db->select('tbl_useraccount.*,tbl_usertype.userType,tbl_country.countryName');
        $this->db->from('tbl_useraccount');
        
        $this->db->join('tbl_usertype', 'tbl_useraccount.user_type = tbl_usertype.id', 'LEFT');
        $this->db->join('tbl_country', 'tbl_useraccount.country_id = tbl_country.id', 'LEFT');
        
        $this->db->where('user_type != ', 0);
        $this->db->where('user_type != ', 7);

        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function today_registered()
    {
        $this->db->select('count(*) AS total_registered');
        $this->db->from('tbl_useraccount');
        
        $this->db->where('user_type != ', 0);
        $this->db->where('user_type != ', 7);
//        $this->db->where('user_type != ', 7);

        $query = $this->db->get();
        return $query->row_array();
    }
    
    
    public function total_registered_search($name,$userType,$contryID)
    {
        $this->db->select('tbl_useraccount.*,tbl_usertype.userType,tbl_country.countryName');
        $this->db->from('tbl_useraccount');
        
        $this->db->join('tbl_usertype', 'tbl_useraccount.user_type = tbl_usertype.id', 'LEFT');
        $this->db->join('tbl_country', 'tbl_useraccount.country_id = tbl_country.id', 'LEFT');
        
        $this->db->where('user_type != ', 0);
        $this->db->where('user_type != ', 7);
        if ($name != null) {
           $this->db->where('name', $name);
        }
        if ($userType != null) {
           $this->db->where('user_type', $userType);
        }
        if ($contryID != null) {
           $this->db->where('country_id',$contryID);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    
    public function today_registered_search($name,$userType,$contryID)
    {
        $this->db->select('count(*) AS total_registered');
        $this->db->from('tbl_useraccount');
        
        $this->db->where('user_type != ', 0);
        $this->db->where('user_type != ', 7);
        if ($name != null) {
           $this->db->where('name', $name);
        }
        if ($userType != null) {
           $this->db->where('user_type', $userType);
        }
        if ($contryID != null) {
           $this->db->where('country_id',$contryID);
        }

        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function tutor_with_10_student()
    {
        $query = $this->db->query('SELECT *
            FROM tbl_useraccount t 
            LEFT JOIN tbl_country ON t.country_id = tbl_country.id 
            LEFT JOIN tbl_usertype ON t.user_type = tbl_usertype.id 
            WHERE ((SELECT count(*) FROM tbl_enrollment c WHERE c.sct_id = t.id)) >= 10 AND 
            user_type = 3');
        return $query->result_array();
    }
    
    public function tutor_with_50_vocabulary()
    {
        $query = $this->db->query('SELECT * '
            . 'FROM tbl_useraccount t '
            . 'LEFT JOIN tbl_country ON t.country_id = tbl_country.id 
            LEFT JOIN tbl_usertype ON t.user_type = tbl_usertype.id '
            . 'WHERE ((SELECT COUNT(*) FROM tbl_question q WHERE q.user_id = t.id AND q.questionType = 3 HAVING COUNT(*))) >= 50 AND '
            . 'user_type = 3 ');
        return $query->result_array();
    }
    
    public function get_todays_data($date)
    {
        $query = $this->db->query('SELECT COUNT(*) AS today_registered FROM `tbl_useraccount` WHERE DATE(FROM_UNIXTIME(created)) LIKE "%'.$date.'%" ');
        return $query->result_array();
    }
    
    
    //Course Schedule
    // public function get_course($subscription_type, $user_type, $country_id)
    public function get_course($user_type, $country_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_course');
        
        // $this->db->where('subscription_type', $subscription_type);
        $this->db->where('user_type', $user_type);
        $this->db->where('country_id', $country_id);
        $this->db->where('course_status', 1);

        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_trial_course($user_type, $country_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_course');
        
        // $this->db->where('subscription_type', $subscription_type);
        $this->db->where('user_type', $user_type);
        $this->db->where('country_id', $country_id);
        $this->db->where('course_status', 2);

        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Course name by course ID
     *
     * @param integer $courseId course ID
     *
     * @return string            course name
     */
    public function courseName($courseId)
    {
        $res = $this->db
        ->select('courseName')
        ->where('id', $courseId)
        ->get('tbl_course')
        ->result_array();

        return isset($res[0]) ? $res[0]['courseName'] : '';
    }

    /**
     * Where not in functionality
     *
     * @param string $table       table name to filter through
     * @param string $selectorCol selector column
     * @param array  $filter      get all columns without these items
     *
     * @return array               result array
     */
    public function whereNotIn($table, $selectorCol, $filter)
    {
        $res = $this->db
        ->where_not_in($selectorCol, $filter)
        ->get($table)
        ->result_array();

        return $res;
    }


    /**
     * Where in functionality
     *
     * @param string $table       table name to filter through
     * @param string $selectorCol selector column
     * @param array  $values      get all columns with these items
     *
     * @return array               result array
     */
    public function whereIn($table, $selectorCol, $values = [], $conditions = [])
    {
        $res = $this->db
        ->where_in($selectorCol, $values)
        ->where($conditions)
        ->get($table)
        ->result_array();

        return $res;
    }



    /**
     * Insert multiple data
     *
     * @param string $table table to insert
     * @param array  $data  data to insert
     *
     * @return id            last insert if
     */
    public function insertBatch($table, $data)
    {
        $this->db->insert_batch($table, $data);
        return $this->db->insert_id();
    }
    public function updateSmsApiSettings($a_settings_grop, $a_settings_key, $a_settings_value)
    {
        $this->db->set('setting_value', $a_settings_value);
        $this->db->where('setting_type', $a_settings_grop);
        $this->db->where('setting_key', $a_settings_key);
        $rs = $this->db->update('tbl_setting');
        return 1;
    }
    
    public function getSmsApiKeySettings()
    {
        $this->db->select('*');
        $this->db->from('tbl_setting');
        $this->db->where('setting_type', 'sms_api_settings');

        $query_result = $this->db->get();
        return $num_rows = $query_result->result_array();
    }
    
    public function getSmsMessageSettings()
    {
        $this->db->select('*');
        $this->db->from('tbl_setting');
        $this->db->where('setting_type', 'sms_message_settings');

        $query_result = $this->db->get();
        return $num_rows = $query_result->result_array();
    }
    
    public function get_settings_info($setting_type, $setting_key)
    {
        $this->db->select('*');
        $this->db->from('tbl_setting');
        $this->db->where('setting_type', $setting_type);
        $this->db->where('setting_key', $setting_key);

        $query_result = $this->db->get();
        return $query_result->result_array();
    }

    /**
     * search from any table using conditions
     *
     * @param  string $tableName table to perform search
     * @param  array  $params    conditions array
     * @return [type]            [description]
     */
    public function search($tableName, $params)
    {
        $res = $this->db
        ->where($params)
        ->get($tableName)
        ->result_array();

        return $res;
    }
	public function getModule($tableName, $params)
    {
        // Previous query
        // $this->db->select('tbl_module.*,tbl_course.courseName,tbl_subject.subject_name,tbl_chapter.chapterName,tbl_country.countryName');
        // $this->db->from($tableName);
        // $this->db->join('tbl_course', 'tbl_course.id = tbl_module.course_id', 'LEFT');
        // $this->db->join('tbl_subject', 'tbl_subject.subject_id = tbl_module.subject', 'LEFT');
        // $this->db->join('tbl_chapter', 'tbl_chapter.id = tbl_module.chapter', 'LEFT');
        // $this->db->join('tbl_country', 'tbl_country.id = tbl_module.country', 'LEFT');
        // $this->db->where($params);
        // $query = $this->db->get();
        // return $query->result_array();
        
        $this->db->select('tbl_module.*,tbl_course.courseName,tbl_subject.subject_name,tbl_chapter.chapterName,tbl_country.countryName,BIN(tbl_module.moduleName) as module_name');
        $this->db->from($tableName);
        $this->db->join('tbl_course', 'tbl_course.id = tbl_module.course_id', 'LEFT');
        $this->db->join('tbl_subject', 'tbl_subject.subject_id = tbl_module.subject', 'LEFT');
        $this->db->join('tbl_chapter', 'tbl_chapter.id = tbl_module.chapter', 'LEFT');
        $this->db->join('tbl_country', 'tbl_country.id = tbl_module.country', 'LEFT');
        $this->db->where($params);
        $this->db->order_by('tbl_module.moduleType','asc');
        $this->db->order_by('tbl_module.subject','asc');
        $this->db->order_by('tbl_module.studentGrade','asc');
        $this->db->order_by('LENGTH(tbl_module.moduleName)');
        $this->db->order_by('tbl_module.moduleName','asc');
        $query = $this->db->get();
        //echo $this->db->last_query();die();
        return $query->result_array();
    }

    /**
     * Multiple row delete
     *
     * @param string $table $table to perform
     * @param array  $ids   ids to delete
     *
     * @return void
     */
    public function delMulti($table, $ids)
    {
        $this->db
        ->where_in('id', $ids)
        ->delete($table);
    }

    public function get_questions($id , $q_type)
    {
        $this->db->select("tbl_questiontype.id AS 'tbl_questiontype_id' , tbl_question.id AS 'tbl_question_id'  ");
        $this->db->from('tbl_questiontype');
        $this->db->join('tbl_question', 'tbl_questiontype.id = tbl_question.questionType');
        $this->db->join('tbl_useraccount', 'tbl_useraccount.id = tbl_question.user_id');
        $this->db->where('tbl_useraccount.id' , $id);
        $this->db->where('tbl_questiontype.id' , $q_type);
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    public function getSmsType($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_setting');
        $this->db->where('setting_key', $id);

        $query_result = $this->db->get();
        return $num_rows = $query_result->result_array();
    }

    public function get_all_whereTwo($select, $table, $columnName, $columnValue , $columnNameTwo , $columnValueTwo)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($columnName, $columnValue);
        $this->db->where($columnNameTwo, $columnValueTwo);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function whiteboardPurches( $tbl , $user_id)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where("user_id" , $user_id );
        $this->db->where('endTime >',time());
        $this->db->where('status',1);
        $this->db->where_in('course_id' , [ 53 , 54 ] );
        $query_result = $this->db->get();
        return count( $query_result->result_array() ) > 0 ? 1:0 ;
    }

    public function groupboard_req()
    {
        $this->db->select('user_id');
        $this->db->from('tbl_registered_course');
        $this->db->join('tbl_useraccount', 'tbl_registered_course.user_id = tbl_useraccount.id');
        $this->db->where_in('tbl_useraccount.user_type' , [ 3 , 4 ] );
        $this->db->where_in('course_id' , [ 53 , 54 ] );
        $query_result = $this->db->get();

        return ($query_result->result_array());
    }

    public function groupboard_taker()
    {
        $this->db->select('id');
        $this->db->from("tbl_useraccount");
        $this->db->where('whiteboar_id !=', 0);
        $query_result = $this->db->get();

        return ($query_result->result_array());
    }

    public function getTutorOrganiseInfo($tbl , $colName , $colValue)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where($colName , $colValue );
        $this->db->where_in('user_type' , [ 4 , 5 ] );

        $query_result = $this->db->get();
        return $query_result->result_array();
    }

    public function getStudentsRefLink($user_id)
    {
        $this->db->select('tbl_useraccount.*,tbl_enrollment.sct_id,tbl_enrollment.st_id');
        $this->db->from('tbl_useraccount');
        $this->db->join('tbl_enrollment', 'tbl_useraccount.id=tbl_enrollment.st_id');
        $this->db->where('tbl_enrollment.sct_id', $user_id);
        return $this->db->get()->result_array();
    }

    public function getTutorRefLink($user_id)
    {
        $this->db->select('tbl_useraccount.name,tbl_useraccount.id,tbl_enrollment.sct_id,tbl_enrollment.st_id');
        $this->db->from('tbl_enrollment');
        $this->db->join('tbl_useraccount', 'tbl_useraccount.id=tbl_enrollment.sct_id');
        $this->db->where('tbl_enrollment.st_id', $user_id);
        $this->db->where('tbl_useraccount.user_type',3);
        return $this->db->get()->result_array();
    }

    public function getInfoPrizeWinerUser($limit,$offset)
    {
        $this->db->select('tbl_useraccount.*,prize_won_users.*');
        $this->db->from('prize_won_users');
        $this->db->join('tbl_useraccount', 'tbl_useraccount.id=prize_won_users.user_id');
        $this->db->where('prize_won_users.status','pending');
        $this->db->group_by('prize_won_users.user_id');
        $this->db->limit($limit,$offset);
        return $this->db->get()->result_array();
    }

    public function getInfoPrizeWinerUserByID($user_id,$limit,$offset)
    {
        $this->db->select('tbl_useraccount.*,prize_won_users.*,tbl_products.product_title,tbl_products.image');
        $this->db->from('prize_won_users');
        $this->db->join('tbl_useraccount', 'tbl_useraccount.id = prize_won_users.user_id');
        $this->db->join('tbl_products', 'tbl_products.id = prize_won_users.productId');
        $this->db->where('prize_won_users.user_id', $user_id);
        $this->db->order_by('prize_won_users.id','desc');
        return $this->db->get()->result_array();
    }


    public function getInfoDirectDepositUser($table, $colName, $colValue,$limit,$offset)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getInfoDirectDepositUserCount($table, $colName, $colValue)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return count($query->result_array());
    }
    
    
    public function getTutorCommission($table, $colName, $colValue,$colName2,$colValue2)
    {
        
        $this->db->select_sum('amount', 'Amount');
        $this->db->where($colName2, $colValue2);
        $this->db->where($colName, $colValue);
        $this->db->group_by("tutorId");
        $result = $this->db->get($table)->result_array();
        
        return $result[0]['Amount'];
    }
    
    public function checkStudentPercentage($table, $colName, $colValue)
    {
        
         $this->db->select('user_id, COUNT(user_id) as total_row, sum(percentage) as total_percentage, sum(percentage)/COUNT(user_id) as percentage');
         $this->db->where($colName, $colValue);
         $this->db->where('status', 0);
         $this->db->group_by('user_id');  
         $result = $this->db->get($table)->result_array();
        
        return $result;
    }

    public function getTotalIncome(){
        $this->db->select('sum(total_cost) as total_cost');
        $this->db->from('tbl_payment');
        $this->db->where('payment_status !=','pending');
        return $query = $this->db->get()->result();
    }


    public function getDailyIncome(){
        $startTime = strtotime(date('Y-m-d 00:00:00'));
        $endTime   = strtotime(date('Y-m-d 23:59:59'));

        // echo $startTime;echo "<br>";echo $endTime;die;
        $this->db->select('sum(total_cost) as daily_income');
        $this->db->from('tbl_payment');
        $this->db->where('PaymentDate >=', $startTime);
        $this->db->where('PaymentDate <=', $endTime);
        $this->db->where('payment_status !=','pending');
        return $query = $this->db->get()->result();
    }


    public function getDepositeResources($limit,$offset)
    {
        $this->db->select('tbl_useraccount.name,tbl_qs_payment.user_id');
        $this->db->from('tbl_qs_payment');
        $this->db->join('tbl_useraccount', 'tbl_qs_payment.user_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('tbl_qs_payment.PaymentEndDate >',time());
        $this->db->group_by('tbl_qs_payment.user_id');
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function whiteboardPurchesLists($limit,$offset)
    {
        $this->db->select('tbl_useraccount.name,tbl_registered_course.user_id');
        $this->db->from('tbl_registered_course');
        $this->db->join('tbl_useraccount', 'tbl_registered_course.user_id = tbl_useraccount.id');
        $this->db->where_in('course_id' , [ 53 , 54 ] );
        $this->db->group_by('tbl_registered_course.user_id');
        $this->db->limit($limit,$offset);
        $query_result = $this->db->get();
        return $query_result->result_array();
    }
    
    

    public function whiteboardPurchesSignupLists($type,$limit,$offset)
    {
        
        $tbl_setting = $this->db->where('setting_key','days')->get('tbl_setting')->row();
        $duration    = $tbl_setting->setting_value;
        $date        = date('Y-m-d');
        $d1          = date('Y-m-d', strtotime('-'.$duration.' days', strtotime($date)));
        $trialEndDate= strtotime($d1);
        
        $this->db->select('tbl_useraccount.name,tbl_registered_course.user_id');
        $this->db->from('tbl_registered_course');
        $this->db->join('tbl_useraccount', 'tbl_registered_course.user_id = tbl_useraccount.id');
        $this->db->where_in('course_id', [ 53 , 54 ]);
        $this->db->where('subscription_type',$type);
        if($type == 'signup'){
            $this->db->where('end_subscription >',date('Y-m-d'));
        }
        if($type == 'trial'){
            $this->db->where('tbl_useraccount.created >',$trialEndDate);
            $this->db->where('tbl_useraccount.parent_id',null);
        }
        $this->db->where('tbl_useraccount.whiteboar_id',0);
        $this->db->group_by('tbl_registered_course.user_id');
        $this->db->limit($limit,$offset);
        $query_result = $this->db->get();
        return $query_result->result_array();
    }
    
    
    public function tutorCommisionForAssignStudent($limit,$offset){
        $this->db->select('tbl_useraccount.name,tbl_tutor_commisions.tutorId as user_id');
        $this->db->from('tbl_tutor_commisions');
        $this->db->join('tbl_useraccount', 'tbl_tutor_commisions.tutorId = tbl_useraccount.id');
        $this->db->where('tbl_tutor_commisions.status',0);
        $this->db->group_by('tbl_tutor_commisions.tutorId');
        $this->db->limit($limit,$offset);
        $query_result = $this->db->get();
        return $query_result->result_array();
    }
    
    
    public function vocabularyCommisionCheck($limit,$offset){
        $this->db->select('tbl_useraccount.name,dictionary_payment.word_creator as user_id');
        $this->db->from('dictionary_payment');
        $this->db->join('tbl_useraccount','dictionary_payment.word_creator = tbl_useraccount.id');
        $this->db->where('dictionary_payment.total_approved >',intval('dictionary_payment.total_paid')+50);
        $this->db->limit($limit,$offset);
        $query_result = $this->db->get();
        return $query_result->result_array();
    }
    
    
    
    public function checkStudentPercentageNotification($table,$limit,$offset)
    {
        
         $this->db->select('user_id,tbl_useraccount.name, COUNT(user_id) as total_row, sum(percentage) as total_percentage, sum(percentage)/COUNT(user_id) as percentage');
         $this->db->from('daily_modules');
         $this->db->where('status', 0);
         $this->db->join('tbl_useraccount','daily_modules.user_id = tbl_useraccount.id');
         $this->db->group_by('daily_modules.user_id');
         $this->db->limit($limit,$offset);  
         $result = $this->db->get()->result_array();
        
        return $result;
    }
    
    public function getDirectDepositCourse($user_id){
        $this->db->where('user_id',$user_id);
        $this->db->where('paymentType',3);
        $this->db->where('PaymentEndDate >',time());
        $query_result = $this->db->get('tbl_payment');
        return $query_result->num_rows();
    }
    
    public function getDirectDepositPendingCourse($user_id){
        $this->db->where('user_id',$user_id);
        $this->db->where('payment_status','pending');
        $this->db->where('paymentType',3);
        $this->db->where('PaymentEndDate >',time());
        $query_result = $this->db->get('tbl_payment');
        return $query_result->num_rows();
    }
    
    public function getActiveCourse($user_id){
        $this->db->where('user_id',$user_id);
        $this->db->where_in('payment_status',['succeeded','Completed','active']);
        $this->db->where_in('paymentType',[1,2,3]);
        $this->db->where('PaymentEndDate >',time());
        $query_result = $this->db->get('tbl_payment');
        return $query_result->num_rows();
    }
    
    public function getInfoDirectDepositUserList(){
        
        $this->db->select('tbl_useraccount.name,tbl_useraccount.id');
        $this->db->from('tbl_payment');
        $this->db->where('paymentType',3);
        $this->db->where('PaymentEndDate >',time());
        $this->db->where('tbl_payment.payment_status','pending');
        $this->db->join('tbl_useraccount','tbl_payment.user_id = tbl_useraccount.id');
        $this->db->group_by('tbl_payment.user_id');
        $query_result = $this->db->get();
        return $query_result->num_rows();
    }
    
    
    public function getInfoDirectDepositUserAllByList($limit,$offset)
    {
        // $this->db->select('*');
        // $this->db->from($table);
        // $this->db->where($colName, $colValue);
        // $this->db->limit($limit,$offset);
        // $query = $this->db->get();
        // return $query->result_array();
        
        $this->db->select('tbl_useraccount.name,tbl_useraccount.id');
        $this->db->from('tbl_payment');
        $this->db->where('paymentType',3);
        $this->db->where('PaymentEndDate >',time());
        $this->db->where('tbl_payment.payment_status','pending');
        $this->db->join('tbl_useraccount','tbl_payment.user_id = tbl_useraccount.id');
        $this->db->group_by('tbl_payment.user_id');
        $this->db->limit($limit,$offset);
        $query_result = $this->db->get();
        return $query_result->result_array();
    }
    
    
    public function checkRegisterCourse($course_id,$user_id){
        $this->db->where('user_id',$user_id);
        $this->db->where('course_id',$course_id);
        $this->db->where('status',1);
        $query_result = $this->db->get('tbl_registered_course');
        return $query_result->num_rows();
        
    }
    
    public function getCheckReisterCourses($user_id){
        $this->db->where('user_id',$user_id);
        $this->db->where('paymentType !=',3);
        $this->db->where('PaymentEndDate >',time());
        $query_result = $this->db->get('tbl_payment');
        return $query_result->num_rows();
        
    }
    
    public function checkDepositDetails($table,$countryId){
        $this->db->where('country_id',$countryId);
        $query_result = $this->db->get($table);
        return $query_result->num_rows();
        
    }
    
    public function getDepositDetails($table,$countryId){
        $this->db->where('country_id',$countryId);
        $query_result = $this->db->get($table)->row();
        return $query_result;
        
    }
    
    public function checkDepositDetailsUpdate($table,$countryId,$data){
        $this->db->where('country_id',$countryId);
        $query_result = $this->db->update($table,$data);
        return $query_result;
        
    }
    
    public function checkDepositDetailsInsert($table,$countryId,$data){
        $query_result = $this->db->insert($table,$data);
        return $query_result;
        
    }

    public function getallcreative(){
        $this->db->select('*');
        $this->db->from('tbl_registered_course');
        $this->db->where('assign_examine', 1);
        $value = array(62, 63);
        $this->db->where_in('course_id', $value);

        $query = $this->db->get();
        return $query->result_array();
        
    }
    public function getallcreativeDetails(){

        // SELECT * FROM `tbl_registered_course` WHERE `assign_examine`=1 and (`course_id`=63||course_id=62);

        $this->db->select('*');
        $this->db->from('tbl_registered_course');
        $this->db->join('tbl_useraccount', 'tbl_registered_course.user_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('tbl_registered_course.assign_examine', 1);
        $value = array(62, 63);
        $this->db->where_in('tbl_registered_course.course_id', $value);
        $query = $this->db->get();
        
        return $query->result_array();
        
    }
    public function getalltutor(){
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        $this->db->where('user_type', 3);
        $this->db->or_where('user_type', 4);
        $this->db->or_where('user_type', 5);

        $query = $this->db->get();
        return $query->result_array();
        
    }
    public function assignExamine($assigned_student,$examine){
        
        foreach($assigned_student as $student_id){
           
            $this->db->select('*');
            $this->db->from('tbl_registered_course');
            $this->db->where('user_id', $student_id);
            $this->db->order_by("id", "desc");
            $query = $this->db->get();
            $result = $query->row();
            
            $data = [
                'student_id' =>$student_id,
                'course_id' =>$result->course_id,
                'examine_id' =>$examine['0'],
                'status' =>1,
            ];
            
            $this->db->select('*');
            $this->db->from('assigned_student');
            $this->db->where('student_id', $student_id);
            $this->db->where('course_id', $result->course_id);
            $query = $this->db->get();
            $check = $query->result_array();
            
            if(empty($check)){

            $this->db->insert('assigned_student', $data);
            $data2 = [
                'assign_examine' =>2,
            ];
            $this->db->where("user_id", $student_id);
            $this->db->where("course_id", $result->course_id);
            $this->db->update("tbl_registered_course", $data2);

            }else{
                
                $this->db->where('student_id', $student_id);
                $this->db->where('course_id', $result->course_id);
                $this->db->update('assigned_student', $data);
                
                $data2 = [
                    'assign_examine' =>2,
                ];
                $this->db->where("user_id", $student_id);
                $this->db->where("course_id", $result->course_id);
                $this->db->update("tbl_registered_course", $data2);
            }

        }
            
            $this->db->select('*');
            $this->db->from('assigned_student');
            $this->db->join('tbl_useraccount', 'assigned_student.student_id = tbl_useraccount.id', 'LEFT');
            $this->db->where('examine_id', $examine['0']);
            $query = $this->db->get();
            return $query->result_array();

        
    }
    public function getExamineDetails($examine){
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        $this->db->where('id', $examine['0']);

        $query = $this->db->get();
        return $query->result_array();
        
    }

    public function idea_created_students_list(){
        // $this->db->select('*');
        // $this->db->from('idea_student_ans');
        // $this->db->where('teacher_correction',0);

        // $query = $this->db->get();
        // return $query->result_array();question_ideas
        $this->db->select('*');
        $this->db->from('question_ideas');
        $this->db->where('type',2);
        $this->db->group_by('user_id');

        $query = $this->db->get();
        return $query->result_array();
        
    }
    public function get_idea_created_student(){
        $this->db->select('*');
        $this->db->from('idea_student_ans');
        $this->db->where('teacher_correction',0);

        $query = $this->db->get();
        return $query->result_array();
        
    }
    public function idea_created_student_list(){
        // $this->db->select('*');
        // $this->db->from('tbl_registered_course');
        // $this->db->join('tbl_useraccount', 'tbl_registered_course.user_id = tbl_useraccount.id', 'LEFT');
        // $value = array(62, 63);
        // $this->db->where_in('tbl_registered_course.course_id', $value);
        // $this->db->select('*');aaa
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        //$this->db->join('tbl_useraccount', 'question_ideas.user_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('user_type',6);
        // $this->db->group_by('user_id');

        $query = $this->db->get();
        // echo "<pre>";print_r($query->result_array());die();
        return $query->result_array();
        
    }

    public function idea_created_students(){
        $this->db->select('user_id');
        $this->db->from('question_ideas');
        $this->db->where('type',2);
        $this->db->group_by('user_id');

        $query = $this->db->get();
        return $query->result_array();
        
    }
    public function get_all_ideas($student_id){
        $this->db->select('*, question_ideas.id as idea_id, question_ideas.question_id as i_question_id');
        $this->db->from('question_ideas');
        $this->db->join('idea_info', 'idea_info.id = question_ideas.user_id', 'LEFT');
        $this->db->where('question_ideas.user_id', $student_id);
        
        $query = $this->db->get();
        $main_results = $query->result_array();
        // echo "<pre>";print_r($relults);die();
        $results = $main_results;
        if(!empty($results)){
            foreach($results as $key=>$result){
                $idea_id = $result['idea_id'];
                $this->db->select('*');
                $this->db->from('tutor_remake_idea_info');
                $this->db->where('idea_id', $idea_id);
                
                $query = $this->db->get();
                $res = $query->result_array();
                if(!empty($res)){
                    $main_results[$key]['remake_info'] = $res[0];
                }else{
                    $main_results[$key]['remake_info'] = [];
                }
             }

            return $main_results;
        }else{
            return $main_results;
        }
        

    }

    public function get_student_info($student_id){
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        $this->db->where('id', $student_id);
        
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_student_ans($idea_id,$student_id){
        $this->db->select('*');
        $this->db->from('idea_student_ans');
        $this->db->join('idea_info', 'idea_student_ans.idea_id = idea_info.id', 'LEFT');
        $this->db->where('student_id', $student_id);
        $this->db->where('idea_id', $idea_id);
        
        $query = $this->db->get();
        return $query->result_array();

    }
    public function getAdminIdeaCheckId($table,$data){
        
        $this->db->select('*');
        $this->db->from('idea_check_workout');
        $this->db->where('student_id',  $data['student_id']);
        $this->db->where('idea_id', $data['idea_id']);
        $this->db->where('idea_no', $data['idea_no']);
        $this->db->where('checker_id', $data['checker_id']);
        $this->db->where('question_id', $data['question_id']);
        $this->db->where('module_id', $data['module_id']);
        
        $query = $this->db->get();
        $check = $query->row();
        if(empty($check)){
            $this->db->insert($table, $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }else{
            $this->db->where('id', $check->id);
            $this->db->update($table, $data);
            return $check->id;
        }
        

    }
    public function get_this_idea($checkout_id){
        $this->db->select('*');
        $this->db->from('idea_check_workout');
        $this->db->where('id', $checkout_id);
        
        $query = $this->db->get();
        $result = $query->row();
        
       // echo $result->idea_id;
       $this->db->select('*');
       $this->db->from('idea_student_ans');
       $this->db->join('idea_info', 'idea_student_ans.idea_id = idea_info.id', 'LEFT');
       $this->db->where('idea_student_ans.idea_id', $result->idea_id);
       $this->db->where('idea_student_ans.student_id', $result->student_id);
       
       $query2 = $this->db->get();
       return $query2->result_array();

    }
    public function get_ideas($checkout_id){
        $this->db->select('*');
        $this->db->from('idea_check_workout');
        $this->db->where('id', $checkout_id);
        
        $query = $this->db->get();
        $result = $query->row();
        
       // echo $result->idea_id;
       $this->db->select('*');
       $this->db->from('idea_student_ans');
       $this->db->join('idea_info', 'idea_student_ans.idea_id = idea_info.id', 'LEFT');
       $this->db->where('idea_student_ans.idea_id', $result->idea_id);
       
       $query2 = $this->db->get();
       return $query2->result_array();

    }
    public function get_admin_workout($checkout_id){
        $this->db->select('*');
        $this->db->from('idea_check_workout');
        $this->db->where('id', $checkout_id);
        
        $query = $this->db->get();
        return $query->result_array();

    }
    public function idea_get($student_id,$idea_id){
        $this->db->select('*');
        $this->db->from('idea_student_ans');
        $this->db->join('idea_info', 'idea_student_ans.idea_id = idea_info.id', 'LEFT');
        $this->db->where('idea_student_ans.idea_id', $idea_id);
        $this->db->where('idea_student_ans.student_id', $student_id);
 
        $query = $this->db->get();
        return $result = $query->row();
 
    }

    public function correction_report_save($table,$data){
        
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('student_id',  $data['student_id']);
        $this->db->where('idea_id', $data['idea_id']);
        $this->db->where('idea_no', $data['idea_no']);
        $this->db->where('checker_id', $data['checker_id']);
        $this->db->where('question_id', $data['question_id']);
        $this->db->where('module_id', $data['module_id']);
        
        $query = $this->db->get();
        $check = $query->row();
        if(empty($check)){
            $this->db->insert($table, $data);
            $insert_id = $this->db->insert_id();
            
            $data2['teacher_correction']=$insert_id;
            $data2['by_admin_or_tutor']=1;
            $data2['finish_date']=date("Y/m/d");
            $this->db->where('student_id',  $data['student_id']);
            $this->db->where('idea_id', $data['idea_id']);
            $this->db->where('idea_no', $data['idea_no']);
            $this->db->where('question_id', $data['question_id']);
            $this->db->where('module_id', $data['module_id']);
            $this->db->update("idea_student_ans", $data2);
            return $insert_id;
        }else{
            $this->db->where('id', $check->id);
            $this->db->update($table, $data);
            $insert_id = $this->db->insert_id();

            $data2['teacher_correction']=$check->id;
            $data2['by_admin_or_tutor']=1;
            $data2['finish_date']=date("Y/m/d");
            $this->db->where('student_id',  $data['student_id']);
            $this->db->where('idea_id', $data['idea_id']);
            $this->db->where('idea_no', $data['idea_no']);
            $this->db->where('question_id', $data['question_id']);
            $this->db->where('module_id', $data['module_id']);
            $this->db->update("idea_student_ans", $data2);
            return $check->id;
        }
        

    }
    public function get_question_details($question_id){
        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('id', $question_id);
 
        $query = $this->db->get();
        return $result = $query->result_array();
 
    }

    public function get_idea_details($idea_id){
        $this->db->select('*');
        $this->db->from('idea_info');
        $this->db->where('id', $idea_id);
 
        $query = $this->db->get();
        return $result = $query->result_array();
 
    }
    public function get_idea_description($idea_id){
        $this->db->select('*');
        $this->db->from('idea_description');
        $this->db->where('idea_id', $idea_id);
 
        $query = $this->db->get();
        return $result = $query->result_array();
 
    }
    public function get_student_ans_details($student_id){
        $this->db->select('*');
        $this->db->from('idea_student_ans');
        $this->db->join('tbl_useraccount', 'idea_student_ans.student_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('idea_student_ans.student_id', $student_id);

        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function getTutorCorrection($student_id,$idea_id,$idea_no){
        $this->db->select('*');
        $this->db->from('idea_correction_report');
        $this->db->where('student_id', $student_id);
        $this->db->where('idea_id', $idea_id);
        $this->db->where('idea_no', $idea_no);

        $query = $this->db->get();
        return $result = $query->result_array();
    }
    public function getIdeas($idea_id){
        $this->db->select('*');
        $this->db->from('idea_student_ans');
        $this->db->where('idea_id', $idea_id);

        $query = $this->db->get();
        return $result = $query->result_array();
    }
    public function idea_get_correction($student_id,$idea_id){
       
        $this->db->select('*');
        $this->db->from('idea_correction_report');
        $this->db->where('idea_id', $idea_id);
        $this->db->where('student_id', $student_id);

        $query = $this->db->get();
        return $result = $query->result_array();
        
    }
    public function idea_created_tutor_list(){
        $this->db->distinct();
        $this->db->select('tbl_useraccount.id');
        $this->db->from('tbl_question');
        $this->db->where('tbl_question.questionType', 17);
        $this->db->where('idea_info.allows_online', 1);
        $this->db->join('idea_info', 'idea_info.question_id = tbl_question.id');
        $this->db->join('tbl_useraccount', 'tbl_question.user_id = tbl_useraccount.id');

        $query = $this->db->get();
        return $result = $query->result_array();

        // $this->db->distinct();
        // $this->db->select('tbl_useraccount.id');
        // $this->db->from('idea_tutor_ans');
        // $this->db->join('tbl_useraccount', 'idea_tutor_ans.tutor_id = tbl_useraccount.id', 'LEFT');
        // $this->db->where('tbl_useraccount.user_type', 3);

        // $query = $this->db->get();
        // return $query->result_array();
        
    }
    public function get_all_tutor(){
        
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        $this->db->where('user_type', 3);
        $this->db->or_where('user_type', 7);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_tutor_ans($tutor_id){
        $this->db->select('*');
        $this->db->from('idea_tutor_ans');
        $this->db->where('tutor_id', $tutor_id);

        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_tutor_ideas($tutor_id){
        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('tbl_question.user_id', $tutor_id);
        // $this->db->where('idea_info.allows_online', 1);
        $this->db->where('tbl_question.questionType', 17);
        $this->db->join('idea_info', 'idea_info.question_id = tbl_question.id');

        $query = $this->db->get();
        return $result = $query->result_array();
    }
    public function get_tutor_ans_details($tutor_id,$idea_id,$question_id,$idea_no){
        $this->db->select('*');
        $this->db->from('idea_tutor_ans');
        $this->db->join('tbl_useraccount', 'idea_tutor_ans.tutor_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('idea_tutor_ans.tutor_id', $tutor_id);
        $this->db->where('idea_tutor_ans.idea_id', $idea_id);
        $this->db->where('idea_tutor_ans.question_id', $question_id);
        $this->db->where('idea_tutor_ans.idea_no', $idea_no);

        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_tutor_idea_info($tutor_id,$idea_id,$question_id,$idea_no){
        $this->db->select('*');
        $this->db->from('idea_info');
        $this->db->join('idea_description', 'idea_info.id = idea_description.idea_id', 'LEFT');
        $this->db->where('idea_info.id', $idea_id);
        $this->db->where('idea_info.question_id', $question_id);
        //$this->db->where('idea_description.idea_no', $idea_no);

        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_all_ideas_infos($idea_id,$question_id){
        $this->db->select('*');
        $this->db->from('idea_description');
        $this->db->where('idea_id', $idea_id);
        $this->db->where('question_id', $question_id);

        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_tutor_total_like($idea_id,$question_id,$tutor_id){
        $this->db->select('*');
        $this->db->from('tutor_total_like');
        $this->db->where('tutor_id', $tutor_id);

        $query = $this->db->get();
        return $query->result_array();
    }
    public function getCountry($country_id){
        $this->db->select('*');
        $this->db->from('tbl_country');
        $this->db->where('id', $country_id);

        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0];
    }
    public function get_idea_notification(){
        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('tbl_question.questionType', 17);
        $this->db->where('idea_info.allows_online', 1);
        $this->db->join('idea_info', 'idea_info.question_id = tbl_question.id');

        $query = $this->db->get();
        
        return $result = count($query->result_array());
        //echo "<pre>";print_r($query->result_array());die();
    }
    public function update_question_notification($question_id){
        $data['admin_seen'] = 1;
        $this->db->where("id", $question_id);
        $update = $this->db->update('tbl_question', $data);
        return $update;
    }

    public function get_tutor_questions($tutor_id){
        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->join('idea_info', 'idea_info.question_id = tbl_question.id');
        $this->db->join('tbl_useraccount', 'tbl_question.user_id = tbl_useraccount.id');
        $this->db->where('tbl_question.user_id', $tutor_id);
        $this->db->where('tbl_question.questionType', 17);
        $this->db->where('idea_info.duplicate_question',1);
        // $this->db->where('idea_info.allows_online', 1);
        // $this->db->where('idea_info.duplicate_question', 1);

        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();die();
        return $result;

        // $this->db->select('tbl_useraccount.id');
        // $this->db->from('tbl_question');
        // $this->db->where('tbl_question.questionType', 17);
        // $this->db->where('idea_info.allows_online', 1);
        // $this->db->join('idea_info', 'idea_info.question_id = tbl_question.id');
        // $this->db->join('tbl_useraccount', 'tbl_question.user_id = tbl_useraccount.id');
    }

    public function get_first_question_ideas($question_id){
        $this->db->select('*');
        $this->db->from('question_ideas');
        $this->db->where('question_ideas.question_id', $question_id);
        $this->db->order_by('serial','asc');

        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function student_idea_details($question_id,$idea_id,$student_id,$module_id){
        $this->db->select('*, question_ideas.id as idea_id');
        $this->db->from('question_ideas');
        $this->db->join('idea_info', 'question_ideas.question_id = idea_info.question_id', 'LEFT');
        $this->db->join('profile', 'profile.user_id = question_ideas.user_id', 'LEFT');
        $this->db->join('tbl_useraccount', 'tbl_useraccount.id = question_ideas.user_id', 'LEFT');
        $this->db->join('tbl_country', 'tbl_useraccount.country_id = tbl_country.id', 'LEFT');
        $this->db->where('question_ideas.id', $idea_id);
        $this->db->where('question_ideas.user_id', $student_id);
        // $this->db->where('idea_student_ans.question_id', $question_id);
        // $this->db->where('idea_student_ans.module_id', $module_id);
 
        $query = $this->db->get();
        return $result = $query->result_array();
    }
    public function check_admin_remake_idea_info(){

    }
    
} 
