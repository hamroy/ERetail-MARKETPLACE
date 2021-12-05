
<?php
 ////20180501 v parsel
        $iduser=$id_user;
        $jvoc=2; //2 rmd
        ///GALLVOC 201811
        $gv=$this->M_gvocall->gvall($jvoc,$id_user);  ///2 == RMD /SONG2

        /////
        $data['gettotal_parsel_pesan'] = $gv['saldo_dibelanjakan'];
        $data['tosaldopar']=$gv['saldo'];
        $redvocpar=0;  //redeem par voc
        
        $dompet=$salpenvocpar=$gv['dompet_selesai']; ///hasil akhir pendapatan (cetak)
        $get_reedeem_tp=$gv['redeem'];
        ///201904
        $id_voc=$gv['id_voc'];
        $data['idjov']=$jvoc;
        $data['durasi']=$gv['durasi'];
        $data['gsaldoall']=$this->M_dompetKu->getSaldoVocAll($id_user,$jvoc,$id_voc,1);

    ?>

    <!-- DOMPET -->
    <?php
    // if($this->M_setapp->real_status() < 3){
    // $this->load->view('pages/admin/dompet_song/saldo_voucher_dompetrmd',$data);
    // }
    ?>
    <?php
    if($this->M_setapp->real_status() < 3){
    $this->load->view('pages/admin/dompet_mkn/saldo_voucher_dompet',$data);
    }
    ?>
    
<script type="text/javascript">
function konfirmasiredeem(action)
{
    var r = confirm('Anda yakin?');
    
    if(r == true){
        document.getElementById('theform').action = action;
    }
}
</script>