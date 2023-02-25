<?php

class MathXml extends CI_Controller
{

    public function __construct()
    {
		 parent::__construct();
    }
    public function MathXmlView()
    {

        //$data['page_title'] = '.:: Q-Study :: Tutor yourself...';

        //$data['headerlink'] = $this->load->view('dashboard_template/headerlink', $data, true);
        //$data['header'] = $this->load->view('dashboard_template/header', $data, true);
        //$data['footerlink'] = $this->load->view('dashboard_template/footerlink', $data, true);

        //$data['maincontent'] = $this->load->view('admin/admin_dashboard', $data, true);
        //$this->load->view('master_dashboard', $data);
		$this->load->view('math-view');
    }
}