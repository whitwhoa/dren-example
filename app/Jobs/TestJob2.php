<?php

namespace App\Jobs;

use Dren\Job;
use Dren\Jobs\ExecutionTypes\ConcurrentJob;


class TestJob2 extends Job
{
    //use SequentialJob;
    use ConcurrentJob;

    public function preCondition(): bool
    {
        return true;
    }

    public function logic(): void
    {
        $this->successMessage = "I am a success message";

        //throw new \Exception("I am an exception being thrown from TestJob2");
        $stringVar = "I am being printed from the logic method of the TestJob2 class\n";
        $stringVar .= "Here is the contents of my data property: " . var_export($this->data, true) . "\n";

        //Logger::write($stringVar);

        echo "--------------------------------\n";
        echo $stringVar;

        sleep(10);

        //echo $stringVar;
    }
}