<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_partner extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("msite_partner");
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_partner";
        $data['breadcrumbs'][1]["Name"] = lang('backend.partner');
        
        $data['partner_list'] = $this->msite_partner->getAllData("ASC", 99, 0);
        $this->my_layout->view("backend/site_partner-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_partner";
        $data['breadcrumbs'][1]["Name"] = lang('backend.partner');
        $data['breadcrumbs'][2]["Url"] = "admin/site_partner/add";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $data['partner_list'] = $this->msite_partner->getAllData("DESC", 10, 0);
        
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        $this->form_validation->set_rules("img",lang('backend.img'),"required");
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/site_partner-add",$data);
        }else{
            $add = array(
                    "Name"          => $this->input->post("name"),
                    "Img"           => $this->input->post("img"),
                    "Link"          => $this->input->post("link"),
                    "Content"       => $this->input->post("content"),
                    "Level"         => $this->input->post("level"),
                    "Status"        => $this->input->post("status"),
                 );
            $this->msite_partner->addData($add);
            redirect(base_url()."admin/site_partner");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){            
            $data['partner_check'] = $this->msite_partner->getDataByID($id);
            if($data['partner_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_partner";
                $data['breadcrumbs'][1]["Name"] = lang('backend.partner');
                $data['breadcrumbs'][2]["Url"] = "admin/site_partner/edit/".$data['partner_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['partner_check']['Name'];
        
                $data['partner_list'] = $this->msite_partner->getAllData("DESC", 10, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("img",lang('backend.img'),"required");
                
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_partner-edit",$data);
                }else{
                    $update = array(
                        "Name"          => $this->input->post("name"),
                        "Img"           => $this->input->post("img"),
                        "Link"          => $this->input->post("link"),
                        "Content"       => $this->input->post("content"),
                        "Level"         => $this->input->post("level"),
                        "Status"        => $this->input->post("status"),
                     );
                    $this->msite_partner->updateData($update, $id);
                    redirect(base_url()."admin/site_partner");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_partner");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_partner");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['partner_check'] = $this->msite_partner->getDataByID($id);
            if($data['partner_check']){
                $this->msite_partner->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_partner");
        exit();
    }
        
}