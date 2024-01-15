<?php
require_once __DIR__ . './../admin/admin_template.php';
class AdminNewsView {

    public function generateAdminNewsView ($news) {
        echo "<div class='adminer row-start'>";
        AdminTemplate::generateSideBar("News");
        echo "
        <div class='data col-start'>
        ";
        AdminTemplate::generateHeader();
        $this->generateNewsTable($news);
        echo "</div>";
        echo "</div>";
    }
    public function generateNewsTable ($news) {
        $this->generateTableHeader();
        $this->generateDataTable($news);
    }

    public function generateTableHeader () {
        echo "
        <div class='attributes'>
            <table>
                <tr>
                    <th style='width: 5%;'>Id</th>
                    <th style='width: 20%;'>Image</th>
                    <th style='width: 20%;'>Title</th>
                    <th style='width: 20%;'>Summary</th>
                    <th style='width: 35%;'>Content</th>
                </tr>
            </table>
        </div>
        ";
    }

    public function generateDataTable ($news) {
        echo "
        <div class='rows'>
            <table>
        ";
        foreach ($news as $new) {
            $this->generateNewsRow($new);
        }
        echo "
            </table>
        </div>
        ";
    }

    public function generateNewsRow ($news) {
        echo "
        <tr>
            <td style='width: 5%; overflow:hidden;'>".$news['newsid']."</td>
            <td style='width: 20%; overflow:hidden;'>".$news['image']." ".$news['lastname']."</td>
            <td style='width: 20%; overflow:hidden;'>".$news['title']."</td>
            <td style='width: 20%; overflow:hidden;'>".$news['summary']."</td>
            <td style='width: 35%; overflow:hidden;'>
            <span>".$news['content']."</span> ";
            $this->generateNewsActionForm($news['newsid'], 'update');
            $this->generateNewsActionForm($news['newsid'], 'delete');
           echo "</td>
        </tr>
        ";
    }

    public function generateNewsActionForm($newsid, $action) {
        echo "
        <form style='display:inline;' action='news/".$action,"' method='POST'>
            <input style='display: none;' type='text' name='newsid' value='".$newsid."'>
            <input type='submit' value='".$action."'>
        </form>
        ";
    }
}

?>