CREATE TABLE {$dbName}.throttling
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	rule_id INT(10) UNSIGNED,
	subject VARCHAR(33),
	time INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX throttling_rule_id_index ON {$dbName}.throttling (rule_id);
CREATE INDEX throttling_subject_index ON {$dbName}.throttling (subject(32));
CREATE INDEX throttling_time_index ON {$dbName}.throttling (time);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';