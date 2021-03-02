<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

 class Api extends REST_Controller {

 function __construct($config = 'rest')
 {  
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    ini_set('error_reporting', E_STRICT);
    parent::__construct($config);
    $this->load->helper('date');
    $this->load->helper('text');
    $this->load->library('upload');
    $this->load->helper('url');
    $this->load->helper('main_helper');
    $this->load->library('form_validation');
 }

 /*......... Login Api For Restaurant ---- */
        public function login_post()  
     {
        $response = new StdClass();
        $result = new StdClass();
        $mobile_no = $this->input->post('mobile_no');
        $device_id=$this->input->post('device_id');
        $notification_id=$this->input->post('notification_id');
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        exit();
       $query= $this->db->get_where('tbl_admin', array('mobile_no' => $mobile_no , 'status' => '1'));
       $query2= $this->db->get_where('tbl_admin', array('mobile_no' => $mobile_no , 'status' => '0'));

       $query1= $this->db->get_where('tbl_restaurant_staff_registration', array('mobile_no' => $mobile_no , 'status' => '1'));
       $num_rows5=$query2->num_rows();
         /*   $query=$this->db->get();*/
            $num_rows=$query->num_rows();
            $current_data=$query->result_array();
            $num_rows1=$query1->num_rows();
            $current_data1=$query1->result_array();
            $data1->device_id = $device_id;
            $data1->notification_id = $notification_id;
            $data1->login_time=$now;
            if(!empty($mobile_no))
            {

             if(!empty($current_data))
            {
             foreach ($current_data as $row)
            { 
              $otpValue=mt_rand(1000, 9999);
              $data1->device_id = $device_id;
              $data1->notification_id = $notification_id;
              $data1->login_time=$now;
              $data1->name=$row['user_fullname'];
              $data1->mobile_no=$row['mobile_no'];
              $data1->user_type='admin';
              $user_type='admin';
              $data1->otp=$otpValue;
              $res3 = $this->Supervisor->send_otp($mobile_no,$otpValue);
              if($res3!='')
              {
              $res4 = $this->Supervisor->otpgetdata($data1);
              }
              $res = $this->Supervisor->manage_login_data($data1);

             /* $res3 = $this->Deliveryboy->send_otp($mobile_no,$otpValue);
              if($res3!='')
              {
              $res4 = $this->Deliveryboy->otpgetdata($data1);
              }*/
              $data['admin_id'] =  $row['admin_id'];
              $data['name'] =  $row['user_fullname'];
              $data['mobile_no'] =  $row['mobile_no'];
              $data['user_type'] =  $user_type;
              $data['message']='success';
              $data['status']  ='1';
              array_push($result,$data);
             }
              $response->data = $result;
           }

           else if(!empty($current_data1))
           {

           
           /* else
            {
              $data['active_status']='0';
              $data['status']  ='1';
              array_push($result,$data);
            }*/
             foreach ($current_data1 as $row1)
            { 
              $otpValue=mt_rand(1000, 9999);
              $data1->device_id = $device_id;
              $data1->notification_id = $notification_id;
              $data1->login_time=$now;
              $data1->name=$row1['name'];
              $data1->mobile_no=$row1['mobile_no'];
              $mobile_no=$row1['mobile_no'];
              $data1->user_type=$row1['user_type'];
              $user_type=$row1['user_type'];
              $data1->otp=$otpValue;
              $res3 = $this->Supervisor->send_otp($mobile_no,$otpValue);
              if($res3!='')
              {
              $res4 = $this->Supervisor->otpgetdata($data1);
              }
              $res = $this->Supervisor->manage_login_data($data1);

              /*$res3 = $this->Deliveryboy->send_otp($mobile_no,$otpValue);
              if($res3!='')
              {
              $res4 = $this->Deliveryboy->otpgetdata($data1);
              }*/
              $data['admin_id'] =  $row1['admin_id'];
              $data['name'] =  $row1['name'];
              $data['mobile_no'] =  $row1['mobile_no'];
              $data['user_type'] =  $user_type;
              $data['message']='success';
              $data['status']  ='1';
              array_push($result,$data);
               $response->data = $result;
             }
           }
           else if ($num_rows5>0)
           {
             $data->status ='2';
            $data->message = 'Your number has been blocked';
            array_push($result,$data);
            $response->data = $data;
           }
           else
           {
            $otpValue=mt_rand(1000, 9999);
             $data2->mobile_no=$mobile_no;
             $data3->device_id = $device_id;
             $data3->notification_id = $notification_id;
             $data3->mobile_no=$mobile_no;
             $data3->otp=$otpValue;
             $res3 = $this->Supervisor->send_otp($mobile_no,$otpValue);
             if($res3!='')
            {
              $res4 = $this->Supervisor->otpgetdata($data3);
            }
              $data['admin_id'] = '';
              $data['name'] =  '';
              $data['mobile_no'] =$mobile_no;
              $data['user_type'] =  '';
              $data['message']='success';
              $data['status']  ='1';
               array_push($result , $data);
               $response->data = $data;

           }
          }
         else
          {
                $data['message']='failed';
                $data['status']  ='0';
                array_push($result , $data);
          }
                 $response->data = $data;

                 echo json_output($response);
           }
        
    /*.........Login Api For Deliveryboy  Hawker ---- */

      /*.........order change by staff Api for Restaurant ---- */
  public function order_update_by_staff_post()
  {
    $response = new StdClass();
    $result = new StdClass();
    $order_id = $this->input->post('order_id');
    $admin_id = $this->input->post('admin_id');
    $table_no=$this->input->post('table_no');
    $menu_item_name=$this->input->post('menu_item_name');
    /*$new_menu_item_name=$this->input->post('new_menu_item_name');*/
    $quantity=$this->input->post('quantity');
    $menu_price=$this->input->post('menu_price');
    $total_item=$this->input->post('total_item');
    $total_price=$this->input->post('total_price');
    $gst_amount=$this->input->post('gst_amount');
   /* $gst_amount_price=$this->input->post('gst_amount_price');
    $net_pay_amount=$this->input->post('net_pay_amount');*/
    $order_status = $this->input->post('order_status');
    $order_change_by=$this->input->post('order_change_by');
    $slip_status=$this->input->post('slip_status');

    $data->order_id = $order_id;
    $data->admin_id = $admin_id;
    $data->table_no = $table_no;
    $data->menu_item_name = $menu_item_name;
    /*$data->new_menu_item_name = $new_menu_item_name;*/
    $data->quantity = $quantity;
    $data->menu_price = $menu_price;
    $data->total_item = $total_item;
    $data->total_price = $total_price;
    $data->gst_amount = $gst_amount;
   /* $gst_amount_price=$this->input->post('gst_amount_price');
    $net_pay_amount=$this->input->post('net_pay_amount');*/
    $data->order_status= $order_status;
    $data->order_change_by=$order_change_by;
    $data->slip_status=$slip_status;
    $result1 = $this->Supervisor->order_update_for_customer_by_staff($data);
    if(!empty($order_id))
    {
      $data1->status ='1';
      $data1->message = 'order successfully update';
      array_push($result,$data1);
      $response->data = $data1;
    }
    else
    {
      $response->status ='0';
      $response->message = 'register failed';
    }
    echo json_output($response);
    }
     /*.........order change by staff Api for Restaurant  ---- */
    /* public function order_updatesss_by_staff_post()
  {
    $response = new StdClass();
    $result = new StdClass();
    $order_id = $this->input->post('order_id');
    $admin_id = $this->input->post('admin_id');
    $table_no=$this->input->post('table_no');
    $menu_item_name=$this->input->post('menu_item_name');
    $new_menu_item_name=$this->input->post('new_menu_item_name');
    $quantity=$this->input->post('quantity');
    $menu_price=$this->input->post('menu_price');
    $total_item=$this->input->post('total_item');
    $total_price=$this->input->post('total_price');
    $gst_amount=$this->input->post('gst_amount');
    $gst_amount_price=$this->input->post('gst_amount_price');
    $net_pay_amount=$this->input->post('net_pay_amount');
    $order_status = $this->input->post('order_status');
    $order_change_by=$this->input->post('order_change_by');
    $slip_status=$this->input->post('slip_status');

    $data->order_id = $order_id;
    $data->admin_id = $admin_id;
    $data->table_no = $table_no;
    $data->menu_item_name = $menu_item_name;
    $data->new_menu_item_name = $new_menu_item_name;
    $data->quantity = $quantity;
    $data->menu_price = $menu_price;
    $data->total_item = $total_item;
    $data->total_price = $total_price;
    $data->gst_amount = $gst_amount;
    $data->gst_amount_price=$gst_amount_price;
    $data->net_pay_amount=$net_pay_amount;
    $data->order_status= $order_status;
    $data->order_change_by=$order_change_by;
    $data->slip_status=$slip_status;
    $result1 = $this->Supervisor->order_update_for_customer_by_staffsss($data);
    if(!empty($order_id))
    {
      $data1->status ='1';
      $data1->message = 'order successfully update';
      array_push($result,$data1);
      $response->data = $data1;
    }
    else
    {
      $response->status ='0';
      $response->message = 'register failed';
    }
    echo json_output($response);
    }*/
      /*.......get_detail_for_particular_order_for_staff For Restaurant ---- */
    /* public function get_detail_for_particular_order_for_staff_post()
      {
       $response = new StdClass();
        $result2 = new StdClass();
        $order_id=$this->input->post('order_id');
        $order_detail_for_restaurant = $this->Supervisor->get_order_detail_for_staff($order_id);
        $order_id=$order_detail_for_restaurant->order_id;
        $admin_id=$order_detail_for_restaurant->admin_id;
        $cus_id=$order_detail_for_restaurant->cus_id;
        $table_no=$order_detail_for_restaurant->table_no;
        $menu_item_name=$order_detail_for_restaurant->menu_item_name;
        $quantity=$order_detail_for_restaurant->quantity;
        $half_and_full_status=$order_detail_for_restaurant->half_and_full_status;
        $menu_price=$order_detail_for_restaurant->menu_price;
        $total_item=$order_detail_for_restaurant->total_item;
        $total_price=$order_detail_for_restaurant->total_price;
        $gst_amount=$order_detail_for_restaurant->gst_amount;
        $gst_amount_price=$order_detail_for_restaurant->gst_amount_price;
        $net_pay_amount=$order_detail_for_restaurant->net_pay_amount;
        $order_status=$order_detail_for_restaurant->order_status;
        $payment_status=$order_detail_for_restaurant->payment_status;
        $customer_mobile_no=$order_detail_for_restaurant->customer_mobile_no;
        if(!empty($order_detail_for_restaurant))
        {
           $data2->order_id =$order_id;
           $data2->admin_id =$admin_id;
           $data2->cus_id =$cus_id;
           $data2->table_no =$table_no;
           $data2->menu_item_name =$menu_item_name;
           $data2->quantity =$quantity;
           $data2->half_and_full_status =$half_and_full_status;
           $data2->menu_price =$menu_price;
           $data2->total_item =$total_item;
           $data2->total_price =$total_price;
           $data2->gst_amount =$gst_amount;
           $data2->gst_amount_price =$gst_amount_price;
           $data2->net_pay_amount =$net_pay_amount;
           $data2->order_status =$order_status;
           $data2->payment_status =$payment_status;
           $data2->customer_mobile_no =$customer_mobile_no;

           $data2->message ='success';
            $data2->status ='1';
            array_push($result2,$data2);
            $response->data = $data2;
         }
         else
         {
             $data2->status ='0';
              $data2->message = 'failed';
              array_push($result2,$data2);
              $response->data = $data2;
         }
           
           echo json_output($response);
        }*/

      /*..........Get particular order detail  For Restaurant  ---- */
    
   /*.........Admin Registration  Api  ---- */
    public function admin_registration_post()
    {   

        $response = new StdClass();
        $result2 = new StdClass();
        $name=$this->input->post('name');
        $restaurant_name=$this->input->post('restaurant_name');
        $mobile_no=$this->input->post('mobile_no');
        $email=$this->input->post('email');
        $device_id=$this->input->post('device_id');
        $notification_id=$this->input->post('notification_id');
        $user_password=$this->input->post('user_password');
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $data->name=$name;
        $data->mobile_no=$mobile_no;
        $data->email=$user_email;
        $data->user_createdate=$now;

        $que=$this->db->query("select * from tbl_admin where mobile_no='".$mobile_no."'");

        $quedata=$this->db->query("select * from tbl_restaurant_staff_registration where mobile_no='".$mobile_no."'");

        $row = $que->num_rows();

        $row1 = $quedata->num_rows();

       if($row>0)
         {
            $data1->status ='2';
            $data1->message = 'This Number already exists';
            array_push($result2,$data1);
            $response->data = $data1;
         }

         else if($row1>0)
         {
            $data1->status ='2';
            $data1->message = 'This Number already exists';
            array_push($result2,$data1);
            $response->data = $data1;
         }
         else
         {
          date_default_timezone_set('Asia/kolkata'); 
          $now = date('Y-m-d H:i:s');
          $data->name=$name;
          $data->restaurant_name=$restaurant_name;
          $data->mobile_no=$mobile_no;
          $data->user_password=$user_password;
          $data->email=$email;
          $data->user_role='2';
          $data->user_active='1';
          $data->user_createdate=$now;
          $data->status='1';
          $result = $this->Supervisor->admin_registration($data);
          $alphanumerric='ADMIN_0000'.$result;
          $data1->device_id = $device_id;
          $data1->notification_id = $notification_id;
          $data1->login_time=$now;
          $data1->name=$name;
          $data1->mobile_no=$mobile_no;
          $data1->user_type='admin';
          $updatedata = $this->Supervisor->update_admin_id($alphanumerric,$result);
          $res = $this->Supervisor->manage_login_data($data1);
          if(!empty($result))
          {  
              $data2->name=$name;
              $data2->mobile_no=$mobile_no;
              $data2->user_type='admin';
              $data2->admin_id=$alphanumerric;
              $data2->status ='1';
              $data2->message = 'register Successfully';
              array_push($result2,$data2);
              $response->data = $data2;
          }
          else
          {
              $data2->status ='0';
              $data2->message = 'register failed';
              array_push($result2,$data2);
              $response->data = $data2;
          }
      }
       
      echo  json_output($response);
    }
   /*.........Admin  Registration  Api  ---- */

    /*.........staff Registration  Api  ---- */
    public function staff_registration_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
        $name=$this->input->post('name');
        $admin_id=$this->input->post('admin_id');
        $mobile_no=$this->input->post('mobile_no');
        $email=$this->input->post('email');
        $device_id=$this->input->post('device_id');
        $notification_id=$this->input->post('notification_id');
        $date_of_birth=$this->input->post('date_of_birth');
        $aadhar_no=$this->input->post('aadhar_no');
        $pan_number=$this->input->post('pan_number');
        $desingination=$this->input->post('desingination');
        $gender=$this->input->post('gender');
        $permanent_address=$this->input->post('permanent_address');
        $current_address=$this->input->post('current_address');
        $user_type=$this->input->post('user_type');

        $que=$this->db->query("select * from tbl_admin where mobile_no='".$mobile_no."'");

        $quedata=$this->db->query("select * from tbl_restaurant_staff_registration where mobile_no='".$mobile_no."'");

        $row = $que->num_rows();

        $row1 = $quedata->num_rows();

       if($row>0)
         {
            $data1->status ='2';
            $data1->message = 'This Number already exists';
            array_push($result2,$data1);
            $response->data = $data1;
         }

         else if($row1>0)
         {
            $data1->status ='2';
            $data1->message = 'This Number already exists';
            array_push($result2,$data1);
            $response->data = $data1;
         }
         else
         {
          date_default_timezone_set('Asia/kolkata'); 
          $now = date('Y-m-d H:i:s');

          $data->admin_id=$admin_id;
          $data->name=$name;
          $data->admin_id=$admin_id;
          $data->mobile_no=$mobile_no;
          $data->email=$email;
          $data->date_of_birth=$date_of_birth;
          $data->aadhar_no=$aadhar_no;
          $data->pan_number=$pan_number;
          $data->desingination=$desingination;
          $data->gender=$gender;
          $data->permanent_address=$permanent_address;
          $data->current_address=$current_address;
          $data->user_type=$user_type;
          $data->create_date=$now;
          $data->status='1';
          $result = $this->Supervisor->staff_registration($data);
          $data1->device_id = $device_id;
          $data1->notification_id = $notification_id;
          $data1->login_time=$now;
          $data1->name=$name;
          $data1->mobile_no=$mobile_no;
          $data1->user_type=$user_type;
          $res = $this->Supervisor->manage_login_data($data1);
          if(!empty($result))
          {  
              $data2->admin_id =$admin_id;
              $data2->name =$name;
              $data2->mobile_no =$mobile_no;
              $data2->user_type =$user_type;
             
              $data2->status ='1';
              $data2->message = 'register Successfully';
              array_push($result2,$data2);
              $response->data = $data2;
          }
          else
          {
              $data2->status ='0';
              $data2->message = 'register failed';
              array_push($result2,$data2);
              $response->data = $data2;
          }
      }
       
      echo  json_output($response);
    }
   /*.........Admin  Registration  Api  ---- */

   /*.........Add restaurant  for Restaurant Api  ---- */
    public function add_restaurant_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
       
      if($this->form_validation->run('addRestaurent')==FALSE)
      {
              $data2->status ='0';
              $data2->message = 'failed';
              $data->error=validation_errors();
              array_push($result2,$data2);
              $response->data = $data2;
              echo validation_errors();exit;
              echo  json_output($response);exit;
      }else{
        // $target_dir ="uploads/";
        // $time='restaurant_'.date('Ymd')."_".date('His');
        $name=$this->input->post('name');
        // $fileName=$_FILES["image"]['name'];
        // // print_r($_FILES);exit;
        // $name=preg_replace("/\.[^.]+$/", "", $fileName);
        // $restaurant_image=str_replace($name,$time,$fileName);
        // $target_file = $target_dir.$restaurant_image;
        // $upload=move_uploaded_file($_FILES["image"]['tmp_name'],$target_file);
        // file_put_contents("myFile.txt",$_FILES["image"]);exit;
        $image=$this->input->post('image');
        $lat=$this->input->post('lat');
        $lng=$this->input->post('lng');
        $location=$this->input->post('location');
        $cuisines=$this->input->post('cuisines');
        $gst_no=$this->input->post('gst_no');
        $pan_no=$this->input->post('pan_no');
        $cost=$this->input->post('cost');
        $openStatus=$this->input->post('openStatus');
        $openingTime=$this->input->post('openingTime');
        $closingTime=$this->input->post('closingTime');
        $phone=$this->input->post('phone');
        $address=$this->input->post('address');
        $amenities=$this->input->post('amenities');
        $verified=$this->input->post('verified');
        $city=$this->input->post('city');
        $trending=$this->input->post('trending');
        $admin_id=$this->input->post('admin_id');
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $data->name=$name;
        $data->image=$image;
        $data->lat=$lat;
        $data->lng=$lng;
        $data->location=$location;
        $data->gst_no=$gst_no;
        $data->pan_no=$pan_no;
        $data->cuisines=$cuisines;
        $data->cost=$cost;
        $data->openStatus=$openStatus;
        $data->openingTime=$openingTime;
        $data->closingTime=$closingTime;
        $data->phone=$phone;
        $data->address=$address;
        $data->amenities=$amenities;
        $data->verified=$verified;
        $data->city=$city;
        $data->trending=$trending;
        $data->admin_id=$admin_id;
        $data->create_date=$now;
        $result = $this->Supervisor->add_restaurant($data);
        
        if(!empty($result))
        {  
            $data2->status ='1';
            $data2->message = ' Restaurant add Successfully';
            array_push($result2,$data2);
            $response->data = $data2;
        }
          else
          {
              $data2->status ='0';
              $data2->message = 'failed';
              array_push($result2,$data2);
              $response->data = $data2;
          }
      
       
      echo  json_output($response);
      }
    }

   /*........add restaurant For Restaurant ---- */

   /*.........Add menu for  restaurant  for Restaurant Api  ---- */
    public function add_menu_item_for_restaurant_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
        $admin_id=$this->input->post('admin_id');
        $menu_food_type=$this->input->post('menu_food_type');
        $menu_name=$this->input->post('menu_name');
        $menu_image=$this->input->post('menu_image');
        $menu_detail=$this->input->post('menu_detail');
        $menu_half_price=$this->input->post('menu_half_price');
        $menu_full_price=$this->input->post('menu_full_price');
        $menu_fix_price=$this->input->post('menu_fix_price');
        $nutrient_counts=$this->input->post('nutrient_counts');

        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $data->admin_id=$admin_id;
        $data->menu_food_type=$menu_food_type;
        $data->menu_name=$menu_name;
        $data->menu_image=$menu_image;
        $data->menu_detail=$menu_detail;
        $data->menu_half_price=$menu_half_price;
        $data->menu_full_price=$menu_full_price;
        $data->menu_fix_price=$menu_fix_price;
        $data->nutrient_counts=$nutrient_counts;
        $data->create_date=$now;
        $data->status='1';
        $result = $this->Supervisor->add_menu_item_restaurant($data);
         $alphanumerric='MENU_0000'.$result;
        $updatemenudata = $this->Supervisor->update_menu_id($alphanumerric,$result);
        if(!empty($result))
        {  
            $data2->status ='1';
            $data2->message = ' menu add Successfully';
            array_push($result2,$data2);
            $response->data = $data2;
        }
          else
          {
              $data2->status ='0';
              $data2->message = 'failed';
              array_push($result2,$data2);
              $response->data = $data2;
          }
      
       
      echo  json_output($response);
    }

   /*.........Role Api For Restaurant ---- */

   

   
