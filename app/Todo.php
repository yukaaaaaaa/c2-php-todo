<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    const STATUS_NOR_YET = 0;
    protected $fillable = ['title','due_date','status'];

    //
}
