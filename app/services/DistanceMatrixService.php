<?php

class DistanceMatrixService
{
    public function calculateDistance($origin, $destination) {

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origin&destinations=$destination&key=".DISTANCE_MATRIX_API_KEY;
        $response = file_get_contents($url);
        $result = json_decode($response, true);

        $distance = $result['rows'][0]['elements'][0]['distance']['value'];
        $duration = $result['rows'][0]['elements'][0]['duration']['value'];

        return array('distance' => $distance, 'duration' => $duration);
    }
}