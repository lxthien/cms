function replaceChar(str) {

    str = str.toLowerCase();

    str = str.replace(/ /g, '-');

    str = str.replace(/\&/g, '-');

    str = str.replace(/\'/g, '');

    str = str.replace(/\+/g, '-plus');

    return str;

}





function gup( name ){

    name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");

    var regexS = "[\\?&]"+name+"=([^&#]*)";

    var regex = new RegExp( regexS );

    var results = regex.exec( window.location.href );

    if( results == null )

        return "";

    else

        return results[1];

}



function urldecode(str) {

    return decodeURIComponent((str+'').replace(/\+/g, '%20'));

}



function getRandomInt (min, max) {

    return Math.floor(Math.random() * (max - min + 1)) + min;

}



function setCookie(c_name,value){

    document.cookie=c_name + "=" + value;

}

function getCookie(c_name){

    var i,x,y,ARRcookies=document.cookie.split(";");

    for (i=0;i<ARRcookies.length;i++)

    {

        x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));

        y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);

        x=x.replace(/^\s+|\s+$/g,"");

        if (x==c_name)

        {

            return unescape(y);

        }

    }

}


function split_three_numbers(str) {
    var _str = "";

    var len = str.length;

    for(i = len - 1; i >= 0; i --) {

        if(i && (len - i) % 3 == 0) {

            _str = "." + str[i] + _str;

        }

        else {

            _str = str[i] + _str;

        }

    }

    return _str;

}


function popupRegister(){

    //jQuery('body').append('<div id="popup-register"><div class="register-form"><p class="btn-close"><a href="javascript:void(0);"></a></p><div class="register-form-inner"><div class="popcontainer"><form id="formSub-reg" method="post" class="formreg" action=""><p id="error-reg" class="error2"></p><p><input type="text" class="inputbox" id="fullname-reg" name="fullname-reg" onfocus="if (this.value ==\'Email hoáº·c Sá»‘ Ä‘iá»‡n thoáº¡i\') this.value=\'\'" onblur="if (this.value ==\'Email hoáº·c Sá»‘ Ä‘iá»‡n thoáº¡i\') this.value=\'\'" value="Email hoáº·c Sá»‘ Ä‘iá»‡n thoáº¡i"><input type="text" id="email-reg" name="email-reg" onfocus="if (this.value ==\'Email...\') this.value=\'\'" onblur="if (this.value ==\'Email...\') this.value=\'\'" value="Email..." class="inputbox"> <select id="gender-reg" name="gender-reg"> <option value="" disabled="disabled" selected="selected">Giá»›i tÃ­nh</option> <option value="Female">Ná»¯</option> <option value="Male">Nam</option> </select>  </p> <p class="btn"><input type="button" name="btn-subscribe" title="ÄÄƒng kÃ½" value="ÄÄƒng kÃ½" id="btn-subscribe" onclick="checkFormPopup();" class="button"><img alt="" style="display:none" class="loading" name="imgLoading" id="imgLoading-reg" src="http://haisancamau.com/images/loading_icon_small.gif"></p>  </form></div></div></div><div class="register-button open"></div>');



    var $closeBox = function() {

        $('.register-form').animate({

            height: '0px',

        }, 600, function() {

            // Animation complete.

            $('.register-button').removeClass('open');

            // set cookie

            setCookie('popupRegister', 'close');



        });

    };



    var $openBox = function() {

        $('.register-form').animate({

            height: '261px'

        }, 600, function() {

            // Animation complete.

            $('.register-button').addClass('open');

            // set cookie

            setCookie('popupRegister', 'open');



        });

    };



    $('.register-button').click(function(){

        if ( $(this).hasClass('open') ){

            $closeBox();

        } else {

            $openBox();

        }

    });



    $('.register-form .btn-close').find('a').click(function(){

        //alert('waiting...');

        $closeBox();



    });



    if (getCookie('popupRegister') == 'close') {

        $closeBox();

    } else {

        $openBox();

    }

}

/////////////

function checkFormPopup(urlajax) {
    var fullname = jQuery("#fullname-reg").val();
    var content = jQuery("#content-reg").val();
    jQuery("#error-reg").show();
    if(fullname == "" || fullname =="Email hoặc Số điện thoại"){
        jQuery("#error-reg").html("Vui lòng nhập Email hoặc số điện thoại!");
        jQuery("#fullname-reg").focus();
        return false;
    }
    if(content == "" || content =="Nội dung"){
        jQuery("#error-reg").html("Vui lòng nhập nội dung!");
        jQuery("#content-reg").focus();
        return false;
    }


    var purl  = urlajax;
    var obj = document.getElementById("imgLoading-reg");
    var objRegister = document.getElementById("btn-subscribe");

    obj.style.display="block";
    objRegister.disabled = true;
    jQuery('#btn-subscribe').addClass('disabled');
    jQuery("#error-reg").html('');

    $.ajax({
        url: purl, //The url where the server req would we made.
        async: false,
        data: 'fullname='+fullname+'&content='+content,
        type: "POST", //The type which you want to use: GET/POST

        //This is the function which will be called if ajax call is successful.
        success: function(data) {
            if (data == 1){
                obj.style.display="none";
                jQuery("#formSub-reg").html('<div style="font-size:12px; text-align:center; padding-top:10px"><a alt="Đóng cửa sổ này" class="btn-close" href="javascript:void(0);" onclick="closeForm()"></a><p style="font-size: 12px;">Cám ơn bạn gửi thông tin tới muabanxeford.com.vn</p></div>');
                setCookie('Success-register', 1);

                setTimeout(function(){
                    $('.register-form').animate({
                        height: '0px'
                    }, 600, function() {
                        $('.register-button').css('display', 'none');
                    });
                },800);
            }else {
                jQuery("#error-reg").show();
                jQuery("#error-reg").html(data);
                jQuery('#btn-subscribe').removeClass('disabled');
                objRegister.disabled = false;
                obj.style.display="none";
            }
        }
    });
}