<?php

namespace App\Http\Controllers;


use App\Customer;
use App\Driver;
use App\GeoLocation;
use App\Restaurant;
use App\Order;
use App\Service\WebsocketService;
use Illuminate\Http\Request;


class GpsController extends Controller
{

    //gets all locations
    public function index()
    {
         $geolocation = GeoLocation::all();

         return response()->json($geolocation);
    }


		/**
		 * @param Request $request
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
    //creates new location and send to websocket
    public function create(Request $request)
    {
        $order = Order::find($request->order_id);


        $driver = Driver::find($request->driver_id);




        $customer = Customer::find($order->customer_id);
        $restaurant = Restaurant::find($order->restaurant_id);

        $geolocation = new GeoLocation();

        $geolocation->driver_id = $request->driver_id;
        $geolocation->order_id = $request->order_id;
        $geolocation->latitude = $request->latitude;
        $geolocation->longtitude = $request->longtitude;
        $geolocation->date_added = date('Y-m-d G:I:s');

        $geolocation->save();

        // send data to the socket service.

        $websocket = new WebsocketService();

		    $websocket->sendData([
						'latitude' => $request->latitude,
						'longtitude' => $request->longtitude,
						'order_id' => $request->order_id,

						'driver_name' => $driver->name,
						'restaurant_name' => $restaurant->name,
						'restaurant_address' => $restaurant->address,
						'restaurant_zipcode' => $restaurant->zip_code,
						'delivery_address' => $customer->address,
                        'delivery_zipcode' => $customer->zip_code
				]);

        return response()->json(['message' => 'Resource created.'], 201);

    }

    //Find location by id
    public function show($id)
    {
        $geolocation = GeoLocation::find($id);

        return  response()->json($geolocation);
    }


    //Update location by id
    public function update(Request $request, $id)
    {
        $geolocation= GeoLocation::find($id);

        $geolocation->driver_id = $request->driver_id;
        $geolocation->order_id = $request->order_id;
        $geolocation->latitude = $request->input('latitude');
        $geolocation->longitude = $request->input('longitude');
        $geolocation->save();

        return response()->json($geolocation);
    }

    //Remove location by id
    public function destroy($id)
    {
        $geolocation = GeoLocation::find($id);
        $geolocation->delete();
        return response()->json('Geolocation removed successfully');
    }
}
