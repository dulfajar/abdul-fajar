<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/Login.php");

class HR extends Login
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->Model('Manager');
		$this->load->Model('Kriteria');
		$this->load->Model('KriteriaB');
		$this->load->Model('KriteriaO');
		$this->load->Model('Nilai');
		$this->load->Model('Ankrit');
		$this->load->Model('AKKB');
		$this->load->Model('AKOP');
		$this->load->Model('Anab');
		$this->load->Model('Detkar');
		$this->load->Model('Abkar');
		$this->load->Model('Users');
		$this->load->Model('Absen');
		if (!$this->session->userdata('logged')) {
			redirect('login/index');
		} else if (($this->session->userdata('logged')['level'] != '1') && ($this->session->userdata('logged')['divisi'] != 'HR-GA')) {
			redirect('assessors/index');
		}
	}


	// testing room
	public function toJSON()
	{
		header('Content-Type: application/json');
		$datA = $this->Manager->gettenup('Staff');
		print json_encode($datA);
	}
	public function toJSONII()
	{
		header('Content-Type: application/json');
		$datB = $this->Manager->gettenup('Manajer');
		print json_encode($datB);
	}
	public function toJSONIII()
	{
		header('Content-Type: application/json');
		$datC = $this->Manager->gettenup('Kabid');
		print json_encode($datC);
	}
	public function toJSONIV()
	{
		header('Content-Type: application/json');
		$datD = $this->Manager->gettenup('Pengawas');
		print json_encode($datD);
	}
	public function toJSONV()
	{
		header('Content-Type: application/json');
		$datE = $this->Manager->gettenup('Kashift');
		print json_encode($datE);
	}
	public function toJSONVI()
	{
		header('Content-Type: application/json');
		$datF = $this->Manager->gettenup('Operator');
		print json_encode($datF);
	}
	public function viewchart()
	{
		$this->load->view('view-chart');
	}
	// end testing room

//pindah halaman
	public function index()
	{
		$data['data_kriteria'] = $this->Kriteria->get_asc();
		$this->load->view('kriteria/view-kriteria', $data);
	}
	public function page2()
	{
		$data2['data_kriteria'] = $this->Kriteria->get_data();
		$this->load->view('nilai-kriteria/read-nilai', $data2);
	}
	public function page2_kb()
	{
		$data2['data_kriteria'] = $this->KriteriaB->get_data();
		$this->load->view('nilai-kriteria/read-kriteria-b', $data2);
	}
	public function page2_op()
	{
		$data2['data_kriteria'] = $this->KriteriaO->get_data();
		$this->load->view('nilai-kriteria/read-kriteria-o', $data2);
	}
	public function page3()
	{
		$this->load->view('karyawan/data-karyawan-man.php');
	}
	public function plusid()
	{
		$this->load->view('kriteria/baru-kriteria');
	}

	public function addkrit_pg()
	{
		$data['data'] = $this->Kriteria->getIDBaru();
		$this->load->view('kriteria/tambah-kriteria', $data);
	}
	public function chkrit_pg($idk)
	{
		$data['ubah'] = $this->Kriteria->get_id($idk);
		$this->load->view('kriteria/edit-kriteria', $data);
	}
	public function adperson_pg()
	{
		$data['data'] = $this->Manager->getIDBaru();
		$this->load->view('karyawan/tambah-karyawan', $data);
	}
	public function chperson_pg($idg)
	{
		$data['ubah'] = $this->Manager->get_id($idg);
		$this->load->view('karyawan/ubah-karyawan', $data);
	}
	public function person_rank()
	{
		$this->load->view('karyawan/ranking-karyawan');
	}
	public function rank($value)
	{
		$data['nilK'] = $this->Manager->get_id($value);
		$this->load->view('karyawan/nilai/nilai-karyawan-edit', $data);
	}
	public function rankn($value)
	{
		$data['nilK'] = $this->Manager->get_id($value);
		$this->load->view('karyawan/nilai/nilai-karyawan-man', $data);
	}
	public function add_user()
	{
		$this->load->view('users/tambah');
	}
	public function shw_user()
	{
		$data['users'] = $this->Users->get_byL();
		$this->load->view('users/read', $data);
	}
	public function chuser($idU)
	{
		$data['usub'] = $this->Users->get_user($idU);
		$this->load->view('users/ubah', $data);
	}
	public function finalView()
	{
		$this->load->view('karyawan/final-karyawan');
	}
