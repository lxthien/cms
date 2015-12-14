<div class="col-md-3 hidden-xs hidden-sm col-left">
    <div class="form-search">
        <form action="<?php echo $base_url.'search' ?>" method="post">
            <input type="text" name="value" placeholder="Tìm kiếm"/>
            <input type="submit" value=""/>
        </form>
    </div>
    <div class="cl"></div>
    <div class="col-left-advertsing">
        <h2>Khuyến mãi</h2>
        <?php foreach($this->bannerLeft as $row) :?>
        <div class="advertsing-item">
            <a href=""><img src="<?= image($row->image, 'slide_left'); ?>" alt=""/></a>
        </div>
        <?php endforeach ?>
    </div>
</div>