<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
  protected $fillable = ['user_id', 'title', 'due_date', 'teacher', 'module', 'quick_notes', 'grade', 'complete'];
  public function user() {
    return $this->belongsTo(User::class);
  }
}
