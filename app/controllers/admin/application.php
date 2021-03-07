<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Application extends CI_Controller{
    public $data = array();
    public function __construct(){
        parent::__construct();
        $this->lang->load("backend");
        $this->load->helper(array("form"));
        $this->load->library(array("form_validation","pagination","my_layout"));
        $this->my_layout->setLayout("backend/admin_template");
        $this->data['admin_menu_all'] = $this->_getMainMenu(0);
    }
    function _getMainMenu($pid){
        $this->load->model("madmin_menu");
		$menu_list = $this->madmin_menu->adminMenu($this->my_auth->userdata("WBTYPE"),$pid, 1, "ASC", 99, 0);
		$slt = "";
        foreach($menu_list as $row){
            $name = $row['Name'];
            $slt .= "<li>";
            $slt .= "<a href='" .base_url()."admin/" . $row['Link'] . "'>" . $name;
			$slt_1 = $this->_getMainMenu($row['ID']);
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
}