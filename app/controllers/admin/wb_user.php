<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Wb_user extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("mwb_user","msite_add_province","msite_add_province","msite_add_district"));
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/wb_user";
        $data['breadcrumbs'][1]["Name"] = lang('backend.user');
        
        $config['base_url'] = base_url("admin/wb_user/index");
        $config['total_rows'] = $this->mwb_user->countAllData();
        $config['per_page'] = 10; 
        $config['uri_segment'] = 4;
                
        $config['next_link'] = "&rsaquo;";
        $config['prev_link'] = "&lsaquo;";
        $config['last_link'] = '&raquo;';
        $config['first_link'] = '&laquo;';
        $config['num_links'] = 5;
        
        $config['first_tag_open'] = '<div class="first-last text">';
        $config['first_tag_close'] = '</div>';
        $config['last_tag_open'] = '<div class="first-last text">';
        $config['last_tag_close'] = '</div>';
        $config['next_tag_open'] = '<div class="next-prev text">';
        $config['next_tag_close'] = '</div>';
        $config['prev_tag_open'] = '<div class="next-prev text">';
        $config['prev_tag_close'] = '</div>';
        
        $config['cur_tag_open'] = '<div class="number active">';
        $config['cur_tag_close'] = '</div>';
        $config['num_tag_open'] = '<div class="number">';
        $config['num_tag_close'] = '</div>';
        
        $this->pagination->initialize($config);
        $data['text'] = "";
        $data['user_list'] = $this->mwb_user->getAllData("DESC", $config['per_page'], $this->uri->segment(4));
        $this->my_layout->view("backend/wb_user-index",$data);
    }
    public function search($text=""){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/wb_user";
        $data['breadcrumbs'][1]["Name"] = lang('backend.user');
        $data['breadcrumbs'][2]["Url"] = "#";
        $data['breadcrumbs'][2]["Name"] = lang('backend.search');
        
        $data['text'] = $this->input->post("text");
        if(!$data['text'] && $text){
            $data['text'] = urldecode($text);
        }
        if($data['text']){
            $config['base_url'] = base_url("admin/wb_user/search/".$data['text']);
            $config['total_rows'] = $this->mwb_user->countSearchData($data['text']);
            $config['per_page'] = 10; 
            $config['uri_segment'] = 5;
                    
            $config['next_link'] = "&rsaquo;";
            $config['prev_link'] = "&lsaquo;";
            $config['last_link'] = '&raquo;';
            $config['first_link'] = '&laquo;';
            $config['num_links'] = 5;
            
            $config['first_tag_open'] = '<div class="first-last text">';
            $config['first_tag_close'] = '</div>';
            $config['last_tag_open'] = '<div class="first-last text">';
            $config['last_tag_close'] = '</div>';
            $config['next_tag_open'] = '<div class="next-prev text">';
            $config['next_tag_close'] = '</div>';
            $config['prev_tag_open'] = '<div class="next-prev text">';
            $config['prev_tag_close'] = '</div>';
            
            $config['cur_tag_open'] = '<div class="number active">';
            $config['cur_tag_close'] = '</div>';
            $config['num_tag_open'] = '<div class="number">';
            $config['num_tag_close'] = '</div>';

            $this->pagination->initialize($config);
            
            $data['user_list'] = $this->mwb_user->getSearchData($data['text'],"DESC", $config['per_page'], $this->uri->segment(5));
            
            $this->my_layout->view("backend/wb_user-index",$data);
        }else{
            redirect(base_url()."admin/wb_user");
            exit();
        }
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/wb_user";
        $data['breadcrumbs'][1]["Name"] = lang('backend.user');
        $data['breadcrumbs'][2]["Url"] = "admin/wb_user/add";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $this->config->load("config");
        $data['user_type'] = $this->mwb_tuser->getAddData($this->my_auth->userdata("WBTYPE"),"ASC", 99, 0);
        if($data['user_type']){
            $data['miniTitle'] = lang('backend.add')." ".lang('backend.user');
            
            $data['user_list'] = $this->mwb_user->getAllData("DESC", 10, 0);
            $data['province_list'] = $this->msite_add_province->getAllData("ASC",99,0);
            $data['district_list'] = $this->msite_add_district->getProvinceData(31,"ASC",99,0);
            
            $this->form_validation->set_rules("name",lang('backend.name'),"required");
            $this->form_validation->set_rules("username",lang('backend.username'),"required|valid_email");
            $this->form_validation->set_rules("password",lang('backend.password'),"required|min_length[6]");
            $this->form_validation->set_rules("type",lang('backend.permis'),"required");
            
            if($this->form_validation->run() == FALSE){
                $data['error'] = ""; 
                $this->my_layout->view("backend/wb_user-add",$data);
            }else{
                $checkEmail = $this->mwb_user->getDataByUsername($this->input->post("username"));
                if($checkEmail){
                    $data['error'] = lang('backend.alertsameemail'); 
                    $this->my_layout->view("backend/wb_user-add",$data);     
                }else{
                    $encryption_key = $this->config->item("encryption_key");
                    $pass = md5(md5($encryption_key).md5($this->input->post("password")));
                    $birthday = date("d/m/Y");
                    if($this->input->post("birthday"))
                        $birthday = $this->input->post("birthday");
                    $add = array(
                            "Username"      => $this->input->post("username"),
                            "Password"      => $pass,
                            "Type"          => $this->input->post("type"),
                            "Name"          => $this->input->post("name"),
                            "Birthday"      => _dateToData($birthday),
                            "Img"           => $this->input->post("img"),
                            "Address"       => $this->input->post("address"),
                            "Ward"          => 0,
                            "District"      => $this->input->post("district"),
                            "Province"      => $this->input->post("province"),
                            "Phone"         => $this->input->post("phone"),
                            "Email"         => $this->input->post("username"),
                            "Dateset"       => date("Y-m-d H:i:s"),
                            "Active"        => 1,
                            "Key"           => "",
                            "Status"        => 1,
                         );
                    $this->mwb_user->addData($add);
                    redirect(base_url()."admin/wb_user");
                    exit();
                }
            }
        }else{
            redirect(base_url()."admin/wb_user");
            exit();
        }
    }
    public function edit($id){
        if(is_numeric($id)){
            $this->config->load("config");
            $data['user_type'] = $this->mwb_tuser->getAddData($this->my_auth->userdata("WBTYPE"),"ASC", 99, 0);
            $data['user_check'] = $this->mwb_user->getDataByID($id);
            if($data['user_type'] && $data['user_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/wb_user";
                $data['breadcrumbs'][1]["Name"] = lang('backend.user');
                $data['breadcrumbs'][2]["Url"] = "admin/wb_user/edit/{$data['user_check']['ID']}";
                $data['breadcrumbs'][2]["Name"] = $data['user_check']['Username'];
                
                $data['user_list'] = $this->mwb_user->getAllData("DESC", 10, 0);
                $data['province_list'] = $this->msite_add_province->getAllData("ASC",99,0);
                $data['district_list'] = $this->msite_add_district->getProvinceData($data['user_check']['Province'],"ASC",99,0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                $this->form_validation->set_rules("type",lang('backend.permis'),"required");
                
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/wb_user-edit",$data);
                }else{
                    $encryption_key = $this->config->item("encryption_key");
                    if($this->input->post("password"))
                        $pass = md5(md5($encryption_key).md5($this->input->post("password")));
                    else    
                        $pass = $data['user_check']['Password'];
                    $update = array(
                        "Username"      => $data['user_check']['Username'],
                        "Password"      => $pass,
                        "Type"          => $this->input->post("type"),
                        "Name"          => $this->input->post("name"),
                        "Birthday"      => _dateToData($this->input->post("birthday")),
                        "Img"           => $this->input->post("img"),
                        "Address"       => $this->input->post("address"),
                        "Ward"          => $data['user_check']['Ward'],
                        "District"      => $this->input->post("district"),
                        "Province"      => $this->input->post("province"),
                        "Phone"         => $this->input->post("phone"),
                        "Email"         => $this->input->post("username"),
                        "Dateset"       => $data['user_check']['Dateset'],
                        "Active"        => $this->input->post("active"),
                        "Key"           => $data['user_check']['Key'],
                        "Status"        => $this->input->post("status"),
                     );
                    if($this->input->post("active") == 1)
                         $update['Key'] = "";
                    $this->mwb_user->updateData($update, $id);
                    redirect(base_url()."admin/wb_user");
                    exit();
                }
            }else{
                redirect(base_url()."admin/wb_user");
                exit();
            }
        }else{
            redirect(base_url()."admin/wb_user");
            exit();
        }
    }
    public function hidden($id){
        if(is_numeric($id)){
            $data['user_check'] = $this->mwb_user->getDataByID($id);
            if($data['user_check']){
                $update = array(
                    "Active"        => 0,
                    "Key"           => "",
                    "Status"        => 0,
                );
                $this->mwb_user->updateData($update,$id);
            }
        }
        redirect(base_url()."admin/wb_user");
        exit();
    }
    public function delete($id){
        redirect(base_url()."admin/wb_user");
        exit();
    }
        
}