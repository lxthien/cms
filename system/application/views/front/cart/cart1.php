<script type="text/javascript" src="<?=$base_url;?>images/js/autoNumeric-1.7.5.js?v1"></script>
<script type="text/javascript" src="<?=$base_url;?>images/js/jquery.validate.js?v1"></script>
<script type="text/javascript">
 var step = '<?=$step;?>';
$().ready(function(){
    $.validator.messages.required = "Vui lòng nhập ô này";
    $.validator.messages.email = "Email này chưa đúng.";
   
    cart_goToStep(<?=$step;?>);
    $(".btnDeleteCartItem").click(function(){
        var parent = $(this).parents(".cart_table_line");
        $.ajax({
           type:'get',
           datatype:'text',
           url: '<?=$base_url;?>xoa-khoi-gio-hang/' + $(this).val() ,
           success: function(data){
                if(data = "true")
                {
                    
                    updateCartCount(1);
                    parent.remove();
                    updateCartPrice();
                    //alert("Xóa sản phẩm khỏi giỏ hàng thành công");
                }
                else
                {
                    alert("Không thể xóa sản phẩm");
                }
           }
        });
        return false;
    });
    
    $(".cartQuantity").autoNumeric({
        vMin:"0",
        vMax:"99"
    });
    
    $(".cartQuantity").keyup(function(){
        updateCartPrice();
    });
    
    $("#btnContinueStep3").click(function(){
        showLoading();
        return true;
    });
    $(":input[name='branchReceive']:eq(0)").prop("checked",true);
    $(".btnDeleteChoice").click(function(){
        $.ajax({
           type:'get',
           datatype:'text',
           url: '<?=$base_url;?>xoa-khoi-gio-hang/' + buildDeleteString() ,
           success: function(data){
                if(data = "true")
                {
                    updateCartCount($(".chkDelete:checked").length);
                    $(".chkDelete:checked").each(function(){
                        $(this).parents(".cart_table_line").remove();
                    });
                    updateCartPrice();
                    //alert("Xóa sản phẩm khỏi giỏ hàng thành công");
                }
                else
                {
                    alert("Không thể xóa sản phẩm");
                }
           }
        });
        return false;
    });
    $(".btnUpdateCart").click(function(){
        $.ajax({
           type:'post',
           datatype:'text',
           url: '<?=$base_url;?>cap-nhat-gio-hang'  ,
           data:{sentData:buildQuanlityArray()},
           success: function(data){
                if(data = "true")
                {
                    
                    alert("Cập nhật giỏ hàng thành công");
                }
                else
                {
                    alert("Không thể cập nhật");
                }
           }
        });
        return false;
    });
    
    receiverTypeChange();
    $(":input[name='receiveType']").click(function(){
        receiverTypeChange();
    });
    
    $("#frmCart").validate({
       rules:{
            info_name:{
                required:{
                    depends:function(){
                        return step == "2" && $(":input[name='receiveType']:checked").val() == "2";
                    }
                }
            },
            info_email:{
                required:{
                    depends:function(){
                        return step == "2" && $(":input[name='receiveType']:checked").val() == "2";
                    }
                },
                email:{
                    depends:function(){
                        return step == "2" && $(":input[name='receiveType']:checked").val() == "2";
                    }
                }
            },
            info_phone:{
                required:{
                    depends:function(){
                        return step == "2" && $(":input[name='receiveType']:checked").val() == "2";
                    }
                }
            },
            info_address:{
                required:{
                    depends:function(){
                        return step == "2" && $(":input[name='receiveType']:checked").val() == "2";
                    }
                }
            }
       } 
    });
    
    $("#btnContinueStep2").click(function(){
        if($("#frmCart").valid())
        {
            step = 3;
            cart_goToStep(3);
            //add the infomation to the step 4
            var deliverAddress = ""; 
            if($(":input[name='receiveType']:checked").val() == "1")
            {
                deliverAddress = $(":input[name='branchReceive']:checked").parents('.branch_line').html();
            }
            else
            {
                deliverAddress = "Địa chỉ thanh toán: " + $(":input[name='info_address']").val();
            }
            
            $(".cartTab4Content").html(deliverAddress);
            $(".cartTab4Content :input[name='branchReceive']").remove();
        }
        return false;
    })  ;  
    paymentChoose();
    $(":input[name='payment']").click(function(){
        paymentChoose();
    });
    $("#btnBackStep3").click(function(){
       step = 2;
       cart_goToStep(2);
       return false; 
    });
    $("#btnDathang").click(function(){
        if($(".cartItemDetail").length == 0)
        {
            alert("Giỏ hàng trống. Vui lòng chọn hàng trước khi thanh toán");
            return false;
        }
        else
        {
            return true;
        }
    });
});
function updateCartCount(minus)
{
    var countItem = $(".btnShoppingCart").text();
    countItem = countItem.split(")").join("");
    countItem = countItem.split("(").join("");
    
    countItem = parseInt(countItem);
    countItem = countItem - minus ;
    $(".btnShoppingCart").text("("+countItem+")");
}
function receiverTypeChange()
{
        if($(":input[name='receiveType']:checked").length == 0)
        {
            $(":input[name='receiveType']:eq(0)").attr("checked",true);
        }
        $("#frmCart").validate().resetForm();
        $("#frmCart *").removeClass('error');
        if($(":input[name='receiveType']:checked").val() == "1")
        {
            $(":input[name='branchReceive']").attr('disabled',false);
            if($(":input[name='branchReceive']:checked").length == 0)
            {
                $(":input[name='branchReceive']:eq(0)").prop('checked',true);
            }
            disableReceiverInfoForm();
        } 
        else
        {
            $(":input[name='branchReceive']").attr('disabled',true);
            undisableReceiverInfoForm();
        }
}
function paymentChoose()
{
    if($(":input[name='payment']:checked").length == 0)
    {
        $(":input[name='payment']:eq(0)").attr('checked',true);
    }
    $(".paymentContent").hide();
    var payment = $(":input[name='payment']:checked").val();
    $(".cartTab"+payment+"Content").show();
    
    if(payment == 1)
    {
        $(":input[name='branchPayment']").attr('disabled',false);
        if($(":input[name='branchPayment']:checked").length == 0)
        {
            $(":input[name='branchPayment']:eq(0)").attr('checked',true);
        }
    }
}
function cart_setTabActive($tabIndex){
    $(".gen li").removeClass("active");
    $(".gen li:eq("+($tabIndex-1)+")").addClass("active");
}
function cart_goToStep(stepIndex)
{
    $(".cartStep").hide();
    $(".cartStep1").show();
    $(".cartStep"+stepIndex).show();
    if(stepIndex != 1)
    {
        $(".cartStep1Btn").hide();
        $(".cartStep1BtnInput").attr('disabled',true);
    }
    else
    {
        $(".cartStep1Btn").show();
        $(".cartStep1BtnInput").attr('disabled',false);
    }
    $(".cart_cmt").hide();
    //$(".cartStep"+stepIndex+" .cart_cmt").show();
    $(".cartStep1 .cart_cmt").show();
    cart_setTabActive(stepIndex);   
}
function buildQuanlityArray()
{
    var arr = [];
    $(".cartQuantity").each(function(){
        var name = $(this).attr('name');
        var id = name.split("_")[1];
        var value = $(this).val();
        if($.trim(value) == "")
        {
            value = 0;
        }
        var item = {};
        item.id = id;
        item.value = value;
        arr.push(item);
         
    });
    return JSON.stringify(arr);
}
function buildDeleteString(){
    var str ="";
    $(".chkDelete:checked").each(function(){
         str += $(this).val()+ "-";
    });
    return str;
}
function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
function removeComas(nStr){
    x = nStr.split(',').join("");
    x = x.split('.').join("");
    if($.trim(x) == "")
        return "0"
    else
        return $.trim(x);
};
function updateCartPrice()
{
    var sum = 0;
    $(".btnDeleteCartItem").each(function(){
        var pId = $(this).val();
        var pPrice =parseInt(removeComas($(".cartItemPrice_"+pId).text())) ;
        var pQuantity = parseInt(removeComas($(".cartQuantity_"+pId).val()));
        var pPriceTotal = pPrice * pQuantity;
        $(".cartItemPriceTotal_"+pId).html(addCommas(pPriceTotal));
        sum += pPriceTotal;
    });
    $(".cartItemSum").html(addCommas(sum));
}
function disableReceiverInfoForm()
{
    $("#receiverInfo :input").attr('disabled',true);
}
function undisableReceiverInfoForm()
{
    $("#receiverInfo :input").attr('disabled',false);
}

