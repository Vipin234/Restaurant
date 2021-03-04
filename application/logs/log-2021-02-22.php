<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-02-22 09:07:48 --> 404 Page Not Found: Supervisor/Api/get_order_detail_for_restaurant
ERROR - 2021-02-22 09:39:57 --> Severity: error --> Exception: syntax error, unexpected ''discount_by'' (T_CONSTANT_ENCAPSED_STRING), expecting ')' /var/www/html/Restaurant/application/controllers/Supervisor/Api.php 2817
ERROR - 2021-02-22 12:13:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''status'=>'7','order_closed_by'='' where order_id='' and admin_id='ADMIN_00001'' at line 1 - Invalid query: UPDATE tbl_order_detail_for_restaurant SET payment_status='1',payment_by='',get_payment='','status'=>'7','order_closed_by'='' where order_id='' and admin_id='ADMIN_00001' 
ERROR - 2021-02-22 12:13:38 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''status'=>'7','order_closed_by'='' where order_id='' and admin_id='ADMIN_00001'' at line 1 - Invalid query: UPDATE tbl_order_detail_for_restaurant SET payment_status='1',payment_by='',get_payment='','status'=>'7','order_closed_by'='' where order_id='' and admin_id='ADMIN_00001' 
ERROR - 2021-02-22 12:14:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''status'='7','order_closed_by'='' where order_id='' and admin_id='ADMIN_00001'' at line 1 - Invalid query: UPDATE tbl_order_detail_for_restaurant SET payment_status='1',payment_by='',get_payment='','status'='7','order_closed_by'='' where order_id='' and admin_id='ADMIN_00001' 
ERROR - 2021-02-22 12:16:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''status'='7','order_closed_by'='8755728373' where order_id='001' and admin_id='A' at line 1 - Invalid query: UPDATE tbl_order_detail_for_restaurant SET payment_status='1',payment_by='8755728373',get_payment='UPI','status'='7','order_closed_by'='8755728373' where order_id='001' and admin_id='ADMIN_00001' 
ERROR - 2021-02-22 13:15:01 --> Query error: Unknown column 'mobile_no' in 'field list' - Invalid query: UPDATE `tbl_sub_order_detail_for_restaurant` SET `order_status` = 'Rejected', `mobile_no` = NULL, `modified_date` = '2021-02-22', `status` = '0'
WHERE `order_id` = '004'
AND `sub_order_id` = '001'
AND `admin_id` = 'ADMIN_00001'
ERROR - 2021-02-22 13:17:19 --> Query error: Unknown column 'mobile_no' in 'field list' - Invalid query: UPDATE `tbl_sub_order_detail_for_restaurant` SET `order_status` = 'Rejected', `mobile_no` = '7906962739', `modified_date` = '2021-02-22', `status` = '0'
WHERE `order_id` = '004'
AND `sub_order_id` = '001'
AND `admin_id` = 'ADMIN_00001'
