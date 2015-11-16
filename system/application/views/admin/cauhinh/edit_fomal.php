<script type="text/javascript" language="javascript">
$().ready(function(){
	$('#container_tab').tabs();
});
</script>
<style type="text/css">
input[type="text"] {
		display:inherit !important;
	}
	form label {
	display:inherit !important;
	}
	.error{
		color:red;
	}
	.success{
		color:#0F0;
	}
</style>
<div class="grid_15" id="textcontent">
    <?php $this->load->helper('custom_config');?>
    <form id="form" class="table_input"  method="post" action="<?=$this->admin_url."cauhinhs/edit_fomal/0";?>" enctype="multipart/form-data" >
 				<div id="container_tab" style="margin-top:10px;">
                        <ul>
                         <?php foreach($configgroup as $row_group):?>  
                          <?php if( ($logged_role != 1 && $row_group->for_webmaster == 0) || ($logged_role == 1) ) { ?>
                            <li><a href="#<?=$row_group->name;?>" ><span><?php echo $row_group->name;?></span></a></li>     
                           <?php } ?>
                         <?php endforeach;?>
                        	 <li><a href="#other"><span>Other</span></a></li>     
                        </ul>
                        <?php $arr=array();?>
                        <?php foreach($configgroup as $row_group):?>  
                        <?php if( ($logged_role != 1 && $row_group->for_webmaster == 0) || ($logged_role == 1) ) { ?>
                        		<div id="<?=$row_group->name;?>">
                                    <div  style="min-height:300px;">
                                		<table class="table_input">
                                		 <?php $cauhinh=$row_group->cauhinh;?>     
										<?php  foreach($cauhinh->all as $row): array_push ($arr,$row->id); ?>
											<?php if( ($logged_role != 1 && $row->for_webmaster == 0) || ($logged_role == 1) ) { ?>
                                                    <?php custom_config($row,$logged_role);?>
                                             <?php } ?>
                                         <?php endforeach;?>
                                        </table>
                                         
                                     </div>
                                </div>
                        <?php } ?>
                        <?php endforeach;?>
                        <div id="other">
                           <div  style="min-height:300px;">
                        	<?php $cauhinh=new cauhinh; if(count($arr)>0) $cauhinh->where_not_in('id',$arr);$cauhinh->get();?>
                            <table class="table_input">
                            <?php  foreach($cauhinh->all as $row):?>
                            <?php if( ($logged_role != 1 && $row->for_webmaster == 0) || ($logged_role == 1) ) { ?>
                            	<?php custom_config($row);?>
                            <?php } ?>
                           	<?php endforeach;?>
                            </table>
                            </div>
                        </div>
            </div>
            <div class="button_bar"><?php create_form_button('submit_button button_ok','Save');?> </div>
  </form>

</div>