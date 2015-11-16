<div id="portlets">
    <div class="column"></div>
     <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Tìm kiếm</div>
        <div class="portlet-content nopadding">
            <form action="<?=$base_url;?>admin/customers/list_all" method="post" >
                    <div>
                        <table class="table_input">
                            <tr>
                                <td>Từ khóa</td>
                                <td><input name="search_name" class="smallInput big" value="<?=$searchKey;?>"/></td>
                            </tr>   
                        </table>
                    </div>
                    <div class="clear"></div>
                    <div class="button_bar">
                    	<?php create_form_button('submit_button button_ok','Tìm kiếm');?>
                        <br />
                        
                    </div>
                    <div class="clear" style="height: 20px;"></div>
            </form>
        </div>
     </div>
    
</div>
<div id="portlets">
<div class="column"></div>
<div class="portlet">
<div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users"/>Tìm thấy <?=$customers->result_count();?> kết quả</div>
<div class="portlet-content nopadding">
<form name="myform" id="myform" method="post" >
   <?php $seg=$this->uri->segment(4,0);?>
	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
   	  <tr>
        <th width="3%"><div align="center">TT</div></th>
        <th width="8%"><div align="center"><input type="checkbox" name="checkall" value="" id="checkall" onclick="checkallinput('checkall','checkinput')"/></div></th>
        <th width="25%"><div align="left">Họ tên</div></th>
        <th width="12%"><div align="center">Số điện thoại</div></th>
        <th width="20%"><div align="center">Email</div></th>
        <th width="12%"><div align="center">Trạng thái</div></th>
        <th width="30%"><div align="center">Công cụ</div></th>
      </tr>
        <?php
        if($customers->result_count()==0){?>
        <tr>
            <td colspan="7">
                <p align="center">Chưa có khách hàng</p>
            </td>
        </tr>
        <?php
        }
        $i=$this->uri->segment(5,0); foreach($customers->all as $row):$i++;?>
        <tr style="cursor: pointer;" onclick="window.location.href = '<?=$this->admin_url.'customers/edit/'.$row->id;?>'" >
            <td><div align="center"><?php echo $i;?></div></td>
            <td><div align="center"><input type="checkbox" class="checkinput" value="<?=$row->id?>" name="checkinput[]" /></div></td>
            <td><a href="<?=$base_url;?>admin/customers/edit/<?=$row->id;?>"><?=$row->name;?>(<?=get_from_datetime($row->created);?>)</a></td>
            <td><div align="center"><?=$row->mobilePhone;?></div></td>
            <td><div align="center"><?=$row->email;?></div></td>
            <td><div align="center">
                    <?php
                    if($row->isEmailActive==1) 
                        echo create_link_table('approve_icon',$this->admin_url.'customers/active/'.$row->id,'Vô hiệu');
                    else
                        echo create_link_table('reject_icon',$this->admin_url.'customers/active/'.$row->id,'Kích hoạt');?>
                </div></td>
            <td>
                <div align="center">
                    <?php
                    echo create_link_table('edit_icon',$this->admin_url.'customers/edit/'.$row->id,'Edit');
    				echo create_link_table('delete_icon',$this->admin_url.'customers/delete/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")'); ?>
                </div>
            </td>
        </tr>	
        <?php endforeach;?>
        <tr class="footer">
          <td colspan="7" align="right"><?php echo $this->pagination->create_links();?></td>
        </tr>
    </table>
   	<div style="padding-top:20px;"></div>
</form>
</div>
</div>
</div>