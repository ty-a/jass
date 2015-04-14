CREATE TABLE IF NOT EXISTS submissions(
	submissionId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title varchar(15) NOT NULL,
	content varchar(300) NOT NULL,
	userId int NOT NULL,
	submissionDate date NOT NULL,
	FOREIGN KEY (userId) REFERENCES user(userId)
);