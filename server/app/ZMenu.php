<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZMenu extends Model {
    protected $table = 'z_menu';
	protected $fillable = ['id', 'name', 'type', 'status', 'group_id', 'created_at'];

	public function getItems(){

    }
}
