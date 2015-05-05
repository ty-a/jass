CREATE TABLE logs (
LogID int AUTO_INCREMENT PRIMARY KEY, 
userID varchar(15) NOT NULL, 
action varchar(250) NOT NULL,
FOREIGN KEY (userID) REFERENCES user(userId)
);
