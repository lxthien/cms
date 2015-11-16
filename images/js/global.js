/******************************
 Class Common
 ******************************/

var common =
{
    loadScriptZoom: false,
    addDot : function (str)
    {
        var amount = new String(str);
        amount = amount.split("").reverse();

        var output = "";
        for ( var i = 0; i <= amount.length-1; i++ )
        {
            output = amount[i] + output;
            if ((i+1) % 3 == 0 && (amount.length-1) !== i)output = '.' + output;
        }
        return output;
    },

    formatAutosuggest: function(value, data, currentValue) {

    },

    validateSearch: function() {
        if( ($("#search_keyword").val() == "") || ($("#search_keyword").val() == "Nháº­p tá»« khÃ³a cáº§n tÃ¬m") )
        {
            return false;
        }

        var content = $("#search_keyword").val();
        var word=/@(\w+)/ig; //@abc Match
        var name = content.match(word);

        // track log
        $.post( Settings.baseurl+"/ajax/searchtracking", {
            keyword: content
        }, function(data){});

        return true;
    },

    getTotalOrder: function() {
        var total = 0;
        /*if(Account.UID > 0)*/
        {
            /*var key = 'total_order_'+ Account.UID;*/
            var key = 'db_total_order';

            // get from cookie
            var total = $.cookie(key);
            if(total == null)
            {
                total = 0;

                $.post(Settings.base_ssl_url+'/myajax/ajaxgettotalorder',{}, function(data) {
                    total = parseInt(data);
                    var date = new Date();
                    date.setTime(date.getTime() + (7 * 24 * 3600 * 1000));
                    $.cookie(key, total, {
                        expires: date,
                        path: '/',
                        domain: Settings.domain
                    });
                    $('#nav-cart-count').html(total);
                });
            }
        }
        total = (total == "NaN") ? 0 : total;
        $('#nav-cart-count').html(parseInt(total));
    },

    setTotalOrder: function(total) {
        /*if(Account.UID > 0)*/
        {
            /*var key = 'total_order_'+ Account.UID;*/
            var key = 'db_total_order';
            var date = new Date();
            date.setTime(date.getTime() + (7 * 24 * 3600 * 1000));
            $.cookie(key, total, {
                expires: date,
                path: '/',
                domain: Settings.domain
            });
        }
    },

    createProductUserViewHtml : function ( productId, productTitle, productName, productPrice, productImage, productUrl){
        var htmlSub = [];
        htmlSub.push('<li><a title="Loáº¡i bá» sáº£n pháº©m" rel="'+productId+'" class="del-pr" href="javascript:void(0)"></a><a href="'+productUrl+'?ref=sp_moi_xem"><img src="'+productImage+'" width="84" height="84"  alt="'+productTitle+'" title="'+productTitle+'"></a></li>')
        return htmlSub.join('');
    },

    getListProductView : function(){
        var totalPage = 0;
        $.post(Settings.base_ssl_url +'load-ajax/historyview',{},
            function(data){
                var html = [];
                html.push('<div class="sticky-his-box">');
                html.push('		<div class="his-box" style="top:147px;z-index:2;">');
                html.push('			<p class="lstitle">Má»›i xem <span id="total_view_product">('+data.totalProduct+')</span></p>');
                html.push('			<div class="his-box-inside">');
                html.push('				<ul class="clearfix" id="paging_view_product">');

                if(data.totalPage > 0 && data.list != undefined && data.list.length > 0){
                    totalPage = data.totalPage;
                    var totalProductInPage = data.list.length;
                    for( i = 0; i < totalProductInPage; i++){
                        var htmlSub = '';
                        htmlSub = common.createProductUserViewHtml(data.list[i].product_id, data.list[i].product_title, data.list[i].product_name, data.list[i].product_price, data.list[i].product_image, data.list[i].product_url);
                        html.push(htmlSub);
                    }
                    html.push('				</ul>');
                    html.push('			<div class="his-paper">');
                    html.push('				<a class="btn-prev" id="page_view_prev" rel="0" href="javascript:void(0)"></a>');
                    html.push('				<span id="page_product_user_view"><i>'+data.pageCur+'</i>/'+data.totalPage+'</span>');

                    var pageNext = 0;
                    if(data.totalPage > data.pageCur){
                        pageNext = 2;
                    }

                    html.push('				<a class="btn-next" id="page_view_next" rel="'+pageNext+'" href="javascript:void(0)"></a>');
                    html.push('			</div>');

                    html.push('			</div>');
                    html.push('		</div>');
                    html.push('</div>');
                    $('#history_view_box').prepend(html.join(''));
                }

                $('.del-pr').live('click', function(){
                    productId = $(this).attr('rel');
                    $("#paging_view_product").html('<li style="text-align:center; height:276px"><img style="margin-top:125px" src="'+Settings.imgurl+'/loading_more.gif"></li>');
                    $.post(Settings.baseurl +'load-ajax/historyview',{id : productId, is_delete : 1},
                        function(subData){
                            totalPage = subData.totalPage;
                            var htmlSub = [];
                            $('#total_view_product').text('(' + subData.totalProduct + ')');
                            $('#page_product_user_view').html('<i>' + subData.pageCur + '</i>/' + subData.totalPage);
                            if(subData.totalPage == 0){
                                $('.sticky-his-box').remove();
                            }
                            else{
                                totalProductInPage = subData.list.length;
                                for( i = 0; i < subData.list.length; i++){
                                    var htmlTmp = common.createProductUserViewHtml(subData.list[i].product_id, subData.list[i].product_title, subData.list[i].product_name, subData.list[i].product_price, subData.list[i].product_image, subData.list[i].product_url);
                                    htmlSub.push(htmlTmp);
                                }
                            }
                            $("#paging_view_product").html(htmlSub.join(''));
                        },'json');
                });

                $('#page_view_next').live('click', function(){
                    pageCur = $(this).attr('rel');
                    if(pageCur > 0){
                        if(pageCur == totalPage){
                            $('#page_view_next').removeClass('next');
                            $('#page_view_next').addClass('next-over');
                        }
                        pageCur = parseInt(pageCur);
                    }
                    else{
                        return false;
                    }
                    $("#paging_view_product").html('<li style="text-align:center; height:276px"><img style="margin-top:125px" src="'+Settings.imgurl+'/loading_more.gif"></li>');
                    $.post(Settings.baseurl +'load-ajax/historyview',{page : pageCur},
                        function(subData){
                            totalProductInPage = subData.list.length;
                            var htmlSub = [];
                            for( i = 0; i < subData.list.length; i++){
                                var htmlTmp = common.createProductUserViewHtml(subData.list[i].product_id, subData.list[i].product_title, subData.list[i].product_name, subData.list[i].product_price, subData.list[i].product_image, subData.list[i].product_url);
                                htmlSub.push(htmlTmp);
                            }
                            $("#paging_view_product").html(htmlSub.join(''));
                            $('#page_product_user_view').html('<i>' + subData.pageCur + '</i>/' + subData.totalPage);
                            $('#page_view_prev').removeClass('prev-over');
                            $('#page_view_prev').addClass('prev');

                            var pageNext = pageCur >= totalPage ? 0 : pageCur+1;
                            $('#page_view_next').attr('rel', pageNext);

                            var pagePrev = pageCur <=1 ? 0 : pageCur-1;
                            $('#page_view_prev').attr('rel', pagePrev);
                        },'json');
                });
                $('#page_view_prev').live('click', function(){
                    pageCur = $(this).attr('rel');
                    if(pageCur > 0){
                        if(pageCur == 1){
                            $('#page_view_next').removeClass('next');
                            $('#page_view_next').addClass('next-over');
                        }
                        pageCur = parseInt(pageCur);
                    }
                    else{
                        return false;
                    }
                    $("#paging_view_product").html('<li style="text-align:center; height:276px"><img style="margin-top:125px" src="'+Settings.imgurl+'/loading_more.gif"></li>');
                    $.post(Settings.baseurl +'load-ajax/historyview',{page : pageCur},
                        function(subData){
                            totalProductInPage = subData.list.length;
                            var htmlSub = [];
                            for( i = 0; i < subData.list.length; i++){
                                htmlSub.push(common.createProductUserViewHtml(subData.list[i].product_id, subData.list[i].product_title, subData.list[i].product_name, subData.list[i].product_price, subData.list[i].product_image, subData.list[i].product_url));
                            }
                            $("#paging_view_product").html(htmlSub.join(''));
                            $('#page_product_user_view').html('<i>' + subData.pageCur + '</i>/' + subData.totalPage);
                            $('#page_view_next').removeClass('next-over');
                            $('#page_view_next').addClass('next');

                            var pageNext = pageCur >= totalPage ? 0 : pageCur+1;
                            $('#page_view_next').attr('rel', pageNext);

                            var pagePrev = pageCur <=1 ? 0 : pageCur-1;
                            $('#page_view_prev').attr('rel', pagePrev);
                        },'json');
                });

            },
            'json');
    },

    trackPageActivity : function(type)
    {
        var pathname = window.location.pathname + window.location.search;
        $.post( Settings.base_ssl_url+"/ajax/tracking", {
            uri: pathname,
            refer: document.referrer,
            type:type,
            user_agent: navigator.userAgent,
            category_id: PageInfo.category_id,
            shop_id: PageInfo.shop_id,
            product_id: PageInfo.product_id
        }, function(data){});
    },

    trackPageActivityNew : function(data)
    {
        categoryId = 0;
        if(typeof(data.category_id) != 'undefined'){
            categoryId = data.category_id;
        }
        productId = 0;
        if(typeof(data.product_id) != 'undefined'){
            productId = data.product_id;
        }
        shopId = 0;
        if(typeof(data.shop_id) != 'undefined'){
            shopId = data.shop_id;
        }

        var pathname = window.location.pathname + window.location.search;
        if(typeof(data.param_id) != 'undefined'){
            var n = pathname.indexOf("?");
            if(n > 0){
                pathname = pathname + '&'+ data.param_id;
            }else{
                pathname = pathname + '?'+ data.param_id;
            }

        }
        $.post( Settings.base_ssl_url+"/ajax/tracking", {
            uri: pathname,
            refer: document.referrer,
            type:data.type,
            user_agent: navigator.userAgent,
            category_id: categoryId,
            shop_id: shopId,
            product_id: productId
        }, function(data){});
    },

    trackPageView : function(object)
    {
        var link = object.attr("href");
        var tracking = object.attr("tracking");

        if (link.search(Settings.baseurl) != -1) {
            link = link.replace(Settings.baseurl, "");
        }

        if (tracking != "") {
            if(link.indexOf("?") > 0)
            {
                link += "&" + tracking;
            }
            else
            {
                link += "?" + tracking;
            }
        }
        _gaq.push(["m._trackPageview", link]);
        return true;
    },

    trackEvent : function(object)
    {
        var link = object.attr("href");
        var tracking = object.attr("tracking");
        var tracking_category = object.attr("tracking_category");

        if (link.search(Settings.baseurl) != -1) {
            link = link.replace(Settings.baseurl, "");
        }

        if(!tracking_category) {
            tracking_category = '123Mua';
        }

        _gaq.push(["_trackEvent", tracking_category, tracking, link]);
        return true;

    }
};

