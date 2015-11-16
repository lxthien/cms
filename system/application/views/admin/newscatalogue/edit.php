<div class="grid_15" id="textcontent"> 
    <form id="form" class="table_input" action="<?=$base_url;?>admin/newscatalogues/edit/<?=$object->id != '' ? $object->id : 0;?>" method="post">
        <label for="name">Tên tiếng việt:</label>
        <input type="text" name="name_vietnamese" value="<?=$object->name_vietnamese;?>" class="smallInput wide" />
        <!--
        <label for="name">Tên tiếng anh:</label>
        <input type="text" name="name_english" value="<?/*=$object->name_english;*/?>" class="smallInput wide" />
        -->
        <label>Tên ko dấu:</label>
        <?=$object->name_none;?>
        <label for="parent">Danh mục cha : </label>
        <select name="parentcat" class="smallInput" >
            <option value="0">Root Catalogue</option>
            <?php foreach($parentcat->all as $row):?>
            <option value="<?=$row->id;?>" <?php if($row->id==$object->parentcat_id) echo "selected='selected'";?> ><?=$row->name_vietnamese;?></option>
            <?php endforeach;?>
        </select>
        <label for="name">Seo Title:</label>
        <input type="text" name="title_bar" value="<?=$object->title_bar;?>" class="smallInput wide" />
        <!-- <label for="name">Slogan:</label>
        <input type="text" name="slogan" value="<?=$object->slogan;?>" class="smallInput wide" /> -->
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