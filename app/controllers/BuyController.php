<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once 'app/models/Buy.php';
    require_once 'phpmailer/src/Exception.php';
    require_once 'phpmailer/src/PHPMailer.php';
    require_once 'phpmailer/src/SMTP.php';

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

                $sql = "INSERT INTO bilet (pro_id, email, rand, loc)
                VALUES (:pro_id, :email, :rand, :loc)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    'pro_id' => $pro_id,
                    'email' => $_POST["user_email"],
                    'rand' => $rand,
                    'loc' => $loc));
            } 

            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // Set your SMTP server
                $mail->SMTPAuth   = true;
                $mail->Username   = 'rares.ungureanu25@gmail.com'; // SMTP username
                $mail->Password   = 'rutica25';         // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                $mail->Port       = 587; // TCP port to connect to

                $mail->setFrom('rares.ungureanu25@gmail.com', 'Rares Andrei Ungureanu');
                $mail->addAddress('laura_maran@yahoo.com', 'Laura Maran'); // Add a recipient
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = "Achizitionare bilete film";
                $mail->Body    = $message;
                $mail->send();
            } catch (Exception $e) {
                echo "Email-ul nu a putut fi trimis. Mailer Error: {$mail->ErrorInfo}";
            }


            require_once 'app/views/buy/recapBuy.php';
        }
    }
?>