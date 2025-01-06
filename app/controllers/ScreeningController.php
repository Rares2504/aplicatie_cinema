<?php
    require_once 'app/models/CinemaHall.php';
    require_once 'app/models/Screening.php';
    require_once 'app/models/Movies.php';

    class ScreeningController{
        
        public static function index(){
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $searchTerm = $_GET['search'];
                $screenings = Screening::getScreeningsByMovieTitle($searchTerm);
            } else {
                $screenings = Screening::getAllScreenings();
            }
            require_once 'app/views/screenings/index.php';
        }

        public static function ScreeningsMovieTitle($movie_title){
            $screenings = Screening::getScreeningsByMovieTitle($movie_title);
            require_once 'app/views/screenings/index.php';
        }

        public static function createScreening() {
            $movies = Movies::getAllMovies();
            $cinemaHalls = CinemaHall::getAllCinemaHalls();
            require_once 'app/views/screenings/createScreening.php';
        }

        public static function insertScreening(){
            $fil_id = $_POST['fil_id'];
            $sal_id = $_POST['sal_id'];
            $data = $_POST['data'];
            $ora = $_POST['ora'];
            $pret = $_POST['pret'];
            Screening::createScreening($fil_id, $sal_id, $data, $ora, $pret);
        }
        
        public static function isMovieIdValid($movie_id) {
            global $db;
            $stmt = $db->prepare("SELECT COUNT(*) FROM filme WHERE fil_id = ?");
            $stmt->execute([$movie_id]);
            return $stmt->fetchColumn() > 0;
        }
    
        public static function deleteScreening(){
            $screening_id = $_GET['pro_id'];
            Screening::deleteScreening($screening_id);
            $screenings = Screening::getAllScreenings();
            require_once 'app/views/screenings/index.php';
        }

    //--------------------------------------
    }
?>