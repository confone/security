CREATE TABLE {$dbName}.account_application
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	account_id INT(10) UNSIGNED,
	application_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX account_application_account_id_index ON {$dbName}.account_application (account_id);
CREATE INDEX account_application_application_id_index ON {$dbName}.account_application (application_id);


CREATE TABLE {$dbName}.publickey_application
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	public_key VARCHAR(41),
	application_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX publickey_application_public_key_index ON {$dbName}.publickey_application (public_key(40));
CREATE INDEX publickey_application_application_id_index ON {$dbName}.publickey_application (application_id);


CREATE TABLE {$dbName}.privatekey_application
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	private_key VARCHAR(41),
	application_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX privatekey_application_private_key_index ON {$dbName}.privatekey_application (private_key(40));
CREATE INDEX privatekey_application_application_id_index ON {$dbName}.privatekey_application (application_id);


INSERT INTO privatekey_application (private_key, application_id)
VALUES ('b1d6771652e4ed621de446b2c721d435', 1);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';