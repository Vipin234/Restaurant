<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-06-18 07:20:14 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-18 07:21:04 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-18 07:23:10 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-18 07:23:47 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-18 10:27:22 --> Severity: error --> Exception: syntax error, unexpected 'else' (T_ELSE) C:\xampp\htdocs\Restaurant\application\controllers\Supervisor\Api.php 320
ERROR - 2021-06-18 15:07:52 --> Severity: error --> Exception: Too few arguments to function CI_DB_query_builder::join(), 1 passed in C:\xampp\htdocs\Restaurant\application\models\supervisor\Supervisor.php on line 1871 and at least 2 expected C:\xampp\htdocs\Restaurant\system\database\DB_query_builder.php 526
ERROR - 2021-06-18 15:09:26 --> Query error: Unknown column 'mp.city' in 'where clause' - Invalid query: SELECT `mc`.`city_prefix`, `ms`.`state_prefix`
FROM `master_city` AS `mc`
INNER JOIN `master_state` AS `ms` ON `ms`.`state_code`=`mc`.`state_code`
INNER JOIN `master_country` AS `mcc` ON `mcc`.`country_code`=`ms`.`country_code`
WHERE `mp`.`city` IS NULL
ERROR - 2021-06-18 15:09:39 --> Query error: Unknown column 'mc.city' in 'where clause' - Invalid query: SELECT `mc`.`city_prefix`, `ms`.`state_prefix`
FROM `master_city` AS `mc`
INNER JOIN `master_state` AS `ms` ON `ms`.`state_code`=`mc`.`state_code`
INNER JOIN `master_country` AS `mcc` ON `mcc`.`country_code`=`ms`.`country_code`
WHERE `mc`.`city` IS NULL
ERROR - 2021-06-18 14:20:58 --> Severity: 8192 --> __autoload() is deprecated, use spl_autoload_register() instead C:\xampp\htdocs\Restaurant\application\libraries\mailer\PHPMailer\PHPMailerAutoload.php 45
ERROR - 2021-06-18 14:21:09 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO), expecting function (T_FUNCTION) or const (T_CONST) C:\xampp\htdocs\Restaurant\application\controllers\Supervisor\Api.php 1356
ERROR - 2021-06-18 14:22:04 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO), expecting function (T_FUNCTION) or const (T_CONST) C:\xampp\htdocs\Restaurant\application\controllers\Supervisor\Api.php 1354
