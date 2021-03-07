<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_product_menu_img extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("msite_product_menu","msite_product_menu_img"));
    }
    public function menu($menu = 0){
        if($menu){
            $data['menu_check'] = $this->msite_product_menu->getDataByID($menu);
            if($data['menu_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_product_menu/";
                $data['breadcrumbs'][1]["Name"] = lang('backend.menu_product');
                $data['breadcrumbs'][2]["Url"] = "admin/site_product_menu_img/menu/".$data['menu_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['menu_check']['Name'];
                $data['breadcrumbs'][3]["Url"] = "admin/site_product_menu_img/menu/".$data['menu_check']['ID'];
                $data['breadcrumbs'][3]["Name"] = lang('backend.img');
                
                $data['img_list'] = $this->msite_product_menu_img->getMenuData($menu);
                $this->my_layout->view("backend/site_product_menu_img-index",$data);
            }else{
                redirect(base_url()."admin/site_product_menu");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_product_menu");
            exit();
        }
    }
    public function add($menu = 0){
        if($menu){
            $data['menu_check'] = $this->msite_product_menu->getDataByID($menu);
            if($data['menu_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_product_menu/";
                $data['breadcrumbs'][1]["Name"] = lang('backend.menu_product');
                $data['breadcrumbs'][2]["Url"] = "admin/site_product_menu_img/menu/".$data['menu_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['menu_check']['Name'];
                $data['breadcrumbs'][3]["Url"] = "admin/site_product_menu_img/add/".$data['menu_check']['ID'];
                $data['breadcrumbs'][3]["Name"] = lang('backend.add');
                
                $data['img_list'] = $this->msite_product_menu_img->getMenuData($menu);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("img",lang('backend.img'),"required");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = ""; 
                    $this->my_layout->view("backend/site_product_menu_img-add",$data);
                }else{
                    $add = array(
                            "Menu"          => $menu,
                            "Name"          => $this->input->post("name"),
                            "Img"           => $this->input->post("img"),
                            "Content"       => $this->input->post("content"),
                            "Dateset"       => date("Y-m-d H:i:s"),
                            "Level"         => $this->input->post("level"),
                            "Status"        => $this->input->post("status"),
                         );
                    $this->msite_product_menu_img->addData($add);
                    redirect(base_url()."admin/site_product_menu_img/menu/".$menu);
                    exit();
                }
            }
        }else{
            redirect(base_url()."admin/site_product_menu");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            $data['img_check'] = $this->msite_product_menu_img->getDataByID($id);
            if($data['img_check']){
                $data['menu_check'] = $this->msite_product_menu->getDataByID($data['img_check']['Menu']);
                if($data['menu_check']){
                    $data['breadcrumbs'][0]["Url"] = "admin/manage";
                    $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                    $data['breadcrumbs'][1]["Url"] = "admin/site_product_menu/";
                    $data['breadcrumbs'][1]["Name"] = lang('backend.menu_product');
                    $data['breadcrumbs'][2]["Url"] = "admin/site_product_menu_img/menu/".$data['menu_check']['ID'];
                    $data['breadcrumbs'][2]["Name"] = $data['menu_check']['Name'];
                    $data['breadcrumbs'][3]["Url"] = current_url();
                    $data['breadcrumbs'][3]["Name"] = lang('backend.edit');
                    $data['img_list'] = $this->msite_product_menu_img->getMenuData($data['menu_check']['ID']);
                    
                    $this->form_validation->set_rules("name",lang('backend.name'),"required");
                    $this->form_validation->set_rules("img",lang('backend.img'),"required");
                    
                    if($this->form_validation->run() == FALSE){
                        $data['error'] = "";
                        $this->my_layout->view("backend/site_product_menu_img-edit",$data);
                    }else{
                        $update = array(
                            "Menu"          => $data['img_check']['Menu'],
                            "Name"          => $this->input->post("name"),
                            "Img"           => $this->input->post("img"),
                            "Content"       => $this->input->post("content"),
                            "Dateset"       => $data['img_check']['Dateset'],
                            "Level"         => $this->input->post("level"),
                            "Status"        => $this->input->post("status"),
                         );
                        $this->msite_product_menu_img->updateData($update, $id);
                        redirect(base_url()."admin/site_product_menu_img/menu/".$data['img_check']['Menu']);
                        exit();
                    }
                }
            }else{
                redirect(base_url()."admin/site_product_menu");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_product_menu");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['img_check'] = $this->msite_product_menu_img->getDataByID($id);
            if($data['img_check']){
                $this->msite_product_menu_img->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_product_menu_img/menu/".$data['img_check']['Menu']);
        exit();
    }
        
}