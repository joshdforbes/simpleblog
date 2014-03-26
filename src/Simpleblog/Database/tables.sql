CREATE TABLE articles
(
  	id INT(10) NOT NULL auto_increment,
  	date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,                      
  	title VARCHAR(255) NOT NULL,                                                
  	content_preview TEXT NOT NULL,
    content TEXT NOT NULL,
  	PRIMARY KEY (id)
) ENGINE=INNODB;

CREATE TABLE users
(
	id INT(10) NOT NULL auto_increment,
	username VARCHAR(50) NOT NULL,
	hashedPassword VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	privledge VARCHAR(50) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=INNODB;


