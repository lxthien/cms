<div class="col-md-9 col-right">
    <?php $this->load->view('front/includes/breadcrumb'); ?>
    
    <h1 class="name-cat" itemprop="name"><?php echo $cat_name; ?></h1>
    <div class="cl"></div>
    <div class="row list-news">
        <?php $i=0; foreach($cat_news as $_row): $i++; ?>
        <div class="col-xs-6 col-sm-4 col-md-4">
            <a class="img-news" href="<?php echo create_url($_row->id); ?>" title="">
                <img alt="<?php echo $_row->title_vietnamese; ?>" src="<?php echo image('img/news/'.$_row->image, 'news_list'); ?>">
            </a>
            <a class="title-news" href="<?php echo create_url($_row->id); ?>" title="<?php echo $_row->title_vietnamese; ?>" >
                <?php echo $_row->title_vietnamese; ?>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?=$this->pagination->create_links();?>
        </div>
    </div>
</div>