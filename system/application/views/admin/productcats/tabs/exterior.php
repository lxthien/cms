<h2>Ngoại thất</h2>
<textarea  name="txtExterior"><?php echo $object->txtExterior;?></textarea>
<script type="text/javascript">
    editorExterior = CKEDITOR.replace( 'txtExterior',
                        {
                            toolbar : 'Full',
                            height:500,
                            filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/',
                            htmlEncodeOutput: false,
                            entities: false
                        });
</script>