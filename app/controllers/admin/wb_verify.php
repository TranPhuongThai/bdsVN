<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Wb_verify extends Application{
    public $data;
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        redirect(base_url()."admin/wb_verify/logout");
    }
    public function login(){
        if($this->my_auth->is_Admin()){
            redirect(base_url()."admin/manage");
            exit();
        }elseif($this->my_auth->is_Login()){
            redirect(base_url()."admin/wb_verify/logout");
            exit();
        }
        
        $data['miniTitle'] = lang('backend.login');
        $this->form_validation->set_rules("username",lang('backend.username'),"required|valid_email");
        $this->form_validation->set_rules("password",lang('backend.password'),"required||min_length[6]");
        
        if($this->form_validation->run() == FALSE){
            $data['error'] = "";
            $this->my_layout->view("backend/wb_verify", $data);            
        }else{
            $u = $this->input->post("username");
            $p = $this->input->post("password");
            $this->config->load("config");
            $encryption_key = $this->config->item("encryption_key");
            $p = md5(md5($encryption_key).md5($p));
            $checkUser = $this->mwb_user->checkLogin($u,$p);
            if($checkUser){
                if(!$this->my_auth->is_Active($checkUser['ID'])){
                    $data['error'] = lang('backend.alertnoactive');
                }else{
                    if($checkUser['Type'] > 5){
                        redirect(base_url("admin/wb_verify/login"));
                        exit();
                    }
                    $data = array("WBUSERID" => $checkUser['ID'], "WBTYPE" => $checkUser['Type']);
                    $this->my_auth->set_userdata($data);
                    redirect(base_url()."admin/manage");
                    exit();
                }
            }else{
                $data['error'] = lang('backend.alertloginfalse');
            }
            $this->my_layout->view("backend/wb_verify", $data);
        }
    }
    public function logout(){
        $this->my_auth->sess_destroy();
		redirect(base_url()."admin/wb_verify/login");
    }
}