// showTBAn
	public function tabelAnalisa()
	{
		$datb['tabel'] = $this->Ankrit->get_data();
		$this->load->view('nilai-kriteria/calculate-table', $datb);
	}
	public function tabelAnalisaKb()
	{
		$datb['tabel'] = $this->AKKB->get_data();
		$this->load->view('nilai-kriteria/cal-tab-kb', $datb);
	}
	public function tabelAnalisaOp()
	{
		$datb['tabel'] = $this->AKOP->get_data();
		$this->load->view('nilai-kriteria/cal-tab-op', $datb);
	}
// showTBAb
	public function tabelAbsen()
	{
		$datb['tabel'] = $this->Anab->get_data();
		$this->load->view('nilai-absen/calculate-table', $datb);
	}

	public function karyawanku()
	{
		$this->load->view('karyawan/data-rs-man');
	}
	public function karyawanJ($idJ)
	{
		$idD = $this->session->userdata('logged')['divisi'];
		$data['karyawan'] = $this->Manager->get_by_jd($idJ, $idD);
		$this->load->view('karyawan/data/karyascman', $data);
	}
	public function karyawanNJ()
	{

		$data['karyawan'] = $this->Manager->get_data();
		$this->load->view('karyawan/data/karyascman', $data);
	}

	//ranking-karyawan
	public function shw()
	{
		$data['raK'] = $this->KriteriaO->get_data();
		$this->load->view('karyawan/persons/kary', $data);
	}
	public function allKar()
	{
		$data['raK'] = $this->KriteriaO->get_data();
		$this->load->view('karyawan/persons/allkary', $data);
	}
	public function man()
	{
		$data['raK'] = $this->Kriteria->get_data();
		$this->load->view('karyawan/persons/man', $data);
	}
	public function kbid()
	{
		$data['raK'] = $this->KriteriaB->get_data();
		$this->load->view('karyawan/persons/kabid', $data);
	}
	public function pengawas()
	{
		$data['raK'] = $this->KriteriaB->get_data();
		$this->load->view('karyawan/persons/pengawas', $data);
	}
	public function staff()
	{
		$data['raK'] = $this->KriteriaB->get_data();
		$this->load->view('karyawan/persons/staff', $data);
	}
	public function kshift()
	{
		$data['raK'] = $this->KriteriaO->get_data();
		$this->load->view('karyawan/persons/kshift', $data);
	}


	//finalresuls:')
	public function rka($idJ, $idD)
	{
		$idJ = $this->uri->segment(3);
		$idD = $this->uri->segment(4);
		$data['finKa'] = $this->Manager->get_by_jd($idJ, $idD);
		// $this->load->view('karyawan/ranking/kary-spec',$data);
		$this->load->view('karyawan/ranking/kary1', $data);
	}
	public function rkj($idJ)
	{
		$data['finKa'] = $this->Manager->get_by_jonly($idJ);
		// $this->load->view('karyawan/ranking/kary',$data);
		$this->load->view('karyawan/ranking/kary1', $data);
	}
	public function rkjAll()
	{
		$data['finKa'] = $this->Manager->get_by_jonlyAll();
		// $this->load->view('karyawan/ranking/kary',$data);
		$this->load->view('karyawan/ranking/kary1', $data);
	}
	public function allRK()
	{
		$data['finKa'] = $this->Manager->get_try();
		$this->load->view('karyawan/ranking/kary1', $data);
	}
	public function dataK()
	{
		$data['karyawan'] = $this->Manager->get_AllKar();
		$this->load->view('karyawan/data/kary-man', $data);
	}
	public function dataKDJ($idJ, $idD)
	{
		$idJ = $this->uri->segment(3);
		$idD = $this->uri->segment(4);
		$data['karyawan'] = $this->Manager->get_by_jd($idJ, $idD);
		$this->load->view('karyawan/data/kary-man', $data);
	}
	public function dataKJ($idJ)
	{
		$data['karyawan'] = $this->Manager->get_by_jnoOR($idJ);
		$this->load->view('karyawan/data/kary-man', $data);
	}
	public function dataKD($idD)
	{
		$data['karyawan'] = $this->Manager->get_by_dnoMANOR($idD);
		$this->load->view('karyawan/data/kary-man', $data);
	}




