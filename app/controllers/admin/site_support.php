<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_support extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("msite_support");
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_support";
        $data['breadcrumbs'][1]["Name"] = lang('backend.support_online');
        
        $data['support_list'] = $this->msite_support->getAllData("ASC", 99, 0);
        $this->my_layout->view("backend/site_support-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_support";
        $data['breadcrumbs'][1]["Name"] = lang('backend.support_online');
        $data['breadcrumbs'][2]["Url"] = "admin/site_support/add";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $data['support_list'] = $this->msite_support->getAllData("DESC", 10, 0);
        
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        $this->form_validation->set_rules("phone",lang('backend.phone'),"required");
        //$this->form_validation->set_rules("yahoo",lang('backend.yahoo'),"required");
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/site_support-add",$data);
        }else{
            $add = array(
                    "Name"          => $this->input->post("name"),
                    "Phone"         => $this->input->post("phone"),
                    "Yahoo"         => $this->input->post("yahoo"),
                    "Skype"         => $this->input->post("skype"),
                    "Email"         => $this->input->post("email"),
                    "type"          => $this->input->post("type"),
                    "Level"         => $this->input->post("level"),
                    "Status"        => $this->input->post("status"),
                 );
            $this->msite_support->addData($add);
            redirect(base_url()."admin/site_support");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            $data['support_check'] = $this->msite_support->getDataByID($id);
            if($data['support_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_support";
                $data['breadcrumbs'][1]["Name"] = lang('backend.support_online');
                $data['breadcrumbs'][2]["Url"] = "admin/site_support/edit/{$data['support_check']['ID']}";
                $data['breadcrumbs'][2]["Name"] = $data['support_check']['Name'];
                
                $data['support_list'] = $this->msite_support->getAllData("DESC", 10, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("phone",lang('backend.phone'),"required");
                //$this->form_validation->set_rules("yahoo",lang('backend.yahoo'),"required");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_support-edit",$data);
                }else{
                    $update = array(
                        "Name"          => $this->input->post("name"),
                        "Phone"         => $this->input->post("phone"),
                        "Yahoo"         => $this->input->post("yahoo"),
                        "Skype"         => $this->input->post("skype"),
                        "Email"         => $this->input->post("email"),
                        "type"          => $this->input->post("type"),
                        "Level"         => $this->input->post("level"),
                        "Status"        => $this->input->post("status"),
                     );
                    $this->msite_support->updateData($update, $id);
                    redirect(base_url()."admin/site_support");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_support");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_support");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['support_check'] = $this->msite_support->getDataByID($id);
            if($data['support_check']){
                $this->msite_support->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_support");
        exit();
    }
        
}