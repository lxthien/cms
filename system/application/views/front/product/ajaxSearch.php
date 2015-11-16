<?php if($phoneTabletProduct->result_count() > 0 ||
           $accessoryProduct->result_count() > 0 ||
           $newsResult->result_count() > 0 ) { ?>
<div class="searchResultContent">
    <?php if($phoneTabletProduct->result_count() >0 ) { ?>
    <div class="searchResultTab">
        <?php foreach($phoneTabletProduct as $row):?>
        <div class="searchResultItem">
            <div class="itemImage"><a href="<?=$base_url.$row->url;?>" title="<?=$row->getName();?>" ><img alt="<?=$row->getName();?>" src="<?=image($row->image,'search_ajax_product')?>"   /></a></div>
            <div class="itemText"><a href="<?=$base_url.$row->url;?>" title="<?=$row->getName();?>" ><?=$row->getName();?></a></div>
        </div>
        <?php endforeach;?>
        
    </div>
    <?php } ?>
    <?php if($accessoryProduct->result_count() >0 ) { ?>
    <div class="searchResultTab" style="display:none;">
        <?php foreach($accessoryProduct as $row):?>
        <div class="searchResultItem">
            <div class="itemImage"><a href="<?=$base_url.$row->url;?>" title="<?=$row->getName();?>"><img alt="<?=$row->getName();?>" src="<?=image($row->image,'search_ajax_product')?>"  /></a></div>
            <div class="itemText"><a href="<?=$base_url.$row->url;?>" title="<?=$row->getName();?>" ><?=$row->getName();?></a></div>
        </div>
        <?php endforeach;?>
        
    </div>
    <?php } ?>
     <?php if($newsResult->result_count() >0 ) { ?>
    <div class="searchResultTab" style="display:none;">
        <?php foreach($newsResult as $row):?>
        <div class="searchResultItem">
            <div class="itemImage"><a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" ><img alt="<?=$row->{'title_vietnamese'}?>" src="<?=image($row->dir.$row->image,'search_ajax_news')?>" /></a></div>
            <div class="itemText"><a href="<?=$base_url."tin-tuc/d/".$row->{'title_none'}?>" title="<?=$row->{'title_vietnamese'}?>" ><?=$row->title_vietnamese;?></a></div>
        </div>
        <?php endforeach;?>
        
    </div>
    <?php } ?>
</div>
<div class="ajaxSearchViewMore"><a href="javascript:void(0)">Xem thêm &nbsp;</a></div>
<div class="viewResult">
    Xem kết quả từ khóa <span class="keySearch">"<?=$searchKey;?>"</span> với:</div>
<div class="searchResultTitle">
    <?php if($phoneTabletProduct->result_count() >0 ) { ?>
    <div class="searchResultTitleTab">ĐIỆN THOẠI &amp; TABLET</div>
    <?php } ?>
    <?php if($accessoryProduct->result_count() >0 ) { ?>
    <div class="searchResultTitleTab">PHỤ KIỆN</div>
    <?php } ?>
     <?php if($newsResult->result_count() >0 ) { ?>
    <div class="searchResultTitleTab">TIN TỨC</div>
    <?php } ?>
</div>
<?php } ?>