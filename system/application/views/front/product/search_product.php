<?php if($phoneTabletProduct->result_count()){?>
<div class="pp_separate"></div>
<div class="main_title">
	<h2 class="">Kết quả tìm kiếm Điện thoại & Máy tính bảng</h2>
	<div class="fr"><?php echo $this->pagination->create_links_product();?></div>	
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