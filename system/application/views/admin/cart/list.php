<div id="portlets">
    <div class="column"></div>
     <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Tìm kiếm</div>
        <div class="portlet-content nopadding">
            <form action="<?=$base_url;?>admin/carts/list_all" method="post" >
                    <div>
                        <table class="table_input">
                            <tr>
                                <td>Từ khóa</td>
                                <td><input name="search_name" class="smallInput big" value="<?=trim($searchKey);?>"/></td>
                            </tr>  
                            <tr>
                                <td>Trạng thái đơn hàng</td>
                                <td>
                                    <select name="cartStatus">
                                        <option value="0" <?=selectIt($cartStatus,0);?> >Tất cả</option>
                                        <option value="<?=enum::CART_WAIT_FOR_PROCESS;?>" <?=selectIt($cartStatus,enum::CART_WAIT_FOR_PROCESS);?> ><?=enum::getCartStatus(enum::CART_WAIT_FOR_PROCESS);?></option>
                                        <option value="<?=enum::CART_PROCESSING;?>" <?=selectIt($cartStatus,enum::CART_PROCESSING);?> ><?=enum::getCartStatus(enum::CART_PROCESSING);?></option>
                                        <option value="<?=enum::CART_SENT_MAIL_AND_WAIT_CUSTOMER;?>" <?=selectIt($cartStatus,enum::CART_SENT_MAIL_AND_WAIT_CUSTOMER);?> ><?=enum::getCartStatus(enum::CART_SENT_MAIL_AND_WAIT_CUSTOMER);?></option>
                                        <option value="<?=enum::CART_CANCEL;?>" <?=selectIt($cartStatus,enum::CART_CANCEL);?> ><?=enum::getCartStatus(enum::CART_CANCEL);?></option>
                                        <option value="<?=enum::CART_DELIVERING;?>" <?=selectIt($cartStatus,enum::CART_DELIVERING);?> ><?=enum::getCartStatus(enum::CART_DELIVERING);?></option>
                                        <option value="<?=enum::FINISH;?>" <?=selectIt($cartStatus,enum::FINISH);?> ><?=enum::getCartStatus(enum::FINISH);?></option>
                                    </select></td>
                                </td>
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
<div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users"/> <?=$title_table;?></div>
<div class="portlet-content nopadding">
<form name="myform" id="myform" method="post" >
   <?php $seg=$this->uri->segment(4,0);?>
	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
   	  <tr>
        <th width="3%"><div align="center">TT</div></th>
        
        <th width=""><div align="left">Code</div></th>
        <th width=""><div align="left">Khách hàng</div></th>
        <th><div align="left">Điện thoại</div></th>
        <th width=""><div align="left">Giá trị</div></th>
        <th width=""><div align="center">Trạng thái</div></th>
        <th width=""><div align="center">Ngày mua</div></th>
        <?php if($this->logged_in_user->adminrole_id ==1 ){?><th></th><?php } ?>
        
      </tr>
        <?php
        if($carts->result_count()==0){?>
        <tr>
            <td colspan="6">
                <p align="center">Chưa có đơn hàng nào</p>
            </td>
        </tr>
        <?php
        }
        $i=$this->uri->segment(6,0); foreach($carts->all as $row):$i++;?>
        <tr style="cursor: pointer;" onclick="window.location.href='<?=$base_url;?>admin/carts/edit/<?=$row->id;?>'">
            <td width="3%"><div align="center"><?php echo $i;?></div></td>
            <td><a href="<?=$base_url;?>admin/carts/edit/<?=$row->id;?>"><?=$row->code?></a></td>
            <td><?=$row->customer->where('id', $row->customer_id)->get()->name;?></td>
            <td><?=$row->customer->mobilePhone;?></td>
            <td><?=number_format($row->total);?> VND</td>
            <td><div align="center">
                    <?=enum::getCartStatus($row->status);?>
                </div></td>
            
            <td><div align="center"><?=get_from_datetime($row->created)?></div></td>
            <?php if($this->logged_in_user->adminrole_id ==1 ){?><td>
            <?php echo create_link_table('delete_icon',$this->admin_url.'carts/delete/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")'); ?>
            </td><?php } ?>
        </tr>	
        <?php endforeach;?>
        <tr class="footer">
            <td colspan="5">
           
          </td>
          <td colspan="2" align="right"><?php echo $this->pagination->create_links();?></td>
          
        </tr>
    </table>
   	<div style="padding-top:20px;"></div>
</form>
</div>
</div>
</div>