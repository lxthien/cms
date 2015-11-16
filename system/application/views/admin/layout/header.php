    
<div class="grid_16" id="header">     
      
 <div id="menu">
  
        <ul class="group" id="menu_group_main">
            <?php $this->load->helper('number_to_text_helper');?>
            <?php $i=0; foreach($this->menu as $row): $i++; ?>
                            <li class="item <?=$row->li_class;?>" id="<?=number_to_text($i);?>"  >
                                <a href="<?php if($row->link=="") echo $this->admin_url.'navi/index/'.$row->id;  else echo $this->admin_url.$row->link;?>" <?php if($row->id==$this->menu_current) echo 'class="main current"';?> ><span class="outer"><span class="inner <?=$row->class;?>"><?php echo $row->name;?></span></span></a></li>
                           
             <?php  endforeach;?>
                 
        </ul>
</div>
</div>

<?php if(!isset($menu_active))
 $menu_active=NULL;?>
<div class="grid_16">
<!-- TABS START -->
    <div id="tabs">
         <div class="container">
            <ul>
            	<?php foreach($this->menu_sub as $row):?>
                    <li class=""><a href="<?=substr($row->link,0,10)=="javascript"?$row->link:$base_url.'admin/'.$row->link;?>" <?php if(trim($menu_active)==trim($row->name)) echo "class='current more'";?>  ><span><?php echo $row->name;?></span></a></li>
                <?php endforeach;?>                        
           </ul>
        </div>
    </div>
<!-- TABS END -->    
</div>