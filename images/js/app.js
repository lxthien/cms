var frmCommentValidator ;

$(document).ready(function(){

    $(window).bind('scroll', function (event) {
        if ($(window).scrollTop() > 120) {
            $('.menu-navigation').addClass('navbar-fixed-top');
            $('.back-to-top').fadeIn(500);
        }else {
            $('.menu-navigation').removeClass('navbar-fixed-top');
            $('.back-to-top').fadeOut(500);
        }
    });

    $(".back-to-top a").click(function(){
        $('html, body').animate({scrollTop : 0}, 800);
        return false;
    });


    /**
     * Jquery to run caroufredsel for partner
     */
    $('ul.ul-partner-home').carouFredSel({
        responsive: true,
        width: '100%',
        height: '100%',
        auto: 7000,
        prev: '#partner-prev',
        next: '#partner-next',
        scroll: 1,
        swipe: {
            onMouse: true,
            onTouch: true
        },
        items: {
            width: 140,
            visible: {
                min: 2,
                max: 6
            }
        }
    });

    /**
     * Jquery to run caroufredsel project hot
     */
    /*$('ul.ul-project-hot').carouFredSel({
        responsive: true,
        width: '100%',
        height: '140',
        auto: false,
        prev: '#project-hot-prev',
        next: '#project-hot-next',
        scroll: 1,
        swipe: {
            onMouse: true,
            onTouch: true
        },
        items: {
            width: "140",
            visible: {
                min: 1,
                max: 5
            }
        }
    });*/

    /**
     * Jquery to run caroufredsel for customer
     */
    /*$('ul.ul-comment-customer').carouFredSel({
        responsive: true,
        width: '100%',
        auto: false,
        prev: '#customer-prev',
        next: '#customer-next',
        mousewheel: true,
        scroll: 1,
        swipe: {
            onMouse: true,
            onTouch: true
        },
        items: {
            visible: {
                min: 1,
                max: 1
            }
        }
    });*/

    /**
     * Jquery to run caroufredsel for news homepage
     */
    /*$('ul.ul-news-home').carouFredSel({
        responsive: true,
        width: '100%',
        auto: false,
        prev: '#news-prev',
        next: '#news-next',
        mousewheel: true,
        scroll: 1,
        swipe: {
            onMouse: true,
            onTouch: true
        },
        items: {
            visible: {
                min: 1,
                max: 1
            }
        }
    });*/

    /**
     * Jquery to run caroufredsel for banner
     */
    $('.tp-banner').show().revolution({
        delay: 5000,
        startwidth: 1030,
        startheight: 400,

        hideThumbs: false,

        thumbWidth:165,
        thumbHeight:125,
        thumbAmount:3,

        navigationType: "none",
        navigationArrows: "none",

        navigationStyle: "round",


        navigationHAlign: "center",
        navigationVAlign: "bottom",
        navigationHOffset: 0,
        navigationVOffset: 20,

        soloArrowLeftHalign: "left",
        soloArrowLeftValign: "center",
        soloArrowLeftHOffset: 20,
        soloArrowLeftVOffset: 20,

        soloArrowRightHalign: "right",
        soloArrowRightValign: "center",
        soloArrowRightHOffset: 20,
        soloArrowRightVOffset: 20,

        touchenabled: "on",
        onHoverStop: "on"
    });

    $('#form-comment button#submit-comment').click(function(e){
        e.preventDefault();
        var url = $("#form-comment").attr('action');
        if ($("#form-comment").valid()){
            $.ajax({
                url: url,
                data: $("#form-comment").serialize(),
                type: "POST",
                dataType:"JSON",
                success:function(data){
                    if(data.status == false)
                    {
                        alert("Vui lòng nhập đúng ký tự xác nhận");
                        //$("#changeCaptcha").click();
                    }
                    else
                    {
                        $(":input[name='email'],:input[name='phone'],textarea[name='content'],:input[name='captcha_code']").val("");
                        frmCommentValidator.resetForm();
                        //$("#changeCaptcha").click();
                        alert("Bạn vừa gửi bình luận thành công. Bình luận của bạn sẽ được kiểm duyệt trước khi hiển thị.");
                    }
                }
            });
        }
    });

    frmCommentValidator = $("#form-comment").validate({
        rules:{
            name:{
                required:true
            },
            email:{
                required:true,
                email:true
            },
            phone:{
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

    $('#myform').validate({
        rules:{
            title:{
                required:true,
                maxlength:100
            },
            name:{
                required: true,
                maxlength:50
            },
            email:{
                required: true,
                email:true
            },
            captcha_code:{
                required: true
            }
        },
        messages:{
            title:{
                required:"<br />Vui lòng nhập tiêu đề"	,
                maxlength:"<br />Tiêu đề tối đa 100 kí tự"
            },
            name:{
                required: "<br />Vui lòng nhập họ tên của bạn",
                maxlength:"<br />Tên không quá 50 kí tự"
            },
            email:{
                required: "<br />Vui lòng nhập địa chỉ email",
                email: "<br />Nhập đúng dạng địa chỉ email"
            },
            captcha_code:{
                required: "<br />Nhập lại mã bảo vệ"
            }
        }
    });

    $('#myformContact').validate({
        rules:{
            title:{
                required:true,
                maxlength:100
                },
            name:{
                required: true,
                maxlength:50
            },
            email:{
                required: true,
                email:true
            },
            address:{
                required: true
            },
            phone:{
                number: true,
                required: true
            },
            content:{
                required: true
            },
            captcha_code:{
                required: true
            }
            
        },
        messages:{
            title:{
                required:"<font color=red>Vui lòng nhập chủ đề</font>"  ,
                maxlength:"<font color=red>Tiêu đề tối đa 100 kí tự</font>"
                },
            name:{
                required: "<font color=red>Vui lòng nhập họ tên của bạn</font>",
                maxlength:"<font color=red>Tên không quá 50 kí tự</font>"
            },
            email:{
                required: "<font color=red>Vui lòng nhập địa chỉ email</font>",
                email: "<font color=red>Nhập đúng dạng địa chỉ email</font>"
            },
            address:{
                required: "<font color=red>Vui lòng nhập địa chỉ</font>"
            },
            phone:{
                number: "<font color=red>Vui lòng chỉ nhập số</font>",
                required: "<font color=red>Vui lòng nhập số điện thoại</font>"
            },
            content:{
                required: "<font color=red>Vui lòng nhập nội dung</font>"
            },
            captcha_code:{
                required: "<font color=red>Nhập lại mã bảo vệ</font>"
            }
        }
    });
});