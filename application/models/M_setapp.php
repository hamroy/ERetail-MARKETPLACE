<?php
class M_setapp extends CI_Model
{
    function __construct()
    {

        parent::__construct();
    }









    function get_tbl_st_job()
    {



        $this->db->where('id_job !=', 0);

        $this->db->order_by('id_job', 'ASC');

        return $this->db->get('tbl_st_job');
    }

    //////////20180418
    function get_tbl_fak_prodi()
    {



        //$this->db->where('kode_prodi NOT REGEXP 00');
        //$this->db->order_by('');
        $query = "SELECT * FROM `tbl_kodefakprod` WHERE `kode_prodi` NOT REGEXP '00'  AND `kode_nim` != 0 ORDER BY `tbl_kodefakprod`.`kode_nim` ASC";


        return $this->db->query($query);
    }

    function get_tbl_per_prodi($idkede)
    {
        //$query = "SELECT * FROM `tbl_kodefakprod` WHERE `kode_prodi` = ".$idkede;	
        $this->db->where('kode_prodi', $idkede);
        return $this->db->get('tbl_kodefakprod');
        //*/


        //return $this->db->query($query);



    }

    function get_tbl_per_prodi_ok($idkede)
    {
        //$query = "SELECT * FROM `tbl_kodefakprod` WHERE `kode_prodi` = ".$idkede; 
        $this->db->where('kode_nim', $idkede);
        return $this->db->get('tbl_kodefakprod');
        //*/


        //return $this->db->query($query);



    }



    function get_tbl_st_job_All()
    {



        $this->db->order_by('id_job', 'ASC');

        return $this->db->get('tbl_st_job');
    }

    function get_tbl_st_job_id($id)
    {



        $this->db->where('id_job', $id);

        $this->db->order_by('id_job', 'ASC');

        return $this->db->get('tbl_st_job');
    }

    function set_alllvoc_iduser($d)
    {



        $this->db->insert('set_allvoc', $d);
    }
    function cek_alllvoc_iduser($id, $idjv, $id_voc_dl, $pro = 2)
    {


        $this->db->like('jvoc', $idjv);
        $this->db->where('id_user', $id);
        //$this->db->where('id_voc_dl',$id_voc_dl);

        $this->db->where('proses', $pro);
        return $this->db->get('set_allvoc');
    }

    function del_cekupvoc_user($id, $pro = 2)
    {

        $d = [
            'proses' => 3,
        ];
        $this->db->where('id_user', $id);

        $this->db->where('proses', $pro);
        $this->db->update('set_allvoc', $d);
    }



    function static_bm()
    {

        return base_url(); //'https://static.E-Retail.com/'; 

    }

    function kosongkan_ex_allvoc_j($d, $j_voucher)
    {

        $this->db->where('j_voucher', $j_voucher);
        $this->db->where('metode', 'VOUCHER');

        $this->db->like('buy', 'dipesan');

        $this->db->update('tbl_transaksi', $d);
    }

    function save_alllvoc_iduser($d)
    {


        /*$this->db->where('id_user',$id);
        $this->db->where('jvoc',$idjv); //*/
        $this->db->insert('set_allvoc', $d);
    }

    function get_info_p()
    {
        $id_user = $this->session->userdata('id_user');
        $this->db->where('idlog', $id_user);
        return $this->db->get('ueu_tbl_user')->row();
    }

    function get_idjobmarket()
    {
        $market = $this->session->userdata('id_supermarket');
        $this->db->where('id_supermarket', $market);
        return $this->db->get('tbl_supermarket')->row()->id_job;
    }

    function supermarket($id = '')
    {
        $this->session->set_userdata('id_supermarket', $id); ///id_jobmarket
    }

    function real_status()
    {
        $id_user = $this->session->userdata('id_user');
        $this->db->from('tbl_st_job, ueu_tbl_user');
        $this->db->where('tbl_st_job.id_job = ueu_tbl_user.job');
        $this->db->where('ueu_tbl_user.idlog', $id_user);

        return $this->db->get()->row()->job;
    }

    function get_bln()
    {
        $this->db->where('nobln <=', 12);
        return $this->db->get('tbl_tgl_bln');
    }

    public function urlBack()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    public function getFasiltasApp($fasilitas, $status = 0)
    {
        $id_user = $this->session->userdata('id_user');
        # code
        $this->db->from('tbl_set_akses');
        $this->db->where('id_user', 1);
        $this->db->where('fasilitas', $fasilitas);
        $this->db->where('status', $status);
        $a = $this->db->get();
        return $a;
    }
    public function setFasiltasApp()
    {
        $a = $this->getFasiltasApp(1, 1);
        $b = $this->getFasiltasApp(2, 1);
        $c = $this->getFasiltasApp(0, 1);
        $d = [
            'dompet' => $a->num_rows(),
            'redeem' => $b->num_rows(),
            'login' => $c->num_rows(),
        ];


        return $d;
    }
}///class