<!--begin information customer-->
<div id="portlets">
<div class="column"></div>
<div class="portlet">
<div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users"/> <?=$title_customer;?></div>
<div class="portlet-content nopadding">
<form name="myform" id="myform" method="post" >
   <?php $seg=$this->uri->segment(4,0);?>
	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
        <tr>
            <td>Họ tên:</td>
            <td><?=$customers->name;?></td>
            <td>Điện thoại:</td>
            <td><?=$customers->phone;?></td>
        </tr>
        <tr>
            <td>Địa chỉ:</td>
            <td><?=$customers->address;?></td>
            <td>Email:</td>
            <td><?=$customers->email;?></td>
        </tr>
        <tr>
            <td>Trạng thái:</td>
            <td><?php 
                if($customers->active==0) echo 'Đã kích hoạt'; else echo 'Chưa kích hoạt';?></td>
            <td>Địa chỉ giao hàng:</td>
            <td><?=$customers->cart->where('customer_id', $customers->id)->get()->ship_address;?></td>
        </tr>
    </table>
   	<div style="padding-top:20px;"></div>
</form>
</div>
</div>
</div>
<!--end information customer-->
<div id="portlets">
<div class="column"></div>
<div class="portlet">
<div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users"/> <?=$title;?></div>
<div class="portlet-content nopadding">
<form name="myform" id="myform" method="post" >
	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
   	  <tr>
        <th width="3%"><div align="center">TT</div></th>
        <th width="8%"><div align="center"><input type="checkbox" name="checkall" value="" id="checkall" onclick="checkallinput('checkall','checkinput')"/></div></th>
        <th width="20%"><div align="left">Tên sản phẩm</div></th>
        <th width="10%"><div align="left">Số lượng</div></th>
        <th width="30%"><div align="center">Đơn giá</div></th>
        <th width="22%"><div align="center">Tổng tiền</div></th>
      </tr>
        <?php $total = 0; $i=0; foreach($cartdetails->all as $row):$i++;?>
        <tr>
            <td widtd="6%"><div align="center"><?php echo $i;?></div></td>
            <td><div align="center"><input type="checkbox" class="checkinput" value="<?=$row->id?>" name="checkinput[]" /></div></td>
            <td><?=$row->product->where('id', $row->product_id)->get()->name;?></td>
            <td><a href=""><?=$row->quantity;?></a></td>
            <td><div align="center"><?=number_format($row->product->where('id', $row->product_id)->get()->price, ',').' VND';?></div></td>
            <td><div align="center"><?=number_format($row->product->where('id', $row->product_id)->get()->price * $row->quantity, ',').' VND' ?></div></td>
        </tr>
        <?php
        $total+=($row->product->where('id', $row->product_id)->get()->price * $row->quantity);
        endforeach;?>
        <tr>
            <td colspan="5" align="center">Tổng tiền</td>
            <td colspan="1" align="center"><?=number_format($total, ',').' VND';?></td>
        </tr>
    </table>
   	<div style="padding-top:20px;"></div>
</form>
</div>
</div>
</div>