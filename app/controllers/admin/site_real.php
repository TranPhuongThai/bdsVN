<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_real extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("msite_real","msite_real_img","msite_real_menu","msite_add_district","msite_add_province","msite_add_ward"));
        $this->load->library(array("upload"));
    }
    /*
    public function resize(){
        $data['real_list'] = $this->msite_real->getAllData("DESC", 13, 0);
        //echo count($data['real_list']);exit;
        foreach($data['real_list'] as $row){
            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image']	= str_replace(array('http://www.nhabandian.com/','http://nhabandian.com/'),array('',''),$row['Img']);
            //$config['source_image']	= 'public/assets/aaaa.jpg';
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width']	= 400;
            $config['height']	= 300;
            echo '<pre>',print_r($config),'</pre>';
            $this->load->library('image_lib', $config); 
            
            $a = $this->image_lib->resize();
            var_dump($a)."<br />";
        }
    }    
    */
    function _getOptionMenuReal($pid, $prefix="", $active=""){
        $menu_list = $this->msite_real_menu->getPidStatusData($pid, 1, "ASC", 99, 0);
		$slt = "";
        foreach($menu_list as $row){
            if($active == $row['ID']){
                $slt .= "<option value=\"".$row['ID']."\" selected=\"selected\">".$prefix." ".$row['Name'];
            }else{
                $slt .= "<option value=\"".$row['ID']."\">".$prefix." ".$row['Name'];
            }
			$slt .= $this->_getOptionMenuReal($row['ID'], $prefix.$prefix.$prefix.$prefix, $active);
        }
		return $slt;
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_real";
        $data['breadcrumbs'][1]["Name"] = lang('backend.real');
        
        $config['base_url'] = base_url("admin/site_real/index");
        $config['total_rows'] = $this->msite_real->countAllData();
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
        
        $data['name'] = "";
        $data['status'] = 2;
        $data['menu_list'] = $this->_getOptionMenuReal(0, "--");
        $data['real_list'] = $this->msite_real->getAllData("DESC", $config['per_page'], $this->uri->segment(4));
        
        $this->my_layout->view("backend/site_real-index",$data);
    }
    public function menu($menu){
        $data['menu'] = $this->input->post("menu");
        if(!$data['menu'] && $menu){
            $data['menu'] = urldecode($menu);
        }
        if($data['menu']){
            $data['menu_check'] = $this->msite_real_menu->getDataByID($data['menu']);
            if($data['menu_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_real";
                $data['breadcrumbs'][1]["Name"] = lang('backend.real');
                $data['breadcrumbs'][2]["Url"] = "admin/site_real/menu/".$data['menu_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['menu_check']['Name'];
                
                $config['base_url'] = base_url("admin/site_real/menu/{$data['menu_check']['ID']}");
                $config['total_rows'] = $this->msite_real->countSearchData("", $data['menu']);
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
                
                $data['menu_list'] = $this->_getOptionMenuReal(0, "--",$data['menu']);
                
                $data['name'] = "";
                $data['status'] = 0;
                $data['real_list'] = $this->msite_real->getSearchData("", $data['menu'], "DESC", $config['per_page'], $this->uri->segment(5));
                $this->my_layout->view("backend/site_real-index",$data);
            }else{
                redirect(base_url()."admin/site_real");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_real");
            exit();
        }
    }
    public function search($name="", $menu="", $status=""){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_real";
        $data['breadcrumbs'][1]["Name"] = lang('backend.real');
        $data['breadcrumbs'][2]["Url"] = "#";
        $data['breadcrumbs'][2]["Name"] = lang('backend.search');
                
        $data['name'] = $this->input->post("name");
        $data['menu'] = $this->input->post("menu");
        $data['status'] = $this->input->post("status");
        if(!$data['name'] && $name){
            $data['name'] = urldecode($name);
        }
        if(!$data['menu']){
            $data['menu'] = 0;
        }
        if(!$data['menu'] && $menu){
            $data['menu'] = urldecode($menu);
        }
        if(!$data['status'] && $status){
            $data['status'] = urldecode($status);
        }
        
        $nameS = $data['name'];
        if(!$data['name']){
            $data['name'] = 'none';
        }
        if($data['name'] == 'none'){
            $nameS = '';
        }
        
        $config['base_url'] = base_url("admin/site_real/search/{$data['name']}/{$data['menu']}/{$data['status']}");
        $config['total_rows'] = $this->msite_real->countSearchData($nameS, $data['menu'], $data['status']);
        $config['per_page'] = 10; 
        $config['uri_segment'] = 7;
                
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
        
        $data['menu_list'] = $this->_getOptionMenureal(0, "--",$data['menu']);
        $data['real_list'] = $this->msite_real->getSearchData($nameS, $data['menu'], "DESC", $config['per_page'], $this->uri->segment(7), $data['status']);
        
        $this->my_layout->view("backend/site_real-index",$data);
    }
    public function add(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_real";
        $data['breadcrumbs'][1]["Name"] = lang('backend.real');
        $data['breadcrumbs'][2]["Url"] = "admin/site_real/add";
        $data['breadcrumbs'][2]["Name"] = lang('backend.add');
        
        $data['real_menu'] = $this->_getOptionMenureal(0,"--");
        $data['real_list'] = $this->msite_real->getAllData("DESC", 20, 0);
        $data['province_list'] = $this->msite_add_province->getAllData("ASC",99,0);
        $data['district_list'] = $this->msite_add_district->getProvinceData(8,"ASC",99,0);
        $data['ward_list'] = $this->msite_add_ward->getAllData("ASC",99,0);
        
        $this->form_validation->set_rules("menu",lang('backend.real'),"required");
        $this->form_validation->set_rules("name",lang('backend.name'),"required");
        //$this->form_validation->set_rules("img",lang('backend.img'),"required");
        $this->form_validation->set_rules("content",lang('backend.content'),"required|min_length[10]");
        
        if($this->form_validation->run() == FALSE){
            $data['error'] = "";
            $this->my_layout->view("backend/site_real-add",$data);
        }else{
//            $thumb = $this->input->post("img");
//            if(strrpos("wb".$this->input->post("img"),base_url())){
//                if(_checkThumbImg($this->input->post("img"))){
//                    $thumb = _checkThumbImg($this->input->post("img"));
//                }
//            }
            $img = '';
            $thumb = '';
            $this->load->library('my_upload_file');
            if(isset($_FILES['img1']['type']) && $_FILES['img1']['type']){
                $_FILES['txtFile'] = $_FILES['img1'];
                $returnImg = $this->upload->do_upload_3(0);
                
                $img = base_url().$this->my_upload_file->watermark($returnImg);
                
                $thumb = base_url().$this->my_upload_file->resize($returnImg);
            }

            $cost = str_replace('.','',$this->input->post("cost"));
            $total = 0;
            if($this->input->post("unit") == 'm2'){
                $total = $cost * (int)$this->input->post("unit");
            }else{
                $total = $cost;
            }
            $add = array(
                    "Menu"          => $this->input->post("menu"),
                    "Name"          => $this->input->post("name"),
                    "Img"           => $img,
                    "Thumb1"        => $thumb,
                    "Thumb2"        => "",
                    "Thumb3"        => "",
                    "Thumb4"        => "",
                    "MainContent"   => $this->input->post("maincontent"),
                    "Content"       => $this->input->post("content"),
                    "Dateset"       => date("Y-m-d H:i:s"),
                    "DateUp"        => date("Y-m-d H:i:s"),
                    "Type"          => $this->input->post("type"),
                    "Hot"           => $this->input->post("hot"),
                    "New"           => $this->input->post("new"),
                    "Hit"           => 1,
                    "User"          => $this->session->userdata("WBUSERID"),
                    "Editor"        => $this->input->post("editor"),
                    "Source"        => $this->input->post("source"),
                    "State"         => $this->input->post("state"),
                    "Status"        => $this->input->post("status"),
                    "Legal"         => $this->input->post("legal"),
                    "LandArea"      => (int)($this->input->post("landarea")),
                    "UsableArea"    => $this->input->post("usablearea"),
                    "SittingRoom"   => $this->input->post("sittingroom"),
                    "BedRoom"       => $this->input->post("bedroom"),
                    "Garage"        => $this->input->post("garage"),
                    "Toilet"        => $this->input->post("toilet"),
                    "TVCable"       => $this->input->post("tvcable"),
                    "CityWater"     => $this->input->post("citywater"),
                    "Internet"      => $this->input->post("internet"),
                    "NearCenter"    => $this->input->post("nearcenter"),
                    "Address"       => $this->input->post("address"),
                    "Street"        => $this->input->post("street"),
                    "Ward"          => $this->input->post("ward"),
                    "District"      => $this->input->post("district"),
                    "Province"      => $this->input->post("province"),
                    "Direction"     => $this->input->post("direction"),
                    "Cost"          => $cost,
                    "Total"         => $total,
                    "Unit"          => $this->input->post("unit"),
                    "ContactName"   => $this->input->post("contactname"),
                    "ContactYahoo"  => $this->input->post("contactyahoo"),
                    "ContactPhone"  => $this->input->post("contactphone"),
                    "ContactEmail"  => $this->input->post("contactemail"),
                    "Tags"          => $this->input->post("tags"),
                    "MTit"          => $this->input->post("mtit"),
                    "MKey"          => $this->input->post("mkey"),
                    "MDes"          => $this->input->post("mdes"),
                    "Lat"           => $this->input->post("lat"),
                    "Lng"           => $this->input->post("lng"),
                 );
            $id = $this->msite_real->addData($add);
            $img2 = array();
            $stt = 0;
            foreach ($_FILES['img2']['type'] as $file) {
                $_FILES['txtFile'] = $_FILES['img2'];
                $temp = $this->upload->do_upload_2($stt);
                $temp = base_url().$this->my_upload_file->watermark($temp);
                if($temp){
                    //end wideimage
                    $add2 = array(
                        "Real"          => $id,
                        "Name"          => $this->input->post("name"),
                        "Img"           => $temp,
                        "Content"       => '',
                        "Dateset"       => date("Y-m-d H:i:s"),
                        "Level"         => 0,
                        "Status"        => 1,
                    );
                    $this->msite_real_img->addData($add2);
                }
                if($stt % 5 == 0){
                    sleep(1);
                }
                $stt++;                    
            }
            redirect(base_url()."admin/site_real");
            exit();
        }
    }
    public function up($id){
        if(is_numeric($id)){            
            $data['real_check'] = $this->msite_real->getDataByID($id);
            if($data['real_check']){
                $update = array(
                            "DateUp"          => date("Y-m-d H:i:s")
                        );
                $this->msite_real->updateData($update, $id);
                echo 'done';
            }
        }
    }
    public function edit($id){
        if(is_numeric($id)){            
            $data['real_check'] = $this->msite_real->getDataByID($id);
            if($data['real_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_real";
                $data['breadcrumbs'][1]["Name"] = lang('backend.real');
                $data['breadcrumbs'][2]["Url"] = "admin/site_real/edit/".$data['real_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['real_check']['Name'];
                
                $data['real_menu'] = $this->_getOptionMenureal(0,"-", $data['real_check']['Menu']); 
                $data['real_list'] = $this->msite_real->getAllData("DESC", 20, 0);
                $data['province_list'] = $this->msite_add_province->getAllData("ASC",99,0);
                $data['district_list'] = $this->msite_add_district->getProvinceData($data['real_check']['Province'],"ASC",99,0);
                $data['ward_list'] = $this->msite_add_ward->getAllData("ASC",99,0);
                
                $this->form_validation->set_rules("menu",lang('backend.real'),"required");
                $this->form_validation->set_rules("name",lang('backend.name'),"required");
                //$this->form_validation->set_rules("img",lang('backend.img'),"required");
                $this->form_validation->set_rules("content",lang('backend.content'),"required|min_length[10]");
                if($this->form_validation->run() == FALSE){
                    $data['error'] = ""; 
                    $this->my_layout->view("backend/site_real-edit",$data);
                }else{
//                    $thumb = $this->input->post("img");
//                    if(strrpos("wb".$this->input->post("img"),base_url())){
//                        if(_checkThumbImg($this->input->post("img"))){
//                            $thumb = _checkThumbImg($this->input->post("img"));
//                        }
//                    }

                    $img = '';
                    $thumb = '';
                    $this->load->library('my_upload_file');
                    if(isset($_FILES['img1']['type']) && $_FILES['img1']['type']){
                        $_FILES['txtFile'] = $_FILES['img1'];
                        $returnImg = $this->upload->do_upload_3(0);
                        
                        $img = base_url().$this->my_upload_file->watermark($returnImg);
                        
                        $thumb = base_url().$this->my_upload_file->resize($returnImg);
                    }
                    $total = 0;
                    $cost = str_replace('.','',$this->input->post("cost"));
                    if($this->input->post("unit") == 'm2'){
                        $total = $cost * (int)$this->input->post("unit");
                    }else{
                        $total = $cost;
                    }
                    $update = array(
                            "Menu"          => $this->input->post("menu"),
                            "Name"          => $this->input->post("name"),
                            "Thumb2"        => $data['real_check']['Thumb2'],
                            "Thumb3"        => $data['real_check']['Thumb3'],
                            "Thumb4"        => $data['real_check']['Thumb4'],
                            "MainContent"   => $this->input->post("maincontent"),
                            "Content"       => $this->input->post("content"),
                            "Dateset"       => $data['real_check']['Dateset'],
                            "DateUp"        => date("Y-m-d H:i:s"),
                            "Type"          => $this->input->post("type"),
                            "Hot"           => $this->input->post("hot"),
                            "New"           => $this->input->post("new"),
                            "Hit"           => $data['real_check']['Hit'],
                            "User"          => $data['real_check']['User'],
                            "Editor"        => $this->input->post("editor"),
                            "Source"        => $this->input->post("source"),
                            "State"         => $this->input->post("state"),
                            "Legal"         => $this->input->post("legal"),
                            "Status"        => $this->input->post("status"),
                            "LandArea"      => (int)($this->input->post("landarea")),
                            "UsableArea"    => $this->input->post("usablearea"),
                            "SittingRoom"   => $this->input->post("sittingroom"),
                            "BedRoom"       => $this->input->post("bedroom"),
                            "Garage"        => $this->input->post("garage"),
                            "Toilet"        => $this->input->post("toilet"),
                            "TVCable"       => $this->input->post("tvcable"),
                            "CityWater"     => $this->input->post("citywater"),
                            "Internet"      => $this->input->post("internet"),
                            "NearCenter"    => $this->input->post("nearcenter"),
                            "Address"       => $this->input->post("address"),
                            "Street"        => $this->input->post("street"),
                            "Ward"          => $this->input->post("ward"),
                            "District"      => $this->input->post("district"),
                            "Province"      => $this->input->post("province"),
                            "Direction"     => $this->input->post("direction"),
                            "Cost"          => $cost,
                            "Total"         => $total,
                            "Unit"          => $this->input->post("unit"),
                            "ContactName"   => $this->input->post("contactname"),
                            "ContactYahoo"  => $this->input->post("contactyahoo"),
                            "ContactPhone"  => $this->input->post("contactphone"),
                            "ContactEmail"  => $this->input->post("contactemail"),
                            "Tags"          => $this->input->post("tags"),
                            "MTit"          => $this->input->post("mtit"),
                            "MKey"          => $this->input->post("mkey"),
                            "MDes"          => $this->input->post("mdes"),
                            "Lat"           => $this->input->post("lat"),
                            "Lng"           => $this->input->post("lng"),
                         );
                    if(isset($img) && $img){
                        $update['Img'] = $img;
                        $update['Thumb1'] = $thumb;
                    }
                    $this->msite_real->updateData($update, $id);
                    $img2 = array();
                    $stt = 0;
                    foreach ($_FILES['img2']['type'] as $file) {
                        $_FILES['txtFile'] = $_FILES['img2'];
                        $temp = $this->upload->do_upload_2($stt);
                        $temp = base_url().$this->my_upload_file->watermark($temp);
                        if($temp){
                            //end wideimage
                            $add2 = array(
                                "Real"       => $id,
                                "Name"          => $this->input->post("name"),
                                "Img"           => $temp,
                                "Content"       => '',
                                "Dateset"       => date("Y-m-d H:i:s"),
                                "Level"         => 0,
                                "Status"        => 1,
                            );
                            $this->msite_real_img->addData($add2);
                        }
                        if($stt % 5 == 0){
                            sleep(1);
                        }
                        $stt++;                    
                    }
                    redirect(base_url()."admin/site_real");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_real");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_real");
            exit();
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['real_check'] = $this->msite_real->getDataByID($id);
                $data['real_img_list'] = $this->msite_real_img->getRealData($id, "DESC", 20, 0);
            if($data['real_check']){
                
                $file1 = str_replace(base_url(),'',$data['real_check']['Img']);
                $file2 = str_replace(base_url(),'',$data['real_check']['Thumb1']);
                chmod($file1, 0777);
                chmod($file2, 0777);
                unlink($file1);
                unlink($file2);
                
                foreach($data['real_img_list'] as $row){
                    $file = str_replace(base_url(),'',$row['Img']);
                    //echo $file."<br />";
                    chmod($file, 0777);
                    unlink($file);
                }
                $this->msite_real->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_real");
        exit();
    }
        
}