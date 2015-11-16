<h2>Nội thất</h2>
<textarea  name="txtInterior"><?php echo $object->txtInterior;?></textarea>
<script type="text/javascript">
    editorInterior = CKEDITOR.replace( 'txtInterior',
                        {
                            toolbar : 'Full',
                            height:500,
                            filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/',
                            htmlEncodeOutput: false,
                            entities: false
                        });
</script>