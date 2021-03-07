<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Pagetext extends MX_Controller{

    public function __construct(){

        parent::__construct();

    }

    public function index($id = 1, $menu = 0){

        $data['id']     = $id;

        $data['menu']   = $menu;

        $data['seo']    = $this->my_site_menu->_loadSeoText($id);
        
        $data['link_canonical'] = '';

        //modules

        $data['zone'] = $this->load->module("zone");

        $data['modtext'] = $this->load->module("modtext");

        $data['modreal'] = $this->load->module("modreal");

        $data['modnews'] = $this->load->module("modnews");

        $data['modads'] = $this->load->module("modads");

        $data['modslide'] = $this->load->module("modslide");

        $data['modsupport'] = $this->load->module("modsupport");

        $data['moduser'] = $this->load->module("moduser");

        $this->load->view("pagetext/pagetext-index",$data);

    }

        

}