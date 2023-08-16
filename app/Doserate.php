<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Doserate extends Model
{
            use SoftDeletes, HasFactory;
    
            public $table = 'doserates';
    
            protected $dates = [
                'created_at',
                'updated_at',
                'deleted_at',
            ];
    
            protected $fillable = [
                'asset_id',
                'asset_product_id',
                'lower_limit',
                'upper_limit',
                'max_doserate',
                'doserate_m',
                'created_at',
                'updated_at',
                'deleted_at',
            ];
    
            protected function serializeDate(DateTimeInterface $date)
            {
                return $date->format('m/d/Y H:i:s');
            }
        }
    