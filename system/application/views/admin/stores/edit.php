<form id="form" class="table_input" action="<?=$base_url;?>admin/stores/edit/<?=$object->id;?>" method="post">
<div class="grid_15" >      
        <table class="table_input">
                <tr>
                    <td><label for="name">Tên cửa hàng:</label></td>
                    <td><input type="text" name="name" value="<?=$object->name;?>" class="smallInput medium" /></td>
                </tr>
                <tr>
                    <td><label for="name">Điện thoại:</label></td>
                    <td><input type="text" name="phone" value="<?=$object->phone;?>" class="smallInput medium" /></td>
                </tr>
                <tr>
                    <td><label for="name">Địa chỉ:</label></td>
                    <td><textarea rows="5" name="address" class="smallInput medium"><?=$object->address;?></textarea></td>
                </tr>
                
                
                <tr>
                    <td><label for="name">Map:</label></td>
                    <td><textarea rows="5" name="map" class="smallInput medium"><?=$object->map;?></textarea></td>
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
 </div>
 </form>