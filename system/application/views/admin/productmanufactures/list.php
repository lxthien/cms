
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
<div id="portlets">
<div class="column"> 
</div>
    <div class="portlet">
    <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title_table;?></div>
    <div class="portlet-content nopadding">
    <form name="myform" id="myform" method="post" >
    <table width="100%" cellpadding="0" cellspacing="0" class="datatable" id="box-table-a" summary="Employee Pay Sheet">
		<thead>
			<tr>
            	<th width="100"><a href="#">ID</a></th>
                <th>Logo</th>
            	<th width="600">Tên nhà sản xuất</th>
                <th width="400">Số lượng sản phẩm</th>
                <th width="400">Hiện ở bảng giá</th>
                
                <th width="68"><div align="center">Action</div></th>
            </tr>
		</thead>
		<tbody>
        <?php 
        $count=$this->uri->segment(5,0);
        foreach($productmanufactures->all as $row):
                $count++;
        ?>
			<!--display menu parent content-->
                <tr style="cursor: pointer;" onclick="window.location.href = '<?=$this->admin_url.'Productmanufactures/edit/'.$row->id;?>'" >
                    <td class="a-center"><div align="left"><?php echo $count;?></div></td>
                    <td><img src="<?=image($row->image,'product_admin_list');?>" /> </td>
                    <td><a href="<?=$base_url;?>admin/productmanufactures/edit/<?=$row->id;?>"><?php echo $row->name;?></a></td>
                    <td><?=$row->product->count()?> Sản phẩm</td>
                    <td><?php
                    if($row->isShow==1) 
                        echo create_link_table('approve_icon','#','Vô hiệu');
                    else
                        echo create_link_table('reject_icon','#','Kích hoạt');
                    ?></td>
                    
                    <td><div align="center">
                                    	<?php echo create_link_table('edit_icon',$base_url.'admin/Productmanufactures/edit/'.$row->id,'edit');
										echo create_link_table('delete_icon',$base_url.'admin/Productmanufactures/delete/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")');
										?>
                                    	</div></td>
                </tr>
          <?php
            endforeach;
          ?>
                <tr>
                    <td colspan="4" align="left"><?php echo create_link_table('delete_inline','javascript:void(0);','Xóa chọn','actionallinput("recycle","myform","'.$this->admin_url.'productmanufactures/delete","checkinput")','Delete all');?></td>
                    <td colspan="2" align="right"><?php echo $this->pagination->create_links();?></td>
                </tr>                
		</tbody>
	</table>
</form>
</div>
</div>
</div>
     