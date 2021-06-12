<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name='description' content='SIABANKS - Adalah Sistem Informasi Aplikasi Bank Sampah, bertujuan agar dapat memberdayakan masyarakat dalam pengelolaan sampah.' />
    <meta property='og:description' content='SIABANKS - Adalah Sistem Informasi Aplikasi Bank Sampah, bertujuan agar dapat memberdayakan masyarakat dalam pengelolaan sampah.' />
    <?php if (!empty($instance->instance_image)){ ?>
    <link rel="icon" href="<?=base_url()?>assets/images/resources/<?=$instance->instance_image?>" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/images/resources/<?=$instance->instance_image?>" />
    <?php }else{ ?>
    <link rel="icon" href="<?=base_url()?>assets/images/resources/logo.png" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/images/resources/logo.png" />
    <?php } ?>
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <?php if (!empty($instance->instance_nama)){ ?>
    <title><?=$instance->instance_nama?></title>
    <?php }else{ ?>
    <title>SI-ABANKS</title>
    <?php } ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="<?=base_url()?>/assets/js/require.min.js"></script>
    <!--<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.js"></script>
    <!-- <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script> -->
    <!-- Dashboard Core -->
    <link href="<?=base_url()?>/assets/css/dashboard.css" rel="stylesheet" />
    <script src="<?=base_url()?>/assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="<?=base_url()?>/assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="<?=base_url()?>/assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="<?=base_url()?>/assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="<?=base_url()?>/assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="<?=base_url()?>/assets/plugins/input-mask/plugin.js"></script>
		<script src="<?=base_url()?>assets/js/jquery-2.1.4.min.js"></script>
    
  </head>
  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto" style="">
              <div class="text-center mb-2">
                <!-- START IMAGE INSTANCE -->
                <?php if (!empty($instance->instance_image)){ ?>
                <img src="<?=base_url()?>assets/images/resources/<?=$instance->instance_image?>" class="h-4" alt="">
                <?php }else{ ?>
                <img src="<?=base_url()?>assets/images/resources/logo.png" class="h-6" alt="">
                <?php } ?>
                <!-- END IMAGE INSTANCE -->
                
                <!-- START NAMA INSTANCE -->
                <?php if (!empty($instance->instance_nama)){ ?>
                <?=$instance->instance_nama?>
                <?php }else{ ?>
                <span style="font-size: 14px; margin-left: 10px; font-weight: 800;">
                SI-ABANKS
                </span>
                <?php } ?>
                <!-- END NAMA INSTANCE -->
              </div>
              <form class="card send-data" id="regist" method="post">
                <div class="card-body p-6">
                  <div class="show"></div>
                  <div class="card-title">Pendaftaran pengguna</div>
                  <div class="form-group">
                    <label class="form-label"> NIK (*) </label>
                    <input type="number" placeholder="1122334455667788" class="form-control" name="NIK" id="NIK"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16" required="required" autocomplete="off" />
                  </div>

                  <div class="form-group">
                    
                    <label class="form-label"> Nama Depan (*) </label>
                    <input type="text" placeholder="Nama Depan" class="form-control" name="Nama_Depan" required="required" autocomplete="off" />
                  </div>

                  <div class="form-group">
                    
                    <label class="form-label"> Nama Belakang </label>
                    <input type="text" placeholder="Nama Belakang" class="form-control" name="Nama_Belakang" value="" autocomplete="off" />
                  </div>

                  <div class="form-group">
                    
                    <label class="form-label"> Email (*) </label>
                    <input type="email" placeholder="xxx@email.com" class="form-control" name="Email" required="required" autocomplete="off" />
                  </div>

                  <div class="form-group">
                    
                    <label class="form-label"> Tempat Lahir (*) </label>

                    <input type="text" placeholder="Tempat Lahir" class="form-control" name="Tempat_Lahir" required="required" autocomplete="off" />
                    
                  </div>

                  <div class="form-group">
                    
                    <label class="form-label">Tanggal Lahir (*) </label>

                    <input type="date" placeholder="17/06/2001" class="form-control" name="Tanggal_Lahir" id="Tgl" required="required" autocomplete="off" />
                  </div>
                  <div class="form-footer">
                    <a href="#" class="btn btn-primary btn-block simpan">Daftar</a>
                  </div>
                </div>
                <div class="card-footer">
                    <a href="<?=base_url()?>" class="text-right" style="float: right">Masuk?</a>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script>
      $(".simpan").click(function(){
                        
          var data = $('.send-data').serialize();
          $.ajax({
              type: 'POST',
              url: '<?=base_url('Regist/sign')?>',
              data: data,
              success: function(result) {
                data = JSON.parse(result);
                if (data.msg == "err"){
                  $('.show').html(data.psn);
                }else{ 
                  location.replace('<?=base_url()?>');    
                  // setInterval(function(){
                  //     location.reload();
                  // // }, 1000)               
                  // $('[name="Keahlian"]').val("");
                  // $('[name="ID"]').val("");
                }
              }
          });
      });
  </script>
</html>
