<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-02-02 10:33:57 --> Query error: Duplicate entry 'ORD_00001' for key 'order_id' - Invalid query: INSERT INTO `tbl_order_detail_for_restaurant` (`order_id`, `admin_id`, `cus_id`, `table_no`, `menu_item_name`, `quantity`, `half_and_full_status`, `menu_price`, `total_item`, `total_price`, `gst_amount`, `gst_amount_price`, `net_pay_amount`, `order_status`, `customer_mobile_no`, `create_date`, `date`, `status`) VALUES ('ORD_00001', 'ADMIN_00001', NULL, '02', 'Kari Chawal,', '1,', 'F,null', '200,', '1', '200', '5', '10.0', '210.0', 'Pending', '9956853945', '2021-02-02 10:33:57', '2021-02-02 10:33:57', '1')
ERROR - 2021-02-02 06:06:48 --> Severity: error --> Exception: Function name must be a string /var/www/html/Restaurant/application/models/customer/Customer.php 29
ERROR - 2021-02-02 16:57:15 --> Query error: Column 'cus_id' cannot be null - Invalid query: INSERT INTO `tbl_sub_order_detail_for_restaurant` (`order_id`, `admin_id`, `sub_order_id`, `cus_id`, `table_no`, `menu_item_name`, `quantity`, `half_and_full_status`, `menu_price`, `total_item`, `total_price`, `gst_amount`, `gst_amount_price`, `net_pay_amount`, `order_status`, `customer_mobile_no`, `create_date`, `date`, `status`) VALUES ('ORD_00002', 'ADMIN_00001', 'SUB_ORDER_1', NULL, '01', 'Kari Chawal,', '1,', 'F,null', '200,', '1', '200', '5', '10.0', '210.0', 'Pending', '9956853945', '2021-02-02 16:57:15', '2021-02-02 16:57:15', '1')
ERROR - 2021-02-02 17:59:30 --> Query error: Unknown column 'sub_order_id' in 'field list' - Invalid query: INSERT INTO `tbl_order_detail_for_restaurant` (`order_id`, `admin_id`, `sub_order_id`, `cus_id`, `table_no`, `menu_item_name`, `quantity`, `half_and_full_status`, `menu_price`, `total_item`, `total_price`, `gst_amount`, `gst_amount_price`, `net_pay_amount`, `order_status`, `customer_mobile_no`, `create_date`, `date`, `status`) VALUES ('001', 'ADMIN_00001', '001', 'CUS_00003', '01', 'Rice with chicken,', '1,', 'H,null', '100,', '1', '100', '5', '5.0', '105.0', 'Pending', '9956853945', '2021-02-02 17:59:30', '2021-02-02 17:59:30', '1')
ERROR - 2021-02-02 12:40:26 --> Query error: Column 'cus_id' cannot be null - Invalid query: INSERT INTO `tbl_sub_order_detail_for_restaurant` (`order_id`, `admin_id`, `sub_order_id`, `cus_id`, `waiter_mobile_no`, `customer_mobile_no`, `table_no`, `menu_item_name`, `quantity`, `half_and_full_status`, `menu_price`, `total_item`, `total_price`, `gst_amount`, `gst_amount_price`, `net_pay_amount`, `order_status`, `create_date`, `date`, `status`) VALUES ('2021-02-02-001', 'ADMIN_00001', '001', NULL, '8510808187', '9956853945', '01', 'Kari Chawal,', '1,', 'FF,null', '200,', '1', '200', '5', '10.0', '210.0', 'Pending', '2021-02-02 12:40:26', '2021-02-02', '1')
ERROR - 2021-02-02 12:45:56 --> Query error: Column 'cus_id' cannot be null - Invalid query: INSERT INTO `tbl_sub_order_detail_for_restaurant` (`order_id`, `admin_id`, `sub_order_id`, `cus_id`, `waiter_mobile_no`, `customer_mobile_no`, `table_no`, `menu_item_name`, `quantity`, `half_and_full_status`, `menu_price`, `total_item`, `total_price`, `gst_amount`, `gst_amount_price`, `net_pay_amount`, `order_status`, `create_date`, `date`, `status`) VALUES ('2021-02-02-002', 'ADMIN_00001', '001', NULL, '8510808187', '9956853945', '02', 'Kari Chawal,', '1,', 'FF,null', '200,', '1', '200', '5', '10.0', '210.0', 'Pending', '2021-02-02 12:45:56', '2021-02-02', '1')
ERROR - 2021-02-02 12:45:56 --> Query error: Column 'cus_id' cannot be null - Invalid query: INSERT INTO `tbl_sub_order_detail_for_restaurant` (`order_id`, `admin_id`, `sub_order_id`, `cus_id`, `waiter_mobile_no`, `customer_mobile_no`, `table_no`, `menu_item_name`, `quantity`, `half_and_full_status`, `menu_price`, `total_item`, `total_price`, `gst_amount`, `gst_amount_price`, `net_pay_amount`, `order_status`, `create_date`, `date`, `status`) VALUES ('2021-02-02-002', 'ADMIN_00001', '001', NULL, '8510808187', '9956853945', '02', 'Kari Chawal,Kari Chawal,', '1,1,', 'FF,FF,null', '200,200,', '1', '200', '5', '10.0', '210.0', 'Pending', '2021-02-02 12:45:56', '2021-02-02', '1')
ERROR - 2021-02-02 12:45:57 --> Query error: Column 'cus_id' cannot be null - Invalid query: INSERT INTO `tbl_sub_order_detail_for_restaurant` (`order_id`, `admin_id`, `sub_order_id`, `cus_id`, `waiter_mobile_no`, `customer_mobile_no`, `table_no`, `menu_item_name`, `quantity`, `half_and_full_status`, `menu_price`, `total_item`, `total_price`, `gst_amount`, `gst_amount_price`, `net_pay_amount`, `order_status`, `create_date`, `date`, `status`) VALUES ('2021-02-02-002', 'ADMIN_00001', '001', NULL, '8510808187', '9956853945', '02', 'Kari Chawal,Kari Chawal,Kari Chawal,', '1,1,1,', 'FF,FF,FF,null', '200,200,200,', '1', '200', '5', '10.0', '210.0', 'Pending', '2021-02-02 12:45:57', '2021-02-02', '1')
ERROR - 2021-02-02 12:55:50 --> Query error: Column 'cus_id' cannot be null - Invalid query: INSERT INTO `tbl_sub_order_detail_for_restaurant` (`order_id`, `admin_id`, `sub_order_id`, `cus_id`, `waiter_mobile_no`, `customer_mobile_no`, `table_no`, `menu_item_name`, `quantity`, `half_and_full_status`, `menu_price`, `total_item`, `total_price`, `gst_amount`, `gst_amount_price`, `net_pay_amount`, `order_status`, `create_date`, `date`, `status`) VALUES ('2021-02-02-001', 'ADMIN_00001', '001', NULL, '8510808187', '9956853945', '01', 'Kari Chawal,', '1,', 'FF,null', '200,', '1', '200', '5', '10.0', '210.0', 'Pending', '2021-02-02 12:55:50', '2021-02-02', '1')
ERROR - 2021-02-02 12:58:04 --> Query error: Column 'cus_id' cannot be null - Invalid query: INSERT INTO `tbl_sub_order_detail_for_restaurant` (`order_id`, `admin_id`, `sub_order_id`, `cus_id`, `waiter_mobile_no`, `customer_mobile_no`, `table_no`, `menu_item_name`, `quantity`, `half_and_full_status`, `menu_price`, `total_item`, `total_price`, `gst_amount`, `gst_amount_price`, `net_pay_amount`, `order_status`, `create_date`, `date`, `status`) VALUES ('2021-02-02-001', 'ADMIN_00001', '001', NULL, '8510808187', '9956853945', '01', 'Kari Chawal,', '1,', 'FF,null', '200,', '1', '200', '5', '10.0', '210.0', 'Pending', '2021-02-02 12:58:04', '2021-02-02', '1')
ERROR - 2021-02-02 13:03:38 --> Query error: Column 'cus_id' cannot be null - Invalid query: INSERT INTO `tbl_sub_order_detail_for_restaurant` (`order_id`, `admin_id`, `sub_order_id`, `cus_id`, `waiter_mobile_no`, `customer_mobile_no`, `table_no`, `menu_item_name`, `quantity`, `half_and_full_status`, `menu_price`, `total_item`, `total_price`, `gst_amount`, `gst_amount_price`, `net_pay_amount`, `order_status`, `create_date`, `date`, `status`) VALUES ('2021-02-02-001', 'ADMIN_00001', '001', NULL, '8510808187', '9956853945', '01', 'Kari Chawal,', '1,', 'FF,null', '200,', '1', '200', '5', '10.0', '210.0', 'Pending', '2021-02-02 13:03:38', '2021-02-02', '1')