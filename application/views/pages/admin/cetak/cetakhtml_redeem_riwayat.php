<html>
<style type="text/css">

body {
    margin: 0.1in;
}
#kiri {
    width: 20%;
    float: left;
    padding: 10px;
}
#kanan {
    width: 100%;
}

h1, h2, h3, h4, h5, h6, li, blockquote, p, th, td {
    font-family: Helvetica, Arial, Verdana, sans-serif; /*Trebuchet MS,*/
}
h1, h2, h3, h4 {
    color: #000000;
    font-weight: normal;
}
h4, h5, h6 {
    color: #000000;
}
h2 {
    margin: 0 auto auto auto;
    font-size: x-large;
}
li, blockquote, p, th, td {
    font-size: 80%;
}
ul {
    list-style: url(/img/bullet.gif) none;
}

#footer {
    border-top: 1px solid #000000;
    text-align: right;
}

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    font-family: "Trebuchet MS", Arial, sans-serif;
    color: black;    
}
#ss {
	padding: 9px;
	border-top: 1px;
	border-left-style: double;
}
td, th {
    padding: 4px;
}

P.breakhere {page-break-after: always}
</style>
 <body onload="print()">
        
   <div id="kanan" class="page-header">
   <br/>
        <h4 align="center"> PENCAIRAN (REDEEM) VOUCHER</h4>
        <h4 align="center"> <?=$title1?></h4>
        </div>
<hr/>        
	
<table class="table" style="width: 100%">
                   <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>NO</th>
                    <th>Nama</th>
                    <th>NIK / NBM</th>
                    <th>Unit Kerja</th>
                    <th>Tanggal</th>
                    <th>Redeem</th>

                  </tr>
                   </thead>
                  <?php
                  //$g_id2=$this->M_voucher->get_id_user_tblpesanvoc_all($id_user); ///get masing masing id user
                  $g_id2=$this->M_voucher->get_id_user_tblpesanvoc_perid($id_user,$id); ///get masing masing id user
                  if($g_id2->num_rows() > 0){
                      $no=1;
                    foreach($g_id2->result() as $gur){
                    ?>    
                    <tr>
                  	<td><?=$no++?></td>
                    <td><?=$nama?></td>
                  	<td><?=$nbm?></td>
                  	<td><?=$unit?></td>
                  	
                  	<td><?=$gur->tgl_trans?></td>
                      
                     <?php
                      $badmin=$gur->redeem-$gur->redeem_akhir;
                      $r_a=$gur->redeem_akhir;
                      $r_lunas=1;
                      if($gur->status==0){
                        $badmin=$gur->redeem*1/50;
                        $r_a=$gur->redeem-$badmin;
                        $r_lunas=0;
                      }
                      ?>
                  	<td align="right"><?=$r_a?></td>
                      
                  </tr>
                   <tr align="center">
                  	<td colspan="5" align="right">Biaya Administrasi</td>
                     
                  	<td align="right"><?=$badmin?></td>
                  </tr>
                    <?php    
                    }  
                  }
                  ?>
                
                   <tr align="center">
                  	<td colspan="5" align="right">Total</td>
                  	<td align="right"><?=$gur->redeem?></td>
                  </tr>
                 
                  </table>
                  <br/>
                  <br/>
                  <br/>
                  <?php
                  $ur='';
                  if($cetak=='html'){
                      $ur=base_url();
                  }
                  ?>
                  <?php
                   if($r_lunas==1){
                        ?>
                        
                        <p align="center" class="visible-print-" ><img src="<?=$ur?>dist/img/copy.png" alt="" style="height: 50px; width: 200px" /></p>
<br/>
                        
                        <?php
                        
                      }
                  
                  ?>

  
</body>
</html>