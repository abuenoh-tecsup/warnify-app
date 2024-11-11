<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeoCodingController extends Controller
{
    public function searchAddress(Request $request)
    {
        $address = $request->input('address');
        $url = "https://nominatim.openstreetmap.org/search?format=json&q={$address}";

        // Realizar la solicitud a la API de Nominatim
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        return response()->json($data);
    }
}
