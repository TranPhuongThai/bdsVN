<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('_checkThumbImg'))
{
    function _checkThumbImg($img)
    {
        $sizeImg = getimagesize($img);
        if(is_array($sizeImg)){
            $pos = strrpos($img,"/");
            $thumbSrc = substr($img,0,$pos)."/mcith/mcith_".substr($img,$pos+1);
            $sizeThumb = getimagesize($thumbSrc);
            if(is_array($sizeThumb)){
                return $thumbSrc;
            }
        }
        return $img;
    }
}
if ( ! function_exists('_showAds'))
{
    function _showAds($url, $link="", $title="", $width=null, $height = null){
        if(strrchr($url, ".") == ".swf"){
            $str = '
                    <a href="'.$link.'" width="'.$width.'px" height="'.$height.'px" target="_blank" title="'.$title.'" ref="nofollow">
                       <object border="0" class="view-count" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000">
                           <param value="'.$url.'" name="movie">
                           <param value="always" name="AllowScriptAccess">
                           <param value="High" name="quality">
                           <param value="transparent" name="wmode">
                           <embed allowscriptaccess="always" width="'.$width.'px" height="'.$height.'px" wmode="transparent" loop="true" play="true" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" src="'.$url.'">
                       </object>
                    </a>
                   ';
                        
        }else{
            $str = '
                	<a href="'.$link.'" target="_blank" title="'.$title.'" ref="nofollow">
                    	<img src="'.$url.'" alt="'.$title.'" width="'.$width.'px"/>
                    </a>
                   ';
        }
        return $str;
    } 
}