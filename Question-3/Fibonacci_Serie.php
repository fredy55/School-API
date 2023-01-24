<?php 

//Derive a Fibonacci Series of numbers from 1-100

class FibonacciSeries {

    //Declare Variables
    private $firstNumber;
    private $secondNum;
    private $thirdNum;
    private int $maxCount;
    
    //Compute the series
    public function __construct(int $num1, int $maxCount){
        $this->firstNumber = $num1;
        $this->secondNum = $this->firstNumber + 1;
        $this->thirdNum = 0;
        $this->maxCount = $maxCount;

        echo "Fibonacci Series of numbers from {$num1} to {$maxCount}\n";
    }

    private function seriesFormat($num)
    {
        if($num === 0) return 0;
        if($num === 1) return 1;

        $this->thirdNum = $this->firstNumber + $this->secondNum;

        $this->firstNumber = $this->secondNum;
        $this->secondNum = $this->thirdNum;

        return $this->thirdNum;
    }

    public function generateSeries() {
        for ($i = $this->firstNumber; $i < $this->maxCount; $i++) {
            echo $this->seriesFormat($i)."\n";
        }
    }
}

//Create instance of the FibonacciSeries class
$mySeries = new FibonacciSeries(0, 100);
$mySeries->generateSeries();