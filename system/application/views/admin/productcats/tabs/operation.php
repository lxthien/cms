<h2>Vận hành</h2>
<textarea  name="txtOperation"><?php echo $object->txtOperation;?></textarea>
<script type="text/javascript">
    editorOperation = CKEDITOR.replace( 'txtOperation',
                        {
                            toolbar : 'Full',
                            height:500,
                            filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/',
                            htmlEncodeOutput: false,
                            entities: false
                        });
</script>