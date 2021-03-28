<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Pagereal extends MX_Controller{

    public function __construct(){

        parent::__construct();

    }

    public function index(){

        $data['menu'] = 2;

        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);

        //modules

        $data['zone'] = $this->load->module("zone");

        $data['modtext'] = $this->load->module("modtext");

        $data['modreal'] = $this->load->module("modreal");

        $data['modnews'] = $this->load->module("modnews");

        $data['modads'] = $this->load->module("modads");

        $data['modslide'] = $this->load->module("modslide");

        $data['modsupport'] = $this->load->module("modsupport");

        $data['moduser'] = $this->load->module("moduser");
        
        $page = $this->uri->segment(2);
        
        $url = 'mua-ban-nha-dat-binh-duong'.(($page && is_numeric($page)) ? '/'.$page : '');
    
        
        $data['link_canonical'] = base_url($url);

        $this->load->view("pagereal/pagereal-index",$data);

    }

    public function type($type){
        
        $data['type'] = $type;
        // if($type == 1){
        //     $data['menu'] = 2;
        //     $url = 'nha-ban';
        //     $data['titleWeb'] = 'Nhà bán';
        // }else{
        //     $data['menu'] = 3;
        //     $url = 'dat-ban';
        //     $data['titleWeb'] = 'Đất bán';
        // }
        $data['menu'] = 2;
        $url = 'nha-dat-ban';
        $data['titleWeb'] = 'Nhà đất bán';
        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);

        //modules

        $data['zone'] = $this->load->module("zone");

        $data['modtext'] = $this->load->module("modtext");

        $data['modreal'] = $this->load->module("modreal");

        $data['modnews'] = $this->load->module("modnews");

        $data['modads'] = $this->load->module("modads");

        $data['modslide'] = $this->load->module("modslide");

        $data['modsupport'] = $this->load->module("modsupport");

        $data['moduser'] = $this->load->module("moduser");
        
        $page = $this->uri->segment(2);
        
        $url = $url.(($page && is_numeric($page)) ? '/'.$page : '');
    
        
        $data['link_canonical'] = base_url($url);

        $this->load->view("pagereal/pagereal-type",$data);

    }

    public function menu($menu){

        $data['menu'] = 0;

        $data['seo'] = $this->my_site_menu->_loadSeoRealMenu($menu,$this->uri->segment(2));

        $data['rmenu'] = $menu;        

        //modules

        $data['zone'] = $this->load->module("zone");

        $data['modreal'] = $this->load->module("modreal");
        
        $this->load->model("modreal/mmodreal_site_real_menu");
        
        $data['menu_check'] = $this->mmodreal_site_real_menu->getDataByID($menu);
        
        if($data['menu_check']){
            $page = $this->uri->segment(2);
            $url = _setURL($data['menu_check']['Name']).'-rm-'.$data['menu_check']['ID'].'.html'.(($page && is_numeric($page)) ? '/'.$page : '');
        
            $data['link_canonical'] = base_url($url);
        
        }

        $this->load->view("pagereal/pagereal-menu",$data);

    }

    public function district($district){

        $data['menu'] = 0;

        $data['seo'] = $this->my_site_menu->_loadSeoDistrict($district, $this->uri->segment(2));

        $data['districtR'] = $district;        

        //modules

        $data['zone'] = $this->load->module("zone");

        $data['modreal'] = $this->load->module("modreal");
        
        $this->load->model("modreal/mmodreal_site_add_district");
        
        $data['district_check'] = $this->mmodreal_site_add_district->getDataByID($district);
        
        if($data['district_check']){
            $page = $this->uri->segment(2);
            $url = _setURL($data['district_check']['Name']).'-rd-'.$data['district_check']['ID'].'.html'.(($page && is_numeric($page)) ? '/'.$page : '');
        
            $data['link_canonical'] = base_url($url);
        
        }

        $this->load->view("pagereal/pagereal-district",$data);

    }

    public function search($textSelect = 'none', $menuSelect = 0, $provinceSelect = 0, $districtSelect = 0, $wardSelect = 0, $areaSelect = 0, $costSelect = 0, $directionSelect = 0, $bedroomSelect = 0, $sittingroomSelect = 0){

        //echo '<pre>',print_r(func_get_args()),'</pre>';exit;
        $data['menu'] = 0;

        $data['menu'] = 0;

        $data['seo'] = $this->my_site_menu->_loadSeoRealMenu($menu,$this->uri->segment(2));

        $data['textSelect'] = $this->input->get('textSelect');

        $data['menuSelect'] = $this->input->get('menuSelect');

        $data['provinceSelect'] = $this->input->get('provinceSelect');

        $data['districtSelect'] = $this->input->get('districtSelect');

        $data['wardSelect'] = $this->input->get('wardSelect');

        $data['areaSelect'] = $this->input->get('areaSelect');

        $data['costSelect'] = $this->input->get('costSelect');
        
        $data['directionSelect'] = $this->input->get('directionSelect');
        
        $data['bedroomSelect'] = $this->input->get('bedroomSelect');
        
        $data['sittingroomSelect'] = $this->input->get('sittingroomSelect');
        
        if(!$data['textSelect']){
            $data['textSelect'] = $textSelect;
        }
        if(!$data['menuSelect']){
            $data['menuSelect'] = $menuSelect;
        }
        if(!$data['districtSelect']){
            $data['districtSelect'] = $districtSelect;
        }
        if(!$data['provinceSelect']){
            $data['provinceSelect'] = $provinceSelect;
        }
        if(!$data['wardSelect']){
            $data['wardSelect'] = $wardSelect;
        }
        if(!$data['areaSelect']){
            $data['areaSelect'] = $areaSelect;
        }
        if(!$data['costSelect']){
            $data['costSelect'] = $costSelect;
        }
        if(!$data['directionSelect']){
            $data['directionSelect'] = $directionSelect;
        }
        if(!$data['bedroomSelect']){
            $data['bedroomSelect'] = $bedroomSelect;
        }
        if(!$data['sittingroomSelect']){
            $data['sittingroomSelect'] = $sittingroomSelect;
        }
        // echo '<pre>',print_r($data),'</pre>';exit;
        $this->load->model(array("modreal/mmodreal_site_real_menu","msite_add_district","msite_add_ward"));
                
        //modules

        $data['zone'] = $this->load->module("zone");

        $data['modtext'] = $this->load->module("modtext");

        $data['modreal'] = $this->load->module("modreal");

        $data['modnews'] = $this->load->module("modnews");

        $data['modads'] = $this->load->module("modads");

        $data['modslide'] = $this->load->module("modslide");

        $data['modsupport'] = $this->load->module("modsupport");

        $data['moduser'] = $this->load->module("moduser");
        
        //$url = "tim-nha-dat-binh-duong/{$data['districtSelect']}/{$data['rmenu']}/{$data['direction']}/{$data['area']}/{$data['cost']}".(($page && is_numeric($page)) ? '/'.$page : '');
    
        //$data['link_canonical'] = base_url($url);
        
        $this->load->view("pagereal/pagereal-search",$data);

    }

    public function searchMap($provinceSelect = 0, $menuSelect = 0, $costSelect = 0){
        $data['menu'] = 0;

        $data['menu'] = 0;

        $data['seo'] = $this->my_site_menu->_loadSeoRealMenu($data['menu'],$this->uri->segment(2));

        $data['menuSelect'] = $this->input->get('menuSelect');

        $data['provinceSelect'] = $this->input->get('provinceSelect');

        $data['costSelect'] = $this->input->get('costSelect');
        
        if(!$data['menuSelect']){
            $data['menuSelect'] = $menuSelect;
        }
        if(!$data['provinceSelect']){
            $data['provinceSelect'] = $provinceSelect;
        }
        if(!$data['costSelect']){
            $data['costSelect'] = $costSelect;
        }
        // echo '<pre>',print_r($data),'</pre>';exit;
        $this->load->model(array("modreal/mmodreal_site_real_menu","msite_add_province","msite_add_ward"));
                
        //modules

        $data['zone'] = $this->load->module("zone");

        $data['modreal'] = $this->load->module("modreal");

        $data['moduser'] = $this->load->module("moduser");
        $this->load->view("pagereal/pagereal-searchMap",$data);
    }

    public function detail($id){

        $data['menu'] = 0;

        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);

        //modules

        if($id && is_numeric($id)){

            $this->load->model(array("pagereal/mpagereal_site_real"));

            $data['real_check'] = $this->mpagereal_site_real->getDataByID($id);

            if($data['real_check']){

                //seo

                $data['seo']['site_title'] = $data['real_check']['Name'];

                $data['seo']['site_keywords'] = $data['real_check']['Name'];

                $data['seo']['site_description'] = $data['real_check']['MainContent'];

                if($data['real_check']['MTit'])

                    $data['seo']['site_title'] = $data['real_check']['MTit'];

                if($data['real_check']['MKey'])

                    $data['seo']['site_keywords'] = $data['real_check']['MKey'];

                if($data['real_check']['MDes'])

                    $data['seo']['site_description'] = $data['real_check']['MDes'];

                    

                $this->mpagereal_site_real->addHit($id);

                

                $data['zone'] = $this->load->module("zone");

                $data['modreal'] = $this->load->module("modreal");
                
                $data['link_canonical'] = base_url(_setURL($data['real_check']['Name']).'-real-'.$data['real_check']['ID'].'.html');

                $this->load->view("pagereal/pagereal-detail",$data);

            }else{

                redirect(base_url());

                exit();

            }

        }else{

            redirect(base_url());

            exit();

        }

    }

        

}