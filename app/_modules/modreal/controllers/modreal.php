<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modreal extends MX_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->load->model("modreal/mmodreal_site_real");
        
        $data['real_title'] = 'Nhà đất Bình Dương Giá rẻ';
        
        $this->load->library("pagination");
        $config['base_url'] = base_url("mua-ban-nha-dat-binh-duong");
        $config['total_rows'] = $this->mmodreal_site_real->countNewData();
        $config['per_page'] = 10; 
        $config['uri_segment'] = 2;
        $this->pagination->initialize($config);
            
        $data['real_list'] = $this->mmodreal_site_real->getNewData("DESC", $config['per_page'], $this->uri->segment(2));
        if($data['real_list']){
            $this->load->view("modreal/list", $data);
        }
    }
    public function listMenu(){
        $this->load->model("modreal/mmodreal_site_real_menu");
        $data['menu_list'] = $this->mmodreal_site_real_menu->getAllData("ASC");
        if($data['menu_list']){
            $this->load->view("modreal/listMenu", $data);
        }
    }
    public function hotData($record_number = 4, $record_start = 0){
        $this->load->model("modreal/mmodreal_site_real");
        $data['real_list'] = $this->mmodreal_site_real->getHotData($record_number, $record_start);
        if($data['real_list']){
            $this->load->view("modreal/hotData", $data);
        }
    }
    public function hitData($record_number = 4, $record_start = 0){
        $this->load->model("modreal/mmodreal_site_real");
        $data['real_list'] = $this->mmodreal_site_real->getTopHitData($record_number, $record_start);
        if($data['real_list']){
            $this->load->view("modreal/hitData", $data);
        }
    }
    public function newData($record_number = 4, $record_start = 0){
        $this->load->model("modreal/mmodreal_site_real");
        $data['real_list'] = $this->mmodreal_site_real->getNewData("DESC", $record_number, $record_start);
        if($data['real_list']){
            $this->load->view("modreal/newData", $data);
        }
    }
    public function newData2($record_number = 6, $record_start = 0){
        $this->load->model("modreal/mmodreal_site_real");
        $data['real_list'] = $this->mmodreal_site_real->getNewData("DESC", $record_number, $record_start);
        if($data['real_list']){
            $this->load->view("modreal/newData2", $data);
        }
    }
    public function menu($id){
        $this->load->model(array("modreal/mmodreal_site_real", "modreal/mmodreal_site_real_menu"));
        $data['menu_check'] = $this->mmodreal_site_real_menu->getDataByID($id);
        if($data['menu_check']){
            $data['real_title'] = $data['menu_check']['Name'];
            
            $this->load->library("pagination");
            $config['base_url'] = base_url()._setURL($data['menu_check']['Name'])."-rm-".$data['menu_check']['ID'].".html";
            $config['total_rows'] = $this->mmodreal_site_real->countMenuData($id);
            $config['per_page'] = 5; 
            $config['uri_segment'] = 2;
            $this->pagination->initialize($config);
                
            $data['real_list'] = $this->mmodreal_site_real->getMenuData($id, "DESC", $config['per_page'], $this->uri->segment(2));
            $this->load->view("modreal/list", $data);
        }
    }
    public function search($district = "all",$menu = "all", $direction = "all",$area = 0,$cost = 0){
        if(isset($district) || isset($menu)){
            $this->load->model(array("modreal/mmodreal_site_real","modreal/mmodreal_site_real_menu","msite_add_district"));
            
            if($area == 4){
    
                $area1 = 40;
    
                $area2 = 60;
    
            }elseif($area == 6){
    
                $area1 = 60;
    
                $area2 = 80;
    
            }elseif($area == 8){
    
                $area1 = 80;
    
                $area2 = 100;
    
            }elseif($area == 10){
    
                $area1 = 100;
    
                $area2 = 120;
    
            }elseif($area == 12){
    
                $area1 = 120;
    
                $area2 = 180;
    
            }elseif($area == 18){
    
                $area1 = 180;
    
                $area2 = 250;
    
            }elseif($area == 25){
    
                $area1 = 250;
    
                $area2 = 350;
    
            }elseif($area == 35){
    
                $area1 = 350;
    
                $area2 = 999999999;
    
            }else{
                
                $area1 = 0;
    
                $area2 = 999999999;
            }
    
            if($cost == 1){
    
                $cost1 = 100000000;
    
                $cost2 = 300000000;
    
            }elseif($cost == 3){
    
                $cost1 = 300000000;
    
                $cost2 = 600000000;
    
            }elseif($cost == 6){
    
                $cost1 = 600000000;
    
                $cost2 = 800000000;
    
            }elseif($cost == 8){
    
                $cost1 = 800000000;
    
                $cost2 = 1000000000;
    
            }elseif($cost == 10){
    
                $cost1 = 1000000000;
    
                $cost2 = 1500000000;
    
            }elseif($cost == 15){
    
                $cost1 = 1500000000;
    
                $cost2 = 2000000000;
    
            }elseif($cost == 20){
    
                $cost1 = 2000000000;
    
                $cost2 = 2500000000;
    
            }elseif($cost == 25){
    
                $cost1 = 2500000000;
    
                $cost2 = 3000000000;
    
            }elseif($cost == 30){
    
                $cost1 = 3000000000;
    
                $cost2 = 99999999999;
    
            }else{
                $cost1 = 0;
    
                $cost2 = 99999999999;
    
            }
        
            $data['menu_check'] = $this->mmodreal_site_real_menu->getDataByID($menu);
            
            $data['district_check'] = $this->msite_add_district->getDataByID($district);
            
            $name = array();
            if($data['menu_check']){
                $name[] = $data['menu_check']['Name'];
            }
            if($data['district_check']){
                $name[] = $data['district_check']['Name'];
            }
            if(!$name){
                $name = 'Kết quả tìm kiếm';
            }else{
                $name = implode (', ',$name);
            }
            
            $data['real_title'] = $name;
            
            $this->load->library(array("pagination"));

            $config['base_url'] = base_url("tim-kiem-nha-dat-binh-duong/$district/$menu/$direction/$area/$cost");
            $config['total_rows'] = $this->mmodreal_site_real->countSearchData($district,$menu,$direction,$area1,$area2,$cost1,$cost2);
            $config['per_page'] = 2; 
            $config['uri_segment'] = 7;
            $this->pagination->initialize($config);
            
            $data['real_list'] = $this->mmodreal_site_real->getSearchData($district,$menu,$direction,$area1,$area2,$cost1,$cost2,"DESC",$config['per_page'],$this->uri->segment(7));
            $this->load->view("modreal/list", $data);
        }else{
            redirect(base_url());
            exit();
        }
    }
    public function form($district=0, $rmenu=0, $direction=0, $area=0, $cost=0){
        $data['district'] = $district;
        $data['rmenu'] = $rmenu;
        $data['direction'] = $direction;
        $data['area'] = $area;
        $data['cost'] = $cost;
        $this->load->model(array("modreal/mmodreal_site_real","modreal/mmodreal_site_add_district", "modreal/mmodreal_site_real_menu"));
        $this->load->helper(array("form"));
        $data['district_list'] = $this->mmodreal_site_add_district->getProvinceData(8,"ASC",0,99);
        $data['menu_list'] = $this->mmodreal_site_real_menu->getAllData("ASC");
        $this->load->view("modreal/form", $data);
    }
    public function detail($id){
        if($id && is_numeric($id)){
            $this->load->model(array("modreal/mmodreal_site_real","modreal/mmodreal_site_real_img","modnews/mmodnews_site_news_comment"));
            $data['real_check'] = $this->mmodreal_site_real->getDataByID($id);
            if($data['real_check']){
                $this->mmodreal_site_real->addHit($id);
                
                $data['img_list'] = $this->mmodreal_site_real_img->getRealData($id,50,0);
                
                $data['modnews'] = $this->load->module("modnews");
                
                $data['comment_list'] = $this->mmodnews_site_news_comment->getNewsPIDData(2,$id, 0, 'DESC', 99, 0);
                $data['real_list'] = $this->mmodreal_site_real->getSimilarData($id, "DESC", 4,0);
                $this->load->view("modreal/detail", $data);
            }
        }
    }
        
}