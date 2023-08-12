<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Transaction extends Model
{
    use SoftDeletes, MultiTenantModelTrait;

    public $table = 'transactions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'hospital_id',
        'rx_no',
        'asset_id',
        'item',
        'lead_pot',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m/d/Y H:i:s');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');

    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');

    }

    public function asset_product()
    {
        return $this->belongsTo(Asset_product::class, 'item');
    }

    public function product_activity()
    {
        return $this->belongsTo(Product_activity::class, 'lead_pot');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }
}
