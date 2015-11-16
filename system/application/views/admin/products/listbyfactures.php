<?php $this->load->helper('get_date_from_sql');?>
<?php $this->session->set_flashdata(array('redirect_link'=>$this->uri->uri_string()));?>
<div id="portlets">
<div class="column"> 
</div>
 <div class="portlet">
    <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title;?></div>
	<div class="portlet-content nopadding">
    <form name="myform" id="myform" method="post" >
    <?php $seg=$this->uri->segment(4,0);?>
	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
   	  <tr>
        <th width="3%"><div align="center">TT</div></th>
        <th width="3%"><div align="center"><input type="checkbox" name="checkall" value="" id="checkall" onclick="checkallinput('checkall','checkinput')"></div></th>
        <th width="46%"><div align="left">Tên sản phẩm</div></th>
        <th width="12%"><div align="center">Giá</div></th>
        <th width="13%"><div align="center">Nhà sản xuất</div></th>
        <th width="33%"><div align="center">Công cụ</div></th>
      </tr>
        <?php
        if($products->result_count()==0){?>
        <tr>
            <td colspan="7">
                <p align="center">Không có sản phẩm thuộc danh mục này</p>
            </td>
        </tr>
        <?php
        }
        $i=$this->uri->segment(5,0); foreach($products->all as $row):$i++;?>
        <tr   >
            <td widtd="6%"><div align="center"><?php echo $i;?></div></td>
            <td><div align="center"><input type="checkbox" class="checkinput" value="<?=$row->id?>" name="checkinput[]" /></div></td>
            <td widtd="68%"><a href="<?=$this->admin_url.'products/edit/'.$row->productCatalogues_id.'/'.$row->id;?>"><?php echo $row->name;?> <span style="color:#9C3">(<?=get_from_datetime($row->created);?>)</span></a></td>
            <td><div align="center"><?=number_format($row->price, 0).' VND'?></div></td>
            <td widtd="68%">
           		<div align="center"><a href="<?=$base_url?>admin/productmanufactures/edit/<?=$row->productmanufacture->where('id', $row->productmanufacture_id)->id;?>"><?=$row->productmanufacture->where('id', $row->productmanufacture_id)->name;?></a></div>
			</td>
            <td widtd="26%">
              <div align="center">
                <?php if($row->active==1) 
                        echo create_link_table('approve_icon',$this->admin_url.'products/active/'.$row->id,'Vô hiệu');
                    else
                        echo create_link_table('reject_icon',$this->admin_url.'products/active/'.$row->id,'Kích hoạt');
					echo create_link_table('edit_icon',$this->admin_url.'products/edit/'.$row->id,'Edit News');
					echo create_link_table('delete_icon',$this->admin_url.'products/recycle/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")'); ?></div>		</td>
        </tr>	
        <?php endforeach;?>
        <tr class="footer">
            <td colspan="7">
            <?php echo create_link_table('delete_inline','javascript:void(0);','Xóa chọn','actionallinput("recycle","myform","'.$this->admin_url.'products/recycle/0/1","checkinput")','Delete all');?>
            <?php echo create_link_table('approve_inline','javascript:void(0);','Kích hoạt','actionallinput("active","myform","'.$this->admin_url.'products/active/0/1","checkinput")','Kích hoạt');?>
            <?php echo create_link_table('reject_inline','javascript:void(0);','Vô hiệu','actionallinput("deactive","myform","'.$this->admin_url.'products/active/0/0","checkinput")','Vô hiệu');?>
            <?php echo create_link_table('addhome_inline','javascript:void(0);','Hot Trang chủ','actionallinput("addhome","myform","'.$this->admin_url.'cnews/add_home/0/1","checkinput")','Hot Trang chủ');?>
            </td>
        </tr>
    </table>
    
                       

   	<div style="padding-top:20px;"></div>
</form>
</div>
</div>
</div>