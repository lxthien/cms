<?php $this->load->view('front/includes/breadcrumb') ?>
<div id="divProductCompare" style="margin-top: 20px;padding-bottom: 100px;">
    <?php if($this->compareProduct->result_count() > 0){ ?>
       
            
            <h4 class="p_d_title">So sánh sản phẩm</h4>
            <div class="p_d_row">
    			<div class="p_l_txt" style="width: 190px;">Tên sản phẩm</div>
    			
                <?php $h=0; foreach($this->compareProduct as $r):$h++;?>
                        <?php if($h==1) $firstProduct = $r;?>
                        <div class="p_r_txt" style="width: 250px;padding-left:10px;padding-right:10px;">
                        <?=$r->name;?>
                        </div>
                <?php endforeach;?>
                 <?php 
                $productSpec = new productspec();
                $productSpec->where('product_id',$firstProduct->id);
                $productSpec->order_by('position','asc');
                $productSpec->get_iterated();?>
    			<div class="clr"></div>
    		</div>
            <div class="p_d_row">
    			<div class="p_l_txt" style="width: 190px;">Hình ảnh</div>
    			
                <?php $h=0; foreach($this->compareProduct as $r):$h++;?>
                        <div class="p_r_txt" style="width: 250px;padding-left:10px;padding-right:10px;text-align: center;">
                        <img src="<?=image($r->image, "product_home");?>" />
                        </div>
                <?php endforeach;?>
    			<div class="clr"></div>
    		</div>
            
            
            
             <div class="p_d_row">
    			<div class="p_l_txt" style="width: 190px;">Giá</div>
    			
                <?php $h=0; foreach($this->compareProduct as $r):$h++;?>
                        <div class="p_r_txt" style="width: 250px;padding-left:10px;padding-right:10px;text-align: center;">
                            <div class="p_price"><?=$r->getRealPrice();?> VND</div>
                        </div>
                <?php endforeach;?>
    			<div class="clr"></div>
    		</div>
            <div class="p_d_row">
    			<div class="p_l_txt" style="width: 190px;">Loại sản phẩm khỏi so sánh</div>
    			
                <?php $h=0; foreach($this->compareProduct as $r):$h++;?>
                        <div class="p_r_txt" style="width: 250px;padding-left:10px;padding-right:10px;text-align: center;">
                            <input type="button" onclick="removeCompareCookieAndReload('<?=$r->id;?>')" value="Loại sản phẩm" />
                        </div>
                <?php endforeach;?>
    			<div class="clr"></div>
    		</div>
        <?php $k=0; $i=0; foreach($productSpec as $row):$i++;?>
            <?php if($row->productgenspec->isGroup == 1) { ?>
                <?php $rowId = $row->productgenspec->id;?>
                    <h4 class="p_d_title"><?=$row->productgenspec->name;?></h4>
                     <?php 
                    foreach($firstProduct->getSpec() as $spec):?>
                    <?php if($spec->productgenspec->parentcat_id == $rowId) { $i++; ?>
                        <div class="p_d_row">
            				<div class="p_l_txt" style="width: 190px;"><?=$spec->productgenspec->name;?></div>
            				<div class="p_r_txt" style="width: 250px;padding-left:10px;padding-right:10px;">
            					<?=$spec->value;?>
            				</div>
                            <?php $h=0; foreach($this->compareProduct as $r):$h++;?>
                                <?php if($h > 1) { ?>
                                    <div class="p_r_txt" style="width: 250px;padding-left:10px;padding-right:10px;" >
                                    <?php $pSpec = new productspec();
                                          $pSpec->where('productgenspec_id',$spec->productgenspec_id);
                                          $pSpec->where('product_id',$r->id);
                                          $pSpec->get();
                                          if($pSpec->exists()) echo $pSpec->value;
                                          $pSpec->clear();?>  
                                    </div>
                                <?php } ?>
                            <?php endforeach;?>
            				<div class="clr"></div>
            			</div>
                          
                     <?php } endforeach;?>  
                            <?php } ?>
        <?php endforeach;?>
    <?php } else { ?>
    <h3>Vui lòng chọn sản phẩm để so sánh</h3>
    <?php } ?>
    
</div>