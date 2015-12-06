<div class="grid_15" id="textcontent"> 
    <form id="form" class="table_input" action="<?=$base_url;?>admin/newscatalogues/edit/<?=$object->id != '' ? $object->id : 0;?>" method="post" enctype="multipart/form-data">
        <label for="name">Tên tiếng việt:</label>
        <input type="text" name="name_vietnamese" value="<?=$object->name_vietnamese;?>" class="smallInput wide" />
        <label>Url:</label>
        <?=$object->name_none?>
        <?php if($object->image != NULL): ?>
        <label for="name">Hình ảnh đã chọn:</label>
        <img class="smallInput small" src="<?php echo $base_url.$object->image; ?>" style="width: 100px;" />
        <?php endif; ?>
        <label for="name">Hình ảnh hiển thị:</label>
        <input type="file" name="image" class="smallInput medium" />
        <label for="name">Mô tả:</label>
        <textarea style="height: 60px;" name="description" class="smallInput wide"><?=$object->description;?></textarea>
        <label for="name">Dạng hiển thị:</label>
        <label><input <?php echo $object->show == 0 ? '' : 'checked="checked"'; ?> type="radio" name="show" value="0" class="smallInput" /> Hiển thị danh mục</label>
        <label><input <?php echo $object->show != 0 ? '' : 'checked="checked"'; ?> type="radio" name="show" value="1" class="smallInput" /> Hiển thị bài viết</label>
        <label for="parent">Danh mục cha : </label>
        <select name="parentcat" class="smallInput" >
            <option value="0">Root Catalogue</option>
            <?php foreach($parentcat->all as $row):?>
            <option value="<?=$row->id;?>" <?php if($row->id==$object->parentcat_id) echo "selected='selected'";?> ><?=$row->name_vietnamese;?></option>
            <?php endforeach;?>
        </select>
        <label for="name">Seo Title:</label>
        <input type="text" name="title_bar" value="<?=$object->title_bar;?>" class="smallInput wide" />
        <label for="name">Seo Description:</label>
        <textarea style="height: 60px;" name="slogan" class="smallInput wide"><?=$object->slogan;?></textarea>
        <label for="name">Seo Keyword:</label>
        <input type="text" name="keyword" value="<?=$object->keyword;?>" class="smallInput wide" />
        <label for="name">Group:</label>
        <input type="text" name="group" value="<?=$object->group;?>" class="smallInput wide" />
        <?php if($this->logged_in_user->adminrole->id == 1){ ?>
            <label for="name">Navigation:</label>
            <input type="text" name="navigation" value="<?=$object->navigation;?>" class="smallInput wide" />
            <label for="name">Menu actives:</label>
            <input type="text" name="menu_active" value="<?=$object->menu_active;?>" class="smallInput wide" />
        <?php  } ?>
        <div class="button_bar">
            <?php create_form_button('submit_button button_ok','Lưu dữ liệu');?>
            <div class="clear"></div>
        </div>
    </form>
</div>