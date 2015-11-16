// JavaScript Document
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