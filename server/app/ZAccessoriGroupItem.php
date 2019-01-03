<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZAccessoriGroupItem extends Model {
    protected $table = 'z_accessori_group_item';
	protected $fillable = ['id', 'content', 'group_id', 'created_at'];
	public $size = 0;

	public function setGlobalCountItems(){
        $this->size = ZAccessoriItem::where('id_group_item', $this->id)->orderBy('id', 'asc')->get()->count();
    }
}
