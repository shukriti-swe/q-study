<?php

class QuestionModel extends CI_Model
{


    function __construct()
    {
        parent::__construct();
    }//end __construct()


    /**
     * Update a column with desired value
     *
     * @param  string $tableName    table to get affect
     * @param  string $selector     selector column on which where condition will apply
     * @param  string $value        selected column value
     * @param  array  $dataToUpdate array of data to update ex:['column_name'=>value]
     * @return null
     */
    public function update($tableName, $selector, $value, $dataToUpdate)
    {
        $dataToUpdate['updated_at'] = time();

        $this->db
            ->where($selector, $value)
            ->update($tableName, $dataToUpdate);
    }//end update()

    /**
     * Delete question info and question module relationship
     *
     * @param string $tableName table name to perform operation
     * @param string $selector  selector column
     * @param mixed  $value     selector column value
     *
     * @return void
     */
    public function delete($tableName, $selector, $value)
    {
        $this->db
            ->where($selector, $value)
            ->delete($tableName);

        return $this->db->affected_rows();
    } //end delete()


    /**
     * Return question info
     *
     * @param  [type] $questionId [description]
     * @return [type]             [description]
     */
    public function info($questionId)
    {
        $res = $this->db
            ->where('id', $questionId)
            ->get('tbl_question')
            ->result_array();
        
        return count($res[0]) ? $res[0] : [];
    } //end info()

    /**
     * Basic insert into database
     *
     * @param  string $tableName    table name
     * @param  array  $dataToInsert data to insert into database
     * @return void                 return void
     */
    public function insert($tableName, $dataToInsert)
    {
        $this->db
            ->insert($tableName, $dataToInsert);
    } //end insert()


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
     * Search dictionary word items from question Table by a word
     *
     * @param string $word word to Search
     *
     * @return array      search result array
     */
    public function dicItemsByWord($word, $limit = 1, $offset = 1)
    {
        return $this->db
            ->where('answer', $word)
            ->where('questionType', 3)
            ->where('dictionary_item', 1)
            ->where('word_approved', 1)
            ->limit($limit, $offset)
            ->get('tbl_question')
            ->result_array();
    }

    /**
     * All dictionary word (where dictionary_item=1)
     *
     * @return array all words
     */
    public function allDictionaryWord()
    {
        $res = $this->db
            ->select('answer')
            ->select('user_id')
            ->where('dictionary_item', 1)
            ->order_by('user_id', 'desc')
            ->get('tbl_question')
            ->result_array();
        $res = array_unique(array_column($res, 'answer'));
        return $res;
    }

    /**
     * Count dictionary word items
     *
     * @return integer total word
     */
    public function countDictWord()
    {
        $res = $this->db
            ->select('count(*) total')
            ->where('questionType', 3)
            ->where('dictionary_item', 1)
            ->get('tbl_question')
            ->result_array();
            
        return isset($res[0]['total']) ? $res[0]['total']:0;
    }

    /*
     * Dictionary Word item creators
     * Data for dictionary wordlist on admin panel.
     *
     * @return array user list array
    */
    public function groupedWordItems()
    {
        $res = $this->db
            ->select('tbl_question.id word_id,answer word,tbl_useraccount.name word_creator, user_id creator_id')
            ->select('tbl_question.created ques_created_at, word_approved')
            ->select('tbl_useraccount.subscription_type creator_type')
            ->select('tbl_country.countryName creator_country')
            ->where('dictionary_item', 1)
            ->join('tbl_useraccount', 'tbl_useraccount.id=tbl_question.user_id', "left")
            ->join('tbl_usertype', 'tbl_useraccount.user_type=tbl_usertype.id', "left")
            ->join('tbl_country', 'tbl_useraccount.country_id=tbl_country.id', "left")
            ->order_by('user_id', 'ASC')
            ->get('tbl_question')
            ->result_array();
        return $res;
    }

    /**
     * Search unique dictionary word using like query
     *
     * @param integer $keyword keyword to search for
     *
     * @return array word list
     */
    public function searchWord($keyword)
    {
        return $this->db
            ->distinct('answer')
            ->select('answer as value')
            ->select('answer as data')
            ->where('dictionary_item', 1)
            ->where('word_approved', 1)
            ->like('answer', $keyword)
            ->get('tbl_question')
            ->result_array();
    }

    /**
     * Get all word creator who is payable
     *
     * @return array payment info array
     */
    public function wordCreatorToPay()
    {
        
        return $this->db
        ->query("SELECT `dictionary_payment`.*,`name` FROM `dictionary_payment` left join `tbl_useraccount` on `tbl_useraccount`.id=`dictionary_payment`.`word_creator`")
        ->result_array();
        
        // return $this->db
        // ->query("SELECT `dictionary_payment`.*,`name` FROM `dictionary_payment` left join `tbl_useraccount` on `tbl_useraccount`.id=`dictionary_payment`.`word_creator`  where total_approved-total_paid>=".VOCABULARY_PAYMENT)
        // ->result_array();
        
        //echo $this->db->last_query();
    }
    public function wordCreatorToPayCount()
    {


         return $this->db
        ->query("SELECT `dictionary_payment`.*,`name` FROM `dictionary_payment` left join `tbl_useraccount` on `tbl_useraccount`.id=`dictionary_payment`.`word_creator`  where total_approved-total_paid>=".VOCABULARY_PAYMENT)
        ->result_array();
        //echo $this->db->last_query();
    }
    
    
    public function vocabularyCommission($id)
    {
        return $array = $this->db->where('word_creator',$id)->get('dictionary_payment')->row();
        // print_r($array);
    }

    public function last_question($user_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('user_id',$user_id);
        $this->db->limit(1);
        $this->db->order_by('id',"DESC");
        $query = $this->db->get()->result();
    
        return $query;
    }

    public function last_question_order($user_id , $questionType)
    {
        // $query = $this->db->where('user_id', $user_id)->where('questionType', $questionId)->get('tbl_question');
        // $cnt = $query->num_fields();
        
//         $this->db->query('SELECT COUNT(*)
// FROM tbl_question Where user_id='.$user_id.'');

        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('user_id',$user_id);
        $this->db->where('questionType',$questionType);
        $cnt = $this->db->get()->result();

        return count($cnt);
    }

    public function getIdea()
    {
        $this->db->select('*');
        $this->db->from('idea_save_temp');
        $query = $this->db->get();
        return $query->result_array();
    }
}//end class
