<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Book extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'author_id', 'status',
    ];





    protected $dates = ['deleted_at'];


    public function author()
    {
        return $this->belongsTo('App\Author')->withTrashed();
    }


    public function users()
    {
        return $this->belongsToMany('App\User', 'user_book')->withPivot('status','pay')->withTimestamps();
    }















}
