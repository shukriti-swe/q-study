<?php
/**
 * Question controller class.
 *
 * @author Shakil Ahmed (initial part author)
 */

class Question extends CI_Controller
{

    public $loggedUserId, $loggedUserType;

    public function __construct()
    {
        parent::__construct();

        $user_id              = $this->session->userdata('user_id');
        $user_type            = $this->session->userdata('userType');
        $this->loggedUserId   = $user_id;
        $this->loggedUserType = $user_type;

        if ($user_id == null && $user_type == null) {
            redirect('welcome');
        }

        $this->load->model('QuestionModel');
    }//end __construct()


    /**
     * Delete a question from database.
     *
     * @param integer $questionId question to delete
     *
     * @return void
     */
    public function deleteQuestion($questionId = 0)
    {
        
        /*delete question info from tbl_question
        delete all question module relationship*/
        
        $this->db->select('*');
        $this->db->from('tbl_question');
        $this->db->where('id',$questionId);
        $query = $this->db->get()->result_array();
        //echo $questionId."hello";die();
        // echo "<pre>";print_r($query);die();
        if($query[0]['questionType']==17){
            
            $this->db->where('question_id', $questionId)->delete('idea_info');
            // $this->db->where('id', $questionId)->delete('tbl_question');
            
            $this->db->where('question_id', $questionId)->delete('idea_description');
            $this->db->where('tutor_question_id', $questionId)->delete('question_ideas');
        }

        $delItems = $this->QuestionModel->delete('tbl_question', 'id', $questionId);
        $this->QuestionModel->delete('tbl_modulequestion', 'question_id', $questionId);
        if ($delItems) {
            echo 'true';
        } else {
            echo 'false';
        }
    }//end deleteQuestion()


    /**
     * This method will simply duplicate a question
     *
     * @param integer $questionId question to duplicate
     *
     * @return void
     */
    public function duplicateQuestion()
    {
        $data = array();
        $user_id  = $this->input->post('user_id', true);
        $questionId  = $this->input->post('qId', true);

        $parentQuestion = $this->QuestionModel->info($questionId);
        unset($parentQuestion['id']);
        if (count($parentQuestion)) {
            $parentQuestion['country'] = $parentQuestion['country'] ? $parentQuestion['country']: 1;
            $this->QuestionModel->insert('tbl_question', $parentQuestion);
            $duclicate = $this->QuestionModel->last_question($user_id);

            $order_no = $this->QuestionModel->last_question_order($user_id, $duclicate[0]->questionType);

           

            $output ='<li style="background-color:2CE316;" data-id="'.$duclicate[0]->questionType.'_'.$duclicate[0]->id.'" id="q_<?=$i?>_'.$duclicate[0]->questionType.'"> 
                              <a href="question_edit/'.$duclicate[0]->questionType.'/'.$duclicate[0]->id.'" target="_blank">Q'.$order_no.'</a>
                             </li>';

            $var = [

                "questionType" =>$duclicate[0]->questionType,
                "element" =>$output

            ];    

            array_push($data, $var);             

            print_r(json_encode($data));
            
        } else {
            echo 'false';
        }
    }

    /**
     * User can duplicate a dictionary item to his/her section
     *
     * @param integer $questionId dictionary item to duplicate
     *
     * @return void
     */
    public function duplicateDictionaryItem($questionId = 0)
    {
        $parentQuestion = $this->QuestionModel->info($questionId);
        unset($parentQuestion['id']);
        $parentQuestion['user_id'] = $this->loggedUserId;
        if (count($parentQuestion)) {
            $this->QuestionModel->insert('tbl_question', $parentQuestion);
            echo 'true';
        } else {
            echo 'false';
        }
    }//end duplicateQuestion()


