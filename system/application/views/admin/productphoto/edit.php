<script type="text/javascript">
    $().ready(function(){
        var i = 1;
       $(".addImage").live('click',function(){
            i++;
            var tr_item =$('<tr>'
             	+'<td><label for="name">Hình:</label></td>'
                +'<td><input type="file" name="image'+i+'"  /></td>'
                +'<td><label>Caption :</label></td>'
                +'<td><input type="text" name="caption'+i+'" class="smallInput medium"  /></td>'
                +'<td><a href="" class="addImage">Thêm hình</a> | <a href="" class="deleteImage">Xóa</a></td>'
                 +'<input type="hidden" value="'+i+'" name="numfile[]" /></tr>');
            $(".abc").append(tr_item);
            return false;
       });
       $(".deleteImage").live('click',function(){
            $(this).parents("tr").remove();
            return false;
       });
    });
    
</script>
<div class="grid_15" id="textcontent">
    <form id="form" class="table_input" action="<?=$base_url;?>admin/productphotos/edit/<?=$product_id?>" method="post" enctype="multipart/form-data">
        <table class="table_input abc">
            <tr>
             	<td><label for="name">Hình:</label></td>
                <td><input type="file" name="image1"  /></td>
                <td><label>Caption :</label></td>
                <td><input type="text" name="caption1" class="smallInput medium"  /></td>
                <td><a href="" class="addImage">Thêm hình</a> <input type="hidden" name="numfile[]" value="1" /></td>
            </tr>
        </table>
        <div class="clear"></div>
        <div class="button_bar">
        <br /><br />
        <?php create_form_button('submit_button button_ok','Save');?>
        <?php create_form_button('reset_button button_notok','Reset');?>
        </div>
    </form>
</div>