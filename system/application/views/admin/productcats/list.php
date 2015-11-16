
<form name="myform" id="myform" method="post" >

<div id="portlets">
    <div class="column"> 
    </div>
    <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Tìm kiếm</div>
        <div class="portlet-content nopadding">
                <table class="table_input">
                        <tr>
                            <td><label for="name">Tên:</label></td>
                            <td><input type="text" name="searchName" value="<?=$searchKey;?>" class="smallInput medium" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="filter" /></td>
                        </tr>
                </table> 
        </div>
    </div>
</div>
 </form>
 
 
 <form name="frmList" id="frmList" method="post" action="<?=$base_url;?>admin/productcats/updatePosition" >
<div id="portlets">
<div class="column"> 
</div>
<div class="portlet">
<div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title;?></div>
<div class="portlet-content nopadding">
    <table width="100%" cellpadding="0" cellspacing="0" class="datatable" id="box-table-a" summary="Employee Pay Sheet">
        <input type="hidden" name="parentId" value="<?=$this->uri->segment(4);?>" />
		<thead>
			<tr>
            	<th width="32"><a href="#">ID</a></th>
                <td></td>
            	<th width="785">Tên danh mục</th>
            	<th width="196"><div align="left">Danh mục con</div></th>
                
                <th width="196"><div align="left">Sản phẩm</div></th>
                <th width="196"><div align="left">Số thuộc tính</div></th>
                
                <th width="135"><div align="center">Position</div></th>
                <th width="68"><div align="center">Action</div></th>
            </tr>
		</thead>
		<tbody>
        <?php 
        $count = 0;
        foreach($productcat as $row):
                $count++;    
        ?>
			<!--display menu parent content-->
                <tr style="cursor: pointer;" onclick="window.location.href = '<?=$this->admin_url.'productcats/edit/'.$row->id;?>'" >
                    <td class="a-center"><div align="center"><?php echo $count;?></div></td>
                    <td><img src="<?=image($row->image,'product_admin_list');?>" /> </td>
                    <td>
                        <a href="<?=$base_url;?>admin/productcats/listAll/<?=$row->id;?>"><?php echo $row->name;?></a>
                     </td>
                    <td><?=$row->childCount();?></td>
                    <td><a href="<?=$base_url;?>admin/products/listByParent/<?=$row->id;?>">Show(<?=$row->product->result_count();?>)</a></td>
                    <td width="196"><div align="left"><?=$row->productcatspec->result_count();?></div></td>
                    <td >
                        <input type="hidden" name="idList[]" value="<?=$row->id;?>" />
                        <div align="center"><input type="text" name="positionList[]" style="width: 40px;" value="<?=$row->position;?>" /></div>
                    </td>
                    <td><div align="center">
                    	<?php echo create_link_table('edit_icon',$base_url.'admin/productcats/edit/'.$row->id,'edit');
						echo create_link_table('delete_icon',$base_url.'admin/productcats/delete/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")');
						?>
                    	</div></td>
                </tr>
            <?php
                endforeach;
            ?>    
                 <tr>
                    
                    <td colspan="6"></td>
                    
                    <td>
                        <?php if(!$isSearch) { ?><div align="center"><input type="submit" name="update" value="Update" /></div><?php } ?>
                    </td>
                    <td></td>
                </tr>       
		</tbody>
	</table>
   
</div>
</div>
</div>
</form>

     