<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div style="width: 920px;margin:10px auto;">
    <?php $customer = $cart->customer;?>
    <div>Website didongviet.vn vừa nhận được 1 đơn đặt hàng từ khách hàng <?=$customer->name;?>!</div>
    <div>Vui lòng truy cập link sau để xem chi tiết và xử lý đơn đặt hàng <a href="<?=$base_url;?>admin/carts/edit/<?=$cart->id;?>">LINK</a>. Nội dung thông tin đặt hàng ở bên dưới:</div>
    
    
    <div style="clear: both;padding-top:20px;">
        <table border="1"  style="width: 100%;border: 1px #000 solid;border-collapse:collapse;">
                <tr>
                    <th width="4%">STT</th>
                    <th width="49%">SẢN PHẨM</th>
                    <th width="10%">HÌNH ẢNH</th>
                    <th width="4%">SL</th>
                    <th width="15%" style="text-align: right;padding-right: 10px;">ĐƠN GIÁ</th>
                    <th style="text-align: right;padding-right: 10px;">THÀNH TIỀN</th> 
                </tr>
                <?php $total = 0; $i=0; foreach($cartdetail as $row):$i++;?>
                <tr>
                    <td><div align="center"><?php echo $i;?></div></td>
                    <td style="padding-left: 10px;"><a style="text-decoration: none;" href="<?=$base_url;?><?=$row->product->url;?>" target="_blank"><?=$row->productName;?></a></td>
                    <td style="text-align: center;padding-top:10px;padding-bottom:10px;"><a href="<?=$base_url;?><?=$row->product->url;?>" target="_blank"><img src="<?=image($row->product->image, "product_admin_list");?>" /></a></td>
                    <td style="text-align: center;"><?=$row->quantity;?></td>
                    <td><div align="right" style="padding-right: 10px;"><?=number_format($row->price).' VND';?></div></td>
                    <td><div align="right" style="padding-right: 10px;">
                        
                        <?=number_format($row->price * $row->quantity)?> VND
                        
                        </div>
                    </td>    
                </tr>
                
                <?php
                endforeach;?>
                <tr>
                      <td  colspan="4" style="padding-left: 10px;text-align: left;">
                         Cộng thành tiền (viết bằng chữ)<br />
                         <strong><?=convert_number_to_words(abs((int)$cart->total - (int)$cart->prePaid));?> đồng.</strong>
                      </td>
                      <td style="padding-right: 10px;text-align: right;">Tổng cộng</td>
                      <td style="padding-right: 10px;text-align: right;"> <div><?=number_format($cart->total);?> VND</div></td>
                </tr>
                
                
                
        </table>
    </div>
    
    
   
    
    <div style="clear: both;margin-top:10px;border-top: 1px #000 dashed;padding-top:20px;">
        <div style="width: 200px;float:left;">
           <a title="Di động việt" href="<?=$base_url;?>"><img src="<?=$base_url;?>images/logo.png" alt="Di động việt" /></a>
        </div>
        <div style="width: 700px;float:left">
            DIDONGVIET.VN – Hệ THỐNG  WEBSITE BÁN LẺ THIẾT BỊ DI ĐỘNG CHÍNH HÃNG TẠI VIỆT NAM.<br />
            <?php $store = new store();
                $store->order_by('position','asc');$store->get_iterated();?>
            <?php foreach($store as $row):?>
            <?=$row->name;?>: <?=$row->address;?><br />
            Điện thoại: <?=$row->phone;?><br />
            <?php endforeach;?>
            Email: didongviet.vn@gmai.com
            <div style="width: 200px;height: 20px;">&nbsp;</div>
        </div>
    </div>
</div>
</body>
</html>