  <form action="" method="get" enctype="multipart/form-data">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" name="nama" placeholder="Nama" required>

        <small class="text-info">(*) Pastikan kolom nama diisi dengan benar </small>

        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="email" class="form-control" name="username" placeholder="Email" required>

        <small class="text-danger">(*) Pastikan kolom email anda benar dan terdaftar untuk kepentingan notifikasi</small>

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password"  class="form-control form-password" name="pass" placeholder="Password" required>

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback dck">

        <input type="checkbox" id="ck"> Lihat Password</input>

      </div>

       <!--hapus-->

      <!--REV 2-->

      

       <div class="row">

        <div class="col-xs-12">

        <hr/>

        <label class="form">Status </label>

         <br/>

        <select name="job" class="form-control" required >
        <option value="0" hidden > Wajib diisi </option>
        <?php

        $gjob=$this->M_setapp->get_tbl_st_job();

        foreach($gjob->result() as $jb){
            
           

            ?>

             <option value="<?=$jb->id_job?>"><?=$jb->nama_job?></option>

            <?php

        }

        ?>

        </select>
        <small class="text-info">(*) Kolom status wajib memilih </small>

        

        </div>


      </div> 

          

    


      <input type="hidden" name="pro" value="2"/>


      <!--REV 2-->

      

<hr/>      

      



      <hr/>

       <div class="form-group has-feedback">

          <button type="submit" class="btn btn-primary btn-block btn-lg">LANJUT TAHAP 2</button>

      </div>

    </form>