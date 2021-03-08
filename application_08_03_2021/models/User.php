<?php

class User extends CI_Model
{    
    private $notified_near_by_hawker_for_customer='notified_near_by_hawker_for_customer';
    private $tbl_customer_call_by_hawker='tbl_customer_call_by_hawker';
    private $tbl_customer_navigate_by_hawker='tbl_customer_navigate_by_hawker';
    private $history_notified_near_by_hawker_for_customer='history_notified_near_by_hawker_for_customer';
    private $tbl_notification_by_staff='tbl_notification_by_staff';
    private $tbl_notification_by_customer='tbl_notification_by_customer';
    private $tbl_history_for_location_customer='tbl_history_for_location_customer';
    private $tbl_near_by_notified_radius='tbl_near_by_notified_radius';

    
   

     function insert_notified_data($data)
    {   
       $insert = $this->db->insert($this->tbl_near_by_notified_radius, $data);
       return $insert?$this->db->insert_id():false;
    }

     function backup_notified_data($data)
    {   
       $insert = $this->db->insert($this->history_notified_near_by_hawker_for_customer, $data);
       return $insert?$this->db->insert_id():false;
    }
     function get_notification_id_for_staff_data()
     { 
         $q=$this->db->query("SELECT notification_id FROM tbl_manage_login_user where user_type!='KOT'");
        // print_r("SELECT notification_id FROM login_manage_seller where user_id='$hawker_code'");

         return($q->result_array());
     }
      function notifiedcustomerdata($data)
    {   
       $insert = $this->db->insert($this->tbl_notification_by_staff, $data);
       return $insert?$this->db->insert_id():false;
    }
    function notifiedcustomer_data($data)
    {   
       $insert = $this->db->insert($this->tbl_notification_by_customer, $data);
       return $insert?$this->db->insert_id():false;
    }


    function remove_notified_data($cus_id,$notification_id,$cat_id,$sub_cat_id,$super_sub_cat_id)
    {   
       $this->db->delete('notified_near_by_hawker_for_customer', array('cus_id' => $cus_id,'notification_id' => $notification_id,'cat_id'=>$cat_id,'sub_cat_id'=>$sub_cat_id)); 
    }

    function near_by_hawker_data($data)
    {   
       $insert = $this->db->insert($this->notified_near_by_hawker_for_customer, $data);
       return $insert?$this->db->insert_id():false;
    }

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
     function hawker_get_data()
    {  
      $q=$this->db->query("SELECT hawker_code,end_date  from registration_sellers where  active_status='1' and end_date!=''");
      return($q->result_array());
    }

    function notification_status_update($data1)
    {   
      $order_id =$data1->order_id;
      $admin_id =$data1 ->admin_id;

      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET notification_status_by_staff='1' where order_id='$order_id' and admin_id='$admin_id' ");
    }

    function notification_status_update_by_waiter($data1)
    {   
      $order_id =$data1->order_id;
      $admin_id =$data1 ->admin_id;

      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET NS_for_complete_by_waiter='1' where order_id='$order_id' and admin_id='$admin_id' ");
    }

    function notification_status_update_by_kot($data1)
    {   
      $order_id =$data1->order_id;
      $admin_id =$data1 ->admin_id;

      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET NS_for_kot_for_staff='1' where order_id='$order_id' and admin_id='$admin_id' ");
    }
    function notification_status_update_bywaiter_data($data1)
    {   
      $order_id =$data1->order_id;
      $admin_id =$data1 ->admin_id;

      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET NS_for_kitchen_for_waiter='1' where order_id='$order_id' and admin_id='$admin_id' ");
    }
    function notification_status_update_bywaiter_datas($data1)
    {   
      $order_id =$data1->order_id;
      $admin_id =$data1 ->admin_id;

      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET NS_for_complete_by_chef='1' where order_id='$order_id' and admin_id='$admin_id' ");
    }


    function notification_status_update_by_kitchen($data1)
    {   
      $order_id =$data1->order_id;
      $admin_id =$data1 ->admin_id;

      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET NS_for_kitchen_for_staff='1' where order_id='$order_id' and admin_id='$admin_id' ");
    }

