<script type="text/javascript">
$().ready(function(){
   $(".parentcheck").each(function(){
        $(this).click(function(){
            var child = $(":input[parent='"+$(this).val()+"']");
            child.attr("checked",$(this).prop("checked")); 
        });
   }); 
});
</script>
<form id="form" class="table_input" action="<?=$base_url;?>admin/adminroles/edit/<?=$object->id;?>" method="post">
<div class="grid_15" > 
                    
                        	<label for="name">Name:</label></td>
                                <input type="text" name="name" class="smallInput wide" value="<?=$object->name;?>"/>
                                <label for="name">Level:</label></td>
                                <input type="text" name="level" class="smallInput wide" value="<?=$object->level;?>"/>
 </div>
 <div class="clear" style="height:20px;"></div>
 <div id="portlets">
<div class="column"> 
</div>
 <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title;?></div>
		<div class="portlet-content nopadding">                     
                        <table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
						<thead>
							<tr>
                            	<th width="40"><a href="#">ID<img src="<?=$admin_resource;?>img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
                            	<th width="501"><div align="left">Group name</div></th>
                            </tr>
						</thead>
						<tbody>
                        <?php $i=0; foreach($adminmenu as $row_menu):
								if($row_menu->parentmenu_id==NULL) { $i++; ?>
								<!--display menu parent content-->
                                    <tr>
                                        <td ><div align="center"><?php echo $i;?></div></td>
                                        <td><input type="checkbox" name="checkmenu[]" value="<?=$row_menu->id;?>" class="parentcheck"  <?php if($row_menu->is_related_to($object)) echo 'checked="checked"';?> />&nbsp;<img src="<?=$base_url;?><?=$row_menu->icon;?>" /><?php echo $row_menu->name;?></td>
                                    </tr>
						         <?php foreach ($adminmenu as $row_submenu): 
								 			if($row_submenu->parentmenu_id==$row_menu->id) { $i++; ?>
                                            	  <tr>
                                                        <td class="a-center"><div align="center"><?php echo $i;?></div></td>
                                                        <td>:...........<input parent="<?=$row_menu->id;?>" type="checkbox" name="checkmenu[]" value="<?=$row_submenu->id;?>"  <?php if($row_submenu->is_related_to($object)) echo 'checked="checked"';?> />&nbsp;<img src="<?=$base_url;?><?=$row_submenu->icon;?>" /><?php echo $row_submenu->name;?></td>
                          </tr>
                                  <?php } endforeach; } endforeach;?>
                                            
						</tbody>
					</table>
 </div>
 </div>
 </div>           
 <div class="button_bar">
                     <br /><br />
                     	<?php create_form_button('submit_button button_ok','Lưu thông tin ');?>
                     
         </div>  
                    </form>

          