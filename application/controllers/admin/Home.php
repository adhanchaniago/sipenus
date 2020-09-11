<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(
            array(
                'user',
            )
        );
    }

	public function index()
	{
		$data['users'] = count($this->user->get());

		$this->load->view('includes/header');
		$this->load->view('includes/navbar');
		$this->load->view('includes/sidebar');
		$this->load->view('pages/admin/home', $data);
		$this->load->view('includes/footer');
	}
}

?>
