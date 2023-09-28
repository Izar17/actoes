<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Hospital extends Model
{
    use HasFactory;
    public $table = 'hospitals';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'hospital',
        'doctor_name',
        'address',
        'license_no',
        'expiry',
        'rhso',
        'rep',
        'created_by',
        'date',
        'contact_no',
        'airline',
        'airline_etd',
        'airline_eta',
        'vessel',
        'vessel_etd',
        'vessel_eta',
        'stowage',
        'rigging',
        'placards',
        'vehicle',
        'vehicle_plate',
        'vehicle_etd',
        'vehicle_eta',
        'forwarder',
        'forwarder_plate',
        'forwarder_etd',
        'forwarder_eta',
        'delivery_charge',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('m/d/Y H:i:s');

    }

    public function hospitals()
    {
        return $this->hasMany(Hospital::class);
    }
}
