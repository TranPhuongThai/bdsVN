<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_add_nation extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("msite_add_nation");
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_add_nation";
        $data['breadcrumbs'][1]["Name"] = lang('backend.nation');
        
        $data['nation_list'] = $this->msite_add_nation->getAllData("ASC", 99, 0);
        $this->my_layout->view("backend/site_add_nation-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_add_nation";
        $data['breadcrumbs'][1]["Name"] = lang('backend.nation');
        $data['breadcrumbs'][2]["Url"] = "#";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $data['nation_list'] = $this->msite_add_nation->getAllData("DESC", 10, 0);
        
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/site_add_nation-add",$data);
        }else{
            $add = array(
                    "Name"          => $this->input->post("name"),
                    "Code"          => $this->input->post("code"),
                    "Status"        => $this->input->post("status"),
                 );
            $this->msite_add_nation->addData($add);
            redirect(base_url()."admin/site_add_nation");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            $data['nation_check'] = $this->msite_add_nation->getDataByID($id);
            if($data['nation_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_add_nation";
                $data['breadcrumbs'][1]["Name"] = lang('backend.nation');
                $data['breadcrumbs'][2]["Url"] = "admin/site_add_nation/edit/".$data['nation_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['nation_check']['Name'];
                
                $data['nation_list'] = $this->msite_add_nation->getAllData("DESC", 10, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_add_nation-edit",$data);
                }else{
                    $update = array(
                        "Name"          => $this->input->post("name"),
                        "Code"          => $this->input->post("code"),
                        "Status"        => $this->input->post("status"),
                     );
                    $this->msite_add_nation->updateData($update, $id);
                    redirect(base_url()."admin/site_add_nation");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_add_nation");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_add_nation");
            exit();
        }
    }
    public function delete($id){
        /*
        $this->load->model("msite_add_nation");
        if(is_numeric($id)){
            $data['nation_check'] = $this->msite_add_nation->getDataByID($id);
            if($data['nation_check']){
                $this->msite_add_nation->deleteData($id);
            }
        } 
        */
        redirect(base_url()."admin/site_add_nation");
        exit();
    }
        
}