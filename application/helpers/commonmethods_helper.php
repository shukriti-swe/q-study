<?php
if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
//public $ci =& get_instance();

/**
 * Before passing items to renderSkpQuizPrevTable() index it first with this func
 * basically for preview skip quiz table
 *
 * @param array $items Json object array.
 *
 * @return array        Array with proper indexing
 */
function indexQuesAns(array $items)
{

    $arr = [];
    
    foreach ($items as $item) {
        $temp            = json_decode($item);
        $cr              = explode('_', $temp->cr);
        $col             = $cr[0];
        $row             = $cr[1];
        $arr[$col][$row] = [
            'type' => $temp->type,
            'val'  => $temp->val,
        ];
    }

    return $arr;
}//end indexQuesAns()


    /**
     * Render the indexed item to table data for preview
     *
     * @param  array   $items   ques ans as indexed item(get processed items from indexQuesAns())
     * @param  integer $rows    num of row in table
     * @param  integer $cols    num of cols in table
     * @param  integer $showAns optional, set 1 will show the answers too
     * @return string           table item
     */
function renderSkpQuizPrevTable($items, $rows, $cols, $showAns = 0, $pageType = '')
{
    // print_r($items);die;
   $row = '';
    for ($i = 1; $i <= $rows; $i++) {
        $row .= '<div class="sk_out_box">';
        for ($j = 1; $j <= $cols; $j++) {
            if ($items[$i][$j]['type'] == 'q') {
                $row .= '<div class="sk_inner_box"><input type="button" data_q_type="0" data_num_colofrow="" value="'.$items[$i][$j]['val'].'" name="skip_counting[]" class="form-control rsskpin input-box  rsskpinpt'.$i.'_'.$j.'" readonly style="min-width:50px; max-width:50px; background-color:#ffb7c5;">';
                if ($pageType = 'edit') {
                    $quesObj = [
                        'cr'   => $j.'_'.$i,
                        'val'  => $items[$i][$j]['val'],
                        'type' => 'q',
                    ];
                    $quesObj = json_encode($quesObj);
                    $row    .= '<input type="hidden" value=\''.$quesObj.'\' name="ques_ans[]" id="obj">';
                    // $row .= '<input type="hidden" value=\''.$quesObj.'\' name="ans[]" id="ans_obj">';
                }

                $row .= '</div>';
            } else {
                $ansObj = [
                    'cr'   => $i.'_'.$j,
                    'val'  => $items[$i][$j]['val'],
                    'type' => 'a',
                ];
                $ansObj = json_encode($ansObj);
                $val    = ($showAns == 1) ? ' value="'.$items[$i][$j]['val'].'"' : '';

                $row .= '<div class="sk_inner_box"><input autocomplete="off" type="text" '.$val.' data_q_type="0" data_num_colofrow="'.$i.'_'.$j.'" value="" name="skip_counting[]" class="form-control rsskpin input-box ans_input  rsskpinpt'.$i.'_'.$j.'"  style="min-width:50px; max-width:50px;background-color:#baffba;">';
                $row .= '<input type="hidden" value="" name="given_ans[]" id="given_ans">';
                if ($pageType = 'edit') {
                    $row .= '<input type="hidden" value="" name="ques_ans[]" id="obj">';
                    $row .= '<input type="hidden" value=\''.$ansObj.'\' name="ans[]" id="ans_obj">';
                }

                $row .= '</div>';
            }//end if
        }//end for

        $row .= '</div>';
    }//end for

    return $row;
}//end renderSkpQuizPrevTable()


    /**
     * Make table row element with assignment tasks
     *
     * @param  array $items assignment tasks json array
     * @return string        table row element
     */
function renderAssignmentTasks(array $items, $pageType = '')
{
    $row = '';
    foreach ($items as $task) {
        $task     = json_decode($task);
        $qMark    = $task->qMark;
        $obtnMark = '';//$task->obtnMark;
        if ($pageType == 'edit') {
            $qMark    = '<input name="qMark[]" class="form-control" type="text" value="'.$qMark.'"'.' type="number" step="0.1" required>';
            $obtnMark = '<input name="obtnMark[]" class="form-control" type="text" value="'.$obtnMark.'"'.'type="number" step="0.1" required>';
        }

        $row .= '<tr id="'.($task->serial + 1).'">';
        $row .= '<td>'.($task->serial + 1).'</td>';
        $row .= '<td>'.$qMark.'</td>';
        $row .= '<td>'.$obtnMark.'</td>';
        $row .= '<td><i class="fa fa-eye qDtlsOpenModIcon" data-toggle="modal" data-target="#quesDtlsModal"></i></td>';
        $row .= '<input name="descriptions[]" type="hidden" id="hiddenTaskDesc" value="'.$task->description.'">';
        $row .= '</tr>';
    }

    return $row;
}//end renderAssignmentTasks()

     /**
      * Responsible for sending email
      *
      * @param  string $mail_data all mail data //ex: mailto,subject,body
      * @return void
      */
