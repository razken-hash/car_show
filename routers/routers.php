<?php

require_once __DIR__ . '/../controller/admin_marks_controller.php';

require_once __DIR__ . '/../controller/home_controller.php';
require_once __DIR__ . '/../controller/compare_controller.php';

require_once __DIR__ . '/../views/admin/admin_marks_view.php';

require_once __DIR__ . '/../views/client/auth_view.php';
require_once __DIR__ . '/../views/client/home_view.php';
require_once __DIR__ . '/../views/client/marks_view.php';

session_start();

$base_path = '/car_show';

$request = $_SERVER['REQUEST_URI'];

$route = rtrim(explode("?", $request)[0], "/");

$route = substr($route, strlen($base_path));

$user =  $_COOKIE['user'];


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
        if ($user) {
            header("Location: " . $base_path);
            exit();
        }
        $authView = new AuthView();
        $authView->showRegisterView();
        break;
    case '/auth/login':
        if ($user) {
            header("Location: " . $base_path);
            exit();
        }
        $authViews = new AuthView();
        $authViews->showLoginView();
        break;
    case '/admin':
        if ($user) {
            header("Location: " . $base_path);
            exit();
        }
        if (checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        // $adminView = new AdminView();
        // $adminView->showAdminView();
        break;
    case '/admin/cars':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }

        // $adminCarsView = new AdminCarsView();
        // $adminCarsView->showAdminCarsView();
        break;
    case '/admin/cars/create':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        // $adminCarsView = new AdminCarsView();
        // $adminCarsView->showAdminCreateCarView();
        break;
    case '/admin/marks':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        echo "hi";
        // $adminMarksController = new AdminMarksController();
        // $adminMarksController->displayMarksAdminView();
        break;
    case '/admin/marks/create':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        // $adminMarksView = new AdminMarksView();
        // $adminMarksView->showAdminCreateMarkView();
        break;
    case '/admin/news':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        // $adminNewsView = new AdminNewsView();
        // $adminNewsView->showAdminNewsView();
        break;
    case '/admin/news/create':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        // $adminNewsView = new AdminNewsView();
        // $adminNewsView->showAdminCreateNewsView();
        break;
    case '/admin/users':
        if (!$user) {
            header("Location: " . $base_path);
            exit();
        }
        if (!checkRoles(['admin'])) {
            header("Location: " . $base_path);
            exit();
        }
        // $adminUsersView = new AdminUsersView();
        // $adminUsersView->showAdminUsersView();
        break;

    case '/home':
        header("Location: " . $base_path);
        break;
    case '/compare':
        $compareController = new CompareController();
        $compareController->displayCompareView();
        break;
    case '/marks':
        $marksView = new MarksView();
        $marksView->displayMarksView();
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

    // case '/admin/reviews':
    //     if (!$user) {
    //         header("Location: " . $base_path);
    //         exit();
    //     }
    //     if (!checkRoles(['admin'])) {
    //         header("Location: " . $base_path);
    //         exit();
    //     }
    //     $reviewsManagementView = new ReviewManagementView();
    //     $reviewsManagementView->displayReviewsPage();
    //     break;
    // case '/admin/styles':
    //     if (!$user) {
    //         header("Location: " . $base_path);
    //         exit();
    //     }
    //     if (!checkRoles(['admin'])) {
    //         header("Location: " . $base_path);
    //         exit();
    //     }
    //     $stylesManagementView = new StylesManagementView();
    //     $stylesManagementView->displayUpdateStylesPage();
    //     break;

    // case '':
    //     $homeView = new HomeView();
    //     $homeView->displayHomePage();
    //     break;
    // case '/brands':
    //     $brandsView = new BrandsView();
    //     if (!isset($_GET['id'])) {
    //         $brandsView->displayBrandsPage();
    //         break;
    //     }
    //     $brandsView->displayBrandByIdPage();
    //     break;
    // case '/auth/profile':
    //     if (!$user) {
    //         header("Location: " . $base_path);
    //         exit();
    //     }
    //     $myProfileView = new MyProfileView();
    //     $myProfileView->displayProfilePage();
    //     break;
    // case '/compare':
    //     $compareView = new CompareView();
    //     if (!isset($_GET['id'])) {
    //         $compareView->displayCompareHomePage();
    //         break;
    //     }
    //     $compareView->displayComparePage();
    //     break;
    // case '/vehicles':
    //     $vehiclesView = new VehiclesView();
    //     if (!isset($_GET['id'])) {
    //         $vehiclesView->displayVehiclesPage();
    //         break;
    //     }
    //     $vehiclesView->displayVehicleByIdPage();
    //     break;
    // case '/news':
    //     $newsView = new NewsView();
    //     if (!isset($_GET['id'])) {
    //         $newsView->displayNewsHomePage();
    //         break;
    //     }
    //     $newsView->displayNewsByIdPage();
    //     break;
    // case '/reviews':
    //     $reviewsView = new ReviewsView();
    //     if (!isset($_GET['id'])) {
    //         $reviewsView->displayReviewsHomePage();
    //         break;
    //     }
    //     $reviewsView->displayVehicleReviewsByIdPage();
    //     break;

    default:
        $homeController = new HomeController();
        $homeController->getCars();
        // $homeView = new HomeView();
        // $homeView->displayHomeView();
        break;
}
?>