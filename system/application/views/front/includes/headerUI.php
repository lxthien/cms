<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$this->page_title;?></title>
    <meta name="description" content="<?=$this->page_description;?>" />
    <meta name="keywords" content="<?=$this->page_keyword;?>" />
    <meta name="language" content="vietnamese" />
    <?php if($this->isRobotFollow){ ?>
    <meta name="ROBOTS" content="INDEX,FOLLOW" />
    <?php }else {  ?>
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />
    <?php } ?>
    <link rel="canonical" href="<?=$this->uri;?>" />
	
	<?php if($this->isImagesShare != ''){ ?>
	<meta property="og:image" content="<?php echo $this->isImagesShare; ?>" />
	<?php } ?>
	<meta property="og:site_name" content="dichvusuanhadandung.com" />

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $base_url; ?>images/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="<?php echo $base_url; ?>images/boostrap/css/bootstrap-theme.min.css" rel="stylesheet">

    <link href="<?php echo $base_url; ?>images/boostrap/css/docs.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo $base_url; ?>images/boostrap/css/styles.css" rel="stylesheet">

    <!-- CSS STYLE-->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>images/css/revolution/style.css" media="screen" />

    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>images/css/revolution/extralayers.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>images/css/revolution/settings.css" media="screen" />

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="<?php echo $base_url; ?>images/boostrap/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo $base_url; ?>images/boostrap/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="<?php echo $base_url; ?>images/css/flexslider/flexslider.css" type="text/css" media="screen" />

</head>