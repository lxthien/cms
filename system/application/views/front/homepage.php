<div class="main">
    <?php foreach($this->services_cat as $row): ?>
    <div class="box_index">
        <p class="img">
            <a href="<?php echo $base_url.'dich-vu/'.$row->name_none; ?>">
                <img src="<?php echo image($row->image, 'newscatalog_127_127'); ?>" width="127" height="127" alt=""/>
            </a>
        </p>
        <div class="info">
            <h1><?php echo $row->name_vietnamese; ?></h1>
            <?php echo $row->description; ?>
            <p class="btn_red">
                <a href="<?php echo $base_url.'dich-vu/'.$row->name_none; ?>">
                    <strong>Xem tiếp</strong>
                </a>
            </p>
            <br class="clear"/>
        </div>
        <br class="clear"/>
    </div>
    <?php endforeach; ?>
</div>