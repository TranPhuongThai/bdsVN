<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_auth extends CI_Session
{
    var $CI;
    var $_model;
    
    public function __construct(){
        parent::__construct();
        $CI =& get_instance();
        
        $this->obj = $CI;
        $this->obj->load->database();
        $this->obj->load->model(array("mwb_user","mwb_tuser"));
    }
    
    public function is_Access($class_name){
        $info = $this->obj->mwb_tuser->checkAccess($class_name,$this->userdata("WBTYPE"));
        if($info){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function is_Admin(){
        
        $info = $this->obj->mwb_user->getDataByID($this->userdata("WBUSERID"));
        if($this->is_Login() && $info['Type'] <= 3){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function is_Active($id){
        
        if($this->obj->mwb_user->checkActive($id))
            return TRUE;
        else
            return FALSE;
    }
    
    public function is_Login(){
        
        if($this->userdata("WBUSERID") && $this->userdata("WBUSERID")!="")
            return TRUE;
        else
            return FALSE;
    }
    
    public function is_Member_Login(){
        //return array('userid'=>123, 'username'=>'tiendv');
        if($this->userdata("USERID") && $this->userdata("USERID")!="")
            return array('userid'=>$this->userdata("USERID"), 'username'=>$this->userdata("USERNAME"));
        else
            return FALSE;
    }
    
    public function __get($var){
        
        return $this->userdata($var);
    }
    
    
}