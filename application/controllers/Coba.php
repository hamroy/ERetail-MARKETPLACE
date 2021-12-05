<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Coba extends CI_Controller
{
        function __construct()
        {
                parent::__construct();
                $this->load->model('Mtrans');
        }

        //untuk percobaan
        public function index()
        {
                $pdfroot  = dirname(dirname(__FILE__));

                $pdfroot .= '/third_party/pdf/my_document-' . date('d-M-Y-H-i-s') . '.pdf'; //folder saving pdf

                $dompdf = new Dompdf\Dompdf();

                $html = $this->load->view('welcome_message', '', true);

                $dompdf->loadHtml($html);

                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4', 'landscape');

                // Render the HTML as PDF
                $dompdf->render();

                // Get the generated PDF file contents
                $pdf = $dompdf->output();

                // Output saving!
                file_put_contents($pdfroot, $pdf);
        }

        function kirim_attach($id)
        {

                $getidt = $this->Mtrans->get_qty_tbl_transaksi($id)->row();

                $data['idtblpembeli'] = $idtblpembeli = $this->Mtrans->get_tbl_pembeli($getidt->id_pembeli);

                $pdfroot  = dirname(dirname(__FILE__));

                $pdfroot .= '/third_party/pdf/my_document-' . date('d-M-Y-H-i-s') . '.pdf'; //folder saving pdf

                $dompdf = new Dompdf\Dompdf();

                $judulemail = '
                <html>        
                        <body >
                        <div style="background: #edf1f1; border-radius: 10px"><br/>
                                <h1>BUKTI PEMBAYARAN BARANG / KUITANSI (E-Retail)</h1>
                                <h3>Bukti Kuitansi Bisa Digunakan Sebagai Dokumen SKP</h3>
                                ';

                $isiemail = '                               
                <table border="0" width="70%">
                        <tr>
                                <td>Telah terima dari</td>
                                <td>: ' . $idtblpembeli->row()->nama . '</td>
                        </tr>
                        <tr>
                                <td>Uang sejumlah       </td>
                                <td>: <i>JUMLAH Rupiah </i></td>
                        </tr>
                        <tr>
                                <td>Untuk pembayaran    </td>
                                <td> : 
                                 </td>
                        </tr>
                        <tr>
                                <td colspan="7"> 
                                <table width="100%" style=" border: 1px solid black;  border: 1px solid black;
                    border-collapse: collapse;">
                        <tr style=" border: 1px solid black;background: #bbbcbd">
                                <td>Nama Produk</td>
                                <td>Qty</td>
                                <td>Harga</td>
                                <td>Sub Total</td>
                        </tr>
                        <tr style=" border: 1px solid black;">
                                <td>NAMAPRODUK</td>
                                <td>KUANTITAS</td>
                                <td align="right">HARGASATUAN</td>
                                <td align="right">JUMLAH</td>
                        </tr>
                        <tr style=" border: 1px solid black;">
                                <td colspan="3" align="right">Ongkos Kirim</td>
                                <td colspan="1" align="right">5000</td>
                        </tr>
                        <tr style=" border: 1px solid black;">
                                <td colspan="3" align="right">TOTAL</td>
                                <td colspan="1" align="right">TOTAL+ONGKIR</td>
                        </tr>
                </table>
                                 </td>
                        </tr>
                        
                </table>
                <br/><br/>';

                $emailfooter = '
                <table border="0" width="100%">
                        <tr>
                        <td width="70%"></td>
                                <td align="center">Surakarta, TANGGALKIRIM</td>
                        </tr>
                        <tr>
                                <td align="left" >Terbilang : Rp TOTAL</td>
                        </tr>   
                        <tr>
                        <td width="70%"></td>
                                <td align="center">&nbsp;</td>
                        </tr>
                        <tr>
                        <td width="70%"></td>
                                <td align="center">&nbsp;</td>
                        </tr>
                        <tr>
                        <td width="70%"></td>
                                <td align="center">NAMAPENJUAL</td>
                        </tr>
                </table>
                        </div>         
                        </body>
                </html>
                                ';

                $html = $this->load->view('pages/admin/viewer/email_attachment', $data, true);

                $dompdf->loadHtml($html);

                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4', 'landscape');

                // Render the HTML as PDF
                $dompdf->render();

                // Get the generated PDF file contents
                $pdf = $dompdf->output();

                // Output saving!
                file_put_contents($pdfroot, $pdf);

                $ci = get_instance();
                $ci->load->library('email');
                $config['protocol'] = "smtp";
                $config['smtp_host'] = "ssl://host21.registrar-servers.com";
                $config['smtp_port'] = "465";
                $config['wordwrap'] = TRUE;
                $config['smtp_user'] = "E-Retail@jualretail.com";
                $config['smtp_pass'] = "beduk2017";
                $config['mailtype'] = "html";
                $config['newline'] = "\r\n";


                $ci->email->initialize($config);
                //$list = array('ilhamroyroy@gmail.com');

                $ci->email->from('E-Retail@jualretail.com', 'E-Retail SUPERMALL');

                $ci->email->to('masterpra2002@gmail.com'); ///ke email pembeli
                $ci->email->bcc('E-Retail@jualretail.com');
                $ci->email->subject('COBA KIRIM BUKTI TRANSAKSI BARANG - [E-Retail]');
                //$ci->email->message('Halo, saya sedang mencoba kirim email dengan attachment');
                $ci->email->message($judulemail . $isiemail . $emailfooter);
                //$attched_file= $_SERVER["DOCUMENT_ROOT"]."/application/third_party/pdf/my_document.pdf";
                $attched_file = $_SERVER["DOCUMENT_ROOT"] . "/application/third_party/pdf/my_document-" . date('d-M-Y-H-i-s') . ".pdf";

                $ci->email->attach($attched_file);
                $this->email->send();
        }
}
