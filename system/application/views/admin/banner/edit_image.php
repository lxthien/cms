<div class="grid_15" id="textcontent">             	
         <form id="frm" class="table_input" action="<?=$base_url;?>admin/banners/edit/<?=$banner->bannercat_id;?>/<?=$banner->id != '' ? $banner->id : 0;?>" method="post" enctype="multipart/form-data">
                        <table class="table_input">
                            <tr>
                             	<td>
                        			<label for="name">File đã nhập:</label></td>
                                <td>
                                <?php
                                    $path = pathinfo($base_url.$banner->image);
                                    if($path['extension'] == 'swf') {
                                ?>
                                    <object type="application/x-shockwave-flash" data="<?=$base_url.'img/banner/'.$banner->link?>" width="<?=$banner->width;?>" height="<?=$banner->height;?>">
                                        <param name="movie" value="<?=$base_url.$banner->image?>" />
                                        <param name="quality" value="high"/>
                                        <param name="wmode" value="transparent"/>
                                    </object>
                                <?php } else {?>
                                    <img src="<?=image($banner->image,'product_cart')?>" />
                                <?php } ?>
                            </tr>
                            <tr id="fileupload">
                             	<td>
                        			<label for="name">Chọn hình:</label></td>
                                <td><input type="file" name="image" class="smallInput medium" /></td>
                            </tr>
                            <tr>
                             	<td>
                        			<label for="title">Tên:</label></td>
                                <td><input type="text" name="name" class="smallInput medium" value="<?=$banner->name?>" /></td>
                            </tr>
                            <tr>
                             	<td>
                        			<label for="title">Link:</label></td>
                                <td><input type="text" name="link" class="smallInput medium" value="<?=$banner->link?>" /></td>
                            </tr>
                            <tr>
                             	<td>
                        			<label for="title">Rộng(dành cho banner flash):</label></td>
                                <td><input type="text" name="width" class="smallInput medium" value="<?=$banner->width?>" /></td>
                            </tr>
                            <tr>
                             	<td>
                        			<label for="title">Cao(dành cho banner flash):</label></td>
                                <td><input type="text" name="height" class="smallInput medium" value="<?=$banner->height?>" /></td>
                            </tr>
                        </table>
                        <div class="button_bar"><?php create_form_button('submit_button button_save','Save');?></div>
       	<div style="padding-top:50px;"></div>
		</form>
</div>