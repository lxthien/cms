<?php $admin_resource= $base_url."images/admin/";?>
<div id="rightnow" style="width:100%;margin:0 auto;">
                    <h3 class="reallynow">
                        <span><?php if(isset($page_msg)) echo $page_msg; else echo "Administrator"?></span>
                        <?php if(isset($nav_menu)) { ?>
                        <?php foreach ($nav_menu as $row) :
								switch ($row['type'])
								{
									case "add":echo '<a href="'.$row['link'].'" class="add" onclick="'.$row['onclick'].'" >'.$row['text'].'</a>';break;	
									case "focus":echo '<a href="'.$row['link'].'" class="focus" onclick="'.$row['onclick'].'" >'.$row['text'].'</a>';break;	
								}
                       endforeach; } ?>
                        <br />
                    </h3>
                    <?php if(isset($page_short_msg)){ ?>
				    <p class="youhave"><?php  echo $page_short_msg;?></strong>
                    </p>
                    <?php } ?>
 </div>