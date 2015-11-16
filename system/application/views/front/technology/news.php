<div class="news-main">
    <div id="right-cata2">
        <div class="wrapper" style="margin-bottom:10px">
            <div style="display: none;" id="promotion_content"></div>
            <div class="top_tt-pr ui-corner-tbl-all">
                <ul class="top_tabs">
                    <li class="headtt"><div><?php echo $category->name_vietnamese; ?></div></li>
                    <li class="LASTtt" style="margin-top:0;padding-right:4px;">
                        <a>Có <?php echo $news->result_count(); ?> bài viết</a>
                    </li>
                </ul>
                <div class="c1"></div>
            </div>
            <div class="wrapper content" style="margin-bottom:10px">
                <div class="box_inside" id="box_news">
                    <?php foreach($news as $row): ?>
                    <div class="web-item">
                        <div class="div-img">
                            <a title="<?php echo $row->title_vietnamese; ?>" href="<?php echo $base_url.'cong-nghe/'.$row->title_none.'.html'; ?>">
                                <img src="<?=image($row->dir.$row->image,'news_list');?>" alt="<?php echo $row->title_vietnamese; ?>">
                            </a>
                        </div>
                        <div class="div-desc">
                            <h4><a href="<?php echo $base_url.'cong-nghe/'.$row->title_none.'.html'; ?>"><?php echo $row->title_vietnamese; ?></a></h4>
                            <p><?php echo strlen($row->short_vietnamese) < 500 ? $row->short_vietnamese : cut_string($row->short_vietnamese, 300).' ...'; ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>