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
                   
                    <th>Redeem</th>
                    <th>Tanggal</th>
                  </tr>
                  <tr align="center">
                  	<td><?=$nama?></td>
                  	<td><?=$nbm?></td>
                  	<td><?=$unit?></td>
                  	<td align="right"><?=$this->session->userdata('redeem')?></td>
                  	<td><?=$this->session->userdata('tgl_trans')?></td>
                  </tr>
                  </thead>
                  <tbody>
                
		
		<tr>
                  			
                  		</tr>
			
	
						
					
                  
                  </tbody>
                  </table>
<br/>
  
</body>
</html>