    /**
     * Add dictionary word item(view)
     *
     * @return void
     */
    public function addDictionaryWord()
    {
        if (isset($_GET['word'])) {
            $data['get_url'] = $_GET['word']; 
        }
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
        $data['header'] = $this->load->view('dashboard_template/header', '', true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

        $question_box = 'tutors/question/question-box/q-dictionary';
        $data['question_box']=$this->load->view($question_box, '', true);
        $data['maincontent'] = $this->load->view($question_box, $data, true);
        $this->load->view('master_dashboard', $data);
    }

    /**
     * Save dictionary word item
     *
     * @return void
     */
    public function saveDictionaryWord()
    {
        $post = $this->input->post();
        $clean = $this->security->xss_clean($post);

        $data['studentgrade'] = 1;//$this->input->post('studentgrade');
        $data['user_id'] = $this->session->userdata('user_id');
        $data['dictionary_item'] = 1;
        $data['questionType'] = 3; //vocabulary type
        $data['chapter'] = 1;//$this->input->post('chapter');
        $data['questionName'] = $this->processDictionaryWord($post);//$this->input->post('questionName');
        $data['answer'] = $clean['answer'];
        $data['questionMarks'] = 1;//$questionMarks;
        $data['questionDescription'] = '1';//$this->input->post('questionDescription');
        $data['isCalculator'] = 1;//$this->input->post('isCalculator');
        $data['question_solution'] = 1;//$this->input->post('question_solution');
        $data['created'] = time();
        $data['country'] = 1;
        $hour = 1;//$this->input->post('hour');
        $minute = 1;//$this->input->post('minute');
        $second = 1;//$this->input->post('second');

        $data['questionTime'] = $hour.":".$minute.":".$second;
        $questionId = $this->tutor_model->insertId('tbl_question', $data);
        //redirect('q-dictionary/view/'.$data['answer']);
        $this->session->set_flashdata('success_msg', 'Dictionary item created successfully');
        redirect('q-dictionary/add?word='.$_POST['answer'].'');
    }

    /**
     * Grab item from post method for question field
     *
     * @param array $items post array
     *
     * @return string json encoded data to record as question
     */
    public function processDictionaryWord($items)
    {
        $arr['itemType'] ="dictionary"; //
        $arr['definition'] = $items['definition'];
        $arr['parts_of_speech'] = $items['parts_of_speech'];
        $arr['synonym'] = $items['synonym'];
        $arr['antonym'] = $items['antonym'];
        $arr['sentence'] = $items['sentence'];
        $arr['near_antonym'] = $items['near_antonym'];
        $arr['speech_to_text'] = $items['speech_to_text'];

        //$arr['vocubulary_image'] = $items['vocubulary_image'];
        for ($i = 1; $i <= $items['image_quantity']; $i++) {
            //$image = 'vocubulary_image_' . $i . '[]';
            $desired_image[] = $items['vocubulary_image_'.$i];
        }
        if ($desired_image) {
            $arr['vocubulary_image'] = $desired_image;
        }
        
        $files = $_FILES;
        if (isset($_FILES['videoFile']) && $_FILES['videoFile']['error'][0] != 4) {
            $_FILES['videoFile']['name'] = $files['videoFile']['name'];
            $_FILES['videoFile']['type'] = $files['videoFile']['type'];
            $_FILES['videoFile']['tmp_name'] = $files['videoFile']['tmp_name'];
            $_FILES['videoFile']['error'] = $files['videoFile']['error'];
            $_FILES['videoFile']['size'] = $files['videoFile']['size'];
            
            $_FILES['audioFile']['name'] = $files['audioFile']['name'];
            $_FILES['audioFile']['type'] = $files['audioFile']['type'];
            $_FILES['audioFile']['tmp_name'] = $files['audioFile']['tmp_name'];
            $_FILES['audioFile']['error'] = $files['audioFile']['error'];
            $_FILES['audioFile']['size'] = $files['audioFile']['size'];

            $config['upload_path'] = 'assets/uploads/question_media/';
            $config['allowed_types'] = 'mp3|mp4|3gp|ogg|wmv';
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['max_height'] = 0;
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload();

            $error = array();
            if (!$this->upload->do_upload('videoFile')) {
                $error = $this->upload->display_errors();
            } else {
                $fdata = $this->upload->data();
                $arr['videoFile'] = $config['upload_path'] . $fdata['file_name'];
            }
            
            if (!$this->upload->do_upload('audioFile')) {
                $error = $this->upload->display_errors();
            } else {
                $fdata1 = $this->upload->data();
                $arr['audioFile'] = $config['upload_path'] . $fdata1['file_name'];
            }
        }
        return json_encode($arr);
    }
public function PreviewDictionary()
    {
        $word = $_GET['word'];
        $word = $this->getWordInfo($word, 1, 0);
        if (!$word) {

            redirect($_SERVER['HTTP_REFERER']);

        }else{

            $data['word_info'] = json_decode($word['word_info'][0]['questionName']);
            $data['word'] = $word['word_info'][0]['answer'];
            $data['word_id'] = $word['word_info'][0]['id'];
            $data['creator_info'] = $word['word_creator_info'][0];
            $data['total_items'] = count($this->QuestionModel->search('tbl_question', ['answer'=>$data['word'], 'dictionary_item'=>1]));
            $wordCount = $this->QuestionModel->search(
                'tbl_question', //table
                [ // conditions
                'answer'=>$data['word'],
                'dictionary_item'=>1
                ]
            );
            $wordCount = count($wordCount);
            
            $data['headerlink'] = $this->load->view('dashboard_template/headerlink', '', true);
            $data['pageType'] = 'q-dictionary';
            $data['header'] = $this->load->view('dashboard_template/header', $data, true);
            $data['footerlink'] = $this->load->view('dashboard_template/footerlink', '', true);

            $data['pagination'] = $this->pagination($wordCount);
            $question_box = 'preview/dictionary_word';
            $data['maincontent'] = $this->load->view($question_box, $data, true);
            $this->load->view('master_dashboard', $data);
        
        }

    }

    public function getWordInfo($word, $limit, $offset)
    {
        $data['word_info'] = $this->QuestionModel->dicItemsByWord($word, $limit, $offset);
        if (!count($data['word_info'])) {
            return 0;
        }
        $wordCreatorId = $data['word_info'][0]['user_id'];
        $conditions = ['id'=>$wordCreatorId];
        $data['word_creator_info'] = $this->Tutor_model->tutorInfo($conditions);
        
        return $data;
    }

    public function pagination($totItems = 0)
    {
        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = "CommonAccess/wordInfoByAjaxCall";
        $config["total_rows"] = $totItems;//$total_row;
        $config["per_page"] = 1;
        $config['use_page_numbers'] = true;
        $config['num_links'] = $totItems;//$total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="myclass page-link" href="CommonAccess/wordInfoByAjaxCall/1" data-ci-pagination-page="1">';
        $config['next_tag_open'] = '<a class="myclass page-link next" href="CommonAccess/wordInfoByAjaxCall/2" data-ci-pagination-page="2"';
        $config['cur_tag_close'] = '</a>';
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
        $config['attributes'] = array('class' => 'myclass page-link');
        
        $config['full_tag_open'] = '<li class="page-item">';
        $config['full_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function send_to_q_Study()
    {
        
        $data = array();
        $user_id  = $this->input->post('user_id', true);
        $questionId  = $this->input->post('qId', true);
        $parentQuestion = $this->QuestionModel->info($questionId);
        $this->db->where('id',$questionId)->update('tbl_question',['user_id'=>2]);

        $this->db->insert('send_qustion_by_tutor',['send_user_id'=>$user_id,'qustion_id'=>$questionId ]);
        echo "success";
    }

    public function save_idea()
    {
        $data = array();
        $data = [
            'idea_title' => $this->input->post('idea_title'),
            'question_description' => $this->input->post('question_description'),
            'total_word' => $this->input->post('total_word'),
            'user_id' => $this->session->userdata('user_id'),
        ];

        $this->db->insert('idea_save_temp',$data);
        $last_id= $this->db->insert_id();

        $this->db->select('*');
        $this->db->from('idea_save_temp');
        $this->db->where('id',$last_id);
        $query = $this->db->get();
        $results= $query->result_array();
        echo json_encode($results);
        
    }

    public function edit_idea()
    {
        $idea_id = $this->input->post('idea_id');

        $this->db->select('*');
        $this->db->from('idea_save_temp');
        $this->db->where('id',$idea_id);
        $query = $this->db->get();
        $results= $query->result_array();
        //echo print_r($results[0]);
        echo json_encode($results[0]);
        
    }
    public function edit_save_idea()
    {
        $idea_id=$this->input->post('idea_id');
        $data = array();
        $data = [
            'idea_title' => $this->input->post('idea_title'),
            'question_description' => $this->input->post('question_description'),
            'total_word' => $this->input->post('total_word'),
        ];

        $this->db->where('id',$idea_id)->update('idea_save_temp', $data);
        
        $this->db->select('*');
        $this->db->from('idea_save_temp');
        $this->db->where('id',$idea_id);
        $query = $this->db->get();
        $results= $query->result_array();
        echo json_encode($results);
        
    }

    public function check_idea_short_question()
    {
        $short_question_title = $this->input->post('short_title');

        $this->db->select('*');
        $this->db->from('idea_info');
        $this->db->where('shot_question_title',$short_question_title);
        $query = $this->db->get();
        $results= $query->result_array();
        //echo "hello <pre>";print_r($results);die();
        if(!empty($results)){
            echo 1;
        }else{
            echo 2;
        }
    }

    public function get_idea()
    {  
        $question_id = $this->input->post('question_id');

        // $this->db->select('id.*,id.id as ids,ii.*,tbl_useraccount.name,tbl_question.*,tbl_question.created_at as q_created_at');
        // $this->db->from('idea_description id');
        // $this->db->join('idea_info ii','ii.question_id = id.question_id');
        // $this->db->join('tbl_question','tbl_question.id = ii.question_id');
        // $this->db->join('tbl_useraccount','tbl_useraccount.id = tbl_question.user_id');
        // $this->db->where('ii.question_id',$question_id);
        // $this->db->order_by('ii.id desc');
        // $query = $this->db->get();
        // $results= $query->result_array();
        // echo json_encode($results);

        $this->db->select('qi.*,qi.id as ids,ii.*,tbl_useraccount.name,tbl_question.*,tbl_question.created_at as q_created_at');
        $this->db->from('idea_info ii');
        $this->db->join('question_ideas qi','ii.question_id = qi.question_id');
        $this->db->join('tbl_question','tbl_question.id = ii.question_id');
        $this->db->join('tbl_useraccount','tbl_useraccount.id = tbl_question.user_id');
        $this->db->where('ii.question_id',$question_id);
        $this->db->order_by('ii.id desc');
        $query = $this->db->get();
        $results= $query->result_array();
        echo json_encode($results);
        
    }

    public function search_idea()
    {
        // echo 11; die();

        $search_text = $this->input->post('search_text');
        $search_type = $this->input->post('search_type');
        $data['search_type'] = $search_type;
        // echo $search_text.'//'.$search_type;die();
        //echo $search_text;die();
        if($search_type == 1){
       
            $this->db->select('*'); 
            $this->db->from('idea_info');
            $this->db->where('allows_online',1);
            $this->db->where('parent_question_id',0);
            $this->db->like('shot_question_title',$search_text,'after');
            //$this->db->or_like('large_question_title',$search_text);
            $this->db->order_by('shot_question_title');
            $query = $this->db->get();
            $results= $query->result_array();
            //echo  $this->db->last_query();die();

            // echo "<pre>"; print_r($results); die();
         
            $data['questions']= $results;
            echo json_encode($data);

        }else if($search_type == 2){
            $this->db->select('*');
            $this->db->from('idea_description');
            $this->db->where('allow_online',2);
            $this->db->like('idea_name',$search_text);
            $query = $this->db->get();
            $results['ideas']= $query->result_array();
            $data['ideas']= $results;
            echo json_encode($data);
        }

    }

    public function search_image_idea()
    {
        $search_text = $this->input->post('search_text');
        
       
            $this->db->select('*');
            $this->db->from('idea_info');
            $this->db->where('allows_online',1);
            $this->db->where('LENGTH(image_title) >',0); 
            if(!empty($search_text)){
              $this->db->like('image_title',$search_text,'after');
            }
            $this->db->order_by('image_title');
            $query = $this->db->get();
           
            $results= $query->result_array();

            $data['questions']= $results;
            echo json_encode($data);
    }
    
    public function save_more_idea(){
        
        //echo "<pre>"; print_r($_POST); die();

        $idea_title = $this->input->post('idea_title');
        $idea_question = $this->input->post('question_description');
        $question_id = $this->input->post('question_id');

        $this->db->select('*');
        $this->db->from('idea_description');
        $this->db->where('question_id',$question_id);
        $query = $this->db->get();
        $results= $query->result_array();
        $increase = count($results);
        //echo $increase;die();
        $increase = $increase + 1;

        $data['idea_no'] = $increase;
        $data['question_id'] = $question_id;
        $data['idea_id'] = $results[0]['idea_id'];
        $data['idea_name'] = "Idea".$increase;
        $data['idea_title'] = $idea_title;
        $data['idea_question'] = $idea_question;
        

        $this->db->insert('idea_description',$data);

        $this->db->select('*');
        $this->db->from('idea_description');
        $this->db->where('question_id',$question_id);
        $query = $this->db->get();
        $results= $query->result_array();
        echo json_encode($results);

    }

    public function save_image_idea(){

        $data = array();
        $data = [
            'idea_title' => $this->input->post('idea_title'),
            'question_description' => $this->input->post('question_description'),
            'total_word' => $this->input->post('total_word'),
        ];

        $this->db->insert('idea_save_temp',$data);
        $last_id= $this->db->insert_id();

        $this->db->select('*');
        $this->db->from('idea_save_temp');
        $this->db->where('id',$last_id);
        $query = $this->db->get();
        $results= $query->result_array();
        echo json_encode($results);

    }

    public function update_short_question()
    {
        $data['question_id'] = $this->input->post('question_id');
        $data['shot_question_title'] = $this->input->post('short_question');

        $this->db->select('*');
        $this->db->from('idea_info');
        $this->db->where('question_id', $data['question_id']);
 
        $query = $this->db->get();
        $result = $query->result_array();
        $pre_short_question = $result[0]['shot_question_title'];
        $pre_short_body = $result[0]['short_ques_body'];
        $data['short_ques_body'] = str_replace($pre_short_question,$data['shot_question_title'],$pre_short_body);

        $this->db->where('question_id', $data['question_id']);
        $update = $this->db->update('idea_info', $data);
        if($update){
          echo 1;
        }else{
          echo 2;
        }
    }

    public function short_image_upload(){
        //echo $_FILES['file']['name'];die();
        $return=array();
		if($_FILES['file']['name'] != ''){
			$config['upload_path'] = './assets/idea_image';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|JPG';
			$config['file_name'] = $_FILES['file']['name'];
			// $config['min_width']  = '400';
			// $config['min_height']  = '400';

            //Load upload library and initialize here configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('file')){ 
				$uploadData = $this->upload->data();
				$main_image = $uploadData['file_name'];
				echo $main_image;
                // die();
				// //$this->_create_thumbs($uploadData['file_name']);

			}else{
				$return['main_image_error']	= array('error' => $this->upload->display_errors());
				return $return;
			}
		}  

    }

    public function comprehension_image_upload(){
        //echo $_FILES['file']['name'];die();
        $return=array();
		if($_FILES['file']['name'] != ''){
			$config['upload_path'] = './assets/comprehension';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES['file']['name'];
			// $config['min_width']  = '400';
			// $config['min_height']  = '400';

            //Load upload library and initialize here configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('file')){ 
				$uploadData = $this->upload->data();
				$main_image = $uploadData['file_name'];
				echo $main_image;

			}else{
				$return['main_image_error']	= array('error' => $this->upload->display_errors());
				return $return;
			}
		}  

    }

    public function glossary_image_upload(){
        // echo $_FILES['file']['name'];die();
        $return=array();
		if($_FILES['file']['name'] != ''){
			$config['upload_path'] = './assets/glossary';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES['file']['name'];
			//  $config['min_width']  = '200';
			//  $config['min_height']  = '200';

            //Load upload library and initialize here configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('file')){ 
				$uploadData = $this->upload->data();
				$main_image = $uploadData['file_name'];
				echo $main_image;
                // die();
				// $this->_create_thumbs($uploadData['file_name']);
                
			}else{
                //print_r($this->upload->display_errors());die();
				$return['main_image_error']	= array('error' => $this->upload->display_errors());
				return $return;
			}
		}  
    }

