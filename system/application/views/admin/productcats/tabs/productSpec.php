<div class="portlet">
    <div class="portlet-header fixed"> </div>
    <div class="portlet-content nopadding">
        <form id="frmProductCatSpec" method="post" action="<?=$base_url;?>admin/productcats/updateCatSpecPosition/<?=$object->id;?>" >
        <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
    		<thead>
    			<tr>
                	<th width="32"><a href="#">ID</a></th>
                	<th width="785">Tên</th>
                    <th width="785">Chú thích</th>
                    <th width="135"><div align="center">Position</div></th>
                    <th width="68"><div align="center">Action</div></th>
                </tr>
    		</thead>
    		<tbody>
                <?php $specList = $productcatspec;?>
                <?php $k=0; $i=0; foreach($productcatspec as $row):?>
                    <?php if($row->productgenspec->isGroup == 1) { $i++; ?>
                        <?php $rowId = $row->productgenspec->id;?>
                        <tr>
                            <td><?=$i;?></td>
                            <td><a href="javascript:void(0)" onclick="editSpec(<?=$row->id;?>)"><?=$row->productgenspec->name;?></a></td>
                            <td><?=$row->productgenspec->description;?></td>
                            <td><input name="specPosition_<?=$row->id;?>" value="<?=$row->position;?>" style="width: 80px;"/></td>
                            <td><a href="javascript:void(0)" onclick="deleteCatSpec(<?=$row->id;?>)">Xóa</a></td>
                        </tr>
                          <?php 
                                foreach($object->getSpec() as $spec):?>
                                <?php if($spec->productgenspec->parentcat_id == $rowId) { $i++; ?>
                                    <tr>
                                        <td><?=$i;?></td>
                                        <td><a href="javascript:void(0)" onclick="editSpec(<?=$spec->id;?>)">:......<?=$spec->productgenspec->name;?></a></td>
                                        <td><?=$spec->productgenspec->description;?></td>
                                        <td><input name="specPosition_<?=$spec->id;?>" class="specPosition<?=$i;?>" value="<?=$spec->position;?>" style="width: 80px;"/></td>
                                        <td><a href="javascript:void(0)" onclick="deleteCatSpec(<?=$spec->id;?>)">Xóa</a></td>
                                    </tr>
                            <?php } endforeach;?>  
                    <?php } ?>
                 <?php endforeach;?>
                 
                 <tr>
                	<th width="32"></th>
                	<th width="785"></th>
                    <th width="785"></th>
                    <th width="135"><input type="submit" class="positionUpdate" value="Cập nhật vị trí" /></th>
                    <th width="68"><a href="javascript:void(0)" onclick="deleteAllCatSpec()">Xóa hết</a></th>
                </tr>
            </tbody>
        </table>
        </form>
       
    </div>
</div>