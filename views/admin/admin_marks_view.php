<?php
require_once __DIR__ . './../admin/admin_template.php';
require_once __DIR__ . './../shared/components.php';
require_once __DIR__ . './../../utils.php';
class AdminMarksView {

    public function generateAdminMarksView ($marks) {
        echo "<div class='adminer row-start'>";
        AdminTemplate::generateSideBar("Marks");
        echo "
        <div class='data col-start'>
        ";
        AdminTemplate::generateHeader();
        echo "<a href='marks/create'>Create Mark</a>";
        $this->generateMarksTable($marks);
        echo "</div>";
        echo "</div>";
    }

    public function generateAdminMarkFormView($title, $action, $confirm, $mark) {
        echo "<div class='adminer row-start'>";
        AdminTemplate::generateSideBar("Marks");
        echo "
        <div class='data col-start'>
        ";
        AdminTemplate::generateHeader();
        $this->generateCreateMarkForm($title, $action, $confirm, $mark);
        echo "</div>";
        echo "</div>";
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
                    <th style='width: 10%;'>Id</th>
                    <th style='width: 18%;'>Name</th>
                    <th style='width: 18%;'>Country</th>
                    <th style='width: 18%;'>HeadOffice</th>
                    <th style='width: 18%;'>Foundation yeat</th>
                    <th style='width: 18%;'>Logo</th>
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
            <td style='width: 10%;'>".$mark['markid']."</td>
            <td style='width: 18%;'>".$mark['markname']."</td>
            <td style='width: 18%;'>".$mark['country']."</td>
            <td style='width: 18%;'>".$mark['headoffice']."</td>
            <td style='width: 18%;'>".$mark['foundyear']."</td>
            <td style='width: 20%; overflow:hidden;'>"
            .$mark['logo']." ";
            $this->generateMarkActionForm($mark['markid'], 'update');
            $this->generateMarkActionForm($mark['markid'], 'delete');
        echo "
            </td>
        </tr>";
    }

    public function generateMarkActionForm($markid, $action) {
        $method = $action === 'update' ? 'GET' : 'POST';
        echo "
        <form action='marks/".$action."' method='".$method."'>
            <input style='display: none;' type='text' name='markid' value='".$markid."'>
            <button type='submit'><img src='/car_show/assets/icons/".$action.".svg' /></button>
        </form>
        ";
    }

    public function generateCreateMarkForm($title, $action, $confirm, $mark) {
        echo "
        <div class='create'>
            <form action='".$action."' method='POST'>
                <div class='title col-even-center'>
                    <label>".$title."</label>
                    <hr style='width: 70%'>
                </div>
                <div class='formy col-even-center'>
                    <input style='display: none;' name='markid' type='text' value='".$mark['markid']."'>
                    <div class='field input col-start'>
                        <label for='markname'>Model name</label>
                        <input name='markname' type='text' value='".$mark['markname']."'>
                    </div>";
        Components::generateSelectField("Country", "country", Utils::$countries, $mark['country']);
        echo "
                    <div class='field input col-start'>
                        <label for='headoffice'>HeadOffice</label>
                        <input name='headoffice' type='text' value='".$mark['headoffice']."'>
                    </div>                 
        ";
        Components::generateSelectField("Foundation year", "foundyear", range(1900, 2024), $mark['foundyear']);
        echo "
                    <div class='field input col-start'>
                            <label for='logo'>Logo</label>
                            <input name='logo' type='text' value='".$mark['logo']."'>
                    </div>
                </div>
                <div class='decision row-center'>
                    <a href='admin/cars' class='btn-cancel row-center'>Cancel</a>
                    <input type='submit' class='btn-submit row-center' value='".$confirm."'/>
                </div>
            </form>
        </div>
        ";
    }
}

?>