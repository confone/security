CREATE TABLE {$dbName}.rule_throttling
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(41),
	description VARCHAR(41),
	duration INT UNSIGNED,
	allowance INT UNSIGNED,
	wait_time INT UNSIGNED,
	create_time DATETIME,
	modified_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO rule_throttling (name, description, duration, allowance, wait_time, create_time, modified_time)
VALUES ('test-throttling', '', 10, 3, 10, NOW(), NOW());


CREATE TABLE {$dbName}.rule_cache_throttling
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	rule_id INT(10) UNSIGNED,
	subject VARCHAR(33),
	time INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX rule_cache_throttling_rule_id_index ON {$dbName}.rule_cache_throttling (rule_id);
CREATE INDEX rule_cache_throttling_subject_index ON {$dbName}.rule_cache_throttling (subject(32));
CREATE INDEX rule_cache_throttling_time_index ON {$dbName}.rule_cache_throttling (time);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';