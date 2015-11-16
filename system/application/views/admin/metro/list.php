<h3 style="text-align: center;">Vui lòng download hướng dẫn cách cấu hình metro <a href="<?=$base_url;?>img/guide/metro.docx">ở đây</a></h2>
<div id="portlets">
<div class="column"> 
</div>
	<div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title;?></div>
		<div class="portlet-content nopadding">
			<form name="myform" id="myform" method="post" >
				<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
					<thead>
						<tr>
							<th width="45">ID<img src="<?=$admin_resource;?>img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></th>
							<th width="283"><div align="left">Hình ảnh</div></th>
							<th width="849"><div align="left">Tiêu đề</div></th>
							<th width="95"><div align="center">Thao tác</div></th>	
						</tr>
					</thead>
					<tbody>
						<!--display menu parent content-->
						<?php $i=0; foreach($metro as $row): $i++;?>
							  <tr style="cursor: pointer;" onclick="window.location.href = '<?=$base_url.'admin/metros/edit/'.$row->id;?>'">
									<td class="a-center"><?php echo $i;?></td>
									<td>
										<img src="<?=image($row->img, "product_admin_list");?>"  />
									</td>
									<td>
										<div align="left"><?=$row->title;?></div>
									</td>
									<td>
										<div align="center">
											<?php 
												echo create_link_table('edit_icon',$base_url.'admin/metros/edit/'.$row->id,'Edit Metro');
												 
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