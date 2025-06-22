<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Api extends CI_Controller {    

    public function __construct() {
    header('Content-Type: application/json; charset=utf-8');
    header('Content-Type: multipart/form-data; charset=utf-8');
    header('Accept: multipart/form-data; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
       parent::__construct();   
       
    }
	public function login() {
        $return = array("status" => 0, "data" => "Invalid Username or Password.");
        $data = json_decode(file_get_contents('php://input'));
        
        $email=$data->email;
        $user = $this->db->query("SELECT * FROM users WHERE email = '$email' AND status='2'")->row();

        if($user) {
            if($user->role=='customer'){
                    $is_valid = password_verify($data->password, $user->password);
                    if($is_valid) {
                        $return = array("status" => 1, "data" => $user);
                    }
            }
            else{
                $return = array("status" => 0, "message" => "You can't login !");
            }
        }        
        echo json_encode($return);
    }
    
    public function getfuel(){
        $fuel = $this->Main_model->getfueltype();
        echo json_encode($fuel);
    }
    public function getvehicles(){
        $cars = $this->Main_model->getvehicles();
        echo json_encode($cars);
    }    
    public function getvehiclesdetail($vid)
    {
        $json = file_get_contents('php://input');
        $vehi = json_decode($json);

        $data = array();
        $cars = $this->Main_model->getvehiclesdetail($vid);
        // $data['color'] = $this->Main_model->getvehiclescolor($vid);
        echo json_encode($cars);
    }
    public function getvehiclescolor($vid)
    {
        $json = file_get_contents('php://input');
        $vehi = json_decode($json);

        $data = array();
        
        $data = $this->Main_model->getvehiclescolor($vid);
        echo json_encode($data);
    }
    public function getvehiclesfeatures($vid)
    {
        $json = file_get_contents('php://input');
        $vehi = json_decode($json);

        $data = array();        
        $data = $this->Main_model->getvehiclesfeatures($vid);
        echo json_encode($data);
    }
    public function getvehiclespkg($vid)
    {
        $json = file_get_contents('php://input');
        $vehi = json_decode($json);

        $data = array();
        
        $data = $this->Main_model->getvehiclespkg($vid);
        echo json_encode($data);
    }
    
    public function getvehiclesphotos($vid)
    {
        $json = file_get_contents('php://input');
        $vehi = json_decode($json);

        $data = array();
        
        $data = $this->Main_model->getvehiclesphotos($vid);
        echo json_encode($data);
    }
    public function getvehiclescatetgory($categoryid)
    {
        $json = file_get_contents('php://input');
        $vehi = json_decode($json);

        $cars = $this->Main_model->getcategorytitle($categoryid);
        echo json_encode($cars);
    }
    public function gethowitworks(){
        $data = $this->Main_model->gethowitworks();
        echo json_encode($data);
    }
    public function getpromotionmsg(){
        $data = $this->Main_model->getpromotionmsg();
        echo json_encode($data);
    }
    public function getbrands(){
        $brands = $this->Main_model->getbrands();
        echo json_encode($brands);
    }
    public function getbodytype(){
        $body = $this->Main_model->getbodytype();
        echo json_encode($body);
    }

    public function getfaq(){
        $faq = $this->Main_model->getfaq();
        echo json_encode($faq);
    }
    public function getfeature(){
        $feature = $this->Main_model->getfeatures();
        echo json_encode($feature);
    }
    public function getservice(){
        $service = $this->Main_model->getservices();
        echo json_encode($service);
    }
    public function getbusiness(){
        $business = $this->Main_model->getbusiness();
        echo json_encode($business);
    }
    public function getduration()
    {
        $business = $this->Main_model->getduration();
        echo json_encode($business);
    }


    /*insert*/
    public function addusers() {       

        $return = array("status" => 0, "data" => "Invalid Username or Password.");
        $_data = json_decode(file_get_contents('php://input')); 

        $data = array(
            "first_name" => $_data->first_name,
            "last_name" => $_data->last_name,
            "email" => $_data->email,
            "phone" => $_data->phNumber,
            "role"=>"customer",
            "password" => password_hash($_data->password, PASSWORD_DEFAULT),
            "created_date"=>date('Y-m-d H:i:s')
        );
          $this->db->select('*');
          $this->db->from('users');
          $this->db->where(array('email'=>$_data->email,'role'=>'customer'));
          $query=$this->db->get();

          if($query->num_rows()==1)
          {
                $return = array("status" => 0, "message" => "Already registered and use other email address !");
                echo json_encode($return);
          }else{  
                $this->db->insert("users", $data); 
                $data["userdata"]=$this->db->query("SELECT * FROM users WHERE email = ? LIMIT 1", array($_data->email))->row();
                $userid=$data["userdata"]->id;
                $useremail=$data["userdata"]->email;
                $data["token"] = md5($userid.$useremail);  
                    
                $config = Array(       
                        'protocol' => 'smtp',
                        'smtp_host' => 'ssl://smtp.googlemail.com',
                        'smtp_port' => 465,
                        'smtp_user' => 'sfleasing22@gmail.com',
                        'smtp_pass' => 'jopsadfzftgrpaui',
                        'smtp_timeout' => '4',
                        'mailtype'  => 'html',
                        'charset'   => 'iso-8859-1',
                        'wordwrap' => TRUE
                    );
                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");  
                    $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
                    $this->email->set_header('Content-type', 'text/html');          
                    $this->email->initialize($config);
                $this->email->from('sfleasing22@gmail.com','Sfleasing');
                $this->email->to($useremail);
                
                $this->email->subject("Gmail Confirmation - Send Mail as ".$useremail);
                $body = $this->load->view('verifyemail.php',$data,TRUE);
                $this->email->message($body); 
                if ($this->email->send()) {
                        $return = array("status" => 1, "data" => $data,"message"=>"Please check your mail and verify your account !");    
                   
                    } else {
                        show_error($this->email->print_debugger());
                    }    
                echo json_encode($return);
                        
          }    
        
    }
    public function addbusiness_users(){
        $post = $this->input->post(); 
        if($post) {
            $firstname=$this->input->post("firstName");
            $lastname=$this->input->post("lastName");
            $email=$this->input->post("email");
            $cmyname=$this->input->post("companyName");
            $phone=$this->input->post("phonenumber");
            $interestoption=$this->input->post("interest_option");
            $qtyofcars=$this->input->post("qtyofcars");
            $registerno=$this->input->post("registerno");
            $officeno=$this->input->post("officeno");
            $message=$this->input->post("message");


            if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0)
              { 
                      $dealerfile="";
                      $filesCount = count($_FILES['files']['name']); 
                      for($i = 0; $i < $filesCount; $i++){ 
                          $_FILES['file']['name']     = $_FILES['files']['name'][$i]; 
                          $_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
                          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
                          $_FILES['file']['error']     = $_FILES['files']['error'][$i]; 
                          $_FILES['file']['size']     = $_FILES['files']['size'][$i]; 
                        
                          $uploadPath = 'upload/usersinfo/'; 
                          $config['upload_path'] = $uploadPath; 
                          $config['allowed_types'] = 'pdf|docx|xlsx|csv|xls|ods'; 
                         
                          $this->load->library('upload', $config); 
                          $this->upload->initialize($config);  
                          
                          if($this->upload->do_upload('file')){                               
                              $fileData = $this->upload->data(); 
                              $uploadData[$i] = $fileData['file_name'];  
                              $dealerfile .=$uploadData[$i].',';                              
                          }
                          
                      }             
                }
            $data = array(
                "first_name" => $firstname,
                "last_name" => $lastname,
                "email" => $email,
                "cmy_name" => $cmyname,
                "phone" => $phone,
                "interesting_option" => $interestoption,
                "qty_of_cars" => $qtyofcars,
                "business_register_no" => $registerno,
                "office_no" => $officeno,
                "file"=>$dealerfile,
                "message" => $message,
                "role" => "dealer",
                "created_date"=>date('Y-m-d H:i:s')
            );
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where(array('email'=>$email,"role"=>"dealer"));
            $query=$this->db->get();

              if($query->num_rows()==1)
              {
                    $return = array("status" => 0, "message" => "Already messaged and use other email address !");
                    echo json_encode($return);
              }else{
                    $this->db->insert("users", $data); 
                    $id=$this->db->insert_id();
                    $businessuser = $this->db->query("SELECT * FROM users WHERE id = ? LIMIT 1", array($id))->row();                    

                    $data["userdata"]=$this->db->query("SELECT * FROM users WHERE id = ? LIMIT 1", array($id))->row();
                    $userid=$data["userdata"]->id;
                    $useremail=$data["userdata"]->email;
                    $data["token"] = md5($userid.$useremail); 
                    $config = Array(       
                            'protocol' => 'smtp',
                            'smtp_host' => 'ssl://smtp.googlemail.com',
                            'smtp_port' => 465,
                            'smtp_user' => 'sfleasing22@gmail.com',
                            'smtp_pass' => 'jopsadfzftgrpaui',
                            'smtp_timeout' => '4',
                            'mailtype'  => 'html',
                            'charset'   => 'iso-8859-1',
                            'wordwrap' => TRUE
                        );
                        $this->load->library('email', $config);
                        $this->email->set_newline("\r\n");  
                        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
                        $this->email->set_header('Content-type', 'text/html');          
                        $this->email->initialize($config);
                    $this->email->from('sfleasing22@gmail.com','Sfleasing');
                    $this->email->to($useremail);
                    
                    $this->email->subject("Gmail Confirmation - Send Mail as ".$useremail);
                    $body = $this->load->view('verifyemail.php',$data,TRUE);
                    $this->email->message($body); 
                    if ($this->email->send()) {
                            $return = array("status" => 1, "data" => $businessuser,"message"=>"Please check your email !");    
                       
                        } else {
                            show_error($this->email->print_debugger());
                        }    
                    echo json_encode($return);
                       
                }
        }
    }
   
    public function verifyemail() {       

        $return = array("status" => 0, "data" => "Invalid Email Address");
        $_data = json_decode(file_get_contents('php://input')); 

        $uid= $_data->id;
        $email= $_data->email;
        $userdata = $this->db->query("SELECT * FROM users WHERE id = ? LIMIT 1", array($uid))->row();
        $id=md5($userdata->id.$email);


        if($_data->token==$id){
            if($userdata->role=='customer'){
                $data = array(
                    "status" => "2",
                );
                $return = array("status" => 1, "data" => $userdata,"message"=>"Successful !");  
            }
            else if($userdata->role=='dealer'){
                $data = array(
                    "status" => "1",
                );
                $return = array("status" => 1, "data" => $userdata,"message"=>"Successful ! We will approve you soon.");  
            }
            $this->db->where('id',$uid);
            $this->db->update("users",$data);

        }else{
            $return = array("status" => 0,"message"=>"Your token or email is wrong !");
        }        
        echo json_encode($return); 
    }
    
    
    public function adduserbookings() {       

        $return = array("status" => 0, "data" => "Invalid Booking ID");
        $_data = json_decode(file_get_contents('php://input')); 

        $userid=$_data->user_id;
        $cid=$_data->vehicle_id;
        $bookdate=$_data->delivery_date;
        $pricestatus=$_data->price_status;

        if($pricestatus=="selling"){
            $price=$_data->selling_price;
            $total=$_data->selling_price;
            $avilabledate="";
            $startdate="";
            $enddate="";
        }        
        if(!empty($_data->start_date) && !empty($_data->end_date) && $pricestatus=="leasing"){
            $startdate=$_data->start_date;
            $enddate=$_data->end_date;
            $price=$_data->price;

            $date1 = new DateTime($startdate);
            $date2 = new DateTime($enddate);
            $totaldays = $date2->diff($date1)->format("%a");

            $total=$price*($totaldays+1);
            $avilabledate=date('Y-m-d', strtotime($enddate . ' +1 day'));
        }   
        if($_data->duration==""){
            $month=0;            
            
        }else{
            $month=$_data->duration;
            $avilabledate=date('Y-m-d',strtotime("+$month month",strtotime($bookdate)));
            $price=$_data->price;
            $total=$price*$month;
        }   
         
        
        $data = array(
            "booking_no" => date('ymdhis'),
            "vehicle_id" => $_data->vehicle_id,
            "user_id" => $userid,
            "duration" => $month,
            "subscription_price" => $price,
            "color" => $_data->color,
            "payment_method" => $_data->payment,
            "delivery_date" => $_data->delivery_date,
            "delivery_time" => $_data->deliveryTime,
            "delivery_address1" => $_data->deliAddressLine1,
            "delivery_address2" => $_data->deliAddressLine2,
            "delivery_postcode" => $_data->deliPostcode,
            "delivery_remark" => $_data->deliRemark,
            "deli_phone" => $_data->deliveryPhNumber,
            "billing_address1" => $_data->billingAddressLine1,
            "billing_address2" => $_data->billingAddressLine2,
            "billing_phone" => $_data->billingPhNumber,
            "billing_postcode" => $_data->billingPostcode,
            "country" => $_data->billingCountry,
            "state" => $_data->billingState,
            "billing_postcode" => $_data->billingPostcode,
            "available_date" => $avilabledate,  
            "start_date" => $startdate,
            "end_date" => $enddate,
            "total_amt"=>$total,
            "price_status"=>$pricestatus,
            "created_date"=>date('Y-m-d')
        );
        $cardata = array(
                    "available_date" => $avilabledate
                );
        $this->db->where('id',$cid);
        $this->db->update("car_details",$cardata);

        $this->db->insert("bookings", $data);
        $bid=$this->db->insert_id();
        

        $booking = $this->db->query("SELECT * FROM bookings WHERE id = $bid")->row();
        $return = array("status" => 1, "data" => $booking);
        echo json_encode($return);
    }
    public function checkbookings()
    {
        $return = array("status" => 0, "data" => "Invalid Booking ID");
        $_data = json_decode(file_get_contents('php://input')); 

        $bid=$_data->bid;
        $vehicleid=$_data->vehicle_id;
        $checkstatus=$_data->check_status;
        if($checkstatus=="true")
            {
                $data = array(
                    "check_status" => "1"
                );
                $this->db->where('id',$bid);
                $this->db->update("bookings",$data);

                $data = array(
                        "status" =>"1"
                    );
                $this->db->where('id',$vehicleid);
                $this->db->update("car_details",$data);
            }
            else{
                $this->db->where('id',$bid);
                $this->db->delete("bookings");
            }
        
        $return = array("status" => 1);
        echo json_encode($return);    
    }
    public function bookingslist()
    {
        $return = array("status" => 0, "data" => "Invalid Booking ID");
        $_data = json_decode(file_get_contents('php://input')); 

        $userid=$_data->userid;
        $bookingtab=$_data->bookingtab;
        if($bookingtab=='1'){

            $booking = $this->db->query("SELECT bookings.*,bookings.id as bid,car_details.photo as photo,car_details.model_name as model_name FROM bookings LEFT JOIN car_details ON car_details.id=bookings.vehicle_id WHERE bookings.user_id='$userid' AND (bookings.check_status = '1' OR bookings.check_status = '2' OR bookings.check_status='4')")->result();  

        }else if($bookingtab=='2'){
            $booking = $this->db->query("SELECT bookings.*,bookings.id as bid,car_details.photo as photo,car_details.model_name as model_name FROM bookings LEFT JOIN car_details ON car_details.id=bookings.vehicle_id WHERE bookings.check_status = '3' AND bookings.user_id=$userid")->result();  
        }
        
        $return = array("status" => 1, "data" => $booking);
        echo json_encode($return);
    }
    public function uploaduserbookingfiles() {   

        $post = $this->input->post(); 
        if($post) {
                $bid=$post["booking_id"];

                if(!empty($_FILES['driving_license_front']))
                {
                    $dvfront_upload = $this->_do_upload_drfront();                                       
                } 
                if(!empty($_FILES['driving_license_back']['name']))
                {
                    $dvback_upload = $this->_do_upload_drback();
                }
                if(!empty($_FILES['national_id_front']['name']))
                {
                    $nrcfront_upload = $this->_do_upload_nrcfront();                    
                }
                if(!empty($_FILES['national_id_back']['name']))
                {
                    $nrcback_upload = $this->_do_upload_nrcback();                    
                }
                $data=array(
                        'driving_license_front'=>$dvfront_upload,
                        'driving_license_back'=>$dvback_upload,
                        'national_id_front'=>$nrcfront_upload,
                        'national_id_back'=>$nrcback_upload,
                        'check_status'=>'2'
                    ); 
                $this->db->where('id',$bid);
                $this->db->update("bookings",$data);      
        }
                
                $booking = $this->db->query("SELECT * FROM bookings WHERE id = $bid")->row();
                $return = array("status" => true, "data" => $booking);
                echo json_encode($return);        
    }
    
    public function getbookingid($bid) { 
        $json = file_get_contents('php://input');
        $dd = json_decode($json);
        
        $data = array();
        
        $data = $this->db->query("SELECT bookings.*,bookings.id as bid,car_details.photo,car_details.model_name as modelname,bookings.duration as bookduration,bookings.subscription_price FROM bookings LEFT JOIN car_details ON car_details.id=bookings.vehicle_id WHERE bookings.id = $bid")->row();
        echo json_encode($data);
    }
    public function getuserinvoice($uid){
        $json = file_get_contents('php://input');
        $invoice = json_decode($json);
        
        $data = array();        
        $data = $this->db->query("SELECT invoice.*,invoice.id as ivoid,bookings.payment_method as paymethod,bookings.total_amt as totalamt FROM invoice LEFT JOIN bookings ON bookings.id=invoice.booking_id WHERE invoice.user_id = $uid")->result();
        echo json_encode($data);
    }
    public function getuserinvoice_detail($invoiceid){
        $json = file_get_contents('php://input');
        $invoice = json_decode($json);
        
        $data = array();        
        $data = $this->db->query("SELECT users.first_name as fname,users.last_name as lname,users.email as useremail,bookings.billing_address1 as billaddress,bookings.billing_phone as billphone,car_details.model_name as modelname,bookings.duration as bookingduration,bookings.subscription_price,invoice.total_amt as totalamt,invoice.id as ivoid,bookings.delivery_remark,invoice.invoice_date,invoice.invoice_name FROM invoice LEFT JOIN bookings ON bookings.id = invoice.booking_id LEFT JOIN users ON users.id=invoice.user_id LEFT JOIN car_details ON car_details.id=invoice.vehicle_id WHERE invoice.id = $invoiceid")->row(); 
         echo json_encode($data); 
    }

    public function userprofileupdate() {
        $post = $this->input->post(); 
            if($post) {

            $userid=$post["id"];

            if(!empty($_FILES['profile']))
            {
                $profile = $this->_do_upload_profile();                                       
            }else{
                $profile=$post["profile"];
            }    

            $data = array(
                "first_name" => $post["first_name"],
                "last_name" => $post["last_name"],
                "email" => $post["email"],
                "phone" => $post["phone"], 
                "profile" => $profile
            );

            $this->db->where('id',$userid);
            $this->db->update("users",$data);
            $user = $this->db->query("SELECT * FROM users WHERE id = $userid")->row();
            $return = array("status" => 1, "data" => $user);
            echo json_encode($return);
        }
    }
    public function checkforgetpassword()
    {
        $return = array("status" => 0, "data" => "Invalid Email Address");
        $data = json_decode(file_get_contents('php://input'));

        $user = $this->db->query("SELECT * FROM users WHERE email = ? LIMIT 1", array($data->email))->row();

        if($user) {            
            $return = array("status" => 1,"data"=>$user->id);
        }else{
            $return = array("status" => 0,"message"=>"Invalid Email Address");
        }
        echo json_encode($return);
    }
    public function updateforgetpassword()
    {
        $return = array("status" => 0, "data" => "Invalid Password");
        $_data = json_decode(file_get_contents('php://input'));
        
        $userid=$_data->id;
        $data = array(            
            "password" => password_hash($_data->password, PASSWORD_DEFAULT)         
        );

        $this->db->where('id',$userid);
        $this->db->update("users",$data);
        $user = $this->db->query("SELECT * FROM users WHERE id = $userid")->row();
        $return = array("status" => 1, "data" => $user);
        echo json_encode($return);
    }
    public function changepassword()
    {
        $return = array("status" => 0, "data" => "Invalid Email Address");
        $data = json_decode(file_get_contents('php://input'));

        $userid=$data->id;       
        
        $userdata = $this->db->query("SELECT * FROM users WHERE id = $userid")->row();

        if($userdata) {
                $is_valid=password_verify($data->password, $userdata->password);
                if($is_valid) {   
                    $data = array(            
                                "password" => password_hash($data->newpassword, PASSWORD_DEFAULT)         
                            );
                    $this->db->where('id',$userid);
                    $this->db->update("users",$data);
                    $return = array("status" => 1);

                }else{
                    $return = array("status" => 0,"message"=>"Wrong Password !");
                }
        }
        echo json_encode($return);
    }
    public function resizeImage($filename)
    {
        $source_path = "uploads/uersinfo/$filename";
        $target_path = "uploads/uersinfo/$filename";
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => TRUE,
            'width' => 150,
            'height' => 100
        );

        $this->load->library('image_lib');
        $this->image_lib->initialize($config_manip);
        if (!$this->image_lib->resize()) {
            echo json_encode(array("status" => false, "message" => $this->image_lib->display_errors()));
            die();
        }

        $this->image_lib->clear();
    }
    public function vehicles_search()
    {
        $return = array("status" => 0, "data" => "Invalid Name");
        $_data = json_decode(file_get_contents('php://input'));
        
        $name=$_data->name;
        $duration=$_data->duration;
        $brand=$_data->brand;
        $bodytype=$_data->bodytype;
        $fueltype=$_data->fueltype;

        if(!empty($name) && empty($duration) && empty($brand) && empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT * FROM car_details WHERE model_name LIKE'%$name%' OR brand_name LIKE'%$name%' OR body_type LIKE'%$name%' OR fuel_type LIKE'%$name%' OR duration LIKE'%$name%' AND show_status!='0' ORDER BY id DESC")->result();
            
        }
        elseif(empty($name) && !empty($duration) && empty($brand) && empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT car_details.* FROM car_details LEFT JOIN car_package ON car_package.vehicle_id=car_details.id WHERE car_package.duration=$duration AND car_details.show_status!='0' ORDER BY car_details.id DESC")->result();
            
        }
        elseif(empty($name) && empty($duration) && !empty($brand) && empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT * FROM car_details WHERE brand_name='$brand' AND show_status!='0' ORDER BY id DESC")->result();
           
        }
        elseif(empty($name) && empty($duration) && empty($brand) && !empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT * FROM car_details WHERE body_type=$bodytype AND show_status!='0' ORDER BY id DESC")->result();
          
        }
        elseif(empty($name) && empty($duration) && empty($brand) && empty($bodytype) && !empty($fueltype))
        {
            $query=$this->db->query("SELECT * FROM car_details WHERE fuel_type=$fueltype AND show_status!='0' ORDER BY id DESC")->result();
        }
        // -------------
        elseif(empty($name) && !empty($duration) && !empty($brand) && empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT car_details.* FROM car_details LEFT JOIN car_package ON car_package.vehicle_id=car_details.id WHERE car_package.duration=$duration AND brand_name='$brand' AND car_details.show_status!='0' ORDER BY car_details.id DESC")->result();
        }
        elseif(empty($name) && !empty($duration) && empty($brand) && !empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT * FROM car_details WHERE duration=$duration AND body_type=$bodytype AND show_status!='0' ORDER BY id DESC")->result();
        }
        elseif(empty($name) && !empty($duration) && empty($brand) && empty($bodytype) && !empty($fueltype))
        {
            $query=$this->db->query("SELECT car_details.* FROM car_details LEFT JOIN car_package ON car_package.vehicle_id=car_details.id WHERE car_package.duration=$duration AND fuel_type=$fueltype AND car_details.show_status!='0' ORDER BY car_details.id DESC")->result();
        }
        // -----------
        elseif(empty($name) && empty($duration) && !empty($brand) && !empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT * FROM car_details WHERE brand_name='$brand' AND body_type=$bodytype AND show_status!='0' ORDER BY id DESC")->result();
        }
        elseif(empty($name) && empty($duration) && !empty($brand) && empty($bodytype) && !empty($fueltype))
        {
            $query=$this->db->query("SELECT * FROM car_details WHERE brand_name='$brand' AND fuel_type=$fueltype AND show_status!='0' ORDER BY id DESC")->result();
        }
        // -------------
        elseif(empty($name) && empty($duration) && empty($brand) && !empty($bodytype) && !empty($fueltype))
        {
            $query=$this->db->query("SELECT * FROM car_details WHERE body_type=$bodytype AND fuel_type=$fueltype AND show_status!='0' ORDER BY id DESC")->result();
        }
        // ----------------
        elseif(empty($name) && !empty($duration) && !empty($brand) && !empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT car_details.* FROM car_details LEFT JOIN car_package ON car_package.vehicle_id=car_details.id WHERE car_package.duration=$duration AND brand_name='$brand' AND body_type=$bodytype AND car_details.show_status!='0' ORDER BY car_details.id DESC")->result();
        }
        elseif(empty($name) && empty($duration) && !empty($brand) && !empty($bodytype) && !empty($fueltype))
        {
            $query=$this->db->query("SELECT * FROM car_details WHERE brand_name='$brand' AND body_type=$bodytype AND fuel_type=$fueltype AND show_status!='0' ORDER BY id DESC")->result();
        }
        elseif(empty($name) && !empty($duration) && !empty($brand) && empty($bodytype) && !empty($fueltype))
        {
            $query=$this->db->query("SELECT car_details.* FROM car_details LEFT JOIN car_package ON car_package.vehicle_id=car_details.id WHERE car_package.duration=$duration AND brand_name='$brand' AND fuel_type=$fueltype AND car_details.show_status!='0' ORDER BY car_details.id DESC")->result();
        }
        // ----------------
        elseif(!empty($name) && !empty($duration) && empty($brand) && empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT car_details.* FROM car_details LEFT JOIN car_package ON car_package.vehicle_id=car_details.id WHERE model_name LIKE'%$name%' OR brand_name LIKE'%$name%' OR body_type LIKE'%$name%' OR fuel_type LIKE'%$name%' AND car_package.duration=$duration AND car_details.show_status!='0' ORDER BY car_details.id DESC")->result();
            
        }
        elseif(!empty($name) && empty($duration) && !empty($brand) && empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT * FROM car_details WHERE model_name LIKE'%$name%' OR body_type LIKE'%$name%' OR fuel_type LIKE'%$name%' OR duration LIKE'%$name%' AND brand_name='$brand' AND show_status!='0' ORDER BY id DESC")->result();
            
        }
        elseif(!empty($name) && empty($duration) && empty($brand) && !empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT * FROM car_details WHERE model_name LIKE'%$name%' OR brand_name LIKE'%$name%' OR fuel_type LIKE'%$name%' OR duration LIKE'%$name%' AND body_type=$bodytype AND show_status!='0' ORDER BY id DESC")->result();
            
        }
        elseif(!empty($name) && empty($duration) && empty($brand) && empty($bodytype) && !empty($fueltype))
        {
            $query=$this->db->query("SELECT * FROM car_details WHERE model_name LIKE'%$name%' OR brand_name LIKE'%$name%' OR body_type LIKE'%$name%' OR duration LIKE'%$name%' AND fuel_type=$fueltype AND show_status!='0' ORDER BY id DESC")->result();
            
        }
        // --------------
        elseif(!empty($name) && !empty($duration) && !empty($brand) && empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT car_details.* FROM car_details LEFT JOIN car_package ON car_package.vehicle_id=car_details.id WHERE model_name LIKE'%$name%' OR body_type LIKE'%$name%' OR fuel_type LIKE'%$name%' AND car_package.duration=$duration AND brand_name='$brand' AND car_details.show_status!='0' ORDER BY car_details.id DESC")->result();
            
        }
        elseif(!empty($name) && !empty($duration) && empty($brand) && !empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT car_details.* FROM car_details LEFT JOIN car_package ON car_package.vehicle_id=car_details.id WHERE model_name LIKE'%$name%' OR brand_name LIKE'%$name%' OR fuel_type LIKE'%$name%' AND car_package.duration=$duration AND body_type=$bodytype AND car_details.show_status!='0' ORDER BY car_details.id DESC")->result();
            
        }
        elseif(!empty($name) && !empty($duration) && empty($brand) && empty($bodytype) && !empty($fueltype))
        {
            $query=$this->db->query("SELECT car_details.* FROM car_details LEFT JOIN car_package ON car_package.vehicle_id=car_details.id WHERE model_name LIKE'%$name%' OR brand_name LIKE'%$name%' OR body_type LIKE'%$name%' AND car_package.duration=$duration AND fuel_type=$fueltype AND car_details.show_status!='0' ORDER BY car_details.id DESC")->result();
           
        }
        // --------------
        elseif(!empty($name) && empty($duration) && !empty($brand) && !empty($bodytype) && !empty($fueltype))
        {
            $query=$this->db->query("SELECT * FROM car_details WHERE model_name LIKE'%$name%' OR duration LIKE'%$name%' AND brand_name='$brand' AND body_type=$bodytype AND fuel_type=$fueltype AND show_status!='0' ORDER BY id DESC")->result();
            
        }
        elseif(!empty($name) && !empty($duration) && !empty($brand) && !empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT car_details.* FROM car_details LEFT JOIN car_package ON car_package.vehicle_id=car_details.id WHERE model_name LIKE'%$name%' OR fuel_type LIKE'%$name%' AND car_package.duration=$duration AND brand_name='$brand' AND body_type=$bodytype AND car_details.show_status!='0' ORDER BY car_details.id DESC")->result();
            
        }
        elseif(empty($name) && !empty($duration) && !empty($brand) && !empty($bodytype) && !empty($fueltype))
        {
            $query=$this->db->query("SELECT car_details.* FROM car_details LEFT JOIN car_package ON car_package.vehicle_id=car_details.id WHERE car_package.duration=$duration AND brand_name='$brand' AND body_type=$bodytype AND fuel_type=$fueltype AND car_details.show_status!='0' ORDER BY car_details.id DESC")->result();
        }
        // --------------
        elseif(empty($name) && !empty($duration) && empty($brand) && !empty($bodytype) && !empty($fueltype))
        {
            $query=$this->db->query("SELECT car_details.* FROM car_details LEFT JOIN car_package ON car_package.vehicle_id=car_details.id WHERE car_package.duration=$duration AND body_type=$bodytype AND fuel_type=$fueltype AND car_details.show_status!='0' ORDER BY car_details.id DESC")->result();
        }
        // --------------
        elseif(empty($name) && empty($duration) && empty($brand) && empty($bodytype) && empty($fueltype))
        {
            $query=$this->db->query("SELECT * FROM car_details WHERE show_status!='0' ORDER BY id DESC")->result();

        }

        echo json_encode($query);
    }
    public function _do_upload_dealer()
    {
        $config['upload_path']          = 'upload/usersinfo';
        $config['allowed_types']        = 'pdf|docx|xlsx|csv|xls|ods';        
 
        $this->upload->initialize($config);
 
       if(!$this->upload->do_upload('file')) //upload and validate
        {
            $data['inputerror'][] = 'file';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
    public function _do_upload()
    {
        $config['upload_path']          = 'upload/usersinfo';
        $config['allowed_types']        = 'jpg|png';        
 
        $this->upload->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
 
       if(!$this->upload->do_upload('driving_license_front')) //upload and validate
        {
            $data['inputerror'][] = 'driving_license_front';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
    public function _do_upload_profile()
    {
        $config['upload_path']          = 'upload/files';
        $config['allowed_types']        = 'jpg|png';        
 
        $this->upload->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
 
       if(!$this->upload->do_upload('profile')) //upload and validate
        {
            $data['inputerror'][] = 'profile';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
    public function _do_upload_drfront()
    {
        $config['upload_path']          = 'upload/usersinfo';
        $config['allowed_types']        = 'jpg|png';     
        if(!file_exists($config['upload_path'])){
            mkdir($config['upload_path'], 0777);
        }   
        $this->load->library('upload', $config); 
        $this->upload->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
 
       if(!$this->upload->do_upload('driving_license_front')) //upload and validate
        {
            $data['inputerror'][] = 'driving_license_front';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
    public function _do_upload_drback()
    {
        $config['upload_path']          = 'upload/usersinfo';
        $config['allowed_types']        = 'jpg|png'; 
        if(!file_exists($config['upload_path'])){
            mkdir($config['upload_path'], 0777);
        } 

        $this->load->library('upload', $config); 
        $this->upload->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
 
       if(!$this->upload->do_upload('driving_license_back')) //upload and validate
        {
            $data['inputerror'][] = 'driving_license_back';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
    public function _do_upload_nrcfront()
    {
        $config['upload_path']          = 'upload/usersinfo';
        $config['allowed_types']        = 'jpg|png';
        if(!file_exists($config['upload_path'])){
            mkdir($config['upload_path'], 0777);
        }         
        $this->load->library('upload', $config); 
        $this->upload->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
 
       if(!$this->upload->do_upload('national_id_front')) //upload and validate
        {
            $data['inputerror'][] = 'national_id_front';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
    public function _do_upload_nrcback()
    {
        $config['upload_path']          = 'upload/usersinfo';
        $config['allowed_types']        = 'jpg|png'; 
        if(!file_exists($config['upload_path'])){
            mkdir($config['upload_path'], 0777);
        } 

        $this->load->library('upload', $config); 
        $this->upload->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
 
       if(!$this->upload->do_upload('national_id_back')) //upload and validate
        {
            $data['inputerror'][] = 'national_id_back';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }


}