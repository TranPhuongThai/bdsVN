<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_project_menu extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("msite_project_menu");
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_project_menu";
        $data['breadcrumbs'][1]["Name"] = lang('backend.menu_project');
        $data['check_pid']['ID'] = 0;
        $data['check_pid']['Name'] = lang('backend.root');
        $data['miniTitle'] = lang('backend.manage')." ".lang('backend.menu')." ".lang('backend.project');
        $data['project_menu_list'] = $this->msite_project_menu->getAllData("ASC", 99, 0);
        $this->my_layout->view("backend/site_project_menu-index",$data);
    }
    public function pid($pid=0){
        if(is_numeric($pid)){
            $data['check_pid'] = $this->msite_project_menu->getDataByID($pid);
            if($data['check_pid'] || $pid == 0){
                if($pid == 0){
                    $data['check_pid']['ID'] = 0;
                    $data['check_pid']['Name'] = lang('backend.root');
                }
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_project_menu";
                $data['breadcrumbs'][1]["Name"] = lang('backend.menu_project');
                $data['breadcrumbs'][2]["Url"] = "admin/site_project_menu/pid/".$data['check_pid']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['check_pid']['Name'];
                
                $data['project_menu_list'] = $this->msite_project_menu->getPidStatusData($pid, "all", "ASC", 99, 0);
                $this->my_layout->view("backend/site_project_menu-index",$data);
            }else{
                redirect(base_url()."admin/site_project_menu");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_project_menu");
            exit();
        }
    }
    public function add($pid=0){
        if(is_numeric($pid)){
            $data['check_pid'] = $this->msite_project_menu->getDataByID($pid);
        }
        if($data['check_pid'] || $pid == 0){
            if($pid == 0){
                $data['check_pid']['ID'] = 0;
                $data['check_pid']['Name'] = lang('backend.root');
            }
            $data['breadcrumbs'][0]["Url"] = "admin/manage";
            $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
            $data['breadcrumbs'][1]["Url"] = "admin/site_project_menu";
            $data['breadcrumbs'][1]["Name"] = lang('backend.menu_project');
            $data['breadcrumbs'][2]["Url"] = "admin/site_project_menu/pid/".$data['check_pid']['ID'];
            $data['breadcrumbs'][2]["Name"] = $data['check_pid']['Name'];
            $data['breadcrumbs'][3]["Url"] = "#";
            $data['breadcrumbs'][3]["Name"] = lang('backend.add');
            
            $data['project_menu_list'] = $this->msite_project_menu->getAllData("DESC", 10, 0);
            
            $this->form_validation->set_rules("name",lang('backend.name'),"required");
            if($this->form_validation->run() == FALSE){
                $data['error'] = ""; 
                $this->my_layout->view("backend/site_project_menu-add",$data);
            }else{
                $add = array(
                    "PID"           => $pid,
                    "Name"          => $this->input->post("name"),
                    "Level"         => $this->input->post("level"),
                    "Status"        => $this->input->post("status"),
                    "MTit"          => $this->input->post("mtit"),
                    "MKey"          => $this->input->post("mkey"),
                    "MDes"          => $this->input->post("mdes"),
                 );
                $this->msite_project_menu->addData($add);
                redirect(base_url()."admin/site_project_menu/pid/".$pid);
                exit();
            }
        }else{
            redirect(base_url()."admin/site_project_menu");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            $data['project_menu_check'] = $this->msite_project_menu->getDataByID($id);
            if($data['project_menu_check']){
                $data['check_pid'] = $this->msite_project_menu->getDataByID($data['project_menu_check']['PID']);
                if($data['check_pid'] || $data['project_menu_check']['PID'] == 0){
                    if($data['project_menu_check']['PID'] == 0){
                        $data['check_pid']['ID'] = 0;
                        $data['check_pid']['Name'] = lang('backend.root');
                    }
                    $data['breadcrumbs'][0]["Url"] = "admin/manage";
                    $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                    $data['breadcrumbs'][1]["Url"] = "admin/site_project_menu";
                    $data['breadcrumbs'][1]["Name"] = lang('backend.menu_project');
                    $data['breadcrumbs'][2]["Url"] = "admin/site_project_menu/pid/".$data['check_pid']['ID'];
                    $data['breadcrumbs'][2]["Name"] = $data['check_pid']['Name'];
                    $data['breadcrumbs'][3]["Url"] = "admin/site_project_menu/edit/".$data['project_menu_check']['ID'];
                    $data['breadcrumbs'][3]["Name"] = $data['project_menu_check']['Name'];
            
                    $data['project_menu_list'] = $this->msite_project_menu->getAllData("DESC", 10, 0);
                    
                    $this->form_validation->set_rules("name",lang('backend.name'),"required");
                    if($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $this->my_layout->view("backend/site_project_menu-edit",$data);
                    }else{
                        $update = array(
                            "PID"           => $data['project_menu_check']['PID'],
                            "Name"          => $this->input->post("name"),
                            "Level"         => $this->input->post("level"),
                            "Status"        => $this->input->post("status"),
                            "MTit"          => $this->input->post("mtit"),
                            "MKey"          => $this->input->post("mkey"),
                            "MDes"          => $this->input->post("mdes"),
                         );
                        $this->msite_project_menu->updateData($update, $id);
                        redirect(base_url()."admin/site_project_menu/pid/".$data['project_menu_check']['PID']);
                        exit();
                    }
                }else{
                    redirect(base_url()."admin/site_project_menu");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_project_menu");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_project_menu");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['project_menu_check'] = $this->msite_project_menu->getDataByID($id);
            if($data['project_menu_check']){
                $this->msite_project_menu->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_project_menu");
        exit();
    }
        
}