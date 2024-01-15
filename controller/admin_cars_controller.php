<?php
require_once __DIR__."./../views/admin/admin_cars_view.php";
require_once __DIR__ . "./../models/cars_model.php";
class AdminCarsController {

    public function displayAdminCarsView() {
        $carsModel = new CarsModel();
        $cars = $carsModel->getCarsWithMarks();
        $adminCarsView = new AdminCarsView();
        $adminCarsView->generateAdminCarsView($cars);
    }

    public function deleteCar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['carid'] !== "") {
                $carid = $_POST['carid'];
                echo $carid;
                $carsModel = new CarsModel();
                $carsModel->deleteCar($carid);
                header("Location: " . '/car_show/admin/cars');
                exit();
            }
        }
    }

    public function createCar () {
        $featuresModel = new FeaturesModel();
        $features = $featuresModel->getFeatures();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $marksModel = new MarksModel();
            $marks = $marksModel->getMarks();
            $marksnames = array();
            foreach($marks as $mark) {
                array_push($marksnames, $mark['markname']);
            }
            $car = array();
            $adminCarsView = new AdminCarsView();
            $adminCarsView->generateAdminCarFormView("Add a new car", "create", "Create", $features, $marksnames,$car);
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $carsModel = new CarsModel();
            $markid = 2;
            $carsModel->createCar(
                $_POST['carname'],
                $_POST['cardescription'],
                intval($_POST['carversion']),
                intval($_POST['caryear']),
                $markid,
            );

            $addedCar = $carsModel->getCarByData(
                $markid,
                $_POST['carname'],
                $_POST['carversion'],
                $_POST['caryear'],
            );

            $carid = $addedCar[0]['carid'];
            echo $carid;

            $i = 1;
            while ($i < count($features)) {
                echo $i;
                $featureValue = $_POST[$features[$i - 1]['featurename']];
                $carsModel->createCarFeature($carid, $i, $featureValue);
                $i = $i + 1;
                echo $i;
            }
            // header("Location: " . '/car_show/admin/cars');
            // exit();
        }
   }

}

?>