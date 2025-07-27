CREATE TABLE `naac`.`cri_3_write_up` 
( 
	`id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`criteria` VARCHAR(25) NOT NULL , 
	`write_up` TEXT NOT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_doc_upload` 
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

CREATE TABLE `naac`.`cri_3_1_2_seed_money` 
( 
	`sm_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`teacher_name` VARCHAR(50) NOT NULL , 
	`seed_money` VARCHAR(50) NOT NULL , 
	`month_year` VARCHAR(500) NOT NULL , 
	PRIMARY KEY (`sm_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_1_3_award_fellowship` 
( 
	`af_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`teacher_name` VARCHAR(50) NOT NULL , 
	`award_fellowship` VARCHAR(50) NOT NULL , 
	`month_year` VARCHAR(500) NOT NULL , 
	`award_agency` VARCHAR(500) NOT NULL ,
	PRIMARY KEY (`af_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_2_1_grants_received` 
( 
	`gr_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`principal_name` VARCHAR(500) NOT NULL , 
	`principal_dept` VARCHAR(500) NOT NULL , 
	`agency_name` VARCHAR(500) NOT NULL , 
	`type` VARCHAR(500) NOT NULL ,
	`fund` VARCHAR(500) NOT NULL ,
	`month_year` VARCHAR(500) NOT NULL ,
	`duration` VARCHAR(500) NOT NULL ,
	PRIMARY KEY (`gr_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_3_2_workshops_seminars` 
( 
	`ws_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`seminar_name` VARCHAR(500) NOT NULL , 
	`participants` VARCHAR(500) NOT NULL , 
	`from_date` DATE NOT NULL , 
	`to_date` DATE NOT NULL ,
	PRIMARY KEY (`ws_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_7_1_collaborating_agency` 
( 
	`ca_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`collaborating_agency` VARCHAR(1000) NOT NULL , 
	PRIMARY KEY (`ca_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_7_1_collaborating_agency_student` 
( 
	`cas_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`activity` VARCHAR(1000) NOT NULL , 
	`collaborating_agency` VARCHAR(1000) NOT NULL , 
	`participant` VARCHAR(1000) NOT NULL , 
	`duration` VARCHAR(1000) NOT NULL , 
	`activity_nature` VARCHAR(1000) NOT NULL , 
	PRIMARY KEY (`cas_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_7_2_mou_details` 
( 
	`md_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`name` VARCHAR(1000) NOT NULL , 
	`month_year` VARCHAR(1000) NOT NULL ,
	`duration` VARCHAR(1000) NOT NULL , 
	PRIMARY KEY (`md_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_7_2_mou_activities` 
( 
	`md_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`name` VARCHAR(1000) NOT NULL , 
	`activities` VARCHAR(1000) NOT NULL ,
	`no_of_students` VARCHAR(1000) NOT NULL , 
	PRIMARY KEY (`md_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_6_2_awards_received` 
( 
	`ar_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`stu_tea_name` VARCHAR(1000) NOT NULL , 
	`award_name` VARCHAR(1000) NOT NULL ,
	`award_body` VARCHAR(1000) NOT NULL , 
	`month_year` VARCHAR(1000) NOT NULL ,
	PRIMARY KEY (`ar_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_6_3_extension_activities` 
( 
	`ea_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`activity_name` VARCHAR(1000) NOT NULL , 
	`organising_unit` VARCHAR(1000) NOT NULL ,
	`scheme_name` VARCHAR(1000) NOT NULL , 
	`month_year` VARCHAR(1000) NOT NULL ,
	`no_of_students` VARCHAR(1000) NOT NULL ,
	PRIMARY KEY (`ea_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_choice` 
( 
	`choice_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`metric` VARCHAR(30) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL , 
	`choice` VARCHAR(20) NOT NULL , 
	PRIMARY KEY (`choice_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_2_4_2_teachers` 
( 
	`t_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`teacher_name` VARCHAR(1000) NOT NULL , 
	`qualification` VARCHAR(1000) NOT NULL ,
	`research_guide` VARCHAR(1000) NOT NULL , 
	`recognition_year` VARCHAR(1000) NOT NULL ,
	`still_serving` VARCHAR(1000) NOT NULL ,
	PRIMARY KEY (`t_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_4_2_scholar` 
( 
	`s_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`teacher_name` VARCHAR(1000) NOT NULL ,
	`scholar_name` VARCHAR(1000) NOT NULL , 
	`registration_year` VARCHAR(1000) NOT NULL ,
	`title` VARCHAR(1000) NOT NULL ,
	PRIMARY KEY (`s_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_4_3_research_paper` 
( 
	`rp_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`author_name` VARCHAR(1000) NOT NULL , 
	`department` VARCHAR(1000) NOT NULL ,
	`paper_title` VARCHAR(1000) NOT NULL , 
	`journal_name` VARCHAR(1000) NOT NULL ,
	`month_year` VARCHAR(1000) NOT NULL ,
	`issn` VARCHAR(1000) NOT NULL ,
	PRIMARY KEY (`rp_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_5_1_revenue_generated` 
( 
	`rg_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`consultants_name` VARCHAR(1000) NOT NULL , 
	`consultancy_project` VARCHAR(1000) NOT NULL ,
	`contact_details` VARCHAR(1000) NOT NULL , 
	`revenue_generated` VARCHAR(1000) NOT NULL ,
	PRIMARY KEY (`rg_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_5_2_revenue_generated` 
( 
	`rg_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`consultants_name` VARCHAR(1000) NOT NULL , 
	`title` VARCHAR(1000) NOT NULL ,
	`contact_details` VARCHAR(1000) NOT NULL , 
	`revenue_generated` VARCHAR(1000) NOT NULL ,
	`no_trainees` INT NOT NULL ,
	PRIMARY KEY (`rg_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_4_4_edited_books` 
( 
	`eb_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`teacher_name` VARCHAR(1000) NOT NULL , 
	`book_title` VARCHAR(1000) NOT NULL ,
	`chapter_title` VARCHAR(1000) NOT NULL , 
	`conference_title` VARCHAR(1000) NOT NULL ,
	`conference_name` VARCHAR(1000) NOT NULL ,
	`conference_type` VARCHAR(1000) NOT NULL ,
	`month_year` VARCHAR(1000) NOT NULL ,
	`isbn` VARCHAR(1000) NOT NULL ,
	`affiliating_institute` VARCHAR(1000) NOT NULL ,
	`publisher_name` VARCHAR(1000) NOT NULL ,
	PRIMARY KEY (`eb_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_4_5_citation_index` 
( 
	`ci_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`paper_title` VARCHAR(1000) NOT NULL , 
	`author_name` VARCHAR(1000) NOT NULL ,
	`journal_titile` VARCHAR(1000) NOT NULL , 
	`month_year` VARCHAR(1000) NOT NULL ,
	`citation_index` INT NOT NULL ,
	PRIMARY KEY (`ci_id`)
) ENGINE = InnoDB;

CREATE TABLE `naac`.`cri_3_4_6_h_index` 
( 
	`hi_id` INT NOT NULL AUTO_INCREMENT , 
	`academic_year` VARCHAR(20) NOT NULL , 
	`upload_by_id` INT NOT NULL , 
	`upload_by_name` VARCHAR(255) NOT NULL ,
	`paper_title` VARCHAR(1000) NOT NULL , 
	`author_name` VARCHAR(1000) NOT NULL ,
	`journal_titile` VARCHAR(1000) NOT NULL , 
	`month_year` VARCHAR(1000) NOT NULL ,
	`h_index` INT NOT NULL ,
	PRIMARY KEY (`hi_id`)
) ENGINE = InnoDB;