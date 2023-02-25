<?php

class MessageModel extends CI_Model
{

    public $loggedUserId, $loggedUserType;
    function __construct()
    {
        parent::__construct();
        $this->loggedUserId   = $this->session->userdata('user_id');
        $this->loggedUserType = $this->session->userdata('userType');
    }
    
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

    public function deleteInfo($table, $colName, $colValue)
    {
        //echo $table . '+' .$colName.'+'.$colValue;//die;
        $this->db->where($colName, $colValue);
        $this->db->delete($table);
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

    public function getRow($table, $colName, $colValue)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);

        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Single row insert.
     *
     * @param string $tableName    table to insert data
     * @param array  $dataToInsert data
     *
     * @return integer             inserted item id
     */
    public function insert($tableName, $dataToInsert)
    {
        $this->db
            ->insert($tableName, $dataToInsert);

        return $this->db->insert_id();
    }

    /**
     * Get all message tpics
     *
     * @return array all topics
     */
    public function allTopics()
    {
        return $this->db
            ->where('creator_id', $_SESSION['user_id'])
            ->get('message_topics')
            ->result_array();
    }

    /**
     * Get info of a entry
     *
     * @param array $conditions condition for where clause
     *
     * @return array          faq info
     */
    public function info($tableName, $conditions)
    {
        $res = $this->db
            ->where($conditions)
            ->get($tableName)
            ->result_array();
        
        return count($res) ? $res[0] : [];
    }

    
    /**
     * Delete row/s from a table
     *
     * @param string $tableName  table name
     * @param array  $conditions ex:['id'=>1]
     *
     * @return int               affected rows
     */
    public function delete($tableName, $conditions)
    {
        $this->db
            ->where($conditions)
            ->delete($tableName);

            return $this->db->affected_rows();
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
    
    public function get_all_student_by_grade($student_grade)
    {
        $this->db->select('tbl_enrollment.*');
        $this->db->from('tbl_enrollment');
        
        $this->db->join('tbl_useraccount', 'tbl_enrollment.st_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('tbl_useraccount.student_grade', $student_grade);

        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function get_all_student_by_school($school_id)
    {
        $this->db->select('tbl_enrollment.*');
        $this->db->from('tbl_enrollment');
        
        $this->db->join('tbl_useraccount', 'tbl_enrollment.st_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('tbl_enrollment.sct_id', $school_id);

        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    /**
     * Get all message/notice to be sent today
     *
     * @return [type] [description]
     */
    public function messageForToday()
    {
//        return $this->db
//            ->select("messages.*,DATE_FORMAT(messages.schedule_date, '%Y-%m-%d') as schedule_date,message_topics.topic AS title")
//          ->join("message_topics","messages.topic = message_topics.id","LEFT")
//            ->where("DATE(schedule_date)=CURDATE()")
//            ->get('messages')
//            ->result_array();
        return $this->db
            ->select("messages.*,messages.schedule_date as schedule_date,message_schedule.schedule_date as notice_date, message_topics.topic AS title")
            ->join("message_topics", "messages.topic = message_topics.id", "LEFT")
            ->join("message_schedule", "messages.id = message_schedule.message_id", "LEFT")
            ->where("DATE(message_schedule.schedule_date)=CURDATE()")
            ->get('messages')
            ->result_array();
    }

    /**
     * Get all student and their parent email
     *
     * @param array $userIds all student ids ex: [1,2,3]
     *
     * @return array          parent student email address
     */
    public function allStudentEmail($userIds)
    {
        return $this->db
            ->select('student.user_email as student_email,student.user_type as type, parent.user_email as parent_email')
                
            ->join('tbl_useraccount as parent', 'student.parent_id = parent.id', 'left')
            ->where_in('student.id', $userIds)
                
            ->get('tbl_useraccount student')
            ->result_array();
    }
    
    public function getAllMessage($topic_id)
    {
        $this->db->select('*');
        $this->db->from('messages');
        
        $this->db->join('message_schedule', 'messages.id = message_schedule.message_id', 'LEFT');
        $this->db->where('messages.topic', $topic_id);

        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function get_message_by_topic($topic_id)
    {
        $this->db->select('messages.*,message_topics.topic AS topic_name');
        $this->db->from('messages');
        
        $this->db->join('message_topics', 'messages.topic = message_topics.id', 'LEFT');
        $this->db->where('messages.topic', $topic_id);

        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function message_info($message_id)
    {
        $this->db->select('messages.*,,message_topics.topic AS topic_name,message_schedule.*');
        $this->db->from('messages');
        
        $this->db->join('message_schedule', 'messages.id = message_schedule.message_id', 'LEFT');
        $this->db->join('message_topics', 'messages.topic = message_topics.id', 'LEFT');
        $this->db->where('messages.id', $message_id);

        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }
}
