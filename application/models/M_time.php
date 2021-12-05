<?php



class M_time extends CI_Model {
    
    var $tanngal;
    var $sort_tanggal;
    var $waktu;
    var $harinow;
    //var $id_voc;
    

	function __construct()
    
	{

		parent::__construct();
        $h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
        $hm = $h * 60;
        $ms = $hm * 60;
        $tanggal = gmdate("d-m-Y", time()+($ms)); // the "-" can be switched to a plus if that's what your time        zone is.
        $waktu = gmdate ( "H:i:s", time()+($ms));
        $hariini = gmdate('d-m-Y H:i:s', time() + ($ms));
        //////////////
        //======================
   			    $xxxxxx=substr($hariini,'17','2');
   			    $xxxxx=substr($hariini,'14','2');
   				$xxxx=substr($hariini,'11','2');
   				$xxx=substr($tanggal,'0','2');
				$xx=substr($tanggal,'3','2');
				$x=substr($tanggal,'6','4');
				$tgl1=$x.''.$xx.''.$xxx.''.$xxxx.''.$xxxxx.''.$xxxxxx;
				$voc=$x.''.$xx;
///JAM
        $this->sort_tanggal=$tgl1;
        $this->tanngal=$tanggal;
        $this->waktu=$waktu;
        $this->harinow=$hariini;
        $this->tgl_ymd=gmdate("Y-m-d", time()+($ms));;
        $this->tglnow_sls=gmdate("d/m/Y ", time()+($ms));;
        //$this->id_voc=$id_voc_s;
        $this->thn=gmdate("Y", time()+($ms));
        $this->bln=gmdate("m", time()+($ms));
        $this->tgl_now=gmdate("d", time()+($ms));

	}

	function sort_tanggal(){
        return $this->sort_tanggal;
    }
    function tgl_now(){
        return $this->tgl_now;
    }
    function time(){
        return $this->waktu;
    }
    function thn(){
        return $this->thn;
    }
    function bln(){
        return $this->bln;
    }
    function tglnow(){
        return $this->tanngal;
    }
    function tgl_ymd(){
        return $this->tgl_ymd;
    }
    function harinow(){ //hari sekarang sampe detik
        return $this->harinow;
    }
    function tglnow_slas(){
        return $this->tglnow_sls;
    }
    
    function get_tbl_ttgl($tgl){
        return $this->db->get_where('tbl_set_ttgl',array('idtgl'=>$tgl));
    }

    function thnblntgl(){
        $tgl=$this->pecah_tgl($this->tanngal);
        return $tgl[2].$tgl[1].$tgl[0]; //print tanggal
    }

    function durasi_hari($d=3){
        // $tgl1 = '2019-03-22';// pendefinisian tanggal awal
        $tgl1 = $this->tglnow;// pendefinisian tanggal awal
        $tgl2 = date('Y-m-d', strtotime('+'.$d.' days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
        $tgl=$this->pecah_tgl($tgl2);
        return $tgl[0].$tgl[1].$tgl[2]; //print tanggal

    }

    function pecah_tgl($tgl){
        $arr_kalimat = explode ("-",$tgl);

        return $arr_kalimat;
    }
    function pecah_waktu($waktu){
        $arr_kalimat = explode (":",$waktu);

        return $arr_kalimat;
    }

     function blnKeindo($bln){

      $pbln=substr($bln, -1);
      if ($bln>=10) {
      $pbln=substr($bln, -2);
      }
        $blnaray=array(
                    '1'=>'Januari',
                    '2'=>'Februari',
                    '3'=>'Maret',
                    '4'=>'April',
                    '5'=>'Mei',
                    '6'=>'Juni',
                    '7'=>'Juli',
                    '8'=>'Agustus',
                    '9'=>'September',
                    '10'=>'Oktober',
                    '11'=>'November',
                    '12'=>'Desember',
        );

        return $blnaray[$pbln];

    }

    function keBmt(){
        $tanggal=$this->tglnow_slas(); 
        // $tanggal_waknow= '31-04-2019 21:06:39'; 
        $pectgl=explode('/',$tanggal);
        
        $cektgl=$this->get_tbl_ttgl($pectgl[0]);
        $ttgl=$cektgl->row()->t_tgl;
        $tb_bln=$cektgl->row()->b_bln;
        $t_thn=$pectgl[2];
        $b_bln=$pectgl[1]+$tb_bln;
       
        if($pectgl[1]==12 and $pectgl[0]>10){ //untuk tanggal lebiH DARI 10 BULAN 12
           $b_bln='01' ;
           $t_thn=$pectgl[2]+1;
        }
        
        if($pectgl[0]<11){ //kurang dari 10
            $b_bln=$pectgl[1] ;
            $t_thn=$pectgl[2];
        }

        $b_bln_indo= $this->blnKeindo($b_bln); 
        $tttgl=$ttgl;
        if ($ttgl<10) {
          $tttgl='0'.$ttgl;
        }

        return $tttgl.'-'.$b_bln_indo.'-'.$t_thn;
    }

    function durasi_ymd($durasi,$j=30){
    
    if ($durasi==0) {
     $dur=$durasi;
    }else{

    $realtime=$this->tgl_ymd();
    $datetime1 = new DateTime($realtime);
    $datetime2 = new DateTime($durasi);
    $interval = $datetime1->diff($datetime2);
    $dur=$j-$interval->days;
    }

    if ($dur <= 0) {
        $dur=0;
    }

        return $dur;
    }
	
    public function tgljam_s()
    {
        $tgl=$this->pecah_waktu($this->waktu);
        // return $this->harinow ;
        return $this->tgl_now.$tgl[0].$tgl[1];
    }

    function add_hari($d=3){
        
        $tgl1 = $this->tanngal;
        $tgl2 = date('d-m-Y', strtotime('+'.$d.' days', strtotime($tgl1))); //operasi penjumlahan tanggal 
        return $tgl2;

    }

}///class