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
    public function listDistrict(){
        $this->load->model("modreal/mmodreal_site_add_district");
        $data['district_list'] = $this->mmodreal_site_add_district->getProvinceData(8, "ASC", 0, 99);
        if($data['district_list']){
            $this->load->view("modreal/listDistrict", $data);
        }
    }
    public function hotData($record_number = 4, $record_start = 0){
        $this->load->model("modreal/mmodreal_site_real");
        $data['real_list'] = $this->mmodreal_site_real->getHotData($record_number, $record_start);
        if($data['real_list']){
            $this->load->view("modreal/hotData", $data);
        }
    }
    public function districtData($district, $record_number = 4, $record_start = 0){
        $this->load->model(array("modreal/mmodreal_site_real","modreal/mmodreal_site_add_district"));
        $this->load->library("pagination");
        $data['paginator'] = 1;
        
        $data['realCheck'] = $this->mmodreal_site_add_district->getDataByID($district);
        
        $this->load->library("pagination");
        $config['base_url'] = base_url("nha-dat-")._setURL($data['realCheck']['Name']).'-rd-'.$data['realCheck']['ID'].'.html';
        $config['total_rows'] = $this->mmodreal_site_real->countDistrictData2($district);
        $config['per_page'] = $record_number; 
        $config['uri_segment'] = 2;
        $this->pagination->initialize($config);
        
        $data['real_list'] = $this->mmodreal_site_real->getDistrictData2($district, $config['per_page'], $this->uri->segment(2));
        
        if($data['real_list']){
            $this->load->view("modreal/newData", $data);
        }
    }
    public function hitData($record_number = 4, $record_start = 0){
        $this->load->model("modreal/mmodreal_site_real");
        $data['real_list'] = $this->mmodreal_site_real->getTopHitData($record_number, $record_start);
        if($data['real_list']){
            $this->load->view("modreal/hitData", $data);
        }
    }
    public function typeData($type, $record_number = 4, $record_start = 0, $paginator = false){
        $this->load->model("modreal/mmodreal_site_real");
        $data['paginator'] = $paginator;
        if($paginator){
            $this->load->library("pagination");
            if($type == 1){
                $url = 'nha-ban-binh-duong';
            }else{
                $url = 'dat-ban-binh-duong';
            }
            $config['base_url'] = base_url($url);
            $config['total_rows'] = $this->mmodreal_site_real->countTypeData($type);
            $config['per_page'] = $record_number; 
            $config['uri_segment'] = 2;
            $this->pagination->initialize($config);
            
            $field = 'DateUp';
            $order = 'DESC';
            if(isset($_COOKIE['fSort']) && in_array($_COOKIE['fSort'], array('ID', 'Cost', 'usableArea'))){
                $field = $_COOKIE['fSort'];
            }
            if(isset($_COOKIE['fOrder']) && in_array($_COOKIE['fOrder'], array('DESC', 'ASC'))){
                $order = $_COOKIE['fOrder'];
            }
            
            $data['real_list'] = $this->mmodreal_site_real->getTypeData($field, $order, $type, $record_number, $this->uri->segment(2));
        }else{
            $data['real_list'] = $this->mmodreal_site_real->getTypeData("DateUp", "DESC", $type, $record_number, $record_start);
        }
        if($data['real_list']){
            $this->load->view("modreal/newData", $data);
        }
            
    }
    public function newData($record_number = 4, $record_start = 0, $paginator = false){
        $this->load->model("modreal/mmodreal_site_real");
        $data['paginator'] = $paginator;
        if($paginator){
            $this->load->library("pagination");
            $config['base_url'] = base_url('mua-ban-nha-dat-binh-duong');
            $config['total_rows'] = $this->mmodreal_site_real->countNewData();
            $config['per_page'] = $record_number; 
            $config['uri_segment'] = 2;
            $this->pagination->initialize($config);
            
            $field = 'DateUp';
            $order = 'DESC';
            if(isset($_COOKIE['fSort']) && in_array($_COOKIE['fSort'], array('ID', 'Cost', 'usableArea'))){
                $field = $_COOKIE['fSort'];
            }
            if(isset($_COOKIE['fOrder']) && in_array($_COOKIE['fOrder'], array('DESC', 'ASC'))){
                $order = $_COOKIE['fOrder'];
            }
            $data['real_list'] = $this->mmodreal_site_real->getData($field, $order, $record_number, $this->uri->segment(2));
        }else{
            $data['real_list'] = $this->mmodreal_site_real->getData("DateUp", "DESC", $record_number, $record_start);
        }
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
    public function menu($id, $record_number = 10, $record_start = 0){
        $this->load->model(array("modreal/mmodreal_site_real", "modreal/mmodreal_site_real_menu"));
        $data['menu_check'] = $this->mmodreal_site_real_menu->getDataByID($id);
        if($data['menu_check']){
            $data['paginator'] = true;
            $data['real_title'] = $data['menu_check']['Name'];
            
            $this->load->library("pagination");
            $config['base_url'] = base_url()._setURL($data['menu_check']['Name'])."-rm-".$data['menu_check']['ID'].".html";
            $config['total_rows'] = $this->mmodreal_site_real->countMenuData($id);
            $config['per_page'] = $record_number; 
            $config['uri_segment'] = 2;
            $this->pagination->initialize($config);
                
            $field = 'DateUp';
            $order = 'DESC';
            if(isset($_COOKIE['fSort']) && in_array($_COOKIE['fSort'], array('ID', 'Cost', 'usableArea'))){
                $field = $_COOKIE['fSort'];
            }
            if(isset($_COOKIE['fOrder']) && in_array($_COOKIE['fOrder'], array('DESC', 'ASC'))){
                $order = $_COOKIE['fOrder'];
            }
            $data['real_list'] = $this->mmodreal_site_real->getMenuData($id, $field, $order, $config['per_page'], $this->uri->segment(2));
            $this->load->view("modreal/newData", $data);
        }
    }
    public function search($text = 'none', $menu = 0, $province = 0, $district = 0, $ward = 0, $area = 0, $cost = 0, $direction = 0, $bedroom = 0, $sittingroom = 0){
                
        $this->load->model(array("modreal/mmodreal_site_real","modreal/mmodreal_site_real_menu","msite_add_district","msite_add_ward", "msite_add_province"));
        
        if(!$text){
            $text = 'none';
        }
        
        if($area == 10){

            $area1 = 10;

            $area2 = 50;

        }elseif($area == 50){

            $area1 = 50;

            $area2 = 100;

        }elseif($area == 100){

            $area1 = 100;

            $area2 = 150;

        }elseif($area == 150){

            $area1 = 150;

            $area2 = 200;

        }elseif($area == 200){

            $area1 = 200;

            $area2 = 300;

        }elseif($area == 300){

            $area1 = 300;

            $area2 = 500;

        }elseif($area == 500){

            $area1 = 500;

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

            $cost2 = 5000000000;

        }elseif($cost == 50){

            $cost1 = 5000000000;

            $cost2 = 99999999999;

        }else{
            $cost1 = 0;

            $cost2 = 99999999999;

        }
        
        
        if($direction == 1){

            $direction = "Đông";

        }elseif($direction == 2){

            $direction = "Tây";

        }elseif($direction == 3){

            $direction = "Nam";

        }elseif($direction == 4){

            $direction = "Bắc";

        }elseif($direction == 5){

            $direction = "Đông Bắc";

        }elseif($direction == 6){

            $direction = "Đông Nam";

        }elseif($direction == 7){

            $direction = "Tây Bắc";

        }elseif($direction == 8){

            $direction = "Tây Nam";

        }
    
        $data['menu_check'] = $this->mmodreal_site_real_menu->getDataByID($menu);
        
        $data['district_check'] = $this->msite_add_district->getDataByID($district);

        $data['province_check'] = $this->msite_add_province->getDataByID($province);
        
        $data['ward_check'] = $this->msite_add_ward->getDataByID($ward);
        
        $name = array();
        if($data['menu_check']){
            $name[] = $data['menu_check']['Name'];
        }
        if($data['district_check']){
            $name[] = $data['district_check']['Name'];
        }
        if($data['province_check']){
            $name[] = $data['province_check']['Name'];
        }
        if($data['ward_check']){
            $name[] = $data['ward_check']['Name'];
        }
        if(!$name){
            $name = 'Kết quả tìm kiếm';
        }else{
            $name = implode (', ',$name);
        }
        
        $data['real_title'] = $name;
        $data['paginator'] = true;
        
        $this->load->library(array("pagination"));

        $config['base_url'] = base_url("tim-nha-dat-binh-duong/$text/$menu/$province/$district/$ward/$area/$cost/$direction/$bedroom/$sittingroom");
        $config['total_rows'] = $this->mmodreal_site_real->countSearchData($text, $menu, $district, $ward, $area1, $area2, $cost1, $cost2, $direction, $bedroom, $sittingroom);
        $config['per_page'] = 15; 
        $config['uri_segment'] = 9;
        $this->pagination->initialize($config);
        
        $data['real_list'] = $this->mmodreal_site_real->getSearchData($text, $menu,$province, $district, $ward, $area1, $area2, $cost1, $cost2, $direction, $bedroom, $sittingroom, $config['per_page'],$this->uri->segment(9));
        $this->load->view("modreal/newData", $data);
    }
    // form('', 0,0,0,0,0,0,0,0,0,'right')
    public function form($text, $province=0, $district=0, $ward=0, $rmenu=0, $direction=0, $area=0, $cost=0, $bedRoom=0, $sittingRoom=0, $view = 'wide'){
        $data['textSelect'] = $text;
        $data['provinceSelect'] = $province;
        $data['districtSelect'] = $district;
        $data['wardSelect'] = $ward;
        $data['menuSelect'] = $rmenu;
        $data['directionSelect'] = $direction;
        $data['areaSelect'] = $area;
        $data['costSelect'] = $cost;
        $data['bedRoomSelect'] = $bedRoom;
        $data['sittingRoomSelect'] = $sittingRoom;
        $this->load->model(array("modreal/mmodreal_site_real", "modreal/mmodreal_site_add_province", "modreal/mmodreal_site_add_district", "modreal/mmodreal_site_add_ward", "modreal/mmodreal_site_real_menu"));
        $this->load->helper(array("form"));
        $data['menu_list'] = $this->mmodreal_site_real_menu->getAllData("ASC");
        $data['province_list'] = $this->mmodreal_site_add_province->getNationData(1,"ASC",0,99);
        $data['district_list'] = $this->mmodreal_site_add_district->getProvinceData(8,"ASC",0,99);
        $data['ward_list'] = array();
        $this->load->view("modreal/form-".$view, $data);
    }
    public function searchMap($province=0, $rmenu=0, $cost=0){
        $data['provinceSelect'] = $province;
        $data['menuSelect'] = $rmenu;
        $data['costSelect'] = $cost;
        $this->load->model(array("modreal/mmodreal_site_real","modreal/mmodreal_site_real_menu", "modreal/mmodreal_site_add_province"));
        $this->load->helper(array("form"));
        $data['menu_list'] = $this->mmodreal_site_real_menu->getAllData("ASC");
        $data['province_list'] = $this->mmodreal_site_add_province->getNationData(1,"ASC",0,99);
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

            $cost2 = 5000000000;

        }elseif($cost == 50){

            $cost1 = 5000000000;

            $cost2 = 99999999999;

        }else{
            $cost1 = 0;

            $cost2 = 99999999999;

        }
        
    
        $data['menu_check'] = $this->mmodreal_site_real_menu->getDataByID($rmenu);
        
        $data['province_check'] = $this->msite_add_province->getDataByID($province);
        
        
        $name = array();
        if($data['menu_check']){
            $name[] = $data['menu_check']['Name'];
        }
        if($data['province_check']){
            $name[] = $data['province_check']['Name'];
        }
        if(!$name){
            $name = 'Kết quả tìm kiếm';
        }else{
            $name = implode (', ',$name);
        }
        
        $data['real_title'] = $name;

        $config['base_url'] = base_url("tim-kiem-bang-ban-do");
        
        $data['real_list'] = $this->mmodreal_site_real->getSearchMapData($rmenu,$province, $cost1, $cost2);
        $this->load->view("modreal/form-searchMap", $data);
    }
    public function detail($id){
        if($id && is_numeric($id)){
            $this->load->model(array("modreal/mmodreal_site_real","modreal/mmodreal_site_real_img","modnews/mmodnews_site_news_comment","moduser/mmoduser_wb_user"));
            $data['real_check'] = $this->mmodreal_site_real->getDataByID($id);
            
            if($data['real_check']){
                
                $this->mmodreal_site_real->addHit($id);
                
                $data['img_list'] = $this->mmodreal_site_real_img->getRealData($id,50,0);
                
                $data['user_check'] = $this->mmoduser_wb_user->getDataByID($data['real_check']['User']);
                
                $data['real_list'] = $this->mmodreal_site_real->getSimilarData($id, $data['real_check']['Menu'], $data['real_check']['Type'], "DESC", 4,0);
                
                $this->load->view("modreal/detail", $data);
            }
        }
    }
        
}