/*.........Add menu for  restaurant  for Restaurant Api  ---- */
    public function get_restaurant_data_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
        $admin_id=$this->input->post('admin_id');
        
        $result = $this->Supervisor->get_restaurant_data($admin_id);
        $result1 = $this->Supervisor->check_data_for_restaurant($admin_id);
        $restaurant_name=$result->restaurant_name;
        if(!empty($result))
        {  
            $data2->restaurant_name =$restaurant_name;
            if(!empty($result1))
            {
               $data2->restaurant_status ='1';
            }
            else
            {
              $data2->restaurant_status ='0';
            }
            $data2->status ='1';
            $data2->message = 'Success';
            array_push($result2,$data2);
            $response->data = $data2;
        }
          else
          {
              $data2->status ='0';
              $data2->message = 'failed';
              array_push($result2,$data2);
              $response->data = $data2;
          }
      
       
      echo  json_output($response);
    }
   /*.........Role Api For Restaurant ---- */
     public function user_type_list_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $user_type = $this->Supervisor->get_user_type();
        if(!empty($user_type))
        {
         foreach ($user_type as $row)
           {
            $data['user_type'] =   $row['user_type'];
            $data['message'] = 'Success';
            $data['status']  ='1';

            array_push($result,$data);

           } 
            
              $response->data = $result;
         }
         else
         {
            $data['message'] = 'failed';
            $data['status']  ='0';
            array_push($result , $data);
         }
           $response->data = $result;
           echo json_output($response);
        }

      /*.........super sub Category   Api For hawker  ---- */

      /*.........notification list for staff in  Restaurant ---- */
     public function get_notification_list_for_order_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $staff_mobile_no=$this->input->post('staff_mobile_no');
        $get_notification_data = $this->Supervisor->get_notification_data($staff_mobile_no);
        if(!empty($get_notification_data))
        {
         foreach ($get_notification_data as $row)
           {
            $data['order_id'] =   $row['order_id'];
            $data['customer_mobile_no'] =   $row['customer_mobile_no'];
            $data['date_time'] =   $row['date_time'];
            $data['title'] =   $row['title'];
            $data['message'] =   $row['message'];
            $data['status']  ='1';

            array_push($result,$data);

           } 
            
              $response->data = $result;
         }
         else
         {
            $data['message'] = 'failed';
            $data['status']  ='0';
            array_push($result , $data);
         }
           $response->data = $result;
           echo json_output($response);
        }

      /*.........super sub Category   Api For hawker  ---- */

    /*........Get Restaurant Detail Api  For Restaurant ---- */
     public function get_detail_for_restaurant_data_post()
      {
       $response = new StdClass();
        $result2 = new StdClass();
        $admin_id=$this->input->post('admin_id');
        $detail_for_restaurant = $this->Supervisor->get_detail_for_restaurant($admin_id);
        $admin_id=$detail_for_restaurant->admin_id;
        $name=$detail_for_restaurant->name;
        $image=$detail_for_restaurant->image;
        $lat=$detail_for_restaurant->lat;
        $lng=$detail_for_restaurant->lng;
        $gst_no=$detail_for_restaurant->gst_no;
        if(empty($gst_no))
        {
          $gst_no_data='';
        }
        else
        {
          $gst_no_data=$gst_no;
        }
        $pan_no=$detail_for_restaurant->pan_no;
        if(empty($pan_no))
        {
          $pan_no_data='';
        }
        else
        {
          $pan_no_data=$pan_no;
        }
        $location=$detail_for_restaurant->location;
        $cuisines=$detail_for_restaurant->cuisines;
        $city=$detail_for_restaurant->city;
        $openStatus=$detail_for_restaurant->openStatus;
        $openingTime=$detail_for_restaurant->openingTime;
        $closingTime=$detail_for_restaurant->closingTime;
        $phone=$detail_for_restaurant->phone;
        $address=$detail_for_restaurant->address;
        $amenities=$detail_for_restaurant->amenities;
        $restaurant_name=$detail_for_restaurant->restaurant_name;
        if(!empty($detail_for_restaurant))
        {
           $data2->admin_id =$admin_id;
           $data2->name =$name;
           $data2->image =$image;
           $data2->lat =$lat;
           $data2->lng =$lng;
           $data2->gst_no =$gst_no_data;
           $data2->pan_no =$pan_no_data;
           $data2->location =$location;
           $data2->cuisines =$cuisines;
           $data2->city =$city;
           $data2->openStatus =$openStatus;
           $data2->openingTime =$openingTime;
           $data2->closingTime =$closingTime;
           $data2->phone =$phone;
           $data2->address =$address;
           $data2->amenities =$amenities;
           $data2->message ='success';
            $data2->status ='1';
            array_push($result2,$data2);
            $response->data = $data2;
         }
         else
         {
             $data2->status ='0';
              $data2->message = 'failed';
              array_push($result2,$data2);
              $response->data = $data2;
         }
           
           echo json_output($response);
        }

      /*.........Get Restaurant Detail Api  For Restaurant  ---- */
          /*........Get staff  Detail Api  For Restaurant ---- */
     public function get_staff_detail_for_restaurant_post()
      {
       $response = new StdClass();
        $result2 = new StdClass();
        $admin_id=$this->input->post('admin_id');
        $mobile_no=$this->input->post('mobile_no');
        $detail_for_restaurant = $this->Supervisor->get_staff_detail($admin_id,$mobile_no);
        $admin_id=$detail_for_restaurant->admin_id;
        $name=$detail_for_restaurant->name;
        $username=$detail_for_restaurant->username;
        $mobile_no=$detail_for_restaurant->mobile_no;
        $email=$detail_for_restaurant->email;
        $password=$detail_for_restaurant->password;
        $date_of_birth=$detail_for_restaurant->date_of_birth;
        $aadhar_no=$detail_for_restaurant->aadhar_no;
        $pan_number=$detail_for_restaurant->pan_number;
        $desingination=$detail_for_restaurant->desingination;
        $gender=$detail_for_restaurant->gender;
        $permanent_address=$detail_for_restaurant->permanent_address;
        $current_address=$detail_for_restaurant->current_address;
        $user_type=$detail_for_restaurant->user_type;
        if(empty($password))
        {
          $password_data='';
        }
        else
        {
          $password_data=$password;
        }
       
        if(empty($pan_number))
        {
          $pan_no_data='';
        }
        else
        {
          $pan_no_data=$pan_number;
        }
       
        if(!empty($detail_for_restaurant))
        {
           $data2->admin_id =$admin_id;
           $data2->name =$name;
           $data2->username =$username;
           $data2->mobile_no =$mobile_no;
           $data2->email =$email;
           $data2->password =$password_data;
           $data2->date_of_birth =$date_of_birth;
           $data2->aadhar_no =$aadhar_no;
           $data2->pan_number =$pan_no_data;
           $data2->desingination =$desingination;
           $data2->gender =$gender;
           $data2->permanent_address =$permanent_address;
           $data2->current_address =$current_address;
           $data2->user_type =$user_type;
           $data2->message ='success';
            $data2->status ='1';
            array_push($result2,$data2);
            $response->data = $data2;
         }
         else
         {
             $data2->status ='0';
              $data2->message = 'failed';
              array_push($result2,$data2);
              $response->data = $data2;
         }
           
           echo json_output($response);
        }

      /*.........Get Restaurant Detail Api  For Restaurant  ---- */
  /*.........menu Edit for restaurant Api  ---- */
  public function menu_update_post()
  {
    $response = new StdClass();
    $result = new StdClass();
    $menu_id = $this->input->post('menu_id');
    $admin_id = $this->input->post('admin_id');
    $menu_food_type=$this->input->post('menu_food_type');
    $menu_name=$this->input->post('menu_name');
    $menu_image=$this->input->post('menu_image');
    $menu_detail=$this->input->post('menu_detail');
    $menu_half_price=$this->input->post('menu_half_price');
    $menu_full_price=$this->input->post('menu_full_price');
    $menu_fix_price=$this->input->post('menu_fix_price');
    $nutrient_counts=$this->input->post('nutrient_counts');
   
    $data->menu_id = $menu_id;
    $data->admin_id = $admin_id;
    $data->menu_food_type = $menu_food_type;
    $data->menu_name = $menu_name;
    $data->menu_image = $menu_image;
    $data->menu_detail = $menu_detail;
    $data->menu_half_price = $menu_half_price;
    $data->menu_full_price = $menu_full_price;
    $data->menu_fix_price = $menu_fix_price;
    $data->nutrient_counts = $nutrient_counts;
    
    $result1 = $this->Supervisor->update_menu_profile($data);
    if(!empty($menu_id))
    {
      $data1->status ='1';
      $data1->message = 'menu successfully update';
      array_push($result,$data1);
      $response->data = $data1;
    }
    else
    {
       $data1->status ='0';
       $data1->message = 'failed';
      array_push($result,$data1);
      $response->data = $data1;
    }
    echo json_output($response);
    }
     /*.........menu Edit for restaurant Api   ---- */

     /*.........staff  Edit for restaurant Api  ---- */
  public function staff_update_post()
  {
    $response = new StdClass();
    $result = new StdClass();
    $admin_id = $this->input->post('admin_id');
    $name = $this->input->post('name');
    $username=$this->input->post('username');
    $mobile_no=$this->input->post('mobile_no');
    $email=$this->input->post('email');
    $password=$this->input->post('password');
    $date_of_birth=$this->input->post('date_of_birth');
    $aadhar_no=$this->input->post('aadhar_no');
    $pan_number=$this->input->post('pan_number');
    $desingination=$this->input->post('desingination');
    $gender=$this->input->post('gender');
    $permanent_address=$this->input->post('permanent_address');
    $current_address=$this->input->post('current_address');
    $user_type=$this->input->post('user_type');
    $data->admin_id = $admin_id;
    $data->name = $name;
    $data->username = $username;
    $data->mobile_no = $mobile_no;
    $data->email = $email;
    $data->password = $password;
    $data->date_of_birth = $date_of_birth;
    $data->aadhar_no = $aadhar_no;
    $data->pan_number = $pan_number;
    $data->desingination = $desingination;
    $data->gender = $gender;
    $data->permanent_address = $permanent_address;
    $data->current_address = $current_address;
    $data->user_type = $user_type;
    $result1 = $this->Supervisor->update_staff_profile($data);
    if(!empty($mobile_no))
    {
      $data1->status ='1';
      $data1->message = 'staff successfully update';
      array_push($result,$data1);
      $response->data = $data1;
    }
    else
    {
       $data1->status ='0';
       $data1->message = 'failed';
      array_push($result,$data1);
      $response->data = $data1;
    }
    echo json_output($response);
    }
     /*.........menu Edit for restaurant Api   ---- */
     /*.........restaurant update  for restaurant Api  ---- */
  public function restaurant_update_detail_post()
  {
    $response = new StdClass();
    $result = new StdClass();
    $city = $this->input->post('city');
    $admin_id = $this->input->post('admin_id');
    $name=$this->input->post('name');
    $image=$this->input->post('image');
    $gst_no=$this->input->post('gst_no');
    $pan_no=$this->input->post('pan_no');
    $lat=$this->input->post('lat');
    $lng=$this->input->post('lng');
    $location=$this->input->post('location');
    $cuisines=$this->input->post('cuisines');
    $cost=$this->input->post('cost');
    $openingTime=$this->input->post('openingTime');
    $closingTime=$this->input->post('closingTime');
    $phone=$this->input->post('phone');
    $address=$this->input->post('address');
    $amenities=$this->input->post('amenities');
    $update_by=$this->input->post('update_by');
   
    $data->city = $city;
    $data->admin_id = $admin_id;
    $data->name = $name;
    $data->image = $image;
    $data->gst_no = $gst_no;
    $data->pan_no = $pan_no;
    $data->lat = $lat;
    $data->lng = $lng;
    $data->location = $location;
    $data->cuisines = $cuisines;
    $data->cost = $cost;
    $data->openingTime = $openingTime;
    $data->closingTime = $closingTime;
    $data->phone = $phone;
    $data->address = $address;
    $data->amenities = $amenities;
    $data->update_by = $update_by;
    $result1 = $this->Supervisor->update_restaurant_data($data);
    if(!empty($admin_id))
    {
      $data1->status ='1';
      $data1->message = 'restaurant data successfully update';
      array_push($result,$data1);
      $response->data = $data1;
    }
    else
    {
       $data1->status ='0';
       $data1->message = 'failed';
      array_push($result,$data1);
      $response->data = $data1;
    }
    echo json_output($response);
    }
     /*.........menu Edit for restaurant Api   ---- */


      /*.........get menu data Api For Restaurant ---- */
     public function menu_list_data_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $admin_id=$this->input->post('admin_id');
        $menu_list = $this->Supervisor->get_menu_list_data($admin_id);
        if(!empty($menu_list))
        {
         foreach ($menu_list as $row)
           {
           $menuhalfprice=$row['menu_half_price'];
            if(!empty($menuhalfprice))
            {
              $menu_half_price=$row['menu_half_price'];
            }
            else
            {
              $menu_half_price='';
            }
            $menufullprice=$row['menu_full_price'];
            if(!empty($menufullprice))
            {
              $menu_full_price=$row['menu_full_price'];
            }
            else
            {
              $menu_full_price='';
            }
            $menufixprice=$row['menu_fix_price'];
            if(!empty($menufixprice))
            {
              $menu_fix_price=$row['menu_fix_price'];
            }
            else
            {
              $menu_fix_price='';
            }
            $nutrientcounts=$row['nutrient_counts'];
          if(!empty($nutrientcounts))
            {
              $nutrient_counts=$row['nutrient_counts'];
            }
            else
            {
              $nutrient_counts='';
            }
            $data['menu_id'] =   $row['menu_id'];
            $data['admin_id'] =   $row['admin_id'];
            $data['menu_food_type'] =   $row['menu_food_type'];
            $data['menu_name'] =   $row['menu_name'];
            $data['menu_image'] =   $row['menu_image'];
            $data['menu_detail'] =   $row['menu_detail'];
            $data['menu_half_price'] =   $menu_half_price;
            $data['menu_full_price'] =  $menu_full_price;
            $data['menu_fix_price'] =   $menu_fix_price;
            $data['nutrient_counts'] =   $nutrient_counts;
            $data['message'] = 'Success';
            $data['status']  ='1';

            array_push($result,$data);

           } 
            
              $response->data = $result;
         }
         else
         {
            $data['message'] = 'failed';
            $data['status']  ='0';
            array_push($result , $data);
         }
           $response->data = $result;
           echo json_output($response);
        }

      /*.........super sub Category   Api For hawker  ---- */

      /*.........Add order for customer  restaurant  for Restaurant Api  ---- */
    public function add_order_detail_waiter_for_restaurant_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
        $admin_id=$this->input->post('admin_id');
        $waiter_mobile_no=$this->input->post('waiter_mobile_no');
        $customer_mobile_no=$this->input->post('customer_mobile_no');
        $table_no=$this->input->post('table_no');
        $menu_item_name=$this->input->post('menu_item_name');
        $quantity=$this->input->post('quantity');
        $half_and_full_status=$this->input->post('half_and_full_status');
        $menu_price=$this->input->post('menu_price');
        $total_item=$this->input->post('total_item');
        $total_price=$this->input->post('total_price');
        $gst_amount=$this->input->post('gst_amount');
        $gst_amount_price=$this->input->post('gst_amount_price');
        $net_pay_amount=$this->input->post('net_pay_amount');
        $order_status=$this->input->post('order_status');
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $now1 = date('Y-m-d');
        $data->admin_id=$admin_id;
        $data->waiter_mobile_no=$waiter_mobile_no;
        $data->customer_mobile_no=$customer_mobile_no;
        $data->table_no=$table_no;
        $data->menu_item_name=$menu_item_name;
        $data->quantity=$quantity;
        $data->half_and_full_status=$half_and_full_status;
        $data->menu_price=$menu_price;
        $data->total_item=$total_item;
        $data->total_price=$total_price;
        $data->gst_amount=$gst_amount;
        $data->gst_amount_price=$gst_amount_price;
        $data->net_pay_amount=$net_pay_amount;
        $data->order_status=$order_status;
        $data->create_date=$now;
        $data->date=$now1;
        $data->status='2';
        $que=$this->db->query("select * from tbl_order_detail_for_restaurant where table_no='".$table_no."' and order_status!='Complete' and admin_id='$admin_id' and payment_status!='1'");

         $row = $que->num_rows();
        if($row>0)
         {
            $data1->status ='2';
            $data1->message = 'This table is already book.';
            array_push($result2,$data1);
            $response->data = $data1;
         }
         else
         {
        $result = $this->Supervisor->add_order_detail_for_waiter($data);
        $alphanumerric='ORD_0000'.$result;
        $update_order_detail = $this->Supervisor->update_order_waiter_id($alphanumerric,$result);
        if(!empty($result))
        {  
            $data2->status ='1';
            $data2->message = 'success';
            array_push($result2,$data2);
            $response->data = $data2;
        }
          else
          {
              $data2->status ='0';
              $data2->message = 'failed';
              array_push($result2,$data2);
              $response->data = $data2;
          }
         }
        
      
       
      echo  json_output($response);
    }

   /*.........Role Api For Restaurant ---- */

   /*.........change order particular customer  for  restaurant  Api  ---- */
    public function change_order_for_particular_customer_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
        $order_id=$this->input->post('order_id');
        $admin_id=$this->input->post('admin_id');
        $waiter_mobile_no=$this->input->post('waiter_mobile_no');
        $customer_mobile_no=$this->input->post('customer_mobile_no');
        $table_no=$this->input->post('table_no');
        $menu_item_name=$this->input->post('menu_item_name');
        $quantity=$this->input->post('quantity');
        $half_and_full_status=$this->input->post('half_and_full_status');
        $menu_price=$this->input->post('menu_price');
        $total_item=$this->input->post('total_item');
        $total_price=$this->input->post('total_price');
        $gst_amount=$this->input->post('gst_amount');
        $gst_amount_price=$this->input->post('gst_amount_price');
        $net_pay_amount=$this->input->post('net_pay_amount');
        $order_status=$this->input->post('order_status');

        $now = date('Y-m-d H:i:s');
        $now1 = date('Y-m-d');
        $data->order_id=$order_id;
        $data->admin_id=$admin_id;
        $data->waiter_mobile_no=$waiter_mobile_no;
        $data->customer_mobile_no=$customer_mobile_no;
        $data->table_no=$table_no;
        $data->menu_item_name=$menu_item_name;
        $data->quantity=$quantity;
        $data->half_and_full_status=$half_and_full_status;
        $data->menu_price=$menu_price;
        $data->total_item=$total_item;
        $data->total_price=$total_price;
        $data->gst_amount=$gst_amount;
        $data->gst_amount_price=$gst_amount_price;
        $data->net_pay_amount=$net_pay_amount;
        $data->order_status=$order_status;
        $data->create_date=$now;
        $data->date=$now1;
        $data->status='2';
        $result = $this->Supervisor->add_order_detail_restaurant($data);
       /* $alphanumerric='ORD_0000'.$result;
        $update_order_detail = $this->Customer->update_order_id($alphanumerric,$result);*/
        if(!empty($result))
        {  
            $data2->status ='1';
            $data2->message = 'Order Confirmed';
            array_push($result2,$data2);
            $response->data = $data2;
        }
          else
          {
              $data2->status ='0';
              $data2->message = 'failed';
              array_push($result2,$data2);
              $response->data = $data2;
          }
      
       
      echo  json_output($response);
    }

   /*.........Role Api For Restaurant ---- */

       /*.........get_order_detail_for_restaurant Restaurant Api  ---- */
     public function get_order_detail_for_restaurant_post()
      {
        $response   =   new StdClass();
        $response1   =   new StdClass();
        $result       =   array();
        $admin_id=$this->input->post('admin_id');
        $order_status=$this->input->post('order_status');

        $data = $this->Supervisor->getGroupData($admin_id,$order_status);
        $arr = array();
        if(empty($data))
        {
          $response->status = 0;
          $response->message = "failed";
         //$response->data = $arr;
        }
        else
        {
          for($i=0;$i<count($data);$i++)
        {
            $result['order_id'] = $data[$i]['order_id'];
            $result['data'] = $this->Supervisor->getDataOrderWise($data[$i]['order_id']);
            array_push($arr, $result);
          
        }
        $response->status = 1;
        $response->message = "success";
        $response->data = $arr;

        }
        
        echo json_output($response);
        //die();

        // if($order_status=='')
        // {
        //    $order_detail_for_customer = $this->Supervisor->order_detail_for_restaurant_customer($admin_id,$order_status);
        // }
        // else{
        //    $order_detail_for_customer = $this->Supervisor->order_detail_for_restaurant_customer($admin_id,$order_status);

        // }
        
       

     /*   if(!empty($order_detail_for_customer))
        {
         foreach ($order_detail_for_customer as $row)
           {
          $cus_id_data=$row['cus_id'];
          $waiter_mobile=$row['waiter_mobile_no'];
          if(!empty($waiter_mobile))
          {
            $waiter_mobile_no=$waiter_mobile;
          }else
          {
            $waiter_mobile_no='';
          }
          if(!empty($cus_id_data))
          {
            $cus_id=$cus_id_data;
          }
          else
          {
             $cus_id='';
          }
            $data['order_id'] =   $row['order_id'];
            $data['admin_id'] =   $row['admin_id'];
            $data['cus_id'] =   $cus_id;
            $data['table_no'] =   $row['table_no'];
            $data['menu_item_name'] =   $row['menu_item_name'];
            $data['quantity'] =   $row['quantity'];
            $data['half_and_full_status'] =   $row['half_and_full_status'];
            $data['menu_price'] =   $row['menu_price'];
            $data['total_item'] =   $row['total_item'];
            $data['total_price'] =   $row['total_price'];
            $data['gst_amount'] =   $row['gst_amount'];
            $data['gst_amount_price'] =   $row['gst_amount_price'];
            $data['net_pay_amount'] =   $row['net_pay_amount'];
            $data['order_status'] =   $row['order_status'];
            $data['waiter_mobile_no'] =   $waiter_mobile_no;
            $data['customer_mobile_no'] =   $row['customer_mobile_no'];
            $data['slip_status'] =   $row['slip_status'];
            $data['payment_status'] =   $row['payment_status'];
             $data['create_date'] =   $row['create_date'];
            $data['message'] = 'Success';
            $data['status']  ='1';*/

            /*array_push($result,$data);*/

          /* } 
            
              $response->data = $result;
         }*/

        /*
         else
         {
            $data['message'] = 'failed';
            $data['status']  ='0';
            array_push($result , $data);
         }
           $response->data = $result;
           echo json_output($response);*/
        }

      /*.........get_order_detail_for_restaurant Restaurant Api---- */

      /*.........get_order_detail_for_restaurant Restaurant Api  ---- */
     public function show_supervisor_order_detail_for_restaurant_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $admin_id=$this->input->post('admin_id');
        $order_status=$this->input->post('order_status');
        
        $order_detail_for_supervisor = $this->Supervisor->order_detail_for_restaurant_supervisor($admin_id,$order_status);

        if(!empty($order_detail_for_supervisor))
        {
         foreach ($order_detail_for_supervisor as $row)
           {
            $data['order_id'] =   $row['order_id'];
            $data['admin_id'] =   $row['admin_id'];
            $data['cus_id'] =   $row['cus_id'];
            $data['table_no'] =   $row['table_no'];
            $data['menu_item_name'] =   $row['menu_item_name'];
            $data['quantity'] =   $row['quantity'];
            $data['half_and_full_status'] =   $row['half_and_full_status'];
            $data['menu_price'] =   $row['menu_price'];
            $data['total_item'] =   $row['total_item'];
            $data['total_price'] =   $row['total_price'];
            $data['gst_amount'] =   $row['gst_amount'];
            $data['gst_amount_price'] =   $row['gst_amount_price'];
            $data['net_pay_amount'] =   $row['net_pay_amount'];
            $data['order_status'] =   $row['order_status'];
            $data['payment_status'] =   $row['payment_status'];
            $data['waiter_mobile_no'] =   $row['waiter_mobile_no'];
            $data['customer_mobile_no'] =   $row['customer_mobile_no'];
            $data['create_date'] =   $row['create_date'];
            $data['message'] = 'Success';
            $data['status']  ='1';

            array_push($result,$data);

           } 
            
              $response->data = $result;
         }

        
         else
         {
            $data['message'] = 'failed';
            $data['status']  ='0';
            array_push($result , $data);
         }
           $response->data = $result;
           echo json_output($response);
        }

      /*.........get_order_detail_for_restaurant Restaurant Api---- */
      /*.........food tyoe api for  Restaurant ---- */
     public function get_food_type_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $food_type = $this->Supervisor->get_food_type();
        if(!empty($food_type))
        {
         foreach ($food_type as $row)
           {
            $data['food_type'] =   $row['food_type'];
            $data['message'] = 'Success';
            $data['status']  ='1';

            array_push($result,$data);

           } 
            
              $response->data = $result;
         }
         else
         {
            $data['message'] = 'failed';
            $data['status']  ='0';
            array_push($result , $data);
         }
           $response->data = $result;
           echo json_output($response);
        }

      /*.........super sub Category   Api For hawker  ---- */
      public function show_order_by_count_post()
    {
    $response =   new StdClass();
    $result       =  new StdClass();
    $admin_id =$this->input->post('admin_id');
    $order_status =$this->input->post('order_status');
    $resdata = $this->Supervisor->check_total_count($admin_id,$order_status);
      if($resdata>0)
    {    
      $data1->count=$resdata;
      $data1->status ='1';
      array_push($result,$data1);
      $response->data = $data1;
        }
        else if($resdata==0)
         {
            $data1->count ='0';
      $data1->status = '1';
      array_push($result,$data1);
      $response->data = $data1;
         }
          else 
           {
              $data1->status ='0';
        $data1->message = 'failed';
        array_push($result,$data1);
        $response->data = $data1;
           }
              
           echo json_output($response);
       }

      /*.........get order acvcouding to date for   Restaurant ---- */
   /*  public function get_order_detail_by_date_for_restaurant_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $start_date=$this->input->post('start_date');
        $end_date=$this->input->post('end_date');
        $admin_id=$this->input->post('admin_id');
        $get_order = $this->Supervisor->get_order_data($start_date,$end_date,$admin_id);
        if(!empty($get_order))
        {
         foreach ($get_order as $row)
           {
            $data['order_id'] =   $row['order_id'];
            $data['admin_id'] =   $row['admin_id'];
            $data['cus_id'] =   $row['cus_id'];
            $data['table_no'] =   $row['table_no'];
            $data['menu_item_name'] =   $row['menu_item_name'];
            $data['quantity'] =   $row['quantity'];
            $data['half_and_full_status'] =   $row['half_and_full_status'];
            $data['menu_price'] =   $row['menu_price'];
            $data['total_item'] =   $row['total_item'];
            $data['total_price'] =   $row['total_price'];
            $data['gst_amount'] =   $row['gst_amount'];
            $data['gst_amount_price'] =   $row['gst_amount_price'];
            $data['net_pay_amount'] =   $row['net_pay_amount'];
            $data['order_status'] =   $row['order_status'];
            $data['payment_status'] =   $row['payment_status'];
            $data['customer_mobile_no'] =   $row['customer_mobile_no'];
            $data['create_date'] =   $row['create_date'];
            $data['message'] = 'Success';
            $data['status']  ='1';

            array_push($result,$data);

           } 
            
              $response->data = $result;
         }
         else
         {
            $data['message'] = 'failed';
            $data['status']  ='0';
            array_push($result , $data);
         }
           $response->data = $result;
           echo json_output($response);
        }*/

      /*.........super sub Category   Api For hawker  ---- */
      public function get_order_detail_by_date_for_restaurant_post()
      {
        $response   =   new StdClass();
        $response1   =   new StdClass();
        $result       =   array();
        $start_date=$this->input->post('start_date');
        $end_date=$this->input->post('end_date');
        $admin_id=$this->input->post('admin_id');
        $data = $this->Supervisor->getGroupData_for_date($admin_id,$start_date,$end_date);
        $arr = array();
        if(empty($data))
        {
          $response->status = 0;
          $response->message = "failed";
         //$response->data = $arr;
        }
        else
        {
        $response->status = 1;
        $response->message = "success";
        $response->data = $data;

        }
        
        echo json_output($response);
        
        }

      /*.........get order status detail for Restaurant ---- */

      /*.........get order status detail for Restaurant  ---- */
       /*.........food tyoe api for  Restaurant ---- */
     public function get_amenities_type_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $amenities_type = $this->Supervisor->get_amenities_type();
        if(!empty($amenities_type))
        {
         foreach ($amenities_type as $row)
           {
            $data['amenities_type'] =   $row['amenities_type'];
            $data['message'] = 'Success';
            $data['status']  ='1';

            array_push($result,$data);

           } 
            
              $response->data = $result;
         }
         else
         {
            $data['message'] = 'failed';
            $data['status']  ='0';
            array_push($result , $data);
         }
           $response->data = $result;
           echo json_output($response);
        }

      /*.........super sub Category   Api For hawker  ---- */

      /*........Staff list Api For Restaurant ---- */
     public function get_staff_data_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $admin_id=$this->input->post('admin_id');
        $staff_data = $this->Supervisor->get_staff_data($admin_id);
        if(!empty($staff_data))
        {
         foreach ($staff_data as $row)
           {
            $data['admin_id'] =   $row['admin_id'];
            $data['name'] =   $row['name'];
            $data['mobile_no'] =   $row['mobile_no'];
            $data['email'] =   $row['email'];
            $data['date_of_birth'] =   $row['date_of_birth'];
            $data['aadhar_no'] =   $row['aadhar_no'];
            $data['pan_number'] =   $row['pan_number'];
            $data['desingination'] =   $row['desingination'];
            $data['gender'] =   $row['gender'];
            $data['permanent_address'] =   $row['permanent_address'];
            $data['current_address'] =   $row['current_address'];
            $data['user_type'] =   $row['user_type'];
            $data['message'] = 'Success';
            $data['status']  ='1';

            array_push($result,$data);

           } 
            
              $response->data = $result;
         }
         else
         {
            $data['message'] = 'failed';
            $data['status']  ='0';
            array_push($result , $data);
         }
           $response->data = $result;
           echo json_output($response);
        }

      /*........Staff list Api For Restaurant ---- */

   /*....... Waiter confirm order Api for restaurant  ---- */
    public function confirm_order_by_waiter_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
        $waiter_mobile_no=$this->input->post('waiter_mobile_no');
        $order_status=$this->input->post('order_status');
        $admin_id=$this->input->post('admin_id');
        $order_id=$this->input->post('order_id');

        $data->waiter_mobile_no=$waiter_mobile_no;
        $data->order_status=$order_status;
        $data->admin_id=$admin_id;
        $data->order_id=$order_id;
        $result = $this->Supervisor->confirm_order_by_waiter($data);

       
        if(!empty($order_status))
        {  
            $data2->status ='1';
            $data2->message = 'Success';
            array_push($result2,$data2);
            $response->data = $data2;
        }
          else
          {
              $data2->status ='0';
              $data2->message = 'failed';
              array_push($result2,$data2);
              $response->data = $data2;
          }
      
       
      echo  json_output($response);
    }
      /*....... Waiter confirm order Api for restaurant  ---- */

       /*....... BLE Brodcast api for  restaurant  ---- */
    public function BLE_brodcast_for_restaurant_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
        
        $admin_id=$this->input->post('admin_id');
        $BLE_id=$this->input->post('BLE_id');

        $data->admin_id=$admin_id;
        $data->BLE_id=$BLE_id;
        $result = $this->Supervisor->BLE_brodcast_for_restaurants($data);

       
        if(!empty($BLE_id))
        {  
            $data2->status ='1';
            $data2->message = 'Success';
            array_push($result2,$data2);
            $response->data = $data2;
        }
          else
          {
              $data2->status ='0';
              $data2->message = 'failed';
              array_push($result2,$data2);
              $response->data = $data2;
          }
      
       
      echo  json_output($response);
    }
      /*....... BLE Brodcast api for  restaurant  ---- */

       /*.......Order compelete by supervisor Api for restaurant  ---- */
    public function order_complete_by_supervisor_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
        $supervisor_mobile_no=$this->input->post('supervisor_mobile_no');
        $admin_id=$this->input->post('admin_id');
        $order_id=$this->input->post('order_id');

        $data->supervisor_mobile_no=$supervisor_mobile_no;
        $data->admin_id=$admin_id;
        $data->order_id=$order_id;
        $result = $this->Supervisor->complete_order_by_supervisor($data);

       
        if(!empty($order_id))
        {  
            $data2->status ='1';
            $data2->message = 'Success';
            array_push($result2,$data2);
            $response->data = $data2;
        }
          else
          {
              $data2->status ='0';
              $data2->message = 'failed';
              array_push($result2,$data2);
              $response->data = $data2;
          }
      
       
      echo  json_output($response);
    }
      /*....... Waiter confirm order Api for restaurant  ---- */
      public function order_complete_by_chef_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
        $chef_mobile_no=$this->input->post('chef_mobile_no');
        $admin_id=$this->input->post('admin_id');
        $order_id=$this->input->post('order_id');

        $data->chef_mobile_no=$chef_mobile_no;
        $data->admin_id=$admin_id;
        $data->order_id=$order_id;
        $result = $this->Supervisor->complete_order_by_chef($data);

       
        if(!empty($order_id) and !empty($chef_mobile_no) and !empty($admin_id))
        {  
            $data2->status ='1';
            $data2->message = 'Success';
            array_push($result2,$data2);
            $response->data = $data2;
        }
          else
          {
              $data2->status ='0';
              $data2->message = 'failed';
              array_push($result2,$data2);
              $response->data = $data2;
          }
      
       
      echo  json_output($response);
    }

      /*....... create slip for supervisor Api for restaurant  ---- */
    public function create_slip_supervisor_for_chef_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
        $order_id=$this->input->post('order_id');
        $admin_id=$this->input->post('admin_id');
        $mobile_no=$this->input->post('mobile_no');
        $data->admin_id=$admin_id;
        $data->order_id=$order_id;
         $data->mobile_no=$mobile_no;
        $result = $this->Supervisor->create_slip($data);

       
        if(!empty($order_id))
        {  
            $data2->status ='1';
            $data2->message = 'Success';
            array_push($result2,$data2);
            $response->data = $data2;
        }
          else
          {
              $data2->status ='0';
              $data2->message = 'failed';
              array_push($result2,$data2);
              $response->data = $data2;
          }
      
       
      echo  json_output($response);
    }
      /*.......create slip for supervisor Api for restaurant  ---- */


      /*....... delete order  Api for restaurant  ---- */
    public function delete_order_for_restaurant_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
        $order_id=$this->input->post('order_id');
        $admin_id=$this->input->post('admin_id');
        $mobile_no=$this->input->post('mobile_no');
        $data->admin_id=$admin_id;
        $data->order_id=$order_id;
         $data->mobile_no=$mobile_no;
        $result = $this->Supervisor->delete_order($data);

       
        if(!empty($order_id))
        {  
            $data2->status ='1';
            $data2->message = 'Success';
            array_push($result2,$data2);
            $response->data = $data2;
        }
          else
          {
              $data2->status ='0';
              $data2->message = 'failed';
              array_push($result2,$data2);
              $response->data = $data2;
          }
      
       
      echo  json_output($response);
    }
      /*.......create slip for supervisor Api for restaurant  ---- */
      /*.........Update  payment status for restaurant---- */
    public function update_payment_for_customer_by_staff_post()
     {
        $response   =   new StdClass();
        $result       =  new StdClass();
        $order_id =$this->input->post('order_id');
        $admin_id =$this->input->post('admin_id');
        $payment_status =$this->input->post('payment_status');
        $payment_by =$this->input->post('payment_by');
        $get_payment =$this->input->post('get_payment');
        $data->order_id = $order_id;
        $data->admin_id=$admin_id;
        $data->payment_status=$payment_status;
        $data->payment_by=$payment_by;
        $data->get_payment=$get_payment;
        $res1 = $this->Supervisor->update_payment_status_by_staff($data);
        if($order_id!='')
        {
        $data1->status = '1';
        $data1->message = 'Success';
        array_push($result,$data1);
        $response->data = $data1;
       }
        else
        {
           $data1->status = '0';
            $data1->message = 'failed';
            array_push($result,$data1);
            $response->data = $data1;
        }  
          echo json_output($response);
        }
      /*..........Update  payment status for restaurant- ---- *

    /*.........Deliveryboy location by gps Api for hawker ---- */

    public function Deliveryboy_location_by_gps_post()
     {
         $response = new StdClass();
         $result = new StdClass();
         $Deliveryboy_id=$this->input->post('Deliveryboy_id');
         $latitude  = $this->input->post('latitude');
         $longitude = $this->input->post('longitude');
         $device_id  = $this->input->post('device_id');
         $battery_status  = $this->input->post('battery_status');
         date_default_timezone_set('Asia/kolkata'); 
         $now = date('Y-m-d H:i:s');
         $data->Deliveryboy_id  = $Deliveryboy_id;
         $data->latitude  = $latitude;
         $data->longitude = $longitude;
         $data->device_id = $device_id;
         $data->battery_status = $battery_status;
         $data->create_time = $now;
         $data->active_status='1';
         //$this->load->model('User');
         $res = $this->Deliveryboy->Deliveryboy_location_add_data_by_gps($data);
         if(!empty($res))
          {
            $data1->status ='1';
            $data1->message = 'success';
            array_push($result,$data1);
            $response->data = $data1;
          }
          else
          {
            $data1->status ='0';
            $data1->message = 'failed';
             array_push($result,$data1);
              $response->data = $data1;
          }

        echo json_output($response);
     }

    /*...... Deliveryboy location by gps Api for hawker  ---- */

   /*......... Get Validate DeliveryboyUser Api For Fixer  ---- */
    public function validate_active_Deliveryboy_user_post()
     {
        $response = new StdClass();
        $result       =  new StdClass();
        $Deliveryboy_id = $this->input->post('Deliveryboy_id');
        $device_id=$this->input->post('device_id');
        $city=$this->input->post('city');
        $result->Deliveryboy_id = $Deliveryboy_id;
        $result1->device_id=$device_id;
        $result2->city=$city;
        $res = $this->Deliveryboy->Validate_Deliveryboy_user($result);
        $res1 = $this->Deliveryboy->check_device_for_Deliveryboy($result);
        $res2 = $this->Deliveryboy->check_city_status_Deliveryboy($result2);
        $active_status=$res->active_status;
        $message=$res->message;
        $devicedata=$res1->device_id;
        $active_status1=$res2->active_status;
        if(!empty($res2))
        {
          if($devicedata!=$device_id)
         {
            $data1->city_status=$active_status1;
            $data1->active_status ='3';
            $data1->status ='1';
            $data1->message = 'logout from other device';
             array_push($result,$data1);
             $response->data = $data1;

         }

         else if($active_status=='1')
          {
            $data1->city_status=$active_status1;
            $data1->active_status='1';
            $data1->status ='1';
            $data1->message = 'Active';
             array_push($result,$data1);
             $response->data = $data1;
          }
          else if($active_status=='0')
          {
            $data1->city_status=$active_status1;
            $data1->active_status='0';
            $data1->status ='1';
            $data1->message = $message;
             array_push($result,$data1);
             $response->data = $data1;
          }
         
        }
          else
          {
            $data1->city_status ='0';
            $data1->active_status ='1';
            $data1->status ='1';
            $data1->message = 'failed';
             array_push($result,$data1);
             $response->data = $data1;
          }

        echo json_output($response);
     }
   /*......... Get Validate DeliveryboyUser Api For Fixer  ---- */

   /*.........Profile data for Deliveryboy Api For hawker  ---- */
     public function Deliveryboy_profile_post()
      {
        $response =   new StdClass();
        $result       =  new StdClass();
        $Deliveryboy_id =$this->input->post('Deliveryboy_id');
        $data->Deliveryboy_id=$Deliveryboy_id;
        $resdata = $this->Deliveryboy->check_data_Deliveryboy_profile($data);
        $id = $resdata->id;

        $Deliveryboy_id1=$resdata->Deliveryboy_id;
        $name=$resdata->name;
        $email_id=$resdata->email_id;
        $image=$resdata->image;
        $address=$resdata->address;
        $mobile_no=$resdata->mobile_no;
        
        if(!empty($resdata))
          {
            $data1->id=$id;
            $data1->Deliveryboy_id=$Deliveryboy_id1;
            $data1->name=$name;
            $data1->email_id=$email_id;
            $data1->image_url='http://10.0.0.15/fixer_goolean/manage/Deliveryboyuser_image/'.$image;
            //$data1->image_url=base_url().'manage/Deliveryboyuser_image/'.$image;
            $data1->address=$address;
            $data1->mobile_no=$mobile_no;
            $data1->status ='1';
            array_push($result,$data1);
            $response->data = $data1;
            
          }
          else
           {
                $data1->status ='0';
                $data1->message = 'failed';
                array_push($result,$data1);
                $response->data = $data1;
           }
                
          echo  json_output($response);
       }

      /*.........Profile data for Deliveryboy Api For hawker  ---- */

    /*......... duty on/off Api For Deliveryboy  ---- */
     public function duty_on_off_by_delivery_boy_post()
     {
        $response = new StdClass();
        $result       =  new StdClass();
        $device_id = $this->input->post('device_id');
        $notification_id = $this->input->post('notification_id');
        $delivery_id = $this->input->post('delivery_id');
        $longitude =$this->input->post('longitude');
        $latitude=$this->input->post('latitude');
        $duty_status=$this->input->post('duty_status');
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        if($duty_status=='1')
        {
        $data->delivery_id=$delivery_id;
        $data->longitude=$longitude;
        $data->latitude=$latitude;
        $data->duty_status=$duty_status;
        $data->on_time=$now;
        $data->device_id=$device_id;
        $data->status='1';
        $res = $this->Deliveryboy->duty_data_by_delivery_boy($data);
        }
        else if($duty_status==0)
        {
        $data->delivery_id=$delivery_id;
        $data->longitude=$longitude;
        $data->latitude=$latitude;
        $data->duty_status=$duty_status;
        $data->device_id=$device_id;
        $data->out_time=$now;
        $data->status='1';
        $res = $this->Deliveryboy->duty_data_by_delivery_boy($data);
        }
        else if($duty_status==2)
         {
            $delivery_id = $this->input->post('delivery_id');

            $resdata = $this->Deliveryboy->check_duty_data_by_delivery_boy($delivery_id);
            $duty_status1 = $resdata->duty_status;
         }

        if(!empty($data))
         {
            $data1->duty_status=$duty_status;
            $data1->status ='1';
            $data1->message = 'success';
            array_push($result,$data1);
            $response->data = $data1;
         }
         else if(!empty($resdata))
         {
            $data1->duty_status=$duty_status1;
            $data1->status ='1';
            $data1->message = 'success';
            array_push($result,$data1);
            $response->data = $data1;
         }
         else
         {
            $data1->duty_status='0';
            $data1->status ='0';
            $data1->message = 'failed';
            array_push($result,$data1);
            $response->data = $data1;
         }

          echo json_output($response);
     }
    /*.........  duty on/off Api For Deliveryboy  ---- */
