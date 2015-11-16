<script type="text/javascript">
$().ready(function(){
	$('#fileupload').hide();
	$('#newbanner').click(function(){
		if($(this).attr("checked")==false)
			$('#fileupload').hide();
		else
			$('#fileupload').show();
	});
	
	
	$('#mapupload').hide();
	$('#newmap').click(function(){
		if($(this).attr("checked")==false)
			$('#mapupload').hide();
		else
			$('#mapupload').show();
	});
});
</script>
<style type="text/css">
    #upload{  
        margin:30px 200px; padding:15px;  
        font-weight:bold; font-size:1.3em;  
        font-family:Arial, Helvetica, sans-serif;  
        text-align:center;  
        background:#f2f2f2;  
        color:#3366cc;  
        border:1px solid #ccc;  
        width:150px;  
        cursor:pointer !important;  
        -moz-border-radius:5px; -webkit-border-radius:5px;  
    }  
</style>
<table class="table_input">
	<tr>
    	
        	<td><label>Tên dự án (Tiếng việt):</label></td>
            <td><input type="text" name="name_vietnamese" class="smallInput big" value="<?=$object->name_vietnamese;?>" /></td>
       
    </tr>
    <tr>
    	
        	<td><label>Tên dự án (Tiếng anh):</label></td>
            <td><input type="text" name="name_english" class="smallInput big" value="<?=$object->name_english;?>" /></td>
        
    </tr>
    <tr>
    	
        	<td><label>Giá:</label></td>
            <td><input type="text" name="price" class="smallInput big" value="<?=$object->price;?>" /></td>
        
    </tr>
    <tr>
    	
        	<td><label>Hình đại diện :</label></td>
            <td>
            	<img src="<?=$base_url.'img/trading/'.filenameplus($object->image,'thump');?>" width="127" />
                <input type="hidden" name="imagelink" value="<?=$object->image;?>" >
   				 <input type="hidden" name="maplink" value="<?=$object->map;?>" >
            </td>
       
    </tr>
    
    
    <tr>
               <td>Chọn hình :</td>
                <td><input type="checkbox" id="newbanner" name="newimage"  value="1"/></td>
     </tr>
    <tr id="fileupload">
        <td>
            <label for="name">Chọn đại diện:</label></td>
        <td><input type="file" name="image" class="smallInput medium" /></td>
    </tr>
    
    
    <tr>
    	
        	<td><label>Hình bản đồ :</label></td>
           <td><img src="<?=$base_url.'img/trading/'.filenameplus($object->map,'thump');?>" width="127" /></td>
       
    </tr>
    <tr>
               <td>Chọn hình bản đồ khác :</td>
                <td><input type="checkbox" id="newmap" name="newmap"  value="1"/></td>
     </tr>
    <tr id="mapupload">
        <td>
            <label for="name">Chọn hình:</label></td>
        <td><input type="file" name="map" class="smallInput medium" /></td>
    </tr>
    
    
	
</table>