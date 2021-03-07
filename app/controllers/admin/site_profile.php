<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_profile extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("madmin_menu","mwb_user","msite_add_province","msite_add_district"));
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_profile";
        $data['breadcrumbs'][1]["Name"] = lang('backend.profile');
        
        $data['menu_index'] = $this->madmin_menu->getPidStatusData(2, 1, "ASC", 99, 0);
        $data['user_check'] = $this->mwb_user->getDataByID($this->my_auth->userdata("WBUSERID"));
        if($data['user_check']){
            $data['user_check_province'] = $this->msite_add_province->getDataByID($data['user_check']['Province']);
            $data['user_check_district'] = $this->msite_add_district->getDataByID($data['user_check']['District']);
        }else{
            redirect(base_url()."admin/wb_verify/logout");
            exit();
        }
        $this->my_layout->view("backend/site_profile-index",$data);
    }
    public function info(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_profile";
        $data['breadcrumbs'][1]["Name"] = lang('backend.profile');
        $data['breadcrumbs'][2]["Url"] = "admin/site_profile/info";
        $data['breadcrumbs'][2]["Name"] = lang('backend.edit');
        
        $data['user_check'] = $this->mwb_user->getDataByID($this->my_auth->userdata("WBUSERID"));
        if($data['user_check']){
            $data['user_check_province'] = $this->msite_add_province->getDataByID($data['user_check']['Province']);
            $data['user_check_district'] = $this->msite_add_district->getDataByID($data['user_check']['District']);
            
            $data['province_list'] = $this->msite_add_province->getAllData("ASC",99,0);
            $data['district_list'] = $this->msite_add_district->getProvinceData($data['user_check']['Province'],"ASC",99,0);
            
            $this->form_validation->set_rules("name",lang('backend.fullname'),"required");
            if($this->form_validation->run() == FALSE){
                $data['error'] = ""; 
                $this->my_layout->view("backend/site_profile-info",$data);
            }else{
                
                $update = array(
                        "Name"          => $this->input->post("name"),
                        "Birthday"      => _dateToData($this->input->post("birthday")),
                        "Img"           => $this->input->post("img"),
                        "Address"       => $this->input->post("address"),
                        "Ward"          => 0,
                        "District"      => $this->input->post("district"),
                        "Province"      => $this->input->post("province"),
                        "Phone"         => $this->input->post("phone"),
                     );
                $this->mwb_user->updateData($update, $data['user_check']['ID']);
                redirect(base_url()."admin/site_profile");
                exit();
            }
        }else{
            redirect(base_url()."admin/wb_verify/logout");
            exit();
        }
    }
    public function changepass(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_profile";
        $data['breadcrumbs'][1]["Name"] = lang('backend.profile');
        $data['breadcrumbs'][2]["Url"] = "admin/site_profile/changepass";
        $data['breadcrumbs'][2]["Name"] = lang('backend.password');
        
        $this->config->load("config");
        $data['user_check'] = $this->mwb_user->getDataByID($this->my_auth->userdata("WBUSERID"));
        if($data['user_check']){
            $data['user_check_province'] = $this->msite_add_province->getDataByID($data['user_check']['Province']);
            $data['user_check_district'] = $this->msite_add_district->getDataByID($data['user_check']['District']);
            
            $this->form_validation->set_rules("password",lang('backend.password'),"required|trim|min_length[6]");
            $this->form_validation->set_rules("newpassword",lang('backend.newpassword'),"required|trim|min_length[6]");
            $this->form_validation->set_rules("repassword",lang('backend.retypepassword'),"required|trim|min_length[6]|matches[newpassword]");
            if($this->form_validation->run() == FALSE){
                $data['error'] = ""; 
                $this->my_layout->view("backend/site_profile-changepass",$data);
            }else{
                $encryption_key = $this->config->item("encryption_key");
                $oldpass = md5(md5($encryption_key).md5($this->input->post("password")));
                $encryption_key = $this->config->item("encryption_key");
                $newpass = md5(md5($encryption_key).md5($this->input->post("newpassword")));
                if($data['user_check']['Password'] == $oldpass){
                    $update = array(
                            "Password"          => $newpass,
                         );
                    $this->mwb_user->updateData($update, $data['user_check']['ID']);
                    redirect(base_url()."admin/site_profile");
                    exit();
                }else{
                    $data['error'] = lang('backend.password')." ".lang('backend.false'); 
                    $this->my_layout->view("backend/site_profile-changepass",$data);
                }
            }
        }else{
            redirect(base_url()."admin/wb_verify/logout");
            exit();
        }
    }
}