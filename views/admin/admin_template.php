<?php 

class AdminTemplate { 
    public static function generateSideBar ($currentMenu) {
        echo "
        <div class='items col-start-center'>
            <div class='logo row-center'>
                <img class='logo-image' src='/car_show/assets/images/logo.png' alt='Logo'>
                <span class='logo-name'>arShow Admin</span>
            </div>
            <a href='marks' class='item selectedItem' >Marks</a>
            <a href='cars' class='item'>Cars</a>
            <a href='news' class='item'>News</a>
            <a href='reviews' class='item'>Reviews</a>
            <a href='contacts' class='item'>Contacts</a>
            <a href='users' class='item'>Users</a>
        </div>
        ";
    }

    public static function generateHeader() {
        echo "
        <div class='control row-bet'>
            <h1>Marks</h1>
            <input class='search' type='text'>
            <div class='profile row-center'>
                <a href='/auth/profile'><img class='profile-image' src='/car_show/assets/icons/profile.svg' alt='Profile'></a>
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