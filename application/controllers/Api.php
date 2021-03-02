<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
 require APPPATH . 'libraries/firebase.php';
      require APPPATH . 'libraries/push.php';
      require APPPATH . 'libraries/config.php';

 class Api extends CI_Controller {
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

    public function send_notification_by_staff()
   {

   $get_order_detail_for_customer = $this->User->order_detail_for_customer();
   /*print_r($get_order_detail_for_customer);
   die();*/
   if(!empty($get_order_detail_for_customer))
   {
   foreach($get_order_detail_for_customer as $row)
    {
    $order_id=$row['order_id'];
    $admin_id=$row['admin_id'];
    $table_no=$row['table_no'];
    $customer_mobile_no=$row['customer_mobile_no'];
    $get_restaurant_name = $this->User->get_restaurantName($admin_id);
    $name=$get_restaurant_name->name;
  
   foreach($notification_by_staff as $rowdata)
    {
    $mobile_no=$rowdata['mobile_no'];/*'8218566036'*/
  /* print_r($mobile_no);
   die();*/
   $get_Restaurant_notification_id_data = $this->User->get_restaurant_notification_id($mobile_no);
    date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
    foreach ($get_Restaurant_notification_id_data as $rownotified_data)
     {
    /*$notification_id='d_o2e4qdogI:APA91bFJK6QMe__DFHVhElIDyrmolT69UoamSwBIIGvsxa1ejdooU8Ga18c5e0o2j3iadcabowyMxYjzkw5RQYVE391HZDG1NQu8ncY7_YcbvoysavxRS3wr003L1LO8l5TBkSZj_WW2';*/
    $notification_id=$rownotified_data['notification_id'];
    //print_r($notification_id);
   
   
      /*require APPPATH . 'firebase.php';
      require APPPATH . 'push.php';
      require APPPATH . 'config.php';*/
      $firebase = new Firebase();
      $push = new Push();
      // optional payload
      $payload = array();
      $payload['team'] = 'India';
      $payload['score'] = '5.6';
      // notification title
      $title =$name;
      // notification message
       $message ='We have get order From table number '. $table_no .'';
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
       /* print_r($json);*/
      $regId =$notification_id;
       $response = $firebase->send($regId, $json);
      $data1->order_id = $order_id;
      $data1->admin_id = $admin_id;
      $data1->table_no =$table_no;
      $data1->customer_mobile_no=$customer_mobile_no;
      $data1->staff_mobile_no=$mobile_no;
      $data1->title = $title;
      $data1->message = $message;
      $data1->date_time = $now;
      $data1->status = '1';
     $notifiedbycustomer = $this->User->notifiedcustomerdata($data1);
     $update_notification_status = $this->User->notification_status_update($data1);
      echo '1';
          }
      }
    }
  }
}
else
{
  echo '0';
}
}
   
  /*......Cron job for notification by after end time Seasonal and Temporary Hawker ---- */
  public function send_notification_by_staff_for_order_confirm_by_waiter()
   {

   $get_order_detail_for_customer = $this->User->order_detail_for_restaurant();
   /*print_r($get_order_detail_for_customer);
   die();*/
   if(!empty($get_order_detail_for_customer))
   {
   foreach($get_order_detail_for_customer as $row)
    {
    $order_id=$row['order_id'];
    $admin_id=$row['admin_id'];
    $table_no=$row['table_no'];
    $customer_mobile_no=$row['customer_mobile_no'];
    $confirm_order_by=$row['confirm_order_by'];
    $get_restaurant_name = $this->User->get_restaurantName($admin_id);
    $name=$get_restaurant_name->name;
    $get_waiter_name = $this->User->get_waiterName($confirm_order_by);
    $waiter_name=$get_waiter_name->name;
   
   foreach($notification_by_staff as $rowdata)
    {
    $mobile_no=$rowdata['mobile_no'];/*'8218566036'*/
  /* print_r($mobile_no);*/
  
   $get_Restaurant_notification_id_data = $this->User->get_restaurant_notification_id($mobile_no);
    date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
    foreach ($get_Restaurant_notification_id_data as $rownotified_data)
     {
    
    $notification_id=$rownotified_data['notification_id'];

      $firebase = new Firebase();
      $push = new Push();
      // optional payload
      $payload = array();
      $payload['team'] = 'India';
      $payload['score'] = '5.6';
      // notification title
      $title =$name;
      // notification message
      $message ='A New order has been generated from orderID:'.$order_id.',TableNo:'.$table_no.' and Waiter staff Name: '.$waiter_name.'';
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
       /* print_r($json);*/
      $regId =$notification_id;
       $response = $firebase->send($regId, $json);
      $data1->order_id = $order_id;
      $data1->admin_id = $admin_id;
      $data1->table_no =$table_no;
      $data1->customer_mobile_no=$customer_mobile_no;
      $data1->staff_mobile_no=$mobile_no;
      $data1->title = $title;
      $data1->message = $message;
      $data1->date_time = $now;
      $data1->status = '1';
     $notifiedbycustomer = $this->User->notifiedcustomerdata($data1);
     $update_notification_status = $this->User->notification_status_update_by_waiter($data1);
      echo '1';
          }
      }
    }
  }
}
else
{
  echo '0';
}
}

