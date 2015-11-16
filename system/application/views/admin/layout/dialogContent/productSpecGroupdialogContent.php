<script type="text/javascript">
$().ready(function(){
    
});
function chooseSpecGroup(id,name)
{
    $("input[name='"+productSpecGroupText+"']").val(name);
    $("input[name='"+productSpecGroupHi+"']").val(id);
    hideProductSpecGroupDialog();
}
</script>
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
            	<th width="785">Tên nhóm</th>
                <th width="68"><div align="center">Action</div></th>
            </tr>
		</thead>
		<tbody>
        <?php 
        $count = 0;
        foreach($productGenSpec as $row):
                $count++;
                    
        ?>
        
			<!--display menu parent content-->
                <tr>
                    <td class="a-center"><div align="center"><?php echo $count;?></div></td>
                    <td>
                        <?php echo $row->name;?>
                     </td>                 
                    <td><div align="center">
                            <input type="button" onclick="javascript:chooseSpecGroup('<?=$row->id;?>','<?=$row->name;?>')" value="Chọn"/>
  
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
     