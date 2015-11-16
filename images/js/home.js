// JavaScript Document
// JavaScript Document
/*MENU*/
function getcurentmenuactive()
{	
	var LinkActive=$('#l3-mainmenu .mainmenu-item a[class="active"]');	
	var ParentLinkActive=LinkActive.parents('.mainmenu-item');
	var ParentLinkActiveIndex=$('#l3-mainmenu .mainmenu-item').index(ParentLinkActive);
	return ParentLinkActiveIndex;
}
//get Index of div which have mainmenu class ,link input 
function GetIndexActive(MenuLink)
{
	var ParentLinkActive=MenuLink.parents('.mainmenu-item');
	var ParentLinkActiveIndex=$('#l3-mainmenu .mainmenu-item').index(ParentLinkActive);
	return ParentLinkActiveIndex;
}
//init for the first time;
function initmenu()
{
	$('.submenu-container').css('display','none');
	var MenuActiveIndex=getcurentmenuactive();
	var SubmenuActive=$('#l3-submenu .submenu-container').eq(MenuActiveIndex);
	SubmenuActive.css('display','block');
	addEventToMenu(MenuActiveIndex);
	
}
function addEventToMenu(MenuActiveIndex)
{
	var CurentMenuActiveIndex=MenuActiveIndex;
	$('#l3-mainmenu .mainmenu-item a').each(function (){
		var ThisIndex=GetIndexActive($(this));
		$(this).mouseover(function (){
			$('#l3-mainmenu .mainmenu-item').eq(CurentMenuActiveIndex).children('a').removeClass('active');
			$('#l3-submenu .submenu-container').eq(CurentMenuActiveIndex).css('display','none');
			$('#l3-mainmenu .mainmenu-item').eq(ThisIndex).children('a').addClass('active');
			$('#l3-submenu .submenu-container').eq(ThisIndex).css('display','block');
			CurentMenuActiveIndex=ThisIndex;
		});
	});	
	
	$('#l2-menu').bind("mouseleave",function(){					
			$('#l3-mainmenu .mainmenu-item').eq(CurentMenuActiveIndex).children('a').removeClass('active');
			$('#l3-submenu .submenu-container').eq(CurentMenuActiveIndex).css('display','none');
			$('#l3-mainmenu .mainmenu-item').eq(MenuActiveIndex).children('a').addClass('active');
			$('#l3-submenu .submenu-container').eq(MenuActiveIndex).css('display','block');
			CurentMenuActiveIndex=MenuActiveIndex;
	})
}
function show_add(cat,tag_open ,tag_close )
{
	if (typeof tag_open == "undefined") {
    	tag_open = "";
 	 }
	 if (typeof tag_close == "undefined") {
    	tag_close = "";
 	 }

	if(use_lc == 1) baselink ="http://localhost/tax/"; else baselink = "http://vietnamtax.vn/";
	var str = "";
	var arr_ad = BN[cat][0].split(";");//luu theo thu tu code+bannerset_id,filepath,filetype
	var arr_config = BN[cat][1].split(":");
	len = arr_ad.length;
	for(cc = 1 ; cc < len ; cc++)
	{
		current_bannerset = arr_ad[cc].split(":");
		str +=tag_open;
		if(current_bannerset[3] == ".swf")
		{
			str +='<object  border="0" align="middle" width="'+arr_config[0]+ '" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000">';
            str +='<param value="'+current_bannerset[1]+'" name="movie"><param value="always" name="AllowScriptAccess">';
            str +='<param value="High" name="quality"><param value="transparent" name="wmode">';
            str +='<param value="'+current_bannerset[1]+' name="FlashVars">';
            str +='<embed  width="'+arr_config[0]+' allowscriptaccess="always" wmode="transparent" loop="true" type="application/x-shockwave-flash" ';
			str +='pluginspage="http://www.macromedia.com/go/getflashplayer"  src="'+current_bannerset[1]+'" play="true"  menu="true"> </object>';
		}
		else
		{
			str +="<a href='"+baselink+"vietnamese/fbanner/qc/"+current_bannerset[0]+"' target='_blank'>";
			str +="<img src='"+current_bannerset[1]+"' width='"+arr_config[0]+"'></a>";
		}
		str +=tag_close;
	}
	return str;
}
/*END MENU*/
/*SLIDE*/
/*SLIDE SHOW*/
function slideShow() {
	//Set the opacity of all images to 0
	$('.slide-right .boxslide').css({opacity: 0.0});
	
	//Get the first image and display it (set it to full opacity)
	$('.slide-right .boxslide:first').css({opacity: 1.0});
		
	//Get the caption of the first image from REL attribute and display it
	//$('#gallery .content').html($('#gallery a:first').find('img').attr('rel'))
	//.animate({opacity: 0.7}, 400);
	
	//Call the gallery function to run the slideshow, 6000 = change to next image after 6 seconds
	setInterval('gallery()',7000);
}

