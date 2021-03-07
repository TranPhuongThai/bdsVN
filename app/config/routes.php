<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* config */

$route['user/edit/(:num)']          = "pageuser/edit/$1";
$route['user/delete/(:num)']        = "moduser/delete/$1";
$route['user/real/(:num)']  = "pageuser/real";
$route['user/real']         = "pageuser/real";
$route['user/add']          = "pageuser/add";

$route['user/info']         = "pageuser/info";
$route['user/changepass']   = "pageuser/changepass";

$route['kich-hoat-tai-khoan']         = "pageuser/active";

$route['dang-xuat']     = "moduser/logout";
$route['quen-mat-khau'] = "moduser/reset";
$route['dang-nhap']     = "moduser/login";
$route['dang-ky']       = "moduser/register";


$route['(:any)-news-(:num).html(:any)']     = "pagenews/detail/$2";
$route['(:any)-news-(:num).html']           = "pagenews/detail/$2";
$route['(:any)-mnews-(:num).html(:any)']    = "pagenews/menu/$2";
$route['(:any)-mnews-(:num).html']          = "pagenews/menu/$2";

$route['tim-nha-dat-binh-duong/(:any)/(:num)/(:num)/(:num)/(:num)/(:num)/(:num)/(:num)']      = "pagereal/search/$1/$2/$3/$4/$5/$6/$7";
$route['tim-nha-dat-binh-duong/(:any)/(:num)/(:num)/(:num)/(:num)/(:num)/(:num)']      = "pagereal/search/$1/$2/$3/$4/$5/$6/$7";
$route['tim-nha-dat-binh-duong?(:any)']      = "pagereal/search";


$route['(:any)-real-(:num).html/(:any)']     = "pagereal/detail/$2";
$route['(:any)-real-(:num).html']           = "pagereal/detail/$2";
$route['(:any)-rm-(:num).html/(:num)']       = "pagereal/menu/$2";
$route['(:any)-rm-(:num).html']             = "pagereal/menu/$2";
$route['(:any)-rd-(:num).html/(:num)']       = "pagereal/district/$2";
$route['(:any)-rd-(:num).html']             = "pagereal/district/$2";

$route['dat-ban-binh-duong/(:num)']            = "pagereal/type/2";
$route['dat-ban-binh-duong']                   = "pagereal/type/2";
$route['nha-ban-binh-duong/(:num)']            = "pagereal/type/1";
$route['nha-ban-binh-duong']                   = "pagereal/type/1";

$route['mua-ban-nha-dat-binh-duong/(:num)']            = "pagereal/index/$1";
$route['mua-ban-nha-dat-binh-duong']                   = "pagereal/index";


$route['gioi-thieu']                        = "pagetext/index/3/0";
$route['gioi-thieu/(:any)']                 = "pagetext/index/3/0";
$route['tuyen-dung']                        = "pagetext/index/5/0";
$route['tuyen-dung/(:any)']                 = "pagetext/index/5/0";
$route['lien-he']                           = "pagecontact/index";
$route['lien-he/(:any)']                    = "pagecontact/index";

$route['default_controller']    = "pagehome";
$route['404_override']          = 'pagehome/error';
