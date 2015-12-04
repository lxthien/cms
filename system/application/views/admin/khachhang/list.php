<div id="portlets">
    <div class="column"></div>
    <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title;?></div>
    	<div class="portlet-content nopadding">
            <form name="myform" id="myform" method="post" >
                <table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
					<thead>
						<tr>
                        	<th width="39">ID<img src="<?=$admin_resource;?>img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></th>
                        	<th width="212"><div align="center">Logo</div></th>
                        	<th width="795"><div align="left">Tên đối tác</div></th>
                        	<th width="152"><div align="center">Position</div></th>
                            <th width="74"><div align="center">Action</div></th>
                        </tr>
					</thead>
					<tbody>
                      <?php $i=0; foreach($khachhang as $row): $i++;?>
                        <tr>
                            <td class="a-center"><?php echo $i;?></td>
                            <td><div align="center"><a href="<?=$this->admin_url;?>partner/edit/<?=$row->id;?>"><img src="<?=$base_url.$row->logo;?>" width="100"></a></div></td>
                            <td><a href="<?=$this->admin_url;?>partner/edit/<?=$row->id;?>"><?php echo $row->name_vietnamese;?></a></td>
                            <td><div align="center"><?=$row->position?></div></td>
                            <td>
                                <div align="center">
                        	    <?php 
                                    echo create_link_table('edit_icon',$base_url.'admin/partner/edit/'.$row->id,'Edit Product');
                                    echo create_link_table('delete_icon',$base_url.'admin/partner/delete/'.$row->id,'delete','return confirm ("Are you sure delete this item ?")');
                                ?>
                                </div>
                            </td>
                        </tr>
                      <?php  endforeach;?>            
					</tbody>
				</table>
            </form>
        </div>
    </div>
</div>     