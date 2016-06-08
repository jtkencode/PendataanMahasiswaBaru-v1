<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->model('agama_model');
		$this->load->model('jalur_penerimaan_model');
		$this->load->model('program_studi_model');
		$this->load->model('mahasiswa_model');
	}

	public function index()
	{
		$data['kv_agama'] = $this->agama_model->get_all_kv();
		$data['kv_jalur_masuk'] = $this->jalur_penerimaan_model->get_all_kv(date('Y'));
		$data['kv_program_studi'] = $this->program_studi_model->get_all_kv();

		$data['kv_jenis_kelamin']['L'] = 'Laki-laki';
		$data['kv_jenis_kelamin']['P'] = 'Perempuan';

		if ($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			$this->load->view('Mahasiswa/index', $data);
		}
		else
		{
			$this->mahasiswa_model->insert_from_input();
			redirect('mahasiswa/success');
		}
	}

	public function success()
	{
		$this->load->view('Mahasiswa/success');
	}
}