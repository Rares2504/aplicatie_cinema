<?php
    require_once 'app/models/Buy.php';
    class BuyController{
        public static function index(){
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $screenings = Buy::getFutureScreeningsById($_GET['search']);
            } else {
                $screenings = Buy::getFutureScreenings();
            }
            require_once 'app/views/buy/index.php';
        }

    }

?>