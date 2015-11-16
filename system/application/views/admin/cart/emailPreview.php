<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div style="width: 920px;margin:10px auto;">
    <div>
        <div style="float:left;width: 450px;">
              <div style="height: 110px;"><a title="Di động việt" href="<?=$base_url;?>"><img src="<?=$base_url;?>images/logo.png" alt="Di động việt" /></a></div>
              <div style="width: 432px;background-color: red;height: 67px;padding:10px;color:black;">
                    <?php if($cart->shipType == enum::DELIVER_AT_STORE){
                            $store = new Store($cart->deliverStore_id);
                            if(!$store->exists())
                                 $store = new Store(1);
                    }else
                    {
                            $store = new Store(1);
                    }?>
                    <?=$store->name;?>: <?=$store->address;?><br />
                    Điện thoại: <?=$store->phone;?>
              
              </div>
              
              <div style="width: 430px;height: 65px;padding:10px;color:black;margin-top:10px;border:1px #000 solid;">
                    <?php $customer = $cart->customer;?>
                    <table>
                        <tr>
                            <td>Người liên hệ:</td>
                            <td><?=$customer->name;?></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ:</td>
                            <td><?=$customer->address;?></td>
                        </tr>
                        <tr>
                            <td>Điện thoại:</td>
                            <td><?=$customer->mobilePhone;?></td>
                        </tr>
                        
                    </table>
              
              </div>
              <div style="width: 430px;height: 65px;padding:10px;color:black;margin-top:10px;border:1px #000 solid;">
                    <?=$cart->taxInfo;?>
              </div>
        </div>
        <div style="float:left;width: 450px;margin-left:20px;">
              <div style="text-align: center;font-weight: 600;padding-top:70px;height: 40px;"><span>PHIẾU ĐẶT HÀNG</span></div>
              <div style="width: 430px;height: 65px;padding:10px;border:1px #000 solid;">
                    <table>
                        <tr>
                            <td><span style="background: yellow;">MÃ ĐƠN HÀNG:</span></td>
                            <td><?=$cart->code;?></td>
                        </tr>
                        <tr>
                            <td>Ngày đặt hàng:</td>
                            <td><?=get_date_from_sql($cart->created);?></td>
                        </tr>
                        <tr>
                            <td>Ngày giao:</td>
                            <td><?=$cart->dateDeliver;?></td>
                        </tr>
                        
                    </table>
              
              </div>
              
              <div style="width: 430px;height: 65px;padding:10px;border:1px #000 solid;margin-top:10px;">
                    <?php if($cart->shipType == enum::DELIVER_AT_STORE) { ?>
                     <table>
                        <tr>
                            <td>Người nhận:</td>
                            <td><?=$customer->name;?></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ:</td>
                            <td><?=$customer->address;?></td>
                        </tr>
                        <tr>
                            <td>Điện thoại:</td>
                            <td><?=$customer->mobilePhone;?></td>
                        </tr>
                        
                    </table>
                    <?php } else { ?>
                    <table>
                        <tr>
                            <td>Người nhận:</td>
                            <td><?=$cart->shipName;?></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ:</td>
                            <td><?=$cart->shipAddress;?></td>
                        </tr>
                        <tr>
                            <td>Điện thoại:</td>
                            <td><?=$cart->shipPhone;?></td>
                        </tr>
                        
                    </table>
                    <?php } ?>
              
              </div>
              
              
              <div style="width: 430px;height: 65px;padding:10px;border:1px #000 solid;margin-top:10px;">
                    <?=enum::getDeliverMethod($cart->shipType);?><br />
                    <?php if($cart->shipType == enum::DELIVER_AT_STORE){ $store = new Store($cart->deliverStore_id); if(!$store->exists()) $store = new Store(1); ?>
                    <?=$store->name;?>: <?=$store->address;?> 
                    <?php }else{ echo $cart->shipAddress; } ?>
                    
              </div>
        </div>
    </div>
    
    
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
                    <td style="padding-left: 10px;">
                        <a style="text-decoration: none;" href="<?=$base_url;?><?=$row->product->url;?>" target="_blank"><?=$row->productName;?></a>
                        <?php if(trim($row->inBox) != "") echo "<br />(".nl2br($row->inBox).")";?>
                    </td>
                    <td style="text-align: center;padding-top:10px;padding-bottom:10px;"><a href="<?=$base_url;?><?=$row->product->url;?>" target="_blank"><img src="<?=image($row->product->image, "product_admin_list");?>" /></a></td>
                    <td style="text-align: center;"><?=$row->quantity;?></td>
                    <td><div align="right" style="padding-right: 10px;"><?=number_format($row->price).' VND';?></div></td>
                    <td><div align="right" style="padding-right: 10px;">
                        <?php if($row->status == enum::CARTDETAIL_UNAVAILABLE) {?>
                        HẾT HÀNG
                        <?php } else { ?>
                        <?=number_format($row->price * $row->quantity)?> VND
                        <?php } ?>
                        </div>
                    </td>    
                </tr>
                
                <?php
                endforeach;?>
                <tr>
                      <td rowspan="2" colspan="4" style="padding-left: 10px;text-align: left;">
                         Cộng thành tiền (viết bằng chữ)<br />
                         <strong><?=convert_number_to_words(abs((int)$cart->total - (int)$cart->prePaid));?> đồng.</strong>
                      </td>
                      <td style="padding-right: 10px;text-align: right;">Tổng cộng</td>
                      <td style="padding-right: 10px;text-align: right;"> <div><?=number_format($cart->total);?> VND</div></td>
                </tr>
                <tr>
                    <td style="padding-right: 10px;text-align: right;">Ứng trước</td>
                    <td style="padding-right: 10px;text-align: right;"><?=number_format($cart->prePaid);?> VND</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td style="padding-right: 10px;text-align: right;">Còn lại</td>
                    <td style="padding-right: 10px;text-align: right;"><strong><?=number_format((int)$cart->total - (int)$cart->prePaid);?></strong> VND</td>
                </tr>
                
        </table>
    </div>
    
    
    <div style="clear:both;margin-top:20px;">
        <div style="color: #000;font-weight: 600;">Hình thức thanh toán</div>
        <?php if($cart->paymentType == enum::PAYMENT_AT_STORE){?>
            <?php $store = new store($cart->paymentStore_id)   ;?>
             - Thanh toán tại của hàng :  <?=$store->address;?><br/>
             - Điện thoại: <?=$store->phone;?>
        <?php } ?>
        
        
        <?php if($cart->paymentType == enum::PAYMENT_BANKING){?>
              - Thanh toán tại qua ngân hàng : <br/>
             <?=getconfigkey('cartBank');?>
        <?php } ?>
        
        <?php if($cart->paymentType == enum::PAYMENT_ONLINE){?>
             - Vui lòng nhấn vào liên kết sau để thực hiện thanh toán : <br/>
             - <?=$cart->linkOnline;?>
        <?php } ?>
        
        <?php if($cart->paymentType == enum::PAYMENT_ADDRESS){?>
             - Vui lòng đến địa chỉ sau để thực hiện thanh toán : <br/>
             <?php if($cart->shipType == enum::DELIVER_AT_STORE) { 
                $store = new store($cart->deliverStore_id);?>
             - <?=$store->address;?><br/>
             - Điện thoại: <?=$store->phone;?>
             <?php }else{ ?>
             - <?=$cart->shipAddress;?>
             <?php } ?>
        <?php } ?>
        
        <br /><br />
         <?php if(trim($cart->description) != "") { ?>
         <div style="background: yellow;color: red;padding:10px;border:2px dashed red;">
         <span style="font-weight: 600;">PHẢN HỒI TỪ DIDONGVIET.VN</span><br />
         <span><?=$cart->description;?></span>
         </div> 
         <?php }?>
        <br />Chú ý: Xin quý khách vui lòng cung cấp <strong>MÃ ĐẶT HÀNG</strong> khi thanh toán hay nhận hàng tai <strong>DI ĐỘNG VIỆT</strong>.
       
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