CREATE TABLE IF NOT EXISTS votes(
	submissionId int NOT NULL,
	userId int NOT NULL,
	vote int NOT NULL,
	PRIMARY KEY(submissionId, userId),
	FOREIGN KEY (userId) REFERENCES user(userId),
	FOREIGN KEY (submissionId) REFERENCES submissions(submissionId)
);