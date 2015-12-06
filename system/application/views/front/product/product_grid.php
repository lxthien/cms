<div class="main">
  <div class="tieude">Sản Phẩm</div>
  <div class="box_list">
    <dl class="products">
      <?php $i=0; foreach($product as $row): $i++; ?>
      <dt>
        <p class="img">
          <span>
            <a href="<?php echo $base_url.$row->url; ?>">
              <img src="<?php echo image($row->image, 'product_list_138_108'); ?>" width="138" height="108" alt="<?php echo $row->name; ?>">
            </a>
          </span>
        </p>
        <p><a href="<?php echo $base_url.$row->url; ?>" tiptitle=""><?php echo $row->name; ?></a></p>
      </dt>
      <?php if($i%3 == 0): ?>
      <dd class="clear"></dd>
      <?php endif; ?>
      <?php endforeach; ?>
    </dl>
    <div class="pages"><span class="selected">1</span>&nbsp;<a href="http://dienlanhtheviet.com.vn/san-pham/2.html"><strong>2</strong></a>&nbsp;<a href="http://dienlanhtheviet.com.vn/san-pham/3.html"><strong>3</strong></a>&nbsp;<a href="http://dienlanhtheviet.com.vn/san-pham/4.html"><strong>4</strong></a>&nbsp;<a href="http://dienlanhtheviet.com.vn/san-pham/5.html"><strong>5</strong></a>&nbsp;<span class="del"><a href="http://dienlanhtheviet.com.vn/san-pham/2.html"><strong>›</strong></a>&nbsp;<a href="http://dienlanhtheviet.com.vn/san-pham/7.html"><strong>»</strong></a>&nbsp;</span></div>  
  </div>
</div>