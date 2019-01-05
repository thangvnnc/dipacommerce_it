<?php

namespace App\Http\Controllers;

use App\ZGroups;
use App\ZItems;
use App\ZTypes;
use App\ZMenus;
use Illuminate\Http\Request;

class MainController extends Controller {
    public function __construct() {
    }

    public function index() {
        return view('index', ['menus' => $this->getMenus()]);
    }

    public function types() {
        $queryTypes = ZTypes::query();
        $queryTypes = $queryTypes->orderBy('id', 'asc');
        $types = $queryTypes->get();

        return view('types', ['types' => $types, 'menus' => $this->getMenus()]);
    }

    public function groups(Request $request) {
        $id_type = -1;
        if ($request->has('id_type')) {
            $id_type = $request->get('id_type');
        }

        $queryGroups = ZGroups::query();
        $queryGroups = $queryGroups->where('id_type', $id_type);
        $queryGroups = $queryGroups->orderBy('id', 'asc');
        $groups = $queryGroups->get();

        foreach ($groups as $group) $group->setGlobalItems();

        return view('groups', ['groups'=>$groups, 'menus' => $this->getMenus()]);
    }

    public function items(Request $request) {
        $id_group_item = -1;
        if ($request->has('id_group_item')) {
            $id_group_item = $request->get('id_group_item');
        }

        $items = ZItems::where('id_group_item', $id_group_item)->orderBy('id', 'asc')->get();

        return view('items', ['items' => $items, 'menus' => $this->getMenus()]);
    }

    public function item_detail() {
        return view('item_detail', ['menus' => $this->getMenus()]);
    }

    public function getMenus() {
        $queryMenus = ZMenus::query();
        $queryMenus = $queryMenus->where('status', 1)->orderBy('id', 'asc');
        return $queryMenus->get();
    }

//    public function test() {
//        $queryMenus = ZMenus::query();
//        $queryMenus = $queryMenus->where('status', 1)->orderBy('id', 'asc');
//        $menus = $queryMenus->get();
//        return json_encode($menus);
//    }

}
