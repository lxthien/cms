<div id="portlets">
<div class="column"> 
</div>
 <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title;?></div>
		<div class="portlet-content nopadding">
<form name="myform" id="myform" method="post" >
<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
        <thead>
            <tr>
                <th width="69"><a href="#">ID</a></th>
                <th width="1443">Tên loại bds</th>
            
            
            </tr>
        </thead>
        <tbody>
                     <?php $i=0; foreach($category->all as $row):$i++;?>
                    <tr>
                        <td class="a-center"><div align="center"><?php echo $i;?></div></td>
                        <td><a href="<?=$this->admin_url;?>tradings/list_all/<?=$row->id;?>"><?php echo $row->name_vietnamese;?> <span style="color:red">(<?=$row->trading->get()->result_count();?>)</span></a></td>
                    </tr>
                
                  <?php    endforeach;?>
                            
        </tbody>
</table>
</form>
</div>
</div>
</div>
     