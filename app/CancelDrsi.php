<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class CancelDrsi extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'canceldrsi';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'dr_number',
        'si_number',
        'transaction_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m/d/Y H:i:s');
    }

    // public function transactions()
    // {
    //     return $this->hasMany(Transaction::class, 'asset_id');
    // }
}
