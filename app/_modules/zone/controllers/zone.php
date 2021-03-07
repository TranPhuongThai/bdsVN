<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Zone extends MX_Controller{

    public function __construct(){

        parent::__construct();

    }

    public function head($data){

        $data['modonline'] = $this->load->module("modonline");

        $data['modonline']->statistics();

        $this->load->view("zone/zone-head",$data);

    }

    public function top($menu = 1){

        $data['menu'] = $menu;

        $data['modsupport'] = $this->load->module("modsupport");

        $data['modtext'] = $this->load->module("modtext");

        $data['modads'] = $this->load->module("modads");

        $data['modmenu'] = $this->load->module("modmenu");

        $data['modslide'] = $this->load->module("modslide");

        $this->load->view("zone/zone-top",$data);

    }

    public function slide(){

        $data['modslide'] = $this->load->module("modslide");

        $data['modreal'] = $this->load->module("modreal");

        $data['modnews'] = $this->load->module("modnews");

        $this->load->view("zone/zone-slide",$data);

    }

    public function bot(){

        $data['modtext'] = $this->load->module("modtext");

        $data['modmaker']= $this->load->module("modmaker");

        $data['modmenu'] = $this->load->module("modmenu");

        $data['modads'] = $this->load->module("modads");

        $this->load->view("zone/zone-bot",$data);

    }

    public function left(){

        $data['modreal'] = $this->load->module("modreal");

        $data['modtext'] = $this->load->module("modtext");

        $data['modsupport'] = $this->load->module("modsupport");

        $data['modnews']    = $this->load->module("modnews");

        $data['modads'] = $this->load->module("modads");

        $data['modonline'] = $this->load->module("modonline");

        $this->load->view("zone/zone-left",$data);

    }

    public function right(){

        $data['modreal'] = $this->load->module("modreal");

        $data['modtext'] = $this->load->module("modtext");

        $data['modsupport'] = $this->load->module("modsupport");

        $data['modnews']    = $this->load->module("modnews");

        $data['modads'] = $this->load->module("modads");

        $data['modonline'] = $this->load->module("modonline");

        $this->load->view("zone/zone-right",$data);

    }

    public function right2(){

        $data['modreal'] = $this->load->module("modreal");

        $data['modtext'] = $this->load->module("modtext");

        $data['modsupport'] = $this->load->module("modsupport");

        $data['modnews']    = $this->load->module("modnews");

        $data['modads'] = $this->load->module("modads");

        $data['modonline'] = $this->load->module("modonline");

        $this->load->view("zone/zone-right2",$data);

    }


    public function right3(){

        $data['modreal'] = $this->load->module("modreal");

        $data['modtext'] = $this->load->module("modtext");

        $data['modsupport'] = $this->load->module("modsupport");

        $data['modnews']    = $this->load->module("modnews");

        $data['modads'] = $this->load->module("modads");

        $data['modonline'] = $this->load->module("modonline");

        $this->load->view("zone/zone-right3",$data);

    }

        

}