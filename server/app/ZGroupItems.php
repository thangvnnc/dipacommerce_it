<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZGroupItems extends Model {
    public $timestamps = false;
    protected $table = 'z_group_items';
	protected $fillable = ['id', 'id_group', 'code', 'content', 'created_at'];
	public $size = 0;

	public function setGlobalCountItems(){
        $this->size = ZItems::where('id_group_item', $this->id)->orderBy('id', 'asc')->get()->count();
    }

    public function group() {
        return $this->belongsTo('\App\ZGroups', 'id_group');
    }
}
