<?php

class Supervisor extends CI_Model
{    
    private $table = 'registration_sales';
    private $tabledata='tbl_manage_login_user';
    private $admin_registration='tbl_admin';
    private $tbl_restaurant_staff_registration='tbl_restaurant_staff_registration';
    private $tbl_temporary_hawker_registration='tbl_temporary_hawker_registration';
    private $tbl_start_trip_by_delivery_boy ='tbl_start_trip_by_delivery_boy';
    private $tbl_end_trip_by_delivery_boy='tbl_end_trip_by_delivery_boy';
    private $duty_on_off_by_delivery_boy='tbl_duty_on_off_by_delivery_boy';
    private $tbl_otp='tbl_otp_admin';
    private $tbl_otp_seller='tbl_otp_for_seller_registration';
    private $spots='spots';
    private $tbl_restaurant_menu_item_list='tbl_restaurant_menu_item_list';
    private $tbl_order_detail_for_restaurant='tbl_order_detail_for_restaurant';
    
    function admin_registration($data)
    {
        $name =$data ->name;
        $restaurant_name=$data->restaurant_name;
        $mobile_no=$data->mobile_no;
        $user_email=$data->email;
        $user_password=$data->user_password;
        $user_role=$data->user_role;
        $user_active=$data->user_active;
        $user_createdate=$data->user_createdate;
        $status=$data->status;
        $user_type='admin';

       /* $insert = $this->db->insert($this->admin_registration, $data);
        return $insert?$this->db->insert_id():false;*/
         $query="insert into tbl_admin(user_fullname,restaurant_name,mobile_no,user_email,user_password,user_role,user_active,user_type,user_createdate,status) values('$name','$restaurant_name','$mobile_no','$user_email','$user_password','$user_role','$user_active','$user_type','$user_createdate','$status')";
        
            $this->db->query($query);
             return $query?$this->db->insert_id():false;
      
    }

    function update_admin_id($alphanumerric,$result)
    {   
      $this->db->query("UPDATE tbl_admin SET admin_id='$alphanumerric' where user_id='$result'");
    }
     function add_order_detail_restaurant($data)
    {
        $insert = $this->db->insert($this->tbl_order_detail_for_restaurant, $data);
        return $insert?$this->db->insert_id():false;
      
    }


    function update_menu_id($alphanumerric,$result)
    {   
      $this->db->query("UPDATE tbl_restaurant_menu_item_list SET menu_id='$alphanumerric' where id='$result'");
    }
    function update_payment_status_by_staff($data)
    {   
      $order_id =$data->order_id;
      $admin_id =$data ->admin_id;
      $payment_status=$data->payment_status;
      $payment_by=$data->payment_by;
      $get_payment=$data->get_payment;
      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET payment_status='$payment_status',payment_by='$payment_by',get_payment='$get_payment' where order_id='$order_id' and admin_id='$admin_id' ");
    }

    function BLE_brodcast_for_restaurants($data)
    {   
      $admin_id =$data ->admin_id;
      $BLE_id=$data->BLE_id;
      $this->db->query("UPDATE spots SET BLE_id='$BLE_id' where  admin_id='$admin_id' ");
    }

    function update_order_waiter_id($alphanumerric,$result)
    {   
      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET order_id='$alphanumerric' where id='$result'");
    }


    function remove_staff($mobile_no)
    {   
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $this->db->query("UPDATE tbl_restaurant_staff_registration SET status='0',modified_date='$now' where mobile_no='$mobile_no'");
    }

    function remove_menu_item_staff($menu_id,$admin_id)
    {   
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $this->db->query("UPDATE tbl_restaurant_menu_item_list SET status='0',modified_date='$now' where menu_id='$menu_id' and admin_id='$admin_id'");
    }

    function confirm_order_by_waiter($data)
    {   
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $waiter_mobile_no =$data ->waiter_mobile_no;
      $order_status=$data->order_status;
      $admin_id=$data->admin_id;
      $order_id=$data->order_id;
        
      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET status='2',modified_date='$now',confirm_order_by='$waiter_mobile_no',order_status='$order_status' where order_id='$order_id' and  admin_id='$admin_id'");
    }

