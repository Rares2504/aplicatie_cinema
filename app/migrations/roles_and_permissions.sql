
CREATE TABLE permisiuni(
    per_id INTEGER AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(128) UNIQUE
)ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE roluri_permisiuni(
    rol_id INTEGER,
    per_id INTEGER,
    PRIMARY KEY(rol_id, per_id),
    FOREIGN KEY(rol_id) REFERENCES roluri_utilizatori(rol_id) ON DELETE CASCADE,
    FOREIGN KEY(per_id) REFERENCES permisiuni(per_id) ON DELETE CASCADE
)ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- inserez permisiunile
INSERT INTO permisiuni (per_id, nume) VALUES (1, 'create_movie');
INSERT INTO permisiuni (per_id, nume) VALUES (2, 'edit_movie');
INSERT INTO permisiuni (per_id, nume) VALUES (3, 'delete_movie');
INSERT INTO permisiuni (per_id, nume) VALUES (4, 'add_movie'); -- am nevoie?
INSERT INTO permisiuni (per_id, nume) VALUES (5, 'create_screening');  -- mai trebuie sa creez permisiuni pt cumparare bilete
INSERT INTO permisiuni (iper_id, nume) VALUES (6, 'delete_screening');
INSERT INTO permisiuni (per_id, nume) VALUES (7, 'add_screening');

--inserez pemisiunile adminului
INSERT INTO roluri_permisiuni (rol_id, per_id) VALUES (1, 1);
INSERT INTO roluri_permisiuni (rol_id, per_id) VALUES (1, 2);
INSERT INTO roluri_permisiuni (rol_id, per_id) VALUES (1, 3);
INSERT INTO roluri_permisiuni (rol_id, per_id) VALUES (1, 4);
INSERT INTO roluri_permisiuni (rol_id, per_id) VALUES (1, 5);
INSERT INTO roluri_permisiuni (rol_id, per_id) VALUES (1, 6);
INSERT INTO roluri_permisiuni (rol_id, per_id) VALUES (1, 7);

