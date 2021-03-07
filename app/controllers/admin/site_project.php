<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_project extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("msite_project");
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_project";
        $data['breadcrumbs'][1]["Name"] = lang('backend.project');
        
        $config['base_url'] = base_url("admin/site_project/index");
        $config['total_rows'] = $this->msite_project->countAllData();
        $config['per_page'] = 10; 
        $config['uri_segment'] = 5;
        $this->pagination->initialize($config);
        
        $data['name'] = "";
        $data['project_list'] = $this->msite_project->getAllData("ASC", $config['per_page'], $this->uri->segment(5));
        
        $this->my_layout->view("backend/site_project-index",$data);
    }
    public function search($name=""){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_project";
        $data['breadcrumbs'][1]["Name"] = lang('backend.project');
        $data['breadcrumbs'][2]["Url"] = "#";
        $data['breadcrumbs'][2]["Name"] = lang('backend.search');
        
        $data['name'] = $this->input->post("name");
        if(!$data['name'] && $name){
            $data['name'] = urldecode($name);
        }
        $config['base_url'] = base_url("admin/site_project/search/{$data['name']}");
        $config['total_rows'] = $this->msite_project->countSearchData($data['name']);
        $config['per_page'] = 10; 
        $config['uri_segment'] = 6;
        $this->pagination->initialize($config);
        
        $data['project_list'] = $this->msite_project->getSearchData($data['name'], "ASC", $config['per_page'], $this->uri->segment(6));
        $this->my_layout->view("backend/site_project-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_project";
        $data['breadcrumbs'][1]["Name"] = lang('backend.project');
        $data['breadcrumbs'][2]["Url"] = "#";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $data['project_list'] = $this->msite_project->getAllData("DESC", 20, 0);
        
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        $this->form_validation->set_rules("img",lang('backend.img'),"required");
        //$this->form_validation->set_rules("maincontent",lang('backend.maincontent'),"required|min_length[10]");
        $this->form_validation->set_rules("content",lang('backend.content'),"required|min_length[10]");
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/site_project-add",$data);
        }else{
            $thumb = $this->input->post("img");
            if(strrpos("wb".$this->input->post("img"),base_url())){
                if(_checkThumbImg($this->input->post("img"))){
                    $thumb = _checkThumbImg($this->input->post("img"));
                }
            }
            $add = array(
                    "Name"          => $this->input->post("name"),
                    "Img"           => $this->input->post("img"),
                    "Thumb1"        => $thumb,
                    "Thumb2"        => "",
                    "Thumb3"        => "",
                    "Thumb4"        => "",
                    "MainContent"   => $this->input->post("maincontent"),
                    "Content"       => $this->input->post("content"),
                    "Dateset"       => date("Y-m-d H:i:s"),
                    "Address"       => $this->input->post("address"),
                    "Phone"         => $this->input->post("phone"),
                    "Type"          => $this->input->post("type"),
                    "Hot"           => $this->input->post("hot"),
                    "New"           => $this->input->post("new"),
                    "Hit"           => 1,
                    "User"          => $this->session->userdata("WBUSERID"),
                    "Editor"        => $this->input->post("editor"),
                    "Source"        => $this->input->post("source"),
                    "Status"        => $this->input->post("status"),
                    "Tags"          => $this->input->post("tags"),
                    "MTit"          => $this->input->post("mtit"),
                    "MKey"          => $this->input->post("mkey"),
                    "MDes"          => $this->input->post("mdes"),
                 );
            $this->msite_project->addData($add);
            redirect(base_url()."admin/site_project");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            $data['project_check'] = $this->msite_project->getDataByID($id);
            if($data['project_check']){ 
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_project";
                $data['breadcrumbs'][1]["Name"] = lang('backend.project');
                $data['breadcrumbs'][2]["Url"] = "admin/site_project/edit/".$data['project_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['project_check']['Name'];
                
                $data['project_list'] = $this->msite_project->getAllData("DESC", 20, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("img",lang('backend.img'),"required");
                //$this->form_validation->set_rules("maincontent",lang('backend.maincontent'),"required|min_length[10]");
                $this->form_validation->set_rules("content",lang('backend.content'),"required|min_length[10]");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = ""; 
                    $this->my_layout->view("backend/site_project-edit",$data);
                }else{
                    $thumb = $this->input->post("img");
                    if(strrpos("wb".$this->input->post("img"),base_url())){
                        if(_checkThumbImg($this->input->post("img"))){
                            $thumb = _checkThumbImg($this->input->post("img"));
                        }
                    }
                    $update = array(
                            "Name"          => $this->input->post("name"),
                            "Img"           => $this->input->post("img"),
                            "Thumb1"        => $thumb,
                            "Thumb2"        => $data['project_check']['Thumb2'],
                            "Thumb3"        => $data['project_check']['Thumb3'],
                            "Thumb4"        => $data['project_check']['Thumb4'],
                            "MainContent"   => $this->input->post("maincontent"),
                            "Content"       => $this->input->post("content"),
                            "Dateset"       => $data['project_check']['Dateset'],
                            "Address"       => $this->input->post("address"),
                            "Phone"         => $this->input->post("phone"),
                            "Type"          => $this->input->post("type"),
                            "Hot"           => $this->input->post("hot"),
                            "New"           => $this->input->post("new"),
                            "Hit"           => $data['project_check']['Hit'],
                            "User"          => $data['project_check']['User'],
                            "Editor"        => $this->input->post("editor"),
                            "Source"        => $this->input->post("source"),
                            "Status"        => $this->input->post("status"),
                            "Tags"          => $this->input->post("tags"),
                            "MTit"          => $this->input->post("mtit"),
                            "MKey"          => $this->input->post("mkey"),
                            "MDes"          => $this->input->post("mdes"),
                         );
                    $this->msite_project->updateData($update, $id);
                    redirect(base_url()."admin/site_project");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_project");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_project");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['project_check'] = $this->msite_project->getDataByID($id);
            if($data['project_check']){
                $this->msite_project->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_project");
        exit();
    }
        
}