/******************************
 End Class Common
 ******************************/

/******************************
 Class Cart
 ******************************/
var cart =
{
    cookie_list_product : 'db_123m_product_orders',

    addtocart : function (productId, productPrice, productName, userId, isType, isStep, productParentId, productQuantity, attributes, isDetail, shopId)
    {
        /*
         * is_type = 1 : product ( 1 - 1 )
         * is_type = 2 : product ( 1 - n )
         * is_type = 3 : bundle

         if(Account.UNAME == '')
         {
         login.popup_login();
         return false;
         }
         */
        var quantity = 1;
        if(isType == 1)
            productId = "P1_" + productId;
        else if(isType == 2)
            productId = "PM_" + productId;
        else if(isType == 3)
            productId = "B_" + productId;
        jQuery.post(Settings.baseurl+'/ajax/addtocart',{
                product_id : productId,
                product_quantity : quantity,
                product_price : productPrice ,
                product_name : productName ,
                user_id : userId ,
                is_type : isType,
                product_parent_id : productParentId,
                product_quantity : productQuantity,
                attributes : attributes,
                is_step : isStep
            },
            function(data)
            {
                if(data > 0)
                {
                    common.setTotalOrder(data);
                    common.getTotalOrder();
                    isCheck = 0;
                    productId = productId.split('_');
                    productId = productId[1];
                    if(isType == 1){
                        if(typeof(attributes)!="null" && attributes != null && attributes != ''){
                            attributes = attributes.split(',');
                            if((typeof(attributes[0])!="null" && attributes[0] != null && attributes[0] != '') || attributes[0] == 0){
                                color = attributes[0];
                                productId = productId+'_'+color;
                            }
                            if(typeof(attributes[1])!="null" && attributes[1] != null && attributes[1] != ''){
                                size = attributes[1];
                                productId = productId+'_'+size;
                            }
                        }

                    }
                    /*
                     productId_isType_parentId_userId;
                     */
                    productId = productId + ',' + isType + ',' + productParentId + ',' + userId;

                    var strProduct = $.cookie(cart.cookie_list_product);
                    if(typeof(strProduct)!="null" && strProduct != null)
                    {
                        var arrayProduct = strProduct.split(';');
                        for(i=0;i<arrayProduct.length;i++){
                            if(arrayProduct[i] == productId){
                                isCheck = 1;
                            }
                        }
                        if(isCheck == 0){
                            productId = productId + ';' + strProduct;
                        }else{
                            productId = strProduct;
                        }
                    }
                    var date = new Date();
                    date.setTime(date.getTime() + (7 * 24 * 3600 * 1000));
                    $.cookie(cart.cookie_list_product, productId, {
                        expires: date,
                        path: '/',
                        domain: Settings.domain
                    });

                    common.trackPageActivity(4);

                    if(isStep == 1)
                    {
                        window.location = Settings.baseurl+'/order/step2?s='+shopId+'&page=s-0&box=st2';
                    }
                    else
                    {

                        window.location = Settings.baseurl+'/order/step1?page=s-0&box=st1';
                        /*
                         cart.createHtmlCart();
                         if(isDetail != 1){
                         var html = cart.popupCart(data, '');
                         new Boxy(html, {
                         unloadOnHide : true,
                         afterShow : function(){
                         $('#clode_boxy').click(function(){
                         $('.btn-close').click();
                         })
                         jQuery.post(Settings.baseurl+'/ajax/ajax-order-recommend',{
                         product_id : productParentId,
                         user_id : userId
                         },function(data){
                         var html = '';
                         for(i=0; i<data.length; i++){
                         html +='			<li class="product-pop">';
                         html +='				<div class="pic" title='+data[i].product_title+'><a href="'+data[i].url+'"><img src="'+data[i].product_image+'" width="140" height="140" alt="'+data[i].product_title+'"></a></div>';
                         html +='				<h2 title='+data[i].product_title+' class="title-product"><a href="'+data[i].url+'">'+data[i].product_name+'</a></h2>';
                         if(data[i].price > 0){
                         html +='				<p class="price">'+data[i].price+'<span 	class="unit-price">Ä‘</span></p>';
                         }else{
                         html +='				<p class="price"><span style="color:#390">Vui lÃ²ng gá»i</span></p>';
                         }
                         html +='			</li>';
                         }
                         $('#list_product').html(html);
                         $('#list_product').bxSlider({
                         auto: true,
                         infiniteLoop: false,
                         minSlides: 3,
                         maxSlides: 3,
                         slideWidth: 220,
                         slideMargin: 4,
                         pager : false
                         });
                         },'Json')
                         }
                         });
                         }else{
                         var html = cart.popupCart(data, ';position:absolute;');
                         $('#addtocart_view').html(html);
                         jQuery.post(Settings.baseurl+'/ajax/ajax-order-recommend',{
                         product_id : productParentId,
                         user_id : userId
                         },function(data){
                         var html = '';
                         for(i=0; i<data.length; i++){
                         html +='			<li class="product-pop">';
                         html +='				<div class="pic" title='+data[i].product_title+'><a href="'+data[i].url+'"><img src="'+data[i].product_image+'" width="140" height="140" alt="'+data[i].product_title+'"></a></div>';
                         html +='				<h2 title='+data[i].product_title+' class="title-product"><a href="'+data[i].url+'">'+data[i].product_name+'</a></h2>';
                         if(data[i].price > 0){
                         html +='				<p class="price">'+data[i].price+'<span class="unit-price">Ä‘</span></p>';
                         }else{
                         html +='				<p class="price"><span style="color:#390">Vui lÃ²ng gá»i</span></p>';
                         }
                         html +='			</li>';
                         }
                         $('#list_product').html(html);
                         $('#list_product').bxSlider({
                         auto: true,
                         infiniteLoop: false,
                         speed: 500,
                         pause: 4000,
                         displaySlideQty: 3,
                         moveSlideQty: 3
                         });
                         },'Json');
                         $('#addtocart_view').show();
                         $('#clode_boxy').click(function(){
                         $('#addtocart_view').hide();
                         });
                         $('.btn-close').click(function(){
                         $('#addtocart_view').hide();
                         });
                         }
                         */
                    }
                }else{
                    $(this).myBoxy (Boxy,{
                        modal : true,
                        unloadOnHide: true,
                        type: 'alert',
                        title: 'ThÃ´ng bÃ¡o tá»« há»‡ thá»‘ng',
                        message: 'Sáº£n pháº©m thÃªm vÃ o giá» hÃ ng khÃ´ng thÃ nh cÃ´ng! Vui lÃ²ng thá»­ láº¡i!'
                    });
                }
            },'Json');
    },

    checkProduct : function(productId, isType)
    {
        productId = productId + ',' + isType;
        var isCheck = 0;
        var strProduct = $.cookie(cart.cookie_list_product);
        if(typeof(strProduct)!="null" && strProduct != null)
        {
            var arrayProduct = strProduct.split(';');

            for(i=0;i<arrayProduct.length;i++){
                if(arrayProduct[i] == productId)
                    isCheck = 1;
            }
            if(isCheck == 1){
                $(this).myBoxy (Boxy,{
                    modal : true,
                    unloadOnHide: true,
                    type: 'success',
                    title: 'ThÃ´ng bÃ¡o tá»« há»‡ thá»‘ng',
                    message: 'Sáº£n pháº©m nÃ y Ä‘Ã£ tá»“n táº¡i trong giá» hÃ ng cá»§a báº¡n!'
                });
                return 1;
            }

            productId = productId + ';' + strProduct;
        }
        var date = new Date();
        date.setTime(date.getTime() + (7 * 24 * 3600 * 1000));
        $.cookie(cart.cookie_list_product, productId, {
            expires: date,
            path: '/',
            domain: Settings.domain
        });
    },

    popupCart : function(data, position){
        var html ='<div class="popup" style="width:560px;border:0;left:-15px;z-index:999'+position+'">';
        html +='<div class="detail-p2">';
        html +='<a title="ÄÃ³ng láº¡i" class="btn-close close"><img src="'+Settings.imgurl+'/boxy/close_boxy.png" width="30" height="30" alt="ÄÃ³ng láº¡i" /></a>';
        html +='<span class="title">ThÃ´ng bÃ¡o tá»« há»‡ thá»‘ng</span>';
        html +='<p class="text-01">1 sáº£n pháº©m Ä‘Ã£ Ä‘Æ°á»£c Ä‘Æ°a vÃ o giá» hÃ ng cá»§a báº¡n.</p>';
        html +='<p class="text-01">Hiá»‡n táº¡i, báº¡n Ä‘ang cÃ³ <strong>'+data+'</strong> sáº£n pháº©m trong giá» hÃ ng.</p>';
        html +='<p class="row-btn"><a href="javascript:void(0)" id="clode_boxy" class="buy-btn">Tiáº¿p tá»¥c mua hÃ ng</a><a href="'+Settings.baseurl+'/order/step1" class="see-btn">Xem giá» hÃ ng</a></p>';
        html +='<p class="text-02">Nhá»¯ng sáº£n pháº©m ngÆ°á»i khÃ¡c cÅ©ng chá»n khi mua sáº£n pháº©m giá»‘ng báº¡n</p>';
        html +='<div class="detail-p2-inside clear">';
        html +='	<div class="ctn-detail-p2">';
        html +='		<ul id="list_product">';
        html +='		<li style="padding:80px 0 100px 0" ><img style="margin-left:220px" alt="123Mua" src="'+Settings.imgurl+'/loading.gif"></li>';
        html +='		</ul>';
        html +='	</div>';
        html +='</div>';
        html +='</div>';
        html +='</div>';
        return html;
    },

    createHtmlCart : function(){
        $.post(Settings.base_ssl_url +'/ajax/get-list-product-order',{},

            function(data){
                totalProduct = data.length;
                var html = [];
                if(totalProduct > 0){
                    var price = 0;
                    html.push('<h2 class="title">Giá» hÃ ng cá»§a báº¡n</h2>');
                    html.push('<div class="p-scroll">');
                    html.push('	<table width="100%" border="1">');
                    for(i=0; i<totalProduct; i++){
                        var productPrice = data[i].special_price > 0 ? data[i].special_price : data[i].product_price;
                        price = price + productPrice * data[i].quantity;

                        html.push('<tr>');
                        html.push('		<td><p class="img"><a target="_blank" href="'+data[i].url+'"><img width="50" height="50" src="'+data[i].product_image+'" alt="'+data[i].product_name+'"></a></p></td>');
                        html.push('		<td>');
                        html.push('			<p class="des"><a target="_blank" href="'+data[i].url+'">'+data[i].product_name+'</a> <span class="amount">x'+data[i].quantity+'</span></p>');

                        html.push('			<p class="price"><span class="ptitle">GiÃ¡:</span> '+Core123M.formatCurrency(productPrice)+'<span class="unit-price">Ä‘</span></p>');
                        html.push('		</td>');
                        html.push('</tr>');
                    }
                    html.push('	</table>');
                    html.push('</div>');

                    html.push('	<table width="100%" border="1">');
                    html.push('<tr>');
                    html.push('		<td colspan="3"><div class="sum-price"><p class="price"><span class="ptitle">Tá»•ng cá»™ng:</span> <span id="total_price_cart_order">'+Core123M.formatCurrency(price)+'</span><span class="unit-price">Ä‘</span></p></div></td>');
                    html.push('	  </tr>');
                    html.push('</table>');
                    html.push('<a href=" '+ Settings.base_ssl_url+ '/order/step1" class="buy-btn">Tiáº¿n hÃ nh thanh toÃ¡n</a>');
                    $('#box_product_order').html(html.join(''));
                    /*
                     $("#jp-cart").mCustomScrollbar({
                     scrollButtons:{
                     enable:false
                     }
                     });
                     */
                }else{
                    html.push('<div class="no-product">');
                    html.push('	<p><strong>ChÆ°a cÃ³ sáº£n pháº©m trong giá» hÃ ng.</strong></p>');
                    html.push('</div>');
                    $('#box_product_order').html(html.join(''));
                }


            },'json');
    }
}

