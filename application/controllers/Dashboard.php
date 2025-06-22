<?php
if(!defined('BASEPATH'))
		exit('No direct script acceess allowed'); 
    
class Dashboard extends CI_Controller
{
    function __construct() 
    	{
          parent::__construct();
          error_reporting(1);   
          $this->load->library('ckeditor');
          $this->load->library('ckfinder');
      }
    function index()
      { 
        $this->load->view("welcome_message");
      }   
    
    function user_register()
      {
        $data['content']="register";
        $this->load->view("template",$data);
      }
    function setting()
    {
        if($this->session->userdata("email") && $this->session->userdata("password"))
        {
            $role=$this->session->userdata("role");

            $data['admin']=$this->db->query("SELECT * FROM users Where role='$role'")->row();
            $data['content']="setting";
            $this->load->view("template",$data);
        }else
        {
          redirect('/');
        }
    }
    function forgotpassword()
    {
      $this->load->view("forgetpwd");
    }
    function change_password()
    {
      $this->load->view("changepwd");
    }

    function allvehicles(){
      if($this->session->userdata("email") && $this->session->userdata("password"))
      { 
        if($this->uri->segment(3))
                    {
                        $start=$this->uri->segment(3);
                        $i=$start+1;
                    }
                    else
                    {
                        $i=1;
                    }
            $data['i']=$i;

        // Insert
            $this->load->library('upload');
            $post = $this->input->post();
            $postby=$this->session->userdata('role');
            
            if(!empty($post)) {
                $color=$post['color'];      
                $colour=implode(",",$color);

                $feat=$post['feature'];      
                $feature=implode(",",$feat);

                $duration=$post["duration"];
                $rentalprice=$post["rentalprice"];
                $vstatus=$post["vstatus"];
                $package="";
                for($i=0;$i<count($rentalprice);$i++)
                {
                  $package .= $duration[$i].",". $rentalprice[$i].",". $vstatus[$i]."}";        
                }

                if(!empty($_FILES['document']['name']) && count(array_filter($_FILES['document']['name'])) > 0)
                  { 
                          $documentfile="";
                          $filesCount = count($_FILES['document']['name']); 
                          
                          for($i = 0; $i < $filesCount; $i++){ 
                              $_FILES['file']['name']     = $_FILES['document']['name'][$i]; 
                              $_FILES['file']['type']     = $_FILES['document']['type'][$i]; 
                              $_FILES['file']['tmp_name'] = $_FILES['document']['tmp_name'][$i]; 
                              $_FILES['file']['error']     = $_FILES['document']['error'][$i]; 
                              $_FILES['file']['size']     = $_FILES['document']['size'][$i]; 
                               
                            
                              $uploadPath = 'upload/files/'; 
                              $config['upload_path'] = $uploadPath; 
                              $config['allowed_types'] = 'pdf|docx|xlsx|csv|xls|ods'; 
                             
                             if(!file_exists($config['upload_path'])){
                                mkdir($config['upload_path'], 0777);
                                }
                              $this->load->library('upload', $config); 
                              $this->upload->initialize($config);                           
                              
                              if($this->upload->do_upload('file')){ 
                                  
                                  $fileData = $this->upload->data();                                   
                                  $uploadData[$i] = $fileData['file_name'];  
                                  $documentfile .=$uploadData[$i].','; 
                              }
                               
                          }                       
                                          
                    }else{
                        $documentfile="";
                    } 
                    $data = array(
                        'model_name' => $post['n_modelname'],
                        'brand_name' => $post['n_brandname'],
                        'vehicle_no' => $post['n_vehicleno'],
                        'tnc' => $post['n_tnc'],
                        'description' => $post['description'],
                        'car_package' => $package,
                        'price_status' => $post['n_pricestatus'],
                        'rental_price' => $post['n_price'],
                        'selling_price' => $post['selling_price'],
                        'color' => $colour,                  
                        'title_status' => $post['category'],
                        'year' => $post['n_year'],
                        'fuel_type' => $post['n_fueltype'],
                        'body_type' => $post['n_bodytype'],
                        'consumption' => $post['n_consumption'],
                        'engine_type' => $post['n_engine'],
                        'door' => $post['n_door'],
                        'seat_qty' => $post['n_seat'],
                        'transmission' => $post['n_transmission'],
                        'features' => $feature,
                        'document' => $documentfile,
                        'post_by'=>$postby,
                        'purchase_date' => $post['n_purchase_date'],
                        'registration_date' => $post['n_registeration_date'],
                        'created_date' => date('Y-m-d')
                    );

                  if(!empty($_FILES['cover']['name']))
                    {
                      $upload = $this->_do_upload_cover();
                      $data['photo'] = $upload;                      
                    }                  

                  $this->db->insert('car_details',$data); 
                  $vid=$this->db->insert_id();
                if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0)
                { 
                      $filesCountt = count($_FILES['files']['name']); 
                      for($i = 0; $i < $filesCountt; $i++){ 
                          $_FILES['filee']['name']     = $_FILES['files']['name'][$i]; 
                          $_FILES['filee']['type']     = $_FILES['files']['type'][$i]; 
                          $_FILES['filee']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
                          $_FILES['filee']['error']     = $_FILES['files']['error'][$i]; 
                          $_FILES['filee']['size']     = $_FILES['files']['size'][$i];

                          $uploadPath = 'upload/files/'; 
                          $config['upload_path'] = $uploadPath; 
                          $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                         
                         if(!file_exists($config['upload_path'])){
                            mkdir($config['upload_path'], 0777);
                            }
                          $this->load->library('upload', $config); 
                          $this->upload->initialize($config);                           
                        
                          if($this->upload->do_upload('filee')){ 
                              
                              $fileDataa = $this->upload->data(); 
                              $uploadDataa[$i]['vehicle_id'] = $vid; 
                              $uploadDataa[$i]['photos'] = $fileDataa['file_name'];
                              $uploadDataa[$i]['created_date'] = date("Y-m-d");  
                          } 
                          
                      }  
                      $this->db->insert_batch('vehicle_photos',$uploadDataa);             
                }/*end files upload*/ 

                  for($i=0;$i<count($rentalprice);$i++)
                      {
                          if($vstatus[$i]=='true')
                          {
                            $beststatus="bestsaver";
                          }
                          else{
                            $beststatus="";
                          }
                          $pkgdata = array(
                                    'vehicle_id' => $vid,
                                    'duration' => $duration[$i],
                                    'price' => $rentalprice[$i],
                                    'best' => $vstatus[$i],   
                                    'best_status' => $beststatus,              
                                    'created_date' => date('Y-m-d')
                                );
                            $this->db->insert('car_package',$pkgdata); 
                      }
                      
        }
          // end


            if($this->session->userdata("role")=="admin"){
              $data["allvehicleslist"] =$this->Main_model->allvehicleslist("car_details");  
            }else{
              $data["allvehicleslist"] =$this->Main_model->vehicleslist("car_details");  
            }            
            $data["getfueltype"] =$this->Main_model->getfueltype();  
            $data["getbodytype"] =$this->Main_model->getbodytype();  
            $data["getfeatures"] =$this->Main_model->getfeatures();  
            $data["getbrands"] =$this->Main_model->getbrands(); 
            $data["getcategory"] =category_list();
            $data["durationlist"] =$this->Main_model->getdurationlist(); 

            $data['content']="vehicles";
            $this->load->view("template",$data);
        }else{
        redirect('/');
      }
    }
    
    function functions()
    {
      $role=$this->session->userdata("role");
      if($this->session->userdata("email") && $this->session->userdata("password") && $role=="admin")
      {
                $this->ckeditor->basePath = base_url().'assets/ckeditor/';
                $this->ckeditor->config['toolbar'] = array(
                                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
                                                                    );
                $this->ckeditor->config['language'] = 'it';
                $this->ckeditor->config['width'] = '730px';
                $this->ckeditor->config['height'] = '100px';            

                //Add Ckfinder to Ckeditor
                $this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/'); 

                // Insert
                $post = $this->input->post();             

                if(!empty($post["n_fueltype"])) {
                    $fueldata = array(
                        "fuel_type" => $post["n_fueltype"],
                        "created_date" => date('Y-m-d')
                    );
                    $this->db->insert("fuel_type", $fueldata);
                    $this->session->set_flashdata('success', 'Has been created.');
                } 
                if(!empty($post["n_bodytype"])){
                    $bodydata = array(
                        "body_type" => $post["n_bodytype"],
                        "created_date" => date('Y-m-d')
                    );
                    $this->db->insert("body_type", $bodydata);
                }
                
                                
                $data["bodytype"] =$this->db->query("SELECT * FROM body_type order by id desc");
                $data["fueltype"] =$this->db->query("SELECT * FROM fuel_type order by id desc");
                $data["business"] =$this->db->query("SELECT * FROM business order by id desc");
                $data["promotion"] =$this->db->query("SELECT * FROM promotion order by id desc");
                $data["category"] =$this->db->query("SELECT * FROM category order by id desc"); 

                $data['content']="functions";
                $this->load->view("template",$data);
      }else{
        redirect('/');
      }
    }

    function brands()
    {
        $role=$this->session->userdata("role");
        if($this->session->userdata("email") && $this->session->userdata("password") && $role=="admin")
        {
            $post = $this->input->post();
            if(!empty($post)) {
                $is_exist = $this->db->from("brands")->where(['brand_name' => $post["n_brandname"]])->count_all_results();

                if(!$is_exist) {
                    $data = array(
                        'brand_name' => $post['n_brandname'],
                        'created_date'=>date('Y-m-d')
                    );
                    if(!empty($_FILES['photo']['name']))
                    {
                        $upload = $this->_do_upload();
                        $data['brand_photo'] = $upload;
                    }

                    $this->db->insert("brands", $data);
                    $this->session->set_flashdata('success', 'Has been created.');
                } else {
                    $this->session->set_flashdata('error', 'Already exists.');
                }
            }

            $data["brandlist"] =$this->db->query("SELECT * FROM brands order by id desc");
            $data['content']="brands";
            $this->load->view("template",$data);
        }else{
          redirect('/');
        }
    }


    function features()
    {
        $role=$this->session->userdata("role");
        if($this->session->userdata("email") && $this->session->userdata("password") && $role=="admin")
        {
            $post = $this->input->post();
            if(!empty($post)) {
                $is_exist = $this->db->from("features")->where(['name' => $post["n_name"]])->count_all_results();

                if(!$is_exist) {
                    $data = array(
                        'name' => $post['n_name'],
                        'created_date' => date('Y-m-d')
                    );

                    $this->db->insert("features", $data);
                    $this->session->set_flashdata('success', 'Has been created.');
                } else {
                    $this->session->set_flashdata('error', 'Already exists.');
                }
            }

            $data["feature"] =$this->db->query("SELECT * FROM features order by id desc"); 
            $data['content']="features";
            $this->load->view("template",$data);
        }else{
          redirect('/');
        }
    }


    function services()
    {
        $role=$this->session->userdata("role");
        if($this->session->userdata("email") && $this->session->userdata("password") && $role=="admin")
        {
            $post = $this->input->post();
            if(!empty($post)) {
                $is_exist = $this->db->from("services")->where(['name' => $post["n_name"]])->count_all_results();

                if(!$is_exist) {
                    $data = array(
                        'name' => $post['n_name'],
                        'created_date' => date('Y-m-d')
                    );

                    $this->db->insert("services", $data);
                    $this->session->set_flashdata('success', 'Has been created.');
                } else {
                    $this->session->set_flashdata('error', 'Already exists.');
                }
            }
            
            $data["service"] =$this->db->query("SELECT * FROM services order by id desc");      
            $data['content']="services";
            $this->load->view("template",$data);
        }else{
          redirect('/');
        }
    }


    function howitworks()
    {
      $role=$this->session->userdata("role");
      if($this->session->userdata("email") && $this->session->userdata("password") && $role=="admin")
      {
          $this->ckeditor->basePath = base_url().'assets/ckeditor/';
          $this->ckeditor->config['toolbar'] = array(
                          array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' ));
          $this->ckeditor->config['language'] = 'it';
          $this->ckeditor->config['width'] = '550px';
          $this->ckeditor->config['height'] = '100px';            

          //Add Ckfinder to Ckeditor
          $this->ckfinder->SetupCKEditor($this->ckeditor,'../assets/ckfinder/'); 
          
          $post = $this->input->post();
          if(!empty($post)) {
                  $data = array(
                      "step" => $post["step"],
                      "title" => $post["title"],
                      "description" => $post["description"],
                      "created_date" => date('Y-m-d')
                  );
                  
                  $this->db->insert("how_works", $data);
              
          }

          $data["howitwork"] =$this->db->query("SELECT * FROM how_works order by id desc");
          $data['content']="howitworks";
          $this->load->view("template",$data);
      }else{
        redirect('/');
      }
    }
    function business()
    {
        $role=$this->session->userdata("role");
          if($this->session->userdata("email") && $this->session->userdata("password") && $role=="admin")
          {
              $post = $this->input->post();
              if(!empty($post)) {
                      $data = array(
                          "title" => $post["title"],
                          "description" => $post["description"],
                          "created_date" => date('Y-m-d')
                      );
                      if(!empty($_FILES['photo']['name']))
                        {
                            $upload = $this->_do_upload();
                            $data['photo'] = $upload;
                        }
                      $this->db->insert("business", $data);  
              }
              $data["business"] =$this->db->query("SELECT * FROM business order by id desc");
              $data['content']="business";
              $this->load->view("template",$data);
          }else{
            redirect('/');
          }
    }

    function allbookings()
    {
      if($this->session->userdata("email") && $this->session->userdata("password"))
      {
          if($this->uri->segment(3))
                    {
                        $start=$this->uri->segment(3);
                        $i=$start+1;
                        
                    }
                    else
                    {
                        $i=1;
                    }
            $data['i']=$i;
            
            
            if($this->session->userdata("role")=="admin"){
              $data["bookinglist"] =$this->Main_model->allbookinglists("bookings");    
            }else{
              $data["bookinglist"] =$this->Main_model->bookinglists("bookings");   
            }

            $data['content']="booking";
            $this->load->view("template",$data);
      }else{
        redirect('/');
      }
    }

    function allinvoices()
    {
        if($this->session->userdata("email") && $this->session->userdata("password"))
        {
            if($this->uri->segment(3))
                      {
                          $start=$this->uri->segment(3);
                          $i=$start+1;
                          
                      }
                      else
                      {
                          $i=1;
                      }
              $data['i']=$i;

              if($this->session->userdata("role")=="admin"){
                $data["invoicelist"] =$this->Main_model->allinvoicelists("invoice");  
              }else{
                $data["invoicelist"] =$this->Main_model->invoicelists("invoice");   
              }
                

              $data['content']="invoice";
              $this->load->view("template",$data);
        }else{
          redirect('/');
        }
    }
    
    function faq()
    {
      $role=$this->session->userdata("role");
      if($this->session->userdata("email") && $this->session->userdata("password") && $role=="admin")
      {
          $post = $this->input->post();
          if(!empty($post)) {
              $is_exist = $this->db->from("faq")->where(['sub_title' => $post["n_subtitle"]])->count_all_results();

              if(!$is_exist) {
                  $user = array(
                      'main_title' => $post['n_maintitle'],
                      'sub_title' => $post['n_subtitle'],
                      'description' =>$post['description'],
                      'created_date' => date('Y-m-d')
                  );

                  $this->db->insert("faq", $user);
                  $this->session->set_flashdata('success', 'Has been created.');
              } else {
                  $this->session->set_flashdata('error', 'Already exists.');
              }
          }
          
          $data["faq"] =$this->db->query("SELECT * FROM faq order by id desc");  
          $data['content']="faq";
          $this->load->view("template",$data);
      }else{
        redirect('/');
      }
    }


    function car_detail()
    {
        if($this->session->userdata("email") && $this->session->userdata("password"))
          {
        $id=$this->uri->segment(3); 
        $post = $this->input->post();
        if(!empty($post)) {
            
          $vid=$post["vid"];
          if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0){ 
                    $filesCount = count($_FILES['files']['name']); 
                    for($i = 0; $i < $filesCount; $i++){ 
                        $_FILES['file']['name']     = $_FILES['files']['name'][$i]; 
                        $_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
                        $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
                        $_FILES['file']['error']     = $_FILES['files']['error'][$i]; 
                        $_FILES['file']['size']     = $_FILES['files']['size'][$i]; 
                         
                      
                        $uploadPath = 'upload/files/'; 
                        $config['upload_path'] = $uploadPath; 
                        $config['allowed_types'] = 'jpg|jpeg|png'; 

                        if(!file_exists($config['upload_path'])){
                            mkdir($config['upload_path'], 0777);
                        }
                        $this->load->library('upload', $config); 
                        $this->upload->initialize($config);                         
                      
                        if($this->upload->do_upload('file')){ 
                            
                            $fileData = $this->upload->data(); 
                            $uploadData[$i]['vehicle_id'] = $vid; 
                            $uploadData[$i]['photos'] = $fileData['file_name'];
                            $uploadData[$i]['created_date'] = date("Y-m-d");  
                        }else{  
                            $errorUploadType .= $_FILES['file']['name'].' | ';  
                        } 
                    } 
                     
                    $errorUploadType = !empty($errorUploadType)?'<br/>File Type Error: '.trim($errorUploadType, ' | '):''; 
                    if(!empty($uploadData)){ 
                        
                    $this->db->insert_batch('vehicle_photos',$uploadData);                     
                                  
                    }    
                }
        }

        $data["detailsdata"] =$this->db->query("SELECT car_details.*,car_details.id as cid,body_type.body_type as bodytype,fuel_type.fuel_type as fueltype FROM car_details LEFT JOIN body_type ON body_type.id=car_details.body_type LEFT JOIN fuel_type ON fuel_type.id=car_details.fuel_type WHERE car_details.id=$id")->row(); 

        $data['content']="car_detail";
        $this->load->view("template",$data);
        }else{
            redirect('/');
          }
    }


    function booking_detail()
    {
      if($this->session->userdata("email") && $this->session->userdata("password"))
      { 
          $id=$this->uri->segment(3);
          $data["bookingdata"] =$this->db->query("SELECT bookings.*,bookings.status as bstatus,bookings.id as bid, users.*,car_details.model_name as modelname FROM bookings LEFT JOIN car_details ON car_details.id=bookings.vehicle_id LEFT JOIN users ON users.id=bookings.user_id WHERE bookings.id=$id ORDER BY bookings.id DESC ")->row(); 

          $data['content']="booking_detail";
          $this->load->view("template",$data);
      }else{
        redirect('/');
      }
    }

    function users()
    {
      $role=$this->session->userdata("role");
      if($this->session->userdata("email") && $this->session->userdata("password") && $role=="admin")
      {
          $post = $this->input->post();

          if(!empty($post)) {
              $is_exist = $this->db->from("users")->where(['email' => $post["user_email"]])->count_all_results();

              if(!$is_exist) {
                  $user = array(
                      "first_name" => $post["user_firstname"],
                      "last_name" => $post["user_lastname"],
                      "phone" => $post["user_phone"],
                      "email" => $post["user_email"],
                      "password"=>password_hash($post["password"], PASSWORD_DEFAULT),
                      "role" => $post["role"],
                      "status" => "1",
                      "created_date" => date('Y-m-d H:i:s')
                  );

                  $this->db->insert("users", $user);
                  $this->session->set_flashdata('success', 'User has been created.');
              } else {
                  $this->session->set_flashdata('error', 'Email already exists.');
              }
          }
          
          $data["userslist"] =$this->db->query("SELECT * FROM users WHERE status!='0' order by id desc");
          $data['content']="users";
          $this->load->view("template",$data);
      }else{
        redirect('/');
      }
    }

    function showpromotext($id)
    {
      $data = $this->Main_model->getpromotext_by_id($id);
      echo json_encode($data);
    }
    function showbrandsdata($id)
    {
      $data = $this->Main_model->get_by_id($id);
      echo json_encode($data);
    }
    function showbusinessdata($id)
    {
      $data = $this->Main_model->getbusiness_by_id($id);
      echo json_encode($data);
    }
    function showbodytype($id)
    {
      $data = $this->Main_model->getbodytype_by_id($id);
      echo json_encode($data);
    }
    function showfueltype($id)
    {
      $data = $this->Main_model->getfueltype_by_id($id);
      echo json_encode($data);
    }
    function showhowitworksdata($id)
    {
      $data = $this->Main_model->gethowitworks_by_id($id);
      echo json_encode($data);
    }
    function showfaqdata($id)
    {
      $data = $this->Main_model->getfaq_by_id($id);
      echo json_encode($data);
    }
    function showfeaturedata($id)
    {
      $data = $this->Main_model->getfeature_by_id($id);
      echo json_encode($data);
    }
    function showservicesdata($id)
    {
      $data = $this->Main_model->getservices_by_id($id);
      echo json_encode($data);
    }
    function showvehiclesphotodata($id)
    {            
      $data = $this->db->query("SELECT * FROM car_details WHERE id = $id")->row();
      echo json_encode($data);
    }
    function showvehiclesdata()
    {      
      $id=$this->input->post("id");
      $data = $this->db->query("SELECT duration.duration as dura,duration.duration_id as duraid,car_package.best as beststatus,car_package.*,car_package.id as pkgid,car_package.duration as pkgduration,car_package.price as pkgprice,car_details.*,car_details.title_status as category,car_details.model_name as model_name,car_details.description as descrip,car_package.best as best FROM car_package LEFT JOIN car_details ON car_details.id = car_package.vehicle_id LEFT JOIN duration ON duration.duration_id=car_package.duration WHERE car_package.vehicle_id = $id")->result();
      echo json_encode($data);
    }    
    function getdurationlist()
    {
      $cid=$this->input->post("cid");
      $query=$this->db->query("Select * from duration")->result();
      echo json_encode($query);
    }
    function showgalleryImage($id)
    {
      $data = $this->Main_model->getgalleryImage_by_id($id);
      echo json_encode($data);
    }
    function showcategoryname($id)
    {
      $data = $this->Main_model->getcategoryname($id);
      echo json_encode($data);
    }
    function showusersdata($id)
    {
      $data = $this->Main_model->getusers_by_id($id);
      echo json_encode($data);
    }
    function showuserbooking($id)
    {
      $data = $this->Main_model->getuserbooking_by_id($id);
      echo json_encode($data);
    }


