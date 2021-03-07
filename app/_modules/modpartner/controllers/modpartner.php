<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modpartner extends MX_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        echo "Hello world!";
    }
    public function partnerList(){
        $this->load->model("modpartner/mmodpartner_site_partner"); 
        $data['partner_list'] = $this->mmodpartner_site_partner->getStatusData(1, "ASC", 99, 0);
        if($data['partner_list']){
            $this->load->view("modpartner/modpartner-partnerList",$data);
        }
    }
    public function partnerSlide(){
        $this->load->model("modpartner/mmodpartner_site_partner"); 
        $data['partner_list'] = $this->mmodpartner_site_partner->getStatusData(1, "ASC", 99, 0);
        if($data['partner_list']){
            $this->load->view("modpartner/modpartner-partnerSlide",$data);
        }
    }
}