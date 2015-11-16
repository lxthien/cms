
<script language="javascript" type="text/javascript" src="<?php echo $base_url;?>ckeditor/ckeditor.js"></script>
<script language="javascript" type="text/javascript" src="<?=$base_url; ?>images/js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$('#myform').validate({			

			rules:{
				name:{
					required: true,
					maxlength:50
				},
				email:{
					required: true,
					email:true
				},
                address:{
                    required: true
                },
                phone:{
                    number: true,
                    required: true
                },
                content:{
					required: true
				},
				captcha_code:{
					required: true
				}
				
			},
			messages:{
				name:{
					required: "<font color=red>Vui lòng nhập họ tên của bạn</font>",
					maxlength:"<font color=red>Tên không quá 50 kí tự</font>"
				},
				email:{
					required: "<font color=red>Vui lòng nhập địa chỉ email</font>",
					email: "<font color=red>Nhập đúng dạng địa chỉ email</font>"
				},
                address:{
                    required: "<font color=red>Vui lòng nhập địa chỉ</font>"
                },
                phone:{
                    number: "<font color=red>Vui lòng chỉ nhập số</font>",
                    required: "<font color=red>Vui lòng nhập số điện thoại</font>"
                },
                content:{
					required: "<font color=red>Vui lòng nhập nội dung</font>"
				},
				captcha_code:{
					required: "<font color=red>Nhập lại mã bảo vệ</font>"
				}
			}
		});

        $('#myform-company').validate({         

            rules:{
                name_company:{
                    required: true,
                    maxlength:50
                },
                address_company:{
                    required: true
                },
                email:{
                    required: true,
                    email:true
                },
                name:{
                    required: true
                },
                phone:{
                    number: true,
                    required: true
                },
                content:{
                    required: true
                },
                captcha_code:{
                    required: true
                }
                
            },
            messages:{
                name_company:{
                    required: "<font color=red>Vui lòng nhập tên công ty</font>",
                    maxlength:"<font color=red>Tên không quá 50 kí tự</font>"
                },
                address_company:{
                    required: "<font color=red>Vui lòng nhập địa chỉ công ty</font>"
                },
                email:{
                    required: "<font color=red>Vui lòng nhập địa chỉ email</font>",
                    email: "<font color=red>Nhập đúng dạng địa chỉ email</font>"
                },
                name:{
                    required: "<font color=red>Vui lòng nhập tên của bạn</font>"
                },
                phone:{
                    number: "<font color=red>Vui lòng chỉ nhập số</font>",
                    required: "<font color=red>Vui lòng nhập số điện thoại</font>"
                },
                content:{
                    required: "<font color=red>Vui lòng nhập nội dung</font>"
                },
                captcha_code:{
                    required: "<font color=red>Nhập lại mã bảo vệ</font>"
                }
            }
        });

	});
	
</script>

