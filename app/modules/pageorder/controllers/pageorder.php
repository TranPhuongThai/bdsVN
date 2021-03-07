<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pageorder extends MX_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $data['menu'] = 5;
        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);
        //modules
        $data['zone'] = $this->load->module("zone");
        $data['modcontact'] = $this->load->module("modcontact");
        $this->load->view("pageorder/pageorder-index",$data);
    }
        
}