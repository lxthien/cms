<script type="text/javascript" src="<?=$base_url;?>images/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" href="<?=$base_url;?>images/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript">
$().ready(function(){
	$("a.fancylink").fancybox({
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false,
		'width'         :	600,
		'height'		:   400,
		'padding'  	 	:   '0'
	});
})
</script>
<div id="portlets">
    <div class="column"></div>
    <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title;?></div>
        <div class="portlet-content nopadding">
            <form name="myform" id="myform" method="post" >
                <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
                    <thead>
                        <tr>
                            <th width="32"><a href="#">ID</a></th>
                            <th width="300">Mục</th>
                            <th width="80"><div align="left">Họ tên</div></th>
                            <th width="195"><div align="left">Email</div></th>
                            <th width="135"><div align="center">Ngày gửi</div></th>
                            <th width="68"><div align="center">Action</div></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach($contact->all as $row):
                        $i++; ?>
                            <!--display menu parent content-->
                            <tr>
                                <td class="a-center"><div align="center"><?php echo $i;?></div></td>
                                <td>
                                    <a class="fancylink" href="<?=$this->admin_url;?>contacts/edit/<?=$row->id;?>">
                                        <?php
                                            if($row->cat == 4){
                                                echo 'Cá nhân';
                                            }elseif($row->cat == 5){
                                                echo 'Công ty';
                                            }
                                        ?>
                                    </a>
                                </td>
                                <td><?=$row->name;?></td>
                                <td><?=$row->email;?></td>
                                <td>
                                    <?=get_from_datetime($row->created);?>
                                </td>
                                <td>
                                    <div align="center">
                                    <?php
                                        echo create_link_table('delete_icon',$this->admin_url.'contacts/delete/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")');
                                    ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>