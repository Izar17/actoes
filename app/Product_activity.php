<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Product_activity extends Model
{
        use SoftDeletes, HasFactory;
    
        public $table = 'product_activity';
    
        protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    
        protected $fillable = [
            'activity_name',
            'product_id',
            'asset_id',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    
        protected function serializeDate(DateTimeInterface $date)
        {
            return $date->format('m/d/Y H:i:s');
        }
    }
    