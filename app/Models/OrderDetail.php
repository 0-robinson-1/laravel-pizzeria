<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    
    // If table name is something other than the default 'order_details',
    // uncomment and set the correct table name:
    // protected $table = 'order_details';

    // Primary key is 'order_detail_id' instead of 'id'
    protected $primaryKey = 'order_detail_id';

    // Disable timestamps because 'created_at'/'updated_at' columns don't exist
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        // 'remarks', etc. if applicable
    ];

    // An order detail belongs to one order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    // An order detail usually references a product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}