<form id="frmProductHome" method="post" action="<?=$base_url;?>admin/productcats/updateProductHomePosition/<?=$object->id;?>" >
<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
  <tr>
    <th width="3%"><div align="center">TT</div></th>
    
    <th ><div align="left">Hình</div></th>
    <th width="46%"><div align="left">Tên sản phẩm</div></th>
    <th width="12%"><div align="center">Giá</div></th>
    <th width="13%"><div align="left">Vị trí</div></th>
    <th width="33%"><div align="center">Xóa</div></th>
  </tr>
    <?php $i=$this->uri->segment(5,0); foreach($productHome as $row1):$i++;?>
    <?php $row = $row1->product;?>
    <tr style="cursor: pointer;" class="trProductHome<?=$row1->id;?>">
        <td widtd="6%"><div align="center"><?php echo $i;?></div></td>
        
        <td>
            <a href="<?=$this->admin_url.'products/edit/'.$row->id;?>">
                <img src="<?=image($row->image, "product_admin_list");?>" />
            </a>
        </td>
        <td widtd="68%"><a href="<?=$this->admin_url.'products/edit/'.$row->id;?>"><?php echo $row->name;?> <span style="color:#9C3">(<?=get_from_datetime($row->updated);?>)</span></a></td>
        <td><div align="center"><?=number_format($row->getRealPriceNum(), 0).' VND'?></div></td>
        <td widtd="68%">
       		<div align="left">
                <input name="productHomePosition_<?=$row1->id;?>" class="specPosition<?=$i;?>" value="<?=$row1->position;?>" style="width: 80px;"/>
            </div>
		</td>
        <td widtd="26%">
            <div align="center">
            <a href="javascript:void(0)" onclick="deleteProductHome(<?=$row1->id;?>)">Xóa</a>
            </div>		
        </td>
    </tr>	
    <?php endforeach;?>
    <tr class="footer">
        <td colspan="3">
            
        </td>
        <td colspan="2" align="right">
            <input type="submit" class="positionUpdate" value="Cập nhật vị trí" />
            <!--  PAGINATION START  -->             
           
            <!--  PAGINATION END  -->       
      </td>
      <td></td>
    </tr>
</table>
</form>