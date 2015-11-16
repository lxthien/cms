function Login() {
    this.settings = {
        check_login_url: "",
        //x_domain: "",
        logged_container: ".site-nav",
        user: ""
    };
    this.checkLogin = function () {//fillLoggedContent
        var a = this.settings;
        $.get(a.check_login_url, function (b) {
            if (b != "") {
                $(a.logged_container).html(b)
            }
        })
    };
    /*this.loginSocial = function (type) {
     location.href = '/profile/social?s='+type+'&return=' + document.URL;
     };
     this.checkLogin2 = function () {
     var a = this.settings;
     var b = this;

     $.ajax({
     url: a.check_login_url,
     dataType: "jsonp",
     //timeout: 5000,
     async: false,
     type: "POST",
     success: function () {
     if (c.isLogined == 1) {
     $.cookie("acn", c.acn, 0, {
     path: "/"
     });
     $.cookie("uin", c.uin, 0, {
     path: "/"
     });
     }
     //b.fillLoggedContent()
     },
     error: function () {
     b.fillLoggedContent()
     }
     })
     };*/
};

Login.prototype.init = function (a) {
    var b = this;
    this.settings = $.extend({}, this.settings, a);
    $(".login_in").fancybox({
        wrapCSS: "ui-modal-box",
        type: "iframe",
        padding: 0,
        margin: 0,
        fitToView: false,
        width: 502,
        autoSize: false,
        closeClick: false,
        openEffect: "none",
        closeEffect: "none"
    })
};