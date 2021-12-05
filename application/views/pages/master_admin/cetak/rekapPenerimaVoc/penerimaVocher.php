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
        <h3 align="center">DAFTAR PENERIMA VOUCHER</h3>
        <h4 align="center"> </h4>
   </div>
   <hr/>

  <?php
  $get_all_id_produk=$this->M_dompetall->pemesanVouEdisi($Evoc,$idjov,1,$statusP,$dvo,$statprodi); //

  ?>
                 <table width="100%">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>UNIT KERJA</th>
                    <th>Tanggal Daftar</th>
                    <th>Tanggal ACC</th>
                    <th>SALDO</th>
                  </tr>
                  </thead>
                  <tbody>
                   
            <?php                   
            if($get_all_id_produk->num_rows() > 0){
            
            $no=1;
            foreach($get_all_id_produk->result() as $gidp){ 
            $getnama=$this->Muser->get_id_pass_nos($gidp->id_user);
            if($getnama->num_rows() > 0){
              $getnama0=$getnama->row()->nama;
            }else{
              $getnama0='nama kosong';
            }
        
            ?>
          <tr >
                    <td><?=$no++?></td>
                    <td><a ><?=$getnama0?></a></td>
                    <td><?=$gidp->nik?></td>
                    <td><?=$gidp->unit?></td>
                    <td><?=$gidp->tanggal_p?> <?=$gidp->waktu?></td>
                    <td><?=$gidp->tanggal_acc?></td>
                    <td><?=$gidp->saldo_awal?></td>
                    
                 
                   
                  </tr>  
    <?php } 
              } ?>
                                
                  </tbody>
                </table>
<hr/>        
	
	
	
<br/>
  
</body>
</html>