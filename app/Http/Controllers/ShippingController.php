<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Helpers\RajaOngkir;

class ShippingController extends Controller
{
    public function dataProvinsi()
    {
        $provinsiRedis = json_decode(Redis::get('provinsi'));
        // dd($provinsiRedis);
        if($provinsiRedis == null)
        {
            $provinsi = RajaOngkir::getApi('https://api.rajaongkir.com/starter/province?key='.env('RAJA_ONGKIR'));
            if($provinsi != null)
            {
                //masukkan data json provinsi dalam redis
                // auto expired dalam 1 menit
                Redis::set('provinsi', json_encode($provinsi->results), 'EX', 60);
                return response()->json($provinsi->results);
            }
            else
            {
                return response()->json([
                    'message' => "limit reached"
                ], 405);
            }
        }
        else
        {
            return response()->json($provinsiRedis);
        }
    }

    public function dataKota(Request $request)
    {
        // ambil id sebagai id provinsi
        $provinsiId = $request->id;

        $kotaRedis = json_decode(Redis::get('kota'));
        if($kotaRedis == null)
        {
            $kota = RajaOngkir::getApi('https://api.rajaongkir.com/starter/city?key='.env('RAJA_ONGKIR').'&province='.$provinsiId);
            if($kota != null)
            {

                //masukkan data json kota dalam redis
                // auto expired dalam 1 menit
                Redis::set('kota', json_encode($kota->results), 'EX', 60);
                return response()->json($kota->results);
            }
            else
            {
                return response()->json([
                    'message' => "limit reached"
                ], 405);
            }
        }
        else
        {
            return response()->json($kotaRedis);
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
