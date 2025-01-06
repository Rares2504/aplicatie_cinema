<?php
    class Screening{
        public static function getAllScreenings(){
            global $pdo;
            $sql = "SELECT 
                        p.pro_id,
                        f.titlu AS film_titlu,  
                        p.data AS proiectie_data, 
                        s.nume AS sala_nume, 
                        p.ora AS proiectie_ora
                    FROM proiectie p
                    JOIN film f ON p.fil_id = f.fil_id
                    JOIN sala s ON p.sal_id = s.sal_id
                    ORDER BY p.data, p.ora";
             $stmt = $pdo->prepare($sql);
             $stmt->execute();
             return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getScreeningById($screening_id){
            global $pdo;
            $sql = "SELECT * FROM proiectie WHERE pro_id = :screening_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array('screening_id' => $screening_id));
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        // cautare dupa titlu
        public static function getScreeningsByMovieTitle($movie_title){
            global $pdo;
            $sql = "SELECT 
                        p.pro_id,
                        f.titlu AS film_titlu,  
                        p.data AS proiectie_data, 
                        s.nume AS sala_nume, 
                        p.ora AS proiectie_ora
                    FROM proiectie p
                    JOIN film f ON p.fil_id = f.fil_id
                    JOIN sala s ON p.sal_id = s.sal_id
                    WHERE f.titlu = :movie_title
                    ORDER BY p.data, p.ora";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array('movie_title' => $movie_title));
            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        }


        public static function createScreening($fil_id, $sal_id, $data, $ora, $pret)
        {
            global $pdo;
            $sql = "INSERT INTO proiectie(fil_id, sal_id, data, ora, pret) 
                VALUES (:fil_id, :sal_id, :data, :ora, :pret)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':fil_id' => $fil_id,
                ':sal_id' => $sal_id,
                ':data' => $data,
                ':ora' => $ora,
                ':pret' => $pret
            ));
        }

        public static function deleteScreening($screening_id){
            global $pdo;
            $sql = "DELETE FROM proiectie WHERE pro_id = :screening_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array('screening_id' => $screening_id));
        }

    }
?>