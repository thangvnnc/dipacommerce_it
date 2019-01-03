<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZAccessoriItem extends Model {
    protected $table = 'z_accessori_item';
	protected $fillable = ['id', 'code', 'name', 'price', 'content', 'id_group_item', 'created_at'];
}
