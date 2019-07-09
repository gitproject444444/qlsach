<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name', 'author_id', 'status',
    ];


    public function author()
    {
        return $this->belongsTo('App\Author');
    }


    public function users()
    {
        return $this->belongsToMany('App\User', 'user_book')->withPivot('status','pay')->withTimestamps();
    }













}
