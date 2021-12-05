<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "bedukmut_db_E-Retail_2018";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$columns = array( 
// datatable column index  => database column name
  0 =>'nim', 
  1 => 'nama_mhs',
  2 => 'prodi',
  3 => 'saldo_vou',
  4 => 'email_mhs',
);

// getting total number records without any search
$sql = "SELECT ".$columns['0'].", ".$columns['1'].", ".$columns['2'].", ".$columns['3'].", ".$columns['4'];
$sql.=" FROM tbl_mhs_aktif_xls";
$sql.=" WHERE `nim` > 0";

$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT ".$columns['0'].", ".$columns['1'].", ".$columns['2'].", ".$columns['3'].", ".$columns['4'];
$sql.=" FROM tbl_mhs_aktif_xls WHERE 1=1";
$sql.=" AND `nim` > 0";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
  $sql.=" AND ( ".$columns['1']." LIKE '".$requestData['search']['value']."%' ";    
  $sql.=" OR ".$columns['2']." LIKE '".$requestData['search']['value']."%' ";
  $sql.=" OR ".$columns['0']." LIKE '".$requestData['search']['value']."%' )";
}

$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees2".$requestData['search']['value']);

$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." 
    ".$requestData['order'][0]['dir']."
     LIMIT ".$requestData['start']." 
     ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */  
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
  $getnama=$this->M_vparsel->get_email_by_nim($row[$columns['0']]);

                // $getnama0="($gidp->nama_mhs)";
                $getnama0=$row[$columns['1']];
                $getprodi="(". $row[$columns['2']]. ")";
                if ($getnama['code']==1) {
                  # code...
                $getnama0=$getnama['nama'];
                $getprodi=$getnama['prodi'];

                }

                $cek_diterima=$this->M_vparsel->cek_ambilVoucher($row[$columns['0']]);     // MAHASISWA 
  //
  $nestedData=array(); 
  $nestedData[] = $row[$columns['0']];

  $nestedData[] = $getnama0;
  $nestedData[] = $getprodi;

  $nestedData[] = $row[$columns['3']];
  $nestedData[] = $row[$columns['4']];
  $nestedData[] = $cek_diterima['status'];
  
  $data[] = $nestedData;
}



$json_data = array(
      "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
      "recordsTotal"    => intval( $totalData ),  // total number of records
      "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
      "data"            => $data   // total data array
      );


if($this->session->userdata('login')!=TRUE OR $this->session->userdata('wewenang')!='admin'){
      redirect('login');
    }

echo json_encode($json_data);  // send data as json format
