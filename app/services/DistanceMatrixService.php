<?php

class DistanceMatrixService
{
    public function calculateDistance($origin, $destination)
    {

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origin&destinations=$destination&mode=walking&key=" . $_ENV['DISTANCE_API_KEY'];
        $response = file_get_contents($url);
        $result = json_decode($response, true);

        $distance = $result['rows'][0]['elements'][0]['distance']['text'];
        $duration = $result['rows'][0]['elements'][0]['duration']['text'];
        $destination_addresses = $result['destination_addresses'][0];
        $origin_addresses = $result['origin_addresses'][0];
        $status = $result['status'];

        return array('destination' => $destination_addresses, 'origin' => $origin_addresses, 'distance' => $distance, 'duration' => $duration, 'status' => $status);
    }
}

// Curl Implementation

//class DistanceMatrixService
//{
//    public function calculateDistance($origin, $destination)
//    {
//
//        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origin&destinations=$destination&mode=walking&key=" . $_ENV['DISTANCE_API_KEY'];
//
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//
//        $response = curl_exec($ch);
//
//        if (curl_errno($ch)) {
//            echo 'Error:' . curl_error($ch);
//        } else {
//            $result = json_decode($response, true);
//
//            $distance = $result['rows'][0]['elements'][0]['distance']['text'];
//            $duration = $result['rows'][0]['elements'][0]['duration']['text'];
//            $destination_addresses = $result['destination_addresses'][0];
//            $origin_addresses = $result['origin_addresses'][0];
//            $status = $result['status'];
//
//            return array('destination' => $destination_addresses, 'origin' => $origin_addresses, 'distance' => $distance, 'duration' => $duration, 'status' => $status);
//        }
//
//        curl_close($ch);
//    }
//}
//
