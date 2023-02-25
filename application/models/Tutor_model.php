<?php

class Tutor_model extends CI_Model
{

    public function insertInfo($table, $data)
    {
        $this->db->insert($table, $data);
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
		if ($table == 'tbl_questiontype')
        {
            $this->db->order_by("tbl_questiontype.order_by", "asc");
        }
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
    
    
    //    Module Section
    public function userInfo($user_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        
        $this->db->join('tbl_country', 'tbl_useraccount.country_id = tbl_country.id', 'LEFT');
        $this->db->join('zone', 'UPPER(tbl_country.countryCode) = zone.country_code', 'LEFT');
        $this->db->join('additional_tutor_info', 'tbl_useraccount.id = additional_tutor_info.tutor_id', 'LEFT');
        $this->db->where('tbl_useraccount.id', $user_id);

        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getUserQuestion($table, $conditions)
    {
        $this->db->select('*');
        $this->db->from($table);
        
        $this->db->where($conditions);
        
        $query = $this->db->get();
		
        return $query->result_array();
    }


    /**
     * Get all students of a specific tutor/school/parent
     *
     * @param array $conditions [column_name=>value,...],
     *                          for tutor,qstudy etc:['sct_id'=>loggedUserId]
     *
     * @return array             studentIds ex:[1,2,3,4,5]
     */
    public function allStudents($conditions = [])
    {
        $loggedUserId   = $this->session->userdata('user_id');
        $loggedUserType = $this->session->userdata('userType');

        if ($loggedUserType == 1) {
            // parent
            $res = $this->db
                ->select('id as `st_id`')
                ->where('parent_id', $loggedUserId)
                ->get('tbl_useraccount')
                ->result_array();
        } elseif ($loggedUserType == 7) {
            //q-study
            /*$res = $this->db
                ->select('id st_id')
                ->where('user_type', 2) //upper level
                ->or_where('user_type', 6) // 1-12 grade (maybe)
                ->get('tbl_useraccount')
                ->result_array();*/
                $res = $this->studentBySubject($conditions);
        } else {
            // corporate/school/tutor
            $res = $this->db
                ->select('st_id')
                ->where($conditions)
                ->get('tbl_enrollment')
                ->result_array();
        }

        return array_column($res, 'st_id');
    }//end allStudents()

    /**
     * Get student for q-study
     * get by student grade, subject that match with the course name student enrolled
     * @param  array $conditions conditions array
     * @return array             student ids. ex: [1,2,3]
     */
    public function studentBySubject($conditions)
    {
        $this->db->select('tbl_useraccount.id');
        $this->db->join('tbl_registered_course', 'tbl_useraccount.id = tbl_registered_course.user_id', 'LEFT');
        $this->db->join('tbl_course', 'tbl_registered_course.course_id = tbl_course.id', 'LEFT');
        $this->db->join('tbl_subject', 'tbl_course.courseName = tbl_subject.subject_name', 'LEFT');
        
        if (isset($conditions['subject_name'])) {
            $this->db->where('tbl_course.courseName', $conditions['subject_name']);
        }
        if (isset($conditions['student_grade'])) {
            $this->db->where('tbl_useraccount.student_grade', $conditions['student_grade']);
        }
        if (isset($conditions['country_id'])) {
            $this->db->where('tbl_useraccount.country_id', $conditions['country_id']);
        }
        

        
        // if ($conditions['country_id'] != '') {
            // $this->db->where('tbl_useraccount.country_id', $conditions['country_id']);
        // }

        $query = $this->db
        ->get('tbl_useraccount')
        ->result_array();

        return $query;
    }

    /**
     * Return all module type
     *
     * @param  integer $tutorId tutor id
     * @return array          all module type
     */
    public function allModuleType()
    {
        $this->db->select('*');

        $res = $this->db->get('tbl_moduletype')->result_array();
        return $res;
    }//end allModuleType()
    
    public function getModuleQuestion($id, $question_order_id, $status)//id=>module_id
    {
        $this->db->select('*');
        $this->db->from('tbl_modulequestion');
        $this->db->join('tbl_module', 'tbl_modulequestion.module_id = tbl_module.id', 'LEFT');
        $this->db->join('tbl_moduletype', 'tbl_moduletype.id = tbl_module.moduleType', 'LEFT');
        $this->db->join('tbl_question', 'tbl_question.id = tbl_modulequestion.question_id', 'LEFT');
        $this->db->where('tbl_modulequestion.module_id', $id);
        
        if ($status == null) {
            $this->db->where('tbl_modulequestion.question_order', $question_order_id);
        } else {
            $this->db->order_by("question_order", "asc");
        }
        
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function getNewModuleQuestion($id, $question_order_id, $status)//id=>module_id
    {
        $this->db->select('*');
        $this->db->from('tbl_modulequestion');
        $this->db->join('tbl_module', 'tbl_modulequestion.module_id = tbl_module.id', 'LEFT');
        $this->db->join('tbl_moduletype', 'tbl_moduletype.id = tbl_module.moduleType', 'LEFT');
        $this->db->join('tbl_question', 'tbl_question.id = tbl_modulequestion.question_id', 'LEFT');
        $this->db->where('tbl_modulequestion.module_id', $id);
        
        if ($status == null) {
            $this->db->where('tbl_modulequestion.question_order', $question_order_id);
        } else {
            $this->db->order_by("question_order", "asc");
        }
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    //Question Section
    public function getQuestionInfo($type, $question_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_question');
        
        $this->db->where('questionType', $type);
        $this->db->where('id', $question_id);

        $query = $this->db->get();
        return $query->result_array();
    }

    
    /**
     * Tutor info from useraccount table and additional tutor info table
     *
     * @param array $searchParams search parameters
     *
     * @return array               tutor informations
     */
    public function tutorInfo_old($searchParams)
    {
        $userBySub = [];
        if (isset($searchParams['subject_name'])) {
            $temp = $this->db
                ->select('created_by')
                ->where('subject_name', $searchParams['subject_name'])
                ->get('tbl_subject')
                ->result_array();

            $userBySub = array_column($temp, 'created_by');
            unset($searchParams['subject_name']);
        }

        $this->db
            ->where($searchParams)
            ->join('additional_tutor_info', 'tbl_useraccount.id=additional_tutor_info.tutor_id', 'left');
        
        if (count($userBySub)) {
            $this->db->where_in('id', $userBySub);
        }
        return $this->db->get('tbl_useraccount')->result_array();
    }
	public function get_tutor_subject()
    {
        $this->db->select('*');
        $this->db->from('additional_tutor_info');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function tutorInfo($searchParams)
    {
        $this->db
            ->where($searchParams)
            ->join('additional_tutor_info', 'tbl_useraccount.id=additional_tutor_info.tutor_id', 'left');
        return $this->db->get('tbl_useraccount')->result_array();
    }

    /**
     * Get all unique values of a column
     *
     * @param string $tableName table name
     * @param string $column    column to fetch data
     *
     * @return array            all unique values
     */
    public function uniqueColVals($tableName, $column)
    {
        $res = $this->db
            ->select($column)
            ->distinct()
            ->get($tableName)
            ->result_array();

        return $res;
    }

    public function last_id()
    {

      $this->db->select('id');
      $this->db->from('tbl_question');
      $this->db->order_by("id", "desc");
      $this->db->where('questionType', 14);
      $this->db->limit(1); 

      $query = $this->db->get();
        
      return $query->result_array();
    }

    public function tutor_edit($type, $question_id)
    {

    $this->db->select('for_tutorial_tbl_question.*');
    $this->db->from('for_tutorial_tbl_question');
    $this->db->join('tbl_question', 'for_tutorial_tbl_question.tbl_ques_id = tbl_question.id', 'LEFT');
    $this->db->where('tbl_question.questionType', $type);
    $this->db->where('tbl_question.id', $question_id);

      $query = $this->db->get();
        
      return $query->result_array();
    }

    public function tutor_update($id)
    {
      $this->db->select('id');
      $this->db->from('tbl_question');
      $this->db->where('id', $id);


      $query = $this->db->get();
          
      return $query->result_array();
    }

    public function chk_value($questionType, $user_id)
    {
      $this->db->select('id, questionType');
      $this->db->from('tbl_question');
      $this->db->where('questionType', $questionType);
      $this->db->where('user_id', $user_id);
      $query = $this->db->get();
        
      return $query->result_array();
    }

    public function last_data($id)
    {
        $this->db->select("*");
        $this->db->from("tbl_question");
        $this->db->limit(1);
        $this->db->where('user_id',$id);
        $this->db->order_by('id',"DESC");
        $query = $this->db->get();
        
        return $query->result_array();
    }
    public function get_country($user_id)
    {
        $this->db->select('country_id');
        $this->db->from('tbl_useraccount');
        $this->db->where('id',$user_id);
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function getQuestionStore()
    {
        $this->db->select('tbl_questions_store.*,tbl_chapter.chapterName');
        $this->db->from('tbl_questions_store');
        
        $this->db->join('tbl_subject', 'tbl_questions_store.subject = tbl_subject.subject_id', 'LEFT');
        $this->db->join('tbl_chapter', 'tbl_questions_store.chapter = tbl_chapter.id', 'LEFT');
        $this->db->where('tbl_subject.created_by',2);
        $query = $this->db->get();
        
        return $query->result_array();
    }
	public function get_store_data($chapter_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_questions_store');
        $this->db->where('chapter',$chapter_id);
       $query =  $this->db->get();
       return $query->result_array();
    }
	public function deleteStoreChapter($id)
    {
       $stores  = $this->get_store_data($id);
       if(count($stores) > 0)
       {
        foreach($stores as $store)
           {
                $tutor_path     = FCPATH.$store['tutor_file'];
                $student_path   = FCPATH.$store['student_file'];
                if (file_exists($tutor_path)){
                    unlink($tutor_path);
                }
                if (file_exists($student_path)){
                    unlink($student_path);
                }  
           }
       }
        //delete all question store with this chapter
        $this->db
            ->where('chapter', $id)
            ->delete('tbl_questions_store');
        //delete chapter
        $this->db
            ->where('id', $id)
            ->delete('tbl_question_store_chapter');
    }
    public function deleteStoreSubject($id)
    {
        //get all chapters associated
        $chapters = $this->chaptersOfSubject($id);

        //delete all chapter associated
        foreach ($chapters as $chapter) {
            $this->deleteStoreChapter($chapter['id']);
        }

        //delete subject
        $this->db
            ->where('id', $id)
            ->delete('tbl_question_store_subject');
    }
    public function chaptersOfSubject($subjectId)
    {
     
        $this->db->where('subject_id', $subjectId);
        $res = $this->db
            ->get('tbl_question_store_chapter')
            ->result_array();

        return $res;
    }

    public function getInfo_Alstudent($table, $colName, $colValue)
    {
        $this->db->select('st_id');
        $this->db->from($table);
        $this->db->where($colName, $colValue);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getInfo_Alstudent_two($table, $colName, $data)
    {
        $this->db->select('id , user_email');
        $this->db->from($table);
        $this->db->where_in('id', $data);
        $this->db->where('user_type', 3);
        $this->db->or_where('user_type', 6);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getClassRooms()
    {
        $this->db->select('*');
        $this->db->from('tbl_available_rooms');
        $this->db->where('in_use', 0);
        $this->db->limit(1); 

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getClassRoomsCk($tutor_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_classrooms');
        $this->db->where('tutor_id', $tutor_id);
        $this->db->limit(1); 

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getInfo_subject($tbl_subject , $created_by , $user_id)
    {
        $this->db->select('*');
        $this->db->from($tbl_subject);
        $this->db->where('created_by', $user_id);
        $this->db->order_by('order', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ck_schl_corporate_exist($value)
    {
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        $this->db->where_in('user_type', [4,5] );
        $this->db->where('SCT_link', $value );
        $this->db->where('whiteboar_id !=', 0);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function ideainsertId($table, $data)
    {
        $this->db->insert($table, $data);

        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function idea_des_Id($table, $data)
    {
        $this->db->insert($table, $data);

        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function getMyStudents($user_id)
    {
        $this->db->select('tbl_useraccount.student_grade as student_grade,idea_student_ans.student_ans as student_ans');  
        $this->db->from('assigned_student');
        $this->db->join('tbl_useraccount', 'assigned_student.student_id = tbl_useraccount.id', 'LEFT');
        $this->db->join('idea_student_ans', 'idea_student_ans.student_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('assigned_student.examine_id', $user_id);
        $this->db->group_by('assigned_student.student_id');

        $query = $this->db->get();
        //echo $this->db->last_query();die();
        return $query->result_array();
       
    }
    public function grade_by_students($grade,$user_id){
        $this->db->select('*');
        $this->db->from('assigned_student');
        $this->db->join('tbl_useraccount', 'assigned_student.student_id = tbl_useraccount.id', 'LEFT');
        $this->db->join('question_ideas', 'question_ideas.user_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('assigned_student.examine_id', $user_id);
        $this->db->where('tbl_useraccount.student_grade', $grade);
        // $this->db->where('question_ideas.admin_seen',0);
        $this->db->group_by('assigned_student.student_id');

        $query = $this->db->get();
        return $query->result_array();
 
    }
    public function get_all_ideas($student_id){
        // $this->db->select('*');
        // $this->db->from('idea_student_ans');
        // $this->db->join('idea_info', 'idea_info.question_id = idea_student_ans.question_id', 'LEFT');
        // $this->db->where('idea_student_ans.student_id', $student_id);
        
        // $query = $this->db->get();
        // return $query->result_array();
        $this->db->select('*');
        $this->db->from('question_ideas');
        $this->db->join('idea_info', 'idea_info.question_id = question_ideas.question_id', 'LEFT');
        $this->db->where('question_ideas.user_id', $student_id);
        
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_student_ans($idea_id,$student_id,$question_id){
        $this->db->select('*, question_ideas.id as idea_id');
        $this->db->from('question_ideas');
        $this->db->join('idea_info', 'idea_info.question_id = question_ideas.question_id', 'LEFT');
        $this->db->where('question_ideas.user_id', $student_id);
        $this->db->where('question_ideas.question_id', $question_id);
        
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_student_info($student_id){
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        $this->db->where('id', $student_id);
        
        $query = $this->db->get();
        return $query->result_array();

    }
    public function getTutorIdeaCheckId($table,$data){
        
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
    public function get_teacher_workout($checkout_id){
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
    public function idea_correction_report_save($table,$data){
        
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
            $data2['by_admin_or_tutor']=2;
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
            
            $data2['teacher_correction']=$check->id;
            $data2['by_admin_or_tutor']=2;
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
    public function tutor_idea_save($table, $data)
    {
        $this->db->insert($table, $data);

        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function getIdeaInfoByQuestion($question_id){
   
        $this->db->select('*, idea_info.question_id as question_id, tbl_question.created_at as created_at, question_ideas.approval as idea_approval');
        $this->db->from('tbl_question');
        $this->db->join('idea_info', 'tbl_question.id = idea_info.question_id', 'LEFT');
        $this->db->join('question_ideas', 'question_ideas.question_id = idea_info.question_id', 'LEFT');
        $this->db->join('tbl_useraccount', 'tbl_question.user_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('idea_info.question_id', $question_id);
 
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();die();
        //echo "<pre>";print_r($result);die();
        return $result[0];
    }
    
    public function getIdeasByQuestion($question_id){
        $this->db->select('*');
        $this->db->from('idea_info'); 
        $this->db->where('question_id', $question_id);
        $query = $this->db->get();
        $question_info = $query->result_array();

        
        if($question_info[0]['duplicate_question']==2){
            $ques_id = $question_info[0]['parent_question_id'];
        }else{
            $ques_id = $question_id;
        }



        $this->db->select('*, question_ideas.id as id');
        $this->db->from('question_ideas'); 
        $this->db->join('tbl_useraccount', 'question_ideas.user_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('question_ideas.question_id', $ques_id);
        // $this->db->or_where('question_ideas.tutor_question_id', $question_id);
        $this->db->where('question_ideas.type', 1);
 
        $query = $this->db->get(); 
        $result = $query->result_array();
        return $result;
    }
    public function ideaUpdateId($table, $data, $question_id){
        $this->db->where('question_id', $question_id);
        $this->db->update($table, $data);


        $this->db->select('id');
        $this->db->from('idea_info');
        $this->db->where('question_id', $question_id);
        $query = $this->db->get();
        $result = $query->result_array();
        // print_r($result[0]);die();
        return $result[0]['id'];

    }

    public function getEditIdea($question_id, $idea_no){
        $this->db->select('*');
        $this->db->from('idea_description');
        $this->db->where('question_id', $question_id);
        $this->db->where('idea_no', $idea_no);
        $query = $this->db->get();
        $result = $query->result_array();
        // $result = $query->row_array();

        // echo $this->db->last_query(); die();

        // return $result;
        return $result[0];
    }

    public function getCountryId($user_id){
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        $result = $query->result_array();
        $country_id = $result[0]['country_id'];
        return $country_id;
    }

    public function student_idea_details($question_id,$idea_id,$student_id,$module_id){
        $this->db->select('*, question_ideas.id as idea_id');
        $this->db->from('question_ideas');
        $this->db->join('idea_info', 'question_ideas.id = idea_info.id', 'LEFT');
        $this->db->join('profile', 'profile.user_id = question_ideas.user_id', 'LEFT');
        $this->db->join('tbl_useraccount', 'tbl_useraccount.id = question_ideas.user_id', 'LEFT');
        $this->db->join('tbl_country', 'tbl_useraccount.country_id = tbl_country.id', 'LEFT');
        $this->db->where('question_ideas.id', $idea_id);
        $this->db->where('question_ideas.user_id', $student_id);
        $this->db->where('question_ideas.question_id', $question_id);
        $this->db->where('question_ideas.module_id', $module_id);
 
        $query = $this->db->get();
        return $result = $query->result_array();
    }
    public function getIQuestionCreator($question_id){
        $this->db->select('tbl_useraccount.name');
        $this->db->from('tbl_question');
        $this->db->join('tbl_useraccount', 'tbl_question.user_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('tbl_question.id', $question_id);

        $query = $this->db->get();
        return $result = $query->result_array(); 
    }
    public function get_question_new_ideas($user_id){
        $this->db->select('*');
        $this->db->from('idea_save_temp');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $result = $query->result_array();
    }
    
}
