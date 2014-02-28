CREATE TABLE {$dbName}.application
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	account_id INT(10) UNSIGNED,
	name VARCHAR(128),
	description VARCHAR(256),
	public_key VARCHAR(41),
	private_key VARCHAR(41),
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_application_account_id_index ON {$dbName}.application (account_id);
CREATE INDEX {$dbName}_application_public_key_index ON {$dbName}.application (public_key(40));
CREATE INDEX {$dbName}_application_private_key_index ON {$dbName}.application (private_key(40));


CREATE TABLE {$dbName}.rules
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	application_id INT(10) UNSIGNED,
	rule_type TINYINT UNSIGNED,
	rule_id INT(10) UNSIGNED,
	rule_order TINYINT UNSIGNED,
	active VARCHAR(2),
	create_time DATETIME,
	modified_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_rules_account_id_index ON {$dbName}.rules (application_id);
CREATE INDEX {$dbName}_rules_rule_order_index ON {$dbName}.rules (rule_order);
CREATE INDEX {$dbName}_rules_active_index ON {$dbName}.rules (active(1));


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';