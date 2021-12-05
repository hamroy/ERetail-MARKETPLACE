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
                  <tr bgcolor="#d9d9dd" align="center">
                    <th>Nama</th>
                    <th>NIK / NBM</th>
                    <th>Unit Kerja</th>
                   
                    <th>Tanggal</th>
                     <th>Redeem</th>
                  </tr>
                 
                  </thead>
                  <tbody>
                
		
		         <tr align="center">
                  	<td><?=$nama?></td>
                  	<td><?=$nbm?></td>
                  	<td><?=$unit?></td>
                  	
                  	<td><?=$this->session->userdata('tgl_trans')?></td>
                    <td align="right"><?=$this->session->userdata('redeem')?></td>
                  </tr>
                 <tr align="center">
                  	<td colspan="4" align="right">Biaya Administrasi</td>
                  	<td align="right"><?=$this->session->userdata('kebmt')?></td>
                  </tr>
                   <tr align="center">
                  	<td colspan="4" align="right">Total</td>
                  	<td align="right"><?=$this->session->userdata('kebmt')+$this->session->userdata('redeem')?></td>
                  </tr>
	                 <tr align="left" style="background-color: #b9bfc4;font-size: 24px;">
                      	<td colspan="5" style="padding-top: 24px" ><h4>(*) Pengambilan bisa dilakukan pada tanggal <?=$this->session->userdata('tgl_kebmt')?></h4></td>
                      </tr>
						
					
                  
                  </tbody>
                  </table>
                  
                 
                    <p align="center" class="visible-print-" ><img src="dist/img/copy.png" alt="" style="height: 50px; width: 200px" /></p>
  
</body>
</html>