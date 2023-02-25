<?php

class Error_Page extends CI_Controller{
    
    public function index() {
        $this->load->view('error/error_404');
    } 
}
