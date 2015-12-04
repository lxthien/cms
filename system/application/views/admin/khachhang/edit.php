<form id="form" class="table_input" action="<?=$base_url;?>admin/partner/edit/<?=$object->id!=0?$object->id:0;?>" method="post"  enctype="multipart/form-data">
    <div class="grid_15" >
        <label for="name">Position:</label>
        <input type="text" name="position" class="smallInput wide" value="<?=$object->position;?>"/>
        <label>Hình đại diện</label>
        <img src="<?=$base_url.$object->logo;?>"  height="100" />
        <label for="name">Chọn đại diện:</label>
        <input type="file" name="image" class="smallInput medium" />
        <label for="name">Tên đối tác:</label>
        <input type="text" name="name" class="smallInput wide" value="<?=$object->name_vietnamese;?>"/>
        <label for="name">Website/link :</label>
        <input type="text" name="link" class="smallInput wide" value="<?=$object->link;?>"/>
         <label for="name">Địa chỉ :</label>
        <input type="text" name="address" class="smallInput wide" value="<?=$object->address;?>"/>
         <label for="name">Email :</label>
        <input type="text" name="email" class="smallInput wide" value="<?=$object->email;?>"/>
         <label for="name">Phone :</label>
        <input type="text" name="phone" class="smallInput wide" value="<?=$object->phone;?>"/>
        <label for="name">Thông tin thêm :</label>
        <textarea type="text" name="description" class="smallInput wide" ><?=$object->description;?></textarea>
     </div>
     <div class="button_bar">
         <br /><br />
         <?php create_form_button('submit_button button_ok','Lưu thông tin ');?>
    </div>
</form>

          