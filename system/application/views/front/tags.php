<div class="col-md-9 col-right">
    <h1 class="name-cat" itemprop="name">Tìm kiếm</h1>
    <div class="cl"></div>
    <div class="row list-news">
        <?php if ($news->result_count() > 0): ?>
            <?php $i=0; foreach($news as $_row): $i++; ?>
            <div class="col-xs-6 col-sm-4 col-md-4">
                <a class="img-news" href="<?php echo create_url($_row->id); ?>" title="">
                    <img alt="<?php echo $_row->title_vietnamese; ?>" src="<?php echo image($_row->image, 'news_list'); ?>">
                </a>
                <a class="title-news" href="<?php echo create_url($_row->id); ?>" title="<?php echo $_row->title_vietnamese; ?>" >
                    <?php echo $_row->title_vietnamese; ?>
                </a>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="col-md-12 no-item">Không tìm thấy kết quả với từ khóa "<?php echo $q; ?>"</p>
        <?php endif; ?>
    </div>
</div>