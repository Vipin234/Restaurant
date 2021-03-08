<?php

class Customer extends CI_Model
{    
    private $register_customer='tbl_registration_customer';
    private $tablecustumerlogin='tbl_login_customer';
    private $tbl_otp_customer='tbl_otp_customer';
    private $tbl_favourite_category='tbl_favourite_category';
    private $notified_near_by_hawker_for_customer='notified_near_by_hawker_for_customer';
    private $tbl_customer_call_by_hawker='tbl_customer_call_by_hawker';
    private $tbl_customer_navigate_by_hawker='tbl_customer_navigate_by_hawker';
    private $history_notified_near_by_hawker_for_customer='history_notified_near_by_hawker_for_customer';
    private $tbl_notified_moving_data='tbl_notified_moving_data';
    private $tbl_request_city_by_customer='tbl_request_city_by_customer';
    private $tbl_history_for_location_customer='tbl_history_for_location_customer';
    private $tbl_feedback_customer='tbl_feedback_for_restaurant_by_customer';
    private $tbl_near_by_notified_radius='tbl_near_by_notified_radius';
    private $tbl_order_detail_for_restaurant='tbl_order_detail_for_restaurant';
    private $tbl_rating_for_customer='tbl_rating_for_customer';
    private $tbl_contact_detail_for_customer='tbl_contact_detail_for_customer';
    
    function update_customer_id($alphanumerric,$result)
    {   
      $this->db->query("UPDATE tbl_registration_customer SET cus_id='$alphanumerric' where id='$result'");
    }

     function check_status_for_notification($check_status,$customer_mobile_no)
    {   
      $this->db->query("UPDATE tbl_notification_by_customer SET count_status='$check_status' where customer_mobile_no='$customer_mobile_no'");
    }

    function average_rating_for_restaurant($arraydata,$admin_id)
    {   
      $this->db->query("UPDATE spots SET rating='$arraydata' where admin_id='$admin_id'");
    }

    function update_order_id($alphanumerric,$result)
    {   
      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET order_id='$alphanumerric' where id='$result'");
    }

    function get_menu_list_data($admin_id)
    {  
      $q=$this->db->query("SELECT * from tbl_restaurant_menu_item_list where  admin_id='$admin_id' and  status='1'");
       return($q->result_array());
    }

    function customer_add($data)
    {   
       $insert = $this->db->insert($this->register_customer, $data);
       return $insert?$this->db->insert_id():false;
    }
    function add_contact_detail($data)
    {   
       $insert = $this->db->insert($this->tbl_contact_detail_for_customer, $data);
       return $insert?$this->db->insert_id():false;
    }
     function add_order_detail_restaurant($data)
    {
        $insert = $this->db->insert($this->tbl_order_detail_for_restaurant, $data);
        return $insert?$this->db->insert_id():false;
      
    }
    public function check_total_count_notification($customer_mobile_no)
     {
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d');
        $q=$this->db->query("SELECT order_id from tbl_notification_by_customer where customer_mobile_no='".$customer_mobile_no."' and count_status='0'");
        return($q->num_rows());
     }

    function get_notification_id_for_staff_data()
     { 
         $q=$this->db->query("SELECT notification_id FROM tbl_manage_login_user where user_type!='KOT'");
        // print_r("SELECT notification_id FROM login_manage_seller where user_id='$hawker_code'");

         return($q->result_array());
     }
     function get_restaurant_list_data($city)
     { 
      if($city=='')
      {
       
         $q=$this->db->query("SELECT * FROM spots");
      }
      else
      {
  
        $q=$this->db->query("SELECT * FROM spots where city='$city'");
      }
         return($q->result_array());

     }
     function get_city_list_data()
     { 
         $q=$this->db->query("SELECT DISTINCT city FROM spots");
        // print_r("SELECT notification_id FROM login_manage_seller where user_id='$hawker_code'");

         return($q->result_array());
     }

     function insert_notified_data($data)
    {   
       $insert = $this->db->insert($this->tbl_near_by_notified_radius, $data);
       return $insert?$this->db->insert_id():false;
    }

    function feedback_data($data)
    {   
       $insert = $this->db->insert($this->tbl_feedback_customer, $data);
       return $insert?$this->db->insert_id():false;
    }
     function logdatalocation($data)
    {   
       $insert = $this->db->insert($this->tbl_history_for_location_customer, $data);
       return $insert?$this->db->insert_id():false;
    }
    function request_city_by_customer_data($data)
    {   
       $insert = $this->db->insert($this->tbl_request_city_by_customer, $data);
       return $insert?$this->db->insert_id():false;
    }
     function backup_notified_data($data)
    {   
       $insert = $this->db->insert($this->history_notified_near_by_hawker_for_customer, $data);
       return $insert?$this->db->insert_id():false;
    }

