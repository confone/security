CREATE TABLE {$dbName}.rule_type
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	type TINYINT UNSIGNED,
	language VARCHAR(3),
	description VARCHAR(41),
	group VARCHAR(21),
	active VARCHAR(2),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_rule_type_type_index ON {$dbName}.rule_type (type);
CREATE INDEX {$dbName}_rule_type_language_index ON {$dbName}.rule_type (language(2));
CREATE INDEX {$dbName}_rule_type_active_index ON {$dbName}.rule_type (active(1));


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';