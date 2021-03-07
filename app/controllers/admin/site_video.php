<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_video extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("msite_video","msite_video_menu"));
    }
    
    function _getOptionMenuVideo($pid, $prefix="", $active=""){
        $menu_list = $this->msite_video_menu->getPidStatusData($pid, 1, "ASC", 99, 0);
		$slt = "";
        foreach($menu_list as $row){
            if($active == $row['ID']){
                $slt .= "<option value=\"".$row['ID']."\" selected=\"selected\">".$prefix." ".$row['Name'];
            }else{
                $slt .= "<option value=\"".$row['ID']."\">".$prefix." ".$row['Name'];
            }
			$slt .= $this->_getOptionMenuVideo($row['ID'], $prefix.$prefix.$prefix.$prefix, $active);
        }
		return $slt;
    }
    
    function _getOptionMenuVideoNoChild($pid, $prefix="", $active=""){
        $menu_list = $this->msite_video_menu->getPidStatusData($pid, 1, "ASC", 99, 0);
		$slt = "";
        foreach($menu_list as $row){
            if($active == $row['ID']){
                $slt .= "<option value=\"".$row['ID']."\" selected=\"selected\">".$prefix." ".$row['Name'];
            }else{
                $slt .= "<option value=\"".$row['ID']."\">".$prefix." ".$row['Name'];
            }
        }
		return $slt;
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_video";
        $data['breadcrumbs'][1]["Name"] = lang('backend.video');
        
        $config['base_url'] = base_url("admin/site_video/index");
        $config['total_rows'] = $this->msite_video->countAllData();
        $config['per_page'] = 10; 
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        
        $data['name'] = "";
        $data['menu_list'] = $this->_getOptionMenuVideo(0, "--");
        $data['video_list'] = $this->msite_video->getAllData("DESC", $config['per_page'], $this->uri->segment(4));
        
        $this->my_layout->view("backend/site_video-index",$data);
    }
    public function menu($menu){
        
        $data['menu'] = $this->input->post("menu");
        if(!$data['menu'] && $menu){
            $data['menu'] = urldecode($menu);
        }
        $data['name'] = "";
        if($data['menu']){
            $data['menu_check'] = $this->msite_video_menu->getDataByID($data['menu']);
            if($data['menu_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_video";
                $data['breadcrumbs'][1]["Name"] = lang('backend.video');
                $data['breadcrumbs'][2]["Url"] = "admin/site_video/menu/{$data['menu_check']['ID']}";
                $data['breadcrumbs'][2]["Name"] = $data['menu_check']['ID']['Name'];
        
                $config['base_url'] = base_url("admin/site_video/menu/{$data['menu_check']['ID']}");
                $config['total_rows'] = $this->msite_video->countSearchData("", $data['menu']);
                $config['per_page'] = 10; 
                $config['uri_segment'] = 5;
                
                $this->pagination->initialize($config);
                
                $data['menu_list'] = $this->_getOptionMenuVideo(0, "--",$data['menu']);
                $data['video_list'] = $this->msite_video->getSearchData("", $data['menu'], "DESC", $config['per_page'], $this->uri->segment(5));
                $this->my_layout->view("backend/site_video-index",$data);
            }
        }
    }
    public function search($name="", $menu=""){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_video";
        $data['breadcrumbs'][1]["Name"] = lang('backend.video');
        $data['breadcrumbs'][2]["Url"] = "#";
        $data['breadcrumbs'][2]["Name"] = lang('backend.search');
        
        $data['name'] = $this->input->post("name");
        $data['menu'] = $this->input->post("menu");
        if(!$data['name'] && $name){
            $data['name'] = urldecode($name);
        }
        if(!$data['menu'] && $menu){
            $data['menu'] = urldecode($menu);
        }
        
        $config['base_url'] = base_url("admin/site_video/search/{$data['name']}/{$data['menu']}");
        $config['total_rows'] = $this->msite_video->countSearchData($data['name'], $data['menu']);
        $config['per_page'] = 10; 
        $config['uri_segment'] = 6;
        
        $this->pagination->initialize($config);
        
        $data['menu_list'] = $this->_getOptionMenuVideo(0, "--",$data['menu']);
        $data['video_list'] = $this->msite_video->getSearchData($data['name'], $data['menu'], "DESC", $config['per_page'], $this->uri->segment(6));
        $this->my_layout->view("backend/site_video-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_video";
        $data['breadcrumbs'][1]["Name"] = lang('backend.video');
        $data['breadcrumbs'][2]["Url"] = "admin/site_video/add";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $data['video_menu'] = $this->_getOptionMenuVideoNoChild(0,"");
        $data['video_list'] = $this->msite_video->getAllData("DESC", 20, 0);
        
        $this->form_validation->set_rules("menu",lang('backend.menu'),"required");
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        $this->form_validation->set_rules("video",lang('backend.video'),"required");
        $this->form_validation->set_rules("img",lang('backend.img'),"required");
        $this->form_validation->set_rules("maincontent",lang('backend.maincontent'),"required|min_length[10]");
        $this->form_validation->set_rules("content",lang('backend.content'),"required|min_length[10]");
        
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/site_video-add",$data);
        }else{
            $thumb = $this->input->post("img");
            if(strrpos("wb".$this->input->post("img"),base_url())){
                if(_checkThumbImg($this->input->post("img"))){
                    $thumb = _checkThumbImg($this->input->post("img"));
                }
            }
            $add = array(
                    "Menu"          => $this->input->post("menu"),
                    "Name"          => $this->input->post("name"),
                    "Video"         => $this->input->post("video"),
                    "Img"           => $this->input->post("img"),
                    "Thumb1"        => $thumb,
                    "Thumb2"        => "",
                    "Thumb3"        => "",
                    "Thumb4"        => "",
                    "MainContent"   => $this->input->post("maincontent"),
                    "Content"       => $this->input->post("content",FALSE),
                    "Dateset"       => date("Y-m-d H:i:s"),
                    "Type"          => $this->input->post("type"),
                    "Hot"           => $this->input->post("hot"),
                    "New"           => $this->input->post("new"),
                    "Hit"           => 1,
                    "User"          => $this->session->userdata("WBUSERID"),
                    "Editor"        => $this->input->post("editor"),
                    "Source"        => $this->input->post("source"),
                    "Status"        => $this->input->post("status"),
                    "MTit"          => $this->input->post("mtit"),
                    "MKey"          => $this->input->post("mkey"),
                    "MDes"          => $this->input->post("mdes"),
                 );
            $this->msite_video->addData($add);
            redirect(base_url()."admin/site_video");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            $data['video_check'] = $this->msite_video->getDataByID($id);
            if($data['video_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_video";
                $data['breadcrumbs'][1]["Name"] = lang('backend.video');
                $data['breadcrumbs'][2]["Url"] = "admin/site_video/edit/{$data['video_check']['ID']}";
                $data['breadcrumbs'][2]["Name"] = $data['video_check']['Name'];
                
                $data['video_menu_parent'] = $this->msite_video_menu->getDataByID($data['video_check']['Menu']);
                $data['video_menu_parent'] = $data['video_menu_parent']["PID"];
                $data['video_menu_child'] = $this->_getOptionMenuVideoNoChild($data['video_menu_parent'],"",$data['video_check']['Menu']);
                $data['video_menu'] = $this->_getOptionMenuVideoNoChild(0,"-", $data['video_menu_parent']); 
                $data['video_list'] = $this->msite_video->getAllData("DESC", 20, 0);
        
                $this->form_validation->set_rules("menu",lang('backend.menu'),"required");
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("video",lang('backend.video'),"required");
                $this->form_validation->set_rules("img",lang('backend.img'),"required");
                $this->form_validation->set_rules("maincontent",lang('backend.maincontent'),"required|min_length[10]");
                $this->form_validation->set_rules("content",lang('backend.content'),"required|min_length[10]");
                
                if($this->form_validation->run() == FALSE){
                    $data['error'] = ""; 
                    $this->my_layout->view("backend/site_video-edit",$data);
                }else{
                    $thumb = $this->input->post("img");
                    if(strrpos("wb".$this->input->post("img"),base_url())){
                        if(_checkThumbImg($this->input->post("img"))){
                            $thumb = _checkThumbImg($this->input->post("img"));
                        }
                    }
                    $update = array(
                            "Menu"          => $this->input->post("menu"),
                            "Name"          => $this->input->post("name"),
                            "Video"         => $this->input->post("video"),
                            "Img"           => $this->input->post("img"),
                            "Thumb1"        => $thumb,
                            "Thumb2"        => $data['video_check']['Thumb2'],
                            "Thumb3"        => $data['video_check']['Thumb3'],
                            "Thumb4"        => $data['video_check']['Thumb4'],
                            "MainContent"   => $this->input->post("maincontent"),
                            "Content"       => $this->input->post("content",FALSE),
                            "Dateset"       => $data['video_check']['Dateset'],
                            "Type"          => $this->input->post("type"),
                            "Hot"           => $this->input->post("hot"),
                            "New"           => $this->input->post("new"),
                            "Hit"           => $data['video_check']['Hit'],
                            "User"          => $data['video_check']['User'],
                            "Editor"        => $this->input->post("editor"),
                            "Source"        => $this->input->post("source"),
                            "Status"        => $this->input->post("status"),
                            "MTit"          => $this->input->post("mtit"),
                            "MKey"          => $this->input->post("mkey"),
                            "MDes"          => $this->input->post("mdes"),
                         );
                    $this->msite_video->updateData($update, $id);
                    redirect(base_url()."admin/site_video");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_video");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_video");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['video_check'] = $this->msite_video->getDataByID($id);
            if($data['video_check']){
                $this->msite_video->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_video");
        exit();
    }
        
}