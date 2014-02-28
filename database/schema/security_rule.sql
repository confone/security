CREATE TABLE {$dbName}.throttling
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(41),
	description VARCHAR(41),
	interval INT UNSIGNED,
	allowance INT UNSIGNED,
	create_time DATETIME,
	modified_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';