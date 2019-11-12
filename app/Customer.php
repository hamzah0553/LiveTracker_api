<?php
/**
 * Created by PhpStorm.
 * User: hamza
 * Date: 21-11-2018
 * Time: 18:22
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;

    public $table = 'customer';

}