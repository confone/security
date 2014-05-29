CREATE TABLE {$dbName}.application
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	name VARCHAR(128),
	description VARCHAR(256),
	public_key VARCHAR(41),
	private_key VARCHAR(41),
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX application_user_id_index ON {$dbName}.application (user_id);
CREATE INDEX application_public_key_index ON {$dbName}.application (public_key(40));
CREATE INDEX application_private_key_index ON {$dbName}.application (private_key(40));


CREATE TABLE {$dbName}.app_group
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	app_id INT(10) UNSIGNED,
	group_name VARCHAR(129),
	active VARCHAR(2),
	create_time DATETIME,
	modified_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX app_group_group_name_index ON {$dbName}.app_group (group_name(128));


CREATE TABLE {$dbName}.group_rules
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	app_id INT(10) UNSIGNED,
	group_id INT(10) UNSIGNED,
	rule_type VARCHAR(21),
	rule_id INT(10) UNSIGNED,
	rule_name VARCHAR(41),
	rule_order TINYINT UNSIGNED,
	active VARCHAR(2),
	create_time DATETIME,
	modified_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX group_rules_app_id_index ON {$dbName}.group_rules (app_id);
CREATE INDEX group_rules_group_id_index ON {$dbName}.group_rules (group_id);
CREATE INDEX group_rules_rule_order_index ON {$dbName}.group_rules (rule_order);
CREATE INDEX group_rules_rule_order_index ON {$dbName}.group_rules (rule_name(40));
CREATE INDEX group_rules_active_index ON {$dbName}.group_rules (active(1));


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';