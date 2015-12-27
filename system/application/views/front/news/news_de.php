<div class="main">
    <div class="tieude"><?php echo $news->title_vietnamese; ?></div>
    <div class="box_detail box_reset">
        <?php echo $news->full_vietnamese; ?>
        <br>
        <div class="main-news-social">
            <div class="social">
                <!-- Button like facebook -->
                <div class="fb-like" data-href="<?php echo $this->uri; ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                <!-- Button like facebook -->
                <!-- Place this tag where you want the +1 button to render. -->
                <div class="g-plusone" data-size="medium" data-href="<?php echo $this->uri; ?>"></div>
                <!-- Place this tag where you want the +1 button to render. -->
                <!-- Button share facebook -->
                <div class="fb-share-button" data-href="<?php echo $this->uri; ?>" data-layout="button"></div>
                <!-- Button share facebook -->
                <!-- Place this tag where you want the share button to render. -->
                <div class="g-plus" data-action="share" data-annotation="bubble" data-href="<?php echo $this->uri; ?>"></div>
            </div>
        </div>
        <div class="news-related">
            <h4>Tin liên quan</h4>
            <ul class="list">
                <?php foreach($related_news as $row): ?>
                <li><a href="<?php echo create_url($row->id); ?>" title="<?php echo $row->title_vietnamese; ?>"><?php echo $row->title_vietnamese; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>