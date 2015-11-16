<div style="width:300px;  padding: 10px;" >
 <form method="post" action="<?=$this->admin_url;?>cnews/copy_2_cat/<?=$object->id;?>">
	<div align="center"><h2><strong>Copy</strong></h2><br></div>
    <table width="100%" class="table_input">
    	<tr>
        	<td width="49%"><div align="left">Danh mục: </div></td>
            <td width="51%">
            <?php
			$cat = new Newscatalogue();
			$cat->where('parentcat_id !=','NULL');
			$cat->get_iterated();?>
            	<select name="copy_newscatalogue" class="smallInput">
                 				<option value="0"  >Tất cả</option>
									<?php foreach($cat as $row): ?>
                              			  <option value="<?=$row->id;?>"  ><?php echo $row->name_vietnamese;?></option>
                                	<?php endforeach;?>
								</select>
            </td>
        </tr>
        <tr>
        	<td><div align="left">Hình thức: </div></td>
            <td><input type="radio" name="copy_type" value="copy" checked >Copy<input type="radio" name="copy_type" value="move"  >Move</td>
        </tr>
        <tr>
        	<td><div align="left">Số lượng: </div></td>
            <td><input type="text" name="copy_amount" value="1" >
           </td>
        </tr>
        <tr>
        	<td colspan="2"><div align="center"><input type="submit" value="Thực hiện" /></div></td>
        </tr>
    </table>
   </form>
	
</div>