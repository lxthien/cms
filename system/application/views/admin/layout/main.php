<?php $admin_resource= $base_url.'images/admin/';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<noscript><meta http-equiv="refresh" content="0;URL=<?=$base_url;?>noscript.html" /></noscript>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />
<title>Dashboard | Modern Admin</title>
<base href="<?=$base_url;?>" />
<link rel="stylesheet" href="<?=$base_url;?>images/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?=$base_url;?>images/admin/css/960.css" />
<link rel="stylesheet" type="text/css" href="<?=$base_url;?>images/admin/css/blue.css?v1" />
 <link type="text/css"        href="<?=$base_url;?>images/js/jqueryui/css/smoothness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?=$base_url;?>images/js/jqueryui/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?=$base_url;?>images/js/jqueryui/js/jquery-ui-1.8.24.custom.min.js"></script>
<script type="text/javascript" src="<?=$base_url;?>images/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<script type="text/javascript" src="<?=$base_url;?>images/admin/js/effects.js?v1"></script>
<script type="text/javascript" src="<?=$base_url;?>images/js/jquery.validate.js?v1"></script>
<script type="text/javascript">
    $().ready(function(){
       $.validator.messages.required = "Vui lòng nhập ô này";
       $.validator.messages.email = "Email này chưa đúng.";
        
    });
</script>
<style type="text/css">
.error{
    border: 1px red solid;
    color: red;
}
label.error{
    border:0;
}
</style>
<script type="text/javascript">
$().ready(function(){
	$("a.fancylink").fancybox({});
    $("a.clearCache").click(function(){
       $.ajax({
            type:"get",
            url:'<?=$base_url;?>admin/dashboard/clearCache'
       }); 
       return false;
    });
});
</script>    
<noscript>Vui lòng kích hoạt javascript!</noscript>
</head>
<body>
<!-- WRAPPER START -->
<div class="container_16" id="wrapper">	
	<!-- HIDDEN COLOR CHANGER -->      
      
  	<!--LOGO-->
	<div class="grid_8" id="logo"><a href="<?=$base_url;?>" target="_blank" style="color: #FFFFFF"><?=getconfigkey("admin_title");?></a></div>
    <div class="grid_8">
    <!-- USER TOOLS START -->
          <div id="user_tools" style="float: left;"><span><a href="#" class="clearCache">Clear Cache</a> </span></div>  
          <div id="user_tools"><span><a href="#" class="mail">(0)</a> Welcome <a href="<?=$this->admin_url;?>adminusers/account"><?php echo $this->logged_in_user->fullname;?></a>  | |  <a href="<?=$this->admin_url;?>logout">Logout</a></span></div>
    
    <!-- USER TOOLS END -->    
    </div>
    <!-- MENU START -->
    <?php $this->load->view('admin/layout/header');?>
    <!-- MENU END -->

    <!-- HIDDEN SUBMENU START -->
    <?php $this->load->view('admin/layout/hidden_menu');?>
    <!-- HIDDEN SUBMENU END -->  

    <!-- CONTENT START -->
    <div class="grid_16" id="content">
    	  <!--  TITLE START  --> 
        <div class="grid_13">
        <h1 class="dashboard"><?=$title;?></h1>
        </div>
        <!--RIGHT TEXT/CALENDAR-->
        <div class="grid_2" id="eventbox" style="width:100px !important;"><a href="#" class="inline_tip">Trợ giúp</a></div>
        <!--RIGHT TEXT/CALENDAR END-->
    <div class="clear">
    </div>
     <div class="clear"></div>
    <!--  TITLE END  -->
     
      <?php $this->load->view('admin/'.$view,array('admin_resource'=>$admin_resource));?>  
    
      <div class="clear"> </div>
    </div>
    <!-- END CONTENT--> 
    <div class="clear"> </div> 
 </div>
    
<div class="clear"> </div>      
<!-- WRAPPER END -->
<!-- FOOTER START -->
<div class="container_16" id="footer">
 </div>
<div>
<span>Load Time:<?php echo $this->benchmark->elapsed_time();?>s | Memory User:<?php echo $this->benchmark->memory_usage();?></span>
</div>
<?php $this->load->view("admin/layout/loadDialog");?>

<!-- FOOTER END -->
<div class="cl"><!----></div>
	<div style="" id="ajax-indicator"><span>Loading...</span></div>
	<div style="" id="error-indicator">
		<span class="error-message"></span><br>
		<span class="error-detail"></span><br>
		<div class="cl"></div>
		<input type="button" class="btnCloseErrorDetail" value="Error Detail">
		<input type="button" class="btnCloseErrorMessage" value="Close">
	</div>
	<div id="dialog-error" class="requiredDialog" title="Error">
		<div class="dialog-error-icon"></div>
		<div class="dialog-error-content"></div>
	</div>
	
	<div id="dialog-message" class="requiredDialog" title="Message">
		<div class="dialog-message-icon">&nbsp;</div>
		<div class="dialog-message-content"></div>
	</div>
	
	<div id="dialog-message-confirm" class="requiredDialog" title="Message">
		<div class="dialog-message-icon">&nbsp;</div>
		<div class="dialog-message-content"></div>
	</div>
    
</body>
</html>

   
