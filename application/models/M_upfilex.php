<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_upfilex extends CI_Model {
  public function view(){
    return $this->db->get('tbl_pesvoc_xls')->result(); // Tampilkan semua data yang ada di tabel tbl_pesvoc_xls
  }
  
  // Fungsi untuk melakukan proses upload file
  public function upload_file($filename){
    $this->load->library('upload'); // Load librari upload
    
    $config['upload_path'] = './up_excel/';
    $config['allowed_types'] = 'xls|xlsx';
    $config['max_size']  = '0';
    $config['overwrite'] = true;
    $config['file_name'] = $filename;
  
    $this->upload->initialize($config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }
  
  // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
  public function insert_multiple($data){
    $this->db->insert_batch('tbl_pesvoc_xls', $data);
  }
  public function sendtoken($data){
    $this->db->where('id_app',123);
    $this->db->update('tbl_akses_app', $data);
  }
  //*/
}