</script>
<form id="frmCart" method="post" method="<?=$base_url;?>gio-hang">
<div>
	<?php $this->load->view('front/includes/breadcrumb') ?>
	<div class="main_separate"></div>
	<div class="regis_steps">
		<ul class="gen">
			<li class="active"><span>Giỏ hàng</span></li>
			<li><span>Chọn hình thức nhận hàng</span></li>
			<li><span>Chọn hình thức thanh toán</span></li>
            <li class="arrow_finish"><span>Hoàn tất</span></li>
		</ul>
	</div>
    
    <div class="cartStep2  cartStep" style="display: none;margin-top:20px;">
         <div class="regis_box">
            <div class="regis_box_title">Hình thức nhận hàng</div>
            <div class="cart_receive_title">
    			<span><input type="radio" name="receiveType" value="<?=enum::DELIVER_AT_STORE;?>" checked="checked" /></span>
    			<span class="cart_bg_receive">nhận hàng trực tiếp tại cửa hàng</span>
    		</div>
    		<div class="cart_receive_branch">
                <?php $i=1; foreach($this->store as $row):?>
        			<div class="branch_line">
        				<div class="branch fl">
                            <input type="radio" name="branchReceive" value="<?=$row->id;?>"  style="display: inline;" />
                            <a class="group_map" href="<?=$base_url;?>cua-hang/<?=$i?>" title="<?=$row->name;?> - <?=$row->address;?>"><?=$row->name;?>:</a>
                        </div>
        				<div class="branch_txt fl">
        					<?=$row->address;?> <br />
        					Điện thoại: <?=$row->phone;?>
        				</div>
        				<div class="clr"></div>
        			
        			</div>
                <?php $i++; endforeach;?>
    			
    		</div>
    		
    		<div class="cart_receive_title">
    			<span><input type="radio" name="receiveType" value="<?=enum::DELIVER_CUSTOMER;?>"></span>
    			<span class="cart_bg_receive">nhận hàng tận nơi</span>
    		</div>
    		<div id="receiverInfo">
    			<div class="order_box_title">Thông tin người nhận</div>
    			<div class="regis_line">
    				<div class="fl regis_line_txt">Họ và tên <font color="red">(*)</font></div>
    				<div class="fl "><input type="text" name="info_name"  value="<?=$this->loginUser->name;?>" /></div>
    				<div class="clr"></div>
    			</div>
    			<div class="regis_line">
    				<div class="fl regis_line_txt">Email <font color="red">(*)</font></div>
    				<div class="fl "><input type="text" name="info_email"  value="<?=$this->loginUser->email;?>" /></div>
    				<div class="clr"></div>
    			</div>
    			<div class="regis_line">
    				<div class="fl regis_line_txt">Điện thoại <font color="red">(*)</font></div>
    				<div class="fl "><input type="text" name="info_phone" value="<?=$this->loginUser->mobilePhone;?>" /></div>
    				<div class="clr"></div>
    			</div>
    			<div class="regis_line">
    				<div class="fl regis_line_txt">Địa chỉ nhận hàng <font color="red">(*)</font></div>
    				<div class="fl "><input type="text" name="info_address"  value="<?=$this->loginUser->address;?>" /></div>
    				<div class="clr"></div>
    			</div>
    			
    		</div>
    		
    		<br />
    		<div class="cart_btn">
    			<input type="image" onclick="javascript:window.location.href='<?=$base_url;?>gio-hang';return false;" src="<?=base_url()?>images/btn_back.png" />
    			<input type="image" id="btnContinueStep2" src="<?=base_url()?>images/btn_continue.png" />
    		</div>
            <div class="cart_cmt">
    		  <?php  $cartDes = new article(173);
                        echo $cartDes->full_vietnamese;?>
    		</div>
        </div>
    </div>
    <div class="cartStep3  cartStep" style="display: none;margin-top:20px;">
        <div class="regis_box">
            <div class="regis_box_title">Hình thức thành toán</div>
            <div class="cart_receive_title cartTab1">
    			<span><input type="radio" name="payment" value="<?=enum::PAYMENT_AT_STORE;?>"  ></span>
    			<span class="cart_bg_receive">Thanh toán trực tiếp tại cửa hàng</span>
    		</div>
            <div class="cart_receive_branch paymentContent cartTab1Content">
                <?php $i=1; foreach($this->store as $row):?>
        			<div class="branch_line">
        				<div class="branch fl">
                            <input type="radio" name="branchPayment" value="<?=$row->id;?>"  style="display: inline;" />
                            <a class="group_map" href="<?=$base_url;?>cua-hang/<?=$i?>" title="<?=$row->name;?> - <?=$row->address;?>"><?=$row->name;?>:</a>
                        </div>
        				<div class="branch_txt fl">
        					<?=$row->address;?> <br />
        					Điện thoại: <?=$row->phone;?>
        				</div>
        				<div class="clr"></div>
        			
        			</div>
                <?php $i++; endforeach;?>
    			
    		</div>
    		<div class="cart_receive_title">
    			<span><input type="radio" name="payment" value="<?=enum::PAYMENT_ONLINE;?>"></span>
    			<span class="cart_bg_receive">Thanh toán online</span>
    		</div>
            <div class="cart_receive_branch paymentContent cartTab2Content" style="font-weight: normal;">
                <?=nl2br(getconfigkey('cartOnline'));?>
            </div>
    		<div class="cart_receive_title">
    			<span><input type="radio" name="payment" value="<?=enum::PAYMENT_BANKING;?>"></span>
    			<span class="cart_bg_receive">Thanh toán qua tài khoản ngân hàng</span>
    		</div>
            <div class="cart_receive_branch paymentContent cartTab3Content" style="font-weight: normal;">
                <?=nl2br(getconfigkey('cartBank'));?>
            </div>
    		<div class="cart_receive_title">
    			<span><input type="radio" name="payment" value="<?=enum::PAYMENT_ADDRESS;?>"></span>
    			<span class="cart_bg_receive">Thanh toán tại nơi nhận hàng</span>
    		</div>
    		<div class="cart_receive_branch paymentContent cartTab4Content" style="font-weight: normal;">
                
            </div>	
            <div class="regis_line" style="border: 1px dashed #CCCCCC;padding: 20px 20px;">
    				<div class="">Trong trường hợp muốn bổ sung bất cứ thông tin nào. Vui lòng điền vào ô ghi chú bên dưới:</div>
    				<div style="margin-top:10px;"><textarea rows="4" style="width: 100%;" name="info_description"></textarea></div>
    				<div class="clr"></div>
   			</div>	
    		<br />
    		<div class="cart_btn">
    			<input type="image" id="btnBackStep3" src="<?=base_url()?>images/btn_back.png" />
    			<input type="image" id="btnContinueStep3" src="<?=base_url()?>images/btn_finish.png" />
    		</div>
            <div class="cart_cmt">
    		  <?php
                        echo $cartDes->full_vietnamese;?>
    		</div>
        </div>
        
    </div>
    <div class="cartStep1 cartStep" style="display: none;margin-top:10px;">
    	<div class="regis_box">
    		<div class="regis_box_title">Sản phẩm có trong giỏ hàng</div>
    		<div class="cart_table">
    			<div class="cart_table_title">
    				<div class="fl col col1">Chọn/Xoá</div>
    				<div class="fl col col2" style="padding-top: 20px;">Sản phẩm</div>
    				<div class="fl col col3"></div>
    				<div class="fl col col4">Số lượng</div>
    				<div class="fl col col5">Đơn giá</div>
    				<div class="fl col col6">Thành tiền</div>
    				<div class="clr"></div>
    			</div>
    			<?php $sum = 0; foreach($product as $row):?>
    			<div class="cart_table_line cartItemDetail">
    				<div class="fl col col1">
    					<input type="checkbox" class="chkDelete cartStep1BtnInput" value="<?=$row->id;?>" name="chkDelete_<?=$row->id;?>" />
    					<br />
    					<input class="btnDeleteCartItem cartStep1Btn" value="<?=$row->id;?>" type="image" src="<?=base_url()?>images/btn_delete.png" />
    				</div>
    				<div class="fl col col2">
    					<div class="fl col2_img"><img src="<?=image($row->image,'product_cart');?>"></div>
    					<div class="fl col2_txt" >
    						<b><?=$row->name;?></b> <br />
    						<i>
    							<?=$row->origin;?>
    						</i>
    					</div>
    					<div class="clr"></div>
    				</div>
    				<div class="fl col col3">
    					
    				</div>
    				<div class="fl col col4">
    					<input type="text" value="<?=$cartDetail[$row->id];?>" class="cartQuantity_<?=$row->id;?> cartQuantity cartStep1BtnInput" name="cartQuantity_<?=$row->id;?>" size="1" />
    				</div>
    				<div class="fl col col5"><span class="cartItemPrice_<?=$row->id;?>" ><?=$row->getRealPrice();?></span></div>
    				<div class="fl col col6">
                        <?php $itemTotal = $cartDetail[$row->id]*$row->getRealPriceNum(); $sum += $itemTotal?>
                        <span class="cartItemPriceTotal_<?=$row->id;?> cartItemPriceTotal"><?=number_format($itemTotal);?></span>
                    </div>
    				<div class="clr"></div>
                    <div class="cart_line"></div>
    			</div>
                
                <?php endforeach;?>
                <div class="cart_table_line cartStep1Btn">
    				<div class="fl col col1" style="padding-top: 0;">
    					<input type="button" class="btnDeleteChoice" value="Xóa chọn" />
    				</div>
    				<div class="fl col col2">
    					&nbsp;
    				</div>
    				<div class="fl col col3">
    					<input type="button" class="btnUpdateCart" value="Cập nhật" />
    				</div>
    				<div class="fl col col4">
    					
    				</div>
    				<div class="fl col col5"></div>
    				<div class="fl col col6">
                        
                    </div>
    				<div class="clr"></div>
                    
    			</div>
    		
    		</div>
    		<div class="cart_total">
    			<span class="cart_total_txt">Tổng số tiền thanh toán</span> <span class="p_price"><span class="cartItemSum"><?=number_format($sum);?></span> VND</span>
    		</div>
    		<div class="cart_btn cartStep1Btn">
    			<input type="image" onclick="javascript:window.location.href='<?=$base_url;?>';return false;" src="<?=base_url()?>images/btn_continue_order.png" />
    			<a id="btnDathang" href="<?=$base_url;?>gio-hang/buoc-2"><img src="<?=$base_url?>images/btn_order.png" /></a>
    		</div>
    		<div class="cart_cmt">
    		  <?php  $cartDes = new article(173);
                        echo $cartDes->full_vietnamese;?>
    		</div>
    	</div>
    </div>
	<div class="clr"></div>
</div>
</form>