      function notifiedcustomerdata($data)
    {   
       $insert = $this->db->insert($this->tbl_notified_moving_data, $data);
       return $insert?$this->db->insert_id():false;
    }

    function remove_notified_data($cus_id,$notification_id)
    {   
       $this->db->delete('notified_near_by_hawker_for_customer', array('cus_id' => $cus_id,'notification_id' => $notification_id)); 
    }

    function near_by_hawker_data($data)
    {   
       $insert = $this->db->insert($this->notified_near_by_hawker_for_customer, $data);
       return $insert?$this->db->insert_id():false;
    }

     function favourite_category_add($data)
    {   
      $mobile_no =$data->mobile_no;
      $cus_id =$data ->cus_id;
      $cat_id=$data->cat_id;
      $sub_cat_id=$data->sub_cat_id;
      $super_sub_cat_id=$data->super_sub_cat_id;
      $time_date=$data->time_date;
      if($sub_cat_id=='' and $cat_id!='' and $super_sub_cat_id=='')
      {
      $query=$this->db->get_where($this->tbl_favourite_category,['cus_id'=>$data->cus_id,'cat_id'=>$cat_id])->num_rows();
      }
      else if($cat_id=='' and $sub_cat_id=='')
      {
        $insert = $this->db->insert($this->tbl_favourite_category, $data);
          return $insert?$this->db->insert_id():false;
      }
      else
      {
        $query1=$this->db->get_where($this->tbl_favourite_category,['cus_id'=>$data->cus_id,'sub_cat_id'=>$sub_cat_id])->num_rows();
      }

     if($query>0)
     {
         $this->db->query("UPDATE tbl_favourite_category SET time_date='$time_date',status='1' where cus_id='$cus_id' and cat_id='$cat_id'");
     }
     else if($query1>0)
     {
        $this->db->query("UPDATE tbl_favourite_category SET time_date='$time_date',status='1' where cus_id='$cus_id' and sub_cat_id='$sub_cat_id'");
     }
     else
     {
          $insert = $this->db->insert($this->tbl_favourite_category, $data);
          return $insert?$this->db->insert_id():false;
     }
     
    }

      function unfavourite_category($data)
    {   
      $mobile_no =$data->mobile_no;
      $cus_id =$data ->cus_id;
      $cat_id=$data->cat_id;
      $sub_cat_id=$data->sub_cat_id;
      $time_date=$data->time_date;
      $this->db->query("UPDATE tbl_favourite_category SET status='0' where mobile_no='$mobile_no' and cus_id='$cus_id' and cat_id='$cat_id'");
    }

     function update_payment_status($data)
    {   
      $order_id =$data->order_id;
      $admin_id =$data ->admin_id;
      $payment_status=$data->payment_status;
      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET payment_status='$payment_status' where order_id='$order_id' and admin_id='$admin_id' ");
    }
    function getGroupData($customer_mobile_no,$customer_mobile_no1)
    {
     /* SELECT * FROM questions GROUP by questions.asker ORDER by questions.id DESC*/

      /*$q=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where customer_mobile_no IN ($customer_mobile_no,$customer_mobile_no1) group by order_id  ORDER BY id DESC");*/

         $data = $this->db->query("SELECT tbl_order_detail_for_restaurant.*,`spots`.`name` as RestaurentName from tbl_order_detail_for_restaurant INNER JOIN spots ON tbl_order_detail_for_restaurant.admin_id = spots.admin_id where customer_mobile_no IN ($customer_mobile_no,$customer_mobile_no1)   group by order_id  ORDER BY id DESC");/*order_by('create_date', 'DESC')->group_by("order_id")->select('order_id')->where_in("tbl_order_detail_for_restaurant",["order_id"=>$order_id])->result_array();
       */
       return($data->result_array());
    }
    function getDataOrderWise($orderid)
    {
      $result = $this->db->select('tbl_order_detail_for_restaurant.*,spots.name as RestaurentName')->from("tbl_order_detail_for_restaurant")->join("spots","spots.admin_id=tbl_order_detail_for_restaurant.admin_id")->where(['order_id'=>$orderid])->get()->result_array();
        return $result;

    }
    function getGroupDatas($order_id)
    {
       $data = $this->db->query("SELECT tbl_order_detail_for_restaurant.*,`spots`.`name` as RestaurentName from tbl_order_detail_for_restaurant INNER JOIN spots ON tbl_order_detail_for_restaurant.admin_id = spots.admin_id where order_id='$order_id'  group by order_id  ORDER BY id DESC");
      
         /*$data = $this->db->order_by('create_date', 'DESC')->group_by("order_id")->select('order_id')->get_where("tbl_order_detail_for_restaurant",["order_id"=>$order_id])->result_array();*/
       
        return($data->result_array());
    }
    function getDataOrderWises($orderid)
    {
     $result = $this->db->select('tbl_order_detail_for_restaurant.*,spots.name as RestaurentName')->from("tbl_order_detail_for_restaurant")->join("spots","spots.admin_id=tbl_order_detail_for_restaurant.admin_id")->where(['order_id'=>$orderid])->get()->result_array();
        return $result;

    }


