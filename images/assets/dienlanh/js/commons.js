function fn_fixpng(){
	$('img, .address').ifixpng();
}
function fn_clearFormContact(){
	var form = document.contactForm;
	form.n_name.value = '';
	form.n_address.value = '';
	form.n_phone.value = '';
	form.n_email.value = '';
	form.n_title.value = '';
	form.n_content.value = '';
}
function show_hide_subnav(id,Boolan){
	id = '#' + id;
	if(Boolan == 'true'){
		$(id).css({'display':'block'});
		$(id).parent().addClass('selected');
	} else{
		$(id).css({'display':'none'});
		$(id).parent().removeClass('selected');
	}
}