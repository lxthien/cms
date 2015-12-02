<div class="main">
    <div class="tieude"><?php echo $category->name_vietnamese; ?></div>
    <div class="box_list">
        <ul class="news">
            <?php foreach ($news as $row) : ?>
            <li>
                <p class="img">
                    <span>
                        <a href="<?php echo create_url($row->id); ?>">
                            <img src="<?= image('img/news/'.$row->image, 'news_130_100'); ?>" width="130" height="100" alt="<?php echo $row->title_vietnamese; ?>">
                        </a>
                    </span>
                </p>
                <div class="information">
                    <h2><a href="<?php echo create_url($row->id); ?>"><?php echo $row->title_vietnamese; ?></a></h2>
                    <p><?php echo $row->short_vietnamese; ?></p>
                </div>
                <br class="clear">
            </li>
            <?php endforeach; ?>
        </ul>        
    </div>
</div>