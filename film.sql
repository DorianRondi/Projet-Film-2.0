DROP DATABASE film;
CREATE DATABASE IF NOT EXISTS film;
USE film;

CREATE TABLE IF NOT EXISTS `user` (
    `userID` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `userFirst` VARCHAR(50) NOT NULL,
    `userLast`VARCHAR(50) NOT NULL,
    `userAdmin` BOOLEAN NOT NULL,
    `userLogin` VARCHAR(255) NOT NULL,
    `userPass`VARCHAR(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS `actor` (
    `actorID` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `actorFirst` VARCHAR(50) NOT NULL,
    `actorLast`VARCHAR(50) NOT NULL
);
CREATE TABLE IF NOT EXISTS `realisator` (
    `realisatorID` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `realisatorFirst` VARCHAR(50) NOT NULL,
    `realisatorLast` VARCHAR(50) NOT NULL
);
CREATE TABLE IF NOT EXISTS `genre` (
    `genreID`VARCHAR(50) PRIMARY KEY NOT NULL
);
CREATE TABLE IF NOT EXISTS `film` (
    `filmID` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `titre` VARCHAR(50) NOT NULL,
    `sortie` DATE,
    `genre` VARCHAR(50),
    `duree` TIME,
    `affiche` VARCHAR(255),
    CONSTRAINT genreOFthefilm
        FOREIGN KEY (genre) REFERENCES genre(genreID)
);
CREATE TABLE IF NOT EXISTS `realsOFfilm` (
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `film_id` INT NOT NULL,
    `real_id` INT NOT NULL,
    CONSTRAINT realOFthefilm
        FOREIGN KEY (film_id) REFERENCES film(filmID),
        FOREIGN KEY (real_id) REFERENCES realisator(realisatorID)
);
CREATE TABLE IF NOT EXISTS `actorsINfilm` (
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `film_id` INT NOT NULL,
    `actor_id` INT NOT NULL,
    CONSTRAINT actorsINthefilm
        FOREIGN KEY (film_id) REFERENCES film(filmID),
        FOREIGN KEY (actor_id) REFERENCES actor(actorID)
);

INSERT INTO
    `genre`
VALUES
    ('Action'),
    ('Amateur'),
    ('Aventure'),
    ('Catastrophe'),
    ('Comédie'),
    ('Criminel'),
    ('Documentaire'),
    ('Drame'),
    ('Erotique'),
    ('Fantastique'),
    ('Guerre'),
    ('Historique'),
    ('Horreur'),
    ('Institutionnel'),
    ('Musicale'),
    ('Peplum'),
    ('Pornographique'),
    ('Romance'),
    ('Science-Fiction'),
    ('Suspense'),
    ('Western');

INSERT INTO `film`
    (`titre`,`sortie`,`genre`,`duree`,`affiche`)
VALUES
    ('Terminator','1984-10-26','Science-fiction','1:17:00','./img/affiches/Terminator.jpg'),
    ('Groom Service','1995-12-25','Comédie','1:38:00','./img/affiches/Groom Service.jpg'),
    ('Le Créateur','1999-06-16','Comédie','1:32:00','./img/affiches/Le Créateur.jpg');

INSERT INTO `realisator`
    (`realisatorFirst`,`realisatorLast`)
VALUES
    ('Benoît','Poelvoorde'),
    ('Allison','Anders'),
    ('Alexander','Rockwell'),
    ('Robert','Rodriguez'),
    ('Quentin','Tarantino');

INSERT INTO `actor`
    (`actorFirst`,`actorLast`)
VALUES
    ('Benoît','Poelvoorde'),
    ('Madonna','Ciccone'),
    ('Tim','Roth'),
    ('Salma','Hayek'),
    ('Quentin','Tarantino'),
    ('Bruce','Willis'),
    ('Antonio','Banderas');

INSERT INTO `realsOFfilm`
    (`film_id`,`real_id`)
VALUES
    (2,1),
    (2,2),
    (2,3),
    (2,4);

INSERT INTO `actorsINfilm`
    (`film_id`,`actor_id`)
VALUES
    (2,1),
    (2,2),
    (2,3),
    (2,4),
    (2,5),
    (2,6);

SHOW TABLES;
SELECT * FROM film;
SELECT * FROM actor;
SELECT * FROM realisator;