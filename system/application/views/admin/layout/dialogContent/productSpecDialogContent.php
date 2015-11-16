<script type="text/javascript">
$().ready(function(){
    
    $("#frmSpecSearch :input[name='searchName']").focus();
    var currentValue = $("#frmSpecSearch :input[name='searchName']").val();
    $("#frmSpecSearch :input[name='searchName']").val("");
    $("#frmSpecSearch :input[name='searchName']").val(currentValue);
    
    
    $("#frmSpecSearch input[name='filter']").click(function(){
        $.ajax({
           url:  '<?=$base_url;?>admin/dialogmanager/productSpecDialog',
           type: "POST",
           dataType: "html",
           data: $("#frmSpecSearch").serialize(),
           success:function(data){
                $(".ProductSpecDialog").html(data);
           }
        });
    })  ; 
    
    
    $('#frmSpecSearch :input').keypress( function(e) {
         var code = (e.keyCode ? e.keyCode : e.which);
		 if(code == 13) { //enter press
               $.ajax({
                   url:  '<?=$base_url;?>admin/dialogmanager/productSpecDialog',
                   type: "POST",
                   dataType: "html",
                   data: $("#frmSpecSearch").serialize(),
                   success:function(data){
                        $(".ProductSpecDialog").html(data);
                   }
                });
               return false;
		 }
        
   }); 
});
function chooseSpec(id,name)
{
    $("input[name='"+productSpecText+"']").val(name);
    $("input[name='"+productSpecHi+"']").val(id);
    hideProductSpecDialog();
}
function deleteSpec(id)
{
    if(confirm("Bạn có muốn xóa?"))
    {
        $.ajax({
           url:  '<?=$base_url;?>admin/dialogmanager/deleteProductGenSpec/'+id,
           type: "GET",
           dataType: "html",
           success:function(data){
               loadDefaultContentForProductSpecDialog();
           }
        });
    }
}
</script>

<form name="searchSpecForm" id="frmSpecSearch" method="post" >

<div id="portlets">
    <div class="column"> 
    </div>
    <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Tìm kiếm</div>
        <div class="portlet-content nopadding">
                <table class="table_input">
                        <tr>
                            <td><label for="name">Tên:</label></td>
                            <td><input type="text" name="searchName" value="<?=$searchKey;?>" class="smallInput medium enterDisable"  /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="button" name="filter" value="filter" /></td>
                        </tr>
                </table>
                 <div style="text-align: center;"><a href="javascript:void(0)" onclick="productDialog_addGenSpec()" style="text-align: center;">Thêm thuộc tính mới</a></div>
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
            	<th width="785">Tên</th>
                <th width="785">Nhóm cha</th>
            	<th width="196"><div align="left">Loại</div></th>
                
                <th width="68"><div align="center">Chọn</div></th>
                 <th width="68"><div align="center">Xóa</div></th>
            </tr>
		</thead>
		<tbody>
        <?php 
        $count = 0;
        foreach($Spec as $row):
                $count++;    
        ?>
			<!--display menu parent content-->
                <tr>
                    <td class="a-center"><div align="center"><?php echo $count;?></div></td>
                    <td>
                        <a href="javascript:void(0)" onclick="productDialog_editGenSpec(<?=$row->id;?>)"><?php echo $row->name;?></a>
                     </td>
                     <td>
                        <?php 
                            $parent = new productgenspec($row->parentcat_id);
                            if($parent->exists())
                            {
                                echo $parent->name;
                            }
                        ?>
                     </td>
                    <td><?php if($row->isGroup == "1") echo "Nhóm"; else echo "Thuộc tính";?></td>
                    
                    <td><div align="center">
                            <input type="button" onclick="javascript:chooseSpec('<?=$row->id;?>','<?=$row->name;?>')" value="Chọn"/>
  
                   	</div></td>
                    <td><div align="center">
                            <input type="button" onclick="javascript:deleteSpec('<?=$row->id;?>')" value="Xóa"/>
  
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
     