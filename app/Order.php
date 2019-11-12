<?php
/**
 * Created by PhpStorm.
 * User: hamza
 * Date: 21-11-2018
 * Time: 15:29
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    public $table = 'order';
}