    public function html_text_to_array(){
        $wrrite_input = $this->input->post('wrrite_input');

        $get_sentences =  preg_split('/<\/\s*p\s*>/', $wrrite_input);
        // echo "<pre>";print_r($get_sentences);die();
        $k=1;
        $al_words = '';
        $al_sentence = '';
        $total_sentences = count($get_sentences);
        $a=0;
        foreach($get_sentences as $sentence){
           if($k<$total_sentences){
                $al_words .= '<p style="display: flex;flex-wrap: wrap;">';
                //$al_sentence .= '<p style="display: flex;flex-wrap: wrap;">';
                $al_sentence .= '<p>';
                $words = explode(' ',strip_tags($sentence));
                $new_sentence = substr($sentence, 0, strlen($sentence)-1);
                $get_sentences = explode('.',strip_tags($new_sentence));
                if($k==1){
                    $i=0;
                    $j=0;
                }
                foreach($words as $word){
                    $al_words .= '<span class="hint_words word_no'.$i.'" data-index="'.$i.'">'.$word.'</span>';
                $i++; }

                $total_sentence = count($get_sentences);

                $ii = 0;
                foreach($get_sentences as $get_sentence){
                    
                    $full_stop = '.';
                    if($ii<$total_sentence){
                        $al_sentence .= '<span class="hint_sentence sentence_no'.$j.'" data-index="'.$j.'">'.$get_sentence.$full_stop.'</span>';
                        $j++;
                    }
                    
                    $ii++; }

                $al_words .= '</p><br>';
                $al_sentence .= '</p><br>';
           }
           $k++;$a++; 
        }

           $data['words'] = $al_words;
           $data['sentence'] = $al_sentence;
           echo json_encode($data);
    }

