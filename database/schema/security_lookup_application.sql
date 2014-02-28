CREATE TABLE {$dbName}.account_application
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	account_id INT(10) UNSIGNED,
	application_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_account_application_account_id_index ON {$dbName}.account_application (account_id);
CREATE INDEX {$dbName}_account_application_application_id_index ON {$dbName}.account_application (application_id);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';