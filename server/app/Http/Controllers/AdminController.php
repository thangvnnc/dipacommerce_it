<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckUser;
use App\Message\Messages;
use App\ZGroups;
use App\ZGroupItems;
use App\ZItems;
use App\ZTypes;
use App\ZMenus;
use App\ZUsers;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

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
        return view('admin.groups', ['groups' => $this->getGroups(), 'types' => $this->getTypes()]);
    }

    public function group_add(Request $request) {
        return view('admin.groups', ['groups' => $this->getGroups(), 'types' => $this->getTypes()]);
    }

    public function group_edit(Request $request) {
        return view('admin.groups', ['groups' => $this->getGroups(), 'types' => $this->getTypes()]);
    }

    public function group_del(Request $request) {
        return view('admin.groups', ['groups' => $this->getGroups(), 'types' => $this->getTypes()]);
    }

    public function group_items() {
        return view('admin.group_items', ['group_items' => $this->getGroupItems(), 'groups' => $this->getGroups()]);
    }

    public function group_item_add(Request $request) {
        return view('admin.group_items', ['group_items' => $this->getGroupItems(), 'groups' => $this->getGroups()]);
    }

    public function group_item_edit(Request $request) {
        return view('admin.group_items', ['group_items' => $this->getGroupItems(), 'groups' => $this->getGroups()]);
    }

    public function group_item_del(Request $request) {
        return view('admin.group_items', ['group_items' => $this->getGroupItems(), 'groups' => $this->getGroups()]);
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

    public function type_add(Request $request) {
        return redirect()->route('admin.types');
    }

    public function type_edit(Request $request) {
        return redirect()->route('admin.types');
    }

    public function type_del(Request $request) {
        return redirect()->route('admin.types');
    }

    public function items() {
        return view('admin.items', ['group_items' => $this->getGroupItems(), 'items' => $this->getItems()]);
    }

    public function item_add(Request $request) {
        return view('admin.items', ['group_items' => $this->getGroupItems(), 'items' => $this->getItems()]);
    }

    public function item_edit(Request $request) {
        return view('admin.items', ['group_items' => $this->getGroupItems(), 'items' => $this->getItems()]);
    }

    public function item_del(Request $request) {
        return view('admin.items', ['group_items' => $this->getGroupItems(), 'items' => $this->getItems()]);
    }

    public function post_type_add(Request $request) {
        if($request->has('add-name') == false || $request->has('add-code') == false || $request->hasFile('add-img') == false) {
            return view('admin.types', ['types' => $this->getTypes(), 'message' => Messages::miss_prameters()]);
        }

        $name = $request->get('add-name');
        $code = $request->get('add-code');

        $queryTypes = ZTypes::where('code', $code);
        $itemGetTypeByCode = $queryTypes->first();
        if($itemGetTypeByCode != null) {
            return view('admin.types', ['types' => $this->getTypes(), 'message' => Messages::code_exist()]);
        }

        $zType = new ZTypes();
        $zType->content = $name;
        $zType->code = $name;

        $image = $request->file('add-img');
        $filename = time().'.'.$image->getClientOriginalExtension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(222, 90);
        $image_resize->save('public/accessori_type/'.$filename);

        $filepath = '/accessori_type/'.$filename;
        $zType->image = 'public'.$filepath;
        $zType->save();

        return redirect()->route('admin.types');
    }

    public function post_type_edit(Request $request) {
        if ($request->has('edit-id') == false || $request->has('edit-name') == false || $request->has('edit-code') == false) {
            return view('admin.types', ['types' => $this->getTypes(), 'message' => Messages::miss_prameters()]);
        }

        $id = $request->get('edit-id');
        $name = $request->get('edit-name');
        $code = $request->get('edit-code');

        $types = ZTypes::where('code', $code)->get();
        foreach ($types as $type) {
            if($type->id != $id) {
                return view('admin.types', ['types' => $this->getTypes(), 'message' => Messages::code_exist()]);
            }
        }

        $queryTypes = ZTypes::where('id', $id);
        $itemGetTypeByCode = $queryTypes->first();
        $itemGetTypeByCode->code = $code;
        $itemGetTypeByCode->content = $name;
        $itemGetTypeByCode->save();

        if($request->hasFile('edit-img')) {
            unlink($itemGetTypeByCode->image);

            $image = $request->file('edit-img');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(222, 90);
            $image_resize->save('public/accessori_type/'.$filename);

            $filepath = '/accessori_type/'.$filename;
            $itemGetTypeByCode->image = 'public'.$filepath;
            $itemGetTypeByCode->save();
        }

        return redirect()->route('admin.types');
    }

    public function post_type_del(Request $request) {
        if ($request->has('del-id') == false) {
            return view('admin.types', ['types' => $this->getTypes(), 'message' => Messages::miss_prameters()]);
        }

        $id = $request->get('del-id');

        $groupBelongToType = ZGroups::where('id_type', $id)->get();
        if(count($groupBelongToType) > 0) {
            return view('admin.types', ['types' => $this->getTypes(), 'message' => Messages::fk_type()]);
        }

        $queryTypes = ZTypes::where('id', $id);
        $itemGetTypeByCode = $queryTypes->first();

        unlink($itemGetTypeByCode->image);
        $itemGetTypeByCode->delete();

        return redirect()->route('admin.types');
    }

    public function post_group_add(Request $request) {
        if($request->has('add-id-type') == false || $request->has('add-name') == false || $request->has('add-code') == false || $request->hasFile('add-img') == false) {
            return view('admin.groups', ['types' => $this->getTypes(), 'groups' => $this->getGroups(), 'message' => Messages::miss_prameters()]);
        }

        $name = $request->get('add-name');
        $code = $request->get('add-code');
        $id_type = $request->get('add-id-type');

        $queryGroups = ZGroups::where('code', $code);
        $itemGetTypeByCode = $queryGroups->first();
        if($itemGetTypeByCode != null) {
            return view('admin.groups', ['types' => $this->getTypes(), 'groups' => $this->getGroups(), 'message' => Messages::code_exist()]);
        }

        $zGroups = new ZGroups();
        $zGroups->content = $name;
        $zGroups->id_type = $id_type;
        $zGroups->code = $name;

        $image = $request->file('add-img');
        $filename = time().'.'.$image->getClientOriginalExtension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(222, 90);
        $image_resize->save('public/accessori_group_files/'.$filename);

        $filepath = '/accessori_group_files/'.$filename;
        $zGroups->image = 'public'.$filepath;
        $zGroups->save();

        return redirect()->route('admin.groups');
    }

    public function post_group_edit(Request $request) {
        if ($request->has('edit-id-type') == false || $request->has('edit-id') == false || $request->has('edit-name') == false || $request->has('edit-code') == false) {
            return view('admin.groups', ['types' => $this->getTypes(), 'groups' => $this->getGroups(), 'message' => Messages::miss_prameters()]);
        }

        $id = $request->get('edit-id');
        $name = $request->get('edit-name');
        $code = $request->get('edit-code');
        $id_type = $request->get('edit-id-type');

        $groups = ZGroups::where('code', $code)->get();
        foreach ($groups as $group) {
            if($group->id != $id) {
                return view('admin.groups', ['types' => $this->getTypes(), 'groups' => $this->getGroups(), 'message' => Messages::code_exist()]);
            }
        }

        $queryGroups = ZGroups::where('id', $id);
        $itemGetGroupsByCode = $queryGroups->first();
        $itemGetGroupsByCode->code = $code;
        $itemGetGroupsByCode->content = $name;
        $itemGetGroupsByCode->id_type = $id_type;
        $itemGetGroupsByCode->save();

        if($request->hasFile('edit-img')) {
            unlink($itemGetGroupsByCode->image);

            $image = $request->file('edit-img');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(222, 90);
            $image_resize->save('public/accessori_group_files/'.$filename);

            $filepath = '/accessori_group_files/'.$filename;
            $itemGetGroupsByCode->image = 'public'.$filepath;
            $itemGetGroupsByCode->save();
        }

        return redirect()->route('admin.groups');
    }

    public function post_group_del(Request $request) {
        if ($request->has('del-id') == false) {
            return view('admin.groups', ['types' => $this->getTypes(), 'groups' => $this->getGroups(), 'message' => Messages::miss_prameters()]);
        }

        $id = $request->get('del-id');

        $groupItemsBelongToGroup = ZGroupItems::where('id_group', $id)->get();
        if(count($groupItemsBelongToGroup) > 0) {
            return view('admin.groups', ['types' => $this->getTypes(), 'groups' => $this->getGroups(), 'message' => Messages::fk_group()]);
        }

        $queryGroups = ZGroups::where('id', $id);
        $itemGetGroupByCode = $queryGroups->first();

        unlink($itemGetGroupByCode->image);
        $itemGetGroupByCode->delete();

        return redirect()->route('admin.groups');
    }

    public function post_group_item_add(Request $request) {
        if($request->has('add-id-group') == false || $request->has('add-name') == false || $request->has('add-code') == false) {
            return view('admin.group_items', ['group_items' => $this->getGroupItems(), 'groups' => $this->getTypes(), 'message' => Messages::miss_prameters()]);
        }

        $name = $request->get('add-name');
        $code = $request->get('add-code');
        $id_group = $request->get('add-id-group');

        $queryGroups = ZGroups::where('code', $code);
        $itemGetTypeByCode = $queryGroups->first();
        if($itemGetTypeByCode != null) {
            return view('admin.group_items', ['group_items' => $this->getGroupItems(), 'groups' => $this->getTypes(), 'message' => Messages::code_exist()]);
        }

        $zGroup_items = new ZGroupItems();
        $zGroup_items->content = $name;
        $zGroup_items->id_group = $id_group;
        $zGroup_items->code = $name;
        $zGroup_items->save();

        return redirect()->route('admin.group_items');
    }

    public function post_group_item_edit(Request $request) {
        if ($request->has('edit-id-group') == false || $request->has('edit-id') == false || $request->has('edit-name') == false || $request->has('edit-code') == false) {
            return view('admin.group_items', ['group_items' => $this->getGroupItems(), 'groups' => $this->getTypes(), 'message' => Messages::miss_prameters()]);
        }

        $id = $request->get('edit-id');
        $name = $request->get('edit-name');
        $code = $request->get('edit-code');
        $id_group = $request->get('edit-id-group');

        $group_items = ZGroupItems::where('code', $code)->get();
        foreach ($group_items as $group_item) {
            if($group_item->id != $id) {
                return view('admin.group_items', ['group_items' => $this->getGroupItems(), 'groups' => $this->getTypes(), 'message' => Messages::code_exist()]);
            }
        }

        $queryGroupItems = ZGroupItems::where('id', $id);
        $itemGetGroupItemsByCode = $queryGroupItems->first();
        $itemGetGroupItemsByCode->code = $code;
        $itemGetGroupItemsByCode->content = $name;
        $itemGetGroupItemsByCode->id_group = $id_group;
        $itemGetGroupItemsByCode->save();

        return redirect()->route('admin.group_items');
    }

    public function post_group_item_del(Request $request) {
        if ($request->has('del-id') == false) {
            return view('admin.group_items', ['group_items' => $this->getGroupItems(), 'groups' => $this->getTypes(), 'message' => Messages::miss_prameters()]);
        }

        $id = $request->get('del-id');

        $queryGroupItems = ZGroupItems::where('id', $id);
        $itemGetGroupItemByCode = $queryGroupItems->first();
        $itemGetGroupItemByCode->delete();

        return redirect()->route('admin.group_items');
    }

    public function post_item_add(Request $request) {
        if (
            $request->has('add-id-group_item') == false ||
            $request->has('add-name') == false ||
            $request->has('add-code') == false ||
            $request->has('add-content') == false ||
            $request->has('add-price') == false ||
            $request->has('add-status') == false ||
            $request->hasFile('add-img-product') == false ||
            $request->hasFile('add-img-equipementier') == false
        ) {
            return view('admin.items', ['group_items' => $this->getGroupItems(), 'items' => $this->getItems(), 'message' => Messages::miss_prameters()]);
        }

        $name = $request->get('add-name');
        $code = $request->get('add-code');
        $content = $request->get('add-content');
        $price = $request->get('add-price');
        $status = $request->get('add-status');
        $id_group_item = $request->get('add-id-group_item');

        $queryItems = ZItems::where('code', $code);
        $itemGetTypeByCode = $queryItems->first();
        if ($itemGetTypeByCode != null) {
            return view('admin.items', ['group_items' => $this->getGroupItems(), 'items' => $this->getItems(), 'message' => Messages::code_exist()]);
        }

        $zItems = new ZItems();
        $zItems->content = $content;
        $zItems->id_group_item = $id_group_item;
        $zItems->code = $code;
        $zItems->name = $name;
        $zItems->price = $price;
        $zItems->status = $status;

        $image = $request->file('add-img-product');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(200, 200);
        $image_resize->save('public/accessori_item_files/' . $filename);
        $filepath = '/accessori_item_files/' . $filename;
        $zItems->image = 'public' . $filepath;

        sleep(1);

        $imageEquipementier = $request->file('add-img-equipementier');
        $filenameEquipementier = time() . '.' . $imageEquipementier->getClientOriginalExtension();
        $imageEquipementier_resize = Image::make($imageEquipementier->getRealPath());
        $imageEquipementier_resize->resize(100, 50);
        $imageEquipementier_resize->save('public/accessori_item_files/' . $filenameEquipementier);
        $filepathEquipementier = '/accessori_item_files/' . $filenameEquipementier;
        $zItems->logo_equipementier = 'public' . $filepathEquipementier;

        $zItems->save();

        return redirect()->route('admin.items');
    }

    public function post_item_edit(Request $request) {
        if (
            $request->has('edit-id-group_item') == false ||
            $request->has('edit-id') == false ||
            $request->has('edit-name') == false ||
            $request->has('edit-code') == false ||
            $request->has('edit-content') == false ||
            $request->has('edit-price') == false ||
            $request->has('edit-status') == false
        ) {
            return view('admin.items', ['group_items' => $this->getGroupItems(), 'items' => $this->getItems(), 'message' => Messages::miss_prameters()]);
        }

        $id = $request->get('edit-id');
        $name = $request->get('edit-name');
        $code = $request->get('edit-code');
        $price = $request->get('edit-price');
        $content = $request->get('edit-content');
        $status = $request->get('edit-status');
        $id_group_item = $request->get('edit-id-group_item');

        $items = ZItems::where('code', $code)->get();
        foreach ($items as $item) {
            if($item->id != $id) {
                return view('admin.items', ['group_items' => $this->getGroupItems(), 'items' => $this->getItems(), 'message' => Messages::code_exist()]);
            }
        }

        $queryItems = ZItems::where('id', $id);
        $itemGetItemsByCode = $queryItems->first();
        $itemGetItemsByCode->code = $code;
        $itemGetItemsByCode->name = $name;
        $itemGetItemsByCode->price = $price;
        $itemGetItemsByCode->content = $content;
        $itemGetItemsByCode->status = $status;
        $itemGetItemsByCode->id_group_item = $id_group_item;
        $itemGetItemsByCode->save();

        if($request->hasFile('edit-img-product')) {
            unlink($itemGetItemsByCode->image);

            $image = $request->file('edit-img-product');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200, 200);
            $image_resize->save('public/accessori_item_files/' . $filename);
            $filepath = '/accessori_item_files/' . $filename;
            $itemGetItemsByCode->image = 'public'.$filepath;
            $itemGetItemsByCode->save();
            sleep(1);
        }

        if($request->hasFile('edit-img-equipementier')) {
            unlink($itemGetItemsByCode->logo_equipementier);
            $imageEquipementier = $request->file('edit-img-equipementier');
            $filenameEquipementier = time() . '.' . $imageEquipementier->getClientOriginalExtension();
            $imageEquipementier_resize = Image::make($imageEquipementier->getRealPath());
            $imageEquipementier_resize->resize(100, 50);
            $imageEquipementier_resize->save('public/accessori_item_files/' . $filenameEquipementier);
            $filepathEquipementier = '/accessori_item_files/' . $filenameEquipementier;
            $itemGetItemsByCode->logo_equipementier = 'public' . $filepathEquipementier;
            $itemGetItemsByCode->save();
        }

        return redirect()->route('admin.items');
    }

    public function post_item_del(Request $request) {
        if ($request->has('del-id') == false) {
            return view('admin.items', ['group_items' => $this->getGroupItems(), 'items' => $this->getItems(), 'message' => Messages::miss_prameters()]);
        }

        $id = $request->get('del-id');

        $itemsBelongToGroupItem = ZItems::where('id_group_item', $id)->get();
        if(count($itemsBelongToGroupItem) > 0) {
            return view('admin.items', ['group_items' => $this->getGroupItems(), 'items' => $this->getItems(), 'message' => Messages::fk_group_item()]);
        }

        $queryItems = ZItems::where('id', $id);
        $itemGetItemByCode = $queryItems->first();

        unlink($itemGetItemByCode->image);
        unlink($itemGetItemByCode->logo_equipementier);
        $itemGetItemByCode->delete();

        return redirect()->route('admin.items');
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
        $queryGroupItems = ZGroupItems::query();
        $queryGroupItems = $queryGroupItems->orderBy('id', 'asc');
        return $queryGroupItems->get();
    }

    public function getItems() {
        $queryItems = ZItems::query();
        $queryItems = $queryItems->orderBy('id', 'asc');
        return $queryItems->get();
    }
}
