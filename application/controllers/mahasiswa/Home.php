<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends College_Student_Controller {

	private $pageCurrent = 'mahasiswa';
    private $pageTitle = 'Beranda';
	private $pageTitleSub = 'Data Tugas Akhir';
	private $pageContent = 'Beranda';

	public function __construct()
    {
        parent::__construct();
        $this->load->model(
            array(
				'user',
				'minithesis'
            )
		);
		error_reporting(0);
    }

	public function index()
	{
		$idUser = $this->session->userdata("id");
		$checkExistingData = $this->minithesis->getMinithesisById($idUser);

		if ($this->input->post() != null) {

			// Start Form Validation
			$this->form_validation->set_rules('title','Judul','required', array(
				'required' => '*) Masukkan <b>Judul</b>'
			));
			$this->form_validation->set_rules('guide1','Dosen Pembimbing 1','required', array(
				'required' => '*) Masukkan <b>Dosen Pembimbing 1</b>'
			));
			$this->form_validation->set_rules('guide2','Judul','required', array(
				'required' => '*) Masukkan <b>Dosen Pembimbing 2</b>'
			));
			$this->form_validation->set_rules('examiner1','Judul','required', array(
				'required' => '*) Masukkan <b>Dosen Penguji 1</b>'
			));
			$this->form_validation->set_rules('examiner2','Judul','required', array(
				'required' => '*) Masukkan <b>Dosen Penguji 2</b>'
			));
			$this->form_validation->set_rules('examiner3','Judul','required', array(
				'required' => '*) Masukkan <b>Dosen Penguji 3</b>'
			));
			// End Form Validation

			// Check Validation
			if ($this->form_validation->run() === TRUE) {
				// Check Existing Data
				if ($checkExistingData) {
					$input['title'] = $this->input->post('title');
					$input['guide_one'] = $this->input->post('guide1');
					$input['guide_two'] = $this->input->post('guide2');
					$input['examiner_one'] = $this->input->post('examiner1');
					$input['examiner_two'] = $this->input->post('examiner3');
					$input['examiner_three'] = $this->input->post('examiner2');

					$this->minithesis->update($idUser, $input);
				}
				else {
					$input['collage_student_id'] = $idUser;
					$input['title'] = $this->input->post('title');
					$input['guide_one'] = $this->input->post('guide1');
					$input['guide_two'] = $this->input->post('guide2');
					$input['examiner_one'] = $this->input->post('examiner1');
					$input['examiner_two'] = $this->input->post('examiner3');
					$input['examiner_three'] = $this->input->post('examiner2');

					$this->minithesis->insert($input);
				}

				$this->session->set_flashdata('alert', $this->alert->set_alert_dialog(Alert::SUCCESS, "Data Berhasil Disimpan"));
				redirect($this->pageCurrent, 'refresh');

			} 
			else {
                $this->session->set_flashdata('alert', $this->alert->set_alert_dialog(Alert::DANGER, "Data Gagal Diperbarui"));
			}
		}
		
		$data['pageCurrent'] = $this->pageCurrent;
		$data['pageTitle'] = $this->pageTitle;
		$data['pageTitleSub'] = $this->pageTitleSub;
		$data['pageContent'] = $this->pageContent;
		$data['minithesis'] = $checkExistingData;

		$this->load->view('includes/header');
		$this->load->view('includes/navbar');
		$this->load->view('includes/sidebar');
		$this->load->view('pages/collage_student/home', $data);
		$this->load->view('includes/footer');
	}

}

?>
