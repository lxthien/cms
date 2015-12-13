<script language="javascript" type="text/javascript" src="<?php echo $base_url;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" language="javascript">
//number of category at the first time loca this product
    var initNumCategory;
    var productStatus = '<?=$object->status;?>';
    $().ready(function(){
    
        $("#container_tab").tabs({});
        $(".loadSpecByCategory").live('click',
            function(){
                    var sib = $(this).siblings(":hidden");
                    if(sib.val() == "")
                        showMessage("Vui lòng chọn danh mục");
                    else
                        loadProductSpec(sib.val());
            }
        );
        $(".delelteCategory").live("click",function(e){
             e.preventDefault();
             if(e.handled === true) return false;
             e.handled = true;
             $(this).parents(".categoryItem").remove();
             
             return false;
        });
        $(".addCategory").click(function(){
            
           
            timestamp = new Date().getTime();
             $("#categoryArea").append('<div class="categoryItem" style="clear:both;padding-top:5px;">'
                            +'<input type="text" readonly="readonly" class="smallInput medium" name="productCategory_'+timestamp+'" value="" style="float:left;" />'
                            +'<input type="hidden" name="productCategoryId_'+timestamp+'" value=""  />'
                            +'<a style="margin-left:10px;" href="javascript:void(0)" onclick="showProductCategoryDialog(\'productCategory_'+timestamp+'\',\'productCategoryId_'+timestamp+'\')"  >Chọn</a> |'
                            +'<a href="javascript:void(0)" class="loadSpecByCategory" > Load thông số |</a>'
                            +'<a href="javascript:void(0)" class="delelteCategory" >Xóa</a>'
                            + '</div>'); 
        });
        $(":input[name='productName']").keyup(function(){
            if($(":input[name='isGeneratorUrl']").prop('checked'))
                $(":input[name='url']").val(remove_vietnamese_accents($(this).val())); 
        });
        
        $(".spanPrice").text(addCommas($(":input[name='price']").val()));
        $(":input[name='price']").keyup(function(){
             $(".spanPrice").text(addCommas($(this).val())); 
        });
         $(".spanSaleOffPrice").text(addCommas($(":input[name='saleOffPrice']").val())); 
        $(":input[name='saleOffPrice']").keyup(function(){
            
             $(".spanSaleOffPrice").text(addCommas($(this).val())); 
        });
        
        if(productStatus == '<?=enum::PRODUCT_UNAVAILABLE;?>' || productStatus == '<?=enum::PRODUCT_WILL_AVAILABLE;?>')
        {
            $("#avaiAt").hide();
        }else{
            $("#avaiAt").show();
        }
        $(":input[name='productstatus']").change(function(){
            if($(this).val() == '<?=enum::PRODUCT_AVAILABLE;?>')
            {
                $("#avaiAt").show();
            }else{
                $("#avaiAt").hide();
            }
        });
        $("#frmProduct").validate({
            rules:{
                productName:{
                    required:true,
                    remote:{
                        url:'<?=$base_url;?>admin/products/checkNameUnique/<?=$object->id != '' ? $object->id : 0;?>',
                        type:'post',
                        data:{
                            name:function(){ return $(":input[name='productName']").val();}
                        }  
                     }                  
                },
                url:{
                    required:true,
                    remote:{
                        url:'<?=$base_url;?>admin/products/checkUrlUnique/<?=$object->id != '' ? $object->id : 0;?>',
                        type:'post',
                        data:{
                            url:function(){ return $(":input[name='url']").val();}
                        }
                    }
                },
                price:{
                    required:true,
                    digits:true
                },
                saleOffPrice:{
                    digits:true
                }
            },
            messages:{
                productName:{
                   remote: "Tên sản phẩm này đã tồn tại"  
                              
                },                
                url:{
                    remote:"url này đã tồn tại trong hệ thống."
                },
                price:{
                    digits:"Vui lòng nhập số"
                },
                saleOffPrice:{
                    digits:"Vui lòng nhập số"
                }
            }
        });
    
        //create copy spec dialog
        
        
        
        copySpecDialog_init();
        newProductSpec_init();
        addComment_init();
    });
    
    function addCommas(nStr)
    {
        if($.trim(nStr) == "")
            return "";
    	nStr += '';
    	x = nStr.split('.');
    	x1 = x[0];
    	x2 = x.length > 1 ? '.' + x[1] : '';
    	var rgx = /(\d+)(\d{3})/;
    	while (rgx.test(x1)) {
    		x1 = x1.replace(rgx, '$1' + ',' + '$2');
    	}
    	return x1 + x2;
    }

    function loadProductSpec(catId)
    {
        //var catId = $("input[name='productCategoryId']").val();
        if(catId!="")
        {
            $.ajax({
                   url: "<?=$base_url;?>admin/productcats/loadSpecForProduct/"+catId ,
                   type: "GET",
                   dataType:"text",
                   success:function(data){
                         showMessage("Thêm thông tin thành công. Vui lòng mở tab thông số để xem chi tiết.","success",function(){
                            activeTab("specific");
                         });
                        $("#productSpecLoad").html(data);
                   } 
                });
        }
    }
    
    
    function loadProductSpecByProduct()
    {
        $.ajax({
           url: "<?=$base_url;?>admin/products/loadNewProductSpec/<?=$object->id;?>" ,
           type: "GET",
           dataType:"text",
           success:function(data){
                $("#productSpecLoad").html(data);
           } 
        });
    }
    
    
    function loadAccessories()
    {
        $.ajax({
           url: "<?=$base_url;?>admin/products/loadAccessories/<?=$object->id;?>" ,
           type: "GET",
           dataType:"html",
           success:function(data){
                $("#productAccessories").html(data);
                activeTab("accessories");
                    showMessage("Cập nhật danh sách phụ kiện thành công.","success",function(){});
                
           } 
        });
    }
    
    
    function loadComments()
    {
        $.ajax({
           url: "<?=$base_url;?>admin/products/loadProductComment/<?=$object->id;?>" ,
           type: "GET",
           dataType:"html",
           success:function(data){
                $("#productComment").html(data);                
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
               url: "<?=$base_url;?>admin/products/addAccessories/"+productId ,
               type: "POST",
               data: $("#productMultiSelect").serialize(),
               dataType:"text",
               success:function(data){
                    loadAccessories();
                    hideProductMultiDialog();
               } 
            });
        }
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
    
   
</script>

<form id="frmProduct" class="table_input" action="<?=$base_url;?>admin/products/edit/<?=$object->id != '' ? $object->id : 0;?>" method="post" enctype="multipart/form-data">
<input class="tabs_select" type="hidden" name="tabs_select" />
<!--begin content tabs-->
<div style="position: relative;">
        <div style="position: absolute;top:0px;right:0px;text-align: center;">
            <?php if($object->image != "") { ?>
                <img style="border:5px #ccc solid;" src="<?=image($object->image,'product_home');?>" /><br>
                Hình đại diện
            <?php } ?>
        </div>
</div>
<table class="table_input">
    <tr>
     	<td>
			<label for="name">Mã sản phẩm:</label></td>
        <td><input type="text" id="productCode" readonly="readonly"  class="smallInput big"  name="productCode" value="<?=$object->productCode;?>" /></td>
    </tr>
    <tr>
     	<td>
			<label for="name">Tên sản phẩm:<span style="color: red;">*</span></label></td>
        <td><input type="text"  name="productName" class="smallInput big" value="<?=$object->name;?>" /></td>
    </tr>
    
    <tr>
        <td><label for="name">Tự sinh url:</label></td>
        <td><input  name="isGeneratorUrl" type="checkbox" <?php if($object->isAutoGenerateUrl==1) echo 'checked="checked"' ?>  value="1" /></td>
    </tr>
    <tr>
     	<td>
			<label for="name">URL:</label></td>
        <td><input type="text" id="url"   class="smallInput big"  name="url" value="<?=$object->url;?>" /></td>
    </tr>
    <!--<tr>
        <td><label for="name">Chọn trang thái:</label></td>
        <td>
            <select class="smallInput big" name="productstatus">
                <option value="<?/*=enum::PRODUCT_AVAILABLE;*/?>" <?/*=selectIt($object->status,enum::PRODUCT_AVAILABLE);*/?> ><?/*=enum::getProductStatus(enum::PRODUCT_AVAILABLE);*/?></option>
                <option value="<?/*=enum::PRODUCT_WILL_AVAILABLE;*/?>" <?/*=selectIt($object->status,enum::PRODUCT_WILL_AVAILABLE);*/?> ><?/*=enum::getProductStatus(enum::PRODUCT_WILL_AVAILABLE);*/?></option>
                <option value="<?/*=enum::PRODUCT_UNAVAILABLE;*/?>" <?/*=selectIt($object->status,enum::PRODUCT_UNAVAILABLE);*/?> ><?/*=enum::getProductStatus(enum::PRODUCT_UNAVAILABLE);*/?></option>
            </select>    
                
        </td>
    </tr>-->
    <!-- <tr id="avaiAt"  >    
        <td><label>Có hàng tại</label></td>
        <td>
            <?php foreach($stores as $row):?>
            <input type="checkbox" name="store_<?=$row->id;?>" value="<?=$row->id;?>" <?php if($row->is_related_to($object)) echo "checked='checked'";?> />
                <strong><?=$row->name;?></strong> - <?=$row->address;?><br />
            <?php endforeach;?>
        </td>
    </tr> -->
</table>
<div id="container_tab" style="margin-top:10px;">
    <ul>
        <li><a class="select" href="#products"><span>Thông tin</span></a></li>
        <li><a class="select" href="#sumary"><span>Tổng quan</span></a></li>
        <!--<li><a class="select" href="#description"><span>Trích dẫn</span></a></li>
        <li><a class="select" href="#gift"><span>Khuyến mãi</span></a></li>
        <li><a class="select" href="#video"><span>Video</span></a></li>
        <li><a class="select" href="#specific"><span>Thông số</span></a></li>-->
        <?php if($object->exists()){ ?>
        <!--<li><a class="select" href="#accessories"><span>Phụ kiện</span></a></li>-->
        <li><a class="select" href="#images"><span>Hình ảnh</span></a></li>
        <li><a class="select" href="#comments"><span>Comments</span></a></li>
        <?php } ?>
    </ul>
    <div id="products"><!--begin products tabs-->
        <?php $this->load->view('admin/products/tabs/tab_products'); ?>
        <div class="clear"></div>        
    </div><!--end tabs products-->
    
    <div id="specific"><!--begin tabs specific-->
        <?php //$this->load->view('admin/products/tabs/tab_specific'); ?>
        <div class="clear"></div>
    </div>
    <div id="description"><!--begin tabs specific-->
        <?php //$this->load->view('admin/products/tabs/tab_description'); ?>
        <div class="clear"></div>
    </div>
    <div id="gift"><!--begin tabs specific-->
        <?php //$this->load->view('admin/products/tabs/tab_gift'); ?>
        <div class="clear"></div>
    </div>
    
    <div id="sumary"><!--begin tabs specific-->
        <?php $this->load->view('admin/products/tabs/tab_sumary'); ?>
        <div class="clear"></div>
    </div>
    
    <div id="video"><!--begin tabs specific-->
        <?php //$this->load->view('admin/products/tabs/tab_video'); ?>
        <div class="clear"></div>
    </div>
    
    
    <?php if($object->exists()){ ?>
    <div id="accessories"><!--begin tabs images-->
    	<?php //$this->load->view('admin/products/tabs/tab_accessories'); ?>
        <div class="clear"></div>
    </div><!--end tabs images-->
    <div id="images"><!--begin tabs images-->
    	<?php $this->load->view('admin/products/tabs/tab_images'); ?>
        <div class="clear"></div>
    </div><!--end tabs images-->
    <div id="comments"><!--begin tabs comments-->
        <?php $this->load->view('admin/products/tabs/tab_comments'); ?>
        <div class="clear"></div>
    </div><!--end tabs comments-->
    <?php  } ?>
</div><!--end content tabs-->
<div class="button_bar buttoneditproduct">
    <br /><br />
    <?php create_form_button('submit_button button_ok','Save');?>
</div>
</form><!--end form edit products-->

<!--DIALOG-->


<?php $this->load->view('admin/products/dialog/copyProductSpecDialog');?>
<?php $this->load->view('admin/products/dialog/newProductSpecDialog');?>
<?php $this->load->view('admin/products/dialog/addCommentDialog');?>


