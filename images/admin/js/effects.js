function str_replace(search, replace, str){
	var ra = replace instanceof Array, sa = str instanceof Array, l = (search = [].concat(search)).length, replace = [].concat(replace), i = (str = [].concat(str)).length;
	while(j = 0, i--)
		while(str[i] = str[i].split(search[j]).join(ra ? replace[j] || "" : replace[0]), ++j < l);
	return sa ? str : str[0];
}
 
function remove_vietnamese_accents(str)
{
	accents_arr= new Array(
		"à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
		"ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề",
		"ế","ệ","ể","ễ",
		"ì","í","ị","ỉ","ĩ",
		"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ",
		"ờ","ớ","ợ","ở","ỡ",
		"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
		"ỳ","ý","ỵ","ỷ","ỹ",
		"đ",
		"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă",
		"Ằ","Ắ","Ặ","Ẳ","Ẵ",
		"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
		"Ì","Í","Ị","Ỉ","Ĩ",
		"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ",
		"Ờ","Ớ","Ợ","Ở","Ỡ",
		"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
		"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
		"Đ"," ","\"","!","@","#","$","%","^","&","*","(",")",".",",",";","'","[","]","{","}"
		,":","“","”","--",'.','>','<','--','---','‘','’','/','?','~',"|"
	);
 
	no_accents_arr= new Array(
		"a","a","a","a","a","a","a","a","a","a","a",
		"a","a","a","a","a","a",
		"e","e","e","e","e","e","e","e","e","e","e",
		"i","i","i","i","i",
		"o","o","o","o","o","o","o","o","o","o","o","o",
		"o","o","o","o","o",
		"u","u","u","u","u","u","u","u","u","u","u",
		"y","y","y","y","y",
		"d",
		"a","a","a","a","a","a","a","a","a","a","a","a",
		"a","a","a","a","a",
		"e","e","e","e","e","e","e","e","e","e","e",
		"i","i","i","i","i",
		"o","o","o","o","o","o","o","o","o","o","o","o",
		"o","o","o","o","o",
		"u","u","u","u","u","u","u","u","u","u","u",
		"y","y","y","y","y",
		"d","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-","-",
		"-","-","-","-",'-','-','-','-','---','-','-','-','','',''
	);
    
	return str_replace(accents_arr,no_accents_arr,str).toLowerCase();
}
/**
 * show the popup message
 * 
 * @param message text message
 * @param type  type of message error,warning,info,success,confirm (form confirm message)
 * @param callback callback funtion for confirm dialog, it's excute after user choose "YES"
 * @param args_to_callback_as_array  value to callback
 * @param callback_no callback funtion for confirm dialog, it's excute after user choose "NO"
 * @param args_to_callback_no_as_array  value to callback
 * @return 
 */
