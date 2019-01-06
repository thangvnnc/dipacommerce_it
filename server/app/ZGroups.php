<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZGroups extends Model {
    public $timestamps = false;
    protected $table = 'z_groups';
	protected $fillable = ['id', 'id_type', 'image', 'content', 'created_at'];
    public $items = [];

    public function __construct() {
    }

    public function type() {
        return $this->belongsTo('\App\ZTypes', 'id_type');
    }

    public function setGlobalItems() {
        $this->items = ZGroupItems::where('id_group', $this->id)->orderBy('id', 'asc')->get();
        foreach ($this->items as $item) $item->setGlobalCountItems();
    }
}
