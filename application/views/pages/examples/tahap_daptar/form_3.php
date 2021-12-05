  <atr>
      <?php

        //  print_r($_GET);
        ?>
      <?php
        ///get post
        $nama = '';
        $user = '';
        $pass = '';
        $job = '';


        if (!isset($_GET['nama']) or !isset($_GET['username']) or !isset($_GET['pass']) or !isset($_GET['job']) or !isset($_GET['pro'])) {
            redirect('Login/daftar?error=null1');
        }

        if (!isset($_GET['ni'])) {
            redirect('Login/daftar?error=null2');
        }
        if (!isset($_GET['rek']) or !isset($_GET['bank']) or !isset($_GET['no']) or !isset($_GET['jenis'])) {
            redirect('Login/daftar?error=null3');
        }
        if (!isset($_GET['daerah']) or !isset($_GET['ranting']) or !isset($_GET['cabang'])) {
            redirect('Login/daftar?error=rantingnull2');
        }

        $nama = $_GET['nama'];
        $user = $_GET['username'];
        $pass = $_GET['pass'];
        $job = $_GET['job'];

        //th3
        $ni = $_GET['ni'];
        $prodi = $_GET['prodi'];
        $rek = $_GET['rek'];
        $bank = $_GET['bank'];
        $no = $_GET['no'];
        $jenis = $_GET['jenis'];
        $daerah = $_GET['daerah'];
        $ranting = $_GET['ranting'];
        $cabang = $_GET['cabang'];

        ?>

      <?php
        ///palidasi
        if (empty($_GET['nama']) or empty($_GET['username']) or empty($_GET['pass']) or empty($_GET['job']) or $_GET['job'] == 0 or $_GET['pro'] != 3) {
            redirect('Login/daftar?error=empty1');
        }

        //
        ?>

      <?php
        $jktm = 'NBM';
        $pktm = '
   <small class="text-danger">(*) NBM wajib diisi</small><BR/>
   <small class="text-info">(-) khusus subunit kerja isi dg angka bebas</small>
        ';
        $fpktm = '
    <small class="text-warning">(*) Upload Foto NBM (format: gif, jpg, png, jpeg, bmp)</small><BR/>
    <small class="text-info">(-) Khusus subunit kerja  bebas isi gambar</small>
        ';

        if ($_GET['job'] == 3) {
            if (empty($_GET['ni'])) {
                redirect('Login/daftar?error=empty2&nim=null');
            }
            ///khusus ni mhasiswa yang kembar di tolak
            $cekuserni = $this->Login_model->check_user_ni($_GET['ni']);
            if ($cekuserni->num_rows() > 0) {
                $this->session->set_flashdata('pesandaftar', 'Maaf ,<br/>NIM Anda sudah terdaftar (' . $_GET['ni'] . ')');
                redirect("Login/daftar");
            }

            $jktm = 'No. kartu mahasiswa';
            $pktm = '
   <small class="text-danger">(*) No. kartu mahasiswa wajib diisi</small><BR/>
        ';
            $fpktm = '
    
    <small class="text-danger">(*) Untuk keamanan sistem, KTP, dan Paspor/SIM/BPJS/ Kartu Identitas lainnya dalam satu foto.  (format: gif, jpg, png, jpeg, bmp)</small><BR/>
        ';
        } else {
            if (empty($_GET['ni'])) {
                redirect('Login/daftar?error=empty2&ni=null');
            }
        }
        //*/
        ///cek email ke db E-Retail

        ?>

      <form action="<?= base_url('Login/daftar_simpan_ssl') ?>" method="post" enctype="multipart/form-data">

          <input type="hidden" name="nama" placeholder="Nama" value="<?= $nama ?>" required>
          <input type="hidden" name="username" placeholder="Email" value="<?= $user ?>" required>
          <input type="hidden" name="pass" value="<?= $pass ?>" placeholder="Password" required>
          <input type="hidden" name="job" value="<?= $job ?>" placeholder="Password" required>
          <!---->
          <input type="hidden" name="ni" value="<?= $ni ?>" placeholder="Password" required>
          <input type="hidden" name="prodi" value="<?= $prodi ?>" placeholder="Password" required>
          <!---->
          <input type="hidden" name="rek" value="<?= $rek ?>" placeholder="Password" required>
          <input type="hidden" name="bank" value="<?= $bank ?>" placeholder="Password" required>
          <input type="hidden" name="no" value="<?= $no ?>" placeholder="Password" required>
          <!---->
          <input type="hidden" name="ranting" value="<?= $ranting ?>" placeholder="Password" required>
          <input type="hidden" name="cabang" value="<?= $cabang ?>" placeholder="Password" required>
          <input type="hidden" name="daerah" value="<?= $daerah ?>" placeholder="Password" required>
          <!---->
          <input type="hidden" name="jenis" value="<?= $jenis ?>" placeholder="Password" required>


          <input type="hidden" name="pro" value="3" />

          <!---->

          <hr />
          <div class="form-group has-feedback">

              <input type="number" class="form-control" name="nbm" placeholder="<?= $jktm ?>" required>

              <?= $pktm ?>

          </div>

          <div class="form-group has-feedback">

              <input type="file" class="form-control" name="file" placeholder="FILE">

              <?= $fpktm ?>



          </div>




          <!--REV 2-->
          <hr />


          <div class="form-group has-feedback">

              <label class="form">Alamat</label>

              <textarea rows="2" title="alamat" name="alamat" placeholder="Alamat" class="form-control" required> </textarea>

              <span class="glyphicon glyphicon glyphicon-map-marker form-control-feedback"></span>

              <small class="text-info">(*) Wajib diisi </small>

          </div>


          <!--REV 2-->




          <hr />
          <div style="background: #31e21d; border-radius: 5px; padding: 20px">
              <div class="row">

                  <div class="col-xs-12">

                      <div class="checkbox dckdesain">



                          <input type="checkbox" name="setuju" value="1" checked> &nbsp;Saya setuju memberikan donasi atas barang yang dijual untuk ranting pembeli dan penjual

                      </div>

                  </div>
              </div>

              <!-- /.col -->



              <!-- /.col -->

          </div>
          <hr />


          <div class="form-group has-feedback">

              <button type="submit" onclick="return confirm('Anda yakin')" class="btn btn-primary btn-block btn-lg">KIRIM</button>

          </div>

      </form>