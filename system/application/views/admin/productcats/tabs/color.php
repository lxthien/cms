<h2>Màu sắc</h2>
<textarea  name="txtColor"><?php echo $object->txtColor;?></textarea>
<script type="text/javascript">
    editorColor = CKEDITOR.replace( 'txtColor',
                        {
                            toolbar : 'Full',
                            height:500,
                            filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/',
                            htmlEncodeOutput: false,
                            entities: false
                        });
</script>