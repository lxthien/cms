<br class="clear"/>
<script type="text/javascript" language="javascript">
    $(function () {
        $("#partners").jCarouselLite({
            btnNext: ".nextPartner",
            btnPrev: ".prevPartner",
            visible: 5,
            circular: true,
            speed: 1500,
            auto: 1500
        });

    });
</script>
<div class="prevPartner"><a href="javascript:void(0)">
    <strong><img src="<?php echo $base_url.'images/assets/dienlanh/back.png'; ?>" alt="back" title=""/></strong></a>
</div>
<div class="nextPartner"><a href="javascript:void(0)">
    <strong><img src="<?php echo $base_url.'images/assets/dienlanh/next.png'; ?>" alt="next" title=""/></strong></a>
</div>
<div class="partners" id="partners">
    <ul>
        <?php foreach ($this->partners as $row) : ?>
        <li>
            <span>
                <a href="<?php echo $row->link; ?>" target="_blank">
                    <img src="<?php echo image($row->logo, 'partner_193_95') ?>" alt=""/>
                </a>
            </span>
        </li>
        <?php endforeach; ?>
    </ul>
    <br class="clear"/>
</div>