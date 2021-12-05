<!DOCTYPE html>
<html>
<head>

<!--   <link rel="stylesheet" href="<?=$this->M_setapp->static_bm()?>bootstrap/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <!--select-->

  <link rel="stylesheet" href="<?=$this->M_setapp->static_bm()?>plugins/select2/select2.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="<?=$this->M_setapp->static_bm()?>dist/css/AdminLTE.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="<?=$this->M_setapp->static_bm()?>dist/css/skins/skin-blue.min.css">

  <script src="<?=$this->M_setapp->static_bm()?>plugins/jQuery/jquery-2.2.3.min.js"></script>


<link href="<?=base_url()?>/dist/css/bootstrap.datatable.css" rel="stylesheet">

</head>

<!--

BODY TAG OPTIONS:

-->

<body class="hold-transition skin-blue sidebar-mini">




 <table class="table no-margin js-basic-example">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama</th>
                    <th width="20%">NIM</th>
                    <th>Email</th>
                    <th>PRODI</th>
                    <th>VOUCHER</th>
                    <th>STATUS</th>
                  </tr>
                  </thead>
                   <tfoot>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama</th>
                    <th width="20%">NIM</th>
                    <th>Email</th>
                    <th>PRODI</th>
                    <th>VOUCHER</th>
                    <th>STATUS</th>
                  </tr>
                  </tfoot>
                  <?php 
                 
                  //$all_newvoucer2=$this->M_vparsel->get_Pesan_voucher_mhs(3,$id_voc_mhs);     // MAHASISWA UNIT MHSISWA SAJA

        // $all_newvoucer2=$this->M_vparsel->get_mhs_ex_aktif_pag(3,3,1,10,$off);
                  
                  
        $get_all_id_produk=$all_newvoucer2;
          //echo $_GET['vo'];
        if($get_all_id_produk->num_rows() > 0){
            $no=$dari;
            $tbdaf=0;
            $tsdaf=0;
            $smen=0;
        foreach($get_all_id_produk->result() as $gidp){ 
                
                $getnama=$this->M_vparsel->get_nim_akun($gidp->nim);

                $getnama0="($gidp->nama_mhs)";
                $getprodi="($gidp->prodi)";
                $email_m="($gidp->email_mhs)";
                $vou_mhs="$gidp->saldo_vou";
        
                if($getnama->num_rows() > 0){
          $getnama0=$getnama->row()->nama;
                    $email_m=$getnama->row()->username;
                    
                    //PRODI
                    $gjob=$this->M_setapp->get_tbl_per_prodi_ok($getnama->row()->kode_prodi);
                    
                    if($gjob->num_rows() > 0){
                        $getprodi=$gjob->row()->nama_prodi;
                    }
                    
          
        }
                
                //$all_mhsaktif=$this->M_vparsel->mhs_aktif_($getnim);     // MAHASISWA UNIT MHSISWA SAJA
        
        
            ?>
                     <?php
                        if($getnama->num_rows()== 0){
                        
                        $sb= 'BELUM DAFTAR';
                        $ctd='';
                        
                        $tbdaf=$tbdaf+1;
                       
                            
                        }else{
                        /////CEK SUDAH NGAMBIL BELUM
                          
                        $cek_diterima=$this->M_adminvoc->get_vou_pesan_perakun($getnama->row()->idlog,3);     // MAHASISWA UNIT MHSISWA SAJA
                        $sb ='TERDAFTAR';    
                        $ctd='#5969fb';
                        
                        
                        if($cek_diterima->num_rows() > 0){
                        
                        $sb ='DITERIMA';    
                        $ctd='#34d926';
                        $smen=$smen+1;
              
                        }else{
                        $tsdaf=$tsdaf+1;
                        }
                        }
                        
                        ?>
          <tr >
                    <td><?=++$no?></td>
                    <td><a ><?=$getnama0?></a></td>
                   
                    <td><?=$gidp->nim?></td>
                    <td><?=$email_m?></td>                 
                    <td><?=$getprodi?></td>                 
                    <td align="right"><?=$vou_mhs?></td>                 
                    <td align="right" bgcolor="<?=$ctd?>">
                       <?=$sb?>
                    </td>                 
                 
                   
                  </tr>  
        <?php }
          }
                  ?>
                </table>



  
   


