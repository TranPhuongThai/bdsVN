<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_contact_email extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("msite_contact_email","msite_add_province","msite_add_district"));   
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_contact_email";
        $data['breadcrumbs'][1]["Name"] = lang('backend.email');
        
        $data['email_list'] = $this->msite_contact_email->getAllData("ASC", 99, 0);
        $this->my_layout->view("backend/site_contact_email-index",$data);
    }
    public function edit($id){
        if(is_numeric($id)){ 
            $data['email_check'] = $this->msite_contact_email->getDataByID($id);
            if($data['email_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_contact_email";
                $data['breadcrumbs'][1]["Name"] = lang('backend.email');
                $data['breadcrumbs'][2]["Url"] = "#";
                $data['breadcrumbs'][2]["Name"] = $data['email_check']['Name'];
                
                $data['email_list'] = $this->msite_contact_email->getAllData("DESC", 10, 0);
                $data['province_list'] = $this->msite_add_province->getAllData("ASC",99,0);
                $data['district_list'] = $this->msite_add_district->getProvinceData($data['email_check']['Province'],"ASC",99,0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("email",lang('backend.email'),"required");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_contact_email-edit",$data);
                }else{
                    $update = array(
                        "Name"          => $this->input->post("name"),
                        "Phone"         => $this->input->post("phone"),
                        "Email"         => $this->input->post("email"),
                        "Address"       => $this->input->post("address"),
                        "Ward"          => 0,
                        "District"      => $this->input->post("district"),
                        "Province"      => $this->input->post("province"),
                        "Content"       => $this->input->post("content"),
                        "Status"        => $this->input->post("status"),
                     );
                    $this->msite_contact_email->updateData($update, $id);
                    redirect(base_url()."admin/site_contact_email");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_contact_email");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_contact_email");
            exit();
        }
    }
        
}