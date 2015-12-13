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
                            	<th width="32"><a href="#">ID</a></th>
                            	<th width="785">Menu name</th>
                            	<th width="56"><div align="left">G</div></th>
                            	<th width="196"><div align="left">Số lượng tin</div></th>
                                <th width="135"><div align="center">Position</div></th>
                                <th width="68"><div align="center">Action</div></th>
                            </tr>
						</thead>
						<tbody>
                        <?php $i=0; foreach($newscatalogue->all as $row):
								if(!$row->parentcat->exists()) { $i++; ?>
								<!--display menu parent content-->
                                    <tr>
                                        <td class="a-center"><div align="center"><?php echo $i;?></div></td>
                                        <td><a href="<?=$this->admin_url;?>newscatalogues/edit/<?=$row->id;?>"><?php echo $row->name_vietnamese;?></a></td>
                                        <td><?=$row->group;?></td>
                                        <td>&nbsp;</td>
                                        <td>
														<div align="center">
															<?php echo create_link_table('up_icon',$base_url.'admin/newscatalogues/up_position/'.$row->id,'up');
																echo create_link_table('down_icon',$base_url.'admin/newscatalogues/down_position/'.$row->id,'up');?>
                                                           </div>                                        
                                        </td>
                                        <td><div align="center">
                                                        	<?php echo create_link_table('edit_icon',$base_url.'admin/newscatalogues/edit/'.$row->id,'edit');
															echo create_link_table('delete_icon',$base_url.'admin/newscatalogues/delete/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")');
															?>
                                                        	</div></td>
                                    </tr>
						         <?php 
								 foreach ($row->child->order_by('position','asc')->get() as $row_sub): 
								 			$i++; ?>
                                            	  <tr>
                                                        <td class="a-center"><div align="center"><?php echo $i;?></div></td>
                                                        <td><a href="<?=$this->admin_url;?>newscatalogues/edit/<?=$row_sub->id;?>">:..........<?php echo $row_sub->name_vietnamese;?></a></td>
                                                        <td><?=$row_sub->group;?></td>
                                                        <td><a href="<?=$this->admin_url;?>cnews/list_by_cat/<?=$row_sub->id;?>" ><?=$row_sub->article->where('recycle',0)->count();?> Tin</a></td>
                                                        <td><div align="center">
															<?php echo create_link_table('up_icon',$base_url.'admin/newscatalogues/up_position/'.$row_sub->id,'up');
																echo create_link_table('down_icon',$base_url.'admin/newscatalogues/down_position/'.$row_sub->id,'up');?>
                                                           </div>    </td>
                                                        <td>
                                                        	<div align="center">
                                                        	<?php echo create_link_table('edit_icon',$base_url.'admin/newscatalogues/edit/'.$row_sub->id,'edit');
															echo create_link_table('delete_icon',$base_url.'admin/newscatalogues/delete/'.$row_sub->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")');
															?>
                                                        	</div>
                                                        </td>
                          </tr>
                                  <?php  endforeach; } endforeach;?>
                                            
						</tbody>
					</table>
       </form>
       </div>
       </div>
       </div>
     