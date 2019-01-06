<?php
/**
 * Created by PhpStorm.
 * User: Thang
 * Date: 1/5/2019
 * Time: 3:20 PM
 */

namespace App\Message;

class Messages {
    // Type
    public static function code_exist() {
        return new Message(3, "The code has been duplicated");
    }

    // Common
    public static function miss_prameters() {
        return new Message(2, "System error please contact your administrator");
    }

    // Login
    public static function login_incorrect() {
        return new Message(1, "Username or password is incorrect");
    }
}
