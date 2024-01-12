<?php
require_once __DIR__."/client_template.php";
class HomeView {

    public function displayHomeView() {
        ClientTemplate::generateHeader(false);
        $this->generateDiaporama();
        ClientTemplate::generateMenu();
        HomeView::generateMarksLogos(6, 160);
        $this->generateCompareSection(4);
        // $this->gen();
        $this->generateGuide();
        ClientTemplate::generateFooter();
    }

    public function generateDiaporama () {
        echo "
        <div class='diaporama row-center'>
            <img class='diapo-item' src='assets/images/diapo1.jpg'>
            <img class='diapo-item' src='assets/images/diapo4.jpg'>
            <img class='diapo-item' src='assets/images/diapo3.jpg'>
        </div>
        ";
    }

    public static function generateMarksLogos ($gridSize, $boxSize) {
        $gap = 140 / $gridSize;
        echo "
        <div class='marks' style='grid-template-columns: repeat(".$gridSize.", ".$boxSize."px); gap: ".$gap."px'>
        ";
        $i = 0;
        while ($i < 14) {
            HomeView::generateMarkBox($boxSize);
            $i = $i + 1;
        }
        echo "
        </div>
        ";
    }

    public static function generateMarkBox($boxSize) {
        echo "
        <div style='height:".$boxSize."px;' class='mark row-center'>
            <a href='marks/audi'><img src='assets/images/marks/audi.png' alt=''></a>
            <h1>Audi</h1>
        </div>
        ";
    }

    public function generateCompareSection ($numberOfForms) {
        echo "
        <form action='compare' method='GET' class='comparer col-center'>
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
                <input type='submit' class='btn' id='btn-compare'>Comparer</a>
            </div>
        </form>
        ";
    }

    public function generateCarForm ($formNumber, $required) {
        echo "
        <div class='compare-form form-box'>
            <label>Vehicule ".$formNumber."</label>
            <hr>
            <div class='formy'>";
                $this->generateCarFormField($formNumber, "Marque", "mark", ["Ford", "Toyota"], $required);
                $this->generateCarFormField($formNumber, "Medel", "model", ["sdf"], $required);
                $this->generateCarFormField($formNumber, "Version", "version", ["sdfs"], $required);
                $this->generateCarFormField($formNumber, "Annee", "year", ["2023"], $required);
        echo "
            </div>
        </div>
        ";
    }

    public static function generateCarFormField($formNumber, $fieldLabel, $fieldName, $data, $required) {
        echo "
        <div class='field input'>
            <label for='".$fieldName.$formNumber."'>".$fieldLabel."</label>
            <select style='width: 100%; height: 40px; font-size: 16px; padding: 0 10px; border-radius: 5px; border: 1px solid #ccc; outline: none;' name='".$fieldName.$formNumber."' ". $required.">";
        echo "<option value='' selected></option>";
        $i = 0;
        while ($i < count($data)) {
            echo "<option value='".$data[$i]."'>".$data[$i]."</option>";
            $i = $i + 1;
        }
        echo " 
            </select>
        </div>
        ";
    }

    public function generateGuide () {
        echo "
        <div class='guide row-bet'>
            <img src='assets/images/guide.png' alt=''>
            <div class='guide-text col-center' style='align-items: left;'>
                <h1>You want to Know more about Guide d'achat</h1>
                <p>
                    Fugiat et incididunt sit nulla repreheepteur proident minim cillum velit mollit
                    asdf.
                    Proident occaecat officia sunt duis pariatur officia Lorem. Consectetur non laboris magna aliquip magna
                    sunt consectetu duis eiusmod incididunt laborum
                    ullamco aliqua.
                </p>
                <a id='btn-compare' href='/guide'>Aller au guide d'achat</a>
            </div>
        </div>
        ";
    }

}
?>