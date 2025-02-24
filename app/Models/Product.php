<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     */
    protected $table = 'products';

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'product_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'product_name',
        'price',
        'composition',
    ];

    /**
     * Indicates if the model should be timestamped.
     * (Set this to `true` if you add `created_at` and `updated_at` columns.)
     */
    public $timestamps = false;
}