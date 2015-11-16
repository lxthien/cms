var idgen = 0;

var ElementTextCache = {};
var tblParentCache = {};
var JumpEl;
var jumpcount = 0;

function searchpage(searchBoxEl) {
    var searchText = searchBoxEl.value.toLowerCase();
    var liEls = document.getElementsByTagName('li');
    var matchCount = 0;
    var allParentUls = {};
    var matchedParentUls = {};
    var matchEl;
    for(var i = 0;i < liEls.length;i++) {
        var innerText;

        if (!ElementTextCache[liEls[i].id] || ElementTextCache[liEls[i].id] == "") {
            var AddedsearchText = liEls[i].getAttribute('searchtext');
            innerText = liEls[i].innerHTML.replace(/\<[^\>]+\>/g,'').toLowerCase();
            if (AddedsearchText) {
                innerText += " " + AddedsearchText;
            }
            ElementTextCache[liEls[i].id] = innerText;
        } else {
            innerText = ElementTextCache[liEls[i].id];
        }


        var tblParent = getTblParent(liEls[i]);
        if (innerText.match(searchText)) {
            matchEl = liEls[i];
            matchCount++;


            liEls[i].className='searchshow';
            matchedParentUls[tblParent.id] = 1;
            allParentUls[tblParent.id] = tblParent;
        } else {
            allParentUls[tblParent.id] = tblParent;
            liEls[i].className='searchhide';
        }
    }
    if (matchCount == 0) {
        document.getElementById('gosearch').style.display='';
    } else {
        document.getElementById('gosearch').style.display='none';
    }

    for(var i in allParentUls) {
        if (matchedParentUls[i]) {
            allParentUls[i].className='searchshow';
        } else {
            allParentUls[i].className='searchhide';
        }
    }
}

function getTblParent(tagEl) {
    if (!tagEl.id) {
        tagEl.id = 'idgen' + idgen++;
    }
    if (tblParentCache[tagEl.id]) {
        return tblParentCache[tagEl.id];
    }

    var thisEl = tagEl;
    while(thisEl.tagName != "TABLE" && thisEl.parentNode) {
        thisEl = thisEl.parentNode;
    }
    tblParentCache[tagEl.id] = thisEl;
    return thisEl;
}

function clearsearch() {
    var quickJumpEl = document.getElementById('quickjump');
    quickJumpEl.value='';
    searchpage(quickJumpEl);

}
function gosearch() {
    var lnkEls = jumpEl.getElementsByTagName('a');
    if (! lnkEls[0].name) {
        lnkEls[0].name = 'jump' + jumpcount++;
    }
    window.location.href='#' + lnkEls[0].name;
}

