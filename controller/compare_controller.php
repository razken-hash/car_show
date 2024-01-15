<?php
require_once __DIR__."./../views/client/client_template.php";
require_once __DIR__."./../views/client/compare_view.php";
require_once __DIR__ . "./../models/features_model.php";
require_once __DIR__ . "./../models/cars_model.php";
require_once __DIR__ . "./../models/marks_model.php";
class CompareController {

    public function displayCompareView() {
        $compareView = new CompareView();
        ClientTemplate::generateHeader(false);
        ClientTemplate::generateMenu();
        $compareView->generateCompareSection(4);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            echo "ER";
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // //! FETCH CARS
            $marks = [];
            $cars = [];
            $carsModel = new CarsModel();
            $i = 1;
            while ($i <= 4) {
                if ($_POST['mark'.$i] !== "") {
                    $mark = $_POST['mark'.$i];
                    array_push($marks, $mark);
                    $model = $_POST['model'.$i.""];
                    $version = $_POST['version'.$i.""];
                    $year = $_POST['year'.$i.""];
                    $marksModel = new MarksModel();
                    $markId = $marksModel->getMarkByName($mark);
                    $carRow = $carsModel->getCarByData($markId['markid'], $model, $version, $year);
                    $carId = $carRow[0]['carid'];
                    $carInfo = $carsModel->getCarsWithFeatures($carId);
                    echo $carInfo[2]['feature_value'];
                    array_push($cars, $carInfo);
                }
                $i = $i + 1;
            }
            
            //! FETCH FEATURES
            $featuresModel = new FeaturesModel();
            $features = $featuresModel->getFeatures();
            $compareView->generateCompareTable($features, $cars, $marks);
        }
        ClientTemplate::generateFooter();
    }
}

?>