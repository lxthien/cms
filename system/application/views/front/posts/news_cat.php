<div class="news-main">
    <div id="right-cata2">
        <div class="wrapper" style="margin-bottom:10px">
            <div style="display: none;" id="promotion_content"></div>
            <div class="top_tt-pr ui-corner-tbl-all">
                <ul class="top_tabs">
                    <li class="headtt"><div><?php echo $cat_name; ?></div></li>
                    <li class="LASTtt" style="margin-top:0;padding-right:4px;">
                        <a>Có <?php echo $cat_news->result_count(); ?> bài viết</a>
                    </li>
                </ul>
                <div class="c1"></div>
            </div>
            <div class="wrapper content" style="margin-bottom:10px">
                <?php if($cat_news->result_count() > 0 ): ?>
                    <div class="box_inside" id="box_news">
                        <?php foreach($cat_news as $row): ?>
                            <div class="web-item">
                                <div class="div-img">
                                    <a title="<?php echo $row->title_vietnamese; ?>" href="<?php echo create_url($row->id); ?>">
                                        <img src="<?=image($row->dir.$row->image,'news_list');?>" alt="<?php echo $row->title_vietnamese; ?>">
                                    </a>
                                </div>
                                <div class="div-desc">
                                    <h4><a href="<?php echo create_url($row->id); ?>"><?php echo $row->title_vietnamese; ?></a></h4>
                                    <p><?php echo $row->short_vietnamese; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="cl"></div>
                    <div class="pagination" id="id_paging">
                        <?php echo $this->pagination->create_links();?>
                    </div>
                <?php else: ?>
                    <p class="no-result">Không tìm thấy bài viết nào cho danh mục này !</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>