<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_add_ward extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("msite_add_ward","msite_add_district"));
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_add_ward";
        $data['breadcrumbs'][1]["Name"] = lang('backend.ward');
        
        $config['base_url'] = base_url("admin/site_add_ward/index");
        $config['total_rows'] = $this->msite_add_ward->countAllData();
        $config['per_page'] = 10; 
        $config['uri_segment'] = 4;
        
        $this->pagination->initialize($config);
        
        $data['district_list'] = $this->msite_add_district->getAllData("ASC", 99, 0);
        $data['ward_list'] = $this->msite_add_ward->getAllData("ASC", $config['per_page'], $this->uri->segment(4));
        $this->my_layout->view("backend/site_add_ward-index",$data);
    }
    public function fill($district){
        if(is_numeric($district)){
            $data['district_check'] = $this->msite_add_district->getDataByID($district);
            if($data['district_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_add_ward";
                $data['breadcrumbs'][1]["Name"] = lang('backend.ward');
                $data['breadcrumbs'][2]["Url"] = "admin/site_add_ward/fill/".$data['district_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['district_check']['Name'];
            
                $data['district_list'] = $this->msite_add_district->getAllData("ASC", 99, 0);
                $data['ward_list'] = $this->msite_add_ward->getDistrictData($district, "ASC", 99, 0);
                $this->my_layout->view("backend/site_add_ward-index",$data);
            }else{
                redirect(base_url()."admin/site_add_ward");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_add_ward");
            exit();
        }
    }
    public function add(){        
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_add_ward";
        $data['breadcrumbs'][1]["Name"] = lang('backend.ward');
        $data['breadcrumbs'][2]["Url"] = "#";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $data['district_list'] = $this->msite_add_district->getProvinceData(8, "ASC", 999, 0);
        $data['ward_list'] = $this->msite_add_ward->getAllData("DESC", 10, 0);
        
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        $this->form_validation->set_rules("district",lang('backend.district'),"required");
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/site_add_ward-add",$data);
        }else{
            $add = array(
                    "Name"          => $this->input->post("name"),
                    "District"      => $this->input->post("district"),
                    "Level"         => $this->input->post("level"),
                    "Status"        => $this->input->post("status"),
                 );
            $this->msite_add_ward->addData($add);
            redirect(base_url()."admin/site_add_ward");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){            
            $data['ward_check'] = $this->msite_add_ward->getDataByID($id);
            if($data['ward_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_add_ward";
                $data['breadcrumbs'][1]["Name"] = lang('backend.ward');
                $data['breadcrumbs'][2]["Url"] = "admin/site_add_ward/edit/".$data['ward_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['ward_check']['Name'];
                
                $data['district_list'] = $this->msite_add_district->getProvinceData(8, "ASC", 999, 0);
                $data['ward_list'] = $this->msite_add_ward->getDistrictData($data['ward_check']['District'],"DESC", 10, 0);
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("district",lang('backend.district'),"required");
                
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_add_ward-edit",$data);
                }else{
                    $update = array(
                        "Name"          => $this->input->post("name"),
                        "District"      => $this->input->post("district"),
                        "Level"         => $this->input->post("level"),
                        "Status"        => $this->input->post("status"),
                     );
                    $this->msite_add_ward->updateData($update, $id);
                    redirect(base_url()."admin/site_add_ward/");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_add_ward");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_add_ward");
            exit();
        }
    }
    public function delete($id){
        $this->load->model("msite_add_ward");
        if(is_numeric($id)){
            $data['ward_check'] = $this->msite_add_ward->getDataByID($id);
            if($data['ward_check']){
                $this->msite_add_ward->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_add_ward");
        exit();
    }
        
}