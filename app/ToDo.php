<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
	protected $fillable = ['user_id', 'task'];
    public function user() {
    	return $this->belongsTo(User::class);
    }
}
