	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
    
   	  <tr>
        <th width="3%"><div align="center">TT</div></th>
        <th width="3%"><div align="center"><input type="checkbox" name="checkall" value="" id="checkall" checked=""></div></th>
        <th>Hình</th>
        <th width="46%"><div align="left">Tên sản phẩm</div></th>
        <th width="12%"><div align="center">Giá</div></th>
        <th width="13%"><div align="left">Nhà sản xuất</div></th>
        
      </tr>
        <?php $i=0; foreach($accessories->all as $row):$i++;?>
        <tr>
            <td widtd="6%"><div align="center"><?php echo $i;?></div></td>
            <td><div align="center"><input type="checkbox" class="checkinput chkAcc" value="<?=$row->id?>" name="checkinputacc"  checked="" /></div></td>
            <td><img src="<?=image($row->image, "product_admin_list");?>" /></td>
            <td widtd="68%"><a target="_blank" href="<?=$this->admin_url.'products/edit/'.$row->id;?>"><?php echo $row->name;?> <span style="color:#9C3">(<?=get_from_datetime($row->created);?>)</span></a></td>
            <td><div align="center"><?=number_format($row->price, 0).' VND'?></div></td>
            <td widtd="68%">
           		<div align="left"><?= $row->productmanufacture->where('id', $row->productmanufacture_id)->name;?></div>
			</td>
            
        </tr>	
        <?php endforeach;?>
     
        
    </table>
    <input type="button" value="Xóa phụ kiện đã chọn" class="btnDeleteAccess" />
    <script type="text/javascript">
        $(".chkAcc").attr("checked",false);
        $("#checkall").attr("checked",false);
        $(".btnDeleteAccess").click(function(){
             var str = "";
             $(".chkAcc:checked").each(function(){
                str += $(this).val() + "-";
             });
             $.ajax({
                url:"<?=$base_url;?>admin/products/deleteAccessories/<?=$object->id;?>",
                type:"post",
                datatype:"html",
                data:{sendData: str },
                success:function(data){
                    loadAccessories();
                }
             });
        });
    </script>