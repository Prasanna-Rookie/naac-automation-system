CREATE TABLE `naac`.`cri_5_1_1_scholarships` 
( 
	`s_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`scheme_name` VARCHAR(1000) NOT NULL , 
	`no_students` INT NOT NULL , 
	`amount` DOUBLE NOT NULL ,
	`type` VARCHAR(500) NOT NULL ,
	`agency_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`s_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_5_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`criteria` VARCHAR(25) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_5_choice` 
( 
	`choice_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`metric` VARCHAR(30) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`choice` VARCHAR(20) NOT NULL , 
	PRIMARY KEY (`choice_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_5_1_3_capacity_development` 
( 
	`cd_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`type` VARCHAR(1000) NOT NULL ,
	`scheme_name` VARCHAR(1000) NOT NULL , 
	`imp_year` VARCHAR(1000) NOT NULL , 
	`no_students` INT NOT NULL ,
	`agency_name` VARCHAR(500) NOT NULL ,
	PRIMARY KEY (`cd_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_5_1_5_students_benefitted` 
( 
	`sb_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`type` VARCHAR(1000) NOT NULL ,
	`activity_name` VARCHAR(1000) NOT NULL , 
	`student_participated` INT NOT NULL , 
	PRIMARY KEY (`sb_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_5_1_5_placement` 
( 
	`p_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`student_name` VARCHAR(1000) NOT NULL ,
	`programme` VARCHAR(1000) NOT NULL , 
	`employer_name` VARCHAR(1000) NOT NULL ,
	`package` DOUBLE NOT NULL ,
	PRIMARY KEY (`p_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_5_2_2_higher_education` 
( 
	`he_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`student_name` VARCHAR(1000) NOT NULL ,
	`programme` VARCHAR(1000) NOT NULL , 
	`institution_joined` VARCHAR(1000) NOT NULL ,
	`programme_admitted` DOUBLE NOT NULL ,
	PRIMARY KEY (`he_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_5_3_1_awards_medals` 
( 
	`am_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`awards_name` VARCHAR(1000) NOT NULL ,
	`team_individual` VARCHAR(1000) NOT NULL , 
	`student_name` VARCHAR(1000) NOT NULL ,
	`level` VARCHAR(1000) NOT NULL ,
	`event_name` VARCHAR(1000) NOT NULL ,
	`month_year` VARCHAR(1000) NOT NULL ,
	PRIMARY KEY (`am_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_5_3_3_events` 
( 
	`e_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`event_name` VARCHAR(1000) NOT NULL ,
	`event_date` VARCHAR(1000) NOT NULL ,
	PRIMARY KEY (`e_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_5_2_3_examinations` 
( 
	`e_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`roll_no` VARCHAR(1000) NOT NULL ,
	`selected_appeared` VARCHAR(1000) NOT NULL ,
	`exam_type` VARCHAR(1000) NOT NULL ,
	PRIMARY KEY (`e_id`)
) ENGINE = InnoDB;