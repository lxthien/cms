<div class="col-md-9 col-right">
    
    <?php $this->load->view('front/includes/breadcrumb'); ?>

    <h1 class="name-cat"><?php echo $news->title_vietnamese; ?></h1>
    <div class="cl"></div>
    <div class="content">
        <?php echo $news->full_vietnamese; ?>
    </div>
    <div class="tags">
        <span>Tag:</span>
        <?php $i=0; foreach($tag as $k => $v): $i++;?>
        <a href="<?=$base_url?>tag/<?=remove_vn($v).'.html'?>" target="_self"><?=$v?></a> <?php echo $i<count($tag) ? ',':''; ?>
        <?php endforeach; ?>
    </div>
    <div class="share-social">
        <span>Chia sẻ:</span>
        <div class="social">
            <div class="addthis_sharing_toolbox"></div>
        </div>
    </div>
    <div class="cl"></div>
    <?php if($related_news->result_count() > 0): ?>
    <div class="news-sames">
        <h1 class="name-cat">Tin liên quan</h1>
        <div class="list-news-related">
            <ul>
                <?php foreach($related_news as $row): ?>
                <li><a href="<?=$base_url?>tin-tuc/<?=$row->title_none.'.html'?>" title="<?=$row->title_vietnamese?>" ><?=$row->title_vietnamese?></a></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
</div>