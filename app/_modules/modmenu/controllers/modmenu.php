<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modmenu extends MX_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        echo "Hello world!";
    }
    function _loadPidMainMenu($pid = 0, $status = 1, $active = 0, $stripTag = false, $showChild = true){
        $this->load->model("mmodmenu_site_menu"); 
        $menu_list = $this->mmodmenu_site_menu->getPidStatusData($pid, $status, "ASC", 99, 0);
		$slt = "";
        foreach($menu_list as $row){
            if(is_numeric($active) && $active == $row['ID'])
                $slt .= "<li class='active'>";
            else
                $slt .= "<li>";
            $name = ($stripTag) ? strip_tags($row['Name']) : $row['Name'];
            $slt .= "<a href='" .base_url() . $row['Link'] . "'>" . $name;
            if($showChild)
			    $slt_1 = $this->_loadPidMainMenu($row['ID'], $status);
            else
                $slt_1 = '';
			if($slt_1 != ""){
                $slt .= "</a>";		
				$slt .= "<ul>" . $slt_1 . "</ul>";
				$slt_1 = "";
			}else{
                $slt .= "</a>";	
			}
            $slt .= "</li>";
        }
		return $slt;
    }
    public function navigation($pid = 0, $status = 1, $active = 0){
        $data['menu_list'] = $this->_loadPidMainMenu($pid, $status, $active);
        return $data['menu_list'];
    }
    public function navigationBot($pid = 0, $status = 1, $active = 0, $stripTag = true, $showChild = false){
        $data['menu_list'] = $this->_loadPidMainMenu($pid, $status, $active, $stripTag, $showChild);
        $this->load->view("modmenu/modmenu-navigation",$data);
    }
    public function navigationFlash($pid = 0, $status = 1, $active = 0){
        $data['menu_list'] = $this->_loadPidMainMenu($pid, $status, $active);
        $this->load->view("modmenu/modmenu-navigationFlash",$data);
    }
    public function navigationSlide($pid = 0, $status = 1, $active = 0){
        $data['menu_list'] = $this->_loadPidMainMenu($pid, $status, $active);
        $this->load->view("modmenu/modmenu-navigationSlide",$data);
    }
}
