<script type="text/javascript" src="<?=$base_url;?>images/js/autoNumeric-1.8.1.js"></script>
<script type="text/javascript">
var cartStatus = '<?=$cart->status;?>';
$().ready(function(){
     if(cartStatus == <?=enum::CART_CANCEL;?> || cartStatus == <?=enum::FINISH;?>)
     {
        cartDisable();
     }
     $(":input[name='deliverMethod']").change(function(){ deliverMethodChange();});
     $(":input[name='payment']").change(function(){ paymentChange();});
     paymentChange();
     deliverMethodChange();
});
function chooseMultiProduct(productId)
{
    if($(":input[name='productCheck[]']:checked").length > 10)
    {
        alert("Chỉ được chọn tối đa 10sp");
    }
    else
    {
        $.ajax({
           url: "<?=$base_url;?>admin/carts/addDetail/<?=$cart->id;?>" ,
           type: "POST",
           data: $("#productMultiSelect").serialize(),
           dataType:"text",
           success:function(data){
                $(".cartDetail").html(data);
                hideProductMultiDialog();
           } 
        });    
    }
    
}
function cartDisable()
{
    $("#frmCart :input").attr("disabled",true).css("background-color","#fff").css("border","1px solid #ccc");
    $(".btnDeleteCartItem").remove();
    $(".addDetail").remove();
    $(".button_bar").remove();
}
function deliverMethodChange()
{
    if($(":input[name='deliverMethod']").val() == '<?=enum::DELIVER_AT_STORE;?>')
    {
        $(".deliverAtStore").show();
        $(".deliverCustomer").hide();
    }else
    {
        $(".deliverAtStore").hide();
        $(".deliverCustomer").show();
    }
}
function paymentChange()
{
    if($(":input[name='payment']").val() == '<?=enum::PAYMENT_AT_STORE;?>')
    {
        $(".paymentStore").show();
    }else
    {
        $(".paymentStore").hide();
    }
}
</script>
<form id="frmCart" class="table_input" action="<?=$base_url;?>admin/carts/edit/<?=$cart->id;?>" method="post">
<div class="grid_15" id="textcontent" > 
    
    <table class="table_input">
        <tr>
            <td style="width: 194px;"><label for="name">Mã đơn hàng:</label></td>
            <td><?=$cart->code;?></td>
        </tr>
        <tr>
            <td><label for="name">Tình trạng đơn hàng:</label></td>
            <td><select name="cartStatus">
                    <option value="<?=enum::CART_WAIT_FOR_PROCESS;?>" <?=selectIt($cart->status,enum::CART_WAIT_FOR_PROCESS);?> ><?=enum::getCartStatus(enum::CART_WAIT_FOR_PROCESS);?></option>
                    <option value="<?=enum::CART_PROCESSING;?>" <?=selectIt($cart->status,enum::CART_PROCESSING);?> ><?=enum::getCartStatus(enum::CART_PROCESSING);?></option>
                    <option value="<?=enum::CART_SENT_MAIL_AND_WAIT_CUSTOMER;?>" <?=selectIt($cart->status,enum::CART_SENT_MAIL_AND_WAIT_CUSTOMER);?> ><?=enum::getCartStatus(enum::CART_SENT_MAIL_AND_WAIT_CUSTOMER);?></option>
                    <option value="<?=enum::CART_CANCEL;?>" <?=selectIt($cart->status,enum::CART_CANCEL);?> ><?=enum::getCartStatus(enum::CART_CANCEL);?></option>
                    <option value="<?=enum::CART_DELIVERING;?>" <?=selectIt($cart->status,enum::CART_DELIVERING);?> ><?=enum::getCartStatus(enum::CART_DELIVERING);?></option>
                    <option value="<?=enum::FINISH;?>" <?=selectIt($cart->status,enum::FINISH);?> ><?=enum::getCartStatus(enum::FINISH);?></option>
                </select></td>
        </tr>
        <tr>
            <td><label for="name">Khách hàng:</label></td>
            <td>
                <?php $customer = $cart->customer;?>
                    <table style="width: 100%;">
                        <tr>
                            <td><label>Họ và tên:</label></td>
                            <td><?=$customer->name;?></td>
                            <td><label>Tên đăng nhập:</label></td>
                            <td><?=$customer->username;?></td>
                        </tr>
                        <tr>
                            <td><label>Email:</label></td>
                            <td><?=$customer->email;?></td>
                            <td><label>Điện thoại:</label></td>
                            <td><?=$customer->mobilePhone;?></td>
                        </tr>
                        <tr>
                            <td><label>Địa chỉ:</label></td>
                            <td colspan="3"><?=$customer->address;?></td>
                        </tr>
                        <tr>
                            <td><label>Ngày đăng ký:</label></td>
                            <td colspan="3"><?=get_from_datetime($customer->created);?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><a href="<?=$base_url;?>admin/customers/edit/<?=$customer->id;?>" target="_blank">Thay đổi thông tin khách hàng này >></a></td>
                        </tr>
                    </table>
            </td>
        </tr>
        <tr>
            <td><label for="name">Hình thức nhận hàng:</label></td>
            <td>
                <select name="deliverMethod">
                    <option <?=selectIt($cart->shipType,enum::DELIVER_AT_STORE);?> value="<?=enum::DELIVER_AT_STORE;?>"><?=enum::getDeliverMethod(enum::DELIVER_AT_STORE);?></option>
                    <option <?=selectIt($cart->shipType,enum::DELIVER_CUSTOMER);?> value="<?=enum::DELIVER_CUSTOMER;?>"><?=enum::getDeliverMethod(enum::DELIVER_CUSTOMER);?></option>
                </select>
        
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
               
                 <div class="deliverAtStore"  >
                     <?php $i=1; foreach($store as $row):?>
        			<div class="branch_line " style="clear:both;display: block;width: 600px;">
        				<div class="branch">
                            <input type="radio" <?=checkIt($cart->deliverStore_id,$row->id);?> name="branchReceive" value="<?=$row->id;?>"  style="display: inline;" />
                            <?=$row->name;?>: <?=$row->address;?>
                        </div>
        				
        				<div class="clr"></div>
        			
        			</div>
                    <?php $i++; endforeach;?>
                        

                 </div>
                
                <div class="deliverCustomer"  >
                    <table class="table_input">
                        <tr>
                            <td colspan="4"><label>Thông tin người nhận</label></td>
                        </tr>
                        <tr>
                            <td><label>Họ và tên:</label></td>
                            <td colspan="3"><input type="text" name="info_name" value="<?=$cart->shipName;?>" style="width: 550px;" /></td>
                        </tr>
                        <tr>
                            <td><label>Email:</label></td>
                            <td><input type="text" name="info_email" value="<?=$cart->shipEmail;?>" style="width: 200px;" /></td>
                            <td><label>Điện thoại:</label></td>
                            <td><input type="text" name="info_phone" value="<?=$cart->shipPhone;?>"  style="width: 200px;" /></td>
                        </tr>
                        <tr>
                            <td><label>Địa chỉ:</label></td>
                            <td colspan="3"><input type="text" name="info_address" value="<?=$cart->shipAddress;?>" style="width: 550px;" /></td>
                        </tr>
                        
                        <tr><td colspan="4"></td></tr>
                    </table>
                
                </div>
            </td>
        </tr>
        
        <tr>
            <td><label for="name">Hình thức thanh toán:</label></td>
            <td>
                <select name="payment">
                    <option <?=selectIt($cart->paymentType,enum::PAYMENT_AT_STORE);?> value="<?=enum::PAYMENT_AT_STORE;?>"><?=enum::getPaymentMethod(enum::PAYMENT_AT_STORE);?></option>
                    <option <?=selectIt($cart->paymentType,enum::PAYMENT_ONLINE);?> value="<?=enum::PAYMENT_ONLINE;?>"><?=enum::getPaymentMethod(enum::PAYMENT_ONLINE);?></option>
                    <option <?=selectIt($cart->paymentType,enum::PAYMENT_BANKING);?> value="<?=enum::PAYMENT_BANKING;?>"><?=enum::getPaymentMethod(enum::PAYMENT_BANKING);?></option>
                    <option <?=selectIt($cart->paymentType,enum::PAYMENT_ADDRESS);?> value="<?=enum::PAYMENT_ADDRESS;?>"><?=enum::getPaymentMethod(enum::PAYMENT_ADDRESS);?></option>
                </select>
        
            </td>
        </tr>
        <tr class="paymentStore"   >
            <td>Chọn cửa hàng thanh toán</td>
            <td>
                <div>
                     <?php $i=1; foreach($store as $row):?>
        			<div class="branch_line " style="clear:both;display: block;width: 600px;">
        				<div class="branch">
                            <input type="radio" <?=checkIt($cart->paymentStore_id,$row->id);?> name="branchPayment" value="<?=$row->id;?>"  style="display: inline;" />
                            <?=$row->name;?>: <?=$row->address;?>
                        </div>
        			
        				<div class="clr"></div>
        			
        			</div>
                    <?php $i++; endforeach;?>
                    
                 </div>
            </td>
        </tr>
        <tr>
                <td><label>Ghi chú của khách hàng:</label></td>
                <td>
                    <textarea name="info_description" style="width: 550px;" rows="5"><?=$cart->shipDescription;?></textarea>
                </td>
            </tr>
        <tr>
            <td colspan="2" style="color: red;background-color: yellow !important;font-weight: 600;">Phần thông tin bổ sung của người xử lý hóa đơn</td>
        </tr>
        <tr>
            <td><label for="name">Ngày nhận:</label></td>
            <td><?=get_date_from_sql($cart->created);?></td>
        </tr>
        <tr>
            <td><label for="name">Ngày giao hàng dự kiến:</label></td>
            <td><input type="text" name="dateDeliver" class="smallInput medium" value="<?=$cart->dateDeliver;?>" /></td>
        </tr>
        <tr>
            <td><label for="name">Khách hàng đã ứng trước:</label></td>
            <td><input type="text" name="prePaid" class="smallInput medium" value="<?=$cart->prePaid;?>" /></td>
        </tr>
        <tr>
            <td><label for="name">Thông tin về thuế:</label></td>
            <td><textarea rows="5" name="taxInfo" class="smallInput medium"><?=$cart->taxInfo?></textarea></td>
        </tr>
        <tr>
            <td><label for="name">Link thanh toán online<br/>(trường hợp thanh toán online):</label></td>
            <td><textarea rows="5" name="linkOnline" class="smallInput medium"><?=$cart->linkOnline?></textarea></td>
        </tr>
        
        <tr>
            <td><label for="name">Ghi chú của người xử lý:</label></td>
            <td><textarea rows="5" name="description" class="smallInput medium"><?=$cart->description?></textarea></td>
        </tr>
       
    </table>
   
