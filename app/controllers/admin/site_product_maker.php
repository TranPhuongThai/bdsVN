<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_product_maker extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("msite_product_maker");
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_product_maker";
        $data['breadcrumbs'][1]["Name"] = lang('backend.maker');
        
        $data['maker_list'] = $this->msite_product_maker->getAllData("ASC", 99, 0);
        $this->my_layout->view("backend/site_product_maker-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_product_maker";
        $data['breadcrumbs'][1]["Name"] = lang('backend.maker');
        $data['breadcrumbs'][2]["Url"] = "admin/site_product_maker/add";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $data['maker_list'] = $this->msite_product_maker->getAllData("DESC", 10, 0);
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/site_product_maker-add",$data);
        }else{
            $add = array(
                    "Name"          => $this->input->post("name"),
                    "Img"           => $this->input->post("img"),
                    "Level"         => $this->input->post("level"),
                    "Status"        => $this->input->post("status"),
                 );
            $this->msite_product_maker->addData($add);
            redirect(base_url()."admin/site_product_maker");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            $data['maker_check'] = $this->msite_product_maker->getDataByID($id);
            if($data['maker_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_product_maker";
                $data['breadcrumbs'][1]["Name"] = lang('backend.maker');
                $data['breadcrumbs'][2]["Url"] = "admin/site_product_maker/edit/".$data['maker_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['maker_check']['Name'];
        
                $data['maker_list'] = $this->msite_product_maker->getAllData("DESC", 10, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");           
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_product_maker-edit",$data);
                }else{
                    $update = array(
                        "Name"          => $this->input->post("name"),
                        "Img"           => $this->input->post("img"),
                        "Level"         => $this->input->post("level"),
                        "Status"        => $this->input->post("status"),
                     );
                    $this->msite_product_maker->updateData($update, $id);
                    redirect(base_url()."admin/site_product_maker");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_product_maker");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_product_maker");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['maker_check'] = $this->msite_product_maker->getDataByID($id);
            if($data['maker_check']){
                $this->msite_product_maker->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_product_maker");
        exit();
    }
        
}