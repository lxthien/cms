
<div class="grid_15" id="textcontent">
<form id="form" action="<?=$base_url;?>admin/cauhinhs/edit/<?=$object->id != '' ? $object->id : 0 ;?>"  method="post">
    	<label for="name">Name:</label>
        <input type="text" name="name" class="smallInput wide" value="<?=$object->name;?>" > 
        
        <label for="name">FieldName:</label>
        <input type="text" name="fieldname" class="smallInput wide" value="<?=$object->fieldname;?>" > 
        <label for="name">Description:</label>
        <textarea name="description" class="smallInput wide" rows="5" ><?=$object->description;?></textarea>
        <label for="name">Style:</label>
        <textarea name="style" class="smallInput wide" rows="5" ><?=$object->style;?></textarea>
        <label >Type:</label>
        <select name="type">
        		<option value="text" <?php if($object->type == "text") echo 'selected="selected"';?>>Text</option>
                <option value="password" <?php if($object->type == "password") echo 'selected="selected"';?>>Password</option>
                <option value="textarea"  <?php if($object->type == "textarea") echo 'selected="selected"';?>>Textarea</option>
                <option value="radio"  <?php if($object->type == "radio") echo 'selected="selected"';?> >Radio</option>
                <option value="checkbox"  <?php if($object->type == "checkbox") echo 'selected="selected"';?> >Check Box</option>
                <option value="select"  <?php if($object->type == "select") echo 'selected="selected"';?> >Select</option>
                <option value="button"  <?php if($object->type == "button") echo 'selected="selected"';?> >Button</option>
                <option value="image"  <?php if($object->type == "image") echo 'selected="selected"';?> >Image</option>
                <option value="file"  <?php if($object->type == "file") echo 'selected="selected"';?> >File</option>
        </select>
        <label>Choice list /  value (for button):</label>
        <textarea name="choice_list" class="smallInput wide" rows="5" ><?=$object->choice_list;?></textarea>
        <label for="name">Group:</label>
        <select name="configgroup" class="smallInput wide">
        	<option value="">Vui lòng chọn</option>
            <?php foreach($configgroup->all as $row):?>
            	<option value="<?=$row->id;?>" <?php if($object->configgroup_id==$row->id) echo "selected='selected'";?> ><?=$row->name;?></option>
            <?php endforeach;?>
        </select>
        <label for="name">For only webmaster:</label>
        <input type="radio" name="for_webmaster"  value="0" <?php if($object->for_webmaster == 0 ) echo "checked='checked'";?> >Không
        <input type="radio" name="for_webmaster"  value="1" <?php if($object->for_webmaster == 1 ) echo "checked='checked'";?> />Có
        <label for="name">Check for update:</label>
        <input type="checkbox" name="check_for_update" value="1" <?php if($object->check_for_update == 1) echo "checked = 'checked'";?>   />
        <div class="clear"></div>
    	<?php create_form_button('submit_button button_ok','Save');?>

</form>
</div>
