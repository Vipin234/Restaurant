<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-04-13 11:08:55 --> Query error: Column 'waiter_mobile_no' cannot be null - Invalid query: INSERT INTO `tbl_order_detail_for_restaurant` (`admin_id`, `waiter_mobile_no`, `confirm_order_by`, `customer_mobile_no`, `table_no`, `menu_item_name`, `quantity`, `half_and_full_status`, `menu_price`, `total_item`, `total_price`, `gst_amount`, `gst_amount_price`, `net_pay_amount`, `order_status`, `create_date`, `date`, `status`) VALUES ('ADMIN_00002', NULL, NULL, '9956853945', '90', 'Test', '1', 'F', '100', '1', '100', '00', '00', '00', 'Pending', '2021-04-13 11:08:55', '2021-04-13', '2')
ERROR - 2021-04-13 11:09:45 --> Query error: Duplicate entry '' for key 'order_id' - Invalid query: INSERT INTO `tbl_order_detail_for_restaurant` (`admin_id`, `waiter_mobile_no`, `confirm_order_by`, `customer_mobile_no`, `table_no`, `menu_item_name`, `quantity`, `half_and_full_status`, `menu_price`, `total_item`, `total_price`, `gst_amount`, `gst_amount_price`, `net_pay_amount`, `order_status`, `create_date`, `date`, `status`) VALUES ('ADMIN_00001', '9717103636', '9717103636', '9956853945', '94', 'Test', '1', 'F', '100', '1', '100', '00', '00', '00', 'Pending', '2021-04-13 11:09:45', '2021-04-13', '2')
ERROR - 2021-04-13 11:20:49 --> Query error: Duplicate entry 'ADMIN000010102' for key 'order_id' - Invalid query: UPDATE tbl_order_detail_for_restaurant SET order_id='ADMIN000010102' where id='3'
ERROR - 2021-04-13 11:21:18 --> Query error: Duplicate entry 'ADMIN000010102' for key 'order_id' - Invalid query: UPDATE tbl_order_detail_for_restaurant SET order_id='ADMIN000010102' where id='4'
ERROR - 2021-04-13 05:57:14 --> Query error: Unknown column 'admin_id' in 'where clause' - Invalid query: SELECT `name`, `mobile_no`, `email_id`
FROM `tbl_registration_customer`
WHERE `admin_id` IS NULL
AND `status` = '1'
ERROR - 2021-04-13 05:57:52 --> Query error: Unknown column 'admin_id' in 'where clause' - Invalid query: SELECT `name`, `mobile_no`, `email_id`
FROM `tbl_registration_customer`
WHERE `admin_id` IS NULL
AND `status` = '1'
ERROR - 2021-04-13 05:58:30 --> Query error: Unknown column 'status' in 'where clause' - Invalid query: SELECT `name`, `mobile_no`, `email_id`
FROM `tbl_registration_customer`
WHERE `mobile_no` = '9956853945'
AND `status` = '1'
