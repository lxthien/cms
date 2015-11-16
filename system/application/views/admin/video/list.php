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
                            	<th width="5%"><center>ID</center></th>
								<th width="20%"><center>Hình ảnh</center></th>
                            	<th>Tiêu đề</th>
								<th width="15%"><center>Vị trí</center></th>
                                <th width="15%"><center>Công cụ</center></th>
                            </tr>
						</thead>
						<tbody>
                        <?php $i=0; foreach($video->all as $row):$i++;?>
								
								
                                    <tr>
                                        <td class="a-center"><div align="center"><?php echo $i;?></div></td>
										<?php $img = $row->link_imgs != '' ? filenameplus($row->link_imgs,'thump') : 'images/default_video.png'; ?>
										<td class="a-center"><center><img src="<?=$img;?>" width="100" /><center></td>
                                        <td><a href="<?=$base_url.'admin/videos/edit/'.$row->id;?>"><?php echo $row->name;?></a></td>
                                      
                                        <td>
														<div align="center">
															<?php echo create_link_table('up_icon',$base_url.'admin/videos/up_position/'.$row->id,'up');
																echo create_link_table('down_icon',$base_url.'admin/videos/down_position/'.$row->id,'up');?>
                                                           </div>                                        
                                        </td>
                                        <td><div align="center">
                                                        	<?php echo create_link_table('edit_icon',$base_url.'admin/videos/edit/'.$row->id,'edit');
																echo create_link_table('delete_icon',$base_url.'admin/videos/delete/'.$row->id,'delete');
															
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
     