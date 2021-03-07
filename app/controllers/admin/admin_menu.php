<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Admin_menu extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("madmin_menu");
    }
    public function _getOptionMenuAdmin($pid, $prefix="", $active=""){
        $menu_list = $this->madmin_menu->getPidStatusData($pid, 1, "ASC", 99, 0);
		$slt = "";
        foreach($menu_list as $row){
            if($active == $row['ID']){
                $slt .= "<option value=\"".$row['ID']."\" selected=\"selected\">".$prefix." ".$row['Name'];
            }else{
                $slt .= "<option value=\"".$row['ID']."\">".$prefix." ".$row['Name'];
            }
			$slt .= $this->_getOptionMenuAdmin($row['ID'], $prefix.$prefix.$prefix.$prefix, $active);
        }
		return $slt;
    }
    public function index(){
        redirect(base_url()."admin/admin_menu/pid/0");
        exit();
    }
    public function pid($pid=0){
        $data['menu_list'] = $this->_getOptionMenuAdmin(0,"--", $pid);
        if(is_numeric($pid)){
            $data['check_pid'] = $this->madmin_menu->getDataByID($pid);
            if($data['check_pid'] || $pid == 0){
                if($pid == 0){
                    $data['check_pid']['ID'] = 0;
                    $data['check_pid']['Name'] = lang('backend.root');
                }
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/admin_menu";
                $data['breadcrumbs'][1]["Name"] = lang('backend.admin_menu');
                $data['breadcrumbs'][2]["Url"] = "admin/admin_menu/pid/".$data['check_pid']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['check_pid']['Name'];
                
                $data['admin_menu_list'] = $this->madmin_menu->getPidStatusData($data['check_pid']['ID'], "all", "ASC", 99, 0);
                $this->my_layout->view("backend/admin_menu-index",$data);
            }else{
                redirect(base_url()."admin/admin_menu");
                exit();
            }
        }else{
            redirect(base_url()."admin/admin_menu");
            exit();
        }
    }
    public function add($pid=0){
        if(is_numeric($pid)){
            $data['check_pid'] = $this->madmin_menu->getDataByID($pid);
        }
        if($data['check_pid'] || $pid == 0){
            if($pid == 0){
                $data['check_pid']['ID'] = 0;
                $data['check_pid']['Name'] = lang('backend.root');
            }
            $data['pid'] = $pid;
        
            $data['breadcrumbs'][0]["Url"] = "admin/manage";
            $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
            $data['breadcrumbs'][1]["Url"] = "admin/admin_menu";
            $data['breadcrumbs'][1]["Name"] = lang('backend.admin_menu');
            $data['breadcrumbs'][2]["Url"] = "admin/admin_menu/pid/".$data['check_pid']['ID'];
            $data['breadcrumbs'][2]["Name"] = $data['check_pid']['Name'];
            $data['breadcrumbs'][3]["Url"] = "#";
            $data['breadcrumbs'][3]["Name"] = lang('backend.add');
            
            $data['admin_menu_list'] = $this->madmin_menu->getAllData("DESC", 10, 0);
            
            $this->form_validation->set_rules("name",lang('backend.name'),"required");
            $this->form_validation->set_rules("link",lang('backend.link'),"required");
            $this->form_validation->set_rules("module",lang('backend.module'),"required");
            if($this->form_validation->run() == FALSE){
                $data['error'] = ""; 
                $this->my_layout->view("backend/admin_menu-add",$data);
            }else{
                $add = array(
                    "PID"           => $pid,
                    "Type"          => $this->input->post("type"),
                    "Name"          => $this->input->post("name"),
                    "Name_en"       => $this->input->post("name_en"),
                    "Img"           => $this->input->post("img"),
                    "Link"          => $this->input->post("link"),
                    "Module"        => $this->input->post("module"),
                    "Level"         => $this->input->post("level"),
                    "Status"        => $this->input->post("status"),
                 );
                $this->madmin_menu->addData($add);
                if($pid)
                    redirect(base_url()."admin/admin_menu/pid/".$pid);
                else
                    redirect(base_url()."admin/admin_menu/");
                exit();
            }
        }else{
            redirect(base_url()."admin/admin_menu");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            $data['admin_menu_check'] = $this->madmin_menu->getDataByID($id);
            if($data['admin_menu_check']){
                $data['check_pid'] = $this->madmin_menu->getDataByID($data['admin_menu_check']['PID']);
                if($data['check_pid'] || $data['admin_menu_check']['PID'] == 0){
                    if($data['admin_menu_check']['PID'] == 0){
                        $data['check_pid']['ID'] = 0;
                        $data['check_pid']['Name'] = lang('backend.root');
                    }
                    $data['breadcrumbs'][0]["Url"] = "admin/manage";
                    $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                    $data['breadcrumbs'][1]["Url"] = "admin/admin_menu";
                    $data['breadcrumbs'][1]["Name"] = lang('backend.admin_menu');
                    $data['breadcrumbs'][2]["Url"] = "admin/admin_menu/pid/".$data['check_pid']['ID'];
                    $data['breadcrumbs'][2]["Name"] = $data['check_pid']['Name'];
                    $data['breadcrumbs'][3]["Url"] = "#";
                    $data['breadcrumbs'][3]["Name"] = $data['admin_menu_check']['Name'];
                    
                    $data['admin_menu_list'] = $this->madmin_menu->getAllData("DESC", 10, 0);
                    
                    $this->form_validation->set_rules("name",lang('backend.name'),"required");
                    $this->form_validation->set_rules("link",lang('backend.link'),"required");
                    $this->form_validation->set_rules("module",lang('backend.module'),"required");
                    if($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $this->my_layout->view("backend/admin_menu-edit",$data);
                    }else{
                        $update = array(
                            "PID"           => $data['admin_menu_check']['PID'],
                            "Type"          => $this->input->post("type"),
                            "Name"          => $this->input->post("name"),
                            "Name_en"       => $this->input->post("name_en"),
                            "Img"           => $this->input->post("img"),
                            "Link"          => $this->input->post("link"),
                            "Module"        => $this->input->post("module"),
                            "Level"         => $this->input->post("level"),
                            "Status"        => $this->input->post("status"),
                         );
                        $this->madmin_menu->updateData($update, $id);
                        if($data['admin_menu_check']['PID'])
                            redirect(base_url()."admin/admin_menu/pid/".$data['admin_menu_check']['PID']);
                        else
                            redirect(base_url()."admin/admin_menu/");
                        exit();
                    }
                }else{
                    redirect(base_url()."admin/admin_menu");
                    exit();
                }
            }else{
                redirect(base_url()."admin/admin_menu");
                exit();
            }
        }else{
            redirect(base_url()."admin/admin_menu");
            exit();
        }
    }
    public function delete($id){
        $this->load->model("madmin_menu");
        
        if(is_numeric($id)){
            $data['admin_menu_check'] = $this->madmin_menu->getDataByID($id);
            if($data['admin_menu_check']){
                $this->madmin_menu->deleteData($id);
                if($data['admin_menu_check']['PID'])
                    redirect(base_url()."admin/admin_menu/pid/".$data['admin_menu_check']['PID']);
                else
                    redirect(base_url()."admin/admin_menu/");
                exit();
            }
        } 
        redirect(base_url()."admin/admin_menu");
        exit();
    }
}