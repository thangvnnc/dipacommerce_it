<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZTypes extends Model {
    protected $table = 'z_types';
	protected $fillable = ['id', 'image', 'link', 'content', 'created_at'];
}