//fungsi
	public function updateNiFi()
	{
		$idkr = $_POST['idK'];
		$nakr = $_POST['totalakhir'];
		foreach ($idkr as $ide => $al) {
			$datc = array(
				'final_nilai' => $nakr[$ide],
			);
			$this->Manager->updateMan(array('id_karyawan' => $al), $datc);
		}
		redirect('HR/person_rank');
	}
	public function updateKriteria()
	{
		$idKr = $this->input->post('id_kriteria');
		$nmKr = $this->input->post('nama_kriteria');
		$ks = $this->input->post('kurang_sekali');
		$k = $this->input->post('kurang');
		$c = $this->input->post('cukup');
		$b = $this->input->post('baik');
		$bs = $this->input->post('baik_sekali');
		$data = array(
			'nama_kriteria' => $nmKr,
			'ket_nil1' => $ks,
			'ket_nil2' => $k,
			'ket_nil3' => $c,
			'ket_nil4' => $b,
			'ket_nil5' => $bs,
		);
		$update = $this->Kriteria->updateKrit(array('id_kriteria' => $idKr), $data);
		redirect('HR/index');
	}
	public function updNiQa()
	{
		$idQ = $this->input->post('idqar');
		$this->Detkar->deltabID($idQ);
		$cRQ = $_POST['C'];
		$nLQ = $_POST['KR'];
		$niQ = $this->input->post('total');
		$data = array(
			'nilai' => $niQ,
		);
		$update = $this->Manager->updateMan(array('id_karyawan' => $idQ), $data);
		foreach ($cRQ as $Kr => $v) {
			$datb = array(
				'id_kriteria' => $v,
				'id_karyawan' => $idQ,
				'nilai_kriteria' => $nLQ[$Kr]
			);
			$this->Detkar->insertArray($datb);
		}
		redirect('HR/page3');
	}
	//FOR KARYAWANKU
	public function updNiQaku()
	{
		$idQ = $this->input->post('idqar');
		$this->Detkar->deltabID($idQ);
		$cRQ = $_POST['C'];
		$nLQ = $_POST['KR'];
		$niQ = $this->input->post('total');
		$data = array(
			'nilai' => $niQ,
		);
		$update = $this->Manager->updateMan(array('id_karyawan' => $idQ), $data);
		foreach ($cRQ as $Kr => $v) {
			$datb = array(
				'id_kriteria' => $v,
				'id_karyawan' => $idQ,
				'nilai_kriteria' => $nLQ[$Kr]
			);
			$this->Detkar->insertArray($datb);
		}
		redirect('HR/karyawanku');
	}

// updateNIKR
	public function updateNiKr()
	{
		$idkr = $_POST['id_kriteria'];
		$nakr = $_POST['hasil'];
		foreach ($idkr as $ide => $al) {
			$datc = array(
				'jumlah_kriteria' => $nakr[$ide],
			);
			$this->Kriteria->updateKrit(array('id_kriteria' => $al), $datc);
		}
		$datb['tabel'] = $this->Ankrit->get_data();
		$this->load->view('nilai-kriteria/calculate-table', $datb);
	}
	public function updateNiKrB()
	{
		$idkr = $_POST['id_kriteria'];
		$nakr = $_POST['hasil'];
		foreach ($idkr as $ide => $al) {
			$datc = array(
				'jumlah_kriteria' => $nakr[$ide],
			);
			$this->KriteriaB->updateKrit(array('id_kriteria' => $al), $datc);
		}
		$datb['tabel'] = $this->AKKB->get_data();
		$this->load->view('nilai-kriteria/cal-tab-kb', $datb);
	}
	public function updateNiKrO()
	{
		$idkr = $_POST['id_kriteria'];
		$nakr = $_POST['hasil'];
		foreach ($idkr as $ide => $al) {
			$datc = array(
				'jumlah_kriteria' => $nakr[$ide],
			);
			$this->KriteriaO->updateKrit(array('id_kriteria' => $al), $datc);
		}
		$datb['tabel'] = $this->AKOP->get_data();
		$this->load->view('nilai-kriteria/cal-tab-op', $datb);
	}
