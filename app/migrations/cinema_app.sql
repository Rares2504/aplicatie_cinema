--sa mai pun parile de create user


-- Crearea tabelului Film
CREATE TABLE film (
    fil_id INT PRIMARY KEY AUTO_INCREMENT,
    titlu VARCHAR(255) NOT NULL,
    gen VARCHAR(50),
    durata INT,
    limba VARCHAR(50),
    rating DECIMAL(3,1),
    descriere TEXT,
    poza BLOB
);

-- Crearea tabelului Sala
CREATE TABLE sala (
    sal_id INT PRIMARY KEY AUTO_INCREMENT,
    nume VARCHAR(100) NOT NULL,
    randuri INT NOT NULL,
    locuri_rand INT NOT NULL,
    tip_ecran VARCHAR(50)
);

-- Crearea tabelului Proiectie
CREATE TABLE proiectie (
    pro_id INT PRIMARY KEY AUTO_INCREMENT,
    fil_id INT NOT NULL,
    sal_id INT NOT NULL,
    data DATE NOT NULL,
    ora TIME NOT NULL,
    pret DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (fil_id) REFERENCES film(fil_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (sal_id) REFERENCES sala(sal_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Crearea tabelului Bilet
CREATE TABLE bilet (
    bil_id INT PRIMARY KEY AUTO_INCREMENT,
    pro_id INT NOT NULL,
    uti_id INT,
    email VARCHAR(100),
    rand INT NOT NULL,
    loc INT NOT NULL,
    FOREIGN KEY (pro_id) REFERENCES proiectie(pro_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (uti_id) REFERENCES utilizatori(uti_id) ON DELETE CASCADE ON UPDATE CASCADE

);

--Inserare sala 
INSERT INTO sala (nume, randuri, locuri_rand, tip_ecran) 
VALUES
('Sala 1', 10, 20, 'IMAX'),
('Sala 2', 12, 18, 'Standard'),
('Sala 3', 8, 25, 'Dolby Atmos'),
('Sala 4', 15, 15, '4DX'),
('Sala 5', 10, 22, 'IMAX'),
('Sala 6', 14, 16, 'Standard'),
('Sala 7', 20, 10, 'VIP');

-- creez tabelul pt utilizatori si pentru roluri --nu am scris in phpmyadmin

CREATE TABLE roluri_utilizatori(
    rol_id INT AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(128) UNIQUE
);

CREATE TABLE utilizatori(
    uti_id INT PRIMARY KEY AUTO_INCREMENT,
    nume VARCHAR(128),
    prenume VARCHAR(128),
    email VARCHAR(128) UNIQUE,
    parola VARCHAR(128) NOT NULL,
    rol_id INT NOT NULL,
    FOREIGN KEY(rol_id) REFERENCES roluri_utilizatori(rol_id) ON DELETE RESTRICT
)ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- inserez rolurile de baza:
INSERT INTO roluri_utilizatori(rol_id, nume) VALUES (1, 'admin');
INSERT INTO roluri_utilizatori(rol_id, nume) VALUES (2, 'user');

-- inserez utilizatorii de baza:
INSERT INTO utilizatori(nume, prenume, email, parola, rol_id) VALUES ('Ungureanu', 'Rares', 'rares.ungureanu25@gmail.com', 'admin', 1);
INSERT INTO utilizatori(nume, prenume, email, parola, rol_id) VALUES ('Ungureanu', 'Laura', 'laura_maran@yahoo.com', 'client', 2);
