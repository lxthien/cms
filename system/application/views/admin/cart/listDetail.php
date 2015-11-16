
<script type="text/javascript">
$().ready(function(){
    calculateTotal();
    $(".cartDetailStatus").change(function(){
         calculateTotal();
    });
    
    $(".cartDetailQuantity").keyup(function(){
        calculateTotal(); 
    });
    $(".btnDeleteCartItem").click(function(){
        
        $.ajax({
           type:'post',
           datatype:'html',
           data:{detailId: $(this).siblings(".detailItem").val()},
           url: '<?=$base_url;?>admin/carts/deleteDetail/<?=$cart->id;?>',
           success: function(data){
                $(".cartDetail").html(data);
           }
        });
        return false;
    });
    $(".cartInboxDefault").click(function(){
            var sib = $(this).siblings(".cartInboxChange");
            $(this).hide();
            sib.show(); 
    });
    $(".cartPriceDefault").click(function(){
            var sib = $(this).siblings(".cartPriceChange");
            $(this).hide();
            sib.show(); 
            var newPriceItem = sib.find(":input");
            newPriceItem.autoNumeric('init',{
                vMin:'0',
                vMax:'999999999'
            });
            newPriceItem.autoNumeric('set',newPriceItem.val());
    });
    
    $(".inboxChangeSubmit").click(function(){
             updateInbox($(this));
    });
    $(".priceChangeSubmit").click(function(){
             updatePrice($(this));
    });
    
    
    $(".cartDetailQuantity").autoNumeric('init',{
        vMin:'0',
        vMax:'50'
    });
    
});

