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
    id_stranke INT AUTO_INCREMENT PRIMARY KEY,
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

CREATE TABLE IF NOT EXISTS `article` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` TEXT NOT NULL,
    `description` TEXT NOT NULL,
    `price` FLOAT NOT NULL,
    `photo` TEXT NOT NULL,
    `review` INT NOT NULL
);

CREATE TABLE IF NOT EXISTS Postavka (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `article` INT NOT NULL,
    kolicina INT NOT NULL,
    cena INT NOT NULL,
    narocilo INT NOT NULL,
    FOREIGN KEY (narocilo) REFERENCES Narocilo(id),
    FOREIGN KEY (`article`) REFERENCES `article`(id)
);


INSERT INTO Oseba (ime, priimek, email, geslo, aktiven, status) VALUES ("The", "Admin", "admin@gmail.com", "admin", TRUE, "admin");
INSERT INTO `article` VALUES
(1, 'Stol', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.", 123.99, 'stolec.jpg', 4),
(2, 'Miza', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.", 19993.99, 'miza.jpg', 3),
(3, 'Omara', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.", 420.99, 'omara.jpeg', 1),
(4, 'Postelja', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.", 15.99, 'postelja.jpg', 2);
