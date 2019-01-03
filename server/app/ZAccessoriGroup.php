<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZAccessoriGroup extends Model {
    protected $table = 'z_accessori_group';
	protected $fillable = ['id', 'image', 'created_at'];
    public $items = [];

    public function __construct() {
    }

    public function setGlobalItems() {
        $this->items = ZAccessoriGroupItem::where('group_id', $this->id)->orderBy('id', 'asc')->get();
        foreach ($this->items as $item) $item->setGlobalCountItems();
    }
}
