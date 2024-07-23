<?php

namespace App\Session;

class Login {

    private static function init() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function getUserLogged() {
        self::init();

        return self::isLogged() ? $_SESSION['user'] : null;
    }

    public static function login($user) {
        self::init();

        $_SESSION['user'] = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];

        header('Location: index.php');
        exit;
    }

    public static function logout() {
        self::init();

        unset($_SESSION['user']);

        header('Location: login.php');
        exit;
    }

    public static function isLogged() {
        self::init();

        return isset($_SESSION['user']['id']);
    }

    public static function requireLogin() {
        if (!self::isLogged()) {
            header('Location: login.php');
            exit;
        }
    }

    public static function requireLogout() {
        if (self::isLogged()) {
            header('Location: index.php');
            exit;
        }
    }
}