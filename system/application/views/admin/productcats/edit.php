<script language="javascript" type="text/javascript" src="<?php echo $base_url;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	$(document).ready( function() {
        $('#container_tab').tabs();
        addSpecDialog_init();
        copySpecDialog_init();
        $(".chooseCopyProductCategory").click(function(){
             showProductCategoryDialog("productCategoryCopy","productCategoryCopyId");
        });
        
        
        $(":input[name='positionUpdate']").click(function()
        {
            $.ajax({
               url: '<?=$base_url;?>admin/productcats/updateCatSpecPosition/<?=$object->id;?>',
               data: $("#frmProductCatSpec").serialize(),
               type: "POST",
               dataType:"text",
               success:function(data){
                    reloadSpecList();
               } 
            });
        });
        
        
        
        $("#frmProductCatEdit").validate({
            rules:{
                name:{
                    required:true
                },
                url:{
                    required:true,
                    remote:{
                        url:'<?=$base_url;?>admin/productcats/checkUrlUnique/<?=$object->id;?>',
                        type:'post',
                        data:{
                            url:function(){ return $(":input[name='url']").val();}
                        }
                    }
                }
            },
            messages:{
                url:{
                    remote:"url này đã tồn tại trong hệ thống."
                }
            }
        });
        $(":input[name='name']").keyup(function(){
                $(":input[name='url']").val(remove_vietnamese_accents($(this).val())); 
        });
	});
    
    function copySpecDialog_init()
    {
        $(".copySpecDialog").dialog("destroy");
        $(".copySpecDialog").dialog({
            height: 400,
            width:600,
            modal: false,
            autoOpen:false,
            title: "Copy thông số từ dành mục khác",
            open: function(){
                
            }
         });
         
         
        $(".copySpecSubmit").click(function()
        {
            if($(":input[name='productCategoryCopyId']").val() == "")
            {
                showMessage("Vui lòng chọn sản phẩm nguồn.");
                return false;
            }
            if($.trim($(":input[name='OK']").val()) != "OK")
            {
                showMessage("Vui lòng nhập OK để tiếp tục.");
                return false;
            }
            $.ajax({
               url: "<?=$base_url;?>admin/productcats/copySpec/<?=$object->id;?>",
               data: $("#frmCopySpec").serialize(),
               type: "POST",
               dataType:"text",
               success:function(data){
                    reloadSpecList();
                    $(".copySpecDialog").dialog("close");
                    showMessage("Copy thành công.","success");
                    activeTab("specification");
               } 
            });
            return false;
        });
    }
    function copySpecDialog_show()
    {
        //reset data
        $("input[name='productCategoryCopy']").val("");
        $("input[name='productCategoryCopyId']").val("");
        $("input[name='OK']").val("");
        $(".copySpecDialog").dialog("open");
        
    }
    function addSpecDialog_show()
    {
        addSpecDialog_resetData();
        $(".addSpecButton").show();
        $(".editSpecButton").hide();
        $(".addSpecDialog").dialog("open");
        $(".table_chooseNewType").show();
        $(".table_chooseSpec").show();
        $(".table_newSpec").hide();
        
    }
    function editSpecDialog_show()
    {
        $(".addSpecButton").hide();
        $(".editSpecButton").show();
        
        $(".addSpecDialog").dialog("open");
        $(".table_chooseNewType").hide();
        $(".table_chooseSpec").hide();
        $(".table_newSpec").show();
    }
    function addSpecDialog_resetData()
    {
        $(":input[name='specName']").val("");
        $("textarea[name='specDescription']").val("");
        $(":input[name='specGroupText']").val("");
        $(":input[name='specGroupId']").val("");
        $(":input[name='specType']:eq(0)").attr("checked",true);
        $(":input[name='specNewType']:eq(0)").attr("checked",true);
        $("input[name='productSpecText']").val("");
        $("input[name='productSpecId']").val("");
    }
    function addSpecDialog_init()
    {
        $(".addSpecDialog").dialog("destroy");
        $(".addSpecDialog").dialog({
            height: 400,
            width:600,
            modal: false,
            autoOpen:false,
            title: "Thêm thuộc tính mới",
            open: function(){
                addSpecDialog_specTypeChange();
                addSpecDialog_specNewTypeChange();
            }
         });
         
         addSpecDialog_event();
         addSpecDialog_specTypeChange();
         
    }
    function addSpecDialog_specTypeChange()
    {
        if($(":input[name='specType']:checked").val() == "1")
        {
            
            $(".tr_spec").show();
        }
        else
        {
            $("input[name='specGroupText']").val("");
             $("input[name='specGroupId']").val("");
            $(".tr_spec").hide();
        }
    }
    
    
    
    function addSpecDialog_specNewTypeChange()
    {
        if($(":input[name='specNewType']:checked").val() == "1")
        {
            $(".table_chooseSpec").show();
            $(".table_newSpec").hide();
        }
        else
        {
            $(".table_chooseSpec").hide();
            $(".table_newSpec").show();
            $("input[name='productSpecText']").val("");
            $("input[name='productSpecId']").val("");
        }
    }
    function reloadSpecList()
    {
        $(".addSpecDialog").dialog("close");
        $.ajax({
               url: "<?=$base_url;?>admin/productcats/loadSpec/<?=$object->id;?>",
               type: "GET",
               dataType:"text",
               success:function(data){
                    $("#specification").html(data);
               } 
            });
    }
    function addSpecDialog_event()
    {
        $(":input[name='specType']").change(function(){
            addSpecDialog_specTypeChange();
        });
        $(":input[name='specNewType']").change(function(){
            addSpecDialog_specNewTypeChange();
        });
        
        $(".clearSpecGroup").click(function(){
             $("input[name='specGroupText']").val("");
             $("input[name='specGroupId']").val("");
        });
        $("#frmAddSpec .addSpecSubmit").click(function()
        {
            if($(":input[name='productSpecId']").val() == "")
            {
                showMessage("Vui lòng chọn thông số cần thêm.");
                return false;
            }
            $.ajax({
               url: "<?=$base_url;?>admin/productcats/addSpec/<?=$object->id;?>",
               data: $("#frmAddSpec").serialize(),
               type: "POST",
               dataType:"text",
               success:function(data){
                    reloadSpecList();
                    $(".addSpecDialog").dialog("close");
                    showMessage("Thêm thông số thành công.","success");
                    activeTab("specification");
               } 
            });
            return false;
        });
        
        $("#frmAddSpec .editSpecSubmit").click(function()
        {
            $.ajax({
               url: $("#frmAddSpec").attr("action"),
               data: $("#frmAddSpec").serialize(),
               type: "POST",
               dataType:"text",
               success:function(data){
                    reloadSpecList();
               } 
            });
        });
    }
    
    
     function activeTab(tabName)
    {
        $(".ui-tabs-nav li").each(function(){
          
           if($(this).children("a").attr("href") == "#"+tabName)
           {
                var tabIndex = $(".ui-tabs-nav li").index($(this)); 
                $( "#container_tab" ).tabs( "option", "selected",tabIndex );
           } 
        });
        
    }
    //edit part
    
    function editSpec(specId)
    {
        $.ajax({
               url: "<?=$base_url;?>admin/productcats/loadSpecInfo/"+specId,
               type: "GET",
               dataType:"json",
               success:function(data){
                    $("#frmAddSpec input[name='specName']").val(data.name);
                    $("#frmAddSpec textarea[name='specDescription']").val(data.description);
                    if(data.isGroup == "1")
                    {
                        $("#frmAddSpec  input[name='specType']:eq(1)").attr("checked",true);
                    }
                    else
                    {
                        $("#frmAddSpec input[name='specType']:eq(0)").attr("checked",true);
                    }
                    $("#frmAddSpec input[name='specGroupText']").val(data.parentcatName);
                    $("#frmAddSpec input[name='specGroupId']").val(data.parentcat_id);
                    $("#frmAddSpec :input[name='specElementType']").val(data.specElementType);
                    $("#frmAddSpec").attr("action","<?=$base_url;?>admin/productcats/editSpec/"+data.id);
                    editSpecDialog_show();
                    
                    
               } 
        });  
    }
    
    function deleteCatSpec(specId)
    {
        $.ajax({
               url: "<?=$base_url;?>admin/productcats/deleteSpec/"+specId,
               type: "GET",
               dataType:"json",
               success:function(data){
                   reloadSpecList(); 
               } 
        });  
    }
    
    function deleteProductHome(productHomeId)
    {
        $.ajax({
               url: "<?=$base_url;?>admin/productcats/deleteProductHome/"+productHomeId,
               type: "GET",
               dataType:"text",
               success:function(data){
                  $(".trProductHome"+productHomeId).remove();
               } 
        });  
    }
    
    function deleteAllCatSpec()
    {
        $.ajax({
               url: "<?=$base_url;?>admin/productcats/deleteAllSpec/<?=$object->id;?>",
               type: "GET",
               dataType:"json",
               success:function(data){
                   reloadSpecList(); 
               } 
        });  
    }
    function chooseMultiProduct(productId)
    {
        if($(":input[name='productCheck[]']:checked").length > 20)
        {
            alert("Chỉ được chọn tối đa 20sp");
        }
        else
        {
            $.ajax({
               url: "<?=$base_url;?>admin/productcats/addProductHome/<?=$object->id;?>" ,
               type: "POST",
               data: $("#productMultiSelect").serialize(),
               dataType:"text",
               success:function(data){
                    $("#productHome").html(data);
                    hideProductMultiDialog();
               } 
            });
        }
    }
    
    
    //TODO: add jquery validation for form & dialog
