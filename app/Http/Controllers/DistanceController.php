<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location\Coordinate;
use Location\Distance\Vincenty;

class DistanceController extends Controller
{
    // Москва, Проспект Вернадского, 105
    const officeLat = 55.662882;
    const officeLon = 37.485601;

    private function getCoordinateFromLatLon(float $lat, float $lon): Coordinate
    {
        return new Coordinate($lat, $lon);
    }

    private function getOfficeCoordinate(): Coordinate
    {
        return $this->getCoordinateFromLatLon($this::officeLat, $this::officeLon);
    }

    private function getDistance(Coordinate $origin, Coordinate $detination): float
    {
        return $origin->getDistance($detination, new Vincenty());
    }

    private function getDistanceToOffice($lat, $lon): float
    {
        $destination = $this->getCoordinateFromLatLon($lat, $lon);
        $origin = $this->getOfficeCoordinate();

        return $this->getDistance($origin, $destination);
    }

    public function handleDestinationRequest(Request $request): float
    {
        $request->validate([
            'lat' => 'required|numeric|between:-90,90',
            'lon' => 'required|numeric|between:-90,90',
        ]);

        return $this->getDistanceToOffice($request->input('lat'), $request->input('lon'));
    }
}
