<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class LeadPot extends Model
{
        use SoftDeletes, HasFactory;

        public $table = 'lead_pots';

        protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        protected $fillable = [
            'lead_code',
            'lead_name',
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

