		function scrollWin(a){
		$('html, body').animate({
		scrollTop: $("#sizeerror").offset().top-a
		}, 1500);
		}
		
		function kiemtramuahang()
		{
			base_url=$('#base_url').val();
			if($('#hiSize').val()=="")
			{
				//alert('Xin vui lòng chọn size.');
				$('#sizeerror-dialog').show();
			
			}
			else
			{
				$.unblockUI({ fadeOut: 200 }); 
				$.ajax({
					type:"post",
					beforeSend:function(){
						$('#loadingicon-dialog').css('display','block');
						$('#infoshow-infosp').css('display','none');
						 $.blockUI({ 
								   message: $('#infoshow-dialog'),
								    css: { 
									padding:        0, 
									margin:         0, 
									width:          '400px', 
									top:            '20%', 
									left:           '35%', 
									textAlign:      'center', 
									color:          '#000', 
									border:         '3px solid #aaa', 
									backgroundColor:'#fff', 
									cursor:         'wait' 
									}, 
								  	 focusInput: true,
									 bindEvents: true ,
									 constrainTabKey: false 
								   }); 
							/* $.blockUI({ 
								   message: $('.loadingdialog'),
								    css: { 
									padding:        0, 
									margin:         0, 
									width:          '400px', 
									top:            '20%', 
									left:           '35%', 
									textAlign:      'center', 
									color:          '#000', 
									border:         '3px solid #aaa', 
									backgroundColor:'#fff', 
									cursor:         'wait' 
									}, 
								  	 focusInput: true,
									 bindEvents: true ,
									 constrainTabKey: false 
								   }); */
						
						},
					url: base_url+"sanpham/addcart/"+$('#idSanphamdialog').val(),
					port: "autocomplete1" ,
					data:{'hiSize':$('#hiSize').val(),'cbxSoluong':$('#cbxSoluongdialog').val()},
					dataType:'text',
					success: function(data){
								/*$.unblockUI(); */
								
								$('#hangtronggio').empty().html(data);
								$('#infoshow-giohang-dialog').empty().html("Có "+data+" sản phẩm trong giỏ hàng.");								
								$('#infoshow-sanpham-dialog').empty().html("<strong>Tên sản phẩm: "+$('#idSanphamname').val()+"</strong>");
								$('#infoshow-size-dialog').empty().html("<strong>Size: "+$('#hiSize').val()+"</strong>");
								$('#infoshow-soluong-dialog').empty().html("<strong>Số lượng: "+$('#cbxSoluongdialog').val()+"</strong>");
								$('#loadingicon-dialog').css('display','none');
								$('#infoshow-infosp').show("slow");
								
								/* $.blockUI({ 
								   message: $('#infoshow-dialog'),
								    css: { 
									padding:        0, 
									margin:         0, 
									width:          '400px', 
									top:            '20%', 
									left:           '35%', 
									textAlign:      'center', 
									color:          '#000', 
									border:         '3px solid #aaa', 
									backgroundColor:'#fff', 
									cursor:         'wait' 
									}, 
								  	 focusInput: true,
									 bindEvents: true ,
									 constrainTabKey: false 
								   }); */
								 $('.blockOverlay').attr('title','Tiếp tục mua sắm').click($.unblockUI); 
								 $('#closethongbao').click($.unblockUI);
											
						}
					   });
			}
			
			
		}
		
		
		function checklogin()
		{
			base_url=$('#base_url').val();
				$.ajax({
					type:"post",
					url: base_url+"sanpham/checklogin/",
					port: "autocomplete" ,
					dataType:'text',
					success: function(data){
				
						if(data==0)
							{
								 $.blockUI({ 
								   message: $('#loginform'),
								    css: { 
									padding:        0, 
									margin:         0, 
									width:          '400px', 
									top:            '20%', 
									left:           '35%', 
									textAlign:      'center', 
									color:          '#000', 
									border:         '3px solid #aaa', 
									backgroundColor:'#fff', 
									cursor:         'wait' 
									}, 
								  	 focusInput: true,
									 bindEvents: true ,
									 constrainTabKey: false 
								   }); 
								 $('.blockOverlay').attr('title','Tiếp tục mua sắm').click($.unblockUI); 
								 $('#donglogin').click($.unblockUI);
							}
						else
							if(data==1)
								$('#frmLogin').submit();
						}
					   });
		}
		function loginkhachhang()
		{
			base_url=$('#base_url').val();
			$.ajax({
					type:"post",
					url: base_url+"user/login",
					port: "autocomplete" ,
					data: {'username':$("#txtLoginUsername").val(),'password':$('#txtLoginPassword').val()},
					dataType:'text',
					success: function(data){
						if(data==1)
							{
								alert("Đăng nhập thành công");
								$('#frmLogin').submit();
								
						}
						else
							alert("Vui lòng nhập đúng Username và Password") ;
						}
					   });
		}
		function addtocart(sanphamitem)
		{
			base_url=$('#base_url').val();
				$(".sanpham-detail-size-dialog .sanpham-detail-size-content").empty();			
				size=sanphamitem.id.split(";");
				s=size.length;
				for(i=s-1;i>=0;i--)
				{
					
					chuoi='<div align="center" class="sanpham-detail-size-item"><a kichthuoc="'+size[i]+'"><strong>'+size[i]+'</strong></a></div>';
					$(".sanpham-detail-size-dialog .sanpham-detail-size-content").prepend(chuoi);
				
					$('.sanpham-detail-size-dialog .sanpham-detail-size-item a').each(function(){
					
						$(this).click(function(){
							$('.sanpham-detail-size-item a').each(function(){
									$(this).removeClass('cursize');
														   });
							$(this).addClass('cursize');
							kichthuoc=$(this).attr('kichthuoc');
							$('#hiSize').val(kichthuoc);
						});
					});
				}
				$('#hiSize').val("");
				$('#idSanphamdialog').val(sanphamitem.rel);
				$('#idSanphamname').val(sanphamitem.title);
				
				//$('#frmchonsize').attr('action','<?=$base_url;?>sanpham/addcart/'+sanphamitem.rel);
				
			$('#sizeerror-dialog').hide();
			//$('#chonsize_error').empty();
			
			 $.blockUI({ 
								   message: $('#chonsize'),
								    css: { 
									padding:        0, 
									margin:         0, 
									width:          '400px', 
									top:            '20%', 
									left:           '35%', 
									textAlign:      'center', 
									color:          '#000', 
									border:         '3px solid #aaa', 
									backgroundColor:'#fff', 
									cursor:         'poiter' 
								}, 
								   focusInput: true,
									bindEvents: true ,
									constrainTabKey: false 
								   }); 
					 $('.blockOverlay').attr('title','Tiếp tục mua sắm').click($.unblockUI); 
					 $('#dongchonsize').click($.unblockUI);
					  $('#dongdialog').click($.unblockUI);
			return false;
		}
		$().ready(function (){
			base_url=$('#base_url').val();
							$('.themgiohang').click(function (){ 
											  if(kiemtrahang()==true)
											 	 $('#frmdetail').submit();
																		
											});
							$('#detailhiSize').val("") ;
			
			$('.sanpham-detail-size-item a').each(function(){
					
					$(this).click(function(){
						$('.sanpham-detail-size-item a').each(function(){
								$(this).removeClass('cursize');
																	   });
						$(this).addClass('cursize');
						kichthuoc=$(this).attr('kichthuoc');
						$('#detailhiSize').val(kichthuoc);
					});
			});
		/*DETAIL HINH SLIDE*/
		var options = {
	    zoomWidth: 370,
	    zoomHeight: 435,
        xOffset: 20,
        yOffset: 0,
		title:false,
        position: "right" //and MORE OPTIONS
		};
		//$('.pzoom').each(function(){$(this).jqzoom(options)});		
		$('.gallery_demo_unstyled').addClass('gallery_demo');
		
		$('ul.gallery_demo').galleria({
			history   : false, // activates the history object for bookmarking, back-button etc.
			clickNext : false, // helper for making the image clickable
			insert    : '.sanpham-detail-hinh', // the containing selector for our main imaewge
			onImage   : function(image,caption,thumb) { // let's add some image effects for demonstration purposes
				
				// fade in the image & caption
				if(! ($.browser.mozilla && navigator.appVersion.indexOf("Win")!=-1) ) { // FF/Win fades large images terribly slow
					image.css('display','none').fadeIn(1000);
				}
				caption.css('display','none').fadeIn(1000);
				
				// fetch the thumbnail container
				var _li = thumb.parents('li');
				
				// fade out inactive thumbnail
				_li.siblings().children('img.selected').fadeTo(500,0.3);
				
				// fade in active thumbnail
				thumb.fadeTo('fast',1).addClass('selected');
				
				// add a title for the clickable image
				
				//image.parent('a').attr('src',image.attr('src'));
				hinh=$('.sanpham-detail-hinh img');
				hinh.attr('width','316');
				hinh.attr('height','405');
				var __aa=$(document.createElement('a')).addClass('pzoom').attr('href',thumb.attr('imagezoom'));
				
				__aa.append(hinh);
				
				//hinh.remove();
				$('.sanpham-detail-hinh .galleria_wrapper').append(__aa);
				
				$('.pzoom').each(function(){$(this).jqzoom(options)});		
			},
			onThumb : function(thumb) { // thumbnail effects goes here
				
				// fetch the thumbnail container
				var _li = thumb.parents('li');
				
				// if thumbnail is active, fade all the way.
				var _fadeTo = _li.is('.active') ? '1' : '0.3';
				
				// fade in the thumbnail when finnished loading
				thumb.css({display:'none',opacity:_fadeTo}).fadeIn(1500);
				
				// hover effects
				thumb.hover(
					function() { thumb.fadeTo('fast',1); },
					function() { _li.not('.active').children('img').fadeTo('fast',0.3); } // don't fade out if the parent is active
				)
			}
			
		});
							});