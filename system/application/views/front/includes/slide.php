<div class="slider container">
    <div class="row">
        <div class="tp-banner">
            <ul>
                <?php foreach($this->banner as $row) :?>
                <li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-thumb="<?php echo $base_url ?>images/slider/homeslider_thumb1.jpg"
                    data-saveperformance="on" data-title="Intro Slide">
                    <img src="<?php echo $base_url ?>images/slider/dummy.png" alt="" data-lazyload="<?= image($row->image, 'slide_home'); ?>" data-bgposition="center top"
                         data-bgfit="cover" data-bgrepeat="no-repeat">
                </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>