<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-05-10 01:15:44 --> Query error: Unknown column 'email' in 'where clause' - Invalid query: SELECT *
FROM `master_user`
WHERE `mobile_no` = '9956853945'
OR `email` = 'kvipin496@gmail.com'
ERROR - 2021-05-10 01:16:44 --> Query error: Unknown column 'creation_date' in 'field list' - Invalid query: INSERT INTO `master_user` (`user_id`, `user_fullname`, `mobile_no`, `salt`, `user_password`, `status`, `user_email`, `user_role`, `user_type`, `creation_date`) VALUES ('ADMIN1', 'vipin', '9956853945', 'e21dfbb31b2cce7b859fd410e050f5d4', 'z/ftjeA23FSrCnYMDVe6jSe/6we7lA4MQv498JTyxKfpNiidBzeIxE85kQOXo/gk0U0FLhRofbmlpJJpAwgjEw==', 1, 'kvipin496@gmail.com', '1', 'Super Admin', '2021-05-10 01:16:44')
ERROR - 2021-05-10 01:18:04 --> 404 Page Not Found: Images/favicon.ico
ERROR - 2021-05-10 01:18:16 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 61
ERROR - 2021-05-10 01:18:16 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 62
ERROR - 2021-05-10 01:18:16 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 63
ERROR - 2021-05-10 01:18:16 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 64
ERROR - 2021-05-10 01:18:16 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 65
ERROR - 2021-05-10 01:18:16 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 66
ERROR - 2021-05-10 01:18:16 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/Restaurant/system/core/Exceptions.php:271) /var/www/html/Restaurant/system/core/Common.php 570
ERROR - 2021-05-10 01:20:19 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 61
ERROR - 2021-05-10 01:20:19 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 62
ERROR - 2021-05-10 01:20:19 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 63
ERROR - 2021-05-10 01:20:19 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 64
ERROR - 2021-05-10 01:20:19 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 65
ERROR - 2021-05-10 01:20:19 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 66
ERROR - 2021-05-10 01:20:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/Restaurant/system/core/Exceptions.php:271) /var/www/html/Restaurant/system/core/Common.php 570
ERROR - 2021-05-10 01:20:47 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 61
ERROR - 2021-05-10 01:20:47 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 62
ERROR - 2021-05-10 01:20:47 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 63
ERROR - 2021-05-10 01:20:47 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 64
ERROR - 2021-05-10 01:20:47 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 65
ERROR - 2021-05-10 01:20:47 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 66
ERROR - 2021-05-10 01:20:47 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /var/www/html/Restaurant/system/core/Exceptions.php:271) /var/www/html/Restaurant/system/core/Common.php 570
ERROR - 2021-05-10 11:52:03 --> Query error: Column 'message' cannot be null - Invalid query: INSERT INTO `cust_feedback` (`admin_id`, `order_id`, `menu_id`, `rating`, `message`, `creation_date`, `status`) VALUES ('ADMIN_00001', 'ADMIN00001-0016', 'MENU_000015', '3.0', NULL, '2021-05-10', 1)
ERROR - 2021-05-10 11:52:30 --> Query error: Column 'message' cannot be null - Invalid query: INSERT INTO `cust_feedback` (`admin_id`, `order_id`, `menu_id`, `rating`, `message`, `creation_date`, `status`) VALUES ('ADMIN_00001', 'ADMIN00001-0016', 'MENU_000015', '3.0', NULL, '2021-05-10', 1)
ERROR - 2021-05-10 11:53:01 --> Query error: Column 'message' cannot be null - Invalid query: INSERT INTO `cust_feedback` (`admin_id`, `order_id`, `menu_id`, `rating`, `message`, `creation_date`, `status`) VALUES ('ADMIN_00001', 'ADMIN00001-0016', 'MENU_000015', '3.0', NULL, '2021-05-10', 1)
ERROR - 2021-05-10 01:24:25 --> Severity: Notice --> Undefined offset: 0 /var/www/html/Restaurant/application/controllers/api/Login.php 64
ERROR - 2021-05-10 01:25:40 --> 404 Page Not Found: Admin/images
ERROR - 2021-05-10 01:28:36 --> Query error: Duplicate entry 'ADMIN_000018' for key 'admin_id' - Invalid query: INSERT INTO `spots` (`admin_id`, `city`, `name`, `image`, `gst_no`, `pan_no`, `lat`, `lng`, `location`, `cuisines`, `openingTime`, `closingTime`, `phone`, `address`, `amenities`, `create_date`, `status`) VALUES ('ADMIN_000018', 'uuu', 'test', 'resto_162062811620210510.jpeg', 'dfsdf', 'asas', '', '', 'Bareilly', 'Indian,American,British,Caribbean', '11:57 AM', '11:58 AM', '9058720196', 'Bareilly', 'Playground', '2021-05-10 01:28:36', 1)
ERROR - 2021-05-10 12:00:15 --> Query error: Column 'message' cannot be null - Invalid query: INSERT INTO `cust_feedback` (`admin_id`, `order_id`, `menu_id`, `rating`, `message`, `creation_date`, `status`) VALUES ('ADMIN_00001', 'ADMIN00001-0016', 'MENU_00005', '3.5', NULL, '2021-05-10', 1)
ERROR - 2021-05-10 12:02:34 --> Query error: Column 'message' cannot be null - Invalid query: INSERT INTO `cust_feedback` (`admin_id`, `order_id`, `menu_id`, `rating`, `message`, `creation_date`, `status`) VALUES ('ADMIN_00001', 'ADMIN00001-0016', 'MENU_00005', '3.5', NULL, '2021-05-10', 1)
ERROR - 2021-05-10 01:34:42 --> 404 Page Not Found: Admin/images
ERROR - 2021-05-10 12:05:03 --> Query error: Column 'message' cannot be null - Invalid query: INSERT INTO `cust_feedback` (`admin_id`, `order_id`, `menu_id`, `rating`, `message`, `creation_date`, `status`) VALUES ('ADMIN_00001', 'ADMIN00001-0016', 'MENU_00009', '4.0', NULL, '2021-05-10', 1)
ERROR - 2021-05-10 12:05:35 --> Query error: Column 'message' cannot be null - Invalid query: INSERT INTO `cust_feedback` (`admin_id`, `order_id`, `menu_id`, `rating`, `message`, `creation_date`, `status`) VALUES ('ADMIN_00001', 'ADMIN00001-0016', 'MENU_00009', '4.0', NULL, '2021-05-10', 1)
ERROR - 2021-05-10 12:07:47 --> Query error: Column 'message' cannot be null - Invalid query: INSERT INTO `cust_feedback` (`admin_id`, `order_id`, `menu_id`, `rating`, `message`, `creation_date`, `status`) VALUES ('ADMIN_00001', 'ADMIN00001-0016', 'MENU_00009', '4.0', NULL, '2021-05-10', 1)
ERROR - 2021-05-10 01:49:19 --> 404 Page Not Found: Admin/images
ERROR - 2021-05-10 01:50:28 --> 404 Page Not Found: Admin/images
ERROR - 2021-05-10 01:50:34 --> 404 Page Not Found: Admin/images
ERROR - 2021-05-10 01:54:29 --> 404 Page Not Found: Admin/images
ERROR - 2021-05-10 01:56:09 --> 404 Page Not Found: Admin/images
ERROR - 2021-05-10 02:21:05 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:21:08 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:21:12 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:21:17 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:21:24 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:21:25 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:21:27 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:21:32 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:21:37 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:21:45 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:21:47 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:21:52 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:21:57 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:22:05 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:22:07 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:22:12 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:22:17 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:22:25 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:22:27 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:22:32 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:22:37 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:22:45 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:22:47 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:23:05 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:23:20 --> Severity: error --> Exception: syntax error, unexpected '$subOrderMenuIds' (T_VARIABLE) /var/www/html/Restaurant/application/controllers/customer/Api.php 2675
ERROR - 2021-05-10 02:47:57 --> Severity: error --> Exception: syntax error, unexpected '++' (T_INC), expecting variable (T_VARIABLE) or '{' or '$' /var/www/html/Restaurant/application/controllers/customer/Api.php 2698
ERROR - 2021-05-10 13:29:41 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')' at line 3 - Invalid query: UPDATE `master_item` SET `is_reviewed` = 0
WHERE `order_id` = 'ADMIN00001-0018'
AND `menu_id` IN ()
ERROR - 2021-05-10 13:29:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')' at line 3 - Invalid query: UPDATE `master_item` SET `is_reviewed` = 0
WHERE `order_id` = 'ADMIN00001-0018'
AND `menu_id` IN ()
ERROR - 2021-05-10 04:24:05 --> 404 Page Not Found: Images/favicon.ico
ERROR - 2021-05-10 04:44:16 --> 404 Page Not Found: Admin/images
ERROR - 2021-05-10 04:47:20 --> 404 Page Not Found: Admin/images
ERROR - 2021-05-10 04:48:18 --> 404 Page Not Found: Admin/images
ERROR - 2021-05-10 04:58:29 --> Severity: error --> Exception: Call to undefined method Login_model::getDataMasterUser() /var/www/html/Restaurant/application/controllers/api/Login.php 97
ERROR - 2021-05-10 04:58:38 --> Severity: error --> Exception: Call to undefined method Login_model::getDataMasterUser() /var/www/html/Restaurant/application/controllers/api/Login.php 97
ERROR - 2021-05-10 04:59:48 --> Severity: error --> Exception: Call to undefined method Login_model::getDataMasterUser() /var/www/html/Restaurant/application/controllers/api/Login.php 97
ERROR - 2021-05-10 05:00:24 --> Severity: Notice --> Undefined variable: username /var/www/html/Restaurant/application/models/Login_model.php 135
ERROR - 2021-05-10 05:00:24 --> Severity: Notice --> Undefined variable: username /var/www/html/Restaurant/application/models/Login_model.php 136
ERROR - 2021-05-10 05:34:35 --> 404 Page Not Found: Admin/editRestaurant
ERROR - 2021-05-10 05:35:55 --> 404 Page Not Found: Admin/editRestaurant
ERROR - 2021-05-10 05:36:47 --> 404 Page Not Found: Admin/editRestaurant
ERROR - 2021-05-10 05:42:59 --> Severity: error --> Exception: syntax error, unexpected 'else' (T_ELSE) /var/www/html/Restaurant/application/controllers/Admin.php 215
ERROR - 2021-05-10 05:43:40 --> Severity: error --> Exception: syntax error, unexpected 'private' (T_PRIVATE), expecting end of file /var/www/html/Restaurant/application/controllers/Admin.php 228
ERROR - 2021-05-10 05:59:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.`closingTime`, `s`.`amenities`, `s`.`cuisines`
FROM `spots` AS `s`
JOIN `tbl_ad' at line 1 - Invalid query: SELECT `a`.`name`, `a`.`restaurant_name`, `a`.`mobile_no`, `a`.`user_email`, `a`.`user_password`, `a`.`salt`, `s`.`gst_no`, `s`.`pan_no`, `s`.`address`, `s`.`city`, `s`.`openingTime`.`s`.`closingTime`, `s`.`amenities`, `s`.`cuisines`
FROM `spots` AS `s`
JOIN `tbl_admin` AS `a` ON `a`.`admin_id`=`s`.`admin_id`
WHERE `s`.`status` = 1
AND `s`.`admin_id` = 'ADMIN_00001'
ERROR - 2021-05-10 05:59:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.`closingTime`, `s`.`amenities`, `s`.`cuisines`
FROM `spots` AS `s`
JOIN `tbl_ad' at line 1 - Invalid query: SELECT `a`.`name`, `a`.`restaurant_name`, `a`.`mobile_no`, `a`.`user_email`, `a`.`user_password`, `a`.`salt`, `s`.`gst_no`, `s`.`pan_no`, `s`.`address`, `s`.`city`, `s`.`openingTime`.`s`.`closingTime`, `s`.`amenities`, `s`.`cuisines`
FROM `spots` AS `s`
JOIN `tbl_admin` AS `a` ON `a`.`admin_id`=`s`.`admin_id`
WHERE `s`.`status` = 1
AND `s`.`admin_id` = 'ADMIN_00001'
ERROR - 2021-05-10 07:01:51 --> Severity: Notice --> Undefined index: natcasesort(array)me /var/www/html/Restaurant/application/controllers/api/Login.php 168
ERROR - 2021-05-10 07:03:47 --> Severity: Notice --> Undefined index: natcasesort(array)me /var/www/html/Restaurant/application/controllers/api/Login.php 168
ERROR - 2021-05-10 07:45:59 --> 404 Page Not Found: Admin/images
ERROR - 2021-05-10 07:51:40 --> 404 Page Not Found: Admin/images
ERROR - 2021-05-10 07:56:30 --> Severity: Notice --> Undefined index: admin_id /var/www/html/Restaurant/application/controllers/Admin.php 211
ERROR - 2021-05-10 07:56:30 --> Severity: Notice --> Undefined variable: result /var/www/html/Restaurant/application/controllers/Admin.php 244
ERROR - 2021-05-10 07:56:30 --> Severity: Notice --> Undefined index: admin_id /var/www/html/Restaurant/application/controllers/Admin.php 211
ERROR - 2021-05-10 07:56:30 --> Severity: Notice --> Undefined variable: result /var/www/html/Restaurant/application/controllers/Admin.php 244
ERROR - 2021-05-10 07:56:31 --> Severity: Notice --> Undefined index: admin_id /var/www/html/Restaurant/application/controllers/Admin.php 211
ERROR - 2021-05-10 07:56:31 --> Severity: Notice --> Undefined variable: result /var/www/html/Restaurant/application/controllers/Admin.php 244
ERROR - 2021-05-10 07:56:40 --> Severity: Notice --> Undefined index: admin_id /var/www/html/Restaurant/application/controllers/Admin.php 211
ERROR - 2021-05-10 07:56:40 --> Severity: Notice --> Undefined variable: result /var/www/html/Restaurant/application/controllers/Admin.php 244
ERROR - 2021-05-10 22:56:53 --> 404 Page Not Found: Admin/images
ERROR - 2021-05-10 22:57:01 --> Severity: Notice --> Undefined index: admin_id /var/www/html/Restaurant/application/controllers/Admin.php 211
ERROR - 2021-05-10 22:57:01 --> Severity: Notice --> Undefined variable: result /var/www/html/Restaurant/application/controllers/Admin.php 244
