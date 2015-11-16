<header class="navbar navbar-static-top bs-docs-nav navbar-fixed-top" id="top" role="banner">
    <div class="container">
        <div class="row">
            <div class="top-head">
                <a href="<?php echo $base_url; ?>" class="navbar-brand logo-page"><img src="<?php echo $base_url.'images/assets/logo.gif'; ?>" alt=""/></a>
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
                    <?php foreach($this->menu as $rowMenu):?>
                    <li>
                        <a class="alone <?php if($this->menu_active == $rowMenu->active) echo ' black_bg' ;?>" href="<?php echo $base_url.$rowMenu->link?>"><?php echo $rowMenu->name;?></a>
                    </li>
                    <?php endforeach;?>
                </ul>
            </nav>
        </div>
    </div>
</header>