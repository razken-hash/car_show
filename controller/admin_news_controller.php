<?php
require_once __DIR__."./../views/admin/admin_news_view.php";
require_once __DIR__ . "./../models/news_model.php";
require_once __DIR__ . "./../routers/routers.php";
class AdminNewsController {

    public function displayAdminNewsView() {
        $newsModel = new NewsModel();
        $news = $newsModel->getNews();
        $adminNewsView = new AdminNewsView();
        $adminNewsView->generateAdminNewsView($news);
    }

    public function deleteNews () {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_GET['newsid'] !== "") {
                $newsid = $_POST['newsid'];
                $newsModel = new NewsModel();
                $newsModel->deleteNews($newsid);
                header("Location: " . '/car_show/admin/news');
                exit();
            }
        }
    }
}

?>