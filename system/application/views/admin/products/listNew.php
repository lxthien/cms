
<div id="portlets">
<div class="column"> 
</div>
 <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title_table;?></div>
		<div class="portlet-content nopadding">
<form name="frmListHot" id="frmListHot" method="post" >
   <?php $seg=$this->uri->segment(4,0);?>
	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
    
   	  <tr>
        <th width="3%"><div align="center">TT</div></th>
        <th width="3%"><div align="center"><input type="checkbox" name="checkall" value="" id="checkall" onclick="checkallinput('checkall','checkinput')"></div></th>
        <th ><div align="left">Hình</div></th>
        <th width="46%"><div align="left">Tên sản phẩm</div></th>
        <th width="12%"><div align="center">Giá</div></th>
        <th width="13%"><div align="left">Nhà sản xuất</div></th>
        <th width="33%"><div align="center">Vị trí</div></th>
      </tr>
        <?php $i=$this->uri->segment(5,0); foreach($products->all as $row):$i++;?>
        <tr style="cursor: pointer;" onclick="window.location.href = '<?=$this->admin_url.'products/edit/'.$row->id;?>'">
            <td widtd="6%"><div align="center"><?php echo $i;?></div></td>
            <td><div align="center"><input type="checkbox" class="checkinput" value="<?=$row->id?>" name="checkinput[]" /></div></td>
            <td>
                <a href="<?=$this->admin_url.'products/edit/'.$row->id;?>">
                    <img src="<?=image($row->image, "product_admin_list");?>" />
                </a>
            </td>
            <td widtd="68%"><a href="<?=$this->admin_url.'products/edit/'.$row->id;?>"><?php echo $row->name;?> <span style="color:#9C3">(<?=get_from_datetime($row->created);?>)</span></a></td>
            <td><div align="center"><?=number_format($row->price, 0).' VND'?></div></td>
            <td widtd="68%">
           		<div align="left"><?= $row->productmanufacture->where('id', $row->productmanufacture_id)->name;?></div>
			</td>
            <td widtd="26%">
                <div align="center">
                    <input type="text" style="width: 100px;" value="<?=$row->newPosition;?>" name="newPosition_<?=$row->id;?>" />
                </div>		
            </td>
        </tr>	
        <?php endforeach;?>
        <tr>
            <td></td>
            <td><div align="center"><input type="submit" name="submit" value="Xóa chọn" /></div></td>
            <td colspan="4"></td>
            <td>
                <div align="center"><input type="submit" name="submit" value="Cập nhật" /></div>
            </td>
        </tr>
        <tr class="footer">
            <td colspan="4">
               
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