    function notification_status_update_customer($data1)
    {   
      $order_id =$data1->order_id;
      $admin_id =$data1 ->admin_id;

      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET notification_status_by_customer='1' where order_id='$order_id' and admin_id='$admin_id' ");
    }

    function notification__update_waiter_confirm_for_customer($data1)
    {   
      $order_id =$data1->order_id;
      $admin_id =$data1 ->admin_id;

      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET NS_for_complete_by_waiter_for_customer='1' where order_id='$order_id' and admin_id='$admin_id' ");
    }

    function notification__update_kitchen_confirm_for_customer($data1)
    {   
      $order_id =$data1->order_id;
      $admin_id =$data1 ->admin_id;

      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET NS_for_kitchen_for_customer='1' where order_id='$order_id' and admin_id='$admin_id' ");
    }

    function notification__update_kot_confirm_for_customer($data1)
    {   
      $order_id =$data1->order_id;
      $admin_id =$data1 ->admin_id;

      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET NS_for_kot_for_customer='1' where order_id='$order_id' and admin_id='$admin_id' ");
    }

    function order_detail_for_customer()
    {  
       
      $q=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where notification_status_by_staff='0' ORDER BY id DESC");
       return($q->result_array());
    }
    function order_detail_for_restaurant()
    {  
       
      $q=$this->db->query("SELECT order_id,admin_id,table_no,customer_mobile_no,confirm_order_by from tbl_order_detail_for_restaurant where NS_for_complete_by_waiter='0' and order_status='Confirm' ORDER BY id DESC");
       return($q->result_array());
    }

    function order_detail_for_restaurant_confirm_by_kot()
    {  
       
      $q=$this->db->query("SELECT order_id,admin_id,table_no,customer_mobile_no,create_slip_by from tbl_order_detail_for_restaurant where NS_for_kot_for_staff='0' and order_status='Prepare' ORDER BY id DESC");
       return($q->result_array());
    }
    function order_detail_for_customer_data()
    {  
       
      $q=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where notification_status_by_customer='0' ORDER BY id DESC");
       return($q->result_array());
    }

    function order_detail_for_customer_confirm_by_waiter()
    {  
       
      $q=$this->db->query("SELECT order_id,admin_id,table_no,customer_mobile_no,confirm_order_by from tbl_order_detail_for_restaurant where NS_for_complete_by_waiter_for_customer='0' and order_status='Confirm' ORDER BY id DESC");
       return($q->result_array());
    }

    function order_detail_for_customer_confirm_by_cheff()
    {  
       
      $q=$this->db->query("SELECT order_id,admin_id,table_no,customer_mobile_no,order_complete_by from tbl_order_detail_for_restaurant where NS_for_kitchen_for_customer='0' and order_status='Complete' ORDER BY id DESC");
       return($q->result_array());
    }

    function order_detail_for_customer_confirm_by_kitchen()
    {  
       
      $q=$this->db->query("SELECT order_id,admin_id,table_no,customer_mobile_no,order_complete_by from tbl_order_detail_for_restaurant where NS_for_kitchen_for_staff='0' and order_status='Complete' ORDER BY id DESC");
       return($q->result_array());
    }
    function order_detail_for_customer_confirm_by_kitchen_for_waiter()
    {  
       
      $q=$this->db->query("SELECT order_id,admin_id,table_no,customer_mobile_no,order_complete_by from tbl_order_detail_for_restaurant where NS_for_kitchen_for_waiter='0' and order_status='Complete' ORDER BY id DESC");
       return($q->result_array());
    }

    function order_detail_for_customer_confirm_by_chef_for_waiter()
    {  
       
      $q=$this->db->query("SELECT order_id,admin_id,table_no,customer_mobile_no,order_ready_to_serve_by from tbl_order_detail_for_restaurant where NS_for_complete_by_chef='0' and order_status='Ready to Serve' ORDER BY id DESC");
       return($q->result_array());
    }

