<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckUser;
use App\Message\Messages;
use App\ZGroups;
use App\ZGroupItem;
use App\ZItems;
use App\ZTypes;
use App\ZMenus;
use App\ZUsers;
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

    public function login(Request $request) {
        if(CheckUser::getSession($request) != null) {
            return redirect()->route('admin.home');
        }
        return view('admin.login');
    }

    public function home() {
        return view('admin.home');
    }

    public function menus() {
        return view('admin.menus', ['menus' => $this->getMenus()]);
    }

    public function types() {
        return view('admin.types', ['types' => $this->getTypes()]);
    }

    public function groups() {
        return view('admin.groups', ['groups' => $this->getGroups()]);
    }

    public function group_items() {
        return view('admin.group_items', ['group_items' => $this->getGroupItems()]);
    }

    public function items() {
        return view('admin.items', ['items' => $this->getItems()]);
    }

    public function postLogin(Request $request) {
        if($request->has('username') == false || $request->has('password') == false) {
            return view('admin.login', ['message' => Messages::miss_prameters()]);
        }

        $username = $request->username;
        $password = $request->password;
        $zUser = ZUsers::login($username, $password);

        if($zUser != null) {
            CheckUser::setSession($request, $zUser);
            return redirect()->route('admin.home');
        }
        else {
            return view('admin.login', ['message' => Messages::login_incorrect()]);
        }
    }

    public function logout(Request $request) {
        CheckUser::clearAllSession($request);
        return redirect()->route('admin.login');
    }

    public function getMenus() {
        $queryMenus = ZMenus::query();
        $queryMenus = $queryMenus->orderBy('id', 'asc');
        return $queryMenus->get();
    }

    public function getTypes() {
        $queryTypes = ZTypes::query();
        $queryTypes = $queryTypes->orderBy('id', 'asc');
        return $queryTypes->get();
    }

    public function getGroups() {
        $queryGroups = ZGroups::query();
        $queryGroups = $queryGroups->orderBy('id', 'asc');
        return $queryGroups->get();
    }

    public function getGroupItems() {
        $queryGroupItems = ZGroupItem::query();
        $queryGroupItems = $queryGroupItems->orderBy('id', 'asc');
        return $queryGroupItems->get();
    }

    public function getItems() {
        $queryItems = ZItems::query();
        $queryItems = $queryItems->orderBy('id', 'asc');
        return $queryItems->get();
    }
}
