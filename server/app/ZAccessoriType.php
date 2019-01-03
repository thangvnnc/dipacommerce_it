<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZAccessoriType extends Model {
    protected $table = 'z_accessori_type';
	protected $fillable = ['id', 'image', 'link', 'content', 'created_at'];
}