/******************************
 End Class Cart
 ******************************/

/******************************
 Class jCache
 ******************************/

var jCache =
{
    cache: {},
    data: {},
    currentKey: '',

    setKey: function(key) {
        this.currentKey = key;
    },

    get: function(id) {
        if (typeof this.data[id] !== undefined) {
            return this.data[id];
        } else {
            //console.log('Failed cache hit for term: ' + term);
            return undefined;
        }
    },

    set: function(id, data) {
        this.data[id] = data;
    },

    del: function(id) {
        if (typeof this.data[id] !== undefined)
            this.cache[id] = undefined;
    }
};

/******************************
 End Class jCache
 ******************************/

/******************************
 Class Message
 ******************************/

var Message = {
    boxy: {},
    options : {
        shopName : "",
        receiver: 0,
        sender:0,
        msgId:0,
        titleReply: ""
    },
    compose : function()
    {
        $.unblockUI();
        if(Account.UNAME == '')
        {
            login.popup_login();
            return false;
        }
        var html = '<div class="popup" style="width:450px;margin:0 auto">'
            +'<div class="loading" style="display:none"><span></span>loading...</div><div class="title-popup">Gá»­i tin nháº¯n<a title="ÄÃ³ng láº¡i" class="btn-close close">'+
            '<img src="'+Settings.imgurl+'/boxy/close_boxy.png" width="30" height="30" alt="ÄÃ³ng láº¡i" />'+
            '</a></div><div class="content-popup"><div class="msg-form">'+
            '<p class="notice-error" style="display:none">Xin vui lÃ²ng nháº­p Ä‘áº§y Ä‘á»§ thÃ´ng tin</p><p class="row-info clearfix"><label for="name">NgÆ°á»i nháº­n:</label><span class="txt">'+Message.options.shopName+'</span></p><p class="row-info clearfix"><label for="title">TiÃªu Ä‘á»:</label>	<input id="title_msg" class="input-msg" name="title" type="text"></p><p class="row-info clearfix"><label for="content">Ná»™i dung tin nháº¯n:</label>	<textarea id="content_msg" class="ctn-content"></textarea></p><div class="clear"></div></div><div class="clear"></div></div><div class="footer-popup"><div class="btn-default btn-double"><input class="btn-accept" name="" type="button" value="Gá»­i Ä‘i" onclick="Message.sendMsg()"/><input class="btn-cancel close" name="" type="button" value="Há»§y bá»" /></div></div></div>';
        this.boxy = new Boxy(html, {
            modal:true,
            unloadOnHide: true
        });
    },
    sendMsg : function()
    {
        var error = 0;
        title = $('#title_msg').val();
        content = $('#content_msg').val();
        if((title == "") || (content == ""))
        {
            msgError = "Xin vui lÃ²ng nháº­p Ä‘áº§y Ä‘á»§ thÃ´ng tin!";
            $('.notice-error').text(msgError);
            $('.notice-error').css('display','block');
        }
        else
        {
            this.boxy.hide();

            $(this).myBoxy (Boxy,{
                title: 'Äang xá»­ lÃ½',
                type: 'loading',
                message: '<img src="'+Settings.imgurl+'/loading_more.gif" alt="Äang thá»±c hiá»‡n" style="margin-bottom:5px;margin-left:10px;" />'
            });

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: Settings.baseurl + '/inbox/insertmessage/',
                data: {
                    id : Message.options.receiver ,
                    title : title,
                    content : content
                },
                success:function(data)
                {
                    var boxy = Boxy.get($('.popup'));
                    boxy.hide();
                    if(data.error_code == '1')
                    {
                        $(this).myBoxy (Boxy,{
                            type: 'alert',
                            message: data.error_message
                        });
                    }else
                    {
                        $(this).myBoxy (Boxy,{
                            type: 'success',
                            message: 'Báº¡n Ä‘Ã£ gá»­i tin nháº¯n Ä‘áº¿n shop <strong>'+ Message.options.shopName +'</strong> thÃ nh cÃ´ng!'
                        });
                    }
                }
            });
        }
    },
    reply:function()
    {
        if(Account.UNAME == '')
        {
            login.popup_login();
            return false;
        }
        var html = '<div class="popup" style="width:450px;margin:0 auto"><div class="loading" style="display:none"><span></span>loading...</div><div class="title-popup">Pháº£n há»“i tin nháº¯n<a title="ÄÃ³ng láº¡i" class="btn-close close"><img src="'+Settings.imgurl+'/boxy/close_boxy.png" width="30" height="30" alt="ÄÃ³ng láº¡i" /></a></div><div class="content-popup"><div class="msg-form"><p class="notice-error" style="display:none">Xin vui lÃ²ng nháº­p Ä‘áº§y Ä‘á»§ thÃ´ng tin</p><p class="row-info clearfix"><label for="name">NgÆ°á»i nháº­n:</label><span class="txt">'+Message.options.receiver+'</span></p><p class="row-info clearfix"><label for="title">TiÃªu Ä‘á»:</label><input class="input-msg disabled-input" name="title" type="text" disabled="disabled" value="'+Message.options.titleReply+'"></p><p class="row-info clearfix"><label for="content">Ná»™i dung tin nháº¯n:</label><textarea id="content_reply" class="ctn-content"></textarea></p><div class="clear"></div></div><div class="clear"></div></div><div class="footer-popup"><div class="btn-default btn-double"><input class="btn-accept" name="" onclick="Message.sendReply()" type="button" value="Gá»­i Ä‘i" /><input class="btn-cancel close" name="" type="button" value="Há»§y bá»" /></div></div></div>';
        this.boxy = new Boxy(html, {
            modal:true,
            unloadOnHide: true
        });
    },

    sendReply:function()
    {
        var error = 0;
        content = $('#content_reply').val();
        if(content == "")
        {
            error = 1;
            msgError = "Báº¡n chÆ°a nháº­p ná»™i dung cho tin nháº¯n!";
        }
        if(error == 1){
            $('.notice-error').text(msgError);
            $('.notice-error').css('display','block');
        }
        else{
            var boxy = Boxy.get($(".popup"));
            boxy.hide();
            $.blockUI();
            $('.btn-close').click();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: Settings.baseurl+'/inbox/insertmessagereply/',
                data: {
                    id : Message.options.msgId ,
                    sender_id : Account.UID,
                    content : content
                },
                success:function(data)
                {
                    $.unblockUI();
                    if(data == 1)
                    {
                        $(this).myBoxy (Boxy,{
                            type: 'success',
                            message: 'Báº¡n Ä‘Ã£ gá»­i tin nháº¯n Ä‘áº¿n <strong>'+ Message.options.shopName +'</strong> thÃ nh cÃ´ng!',
                            refresh:true
                        });
                    }
                }
            });
        }
    }
};
/******************************
 End Class Message
 ******************************/

function fb_share(linkToShare, titleToShare, descToShare, imgToShare) {
    FB.ui({
        method: 'feed',
        link: linkToShare,
        name: titleToShare,
        description: descToShare,
        picture: imgToShare
    });
}