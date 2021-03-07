<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modcontact extends MX_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper("form");
        $this->load->library(array("form_validation","email"));
    }
    public function index(){
        echo "Hello world!";
    }
    public function contactSendMail(){
        $this->load->model(array("modcontact/mmodcontact_site_contact_email","modcontact/mmodcontact_site_text"));
        $data['static_page'] = $this->mmodcontact_site_text->getDataByID(4);
        
        $this->form_validation->set_rules("name","Họ tên","required");
        $this->form_validation->set_rules("content","Nội dung","required|min_length[20]");
        
        if($this->form_validation->run() == FALSE){
            $data['successfully'] = "";
            $data['error'] = ""; 
            $this->load->view("modcontact/modcontact-contactSendMail",$data);
        }else{
            $data['email'] = $this->mmodcontact_site_contact_email->getDataByID(1);
            
            $email_content = $data['email']['Content'];
    		$marText1=array("{contact_name}","{contact_email}","{contact_phone}","{contact_address}","{contact_content}");
    		$marText2=array($this->input->post("name"),$this->input->post("email"),$this->input->post("phone"),$this->input->post("address"),str_replace("\r\n","<br/>",$this->input->post("content",TRUE)));
            $email_content = strtolower(str_replace($marText1, $marText2, $email_content));
            
            $this->email->clear();
            $this->email->from($this->input->post("email"), $this->input->post("name"));
            $this->email->to("{$data['email']['Email']}"); 
            $this->email->subject('Email liên hệ từ website nhabandian.com');
            $this->email->message("$email_content");
            $this->email->send();
            //echo $this->email->print_debugger();
            
            $data['successfully'] = "Email liên hệ đã được gửi. Cám ơn bạn đã đóng góp ý kiến cho website."; 
            $this->load->view("modcontact/modcontact-contactSendMail",$data);
        }
    }
        
}