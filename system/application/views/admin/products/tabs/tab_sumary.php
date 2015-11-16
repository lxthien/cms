<h2>Tổng quan</h2>
<textarea  name="txtSumary"><?php echo $object->txtSumary;?></textarea>
<script type="text/javascript">
    editorSumary = CKEDITOR.replace( 'txtSumary',
                        {
                            toolbar : 'Full',
                            height:500,
                            filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/',
                            htmlEncodeOutput: false,
                            entities: false
                        });
    
</script>
                                                                       