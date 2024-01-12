<?php
require_once __DIR__ . './../admin/admin_template.php';
class AdminMarksView {

    public function generateAdminMarksView ($marks) {
        echo "<main class='row-start'>";
        AdminTemplate::generateSideBar();
        echo "
        <div class='data col-start'>
        ";
        AdminTemplate::generateHeader();
        $this->generateMarksTable($marks);
        echo "</div>";
        echo "</main>";
    }
    public function generateMarksTable ($marks) {
        $this->generateTableHeader();
        $this->generateDataTable($marks);
    }

    public function generateTableHeader () {
        echo "
        <div class='attributes'>
            <table>
                <tr>
                    <th style='width: 16.16%;'>Version</th>
                    <th style='width: 16.16%;'>Vehicule 1</th>
                    <th style='width: 16.16%;'>Vehicule 2</th>
                    <th style='width: 16.16%;'>Vehicule 3</th>
                    <th style='width: 16.16%;'>Vehicule 3</th>
                    <th style='width: 16.16%;'>Vehicule 4</th>
                </tr>
            </table>
        </div>
        ";
    }

    public function generateDataTable ($marks) {
        echo "
        <div class='rows'>
            <table>
        ";
        foreach ($marks as $mark) {
            $this->generateMarkRow($mark);
        }
        echo "
            </table>
        </div>
        ";
    }

    public function generateMarkRow ($mark) {
        echo "
        <tr>
            <td style='width: 16.16%;'>Annee</td>
            <td style='width: 16.16%;'>2021</td>
            <td style='width: 16.16%;'>Vehicule 2</td>
            <td style='width: 16.16%;'>Vehicule 3</td>
            <td style='width: 16.16%;'>Vehicule 3</td>
            <td style='width: 16.16%;'>Vehicule 4</td>
        </tr>
        ";
    }
}

?>