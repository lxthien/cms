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

    
    <script type="text/javascript">
        <!--
        var base_url = "http://dienlanhtheviet.com.vn/";
        // -->
    </script>
    <link href="http://dienlanhtheviet.com.vn/assets/public/the-viet/css/screen.css" rel="stylesheet" type="text/css"/>
    <link href="http://dienlanhtheviet.com.vn/assets/public/the-viet/css/qc.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="http://dienlanhtheviet.com.vn/assets/public/the-viet/js/jquery.js"></script>
    <script type="text/javascript"
            src="http://dienlanhtheviet.com.vn/assets/public/the-viet/js/jquery.ifixpng2.js"></script>
    <script type="text/javascript" src="http://dienlanhtheviet.com.vn/assets/public/the-viet/js/commons.js"></script>
    <script type="text/javascript" src="http://dienlanhtheviet.com.vn/assets/public/the-viet/js/swfobject.js"></script>
    <script type="text/javascript" language="javascript"
            src="http://dienlanhtheviet.com.vn/assets/public/the-viet/js/script_jcarousellite.js"></script>
    <link href="http://dienlanhtheviet.com.vn/assets/public/the-viet/css/jquerycssmenu.css" rel="stylesheet"
          type="text/css"/>
    <script type="text/javascript" language="javascript"
            src="http://dienlanhtheviet.com.vn/assets/public/the-viet/js/jquerycssmenu.js"></script>
    <script type="text/javascript">
        function rnd() {
            return String((new Date()).getTime()).replace(/\D/gi, '')
        }
    </script>

</head>