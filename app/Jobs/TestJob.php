<?php

namespace App\Jobs;

use Dren\Job;
use Dren\Jobs\SequentialJob;

class TestJob extends Job
{
    use SequentialJob;
    //use ConcurrentJob;

    public function preCondition(): bool
    {
        return true;
    }

    public function logic(): void
    {
        $this->successMessage = "I was successful";

        $stringVar = "I am being printed from the logic method of the TestJob class\n";
        $stringVar .= "Here is the contents of my data property: " . var_export($this->data, true) . "\n";

        //file_put_contents('/var/www/drencrom-test/test.log', $stringVar, FILE_APPEND);

        //Logger::write($stringVar);

        echo $stringVar;

        echo "Running TestJob\n";

//        $testJob2Data = (object)['d1' => 4000, 'd2' => "some string value x4"];
//        (new TestJob2($testJob2Data))->queue();

        //undefinedFunctionCall();

        //throw new \Exception("This is an exception thrown from the logic method of TestJob");

        //sleep(30);

    }
}