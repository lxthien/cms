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
                            	<th width="69"><a href="#">ID</a></th>
                            	<th width="1443">Menu name</th>
                            
                            
                                <th width="249"><div align="center">Position</div></th>
                                <th width="127"><div align="center">Action</div></th>
                            </tr>
						</thead>
						<tbody>
                        <?php $i=0; foreach($bannercat->all as $row):$i++;?>
								
								
                                    <tr>
                                        <td class="a-center"><div align="center"><?php echo $i;?></div></td>
                                        <td><a href="<?=$this->admin_url;?>bannercats/list_image/<?=$row->id;?>"><?php echo $row->name;?></a></td>
                                      
                                        <td>
														<div align="center">
															<?php echo create_link_table('up_icon',$base_url.'admin/bannercats/up_position/'.$row->id,'up');
																echo create_link_table('down_icon',$base_url.'admin/bannercats/down_position/'.$row->id,'up');?>
                                                           </div>                                        
                                        </td>
                                        <td><div align="center">
                                                        	
                                                        	</div></td>
                                    </tr>
						        
                                  <?php    endforeach;?>
                                            
						</tbody>
					</table>
       </form>
       </div>
       </div>
       </div>
     