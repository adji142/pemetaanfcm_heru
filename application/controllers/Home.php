<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelsExecuteMaster');
		$this->load->model('GlobalVar');
		$this->load->model('Apps_mod');
		$this->load->model('LoginMod');
	}
	public function index()
	{
		$this->load->view('Dashboard');
	}
	// --------------------------------------- Master ----------------------------------------------------
	public function jenisusaha()
	{
		$this->load->view('jenisusaha');
	}
	public function umkm()
	{
		$this->load->view('umkm');
	}
	public function kriteria()
	{
		$this->load->view('kriteria');
	}
	public function proses()
	{
		$this->load->view('proses');
	}
	public function nilai()
	{
		$this->load->view('nilai');
	}
	public function Login()
	{
		$this->load->view('Index');
	}
	public function profil()
	{
		$this->load->view('profile');
	}
	public function daftar()
	{
		$this->load->view('daftar');
	}
}
