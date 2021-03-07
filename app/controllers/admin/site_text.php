<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_text extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("msite_text");
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_text";
        $data['breadcrumbs'][1]["Name"] = lang('backend.text');
        
        $data['text_list'] = $this->msite_text->getAllData("ASC", 99, 0);
        $this->my_layout->view("backend/site_text-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_text";
        $data['breadcrumbs'][1]["Name"] = lang('backend.text');
        $data['breadcrumbs'][2]["Url"] = "admin/site_text/add";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $data['text_list'] = $this->msite_text->getAllData("DESC", 10, 0);
        
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        $this->form_validation->set_rules("content",lang('backend.content'),"required");
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/site_text-add",$data);
        }else{
            $add = array(
                    "Name"          => $this->input->post("name"),
                    "MainContent"   => $this->input->post("maincontent"),
                    "Content"       => $this->input->post("content"),
                    "Status"        => $this->input->post("status"),
                 );
            $this->msite_text->addData($add);
            redirect(base_url()."admin/site_text");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){            
            $data['text_check'] = $this->msite_text->getDataByID($id);
            if($data['text_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_text";
                $data['breadcrumbs'][1]["Name"] = lang('backend.text');
                $data['breadcrumbs'][2]["Url"] = "admin/site_text/edit/".$data['text_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['text_check']['Name'];
        
                $data['text_list'] = $this->msite_text->getAllData("DESC", 10, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("content",lang('backend.content'),"required");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_text-edit",$data);
                }else{
                    $update = array(
                        "Name"          => $this->input->post("name"),
                        "MainContent"   => $this->input->post("maincontent"),
                        "Content"       => $this->input->post("content"),
                        "Status"        => $this->input->post("status"),
                     );
                    $this->msite_text->updateData($update, $id);
                    redirect(base_url()."admin/site_text");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_text");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_text");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['text_check'] = $this->msite_text->getDataByID($id);
            if($data['text_check']){
                $this->msite_text->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_text");
        exit();
    }
        
}