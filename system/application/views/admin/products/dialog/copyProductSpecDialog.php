<script type="text/javascript">
    function copySpecDialog_init()
    {
        $(".copyProductSpecDialog").dialog("destroy");
        $(".copyProductSpecDialog").dialog({
            height: 400,
            width:600,
            modal: true,
            autoOpen:false,
            title: "Copy thuộc tính từ dành mục khác",
            open: function(){
                   clearCopyProductDialog();
            }
         });
         
         $("#frmCopyProductSpec").submit(function(){
            if($(":input[name='productId']").val() == "")
            {
                showMessage("Vui lòng chọn sản phẩm nguồn.");
                return false;
            }
            return true;
         });
         
         
    }
    
    
    function clearCopyProductDialog()
    {
        $(":input[name='product']").val("");
        $(":input[name='productId']").val("");
        $(":input[name='OK']").val("");
        $(".copyAttribute").attr("checked",true);
    }
    
    function copyProductSpec()
    {
        $(".copyProductSpecDialog").dialog("open");
    }
    
    
    
</script>
<div class="copyProductSpecDialog" style="display: none;">
    <form id="frmCopyProductSpec"   method="post" action="<?=$base_url;?>admin/products/copyProduct">
        <table class="table_input table_chooseNewType">
            <tr>
                 <td>Sản phẩm nguồn:</td>
                 <td>
                        <input type="text" readonly="readonly" name="product" value="" style="float:left;" />
                        <input type="hidden" name="productId" value=""  />
                        <a href="javascript:void(0)" class="chooseProduct" >Chọn</a>
                 </td>
            </tr>
            
        </table>
        <table class="table_input">
            <tr class="copySpecButton">
                <td colspan="2"><?php create_form_button('submit_button button_ok','Luu dữ liệu');?></td>
            </tr>
        </table>
    </form>
</div>