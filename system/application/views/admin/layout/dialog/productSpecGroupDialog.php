<script type="text/javascript">
var productSpecGroupText = "";
var productSpecGroupHi = "";
$().ready(function(){
    initProductSpecGroupDialog();
});
function initProductSpecGroupDialog()
{
    $(".productSpecGroupDialog").dialog({
        height: 600,
        width:700,
        modal: true,
        autoOpen:false,
        title: "Chọn nhóm thuộc tính sản phẩm"
    });
}
function showProductSpecGroupDialog(textElement,hiddenElement)
{
     textElement = typeof textElement !== 'undefined' ? textElement : "specGroupText";
     hiddenElement = typeof hiddenElement !== 'undefined' ? hiddenElement : "specGroupId";
   
    productSpecGroupText = textElement;
    productSpecGroupHi = hiddenElement;
    loadDefaultContentForProductSpecGroupDialog();
    $(".productSpecGroupDialog").dialog("open");
}
function hideProductSpecGroupDialog()
{
    $(".productSpecGroupDialog").dialog("close");
}
function loadDefaultContentForProductSpecGroupDialog()
{
    $.ajax({
        url:'<?=$base_url;?>admin/dialogmanager/productSpecGroupdialog',
        dataType: "html",
        success : function(data){
            $(".productSpecGroupDialog").html(data);
        }
    })
}
</script>
<div class="productSpecGroupDialog">
    
</div>