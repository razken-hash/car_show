<?php
require_once __DIR__."./../views/admin/admin_marks_view.php";
require_once __DIR__ . "./../models/marks_model.php";
class AdminMarksController {

    public function displayAdminMarksView() {
        $marksModel = new MarksModel();
        $marks = $marksModel->getMarks();
        $adminMarksView = new AdminMarksView();
        $adminMarksView->generateAdminMarksView($marks);
    }

    public function deleteMark() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_GET['markid'] !== "") {
                $markid = $_POST['markid'];
                $marksModel = new MarksModel();
                $marksModel->deleteMark($markid);
                header("Location: " . '/car_show/admin/marks');
                exit();
            }
        }
    }

    public function createMark() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $adminMarksView = new AdminMarksView();
            $mark = [];
            $adminMarksView->generateAdminMarkFormView("Add a new mark", "create", "Create", $mark);
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marksModel = new MarksModel();
            $marksModel->createMark(
                $_POST['markname'],
                $_POST['country'],
                $_POST['headoffice'],
                $_POST['foundyear'],
                $_POST['logo']
            );
            header("Location: " . '/car_show/admin/marks');
            exit();
        }
    }

    public function updateMark() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $adminMarksView = new AdminMarksView();
            $markid = $_GET['markid'];
            $marksModel = new MarksModel();
            $mark = $marksModel->getMarkById($markid);
            $mark = $mark[0];
            $adminMarksView->generateAdminMarkFormView("Update ".$mark['markname']." mark", "update", "Update", $mark);
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marksModel = new MarksModel();
            $marksModel->updateMark(
                $_POST['markid'],
                $_POST['markname'],
                $_POST['country'],
                $_POST['headoffice'],
                $_POST['foundyear'],
                $_POST['logo']
            );
            header("Location: " . '/car_show/admin/marks');
            exit();
        }
    }
}

?>