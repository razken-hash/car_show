<?php
require_once __DIR__ . './../admin/admin_template.php';
class AdminCarsView {

    public function generateAdminCarsView ($cars) {
        echo "<div class='adminer row-start'>";
        AdminTemplate::generateSideBar("Cars");
        echo "
        <div class='data col-start'>
        ";
        AdminTemplate::generateHeader();
        echo "<a href='cars/create'>Create Car</a>";
        $this->generateCarsTable($cars);
        echo "</div>";
        echo "</div>";
    }

    public function generateAdminCarFormView($title, $action, $confirm, $features, $marks, $car) {
        echo "<div class='adminer row-start'>";
        AdminTemplate::generateSideBar("Cars");
        echo "
        <div class='data col-start'>
        ";
        AdminTemplate::generateHeader();
        $this->generateCreateCarForm($title, $action, $confirm, $features, $marks, $car);
        echo "</div>";
        echo "</div>";
    }

    public function generateCarsTable ($cars) {
        $this->generateTableHeader();
        $this->generateDataTable($cars);
    }

    public function generateTableHeader () {
        echo "
        <div class='attributes'>
            <table>
                <tr>
                    <th style='width: 10%;'>Id</th>
                    <th style='width: 20%;'>Mark</th>
                    <th style='width: 26%;'>Model</th>
                    <th style='width: 13%;'>Version</th>
                    <th style='width: 13%;'>Year</th>
                    <th style='width: 18%;'>Image</th>
                </tr>
            </table>
        </div>
        ";
    }

    public function generateDataTable ($cars) {
        echo "
        <div class='rows'>
            <table>
        ";
        foreach ($cars as $car) {
            $this->generateMarkRow($car);
        }
        echo "
            </table>
        </div>
        ";
    }

    public function generateMarkRow ($car) {
        echo "
        <tr>
            <td style='width: 10%;'>".$car['carid']."</td>
            <td style='width: 20%;'>".$car['markname']."</td>
            <td style='width: 26%;'>".$car['carname']."</td>
            <td style='width: 13%;'>".$car['carversion']."</td>
            <td style='width: 13%;'>".$car['caryear']."</td>
            <td style='width: 20%; overflow:hidden;'>"
            .$car['carimage']." ";
            $this->generateCarActionForm($car['carid'], 'update');
            $this->generateCarActionForm($car['carid'], 'delete');
            $this->generateCarActionForm($car['carid'], 'view');
        echo "
            </td>
        </tr>";
    }

    public function generateCarActionForm($carid, $action) {
        echo "
        <form action='cars/".$action."' method='POST'>
            <input style='display: none;' type='text' name='carid' value='".$carid."'>
            <button type='submit'><img src='/car_show/assets/icons/".$action.".svg' /></button>
        </form>
        ";
    }

    public function generateCreateCarForm($title, $action, $confirm, $features, $marks, $car)
    {
        echo "
        <div class='create'>
            <form action='" . $action . "' method='POST'>
                <div class='title col-even-center'>
                    <label>" . $title . "</label>
                    <hr style='width: 70%'>
                </div>
                <div class='inputsin'>
                <div class='inputs'>
                        <input style='display: none;' name='markid' type='text' value='" . $car['carid'] . "'>";
                    Components::generateSelectField("Car mark", "markname", $marks, $car['markname']);
                    echo "
                        <div class='field input col-start'>
                            <label for='carname'>Model name</label>
                            <input name='carname' type='text' value='" . $car['carname'] . "'>
                        </div>
                        <div class='field input col-start'>
                            <label for='carname'>Model description</label>
                            <input name='carname' type='text' value='" . $car['cardescription'] . "'>
                        </div>
                    ";

                    Components::generateSelectField("Car version", "carversion", range(2000, 2024), $car['carversion']);
                    Components::generateSelectField("Car year", "caryear", range(2000, 2024), $car['caryear']);
        $i = 0;
        while ($i < count($features)) {
            $feature = $features[$i];
            if ($i % 2 == 0) {
            }
            echo "
            <div class='field input col-start'>
                <label for='".$feature['featurename']."'>".$feature['featurename']."</label>
                <input name='".$feature['featurename']."' type='text' value=''>
            </div>
            ";
            if ($i % 2 == 1) {
            }
            $i = $i + 1;
        }
        echo "
                </div>
                </div>
                <div class='decision row-center'>
                    <a href='admin/cars' class='btn-cancel row-center'>Cancel</a>
                    <input type='submit' class='btn-submit row-center' value='" . $confirm . "'/>
                </div>
            </form>
        </div>
        ";
    }
}

?>