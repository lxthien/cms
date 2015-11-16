<?php $this->load->helper('get_date_from_sql');?>
<?php $this->session->set_flashdata(array('redirect_link'=>$this->uri->uri_string()));?>

<div id="portlets">
<div class="column"> 
</div>
 <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title_table;?></div>
		<div class="portlet-content nopadding">
<form name="myform" id="myform" method="post" >
   <?php $seg=$this->uri->segment(4,0);?>
	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
    
   	  <tr>
        <th width="3%"><div align="center">TT</div></th>
        <th width="3%"><div align="center"><input type="checkbox" name="checkall" value="" id="checkall" onclick="checkallinput('checkall','checkinput')"></div></th>
        <th width="12%"><div align="center">Image</div></th>
        <th><div align="left">Tiêu đề</div></th>
        <!--<th width="10%"><div align="center"></div></th>-->
        <!--<th width="13%"><div align="center">Tác vụ</div></th>-->
        
        <th width="15%"><div align="center">Công cụ</div></th>
      </tr>
        <?php $i=$this->uri->segment(5,0); foreach($news->all as $row):$i++;?>
        <tr style="cursor: pointer;" onclick="window.location.href = '<?=$this->admin_url.'cnews/isolate_edit/'.$row->newscatalogue_id.'/'.$row->id;?>' "   >
            <td widtd="6%"><div align="center"><?php echo $i;?></div></td>
            <td><div align="center"><input type="checkbox" class="checkinput" value="<?=$row->id?>" name="checkinput[]" ></div></td>
            <td widtd="68%"><div align="center"><a href="<?=$this->admin_url.'cnews/isolate_edit/'.$row->newscatalogue_id.'/'.$row->id;?>"><img src="<?=image($row->dir.$row->image,'news_75_50');?>"  /></a></div></td>
            <td widtd="68%"><a href="<?=$this->admin_url.'cnews/isolate_edit/'.$row->newscatalogue_id.'/'.$row->id;?>"><?php echo $row->title_vietnamese;?> <span style="color:#9C3">(<?=get_from_datetime($row->created);?>)</span></a></td>
           
            <td widtd="26%">
              <div align="center">
                   
                <?php if($row->active==1) 
                        echo create_link_table('approve_icon',$this->admin_url.'cnews/isolate_active/'.$row->id,'Vô hiệu');
                    else
                        echo create_link_table('reject_icon',$this->admin_url.'cnews/isolate_active/'.$row->id,'Kích hoạt');
                 
					echo create_link_table('edit_icon',$this->admin_url.'cnews/isolate_edit/'.$row->newscatalogue_id.'/'.$row->id,'Edit News');
					echo create_link_table('delete_icon',$this->admin_url.'cnews/isolate_recycle/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")'); ?></div>		</td>
        </tr>	
       			 <?php endforeach;?>
        <tr class="footer">
                                    <td colspan="4">
                                   <?php echo create_link_table('delete_inline','javascript:void(0);','Xóa chọn','actionallinput("recycle","myform","'.$this->admin_url.'cnews/isolate_recycle/0/1","checkinput")','Delete all');?>
                                   <?php echo create_link_table('approve_inline','javascript:void(0);','Kích hoạt','actionallinput("active","myform","'.$this->admin_url.'cnews/isolate_active/0/1","checkinput")','Kích hoạt');?>
                                   <?php echo create_link_table('reject_inline','javascript:void(0);','Vô hiệu','actionallinput("deactive","myform","'.$this->admin_url.'cnews/isolate_active/0/0","checkinput")','Vô hiệu');?>
                                   
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