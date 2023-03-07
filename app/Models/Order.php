<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'shipping_phoneNumber',
        'shipping_city',
        'shipping_postalCode',
        'product_name',
        'quantity',
    ];
}
