CREATE TABLE IF NOT EXISTS user(
	userId int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	userName varchar(15) NOT NULL,
	password varchar(250) NOT NULL,
	isAdmin boolean DEFAULT FALSE,
	disabled boolean DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS submissions(
	submissionId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title varchar(15) NOT NULL,
	content varchar(300) NOT NULL,
	userId int NOT NULL,
	submissionDate date NOT NULL,
	FOREIGN KEY (userId) REFERENCES user(userId)
);

CREATE TABLE IF NOT EXISTS votes(
	submissionId int NOT NULL,
	userId int NOT NULL,
	vote int NOT NULL,
	PRIMARY KEY(submissionId, userId),
	FOREIGN KEY (userId) REFERENCES user(userId),
	FOREIGN KEY (submissionId) REFERENCES submissions(submissionId) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS logs (
	LogID int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	userID int NOT NULL, 
	action varchar(250) NOT NULL,
	FOREIGN KEY (userID) REFERENCES user(userId)
);
