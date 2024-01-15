<?php

require_once __DIR__ . './../views/client/auth_view.php';
require_once __DIR__ . './../models/users_model.php';
class AuthController {

    public function registerUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $authView = new AuthView();
            $authView->showRegisterView();
        }
    }
    public function loginUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $authView = new AuthView();
            $authView->showLoginView();
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['email'] !== "") {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $userModel = new UsersModel();
                echo $email;
                echo $password;
                $result = $userModel->login($email, $password);
                if ($result) {
                    header("Location: " . "/car_show", false);
                    exit();
                } else {
                    echo "Error";
                }
            }
        }
    }
}
?>