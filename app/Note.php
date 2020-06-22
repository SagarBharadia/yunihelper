<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
  protected $fillable = ['user_id', 'title', 'body', 'module', 'description'];
  public function user() {
    return $this->belongsTo(User::class);
  }
}
