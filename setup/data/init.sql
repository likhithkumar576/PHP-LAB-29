USE database;

CREATE TABLE authors (
    email VARCHAR(128) NOT NULL PRIMARY KEY,
    hash_password VARCHAR(255) NOT NULL,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    biography TEXT NOT NULL,
    create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO authors (email, hash_password, first_name, last_name, biography) VALUES ("likhithlikki08@gmail.com", "$2y$10$YR7/pHUdX.lJA/qsHNWuEOGn7PbjkBw8iiVxZKs/9CFeKSFHSO6PK", "likhith", "kumar", "student");
CREATE TABLE posts(
    slug VARCHAR(128) NOT NULL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    author VARCHAR(128) NOT NULL,
    post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (author),
    FOREIGN KEY (author)
    REFERENCES authors (email)
);
INSERT INTO `posts` (`slug`,`title`,`content`,`author`) VALUES("post-a","Post A","<article><h2Post A<h2><section><p>This is a sample article</p></section></article>","likhithlikki08@gmail.com");

INSERT INTO `posts` (`slug`,`title`,`content`,`author`) VALUES("mypost-1","Post 1","<article><h2Post 1<h2><section><p>This is a sample article of post1</p></section></article>","likhithlikki08@gmail.com");

INSERT INTO `posts` (`slug`,`title`,`content`,`author`) VALUES("mypost-2","Post 2","<article><h2Post 2<h2><section><p>This is a sample article of post2</p></section></article>","likhithlikki08@gmail.com");
