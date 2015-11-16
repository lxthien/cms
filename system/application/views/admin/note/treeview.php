
<div class="grid_15" id="textcontent"> 
<script type="text/javascript" src="<?=$base_url;?>images/js/jquery.treeview.js"></script>
	<script type="text/javascript" src="<?=$base_url;?>images/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" href="<?=$base_url;?>images/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?=$base_url;?>images/js/scroll/js/jquery.tinyscrollbar.min.js"></script>
<link rel="stylesheet" href="<?=$base_url;?>images/js/scroll/css/website.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?=$base_url;?>images/css/treeview.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?=$base_url;?>images/css/treeview/jquery.treeview.css"/>
<script type="text/javascript">
$().ready(function(){
	$("#browser").treeview();
	$("a.fancylink").fancybox({
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false,
		'width'         :	800,
		'height'		:   400,
		'padding'  	 	:   '0',
		'onComplete'		:function(){$('#scrollbar1').tinyscrollbar();}
	});
	
})
</script>

<?php $this->load->helper("note_helper");?>
	<ul id="browser" class="filetree">
		<?php tree_out_admin($noteRoot);?>
	</ul>	
	<div class="clr"></div>


</div>