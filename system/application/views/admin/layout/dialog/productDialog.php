<script type="text/javascript">
var productText = "";
var productHi = "";
$().ready(function(){
    initProductDialog();
});
function initProductDialog()
{
    $(".ProductDialog").dialog({
        height: 600,
        width:700,
        modal: true,
        autoOpen:false,
        title: "Chọn sản phẩm"
    });
}
function showProductDialog(textElement,hiddenElement)
{
     textElement = typeof textElement !== 'undefined' ? textElement : "product";
     hiddenElement = typeof hiddenElement !== 'undefined' ? hiddenElement : "productId";
   
    productText = textElement;
    productHi = hiddenElement;
    loadDefaultContentForProductDialog();
    $(".ProductDialog").dialog("open");
}
function hideProductDialog()
{
    $(".ProductDialog").dialog("close");
}
function loadDefaultContentForProductDialog()
{
    $.ajax({
        url:'<?=$base_url;?>admin/dialogmanager/productDialog',
        dataType: "html",
        success : function(data){
            $(".ProductDialog").html(data);
        
        }
    })
}
</script>
<div class="ProductDialog">
    
</div>