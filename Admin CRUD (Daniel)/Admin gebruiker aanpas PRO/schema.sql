CREATE TABLE highscores
(
  id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  real_name VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL,
  score DECIMAL(7, 2),
  high_sore DECIMAL(7, 2),
  email VARCHAR(100) NOT NULL
) ENGINE = InnoDB;