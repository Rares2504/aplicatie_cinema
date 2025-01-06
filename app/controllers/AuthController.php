<?php
require_once "app/models/User.php";

class AuthController {

    public static function loginAdmin(){
     
        // POST
        $email = htmlentities($_POST["email"]);
        $pass = $_POST["parola"];
        $message = '';

        $user = User::getUserByEmail($email);

        if(!$user || $pass != $user["parola"]){
            $message = "Email sau parola invalida!";
            require_once 'app/views/admin/index.php';
        } else if($user["rol_id"] != 1){
            $message = "User-ul nu are drepturi de administrare!";
            require_once 'app/views/admin/index.php';
        } else{
            // login successful
            $_SESSION["request_user"] = $user;
            require_once 'app/views/admin/index.php';
        }
    }

    public static function logoutAdmin(){
        //session_start();
        session_destroy();
        header("Location: /aplicatie_cinema/admin");
        //require_once 'app/views/admin/index.php';
    }

    public static function landing_page(){
        require_once "app/views/landing_page.php";
    }
}
?>