<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Schedules extends College_Student_Controller {

	private $pageCurrent = 'mahasiswa/schedules';
    private $pageTitle = 'Pengajuan Jadwal Ujian';
	private $pageTitleSub = 'Data Pengajuan';
	private $pageContent = 'Pengajuan Jadwal';

	public function __construct()
    {
        parent::__construct();
        $this->load->model(
            array(
				'user',
				'minithesis',
				'schedule'
            )
		);
		error_reporting(0);
    }

	public function index()
	{
		$idUser = $this->session->userdata("id");

		$data['pageCurrent'] = $this->pageCurrent;
		$data['pageTitle'] = $this->pageTitle;
		$data['pageTitleSub'] = $this->pageTitleSub;
		$data['pageContent'] = $this->pageContent;
		$data['minithesis'] = $this->minithesis->getMinithesisById($idUser);
		if ($data['minithesis']) {
			$data['schedule'] = $this->minithesis->getScheduleByMinithesis($data['minithesis'][0]->id);
		}
		else {
			$this->session->set_flashdata('alert', $this->alert->set_alert_dialog(Alert::DANGER, "Lengkapi Terlebih Dahulu Data Dibawah Ini"));
			redirect('mahasiswa', 'refresh');
		}

		$this->load->view('includes/header');
		$this->load->view('includes/navbar');
		$this->load->view('includes/sidebar');
		$this->load->view('pages/collage_student/schedule', $data);
		$this->load->view('includes/footer');
	}

	public function submission($submission = null) 
	{
		if ($submission == null) {
            redirect($this->pageCurrent);
		}

		$idUser = $this->session->userdata("id");
		$data['minithesis'] = $this->minithesis->getMinithesisById($idUser);

		if ($submission == 1) {
			$input['category_id'] = 1;
			$input['minithesis_id'] = $data['minithesis'][0]->id;
			$input['upload_at'] = date('Y-m-d H:i:s');
			$input['status'] = 0;

			$this->schedule->insertSchedule($input);

			$this->session->set_flashdata('alert', $this->alert->set_alert_dialog(Alert::SUCCESS, "Jadwal Telah Diajukan, Silahkan Menunggu Jadwal Yang Akan Diberikan"));
			redirect($this->pageCurrent, 'refresh');
		}
		if ($submission == 2) {

		}
		if ($submission == 3) {

		}
	}

}

?>
