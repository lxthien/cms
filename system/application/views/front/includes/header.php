<div class="header reset">
    <div class="logo" id="logo">
        <a href="<?php echo $base_url ?>"><img src="<?php echo $base_url.'images/assets/dienlanh/logo.gif'; ?>"></a>
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
                                            <img src="<?= image($row->image, 'slide_home'); ?>" alt="<?php echo $row->name_vietnamese; ?>" />
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

    <script type="text/javascript" src="<?= $base_url?>images/js/nivo-slider/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider({
                pauseTime: 5000
            });
        });
    </script>
    <!--
    <script type="text/javascript">
        var logo = new SWFObject("http://dienlanhtheviet.com.vn/assets/public/the-viet/images/logo_104x95.swf", "vidPlayer", "104", "95", "0", "");
        logo.addParam("wmode", "transparent");
        logo.write("logo");
        /*var slogan = new SWFObject("http://dienlanhtheviet.com.vn/assets/public/the-viet/images/slogan.swf", "vidPlayer", "730", "60", "0", "");
         slogan.addParam("wmode","transparent");
         slogan.write("slogan");*/
        var bn_970x269 = new SWFObject("http://dienlanhtheviet.com.vn/assets/public/the-viet/images/bn_970x269.swf", "vidPlayer", "970", "269", "0", "");
        bn_970x269.addParam("wmode", "transparent");
        bn_970x269.addVariable('varXML', 'http://dienlanhtheviet.com.vn/flash.xml?' + rnd());
        bn_970x269.write("bn_970x269");

        function search() {
            var frm = document.getElementById('frmSearch');
            frm.submit();
        }
    </script>
    -->
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