<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;

class Category extends Eloquent
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $connection ='mongodb';
    protected $collection ='category';

    protected $fillable = [
        'cat_id',
        'cat_name',
        'num_products',
        
    ];

    // public function drugs()
    // {
    //     return $this->hasMany('App\Models\Drug');
    // }

}