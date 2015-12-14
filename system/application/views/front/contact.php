<div class="col-md-9 col-right">
    <?php $this->load->view('front/includes/breadcrumb'); ?>
    <div class="cl"></div>

    <h1 class="name-cat" itemprop="name"><?php echo $cat_name; ?></h1>
    <div class="cl"></div>

    <div class="content">
        <?php echo $news->full_vietnamese; ?>
    </div>
    <div class="cl"></div>
    <div class="form-contact">
        <form id="myformContact" action="<?php echo $base_url.'lien-he'; ?>" method="post">
            <?php if( isset($msg) ): ?>
            <div class="block row">
                <p class="col-md-12 center block"><?php echo $msg; ?></p>
            </div>
            <?php endif; ?>
            <div class="block row">
                <span class="block bold col-md-2">Tiêu đề:</span>
                <div class="col-md-10">
                    <div class="row">
                        <input class="col-md-12" type="text" name="title" placeholder="Tiêu đề"/>
                    </div>
                </div>
            </div>
            <div class="block row">
                <span class="block bold col-md-2">Email:</span>
                <div class="col-md-10">
                    <div class="row">
                        <input class="col-md-12" type="text" name="email" placeholder="Email"/>
                    </div>
                </div>
            </div>
            <div class="block row">
                <span class="block bold col-md-2">Tên:</span>
                <div class="col-md-10">
                    <div class="row">
                        <input class="col-md-12" type="text" name="name" placeholder="Tên"/>
                    </div>
                </div>
            </div>
            <div class="block row">
                <span class="block bold col-md-2">Điện thoại:</span>
                <div class="col-md-10">
                    <div class="row">
                        <input class="col-md-12" type="text" name="phone" placeholder="Điện thoại"/>
                    </div>
                </div>
            </div>
            <div class="block row">
                <span class="block bold col-md-2">Địa chỉ:</span>
                <div class="col-md-10">
                    <div class="row">
                        <input class="col-md-12" type="text" name="address" placeholder="Địa chỉ"/>
                    </div>
                </div>
            </div>
            <div class="block row">
                <span class="block bold col-md-2">Nội dung:</span>
                <div class="col-md-10">
                    <div class="row">
                        <textarea class="col-md-12" name="content" placeholder="Nội dung"></textarea>
                    </div>
                </div>
            </div>
            <div class="block row">
                <div class="col-md-2">&nbsp;</div>
                <div class="col-md-10">
                    <div class="row">
                        <input class="btn-submit" type="submit" value="Gửi"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>