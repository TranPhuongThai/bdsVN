<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/admin/application.php');

class Site_product_order extends Application{
    public function __construct(){
        parent::__construct();
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."admin/wb_verify/login");
            exit();
        }elseif(!$this->my_auth->is_Access($this->router->fetch_class())){
            redirect(base_url()."admin/manage");
            exit();
        }
        $this->load->model(array("msite_product_order","msite_product_order_list"));
    }
    public function index(){
        $data['breadcrumbs'][0]["Url"] = "admin/manage";
        $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
        $data['breadcrumbs'][1]["Url"] = "admin/site_product_order";
        $data['breadcrumbs'][1]["Name"] = lang('backend.order');
        
        $config['base_url'] = base_url("admin/site_product_order/index");
        $config['total_rows'] = $this->msite_product_order->countAllData();
        $config['per_page'] = 10; 
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        
        $data['order_list'] = $this->msite_product_order->getAllData("DESC", $config['per_page'], $this->uri->segment(4));
        $this->my_layout->view("backend/site_product_order-index",$data);
    }
    public function edit($id){
        if(is_numeric($id)){
            $data['order_check'] = $this->msite_product_order->getDataByID($id);
            if($data['order_check']){
                $data['breadcrumbs'][0]["Url"] = "admin/manage";
                $data['breadcrumbs'][0]["Name"] = lang('backend.homepage');
                $data['breadcrumbs'][1]["Url"] = "admin/site_product_order";
                $data['breadcrumbs'][1]["Name"] = lang('backend.order');
                $data['breadcrumbs'][2]["Url"] = "admin/site_product_order/edit/".$data['order_check']['ID'];
                $data['breadcrumbs'][2]["Name"] = $data['order_check']['Name'];
        
                $data['order_product_list'] = $this->msite_product_order_list->getOrderData($id, 9999, 0);
                
                $data['order_list'] = $this->msite_product_order->getAllData("DESC", 10, 0);
                
                $this->form_validation->set_rules("name",lang('backend.name'),"required");           
                if($this->form_validation->run() == FALSE){
                    $data['error'] = "";
                    $this->my_layout->view("backend/site_product_order-edit",$data);
                }else{
                    $update = array(
                        "Name"          => $this->input->post("name"),
                        "Phone"         => $this->input->post("phone"),
                        "Email"         => $this->input->post("email"),
                        "Address"       => $this->input->post("address"),
                        "Content"       => $this->input->post("content"),
                        "Status"        => $this->input->post("status"),
                     );
                    $this->msite_product_order->updateData($update, $id);
                    redirect(base_url()."admin/site_product_order");
                    exit();
                }
            }else{
                redirect(base_url()."admin/site_product_order");
                exit();
            }
        }else{
            redirect(base_url()."admin/site_product_order");
            exit();
        }
    }
    public function exportToExcel($id){
        $data['order_check'] = $this->msite_product_order->getDataByID($id);
        if($data['order_check']){
            $data['order_product_list'] = $this->msite_product_order_list->getOrderData($id, 9999, 0);
            if($data['order_product_list']){
                $this->load->model(array('msite_config'));
                $data['config'] = $this->msite_config->getDataById(6);
                if(!$data['config']){
                    $data['config']['Content'] = '';
                }
                require_once APPPATH.'libraries/Spreadsheet/Excel/Writer.php';
                $workbook = new Spreadsheet_Excel_Writer();
                
                $workbook->send("Order-".$data['order_check']['Name'].date("-d-m-Y").'.xls');
                $workbook->setVersion(8, 'utf-8'); 
                $worksheet =& $workbook->addWorksheet('Order product');
                $worksheet ->setInputEncoding('UTF-8');
                $worksheet->setColumn(1,1,50);
                $worksheet->setColumn(2,2,25);
                
                $format_header =& $workbook->addFormat(); 
        		$format_header->setBold(); 
        		$format_header->setItalic(); 
        		$format_header->setHAlign('center');
                $format_header->setTextWrap();
                
                $format_title =& $workbook->addFormat(); 
        		$format_title->setBold(); 
        		$format_title->setColor('64'); 
        		$format_title->setHAlign('center');
        		$format_title->setSize('10');
                $format_title->setFgColor('grey');
                $format_title->setTextWrap(); 
                
                $format_title_2 =& $workbook->addFormat(); 
        		$format_title_2->setItalic(); 
        		$format_title_2->setHAlign('right');
                $format_title_2->setTextWrap();
                
                $format_contact =& $workbook->addFormat(); 
        		$format_contact->setItalic(); 
                $format_contact->setTextWrap();
    		
        		$format_number = &$workbook->addFormat();
        		$format_number->setHAlign('right');
        		$format_number->setNumFormat('#,###');
                $format_number->setTextWrap();
                
                $worksheet->write(0, 0, $data['config']['Content'], $format_header);
                $worksheet->setMerge(0,0,0,5);
                $worksheet->write(2, 0, lang('backend.name').': '.$data['order_check']['Name'], $format_contact);
                $worksheet->setMerge(2,0,2,5);
                $worksheet->write(3, 0, lang('backend.phone').': '.$data['order_check']['Phone'], $format_contact); 
                $worksheet->setMerge(3,0,3,5); 
                $worksheet->write(4, 0, lang('backend.email').': '.$data['order_check']['Email'], $format_contact);
                $worksheet->setMerge(4,0,4,5);
                $worksheet->write(5, 0, lang('backend.address').': '.$data['order_check']['Address'], $format_contact); 
                $worksheet->setMerge(5,0,5,5); 
                $worksheet->write(6, 0, lang('backend.content').': '.$data['order_check']['Content'], $format_contact); 
                $worksheet->setMerge(6,0,6,5);
                $worksheet->write(8, 5, 'VNĐ', $format_title_2);               
                                
                $worksheet->write(9,0,lang('backend.id'), $format_title);
                $worksheet->write(9,1,lang('backend.name'), $format_title);
                $worksheet->write(9,2,lang('backend.product_code'), $format_title);
                $worksheet->write(9,3,lang('backend.cost'), $format_title);
                $worksheet->write(9,4,lang('backend.amount'), $format_title);
                $worksheet->write(9,5,lang('backend.sum'), $format_title);
                
                $i = 10;
                $total = 0;
                $amount = 0;
                foreach($data['order_product_list'] as $row){
                    $sum = $row['Cost']* $row['Amount'];
                    $total += $sum;
                    $amount += $row['Amount'];
                    
                    $worksheet->writeNumber($i,0,$row['ID']);
                    $worksheet->writeString($i,1,$row['PName']);
                    $worksheet->writeNumber($i,2,$row['Code']);
                    $worksheet->writeNumber($i,3,$row['Cost'],$format_number);
                    $worksheet->writeNumber($i,4,$row['Amount'],$format_number);
                    $worksheet->writeNumber($i,5,$sum,$format_number);
                    ++$i;
                }
                $worksheet->writeString($i,0,lang('backend.total'));
                $worksheet->setMerge($i, 0, $i, 3);
                $worksheet->writeNumber($i,4,$amount,$format_number);
                $worksheet->writeNumber($i,5,$total,$format_number);
                
                // Let's send the file
                $workbook->close();
            }   
        }
    }
    public function delete($id){
        if(is_numeric($id)){
            $data['order_check'] = $this->msite_product_order->getDataByID($id);
            if($data['order_check']){
                $this->msite_product_order->deleteData($id);
            }
        } 
        redirect(base_url()."admin/site_product_order");
        exit();
    }
        
}