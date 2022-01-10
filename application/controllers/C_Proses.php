<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Proses extends CI_Controller {

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
	public function Read()
	{
		$data = array('success' => false ,'message'=>array(),'data' => array());

		$id = $this->input->post('id');

		$SQL = "SELECT 
					b.ID,b.NamaPerusahaa,
					SUM(CASE WHEN a.KodeKriteria = 2 THEN a.Nilai ELSE 0 END) Aset,
					SUM(CASE WHEN a.KodeKriteria = 3 THEN a.Nilai ELSE 0 END) OmsetperTahun,
					SUM(CASE WHEN a.KodeKriteria = 4 THEN a.Nilai ELSE 0 END) JumlahTenagaKerja
				FROM tnilai a
				LEFT JOIN tumkm b on a.KodeUMKM = b.ID
				GROUP BY b.ID";

		$rs = $this->db->query($SQL);

		if ($rs->num_rows()>0) {
			$data['success'] = true;
			$data['data'] = $rs->result();
		}
		else{
			$data['message'] = 'No Record Found';
		}
		echo json_encode($data);
	}
	public function CRUD()
	{
		$data = array('success' => false ,'message'=>array());
		$NamaPerusahaa = $this->input->post('NamaPerusahaa');
		$NamaPemilik = $this->input->post('NamaPemilik');
		$Alamat = $this->input->post('Alamat');
		$GPS = $this->input->post('GPS');
		$JenisUsaha = $this->input->post('JenisUsaha');
		$Pemasaran = $this->input->post('Pemasaran');

		// $exploder = explode("|",$ItemGroup[0]);

		$id = $this->input->post('id');
		$formtype = $this->input->post('formtype');

		$param = array(
			'NamaPerusahaa' => $NamaPerusahaa,
			'NamaPemilik' 	=> $NamaPemilik,
			'Alamat' 		=> $Alamat,
			'GPS' 			=> $GPS,
			'JenisUsaha' 	=> $JenisUsaha,
			'Pemasaran' 	=> $Pemasaran
		);
		if ($formtype == 'add') {
			$this->db->trans_begin();
			try {
				$call_x = $this->ModelsExecuteMaster->ExecInsert($param,'tumkm');
				if ($call_x) {
					$this->db->trans_commit();
					$data['success'] = true;
				}
				else{
					$data['message'] = "Gagal Input Role";
					goto jump;
				}
			} catch (Exception $e) {
				jump:
				$this->db->trans_rollback();
				// $data['success'] = false;
				// $data['message'] = "Gagal memproses data ". $e->getMessage();
			}
		}
		elseif ($formtype == 'edit') {
			try {
				$rs = $this->ModelsExecuteMaster->ExecUpdate($param,array('id'=> $id),'tumkm');
				if ($rs) {
					$data['success'] = true;
				}
			} catch (Exception $e) {
				$data['success'] = false;
				$data['message'] = "Gagal memproses data ". $e->getMessage();
			}
		}
		elseif ($formtype == 'delete') {
			try {
				$SQL = "DELETE FROM tumkm WHERE ID = ".$id;
				$rs = $this->db->query($SQL);
				if ($rs) {
					$data['success'] = true;
				}
			} catch (Exception $e) {
				$data['success'] = false;
				$data['message'] = "Gagal memproses data ". $e->getMessage();
			}
		}
		else{
			$data['success'] = false;
			$data['message'] = "Invalid Form Type";
		}
		echo json_encode($data);
	}
	public function getHasil()
	{
		$SQL = "SELECT * FROM hasil a
				LEFT JOIN tumkm b on LOWER(REPLACE(a.NamaAnggota,' ','')) = LOWER(REPLACE(b.NamaPerusahaa,' ',''))
				WHERE a.Sts = 1";
		$rs = $this->db->query($SQL);
		$marker = [];
		foreach ($rs->result() as $key) {
			$currentData = array('node'=>'','lat'=>'','lng'=>'','nama'=>'','NamaAnggota'=>'','NamaPemilik'=>'','anggota' => 0,'Pemasaran' => '');
			$x = explode(',', $key->GPS);

			$currentData['Alamat'] = $key->Alamat;
			$currentData['lat'] =  $x[0];
			$currentData['lng'] = $x[1];
			$currentData['nama'] =  $key->NamaPerusahaa;
			$currentData['NamaAnggota']= $key->NamaAnggota;
			$currentData['NamaPemilik'] = $key->NamaPemilik;
			$currentData['anggota'] = $key->Keanggotaan;
			$currentData['Pemasaran'] = $key->Pemasaran;
			array_push($marker, $currentData);
		}
		echo json_encode($marker);
	}
	public function GetGraph()
	{
		$marker = array('id' => '','awal' => '','akhir'=>'','arah'=>'','arah_jalan'=>'','jarak'=>'');
		echo json_encode($marker);
	}
}
