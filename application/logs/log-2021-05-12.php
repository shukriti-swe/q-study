<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-05-12 05:02:34 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 E:\xampp\htdocs\qstudy\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2021-05-12 05:02:34 --> Unable to connect to the database
ERROR - 2021-05-12 05:02:38 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 E:\xampp\htdocs\qstudy\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2021-05-12 05:02:38 --> Unable to connect to the database
ERROR - 2021-05-12 05:02:38 --> Query error: No connection could be made because the target machine actively refused it.
 - Invalid query: SELECT *
FROM `tbl_useraccount`
LEFT JOIN `tbl_country` ON `tbl_useraccount`.`country_id` = `tbl_country`.`id`
LEFT JOIN `zone` ON UPPER(tbl_country.countryCode) = zone.country_code
LEFT JOIN `additional_tutor_info` ON `tbl_useraccount`.`id` = `additional_tutor_info`.`tutor_id`
WHERE `tbl_useraccount`.`id` IS NULL
ERROR - 2021-05-12 05:02:38 --> Severity: error --> Exception: Call to a member function result_array() on boolean E:\xampp\htdocs\qstudy\application\models\Tutor_model.php 97
ERROR - 2021-05-12 05:04:00 --> 404 Page Not Found: Faviconico/index
ERROR - 2021-05-12 14:03:10 --> 404 Page Not Found: Faviconico/index
ERROR - 2021-05-12 14:03:23 --> 404 Page Not Found: Assets/images
ERROR - 2021-05-12 14:03:23 --> 404 Page Not Found: Assets/images
ERROR - 2021-05-12 14:03:23 --> 404 Page Not Found: Assets/images
ERROR - 2021-05-12 14:03:23 --> 404 Page Not Found: Assets/images
