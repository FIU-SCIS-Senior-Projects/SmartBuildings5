DROP TABLE IF EXISTS roles;
CREATE TABLE roles
(
	id INT UNSIGNED PRIMARY KEY,
	role_name VARCHAR(30) NOT NULL
);

DROP TABLE IF EXISTS account_status;
CREATE TABLE account_status
(
	id INT UNSIGNED PRIMARY KEY,
	status VARCHAR(30) NOT NULL
);

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	role_id INT UNSIGNED,
	account_status_id INT UNSIGNED,
        first_name VARCHAR(50),
        last_name VARCHAR(50),
        password VARCHAR(255),   
	email VARCHAR(50),
	company VARCHAR(50), 
	position VARCHAR(50),
	company_url	VARCHAR(50),
	profile_image VARCHAR(255),
        created DATETIME DEFAULT NULL,
        modified DATETIME DEFAULT NULL,
	FOREIGN KEY (role_id) REFERENCES roles(id),
	FOREIGN KEY (account_status_id) REFERENCES account_status(id)
);

DROP TABLE IF EXISTS building_conditions;
CREATE TABLE building_conditions
(
	id INT UNSIGNED PRIMARY KEY,
	condition_name VARCHAR(30),
	color VARCHAR(30)
);

DROP TABLE IF EXISTS reports;
CREATE TABLE reports (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT UNSIGNED,
	building_condition_id INT UNSIGNED,	
	electricity tinyint(1) DEFAULT 0,
	water tinyint(1) DEFAULT 0,
	road_block tinyint(1) DEFAULT 0,
	telecommunication tinyint(1) DEFAULT 0,
	comments VARCHAR(255),
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (building_condition_id) REFERENCES building_conditions(id)
);

DROP TABLE IF EXISTS report_images;
CREATE TABLE report_images
(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	report_id INT UNSIGNED,
	report_image VARCHAR(255),
	FOREIGN KEY (report_id) REFERENCES reports(id)
);

DROP TABLE IF EXISTS map_markers;
CREATE TABLE map_markers
(
	id INT UNSIGNED PRIMARY KEY,
	latitude FLOAT( 10, 6 ) NOT NULL ,
	longitude FLOAT( 10, 6 ) NOT NULL,
	FOREIGN KEY (id) REFERENCES reports(id)
);

INSERT INTO `roles`(`id`, `role_name`) VALUES (1,"Mapper"),(2,"Evaluator"),(3,"Admin");
INSERT INTO `account_status`(`id`, `status`) VALUES (1,"Active"),(2,"Pending"),(3,"Inactive");
INSERT INTO `building_conditions`(`id`, `condition_name`,`color`) VALUES (1,"Safe","green"),(2,"Partly Damaged","yellow"),(3,"Poor","red");