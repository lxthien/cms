<script type="text/javascript">
var productCatText = "";
var productCatHi = "";
$().ready(function(){
    initProductCategoryDialog();
});
function initProductCategoryDialog()
{
    $(".productCategoryDialog").dialog({
        height: 600,
        width:700,
        modal: true,
        autoOpen:false,
        title: "Chọn danh mục sản phẩm cha"
    });
}
function showProductCategoryDialog(textElement,hiddenElement)
{
     textElement = typeof textElement !== 'undefined' ? textElement : "productCategory";
     hiddenElement = typeof hiddenElement !== 'undefined' ? hiddenElement : "productCategoryId";
   
    productCatText = textElement;
    productCatHi = hiddenElement;
    loadDefaultContentForProductCategoryDialog();
    $(".productCategoryDialog").dialog("open");
}
function hideProductCategoryDialog()
{
    $(".productCategoryDialog").dialog("close");
}
function loadDefaultContentForProductCategoryDialog()
{
    $.ajax({
        url:'<?=$base_url;?>admin/dialogmanager/productCatDialog',
        dataType: "html",
        success : function(data){
            $(".productCategoryDialog").html(data);
        
        }
    })
}
</script>
<div class="productCategoryDialog">
    
</div>