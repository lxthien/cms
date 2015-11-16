<style>
	.comment_respond {
		
	}
	.comment_respond .esc {
		float: right;
		color: red;
	}
	.comment_respond p label {
		float: left;
		width: 60px;
		padding: 5px 0;
	}
	.comment_respond .reply_cmt_left {
		float: left;
	}
	.comment_respond .reply_cmt_right {
		float: left;
		margin-left: 20px;
		width: 280px;
	}
	.comment_respond .comment_form_text{
		width: 273px;
		height: 57px;
	}
	.comment_respond .reply_btn {
		padding: 0;
		margin: 0;
	}
	.comment_respond .btn_send_idea{
		float: right;
	}
	.reply_btn span {
		float: left;
	}
	.clearfix {
		clear: both;
	}
	.bg_reply {
		background: #EDEDED;
		padding: 3px 0;
	}
	
	
</style>
<script type="text/javascript">
function addCommentForm(idcomment){
		var htmlForm = '<div class="comment_respond">';
		htmlForm += '<div class="fl ddv_ava">&nbsp;</div>';
		
			htmlForm += '<div class="fl bg_reply">';
				
				htmlForm += '<div class="comment_title">&nbsp;<a href="javascript:removeFormComment('+idcomment+');" class="esc">(Đóng Form trả lời)</a></div>';
				htmlForm += '<div class="comment_ct">';
				htmlForm += '<form class="comment_form">';
				
				htmlForm += '<div class="reply_cmt_left">';
				htmlForm += '<p><label>Tiêu đề:<span style="color: red;">*</span></label>';
				htmlForm += '<input id="rsubject" name="rsubject" type="text" value="" class="register_txt"></p>';
				htmlForm += '<p><label>Họ và tên:<span style="color: red;">*</span></label>';
				htmlForm += '<input id="rfullname" name="rfullname" type="text" value="" class="register_txt"></p>';
				htmlForm += '<p><label>Email:<span style="color: red;">*</span></label>';
				htmlForm += '<input id="remail" name="remail" type="text" value="" class="register_txt"></p>';
				htmlForm += '</div>';
				
				htmlForm += '<div class="reply_cmt_right">';
				htmlForm += '<p class="comment_ct_stt"><span>Nhận xét của bạn:<span style="color: red;">*</span></span></p>';
				htmlForm += '<textarea id="rcontent" name="rcontent" class="comment_form_text" rows="5" cols="20" ></textarea>';
				htmlForm += '</div>';
				
				htmlForm += '<div class="clearfix"></div>';
				htmlForm += '<p class="reply_btn"><label><span>Xác nhận:</span><span style="color: red;">*</span></label>';
				htmlForm += '<span><input  type="text" name="captcha_code"  maxlength="9" /></span>';
				htmlForm += '<span style="margin-left: 20px;"><img class="fl" id="captcha" src="<?=$base_url;?>securimage/securimage_show.php" alt="CAPTCHA Image" width="100" /></span>';
								
				htmlForm += '<input type="button" onclick="post_reply_comment()" value="GỬI" class="btn_send_idea"></p>';
				
				htmlForm += '<input type="hidden" value="' + idcomment + '" id="cparent" name="cparent" />';
				htmlForm += '</form> ';
				htmlForm += '</div><!-- END: comment_ct -->';
				
			htmlForm += '</div>';
			htmlForm += '<div class="clr"></div>'; 
		
		htmlForm += '</div><!-- END: comment_respond -->';
		// GET ID COMMENT
		var objAddForm = $('#item_comment_'+idcomment).children('.comment_item_ct');
		// INSERT to DIV comment
		var objForm = $('#item_comment_'+idcomment).children('div').eq(1).hasClass('comment_respond');
		if (objForm) { // IF True mean Had Comment form
			// REMOVE this FORM
			return;
		} else { // IF True mean Had NOT Comment form
			$(htmlForm).insertAfter(objAddForm);
			// NOW CAN write more code below for AJAX POST
		}
		return;
	}
	
	// FUNCTION remove COMMENT FORM when HAD FORM and cancle
	// PARAM: idcomment is ID of this comment
	function removeFormComment(idcomment){
		// INSERT to DIV comment
		var objForm = $('#item_comment_'+idcomment).children('div').eq(1).hasClass('comment_respond');
		if (objForm) { // IF True mean Had Comment form
			// REMOVE this FORM
			$('#item_comment_'+idcomment).children('.comment_respond').remove();
		}
		return;
	} 
	
function changeLikeDislike(type,id){
      var dataString = 'id='+ id + '&type=' + type;
      $("#product_flash_"+id).show();
      $("#product_flash_"+id).fadeIn(400).html('<img src="<?=$base_url;?>/images/loading_1.gif" />');
      $.ajax({
      type: "POST",
      url: "<?=$base_url;?>fproduct/like_dislike",
      data: dataString,
      cache: false,
      success: function(result){
               if(result){
                    var position=result.indexOf("||");
                    var warningMessage=result.substring(0,position);
                    if(warningMessage=='success'){
                         var successMessage=result.substring(position+2);
                         $("#product_flash_"+id).html('&nbsp;');
                         $("#product_"+type+"_"+id).html(successMessage);
                    }else{
                         var errorMessage=result.substring(position+2);
                         $("#product_flash_"+id).html(errorMessage);
                    }
              }
      }
      });
}
</script>
<?php foreach($comment as $row):?>
<div id="item_comment_<?=$row->id?>">
	<div class="comment_item_ct">
		<div class="cs_idea_line">
			<div class="fl ddv_ava"><img src="<?=$base_url?>images/ddv_ava.png" /></div>
			<div class="fl">
				<b><?=$row->name;?></b> <span class="font_grey">Gửi lúc <?php $date = date_create($row->creationDate); echo date_format($date, 'd/m/Y H:i:s');?></span>
				<div class="cmt_box">
					<?=$row->content;?>
				</div>
				<div>
					<a href="javascript:addCommentForm('<?=$row->id?>');"><img src="<?=$base_url?>images/answer.png" /></a>
					<font color="red">(<span id="product_like_<?=$row->id?>"><?=$row->likes?$row->likes:0;?></span>)</font>
					<img class="like_dislike_btn" src="<?=$base_url?>images/like.png" onclick=changeLikeDislike("like",<?=$row->id?>) />
					(<span id="product_dislike_<?=$row->id?>"><?=$row->dislikes?$row->dislikes:0;?></span>)
					<img class="like_dislike_btn" src="<?=$base_url?>images/dislike.png"  onclick=changeLikeDislike("dislike",<?=$row->id?>) />
					<font color="red"><span id="product_flash_<?=$row->id?>"></span></font>
				</div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
</div>
<?php endforeach;?>
