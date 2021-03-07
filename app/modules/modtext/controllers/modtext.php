<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modtext extends MX_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        echo "Hello world!";
    }
    public function getText($id = 1){
        if($id && is_numeric($id)){
            $this->load->model("modtext/mmodtext_site_text");
            $data['statis_page'] = $this->mmodtext_site_text->getDataByID($id);
            if($data['statis_page']){
                $this->load->view("modtext/modtext-getText",$data);
            }
        }
    }
    public function getTextRight($id = 1){
        if($id && is_numeric($id)){
            $this->load->model("modtext/mmodtext_site_text");
            $data['statis_page'] = $this->mmodtext_site_text->getDataByID($id);
            if($data['statis_page']){
                $this->load->view("modtext/modtext-getTextRight",$data);
            }
        }
    }
    public function getTextNoTitle($id = 1){
        if($id && is_numeric($id)){
            $this->load->model("modtext/mmodtext_site_text");
            $data['statis_page'] = $this->mmodtext_site_text->getDataByID($id);
            if($data['statis_page']){
                $this->load->view("modtext/modtext-getTextNoTitle",$data);
            }
        }
    }
    public function getTextContent($id = 1){
        if($id && is_numeric($id)){
            $this->load->model("modtext/mmodtext_site_text");
            $data['statis_page'] = $this->mmodtext_site_text->getDataByID($id);
            if($data['statis_page']){
                return $data['statis_page']['Content'];
            }
        }
    }
    public function getLikebox($name = 'BaoONN'){
        $data['name'] = $name;
        $this->load->view("modtext/modtext-getLikebox", $data);
    }
    public function getForexs(){
        $this->load->view("modtext/modtext-getForexs");
    }
    public function getGold(){
        $this->load->view("modtext/modtext-getGold");
    }
        
}