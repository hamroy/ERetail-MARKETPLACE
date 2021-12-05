<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_saldompet extends CI_Model {

function gDomall($id_user){

		$data['dompet']=0;
        $data['dompet_selesai']=0;
        $data['redeem']=0;
        $data['redeemSelesai']=0;
        $data['pesan']='gagal';
        $data['kode']=0;

        ////pendapatan voc parsel 
        $jvoc=99; //99 = dompetLain
        $gettotal_dapat = $this->totPendaptanNoVMhs($id_user); //tbltransaksi no mhs
        $get_reedeem=$this->Mbmt->get_tbl_reedeem_perid_user($id_user,$jvoc);// selain di tola
        $dompet_dicairkan=$this->Mbmt->get_tbl_reedeem_perid_user_perstatus($id_user,$jvoc,0); //dicairkan
        $dompet_selesai=$this->Mbmt->get_tbl_reedeem_perid_user_selesai($id_user,$jvoc,1); //selesai
        //
        $dompet=$gettotal_dapat-$get_reedeem; ///hasil akhir pendapatan
        //
        // output
        $data['dompet']=$gettotal_dapat; ///masih kotor
        $data['dompet_selesai']=$dompet; //bersih
        $data['redeem']=$dompet_dicairkan;
        $data['redeemSelesai']=$dompet_selesai;
        $data['pesan']='ok';
        $data['kode']=1;

        return $data;

}

function get_tbltransaksi_didapat_nomhs($id_user){

		$this->db->where('buy','dibayar');
		$this->db->where('metode','VOUCHER');
		$this->db->where('j_voucher !=',3); ///no mhs
		$this->db->where('id_pelapak',$id_user);
		return $this->db->get('tbl_transaksi');
		
		
}

function totPendaptanNoVMhs($id_user){

	$a=$this->get_tbltransaksi_didapat_nomhs($id_user);

	if($a->num_rows()> 0){
			$t=0;
			foreach($a->result() as $x){
				$t=$t+($x->qty*$x->harga_satuan);
			}
			return $t;
			
		}else{
			return 0;
		}

		return 0;

	}

}