function number_format(number, decimals, dec_point, thousands_sep) {
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    /* Fix for IE parseFloat(0.55).toFixed(0) = 0; */
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

/**
 * Copyright (C) 2006-2009, QuietAffiliate.com. All rights reserved.
 *
 * Script Name: Countdown Redirect
 *
 * THIS SOURCE CODE MAY BE USED FREELY PROVIDED THAT
 * YOU DO NOT REMOVE THIS MESSAGE.
 *
 * You can obtain this script at http://www.QuietAffiliate.com
 */

function countdownRedirect(url, msg)
{
    var TARG_ID = "COUNTDOWN_REDIRECT";
    var DEF_MSG = "Redirecting...";

    if( ! msg )
    {
        msg = DEF_MSG;
    }

    if( ! url )
    {
        throw new Error('You didn\'t include the "url" parameter');
    }


    var e = document.getElementById(TARG_ID);

    if( ! e )
    {
        //throw new Error('"COUNTDOWN_REDIRECT" element id not found');
    } else {
        var cTicks = parseInt(e.innerHTML);

        var timer = setInterval(function()
        {
            if( cTicks )
            {
                e.innerHTML = --cTicks;
            }
            else
            {
                clearInterval(timer);
                document.body.innerHTML = msg;
                location = url;
            }

        }, 1000);
    }
}

function round_float(x,n){
    if(!parseInt(n))
        var n=0;
    if(!parseFloat(x))
        return false;
    return Math.round(x*Math.pow(10,n))/Math.pow(10,n);
}

function fbs_click(u,t) {
    window.open('https://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');
    return false;
}

function zms_click(u,t) {
    window.open('http://link.apps.zing.vn/share?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');
    return false;
}

function quickView(){
    $(".quick-view").click(function(){
        var href = $(this).attr('href');
        $.ajax({
            type: 'GET',
            cache: false,
            url: href,
            success: function(data){
                $.fancybox(data,{
                    'scrolling' : 'no'
                });
                $('#fancybox-content').css('background-color','#666666');

                scripts = $("#fancybox-content script");
                for(var i = 0; i < scripts.length; i++) {
                    eval(scripts[i].innerHTML);
                }
            }
        });

        return false;
    });

    $(".product_img, .thumb-promo-sub").bind('mouseout', function(){
        $('a.quick-view', this).hide();
        //$('a.view-zoom-point', this).hide();
    });

    $(".product_img, .thumb-promo-sub").bind('mouseover', function(){
        $('a.quick-view', this).show();
        //$('a.view-zoom-point', this).show();
    });
}

(function(b,f){
    var a=0,e=/^ui-id-\d+$/;
    b.ui=b.ui||{};

    b.extend(b.ui,{
        version:"1.10.3",
        keyCode:{
            BACKSPACE:8,
            COMMA:188,
            DELETE:46,
            DOWN:40,
            END:35,
            ENTER:13,
            ESCAPE:27,
            HOME:36,
            LEFT:37,
            NUMPAD_ADD:107,
            NUMPAD_DECIMAL:110,
            NUMPAD_DIVIDE:111,
            NUMPAD_ENTER:108,
            NUMPAD_MULTIPLY:106,
            NUMPAD_SUBTRACT:109,
            PAGE_DOWN:34,
            PAGE_UP:33,
            PERIOD:190,
            RIGHT:39,
            SPACE:32,
            TAB:9,
            UP:38
        }
    });
    b.fn.extend({
        focus:(function(g){
            return function(h,i){
                return typeof h==="number"?this.each(function(){
                    var j=this;
                    setTimeout(function(){
                        b(j).focus();
                        if(i){
                            i.call(j)
                        }
                    },h)
                }):g.apply(this,arguments)
            }
        })(b.fn.focus),
        scrollParent:function(){
            var g;
            if((b.ui.ie&&(/(static|relative)/).test(this.css("position")))||(/absolute/).test(this.css("position"))){
                g=this.parents().filter(function(){
                    return(/(relative|absolute|fixed)/).test(b.css(this,"position"))&&(/(auto|scroll)/).test(b.css(this,"overflow")+b.css(this,"overflow-y")+b.css(this,"overflow-x"))
                }).eq(0)
            }else{
                g=this.parents().filter(function(){
                    return(/(auto|scroll)/).test(b.css(this,"overflow")+b.css(this,"overflow-y")+b.css(this,"overflow-x"))
                }).eq(0)
            }
            return(/fixed/).test(this.css("position"))||!g.length?b(document):g
        },
        zIndex:function(j){
            if(j!==f){
                return this.css("zIndex",j)
            }
            if(this.length){
                var h=b(this[0]),g,i;
                while(h.length&&h[0]!==document){
                    g=h.css("position");
                    if(g==="absolute"||g==="relative"||g==="fixed"){
                        i=parseInt(h.css("zIndex"),10);
                        if(!isNaN(i)&&i!==0){
                            return i
                        }
                    }
                    h=h.parent()
                }
            }
            return 0
        },
        uniqueId:function(){
            return this.each(function(){
                if(!this.id){
                    this.id="ui-id-"+(++a)
                }
            })
        },
        removeUniqueId:function(){
            return this.each(function(){
                if(e.test(this.id)){
                    b(this).removeAttr("id")
                }
            })
        }
    });
    function d(i,g){
        var k,j,h,l=i.nodeName.toLowerCase();
        if("area"===l){
            k=i.parentNode;
            j=k.name;
            if(!i.href||!j||k.nodeName.toLowerCase()!=="map"){
                return false
            }
            h=b("img[usemap=#"+j+"]")[0];
            return !!h&&c(h)
        }
        return(/input|select|textarea|button|object/.test(l)?!i.disabled:"a"===l?i.href||g:g)&&c(i)
    }
    function c(g){
        return b.expr.filters.visible(g)&&!b(g).parents().addBack().filter(function(){
            return b.css(this,"visibility")==="hidden"
        }).length
    }
    b.extend(b.expr[":"],{
        data:b.expr.createPseudo?b.expr.createPseudo(function(g){
            return function(h){
                return !!b.data(h,g)
            }
        }):function(j,h,g){
            return !!b.data(j,g[3])
        },
        focusable:function(g){
            return d(g,!isNaN(b.attr(g,"tabindex")))
        },
        tabbable:function(i){
            var g=b.attr(i,"tabindex"),h=isNaN(g);
            return(h||g>=0)&&d(i,!h)
        }
    });
    if(!b("<a>").outerWidth(1).jquery){
        b.each(["Width","Height"],function(j,g){
            var h=g==="Width"?["Left","Right"]:["Top","Bottom"],k=g.toLowerCase(),m={
                innerWidth:b.fn.innerWidth,
                innerHeight:b.fn.innerHeight,
                outerWidth:b.fn.outerWidth,
                outerHeight:b.fn.outerHeight
            };

            function l(o,n,i,p){
                b.each(h,function(){
                    n-=parseFloat(b.css(o,"padding"+this))||0;
                    if(i){
                        n-=parseFloat(b.css(o,"border"+this+"Width"))||0
                    }
                    if(p){
                        n-=parseFloat(b.css(o,"margin"+this))||0
                    }
                });
                return n
            }
            b.fn["inner"+g]=function(i){
                if(i===f){
                    return m["inner"+g].call(this)
                }
                return this.each(function(){
                    b(this).css(k,l(this,i)+"px")
                })
            };

            b.fn["outer"+g]=function(i,n){
                if(typeof i!=="number"){
                    return m["outer"+g].call(this,i)
                }
                return this.each(function(){
                    b(this).css(k,l(this,i,true,n)+"px")
                })
            }
        })
    }
    if(!b.fn.addBack){
        b.fn.addBack=function(g){
            return this.add(g==null?this.prevObject:this.prevObject.filter(g))
        }
    }
    if(b("<a>").data("a-b","a").removeData("a-b").data("a-b")){
        b.fn.removeData=(function(g){
            return function(h){
                if(arguments.length){
                    return g.call(this,b.camelCase(h))
                }else{
                    return g.call(this)
                }
            }
        })(b.fn.removeData)
    }
    b.ui.ie=!!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase());
    b.support.selectstart="onselectstart" in document.createElement("div");
    b.fn.extend({
        disableSelection:function(){
            return this.bind((b.support.selectstart?"selectstart":"mousedown")+".ui-disableSelection",function(g){
                g.preventDefault()
            })
        },
        enableSelection:function(){
            return this.unbind(".ui-disableSelection")
        }
    });
    b.extend(b.ui,{
        plugin:{
            add:function(h,j,l){
                var g,k=b.ui[h].prototype;
                for(g in l){
                    k.plugins[g]=k.plugins[g]||[];
                    k.plugins[g].push([j,l[g]])
                }
            },
            call:function(g,j,h){
                var k,l=g.plugins[j];
                if(!l||!g.element[0].parentNode||g.element[0].parentNode.nodeType===11){
                    return
                }
                for(k=0;k<l.length;k++){
                    if(g.options[l[k][0]]){
                        l[k][1].apply(g.element,h)
                    }
                }
            }
        },
        hasScroll:function(j,h){
            if(b(j).css("overflow")==="hidden"){
                return false
            }
            var g=(h&&h==="left")?"scrollLeft":"scrollTop",i=false;
            if(j[g]>0){
                return true
            }
            j[g]=1;
            i=(j[g]>0);
            j[g]=0;
            return i
        }
    })
})(jQuery);
(function(b,e){
    var a=0,d=Array.prototype.slice,c=b.cleanData;
    b.cleanData=function(f){
        for(var g=0,h;(h=f[g])!=null;g++){
            try{
                b(h).triggerHandler("remove")
            }catch(j){}
        }
        c(f)
    };

    b.widget=function(f,g,n){
        var k,l,i,m,h={},j=f.split(".")[0];
        f=f.split(".")[1];
        k=j+"-"+f;
        if(!n){
            n=g;
            g=b.Widget
        }
        b.expr[":"][k.toLowerCase()]=function(o){
            return !!b.data(o,k)
        };

        b[j]=b[j]||{};

        l=b[j][f];
        i=b[j][f]=function(o,p){
            if(!this._createWidget){
                return new i(o,p)
            }
            if(arguments.length){
                this._createWidget(o,p)
            }
        };

        b.extend(i,l,{
            version:n.version,
            _proto:b.extend({},n),
            _childConstructors:[]
        });
        m=new g();
        m.options=b.widget.extend({},m.options);
        b.each(n,function(p,o){
            if(!b.isFunction(o)){
                h[p]=o;
                return
            }
            h[p]=(function(){
                var q=function(){
                    return g.prototype[p].apply(this,arguments)
                },r=function(s){
                    return g.prototype[p].apply(this,s)
                };

                return function(){
                    var u=this._super,s=this._superApply,t;
                    this._super=q;
                    this._superApply=r;
                    t=o.apply(this,arguments);
                    this._super=u;
                    this._superApply=s;
                    return t
                }
            })()
        });
        i.prototype=b.widget.extend(m,{
            widgetEventPrefix:l?m.widgetEventPrefix:f
        },h,{
            constructor:i,
            namespace:j,
            widgetName:f,
            widgetFullName:k
        });
        if(l){
            b.each(l._childConstructors,function(p,q){
                var o=q.prototype;
                b.widget(o.namespace+"."+o.widgetName,i,q._proto)
            });
            delete l._childConstructors
        }else{
            g._childConstructors.push(i)
        }
        b.widget.bridge(f,i)
    };

    b.widget.extend=function(k){
        var g=d.call(arguments,1),j=0,f=g.length,h,i;
        for(;j<f;j++){
            for(h in g[j]){
                i=g[j][h];
                if(g[j].hasOwnProperty(h)&&i!==e){
                    if(b.isPlainObject(i)){
                        k[h]=b.isPlainObject(k[h])?b.widget.extend({},k[h],i):b.widget.extend({},i)
                    }else{
                        k[h]=i
                    }
                }
            }
        }
        return k
    };

    b.widget.bridge=function(g,f){
        var h=f.prototype.widgetFullName||g;
        b.fn[g]=function(k){
            var i=typeof k==="string",j=d.call(arguments,1),l=this;
            k=!i&&j.length?b.widget.extend.apply(null,[k].concat(j)):k;
            if(i){
                this.each(function(){
                    var n,m=b.data(this,h);
                    if(!m){
                        return b.error("cannot call methods on "+g+" prior to initialization; attempted to call method '"+k+"'")
                    }
                    if(!b.isFunction(m[k])||k.charAt(0)==="_"){
                        return b.error("no such method '"+k+"' for "+g+" widget instance")
                    }
                    n=m[k].apply(m,j);
                    if(n!==m&&n!==e){
                        l=n&&n.jquery?l.pushStack(n.get()):n;
                        return false
                    }
                })
            }else{
                this.each(function(){
                    var m=b.data(this,h);
                    if(m){
                        m.option(k||{})._init()
                    }else{
                        b.data(this,h,new f(k,this))
                    }
                })
            }
            return l
        }
    };

    b.Widget=function(){};

    b.Widget._childConstructors=[];
    b.Widget.prototype={
        widgetName:"widget",
        widgetEventPrefix:"",
        defaultElement:"<div>",
        options:{
            disabled:false,
            create:null
        },
        _createWidget:function(f,g){
            g=b(g||this.defaultElement||this)[0];
            this.element=b(g);
            this.uuid=a++;
            this.eventNamespace="."+this.widgetName+this.uuid;
            this.options=b.widget.extend({},this.options,this._getCreateOptions(),f);
            this.bindings=b();
            this.hoverable=b();
            this.focusable=b();
            if(g!==this){
                b.data(g,this.widgetFullName,this);
                this._on(true,this.element,{
                    remove:function(h){
                        if(h.target===g){
                            this.destroy()
                        }
                    }
                });
                this.document=b(g.style?g.ownerDocument:g.document||g);
                this.window=b(this.document[0].defaultView||this.document[0].parentWindow)
            }
            this._create();
            this._trigger("create",null,this._getCreateEventData());
            this._init()
        },
        _getCreateOptions:b.noop,
        _getCreateEventData:b.noop,
        _create:b.noop,
        _init:b.noop,
        destroy:function(){
            this._destroy();
            this.element.unbind(this.eventNamespace).removeData(this.widgetName).removeData(this.widgetFullName).removeData(b.camelCase(this.widgetFullName));
            this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName+"-disabled ui-state-disabled");
            this.bindings.unbind(this.eventNamespace);
            this.hoverable.removeClass("ui-state-hover");
            this.focusable.removeClass("ui-state-focus")
        },
        _destroy:b.noop,
        widget:function(){
            return this.element
        },
        option:function(j,k){
            var f=j,l,h,g;
            if(arguments.length===0){
                return b.widget.extend({},this.options)
            }
            if(typeof j==="string"){
                f={};

                l=j.split(".");
                j=l.shift();
                if(l.length){
                    h=f[j]=b.widget.extend({},this.options[j]);
                    for(g=0;g<l.length-1;g++){
                        h[l[g]]=h[l[g]]||{};

                        h=h[l[g]]
                    }
                    j=l.pop();
                    if(k===e){
                        return h[j]===e?null:h[j]
                    }
                    h[j]=k
                }else{
                    if(k===e){
                        return this.options[j]===e?null:this.options[j]
                    }
                    f[j]=k
                }
            }
            this._setOptions(f);
            return this
        },
        _setOptions:function(f){
            var g;
            for(g in f){
                this._setOption(g,f[g])
            }
            return this
        },
        _setOption:function(f,g){
            this.options[f]=g;
            if(f==="disabled"){
                this.widget().toggleClass(this.widgetFullName+"-disabled ui-state-disabled",!!g).attr("aria-disabled",g);
                this.hoverable.removeClass("ui-state-hover");
                this.focusable.removeClass("ui-state-focus")
            }
            return this
        },
        enable:function(){
            return this._setOption("disabled",false)
        },
        disable:function(){
            return this._setOption("disabled",true)
        },
        _on:function(i,h,g){
            var j,f=this;
            if(typeof i!=="boolean"){
                g=h;
                h=i;
                i=false
            }
            if(!g){
                g=h;
                h=this.element;
                j=this.widget()
            }else{
                h=j=b(h);
                this.bindings=this.bindings.add(h)
            }
            b.each(g,function(p,o){
                function m(){
                    if(!i&&(f.options.disabled===true||b(this).hasClass("ui-state-disabled"))){
                        return
                    }
                    return(typeof o==="string"?f[o]:o).apply(f,arguments)
                }
                if(typeof o!=="string"){
                    m.guid=o.guid=o.guid||m.guid||b.guid++
                }
                var n=p.match(/^(\w+)\s*(.*)$/),l=n[1]+f.eventNamespace,k=n[2];
                if(k){
                    j.delegate(k,l,m)
                }else{
                    h.bind(l,m)
                }
            })
        },
        _off:function(g,f){
            f=(f||"").split(" ").join(this.eventNamespace+" ")+this.eventNamespace;
            g.unbind(f).undelegate(f)
        },
        _delay:function(i,h){
            function g(){
                return(typeof i==="string"?f[i]:i).apply(f,arguments)
            }
            var f=this;
            return setTimeout(g,h||0)
        },
        _hoverable:function(f){
            this.hoverable=this.hoverable.add(f);
            this._on(f,{
                mouseenter:function(g){
                    b(g.currentTarget).addClass("ui-state-hover")
                },
                mouseleave:function(g){
                    b(g.currentTarget).removeClass("ui-state-hover")
                }
            })
        },
        _focusable:function(f){
            this.focusable=this.focusable.add(f);
            this._on(f,{
                focusin:function(g){
                    b(g.currentTarget).addClass("ui-state-focus")
                },
                focusout:function(g){
                    b(g.currentTarget).removeClass("ui-state-focus")
                }
            })
        },
        _trigger:function(f,g,h){
            var k,j,i=this.options[f];
            h=h||{};

            g=b.Event(g);
            g.type=(f===this.widgetEventPrefix?f:this.widgetEventPrefix+f).toLowerCase();
            g.target=this.element[0];
            j=g.originalEvent;
            if(j){
                for(k in j){
                    if(!(k in g)){
                        g[k]=j[k]
                    }
                }
            }
            this.element.trigger(g,h);
            return !(b.isFunction(i)&&i.apply(this.element[0],[g].concat(h))===false||g.isDefaultPrevented())
        }
    };

    b.each({
        show:"fadeIn",
        hide:"fadeOut"
    },function(g,f){
        b.Widget.prototype["_"+g]=function(j,i,l){
            if(typeof i==="string"){
                i={
                    effect:i
                }
            }
            var k,h=!i?g:i===true||typeof i==="number"?f:i.effect||f;
            i=i||{};

            if(typeof i==="number"){
                i={
                    duration:i
                }
            }
            k=!b.isEmptyObject(i);
            i.complete=l;
            if(i.delay){
                j.delay(i.delay)
            }
            if(k&&b.effects&&b.effects.effect[h]){
                j[g](i)
            }else{
                if(h!==g&&j[h]){
                    j[h](i.duration,i.easing,l)
                }else{
                    j.queue(function(m){
                        b(this)[g]();
                        if(l){
                            l.call(j[0])
                        }
                        m()
                    })
                }
            }
        }
    })
})(jQuery);
(function(b,c){
    var a=false;
    b(document).mouseup(function(){
        a=false
    });
    b.widget("ui.mouse",{
        version:"1.10.3",
        options:{
            cancel:"input,textarea,button,select,option",
            distance:1,
            delay:0
        },
        _mouseInit:function(){
            var d=this;
            this.element.bind("mousedown."+this.widgetName,function(e){
                return d._mouseDown(e)
            }).bind("click."+this.widgetName,function(e){
                if(true===b.data(e.target,d.widgetName+".preventClickEvent")){
                    b.removeData(e.target,d.widgetName+".preventClickEvent");
                    e.stopImmediatePropagation();
                    return false
                }
            });
            this.started=false
        },
        _mouseDestroy:function(){
            this.element.unbind("."+this.widgetName);
            if(this._mouseMoveDelegate){
                b(document).unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate)
            }
        },
        _mouseDown:function(f){
            if(a){
                return
            }(this._mouseStarted&&this._mouseUp(f));
            this._mouseDownEvent=f;
            var e=this,g=(f.which===1),d=(typeof this.options.cancel==="string"&&f.target.nodeName?b(f.target).closest(this.options.cancel).length:false);
            if(!g||d||!this._mouseCapture(f)){
                return true
            }
            this.mouseDelayMet=!this.options.delay;
            if(!this.mouseDelayMet){
                this._mouseDelayTimer=setTimeout(function(){
                    e.mouseDelayMet=true
                },this.options.delay)
            }
            if(this._mouseDistanceMet(f)&&this._mouseDelayMet(f)){
                this._mouseStarted=(this._mouseStart(f)!==false);
                if(!this._mouseStarted){
                    f.preventDefault();
                    return true
                }
            }
            if(true===b.data(f.target,this.widgetName+".preventClickEvent")){
                b.removeData(f.target,this.widgetName+".preventClickEvent")
            }
            this._mouseMoveDelegate=function(h){
                return e._mouseMove(h)
            };

            this._mouseUpDelegate=function(h){
                return e._mouseUp(h)
            };

            b(document).bind("mousemove."+this.widgetName,this._mouseMoveDelegate).bind("mouseup."+this.widgetName,this._mouseUpDelegate);
            f.preventDefault();
            a=true;
            return true
        },
        _mouseMove:function(d){
            if(b.ui.ie&&(!document.documentMode||document.documentMode<9)&&!d.button){
                return this._mouseUp(d)
            }
            if(this._mouseStarted){
                this._mouseDrag(d);
                return d.preventDefault()
            }
            if(this._mouseDistanceMet(d)&&this._mouseDelayMet(d)){
                this._mouseStarted=(this._mouseStart(this._mouseDownEvent,d)!==false);
                (this._mouseStarted?this._mouseDrag(d):this._mouseUp(d))
            }
            return !this._mouseStarted
        },
        _mouseUp:function(d){
            b(document).unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate);
            if(this._mouseStarted){
                this._mouseStarted=false;
                if(d.target===this._mouseDownEvent.target){
                    b.data(d.target,this.widgetName+".preventClickEvent",true)
                }
                this._mouseStop(d)
            }
            return false
        },
        _mouseDistanceMet:function(d){
            return(Math.max(Math.abs(this._mouseDownEvent.pageX-d.pageX),Math.abs(this._mouseDownEvent.pageY-d.pageY))>=this.options.distance)
        },
        _mouseDelayMet:function(){
            return this.mouseDelayMet
        },
        _mouseStart:function(){},
        _mouseDrag:function(){},
        _mouseStop:function(){},
        _mouseCapture:function(){
            return true
        }
    })
})(jQuery);
(function(a,b){
    a.widget("ui.draggable",a.ui.mouse,{
        version:"1.10.3",
        widgetEventPrefix:"drag",
        options:{
            addClasses:true,
            appendTo:"parent",
            axis:false,
            connectToSortable:false,
            containment:false,
            cursor:"auto",
            cursorAt:false,
            grid:false,
            handle:false,
            helper:"original",
            iframeFix:false,
            opacity:false,
            refreshPositions:false,
            revert:false,
            revertDuration:500,
            scope:"default",
            scroll:true,
            scrollSensitivity:20,
            scrollSpeed:20,
            snap:false,
            snapMode:"both",
            snapTolerance:20,
            stack:false,
            zIndex:false,
            drag:null,
            start:null,
            stop:null
        },
        _create:function(){
            if(this.options.helper==="original"&&!(/^(?:r|a|f)/).test(this.element.css("position"))){
                this.element[0].style.position="relative"
            }
            if(this.options.addClasses){
                this.element.addClass("ui-draggable")
            }
            if(this.options.disabled){
                this.element.addClass("ui-draggable-disabled")
            }
            this._mouseInit()
        },
        _destroy:function(){
            this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled");
            this._mouseDestroy()
        },
        _mouseCapture:function(c){
            var d=this.options;
            if(this.helper||d.disabled||a(c.target).closest(".ui-resizable-handle").length>0){
                return false
            }
            this.handle=this._getHandle(c);
            if(!this.handle){
                return false
            }
            a(d.iframeFix===true?"iframe":d.iframeFix).each(function(){
                a("<div class='ui-draggable-iframeFix' style='background: #fff;'></div>").css({
                    width:this.offsetWidth+"px",
                    height:this.offsetHeight+"px",
                    position:"absolute",
                    opacity:"0.001",
                    zIndex:1000
                }).css(a(this).offset()).appendTo("body")
            });
            return true
        },
        _mouseStart:function(c){
            var d=this.options;
            this.helper=this._createHelper(c);
            this.helper.addClass("ui-draggable-dragging");
            this._cacheHelperProportions();
            if(a.ui.ddmanager){
                a.ui.ddmanager.current=this
            }
            this._cacheMargins();
            this.cssPosition=this.helper.css("position");
            this.scrollParent=this.helper.scrollParent();
            this.offsetParent=this.helper.offsetParent();
            this.offsetParentCssPosition=this.offsetParent.css("position");
            this.offset=this.positionAbs=this.element.offset();
            this.offset={
                top:this.offset.top-this.margins.top,
                left:this.offset.left-this.margins.left
            };

            this.offset.scroll=false;
            a.extend(this.offset,{
                click:{
                    left:c.pageX-this.offset.left,
                    top:c.pageY-this.offset.top
                },
                parent:this._getParentOffset(),
                relative:this._getRelativeOffset()
            });
            this.originalPosition=this.position=this._generatePosition(c);
            this.originalPageX=c.pageX;
            this.originalPageY=c.pageY;
            (d.cursorAt&&this._adjustOffsetFromHelper(d.cursorAt));
            this._setContainment();
            if(this._trigger("start",c)===false){
                this._clear();
                return false
            }
            this._cacheHelperProportions();
            if(a.ui.ddmanager&&!d.dropBehaviour){
                a.ui.ddmanager.prepareOffsets(this,c)
            }
            this._mouseDrag(c,true);
            if(a.ui.ddmanager){
                a.ui.ddmanager.dragStart(this,c)
            }
            return true
        },
        _mouseDrag:function(c,e){
            if(this.offsetParentCssPosition==="fixed"){
                this.offset.parent=this._getParentOffset()
            }
            this.position=this._generatePosition(c);
            this.positionAbs=this._convertPositionTo("absolute");
            if(!e){
                var d=this._uiHash();
                if(this._trigger("drag",c,d)===false){
                    this._mouseUp({});
                    return false
                }
                this.position=d.position
            }
            if(!this.options.axis||this.options.axis!=="y"){
                this.helper[0].style.left=this.position.left+"px"
            }
            if(!this.options.axis||this.options.axis!=="x"){
                this.helper[0].style.top=this.position.top+"px"
            }
            if(a.ui.ddmanager){
                a.ui.ddmanager.drag(this,c)
            }
            return false
        },
        _mouseStop:function(d){
            var c=this,e=false;
            if(a.ui.ddmanager&&!this.options.dropBehaviour){
                e=a.ui.ddmanager.drop(this,d)
            }
            if(this.dropped){
                e=this.dropped;
                this.dropped=false
            }
            if(this.options.helper==="original"&&!a.contains(this.element[0].ownerDocument,this.element[0])){
                return false
            }
            if((this.options.revert==="invalid"&&!e)||(this.options.revert==="valid"&&e)||this.options.revert===true||(a.isFunction(this.options.revert)&&this.options.revert.call(this.element,e))){
                a(this.helper).animate(this.originalPosition,parseInt(this.options.revertDuration,10),function(){
                    if(c._trigger("stop",d)!==false){
                        c._clear()
                    }
                })
            }else{
                if(this._trigger("stop",d)!==false){
                    this._clear()
                }
            }
            return false
        },
        _mouseUp:function(c){
            a("div.ui-draggable-iframeFix").each(function(){
                this.parentNode.removeChild(this)
            });
            if(a.ui.ddmanager){
                a.ui.ddmanager.dragStop(this,c)
            }
            return a.ui.mouse.prototype._mouseUp.call(this,c)
        },
        cancel:function(){
            if(this.helper.is(".ui-draggable-dragging")){
                this._mouseUp({})
            }else{
                this._clear()
            }
            return this
        },
        _getHandle:function(c){
            return this.options.handle?!!a(c.target).closest(this.element.find(this.options.handle)).length:true
        },
        _createHelper:function(d){
            var e=this.options,c=a.isFunction(e.helper)?a(e.helper.apply(this.element[0],[d])):(e.helper==="clone"?this.element.clone().removeAttr("id"):this.element);
            if(!c.parents("body").length){
                c.appendTo((e.appendTo==="parent"?this.element[0].parentNode:e.appendTo))
            }
            if(c[0]!==this.element[0]&&!(/(fixed|absolute)/).test(c.css("position"))){
                c.css("position","absolute")
            }
            return c
        },
        _adjustOffsetFromHelper:function(c){
            if(typeof c==="string"){
                c=c.split(" ")
            }
            if(a.isArray(c)){
                c={
                    left:+c[0],
                    top:+c[1]||0
                }
            }
            if("left" in c){
                this.offset.click.left=c.left+this.margins.left
            }
            if("right" in c){
                this.offset.click.left=this.helperProportions.width-c.right+this.margins.left
            }
            if("top" in c){
                this.offset.click.top=c.top+this.margins.top
            }
            if("bottom" in c){
                this.offset.click.top=this.helperProportions.height-c.bottom+this.margins.top
            }
        },
        _getParentOffset:function(){
            var c=this.offsetParent.offset();
            if(this.cssPosition==="absolute"&&this.scrollParent[0]!==document&&a.contains(this.scrollParent[0],this.offsetParent[0])){
                c.left+=this.scrollParent.scrollLeft();
                c.top+=this.scrollParent.scrollTop()
            }
            if((this.offsetParent[0]===document.body)||(this.offsetParent[0].tagName&&this.offsetParent[0].tagName.toLowerCase()==="html"&&a.ui.ie)){
                c={
                    top:0,
                    left:0
                }
            }
            return{
                top:c.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),
                left:c.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)
            }
        },
        _getRelativeOffset:function(){
            if(this.cssPosition==="relative"){
                var c=this.element.position();
                return{
                    top:c.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),
                    left:c.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()
                }
            }else{
                return{
                    top:0,
                    left:0
                }
            }
        },
        _cacheMargins:function(){
            this.margins={
                left:(parseInt(this.element.css("marginLeft"),10)||0),
                top:(parseInt(this.element.css("marginTop"),10)||0),
                right:(parseInt(this.element.css("marginRight"),10)||0),
                bottom:(parseInt(this.element.css("marginBottom"),10)||0)
            }
        },
        _cacheHelperProportions:function(){
            this.helperProportions={
                width:this.helper.outerWidth(),
                height:this.helper.outerHeight()
            }
        },
        _setContainment:function(){
            var e,g,d,f=this.options;
            if(!f.containment){
                this.containment=null;
                return
            }
            if(f.containment==="window"){
                this.containment=[a(window).scrollLeft()-this.offset.relative.left-this.offset.parent.left,a(window).scrollTop()-this.offset.relative.top-this.offset.parent.top,a(window).scrollLeft()+a(window).width()-this.helperProportions.width-this.margins.left,a(window).scrollTop()+(a(window).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top];
                return
            }
            if(f.containment==="document"){
                this.containment=[0,0,a(document).width()-this.helperProportions.width-this.margins.left,(a(document).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top];
                return
            }
            if(f.containment.constructor===Array){
                this.containment=f.containment;
                return
            }
            if(f.containment==="parent"){
                f.containment=this.helper[0].parentNode
            }
            g=a(f.containment);
            d=g[0];
            if(!d){
                return
            }
            e=g.css("overflow")!=="hidden";
            this.containment=[(parseInt(g.css("borderLeftWidth"),10)||0)+(parseInt(g.css("paddingLeft"),10)||0),(parseInt(g.css("borderTopWidth"),10)||0)+(parseInt(g.css("paddingTop"),10)||0),(e?Math.max(d.scrollWidth,d.offsetWidth):d.offsetWidth)-(parseInt(g.css("borderRightWidth"),10)||0)-(parseInt(g.css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left-this.margins.right,(e?Math.max(d.scrollHeight,d.offsetHeight):d.offsetHeight)-(parseInt(g.css("borderBottomWidth"),10)||0)-(parseInt(g.css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top-this.margins.bottom];
            this.relative_container=g
        },
        _convertPositionTo:function(f,g){
            if(!g){
                g=this.position
            }
            var e=f==="absolute"?1:-1,c=this.cssPosition==="absolute"&&!(this.scrollParent[0]!==document&&a.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent;
            if(!this.offset.scroll){
                this.offset.scroll={
                    top:c.scrollTop(),
                    left:c.scrollLeft()
                }
            }
            return{
                top:(g.top+this.offset.relative.top*e+this.offset.parent.top*e-((this.cssPosition==="fixed"?-this.scrollParent.scrollTop():this.offset.scroll.top)*e)),
                left:(g.left+this.offset.relative.left*e+this.offset.parent.left*e-((this.cssPosition==="fixed"?-this.scrollParent.scrollLeft():this.offset.scroll.left)*e))
            }
        },
        _generatePosition:function(d){
            var c,i,j,f,e=this.options,k=this.cssPosition==="absolute"&&!(this.scrollParent[0]!==document&&a.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,h=d.pageX,g=d.pageY;
            if(!this.offset.scroll){
                this.offset.scroll={
                    top:k.scrollTop(),
                    left:k.scrollLeft()
                }
            }
            if(this.originalPosition){
                if(this.containment){
                    if(this.relative_container){
                        i=this.relative_container.offset();
                        c=[this.containment[0]+i.left,this.containment[1]+i.top,this.containment[2]+i.left,this.containment[3]+i.top]
                    }else{
                        c=this.containment
                    }
                    if(d.pageX-this.offset.click.left<c[0]){
                        h=c[0]+this.offset.click.left
                    }
                    if(d.pageY-this.offset.click.top<c[1]){
                        g=c[1]+this.offset.click.top
                    }
                    if(d.pageX-this.offset.click.left>c[2]){
                        h=c[2]+this.offset.click.left
                    }
                    if(d.pageY-this.offset.click.top>c[3]){
                        g=c[3]+this.offset.click.top
                    }
                }
                if(e.grid){
                    j=e.grid[1]?this.originalPageY+Math.round((g-this.originalPageY)/e.grid[1])*e.grid[1]:this.originalPageY;
                    g=c?((j-this.offset.click.top>=c[1]||j-this.offset.click.top>c[3])?j:((j-this.offset.click.top>=c[1])?j-e.grid[1]:j+e.grid[1])):j;
                    f=e.grid[0]?this.originalPageX+Math.round((h-this.originalPageX)/e.grid[0])*e.grid[0]:this.originalPageX;
                    h=c?((f-this.offset.click.left>=c[0]||f-this.offset.click.left>c[2])?f:((f-this.offset.click.left>=c[0])?f-e.grid[0]:f+e.grid[0])):f
                }
            }
            return{
                top:(g-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+(this.cssPosition==="fixed"?-this.scrollParent.scrollTop():this.offset.scroll.top)),
                left:(h-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+(this.cssPosition==="fixed"?-this.scrollParent.scrollLeft():this.offset.scroll.left))
            }
        },
        _clear:function(){
            this.helper.removeClass("ui-draggable-dragging");
            if(this.helper[0]!==this.element[0]&&!this.cancelHelperRemoval){
                this.helper.remove()
            }
            this.helper=null;
            this.cancelHelperRemoval=false
        },
        _trigger:function(c,d,e){
            e=e||this._uiHash();
            a.ui.plugin.call(this,c,[d,e]);
            if(c==="drag"){
                this.positionAbs=this._convertPositionTo("absolute")
            }
            return a.Widget.prototype._trigger.call(this,c,d,e)
        },
        plugins:{},
        _uiHash:function(){
            return{
                helper:this.helper,
                position:this.position,
                originalPosition:this.originalPosition,
                offset:this.positionAbs
            }
        }
    });
    a.ui.plugin.add("draggable","connectToSortable",{
        start:function(d,f){
            var e=a(this).data("ui-draggable"),g=e.options,c=a.extend({},f,{
                item:e.element
            });
            e.sortables=[];
            a(g.connectToSortable).each(function(){
                var h=a.data(this,"ui-sortable");
                if(h&&!h.options.disabled){
                    e.sortables.push({
                        instance:h,
                        shouldRevert:h.options.revert
                    });
                    h.refreshPositions();
                    h._trigger("activate",d,c)
                }
            })
        },
        stop:function(d,f){
            var e=a(this).data("ui-draggable"),c=a.extend({},f,{
                item:e.element
            });
            a.each(e.sortables,function(){
                if(this.instance.isOver){
                    this.instance.isOver=0;
                    e.cancelHelperRemoval=true;
                    this.instance.cancelHelperRemoval=false;
                    if(this.shouldRevert){
                        this.instance.options.revert=this.shouldRevert
                    }
                    this.instance._mouseStop(d);
                    this.instance.options.helper=this.instance.options._helper;
                    if(e.options.helper==="original"){
                        this.instance.currentItem.css({
                            top:"auto",
                            left:"auto"
                        })
                    }
                }else{
                    this.instance.cancelHelperRemoval=false;
                    this.instance._trigger("deactivate",d,c)
                }
            })
        },
        drag:function(d,f){
            var e=a(this).data("ui-draggable"),c=this;
            a.each(e.sortables,function(){
                var g=false,h=this;
                this.instance.positionAbs=e.positionAbs;
                this.instance.helperProportions=e.helperProportions;
                this.instance.offset.click=e.offset.click;
                if(this.instance._intersectsWith(this.instance.containerCache)){
                    g=true;
                    a.each(e.sortables,function(){
                        this.instance.positionAbs=e.positionAbs;
                        this.instance.helperProportions=e.helperProportions;
                        this.instance.offset.click=e.offset.click;
                        if(this!==h&&this.instance._intersectsWith(this.instance.containerCache)&&a.contains(h.instance.element[0],this.instance.element[0])){
                            g=false
                        }
                        return g
                    })
                }
                if(g){
                    if(!this.instance.isOver){
                        this.instance.isOver=1;
                        this.instance.currentItem=a(c).clone().removeAttr("id").appendTo(this.instance.element).data("ui-sortable-item",true);
                        this.instance.options._helper=this.instance.options.helper;
                        this.instance.options.helper=function(){
                            return f.helper[0]
                        };

                        d.target=this.instance.currentItem[0];
                        this.instance._mouseCapture(d,true);
                        this.instance._mouseStart(d,true,true);
                        this.instance.offset.click.top=e.offset.click.top;
                        this.instance.offset.click.left=e.offset.click.left;
                        this.instance.offset.parent.left-=e.offset.parent.left-this.instance.offset.parent.left;
                        this.instance.offset.parent.top-=e.offset.parent.top-this.instance.offset.parent.top;
                        e._trigger("toSortable",d);
                        e.dropped=this.instance.element;
                        e.currentItem=e.element;
                        this.instance.fromOutside=e
                    }
                    if(this.instance.currentItem){
                        this.instance._mouseDrag(d)
                    }
                }else{
                    if(this.instance.isOver){
                        this.instance.isOver=0;
                        this.instance.cancelHelperRemoval=true;
                        this.instance.options.revert=false;
                        this.instance._trigger("out",d,this.instance._uiHash(this.instance));
                        this.instance._mouseStop(d,true);
                        this.instance.options.helper=this.instance.options._helper;
                        this.instance.currentItem.remove();
                        if(this.instance.placeholder){
                            this.instance.placeholder.remove()
                        }
                        e._trigger("fromSortable",d);
                        e.dropped=false
                    }
                }
            })
        }
    });
    a.ui.plugin.add("draggable","cursor",{
        start:function(){
            var c=a("body"),d=a(this).data("ui-draggable").options;
            if(c.css("cursor")){
                d._cursor=c.css("cursor")
            }
            c.css("cursor",d.cursor)
        },
        stop:function(){
            var c=a(this).data("ui-draggable").options;
            if(c._cursor){
                a("body").css("cursor",c._cursor)
            }
        }
    });
    a.ui.plugin.add("draggable","opacity",{
        start:function(d,e){
            var c=a(e.helper),f=a(this).data("ui-draggable").options;
            if(c.css("opacity")){
                f._opacity=c.css("opacity")
            }
            c.css("opacity",f.opacity)
        },
        stop:function(c,d){
            var e=a(this).data("ui-draggable").options;
            if(e._opacity){
                a(d.helper).css("opacity",e._opacity)
            }
        }
    });
    a.ui.plugin.add("draggable","scroll",{
        start:function(){
            var c=a(this).data("ui-draggable");
            if(c.scrollParent[0]!==document&&c.scrollParent[0].tagName!=="HTML"){
                c.overflowOffset=c.scrollParent.offset()
            }
        },
        drag:function(e){
            var d=a(this).data("ui-draggable"),f=d.options,c=false;
            if(d.scrollParent[0]!==document&&d.scrollParent[0].tagName!=="HTML"){
                if(!f.axis||f.axis!=="x"){
                    if((d.overflowOffset.top+d.scrollParent[0].offsetHeight)-e.pageY<f.scrollSensitivity){
                        d.scrollParent[0].scrollTop=c=d.scrollParent[0].scrollTop+f.scrollSpeed
                    }else{
                        if(e.pageY-d.overflowOffset.top<f.scrollSensitivity){
                            d.scrollParent[0].scrollTop=c=d.scrollParent[0].scrollTop-f.scrollSpeed
                        }
                    }
                }
                if(!f.axis||f.axis!=="y"){
                    if((d.overflowOffset.left+d.scrollParent[0].offsetWidth)-e.pageX<f.scrollSensitivity){
                        d.scrollParent[0].scrollLeft=c=d.scrollParent[0].scrollLeft+f.scrollSpeed
                    }else{
                        if(e.pageX-d.overflowOffset.left<f.scrollSensitivity){
                            d.scrollParent[0].scrollLeft=c=d.scrollParent[0].scrollLeft-f.scrollSpeed
                        }
                    }
                }
            }else{
                if(!f.axis||f.axis!=="x"){
                    if(e.pageY-a(document).scrollTop()<f.scrollSensitivity){
                        c=a(document).scrollTop(a(document).scrollTop()-f.scrollSpeed)
                    }else{
                        if(a(window).height()-(e.pageY-a(document).scrollTop())<f.scrollSensitivity){
                            c=a(document).scrollTop(a(document).scrollTop()+f.scrollSpeed)
                        }
                    }
                }
                if(!f.axis||f.axis!=="y"){
                    if(e.pageX-a(document).scrollLeft()<f.scrollSensitivity){
                        c=a(document).scrollLeft(a(document).scrollLeft()-f.scrollSpeed)
                    }else{
                        if(a(window).width()-(e.pageX-a(document).scrollLeft())<f.scrollSensitivity){
                            c=a(document).scrollLeft(a(document).scrollLeft()+f.scrollSpeed)
                        }
                    }
                }
            }
            if(c!==false&&a.ui.ddmanager&&!f.dropBehaviour){
                a.ui.ddmanager.prepareOffsets(d,e)
            }
        }
    });
    a.ui.plugin.add("draggable","snap",{
        start:function(){
            var c=a(this).data("ui-draggable"),d=c.options;
            c.snapElements=[];
            a(d.snap.constructor!==String?(d.snap.items||":data(ui-draggable)"):d.snap).each(function(){
                var f=a(this),e=f.offset();
                if(this!==c.element[0]){
                    c.snapElements.push({
                        item:this,
                        width:f.outerWidth(),
                        height:f.outerHeight(),
                        top:e.top,
                        left:e.left
                    })
                }
            })
        },
        drag:function(u,p){
            var c,z,j,k,s,n,m,A,v,h,g=a(this).data("ui-draggable"),q=g.options,y=q.snapTolerance,x=p.offset.left,w=x+g.helperProportions.width,f=p.offset.top,e=f+g.helperProportions.height;
            for(v=g.snapElements.length-1;v>=0;v--){
                s=g.snapElements[v].left;
                n=s+g.snapElements[v].width;
                m=g.snapElements[v].top;
                A=m+g.snapElements[v].height;
                if(w<s-y||x>n+y||e<m-y||f>A+y||!a.contains(g.snapElements[v].item.ownerDocument,g.snapElements[v].item)){
                    if(g.snapElements[v].snapping){
                        (g.options.snap.release&&g.options.snap.release.call(g.element,u,a.extend(g._uiHash(),{
                            snapItem:g.snapElements[v].item
                        })))
                    }
                    g.snapElements[v].snapping=false;
                    continue
                }
                if(q.snapMode!=="inner"){
                    c=Math.abs(m-e)<=y;
                    z=Math.abs(A-f)<=y;
                    j=Math.abs(s-w)<=y;
                    k=Math.abs(n-x)<=y;
                    if(c){
                        p.position.top=g._convertPositionTo("relative",{
                            top:m-g.helperProportions.height,
                            left:0
                        }).top-g.margins.top
                    }
                    if(z){
                        p.position.top=g._convertPositionTo("relative",{
                            top:A,
                            left:0
                        }).top-g.margins.top
                    }
                    if(j){
                        p.position.left=g._convertPositionTo("relative",{
                            top:0,
                            left:s-g.helperProportions.width
                        }).left-g.margins.left
                    }
                    if(k){
                        p.position.left=g._convertPositionTo("relative",{
                            top:0,
                            left:n
                        }).left-g.margins.left
                    }
                }
                h=(c||z||j||k);
                if(q.snapMode!=="outer"){
                    c=Math.abs(m-f)<=y;
                    z=Math.abs(A-e)<=y;
                    j=Math.abs(s-x)<=y;
                    k=Math.abs(n-w)<=y;
                    if(c){
                        p.position.top=g._convertPositionTo("relative",{
                            top:m,
                            left:0
                        }).top-g.margins.top
                    }
                    if(z){
                        p.position.top=g._convertPositionTo("relative",{
                            top:A-g.helperProportions.height,
                            left:0
                        }).top-g.margins.top
                    }
                    if(j){
                        p.position.left=g._convertPositionTo("relative",{
                            top:0,
                            left:s
                        }).left-g.margins.left
                    }
                    if(k){
                        p.position.left=g._convertPositionTo("relative",{
                            top:0,
                            left:n-g.helperProportions.width
                        }).left-g.margins.left
                    }
                }
                if(!g.snapElements[v].snapping&&(c||z||j||k||h)){
                    (g.options.snap.snap&&g.options.snap.snap.call(g.element,u,a.extend(g._uiHash(),{
                        snapItem:g.snapElements[v].item
                    })))
                }
                g.snapElements[v].snapping=(c||z||j||k||h)
            }
        }
    });
    a.ui.plugin.add("draggable","stack",{
        start:function(){
            var c,e=this.data("ui-draggable").options,d=a.makeArray(a(e.stack)).sort(function(g,f){
                return(parseInt(a(g).css("zIndex"),10)||0)-(parseInt(a(f).css("zIndex"),10)||0)
            });
            if(!d.length){
                return
            }
            c=parseInt(a(d[0]).css("zIndex"),10)||0;
            a(d).each(function(f){
                a(this).css("zIndex",c+f)
            });
            this.css("zIndex",(c+d.length))
        }
    });
    a.ui.plugin.add("draggable","zIndex",{
        start:function(d,e){
            var c=a(e.helper),f=a(this).data("ui-draggable").options;
            if(c.css("zIndex")){
                f._zIndex=c.css("zIndex")
            }
            c.css("zIndex",f.zIndex)
        },
        stop:function(c,d){
            var e=a(this).data("ui-draggable").options;
            if(e._zIndex){
                a(d.helper).css("zIndex",e._zIndex)
            }
        }
    })
})(jQuery);
(function(b,c){
    function a(e,d,f){
        return(e>d)&&(e<(d+f))
    }
    b.widget("ui.droppable",{
        version:"1.10.3",
        widgetEventPrefix:"drop",
        options:{
            accept:"*",
            activeClass:false,
            addClasses:true,
            greedy:false,
            hoverClass:false,
            scope:"default",
            tolerance:"intersect",
            activate:null,
            deactivate:null,
            drop:null,
            out:null,
            over:null
        },
        _create:function(){
            var e=this.options,d=e.accept;
            this.isover=false;
            this.isout=true;
            this.accept=b.isFunction(d)?d:function(f){
                return f.is(d)
            };

            this.proportions={
                width:this.element[0].offsetWidth,
                height:this.element[0].offsetHeight
            };

            b.ui.ddmanager.droppables[e.scope]=b.ui.ddmanager.droppables[e.scope]||[];
            b.ui.ddmanager.droppables[e.scope].push(this);
            (e.addClasses&&this.element.addClass("ui-droppable"))
        },
        _destroy:function(){
            var e=0,d=b.ui.ddmanager.droppables[this.options.scope];
            for(;e<d.length;e++){
                if(d[e]===this){
                    d.splice(e,1)
                }
            }
            this.element.removeClass("ui-droppable ui-droppable-disabled")
        },
        _setOption:function(d,e){
            if(d==="accept"){
                this.accept=b.isFunction(e)?e:function(f){
                    return f.is(e)
                }
            }
            b.Widget.prototype._setOption.apply(this,arguments)
        },
        _activate:function(e){
            var d=b.ui.ddmanager.current;
            if(this.options.activeClass){
                this.element.addClass(this.options.activeClass)
            }
            if(d){
                this._trigger("activate",e,this.ui(d))
            }
        },
        _deactivate:function(e){
            var d=b.ui.ddmanager.current;
            if(this.options.activeClass){
                this.element.removeClass(this.options.activeClass)
            }
            if(d){
                this._trigger("deactivate",e,this.ui(d))
            }
        },
        _over:function(e){
            var d=b.ui.ddmanager.current;
            if(!d||(d.currentItem||d.element)[0]===this.element[0]){
                return
            }
            if(this.accept.call(this.element[0],(d.currentItem||d.element))){
                if(this.options.hoverClass){
                    this.element.addClass(this.options.hoverClass)
                }
                this._trigger("over",e,this.ui(d))
            }
        },
        _out:function(e){
            var d=b.ui.ddmanager.current;
            if(!d||(d.currentItem||d.element)[0]===this.element[0]){
                return
            }
            if(this.accept.call(this.element[0],(d.currentItem||d.element))){
                if(this.options.hoverClass){
                    this.element.removeClass(this.options.hoverClass)
                }
                this._trigger("out",e,this.ui(d))
            }
        },
        _drop:function(e,f){
            var d=f||b.ui.ddmanager.current,g=false;
            if(!d||(d.currentItem||d.element)[0]===this.element[0]){
                return false
            }
            this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function(){
                var h=b.data(this,"ui-droppable");
                if(h.options.greedy&&!h.options.disabled&&h.options.scope===d.options.scope&&h.accept.call(h.element[0],(d.currentItem||d.element))&&b.ui.intersect(d,b.extend(h,{
                    offset:h.element.offset()
                }),h.options.tolerance)){
                    g=true;
                    return false
                }
            });
            if(g){
                return false
            }
            if(this.accept.call(this.element[0],(d.currentItem||d.element))){
                if(this.options.activeClass){
                    this.element.removeClass(this.options.activeClass)
                }
                if(this.options.hoverClass){
                    this.element.removeClass(this.options.hoverClass)
                }
                this._trigger("drop",e,this.ui(d));
                return this.element
            }
            return false
        },
        ui:function(d){
            return{
                draggable:(d.currentItem||d.element),
                helper:d.helper,
                position:d.position,
                offset:d.positionAbs
            }
        }
    });
    b.ui.intersect=function(q,j,o){
        if(!j.offset){
            return false
        }
        var h,i,f=(q.positionAbs||q.position.absolute).left,e=f+q.helperProportions.width,n=(q.positionAbs||q.position.absolute).top,m=n+q.helperProportions.height,g=j.offset.left,d=g+j.proportions.width,p=j.offset.top,k=p+j.proportions.height;
        switch(o){
            case"fit":
                return(g<=f&&e<=d&&p<=n&&m<=k);
            case"intersect":
                return(g<f+(q.helperProportions.width/2)&&e-(q.helperProportions.width/2)<d&&p<n+(q.helperProportions.height/2)&&m-(q.helperProportions.height/2)<k);
            case"pointer":
                h=((q.positionAbs||q.position.absolute).left+(q.clickOffset||q.offset.click).left);
                i=((q.positionAbs||q.position.absolute).top+(q.clickOffset||q.offset.click).top);
                return a(i,p,j.proportions.height)&&a(h,g,j.proportions.width);
            case"touch":
                return((n>=p&&n<=k)||(m>=p&&m<=k)||(n<p&&m>k))&&((f>=g&&f<=d)||(e>=g&&e<=d)||(f<g&&e>d));
            default:
                return false
        }
    };

    b.ui.ddmanager={
        current:null,
        droppables:{
            "default":[]
        },
        prepareOffsets:function(g,k){
            var f,e,d=b.ui.ddmanager.droppables[g.options.scope]||[],h=k?k.type:null,l=(g.currentItem||g.element).find(":data(ui-droppable)").addBack();
            droppablesLoop:for(f=0;f<d.length;f++){
                if(d[f].options.disabled||(g&&!d[f].accept.call(d[f].element[0],(g.currentItem||g.element)))){
                    continue
                }
                for(e=0;e<l.length;e++){
                    if(l[e]===d[f].element[0]){
                        d[f].proportions.height=0;
                        continue droppablesLoop
                    }
                }
                d[f].visible=d[f].element.css("display")!=="none";
                if(!d[f].visible){
                    continue
                }
                if(h==="mousedown"){
                    d[f]._activate.call(d[f],k)
                }
                d[f].offset=d[f].element.offset();
                d[f].proportions={
                    width:d[f].element[0].offsetWidth,
                    height:d[f].element[0].offsetHeight
                }
            }
        },
        drop:function(d,e){
            var f=false;
            b.each((b.ui.ddmanager.droppables[d.options.scope]||[]).slice(),function(){
                if(!this.options){
                    return
                }
                if(!this.options.disabled&&this.visible&&b.ui.intersect(d,this,this.options.tolerance)){
                    f=this._drop.call(this,e)||f
                }
                if(!this.options.disabled&&this.visible&&this.accept.call(this.element[0],(d.currentItem||d.element))){
                    this.isout=true;
                    this.isover=false;
                    this._deactivate.call(this,e)
                }
            });
            return f
        },
        dragStart:function(d,e){
            d.element.parentsUntil("body").bind("scroll.droppable",function(){
                if(!d.options.refreshPositions){
                    b.ui.ddmanager.prepareOffsets(d,e)
                }
            })
        },
        drag:function(d,e){
            if(d.options.refreshPositions){
                b.ui.ddmanager.prepareOffsets(d,e)
            }
            b.each(b.ui.ddmanager.droppables[d.options.scope]||[],function(){
                if(this.options.disabled||this.greedyChild||!this.visible){
                    return
                }
                var i,g,f,h=b.ui.intersect(d,this,this.options.tolerance),j=!h&&this.isover?"isout":(h&&!this.isover?"isover":null);
                if(!j){
                    return
                }
                if(this.options.greedy){
                    g=this.options.scope;
                    f=this.element.parents(":data(ui-droppable)").filter(function(){
                        return b.data(this,"ui-droppable").options.scope===g
                    });
                    if(f.length){
                        i=b.data(f[0],"ui-droppable");
                        i.greedyChild=(j==="isover")
                    }
                }
                if(i&&j==="isover"){
                    i.isover=false;
                    i.isout=true;
                    i._out.call(i,e)
                }
                this[j]=true;
                this[j==="isout"?"isover":"isout"]=false;
                this[j==="isover"?"_over":"_out"].call(this,e);
                if(i&&j==="isout"){
                    i.isout=false;
                    i.isover=true;
                    i._over.call(i,e)
                }
            })
        },
        dragStop:function(d,e){
            d.element.parentsUntil("body").unbind("scroll.droppable");
            if(!d.options.refreshPositions){
                b.ui.ddmanager.prepareOffsets(d,e)
            }
        }
    }
})(jQuery);
(function(c,d){
    function b(e){
        return parseInt(e,10)||0
    }
    function a(e){
        return !isNaN(parseInt(e,10))
    }
    c.widget("ui.resizable",c.ui.mouse,{
        version:"1.10.3",
        widgetEventPrefix:"resize",
        options:{
            alsoResize:false,
            animate:false,
            animateDuration:"slow",
            animateEasing:"swing",
            aspectRatio:false,
            autoHide:false,
            containment:false,
            ghost:false,
            grid:false,
            handles:"e,s,se",
            helper:false,
            maxHeight:null,
            maxWidth:null,
            minHeight:10,
            minWidth:10,
            zIndex:90,
            resize:null,
            start:null,
            stop:null
        },
        _create:function(){
            var l,f,j,g,e,h=this,k=this.options;
            this.element.addClass("ui-resizable");
            c.extend(this,{
                _aspectRatio:!!(k.aspectRatio),
                aspectRatio:k.aspectRatio,
                originalElement:this.element,
                _proportionallyResizeElements:[],
                _helper:k.helper||k.ghost||k.animate?k.helper||"ui-resizable-helper":null
            });
            if(this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i)){
                this.element.wrap(c("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({
                    position:this.element.css("position"),
                    width:this.element.outerWidth(),
                    height:this.element.outerHeight(),
                    top:this.element.css("top"),
                    left:this.element.css("left")
                }));
                this.element=this.element.parent().data("ui-resizable",this.element.data("ui-resizable"));
                this.elementIsWrapper=true;
                this.element.css({
                    marginLeft:this.originalElement.css("marginLeft"),
                    marginTop:this.originalElement.css("marginTop"),
                    marginRight:this.originalElement.css("marginRight"),
                    marginBottom:this.originalElement.css("marginBottom")
                });
                this.originalElement.css({
                    marginLeft:0,
                    marginTop:0,
                    marginRight:0,
                    marginBottom:0
                });
                this.originalResizeStyle=this.originalElement.css("resize");
                this.originalElement.css("resize","none");
                this._proportionallyResizeElements.push(this.originalElement.css({
                    position:"static",
                    zoom:1,
                    display:"block"
                }));
                this.originalElement.css({
                    margin:this.originalElement.css("margin")
                });
                this._proportionallyResize()
            }
            this.handles=k.handles||(!c(".ui-resizable-handle",this.element).length?"e,s,se":{
                n:".ui-resizable-n",
                e:".ui-resizable-e",
                s:".ui-resizable-s",
                w:".ui-resizable-w",
                se:".ui-resizable-se",
                sw:".ui-resizable-sw",
                ne:".ui-resizable-ne",
                nw:".ui-resizable-nw"
            });
            if(this.handles.constructor===String){
                if(this.handles==="all"){
                    this.handles="n,e,s,w,se,sw,ne,nw"
                }
                l=this.handles.split(",");
                this.handles={};

                for(f=0;f<l.length;f++){
                    j=c.trim(l[f]);
                    e="ui-resizable-"+j;
                    g=c("<div class='ui-resizable-handle "+e+"'></div>");
                    g.css({
                        zIndex:k.zIndex
                    });
                    if("se"===j){
                        g.addClass("ui-icon ui-icon-gripsmall-diagonal-se")
                    }
                    this.handles[j]=".ui-resizable-"+j;
                    this.element.append(g)
                }
            }
            this._renderAxis=function(q){
                var n,o,m,p;
                q=q||this.element;
                for(n in this.handles){
                    if(this.handles[n].constructor===String){
                        this.handles[n]=c(this.handles[n],this.element).show()
                    }
                    if(this.elementIsWrapper&&this.originalElement[0].nodeName.match(/textarea|input|select|button/i)){
                        o=c(this.handles[n],this.element);
                        p=/sw|ne|nw|se|n|s/.test(n)?o.outerHeight():o.outerWidth();
                        m=["padding",/ne|nw|n/.test(n)?"Top":/se|sw|s/.test(n)?"Bottom":/^e$/.test(n)?"Right":"Left"].join("");
                        q.css(m,p);
                        this._proportionallyResize()
                    }
                    if(!c(this.handles[n]).length){
                        continue
                    }
                }
            };

            this._renderAxis(this.element);
            this._handles=c(".ui-resizable-handle",this.element).disableSelection();
            this._handles.mouseover(function(){
                if(!h.resizing){
                    if(this.className){
                        g=this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)
                    }
                    h.axis=g&&g[1]?g[1]:"se"
                }
            });
            if(k.autoHide){
                this._handles.hide();
                c(this.element).addClass("ui-resizable-autohide").mouseenter(function(){
                    if(k.disabled){
                        return
                    }
                    c(this).removeClass("ui-resizable-autohide");
                    h._handles.show()
                }).mouseleave(function(){
                    if(k.disabled){
                        return
                    }
                    if(!h.resizing){
                        c(this).addClass("ui-resizable-autohide");
                        h._handles.hide()
                    }
                })
            }
            this._mouseInit()
        },
        _destroy:function(){
            this._mouseDestroy();
            var f,e=function(g){
                c(g).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove()
            };

            if(this.elementIsWrapper){
                e(this.element);
                f=this.element;
                this.originalElement.css({
                    position:f.css("position"),
                    width:f.outerWidth(),
                    height:f.outerHeight(),
                    top:f.css("top"),
                    left:f.css("left")
                }).insertAfter(f);
                f.remove()
            }
            this.originalElement.css("resize",this.originalResizeStyle);
            e(this.originalElement);
            return this
        },
        _mouseCapture:function(g){
            var f,h,e=false;
            for(f in this.handles){
                h=c(this.handles[f])[0];
                if(h===g.target||c.contains(h,g.target)){
                    e=true
                }
            }
            return !this.options.disabled&&e
        },
        _mouseStart:function(g){
            var k,h,j,i=this.options,f=this.element.position(),e=this.element;
            this.resizing=true;
            if((/absolute/).test(e.css("position"))){
                e.css({
                    position:"absolute",
                    top:e.css("top"),
                    left:e.css("left")
                })
            }else{
                if(e.is(".ui-draggable")){
                    e.css({
                        position:"absolute",
                        top:f.top,
                        left:f.left
                    })
                }
            }
            this._renderProxy();
            k=b(this.helper.css("left"));
            h=b(this.helper.css("top"));
            if(i.containment){
                k+=c(i.containment).scrollLeft()||0;
                h+=c(i.containment).scrollTop()||0
            }
            this.offset=this.helper.offset();
            this.position={
                left:k,
                top:h
            };

            this.size=this._helper?{
                width:e.outerWidth(),
                height:e.outerHeight()
            }:{
                width:e.width(),
                height:e.height()
            };

            this.originalSize=this._helper?{
                width:e.outerWidth(),
                height:e.outerHeight()
            }:{
                width:e.width(),
                height:e.height()
            };

            this.originalPosition={
                left:k,
                top:h
            };

            this.sizeDiff={
                width:e.outerWidth()-e.width(),
                height:e.outerHeight()-e.height()
            };

            this.originalMousePosition={
                left:g.pageX,
                top:g.pageY
            };

            this.aspectRatio=(typeof i.aspectRatio==="number")?i.aspectRatio:((this.originalSize.width/this.originalSize.height)||1);
            j=c(".ui-resizable-"+this.axis).css("cursor");
            c("body").css("cursor",j==="auto"?this.axis+"-resize":j);
            e.addClass("ui-resizable-resizing");
            this._propagate("start",g);
            return true
        },
        _mouseDrag:function(e){
            var k,g=this.helper,l={},i=this.originalMousePosition,m=this.axis,o=this.position.top,f=this.position.left,n=this.size.width,j=this.size.height,q=(e.pageX-i.left)||0,p=(e.pageY-i.top)||0,h=this._change[m];
            if(!h){
                return false
            }
            k=h.apply(this,[e,q,p]);
            this._updateVirtualBoundaries(e.shiftKey);
            if(this._aspectRatio||e.shiftKey){
                k=this._updateRatio(k,e)
            }
            k=this._respectSize(k,e);
            this._updateCache(k);
            this._propagate("resize",e);
            if(this.position.top!==o){
                l.top=this.position.top+"px"
            }
            if(this.position.left!==f){
                l.left=this.position.left+"px"
            }
            if(this.size.width!==n){
                l.width=this.size.width+"px"
            }
            if(this.size.height!==j){
                l.height=this.size.height+"px"
            }
            g.css(l);
            if(!this._helper&&this._proportionallyResizeElements.length){
                this._proportionallyResize()
            }
            if(!c.isEmptyObject(l)){
                this._trigger("resize",e,this.ui())
            }
            return false
        },
        _mouseStop:function(h){
            this.resizing=false;
            var g,e,f,k,n,j,m,i=this.options,l=this;
            if(this._helper){
                g=this._proportionallyResizeElements;
                e=g.length&&(/textarea/i).test(g[0].nodeName);
                f=e&&c.ui.hasScroll(g[0],"left")?0:l.sizeDiff.height;
                k=e?0:l.sizeDiff.width;
                n={
                    width:(l.helper.width()-k),
                    height:(l.helper.height()-f)
                };

                j=(parseInt(l.element.css("left"),10)+(l.position.left-l.originalPosition.left))||null;
                m=(parseInt(l.element.css("top"),10)+(l.position.top-l.originalPosition.top))||null;
                if(!i.animate){
                    this.element.css(c.extend(n,{
                        top:m,
                        left:j
                    }))
                }
                l.helper.height(l.size.height);
                l.helper.width(l.size.width);
                if(this._helper&&!i.animate){
                    this._proportionallyResize()
                }
            }
            c("body").css("cursor","auto");
            this.element.removeClass("ui-resizable-resizing");
            this._propagate("stop",h);
            if(this._helper){
                this.helper.remove()
            }
            return false
        },
        _updateVirtualBoundaries:function(g){
            var i,h,f,k,e,j=this.options;
            e={
                minWidth:a(j.minWidth)?j.minWidth:0,
                maxWidth:a(j.maxWidth)?j.maxWidth:Infinity,
                minHeight:a(j.minHeight)?j.minHeight:0,
                maxHeight:a(j.maxHeight)?j.maxHeight:Infinity
            };

            if(this._aspectRatio||g){
                i=e.minHeight*this.aspectRatio;
                f=e.minWidth/this.aspectRatio;
                h=e.maxHeight*this.aspectRatio;
                k=e.maxWidth/this.aspectRatio;
                if(i>e.minWidth){
                    e.minWidth=i
                }
                if(f>e.minHeight){
                    e.minHeight=f
                }
                if(h<e.maxWidth){
                    e.maxWidth=h
                }
                if(k<e.maxHeight){
                    e.maxHeight=k
                }
            }
            this._vBoundaries=e
        },
        _updateCache:function(e){
            this.offset=this.helper.offset();
            if(a(e.left)){
                this.position.left=e.left
            }
            if(a(e.top)){
                this.position.top=e.top
            }
            if(a(e.height)){
                this.size.height=e.height
            }
            if(a(e.width)){
                this.size.width=e.width
            }
        },
        _updateRatio:function(g){
            var h=this.position,f=this.size,e=this.axis;
            if(a(g.height)){
                g.width=(g.height*this.aspectRatio)
            }else{
                if(a(g.width)){
                    g.height=(g.width/this.aspectRatio)
                }
            }
            if(e==="sw"){
                g.left=h.left+(f.width-g.width);
                g.top=null
            }
            if(e==="nw"){
                g.top=h.top+(f.height-g.height);
                g.left=h.left+(f.width-g.width)
            }
            return g
        },
        _respectSize:function(j){
            var g=this._vBoundaries,m=this.axis,p=a(j.width)&&g.maxWidth&&(g.maxWidth<j.width),k=a(j.height)&&g.maxHeight&&(g.maxHeight<j.height),h=a(j.width)&&g.minWidth&&(g.minWidth>j.width),n=a(j.height)&&g.minHeight&&(g.minHeight>j.height),f=this.originalPosition.left+this.originalSize.width,l=this.position.top+this.size.height,i=/sw|nw|w/.test(m),e=/nw|ne|n/.test(m);
            if(h){
                j.width=g.minWidth
            }
            if(n){
                j.height=g.minHeight
            }
            if(p){
                j.width=g.maxWidth
            }
            if(k){
                j.height=g.maxHeight
            }
            if(h&&i){
                j.left=f-g.minWidth
            }
            if(p&&i){
                j.left=f-g.maxWidth
            }
            if(n&&e){
                j.top=l-g.minHeight
            }
            if(k&&e){
                j.top=l-g.maxHeight
            }
            if(!j.width&&!j.height&&!j.left&&j.top){
                j.top=null
            }else{
                if(!j.width&&!j.height&&!j.top&&j.left){
                    j.left=null
                }
            }
            return j
        },
        _proportionallyResize:function(){
            if(!this._proportionallyResizeElements.length){
                return
            }
            var h,f,l,e,k,g=this.helper||this.element;
            for(h=0;h<this._proportionallyResizeElements.length;h++){
                k=this._proportionallyResizeElements[h];
                if(!this.borderDif){
                    this.borderDif=[];
                    l=[k.css("borderTopWidth"),k.css("borderRightWidth"),k.css("borderBottomWidth"),k.css("borderLeftWidth")];
                    e=[k.css("paddingTop"),k.css("paddingRight"),k.css("paddingBottom"),k.css("paddingLeft")];
                    for(f=0;f<l.length;f++){
                        this.borderDif[f]=(parseInt(l[f],10)||0)+(parseInt(e[f],10)||0)
                    }
                }
                k.css({
                    height:(g.height()-this.borderDif[0]-this.borderDif[2])||0,
                    width:(g.width()-this.borderDif[1]-this.borderDif[3])||0
                })
            }
        },
        _renderProxy:function(){
            var e=this.element,f=this.options;
            this.elementOffset=e.offset();
            if(this._helper){
                this.helper=this.helper||c("<div style='overflow:hidden;'></div>");
                this.helper.addClass(this._helper).css({
                    width:this.element.outerWidth()-1,
                    height:this.element.outerHeight()-1,
                    position:"absolute",
                    left:this.elementOffset.left+"px",
                    top:this.elementOffset.top+"px",
                    zIndex:++f.zIndex
                });
                this.helper.appendTo("body").disableSelection()
            }else{
                this.helper=this.element
            }
        },
        _change:{
            e:function(f,e){
                return{
                    width:this.originalSize.width+e
                }
            },
            w:function(g,e){
                var f=this.originalSize,h=this.originalPosition;
                return{
                    left:h.left+e,
                    width:f.width-e
                }
            },
            n:function(h,f,e){
                var g=this.originalSize,i=this.originalPosition;
                return{
                    top:i.top+e,
                    height:g.height-e
                }
            },
            s:function(g,f,e){
                return{
                    height:this.originalSize.height+e
                }
            },
            se:function(g,f,e){
                return c.extend(this._change.s.apply(this,arguments),this._change.e.apply(this,[g,f,e]))
            },
            sw:function(g,f,e){
                return c.extend(this._change.s.apply(this,arguments),this._change.w.apply(this,[g,f,e]))
            },
            ne:function(g,f,e){
                return c.extend(this._change.n.apply(this,arguments),this._change.e.apply(this,[g,f,e]))
            },
            nw:function(g,f,e){
                return c.extend(this._change.n.apply(this,arguments),this._change.w.apply(this,[g,f,e]))
            }
        },
        _propagate:function(f,e){
            c.ui.plugin.call(this,f,[e,this.ui()]);
            (f!=="resize"&&this._trigger(f,e,this.ui()))
        },
        plugins:{},
        ui:function(){
            return{
                originalElement:this.originalElement,
                element:this.element,
                helper:this.helper,
                position:this.position,
                size:this.size,
                originalSize:this.originalSize,
                originalPosition:this.originalPosition
            }
        }
    });
    c.ui.plugin.add("resizable","animate",{
        stop:function(h){
            var m=c(this).data("ui-resizable"),j=m.options,g=m._proportionallyResizeElements,e=g.length&&(/textarea/i).test(g[0].nodeName),f=e&&c.ui.hasScroll(g[0],"left")?0:m.sizeDiff.height,l=e?0:m.sizeDiff.width,i={
                width:(m.size.width-l),
                height:(m.size.height-f)
            },k=(parseInt(m.element.css("left"),10)+(m.position.left-m.originalPosition.left))||null,n=(parseInt(m.element.css("top"),10)+(m.position.top-m.originalPosition.top))||null;
            m.element.animate(c.extend(i,n&&k?{
                top:n,
                left:k
            }:{}),{
                duration:j.animateDuration,
                easing:j.animateEasing,
                step:function(){
                    var o={
                        width:parseInt(m.element.css("width"),10),
                        height:parseInt(m.element.css("height"),10),
                        top:parseInt(m.element.css("top"),10),
                        left:parseInt(m.element.css("left"),10)
                    };

                    if(g&&g.length){
                        c(g[0]).css({
                            width:o.width,
                            height:o.height
                        })
                    }
                    m._updateCache(o);
                    m._propagate("resize",h)
                }
            })
        }
    });
    c.ui.plugin.add("resizable","containment",{
        start:function(){
            var m,g,q,e,l,h,r,n=c(this).data("ui-resizable"),k=n.options,j=n.element,f=k.containment,i=(f instanceof c)?f.get(0):(/parent/.test(f))?j.parent().get(0):f;
            if(!i){
                return
            }
            n.containerElement=c(i);
            if(/document/.test(f)||f===document){
                n.containerOffset={
                    left:0,
                    top:0
                };

                n.containerPosition={
                    left:0,
                    top:0
                };

                n.parentData={
                    element:c(document),
                    left:0,
                    top:0,
                    width:c(document).width(),
                    height:c(document).height()||document.body.parentNode.scrollHeight
                }
            }else{
                m=c(i);
                g=[];
                c(["Top","Right","Left","Bottom"]).each(function(p,o){
                    g[p]=b(m.css("padding"+o))
                });
                n.containerOffset=m.offset();
                n.containerPosition=m.position();
                n.containerSize={
                    height:(m.innerHeight()-g[3]),
                    width:(m.innerWidth()-g[1])
                };

                q=n.containerOffset;
                e=n.containerSize.height;
                l=n.containerSize.width;
                h=(c.ui.hasScroll(i,"left")?i.scrollWidth:l);
                r=(c.ui.hasScroll(i)?i.scrollHeight:e);
                n.parentData={
                    element:i,
                    left:q.left,
                    top:q.top,
                    width:h,
                    height:r
                }
            }
        },
        resize:function(f){
            var k,q,j,i,l=c(this).data("ui-resizable"),h=l.options,n=l.containerOffset,m=l.position,p=l._aspectRatio||f.shiftKey,e={
                top:0,
                left:0
            },g=l.containerElement;
            if(g[0]!==document&&(/static/).test(g.css("position"))){
                e=n
            }
            if(m.left<(l._helper?n.left:0)){
                l.size.width=l.size.width+(l._helper?(l.position.left-n.left):(l.position.left-e.left));
                if(p){
                    l.size.height=l.size.width/l.aspectRatio
                }
                l.position.left=h.helper?n.left:0
            }
            if(m.top<(l._helper?n.top:0)){
                l.size.height=l.size.height+(l._helper?(l.position.top-n.top):l.position.top);
                if(p){
                    l.size.width=l.size.height*l.aspectRatio
                }
                l.position.top=l._helper?n.top:0
            }
            l.offset.left=l.parentData.left+l.position.left;
            l.offset.top=l.parentData.top+l.position.top;
            k=Math.abs((l._helper?l.offset.left-e.left:(l.offset.left-e.left))+l.sizeDiff.width);
            q=Math.abs((l._helper?l.offset.top-e.top:(l.offset.top-n.top))+l.sizeDiff.height);
            j=l.containerElement.get(0)===l.element.parent().get(0);
            i=/relative|absolute/.test(l.containerElement.css("position"));
            if(j&&i){
                k-=l.parentData.left
            }
            if(k+l.size.width>=l.parentData.width){
                l.size.width=l.parentData.width-k;
                if(p){
                    l.size.height=l.size.width/l.aspectRatio
                }
            }
            if(q+l.size.height>=l.parentData.height){
                l.size.height=l.parentData.height-q;
                if(p){
                    l.size.width=l.size.height*l.aspectRatio
                }
            }
        },
        stop:function(){
            var k=c(this).data("ui-resizable"),f=k.options,l=k.containerOffset,e=k.containerPosition,g=k.containerElement,i=c(k.helper),n=i.offset(),m=i.outerWidth()-k.sizeDiff.width,j=i.outerHeight()-k.sizeDiff.height;
            if(k._helper&&!f.animate&&(/relative/).test(g.css("position"))){
                c(this).css({
                    left:n.left-e.left-l.left,
                    width:m,
                    height:j
                })
            }
            if(k._helper&&!f.animate&&(/static/).test(g.css("position"))){
                c(this).css({
                    left:n.left-e.left-l.left,
                    width:m,
                    height:j
                })
            }
        }
    });
    c.ui.plugin.add("resizable","alsoResize",{
        start:function(){
            var e=c(this).data("ui-resizable"),g=e.options,f=function(h){
                c(h).each(function(){
                    var i=c(this);
                    i.data("ui-resizable-alsoresize",{
                        width:parseInt(i.width(),10),
                        height:parseInt(i.height(),10),
                        left:parseInt(i.css("left"),10),
                        top:parseInt(i.css("top"),10)
                    })
                })
            };

            if(typeof(g.alsoResize)==="object"&&!g.alsoResize.parentNode){
                if(g.alsoResize.length){
                    g.alsoResize=g.alsoResize[0];
                    f(g.alsoResize)
                }else{
                    c.each(g.alsoResize,function(h){
                        f(h)
                    })
                }
            }else{
                f(g.alsoResize)
            }
        },
        resize:function(g,i){
            var f=c(this).data("ui-resizable"),j=f.options,h=f.originalSize,l=f.originalPosition,k={
                height:(f.size.height-h.height)||0,
                width:(f.size.width-h.width)||0,
                top:(f.position.top-l.top)||0,
                left:(f.position.left-l.left)||0
            },e=function(m,n){
                c(m).each(function(){
                    var q=c(this),r=c(this).data("ui-resizable-alsoresize"),p={},o=n&&n.length?n:q.parents(i.originalElement[0]).length?["width","height"]:["width","height","top","left"];
                    c.each(o,function(s,u){
                        var t=(r[u]||0)+(k[u]||0);
                        if(t&&t>=0){
                            p[u]=t||null
                        }
                    });
                    q.css(p)
                })
            };

            if(typeof(j.alsoResize)==="object"&&!j.alsoResize.nodeType){
                c.each(j.alsoResize,function(m,n){
                    e(m,n)
                })
            }else{
                e(j.alsoResize)
            }
        },
        stop:function(){
            c(this).removeData("resizable-alsoresize")
        }
    });
    c.ui.plugin.add("resizable","ghost",{
        start:function(){
            var f=c(this).data("ui-resizable"),g=f.options,e=f.size;
            f.ghost=f.originalElement.clone();
            f.ghost.css({
                opacity:0.25,
                display:"block",
                position:"relative",
                height:e.height,
                width:e.width,
                margin:0,
                left:0,
                top:0
            }).addClass("ui-resizable-ghost").addClass(typeof g.ghost==="string"?g.ghost:"");
            f.ghost.appendTo(f.helper)
        },
        resize:function(){
            var e=c(this).data("ui-resizable");
            if(e.ghost){
                e.ghost.css({
                    position:"relative",
                    height:e.size.height,
                    width:e.size.width
                })
            }
        },
        stop:function(){
            var e=c(this).data("ui-resizable");
            if(e.ghost&&e.helper){
                e.helper.get(0).removeChild(e.ghost.get(0))
            }
        }
    });
    c.ui.plugin.add("resizable","grid",{
        resize:function(){
            var r=c(this).data("ui-resizable"),i=r.options,s=r.size,k=r.originalSize,n=r.originalPosition,t=r.axis,f=typeof i.grid==="number"?[i.grid,i.grid]:i.grid,p=(f[0]||1),m=(f[1]||1),h=Math.round((s.width-k.width)/p)*p,g=Math.round((s.height-k.height)/m)*m,l=k.width+h,e=k.height+g,j=i.maxWidth&&(i.maxWidth<l),u=i.maxHeight&&(i.maxHeight<e),q=i.minWidth&&(i.minWidth>l),v=i.minHeight&&(i.minHeight>e);
            i.grid=f;
            if(q){
                l=l+p
            }
            if(v){
                e=e+m
            }
            if(j){
                l=l-p
            }
            if(u){
                e=e-m
            }
            if(/^(se|s|e)$/.test(t)){
                r.size.width=l;
                r.size.height=e
            }else{
                if(/^(ne)$/.test(t)){
                    r.size.width=l;
                    r.size.height=e;
                    r.position.top=n.top-g
                }else{
                    if(/^(sw)$/.test(t)){
                        r.size.width=l;
                        r.size.height=e;
                        r.position.left=n.left-h
                    }else{
                        r.size.width=l;
                        r.size.height=e;
                        r.position.top=n.top-g;
                        r.position.left=n.left-h
                    }
                }
            }
        }
    })
})(jQuery);
(function(a,b){
    a.widget("ui.selectable",a.ui.mouse,{
        version:"1.10.3",
        options:{
            appendTo:"body",
            autoRefresh:true,
            distance:0,
            filter:"*",
            tolerance:"touch",
            selected:null,
            selecting:null,
            start:null,
            stop:null,
            unselected:null,
            unselecting:null
        },
        _create:function(){
            var d,c=this;
            this.element.addClass("ui-selectable");
            this.dragged=false;
            this.refresh=function(){
                d=a(c.options.filter,c.element[0]);
                d.addClass("ui-selectee");
                d.each(function(){
                    var e=a(this),f=e.offset();
                    a.data(this,"selectable-item",{
                        element:this,
                        $element:e,
                        left:f.left,
                        top:f.top,
                        right:f.left+e.outerWidth(),
                        bottom:f.top+e.outerHeight(),
                        startselected:false,
                        selected:e.hasClass("ui-selected"),
                        selecting:e.hasClass("ui-selecting"),
                        unselecting:e.hasClass("ui-unselecting")
                    })
                })
            };

            this.refresh();
            this.selectees=d.addClass("ui-selectee");
            this._mouseInit();
            this.helper=a("<div class='ui-selectable-helper'></div>")
        },
        _destroy:function(){
            this.selectees.removeClass("ui-selectee").removeData("selectable-item");
            this.element.removeClass("ui-selectable ui-selectable-disabled");
            this._mouseDestroy()
        },
        _mouseStart:function(e){
            var d=this,c=this.options;
            this.opos=[e.pageX,e.pageY];
            if(this.options.disabled){
                return
            }
            this.selectees=a(c.filter,this.element[0]);
            this._trigger("start",e);
            a(c.appendTo).append(this.helper);
            this.helper.css({
                left:e.pageX,
                top:e.pageY,
                width:0,
                height:0
            });
            if(c.autoRefresh){
                this.refresh()
            }
            this.selectees.filter(".ui-selected").each(function(){
                var f=a.data(this,"selectable-item");
                f.startselected=true;
                if(!e.metaKey&&!e.ctrlKey){
                    f.$element.removeClass("ui-selected");
                    f.selected=false;
                    f.$element.addClass("ui-unselecting");
                    f.unselecting=true;
                    d._trigger("unselecting",e,{
                        unselecting:f.element
                    })
                }
            });
            a(e.target).parents().addBack().each(function(){
                var f,g=a.data(this,"selectable-item");
                if(g){
                    f=(!e.metaKey&&!e.ctrlKey)||!g.$element.hasClass("ui-selected");
                    g.$element.removeClass(f?"ui-unselecting":"ui-selected").addClass(f?"ui-selecting":"ui-unselecting");
                    g.unselecting=!f;
                    g.selecting=f;
                    g.selected=f;
                    if(f){
                        d._trigger("selecting",e,{
                            selecting:g.element
                        })
                    }else{
                        d._trigger("unselecting",e,{
                            unselecting:g.element
                        })
                    }
                    return false
                }
            })
        },
        _mouseDrag:function(j){
            this.dragged=true;
            if(this.options.disabled){
                return
            }
            var g,i=this,e=this.options,d=this.opos[0],h=this.opos[1],c=j.pageX,f=j.pageY;
            if(d>c){
                g=c;
                c=d;
                d=g
            }
            if(h>f){
                g=f;
                f=h;
                h=g
            }
            this.helper.css({
                left:d,
                top:h,
                width:c-d,
                height:f-h
            });
            this.selectees.each(function(){
                var k=a.data(this,"selectable-item"),l=false;
                if(!k||k.element===i.element[0]){
                    return
                }
                if(e.tolerance==="touch"){
                    l=(!(k.left>c||k.right<d||k.top>f||k.bottom<h))
                }else{
                    if(e.tolerance==="fit"){
                        l=(k.left>d&&k.right<c&&k.top>h&&k.bottom<f)
                    }
                }
                if(l){
                    if(k.selected){
                        k.$element.removeClass("ui-selected");
                        k.selected=false
                    }
                    if(k.unselecting){
                        k.$element.removeClass("ui-unselecting");
                        k.unselecting=false
                    }
                    if(!k.selecting){
                        k.$element.addClass("ui-selecting");
                        k.selecting=true;
                        i._trigger("selecting",j,{
                            selecting:k.element
                        })
                    }
                }else{
                    if(k.selecting){
                        if((j.metaKey||j.ctrlKey)&&k.startselected){
                            k.$element.removeClass("ui-selecting");
                            k.selecting=false;
                            k.$element.addClass("ui-selected");
                            k.selected=true
                        }else{
                            k.$element.removeClass("ui-selecting");
                            k.selecting=false;
                            if(k.startselected){
                                k.$element.addClass("ui-unselecting");
                                k.unselecting=true
                            }
                            i._trigger("unselecting",j,{
                                unselecting:k.element
                            })
                        }
                    }
                    if(k.selected){
                        if(!j.metaKey&&!j.ctrlKey&&!k.startselected){
                            k.$element.removeClass("ui-selected");
                            k.selected=false;
                            k.$element.addClass("ui-unselecting");
                            k.unselecting=true;
                            i._trigger("unselecting",j,{
                                unselecting:k.element
                            })
                        }
                    }
                }
            });
            return false
        },
        _mouseStop:function(d){
            var c=this;
            this.dragged=false;
            a(".ui-unselecting",this.element[0]).each(function(){
                var e=a.data(this,"selectable-item");
                e.$element.removeClass("ui-unselecting");
                e.unselecting=false;
                e.startselected=false;
                c._trigger("unselected",d,{
                    unselected:e.element
                })
            });
            a(".ui-selecting",this.element[0]).each(function(){
                var e=a.data(this,"selectable-item");
                e.$element.removeClass("ui-selecting").addClass("ui-selected");
                e.selecting=false;
                e.selected=true;
                e.startselected=true;
                c._trigger("selected",d,{
                    selected:e.element
                })
            });
            this._trigger("stop",d);
            this.helper.remove();
            return false
        }
    })
})(jQuery);
(function(b,d){
    function a(f,e,g){
        return(f>e)&&(f<(e+g))
    }
    function c(e){
        return(/left|right/).test(e.css("float"))||(/inline|table-cell/).test(e.css("display"))
    }
    b.widget("ui.sortable",b.ui.mouse,{
        version:"1.10.3",
        widgetEventPrefix:"sort",
        ready:false,
        options:{
            appendTo:"parent",
            axis:false,
            connectWith:false,
            containment:false,
            cursor:"auto",
            cursorAt:false,
            dropOnEmpty:true,
            forcePlaceholderSize:false,
            forceHelperSize:false,
            grid:false,
            handle:false,
            helper:"original",
            items:"> *",
            opacity:false,
            placeholder:false,
            revert:false,
            scroll:true,
            scrollSensitivity:20,
            scrollSpeed:20,
            scope:"default",
            tolerance:"intersect",
            zIndex:1000,
            activate:null,
            beforeStop:null,
            change:null,
            deactivate:null,
            out:null,
            over:null,
            receive:null,
            remove:null,
            sort:null,
            start:null,
            stop:null,
            update:null
        },
        _create:function(){
            var e=this.options;
            this.containerCache={};

            this.element.addClass("ui-sortable");
            this.refresh();
            this.floating=this.items.length?e.axis==="x"||c(this.items[0].item):false;
            this.offset=this.element.offset();
            this._mouseInit();
            this.ready=true
        },
        _destroy:function(){
            this.element.removeClass("ui-sortable ui-sortable-disabled");
            this._mouseDestroy();
            for(var e=this.items.length-1;e>=0;e--){
                this.items[e].item.removeData(this.widgetName+"-item")
            }
            return this
        },
        _setOption:function(e,f){
            if(e==="disabled"){
                this.options[e]=f;
                this.widget().toggleClass("ui-sortable-disabled",!!f)
            }else{
                b.Widget.prototype._setOption.apply(this,arguments)
            }
        },
        _mouseCapture:function(g,h){
            var e=null,i=false,f=this;
            if(this.reverting){
                return false
            }
            if(this.options.disabled||this.options.type==="static"){
                return false
            }
            this._refreshItems(g);
            b(g.target).parents().each(function(){
                if(b.data(this,f.widgetName+"-item")===f){
                    e=b(this);
                    return false
                }
            });
            if(b.data(g.target,f.widgetName+"-item")===f){
                e=b(g.target)
            }
            if(!e){
                return false
            }
            if(this.options.handle&&!h){
                b(this.options.handle,e).find("*").addBack().each(function(){
                    if(this===g.target){
                        i=true
                    }
                });
                if(!i){
                    return false
                }
            }
            this.currentItem=e;
            this._removeCurrentsFromItems();
            return true
        },
        _mouseStart:function(h,j,f){
            var g,e,k=this.options;
            this.currentContainer=this;
            this.refreshPositions();
            this.helper=this._createHelper(h);
            this._cacheHelperProportions();
            this._cacheMargins();
            this.scrollParent=this.helper.scrollParent();
            this.offset=this.currentItem.offset();
            this.offset={
                top:this.offset.top-this.margins.top,
                left:this.offset.left-this.margins.left
            };

            b.extend(this.offset,{
                click:{
                    left:h.pageX-this.offset.left,
                    top:h.pageY-this.offset.top
                },
                parent:this._getParentOffset(),
                relative:this._getRelativeOffset()
            });
            this.helper.css("position","absolute");
            this.cssPosition=this.helper.css("position");
            this.originalPosition=this._generatePosition(h);
            this.originalPageX=h.pageX;
            this.originalPageY=h.pageY;
            (k.cursorAt&&this._adjustOffsetFromHelper(k.cursorAt));
            this.domPosition={
                prev:this.currentItem.prev()[0],
                parent:this.currentItem.parent()[0]
            };

            if(this.helper[0]!==this.currentItem[0]){
                this.currentItem.hide()
            }
            this._createPlaceholder();
            if(k.containment){
                this._setContainment()
            }
            if(k.cursor&&k.cursor!=="auto"){
                e=this.document.find("body");
                this.storedCursor=e.css("cursor");
                e.css("cursor",k.cursor);
                this.storedStylesheet=b("<style>*{ cursor: "+k.cursor+" !important; }</style>").appendTo(e)
            }
            if(k.opacity){
                if(this.helper.css("opacity")){
                    this._storedOpacity=this.helper.css("opacity")
                }
                this.helper.css("opacity",k.opacity)
            }
            if(k.zIndex){
                if(this.helper.css("zIndex")){
                    this._storedZIndex=this.helper.css("zIndex")
                }
                this.helper.css("zIndex",k.zIndex)
            }
            if(this.scrollParent[0]!==document&&this.scrollParent[0].tagName!=="HTML"){
                this.overflowOffset=this.scrollParent.offset()
            }
            this._trigger("start",h,this._uiHash());
            if(!this._preserveHelperProportions){
                this._cacheHelperProportions()
            }
            if(!f){
                for(g=this.containers.length-1;g>=0;g--){
                    this.containers[g]._trigger("activate",h,this._uiHash(this))
                }
            }
            if(b.ui.ddmanager){
                b.ui.ddmanager.current=this
            }
            if(b.ui.ddmanager&&!k.dropBehaviour){
                b.ui.ddmanager.prepareOffsets(this,h)
            }
            this.dragging=true;
            this.helper.addClass("ui-sortable-helper");
            this._mouseDrag(h);
            return true
        },
        _mouseDrag:function(j){
            var g,h,f,l,k=this.options,e=false;
            this.position=this._generatePosition(j);
            this.positionAbs=this._convertPositionTo("absolute");
            if(!this.lastPositionAbs){
                this.lastPositionAbs=this.positionAbs
            }
            if(this.options.scroll){
                if(this.scrollParent[0]!==document&&this.scrollParent[0].tagName!=="HTML"){
                    if((this.overflowOffset.top+this.scrollParent[0].offsetHeight)-j.pageY<k.scrollSensitivity){
                        this.scrollParent[0].scrollTop=e=this.scrollParent[0].scrollTop+k.scrollSpeed
                    }else{
                        if(j.pageY-this.overflowOffset.top<k.scrollSensitivity){
                            this.scrollParent[0].scrollTop=e=this.scrollParent[0].scrollTop-k.scrollSpeed
                        }
                    }
                    if((this.overflowOffset.left+this.scrollParent[0].offsetWidth)-j.pageX<k.scrollSensitivity){
                        this.scrollParent[0].scrollLeft=e=this.scrollParent[0].scrollLeft+k.scrollSpeed
                    }else{
                        if(j.pageX-this.overflowOffset.left<k.scrollSensitivity){
                            this.scrollParent[0].scrollLeft=e=this.scrollParent[0].scrollLeft-k.scrollSpeed
                        }
                    }
                }else{
                    if(j.pageY-b(document).scrollTop()<k.scrollSensitivity){
                        e=b(document).scrollTop(b(document).scrollTop()-k.scrollSpeed)
                    }else{
                        if(b(window).height()-(j.pageY-b(document).scrollTop())<k.scrollSensitivity){
                            e=b(document).scrollTop(b(document).scrollTop()+k.scrollSpeed)
                        }
                    }
                    if(j.pageX-b(document).scrollLeft()<k.scrollSensitivity){
                        e=b(document).scrollLeft(b(document).scrollLeft()-k.scrollSpeed)
                    }else{
                        if(b(window).width()-(j.pageX-b(document).scrollLeft())<k.scrollSensitivity){
                            e=b(document).scrollLeft(b(document).scrollLeft()+k.scrollSpeed)
                        }
                    }
                }
                if(e!==false&&b.ui.ddmanager&&!k.dropBehaviour){
                    b.ui.ddmanager.prepareOffsets(this,j)
                }
            }
            this.positionAbs=this._convertPositionTo("absolute");
            if(!this.options.axis||this.options.axis!=="y"){
                this.helper[0].style.left=this.position.left+"px"
            }
            if(!this.options.axis||this.options.axis!=="x"){
                this.helper[0].style.top=this.position.top+"px"
            }
            for(g=this.items.length-1;g>=0;g--){
                h=this.items[g];
                f=h.item[0];
                l=this._intersectsWithPointer(h);
                if(!l){
                    continue
                }
                if(h.instance!==this.currentContainer){
                    continue
                }
                if(f!==this.currentItem[0]&&this.placeholder[l===1?"next":"prev"]()[0]!==f&&!b.contains(this.placeholder[0],f)&&(this.options.type==="semi-dynamic"?!b.contains(this.element[0],f):true)){
                    this.direction=l===1?"down":"up";
                    if(this.options.tolerance==="pointer"||this._intersectsWithSides(h)){
                        this._rearrange(j,h)
                    }else{
                        break
                    }
                    this._trigger("change",j,this._uiHash());
                    break
                }
            }
            this._contactContainers(j);
            if(b.ui.ddmanager){
                b.ui.ddmanager.drag(this,j)
            }
            this._trigger("sort",j,this._uiHash());
            this.lastPositionAbs=this.positionAbs;
            return false
        },
        _mouseStop:function(g,i){
            if(!g){
                return
            }
            if(b.ui.ddmanager&&!this.options.dropBehaviour){
                b.ui.ddmanager.drop(this,g)
            }
            if(this.options.revert){
                var f=this,j=this.placeholder.offset(),e=this.options.axis,h={};

                if(!e||e==="x"){
                    h.left=j.left-this.offset.parent.left-this.margins.left+(this.offsetParent[0]===document.body?0:this.offsetParent[0].scrollLeft)
                }
                if(!e||e==="y"){
                    h.top=j.top-this.offset.parent.top-this.margins.top+(this.offsetParent[0]===document.body?0:this.offsetParent[0].scrollTop)
                }
                this.reverting=true;
                b(this.helper).animate(h,parseInt(this.options.revert,10)||500,function(){
                    f._clear(g)
                })
            }else{
                this._clear(g,i)
            }
            return false
        },
        cancel:function(){
            if(this.dragging){
                this._mouseUp({
                    target:null
                });
                if(this.options.helper==="original"){
                    this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")
                }else{
                    this.currentItem.show()
                }
                for(var e=this.containers.length-1;e>=0;e--){
                    this.containers[e]._trigger("deactivate",null,this._uiHash(this));
                    if(this.containers[e].containerCache.over){
                        this.containers[e]._trigger("out",null,this._uiHash(this));
                        this.containers[e].containerCache.over=0
                    }
                }
            }
            if(this.placeholder){
                if(this.placeholder[0].parentNode){
                    this.placeholder[0].parentNode.removeChild(this.placeholder[0])
                }
                if(this.options.helper!=="original"&&this.helper&&this.helper[0].parentNode){
                    this.helper.remove()
                }
                b.extend(this,{
                    helper:null,
                    dragging:false,
                    reverting:false,
                    _noFinalSort:null
                });
                if(this.domPosition.prev){
                    b(this.domPosition.prev).after(this.currentItem)
                }else{
                    b(this.domPosition.parent).prepend(this.currentItem)
                }
            }
            return this
        },
        serialize:function(g){
            var e=this._getItemsAsjQuery(g&&g.connected),f=[];
            g=g||{};

            b(e).each(function(){
                var h=(b(g.item||this).attr(g.attribute||"id")||"").match(g.expression||(/(.+)[\-=_](.+)/));
                if(h){
                    f.push((g.key||h[1]+"[]")+"="+(g.key&&g.expression?h[1]:h[2]))
                }
            });
            if(!f.length&&g.key){
                f.push(g.key+"=")
            }
            return f.join("&")
        },
        toArray:function(g){
            var e=this._getItemsAsjQuery(g&&g.connected),f=[];
            g=g||{};

            e.each(function(){
                f.push(b(g.item||this).attr(g.attribute||"id")||"")
            });
            return f
        },
        _intersectsWith:function(q){
            var g=this.positionAbs.left,f=g+this.helperProportions.width,o=this.positionAbs.top,n=o+this.helperProportions.height,h=q.left,e=h+q.width,s=q.top,m=s+q.height,u=this.offset.click.top,k=this.offset.click.left,j=(this.options.axis==="x")||((o+u)>s&&(o+u)<m),p=(this.options.axis==="y")||((g+k)>h&&(g+k)<e),i=j&&p;
            if(this.options.tolerance==="pointer"||this.options.forcePointerForContainers||(this.options.tolerance!=="pointer"&&this.helperProportions[this.floating?"width":"height"]>q[this.floating?"width":"height"])){
                return i
            }else{
                return(h<g+(this.helperProportions.width/2)&&f-(this.helperProportions.width/2)<e&&s<o+(this.helperProportions.height/2)&&n-(this.helperProportions.height/2)<m)
            }
        },
        _intersectsWithPointer:function(g){
            var h=(this.options.axis==="x")||a(this.positionAbs.top+this.offset.click.top,g.top,g.height),f=(this.options.axis==="y")||a(this.positionAbs.left+this.offset.click.left,g.left,g.width),j=h&&f,e=this._getDragVerticalDirection(),i=this._getDragHorizontalDirection();
            if(!j){
                return false
            }
            return this.floating?(((i&&i==="right")||e==="down")?2:1):(e&&(e==="down"?2:1))
        },
        _intersectsWithSides:function(h){
            var f=a(this.positionAbs.top+this.offset.click.top,h.top+(h.height/2),h.height),g=a(this.positionAbs.left+this.offset.click.left,h.left+(h.width/2),h.width),e=this._getDragVerticalDirection(),i=this._getDragHorizontalDirection();
            if(this.floating&&i){
                return((i==="right"&&g)||(i==="left"&&!g))
            }else{
                return e&&((e==="down"&&f)||(e==="up"&&!f))
            }
        },
        _getDragVerticalDirection:function(){
            var e=this.positionAbs.top-this.lastPositionAbs.top;
            return e!==0&&(e>0?"down":"up")
        },
        _getDragHorizontalDirection:function(){
            var e=this.positionAbs.left-this.lastPositionAbs.left;
            return e!==0&&(e>0?"right":"left")
        },
        refresh:function(e){
            this._refreshItems(e);
            this.refreshPositions();
            return this
        },
        _connectWith:function(){
            var e=this.options;
            return e.connectWith.constructor===String?[e.connectWith]:e.connectWith
        },
        _getItemsAsjQuery:function(l){
            var h,g,n,m,e=[],f=[],k=this._connectWith();
            if(k&&l){
                for(h=k.length-1;h>=0;h--){
                    n=b(k[h]);
                    for(g=n.length-1;g>=0;g--){
                        m=b.data(n[g],this.widgetFullName);
                        if(m&&m!==this&&!m.options.disabled){
                            f.push([b.isFunction(m.options.items)?m.options.items.call(m.element):b(m.options.items,m.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),m])
                        }
                    }
                }
            }
            f.push([b.isFunction(this.options.items)?this.options.items.call(this.element,null,{
                options:this.options,
                item:this.currentItem
            }):b(this.options.items,this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),this]);
            for(h=f.length-1;h>=0;h--){
                f[h][0].each(function(){
                    e.push(this)
                })
            }
            return b(e)
        },
        _removeCurrentsFromItems:function(){
            var e=this.currentItem.find(":data("+this.widgetName+"-item)");
            this.items=b.grep(this.items,function(g){
                for(var f=0;f<e.length;f++){
                    if(e[f]===g.item[0]){
                        return false
                    }
                }
                return true
            })
        },
        _refreshItems:function(e){
            this.items=[];
            this.containers=[this];
            var k,g,p,l,o,f,r,q,m=this.items,h=[[b.isFunction(this.options.items)?this.options.items.call(this.element[0],e,{
                item:this.currentItem
            }):b(this.options.items,this.element),this]],n=this._connectWith();
            if(n&&this.ready){
                for(k=n.length-1;k>=0;k--){
                    p=b(n[k]);
                    for(g=p.length-1;g>=0;g--){
                        l=b.data(p[g],this.widgetFullName);
                        if(l&&l!==this&&!l.options.disabled){
                            h.push([b.isFunction(l.options.items)?l.options.items.call(l.element[0],e,{
                                item:this.currentItem
                            }):b(l.options.items,l.element),l]);
                            this.containers.push(l)
                        }
                    }
                }
            }
            for(k=h.length-1;k>=0;k--){
                o=h[k][1];
                f=h[k][0];
                for(g=0,q=f.length;g<q;g++){
                    r=b(f[g]);
                    r.data(this.widgetName+"-item",o);
                    m.push({
                        item:r,
                        instance:o,
                        width:0,
                        height:0,
                        left:0,
                        top:0
                    })
                }
            }
        },
        refreshPositions:function(e){
            if(this.offsetParent&&this.helper){
                this.offset.parent=this._getParentOffset()
            }
            var g,h,f,j;
            for(g=this.items.length-1;g>=0;g--){
                h=this.items[g];
                if(h.instance!==this.currentContainer&&this.currentContainer&&h.item[0]!==this.currentItem[0]){
                    continue
                }
                f=this.options.toleranceElement?b(this.options.toleranceElement,h.item):h.item;
                if(!e){
                    h.width=f.outerWidth();
                    h.height=f.outerHeight()
                }
                j=f.offset();
                h.left=j.left;
                h.top=j.top
            }
            if(this.options.custom&&this.options.custom.refreshContainers){
                this.options.custom.refreshContainers.call(this)
            }else{
                for(g=this.containers.length-1;g>=0;g--){
                    j=this.containers[g].element.offset();
                    this.containers[g].containerCache.left=j.left;
                    this.containers[g].containerCache.top=j.top;
                    this.containers[g].containerCache.width=this.containers[g].element.outerWidth();
                    this.containers[g].containerCache.height=this.containers[g].element.outerHeight()
                }
            }
            return this
        },
        _createPlaceholder:function(f){
            f=f||this;
            var e,g=f.options;
            if(!g.placeholder||g.placeholder.constructor===String){
                e=g.placeholder;
                g.placeholder={
                    element:function(){
                        var i=f.currentItem[0].nodeName.toLowerCase(),h=b("<"+i+">",f.document[0]).addClass(e||f.currentItem[0].className+" ui-sortable-placeholder").removeClass("ui-sortable-helper");
                        if(i==="tr"){
                            f.currentItem.children().each(function(){
                                b("<td>&#160;</td>",f.document[0]).attr("colspan",b(this).attr("colspan")||1).appendTo(h)
                            })
                        }else{
                            if(i==="img"){
                                h.attr("src",f.currentItem.attr("src"))
                            }
                        }
                        if(!e){
                            h.css("visibility","hidden")
                        }
                        return h
                    },
                    update:function(h,i){
                        if(e&&!g.forcePlaceholderSize){
                            return
                        }
                        if(!i.height()){
                            i.height(f.currentItem.innerHeight()-parseInt(f.currentItem.css("paddingTop")||0,10)-parseInt(f.currentItem.css("paddingBottom")||0,10))
                        }
                        if(!i.width()){
                            i.width(f.currentItem.innerWidth()-parseInt(f.currentItem.css("paddingLeft")||0,10)-parseInt(f.currentItem.css("paddingRight")||0,10))
                        }
                    }
                }
            }
            f.placeholder=b(g.placeholder.element.call(f.element,f.currentItem));
            f.currentItem.after(f.placeholder);
            g.placeholder.update(f,f.placeholder)
        },
        _contactContainers:function(e){
            var l,h,p,m,n,r,f,s,k,o,g=null,q=null;
            for(l=this.containers.length-1;l>=0;l--){
                if(b.contains(this.currentItem[0],this.containers[l].element[0])){
                    continue
                }
                if(this._intersectsWith(this.containers[l].containerCache)){
                    if(g&&b.contains(this.containers[l].element[0],g.element[0])){
                        continue
                    }
                    g=this.containers[l];
                    q=l
                }else{
                    if(this.containers[l].containerCache.over){
                        this.containers[l]._trigger("out",e,this._uiHash(this));
                        this.containers[l].containerCache.over=0
                    }
                }
            }
            if(!g){
                return
            }
            if(this.containers.length===1){
                if(!this.containers[q].containerCache.over){
                    this.containers[q]._trigger("over",e,this._uiHash(this));
                    this.containers[q].containerCache.over=1
                }
            }else{
                p=10000;
                m=null;
                o=g.floating||c(this.currentItem);
                n=o?"left":"top";
                r=o?"width":"height";
                f=this.positionAbs[n]+this.offset.click[n];
                for(h=this.items.length-1;h>=0;h--){
                    if(!b.contains(this.containers[q].element[0],this.items[h].item[0])){
                        continue
                    }
                    if(this.items[h].item[0]===this.currentItem[0]){
                        continue
                    }
                    if(o&&!a(this.positionAbs.top+this.offset.click.top,this.items[h].top,this.items[h].height)){
                        continue
                    }
                    s=this.items[h].item.offset()[n];
                    k=false;
                    if(Math.abs(s-f)>Math.abs(s+this.items[h][r]-f)){
                        k=true;
                        s+=this.items[h][r]
                    }
                    if(Math.abs(s-f)<p){
                        p=Math.abs(s-f);
                        m=this.items[h];
                        this.direction=k?"up":"down"
                    }
                }
                if(!m&&!this.options.dropOnEmpty){
                    return
                }
                if(this.currentContainer===this.containers[q]){
                    return
                }
                m?this._rearrange(e,m,null,true):this._rearrange(e,null,this.containers[q].element,true);
                this._trigger("change",e,this._uiHash());
                this.containers[q]._trigger("change",e,this._uiHash(this));
                this.currentContainer=this.containers[q];
                this.options.placeholder.update(this.currentContainer,this.placeholder);
                this.containers[q]._trigger("over",e,this._uiHash(this));
                this.containers[q].containerCache.over=1
            }
        },
        _createHelper:function(f){
            var g=this.options,e=b.isFunction(g.helper)?b(g.helper.apply(this.element[0],[f,this.currentItem])):(g.helper==="clone"?this.currentItem.clone():this.currentItem);
            if(!e.parents("body").length){
                b(g.appendTo!=="parent"?g.appendTo:this.currentItem[0].parentNode)[0].appendChild(e[0])
            }
            if(e[0]===this.currentItem[0]){
                this._storedCSS={
                    width:this.currentItem[0].style.width,
                    height:this.currentItem[0].style.height,
                    position:this.currentItem.css("position"),
                    top:this.currentItem.css("top"),
                    left:this.currentItem.css("left")
                }
            }
            if(!e[0].style.width||g.forceHelperSize){
                e.width(this.currentItem.width())
            }
            if(!e[0].style.height||g.forceHelperSize){
                e.height(this.currentItem.height())
            }
            return e
        },
        _adjustOffsetFromHelper:function(e){
            if(typeof e==="string"){
                e=e.split(" ")
            }
            if(b.isArray(e)){
                e={
                    left:+e[0],
                    top:+e[1]||0
                }
            }
            if("left" in e){
                this.offset.click.left=e.left+this.margins.left
            }
            if("right" in e){
                this.offset.click.left=this.helperProportions.width-e.right+this.margins.left
            }
            if("top" in e){
                this.offset.click.top=e.top+this.margins.top
            }
            if("bottom" in e){
                this.offset.click.top=this.helperProportions.height-e.bottom+this.margins.top
            }
        },
        _getParentOffset:function(){
            this.offsetParent=this.helper.offsetParent();
            var e=this.offsetParent.offset();
            if(this.cssPosition==="absolute"&&this.scrollParent[0]!==document&&b.contains(this.scrollParent[0],this.offsetParent[0])){
                e.left+=this.scrollParent.scrollLeft();
                e.top+=this.scrollParent.scrollTop()
            }
            if(this.offsetParent[0]===document.body||(this.offsetParent[0].tagName&&this.offsetParent[0].tagName.toLowerCase()==="html"&&b.ui.ie)){
                e={
                    top:0,
                    left:0
                }
            }
            return{
                top:e.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),
                left:e.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)
            }
        },
        _getRelativeOffset:function(){
            if(this.cssPosition==="relative"){
                var e=this.currentItem.position();
                return{
                    top:e.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),
                    left:e.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()
                }
            }else{
                return{
                    top:0,
                    left:0
                }
            }
        },
        _cacheMargins:function(){
            this.margins={
                left:(parseInt(this.currentItem.css("marginLeft"),10)||0),
                top:(parseInt(this.currentItem.css("marginTop"),10)||0)
            }
        },
        _cacheHelperProportions:function(){
            this.helperProportions={
                width:this.helper.outerWidth(),
                height:this.helper.outerHeight()
            }
        },
        _setContainment:function(){
            var f,h,e,g=this.options;
            if(g.containment==="parent"){
                g.containment=this.helper[0].parentNode
            }
            if(g.containment==="document"||g.containment==="window"){
                this.containment=[0-this.offset.relative.left-this.offset.parent.left,0-this.offset.relative.top-this.offset.parent.top,b(g.containment==="document"?document:window).width()-this.helperProportions.width-this.margins.left,(b(g.containment==="document"?document:window).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top]
            }
            if(!(/^(document|window|parent)$/).test(g.containment)){
                f=b(g.containment)[0];
                h=b(g.containment).offset();
                e=(b(f).css("overflow")!=="hidden");
                this.containment=[h.left+(parseInt(b(f).css("borderLeftWidth"),10)||0)+(parseInt(b(f).css("paddingLeft"),10)||0)-this.margins.left,h.top+(parseInt(b(f).css("borderTopWidth"),10)||0)+(parseInt(b(f).css("paddingTop"),10)||0)-this.margins.top,h.left+(e?Math.max(f.scrollWidth,f.offsetWidth):f.offsetWidth)-(parseInt(b(f).css("borderLeftWidth"),10)||0)-(parseInt(b(f).css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left,h.top+(e?Math.max(f.scrollHeight,f.offsetHeight):f.offsetHeight)-(parseInt(b(f).css("borderTopWidth"),10)||0)-(parseInt(b(f).css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top]
            }
        },
        _convertPositionTo:function(g,i){
            if(!i){
                i=this.position
            }
            var f=g==="absolute"?1:-1,e=this.cssPosition==="absolute"&&!(this.scrollParent[0]!==document&&b.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,h=(/(html|body)/i).test(e[0].tagName);
            return{
                top:(i.top+this.offset.relative.top*f+this.offset.parent.top*f-((this.cssPosition==="fixed"?-this.scrollParent.scrollTop():(h?0:e.scrollTop()))*f)),
                left:(i.left+this.offset.relative.left*f+this.offset.parent.left*f-((this.cssPosition==="fixed"?-this.scrollParent.scrollLeft():h?0:e.scrollLeft())*f))
            }
        },
        _generatePosition:function(h){
            var j,i,k=this.options,g=h.pageX,f=h.pageY,e=this.cssPosition==="absolute"&&!(this.scrollParent[0]!==document&&b.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,l=(/(html|body)/i).test(e[0].tagName);
            if(this.cssPosition==="relative"&&!(this.scrollParent[0]!==document&&this.scrollParent[0]!==this.offsetParent[0])){
                this.offset.relative=this._getRelativeOffset()
            }
            if(this.originalPosition){
                if(this.containment){
                    if(h.pageX-this.offset.click.left<this.containment[0]){
                        g=this.containment[0]+this.offset.click.left
                    }
                    if(h.pageY-this.offset.click.top<this.containment[1]){
                        f=this.containment[1]+this.offset.click.top
                    }
                    if(h.pageX-this.offset.click.left>this.containment[2]){
                        g=this.containment[2]+this.offset.click.left
                    }
                    if(h.pageY-this.offset.click.top>this.containment[3]){
                        f=this.containment[3]+this.offset.click.top
                    }
                }
                if(k.grid){
                    j=this.originalPageY+Math.round((f-this.originalPageY)/k.grid[1])*k.grid[1];
                    f=this.containment?((j-this.offset.click.top>=this.containment[1]&&j-this.offset.click.top<=this.containment[3])?j:((j-this.offset.click.top>=this.containment[1])?j-k.grid[1]:j+k.grid[1])):j;
                    i=this.originalPageX+Math.round((g-this.originalPageX)/k.grid[0])*k.grid[0];
                    g=this.containment?((i-this.offset.click.left>=this.containment[0]&&i-this.offset.click.left<=this.containment[2])?i:((i-this.offset.click.left>=this.containment[0])?i-k.grid[0]:i+k.grid[0])):i
                }
            }
            return{
                top:(f-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+((this.cssPosition==="fixed"?-this.scrollParent.scrollTop():(l?0:e.scrollTop())))),
                left:(g-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+((this.cssPosition==="fixed"?-this.scrollParent.scrollLeft():l?0:e.scrollLeft())))
            }
        },
        _rearrange:function(j,h,f,g){
            f?f[0].appendChild(this.placeholder[0]):h.item[0].parentNode.insertBefore(this.placeholder[0],(this.direction==="down"?h.item[0]:h.item[0].nextSibling));
            this.counter=this.counter?++this.counter:1;
            var e=this.counter;
            this._delay(function(){
                if(e===this.counter){
                    this.refreshPositions(!g)
                }
            })
        },
        _clear:function(f,g){
            this.reverting=false;
            var e,h=[];
            if(!this._noFinalSort&&this.currentItem.parent().length){
                this.placeholder.before(this.currentItem)
            }
            this._noFinalSort=null;
            if(this.helper[0]===this.currentItem[0]){
                for(e in this._storedCSS){
                    if(this._storedCSS[e]==="auto"||this._storedCSS[e]==="static"){
                        this._storedCSS[e]=""
                    }
                }
                this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")
            }else{
                this.currentItem.show()
            }
            if(this.fromOutside&&!g){
                h.push(function(i){
                    this._trigger("receive",i,this._uiHash(this.fromOutside))
                })
            }
            if((this.fromOutside||this.domPosition.prev!==this.currentItem.prev().not(".ui-sortable-helper")[0]||this.domPosition.parent!==this.currentItem.parent()[0])&&!g){
                h.push(function(i){
                    this._trigger("update",i,this._uiHash())
                })
            }
            if(this!==this.currentContainer){
                if(!g){
                    h.push(function(i){
                        this._trigger("remove",i,this._uiHash())
                    });
                    h.push((function(i){
                        return function(j){
                            i._trigger("receive",j,this._uiHash(this))
                        }
                    }).call(this,this.currentContainer));
                    h.push((function(i){
                        return function(j){
                            i._trigger("update",j,this._uiHash(this))
                        }
                    }).call(this,this.currentContainer))
                }
            }
            for(e=this.containers.length-1;e>=0;e--){
                if(!g){
                    h.push((function(i){
                        return function(j){
                            i._trigger("deactivate",j,this._uiHash(this))
                        }
                    }).call(this,this.containers[e]))
                }
                if(this.containers[e].containerCache.over){
                    h.push((function(i){
                        return function(j){
                            i._trigger("out",j,this._uiHash(this))
                        }
                    }).call(this,this.containers[e]));
                    this.containers[e].containerCache.over=0
                }
            }
            if(this.storedCursor){
                this.document.find("body").css("cursor",this.storedCursor);
                this.storedStylesheet.remove()
            }
            if(this._storedOpacity){
                this.helper.css("opacity",this._storedOpacity)
            }
            if(this._storedZIndex){
                this.helper.css("zIndex",this._storedZIndex==="auto"?"":this._storedZIndex)
            }
            this.dragging=false;
            if(this.cancelHelperRemoval){
                if(!g){
                    this._trigger("beforeStop",f,this._uiHash());
                    for(e=0;e<h.length;e++){
                        h[e].call(this,f)
                    }
                    this._trigger("stop",f,this._uiHash())
                }
                this.fromOutside=false;
                return false
            }
            if(!g){
                this._trigger("beforeStop",f,this._uiHash())
            }
            this.placeholder[0].parentNode.removeChild(this.placeholder[0]);
            if(this.helper[0]!==this.currentItem[0]){
                this.helper.remove()
            }
            this.helper=null;
            if(!g){
                for(e=0;e<h.length;e++){
                    h[e].call(this,f)
                }
                this._trigger("stop",f,this._uiHash())
            }
            this.fromOutside=false;
            return true
        },
        _trigger:function(){
            if(b.Widget.prototype._trigger.apply(this,arguments)===false){
                this.cancel()
            }
        },
        _uiHash:function(e){
            var f=e||this;
            return{
                helper:f.helper,
                placeholder:f.placeholder||b([]),
                position:f.position,
                originalPosition:f.originalPosition,
                offset:f.positionAbs,
                item:f.currentItem,
                sender:e?e.element:null
            }
        }
    })
})(jQuery);
(function(a,c){
    var b="ui-effects-";
    a.effects={
        effect:{}
    };

})


$(document).ready(function(){
    quickView();
});

function quickView(){
    $(".quick-view, .quick-view-point").click(function(){
        var href = $(this).attr('href');
        $.ajax({
            type: 'GET',
            cache: false,
            url: href,
            success: function(data){
                $.fancybox(data,{
                    'scrolling' : 'no'
                });
                $('#fancybox-content').css('background-color','#666666');

                scripts = $("#fancybox-content script");
                for(var i = 0; i < scripts.length; i++) {
                    eval(scripts[i].innerHTML);
                }
            }
        });

        return false;
    });

    $(".inner-product-home, .thumb-promo-sub").bind('mouseout', function(){
        $('a.quick-view', this).hide();
        $('a.view-zoom-point', this).hide();
    });

    $(".inner-product-home, .thumb-promo-sub").bind('mouseover', function(){
        $('a.quick-view', this).show();
        $('a.view-zoom-point', this).show();
    });
}

/* jquery.fancybox.pack.js */
(function(v,g,i,r){
    var f=i(v),b=i(g),j=i.fancybox=function(){
        j.open.apply(this,arguments)
    },p=!1,h=g.createTouch!==r,c=function(d){
        return"string"===i.type(d)
    },e=function(a,d){
        d&&c(a)&&0<a.indexOf("%")&&(a=j.getViewport()[d]/100*parseInt(a,10));
        return Math.round(a)+"px"
    };

    i.extend(j,{
        version:"2.0.5",
        defaults:{
            padding:15,
            margin:20,
            width:800,
            height:600,
            minWidth:100,
            minHeight:100,
            maxWidth:9999,
            maxHeight:9999,
            autoSize:!0,
            autoResize:!h,
            autoCenter:!h,
            fitToView:!0,
            aspectRatio:!1,
            topRatio:0.5,
            fixed:!1,
            scrolling:"no",
            wrapCSS:"",
            arrows:!0,
            closeBtn:!0,
            closeClick:!1,
            nextClick:!1,
            mouseWheel:!0,
            autoPlay:!1,
            playSpeed:3000,
            preload:3,
            modal:!1,
            loop:!0,
            ajax:{
                dataType:"html",
                headers:{
                    "X-fancyBox":!0
                }
            },
            keys:{
                next:[13,32,34,39,40],
                prev:[8,33,37,38],
                close:[27]
            },
            tpl:{
                wrap:'<div class="fancybox-wrap"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
                image:'<img class="fancybox-image" src="{href}" alt="" />',
                iframe:'<iframe class="fancybox-iframe" name="fancybox-frame{rnd}" frameborder="0" hspace="0"'+(i.browser.msie?' allowtransparency="true"':"")+"></iframe>",
                swf:'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="wmode" value="transparent" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{href}" /><embed src="{href}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="100%" height="100%" wmode="transparent"></embed></object>',
                error:'<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',
                closeBtn:'<div title="Close" class="fancybox-item fancybox-close"></div>',
                next:'<a title="Next" class="fancybox-nav fancybox-next"><span></span></a>',
                prev:'<a title="Previous" class="fancybox-nav fancybox-prev"><span></span></a>'
            },
            openEffect:"fade",
            openSpeed:300,
            openEasing:"swing",
            openOpacity:!0,
            openMethod:"zoomIn",
            closeEffect:"fade",
            closeSpeed:300,
            closeEasing:"swing",
            closeOpacity:!0,
            closeMethod:"zoomOut",
            nextEffect:"elastic",
            nextSpeed:300,
            nextEasing:"swing",
            nextMethod:"changeIn",
            prevEffect:"elastic",
            prevSpeed:300,
            prevEasing:"swing",
            prevMethod:"changeOut",
            helpers:{
                overlay:{
                    speedIn:0,
                    speedOut:300,
                    opacity:0.8,
                    css:{
                        cursor:"pointer"
                    },
                    closeClick:!0
                },
                title:{
                    type:"float"
                }
            }
        },
        group:{},
        opts:{},
        coming:null,
        current:null,
        isOpen:!1,
        isOpened:!1,
        player:{
            timer:null,
            isActive:!1
        },
        ajaxLoad:null,
        imgPreload:null,
        transitions:{},
        helpers:{},
        open:function(a,d){
            j.close(!0);
            a&&!i.isArray(a)&&(a=a instanceof i?i(a).get():[a]);
            j.isActive=!0;
            j.opts=i.extend(!0,{},j.defaults,d);
            i.isPlainObject(d)&&d.keys!==r&&(j.opts.keys=d.keys?i.extend({},j.defaults.keys,d.keys):!1);
            j.group=a;
            j._start(j.opts.index||0)
        },
        cancel:function(){
            j.coming&&!1===j.trigger("onCancel")||(j.coming=null,j.hideLoading(),j.ajaxLoad&&j.ajaxLoad.abort(),j.ajaxLoad=null,j.imgPreload&&(j.imgPreload.onload=j.imgPreload.onabort=j.imgPreload.onerror=null))
        },
        close:function(a){
            j.cancel();
            j.current&&!1!==j.trigger("beforeClose")&&(j.unbindEvents(),!j.isOpen||a&&!0===a[0]?(i(".fancybox-wrap").stop().trigger("onReset").remove(),j._afterZoomOut()):(j.isOpen=j.isOpened=!1,i(".fancybox-item, .fancybox-nav").remove(),j.wrap.stop(!0).removeClass("fancybox-opened"),j.inner.css("overflow","hidden"),j.transitions[j.current.closeMethod]()))
        },
        play:function(a){
            var l=function(){
                clearTimeout(j.player.timer)
            },k=function(){
                l();
                j.current&&j.player.isActive&&(j.player.timer=setTimeout(j.next,j.current.playSpeed))
            },d=function(){
                l();
                i("body").unbind(".player");
                j.player.isActive=!1;
                j.trigger("onPlayEnd")
            };

            if(j.player.isActive||a&&!1===a[0]){
                d()
            }else{
                if(j.current&&(j.current.loop||j.current.index<j.group.length-1)){
                    j.player.isActive=!0,i("body").bind({
                        "afterShow.player onUpdate.player":k,
                        "onCancel.player beforeClose.player":d,
                        "beforeLoad.player":l
                    }),k(),j.trigger("onPlayStart")
                }
            }
        },
        next:function(){
            j.current&&j.jumpto(j.current.index+1)
        },
        prev:function(){
            j.current&&j.jumpto(j.current.index-1)
        },
        jumpto:function(a){
            j.current&&(a=parseInt(a,10),1<j.group.length&&j.current.loop&&(a>=j.group.length?a=0:0>a&&(a=j.group.length-1)),j.group[a]!==r&&(j.cancel(),j._start(a)))
        },
        reposition:function(a,k){
            var d;
            j.isOpen&&(d=j._getPosition(k),a&&"scroll"===a.type?(delete d.position,j.wrap.stop(!0,!0).animate(d,200)):j.wrap.css(d))
        },
        update:function(a){
            j.isOpen&&(p||setTimeout(function(){
                var k=j.current,d=!a||a&&"orientationchange"===a.type;
                if(p&&(p=!1,k)){
                    if(!a||"scroll"!==a.type||d){
                        k.autoSize&&"iframe"!==k.type&&(j.inner.height("auto"),k.height=j.inner.height()),(k.autoResize||d)&&j._setDimension(),k.canGrow&&"iframe"!==k.type&&j.inner.height("auto")
                    }(k.autoCenter||d)&&j.reposition(a);
                    j.trigger("onUpdate")
                }
            },200),p=!0)
        },
        toggle:function(){
            j.isOpen&&(j.current.fitToView=!j.current.fitToView,j.update())
        },
        hideLoading:function(){
            b.unbind("keypress.fb");
            i("#fancybox-loading").remove()
        },
        showLoading:function(){
            j.hideLoading();
            b.bind("keypress.fb",function(a){
                27===a.keyCode&&(a.preventDefault(),j.cancel())
            });
            i('<div id="fancybox-loading"><div></div></div>').click(j.cancel).appendTo("body")
        },
        getViewport:function(){
            return{
                x:f.scrollLeft(),
                y:f.scrollTop(),
                w:h&&v.innerWidth?v.innerWidth:f.width(),
                h:h&&v.innerHeight?v.innerHeight:f.height()
            }
        },
        unbindEvents:function(){
            j.wrap&&j.wrap.unbind(".fb");
            b.unbind(".fb");
            f.unbind(".fb")
        },
        bindEvents:function(){
            var a=j.current,d=a.keys;
            a&&(f.bind("resize.fb orientationchange.fb"+(a.autoCenter&&!a.fixed?" scroll.fb":""),j.update),d&&b.bind("keydown.fb",function(k){
                var l;
                l=k.target||k.srcElement;
                if(!k.ctrlKey&&!k.altKey&&!k.shiftKey&&!k.metaKey&&(!l||!l.type&&!i(l).is("[contenteditable]"))){
                    l=k.keyCode,-1<i.inArray(l,d.close)?(j.close(),k.preventDefault()):-1<i.inArray(l,d.next)?(j.next(),k.preventDefault()):-1<i.inArray(l,d.prev)&&(j.prev(),k.preventDefault())
                }
            }),i.fn.mousewheel&&a.mouseWheel&&1<j.group.length&&j.wrap.bind("mousewheel.fb",function(k,m){
                var l=k.target||null;
                if(0!==m&&(!l||0===l.clientHeight||l.scrollHeight===l.clientHeight&&l.scrollWidth===l.clientWidth)){
                    k.preventDefault(),j[0<m?"prev":"next"]()
                }
            }))
        },
        trigger:function(a,l){
            var k,d=l||j[-1<i.inArray(a,["onCancel","beforeLoad","afterLoad"])?"coming":"current"];
            if(d){
                i.isFunction(d[a])&&(k=d[a].apply(d,Array.prototype.slice.call(arguments,1)));
                if(!1===k){
                    return !1
                }
                d.helpers&&i.each(d.helpers,function(n,m){
                    if(m&&i.isPlainObject(j.helpers[n])&&i.isFunction(j.helpers[n][a])){
                        j.helpers[n][a](m,d)
                    }
                });
                i.event.trigger(a+".fb")
            }
        },
        isImage:function(d){
            return c(d)&&d.match(/\.(jpe?g|gif|png|bmp)((\?|#).*)?$/i)
        },
        isSWF:function(d){
            return c(d)&&d.match(/\.(swf)((\?|#).*)?$/i)
        },
        _start:function(a){
            var n={},m=j.group[a]||null,l,k,d;
            if(m&&(m.nodeType||m instanceof i)){
                l=!0,i.metadata&&(n=i(m).metadata())
            }
            n=i.extend(!0,{},j.opts,{
                index:a,
                element:m
            },i.isPlainObject(m)?m:n);
            i.each(["href","title","content","type"],function(o,q){
                n[q]=j.opts[q]||l&&i(m).attr(q)||n[q]||null
            });
            "number"===typeof n.margin&&(n.margin=[n.margin,n.margin,n.margin,n.margin]);
            n.modal&&i.extend(!0,n,{
                closeBtn:!1,
                closeClick:!1,
                nextClick:!1,
                arrows:!1,
                mouseWheel:!1,
                keys:null,
                helpers:{
                    overlay:{
                        css:{
                            cursor:"auto"
                        },
                        closeClick:!1
                    }
                }
            });
            j.coming=n;
            if(!1===j.trigger("beforeLoad")){
                j.coming=null
            }else{
                k=n.type;
                a=n.href||m;
                k||(l&&(k=i(m).data("fancybox-type"),k||(k=(k=m.className.match(/fancybox\.(\w+)/))?k[1]:null)),!k&&c(a)&&(j.isImage(a)?k="image":j.isSWF(a)?k="swf":a.match(/^#/)&&(k="inline")),k||(k=l?"inline":"html"),n.type=k);
                if("inline"===k||"html"===k){
                    if(n.content||(n.content="inline"===k?i(c(a)?a.replace(/.*(?=#[^\s]+$)/,""):a):m),!n.content||!n.content.length){
                        k=null
                    }
                }else{
                    a||(k=null)
                }
                "ajax"===k&&c(a)&&(d=a.split(/\s+/,2),a=d.shift(),n.selector=d.shift());
                n.href=a;
                n.group=j.group;
                n.isDom=l;
                switch(k){
                    case"image":
                        j._loadImage();
                        break;
                    case"ajax":
                        j._loadAjax();
                        break;
                    case"inline":case"iframe":case"swf":case"html":
                    j._afterLoad();
                    break;
                    default:
                        j._error("type")
                }
            }
        },
        _error:function(a){
            j.hideLoading();
            i.extend(j.coming,{
                type:"html",
                autoSize:!0,
                minWidth:0,
                minHeight:0,
                padding:15,
                hasError:a,
                content:j.coming.tpl.error
            });
            j._afterLoad()
        },
        _loadImage:function(){
            var a=j.imgPreload=new Image;
            a.onload=function(){
                this.onload=this.onerror=null;
                j.coming.width=this.width;
                j.coming.height=this.height;
                j._afterLoad()
            };

            a.onerror=function(){
                this.onload=this.onerror=null;
                j._error("image")
            };

            a.src=j.coming.href;
            (a.complete===r||!a.complete)&&j.showLoading()
        },
        _loadAjax:function(){
            j.showLoading();
            j.ajaxLoad=i.ajax(i.extend({},j.coming.ajax,{
                url:j.coming.href,
                error:function(a,d){
                    j.coming&&"abort"!==d?j._error("ajax",a):j.hideLoading()
                },
                success:function(a,d){
                    "success"===d&&(j.coming.content=a,j._afterLoad())
                }
            }))
        },
        _preloadImages:function(){
            var a=j.group,o=j.current,n=a.length,m,l,d,k=Math.min(o.preload,n-1);
            if(o.preload&&!(2>a.length)){
                for(d=1;d<=k;d+=1){
                    if(m=a[(o.index+d)%n],l=m.href||i(m).attr("href")||m,"image"===m.type||j.isImage(l)){
                        (new Image).src=l
                    }
                }
            }
        },
        _afterLoad:function(){
            j.hideLoading();
            !j.coming||!1===j.trigger("afterLoad",j.current)?j.coming=!1:(j.isOpened?(i(".fancybox-item, .fancybox-nav").remove(),j.wrap.stop(!0).removeClass("fancybox-opened"),j.inner.css("overflow","hidden"),j.transitions[j.current.prevMethod]()):(i(".fancybox-wrap").stop().trigger("onReset").remove(),j.trigger("afterClose")),j.unbindEvents(),j.isOpen=!1,j.current=j.coming,j.wrap=i(j.current.tpl.wrap).addClass("fancybox-"+(h?"mobile":"desktop")+" fancybox-type-"+j.current.type+" fancybox-tmp "+j.current.wrapCSS).appendTo("body"),j.skin=i(".fancybox-skin",j.wrap).css("padding",e(j.current.padding)),j.outer=i(".fancybox-outer",j.wrap),j.inner=i(".fancybox-inner",j.wrap),j._setContent())
        },
        _setContent:function(){
            var a=j.current,o=a.content,n=a.type,m=a.minWidth,l=a.minHeight,d=a.maxWidth,k=a.maxHeight;
            switch(n){
                case"inline":case"ajax":case"html":
                a.selector?o=i("<div>").html(o).find(a.selector):o instanceof i&&(o.parent().hasClass("fancybox-inner")&&o.parents(".fancybox-wrap").unbind("onReset"),o=o.show().detach(),i(j.wrap).bind("onReset",function(){
                    o.appendTo("body").hide()
                }));
                a.autoSize&&(m=i('<div class="fancybox-wrap '+j.current.wrapCSS+' fancybox-tmp"></div>').appendTo("body").css({
                    minWidth:e(m,"w"),
                    minHeight:e(l,"h"),
                    maxWidth:e(d,"w"),
                    maxHeight:e(k,"h")
                }).append(o),a.width=m.width(),a.height=m.height(),m.width(j.current.width),m.height()>a.height&&(m.width(a.width+1),a.width=m.width(),a.height=m.height()),o=m.contents().detach(),m.remove());
                break;
                case"image":
                    o=a.tpl.image.replace("{href}",a.href);
                    a.aspectRatio=!0;
                    break;
                case"swf":
                    o=a.tpl.swf.replace(/\{width\}/g,a.width).replace(/\{height\}/g,a.height).replace(/\{href\}/g,a.href);
                    break;
                case"iframe":
                    o=i(a.tpl.iframe.replace("{rnd}",(new Date).getTime())).attr("scrolling",a.scrolling).attr("src",a.href),a.scrolling=h?"scroll":"auto"
            }
            if("image"===n||"swf"===n){
                a.autoSize=!1,a.scrolling="visible"
            }
            "iframe"===n&&a.autoSize?(j.showLoading(),j._setDimension(),j.inner.css("overflow",a.scrolling),o.bind({
                onCancel:function(){
                    i(this).unbind();
                    j._afterZoomOut()
                },
                load:function(){
                    j.hideLoading();
                    try{
                        this.contentWindow.document.location&&(j.current.height=i(this).contents().find("body").height())
                    }catch(q){
                        j.current.autoSize=!1
                    }
                    j[j.isOpen?"_afterZoomIn":"_beforeShow"]()
                }
            }).appendTo(j.inner)):(j.inner.append(o),j._beforeShow())
        },
        _beforeShow:function(){
            j.coming=null;
            j.trigger("beforeShow");
            j._setDimension();
            j.wrap.hide().removeClass("fancybox-tmp");
            j.bindEvents();
            j._preloadImages();
            j.transitions[j.isOpened?j.current.nextMethod:j.current.openMethod]()
        },
        _setDimension:function(){
            var A=j.wrap,z=j.inner,y=j.current,x=j.getViewport(),w=y.margin,t=2*y.padding,u=y.width,s=y.height,a=y.maxWidth+t,q=y.maxHeight+t,o=y.minWidth+t,n=y.minHeight+t,d;
            x.w-=w[1]+w[3];
            x.h-=w[0]+w[2];
            c(u)&&0<u.indexOf("%")&&(u=(x.w-t)*parseFloat(u)/100);
            c(s)&&0<s.indexOf("%")&&(s=(x.h-t)*parseFloat(s)/100);
            w=u/s;
            u+=t;
            s+=t;
            y.fitToView&&(a=Math.min(x.w,a),q=Math.min(x.h,q));
            if(y.aspectRatio){
                if(u>a&&(u=a,s=(u-t)/w+t),s>q&&(s=q,u=(s-t)*w+t),u<o&&(u=o,s=(u-t)/w+t),s<n){
                    s=n,u=(s-t)*w+t
                }
            }else{
                u=Math.max(o,Math.min(u,a)),s=Math.max(n,Math.min(s,q))
            }
            u=Math.round(u);
            s=Math.round(s);
            i(A.add(z)).width("auto").height("auto");
            z.width(u-t).height(s-t);
            A.width(u);
            d=A.height();
            if(u>a||d>q){
                for(;(u>a||d>q)&&u>o&&d>n;){
                    s-=10,y.aspectRatio?(u=Math.round((s-t)*w+t),u<o&&(u=o,s=(u-t)/w+t)):u-=10,z.width(u-t).height(s-t),A.width(u),d=A.height()
                }
            }
            y.dim={
                width:e(u),
                height:e(d)
            };

            y.canGrow=y.autoSize&&s>n&&s<q;
            y.canShrink=!1;
            y.canExpand=!1;
            if(u-t<y.width||s-t<y.height){
                y.canExpand=!0
            }else{
                if((u>x.w||d>x.h)&&u>o&&s>n){
                    y.canShrink=!0
                }
            }
            j.innerSpace=d-t-z.height()
        },
        _getPosition:function(a){
            var q=j.current,n=j.getViewport(),m=q.margin,o=j.wrap.width()+m[1]+m[3],k=j.wrap.height()+m[0]+m[2],l={
                position:"absolute",
                top:m[0]+n.y,
                left:m[3]+n.x
            };

            q.autoCenter&&q.fixed&&!a&&k<=n.h&&o<=n.w&&(l={
                position:"fixed",
                top:m[0],
                left:m[3]
            });
            l.top=e(Math.max(l.top,l.top+(n.h-k)*q.topRatio));
            l.left=e(Math.max(l.left,l.left+0.5*(n.w-o)));
            return l
        },
        _afterZoomIn:function(){
            var a=j.current,d=a?a.scrolling:"no";
            if(a&&(j.isOpen=j.isOpened=!0,j.wrap.addClass("fancybox-opened"),j.inner.css("overflow","yes"===d?"scroll":"no"===d?"hidden":d),j.trigger("afterShow"),j.update(),(a.closeClick||a.nextClick)&&j.inner.css("cursor","pointer").bind("click.fb",function(k){
                if(!i(k.target).is("a")&&!i(k.target).parent().is("a")){
                    j[a.closeClick?"close":"next"]()
                }
            }),a.closeBtn&&i(a.tpl.closeBtn).appendTo(j.skin).bind("click.fb",j.close),a.arrows&&1<j.group.length&&((a.loop||0<a.index)&&i(a.tpl.prev).appendTo(j.outer).bind("click.fb",j.prev),(a.loop||a.index<j.group.length-1)&&i(a.tpl.next).appendTo(j.outer).bind("click.fb",j.next)),j.opts.autoPlay&&!j.player.isActive)){
                j.opts.autoPlay=!1,j.play()
            }
        },
        _afterZoomOut:function(){
            var a=j.current;
            j.wrap.trigger("onReset").remove();
            i.extend(j,{
                group:{},
                opts:{},
                current:null,
                isActive:!1,
                isOpened:!1,
                isOpen:!1,
                wrap:null,
                skin:null,
                outer:null,
                inner:null
            });
            j.trigger("afterClose",a)
        }
    });
    j.transitions={
        getOrigPosition:function(){
            var a=j.current,o=a.element,n=a.padding,m=i(a.orig),l={},d=50,k=50;
            !m.length&&a.isDom&&i(o).is(":visible")&&(m=i(o).find("img:first"),m.length||(m=i(o)));
            m.length?(l=m.offset(),m.is("img")&&(d=m.outerWidth(),k=m.outerHeight())):(a=j.getViewport(),l.top=a.y+0.5*(a.h-k),l.left=a.x+0.5*(a.w-d));
            return l={
                top:e(l.top-n),
                left:e(l.left-n),
                width:e(d+2*n),
                height:e(k+2*n)
            }
        },
        step:function(a,n){
            var l=n.prop,m,k;
            if("width"===l||"height"===l){
                m=Math.ceil(a-2*j.current.padding),"height"===l&&(k=(a-n.start)/(n.end-n.start),n.start>n.end&&(k=1-k),m-=j.innerSpace*k),j.inner[l](m)
            }
        },
        zoomIn:function(){
            var a=j.wrap,n=j.current,m=n.openEffect,l="elastic"===m,k=i.extend({},n.dim,j._getPosition(l)),d=i.extend({
                opacity:1
            },k);
            delete d.position;
            l?(k=this.getOrigPosition(),n.openOpacity&&(k.opacity=0),j.outer.add(j.inner).width("auto").height("auto")):"fade"===m&&(k.opacity=0);
            a.css(k).show().animate(d,{
                duration:"none"===m?0:n.openSpeed,
                easing:n.openEasing,
                step:l?this.step:null,
                complete:j._afterZoomIn
            })
        },
        zoomOut:function(){
            var a=j.wrap,n=j.current,m=n.openEffect,l="elastic"===m,k={
                opacity:0
            };

            l&&("fixed"===a.css("position")&&a.css(j._getPosition(!0)),k=this.getOrigPosition(),n.closeOpacity&&(k.opacity=0));
            a.animate(k,{
                duration:"none"===m?0:n.closeSpeed,
                easing:n.closeEasing,
                step:l?this.step:null,
                complete:j._afterZoomOut
            })
        },
        changeIn:function(){
            var a=j.wrap,o=j.current,n=o.nextEffect,m="elastic"===n,l=j._getPosition(m),k={
                opacity:1
            };

            l.opacity=0;
            m&&(l.top=e(parseInt(l.top,10)-200),k.top="+=200px");
            a.css(l).show().animate(k,{
                duration:"none"===n?0:o.nextSpeed,
                easing:o.nextEasing,
                complete:j._afterZoomIn
            })
        },
        changeOut:function(){
            var a=j.wrap,l=j.current,k=l.prevEffect,d={
                opacity:0
            };

            a.removeClass("fancybox-opened");
            "elastic"===k&&(d.top="+=200px");
            a.animate(d,{
                duration:"none"===k?0:l.prevSpeed,
                easing:l.prevEasing,
                complete:function(){
                    i(this).trigger("onReset").remove()
                }
            })
        }
    };

    j.helpers.overlay={
        overlay:null,
        update:function(){
            var d,k;
            this.overlay.width("100%").height("100%");
            i.browser.msie||h?(d=Math.max(g.documentElement.scrollWidth,g.body.scrollWidth),k=Math.max(g.documentElement.offsetWidth,g.body.offsetWidth),d=d<k?f.width():d):d=b.width();
            this.overlay.width(d).height(b.height())
        },
        beforeShow:function(a){
            this.overlay||(a=i.extend(!0,{},j.defaults.helpers.overlay,a),this.overlay=i('<div id="fancybox-overlay"></div>').css(a.css).appendTo("body"),a.closeClick&&this.overlay.bind("click.fb",j.close),j.current.fixed&&!h?this.overlay.addClass("overlay-fixed"):(this.update(),this.onUpdate=function(){
                this.update()
            }),this.overlay.fadeTo(a.speedIn,a.opacity))
        },
        afterClose:function(d){
            this.overlay&&this.overlay.fadeOut(d.speedOut||0,function(){
                i(this).remove()
            });
            this.overlay=null
        }
    };

    j.helpers.title={
        beforeShow:function(a){
            var d;
            if(d=j.current.title){
                d=i('<div class="fancybox-title fancybox-title-'+a.type+'-wrap">'+d+"</div>").appendTo("body"),"float"===a.type&&(d.width(d.width()),d.wrapInner('<span class="child"></span>'),j.current.margin[2]+=Math.abs(parseInt(d.css("margin-bottom"),10))),d.appendTo("over"===a.type?j.inner:"outside"===a.type?j.wrap:j.skin)
            }
        }
    };

    i.fn.fancybox=function(a){
        var m=i(this),l=this.selector||"",k,d=function(s){
            var q=this,o=k,n;
            !s.ctrlKey&&!s.altKey&&!s.shiftKey&&!s.metaKey&&!i(q).is(".fancybox-wrap")&&(s.preventDefault(),s=a.groupAttr||"data-fancybox-group",n=i(q).attr(s),n||(s="rel",n=q[s]),n&&""!==n&&"nofollow"!==n&&(q=l.length?i(l):m,q=q.filter("["+s+'="'+n+'"]'),o=q.index(this)),a.index=o,j.open(q,a))
        },a=a||{};

        k=a.index||0;
        l?b.undelegate(l,"click.fb-start").delegate(l,"click.fb-start",d):m.unbind("click.fb-start").bind("click.fb-start",d);
        return this
    };

    i(g).ready(function(){
        j.defaults.fixed=i.support.fixedPosition||!(i.browser.msie&&6>=i.browser.version)&&!h
    })
})(window,document,jQuery);
/* jquery.template.js */
(function(a){
    var r=a.fn.domManip,d="_tmplitem",q=/^[^<]*(<[\w\W]+>)[^>]*$|\{\{\! /,b={},f={},e,p={
        key:0,
        data:{}
    },h=0,c=0,l=[];
    function g(e,d,g,i){
        var c={
            data:i||(d?d.data:{}),
            _wrap:d?d._wrap:null,
            tmpl:null,
            parent:d||null,
            nodes:[],
            calls:u,
            nest:w,
            wrap:x,
            html:v,
            update:t
        };

        e&&a.extend(c,e,{
            nodes:[],
            parent:d
        });
        if(g){
            c.tmpl=g;
            c._ctnt=c._ctnt||c.tmpl(a,c);
            c.key=++h;
            (l.length?f:b)[h]=c
        }
        return c
    }
    a.each({
        appendTo:"append",
        prependTo:"prepend",
        insertBefore:"before",
        insertAfter:"after",
        replaceAll:"replaceWith"
    },function(f,d){
        a.fn[f]=function(n){
            var g=[],i=a(n),k,h,m,l,j=this.length===1&&this[0].parentNode;
            e=b||{};

            if(j&&j.nodeType===11&&j.childNodes.length===1&&i.length===1){
                i[d](this[0]);
                g=this
            }else{
                for(h=0,m=i.length;h<m;h++){
                    c=h;
                    k=(h>0?this.clone(true):this).get();
                    a.fn[d].apply(a(i[h]),k);
                    g=g.concat(k)
                }
                c=0;
                g=this.pushStack(g,f,i.selector)
            }
            l=e;
            e=null;
            a.tmpl.complete(l);
            return g
        }
    });
    a.fn.extend({
        tmpl:function(d,c,b){
            return a.tmpl(this[0],d,c,b)
        },
        tmplItem:function(){
            return a.tmplItem(this[0])
        },
        template:function(b){
            return a.template(b,this[0])
        },
        domManip:function(d,l,j){
            if(d[0]&&d[0].nodeType){
                var f=a.makeArray(arguments),g=d.length,i=0,h;
                while(i<g&&!(h=a.data(d[i++],"tmplItem")));
                if(g>1)f[0]=[a.makeArray(d)];
                if(h&&c)f[2]=function(b){
                    a.tmpl.afterManip(this,b,j)
                };

                r.apply(this,f)
            }else r.apply(this,arguments);
            c=0;
            !e&&a.tmpl.complete(b);
            return this
        }
    });
    a.extend({
        tmpl:function(d,h,e,c){
            var j,k=!c;
            if(k){
                c=p;
                d=a.template[d]||a.template(null,d);
                f={}
            }else if(!d){
                d=c.tmpl;
                b[c.key]=c;
                c.nodes=[];
                c.wrapped&&n(c,c.wrapped);
                return a(i(c,null,c.tmpl(a,c)))
            }
            if(!d)return[];
            if(typeof h==="function")h=h.call(c||{});
            e&&e.wrapped&&n(e,e.wrapped);
            j=a.isArray(h)?a.map(h,function(a){
                return a?g(e,c,d,a):null
            }):[g(e,c,d,h)];
            return k?a(i(c,null,j)):j
        },
        tmplItem:function(b){
            var c;
            if(b instanceof a)b=b[0];
            while(b&&b.nodeType===1&&!(c=a.data(b,"tmplItem"))&&(b=b.parentNode));
            return c||p
        },
        template:function(c,b){
            if(b){
                if(typeof b==="string")b=o(b);
                else if(b instanceof a)b=b[0]||{};

                if(b.nodeType)b=a.data(b,"tmpl")||a.data(b,"tmpl",o(b.innerHTML));
                return typeof c==="string"?(a.template[c]=b):b
            }
            return c?typeof c!=="string"?a.template(null,c):a.template[c]||a.template(null,q.test(c)?c:a(c)):null
        },
        encode:function(a){
            return(""+a).split("<").join("&lt;").split(">").join("&gt;").split('"').join("&#34;").split("'").join("&#39;")
        }
    });
    a.extend(a.tmpl,{
        tag:{
            tmpl:{
                _default:{
                    $2:"null"
                },
                open:"if($notnull_1){_=_.concat($item.nest($1,$2));}"
            },
            wrap:{
                _default:{
                    $2:"null"
                },
                open:"$item.calls(_,$1,$2);_=[];",
                close:"call=$item.calls();_=call._.concat($item.wrap(call,_));"
            },
            each:{
                _default:{
                    $2:"$index, $value"
                },
                open:"if($notnull_1){$.each($1a,function($2){with(this){",
                close:"}});}"
            },
            "if":{
                open:"if(($notnull_1) && $1a){",
                close:"}"
            },
            "else":{
                _default:{
                    $1:"true"
                },
                open:"}else if(($notnull_1) && $1a){"
            },
            html:{
                open:"if($notnull_1){_.push($1a);}"
            },
            "=":{
                _default:{
                    $1:"$data"
                },
                open:"if($notnull_1){_.push($.encode($1a));}"
            },
            "!":{
                open:""
            }
        },
        complete:function(){
            b={}
        },
        afterManip:function(f,b,d){
            var e=b.nodeType===11?a.makeArray(b.childNodes):b.nodeType===1?[b]:[];
            d.call(f,b);
            m(e);
            c++
        }
    });
    function i(e,g,f){
        var b,c=f?a.map(f,function(a){
            return typeof a==="string"?e.key?a.replace(/(<\w+)(?=[\s>])(?![^>]*_tmplitem)([^>]*)/g,"$1 "+d+'="'+e.key+'" $2'):a:i(a,e,a._ctnt)
        }):e;
        if(g)return c;
        c=c.join("");
        c.replace(/^\s*([^<\s][^<]*)?(<[\w\W]+>)([^>]*[^>\s])?\s*$/,function(f,c,e,d){
            b=a(e).get();
            m(b);
            if(c)b=j(c).concat(b);
            if(d)b=b.concat(j(d))
        });
        return b?b:j(c)
    }
    function j(c){
        var b=document.createElement("div");
        b.innerHTML=c;
        return a.makeArray(b.childNodes)
    }
    function o(b){
        return new Function("jQuery","$item","var $=jQuery,call,_=[],$data=$item.data;with($data){_.push('"+a.trim(b).replace(/([\\'])/g,"\\$1").replace(/[\r\t\n]/g," ").replace(/\$\{([^\}]*)\}/g,"{{= $1}}").replace(/\{\{(\/?)(\w+|.)(?:\(((?:[^\}]|\}(?!\}))*?)?\))?(?:\s+(.*?)?)?(\(((?:[^\}]|\}(?!\}))*?)\))?\s*\}\}/g,function(m,l,j,d,b,c,e){
            var i=a.tmpl.tag[j],h,f,g;
            if(!i)throw"Template command not found: "+j;
            h=i._default||[];
            if(c&&!/\w$/.test(b)){
                b+=c;
                c=""
            }
            if(b){
                b=k(b);
                e=e?","+k(e)+")":c?")":"";
                f=c?b.indexOf(".")>-1?b+c:"("+b+").call($item"+e:b;
                g=c?f:"(typeof("+b+")==='function'?("+b+").call($item):("+b+"))"
            }else g=f=h.$1||"null";
            d=k(d);
            return"');"+i[l?"close":"open"].split("$notnull_1").join(b?"typeof("+b+")!=='undefined' && ("+b+")!=null":"true").split("$1a").join(g).split("$1").join(f).split("$2").join(d?d.replace(/\s*([^\(]+)\s*(\((.*?)\))?/g,function(d,c,b,a){
                a=a?","+a+")":b?")":"";
                return a?"("+c+").call($item"+a:d
            }):h.$2||"")+"_.push('"
        })+"');}return _;")
    }
    function n(c,b){
        c._wrap=i(c,true,a.isArray(b)?b:[q.test(b)?b:a(b).html()]).join("")
    }
    function k(a){
        return a?a.replace(/\\'/g,"'").replace(/\\\\/g,"\\"):null
    }
    function s(b){
        var a=document.createElement("div");
        a.appendChild(b.cloneNode(true));
        return a.innerHTML
    }
    function m(o){
        var n="_"+c,k,j,l={},e,p,i;
        for(e=0,p=o.length;e<p;e++){
            if((k=o[e]).nodeType!==1)continue;
            j=k.getElementsByTagName("*");
            for(i=j.length-1;i>=0;i--)m(j[i]);
            m(k)
        }
        function m(j){
            var p,i=j,k,e,m;
            if(m=j.getAttribute(d)){
                while(i.parentNode&&(i=i.parentNode).nodeType===1&&!(p=i.getAttribute(d)));
                if(p!==m){
                    i=i.parentNode?i.nodeType===11?0:i.getAttribute(d)||0:0;
                    if(!(e=b[m])){
                        e=f[m];
                        e=g(e,b[i]||f[i],null,true);
                        e.key=++h;
                        b[h]=e
                    }
                    c&&o(m)
                }
                j.removeAttribute(d)
            }else if(c&&(e=a.data(j,"tmplItem"))){
                o(e.key);
                b[e.key]=e;
                i=a.data(j.parentNode,"tmplItem");
                i=i?i.key:0
            }
            if(e){
                k=e;
                while(k&&k.key!=i){
                    k.nodes.push(j);
                    k=k.parent
                }
                delete e._ctnt;
                delete e._wrap;
                a.data(j,"tmplItem",e)
            }
            function o(a){
                a=a+n;
                e=l[a]=l[a]||g(e,b[e.parent.key+n]||e.parent,null,true)
            }
        }
    }
    function u(a,d,c,b){
        if(!a)return l.pop();
        l.push({
            _:a,
            tmpl:d,
            item:this,
            data:c,
            options:b
        })
    }
    function w(d,c,b){
        return a.tmpl(a.template(d),c,b,this)
    }
    function x(b,d){
        var c=b.options||{};

        c.wrapped=d;
        return a.tmpl(a.template(b.tmpl),b.data,c,b.item)
    }
    function v(d,c){
        var b=this._wrap;
        return a.map(a(a.isArray(b)?b.join(""):b).filter(d||"*"),function(a){
            return c?a.innerText||a.textContent:a.outerHTML||s(a)
        })
    }
    function t(){
        var b=this.nodes;
        a.tmpl(null,null,null,this).insertBefore(b[0]);
        a(b).remove()
    }
})(jQuery);

/* jquery.bxslider.min-v4.js */
(function(e){
    var t={},n={
        mode:"horizontal",
        slideSelector:"",
        infiniteLoop:!0,
        hideControlOnEnd:!1,
        speed:500,
        easing:null,
        slideMargin:0,
        startSlide:0,
        randomStart:!1,
        captions:!1,
        ticker:!1,
        tickerHover:!1,
        adaptiveHeight:!1,
        adaptiveHeightSpeed:500,
        video:!1,
        useCSS:!0,
        preloadImages:"visible",
        touchEnabled:!0,
        swipeThreshold:50,
        oneToOneTouch:!0,
        preventDefaultSwipeX:!0,
        preventDefaultSwipeY:!1,
        pager:!0,
        pagerType:"full",
        pagerShortSeparator:" / ",
        pagerSelector:null,
        buildPager:null,
        pagerCustom:null,
        controls:!0,
        nextText:"Next",
        prevText:"Prev",
        nextSelector:null,
        prevSelector:null,
        autoControls:!1,
        startText:"Start",
        stopText:"Stop",
        autoControlsCombine:!1,
        autoControlsSelector:null,
        auto:!1,
        pause:4e3,
        autoStart:!0,
        autoDirection:"next",
        autoHover:!1,
        autoDelay:0,
        minSlides:1,
        maxSlides:1,
        moveSlides:0,
        slideWidth:0,
        onSliderLoad:function(){},
        onSlideBefore:function(){},
        onSlideAfter:function(){},
        onSlideNext:function(){},
        onSlidePrev:function(){}
    };

    e.fn.bxSlider=function(s){
        if(0==this.length)return this;
        if(this.length>1)return this.each(function(){
            e(this).bxSlider(s)
        }),this;
        var o={},r=this;
        t.el=this;
        var a=e(window).width(),l=e(window).height(),d=function(){
            o.settings=e.extend({},n,s),o.settings.slideWidth=parseInt(o.settings.slideWidth),o.children=r.children(o.settings.slideSelector),o.children.length<o.settings.minSlides&&(o.settings.minSlides=o.children.length),o.children.length<o.settings.maxSlides&&(o.settings.maxSlides=o.children.length),o.settings.randomStart&&(o.settings.startSlide=Math.floor(Math.random()*o.children.length)),o.active={
                index:o.settings.startSlide
            },o.carousel=o.settings.minSlides>1||o.settings.maxSlides>1,o.carousel&&(o.settings.preloadImages="all"),o.minThreshold=o.settings.minSlides*o.settings.slideWidth+(o.settings.minSlides-1)*o.settings.slideMargin,o.maxThreshold=o.settings.maxSlides*o.settings.slideWidth+(o.settings.maxSlides-1)*o.settings.slideMargin,o.working=!1,o.controls={},o.interval=null,o.animProp="vertical"==o.settings.mode?"top":"left",o.usingCSS=o.settings.useCSS&&"fade"!=o.settings.mode&&function(){
                var e=document.createElement("div"),t=["WebkitPerspective","MozPerspective","OPerspective","msPerspective"];
                for(var i in t)if(void 0!==e.style[t[i]])return o.cssPrefix=t[i].replace("Perspective","").toLowerCase(),o.animProp="-"+o.cssPrefix+"-transform",!0;return!1
            }(),"vertical"==o.settings.mode&&(o.settings.maxSlides=o.settings.minSlides),c()
        },c=function(){
            if(r.wrap('<div class="bx-wrapper"><div class="bx-viewport"></div></div>'),o.viewport=r.parent(),o.loader=e('<div class="bx-loading" />'),o.viewport.prepend(o.loader),r.css({
                width:"horizontal"==o.settings.mode?215*o.children.length+"%":"auto",
                position:"relative"
            }),o.usingCSS&&o.settings.easing?r.css("-"+o.cssPrefix+"-transition-timing-function",o.settings.easing):o.settings.easing||(o.settings.easing="swing"),v(),o.viewport.css({
                width:"100%",
                overflow:"hidden",
                position:"relative"
            }),o.viewport.parent().css({
                maxWidth:u()
            }),o.children.css({
                "float":"horizontal"==o.settings.mode?"left":"none",
                listStyle:"none",
                position:"relative"
            }),o.children.width(p()),"horizontal"==o.settings.mode&&o.settings.slideMargin>0&&o.children.css("marginRight",o.settings.slideMargin),"vertical"==o.settings.mode&&o.settings.slideMargin>0&&o.children.css("marginBottom",o.settings.slideMargin),"fade"==o.settings.mode&&(o.children.css({
                position:"absolute",
                zIndex:0,
                display:"none"
            }),o.children.eq(o.settings.startSlide).css({
                zIndex:50,
                display:"block"
            })),o.controls.el=e('<div class="bx-controls" />'),o.settings.captions&&E(),o.settings.infiniteLoop&&"fade"!=o.settings.mode&&!o.settings.ticker){
                var t="vertical"==o.settings.mode?o.settings.minSlides:o.settings.maxSlides,i=o.children.slice(0,t).clone().addClass("bx-clone"),n=o.children.slice(-t).clone().addClass("bx-clone");
                r.append(i).prepend(n)
            }
            o.active.last=o.settings.startSlide==f()-1,o.settings.video&&r.fitVids();
            var s=o.children.eq(o.settings.startSlide);
            "all"==o.settings.preloadImages&&(s=r.children()),o.settings.ticker?o.settings.pager=!1:(o.settings.pager&&w(),o.settings.controls&&T(),o.settings.auto&&o.settings.autoControls&&C(),(o.settings.controls||o.settings.autoControls||o.settings.pager)&&o.viewport.after(o.controls.el)),s.imagesLoaded(g)
        },g=function(){
            o.loader.remove(),m(),"vertical"==o.settings.mode&&(o.settings.adaptiveHeight=!0),o.viewport.height(h()),r.redrawSlider(),o.settings.onSliderLoad(o.active.index),o.initialized=!0,e(window).bind("resize",Y),o.settings.auto&&o.settings.autoStart&&L(),o.settings.ticker&&W(),o.settings.pager&&M(o.settings.startSlide),o.settings.controls&&D(),o.settings.touchEnabled&&!o.settings.ticker&&O()
        },h=function(){
            var t=0,n=e();
            if("vertical"==o.settings.mode||o.settings.adaptiveHeight)if(o.carousel){
                var s=1==o.settings.moveSlides?o.active.index:o.active.index*x();
                for(n=o.children.eq(s),i=1;o.settings.maxSlides-1>=i;i++)n=s+i>=o.children.length?n.add(o.children.eq(i-1)):n.add(o.children.eq(s+i))
            }else n=o.children.eq(o.active.index);else n=o.children;
            return"vertical"==o.settings.mode?(n.each(function(){
                t+=e(this).outerHeight()
            }),o.settings.slideMargin>0&&(t+=o.settings.slideMargin*(o.settings.minSlides-1))):t=Math.max.apply(Math,n.map(function(){
                return e(this).outerHeight(!1)
            }).get()),t
        },u=function(){
            var e="100%";
            return o.settings.slideWidth>0&&(e="horizontal"==o.settings.mode?o.settings.maxSlides*o.settings.slideWidth+(o.settings.maxSlides-1)*o.settings.slideMargin:o.settings.slideWidth),e
        },p=function(){
            var e=o.settings.slideWidth,t=o.viewport.width();
            return 0==o.settings.slideWidth||o.settings.slideWidth>t&&!o.carousel||"vertical"==o.settings.mode?e=t:o.settings.maxSlides>1&&"horizontal"==o.settings.mode&&(t>o.maxThreshold||o.minThreshold>t&&(e=(t-o.settings.slideMargin*(o.settings.minSlides-1))/o.settings.minSlides)),e
        },v=function(){
            var e=1;
            if("horizontal"==o.settings.mode&&o.settings.slideWidth>0)if(o.viewport.width()<o.minThreshold)e=o.settings.minSlides;
            else if(o.viewport.width()>o.maxThreshold)e=o.settings.maxSlides;
            else{
                var t=o.children.first().width();
                e=Math.floor(o.viewport.width()/t)
            }else"vertical"==o.settings.mode&&(e=o.settings.minSlides);
            return e
        },f=function(){
            var e=0;
            if(o.settings.moveSlides>0)if(o.settings.infiniteLoop)e=o.children.length/x();else for(var t=0,i=0;o.children.length>t;)++e,t=i+v(),i+=o.settings.moveSlides<=v()?o.settings.moveSlides:v();else e=Math.ceil(o.children.length/v());
            return e
        },x=function(){
            return o.settings.moveSlides>0&&o.settings.moveSlides<=v()?o.settings.moveSlides:v()
        },m=function(){
            if(o.children.length>o.settings.maxSlides&&o.active.last&&!o.settings.infiniteLoop){
                if("horizontal"==o.settings.mode){
                    var e=o.children.last(),t=e.position();
                    S(-(t.left-(o.viewport.width()-e.width())),"reset",0)
                }else if("vertical"==o.settings.mode){
                    var i=o.children.length-o.settings.minSlides,t=o.children.eq(i).position();
                    S(-t.top,"reset",0)
                }
            }else{
                var t=o.children.eq(o.active.index*x()).position();
                o.active.index==f()-1&&(o.active.last=!0),void 0!=t&&("horizontal"==o.settings.mode?S(-t.left,"reset",0):"vertical"==o.settings.mode&&S(-t.top,"reset",0))
            }
        },S=function(e,t,i,n){
            if(o.usingCSS){
                var s="vertical"==o.settings.mode?"translate3d(0, "+e+"px, 0)":"translate3d("+e+"px, 0, 0)";
                r.css("-"+o.cssPrefix+"-transition-duration",i/1e3+"s"),"slide"==t?(r.css(o.animProp,s),r.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",function(){
                    r.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"),I()
                })):"reset"==t?r.css(o.animProp,s):"ticker"==t&&(r.css("-"+o.cssPrefix+"-transition-timing-function","linear"),r.css(o.animProp,s),r.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",function(){
                    r.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"),S(n.resetValue,"reset",0),H()
                }))
            }else{
                var a={};

                a[o.animProp]=e,"slide"==t?r.animate(a,i,o.settings.easing,function(){
                    I()
                }):"reset"==t?r.css(o.animProp,e):"ticker"==t&&r.animate(a,speed,"linear",function(){
                    S(n.resetValue,"reset",0),H()
                })
            }
        },b=function(){
            for(var t="",i=f(),n=0;i>n;n++){
                var s="";
                o.settings.buildPager&&e.isFunction(o.settings.buildPager)?(s=o.settings.buildPager(n),o.pagerEl.addClass("bx-custom-pager")):(s=n+1,o.pagerEl.addClass("bx-default-pager")),t+='<div class="bx-pager-item"><a href="" data-slide-index="'+n+'" class="bx-pager-link">'+s+"</a></div>"
            }
            o.pagerEl.html(t)
        },w=function(){
            o.settings.pagerCustom?o.pagerEl=e(o.settings.pagerCustom):(o.pagerEl=e('<div class="bx-pager" />'),o.settings.pagerSelector?e(o.settings.pagerSelector).html(o.pagerEl):o.controls.el.addClass("bx-has-pager").append(o.pagerEl),b()),o.pagerEl.delegate("a","click",z)
        },T=function(){
            o.controls.next=e('<a class="bx-next" href="">'+o.settings.nextText+"</a>"),o.controls.prev=e('<a class="bx-prev" href="">'+o.settings.prevText+"</a>"),o.controls.next.bind("click",A),o.controls.prev.bind("click",P),o.settings.nextSelector&&e(o.settings.nextSelector).append(o.controls.next),o.settings.prevSelector&&e(o.settings.prevSelector).append(o.controls.prev),o.settings.nextSelector||o.settings.prevSelector||(o.controls.directionEl=e('<div class="bx-controls-direction" />'),o.controls.directionEl.append(o.controls.prev).append(o.controls.next),o.controls.el.addClass("bx-has-controls-direction").append(o.controls.directionEl))
        },C=function(){
            o.controls.start=e('<div class="bx-controls-auto-item"><a class="bx-start" href="">'+o.settings.startText+"</a></div>"),o.controls.stop=e('<div class="bx-controls-auto-item"><a class="bx-stop" href="">'+o.settings.stopText+"</a></div>"),o.controls.autoEl=e('<div class="bx-controls-auto" />'),o.controls.autoEl.delegate(".bx-start","click",k),o.controls.autoEl.delegate(".bx-stop","click",y),o.settings.autoControlsCombine?o.controls.autoEl.append(o.controls.start):o.controls.autoEl.append(o.controls.start).append(o.controls.stop),o.settings.autoControlsSelector?e(o.settings.autoControlsSelector).html(o.controls.autoEl):o.controls.el.addClass("bx-has-controls-auto").append(o.controls.autoEl),q(o.settings.autoStart?"stop":"start")
        },E=function(){
            o.children.each(function(){
                var t=e(this).find("img:first").attr("title");
                void 0!=t&&e(this).append('<div class="bx-caption"><span>'+t+"</span></div>")
            })
        },A=function(e){
            o.settings.auto&&r.stopAuto(),r.goToNextSlide(),e.preventDefault()
        },P=function(e){
            o.settings.auto&&r.stopAuto(),r.goToPrevSlide(),e.preventDefault()
        },k=function(e){
            r.startAuto(),e.preventDefault()
        },y=function(e){
            r.stopAuto(),e.preventDefault()
        },z=function(t){
            o.settings.auto&&r.stopAuto();
            var i=e(t.currentTarget),n=parseInt(i.attr("data-slide-index"));
            n!=o.active.index&&r.goToSlide(n),t.preventDefault()
        },M=function(t){
            return"short"==o.settings.pagerType?(o.pagerEl.html(t+1+o.settings.pagerShortSeparator+o.children.length),void 0):(o.pagerEl.find("a").removeClass("active"),o.pagerEl.each(function(i,n){
                e(n).find("a").eq(t).addClass("active")
            }),void 0)
        },I=function(){
            if(o.settings.infiniteLoop){
                var e="";
                0==o.active.index?e=o.children.eq(0).position():o.active.index==f()-1&&o.carousel?e=o.children.eq((f()-1)*x()).position():o.active.index==o.children.length-1&&(e=o.children.eq(o.children.length-1).position()),"horizontal"==o.settings.mode?S(-e.left,"reset",0):"vertical"==o.settings.mode&&S(-e.top,"reset",0)
            }
            o.working=!1,o.settings.onSlideAfter(o.children.eq(o.active.index),o.oldIndex,o.active.index)
        },q=function(e){
            o.settings.autoControlsCombine?o.controls.autoEl.html(o.controls[e]):(o.controls.autoEl.find("a").removeClass("active"),o.controls.autoEl.find("a:not(.bx-"+e+")").addClass("active"))
        },D=function(){
            1==f()?(o.controls.prev.addClass("disabled"),o.controls.next.addClass("disabled")):!o.settings.infiniteLoop&&o.settings.hideControlOnEnd&&(0==o.active.index?(o.controls.prev.addClass("disabled"),o.controls.next.removeClass("disabled")):o.active.index==f()-1?(o.controls.next.addClass("disabled"),o.controls.prev.removeClass("disabled")):(o.controls.prev.removeClass("disabled"),o.controls.next.removeClass("disabled")))
        },L=function(){
            o.settings.autoDelay>0?setTimeout(r.startAuto,o.settings.autoDelay):r.startAuto(),o.settings.autoHover&&r.hover(function(){
                o.interval&&(r.stopAuto(!0),o.autoPaused=!0)
            },function(){
                o.autoPaused&&(r.startAuto(!0),o.autoPaused=null)
            })
        },W=function(){
            var t=0;
            if("next"==o.settings.autoDirection)r.append(o.children.clone().addClass("bx-clone"));
            else{
                r.prepend(o.children.clone().addClass("bx-clone"));
                var i=o.children.first().position();
                t="horizontal"==o.settings.mode?-i.left:-i.top
            }
            S(t,"reset",0),o.settings.pager=!1,o.settings.controls=!1,o.settings.autoControls=!1,o.settings.tickerHover&&!o.usingCSS&&o.viewport.hover(function(){
                r.stop()
            },function(){
                var t=0;
                o.children.each(function(){
                    t+="horizontal"==o.settings.mode?e(this).outerWidth(!0):e(this).outerHeight(!0)
                });
                var i=o.settings.speed/t,n="horizontal"==o.settings.mode?"left":"top",s=i*(t-Math.abs(parseInt(r.css(n))));
                H(s)
            }),H()
        },H=function(e){
            speed=e?e:o.settings.speed;
            var t={
                left:0,
                top:0
            },i={
                left:0,
                top:0
            };

            "next"==o.settings.autoDirection?t=r.find(".bx-clone").first().position():i=o.children.first().position();
            var n="horizontal"==o.settings.mode?-t.left:-t.top,s="horizontal"==o.settings.mode?-i.left:-i.top,a={
                resetValue:s
            };

            S(n,"ticker",speed,a)
        },O=function(){
            o.touch={
                start:{
                    x:0,
                    y:0
                },
                end:{
                    x:0,
                    y:0
                }
            },o.viewport.bind("touchstart",N)
        },N=function(e){
            if(o.working)e.preventDefault();
            else{
                o.touch.originalPos=r.position();
                var t=e.originalEvent;
                o.touch.start.x=t.changedTouches[0].pageX,o.touch.start.y=t.changedTouches[0].pageY,o.viewport.bind("touchmove",B),o.viewport.bind("touchend",X)
            }
        },B=function(e){
            var t=e.originalEvent,i=Math.abs(t.changedTouches[0].pageX-o.touch.start.x),n=Math.abs(t.changedTouches[0].pageY-o.touch.start.y);
            if(3*i>n&&o.settings.preventDefaultSwipeX?e.preventDefault():3*n>i&&o.settings.preventDefaultSwipeY&&e.preventDefault(),"fade"!=o.settings.mode&&o.settings.oneToOneTouch){
                var s=0;
                if("horizontal"==o.settings.mode){
                    var r=t.changedTouches[0].pageX-o.touch.start.x;
                    s=o.touch.originalPos.left+r
                }else{
                    var r=t.changedTouches[0].pageY-o.touch.start.y;
                    s=o.touch.originalPos.top+r
                }
                S(s,"reset",0)
            }
        },X=function(e){
            o.viewport.unbind("touchmove",B);
            var t=e.originalEvent,i=0;
            if(o.touch.end.x=t.changedTouches[0].pageX,o.touch.end.y=t.changedTouches[0].pageY,"fade"==o.settings.mode){
                var n=Math.abs(o.touch.start.x-o.touch.end.x);
                n>=o.settings.swipeThreshold&&(o.touch.start.x>o.touch.end.x?r.goToNextSlide():r.goToPrevSlide(),r.stopAuto())
            }else{
                var n=0;
                "horizontal"==o.settings.mode?(n=o.touch.end.x-o.touch.start.x,i=o.touch.originalPos.left):(n=o.touch.end.y-o.touch.start.y,i=o.touch.originalPos.top),!o.settings.infiniteLoop&&(0==o.active.index&&n>0||o.active.last&&0>n)?S(i,"reset",200):Math.abs(n)>=o.settings.swipeThreshold?(0>n?r.goToNextSlide():r.goToPrevSlide(),r.stopAuto()):S(i,"reset",200)
            }
            o.viewport.unbind("touchend",X)
        },Y=function(){
            var t=e(window).width(),i=e(window).height();
            (a!=t||l!=i)&&(a=t,l=i,r.redrawSlider())
        };

        return r.goToSlide=function(t,i){
            if(!o.working&&o.active.index!=t)if(o.working=!0,o.oldIndex=o.active.index,o.active.index=0>t?f()-1:t>=f()?0:t,o.settings.onSlideBefore(o.children.eq(o.active.index),o.oldIndex,o.active.index),"next"==i?o.settings.onSlideNext(o.children.eq(o.active.index),o.oldIndex,o.active.index):"prev"==i&&o.settings.onSlidePrev(o.children.eq(o.active.index),o.oldIndex,o.active.index),o.active.last=o.active.index>=f()-1,o.settings.pager&&M(o.active.index),o.settings.controls&&D(),"fade"==o.settings.mode)o.settings.adaptiveHeight&&o.viewport.height()!=h()&&o.viewport.animate({
                height:h()
            },o.settings.adaptiveHeightSpeed),o.children.filter(":visible").fadeOut(o.settings.speed).css({
                zIndex:0
            }),o.children.eq(o.active.index).css("zIndex",51).fadeIn(o.settings.speed,function(){
                e(this).css("zIndex",50),I()
            });
            else{
                o.settings.adaptiveHeight&&o.viewport.height()!=h()&&o.viewport.animate({
                    height:h()
                },o.settings.adaptiveHeightSpeed);
                var n=0,s={
                    left:0,
                    top:0
                };

                if(!o.settings.infiniteLoop&&o.carousel&&o.active.last)if("horizontal"==o.settings.mode){
                    var a=o.children.eq(o.children.length-1);
                    s=a.position(),n=o.viewport.width()-a.width()
                }else{
                    var l=o.children.length-o.settings.minSlides;
                    s=o.children.eq(l).position()
                }else if(o.carousel&&o.active.last&&"prev"==i){
                    var d=1==o.settings.moveSlides?o.settings.maxSlides-x():(f()-1)*x()-(o.children.length-o.settings.maxSlides),a=r.children(".bx-clone").eq(d);
                    s=a.position()
                }else if("next"==i&&0==o.active.index)s=r.find("> .bx-clone").eq(o.settings.maxSlides).position(),o.active.last=!1;
                else if(t>=0){
                    var c=t*x();
                    s=o.children.eq(c).position()
                }
                if(s!==void 0){
                    var g="horizontal"==o.settings.mode?-(s.left-n):-s.top;
                    S(g,"slide",o.settings.speed)
                }
            }
        },r.goToNextSlide=function(){
            if(o.settings.infiniteLoop||!o.active.last){
                var e=parseInt(o.active.index)+1;
                r.goToSlide(e,"next")
            }
        },r.goToPrevSlide=function(){
            if(o.settings.infiniteLoop||0!=o.active.index){
                var e=parseInt(o.active.index)-1;
                r.goToSlide(e,"prev")
            }
        },r.startAuto=function(e){
            o.interval||(o.interval=setInterval(function(){
                "next"==o.settings.autoDirection?r.goToNextSlide():r.goToPrevSlide()
            },o.settings.pause),o.settings.autoControls&&1!=e&&q("stop"))
        },r.stopAuto=function(e){
            o.interval&&(clearInterval(o.interval),o.interval=null,o.settings.autoControls&&1!=e&&q("start"))
        },r.getCurrentSlide=function(){
            return o.active.index
        },r.getSlideCount=function(){
            return o.children.length
        },r.redrawSlider=function(){
            o.children.add(r.find(".bx-clone")).width(p()),o.viewport.css("height",h()),o.settings.ticker||m(),o.active.last&&(o.active.index=f()-1),o.active.index>=f()&&(o.active.last=!0),o.settings.pager&&!o.settings.pagerCustom&&(b(),M(o.active.index))
        },r.destroySlider=function(){
            o.initialized&&(o.initialized=!1,e(".bx-clone",this).remove(),o.children.removeAttr("style"),this.removeAttr("style").unwrap().unwrap(),o.controls.el&&o.controls.el.remove(),o.controls.next&&o.controls.next.remove(),o.controls.prev&&o.controls.prev.remove(),o.pagerEl&&o.pagerEl.remove(),e(".bx-caption",this).remove(),o.controls.autoEl&&o.controls.autoEl.remove(),clearInterval(o.interval),e(window).unbind("resize",Y))
        },r.reloadSlider=function(e){
            void 0!=e&&(s=e),r.destroySlider(),d()
        },d(),this
    }
})(jQuery),function(e,t){
    var i="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
    e.fn.imagesLoaded=function(n){
        function s(){
            var t=e(g),i=e(h);
            a&&(h.length?a.reject(d,t,i):a.resolve(d)),e.isFunction(n)&&n.call(r,d,t,i)
        }
        function o(t,n){
            t.src===i||-1!==e.inArray(t,c)||(c.push(t),n?h.push(t):g.push(t),e.data(t,"imagesLoaded",{
                isBroken:n,
                src:t.src
            }),l&&a.notifyWith(e(t),[n,d,e(g),e(h)]),d.length===c.length&&(setTimeout(s),d.unbind(".imagesLoaded")))
        }
        var r=this,a=e.isFunction(e.Deferred)?e.Deferred():0,l=e.isFunction(a.notify),d=r.find("img").add(r.filter("img")),c=[],g=[],h=[];
        return e.isPlainObject(n)&&e.each(n,function(e,t){
            "callback"===e?n=t:a&&a[e](t)
        }),d.length?d.bind("load.imagesLoaded error.imagesLoaded",function(e){
            o(e.target,"error"===e.type)
        }).each(function(n,s){
            var r=s.src,a=e.data(s,"imagesLoaded");
            a&&a.src===r?o(s,a.isBroken):s.complete&&s.naturalWidth!==t?o(s,0===s.naturalWidth||0===s.naturalHeight):(s.readyState||s.complete)&&(s.src=i,s.src=r)
        }):s(),a?a.promise(r):r
    }
}(jQuery);