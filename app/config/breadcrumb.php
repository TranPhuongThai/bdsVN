<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['determine'] = "›"; //dấu phân cách giữa các link

$config['exclude'] = array();//Những tham số trên url mà bạn bỏ qua.

$config['segment_exclude'] = array();// Chỉ số segment mà bạn muốn bỏ qua.

$config['wrapper'] = "<ul>|</ul>";

$config['wrapper_inline'] = "<li>|</li>";

/*
Cấu hình css, ở đây mình ví dụ thôi các bạn tùy biến nha
$config['wraper_style'] = array();
*/

$config['enable_last_link'] = false; // Thiết lập tham số cuối ở segment có để link không. Mặc định là false

?>