<div id="right-cata"> 
    <div class="wrapper main-about-us" style="margin-left: 0px;">
    	<?php echo $news->full_vietnamese; ?>      
	</div>
	<br>
	<div class="cl"></div>
    <h2 class="h2-bg">Form mua Fleet</h2>
    <div>
        <br />
        <div class="clr"><!----></div>
        <?php if(isset($msg) && $msg!="" ){ if($msg_type  == 1) { ?>
            <div style="margin: 0px 0 20px;font-weight:600;padding: 5px 0 5px 5px; color: #0c8e06; border: 5px solid #9FCF9F;"><?=$msg;?></div>
        <?php } }?>
        <table>
        	<tr>
                <td style="width: 108px; text-align: left;"><strong>Bạn là:</strong></td>
                <td style="text-align: left;">
                	<label for="persion"><input checked="checked" id="persion" name="select-one" type="radio" value="1" /> Cá nhân</label>
                    <label for="company"><input id="company" name="select-one" type="radio" value="0" /> Công ty</label>
                </td>
            </tr>
        </table>
        <form id="myform" action="<?=site_url("mua-fleet.html");?>" method="post" class="form-persion">
            <table border="0" >
                <input name="selectone" type="hidden" value="1" />
            	<tr>
                    <td>Họ và tên:<span style="color:#F00">&nbsp;(*)</span></td>
                    <td><input name="name" type="text" style="width:600px;" value="<?=$contact->name;?>" /></td>
                </tr>
                <tr>
                    <td>Giới tính:<span style="color:#F00">&nbsp;(*)</span></td>
                    <td style="text-align: left;">
                        <label for="male"><input <?php echo $contact->sex == 0 ? 'checked="checked"' : ''; ?> id="male" name="sex" type="radio" value="0" /> Nam</label>
                        <label for="female"><input <?php echo $contact->sex == 1 ? 'checked="checked"' : ''; ?> id="female" name="sex" type="radio" value="1" /> Nữ</label>
                    </td>
                </tr>
                <tr>
                    <td>Địa chỉ:<span style="color:#F00">&nbsp;(*)</span></td>
                    <td><input name="address" type="text" style="width:600px;" value="<?=$contact->address; ?>"/></td>
                </tr>
                <tr>
                    <td>Điện thoại:<span style="color:#F00">&nbsp;(*)</span></td>
                    <td><input name="phone" type="text" style="width:600px;" value="<?=$contact->phone; ?>"/></td>
                </tr>
                <tr>
                    <td>Email:<span style="color:#F00">&nbsp;(*)</span></td>
                    <td><input name="email" type="text" style="width:600px;"  value="<?=$contact->email; ?>" /></td>
                </tr>
                <tr>
                    <td>Nội dung:<span style="color:#F00">&nbsp;(*)</span></td>
                    <td><textarea style="resize: none;" name="content"><?=$contact->content;?></textarea>
                    <script type="text/javascript">
                        editor=CKEDITOR.replace( 'content',
                        {
                            toolbar :[['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'FontSize', 'TextColor'], [ 'UIColor' ]],
                            height: 200,
                            width: 610,
                            resize_enabled: false
                        });
                    </script>
                    </td>
                </tr>
                <tr>
                    <td>Mã bảo vệ:<span style="color:#F00">&nbsp;(*)</span></td></td>
                    <td class="td-capcha">
                        <div class="fl">
                            <img id="captcha" src="<?=$base_url;?>securimage/securimage_show.php" alt="CAPTCHA Image" />
                        </div>
                        <div class="fl" style="padding-left: 5px;">
                            <div><a href="#" onclick="document.getElementById('captcha').src = '<?=$base_url;?>/securimage/securimage_show.php?' + Math.random(); return false">[ Hình khác ]</a></div>
                            <div style="height: 3px;"></div>
                            <input type="text" name="captcha_code"  maxlength="6" />
                            <?php if(isset($msg) && $msg!="" ){ if($msg_type  == 2) { ?>
                                <div style="color:red"><?=$msg;?></div>
                            <?php } }?>
                        </div>
                        <div class="clr"></div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="button"><input type="submit" value="Gửi" /></div>
                    </td>
                </tr>
            </table>
        </form>
        <form id="myform-company" action="<?=site_url("mua-fleet.html");?>" method="post" class="form-company">
            <table border="0" >
                <input name="selectone" type="hidden" value="0" />
                <tr>
                    <td>Tên công ty:<span style="color:#F00">&nbsp;(*)</span></td>
                    <td><input name="name_company" type="text" style="width:600px;" value="<?=$contact->name_company; ?>"/></td>
                </tr>
                <tr>
                    <td>Địa chỉ:<span style="color:#F00">&nbsp;(*)</span></td>
                    <td><input name="address_company" type="text" style="width:600px;" value="<?=$contact->address_company; ?>"/></td>
                </tr>
                <tr>
                    <td>Người liên hệ:<span style="color:#F00">&nbsp;(*)</span></td>
                    <td><input name="name" type="text" style="width:600px;" value="<?=$contact->name;?>" /></td>
                </tr>
                <tr>
                    <td>Giới tính:<span style="color:#F00">&nbsp;(*)</span></td>
                    <td style="text-align: left;">
                        <label for="male"><input <?php echo $contact->sex == 0 ? 'checked="checked"' : ''; ?> id="male" name="sex" type="radio" value="0" /> Nam</label>
                        <label for="female"><input <?php echo $contact->sex == 1 ? 'checked="checked"' : ''; ?> id="female" name="sex" type="radio" value="1" /> Nữ</label>
                    </td>
                </tr>
                <tr>
                    <td>Điện thoại:<span style="color:#F00">&nbsp;(*)</span></td>
                    <td><input name="phone" type="text" style="width:600px;" value="<?=$contact->phone; ?>"/></td>
                </tr>
                <tr>
                    <td>Email:<span style="color:#F00">&nbsp;(*)</span></td>
                    <td><input name="email" type="text" style="width:600px;"  value="<?=$contact->email; ?>" /></td>
                </tr>
                <tr>
                    <td>Nội dung:<span style="color:#F00">&nbsp;(*)</span></td>
                    <td><textarea style="resize: none;" name="content_company"><?=$contact->content_company;?></textarea>
                    <script type="text/javascript">
                        editor=CKEDITOR.replace( 'content_company',
                        {
                            toolbar :[['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'FontSize', 'TextColor'], [ 'UIColor' ]],
                            height: 200,
                            width: 610,
                            resize_enabled: false
                        });
                    </script>
                    </td>
                </tr>
                <tr>
                    <td>Mã bảo vệ:<span style="color:#F00">&nbsp;(*)</span></td></td>
                    <td class="td-capcha">
                        <div class="fl">
                            <img id="captcha" src="<?=$base_url;?>securimage/securimage_show.php" alt="CAPTCHA Image" />
                        </div>
                        <div class="fl" style="padding-left: 5px;">
                            <div><a href="#" onclick="document.getElementById('captcha').src = '<?=$base_url;?>/securimage/securimage_show.php?' + Math.random(); return false">[ Hình khác ]</a></div>
                            <div style="height: 3px;"></div>
                            <input type="text" name="captcha_code"  maxlength="6" />
                            <?php if(isset($msg) && $msg!="" ){ if($msg_type  == 2) { ?>
                                <div style="color:red"><?=$msg;?></div>
                            <?php } }?>
                        </div>
                        <div class="clr"></div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="button"><input type="submit" value="Gửi" /></div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="clr"></div>
</div>
<script type="text/javascript">
$().ready(function(){
	$('form.form-company').hide();

	$('input[name="select-one"]').click(function(){
		if($(this).val() == 0){
			$('form.form-company').show();
			$('form.form-persion').hide();
		}else{
			$('form.form-persion').show();
			$('form.form-company').hide();
		}
	});
});
</script>