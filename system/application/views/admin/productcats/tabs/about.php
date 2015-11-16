<h2>Giới thiệu</h2>
<textarea name="txtAbout"><?php echo $object->txtAbout; ?></textarea>
<script type="text/javascript">
    editorAbout = CKEDITOR.replace( 'txtAbout',
                        {
                            toolbar : 'Full',
                            height:500,
                            filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/',
                            htmlEncodeOutput: false,
                            entities: false
                        });
</script>