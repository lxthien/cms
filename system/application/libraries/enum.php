<?php 
class Enum{
   //cart enum
   const CART_WAIT_FOR_PROCESS = 1;//waiting for processing
   const CART_PROCESSING = 2;// processing
   const CART_SENT_MAIL_AND_WAIT_CUSTOMER = 3;//sent mail and waiting for customer responds
   const CART_CANCEL = 4;//CUSTOMER CANCEL
   const CART_DELIVERING = 5;
   const FINISH = 6; 
   
   function getCartStatus($str)
   {
        switch($str)
        {
            case enum::CART_WAIT_FOR_PROCESS: return "Mới nhận";
            case enum::CART_PROCESSING: return "Đang xử lý";
            case enum::CART_SENT_MAIL_AND_WAIT_CUSTOMER:return "Đã gửi mail chờ thanh toán";
            case enum::CART_CANCEL:return "Hủy";
            case enum::CART_DELIVERING:return "Đang giao hàng";
            case enum::FINISH:return "Xử lý xong";
            default: return "Đang chờ xử lý";
        }
   }
    //payment type
   const PAYMENT_AT_STORE = 1;
   const PAYMENT_ONLINE = 2;
   const PAYMENT_BANKING = 3;
   const PAYMENT_ADDRESS = 4;
   function getPaymentMethod($str)
   {
       switch($str)
        {
            case enum::PAYMENT_AT_STORE: return "Thanh toán trực tiếp tại cửa hàng";
            case enum::PAYMENT_ONLINE: return "Thanh toán online";
            case enum::PAYMENT_BANKING:return "Thanh toán qua tài khoản ngân hàng";
            case enum::PAYMENT_ADDRESS:return "Thanh toán tại nơi nhận hàng";
            default: return "Thanh toán trực tiếp tại cửa hàng";
        } 
   }
   //deliver type
   const DELIVER_AT_STORE = 1 ;
   const DELIVER_CUSTOMER = 2;
   
   function getDeliverMethod($str)
   {
       switch($str)
        {
            case enum::DELIVER_AT_STORE: return "Nhận hàng tại cửa hàng";
            case enum::DELIVER_CUSTOMER: return "Nhận hàng tận nơi";
            default: return "Nhận hàng tại cửa hàng";
        } 
   }
   //cart detail status
   const CARTDETAIL_AVAILABLE = 1;
   const CARTDETAIL_UNAVAILABLE = 2;
   function getCartDetailStatus($str)
   {
        switch($str)
        {
            case enum::CARTDETAIL_AVAILABLE: return "Có hàng";
            case enum::CARTDETAIL_UNAVAILABLE: return "Hết hàng";
            default: return "Có hàng";
        }
   }
   
   
   const PRODUCT_WILL_AVAILABLE = 2;
   const PRODUCT_AVAILABLE = 1;
   const PRODUCT_UNAVAILABLE = 3;
   function getProductStatus($str)
   {
        switch($str)
        {
            case enum::PRODUCT_WILL_AVAILABLE: return "Sắp có hàng";
            case enum::PRODUCT_AVAILABLE: return "Đang có hàng";
            case enum::PRODUCT_UNAVAILABLE: return "Hết hàng";
            default: return "Có hàng";
        }
   }
   
   
   const PRODUCT_PRICE_0_1 = 1;
   const PRODUCT_PRICE_1_3 = 2;
   const PRODUCT_PRICE_3_5 = 3;
   const PRODUCT_PRICE_5_10 = 4;
   const PRODUCT_PRICE_10_20 = 5;
   const PRODUCT_PRICE_20_0 = 6;
   
   function getProductPriceArray()
   {
        return array(
            array(
                "name" => "Dưới 1 triệu",
                "value" => enum::PRODUCT_PRICE_0_1
            ),
            array(
                "name" => "Từ 1 - 3 triệu",
                "value" => enum::PRODUCT_PRICE_1_3
            ),
            array(
                "name" => "Từ 3 - 5 triệu",
                "value" => enum::PRODUCT_PRICE_3_5
            ),
            array(
                "name" => "Từ 5 - 10 triệu",
                "value" => enum::PRODUCT_PRICE_5_10
            ),
            array(
                "name" => "Từ 10 - 20 triệu",
                "value" => enum::PRODUCT_PRICE_10_20
            ),
            array(
                "name" => "Trên 20 triệu",
                "value" => enum::PRODUCT_PRICE_20_0
            )
        );
   }
   
   function getProductPriceStart($inp)
   {
        switch($inp)
        {
            case enum::PRODUCT_PRICE_0_1: return 0;
            case enum::PRODUCT_PRICE_1_3: return 1000000;
            case enum::PRODUCT_PRICE_3_5: return 3000000;
            case enum::PRODUCT_PRICE_5_10: return 5000000;
            case enum::PRODUCT_PRICE_10_20: return 10000000;
            case enum::PRODUCT_PRICE_20_0: return 20000000;
            default: return 0;
        }
   }
   
   
   function getProductPriceEnd($inp)
   {
        switch($inp)
        {
            case enum::PRODUCT_PRICE_0_1: return 1000000;
            case enum::PRODUCT_PRICE_1_3: return 3000000;
            case enum::PRODUCT_PRICE_3_5: return 5000000;
            case enum::PRODUCT_PRICE_5_10: return 10000000;
            case enum::PRODUCT_PRICE_10_20: return 20000000;
            case enum::PRODUCT_PRICE_20_0: return 0;
            default: return 0;
        }
   }
   
}