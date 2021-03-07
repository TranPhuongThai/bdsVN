<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Admin_page extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("madmin_static_page");
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/admin_page";
        $data['breadcrumbs'][1]["Name"] = lang('backend.static_page');
        $data['page_list'] = $this->madmin_static_page->getAllData("ASC", 99, 0);
        $this->my_layout->view("backend/admin_page-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/admin_page";
        $data['breadcrumbs'][1]["Name"] = lang('backend.static_page');
        $data['breadcrumbs'][2]["Url"] = "#";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $data['page_list'] = $this->madmin_static_page->getAllData("DESC", 10, 0);
        
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        $this->form_validation->set_rules("content",lang('backend.content'),"required|min_length[10]");
        
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/admin_page-add",$data);
        }else{
            $add = array(
                    "Name"          => $this->input->post("name"),
                    "MainContent"   => $this->input->post("maincontent"),
                    "Content"       => $this->input->post("content"),
                    "Status"        => $this->input->post("status"),
                 );
            $this->madmin_static_page->addData($add);
            redirect(base_url()."admin/admin_page");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){       
            $data['miniTitle'] = lang('backend.edit')." ".lang('backend.static_page');
            
            $data['page_check'] = $this->madmin_static_page->getDataByID($id);
            if($data['page_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/admin_page";
                $data['breadcrumbs'][1]["Name"] = lang('backend.static_page');
                $data['breadcrumbs'][2]["Url"] = "admin/admin_page/edit/".$data['page_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['page_check']['Name'];
                
                $data['page_list'] = $this->madmin_static_page->getAllData("DESC", 10, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("content",lang('backend.content'),"required|min_length[10]");
                
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/admin_page-edit",$data);
                }else{
                    $update = array(
                        "Name"          => $this->input->post("name"),
                        "MainContent"   => $this->input->post("maincontent"),
                        "Content"       => $this->input->post("content"),
                        "Status"        => $this->input->post("status"),
                     );
                    $this->madmin_static_page->updateData($update, $id);
                    redirect(base_url()."admin/admin_page");
                    exit();
                }
            }else{
                redirect(base_url()."admin/admin_page");
                exit();
            }
        }else{
            redirect(base_url()."admin/admin_page");
            exit();
        }
    }
    public function delete($id){
        $this->load->model("madmin_static_page");
        if(is_numeric($id)){
            $data['page_check'] = $this->madmin_static_page->getDataByID($id);
            if($data['page_check']){
                $this->madmin_static_page->deleteData($id);
            }
        } 
        redirect(base_url()."admin/admin_page");
        exit();
    }
        
}