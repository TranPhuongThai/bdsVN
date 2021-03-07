<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modonline extends MX_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array("modonline/mmodonline_wb_online","modonline/mmodonline_wb_statistics"));
    }
    public function index(){
        echo "Hello world!";
    }
    public function statistics(){
        
        //start: Nếu không tồn tại session online thì khởi tạo 1 session online rồi thêm vào thống kê theo ngày.
        if(!$this->my_auth->userdata("WBONLINE")){
            $this->my_auth->set_userdata("WBONLINE",rand(0, 999999999));
            $statistic = $this->mmodonline_wb_statistics->getToDayOnline();	
            if($statistic){
                $this->mmodonline_wb_statistics->addHit();
            }else{
                $add = array(
                "Dateset"   => date("Y-m-d"),
                "Hit"       => "1"
                );
                $this->mmodonline_wb_statistics->addData($add);
            }
        }
        //end: Nếu không tồn tại session online thì khởi tạo 1 session online rồi thêm vào thống kê theo ngày.
        
        //start: Xóa những record online đã quá thời gian truy cập vào website
        $this->config->load("config");
        $sess_expiration = 3600 * 6;
        $CurrentTime = time();
        $TimeOut = $CurrentTime - $sess_expiration; // $sess_expiration = thời gian sống của session
        $this->mmodonline_wb_online->delOnlineTime($TimeOut);//xóa trong bảng online những record đã quá thời gian sống
        //end: Xóa những record online đã quá thời gian truy cập vào website
        
        //start: Cập nhật thời gian user truy cập website gần nhất
        $checkOnline = $this->mmodonline_wb_online->getDataBySessionID($this->my_auth->userdata("WBONLINE"));
        if($checkOnline){
            $update = array(
                "Time"      => $CurrentTime
            );
            $this->mmodonline_wb_online->updateDataBySessionID($update, $this->my_auth->userdata("WBONLINE"));
        }else{
            if($this->my_auth->userdata("WBUSERID")){
                $user = $this->my_auth->userdata("WBUSERID");
            }else{
                $user = "guess";
            }
            $date = date("Y-m-d H:i:s");
            $add = array(
                "SessionID" => $this->my_auth->userdata("WBONLINE"),
                "Time"      => $CurrentTime,
                "Dateset"   => $date,
                "User"      => $user,
                "IP"        => $this->input->ip_address()
            );
            $this->mmodonline_wb_online->addData($add);
        }
        //end: Cập nhật thời gian user truy cập website gần nhất
    }
    public function detail(){
        $data['online'] = $this->mmodonline_wb_online->countOnline();
        $data['online_today'] = $this->mmodonline_wb_statistics->getToDayOnline();
        $data['online_yesterday'] = $this->mmodonline_wb_statistics->getYesterdayOnline();
        $data['online_this_month'] = $this->mmodonline_wb_statistics->getThisMonthOnline();
        $data['online_sum'] = $this->mmodonline_wb_statistics->getSumOnline();
        $this->load->view("modonline/modonline-detail", $data);
    }
}