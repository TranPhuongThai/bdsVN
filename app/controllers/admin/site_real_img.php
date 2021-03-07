<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_real_img extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("msite_real","msite_real_img","msite_real_menu"));
    }
    
    function _getOptionreal($real, $prefix="", $active=""){
        $menu_list = $this->msite_real->getAllData("ASC", 99, 0);
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
    
    function _getOptionMenureal($pid, $prefix="", $active=""){
        $menu_list = $this->msite_real_menu->getPidStatusData($pid, 1, "ASC", 99, 0);
		$slt = "";
        foreach($menu_list as $row){
            if($active == $row['ID']){
                $slt .= "<option value=\"".$row['ID']."\" selected=\"selected\">".$prefix." ".$row['Name'];
            }else{
                $slt .= "<option value=\"".$row['ID']."\">".$prefix." ".$row['Name'];
            }
			$slt .= $this->_getOptionMenureal($row['ID'], $prefix.$prefix.$prefix.$prefix, $active);
        }
		return $slt;
    }
    public function index(){
        redirect(base_url()."admin/site_real_img/real/1");
        exit;
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_real_img";
        $data['breadcrumbs'][1]["Name"] = lang('backend.img');
        
        $config['base_url'] = base_url("admin/site_real_img/index");
        $config['total_rows'] = $this->msite_real_img->countAllData();
        $config['per_page'] = 10; 
        $config['uri_segment'] = 5;
        $this->pagination->initialize($config);
        
        $data['real_chosen'] = 0;
        $data['real_list'] = $this->_getOptionreal(0, "--", $data['real_chosen']);
        $data['real_img_list'] = $this->msite_real_img->getAllData("DESC", $config['per_page'], $this->uri->segment(5));
        $this->my_layout->view("backend/site_real_img-index",$data);
    }
    public function real($real = 1){
        if(is_numeric($real)){
            $data['real_check'] = $this->msite_real->getDataByID($real);
            if($data['real_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_real_img";
                $data['breadcrumbs'][1]["Name"] = lang('backend.img');
                $data['breadcrumbs'][2]["Url"] = "admin/site_real_img/real/".$data['real_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['real_check']['Name'];
                
                $config['base_url'] = base_url("admin/site_real_img/real/$real");
                $config['total_rows'] = $this->msite_real_img->countRealData($real);
                $config['per_page'] = 10; 
                $config['uri_segment'] = 6;
                $this->pagination->initialize($config);
                
                $data['real_chosen'] = $real;
                $data['real_img_list'] = $this->msite_real_img->getRealData($real, "DESC", $config['per_page'], $this->uri->segment(6));
                $this->my_layout->view("backend/site_real_img-index",$data);
                
            }else{
                redirect(base_url()."admin/site_real_img");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_real_img");
            exit();
        }
    }
    public function add($real = 1){
        if(is_numeric($real)){
            $data['real_check'] = $this->msite_real->getDataByID($real);
            if($data['real_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_real_img";
                $data['breadcrumbs'][1]["Name"] = lang('backend.img');
                $data['breadcrumbs'][2]["Url"] = "admin/site_real_img/real/".$data['real_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['real_check']['Name'];
                $data['breadcrumbs'][3]["Url"] = "#";
                $data['breadcrumbs'][3]["Name"] = lang('backend.add');
                
                $data['real_img_list'] = $this->msite_real_img->getAllData("DESC", 10, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("img",lang('backend.img'),"required");
                
                if($this->form_validation->run() == FALSE){
                    $data['error'] = ""; 
                    $this->my_layout->view("backend/site_real_img-add",$data);
                }else{
                    $add = array(
                            "Real"       => $real,
                            "Name"          => $this->input->post("name"),
                            "Img"           => $this->input->post("img"),
                            "Content"       => $this->input->post("content"),
                            "Dateset"       => date("Y-m-d H:i:s"),
                            "Level"         => $this->input->post("level"),
                            "Status"        => $this->input->post("status"),
                         );
                    $this->msite_real_img->addData($add);
                    redirect(base_url()."admin/site_real_img/real/".$real);
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_real_img");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_real_img");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){                   
            $data['real_img_check'] = $this->msite_real_img->getDataByID($id);
            if($data['real_img_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_real_img";
                $data['breadcrumbs'][1]["Name"] = lang('backend.img');
                $data['breadcrumbs'][2]["Url"] = "admin/site_real_img/edit/".$data['real_img_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['real_img_check']['Name'];
                
                $data['real_img_list'] = $this->msite_real_img->getAllData("DESC", 10, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("img",lang('backend.img'),"required");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_real_img-edit",$data);
                }else{
                    $update = array(
                        "Real"         => $data['real_img_check']['Real'],
                        "Name"          => $this->input->post("name"),
                        "Img"           => $this->input->post("img"),
                        "Content"       => $this->input->post("content"),
                        "Dateset"       => $data['real_img_check']['Dateset'],
                        "Level"         => $this->input->post("level"),
                        "Status"        => $this->input->post("status"),
                     );
                    $this->msite_real_img->updateData($update, $id);
                    redirect(base_url()."admin/site_real_img/real/".$data['real_img_check']['Real']);
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_real_img/real/".$data['real_img_check']['Real']);
                exit();
            }
        }else{
            redirect(base_url()."admin/site_real_img");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['real_img_check'] = $this->msite_real_img->getDataByID($id);
            if($data['real_img_check']){
                $this->msite_real_img->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_real_img/real/".$data['real_img_check']['Real']);
        exit();
    }
        
}