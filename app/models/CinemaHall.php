<?php
   class CinemaHall{
    public static function getAllCinemaHalls(){
        global $pdo;
        $sql = "SELECT * FROM sala";
        $stmt = $pdo->query($sql);
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public static function getCinemaHallById($CinemaHall_id){
        global $pdo;
        $sql = "SELECT * FROM sala WHERE sal_id =:CinemaHall_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array('sal_id' => $CinemaHall_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
   }
?>