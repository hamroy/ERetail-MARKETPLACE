<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_dompetKu extends CI_Controller
{

	function __construct()

	{

		parent::__construct();
		$this->load->model('M_dompetall');
		$this->load->model('M_adminvoc');
		$this->load->model('M_dompetKu');
	}

	public function index()
	{


		if ($this->M_dompetKu->cek_pendatanTrue() == 1) {


			require APPPATH . "third_party/PHPEmailham/send_email.php";
			$send = new send_email();
			$ket = 'PENDAPATAN ATAS ID ' . $this->session->userdata('id_user') . ' MENGALAMI MASALAH {TRANSAKSI PENDAPATAN}';
			$send->send_mail('ilhamroyroy@gmail.com', $ket, 'bug - Pendapatan');
		}

		// die();

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

			$data = $this->Muser->getDataProfil();



			$job = $data['job'];
			$ni = $data['ni'];


			$data['l_dom'] = 'active';
			$data['l1'] = 'active';
			$data['idjov'] = 99;


			if (empty($job) or empty($ni) or !is_numeric($ni)) {

				$data['view'] = 'pages/admin/viewer/dompet/form_job';
			} else {

				$data['view'] = 'dompetKu/dompetInfo';
			}

			$this->load->view('pages/admin/beranda', $data);
		} else { ///pengan login

			$this->session->set_flashdata('pesan', 'Maaf, Anda harus login kembali .');

			redirect('Login');
		}
	}

	public function pindahKeDompet($id_user = 0)
	{
		if ($this->session->userdata('id_user') != $id_user) {
			# code...
			redirect('login');
		}

		if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {
			$id_user = $this->session->userdata('id_user');
			$jv = $this->input->post('jvoc');
			///

			$gv = $this->M_gvocall->gvall($jv, $id_user);  ///0 = e makan
			$id_voc = $gv['id_voc'];
			$saldo_tran = $gv['saldo'];
			if ($saldo_tran < 1) {
				redirect($this->M_setapp->urlBack());
			}
			$idtasasl = $this->M_vparsel->get_saldo_voc_makan_iduser($id_user, $id_voc)->row()->id;
			$d = [
				'proses' => 1, //pindah dompet (bisa di belanjakan)
				'saldo_terima' => $saldo_tran, //pindah dompet (bisa di belanjakan)
			];
			$addDurasi = $this->M_dompetKu->getDataDompetPerakun($id_user)['addDurasi'];
			$durasi = $this->M_time->tgl_ymd(); //data ada durasi tetap
			$d_durasi = [
				'proses' => 1,
				'id_user' => $id_user,
				'tgl_t' => $this->M_time->harinow(),
				'durasi' => $durasi,
				'addDurasi' => $addDurasi + 30,
				'status' => 1, //=aktif
				'fasRedeem' => 1, //=aktif
			];
			// print_r($d);
			// die();

			//jika sudah di pindah ke dompet maka
			$a = $this->M_dompetKu->getSaldoVocAll($id_user, $jv, $id_voc, 0);
			$b = $this->M_dompetKu->getSaldoVocAll($id_user, $jv, $id_voc, 1);
			if ($a->num_rows() >= 1) {
				if ($b->num_rows() == 0) {

					$this->M_dompetKu->saveDataDompetPerakun($d_durasi);
					$this->M_dompetKu->terimaDompetPidahVoucher($id_user, $jv, $id_voc, $d);
					$this->session->set_flashdata('pesan', 'Voucher E-Retail berhasil dipindah ke DOMPET E-Retail  ');
				}
			} else {
				$this->M_adminvoc->save_tbl_saldovoc($idtasasl, $jv, $id_voc, $id_user, $saldo_tran);
			}


			redirect($this->M_setapp->urlBack());
		}
	}
} //class
