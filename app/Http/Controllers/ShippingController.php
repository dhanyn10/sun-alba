<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RajaOngkir;

class ShippingController extends Controller
{
    public function dataProvinsi()
    {
        $provinsi = RajaOngkir::getApi('https://api.rajaongkir.com/starter/province?key='.env('RAJA_ONGKIR'));
        if($provinsi != null)
        {
            return response()->json($provinsi->results);
        }
        else
        {
            return response()->json([
                'message' => "limit reached"
            ], 405);
        }
    }

    public function dataKota(Request $request)
    {
        // ambil id sebagai id provinsi
        $provinsiId = $request->id;

        $kota = RajaOngkir::getApi('https://api.rajaongkir.com/starter/city?key='.env('RAJA_ONGKIR').'&province='.$provinsiId);
        if($kota != null)
        {
            return response()->json($kota->results);
        }
        else
        {
            return response()->json([
                'message' => "limit reached"
            ], 405);
        }
    }

    public function cost(Request $request)
    {
        $origin = $request->origin;             // id kota asal
        $destination = $request->destination;   // id kota tujuan
        $weight = $request->weight;             // berat

        $costResult = RajaOngkir::costRajaOngkir($origin, $destination, $weight);

        if($costResult != null)
        {
            return response()->json([
                'cost' => $costResult
            ], 200);
        }
        else {
            return response()->json([
                'message' => "request limit reached"
            ], 405);
        }
    }
}
