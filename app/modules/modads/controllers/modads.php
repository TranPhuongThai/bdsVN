<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modads extends MX_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        echo "Hello world!";
    }
    public function detail($id, $type = ''){
        $this->load->model("modads/mmodads_site_ads"); 
        $data['ads_list'] = $this->mmodads_site_ads->getDataByID($id);
        $data['type'] = $type;
        if($data['ads_list']){
            $this->load->view("modads/modads-detail",$data);
        }
    }
    public function local($local, $record_number = 1, $record_start = 0, $width = null, $height = null){
        $this->load->model("modads/mmodads_site_ads"); 
        $data['local'] = $local;
        $data['width'] = $width;
        $data['height'] = $height;
        $data['ads_list'] = $this->mmodads_site_ads->getDataByLocal($local, $record_number, $record_start);
        if($data['ads_list']){
            $this->load->view("modads/modads-local",$data);
        }
    }
}