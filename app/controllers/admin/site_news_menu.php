<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_news_menu extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("msite_news_menu");
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_news_menu";
        $data['breadcrumbs'][1]["Name"] = lang('backend.menu_news');
        
        $data['check_pid']['ID'] = 0;
        $data['check_pid']['Name'] = lang('backend.root');
        $data['news_menu_list'] = $this->msite_news_menu->getPidStatusData(0, "all", "ASC", 99, 0);
        $this->my_layout->view("backend/site_news_menu-index",$data);
    }
    public function pid($pid=0){
        if(is_numeric($pid)){
            $data['check_pid'] = $this->msite_news_menu->getDataByID($pid);
            if($data['check_pid'] || $pid == 0){
                if($pid == 0){
                    $data['check_pid']['ID'] = 0;
                    $data['check_pid']['Name'] = lang('backend.root');
                }
                $data['pid'] = $pid;
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_news_menu";
                $data['breadcrumbs'][1]["Name"] = lang('backend.menu_news');
                $data['breadcrumbs'][2]["Url"] = "admin/site_news_menu/pid/".$data['check_pid']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['check_pid']['Name'];
                
                $data['news_menu_list'] = $this->msite_news_menu->getPidStatusData($pid, "all", "ASC", 99, 0);
                $this->my_layout->view("backend/site_news_menu-index",$data);
            }else{
                redirect(base_url()."admin/site_news_menu");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_news_menu");
            exit();
        }
    }
    public function add($pid=0){
        if(is_numeric($pid)){
            $data['check_pid'] = $this->msite_news_menu->getDataByID($pid);
        }
        if($data['check_pid'] || $pid == 0){
            if($pid == 0){
                $data['check_pid']['ID'] = 0;
                $data['check_pid']['Name'] = lang('backend.root');
            }
            $data['pid'] = $pid;
            $data['breadcrumbs'][0]["Url"] = "admin/manage";
            $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
            $data['breadcrumbs'][1]["Url"] = "admin/site_news_menu";
            $data['breadcrumbs'][1]["Name"] = lang('backend.menu_news');
            $data['breadcrumbs'][2]["Url"] = "#";
            $data['breadcrumbs'][2]["Name"] = lang('backend.add');
            
            $data['news_menu_list'] = $this->msite_news_menu->getAllData("DESC", 10, 0);
            
            $this->form_validation->set_rules("name",lang('backend.name'),"required");
            if($this->form_validation->run() == FALSE){
                $data['error'] = ""; 
                $this->my_layout->view("backend/site_news_menu-add",$data);
            }else{
                $add = array(
                    "PID"           => $pid,
                    "Name"          => $this->input->post("name"),
                    "Level"         => $this->input->post("level"),
                    "Status"        => $this->input->post("status"),
                    "MTit"          => $this->input->post("mtit"),
                    "MKey"          => $this->input->post("mkey"),
                    "MDes"          => $this->input->post("mdes"),
                    "Cls"           => $this->input->post("cls"),
                 );
                $this->msite_news_menu->addData($add);
                redirect(base_url()."admin/site_news_menu/pid/".$pid);
                exit();
            }
        }else{
            redirect(base_url()."admin/site_news_menu");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){            
            $data['news_menu_check'] = $this->msite_news_menu->getDataByID($id);
            if($data['news_menu_check']){
                $data['check_pid'] = $this->msite_news_menu->getDataByID($data['news_menu_check']['PID']);
                if($data['check_pid'] || $data['news_menu_check']['PID'] == 0){
                    if($data['news_menu_check']['PID'] == 0){
                        $data['check_pid']['ID'] = 0;
                        $data['check_pid']['Name'] = lang('backend.root');
                    }
                    $data['breadcrumbs'][0]["Url"] = "admin/manage";
                    $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                    $data['breadcrumbs'][1]["Url"] = "admin/site_news_menu";
                    $data['breadcrumbs'][1]["Name"] = lang('backend.menu_news');
                    $data['breadcrumbs'][2]["Url"] = "admin/site_news_menu/pid/".$data['check_pid']['ID'];
                    $data['breadcrumbs'][2]["Name"] = $data['check_pid']['Name'];
                    $data['breadcrumbs'][3]["Url"] = "admin/site_news_menu/edit/".$data['news_menu_check']['ID'];
                    $data['breadcrumbs'][3]["Name"] = $data['news_menu_check']['Name'];
                    
                    $data['news_menu_list'] = $this->msite_news_menu->getAllData("DESC", 10, 0);
                    
                    $this->form_validation->set_rules("name",lang('backend.name'),"required");
                    
                    if($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $this->my_layout->view("backend/site_news_menu-edit",$data);
                    }else{
                        $update = array(
                            "PID"           => $data['news_menu_check']['PID'],
                            "Name"          => $this->input->post("name"),
                            "Level"         => $this->input->post("level"),
                            "Status"        => $this->input->post("status"),
                            "MTit"          => $this->input->post("mtit"),
                            "MKey"          => $this->input->post("mkey"),
                            "MDes"          => $this->input->post("mdes"),
                            "Cls"           => $this->input->post("cls"),
                         );
                        $this->msite_news_menu->updateData($update, $id);
                        redirect(base_url()."admin/site_news_menu/pid/".$data['news_menu_check']['PID']);
                        exit();
                    }
                }else{
                    redirect(base_url()."admin/site_news_menu");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_news_menu");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_news_menu");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['news_menu_check'] = $this->msite_news_menu->getDataByID($id);
            if($data['news_menu_check']){
                $this->msite_news_menu->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_news_menu");
        exit();
    }
        
}