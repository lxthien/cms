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
	});
	
</script>
<div id="right-cata" class="news-contents">
    <div class="wrapper" style="margin-bottom:10px">
        <?php
        echo '<h1 class="h2-bg" style="margin-bottom: 10px; border: none;">'.$news->{'title_vietnamese'}.'</h1>';
        echo '<div>'.$news->{'full_vietnamese'}.'</div>';
        ?>
    </div>
    <div class="comment-facebook" style="margin-left: 0;">
        <div class="fb-comments" migrated="1" data-href="<?php echo $this->uri; ?>" data-width="780" data-numposts="50" data-colorscheme="light"></div>
    </div>
    <div class="cl"></div>
    <h2 class="h2-bg">Form liên hệ <?php echo $news->{'title_vietnamese'}; ?></h2>
    <div>
        <br />
        <div class="clr"><!----></div>
        <?php if(isset($msg) && $msg!="" ){ if($msg_type  == 1) { ?>
            <div style="margin: 0px 0 20px;font-weight:600;padding: 5px 0 5px 5px; color: #0c8e06; border: 5px solid #9FCF9F;"><?=$msg;?></div>
        <?php } }?>
        <!--<div style="margin-left: 8px;"><strong>Vui lòng nhập thông tin bên dưới để liên hệ với chúng tôi:</strong></div><br>-->
        <form id="myform" action="<?=site_url("dich-vu/".$news->title_none.".html");?>" method="post">
            <table border="0" >
                <input name="id" type="hidden" style="width:600px;" value="<?=$news->id;?>" />
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
                    <td>Email:<span style="color:#F00">&nbsp;(*)</span></td>
                    <td><input name="email" type="text" style="width:600px;"  value="<?=$contact->email; ?>" /></td>
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
    </div>
    <div class="clr"></div>
</div>