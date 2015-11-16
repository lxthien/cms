	<script type="text/javascript">
	
	$().ready(function() {
		$('#date_start,#date_end').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:'yy-mm-dd',
			monthNamesShort:['T.1','T.2','T.3','T.4','T.5','T.6','T.7','T.8','T.9','T.10','T.11','T.12',],
			dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
			nextText:"",
			prevText:""
		});
	
		$('#search').bind('submit',function(){
			var date_start=$(':input[name="date_start"]').val();
			var date_end=$(':input[name="date_end"]').val();
			if(( date_start!="" & date_end=="" ) || ( date_start=="" & date_end!="" ) ) 
			{
				alert("Vui lòng nhập cả ngày bắt đầu và ngày kết thúc");	
				return false;
			}
		
		});
	});
</script>
<style type="text/css">
	.table_input label{
		text-align:right;
	};
	
</style>
<div class="grid_15" id="textcontent">
	<form action="<?=$this->admin_url;?>cnews/dosearch" method="post" id="searchform" >
    	<table>
        	<tr>
            	<td colspan="2">
                    <table class="table_input">
                            <tr>	
                                <td><label for="name">Từ khóa:</label></td>
                                <td><input type="text" name="searchkey" class="smallInput big  textenter" value="<?=$searchkey;?>" style="display:inline !important;" /></td>
                            </tr>
                     </table>
                </td>
            </tr>
     		<tr>
                <td width="50%">
                        <table class="table_input">
                        
                        <tr >
            <td >
                                           <label for="name" style="text-align:right" > Danh mục:                  </label></td>
                                        <td><select name="newscatalogue" class="smallInput ">
                                        <option value="">Tất cả danh mục</option>
                                        <?php foreach($newscatalogue as $row): ?>
                                        <option value="<?=$row->id;?>" <?php if($catalogue_id == $row->id) echo "selected = 'selected'";?> ><?php echo $row->name_vietnamese;?></option>
                                        <?php endforeach;?>
                                            </select>
                                        </td>
                       </tr>
                       <tr>
                            <td><label for="name">Từ ngày :</label></td>
                            <td><div style="">
                                 <input type="text" id="date_start" name="date_start" style="display:inline !important;" class="smallInput" value="<?=$date_start;?>" > 
                                 <label style="display:inline !important;">đến ngày : &nbsp;</label><input type="text" id="date_end" name="date_end" class="smallInput" style="display:inline !important;"  value="<?=$date_end;?>" ></div></td>
                       </tr>
                       <tr>	
                                <td><label for="name">Kích hoạt:</label></td>
                                <td><input type="radio" value="3" name="active" <?php if($active == 3 ) echo 'checked';?> > Tất cả
                                <input type="radio" value="1" name="active" <?php if($active == 1 ) echo 'checked';?> > Có
                                <input type="radio" value="0" name="active" <?php if($active == 0) echo 'checked';?> > Chưa</td>
                       </tr>
                        <tr>	
                                <td><label for="name">Hot danh mục:</label></td>
                                <td><input type="radio" value="3" name="hot_cat" <?php if($hot_cat == 3 ) echo 'checked';?> > Tất cả
                                <input type="radio" value="1" name="hot_cat" <?php if($hot_cat == 1 ) echo 'checked';?> > Có
                                <input type="radio" value="0" name="hot_cat" <?php if($hot_cat == 0) echo 'checked';?> > Không</td>
                       </tr>
                      
                        
                      </table>
                </td>
                <td width="50%">
                        <table class="table_input">
                     
                        <tr>	
                                <td><label for="name">Hot trang chủ:</label></td>
                                <td><input type="radio" value="3" name="hot_home" <?php if($hot_home == 3 ) echo 'checked';?> > Tất cả
                                <input type="radio" value="1" name="hot_home" <?php if($hot_home == 1 ) echo 'checked';?> > Có
                                <input type="radio" value="0" name="hot_home" <?php if($hot_home == 0) echo 'checked';?> > Không</td>
                       </tr>
                       
                        <?php if($this->logged_in_user->adminrole->id == 1) { $this->load->view('admin/news/advange_search'); } ?>
                      <tr>	
                                <td><label for="name">Sắp xếp theo : </label></td>
                                <td><select name="arrange_by" class="smallInput" >
                                        <option value="thoigian" <?php if($arrange_by == "thoigian") echo "selected='selected'";?> >Thời gian</option>
                                        <option value="docnhieu"  <?php if($arrange_by == "docnhieu") echo "selected='selected'";?> >Số lượng view</option>
                                    </select>
                                     <input type="radio" name="arrange_direct" value="desc" <?php if($arrange_direct == "desc") echo "checked";?> />Giảm dần
                                     <input type="radio" name="arrange_direct" value="asc" <?php if($arrange_direct == "asc") echo "checked";?> />Tăng dần
                                </td>
                       </tr>
                       <tr>	
                                <td><label for="name" >Hiện mỗi trang : </label></td>
                                <td><select class="smallInput" name="showperpage">
                                        <?php for($k=1;$k<=10;$k++) { ?>
                                        <option value="<?=$k*5;?>" <?php if($showperpage == $k*5) echo "selected='selected'";?> ><?=$k*5;?></option>
                                        <?php } ?>
                                    </select>
                         </td>
                        </tr>
                        
                      </table>
                </td>
         	
       	  </tr>
        </table>
         
         <div class="button_bar">
		 						<?php create_form_button('submit_button button_search','Seach');
	   						  	create_form_button('reset_button button_notok','Xóa');?>
          </div>
    </form>
</div>
<div class="clear"></div>
<?php if(isset($search_result) && $search_result == 1) { $this->load->view('admin/news/search_result'); } ?>