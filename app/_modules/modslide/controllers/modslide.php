<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modslide extends MX_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        echo "Hello world!";
    }
    public function nivoSlider(){
        $this->load->model("modslide/mmodslide_site_slide");
        $data['slide_list'] = $this->mmodslide_site_slide->getStatusData(1,"ASC",10,0);
        if($data['slide_list']){
            $this->load->view("modslide/modslide-nivoSlider",$data);
        }
    }
    public function jcarousel(){
        $this->load->model("modslide/mmodslide_site_slide");
        $data['slide_list'] = $this->mmodslide_site_slide->getStatusData(1,"ASC",10,0);
        if($data['slide_list']){
            $this->load->view("modslide/modslide-jcarousel",$data);
        }
    }
    public function carouFredSel(){
        $this->load->model("modslide/mmodslide_site_slide");
        $data['slide_list'] = $this->mmodslide_site_slide->getStatusData(1,"ASC",10,0);
        if($data['slide_list']){
            $this->load->view("modslide/modslide-carouFredSel",$data);
        }
    }
    public function transBanner(){
        $this->load->model("modslide/mmodslide_site_slide");
        $data['slide_list'] = $this->mmodslide_site_slide->getStatusData(1,"ASC",10,0);
        if($data['slide_list']){
            $this->load->view("modslide/modslide-transBanner",$data);
        }
    }
        
}