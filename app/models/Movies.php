<?php
    class Movies{
        public static function getAllMovies(){
            global $pdo;
            $sql = "SELECT * FROM film";
            $stmt = $pdo->query($sql);
            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        }

        public static function createMovie($titlu, $gen, $durata, $limba, $rating, $descriere, $poza){
            global $pdo;
            $sql = "INSERT INTO film (titlu, gen, durata, limba, rating, descriere, poza)
                VALUES (:titlu, :gen, :durata, :limba, :rating, :descriere, :poza)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                'titlu' => $titlu,
                'gen' => $gen,
                'durata' => $durata,
                'limba' => $limba,
                'rating' => $rating,
                'descriere' => $descriere,
                'poza' => $poza));
        }

        public static function getMovieById($movie_id){
            global $pdo;
            $sql = "SELECT * FROM film WHERE fil_id = :movie_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array('movie_id' => $movie_id));
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public static function getImageMovieById($movie_id){
            global $pdo;
            $sql = "SELECT poza FROM film WHERE fil_id = :movie_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array('movie_id' => $movie_id));
            return $stmt->fetchColumn();
        }

        public static function deleteMovie($movie_id){
            global $pdo;
            $sql = "DELETE FROM film WHERE fil_id = :movie_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array('movie_id' => $movie_id));
        }

        public static function doEditMovie($titlu, $gen, $durata, $limba, $rating, $descriere, $poza, $fil_id){
            global $pdo;
            $sql = "UPDATE film SET titlu = :titlu, gen = :gen, durata = :durata, limba = :limba, rating = :rating, descriere = :descriere, poza = :poza WHERE fil_id = :fil_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                'titlu' => $titlu,
                'gen' => $gen,
                'durata' => $durata,
                'limba' => $limba,
                'rating' => $rating,
                'descriere' => $descriere,
                'poza' => $poza,
                'fil_id' => $fil_id));
        }
    }
?>