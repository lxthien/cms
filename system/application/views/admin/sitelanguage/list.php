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
                            	<th width="849"><div align="left">language</div></th>
                            	<th width="283"><div align="center">short</div></th>
                                <th width="95"><div align="center">Action</div></th>
                            </tr>
						</thead>
						<tbody>
						  <!--display menu parent content-->
                          <?php $i=0; foreach($sitelanguage as $row_role): $i++;?>
                                  <tr>
                                        <td class="a-center"><?php echo $i;?></td>
                                        <td><a href="<?=$base_url;?>admin/sitelanguages/edit/<?=$row_role->id;?>">............<?php echo $row_role->name;?></a></td>
                                        <td><div align="center">
                                        <?=$row_role->short;?>
                                        </div></td>
                                        <td>
                                        <div align="center">
										<?php 
                                                echo create_link_table('edit_icon',$base_url.'admin/sitelanguages/edit/'.$row_role->id,'Edit language');
                                                echo create_link_table('delete_icon',$base_url.'admin/sitelanguages/delete/'.$row_role->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")'); ?></div>		
                                                </td>
                                  </tr>
						     
                          <?php  endforeach;?>
                                            
						</tbody>
					</table>
 </form>
 </div>
 </div>
 </div>
                    
                    
     