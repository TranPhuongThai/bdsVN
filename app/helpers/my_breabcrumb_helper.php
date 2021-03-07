<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function build_breadcrumb($config = null)
{
    $CI =& get_instance();
    $CI->load->helper('url');
    $CI->config->load('breadcrumb');
    $urlString = $CI->uri->uri_string();
    $determine = empty($config['determine']) ? $CI->config->item('determine') : $config['determine'];
    $exclude = empty($config['exclude']) ? $CI->config->item('exclude') : $config['exclude'];
    $segment_exclude = empty($config['segment_exclude']) ? $CI->config->item('segment_exclude') : $config['segment_exclude'];
    $wrapper = empty($config['wrapper']) ? $CI->config->item('wrapper') : $config['wrapper'];
    $wrapper_inline = empty($config['wrapper_inline']) ? $CI->config->item('wrapper_inline') : $config['wrapper_inline'];
    
    $urlArrays = explode("/", $urlString);
    array_shift($urlArrays);
    $urlArrayTemp1 = Array();
    if(!empty($segment_exclude))
    {    
        for ($i = 0; $i < count($urlArrays); $i ++) 
        {
            if(array_search($i, $segment_exclude) === false)
            {
                $urlArrayTemp1[] = $urlArrays[$i];
            }
        
        }
    }
    else
    {
        $urlArrayTemp1 = $urlArrays;
    }
	foreach($exclude as $exc)
	{
		if(array_search($exc, $urlArrayTemp1) === false)
		{
			unset($urlArrayTemp1[array_search($exc, $urlArrayTemp1)]);
		}
	}
    	// filter number url
	 foreach ($urlArrayTemp1 as $key => $value)
    {
            if (preg_match("/^\d+$/", $value))
            {
                unset($urlArrayTemp1[$key]);
            }
	}
	array_values($urlArrayTemp1);
	// Set wrapper
        $wrapper = $config['wrapper'] || explode("|", $CI->config->item('wrapper'));
        $wrapper_inline = $config['wrapper_inline'] || explode("|", $CI->config->item('wrapper_inline'));
        // Begin writing breadcrumb string
        $str = $wrapper[0].$wrapper_inline[0].anchor('', 'Home').$wrapper_inline[1];
        $segment = '';
        $i = 0;
        $number_array = count($urlArrayTemp1);
        foreach ($urlArrayTemp1 as $value)
        {
            if ($i > 0)
            {
                $segment .= $value.'/';

                    if (strpos($value, "_") OR strpos($value, "-"))
                    {
                        $char_to_replace = array ('_', '-');
                        $value = ucwords(strtolower(str_replace($char_to_replace, " ", $value)));
                    }
                    
                    // enable last segment (optional)
                    if ($i == $number_array-1 && !$CI->config->item('enable_last_segment'))
                    {
                        $str .= $determine.$wrapper_inline[0].ucwords($value).$wrapper_inline[1];
                        break;
                    }
                    $str .= $determine.$wrapper_inline[0].anchor($segment, ucwords($value)).$wrapper_inline[1];
            }
            $i++;
        }
        $str .= $wrapper[1];
        return $str;
    
}
?>
