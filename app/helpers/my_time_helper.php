<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('_DateToData'))
{
    function _dateToData($Date = "00/00/0000")//dd/mm/yyyy to yyyy-mm-dd
	{
		list($d, $m, $y) = preg_split('/\//', $Date);
		return sprintf('%04d-%02d-%02d', $y, $m, $d);
	}
}
if ( ! function_exists('_DateTimeToDataTime'))
{
    function _DateTimeToDataTime($Date = "00/00/0000 00:00:00")//dd/mm/yyyy HH:ii:ss to yyyy-mm-dd HH:ii:ss
	{
        if(strlen($Date)<10)
            $Date = "00/00/0000 00:00:00";
        list($d, $m, $y) = preg_split('/\//', $Date);
		list($y, $h) = preg_split('/(\s)/', $y);
		list($h, $i, $s) = preg_split('/:/', $h);
		return sprintf('%04d-%02d-%02d %02d:%02d:%02d', $y, $m, $d, $h, $i, $s);
	}
}
if ( ! function_exists('_addDate'))
{
    function _addDate($Date, $day) // 12/01/2012 + 3 = 15/05/2012
    {
        list($d, $m, $y) = preg_split('/\//', $Date);
        return date("Y-m-d",mktime(0, 0, 0, $m, $d + $day, $y));
    }
}
if ( ! function_exists('_dataToDate'))
{
    function _dataToDate($Date = "0000-00-00") //yyyy-mm-dd to dd/mm/yyyy
    {
        list($y, $m, $d) = preg_split('/-/', $Date);
        return sprintf('%02d/%02d/%04d', $d, $m, $y);
    }
}
if ( ! function_exists('_DataTimeToDateTime'))
{
    function _DataTimeToDateTime($Date = "0000-00-00 00:00:00")//yyyy-mm-dd HH:ii:ss to dd/mm/yyyy HH:ii:ss
	{
        if(strlen($Date)<19)
            $Date = "0000-00-00 00:00:00";
        list($y, $m, $d) = preg_split('/-/', $Date);
		list($d, $h) = preg_split('/(\s)/', $d);
		list($h, $i, $s) = preg_split('/:/', $h);
		return sprintf('%02d/%02d/%04d %02d:%02d:%02d', $d, $m, $y, $h, $i, $s);
	}
}
if ( ! function_exists('_DataTimeToDateTime_2'))
{
    function _DataTimeToDateTime_2($Date = "0000-00-00 00:00:00")//yyyy-mm-dd HH:ii:ss to  HH:ii dd/mm/yyyy
	{
        if(strlen($Date)<19)
            $Date = "0000-00-00 00:00:00";
        list($y, $m, $d) = preg_split('/-/', $Date);
		list($d, $h) = preg_split('/(\s)/', $d);
		list($h, $i, $s) = preg_split('/:/', $h);
		return sprintf('%02d:%02d %02d/%02d/%04d', $h, $i, $d, $m, $y);
	}
}
if ( ! function_exists('_subDate'))
{
    function _subDate($Date1, $Date2) // 2012-01-15 - 2012-01-12 = 3
    {
        list($y1, $m1, $d1) = preg_split('/-/', $Date1);
        list($y2, $m2, $d2) = preg_split('/-/', $Date2);
        return (mktime(0, 0, 0, $m2, $d2, $y2) - mktime(0, 0, 0, $m1, $d1, $y1)) / (24 * 3600);
    }
}
if ( ! function_exists('_calcElapsedTime'))
{
    function _calcElapsedTime($timeVar) 
    {
        $time = strtotime($timeVar);
        $diff = time()-$time;
        $yearsDiff = floor($diff/60/60/24/365);
        $diff -= $yearsDiff*60*60*24*365;
        $monthsDiff = floor($diff/60/60/24/30);
        $diff -= $monthsDiff*60*60*24*30;
        $weeksDiff = floor($diff/60/60/24/7);
        $diff -= $weeksDiff*60*60*24*7;
        $daysDiff = floor($diff/60/60/24);
        $diff -= $daysDiff*60*60*24;
        $hrsDiff = floor($diff/60/60);
        $diff -= $hrsDiff*60*60;
        $minsDiff = floor($diff/60);
        $diff -= $minsDiff*60;
        $secsDiff = $diff;
        if($yearsDiff)
            return $yearsDiff." năm trước";
        elseif($monthsDiff)
            return $monthsDiff." tháng trước";
        elseif($weeksDiff)
            return $weeksDiff." tuần trước";
        elseif($daysDiff)
            return $daysDiff." ngày trước";
        elseif($hrsDiff)
            return $hrsDiff." giờ trước";
        elseif($minsDiff)
            return $minsDiff." phút trước";
        elseif($secsDiff)
            return $secsDiff." giây trước";
        return (''.$yearsDiff.' year'.(($yearsDiff <> 1) ? "s" : "").', '.$monthsDiff.' month'.(($monthsDiff <> 1) ? "s" : "").', '.$weeksDiff.' week'.(($weeksDiff <> 1) ? "s" : "").', '.$daysDiff.' day'.(($daysDiff <> 1) ? "s" : "").', '.$hrsDiff.' hour'.(($hrsDiff <> 1) ? "s" : "").', '.$minsDiff.' minute'.(($minsDiff <> 1) ? "s" : "").', '.$secsDiff.' second'.(($secsDiff <> 1) ? "s" : "").'');
    }
}