<?php


class Vehicle
{
    /*engineState, speed, fuel, vehicleType*/
    private $engineState;
    private $speed;
    private $fuel;
    private $vehicleType;

    private $fuelIncriment;
    private $speedIncriment;


    /**********************************************************/
    /**
     * Vehicle constructor.
     * @param $engineState
     * @param $speed
     * @param $fuel
     * @param $vehicleType
     * @param $fuelIncriment
     * @param $speedIncriment
     */
    public function __construct($vehicleType="unknown", $engineState=flase, $speed=0, $fuel=0, $fuelIncriment = 5,
                                $speedIncriment = 5)
    {
        $this->init($vehicleType, $engineState, $speed, $fuel, $fuelIncriment, $speedIncriment);

    }
    function init($vehicleType, $engineState, $speed, $fuel, $fuelIncriment, $speedIncriment){
        $this->engineState = $engineState;
        $this->speed = $speed;
        $this->fuel = $fuel;
        $this->vehicleType = $vehicleType;
        $this->fuelIncriment = $fuelIncriment;
        $this->speedIncriment = $speedIncriment;
    }


    /**
     * Starts the engine
     */
    public function startEngine()
    {
        if($this->getFuel() <=0){
            echo "Out of fuel.  Add fuel";
            return;
        }
        if($this->engineState){
            echo "Enging is already on";
            return;
        }
        $this->setEngineState(true);
        return "Engine on";
    }

    /**
     * Stops the engine
     */
    public function stopEngine()
    {
        if($this->getSpeed() > 0){
            echo "Unable to stop engine.  Vehicle Moving.";
            return;
        }

        if($this->getEngineState()){
            $this->setSpeed(0);
            $this->setEngineState(false);
            echo "Engine Off";
            return;
        }

    }

    /**
     * increase speed by speedIncrimint, decrease fuel by fuelIncriment
     */
    public function accelerate()
    {

        if(!$this->engineState){
            echo "Engine needs to be on";
            return;
        }
        //Add to speed, decrease fuel
        if($this->getFuel()>0)
        {
            $this->fuel -= $this->fuelIncriment;
            $this->speed += $this->speedIncriment;
            if($this->speed > 100){
                echo "I have a need.  A need for speed";
            }
            if($this->speed > 750){
                echo " SUPERSONIC!";
            }

            return;
            //$this->setSpeed($this->setSpeed() + $this->fuelIncriment);
        }
        //If out of gas
        if($this->getFuel() <= 0){
            $this->setFuel(0);
            $this->setSpeed(0);
            $this->setEngineState(false);
            echo "Out of gas";
        }
    }
    /**
     * Decrease speed by speedIncriment
     */
    public function brake()
    {
        if($this->speed <= 0){
            echo "Vehicle is  already stopped";
            return;
        }
        if($this->speed > 0){
            echo "in braking";
            $this->speed -= $this->speedIncriment;
            if ($this->speed < 0){
                $this->speed = 0;
            }
        }
    }

    /**
     * Display vehicle info
     */
    public function showInfo()
    {
        echo "<p>Vehicle Type: " . $this->getVehicleType() . "</p>";
        echo "<p>Engine STATE: " . $this->getEngineState() . "</p>";
        echo "<p>Fuel Level: " . $this->getFuel() . "%</p>";
        echo "<p>Current Speed: " . $this->getSpeed() . "mph</p>";
    }
    /****************************************************************/
    /**
     * @return mixed
     */
    public function getEngineState()
    {
        if ($this->engineState){
            return "On";
        }
        else
        {
            return "Off";
        }
        //return $this->engineState;
    }

    /**
     * @param mixed $engineState
     */
    public function setEngineState($engineState)
    {
        $this->engineState = $engineState;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     */
    public function setSpeed($speed)
    {
        // Minimum speed is 0
        if($speed < 0){
            $this->setSpeed = 0;
        } else {
            $this->speed = $speed;
        }
    }

    /**
     * @return mixed
     */
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * @param mixed $fuel
     */
    public function setFuel($fuel)
    {
        $this->fuel = $fuel;
    }

    /**
     * @return mixed
     */
    public function getVehicleType()
    {
        return $this->vehicleType;
    }

    /**
     * @param mixed $vehicleType
     */
    public function setVehicleType($vehicleType)
    {
        $this->vehicleType = $vehicleType;
    }
    /**
     * @return mixed
     */
    public function getFuelIncriment()
    {
        return $this->fuelIncriment;
    }

    /**
     * @param mixed $fuelIncriment
     */
    public function setFuelIncriment($fuelIncriment)
    {
        $this->fuelIncriment = $fuelIncriment;
    }

    /**
     * @return mixed
     */
    public function getSpeedIncriment()
    {
        return $this->speedIncriment;
    }

    /**
     * @param mixed $speedIncriment
     */
    public function setSpeedIncriment($speedIncriment)
    {
        $this->speedIncriment = $speedIncriment;
    }


}