function showMessage(message,type,callback,args_to_callback_as_array,callback_no,args_to_callback_no_as_array)
{
	
	if( isEmpty(type))
		type="error";
	 hideLoading();

     
	 if(type=="confirm")
	 {
		 $('#dialog-message-confirm').dialog("destroy");
		 $( "#dialog-message-confirm" ).dialog({
				autoOpen: false,
				draggable:false,
				resizable:false,
				modal:true,
				width:320,
                title:'Thông báo',
				position:'center',
				buttons: {
					 'Có' : function() {
						
						if(typeof args_to_callback_as_array != "undefined" )
						{
				            args_to_cb = args_to_callback_as_array;
				            //if array just has 1 value , pass the call back with single value
				            if(args_to_cb.length == 0)
				            {
				            	callback();
				            }
				            else
				            {
					            if(args_to_cb.length == 1)
					            {
					            	args_to_cb = args_to_cb[0];	
					            }
					            callback(args_to_cb);
				            }
				            
						}
				        else 
				        {
				            args_to_cb = [];
				            callback(args_to_cb);
				        }
						$( this ).dialog( "close" );
					},
					'Không' : function() {
			 			if(typeof callback_no != "undefined")
			 			{
						 	if(typeof args_to_callback_no_as_array!="undefined" )
							{
					            args_to_cb = args_to_callback_no_as_array;
					            //if array just has 1 value , pass the call back with single value
					            if(args_to_cb.length == 0)
					            {
					            	callback_no();
					            }
					            else
					            {
						            if(args_to_cb.length == 1)
						            {
						            	args_to_cb = args_to_cb[0];	
						            }
						            callback_no(args_to_cb);
					            }
					            
							}
					        else 
					        {
					            args_to_cb = [];
					            callback_no(args_to_cb);
					        }
			 			}
			 			$( this ).dialog( "close" );
					}
					
				}
			});
		 $('#dialog-message-confirm').addClass("message-info");
		 $('#dialog-message-confirm .dialog-message-content').html(message);
		 $("#dialog-message-confirm" ).parent().css( {
				position : "fixed"
			}).end().dialog('open');
	 }
	 else{
        var messageTitle = 'Thông báo';
        var messageContent = "";
        if($.isArray(message))
        {
            messageTitle = message[0];
            messageContent = message[1];
        }
        else
        {
            messageContent = message;
        }
         $( "#dialog-message" ).dialog('destroy');
	     $( "#dialog-message" ).dialog({
    		title: messageTitle,
    		autoOpen: false,
    		draggable:false,
    		resizable:false,
    		modal:true,
    		width:320,
    		position:'center',
    		buttons: {
    			'OK'  : function() {
        			 if(typeof callback != "undefined")
                     {
        			     if(typeof args_to_callback_as_array != "undefined" )
    					 {
    			            args_to_cb = args_to_callback_as_array;
    			            //if array just has 1 value , pass the call back with single value
    			            if(args_to_cb.length == 0)
    			            {
    			            	callback();
    			            }
    			            else
    			            {
    				            if(args_to_cb.length == 1)
    				            {
    				            	args_to_cb = args_to_cb[0];	
    				            }
    				            callback(args_to_cb);
    			            }
    			            
    					}
    			        else 
    			        {
    			            args_to_cb = [];
    			            callback(args_to_cb);
    			        }
        				
        			}
                    $( this ).dialog( "close" );
                }
    		}
    	});  
		 var cssClass="message-error";
		 switch(type){
			 case "error": {
				 cssClass = "message-error";
				 break;
			 }
			 case "warning": {
				 cssClass = "message-warning";
				 break;
			 }
			 case "info": {
				 cssClass = "message-info";
				 break;
			 }
			 case "success": {
				 cssClass = "message-success";
				 break;
			 }
			 default:
			 {
				 cssClass = "message-error";
				 break;
			 }
		 }
		 $('#dialog-message').removeClass("message-error");
		 $('#dialog-message').removeClass("message-warning");
		 $('#dialog-message').removeClass("message-success");
		 $('#dialog-message').removeClass("message-info");
		 
		 $('#dialog-message').addClass(cssClass);
		 $('#dialog-message .dialog-message-content').html(messageContent);
		 $("#dialog-message" ).parent().css( {
				position : "fixed"
			}).end().dialog('open');
	 }
}


function showLoading()
{
	$('#ajax-indicator').show();
	$(".overlay").css("height",window.innerHeight);
	$(".overlay").css("width",window.innerWidth);
	$(".overlay").show();
}
function hideLoading()
{
	$('#ajax-indicator').hide();
	$(".overlay").hide();
}
function ajaxSetup()
{
	/* ajax error handle */
	$(".btnCloseErrorDetail").click(function(){
		
			$("div#error-indicator").addClass("error-indicator-detail");
			$("#error-indicator span.error-detail").show();
			$("#error-indicator span.error-message").hide();
			$(this).val("Hide Detail");	
		
	});
	$(".btnCloseErrorMessage").click(function(){
		$("#error-indicator").hide();
	})
	$.ajaxSetup({ 
		cache: false,
		header : {"Cache-Control":"	no-cache","Pragma":"no-cache","Cache-Control":"no-store"}
	});

	$("div#error-indicator").ajaxError(function(e, jqxhr, settings, exception) {
		  hideLoading();
		  $(this).removeClass("error-indicator-detail");
          $(this).show();
		  $("#error-indicator span.error-message")
		  	.html( "ERROR : " + exception + "<br>Please click button below to view error detail" )
		  	.css("display",'block');
		  $("#error-indicator span.error-detail").html( jqxhr.responseText ).css("display",'none');
	});
	//show loading
	$("div#ajax-indicator").ajaxStart(function() {
			$("#error-indicator").hide()
		 showLoading();		
	});
	//hide loading when ajax end
	$("div#ajax-indicator").ajaxStop(function() {
		hideLoading();
	});
	/*
	//hide loading when ajax end
	$("div#ajax-indicator").ajaxSuccess(function() {
		  $(this).hide();
	});*/
    
}
function isEmpty(inVar)
{
	return (typeof inVar === 'undefined' || !inVar)
}

