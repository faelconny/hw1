CREATE DATABASE hw1_db;

USE DATABASE hw1_db;

CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(16) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(16) NOT NULL,
    surname VARCHAR(16) NOT NULL,
    picture VARCHAR(255) DEFAULT NULL
) ENGINE = InnoDB;

CREATE TABLE movies (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL UNIQUE,
    description VARCHAR(127),
    poster VARCHAR(255),
    num_favourites INTEGER DEFAULT 0
) ENGINE = InnoDB;

CREATE TABLE favourites (
    user INTEGER,
    movie INTEGER,
    INDEX idx_user(user),
    INDEX idx_movie(movie),
    FOREIGN KEY(user) REFERENCES users(id) on delete cascade on update cascade,
    FOREIGN KEY(movie) REFERENCES movies(id) on delete cascade on update cascade,
    PRIMARY KEY(user, movie)
) ENGINE = InnoDB;

CREATE TABLE posts (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user INTEGER NOT NULL,
    time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    num_likes INTEGER DEFAULT 0,
    content JSON,
    INDEX idx_user(user),
    FOREIGN KEY(user) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE likes (
    user INTEGER NOT NULL,
    post INTEGER NOT NULL,
    INDEX idx_user(user),
    INDEX idx_post(post),
    FOREIGN KEY(user) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(post) REFERENCES posts(id) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(user, post)
) ENGINE = InnoDB;

DELIMITER //
CREATE TRIGGER favourites_trigger
    AFTER INSERT ON favourites
    FOR EACH ROW
    BEGIN
        UPDATE movies 
        SET num_favourites = num_favourites + 1
        WHERE id = new.movie;
    END //
DELIMITER;

DELIMITER //
CREATE TRIGGER remove_favourites_trigger
    AFTER DELETE ON favourites
    FOR EACH ROW
    BEGIN
        UPDATE movies
        SET num_favourites = num_favourites - 1
        WHERE id = old.movie;
END //
DELIMITER;

DELIMITER //
CREATE TRIGGER like_trigger
    AFTER INSERT ON likes
    FOR EACH ROW
    BEGIN
        UPDATE posts
        SET num_likes = num_likes + 1
        WHERE id = new.post;
END //
DELIMITER;

DELIMITER //
CREATE TRIGGER remove_like_trigger
    AFTER DELETE ON likes
    FOR EACH ROW
    BEGIN
        UPDATE posts
        SET num_likes = num_likes - 1
        WHERE id = old.post;
END //
DELIMITER;