<?php
require_once __DIR__."./../views/admin/admin_marks_view.php";
require_once __DIR__ . "./../models/marks_model.php";
class AdminMarksController {

    public function displayMarksAdminView() {
        echo "ads";
        $marksModel = new MarksModel();
        $marks = $marksModel->getMarks();
        $adminMarksView = new AdminMarksView();
        $adminMarksView->generateAdminMarksView($marks);
    }
}

?>