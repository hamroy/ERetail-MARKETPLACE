<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title0 ?></title>
  <!-- jQuery 2.2.3 -->

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= $title0 ?>">

  <meta name="author" content="hamroy">
  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>image/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>image/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>image/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= base_url() ?>image/favicon/site.webmanifest">
  <link rel="mask-icon" href="<?= base_url() ?>image/favicon/safari-pinned-tab.svg" color="#5bbad5">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url() ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $this->M_setapp->static_bm() ?>/dist/css/AdminLTE.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= $this->M_setapp->static_bm() ?>plugins/iCheck/square/blue.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition login-page">

  <?php
  /// ////BOX 
  $this->load->view($view);
  /////////
  ?>
  <footer class="text-center">
    <strong>Copyright &copy; <?= date('Y') ?> || <a href="#" target="_blank">E-Retail SUPERMALL</a></strong>
  </footer>
  <!-- /.login-box -->
  <script src="<?= $this->M_setapp->static_bm() ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

  <!-- Bootstrap 3.3.6 -->
  <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?= $this->M_setapp->static_bm() ?>plugins/iCheck/icheck.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#ck').click(function() {
        if ($(this).is(':checked')) {
          $('.form-password').attr('type', 'text');
        } else {
          $('.form-password').attr('type', 'password');
        }
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $('.sta').change(function() {
        if ($('.sta option:selected').text() == "Mahasisiwa UMY") { //
          $('.stlab').show();
          document.getElementById("stlab").innerHTML = "NIM";
        } else {
          $('.stlab').hide();
          document.getElementById("stlab").innerHTML = "NIK/NIM";
        }
      });

      $('.ni_thn').change(function() {
        grupn = $('.ni_thn option:selected').text();

        $('#nimgrup').html(grupn); ///bhasa jquery

        $('.ni_thn').attr('disabled', 'disabled');
        $('.ni_prodi').removeAttr('disabled', '');

        //proses selanjutnya pilih prodi

        $('.ni_prodi').change(function() {


          prodiut = $('.ni_prodi option:selected').val();


          grupns = grupn + prodiut;

          document.getElementById("nimgrup").innerHTML = grupns; ///bhasa js
          $('.ni_prodi').attr('disabled', 'disabled');
          $('.nim_no').removeAttr('disabled', '');
          $('.prodi').val(prodiut); ///bhasa jquery

          ///tahap no urut

          $('.nim_no').keyup(function() {


            prodiut1 = $('.nim_no').val();


            if ($('.nim_no').val().length >= 4) {
              // alert('masih kurang');
              $('.btnlnjut').removeAttr('disabled', '');
              $('.nim_no').attr('disabled', 'disabled');


            }

            grupns_ = grupns + prodiut1;
            $('.nim_no').attr('id', 'nim_no');

            $('.nim').val(grupns_);

            document.getElementById("nimgrup").innerHTML = grupns_;







          });
        });


      });


    });

    $(document).ready(function() {
      $('.radio').click(function() {

        var f = $('input[name=jenis]:checked').val().length;

      });


    });
  </script>

  <script>
    $(function() {
      $('.dckdesain').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
      });
    });
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

  <script type="text/javascript">
    $('.fakprodi').select2({
      placeholder: '--- Pilih Prodi ---',
      ajax: {
        url: '<?= base_url() ?>C_select2',
        dataType: 'json',
        type: "GET",
        delay: 100,
        processResults: function(data) {
          return {
            results: data
          };
        },
        cache: true
      }
    });
  </script>
  <script>
    $(":input").inputmask();

    $("#nim_thn,#nim_no").inputmask({
      "mask": "9999"
    });
    $("#nim_prodi").inputmask({
      "mask": "999"
    });
    //# sourceURL=pen.js
  </script>
</body>

</html>