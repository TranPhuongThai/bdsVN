<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modsupport extends MX_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->load->model("modsupport/mmodsupport_site_support");
        $data['support_list'] = $this->mmodsupport_site_support->getStatusData(1,"ASC",6,0);
        if($data['support_list']){
            $this->load->view("modsupport/modsupport-index",$data);
        }
    }
    public function top(){
        $this->load->model("modsupport/mmodsupport_site_support");
        $data['support_list'] = $this->mmodsupport_site_support->getStatusData(1,"ASC",6,0);
        if($data['support_list']){
            $this->load->view("modsupport/modsupport-top",$data);
        }
    }
        
}