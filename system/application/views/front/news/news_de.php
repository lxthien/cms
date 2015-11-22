<div class="col-md-9 col-right">
    
    <?php $this->load->view('front/includes/breadcrumb'); ?>

    <h1 class="name-cat"><?php echo $news->title_vietnamese; ?></h1>
    <div class="cl"></div>
    <div class="content">
        <?php echo $news->full_vietnamese; ?>
    </div>
    <div class="cl"></div>
    <?php if($related_news->result_count() > 0): ?>
    <div class="row">
        <div class="col-md-12 news-sames">
            <h2 class="name-cat">Tin liên quan</h2>
            <div class="list-news-related">
                <ul>
                    <?php foreach($related_news as $row): ?>
                    <li><a href="<?php echo create_url($row->id); ?>" title="<?=$row->title_vietnamese?>" ><?=$row->title_vietnamese?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>