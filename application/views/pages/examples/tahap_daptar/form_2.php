  <?php
  ///get post

  //print_r($_GET);

  $nama = '';
  $user = '';
  $pass = '';
  $job = '';
  if (!isset($_GET['nama']) or !isset($_GET['username']) or !isset($_GET['pass']) or !isset($_GET['job']) or !isset($_GET['pro'])) {
    redirect('Login/daftar?error=null1');
  }

  $nama = $_GET['nama'];
  $user = $_GET['username'];
  $pass = $_GET['pass'];
  $job = $_GET['job'];

  ?>

  <?php
  ///palidasi
  if (empty($_GET['nama']) or empty($_GET['username']) or empty($_GET['pass']) or empty($_GET['job']) or $_GET['job'] == 0 or $_GET['pro'] != 2) {
    redirect('Login/daftar?error=empty1');
  }

  ///cek email ke db E-Retail

  if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $user)) {
    $this->session->set_flashdata('pesandaftar', 'Maaf ,<br/>Email yang anda gunakan tidak valid');
    redirect("Login/daftar");
  }


  ///cek email ke db E-Retail

  $cekuser_saja = $this->Login_model->check_user_saja($user);
  $cekusernopass = $this->Login_model->check_user_nopass($pass);
  $cekusernonama = $this->Login_model->check_user_nama($nama);
  if ($cekuser_saja == TRUE) {
    $this->session->set_flashdata('pesandaftar', 'Maaf ,<br/>Email yang anda gunakan sudah terdaftar');
    redirect("Login/daftar");
  } elseif ($cekusernopass == TRUE) {
    $this->session->set_flashdata('pesandaftar', 'Maaf ,<br/>Password yang anda gunakan sudah terdaftar');
    redirect("Login/daftar");
  } elseif ($cekusernonama == TRUE) {
    $this->session->set_flashdata('pesandaftar', 'Maaf ,<br/>Nama yang anda gunakan sudah terdaftar');
    redirect("Login/daftar");
  }

  ?>

  <form action="" method="get" enctype="multipart/form-data">

    <input type="hidden" name="nama" placeholder="Nama" value="<?= $nama ?>" required>
    <input type="hidden" name="username" placeholder="Email" value="<?= $user ?>" required>
    <input type="hidden" name="pass" value="<?= $pass ?>" placeholder="Password" required>
    <input type="hidden" name="job" value="<?= $job ?>" placeholder="Password" required>
    <input type="hidden" name="pro" value="3" />

    <!---->

    <hr />

    <?php
    $pt = "PT";
    if (($job == 3 or $job == 1001) && $pt == "UMY") { ?>


      <input type="hidden" class="nim" name="ni" value="0" />
      <input type="hidden" class="prodi" name="prodi" value="0" />
      <div class="form-group has-feedback ">

        <label class="form" id="stlab">NIM : <span id="nimgrup"></span> <a href="" class="btn btn-sm">
            <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
          </a></label>

        <div class="row">

          <div class="col-xs-4">

            <label class="form" id="stlab">Tahun</label>
            <!-- <input type="text" class="form-control" name="ni_thn" id="nim_thn" required placeholder="Tahun (9999)">-->

            <select class="form-control ni_thn" name="ni_thn">

              <?php

              $thnn = date('Y') + 10;
              for ($th = 2009; $th <= $thnn; $th++) {
              ?>

                <option value="<?= $th ?>"><?= $th ?></option>

              <?php

              }

              ?>



            </select>

            <small class="text-info">(*) Wajib diisi </small><br />
            <small class="text-info">(*) ex: 2018 </small>

          </div>
          <div class="col-xs-4">

            <label class="form" id="stlab">Prodi</label>
            <input type="hidden" name="ni_prodi" value="999" />
            <!--<input type="text" class="form-control" id="nim_prodi" name="ni_prodi" required  placeholder="prodi (999)">-->
            <select class="form-control ni_prodi" disabled="disabled" name="prodi">

              <option value="0" hidden>-- Pilih Prodi -- </option>
              <?php

              $gjob = $this->M_setapp->get_tbl_fak_prodi();

              foreach ($gjob->result() as $jb) {
              ?>

                <option value="<?= $jb->kode_nim ?>"><?= $jb->kode_nim ?> - <?= $jb->nama_prodi ?></option>

              <?php

              }

              ?>



            </select>
            <small class="text-info">(*) Wajib diisi </small><br />
            <small class="text-info">(*) ex: 024 </small>


          </div>
          <div class="col-xs-4">

            <label class="form" id="stlab">No. Urut</label>
            <input type="number" maxlength="4" disabled="disabled" class="form-control nim_no" name="ni_urut" required placeholder="no. urut">
            <small class="text-info">(*) Wajib diisi </small><br />
            <small class="text-info">(*) ex: 0022 </small>


          </div>

          <!-- /.col -->



          <!-- /.col -->

        </div>




      </div>




    <?php
    } else {
    ?>
      <div class="form-group has-feedback ">

        <label class="form" id="stlab">NIK/NIM</label>
        <input type="number" class="form-control" name="ni" placeholder="NIK/NIM" required>
        <small class="text-info">(*) Wajib diisi </small>

      </div>

      <input type="hidden" name="ni_thn" value="0" />
      <input type="hidden" name="ni_prodi" value="0" />
      <input type="hidden" name="ni_urut" value="0" />
      <input type="hidden" name="prodi" value="0" />


    <?php
    }
    ?>


    <div class="form-group">

      <div class="row">

        <div class="col-xs-7">

          <input type="text" class="form-control" name="rek" placeholder="No. Rek" required>

        </div>

        <div class="col-xs-5">

          <input type="text" class="form-control" name="bank" placeholder="Bank" required>

        </div>

      </div>





    </div>

    <div class="form-group has-feedback">

      <input type="text" class="form-control" name="no" placeholder="No. Kontak" required>

      <span class="glyphicon glyphicon glyphicon-earphone form-control-feedback"></span>

    </div>
    <!--REV 2-->
    <hr />

    <div class="form-group has-feedback">

      <input type="text" class="form-control" name="ranting" placeholder="Ranting">



    </div>

    <div class="form-group has-feedback">

      <input type="text" class="form-control" name="cabang" placeholder="Cabang">



    </div>

    <div class="form-group has-feedback">

      <input type="text" class="form-control" name="daerah" placeholder="Daerah">



    </div>




    <div class="row">

      <div class="col-xs-12">

        <label class="form">Jenis kelamin</label>

        <div class="radio dckdesain">



          <input type="radio" name="jenis" value="L"> Laki-laki

          <input type="radio" name="jenis" value="P"> Perempuan



        </div>

        <small class="text-info">(*) Wajib memilih </small>

      </div>

      <!-- /.col -->



      <!-- /.col -->

    </div>









    <!--REV 2-->




    <hr />

    <div class="form-group has-feedback">
      <?php
      if ($job != 3 && $pt != "UMY") {
        $dsbtn = '';
      } else {
        $dsbtn = '';
      }

      ?>

      <button type="submit" <?= $dsbtn ?> class="btn btn-primary btn-block btn-lg btnlnjut">LANJUT TAHAP 3</button>

    </div>

  </form>