    function update_restaurant_data($data)
    {   
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $city =$data ->city;
      $admin_id=$data->admin_id;
      $name=$data->name;
      $image=$data->image;
      $gst_no =$data ->gst_no;
      $pan_no=$data->pan_no;
      $lat=$data->lat;
      $lng=$data->lng;
      $location =$data ->location;
      $cuisines=$data->cuisines;
      $cost=$data->cost;
      $openingTime=$data->openingTime;
      $closingTime =$data ->closingTime;
      $phone=$data->phone;
      $address=$data->address;
      $amenities=$data->amenities;
      $update_by=$data->update_by;
        
      $this->db->query("UPDATE spots SET city='$city',name='$name',image='$image',gst_no='$gst_no',pan_no='$pan_no',lat='$lat',lng='$lng',location='$location',cuisines='$cuisines',cost='$cost',openingTime='$openingTime',closingTime='$closingTime',phone='$phone',address='$address',amenities='$amenities',update_by='$update_by',modified_date='$now' where admin_id='$admin_id'");

      $this->db->query("UPDATE tbl_admin SET restaurant_name='$name' where admin_id='$admin_id'");
    }

     function create_slip($data)
    {   
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $admin_id=$data->admin_id;
      $order_id=$data->order_id;
      $mobile_no=$data->mobile_no;  
      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET slip_status='1',modified_date='$now',create_slip_by='$mobile_no',order_status='Prepare',status='3' where order_id='$order_id' and  admin_id='$admin_id'");
    }
    function get_order_detail_for_staff($order_id)
     {
       
        $q=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where order_id='".$order_id."'");
          return($q->row());
        $row = $q->num_rows();
     }

    function order_update_for_customer_by_staff($data)
    { 
      $order_id=$data->order_id;  
      $admin_id =$data->admin_id;
      $table_no =$data ->table_no;
      $menu_item_name=$data->menu_item_name;

      $quantity=$data->quantity;
      $menu_price=$data->menu_price;
      $total_item=$data->total_item;
      $total_price=$data->total_price;
      $gst_amount =$data->gst_amount;
      $order_status =$data ->order_status;
      $order_change_by=$data->order_change_by;
      $slip_status=$data->slip_status;
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');

      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET admin_id='$admin_id',table_no='$table_no',menu_item_name='$menu_item_name',quantity='$quantity',menu_price='$menu_price',total_item='$total_item',total_price='$total_price',gst_amount='$gst_amount',order_status='$order_status',order_change_by='$order_change_by',slip_status='$slip_status',modified_date='$now' where order_id='$order_id'");

    }

    /*function order_update_for_customer_by_staffsss($data)
    { 
      $order_id=$data->order_id;  
      $admin_id =$data->admin_id;
      $table_no =$data ->table_no;
      $menu_item_name=$data->menu_item_name;
      $new_menu_item_name=$data->new_menu_item_name;
      $quantity=$data->quantity;
      $menu_price=$data->menu_price;
      $total_item=$data->total_item;
      $total_price=$data->total_price;
      $gst_amount =$data->gst_amount;
      $gst_amount_price =$data->gst_amount_price;
      $net_pay_amount =$data->net_pay_amount;
      $order_status =$data ->order_status;
      $order_change_by=$data->order_change_by;
      $slip_status=$data->slip_status;
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');

      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET admin_id='$admin_id',table_no='$table_no',menu_item_name='$menu_item_name',new_menu_item_name='$new_menu_item_name',quantity='$quantity',menu_price='$menu_price',total_item='$total_item',total_price='$total_price',gst_amount='$gst_amount',gst_amount_price='$gst_amount_price',net_pay_amount='$net_pay_amount',order_status='$order_status',order_change_by='$order_change_by',slip_status='$slip_status',modified_date='$now' where order_id='$order_id'");

    }*/

    function delete_order($data)
    {   
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $admin_id=$data->admin_id;
      $order_id=$data->order_id;
      $mobile_no=$data->mobile_no;  
      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET status='0',modified_date='$now',order_delete_by='$mobile_no',order_status='Rejected' where order_id='$order_id' and  admin_id='$admin_id'");
    }

    function complete_order_by_supervisor($data)
    {   
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $admin_id=$data->admin_id;
      $order_id=$data->order_id;
      $supervisor_mobile_no=$data->supervisor_mobile_no;  
      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET status='4',modified_date='$now',order_complete_by='$supervisor_mobile_no',order_status='Complete' where order_id='$order_id' and  admin_id='$admin_id'");
    }

