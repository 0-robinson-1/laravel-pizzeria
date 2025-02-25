<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    // The primary key is 'order_id' instead of the default 'id'
    protected $primaryKey = 'order_id';

    // Tell Eloquent not to use created_at/updated_at columns
    public $timestamps = false;

    // Allow mass assignment on these columns
    protected $fillable = [
        'id',               // user foreign key
        'order_date',
        'total_price',
        'delivery_address',
        'delivery_postal_code',
        'delivery_city',
        // add more as needed
    ];

    /**
     * This order belongs to a user.
     * 'id' in 'orders' references 'users.id'
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    /**
     * This order has many order details.
     * 'order_id' in 'order_details' references this model’s 'order_id'
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }
}