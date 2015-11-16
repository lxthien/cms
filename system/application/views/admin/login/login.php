<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />
<title>Login </title>
<?php $admin_images=$this->config->item('admin_images');?>
<link href="<?=$admin_images;?>css/960.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=$admin_images;?>css/reset.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=$admin_images;?>css/text.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?=$admin_images;?>css/login.css" rel="stylesheet" type="text/css" media="all" />
<script src="<?=$base_url;?>images/js/jquery.js"></script>
    <script>
	$(document).ready(function(){
						$(':input[name="username"]').focus();
						$("#btnSubmit").click(function(){
							var user=$("#tbxUser").val();
							if(user=='')
							{
								alert('Vui lòng nhập tài khoản');
								$("#tbxUser").focus();
								return false;
							}
														
							var pass=$("#tbxPass").val();
							if(pass=='')
							{
								alert('Vui lòng nhập mật khẩu');
								$("#tbxPass").focus();
								return false;
							}
							
							$("#frmLogin").submit();
							
						});
						$('.black_button').click(function(){$("#frmLogin").submit();});
						
							$('.btenter').bind('keypress', function(e) {
											var code = (e.keyCode ? e.keyCode : e.which);
										 if(code == 13) { //Enter keycode
										   //Do something
										  frm=$(this).parents('form');
										   frm.submit();
										 }
							
									});});
					
	
    </script>
</head>

<body>
<div class="container_16">
  <div class="grid_6 prefix_5 suffix_5">
   	  <h1><a href="<?=$base_url;?>" target="_blank" style="color: #FFFFFF"><?=getconfigkey("admin_title");?></a></h1>
    	<div id="login">
    	  <p class="tip">Tắt phần mềm gõ tiếng việt để nhập chính xác!</p>
          <p class="error"><?php if($msg!="")  echo $msg; ?></p>        
    	  <form name="frmLogin" id="frmLogin" action="<?php echo $base_url;?>admin/login" method="post">
    	    <p>
    	      <label><strong>Username</strong>
<input type="text" id="tbxUser" name="username" class="inputText"  />
    	      </label>
  	      </p>
    	    <p>
    	      <label><strong>Password</strong>
  <input type="password" id="tbxPass" name="password" class="inputText btenter"  />
  	        </label>
    	    </p>
    		<a class="black_button"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Đăng nhập &nbsp;&nbsp;</span></a>
             <label>
             <input type="checkbox" name="checkbox" id="checkbox" />
              Remember me</label>            
    	  </form>
		  <br clear="all" />
    	</div>
        <div id="forgot">
        <a href="#" class="forgotlink"><span>Forgot your username or password?</span></a></div>
  </div>
</div>
<br clear="all" />
</body>

</html>