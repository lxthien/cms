<div class="grid_15" id="textcontent">
             	
                    <form id="form" class="table_input" action="<?=$this->admin_url;?>adminusers/edit/<?=$object->id;?>" method="post">
                      <h2>Thông tin đăng nhập</h2>
                        
                     
                        	
                             	
                        		<label for="name">Username:</label>
                                <input type="text" name="username" class="smallInput wide"  value="<?=$object->username;?>"/>
                            
                            
                             	
                        		<label for="name">Password:</label>
                                <input type="password" name="password" class="smallInput wide" value="<?=$object->password;?>" />
                                <label for="name">Confirm Password:</label>
                                <input type="password" name="confirm_password" class="smallInput wide" value="<?=$object->confirm_password;?>" />
                            
                            	<label for="parent">User Group : </label> 
                                <select name="adminrole" class="smallInput" >                                           
                                        <?php foreach($adminrole as $row_role) : if($row_role->id!=1  ){ ?>
                                            <option value="<?=$row_role->id;?>" <?php if($row_role->id==$object->adminrole_id) echo 'selected="selected"';?>  ><?php echo $row_role->name;?></option>
                                        <?php } endforeach;?>
                                        </select>
                            

                           
                        
                  
                       		
                        
                        
                 
                    
                      <h2>Thông tin liên lạc</h2>
                      
                        
                            
                             	
                        			<label for="name">FULLNAME:</label>
                                <input type="text" name="fullname" class="smallInput wide" value="<?=$object->fullname;?>" />
                            
                            
                             	
                        			<label for="name">EMAIL:</label>
                                <input type="text" name="email" class="smallInput wide" value="<?=$object->email;?>" />
                            
                               
                             	
                        			<label for="name">PHONE:</label>
                                <input type="text" name="phone" class="smallInput wide" value="<?=$object->phone;?>" />
                            
                            
                             	
                        			<label for="name">ADDRESS:</label>
                                <input type="text" name="address" class="smallInput wide" value="<?=$object->address;?>" />
                           <?php if($this->logged_in_user->adminrole->id==1) { ?>
                            <label for="name">kfm_username:</label>
                                <input type="text" name="kfm_username" class="smallInput wide" value="<?=$object->kfm_username;?>" />
                             	
                        			<label for="name">kfm_password:</label>
                                <input type="text" name="kfm_password" class="smallInput wide" value="<?=$object->kfm_password;?>" />
                            <?php } ?>
                           
                        
                     
                       		
                         <div class="button_bar">
                     <br /><br />
                     	<?php create_form_button('submit_button button_ok','Lưu thông tin người dùng');?>
                     
         			</div>
                        
                 
                    
                    </form>
                   
                </div>