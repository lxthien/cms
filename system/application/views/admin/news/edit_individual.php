<script language="javascript" type="text/javascript" src="<?php echo $base_url;?>ckeditor/ckeditor.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $base_url;?>images/js/jquery.blockUI236.js"></script>
<script type="text/javascript" language="javascript">
function getcontent()
{
	return editor_vietnamese.getData();
}
	$().ready(function(){
		
		$('#container_language').tabs();
		
	});
</script>
<style type="text/css">
#review_box{
	width:690px;
	display:none;
	height:500px;
	overflow:auto;
	padding:15px;
}
.news-sub-left{
	width:658px;
	margin:0 auto;
	background-color:#FFF;
	display:inline;
}
.news-box-content{
	width:642px;
	height:inherit;
	border-top:0;
}
.title-news{
	color:#000000;
	font-family:Times New Roman;
	font-size:20px;
	font-weight:bold;
	padding-bottom:20px;
}
.news-box{
	width:650px;
	border:1px #6aa511 solid;
}
input[type="text"] {
		display:inherit !important;
	}
	form label {
	display:inherit !important;
	}
	.error{
		color:red;
	}
	.success{
		color:#0F0;
	}
</style>

<div class="grid_15" id="textcontent">
             	
                    <form id="form" class="table_input" action="<?=$base_url;?>admin/cnews/edit_individual/<?=$object->newscatalogue->id;?>/<?=$object->id;?>" method="post" enctype="multipart/form-data">
               
                        
                   <div id="container_language" style="margin-top:10px;">
                                        <ul>
                                         <?php foreach($sitelanguage as $row_lang):?>  
                                            <li ><a href="#<?=$row_lang->short;?>"><span><?=$row_lang->name;?></span></a></li>     
                                         <?php endforeach;?>
                                        </ul>
                                   
										  <?php foreach($sitelanguage as $row_lang):?>  
                                          	 <div id="<?=$row_lang->short;?>">  
                                                    <table class="table_input">
                                                     <tr>
                                                                <td>
                                                                    </td>
                                                                <td>
                                                                    <textarea  name="txtFull_<?=$row_lang->short;?>"><?php echo $object->{'full_'.$row_lang->short};?></textarea>
                                                                       <script type="text/javascript">
                                                                            //<![CDATA[
                                                            
                                                                                // This call can be placed at any point after the
                                                                                // <textarea>, or inside a <head><script> in a
                                                                                // window.onload event handler.
                                                            
                                                                                // Replace the <textarea id="editor"> with an CKEditor
                                                                                // instance, using default configurations.
                                                                                editor_<?=$row_lang->short;?>=CKEDITOR.replace( 'txtFull_<?=$row_lang->short;?>',
                                                                                                  {
                                                                                                        toolbar : [ [ 'Source', '-', 'Cut', 'Copy', 'Paste', '-', 'TextColor', 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'NumberedList', 'BulletedList', 'Outdent', 'Indent', '-', 'Link', 'Unlink', 'Anchor', '-' ],
                                                                ['Styles', 'Format', 'Font', 'FontSize', '-', 'Image', 'Flash', 'Table', 'HorizontalRule','MediaEmbed','flvPlayer']
                                                                 ],
                                                                                                        height:500,
                                                                                                         filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/'
                                                                                                         
                                                                                                         
                                                                                                    });
                                                                                
                                                            
                                                            
                                                                            //]]>
                                                                            </script>
                                                                </td>
                                                            
                                                      </tr>
                                                      </table>                                                               
                                                
                                            </div>
                                          <?php endforeach;?>
                  </div>
                      <div class="clear"></div>
        <div class="button_bar">
                     <br /><br />
      
    	<?php create_form_button('submit_button button_ok','Save');?>
        <?php create_form_button('reset_button button_notok','Reset');?>
        </div>
                  
                    </form>
</div>
<div id="review_box" style="display:none;">
	 <div class="news-sub-left" >
                       <div class="news-box" style="height:auto;">
                             <div class="news-box-content" style="height:auto;padding-top:5px;">
                             	<div class="title-news" style="text-align:left;"></div>
                           		<div class="content-news" style="text-align:left;"></div>
		                    
                             </div>
                        </div>
                    </div>
</div>