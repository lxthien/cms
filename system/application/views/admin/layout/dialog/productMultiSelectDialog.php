<script type="text/javascript">
var productMultiText = "";
var productMultiHi = "";
$().ready(function(){
    initProductMultiDialog();
});
function initProductMultiDialog()
{
    $(".ProductMultiDialog").dialog({
        height: 600,
        width:700,
        modal: true,
        autoOpen:false,
        title: "Chọn danh sách sản phẩm"
    });
}
function showProductMultiDialog(productId,textElement,hiddenElement)
{
     textElement = typeof textElement !== 'undefined' ? textElement : "productMulti";
     hiddenElement = typeof hiddenElement !== 'undefined' ? hiddenElement : "productMultiId";
   
    productMultiText = textElement;
    productMultiHi = hiddenElement;
    loadDefaultContentForProductMultiDialog(productId);
    $(".ProductMultiDialog").dialog("open");
}
function hideProductMultiDialog()
{
    $(".ProductMultiDialog").dialog("close");
}
function loadDefaultContentForProductMultiDialog(productId)
{
    $.ajax({
        url:'<?=$base_url;?>admin/dialogmanager/productMultiDialog/' + productId,
        dataType: "html",
        success : function(data){
            $(".ProductMultiDialog").html(data);
        
        }
    })
}
</script>
<div class="ProductMultiDialog">
    
</div>