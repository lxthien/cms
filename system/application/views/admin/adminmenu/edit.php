<div class="grid_15" id="textcontent"> 
    <form id="form" class="table_input" action="<?=$base_url;?>admin/adminmenus/edit/<?=$object->id != '' ? $object->id : 0; ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?=$object->name;?>" class="smallInput wide" />
        <label for="parent">Parent menu : </label>
        <select name="parent" class="smallInput" >
            <option value="0">Root Menu</option>
            <?php foreach($parentmenu->all as $row):?>
            <option value="<?=$row->id;?>" <?php if($object->parentmenu_id==$row->id) echo "selected='selected'";?> ><?=$row->name;?></option>
            <?php endforeach;?>
        </select>
        <label for="name">Link:</label>
        <input type="text" name="link" value="<?=$object->link;?>" class="smallInput wide" />

        <label for="name">Class:</label>
        <input type="text" name="class" value="<?=$object->class;?>" class="smallInput wide" />

        <label for="name">LI-Class:</label>
        <input type="text" name="li_class" value="<?=$object->li_class;?>" class="smallInput wide" />
        <div class="button_bar">
            <?php create_form_button('submit_button button_ok','Lưu dữ liệu');?>
            <div class="clear"></div>
         </div>
    </form>
</div>