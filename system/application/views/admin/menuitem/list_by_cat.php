<div id="portlets">
<div class="column"> 
</div>
 <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title_table;?></div>
		<div class="portlet-content nopadding">
<form name="frmMenu" id="frmMenu" method="post" >
   <?php $seg=$this->uri->segment(5,0);?>
	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
   	  <tr>
        <th width="5%"><div align="center">TT</div></th>
        <th width="30%"><div align="left">Tên menu</div></th>
        <th width="30%"><div align="left">Link</div></th>
        <th width="15%"><div align="center">Công cụ</div></th>
        <th width="15%"><div align="center">Vị trí</div></th>
      </tr>
        <?php $i=$this->uri->segment(5,0); foreach($object->all as $row):$i++;?>
        <tr>
            <td widtd="6%"><div align="center"><?php echo $i;?></div></td>
            <td><div align="left"><?=$row->name?></div></td>
            <td><div align="left"><?=$row->link?></div></td>
            <td>
                <div align="center">
                    <?php
                        if($row->active==1) 
                            echo create_link_table('approve_icon',$this->admin_url.'menuitems/active/'.$menu_id.'/'.$row->id,'Vô hiệu');
                        else
                            echo create_link_table('reject_icon',$this->admin_url.'menuitems/active/'.$menu_id.'/'.$row->id,'Kích hoạt');
                            
                        echo create_link_table('edit_icon',$this->admin_url.'menuitems/edit/'.$menu_id.'/'.$row->id,'Edit News');
    				    echo create_link_table('delete_icon',$this->admin_url.'menuitems/delete/'.$menu_id.'/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")');
                    ?>
                </div>
            </td>
            <td widtd="33%">
                <div align="center">
                    <input type="text" style="width: 100px;" value="<?=$row->position;?>" name="position_<?=$row->id;?>" />
                </div>		
            </td>
        </tr>	
        <?php endforeach;?>
        <tr>
            <td colspan="4"></td>
            <td>
                <div align="center"><input type="submit" value="Cập nhật" /></div>
            </td>
        </tr>
        <tr class="footer">
            <td colspan="2">
               
            </td>
            <td colspan="3" align="right">
                <!--  PAGINATION START  -->             
                <?php echo $this->pagination->create_links();?>
                <!--  PAGINATION END  -->       
          </td>
        </tr>
    </table>
    
                       

   	<div style="padding-top:20px;"></div>
</form>
</div>
</div>
</div>