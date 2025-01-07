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

        public static function selectPlace(){
            $occupiedSeats = Buy::getOccupiedPlaces($_POST['pro_id']);
            $details = Buy::getScreeningDetailsById($_POST['pro_id']);
            require_once 'app/views/buy/selectPlace.php';
        }

        public static function doSelectPlace(){
            global $pdo;
            $uti_id = 2;
            $pro_id = $_POST["screening_id"];
            $places = explode(",", rtrim($_POST["places"],","));
            $message = "Ati achizitionat bilete pentru filmul: <B>".$_POST["title"]."</B>";
            $message.= "<BR>Data: <B>".$_POST["day"]."</B>";
            $message.= "<BR>Ora: <B>".$_POST["hour"]."</B><P>";
            foreach ($places as $place){
                $locrand = explode("-", $place, 2);
                $rand = $locrand[0];
                $loc = $locrand[1];
                $message.= "Rand: <B>".$rand."</B> Loc: <B>".$loc."</B><br>";

                $sql = "INSERT INTO bilet (pro_id, uti_id, rand, loc)
                VALUES (:pro_id, :uti_id, :rand, :loc)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    'pro_id' => $pro_id,
                    'uti_id' => $uti_id,
                    'rand' => $rand,
                    'loc' => $loc));
            } 
            require_once 'app/views/buy/recapBuy.php';
        }
    }
?>