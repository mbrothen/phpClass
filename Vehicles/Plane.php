<?php


class Plane extends Vehicle
{
    public function __construct($vehicleType = "Plane",  $engineState = false, $fuel = 100, $speed = 0, $fuelIncriment =
    5, $speedIncriment = 50)
    {
        parent::__construct($vehicleType, $engineState, $speed, $fuel, $fuelIncriment, $speedIncriment);
    }
}