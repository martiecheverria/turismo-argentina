<?php
require_once dirname(__DIR__) . '/models/UserModel.php';
require_once dirname(__DIR__) . '/views/AuthView.php';

class AuthController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }


    public function showLogin($error = null) {
        $this->view->showLogin($error);
    }


    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($email) || empty($password)) {
            $this->view->showLogin("Faltan completar datos");
            return;
        }
        $user = $this->model->getUserByEmail($email);
        if ($user && password_verify($password, $user->password)) {
            session_start();
            $_SESSION['USER_ID'] = $user->id_usuario;
            $_SESSION['USER_EMAIL'] = $user->email;
            $_SESSION['USER_ROLE'] = $user->rol;
            
            header("Location: " . BASE_URL . "home");
        } else {
            $this->view->showLogin("Usuario o contraseña incorrectos");
        }
    }

    public function showRegisterForm() {
        $this->view->showRegisterForm();
    }

    public function registerUser() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            $this->view->showRegisterForm("Faltan completar datos");
            return;
        }
        
        $existingUser = $this->model->getUserByEmail($email);
        if ($existingUser) {
            $this->view->showRegisterForm("El email ya se encuentra registrado.");
            return;
        }

        $this->model->insertUser($email, $password);
        header("Location: " . BASE_URL . "login");
    }

    public function logout() {
        session_destroy();
        header("Location: " . BASE_URL . "login");
    }
}