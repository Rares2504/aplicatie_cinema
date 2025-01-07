<?php
    class Buy{
        public static function getFutureScreenings(){
            global $pdo;
            $sql = "SELECT 
                        f.fil_id AS film_id,
                        f.poza AS film_poza,
                        f.titlu AS film_titlu,
                        f.descriere AS film_descriere,
                    DATE_FORMAT(p.data, '%d-%m-%Y') AS proiectie_data,
                    GROUP_CONCAT(CONCAT(DATE_FORMAT(p.ora, '%H:%i'),'-',p.pro_id) ORDER BY p.ora SEPARATOR ', ') AS ore_difuzare
                    FROM 
                        proiectie p  
                    JOIN 
                        film f ON p.fil_id = f.fil_id
                    WHERE 
                        CONCAT(p.data, ' ', p.ora) > NOW() 
                    GROUP BY 
                        f.poza, f.titlu, p.data
                    ORDER BY 
                        p.data";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getFutureScreeningsById($movie_id){
            global $pdo;
            $sql = "SELECT
                        f.fil_id AS film_id, 
                        f.poza AS film_poza,
                        f.titlu AS film_titlu,
                        f.descriere AS film_descriere,
                    DATE_FORMAT(p.data, '%d-%m-%Y') AS proiectie_data,
                    GROUP_CONCAT(CONCAT(DATE_FORMAT(p.ora, '%H:%i'),'-',p.pro_id) ORDER BY p.ora SEPARATOR ', ') AS ore_difuzare
                    FROM 
                        proiectie p  
                    JOIN 
                        film f ON p.fil_id = f.fil_id
                    WHERE 
                        CONCAT(p.data, ' ', p.ora) > NOW() 
                    AND f.titlu = :movie_id
                    GROUP BY 
                        f.poza, f.titlu, p.data
                    ORDER BY 
                        p.data";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array('movie_id' => $movie_id));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // fac o functie care sa ia datele despre proiectie cu pro_id ca parametru
        public static function getScreeningDetailsById($screening_id){
            global $pdo;
            $sql = "SELECT
                        f.titlu AS film_titlu,
                        DATE_FORMAT(p.data, '%d-%m-%Y') AS proiectie_data,
                        DATE_FORMAT(p.ora, '%H:%i') AS proiectie_ora,
                        s.nume AS sala_nume,
                        s.randuri AS sala_randuri,
                        s.locuri_rand AS sala_locuri_rand
                    FROM 
                        proiectie p
                    JOIN
                        film f ON p.fil_id = f.fil_id
                    JOIN
                        sala s ON p.sal_id = s.sal_id
                    WHERE
                        pro_id = :screening_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array('screening_id' => $screening_id));
            return $stmt->fetch(PDO::FETCH_ASSOC);
                    
        }

        // fac o functie care sa imi dea toate locurile ocupate
        public static function getOccupiedPlaces($pro_id){
            global $pdo;
            $sql = "SELECT CONCAT(rand, '-', loc)  as loc
                    FROM bilet
                    WHERE pro_id = :pro_id
                    ORDER BY rand, loc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array('pro_id' => $pro_id));
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        }

    }
?>