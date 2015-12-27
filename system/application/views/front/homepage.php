<div class="main">
    <?php foreach($this->news_home_hot as $row): ?>
    <div class="box_index">
        <p class="img">
            <a href="<?php echo create_url($row->id); ?>">
                <img src="<?php echo image($row->image, 'newscatalog_127_127'); ?>" width="127" height="127" alt="<?php echo $row->title_vietnamese; ?>"/>
            </a>
        </p>
        <div class="info">
            <h1><a href="<?php echo create_url($row->id); ?>"><?php echo $row->title_vietnamese; ?></a></h1>
            <?php echo $row->short_vietnamese; ?>
            <p class="btn_red">
                <a href="<?php echo create_url($row->id); ?>">
                    <strong>Xem tiếp</strong>
                </a>
            </p>
            <br class="clear"/>
        </div>
        <br class="clear"/>
    </div>
    <?php endforeach; ?>
</div>