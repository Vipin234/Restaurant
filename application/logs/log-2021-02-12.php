<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-02-12 10:27:05 --> 404 Page Not Found: Customer/Api
ERROR - 2021-02-12 10:42:40 --> Query error: Unknown column 'sub_order_id' in 'where clause' - Invalid query: SELECT `quantity`, `half_and_full_status`, `menu_price`, `id`
FROM `master_item`
WHERE `order_id` IS NULL
AND `sub_order_id` IS NULL
AND `admin_id` IS NULL
