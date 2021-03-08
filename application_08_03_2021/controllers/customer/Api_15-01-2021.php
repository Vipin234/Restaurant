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
 
   }
   

  /*......... Login Api For Customer Hawker ---- */
   public function login_post()
    {
    $response = new StdClass();
    $result = new StdClass();
    $mobile_no = $this->input->post('mobile_no');
    $device_id=$this->input->post('device_id');
    $notification_id=$this->input->post('notification_id');
    date_default_timezone_set('Asia/kolkata'); 
    $now = date('Y-m-d H:i:s');
    $getdata1  =  $this->db
                  ->select('*')
                  ->from("tbl_registration_customer")
                  ->where(['mobile_no'=>$mobile_no,'active_status'=>'1'])
                  ->get()->result_array();
      if(!empty($mobile_no))
      {
        
      if(!empty($getdata1))
      {
      foreach ($getdata1 as $rowdata)
      {
      $otpValue=mt_rand(1000, 9999);
      $data1->device_id = $device_id;
      $data1->notification_id = $notification_id;
      $data1->login_time=$now;
      $data1->cus_id=$rowdata['cus_id'];
      $data1->name=$rowdata['name'];
      $data1->mobile_no=$rowdata['mobile_no'];
      $data1->email_id=$rowdata['email_id'];
      $data1->address=$rowdata['address'];
      $data1->otp=$otpValue;
      $res = $this->Customer->Add_registration_custumer_data($data1);
      $res3 = $this->Customer->send_otp($mobile_no,$otpValue);
      if($res3!='')
      {
      $res4 = $this->Customer->otpgetdata($data1);
      }
      $data['cus_id'] =  $rowdata['cus_id'];
      $data['message']  ='Success';
      $data['status']  ='1';
      array_push($result,$data);
      }
        $response->data = $result;
      }
      else
      { 
         $otpValue=mt_rand(1000, 9999);
         $data2->mobile_no=$mobile_no;
         $data2->active_status='1';
         $data2->create_date=$now;
         $result1 = $this->Customer->customer_add($data2);
         $alphanumerric='CUS_0000'.$result1;
         if(!empty($result1))
        {
        
         $data3->device_id = $device_id;
         $data3->notification_id = $notification_id;
         $data3->mobile_no=$mobile_no;
         $data3->cus_id=$alphanumerric;
         $data3->login_time=$now;
         $data3->otp=$otpValue;
         $res3 = $this->Customer->send_otp($mobile_no,$otpValue);
         if($res3!='')
          {
          $res4 = $this->Customer->otpgetdata($data3);
          }
         $updatedata = $this->Customer->update_customer_id($alphanumerric,$result1);
         $res = $this->Customer->Add_registration_custumer_data($data3);
         $alphanumerric='CUS_0000'.$result1;

        // $data['id']  =$result1;
         $data['cus_id']  =$alphanumerric;
         $data['status']  ='1';
         $data['message']  ='Success';
         array_push($result , $data);
         $response->data = $data;
         }
         else
         {
           $data['status']  ='0';
           $data['message']  ='registration failed';
           array_push($result,$data);
           $response->data = $data;
         }
        }
       }
        else
         {
            $data['status']  ='0';
       array_push($result , $data);
         }
            $response->data = $data;
            echo json_output($response);
      }
    
      /*.........Login Api For Customer Hawker ---- */

   /*.........Register_customer  Api For Fixer  ---- */
  public function customer_profile_update_post()
  {
    $response = new StdClass();
    $result = new StdClass();
    $cus_id = $this->input->post('cus_id');
    $name = $this->input->post('name');
    $state=$this->input->post('state');
    $city=$this->input->post('city');
    $address=$this->input->post('address');
    $gender=$this->input->post('gender');
    $date_of_birth=$this->input->post('date_of_birth');
    $area=$this->input->post('area');
    $pincode=$this->input->post('pincode');
    $mobile_no = $this->input->post('mobile_no');
    $email=$this->input->post('email');
    $cus_image=$this->input->post('cus_image');

    $data->cus_id = $cus_id;
    $data->name = $name;
    $data->state = $state;
    $data->city = $city;
    $data->address = $address;
    $data->gender = $gender;
    $data->date_of_birth = $date_of_birth;
    $data->area = $area;
    $data->pincode = $pincode;
    $data->mobile_no= $mobile_no;
    $data->email=$email;
    $data->cus_image =$cus_image;
    $result1 = $this->Customer->update_customer_profile($data);
    if(!empty($mobile_no))
    {
      $data1->status ='1';
      $data1->message = 'Profile successfully update';
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
     /*.........Register_customer  Api For Fixer  ---- */

   


     


  

    

   /*......... Get Validate CustomerUser Api For Fixer  ---- */
  public function Validate_active_customer_user_post()
   {
      $response = new StdClass();
      $cus_id = $this->input->post('cus_id');
      $result->cus_id = $cus_id;
      $this->load->model('User');
      $res = $this->User->Validate_customer_user($result);
      $active_status=$res->active_status;
      if($active_status=='1')
      {
      $response->status ='1';
      $response->message = 'success';
      }
      else if($active_status=='0')
      {
        $response->status ='2';
      $response->message = 'deactivate';
      }
      else
      {
      $response->status ='0';
      $response->message = 'failed';
      }
    echo json_output($response);
   }

   /*......... Get Validate CustomerUser Api For Fixer  ---- */
   /*......... profile update status  api for restaurant  ---- */
  public function check_profile_update_status_for_customer_post()
   {
      $response = new StdClass();
      $cus_id = $this->input->post('cus_id');
      $mobile_no = $this->input->post('mobile_no');
      
      $res = $this->Customer->check_profile_update_status($cus_id,$mobile_no);
      $profile_update_status=$res->profile_update_status;
      if($profile_update_status=='1')
      {
      $response->status ='1';
      $response->message = 'update';
      }
      else if($profile_update_status=='0')
      {
        $response->status ='0';
      $response->message = 'not update';
      }
      
    echo json_output($response);
   }

   /*......... Get Validate CustomerUser Api For Fixer  ---- */

  /*.........get fixer registartion data by catID   Api For Fixer  ---- */
  public function get_customer_profile_data_post()
    {
    $response   =   new StdClass();
    $result       =    new StdClass();
    $cus_id =$this->input->post('cus_id');
    $mobile_no =$this->input->post('mobile_no');
    $getdata = $this->Customer->customer_profile($cus_id,$mobile_no);
    if(!empty($getdata))
    {
     $data->cus_id=$getdata->cus_id;
     $dataimage=$getdata->cus_image;
    
   /* $cus_image_data=$getdata->cus_iamge;
    print_r($cus_image_data);
    die();*/
    if(!empty($dataimage))
    {
     $data->cus_image=$dataimage;
    }
    else
    {
      $data->cus_image='';
    }
    $name=$getdata->name;
    if($name=='')
    {
      $data->name='';
    }
    else
    {
       $data->name=$getdata->name;
    }
    $email_id=$getdata->email_id;
    if($email_id=='')
    {
       $data->email_id='';
    }
    else
    {
       $data->email_id=$getdata->email_id;
    }
    $date_of_birth=$getdata->date_of_birth;
    if($date_of_birth=='')
    {
       $data->date_of_birth='';
    }
    else
    {
      $data->date_of_birth=$getdata->date_of_birth;
    }
    $city=$getdata->city;
    if($city=='')
    {
       $data->city='';
    }
    else
    {
      $data->city=$getdata->city;
    }

    $state=$getdata->state;
    if($state=='')
    {
       $data->state='';
    }
    else
    {
      $data->state=$getdata->state;
    }
    $address=$getdata->address;
    if($address=='')
    {
       $data->address='';
    }
    else
    {
      $data->address=$getdata->address;
    }
    $area=$getdata->area;
    if($area=='')
    {
       $data->area='';
    }
    else
    {
      $data->area=$getdata->area;
    }
    $gender=$getdata->gender;
    if($gender=='')
    {
       $data->gender='';
    }
    else
    {
      $data->gender=$getdata->gender;
    }
    $pincode=$getdata->pincode;
    if($pincode=='')
    {
       $data->pincode='';
    }
    else
    {
      $data->pincode=$getdata->pincode;
    }
    
    $data->mobile_no=$getdata->mobile_no;
   /* $image_url=$cus_image;
    if($image_url=='')
    {
       $data->cus_image='';
    }
    else
    {
       $data->$cus_image;
    }*/
    $data->status='1';
    array_push($result,$data);
    $response->data = $data;
    }       
    else
    {
       $data->status='0';
      //$data['message'] = 'failed';
      array_push($result , $data);
    }
      $response->data = $data;
      echo json_output($response);
    }

/*........get fixer registartion data by catID  Api For Fixer  ---- */

/*.........Add order for customer  restaurant  for Restaurant Api  ---- */
    public function add_order_detail_for_restaurant_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
        $admin_id=$this->input->post('admin_id');
        $cus_id=$this->input->post('cus_id');
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
        $customer_mobile_no=$this->input->post('customer_mobile_no');
        
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $now1 = date('Y-m-d H:i:s');
        $data->admin_id=$admin_id;
        $data->cus_id=$cus_id;
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
        $data->customer_mobile_no=$customer_mobile_no;
        $data->create_date=$now;
        $data->date=$now1;
        $data->status='1';
        $que=$this->db->query("select * from tbl_order_detail_for_restaurant where table_no='".$table_no."' and order_status!='Complete' and admin_id='$admin_id' and payment_status!='1'");

         $row = $que->num_rows();
        if($row>0)
         {
            $data1->status ='2';
            $data1->message = 'This table is all ready book.';
            array_push($result2,$data1);
            $response->data = $data1;
         }
         else
         {
          $result = $this->Customer->add_order_detail_restaurant($data);
        $alphanumerric='ORD_0000'.$result;
        $update_order_detail = $this->Customer->update_order_id($alphanumerric,$result);
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

         }
        
      
       
      echo  json_output($response);
    }

   /*.........Role Api For Restaurant ---- */

   /*.........Add order for customer  restaurant  for Restaurant Api  ---- */
    public function change_order_for_particular_customer_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
        $order_id=$this->input->post('order_id');
        $admin_id=$this->input->post('admin_id');
        $cus_id=$this->input->post('cus_id');
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
        $customer_mobile_no=$this->input->post('customer_mobile_no');
        
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $now1 = date('Y-m-d H:i:s');
        $data->order_id=$order_id;
        $data->admin_id=$admin_id;
        $data->cus_id=$cus_id;
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
        $data->customer_mobile_no=$customer_mobile_no;
        $data->create_date=$now;
        $data->date=$now1;
        $data->status='1';
        $result = $this->Customer->add_order_detail_restaurant($data);
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

  /*.........get_order_detail_for_restaurant customer  Restaurant Api  ---- */
     public function get_order_detail_for_customer_post()
      {
        $response   =   new StdClass();
        $response1   =   new StdClass();
        $result       =   array();
        $customer_mobile_no=$this->input->post('customer_mobile_no');
        $customer_mobile_no1 = substr($customer_mobile_no, -6);

       /* $order_detail_for_customer = $this->Customer->order_detail_for_customer($customer_mobile_no,$customer_mobile_no1);*/
        $data = $this->Customer->getGroupData($customer_mobile_no,$customer_mobile_no1);
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
            $result['data'] = $this->Customer->getDataOrderWise($data[$i]['order_id']);
            array_push($arr, $result);
          
        }
        $response->status = 1;
        $response->message = "success";
        $response->data = $arr;

        }
        
        echo json_output($response);
        
        }


        /*if(!empty($order_detail_for_customer))
        {
         foreach ($order_detail_for_customer as $row)
           {
          $cus_id_data=$row['cus_id'];
          $adminID =   $row['admin_id'];
          $get_restaurant_name = $this->Customer->get_restaurant_name_data($adminID);
           $name=$get_restaurant_name->name;
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
            $data['restaurant_name'] =   $name;
            $data['cus_id'] =   $cus_id;
            $data['table_no'] =   $row['table_no'];
            $data['menu_item_name'] =   $row['menu_item_name'];
            $data['quantity'] =   $row['quantity'];
            $data['half_and_full_status'] =   $row['half_and_full_status'];
            $data['menu_price'] =   $row['menu_price'];
            $data['total_item'] =   $row['total_item'];
            $data['total_price'] =   $row['total_price'];
            $data['net_pay_amount'] =   $row['net_pay_amount'];
            $data['gst_amount'] =   $row['gst_amount'];
            $data['gst_amount_price'] =   $row['gst_amount_price'];
            $data['order_status'] =   $row['order_status'];
            $data['waiter_mobile_no'] =   $row['waiter_mobile_no'];
            $data['customer_mobile_no'] =   $row['customer_mobile_no'];
            $data['slip_status'] =   $row['slip_status'];
            $data['payment_status'] =   $row['payment_status'];
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
*/
      /*.........get_order_detail_for_restaurant Restaurant Api---- */

      /*........Get particular order detail  For Restaurant ---- */
     public function get_detail_for_particular_order_for_customer_post()
      {
        $response   =   new StdClass();
        $response1   =   new StdClass();
        $result       =   array();
        $order_id=$this->input->post('order_id');
        /*$order_status=$this->input->post('order_status');*/

        $data = $this->Customer->getGroupDatas($order_id);
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
            $result['data'] = $this->Customer->getDataOrderWises($data[$i]['order_id']);
            array_push($arr, $result);
          
        }
        $response->status = 1;
        $response->message = "success";
        $response->data = $arr;

        }
        
        echo json_output($response);
      }
      /*{
       $response = new StdClass();
        $result2 = new StdClass();
        $order_id=$this->input->post('order_id');

        $order_detail_for_restaurant = $this->Customer->get_order_detail_for_customer($order_id);
        $order_id=$order_detail_for_restaurant->order_id;
        $adminID=$order_detail_for_restaurant->admin_id;
        
          $get_restaurant_name = $this->Customer->get_restaurant_name_data($adminID);
           $name=$get_restaurant_name->name;

        $cus_id=$order_detail_for_restaurant->cus_id;
        $table_no=$order_detail_for_restaurant->table_no;
        $menu_item_name=$order_detail_for_restaurant->menu_item_name;
        $quantity=$order_detail_for_restaurant->quantity;
        $half_and_full_status=$order_detail_for_restaurant->half_and_full_status;
        $menu_price=$order_detail_for_restaurant->menu_price;
        $total_item=$order_detail_for_restaurant->total_item;
        $total_price=$order_detail_for_restaurant->total_price;
        $net_pay_amount=$order_detail_for_restaurant->net_pay_amount; 
        $gst_amount=$order_detail_for_restaurant->gst_amount;
        $gst_amount_price=$order_detail_for_restaurant->gst_amount_price;
        $order_status=$order_detail_for_restaurant->order_status;
        $payment_status=$order_detail_for_restaurant->payment_status;
        $customer_mobile_no=$order_detail_for_restaurant->customer_mobile_no;
        if(!empty($order_detail_for_restaurant))
        {
           $data2->order_id =$order_id;
           $data2->admin_id =$adminID;
           $data2->restaurant_name =$name;
           $data2->cus_id =$cus_id;
           $data2->table_no =$table_no;
           $data2->menu_item_name =$menu_item_name;
           $data2->quantity =$quantity;
           $data2->half_and_full_status =$half_and_full_status;
           $data2->menu_price =$menu_price;
           $data2->total_item =$total_item;
           $data2->total_price =$total_price;
           $data2->net_pay_amount =$net_pay_amount;
           $data2->gst_amount =$gst_amount;
           $data2->gst_amount_price =$gst_amount_price;
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

        public function get_detail_for_particular_order_by_customer_post()
        {
        $response   =   new StdClass();
        $response1   =   new StdClass();
        $result       =   array();
        $order_id=$this->input->post('order_ids');
        /*$order_status=$this->input->post('order_status');*/

        $data = $this->Customer->getGroupDatas($order_id);
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
            $result['data'] = $this->Customer->getDataOrderWises($data[$i]['order_id']);
            array_push($arr, $result);
          
        }
        $response->status = 1;
        $response->message = "success";
        $response->data = $arr;

        }
        
        echo json_output($response);
      }
     /* {
       $response = new StdClass();
        $result2 = new StdClass();
        $order_id=$this->input->post('order_id');
        $order_detail_for_restaurant = $this->Customer->get_order_detail_for_customer($order_id);
        $order_id=$order_detail_for_restaurant->order_id;
        $adminID=$order_detail_for_restaurant->admin_id;
        
        $get_restaurant_name = $this->Customer->get_restaurant_name_data($adminID);
        $name=$get_restaurant_name->name;

        
        $table_no=$order_detail_for_restaurant->table_no;
        $menu_item_name=$order_detail_for_restaurant->menu_item_name;
        $quantity=$order_detail_for_restaurant->quantity;
        $half_and_full_status=$order_detail_for_restaurant->half_and_full_status;
        $menu_price=$order_detail_for_restaurant->menu_price;
        $total_item=$order_detail_for_restaurant->total_item;
        $total_price=$order_detail_for_restaurant->total_price;
        $net_pay_amount=$order_detail_for_restaurant->net_pay_amount; 
        $gst_amount=$order_detail_for_restaurant->gst_amount;
        $gst_amount_price=$order_detail_for_restaurant->gst_amount_price;
        $order_status=$order_detail_for_restaurant->order_status;
        $payment_status=$order_detail_for_restaurant->payment_status;
        $customer_mobile_no=$order_detail_for_restaurant->customer_mobile_no;
        if(!empty($order_detail_for_restaurant))
        {
           $data2->order_id =$order_id;
           $data2->table_no =$table_no;
           $data2->total_item =$total_item;
           $data2->net_pay_amount =$net_pay_amount;
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


        /*public function get_detail_for_particular_order_for_customer_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $order_id=$this->input->post('order_id');

        $order_detail_for_customer = $this->Customer->order_detail_particular_for_customer($order_id);

        if(!empty($order_detail_for_customer))
        {
         foreach ($order_detail_for_customer as $row)
           {
          $cus_id_data=$row['cus_id'];
          $adminID =   $row['admin_id'];
          $get_restaurant_name = $this->Customer->get_restaurant_name_data($adminID);
           $name=$get_restaurant_name->name;
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
            $data['restaurant_name'] =   $name;
            $data['cus_id'] =   $cus_id;
            $data['table_no'] =   $row['table_no'];
            $data['menu_item_name'] =   $row['menu_item_name'];
            $data['quantity'] =   $row['quantity'];
            $data['menu_price'] =   $row['menu_price'];
            $data['total_item'] =   $row['total_item'];
            $data['total_price'] =   $row['total_price'];
            $data['gst_amount'] =   $row['gst_amount'];
            $data['order_status'] =   $row['order_status'];
            $data['waiter_mobile_no'] =   $row['waiter_mobile_no'];
            $data['customer_mobile_no'] =   $row['customer_mobile_no'];
            $data['slip_status'] =   $row['slip_status'];
            $data['payment_status'] =   $row['payment_status'];
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
        */
      /*..........Get particular order detail  For Restaurant  ---- */

   /*.........get menu data Api For Restaurant ---- */
     public function menu_list_data_customer_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $admin_id=$this->input->post('admin_id');
        $menu_list = $this->Customer->get_menu_list_data($admin_id);
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
     /*.........get Restaurant City For Restaurant ---- */
     public function get_city_for_restaurant_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $get_city = $this->Customer->get_city_list_data();
        if(!empty($get_city))
        {
         foreach ($get_city as $row)
           {
            $data['city'] =   $row['city'];
           
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

      /*.........get Restaurant City For Restaurant   ---- */
      /*.........get Restaurant City For Restaurant ---- */
     public function get_restaurant_list_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $city=$this->input->post('city');
        
        $get_restaurant_data = $this->Customer->get_restaurant_list_data($city);
       
    
        if(!empty($get_restaurant_data))
        {
         foreach ($get_restaurant_data as $row)
           {
            $data['admin_id'] =   $row['admin_id'];
            $data['city'] =   $row['city'];
            $data['spotId'] =   $row['spotId'];
            $data['trending'] =   $row['trending'];
            $data['name'] =   $row['name'];
            $data['image'] =   $row['image'];
            $data['rating'] =   $row['rating'];
            $data['lat'] =   $row['lat'];
            $data['lng'] =   $row['lng'];
            $data['location'] =   $row['location'];
            $data['cuisines'] =   $row['cuisines'];
            $data['priceLevel'] =   $row['priceLevel'];
            $data['cost'] =   $row['cost'];
            $data['openStatus'] =   $row['openStatus'];
            $data['openingTime'] =   $row['openingTime'];
            $data['closingTime'] =   $row['closingTime'];
            $data['phone'] =   $row['phone'];
            $data['address'] =   $row['address'];
            $data['amenities'] =  explode(",", $row['amenities']);
            $data['verified'] =   $row['verified'];
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

      /*.........get Restaurant City For Restaurant   ---- */

/*.........get_seller_list_data_by_location  Api For hawker  ---- */
  public function get_customer_list_data_by_location_post()
  {
    $response   =   new StdClass();
    //$response1  =   new StdClass();
    $result       =   array();
    $result1       =   array();
    $result2       =   array();
    $result3       =   array();
    $latitudeFrom =$this->input->post('latitude');
    $longitudeFrom =$this->input->post('longitude');
    $notification_id =$this->input->post('notification_id');
    $cus_id =$this->input->post('cus_id');
    $cat_id =$this->input->post('cat_id');
    $sub_cat_id =$this->input->post('sub_cat_id_1');
    $super_sub_cat_id =$this->input->post('sub_cat_id_2');
    $radius =$this->input->post('radius');
    $city =$this->input->post('city');
    date_default_timezone_set('Asia/kolkata'); 
    $now = date('Y-m-d H:i:s');
    $logdata->latitude = $latitudeFrom;
    $logdata->longitude = $longitudeFrom;
    $logdata->notification_id = $notification_id;
    $logdata->cus_id = $cus_id;
    $logdata->cat_id = $cat_id;
    $logdata->sub_cat_id = $sub_cat_id;
    $logdata->super_sub_cat_id = $super_sub_cat_id;
    $logdata->radius = $radius;
    $logdata->city = $city;
    $logdata->date_time=$now;
    $logdata->status='1';
    if($sub_cat_id=='' or $sub_cat_id=='0')
    {
    $getdata = $this->Customer->check_data_by_registerseller($cat_id,$city);
    $logdatalocation = $this->Customer->logdatalocation($logdata);
    $getcatdata = $this->Customer->customer_cat_data($cat_id);
    $cat_image=$getcatdata->cat_icon_image;
    $cat_data=$getcatdata->cat_name;
    $image_url=base_url().'manage/catImages/'.$cat_image; 
    }
   else
   {
     $getdata = $this->Customer->check_data_by_registerseller1($sub_cat_id,$city);
     $getsubdata = $this->Customer->customer_sub_cat_data($sub_cat_id);
      $logdatalocation = $this->Customer->logdatalocation($logdata);
     $sub_cat_image=$getsubdata->sub_cat_image;
     $cat_data=$getsubdata->sub_cat_name;
     $image_url=base_url().'manage/catImages/'.$sub_cat_image; 
   }
   if($sub_cat_id=='' or $sub_cat_id=='0')
   {
    $getdata1 = $this->Customer->check_data_by_registerseller2($cat_id,$city);
    $getcatdata = $this->Customer->customer_cat_data($cat_id);
     $logdatalocation = $this->Customer->logdatalocation($logdata);
    $cat_image=$getcatdata->cat_icon_image;
    $cat_data=$getcatdata->cat_name;
    $image_url=base_url().'manage/catImages/'.$cat_image; 
   }
   else
   {
     $getdata1 = $this->Customer->check_data_by_registerseller3($sub_cat_id,$city);
     $getsubdata = $this->Customer->customer_sub_cat_data($sub_cat_id);
      $logdatalocation = $this->Customer->logdatalocation($logdata);
     $sub_cat_image=$getsubdata->sub_cat_image;
     $cat_data=$getsubdata->sub_cat_name;
     $image_url=base_url().'manage/catImages/'.$sub_cat_image; 
   }
   if($sub_cat_id=='' or $sub_cat_id=='0')
    {
    $getdata_temp = $this->Customer->check_data_by_registerseller_temp_fix($cat_id,$city);
    $logdatalocation = $this->Customer->logdatalocation($logdata);
    $getcatdata = $this->Customer->customer_cat_data($cat_id);
    $cat_image=$getcatdata->cat_icon_image;
    $cat_data=$getcatdata->cat_name;
    $image_url=base_url().'manage/catImages/'.$cat_image; 
    }
   else
   {
     $getdata_temp = $this->Customer->check_data_by_registerseller1_temp_fix($sub_cat_id,$city);
     $getsubdata = $this->Customer->customer_sub_cat_data($sub_cat_id);
      $logdatalocation = $this->Customer->logdatalocation($logdata);
     $sub_cat_image=$getsubdata->sub_cat_image;
     $cat_data=$getsubdata->sub_cat_name;
     $image_url=base_url().'manage/catImages/'.$sub_cat_image; 
   }
   if($sub_cat_id=='' or $sub_cat_id=='0')
    {
    $getdata_seasonal = $this->Customer->check_data_by_registerseller_seasonal_fix($cat_id,$city);
    $logdatalocation = $this->Customer->logdatalocation($logdata);
    $getcatdata = $this->Customer->customer_cat_data($cat_id);
    $cat_image=$getcatdata->cat_icon_image;
    $cat_data=$getcatdata->cat_name;
    $image_url=base_url().'manage/catImages/'.$cat_image; 
    }
   else
   {
     $getdata_seasonal = $this->Customer->check_data_by_registerseller1_seasonal_fix($sub_cat_id,$city);
     $getsubdata = $this->Customer->customer_sub_cat_data($sub_cat_id);
      $logdatalocation = $this->Customer->logdatalocation($logdata);
     $sub_cat_image=$getsubdata->sub_cat_image;
     $cat_data=$getsubdata->sub_cat_name;
     $image_url=base_url().'manage/catImages/'.$sub_cat_image; 
   }
   if($sub_cat_id=='' or $sub_cat_id=='0')
    {
    $getdata_temp_moving = $this->Customer->check_data_by_registerseller_temp_moving($cat_id,$city);
    $logdatalocation = $this->Customer->logdatalocation($logdata);
    $getcatdata = $this->Customer->customer_cat_data($cat_id);
    $cat_image=$getcatdata->cat_icon_image;
    $cat_data=$getcatdata->cat_name;
    $image_url=base_url().'manage/catImages/'.$cat_image; 
    }
   else
   {
     $getdata_temp_moving = $this->Customer->check_data_by_registerseller1_temp_moving($sub_cat_id,$city);
     $getsubdata = $this->Customer->customer_sub_cat_data($sub_cat_id);
      $logdatalocation = $this->Customer->logdatalocation($logdata);
     $sub_cat_image=$getsubdata->sub_cat_image;
     $cat_data=$getsubdata->sub_cat_name;
     $image_url=base_url().'manage/catImages/'.$sub_cat_image; 
   }

   if($sub_cat_id=='' or $sub_cat_id=='0')
    {
    $getdata_seasonal_moving = $this->Customer->check_data_by_registerseller_seasonal_moving($cat_id,$city);
    $logdatalocation = $this->Customer->logdatalocation($logdata);
    $getcatdata = $this->Customer->customer_cat_data($cat_id);
    $cat_image=$getcatdata->cat_icon_image;
    $cat_data=$getcatdata->cat_name;
    $image_url=base_url().'manage/catImages/'.$cat_image; 
    }
   else
   {
     $getdata_seasonal_moving = $this->Customer->check_data_by_registerseller1_seasonal_moving($sub_cat_id,$city);
     $getsubdata = $this->Customer->customer_sub_cat_data($sub_cat_id);
      $logdatalocation = $this->Customer->logdatalocation($logdata);
     $sub_cat_image=$getsubdata->sub_cat_image;
     $cat_data=$getsubdata->sub_cat_name;
     $image_url=base_url().'manage/catImages/'.$sub_cat_image; 
   }

   if(!empty($getdata))
    {
    foreach ($getdata as $row)
    {
      $userType=$row['user_type'];

      if($userType=='Fix')
    {
      $rad = M_PI / 180;
     //Calculate distance from latitude and longitude
     $theta = $longitudeFrom - $row['shop_longitude'];
     $dist = sin($latitudeFrom * $rad) 
             * sin($row['shop_latitude'] * $rad) +  cos($latitudeFrom * $rad)
             * cos($row['shop_latitude'] * $rad) * cos($theta * $rad);

     $distance= acos($dist) / $rad * 60 *  2.250;
      if($distance<=$radius)
     {
      $data['name']   = $row['name'];
      $data['mobile_no']   = $row['mobile_no_contact'];
      $data['business_mobile_no']   = $row['business_mobile_no'];
      $mobile_no=$row['mobile_no_contact'];
      $data['image_url']=base_url().'assets/upload/profile_image/'.$mobile_no.".jpeg";
      $data['image_cat_url']=$image_url;
      $menu_image=$row['menu_image'];
      $menu_image_2=$row['menu_image_2'];
      $menu_image_3=$row['menu_image_3'];
      $menu_image_4=$row['menu_image_4'];

      if(!empty($menu_image) or (!empty($menu_image_2)) or (!empty($menu_image3)) or (!empty($menu_image_4)))
      {
         $data['menu_status'] ='1';
      }
      
      else
      {
        $data['menu_status'] ='0';
      }
      $data['fix_url']=base_url().'manage/catImages/shop.png'; 
      $data['cat_data']=$cat_data;
      $data['latitude'] =$row['shop_latitude'];
      $data['hawker_code'] =$row['hawker_code'];
      $data['longitude'] =$row['shop_longitude'];
      $data['distance'] =$distance;
      $data['user_type'] =$row['user_type'];
      $data['cus_id'] =$cus_id;
      $data['status'] ='1';
      array_push($result2,$data);
      $response->fix_status = '1';
      $response->set_timer = '20';
      $response->notified_maxtimer ='3';
      $response->fixdata = $result2;
    }
    else
    {
      $datanotified->latitude = $latitudeFrom;
      $datanotified->longitude = $longitudeFrom;
      $datanotified->cus_id = $cus_id;
      $datanotified->notification_id = $notification_id;
      $datanotified->cat_id = $cat_id;
      $datanotified->sub_cat_id = $sub_cat_id;
      $datanotified->super_sub_cat_id = $super_sub_cat_id;
      $datanotified->city = $city;
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $datanotified->date_time = $now;
      $datanotified->status='1';
      $notifieddata = $this->Customer->near_by_hawker_data($datanotified);
      $data4['status']  ='0';
      $data4['message']  ='failed';
      array_push($result , $data4);
      $response->fix_status = '2';
      $response->message = 'Hawker not available in your area.';
      $response->set_timer = '20';
      $response->notified_maxtimer ='3';
      $response->fixdata = $result;
    }
    }
    }
    }
    else if(!empty($getdata_temp))
    {
       foreach ($getdata_temp as $row_temp)
    {
      //$userType=$row['user_type'];
      $rad = M_PI / 180;
     //Calculate distance from latitude and longitude
     $theta = $longitudeFrom - $row_temp['shop_longitude'];
     $dist = sin($latitudeFrom * $rad) 
             * sin($row_temp['shop_latitude'] * $rad) +  cos($latitudeFrom * $rad)
             * cos($row_temp['shop_latitude'] * $rad) * cos($theta * $rad);

     $distance= acos($dist) / $rad * 60 *  2.250;

    
      if($distance<=$radius)
     {
      $data['name']   = $row_temp['name'];
      $data['mobile_no']   = $row_temp['mobile_no_contact'];
      $data['business_mobile_no']   = $row_temp['business_mobile_no'];
      $mobile_no=$row_temp['mobile_no_contact'];
      $data['image_url']=base_url().'assets/upload/profile_image/'.$mobile_no.".jpeg";
      $data['image_cat_url']=$image_url;
      $menu_image=$row_temp['menu_image'];
      $menu_image_2=$row_temp['menu_image_2'];
      $menu_image_3=$row_temp['menu_image_3'];
      $menu_image_4=$row_temp['menu_image_4'];

      if(!empty($menu_image) or (!empty($menu_image_2)) or (!empty($menu_image3)) or (!empty($menu_image_4)))
      {
         $data['menu_status'] ='1';
      }
      else
      {
        $data['menu_status'] ='0';
      }
      $data['fix_url']=base_url().'manage/catImages/shop.png'; 
      $data['cat_data']=$cat_data;
      $data['latitude'] =$row_temp['shop_latitude'];
      $data['hawker_code'] =$row_temp['hawker_code'];
      $data['longitude'] =$row_temp['shop_longitude'];
      $data['distance'] =$distance;
      $data['user_type'] =$row_temp['seasonal_temp_hawker_type'];
      $data['cus_id'] =$cus_id;
      $data['status'] ='1';
      array_push($result2,$data);
      $response->fix_status = '1';
      $response->set_timer = '20';
      $response->notified_maxtimer ='3';
      $response->fixdata = $result2;
    }
    else
    {
       $datanotified->latitude = $latitudeFrom;
      $datanotified->longitude = $longitudeFrom;
      $datanotified->cus_id = $cus_id;
      $datanotified->notification_id = $notification_id;
      $datanotified->cat_id = $cat_id;
      $datanotified->sub_cat_id = $sub_cat_id;
      $datanotified->super_sub_cat_id = $super_sub_cat_id;
      $datanotified->city = $city;
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $datanotified->date_time = $now;
      $datanotified->status='1';
      $notifieddata = $this->Customer->near_by_hawker_data($datanotified);
      $data4['status']  ='0';
      $data4['message']  ='failed';
      array_push($result , $data4);
      $response->fix_status = '2';
      $response->message = 'Hawker not available in your area.';
      $response->set_timer = '20';
      $response->notified_maxtimer ='3';
      $response->fixdata = $result;
    }
    }
    }
   else if(!empty($getdata_seasonal))
    {
       foreach ($getdata_seasonal as $row_seasonal)
    {
      //$userType=$row['user_type'];
      $rad = M_PI / 180;
     //Calculate distance from latitude and longitude
     $theta = $longitudeFrom - $row_seasonal['shop_longitude'];
     $dist = sin($latitudeFrom * $rad) 
             * sin($row_seasonal['shop_latitude'] * $rad) +  cos($latitudeFrom * $rad)
             * cos($row_seasonal['shop_latitude'] * $rad) * cos($theta * $rad);

     $distance= acos($dist) / $rad * 60 *  2.250;

    
      if($distance<=$radius)
     {
      $data['name']   = $row_seasonal['name'];
      $data['mobile_no']   = $row_seasonal['mobile_no_contact'];
      $data['business_mobile_no']   = $row_seasonal['business_mobile_no'];
      $mobile_no=$row_seasonal['mobile_no_contact'];
      $data['image_url']=base_url().'assets/upload/profile_image/'.$mobile_no.".jpeg";
      $data['image_cat_url']=$image_url;
      $menu_image=$row_seasonal['menu_image'];
      $menu_image_2=$row_seasonal['menu_image_2'];
      $menu_image_3=$row_seasonal['menu_image_3'];
      $menu_image_4=$row_seasonal['menu_image_4'];

      if(!empty($menu_image) or (!empty($menu_image_2)) or (!empty($menu_image3)) or (!empty($menu_image_4)))
      {
         $data['menu_status'] ='1';
      }
      else
      { 
        $data['menu_status'] ='0';
      }
      $data['fix_url']=base_url().'manage/catImages/shop.png'; 
      $data['cat_data']=$cat_data;
      $data['latitude'] =$row_seasonal['shop_latitude'];
      $data['hawker_code'] =$row_seasonal['hawker_code'];
      $data['longitude'] =$row_seasonal['shop_longitude'];
      $data['distance'] =$distance;
      $data['user_type'] =$row_seasonal['seasonal_temp_hawker_type'];
      $data['cus_id'] =$cus_id;
      $data['status'] ='1';
      array_push($result2,$data);
      $response->fix_status = '1';
      $response->set_timer = '20';
      $response->notified_maxtimer ='3';
      $response->fixdata = $result2;
    }
    else
    {
       $datanotified->latitude = $latitudeFrom;
      $datanotified->longitude = $longitudeFrom;
      $datanotified->cus_id = $cus_id;
      $datanotified->notification_id = $notification_id;
      $datanotified->cat_id = $cat_id;
      $datanotified->sub_cat_id = $sub_cat_id;
      $datanotified->super_sub_cat_id = $super_sub_cat_id;
      $datanotified->city = $city;
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $datanotified->date_time = $now;
      $datanotified->status='1';
      $notifieddata = $this->Customer->near_by_hawker_data($datanotified);
      $data4['status']  ='0';
      $data4['message']  ='failed';
      array_push($result , $data4);
      $response->fix_status = '2';
      $response->message = 'Hawker not available in your area.';
      $response->set_timer = '20';
      $response->notified_maxtimer ='3';
      $response->fixdata = $result;
    }
    }
    }
    else
    {
      $datanotified->latitude = $latitudeFrom;
      $datanotified->longitude = $longitudeFrom;
      $datanotified->cus_id = $cus_id;
      $datanotified->notification_id = $notification_id;
      $datanotified->cat_id = $cat_id;
      $datanotified->sub_cat_id = $sub_cat_id;
      $datanotified->super_sub_cat_id = $super_sub_cat_id;
      $datanotified->city = $city;
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $datanotified->date_time = $now;
      $datanotified->status='1';
      $notifieddata = $this->Customer->near_by_hawker_data($datanotified);
      $data['status']  ='0';
      $data['message'] = 'failed';
       array_push($result , $data);
      $response->fix_status = '2';
      $response->set_timer = '20';
      $response->notified_maxtimer ='3';
      $response->fixdata = $result;
    } 

    if(!empty($getdata1))
    {
     foreach ($getdata1 as $row1)
    {
    /*$gps_id=$row1['shop_gps_id'];*/
    $hawker_code=$row1['hawker_code'];
    $getdevicedata = $this->Customer->get_device_data($hawker_code);
    foreach ($getdevicedata as $getdevice)
    {
      $gps_id=$getdevice['device_id'];
      $getdata2 = $this->Customer->check_data_by_location($gps_id);
    foreach ($getdata2 as $row2)
    {
      $userType=$row1['user_type'];
      if($userType=='Moving')
    {
      $rad = M_PI / 180;
     //Calculate distance from latitude and longitude
     $theta = $longitudeFrom - $row2['longitude'];
     $dist = sin($latitudeFrom * $rad) 
             * sin($row2['latitude'] * $rad) +  cos($latitudeFrom * $rad)
             * cos($row2['latitude'] * $rad) * cos($theta * $rad);

     $distance= acos($dist) / $rad * 60 *  2.250;
      if($distance<$radius)
    {
      $data1['name']   = $row1['name'];
      $data1['mobile_no']   = $row1['mobile_no_contact'];
      $mobile_no=$row1['mobile_no_contact'];
      $data1['business_mobile_no']   = $row1['business_mobile_no'];
      $data1['image_url']=base_url().'assets/upload/profile_image/'.$mobile_no.".jpeg";
      $data1['image_cat_url']=$image_url;
      $menu_image=$row1['menu_image'];
      $menu_image_2=$row1['menu_image_2'];
      $menu_image_3=$row1['menu_image_3'];
      $menu_image_4=$row1['menu_image_4'];

    if(!empty($menu_image) or (!empty($menu_image_2)) or (!empty($menu_image3)) or (!empty($menu_image_4)))
      {
         $data1['menu_status'] ='1';
      }
      else
      { 
        $data1['menu_status'] ='0';
      }
      $data1['Moving_url']=base_url().'manage/catImages/moving_hawker12.png'; 
      $data1['cat_data']=$cat_data;
      $data1['latitude'] =$row2['latitude'];
      $data1['longitude'] =$row2['longitude'];
      $data1['hawker_code'] =$row1['hawker_code'];
      $data1['distance'] =$distance;
      $data1['user_type'] =$row1['user_type'];
      $data1['cus_id'] =$cus_id;
      $data1['status'] ='1';
      array_push($result3,$data1);
      $response->Moving_status = '1';
      $response->set_timer = '20';
      $response->notified_maxtimer ='3';
      $response->Movingdata = $result3;
      
     }
      else
     {
      $datanotified->latitude = $latitudeFrom;
      $datanotified->longitude = $longitudeFrom;
      $datanotified->cus_id = $cus_id;
      $datanotified->notification_id = $notification_id;
      $datanotified->cat_id = $cat_id;
      $datanotified->sub_cat_id = $sub_cat_id;
      $datanotified->super_sub_cat_id = $super_sub_cat_id;
      $datanotified->city = $city;
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $datanotified->date_time = $now;
      $datanotified->status='1';
      $notifieddata = $this->Customer->near_by_hawker_data($datanotified);
       $data5['status']  ='0';
       $data5['message']  ='failed';
       array_push($result1 , $data5);
       $response->Moving_status = '2';
       $response->message = 'Hawker not available in your area.';
       $response->set_timer = '20';
       $response->notified_maxtimer ='3';
       $response->Movingdata = $result1;
     }
     
    }
    }
    }
    }
    }
    else if(!empty($getdata_temp_moving))
    {
     foreach ($getdata_temp_moving as $row_temp_moving)
    {
    /*$gps_id=$row1['shop_gps_id'];*/
    $hawker_code=$row_temp_moving['hawker_code'];
    $getdevicedata = $this->Customer->get_device_data($hawker_code);
    foreach ($getdevicedata as $getdevice)
    {
      $gps_id=$getdevice['device_id'];
    $getdata2 = $this->Customer->check_data_by_location($gps_id);
    foreach ($getdata2 as $row2)
    {
      $rad = M_PI / 180;
     //Calculate distance from latitude and longitude
     $theta = $longitudeFrom - $row2['longitude'];
     $dist = sin($latitudeFrom * $rad) 
             * sin($row2['latitude'] * $rad) +  cos($latitudeFrom * $rad)
             * cos($row2['latitude'] * $rad) * cos($theta * $rad);

     $distance= acos($dist) / $rad * 60 *  2.250;
      if($distance<$radius)
    {
      $data1['name']   = $row_temp_moving['name'];
      $data1['mobile_no']   = $row_temp_moving['mobile_no_contact'];
      $mobile_no=$row_temp_moving['mobile_no_contact'];
      $data1['business_mobile_no']   = $row_temp_moving['business_mobile_no'];
      $data1['image_url']=base_url().'assets/upload/profile_image/'.$mobile_no.".jpeg";
      $data1['image_cat_url']=$image_url;
      $menu_image=$row_temp_moving['menu_image'];
      $menu_image_2=$row_temp_moving['menu_image_2'];
      $menu_image_3=$row_temp_moving['menu_image_3'];
      $menu_image_4=$row_temp_moving['menu_image_4'];

     if(!empty($menu_image) or (!empty($menu_image_2)) or (!empty($menu_image3)) or (!empty($menu_image_4)))
      {
         $data1['menu_status'] ='1';
      }
      else
      { 
        $data1['menu_status'] ='0';
      }
      $data1['Moving_url']=base_url().'manage/catImages/moving_hawker12.png'; 
      $data1['cat_data']=$cat_data;
      $data1['latitude'] =$row2['latitude'];
      $data1['longitude'] =$row2['longitude'];
      $data1['hawker_code'] =$row_temp_moving['hawker_code'];
      $data1['distance'] =$distance;
      $data1['user_type'] =$row_temp_moving['seasonal_temp_hawker_type'];
      $data1['cus_id'] =$cus_id;
      $data1['status'] ='1';
      array_push($result3,$data1);
      $response->Moving_status = '1';
      $response->set_timer = '20';
      $response->notified_maxtimer ='3';
      $response->Movingdata = $result3;
     }
      else
     {
      $datanotified->latitude = $latitudeFrom;
      $datanotified->longitude = $longitudeFrom;
      $datanotified->cus_id = $cus_id;
      $datanotified->notification_id = $notification_id;
      $datanotified->cat_id = $cat_id;
      $datanotified->sub_cat_id = $sub_cat_id;
      $datanotified->super_sub_cat_id = $super_sub_cat_id;
      $datanotified->city = $city;
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $datanotified->date_time = $now;
      $datanotified->status='1';
      $notifieddata = $this->Customer->near_by_hawker_data($datanotified);
       $data5['status']  ='0';
       $data5['message']  ='failed';
       array_push($result1 , $data5);
       $response->Moving_status = '2';
       $response->message = 'Hawker not available in your area.';
       $response->set_timer = '20';
       $response->notified_maxtimer ='3';
       $response->Movingdata = $result1;
       }
      }
     }
     }
    }

     else if(!empty($getdata_seasonal_moving))
    {
     foreach ($getdata_seasonal_moving as $row_seasonal_moving)
    {
    /*$gps_id=$row1['shop_gps_id'];*/
    $hawker_code=$row_seasonal_moving['hawker_code'];
    $getdevicedata = $this->Customer->get_device_data($hawker_code);
    foreach ($getdevicedata as $getdevice)
    {
      $gps_id=$getdevice['device_id'];
    $getdata2 = $this->Customer->check_data_by_location($gps_id);
    foreach ($getdata2 as $row2)
    {
      $rad = M_PI / 180;
     //Calculate distance from latitude and longitude
     $theta = $longitudeFrom - $row2['longitude'];
     $dist = sin($latitudeFrom * $rad) 
             * sin($row2['latitude'] * $rad) +  cos($latitudeFrom * $rad)
             * cos($row2['latitude'] * $rad) * cos($theta * $rad);

     $distance= acos($dist) / $rad * 60 *  2.250;
      if($distance<$radius)
    {
      $data1['name']   = $row_seasonal_moving['name'];
      $data1['mobile_no']   = $row_seasonal_moving['mobile_no_contact'];
      $mobile_no=$row_seasonal_moving['mobile_no_contact'];
      $data1['business_mobile_no']   = $row_seasonal_moving['business_mobile_no'];
      $data1['image_url']=base_url().'assets/upload/profile_image/'.$mobile_no.".jpeg";
      $data1['image_cat_url']=$image_url;
      $menu_image=$row_seasonal_moving['menu_image'];
      $menu_image_2=$row_seasonal_moving['menu_image_2'];
      $menu_image_3=$row_seasonal_moving['menu_image_3'];
      $menu_image_4=$row_seasonal_moving['menu_image_4'];
      if(!empty($menu_image) or (!empty($menu_image_2)) or (!empty($menu_image3)) or (!empty($menu_image_4)))
      {
         $data1['menu_status'] ='1';
      }
      else
      {

        $data1['menu_status'] ='0';
      }
      $data1['Moving_url']=base_url().'manage/catImages/moving_hawker12.png'; 
      $data1['cat_data']=$cat_data;
      $data1['latitude'] =$row2['latitude'];
      $data1['longitude'] =$row2['longitude'];
      $data1['hawker_code'] =$row_seasonal_moving['hawker_code'];
      $data1['distance'] =$distance;
      $data1['user_type'] =$row_seasonal_moving['seasonal_temp_hawker_type'];
      $data1['cus_id'] =$cus_id;
      $data1['status'] ='1';
      array_push($result3,$data1);
      $response->Moving_status = '1';
      $response->set_timer = '20';
      $response->notified_maxtimer ='3';
      $response->Movingdata = $result3;
      
     }
      else
     {
      $datanotified->latitude = $latitudeFrom;
      $datanotified->longitude = $longitudeFrom;
      $datanotified->cus_id = $cus_id;
      $datanotified->notification_id = $notification_id;
      $datanotified->cat_id = $cat_id;
      $datanotified->sub_cat_id = $sub_cat_id;
      $datanotified->super_sub_cat_id = $super_sub_cat_id;
      $datanotified->city = $city;
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $datanotified->date_time = $now;
      $datanotified->status='1';
      $notifieddata = $this->Customer->near_by_hawker_data($datanotified);
       $data5['status']  ='0';
       $data5['message']  ='failed';
       array_push($result1 , $data5);
       $response->Moving_status = '2';
       $response->message = 'Hawker not available in your area.';
       $response->set_timer = '20';
       $response->notified_maxtimer ='3';
       $response->Movingdata = $result1;
       }
      }
     }
     }
    }
    else
    {
      $datanotified->latitude = $latitudeFrom;
      $datanotified->longitude = $longitudeFrom;
      $datanotified->cus_id = $cus_id;
      $datanotified->notification_id = $notification_id;
      $datanotified->cat_id = $cat_id;
      $datanotified->sub_cat_id = $sub_cat_id;
      $datanotified->super_sub_cat_id = $super_sub_cat_id;
      $datanotified->city = $city;
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $datanotified->date_time = $now;
      $datanotified->status='1';
      $notifieddata = $this->Customer->near_by_hawker_data($datanotified);
      $data1['status']  ='0';
      $data1['message'] = 'failed';
      array_push($result1 , $data1);
     //$response->message = 'Hawker not available in your area.';
     $response->Moving_status = '2';
     $response->set_timer = '20';
     $response->notified_maxtimer ='3';
     $response->Movingdata = $result1;
    }
    echo json_output($response);
    }

    /*........get_seller_list_data_by_location Api For hawker  ---- */

     /*.........get banner image  Api For hawker  ---- */
       public function get_banner_image_post()
        {
        $response   =   new StdClass();
        $result       =   array();
        $getbannerimage       =  $this->db->where(['status'=>'1'])
                              ->get('tbl_restaurant_banner_image')->result_array();
        if(!empty($getbannerimage))
        {
         foreach ($getbannerimage as $row)
        {

        $data['banner_image'] =   $row['banner_image'];
        $data['message'] =   'success';
        $data['status']  = '1';
         array_push($result,$data);
         } 
         $response->data = $result;

         }  
         else
         {
        $data['message'] =   'failed';
         $data['status']  ='0';
         //$data['message'] = 'failed';
         array_push($result , $data);
         }
         $response->data = $result;
         echo json_output($response);
         }

       /*.........send  Dieloge box message  Api For hawker  ---- */

      /*.........Verification OTP Api For customer  ---- */

     public function verification_otp_customer_post()
     {
      $response   =   new StdClass();
      $result       =  new StdClass();
      $mobile_no =$this->input->post('mobile_no');
      $device_id =$this->input->post('device_id');
      $otp =$this->input->post('otp');
      $data1->device_id = $device_id;
      $data1->mobile_no = $mobile_no;
      $data1->otp=$otp;
      $dataotp = $this->Customer->verification_otp($data1);
      $cus_id=$dataotp->cus_id;
       $id=$dataotp->id;
      if(!empty($dataotp))
      {

        $data->cus_id=$cus_id;
        $data->id=$id;
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

       /*.........Verification OTP Api For customer  ---- */

       public function gst_amount_detail_customer_post()
     {
      $response   =   new StdClass();
      $result       =  new StdClass();
      $dataotp = $this->Customer->get_gst_amount();
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

      /*.........Resend OTP Api For customer  ---- */
      public function resend_otp_customer_post()
      {
      $response   =   new StdClass();
      $result       =  new StdClass();
      $device_id =$this->input->post('device_id');
      $mobile_no =$this->input->post('mobile_no');
      $otpValue=mt_rand(1000, 9999);
      $data1->device_id = $device_id;
      $data1->mobile_no=$mobile_no;
      $data1->otp=$otpValue;
      $res = $this->Customer->send_otp($mobile_no,$otpValue);
      if(!empty($mobile_no))
      {
      $res1 = $this->Customer->resend_otp($data1);

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

      /*.........Remove OTP Api For customer  ---- */
       public function otp_expire_post()
       {
        $response   =   new StdClass();
        $result       =  new StdClass();
        $device_id =$this->input->post('device_id');
        $mobile_no =$this->input->post('mobile_no');
        $data1->device_id = $device_id;
        $data1->mobile_no=$mobile_no;
        $res = $this->Customer->remove_otp($data1);
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

       /*.........Remove OTP Api For customer  ---- */

    /*.........favourite category/subcategory  Api For hawker customer  ---- */
    public function favourite_category_post()
    {
    $response = new StdClass();
    $result = new StdClass();
    $mobile_no = $this->input->post('mobile_no');
    $cus_id=$this->input->post('cus_id');
    $cat_id=$this->input->post('cat_id');
    $sub_cat_id=$this->input->post('sub_cat_id');
    $super_sub_cat_id=$this->input->post('super_sub_cat_id');
    date_default_timezone_set('Asia/kolkata'); 
    $now = date('Y-m-d H:i:s');
    $data->mobile_no = $mobile_no;
    $data->cus_id = $cus_id;
    $data->cat_id = $cat_id;
    $data->sub_cat_id = $sub_cat_id;
    $data->super_sub_cat_id = $super_sub_cat_id;
    $data->status='1';
    $data->time_date=$now;
    $result1 = $this->Customer->favourite_category_add($data);

    if(!empty($mobile_no))
    {
      $data1->status ='1';
      $data1->message = 'favourite category add Successfully';
      array_push($result,$data1);
      $response->data = $data1;
    }
    else
    {
      $response->status ='0';
      $response->message = 'failed';
    }
    echo json_output($response);
    }
    /*..........favourite category/subcategory  Api For hawker customer  ---- */

    /*.........favourite category/subcategory  Api For hawker customer  ---- */
    public function unfavourite_category_post()
    {
    $response = new StdClass();
    $result = new StdClass();
    $mobile_no = $this->input->post('mobile_no');
    $cus_id=$this->input->post('cus_id');
    $cat_id=$this->input->post('cat_id');
    $sub_cat_id=$this->input->post('sub_cat_id');
    $super_sub_cat_id=$this->input->post('super_sub_cat_id');
    date_default_timezone_set('Asia/kolkata'); 
    $now = date('Y-m-d H:i:s');
    $data->mobile_no = $mobile_no;
    $data->cus_id = $cus_id;
    $data->cat_id = $cat_id;
    $data->sub_cat_id = $sub_cat_id;
    $data->super_sub_cat_id = $super_sub_cat_id;
    $data->status='0';
    $data->time_date=$now;
    if($sub_cat_id=='' and $super_sub_cat_id=='')
    {
    $result1 = $this->Customer->unfavourite_category($data);
    }
    else if($cat_id=='' and $sub_cat_id=='')
    {
      $result1 = $this->Customer->unfavourite_category2($data);
    }
    else if($cat_id=='' and $super_sub_cat_id=='')
    {
      $result1 = $this->Customer->unfavourite_category1($data);
    }

    if(!empty($mobile_no))
    {
      $data1->status ='1';
      $data1->message = ' data update Successfully';
      array_push($result,$data1);
      $response->data = $data1;
    }
    else
    {
      $response->status ='0';
      $response->message = 'failed';
    }
    echo json_output($response);
    }
     /*..........favourite category/subcategory  Api For hawker customer  ---- */

     /*........Get Restaurant Detail BLE brodcast data Api  For Restaurant ---- */
     public function get_detail_for_restaurant_by_BLE_brodcast_post()
      {
       $response = new StdClass();
        $result2 = new StdClass();
        $BLE_id=$this->input->post('BLE_id');
        $detail_for_restaurant = $this->Customer->get_detail_for_restaurant_by_BLE_brodcast($BLE_id);
        $admin_id=$detail_for_restaurant->admin_id;
        $name=$detail_for_restaurant->name;
        $image=$detail_for_restaurant->image;
        $lat=$detail_for_restaurant->lat;
        $lng=$detail_for_restaurant->lng;
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

      /*........Get Restaurant Detail BLE brodcast data Api  For Restaurant   ---- */

  /*.........favourite category  Api For Fixer  ---- */
    public function favourite_category_data_post()
    {
      $response   =   new StdClass();
      $result       =   array();
      $cus_id=$this->input->post('cus_id');
      $datacat = $this->Customer->favourite_category_data_profile($cus_id);
      if(!empty($datacat))
      {
       foreach ($datacat as $row)
      {
      $cat_id=$row['cat_id'];
      $sub_cat_id=$row['sub_cat_id'];
      $super_sub_cat_id=$row['super_sub_cat_id'];
      if($sub_cat_id=='' and $super_sub_cat_id=='')
      {
      $datacat1 = $this->Customer->getcategory($cat_id);

     /* if(!empty($datacat1))
      {*/
      foreach ($datacat1 as $row1)
      {
       $data['id']    = $row1['id'];  
       $data['cat_name']    = $row1['cat_name'];
       $data['image_url']=base_url().'manage/catImages/'.$row1['cat_icon_image'];
       $data['status']  ='1';
       $data['status_type']='CATE';
      array_push($result,$data);
      }
       } 
     /* }*/
       if($cat_id=='' and $super_sub_cat_id=='')
       {
          $datacat3 = $this->Customer->get_sub_category($sub_cat_id);
       
      foreach ($datacat3 as $row2)
      {
       $data['id']    = $row2['id'];  
       $data['cat_name']    = $row2['sub_cat_name'];
       $data['image_url']=base_url().'manage/catImages/'.$row2['sub_cat_image'];
       $data['status']  ='1';
       $data['status_type']='SUBCATE';
      array_push($result,$data);
      }
       } 
       if($sub_cat_id=='' and $cat_id=='')
      {
      $datacat4 = $this->Customer->get_super_sub_category($super_sub_cat_id);

      if(!empty($datacat4))
      {
      foreach ($datacat4 as $row4)
      {
       $data['id']    = $row4['id'];  
       $data['cat_name']    = $row4['super_sub_cat_name'];
       $data['image_url']=base_url().'manage/catImages/'.$row4['super_sub_cat_image'];
       $data['status']  ='1';
       $data['status_type']='SUPSUBCATE';
      array_push($result,$data);
      }

       } 
      }
      $response->favourite = $result;
      }
     }
      else
      {
       $data['status']  ='0';
       array_push($result , $data);
       $response->favourite = $result;
      }

      
      echo json_output($response);
     }
    /*.........favourite category Api For Fixer  ---- */

    /*.........Customer call by hawker Api For hawker customer  ---- */
    public function customer_call_by_hawker_post()
    {
    $response = new StdClass();
    $result = new StdClass();
    $cus_id = $this->input->post('cus_id');
    $hawker_id=$this->input->post('hawker_id');
    $customer_no=$this->input->post('customer_no');
    $latitude=$this->input->post('latitude');
    $longitude=$this->input->post('longitude');
    date_default_timezone_set('Asia/kolkata'); 
    $now = date('Y-m-d H:i:s');
    $data->cus_id = $cus_id;
    $data->hawker_id = $hawker_id;
    $data->customer_no = $customer_no;
    $data->latitude = $latitude;
    $data->longitude = $longitude;
    $data->date_time=$now;
    $data->status='1';
    $result1 = $this->Customer->get_data_by_customer($data);

    if(!empty($result1))
    {
      $data1->status ='1';
      $data1->message = 'add Successfully';
      array_push($result,$data1);
      $response->data = $data1;
    }
    else
    {
      $response->status ='0';
      $response->message = 'failed';
    }
    echo json_output($response);
    }
    /*..........Customer call by hawker Api For hawker customer  ---- */

    /*.........Customer Navigate by hawker Api For hawker customer  ---- */
    public function customer_navigate_by_hawker_post()
    {
    $response = new StdClass();
    $result = new StdClass();
    $cus_id = $this->input->post('cus_id');
    $hawker_id=$this->input->post('hawker_id');
    $customer_no=$this->input->post('customer_no');
    $latitude=$this->input->post('latitude');
    $longitude=$this->input->post('longitude');
    date_default_timezone_set('Asia/kolkata'); 
    $now = date('Y-m-d H:i:s');
    $data->cus_id = $cus_id;
    $data->hawker_id = $hawker_id;
    $data->customer_no = $customer_no;
    $data->latitude = $latitude;
    $data->longitude = $longitude;
    $data->date_time=$now;
    $data->status='1';
    $result1 = $this->Customer->get_navigate_by_customer($data);

    if(!empty($result1))
    {
      $data1->status ='1';
      $data1->message = 'add Successfully';
      array_push($result,$data1);
      $response->data = $data1;
    }
    else
    {
      $response->status ='0';
      $response->message = 'failed';
    }
    echo json_output($response);
    }
    /*..........Customer Navigate  by hawker Api For hawker customer  ---- */

    /*.........Customer Navigate by hawker Api For hawker customer  ---- */
    public function notified_custumer_by_time_set_post()
    {
    $response = new StdClass();
    $result = new StdClass();
    $cus_id = $this->input->post('cus_id');
    $cat_id = $this->input->post('cat_id');

    $sub_cat_id = $this->input->post('sub_cat_id');
    $super_sub_cat_id = $this->input->post('super_sub_cat_id');
    $radius=$this->input->post('radius'); 
    $notification_id=$this->input->post('notification_id');
    $set_time=$this->input->post('set_time');
    $data->cus_id = $cus_id;
    $data->cat_id = $cat_id;
    $data->sub_cat_id = $sub_cat_id;
    $data->super_sub_cat_id = $super_sub_cat_id;
    $data->radius = $radius;
    $data->notification_id = $notification_id;
    $data->set_time = $set_time;
   /////////////// history tabble for radius data//////////
   
    if(!empty($cat_id))
    {
       $result5=$this->Customer->insert_notified_data($data);
        /////////////// history tabble for radius data//////////
      $result1 = $this->Customer->send_set_time_for_notification($data);
      $data1->status ='1';
      $data1->message = 'data Update Successfully';
      array_push($result,$data1);
      $response->data = $data1;
    }
    else
    {
      $response->status ='0';
      $response->message = 'failed';
    }
    echo json_output($response);
    }
    /*..........Customer Navigate  by hawker Api For hawker customer  ---- */

  /*......... Get Check Version data   ---- */
  public function app_check_version_post()
   {
    $response = new StdClass();
    $result2 = new StdClass();
    $version_name = $this->input->post('version_name');
    $version_code =$this->input->post('version_code');
    $result->version_name = $version_name;
    $result->version_code = $version_code;
    $res = $this->Customer->Validate_version_data($result);
    if($res!='')
    {
    $data1->status ='1';
    $data1->message = 'success';
    array_push($result2,$data1);
    $response->data = $data1;
      }
    
    else
    {
      $data1->status ='0';
      $data1->message = 'Update Your Application';
      array_push($result2,$data1);
      $response->data = $data1;
    }
    echo json_output($response);
   }
      /*......... Get Check Version data  ---- */

       /*.........favourite category  Api For Fixer  ---- */
    public function show_notification_data_post()
    {
      $response   =   new StdClass();
      $result       =   array();
      $cus_id=$this->input->post('cus_id');
      $datacat = $this->Customer->catgory_notification_data($cus_id);
      if(!empty($cus_id))
      {
      if(!empty($datacat))
      {
       foreach ($datacat as $row)
      {
      
       $data['title']    = $row['title'];  
       $data['message']    = $row['message'];
       $data['date_time']=$row['date_time'];
       $data['status']  ='1';
      array_push($result,$data);
      }
      } 
     /* }*/
     
      $datacat3 = $this->Customer->sub_catgory_notification_data($cus_id);
       if(!empty($datacat3))
       {
      foreach ($datacat3 as $row2)
      {
       $data['title']    = $row2['title'];  
       $data['message']    = $row2['message'];
       $data['date_time']=$row2['date_time'];
       $data['status']  ='1';
      array_push($result,$data);
      }
    }
        
       
      $datacat4 = $this->Customer->moving_notification_data($cus_id);

      if(!empty($datacat4))
      {
      foreach ($datacat4 as $row4)
      {
      $data['title']    = $row4['title'];  
       $data['message']    = $row4['message'];
       $data['date_time']=$row4['date_time'];
       $data['status']  ='1';
      array_push($result,$data);
      }
       }

    if($datacat=='' and $datacat3=='' and $datacat4=='')
    {
      $data['status']  ='0';
      array_push($result,$data);
    }
      $response->data = $result;
     }
      else
      {
       $data['status']  ='0';
       array_push($result , $data);
       $response->data = $result;
      }

      
      echo json_output($response);
     }
    /*.........favourite category Api For Fixer  ---- */

     /*......... logout Api For Door hawker ---- */
    public function data_logout_for_customer_post()
    {
    $response = new StdClass();
    $result = array();
    $device_id =$this->input->post('device_id');
    $cus_id =$this->input->post('cus_id');
    date_default_timezone_set('Asia/kolkata'); 
    $now = date('Y-m-d H:i:s');
    $data->cus_id = $cus_id;
    $data->device_id = $device_id;
    $data->logout_time=$now;
    $resdata1 = $this->Customer->logout_customer_data($data);
    if(!empty($device_id) and !empty($cus_id))
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

    /*......... logout Api For Door hawker ---- */
    public function service_request_city_by_customer_post()
    {
    $response = new StdClass();
    $result = array();
    $city =$this->input->post('city');
    $notification_id =$this->input->post('notification_id');
    date_default_timezone_set('Asia/kolkata'); 
    $now = date('Y-m-d H:i:s');
    $data->city = $city;
    $data->notification_id = $notification_id;
    $data->date_time=$now;
    $resdata1 = $this->Customer->request_city_by_customer_data($data);
    if($resdata1!='')
    {
    $data1->status ='1';
    $data1->message=' success';
    array_push($result,$data1);
    $response->data = $data1;
      }
        else
        {
          $data1->status ='0';
          $data1->message ='failed';
      array_push($result,$data1);
       $response->data = $data1;
        }
    echo json_output($response);
   }

    /*......... logout data From Wifi-module Api For Door Unlock ---- */

    /*......... feedback Api for restaurant by  customer  ---- */
  public function feedback_detail_for_customer_post()
   {
      $response = new StdClass();
      $result = new StdClass();
      $cus_id = $this->input->post('cus_id');
      $detail = $this->input->post('detail');
      $customer_mobile_no = $this->input->post('customer_mobile_no');
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $data->cus_id = $cus_id;
      $data->detail = $detail;
      $data->customer_mobile_no = $customer_mobile_no;
      $data->create_date = $now;
      $data->status = '1';
      $res = $this->Customer->feedback_data($data);
      if(!empty($res))
      {
      $data1->status ='1';
      $data1->message ='Your feedback has been send successfully.';
      array_push($result,$data1);
      $response->data = $data1;
      }
      else
      {
      $data1->status ='0';
      $data1->message ='failed';
      array_push($result,$data1);
      $response->data = $data1;
      }
    echo json_output($response);
   }

   /*.........  feedback Api for hawker customer  ---- */

   /*........Rating for customer for restaurant ---- */

    public function rating_for_restaurant_by_customer_post()
    {
     $response = new StdClass();
     $result = new StdClass();
     $admin_id  = $this->input->post('admin_id');
     $res_id  = $this->input->post('res_id');
     $cus_id  = $this->input->post('cus_id');
     $customer_mobile_no  = $this->input->post('customer_mobile_no');
     $rating_point  = $this->input->post('rating_point');
     $detail  = $this->input->post('detail');
     date_default_timezone_set('Asia/kolkata'); 
     $now = date('Y-m-d H:i:s');
     $data->admin_id  = $admin_id;
     $data->res_id  = $res_id;
     $data->cus_id  = $cus_id;
     $data->customer_mobile_no  = $customer_mobile_no;
     $data->rating_point  = $rating_point;
     $data->customer_mobile_no  = $customer_mobile_no;
     $data->detail  = $detail;
     $data->create_date = $now;
     $data->status='1';
     $res = $this->Customer->rating_for_restaurant_customer($data);
   
     if(!empty($customer_mobile_no))
      {
       $query = $this->db->query("SELECT AVG(rating_point) as AVGRATE from tbl_rating_for_customer where admin_id='$admin_id' and res_id='$res_id'");
      $current_data=$query->result_array();
     $array = implode(',', $current_data[0]);
     $arraydata=number_format($array,2);

      $rating_point = $this->Customer->average_rating_for_restaurant($arraydata,$admin_id);

     /*if($array!='')
      {
        
      }
      else
      {
         $arraydata='0';
      }*/
       
       $data2->status ='1';
       $data2->message = 'success';
      array_push($result,$data2);
      $response->data = $data2;
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
    /*........Rating for customer for restaurant ---- */
    /*.........Add order for customer  restaurant  for Restaurant Api  ---- */
    public function add_contact_detail_for_customer_post()
    {   
        $response = new StdClass();
        $result2 = new StdClass();
        $name=$this->input->post('name');
        $email=$this->input->post('email');
        $mobile_no=$this->input->post('mobile_no');
        $message=$this->input->post('message');
        
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $data->name=$name;
        $data->email=$email;
        $data->mobile_no=$mobile_no;
        $data->message=$message;
        $data->create_date=$now;
        $data->status='1';
        $result = $this->Customer->add_contact_detail($data);
        if(!empty($result))
        {  
            $data2->status ='1';
            $data2->message = 'your query successfully saved';
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
    /*.........Update  payment status for restaurant---- */
    public function update_payment_for_customer_post()
     {
        $response   =   new StdClass();
        $result       =  new StdClass();
        $order_id =$this->input->post('order_id');
        $admin_id =$this->input->post('admin_id');
        $payment_status =$this->input->post('payment_status');
        $data->order_id = $order_id;
        $data->admin_id=$admin_id;
        $data->payment_status=$payment_status;
        $res1 = $this->Customer->update_payment_status($data);
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

    /*......... check data for customer  ---- */
  public function customer_data_post()
   {
      $response = new StdClass();
      $result = new StdClass();
      $mobile_no = $this->input->post('mobile_no');
      $res = $this->Customer->customer_data($mobile_no);
      if($mobile_no=='')
      {
      $data1->status ='2';
      array_push($result,$data1);
      $response->data = $data1;
      }
      else if(!empty($res))
      {
      $data1->status ='1';
      array_push($result,$data1);
      $response->data = $data1;
      }
      else
      {
      $data1->status ='0';
      $data1->message ='Please Re-Login / Restart Application \n Press OK';
      array_push($result,$data1);
      $response->data = $data1;
      }
    echo json_output($response);
   }

   /*......... check data for customer ---- */

   public function show_notification_by_count_post()
    {
    $response =   new StdClass();
    $result       =  new StdClass();
    $customer_mobile_no =$this->input->post('customer_mobile_no');
    $resdata = $this->Customer->check_total_count_notification($customer_mobile_no);
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

   /*.........notification list for staff in  Restaurant ---- */
     public function get_notification_list_for_order_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $customer_mobile_no=$this->input->post('customer_mobile_no');
        $get_notification_data = $this->Customer->get_notification_data($customer_mobile_no);
        if(!empty($get_notification_data))
        {
         foreach ($get_notification_data as $row)
           {
           $admin_id=$row['admin_id'];
           $get_restaurant_name = $this->Customer->get_restaurantName($admin_id);
           $name=$get_restaurant_name->name;
            $data['order_id'] =   $row['order_id'];
            $data['restaurant_name'] = $name;
            $data['customer_mobile_no'] =   $row['customer_mobile_no'];
            $data['title'] =   $row['title'];
            $data['message'] =   $row['message'];
            $data['create_date'] =   $row['date_time'];
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

       public function get_notification_status_by_restaurant_post()
    {
    $response =   new StdClass();
    $result       =  new StdClass();
    $customer_mobile_no =$this->input->post('customer_mobile_no');
    $check_status =$this->input->post('check_status');
    if($check_status=='1' and $customer_mobile_no!='')
    {
       $resdata = $this->Customer->check_status_for_notification($check_status,$customer_mobile_no);
    
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
       /*.........food tyoe api for  Restaurant ---- */
     public function get_food_type_post()
      {
        $response   =   new StdClass();
        $result       =   array();
        $food_type = $this->Customer->get_food_type();
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

  }
