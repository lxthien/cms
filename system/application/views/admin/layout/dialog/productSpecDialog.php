<script type="text/javascript">
var productSpecText = "";
var productSpecHi = "";
var productSpecCallback = "";
$().ready(function(){
    initProductSpecDialog();
    productDialog_init();
});
function initProductSpecDialog()
{
    $(".ProductSpecDialog").dialog({
        height: 600,
        width:700,
        modal: true,
        autoOpen:false,
        title: "Chọn danh sách thuộc tính của sản phẩm"
    });
}
function showProductSpecDialog(textElement,hiddenElement)
{
     textElement = typeof textElement !== 'undefined' ? textElement : "productSpecText";
     hiddenElement = typeof hiddenElement !== 'undefined' ? hiddenElement : "productSpecId";
    productSpecText = textElement;
    productSpecHi = hiddenElement;
    loadDefaultContentForProductSpecDialog();
    $(".ProductSpecDialog").dialog("open");
}
function hideProductSpecDialog()
{
    $(".ProductSpecDialog").dialog("close");
}
function loadDefaultContentForProductSpecDialog()
{
    $.ajax({
        url:'<?=$base_url;?>admin/dialogmanager/productSpecDialog',
        dataType: "html",
        success : function(data){
            $(".ProductSpecDialog").html(data);
        }
    })
}



//add dialog handle

function productDialog_addGenSpec()
{
    productDialog_resetData();
    $("#frmAddGenSpec .addSpecButton").show();
    $("#frmAddGenSpec .editSpecButton").hide();
    $(".addGenSpecDialog").dialog("open");
    
}

function productDialog_resetData()
{
    $("#frmAddGenSpec :input[name='specName']").val("");
    $("#frmAddGenSpec textarea[name='specDescription']").val("");
    $("#frmAddGenSpec :input[name='specGroupText']").val("");
    $("#frmAddGenSpec :input[name='specGroupId']").val("");
    $("#frmAddGenSpec :input[name='specType']:eq(0)").attr("checked",true);
    $("#frmAddGenSpec :input[name='specNewType']:eq(0)").attr("checked",true);
    $("#frmAddGenSpec input[name='productSpecText']").val("");
    $("#frmAddGenSpec input[name='productSpecId']").val("");
    $(".tr_group").show();
    $("#frmAddGenSpec").validate().resetForm();
    $("#frmAddGenSpec :input").removeClass("error");
}
function productDialog_editShow()
{
    $("#frmAddGenSpec .addSpecButton").hide();
    $("#frmAddGenSpec .editSpecButton").show();
    $(".addGenSpecDialog").dialog("open");
}

function productDialog_init()
{
    $(".addGenSpecDialog").dialog("destroy");
    $(".addGenSpecDialog").dialog({
        height: 400,
        width:600,
        modal: true,
        autoOpen:false,
        title: "Thêm thuộc tính mới",
        open: function(){
            productDialog_specTypeChange();
        }
     });
    
     productDialog_event();
    productDialog_specTypeChange();
     
}
function productDialog_specTypeChange()
{
    if($("#frmAddGenSpec :input[name='specType']:checked").val() == "1")
    {
        $("#frmAddGenSpec .tr_spec").show();
    }
    else
    {
        $("#frmAddGenSpec input[name='specGroupText']").val("");
         $("#frmAddGenSpec input[name='specGroupId']").val("");
        $("#frmAddGenSpec .tr_spec").hide();
    }
}


