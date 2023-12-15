<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip_address',
        'channel_name',
        'country_name',
        'country_code',
        'region_name',
        'region_code',
        'city_name',
        'zip_code',
        'currency_code',
        'latitude',
        'longitude',
    ];



/**
 * Get the user that owns the Visitor
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function chat()
{
    return $this->hasOne(Chat::class, 'visitor_id', 'id');
}

}

