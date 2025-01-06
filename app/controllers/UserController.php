<?php
require_once "app/models/User.php";

class UserController{
    public static function index() {
        $users = User::getAllUsers();
        $create_permission = (
            isset($_SESSION["request_user"])  &&
            User::hasPermission($_SESSION["request_user"]["id"], "create_user")
        );
        require_once "app/views/users/index.php";

    }

    static function data_validation() {
        $errors = [];
        $len_name = strlen($_POST['nume']);
        if ($len_name < 1 || $len_name > 20) {
            $errors['eroare_nume'] = 'Numele trebuie sa aiba intre 1 si 20 de caractere';
        }
        $len_name = strlen($_POST['prenume']);
        if ($len_name < 1 || $len_name > 20) {
            $errors['eroare_prenume'] = 'Prenumele trebuie sa aiba intre 1 si 20 de caractere';
        }
        if (strpos($_POST['email'], '@') === false) {
            $errors['eroare_email'] = 'Email invalid';
        }
        if (isset($_POST['parola']) && strlen($_POST['parola']) < 8) {
            $errors['eroare_parola'] = 'Parola trebuie sa aiba minim 8 caractere';
        }
        if (isset($_POST['rol_id']) && !UserRole::getRole($_POST['rol_id'])) {
            $errors['eroare_rol'] = 'Rol invalid';
        }

        return $errors;
    }
}
?>