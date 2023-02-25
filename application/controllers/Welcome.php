<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('userType');
        if ($user_id != null && $user_type != null) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $this->load->model('FaqModel');
        $data['allFaqs'] = $this->FaqModel->allFaqs();

        $_SESSION['prevUrl'] = $_SESSION['prevUrl'] = base_url('/');


        $data['header'] = $this->load->view('common/header', '', true);
        $data['menu'] = $this->load->view('menu', '', true);
        $data['footer_link'] = $this->load->view('common/footer_link', '', true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $this->load->view('index', $data);
    }

    public function vdHowItWorks()
    {
        $this->load->model('FaqModel');
        $data['video_help'] = $this->FaqModel->videoSerialize(11, 'video_helps'); //rakesh
        $data['video_help_serial'] = 11;

        $data['page_title'] = '.:: Q-Study :: Tutor yourself...';
        $data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        $data['header'] = $this->load->view('dashboard_template/header', $data, true);
        $data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);
        
        $data['maincontent'] = $this->load->view('howWorkVd', $data, true);
        $this->load->view('master_dashboard', $data);
    }
}
