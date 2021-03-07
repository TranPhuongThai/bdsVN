<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_product extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("msite_product","msite_product_menu","msite_product_maker"));
    }
    
    function _getOptionMenuProduct($pid, $prefix="", $active=""){
        $menu_list = $this->msite_product_menu->getPidStatusData($pid, 1, "ASC", 99, 0);
		$slt = "";
        foreach($menu_list as $row){
            if($active == $row['ID']){
                $slt .= "<option value=\"".$row['ID']."\" selected=\"selected\">".$prefix." ".$row['Name'];
            }else{
                $slt .= "<option value=\"".$row['ID']."\">".$prefix." ".$row['Name'];
            }
			$slt .= $this->_getOptionMenuProduct($row['ID'], $prefix.$prefix.$prefix.$prefix, $active);
        }
		return $slt;
    }
    
    function _getOptionMakerProduct($status, $prefix="", $active=""){
        $menu_list = $this->msite_product_maker->getStatusData($status,"ASC", 99, 0);
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
        $data['breadcrumbs'][1]["Url"] = "admin/site_product";
        $data['breadcrumbs'][1]["Name"] = lang('backend.product');
        
        $config['base_url'] = base_url("admin/site_product/index");
        $config['total_rows'] = $this->msite_product->countAllData();
        $config['per_page'] = 10; 
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        
        $data['name'] = "";
        $data['menu_list'] = $this->_getOptionMenuProduct(0, "--");
        $data['product_list'] = $this->msite_product->getAllData("ASC", $config['per_page'], $this->uri->segment(4));
        
        $this->my_layout->view("backend/site_product-index",$data);
    }
    public function menu($menu){
        $data['menu'] = $this->input->post("menu");
        if(!$data['menu'] && $menu){
            $data['menu'] = urldecode($menu);
        }
        if($data['menu']){
            $data['menu_check'] = $this->msite_product_menu->getDataByID($data['menu']);
            if($data['menu_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_product";
                $data['breadcrumbs'][1]["Name"] = lang('backend.product');
                $data['breadcrumbs'][2]["Url"] = "admin/site_product/menu/".$data['menu_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['menu_check']['Name'];
        
                $config['base_url'] = base_url("admin/site_product/menu/{$data['menu_check']['ID']}");
                $config['total_rows'] = $this->msite_product->countSearchData("", $data['menu']);
                $config['per_page'] = 10; 
                $config['uri_segment'] = 5;                
                $this->pagination->initialize($config);
                
                $data['name'] = "";
                $data['menu_list'] = $this->_getOptionMenuProduct(0, "--",$data['menu']);
                $data['product_list'] = $this->msite_product->getSearchData("", $data['menu'], "ASC", $config['per_page'], $this->uri->segment(5));
                $this->my_layout->view("backend/site_product-index",$data);
            }else{
                redirect(base_url()."admin/site_product");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_product");
            exit();
        }
    }
    public function search($name="", $menu=""){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_product";
        $data['breadcrumbs'][1]["Name"] = lang('backend.product');
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
        
        $config['base_url'] = base_url("admin/site_product/search/{$data['name']}/{$data['menu']}");
        $config['total_rows'] = $this->msite_product->countSearchData($data['name'], $data['menu']);
        $config['per_page'] = 10; 
        $config['uri_segment'] = 6;
        $this->pagination->initialize($config);
        
        $data['menu_list'] = $this->_getOptionMenuProduct(0, "--",$data['menu']);
        $data['product_list'] = $this->msite_product->getSearchData($data['name'], $data['menu'], "ASC", $config['per_page'], $this->uri->segment(6));
        $this->my_layout->view("backend/site_product-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_product";
        $data['breadcrumbs'][1]["Name"] = lang('backend.product');
        $data['breadcrumbs'][2]["Url"] = "admin/site_product/add";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
                
        $data['product_menu'] = $this->_getOptionMenuProduct(0,"--");
        $data['product_list'] = $this->msite_product->getAllData("DESC", 20, 0);
        $data['maker_list'] = $this->_getOptionMakerProduct(1, "--");
        
        $this->form_validation->set_rules("menu",lang('backend.menu'),"required");
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        $this->form_validation->set_rules("img",lang('backend.img'),"required");
        //$this->form_validation->set_rules("maincontent",lang('backend.maincontent'),"required|min_length[10]");
        $this->form_validation->set_rules("content",lang('backend.content'),"required|min_length[10]");
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/site_product-add",$data);
        }else{
            $thumb = $this->input->post("img");
            if(strrpos("wb".$this->input->post("img"),base_url())){
                if(_checkThumbImg($this->input->post("img"))){
                    $thumb = _checkThumbImg($this->input->post("img"));
                }
            }
            $cost = str_replace(array("."," ","VNĐ"),array("","",""),$this->input->post("cost"));
            $sale = str_replace(array("."," ","VNĐ"),array("","",""),$this->input->post("sale"));
            $add = array(
                    "Menu"          => $this->input->post("menu"),
                    "Maker"         => $this->input->post("maker"),
                    "Origin"        => $this->input->post("origin"),
                    "Name"          => $this->input->post("name"),
                    "Code"          => $this->input->post("code"),
                    "Cost"          => $cost,
                    "Sale"          => $sale,
                    "Amount"        => $this->input->post("amount"),
                    "Img"           => $this->input->post("img"),
                    "Thumb1"        => $thumb,
                    "Thumb2"        => "",
                    "Thumb3"        => "",
                    "Thumb4"        => "",
                    "MainContent"   => $this->input->post("maincontent"),
                    "Content"       => $this->input->post("content"),
                    "Dateset"       => date("Y-m-d H:i:s"),
                    "Type"          => $this->input->post("type"),
                    "Hot"           => $this->input->post("hot"),
                    "New"           => $this->input->post("new"),
                    "Hit"           => 1,
                    "Status"        => $this->input->post("status"),
                    "Tags"          => $this->input->post("tags"),
                    "MTit"          => $this->input->post("mtit"),
                    "MKey"          => $this->input->post("mkey"),
                    "MDes"          => $this->input->post("mdes"),
                 );
            $this->msite_product->addData($add);
            redirect(base_url()."admin/site_product");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            $data['product_check'] = $this->msite_product->getDataByID($id);
            if($data['product_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_product";
                $data['breadcrumbs'][1]["Name"] = lang('backend.product');
                $data['breadcrumbs'][2]["Url"] = "admin/site_product/edit/".$data['product_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['product_check']['Name'];
                
                $data['product_menu'] = $this->_getOptionMenuProduct(0,"-", $data['product_check']['Menu']); 
                $data['product_list'] = $this->msite_product->getAllData("DESC", 20, 0);
                $data['maker_list'] = $this->_getOptionMakerProduct(1, "--",$data['product_check']['Maker']);
                
                $this->form_validation->set_rules("menu",lang('backend.menu'),"required");
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("img",lang('backend.img'),"required");
                //$this->form_validation->set_rules("maincontent",lang('backend.maincontent'),"required|min_length[10]");
                $this->form_validation->set_rules("content",lang('backend.content'),"required|min_length[10]");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = ""; 
                    $this->my_layout->view("backend/site_product-edit",$data);
                }else{
                    $thumb = $this->input->post("img");
                    if(strrpos("wb".$this->input->post("img"),base_url())){
                        if(_checkThumbImg($this->input->post("img"))){
                            $thumb = _checkThumbImg($this->input->post("img"));
                        }
                    }
                    $cost = str_replace(array("."," ","VNĐ"),array("","",""),$this->input->post("cost"));
                    $sale = str_replace(array("."," ","VNĐ"),array("","",""),$this->input->post("sale"));
                    $update = array(
                            "Menu"          => $this->input->post("menu"),
                            "Maker"         => $this->input->post("maker"),
                            "Origin"        => $this->input->post("origin"),
                            "Name"          => $this->input->post("name"),
                            "Code"          => $this->input->post("code"),
                            "Cost"          => $cost,
                            "Sale"          => $sale,
                            "Amount"        => $this->input->post("amount"),
                            "Img"           => $this->input->post("img"),
                            "Thumb1"        => $thumb,
                            "Thumb2"        => $data['product_check']['Thumb2'],
                            "Thumb3"        => $data['product_check']['Thumb3'],
                            "Thumb4"        => $data['product_check']['Thumb4'],
                            "MainContent"   => $this->input->post("maincontent"),
                            "Content"       => $this->input->post("content"),
                            "Dateset"       => $data['product_check']['Dateset'],
                            "Type"          => $this->input->post("type"),
                            "Hot"           => $this->input->post("hot"),
                            "New"           => $this->input->post("new"),
                            "Hit"           => $data['product_check']['Hit'],
                            "Status"        => $this->input->post("status"),
                            "Tags"          => $this->input->post("tags"),
                            "MTit"          => $this->input->post("mtit"),
                            "MKey"          => $this->input->post("mkey"),
                            "MDes"          => $this->input->post("mdes"),
                         );
                    $this->msite_product->updateData($update, $id);
                    redirect(base_url()."admin/site_product");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_product");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_product");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['product_check'] = $this->msite_product->getDataByID($id);
            if($data['product_check']){
                $this->msite_product->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_product");
        exit();
    }
        
}