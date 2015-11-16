<div class="regis_box" style="width: 388px;">
	<div class="regis_box_title">Sản phẩm đã chọn</div>
	<div class="cart_table">
		<div class="cart_table_title">
			
			<div class="fl col col2">Sản phẩm</div>
			<div class="fl col col6">Thành tiền</div>
			<div class="clr"></div>
		</div>
		<?php 
         $sum = 0;
         foreach($product as $row):
         $sum += $row->getRealPriceNum(); 
         ?>
		<div class="cart_table_line">
			<div class="fl col col2">
				<div class="fl col2_img"><img src="<?=image($row->image,'product_choiceList');?>" ></div>
				<div class="fl col2_txt" >
					<b><?=$row->name;?></b> <br />
					<i>
						Hàng công ty <br />
						Giá đã bao gồm thuế VAT
					</i>
				</div>
				<div class="clr"></div>
			</div>
			<div class="fl col col6"><?=$row->getRealPrice();?></div>
			<div class="clr"></div>
		</div>
        <?php endforeach;?>        
	</div>
	<div class="cart_total">
		<span class="cart_total_txt">Tổng số tiền thanh toán</span> <span class="p_price"><?=number_format($sum);?> VND</span>
	</div>
</div>

