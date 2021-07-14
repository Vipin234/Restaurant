<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-06-15 07:15:40 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 10:45:41 --> Query error: Unknown column 'rs.user_type' in 'field list' - Invalid query: SELECT `mlu`.`notification_id`, `rsr`.`mobile_no`, `rs`.`user_type`
FROM `tbl_manage_login_user` AS `mlu`
INNER JOIN `tbl_restaurant_staff_registration` AS `rsr` ON `rsr`.`mobile_no`=`mlu`.`mobile_no`
WHERE `rsr`.`status` = 1
AND `rsr`.`admin_id` = 'ADMIN_00001'
AND `mlu`.`active_status` = 1
AND `rsr`.`user_type` IN('Waiter','Supervisor')
ERROR - 2021-06-15 07:16:39 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 07:17:01 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 07:17:51 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 07:25:46 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 07:31:41 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 07:31:56 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 07:34:36 --> Severity: Compile Error --> Illegal offset type C:\xampp\htdocs\Restaurant\application\controllers\customer\Api.php 457
ERROR - 2021-06-15 07:34:59 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 07:35:23 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 07:38:05 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 07:41:55 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 07:42:12 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 07:42:53 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 07:43:01 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 08:21:48 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 11:51:49 --> Severity: error --> Exception: Too few arguments to function Customer::check_status_for_notification(), 2 passed in C:\xampp\htdocs\Restaurant\application\controllers\customer\Api.php on line 1988 and exactly 3 expected C:\xampp\htdocs\Restaurant\application\models\customer\Customer.php 484
ERROR - 2021-06-15 08:48:48 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 11:03:15 --> Severity: error --> Exception: syntax error, unexpected '$array_merge_recursive' (T_VARIABLE) C:\xampp\htdocs\Restaurant\application\controllers\Supervisor\Api.php 2198
ERROR - 2021-06-15 15:01:04 --> Query error: Column 'staff_mobile_no' cannot be null - Invalid query: INSERT INTO `tbl_notification_by_staff` (`send_from`, `staff_mobile_no`, `admin_id`, `status`, `order_id`, `table_no`, `title`, `message`, `customer_mobile_no`, `date_time`) VALUES ('8510808187', NULL, 'ADMIN_00001', 1, 'ADMIN00001-0001', '1', 'Order completed', 'Table No 1 Order Id 2021-06-15-0001 has been completed', '9956853945', '2021-06-15 15:01:04')
ERROR - 2021-06-15 11:50:27 --> Severity: error --> Exception: syntax error, unexpected '}' C:\xampp\htdocs\Restaurant\application\controllers\Supervisor\Api.php 3271
ERROR - 2021-06-15 11:50:38 --> Severity: error --> Exception: syntax error, unexpected '}' C:\xampp\htdocs\Restaurant\application\controllers\Supervisor\Api.php 3271
ERROR - 2021-06-15 11:50:54 --> Severity: error --> Exception: syntax error, unexpected '}' C:\xampp\htdocs\Restaurant\application\controllers\Supervisor\Api.php 3271
ERROR - 2021-06-15 11:51:08 --> Severity: error --> Exception: syntax error, unexpected '}' C:\xampp\htdocs\Restaurant\application\controllers\Supervisor\Api.php 3271
ERROR - 2021-06-15 11:52:45 --> Severity: error --> Exception: syntax error, unexpected '}' C:\xampp\htdocs\Restaurant\application\controllers\Supervisor\Api.php 3270
ERROR - 2021-06-15 11:53:45 --> Severity: error --> Exception: syntax error, unexpected '}' C:\xampp\htdocs\Restaurant\application\controllers\Supervisor\Api.php 3270
ERROR - 2021-06-15 15:41:38 --> Query error: Column 'title' cannot be null - Invalid query: INSERT INTO `tbl_notification_by_staff` (`send_from`, `staff_mobile_no`, `admin_id`, `status`, `order_id`, `table_no`, `title`, `message`, `customer_mobile_no`, `date_time`) VALUES ('9799572870', '8510808187', 'ADMIN_00001', 1, 'ADMIN00001-0001', '1', NULL, NULL, '9956853945', '2021-06-15 15:41:38')
ERROR - 2021-06-15 12:24:48 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 12:25:26 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 12:28:09 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 12:31:34 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 12:52:48 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 13:16:22 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-15 16:47:01 --> Query error: Column 'waiter_mobile_no' cannot be null - Invalid query: INSERT INTO `tbl_order_detail_for_restaurant` (`admin_id`, `waiter_mobile_no`, `confirm_order_by`, `customer_mobile_no`, `table_no`, `menu_item_name`, `quantity`, `half_and_full_status`, `menu_price`, `total_item`, `total_price`, `gst_amount`, `gst_amount_price`, `net_pay_amount`, `order_status`, `create_date`, `date`, `status`) VALUES ('ADMIN_00001', NULL, NULL, '9956853945', '14', 'SDS', 'ada', 'S', '10', '1', '100', '2', '23', '100', 'Pending', '2021-06-15 16:47:01', '2021-06-15', '2')
