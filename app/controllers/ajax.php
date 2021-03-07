<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array("url","form"));
        $this->load->database();
    }
    public function index(){
    }
    public function getOptionWard($district){
        if(is_numeric($district)){
            $this->load->model("msite_add_ward");
            $data['ward_list'] = $this->msite_add_ward->getDistrictData($district,"ASC",99,0);
            if($data['ward_list']){
                foreach($data['ward_list'] as $row) {
                    echo "<option value=\"".$row['ID']."\">".$row['Name']."</option>";
                } 
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    public function getOptionDistrict($province){
        if(is_numeric($province)){
            $this->load->model("msite_add_district");
            $data['district_list'] = $this->msite_add_district->getProvinceData($province,"ASC",99,0);
            if($data['district_list']){
                foreach($data['district_list'] as $row) {
                    echo "<option value=\"".$row['ID']."\">".$row['Name']."</option>";
                } 
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    public function getOptionAdminMenu($menu){
        if(is_numeric($menu)){
            $this->load->model("msite_album");
            $data['menu_list'] = $this->msite_album->getMenuData($menu,"ASC",99,0);
            if($data['menu_list']){
                foreach($data['menu_list'] as $row) {
                    echo "<option value=\"".$row['ID']."\">".$row['Name']."</option>";
                } 
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    public function getOptionMenuVideo($pid){
        if(is_numeric($pid)){
            $this->load->model("msite_video_menu");
            $data['menu_list'] = $this->msite_video_menu->getPidStatusData($pid, 1, "ASC", 99, 0);
            if($data['menu_list']){
                //echo "<select name=\"menu\" class=\"valid\">";
                foreach($data['menu_list'] as $row) {
                    echo "<option value=\"".$row['ID']."\">".$row['Name']."</option>";
                } 
                //echo "</select>";
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    
    public function checkCommentVideo($idvideo){
        if(is_numeric($idvideo)){
            $this->load->model("msite_video_comment");
            $data['check_comment'] = $this->msite_video_comment->getDataByID($idvideo);
            if($data['check_comment']){
                $update = array("Status" => 1);
                $this->msite_video_comment->updateData($update, $idvideo);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function uncheckCommentVideo($idvideo){
        if(is_numeric($idvideo)){
            $this->load->model("msite_video_comment");
            $data['check_comment'] = $this->msite_video_comment->getDataByID($idvideo);
            if($data['check_comment']){
                $update = array("Status" => 2);
                $this->msite_video_comment->updateData($update, $idvideo);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function checkCommentAlbum($idalbum){
        if(is_numeric($idalbum)){
            $this->load->model("msite_album_comment");
            $data['check_comment'] = $this->msite_album_comment->getDataByID($idalbum);
            if($data['check_comment']){
                $update = array("Status" => 1);
                $this->msite_album_comment->updateData($update, $idalbum);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function uncheckCommentAlbum($idalbum){
        if(is_numeric($idalbum)){
            $this->load->model("msite_album_comment");
            $data['check_comment'] = $this->msite_album_comment->getDataByID($idalbum);
            if($data['check_comment']){
                $update = array("Status" => 2);
                $this->msite_album_comment->updateData($update, $idalbum);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}