<?php

namespace App\Http\Controllers;

use App\ZAccessoriGroup;
use App\ZAccessoriItem;
use App\ZAccessoriType;
use App\ZMenu;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct() {
    }

    public function index() {
        // Check session
        if (false) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('admin.login');
        }
    }

    public function login() {
        return view('admin.login');
    }

    public function home() {
        return view('admin.home');
    }
}
