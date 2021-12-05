<?php



class Login_model extends CI_Model
{



	var $table = 'ueu_tbl_user';



	function __construct()

	{

		parent::__construct();
	}



	function check_user($username, $password)

	{

		$query = $this->db->get_where($this->table, array('username' => $username, 'password' => $password), 1, 0);



		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}



	function check_user_saja($username) ///anya yang di terima

	{

		$query = $this->db->get_where($this->table, array('username' => $username), 1, 0);



		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}

	function check_user_nbm($username) ///anya yang di terima

	{

		$query = $this->db->get_where($this->table, array('nbm' => $username), 1, 0);



		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}



	function check_user_saja_nosaya($username, $password, $id_user) ///anya yang di terima

	{

		$query = $this->db->get_where($this->table, array('username' => $username), 1, 0);



		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}

	function check_daftar_pesan_voucher($id)

	{

		$query = $this->db->get_where('tbl_pesan_voucher', array('id_user' => $id), 1, 0);



		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}

	function check_daftar_input_voucher($id, $th)

	{

		$query = $this->get_daftar_input_voucher($id, $th);



		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}



	function check_daftar_input_voucher_edisi($id, $th)

	{

		$query = $this->db->get_where('tbl_input_voucher', array('id_user' => $id, 'edisi' => $th, 'bonus' => 0));



		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}

	function check_daftar_input_voucher_all($id, $th)

	{

		$query = $this->get_daftar_input_voucher_all($id, $th);



		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}

	function get_daftar_pesan_voucher($id)

	{





		return $this->db->get_where('tbl_pesan_voucher', array('id_user' => $id));
	}

	//REV 221017 VOUCHER awal

	function get_daftar_input_voucher_old($id, $th)

	{

		return $this->db->get_where('tbl_input_voucher', array('id_user' => $id, 'tahap' => $th));
	}



	//// //REV 221017 VOUCHER

	function get_daftar_input_voucher($id, $th)

	{

		return $this->db->get_where('tbl_input_voucher', array('id_user' => $id, 'tahap' => $th, 'bonus' => 0));
	}

	function get_daftar_input_voucher_all($id, $th)

	{

		return $this->db->get_where('tbl_input_voucher', array('id_user' => $id, 'tahap' => $th));
	}







	//REV 221017 VOUCHER BONUS

	function get_daftar_input_voucher_bonus($id, $th)

	{

		return $this->db->get_where('tbl_input_voucher', array('id_user' => $id, 'tahap' => $th, 'bonus' => 1));
	}



	function get_daftar_input_voucher_st($id)

	{

		$this->db->select_max('edisi');

		return $this->db->get_where('tbl_input_voucher', array('id_user' => $id))->row()->edisi;
	}

	function get_daftar_input_voucher_st_no($id)

	{

		$this->db->select_max('tahap');



		return $this->db->get_where('tbl_input_voucher', array('id_user' => $id, 'status !=' => '99'))->row()->tahap;
	}

	function get_tahap_terakhir($id)

	{

		$a = $this->db->get_where('tbl_input_voucher', array('id_user' => $id, 'status !=' => '99'));

		if ($a->num_rows() > 0) {

			$c = $this->get_daftar_input_voucher_st_no($id);

			if ($c == 0) {

				$b = 1;
			} else {

				$b = $c;
			}
		} else {

			$b = 1;
		}



		return $b;
	}



	function get_daftar_input_voucher_st_no_m($id, $b)

	{

		$this->db->select_max('tahap');

		return $this->db->get_where('tbl_input_voucher', array('id_user' => $id, 'bonus' => $b))->row()->tahap;
	}



	function get_daftar_input_voucher_st_all()

	{

		$this->db->select_max('edisi');

		return $this->db->get_where('tbl_input_voucher', array('id_user !=' => 0))->row()->edisi;
	}



	/////////get saldo per iduser



	function get_saldo_id_user($id)

	{

		$a = $this->db->get_where('tbl_input_voucher', array('id_user' => $id, 'saldo !=' => 0, 'status' => 1));

		$t = 0;

		if ($a->num_rows() > 0) {

			foreach ($a->result() as $key) {

				$t = $t + $key->saldo;

				$tot = $t;
			}
		} else {

			$tot = 0;
		}

		return $tot;
	}

	function get_saldo_pertama_id_user($id)

