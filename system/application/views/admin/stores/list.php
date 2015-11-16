<div id="portlets">
<div class="column"> 
</div>
 <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title;?></div>
		<div class="portlet-content nopadding">
<form name="myform" id="myform" method="post" >
<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
						<thead>
							<tr>
                            	<th width="45">ID<img src="<?=$admin_resource;?>img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></th>
                            	<th width="849"><div align="left">Tên cửa hàng</div></th>
                                <th width="849"><div align="left">Địa chỉ</div></th>
                            	
                                <th width="95"><div align="center">Action</div></th>
                            </tr>
						</thead>
						<tbody>
						  <!--display menu parent content-->
                          <?php $i=0; foreach($store as $row): $i++;?>
                                  <tr style="cursor: pointer;" onclick="window.location.href = '<?=$this->admin_url.'stores/edit/'.$row->id;?>'">
                                        <td class="a-center"><?php echo $i;?></td>
                                        <td><a href="<?=$base_url;?>admin/stores/edit/<?=$row->id;?>"><?php echo $row->name;?></a></td>
                                        <td><?=$row->address;?></td>
                                        <td>
                                        <div align="center">
										<?php 
                                                echo create_link_table('edit_icon',$base_url.'admin/stores/edit/'.$row->id,'Edit Product');
                                                echo create_link_table('delete_icon',$base_url.'admin/stores/delete/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")'); ?></div>		
                                                </td>
                                  </tr>
						     
                          <?php  endforeach;?>
                                            
						</tbody>
					</table>
 </form>
 </div>
 </div>
 </div>
                    
                    
     