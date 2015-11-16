<div class="price_detail_ct" >                               
            <table >                                    
                <tbody><tr>
                    <th class="fone_name">Sản phẩm</th>
                    <th class="fone_box">Nguyên hộp bao gồm</th>
                    <th class="fone_price">Giá (VNĐ)</th>
                </tr>
                <?php foreach($product as $row):?>
                <?php if($row->getRealPriceNum() != 0){?>
             	<tr>
                    <td class="fone_name"><a href="<?=$base_url;?><?=$row->url;?>" title="<?=$row->name;?>"><?=$row->name;?></a></td>
                    <td class="fone_box"><?=$row->inBox;?></td>
                    <td class="fone_price"><?=$row->getRealPrice();?></td>
                </tr>
                <?php } ?>
                <?php endforeach;?>
			</tbody></table>
    </div>