function sendMail($mail_data)
{
    //print_r($mail_data);die;
    $ci =& get_instance();
    $mailTo        =   $mail_data['to'];
    $mailSubject   =   $mail_data['subject'];
    $message       =   $mail_data['message'];

    $ci->load->library('email');
    $ci->email->set_mailtype('html');
        
    /*$config['protocol'] ='sendmail';
    $config['mailpath'] ='/usr/sbin/sendmail';
    $config['charset'] = 'iso-8859-1';
    $config['wordwrap'] = true;*/
    $config['protocol']    = 'smtp';
    $config['smtp_crypto']    = 'ssl';
    $config['smtp_port']    = '465';
    $config['mailtype']    = 'text';
    $config['smtp_host']    = 'email-smtp.us-east-1.amazonaws.com';
    $config['smtp_user']    = 'AKIAJASMGQXCHUGFOX2A';
    $config['smtp_pass']    = 'AhQPyL02MEAjbohY82vZLikIwY1O2sU4sOrdI6vC3HYk';
    $config['charset']    = 'utf-8';
    $config['mailtype']    = 'html';
    $config['newline']    = "\r\n";
    $ci->email->initialize($config);


    $ci->email->from('admin@q-study.com', 'Q-study');
    $ci->email->to($mailTo);
    $ci->email->subject($mailSubject);
    $ci->email->message($message);
    
    
    $ci->email->send();
    //echo $ci->email->print_debugger();die;
    return true;
}



function sendMailAttachment($mail_data,$attachmants,$id)
{
    //print_r($mail_data);die;
    $ci =& get_instance();
    $mailTo        =   $mail_data['to'];
    $mailSubject   =   $mail_data['subject'];
    $message       =   $mail_data['message'];

    $ci->load->library('email');
    $ci->email->set_mailtype('html');
        
    /*$config['protocol'] ='sendmail';
    $config['mailpath'] ='/usr/sbin/sendmail';
    $config['charset'] = 'iso-8859-1';
    $config['wordwrap'] = true;*/
    $config['protocol']    = 'smtp';
    $config['smtp_crypto']    = 'ssl';
    $config['smtp_port']    = '465';
    $config['mailtype']    = 'text';
    $config['smtp_host']    = 'q-study.com';
    $config['smtp_user']    = 'admin@q-study.com';
    $config['smtp_pass']    = '1qvm6F&2';
    $config['charset']    = 'utf-8';
    $config['mailtype']    = 'html';
    $config['newline']    = "\r\n";
    $ci->email->initialize($config);


    $ci->email->from('admin@q-study.com', 'Q-study');
    $ci->email->to($mailTo);
    $ci->email->subject($mailSubject);
    $ci->email->message($message);
    $folder = 'assets/uploads/feedback/';
    $path = FCPATH.$folder;
    foreach ($attachmants as $key => $value) {
        $file = $value['filename'];
        $ci->email->attach($path.$file);
    }
    
    
    $ci->email->send();
    //echo $path;echo "<br>";
    //echo $ci->email->print_debugger();die;
    return true;
}



function userRegMail($userName, $userType, $email, $password, $additionalData = [])
{
    $ci =& get_instance();
    $ci->load->model('RegisterModel');
    $Name=$userName;
    $email=$email;
    $Password=$password;
    //$template = $ci->RegisterModel->getInfo('table_email_template', 'email_template_type', 9999);
    $data['userType'] = $userType;
    
    //if user is a parent mail him/her child acc info too
    if (($userType==1 || $userType==4) && count($additionalData)) {//parent, school
        $data['childInfo'] = $additionalData;
    }

    $template = $ci->load->view('email_templates/user_registration', $data, true);
    if ($template) {
        $subject = 'Q-study registration';//$template[0]['email_template_subject'];
        $template_message = $template;//$template[0]['email_template'];
        
        $find = array("{{userName}}","{{userEmail}}","{{userPassword}}");
        $replace = array($Name,$email,$Password);
        $message = str_replace($find, $replace, $template_message);
        
        $mail_data['to'] = $email;
        $mail_data['subject'] = $subject;
        $mail_data['message'] = $message;
        sendMail($mail_data);
    }
}

function getParentIDPaymetStatus($id){
    $ci =& get_instance();
    $ci->load->model('Parent_model');

    $user_info = $ci->Parent_model->getInfo('tbl_useraccount', 'id', $id );
    return $user_info;
}

function trailPeriod(){
    $ci =& get_instance();
    $ci->load->model('Parent_model');

    $user_info = $ci->Parent_model->getInfo('tbl_setting', 'setting_id', 15 );
    return $user_info;
}
function getTrailDate($date,$this_db){

    $tbl_setting = $this_db->where('setting_key','days')->get('tbl_setting')->row();
    $duration = $tbl_setting->setting_value;
    $trail_start_date = date('Y-m-d',$date);
    $trail_end_date  = date('Y-m-d', strtotime('+'.$duration.' days', strtotime($trail_start_date)));
    $today = date('Y-m-d');
    $trail_days = $trail_end_date - $trail_start_date;
    $diff = strtotime($trail_end_date) - strtotime($today);
    $days = $diff/(60*60*24);
    // $diff = abs(strtotime($trail_end_date) - strtotime($today));
    // $years = floor($diff / (365*60*60*24));
    // $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    // $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    return $days;

}

