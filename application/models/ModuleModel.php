<?php

class ModuleModel extends CI_Model
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
        return $query->result_array();
    }
	
	public function insertNewQus($table, $colName, $colValue, $studentGrade,$subject,$chapter)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);
        $query = $this->db->get()->row();

        $data['questionType'] = $query->questionType;
        $data['chapter'] = $chapter;
        $data['country'] = $query->country;
        $data['subject'] = $subject;
        // $data['studentgrade'] = $query->studentgrade;
        $data['questionName'] = $query->questionName;
        $data['answer'] = $query->answer;
        $data['question_instruction'] = $query->question_instruction;
        $data['questionTime'] = $query->questionTime;
        $data['questionMarks'] = $query->questionMarks;
        $data['questionDescription'] = $query->questionDescription;
        $data['question_solution'] = $query->question_solution;
        $data['isCalculator'] = $query->isCalculator;
        $data['user_id'] = $query->user_id;
        $data['dictionary_item'] = $query->dictionary_item;
        $data['word_approved'] = $query->word_approved;
        $data['updated_at'] = $query->updated_at;
        $data['created'] = $query->created;
        $data['last_id'] = $query->last_id;
        $data['question_name_type'] = $query->question_name_type;
        $data['studentgrade'] = $studentGrade;

        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();

        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $insert_id);
        $query_new = $this->db->get();

        //echo '<pre>';print_r($query_new->result_array());die();
        return $query_new->result_array();
    }
	
    public function getRow($table, $colName, $colValue)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);

        $query = $this->db->get();
        return $query->row_array();
    }

    public function moduleName($moduleId)
    {
        $res = $this->db
            ->select('moduleName')
            ->where('id', $moduleId)
            ->get('tbl_module')
            ->result_array();

        return isset($res[0]['moduleName']) ? $res[0]['moduleName'] : '';
    }//end moduleName()


    /**
     * Return module type name by a module Id
     *
     * @param integer $moduleTypeId module type id
     *
     * @return string  module type name
     */
    public function moduleTypeName($moduleTypeId)
    {
        $res = $this->db
            ->select('module_type')
            ->where('id', $moduleTypeId)
            ->get('tbl_moduletype')
            ->result_array();

        return isset($res[0]['module_type']) ? $res[0]['module_type'] : '';
    }//end moduleTypeName()


    /**
     * Return all module type
     *
     * @return array          all module type
     */
    public function allModuleType()
    {
        return $this->db
            ->select('*')
            ->get('tbl_moduletype')
            ->result_array();
    }//end allModuleType()

    
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
    

    /**
     * Insert batch operation will record multiple data at a time.
     *
     * @param string $tableName table name
     * @param array  $data      $arr = [ 0=>[1,2,3], 1=[1,2,3] ]
     *
     * @return mixed            insert id or null if failed to insert
     */
    public function insert($tableName, $data)
    {
        $res = $this->db->insert_batch($tableName, $data);

        return $res ? $this->db->insert_id() : null;
    }


    /**
     * This function will delete module info
     * and attached question from module question pivot table.
     *
     * @param  integer $moduleId module id to perform delete
     * @return bool           delete success/failed
     */
    public function delete($moduleId)
    {
        $this->db
            ->where('id', $moduleId)
            ->delete('tbl_module');

        $this->db
            ->where('module_id', $moduleId)
            ->delete('tbl_modulequestion');

        return 1;
    }

    /**
     * Delete module question from module question table.
     *
     * @param  integer $moduleId module id
     * @return void
     */
    public function deleteModuleQuestion($moduleId)
    {
        $this->db
            ->where('module_id', $moduleId)
            ->delete('tbl_modulequestion');
    }

    /**
     * Update multiple column with desired value
     *
     * @param string $tableName    table to get affect
     * @param string $selector     selector column on which where condition will apply
     * @param string $value        selected column value
     * @param array  $dataToUpdate array of data to update
     *                             ex:[  0=>['column_name'=>value],
     *                             1=['abc'=>'def']
     *                             ]
     *
     * @return null
     */
    public function update($tableName, $dataToUpdate, $selector)
    {
        //$dataToUpdate['updated_at'] = date("Y-m-d H:i:s");

        $this->db
            ->update_batch($tableName, $dataToUpdate, $selector);
    }//end update()


    /**
     * Get module Info
     *
     * @param integer $moduleId module id
     *
     * @return array           module info
     */
    public function moduleInfo($moduleId)
    {
        $res = $this->db
            ->where('id', $moduleId)
            ->get('tbl_module')
            ->result_array();

        return isset($res[0])?$res[0]:[];
    }//end moduleInfo()

    /**
     * Get all question ids,orderings,types of a module.
     *
     * @param integer $moduleId module id
     *
     * @return array   module question ids and orders
     */
    public function moduleQuestion($moduleId)
    {
        $res = $this->db
            ->where('module_id', $moduleId)
            ->get('tbl_modulequestion')
            ->result_array();

        return $res;
    }
    
    public function moduleQuestionOrder($moduleId)
    {
        $res = $this->db
            ->where('module_id', $moduleId)
            ->order_by('question_order','ASC')
            ->get('tbl_modulequestion')
            ->result_array();

        return $res;
    }


     /**
      * Get all module for a loggedUser(without parent and student user).
      *
      * @return array all module of a user
      */
      public function allModule($conditions = [] , $country_id='')
      {

          $loggedUserId = $this->session->userdata('user_id');
          $this->db
              //->select('tbl_module.*, tbl_subject.subject_name as subject_name, tbl_chapter.chapterName as chapterName')
              ->select('tbl_module.*, tbl_subject.subject_name as subject_name, tbl_chapter.chapterName as chapterName, tbl_useraccount.name creatorName, tbl_moduletype.module_type module_type')
              ->join('tbl_subject', 'tbl_subject.subject_id=tbl_module.subject', 'left')
              ->join('tbl_useraccount', 'tbl_module.user_id=tbl_useraccount.id', 'left')
              ->join('tbl_chapter', 'tbl_chapter.id=tbl_module.chapter', 'left')
              ->join('tbl_moduletype', 'tbl_module.moduleType=tbl_moduletype.id', 'left');
              $this->db->where('tbl_module.show_student', 1);
          if (count($conditions)) {
              $this->db->where($conditions);
          } else {
              $this->db->where('user_id', $loggedUserId);
          }
  
          if ($country_id !='') {
            if ($country_id == 1) {
              $this->db->where('tbl_module.country', $country_id);
            }else{
                $this->db->where_in('tbl_module.country', [$country_id,'1']);
            }
          }
          
          if (isset($conditions['moduleType'])) {
              if ($conditions['moduleType'] == 3 || $conditions['moduleType'] == 4) {
                  $sub_q = $this->db->query("SELECT module_id FROM tbl_student_answer")->result_array();
                 
                  if (!empty($sub_q)) {
                      $this->db->where_not_in('tbl_module.id', array_column($sub_q, 'module_id'));
                  }
              }
          }
          
        // $this->db->order_by('tbl_subject.order', 'ASC');
        // $this->db->order_by('tbl_module.ordering', 'ASC');

        $this->db->order_by('tbl_module.moduleType','asc');
        $this->db->order_by('tbl_module.subject','asc');
        $this->db->order_by('tbl_module.studentGrade','asc');
        $this->db->order_by('LENGTH(tbl_module.moduleName)');
        $this->db->order_by('tbl_module.moduleName','asc');
        

        // $this->db->order_by('tbl_module.id', 'ASC');
          
          $res = $this->db->get('tbl_module') ->result_array();
        //    echo '<pre>';print_r($res);die;
          return $res;
      } // end allModule()
    
    public function getStudentByGradeCountry($student_grade, $country_id, $user_id)
    {
        $this->db->select('tbl_useraccount.*,tbl_enrollment.sct_id,sct_type,st_id');
        $this->db->from('tbl_useraccount');
        
        $this->db->join('tbl_enrollment', 'tbl_useraccount.id = tbl_enrollment.st_id', 'LEFT');
        
        $this->db->where('tbl_useraccount.student_grade', $student_grade);
        $this->db->where('tbl_useraccount.country_id', $country_id);
        $this->db->where('tbl_enrollment.sct_id', $user_id);

        $query = $this->db->get();
               // echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function getIndividualStudent($student_grade, $tutor_type, $country_id, $subject_name, $user_id, $course_id)
    {
        /*echo 'two';
        print_r(strip_tags(trim(htmlspecialchars($subject_name, ENT_QUOTES))));
        die;*/
        $this->db->select('tbl_useraccount.*');
        $this->db->from('tbl_useraccount');
        
        if ($tutor_type == 3) {
            $this->db->join('tbl_enrollment', 'tbl_useraccount.id = tbl_enrollment.st_id', 'LEFT');
            $this->db->where('tbl_enrollment.sct_id', $user_id);
        }
        if ($tutor_type == 7 && $course_id != '') {
            $this->db->join('tbl_registered_course', 'tbl_useraccount.id = tbl_registered_course.user_id', 'LEFT');
            $this->db->join('tbl_course', 'tbl_registered_course.course_id = tbl_course.id', 'LEFT');
            $this->db->join('tbl_subject', 'tbl_course.courseName = tbl_subject.subject_name', 'LEFT');
            // $this->db->where('tbl_course.courseName', strip_tags(trim(html_entity_decode($subject_name, ENT_QUOTES))));
            $this->db->where('tbl_course.id', $course_id);
        }
        
        $this->db->where('tbl_useraccount.student_grade', $student_grade);
        if ($country_id != '') {
            $this->db->where('tbl_useraccount.country_id', $country_id);
        }
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    public function tutor_infos($question_id, $orders) {

      $this->db->select('*');
      $this->db->from('for_tutorial_tbl_question');
      $this->db->where('tbl_ques_id', $question_id); 
      $this->db->where('orders', $orders);
      $this->db->limit(1);
      $query = $this->db->get()->result();
        
        return $query;
    }
    public function module_instruction_update($moduleId , $data)
    {
        $this->db->where('id', $moduleId);
        $this->db->update('tbl_module', $data);
    }
	public function get_row($table,$condition)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    public function get_all_whereSErial($table, $module_id , $serial_num)
    {
        $this->db->from($table);
        $this->db->where('module_id', $module_id);
        $this->db->where('serial_num', $serial_num);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getInfoByOrder($table, $colName, $colValue)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName, $colValue);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function allModuleForAssign($id , $tyoe)
    {
      
      $this->db->from('tbl_module');
      $this->db->join('tbl_subject', 'tbl_subject.subject_id = tbl_module.subject');
      $this->db->join('tbl_chapter', 'tbl_module.chapter = tbl_chapter.id');
      
      $this->db->select('tbl_module.id , tbl_module.moduleName , tbl_module.moduleType , tbl_module.trackerName , tbl_module.individualName , tbl_module.exam_date , tbl_subject.subject_name , tbl_module.subject , tbl_chapter.chapterName , tbl_module.moduleName');

      if ($tyoe == "course_id") {
        $this->db->where('tbl_module.course_id', $id);
      }

      if ($tyoe == "module_id") {
        $this->db->where('tbl_module.id', $id);
      }
      
      $query = $this->db->get();
      return $query->result_array();

    }

    public function studentHomework($id , $module_type)
    {
      
      $this->db->from('student_homeworks');
      $this->db->group_by("assign_subject");
      $this->db->where('tutor_id', $id);
      $this->db->where('student_id', $this->session->userdata('user_id'));
      $this->db->where('module_type', $module_type);
      $this->db->where('status', 1);
      
      $query = $this->db->get();
      return $query->result_array();

    }

    public function studentAssignedModule($st_id , $tutor_id)
    {
      
      $this->db->from('student_homeworks');
      $this->db->where('tutor_id', $tutor_id);
      $this->db->where('student_id', $st_id);
      $this->db->where('status', 1);
      
      $query = $this->db->get();
      return $query->result_array();

    }

    public function studentAssignedModuleforUpdate($st_id , $tutor_id , $module_id)
    {
      
      $this->db->from('student_homeworks');
      $this->db->where('tutor_id', $tutor_id);
      $this->db->where('student_id', $st_id);
      $this->db->where('assign_module', $module_id);
      
      $query = $this->db->get();
      return $query->result_array();

    }

    public function studentHomeworkModules($subjectId , $tutorId , $student_id , $module_type )
    {
      $this->db->from('student_homeworks');
      $this->db->where('tutor_id', $tutorId);
      $this->db->where('assign_subject', $subjectId);
      $this->db->where('student_id', $student_id);
      $this->db->where('module_type', $module_type);
      $this->db->where('status', 1);
      
      $query = $this->db->get();
      return $query->result_array();

    }

    public function deleteAssignedModule($student_id , $tutorId )
    {
      $this->db->where('tutor_id', $tutorId);
      $this->db->where('student_id', $student_id);
      $this->db->delete('student_homeworks');
    }

    public function AssignModuleTutuorTutorial($tutorId  , $student_id , $moduleType )
    {
      $this->db->from('student_homeworks');
      $this->db->where('tutor_id', $tutorId);
      $this->db->where('student_id', $student_id);
      $this->db->where('module_type', $moduleType);
      $this->db->where('status', 1);
      $query = $this->db->get();
      return $query->result_array();
    }
	
	 public function AssignModuleSchoolTutuorTutorial($tutorId , $student_id , $moduleType )
    {	
      $this->db->where('user_id', $tutorId);
      $this->db->where('moduleType', $moduleType);
      $query = $this->db->get('tbl_module');
      return $query->result_array();
    }

    ///// shukriti

    public function get_module_type($tbl,$module_id)
    {	
      $this->db->where('id', $module_id);
      $query = $this->db->get($tbl);
      $data = $query->result_array();
      return $data;
    }
    public function tutorHomework($id , $module_type)
    {
      
      $this->db->from('student_homeworks');
      $this->db->group_by("assign_subject");
      $this->db->where('tutor_id', $id);
      $this->db->where('student_id', 754);
      $this->db->where('module_type', $module_type);
      $this->db->where('status', 1);
      
      $query = $this->db->get();
      return $query->result_array();

    }

    public function getModuleType(){
        $this->db->select('*');
        $this->db->from('tbl_moduletype');
        $query_new = $this->db->get();
        return $query_new->result_array();

    }

    public function getAllCourse($country_id){
        $this->db->select('*');
        $this->db->from('tbl_course');
        $this->db->where('country_id', $country_id);
        $query_new = $this->db->get();
        return $query_new->result_array();
    }

    public function getTblPreModuleTempCourse(){
        $this->db->select('*');
        $this->db->from('tbl_pre_module_temp');
        $this->db->order_by('question_order', 'ASC');
        $query_new = $this->db->get();
        return $query_new->result_array();
    }

    public function getMaxTblPreModuleTempCourse(){
        $this->db->select('MAX(question_order) as max_size');
        $this->db->from('tbl_pre_module_temp');
        $query_new = $this->db->get();
        return $query_new->row_array();
    }

    public function getTblQuestionType($questionType){
        $this->db->select('questionType');
        $this->db->from('tbl_questiontype');
        $this->db->where('id', $questionType);
        $query_new = $this->db->get();
        return $query_new->row_array();
    }

    public function getTblQuestion($questionId){
        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('id', $questionId);
        $query_new = $this->db->get();
        return $query_new->row_array();
    }

    public function getAllTblQuestion($questionId){
        // echo $questionId; die();
        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('questionType', $questionId);
        $query_new = $this->db->get();
        return $query_new->num_rows();
    }

    public function countTblNewModuleRows(){
        $country_id = $this->session->userdata('selCountry');
        $user_id = $this->session->userdata('user_id');

        $this->db->select('*,tbl_module.id as id');
        $this->db->from('tbl_module');
        $this->db->join('tbl_course', 'tbl_module.course_id=tbl_course.id', 'left');
        $this->db->join('tbl_subject', 'tbl_subject.subject_id=tbl_module.subject', 'left');
        $this->db->join('tbl_chapter', 'tbl_chapter.id=tbl_module.chapter', 'left');
        $this->db->where('tbl_module.country',$country_id);
        $this->db->where('tbl_module.user_id',$user_id);
        $query_new = $this->db->get();
        $result = $query_new->num_rows();
        return $result;
    }
    public function getTblNewModule($limit, $start){
        
        $country_id = $this->session->userdata('selCountry');
        $user_id = $this->session->userdata('user_id');

        $this->db->select('*,tbl_module.id as id');
        $this->db->from('tbl_module');
        $this->db->join('tbl_course', 'tbl_module.course_id=tbl_course.id', 'left');
        $this->db->join('tbl_subject', 'tbl_subject.subject_id=tbl_module.subject', 'left');
        $this->db->join('tbl_chapter', 'tbl_chapter.id=tbl_module.chapter', 'left');
        $this->db->where('tbl_module.country',$country_id);
        $this->db->where('tbl_module.user_id',$user_id);
        $this->db->limit($limit, $start);
        
        $this->db->order_by('moduleType','asc');
        $this->db->order_by('studentGrade','asc');
        $this->db->order_by('course_id','asc');
        $this->db->order_by('serial','asc');
        $query_new = $this->db->get();
        $result = $query_new->result_array();
        // echo $this->db->last_query();die();
        // echo "<pre>";print_r($result);die();
        return $result;
    }

    public function getTblModuleInfo($id){
        $this->db->select('*');
        $this->db->from('tbl_module');
        $this->db->where('id', $id);
        $query_new = $this->db->get();
        $result = $query_new->row_array(); 
        return $result;
    }

    public function moduleQuestionDuplicate($table, $data){
        $result = $this->db->insert($table, $data);
        return $result;
    }

    public function questionSorting($table, $colName, $colValue, $data){
        $this->db->where($colName, $colValue);
        $this->db->update($table, $data);
    }
    public function getCountryName($id){
        $this->db->select('*');
        $this->db->from('tbl_country');
        $this->db->where('id', $id);
        $query_new = $this->db->get();
        $result = $query_new->row_array();
        return $result;
    }
    public function getCourseName($id){
        $this->db->select('*');
        $this->db->from('tbl_course');
        $this->db->where('id', $id);
        $query_new = $this->db->get();
        $result = $query_new->row_array();
        return $result;
    }
    public function getTblNewModuleQuestion($moduleId, $new_module_id){
        $this->db->select('*');
        $this->db->from('tbl_modulequestion');
        $this->db->where('module_id', $moduleId);
        $query_new = $this->db->get();
        $results = $query_new->result_array();
        
        foreach($results as $result){
           $question_id = $result['question_id'];

            $this->db->select('*');
            $this->db->from('tbl_question');
            $this->db->where('id', $question_id);
            $query_new = $this->db->get();
            $question = $query_new->result_array();
            $data = $question[0];
            $data['id']= '';

            $this->db->insert('tbl_question', $data);
            $insert_id = $this->db->insert_id();

            $this->db->select('MAX(question_order) as max_size');
            $this->db->from('tbl_modulequestion');
            $this->db->where('module_id', $new_module_id);
            $query_new = $this->db->get();
            $max_order = $query_new->row_array();

            $data2['question_id'] = $insert_id;
            $data2['question_type'] = $data['questionType'];
            $data2['module_id'] = $new_module_id;
            $data2['question_order'] = $max_order['max_size'] + 1;
            
            $this->db->insert('tbl_modulequestion', $data2);

        }

        // $this->db->select('*');
        // $this->db->from('tbl_modulequestion');
        // $this->db->where('module_id', $new_module_id);
        // $query_new = $this->db->get();
        // $results2 = $query_new->result_array();
        // echo "<pre>";print_r($results2);die();
        return 1;
    }

    public function getTblNewModuleQuestionWithout($moduleId){
        $this->db->select('*');
        $this->db->from('tbl_modulequestion');
        $this->db->where('module_id', $moduleId);
        $query_new = $this->db->get();
        $result = $query_new->result_array();
        return $result;
    }

    public function getQuestions($question_type,$user_id,$country_id){
        
        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('questionType', $question_type);
        $this->db->where('user_id', $user_id);
        $this->db->where('country', $country_id);

        $query_new = $this->db->get();
        $result = $query_new->result_array();
        
        return $result;
    }

    public function getMaxTblNewModuleQuestion($module_id){
        $this->db->select('MAX(question_order) as max_size');
        $this->db->from('tbl_modulequestion');
        $this->db->where('module_id', $module_id);
        $query_new = $this->db->get();
        return $query_new->row_array();
    }
    public function getMaxTblNewModuleQuestionEdit($module_id){
        $this->db->select('MAX(question_order) as max_size');
        $this->db->from('tbl_edit_module_temp');
        $this->db->where('module_id', $module_id);
        $query_new = $this->db->get();
        return $query_new->row_array();
    }

    public function deleteTblNewModule($module_id){
        $this->db->where('id', $module_id);
        $this->db->delete('tbl_module');
    }

    public function deleteTblNewModuleQuestion($module_id){
        $this->db->where('module_id', $module_id);
        $this->db->delete('tbl_modulequestion');
    }



    public function getEditModuleInfo($module_id){
        $this->db->select('*');
        $this->db->from('tbl_edit_module_temp');
        $this->db->where('module_id', $module_id);
        $query_new = $this->db->get();
        $result = $query_new->result_array();

        if(empty($result)){
            $this->db->select('*');
            $this->db->from('tbl_modulequestion');
            $this->db->where('module_id', $module_id);
            $query_new = $this->db->get();
            $results = $query_new->result_array();

            $this->db->truncate('tbl_edit_module_temp');
            foreach($results as $mod){
                $country_id = $this->session->userdata('selCountry');
                $data['module_id'] = $mod['module_id'];
                $data['question_id'] = $mod['question_id'];
                $data['question_type'] = $mod['question_type'];
                $data['question_order'] = $mod['question_order'];
                $data['country'] = $country_id;

                $this->db->insert('tbl_edit_module_temp', $data);
            }

                $this->db->select('*,tbl_edit_module_temp.id as tbl_id');
                $this->db->from('tbl_edit_module_temp');
                $this->db->join('tbl_questiontype', 'tbl_edit_module_temp.question_type=tbl_questiontype.id', 'left');
                $this->db->order_by('tbl_edit_module_temp.question_order', 'ASC');
                $query_new = $this->db->get();
                $results = $query_new->result_array();
                return $results;
        }else{

            $this->db->select('*,tbl_edit_module_temp.id as tbl_id');
            $this->db->from('tbl_edit_module_temp');
            $this->db->join('tbl_questiontype', 'tbl_edit_module_temp.question_type=tbl_questiontype.id', 'left');
            $this->db->order_by('tbl_edit_module_temp.question_order', 'ASC');
            $query_new = $this->db->get();
            $results = $query_new->result_array();
            return $results; 
        } 
        
    }
    public function newModuleInfo($moduleId)
    {
        $res = $this->db
            ->where('id', $moduleId)
            ->get('tbl_module')
            ->result_array();

        return isset($res[0])?$res[0]:[];
    }//end moduleInfo()
    public function getEditPreModuleTemp($module_id){
        $this->db->select('*');
        $this->db->from('tbl_edit_module_temp');
        $this->db->where('module_id', $module_id);
        $this->db->order_by('question_order', 'ASC');
        $query_new = $this->db->get();
        return $query_new->result_array();
    }

    public function getDuplicateQuestion($question_id){
        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('id', $question_id);
        $query_new = $this->db->get();
        $result = $query_new->result_array();
        
        $data= $result[0];
        $data['id']= '';
        $this->db->insert('tbl_question', $data);

        $insert_id = $this->db->insert_id();

        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('id', $insert_id);
        $query_new = $this->db->get();
        $result = $query_new->result_array();
        return $result[0];
    }

    public function duplicateQuestionCreate($question_id,$question_type){
        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('id', $question_id);
        $query_new = $this->db->get();
        $result = $query_new->result_array();
        
        $data= $result[0];
        $data['id']= '';
        $this->db->insert('tbl_question', $data);

        $insert_id = $this->db->insert_id();

        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('id', $insert_id);
        $query_new = $this->db->get();
        $result = $query_new->result_array();
        return $result[0];
    }

    public function getModuleMaxSerial($course_id,$moduleType,$studentGrade){
        $country_id = $this->session->userdata('selCountry');
        $loggedUserId = $this->session->userdata('user_id');
        $this->db->select('MAX(serial) as max_serial');
        $this->db->from('tbl_module');
        $this->db->where('moduleType', $moduleType);
        $this->db->where('studentGrade', $studentGrade);
        $this->db->where('course_id', $course_id);
        $this->db->where('user_id', $loggedUserId);
        $this->db->where('country', $country_id);
        $query_new = $this->db->get();
        // $result = $query_new->result_array();
        // echo "<pre>";print_r($result);die();
        // print_r($result);die();
        return $query_new->row_array();
    }

    public function get_module_serial($module_type, $grade, $course_id){
        $this->db->select('MAX(serial) as max_serial');
        $this->db->from('tbl_module');
        $this->db->where('moduleType', $module_type);
        $this->db->where('studentGrade', $grade);
        $this->db->where('course_id', $course_id);
        $query_new = $this->db->get();
        return $query_new->row_array();

    }

    public function updateModuleSerial($module_id,$grade,$module_type,$course_id){
        $this->db->select('*');
        $this->db->from('tbl_module');
        $this->db->where('module_id', $module_id);
        $this->db->where('studentGrade', $grade);
        $this->db->where('course_id', $course_id);
        $this->db->where('moduleType', $module_type);
        $query_new = $this->db->get();
        return $query_new->row_array();
    }

    public function getSubjectBycourse($course_id){
        $assign_course = $this->Student_model->getInfo('tbl_assign_subject', 'course_id',$course_id);
        $subjectId = json_decode($assign_course[0]['subject_id']);
        $subjects = array();
        foreach($subjectId as $value)
        {
            $sb =  $this->Student_model->getInfo('tbl_subject', 'subject_id',$value);
            if (!empty($sb))
            {
                $subjects[] = $sb[0];
            }
        }
        // echo"<pre>";print_r($subjects);die();
        return $subjects;
    }

    public function getChapterBycourse($subject){
        $this->db->where('subjectId', $subject);
        $chapters = $this->db->get('tbl_chapter')->result_array();
        return $chapters;
    }

    public function getAllSubjects($user_id){
        $this->db->select('*');
        $this->db->from('tbl_subject');
        $this->db->where('created_by', $user_id);
        $query_new = $this->db->get();
        $result = $query_new->result_array();
        return $result;
    }

    public function getAllChapters($user_id){
        $this->db->select('*');
        $this->db->from('tbl_chapter');
        $this->db->where('created_by', $user_id);
        $this->db->order_by('chapterName','asc');
        $this->db->order_by('LENGTH(chapterName)');
        $query_new = $this->db->get();
        $result = $query_new->result_array();
        //echo "<pre>";print_r($result);die();
        return $result;
    }

    public function getQuestionType(){
        $this->db->select('*');
        $this->db->from('tbl_questiontype');
        $query_new = $this->db->get();
        $result = $query_new->result_array();
        return $result;
    }

}//end class 
