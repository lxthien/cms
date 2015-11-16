<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/
//redirect for old website to new



$route['media/(:any)']              = 'media/resize/$1';
$route['load-so-sanh']              = 'fproduct/loadCompareProductSmall';
$route['so-sanh']                   = 'fproduct/compare';
$route['them-so-sanh/(:any)']       = 'fproduct/addCompareProduct/$1';
//$route['tim-kiem']                  = 'fproduct/search';
//$route['tim-kiem/(:any)']           = 'fproduct/search/$1';
$route['tim']                       = 'fproduct/ajaxSearch';
$route['tim/(:any)']                = 'fproduct/ajaxSearch/$1';
$route['tim-nang-cao']              = 'fproduct/advangeSearch';
$route['tim-nang-cao/(:any)']       = 'fproduct/advangeSearch/$1';
$route['san-pham-giam-gia']         = 'fproduct/saleOffList';
$route['san-pham-giam-gia/(:any)']  = 'fproduct/saleOffList/$1';
$route['fproduct/(:any)']           = 'fproduct/$1';
$route['syn/(:any)']                = 'syn/$1';
$route['dang-ky']                   = 'fuser/regiter';
$route['dang-ky/(:any)']            = 'fuser/regiter/$1';
$route['cua-hang/(:any)']           = 'fproduct/store/$1';
$route['tin-nhan']                  = 'home/messageBox';
$route['kiem-tra-email']            = 'fuser/emailCheck';
$route['kiem-tra-tai-khoan']        = 'fuser/usernameCheck';
$route['quen-mat-khau']             = 'fuser/forgotPassword';
$route['gui-lai-mail-kich-hoat']    = 'fuser/resentEmailActive';
$route['xac-nhan-dang-ky/(:any)']   = 'fuser/mailActive/$1';
$route['dang-nhap']                 = 'fuser/login';
$route['dang-xuat']                 = 'fuser/logout';
$route['tai-khoan']                 = 'fuser/account';
$route['dang-nhap/(:any)']          = 'fuser/login/$1';
$route['chi-tiet-chon/(:any)']      = 'fproduct/choiceDetail/$1';
$route['mua-hang/(:any)']           = 'fproduct/choiceDetail/$1';
$route['gio-hang']                  = 'cart/showCart';
$route['gio-hang/(:any)']           = 'cart/showCart/$1';
$route['them-vao-gio-hang/(:any)']  = 'cart/addCart/$1';
$route['xoa-khoi-gio-hang/(:any)']  = 'cart/deleteCart/$1';
$route['cap-nhat-gio-hang']         = 'cart/updateCart';
$route['huong-dan-mua-hang-tu-xa']  = 'fnews/shopingCartGuide';
$route['chinh-sach-bao-hanh']       = 'fnews/warranty';
$route['tro-giup']                   = 'fnews/helpCenter';


// Router for tag
$route['^tag/(:any)']               		= "home/tags/$1";
$route['^tag']                      		= "home/tags";

// Router for search
$route['^tim-kiem(:any)']                   = "home/searchParams";
$route['^search']                      		= "home/searchs";


$route['default_controller'] 	     		= "home";
$route['scaffolding_trigger'] 	     		= "";
$route['admin']				 	     		="admin/login";
$route['admin/(:any)']				 		="admin/$1";
$route['(:any)']                     		="search";

//$route['^english/(.+)$'] = "$1";
//$route['^vietnamese/(.+)$'] = "$1";




/* End of file routes.php */
/* Location: ./system/application/config/routes.php */