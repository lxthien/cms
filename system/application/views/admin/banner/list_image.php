<div id="portlets">
    <div class="column"></div>
    <div class="portlet">
        <div class="portlet-header fixed"><img src="<?=$this->admin_images;?>images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> <?=$title_table;?></div>
        <div class="portlet-content nopadding">
            <form name="myform" id="myform" method="post" >
                <?php $seg=$this->uri->segment(4,0);?>
                <table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
                    <tr>
                        <th width="2%"><div align="center">TT</div></th>
                        <th width="2%"><div align="center"><input type="checkbox" name="checkall" value="" id="checkall" onclick="checkallinput('checkall','checkinput')"></div></th>
                        <th width="11%"><div align="center">Banner</div></th>
                        <th width="11%"><div align="center">Tiêu đề</div></th>
                        <th width="9%"><div align="center">Ngày nhập</div></th>
                        <th width="10%"><div align="center">Position</div></th>
                        <th width="17%"><div align="center">Công cụ</div></th>
                    </tr>
                    <?php $i=$this->uri->segment(5,0); foreach($banner as $row):$i++;?>
                    <tr >
                        <td widtd="6%"><div align="center"><?php echo $i;?></div></td>
                        <td><div align="center"><input type="checkbox" class="checkinput" value="<?=$row->id?>" name="checkinput[]" /></div></td>
                        <td widtd="68%">
                            <div align="center">
                                <?php
                                    $path = pathinfo($base_url.$row->image);
                                    if($path['extension'] == 'swf') {
                                ?>
                                <object type="application/x-shockwave-flash" data="$base_url.$row->image" width="200" height="100">
                                    <param name="movie" value="$base_url.$row->image" />
                                    <param name="quality" value="high"/>
                                    <param name="wmode" value="transparent"/>
                                </object>
                                <?php } else {?>
                                <img src="<?=image($row->image,'product_cart')?>"  />
                                <?php } ?>
                            </div>
                        </td>
                        <td widtd="68%"><div align="center"><?=$row->name;?></div></td>
                        <td widtd="68%">
                            <div align="center">
                              <?=get_from_datetime($row->created);?>
                            </div>
                        </td>
                        <td></td>
                        <td widtd="26%">
                            <div align="center">
                                <?php
                                    echo create_link_table('delete_icon',$this->admin_url.'banners/delete_image/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")');
                                    echo create_link_table('edit_icon',$this->admin_url.'banners/edit/'.$row->bannercat_id."/".$row->id,'edit');
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    <tr class="footer">
                        <td colspan="5"></td>
                        <td colspan="2" align="right">
                        <!--  PAGINATION START  -->
                        <!--  PAGINATION END  -->
                        </td>
                    </tr>
                </table>
                <div style="padding-top:20px;"></div>
            </form>
        </div>
    </div>
</div>