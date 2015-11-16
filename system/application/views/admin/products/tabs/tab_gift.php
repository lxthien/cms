<h2>Khuyến mãi</h2>
<table class="table_input">
    <tr>
        <td><label for="name">Khuyến mãi:</label></td>
        <td><textarea  name="promotion"  class="smallInput medium" /><?=$object->promotion;?></textarea>
        <script type="text/javascript">
                editorGift = CKEDITOR.replace( 'promotion',
                                    {
                                        toolbar : 'Full',
                                        height:250,
                                        filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/'    
                                    });
                
            </script>
        
        </td>
    </tr>
    <tr>
        <td>Quà tặng:</td>
        <td>
            <textarea  name="txtGift"><?php echo $object->txtGift;?></textarea>
            <script type="text/javascript">
                editorGift = CKEDITOR.replace( 'txtGift',
                                    {
                                        toolbar : 'Full',
                                        height:250,
                                        filebrowserBrowseUrl : '<?=$base_url;?>resource/kfm/'    
                                    });
                
            </script>
        </td>
    </tr>
</table>

                                                                       