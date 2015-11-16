<script type="text/javascript" src="<?=$base_url;?>images/js/jquery.validate.js?v1"></script>
<script type="text/javascript">
    var frmCommentValidator ;
    var basePrice = '<?=$product->getRealPriceNum();?>';
    var currentProduct = '<?=$product->id;?>';
    var synProductId = <?=$product->id;?>;
    function calculatePrice()
    {
        var sumPrice = 0;
        sumPrice += parseInt(basePrice);
        $(".chkAccessory:checked").each(function(){
            sumPrice += parseInt($(this).val()); 
        });
        $(".p_d_price_combine").html( addCommas(sumPrice) + " VND");
    }
    function addCommas(nStr)
    {
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
    
    function buildSentString()
    {
        var str = '';
        str += currentProduct;
        $(".chkAccessory:checked").each(function(){
            var name = $(this).attr('name');
            name = name.split("_");
            str += "-"+name[1];
        });
        return str;
    }
    
	$(document).ready(function(){
        <?php if($productPhotos->result_count() > 0): ?>
        $('#carousel-product').carouFredSel({
            auto: {
                play: true
            },
            width: 485,
            height: null,
            circular: true,
            infinite: true,
            items: {
                visible: 1
            },
            scroll: {
                items: 1,
                duration: 1000,
                timeoutDuration: 3000
            },
            prev: '#home-prev',
            next: '#home-next',
            pagination: {
                container: '#thumbnail',
                anchorBuilder: false,
                deviation: 0
            }
        });
        <?php endif; ?>

        $.validator.messages.required = "Vui lòng nhập ô này";
        $.validator.messages.email = "Email này chưa đúng.";
		//$(".group_map_p_d").colorbox({rel:'group_map_p_d'});
        $(".bg_p_d_detail").click(function(){
           var addStr =  buildSentString();
           $.colorbox({href:"<?=$base_url;?>chi-tiet-chon/" + addStr});
           return false;
        });
        $(".chkAccessory").click(function(){
            
             calculatePrice();
        });
        $("#btnDetailBuy").click(function(){
             window.location.href = "<?=$base_url;?>them-vao-gio-hang/"+ buildSentString();
             return false;
        });
        $(".chkAccessory").attr('checked',false);

        frmCommentValidator = $("#frmComment").validate({
            rules:{
                title:{required:true},
                name:{required:true},
                commentEmail:{
                    required:true,
                    email:true
                },
                commentPhone:{
                    required:true
                },
                content:{
                    required: true
                },
                captcha_code:{
                    required:true
                }
            }
        });
        $(".btn_send_idea").click(function(){
            if($("#frmComment").valid())
            {
                $.ajax({
                       url: "<?=$base_url;?>fproduct/addComment/<?=$product->id;?>",
                       data: $("#frmComment").serialize(),
                       type: "POST",
                       dataType:"JSON",
                       success:function(data){
                           if(data.status == false)
                           {
                                alert("Vui lòng nhập đúng ký tự xác nhận");
                                $("#changeCaptcha").click();
                           }
                           else
                           {
                               loadComments();
                               $(":input[name='name'],:input[name='title'],:input[name='commentEmail'],:input[name='commentPhone'],:input[name='content'],:input[name='captcha_code']").val("");
                               frmCommentValidator.resetForm();
                               $("#changeCaptcha").click();
                               alert("Bạn vừa thêm bình luận thành công");
                           }
                          
                       } 
                    });
            }
         });
        $("#comment_direction").val("asc");
        $("#comment_direction").change(function(){
            loadComments();
        });


        // jQuery to create tab
        $('.tab-product-detail li a').click(function(){
            $('.tab-product-detail li a').removeClass('active');
            $(this).addClass('active');
            $('.tab-product-detail > div').removeClass('active');
            $('.tab-product-detail div.'+$(this).attr('id')).addClass('active');
        });
         
	});

    function loadComments()
    {
        $.ajax({
           url: "<?=$base_url;?>fproduct/loadComment/<?=$product->id;?>" ,
           type: "POST",
           data:{direction: $("#comment_direction").val()},
           dataType:"html",
           success:function(data){
                $("#commentArea").html(data);                
           } 
        });
    }
</script>

<div id="right-cata">
    <div class="wrapper" style="margin-bottom:10px">
        <div class="product-detail">
            <div class="slide-product">
                <div class="main-carousel">
                    <div id="carousel-product">
                        <img src="<?php echo image($product->image, 'product_slide'); ?>" alt=""/>
                        <?php foreach($productPhotos as $row): ?>
                        <img src="<?php echo image($row->path, 'product_slide'); ?>" alt=""/>
                        <?php endforeach; ?>
                    </div>
                </div>
                <ul id="thumbnail">
                    <li><a href="javascript:void(0)"><img src="<?php echo image($product->image, 'product_thumbnail'); ?>" alt=""/></a></li>
                    <?php foreach($productPhotos as $row): ?>
                    <li><a href="javascript:void(0)"><img src="<?php echo image($row->path, 'product_thumbnail'); ?>" alt=""/></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="info-product">
                <div class="row-info-product row-info-product-01">
                    <h1 class="name"><?php echo $product->name; ?> </h1>
                    <p><span>Giá xe: </span> <strong class="<?php echo $product->getPriceText() != null ? 'strike' : ''; ?>"><?php echo $product->getPrice(); ?> VNĐ</strong>
                    <?php if( $product->getPriceText() != null): ?>
                    <p><span style="width: 44px;display: inline-block;">&nbsp;</span> <strong style="font-size: 18px;"><?php echo $product->getPriceText(); ?> VNĐ</strong>
                    <?php endif; ?>
                    <?php if($product->getSalePrice() != ''): ?>
                    <p><span>Trả trước: </span> <strong><?php echo $product->getSalePrice(); ?> VNĐ</strong>
                    <?php endif; ?>
                    <p><span>Tình trạng: </span><span><?php echo $product->color; ?></span></p>
                    <p><span>Bảo hành: </span><span><?php echo $product->warranty; ?></span></p>
                </div>
                <div class="row-info-product row-info-product-02">
                    <p><span>Vui lòng liên hệ: </span> <strong>0936.135.135 - Minh Hà</strong> để có giá & ưu đãi tốt nhát</p>
                </div>
            </div>
            <div class="cl"></div>
            <div class="tab-product-detail">
                <ul>
                    <li><a id="tab-product-detail-01" class="active" href="javascript:void(0)">Tổng quan</a></li>
                    <li><a id="tab-product-detail-02" href="javascript:void(0)">Liên hệ</a></li>
                    <li><a id="tab-product-detail-03" href="javascript:void(0)">Đánh giá</a></li>
                </ul>
                <div class="tab-product-detail-01 active">
                    <?php echo $product->txtSumary; ?>
                </div>
                <div class="tab-product-detail-02">
                    <div class="comment-facebook" style="margin-left: 0;">
                        <div class="customer_ideas_title">Câu hỏi của bạn về xe <?=$product->name;?></div>
                        <form id="frmComment" method="post">
                            <br /> Lưu ý: Những ô (<span style="color: red;">*</span>) là bắt buộc.
                            <div>
                                <div class="regis_line">
                                    <div class="fl regis_line_txt cs_ideas_form_txt">Tiêu đề<span style="color: red;">*</span> </div>
                                    <div class="fl "><input type="text" name="title" id="" value="" /></div>
                                    <div class="clr"></div>
                                </div>
                                <div class="regis_line">
                                    <div class="fl regis_line_txt cs_ideas_form_txt">Họ và tên<span style="color: red;">*</span> </div>
                                    <div class="fl "><input type="text" name="name" id="" value="" /></div>
                                    <div class="clr"></div>
                                </div>
                                <div class="regis_line">
                                    <div class="fl regis_line_txt cs_ideas_form_txt">Email<span style="color: red;">*</span> </div>
                                    <div class="fl "><input type="text" name="commentEmail" id="" value="" /></div>
                                    <div class="clr"></div>
                                </div>
                                <div class="regis_line">
                                    <div class="fl regis_line_txt cs_ideas_form_txt">Số điện thoại<span style="color: red;">*</span> </div>
                                    <div class="fl "><input type="text" name="commentPhone" id="" value="" /></div>
                                    <div class="clr"></div>
                                </div>
                                <div class="regis_line regis_two_line">
                                    <div>Nhận xét của bạn:<span style="color: red;">*</span> (gõ tiếng việt có dấu, không quá 1000 chữ)</div>
                                    <div><textarea name="content" rows="4" cols="69"></textarea></div>
                                </div>
                            </div>
                            <div style="text-align: left;">
                                <div class="fl regis_line_txt cs_ideas_form_txt">
                                    Xác nhận
                                </div>
                                <div class="fl msg-capcha" style="padding-left: 5px;">
                                    <img class="fl" id="captcha" src="<?=$base_url;?>securimage/securimage_show.php" alt="CAPTCHA Image" width="100" />
                                    <div class="fl"><a style="margin-left: 5px;" href="#" id="changeCaptcha" onclick="document.getElementById('captcha').src = '<?=$base_url;?>/securimage/securimage_show.php?' + Math.random(); return false">[ Mã khác ]</a></div>
                                    <div style="height: 10px;clear: both;"></div>
                                    <input  type="text" name="captcha_code"  maxlength="9" />
                                </div>
                                <div class="cl"></div>
                            </div>
                            <div class="cl"></div>
                            <div style="text-align: right; width: 765px;">
                                <input type="button" value="GỬI" class="btn_send_idea" id="btn_send_idea" name="btn_send_idea" />
                            </div>
                            <div></div>
                        </form>
                    </div>
                </div>
                <div class="tab-product-detail-03">
                    <div class="comment-facebook">
                        <div class="fb-comments" migrated="1" data-href="<?php echo $this->uri; ?>" data-width="755" data-numposts="50" data-colorscheme="light"></div>
                    </div>
                </div>
            </div>
            <div class="cl"></div>
            <?php if($sameCategoryProduct->result_count() > 0): ?>
            <div class="product-related">
                <h2 class="h2-bg">Sản phẩm liên quan</h2>
                <div class="product-related-list">
                    <?php foreach($sameCategoryProduct as $row): ?>
                        <div class="products product_item" style="">
                            <div class="inner-product-home">
                                <a href="<?php echo $base_url.$row->url; ?>">
                                    <img src="<?php echo image($row->image, 'product_list'); ?>" alt="<?php echo $row->name; ?>" >
                                </a>
                            </div>
                            <div class="infor-text-pro">
                                <a title="<?php echo $row->name; ?>" href="<?php echo $base_url.$row->url; ?>"><?php echo $row->name; ?></a>
                                <strong><?php echo $row->getPrice(); ?> VNĐ</strong>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>