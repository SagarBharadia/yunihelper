<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
	protected $fillable = ['user_id', 'name', 'amount', 'reason', 'direction'];
	public function user() {
    	return $this->belongsTo(User::class);
  	}
}
