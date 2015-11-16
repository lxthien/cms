<script type="text/javascript">
    function newProductSpec_init()
    {   
            $(".newProductSpecDialog").dialog("destroy");
            $(".newProductSpecDialog").dialog({
                height: 400,
                width:600,
                modal: true,
                autoOpen:false,
                title: "Thêm thuộc tính mới vào sp",
                open: function(){
                       $(":input[name='newProductSpec']").val("");
                       $(":input[name='newProductSpecId']").val("");
                }
             });
             $(".chooseNewProductSpec").click(function(){
                 showProductSpecDialog('newProductSpec','newProductSpecId');
             });
             $(".saveNewProductSpec").click(function(){
                 if($(":input[name='newProductSpecId']").val() == "")
                 {
                     showMessage("Vui lòng chọn thuộc tính");
                     return false;
                 }
                    $.ajax({
                       url: "<?=$base_url;?>admin/products/saveNewProductSpec/<?=$object->id;?>",
                       data: $("#frmNewProductSpecDialog").serialize(),
                       type: "POST",
                       dataType:"text",
                       success:function(data){
                           loadProductSpecByProduct();
                           showMessage("Thêm thông tin thành công.","success",function(){
                                $(".newProductSpecDialog").dialog("close");
                                activeTab("specific");
                           });
                           
                       } 
                    });
             });
    }
    
    
    function addNewProductSpec()
    {
        $(".newProductSpecDialog").dialog("open");
    }
</script>
<div class="newProductSpecDialog" style="display: none;">
    <form id="frmNewProductSpecDialog"   method="post">
        <table class="table_input">
            <tr>
                 <td>Chọn thuộc tính:</td>
                 <td>
                        <input type="text" readonly="readonly" name="newProductSpec" value="" style="float:left;" />
                        <input type="hidden" name="newProductSpecId" value=""  />
                        <a href="javascript:void(0)" class="chooseNewProductSpec" >Chọn</a>
                 </td>
            </tr>
            <tr >
                <td colspan="2"><?php create_form_button('saveNewProductSpec button_ok','Luu dữ liệu');?></td>
            </tr>
        </table>
    </form>
</div>