<?php $admin_resource= $base_url."images/admin/";?>
<div id="sidebar">
  				<ul>
                <?php foreach($this->menu as $row): 
				    if($row->parent_id==0) { ?>
                	<li><h3><a href="<?=$base_url;?>admin/navi/index/<?=$row->id;?>" style="background:url(<?=$base_url.$row->icon;?>) no-repeat left;"><?php echo $row->name;?></a></h3>
                        <ul>
                        <?php foreach($this->menu as $row1): 
								if($row1->parent_id==$row->id) { ?>
		                        	<li><a href="<?=$base_url.'admin/'.$row1->link;?>" style="background:url(<?=$base_url.$row1->icon;?>) no-repeat left;" ><?php echo $row1->name;?></a></li>
                         <?php } endforeach;?>
                        </ul>
                    </li>
                 <?php } endforeach;?>
                  
				</ul>       
          </div>