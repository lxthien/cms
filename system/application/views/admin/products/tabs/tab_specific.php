<div id="productSpecLoad">
<?php if($object->exists() || $productCat->exists()) { ?> 
<?php $this->load->view('admin/products/loadProductSpec');?>
<?php } ?>
</div>