	{

		$a = $this->db->get_where('tbl_pesan_voucher', array('id_user' => $id, 'proses' => 1));

		$t = 0;

		if ($a->num_rows() > 0) {

			foreach ($a->result() as $key) {

				$t = $t + $key->saldo_awal;

				$tot = $t;
			}
		} else {

			$tot = 0;
		}

		return $tot;
	}

	function get_saldo_pertama_id_user_ed($id, $id_voc_s)

	{

		$a = $this->db->get_where('tbl_pesan_voucher', array('id_user' => $id, 'proses' => 1, 'id_voc' => $id_voc_s));

		$t = 0;

		if ($a->num_rows() > 0) {

			foreach ($a->result() as $key) {

				$t = $t + $key->saldo_awal;

				$tot = $t;
			}
		} else {

			$tot = 0;
		}

		return $tot;
	}



	function get_daftar_input_voucher_st_all_bonus()

	{

		$this->db->select_max('edisi');

		return $this->db->get_where('tbl_input_voucher', array('id_user !=' => 0, 'bonus !=' => 0))->row()->edisi;
	}

	function check_user2($username, $password)

	{

		$query = $this->db->get_where($this->table, array('username' => $username, 'password' => $password, 'status' => 1), 1, 0);



		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}

	function check_user_nopass($username)

	{

		$query = $this->db->get_where($this->table, array('password' => $username), 1, 0);



		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}

	function check_user_nama($username)

	{

		$query = $this->db->get_where($this->table, array('nama' => $username), 1, 0);



		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}

	function check_user_shift($shift, $tgl)

	{

		$query = $this->db->get_where('tbl_login_ship', array('ship' => $shift, 'sort' => $tgl), 1, 0);



		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}

	function get_jam_shift($shift)

	{

		return $this->db->get_where('tbl_jam_shift', array('jam' => $shift))->row()->shift;
	}

	function check_user_shift_id($shift, $tgl, $id)

	{

		$query = $this->db->get_where('tbl_login_ship', array('ship' => $shift, 'sort' => $tgl, 'id_user' => $id), 1, 0);



		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}

	function check_user_id($username, $password)

	{

		$query = $this->db->get_where('tbl_pesan_kamar', array('nama' => $username, 'id' => $password));



		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}



	function get_id_pass($username, $password)
	{

		$this->db->select('*');

		$this->db->from('ueu_tbl_user');

		$this->db->where('username', $username);

		$this->db->where('password', $password);

		return $this->db->get();
	}


	///check_user_ni 20181001

	function check_user_ni($ni)
	{

		$this->db->select('*');

		$this->db->from('ueu_tbl_user');

		$this->db->where('ni', $ni);

		return $this->db->get();
	}



	function kosong_data()
	{

		$this->db->where('id_unit !=', 0);

		$this->db->delete('ueu_tbl_user');
	}

	function update_info($d)

	{

		$this->db->where('id', 1);

		$this->db->update('ueu_tbl_info', $d);
	}

	function simpan_edt_bio($d, $id)

	{

		$this->db->where('idlog', $id);

		$this->db->update('ueu_tbl_user', $d);
	}

	function sip_login($d)

	{

		//$this->db->where('id',1);

		$this->db->insert('tbl_lap_ship', $d);
	}

	function simpan_daftar($d)

	{

		//$this->db->where('id',1);

		$this->db->insert('ueu_tbl_user', $d);
	}



	/////rev :: 9/juli

	function simpan_daftar_sbm($d)

	{

		//$this->db->where('id',1);

		$this->db->insert('tbl_peserta_sbm', $d);
	}

	function sip_login_sip($d)

	{

		//$this->db->where('id',1);

		$this->db->insert('tbl_login_ship', $d);
	}



	function problem_app($id, $saldo_true)

	{

		//$this->db->where('id',1);

		$d = array(

			'id_user' => $id,

			'pesan' => 'bagian Voucher "#1 Dompet E-Retail - Deposit"',

			'tanggal' => date('d-m-Y'),

			'saldo_true' => $saldo_true,

		);

		$this->db->insert('tbl_problem', $d);
	}

	function simpan_revData($id, $st, $ket)
	{
		$d = [
			'status' => 0,
			'status' => $ket,
			'tgl' => $this->M_time->harinow(),
		];
		$this->db->where('id_user', $id)->where('status', $st)
			->update('tbl_cekakunrev', $d);
	}
}
