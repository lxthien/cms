<script type="text/javascript">
    function addComment_init()
    {      
            $(".addCommentDialog").dialog("destroy");
            $(".addCommentDialog").dialog({
                height: 450,
                width:700,
                modal: true,
                autoOpen:false,
                title: "Bình luận",
                open:function(){
                    
                }
             });
             
             $(".saveComment").click(function(){
                 if($("#frmAddCommentDialog").valid())
                 {
                    $.ajax({
                       url: "<?=$base_url;?>admin/productcomments/edit/<?=$object->id;?>",
                       data: $("#frmAddCommentDialog").serialize(),
                       type: "POST",
                       dataType:"json",
                       success:function(data){
                           loadComments();
                           $(".addCommentDialog").dialog("close");
                           activeTab("comment");
                           showMessage("Cập nhật bình luận thành công.","success");
                           
                       } 
                    });
                 }
             });
             $("#frmAddCommentDialog").validate({
                rules:{
                    title:{required:true},
                    name:{required:true},
                    email:{
                        required:true,
                        email:true
                    },
                    content:{
                        required: true
                    }
                }
             });
             
             
             
    }
    
    function clearCommentDialog(comment)
    {
        if(typeof comment == "undefined")
        {
            $("#frmAddCommentDialog :input[name='title']").val("");
            $("#frmAddCommentDialog :input[name='name']").val("");
            $("#frmAddCommentDialog :input[name='email']").val("");
            $("#frmAddCommentDialog :input[name='content']").val("");   
            $("#frmAddCommentDialog :input[name='creationDate']").val("");
            $("#frmAddCommentDialog :input[name='commentId']").val("");
            
        }
        else
        {
            $("#frmAddCommentDialog :input[name='commentId']").val(comment.id);
            $("#frmAddCommentDialog :input[name='title']").val(comment.title);
            $("#frmAddCommentDialog :input[name='name']").val(comment.name);
            $("#frmAddCommentDialog :input[name='email']").val(comment.email);
            $("#frmAddCommentDialog :input[name='content']").val(comment.content);   
            $("#frmAddCommentDialog :input[name='creationDate']").val(comment.creationDate);
        }
    }
    
    function addComent()
    {
        clearCommentDialog();
        $(".addCommentDialog").dialog("open");
    }
</script>
<div class="addCommentDialog" style="display: none;">
    <form id="frmAddCommentDialog" action=""   method="post">
        <input type="hidden" name="commentId" value="" />
        <table class="table_input">
                <tr>
                    <td><label for="name">Tiêu đề:</label></td>
                    <td><input type="text" name="title" value="" class="smallInput medium" /></td>
                </tr>
                <tr>
                    <td><label for="name">Tên:</label></td>
                    <td><input type="text" name="name" value="" class="smallInput medium" /></td>
                </tr>
                <tr>
                    <td><label for="name">Email:</label></td>
                    <td><input type="text" name="email" value="" class="smallInput medium" /></td>
                </tr>
                <tr>
                    <td><label for="name">Nội dung:</label></td>
                    <td><textarea rows="5" name="content" class="smallInput medium"></textarea></td>
                </tr>
                <tr>
                    <td><label for="name">Ngày giờ đăng<br>(yyyy-mm-dd hh:ii:ss)<br />(2012-12-24 10:12:59):</label></td>
                    <td><input  name="creationDate" class="smallInput medium" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="button_bar">
                        <?php create_form_button('saveComment button_ok','Lưu dữ liệu');?>
                        <div class="clear"></div>
                        </div>
                    </td>
                </tr>
        </table>
    </form>
</div>