<?php
class AuthView {
    public function showLogin($error = null) {
        require_once  'templates/header.phtml';
        require_once  'templates/login.phtml'; 
        require_once  'templates/footer.phtml';
    }
    public function showRegisterForm($error = null) {
        require_once 'templates/header.phtml';
        require_once 'templates/register.phtml';
        require_once 'templates/footer.phtml';
    }
}