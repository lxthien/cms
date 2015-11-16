<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


function getChildProduct($product,$productAll,$limit = 0,$condition = "")
{
    $childProduct = array();
    foreach($productAll as $row)
    {
        //print($row->parentcat_id."-".$product."</br>");
        if($row->parentcat_id == $product)
        {
            $cloneitem =$row->get_clone();
            if($condition == "")
            {
                array_push($childProduct,$cloneitem);    
            }
            else
            {
            
                if($row->{$condition} == 1)
                    array_push($childProduct,$cloneitem);
            }                        
            if($limit !=0 && count($childProduct) > $limit)
               return $childProduct; 
        }
        
    }
    
    return $childProduct;
    
}
function printProductList($product)
{
    $CI =& get_instance();
    $output  =  '<div class="l_row">';
	$output .=		'<div class="img fl">';
    if($product->isNew == 1) { $output .= '<img class="pp_new" src="'.base_url().'images/new.png" alt="Hàng mới về" />'; } 
    if($product->isUsed == 1) { $output .= '<img class="pp_secondhand_3" src="'.base_url().'images/secondhand.png" alt="Đã qua sử dung" />'; }
    if($product->isGift == 1) { $output .= '<img class="pp_gift_3" src="'.base_url().'images/gift.png" alt="Quà tặng" />'; }
    if($product->status == enum::PRODUCT_UNAVAILABLE) { $output .= '<img class="pp_outOfStock" src="'.base_url().'images/outOfStock.png" alt="Hết hàng hoặc chưa có hàng" />'; }
    if($product->status == enum::PRODUCT_WILL_AVAILABLE) { $output .= '<img class="pp_comingSoon" src="'.base_url().'images/comingSoon.png" alt="Sắp có hàng" />'; }
	$output .=			'<div><a href="'.base_url().$product->url.'" title="'.$product->getName().'"><img src="'.image($product->image, "product_grid").'" alt="'.$product->getName().'" alt="'.$product->getName().'" /></a></div>';
	$output .=			'<div><input type="checkbox" autocomplete="off" name="chk_'.$product->id.'" class="chkCompareProduct" value="'.$product->id.'" ';
    //if(in_array($product->id,$CI->compareArray)) {
   //     $output .=          ' checked="checked" ';    
    //}
    
    $output .=          ' /> So sánh<br /></div>';
	$output .=		'</div>';
	$output .=		'<div class="main_txt fl">';
	$output .=			'<div><a href="'.base_url().$product->url.'" title="'.$product->getName().'" title="'.$product->getName().'"><h4 class="grid_p_title dark_blue">'.$product->getName().'</h4></a></div>';
	$output .=			'<div>';
//	$output .=				'<a href=""><span><img src="'.base_url().'images/5stars.png" /></span><span> (302 lượt xem)</span></a>';
	$output .=			'</div>';
	$output .=			'<p>'.$product->txtDescription;
	$output .=			'</p>';
    if($product->getSalePrice() != 0){
	   $output .=			'<div><span class="dark_blue">'.$product->getPriceText().':</span>&nbsp;<span class="g_price_official'.(($product->isLinePrice == 1)?" line_through":"").'">'.$product->getPrice().' VND</span></div>';
	   $output .=			'<div><span class="dark_blue">'.$product->getPriceSaleOffText().':</span>&nbsp;<span class="g_price_official '.(($product->isLinePriceSaleOff == 1)?" line_through":"").'">'.$product->getSalePrice().' VND</span></div>';
    }
    else
    {
        $output .=			'<div><span class="dark_blue">'.$product->getPriceText().':</span>&nbsp;<span class="g_price_official '.(($product->isLinePrice == 1)?" line_through":"").'">'.$product->getPrice().' VND</span></div>';
	   
    }
	
	$output .=			'<div class="r_txt"><a href="'.base_url().'them-vao-gio-hang/'.$product->id.'" title="Thêm vào giỏ hàng"><img src="'.base_url().'images/list_buy.png" alt="Thêm vào giỏ hàng" /></a></div>';
	$output .=		'</div>';
    if(trim($product->promotion != ""))
    {
	$output .=		'<div class="list_promotion fr">';
	$output .=			'<div class="g_price_official">Khuyến mãi sản phẩm</div>';
	$output .=			'<div class="g_price_promotion">';
	$output .=			$product->promotion;
	$output .=			'</div>';	
	$output .=		'</div>';
    }
	$output .=		'<div class="clr"></div>';
	$output .=	'</div>';
    return $output;
}

