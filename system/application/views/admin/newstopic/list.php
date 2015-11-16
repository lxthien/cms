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
                            	<th width="40"><a href="#">ID<img src="<?=$admin_resource;?>img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
                            	<th width="501">Menu name</th>
                                <th width="82"><div align="center">Action</div></th>
                            </tr>
						</thead>
						<tbody>
                        <?php $i=0; foreach($newstopic->all as $row):
								$i++; ?>
								<!--display menu parent content-->
                                    <tr>
                                        <td class="a-center"><div align="center"><?php echo $i;?></div></td>
                                        <td><a href="<?=$this->admin_url;?>newstopics/edit/<?=$row->id;?>"><?php echo $row->name;?></a></td>
                                        <td><div align="center">
                                                        	<?php echo create_link_table('edit_icon',$base_url.'admin/newstopics/edit/'.$row->id,'edit');
															echo create_link_table('delete_icon',$base_url.'admin/newstopics/delete/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")');
															?>
                                                        	</div></td>
                                    </tr>
						    
                                  <?php  endforeach;?>
                                            
						</tbody>
					</table>
       </form>
       </div>
       </div>
       </div>
     