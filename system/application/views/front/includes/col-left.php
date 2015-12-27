<div class="sub_left">
    <div class="tieude">Dịch vụ điện lạnh</div>
    <ul class="nav_sub">
        <?php foreach($this->services_cat as $row): ?>
        <li><a href="<?php echo $base_url.'dich-vu-dien-lanh/'.$row->name_none; ?>"><?php echo $row->name_vietnamese; ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div class="tieude">Dịch vụ điện tử</div>
    <ul class="news">
        <?php foreach($this->news_sale_off as $row): ?>
        <li><a href="<?php echo create_url($row->id); ?>"><?php echo $row->title_vietnamese; ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div class="tieude">Điện lạnh dân dụng</div>
    <ul class="news">
        <?php foreach($this->news_dldd as $row): ?>
        <li><a href="<?php echo create_url($row->id); ?>"><?php echo $row->title_vietnamese; ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div class="tieude">Điện lạnh công nghiệp</div>
    <ul class="news">
        <?php foreach($this->news_dlcn as $row): ?>
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
        <?php echo getconfigkey('lien_ket_web'); ?>
    </div>
    <ul class="visitor">
        <li>Lượt truy cập : <span><?php echo $this->hit_counter->getTotalVisitCount();?></span></li>
        <li>Đang truy cập : <span><?php echo $this->hit_counter->getUsersOnlineCount();?></span></li>
    </ul>
</div>