/*......... logout Api For staff  ---- */
    public function data_logout_for_staff_post()
    {
    $response = new StdClass();
    $result = array();
    $device_id =$this->input->post('device_id');
    $mobile_no =$this->input->post('mobile_no');
    date_default_timezone_set('Asia/kolkata'); 
    $now = date('Y-m-d H:i:s');
    $data->mobile_no = $mobile_no;
    $data->device_id = $device_id;
    $data->logout_time=$now;
    $resdata1 = $this->Supervisor->logout_staff_data($data);
    if(!empty($mobile_no) and !empty($mobile_no))
    {
    $data1->status ='1';
    $data1->message='logout success';
    array_push($result,$data1);
    $response->data = $data1;
      }
        else
        {
          $data1->status ='0';
          $data1->message ='logout failed';
      array_push($result,$data1);
       $response->data = $data1;
        }
    echo json_output($response);
   }

    /*......... logout data From Wifi-module Api For Door Unlock ---- */

    /*.........Category   Api For Fixer  ---- */
  public function category_post()
  {
    $response = new StdClass();
    $result = array();
    $cat_name =$this->input->post('cat_name');
    $type=$this->input->post('type');
    if($type!='' OR $cat_name!='')
    {
    if($type=='Fix')
    {
      if($cat_name!='')
    {
    $datacat = $this->Deliveryboy->category_data_profile($cat_name);
    }
    else
    {
       $datacat = $this->Deliveryboy->category1_data_profile();
       //$datacat=sort($datacat1);
    }
    if(!empty($datacat))
    {
    foreach ($datacat as $row)
     {
     $setData = new StdClass();
     $setData->id = $row['id'];
     $setData->position_key = $row['id'];
     $setData->cat_name = $row['cat_name'];
     $setData->image_url= base_url().'manage/catImages/'.$row['cat_icon_image'];
     //$setData->check_level = $row['check_level'];
     $setData->sub_cat_status='0';
     $subCat = $this->Deliveryboy->getSubCategory(['category'=>$row['id']]);
     if(!empty($subCat))
     {

      $setData->sub_cat_status= '1';
      $setData->subCat = $subCat;

       }
     else
     {
      $setData->subCat = $subCat;
     }    
     array_push($result,$setData);
     }
      $response->check_level = $row['check_level'];;
      $response->status = '1';
      $response->data = $result;

    }
    }
    else
    {
      if($cat_name!='')
    {
    $datacat = $this->Deliveryboy->category_data_profile($cat_name);
    }
    else
    {
       $datacat = $this->Deliveryboy->category2_data_profile();
       //$datacat=sort($datacat1);
    }
    if(!empty($datacat))
    {
    foreach ($datacat as $row)
     {
     $setData = new StdClass();
     $setData->id = $row['id'];
     $setData->position_key = $row['id'];
     $setData->cat_name = $row['cat_name'];
     $setData->image_url= base_url().'manage/catImages/'.$row['cat_icon_image'];
     //$setData->check_level = $row['check_level'];
     $setData->sub_cat_status='0';
     $subCat = $this->Deliveryboy->getSubCategory(['category'=>$row['id']]);
     if(!empty($subCat))
     {

      $setData->sub_cat_status= '1';
      $setData->subCat = $subCat;

       }
     else
     {
      $setData->subCat = $subCat;
     }    
     array_push($result,$setData);
     }
      $response->check_level = $row['check_level'];;
      $response->status = '1';
      $response->data = $result;
    }
    }
  }
    
    else
    {
    $response->status = '0';
    $response->data = "";

    }

     echo json_output($response);
    }

      /*.........Category   Api For Fixer  ---- */

      /*.........super sub Category   Api For Hawker  ---- */
     public function super_sub_category_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $sub_cat_id =$this->input->post('sub_cat_id');
        $datacat = $this->Deliveryboy->getSuperSubCategory($sub_cat_id);
        if(!empty($datacat))
        {
         foreach ($datacat as $row)
           {

            $data['id'] =   $row['id'];
            $data['super_sub_cat_name'] =   $row['super_sub_cat_name'];
            $data['image_url']=base_url().'manage/catImages/'.$row['super_sub_cat_image'];
             $data['position_key'] = $sub_cat_id;
            $data['status']  ='1';

            array_push($result,$data);

           } 
              $response->status = '1';
              $response->data = $result;
         }
         else
         {
            $data['status']  ='0';
            array_push($result , $data);
         }
           $response->data = $result;
           echo json_output($response);
        }

      /*.........super sub Category   Api For hawker  ---- */

       /*......... status check api for  hawker ---- */
        public function status_check_data_post()
     {
        $response = new StdClass();
        $result = array();
        $status =$this->input->post('status');
        $mobile_no =$this->input->post('mobile_no');
        $device_id =$this->input->post('device_id');
        $notification_id =$this->input->post('notification_id');
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        
        if($status=='1')
        {
        require APPPATH . 'libraries/firebase.php';
        require APPPATH . 'libraries/push.php';
        require APPPATH . 'libraries/config.php';
        $data->mobile_no = $mobile_no;
        $data->device_id = $device_id;
        $data->notification_id = $notification_id;
        $data->login_time=$now;
        $res1 = $this->Deliveryboy->fetch_login_data($data);
        $name=$res1->name;
        $Deliveryboy_id=$res1->user_id;

        $otpValue=mt_rand(1000, 9999);
        $data1->device_id = $device_id;
        $data1->notification_id = $notification_id;
        $data1->mobile_no=$mobile_no;
        $data1->Deliveryboy_id=$Deliveryboy_id;
        $data1->otp=$otpValue;
        $res3 = $this->Deliveryboy->send_otp($mobile_no,$otpValue);
        if($res3!='')
        {
          $res4 = $this->Deliveryboy->otpgetdata($data1);
        }
        $notificationdata=$res1->notification_id;
        $data2 = $this->Deliveryboy->update_login_data($data);
        $firebase = new Firebase();
        $push = new Push();
        // optional payload
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';

        // notification title
        $title ='logout';
        
        // notification message
        $message ='Device has been logge out';
        
        // push type - single user / topic
        $push_type = 'individual';
        $push->setTitle($title);
        $push->setMessage($message);
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);
        $json = '';
        $response = '';
        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $push->getPush();
            $regId =$notificationdata;
            $data4 = $firebase->send($regId, $json);
            $data1->messagedata=$data4;
            $data1->status ='1';
            $data1->name =$name;
            $data1->Deliveryboy_id =$Deliveryboy_id;
            array_push($result,$data1);
            $response->data = $data1;
        }
       
        }
        else
        {
            $data1->status ='0';
            array_push($result,$data1);
           $response->data = $data1;
        }
        echo json_output($response);
     }
     /* ---------------status check api for  hawker --------------*/
     /*.........super sub Category   Api For Hawker  ---- */
     public function Hawker_type_data_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $hawker_type_code =$this->input->post('hawker_type_code');
        $datacat = $this->Deliveryboy->gethawkertypename($hawker_type_code);
        if(!empty($datacat))
        {
         foreach ($datacat as $row)
           {

            $data['id'] =   $row['id'];
            $data['hawker__sub_type_name'] =   $row['hawker__sub_type_name'];
            $data['create_date'] =  $row['create_date'];
            array_push($result,$data);

           } 
              $response->status = '1';
              $response->data = $result;
         }
         else
         {
            $response->status = '0';
         }
           
           echo json_output($response);
        }

      /*.........super sub Category   Api For hawker  ---- */

     /*.........Verification OTP Api For Hawker  ---- */
     public function verification_otp_data_post()
      {
        $response   =   new StdClass();
        $result       =  new StdClass();
        $mobile_no =$this->input->post('mobile_no');
        $device_id =$this->input->post('device_id');
        $otp =$this->input->post('otp');
        $data1->device_id = $device_id;
        $data1->mobile_no = $mobile_no;
        $data1->otp=$otp;
        $dataotp = $this->Supervisor->verification_otp($data1);
        if(!empty($dataotp))
        { 
          $query= $this->db->get_where('tbl_admin', array('mobile_no' => $mobile_no , 'status' => '1'));

          $query1= $this->db->get_where('tbl_restaurant_staff_registration', array('mobile_no' => $mobile_no , 'status' => '1'));
          $num_rows=$query->num_rows();
          $current_data=$query->result_array();
          $num_rows1=$query1->num_rows();
          $current_data1=$query1->result_array();
          if(!empty($current_data))
            {
             foreach ($current_data as $row)
            { 
              $user_type='admin';
              $data['admin_id'] =  $row['admin_id'];
              $data['name'] =  $row['user_fullname'];
              $data['mobile_no'] =  $row['mobile_no'];
              $data['user_type'] =  $user_type;
            }
           }
           else if(!empty($current_data1))
           {
          foreach ($current_data1 as $row1)
            { 
              
              $user_type=$row1['user_type'];
               $data['admin_id'] =  $row1['admin_id'];
              $data['name'] =  $row1['name'];
              $data['mobile_no'] =  $row1['mobile_no'];
              $data['user_type'] =  $user_type;
            }
          }else{

               $data['admin_id'] = '';
              $data['name'] = '';
              $data['mobile_no'] =$mobile_no;
              $data['user_type'] ='';

          }

            $data['message'] = 'success';
            $data['status']= '1';
            array_push($result,$data);
            $response->data = $data;
        }
        else
        {
           $data['message'] = 'failed';
            $data['status']= '0';
          array_push($result,$data);
          $response->data = $data;
        }  
          echo json_output($response);
        }

       /*.........Verification OTP Api For Hawker  ---- */

       

       /*.........Resend OTP Api For Hawker  ---- */
     public function resend_otp_data_post()
      {
        $response   =   new StdClass();
        $result       =  new StdClass();
        $device_id =$this->input->post('device_id');
        $mobile_no =$this->input->post('mobile_no');
        $otpValue=mt_rand(1000, 9999);
        $data1->device_id = $device_id;
        $data1->mobile_no=$mobile_no;
        $data1->otp=$otpValue;
        $res = $this->Supervisor->send_otp($mobile_no,$otpValue);
        if(!empty($mobile_no))
        {
         $res1 = $this->Supervisor->resend_otp($data1);

          $data->message = 'success';
          $data->status = '1';
          array_push($result,$data);
          $response->data = $data;
        }

        else
        {
           $data->message = 'failed';
           $data->status = '0';
            array_push($result,$data);
            $response->data = $data;
        }  
          echo json_output($response);
        }

       /*.........Resend OTP Api For Hawker  ---- */

        

       /*.........Remove OTP Api For Hawker  ---- */
     public function otp_expire_post()
      {
        $response   =   new StdClass();
        $result       =  new StdClass();
        $device_id =$this->input->post('device_id');
        $mobile_no =$this->input->post('mobile_no');
        $data1->device_id = $device_id;
        $data1->mobile_no=$mobile_no;
        $res = $this->Supervisor->remove_otp($data1);
        if(!empty($mobile_no))
        {
            $data->message = 'success';
            $data->status = '1';
            array_push($result,$data);
            $response->data = $data;
        }
        else
        {
            $data->message = 'failed';
            $data->status = '0';
            array_push($result,$data);
            $response->data = $data;
        }  
           echo json_output($response);
        }

       /*.........Remove OTP Api For Hawker  ---- */


       /*......... Get Check Version data   ---- */
    public function remove_staff_post()
     {
        $response = new StdClass();
        $result2 = new StdClass();
        $mobile_no = $this->input->post('mobile_no');
        $res = $this->Supervisor->remove_staff($mobile_no);
        if($mobile_no!='')
        {
        $data1->status ='1';
        $data1->message = 'success';
        array_push($result2,$data1);
        $response->data = $data1;
        }
        
        else
        {
            $data1->status ='0';
            $data1->message = 'failed';
            array_push($result2,$data1);
            $response->data = $data1;
        }
        echo json_output($response);
     }
      /*......... Get Check Version data  ---- */

      /*......... Remove menu item by staff   ---- */
    public function remove_menu_item_by_staff_post()
     {
        $response = new StdClass();
        $result2 = new StdClass();
        $menu_id = $this->input->post('menu_id');
        $admin_id = $this->input->post('admin_id');
        $res = $this->Supervisor->remove_menu_item_staff($menu_id,$admin_id);
        if($menu_id!='')
        {
        $data1->status ='1';
        $data1->message = 'success';
        array_push($result2,$data1);
        $response->data = $data1;
        }
        
        else
        {
            $data1->status ='0';
            $data1->message = 'failed';
            array_push($result2,$data1);
            $response->data = $data1;
        }
        echo json_output($response);
     }
      /*......... Remove menu item by staff ---- */

     /*......... check_list_for_sale  ---- */
    public function check_list_for_sale_post()
    {
      $response   =   new StdClass();
      $result       =   array();
      $datacat = $this->Deliveryboy->check_list_data();
      if(!empty($datacat))
      {
       foreach ($datacat as $row)
      {

      $data['id'] =   $row['id'];
      $data['question']       =   $row['question'];
      $data['status']  ='1';
      array_push($result,$data);
      } 
      $response->data = $result;
      }
      else
      {
       $data['status']  ='0';
             array_push($result , $data);
      }
      $response->data = $result;
      echo json_output($response);
     }
      /*......... check_list_for_sale ---- */

      /*.........Update  check_list_for_sale  ---- */
    public function update_check_list_for_sale_post()
     {
        $response   =   new StdClass();
        $result       =  new StdClass();
        $hawker_code =$this->input->post('hawker_code');
        $Deliveryboy_id =$this->input->post('Deliveryboy_id');
        $check_list =$this->input->post('check_list');
        $data1->hawker_code = $hawker_code;
        $data1->Deliveryboy_id=$Deliveryboy_id;
        $data1->check_list=$check_list;
        $res1 = $this->Deliveryboy->update_check_list($data1);
        if($hawker_code!='')
        {
        $data->status = '1';
        array_push($result,$data);
        $response->data = $data;
       }
        else
        {
           $data->status = '0';
            array_push($result,$data);
            $response->data = $data;
        }  
          echo json_output($response);
        }
      /*......... check_list_for_sale ---- *


  /*............Start trip by Delivery boy ......................*/
   public function start_trip_by_delivery_boy_post()
     {
         $response = new StdClass();
         $result = new StdClass();
         $delivery_id=$this->input->post('delivery_id');
         $latitude  = $this->input->post('latitude');
         $longitude = $this->input->post('longitude');
         $device_id  = $this->input->post('device_id');
         $mobile_no  = $this->input->post('mobile_no');
         date_default_timezone_set('Asia/kolkata'); 
         $now = date('Y-m-d H:i:s');
         $data->delivery_id  = $delivery_id;
         $data->latitude  = $latitude;
         $data->longitude = $longitude;
         $data->device_id = $device_id;
         $data->mobile_no = $mobile_no;
         $data->date_time = $now;
         $data->status='1';
         
         $res = $this->Deliveryboy->start_trip_by_delivery_boy($data);
         if(!empty($res))
          {
            $data1->status ='1';
            $data1->message = 'success';
            array_push($result,$data1);
            $response->data = $data1;
          }
          else
          {
            $data1->status ='0';
            $data1->message = 'failed';
             array_push($result,$data1);
              $response->data = $data1;
          }

        echo json_output($response);
     }

  /*.....................Start trip by Delivery boy ................*/

  //////////////////////////////Count api for notification /////////////////////////////////////

   public function show_notification_by_count_post()
    {
    $response =   new StdClass();
    $result       =  new StdClass();
    $staff_mobile_no=$this->input->post('staff_mobile_no');
    $resdata = $this->Supervisor->check_total_count_notifications($staff_mobile_no);
      if($resdata>0)
    {    
      $data1->count=$resdata;
      $data1->status ='1';
      array_push($result,$data1);
      $response->data = $data1;
        }
        else if($resdata==0)
         {
      $data1->count ='';
      $data1->status = '1';
      array_push($result,$data1);
      $response->data = $data1;
         }
          else 
           {
              $data1->status ='0';
        $data1->message = 'failed';
        array_push($result,$data1);
        $response->data = $data1;
           }
              
           echo json_output($response);
       }

  //////////////////////////////////////////////////////////////////


       ////////////////////////////////////////////////////////////////

  public function update_notification_status_by_restaurant_post()
    {
    $response =   new StdClass();
    $result       =  new StdClass();
    $staff_mobile_no =$this->input->post('staff_mobile_no');
    $check_status =$this->input->post('check_status');
    if($check_status=='1' and $staff_mobile_no!='')
    {
       $resdata = $this->Supervisor->check_status_for_notifications($check_status,$staff_mobile_no);
    
      $data1->status ='1';
      $data1->message = 'success';
      array_push($result,$data1);
      $response->data = $data1;
        }
          else 
           {
              $data1->status ='0';
        $data1->message = 'failed';
        array_push($result,$data1);
        $response->data = $data1;
           }
              
           echo json_output($response);
       }
       ///////////////////////////////////////////////////////////////

   /*............End  trip by Delivery boy ......................*/
   public function end_trip_by_delivery_boy_post()
     {
         $response = new StdClass();
         $result = new StdClass();
         $delivery_id=$this->input->post('delivery_id');
         $latitude  = $this->input->post('latitude');
         $longitude = $this->input->post('longitude');
         $device_id  = $this->input->post('device_id');
         $mobile_no  = $this->input->post('mobile_no');
         date_default_timezone_set('Asia/kolkata'); 
         $now = date('Y-m-d H:i:s');
         $data->delivery_id  = $delivery_id;
         $data->latitude  = $latitude;
         $data->longitude = $longitude;
         $data->device_id = $device_id;
         $data->mobile_no = $mobile_no;
         $data->date_time = $now;
         $data->status='1';
         
         $res = $this->Deliveryboy->end_trip_by_delivery_boy($data);
         if(!empty($res))
          {
            $data1->status ='1';
            $data1->message = 'success';
            array_push($result,$data1);
            $response->data = $data1;
          }
          else
          {
            $data1->status ='0';
            $data1->message = 'failed';
             array_push($result,$data1);
              $response->data = $data1;
          }

        echo json_output($response);
     }


     public function gst_amount_detail_for_staff_post()
     {
      $response   =   new StdClass();
      $result       =  new StdClass();
      $dataotp = $this->Supervisor->get_gst_amount();
      $gst_amount=$dataotp->gst_amount;
      if(!empty($dataotp))
      {

        $data->gst_percentage=$gst_amount;
        $data->message = 'success';
        $data->status = '1';
        array_push($result,$data);
        $response->data = $data;
      }

      else
      {
        $data->message = 'failed';
        $data->status = '0';
        array_push($result,$data);
        $response->data = $data;
      }  
        echo json_output($response);
      }

       public function get_detail_for_particular_order_for_staff_post()
      {
        $response   =   new StdClass();
        $response1   =   new StdClass();
        $result       =   array();
        $order_id=$this->input->post('order_id');
        /*$order_status=$this->input->post('order_status');*/

        $data = $this->Supervisor->getGroupDatas($order_id);
        $arr = array();
        if(empty($data))
        {
          $response->status = 0;
          $response->message = "failed";
         //$response->data = $arr;
        }
        else
        {
          for($i=0;$i<count($data);$i++)
        {
            $result['order_id'] = $data[$i]['order_id'];
            $result['data'] = $this->Supervisor->getDataOrderWises($data[$i]['order_id']);
            array_push($arr, $result);
          
        }
        $response->status = 1;
        $response->message = "success";
        $response->data = $arr;

        }
        
        echo json_output($response);
      }


  /*.....................End  trip by Delivery boy ................*/

  

   }
