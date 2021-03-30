<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Moduser extends MX_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function navbarRight(){
        $data = $this->my_auth->is_Member_Login();
        $this->load->view("moduser/moduser-navbarRight",$data);
    }
    public function modalLogin(){
        $data = $this->my_auth->is_Member_Login();
        if(!$data){
            $this->load->view("moduser/moduser-modalLogin",$data);
        }
    }
    public function register(){
        $this->load->model(array('moduser/mmoduser_wb_user'));
        $dataPost = $this->input->post();
        if(!$dataPost['email'] || !$dataPost['username'] || !$dataPost['phone'] || !$dataPost['password'] || !$dataPost['repassword']){
            $arr = array('status'=>-1,'message'=>'Vui lòng nhập đầy đủ thông tin!!!');
            echo json_encode($arr);exit;
        }
        if($dataPost['password'] != $dataPost['repassword']){
            $arr = array('status'=>-1,'message'=>'Mật khẩu không khớp!!!');
            echo json_encode($arr);exit;
        }
        
        $this->config->load("config");
        $encryption_key = $this->config->item("encryption_key");
        $pass = md5(md5($encryption_key).md5($dataPost['password']));
        
        $dataInsert = array(
            'Username' => $dataPost['email'],
            'Email' => $dataPost['email'],
            'Password' => $pass,
            'Type' => 11,
            'Name' => $dataPost['username'],
            'Phone' => $dataPost['phone'],
            'Dateset' => date("Y-m-d H:i:s"),
            'Active' => 0,
            'Status' => 0,
            'Key' => md5($encryption_key.time().$dataPost['email']),
        );
        $checkEmail = $this->mmoduser_wb_user->getDataByEmail($dataPost['email']);
        if($checkEmail){
            $arr = array('status'=>-1,'message'=>'Email đã tồn tại. Vui lòng chọn email khác!!!');
            echo json_encode($arr);exit;
        }
        $idInsert = $this->mmoduser_wb_user->addData($dataInsert);
        if($idInsert){
            try{
                $optionSendmail = array(
                    'Username' => $dataPost['email'],
                    'Name' => $dataPost['username'],
                    'Subject' => 'Đất Vàng Bình Dương - Kích hoạt tài khoản',
                    'Body' => '
                        Chào '.$dataInsert['Name'].',<br /><br />
                        Chúc mừng bạn đã đăng kí thành công tài khoản trên datvangbinhduong.vn! <br />
                        Dưới đây là thông tin đăng nhập của bạn: <br />
                        &nbsp;&nbsp;Email: '.$dataInsert['Username'].' <br />
                        &nbsp;&nbsp;Điện thoại: '.$dataInsert['Phone'].' <br /><br />
                        Vui lòng kích vào đường link dưới đây để kích hoạt tài khoản của bạn:<br />
                        <a href="'.base_url().'/kich-hoat-tai-khoan?sign='.$dataInsert['Key'].'">'.base_url().'/user/active/?sign='.$dataInsert['Key'].'</a><br /><br />
                        Nếu đường link trên không hoạt động, vui lòng copy đường link đó, rồi paste lên thanh địa chỉ của trình duyệt để link tới trang kích hoạt trên hệ thống.<br /> 
                        Cảm ơn bạn đã sử dụng webbsite của chúng tôi!<br />
                    '
                );
            	$resultSendmail = $this->sendmail($optionSendmail);
            }catch(exception $e){
            	//echo $e->getMessage();
            }
            if($resultSendmail){
                $arr = array('status'=>1,'message'=>'Đăng ký tài khoản thành công. Vui lòng kiểm tra email để kích hoạt tài khoản!');
            }else{
                $arr = array('status'=>1,'message'=>'Đăng ký tài khoản thành công. Email kích hoạt bị lỗi khi gửi đi. Vui lòng thông báo với admin website để được kích hoạt tài khoản!');
            }            
            
            echo json_encode($arr);exit;
        }else{
            $arr = array('status'=>-1,'message'=>'Có lỗi khi đăng ký tài khoản. Vui lòng thử lại sau hoặc thông báo cho quản lý website!!!');
            echo json_encode($arr);exit;
        }
    }
    public function sendmail($data){
        $this->config->load("email");
        
        require_once(APPPATH.'libraries/phpmailer/PHPMailerAutoload.php');
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;
        //Ask for HTML-friendly debug output
        $mail->CharSet = 'utf-8';
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = $this->config->item('smtp_host');
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = $this->config->item('smtp_port');
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication
        $mail->Username = $this->config->item('smtp_user');
        //Password to use for SMTP authentication
        $mail->Password = $this->config->item('smtp_pass');
        //Set who the message is to be sent from
        $mail->setFrom($this->config->item('smtp_user'), $this->config->item('smtp_user'));
        //Set an alternative reply-to address
        $mail->addReplyTo($this->config->item('smtp_user'), $this->config->item('smtp_user'));
        //Set who the message is to be sent to
        $mail->addAddress($data['Username'], $data['Name']);
        //Set the subject line
        $mail->Subject = $data['Subject'];
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($data['Body']);
        //Replace the plain text body with one created manually
        //$mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');
        //echo '<pre>',print_r($mail),'</pre>';exit;
        //send the message, check for errors
        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
    public function active(){
        $this->load->model(array('moduser/mmoduser_wb_user'));
        $dataGet = $this->input->get();
        $data = array();
        if(!$dataGet['sign']){
            $data['message']='Kích hoạt tài khoản thất bại -1!!!';
        }
        $checkActivekey = $this->mmoduser_wb_user->getDataByKey($dataGet['sign']);
        
        if($checkActivekey && $checkActivekey['Active'] == 1){
            $data['message']='Tài khoản của bạn đã được kích hoạt sẵn!!!';
        }
        if($checkActivekey && $checkActivekey['Active'] != 1){
            $dataUpdate = array(
                'Active' => 1,
                'Status' => 1,
                'Key' => ''
            );
            $this->mmoduser_wb_user->updateData($dataUpdate, $checkActivekey['ID']);
            $data['message']='Kích hoạt tài khoản thành công!!!';
            $data['success'] = 'true';
            
            //login
            $dataUser = array("USERID" => $checkActivekey['ID'], "EMAIL" => $checkActivekey['Email'], "USERNAME" => $checkActivekey['Name']);
            $this->my_auth->set_userdata($dataUser);
        }
        if(!$checkActivekey){
            $data['message']='Kích hoạt tài khoản thất bại -2!!!';
        }
        $this->load->view('moduser/moduser-active', $data);
        
    }
    public function login(){
        $this->load->model(array('moduser/mmoduser_wb_user'));
        $dataPost = $this->input->post();
        
        $this->config->load("config");
        $encryption_key = $this->config->item("encryption_key");
        $pass = md5(md5($encryption_key).md5($dataPost['password']));
        
        $checkUser = $this->mmoduser_wb_user->checkLogin($dataPost['email'], $pass);
        if(!$checkUser){
            $arr = array('status'=>-1,'message'=>'Đăng nhập thất bại!!!');
            echo json_encode($arr);exit;
        }
        if(!$checkUser['Active']){
            $arr = array('status'=>-1,'message'=>'Bạn chưa kích hoạt tài khoản!!!');
            echo json_encode($arr);exit;
        }
        if(!$checkUser['Status']){
            $arr = array('status'=>-1,'message'=>'Tài khoản đang tạm khóa!!!');
            echo json_encode($arr);exit;
        }
        
        $data = array("USERID" => $checkUser['ID'], "EMAIL" => $checkUser['Email'], "USERNAME" => $checkUser['Name']);
        $this->my_auth->set_userdata($data);
        
        $arr = array('status'=>1,'message'=>'Đăng nhập thành công. Vui lòng chờ trong giây lát!');
        echo json_encode($arr);exit;
    }
    public function logout(){
        $this->my_auth->sess_destroy();
		redirect(base_url());
    }
    public function reset(){
        $data = $this->input->post();
        $arr = array('status'=>1,'message'=>'thành công');
        echo json_encode($arr);
    }
    public function real(){
        $data = $this->my_auth->is_Member_Login();
        if(!isset($data['userid'])){
            exit;
        }
        $this->load->models(array('modreal/mmodreal_site_real'));
        $this->load->library("pagination");
        $config['base_url'] = base_url('user/real');
        $config['total_rows'] = $this->mmodreal_site_real->countUserData($data['userid']);
        $config['per_page'] = 10; 
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['real_list'] = $this->mmodreal_site_real->getUserData($data['userid'], $config['per_page'], $this->uri->segment(3));
        
        $this->load->view("moduser/moduser-real",$data);
    }
    public function delete($id){
        $data = $this->my_auth->is_Member_Login();
        if(!isset($data['userid'])){
            exit;
        }
        $this->load->models(array('modreal/mmodreal_site_real'));
        $realCheck = $this->mmodreal_site_real->getDataByID($id);
        if($data['userid'] == $realCheck['UserId']){
            $this->mmodreal_site_real->deleteData($id);
            redirect(base_url('user/real'));
        }
    }
    public function info(){
        $this->load->helper(array('form'));
        $this->load->library(array("form_validation"));
        $data = $this->my_auth->is_Member_Login();
        if(!isset($data['userid'])){
            exit;
        }
        $this->load->models(array('moduser/mmoduser_wb_user'));
        $data['userCheck'] = $this->mmoduser_wb_user->getDataByID($data['userid']);
        if(!$data['userCheck']){
            exit;
        }
        
        $this->form_validation->set_rules("username","Họ tên","required");
        $this->form_validation->set_rules("phone","Số điện thoại","required|min_length[10]");
        
        if($this->form_validation->run() == FALSE){
            $data['successfully'] = "";
            $data['error'] = ""; 
            $this->load->view('moduser/moduser-info', $data);
        }else{
            $dataPost = $this->input->post();
            $dataUpdate = array(
                'Name' => $dataPost['username'],
                'Phone' => $dataPost['phone'],
                'Yahoo' => $dataPost['yahoo'],
                'Skype' => $dataPost['skype'],
                'Facebook' => $dataPost['facebook'],
            );
            $this->mmoduser_wb_user->updateData($dataUpdate, $data['userid']);
            $data['userCheck']['Name'] = $dataPost['username'];
            $data['userCheck']['Phone'] = $dataPost['phone'];
            $data['userCheck']['Yahoo'] = $dataPost['yahoo'];
            $data['userCheck']['Skype'] = $dataPost['skype'];
            $data['userCheck']['Facebook'] = $dataPost['facebook'];
            
            $data['successfully'] = "Đã thay đổi thông tin cá nhân của bạn";
            $data['error'] = ""; 
            
            $this->load->view('moduser/moduser-info', $data);
        }
    }
    public function changepass(){
        $this->load->helper(array('form'));
        $this->load->library(array("form_validation"));
        $data = $this->my_auth->is_Member_Login();
        if(!isset($data['userid'])){
            exit;
        }
        $this->load->models(array('moduser/mmoduser_wb_user'));
        $data['userCheck'] = $this->mmoduser_wb_user->getDataByID($data['userid']);
        if(!$data['userCheck']){
            exit;
        }
        
        $this->form_validation->set_rules("password","Mật khẩu","required");
        $this->form_validation->set_rules("newpassword","Mật khẩu mới","required|min_length[6]");
        $this->form_validation->set_rules("newpassword2","Xác nhận mật khẩu mới","required|min_length[6]");
        
        if($this->form_validation->run() == FALSE){
            $data['successfully'] = "";
            $data['error'] = ""; 
            $this->load->view('moduser/moduser-changepass', $data);
        }else{
            $dataPost = $this->input->post();
            
            $this->config->load("config");
            $encryption_key = $this->config->item("encryption_key");
            $pass = md5(md5($encryption_key).md5($dataPost['password']));
            if($pass != $data['userCheck']['Password']){
                $data['error'] = "Mật khẩu cũ không đúng"; 
                $this->load->view('moduser/moduser-changepass', $data);
                exit;
            }
            if($dataPost['newpassword'] != $dataPost['newpassword2']){
                $data['error'] = "Mật khẩu mới không trùng khớp"; 
                $this->load->view('moduser/moduser-changepass', $data);
                exit;
            }
            $dataUpdate = array(
                'Password' => md5(md5($encryption_key).md5($dataPost['newpassword'])),
            );
            $this->mmoduser_wb_user->updateData($dataUpdate, $data['userid']);
            
            $data['successfully'] = "Đã thay đổi mật khẩu cá nhân của bạn";
            $data['error'] = ""; 
            
            $this->load->view('moduser/moduser-changepass', $data);
        }
    }
    public function add(){
        $this->load->helper(array('form'));
        $this->load->library(array("form_validation"));
        $this->load->models(array('moduser/mmoduser_wb_user','modreal/mmodreal_site_real','msite_add_province','msite_add_district','msite_add_ward'));
        
        $data = $this->my_auth->is_Member_Login();
        if(isset($data['userid'])){
            $data['userCheck'] = $this->mmoduser_wb_user->getDataByID($data['userid']);
            if(!$data['userCheck']){
                exit;
            }
        }else{
            $data['userid'] = 0;
            $data['username'] = "Khách vãng lai";
        }
        
        $data['menu_list'] = $this->_getOptionMenuReal(0);
        $data['province_list'] = $this->msite_add_province->getAllData("ASC",99,0);
        $data['district_list'] = $this->msite_add_district->getProvinceData(8,"ASC",99,0);
        $data['ward_list'] = $this->msite_add_ward->getAllData("ASC",99,0);
        
        $this->form_validation->set_rules("typeR","Loại tin","required|integer");
        $this->form_validation->set_rules("menuR","Danh mục","required|integer");
        $this->form_validation->set_rules("nameR","Tiêu đề","required|max_length[90]");
        $this->form_validation->set_rules("landareaR","Diện tích","required|integer");
        $this->form_validation->set_rules("costR","Giá tiền","required|integer");
        $this->form_validation->set_rules("unitR","Đơn vị","required");
        $this->form_validation->set_rules("contentR","Nội dung","required");
        $this->form_validation->set_rules("captchaR","Mã bảo vệ","required");
        
        if($this->form_validation->run() == FALSE){
            $this->load->helper('captcha');
            $this->load->library('session');
            $vals = array(
                'img_path'	=> 'public/captcha/',
                'img_url'	=> base_url().'public/captcha/',
                'img_width'	=> '100',
                'img_height' => 30,
                'expiration' => 7200
                );
            
            $captcha = create_captcha($vals);
            $this->session->set_userdata('captchaAddReal', $captcha['word']);
            
            $data['captcha'] = $captcha;
            
            $data['successfully'] = "";
            $data['error'] = ""; 
            $this->load->view('moduser/moduser-add', $data);
        }else{
            $dataPost = $this->input->post();
            
            $captcha = $this->session->userdata('captchaAddReal');
            if(!isset($captcha) || $dataPost['captchaR'] != $captcha){
                $data['successfully'] = "";
                $data['error'] = "Captcha không hợp lệ"; 
                
                $this->load->helper('captcha');
                $this->load->library('session');
                $vals = array(
                    'img_path'	=> 'public/captcha/',
                    'img_url'	=> base_url().'public/captcha/',
                    'img_width'	=> '100',
                    'img_height' => 30,
                    'expiration' => 7200
                    );
                
                $captcha = create_captcha($vals);
                $this->session->set_userdata('captchaAddReal', $captcha['word']);
                
                $data['captcha'] = $captcha;
                
                $this->load->view('moduser/moduser-add', $data);
                return;
            }
            
            $this->load->library(array("upload"));
            $img = '';
            $thumb = '';
            $this->load->library('my_upload_file');
            if(isset($_FILES['img1']['type']) && $_FILES['img1']['type']){
                $_FILES['txtFile'] = $_FILES['img1'];
                $returnImg = $this->upload->do_upload_3(0);
                $img = base_url().$this->my_upload_file->watermark($returnImg);
                
                $thumb = base_url().$this->my_upload_file->resize($returnImg);
            }
            
            $dataInsert = array(
                'Type' => $dataPost['typeR'],
                'Menu' => $dataPost['menuR'],
                'Name' => $dataPost['nameR'],
                'Img' => $img,
                'Thumb1' => $thumb,
                'LandArea' => $dataPost['landareaR'],
                'Direction' => $dataPost['directionR'],
                'Cost' => $dataPost['costR'],
                'Total' => ($dataPost['unitR'] == 'm2') ? $dataPost['costR'] * $dataPost['landareaR'] : $dataPost['costR'],
                'Unit' => $dataPost['unitR'],
                'SittingRoom' => $dataPost['sittingroomR'],
                'BedRoom' => $dataPost['bedroomR'],
                'Legal' => $dataPost['legalR'],
                'Province' => 8,
                'District' => $dataPost['districtR'],
                'Ward' => $dataPost['wardR'],
                'Address' => $dataPost['addressR'],
                'Lat' => $dataPost['latR'],
                'Lng' => $dataPost['lngR'],
                'Content' => $dataPost['contentR'],
                'User' => $data['userid'],
                'Dateset' => date("Y-m-d"),
                'DateUp' => date("Y-m-d H:i:s"),
                'Status' => 0
            );
            $this->mmodreal_site_real->addData($dataInsert);
            
            $this->session->unset_userdata('captchaAddReal');
            
            $data['successfully'] = "Tin rao của bạn đã được đăng. Chúng tôi sẽ cho hiển thị lên trang chủ sau khi kiểm duyệt nội dung. <br />Cám ơn bạn đã sử dụng website!!";
            $data['error'] = ""; 
            
            $this->load->view('moduser/moduser-add', $data);
        }
    }
    public function edit($id){
        $this->load->helper(array('form'));
        $this->load->library(array("form_validation"));
        $data = $this->my_auth->is_Member_Login();
        if(!isset($data['userid'])){
            exit;
        }
        $this->load->models(array('moduser/mmoduser_wb_user','modreal/mmodreal_site_real','msite_add_province','msite_add_district','msite_add_ward'));
        $data['userCheck'] = $this->mmoduser_wb_user->getDataByID($data['userid']);
        if(!$data['userCheck']){
            exit;
        }
        $data['real_check'] = $this->mmodreal_site_real->getDataByID($id);
        if(!$data['real_check']){
            exit();
        }
        
        $data['menu_list'] = $this->_getOptionMenuReal(0,'',$data['real_check']['Menu']);
        $data['province_list'] = $this->msite_add_province->getAllData("ASC",99,0);
        $data['district_list'] = $this->msite_add_district->getProvinceData(8,"ASC",99,0);
        $data['ward_list'] = $this->msite_add_ward->getAllData("ASC",99,0);
        
        $this->form_validation->set_rules("typeR","Loại tin","required|integer");
        $this->form_validation->set_rules("menuR","Danh mục","required|integer");
        $this->form_validation->set_rules("nameR","Tiêu đề","required|max_length[90]");
        $this->form_validation->set_rules("landareaR","Diện tích","required|integer");
        $this->form_validation->set_rules("costR","Giá tiền","required|integer");
        $this->form_validation->set_rules("unitR","Đơn vị","required");
        $this->form_validation->set_rules("contentR","Nội dung","required");
        $this->form_validation->set_rules("captchaR","Mã bảo vệ","required");
        
        if($this->form_validation->run() == FALSE){
            $this->load->helper('captcha');
            $this->load->library('session');
            $vals = array(
                'img_path'	=> 'public/captcha/',
                'img_url'	=> base_url().'public/captcha/',
                'img_width'	=> '100',
                'img_height' => 30,
                'expiration' => 7200
                );
            
            $captcha = create_captcha($vals);
            $this->session->set_userdata('captchaAddReal', $captcha['word']);
            
            $data['captcha'] = $captcha;
            
            $data['successfully'] = "";
            $data['error'] = ""; 
            $this->load->view('moduser/moduser-add', $data);
        }else{
            $dataPost = $this->input->post();
            
            $captcha = $this->session->userdata('captchaAddReal');
            if(!isset($captcha) || $dataPost['captchaR'] != $captcha){
                $data['successfully'] = "";
                $data['error'] = "Captcha không hợp lệ"; 
                
                $this->load->helper('captcha');
                $this->load->library('session');
                $vals = array(
                    'img_path'	=> 'public/captcha/',
                    'img_url'	=> base_url().'public/captcha/',
                    'img_width'	=> '100',
                    'img_height' => 30,
                    'expiration' => 7200
                    );
                
                $captcha = create_captcha($vals);
                $this->session->set_userdata('captchaAddReal', $captcha['word']);
                
                $data['captcha'] = $captcha;
                
                $this->load->view('moduser/moduser-add', $data);
                return;
            }
            
            
            $this->load->library(array("upload"));
            $img = $data['real_check']['Img'];
            $thumb = $data['real_check']['Thumb1'];
            $this->load->library('my_upload_file');
            if(isset($_FILES['img1']['type']) && $_FILES['img1']['type']){
                $_FILES['txtFile'] = $_FILES['img1'];
                $returnImg = $this->upload->do_upload_3(0);
                $img = base_url().$this->my_upload_file->watermark($returnImg);
                
                $thumb = base_url().$this->my_upload_file->resize($returnImg);
                
                unlink(str_replace(base_url(),'',$data['real_check']['Img']));
                unlink(str_replace(base_url(),'',$data['real_check']['Thumb1']));
            }
            
            $dataInsert = array(
                'Type' => $dataPost['typeR'],
                'Menu' => $dataPost['menuR'],
                'Name' => $dataPost['nameR'],
                'Img' => $img,
                'Thumb1' => $thumb,
                'LandArea' => $dataPost['landareaR'],
                'Direction' => $dataPost['directionR'],
                'Cost' => $dataPost['costR'],
                'Total' => ($dataPost['unitR'] == 'm2') ? $dataPost['costR'] * $dataPost['landareaR'] : $dataPost['costR'],
                'Unit' => $dataPost['unitR'],
                'SittingRoom' => $dataPost['sittingroomR'],
                'BedRoom' => $dataPost['bedroomR'],
                'Legal' => $dataPost['legalR'],
                'Province' => 8,
                'District' => $dataPost['districtR'],
                'Ward' => $dataPost['wardR'],
                'Address' => $dataPost['addressR'],
                'Lat' => $dataPost['latR'],
                'Lng' => $dataPost['lngR'],
                'Content' => str_replace("\r\n","<br/>", strip_tags($dataPost['contentR'])),
                'User' => $data['userid'],
                'Dateset' => date("Y-m-d"),
                'DateUp' => date("Y-m-d H:i:s"),
                'Status' => 0
            );
            $this->mmodreal_site_real->updateData($dataInsert, $id);
            
            $data['successfully'] = "Tin rao của bạn đã được cập nhật. Chúng tôi sẽ cho hiển thị lên trang chủ sau khi duyệt lại nội dung. <br />Cám ơn bạn đã sử dụng website!!";
            $data['error'] = ""; 
            
            $data['real_check'] = $this->mmodreal_site_real->getDataByID($id);
            $this->load->view('moduser/moduser-add', $data);
            redirect(base_url('user/real'));
        }
    }
    function _getOptionMenuReal($pid, $prefix="", $active=""){
        $this->load->models(array('msite_real_menu'));
        $menu_list = $this->msite_real_menu->getPidStatusData($pid, 1, "ASC", 99, 0);
		$slt = "";
        foreach($menu_list as $row){
            if($active == $row['ID']){
                $slt .= "<option value=\"".$row['ID']."\" selected=\"selected\">".$prefix." ".$row['Name'];
            }else{
                $slt .= "<option value=\"".$row['ID']."\">".$prefix." ".$row['Name'];
            }
			$slt .= $this->_getOptionMenuReal($row['ID'], $prefix.$prefix.$prefix.$prefix, $active);
        }
		return $slt;
    }
}