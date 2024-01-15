<?php

require_once __DIR__ . '/../controller/admin_marks_controller.php';
require_once __DIR__ . '/../controller/admin_cars_controller.php';
require_once __DIR__ . '/../controller/admin_news_controller.php';
require_once __DIR__ . '/../controller/admin_users_controller.php';
require_once __DIR__ . '/../controller/auth_controller.php';

require_once __DIR__ . '/../controller/home_controller.php';
require_once __DIR__ . '/../controller/compare_controller.php';

require_once __DIR__ . '/../views/client/auth_view.php';
require_once __DIR__ . '/../views/client/home_view.php';
require_once __DIR__ . '/../views/client/marks_view.php';

session_start();

$user =  $_COOKIE['user'];

$base_path = '/car_show';

$request = $_SERVER['REQUEST_URI'];

// Remove the base path from the request URI
$route = substr($request, strlen($base_path));

// Remove query parameters from the route
$route = strtok($route, '?');


function checkRoles($roles)
{
    global $user;
    if (!$user) {
        return false;
    }
    if (in_array($user['role'], $roles)) {
        return true;
    }
    return false;
}

//! test if request contains admin then do the tests then Switch request
//! Else do the test then switch the request

switch ($route) {
    case '/auth/register':
        $authController = new AuthController();
        $authController->registerUser();
        break;
    case '/auth/login':
        $authController = new AuthController();
        $authController->loginUser();
        break;

    case '/admin/cars':
        $adminCarsController = new AdminCarsController();
        $adminCarsController->displayAdminCarsView();
        break;
    case '/admin/cars/delete':
        $adminCarsController = new AdminCarsController();
        $adminCarsController->deleteCar();
        break;
    case '/admin/cars/create':
        $adminCarsController = new AdminCarsController();
        $adminCarsController->createCar();
        break;

    case '/admin/marks':
        $adminMarksController = new AdminMarksController();
        $adminMarksController->displayAdminMarksView();
        break;
    case '/admin/marks/create':
        $adminMarksController = new AdminMarksController();
        $adminMarksController->createMark();
        break;
    case '/admin/marks/update':
        $adminMarksController = new AdminMarksController();
        $adminMarksController->updateMark();
        break;
    case '/admin/marks/delete':
        $adminMarksController = new AdminMarksController();
        $adminMarksController->deleteMark();
        break;

    case '/admin/users':
        $adminUsersController = new AdminUsersController();
        $adminUsersController->displayAdminUsersView();
    break;
    case '/admin/users/activate':
        $adminUsersController = new AdminUsersController();
        $adminUsersController->activateUser();
    break;
    case '/admin/users/block':
        $adminUsersController = new AdminUsersController();
        $adminUsersController->blockUser();
        break;

    case '/admin/news':
        $adminNewsController = new AdminNewsController();
        $adminNewsController->displayAdminNewsView();
        break;
    case '/admin/news/delete':
        $adminNewsController = new AdminNewsController();
        $adminNewsController->deleteNews();
        break;

    case '/admin/reviews':
        echo "Reviews";
        break;

    case '/admin/contacts':
        echo "Contacts";
        break;


    case '/home':
        header("Location: " . $base_path);
        break;

    case '/compare':
        $compareController = new CompareController();
        $compareController->displayCompareView();
        break;

    case '/marks':
        echo "Marks";
        break;

    case '/news':
        echo "News";
        break;

    case '/reviews':
        echo "Reviews";
        break;

    case '/guide':
        echo "Guide";
        break;

    case '/contact':
        echo "Contacts";
        break;

    default:
        $homeView = new HomeView();
        $homeView->displayHomeView();
        break;
}
?>