<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_config extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("msite_config"));
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_config";
        $data['breadcrumbs'][1]["Name"] = lang('backend.config');
        
        $data['config_list'] = $this->msite_config->getAllData("ASC", 99, 0);
        $this->my_layout->view("backend/site_config-index",$data);
    }
    public function edit($id){
        if(is_numeric($id)){
            $data['config_check'] = $this->msite_config->getDataByID($id);
            if($data['config_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_config";
                $data['breadcrumbs'][1]["Name"] = lang('backend.config');
                $data['breadcrumbs'][2]["Url"] = "#";
                $data['breadcrumbs'][2]["Name"] = $data['config_check']['Name'];
        
                $data['config_list'] = $this->msite_config->getAllData("ASC", 10, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("content",lang('backend.content'),"required");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_config-edit", $data);            
                }else{
                    $update = array(
                            "Name"      => $this->input->post("name"),
                            "Content"   => $this->input->post("content"),
                            "Guide"     => $this->input->post("guide"),
                         );
                    $this->msite_config->updateData($update,$id);
                    redirect(base_url()."admin/site_config"); 
                }
            }else{
                redirect(base_url()."admin/site_config");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_config");
            exit();
        }
    }
        
}