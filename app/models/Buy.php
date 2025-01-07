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
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
?>