/////////////////////////////////////////////////
public function send_notification_by_staff_for_order_confirm_by_kot()
   {

   $get_order_detail_for_customer_confirm_by_kot = $this->User->order_detail_for_restaurant_confirm_by_kot();
   /*print_r($get_order_detail_for_customer);
   die();*/
   if(!empty($get_order_detail_for_customer_confirm_by_kot))
   {
   foreach($get_order_detail_for_customer_confirm_by_kot as $row)
    {
    $order_id=$row['order_id'];
    $admin_id=$row['admin_id'];
    $table_no=$row['table_no'];
    $customer_mobile_no=$row['customer_mobile_no'];
    $create_slip_by=$row['create_slip_by'];
    $get_restaurant_name = $this->User->get_restaurantName($admin_id);
    $name=$get_restaurant_name->name;
    $get_waiter_name = $this->User->get_waiterName($create_slip_by);
    $waiter_name=$get_waiter_name->name;
   
   foreach($notification_by_staff as $rowdata)
    {
    $mobile_no=$rowdata['mobile_no'];/*'8218566036'*/
  /* print_r($mobile_no);*/
  
   $get_Restaurant_notification_id_data = $this->User->get_restaurant_notification_id($mobile_no);
    date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
    foreach ($get_Restaurant_notification_id_data as $rownotified_data)
     {
    
    $notification_id=$rownotified_data['notification_id'];

      $firebase = new Firebase();
      $push = new Push();
      // optional payload
      $payload = array();
      $payload['team'] = 'India';
      $payload['score'] = '5.6';
      // notification title
      $title =$name;
      // notification message
      $message ='New order recieved from orderID:'.$order_id.',TableNo:'.$table_no.' and  staff Name: '.$waiter_name.'';
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
       /* print_r($json);*/
      $regId =$notification_id;
       $response = $firebase->send($regId, $json);
      $data1->order_id = $order_id;
      $data1->admin_id = $admin_id;
      $data1->table_no =$table_no;
      $data1->customer_mobile_no=$customer_mobile_no;
      $data1->staff_mobile_no=$mobile_no;
      $data1->title = $title;
      $data1->message = $message;
      $data1->date_time = $now;
      $data1->status = '1';
     $notifiedbycustomer = $this->User->notifiedcustomerdata($data1);
     $update_notification_status = $this->User->notification_status_update_by_kot($data1);
      echo '1';
          }
      }
    }
  }
}
else
{
  echo '0';
}
}
/////////////////////////////////////////////////

