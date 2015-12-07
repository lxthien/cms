<div style="position: relative;">
    <h2>Thông tin chung</h2>
    <table class="table_input">
        <tr>
            <td><label for="name">Kích hoạt:</label></td>
            <td><input <?php if($object->active==1) echo 'checked="checked"' ?> name="isActive" type="checkbox" value="1" /></td>
        </tr>
        <tr>
            <td><label for="name">Hình đại diện:</label></td>
            <td><input name="logo" type="file" /></td>
        </tr>
        <tr >
            <td>
            <label for="name">Danh mục:</label></td>
            <td>
                <div><a href="javascript:void(0)" class="addCategory">Thêm danh mục</a></div>
                <div id="categoryArea">
                    <?php $i=0; foreach($productCat as $row): $i++;?>
                    <div class="categoryItem" style="clear:both;padding-top:5px;" >
                        <input type="text" class="smallInput medium" readonly="readonly" name="productCategory_<?=$i;?>" value="<?=$row->name;?>" style="float:left;" />
                        <input type="hidden" name="productCategoryId_<?=$i;?>" value="<?=$row->id;?>"  />
                        <a style="margin-left:10px;" href="javascript:void(0)" onclick="showProductCategoryDialog('productCategory_<?=$i;?>','productCategoryId_<?=$i;?>')"  >Chọn</a> |
                        <a href="javascript:void(0)" class="loadSpecByCategory" > Load thông số |</a>
                        <a href="javascript:void(0)" class="delelteCategory" >Xóa</a>
                    </div>
                    <?php endforeach;?>
                </div>
            </td>
        </tr>
        <!-- <tr>
            <td>
            <label for="name">Nhà sản xuất:</label></td>
            <td>

                <input type="text" readonly="readonly" name="productManufacture" value="<?=$object->productmanufacture->name;?>" style="float:left;" />
                <input type="hidden" name="productManufactureId" value="<?=$object->productmanufacture->id;?>"  />
                <a href="javascript:void(0)" class="chooseManufacture" >Chọn từ danh sách</a>
            </td>
        </tr> -->
        <!-- <tr>
            <td>
                <label for="name">Xuất xứ/VAT:</label></td>
            <td><input  type="text" id="origin"  class="smallInput medium fl"  name="origin" value="<?=$object->origin;?>" /></td>
        </tr>

        <tr>
            <td>
                <label for="name">Màu sắc:</label></td>
            <td><input  type="text" id="color"  class="smallInput medium fl"  name="color" value="<?=$object->color;?>" /></td>
        </tr>
        <tr>
            <td><label for="name">Nguyên hộp gồm có:</label></td>
            <td><textarea  name="inBox"  class="smallInput medium" /><?=$object->inBox;?></textarea></td>
        </tr> -->
        <tr>
            <td><label for="name">Kiểu máy:</label></td>
            <td><input type="text" name="inBox"  class="smallInput medium fl" value="<?=$object->inBox;?>" /></td>
        </tr>
        <tr>
            <td><label for="name">Xuất xứ:</label></td>
            <td><input  type="text" id="color"  class="smallInput medium fl"  name="color" value="<?=$object->color;?>" /></td>
        </tr>
        <tr>
            <td><label for="name">Bảo hành:</label></td>
            <td><input  type="text" id="warranty"  class="smallInput medium fl"  name="warranty" value="<?=$object->warranty;?>" /></td>
        </tr>
        <tr>
            <td>
                <label for="name">Giá chính thức:<span style="color: red;">*</span></label>
                    <span class="spanPrice"></span></td>
            <td>
                <input  type="text" id="price"  class="smallInput small fl" style="width: 100px;" name="price" value="<?=$object->price;?>" />
                <span class="fl" style="padding-left:5px;padding-right: 5px;">Hiển thị:</span>
                <input  type="text" id="priceText"  class="smallInput medium fl" style="width: 200px;"  name="priceText" value="<?=$object->priceText;?>" />
                <span class="fl" style="padding-left:5px;padding-right: 5px;">Gạch ngang:</span>
                <input type="checkbox" class="fl" name="isLinePrice" value="1" <?php if($object->isLinePrice == 1) echo 'checked="checked"';?> />
                <span class="fl" style="padding-left:5px;padding-right: 0px;">Màu:</span>
              <input type="text" name="priceColor" class="smallInput small fl" style="width: 100px;" value="<?=$object->priceColor;?>"  />
                <label for="price" generated="true" style="display: block;padding-top: 5px;clear: both;" class="error"></label>
            </td>
        </tr>
        <tr id="saleOffPrice" style="height:60px;">
            <td><label for="name">Giá trả trước:</label>
                <!-- <span>(dùng thanh toán online)</span> -->
                <span class="spanSaleOffPrice"></span>
            </td>
            <td>
            <input  type="text" name="saleOffPrice" class="smallInput small fl" style="width: 100px;" value="<?=$object->saleOffPrice?>" />
            <span class="fl" style="padding-left:5px;padding-right: 5px;">Hiển thị:</span>
            <input  type="text" name="saleOffPriceText" style="width: 200px;"  class="smallInput medium fl" value="<?=$object->saleOffPriceText?>" />
            <span class="fl" style="padding-left:5px;padding-right: 5px;">Gạch ngang:</span>
            <input class="fl" type="checkbox" name="isLinePriceSaleOff" value="1" <?php if($object->isLinePriceSaleOff == 1) echo 'checked="checked"';?> />
            <span class="fl" style="padding-left:5px;padding-right: 0px;">Màu:</span>
            <input type="text" name="saleOffPriceColor" class="smallInput small fl" style="width: 100px;" value="<?=$object->saleOffPriceColor;?>"  />
            <label for="saleOffPrice" generated="true" style="display: block;padding-top: 5px;clear: both;" class="error"></label>
            </td>
        </tr>
            
        <!-- <tr>
            <td><label for="name">Giảm giá:</label></td>
            <td><input <?php if($object->isSale==1) echo 'checked="checked"' ?> name="isSale" type="checkbox"  value="1" /></td>
        </tr> -->
        <!--<tr>
            <td><label for="name">Hàng mới về:</label></td>
            <td><input <?php /*if($object->isNew==1) echo 'checked="checked"' */?> name="isNew" type="checkbox" value="1" /></td>
        </tr>-->
        <!-- <tr>
            <td><label for="name">Có quà tặng(Gift):</label></td>
            <td><input <?php if($object->isGift==1) echo 'checked="checked"' ?> name="isGift" type="checkbox" value="1" /></td>
        </tr>
        <tr>
            <td><label for="name">Hàng đã sử dụng(Used):</label></td>
            <td><input <?php if($object->isUsed==1) echo 'checked="checked"' ?> name="isUsed" type="checkbox"  value="1" /></td>
        </tr> -->
        <tr>
            <td><label for="name">Sản phẩm hot:</label></td>
            <td><input <?php if($object->isHot==1) echo 'checked="checked"' ?> name="isHot" type="checkbox" value="1" /></td>
        </tr>

        <tr>
            <td><label for="name">SEO - title:</label></td>
            <td><input type="text" name="seo_title" value="<?=$object->seo_title;?>" class="smallInput big" /></td>
        </tr>
        <tr>
            <td><label for="name">SEO - Description:</label></td>
            <td><textarea style="height: 80px;" name="seo_description"  class="smallInput big"><?=$object->seo_description;?></textarea></td>
        </tr>
        <tr>
            <td><label for="name">SEO - Keyword:</label></td>
            <td><textarea style="height: 50px;" name="seo_keyword"  class="smallInput big"><?=$object->seo_keyword;?></textarea></td>
        </tr>
        <!-- <tr>
            <td><label for="name">Search Key:</label></td>
            <td><textarea  name="searchKey"  class="smallInput big"><?=$object->searchKey;?></textarea></td>
        </tr> -->
        <?php if($object->exists()){?>
        <tr>
            <td><label for="name">Người tạo:</label></td>
            <td><?=$object->creator;?>(<?=get_date_from_sql($object->created);?>)</td>
        </tr>
        <tr>
            <td><label for="name">Người cập nhật cuối:</label></td>
            <td><?=$object->updator;?>(<?=get_date_from_sql($object->updated);?>)</td>
        </tr>
        <?php } ?>
    </table>
</div>