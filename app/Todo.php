<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    /**
     * Database table name for this model
     *
     * @var string Table Name
     */
    protected $table = 'todo';

    /**
     * Unguard fields to allow massassignment
     *
     * @var array
     */
    protected $fillable = ['title', 'date', 'info'];
}
