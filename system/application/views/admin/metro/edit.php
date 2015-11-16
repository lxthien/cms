<script type="text/javascript">
	$().ready(function(){
		
		
		$('#form').submit(function (){
			var title=$(':text[name="title"]').val();
			var im=$(':file[name="image"]').val();
		
			if(title=="")
			{
					alert("Vui lòng nhập tiêu đề");
					return false;
			}
			if($('#newbanner').attr('checked'))
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
								alert("tagfile: "+tag_file+" Hình đại diện chỉ thuộc 1 trong kiểu file : jpg,gif,png");
								return false;
						}			
				}
			}
			return true;
			
		});
	});
</script>
<form id="form" class="table_input" action="<?=$base_url;?>admin/metros/edit/<?=$object->id;?>" method="post"  enctype="multipart/form-data">
	<div class="grid_15" > 
		<label for="name">Tiêu đề:</label>
		<textarea  name="title" class="smallInput wide"><?=$object->title;?></textarea>
		<label for="name">Link tin tức/link banner/ link youtube:</label>
		<textarea type="text" name="link" class="smallInput wide" ><?=$object->link;?></textarea>
		<label for="name">Loại:</label>
            <input type="radio" <?php if($object->type == "metro") echo "checked='checked'";?> name="type" value="metro" />Metro
            <input type="radio" <?php if($object->type == "banner") echo "checked='checked'";?> name="type" value="banner" />Banner
            <input type="radio" <?php if($object->type == "bigbanner") echo "checked='checked'";?> name="type" value="bigbanner" />Big Banner
            <input type="radio" <?php if($object->type == "youtube") echo "checked='checked'";?> name="type" value="youtube" />Youtube
            <input type="radio" <?php if($object->type == "sale") echo "checked='checked'";?> name="type" value="sale" />Sale Off List
        
		<br />
		<div><img src="<?=$base_url.$object->img;?>" width="120" /></div>
		<span id="fileupload"><input type="file" name="image" class="smallInput medium" /></span>
        <div>metro lớn : 278x263<br />
metro nhỏ : 138x137<br />
youtube:440x275<br />
banner phần giảm giá: 439x126<br />
</div>
	</div>
	<div class="clear" style="height:20px;"></div>
			 
	<div class="button_bar">
		<br /><br />
		<?php create_form_button('submit_button button_ok','Luu thông tin ');?>
	</div>  
</form>