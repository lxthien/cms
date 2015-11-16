<script type="text/javascript">
$().ready(function(){
    $(".deleleProductSpec").live('click',function(e){
        
        e.preventDefault();
         if(e.handled === true) return false;
         e.handled = true;
         $(this).parents("tr.specItem").remove();
        return false;
    });
    $(".deleleAllProductSpec").live('click',function(e){
        e.preventDefault();
         if(e.handled === true) return false;
         e.handled = true;
        $(".specItem").remove();
        return false;
    });
});
function deleteProductSpec(id)
{
    $(".specItem_"+id).remove();
    $(".parent_"+id).remove();
}

</script>

<h2>Thông số kĩ thuật</h2>
<table class="table_input">
    <?php $k=0; $i=0; foreach($productSpec as $row):?>
                    <?php if($row->productgenspec->isGroup == 1) { ?>
                        <?php $rowId = $row->productgenspec->id;$i++;?>
            <tr class="specItem specItem_<?=$rowId;?>">
                <td><?=$i;?></td>
             	<td colspan="2" style="background: #ccc;"><label for="name"><?=$row->productgenspec->name;?>:</label>
                 <input type="hidden"  name="spec_<?=$row->productgenspec->id;?>" class="smallInput medium" value="" />
                 </td>
                
                <td><input name="position_<?=$row->productgenspec->id;?>" value="<?=$row->position;?>" style="width: 80px;"/></td>
                <td><a href="javascript:void(0)" onclick="javascript:deleteProductSpec(<?=$rowId;?>)">Xóa</a></td>
            </tr>
     <?php 
            foreach($allSpec as $spec):?>
            <?php if($spec->productgenspec->parentcat_id == $rowId) { $i++; ?>
                <tr class="specItem parent_<?=$rowId;?>">
                    <td><?=$i;?></td>
                 	<td>
            			<label for="name"><?=$spec->productgenspec->name;?>:</label></td>
                    <td>
                        <?php if($spec->productgenspec->type == "TEXTAREA"){?>
                            <textarea name="spec_<?=$spec->productgenspec->id;?>" class="smallInput medium" rows="5" ><?=$spec->value;?></textarea>
                        <?php } else { ?>
                            <input type="text"  name="spec_<?=$spec->productgenspec->id;?>" class="smallInput medium" value="<?=$spec->value;?>" />
                        <?php } ?>
                    </td>
                    <td><input name="position_<?=$spec->productgenspec->id;?>" class="specPosition<?=$i;?>" value="<?=$spec->position;?>" style="width: 80px;"/></td>
                    <td><a href="javascript:void(0)" class="deleleProductSpec">Xóa</a></td>
                </tr>        
     <?php } endforeach;?>  
                    <?php } ?>
    <?php endforeach;?>
    
    <tr>      
    	<th ></th>
        <th ></th>
        <th ></th>
        <th ><a href="javascript:void(0)" class="deleleAllProductSpec">Xóa hết</a></th>
    </tr>
</table>
