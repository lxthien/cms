<div class="header reset">
    <div class="logo" id="logo"></div>
    <div class="slogan" id="slogan">
        <img src="<?php echo $base_url.'images/assets/dienlanh/slogan.gif'; ?>" width="729" height="58" alt=""/>
    </div>
    <div class="bn_970x269" id="bn_970x269"></div>
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
    <div id="myslidemenu" class="jqueryslidemenu">
        <ul class="nav">
            <li class="padL_vn">
                <img src="<?php echo $base_url.'images/assets/dienlanh/nav_header_ln.gif'; ?>" width="1" height="44" alt=""/>
            </li>
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
                <select class="input_select" name="value" id="findw">
                    <option value="">Tất cả</option>
                    <option value="40">Sản phẩm mới</option>
                    <option value="17">Sản phẩm cũ</option>
                </select>
            </p>
            <p><input type="text" id="keyword" name="keyword" class="input_txt" value=""/></p>
            <label>Tìm kiếm</label>
            <br class="clear"/>
        </form>
    </div>
    <script language="javascript" type="text/javascript">
        function search_submit() {
            iform = document.id('frmSearch');
            keyword = document.id('keyword').value;
            findw = document.id('findw').value;
            if (findw == '') findw = 'product';
            iform.action = iform.action + '/' + keyword + '/' + findw + '/1';
            alert(iform.action);
            return;
            this.form.submit();
        }
    </script>
</div>