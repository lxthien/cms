$(document).ready(function(){
    $('.tright-slider ul').bxSlider({
        mode: 'vertical',
        pager: false,
        moveSlides: 1,
        slideWidth: 150,
        slideHeight: 80,
        minSlides: 1,
        maxSlides: 1,
        slideMargin: 12,
        auto: true,
        speed: 1000,
        pause: 5000
    });

    $('#top_product_order').show();

    $('.top-slider ul').bxSlider({
        auto:true,
        pager:false,
        slideWidth:788,
        minSlides:1,
        maxSlides:1,
        moveSlides:1,
        slideMargin:0,
        pause: 5000
    });

    $('.bslide').show();

    $('.slider-block-s1 .bslide ul').bxSlider({
        auto:false,
        pager:true,
        controls:true,
        slideWidth:133,
        slideHeight:185,
        minSlides:5,
        maxSlides:5,
        moveSlides:5,
        slideMargin:8
    });

    //$('.sp-filter').sticky({topSpacing:0, bottomSpacing:700});

    $('.top-slider').hover(function()
    {
        $('.bx-next', $(this)).animate({right:'-1px'}, 80, 'linear',function(){
            $('.bx-next', $(this)).show();
        });
        $('.bx-prev', $(this)).animate({left:'-1px'}, 80, 'linear',function(){
            $('.bx-prev', $(this)).show();
        });
    },function(){
        $('.bx-next', $(this)).animate({right:'-42px'}, 80, 'linear',function(){
            $('.bx-next', $(this)).hide();
        });
        $('.bx-prev', $(this)).animate({left:'-42px'}, 80, 'linear',function(){
            $('.bx-prev', $(this)).hide();
        });
    });

    $('.s1-img-list a').hover(function() {
        $('.s1-img-list a').removeClass('active');
        $(this).addClass('active');
    });
    $('.s1-img-list .nav-1').hover(function() {
        $($('.s1-img-slider ul'),$(this).parents().prev()).animate({left:'0'}, 0, 'linear')
    });
    $('.s1-img-list .nav-2').hover(function() {
        $($('.s1-img-slider ul'),$(this).parents().prev()).animate({left:'-200px'}, 0, 'linear')
    });
    $('.s1-img-list .nav-3').hover(function() {
        $($('.s1-img-slider ul'),$(this).parents().prev()).animate({left:'-400px'}, 0, 'linear')
    });

    $('.sp-filter ul.f-listin').each(function() {
        if($(this)[0].scrollHeight > 32) {
            $('li', this).eq(5).nextAll().hide().addClass('toggleable');
            $(this).append('<a href="javascript:void(0)" class="f-btn">+</a>');
        }
    });
    $('.sp-filter ul.f-listin').on('click', '.f-btn', function() {
        if($(this).hasClass('less')) {
            $(this).text('+').removeClass('less');
        } else {
            $(this).text('-').addClass('less');
        }
        $(this).siblings('li.toggleable').slideToggle('fast');
    });

    $('.change-cate').click(function(){
        $('.change-cate').removeClass('active');
        $(this).addClass('active');
        var dataTab = $(this).attr("data-tab");
        $('.tab-content').removeClass("active");
        $('#'+dataTab).addClass("active");
        $('.btn-seemore').hide();
        $('#list_up_home').html("");
        $('#loading_more').show();
        indexPage.pageCurrent = 1;
        indexPage.cateCurrent = $(this).attr('rel');
        $.post(Settings.baseurl + '/index/get-list-product', {cid: indexPage.cateCurrent, page: indexPage.pageCurrent, limit: indexPage.limit, filter: indexPage.filter}, function(data){
            if(data.rs == 1){
                var html = indexPage.createHtmlProduct(data.list, data.view, data.bookmark);
                $('#offset_up').text(data.of);
                $('#limit_up').text(data.li);
                $('#total_product').text(data.total);
                if(indexPage.pageCurrent == indexPage.totalPage){
                    $('.btn-seemore').hide();
                    $('#loading_more').hide();
                }else{
                    $('.btn-seemore').show();
                    $('#loading_more').hide();
                }
                $('#list_up_home').html(html);
            }else{
                $('#loading_more').hide();
                $('.btn-seemore').hide();
            }
        },'Json');
    })

    $('#view_more').click(function(){
        $('.btn-seemore').hide();
        $('#loading_more').show();
        indexPage.pageCurrent++;
        $.post(Settings.baseurl + '/index/get-list-product', {cid: indexPage.cateCurrent, page: indexPage.pageCurrent, limit: indexPage.limit, filter: indexPage.filter}, function(data){
            if(data.rs == 1){
                var html = indexPage.createHtmlProduct(data.list, data.view, data.bookmark);
                $('#offset_up').text(data.of);
                $('#limit_up').text(data.li);
                if(indexPage.pageCurrent == indexPage.totalPage){
                    $('.btn-seemore').hide();
                    $('#loading_more').hide();
                }else{
                    $('.btn-seemore').show();
                    $('#loading_more').hide();
                }
                $('#list_up_home').append(html);
            }else{
                $('#loading_more').hide();
                $('.btn-seemore').hide();
            }
        },'Json');
    });

    $('#filter-product').change(function(){
        indexPage.filter = $(this).val();
        $('.btn-seemore').hide();
        $('#list_up_home').html("");
        $('#loading_more').show();
        indexPage.pageCurrent = 1;
        $.post(Settings.baseurl + '/index/get-list-product', {cid: indexPage.cateCurrent, page: indexPage.pageCurrent, limit: indexPage.limit, filter: indexPage.filter}, function(data){
            if(data.rs == 1){
                var html = indexPage.createHtmlProduct(data.list, data.view, data.bookmark);
                $('#offset_up').text(data.of);
                $('#limit_up').text(data.li);
                $('#total_product').text(data.total);
                if(indexPage.pageCurrent == indexPage.totalPage){
                    $('.btn-seemore').hide();
                    $('#loading_more').hide();
                }else{
                    $('.btn-seemore').show();
                    $('#loading_more').hide();
                }
                $('#list_up_home').html(html);
            }else{
                $('#loading_more').hide();
                $('.btn-seemore').hide();
            }
        },'Json');

    });
});