<?php

class FaqModel extends CI_Model
{

    public $loggedUserId, $loggedUserType;
    function __construct()
    {
        parent::__construct();
        $this->loggedUserId   = $this->session->userdata('user_id');
        $this->loggedUserType = $this->session->userdata('userType');
    }

    /**
     * Get the last item id from faqs table.
     *
     * @return integer  last item id
     */
    public function lastItemId()
    {
        $res = $this->db
            ->select('id')
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get('faqs')
            ->result_array();
        return isset($res[0])?$res[0]['id'] : 0;
    }

    /**
     * Single row insert.
     *
     * @param array $dataToInsert data
     *
     * @return integer             inserted item id
     */
    public function insert($dataToInsert)
    {
        $this->db
            ->insert('faqs', $dataToInsert);

        return $this->db->insert_id();
    }

    /**
     * Get all faq items
     *
     * @return array all faqs
     */
    public function allFaqs()
    {
        return $this->db
            ->order_by('serial', 'ASC')
            ->get('faqs')
            ->result_array();
    }

    /**
     * Update a row from faqs table.
     *
     * @param array $conditions   ex: [id=>2, title=>'title']
     * @param array $dataToUpdate ex: [id=>3, title=>'new title']
     *
     * @return void
     */
    public function update($conditions, $dataToUpdate)
    {
        $this->db
            ->where($conditions)
            ->update('faqs', $dataToUpdate);
    }

    /**
     * Delete a row.
     *
     * @param integer $faqId faq to delete
     *
     * @return void
     */
    public function delete($faqId)
    {
        $this->db
            ->where('id', $faqId)
            ->delete('faqs');
    }

    /**
     * Get info of a faq
     *
     * @param  array $conditions condition for where clause
     * @return array          faq info
     */
    public function info($conditions)
    {
        $res = $this->db
            ->where($conditions)
            ->get('faqs')
            ->result_array();
        
        return count($res) ? $res[0] : [];
    }

    public function reorderSerial($intendedSl)
    {
        /*if the intended serial not overlapping do nothing then*/
        $itemExists = $this->info(['serial'=>$intendedSl]);
        if (count($itemExists)) {
            $qry = "update faqs set serial=serial+1 where serial>=$intendedSl";
            $this->db->query($qry);
        }
    }

    public function serialize($id)
    {
        /*if the intended serial not overlapping do nothing then*/
        $this->db->select('*');
        $this->db->from('faqs');
        $this->db->where('serial', $id);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function serialize_update($id, $serial_id)
    {
        $this->db
            ->where('id', $id)
            ->update('faqs', ['serial'=>$serial_id] );
    }

    public function insertTbl($dataToInsert , $tbl)
    {
        $this->db
            ->insert($tbl, $dataToInsert);

        return $this->db->insert_id();
    }

    public function allData($tbl)
    {
        $this->db->select('*');
        $this->db->from($tbl);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function selectData($id , $tbl)
    {
        /*if the intended serial not overlapping do nothing then*/
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function videoSerialize($id , $tbl)
    {
        /*if the intended serial not overlapping do nothing then*/
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->where('serial_num', $id);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function videoSerializeUpdate($id , $tbl , $serial_id)
    {
        /*if the intended serial not overlapping do nothing then*/

        $this->db->where('id', $id);
        $this->db->update($tbl, ['serial_num'=>$serial_id] );

    }

    public function deleteVideo($faqId , $tbl)
    {
        $this->db
            ->where('id', $faqId)
            ->delete($tbl);
    }

    public function videoHelpeUpdate($id , $tbl , $data)
    {
        /*if the intended serial not overlapping do nothing then*/

        $this->db->where('id', $id);
        $this->db->update($tbl, $data );

    }

    public function roomIDTaken($whiteboar_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_available_rooms');
        $this->db->join('tbl_useraccount', 'tbl_useraccount.whiteboar_id = tbl_available_rooms.room_id' , 'left');
        $this->db->where('whiteboar_id', $whiteboar_id);
        $query = $this->db->get();

        return ($query->result_array());
    }
}
