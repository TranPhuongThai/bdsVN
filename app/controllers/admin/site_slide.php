<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_slide extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("msite_slide");
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_slide";
        $data['breadcrumbs'][1]["Name"] = lang('backend.slide');
        
        $data['slide_list'] = $this->msite_slide->getAllData("ASC", 99, 0);
        $this->my_layout->view("backend/site_slide-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_slide";
        $data['breadcrumbs'][1]["Name"] = lang('backend.slide');
        $data['breadcrumbs'][2]["Url"] = "admin/site_slide/add";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $data['slide_list'] = $this->msite_slide->getAllData("DESC", 10, 0);
        
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        $this->form_validation->set_rules("img",lang('backend.img'),"required");
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/site_slide-add",$data);
        }else{
            $add = array(
                    "Name"          => $this->input->post("name"),
                    "Img"           => $this->input->post("img"),
                    "Link"          => $this->input->post("link"),
                    "Content"       => $this->input->post("content"),
                    "Level"         => $this->input->post("level"),
                    "Status"        => $this->input->post("status"),
                 );
            $this->msite_slide->addData($add);
            redirect(base_url()."admin/site_slide");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            $data['slide_check'] = $this->msite_slide->getDataByID($id);
            if($data['slide_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_slide";
                $data['breadcrumbs'][1]["Name"] = lang('backend.slide');
                $data['breadcrumbs'][2]["Url"] = "admin/site_slide/edit/{$data['slide_check']['ID']}";
                $data['breadcrumbs'][2]["Name"] = $data['slide_check']['Name'];
                
                $data['slide_list'] = $this->msite_slide->getAllData("DESC", 10, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("img",lang('backend.img'),"required");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_slide-edit",$data);
                }else{
                    $update = array(
                        "Name"          => $this->input->post("name"),
                        "Img"           => $this->input->post("img"),
                        "Link"          => $this->input->post("link"),
                        "Content"       => $this->input->post("content"),
                        "Level"         => $this->input->post("level"),
                        "Status"        => $this->input->post("status"),
                     );
                    $this->msite_slide->updateData($update, $id);
                    redirect(base_url()."admin/site_slide");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_slide");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_slide");
            exit();
        }
    }
    public function delete($id){
        $this->load->model("msite_slide");
        if(is_numeric($id)){
            $data['slide_check'] = $this->msite_slide->getDataByID($id);
            if($data['slide_check']){
                $this->msite_slide->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_slide");
        exit();
    }
        
}