    public function type_one_box_one_image_upload(){
        // echo $_FILES['file']['name'];die();
        $return=array();
		if($_FILES['file']['name'] != ''){
			$config['upload_path'] = './assets/imageQuiz';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES['file']['name'];
			//  $config['min_width']  = '200';
			//  $config['min_height']  = '200';

            //Load upload library and initialize here configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('file')){ 
				$uploadData = $this->upload->data();
				$main_image = $uploadData['file_name'];
				echo $main_image;
                // die();
				// $this->_create_thumbs($uploadData['file_name']);
                
			}else{
                //print_r($this->upload->display_errors());die();
				$return['main_image_error']	= array('error' => $this->upload->display_errors());
				return $return;
			}
		}  
    }

    public function type_one_box_one_hint_image_upload(){
        // echo $_FILES['file']['name'];die();
        $return=array();
		if($_FILES['file']['name'] != ''){
			$config['upload_path'] = './assets/imageQuiz';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES['file']['name'];
			//  $config['min_width']  = '200';
			//  $config['min_height']  = '200';

            //Load upload library and initialize here configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('file')){ 
				$uploadData = $this->upload->data();
				$main_image = $uploadData['file_name'];
				echo $main_image;
                // die();
				// $this->_create_thumbs($uploadData['file_name']);
                
			}else{
                //print_r($this->upload->display_errors());die();
				$return['main_image_error']	= array('error' => $this->upload->display_errors());
				return $return;
			}
		}  
    }

    public function type_two_box_one_image_upload(){
        // echo $_FILES['file']['name'];die();
        $return=array();
		if($_FILES['file']['name'] != ''){
			$config['upload_path'] = './assets/imageQuiz';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES['file']['name'];
			//  $config['min_width']  = '200';
			//  $config['min_height']  = '200';

            //Load upload library and initialize here configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('file')){ 
				$uploadData = $this->upload->data();
				$main_image = $uploadData['file_name'];
				echo $main_image;
                // die();
				// $this->_create_thumbs($uploadData['file_name']);
                
			}else{
                //print_r($this->upload->display_errors());die();
				$return['main_image_error']	= array('error' => $this->upload->display_errors());
				return $return;
			}
		}  
    }
    public function type_three_box_one_image_upload($type=null){
        // echo $_FILES['file']['name'];die();
        $return=array();
		if($_FILES['file']['name'] != ''){
			$config['upload_path'] = './assets/imageQuiz';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES['file']['name'];
			//  $config['min_width']  = '200';
            if(isset($type)){
               if($type==3){
                $config['min_height']  = '700';
               }
            }
			//  $config['min_height']  = '200';

            //Load upload library and initialize here configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('file')){ 
				$uploadData = $this->upload->data();
				$main_image = $uploadData['file_name'];
				echo $main_image;
                // die();
				// $this->_create_thumbs($uploadData['file_name']);
                
			}else{
                //print_r($this->upload->display_errors());die();
				$return['main_image_error']	= array('error' => $this->upload->display_errors());
				return $return;
			}
		}  
    }
    
    public function getUserInfos(){
        $user_id = $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->from('tbl_useraccount');
        $this->db->where('id',$user_id);
        $query = $this->db->get();
        $results= $query->result_array();
        echo json_encode($results);
    }

}
