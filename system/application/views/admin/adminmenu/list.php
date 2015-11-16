<div id="portlets">
<div class="column"> 
</div>
 <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title;?></div>
		<div class="portlet-content nopadding">
<form name="myform" id="myform" method="post" >
<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
						<thead>
							<tr>
                            	<th width="57"><a href="#">ID<img src="<?=$admin_resource;?>img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
                                 <th width="49"><div align="center"><input type="checkbox" name="checkall" value="" id="checkall" onclick="checkallinput('checkall','checkinput')"></div></th>
                            	<th width="746">Menu name</th>
                                <th width="276"><div align="center">Position</div></th>
                                <th width="120"><div align="center">Action</div></th>
                            </tr>
						</thead>
						<tbody>
                        <?php $i=0; foreach($adminmenu->all as $row_menu):
								if(!$row_menu->parentmenu->exists()) { $i++; ?>
								<!--display menu parent content-->
                                    <tr>
                                        <td class="a-center"><div align="center"><?php echo $i;?></div></td>
                                         <td><div align="center"><input type="checkbox" class="checkinput" value="<?=$row_menu->id?>" name="checkinput[]" ></div></td>
                                        <td><img src="<?=$base_url;?><?=$row_menu->icon;?>" /><a href="<?=$base_url;?>admin/adminmenus/edit/<?=$row_menu->id;?>"><?php echo $row_menu->name;?></a></td>
                                        <td>
														<div align="center">
															<?php echo create_link_table('up_icon',$base_url.'admin/adminmenus/up_position/'.$row_menu->id,'up');
																echo create_link_table('down_icon',$base_url.'admin/adminmenus/down_position/'.$row_menu->id,'up');?>
                                                           </div>                                        
                                        </td>
                                        <td><div align="center">
                                                        	<?php echo create_link_table('edit_icon',$base_url.'admin/adminmenus/edit/'.$row_menu->id,'edit');
															echo create_link_table('delete_icon',$base_url.'admin/adminmenus/delete/'.$row_menu->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")');
															?>
                                                        	</div></td>
                                    </tr>
						         <?php 
								 foreach ($row_menu->child->order_by('position','asc')->get() as $row_submenu): 
								 			$i++; ?>
                                            	  <tr>
                                                        <td class="a-center"><div align="center"><?php echo $i;?></div></td>
                                                         <td><div align="center"><input type="checkbox" class="checkinput" value="<?=$row_submenu->id?>" name="checkinput[]" ></div></td>
                                                        <td><a href="<?=$base_url;?>admin/adminmenus/edit/<?=$row_submenu->id;?>">:...........<img src="<?=$base_url;?><?=$row_submenu->icon;?>" /><?php echo $row_submenu->name;?></a></td>
                                                        <td><div align="center">
															<?php echo create_link_table('up_icon',$base_url.'admin/adminmenus/up_position/'.$row_submenu->id,'up');
																echo create_link_table('down_icon',$base_url.'admin/adminmenus/down_position/'.$row_submenu->id,'up');?>
                                                           </div>    </td>
                                                        <td>
                                                        	<div align="center">
                                                        	<?php echo create_link_table('edit_icon',$base_url.'admin/adminmenus/edit/'.$row_submenu->id,'edit');
															echo create_link_table('delete_icon',$base_url.'admin/adminmenus/delete/'.$row_submenu->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")');
															?>
                                                        	</div>
                                                        </td>
                          </tr>
                                  <?php  endforeach; } endforeach;?>
                                <tr class="footer">
                                    <td colspan="5">
                                   <?php echo create_link_table('delete_inline','javascript:void(0)','Xóa chọn','deleteallinput("myform","'.$this->admin_url.'adminmenus/deleteall")','Delete all');?>
          </td>
                                   
                                  
        </tr>            
						</tbody>
					</table>
       </form>
       </div>
       </div>
       </div>
     