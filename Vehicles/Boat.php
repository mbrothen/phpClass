<?php


class Boat extends Vehicle
{
    public function __construct($vehicleType = "Boat",  $engineState = false, $fuel = 100, $speed = 0, $fuelIncriment =
    10, $speedIncriment = 2)
    {
        parent::__construct($vehicleType, $engineState, $speed, $fuel, $fuelIncriment, $speedIncriment);
    }
    /**
     * Display vehicle info
     */
    public function showInfo()
    {
        echo "<p>Vehicle Type: " . $this->getVehicleType() . "</p>";
        echo "<p>Engine State: " . $this->getEngineState() . "</p>";
        echo "<p>Fuel Level: " . $this->getFuel() . "</p>";
        echo "<p>Current Speed: " . $this->getSpeed() . "knots</p>";
    }
}