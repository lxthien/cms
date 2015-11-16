
<div class="grid_15" id="textcontent">
<form id="form" action="<?=$base_url;?>admin/configgroups/edit/<?=$object->id;?>"  method="post">	
    	<label for="name">Name:</label>
        <input type="text" name="name" class="smallInput wide" value="<?=$object->name;?>" > 
        <label for="name">For only webmaster:</label>
        <input type="radio" name="for_webmaster"  value="0" <?php if($object->for_webmaster == 0 ) echo "checked='checked'";?> >Không
        <input type="radio" name="for_webmaster"  value="1" <?php if($object->for_webmaster == 1 ) echo "checked='checked'";?> />Có
        <div class="clear"></div>
    	<?php create_form_button('submit_button button_ok','Save');?>
</form>
</div>
