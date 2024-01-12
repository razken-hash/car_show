<?php

require_once __DIR__ . './../models/marks_model.php';
class HomeController {
    public function getCars () {
        $marksModel = new MarksModel();
        $carsModel = new CarsModel();
        $homeView = new HomeView();
        $marks = [""];
        $marksResult = $marksModel->getMarks();
        // foreach ($marksResult as $mr) {
        //     array_push($marks, $mr['markname']);
        // }
        ClientTemplate::generateHeader(false);
        $homeView->generateDiaporama();
        ClientTemplate::generateMenu();
        HomeView::generateMarksLogos(6, 160);
        $homeView->generateCompareSection(4);
        $homeView->generateGuide();
        ClientTemplate::generateFooter();
    }

}

?>