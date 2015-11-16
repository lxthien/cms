<div class="grid_15" id="textcontent"> 
                    <form id="form" class="table_input" action="<?=$base_url;?>admin/bannercats/edit/<?=$object->id;?>" method="post">
                 
                        		<label for="name">Tên banner:</label>
                                <input type="text" name="name" value="<?=$object->name;?>" class="smallInput wide" />
                             
                      <div class="button_bar">
                      
                     	<?php create_form_button('submit_button button_ok','Lưu dữ liệu');?>
                        <div class="clear"></div>
                     </div>
                    </form>

                </div>