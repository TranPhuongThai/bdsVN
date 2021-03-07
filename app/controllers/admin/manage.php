<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Manage extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/wb_verify/logout");
            exit();
        }
        
    }
    public function index(){
        
        $this->load->models(array("madmin_menu","mwb_online","mwb_statistics","msite_news","msite_real","mwb_user"));
        $data['menu_site']  = $this->madmin_menu->getAllData("ASC", 99, 0);
        $data['menu_index'] = $this->madmin_menu->adminMenuIndex($this->my_auth->userdata("WBTYPE"),1, 1, "ASC", 99, 0);
        
        $data['online'] = $this->mwb_online->countOnline();
        $data['online_today'] = $this->mwb_statistics->getToDayOnline();
        $data['online_this_month'] = $this->mwb_statistics->getThisMonthOnline();
        $data['online_sum'] = $this->mwb_statistics->getSumOnline();
        
        $data['news_sum'] = $this->msite_news->countAllData();
        $data['real_sum'] = $this->msite_real->countAllData();
        $data['user_sum'] = $this->mwb_user->countAllData();
        
        $this->my_layout->view("backend/manage-index",$data);
    }
}