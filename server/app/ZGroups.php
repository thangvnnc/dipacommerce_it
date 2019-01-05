<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZGroups extends Model {
    protected $table = 'z_groups';
	protected $fillable = ['id', 'id_type', 'image', 'content', 'created_at'];
    public $items = [];

    public function __construct() {
    }

    public function setGlobalItems() {
        $this->items = ZGroupItem::where('group_id', $this->id)->orderBy('id', 'asc')->get();
        foreach ($this->items as $item) $item->setGlobalCountItems();
    }
}
