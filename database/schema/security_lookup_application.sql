CREATE TABLE {$dbName}.lookup_user_application
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	app_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX user_application_user_id_index ON {$dbName}.lookup_user_application (user_id);
CREATE INDEX user_application_app_id_index ON {$dbName}.lookup_user_application (app_id);


CREATE TABLE {$dbName}.lookup_pubkey_application
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	pub_key VARCHAR(41),
	app_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX pubkey_application_pub_key_index ON {$dbName}.lookup_pubkey_application (pub_key(40));
CREATE INDEX pubkey_application_app_id_index ON {$dbName}.lookup_pubkey_application (app_id);


CREATE TABLE {$dbName}.lookup_prikey_application
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	pri_key VARCHAR(41),
	app_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX prikey_application_pri_key_index ON {$dbName}.lookup_prikey_application (pri_key(40));
CREATE INDEX prikey_application_app_id_index ON {$dbName}.lookup_prikey_application (app_id);


INSERT INTO lookup_prikey_application (pri_key, app_id)
VALUES ('b1d6771652e4ed621de446b2c721d435', 1);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';