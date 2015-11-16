<div class="grid_15" id="textcontent"> 
    <form id="form" class="table_input" action="<?=$base_url;?>admin/productstatus/edit/<?=$object->id;?>" method="post">
    <table class="table_input">
        <tr>
            <td><label for="name">Tên:</label></td>
            <td><input type="text" name="name" value="<?=$object->name?>" class="smallInput medium" /></td>
        </tr>
        <tr>
            <td><label for="name">Mô tả tóm tắt:</label></td>
            <td><textarea rows="5" name="description" class="smallInput medium"><?=$object->description?></textarea></td>
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