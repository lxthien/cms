<div class="grid_15" id="textcontent"> 
    <form id="form" class="table_input" action="<?=$base_url;?>admin/productmanufactures/edit/<?=$object->id;?>" method="post" enctype="multipart/form-data">
    <table class="table_input">
        <tr>
            <td></td>
            <td><img src="<?=image($object->image,'product_home','logo');?>"/> </td>
        </tr>
        <tr>
            <td><label for="name">Tên:</label></td>
            <td><input type="text" name="name" value="<?=$object->name?>" class="smallInput medium" /></td>
        </tr>
        <tr>
            <td><label>Logo:</label></td>
            <td><input name="logo" type="file" /></td>
        </tr>
        <tr>
            <td><label>Hiện ở bảng giá:</label></td>
            <td><input value="1" <?=checkIt($object->isShow,1);?> type="checkbox" name="isShow"/></td>
        </tr>
        <tr>
            <td><label for="name">Mô tả tóm tắt:</label></td>
            <td><textarea rows="5" name="description" class="smallInput medium"><?=$object->description?></textarea></td>
        </tr>
        <tr>
            <td><label for="name">Quốc gia:</label></td>
            <td><input type="text" name="country" value="<?=$object->country?>" class="smallInput medium" /></td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="button_bar">
                <?php create_form_button('submit_button button_ok','Lưu dữ liệu');?>
                <div class="clear"></div>
                </div>
            </td>
        </tr>
    </table>
    </form>
</div>