    function complete_order_by_chef($data)
    {   
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');
      $admin_id=$data->admin_id;
      $order_id=$data->order_id;
      $chef_mobile_no=$data->chef_mobile_no;  
      $this->db->query("UPDATE tbl_order_detail_for_restaurant SET status='5',modified_date='$now',order_ready_to_serve_by='$chef_mobile_no',order_status='Ready to Serve' where order_id='$order_id' and  admin_id='$admin_id'");
    }


    function staff_registration($data)
    {
        $insert = $this->db->insert($this->tbl_restaurant_staff_registration, $data);
        return $insert?$this->db->insert_id():false;
      
    }
    function add_order_detail_for_waiter($data)
    {
        $insert = $this->db->insert($this->tbl_order_detail_for_restaurant, $data);
        return $insert?$this->db->insert_id():false;
      
    }

    function add_restaurant($data)
    {
        $insert = $this->db->insert($this->spots, $data);
        return $insert?$this->db->insert_id():false;
      
    }

    function add_menu_item_restaurant($data)
    {
        $insert = $this->db->insert($this->tbl_restaurant_menu_item_list, $data);
        return $insert?$this->db->insert_id():false;
      
    }

    function get_user_type()
    {  
      $q=$this->db->query("SELECT * from tbl_user_type where status='1'");
       return($q->result_array());
    }
    function get_notification_data($staff_mobile_no)
    {  
      $q=$this->db->query("SELECT * from tbl_notification_by_staff where staff_mobile_no='$staff_mobile_no' order by date_time desc");
       return($q->result_array());
    }

     public function check_total_count($admin_id,$order_status)
     {
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d');
        $q=$this->db->query("SELECT order_id from tbl_order_detail_for_restaurant where admin_id='$admin_id' and order_status='$order_status'");
        return($q->num_rows());
     }


