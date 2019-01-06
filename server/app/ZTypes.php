<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZTypes extends Model {
    public $timestamps = false;
    protected $table = 'z_types';
	protected $fillable = ['id', 'code', 'image', 'link', 'content', 'created_at'];
}
