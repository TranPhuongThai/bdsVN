<?php

/**
 * @author Do Van Tien
 * @Email dovantien2911@gmail.com
 * @Company Webbox
 * @copyright 2012
 */

?>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['mailtype']	= 'html';
$config['protocol']	= 'smtp';
$config['mailpath']	= 'smtp';

/*
$config['smtp_host']	= 'ssl://smtp.gmail.com';
$config['smtp_port']	= '465';
$config['smtp_user']	= 'smtp.datvangbinhduong.vn@gmail.com';
$config['smtp_pass']	= 'UysBmnSY8ApANqtsGr40';
*/

$config['smtp_host']	= 'ssl://smtp.zoho.com';
$config['smtp_port']	= '465';
$config['smtp_user']	= 'noreply@datvangbinhduong.vn';
$config['smtp_pass']	= 'OglpDawwpOQzqm1GQIxH';

$config['smtp_timeout']	= '5';