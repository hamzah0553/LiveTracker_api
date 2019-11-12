<?php

namespace App\Http\Controllers;

class ExampleController extends Controller
{
    
    public function testMethod() {
        return response()->json(['message' => 'Works. The statuscode is also 200.'], 200);


    }


}
