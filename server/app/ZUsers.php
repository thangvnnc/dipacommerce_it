<?php
/**
 * Created by PhpStorm.
 * User: Thang
 * Date: 1/5/2019
 * Time: 3:35 PM
 */

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class ZUsers extends Model {
    public $timestamps = false;

    protected $table = 'z_users';
    protected $fillable = ['id', 'name', 'username', 'password', 'status', 'last_login', 'created_at'];

    public static function makePassword($password) {
        return Hash::make($password);
    }

    public static function login($username, $password) {
        $queryZUsers = ZUsers::query();
        $queryZUsers = $queryZUsers->where('username', $username);
        $queryZUsers = $queryZUsers->where('status', 1);
        $zUser = $queryZUsers->first();
        if($zUser == null) return null;

        if (!Hash::check($password, $zUser->password)) {
            return null;
        }

        $zUser->last_login = new DateTime();
        $zUser->save();
        return $zUser;
    }

    public static function createUsers($username, $password, $name) {
        $zUser = new ZUsers();
        $zUser->username = $username;
        $zUser->password = ZUsers::makePassword($password);
        $zUser->name = $name;
        $zUser->save();
    }
}
