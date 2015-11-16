<h2>Thông số kĩ thuật</h2>
<textarea name="txtSpecification"><?php echo $object->txtSpecification;?></textarea>
<script type="text/javascript">
    editorSpecification = CKEDITOR.replace( 'txtSpecification',
                        {
                            toolbar : 'Full',
                            height:500,
                            filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/',
                            htmlEncodeOutput: false,
                            entities: false
                        });
</script>