<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Production extends Model
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
        'remarks',
        'item',
        'orderform_no',
        'activity_mci',
        'activity_mbq',
        'discrepancy',
        'unit',
        'particular',
        'patient',
        'lot_no',
        'lead_pot',
        'max_doserate',
        'doserate_meter',
        'run_no',
        'procedure1',
        'volume',
        'created_by',
        'date_dispensed',
        'can',
        'dimension',
        'performed_by',
        'transport_index',
        'calibration_date',
        'calibration_time',
        'date_dispensed',
        'time_dispensed',
        'actual_dose',
        'actual_mbq',
        'actual_discrepancy',
        'kit_prep',
        'expiry_date',
        'expiry_time',
        'performed_by',
        'cancelled',
        'status',
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

    public function runNumber()
    {
        return $this->belongsTo(RunNumber::class, 'run_no');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }
}
