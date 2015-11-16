<script type="text/javascript">
$().ready(function(){
    
    
    $("#productMultiSearchDialog :input[name='searchName']").focus();
    var currentValue = $("#frmSearch :input[name='searchName']").val();
    $("#productMultiSearchDialog :input[name='searchName']").val("");
    $("#productMultiSearchDialog :input[name='searchName']").val(currentValue);
    
    
    
    $("#productMultiSearchDialog :input[name='filter']").click(function(){
        $.ajax({
           url:  '<?=$base_url;?>admin/dialogmanager/productMultiDialog/<?=$chooseProduct->id;?>',
           type: "POST",
           dataType: "html",
           data: $("#productMultiSearchDialog").serialize(),
           success:function(data){
                $(".ProductMultiDialog").html(data);
           }
        });
    })  ; 
    
    
    $('#productMultiSearchDialog :input').keypress( function(e) {
         var code = (e.keyCode ? e.keyCode : e.which);
		 if(code == 13) { //enter press
               $.ajax({
                   url:  '<?=$base_url;?>admin/dialogmanager/productMultiDialog/<?=$chooseProduct->id;?>',
                   type: "POST",
                   dataType: "html",
                   data: $("#productMultiSearchDialog").serialize(),
                   success:function(data){
                        $(".ProductMultiDialog").html(data);
                   }
                });
               return false;
		 }
        
   });
    
    
    
    
    $(".chooseProductCategoryFromProductDialog").click(function(){
        showProductCategoryDialog("searchProductCat","searchProductCatId");
   });
   $(".clearProductCategoryFromProductDialog").click(function(){
        $("input[name='searchProductCat']").val("");
        $("input[name='searchProductCatId']").val("");
   });
   $(":input[name='productCheckAll']").click(function(){
        if($(this).prop("checked"))
            $(":input[name='productCheck[]']").attr("checked",true);
        else
            $(":input[name='productCheck[]']").attr("checked",false);
   });
   $(":input[name='productCheck[]']").each(function(){
        $(this).click(function(){
            if($(this).prop("checked") == false)
            {
                     $(":input[name='productCheckAll']").attr("checked",false);
            }
            else
            {
                var check = true;
                $(":input[name='productCheck[]']").each(function(){
                    if($(this).prop("checked") == false) check = false;   
                });
                if(check == true)
                {
                    $(":input[name='productCheckAll']").attr("checked","checked");
                }
            }
        
         }); 
   });
});
function chooseProduct(id,name)
{
    $("input[name='"+productText+"']").val(name);
    $("input[name='"+productHi+"']").val(id);
    hideProductDialog();
}
</script>

<form name="searchForm" id="productMultiSearchDialog" method="post" >

<div id="portlets">
    <div class="column"> 
    </div>
    <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Tìm kiếm</div>
        <div class="portlet-content nopadding">
                <table class="table_input">
                        <tr>
                            <td><label for="name">Tên:</label></td>
                            <td><input type="text" id="multiProductSearchKey" name="searchName" value="<?=$searchKey;?>" class="smallInput medium" /></td>
                        </tr>
                        <tr>
                            <td><label for="name">Danh mục:</label></td>
                            <td>
                                <input type="text" readonly="readonly" name="searchProductCat" class="smallInput" value="<?=$searchProductCat;?>" style="float:left;width: 243px;" />
                                <input type="hidden" name="searchProductCatId" value="<?=$searchProductCatId;?>"  />
                                <a href="javascript:void(0)" style="margin-left: 10px;" class="chooseProductCategoryFromProductDialog" >Chọn</a> |
                                <a href="javascript:void(0)" class="clearProductCategoryFromProductDialog" > Xóa</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="button" name="filter" value="filter" /></td>
                        </tr>
                </table> 
        </div>
    </div>
</div>
 </form>

<div id="portlets">
<div class="column"> 
</div>
<div class="portlet">
<div class="portlet-content nopadding">
    <form  method="post" id="productMultiSelect" >
    <input type="button" onclick="javascript:chooseMultiProduct('<?=$chooseProduct->id;?>')" value="Thêm sản phẩm đã chọn"/>
    <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
		<thead>
			<tr>
            	<th width="32"><a href="#">ID</a></th>
                <th><input type="checkbox" value="" name="productCheckAll" />
                    
                </th>
            	<th width="785">Tên</th>
                <th width="196"><div align="left">Danh mục</div></th>
                
            </tr>
		</thead>
		<tbody>
        <?php 
        $count = 0;
        foreach($product as $row):
                $count++;    
        ?>
			<!--display menu parent content-->
                <tr>
                    <td class="a-center"><div align="center"><?php echo $count;?></div></td>
                    <td><input type="checkbox" value="<?=$row->id;?>" name="productCheck[]" /></td>
                    <td>
                        <?php echo $row->name;?>
                     </td>
                     <td>
                        <?php echo $row->productcat->name;?>
                     </td>
                    
                </tr>
            <?php
                endforeach;
            ?>                
		</tbody>
	</table>
    </form>
</div>
</div>
</div>
     