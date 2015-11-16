<div>
	<?php $this->load->view('front/includes/breadcrumb') ?>
	<div class="main_separate"></div>
	<div class="news_menu">
		<span><a href="<?=$base_url."tin-tuc/c/".$cat_news_none?>" title="<?=$cat_news?>">Tin tức</a></span>
		<span><a href="<?=$base_url."tin-tuc/c/".$cat_ddv_none?>" title="<?=$cat_ddv?>">Tin Di Động việt</a></span>
		<span><a href="<?=$base_url."tin-tuc/c/".$cat_relax_none?>" title="<?=$cat_relax?>">Thủ thuật và Kinh nghiệm</a></span>
		<span><a href="<?=$base_url."tin-tuc/c/".$cat_advisory_none?>" title="<?=$cat_advisory?>">Đánh giá và Trải nghiệm</a></span>
		<span><a href="<?=$base_url."tin-tuc/c/".$cat_promotion_none?>" title="<?=$cat_promotion?>">Khuyến mãi</a></span>
	</div>
	
	<!-- lastest news -->
	<div class="main_separate"></div>
	<div class="news_main_slide">
		<?php $i = 1; foreach($lastest_news as $row): ?>
			<?php if($i==1){ ?>
				<div class="fl" style="width: 270px;height: 225px;">
					<div class="news_main_slide_img">
						<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>"><img alt="<?=$row->{'title_vietnamese'}?>" src="<?=image($row->dir.$row->image,'news_270_225');?>" width="270" height="225" class="img_news_main_slide" /></a>
						<div class="news_main_slide_title"><a href="">
							<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" class="news_link font_bold">
								<?=$row->{'title_vietnamese'}?>
							</a>
						</div>
					</div>
				</div>
				<div class="fl light_blue"></div>
				<div class="fl dark_blue2"></div>
			<?php } ?>
			
			<?php if($i==2){ ?>	
				<div class="fl" style="width: 270px;height: 225px;" >
					<div class="news_main_slide_img">
						<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>"><img alt="<?=$row->{'title_vietnamese'}?>" src="<?=image($row->dir.$row->image,'news_270_225');?>" width="270" height="225" /></a>
						<div class="news_main_slide_title"><a href="">
							<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" class="news_link font_bold">
								<?=$row->{'title_vietnamese'}?>
							</a>
						</div>
					</div>
				</div>
				<div class="fl light_blue"></div>
				<div class="fl dark_blue2"></div>
			<?php } ?>
			<?php if($i>=3){ ?>	
				<div class="fl" style="height: 72px;">
					<div class="news_main_slide_line">
						<div style="float:left;display: inline;width: 80px;padding:3px;">
							<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>">
								<img alt="<?=$row->{'title_vietnamese'}?>" src="<?=image($row->dir.$row->image,'news_80_60');?>" width="80" height="60" />
							</a>
						</div>
						
						<div style="float: left;padding:3px;overflow: hidden;height: 56px;">
							<a class="news_main_slide_line_link" href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>">
								<?=$row->{'title_vietnamese'}?>...
							</a>
						</div>
					</div>
					<?php if($i<5){ ?>	
                        <div class="clr"></div>
						<div class="hnr"></div>
					<?php } ?>
				</div>
			<?php } ?>
		<?php $i++; endforeach; ?>
		<div class="clr"></div>
	</div>
	
	<div class="main_separate"></div>
	<div class="main_separate"></div>
	<div class="">
		<div class="news_left fl">
			<!-- news -->
			<div>
				<?php $i = 1; foreach($news as $row): ?>
					<?php if($i==1){ ?>
						<a class="title_link_category" href="<?=$base_url."tin-tuc/c/".$cat_news_none?>" title="<?=$cat_news?>">
							<h2 class="news_h2">Tin tức</h2>
						</a>
						<div class="bg_news_under"></div>
						<div class="news_ln">
							<div class="fl news_de_img">
								<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>">
									<img alt="<?=$row->{'title_vietnamese'}?>" src="<?=image($row->dir.$row->image,'news_160');?>" width="160" />
								</a>
							</div>
							<div class="fl news_ln_txt">
								<div>
									<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" class="news_link font_bold">
										<?=$row->{'title_vietnamese'}?>
									</a>
								</div>
								<div class="news_de_txt">
									<?=cut_string($row->{'full_vietnamese'},250).' ...';?>
								</div>
								<div class="news_view_more"><a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>">Chi tiết</a></div>
							</div>
							<div class="clr"></div>
						</div>
					<?php } ?>
					<?php if($i==2){ ?> <ul class="news_ul"> <?php } ?>
						<?php if($i>=2){ ?>
							<li>
								<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" class="news_link">
									<?=$row->{'title_vietnamese'}?>
								</a>
								&nbsp;<font class="news_date">(<?=get_date_from_sql($row->created)?>)</font>
							</li>
						<?php } ?>
					<?php if($i==4){ ?> </ul> <?php } ?>
				<?php $i++; endforeach; ?>
			</div>
			
			<!-- di dong viet news -->
			<br />
			<div>
				<?php $i = 1; foreach($ddv_news as $row): ?>
					<?php if($i==1){ ?>
						<a class="title_link_category" href="<?=$base_url."tin-tuc/c/".$cat_ddv_none?>" title="<?=$cat_ddv?>">
							<h2 class="news_h2">Tin di động việt</h2>
						</a>
						<div class="bg_news_under"></div>
						<div class="news_ln">
							<div class="fl news_de_img">
								<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>">
									<img alt="<?=$row->{'title_vietnamese'}?>" src="<?=image($row->dir.$row->image,'news_160');?>" />
								</a>
							</div>
							<div class="fl news_ln_txt">
								<div>
									<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" class="news_link font_bold">
										<?=$row->{'title_vietnamese'}?>
									</a>
								</div>
								<div class="news_de_txt">
									<?=cut_string($row->{'full_vietnamese'},250).' ...';?>
								</div>
								<div class="news_view_more"><a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>">Chi tiết</a></div>
							</div>
							<div class="clr"></div>
						</div>
					<?php } ?>
					<?php if($i==2){ ?> <ul class="news_ul"> <?php } ?>
						<?php if($i>=2){ ?>
							<li>
								<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" class="news_link">
									<?=$row->{'title_vietnamese'}?>
								</a>
								&nbsp;<font class="news_date">(<?=get_date_from_sql($row->created)?>)</font>
							</li>
						<?php } ?>
					<?php if($i==4){ ?> </ul> <?php } ?>
				<?php $i++; endforeach; ?>
			</div>
			
			<!-- promotion news -->
			<br />
			<div>
				<a class="title_link_category" href="<?=$base_url."tin-tuc/c/".$cat_promotion_none?>" title="<?=$cat_promotion?>">
					<h2 class="news_h2">Tin Khuyến mãi</h2>
				</a>
				<div class="bg_news_under"></div>
				<br />
				
				<?php $i = 1; foreach($promo_news as $row): ?>
					<?php if($i==1){ ?>
						<div class="grey_date"><?=get_date_from_sql($row->created) ?></div>
						<div class="fl news_b_img">
							<div class="news_b_img_img"><img src="<?=$base_url?>images/most_hot.png" alt="" /></div>
							<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" ><img alt="<?=$row->{'title_vietnamese'}?>" src="<?=image($row->dir.$row->image,'news_235_175');?>" width="235" height="175" /></a>
							<div class="news_main_slide_title">
								<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" >
									<?=$row->{'title_vietnamese'}?>
								</a>
							</div>
						</div>
					<?php } ?>
					<?php if($i>=2){ ?>
						<?php if($i==2){ ?><div class="fl news_b_sub"><?php } ?>
							<div class="news_b_sub_line">
								<div class="padding_news_line">
									<div class="fl news_b_sub_line_img">
										<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" >
											<img alt="<?=$row->{'title_vietnamese'}?>" src="<?=image($row->dir.$row->image,'news_75_50');?>" width="75" height="50" />
										</a>
									</div>
									<div class="fl news_b_sub_line_txt">
										<a class="news_link" href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" >
											<?=cut_string($row->{'title_vietnamese'},60).' ...';?>
										</a>
									</div>
									<div class="clr"></div>
									<div class="padding_news_line_date"><?=get_date_from_sql($row->created) ?></div>
								</div>
							</div>
						<?php if($i==4){ ?></div><?php } ?>
					<?php } ?>
				<?php $i++; endforeach; ?>
                <?php if($i < 5 && $i > 2){ echo '</div>'; } ?>
				<div class="clr"></div>
			</div>
			
			<!-- relax news -->
			<br />
			<div>
				<a class="title_link_category" href="<?=$base_url."tin-tuc/c/".$cat_relax_none?>" title="<?=$cat_relax?>">
					<h2 class="news_h2">Thủ thuật và Kinh nghiệm</h2>
				</a>
				<div class="bg_news_under"></div>
				<br />
				<?php $i = 1; foreach($relax_news as $row): ?>
					<?php if($i==1){ ?>
						<div class="grey_date"><?=get_date_from_sql($row->created) ?></div>
						<div class="fl news_b_img">
							<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" ><img alt="<?=$row->{'title_vietnamese'}?>" src="<?=image($row->dir.$row->image,'news_235_175');?>" width="235" height="175" /></a>
							<div class="news_main_slide_title">
								<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" >
									<?=$row->{'title_vietnamese'}?>
								</a>
							</div>
						</div>
					<?php } ?>
					<?php if($i>=2){ ?>
						<?php if($i==2){ ?><div class="fl news_b_sub"><?php } ?>
							<div class="news_b_sub_line">
								<div class="padding_news_line">
									<div class="fl news_b_sub_line_img">
										<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" >
											<img alt="<?=$row->{'title_vietnamese'}?>" src="<?=image($row->dir.$row->image,'news_75_50');?>" width="75" height="50" />
										</a>
									</div>
									<div class="fl news_b_sub_line_txt">
										<a class="news_link" href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" >
											<?=cut_string($row->{'title_vietnamese'},60).' ...';?>
										</a>
									</div>
									<div class="clr"></div>
									<div class="padding_news_line_date"><?=get_date_from_sql($row->created) ?></div>
								</div>
							</div>
						<?php if($i==4){ ?></div><?php } ?>
					<?php } ?>
				<?php $i++; endforeach; ?>
              
                <?php if($i < 5 && $i > 2){ echo '</div>'; } ?>
				<div class="clr"></div>
			</div>
			
			<!-- advisory news -->
			<br />
			<div>
				<a class="title_link_category" href="<?=$base_url."tin-tuc/c/".$cat_advisory_none?>" title="<?=$cat_advisory?>">
					<h2 class="news_h2">Đánh giá và Trải nghiệm</h2>
				</a>
				<div class="bg_news_under"></div>
				<br />
				<?php $i = 1; foreach($advisory_news as $row): ?>
					<?php if($i==1){ ?>
						<div class="grey_date"><?=get_date_from_sql($row->created) ?></div>
						<div class="fl news_b_img">
							<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" ><img alt="<?=$row->{'title_vietnamese'}?>" src="<?=image($row->dir.$row->image,'news_235_175');?>" width="235" height="175" /></a>
							<div class="news_main_slide_title">
								<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" >
									<?=$row->{'title_vietnamese'}?>
								</a>
							</div>
						</div>
					<?php } ?>
					<?php if($i>=2){ ?>
						<?php if($i==2){ ?><div class="fl news_b_sub"><?php } ?>
							<div class="news_b_sub_line">
								<div class="padding_news_line">
									<div class="fl news_b_sub_line_img">
										<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" >
											<img alt="<?=$row->{'title_vietnamese'}?>" src="<?=image($row->dir.$row->image,'news_75_50');?>" width="75" height="50" />
										</a>
									</div>
									<div class="fl news_b_sub_line_txt">
										<a class="news_link" href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" >
											<?=cut_string($row->{'title_vietnamese'},60).' ...';?>
										</a>
									</div>
									<div class="clr"></div>
									<div class="padding_news_line_date"><?=get_date_from_sql($row->created) ?></div>
								</div>
							</div>
						<?php if($i==4){ ?></div><?php } ?>
					<?php } ?>
				<?php $i++; endforeach; ?>
                <?php if($i < 5 && $i > 2){ ?></div><?php } ?>
				<div class="clr"></div>
			</div>
		</div>
		<div class="news_right fl">
			<h2 class="news_h2" style="color: #000;">Tin xem nhiều nhất</h2>
			<div class="bg_news_under"></div>
			<ul class="right_news_ul">
				<?php foreach($links_counter as $row): ?>
					<li>
						<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" class="news_link"><?=$row->{'title_vietnamese'};?></a>
						<span class="right_grey_date">(<?=get_date_from_sql($row->created) ?>)</span>
					</li>
				<?php endforeach; ?>
			</ul>
			
			<br /><br />
			<h2 class="news_h2" style="color: #000;">Tin di động việt</h2>
			<div class="bg_news_under"></div>
			<ul class="right_news_ul">
				<?php foreach($ddv_news as $row): ?>
					<li>
						<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" class="news_link">
							<?=$row->{'title_vietnamese'}?>
						</a>
						<span class="right_grey_date">(<?=get_date_from_sql($row->created)?>)</span>
					</li>
				<?php endforeach; ?>
			</ul>
			
			<br /><br />
			<h2 class="news_h2" >Video On <img src="<?=$base_url?>images/icon_youtube.png" /><span></span></h2>
			<div class="bg_news_under"></div>
			<?php foreach($videos as $row): ?>
				<div class="right_youtube">
					<?=$row->{'full_vietnamese'}?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	
	<div class="">
	</div>
	
	<div class="">
	</div>
	
	<div class="clr"></div>
</div>