function productDialog_event()
{
    $("#frmAddGenSpec :input[name='specType']").change(function(){
        addSpecDialog_specTypeChange();
    });
    $("#frmAddGenSpec :input[name='specNewType']").change(function(){
        addSpecDialog_specNewTypeChange();
    });
    
    $("#frmAddGenSpec .clearSpecGroup").click(function(){
         $("input[name='specGroupText']").val("");
         $("input[name='specGroupId']").val("");
    });
    $("#frmAddGenSpec .addSpecSubmit").click(function()
    {
        if($("#frmAddGenSpec").valid())
        {
            $.ajax({
               url: "<?=$base_url;?>admin/productgenspecs/addGenSpec/",
               data: $("#frmAddGenSpec").serialize(),
               type: "POST",
               dataType:"text",
               success:function(data){
                    loadDefaultContentForProductSpecDialog();
                    $(".addGenSpecDialog").dialog("close");
               } 
            });
            
        }
        return false;
    });
    
    $("#frmAddGenSpec .editSpecSubmit").click(function()
    {
        if($("#frmAddGenSpec").valid())
        {
            $.ajax({
               url: "<?=$base_url;?>admin/productgenspecs/editGenSpec/",
               data: $("#frmAddGenSpec").serialize(),
               type: "POST",
               dataType:"text",
               success:function(data){
                    loadDefaultContentForProductSpecDialog();
                    $(".addGenSpecDialog").dialog("close");
               } 
            });
           
        };
         return false;
    });
    
    $(":input[name='specType']").click(function(){
        if($(":input[name='specType']:checked").val() == "1")
        {
            $(".tr_group").show();
        }   else
        {
            $(".tr_group").hide();
        }
    });
    
    
    
     $("#frmAddGenSpec").validate({
        rules:{
            specName:{required:true},
            specGroupText:{
                required:{
                    depends: function(element) {
        				return $(":input[name='specType']:checked").val() == "1";
        			}
                }
            }
        }
     });
}

//edit part

function productDialog_editGenSpec(specId)
{
    $.ajax({
           url: "<?=$base_url;?>admin/productgenspecs/loadSpecInfo/"+specId,
           type: "GET",
           dataType:"json",
           success:function(data){
                $("#frmAddGenSpec input[name='specName']").val(data.name);
                $("#frmAddGenSpec textarea[name='specDescription']").val(data.description);
                if(data.isGroup == "1")
                {
                    $("#frmAddGenSpec  input[name='specType']:eq(1)").attr("checked",true);
                }
                else
                {
                    $("#frmAddGenSpec input[name='specType']:eq(0)").attr("checked",true);
                }
                $("#frmAddGenSpec input[name='specGroupText']").val(data.parentcatName);
                $("#frmAddGenSpec input[name='specGroupId']").val(data.parentcat_id);
                $("#frmAddGenSpec :input[name='specElementType']").val(data.specElementType);
                $("#frmAddGenSpec").attr("action","<?=$base_url;?>admin/productcats/editSpec/"+data.id);
                productDialog_editShow();
                
           } 
    });  
}

</script>
<div class="ProductSpecDialog">
    
</div>


<div class="addGenSpecDialog" style="display: none;">
    <form id="frmAddGenSpec"  action="" method="post">
        <table class="table_input">
            <tr>
                <td><label>Tên:<span style="color: red;">*</span></label></td>
                <td><input type="text" name="specName" value="" class="smallInput medium" /></td>
            </tr>
            <tr>
                <td><label>Description:</label></td>
                <td><textarea name="specDescription" class="smallInput medium" rows="4"></textarea></td>
            </tr>
            <tr>
                <td><label>Loại dữ liệu:</label></td>
                <td><select name="specElementType">
                      <option value="TEXT">Ô nhập thường</option>
                      <option value="TEXTAREA">Ô nhập lớn</option>
                </select></td>
            </tr>
            <tr>
                <td><label>Loại:</label></td>
                <td>
                    <input type="radio" name="specType" value="1" checked="checked" />Thuộc tính
                    <input type="radio" name="specType" value="2" />Nhóm
                </td>
            </tr>
            <tr class="tr_group">
                <td><label>Thuộc nhóm:<span style="color: red;">*</span></label></td>
                <td>
                    <input type="text" name="specGroupText" value="" readonly="readonly" class="smallInput medium fl"   />
                    <a href="javascript:void(0)" class="chooseSpecGroup">Chọn nhóm</a>
                    <a href="javascript:void(0)" class="clearSpecGroup">Clear</a>
                    <input type="hidden" name="specGroupId" value="" class="smallInput medium" /><br />
                    <label class="error" for="specGroupText" generated="true"></label>
                </td>
            </tr>
        </table>
        <table class="table_input">
            <tr class="addSpecButton">
                <td colspan="2"><?php create_form_button('addSpecSubmit button_ok','Luu dữ liệu');?></td>
               
            </tr>
            <tr class="editSpecButton">
                <td colspan="2"><?php create_form_button('editSpecSubmit button_ok','Luu dữ liệu');?></td>
               
            </tr>
        </table>
    </form>
</div>