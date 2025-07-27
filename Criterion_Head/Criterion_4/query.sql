CREATE TABLE `naac`.`cri_4_2_2_doc_upload` 
( 
	`doc_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`description` VARCHAR(100) NOT NULL , 
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`doc_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_4_1_3_classrooms_seminarhalls` 
( 
	`class_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`department` VARCHAR(255) NOT NULL , 
	`room_no` VARCHAR(500) NOT NULL , 
	`ict_type` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`class_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_4_1_4_infrastructure_expenditure` 
( 
	`exp_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`budget_allocated` FLOAT NOT NULL , 
	`expenditure` FLOAT NOT NULL , 
	`tot_expenditure` FLOAT NOT NULL ,
	`maintenace_aca_fac` FLOAT NOT NULL ,
	`maintenance_phy_fac` FLOAT NOT NULL ,
	`doc_name` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`exp_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_4_2_2_options` 
( 
	`option_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`option` VARCHAR(255) NOT NULL ,  
	PRIMARY KEY (`option_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_4_3_4_options` 
( 
	`option_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`option` VARCHAR(255) NOT NULL ,  
	PRIMARY KEY (`option_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_4_3_2_computer_ratio` 
( 
	`com_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`department` VARCHAR(255) NOT NULL ,
	`computer_count` INT NOT NULL ,
	PRIMARY KEY (`com_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_4_2_4_library_usage` 
( 
	`user_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`method` INT NOT NULL ,
	`e_access` INT NOT NULL ,
	`teacher` INT NOT NULL ,
	`student` INT NOT NULL ,
	PRIMARY KEY (`user_id`)
) ENGINE = InnoDB;


$error_message = mysqli_error($con);
echo "$error_message";