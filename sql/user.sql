CREATE TABLE IF NOT EXISTS user(
userId int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
userName varchar(15) NOT NULL,
password varchar(250) NOT NULL,
isAdmin boolean DEFAULT FALSE,
disabled boolean DEFAULT FALSE.
);