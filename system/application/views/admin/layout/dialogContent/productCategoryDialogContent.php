<script type="text/javascript">
$().ready(function(){
    $("#frmSearch :input[name='searchName']").focus();
    var currentValue = $("#frmSearch :input[name='searchName']").val();
    $("#frmSearch :input[name='searchName']").val("");
    $("#frmSearch :input[name='searchName']").val(currentValue);
    
    $("#frmSearch input[name='filter']").click(function(){
        $.ajax({
           url:  '<?=$base_url;?>admin/dialogmanager/productCatDialog',
           type: "POST",
           dataType: "html",
           data: $("#frmSearch").serialize(),
           success:function(data){
                $(".productCategoryDialog").html(data);
           }
        });
    }); 
    
    
    $('#frmSearch :input').keypress( function(e) {
         var code = (e.keyCode ? e.keyCode : e.which);
		 if(code == 13) { //enter press
              $.ajax({
                   url:  '<?=$base_url;?>admin/dialogmanager/productCatDialog',
                   type: "POST",
                   dataType: "html",
                   data: $("#frmSearch").serialize(),
                   success:function(data){
                        var name = $(this).attr('name');
                        $(".productCategoryDialog").html(data);
                        
                   }
              });  
               return false;
		 }
        
   });
});
function chooseCategory(id,name)
{
    $("input[name='"+productCatText+"']").val(name);
    $("input[name='"+productCatHi+"']").val(id);
    hideProductCategoryDialog();
}
</script>

<form name="searchForm" id="frmSearch" method="post" >

<div id="portlets">
    <div class="column"> 
    </div>
    <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Tìm kiếm</div>
        <div class="portlet-content nopadding">
                <table class="table_input">
                        <tr>
                            <td><label for="name">Tên:</label></td>
                            <td><input type="text" id="productCategorySearchName" name="searchName" value="<?=$searchKey;?>" class="smallInput medium enterDisable" /></td>
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
    <form name="myform" id="myform" method="post" >
    <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
		<thead>
			<tr>
            	<th width="32"><a href="#">ID</a></th>
            	<th width="785">name</th>
                <th width="785">Danh mục cha</th>
                
            	<th width="196"><div align="left">Số danh mục con</div></th>
                
               
            </tr>
		</thead>
		<tbody>
        <?php 
        $count = 0;
        foreach($category as $row):
                $count++;    
        ?>
			<!--display menu parent content-->
                <tr onclick="javascript:chooseCategory('<?=$row->id;?>','<?=$row->name;?>')" style="cursor: pointer;">
                    <td class="a-center"><div align="center"><?php echo $count;?></div></td>
                    <td>
                        <?php echo $row->name;?>(số sp:<?=$row->product->result_count();?>)
                     </td>
                     <td><?=$row->parentcat->name;?></td>
                     
                    <td><?=$row->childCount();?></td>
                    
                    
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
     