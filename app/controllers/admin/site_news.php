<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_news extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("msite_news","msite_news_menu"));
    }
    function _getOptionMenuNews($pid, $prefix="", $active=""){
        $menu_list = $this->msite_news_menu->getPidStatusData($pid, 1, "ASC", 99, 0);
		$slt = "";
        foreach($menu_list as $row){
            if($active == $row['ID']){
                $slt .= "<option value=\"".$row['ID']."\" selected=\"selected\">".$prefix." ".$row['Name'];
            }else{
                $slt .= "<option value=\"".$row['ID']."\">".$prefix." ".$row['Name'];
            }
			$slt .= $this->_getOptionMenuNews($row['ID'], $prefix.$prefix.$prefix.$prefix, $active);
        }
		return $slt;
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_news";
        $data['breadcrumbs'][1]["Name"] = lang('backend.news');        
        
        $config['base_url'] = base_url("admin/site_news/index");
        $config['total_rows'] = $this->msite_news->countAllData();
        $config['per_page'] = 10; 
        $config['uri_segment'] = 4;
                
        $config['next_link'] = "&rsaquo;";
        $config['prev_link'] = "&lsaquo;";
        $config['last_link'] = '&raquo;';
        $config['first_link'] = '&laquo;';
        $config['num_links'] = 5;
        
        $config['first_tag_open'] = '<div class="first-last text">';
        $config['first_tag_close'] = '</div>';
        $config['last_tag_open'] = '<div class="first-last text">';
        $config['last_tag_close'] = '</div>';
        $config['next_tag_open'] = '<div class="next-prev text">';
        $config['next_tag_close'] = '</div>';
        $config['prev_tag_open'] = '<div class="next-prev text">';
        $config['prev_tag_close'] = '</div>';
        
        $config['cur_tag_open'] = '<div class="number active">';
        $config['cur_tag_close'] = '</div>';
        $config['num_tag_open'] = '<div class="number">';
        $config['num_tag_close'] = '</div>';
        
        $this->pagination->initialize($config);
        
        $data['name'] = "";
        $data['menu_list'] = $this->_getOptionMenuNews(0, "--");
        $data['news_list'] = $this->msite_news->getAllData("DESC", $config['per_page'], $this->uri->segment(4));
        
        $this->my_layout->view("backend/site_news-index",$data);
    }
    public function menu($menu){
        
        $data['menu'] = $this->input->post("menu");
        if(!$data['menu']){
            $data['menu'] = (int)($menu);
        }
        if($data['menu']){
            $data['menu_check'] = $this->msite_news_menu->getDataByID($data['menu']);
            if($data['menu_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_news";
                $data['breadcrumbs'][1]["Name"] = lang('backend.news'); 
                $data['breadcrumbs'][2]["Url"] = "admin/site_news/menu/".$data['menu_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['menu_check']['Name'];      
        
                $config['base_url'] = base_url("admin/site_news/menu/{$data['menu']}");
                $config['total_rows'] = $this->msite_news->countSearchData("", $data['menu']);
                $config['per_page'] = 10; 
                $config['uri_segment'] = 5;
                
                $config['next_link'] = "&rsaquo;";
                $config['prev_link'] = "&lsaquo;";
                $config['last_link'] = '&raquo;';
                $config['first_link'] = '&laquo;';
                $config['num_links'] = 5;
                
                $config['first_tag_open'] = '<div class="first-last text">';
                $config['first_tag_close'] = '</div>';
                $config['last_tag_open'] = '<div class="first-last text">';
                $config['last_tag_close'] = '</div>';
                $config['next_tag_open'] = '<div class="next-prev text">';
                $config['next_tag_close'] = '</div>';
                $config['prev_tag_open'] = '<div class="next-prev text">';
                $config['prev_tag_close'] = '</div>';
                
                $config['cur_tag_open'] = '<div class="number active">';
                $config['cur_tag_close'] = '</div>';
                $config['num_tag_open'] = '<div class="number">';
                $config['num_tag_close'] = '</div>';
                
                $this->pagination->initialize($config);
                
                $data['name'] = "";
                $data['menu_list'] = $this->_getOptionMenuNews(0, "--",$data['menu']);
                $data['news_list'] = $this->msite_news->getSearchData("", $data['menu'], "DESC", $config['per_page'], $this->uri->segment(5));
                $this->my_layout->view("backend/site_news-index",$data);
            }else{
                redirect(base_url()."admin/site_news");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_news");
            exit();
        }
    }
    public function search($name="", $menu=""){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_news";
        $data['breadcrumbs'][1]["Name"] = lang('backend.news'); 
        $data['breadcrumbs'][2]["Url"] = "#";
        $data['breadcrumbs'][2]["Name"] = lang('backend.search');  
        
        $data['name'] = $this->input->post("name");
        $data['menu'] = $this->input->post("menu");
        if(!$data['name'] && $name){
            $data['name'] = urldecode($name);
        }
        if(!$data['menu']){
            $data['menu'] = 0;
        }
        if(!$data['menu'] && $menu){
            $data['menu'] = urldecode($menu);
        }
        
        $nameS = $data['name'];
        if(!$data['name']){
            $data['name'] = 'none';
        }
        if($data['name'] == 'none'){
            $nameS = '';
        }
        
        $config['base_url'] = base_url("admin/site_news/search/{$data['name']}/{$data['menu']}");
        $config['total_rows'] = $this->msite_news->countSearchData($nameS, $data['menu']);
        $config['per_page'] = 10; 
        $config['uri_segment'] = 6;
        
                
        $config['next_link'] = "&rsaquo;";
        $config['prev_link'] = "&lsaquo;";
        $config['last_link'] = '&raquo;';
        $config['first_link'] = '&laquo;';
        $config['num_links'] = 5;
        
        $config['first_tag_open'] = '<div class="first-last text">';
        $config['first_tag_close'] = '</div>';
        $config['last_tag_open'] = '<div class="first-last text">';
        $config['last_tag_close'] = '</div>';
        $config['next_tag_open'] = '<div class="next-prev text">';
        $config['next_tag_close'] = '</div>';
        $config['prev_tag_open'] = '<div class="next-prev text">';
        $config['prev_tag_close'] = '</div>';
        
        $config['cur_tag_open'] = '<div class="number active">';
        $config['cur_tag_close'] = '</div>';
        $config['num_tag_open'] = '<div class="number">';
        $config['num_tag_close'] = '</div>';
        
        $this->pagination->initialize($config);
        
        $data['menu_list'] = $this->_getOptionMenuNews(0, "--",$data['menu']);
        $data['news_list'] = $this->msite_news->getSearchData($nameS, $data['menu'], "DESC", $config['per_page'], $this->uri->segment(6));
        $this->my_layout->view("backend/site_news-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_news";
        $data['breadcrumbs'][1]["Name"] = lang('backend.news'); 
        $data['breadcrumbs'][2]["Url"] = "#";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');  
                
        $data['news_menu'] = $this->_getOptionMenuNews(0,"--");
        $data['news_list'] = $this->msite_news->getAllData("DESC", 20, 0);
        
        $this->form_validation->set_rules("menu",lang('backend.menu'),"required");
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        $this->form_validation->set_rules("img",lang('backend.img'),"required");
        $this->form_validation->set_rules("maincontent",lang('backend.maincontent'),"required|min_length[10]");
        $this->form_validation->set_rules("content",lang('backend.content'),"required|min_length[10]");
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/site_news-add",$data);
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
                    "User"          => $this->session->userdata("WBUSERID"),
                    "Editor"        => $this->input->post("editor"),
                    "Source"        => $this->input->post("source"),
                    "Status"        => $this->input->post("status"),
                    "Tags"          => $this->input->post("tags"),
                    "MTit"          => $this->input->post("mtit"),
                    "MKey"          => $this->input->post("mkey"),
                    "MDes"          => $this->input->post("mdes"),
                 );
            $this->msite_news->addData($add);
            redirect(base_url()."admin/site_news");
            exit();
        }
    }
    public function edit($id){  
        if(is_numeric($id)){
            $data['news_check'] = $this->msite_news->getDataByID($id);
            if($data['news_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_news";
                $data['breadcrumbs'][1]["Name"] = lang('backend.news'); 
                $data['breadcrumbs'][2]["Url"] = "admin/site_news/edit/".$data['news_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['news_check']['Name'];  
                
                $data['news_menu'] = $this->_getOptionMenuNews(0,"-", $data['news_check']['Menu']); 
                $data['news_list'] = $this->msite_news->getAllData("DESC", 20, 0);
                
                $this->form_validation->set_rules("menu",lang('backend.menu'),"required");
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("img",lang('backend.img'),"required");
                $this->form_validation->set_rules("maincontent",lang('backend.maincontent'),"required|min_length[10]");
                $this->form_validation->set_rules("content",lang('backend.content'),"required|min_length[10]");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = ""; 
                    $this->my_layout->view("backend/site_news-edit",$data);
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
                            "Img"           => $this->input->post("img"),
                            "Thumb1"        => $thumb,
                            "Thumb2"        => $data['news_check']['Thumb2'],
                            "Thumb3"        => $data['news_check']['Thumb3'],
                            "Thumb4"        => $data['news_check']['Thumb4'],
                            "MainContent"   => $this->input->post("maincontent"),
                            "Content"       => $this->input->post("content"),
                            "Dateset"       => $data['news_check']['Dateset'],
                            "Type"          => $this->input->post("type"),
                            "Hot"           => $this->input->post("hot"),
                            "New"           => $this->input->post("new"),
                            "Hit"           => $data['news_check']['Hit'],
                            "User"          => $data['news_check']['User'],
                            "Editor"        => $this->input->post("editor"),
                            "Source"        => $this->input->post("source"),
                            "Status"        => $this->input->post("status"),
                            "Tags"          => $this->input->post("tags"),
                            "MTit"          => $this->input->post("mtit"),
                            "MKey"          => $this->input->post("mkey"),
                            "MDes"          => $this->input->post("mdes"),
                         );
                    $this->msite_news->updateData($update, $id);
                    redirect(base_url()."admin/site_news");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_news");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_news");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['news_check'] = $this->msite_news->getDataByID($id);
            if($data['news_check']){
                $this->msite_news->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_news");
        exit();
    }
        
}