<?php
    class AuthView {
        public function showRegisterView () {
            echo "User Register View";
        }
        public function showLoginView () {
            echo "
            <form action='login' method='POST'>
                <div class='form-box'>
                    <label>Register</label>
                    <hr>
                    <div class='formy'>
                        <div class='field input'>
                            <label for='email'>Email</label>
                            <input type='text' name='email'>
                        </div>
                        <div class='field input'>
                            <label for='password'>Password</label>
                            <input type='password' name='password'>
                        </div>
                        <div class='field input'>
                            <input type='submit' value='Submit'>
                        </div>
                    </div>
                </div>
            </form>
            ";
        }
    }
?>