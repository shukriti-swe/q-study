<?php

class SubjectModel extends CI_Model
{
    public function all($conditions = [])
    {
        return $this->db
            ->where($conditions)
            ->get('tbl_subject')
            ->result_array();
    }
    /**
     * Get chapters of a individual/multiple subject/s.
     *
     * @param  array $subjectId subject id/s ex: [12]
     * @return array              chapters
     */
    public function chaptersOfSubject($subjectId)
    {
     
        if (count($subjectId)) {
            if (count($subjectId)>1) {
                $this->db->where_in('subjectId', $subjectId);
            } else {
                $this->db->where('subjectId', $subjectId[0]);
            }
        }
        
        $res = $this->db
            ->get('tbl_chapter')
            ->result_array();

        return $res;
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

    /**
     * Responsible for deleting a chapter created by tutor
     * All question associated with that subject will be deleted
     *
     * @param integer $chapterId chapter to delete
     *
     * @return void
     */
    public function deleteChapter($chapterId)
    {
        //delete all question associated with this chapter
        $this->db
            ->where('chapter', $chapterId)
            ->delete('tbl_question');
        //delete chapter
        $this->db
            ->where('id', $chapterId)
            ->delete('tbl_chapter');
    }

    /**
     * Suggest subject(for autocomplete)
     *
     * @param  string $keyword key
     *
     * @return array
     */
    public function suggestSubject($keyword)
    {
        return $this->db
            ->select('courseName as value')
            ->select('courseName as data')
            ->like("courseName", $keyword)
            ->limit(100)
            ->get('tbl_course')
            ->result_array();
    }

    /**
     * Responsible for deleting a subject created by tutor
     * All chapter and question associated with that subject will be deleted
     *
     * @param integer $subjectId subject to delete
     *
     * @return void
     */
    public function deleteSubject($subjectId)
    {
        //get all chapters associated
        $chapters = $this->chaptersOfSubject([$subjectId]);

        //delete all chapter associated
        foreach ($chapters as $chapter) {
            $this->deleteChapter($chapter['id']);
        }

        //delete subject
        $this->db
            ->where('subject_id', $subjectId)
            ->delete('tbl_subject');
    }
	public function updateSubject($data,$subject_id)
    {
        $this->db->where('subject_id', $subject_id);
        $result = $this->db->update('tbl_subject', $data);

        if ($result)
        {
            return true;
        }else
        {
            return false;
        }
    }
}
