<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
      <tr>
        <th width="3%"><div align="center">ID</div></th>
        <th width="8%"><div align="center"><input type="checkbox" name="checkall" value="" id="checkall" onclick="checkallinput('checkall','checkinput')"/></div></th>
        <th width="30%"><div align="left">Image</div></th>
        <th width="35%"><div align="left">Thông tin</div></th>
        <th width="15%"><div align="center">Vị trí</div></th>
        <th width="30%"><div align="center">Công cụ</div></th>
      </tr>
        <?php
        if($productphotos->result_count()==0){?>
        <tr>
            <td colspan="6">
                <p align="center">Chưa có hình ảnh nào cho sản phẩm này.</p>
            </td>
        </tr>
        <?php
        }
        $i=0; foreach($productphotos as $row):$i++;?>
        <tr>
            <td widtd="6%"><div align="center"><?=$i;?></div></td>
            <td><div align="center"><input type="checkbox" class="checkinput" value="<?=$row->id?>" name="checkinput[]" /></div></td>
            <td widtd="68%"><img width="80px" height="100px" src="<?=$base_url?><?=$row->path;?>" alt="Hình" /></td>
            <td><div align="left">URL: <?=$row->path?></div></td>
            <td widtd="68%">
           		<div align="center"><input name="positionPhoto_<?=$row->id;?>" class="photoPosition<?=$i;?>" value="<?=$row->position;?>" style="width: 80px;"/></div>
    		</td>
            <td widtd="26%">
              <div align="center">
                <?php
    				
    				echo create_link_table('delete_icon',$this->admin_url.'productphotos/delete/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")'); ?></div>		</td>
        </tr>	
        <?php endforeach;?>
        
</table>