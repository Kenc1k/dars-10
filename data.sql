create database students_db;

use students_db;

create Table students(
    id INT PRIMARY KEY auto_increment,
    familiya VARCHAR(200),
    ism VARCHAR(200),
    manzil VARCHAR(150),
    image VARCHAR(255)
);
