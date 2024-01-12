<?php
require_once __DIR__."/client_template.php";
class CompareView {
    public function generateCompareSection ($numberOfForms) {
        echo "
        <form action='compare' method='POST' class='comparer col-center'>
            <div class='comparer col-center'>
                <div class='forms row-even'>
                ";

                $i = 1;
                while ($i <= $numberOfForms) {
                    $required = "";
                    if ($i <= 2) {
                        $required = "required";
                    }
                    $this->generateCarForm($i, $required);
                    $i = $i + 1;
                }

                echo "
                </div>
                <input type='submit' class='btn row-center' id='btn-compare' text='Comparer'/>
            </div>
        </form>
        ";
    }
    public function generateCarForm ($formNumber, $required) {
        if (isset($_GET['mark' . $formNumber])) {
            $mark = $_GET['mark' . $formNumber];
            $model = $_GET['model' . $formNumber];
            $version = $_GET['version' . $formNumber];
            $year = $_GET['year' . $formNumber];
        } elseif (isset($_POST['mark' . $formNumber])) {
            $mark = $_POST['mark' . $formNumber];
            $model = $_POST['model' . $formNumber];
            $version = $_POST['version' . $formNumber];
            $year = $_POST['year' . $formNumber];
        } else {
            $mark = '';
            $model = '';
            $version = '';
            $year = '';
        }
        echo "
        <div class='compare-form form-box'>
            <label>Vehicule ".$formNumber."</label>
            <hr>
            <div class='formy'>
        ";
                $this->generateCarFormField($formNumber, 'Marque', 'mark', $mark, ['Toyota', 'BMW'], $required);
                $this->generateCarFormField($formNumber, 'Model', 'model', $model, ['Camry SE', '5 Series 530i'], $required);
                $this->generateCarFormField($formNumber, 'Version', 'version', $version, ['2022'], $required);
                $this->generateCarFormField($formNumber, 'Annee', 'year', $year, ['2022'], $required);
        echo "
            </div>
        </div>
        ";
    }

    public static function generateCarFormField($formNumber, $fieldLabel, $fieldName, $fieldValue, $data, $required) {
        echo "
        <div class='field input'>
            <label for='".$fieldName."".$formNumber."'>".$fieldLabel."</label>
            <select style='width: 100%; height: 40px; font-size: 16px; padding: 0 10px; border-radius: 5px; border: 1px solid #ccc; outline: none;' name='".$fieldName.$formNumber."' ". $required.">";
        $i = 0;
        $selected = "";
        while ($i < count($data)) {
            if ($data[$i] == $fieldValue) {
                $selected = "selected";
            }
            $i = $i + 1;
        }
        echo "<option value='' ".$selected."></option>";

        $i = 0;
        while ($i < count($data)) {
            $selected = "";
            if ($data[$i] === $fieldValue) {
                $selected = "selected";
            }
            echo "<option value='".$data[$i]."' ".$selected." >".$data[$i]."</option>";
            $i = $i + 1;
        }
        echo " 
            </select>
        </div>
        ";
    }

    public function generateCompareTable($features, $cars, $marks) {
        echo "
        <div class='row-center'>
            <div class='compare-result col-center'>
        ";
        $this->generateCarNamesImagesTable($cars, $marks);
        $this->generateCarsDetailsTable($features, $cars);
        echo "
            </div>
        </div>
        ";
    }

    private function generateCarNamesImagesTable ($cars, $marks) {
        echo "
        <div class='cars-names'>
            <table>
                <tr>
                    <th></th>
        ";
        $i = 0;
        while ($i < count($cars)) {
            $this->generateCarTH($cars[$i], $marks[$i]);
            $i = $i + 1;
        }
        echo "
                    </tr>
                </table>
            </div>
        ";
    }

    public function generateCarTH ($car, $mark) {
        echo "
            <th><img src='assets/images/cars/hyunday.jpg'>
                <h3>".$mark." ".$car[0]['carname']."</h3>
            </th>
        ";
    }

    private function generateCarsDetailsTable($features, $cars) {
        echo "
        <div class='cars-details'>
            <table>";
        $i = 0;
        while ($i < count($features)) {
            $feature = $features[$i]['featurename']."".$features[$i]['featureunit'];
            $this->generateSingleTableRow($i, $feature, $cars);
            $i = $i + 1;
        }
        echo "
            </table>
        </div>
        ";
    }

    public function generateSingleTableRow ($rowId, $feature, $cars) {
        echo "
        <tr>
            <td>".$feature."</td>";
        foreach($cars as $car) {
            echo "<td>".$car[$rowId]['featureval']."</td>";
        }
        echo "</tr>
        ";
    }
}
?>