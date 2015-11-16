<footer class="bs-docs-footer" role="contentinfo">
    <div class="container">
        <div class="row footer-top">
            <div class="col-md-6">
                <h5 class="text-uppercase text-left" style="font-size: 15px; font-weight: 600;">Công ty TNHH Thương Mại - Dịch vụ - Xây Dựng Phố Việt</h5>
                <p class="text-uppercase text-left">Văn phòng giao dịch</p>
                <p class="text-left">Số 52/21 Đường số 15, Khu phố 9 - Phường Bình Hưng Hòa - Quận Bình Tân - TP. Hồ Chí Minh</p>
                <p class="text-left">Di Động: 0909.354.942</p>
                <p class="text-left">Điện Thoại: 08.3767.1260</p>
                <p class="text-left">Mã Số Thuế: 031.324.05.07</p>
                <p class="text-left">EMAIL: xaydungphoviethcm@gmail.com</p>
                <p class="text-left">WEBSITE: www.xaydungphoviet.vn</p>
            </div>
            <div class="col-md-3 footer-services">
                <h4 class="text-uppercase text-left">Dịch vụ</h4>
                <ul>
                    <?php foreach($this->services as $row): ?>
                        <li><a href="<?php echo $base_url?>dich-vu/<?=$row->title_none.'.html'; ?>" title="<?php echo $row->title_vietnamese; ?>" ><?php echo $row->title_vietnamese; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-3 footer-tag">
                <h4 class="text-uppercase text-left">Tag</h4>
                <ul>
                    <li><a title=" permalink to xay nha dep pages" href="<?php echo $base_url; ?>tag/xay-nha-dep.html">Xây nhà đẹp</a></li>
                    <li><a title=" permalink to xay nha 2013 pages" href="<?php echo $base_url; ?>tag/xay-nha-2013.html">Xây nhà 2013</a></li>
                    <li><a title=" permalink to xay nha  pages" href="<?php echo $base_url; ?>tag/xay-nha.html">Xây nhà</a>, <a href="http://xaynhathienan.com/dich-vu/xay-lap-va-sua-chua/xay-dung-nha-khung-nha-thep-chuyen-nghiep.html" title="permalink to nha thep  pages">nha thep</a></li>
                    <li><a title=" permalink to thu tuc xay nha pages" href="<?php echo $base_url; ?>tag/thu-tuc-xay-nha.html">Thủ tục xây nhà</a></li>
                    <li><a title=" permalink to giay phep xay nha pages" href="<?php echo $base_url; ?>tag/giay-phep-xay-nha.html">Giấy phép xây nhà</a></li>
                    <li><a title=" permalink to thiet ke nha dep pages" href="<?php echo $base_url; ?>tag/thiet-ke-nha-dep.html">Thiết kế nhà đẹp</a></li>
                    <li><a title=" permalink to khung nha thep pages" href="<?php echo $base_url; ?>dich-vu/xay-lap-va-sua-chua/xay-dung-nha-khung-nha-thep-chuyen-nghiep.html">Khung Nha Thep</a></li>
                    <li><a title=" permalink to tu van xay nha pages" href="<?php echo $base_url; ?>tag/tu-van-xay-nha.html">Tư vấn xây nhà</a></li>
                    <li><a title=" permalink to xay nha gia re pages" href="<?php echo $base_url; ?>tag/xay-nha-gia-re.html">Xây nhà giá rẻ</a></li>
                    <li><a title=" permalink to thiet ke nha dep pages" href="<?php echo $base_url; ?>dich-vu/thiet-ke">Thiet ke nha dep</a></li>
                    <li><a href="<?php echo $base_url; ?>dich-vu/son-nuoc" title="dich vu son nuoc">dich vu son nuoc</a></li>
                    <li><a href="<?php echo $base_url; ?>dich-vu/tran-vach-thach-cao" title="tran thach cao">tran thach cao</a></li>
                    <li><a href="<?php echo $base_url; ?>dich-vu/tran-vach-thach-cao" title="vach thach cao">vach thach cao</a></li>
                    <li><a href="<?php echo $base_url; ?>tag/nha-thep.html" title="permalink to nha thep  pages">nha thep</a></li>
                </ul>
            </div>
        </div>
        <div class="row footer-bottom">
            <p class="text-right">Online <?php echo $this->hit_counter->getUsersOnlineCount();?> | Visit: <?php echo $this->hit_counter->getTotalVisitCount();?></p>
        </div>
    </div>
</footer>