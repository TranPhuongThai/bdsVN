<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_add_province extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("msite_add_province","msite_add_nation"));
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_add_province";
        $data['breadcrumbs'][1]["Name"] = lang('backend.province');
        
        $data['province_list'] = $this->msite_add_province->getAllData("ASC", 99, 0);
        $this->my_layout->view("backend/site_add_province-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_add_province";
        $data['breadcrumbs'][1]["Name"] = lang('backend.province');
        $data['breadcrumbs'][2]["Url"] = "#";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $data['nation_list'] = $this->msite_add_nation->getAllData("DESC", 10, 0);
        $data['province_list'] = $this->msite_add_province->getAllData("DESC", 10, 0);
                
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/site_add_province-add",$data);
        }else{
            $add = array(
                    "Name"          => $this->input->post("name"),
                    "Level"         => $this->input->post("level"),
                    "Nation"        => $this->input->post("nation"),
                    "Status"        => $this->input->post("status"),
                 );
            $this->msite_add_province->addData($add);
            redirect(base_url()."admin/site_add_province");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            $data['province_check'] = $this->msite_add_province->getDataByID($id);
            if($data['province_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_add_province";
                $data['breadcrumbs'][1]["Name"] = lang('backend.province');
                $data['breadcrumbs'][2]["Url"] = "admin/site_add_province/edit/".$data['province_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['province_check']['Name'];
                
                $data['nation_list'] = $this->msite_add_nation->getAllData("DESC", 10, 0);
                $data['province_list'] = $this->msite_add_province->getAllData("DESC", 10, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_add_province-edit",$data);
                }else{
                    $update = array(
                        "Name"          => $this->input->post("name"),
                        "Level"         => $this->input->post("level"),
                        "Nation"        => $this->input->post("nation"),
                        "Status"        => $this->input->post("status"),
                     );
                    $this->msite_add_province->updateData($update, $id);
                    redirect(base_url()."admin/site_add_province");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_add_province");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_add_province");
            exit();
        }
    }
    public function delete($id){
        $this->load->model("msite_add_province");
        if(is_numeric($id)){
            $data['province_check'] = $this->msite_add_province->getDataByID($id);
            if($data['province_check']){
                $this->msite_add_province->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_add_province");
        exit();
    }
        
}