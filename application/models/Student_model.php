<?php

class Student_model extends CI_Model
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
    
    public function studentEverydayProgree($user_id,$tutor_id){
        $tutorModule = $this->db
                    ->select('id')
                    ->where('user_id', $tutor_id)
                    ->get('tbl_module')
                    ->result_array();
        $tutorModule = array_column($tutorModule, 'id');
        $res = $this->db->where('student_id',$user_id)->where('date_time',date('Y-m-d'))->where_in('module', $tutorModule)->get('tbl_studentprogress')->num_rows();
        return $res;
        
    }

	public function studentProgressStd($conditions,$module_user_type='',$course_id ='')
    {
        $tutorType  = $_SESSION['userType'];
        $userId  = $_SESSION['user_id'];
        $tutorModule = $this->db
            ->select('id')
            ->where('user_id', $userId)
            ->get('tbl_module')
            ->result_array();
         $tutorModule = array_column($tutorModule, 'id');

         if ($module_user_type != '')
         {
             $student_module = $this->db
                 ->select('id')
                 ->where('user_type ', $module_user_type)
                 ->get('tbl_module')
                 ->result_array();
             $student_module = array_column($student_module, 'id');
         }
         if ($course_id != '')
         {
             $student_module = $this->db
                 ->select('id')
                 ->where('course_id ',$course_id)
                 ->get('tbl_module')
                 ->result_array();
             $student_module = array_column($student_module, 'id');
         }

        $res = $this->db
            ->where($conditions);
            //->where("module in (SELECT * from tbl_module where user_id = $userId)");
        if ($tutorType==7 ||$tutorType==3) {
            $res = $res->where_in('module', $tutorModule);
        }
        if ($tutorType==6 && !empty($student_module)) {
            $res = $res->where_in('module', $student_module);
        }
            $res= $res->order_by('answerTime', 'ASC')
            ->get('tbl_studentprogress')
            ->result_array();
        return $res;
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
        $this->db->where('tbl_useraccount.id', $user_id);

        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function module_info($module_id, $module_type, $student_grade)
    {
        $this->db->select('*');
        $this->db->from('tbl_module');

        $this->db->where('id', $module_id);
        $this->db->where('moduleType', $module_type);
        $this->db->where('studentGrade', $student_grade);
        
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function get_sct_enrollment_info($stId, $sctType)
    {
        $this->db->select('tbl_useraccount.*,tbl_enrollment.sct_id,tbl_enrollment.st_id');
        $this->db->from('tbl_useraccount');
        
        $this->db->join('tbl_enrollment', 'tbl_useraccount.id=tbl_enrollment.sct_id');
        $this->db->where('tbl_useraccount.user_type', $sctType);
        if ($sctType != 3) {
            $this->db->where('tbl_useraccount.parent_id', null);
        }
        $this->db->where('tbl_enrollment.st_id', $stId);
        
        return $this->db->get()->result_array();
    }
    
    public function getLinkInfo($table, $colName1, $colName2, $colValue1, $colValue2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName1, $colValue1);
        $this->db->where($colName2, $colValue2);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function delete_enrollment($userType, $user_id)
    {
        $this->db->where('sct_type', $userType);
        $this->db->where('st_id', $user_id);
        $this->db->delete('tbl_enrollment');
        return;
    }
    
    public function getStudentRefLink($stId)
    {
        $this->db->select('tbl_useraccount.*,tbl_enrollment.sct_id,tbl_enrollment.st_id');
        $this->db->from('tbl_useraccount');
        $this->db->join('tbl_enrollment', 'tbl_useraccount.id=tbl_enrollment.sct_id');
        $this->db->where('tbl_enrollment.st_id', $stId);
        return $this->db->get()->result_array();
    }

    public function studentProgress($conditions)
    {

        $tutorType  = $_SESSION['userType'];
        $userId  = $_SESSION['user_id'];
        $tutorModule = $this->db
            ->select('id')
            ->where('user_id', $userId)
            ->get('tbl_module')
            ->result_array();
         $tutorModule = array_column($tutorModule, 'id');
         
        $res = $this->db
            ->where($conditions);
            //->where("module in (SELECT * from tbl_module where user_id = $userId)");
        if ($tutorType==7 ||$tutorType==3) {
            $res = $res->where_in('module', $tutorModule);
        }
            $res= $res->order_by('answerTime', 'ASC')
            ->get('tbl_studentprogress')
            ->result_array();
        return $res;
    }

    public function studentByClass($class)
    {
        $res = $this->db
            ->where('student_grade', $class)
            ->get('tbl_useraccount')
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
     * Get all students of a specific tutor/school/corporate/parent.
     *
     * @param array $conditions [column_name=>value,...]
     *                          for tutor,qstudy etc:['sct_id'=>loggedUserId]
     *
     * @return array             studentIds ex:[1,2,3,4,5]
     */
    public function allStudents($sct_id, $country_id)
    {
        $loggedUserId = $this->session->userdata('user_id');
        $loggedUserType = $this->session->userdata('userType');
        
        if ($loggedUserType == 1) { //parent
            $res = $this->db
                ->select('id as `st_id`')
                ->where('parent_id', $loggedUserId)
                ->get('tbl_useraccount')
                ->result_array();
        } elseif ($loggedUserType == 7) { //q-stydy will get all students
            $this->db->select('id as `st_id`');
//            $this->db->where('user_type', 2); //upper student
            $this->db->where_in('user_type', array(2,6)); //upper student
//            $this->db->or_where('user_type', 6); //lower student
            if (isset($country_id) && $country_id != '') {
                $this->db->where('country_id', $country_id);
            }

            $query = $this->db->get('tbl_useraccount');
            $res = $query->result_array();
        } else { //corporate/school/tutor
            $this->db->select('st_id');
            $this->db->where('sct_id', $sct_id);
            
            $query = $this->db->get('tbl_enrollment');
            $res = $query->result_array();
        }
//        echo $this->db->last_query();
        return array_column($res, 'st_id');
    }
    
    //    public function all_module_by_type($tutorType, $module_type, $desired_result,$registered_course,$conditions)
    public function all_module_by_type($tutorType, $desired_result, $registered_course, $conditions)
    {
        $this->db->select('tbl_module.*,tbl_subject.subject_name,tbl_chapter.chapterName,tbl_useraccount.image');
        $this->db->from('tbl_module');
        
        $this->db->join('tbl_subject', 'tbl_module.subject = tbl_subject.subject_id', 'LEFT');
        $this->db->join('tbl_chapter', 'tbl_module.chapter = tbl_chapter.id', 'LEFT');
        $this->db->join('tbl_useraccount', 'tbl_useraccount.user_type = tbl_module.user_type', 'LEFT');
        
        if (count($conditions)) {
            $this->db->where($conditions);
        }
        
        $this->db->where_in('tbl_module.course_id', $registered_course);
//        Newly Added
        if ($desired_result != '') {
            $this->db->where('tbl_module.subject', $desired_result);
        }
      
        if ($tutorType == 7) {
            $this->db->where('tbl_useraccount.user_type', $tutorType);
        } else {
            $this->db->where('tbl_module.user_id', $tutorType);
        }
		
		// $this->db->order_by('tbl_module.exam_start', 'asc');
        $this->db->order_by('tbl_subject.order', 'ASC');
		$this->db->order_by('tbl_module.ordering', 'ASC');
      
        $query = $this->db->get();
		// echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function subjectInfo($tutorType)
    {
        $this->db->select('*');
        $this->db->from('tbl_subject');
        
        $this->db->join('tbl_useraccount', 'tbl_subject.created_by = tbl_useraccount.id', 'LEFT');
        
        $this->db->where('tbl_useraccount.user_type', $tutorType);
        
        $query = $this->db->get();
        //        echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function get_all_tutor_link($user_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_enrollment');
        
        $this->db->join('tbl_useraccount', 'tbl_enrollment.sct_id = tbl_useraccount.id', 'LEFT');
        
        $this->db->where('tbl_enrollment.st_id', $user_id);
        
        $query = $this->db->get();
        //        echo $this->db->last_query();
        return $query->result_array();
    }

    
    //unreleased(7-31-18)
    public function studentClass($studentId)
    {
        $res = $this->db->select('student_grade , country_id')
            ->where('id', $studentId)
            ->get('tbl_useraccount')
            ->result_array();


        // return isset($res[0]['student_grade']) ? $res[0]['student_grade']:0;
        return $res;
    }
    //unreleased(7-31-18)
    
    
    public function get_all_tutor_link_with_module($user_id, $module_type)
    {
        $this->db->select('tbl_enrollment.*,tbl_useraccount.name, tbl_module.id AS module_id,moduleName,trackerName,individualName,subject,chapter,country,tbl_subject.subject_name,tbl_chapter.chapterName');
        $this->db->from('tbl_enrollment');
        
        $this->db->join('tbl_useraccount', 'tbl_enrollment.sct_id = tbl_useraccount.id', 'LEFT');
        $this->db->join('tbl_module', 'tbl_useraccount.id = tbl_module.user_id', 'LEFT');
        $this->db->join('tbl_subject', 'tbl_module.subject = tbl_subject.subject_id', 'LEFT');
        $this->db->join('tbl_chapter', 'tbl_module.chapter = tbl_chapter.id', 'LEFT');
        
        $this->db->where('tbl_enrollment.st_id', $user_id);
        $this->db->where('tbl_module.moduleType', $module_type);
        
        $query = $this->db->get();
        //        echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function get_all_subject($user_type)
    {
        $this->db->select('subject_id');
        $this->db->from('tbl_course');
        
        $this->db->join('tbl_subject', 'tbl_subject.subject_name = tbl_course.courseName', 'LEFT');
        $this->db->join('tbl_useraccount', 'tbl_useraccount.id = tbl_subject.created_by', 'LEFT');

        $this->db->where('tbl_useraccount.user_type', $user_type);
        $this->db->distinct();
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function get_all_subject_for_registered_student($id)
    {
        $this->db->select('subject_id');
        $this->db->from('tbl_registered_course');
        
        $this->db->join('tbl_course', 'tbl_course.id = tbl_registered_course.course_id', 'LEFT');
        $this->db->join('tbl_subject', 'tbl_subject.subject_name = tbl_course.courseName', 'LEFT');

        $this->db->where('tbl_registered_course.user_id', $id);
        $this->db->distinct();
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }
    
    
    /**
     * Match student enrolled courses with subject table
     *
     * @param  integer $studentId logged student id
     * @return array              subjects info
     */
    public function studentSubjects($studentId)
    {
        $temp = $this->studentCourses($studentId);
//        $studentCourses = array_column($temp, 'courseName');
        $studentCourses = array_column($temp, 'id');
        if (!count($studentCourses)) {
            return [];
        }


        $res = $this->db
        ->join('tbl_subject', 'tbl_module.subject = tbl_subject.subject_id', 'LEFT')//Newly Added
        ->where_in('tbl_module.course_id', $studentCourses)
        ->get('tbl_module')
//        ->where_in('tbl_subject.subject_name', $studentCourses)
//        ->get('tbl_subject')
        ->result_array();
       
        return $res;
    }
    
    public function get_tutor_subject($tutor_id)
    {
        $res = $this->db
        ->join('tbl_subject', 'tbl_module.subject = tbl_subject.subject_id', 'LEFT')//Newly Added
        ->where('tbl_module.user_id', $tutor_id)
        ->order_by("tbl_subject.order", "asc")
        ->get('tbl_module')
//        ->where_in('tbl_subject.subject_name', $studentCourses)
//        ->get('tbl_subject')
        ->result_array();
//        echo $this->db->last_query();
        return $res;
    }

    /**
     * Student enrolled courses.
     *
     * @param  integer $studentId student id
     * @return array              all courses of a student
     */
    public function studentCourses($studentId)
    {
        $this->db->join('tbl_course', 'tbl_course.id = tbl_registered_course.course_id', 'left')
        ->where('user_id', $studentId)
        ->where('status', 1);
        $res = $this->db->get('tbl_registered_course')->result_array();
        return $res;
    }
    public function studentRegisterCourses($studentId,$subscription_type='')
    {
        $this->db->join('tbl_course', 'tbl_course.id = tbl_registered_course.course_id', 'left')
        ->where('user_id', $studentId)
        ->where('status', 1);
        if($subscription_type != 'trial'){
            $this->db->where('endTime >',time());
        }
        if($subscription_type != 'trial'){
            $this->db->where('cost <>',0);
        }
        $res = $this->db->get('tbl_registered_course')->result_array();

        return $res;
    }


    /**
     * Get chapters of a individual/multiple subject/s.
     *
     * @param  integer $subjectId subject id/s
     * @return array              chapters
     */
    public function chaptersOfSubject($subjectId)
    {
        
        if (count($subjectId)>1) {
            $this->db->where_in('subjectId', $subjectId);
        } else {
            $this->db->where('subjectId', $subjectId);
        }
        
        $res = $this->db
            ->get('tbl_chapter')
            ->result_array();

        return $res;
    }
    
    /**
     * Get all tutors info of a student
     *
     * @param  integer $studentId student id
     * @return array            tutor ids
     */
    public function allTutor($studentId)
    {
        return $this->db
            ->join('tbl_useraccount', 'tbl_useraccount.id=tbl_enrollment.sct_id', 'left')
            ->where('st_id', $studentId)
            ->get('tbl_enrollment')
            ->result_array();
    }
   
   
    //Cron Job Controller Section
    public function get_all_time_zone()
    {
        $this->db->select('*');
        $this->db->from('tbl_country');

        $this->db->join('zone', 'UPPER(tbl_country.countryCode) = zone.country_code', 'LEFT');
        
        $query = $this->db->get();
        //        echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function get_parent_with_children($country_id, $today_time)
    {
        $query = $this->db->query(
            'select parent.name AS parent_name,parent.id AS parentid,parent.user_mobile AS parent_mobile,countryCode,countryName,parent.country_id, child.id AS childid,child.name AS child_name,tbl_student_answer.created_at '
                . 'from tbl_useraccount child '
                . 'left join tbl_useraccount parent on child.parent_id = parent.id '
                . 'left join tbl_country on parent.country_id = tbl_country.id '
                . 'left join tbl_student_answer on child.id = tbl_student_answer.st_id '
            . 'WHERE parent.id = child.parent_id AND tbl_student_answer.`created_at` < "'.$today_time.'" AND parent.country_id = '.$country_id
        );
        
        return $query->result_array();
    }
    
    public function send_msg($parent_key, $today_time)
    {
        $this->db->select('*');
        $this->db->from('user_send_msg');

        $this->db->where('parent_id', $parent_key);
        $this->db->like('created_at', $today_time);
        
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function get_student_today_ans($childid, $today_time)
    {
        $this->db->select('*');
        $this->db->from('tbl_student_answer');

        $this->db->where('st_id', $childid);
        $this->db->like('created_at', $today_time);
        
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }
    
    // End Cronjob Controller Section
    
    public function country_code($countryCode)
    {
        $this->db->select('*');
        $this->db->from('zone');

        $this->db->where('country_code', $countryCode);
        
        $query = $this->db->get();
        //        echo $this->db->last_query();
        return $query->result_array();
    }
   
    public function getTutorialAnsInfo($table_name, $module_id, $std_id)
    {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('st_id', $std_id);
        $this->db->where('module_id', $module_id);
        
        $query = $this->db->get();
        //        echo $this->db->last_query();
        return $query->result_array();
    }

    public function getTutorialAnsInfo_delete($data, $module_id, $std_id)
    {
        $this->db->where('st_id', $std_id);
        $this->db->where('module_id', $module_id);
        $this->db->delete('tbl_st_error_ans');

        $this->db->insert_batch('tbl_st_error_ans', $data);

    }

    public function getTutorialAnsInfo_($table_name, $module_id, $std_id)
    {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('st_id', $std_id);
        $this->db->where('module_id', $module_id);
        $this->db->group_by('question_order_id');
        
        $query = $this->db->get();
        //        echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function update_st_error_ans($question_order_id, $module_id, $user_id)
    {
        $this->db->set('error_count', 'error_count+1', false);

        $this->db->where('st_id', $user_id);
        $this->db->where('module_id', $module_id);
        $this->db->where('question_order_id', $question_order_id);
        
        $this->db->update('tbl_st_error_ans');
        //        echo $this->db->last_query();
    }
    
    public function get_specific_error_ans($question_id, $question_order_id, $module_id, $user_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_st_error_ans');

        $this->db->where('st_id', $user_id);
        $this->db->where('module_id', $module_id);
        $this->db->where('question_id', $question_id);
        $this->db->where('question_order_id', $question_order_id);
        
        $query = $this->db->get();
        //        echo $this->db->last_query();
        return $query->result_array();
    }
   
    public function get_count_std_error_ans($question_order_id, $module_id, $user_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_st_error_ans');
        
        $this->db->where('st_id', $user_id);
        $this->db->where('module_id', $module_id);
        $this->db->where('question_order_id', $question_order_id);
        
        $query = $this->db->get();
        //        echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function delete_st_error_ans($question_order_id, $module_id, $user_id)
    {
        $this->db->where('st_id', $user_id);
        $this->db->where('module_id', $module_id);
        $this->db->where('question_order_id', $question_order_id);
        
        $this->db->delete('tbl_st_error_ans');
    }
    
    public function student_error_ans_info($std_id, $module_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_st_error_ans');

        $this->db->where('st_id', $std_id);
        $this->db->where('module_id', $module_id);
        
        $query = $this->db->get();
        //        echo $this->db->last_query();
        return $query->result_array();
    }
    public function delete_all_st_error_ans($module_id,$user_id)
    {
        $this->db->where('st_id', $user_id);
        $this->db->where('module_id', $module_id);
        $this->db->delete('tbl_st_error_ans');
    }
    public function get_std_error_ans($std_id, $modle_id, $question_order_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_st_error_ans');

        $this->db->join('tbl_modulequestion', 'tbl_modulequestion.question_id = tbl_st_error_ans.question_id', 'LEFT');
        
        $this->db->where('tbl_st_error_ans.st_id', $std_id);
        $this->db->where('tbl_modulequestion.question_order', $question_order_id);
        $this->db->where('tbl_modulequestion.module_id', $modle_id);
        
        $query = $this->db->get();
        //        echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function student_module_ans_info($std_id, $module_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_student_answer');

        $this->db->where('st_id', $std_id);
        $this->db->where('module_id', $module_id);
        
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function get_student_progress($user_id, $module)
    {
        $this->db->select('*');
        $this->db->from('tbl_studentprogress');

        $this->db->where('student_id', $user_id);
        $this->db->where('module', $module);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_answer_repeated_module($user_id, $module, $today)
    {
        $this->db->select('*');
        $this->db->from('tbl_answer_repeated_module');

        $this->db->where('std_id', $user_id);
        $this->db->where('repeat_module_id', $module);
        $this->db->where('answered_date', $today);
        
        $query = $this->db->get();
        return $query->result_array();
    }
   
   
    /**
     * Get all tutuor of a student by a module type
     *
     * @param  integer $moduleType          ex:1,2,3,4//tutorial,everyday study etc
     * @param  array   $loggedStudentsTutor array of tutor enrolled by a student
     * @return array                      tutor list
     */
    public function allTutorByModuleType($moduleType, $loggedStudentsTutor)
    {
        $res = $this->db
            -> distinct()
            ->select('user_id, tbl_useraccount.name tutorName')
            ->join('tbl_useraccount', 'tbl_useraccount.id=tbl_module.user_id', 'left')
            ->where('moduleType', $moduleType)
            ->where_in('user_id', $loggedStudentsTutor)
            ->get('tbl_module')
            ->result_array();
       
        return $res;
    }
    
    //Get All assigners. Q-study, enrolled tutor, schools and corporate
    public function all_assigners($loggedStudentId)
    {
        return $this->db->query(
            "SELECT * FROM `tbl_useraccount` "
                . "WHERE user_type = 7 OR "
                . "id IN (SELECT sct_id FROM tbl_enrollment WHERE st_id = $loggedStudentId) AND "
            . "`tbl_useraccount`.parent_id IS NULL AND user_type != 1"
        )->result_array();
    }

    public function all_assigners_new($loggedStudentId)
    {
        return $this->db->query(
            "SELECT * FROM `tbl_useraccount` "
                . "WHERE user_type = 7 OR "
                . "id IN (SELECT sct_id FROM tbl_enrollment WHERE st_id = $loggedStudentId) AND user_type = 3"
        )->result_array();
    }
    
    public function getSmsApiKeySettings()
    {
        $this->db->select('*');
        $this->db->from('tbl_setting');
        $this->db->where('setting_type', 'sms_api_settings');

        $query_result = $this->db->get();
        return $query_result->result_array();
    }

    public function get_sms_response_after_module()
    {
        $this->db->select('*');
        $this->db->from('tbl_setting');
        $this->db->where('setting_type', 'sms_message_settings');
        $this->db->where('setting_key', 'send_sms_after_module_ans');

        $query_result = $this->db->get();
        return $query_result->result_array();
    }
    
    public function get_sms_response_after_9pm()
    {
        $this->db->select('*');
        $this->db->from('tbl_setting');
        $this->db->where('setting_type', 'sms_message_settings');
        $this->db->where('setting_key', '9_pm_Sms');

        $query_result = $this->db->get();
        return $query_result->result_array();
    }
    
    public function get_today_dialogue($today_date)
    {
        $this->db->select('*');
        $this->db->from('dialogue');
        $this->db->where('date_to_show', $today_date);

        $query_result = $this->db->get();
        return $query_result->result_array();
    }
    
    public function get_whole_year_dialogue($year)
    {
        $this->db->select('*');
        $this->db->from('dialogue');
        $this->db->where('show_whole_year', $year);
        
        $this->db->limit(1);

        $query_result = $this->db->get();
        return $query_result->result_array();
    }
	public function getAutoRepeatData($id='',$not_equal='')
    {
        $this->db->select('*');
        $this->db->from('dialogue');
        if ($not_equal != '')
        {
            $this->db->where('id >',$id);
            $this->db->where('auto_repeat',1);
        }
        if ($id != '' && $not_equal ==''){
            $this->db->where('id',$id);
        }
        $this->db->order_by("id", "asc");
        $this->db->limit(1);
        $query_result = $this->db->get();
        return $query_result->result_array();
    }
	public function getLogId($date ='')
    {
        $this->db->select('*');
        $this->db->from('tbl_auto_repeat_log');
        if ($date != '')
        {
            $this->db->where('seen_date',$date);
        }
        $query_result = $this->db->get();
        return $query_result->result_array();
    }
	public function get_auto_repeat_dialogue()
    {
        $date = date('m-d-y');
        $getLogId = $this->getLogId($date);
        if (!empty($getLogId))
        {
            $id = $getLogId[0]['dia_Id'];
            $dialogue = $this->getAutoRepeatData($id);
            return $dialogue;

        }else{

            $getLogId = $getLogId = $this->getLogId();
            $id = $getLogId[0]['dia_Id'];

            $dialogue = $this->getAutoRepeatData($id,$not_equal=$id);
            if (!empty($dialogue))
            {
                $id = $dialogue[0]['id'];
                $data['dia_Id']=$id;
                $data['seen_date']=$date;
                $this->db->where('id',1);
                $result = $this->db->update('tbl_auto_repeat_log',$data);
                return $dialogue;
            }else
            {
                $dialogue = $this->getAutoRepeatData();
                $id = $dialogue[0]['id'];
                $data['dia_Id']=$id;
                $data['seen_date']=$date;
                $this->db->where('id',1);
                $result = $this->db->update('tbl_auto_repeat_log',$data);
                return $dialogue;
            }
        }
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

    public function delete($tableName, $conditions)
    {
        return $res = $this->db
            ->where($conditions)
            ->delete($tableName);
    }
	public function registeredCourse($user_id)
    {
        $this->db->select('tbl_registered_course.user_id,tbl_course.*');
        $this->db->from('tbl_registered_course');
        $this->db->join('tbl_course','tbl_course.id = tbl_registered_course.course_id');
        $this->db->where('user_id',$user_id);
        $this->db->where('endTime >',time());
        $this->db->where('status',1);
        $query = $this->db->get();
        return $query->result_array();
    }
	public function registeredCourseStatusUpdate($user_id)
    {
        $this->db->where('user_id',$user_id);
        $this->db->where('endTime <',time());
        $query = $this->db->update('tbl_registered_course',['status'=>0]);
        return $query;
    }

    public function payment_list_Courses($user_id)
    {
        $this->db->select('tbl_registered_course.user_id,tbl_course.*');
        $this->db->from('tbl_registered_course');
        $this->db->join('tbl_course','tbl_course.id = tbl_registered_course.course_id');
        $this->db->where('user_id',$user_id);
        $this->db->where('status',1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function paymentCourse($payment_id)
    {
        $this->db->select('tbl_payment_details.id,tbl_course.*');
        $this->db->from('tbl_payment_details');
        $this->db->join('tbl_course','tbl_course.id = tbl_payment_details.courseId');
        $this->db->where('paymentId',$payment_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ck_module_date($tableName, $module_id)
    {
        $this->db->select('repetition_days');
        $this->db->from('tbl_module');
        $this->db->where('id', $module_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_organizing($tbl , $user_id)
    {
        $this->db->select('sct_type');
        $this->db->from($tbl);
        $this->db->join('tbl_useraccount', ''.$tbl.'.sct_id = tbl_useraccount.id');
        $this->db->where(''.$tbl.'.sct_type = tbl_useraccount.user_type');
        $this->db->where('st_id', $user_id);
        $this->db->group_by("sct_type");
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_subs_data($date, $type)
    {
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        $this->db->where('end_subscription', $date);
        $this->db->where('subscription_type', $type);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_trail_data( $type)
    {
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        $this->db->where('subscription_type', $type);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_tmp_module_tbl($table, $colName, $colValue, $colName_two, $colValue_two, $data)
    {
        $this->db->where($colName, $colValue);
        $this->db->where($colName_two, $colValue_two);
        $this->db->update($table, $data);
    }

    public function get_all_where_two_col($select, $table, $columnName, $columnValue , $colNameTwo , $colValueTwo)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($columnName, $columnValue);
        $this->db->where($colNameTwo, $colValueTwo);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function deleteInfo_mod_ques_2($user_id, $module_id)
    {
        $this->db->where('st_id', $user_id);
        $this->db->where("module_id", $module_id);
        $this->db->delete("tbl_temp_tutorial_mod_ques_two");
    }

    public function get_all_where_two($select, $table, $columnName, $columnValue , $std_id)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($columnName, $columnValue);
        $this->db->where('st_id', $std_id);

        $query = $this->db->get();
        return $query->result_array();
    }
	public function getQuestionStore($condition)
    {
        $this->db->select('*');
        $this->db->from('tbl_questions_store');
        $this->db->where($condition);
        $this->db->order_by('pdf_order', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getQuestionStoreOrder($condition)
    {
        $this->db->select('*');
        $this->db->from('tbl_questions_store');
        $this->db->where($condition);
        $this->db->order_by('pdf_order', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
	 public function get_register_courses($std)
    {
        $this->db->select('tbl_course.*');
        $this->db->from('tbl_registered_course');
        $this->db->join('tbl_course','tbl_course.id = tbl_registered_course.course_id');
        $this->db->where_in('user_id',$std);
        $this->db->group_by("course_id");
        $query = $this->db->get();
        return $query->result_array();
    }
	public function TutorStudentProgressStd($conditions,$module_user_type='',$course_id ='')
    {

        
         if ($module_user_type != '')
         {
             $student_module = $this->db
                 ->select('id')
                 ->where('user_type ', $module_user_type)
                 ->get('tbl_module')
                 ->result_array();
             $student_module = array_column($student_module, 'id');
         }

         if ($course_id != '')
         {
             $student_module = $this->db
                 ->select('id')
                 ->where('course_id ',$course_id)
                 ->get('tbl_module')
                 ->result_array();
             $student_module = array_column($student_module, 'id');
         }

        $res = $this->db
            ->where($conditions);
            //->where("module in (SELECT * from tbl_module where user_id = $userId)");
        
        if (!empty($student_module)) {
            $res = $res->where_in('module', $student_module);
        }
            $res= $res->order_by('answerTime', 'ASC')
            ->get('tbl_studentprogress')
            ->result_array();
        return $res;
    }

    public function getInfo_tutor($table , $col , $st_id )
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('st_id', $st_id);
        $this->db->where('sct_type', 3);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getInfo_subjects($table, $colName, $colValue)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where_in($colName, $colValue);
        $this->db->order_by("tbl_subject.order", "asc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ckSchoolCorporateExits($table, $colName , $SCT_link)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where_in('user_type', [4,5] );
        $this->db->where('SCT_link', $SCT_link);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function where_in($array , $tbl , $select )
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $this->db->where_in('id', $array);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllInfo_classRoom()
    {
        $this->db->select("*");
        $this->db->from("tbl_classrooms");
        $this->db->where('end_time <', time());

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getWhereThreewoCondition($table, $colName1, $colValue1, $colName2,  $colValue2 , $colName3, $colValue3 )
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colName1, $colValue1);
        $this->db->where($colName2, $colValue2);
        $this->db->where($colName3, $colValue3);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function repete_date_module_index_updaate($module_id, $data)
    {
        $this->db->set('repetition_days', $data);
        $this->db->where('id', $module_id);
        $this->db->update('tbl_module');
    }

    public function repete_date_module_index_ck($module_id, $user_id)
    {
        $this->db->from('tbl_student_repetation_day');
        $this->db->where('student_id', $user_id);
        $this->db->where('module_id', $module_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_profile_info($user_id)
    {
        $this->db->from('profile');
        $this->db->where('user_id', $user_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getQuestionMark($question_id)
    {
        $this->db->from('tbl_question');
        $this->db->join('idea_info', 'idea_info.question_id = tbl_question.id', 'LEFT');
        $this->db->where('tbl_question.id', $question_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    public function checkIdeaAns($module_id,$question_id,$user_id)
    {
        
        $this->db->from('question_ideas');
        $this->db->where('module_id', $module_id);
        $this->db->where('question_id', $question_id);
        $this->db->where('user_id', $user_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    public function checktutorIdeaAns($module_id,$question_id,$user_id)
    {
        $this->db->from('question_ideas');
        $this->db->where('module_id', $module_id);
        $this->db->where('question_id', $question_id);
        $this->db->where('tutor_id', $user_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getIdeaAnsId($user_type,$data)
    { 
        if($user_type==3){
            $this->db->insert('question_ideas', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }else{

        $this->db->insert('question_ideas', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
        
        }
    }
    public function get_student_ideas($question_id,$modle_id)
    {
       
        // $this->db->from('idea_student_ans');
        // $this->db->where('module_id', $modle_id);
        // $this->db->where('question_id', $question_id);
        
        // $query = $this->db->get();
        // return $query->result_array();
        $this->db->select('*');
        $this->db->from('question_ideas');
        $this->db->where('tutor_question_id', $question_id);
        $query = $this->db->get();
        $result = $query->result_array();

        if(!empty($result)){
            $this->db->select('*');
            $this->db->from('question_ideas');
            $this->db->where('type',2);
            $this->db->where('question_id', $result[0]['question_id']);
            
            $query = $this->db->get();
            return $query->result_array();
        }else{
            $this->db->select('*');
            $this->db->from('question_ideas');
            $this->db->where('type',2);
            $this->db->where('question_id', $question_id);
            
            $query = $this->db->get();
            return $query->result_array();
        }
        
    }
    public function get_tutor_ideas($question_id,$modle_id)
    {
      
        // $this->db->from('idea_tutor_ans');
        // $this->db->where('question_id', $question_id);
        
        // $query = $this->db->get();
        // // echo $this->db->last_query();
        // // die();
        // return  $query->result_array();
        $this->db->select('*');
        $this->db->from('question_ideas');
        $this->db->where('tutor_question_id', $question_id);
        $query = $this->db->get();
        $result = $query->result_array();

        if(!empty($result)){
            $this->db->select('*');
            $this->db->from('question_ideas');
            $this->db->where('type',1);
            $this->db->where('question_id', $result[0]['question_id']);
            
            $query = $this->db->get();
            return $query->result_array();
        }else{
            $this->db->select('*');
            $this->db->from('question_ideas');
            $this->db->where('type',1);
            $this->db->where('question_id', $question_id);
            
            $query = $this->db->get();
            return $query->result_array();
        }

    }
    public function get_submited_student_idea($student_id,$idea_id)
    {
        // $this->db->from('idea_student_ans');
        // $this->db->join('tbl_useraccount', 'idea_student_ans.student_id = tbl_useraccount.id', 'LEFT');
        // $this->db->where('student_id', $student_id);
        // $this->db->where('module_id', $modle_id);
        // $this->db->where('question_id', $question_id);
        
        // $query = $this->db->get();
        // return $query->result_array();
        $this->db->select('*,question_ideas.id as idea_id');
        $this->db->from('question_ideas');
        $this->db->join('tbl_useraccount', 'question_ideas.user_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('question_ideas.user_id', $student_id);
        $this->db->where('question_ideas.id', $idea_id); 
        
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_submited_tutor_idea($tutor_id,$idea_id)
    {
        $this->db->select('*,question_ideas.id as idea_id');
        $this->db->from('question_ideas');
        $this->db->join('tbl_useraccount', 'question_ideas.user_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('question_ideas.user_id', $tutor_id);
        $this->db->where('question_ideas.id', $idea_id);
        
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_profile_information($student_id)
    {
        $this->db->from('profile');
        $this->db->join('tbl_useraccount', 'profile.user_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('user_id', $student_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_profile_information_tutor($tutor_id)
    {
        $this->db->from('profile');
        $this->db->join('tbl_useraccount', 'profile.user_id = tbl_useraccount.id', 'LEFT');
        $this->db->where('user_id', $tutor_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_user_informations($user_id)
    {
        $this->db->from('tbl_useraccount');
        $this->db->where('id', $user_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_teacher_correction($student_id,$question_id,$module_id)
    {
        $this->db->from('idea_correction_report');
        $this->db->where('student_id', $student_id);
        $this->db->where('question_id', $question_id);
        $this->db->where('module_id', $module_id);
        
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_teacher_correction_tutor($tutor_id,$idea_id)
    {
        $this->db->from('idea_correction_report');
        $this->db->where('student_id', $tutor_id);
        $this->db->where('idea_id', $idea_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_country_info($country_id)
    {
        $this->db->from('tbl_country');
        $this->db->where('id', $country_id);
        
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_country_info_tutor($country_id)
    {
        $this->db->from('tbl_country');
        $this->db->where('id', $country_id);
        
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_idea_information($idea_id,$student_id,$idea_no)
    {
        $this->db->from('idea_student_ans');
        $this->db->join('idea_description', 'idea_student_ans.idea_no = idea_description.idea_no','right');
        $this->db->where('idea_description.idea_id', $idea_id);
        $this->db->where('idea_description.idea_no', $idea_no);
        $this->db->where('idea_student_ans.student_id', $student_id);
        
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_idea_information_tutor($idea_id,$tutor_id)
    {
        $this->db->from('idea_tutor_ans');
        $this->db->join('idea_description', 'idea_tutor_ans.idea_no = idea_description.idea_no','LEFT');
        $this->db->where('idea_description.idea_id', $idea_id);
        $this->db->where('idea_tutor_ans.idea_id', $idea_id);
        $this->db->where('idea_description.idea_no', $idea_no);
        $this->db->where('idea_tutor_ans.tutor_id', $tutor_id);
        
        $query = $this->db->get();
        //echo $this->db->Last_query();die();
        return $query->result_array();

    }
    /*==============================================================
                    Student Answer Notification
 ===============================================================*/
    
 public function studentAnswerNotification($user_id){
    $this->db->from('idea_correction_report');
    $this->db->where('student_id', $user_id);

    $query = $this->db->get();
    $results = $query->result_array();

    // echo "<pre>";
    // print_r($results); die();

    $resultArray = [];
    foreach($results as $result){
        $this->db->select('*');
        $this->db->from('tbl_module');
        $this->db->join('tbl_modulequestion', 'tbl_module.id = tbl_modulequestion.module_id');
        // $this->db->join('tbl_moduletype', 'tbl_module.moduleType = tbl_moduletype.id');
        $this->db->where('tbl_modulequestion.module_id', $result['module_id']);
        $this->db->where('tbl_modulequestion.question_id', $result['question_id']);

        $query_result = $this->db->get();
        $result = $query_result->row_array();

        // echo $this->db->last_query();
        $resultArray[] = $result;
    }
    return $resultArray;

}
public function getStudentIdeaInfo($user_id){
    $this->db->from('idea_correction_report');
    $this->db->where('student_id', $user_id);

    $query = $this->db->get();
    return $query->result_array();

}
public function getSpecificStudentProgressReport($studentId, $ideaId, $ideaNo, $questionId){
    $this->db->select('idea.id,idea.teacher_correction,idea.total_point, idea.teacher_comment, idea.checked_checkbox, stdans.total_word, idea.idea_correction, idea.significant_checkbox,idea.student_id');
    $this->db->from('idea_correction_report as idea');
    $this->db->join('idea_student_ans as stdans', 'idea.idea_id = stdans.idea_id');
    $this->db->where('idea.student_id', $studentId);
    $this->db->where('idea.idea_id', $ideaId);
    $this->db->where('idea.idea_no', $ideaNo);
    $this->db->where('idea.question_id', $questionId);

    $query = $this->db->get();
    // echo $this->db->last_query();
    
    return $query->row_array();

}
public function tutor_like_save($data){
    $this->db->select('*');
    $this->db->from('tutor_like_info');
    $this->db->where('question_id', $data['question_id']);
    $this->db->where('module_id', $data['module_id']);
    $this->db->where('idea_id', $data['idea_id']);
    $this->db->where('idea_no', $data['idea_no']);
    $this->db->where('tutor_id', $data['tutor_id']);
    $this->db->where('student_id', $data['student_id']);

    $query = $this->db->get();
    return $query->row_array();

}

public function getCreativePoint(){
    $this->db->select('*');
    $this->db->from('idea_get_student_point');
    $this->db->where('student_id', $this->session->userdata('user_id'));
    $this->db->order_by('id','desc');
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->row_array();

}

public function get_student_ans($student_id,$question_id){
    $this->db->select('*');
    $this->db->from('idea_student_ans');
    $this->db->join('idea_info', 'idea_info.question_id = idea_student_ans.question_id', 'LEFT');
    $this->db->where('idea_student_ans.student_id', $student_id);
    $this->db->where('idea_student_ans.question_id', $question_id);
    
    $query = $this->db->get();
    return $query->result_array();

}

public function getAllSubjectByCourse($all_course_id,$module_type){
    $this->db->select('subject');
    $this->db->from('tbl_module');
    $this->db->where('moduleType', $module_type);
    $this->db->where_in('course_id', $all_course_id);
    $this->db->distinct();

    $query = $this->db->get();
    $results =  $query->result_array();

    $subject_id = array();
    foreach($results as $result){
        if(!empty($result['subject'])){
            $subject_id[]=$result['subject'];
        }
      
    }

    //echo "<pre>";print_r($subject_id);die();
    return $subject_id;

}
public function getSubjectDetailsBySubject($all_course_id,$module_type){
    $this->db->select('subject');
    $this->db->from('tbl_module');
    $this->db->where('moduleType', $module_type);
    $this->db->where('course_id', $all_course_id);
    $this->db->distinct();

    $query = $this->db->get();
    $results =  $query->result_array();

    $subject_id = array();
    foreach($results as $result){
        if(!empty($result['subject'])){
            $subject_id[]=$result['subject'];
        }
      
    }

    //echo "<pre>";print_r($subject_id);die();
    return $subject_id;

}

public function getAllChapterByCourse($all_course_id,$module_type){
    $this->db->select('chapter');
    $this->db->from('tbl_module');
    //$this->db->where('moduleType', $module_type);
    $this->db->where_in('course_id', $all_course_id);
    $this->db->distinct();

    $query = $this->db->get();
    $results =  $query->result_array();

    $chapter_id = array();
    foreach($results as $result){
        if(!empty($result['chapter'])){
            $chapter_id[]=$result['chapter'];
        }
      
    }

    //echo "<pre>";print_r($subject_id);die();
    return $chapter_id;

}

public function getChapterDetailsByChapter($all_course_id,$module_type){
    $this->db->select('chapter');
    $this->db->from('tbl_module');
    $this->db->where('moduleType', $module_type);
    $this->db->where('course_id', $all_course_id);
    $this->db->distinct();

    $query = $this->db->get();
    $results =  $query->result_array();

    $chapter_id = array();
    foreach($results as $result){
        if(!empty($result['chapter'])){
            $chapter_id[]=$result['chapter'];
        }
      
    }

    //echo "<pre>";print_r($subject_id);die();
    return $chapter_id;

}


public function check_student_idea_ans_info($module_id,$student_id){
    // echo $module_id.'//'. $student_id;die();
    $this->db->select('*');
    $this->db->from('tbl_modulequestion');
    $this->db->where('module_id', $module_id);
    $this->db->where('question_type', 17);
    
    $query = $this->db->get();
    $exits_ques =  $query->result_array();
    // echo "<pre>";print_r($exits_ques);die();
    if(!empty($exits_ques)){
        
        $question_id = $exits_ques[0]['question_id'];

        $this->db->select('*');
        $this->db->from('tutor_correction_idea_info');
        // $this->db->where('question_id', $question_id);
        $this->db->where('student_id', $student_id);
        $this->db->where('module_id', $module_id);
        
        $query = $this->db->get();
        $exits_idea =  $query->result_array();
        // echo "<pre>";print_r($exits_ques);die();
        if(!empty($exits_idea)){
            return 1;
        }

    }else{
        return 0;
    }

}

public function get_idea_achieve_point_info($module_id,$student_id){
    $this->db->select('*');
    $this->db->from('tbl_modulequestion');
    $this->db->where('module_id', $module_id);
    $this->db->where('question_type', 17);
    
    $query = $this->db->get();
    $exits_ques =  $query->result_array();
    // echo "<pre>";print_r($exits_ques);die();

    $question_id = $exits_ques[0]['question_id'];

    $this->db->select('*');
    $this->db->from('question_ideas');
    $this->db->join('tutor_correction_idea_info', 'tutor_correction_idea_info.idea_id = question_ideas.id', 'LEFT');
    $this->db->where('question_ideas.user_id', $student_id);
    //$this->db->where('tutor_correction_idea_info.question_id', $question_id);
    $this->db->where('question_ideas.module_id', $module_id);
    $query = $this->db->get();
    return $query->result_array();

    //echo $this->db->last_query();die();
}

}
