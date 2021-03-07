<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_news_comment extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("msite_news","msite_news_comment","msite_real"));
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_news_comment";
        $data['breadcrumbs'][1]["Name"] = 'Bình luận';        
        
        $config['base_url'] = base_url("admin/site_news_comment/index");
        $config['total_rows'] = $this->msite_news_comment->countAllData(0);
        $config['per_page'] = 10; 
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        
        $data['comment_list'] = $this->msite_news_comment->getAllData(0, "DESC", $config['per_page'], $this->uri->segment(4));
        
        $this->my_layout->view("backend/site_news_comment-index",$data);
    }
    public function edit($id){  
        if(is_numeric($id)){
            $data['comment_check'] = $this->msite_news_comment->getDataByID($id);
            if($data['comment_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_news_comment";
                $data['breadcrumbs'][1]["Name"] = 'Bình luận';     
                
                $data['comment_list'] = $this->msite_news_comment->getAllData(0,"DESC", 5, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("email",lang('backend.email'),"required");
                $this->form_validation->set_rules("content",lang('backend.content'),"required|min_length[10]");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = ""; 
                    $this->my_layout->view("backend/site_news_comment-edit",$data);
                }else{
                    $update = array(
                            "Name"          => $this->input->post("name"),
                            "Email"         => $this->input->post("email"),
                            "Content"       => $this->input->post("content"),
                            "Reply"         => $this->input->post("reply"),
                            "DateReply"     => date("Y-m-d H:i:s"),
                            "Status"        => $this->input->post("status"),
                         );
                    $this->msite_news_comment->updateData($update, $id);
                    redirect(base_url()."admin/site_news_comment");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_news_comment");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_news_comment");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['comment_check'] = $this->msite_news_comment->getDataByID($id);
            if($data['comment_check']){
                $this->msite_news_comment->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_news_comment");
        exit();
    }
    /*
    public function search($name="", $menu=""){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_news_comment";
        $data['breadcrumbs'][1]["Name"] = 'Bình luận';    
        
        $data['name'] = $this->input->post("name");
        $data['menu'] = $this->input->post("menu");
        if(!$data['name'] && $name){
            $data['name'] = urldecode($name);
        }
        if(!$data['menu'] && $menu){
            $data['menu'] = urldecode($menu);
        }
        
        $config['base_url'] = base_url("admin/site_news/search/{$data['name']}/{$data['menu']}");
        $config['total_rows'] = $this->msite_news->countSearchData($data['name'], $data['menu']);
        $config['per_page'] = 10; 
        $config['uri_segment'] = 6;
        $this->pagination->initialize($config);
        
        $data['menu_list'] = $this->_getOptionMenuNews(0, "--",$data['menu']);
        $data['comment_list'] = $this->msite_news->getSearchData($data['name'], $data['menu'], "DESC", $config['per_page'], $this->uri->segment(6));
        $this->my_layout->view("backend/site_news-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_news_comment";
        $data['breadcrumbs'][1]["Name"] = 'Bình luận';    
                
        $data['news_menu'] = $this->_getOptionMenuNews(0,"--");
        $data['comment_list'] = $this->msite_news->getAllData("DESC", 20, 0);
        
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
            redirect(base_url()."admin/site_news_comment");
            exit();
        }
    }
    */
        
}