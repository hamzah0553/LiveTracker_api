<?php
/**
 * Created by PhpStorm.
 * User: hamza
 * Date: 21-11-2018
 * Time: 17:41
 */

namespace App\Http\Controllers;


use App\Driver;
use App\GeoLocation;
use App\Order;
use App\Restaurant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show($id)
    {
        $order = Order::find($id);
        $orderDrivers = GeoLocation::where('order_id', '=', $id)->get();
        $orderDrivers->sortBy('date_added');
        $orderDriver = $orderDrivers[sizeof($orderDrivers) - 1];
        $restaurant = Restaurant::find($order->restaurant_id);
        $driver = Driver::find($orderDriver->driver_id);

        $data[] = [
            "restaurant_name" => $restaurant->name,
            "restaurant_address" => $restaurant->address,
            "restaurant_city" => $restaurant->city,
            "restaurant_zipcode" => $restaurant->zip_code,
            "driver_name" => $driver->name,
            "latest_latitude" => $orderDriver->latitude,
            "latest_longtitude" => $orderDriver->longtitude
        ];

        if ($orderDrivers == null){
            return  response()->json("its empty");
        }
        return  response()->json($data);
    }

}