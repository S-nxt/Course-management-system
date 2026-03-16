CREATE DATABASE course_management;

USE course_management;

CREATE TABLE IF NOT EXISTS courses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  course_name VARCHAR(50) NOT NULL,
  course_code VARCHAR(20) NOT NULL,
  description TEXT,
  credits INT NOT NULL
);