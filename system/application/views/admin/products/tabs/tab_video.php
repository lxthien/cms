<h2>Tính năng</h2>
<textarea  name="txtVideo"><?php echo $object->txtVideo;?></textarea>
<script type="text/javascript">
    editorVideo = CKEDITOR.replace( 'txtVideo',
                        {
                            toolbar : 'Full',
                            height:500,
                            filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/'    
                        });
    
</script>
                                                                       