</script>
<style type="text/css">
.ui-tabs .ui-tabs-nav li a{padding: 0.5em 9px !important;}
</style>
<form id="frmProductCatEdit"  action="<?=$base_url;?>admin/productcats/edit/<?=$object->id;?>" method="post" enctype="multipart/form-data" >
    <div id="container_tab" style="margin-top:10px;">
        <ul>
            <li><a href="#category"><span>Danh mục sản phẩm</span></a></li>
            <?php if($object->exists()){?>
            <!-- <li><a href="#specification"><span>Thông số kĩ thuật</span></a></li>
            <li><a href="#productHome"><span>Sp Trang chủ</span></a></li> -->
            <li><a href="#about"><span>Giới thiệu</span></a></li>
            <li><a href="#exterior"><span>Ngoại thất</span></a></li>
            <li><a href="#interior"><span>Nội thất</span></a></li>
            <li><a href="#operation"><span>Vận hành</span></a></li>
            <li><a href="#color"><span>Màu xe</span></a></li>
            <li><a href="#video"><span>Video</span></a></li>
            <li><a href="#specification"><span>Thông số kĩ thuật</span></a></li>
            <li><a href="#accessories"><span>Phụ kiện</span></a></li>
            <?php } ?>
        </ul>
        <div id="category">
            <div>
                <div style="position: relative;">
                    <div style="position: absolute;top:34px;right:0px;text-align: center;">
                        <?php if($object->image != "") { ?>
                            <img style="border:5px #ccc solid;padding:5px;background: #fff;" src="<?=image($object->image,'product_homeSale');?>" /><br>
                            Hình logo
                        <?php } ?>
                    </div>
                </div>
                <table class="table_input">
                    <tr>
                        <td><label for="name">Ẩn trên menu:</label></td>
                        <td><input <?php if($object->isHide==1) echo 'checked="checked"' ?> name="isHide" type="checkbox" value="1" /></td>
                    </tr>
                    <tr>
                        <td><label for="name">Tên:<span style="color: red;">*</span></label></td>
                        <td><input type="text" name="name" value="<?=$object->name;?>" class="smallInput medium" /></td>
                    </tr>
                    
                    <tr>
                        <td><label>Url:<span style="color: red;">*</span></label></td>
                        <td><input type="text" name="url" value="<?=$object->url;?>" class="smallInput medium" /></td>
                    </tr>
                   
                    <tr>
                        <td><label for="name">Logo:</label></td>
                        <td><input name="logo" type="file" /></td>
                    </tr>
                    <tr>
                        <td><label for="parent">Danh mục cha : </label></td>
                        <td><input type="text" readonly="readonly" name="productCategory" value="<?=$object->parentcat->name;?>" style="float:left;" />
                            <input type="hidden" name="productCategoryId" value="<?=$object->parentcat->id;?>"  />
                            <a href="javascript:void(0)" class="chooseProductCategory" >Chọn từ danh sách</a>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="name">Số sản phẩm hiện ở trang chủ:</label></td>
                        <td><input type="text" name="numProductHomepage" value="<?=$object->numProductHomepage;?>" class="smallInput medium" /></td>
                    </tr>
                   <tr>
                        <td><label for="name">Hiện logo ở menu:</label></td>
                        <td><input <?php if($object->isShowLogo==1) echo 'checked="checked"' ?> name="isShowLogo" type="checkbox" value="1" /></td>
                    </tr>
                    <tr>
                        <td><label for="name">Hiện ở sp hot:</label></td>
                        <td><input <?php if($object->isShowInHot==1) echo 'checked="checked"' ?> name="isShowInHot" type="checkbox" value="1" /></td>
                    </tr>
                    
                    <tr>
                        <td><label for="name">Hiện ở sp mới:</label></td>
                        <td><input <?php if($object->isShowInNew==1) echo 'checked="checked"' ?> name="isShowInNew" type="checkbox" value="1" /></td>
                    </tr>
                    
                    <tr>
                        <td><label for="name">Hiện ở danh mục hot:</label></td>
                        <td><input <?php if($object->isShowInParentHot==1) echo 'checked="checked"' ?> name="isShowInParentHot" type="checkbox" value="1" /></td>
                    </tr>
                    <tr>
                        <td><label for="name">SEO - title:</label></td>
                        <td><input type="text" name="seo_title" value="<?=$object->seo_title;?>" class="smallInput medium" /></td>
                    </tr>
                    <tr>
                        <td><label for="name">SEO - Description:</label></td>
                        <td><textarea style="height: 80px;" type="text" name="seo_description"  class="smallInput medium" /><?=$object->seo_description;?></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="name">SEO - Keyword:</label></td>
                        <td><textarea style="height: 50px;" type="text" name="seo_keyword" class="smallInput medium" ><?=$object->seo_keyword;?></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="name">Tag(html):</label></td>
                        <td><textarea type="text" name="tag"  class="smallInput medium" /><?=$object->tag;?></textarea></td>
                    </tr>
                </table>
    		</div>
        </div>
        <?php if($object->exists()){ ?>
        <div id="about">
            <?php $this->load->view("admin/productcats/tabs/about");?>
        </div>
        <div id="exterior">
            <?php $this->load->view('admin/productcats/tabs/exterior');?>
        </div>
        <div id="interior">
            <?php $this->load->view('admin/productcats/tabs/interior');?>
        </div>
        <div id="operation">
            <?php $this->load->view('admin/productcats/tabs/operation');?>
        </div>
        <div id="color">
            <?php $this->load->view('admin/productcats/tabs/color');?>
        </div>
        <div id="video">
            <?php $this->load->view('admin/productcats/tabs/video');?>
        </div>
        <div id="specification">
            <?php $this->load->view('admin/productcats/tabs/specification');?>
        </div>
        <div id="accessories">
            <?php $this->load->view('admin/productcats/tabs/accessories');?>
        </div>
        <?php } ?>
    </div><!-- end tab panel -->
    <div style="text-align: center;"><?php create_form_button('submit_button button_ok','Luu dữ liệu');?></div>
