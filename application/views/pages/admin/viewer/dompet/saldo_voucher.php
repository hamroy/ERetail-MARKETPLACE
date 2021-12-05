<?php
 ////20180501 v parsel
        $iduser=$id_user;
        ///GALLVOC 201811
        $jvoc=0;
        $gv=$this->M_gvocall->gvall($jvoc,$id_user);  ///0 = e makan

        $id_voc=$gv['id_voc'];
        $data['gsaldoall']=$this->M_dompetKu->getSaldoVocAll($id_user,$jvoc,$id_voc,1);
        /////
        $data['gettotal_parsel_pesan'] = $gv['saldo_dibelanjakan'];
        $data['tosaldopar']=$gv['saldo'];
        
        $redvocpar=0;  //redeem par voc
        
        $dompet=$salpenvocpar=$gv['dompet_selesai']; ///hasil akhir pendapatan (cetak)
        $dompet_dicairkan=$gv['redeem'];
        
        $data['durasi']=$gv['durasi'];
        $data['idjov']=$jvoc;

  ?>
  <!-- DOMPET SALDO -->

  <?php
  if($this->M_setapp->real_status() < 3){
  $this->load->view('pages/admin/dompet_mkn/saldo_voucher_dompet',$data);
  }
  ?>

  