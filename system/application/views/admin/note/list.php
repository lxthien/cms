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
                            	<th width="36"><a href="#">ID</a></th>
                            	<th width="884">Note name</th>
                            	<th width="211">Đời</th>
                            
                                <th width="124"><div align="center">Position</div></th>
                                <th width="77"><div align="center">Action</div></th>
                            </tr>
						</thead>
						<tbody>
                        <?php $i=0; foreach($childNote as $row):$i++;?>
                                    <tr>
                                        <td class="a-center"><div align="center"><?php echo $i;?></div></td>
                                        <td><a href="<?=$this->admin_url;?>notes/show/<?=$row->id;?>"><?php echo $row->name;?></a></td>
                                      	<td><span style="color:red">Đời thứ <?=$row->level;?></span></td>
                                        <td>
														<div align="center">
															<?php echo create_link_table('up_icon',$base_url.'admin/notes/up_position/'.$row->id,'up');
																echo create_link_table('down_icon',$base_url.'admin/notes/down_position/'.$row->id,'up');?>
                                                           </div>                                        
                                        </td>
                                        <td><div align="center">
                                                        	<?php echo create_link_table('edit_icon',$base_url.'admin/notes/edit/'.$row->parentnote_id.'/'.$row->id,'edit');
															    if($row->id != 1)
																{
																	echo create_link_table('delete_icon',$base_url.'admin/notes/delete/'.$row->id,'delete');
																}
															?>
                                                        	</div></td>
                                    </tr>
						        
                                  <?php    endforeach;?>
                                            
						</tbody>
					</table>
       </form>
       </div>
       </div>
       </div>
     