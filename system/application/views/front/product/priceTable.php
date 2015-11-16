<script type="text/javascript">
$().ready(function(){
   $(".pricePopup").colorbox({
        width:900,
        height:500,
        fixed:true
   }); 
});
</script>
<div class="main_title">
	<h2 class="">Bảng giá điện thoại di động</h2>
	<a class="fr" style="padding-top: 5px;" href="" title="Bảng giá điện thoại di động cập nhật ngày <?=date("d/m/Y");?>">Cập nhật ngày <?=date("d/m/Y");?></a>	
</div>
<div class="main_product">
    <p class="show_price_guide">Click vào logo để xem bảng giá.</p><br />
    <?php $i=0; foreach($manu as $row):$i++;?>
    <?php if($i% 5 == 1) echo '<div class="pp_line">';?>
	<div class="pp fl" style="width: 140px;height: 140px;">
        <div class="pp_pad"  >
                <a style="line-height: 140px;"  title="Bảng giá điện thoại & máy tính bảng <?=$row->name;?> cập nhật ngày <?=date("d/m/Y");?>" href="<?=$base_url;?>bang-gia/gia_<?=$row->id;?>" class="pricePopup">
                    <img style="vertical-align: middle;" alt="Bảng giá <?=$row->name;?>" src="<?=image($row->image,'product_manu');?>"  />
                </a>
        </div>
    </div>
    <?php if($i% 5 == 0) echo '</div><div class="clr"></div>';?>
    <?php endforeach;?>
    <?php if($i% 5 > 0) echo '</div><div class="clr"></div>';?>
    
</div>