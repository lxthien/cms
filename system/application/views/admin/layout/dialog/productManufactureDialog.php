<script type="text/javascript">
var productManufactureText = "";
var productManufactureHi = "";
$().ready(function(){
    initProductManufactureDialog();
});
function initProductManufactureDialog()
{
    $(".productManufactureDialog").dialog({
        height: 600,
        width:700,
        modal: true,
        autoOpen:false,
        title: "Danh sách nhà sản xuất"
    });
}
function showProductManufactureDialog(textElement,hiddenElement)
{
     textElement = typeof textElement !== 'undefined' ? textElement : "productManufacture";
     hiddenElement = typeof hiddenElement !== 'undefined' ? hiddenElement : "productManufactureId";
   
    productManufactureText = textElement;
    productManufactureHi = hiddenElement;
    loadDefaultContentForProductManufactureDialog();
    $(".productManufactureDialog").dialog("open");
}
function hideProductManufactureDialog()
{
    $(".productManufactureDialog").dialog("close");
}
function loadDefaultContentForProductManufactureDialog()
{
    $.ajax({
        url:'<?=$base_url;?>admin/dialogmanager/productManufactureDialog',
        dataType: "html",
        success : function(data){
            $(".productManufactureDialog").html(data);
        }
    })
}
</script>
<div class="productManufactureDialog">
    
</div>