    function order_detail_for_customer($customer_mobile_no,$customer_mobile_no1)
    {  
       /*select * from tbl_order_detail_for_restaurant where customer_mobile_no in ($customer_mobile_no,$customer_mobile_no1) order by id desc*/

      /* print_r("SELECT * from tbl_order_detail_for_restaurant where customer_mobile_no IN ($customer_mobile_no,$customer_mobile_no1)  ORDER BY id DESC");
       die();*/
      $q=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where customer_mobile_no IN ($customer_mobile_no,$customer_mobile_no1)  ORDER BY id DESC");
       return($q->result_array());
    }

    function order_detail_particular_for_customer($order_id)
    {  
       
      $q=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where order_id='$order_id' ORDER BY id DESC");
       return($q->result_array());
    }

    function update_customer_profile($data)
    { 
      $cus_id=$data->cus_id;  
      $name =$data->name;
      $state =$data ->state;
      $city=$data->city;
      $address=$data->address;
      $gender=$data->gender;
      $date_of_birth=$data->date_of_birth;
      $area=$data->area;
      $pincode =$data->pincode;
      $mobile_no =$data ->mobile_no;
      $email_id=$data->email;
      $cus_image =$data ->cus_image;
      $active_status='1';
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');

      $this->db->query("UPDATE tbl_registration_customer SET name='$name',state='$state',city='$city',address='$address',area='$area',gender='$gender',date_of_birth='$date_of_birth',pincode='$pincode',mobile_no='$mobile_no',email_id='$email_id',cus_image='$cus_image',active_status='$active_status', modified_date='$now',profile_update_status='1' where cus_id='$cus_id' and mobile_no='$mobile_no'");

    }

     function unfavourite_category1($data)
    {   
      $mobile_no =$data->mobile_no;
      $cus_id =$data ->cus_id;
      $cat_id=$data->cat_id;
      $sub_cat_id=$data->sub_cat_id;
      $time_date=$data->time_date;
      $this->db->query("UPDATE tbl_favourite_category SET status='0' where mobile_no='$mobile_no' and cus_id='$cus_id' and sub_cat_id='$sub_cat_id'");
    }

     function unfavourite_category2($data)
    {   
      $mobile_no =$data->mobile_no;
      $cus_id =$data ->cus_id;
      $cat_id=$data->cat_id;
      $sub_cat_id=$data->sub_cat_id;
      $super_sub_cat_id=$data->super_sub_cat_id;
      $time_date=$data->time_date;
      $this->db->query("UPDATE tbl_favourite_category SET status='0' where mobile_no='$mobile_no' and cus_id='$cus_id' and super_sub_cat_id='$super_sub_cat_id'");
    }

     function send_set_time_for_notification($data)
    {   
      $cus_id =$data->cus_id;
      $notification_id =$data ->notification_id;
      $radius =$data ->radius;
      $set_time=$data->set_time;
      $cat_id=$data->cat_id;
      $sub_cat_id=$data->sub_cat_id;
      $super_sub_cat_id=$data->super_sub_cat_id;

      if($sub_cat_id=='' and $super_sub_cat_id=='')
      {
      
         $this->db->query("UPDATE notified_near_by_hawker_for_customer SET set_time='$set_time',radius='$radius' where notification_id='$notification_id' and  cus_id='$cus_id' and cat_id='$cat_id'");
      }
      else if($super_sub_cat_id=='')
      {

         $this->db->query("UPDATE notified_near_by_hawker_for_customer SET set_time='$set_time',radius='$radius' where notification_id='$notification_id' and  cus_id='$cus_id' and cat_id='$cat_id' and sub_cat_id='$sub_cat_id'");
      }
      else
      {
        $this->db->query("UPDATE notified_near_by_hawker_for_customer SET set_time='$set_time',radius='$radius' where notification_id='$notification_id' and  cus_id='$cus_id' and cat_id='$cat_id' and sub_cat_id='$sub_cat_id' and super_sub_cat_id='$super_sub_cat_id'");
      }
     
    }

    function Validate_custumer($mobile_no,$password)
    {
         $q=$this->db->where(['mobile_no'=>$mobile_no,'password'=>$password])
          ->get('registration_customer');
           return($q->row());
    }

     function customer_data($mobile_no)
    {
         $q=$this->db->where(['mobile_no'=>$mobile_no])
          ->get('registration_customer');
           return($q->row());
    }

    function get_custumer_data($mobile_no,$password,$id)
    {
         $q=$this->db->query("SELECT * from registration_customer where id='".$id."'");
         $row = $que->num_rows();
         if($row>0)
         {
            return true;
         }
         else
         {
            return false;
         }
     }

