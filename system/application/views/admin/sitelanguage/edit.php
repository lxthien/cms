<form id="form" class="table_input" action="<?=$base_url;?>admin/sitelanguages/edit/<?=$object->id;?>" method="post">
<div class="grid_15" > 
                    
                        	<label for="name">Name:</label></td>
                                <input type="text" name="name" class="smallInput wide" value="<?=$object->name;?>"/>
                                <label for="name">Short:</label></td>
                                <input type="text" name="short" class="smallInput wide" value="<?=$object->short;?>"/>
 </div>
 <div class="clear" style="height:20px;"></div>
         
 <div class="button_bar">
                     <br /><br />
                     	<?php create_form_button('submit_button button_ok','Lưu thông tin ');?>
                     
         </div>  
                    </form>

          