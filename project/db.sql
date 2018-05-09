DROP DATABASE finalproject;
CREATE database finalproject;
use finalproject;

CREATE TABLE users (
  `id` int AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `first_access` TIMESTAMP DEFAULT NOW(),
  `last_access` TIMESTAMP DEFAULT 0,
  `is_admin` BOOL DEFAULT 0,
  primary key(`id`)
  );
  
CREATE TABLE images (
  `image_id` int AUTO_INCREMENT,
  `user_id` int,
  `added` TIMESTAMP DEFAULT NOW(),
  `url` VARCHAR(1024),
  FOREIGN KEY (`user_id`) REFERENCES users(`id`),
  PRIMARY KEY(`image_id`),
  INDEX (`image_id`, `user_id`)
  );
  
CREATE TABLE images_tags (
  `image_id` int,
  `tag` VARCHAR(255),
  FOREIGN KEY (`image_id`) REFERENCES images(`image_id`)
  );
  
INSERT INTO users (username, password) VALUES ('sampleuser', '$2y$10$i4Lh8QIqYiYmm0SFSGmpW.UqTuv.N0aD3BzcL7rkNpqZzBscPSqyO');
INSERT INTO users (username, password, is_admin) VALUES ('sampleadmin', '$2y$10$EpNc4VHcUr3Saz0FDgYfZONW2CcVSlUWSE7P.fvO71BS26oOVjZzW', 1);
INSERT INTO images (user_id, url) VALUES (1, 'https://i.imgur.com/rMoibS7.jpg'), (1, 'https://i.redd.it/pak83csz0uw01.jpg'),
	(1, 'https://i.redd.it/oad5yq3qmuw01.jpg'), (1, 'https://i.redd.it/8o32rslbiuw01.jpg'), (1, 'https://i.redd.it/a5mn0an79rw01.jpg'),
	(1, 'https://i.redd.it/s4ftjf4n8pw01.jpg'), (1, 'https://i.redd.it/zflxsbam5ow01.jpg'), (1, 'https://i.redd.it/s3kbu6qq7pw01.jpg'),
	(1, 'https://i.redd.it/219hdw14pow01.jpg'), (1, 'https://i.redd.it/fdiysdx5xsw01.jpg'), (1, 'https://i.redd.it/7u7hni9pmuw01.jpg'),
	(1, 'https://i.redd.it/0pr6598nguw01.jpg'), (1, 'https://i.imgur.com/XLKa8ID.jpg'), (1, 'https://i.redd.it/is7yhd0g5uw01.jpg'),
	(1, 'https://i.imgur.com/fDbXApZ.jpg'), (1, 'https://i.redd.it/w60ac6465uw01.jpg'), (1, 'https://i.imgur.com/gQXPape.jpg'),
	(1, 'https://i.redd.it/zdfg2mkbsuw01.jpg'), (1, 'https://i.redd.it/pix05sj2iuw01.jpg'), (1, 'https://i.redd.it/xm1ut090rtw01.jpg')