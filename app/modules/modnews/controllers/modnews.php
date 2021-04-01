<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Modnews extends MX_Controller{

    public function __construct(){

        parent::__construct();

    }

    public function index(){

        echo "Hello world!";

    }

    public function postComment($type="news", $id = 0){

        $this->load->helper("form");
        $this->load->library(array("form_validation","email"));
        $this->load->model(array("modnews/mmodnews_site_news_comment"));
        
        $this->form_validation->set_rules("name","Tên/Số điện thoại","required");
        $this->form_validation->set_rules("content","Nội dung","required|min_length[10]");
        $data = array();
        $data['type'] = $type;
        $data['id'] = (int)$id;
        if($this->form_validation->run() == FALSE){
            $data['successfully'] = "";
            $data['error'] = ""; 
        }else{
            $dataAdd['PID'] = 0;
            $dataAdd['News'] = (int)$id;
            $dataAdd['Name'] = $this->input->post("name");
            $dataAdd['Email'] = $this->input->post("email");
            $dataAdd['Content'] = $this->input->post("content");
            $dataAdd['Dateset'] = date("Y-m-d H:i:s");
            $dataAdd['Status'] = 0;
            if($type == "news"){
                $type = 1;
            }else{
                $type = 2;
            }
            $dataAdd['Type'] = $type;
            $id = $this->mmodnews_site_news_comment->addData($dataAdd);
            if($id){
                $data['successfully'] = "Bình luận của bạn đã được gửi. Chúng tôi sẽ kiểm duyệt trước khi cho hiển thị trên website.<br />Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!";
            }
        }
        $this->load->view("modnews/modnews-postComment",$data);
    }

    public function pidMenu($pid = 1, $record_number = 99, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news_menu"));

        $data['menu_check'] = $this->mmodnews_site_news_menu->getDataByID($pid);

        if($data['menu_check']){

            $data['menu_child'] = $this->mmodnews_site_news_menu->getPidData($data['menu_check']['ID'],99,0);

            $this->load->view("modnews/modnews-pidMenu", $data);

        }

    }

    public function tabNews($record_number = 4, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news","modnews/mmodnews_site_news_menu"));

        $data['menu_list'] = $this->mmodnews_site_news_menu->getPidData(0, 99, 0);

        if($data['menu_list']){

            foreach($data['menu_list'] as $key=>$menu){

                $data['menu_list'][$key]['news_list'] = $this->mmodnews_site_news->getMenuData($menu['ID'], 'DESC', $record_number, $record_start);

            }

            $this->load->view("modnews/modnews-tabNews", $data);

        }

    }

    public function newsHot($record_number = 4, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news"));

        $data['news_list'] = $this->mmodnews_site_news->getHotData("DESC", $record_number, $record_start);

        if($data['news_list']){

            $this->load->view("modnews/modnews-newsHot", $data);

        }

    }

    public function newsTopHit($record_number = 4, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news"));

        $data['news_list'] = $this->mmodnews_site_news->getTopHitData("DESC", $record_number, $record_start);

        if($data['news_list']){

            $this->load->view("modnews/modnews-newsHot", $data);

        }

    }

    public function newsTopHit2($record_number = 4, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news"));

        $data['news_list'] = $this->mmodnews_site_news->getTopHitData("DESC", $record_number, $record_start);

        if($data['news_list']){

            $this->load->view("modnews/modnews-newsHot2", $data);

        }

    }

    public function newsAdvisory($record_number = 4, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news"));

        $data['news_list'] = $this->mmodnews_site_news->getAdvisoryData("DESC", $record_number, $record_start);

        if($data['news_list']){

            $this->load->view("modnews/modnews-newsHot", $data);

        }

    }

    public function newsAdvisory2($record_number = 4, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news"));

        $data['news_list'] = $this->mmodnews_site_news->getAdvisoryData("DESC", $record_number, $record_start);

        if($data['news_list']){

            $this->load->view("modnews/modnews-newsHot2", $data);

        }

    }

    public function newsHotMenu($menu = 1, $record_number = 4, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news"));

        $data['news_list'] = $this->mmodnews_site_news->getHotDataMenu($menu, "DESC", $record_number, $record_start);

        if($data['news_list']){

            $this->load->view("modnews/modnews-newsHotMenu", $data);

        }

    }

    public function newsMenu($menu = 1, $record_number = 12, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news","modnews/mmodnews_site_news_menu"));

        $this->load->library(array("pagination"));
        
        $data['modnews'] = $this->load->module('modnews');

        if($menu && is_numeric($menu)){

            $data['menu_check'] = $this->mmodnews_site_news_menu->getDataByID($menu);

            if($data['menu_check']){
            
                $data['menu_root'] = $this->my_site_menu->_getRootNewsMenu($menu);

                $data['menu_root_check'] = $this->mmodnews_site_news_menu->getDataByID($data['menu_root']);
                
                $data['menu_list'] = $this->mmodnews_site_news_menu->getPidData($data['menu_root'],50,0);
                
                $data['menu_list_2'] = $this->mmodnews_site_news_menu->getPidData($data['menu_check']['ID'],50,0);
                
                if(!$data['menu_list_2']){
    
                    $config['base_url'] = base_url(_setURL($data['menu_check']['Name'])."-mnews-".$data['menu_check']['ID'].".html");//
    
                    $config['total_rows'] = $this->mmodnews_site_news->countMenuData($menu);
    
    
                    $config['per_page'] = $record_number;
    
                    $config['uri_segment'] = 2;
    
                    $this->pagination->initialize($config);
    
                    $data['news_list'] = $this->mmodnews_site_news->getMenuData($menu, "DESC", $config['per_page'], (int)($this->uri->segment(2)));
                }

                $this->load->view("modnews/modnews-newsMenu", $data);

            }

        }

    }

    public function newsCategoriesMenu($menu = 1, $record_number = 7, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news","modnews/mmodnews_site_news_menu"));

        $this->load->library(array("pagination"));
        
        $data['modnews'] = $this->load->module('modnews');

        if($menu && is_numeric($menu)){

            $data['menu_check'] = $this->mmodnews_site_news_menu->getDataByID($menu);

            if($data['menu_check']){
            
                $data['menu_root'] = $this->my_site_menu->_getRootNewsMenu($menu);

                $data['menu_root_check'] = $this->mmodnews_site_news_menu->getDataByID($data['menu_root']);
                
                $data['menu_list'] = $this->mmodnews_site_news_menu->getPidData($data['menu_root'],50,0);
                
                $this->load->view("modnews/modnews-newsCategoriesMenu", $data);

            }

        }

    }

    public function newsMenuSlide($menu = 1, $record_number = 5, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news","modnews/mmodnews_site_news_menu"));

        if($menu && is_numeric($menu)){

            $data['menu_check'] = $this->mmodnews_site_news_menu->getDataByID($menu);

            if($data['menu_check']){

                $data['news_list'] = $this->mmodnews_site_news->getMenuDataHot($menu, "DESC", $record_number, $record_start);

                $this->load->view("modnews/modnews-newsMenuSlide", $data);

            }

        }

    }

    public function newsMenuData1($menu = 1, $record_number = 4, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news","modnews/mmodnews_site_news_menu"));

        if($menu && is_numeric($menu)){

            $data['menu_check'] = $this->mmodnews_site_news_menu->getDataByID($menu);

            if($data['menu_check']){                

                $data['news_list'] = $this->mmodnews_site_news->getMenuData($menu, "DESC", $record_number, $record_start);

                $this->load->view("modnews/modnews-newsMenuData1", $data);

            }

        }

    }

    public function newsMenuData2($menu = 1, $record_number = 4, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news","modnews/mmodnews_site_news_menu"));

        if($menu && is_numeric($menu)){

            $data['menu_check'] = $this->mmodnews_site_news_menu->getDataByID($menu);

            if($data['menu_check']){                

                $data['news_list'] = $this->mmodnews_site_news->getMenuData($menu, "DESC", $record_number, $record_start);

                $this->load->view("modnews/modnews-newsMenuData2", $data);

            }

        }

    }

    public function newsData($record_number = 4, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news","modnews/mmodnews_site_news_menu"));

        $data['news_list'] = $this->mmodnews_site_news->getAllData("DESC", $record_number, $record_start);

        $this->load->view("modnews/modnews-newsData", $data);

    }

    public function listNews($record_number = 18, $record_start = 0){

        $this->load->model(array("modnews/mmodnews_site_news","modnews/mmodnews_site_news_menu"));

        $data['news_list'] = $this->mmodnews_site_news->getAllData("DESC", $record_number, $record_start);

        $this->load->view("modnews/modnews-listNews", $data);

    }

    public function allNews(){

        $this->load->model(array("modnews/mmodnews_site_news"));

        $this->load->library(array("pagination"));

        

        $config['base_url'] = base_url("news/");

        $config['total_rows'] = $this->mmodnews_site_news->countAllData();

        $config['per_page'] = 14;

        $config['uri_segment'] = 2;

        $this->pagination->initialize($config);

        

        $data['news_list'] = $this->mmodnews_site_news->getAllData("DESC", $config['per_page'], (int)($this->uri->segment(2)));

        $this->load->view("modnews/modnews-allNews", $data);

    }

    public function detail($id = 1){

        if($id && is_numeric($id)){

            $this->load->model(array("modnews/mmodnews_site_news", "modnews/mmodnews_site_news_menu", "modnews/mmodnews_site_news_comment"));

            $data['news_check'] = $this->mmodnews_site_news->getDataByID($id);

            if($data['news_check']){
                            
                $data['menu_root'] = $this->my_site_menu->_getRootNewsMenu($data['news_check']['Menu']);

                $data['menu_root_check'] = $this->mmodnews_site_news_menu->getDataByID($data['menu_root']);
                
                $data['menu_list'] = $this->mmodnews_site_news_menu->getPidData($data['menu_root'],50,0);
                
                $this->mmodnews_site_news->addHit($id);
                
                $data['modnews'] = $this->load->module("modnews");
                
                //$data['comment_list'] = $this->mmodnews_site_news_comment->getNewsPIDData(1, $id, 0, 'DESC', 99, 0);

                $data['news_list'] = $this->mmodnews_site_news->getSimilarData($data['news_check']['Menu'], $id, "DESC", 5,0);

                $date =date_create($data['news_check']['Dateset']);
                
                $weekday = date_format($date, 'l');
                
                $weekday = strtolower($weekday);

                switch($weekday) {
                    case 'monday':
                        $weekday = 'Thứ hai';
                        break;
                    case 'tuesday':
                        $weekday = 'Thứ ba';
                        break;
                    case 'wednesday':
                        $weekday = 'Thứ tư';
                        break;
                    case 'thursday':
                        $weekday = 'Thứ năm';
                        break;
                    case 'friday':
                        $weekday = 'Thứ sáu';
                        break;
                    case 'saturday':
                        $weekday = 'Thứ bảy';
                        break;
                    default:
                        $weekday = 'Chủ nhật';
                        break;
                }
                // echo $weekday . ' - ' . date_format($date, 'd/m/Y');
                $data['news_check']['Dateset'] = $weekday . ' - ' . date_format($date, 'd/m/Y');

                $this->load->view("modnews/modnews-detail", $data);

            }

        }

    }

}