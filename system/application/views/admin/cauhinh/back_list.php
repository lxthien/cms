<div id="portlets">
<div class="column"> 
</div>
 <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title;?></div>
		<div class="portlet-content nopadding">
<form name="myform" id="myform" method="post" >
   
	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
    
   	  <tr>
        <th width="2%"><div align="center">TT</div></th>
        <th width="2%"><div align="center"><input type="checkbox" name="checkall" value="" id="checkall" onclick="checkallinput('checkall','checkinput')"></div></th>
        <th width="47%"><div align="left">Name</div></th>
        <th width="20%"><div align="left">Value</div></th>
        <th width="14%"><div align="left">Type</div></th>
        <th width="14%">Only Webmaster</th>
        <th width="15%"><div align="center">Tool</div></th>
      </tr>
     	<?php $arr=array();?>
        <?php $i=$this->uri->segment(5,0); foreach($configgroup as $row_group): $i++;?>
        	<tr >
                <td widtd="6%"><div align="center"><?php echo $i;?></div></td>
                <td><div align="center"></div></td>
                <td widtd="68%"><a href="<?=$this->admin_url.'configgroups/edit/'.$row_group->id;?>"><strong><?php echo $row_group->name;?></strong></a></td>
                <td widtd="68%"></td>
                <td widtd="68%"></td>
                <td widtd="68%"><?php if($row_group->for_webmaster == 1) { ?><img src="<?=$base_url;?>images/admin/new/images/icons/action_check.gif" /><? } ?></td>
                <td widtd="26%">
                  <div align="center">
                <?php 
                        echo create_link_table('edit_icon',$this->admin_url.'configgroups/edit/'.$row_group->id,'Edit Config');
                        echo create_link_table('delete_icon',$this->admin_url.'configgroups/delete/'.$row_group->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")'); ?></div>									</td>
            </tr>	
           
            <?php $cauhinh=$row_group->cauhinh;?>
			<?php  foreach($cauhinh->all as $row):$i++; array_push ($arr,$row->id); ?>
            <tr >
                <td widtd="6%"><div align="center"><?php echo $i;?></div></td>
                <td><div align="center"><input type="checkbox" value="<?=$row->id?>" name="checkinput[]"></div></td>
                <td widtd="68%"><a href="<?=$this->admin_url.'cauhinhs/edit/'.$row->id;?>">:...........<?php echo $row->name;?> <span style="color:red">(<?=$row->fieldname;?>)</span></a></td>
                <td widtd="68%"><?=$row->value;?></td>
                <td widtd="68%"><div align="left"><?=$row->type;?></div></td>
                <td widtd="68%"><?php if($row->for_webmaster == 1) { ?><img src="<?=$base_url;?>images/admin/new/images/icons/action_check.gif" /><? } ?></td>
                <td widtd="26%">
                  <div align="center">
                <?php 
                        echo create_link_table('edit_icon',$this->admin_url.'cauhinhs/edit/'.$row->id,'Edit Config');
                        echo create_link_table('delete_icon',$this->admin_url.'cauhinhs/delete/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")'); ?></div>									</td>
            </tr>	
            <?php endforeach;?>
        <?php endforeach;?>
         <?php $cauhinh=new cauhinh; if(count($arr)>0) $cauhinh->where_not_in('id',$arr);$cauhinh->get();?>
			<?php  foreach($cauhinh->all as $row):$i++;?>
            <tr >
                <td widtd="6%"><div align="center"><?php echo $i;?></div></td>
                <td><div align="center"><input type="checkbox" value="<?=$row->id?>" name="checkinput[]"></div></td>
                <td widtd="68%"><a href="<?=$this->admin_url.'cauhinhs/edit/'.$row->id;?>"><?php echo $row->name;?> <span style="color:red">(<?=$row->fieldname;?>)</span></a></td>
                <td widtd="68%"><?=$row->value;?></td>
                <td widtd="68%"><div align="left"><?=$row->type;?></div></td>
                <td widtd="68%"><?php if($row->for_webmaster == 1) { ?><img src="<?=$base_url;?>images/admin/new/images/icons/action_check.gif" /><? } ?></td>
                <td widtd="26%">
                  <div align="center">
                <?php 
                        echo create_link_table('edit_icon',$this->admin_url.'cauhinhs/edit/'.$row->id,'Edit Config');
                        echo create_link_table('delete_icon',$this->admin_url.'cauhinhs/delete/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")'); ?></div>									</td>
            </tr>	
            <?php endforeach;?>
        <tr class="footer">
                                    <td colspan="6">
                                  
          </td>
                                   
                                    <td colspan="2" align="right">
                                    <!--  PAGINATION START  -->             
                                    
                                       
                                    <!--  PAGINATION END  -->       
                                    </td>
        </tr>
    </table>
    
                       

   	<div style="padding-top:20px;"></div>
</form>
</div>
</div>
</div>