// Update
    function update_vehicles()
    {
        $this->_validate();
          $vid=$this->input->post("id");
          $postby=$this->session->userdata('role');

          $color=$this->input->post('color');      
          $colour=implode(",",$color);

          $feat=$this->input->post('feature');      
          $feature=implode(",",$feat);              

          
          $data = array(
                  'model_name' => $this->input->post('modelname'),
                  'brand_name' => $this->input->post('brandname'),
                  'vehicle_no' => $this->input->post('vehicleno'),
                  'tnc' => $this->input->post('tnc'),
                  'price_status' => $this->input->post('pricestatus'),
                  'description' => $this->input->post('edit_description'),
                  'car_package' => $package,
                  'rental_price' => $this->input->post('price'),
                  'selling_price' => $this->input->post('selling_pricee'),
                  'color' => $colour,                  
                  'title_status' => $this->input->post('category'),
                  'year' => $this->input->post('year'),
                  'fuel_type' => $this->input->post('fueltype'),
                  'body_type' => $this->input->post('bodytype'),
                  'consumption' => $this->input->post('consumption'),
                  'engine_type' => $this->input->post('engine'),
                  'door' => $this->input->post('door'),
                  'seat_qty' => $this->input->post('seat'),
                  'transmission' => $this->input->post('transmission'),
                  'features' => $feature,
                  'purchase_date' => $this->input->post('purchase_date'),
                  'registration_date' => $this->input->post('registeration_date'),
                  'post_by'=>$postby
              );
            if($this->input->post('remove_photo')) // if remove photo checked
                {
                  if(file_exists('upload/files/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                    unlink('upload/files/'.$this->input->post('remove_photo'));
                  $data['photo'] = '';
                }
            if(!empty($_FILES['cover']['name']))
                {
                  $upload = $this->_do_upload_cover();
                  
                  //delete file
                  $coverphoto = $this->Main_model->getvehicles_by_id($id);
                  if(file_exists('upload/files/'.$coverphoto->photo) && $coverphoto->photo)
                    unlink('upload/files/'.$coverphoto->photo);

                  $data['photo'] = $upload;
                }
          $this->db->where('id',$vid);
          $this->db->update("car_details",$data); 

          $vehiclesitem=$this->input->post("vehiclesitem");
          foreach($vehiclesitem as $item) 
          {
                  $pkgid=$item["pkgid"];
                  $duration=$item["duration"];
                  $rentalprice=$item["rentalprice"];
                  $vstatus=$item["vstatus"];

                  if($item["vstatus"]=="true"){
                      $beststatus="bestsaver";
                    }else{
                      $beststatus="";
                    }
                  $pkgdata = array(
                        'vehicle_id' => $vid,
                        'duration' => $duration,
                        'price' => $rentalprice,
                        'best' => $vstatus,   
                        'best_status' => $beststatus
                    );
                  if(empty($pkgid)){
                      $this->db->insert("car_package", $pkgdata);
                  }else{ 
                      $this->db->update("car_package", $pkgdata, array("id" => $pkgid));
                  }
          }          
              

          redirect("dashboard/allvehicles");
    }

    function update_coverImage()
    {
      $this->_validate();
      $id=$this->input->post("id");
      if($this->input->post('remove_photo')) // if remove photo checked
            {
              if(file_exists('upload/files/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('upload/files/'.$this->input->post('remove_photo'));
              $data['photo'] = '';
            }
        if(!empty($_FILES['cover']['name']))
            {
              $upload = $this->_do_upload_cover();
              
              //delete file
              $coverphoto = $this->Main_model->getvehicles_by_id($id);
              if(file_exists('upload/files/'.$coverphoto->photo) && $coverphoto->photo)
                unlink('upload/files/'.$coverphoto->photo);

              $data['photo'] = $upload;

              $this->db->where('id',$id);
                $this->db->update("car_details",$data);
            }
          

          redirect("dashboard/car_detail/".$id);
    }

    function update_galleryImage()
    {
      $this->_validate();
      $id=$this->input->post("id");
      $vid=$this->input->post("vid");

      if($this->input->post('remove_photo')) // if remove photo checked
            {
              if(file_exists('upload/files/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('upload/files/'.$this->input->post('remove_photo'));
              $data['photos'] = '';
            }
        if(!empty($_FILES['cover']['name']))
            {
              $upload = $this->_do_upload_cover();
              
              //delete file
              $galleryphoto = $this->Main_model->getgalleryImage_by_id($id);
              if(file_exists('upload/files/'.$galleryphoto->photos) && $galleryphoto->photos)
                unlink('upload/files/'.$galleryphoto->photos);

              $data['photos'] = $upload;
            }
          $this->db->where('id',$id);
          $this->db->update("vehicle_photos",$data);

          redirect("dashboard/car_detail/".$vid);
    }

    function update_business()
    {
        $this->_validate();
        $id=$this->input->post("id");
        $data = array(
                  'title' => $this->input->post('edit_title'),
                  'description' => $this->input->post('business_description'),
                  'created_date'=>date('Y-m-d')
              );
        if($this->input->post('remove_photo')) // if remove photo checked
            {
              if(file_exists('upload/files/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('upload/files/'.$this->input->post('remove_photo'));
              $data['photo'] = '';
            }
        if(!empty($_FILES['photo']['name']))
            {
              $upload = $this->_do_upload();
              
              //delete file
              $business = $this->Main_model->getbusiness_by_id($id);
              if(file_exists('upload/files/'.$business->photo) && $business->photo)
                unlink('upload/files/'.$business->photo);

              $data['photo'] = $upload;
            }
          $this->db->where('id',$id);
          $this->db->update("business",$data);

          redirect("dashboard/business");
    } 

    function update_brands()
    {
        $this->_validate();
        $id=$this->input->post("id");
        $data = array(
                  'brand_name' => $this->input->post('brandname'),
                  'created_date'=>date('Y-m-d')
              );
        if($this->input->post('remove_photo')) // if remove photo checked
            {
              if(file_exists('/upload/files/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('/upload/files/'.$this->input->post('remove_photo'));
              $data['brand_photo'] = '';
            }
        if(!empty($_FILES['photo']['name']))
            {
              $upload = $this->_do_upload();
              
              //delete file
              $brands = $this->Main_model->get_by_id($this->input->post('id'));
              if(file_exists('/upload/files/'.$brands->brand_photo) && $brands->brand_photo)
                unlink('/upload/files/'.$brands->brand_photo);

              $data['brand_photo'] = $upload;
            }
          $this->db->where('id',$id);
          $this->db->update("brands",$data);

          redirect("dashboard/brands");
    }   

    function update_bodytype()
    {        
        $id=$this->input->post("id");
        $data = array(
                  'body_type' => $this->input->post('bodytype'),
                  'created_date'=>date('Y-m-d')
              );
        $this->db->where('id',$id);
        $this->db->update("body_type",$data);

        redirect("dashboard/functions");
    }

    function update_fueltype()
    {        
        $id=$this->input->post("id");
        $data = array(
                  'fuel_type' => $this->input->post('fueltype'),
                  'created_date'=>date('Y-m-d')
              );
        $this->db->where('id',$id);
        $this->db->update("fuel_type",$data);

        redirect("dashboard/functions");
    }

    function update_howitworks()
    {
        $this->_validate();
        $id=$this->input->post("id");
        $data = array(
                  'step' => $this->input->post('edit_step'),
                  'title' => $this->input->post('edit_title'),
                  'description' => $this->input->post('edit_description'),
                  'created_date'=>date('Y-m-d')
              );
        if($this->input->post('remove_photo')) // if remove photo checked
            {
              if(file_exists('/upload/files/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('/upload/files/'.$this->input->post('remove_photo'));
              $data['photo'] = '';
            }
        if(!empty($_FILES['photo']['name']))
            {
              $upload = $this->_do_upload();
              
              //delete file
              $howitwork = $this->Main_model->getbusiness_by_id($id);
              if(file_exists('/upload/files/'.$howitwork->photo) && $howitwork->photo)
                unlink('/upload/files/'.$howitwork->photo);

              $data['photo'] = $upload;
            }
          $this->db->where('id',$id);
          $this->db->update("how_works",$data);

          redirect("dashboard/howitworks");
    }

    function update_faq()
    {
        $this->_validate();
        $id=$this->input->post("id");
        $data = array(
                  'main_title' => $this->input->post('maintitle'),
                  'sub_title' => $this->input->post('subtitle'),
                  'description' =>$this->input->post('faq_description'),
                  'created_date' => date('Y-m-d')
              ); 
        $this->db->where('id',$id);
        $this->db->update("faq",$data);

        redirect("dashboard/faq");
    } 

    function update_feature()
    {
        $this->_validate();
        $id=$this->input->post("id");
        $data = array(
                  'name' => $this->input->post('name'),
                  'created_date' => date('Y-m-d')
              ); 
        $this->db->where('id',$id);
        $this->db->update("features",$data);

        redirect("dashboard/features");
    }

    function update_services()
    {
        $this->_validate();
        $id=$this->input->post("id");
        $data = array(
                  'name' => $this->input->post('name'),
                  'created_date' => date('Y-m-d')
              ); 
        $this->db->where('id',$id);
        $this->db->update("services",$data);

        redirect("dashboard/services");
    }

    function update_setting()
    {      

      $id=$this->input->post("id");
      $firstname=$this->input->post("firstname");
      $lastname=$this->input->post("lastname");
      $email=$this->input->post("email");
      $phone=$this->input->post("phone");

      $data = array(
                  'first_name' => $firstname,
                  'last_name' => $lastname,
                  'phone' => $phone,
                  'email' => $email,
                  'created_date' => date('Y-m-d')
              ); 
        $this->db->where('id',$id);
        $this->db->update("users",$data);

         redirect("dashboard/setting");
    }

    function update_bookingapprove()
    {
      
      $bid=$this->input->post("bid");
      $vid=$this->input->post("vid");
      $approvestatus=$this->input->post("approvestatus");
      $data = array(
                  'confirm_status' => $approvestatus
                );
      $this->db->where('id',$bid);
      $this->db->update("bookings",$data);
      
      if($approvestatus=="3"){
            $ddata = array(
                  'check_status' => "3"
                );
      $this->db->where('id',$bid);
      $this->db->update("bookings",$ddata);
        }
      else if($approvestatus=="4"){
          $bdata = array(
                  'check_status'=>'4'
                );
          $this->db->where('id',$bid);
          $this->db->update("bookings",$bdata);
          $vdata = array(
                  'status'=>'0'
                );
          $this->db->where('id',$vid);
          $this->db->update("car_details",$vdata);
      }
      redirect("dashboard/allbookings");

    }
    function update_bookingstatus()
    {
      $Id=date(d);
      $invoicename='EA'.date('y').date('m').str_pad($Id,3,'0',STR_PAD_LEFT);
      $bid=$this->input->post("bid");
      $vid=$this->input->post("vid");
      $userid=$this->input->post("userid");
      $pmethod=$this->input->post("paymentmethod");

      if($pmethod=="cash"){
        $paymentbank="";
      }else{
        $paymentbank=$this->input->post("paymentbank");
      }
      
      $data = array(
                  'payment_method'=>$pmethod,
                  'bank_name'=>$paymentbank,
                  'reference_date'=>$this->input->post("reference_date"),
                  'confirm_date'=>date('Y-m-d'),
                  'status' => "1"
                );
      $this->db->where('id',$bid);
      $this->db->update("bookings",$data);

      $vehidata = array(
                  'status' => "1"
                );
      $this->db->where('id',$vid);
      $this->db->update("car_details",$vehidata);

      
      $data = array(
                  'user_id'=>$userid,
                  'vehicle_id'=>$vid,
                  'booking_id'=>$bid,
                  'invoice_name'=>$invoicename,
                  'invoice_date'=>date('Y-m-d'),
                  'status'=>'1'
                );
      $invoicedata=$this->db->query("SELECT * FROM invoice WHERE booking_id=$bid")->row();
      if(!empty($invoicedata)){
        $this->db->where('id',$bid);
        $this->db->update("invoice",$data);
      }else{
        $this->db->insert("invoice",$data);
      }      

      echo json_encode(array("status" => TRUE));

    }

    function update_userstatus()
    {
      $id=$this->input->post("id");
      $data = array(
                  'role' => "dealer"
                );
      $this->db->where('id',$id);
      $this->db->update("users",$data);

      echo json_encode(array("status" => TRUE));
    }

    function cancel_userstatus()
    {
      $id=$this->input->post("id");
      $data = array(
                  'role' => ""
                );
      $this->db->where('id',$id);
      $this->db->update("users",$data);

      echo json_encode(array("status" => TRUE));
    }

    function update_password()
    {
      $this->form_validation->set_rules('password', 'New Password', 'required');
      $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
      $id=$this->input->post("id");

      $data = array(
                  'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                  'created_date' => date('Y-m-d')
              ); 
      $this->db->where('id',$id);
      $this->db->update("users",$data);      

      echo "<script>
                alert('Successfully Updated your password');        
            </script>";
      redirect('dashboard/setting',"refresh");
    }    
     
    function user_resetpassword()
    {
        $email=$this->input->post("email");

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(array('email'=>$email));
        $query=$this->db->get();
        $user=$query->row();

        if($user){            
                 
            $this->email->from("sfleasing22@gmail.com","Sfleasing");
            $this->email->to($email);
            $this->email->reply_to($email);
            $this->email->subject("Get Your Password");
            $this->email->message("Thanks for contacting regarding to forgot password and Password Here- ");           
            if($this->email->send())
               {
                  echo "<script>
                      alert('Successfully Sent Your Email');        
                  </script>";
                  redirect('dashboard/forgotpassword',"refresh");
               }
               else
              {
               show_error($this->email->print_debugger());
              }
        }
    }

    function update_users()
    {
        $this->_validate();
        $post = $this->input->post();
        $id=$this->input->post("id");

        $password=$post['password'];
        if(!empty($password)){
            $data = array(
                  "first_name" => $this->input->post("firstname"),
                  "last_name" => $this->input->post("lastname"),
                  "phone" => $this->input->post("phone"),
                  "email" => $this->input->post("email"),
                  "password" => password_hash($password, PASSWORD_DEFAULT),
                  "role" => $this->input->post("role")
              );
        }else{
            $data = array(
                  "first_name" => $this->input->post("firstname"),
                  "last_name" => $this->input->post("lastname"),
                  "phone" => $this->input->post("phone"),
                  "email" => $this->input->post("email"),
                  "role" => $this->input->post("role")
              );
        }
         
        $this->db->where('id',$id);
        $this->db->update("users",$data);

        redirect("dashboard/users");
        
    }
    function update_dealerapprove()
    {
        $id=$this->input->post("id");        
        if(!empty($this->input->post("password"))){
            $password=$this->input->post("password");
        }
        else{
            $password="12345";
        }
        $data = array(
                "password"=>password_hash($password, PASSWORD_DEFAULT),
                "status"=>"2"
              );
        $this->db->where('id',$id);
        $this->db->update("users",$data);
        $users = $this->db->query("SELECT * FROM users WHERE id = '$id'")->row();
        $baseurl=base_url();
        $userdata = array(
                    "email"=>$users->email,
                    "username"=>$users->first_name,
                    "password"=>$password,
                    "base_url"=>$baseurl
                    );

        $useremail=$users->email;
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
            
            $this->email->subject("Congratualtion ! - Sfleasing approved you as dealer role with ".$mail);
            $body = $this->load->view('dealerapprovemail.php',$userdata,TRUE);
            $this->email->message($body); 
            $this->email->send();
            
            redirect("dashboard/users");        
    }
    function update_vehicleapprove()
    {
        $id=$this->input->post("id");  
        $data=array(
            "show_status"=>"1"
        );
        $this->db->where('id',$id);
        $this->db->update("car_details",$data);
        redirect("dashboard/allvehicles");
    }
    function update_vehiclecancel()
    {
        $id=$this->input->post("id");  
        $data=array(
            "show_status"=>"0"
        );
        $this->db->where('id',$id);
        $this->db->update("car_details",$data);
        redirect("dashboard/allvehicles");
    }


// Delete
    function delete_vehicles()
    {
      $id=$this->uri->segment(3);
      $postby=$this->session->userdata('role');
      $this->db->where('id',$id);
      $this->db->delete("car_details");
      if($postby=="admin"){
        redirect("dashboard/allvehicles");
      }else if($postby=="admin"){
        redirect("dashboard/vehicles");
      }
      
    }
    function delete_brands()
    {
      $id=$this->uri->segment(3);
      $this->db->where('id',$id);
      $this->db->delete("brands");
      redirect("dashboard/brands");
    }
    function delete_bodytype()
    {
      $id=$this->uri->segment(3);
      $this->db->where('id',$id);
      $this->db->delete("body_type");
      redirect("dashboard/functions");
    }
    function delete_fueltype()
    {
      $id=$this->uri->segment(3);
      $this->db->where('id',$id);
      $this->db->delete("fuel_type");
      redirect("dashboard/functions");
    }
    function delete_business()
    {
      $id=$this->uri->segment(3);
      $this->db->where('id',$id);
      $this->db->delete("business");
      redirect("dashboard/business");
    }
    function delete_promotext()
    {
      $id=$this->uri->segment(3);
      $this->db->where('id',$id);
      $this->db->delete("promotion");
      redirect("dashboard/functions");
    }
    function delete_howitwork()
    {
      $id=$this->uri->segment(3);
      $this->db->where('id',$id);
      $this->db->delete("how_works");
      redirect("dashboard/howitworks");
    }
    function delete_faq()
    {
      $id=$this->uri->segment(3);
      $this->db->where('id',$id);
      $this->db->delete("faq");
      redirect("dashboard/faq");
    }
    function delete_features()
    {
      $id=$this->uri->segment(3);
      $this->db->where('id',$id);
      $this->db->delete("features");
      redirect("dashboard/features");
    }
    function delete_services()
    {
      $id=$this->uri->segment(3);
      $this->db->where('id',$id);
      $this->db->delete("services");
      redirect("dashboard/services");
    }
    function delete_galleryImage()
    {
      $id=$this->uri->segment(3);
      $vid=$this->uri->segment(4);
      $this->db->where('id',$id);
      $this->db->delete("vehicle_photos");
      redirect("dashboard/car_detail/".$vid);
    }
    function delete_bookings()
    {
      $id=$this->uri->segment(3);
      $this->db->where('id',$id);
      $this->db->delete("bookings");
      redirect("dashboard/booking/");
    }
    function delete_users()
    {
      $id=$this->uri->segment(3);
      $this->db->where('id',$id);
      $this->db->delete("users");
      redirect("dashboard/users/");
    }

    function delete_invoice()
    {
      $id=$this->uri->segment(3);
      $this->db->where('id',$id);
      $this->db->delete("invoice");
      redirect("dashboard/allinvoices/");
    }

    function _do_upload()
    {
        $this->load->helper('file'); 
        $this->load->library('upload'); 
                
        $config['upload_path']          = 'upload/files/';
        $config['allowed_types']        = 'jpg|png|jpeg';   
        $config['remove_spaces']=TRUE;

        if(!file_exists($config['upload_path'])){
            mkdir($config['upload_path'], 0777);
        }
        $this->upload->initialize($config);
 
       if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
    function _do_upload_cover()
    {
        $this->load->helper('file'); 
        $this->load->library('upload'); 
                
        $config['upload_path']          = 'upload/files/';
        $config['allowed_types']        = 'jpg|png|jpeg';   
        $config['remove_spaces']=FALSE;         
        
        $this->upload->initialize($config);
 
        if(!$this->upload->do_upload('cover')) //upload and validate
            {
                $data['inputerror'][] = 'cover';
                $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error  
                $err=$this->upload->display_errors();
                // if($err){
                //     echo "
                //     <script>
                //         alert('Your image file type is not allowed !');
                //     </script>
                //     ";
                // }

                
                $this->session->set_flashdata( 'error_msg', $this->upload->display_errors() );
                
              }
        return $this->upload->data('file_name');
    }
    function _do_upload_document()
    {
        $this->load->helper('file'); 
        $this->load->library('upload'); 
                
        $config['upload_path']          = 'upload/files';
        $config['allowed_types']        = 'pdf|docx|xlsx|csv|xls|ods';   
        $config['remove_spaces']=TRUE; 
        
        
        $this->upload->initialize($config);
 
       if(!$this->upload->do_upload('document')) //upload and validate
            {
                $data['inputerror'][] = 'document';
                $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');           
                
              }
        return $this->upload->data('file_name');
    }
    function vehicles_search()
    {
        $role=$this->session->userdata("role");
        $data["getfueltype"] =$this->Main_model->getfueltype();  
        $data["getbodytype"] =$this->Main_model->getbodytype();  
        $data["getfeatures"] =$this->Main_model->getfeatures();  
        $data["getcategory"] =category_list();
        $data["durationlist"] =$this->Main_model->getdurationlist(); 

        if($this->input->post('submit')==true)
              {
                $search_text =$this->input->post("search_text");
                $userdata=array(
                      'search_text'=>$search_text);
                $this->session->set_userdata($userdata);

              }
        else
              {
                  $search_text=$this->session->userdata("search_text");          
              }
        if($this->uri->segment(3))
        {
            $start=$this->uri->segment(3);
        }
        else
        {
            $start=0;
        }
        $config["base_url"]=base_url()."dashboard/vehicles_search/"; 
        

        if(!empty($search_text))
        {
            if($role=="admin"){
                $row = $this->db->query("Select * from car_details where model_name LIKE'%$search_text%' OR brand_name LIKE'%$search_text%'");

            }else if($role=="dealer"){
                $row = $this->db->query("Select * from car_details where model_name LIKE'%$search_text%' AND post_by='$role'");
            }
            
        }
        elseif(empty($search_text))
        {
            if($role=="admin"){
                $row = $this->db->query("Select * from car_details");
            }else if($role=="dealer"){
                $row = $this->db->query("Select * from car_details where post_by='$role'");
            }
            
        }
        $config['total_rows'] =$row->num_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['num_links'] = 3;
        $config['full_tag_open'] = '<ul class="pagegi">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a class="current">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['next_link'] = 'Next';  
        $this->pagination->initialize($config);
        if(!empty($search_text))
        {
            if($role=="admin"){
                $query = $this->db->query("SELECT * FROM car_details WHERE model_name LIKE'%$search_text%' OR brand_name LIKE '%$search_text%' ORDER BY id DESC limit ".$start.",".$config['per_page']);
            }else{
                $query = $this->db->query("SELECT * FROM car_details WHERE post_by='$role' AND model_name LIKE'%$search_text%' ORDER BY id DESC limit ".$start.",".$config['per_page']);
            }
            
        }
        elseif(empty($search_text))
        {
            redirect('dashboard/allvehicles');
        }
        

        if($query->num_rows()>=1)
        {
            if($this->uri->segment(3))
                          {
                              $start=$this->uri->segment(3);
                              $i=$start+1;
                              
                          }
                          else
                          {
                              $i=1;
                          }
                      $data['i']=$i;
                      
            $data["content"]="vehiclesearch_result";
            $data["searchlists"]=$query;            
            $this->load->view("template",$data);
        }
        else{
          $data["content"]="nodata";
          $data["message"]="No result found match with your search";
          $this->load->view("template",$data);
        }
    }
    
    
    public function generateinvoicepdf(){
        
        $id=$this->uri->segment(3);  
        $ivono=$this->uri->segment(4);      
        $data["invoiceinfo"]=$this->db->query("SELECT users.first_name as fname,users.last_name as lname,users.email as useremail,bookings.billing_address1 as billaddress,bookings.billing_phone as billphone,car_details.model_name as modelname,bookings.duration as bookingduration,bookings.subscription_price,bookings.total_amt as total_amt,bookings.delivery_remark,invoice.invoice_date,invoice.invoice_name FROM invoice LEFT JOIN bookings ON bookings.id = invoice.booking_id LEFT JOIN users ON users.id=invoice.user_id LEFT JOIN car_details ON car_details.id=invoice.vehicle_id WHERE invoice.id = $id")->row();  

        $pdf_view=$this->load->view('invoicedownload',$data, true);
        $pdfFilePath = 'InvoiceNo-'.$ivono.'.pdf';
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($pdf_view);
        $this->m_pdf->pdf->Output($pdfFilePath, "I"); 
    }
    public function sendinginvoice()
      {
        $email=$this->input->post('email');
        $fullname=$this->input->post('fullname');
        $subject=$this->input->post('subject');
      //      $cvattach=$this->input->post('cvattach');
      $cvattach=$_FILES['cvattach']['tmp_name'];
        $this->load->library('email');

        $this->email->from($email, $fullname);
        $this->email->to('sfleasing22@gmail.com');
        /*$this->email->cc('another@another-example.com');
        $this->email->bcc('them@their-example.com');*/

        $this->email->subject($subject);
        $this->email->attach($cvattach);
        $this->email->send();
      }
    function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;  


        if($data['status'] === FALSE)
        {
          echo json_encode($data);
          exit();
        }
    }
    
    function register()
      {
        $post = $this->input->post();

        if(!empty($post)) {
            if(!$is_exist) {
                      $user = array(
                          "first_name" => $post["name"],
                          "email" => $post["email"],
                          "password" => password_hash($post["password"], PASSWORD_DEFAULT),
                      );
                      $this->db->select('*');
                      $this->db->from('users');
                      $this->db->where(array('email'=>$email));
                      $query=$this->db->get();

                      if($query->num_rows()==1)
                      { 
                        echo "<script>
                          alert('Already Registered!');
                          window.location.href='http://admin.everestauto.com.sg/dashboard/users';
                          </script>"; 
                      }else{
                        $this->db->insert("users", $user);
                        $this->session->set_flashdata('success', 'User has been created.');
                      }
                
            } else {
                $this->session->set_flashdata('error', 'Email already exists.');
            }

        }
        redirect('/');
      }
    function user_login()
      {  
        $email=$this->input->post("email");
        $password=$this->input->post("password");
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(array('email'=>$email,'role'=>'admin'));
        $adminquery=$this->db->get();

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(array('email'=>$email,'role'=>'dealer'));
        $dealerquery=$this->db->get();

        if($adminquery->num_rows()==1)
        {
            $admin=$adminquery->row();

            if($admin) {

                    $verify = password_verify($password, $admin->password);
                      if($verify) {
                          $data=array(
                                  'id'=>$admin->id,
                                  'name'=>$admin->first_name.' '.$admin->last_name,
                                  'email'=>$admin->email,
                                  'password'=>$admin->password,
                                  'role'=>$admin->role
                                );
                              $this->session->set_userdata($data); 
                                
                                redirect("dashboard/allvehicles","refresh");
                    }else
                    {
                       echo "<script>
                      alert('Username and Password do not match!');
                      
                      </script>";
                      redirect('/',"refresh");
                    }
              }
        }
        else if($dealerquery->num_rows()==1)
        {
            $dealer=$dealerquery->row();

            if($dealer) {

                    $verify = password_verify($password, $dealer->password);
                      if($verify) {
                          $data=array(
                                  'id'=>$dealer->id,
                                  'name'=>$dealer->first_name.' '.$dealer->last_name,
                                  'email'=>$dealer->email,
                                  'password'=>$dealer->password,
                                  'role'=>$dealer->role
                                );
                              $this->session->set_userdata($data); 
                                
                              redirect("dashboard/allvehicles","refresh");
                    }else
                    {
                       echo "<script>
                      alert('Username and Password do not match!');
                      
                      </script>";
                      redirect('/',"refresh");
                    }
              }
        }


        else
              {
                 echo "<script>
                alert('No User!');
                
                </script>";
                redirect('/',"refresh");
              }
        
      }      
      
    function logout()
      {
          session_destroy();
          redirect('dashboard/',"refresh");
      }

}

?>