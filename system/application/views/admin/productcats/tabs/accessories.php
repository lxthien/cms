<h2>Phụ kiện</h2>
<textarea name="txtAccessories"><?php echo $object->txtAccessories; ?></textarea>
<script type="text/javascript">
    editorAccessories = CKEDITOR.replace( 'txtAccessories',
                        {
                            toolbar : 'Full',
                            height:500,
                            filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/',
                            htmlEncodeOutput: false,
                            entities: false
                        });
</script>