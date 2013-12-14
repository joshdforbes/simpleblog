CREATE TABLE articles
(
  	id INT(10) NOT NULL auto_increment,
  	author_id INT(10) NOT NULL,
  	date DATE NOT NULL,                       
  	title VARCHAR(255) NOT NULL,                                                
  	content TEXT NOT NULL,                       

  	PRIMARY KEY (id),
  	FOREIGN KEY (author_id)
  		REFERENCES authors(id)
  		ON DELETE CASCADE
) ENGINE=INNODB;

CREATE TABLE authors
(
	id INT(10) NOT NULL auto_increment,
	NAME varchar(100) NOT NULL,

	PRIMARY KEY  (id)
) ENGINE=INNODB;