</form>
<!--     
    <div class="addSpecDialog" style="display: none;">
        <form id="frmAddSpec"  action="" method="post">
            <table class="table_input table_chooseNewType">
                <tr>
                     <td>Nguồn:</td>
                     <td>
                            <input type="radio" name="specNewType" value="1" checked="checked" />Chọn có sẵn
                     </td>
                </tr>
            </table>
            <table class="table_input table_chooseSpec">
                <tr >
                    <td><label>Thuộc nhóm:</label></td>
                    <td>
                        <input type="text" name="productSpecText" value="" readonly="readonly" class="smallInput medium fl"   />
                        <a href="javascript:void(0)" class="chooseSpec">Chọn Thuộc tính</a>
                        <input type="hidden" name="productSpecId" value="" class="smallInput medium" />
                    </td>
                </tr>
            </table>
            <table class="table_input table_newSpec">
                
                <tr>
                    <td><label>Tên:</label></td>
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
                <tr class="tr_spec">
                    <td><label>Thuộc nhóm:</label></td>
                    <td>
                        <input type="text" name="specGroupText" value="" readonly="readonly" class="smallInput medium fl"   />
                        <a href="javascript:void(0)" class="chooseSpecGroup">Chọn nhóm</a>
                        <a href="javascript:void(0)" class="clearSpecGroup">Clear</a>
                        <input type="hidden" name="specGroupId" value="" class="smallInput medium" />
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
    
    
    
    <div class="copySpecDialog" style="display: none;">
        <form id="frmCopySpec"  action="" method="post">
            <table class="table_input table_chooseNewType">
                <tr>
                     <td>Danh mục nguồn:</td>
                     <td>
                            <input type="text" readonly="readonly" name="productCategoryCopy" value="<?=$object->parentcat->name;?>" style="float:left;" />
                            <input type="hidden" name="productCategoryCopyId" value="<?=$object->parentcat->id;?>"  />
                            <a href="javascript:void(0)" class="chooseCopyProductCategory" >Chọn từ danh sách</a>
                     </td>
                </tr>
                <tr>
                     <td>Nhấn OK để bắt đầu:</td>
                     <td>
                            <input type="text" name="OK" value="" class="smallInput medium" />
                     </td>
                </tr>
            </table>
            <table class="table_input">
                <tr class="copySpecButton">
                    <td colspan="2"><?php create_form_button('copySpecSubmit button_ok','Luu dữ liệu');?></td>
                   
                </tr>
            </table>
        </form>
    </div>
     -->