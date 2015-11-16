<script type="text/javascript">
$().ready(function(){
   $(".chooseProductCategory").click(function(){
        showProductCategoryDialog();
   }); 
    $(".chooseSpecGroup").click(function(){
        showProductSpecGroupDialog();
   });
    $(".chooseSpec").click(function(){
        showProductSpecDialog();
   });
   $(".chooseManufacture").click(function(){
        showProductManufactureDialog();
   });
   $(".chooseProduct").click(function(){
        showProductDialog();
   });
});

</script>
<?php $this->load->view("admin/layout/dialog/productCategoryDialog");?>
<?php $this->load->view("admin/layout/dialog/productSpecGroupDialog");?>
<?php $this->load->view("admin/layout/dialog/productSpecDialog");?>
<?php $this->load->view("admin/layout/dialog/productManufactureDialog");?>
<?php $this->load->view("admin/layout/dialog/productDialog");?>
<?php $this->load->view("admin/layout/dialog/productMultiSelectDialog");?>