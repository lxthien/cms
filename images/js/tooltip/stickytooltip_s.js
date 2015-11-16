/* Sticky Tooltip script (v1.0)
* Created: Nov 25th, 2009. This notice must stay intact for usage 
* Author: Dynamic Drive at http://www.dynamicdrive.com/
* Visit http://www.dynamicdrive.com/ for full source code
*/


var stickytooltip_s={
	tooltipoffsets: [20, -30], //additional x and y offset from mouse cursor for tooltips
	fadeinspeed: 200, //duration of fade effect in milliseconds
	rightclickstick: true, //sticky tooltip when user right clicks over the triggering element (apart from pressing "s" key) ?
	stickybordercolors: ["#00427C", "darkred"], //border color of tooltip depending on sticky state
	stickynotice1: ["Press \"s\"", "or right click", "to sticky box"], //customize tooltip status message
	stickynotice2: "Click outside this box to hide it", //customize tooltip status message

	//***** NO NEED TO EDIT BEYOND HERE

	isdocked: false,

	positiontooltip:function($, $tooltip, e){
		var x=e.pageX+this.tooltipoffsets[0], y=e.pageY+this.tooltipoffsets[1]
		var tipw=$tooltip.outerWidth(), tiph=$tooltip.outerHeight(), 
		x=(x+tipw>$(document).scrollLeft()+$(window).width())? x-tipw-(stickytooltip_s.tooltipoffsets[0]*2) : x
		y=(y+tiph>$(document).scrollTop()+$(window).height())? $(document).scrollTop()+$(window).height()-tiph-10 : y
		$tooltip.css({left:x, top:y})
	},
	
	showbox:function($, $tooltip, e){
		$tooltip.fadeIn(this.fadeinspeed)
		this.positiontooltip($, $tooltip, e)
	},

	hidebox:function($, $tooltip){
		if (!this.isdocked){
			$tooltip.stop(false, true).hide()
			$tooltip.css({borderColor:'#00427C'}).find('.stickystatus:eq(0)').css({background:this.stickybordercolors[0]}).html(this.stickynotice1)
		}
	},

	docktooltip:function($, $tooltip, e){
		this.isdocked=true
		$tooltip.css({borderColor:'darkred'}).find('.stickystatus:eq(0)').css({background:this.stickybordercolors[1]}).html(this.stickynotice2)
	},


	init:function(targetselector, tipid){
		jQuery(document).ready(function($){
			var $targets=$(targetselector)
			var $tooltip=$('#'+tipid).appendTo(document.body)
			if ($targets.length==0)
				return
			var $alltips=$tooltip.find('div.atip')
			if (!stickytooltip_s.rightclickstick)
				stickytooltip_s.stickynotice1[1]=''
			stickytooltip_s.stickynotice1=stickytooltip_s.stickynotice1.join(' ')
			stickytooltip_s.hidebox($, $tooltip)
			$targets.bind('mouseenter', function(e){
				$alltips.hide().filter('#'+$(this).attr('data-tooltip-s')).show()
				stickytooltip_s.showbox($, $tooltip, e)
			})
			$targets.bind('mouseleave', function(e){
				stickytooltip_s.hidebox($, $tooltip)
			})
			$targets.bind('mousemove', function(e){
				if (!stickytooltip_s.isdocked){
					stickytooltip_s.positiontooltip($, $tooltip, e)
				}
			})
			$tooltip.bind("mouseenter", function(){
				stickytooltip_s.hidebox($, $tooltip)
			})
			$tooltip.bind("click", function(e){
				e.stopPropagation()
			})
			$(this).bind("click", function(e){
				if (e.button==0){
					stickytooltip_s.isdocked=false
					stickytooltip_s.hidebox($, $tooltip)
				}
			})
			$(this).bind("contextmenu", function(e){
				if (stickytooltip_s.rightclickstick && $(e.target).parents().andSelf().filter(targetselector).length==1){ //if oncontextmenu over a target element
					stickytooltip_s.docktooltip($, $tooltip, e)
					return false
				}
			})
			$(this).bind('keypress', function(e){
				var keyunicode=e.charCode || e.keyCode
				if (keyunicode==115){ //if "s" key was pressed
					stickytooltip_s.docktooltip($, $tooltip, e)
				}
			})
		}) //end dom ready
	}
}

//stickytooltip_s.init("targetElementSelector", "tooltipcontainer")
stickytooltip_s.init("*[data-tooltip-s]", "mystickytooltip_s")

