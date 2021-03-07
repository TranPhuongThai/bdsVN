<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_contact extends Application{
    public function __construct(){
        parent::__construct();
                
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model("msite_contact");
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_contact";
        $data['breadcrumbs'][1]["Name"] = lang('backend.contact');
        
        $data['contact_list'] = $this->msite_contact->getAllData("DESC", 99, 0);
        $this->my_layout->view("backend/site_contact-index",$data);
    }
    public function edit($id){
        if(is_numeric($id)){
            $this->load->model("msite_contact");
            
            $data['miniTitle'] = lang('backend.edit')." ".lang('backend.contact');
            $data['contact_check'] = $this->msite_contact->getDataByID($id);
            if($data['contact_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_contact";
                $data['breadcrumbs'][1]["Name"] = lang('backend.contact');
                $data['breadcrumbs'][2]["Url"] = "admin/site_contact/edit".$data['contact_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['contact_check']['Name'];
                
                $data['contact_list'] = $this->msite_contact->getAllData("DESC", 10, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_contact-edit",$data);
                }else{
                    $update = array(
                        "Name"          => $this->input->post("name"),
                        "Address"       => $this->input->post("address"),
                        "Phone"         => $this->input->post("phone"),
                        "Email"         => $this->input->post("email"),
                        "Content"       => $this->input->post("content"),
                        "Dateset"       => $data['contact_check']['Dateset'],
                        "Status"        => $this->input->post("status"),
                     );
                    $this->msite_contact->updateData($update, $id);
                    redirect(base_url()."admin/site_contact");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_contact");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_contact");
            exit();
        }
    }
    public function delete($id){
        $this->load->model("msite_contact");
        
        if(is_numeric($id)){
            $data['contact_check'] = $this->msite_contact->getDataByID($id);
            if($data['contact_check']){
                $this->msite_contact->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_contact");
        exit();
    }
        
}