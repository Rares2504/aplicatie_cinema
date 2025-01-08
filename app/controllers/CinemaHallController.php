<?php
    require_once 'app/models/CinemaHall.php';
    class CinemaHallsController{
        public static function isCinemaHallIdValid($cinema_hall_id) {
            global $db;
            $stmt = $db->prepare("SELECT COUNT(*) FROM sala WHERE sal_id = ?");
            $stmt->execute([$cinema_hall_id]);
            return $stmt->fetchColumn() > 0;
        }
    }
?>