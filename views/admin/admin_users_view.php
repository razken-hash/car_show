<?php
require_once __DIR__ . './../admin/admin_template.php';
class AdminUsersView {

    public function generateAdminUsersView ($users) {
        echo "<div class='adminer row-start'>";
        AdminTemplate::generateSideBar("Users");
        echo "
        <div class='data col-start'>
        ";
        AdminTemplate::generateHeader();
        $this->generateUsersTable($users);
        echo "</div>";
        echo "</div>";
    }
    public function generateUsersTable ($users) {
        $this->generateTableHeader();
        $this->generateDataTable($users);
    }

    public function generateTableHeader () {
        echo "
        <div class='attributes'>
            <table>
                <tr>
                    <th style='width: 6%;'>Id</th>
                    <th style='width: 15%;'>Name</th>
                    <th style='width: 25%;'>Email</th>
                    <th style='width: 13%;'>BirthDate</th>
                    <th style='width: 7%;'>Sex</th>
                    <th style='width: 20%;'>Status</th>
                </tr>
            </table>
        </div>
        ";
    }

    public function generateDataTable ($users) {
        echo "
        <div class='rows'>
            <table>
        ";
        foreach ($users as $user) {
            $this->generateMarkRow($user);
        }
        echo "
            </table>
        </div>
        ";
    }

    public function generateMarkRow ($user) {
        echo "
        <tr>
            <td style='width: 6%; overflow:hidden;'>".$user['userid']."</td>
            <td style='width: 15%; overflow:hidden;'>".$user['firstname']." ".$user['lastname']."</td>
            <td style='width: 25%; overflow:hidden;'>".$user['email']."</td>
            <td style='width: 13%; overflow:hidden;'>".$user['birthdate']."</td>
            <td style='width: 7%; overflow:hidden;'>".$user['sex']."</td>
            <td style='width: 20%; overflow:hidden;'>
            <span>".$user['status']."</span> ";
            if ($user['status'] == "Active") {
                $this->generateUserActionForm($user['userid'], 'block');
            } else if ($user['status'] == "Pending") {
                $this->generateUserActionForm($user['userid'], 'activate');
                $this->generateUserActionForm($user['userid'], 'block');
            } else if ($user['status'] == "Blocked") {
                $this->generateUserActionForm($user['userid'], 'activate');
            }
           echo "</td>
        </tr>
        ";
    }

    public function generateUserActionForm($userid, $action) {
        echo "
        <form style='display:inline;' action='users/".$action,"' method='POST'>
            <input style='display: none;' type='text' name='userid' value='".$userid."'>
            <input type='submit' value='".$action."'>
        </form>
        ";
    }
}

?>