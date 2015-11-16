<script type="text/javascript">
$().ready(function(){
    $(".deleteComment").click(function(){
        $.ajax({
           url: $(this).attr("href"),
           type: "get",
           dataType:"text",
           success:function(data){
               showMessage("Xóa thành công.","success"); 
           } 
        }); 
        $(this).parents('tr.commentItem').remove();
        return false;
    });
    $(".editComment").click(function(){
        $.ajax({
           url: $(this).attr("href"),
           type: "get",
           dataType:"json",
           success:function(data){
                clearCommentDialog(data);
                $(".addCommentDialog").dialog("open");
           } 
        }); 
        return false;
    });
});
</script>
<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
    <tr>
        <th width="3%"><div align="center">ID</div></th>
        <th width="5%"><div align="center"><input type="checkbox" name="checkall" value="" id="checkall" onclick="checkallinput('checkall','checkinput')"/></div></th>
        <th width="15%"><div align="left">Title</div></th>
        <th width="15%"><div align="left">Name</div></th>
        <th width="15%"><div align="left">Email</div></th>
        <th width="15%"><div align="center">Phone</div></th>
        <th width="28%"><div align="left">Content</div></th>
        <th width="20%"><div align="center">Công cụ</div></th>
    </tr>
        <?php
        if($productcomments->result_count()==0){?>
        <tr>
            <td colspan="9">
                <p align="center">Chưa có bình luận nào cho sản phẩm này.</p>
            </td>
        </tr>
        <?php
        }
        $i=0; foreach($productcomments->all as $row):$i++;?>
        <tr class="commentItem">
            <td widtd="6%"><div align="center"><?=$i;?></div></td>
            <td><div align="center"><input type="checkbox" class="checkinput" value="<?=$row->id?>" name="checkinput[]" /></div></td>
            <td><div align="left"><?=$row->title; ?></div></td>
            <td><?=$row->name; ?></td>
            <td><div align="left"><?=$row->email; ?></div></td>
            <td><div align="left"><?=$row->phone; ?></div></td>
            <td><div align="left"><?=$row->content; ?></div></td>
            <td><div align="center">
                <?php
					echo create_link_table('edit_icon editComment',$this->admin_url.'productcomments/edit/'.$row->product_id.'/'.$row->id,'Edit News');
					echo create_link_table('delete_icon deleteComment',$this->admin_url.'productcomments/delete/'.$row->id,'delete'); ?></div>		</td>
        </tr>	
        <?php endforeach;?>
        <tr class="footer">
            <td colspan="9" align="right"></td>
        </tr>
</table>