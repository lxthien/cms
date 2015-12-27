<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php $this->load->view('front/includes/headerUI'); ?>
    <body>
        <!-- api facebook -->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.4&appId=1384538691837107";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="sreenwrap" style=" width:980px; margin:0px auto;">
        <!--wrap-->
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