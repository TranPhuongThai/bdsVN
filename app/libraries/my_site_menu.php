<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_site_menu{
    var $obj;
    
    function __construct(){
        $this->obj =& get_instance();
        
        $this->obj->load->database();
    }
    function _loadSeoMenu($id){
        $this->obj->load->model(array("msite_menu","msite_config")); 
        $site_config = $this->obj->msite_config->getAllData("ASC",5,0);
        if($site_config){
            $data['site_title']         = $site_config[0]["Content"];
            $data['site_keywords']      = $site_config[1]["Content"];
            $data['site_description']   = $site_config[2]["Content"];
            $data['site_webmaster_tool']= $site_config[3]["Content"];
            $data['site_analytics']     = $site_config[4]["Content"];
        }
        $menu_config = $this->obj->msite_menu->getDataByID($id);
        if($menu_config){
            $data['site_title']         = $menu_config['Name'];
            $data['site_keywords']      = $menu_config['Name'];
            $data['site_description']   = $menu_config['Name'];
            if($menu_config['MTit'])
                $data['site_title']         = $menu_config['MTit'];
            if($menu_config['MKey'])
                $data['site_keywords']      = $menu_config['MKey'];
            if($menu_config['MDes'])
                $data['site_description']   = $menu_config['MDes'];
        }
        if($data)
            return $data;
        return 0;
    }
    function _loadSeoProductMenu($id, $page = 0){
        $this->obj->load->model(array("msite_product_menu","msite_config")); 
        $site_config = $this->obj->msite_config->getAllData("ASC",5,0);
        if($site_config){
            $data['site_title']         = $site_config[0]["Content"];
            $data['site_keywords']      = $site_config[1]["Content"];
            $data['site_description']   = $site_config[2]["Content"];
            $data['site_webmaster_tool']= $site_config[3]["Content"];
            $data['site_analytics']     = $site_config[4]["Content"];
        }
        $product_menu = $this->obj->msite_product_menu->getDataByID($id);
        if($product_menu){
            $data['site_title']         = $product_menu['Name'];
            $data['site_keywords']      = $product_menu['Name'];
            $data['site_description']   = $product_menu['Name'];
            if($news_menu['MTit'])
                $data['site_title']         = $product_menu['MTit'];
            if($news_menu['MKey'])
                $data['site_keywords']      = $product_menu['MKey'];
            if($news_menu['MDes'])
                $data['site_description']   = $product_menu['MDes'];
        }
        if($page){
            $data['site_title']         .= " | $page";
            $data['site_keywords']      .= " | $page";
            $data['site_description']   .= " | $page";
        }
        if($data)
            return $data;
        return 0;
    }
    function _loadSeoNewsMenu($id, $page = 0){
        $this->obj->load->model(array("msite_news_menu","msite_config")); 
        $site_config = $this->obj->msite_config->getAllData("ASC",5,0);
        if($site_config){
            $data['site_title']         = $site_config[0]["Content"];
            $data['site_keywords']      = $site_config[1]["Content"];
            $data['site_description']   = $site_config[2]["Content"];
            $data['site_webmaster_tool']= $site_config[3]["Content"];
            $data['site_analytics']     = $site_config[4]["Content"];
        }
        $news_menu = $this->obj->msite_news_menu->getDataByID($id);
        if($news_menu){
            $data['site_title']         = $news_menu['Name'];
            $data['site_keywords']      = $news_menu['Name'];
            $data['site_description']   = $news_menu['Name'];
            if($news_menu['MTit'])
                $data['site_title']         = $news_menu['MTit'];
            if($news_menu['MKey'])
                $data['site_keywords']      = $news_menu['MKey'];
            if($news_menu['MDes'])
                $data['site_description']   = $news_menu['MDes'];
        }
        if($page){
            $data['site_title']         .= " | $page";
            $data['site_keywords']      .= " | $page";
            $data['site_description']   .= " | $page";
        }
        if($data)
            return $data;
        return 0;
    }
    function _loadSeoRealMenu($id, $page = 0){
        $this->obj->load->model(array("msite_real_menu","msite_config")); 
        $site_config = $this->obj->msite_config->getAllData("ASC",5,0);
        if($site_config){
            $data['site_title']         = $site_config[0]["Content"];
            $data['site_keywords']      = $site_config[1]["Content"];
            $data['site_description']   = $site_config[2]["Content"];
            $data['site_webmaster_tool']= $site_config[3]["Content"];
            $data['site_analytics']     = $site_config[4]["Content"];
        }
        $real_menu = $this->obj->msite_real_menu->getDataByID($id);
        if($real_menu){
            $data['site_title']         = $real_menu['Name'];
            $data['site_keywords']      = $real_menu['Name'];
            $data['site_description']   = $real_menu['Name'];
            if($real_menu['MTit'])
                $data['site_title']         = $real_menu['MTit'];
            if($real_menu['MKey'])
                $data['site_keywords']      = $real_menu['MKey'];
            if($real_menu['MDes'])
                $data['site_description']   = $real_menu['MDes'];
        }
        if($page){
            $data['site_title']         .= " | $page";
            $data['site_keywords']      .= " | $page";
            $data['site_description']   .= " | $page";
        }
        if($data)
            return $data;
        return 0;
    }
    function _loadDistrictMenu($province,$select = 0,$menuActive = 0){
        $this->obj->load->model(array("msite_add_district","msite_real_menu")); 
        $province_list = $this->obj->msite_add_district->getProvinceData_2($province, 1, "ASC", 99, 0);
        $menu_list = $this->obj->msite_real_menu->getPidStatusData(0, 1, "ASC", 99, 0);
		$slt = "";
        foreach($province_list as $district){
            if($district['ID'] == $select)
                $slt .= "<li class=\"open\">";
            else
                $slt .= "<li class=\"closed\">";
            $slt .= "<span class=\"folder\">" . $district['Name']."</span>";
            $slt .= "<ul>";
            foreach($menu_list as $menu){
                if($menu['ID'] == $menuActive && $district['ID'] == $select)
                    $slt .=  "<li><a class=\"file active\" href=\"" . base_url() . "real_menu/" . $district['ID'] ."/". $menu['ID'] ."/".  _setURL($menu['Name']) . _setURL($district['Name']) .".html\">" . $menu['Name'] . "</a></li>";
                else    
                    $slt .=  "<li><a class=\"file\" href=\"" . base_url() . "real_menu/" . $district['ID'] ."/". $menu['ID'] ."/".  _setURL($menu['Name']) . _setURL($district['Name']) .".html\">" . $menu['Name'] . "</a></li>";
            }
            $slt .= "</ul>";
            $slt .= "</li>";
        }
		return $slt;
    }
    function _loadSeoText($id, $page = 0){
        $this->obj->load->model(array("msite_text","msite_config")); 
        $site_config = $this->obj->msite_config->getAllData("ASC",5,0);
        if($site_config){
            $data['site_title']         = $site_config[0]["Content"];
            $data['site_keywords']      = $site_config[1]["Content"];
            $data['site_description']   = $site_config[2]["Content"];
            $data['site_webmaster_tool']= $site_config[3]["Content"];
            $data['site_analytics']     = $site_config[4]["Content"];
        }
        $text_check = $this->obj->msite_text->getDataByID($id);
        if($text_check){
            $data['site_title']         = $text_check['Name'];
            $data['site_keywords']      = $text_check['Name'];
            $data['site_description']   = $text_check['Name'];
            if(isset($text_check['MTit']))
                $data['site_title']         = $text_check['MTit'];
            if(isset($text_check['MKey']))
                $data['site_keywords']      = $text_check['MKey'];
            if(isset($text_check['MDes']))
                $data['site_description']   = $text_check['MDes'];
        }
        if($page){
            $data['site_title']         .= " | $page";
            $data['site_keywords']      .= " | $page";
            $data['site_description']   .= " | $page";
        }
        if($data)
            return $data;
        return 0;
    }
    function _loadSeoDistrict($id, $page = 0){
        $this->obj->load->model(array("msite_add_district","msite_config")); 
        $site_config = $this->obj->msite_config->getAllData("ASC",5,0);
        if($site_config){
            $data['site_title']         = $site_config[0]["Content"];
            $data['site_keywords']      = $site_config[1]["Content"];
            $data['site_description']   = $site_config[2]["Content"];
            $data['site_webmaster_tool']= $site_config[3]["Content"];
            $data['site_analytics']     = $site_config[4]["Content"];
        }
        $district_check = $this->obj->msite_add_district->getDataByID($id);
        if($district_check){
            $data['site_title']         = $district_check['Name'];
            $data['site_keywords']      = $district_check['Name'];
            $data['site_description']   = $district_check['Name'];
            if(isset($district_check['MTit']))
                $data['site_title']         = $district_check['MTit'];
            if(isset($district_check['MKey']))
                $data['site_keywords']      = $district_check['MKey'];
            if(isset($district_check['MDes']))
                $data['site_description']   = $district_check['MDes'];
        }
        if($page){
            $data['site_title']         .= " | $page";
            $data['site_keywords']      .= " | $page";
            $data['site_description']   .= " | $page";
        }
        if($data)
            return $data;
        return 0;
    }
    function _getParentNewsMenu($id){
        $this->obj->load->model(array("msite_news_menu")); 
        $news_menu = $this->obj->msite_news_menu->getDataByID($id);
        if(isset($news_menu['PID'])){
            return (int)($news_menu['PID']);
        }
    }
    function _getRootNewsMenu($id){
        $pid = $this->_getParentNewsMenu($id);
        if($pid === 0){
            return $id;exit;
        }else{
            //$pid = $this->_getRootNewsMenu($pid);
            
            $pid = $this->_getParentNewsMenu($id);
            if($pid === 0){
                return $id;exit;
            }else{
                $pid2 = $this->_getParentNewsMenu($pid);
                if($pid2 === 0){
                    return $pid;exit;
                }else{
                    $pid3 = $this->_getParentNewsMenu($pid2);
                    if($pid3 === 0){
                        return $pid2;exit;
                    }
                }
            }
        }
    }
    
}