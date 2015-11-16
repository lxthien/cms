<div class="col-md-3 hidden-xs hidden-sm col-left">
    <div class="form-search">
        <form action="<?php echo $base_url.'search' ?>" method="post">
            <input type="text" name="value" placeholder="Tìm kiếm"/>
            <input type="submit" value=""/>
        </form>
    </div>
    <div class="cl"></div>
    <div class="col-left-comment">
        <h2>Ý kiến khách hàng</h2>
        <div class="list">
            <?php foreach($this->comments as $row): ?>
            <div class="item">
                <img class="img-thumbnail img-customer text-left" alt="<?php echo $row->name; ?>" src="<?php echo image($row->logo, 'commment_70_70'); ?>" data-holder-rendered="true" style="width: 70px; height: 70px;">
                <a class="text-left fl" href="javascript:void(0)"><?php echo $row->name; ?></a>
                <p class="text-left fl"><?php echo $row->description; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="cl"></div>
    <div class="col-left-advertsing">
        <h2>Quảng cáo</h2>
        <div class="advertsing-item">
            <a href=""><img src="<?php echo $base_url . 'images/assets/advertsing.jpg' ?>" alt=""/></a>
        </div>
        <div class="advertsing-item">
            <a href=""><img src="<?php echo $base_url . 'images/assets/advertsing-2.jpg' ?>" alt=""/></a>
        </div>
        <div class="advertsing-item">
            <a href=""><img src="<?php echo $base_url . 'images/assets/advertsing-3.jpg' ?>" alt=""/></a>
        </div>
        <div class="advertsing-item">
            <a href=""><img src="<?php echo $base_url . 'images/assets/advertsing-4.jpg' ?>" alt=""/></a>
        </div>
    </div>
</div>