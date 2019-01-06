<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZMenus extends Model {
    protected $table = 'z_menu';
	protected $fillable = ['id', 'name', 'type', 'status', 'group_id', 'created_at'];
}
