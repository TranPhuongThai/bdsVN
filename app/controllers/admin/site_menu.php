<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_menu extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("msite_menu");
    }
    function _getOptionMenuSite($pid, $prefix="", $active=""){
        $menu_list = $this->msite_menu->getPidStatusData($pid, 1, "ASC", 99, 0);
		$slt = "";
        foreach($menu_list as $row){
            if($active == $row['ID']){
                $slt .= "<option value=\"".$row['ID']."\" selected=\"selected\">".$prefix." ".$row['Name'];
            }else{
                $slt .= "<option value=\"".$row['ID']."\">".$prefix." ".$row['Name'];
            }
			$slt .= $this->_getOptionMenuSite($row['ID'], $prefix.$prefix.$prefix.$prefix, $active);
        }
		return $slt;
    }
    public function index(){
        redirect(base_url()."admin/site_menu/pid/0");
        exit();
    }
    public function pid($pid=0){
        $data['menu_list'] = $this->_getOptionMenuSite(0,"--", $pid);
        if(is_numeric($pid)){
            $data['check_pid'] = $this->msite_menu->getDataByID($pid);
            if($data['check_pid'] || $pid == 0){
                if($pid == 0){
                    $data['check_pid']['ID'] = 0;
                    $data['check_pid']['Name'] = lang('backend.root');
                }
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_menu";
                $data['breadcrumbs'][1]["Name"] = lang('backend.menu');
                $data['breadcrumbs'][2]["Url"] = "admin/site_menu/pid/".$data['check_pid']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['check_pid']['Name'];
                
                $data['site_menu_list'] = $this->msite_menu->getPidStatusData($data['check_pid']['ID'], "all", "ASC", 99, 0);
                $this->my_layout->view("backend/site_menu-index",$data);
            }else{
                redirect(base_url()."admin/site_menu");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_menu");
            exit();
        }
    }
    public function add($pid=0){
        if(is_numeric($pid)){
            $data['check_pid'] = $this->msite_menu->getDataByID($pid);
        }
        if($data['check_pid'] || $pid == 0){
            if($pid == 0){
                $data['check_pid']['ID'] = 0;
                $data['check_pid']['Name'] = lang('backend.root');
            }
            $data['breadcrumbs'][0]["Url"] = "admin/manage";
            $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
            $data['breadcrumbs'][1]["Url"] = "admin/site_menu";
            $data['breadcrumbs'][1]["Name"] = lang('backend.menu');
            $data['breadcrumbs'][2]["Url"] = "#";
            $data['breadcrumbs'][2]["Name"] = lang('backend.add');
            
            $data['pid'] = $pid;
            
            $data['site_menu_list'] = $this->msite_menu->getAllData("DESC", 10, 0);
            
            $this->form_validation->set_rules("name",lang('backend.name'),"required");
            //$this->form_validation->set_rules("link",lang('backend.menu'),"required");
            if($this->form_validation->run() == FALSE){
                $data['error'] = ""; 
                $this->my_layout->view("backend/site_menu-add",$data);
            }else{
                $add = array(
                    "PID"           => $pid,
                    "Name"          => $this->input->post("name"),
                    "Img"           => "",
                    "Link"          => $this->input->post("link"),
                    "Level"         => $this->input->post("level"),
                    "Status"        => $this->input->post("status"),
                    "MTit"          => $this->input->post("mtit"),
                    "MKey"          => $this->input->post("mkey"),
                    "MDes"          => $this->input->post("mdes"),
                 );
                $this->msite_menu->addData($add);
                redirect(base_url()."admin/site_menu/pid/".$pid);
                exit();
            }
        }else{
            redirect(base_url()."admin/site_menu");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            
            $data['menu_check'] = $this->msite_menu->getDataByID($id);
            if($data['menu_check']){
                $data['check_pid'] = $this->msite_menu->getDataByID($data['menu_check']['PID']);
                if($data['check_pid'] || $data['menu_check']['PID'] == 0){
                    if($data['menu_check']['PID'] == 0){
                        $data['check_pid']['Name'] = lang('root');
                    }
                    $data['breadcrumbs'][0]["Url"] = "admin/manage";
                    $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                    $data['breadcrumbs'][1]["Url"] = "admin/site_menu";
                    $data['breadcrumbs'][1]["Name"] = lang('backend.menu');
                    $data['breadcrumbs'][2]["Url"] = "admin/site_menu/edit/".$data['menu_check']['ID'];
                    $data['breadcrumbs'][2]["Name"] = $data['menu_check']['Name'];
                    
                    $data['site_menu_list'] = $this->msite_menu->getAllData("DESC", 10, 0);
            
                    $this->form_validation->set_rules("name",lang('backend.name'),"required");
                    //$this->form_validation->set_rules("link",lang('backend.menu'),"required");
                    if($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $this->my_layout->view("backend/site_menu-edit",$data);
                    }else{
                        $update = array(
                            "PID"           => $data['menu_check']['PID'],
                            "Name"          => $this->input->post("name"),
                            "Img"           => "",
                            "Link"          => $this->input->post("link"),
                            "Level"         => $this->input->post("level"),
                            "Status"        => $this->input->post("status"),
                            "MTit"          => $this->input->post("mtit"),
                            "MKey"          => $this->input->post("mkey"),
                            "MDes"          => $this->input->post("mdes"),
                         );
                        $this->msite_menu->updateData($update, $id);
                        redirect(base_url()."admin/site_menu/pid/".$data['menu_check']['PID']);
                        exit();
                    }
                }else{
                    redirect(base_url()."admin/site_menu");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_menu");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_menu");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['menu_check'] = $this->msite_menu->getDataByID($id);
            if($data['menu_check']){
                $this->msite_menu->deleteData($id);
            }
        }
        redirect(base_url()."admin/site_menu");
        exit();
    }
        
}