     ////////Add Registartion Custumer data //////////
    function Add_registration_custumer_data($data)
    {
        $CusID =$data->cus_id;
        $name =$data ->name;
        $mobile_no=$data->mobile_no;
        $device_id=$data->device_id;
        $notification_id=$data->notification_id;
        $login_time=$data->login_time;
        $emailID=$data->email_id;
        $address=$data->address;
        $query=$this->db->get_where($this->tablecustumerlogin,['cus_id'=>$CusID,'device_id'=>$device_id])->num_rows();
        $query1=$this->db->get_where($this->tablecustumerlogin,['cus_id'=>$CusID])->num_rows();

        if($query>0)
        {
            date_default_timezone_set('Asia/kolkata'); 
            $now = date('Y-m-d H:i:s');
           /* $this->db->where('cus_id',$CusID);  
            $this->db->update($this->tablecustumerlogin, ['login_time'=>$now,'notification_id'=>$notification_id,'active_status'=>'1']);*/
            $this->db->query("UPDATE tbl_login_customer SET login_time='$login_time',notification_id='$notification_id' where mobile_no='$mobile_no' and device_id='$device_id'");
        }
         else if($query1>0)
        {
            $this->db->query("UPDATE tbl_login_customer SET login_time='$login_time',notification_id='$notification_id',device_id='$device_id' where mobile_no='$mobile_no'");
        }
        else
        {
              $query="insert into tbl_login_customer(cus_id,name,mobile_no,email_id,address,device_id,notification_id,login_time,status,active_status) values('$CusID','$name','$mobile_no','$emailID','$address','$device_id','$notification_id','$login_time','1','1')";
        
             $this->db->query($query);
        }
     }

     ////////Add Registration Custumer data //////////

     ////////Validate category data //////////
    function Validate_catdata($data)
    {
        $userId = $data->id;
        $cat_id =$data ->cat_id;
        $shop_id=$data->shop_id;
        
        $query=$this->db->get_where($this->registration_seller,['id'=>$data->id])->num_rows();

        if($query>0)
        {
            $this->db->where('id', $data->id);  
            $this->db->update($this->registration_seller, ['cat_id'=>$cat_id]);
        }
       
     }
    ////////Validate category data //////////

    ////////Update Image Seller  data //////////
    function update_image_seller($data)
    {
        $sales_id=$data->sales_id;
        $shop_id = $data->shop_id;
        $profile_image =$data ->profile_image;
        $identity_proof_front_image=$data->identity_proof_front_image;
        $identity_proof_back_image=$data->identity_proof_back_image;
        $shop_image=$data->shop_image;
       $this->db->where('shop_id',$data->shop_id,'sales_id',$data->sales_id);  
       $this->db->update($this->registration_seller, ['profile_image'=>$profile_image,'identity_proof_front_image'=>$identity_proof_front_image,'identity_proof_back_image'=>$identity_proof_back_image,'shop_image'=>$shop_image]);
     }

     ////////Update Image Seller  data //////////

    ////////Validate salesuser data //////////
    function Validate_fixer_user($data)
     {
        $shopID = $data->shop_id;
        $q=$this->db->query("SELECT * from registration_sellers where shop_id='".$shopID."'");
         return($q->row());
        $row = $q->num_rows();
     }
     function check_profile_update_status($cus_id,$mobile_no)
     {
        
        $q=$this->db->query("SELECT profile_update_status from tbl_registration_customer where cus_id='$cus_id' and mobile_no='$mobile_no'");
         return($q->row());
        $row = $q->num_rows();
     }