function nl2br (str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function updatePrice($element)
{
    var cartPriceChange = $element.parents(".cartPriceChange");
    var cartPriceDefault = cartPriceChange.siblings(".cartPriceDefault");
    var newPriceItem = cartPriceChange.find(":input");
    newVal = newPriceItem.autoNumeric('get');
    newPriceItem.autoNumeric('destroy');
    newPriceItem.val(newVal); 
    var spanPrice = cartPriceDefault.find("span"); 
    spanPrice.html(addCommas(newPriceItem.val())+" VND");
    //hide change show default
    cartPriceChange.hide();
    cartPriceDefault.show();
    calculateTotal(); 
}

function updateInbox($element)
{
    var cartInboxChange = $element.parents(".cartInboxChange");
    var cartInboxDefault = cartInboxChange.siblings(".cartInboxDefault");
    var newInboxItem = cartInboxChange.find("textarea");
    if($.trim(newInboxItem.val())== "")
        cartInboxDefault.html("Click to edit");
    else
        cartInboxDefault.html(nl2br(newInboxItem.val()));
    //hide change show default
    cartInboxChange.hide();
    cartInboxDefault.show(); 
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
function calculateTotal()
{
    var total = 0;
    $(".cartDetailStatus").each(function(){
         var name = $(this).attr('name');
         var id = name.split("_");
         id = id[1];
         if($(this).val() == <?=enum::CARTDETAIL_AVAILABLE;?> )
         {
              $(".totalPerItem_"+id).show();
              $(".emptyPerItem_"+id).hide();
              var pQuantity =parseInt($(":input[name='cartDetailQuantity_"+id+"']").val()) ;
              var pPrice = parseInt($(":input[name='cartDetailPrice_"+id+"']").val()) ;
              
              var pPriceTotal = pPrice * pQuantity;
              $(".totalPerItem_"+id).text(addCommas(pPriceTotal));
              total += parseInt(pPriceTotal);
         }else{
              $(".totalPerItem_"+id).hide();
              $(".emptyPerItem_"+id).show();
         }
         
         $(".totalAmount").html(addCommas(total) + " VND");
         $(":input[name='hiTotal']").val(total);
    });
}
</script>
<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
   	  <tr>
        <th width="3%"><div align="center">TT</div></th>    
        <th>Hình</th>
        <th width="30%"><div align="left">Tên sản phẩm</div></th>
        <th width="27%"><div align="left">Nguyên hộp</div></th>
        <th width="5%"><div align="left">SL</div></th>
        <th width="15%"><div align="center">Đơn giá</div></th>
        <th width="15%"><div align="left">Tổng tiền</div></th>
        <th width="12%"><div align="center">Tình trạng</div></th>
        <th ><div align="center">Xóa</div></th>
      </tr>
        <?php $total = 0; $i=0; foreach($cartdetail as $row):$i++;?>
        <tr>
            <td widtd="6%"><div align="center"><?php echo $i;?></div></td>
            <td><a href="<?=$base_url;?><?=$row->product->url;?>" target="_blank"><img src="<?=image($row->product->image, "product_admin_list");?>" /></a></td>
            <td><a href="<?=$base_url;?><?=$row->product->url;?>" target="_blank">
                    <?=$row->productName;?>
                 </a>
            </td>
            <td>
                <div class="cartInboxDefault">
                    <?=$row->inBox;?>
                    <?php if(trim($row->inBox) == "") echo "Click to edit";?>
                </div>
                <div class="cartInboxChange" style="display: none;">
                    <div class="fl"><textarea name="cartDetailInbox_<?=$row->id;?>" autocomplete="off" class="smallInput" style="width: 170px;height: 90px;"><?=$row->inBox;?></textarea></div>
                    <div class="fl" style="margin-top: 40px;"><a href="javascript:void(0)" class="inboxChangeSubmit" ><img src="<?=$base_url;?>images/admin/images/icons/action_check.gif" /></a></div>
                </div>
            </td>
                 
            <td>
                <input type="text" style="width: 25px;" value="<?=$row->quantity;?>" autocomplete="off" class="cartDetailQuantity" name="cartDetailQuantity_<?=$row->id;?>" /></td>
            <td>
                
                    <div class="cartPriceDefault" align="center">
                        <span class="cartDetailPrice"><?=number_format($row->price).' VND';?></span>
                    </div>
                    <div class="cartPriceChange" style="display: none;">
                        <div class="fl"><input type="text" style="width: 80px;" autocomplete="off" name="cartDetailPrice_<?=$row->id;?>" class="txtCartDetailPrice" value="<?=$row->price;?>" /></div>
                        <div class="fl">
                            <a href="javascript:void(0)" class="priceChangeSubmit" ><img src="<?=$base_url;?>images/admin/images/icons/action_check.gif" /></a>
                        </div>
                    </div>
            </td>
            <td><div align="left">
                <span class="totalPerItem_<?=$row->id;?>"><?=number_format($row->price * $row->quantity)?></span>
                <span class="emptyPerItem_<?=$row->id;?>">0</span> VND
                </div>
            </td>
            <td>
                <select name="cartDetailStatus_<?=$row->id;?>" class="cartDetailStatus">
                    <option value="<?=enum::CARTDETAIL_AVAILABLE;?>" <?=selectIt($row->status,enum::CARTDETAIL_AVAILABLE);?> ><?=enum::getCartDetailStatus(enum::CARTDETAIL_AVAILABLE);?></option>
                    <option value="<?=enum::CARTDETAIL_UNAVAILABLE;?>" <?=selectIt($row->status,enum::CARTDETAIL_UNAVAILABLE);?> ><?=enum::getCartDetailStatus(enum::CARTDETAIL_UNAVAILABLE);?></option>
                </select>
            </td>
            <td>
                <a href="javascript:void(0)" class="btnDeleteCartItem cartStep1Btn" >
                    <img src="<?=base_url()?>images/btn_delete.png"/> 
                </a>
                <input type="hidden" class="detailItem" id="detailItem_<?=$row->id;?>" value="<?=$row->id;?>" />
                
        </tr>
        <?php
        endforeach;?>
        <tr>
            <td colspan="6" align="right"><label>Số tiền khách hàng phải thanh toán:</label></td>
            <td colspan="3" align="left" style="color: red;font-weight: 600;" class="totalAmount">
                <?=number_format($cart->total).' VND';?>
            </td>
        </tr>
        <input type="hidden" name="hiTotal" value="<?=$cart->total;?>" />
    </table>