    function get_order_data($start_date,$end_date,$admin_id)
    {  
      /*print_r("SELECT * FROM tbl_order_detail_for_restaurant where date 
                          between '$start_date' and '$end_date'  and order_status ='Complete' and admin_id='$admin_id' order by date desc ");
      die();*/
      $q=$this->db->query("SELECT * FROM tbl_order_detail_for_restaurant where date 
                          between '$start_date' and '$end_date'  and order_status ='Complete' and admin_id='$admin_id' order by date desc ");
      
       return($q->result_array());
    }
    function getGroupData($admin_id,$order_status)
    {
      if($order_status == '')
      {
        $data=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where admin_id='$admin_id' and order_status!='Pending' and order_status!='Rejected' and order_status!='Complete'group by order_id ORDER BY create_date DESC");
        /*$data = $this->db->order_by('create_date', 'DESC')->group_by("order_id")->select('order_id')->get_where("tbl_order_detail_for_restaurant",["order_status !="=>'Rejected',"order_status !="=>'Complete','order_status !='=>'Pending','admin_id'=>$admin_id])->result_array();*/
      }
      else if($order_status=='Prepare')
      {
        $data=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where admin_id='$admin_id' and order_status!='Pending' and order_status!='Rejected' and order_status!='Complete'group by order_id ORDER BY create_date DESC");
        
      }
      else
      {
         /*$data = $this->db->order_by('create_date', 'DESC')->group_by("order_id")->select('order_id')->get_where("tbl_order_detail_for_restaurant",["order_status"=>$order_status,'admin_id'=>$admin_id])->result_array();*/
          $data=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where admin_id='$admin_id' and order_status='$order_status' group by order_id ORDER BY create_date DESC");

      }
       
        return($data->result_array());
    }
     function getGroupData_for_date($admin_id,$start_date,$end_date)
    {
      
        $data=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where date 
                          between '$end_date' and '$start_date'  and order_status ='Complete' and admin_id='$admin_id' group by order_id ORDER BY date DESC");
              //print_r($this->db->last_query());exit;
        return($data->result_array());
    }

    function getGroupDatas($order_id)
    {
      
         $data = $this->db->order_by('create_date', 'DESC')->group_by("order_id")->select('order_id')->get_where("tbl_order_detail_for_restaurant",["order_id"=>$order_id])->result_array();
       
       return $data;
    }
    function getDataOrderWise($orderid)
    {
      $result = $this->db->get_where("tbl_order_detail_for_restaurant",['order_id'=>$orderid])->result_array();
        return $result;

    }
    function getDataOrderWisedate($orderid)
    {
      $result = $this->db->get_where("tbl_order_detail_for_restaurant",['order_id'=>$orderid,'order_status'=>'Complete'])->result_array();
	//print_r($this->db->last_query());exit;

        return $result;

    }
    function getDataOrderWises($orderid)
    {
      $result = $this->db->get_where("tbl_order_detail_for_restaurant",['order_id'=>$orderid])->result_array();
        return $result;

    }
    function order_detail_for_restaurant_customer($admin_id,$order_status)
    { 
     
      if($order_status=='')
      {
         $q=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where admin_id='$admin_id' and order_status!='Pending' and order_status!='Rejected' and order_status!='Complete' ORDER BY create_date DESC");
       return($q->result_array());
      }
      else
      {
         $q=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where admin_id='$admin_id' and order_status='$order_status' ORDER BY create_date DESC");
       return($q->result_array());
      }
       
     
    }
    function order_detail_for_restaurant_supervisor($admin_id,$order_status)
    {  
       
      $q=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where admin_id='$admin_id' and order_status='$order_status'");
       return($q->result_array());
    }
    function update_menu_profile($data)
    { 
      $menu_id=$data->menu_id;  
      $admin_id =$data->admin_id;
      $menu_food_type =$data->menu_food_type;
      $menu_name =$data ->menu_name;
      $menu_image=$data->menu_image;
      $menu_detail=$data->menu_detail;
      $menu_half_price=$data->menu_half_price;
      $menu_full_price=$data->menu_full_price;
      $menu_fix_price=$data->menu_fix_price;
      $nutrient_counts =$data->nutrient_counts;
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');

      $this->db->query("UPDATE tbl_restaurant_menu_item_list SET menu_food_type='$menu_food_type', menu_name='$menu_name',menu_image='$menu_image',menu_detail='$menu_detail',menu_half_price='$menu_half_price',menu_full_price='$menu_full_price',menu_fix_price='$menu_fix_price',nutrient_counts='$nutrient_counts',modified_date='$now' where menu_id='$menu_id'");

    }

    function update_staff_profile($data)
    { 
      $admin_id=$data->admin_id;  
      $name =$data->name;
      $username =$data->username;
      $mobile_no =$data ->mobile_no;
      $email=$data->email;
      $password=$data->password;
      $date_of_birth=$data->date_of_birth;
      $aadhar_no=$data->aadhar_no;
      $pan_number=$data->pan_number;
      $desingination =$data->desingination;
      $gender =$data->gender;
      $permanent_address =$data->permanent_address;
      $current_address =$data->current_address;
      $user_type =$data->user_type;
      date_default_timezone_set('Asia/kolkata'); 
      $now = date('Y-m-d H:i:s');

      $this->db->query("UPDATE tbl_restaurant_staff_registration SET name='$name', username='$username',mobile_no='$mobile_no',email='$email',password='$password',date_of_birth='$date_of_birth',aadhar_no='$aadhar_no',pan_number='$pan_number',desingination='$desingination',gender='$gender',permanent_address='$permanent_address',current_address='$current_address',user_type='$user_type',modified_date='$now' where admin_id='$admin_id' and mobile_no='$mobile_no'");

    }
   
    function get_menu_list_data($admin_id)
    {  
      $q=$this->db->query("SELECT * from tbl_restaurant_menu_item_list where  admin_id='$admin_id' and  status='1'");
       return($q->result_array());
    }
    function get_food_type()
    {  
      $q=$this->db->query("SELECT * from tbl_food_type where status='1'");
       return($q->result_array());
    }
    function get_amenities_type()
    {  
      $q=$this->db->query("SELECT * from tbl_amenities_type where status='1'");
       return($q->result_array());
    }
    function get_staff_data($admin_id)
    {  
      $q=$this->db->query("SELECT * from tbl_restaurant_staff_registration where admin_id='$admin_id' and  status='1'");
       return($q->result_array());
    }
    function add_reg($data_reg)
    {
        $insert = $this->db->insert($this->registration_seller_reg, $data_reg);
        return $insert?$this->db->insert_id():false;
      
    }
    function temporary_hawker_registration($data)
    {
        $insert = $this->db->insert($this->tbl_temporary_hawker_registration, $data);
        return $insert?$this->db->insert_id():false;
      
    }

     function start_trip_by_delivery_boy($data)
    {
        $insert = $this->db->insert($this->tbl_start_trip_by_delivery_boy, $data);
        return $insert?$this->db->insert_id():false;
      
    }

     function end_trip_by_delivery_boy($data)
    {
        $insert = $this->db->insert($this->tbl_end_trip_by_delivery_boy, $data);
        return $insert?$this->db->insert_id():false;
      
    }


     ////////Add Registartion sales data //////////
    function manage_login_data($where)
    {
        $name =$where ->name;
        $user_type=$where->user_type;
        $mobile_no=$where->mobile_no;
        $device_id=$where->device_id;
        $notification_id=$where->notification_id;
        $login_time=$where->login_time;

        $query=$this->db->get_where($this->tabledata,['mobile_no'=>$where->mobile_no,'device_id'=>$device_id])->num_rows();
        $query1=$this->db->get_where($this->tabledata,['mobile_no'=>$where->mobile_no])->num_rows();

         /*$query1=$this->db->get_where($this->tabledata,['delivery_id'=>$where->delivery_id])->num_rows();*/

         /* $q=$this->db->query("SELECT * from login_manage_sales where user_id='".$sales_id."'");
          return($q->row());
          $row = $q->num_rows();
          */
        if($query>0)
        {
           /* $this->db->where('mobile_no', $where->mobile_no);  
            $this->db->update($this->tabledata, ['login_time'=>$login_time,'notification_id'=>$notification_id,'active_status'=>'1']);*/
             $this->db->query("UPDATE tbl_manage_login_user SET login_time='$login_time',notification_id='$notification_id' where mobile_no='$mobile_no' and device_id='$device_id'");

        }

        else if($query1>0)
        {
            $this->db->query("UPDATE tbl_manage_login_user SET login_time='$login_time',notification_id='$notification_id',device_id='$device_id' where mobile_no='$mobile_no'");
        }
       
        else
        {

             $query="insert into tbl_manage_login_user(name,mobile_no,device_id,notification_id,user_type,login_time,active_status,status) values('$name','$mobile_no','$device_id','$notification_id','$user_type','$login_time','1','1')";
        
            $this->db->query($query);

        }
     }

    

     function update_login_data($data)
     {
       $device_id=$data->device_id;
        $notification_id=$data->notification_id;
        $login_time=$data->login_time;
        $mobile_no = $data->mobile_no;

         $this->db->where('mobile_no', $data->mobile_no);  
             $this->db->update($this->tabledata, ['login_time'=>$login_time,'notification_id'=>$notification_id,'device_id'=>$device_id,'active_status'=>'1']);

     }

      function check_login_validate_data($data)
     {
        $delivery_id = $data->delivery_id;
        $q=$this->db->query("SELECT * from tbl_login_manage_delivery_boy where delivery_id='".$delivery_id."'");
          return($q->row());
        $row = $q->num_rows();
     }
      function get_restaurant_data($admin_id)
     {
       
        $q=$this->db->query("SELECT restaurant_name from tbl_admin where admin_id='".$admin_id."'");
          return($q->row());
        $row = $q->num_rows();
     }
     function check_data_for_restaurant($admin_id)
     {
       
        $q=$this->db->query("SELECT * from spots where admin_id='".$admin_id."'");
          return($q->row());
        $row = $q->num_rows();
     }
     function get_detail_for_restaurant($admin_id)
     {
       
        $q=$this->db->query("SELECT * from spots where admin_id='".$admin_id."'");
          return($q->row());
        $row = $q->num_rows();
     }
     function get_staff_detail($admin_id,$mobile_no)
     {
       
        $q=$this->db->query("SELECT * from tbl_restaurant_staff_registration where admin_id='$admin_id' and mobile_no='$mobile_no'");
          return($q->row());
        $row = $q->num_rows();
     }

     function get_data_login($mobile_no)
     {
       
        $q=$this->db->query("SELECT * from tbl_login_manage_delivery_boy where delivery_id='".$delivery_id."'");
          return($q->row());
        $row = $q->num_rows();
     }

      ////////Add Registration Sales data //////////
     
     ////////Validate salesuser data //////////
    function Validate_sales_user($data)
     {
        $salesID = $data->sales_id;
        $q=$this->db->query("SELECT * from registration_sales where sales_id='".$salesID."'");
          return($q->row());
        $row = $q->num_rows();
        
       
     }


     ////////Validate salesuser data //////////

      ////////check device  salesuser //////////
    function check_device_for_sales($data)
     {
        $sales_id =$data->sales_id;
        $q=$this->db->query("SELECT * from login_manage_sales where user_id='".$sales_id."'");
          return($q->row());
        $row = $q->num_rows();
        
       
     }
     ////////check device for  salesuser //////////

      function check_city_status_sales($data)
     {
        $city =$data->city;
        $q=$this->db->query("SELECT city,active_status from city_state_code where city='".$city."' and active_status='1'");
          return($q->row());
        $row = $q->num_rows();
        
       
     }
   


    
     function duty_data_by_delivery_boy($data)
    {
        $insert = $this->db->insert($this->duty_on_off_by_delivery_boy, $data);
        return $insert?$this->db->insert_id():false;
      
    }



     function check_duty_data_by_delivery_boy($delivery_id)
     {  
        $q=$this->db->query("SELECT * from tbl_duty_on_off_by_delivery_boy where delivery_id='$delivery_id' order by id desc limit 1");
         return($q->row());
     }

     function check_logout_data_delivery_boy($delivery_id,$mobile_no)
     {  

        $q=$this->db->query("SELECT * from tbl_login_manage_delivery_boy where delivery_id='$delivery_id' and mobile_no='$mobile_no'");
         return($q->row());
     }

     function logout_staff_data($data)
    {
        $active_status='0';
        $mobile_no = $data->mobile_no;
        $device_id = $data->device_id;
        $now = $data->logout_time;
         $this->db->query("UPDATE tbl_manage_login_user SET active_status='$active_status',logout_time='$now',notification_id='NULL' where mobile_no='$mobile_no' and device_id='$device_id'");
    }

      function check_data_sales_profile($data)
     {  
        $sales_id = $data->sales_id;
        $q=$this->db->where(['sales_id'=>$sales_id,'active_status'=>'1'])
          ->get('registration_sales');
          return($q->row());
     }
      function category_data_profile($cat_name)
     {  
       
        $q=$this->db->get_where('fixer_category',['fixer_category.sales_status'=>'2','fixer_category.cat_name'=>$cat_name]);
                        
          return($q->result_array());
     }
     function category1_data_profile()
     {  
       
        $q=$this->db->get_where('fixer_category',['fixer_category.sales_status'=>'3','fixer_category.type'=>'Fix']);
                        
          return($q->result_array());
     }
     function category2_data_profile()
     {  
       
        $q=$this->db->get_where('fixer_category',['fixer_category.sales_status'=>'3','fixer_category.type'=>'Moving']);
                        
          return($q->result_array());
     }
    
     public function getSubCategory($where)
     {
         $query = $this->db->get_where('fixer_sub_category',$where)->result_array();  
         return $query;   
     }
      public function getSuperSubCategory($sub_cat_id)
     {
         $q = $this->db->get_where('fixer_super_sub_category',['fixer_super_sub_category.sub_cat_id'=>$sub_cat_id]);
        return($q->result_array());
     }
     public function gethawkertypename($hawker_type_code)
     {
         $q = $this->db->get_where('hawkers_sub_type',['hawkers_sub_type.status'=>'1','hawkers_sub_type.hawker_type_code'=>$hawker_type_code]);
        return($q->result_array());
     }

     function logout_sales_data($data)
    {
        $active_status='0';
        $delivery_id = $data->delivery_id;
        $now = $data->logout_time;
        $this->db->where('delivery_id',$delivery_id);  
        $this->db->update($this->tabledata, ['active_status'=>$active_status,'logout_time'=>$now]);
    }

    function update_shop_id($alphanumerric,$result,$hawkerCode)
    {   
      $this->db->query("UPDATE registration_sellers SET shop_id='$alphanumerric',hawker_code='$hawkerCode' where id='$result'");
    }

    function update_temporary_data($result,$hawkerCode)
    {   
      $this->db->query("UPDATE tbl_temporary_hawker_registration SET hawker_code='$hawkerCode' where id='$result'");
    }

    function update_verification_hawker($mobile_no)
    {   
      $this->db->query("UPDATE registration_sellers SET verification_status='1' where mobile_no_contact='$mobile_no'");
    }


    ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '')
    {
        if (file_exists('manage/catImages/' . $id . '.jpg'))
            $image_url = base_url() . 'manage/catImages/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = 'http://10.0.0.25/fixer_goolean/manage/catImages/'.$id.'';

        return $image_url;
    }