     ////////Validate salesuser data //////////

     ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '')
    {
        if (file_exists('manage/catImages/' . $id . '.jpg'))
            $image_url = base_url() . 'manage/catImages/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = 'http://10.0.0.15/fixer_goolean/manage/catImages/'.$id.'';

        return $image_url;
    }

     ////////IMAGE URL//////////

 ////////IMAGE URL fixer//////////
    function get_image_fixer_url($type = '', $id = '')
    {
        if (file_exists('assets/upload/' . $id . '.jpg'))
            $image_url = base_url() . 'assets/upload/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'assets/upload/'.$id.'';

        return $image_url;
    }

     ////////IMAGE URL fixer//////////

     function check_data_by_location($gps_id)
     {  
       
        $q=$this->db->query("SELECT * from gps_seller_location where shop_gps_id='$gps_id' order by id desc limit 1");
         return($q->result_array());
     }

      function get_device_data($hawker_code)
     {  
       
        $q=$this->db->query("SELECT device_id from login_manage_seller where user_id='$hawker_code'");
         return($q->result_array());
     }

      function check_data_by_registerseller($cat_id,$city)
    {  
      $q=$this->db->query("SELECT name,user_type,shop_latitude,shop_longitude,shop_gps_id,mobile_no_contact,business_mobile_no,hawker_code,menu_image,menu_image_2,menu_image_3,menu_image_4,seasonal_temp_hawker_type from registration_sellers where FIND_IN_SET('".$cat_id."', cat_id) and city='".$city."' and user_type='Fix' and duty_status='1'");
       return($q->result_array());
    }

    function check_data_by_registerseller_temp_fix($cat_id,$city)
    {  
      $q=$this->db->query("SELECT name,user_type,shop_latitude,shop_longitude,shop_gps_id,mobile_no_contact,business_mobile_no,hawker_code,menu_image,menu_image_2,menu_image_3,menu_image_4,seasonal_temp_hawker_type from registration_sellers where FIND_IN_SET('".$cat_id."', cat_id) and city='".$city."' and user_type='Temporary' and  seasonal_temp_hawker_type='Fix' and duty_status='1'");
       return($q->result_array());
    }
       function check_data_by_registerseller_seasonal_fix($cat_id,$city)
    {  
      $q=$this->db->query("SELECT name,user_type,shop_latitude,shop_longitude,shop_gps_id,mobile_no_contact,business_mobile_no,hawker_code,menu_image,menu_image_2,menu_image_3,menu_image_4,seasonal_temp_hawker_type from registration_sellers where FIND_IN_SET('".$cat_id."', cat_id) and city='".$city."' and user_type='Seasonal' and  seasonal_temp_hawker_type='Fix' and duty_status='1'");
       return($q->result_array());
    }
    function check_data_by_registerseller_temp_moving($cat_id,$city)
    {  
      $q=$this->db->query("SELECT name,user_type,shop_latitude,shop_longitude,shop_gps_id,mobile_no_contact,business_mobile_no,hawker_code,menu_image,menu_image_2,menu_image_3,menu_image_4,seasonal_temp_hawker_type from registration_sellers where FIND_IN_SET('".$cat_id."', cat_id) and city='".$city."' and user_type='Temporary' and  seasonal_temp_hawker_type='Moving' and duty_status='1'");
       return($q->result_array());
    }
     function check_data_by_registerseller_seasonal_moving($cat_id,$city)
    {  
      $q=$this->db->query("SELECT name,user_type,shop_latitude,shop_longitude,shop_gps_id,mobile_no_contact,business_mobile_no,hawker_code,menu_image,menu_image_2,menu_image_3,menu_image_4,seasonal_temp_hawker_type from registration_sellers where FIND_IN_SET('".$cat_id."', cat_id) and city='".$city."' and user_type='Seasonal' and  seasonal_temp_hawker_type='Moving' and duty_status='1'");
       return($q->result_array());
    }

    function check_data_by_registerseller1($sub_cat_id,$city)
    {  
      $q=$this->db->query("SELECT name,user_type,shop_latitude,shop_longitude,shop_gps_id,mobile_no_contact,business_mobile_no,hawker_code,menu_image,menu_image_2,menu_image_3,menu_image_4,seasonal_temp_hawker_type from registration_sellers where FIND_IN_SET('".$sub_cat_id."', sub_cat_id) and city='".$city."'and user_type='Fix' and duty_status='1'");
       return($q->result_array());
    }
     function check_data_by_registerseller1_temp_fix($sub_cat_id,$city)
    {  
      $q=$this->db->query("SELECT name,user_type,shop_latitude,shop_longitude,shop_gps_id,mobile_no_contact,business_mobile_no,hawker_code,menu_image,menu_image_2,menu_image_3,menu_image_4,seasonal_temp_hawker_type from registration_sellers where FIND_IN_SET('".$sub_cat_id."', sub_cat_id) and city='".$city."'and user_type='Temporary' and  seasonal_temp_hawker_type='Fix'  and duty_status='1'");
       return($q->result_array());
    }
     function check_data_by_registerseller1_seasonal_fix($sub_cat_id,$city)
    {  
      $q=$this->db->query("SELECT name,user_type,shop_latitude,shop_longitude,shop_gps_id,mobile_no_contact,business_mobile_no,hawker_code,menu_image,menu_image_2,menu_image_3,menu_image_4,seasonal_temp_hawker_type from registration_sellers where FIND_IN_SET('".$sub_cat_id."', sub_cat_id) and city='".$city."'and user_type='Seasonal' and  seasonal_temp_hawker_type='Fix'  and duty_status='1'");
       return($q->result_array());
    }
    function check_data_by_registerseller1_seasonal_moving($sub_cat_id,$city)
    {  
      $q=$this->db->query("SELECT name,user_type,shop_latitude,shop_longitude,shop_gps_id,mobile_no_contact,business_mobile_no,hawker_code,menu_image,menu_image_2,menu_image_3,menu_image_4,seasonal_temp_hawker_type from registration_sellers where FIND_IN_SET('".$sub_cat_id."', sub_cat_id) and city='".$city."'and user_type='Seasonal' and  seasonal_temp_hawker_type='Moving'  and duty_status='1'");
       return($q->result_array());
    }


  function check_data_by_registerseller1_temp_moving($sub_cat_id,$city)
    {  
      $q=$this->db->query("SELECT name,user_type,shop_latitude,shop_longitude,shop_gps_id,mobile_no_contact,business_mobile_no,hawker_code,menu_image,menu_image_2,menu_image_3,menu_image_4,seasonal_temp_hawker_type from registration_sellers where FIND_IN_SET('".$sub_cat_id."', sub_cat_id) and city='".$city."'and user_type='Temporary' and  seasonal_temp_hawker_type='Moving'  and duty_status='1'");
       return($q->result_array());
    }
    function check_data_by_registerseller2($cat_id,$city)
    {  
      $q=$this->db->query("SELECT name,user_type,shop_latitude,shop_longitude,shop_gps_id,mobile_no_contact,business_mobile_no,hawker_code,menu_image,menu_image_2,menu_image_3,menu_image_4,seasonal_temp_hawker_type from registration_sellers where FIND_IN_SET('".$cat_id."', cat_id) and city='".$city."' and user_type='Moving' and duty_status='1'");
       return($q->result_array());
     /*  print_r("SELECT name,user_type,shop_latitude,shop_longitude,shop_gps_id,mobile_no_contact,business_mobile_no,hawker_code from registration_sellers where FIND_IN_SET('".$cat_id."', cat_id) and city='".$city."' and user_type='Moving'");
       die();*/
    }
      function check_data_by_registerseller3($sub_cat_id,$city)
    {  
      $q=$this->db->query("SELECT name,user_type,shop_latitude,shop_longitude,shop_gps_id,mobile_no_contact,business_mobile_no,hawker_code,menu_image,menu_image_2,menu_image_3,menu_image_4,seasonal_temp_hawker_type from registration_sellers where FIND_IN_SET('".$sub_cat_id."', sub_cat_id) and city='".$city."' and user_type='Moving' and duty_status='1'");
       return($q->result_array());
      /*  print_r("SELECT name,user_type,shop_latitude,shop_longitude,shop_gps_id,mobile_no_contact,business_mobile_no,hawker_code from registration_sellers where FIND_IN_SET('".$sub_cat_id."', sub_cat_id) and city='".$city."' and user_type='Moving'");
       die();*/

    }
    
     function near_by_hawker_notified_data()
    {  
      $q=$this->db->query("SELECT * from notified_near_by_hawker_for_customer where  status='1'");
      return($q->result_array());
    }

      function category_data_profile()
     {  
       
        $q=$this->db->get_where('fixer_category',['fixer_category.status'=>'1']);
                        
          return($q->result_array());
     }

     function festive_base_category_data_profile()
     {  
       
        $q=$this->db->query("SELECT * from fixer_category where status='1' and type='Tempory'");
          return($q->result_array());
       /* $q=$this->db->where(['status'=>'1'])->where(['type'=>'Tempory'])->or_where(['status'=>'1'],['type'=>'Festive'])->get('fixer_category');

           return $q->result_array();*/

     }
     function seasanal_festive_base_category_data_profile()
     {  
       
        $q=$this->db->query("SELECT * from fixer_category where status='1' and type='Festive'");
          return($q->result_array());
       

     }


      function get_city_data($city)
     {  
        $q=$this->db->query("SELECT city from city_state_code where city='$city' and active_status='1'");
          return($q->row());
     }


      function priority_category_data_profile()
     {  
           $q=$this->db->query("SELECT * from fixer_category where status='1' and type='Moving' ORDER BY priority='Top' DESC, priority='High' DESC, priority='Medium' DESC, priority='Low' DESC");
          return($q->result_array());
     }
     function check_data_status()
     {  
           $q=$this->db->query("SELECT * from fixer_category where status='1'");
          return($q->result_array());
     }
     function priority_category_data_profile1()
     {  
           $q=$this->db->query("SELECT * from fixer_category where status='1' and type='Fix' and type='Fix' ORDER BY priority='Top' DESC, priority='High' DESC, priority='Medium' DESC, priority='Low' DESC");
          return($q->result_array());
     }
     function trending_category_data()
     {  
           $q=$this->db->query("SELECT * from fixer_category where status='1' and priority='Trending'");
          return($q->result_array());
          print_r("SELECT * from fixer_category where status='1' and priority='Trending'");
          die();
     }
     function trending_sub_category_data()
     {  
           $q=$this->db->query("SELECT * from fixer_sub_category where status='1' and priority='Trending'");
          return($q->result_array());
     }
     function favourite_category_data_profile($cus_id)
     { 
         $q=$this->db->query("SELECT cat_id,sub_cat_id,super_sub_cat_id from tbl_favourite_category where cus_id='$cus_id' and status='1'");
          return($q->result_array());
     }

      function customer_profile($cus_id,$mobile_no)
     { 
         $q=$this->db->query("SELECT * from tbl_registration_customer where cus_id='$cus_id' and mobile_no='$mobile_no' and active_status='1'");
           return($q->row());
     }

      function customer_cat_data($cat_id)
     { 
         $q=$this->db->query("SELECT cat_icon_image,cat_name from fixer_category where id='$cat_id' and status='1'");
           return($q->row());
     }
     function get_restaurant_name_data($adminID)
     { 
         $q=$this->db->query("SELECT name from spots where admin_id='$adminID'");
           return($q->row());
     }

      function customer_sub_cat_data($sub_cat_id)
     { 
         $q=$this->db->query("SELECT sub_cat_image,sub_cat_name from fixer_sub_category where id='$sub_cat_id' and status='1'");
           return($q->row());
     }

      public function getSubCategory($cat_id)
     {
         $q = $this->db->get_where('fixer_sub_category',['fixer_sub_category.category'=>$cat_id,'fixer_sub_category.status'=>'1']);
        return($q->result_array());
     }

     public function getcategory($where)
     {
         $q=$this->db->query("SELECT * from fixer_category where id='$where'");
         return($q->result_array());
     }

       public function catgory_notification_data($where)
     {
         $q=$this->db->query("SELECT * from tbl_add_category_notified where cus_id='$where' and status='1' order by id desc");
         return($q->result_array());
     }

     public function sub_catgory_notification_data($where)
     {
         $q=$this->db->query("SELECT * from tbl_add_sub_category_notified where cus_id='$where'and status='1' order by id desc");
         return($q->result_array());
     }

      public function moving_notification_data($where)
     {
         $q=$this->db->query("SELECT * from tbl_notified_moving_data where cus_id='$where' and status='1' order by id desc");
         return($q->result_array());
     }
     public function get_sub_category($where)
     {
         $q=$this->db->query("SELECT * from fixer_sub_category where id='$where'");
         return($q->result_array());
     }

     public function get_super_sub_category($where)
     {
         $q=$this->db->query("SELECT * from fixer_super_sub_category where id='$where'");
         return($q->result_array());
     }

     public function getSuperSubCategory($cat_id,$sub_cat_id)
     {
         $q=$this->db->query("SELECT * from fixer_super_sub_category where cat_id='$cat_id' and sub_cat_id='$sub_cat_id' and status='1'");
         return($q->result_array());
     }

      public function get_menu_image_data($mobile_no)
     {
         $q=$this->db->query("SELECT menu_image,menu_image_2,menu_image_3,menu_image_4 from registration_sellers where mobile_no_contact='$mobile_no'");
          return($q->row());
     }

      function logout_customer_data($data)
    {
        $active_status='0';
        $cus_id = $data->cus_id;
        $device_id = $data->device_id;
        $now = $data->logout_time;
         $this->db->query("UPDATE tbl_login_customer SET active_status='$active_status',logout_time='$now',notification_id='NULL' where cus_id='$cus_id' and device_id='$device_id'");
    }

     public function fetch_category($where)
     {
       $query = $this->db->get_where('tbl_favourite_category',$where)->result_array();  
        return $query;   
     }
      public function fetch_sub_category($where)
     {
        $query = $this->db->get_where('tbl_favourite_category',$where)->result_array();  
         return $query;   
     }
      function send_otp($mobile_no,$otpValue)
    {
        // Set POST variables

        $url = 'https://2factor.in/API/V1/c43867a9-ba7e-11e9-ade6-0200cd936042/SMS/'.$mobile_no.'/'.$otpValue.'/'.'OTP'.'';
        // Open connection
        $ch = curl_init();\
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($url));
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        return $result;
    }

      function otpgetdata($data)
     {
        $mobile_no=$data->mobile_no;
        $device_id=$data->device_id;
        $notification_id=$data->notification_id;
        $cus_id=$data->cus_id;
        $otp=$data->otp;
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $query=$this->db->get_where($this->tbl_otp_customer,['cus_id'=>$data->cus_id,'device_id'=>$device_id])->num_rows();
        if($query>0)
        {
            /*$this->db->where('cus_id', $data->cus_id,'device_id', $data->device_id);  
            $this->db->update($this->tbl_otp_customer, ['create_date'=>$now,'notification_id'=>$notification_id,'mobile_no'=>$mobile_no,'otp'=>$otp]);*/

            $this->db->query("UPDATE tbl_otp_customer SET create_date='$now',notification_id='$notification_id', mobile_no='$mobile_no',otp='$otp' where cus_id='$cus_id' and device_id='$device_id'");
        }
        else
        {
        $query="insert into tbl_otp_customer(cus_id,mobile_no,otp,device_id,notification_id,create_date,status) values('$cus_id','$mobile_no','$otp','$device_id','$notification_id','$now','1')";
        $this->db->query($query);
        }
      }
       function verification_otp($data)
     { 
        $device_id=$data->device_id;
        $mobile_no=$data->mobile_no;
        $otp=$data->otp;
        $q=$this->db->query("SELECT id,mobile_no,cus_id from tbl_otp_customer where otp='".$otp."' and  device_id='".$device_id."' and mobile_no='".$mobile_no."'");
          return($q->row());
        $row = $q->num_rows();

     }

     function get_gst_amount()
     { 
        $q=$this->db->query("SELECT gst_amount from tbl_gst_amount_detail");
          return($q->row());
        $row = $q->num_rows();

     }

      function resend_otp($data)
     {
        $mobile_no=$data->mobile_no;
        $device_id=$data->device_id;
        $otp=$data->otp;
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $query=$this->db->get_where($this->tbl_otp_customer,['mobile_no'=>$data->mobile_no,'device_id'=>$device_id])->num_rows();
        if($query>0)
        {
           /* $this->db->where('device_id', $data->device_id,'mobile_no', $data->mobile_no);  
            $this->db->update($this->tbl_otp_customer, ['create_date'=>$now,'otp'=>$otp]);*/
            $this->db->query("UPDATE tbl_otp_customer SET create_date='$now',otp='$otp' where mobile_no='$mobile_no' and device_id='$device_id'");
        }
        
      }

       function remove_otp($data)
     {
        $mobile_no=$data->mobile_no;
        $device_id=$data->device_id;
        $query=$this->db->get_where($this->tbl_otp_customer,['mobile_no'=>$data->mobile_no,'device_id'=>$device_id])->num_rows();
        if($query>0)
        {
           /* $this->db->where('device_id', $data->device_id,'mobile_no', $data->mobile_no);  
            $this->db->update($this->tbl_otp_customer, ['create_date'=>$now,'otp'=>'NULL']);*/
            $this->db->query("UPDATE tbl_otp_customer SET create_date='$now',otp='NULL' where mobile_no='$mobile_no' and device_id='$device_id'");
        }
        
      }

     function get_data_by_customer($data)
    {   
       $insert = $this->db->insert($this->tbl_customer_call_by_hawker, $data);
       return $insert?$this->db->insert_id():false;
    }

     function get_detail_for_restaurant_by_BLE_brodcast($BLE_id)
     {
       
        $q=$this->db->query("SELECT * from spots where BLE_id='".$BLE_id."'");
          return($q->row());
        $row = $q->num_rows();
     }
     function get_order_detail_for_customer($order_id)
     {
       
        $q=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where order_id='".$order_id."' ");
          return($q->row());
        $row = $q->num_rows();
     }
     
     function get_navigate_by_customer($data)
    {   
       $insert = $this->db->insert($this->tbl_customer_navigate_by_hawker, $data);
       return $insert?$this->db->insert_id():false;
    }

    function rating_for_restaurant_customer($data)
       {
        $admin_id=$data->admin_id;
        $res_id=$data->res_id;
        $cus_id=$data->cus_id;
        $customer_mobile_no=$data->customer_mobile_no;
        $rating_point=$data->rating_point;
        $detail=$data->detail;
        $create_date=$data->create_date;
        $status=$data->status;
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $query=$this->db->get_where($this->tbl_rating_for_customer,['admin_id'=>$admin_id,'customer_mobile_no'=>$customer_mobile_no])->num_rows();
        if($query>0)
        {
            $this->db->query("UPDATE tbl_rating_for_customer SET rating_point='$rating_point', modified_date='$now',detail='$detail' where admin_id='$admin_id' and customer_mobile_no='$customer_mobile_no'");
        }
        else
        {
              $query="insert into tbl_rating_for_customer(admin_id,res_id,cus_id,customer_mobile_no,rating_point,detail,create_date,status) values('$admin_id','$res_id','$cus_id','$customer_mobile_no','$rating_point','$detail','$now',$status)";
        
             $this->db->query($query);
        }
      }

      function get_notification_data($customer_mobile_no)
    {  
      $q=$this->db->query("SELECT * from tbl_notification_by_customer where customer_mobile_no='$customer_mobile_no' order by date_time desc");
       return($q->result_array());
    }

    function get_food_type()
    {  
      $q=$this->db->query("SELECT * from tbl_food_type where status='1'");
       return($q->result_array());
    }

     function Validate_version_data($data)
     {
       
        $version_name = $data->version_name;
        $version_code = $data->version_code;
         $q=$this->db->query("SELECT * from check_version_for_customer where version_name='".$version_name."' and version_code='".$version_code."'");
          return($q->row());
        $row = $q->num_rows();
     }
      function get_restaurantName($admin_id)
     {
       
       
         $q=$this->db->query("SELECT name from spots where admin_id='".$admin_id."'");
          return($q->row());
        $row = $q->num_rows();
     }

    
   }
?>