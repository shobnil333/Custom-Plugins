ALTER TABLE `question_master` ADD `followup` CHAR(1) NOT NULL AFTER `q_order`;
ALTER TABLE `question_answer_map_tbl` ADD `followup_qid` INT NOT NULL AFTER `aid`;
ALTER TABLE `user_answer_tbl` ADD `order_qid` INT NOT NULL AFTER `percentage`;

ALTER TABLE `question_master` ADD `weight` INT NOT NULL DEFAULT '1' AFTER `followup`;
