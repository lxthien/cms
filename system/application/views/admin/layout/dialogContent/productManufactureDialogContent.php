<script type="text/javascript">
$().ready(function(){
    
    $("#frmManufactureSearch :input[name='searchName']").focus();
    var currentValue = $("#frmManufactureSearch :input[name='searchName']").val();
    $("#frmManufactureSearch :input[name='searchName']").val("");
    $("#frmManufactureSearch :input[name='searchName']").val(currentValue);
    
    $("#frmManufactureSearch input[name='filter']").click(function(){
        $.ajax({
           url:  '<?=$base_url;?>admin/dialogmanager/productManufactureDialog',
           type: "POST",
           dataType: "html",
           data: $("#frmManufactureSearch").serialize(),
           success:function(data){
                $(".productManufactureDialog").html(data);
           }
        });
    }) ; 
    
    
    $('#frmManufactureSearch :input').keypress( function(e) {
         var code = (e.keyCode ? e.keyCode : e.which);
		 if(code == 13) { //enter press
              $.ajax({
                   url:  '<?=$base_url;?>admin/dialogmanager/productManufactureDialog',
                   type: "POST",
                   dataType: "html",
                   data: $("#frmManufactureSearch").serialize(),
                   success:function(data){
                        $(".productManufactureDialog").html(data);
                   }
                });
               return false;
		 }
        
   }); 
});
function chooseManufacture(id,name)
{
    $("input[name='"+productManufactureText +"']").val(name);
    $("input[name='"+productManufactureHi +"']").val(id);
    hideProductManufactureDialog();
}
</script>

<form name="searchManufacture" id="frmManufactureSearch" method="post" >

<div id="portlets">
    <div class="column"> 
    </div>
    <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Tìm kiếm</div>
        <div class="portlet-content nopadding">
                <table class="table_input">
                        <tr>
                            <td><label for="name">Tên:</label></td>
                            <td><input type="text" name="searchName" value="<?=$searchKey;?>" class="smallInput medium enterDisable" /></td>
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
                <th width="196"><div align="left">Số sản phẩm</div></th>
            
                
                <th width="68"><div align="center">Action</div></th>
            </tr>
		</thead>
		<tbody>
        <?php 
        $count = 0;
        foreach($manufacture as $row):
                $count++;    
        ?>
			<!--display menu parent content-->
                <tr>
                    <td class="a-center"><div align="center"><?php echo $count;?></div></td>
                    <td>
                        <?php echo $row->name;?>
                     </td>
                     <td>
                        <?php echo $row->product->result_count();?>
                     </td>
                    
                    
                    <td><div align="center">
                            <input type="button" onclick="javascript:chooseManufacture('<?=$row->id;?>','<?=$row->name;?>')" value="Chọn"/>
  
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
     