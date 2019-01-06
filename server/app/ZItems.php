<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZItems extends Model {
    public $timestamps = false;
    protected $table = 'z_items';
	protected $fillable = ['id', 'code', 'name', 'price', 'content', 'status', 'id_group_item', 'created_at'];

    public function group_item() {
        return $this->belongsTo('\App\ZGroupItems', 'id_group_item');
    }

    public function getStatusString() {
        switch ($this->status) {
            case 0:
                return "Add to Cart";
            case 1:
                return "Not available";
        }
    }
}
