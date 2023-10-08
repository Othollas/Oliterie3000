/* crée une base de donnée oliterie3000*/

CREATE DATABASE oliterie3000;

USE oliterie3000



/* Crée la table et ajouter les categories à la table*/
CREATE TABLE matelas (
    id SMALLINT PRIMARY KEY AUTO_INCREMENT,
    marque VARCHAR(100) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    taille VARCHAR(100) NOT NULL,
    photo VARCHAR(255),
    prix DECIMAL(6,2) NOT NULL
);
/* Entrer les references des matelas */

INSERT INTO matelas (
    marque, nom, taille, photo, prix
)
VALUES
("epeda", "confort", "90X190", "matelas_epeda_confort.jpg", 579.99),
("dreamway", "moelleux", "90X190", "matelas_dreamway_moelleux.jpg", 709.99),
("bultex", "ferme", "90X190", "matelas_bultex_ferme.jpg", 759.99),
("epeda", "detente", "140X190", "matelas_epeda_detente.jpg", 1019.99);