public function send_notification_by_staff_for_order_complete_by_kitchen()
   {

   $get_order_detail_for_customer_confirm_by_kitchen = $this->User->order_detail_for_customer_confirm_by_kitchen();
   /*print_r($get_order_detail_for_customer);
   die();*/
   if(!empty($get_order_detail_for_customer_confirm_by_kitchen))
   {
   foreach($get_order_detail_for_customer_confirm_by_kitchen as $row)
    {
    $order_id=$row['order_id'];
    $admin_id=$row['admin_id'];
    $table_no=$row['table_no'];
    $customer_mobile_no=$row['customer_mobile_no'];
    $order_complete_by=$row['order_complete_by'];
    $get_restaurant_name = $this->User->get_restaurantName($admin_id);
    $name=$get_restaurant_name->name;
    $get_kitchen_name = $this->User->get_waiterName($order_complete_by);
    $kitchen_name=$get_kitchen_name->name;
    $notification_by_staff = $this->User->notification_by_staff__for_order_complete_by_kitchen($admin_id);
  /* print_r($notification_by_staff);
   die();*/
   foreach($notification_by_staff as $rowdata)
    {
    $mobile_no=$rowdata['mobile_no'];/*'8218566036'*/
  /* print_r($mobile_no);*/
  
   $get_Restaurant_notification_id_data = $this->User->get_restaurant_notification_id($mobile_no);
    date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
    foreach ($get_Restaurant_notification_id_data as $rownotified_data)
     {
    
    $notification_id=$rownotified_data['notification_id'];

      $firebase = new Firebase();
      $push = new Push();
      // optional payload
      $payload = array();
      $payload['team'] = 'India';
      $payload['score'] = '5.6';
      // notification title
      $title =$name;
      // notification message
      
      $message ='orderID:'.$order_id.' For TableNo:'.$table_no.' is complete';
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
       /* print_r($json);*/
      $regId =$notification_id;
      $response = $firebase->send($regId, $json);
      $data1->order_id = $order_id;
      $data1->admin_id = $admin_id;
      $data1->table_no =$table_no;
      $data1->customer_mobile_no=$customer_mobile_no;
      $data1->staff_mobile_no=$mobile_no;
      $data1->title = $title;
      $data1->message = $message;
      $data1->date_time = $now;
      $data1->status = '1';
     $notifiedbycustomer = $this->User->notifiedcustomerdata($data1);
     $update_notification_status = $this->User->notification_status_update_by_kitchen($data1);
      echo '1';
          }
      }
    }
  }
}
else
{
  echo '0';
}
}

