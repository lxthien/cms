<script language="javascript" type="text/javascript" src="<?php echo $base_url;?>ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>images/js/tab/jquery.tabs.css">
<script language="javascript" type="text/javascript" src="<?php echo $base_url;?>images/js/tab/jquery.tabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $base_url;?>images/js/jquery.blockUI236.js"></script>
<script src="<?=$base_url;?>images/js/ajaxupload/js/ajaxupload.3.5.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
	$(function(){
		var btnUpload=$('#upload');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: '<?=$base_url?>admin/videos/uploadVideo',
			name: 'uploadVideoFile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(flv)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Chỉ cho phép upload file FLV');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				if(response!="error"){
					$('<li></li>').appendTo('#files').html('<a href="<?=$base_url;?>img/material_videos/videos/'+file+'" alt="" >'+file+'</a>').addClass('success');
					$('input[name="video"]').val(response);
					
					
				} else{
					$('<li></li>').appendTo('#files').html(file+" - error: "+response).addClass('error');
				}
			}
		});
		
	});
	
	$().ready(function(){
		$('#fileupload').hide();
		$('#newbanner').click(function(){
			if($(this).attr("checked")==false)
				$('#fileupload').hide();
			else
				$('#fileupload').show();
		});
		
		$('#form').submit(function (){
			var name=$(':text[name="name"]').val();
			var im=$(':file[name="image"]').val();
		
			if(name=="")
			{
					alert("Vui lòng nhập tiêu đề video");
					return false;
			}
			if($('#newbanner').attr('checked')==true)
			{
				if(im=="")
				{
						alert("Vui lòng nhập hình đại diện");
						return false;
				}
				else
				{
						len=im.length;
						dot_position=im.lastIndexOf(".");
						tag_file=im.substring(dot_position+1,len);
						tag_list="jpg gif png JPG GIF PNG";
						if(tag_list.indexOf(tag_file)==-1)
						{
								alert("Hình đại diện chỉ thuộc 1 trong kiểu file : jpg,gif,png");
								return false;
						}			
				}
			}
			return true;
		});
	});
</script>
<style type="text/css">
#upload{  
        padding:5px;  
        font-family:Arial, Helvetica, sans-serif;  
        text-align:center;  
        background:#f2f2f2;  
        color:#3366cc;  
        border:1px solid #ccc;  
        width:150px;  
        cursor:pointer !important;  
        -moz-border-radius:5px; -webkit-border-radius:5px;  
    }  
</style>

<div class="grid_15" id="textcontent">
             	
<form id="form" class="table_input" action="<?=$base_url;?>admin/videos/edit/<?=$video->id;?>" method="post" enctype="multipart/form-data">

	<table class="table_input">
		<tr>
			<td width="120px;"><label>Hình đại diện</label></td>
			<?php $img = $video->link_imgs != '' ? filenameplus($video->link_imgs,'thump') : 'images/default_video.png'; ?>
			<td><img src="<?=$img;?>" width="127" /></td>
		</tr>
		<input type="hidden" name="imagelink" value="<?=$video->link_imgs;?>" >
		<input type="hidden" name="dir" value="<?=$video->dir;?>" >
		<tr>
			<td>Chọn hình :</td>
			<td><input type="checkbox" id="newbanner" name="newimage"  value="1"/></td>
		</tr>
		<tr id="fileupload">
			<td>
				<label for="name">Chọn đại diện:</label></td>
			<td><input type="file" name="image" class="smallInput medium" /></td>
		</tr>
	   
		<tr>
			<td>
				<label for="name">Tên video:</label></td>
			<td><input type="text" name="name" class="smallInput big" value="<?=$video->name;?>" /></td>
		</tr>
		<?php if($video->exists() && $video->link_videos !=""){?>
		<tr>
			<td><label>Video hiện tại :</label></td>
			<td><a href="<?=$base_url.$video->link_videos;?>">download</a></td>
		</tr>
		
		<?php  } ?>
		<input type='hidden' name='video' value='' />
		<tr>
			<td><label>Video mô tả</label></td>
			<td>
				<div id="upload" ><span>Upload File</span></div><span id="status" ></span>
			
				<ul id="files" ></ul>
			</td>
		</tr>
		
	</table>	

	<div class="clear"></div>
	<div class="button_bar">
		<br /><br />
			<?php create_form_button('submit_button button_ok','Save');?>
			<?php create_form_button('reset_button button_notok','Reset');?>
	</div>	
</form>
</div>

