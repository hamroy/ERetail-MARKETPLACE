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
        <h3 align="center">REKAP PRODUK</h3>
        <h3 align="center">KATEGORI <?=strtoupper($_GET['nkat'])?></h3>
        <h5 align="center"><?=$d['thn']?> <?=$d['bln']?> <?=$d['tgl']?> </h5>
        </div>
<hr/>        
	
             <table width="100%">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Produk</th>
                    <th>Penjual</th>
                    <th>Total</th>
                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                  
                  $totalpAkun=0;
                  $no=0;
                  $to=0;
                  if($get_all_id_produk->num_rows() > 0){
                  foreach($get_all_id_produk->result() as $gidp0){ 


                  ?>

                    <tr>

                    <td><?=++$no?></td>

                    <td>
                     <?=$gidp0->namaProduk?>
                    </td><td>
                     <?=$gidp0->nama?>
                    </td>
                    
                    <td>
                     <?=$gidp0->sqty?>
                    </td>

                  </tr>
                  
                  <?php 
                  $to=$to+$gidp0->sqty;
                      }
                      }
                  ?>


                </tbody>

                <div class="well" style="font-family: number">
                  <h4>
                    TOTAL : <?=$no?> Produk  <?=$to?> Qty
                    
                  </h4>
                
                </div>

                </table>
	

<br/>

<br/>
  
</body>
</html>