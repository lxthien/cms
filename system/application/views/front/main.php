<!DOCTYPE html>
<html lang="vi">
<?php $this->load->view('front/includes/headerUI'); ?>

<body role="document">
    <?php echo $this->load->view('front/includes/header'); ?>
    <div class="cl"></div>
    <?php echo $this->load->view('front/includes/slide'); ?>
    <div class="cl"></div>
    <?php echo $this->load->view('front/includes/slogan'); ?>
    <div class="cl"></div>
    <div class="container">
        <?php if( $this->menu_active == 'home' ): ?>
            <?php $this->load->view($view); ?>
        <?php else: ?>
            <div class="row" id="wrapper">
                <?php $this->load->view($view); ?>
                <?php $this->load->view('front/includes/col-left'); ?>
            </div>
        <?php endif; ?>
        <div class="cl"></div>
        <?php $this->load->view('front/includes/partner'); ?>
    </div>
    <div class="cl"></div>
    <?php echo $this->load->view('front/includes/footer'); ?>
    <?php echo $this->load->view('front/includes/gototop'); ?>
    <?php $this->load->view('front/includes/footerUI'); ?>
</body>
</html>