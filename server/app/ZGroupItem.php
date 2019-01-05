<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZGroupItem extends Model {
    protected $table = 'z_group_items';
	protected $fillable = ['id', 'content', 'group_id', 'created_at'];
	public $size = 0;

	public function setGlobalCountItems(){
        $this->size = ZItems::where('id_group_item', $this->id)->orderBy('id', 'asc')->get()->count();
    }
}
