<?php $this->load->view('front/includes/breadcrumb') ?>
<?php if($phoneTabletProduct->result_count()){?>
<div class="pp_separate"></div>
<div class="main_title">
	<h2 class="">Kết quả tìm kiếm Điện thoại & Máy tính bảng</h2>
	<a class="fr" style="padding-top: 5px;" href="<?=$base_url.'tim-kiem/'.urlencode(htmlentities($searchKey));?>/dien-thoai-may-tinh-bang">Xem tất cả kết quả tìm kiếm</a>	
</div>
<div class="main_product">
        <?php $i=0; foreach($phoneTabletProduct as $row):$i++;?>
        <?php if($i% 5 == 1) echo '<div class="pp_line">';?>
		<?=printProduct($row);?>
        <?php if($i% 5 == 0) echo '</div><div class="clr"></div>';?>
        <?php endforeach;?>
        <?php if($i% 5 > 0) echo '</div><div class="clr"></div>';?>
  
</div>
<?php } ?>

	
<?php if($accessoryProduct->result_count()){?>
<div class="pp_separate"></div>
<div class="main_title">
	<h2 class="">Kết quả tìm kiếm Phụ kiện</h2>
	<a class="fr" style="padding-top: 5px;" href="<?=$base_url.'tim-kiem/'.urlencode(htmlentities($searchKey));?>/phu-kien">Xem tất cả kết quả tìm kiếm</a>	
</div>
<div class="main_product">
        <?php $i=0; foreach($accessoryProduct as $row):$i++;?>
        <?php if($i% 5 == 1) echo '<div class="pp_line">';?>
		<?=printProduct($row);?>
        <?php if($i% 5 == 0) echo '</div><div class="clr"></div>';?>
        <?php endforeach;?>
        <?php if($i% 5 > 0) echo '</div><div class="clr"></div>';?>
  
</div>
<?php } ?>



<?php if($newsResult->result_count()){?>
<div class="pp_separate"></div>
<div class="main_title">
	<h2 class="">Kết quả tìm kiếm Tin tức</h2>
	<a class="fr" style="padding-top: 5px;" href="<?=$base_url.'tim-kiem/'.urlencode(htmlentities($searchKey));?>/tin-tuc">Xem tất cả kết quả tìm kiếm</a>		
</div>
<div class="main_product">
        <?php $i = 1; foreach($newsResult as $row): ?>
			<div class="news_ln news_ln_cat">
				<div class="fl news_de_img">
					<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>">
						<img alt="<?=$row->{'title_vietnamese'}?>" src="<?=image($row->dir.$row->image,'new_cat');?>"  />
					</a>
				</div>
				<div class="fl news_ln_txt" style="width: 587px;">
					<div>
						<a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" class="news_link font_bold">
							<?=$row->{'title_vietnamese'}?>
						</a>
					</div>
					<div class="news_de_txt">
						<?=cut_string($row->{'full_vietnamese'},500).' ...';?>
					</div>
					<div class="news_view_more"><a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>">Chi tiết</a></div>
				</div>
				<div class="clr"></div>
			</div>
		<?php $i++; endforeach; ?>
  
</div>
<?php } ?>
