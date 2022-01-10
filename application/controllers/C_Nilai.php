<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Nilai extends CI_Controller {

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

		if ($id == '') {
			$SQL = "SELECT a.*,b.NamaPerusahaa,c.NamaKriteria FROM tnilai a
					LEFT JOIN tumkm b on a.KodeUMKM = b.ID
					LEFT JOIN tkriteria c on a.KodeKriteria = c.ID ";
			$rs = $this->db->query($SQL);
		}
		else{
			$rs = $this->ModelsExecuteMaster->FindData(array('Indexs'=>$id),'tnilai');
		}

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
		$KodeUMKM = $this->input->post('KodeUMKM');
		$KodeKriteria = $this->input->post('KodeKriteria');
		$Nilai1 = $this->input->post('Nilai1');
		$Nilai2 = $this->input->post('Nilai2');
		$Nilai3 = $this->input->post('Nilai3');
		$index = $this->input->post('id');
		// $exploder = explode("|",$ItemGroup[0]);

		$id = $this->input->post('id');
		$formtype = $this->input->post('formtype');

		$param = array(
			'KodeUMKM' => $KodeUMKM,
			'KodeKriteria' => 2,
			'Nilai' => $Nilai1,
			'Indexs' => $index
		);
		$param1 = array(
			'KodeUMKM' => $KodeUMKM,
			'KodeKriteria' => 3,
			'Nilai' => $Nilai2,
			'Indexs' => $index
		);
		$param2 = array(
			'KodeUMKM' => $KodeUMKM,
			'KodeKriteria' => 4,
			'Nilai' => $Nilai3,
			'Indexs' => $index
		);
		if ($formtype == 'add') {
			$this->db->trans_begin();
			try {
				$call_x = $this->ModelsExecuteMaster->ExecInsert($param,'tnilai');
				$call_x = $this->ModelsExecuteMaster->ExecInsert($param1,'tnilai');
				$call_x = $this->ModelsExecuteMaster->ExecInsert($param2,'tnilai');
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
			$SQL = $this->db->query("SELECT * FROM tnilai WHERE Indexs = '".$id."' ORDER BY KodeKriteria");

			$x = 1;
			$Nilai = 0;
			foreach ($SQL->result() as $key) {
				if ($x == 1) {
					$Nilai = $Nilai1;
				}
				elseif ($x == 2) {
					$Nilai = $Nilai2;
				}
				elseif ($x == 3) {
					$Nilai = $Nilai3;
				}

				try {
					$rs = $this->ModelsExecuteMaster->ExecUpdate(array('KodeUMKM'=>$KodeUMKM,'KodeKriteria'=> $key->KodeKriteria,'Nilai'=>$Nilai),array('id'=> $key->ID),'tnilai');
					if ($rs) {
						$data['success'] = true;
					}
				} catch (Exception $e) {
					$data['success'] = false;
					$data['message'] = "Gagal memproses data ". $e->getMessage();
				}
				$x += 1;
			}
		}
		elseif ($formtype == 'delete') {
			try {
				$SQL = "DELETE FROM tnilai WHERE Indexs = ".$id;
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


}
