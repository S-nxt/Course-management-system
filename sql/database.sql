CREATE DATABASE course_management;

USE course_management;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(50) NOT NULL,
  role VARCHAR(20) NOT NULL
);

INSERT INTO users (username, password, role)
SELECT 'admin', 'admin123', 'admin'
WHERE NOT EXISTS (
  SELECT 1 FROM users WHERE username = 'admin'
);

INSERT INTO users (username, password, role)
SELECT 'user', 'user123', 'user'
WHERE NOT EXISTS (
  SELECT 1 FROM users WHERE username = 'user'
);

CREATE TABLE IF NOT EXISTS courses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  course_name VARCHAR(50) NOT NULL,
  course_code VARCHAR(20) NOT NULL,
  description TEXT,
  credits INT NOT NULL
);