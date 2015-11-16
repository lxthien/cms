<script type="text/javascript">
$().ready(function(){
		$('#fileupload').hide();
		$('#newbanner').click(function(){
			if($(this).attr("checked")==false)
				$('#fileupload').hide();
			else
				$('#fileupload').show();
		});
});
</script>
<div class="grid_15" id="textcontent">
                    <form id="form" class="table_input" action="<?=$base_url;?>admin/util/uploadTop" method="post" enctype="multipart/form-data">
                    
                        <table class="table_input">
                        	                 
                            <tr>
                            	<td><label>Hình hiện tại</label></td>
                                <td><img src="<?=$base_url."img/banner/".$cauhinh->value;?>" width="700" /></td>
                            </tr>
                           
                 			<tr>
                            	<td>Chọn hình :</td>
                                <td><input type="checkbox" id="newbanner" name="newimage"  value="1"/></td>
                            </tr>
                            <tr id="fileupload">
                             	<td>
                        			<label for="name">Chọn hình (1015x267):</label></td>
                                <td><input type="file" name="image" class="smallInput medium" /></td>
                            </tr>
                         </table>
                           <div class="clear"></div>
        <div class="button_bar">
                     <br /><br />
      
    	<?php create_form_button('submit_button button_ok','Save');?>
        <?php create_form_button('reset_button button_notok','Reset');?>
        </div>
                  
                    </form>
</div>