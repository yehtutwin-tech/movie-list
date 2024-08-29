CREATE DATABASE `movie-list`;

CREATE TABLE `types` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `movies` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NOT NULL,
  `year` VARCHAR(10) DEFAULT NULL,
  `type_id` INT(11) NOT NULL,
  `poster` VARCHAR(255) DEFAULT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  ADD CONSTRAINT fk_type_id
  FOREIGN KEY (type_id) REFERENCES types(id)
  ON DELETE SET NULL
);

-- for those only want to
-- modify column nullable
-- add foreign key constraint
ALTER TABLE movies
MODIFY COLUMN type_id INT(11),
ADD CONSTRAINT fk_type_id
FOREIGN KEY(type_id) REFERENCES types(id)
ON DELETE SET NULL;
