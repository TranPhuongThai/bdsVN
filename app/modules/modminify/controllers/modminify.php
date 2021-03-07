<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modminify extends MX_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->load->library('my_minify');
        $this->my_minify->css_file = 'minify.min.css';
        $this->my_minify->assets_dir = 'public/css';
        $this->my_minify->css(array('css1.css', 'css2.css'));
        //echo $this->my_minify->deploy_css(true);
    }
}