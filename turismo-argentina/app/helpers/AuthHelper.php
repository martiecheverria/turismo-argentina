<?php
class AuthHelper {
    public static function verify() {
        if (session_status() != PHP_SESSION_ACTIVE ) {
            session_start();
        }
        if (!isset($_SESSION['USER_ID'])) {
            header("Location: " . BASE_URL . "login");
            die();
        }
    }
}