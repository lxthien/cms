<div class="header reset">
    <div class="logo" id="logo"></div>
    <div class="slogan" id="slogan">
        <img src="<?php echo $base_url.'images/assets/dienlanh/slogan.gif'; ?>" width="729" height="58" alt=""/>
    </div>
    <div class="bn_970x269" id="bn_970x269">
        <div class="slider">
            <div class="slide">
                <div class="main-slide">
                    <div class="main-lide-images">
                        <div id="wrapper">
                            <div class="slider-wrapper theme-default">
                                <div id="slider" class="nivoSlider">
                                    <?php foreach($this->banner as $row) :?>
                                        <a href="<?=$row->link?>" title="<?php echo $row->name_vietnamese; ?>">
                                            <img src="<?= $base_url.$row->image?>" alt="<?php echo $row->name_vietnamese; ?>" />
                                        </a>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myslidemenu" class="jqueryslidemenu">
        <ul class="nav">
            <li class="padL_vn"><img src="<?php echo $base_url.'images/assets/dienlanh/nav_header_ln.gif'; ?>" width="1" height="44" alt=""/></li>
            <li><a href="<?php echo $base_url; ?>">Trang chủ</a></li>
            <?php foreach($this->menu as $rowMenu):?>
            <li class="<?php if($this->menu_active == $rowMenu->active) echo ' act' ;?>">
                <a href="<?php echo $base_url.$rowMenu->link?>"><?php echo $rowMenu->name;?></a>
                <?php $countChild = $rowMenu->menuItem->result_count();?>
                <?php if($countChild > 0) { ?>
                    <ul>
                        <?php foreach($rowMenu->menuItem->all as $row): ?>               
                            <li><a href="<?php echo $base_url.$row->link?>"><?php echo $row->name;?></a></li>
                        <?php endforeach;?>
                    </ul>
                <?php } ?>
            </li>
            <?php endforeach;?>
            <li><img src="<?php echo $base_url.'images/assets/dienlanh/nav_header_ln.gif'; ?>" width="1" height="44" alt=""/></li>
        </ul>
    </div>
    <br class="clear"/>
    <script language="javascript" type="text/javascript">
        function SendFormSearch() {
            if (!jQuery.trim($("#keyword").val())) {
                err = 'Thông tin cần tìm';
                alert('Quý khách cần nhập các thông tin sau: \n' + err);
                $("#keyword").val('')
                $("#keyword").focus();
                return false;
            }

            action = document.frmSearch.action;
            document.frmSearch.action = action;

            document.frmSearch.submit();
        }
    </script>

    <div class="box_search">
        <form action="<?php echo $base_url.'tim-kiem'; ?>" method="post" name="frmSearch" id="frmSearch">
            <p class="btn_red"><a href="javascript:void(0)" onclick="return SendFormSearch();"><strong>Tìm</strong></a></p>
            <p>
                <select class="input_select" name="type" id="findw">
                    <option value="81">Tất cả</option>
                    <option value="300">Sản phẩm mới</option>
                    <option value="301">Sản phẩm cũ</option>
                </select>
            </p>
            <p><input type="text" id="keyword" name="keyword" class="input_txt" value=""/></p>
            <label>Tìm kiếm</label>
            <br class="clear"/>
        </form>
    </div>
</div>