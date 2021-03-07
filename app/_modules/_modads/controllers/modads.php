<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modads extends MX_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        echo "Hello world!";
    }
    public function detail($id){
        $this->load->model("modads/mmodads_site_ads"); 
        $data['ads_list'] = $this->mmodads_site_ads->getDataByID($id);
        if($data['ads_list']){
            $this->load->view("modads/modads-detail",$data);
        }
    }
}