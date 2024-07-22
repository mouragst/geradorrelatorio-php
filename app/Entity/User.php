<?php

namespace App\Entity;

use App\Db\Database;

class User {

    public $id;
    public $email;
    public $password;
    
    public static function getUserByEmail($email) {
        return (new Database('users'))->select(' email = "'.$email.'"')->fetchObject(self::class);
    }
}
