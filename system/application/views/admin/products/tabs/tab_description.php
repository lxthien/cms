<h2>Đặc tính kĩ thuật</h2>
<textarea  name="txtDescription"><?php echo $object->txtDescription;?></textarea>
<script type="text/javascript">
    editorDescription = CKEDITOR.replace( 'txtDescription',
                        {
                            toolbar : 'Full',
                            height:500,
                            filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/'    
                        });
</script>