/////////////////////////////////////////////////////////////////////////////
public function send_notification_by_waiter_for_order_complete_by_kitchen()
   {

   $get_order_detail_for_customer_confirm_by_kitchen_data = $this->User->order_detail_for_customer_confirm_by_kitchen_for_waiter();
   /*print_r($get_order_detail_for_customer);
   die();*/
   if(!empty($get_order_detail_for_customer_confirm_by_kitchen_data))
   {
   foreach($get_order_detail_for_customer_confirm_by_kitchen_data as $row)
    {
    $order_id=$row['order_id'];
    $admin_id=$row['admin_id'];
    $table_no=$row['table_no'];
    $customer_mobile_no=$row['customer_mobile_no'];
    $order_complete_by=$row['order_complete_by'];
    $get_restaurant_name = $this->User->get_restaurantName($admin_id);
    $name=$get_restaurant_name->name;
    $get_kitchen_name = $this->User->get_waiterName($order_complete_by);
    $kitchen_name=$get_kitchen_name->name;
    $notification_by_staff = $this->User->notification_by_staff__for_order_complete_by_kitchen_for_waiter($admin_id);
  /* print_r($notification_by_staff);
   die();*/
   foreach($notification_by_staff as $rowdata)
    {
    $mobile_no=$rowdata['mobile_no'];/*'8218566036'*/
  /* print_r($mobile_no);*/
  
   $get_Restaurant_notification_id_data = $this->User->get_restaurant_notification_id($mobile_no);
    date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
    foreach ($get_Restaurant_notification_id_data as $rownotified_data)
     {
    
    $notification_id=$rownotified_data['notification_id'];

      $firebase = new Firebase();
      $push = new Push();
      // optional payload
      $payload = array();
      $payload['team'] = 'India';
      $payload['score'] = '5.6';
      // notification title
      $title =$name;
      // notification message
      $message ='The orderID:'.$order_id.' For TableNo:'.$table_no.' is ready to be delivered';
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
       /* print_r($json);*/
      $regId =$notification_id;
       $response = $firebase->send($regId, $json);
      $data1->order_id = $order_id;
      $data1->admin_id = $admin_id;
      $data1->table_no =$table_no;
      $data1->customer_mobile_no=$customer_mobile_no;
      $data1->staff_mobile_no=$mobile_no;
      $data1->title = $title;
      $data1->message = $message;
      $data1->date_time = $now;
      $data1->status = '1';
     $notifiedbycustomer = $this->User->notifiedcustomerdata($data1);
     $update_notification_status = $this->User->notification_status_update_bywaiter_data($data1);
      echo '1';
          }
      }
    }
  }
}
else
{
  echo '0';
}
}
////////////////////////////////////////////////////////////////////////////
public function send_notification_by_waiter_for_order_complete_by_chef()
   {

   $get_order_detail_for_customer_confirm_by_chef_data = $this->User->order_detail_for_customer_confirm_by_chef_for_waiter();
   /*print_r($get_order_detail_for_customer);
   die();*/
   if(!empty($get_order_detail_for_customer_confirm_by_chef_data))
   {
   foreach($get_order_detail_for_customer_confirm_by_chef_data as $row)
    {
    $order_id=$row['order_id'];
    $admin_id=$row['admin_id'];
    $table_no=$row['table_no'];
    $customer_mobile_no=$row['customer_mobile_no'];
    $order_complete_by=$row['order_ready_to_serve_by'];
    $get_restaurant_name = $this->User->get_restaurantName($admin_id);
    $name=$get_restaurant_name->name;
    $get_kitchen_name = $this->User->get_waiterName($order_complete_by);
    $kitchen_name=$get_kitchen_name->name;
    $notification_by_staff = $this->User->notification_by_staff__for_order_complete_by_chef_for_waiter($admin_id);
  /* print_r($notification_by_staff);
   die();*/
   foreach($notification_by_staff as $rowdata)
    {
    $mobile_no=$rowdata['mobile_no'];/*'8218566036'*/
  /* print_r($mobile_no);*/
  
   $get_Restaurant_notification_id_data = $this->User->get_restaurant_notification_id($mobile_no);
    date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
    foreach ($get_Restaurant_notification_id_data as $rownotified_data)
     {
    
    $notification_id=$rownotified_data['notification_id'];

      $firebase = new Firebase();
      $push = new Push();
      // optional payload
      $payload = array();
      $payload['team'] = 'India';
      $payload['score'] = '5.6';
      // notification title
      $title =$name;
      // notification message
      $message ='The orderID:'.$order_id.' For TableNo:'.$table_no.' is ready to be delivered';
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
       /* print_r($json);*/
      $regId =$notification_id;
       $response = $firebase->send($regId, $json);
      $data1->order_id = $order_id;
      $data1->admin_id = $admin_id;
      $data1->table_no =$table_no;
      $data1->customer_mobile_no=$customer_mobile_no;
      $data1->staff_mobile_no=$mobile_no;
      $data1->title = $title;
      $data1->message = $message;
      $data1->date_time = $now;
      $data1->status = '1';
     $notifiedbycustomer = $this->User->notifiedcustomerdata($data1);
     $update_notification_status = $this->User->notification_status_update_bywaiter_datas($data1);
      echo '1';
          }
      }
    }
  }
}
else
{
  echo '0';
}
}
  //////////////////////////////////  Cron job ///////////////////////////////
    public function send_notification_by_customer()
   {

   $get_order_detail = $this->User->order_detail_for_customer_data();
   /*print_r($get_order_detail_for_customer);
   die();*/
   if(!empty($get_order_detail))
   {
   foreach($get_order_detail as $row)
    {
    $order_id=$row['order_id'];
    $admin_id=$row['admin_id'];
    $table_no=$row['table_no'];
    $customer_mobile_no=$row['customer_mobile_no'];
    $get_restaurant_name = $this->User->get_restaurantName($admin_id);
    $name=$get_restaurant_name->name;
  
   $get_Restaurant_notification_id_data = $this->User->get_restaurant_notification_id_for_customer($customer_mobile_no);
    date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
    foreach ($get_Restaurant_notification_id_data as $rownotified_data)
     {
    /*$notification_id='d_o2e4qdogI:APA91bFJK6QMe__DFHVhElIDyrmolT69UoamSwBIIGvsxa1ejdooU8Ga18c5e0o2j3iadcabowyMxYjzkw5RQYVE391HZDG1NQu8ncY7_YcbvoysavxRS3wr003L1LO8l5TBkSZj_WW2';*/
    $notification_id=$rownotified_data['notification_id'];
    //print_r($notification_id);
   
   
      /*require APPPATH . 'firebase.php';
      require APPPATH . 'push.php';
      require APPPATH . 'config.php';*/
      $firebase = new Firebase();
      $push = new Push();
      // optional payload
      $payload = array();
      $payload['team'] = 'India';
      $payload['score'] = '5.6';
      // notification title
      $title =$name;
      // notification message
       $message ='Thanks for order.Your order is getting ready';
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
       /* print_r($json);*/
      $regId =$notification_id;
       $response = $firebase->send($regId, $json);
      $data1->order_id = $order_id;
      $data1->admin_id = $admin_id;
      $data1->table_no =$table_no;
      $data1->customer_mobile_no=$customer_mobile_no;
      $data1->title = $title;
      $data1->message = $message;
      $data1->date_time = $now;
      $data1->status = '1';
     $notifiedbycustomer = $this->User->notifiedcustomer_data($data1);
     $update_notification_status = $this->User->notification_status_update_customer($data1);
      echo '1';
          }
      
    }
  }
}
else
{
  echo '0';
}
}
   
  /*......Cron job for notification by after end time Seasonal and Temporary Hawker ---- */

  public function send_notification_for_confirm_order_by_waiter_for_customer()
   {

   $get_order_detail_for_waiter = $this->User->order_detail_for_customer_confirm_by_waiter();
   /*print_r($get_order_detail_for_customer);
   die();*/
   if(!empty($get_order_detail_for_waiter))
   {
   foreach($get_order_detail_for_waiter as $row)
    {
    $order_id=$row['order_id'];
    $admin_id=$row['admin_id'];
    $table_no=$row['table_no'];
    $customer_mobile_no=$row['customer_mobile_no'];
    $get_restaurant_name = $this->User->get_restaurantName($admin_id);
    $name=$get_restaurant_name->name;
  
   $get_Restaurant_notification_id_data = $this->User->get_restaurant_notification_id_for_customer($customer_mobile_no);
    date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
    foreach ($get_Restaurant_notification_id_data as $rownotified_data)
     {
    /*$notification_id='d_o2e4qdogI:APA91bFJK6QMe__DFHVhElIDyrmolT69UoamSwBIIGvsxa1ejdooU8Ga18c5e0o2j3iadcabowyMxYjzkw5RQYVE391HZDG1NQu8ncY7_YcbvoysavxRS3wr003L1LO8l5TBkSZj_WW2';*/
    $notification_id=$rownotified_data['notification_id'];
    //print_r($notification_id);
   
   
      /*require APPPATH . 'firebase.php';
      require APPPATH . 'push.php';
      require APPPATH . 'config.php';*/
      $firebase = new Firebase();
      $push = new Push();
      // optional payload
      $payload = array();
      $payload['team'] = 'India';
      $payload['score'] = '5.6';
      // notification title
      $title =$name;
      // notification message
       $message ='Your order has been placed successfully. To see you order details go to my-order';
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
       /* print_r($json);*/
      $regId =$notification_id;
       $response = $firebase->send($regId, $json);
      $data1->order_id = $order_id;
      $data1->admin_id = $admin_id;
      $data1->table_no =$table_no;
      $data1->customer_mobile_no=$customer_mobile_no;
      $data1->title = $title;
      $data1->message = $message;
      $data1->date_time = $now;
      $data1->status = '1';
     $notifiedbycustomer = $this->User->notifiedcustomer_data($data1);
     $update_notification_status = $this->User->notification__update_waiter_confirm_for_customer($data1);
      echo '1';
          }
      
    }
  }
}
else
{
  echo '0';
}
}
///////////////////////////////////////////////////////////////////////////
public function send_notification_for_complete_order_by_kot_for_customer()
   {

   $get_order_detail_for_kot = $this->User->order_detail_for_customer_confirm_by_kot();
   /*print_r($get_order_detail_for_customer);
   die();*/
   if(!empty($get_order_detail_for_kot))
   {
   foreach($get_order_detail_for_kot as $row)
    {
    $order_id=$row['order_id'];
    $admin_id=$row['admin_id'];
    $table_no=$row['table_no'];
    $customer_mobile_no=$row['customer_mobile_no'];
    $get_restaurant_name = $this->User->get_restaurantName($admin_id);
    $name=$get_restaurant_name->name;
  
    $get_Restaurant_notification_id_data = $this->User->get_restaurant_notification_id_for_customer($customer_mobile_no);
    date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
    foreach ($get_Restaurant_notification_id_data as $rownotified_data)
     {
    /*$notification_id='d_o2e4qdogI:APA91bFJK6QMe__DFHVhElIDyrmolT69UoamSwBIIGvsxa1ejdooU8Ga18c5e0o2j3iadcabowyMxYjzkw5RQYVE391HZDG1NQu8ncY7_YcbvoysavxRS3wr003L1LO8l5TBkSZj_WW2';*/
    $notification_id=$rownotified_data['notification_id'];
    //print_r($notification_id);
   
   
      /*require APPPATH . 'firebase.php';
      require APPPATH . 'push.php';
      require APPPATH . 'config.php';*/
      $firebase = new Firebase();
      $push = new Push();
      // optional payload
      $payload = array();
      $payload['team'] = 'India';
      $payload['score'] = '5.6';
      // notification title
      $title =$name;
      // notification message
       $message ='your order is being prepared';
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
       /* print_r($json);*/
      $regId =$notification_id;
       $response = $firebase->send($regId, $json);
      $data1->order_id = $order_id;
      $data1->admin_id = $admin_id;
      $data1->table_no =$table_no;
      $data1->customer_mobile_no=$customer_mobile_no;
      $data1->title = $title;
      $data1->message = $message;
      $data1->date_time = $now;
      $data1->status = '1';
     $notifiedbycustomer = $this->User->notifiedcustomer_data($data1);
     $update_notification_status = $this->User->notification__update_kot_confirm_for_customer($data1);
      echo '1';
          }
      
    }
  }
}
else
{
  echo '0';
}
}
///////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////
public function send_notification_for_complete_order_by_cheff_for_customer()
   {

   $get_order_detail_for_cheff = $this->User->order_detail_for_customer_confirm_by_cheff();
  /* print_r($get_order_detail_for_cheff);
   die();*/
   if(!empty($get_order_detail_for_cheff))
   {
   foreach($get_order_detail_for_cheff as $row)
    {
    $order_id=$row['order_id'];
    $admin_id=$row['admin_id'];
    $table_no=$row['table_no'];
    $customer_mobile_no=$row['customer_mobile_no'];
    $get_restaurant_name = $this->User->get_restaurantName($admin_id);
    $name=$get_restaurant_name->name;
  
   $get_Restaurant_notification_id_data = $this->User->get_restaurant_notification_id_for_customer($customer_mobile_no);
    date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
    foreach ($get_Restaurant_notification_id_data as $rownotified_data)
     {
    /*$notification_id='d_o2e4qdogI:APA91bFJK6QMe__DFHVhElIDyrmolT69UoamSwBIIGvsxa1ejdooU8Ga18c5e0o2j3iadcabowyMxYjzkw5RQYVE391HZDG1NQu8ncY7_YcbvoysavxRS3wr003L1LO8l5TBkSZj_WW2';*/
    $notification_id=$rownotified_data['notification_id'];
    //print_r($notification_id);
   
   
      /*require APPPATH . 'firebase.php';
      require APPPATH . 'push.php';
      require APPPATH . 'config.php';*/
      $firebase = new Firebase();
      $push = new Push();
      // optional payload
      $payload = array();
      $payload['team'] = 'India';
      $payload['score'] = '5.6';
      // notification title
      $title =$name;
      // notification message
       $message ='your order is on your way';
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
       /* print_r($json);*/
      $regId =$notificati2on_id;
       $response = $firebase->send($regId, $json);
      $data1->order_id = $order_id;
      $data1->admin_id = $admin_id;
      $data1->table_no =$table_no;
      $data1->customer_mobile_no=$customer_mobile_no;
      $data1->title = $title;
      $data1->message = $message;
      $data1->date_time = $now;
      $data1->status = '1';
     $notifiedbycustomer = $this->User->notifiedcustomer_data($data1);
     $update_notification_status = $this->User->notification__update_kitchen_confirm_for_customer($data1);
     
      echo '1';
          }
      
    }
  }
}
else
{
  echo '0';
}
}
////////////////////////////////////////////////////////////////////////////
  /*......Cron job for notification for  duty on by  Hawker ---- */
  public function notification_by_hawker_for_duty_on()
   {
   $notifiedhawker_by_duty_on_data = $this->User->notifiedhawker_by_duty_on();
   foreach($notifiedhawker_by_duty_on_data as $rowdata)
    {
    $business_start_time=$rowdata['business_start_time'];
    $duty_status=$rowdata['duty_status'];
  //  print_r($business_start_time);
    $hawker_code=$rowdata['hawker_code'];
    // print_r($hawker_code);
    $get_hawker_notification_id_data = $this->User->get_hawker_notification_id($hawker_code);
   // print_r($get_hawker_notification_id);
    /*$dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata')); 
    $dateTime->format("H:i A");*/
     date_default_timezone_set('Asia/Kolkata');
     $now = date("g:i A");
     //print_r($now);
    foreach ($get_hawker_notification_id_data as $rownotified_data)
     {
    $notification_id=$rownotified_data['notification_id'];
    //print_r($notification_id);
    if($duty_status=='0')
    {
    if($now == $business_start_time)
    {
      require APPPATH . 'firebase.php';
      require APPPATH . 'push.php';
      require APPPATH . 'config.php';
      $firebase = new Firebase();
      $push = new Push();
      // optional payload
      $payload = array();
      $payload['team'] = 'India';
      $payload['score'] = '5.6';
      // notification title
      $title ='Hawkers';
      // notification message
     $message ='Turned on Duty? /à¤•à¥à¤¯à¤¾ à¤†à¤ª à¤¡à¥à¤¯à¥‚à¤Ÿà¥€ à¤¸à¥à¤Ÿà¤¾à¤°à¥à¤Ÿ à¤•à¤°à¤¨à¤¾ à¤­à¥‚à¤² à¤—à¤ à¤¹à¥‹? ';
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
      $regId =$notification_id;
      $data2 = $firebase->send($regId, $json);
      echo '1';
          }
        }
      }
     }
    }
  }
   
    /*.....  Cron job for notification by after end time Seasonal and Temporary Hawker  ---- */

   
   
    /*.....  Cron job for notification by after end time Seasonal and Temporary Hawker  ---- */
   }
