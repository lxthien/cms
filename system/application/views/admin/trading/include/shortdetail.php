<div class="InfoContent" style="margin-top:10px;">
        <ul>
         <?php foreach($sitelanguage as $row_lang):?>  
            <li ><a href="#summary_<?=$row_lang->short;?>"><span><?=$row_lang->name;?></span></a></li>     
         <?php endforeach;?>
        </ul>
        <?php foreach($sitelanguage as $row_lang):?>  
                <div id="summary_<?=$row_lang->short;?>" > 
                	<div>
                    		<textarea   name="txt_shortdetail_<?=$row_lang->short;?>" ><?php echo $object->{'shortdetail_'.$row_lang->short};?></textarea>
						   <script type="text/javascript">
                              
                                   editor_summary_<?=$row_lang->short;?> = CKEDITOR.replace( 'txt_shortdetail_<?=$row_lang->short;?>',{toolbar : 'News',height:500,filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/' });    
                            </script>
                     </div>   
                </div>
        <?php endforeach;?>
</div>