</div>
<div class="cl"></div>
<!--end information customer-->
<div id="portlets">
<div class="column"></div>
<div class="portlet">
<div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users"/>Danh sách sản phẩm trong dơn hàng</div>
<div class="portlet-content nopadding">
    <div class="cartDetail">
        <?php $this->load->view('admin/cart/listDetail');?>
    </div>
	<div><a href="javascript:void(0)" class="addDetail" style="padding: 5px;background-color:yellow;color:red;" onclick="showProductMultiDialog(0)" >Thêm sản phẩm vào giỏ hàng</a></div>
   	<div style="padding-top:20px;"></div>

</div>
</div>
</div>
<div style="text-align: center;color:red">Chú ý: Ấn nút cập nhật thông tin để lưu thông tin thay đổi trước khi gửi email cho khách hàng.</div>
<div class="button_bar">
    <?php create_form_button('button_ok','Xem trước email','javascript:window.open ("'.$base_url.'admin/carts/sendMailCustomerStep1/'.$cart->id.'","Email Preview","width=1000,location=1,status=1,scrollbars=1,toolbar=1");' );?>
    <?php create_form_button('button_ok','Gửi email','javascript:window.location.href="'.$base_url.'admin/carts/sendMailCustomerStep2/'.$cart->id.'";' );?>
    <?php create_form_button('submit_button button_ok','Cập nhật đơn hàng');?>
    <div class="clear"></div>
</div>
 </form>