$(document).ready(function(){       
// BROWSER Detection //						   
var browser=navigator.appName;
var b_version=navigator.appVersion;
var version=parseFloat(b_version);
ajaxSetup();
// Using browser detection to disable the jQuery Blend effect on the main menu in IE6 and Opera - z-index issues //

/*if (b_version.indexOf("MSIE 6.0")==-1 && browser.indexOf("Opera")==-1 && b_version.indexOf("MSIE 7.0")==-1) {
        $("#menu_group_main a").blend();       
}  */  

// I have used IF statements to avoid missing elements or functions on pages. //
// The effects will work only if the linked element exists in the document    //
$(".datatable a,.datatable :input[name != 'checkall']").click(function(e){
    e.stopPropagation() ;
    return true;
});

if ( $(".column").length > 0 ) {

// We make the .column divs sortable //
		$(".column").sortable({
			connectWith: '.column',
			// We make the .portlet-header to act as a handle for moving portlets //
			handle: '.portlet-header'
		});
		// We create the protlets and style them accordingly by script //
		$(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
			.find(".portlet-header")
				.addClass("ui-widget-header ui-corner-top")
				.prepend('<span class="ui-icon ui-icon-triangle-1-n"></span>')
				.end()
			.find(".portlet-content");
		// We make arrow button on any portlet header to act as a switch for sliding up and down the portlet content //
		$(".portlet-header .ui-icon").click(function() {
			$(this).parents(".portlet:first").find(".portlet-content").slideToggle("fast");
			$(this).toggleClass("ui-icon-triangle-1-s"); 
			return false;	
		});
		// We disable the mouse selection on .column divs //
		$(".column").disableSelection();
}
		// This function is making the info messages to slide up when the X is clicked //
		$(".info").click(function() {
			$(this).slideUp("fast");							 	  
		});
		// This is creating a modal box from a hidden element on the page with id #inline_example1 //
		$("#inline_example1").dialog({
			bgiframe: true,
			autoOpen: false,
			modal: true
		});	
		// This is creating a modal box from a hidden element on the page with id #inline_example2 //
		$("#inline_example2").dialog({
			bgiframe: false,
			autoOpen: false,
			modal: true
		});		
		// This triggers the modal dialog box //
		$('.mail').click(function() {
			$('#inline_example1').dialog('open');
		});
		// This toggles the color changer menu //
		$(".dropdown").click(function() { 
			$("#colorchanger").slideToggle("fast");	
		});	
		if ( $(".submit_button").length > 0 ) {	
			$(".submit_button").click(function(){
				frm=$(this).parents('form');
				frm.trigger('submit');
			});
		}
		$(".reset_button").click(function(){
			
			$(this).parents('form')[0].reset();
		});
	
// The functions below are made as FX for table operations //
if ( $(".approve_icon").length > 0 ) {		
		$(".approve_icon").click(function() { 
			$(this).parents("tr").css({ "background-color" : "#e1fbcd" }, 'fast'); 
				// THE ALERT BELOW CAN BE REMOVED - you can put any function here linked to the approve icon link in the table //
				
			});
}
if ( $(".reject_icon").length > 0 ) {	
		$(".reject_icon").click(function() { 
			$(this).parents("tr").css({ "background-color" : "#fbcdcd" }, 'fast'); 	
				// THE ALERT BELOW CAN BE REMOVED - you can put any function here linked to the reject icon link in the table //		
			});
}



    $("#checkall").live('click',function(){
        if($(this).prop("checked"))
        {
            $(".checkinput").each(function(){
                $(this).attr("checked",true);  
                $(this).parents("tr").css({ "background-color" : "#e1fbcd" }, 'fast'); 	
            });
        }
        else
        {
            $(".checkinput").each(function(){
                $(this).attr("checked",false);  
                $(this).parents("tr").css({ "background-color" : "#fff" }, 'fast'); 	
            });
        }
   });
   $(".checkinput").each(function(){
        $(this).live('click',function(){
            if($(this).prop("checked") == false)
            {
                 $("#checkall").attr("checked",false);
                 $(this).parents("tr").css({ "background-color" : "#fff" }, 'fast'); 	
            }
            else
            {
                $(this).parents("tr").css({ "background-color" : "#e1fbcd" }, 'fast'); 	
                var check = true;
                $(".checkinput").each(function(){
                    if($(this).prop("checked") == false) check = false;   
                });
              
                if(check == true)
                {
                    $("#checkall").attr("checked","checked");
                }
            }
        
         }); 
   });
// This function serves the More submenu ideea - you can attach the class .more to any tabbed link and you will trigger the hidden sub-sub menu to appear when clicked - this can be developed in a nice way if you have an enormous amount of links //
if ( $(".more").length > 0 ) {	
		if($("#tabs .more").hasClass('current'))
		{
			$("#hidden_submenu").css('display','block');
			//$(this).toggleClass("current"); 
	
		}
}


$(".table_input tr:odd").css("background","#E0F2F7");
// This triggers the calendar when clicked on the event tip on the right of the title - dashboard.html - it can be used anywhere in the page //
if ( $(".hidden_calendar").length > 0 ) {
		$(".hidden_calendar").datepicker();
		$(".inline_calendar").click(function() { 
			$(".hidden_calendar").toggle("fast");
		});		
}

if( $('.textenter').length > 0){

		$('.textenter').bind('keypress', function(e) {
				var code = (e.keyCode ? e.keyCode : e.which);
			 if(code == 13) { //enter press
			  frm=$(this).parents('form');
			   frm.submit();
			 }
	});
};

		$('.enterDisable').live('keypress', function(e) {
				var code = (e.keyCode ? e.keyCode : e.which);
			 if(code == 13) { //enter press
                    return false;
			 }
	   });

// This triggers the 2nd modal box when clicked on the TIP link on the right of the title - forms.html //
if ( $(".inline_tip").length > 0 ) {
		$(".inline_tip").click(function() { 
			$("#inline_example2").dialog('open');
		});
};


if( $('.change_position').length > 0)
{
	$('.change_position').each(function () {
		$(this).click(function () {
				steps = $('input[name="position_steps"]').val();
				$(this).attr('href',$(this).attr('href')+"/"+steps);
			
				return true;
			})	;
	} );
}


//close ready
});


// THE jQuery scripts end here //

// Below is the "allbox" script for selecting all checkboxes in a table by clicking one of them - usualy the on in the table heading //

if ( $("#allbox").length > 0 ) {		
	function checkAll(){
		for (var i=0;i<document.forms[0].elements.length;i++)
		{
			var e=document.forms[0].elements[i];
			if ((e.name != 'allbox') && (e.type=='checkbox'))
			{
				e.checked=document.forms[0].allbox.checked;
			}
		}
	}
};


if($('input[name="bttenter"]').length>0)
{
$('input[name="bttenter"]').bind('keypress', function(e) {
				var code = (e.keyCode ? e.keyCode : e.which);
			 if(code == 13) { //Enter keycode
			   //Do something
			  frm=$(this).parents('form');
			   frm.submit();
			 }

		});
}

//call ajax setup for project

function showLoading()
{
	$('#ajax-indicator').show();
	$(".overlay").css("height",window.innerHeight);
	$(".overlay").css("width",window.innerWidth);
	$(".overlay").show();
}
function hideLoading()
{
	$('#ajax-indicator').hide();
	$(".overlay").hide();
}
function ajaxSetup()
{
	/* ajax error handle */
	$(".btnCloseErrorDetail").click(function(){
		
			$("div#error-indicator").addClass("error-indicator-detail");
			$("#error-indicator span.error-detail").show();
			$("#error-indicator span.error-message").hide();
			$(this).val("Hide Detail");	
		
	});
	$(".btnCloseErrorMessage").click(function(){
		$("#error-indicator").hide();
	})
	$.ajaxSetup({ 

	});

	$("div#error-indicator").ajaxError(function(e, jqxhr, settings, exception) {
		  hideLoading();
		  $(this).removeClass("error-indicator-detail");
          $(this).show();
		  $("#error-indicator span.error-message")
		  	.html( "ERROR : " + exception + "<br>Please click button below to view error detail" )
		  	.css("display",'block');
		  $("#error-indicator span.error-detail").html( jqxhr.responseText ).css("display",'none');
	});
	//show loading
	$("div#ajax-indicator").ajaxStart(function() {
			$("#error-indicator").hide()
		 showLoading();		
	});
	//hide loading when ajax end
	$("div#ajax-indicator").ajaxStop(function() {
		hideLoading();
	});
	/*
	//hide loading when ajax end
	$("div#ajax-indicator").ajaxSuccess(function() {
		  $(this).hide();
	});*/
}
function checkallinput(checkall,checkname)
{	
}
function deleteallinput(form,formaction,checkname )
{
	checkname = checkname || 'checkinput';
	c=$('.'+checkname+':checked').length;
	if(c>0)
	{
		ans=confirm("Bạn có muốn xóa ko ? ");
		if(ans)
		{
			ans1=confirm("Bạn ko thể phục hồi đối tượng đã xóa ? ");
			if(ans1)
			{
				$('#'+form).attr('action',formaction);
				$('#'+form).submit();
			}
		}
	}
	else
	{
		alert("Vui lòng chọn item trước khi xóa");
	}
	return false;
}

function actionallinput(type,form,formaction,checkname )
{
	if(type == "" || form == "" || formaction == "" || checkname == "" )
	 	alert("Phát hiện lỗi. Vui lòng thử lại.");
	else
	{
		checkname = checkname || 'checkinput';
		c=$('.'+checkname+':checked').length;
		if(c>0)
		{
			switch(type)
			{
				case "recycle":{
					ans=confirm("Bạn có muốn xóa ko ? ");
					if(ans)
					{
						ans1=confirm("Bạn ko thể phục hồi đối tượng đã xóa ? ");
						if(ans1)
						{
							$('#'+form).attr('action',formaction);
							$('#'+form).submit();
						}
					}
					break;
				}
				case "delete":{
					ans=confirm("Bạn có muốn xóa ko ? ");
					if(ans)
					{
						ans1=confirm("Bạn ko thể phục hồi đối tượng đã xóa ? ");
						if(ans1)
						{
							$('#'+form).attr('action',formaction);
							$('#'+form).submit();
						}
					}
					break;
				}
				case "unrecycle":{
					ans=confirm("Bạn có muốn phục hồi chọn  ko ? ");
					if(ans)
					{
							$('#'+form).attr('action',formaction);
							$('#'+form).submit();
					
					}
					break;
				}
				case "active":{
					ans=confirm("Bạn có muốn kích hoạt tất cả chọn  ko ? ");
					if(ans)
					{
						
							$('#'+form).attr('action',formaction);
							$('#'+form).submit();
					
					}
					break;
				}
				case "deactive":{
					ans=confirm("Bạn có muốn bỏ kích hoạt tất cả chọn  ko ? ");
					if(ans)
					{
						
							$('#'+form).attr('action',formaction);
							$('#'+form).submit();
					
					}
					break;
				}
				case "addhome":{
					ans=confirm("Bạn có muốn thêm tin chọn vào danh sách tin hot trang chủ ? ");
					if(ans)
					{
						
							$('#'+form).attr('action',formaction);
							$('#'+form).submit();
					
					}
					break;
				}
			}
		}
		else
		{
			alert("Vui lòng chọn trước khi thực hiện.");
		}
	}
	return false;
}