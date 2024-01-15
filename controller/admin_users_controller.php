<?php
require_once __DIR__."./../views/admin/admin_users_view.php";
require_once __DIR__ . "./../models/users_model.php";
require_once __DIR__ . "./../routers/routers.php";
class AdminUsersController {

    public function displayAdminUsersView() {
        $usersModel = new UsersModel();
        $users = $usersModel->getUsers();
        $adminUsersView = new AdminUsersView();
        $adminUsersView->generateAdminUsersView($users);
    }

    public function activateUser () {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['userid'] !== "") {
                $userid = $_POST['userid'];
                $userModel = new UsersModel();
                $userModel->activateUser($userid);
                header("Location: " . "/car_show/admin/users", false);
                exit();
            }
        }
    }

    public function blockUser () {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['userid'] !== "") {
                $userid = $_POST['userid'];
                $userModel = new UsersModel();
                $userModel->blockUser($userid);
                header("Location: " . "/car_show/admin/users", false);
                exit();
            }
        }
    }


}

?>