<script type="text/javascript" src="<?=$this->M_setapp->static_bm()?>/plugins/jQuery/responsive-tab.js"></script>

<!-- Bootstrap 3.3.7 -->

<!-- <script src="<?=$this->M_setapp->static_bm()?>bootstrap/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--SELECT-->

<script src="<?=$this->M_setapp->static_bm()?>plugins/select2/select2.full.min.js"></script>

<!-- AdminLTE App -->

<script src="<?=$this->M_setapp->static_bm()?>dist/js/app.min.js"></script>



<script src="<?=$this->M_setapp->static_bm()?>/lazy/jquery.lazyload.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?=$this->M_setapp->static_bm()?>plugins/iCheck/square/blue.css">

<script type="text/javascript" charset="utf-8">

            $(function() {

                $("img.lazy").lazyload({effect : "fadeIn"});// untuk dipasang di <img src='xxxx'>

            });

            $(function()
            {
              $('#btnsubmit').on('click',function()
              {
                $(this).val('Please wait ...')
                  .attr('disabled','disabled');
                $('#theform').submit();
              });
              
            });
            $(function()
            {
              $('#btnsubmit2').on('click',function()
              {
                $(this).val('Please wait ...')
                  .attr('disabled','disabled');
                $('#theform2').submit();
              });
              
            });

        </script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.

     Both of these plugins are recommended to enhance the

     user experience. Slimscroll is required when using the

     fixed layout. -->




<script>



function loadPage(list) {

   location.href=list.options[list.selectedIndex].value

  //alert(v); 

//  $('.bj').hide();

}



$(function()
            {
              $('#klikbtnform').on('click',function()
              {
                $(this).val('Sedang diproses ...')
                  .attr('disabled','disabled');
              });
              
            });
            $(function()
            {
              $('#klikbtnformbat').on('click',function()
              {
                $(this).val('Sedang diproses ...')
                  .attr('disabled','disabled');
              });
              
            });

function konfirmasi(action)
{
    var r = confirm('Anda yakin?');
    
    if(r == true){
        document.getElementById('theform').action = action;
    }else{
       return alert("Proses di batalkan .");
    }
}
function konfirmasi2(action)
{
    var r = confirm('Anda yakin?');
    
    if(r == true){
        document.getElementById('theform2').action = action;
    }else{
       return alert("Proses di batalkan .");
    }
}
            



        //Ketika elemen class sembunyi di klik maka elemen class gambar sembunyi

       

</script>

<script>

$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip();   

});

</script>

<script type="text/javascript">

  $(window).load(function() { $("#loading").fadeOut("slow"); })

  

</script>

<script type="text/javascript">

  $('#something').click(function() {

    location.reload();

    $('.prnt').attr('disabled', 'disabled');

});

</script>

<script>

 

    $(".btn_wala").click(function(){

  $('.kla').attr('disabled', 'disabled');

  })





</script>                 

<script>

    function checkAll(element){

        var el=document.form1.elements["msg"];

        for(i=0;i<el.length;i++){

            el[i].checked=element.checked;

        }

    }

   

  

    

</script>    



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>
<script src="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Number-Input-Formatting-Mask-Number/jquery.masknumber.js"></script>
 



        
 <script type="text/javascript">
        $(document).ready(function () {
            $('.nominal').maskNumber
            ({
              thousands: '.',
              integer: true
            });
        });
    </script>

 <script src="<?=base_url()?>/dist/css/jquery.datatable.js"></script>
    <script src="<?=base_url()?>/dist/css/bootstrap.datatable.js"></script>
    <script src="<?=base_url()?>/dist/css/b.datatable.js"></script>
    <script type="text/javascript">
      $(function () {
    $('.js-basic-example').DataTable({
        responsive: true
    });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
    </script>


</body>

</html>

