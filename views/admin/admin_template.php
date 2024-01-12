<?php 

class AdminTemplate {
    public static function generateSideBar () {
        echo "
        <div class='items col-start-center'>
            <div class='logo row-center'>
                <img class='logo-image' src='assets/images/logo.png' alt='Logo'>
                <span class='logo-name'>arShow Admin</span>
            </div>
            <a href='' class='item'>Marks</a>
            <a href='' class='item'>Cars</a>
            <a href='' class='item'>News</a>
            <a href='' class='item'>Reviews</a>
            <a href='' class='item'>Contacts</a>
            <a href='' class='item'>Users</a>
        </div>
        ";
    }

    public static function generateHeader() {
        echo "
        <div class='control row-bet'>
            <h1>Marks</h1>
            <input type='text'>
            <div class='profile row-center'>
                <a href='/auth/profile'><img class='profile-image' src='assets/icons/profile.svg' alt='Profile'></a>
                <div class='admin-info col-start'>
                    <span>KENNICHE ABDERRAZAK</span>
                    <span>Admin</span>
                </div>
            </div>
        </div>
        ";
    }
}

?>