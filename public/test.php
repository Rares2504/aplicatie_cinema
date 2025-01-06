<?php
    require_once 'app/models/Movies.php';
    require_once 'config/pdo.php';

    $movies = Movies::getAllMovies();
    require_once 'aplicatie_cinema/app/views/movies/index.php';

?>