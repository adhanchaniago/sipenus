<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends Admin_Controller {

	private $pageCurrent = 'admin/mahasiswa';
    private $pageTitle = 'Manajemen Mahasiswa';
	private $pageTitleSub = 'Data Mahasiswa';
	private $pageContent = 'Mahasiswa';
	
	public function __construct()
    {
        parent::__construct();
        $this->load->model(
            array(
                'user',
            )
		);
		error_reporting(0);
    }

	public function index()
	{
		$csRole['role'] = 2;
		$data['pageCurrent'] = $this->pageCurrent;
		$data['pageTitle'] = $this->pageTitle;
		$data['pageTitleSub'] = $this->pageTitleSub;
		$data['pageContent'] = $this->pageContent;
		$data['collageStudents'] = $this->user->getWhere($csRole);
		$data['genders'] = [
			[
				'name' => 'Perempuan',
				'label' => 'warning'
			],
			[
				'name' => 'Laki-laki',
				'label' => 'primary'
			]
		];
		
		$this->load->view('includes/header');
		$this->load->view('includes/navbar');
		$this->load->view('includes/sidebar');
		$this->load->view('pages/admin/collage_student', $data);
		$this->load->view('includes/footer');
	}

	public function create() 
	{
		if ($this->input->post() != null) {
			$input['uid'] = $this->input->post('nim');
			$input['email'] = $this->input->post('email');
			$input['password'] = sha1(md5($this->input->post('password')));
			$input['first_name'] = $this->input->post('first_name');
			$input['last_name'] = $this->input->post('last_name');
			$input['gender'] = $this->input->post('gender');
			$input['phone'] = $this->input->post('phone');
			$input['role'] = 2;
			$this->user->insert($input);
			$this->session->set_flashdata('alert', $this->alert->set_alert_dialog(Alert::SUCCESS, "Data Berhasil Ditambahkan"));
			redirect($this->pageCurrent, 'refresh');
		}
		else {
			$this->session->set_flashdata('alert', $this->alert->set_alert_dialog(Alert::DANGER, "Terjadi Kesalahan"));
			redirect($this->pageCurrent, 'refresh');
		}
	}

	public function destroy($id) 
	{
		if($id == null){
            redirect($this->pageCurrent);
        }

        $collageStudent['id'] = $id;

		$delete = $this->user->delete($collageStudent);
		
        if($delete != false){
            $this->session->set_flashdata('alert', $this->alert->set_alert_dialog(Alert::SUCCESS, 'Data Berhasil Dihapus'));
            redirect($this->pageCurrent);
        }
        else{
            $this->session->set_flashdata('alert', $this->alert->set_alert_dialog(Alert::DANGER, 'Terjadi Kesalahan'));
            redirect($this->pageCurrent);
        }
	}
}

?>
