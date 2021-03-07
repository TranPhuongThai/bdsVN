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

        $data['modreal'] = $this->load->module("modreal");
        
        $page = $this->uri->segment(2);
        $url = 'mua-ban-nha-dat-di-an'.(($page && is_numeric($page)) ? '/'.$page : '');
    
        
        $data['link_canonical'] = base_url($url);

        $this->load->view("pagereal/pagereal-index",$data);

    }

    public function menu($menu){

        $data['menu'] = 2;

        $data['seo'] = $this->my_site_menu->_loadSeoRealMenu($data['menu'],$this->uri->segment(2));

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

    public function search($district = null, $rmenu = null, $direction = 'all', $area = null, $cost = null){

        $data['menu'] = 2;

        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);

        $data['district'] = $this->input->get('district');

        $data['rmenu'] = $this->input->get('menu');
        
        $data['direction'] = $this->input->get('direction');

        $data['area'] = $this->input->get('area');

        $data['cost'] = $this->input->get('cost');
        
        if(isset($district)){
            $data['district'] = $district;
        }
        if(isset($rmenu)){
            $data['rmenu'] = $rmenu;
        }
        if(isset($direction)){
            $data['direction'] = $direction;
        }
        if(isset($area)){
            $data['area'] = $area;
        }
        if(isset($cost)){
            $data['cost'] = $cost;
        }
        
        $this->load->model(array("modreal/mmodreal_site_real_menu","msite_add_district"));
        
        $data['menu_check'] = $this->mmodreal_site_real_menu->getDataByID($data['rmenu']);
        
        $data['district_check'] = $this->msite_add_district->getDataByID($data['district']);
        
        $data['seo']['site_title'] = array();
        $data['seo']['site_keywords'] = array();
        $data['seo']['site_description'] = array();
        if($data['menu_check']){
            $data['seo']['site_title'][] = $data['menu_check']['Name'];
            $data['seo']['site_keywords'][] = $data['menu_check']['Name'];
            $data['seo']['site_description'][] = $data['menu_check']['Name'];
        }
        if($data['district_check']){
            $data['seo']['site_title'][] =$data['district_check']['Name'];
            $data['seo']['site_keywords'][] =$data['district_check']['Name'];
            $data['seo']['site_description'][] =$data['district_check']['Name'];
        }
        if($data['direction']){
            $data['seo']['site_title'][] = 'Hướng '.$data['direction'];
            $data['seo']['site_keywords'][] = 'Hướng '.$data['direction'];
            $data['seo']['site_description'][] = 'Hướng '.$data['direction'];
        }
        if($data['area'] == 4){

            $data['area1'] = 40;

            $data['area2'] = 60;

        }elseif($data['area'] == 6){

            $data['area1'] = 60;

            $data['area2'] = 80;

        }elseif($data['area'] == 8){

            $data['area1'] = 80;

            $data['area2'] = 100;

        }elseif($data['area'] == 10){

            $data['area1'] = 100;

            $data['area2'] = 120;

        }elseif($data['area'] == 12){

            $data['area1'] = 120;

            $data['area2'] = 180;

        }elseif($data['area'] == 18){

            $data['area1'] = 180;

            $data['area2'] = 250;

        }elseif($data['area'] == 25){

            $data['area1'] = 250;

            $data['area2'] = 350;

        }elseif($data['area'] == 35){

            $data['area1'] = 350;

            $data['area2'] = 999999999;

        }else{
            
            $data['area1'] = 0;

            $data['area2'] = 999999999;
        }

        if($data['cost'] == 1){

            $data['cost1'] = 100000000;

            $data['cost2'] = 300000000;

        }elseif($data['cost'] == 3){

            $data['cost1'] = 300000000;

            $data['cost2'] = 600000000;

        }elseif($data['cost'] == 6){

            $data['cost1'] = 600000000;

            $data['cost2'] = 800000000;

        }elseif($data['cost'] == 8){

            $data['cost1'] = 800000000;

            $data['cost2'] = 1000000000;

        }elseif($data['cost'] == 10){

            $data['cost1'] = 1000000000;

            $data['cost2'] = 1500000000;

        }elseif($data['cost'] == 15){

            $data['cost1'] = 1500000000;

            $data['cost2'] = 2000000000;

        }elseif($data['cost'] == 20){

            $data['cost1'] = 2000000000;

            $data['cost2'] = 2500000000;

        }elseif($data['cost'] == 25){

            $data['cost1'] = 2500000000;

            $data['cost2'] = 3000000000;

        }elseif($data['cost'] == 30){

            $data['cost1'] = 3000000000;

            $data['cost2'] = 99999999999;

        }else{
            $data['cost1'] = 0;

            $data['cost2'] = 99999999999;

        }
        
        $data['seo']['site_title'][] = $data['area1'].'-'.$data['area2'].' m2';
        $data['seo']['site_keywords'][] = $data['area1'].'-'.$data['area2'].' m2';
        $data['seo']['site_description'][] = $data['area1'].'-'.$data['area2'].' m2';
        
        $data['seo']['site_title'][] = $data['cost1'].'-'.$data['cost2'].' vnđ';
        $data['seo']['site_keywords'][] = $data['cost1'].'-'.$data['cost2'].' vnđ';
        $data['seo']['site_description'][] = $data['cost1'].'-'.$data['cost2'].' vnđ';
        
        $data['seo']['site_title'] = implode(', ',$data['seo']['site_title']);
        $data['seo']['site_keywords'] = implode(', ',$data['seo']['site_keywords']);
        $data['seo']['site_description'] = implode(', ',$data['seo']['site_description']);
        
        $page = $this->uri->segment(7);
        
        $data['seo']['site_title'] .= ' | '.$page;
        $data['seo']['site_keywords'] .= ' | '.$page;
        $data['seo']['site_description'] .= ' | '.$page;
        //modules

        $data['zone'] = $this->load->module("zone");

        $data['modreal'] = $this->load->module("modreal");
        
        $url = "tim-kiem-nha-dat-di-an/{$data['district']}/{$data['rmenu']}/{$data['direction']}/{$data['area']}/{$data['cost']}".(($page && is_numeric($page)) ? '/'.$page : '');
    
        $data['link_canonical'] = base_url($url);
        
        $this->load->view("pagereal/pagereal-search",$data);

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