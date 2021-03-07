<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_video_menu extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("msite_video_menu");
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_video_menu";
        $data['breadcrumbs'][1]["Name"] = lang('backend.video_menu');
        
        redirect(base_url()."admin/site_video_menu/pid/0");
        exit();
        /*
        $this->load->model("msite_video_menu");
        
        $data['miniTitle'] = "Quản lý danh mục admin";
        $data['video_menu_list'] = $this->msite_video_menu->getAllData("ASC", 99, 0);
        $this->my_layout->view("backend/site_video_menu",$data);
        */
    }
    public function pid($pid=0){
        if(is_numeric($pid)){
            $data['check_pid'] = $this->msite_video_menu->getDataByID($pid);
            if($data['check_pid'] || $pid == 0){
                if($pid == 0){
                    $data['check_pid']['ID'] = 0;
                    $data['check_pid']['Name'] = lang('backend.root');
                }
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_video_menu";
                $data['breadcrumbs'][1]["Name"] = lang('backend.video_menu');
                $data['breadcrumbs'][2]["Url"] = "admin/site_video_menu/pid/{$data['check_pid']['ID']}";
                $data['breadcrumbs'][2]["Name"] = $data['check_pid']['Name'];
                
                $data['video_menu_list'] = $this->msite_video_menu->getPidStatusData($pid, "all", "ASC", 99, 0);
                $this->my_layout->view("backend/site_video_menu-index",$data);
            }else{
                redirect(base_url()."admin/site_video_menu/pid/0");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_video_menu");
            exit();
        }
    }
    public function add($pid=0){
        $this->load->model("msite_video_menu");
        if(is_numeric($pid)){
            $data['check_pid'] = $this->msite_video_menu->getDataByID($pid);
        }
        if($data['check_pid'] || $pid == 0){
            if($pid == 0){
                $data['check_pid']['ID'] = 0;
                $data['check_pid']['Name'] = lang('backend.root');
            }
            $data['breadcrumbs'][0]["Url"] = "admin/manage";
            $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
            $data['breadcrumbs'][1]["Url"] = "admin/site_video_menu";
            $data['breadcrumbs'][1]["Name"] = lang('backend.video_menu');
            $data['breadcrumbs'][2]["Url"] = "#";
            $data['breadcrumbs'][2]["Name"] = lang('backend.add');
            
            $data['video_menu_list'] = $this->msite_video_menu->getAllData("DESC", 10, 0);
            
            $this->form_validation->set_rules("name",lang('backend.name'),"required");
            
            if($this->form_validation->run() == FALSE){
                $data['error'] = ""; 
                $this->my_layout->view("backend/site_video_menu-add",$data);
            }else{
                $add = array(
                    "PID"           => $pid,
                    "Name"          => $this->input->post("name"),
                    "Content"       => $this->input->post("content"),
                    "Level"         => $this->input->post("level"),
                    "Type"          => $this->input->post("type"),
                    "Status"        => $this->input->post("status"),
                    "MTit"          => $this->input->post("mtit"),
                    "MKey"          => $this->input->post("mkey"),
                    "MDes"          => $this->input->post("mdes"),
                 );
                $this->msite_video_menu->addData($add);
                redirect(base_url()."admin/site_video_menu/pid/".$pid);
                exit();
            }
        }else{
            redirect(base_url()."admin/site_video_menu");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            $data['video_menu_check'] = $this->msite_video_menu->getDataByID($id);
            if($data['video_menu_check']){
                $data['check_pid'] = $this->msite_video_menu->getDataByID($data['video_menu_check']['PID']);
                if($data['check_pid'] || $data['video_menu_check']['PID'] == 0){
                    if($data['video_menu_check']['PID'] == 0){
                        $data['check_pid']['ID'] = 0;
                        $data['check_pid']['Name'] = lang('backend.root');
                    }
                    $data['breadcrumbs'][0]["Url"] = "admin/manage";
                    $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                    $data['breadcrumbs'][1]["Url"] = "admin/site_video_menu";
                    $data['breadcrumbs'][1]["Name"] = lang('backend.video_menu');
                    $data['breadcrumbs'][2]["Url"] = "admin/site_video_menu/edit/{$data['video_menu_check']['ID']}";
                    $data['breadcrumbs'][2]["Name"] = $data['video_menu_check']['Name'];
                    
                    $data['video_menu_list'] = $this->msite_video_menu->getAllData("DESC", 10, 0);
                    
                    $this->form_validation->set_rules("name",lang('backend.name'),"required");
                    
                    if($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $this->my_layout->view("backend/site_video_menu-edit",$data);
                    }else{
                        $update = array(
                            "PID"           => $data['video_menu_check']['PID'],
                            "Name"          => $this->input->post("name"),
                            "Content"       => $this->input->post("content"),
                            "Level"         => $this->input->post("level"),
                            "Type"          => $this->input->post("type"),
                            "Status"        => $this->input->post("status"),
                            "MTit"          => $this->input->post("mtit"),
                            "MKey"          => $this->input->post("mkey"),
                            "MDes"          => $this->input->post("mdes"),
                         );
                        $this->msite_video_menu->updateData($update, $id);
                        redirect(base_url()."admin/site_video_menu/pid/".$data['video_menu_check']['PID']);
                        exit();
                    }
                }else{
                    redirect(base_url()."admin/site_video_menu");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_video_menu");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_video_menu");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['video_menu_check'] = $this->msite_video_menu->getDataByID($id);
            if($data['video_menu_check']){
                $this->msite_video_menu->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_video_menu");
        exit();
    }
        
}