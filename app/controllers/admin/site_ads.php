<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_ads extends Application{
    public function __construct(){
        parent::__construct();
                
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("msite_ads");
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_ads";
        $data['breadcrumbs'][1]["Name"] = lang('backend.ads');
        
        $data['ads_list'] = $this->msite_ads->getAllData("DESC", 99, 0);
        $this->my_layout->view("backend/site_ads-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_ads";
        $data['breadcrumbs'][1]["Name"] = lang('backend.ads');
        $data['breadcrumbs'][2]["Url"] = "#";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $data['ads_list'] = $this->msite_ads->getAllData("DESC", 10, 0);
        
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        $this->form_validation->set_rules("img",lang('backend.img'),"required");
        //$this->form_validation->set_rules("page",lang('backend.page'),"required");
        //$this->form_validation->set_rules("dateset",lang('backend.dateset'),"required");
        //$this->form_validation->set_rules("expired",lang('backend.expired'),"required");
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/site_ads-add",$data);
        }else{
            $add = array(
                    "Name"          => $this->input->post("name"),
                    "Img"           => $this->input->post("img"),
                    "Link"          => $this->input->post("link"),
                    "Level"         => $this->input->post("level"),
                    "Page"          => $this->input->post("page"),
                    "Menu"          => $this->input->post("menu"),
                    "Local"         => $this->input->post("local"),
                    "Hit"           => 1,
                    "Dateset"       => _dateToData($this->input->post("dateset")),
                    "Expired"       => _dateToData($this->input->post("expired")),
                    "Status"        => $this->input->post("status"),
                 );
            $this->msite_ads->addData($add);
            redirect(base_url()."admin/site_ads");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            $this->load->model("msite_ads");
            
            $data['miniTitle'] = lang('backend.edit')." ".lang('backend.ads');
            $data['ads_check'] = $this->msite_ads->getDataByID($id);
            if($data['ads_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_ads";
                $data['breadcrumbs'][1]["Name"] = lang('backend.ads');
                $data['breadcrumbs'][2]["Url"] = "admin/site_ads/edit".$data['ads_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['ads_check']['Name'];
                
                $data['ads_list'] = $this->msite_ads->getAllData("DESC", 10, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("img",lang('backend.img'),"required");
                //$this->form_validation->set_rules("page",lang('backend.page'),"required");
                //$this->form_validation->set_rules("dateset",lang('backend.dateset'),"required");
                //$this->form_validation->set_rules("expired",lang('backend.expired'),"required");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_ads-edit",$data);
                }else{
                    $update = array(
                        "Name"          => $this->input->post("name"),
                        "Img"           => $this->input->post("img"),
                        "Link"          => $this->input->post("link"),
                        "Level"         => $this->input->post("level"),
                        "Page"          => $this->input->post("page"),
                        "Menu"          => $this->input->post("menu"),
                        "Local"         => $this->input->post("local"),
                        "Dateset"       => _dateToData($this->input->post("dateset")),
                        "Expired"       => _dateToData($this->input->post("expired")),
                        "Status"        => $this->input->post("status"),
                     );
                    $this->msite_ads->updateData($update, $id);
                    redirect(base_url()."admin/site_ads");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_ads");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_ads");
            exit();
        }
    }
    public function delete($id){
        $this->load->model("msite_ads");
        
        if(is_numeric($id)){
            $data['ads_check'] = $this->msite_ads->getDataByID($id);
            if($data['ads_check']){
                $this->msite_ads->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_ads");
        exit();
    }
        
}