    function order_detail_for_customer_confirm_by_kot()
    {  
       
      $q=$this->db->query("SELECT order_id,admin_id,table_no,customer_mobile_no,create_slip_by from tbl_order_detail_for_restaurant where NS_for_kot_for_customer='0' and order_status='Prepare' ORDER BY id DESC");
       return($q->result_array());
    }
     
      function customer_sub_cat_data($sub_cat_id)
     { 
         $q=$this->db->query("SELECT sub_cat_image,sub_cat_name from fixer_sub_category where id='$sub_cat_id' and status='1'");
           return($q->row());
     }
      function get_restaurant_notification_id($mobile_no)
     { 
      /*print_r("SELECT notification_id FROM tbl_manage_login_user where mobile_no='$mobile_no' and notification_id!='NULL'");
      die();*/
         $q=$this->db->query("SELECT notification_id FROM tbl_manage_login_user where mobile_no='$mobile_no' and notification_id!='NULL'");
        // print_r("SELECT notification_id FROM login_manage_seller where user_id='$hawker_code'");

         return($q->result_array());
     }
     function get_restaurantName($admin_id)
     {
       
       
         $q=$this->db->query("SELECT name from spots where admin_id='".$admin_id."'");
          return($q->row());
        $row = $q->num_rows();
     }

     function get_waiterName($confirm_order_by)
     {
       
       
         $q=$this->db->query("SELECT name from tbl_manage_login_user where mobile_no='".$confirm_order_by."'");
          return($q->row());
        $row = $q->num_rows();
     }
     function get_restaurant_notification_id_for_customer($customer_mobile_no)
     { 
      /*print_r("SELECT notification_id FROM tbl_login_customer where mobile_no='$customer_mobile_no'");
      die();*/
         $q=$this->db->query("SELECT notification_id FROM tbl_login_customer where mobile_no='$customer_mobile_no'");
         

         return($q->result_array());
     }
     function notifiedhawker_by_duty_on()
    {  
      $q=$this->db->query("SELECT business_start_time,duty_status,hawker_code  from registration_sellers");
      return($q->result_array());
    }
    function notification_by_staff_data($admin_id)
    {  
     /* print_r("SELECT notification_id FROM tbl_manage_login_user where user_type!='Cashier'");
      die();*/
     $q=$this->db->query("SELECT mobile_no FROM tbl_restaurant_staff_registration where admin_id='$admin_id'and  user_type!='KOT' and user_type!='Chef' and user_type!='admin'");
        

         return($q->result_array());
    }
    function notification_by_staff__for_order_complete_by_waiter($admin_id)
    {  
    
     $q=$this->db->query("SELECT mobile_no FROM tbl_restaurant_staff_registration where admin_id='$admin_id' and  user_type!='Waiter' and user_type!='Chef' and user_type!='admin'");
        

         return($q->result_array());
    }

    function notification_by_staff__for_order_complete_by_kot($admin_id)
    {  
    
     $q=$this->db->query("SELECT mobile_no FROM tbl_restaurant_staff_registration where admin_id='$admin_id' and  user_type!='Waiter' and user_type!='KOT' and user_type!='admin'");
        

         return($q->result_array());
    }
    function notification_by_staff__for_order_complete_by_kitchen($admin_id)
    {  
    
     $q=$this->db->query("SELECT mobile_no FROM tbl_restaurant_staff_registration where admin_id='$admin_id' and  user_type!='Waiter' and user_type!='admin'");
        

         return($q->result_array());
    }
    function notification_by_staff__for_order_complete_by_kitchen_for_waiter($admin_id)
    {  
    
     $q=$this->db->query("SELECT mobile_no FROM tbl_restaurant_staff_registration where admin_id='$admin_id' and  user_type!='Chef' and user_type!='KOT' and user_type!='Supervisor' and user_type!='admin'");
        

         return($q->result_array());
    }
    function notification_by_staff__for_order_complete_by_chef_for_waiter($admin_id)
    {  
    
     $q=$this->db->query("SELECT mobile_no FROM tbl_restaurant_staff_registration where admin_id='$admin_id' and  user_type!='Chef' and user_type!='KOT' and user_type!='Supervisor' and user_type!='admin'");
        

         return($q->result_array());
    }
   }
?>