<?php
/**
 * Created by PhpStorm.
 * User: hamza
 * Date: 21-11-2018
 * Time: 15:42
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public $timestamps = false;

    public $table = 'restaurant';
}