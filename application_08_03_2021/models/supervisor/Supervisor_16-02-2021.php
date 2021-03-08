<?php

class Supervisor extends CI_Model
{    
    
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
        
        $json_decode =json_decode(TABLES);
        $insert = $this->db->insert($json_decode->table30, $data);
	       //print_r($this->db->last_query());exit;
        return $insert?$this->db->insert_id():false;
      
    }


    function update_menu_id($alphanumerric,$result)
    {   
      $json_decode =json_decode(TABLES);
      $this->db->query("UPDATE $json_decode->table24 SET menu_id='$alphanumerric' where id='$result'");
    }
    function update_payment_status_by_staff($data)
    { 
      // $json_decode =json_decode(TABLES);
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
      $json_decode =json_decode(TABLES); 
      $now = date('Y-m-d H:i:s');
      $waiter_mobile_no =$data ->waiter_mobile_no;
      $order_status=$data->order_status;
      $admin_id=$data->admin_id;
      $order_id=$data->order_id;
      $this->db->query("UPDATE $json_decode->table17 SET status='2',modified_date='$now',confirm_order_by='$waiter_mobile_no',order_status='$order_status' where order_id='$order_id' and  admin_id='$admin_id'");
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
      $json_decode =json_decode(TABLES);
      $admin_id=$data->admin_id;
      $order_id=$data->order_id;
      $mobile_no=$data->mobile_no;  
      $this->db->query("UPDATE $json_decode->table17 SET slip_status='1',modified_date='$now',create_slip_by='$mobile_no',order_status='Prepare',status='3' where order_id='$order_id' and  admin_id='$admin_id'");
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

    function delete_order($data)
    {   
      date_default_timezone_set('Asia/kolkata');
      $json_decode =json_decode(TABLES); 
      $now = date('Y-m-d H:i:s');
      $admin_id=$data->admin_id;
      $order_id=$data->order_id;
      $mobile_no=$data->mobile_no;  
      $this->db->query("UPDATE $json_decode->table17 SET status='0',modified_date='$now',order_delete_by='$mobile_no',order_status='Rejected' where order_id='$order_id' and  admin_id='$admin_id'");
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
        $json_decode =json_decode(TABLES);
        $insert = $this->db->insert($json_decode->table25, $data);
        return $insert?$this->db->insert_id():false;      
    }
    function add_order_detail_for_waiter($data)
    {
        $json_decode =json_decode(TABLES);
        $insert = $this->db->insert($json_decode->table17, $data);
        return $insert?$this->db->insert_id():false;
      
    }

    function add_restaurant($data)
    {
        $json_decode =json_decode(TABLES);
        $insert = $this->db->insert($json_decode->table3, $data);
        return $insert?$this->db->insert_id():false;      
    }

    function add_menu_item_restaurant($data)
    {
        $json_decode =json_decode(TABLES);
        $insert = $this->db->insert($json_decode->table24, $data);
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
      
      $q=$this->db->query("SELECT * FROM tbl_order_detail_for_restaurant where date 
                          between '$start_date' and '$end_date'  and order_status ='Complete' and admin_id='$admin_id' order by date desc ");
      
       return($q->result_array());
    }
    function getGroupData($admin_id,$order_status)
    {
      $json_decode =json_decode(TABLES);
      $this->db->select('*');
      $this->db->from($json_decode->table17);
      $this->db->where('admin_id',$admin_id);
      $this->db->group_by('order_id');
      $this->db->order_by('create_date',DESC);
      $query=$this->db->get();
      // print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;

     
    }
     function getGroupData_for_date($admin_id,$start_date,$end_date)
    {
      
        $data=$this->db->query("SELECT * from tbl_order_detail_for_restaurant where date 
                          between '$end_date' and '$start_date' and admin_id='$admin_id' group by order_id ORDER BY date DESC");
            
        return($data->result_array());
    }

    function getGroupDatas($order_id)
    {
      
         $data = $this->db->order_by('create_date', 'DESC')->group_by("order_id")->select('order_id')->get_where("tbl_order_detail_for_restaurant",["order_id"=>$order_id])->result_array();
       
       return $data;
    }
    function getDataOrderWise($orderid,$admin_id)
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

    
    function manage_login_data($where)
    {
        $name =$where ->name;
        $user_type=$where->user_type;
        $mobile_no=$where->mobile_no;
        $device_id=$where->device_id;
        $notification_id=$where->notification_id;
        $login_time=$where->login_time;
        
        $query=$this->db->get_where(json_decode(TABLES)->table13,['mobile_no'=>$where->mobile_no,'device_id'=>$device_id])->num_rows();
        $query1=$this->db->get_where(json_decode(TABLES)->table13,['mobile_no'=>$where->mobile_no])->num_rows();

        if($query>0)
        {
          
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
             $this->db->update(json_decode(TABLES)->table13, ['login_time'=>$login_time,'notification_id'=>$notification_id,'device_id'=>$device_id,'active_status'=>'1']);

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
    
     function logout_staff_data($data)
    {
        $active_status='0';
        $mobile_no = $data->mobile_no;
        $device_id = $data->device_id;
        $now = $data->logout_time;
         $this->db->query("UPDATE tbl_manage_login_user SET active_status='$active_status',logout_time='$now',notification_id='NULL' where mobile_no='$mobile_no' and device_id='$device_id'");
    }


     function send_otp($mobile_no,$otpValue)
    {
        // Set POST variables
        //$otpValue='1234';
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
        $query=$this->db->get_where(json_decode(TABLES)->table19,['mobile_no'=>$data->mobile_no,'device_id'=>$device_id])->num_rows();
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

      function verification_otp($data)
     { 
        $device_id=$data->device_id;
        $mobile_no=$data->mobile_no;
        $otp=$data->otp;
        $q=$this->db->query("SELECT mobile_no from tbl_otp_admin where otp='".$otp."' and  device_id='".$device_id."' and mobile_no='".$mobile_no."'");
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
        $query=$this->db->get_where(json_decode(TABLES)->table19,['mobile_no'=>$data->mobile_no,'device_id'=>$device_id])->num_rows();
        if($query>0)
        {  
             $this->db->query("UPDATE tbl_otp_admin SET create_date='$now',otp='$otp' where mobile_no='$mobile_no' and device_id='$device_id'");
        }
        
      }

      
       function remove_otp($data)
     {
        $mobile_no=$data->mobile_no;
        $device_id=$data->device_id;
         date_default_timezone_set('Asia/kolkata'); 
        $now = date('Y-m-d H:i:s');
        $query=$this->db->get_where(json_decode(TABLES)->table19,['mobile_no'=>$data->mobile_no,'device_id'=>$device_id])->num_rows();
        if($query>0)
        {
            $this->db->query("UPDATE tbl_otp_admin SET create_date='$now',otp='NULL' where device_id='$device_id' and mobile_no='$mobile_no'");
        }
        
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
     
    public function getAmenitiesType()
     {
      $json_decode =json_decode(TABLES);
      $this->db->select('amenities_type');
      $this->db->from($json_decode->table5);
      $this->db->where('status',1);
      $query=$this->db->get();
      $result=$query->result_array();
      return $result;
     }
     public function getFoodType()
     {
      $json_decode =json_decode(TABLES);
      $this->db->select('food_type');
      $this->db->from($json_decode->table8);
      $this->db->where('status',1);
      $query=$this->db->get();
      $result=$query->result_array();
      return $result;
     }
 public function getFileName($admin_id)
     {
        $json_decode =json_decode(TABLES);
        $this->db->select('image');
        $this->db->from($json_decode->table3);
        $this->db->where('admin_id',$admin_id);
        $query=$this->db->get();
        $result=$query->result_array();
        return $result[0]['image'];
     }
public function getMenuImage($menu_id,$admin_id)
     {
        $json_decode =json_decode(TABLES);
        $this->db->select('menu_image');
        $this->db->from($json_decode->table24);
        $this->db->where('admin_id',$admin_id);
        $this->db->where('menu_id',$menu_id);
        $query=$this->db->get();
        $result=$query->result_array();
        return $result[0]['menu_image'];
     }
  public function getMax($order_id,$admin_id)
  {

    $json_decode =json_decode(TABLES);
    $this->db->select('*');
    $this->db->from($json_decode->table30);
    $this->db->where('order_id',$order_id);
    $this->db->where('admin_id',$admin_id);
    $query=$this->db->get();
    // print_r($this->db->last_query());exit;
    $result=$query->num_rows();
    // print_r($result);exit;
    return $result;
  }
  public function getSubOrder($order_id,$admin_id)
  {
    $json_decode =json_decode(TABLES);
    $this->db->select('*');
    $this->db->from($json_decode->table30);
    $this->db->where('order_id',$order_id);
    $this->db->where('admin_id',$admin_id);
    $query=$this->db->get();
    // print_r($this->db->last_query());exit;
    $result=$query->result_array();
    // print_r($result);exit;
    return $result;
  }
  public function getCustId($order_id,$admin_id,$customer_mobile_no)
{

    $this->db->select('cus_id');
    $this->db->from(json_decode(TABLES)->table17);
    $this->db->where('order_id',$order_id);
    $this->db->where('admin_id',$admin_id);
    $this->db->where('customer_mobile_no',$customer_mobile_no);
    $query=$this->db->get();
    //print_r($this->db->last_query());exit;
    $result=$query->result_array();
    // print_r($result);exit;
    return $result[0]['cus_id'];
}
  public function updateSubOrderByWaiter($order_array,$order_id,$admin_id,$sub_order_id)
  {
    $this->db->where('order_id',$order_id);
    $this->db->where('sub_order_id',$sub_order_id);
    $this->db->where('admin_id',$admin_id);
    $this->db->update(json_decode(TABLES)->table30,$order_array);
    $result=$this->db->affected_rows(); 
    return $result ;
  }
  public function subOrderCreateSlip($arr,$order_id,$admin_id,$sub_order_id)
  {
    $this->db->where('order_id',$order_id);
    $this->db->where('sub_order_id',$sub_order_id);
    $this->db->where('admin_id',$admin_id);
    $this->db->update(json_decode(TABLES)->table30,$arr);
    $result=$this->db->affected_rows(); 
    return $result ;
  }
  function getGroupDataFromDateWise($admin_id,$start_date,$end_date)
    {
      $json_decode =json_decode(TABLES);
      $this->db->select('*');
      $this->db->from($json_decode->table17);
      $this->db->where('admin_id',$admin_id);
      $this->db->where('date BETWEEN "'.$start_date.'" AND "'.$end_date.'"');
      $this->db->group_by('order_id');
      $this->db->order_by('create_date',DESC);
      $query=$this->db->get();
      //print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;
    }

    public function complete_sub_order_by_chef($array,$admin_id,$sub_order_id,$order_id)
    {
      $this->db->where('admin_id',$admin_id);
      $this->db->where('sub_order_id',$sub_order_id);
      $this->db->where('order_id',$order_id);
      $this->db->update(json_decode(TABLES)->table30,$array);
     // print_r($this->db->last_query());exit;
      $result=$this->db->affected_rows(); 
      return $result;
    }
    public function getOrderStatusByWaiter($order_id,$admin_id)
    {
      $this->db->select('status');
      $this->db->from(json_decode(TABLES)->table17);
      $this->db->where('order_id',$order_id);
      $this->db->where('admin_id',$admin_id);
      $query=$this->db->get();
      // print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result[0]['status'];
    }
    public function deletedSubOrder($order_id,$admin_id)
    {
      $array=array(
                  'status'=>'0',
                  'order_status'=>'Rejected',
                  'modified_date'=>date('Y-m-d H:i:s')
                    );
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->update(json_decode(TABLES)->table30,$array);
      $result=$this->db->affected_rows(); 
      return $result;
    }
  public function getSubOrderDetails($order_id,$admin_id)
  {
    $this->db->select('*');
    $this->db->from(json_decode(TABLES)->table30);
    $this->db->where('order_id',$order_id);
    $this->db->where('admin_id',$admin_id);
    $this->db->where('order_status','Pending');
    $query=$this->db->get();
    $result=$query->result_array();
    return $result; 

  }
  public function confirmSubOrderBywaiter($order_id,$admin_id)
  {
    $array=array(
                  'status'=>'2',
                  'order_status'=>'Confirm',
                  'modified_date'=>date('Y-m-d H:i:s')
                    );
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->where('order_status','Pending');
      $this->db->update(json_decode(TABLES)->table30,$array);
      $result=$this->db->affected_rows(); 
      return $result;
  }
  public function getOrderByChef($order_id,$admin_id)
  {
    $this->db->select('*');
    $this->db->from(json_decode(TABLES)->table30);
    $this->db->where('order_id',$order_id);
    $this->db->where('admin_id',$admin_id);
    $this->db->where('order_status','Prepare');
    $query=$this->db->get();
    //print_r($this->db->last_query());exit;
    $result=$query->result_array();
    return $result;
  }
    public function getSubOrderChef($order_id,$admin_id,$order_status)
  {
    $this->db->select('*');
    $this->db->from(json_decode(TABLES)->table30);
    $this->db->where('order_id',$order_id);
    $this->db->where('admin_id',$admin_id);
    $this->db->where('order_status',$order_status);
    $query=$this->db->get();
    $result=$query->result_array();
    return $result;
  }
  public function readyToserveOrder($order_id,$admin_id)
  {
     $array=array(
                  'status'=>'5',
                  'order_status'=>'Ready to Serve',
                  'modified_date'=>date('Y-m-d H:i:s')
                    );
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->where('order_status','Prepare');
      $this->db->update(json_decode(TABLES)->table30,$array);
      $result=$this->db->affected_rows(); 
      return $result;
  }
  public function  prepareAllOrder($order_id,$admin_id,$order_status)
  {
     $array=array(
                  'status'=>'3',
                  'order_status'=>'Prepare',
                  'slip_status'=>'1',
                  'modified_date'=>date('Y-m-d H:i:s')
                    );
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->where('order_status',$order_status);
      $this->db->update(json_decode(TABLES)->table30,$array);
      $result=$this->db->affected_rows(); 
      return $result;
  }
public function completAllSubOrder($order_id,$admin_id,$order_status,$waiter_mobile_no)
{
      $array=array(
                  'status'=>'4',
                  'order_status'=>'Complete',
                  'order_complete_by'=>$waiter_mobile_no,
                  'modified_date'=>date('Y-m-d H:i:s')
                    );
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->where('order_status !=',$order_status);
      $this->db->update(json_decode(TABLES)->table30,$array);

      $result=$this->db->affected_rows(); 
      return $result;
}
public function completAllOrder($order_id,$admin_id,$order_status,$waiter_mobile_no)
{
      $array=array(
                  'status'=>'4',
                  'order_status'=>'Complete',
                  'order_complete_by'=>$waiter_mobile_no,
                  'modified_date'=>date('Y-m-d H:i:s')
                    );
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->where('order_status !=',$order_status);
      $this->db->update(json_decode(TABLES)->table17,$array);
      $result=$this->db->affected_rows(); 
      return $result;
}
public function getCompletOrder($order_id,$admin_id)
{
    $this->db->select('*');
    $this->db->from(json_decode(TABLES)->table30);
    $this->db->where('order_id',$order_id);
    $this->db->where('admin_id',$admin_id);
    $this->db->where('status IN (1,2,3)');
    $query=$this->db->get();
    $result=$query->result_array();
    return $result;
}
public function getOrderForCashier($order_id,$admin_id)
{
      $json_decode=json_decode(TABLES);
      $this->db->select('*');
      $this->db->from($json_decode->table17);
      $this->db->where('order_id',$order_id);
      $this->db->where('admin_id',$admin_id);
      $this->db->where('status','6');
      $query=$this->db->get();
      // print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;
}
public function getSubOrderForCashier($order_id)
{
      $json_decode=json_decode(TABLES);
      $this->db->select('*');
      $this->db->from($json_decode->table30);
      $this->db->where('order_id',$order_id);
      $this->db->where('status','6');
      $query=$this->db->get();
      // print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;
}
public function invoiceCreatedForOrders($order_id,$admin_id,$mobile_no)
{
  $array=array(
    'status'=>'6',
    'order_status'=>'INV CREATED',
    'modified_date'=>date('Y-m-d H:i:s'),
    'inv_created_by'=>$mobile_no
  );
  $this->db->where('order_id',$order_id);
  $this->db->where('admin_id',$admin_id);
  $this->db->update(json_decode(TABLES)->table17,$array);
  $result=$this->db->affected_rows(); 
  return $result;

}
public function invoiceCreatedForSubOrders($order_id,$admin_id,$mobile_no)
{
  $array=array('status'=>'6','order_status'=>'INV CREATED','modified_date'=>date('Y-m-d H:i:s'),'inv_created_by'=>$mobile_no);
  $this->db->where('order_id',$order_id);
  $this->db->where('admin_id',$admin_id);
  $this->db->where('status !=','0');
  $this->db->update(json_decode(TABLES)->table30,$array);
  $result=$this->db->affected_rows(); 
  return $result;

}
public function insertBatchOrder($insert_array)
{
  $this->db->insert_batch(json_decode(TABLES)->table31,$insert_array);
  $this->db->insert_id();
}
public function insertBatchSubOrder($insert_array)
{
  $this->db->insert_batch(json_decode(TABLES)->table32,$insert_array);
  $this->db->insert_id();
}
public function getMenuItemForOrder($order_id,$admin_id)
{

      $json_decode =json_decode(TABLES);
      $this->db->select('*');
      $this->db->from($json_decode->table31);
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      // $this->db->where('status','1');
      $query=$this->db->get();
      // print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;
}
public function getMenuItemForSubOrder($order_id,$admin_id,$sub_order_id)
{

      $json_decode =json_decode(TABLES);
      $this->db->select('*');
      $this->db->from($json_decode->table32);
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->where('sub_order_id',$sub_order_id);
      // $this->db->where('status','1');
      $query=$this->db->get();
      //print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;
}
public function getMenuItemForOrderInvoice($order_id,$admin_id)
{

      $json_decode =json_decode(TABLES);
      $this->db->select('*');
      $this->db->from($json_decode->table31);
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->where('status','1');
      $query=$this->db->get();
      //print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;
}
public function getMenuItemForSubOrderInvoice($order_id,$admin_id,$sub_order_id)
{

      $json_decode =json_decode(TABLES);
      $this->db->select('*');
      $this->db->from($json_decode->table32);
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->where('sub_order_id',$sub_order_id);
      $this->db->where('status','1');
      $query=$this->db->get();
      //print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;
}
public function deletedSubOrderWithMenu($order_id,$admin_id)
{
  $array=array('status'=>'0');
  $this->db->where('order_id',$order_id);
  $this->db->where('admin_id',$admin_id);
  $this->db->update(json_decode(TABLES)->table32,$array);
  $result=$this->db->affected_rows(); 
  return $result;
}
public function deletedOrderWithMenu($order_id,$admin_id)
{
  $array=array('status'=>'0');
  $this->db->where('order_id',$order_id);
  $this->db->where('admin_id',$admin_id);
  $this->db->update(json_decode(TABLES)->table31,$array);
  $result=$this->db->affected_rows(); 
  return $result;
}
public function deletedSubOrderWithMenu2($order_id,$admin_id,$sub_order_id)
{
  $array=array('status'=>'0');
  $this->db->where('order_id',$order_id);
  $this->db->where('admin_id',$admin_id);
  $this->db->where('sub_order_id',$sub_order_id);
  $this->db->update(json_decode(TABLES)->table32,$array);
  $result=$this->db->affected_rows(); 
  return $result;
}
public function cancelOrderItem($order_id,$admin_id,$item_name,$id)
{
  $array=array('status'=>'0');
  $this->db->where('order_id',$order_id);
  $this->db->where('admin_id',$admin_id);
  $this->db->where('id',$id);
  $this->db->update(json_decode(TABLES)->table31,$array);
  $result=$this->db->affected_rows(); 
  return $result;
}
public function cancelSubOrderItem($order_id,$admin_id,$item_name,$sub_order_id,$id)
{
  $array=array('status'=>'0');
  $this->db->where('order_id',$order_id);
  $this->db->where('sub_order_id',$sub_order_id);
  $this->db->where('admin_id',$admin_id);
  $this->db->where('id',$id);
  $this->db->update(json_decode(TABLES)->table32,$array);
  $result=$this->db->affected_rows(); 
  return $result;
}
public function getOrderPrice($order_id,$admin_id)
{
      $this->db->select('total_item,total_price,net_pay_amount,gst_amount,gst_amount_price');
      $this->db->from(json_decode(TABLES)->table17);
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $query=$this->db->get();
      //print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;
}
public function getOrderItemPrice($order_id,$admin_id,$id)
{
      $this->db->select('menu_price');
      $this->db->from(json_decode(TABLES)->table31);
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->where('id',$id);
      $this->db->where('status','0');
      $query=$this->db->get();
      //print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;
}
public function getItemMenuOrderDetails($order_id,$admin_id)
{
      $this->db->select('*');
      $this->db->from(json_decode(TABLES)->table31);
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->where('status','1');
      $query=$this->db->get();
      //print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;
}
public function updateMenuListDetails($updateArray,$order_id,$admin_id)
{
  $this->db->where('order_id',$order_id);
  $this->db->where('admin_id',$admin_id);
  $this->db->update(json_decode(TABLES)->table17,$updateArray);
  $result=$this->db->affected_rows(); 
  return $result;
}
public function getItemMenuSubOrderDetails($order_id,$admin_id,$sub_order_id)
{
      $this->db->select('*');
      $this->db->from(json_decode(TABLES)->table30);
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->where('sub_order_id',$sub_order_id);
      $this->db->where('status','1');
      $query=$this->db->get();
      //print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;
}
public function getSubOrderPrice($order_id,$admin_id,$sub_order_id)
{
      $this->db->select('total_item,total_price,net_pay_amount,gst_amount,gst_amount_price');
      $this->db->from(json_decode(TABLES)->table30);
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->where('sub_order_id',$sub_order_id);
      $query=$this->db->get();
      //print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;
}
public function getSubOrderItemPrice($order_id,$admin_id,$id,$sub_order_id)
{
      $this->db->select('menu_price');
      $this->db->from(json_decode(TABLES)->table32);
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->where('sub_order_id',$sub_order_id);
      $this->db->where('id',$id);
      $this->db->where('status','0');
      $query=$this->db->get();
      //print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;
}
public function updateMenuSubListDetails($updateArray,$order_id,$admin_id,$sub_order_id)
{
  $this->db->where('order_id',$order_id);
  $this->db->where('admin_id',$admin_id);
  $this->db->where('sub_order_id',$sub_order_id);
  $this->db->update(json_decode(TABLES)->table30,$updateArray);
  $result=$this->db->affected_rows(); 
  return $result;
}
public function getSubOrderTotalItemPrice($order_id,$admin_id,$sub_order_id)
{
      $this->db->select('SUM(menu_price) AS menu_price,SUM(quantity) AS quantity');
      $this->db->from(json_decode(TABLES)->table32);
      $this->db->where('admin_id',$admin_id);
      $this->db->where('order_id',$order_id);
      $this->db->where('sub_order_id',$sub_order_id);
      $this->db->where('status','0');
      $query=$this->db->get();
      //print_r($this->db->last_query());exit;
      $result=$query->result_array();
      return $result;
}
public function updateSubOrderAmount($subOrserArray,$order_id,$admin_id,$sub_order_id)
{
  $this->db->where('order_id',$order_id);
  $this->db->where('admin_id',$admin_id);
  $this->db->where('sub_order_id',$sub_order_id);
  $this->db->update(json_decode(TABLES)->table30,$subOrserArray);
  $result=$this->db->affected_rows(); 
  return $result;
}
}
?>