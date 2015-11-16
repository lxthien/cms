<div class="grid_15" id="textcontent">
    <form id="form" class="table_input" action="<?=$this->admin_url;?>adminusers/account" method="post">
        <h2>Thông tin đăng nhập</h2>
        <label for="name">Tài khoản đăng nhập:</label>
        <?=$object->username;?>
        <label for="name">Mật khẩu:</label>
        <input type="password" name="password" class="smallInput wide" value="<?=$object->password;?>" />
        <label for="name">Nhập lại mật khẩu:</label>
        <input type="password" name="confirm_password" class="smallInput wide" value="<?=$object->confirm_password;?>" />

        <h2>Thông tin liên lạc</h2>
        <label for="name">Họ và tên:</label>
        <input type="text" name="fullname" class="smallInput wide" value="<?=$object->fullname;?>" />
        <label for="name">Email:</label>
        <input type="text" name="email" class="smallInput wide" value="<?=$object->email;?>" />
        <label for="name">Điện thoại:</label>
        <input type="text" name="phone" class="smallInput wide" value="<?=$object->phone;?>" />
        <label for="name">Địa chỉ:</label>
        <input type="text" name="address" class="smallInput wide" value="<?=$object->address;?>" />
        <div class="button_bar">
            <br /><br />
            <?php create_form_button('submit_button button_ok','Lưu thông tin người dùng');?>
        </div>
    </form>
</div>