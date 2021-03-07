<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_upload_file extends CI_Session
{
    var $CI;
    var $_model;
    
    public function __construct(){
        parent::__construct();
        $CI =& get_instance();
        
        $this->obj = $CI;
        $this->obj->load->database();
        $this->obj->load->model(array("mwb_user","mwb_tuser"));
    }
    public function watermark($fileName){
        $config['image_library']    = 'gd2';
        $config['source_image']     = $fileName;
        $config['wm_type']          = 'overlay';
        $config['wm_overlay_path']  = './public/template-tiendv/image/datvang-2.png'; //the overlay image
        $config['wm_opacity']       = 60;
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'right';
        
        $this->obj->load->library('image_lib',$config);
        $this->obj->image_lib->initialize($config);
        if (!$this->obj->image_lib->watermark()) {
            //echo 'A--'.$this->obj->image_lib->display_errors();exit;
        }
        $this->obj->image_lib->clear();
        return $fileName;
    }
    public function resize($fileName){
        // thumb
        $r = strrpos($fileName,'/')+1;
        $thumb = substr($fileName,0,$r).'mcith_'.substr($fileName,$r);
        $config = array();
        $config['image_library'] = 'gd2';
        $config['source_image']	= $fileName;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['new_image']    = $thumb;
        $config['width']	= 400;
        $config['height']	= 300;
        
        $this->obj->load->library('image_lib',$config);
        $this->obj->image_lib->initialize($config); 
        if (!$this->obj->image_lib->resize()) {
            //echo 'B--'.$this->obj->image_lib->display_errors();exit;
        }
        $this->obj->image_lib->clear();
        return $thumb;
    }
}