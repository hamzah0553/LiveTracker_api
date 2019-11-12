<?php
/**
 * Created by PhpStorm.
 * User: hamza
 * Date: 18-11-2018
 * Time: 15:23
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class GeoLocation extends Model
{
    public $table = 'order_driver_gps_coordinates';

    protected $fillable = [
        'latitude',
        'longtitude',
        'driver_id',
        'order_id',
        'date_added'
    ];
    public $timestamps = false;

}