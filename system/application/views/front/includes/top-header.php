<div id="top-header">
    <div class="top-header-inside">
        <div class="ws-welcome fl">
            <ul class="menu-tabs">
                <li class="mt-seemore" id="mt-seemore5">
                    <p class="txt03">Giới thiệu</p>
                    <div style="display: none;" class="more-list" id="more-list5">
                        <div class="arrow"></div>
                        <ul class="list">
                            <?php foreach($this->news_abouts as $row): ?>
                                <li><a href="<?php echo $base_url.'gioi-thieu/'.$row->title_none.'.html'; ?>"><?php echo $row->title_vietnamese; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
                <li class="mt-seemore" id="mt-seemore4">
                    <p class="txt03">Bài viết</p>
                    <div style="display: none;" class="more-list" id="more-list4">
                        <div class="arrow"></div>
                        <ul class="list">
                            <?php foreach($this->news_post as $row): ?>
                                <li><a href="<?php echo $base_url.'bai-viet/'.$row->name_none; ?>"><?php echo $row->name_vietnamese; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
                <li class="mt-seemore" id="mt-seemore">
                    <p class="txt03">Tin tức</p>
                    <div style="display: none;" class="more-list" id="more-list">
                        <div class="arrow"></div>
                        <ul class="list">
                            <?php foreach($this->news_cat as $row): ?>
                            <li><a href="<?php echo $base_url.'tin-tuc/'.$row->name_none; ?>"><?php echo $row->name_vietnamese; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
                <li class="mt-seemore" id="mt-seemore1">
                    <p class="txt03">Công nghệ</p>
                    <div style="display: none;" class="more-list" id="more-list1">
                        <div class="arrow"></div>
                        <ul class="list">
                            <?php foreach($this->news_technical as $row): ?>
                                <li><a href="<?php echo $base_url.'cong-nghe/'.$row->name_none; ?>"><?php echo $row->name_vietnamese; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
                <li class="mt-seemore" id="mt-seemore2">
                    <p class="txt03">Dịch vụ</p>
                    <div style="display: none;" class="more-list" id="more-list2">
                        <div class="arrow"></div>
                        <ul class="list">
                            <?php foreach($this->news_services as $row): ?>
                                <li><a href="<?php echo $base_url.'dich-vu/'.$row->title_none.'.html'; ?>"><?php echo $row->title_vietnamese; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="ws-welcome fr" id="welcome_zone" style="overflow:visible">
            <ul class="site-nav">
                <li><a href="<?php echo $base_url.'lien-he.html'; ?>">Đăng ký lái thử</a></li>
                <li><a href="<?php echo $base_url.'lien-he.html'; ?>">Đăng ký Catalogue & Báo giá</a></li>
                <li><a href="<?php echo $base_url.'mua-xe-tra-gop'; ?>">Mua xe trả góp</a></li>
                <li><a href="<?php echo $base_url.'tu-van-mua-xe'; ?>">Tư vấn mua xe</a></li>
            </ul>
        </div>
    </div>
</div>