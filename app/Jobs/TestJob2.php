<?php

namespace App\Jobs;

use Dren\Job;
use Dren\Logger;

class TestJob2 extends Job
{
    public function preCondition(): bool
    {
        return true;
    }

    public function logic(): void
    {
        //throw new \Exception("I am an exception being thrown from TestJob2");
        $stringVar = "I am being printed from the logic method of the TestJob2 class\n";
        $stringVar .= "Here is the contents of my data property: " . var_export($this->data, true) . "\n";
        
        Logger::write($stringVar);
    }
}