<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_online extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->models(array("mwb_online","mwb_statistics", "mwb_user"));
        
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_online";
        $data['breadcrumbs'][1]["Name"] = lang('backend.statistics');   
        
        $data['online'] = $this->mwb_online->countOnline();
        $data['online_today'] = $this->mwb_statistics->getToDayOnline();
        $data['online_this_month'] = $this->mwb_statistics->getThisMonthOnline();
        $data['online_sum'] = $this->mwb_statistics->getSumOnline();
        
        $config['base_url'] = base_url("admin/site_online/index");
        $config['total_rows'] = $this->mwb_online->countAllData();
        $config['per_page'] = 30; 
        $config['uri_segment'] = 4;
        
        $this->pagination->initialize($config);
        $data['online_list'] = $this->mwb_online->getOnline("ASC", $config['per_page'], $this->uri->segment(4));
        $this->my_layout->view("backend/site_online-index",$data);
    }
        
}