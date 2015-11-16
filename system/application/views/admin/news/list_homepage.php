<?php $this->load->helper('get_date_from_sql');?>
<?php $this->session->set_flashdata(array('redirect_link'=>$this->uri->uri_string()));?>
<style type="text/css">
	.hot1{
		background-color:#fee1f1;
	}
	.hot2{
		background-color:#deffc0;
	}
	.hot3{
		background-color:#f0fdea;
	}
</style>
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
        <th width="26%"><div align="left">Tiêu đề</div></th>
        <th width="10%"><div align="center"></div></th>
        <th width="13%"><div align="center"></div></th>
        
        <th width="33%"><div align="center">Công cụ (Steps :<input type="text" name="position_steps" value="1" style="width:20px;display:inline-block !important;" >)</div></th>
      </tr>
        <?php $i=$this->uri->segment(5,0); foreach($news->all as $row):$i++;?>
        <tr class="<?php if($i==1) echo 'hot1'; else if($i<=4) echo 'hot2'; else if($i<=14) echo 'hot3';?>" >
            <td widtd="6%"><div align="center"><?php echo $i;?></div></td>
            <td><div align="center"><input type="checkbox" class="checkinput" value="<?=$row->id?>" name="checkinput[]" ></div></td>
            <td widtd="68%"><div align="center"><a href="<?=$this->admin_url.'cnews/edit/'.$row->newscatalogue_id.'/'.$row->id;?>"><img src="<?=$row->dir.filenameplus($row->image,'medium');?>" width="100" height="100" /></a></div></td>
            <td widtd="68%"><a href="<?=$this->admin_url.'cnews/isolate_edit/'.$row->newscatalogue_id.'/'.$row->id;?>"><?php echo $row->title_vietnamese;?> <span style="color:#9C3">(<?=get_from_datetime($row->created);?>)</span></a></td>
            <td widtd="68%"><div align="left">
					<?php if($row->hot == 1) { ?> <img src="<?=$admin_resource;?>new/images/hot.jpg"/> <?php }?>
                    <?php if($row->home_hot == 1) { ?> <img src="<?=$admin_resource;?>new/images/icons/home.gif"/> <?php }?>
               </div></td>
            <td widtd="68%">
                <?php echo create_link_table('removehome_inline',$this->admin_url.'cnews/add_home/'.$row->id.'/0','Bỏ tiêu điểm','','Bỏ tiêu điểm');?>
			</td>
           
            <td widtd="26%">
              <div align="center">     
                <?php if($row->active==1) 
                        echo create_link_table('approve_icon',$this->admin_url.'cnews/active/'.$row->id.'/'.$seg,'Vô hiệu');
                    else
                        echo create_link_table('reject_icon',$this->admin_url.'cnews/active/'.$row->id.'/'.$seg,'Kích hoạt');
				?>
                <?php 
				echo create_link_table('uptop_icon change_position',$this->admin_url.'cnews/up_position_homepage_top/'.$row->id,'uptop');
				echo create_link_table('up_icon change_position',$this->admin_url.'cnews/up_position_homepage/'.$row->id,'up');
					echo create_link_table('down_icon change_position',$this->admin_url.'cnews/down_position_homepage/'.$row->id,'down');
					echo create_link_table('downbottom_icon change_position',$this->admin_url.'cnews/down_position_homepage_bottom/'.$row->id,'down bottom');
					?>
              </div>		
            </td>
        </tr>	
        <?php endforeach;?>
        <tr class="footer">
                                    <td colspan="4">
                               
                                   <?php echo create_link_table('approve_inline','javascript:void(0);','Kích hoạt','actionallinput("active","myform","'.$this->admin_url.'cnews/active/0/1","checkinput")','Kích hoạt');?>
                                   <?php echo create_link_table('reject_inline','javascript:void(0);','Vô hiệu','actionallinput("deactive","myform","'.$this->admin_url.'cnews/active/0/0","checkinput")','Vô hiệu');?>
                                   <?php echo create_link_table('removehome_inline','javascript:void(0);','Bỏ tiêu điểm','actionallinput("addhome","myform","'.$this->admin_url.'cnews/add_home/0/0","checkinput")','Bỏ hot trang chủ');?>
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