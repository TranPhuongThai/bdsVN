<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Pagecontact extends MX_Controller{

    public function __construct(){

        parent::__construct();

    }

    public function index(){

        $data['menu'] = 12;

        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);
        
        $data['link_canonical'] = '';

        //modules

        $data['zone'] = $this->load->module("zone");

        $data['modcontact'] = $this->load->module("modcontact");
        
        $data['no_index'] = 1;

        $this->load->view("pagecontact/pagecontact-index",$data);

    }

        

}