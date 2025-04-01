-- Active: 1734994375824@@127.0.0.1@3306@anforum

CREATE DATABASE anforum;
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parentid INT,
    post VARCHAR(256),
    id_user INT
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(256),
    password_enc VARCHAR(256)
);

ALTER TABLE posts
ADD CONSTRAINT fk_user_id FOREIGN KEY (id_user) REFERENCES users(id);
