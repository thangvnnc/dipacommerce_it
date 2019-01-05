<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZItems extends Model {
    protected $table = 'z_items';
	protected $fillable = ['id', 'code', 'name', 'price', 'content', 'id_group_item', 'created_at'];
}
