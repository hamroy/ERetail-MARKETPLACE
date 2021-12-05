 <style>
.li{
  display: inline-block;
  color: #F0F0F0;
  text-shadow: 0 0 1px #666666;
  font-size:30px;
}
.highlight, .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
</style>
    <style>
.li2{display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:30px;}
.highlight2, .selected2 {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
</style>
 <section class="content-header" style="background: #ecedee;">
 </section>



    <!-- Main content -->

    <section class="content">

    

    <div class="well">

    	<h3><b>BERI RATING DAN ULASAN PRODUK PENJUAL</b></h3>


    </div>

    

<?php

	$message = $this->session->flashdata('pesan');

    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';

    ?>

    <?php

	$message0 = $this->session->flashdata('pesan0');

    	echo $message0 == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message0 . '</p></div>';

    ?>

    <!--NAV-->

    <?php
           
        $fotob = $this->M_setapp->static_bm().'/upload/barang/2424234.mpng'; 
        $fotob = base_url().'/upload/barang/image_1526314444.jpg'; 
   
        $la='src="'.$fotob.'"';

    ?>
		 <div class="modal-body" style="background: #ffffff; border-radius: 60px">

         <!--upload-->

        <form class="form-horizontal" action="<?=base_url('Login/update_bio_file/'.$this->session->userdata('id_user'))?>" method="post" enctype="multipart/form-data" >


                  <div class="form-group">
                    <div class="col-sm-4" align="center">
                     <img <?=$la?> data-original="<?=$fotob?>" style="width: 200px;height: 200px" class="img-rounded lazy">
                     <br/>
                     <h4>ALQURAN TERBARU UNLIMITED</h4>
                     <h5>Hroy store</h5>

                    </div>

                    <div class="col-sm-8">
                    <label for="inputName" class="control-label">RATING</label><br/>

                    <input type="hidden" value="" name="rating" id="rating" />
                    <ul onmouseout="resetRating();">
                      <li id="star" class="li" title="Sangat Tidak Puas"  onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
                      <li id="star"class="li" title="Tidak Puas" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li> 
                      <li id="star" class="li" title="Cukup Puas" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
                      <li id="star"class="li" title="Puas" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
                      <li id="star" class="li"  title="Sangat Puas" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
                      
                    </ul>

                    <label for="inputName" class="control-label">ULASAN</label><br/>

                    <input type="text" class="form-control br" id="inputName" value="<?=$nbm?>" name="file" placeholder="NBM"><br/>
                    
                    <button type="submit" class="btn btn-primary">Kirim</button>

                    </div>

                  </div>
        </form>

        <!--upload-->

      </div>
     <!--ISI per kategori-->

    </section>

     <!--STAR RANTING-->       
      <script>
function highlightStar(obj) {
  removeHighlight();    
  $('.li').each(function(index) {
    $(this).addClass('highlight');
    if(index == $(".li").index(obj)) {
      return false; 
    }
  });

}

function removeHighlight() {
  $('.li').removeClass('selected');
  $('.li').removeClass('highlight');
}

function addRating(obj) {
  $('.li').each(function(index) {
    $(this).addClass('selected');
    $('#rating').val((index+1));
    if(index == $(".li").index(obj)) {
      return false; 
    }
  });
}

function resetRating() {
  if($("#rating").val()) {
    $('.li').each(function(index) {
      $(this).addClass('selected');
      if((index+1) == $("#rating").val()) {
        return false; 
      }
    });
  }
}

  $(window).load(function() { 
  if($("#rating").val()) {
    $('.li').each(function(index) {
      $(this).addClass('selected');
      if((index+1) == $("#rating").val()) {
        return false; 
      }
    });
    }
   })
</script>

    

