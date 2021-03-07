<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Pageuser extends MX_Controller{

    public function __construct(){

        parent::__construct();
        

    }

    public function info(){
        $data = $this->my_auth->is_Member_Login();
        
        if(!$data['userid']){
            redirect(base_url());
        }
        $data['menu'] = 0;
        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);
        //modules
        $data['zone'] = $this->load->module("zone");
        $data['moduser'] = $this->load->module("moduser");
        $this->load->view("pageuser/pageuser-info",$data);
    }

    public function changepass(){
        $data = $this->my_auth->is_Member_Login();
        
        if(!$data['userid']){
            redirect(base_url());
        }
        $data['menu'] = 0;
        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);
        //modules
        $data['zone'] = $this->load->module("zone");
        $data['moduser'] = $this->load->module("moduser");
        $this->load->view("pageuser/pageuser-changepass",$data);
    }

    public function add(){
        $data = $this->my_auth->is_Member_Login();
        
        if(!$data['userid']){
            redirect(base_url());
        }
        $data['menu'] = 0;
        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);
        //modules
        $data['zone'] = $this->load->module("zone");
        $data['moduser'] = $this->load->module("moduser");
        $this->load->view("pageuser/pageuser-add",$data);
    }

    public function edit($id){
        $data = $this->my_auth->is_Member_Login();
        
        if(!$data['userid']){
            redirect(base_url());
        }
        $data['menu'] = 0;
        $data['id'] = $id;
        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);
        //modules
        $data['zone'] = $this->load->module("zone");
        $data['moduser'] = $this->load->module("moduser");
        $this->load->view("pageuser/pageuser-edit",$data);
    }

    public function real(){
        $data = $this->my_auth->is_Member_Login();
        
        if(!$data['userid']){
            redirect(base_url());
        }
        $data['menu'] = 0;
        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);
        //modules
        $data['zone'] = $this->load->module("zone");
        $data['moduser'] = $this->load->module("moduser");
        $this->load->view("pageuser/pageuser-real",$data);
    }

    public function active(){
        $data['menu'] = 0;
        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);
        //modules
        $data['zone'] = $this->load->module("zone");
        $data['moduser'] = $this->load->module("moduser");
        $this->load->view("pageuser/pageuser-active",$data);
    }

        

}