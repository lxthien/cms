/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	$(".menu > li").click(function(e){
		switch(e.target.id){
			case "parameter":
				//change status & style menu
				$("#parameter").addClass("active");
				$("#img").removeClass("active");
				$("#video").removeClass("active");
				$("#paper").removeClass("active");
				$("#accessory").removeClass("active");
				$("#customer_idea").removeClass("active");
				//display selected division, hide others
				$("div.parameter").fadeIn();
				$("div.img").css("display", "none");
				$("div.video").css("display", "none");
				$("div.paper").css("display", "none");
				$("div.accessory").css("display", "none");
				$("div.customer_idea").css("display", "none");
			break;
			case "img":
				//change status & style menu
				$("#parameter").removeClass("active");
				$("#img").addClass("active");
				$("#video").removeClass("active");
				$("#paper").removeClass("active");
				$("#accessory").removeClass("active");
				$("#customer_idea").removeClass("active");
				//display selected division, hide others
				$("div.parameter").css("display", "none");
				$("div.img").fadeIn();
				$("div.video").css("display", "none");
				$("div.paper").css("display", "none");
				$("div.accessory").css("display", "none");
				$("div.customer_idea").css("display", "none");
			break;
			case "video":
				//change status & style menu
				$("#parameter").removeClass("active");
				$("#img").removeClass("active");
				$("#video").addClass("active");
				$("#paper").removeClass("active");
				$("#accessory").removeClass("active");
				$("#customer_idea").removeClass("active");
				//display selected division, hide others
				$("div.parameter").css("display", "none");
				$("div.img").css("display", "none");
				$("div.video").fadeIn();
				$("div.paper").css("display", "none");
				$("div.accessory").css("display", "none");
				$("div.customer_idea").css("display", "none");
			break;
			case "paper":
				//change status & style menu
				$("#parameter").removeClass("active");
				$("#img").removeClass("active");
				$("#video").removeClass("active");
				$("#paper").addClass("active");
				$("#accessory").removeClass("active");
				$("#customer_idea").removeClass("active");
				//display selected division, hide others
				$("div.parameter").css("display", "none");
				$("div.img").css("display", "none");
				$("div.video").css("display", "none");
				$("div.paper").fadeIn();
				$("div.accessory").css("display", "none");
				$("div.customer_idea").css("display", "none");
			break;
			case "accessory":
				//change status & style menu
				$("#parameter").removeClass("active");
				$("#img").removeClass("active");
				$("#video").removeClass("active");
				$("#paper").removeClass("active");
				$("#accessory").addClass("active");
				$("#customer_idea").removeClass("active");
				//display selected division, hide others
				$("div.parameter").css("display", "none");
				$("div.img").css("display", "none");
				$("div.video").css("display", "none");
				$("div.paper").css("display", "none");
				$("div.accessory").fadeIn();
				$("div.customer_idea").css("display", "none");
			break;
			case "customer_idea":
				//change status & style menu
				$("#parameter").removeClass("active");
				$("#img").removeClass("active");
				$("#video").removeClass("active");
				$("#paper").removeClass("active");
				$("#accessory").removeClass("active");
				$("#customer_idea").addClass("active");
				//display selected division, hide others
				$("div.parameter").css("display", "none");
				$("div.img").css("display", "none");
				$("div.video").css("display", "none");
				$("div.paper").css("display", "none");
				$("div.accessory").css("display", "none");
				$("div.customer_idea").fadeIn();
			break;
		}
		//alert(e.target.id);
		return false;
	});
});