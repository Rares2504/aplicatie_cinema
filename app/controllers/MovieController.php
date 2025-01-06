<?php

    require_once 'app/models/Movies.php';
    class MovieController{
        public static function index(){
            $movies = Movies::getAllMovies();
            require_once 'app/views/movies/index.php';
        }
        
        public static function createMovie() {
            require_once 'app/views/movies/createMovie.php';
        }

        //titlu, gen, durata, limba, rating, descriere (mai trebuie sa adaug poza)
        public static function insertMovie() {
            $titlu = $_POST['titlu'];
            $gen = $_POST['gen'];
            $durata = $_POST['durata'];
            $limba  = $_POST['limba'];
            $rating = $_POST['rating'];
            $descriere = $_POST['descriere'];
            $poza = $_FILES['poza'];
            $pozaData = file_get_contents($poza['tmp_name']);
            Movies::createMovie($titlu, $gen, $durata, $limba, $rating, $descriere, $pozaData);
        }

        public static function displayImage(){
            $imageData = Movies::getImageMovieById($_GET['id']);
            require_once 'app/views/movies/displayImage.php';
        }

        public static function deleteMovie(){
            $fil_id = $_GET['fil_id'];
            Movies::deleteMovie($fil_id);
            $movies = Movies::getAllMovies();
            require_once 'app/views/movies/index.php';
        }

        public static function editMovie() {
            $movie = Movies::getMovieById($_GET['fil_id']);
            require_once 'app/views/movies/editMovie.php';
        }

        public static function doEditMovie() {
            $titlu = $_POST['titlu'];
            $gen = $_POST['gen'];
            $durata = $_POST['durata'];
            $limba  = $_POST['limba'];
            $rating = $_POST['rating'];
            $descriere = $_POST['descriere'];
            $poza = $_FILES['poza'];
            $pozaData = file_get_contents($poza['tmp_name']);
            $fil_id = $_POST['fil_id'];

            try {
                Movies::doEditMovie($titlu, $gen, $durata, $limba, $rating, $descriere, $pozaData, $fil_id);
                $movies = Movies::getAllMovies();
                require_once 'app/views/movies/index.php';
            } catch (Exception $e) {
                // Mesaj de eroare
                $message = "Eroare la adăugarea filmului: " . $e->getMessage();
                require_once 'app/views/movies/editMovie.php';
            }

            
            
            
        }
    }
?>