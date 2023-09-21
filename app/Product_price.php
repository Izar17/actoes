<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Product_price extends Model
{
    use HasFactory;
    public $table = 'products_hospitals';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'Product_name',
        'asset_id',
        'qty',
        'unit',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m/d/Y H:i:s');

    }

    public function Products()
    {
        return $this->hasMany(Product::class);
    }
}
