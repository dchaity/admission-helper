-- =====================================================
--  University Admission Helper — Schema for
--  if0_41164503_admission_helper
-- =====================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `users` (
  `id`             INT AUTO_INCREMENT PRIMARY KEY,
  `name`           VARCHAR(100) NOT NULL,
  `email`          VARCHAR(150) UNIQUE NOT NULL,
  `phone`          VARCHAR(20)  DEFAULT NULL,
  `password`       VARCHAR(255) NOT NULL,
  `ssc_gpa`        DECIMAL(3,2) DEFAULT 0.00,
  `hsc_gpa`        DECIMAL(3,2) DEFAULT 0.00,
  `academic_group` ENUM('science','commerce','arts') DEFAULT 'science',
  `user_type`      ENUM('student','admin') DEFAULT 'student',
  `ip_address`     VARCHAR(45)  DEFAULT NULL,
  `created_at`     TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `universities` (
  `id`               INT AUTO_INCREMENT PRIMARY KEY,
  `name`             VARCHAR(200) NOT NULL,
  `type`             ENUM('public','private') NOT NULL,
  `city`             VARCHAR(100) DEFAULT NULL,
  `division`         VARCHAR(100) DEFAULT NULL,
  `established_year` INT DEFAULT NULL,
  `ranking`          INT DEFAULT 999,
  `programs`         INT DEFAULT 0,
  `description`      TEXT,
  `min_ssc_gpa`      DECIMAL(3,2) DEFAULT 0.00,
  `min_hsc_gpa`      DECIMAL(3,2) DEFAULT 0.00,
  `required_group`   VARCHAR(50)  DEFAULT NULL,
  `apply_url`        VARCHAR(255) DEFAULT NULL,
  `created_at`       TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `scholarships` (
  `id`            INT AUTO_INCREMENT PRIMARY KEY,
  `name`          VARCHAR(200) NOT NULL,
  `university_id` INT NOT NULL,
  `amount`        DECIMAL(10,2) DEFAULT 0.00,
  `description`   TEXT,
  `deadline`      DATE DEFAULT NULL,
  `created_at`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`university_id`) REFERENCES `universities`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `bookmarks` (
  `id`            INT AUTO_INCREMENT PRIMARY KEY,
  `user_id`       INT NOT NULL,
  `university_id` INT NOT NULL,
  `created_at`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`)       REFERENCES `users`(`id`)        ON DELETE CASCADE,
  FOREIGN KEY (`university_id`) REFERENCES `universities`(`id`) ON DELETE CASCADE,
  UNIQUE KEY `unique_bookmark` (`user_id`,`university_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `scholarship_applications` (
  `id`             INT AUTO_INCREMENT PRIMARY KEY,
  `user_id`        INT NOT NULL,
  `scholarship_id` INT NOT NULL,
  `applied_at`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`)        REFERENCES `users`(`id`)        ON DELETE CASCADE,
  FOREIGN KEY (`scholarship_id`) REFERENCES `scholarships`(`id`) ON DELETE CASCADE,
  UNIQUE KEY `unique_application` (`user_id`,`scholarship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------- Sample Data ----------------
INSERT INTO `universities`
 (`name`,`type`,`city`,`division`,`established_year`,`ranking`,`programs`,`description`,`min_ssc_gpa`,`min_hsc_gpa`,`required_group`,`apply_url`)
VALUES
('University of Dhaka','public','Dhaka','Dhaka',1921,1,80,'Oldest and most prestigious university in Bangladesh.',3.00,3.00,'science','https://du.ac.bd'),
('Bangladesh University of Engineering and Technology','public','Dhaka','Dhaka',1962,2,40,'Top engineering university of Bangladesh.',4.00,4.00,'science','https://buet.ac.bd'),
('University of Chittagong','public','Chittagong','Chittagong',1966,3,60,'One of the largest public universities in Bangladesh.',3.00,3.00,NULL,'https://cu.ac.bd'),
('Rajshahi University','public','Rajshahi','Rajshahi',1953,4,55,'Second oldest university in Bangladesh.',3.00,3.00,NULL,'https://ru.ac.bd'),
('North South University','private','Dhaka','Dhaka',1992,10,30,'Top private university in Bangladesh.',2.50,2.50,NULL,'https://northsouth.edu'),
('BRAC University','private','Dhaka','Dhaka',2001,12,25,'Leading private university known for liberal arts.',2.50,2.50,NULL,'https://bracu.ac.bd'),
('American International University-Bangladesh','private','Dhaka','Dhaka',1994,15,28,'Popular private university.',2.50,2.50,NULL,'https://aiub.edu'),
('Khulna University','public','Khulna','Khulna',1991,8,35,'Public university in southern Bangladesh.',3.00,3.00,NULL,'https://ku.ac.bd');

INSERT INTO `scholarships` (`name`,`university_id`,`amount`,`description`,`deadline`) VALUES
('Merit Scholarship 2025',1,50000,'For top 10 students with excellent academic results.','2025-06-30'),
('Engineering Excellence Award',2,75000,'For meritorious engineering students.','2025-07-15'),
('Financial Aid Program',5,40000,'Need-based scholarship for deserving students.','2025-08-01'),
('Women in STEM Scholarship',6,60000,'Encouraging female students in STEM fields.','2025-07-30'),
('Sports Excellence Scholarship',3,30000,'For students with outstanding sports achievements.','2025-09-01');