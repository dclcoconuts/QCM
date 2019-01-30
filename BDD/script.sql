DROP DATABASE IF EXISTS BDD_QCM;

CREATE DATABASE BDD_QCM;

USE BDD_QCM ;

DROP TABLE IF EXISTS Utilisateur ;
CREATE TABLE Utilisateur (id_Utilisateur INTEGER(3) AUTO_INCREMENT NOT NULL,
nom_Utilisateur VARCHAR(100),
prenom_Utilisateur VARCHAR(100),
dateInscript_Utilisateur DATE,
status_Utilisateur BOOLEAN,
password_Utilisateur VARCHAR(100), 
mail_Utilisateur VARCHAR(255),
PRIMARY KEY (id_Utilisateur)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Categorie ;
CREATE TABLE Categorie (id_Categorie INTEGER(3) AUTO_INCREMENT NOT NULL,
nom_Categorie VARCHAR(255),
PRIMARY KEY (id_Categorie)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Questionnaire ;
CREATE TABLE Questionnaire (id_Questionnaire INTEGER(4) AUTO_INCREMENT NOT NULL,
nom_Questionnaire VARCHAR(255),
date_Questionnaire DATE,
status_Questionnaire INTEGER(1),
motifRefus_Questionnaire VARCHAR(255),
id_Utilisateur INTEGER(3),
id_Categorie INTEGER(3),
PRIMARY KEY (id_Questionnaire)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Question ;
CREATE TABLE Question (id_Question INTEGER(3) AUTO_INCREMENT NOT NULL,
libelle_Question VARCHAR(255),
id_Questionnaire INTEGER(4),
PRIMARY KEY (id_Question)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Reponse ; 
CREATE TABLE Reponse (id_Reponse INTEGER(3) AUTO_INCREMENT NOT NULL, 
proposition_Reponse VARCHAR(255), 
reponse_Reponse BOOLEAN, 
id_Question INTEGER(3),
PRIMARY KEY (id_Reponse)) ENGINE=InnoDB;

DROP TABLE IF EXISTS Noter ;
CREATE TABLE Noter (id_Noter INTEGER(1) AUTO_INCREMENT NOT NULL,
note_Noter INTEGER(1),
id_Utilisateur INTEGER(3),
id_Questionnaire INTEGER(4),
PRIMARY KEY (id_Noter)) ENGINE=InnoDB;

ALTER TABLE Questionnaire ADD CONSTRAINT FK_Questionnaire_id_Utilisateur FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur (id_Utilisateur);
ALTER TABLE Questionnaire ADD CONSTRAINT FK_Questionnaire_id_Categorie FOREIGN KEY (id_Categorie) REFERENCES Categorie (id_Categorie);
ALTER TABLE Question ADD CONSTRAINT FK_Question_id_Questionnaire FOREIGN KEY (id_Questionnaire) REFERENCES Questionnaire (id_Questionnaire);
ALTER TABLE Reponse ADD CONSTRAINT FK_Reponse_id_Question FOREIGN KEY (id_Question) REFERENCES Question (id_Question);
ALTER TABLE Noter ADD CONSTRAINT FK_Noter_id_Utilisateur FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur (id_Utilisateur);
ALTER TABLE Noter ADD CONSTRAINT FK_Noter_id_Questionnaire FOREIGN KEY (id_Questionnaire) REFERENCES Questionnaire (id_Questionnaire);