     ////////IMAGE URL//////////

     function fetch_login_data($data)
     {
        $mobile_no = $data->mobile_no;
        $q=$this->db->query("SELECT * from login_manage_sales where mobile_no='".$mobile_no."'");
          return($q->row());
        $row = $q->num_rows();
        
       
     }

      function insert_duty_status__for_sales($data3)
    {
        $insert = $this->db->insert($this->duty_on_off_by_sales, $data3);
        return $insert?$this->db->insert_id():false;
      
    }
     function updatehawkerdata($data)
    {
        $mobile_no_contact = $data->mobile_no_contact;
        $name = $data->name;
       $this->db->where('mobile_no_contact', $mobile_no_contact);
         $this->db->update($this->registration_seller,$data);
      
    }
     function updatehawkerdata_img($data)
    {
        $mobile_no_contact = $data->mobile_no_contact;
        $name = $data->name;
       $this->db->where('mobile_no_contact', $mobile_no_contact);
         $this->db->update($this->registration_seller_reg,$data);
      
    }

     function checkcode($data)
     {
        $city = $data->city;
        $state = $data->state;
        $q=$this->db->query("SELECT city, state_code,id from city_state_code where city='".$city."' and state='".$state."' and active_status='1'");
          return($q->row());
        $row = $q->num_rows();
     }

