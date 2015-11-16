<div class="grid_15" id="textcontent"> 
                    <form id="form" class="table_input" action="<?=$base_url;?>admin/newstopics/edit/<?=$object->id;?>" method="post">
                 
                        			<label for="name">Tên:</label>
                                <input type="text" name="name" value="<?=$object->name;?>" class="smallInput wide" />
                                <label>Tên ko dấu:</label>
                                <?=$object->name_none;?>
                            
                               
                      <div class="button_bar">
                     	<?php create_form_button('submit_button button_ok','Lưu dữ liệu');?>
                        <div class="clear"></div>
                     </div>
                    </form>

                </div>