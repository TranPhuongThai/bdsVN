<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('_showMoney'))
{
    function _showMoney($num)
    {
        return number_format($num, 0, ",",".");
    }
}

if ( ! function_exists('_readMoney'))
{
    function _readMoney($num){
        $str = "";
        $ty = 0; $trieu = 0; $tram = 0;
        if(strlen($num) > 9){
            $ty = substr($num, -12, -9);
            $trieu = substr($num, -9, -6);
            $str = "$ty,$trieu Tỷ";
        }elseif(strlen($num) > 6){
            $trieu = substr($num, -9, -6);
            $tram = substr($num, -6, -3);
            $str = "$trieu,$tram Triệu";
        }elseif(strlen($num) > 3){
            $tram = substr($num, -6, -3);
            $str = "$tram Trăm";
        }
        if($str != str_replace(",000", "", $str)){
            $str = str_replace(",000", "", $str);
        }else{
            $str = str_replace("00 ", " ", $str);
            $str = str_replace("0 ", " ", $str);
        }
        return $str;
    }
}

if ( ! function_exists('_subStr'))
{
    function _subStr($str = "", $length, $next = "...")
	{
        $str = strip_tags($str);
        if(strlen($str)<$length) return $str;
        $html = substr($str,0,$length);
        $html = substr($html,0,strrpos($html,' '));
        return $html.$next;
	}
}

if ( ! function_exists('_showAttr'))
{
    function _showAttr($str)
	{
        $str = trim(strip_tags($str));
        return $str;
	}
}

if ( ! function_exists('_setURL'))
{
	function _setURL($str)
	{
		$marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ","ì","í","ị","ỉ","ĩ","ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ","ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ","ỳ","ý","ỵ","ỷ","ỹ","đ","À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ","È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ","Ì","Í","Ị","Ỉ","Ĩ","Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ","Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ","Ỳ","Ý","Ỵ","Ỷ","Ỹ","Đ","-"," ","+","=","@","#","%","*","^","(",")","/","\\","{","}","[","]","?","!","`",'"','.',",",".",";",":","<",">","'","`","!","&","$","&#39;","&quot;");
		$marKoDau=array("a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","e","e","e","e","e","e","e","e","e","e","e","i","i","i","i","i","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","u","u","u","u","u","u","u","u","u","u","u","y","y","y","y","y","d","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","E","E","E","E","E","E","E","E","E","E","E","I","I","I","I","I","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","U","U","U","U","U","U","U","U","U","U","U","Y","Y","Y","Y","Y","D","" ,"-","" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,""  ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,""     ,""      );
        $str = strtolower(str_replace($marTViet  , $marKoDau  , trim($str)));
        /* bắt đầu xóa dấu "-" đầu hoặc cuối chuỗi */
        $str = str_replace("-"," ",$str);
        $str = str_replace(" ","-",trim($str));
        /* kết thúc xóa dấu "-" đầu hoặc cuối chuỗi */
		$marTViet_2=array("----------","---------","--------","-------","------","-----","----","---","--");
		$marKoDau_2=array("-"         ,"-"        ,"-"       ,"-"      ,"-"     ,"-"    ,"-"   ,"-"  ,"-" );
        return strtolower(str_replace($marTViet_2, $marKoDau_2, $str      ));
	}
}
if ( ! function_exists('_plainText'))
{
	function _plainText($str)
	{
        $str = trim(strip_tags($str));
        $marTViet=array("-"," ","+","=","@","#","%","*","^","(",")","{","}","[","]","`",'"',"'",'.',",",".",";",":","<",">","`","!","&","$","&#39;","&quot;");
		$marKoDau=array("-"," ","" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,"" ,""     ,""      );
        $str = str_replace($marTViet  , $marKoDau  , $str);
        return $str;
	}
}
if ( ! function_exists('_breadcrumbs')){
	function _breadcrumbs($breadcrumbs)
	{
	   $str = "";
        if(isset($breadcrumbs) && is_array($breadcrumbs)){ 
            $stt = 1;
            $str .= '<div class="breadcrumbs">';
            foreach($breadcrumbs as $arr){
                if($stt > 1) $str.= " › ";
                $str .= '<a class="item-'.$stt.'" href="'.base_url().$arr['Url'].'">'.$arr['Name'].'</a>';
                $stt++;
            }
            $str .= '</div>';
        } 
        return $str;
    }
}