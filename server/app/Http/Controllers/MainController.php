<?php

namespace App\Http\Controllers;

use App\ZAccessoriGroup;
use App\ZAccessoriItem;
use App\ZAccessoriType;
use App\ZMenu;
use Illuminate\Http\Request;

class MainController extends Controller {
    public function __construct() {
    }

    public function index() {
        $queryMenus = ZMenu::query();
        $queryMenus = $queryMenus->where('status', 1)->orderBy('id', 'asc');
        $menus = $queryMenus->get();
        return view('index', ['menus' => $menus]);
    }

    public function accessori_type() {
        $queryAccessoriType = ZAccessoriType::query();
        $queryAccessoriType = $queryAccessoriType->orderBy('id', 'asc');
        $accessoriTypes = $queryAccessoriType->get();

        return view('accessori_type', ['accessoriTypes' => $accessoriTypes]);
    }

    public function accessori_group() {
        $queryAccessoriGroup = ZAccessoriGroup::query();
        $queryAccessoriGroup = $queryAccessoriGroup->orderBy('id', 'asc');
        $accessoriGroups = $queryAccessoriGroup->get();

        foreach ($accessoriGroups as $accessoriGroup) $accessoriGroup->setGlobalItems();

        return view('accessori_group', ['accessoriGroups'=>$accessoriGroups]);
    }

    public function accessori_item(Request $request) {
        $item_group = -1;
        if ($request->has('item_group')) {
            $item_group = $request->get('item_group');
        }

        $items = ZAccessoriItem::where('id_group_item', $item_group)->orderBy('id', 'asc')->get();

        return view('accessori_item', ['items' => $items]);
    }

    public function accessori_item_detail() {
        return view('accessori_item_detail');
    }

    public function test() {
        $queryMenus = ZMenu::query();
        $queryMenus = $queryMenus->where('status', 1)->orderBy('id', 'asc');
        $menus = $queryMenus->get();
        return json_encode($menus);
    }
}
