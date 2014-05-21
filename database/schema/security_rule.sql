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

CREATE INDEX rule_throttling_name_index ON {$dbName}.rule_throttling (name(40));


CREATE TABLE {$dbName}.rule_cache_throttling
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	rule_id INT(10) UNSIGNED,
	subject VARCHAR(41),
	time INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX rule_cache_throttling_rule_id_index ON {$dbName}.rule_cache_throttling (rule_id);
CREATE INDEX rule_cache_throttling_subject_index ON {$dbName}.rule_cache_throttling (subject(40));
CREATE INDEX rule_cache_throttling_time_index ON {$dbName}.rule_cache_throttling (time);


CREATE TABLE {$dbName}.rule_blacklist
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(41),
	description VARCHAR(41),
	create_time DATETIME,
	modified_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX rule_blacklist_name_index ON {$dbName}.rule_blacklist (name(40));


CREATE TABLE {$dbName}.rule_cache_blacklist
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	rule_id INT(10) UNSIGNED,
	subject VARCHAR(41),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX rule_cache_blacklist_rule_id_index ON {$dbName}.rule_cache_blacklist (rule_id);
CREATE INDEX rule_cache_blacklist_subject_index ON {$dbName}.rule_cache_blacklist (subject(40));


CREATE TABLE {$dbName}.rule_whitelist
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(41),
	description VARCHAR(41),
	create_time DATETIME,
	modified_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX rule_whitelist_name_index ON {$dbName}.rule_whitelist (name(40));


CREATE TABLE {$dbName}.rule_cache_whitelist
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	rule_id INT(10) UNSIGNED,
	subject VARCHAR(41),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX rule_cache_whitelist_rule_id_index ON {$dbName}.rule_cache_whitelist (rule_id);
CREATE INDEX rule_cache_whitelist_subject_index ON {$dbName}.rule_cache_whitelist (subject(40));


CREATE TABLE {$dbName}.rule_token
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(41),
	description VARCHAR(41),
	create_time DATETIME,
	modified_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX rule_token_name_index ON {$dbName}.rule_token (name(40));


CREATE TABLE {$dbName}.rule_cache_token
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	rule_id INT(10) UNSIGNED,
	token VARCHAR(41),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX rule_cache_token_rule_id_index ON {$dbName}.rule_cache_token (rule_id);
CREATE INDEX rule_cache_token_subject_index ON {$dbName}.rule_cache_token (token(40));


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';