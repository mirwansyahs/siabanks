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
        <?php if (!empty($instance->instance_image)){ ?>
        <link rel="icon" href="<?=base_url()?>assets/images/resources/<?=$instance->instance_image?>" type="image/x-icon"/>
        <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/images/resources/<?=$instance->instance_image?>" />
        <?php }else{ ?>
        <link rel="icon" href="<?=base_url()?>assets/images/resources/favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/images/resources/favicon.ico" />
        <?php } ?>

        <link href='https://plus.google.com/USER-GOOGLE-PLUS/posts' rel='publisher'/>
        <link href='https://plus.google.com/USER-GOOGLE-PLUS/about' rel='author'/>
        <link href='https://plus.google.com/USER-GOOGLE-PLUS' rel='me'/>
        <meta content='KODE-VALIDASI-GOOGLE-WEBMASTER' name='google-site-verification'/>
        <meta content='KODE-VALIDASI-BING-WEBMASTER' name='msvalidate.01'/>
        <meta content='Indonesia' name='geo.placename'/>
        <meta content='Mohammad Irwansyah Somantri' name='Author'/>
        <meta content='general' name='rating'/>
        <meta content='id' name='geo.country'/>

        <meta content='https://www.facebook.com/teguh99910' property='article:author'/>
        <meta content='https://www.facebook.com/teguh99910' property='article:publisher'/>
        <meta content='KODE-APLIKASI-FACEBOOK' property='fb:app_id'/>
        <meta content='KODE-ADMIN-FACEBOOK' property='fb:admins'/>
        <meta content='en_US' property='og:locale'/>
        <meta content='en_GB' property='og:locale:alternate'/>
        <meta content='id_ID' property='og:locale:alternate'/>
        <meta content='summary' name='twitter:card'/>
        <meta content='USER-TWITTER' name='twitter:site'/>
        <meta content='USER-TWITTER' name='twitter:creator'/>
        <meta content='summary_large_image' name='twitter:card'/>

        <!-- Generated: 2018-04-16 09:29:05 +0200 -->

        <?php if (!empty($instance->instance_nama)){ ?>
        <title><?=$instance->instance_nama?></title>
        <?php }else{ ?>
        <title>SMK NEGERI 4 KUNINGAN</title>
        <?php } ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
        <script src="<?=base_url()?>/assets/js/require.min.js"></script>
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
    </head>