     function checktype($data)
     {
        $user_type = $data->user_type;
        $q=$this->db->query("SELECT code from hawker_type where hawker_type='".$user_type."'");
          return($q->row());
        $row = $q->num_rows();
     }

     function send_otp($mobile_no,$otpValue)
    {
        // Set POST variables

        $url = 'https://2factor.in/API/V1/c43867a9-ba7e-11e9-ade6-0200cd936042/SMS/'.$mobile_no.'/'.$otpValue.'/'.'OTP'.'';
        // Open connection
        $ch = curl_init();
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
        $otp=$data->otp;
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $query=$this->db->get_where($this->tbl_otp,['mobile_no'=>$data->mobile_no,'device_id'=>$device_id])->num_rows();
        if($query>0)
        {
            $this->db->query("UPDATE tbl_otp_admin SET create_date='$now',notification_id='$notification_id',mobile_no='$mobile_no',otp='$otp' where mobile_no='$mobile_no' and device_id='$device_id'");
        }
        else
        {
        $query="insert into tbl_otp_admin(otp,mobile_no,device_id,notification_id,create_date,status) values('$otp','$mobile_no','$device_id','$notification_id','$now','1')";
        $this->db->query($query);
        }
      }

      function otpgetdata_by_seller($data)
      {
        $mobile_no=$data->mobile_no_contact;
        $device_id=$data->device_id;
        $seller_id=$data->seller_id;
        $otp=$data->otp;
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $query=$this->db->get_where($this->tbl_otp_seller,['seller_id'=>$data->seller_id,'device_id'=>$device_id])->num_rows();
        if($query>0)
        {
             $this->db->query("UPDATE tbl_otp_for_seller_registration SET date_time='$now',mobile_no='$mobile_no',otp='$otp' where seller_id='$seller_id' and device_id='$device_id'");
        }
        else
        {
        $query="insert into tbl_otp_for_seller_registration(seller_id,mobile_no,otp,device_id,date_time) values('$seller_id','$mobile_no','$otp','$device_id','$now')";
        $this->db->query($query);
        }
      }