function printProductGrid($product)
{
    $CI =& get_instance();
    $output =   '<div class="g_p">';
	$output .=			'<a href="'.base_url().$product->url.'" title="'.$product->getName().'">';
	$output .=				'<div class="pp_gird_img">';
    if($product->isNew == 1) { $output .= '<img class="pp_new" src="'.base_url().'images/new.png" alt="Sản phẩm mới có hàng" />'; } 
    if($product->isUsed == 1) { $output .= '<img class="pp_secondhand_3" src="'.base_url().'images/secondhand.png" alt="Sản phẩm đã qua sử dụng" />'; }
    if($product->isGift == 1) { $output .= '<img class="pp_gift_3" src="'.base_url().'images/gift.png" atl="Sản phẩm có quà tặng" />'; }
    if($product->status == enum::PRODUCT_UNAVAILABLE) { $output .= '<img class="pp_outOfStock" src="'.base_url().'images/outOfStock.png" alt="Hết hàng hoặc chưa có hàng" />'; }
    if($product->status == enum::PRODUCT_WILL_AVAILABLE) { $output .= '<img class="pp_comingSoon" src="'.base_url().'images/comingSoon.png" alt="Sắp có hàng" />'; }
	$output .=					'<img src="'.image($product->image, "product_grid").'" alt="'.$product->getName().'" />';
	$output .=				'</div>';
	$output .=			'</a>';
	$output .=			'<a href="'.base_url().$product->url.'" title="'.$product->getName().'"><h4 class="grid_p_title dark_blue">'.$product->getName().'</h4></a>';
    $output .=          '<div style="height: 42px" >';
	
    if($product->getSalePrice() != 0){
        $output .=			'     <div><span class="dark_blue">'.$product->getPriceText().':</span>&nbsp;<span class="g_price_official '.(($product->isLinePrice == 1)?" line_through":"").'">'.$product->getPrice().' VNĐ</span></div>';
	   $output .=			'     <div><span class="dark_blue">'.$product->getPriceSaleOffText().':</span>&nbsp;<span class="g_price_official '.(($product->isLinePriceSaleOff == 1)?" line_through":"").'">'.$product->getSalePrice().' VNĐ</span></div>';
    }
    else
    {
        $output .=			'     <div><span class="dark_blue">'.$product->getPriceText().':</span>&nbsp;<span class="g_price_official '.(($product->isLinePrice == 1)?" line_through":"").'">'.$product->getPrice().' VNĐ</span></div>';
    }
    $output .=			'</div>';
	$output .=			'<div>';
	//$output .=				'<span><img src="'.base_url().'images/5stars.png" /></span><span> (302 lượt xem)</span>';
	$output .=			'</div>';
	$output .=			'<div><a href="'.base_url().'them-vao-gio-hang/'.$product->id.'" title="Thêm vào giỏ hàng" ><img src="'.base_url().'images/list_buy.png" alt="Thêm vào giỏ hàng"  /></a></div>';
	$output .=			'<div><input type="checkbox" autocomplete="off" name="chk_'.$product->id.'" class="chkCompareProduct" value="'.$product->id.'" ';
    //if(in_array($product->id,$CI->compareArray)) {
    //    $output .=          ' checked="checked" ';    
    //}
    
    $output .=          '/> So sánh<br /></div>';
    
	$output .=		'</div>';
    return $output;
}

function printProduct($product)
{
    $output = '<div class="pp fl">';
    $output .= '<div class="pp_pad">';
    if($product->isNew == 1) { $output .= '<img class="pp_new" src="'.base_url().'images/new.png" alt="Sản phẩm mới có hàng"  />'; } 
    if($product->isUsed == 1) { $output .= '<img class="pp_secondhand_2" src="'.base_url().'images/secondhand.png" alt="Sản phẩm đã qua sử dụng" />'; }
    if($product->isGift == 1) { $output .= '<img class="pp_gift" src="'.base_url().'images/gift.png"  atl="Sản phẩm có quà tặng" />'; }
    if($product->status == enum::PRODUCT_UNAVAILABLE) { $output .= '<img class="pp_outOfStock" src="'.base_url().'images/outOfStock.png" alt="Hết hàng hoặc chưa có hàng" />'; }
    if($product->status == enum::PRODUCT_WILL_AVAILABLE) { $output .= '<img class="pp_comingSoon" src="'.base_url().'images/comingSoon.png" alt="Sắp có hàng" />'; }
	$output .= 	'<div class="img">';
    $output .=  '<a href="'.base_url().$product->url.'" title="'.$product->getName().'">';
    $output .=  '<img src="'.image($product->image, "product_home").'" alt="'.$product->getName().'" />';
    $output .=  '</a>';
    $output .=  '</div>';	
    $output .=  '<div class="p_info"><a href="'.base_url().$product->url.'" title="'.$product->getName().'" >'.$product->getName().'</a></div>';
    $output .=  '<div class="p_price">'.$product->getRealPrice().' VNĐ</div>';
    $output .=  '</div>';
    $output .=  '</div>';
    
    return $output;
}