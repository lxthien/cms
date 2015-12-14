<div class="grid_15" id="textcontent"> 
    <form id="form" class="table_input" action="<?=$base_url;?>admin/menuitems/edit/<?=$menu_id?>/<?=$object->id != '' ? $object->id : 0;?>" method="post">
        <table class="table_input">
            <tr>
             	<td><label for="name">Tên menu:</label></td>
                <td><input type="text" name="name" class="smallInput medium" value="<?=$object->name?>" /></td>
            </tr>
            <tr>
             	<td><label for="title">Liên kết:</label></td>
                <td><input type="text" name="link" class="smallInput medium" value="<?=$object->link?>" /></td>
            </tr>
        </table>
        <div class="button_bar">
            <?php create_form_button('submit_button button_ok','Lưu dữ liệu');?>
            <div class="clear"></div>
        </div>
    </form>

</div>