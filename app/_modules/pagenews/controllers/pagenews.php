<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Pagenews extends MX_Controller{

    public function __construct(){

        parent::__construct();

    }

    public function index(){

        $data['menu'] = 0;

        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);

        //modules

        $data['zone'] = $this->load->module("zone");

        $data['modnews'] = $this->load->module("modnews");

        $this->load->view("pagenews/pagenews-index",$data);

    }

    public function menu($menuid){

        $data['menu'] = 0;

        if($menuid == 1){

            $data['menu'] = 3;

        }elseif($menuid == 2){

            $data['menu'] = 4;

        }elseif($menuid == 3){

            $data['menu'] = 5;

        }elseif($menuid == 4){

            $data['menu'] = 6;

        }

        $data['menuid'] = $menuid;

        $data['seo'] = $this->my_site_menu->_loadSeoNewsMenu($menuid,(int)($this->uri->segment(2)));

        //modules

        $data['zone'] = $this->load->module("zone");

        $data['modnews'] = $this->load->module("modnews");
        
        $this->load->model(array("modnews/mmodnews_site_news_menu"));

        $data['menu_check'] = $this->mmodnews_site_news_menu->getDataByID($menuid);

        if($data['menu_check']){
            
            $data['link_canonical'] = base_url(_setURL($data['menu_check']['Name']));
            
        }

        $this->load->view("pagenews/pagenews-menu",$data);

    }

    public function detail($id){

        $data['menu'] = 0;

        $data['seo'] = $this->my_site_menu->_loadSeoMenu($data['menu']);

        //modules

        if($id && is_numeric($id)){

            $this->load->model(array("pagenews/mpagenews_site_news"));

            $data['news_check'] = $this->mpagenews_site_news->getDataByID($id);

            if($data['news_check']){

                $data['menu'] = 0;

                if($data['news_check']['Menu'] == 1){

                    $data['menu'] = 3;

                }elseif($data['news_check']['Menu'] == 2){

                    $data['menu'] = 4;

                }elseif($data['news_check']['Menu'] == 3){

                    $data['menu'] = 5;

                }elseif($data['news_check']['Menu'] == 4){

                    $data['menu'] = 6;

                }

                //seo

                $data['seo']['site_title'] = $data['news_check']['Name'];

                $data['seo']['site_keywords'] = $data['news_check']['Name'];

                $data['seo']['site_description'] = $data['news_check']['MainContent'];

                if($data['news_check']['MTit'])

                    $data['seo']['site_title'] = $data['news_check']['MTit'];

                if($data['news_check']['MKey'])

                    $data['seo']['site_keywords'] = $data['news_check']['MKey'];

                if($data['news_check']['MDes'])

                    $data['seo']['site_description'] = $data['news_check']['MDes'];

                $data['link_canonical'] = base_url(_setURL($data['news_check']['Name']).'-news-'.$data['news_check']['ID'].'.html');

                $this->mpagenews_site_news->addHit($id);

                

                $data['zone'] = $this->load->module("zone");

                $data['modnews'] = $this->load->module("modnews");

                $this->load->view("pagenews/pagenews-detail",$data);

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