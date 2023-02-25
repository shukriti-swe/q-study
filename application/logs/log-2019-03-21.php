<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-03-21 05:00:01 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')' at line 4 - Invalid query: SELECT `student`.`user_email` as `student_email`, `student`.`user_type` as `type`, `parent`.`user_email` as `parent_email`
FROM `tbl_useraccount` `student`
LEFT JOIN `tbl_useraccount` as `parent` ON `student`.`parent_id` = `parent`.`id`
WHERE `student`.`id` IN()
