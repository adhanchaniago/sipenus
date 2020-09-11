<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(
            array(
                'user',
            )
        );
        $this->load->library(
            array(
                'form_validation'
            )
        );
    }

	public function index()
	{
		// echo sha1(md5("password"));
		// exit;
		// Start Validation
        $this->form_validation->set_rules(
            'username',
            'Email',
            'required|trim',
            array(
                'required' => '*) Masukkan Email Anda',
                'trim' => '*) Masukkan Username dengan Benar'
            )
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[6]',
            array(
                'required' => '*) Masukkan Password Anda',
                'min_length' => '*) Password Minimal 6 Karakter'
            )
        );
        // End Validation

        if ($this->form_validation->run() == true) {
            $uid = $this->input->post('username');
            $password = sha1(md5($this->input->post('password')));

            $result = $this->user->auth_login($uid, $password);

            if (!empty($result) && count($result) > 0)
            {
                $data_session = array(
                    'id' => $result->id,
                    'email' => $result->email,
                    'nim' => $result->uid,
                    'password' => $result->password,
                    'first_name' => $result->first_name,
                    'last_name' => $result->last_name,
                    'full_name' => $result->first_name." ".$result->last_name,
                    'role' => $result->role
                );

                $this->session->set_userdata($data_session);

                if ($result->role == 1) {
                    redirect('admin/');
                }
                else {
                    redirect('mahasiswa/');
                }

            }
            else
            {
                $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, "Login Gagal, NIM atau Password Tidak Valid"));
                redirect('/', 'refresh');
            }
        }
        else {
            $this->load->view('auth/login');
        }
	}

	public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }

}
?>
