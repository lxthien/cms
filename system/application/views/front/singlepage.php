<div>
	<?php $this->load->view('front/includes/breadcrumb') ?>
	<div class="main_separate"></div>
	<div class="social_share">
		<div class="fr">
			<!-- Place this tag where you want the +1 button to render. -->
			<div class="g-plusone" data-size="medium"></div>

			<!-- Place this tag after the last +1 button tag. -->
			<script type="text/javascript">
			  (function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		</div>
		<div class="fr">
			<!-- Tweet Button -->
			<if condition="in_array($forum['forumid'], array(1,2))">
			<else />
			<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="YOUR-TWITTER-USERNAME">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
			</if>
			<!-- / Tweet Button -->
		</div>
		<div class="fr social_share_fb">
			<!-- Facebook Share Button --> <if condition="in_array($forum['forumid'], array(1,2))"> <else /> <a name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php">Share</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script> </if> <!-- / Facebook Share Button --> 
		</div>
		<div class="clr"></div>
	</div>
	
	<div class="news_box">
		<div class="news_box_detail">
			<?php
				echo '<div>'.$news->{'full_vietnamese'}.'</div>';
			?>
			<div class="clr"></div>
		</div>
	</div>
	
	
	<div class="clr"></div>
</div>

