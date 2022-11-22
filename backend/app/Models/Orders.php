<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Orders extends Eloquent
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $connection ='mongodb';
    protected $collection ='order';

    protected $fillable = [
        'code',
        'customer_id',
        'email',
        'customer_name',
        'address',
        'note',
        'number_phone',
        'items',
        'price',
        'status'
    ];

    // public function user()
    // {
    //     return $this->belongsTo('App\Models\Category', 'cat_id');
    // }

}