      function verification_otp($data)
     { 
        $device_id=$data->device_id;
        $mobile_no=$data->mobile_no;
        $otp=$data->otp;
        $q=$this->db->query("SELECT mobile_no from tbl_otp_admin where otp='".$otp."' and  device_id='".$device_id."' and mobile_no='".$mobile_no."'");
          return($q->row());
        $row = $q->num_rows();

     }

      function verification_otp_by_seller($data)
     { 
        $device_id=$data->device_id;
        $mobile_no=$data->mobile_no;
        $otp=$data->otp;
        $q=$this->db->query("SELECT mobile_no,seller_id from tbl_otp_for_seller_registration where otp='".$otp."' and  device_id='".$device_id."' and mobile_no='".$mobile_no."'");
          return($q->row());
        $row = $q->num_rows();

     }

     /*function fetch_data_registration($mobile_no_contact)
     { 
        $q=$this->db->query("select * from registration_sellers where mobile_no_contact='".$mobile_no_contact."' and verification_by_call='0' and verification_status='0'");
          return($q->row());
        $row = $q->num_rows();

     }*/

      function resend_otp($data)
     {
        $mobile_no=$data->mobile_no;
        $device_id=$data->device_id;
        $otp=$data->otp;
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $query=$this->db->get_where($this->tbl_otp,['mobile_no'=>$data->mobile_no,'device_id'=>$device_id])->num_rows();
        if($query>0)
        {  
             $this->db->query("UPDATE tbl_otp_admin SET create_date='$now',otp='$otp' where mobile_no='$mobile_no' and device_id='$device_id'");
        }
        
      }

