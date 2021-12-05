<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
  
class CI_Pdf { 
    function pdf_create_portrait($html, $filename, $stream=TRUE){ 
         require_once(APPPATH."third_party\dompdf\dompdf_config.inc.php"); //Require Loader Class n Config
	    spl_autoload_register('DOMPDF_autoload');//Autoload Resource

	    ini_set("memory_limit", "999M");
		ini_set("max_execution_time", "999");

	    $dompdf = new DOMPDF();//Instansiasi
	    $dompdf->load_html($html);//Load HTML File untuk dirender
	   $dompdf->set_paper('legal','portrait'); 
	   // $dompdf->set_paper(array(0,0, 8.5 * 72, 13.5 * 72),"portrait" ); //array(0,0, 8.5 * 72, 11 * 72)
	    $dompdf->render();//Proses Rendering File
	    $canvas = $dompdf->get_canvas(); //code untuk file dilihat tampa di download
		$font = Font_Metrics::get_font("helvetica", "bold");
		$canvas->page_text(830, 578, "Halaman: {PAGE_NUM} dari {PAGE_COUNT}", $font, 8, array(0,0,0));
	    	if ($stream==TRUE) {
				$dompdf->stream($filename, array('Attachment'=>0));
	    	} else {
				$CI =& get_instance();
				$CI->load->helper('file');
			write_file($filename, $dompdf->output());//file name adalah ABSOLUTE PATH dari tempat menyimpan file PDF
	    	}
		

    }
     function pdf_create_portrait_down($html, $filename, $stream=TRUE){ 
        require_once(APPPATH."third_party/dompdf/dompdf_config.inc.php"); 
        spl_autoload_register('DOMPDF_autoload'); 
      
        $dompdf = new DOMPDF(); 
        $dompdf->load_html($html); 
        //$dompdf->set_paper('legal','portrait'); 
       $dompdf->set_paper('A4','portrait'); 
        $dompdf->render(); 
        if ($stream) { 
        $dompdf->stream($filename.".pdf"); 
        } else { 
        $CI =& get_instance(); 
        $CI->load->helper('file'); 
        write_file($filename, $dompdf->output()); 
        } 
    }

    function pdf_create_landscape($html, $filename, $stream=TRUE){ 
        require_once(APPPATH."third_party/dompdf/dompdf_config.inc.php"); 
        spl_autoload_register('DOMPDF_autoload'); 
      
        $dompdf = new DOMPDF(); 
        $dompdf->load_html($html); 
        $dompdf->set_paper('legal','landscape'); 
      //  $dompdf->set_paper('A4','portrait'); 
        $dompdf->render(); 
        if ($stream) { 
        $dompdf->stream($filename.".pdf"); 
        } else { 
        $CI =& get_instance(); 
        $CI->load->helper('file'); 
        write_file($filename, $dompdf->output()); 
        } 
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////
    function pdf()

	{

		$CI = & get_instance();

		log_message('Debug', 'mPDF class is loaded.');

	}


	function load($param=NULL)

	{

		include_once APPPATH.'/third_party/mpdf/mpdf.php';


		if ($params == NULL)

		{

			$param = '"en-GB-x","A4","","",10,10,10,10,6,3';

		}


		return new mPDF($param);

	}

}