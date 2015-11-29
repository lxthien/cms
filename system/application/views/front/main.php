<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php $this->load->view('front/includes/headerUI'); ?>
    <body>
        <div class="wrapper">
            <?php $this->load->view('front/includes/header'); ?>
            <div class="content reset">
                <?php $this->load->view('front/includes/col-left'); ?>
                <?php $this->load->view($view); ?>
                <?php $this->load->view('front/includes/col-right'); ?>
                <?php $this->load->view('front/includes/partner'); ?>            
            </div>
            <?php $this->load->view('front/includes/footer'); ?>
        </div>
        <script type="text/javascript">
            fn_fixpng();
        </script>
    </body>
</html>