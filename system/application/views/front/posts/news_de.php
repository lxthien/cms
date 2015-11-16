<div id="right-cata" class="news-contents">
    <div class="wrapper" style="margin-bottom:10px">
    	<?php
            echo '<h1 class="h2-bg" style="margin-bottom: 10px; border: none;">'.$news->{'title_vietnamese'}.'</h1>';
			echo '<div>'.$news->{'full_vietnamese'}.'</div>';
		?>
    </div>
    <div class="comment-facebook" style="margin-left: 0;">
        <div class="fb-comments" migrated="1" data-href="<?php echo $this->uri; ?>" data-width="780" data-numposts="50" data-colorscheme="light"></div>
    </div>
</div>