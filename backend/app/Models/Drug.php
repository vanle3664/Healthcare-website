<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;

class Drug extends Eloquent
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $connection ='mongodb';
    protected $collection ='drugs';
    
    protected $fillable = [
        'product_id',
        'product_name',
        'description',
        'product_image',
        'cat_id',
        'productType_id',
        'price',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'cat_id');
    }
}
