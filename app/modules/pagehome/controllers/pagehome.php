<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Pagehome extends MX_Controller{

    public function __construct(){

        parent::__construct();

    }

    public function index(){

        $data['menu'] = 1;

        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);

        //modules

        $data['zone'] = $this->load->module("zone");

        $data['modtext'] = $this->load->module("modtext");

        $data['modreal'] = $this->load->module("modreal");

        $data['modnews'] = $this->load->module("modnews");

        $data['modads'] = $this->load->module("modads");

        $data['modslide'] = $this->load->module("modslide");

        $data['modsupport'] = $this->load->module("modsupport");

        $data['moduser'] = $this->load->module("moduser");

        $this->load->view("pagehome/pagehome-index",$data);

    }
    
    public function error(){

        $data['menu'] = 0;

        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);

        //modules

        $data['zone'] = $this->load->module("zone");

        $data['modtext'] = $this->load->module("modtext");

        $data['modreal'] = $this->load->module("modreal");

        $data['modnews'] = $this->load->module("modnews");
        
        $data['no_index'] = 1;

        $this->load->view("pagehome/pagehome-error",$data);
    }

        

}