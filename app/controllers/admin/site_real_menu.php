<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_real_menu extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."/admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."/admin/manage");
            exit();
        }
        $this->load->model("msite_real_menu");
    }
    public function index(){                
        $data['breadcrumbs'][0]["Url"] = "/admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "/admin/site_real_menu";
        $data['breadcrumbs'][1]["Name"] = lang('backend.menu_real');
                
        $data['check_pid']['ID'] = 0;
        $data['check_pid']['Name'] = lang('backend.root');
        $data['real_menu_list'] = $this->msite_real_menu->getAllData("ASC", 99, 0);
        $this->my_layout->view("backend/site_real_menu-index",$data);
    }
    public function pid($pid=0){
        if(is_numeric($pid)){
            $data['check_pid'] = $this->msite_real_menu->getDataByID($pid);
            if($data['check_pid'] || $pid == 0){
                if($pid == 0){
                    $data['check_pid']['ID'] = 0;
                    $data['check_pid']['Name'] = lang('backend.root');
                }
                $data['breadcrumbs'][0]["Url"] = "/admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "/admin/site_real_menu";
                $data['breadcrumbs'][1]["Name"] = lang('backend.menu_real');
                $data['breadcrumbs'][2]["Url"] = "/admin/site_real_menu/pid/{$data['check_pid']['ID']}";
                $data['breadcrumbs'][2]["Name"] = $data['check_pid']['Name'];
                
                $data['real_menu_list'] = $this->msite_real_menu->getPidStatusData($pid, "all", "ASC", 99, 0);
                $this->my_layout->view("backend/site_real_menu-index",$data);
            }else{
                redirect(base_url()."/admin/site_real_menu");
                exit();
            }
        }else{
            redirect(base_url()."/admin/site_real_menu");
            exit();
        }
    }
    public function add($pid=0){
        $data['breadcrumbs'][0]["Url"] = "/admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "/admin/site_real_menu";
        $data['breadcrumbs'][1]["Name"] = lang('backend.menu_real');
        $data['breadcrumbs'][2]["Url"] = "/admin/site_real_menu/add";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        if(is_numeric($pid)){
            $data['check_pid'] = $this->msite_real_menu->getDataByID($pid);
        }
        if($data['check_pid'] || $pid == 0){
            if($pid == 0){
                $data['check_pid']['ID'] = 0;
                $data['check_pid']['Name'] = lang('backend.root');
            }
            $data['real_menu_list'] = $this->msite_real_menu->getAllData("DESC", 10, 0);
            
            $this->form_validation->set_rules("name",lang('backend.name'),"required");
            if($this->form_validation->run() == FALSE){
                $data['error'] = ""; 
                $this->my_layout->view("backend/site_real_menu-add",$data);
            }else{
                $add = array(
                    "PID"           => $pid,
                    "Name"          => $this->input->post("name"),
                    "Content"       => $this->input->post("content"),
                    "Level"         => $this->input->post("level"),
                    "Status"        => $this->input->post("status"),
                    "MTit"          => $this->input->post("mtit"),
                    "MKey"          => $this->input->post("mkey"),
                    "MDes"          => $this->input->post("mdes"),
                 );
                $this->msite_real_menu->addData($add);
                redirect(base_url()."/admin/site_real_menu/pid/".$pid);
                exit();
            }
        }else{
            redirect(base_url()."/admin/site_real_menu");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){            
            $data['real_menu_check'] = $this->msite_real_menu->getDataByID($id);
            if($data['real_menu_check']){
                $data['check_pid'] = $this->msite_real_menu->getDataByID($data['real_menu_check']['PID']);
                if($data['check_pid'] || $data['real_menu_check']['PID'] == 0){
                    if($data['real_menu_check']['PID'] == 0){
                        $data['check_pid']['ID'] = 0;
                        $data['check_pid']['Name'] = lang('backend.root');
                    }
                    $data['breadcrumbs'][0]["Url"] = "/admin/manage";
                    $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                    $data['breadcrumbs'][1]["Url"] = "/admin/site_real_menu";
                    $data['breadcrumbs'][1]["Name"] = lang('backend.menu_real');
                    $data['breadcrumbs'][2]["Url"] = "/admin/site_real_menu/pid/{$data['check_pid']['ID']}";
                    $data['breadcrumbs'][2]["Name"] = $data['check_pid']['Name'];
                    $data['breadcrumbs'][3]["Url"] = "/admin/site_real_menu/edit/{$data['real_menu_check']['ID']}";
                    $data['breadcrumbs'][3]["Name"] = $data['real_menu_check']['Name'];
            
                    $data['real_menu_list'] = $this->msite_real_menu->getAllData("DESC", 10, 0);
                    
                    $this->form_validation->set_rules("name",lang('backend.name'),"required");
                    
                    if($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $this->my_layout->view("backend/site_real_menu-edit",$data);
                    }else{
                        $update = array(
                            "PID"           => $data['real_menu_check']['PID'],
                            "Name"          => $this->input->post("name"),
                            "Content"       => $this->input->post("content"),
                            "Level"         => $this->input->post("level"),
                            "Status"        => $this->input->post("status"),
                            "MTit"          => $this->input->post("mtit"),
                            "MKey"          => $this->input->post("mkey"),
                            "MDes"          => $this->input->post("mdes"),
                         );
                        $this->msite_real_menu->updateData($update, $id);
                        redirect(base_url()."/admin/site_real_menu/pid/".$data['real_menu_check']['PID']);
                        exit();
                    }
                }else{
                    redirect(base_url()."/admin/site_real_menu");
                    exit();
                }
            }else{
                redirect(base_url()."/admin/site_real_menu");
                exit();
            }
        }else{
            redirect(base_url()."/admin/site_real_menu");
            exit();
        }
    }
    public function delete($id){
        $this->load->model("msite_real_menu");
        if(is_numeric($id)){
            $data['real_menu_check'] = $this->msite_real_menu->getDataByID($id);
            if($data['real_menu_check']){
                $this->msite_real_menu->deleteData($id);
            }
        } 
        redirect(base_url()."/admin/site_real_menu");
        exit();
    }
        
}