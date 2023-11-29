CREATE DATABASE college_results;
USE college_results;

CREATE TABLE results (
  id INT AUTO_INCREMENT PRIMARY KEY,
  subject VARCHAR(255) NOT NULL,
  mse_marks INT NOT NULL,
  ese_marks INT NOT NULL
);

USE college_results;

ALTER TABLE results
ADD COLUMN total_marks INT;
