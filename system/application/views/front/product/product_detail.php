<div class="main">
    <script type="text/javascript" src="http://dienlanhtheviet.com.vn/assets/public/the-viet/js/switchtabs.js"></script>
    <script language="javascript">
    $(function() {
        $('.tabs a').switchTab();
    });
    </script>
  
    <div class="tieude">
        <a href="http://dienlanhtheviet.com.vn/san-pham/may-lanh-dan-dung.html">Máy lạnh dân dụng</a>
        <span>&gt;</span>
        <a href="http://dienlanhtheviet.com.vn/san-pham/may-lanh-reetech.html"><?php echo $product->name; ?></a>
    </div>
  
    <div class="box_list">
        <h1><?php echo $product->name; ?></h1>
        <div class="info_products">
            <p class="img"><span><img src="<?php echo image($product->image, 'product_list_138_110'); ?>" width="132" height="131"></span></p>
            <div class="info box_reset">
                <h3><strong><span style="font-size: small;">Tổng quan: </span></strong></h3>
                <ul>
                    <li><span style="font-size: small;">Kiểu máy: <?php echo $product->inBox; ?></span></li>
                    <li><span style="font-size: small;">Xuất xứ: <?php echo $product->color; ?></span></li>
                    <li><span style="font-size: small;">Bảo hành: <?php echo $product->warranty; ?></span></li>
                </ul>
                <h3><span style="font-size: small;"><strong>Tính năng</strong><br><br></span></h3>
                <div class="tinh-nang">
                    <?php echo $product->txtVideo; ?>
                </div>
            </div>
            <br class="clear">
        </div>
        <div class="tabs reset">
            <ul>
                <li><a href="#tongquan" class="selected">Tổng quan</a></li>
                <li><a href="#dactinhkythuat">Đặc tính kỹ thuật</a></li>
            </ul>
            <br class="clear">
        </div>
        <div class="box_reset" id="tongquan">
          <?php echo $product->txtSumary; ?>
        </div>
        <div class="box_reset" id="dactinhkythuat" style="display:none;">
          <?php echo $product->txtDescription; ?>
        </div>
        <div class="ln_end"></div>

        <!-- ORTHER -->
        <h3>Sản phẩm khác</h3>
        <dl class="products">
            <?php $i=0; foreach($sameCategoryProduct as $row): $i++; ?>
            <dt>
                <p class="img">
                    <span>
                        <a href="<?php echo $row->url; ?>">
                            <img src="<?php echo image($row->image, 'product_list_138_108'); ?>" width="148" height="110" alt="<?php echo $row->name; ?>">
                        </a>
                    </span>
                </p>
                <p><a href="<?php echo $row->url; ?>"><?php echo $row->name; ?></a></p>
            </dt>
            <?php if($i%3==0): ?><dd class="clear"></dd><?php endif; ?>
            <?php endforeach; ?>
        </dl>
        <!-- /ORTHER -->
    </div>
</div>