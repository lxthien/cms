<div id="portlets">
<div class="column"> 
</div>
 <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title;?></div>
		<div class="portlet-content nopadding">
<form name="myform" id="myform" method="post" >
<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
						<thead>
							<tr>
                            	<th width="40"><a href="#">ID<img src="<?=$admin_resource;?>img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
                            	<th width="792">Name</th>
                            	<th width="440"><div align="left">Số lượng tin</div></th>
                            </tr>
						</thead>
						<tbody>
                       <?php
								$i=$this->uri->segment(5,0);
								 foreach ($newscatalogue as $row_sub): 
								 			$i++; ?>
                                            	  <tr>
                                                        <td class="a-center"><div align="center"><?php echo $i;?></div></td>
                                                        <td>:..........<?php echo $row_sub->name_vietnamese;?></td>
                                                        <td><a href="<?=$this->admin_url;?>cnews/list_by_cat/<?=$row_sub->id;?>" ><?=$row_sub->article->where('recycle',0)->count();?> Tin</a> <?php if($this->logged_in_user->adminrole->id==1) { ?> | <a href="<?=$this->admin_url;?>cnews/list_recycle_by_cat/<?=$row_sub->id;?>" ><?=$row_sub->article->where('recycle',1)->count();?> Tin rác</a> <?php  } ?><?php if($row_sub->article->where('hot',1)->count() > 0) { ?> <img src="<?=$admin_resource;?>new/images/hot.jpg"/> <?php }?></td>
                          </tr>
                                  <?php  endforeach;?>
                                            
						</tbody>
					</table>
       </form>
       </div>
       </div>
       </div>
     