// end updateNIKR

// tabelKRIT
	public function showTabel()
	{
		$cleT = $this->Ankrit->clearTB();
		$crit = $_POST['C'];
		$opt = $_POST['W'];
		$crib = $_POST['X'];
		foreach ($crit as $key => $vl) {
			$data = array(
				'kriteria_x' => $vl,
				'nilai_krit' => $opt[$key],
				'kriteria_y' => $crib[$key]
			);
			$insert = $this->Ankrit->insertArray($data);
		}
		$datb['tabel'] = $this->Ankrit->get_data();
		$this->load->view('nilai-kriteria/calculate-table', $datb);
	}
	public function showTbKbid()
	{
		$cleT = $this->AKKB->clearTB();
		$crit = $_POST['C'];
		$opt = $_POST['W'];
		$crib = $_POST['X'];
		foreach ($crit as $key => $vl) {
			$data = array(
				'kriteria_x' => $vl,
				'nilai_krit' => $opt[$key],
				'kriteria_y' => $crib[$key]
			);
			$insert = $this->AKKB->insertArray($data);
		}
		$datb['tabel'] = $this->AKKB->get_data();
		$this->load->view('nilai-kriteria/cal-tab-kb', $datb);
	}
	public function showTbOp()
	{
		$cleT = $this->AKOP->clearTB();
		$crit = $_POST['C'];
		$opt = $_POST['W'];
		$crib = $_POST['X'];
		foreach ($crit as $key => $vl) {
			$data = array(
				'kriteria_x' => $vl,
				'nilai_krit' => $opt[$key],
				'kriteria_y' => $crib[$key]
			);
			$insert = $this->AKOP->insertArray($data);
		}
		$datb['tabel'] = $this->AKOP->get_data();
		$this->load->view('nilai-kriteria/cal-tab-op', $datb);
	}
