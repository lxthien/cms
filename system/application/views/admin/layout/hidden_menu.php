 <div class="grid_16" id="hidden_submenu">
  <div class="clear"></div>
 	 <?php if(isset($nav_menu)){ ?>
          <ul class="group" id="menu_group_main">
			  <?php $i=0; foreach ($nav_menu as $row) : $i++; ?>
                    <li class="item <?php if($i==1) echo 'first';?>" id="one"><a href="<?=$row['link'];?>" onClick="<?=$row['onclick'];?>" ><span class="outer"><span class="inner <?=$row['type'];?>"><?=$row['text'];?></span></span></a></li>
              <?php endforeach;?>  
          </ul>
         <?php }?>   
 		<!--NOTIFICATION MESSAGES-->
 		<div class="clear"></div>
        <?php echo show_flash_message();?>
        <?php if(isset($object))
		{
				if(!is_array($object))
				{
					foreach($object->error->all as $error){
						show_message_admin('error',$error);
					}
				}
				else
				{
					foreach($object as $o)
					{
						foreach($o->error->all as $error){
							show_message_admin('error',$error);
					}
					}
				}
			
		}
		?>
        <?php if(isset($page_error))
		       {
			 	if(!is_array($page_error))
				{	
					show_message_admin('error',$page_error);
				}
				else
				{
					foreach($page_error as $row_e)
					{
						show_message_admin('error',$row_e);	
					}
				}
			   }
				
		?>
        <div class="clear"></div>
        <!--NOTIFICATION MESSAGES-->
        
        
   	
         
          
 </div>