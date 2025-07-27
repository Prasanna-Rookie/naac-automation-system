CREATE TABLE `naac`.`cri_6_write_up` 
( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`criteria` VARCHAR(25) NOT NULL , 
	`write_up` TEXT NOT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;


CREATE TABLE `naac`.`cri_6_1_2_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_2_1_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_2_2_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_choice` 
( 
	`choice_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`metric` VARCHAR(30) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`choice` VARCHAR(20) NOT NULL , 
	PRIMARY KEY (`choice_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_2_3_e_governance` 
( 
	`eg_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`area` VARCHAR(50) NOT NULL , 
	`imp_year` VARCHAR(50) NOT NULL , 
	`vendor_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`eg_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_2_3_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_5_1_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_5_2_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_5_3_initiatives` 
( 
	`qai_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`area` VARCHAR(500) NOT NULL , 
	`initiatives` VARCHAR(1000) NOT NULL,
	PRIMARY KEY (`qai_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_4_2_funds_non_government` 
( 
	`fng_id` INT NOT NULL AUTO_INCREMENT, 
	`academic_year` VARCHAR(20) NOT NULL, 
	`upload_by_id` INT NOT NULL,
	`upload_by_name` VARCHAR(255) NOT NULL,
	`agencies_name` VARCHAR(1000) NOT NULL, 
	`purpose` VARCHAR(1000) NOT NULL, 
	`funds` VARCHAR(500) NOT NULL, 
	`month` VARCHAR(500) NOT NULL,
	PRIMARY KEY (`fng_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_4_2_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_4_1_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_4_3_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_3_2_financial_support` 
( 
	`fng_id` INT NOT NULL AUTO_INCREMENT, 
	`academic_year` VARCHAR(20) NOT NULL, 
	`upload_by_id` INT NOT NULL,
	`upload_by_name` VARCHAR(255) NOT NULL,
	`teacher_name` VARCHAR(1000) NOT NULL, 
	`conference_name` VARCHAR(1000) NOT NULL, 
	`professional_body` VARCHAR(500) NOT NULL, 
	`amount` VARCHAR(500) NOT NULL,
	PRIMARY KEY (`fng_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_3_2_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_3_3_training_programmes` 
( 
	`tp_id` INT NOT NULL AUTO_INCREMENT, 
	`academic_year` VARCHAR(20) NOT NULL, 
	`upload_by_id` INT NOT NULL,
	`upload_by_name` VARCHAR(255) NOT NULL,
	`teaching_staff_title` VARCHAR(1000) NOT NULL, 
	`non_teaching_staff_title` VARCHAR(1000) NOT NULL, 
	`no_participants` VARCHAR(500) NOT NULL, 
	`from_date` VARCHAR(500) NOT NULL,
	`to_date` VARCHAR(500) NOT NULL,
	PRIMARY KEY (`tp_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_3_3_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_3_4_fdp` 
( 
	`fdp_id` INT NOT NULL AUTO_INCREMENT, 
	`academic_year` VARCHAR(20) NOT NULL, 
	`upload_by_id` INT NOT NULL,
	`upload_by_name` VARCHAR(255) NOT NULL,
	`teacher_name` VARCHAR(1000) NOT NULL, 
	`title` VARCHAR(1000) NOT NULL, 
	`from_date` VARCHAR(500) NOT NULL,
	`to_date` VARCHAR(500) NOT NULL,
	PRIMARY KEY (`fdp_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_3_4_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_3_1_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_6_5_3_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;
