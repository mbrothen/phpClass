<?php


class Car extends Vehicle
{
    public function __construct($vehicleType = "Car",  $engineState = false, $fuel = 100, $speed = 0, $fuelIncriment =
    5, $speedIncriment = 5)
    {
        parent::__construct($vehicleType, $engineState, $speed, $fuel, $fuelIncriment, $speedIncriment);
    }
}