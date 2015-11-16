
<form id="form" class="table_input" action="<?=$base_url;?>admin/customers/edit/<?=$object->id;?>" method="post">
<div class="grid_15" >      
        <table class="table_input">
                <tr>
                    <td><label for="name">Tên:</label></td>
                    <td><input type="text" name="name" value="<?=$object->name;?>" class="smallInput medium" /></td>
                </tr>
                <tr>
                    <td><label for="name">Username:</label></td>
                    <td><input type="text" name="username" value="<?=$object->username;?>" class="smallInput medium" /></td>
                </tr>
                <tr>
                    <td><label for="name">Password:</label></td>
                    <td><input type="password" name="password" /></td>
                </tr>
                <tr>
                    <td><label for="name">Confirm Password:</label></td>
                    <td><input type="password" name="confirmPassword" /></td>
                </tr>
                
                <tr>
                    <td><label for="name">Điện thoại bàn:</label></td>
                    <td><input type="text" name="homePhone" value="<?=$object->homePhone;?>" class="smallInput medium" /></td>
                </tr>
                <tr>
                    <td><label for="name">Điện thoại di động:</label></td>
                    <td>
                        <input type="text" name="mobilePhone" value="<?=$object->mobilePhone;?>" class="smallInput medium" /></td>
                </tr>
                <tr>
                    <td><label for="name">Email:</label></td>
                    <td><input type="text" name="email" value="<?=$object->email;?>" class="smallInput medium" /></td>
                </tr>
                 <tr>
                    <td><label for="name">Địa chỉ:</label></td>
                    <td><textarea rows="5" name="address" class="smallInput medium"><?=$object->address;?></textarea></td>
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
 <div class="" style="clear: both;"></div>
 <?php if($object->exists() && $object->cartitem->result_count() > 0)
 {
    
    $this->load->view('admin/cart/list'); 
 }
 ?>
 </form>