// end tabelKRIT

	public function insertKriteria()
	{
		$crit = $this->input->post('id_kriteria');
		$nama = $this->input->post('nama_kriteria');
		$harga = 0;
		$data = array(
			'id_kriteria' => $crit,
			'nama_kriteria' => $nama,
			'jumlah_kriteria' => $harga,
		);
		$insert = $this->Kriteria->insertKriteria($data);
		$insert = $this->KriteriaB->insertKriteria($data);
		$insert = $this->KriteriaO->insertKriteria($data);
		redirect('HR/index');
	}
	public function updateUSR()
	{
		$idU = $this->input->post('id_user');
		$id = $this->input->post('username');
		$psw = $this->input->post('password');
		$hasap = hash('sha256', 'hu8945iot7gdreoi' . $psw . '94085ire8562ue');
		$jbt = $this->input->post('jabatan');
		$dvs = $this->input->post('divisi');
		$data = array(
			'username' => $id,
			'password' => $hasap,
			'divisi' => $dvs,
			'levels' => $jbt,
		);
		$update = $this->Users->updateMan(array('id_user' => $idU), $data);
		redirect('HR/shw_user');
	}
	public function updadpu()
	{
		$idU = $this->input->post('id_user');
		$id = $this->input->post('username');
		$psw = $this->input->post('password');
		$hasap = hash('sha256', 'hu8945iot7gdreoi' . $psw . '94085ire8562ue');
		$data = array(
			'username' => $id,
			'password' => $hasap,
		);
		$update = $this->Users->updateMan(array('id_user' => $idU), $data);
		redirect('HR/shw_user');
	}
	public function usr_add()
	{
		$adus = $this->input->post('username');
		$adpa = $this->input->post('password');
		$hasap = hash('sha256', 'hu8945iot7gdreoi' . $adpa . '94085ire8562ue');
		$adja = $this->input->post('jabatan');
		$addi = $this->input->post('divisi');
		$data = array(
			'username' => $adus,
			'password' => $hasap,
			'levels' => $adja,
			'divisi' => $addi
		);
		$insert = $this->Users->insertUsers($data);
		redirect('HR/shw_user');
	}
	public function delKrit($idKr)
	{
		$this->Kriteria->delKrit($idKr);
		redirect('HR/index');
	}
	public function resetall()
	{
		$nilaiR = array(
			'nilai' => 0,
			'absen' => 0,
			'final_nilai' => 0,
			'final_absen' => 0,
			'final_total' => 0
		);
		$this->Manager->resetN($nilaiR);
		redirect('HR/page3');
	}
	public function export(){
		include APPPATH.'third_party/PHPExcel.php';
    
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
	
			// Settingan awal fil excel
			$excel->getProperties()->setCreator('My Notes Code')
			->setLastModifiedBy('My Notes Code')
			->setTitle("Data Siswa")
			->setSubject("Siswa")
			->setDescription("Laporan Semua Data Siswa")
			->setKeywords("Data Siswa");
	// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
			$style_col = array(
				'font' => array('bold' => true), // Set font nya jadi bold
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
				),
				'borders' => array(
					'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
					'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
					'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
					'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
				)
			);
	// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
			$style_row = array(
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
				),
				'borders' => array(
					'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
					'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
					'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
					'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
				)
			);
			$excel->setActiveSheetIndex(0)->setCellValue('A3', "NILAI PERINGKAT KARYAWAN");
			$excel->setActiveSheetIndex(0)->setCellValue('A4', "PT JALIN PEMBAYARAN NUSANTARA"); // Set kolom A1 dengan tulisan "DATA SISWA"
			$excel->getActiveSheet()->mergeCells('A3:G3'); // Set Merge Cell pada kolom A1 sampai E1
			$excel->getActiveSheet()->mergeCells('A4:G4');
			$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true); // Set bold kolom A1
			$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
			$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true); // Set bold kolom A1
			$excel->getActiveSheet()->getStyle('A4')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
			$excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	// Buat header tabel nya pada baris ke 3
			$excel->setActiveSheetIndex(0)->setCellValue('A7', "NO"); // Set kolom A3 dengan tulisan "NO"
			$excel->setActiveSheetIndex(0)->setCellValue('B7', "NAMA KARYAWAN"); // Set kolom B3 dengan tulisan "NIS"
			$excel->setActiveSheetIndex(0)->setCellValue('C7', "JABATAN"); // Set kolom C3 dengan tulisan "NAMA"
			$excel->setActiveSheetIndex(0)->setCellValue('D7', "NILAI KINERJA"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
			$excel->setActiveSheetIndex(0)->setCellValue('E7', "NILAI ABSEN"); // Set kolom E3 dengan tulisan "ALAMAT"
			$excel->setActiveSheetIndex(0)->setCellValue('F7', "TOTAL NILAI");
			$excel->setActiveSheetIndex(0)->setCellValue('G7', "PERINGKAT KARYAWAN");
	// Apply style header yang telah kita buat tadi ke masing-masing kolom header
			$excel->getActiveSheet()->getStyle('A7')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('B7')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('C7')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('D7')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('E7')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('F7')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('G7')->applyFromArray($style_col);
	// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
			$siswa = $this->Manager->get_by_jonlyAll();
			$no=1;
			$numrow = 8; // Set baris pertama untuk isi tabel adalah baris ke 4
			foreach ($siswa as $data) { // Lakukan looping pada variabel siswa
				$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
				$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->nama_karyawan);
				$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->jabatan);
				$nilai_final= $data->final_nilai;
				$nilai_absen= $data->final_absen;
				$total_nilai = $nilai_final + $nilai_absen;
				$excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->final_nilai);
				$excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->final_absen);
				$excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $total_nilai);
				$excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $no);
	
	// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
				$excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
	
				$no++; // Tambah 1 setiap kali looping
				$numrow++; // Tambah 1 setiap kali looping
			}
	// Set width kolom
			$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
			$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
			$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
			$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
			$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
			$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom E
			$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
	
	// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
			$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
	// Set orientasi kertas jadi LANDSCAPE
			$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
	// Set judul file excel nya
			$excel->getActiveSheet(0)->setTitle("Laporan Peringkat Karyawan");
			$excel->setActiveSheetIndex(0);
	// Proses file excel
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="PeringkatKaryawan.xlsx"'); // Set nama file excel nya
			header('Cache-Control: max-age=0');
			$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			$write->save('php://output');
		
	}
}
