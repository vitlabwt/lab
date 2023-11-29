-- Create a database
CREATE DATABASE IF NOT EXISTS semester_results;

-- Use the created database
USE semester_results;

-- Create a table to store results
CREATE TABLE IF NOT EXISTS results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mse1 FLOAT,
    ese1 FLOAT,
    mse2 FLOAT,
    ese2 FLOAT,
    mse3 FLOAT,
    ese3 FLOAT,
    mse4 FLOAT,
    ese4 FLOAT
);
