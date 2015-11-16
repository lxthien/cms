<script type="text/javascript">
$().ready(function(){
    $("#productSearchDialog :input[name='searchName']").focus();
    var currentValue = $("#productSearchDialog :input[name='searchName']").val();
    $("#productSearchDialog :input[name='searchName']").val("");
    $("#productSearchDialog :input[name='searchName']").val(currentValue);
    
    
    
    $("#productSearchDialog :input[name='filter']").click(function(){
        $.ajax({
           url:  '<?=$base_url;?>admin/dialogmanager/productDialog',
           type: "POST",
           dataType: "html",
           data: $("#productSearchDialog").serialize(),
           success:function(data){
                $(".ProductDialog").html(data);
           }
        });
    }) ; 
   $('#productSearchDialog :input').keypress( function(e) {
         var code = (e.keyCode ? e.keyCode : e.which);
		 if(code == 13) { //enter press
              $.ajax({
                   url:  '<?=$base_url;?>admin/dialogmanager/productDialog',
                   type: "POST",
                   dataType: "html",
                   data: $("#productSearchDialog").serialize(),
                   success:function(data){
                        $(".ProductDialog").html(data);
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
});
function chooseProduct(id,name)
{
    $("input[name='"+productText+"']").val(name);
    $("input[name='"+productHi+"']").val(id);
    hideProductDialog();
}
</script>

<form name="searchForm" id="productSearchDialog" method="post" >

<div id="portlets">
    <div class="column"> 
    </div>
    <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Tìm kiếm</div>
        <div class="portlet-content nopadding">
                <table class="table_input">
                        <tr>
                            <td><label for="name">Tên:</label></td>
                            <td><input type="text" name="searchName" id="productSearchKey" value="<?=$searchKey;?>" class="smallInput medium enterDisable" /></td>
                        </tr>
                        <tr>
                            <td><label for="name">Danh mục:</label></td>
                            <td>
                                <input type="text" readonly="readonly" name="searchProductCat" class="smallInput" value="<?=$searchProductCat;?>" style="float:left;width: 243px;" />
                                <input type="hidden" name="searchProductCatId" value="<?=$searchProductCatId;?>"  />
                                <a href="javascript:void(0)" class="chooseProductCategoryFromProductDialog" >Chọn</a> |
                                <a href="javascript:void(0)" class="clearProductCategoryFromProductDialog" >Xóa</a>
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
    <form  method="post" >
    <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
		<thead>
			<tr>
            	<th width="32"><a href="#">ID</a></th>
            	<th width="785">Tên</th>
                <th width="196"><div align="left">Danh mục</div></th>
            	
                
                <th width="68"><div align="center">Action</div></th>
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
                    <td>
                        <?php echo $row->name;?>
                     </td>
                     <td>
                        <?php echo $row->productcat->name;?>
                     </td>
                    <td><div align="center">
                            <input type="button" onclick="javascript:chooseProduct('<?=$row->id;?>','<?=$row->name;?>')" value="Chọn"/>
                   	</div></td>
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
     