<?php
namespace App\Traits;

use Config;
use Log;

trait LocationMatrix {
    private function getDistanceDifference($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371) {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo   = deg2rad($latitudeTo);
        $lonTo   = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    private function getLatLong($address) {
        $results = false;
        $entity  = 'geocode/json';
        try {
            $address         = str_replace(" ", "+", $address);
            $key             = Config::get('settings.API_KEY');
            $url             = Config::get('settings.GOOGLE_URL');
            $json            = file_get_contents("$url$entity?address=$address&sensor=false&key=$key");
            $json            = json_decode($json);
            $results['lat']  = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
            $results['long'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

        }
        catch (\Throwable $th) {
            Log::error("FAILED TO GEOCODE ".$th);
        }

        return $results;
    }

    private function getPolyLine($destination, $origin, $mode) {
        $result      = false;
        $entity      = 'directions/json';
        try {
            $destination = str_replace(" ", "+", $destination);
            $origin      = str_replace(" ", "+", $origin);
            $key         = Config::get('settings.API_KEY');
            $url         = Config::get('settings.GOOGLE_URL');
            $json        = file_get_contents("$url$entity?destination=$destination&mode=$mode&origin=$origin&key=$key");
            $json        = json_decode($json);
            $results     = $json->routes[0]->overview_polyline;
        }
        catch(\Throwable $th) {
            Log::error("FAILED TO GET DIRECTION POINTS ".$th);
        }

        return $results;
    }
}
