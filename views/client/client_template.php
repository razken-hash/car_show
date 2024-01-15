<?php
    class ClientTemplate {

        public static function generateHeader($isAuth) {
            echo "
            <header class='row-bet'>
                <div class='logo row-center'>
                    <img class='logo-image' src='/car_show/assets/images/logo.png' alt='Logo'>
                    <span class='logo-name'>arShow</span>
                </div>
                <div class='social'>
                    <a class='social-item' href=''><img src='/car_show/assets/icons/facebook.svg' alt='Facebook'></a>
                    <a class='social-item' href=''><img src='/car_show/assets/icons/instagram.svg' alt='Instagram'></a>
                    <a class='social-item' href=''><img src='/car_show/assets/icons/twitter.svg' alt='Twitter'></a>
                    <a class='social-item' href=''><img src='/car_show/assets/icons/youtube.svg' alt='Youtube'></a>
                </div>
            ";
            if ($isAuth) {
                echo "
                <div class='profile col-center'>
                    <a href='/auth/profile'><img class='profile-image' src='/car_show/assets/icons/profile.svg' alt='Profile'></a>
                    <span>My Profile</span>
                </div>
                ";
            } else {
                echo "
                <div class='auth'>
                    <a class='btn' href='auth/login'>Se Connecter</a>
                    <a class='btn btn-cancel' href='auth/register'>S'inscrire</a>
                </div>
                ";
            }
            echo "
            </header>
            ";
        }

        public static function generateMenu () {
            echo "
            <nav class='menu'>
                <ul class='menu-items row-center'>
                    <li class='menu-item'><a href='home'>Accueil</a></li>
                    <li class='menu-item'><a href='news'>News</a></li>
                    <li class='menu-item'><a href='compare'>Comparateur</a></li>
                    <li class='menu-item'><a href='marks'>Marques</a></li>
                    <li class='menu-item'><a href='reviews'>Avis</a></li>
                    <li class='menu-item'><a href='guide'>Guide d'Achat</a></li>
                    <li class='menu-item'><a href='contact'>Contact</a></li>
                </ul>
            </nav>
            ";
        }
        public static function generateFooter () {
            echo "
            <footer>
                Footer
            </footer>
            ";
        }
    }


?>