<?php

function get_question_tutorial($question_id)
{
    $ci =& get_instance();
    $ci->load->model('tutor_model');
    $tutorialInfo = $ci->tutor_model->getInfo('tbl_question_tutorial', 'question_id', $question_id);

    if (!empty($tutorialInfo))
    {
        return true;
    }else
    {
        return false;
    }
}