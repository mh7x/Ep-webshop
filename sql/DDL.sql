DROP DATABASE IF EXISTS webshop;
CREATE DATABASE webshop;
USE webshop;

CREATE TABLE IF NOT EXISTS Oseba (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ime TEXT NOT NULL,
    priimek TEXT NOT NULL,
    email TEXT NOT NULL,
    geslo TEXT NOT NULL,
    aktiven BOOLEAN NOT NULL,
    status TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS Posta (
    stevilka INT PRIMARY KEY,
    kraj TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS Stranka (
    id_osebe INT NOT NULL,
    naslov TEXT NOT NULL,
    posta INT NOT NULL,
    FOREIGN KEY (id_osebe) REFERENCES Oseba(id),
    FOREIGN KEY (posta) REFERENCES Posta(stevilka)
);

CREATE TABLE IF NOT EXISTS Narocilo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stranka INT NOT NULL,
    status TEXT NOT NULL,
    FOREIGN KEY (stranka) REFERENCES Oseba(id)
);

CREATE TABLE IF NOT EXISTS Artikel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naziv TEXT NOT NULL,
    opis TEXT NOT NULL,
    cena INT NOT NULL,
    slika TEXT NOT NULL,
    ocena INT NOT NULL
);

CREATE TABLE IF NOT EXISTS Postavka (
    id INT AUTO_INCREMENT PRIMARY KEY,
    artikel INT NOT NULL,
    kolicina INT NOT NULL,
    cena INT NOT NULL,
    narocilo INT NOT NULL,
    FOREIGN KEY (narocilo) REFERENCES Narocilo(id),
    FOREIGN KEY (artikel) REFERENCES Artikel(id)
);


INSERT INTO Oseba (ime, priimek, email, geslo, aktiven, status) VALUES ("The", "Admin", "admin@gmail.com", "admin", TRUE, "admin");