<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_add_district extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("msite_add_district","msite_add_province"));
    }
    public function index(){
        redirect(base_url()."admin/site_add_district/fill/8");
        exit;
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_add_district";
        $data['breadcrumbs'][1]["Name"] = lang('backend.district');
        
        $config['base_url'] = base_url("admin/site_add_district/index");
        $config['total_rows'] = $this->msite_add_district->countAllData();
        $config['per_page'] = 10; 
        $config['uri_segment'] = 4;
        
        $this->pagination->initialize($config);
        
        $data['province_list'] = $this->msite_add_province->getAllData("ASC", 99, 0);
        $data['district_list'] = $this->msite_add_district->getAllData("ASC", $config['per_page'], $this->uri->segment(4));
        $this->my_layout->view("backend/site_add_district-index",$data);
    }
    public function fill($province){
        if(is_numeric($province)){
            $data['province_check'] = $this->msite_add_province->getDataByID($province);
            if($data['province_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_add_district";
                $data['breadcrumbs'][1]["Name"] = lang('backend.district');
                $data['breadcrumbs'][2]["Url"] = "admin/site_add_district/fill/".$data['province_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['province_check']['Name'];
            
                $data['province_list'] = $this->msite_add_province->getAllData("ASC", 99, 0);
                $data['district_list'] = $this->msite_add_district->getProvinceData($province, "ASC", 99, 0);
                $this->my_layout->view("backend/site_add_district-index",$data);
            }else{
                redirect(base_url()."admin/site_add_district");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_add_district");
            exit();
        }
    }
    public function add(){        
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_add_district";
        $data['breadcrumbs'][1]["Name"] = lang('backend.district');
        $data['breadcrumbs'][2]["Url"] = "#";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $data['province_list'] = $this->msite_add_province->getAllData("ASC", 99, 0);
        $data['district_list'] = $this->msite_add_district->getAllData("DESC", 10, 0);
        
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        $this->form_validation->set_rules("province",lang('backend.province'),"required");
        if($this->form_validation->run() == FALSE){
            $data['error'] = ""; 
            $this->my_layout->view("backend/site_add_district-add",$data);
        }else{
            $add = array(
                    "Name"          => $this->input->post("name"),
                    "Province"      => $this->input->post("province"),
                    "Level"         => $this->input->post("level"),
                    "Status"        => $this->input->post("status"),
                    "MTit"          => $this->input->post("mtit"),
                    "MKey"          => $this->input->post("mkey"),
                    "MDes"          => $this->input->post("mdes"),
                 );
            $this->msite_add_district->addData($add);
            redirect(base_url()."admin/site_add_district");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){            
            $data['district_check'] = $this->msite_add_district->getDataByID($id);
            if($data['district_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_add_district";
                $data['breadcrumbs'][1]["Name"] = lang('backend.district');
                $data['breadcrumbs'][2]["Url"] = "admin/site_add_district/edit/".$data['district_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['district_check']['Name'];
                
                $data['province_list'] = $this->msite_add_province->getAllData("ASC", 99, 0);
                $data['district_list'] = $this->msite_add_district->getProvinceData($data['district_check']['Province'],"DESC", 10, 0);
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("province",lang('backend.province'),"required");
                
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_add_district-edit",$data);
                }else{
                    $update = array(
                        "Name"          => $this->input->post("name"),
                        "Province"      => $this->input->post("province"),
                        "Level"         => $this->input->post("level"),
                        "Status"        => $this->input->post("status"),
                        "MTit"          => $this->input->post("mtit"),
                        "MKey"          => $this->input->post("mkey"),
                        "MDes"          => $this->input->post("mdes"),
                     );
                    $this->msite_add_district->updateData($update, $id);
                    redirect(base_url()."admin/site_add_district/fill/".$data['district_check']['Province']);
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_add_district");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_add_district");
            exit();
        }
    }
    public function delete($id){
        $this->load->model("msite_add_district");
        if(is_numeric($id)){
            $data['district_check'] = $this->msite_add_district->getDataByID($id);
            if($data['district_check']){
                $this->msite_add_district->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_add_district");
        exit();
    }
        
}