<div id="portlets">
<div class="column"> 
</div>
    <div class="portlet">
    <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title_table;?></div>
    <div class="portlet-content nopadding">
    <form name="myform" id="myform" method="post" >
    <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
		<thead>
			<tr>
            	<th width="3%"><a href="#">ID</a></th>
                <th width="8%"><div align="center" ><input type="checkbox" name="checkall" value="" id="checkall" onclick="checkallinput('checkall','checkinput')"/></div></th>
            	<th width="40%"><div align="left">Tên trạng thái</div></th>
                <th width="30%"><div align="left">Vị trí</div></th>
                <th width="20%"><div align="center">Action</div></th>
            </tr>
		</thead>
		<tbody>
        <?php 
        $count=$this->uri->segment(5,0);
        foreach($productstatus->all as $row):
                $count++;
        ?>
			<!--display menu parent content-->
                <tr>
                    <td class="a-center"><div align="left"><?php echo $count;?></div></td>
                    <td><div align="center"><input type="checkbox" class="checkinput" value="<?=$row->id?>" name="checkinput[]" /></div></td>
                    <td><a href="<?=$base_url;?>admin/productstatus/edit/<?=$row->id;?>"><?php echo $row->name;?></a></td>
                    <td>
                        <div align="left">
                        <?php echo create_link_table('up_icon',$base_url.'admin/productstatus/up_position/'.$row->id,'up');
                        echo create_link_table('down_icon',$base_url.'admin/productstatus/down_position/'.$row->id,'down');?>
                        </div>
                    </td>
                    <td><div align="center">
                    	<?php echo create_link_table('edit_icon',$base_url.'admin/productstatus/edit/'.$row->id,'edit');
						echo create_link_table('delete_icon',$base_url.'admin/productstatus/delete/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")');?>
                    </div></td>
                </tr>
          <?php
            endforeach;
          ?>
        <tr>
            <td colspan="3" align="left"><?php echo create_link_table('delete_inline','javascript:void(0);','Xóa chọn','actionallinput("recycle","myform","'.$this->admin_url.'productmanufactures/delete","checkinput")','Delete all');?></td>
            <td colspan="2" align="right"><?php echo $this->pagination->create_links();?></td>
        </tr>                
		</tbody>
	</table>
</form>
</div>
</div>
</div>
     