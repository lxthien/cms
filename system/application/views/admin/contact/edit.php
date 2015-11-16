
<style type="text/css">
.contactContainer{
	padding:5px;
}
.contactTable{
	width:400px;
}
</style>
<div class="contactContainer">
    <?php if($contact->cat == 1){ ?>
        <h1 style="text-align:center;">Thông tin phản hồi</h1>
    <?php }elseif($contact->cat == 2){ ?>
        <h1 style="text-align:center;">Mua xe trả góp</h1>
    <?php }elseif($contact->cat == 3){ ?>
        <h1 style="text-align:center;">Tư vấn mua xe</h1>
    <?php }elseif($contact->cat == 4){ ?>
        <h1 style="text-align:center;">Mua fleet (Cá nhân)</h1>
    <?php }elseif($contact->cat == 5){ ?>
        <h1 style="text-align:center;">Mua fleet (Tổ chức)</h1>
    <?php }elseif($contact->cat == 205){ ?>
        <h1 style="text-align:center;">Mua xe ô tô cũ giá cao</h1>
    <?php }elseif($contact->cat == 180){ ?>
        <h1 style="text-align:center;">Định giá xe ô tô cũ</h1>
    <?php }elseif($contact->cat == 175){ ?>
        <h1 style="text-align:center;">Nhận ký gửi xe ô tô cũ</h1>
    <?php } ?>
    <table class="contactTable" >
        <?php if($contact->cat != 2): ?>
        <tr class="odd">
            <td>Chủ đề:<span style="color:#F00">*</span></td>
            <td><?=$contact->title;?></td>
        </tr>
        <?php endif; ?>
        <tr class="even">
            <td>Họ tên:<span style="color:#F00">*</span></td>
            <td><?=$contact->name;?></td>
        </tr>
        <tr class="even">
            <td>Giới tính:<span style="color:#F00">*</span></td>
            <td><?=$contact->sex == 0 ? 'Nam' : 'Nữ';?></td>
        </tr>
        <tr class="even">
            <td>Địa chỉ:<span style="color:#F00">*</span></td>
            <td><?=$contact->address;?></td>
        </tr>
        <tr class="odd">
            <td>Email:<span style="color:#F00">*</span></td>
            <td><?=$contact->email;?></td>
        </tr>
        <tr class="even" >
            <td>Điện thoại:</td>
            <td><?=$contact->phone;?></td>
        </tr>
        <?php if($contact->cat != 2): ?>
            <tr class="odd" >
                <td>Nội dung:<span style="color:#F00">*</span></td>
                <td><?=$contact->content;?></td>
            </tr>
        <?php else: ?>
            <tr class="odd" >
                <td>Loại xe:<span style="color:#F00">*</span></td>
                <td><?=$contact->catalog;?></td>
            </tr>
            <tr class="odd" >
                <td>Giá xe:<span style="color:#F00">*</span></td>
                <td><?=$contact->price_lending;?></td>
            </tr>
            <tr class="odd" >
                <td>Thời gian vay:<span style="color:#F00">*</span></td>
                <td><?=$contact->time_lending;?></td>
            </tr>
        <?php endif; ?>
    </table>
</div>