function gallery() {
	
	//if no IMGs have the show class, grab the first image
	var current = ($('.slide-right .boxslide.show')?  $('.slide-right .boxslide.show') : $('.slide-right .boxslide:first'));
	
	//Get next image, if it reached the end of the slideshow, rotate it back to the first image
	var next = (current.next().length) ? current.next() : $('.slide-right .boxslide:first');	
	
	//Get next image caption
	//var caption = next.find('img').attr('rel');	
	
	//Set the fade in effect for the next image, show class has higher z-index
	next.css({opacity: 0.0})
	.addClass('show')
	.animate({opacity: 1.0}, 0);
    var index  = $('.slide-right .boxslide').index(next);
	var currentlist = $('.slide-left .slide-left-item').eq(index);
	$('.slide-left .slide-left-item a.active').removeClass('active');
	currentlist.find('a').addClass('active');
	//Hide the current image
	current.animate({opacity: 0.0}, 0)
	.removeClass('show');
}
function galleryhover(){
	$('.slide-left .slide-left-item a').each(function (){
		$(this).mouseover(function (){
			$('.slide-left .slide-left-item a.active').removeClass('active');	
			current=$('.slide-right .boxslide.show');
			$(this).addClass('active');
			var index  = $('.slide-left .slide-left-item a').index(this);
			next=$('.slide-right .boxslide').eq(index);
			
			next.css({opacity: 0.0})
			.addClass('show')
			.animate({opacity: 1.0}, 0);
			current.animate({opacity: 0.0}, 0)
			.removeClass('show');
			//Set the opacity to 0 and height to 1px
			
			//Animate the caption, opacity to 0.7 and heigth to 100px, a slide up effect			
		
		});
	});
}
function hotbox(){
	$('.news-box-hot a').each(function (){
		$(this).mouseover(function (){
								
			if(!$(this).hasClass('active'))
			{
				news_box=$(this).parents('.news-box-hot-container');
				news_box_images=news_box.find('.news-box-image');
				news_box_images.find('a').attr({ 'href' : $(this).attr('href'),'title':$(this).attr('title')});
				news_box_images.find('img').attr({'src':$(this).attr('rel'),'alt':$(this).attr('title')});
				news_box.find('.news-box-hot a').removeClass('active');
			
				$(this).addClass('active');
			}
				
		})
	});
}
/*END SLIDE*/
$().ready(function(){
	initmenu();
	slideShow();
	galleryhover();
	hotbox();
	$('.text_search').each(function(){
		    var default_text = $(this).attr('alt');
			$(this).val(default_text);
			$(this).focus(function(){
				if($(this).val() == default_text )
				{
					$(this).val("");
		
				}
			});
			$(this).blur(function(){
					if($(this).val()=="")
						$(this).val(default_text);
			});
		});
	$()
	$('#frmlogin').submit(function(){
		if($(":input[name='username']").val() == "" || $(":input[name='password']").val() == "" )
		{
			alert('Vui lòng nhập đủ Tài khoản và mật khẩu để đăng nhập');
			return false;
		}
	});
	if($('.input_searchbar').length > 0)
	{
		$('.input_searchbar').each(function(){
			$(this).focus(function(){$(this).css('color',"#000");});
			$(this).blur(function(){
				   if($(this).val()=="" || $(this).val() == "Nhập từ khóa")
				   {
					   $(this).css('color',"#ccc");
				   }
				});
		});
	}
	
});