      function resend_otp_for_seller($data)
     {
        $mobile_no=$data->mobile_no;
        $device_id=$data->device_id;
        $otp=$data->otp;
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $query=$this->db->get_where($this->tbl_otp_seller,['mobile_no'=>$data->mobile_no,'device_id'=>$device_id])->num_rows();
        if($query>0)
        {
    
             $this->db->query("UPDATE tbl_otp_for_seller_registration SET date_time='$now',otp='$otp' where mobile_no='$mobile_no' and device_id='$device_id'");
        }
        
      }
       function update_check_list($data)
     {
        $hawker_code=$data->hawker_code;
        $sales_id=$data->sales_id;
        $check_list=$data->check_list;
        $query=$this->db->get_where($this->registration_seller,['hawker_code'=>$data->hawker_code,'sales_id'=>$sales_id])->num_rows();
        if($query>0)
        {
             $this->db->query("UPDATE registration_sellers SET check_list='$check_list' where hawker_code='$hawker_code' and sales_id='$sales_id'");
        }
        
      }
       function remove_otp($data)
     {
        $mobile_no=$data->mobile_no;
        $device_id=$data->device_id;
         date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $query=$this->db->get_where($this->tbl_otp,['mobile_no'=>$data->mobile_no,'device_id'=>$device_id])->num_rows();
        if($query>0)
        {
            $this->db->query("UPDATE tbl_otp_admin SET create_date='$now',otp='NULL' where device_id='$device_id' and mobile_no='$mobile_no'");
        }
        
      }

        function remove_otp_for_seller($data)
     {
        $mobile_no=$data->mobile_no;
        $device_id=$data->device_id;
         date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $query=$this->db->get_where($this->tbl_otp_seller,['mobile_no'=>$data->mobile_no,'device_id'=>$device_id])->num_rows();
        if($query>0)
        {
              $this->db->query("UPDATE tbl_otp_for_seller_registration SET date_time='$now',otp='NULL' where device_id='$device_id' and mobile_no='$mobile_no'");
        }
        
      }
      function Validate_version_data($data)
     {
       
        $version_name = $data->version_name;
        $version_code = $data->version_code;
         $q=$this->db->query("SELECT * from check_version_for_sale where version_name='".$version_name."' and version_code='".$version_code."'");
          return($q->row());
        $row = $q->num_rows();
     }

     public function check_total_count_notifications($staff_mobile_no)
     {
        date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d');
        $q=$this->db->query("SELECT order_id from tbl_notification_by_staff where staff_mobile_no='".$staff_mobile_no."' and count_status='0'");
        return($q->num_rows());
     }

     function check_status_for_notifications($check_status,$staff_mobile_no)
    {   
      $this->db->query("UPDATE tbl_notification_by_staff SET count_status='$check_status' where staff_mobile_no='$staff_mobile_no'");
    }


     function get_gst_amount()
     { 
        $q=$this->db->query("SELECT gst_amount from tbl_gst_amount_detail");
          return($q->row());
        $row = $q->num_rows();

     }
     function check_list_data()
     {  
       
        $q=$this->db->get_where('tbl_check_list_for_sale',['tbl_check_list_for_sale.status'=>'1']);
                        
          return($q->result_array());
     }
    public function getAmenitiesType()
     {
      $this->db->select('amenities_type');
      $this->db->from('tbl_amenities_type');
      $this->db->where('status',1);
      $query=$this->db->get();
      $result=$query->result_array();
      return $result;
     }
     public function getFoodType()
     {
      $this->db->select('food_type');
      $this->db->from('tbl_food_type');
      $this->db->where('status',1);
      $query=$this->db->get();
      $result=$query->result_array();
      return $result;
     }
 public function getFileName($admin_id)
     {
        $this->db->select('image');
        $this->db->from('spots');
        $this->db->where('admin_id',$admin_id);
        $query=$this->db->get();
        $result=$query->result_array();
        return $result[0]['image'];
     }
public function getMenuImage($menu_id,$admin_id)
     {
        $this->db->select('menu_image');
        $this->db->from('tbl_restaurant_menu_item_list');
        $this->db->where('admin_id',$admin_id);
        $this->db->where('menu_id',$menu_id);
        $query=$this->db->get();
        $result=$query->result_array();
        return $result[0]['menu_image'];
     }
   }
?>