CREATE TABLE {$dbName}.throttling
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(41),
	description VARCHAR(41),
	duration INT UNSIGNED,
	allowance INT UNSIGNED,
	create_time DATETIME,
	modified_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO throttling (name, description, duration, allowance, create_time, modified_time)
VALUES ('test-throttling', '', 10, 3, NOW(), NOW());

GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';