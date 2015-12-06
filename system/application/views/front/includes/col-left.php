<div class="sub_left">
    <div class="tieude">Dịch Vụ</div>
    <ul class="nav_sub">
        <?php foreach($this->services_cat as $row): ?>
        <li><a href="<?php echo $base_url.'dich-vu/'.$row->name_none; ?>"><?php echo $row->name_vietnamese; ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div class="tieude">Khuyến mãi</div>
    <ul class="news">
        <?php foreach($this->news_sale_off as $row): ?>
        <li><a href="<?php echo create_url($row->id); ?>"><?php echo $row->title_vietnamese; ?></a></li>
        <?php endforeach; ?>
    </ul>
    <script type="text/javascript">
        function select_support(nickname, type) {
            if (type == 'yahoo') {
                location.href = 'ymsgr:SendIM?' + nickname;
            }
            else {
                location.href = 'skype:' + nickname + '?chat';
            }
        }
    </script>
    <div class="support">
        <p class="img">
            <img src="<?php echo $base_url.'images/assets/dienlanh/pic_170x109.jpg'; ?>" width="170" height="109" alt=""/>
        </p>
        <h2>Tư vấn trực tuyến</h2>
        <div class="chatter">
            <ul class="yahoo_online">
                <li><p class="offline"><a href="ymsgr:SendIM?<?php echo getconfigkey('yahoo1'); ?>">Tư vấn kỹ thuật</a></p></li>
                <li><p class="offline"><a href="ymsgr:SendIM?<?php echo getconfigkey('skype1'); ?>">Kinh doanh</a></p></li>
            </ul>
        </div>
        <div class="phone">
            <p>
                <span><img src="<?php echo $base_url.'images/assets/dienlanh/ico_tel.jpg'; ?>" width="29" height="20" alt=""/></span>
                <?php echo getconfigkey('hot_line_1'); ?>
            </p>
            <p>
                <span><img src="<?php echo $base_url.'images/assets/dienlanh/ico_tel.jpg'; ?>" width="29" height="20" alt=""/></span>
                <?php echo getconfigkey('hot_line_2'); ?>
            </p>
        </div>
        <p class="img">
            <img src="<?php echo $base_url.'images/assets/dienlanh/bg_support_bottom.gif'; ?>" width="170" height="12" alt=""/>
        </p>
    </div>
    <div class="tieude">Liên kết web</div>
    <div class="weblink">
        <ul class="list_white">
            <li><a href="http://dienlanhachau.vn/sua-may-lanh.html" target="_blank">Sửa máy lạnh</a></li>
            <li><a href="http://dienlanhtheviet.com.vn/dich-vu/ve-sinh-may-lanh-quan-1.html" target="_blank">ve sinh may lanh quan 1</a></li>
            <li><a href="http://dienlanhtheviet.com.vn/dich-vu/ve-sinh-may-lanh-quan-binh-thanh.html" target="_blank">ve sinh may lanh quan binh thanh</a></li>
            <li><a href="http://dienlanhtheviet.com.vn/dich-vu/sua-may-lanh-cong-nghiep.html" target="_blank">sua may lanh trung tam</a></li>
            <li><a href="http://dienlanhtheviet.com.vn/dich-vu/bao-tri-may-lanh-cong-nghiep.html" target="_blank">bao tri may lanh trung tam</a></li>
            <li><a href="http://dienlanhtheviet.com.vn/dich-vu/sua-may-lanh-quan-thu-duc.html" target="_blank">sua may lanh quan thu duc</a></li>
            <li><a href="http://dienlanhtheviet.com.vn/dich-vu/sua-may-lanh-quan-2.html" target="_blank">sua may lanh quan 2</a></li>
            <li><a href="http://dienlanhtheviet.com.vn/dich-vu/sua-may-nuoc-nong-quan-1.html" target="_blank">sua may nuoc nong quan 1</a></li>
            <li><a href="http://dienlanhtheviet.com.vn/dich-vu/sua-lo-vi-song-quan-7.html" target="_blank">sua lo vi song quan 7</a></li>
            <li><a href="http://dienlanhtheviet.com.vn/dich-vu/sua-lo-vi-song-quan-phu-nhuan.html" target="_blank">sua lo vi song quan phu nhuan</a></li>
            <li><a href="http://dienlanhtheviet.com.vn/dich-vu/sua-lo-vi-song-quan-binh-thanh.html" target="_blank">sua lo vi song quan binh thanh</a></li>
            <li><a href="http://dienlanhtheviet.com.vn/dich-vu/sua-lo-vi-song-quan-1.html" target="_blank">sua lo vi song quan 1</a></li>
        </ul>
    </div>
    <ul class="visitor">
        <li>Lượt truy cập : <span><?php echo $this->hit_counter->getTotalVisitCount();?></span></li>
        <li>Đang truy cập : <span><?php echo $this->hit_counter->getUsersOnlineCount();?></span></li>
    </ul>
</div>