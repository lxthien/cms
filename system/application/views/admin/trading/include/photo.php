<script type="text/javascript" src="<?=$base_url;?>images/js/swfupload/js/swfupload/swfupload.js"></script>
<script type="text/javascript" src="<?=$base_url;?>images/js/swfupload/js/jquery.swfupload.js"></script>
<script type="text/javascript">

$(function(){
	$('#swfupload-control').swfupload({
		upload_url: "<?=$base_url?>img/upload-file.php",
		file_post_name: 'uploadfile',
		file_size_limit : "1024",
		file_types : "*.jpg;*.png;*.gif",
		file_types_description : "Image files",
		file_upload_limit : 5,
		flash_url : "<?=$base_url;?>images/js/swfupload/js/swfupload/swfupload.swf",
		button_image_url : '<?=$base_url;?>images/js/swfupload/js/swfupload/wdp_buttons_upload_114x29.png',
		button_width : 114,
		button_height : 29,
		button_placeholder : $('#button')[0],
		debug: false
	})
		.bind('fileQueued', function(event, file){
			var listitem='<li id="'+file.id+'" >'+
				'File: <em>'+file.name+'</em> ('+Math.round(file.size/1024)+' KB) <span class="progressvalue" ></span>'+
				'<div class="progressbar" ><div class="progress" ></div></div>'+
				'<p class="status" >Pending</p>'+
				'<span class="cancel" >&nbsp;</span>'+
				'</li>';
			$('#log').append(listitem);
			$('li#'+file.id+' .cancel').bind('click', function(){
				var swfu = $.swfupload.getInstance('#swfupload-control');
				swfu.cancelUpload(file.id);
				$('li#'+file.id).slideUp('fast');
			});
			// start the upload since it's queued
			$(this).swfupload('startUpload');
		})
		.bind('fileQueueError', function(event, file, errorCode, message){
			alert('Size of the file '+file.name+' is greater than limit');
		})
		.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){
			$('#queuestatus').text('Files Selected: '+numFilesSelected+' / Queued Files: '+numFilesQueued);
		})
		.bind('uploadStart', function(event, file){
			$('#log li#'+file.id).find('p.status').text('Uploading...');
			$('#log li#'+file.id).find('span.progressvalue').text('0%');
			$('#log li#'+file.id).find('span.cancel').hide();
		})
		.bind('uploadProgress', function(event, file, bytesLoaded){
			//Show Progress
			var percentage=Math.round((bytesLoaded/file.size)*100);
			$('#log li#'+file.id).find('div.progress').css('width', percentage+'%');
			$('#log li#'+file.id).find('span.progressvalue').text(percentage+'%');
		})
		.bind('uploadSuccess', function(event, file, serverData){
			var item=$('#log li#'+file.id);
			item.find('div.progress').css('width', '100%');
			item.find('span.progressvalue').text('100%');
			var pathtofile='<a href="<?=$base_url;?>img/project/'+file.name+'" target="_blank" >view &raquo;</a><input type="hidden" name="photo[]" value="'+file.name+'" />';
			item.addClass('success').find('p.status').html('Done!!! | '+pathtofile);
		})
		.bind('uploadComplete', function(event, file){
			// upload has completed, try the next one in the queue
			$(this).swfupload('startUpload');
		})
	
});	

</script>
<style type="text/css" >
#swfupload-control p{ margin:10px 5px; font-size:0.9em; }
#log{ margin:0; padding:0; width:500px;}
#log li{ list-style-position:inside; margin:2px; border:1px solid #ccc; padding:10px; font-size:12px; 
	font-family:Arial, Helvetica, sans-serif; color:#333; background:#fff; position:relative;}
#log li .progressbar{ border:1px solid #333; height:5px; background:#fff; }
#log li .progress{ background:#999; width:0%; height:5px; }
#log li p{ margin:0; line-height:18px; }
#log li.success{ border:1px solid #339933; background:#ccf9b9; }
#log li span.cancel{ position:absolute; top:5px; right:5px; width:20px; height:20px; 
	background:url('<?=$base_url;?>images/js/swfupload/js/swfupload/cancel.png') no-repeat; cursor:pointer; }
</style>
<div id="swfupload-control">
	<input type="button" id="button" />
	<p id="queuestatus" ></p>
	<ol id="log"></ol>
</div>


<table class="datatable" width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet" >
    
   	  <tr>
        <th width="2%"><div align="center">TT</div></th>
        <th width="2%"><div align="center"><input type="checkbox" name="checkall" value="" id="checkall" onclick="checkallinput('checkall','checkinput')"></div></th>
        <th width="11%"><div align="center">Image</div></th>
        <th width="11%"><div align="center">Caption</div></th>
        <th width="9%"><div align="center">Ngày nhập</div></th>
        <th width="17%"><div align="center">Công cụ</div></th>
      </tr>
        <?php $i=$this->uri->segment(5,0); foreach($photo as $row):$i++;?>
        <tr >
            <td widtd="6%"><div align="center"><?php echo $i;?></div></td>
            <td><div align="center"><input type="checkbox" class="checkinput" value="<?=$row->id?>" name="checkinput[]" ></div></td>
            <td widtd="68%"><div align="center"><img src="<?php  echo $base_url."img/project/".$row->link;?>" width="200" height="100" /></div></td>
            <td widtd="68%"><div align="center"><?=$row->caption;?></div></td>
            <td widtd="68%">
            <div align="center">
              <?=get_from_datetime($row->created);?>		
            </div>
			</td>
            <td widtd="26%">
              <div align="center">
           		<?php 
					echo create_link_table('delete_icon',$this->admin_url.'projects/deletePhoto/'.$row->id,'delete','return confirm ("Bạn có muốn xóa đối tượng này không ?")'); ?></div>		</td>
        </tr>	
        <?php endforeach;?>
        <tr class="footer">
                                    <td colspan="4">
									 <?php echo create_link_table('delete_inline','javascript:void(0);','Xóa chọn','actionallinput("delete","form","'.$this->admin_url.'projects/deletePhoto","checkinput")','Delete all');?> 
                                 
         							 </td>   
                                    <td colspan="2" align="right">
                                    <!--  PAGINATION START  -->             
                                    
                                       
                                    <!--  PAGINATION END  -->       
                                    </td>
        </tr>
    </table>