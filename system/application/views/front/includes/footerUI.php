<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo $base_url; ?>images/js/jquery.min.js"></script>
<script src="<?php echo $base_url; ?>images/boostrap/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo $base_url; ?>images/boostrap/js/ie10-viewport-bug-workaround.js"></script>

<!--jQuery caroufredsel-->
<script src="<?php echo $base_url; ?>images/js/jquery.carouFredSel-5.6.4-packed.js"></script>

<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="<?php echo $base_url; ?>images/js/revolution/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>images/js/revolution/jquery.themepunch.revolution.min.js"></script>

<!-- FlexSlider -->
<script defer src="<?php echo $base_url; ?>images/js/flexslider/jquery.flexslider.js"></script>

<!-- Jquery to validator -->
<script type="text/javascript" src="<?=$base_url;?>images/js/jquery.validate.min.js"></script>

<!--Main jquery site app.js-->
<script src="<?php echo $base_url; ?>images/js/app.js"></script>

<script type="text/javascript" src="<?= $base_url?>images/js/nivo-slider/jquery.nivo.slider.js"></script><script type="text/javascript" src="<?= $base_url?>images/js/nivo-slider/jquery.nivo.slider.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider({
            pauseTime: 5000
        });
    });
</script>