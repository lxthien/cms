<div id="right-cata" class="product-grid">
    <div class="wrapper" style="margin-bottom:10px">
    	<?php if( $productCat->isHide == 0 ): ?>
        <div class="category-about tab-item">
            <span class="h2-bg"><?php echo $title_about; ?></span>
            <div class="cl"></div>
            <div class="main-tab-item">
                <?php echo $productCat->txtAbout; ?>
            </div>
            <div class="cl"></div>
            <div class="comment-facebook">
                <div class="fb-comments" migrated="1" data-href="<?php echo $this->uri; ?>" data-width="760" data-numposts="50" data-colorscheme="light"></div>
            </div>
    	</div>
        <div class="category-exterior tab-item">
            <span class="h2-bg">Ngoại thất xe <?php echo $productCat->name; ?></span>
            <div class="cl"></div>
            <div class="main-tab-item">
                <?php echo $productCat->txtExterior; ?>
            </div>
            <div class="cl"></div>
            <div class="comment-facebook">
                <div class="fb-comments" migrated="1" data-href="<?php echo $this->uri; ?>" data-width="760" data-numposts="50" data-colorscheme="light"></div>
            </div>
        </div>
        <div class="category-interior tab-item">
            <span class="h2-bg">Nội thất xe <?php echo $productCat->name; ?></span>
            <div class="cl"></div>
            <div class="main-tab-item">
                <?php echo $productCat->txtInterior; ?>
            </div>
            <div class="cl"></div>
            <div class="comment-facebook">
                <div class="fb-comments" migrated="1" data-href="<?php echo $this->uri; ?>" data-width="760" data-numposts="50" data-colorscheme="light"></div>
            </div>
        </div>
        <div class="category-operation tab-item">
            <span class="h2-bg">Khả năng vận hành của xe <?php echo $productCat->name; ?></span>
            <div class="cl"></div>
            <div class="main-tab-item">
                <?php echo $productCat->txtOperation; ?>
            </div>
            <div class="cl"></div>
            <div class="comment-facebook">
                <div class="fb-comments" migrated="1" data-href="<?php echo $this->uri; ?>" data-width="760" data-numposts="50" data-colorscheme="light"></div>
            </div>
        </div>
        <div class="category-color tab-item">
            <span class="h2-bg">Bảng màu xe <?php echo $productCat->name; ?></span>
            <div class="cl"></div>
            <div class="main-tab-item">
                <?php echo $productCat->txtColor; ?>
            </div>
            <div class="cl"></div>
            <div class="comment-facebook">
                <div class="fb-comments" migrated="1" data-href="<?php echo $this->uri; ?>" data-width="760" data-numposts="50" data-colorscheme="light"></div>
            </div>
        </div>
        <div class="category-video tab-item">
            <span class="h2-bg">Video xe <?php echo $productCat->name; ?></span>
            <div class="cl"></div>
            <div class="main-tab-item">
                <?php echo $productCat->txtVideo; ?>
            </div>
            <div class="cl"></div>
            <div class="comment-facebook">
                <div class="fb-comments" migrated="1" data-href="<?php echo $this->uri; ?>" data-width="760" data-numposts="50" data-colorscheme="light"></div>
            </div>
        </div>
        <div class="category-specification tab-item">
            <span class="h2-bg">Thông số kỹ thuật xe <?php echo $productCat->name; ?></span>
            <div class="cl"></div>
            <div class="main-tab-item">
                <?php echo $productCat->txtSpecification; ?>
            </div>
            <div class="cl"></div>
            <div class="comment-facebook">
                <div class="fb-comments" migrated="1" data-href="<?php echo $this->uri; ?>" data-width="760" data-numposts="50" data-colorscheme="light"></div>
            </div>
        </div>
        <?php endif; ?>
        <div class="list-product tab-item">
            <?php if( $productCat->isHide == 0 ): ?>
                <span class="h2-bg">Giá xe <?php echo $productCat->name; ?></span>
            <?php else: ?>
                <span class="h2-bg">Xe ford cũ - đã qua sử dụng</span>
            <?php endif; ?>
            <?php if($product->result_count() == 0): ?>
                <p class="no-result">Không tìm thấy sản phẩm nào cho danh mục này !</p>
            <?php else: ?>
                <?php foreach($product as $row): ?>
                    <div class="products product_item" style="">
                        <div class="inner-product-home">
                            <a href="<?php echo $base_url.$row->url; ?>">
                                <img src="<?php echo image($row->image, 'product_list'); ?>" alt="<?php echo $row->name; ?>" >
                            </a>
                        </div>
                        <div class="infor-text-pro">
                            <a class="view-more" href="<?php echo $base_url.$row->url; ?>">Xem chi tiết</a>
                            <a title="<?php echo $row->name; ?>" href="<?php echo $base_url.$row->url; ?>"><?php echo $row->name; ?></a>
                            <strong><?php echo $row->getPrice(); ?> VNĐ</strong>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php if( $productCat->isHide == 0 ): ?>
        <div class="category-accessories tab-item">
            <span class="h2-bg">Phụ kiện cho xe <?php echo $productCat->name; ?></span>
            <div class="cl"></div>
            <div class="main-tab-item">
                <?php echo $productCat->txtAccessories; ?>
            </div>
            <div class="cl"></div>
            <div class="comment-facebook">
                <div class="fb-comments" migrated="1" data-href="<?php echo $this->uri; ?>" data-width="760" data-numposts="50" data-colorscheme="light"></div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var tab_in_url = window.location.hash.substr(1);

        if( tab_in_url == '' ){
            $('.tab-item:not(:first)').hide();
        }else{
            switch(tab_in_url) {
                case 'about':
                    var class_div = 'category-about';
                    break;
                case 'exterior':
                    var class_div = 'category-exterior';
                    break;
                case 'interior':
                    var class_div = 'category-interior';
                    break;
                case 'operation':
                    var class_div = 'category-operation';
                    break;
                case 'color':
                    var class_div = 'category-color';
                    break;
                case 'video':
                    var class_div = 'category-video';
                    break;
                case 'specification':
                    var class_div = 'category-specification';
                    break;
                case 'accessories':
                    var class_div = 'category-accessories';
                    break;
                case 'product':
                    var class_div = 'list-product';
                    break;
                default:
                    var class_div = '';
            }
            $('.tab-item:not(".'+class_div+'")').hide();
        }
        
        $('.c-left-cat-properties .cate-list-item a').click(function(e){
            e.preventDefault();

            var div_show = $(this).attr('id');
            $('.product-grid .tab-item').slideUp(300);
            $('.product-grid .tab-item.'+div_show).slideDown(300);
        })
    });
</script>