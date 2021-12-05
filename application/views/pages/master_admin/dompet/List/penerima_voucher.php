
<div class="box-header with-border">

             

  <div class="box-tools pull-right">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
               <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>UNIT KERJA</th>
                    <th>Tanggal Daftar</th>
                    <th>Tanggal ACC</th>
                    <th>SALDO</th>
                  </tr>
                  </thead>
                  <tbody>
                   
            <?php                   
            if($get_all_id_produk->num_rows() > 0){
            
            $no=1;
            foreach($get_all_id_produk->result() as $gidp){ 
            $getnama=$this->Muser->get_id_pass_nos($gidp->id_user);
            if($getnama->num_rows() > 0){
              $getnama0=$getnama->row()->nama;
            }else{
              $getnama0='nama kosong';
            }
        
            ?>
          <tr >
                    <td><?=$no++?></td>
                    <td><a ><?=$getnama0?></a></td>
                    <td><?=$gidp->nik?></td>
                    <td><?=$gidp->unit?></td>
                    <td><?=$gidp->tanggal_p?> <?=$gidp->waktu?></td>
                    <td><?=$gidp->tanggal_acc?></td>
                    <td><?=$gidp->saldo_awal?></td>
                    
                 
                   
                  </tr>  
    <?php } 
              } ?>
                                
                  </tbody>
                </table>
               
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          
            <!-- /.box-footer -->
          </div>  