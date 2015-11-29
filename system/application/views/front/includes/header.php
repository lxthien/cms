<header class="navbar navbar-static-top bs-docs-nav navbar-fixed-tops" id="top" role="banner">
    <div class="container">
        <div class="row">
            <div class="top-head">
                <!--<div class="logo-sologan">
                    <a href="<?php echo $base_url; ?>" class="navbar-brand logo-page">
                        <img src="<?php echo $base_url.'images/assets/logo.gif'; ?>" alt=""/>
                        <span>Niềm Tin Ngôi Nhà Việt</span>
                    </a>
                </div>
                <div class="company">
                    <p class="first">CÔNG TY TNHH THƯƠNG MẠI - DỊCH VỤ - XÂY DỰNG PHỐ VIỆT</p>
                    <p>Số 52/21, Đường 15, KP.9, P.Bình Hưng Hòa, Q.Bình Tân, TP.HCM</p>
                    <p>Email: xaynhaphoviet@gmail.com</p>
                    <p>Website: www.xaynhaphoviet.com</p>
                </div>
                <div class="hotline">
                    <img src="<?php echo $base_url.'images/assets/icon-phone.gif'; ?>"><br />
                    <span>0903.931.595 A.Tý</span>
                </div>-->
                <img src="<?php echo $base_url.'images/assets/header.gif'; ?>">
            </div>
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>        
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse menu-navigation" role="navigation">
                <ul class="nav navbar-nav">
                    <li><a class="alone <?php if($this->menu_active == "homepage") echo ' black_bg' ;?>" href="<?php echo $base_url; ?>">Trang chủ</a></li>
                    <?php foreach($this->menu as $rowMenu):?>
                    <li><a class="alone <?php if($this->menu_active == $rowMenu->active) echo ' black_bg' ;?>" href="<?php echo $base_url.$rowMenu->link?>"><?php echo $rowMenu->name;?></a></li>
                    <?php endforeach;?>
                </ul>
            </nav>
        </div>
    </div>
</header>