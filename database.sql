CREATE DATABASE tp7_crud;

USE tp7_crud;

CREATE TABLE authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL
);

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    auteur_id INT NOT NULL,

    FOREIGN KEY (auteur_id)
        REFERENCES authors(id)
);