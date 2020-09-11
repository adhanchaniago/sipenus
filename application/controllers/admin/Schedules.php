<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Schedules extends Admin_Controller {

	private $pageCurrent = 'admin/schedules';
    private $pageTitle = 'Manajemen Pengajuan Jadwal';
	private $pageTitleSub = 'Data Pengajuan';
	private $pageContent = 'Pengajuan';

	public function __construct()
    {
        parent::__construct();
        $this->load->model(
            array(
				'user',
				'schedule'
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

	public function request() 
	{
		$data['pageCurrent'] = $this->pageCurrent."/request";
		$data['pageTitle'] = $this->pageTitle;
		$data['pageTitleSub'] = $this->pageTitleSub;
		$data['pageContent'] = $this->pageContent;
		$data['schedules'] = $this->schedule->get(0);
		print_r($data['schedules']);
		exit;
		$data['genders'] = [
			[
				'name' => 'Perempuan',
				'label' => 'primary'
			],
			[
				'name' => 'Laki-laki',
				'label' => 'default'
			]
		];
		$data['minithesisCategory'] = [
			[],
			[
				'name' => 'Proposal',
				'label' => 'warning'
			],
			[
				'name' => 'Hasil',
				'label' => 'success'
			],
			[
				'name' => 'Skripsi',
				'label' => 'danger'
			]
		];

		// print_r($data['schedules']);
		// exit;

		$this->load->view('includes/header');
		$this->load->view('includes/navbar');
		$this->load->view('includes/sidebar');
		$this->load->view('pages/admin/schedules/request', $data);
		$this->load->view('includes/footer');
	}

	public function confirm($id) 
	{
		if($id == null){
            redirect($this->pageCurrent);
		}
		
		echo "Mantap Bosku $id";
	}
}

?>
