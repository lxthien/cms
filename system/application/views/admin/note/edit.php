<script language="javascript" type="text/javascript" src="<?php echo $base_url;?>ckeditor/ckeditor.js"></script>
<div class="grid_15" id="textcontent"> 
                    <form id="form" class="table_input" action="<?=$base_url;?>admin/notes/edit/<?=$parentnote_id;?>/<?=$object->id;?>" method="post">
                 
                        			<label for="name">Tên:</label>
                                <input type="text" name="name" value="<?=$object->name;?>" class="smallInput wide" />
                                <label for="name">Tên tự:</label>
                                <input type="text" name="nickname" value="<?=$object->nickname;?>" class="smallInput wide" />
                               <label for="name">Giới tính:</label>
                                <input type="radio" name="sex" value="nam" <? if($object->sex=="nam") echo 'checked="checked"';?> />Nam
                                <input type="radio" name="sex" value="nu" <? if($object->sex=="nu") echo 'checked="checked"';?>/>Nữ
                             
                            	       	
                        		<label for="name">Vị trí:</label>
                                <input type="text" name="nameOfPosition" value="<?=$object->nameOfPosition;?>" class="smallInput wide" />
                                
                                <label for="name">Ngày sinh:</label>
                                <input type="text" name="dateOfBirth" id="dateOfBirth" value="<?=$object->dateOfBirth;?>" class="smallInput wide" />
                                
                                <label for="name">Ngày mất:</label>
                                <input type="text" name="dateOfDeath" id="dateOfDeath" value="<?=$object->dateOfDeath;?>" class="smallInput wide" />     
                                <label for="name">Địa chỉ sinh:</label>
                                <input type="text" name="addressOfBirth" value="<?=$object->addressOfBirth;?>" class="smallInput wide" />     
                                 <label for="name">Tỉnh/Thành Phố nơi sinh:</label>
                                <input type="text" name="cityOfBirth" value="<?=$object->cityOfBirth;?>" class="smallInput wide" />     
                                <label for="name">Quốc gia nơi sinh:</label>
                                <input type="text" name="countryOfBirth" value="<?=$object->countryOfBirth;?>" class="smallInput wide" />     
                                <label for="name">Địa chỉ nơi chết:</label>
                                <input type="text" name="addressOfDeath" value="<?=$object->addressOfDeath;?>" class="smallInput wide" />     
                                 <label for="name">Tỉnh/Thành Phố nơi chết:</label>
                                <input type="text" name="cityOfDeath" value="<?=$object->cityOfDeath;?>" class="smallInput wide" />     
                                <label for="name">Quốc gia nơi chết:</label>
                                <input type="text" name="countryOfDeath" value="<?=$object->countryOfDeath;?>" class="smallInput wide" />     
                      			
                                <label for="name">Nghề nghiệp:</label>
                                <input type="text" name="career" value="<?=$object->career;?>" class="smallInput wide" />     
                                <label for="name">Điện thoại:</label>
                                <input type="text" name="phone" value="<?=$object->phone;?>" class="smallInput wide" />    
                                <label for="name">An táng tại:</label>
                                <input type="text" name="buryAt" value="<?=$object->buryAt;?>" class="smallInput wide" />
                                <label for="name">Thông tin chi tiết:</label>   
                                <textarea  name="description"><?php echo $object->description;?></textarea>
                                <script type="text/javascript">
									//<![CDATA[
					
								
										editor=CKEDITOR.replace( 'description',
														  {
																toolbar : [ [ 'Source', '-', 'Cut', 'Copy', 'Paste', '-', 'TextColor', 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'NumberedList', 'BulletedList', 'Outdent', 'Indent', '-', 'Link', 'Unlink', 'Anchor', '-' ],['Styles', 'Format', 'Font', 'FontSize', '-', 'Image', 'Flash', 'Table', 'HorizontalRule','MediaEmbed','flvPlayer']],
																height:300,
																filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/' 
															});
									//]]>
								</script>  
                      <div class="button_bar">
                      
                     	<?php create_form_button('submit_button button_ok','Lưu dữ liệu');?>
                        <div class="clear"></div>
                     </div>
                    </form>

                </div>