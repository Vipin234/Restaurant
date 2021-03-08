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
        if($result < 99)
        {
          $alphanumerric='00'.$result;

        }else if($result > 99 && $result < 999)
        {
          $alphanumerric='0'.$result;
        }else
        {
          $alphanumerric=$result;
        }
        $update_order_detail = $this->Customer->update_order_id($alphanumerric,$result);
        if(!empty($result))
        {  

                    $menu_item_array      =explode(",",rtrim($menu_item_name,","));
                    $menu_price           =explode(",",rtrim($menu_price,","));
                    $quantity             =explode(",",rtrim($quantity,","));
                    $half_and_full_status =explode(",",rtrim($half_and_full_status,","));


                         for($i=0;$i<count($menu_item_array);$i++)
                          {

                            $insert_array[]=array(
                                            'menu_item_name'=>$menu_item_array[$i],
                                            'quantity'=>$quantity[$i],
                                            'half_and_full_status'=>$half_and_full_status[$i],
                                            'menu_price'=>$menu_price[$i],
                                            'order_id'=>$alphanumerric,
                                            'status'=>'1',
                                            'admin_id'=>$admin_id
                                              );
                          
                          }
                          // print_r($insert_array);exit;
                        $this->Supervisor->insertBatchOrder($insert_array);
            $data2->status ='1';
            $data2->message = 'Order Placed successfully';
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
        // $cus_id=$this->input->post('cus_id');
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
        $cus_id=$this->Customer->getCustId($order_id,$admin_id,$customer_mobile_no);
        $max_id=$this->Supervisor->getMax($order_id,$admin_id);
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $now1 = date('Y-m-d H:i:s');
        $data->order_id=$order_id;
        $data->admin_id=$admin_id;
        if($max_id < 99)
        {
                  $data->sub_order_id='00'.($max_id+1);
                  $sub_order_id='00'.($max_id+1);

        }else if($max_id < 999 && $max_id > 99)
        {
                  $data->sub_order_id='0'.($max_id+1);
                  $sub_order_id='0'.($max_id+1);

        }else 
        {
                  $data->sub_order_id=($max_id+1);
                  $sub_order_id=($max_id+1);

        }
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
        $result = $this->Customer->add_sub_order_detail_restaurant($data);
       
        if(!empty($result))
        {  

              $menu_item_array      =explode(",",rtrim($menu_item_name,","));
              $menu_price           =explode(",",rtrim($menu_price,","));
              $quantity             =explode(",",rtrim($quantity,","));
              $half_and_full_status =explode(",",rtrim($half_and_full_status,","));

             for($i=0;$i<count($menu_item_array);$i++)
              {

                $insert_array[]=array(
                                'menu_item_name'=>$menu_item_array[$i],
                                'quantity'=>$quantity[$i],
                                'half_and_full_status'=>$half_and_full_status[$i],
                                'menu_price'=>$menu_price[$i],
                                'sub_order_id'=>$sub_order_id,
                                'order_id'=>$order_id,
                                'status'=>'1',
                                'admin_id'=>$admin_id
                                );
              
              }
              // print_r($insert_array);exit;
            $this->Supervisor->insertBatchSubOrder($insert_array);
            $data2->status ='1';
            $data2->message = 'Order Placed successfully';
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

        $result               =array();
        $arr                  =array();
        $finalarray           =array();
        $customer_mobile_no   =$this->input->post('customer_mobile_no');
        $customer_mobile_no1  =substr($customer_mobile_no, -6);
        $data = $this->Customer->getGroupData($customer_mobile_no,$customer_mobile_no1);
        
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
              // print_r($data);exit;
              $result['order_id']                                     =$data[$i]['order_id'];
              $result['admin_id']                                     =$data[$i]['admin_id'];
              $result['cus_id']                    
                                 =$data[$i]['cus_id'];
              $MwnuItemResult                                         =$this->Customer->getMenuItemForOrder($result['order_id'],$result['admin_id']);
                  foreach($MwnuItemResult as $menuValue)
                  {
                    $menuImages[]               =$menuValue['menu_item_name'];
                    $menuquantity[]             =$menuValue['quantity'];
                    $menuhalf_and_full_status[] =$menuValue['half_and_full_status'];
                    $menumenu_price[]           =$menuValue['menu_price'];
                    $menumenu_id[]              =$menuValue['id'];

                  }
              $result['id']                                           =implode(',',$menumenu_id).',';
              $result['menu_item_name']                               =implode(',',$menuImages).',';
              $result['quantity']                                     =implode(',',$menuquantity).',';
              $result['half_and_full_status']                         =implode(',',$menuhalf_and_full_status).',';
              $result['menu_price']                                   =implode(',',$menumenu_price).',';    
              $result['total_item']                                   =$data[$i]['total_item'];
              $result['total_price']                                  =$data[$i]['total_price'];
              $result['net_pay_amount']                               =$data[$i]['net_pay_amount'];
              $result['gst_amount']                                   =$data[$i]['gst_amount'];
              $result['gst_amount_price']                             =$data[$i]['gst_amount_price'];
              $result['order_status']                                 =$data[$i]['order_status'];
              $result['waiter_mobile_no']                             =$data[$i]['waiter_mobile_no'];
              $result['customer_mobile_no']                           =$data[$i]['customer_mobile_no'];
              $result['confirm_order_by']                             =$data[$i]['confirm_order_by'];
              $result['create_slip_by']                               =$data[$i]['create_slip_by'];
              $result['order_ready_to_serve_by']                      =$data[$i]['order_ready_to_serve_by'];
              $result['order_complete_by']                            =$data[$i]['order_complete_by'];
              $result['order_delete_by']                              =$data[$i]['order_delete_by'];
              $result['order_change_by']                              =$data[$i]['order_change_by'];
              $result['create_date']                                  =$data[$i]['create_date'];
              $result['date']                                         =$data[$i]['date'];
              $result['modified_date']                                =$data[$i]['modified_date'];
              $result['slip_status']                                  =$data[$i]['slip_status'];
              $result['payment_status']                               =$data[$i]['payment_status'];
              $result['notification_status_by_staff']                 =$data[$i]['notification_status_by_staff'];
              $result['NS_for_complete_by_waiter']                    =$data[$i]['NS_for_complete_by_waiter'];
              $result['NS_for_kot_for_staff']                         =$data[$i]['NS_for_kot_for_staff'];
              $result['NS_for_complete_by_waiter_for_customer']       =$data[$i]['NS_for_complete_by_waiter_for_customer'];
              $result['NS_for_kitchen_for_staff']                     =$data[$i]['NS_for_kitchen_for_staff'];
              $result['NS_for_complete_by_chef']                      =$data[$i]['NS_for_complete_by_chef'];
              $result['NS_for_kitchen_for_waiter']                    =$data[$i]['NS_for_kitchen_for_waiter'];
              $result['notification_status_by_customer']              =$data[$i]['notification_status_by_customer'];
              $result['NS_for_kot_for_customer']                      =$data[$i]['NS_for_kot_for_customer'];
              $result['payment_by']                                   =$data[$i]['payment_by'];
              $result['get_payment']                                  =$data[$i]['get_payment'];
              $result['status']                                       =$data[$i]['status'];
              $result['inv_created_by']                               =$data[$i]['inv_created_by'];
              $result['RestaurentName']                               =$data[$i]['RestaurentName'];
              $subOrderRes                                            =$this->Customer->getSubOrder($data[$i]['order_id'],$data[$i]['admin_id']);
               if(!empty($subOrderRes))
                  {
                    foreach ($subOrderRes as $value)
                    {
                      $result2['order_id']     =$data[$i]['order_id'];
                      $result2['admin_id']     =$data[$i]['admin_id'];
                      $result2['sub_order_id'] =$value['sub_order_id'];
                      $menuResult2 =$this->Customer->getMenuItemForSubOrder($data[$i]['order_id'],$data[$i]['admin_id'],$result2['sub_order_id']);
                      
                      foreach($menuResult2 as $menuValue2)
                      {
                        $menuImages2[]               =$menuValue2['menu_item_name'];
                        $menuquantity2[]             =$menuValue2['quantity'];
                        $menuhalf_and_full_status2[] =$menuValue2['half_and_full_status'];
                        $menumenu_price2[]           =$menuValue2['menu_price'];
                        $menu_id[]                   =$menuValue2['id'];

                      } 
                                  // print_r(implode(',',$menuImages2).',');exit;
                      $result2['menu_item_name']=implode(',',$menuImages2).',';
                      $result2['menu_item_id']=implode(',',$menu_id).',';
                                  // $result2['menu_item_name']=$value['menu_item_name'];
                      $result2['quantity']=implode(',',$menuquantity2).',';
                      $result2['half_and_full_status']=implode(',',$menuhalf_and_full_status2).',';
                      $result2['menu_price']=implode(',',$menumenu_price2).',';
                      $result2['total_item']       =$value['total_item'];
                      $result2['net_pay_amount']       =$value['net_pay_amount'];
                      $result2['gst_amount']       =$value['gst_amount'];
                      $result2['gst_amount_price']       =$value['gst_amount_price'];
                      $result2['order_status']       =$value['order_status'];
                      $result2['waiter_mobile_no']       =$value['waiter_mobile_no'];
                      $result2['customer_mobile_no']       =$value['customer_mobile_no'];
                      $result2['create_slip_by']       =$value['create_slip_by'];
                      $result2['order_complete_by']       =$value['order_complete_by'];
                      $result2['order_delete_by']       =$value['order_delete_by'];
                      $result2['date']       =$value['date'];
                      $result2['modified_date']       =$value['modified_date'];
                      $result2['slip_status']       =$value['slip_status'];
                      $result2['payment_status']       =$value['payment_status'];
                      $result2['notification_status_by_staff']       =$value['notification_status_by_staff'];
                      $result2['NS_for_complete_by_waiter']       =$value['NS_for_complete_by_waiter'];
                      $result2['NS_for_kot_for_staff']       =$value['NS_for_kot_for_staff'];
                      $result2['NS_for_kitchen_for_staff']       =$value['NS_for_kitchen_for_staff'];
                      $result2['NS_for_complete_by_chef']       =$value['NS_for_complete_by_chef'];
                      $result2['NS_for_kitchen_for_waiter']       =$value['slip_status'];
                      $result2['notification_status_by_customer']       =$value['notification_status_by_customer'];
                      $result2['NS_for_complete_by_waiter_for_customer']       =$value['NS_for_complete_by_waiter_for_customer'];
                      $result2['NS_for_kot_for_customer']       =$value['NS_for_kot_for_customer'];
                      $result2['NS_for_kitchen_for_customer']       =$value['NS_for_kitchen_for_customer'];
                      $result2['payment_by']       =$value['payment_by'];
                      $result2['get_payment']       =$value['get_payment'];
                      $result2['status']       =$value['status'];
                      $result2['total_price']       =$value['total_price'];
                      $finalarray[]=$result2;
                      $menuImages2=array();
                      $menuquantity2=array();
                      $menuhalf_and_full_status2=array();
                      $menumenu_price2=array();
                      $menu_id=array();
                    }

                  }
                  $result['sub_order_data']     =$finalarray;
                  array_push($arr, $result);
                  $finalarray=array();
                  $menuImages=array();
                  $menuquantity=array();
                  $menuhalf_and_full_status=array();
                  $menumenu_price=array();
                  $menumenu_id=array();
          }
                $response->status = 1;
                $response->message = "success";
                $response->data = $arr;

        }
        
        echo json_output($response);
        
        }



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
            $data['menu_image'] =   base_url().'uploads/'.$row['menu_image'];
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
            $data['image'] =   base_url().'uploads/'.$row['image'];
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
