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
                            	<th width="44">ID<img src="<?=$admin_resource;?>img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></th>
                            	<th width="859"><div align="left">Username</div></th>
                            	<th width="235"><div align="center">Usergroup</div></th>
                                <th width="92"><div align="center">Action</div></th>
                            </tr>
						</thead>
						<tbody>
						  <!--display menu parent content-->
                          <?php $i=0; foreach($adminuser as $row): ?>
                          <?php if($row->adminrole_id!=1) { $i++; ?>
                                  <tr>
                                        <td class="a-center"><?php echo $i;?></td>
                                        <td><a href="<?=$this->admin_url;?>adminusers/edit/<?=$row->id;?>">&rarr;<?php echo $row->username;?></a></td>
                                        <td><div align="center"><?=$row->adminrole->name;?></div></td>
                                        <td><div align="center">
                                       <?php 
															echo create_link_table('edit_icon',$this->admin_url.'adminusers/edit/'.$row->id,'Edit Product');
															echo create_link_table('delete_icon',$this->admin_url.'adminusers/delete/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")'); ?>
                                        </div></td>
                                  </tr>
                          <?php } endforeach;?>
                             <tr class="footer">
                                    <td colspan="4">
                                    
                                    </td>
                                   
                                    <td colspan="2" align="right">
                                    <!--  PAGINATION START  -->             
                                    
                                      
                                    <!--  PAGINATION END  -->       
                                    </td>
                                  </tr>                
						</tbody>
					</table>
</form>
</div>
</div>
</div>
                    
                    
     