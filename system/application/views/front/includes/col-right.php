<div class="sub_right">
    <script type="text/javascript" language="javascript">
        $(function () {
            // Croll images
            $("#anyClass").jCarouselLite({
                btnNext: ".next",
                btnPrev: ".prev",
                visible: 6,
                circular: true,
                speed: 1500,
                auto: 1500,
                vertical: true
            });

        });
    </script>
    <div class="tieude">Dịch vụ Nam Cường</div>
    <div class="works">
        <div class="paddL" style="margin-bottom:5px;">
            <p class="prev">
                <a href="javascript:void(0)">
                    <strong>
                        <img src="<?php echo $base_url.'images/assets/dienlanh/up2.png'; ?>" alt="up2" title=""/>
                    </strong>
                </a>
            </p>
            <br class="clear"/>
        </div>
        <div class="thumbnail" id="anyClass">
            <ul>
                <?php foreach($this->newsServices as $row): ?>
                <li>
                    <p class="img">
                        <span>
                            <a href="<?php echo create_url($row->id); ?>">
                                <img src="<?= image($row->image, 'news_127_77'); ?>" width="127" height="77" alt=""/>
                            </a>
                        </span>
                    </p>
                    <h2><?php echo $row->title_vietnamese; ?></h2>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="paddL">
            <p class="next">
                <a href="javascript:void(0)">
                    <strong>
                        <img src="<?php echo $base_url.'images/assets/dienlanh/down2.png'; ?>" alt="down2" title=""/>
                    </strong>
                </a>
            </p>
            <br class="clear"/>
        </div>
        <div class="clear"></div>
    </div>
    <br class="clear"/>
</div>