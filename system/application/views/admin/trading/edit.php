<script language="javascript" type="text/javascript" src="<?php echo $base_url;?>ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>images/js/tab/jquery.tabs.css">
<script language="javascript" type="text/javascript" src="<?php echo $base_url;?>images/js/tab/jquery.tabs.js"></script>
<script type="text/javascript" language="javascript">
function getcontent()
{
	return editor_vietnamese.getData();
}
	$().ready(function(){
		//form init
		
		$('#tabContainer').tabs();
		$('.InfoContent').tabs();
		//submit validation
		
		//end submit validation

		
});
</script>

<style type="text/css">

input[type="text"] {
		display:inherit !important;
	}
	form label {
	display:inherit !important;
	}
	.error{
		color:red;
	}
	.success{
		color:#0F0;
	}
</style>

<div class="grid_15" id="textcontent">
             	
<form id="form" class="table_input" action="<?=$base_url;?>admin/tradings/edit/<?=$category->id;?>/<?=$object->id;?>" method="post" enctype="multipart/form-data">
    <div id="tabContainer" style="margin-top:10px;">
        <ul>
            <li ><a href="#general"><span>Thông tin dự án</span></a></li>     
            <li ><a href="#generalInformation"><span>Thông tin chung</span></a></li>     
            <li ><a href="#shortdetail"><span>Trích dẫn chi tiết</span></a></li>     
            <li ><a href="#detail"><span>Chi tiết</span></a></li>     
            <li ><a href="#contact"><span>Thông tin liên hệ</span></a></li>  
            <li ><a href="#photo"><span>Hình ảnh</span></a></li>     
         
        </ul>	  
        <div id="general"><?=$this->load->view("admin/trading/include/general");?></div>
        <div id="generalInformation"><?=$this->load->view("admin/trading/include/generalInformation");?></div>
        <div id="shortdetail"><?=$this->load->view("admin/trading/include/shortdetail");?></div>
        <div id="detail"><?=$this->load->view("admin/trading/include/detail");?></div>
        <div id="contact"><?=$this->load->view("admin/trading/include/contact");?></div>
        <div id="photo"><?=$this->load->view("admin/trading/include/photo");?></div>
    </div>
<div class="clear"></div>
<br /><br />
<div class="button_bar">
	
    <?php create_form_button('submit_button button_ok','Save');?>
    <?php create_form_button('reset_button button_notok','Reset');?>
</div>

</form>
</div>

