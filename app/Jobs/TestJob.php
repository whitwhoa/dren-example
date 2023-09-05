<?php

namespace App\Jobs;

use Dren\Job;
use Dren\Jobs\ExecutionTypes\SequentialJob;


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
        //undefinedFunctionCall();

//        $this->successMessage = "I was successful";
//
//        $stringVar = "I am being printed from the logic method of the TestJob class\n";
//        $stringVar .= "Here is the contents of my data property: " . var_export($this->data, true) . "\n";

        //file_put_contents('/var/www/drencrom-test/test.log', $stringVar, FILE_APPEND);

        //Logger::write($stringVar);

        //echo $stringVar;

        //echo "---------------------------------------NEW RUN\n";

        $testJob2Data = (object)['d1' => random_int(0, 9999), 'd2' => "some string value"];
        (new TestJob2($testJob2Data))->queue();

        //undefinedFunctionCall();

        //throw new \Exception("This is an exception thrown from the logic method of TestJob");

        //sleep(30);

//        $fullPath = '/var/www/drencrom-test/storage/system/queue/data.json';
//
//        $fp = @fopen($fullPath, 'r');
//
//        if(!$fp)
//        {
//            echo "could not open file\n";
//        }
//        else
//        {
//            if (!flock($fp, LOCK_EX|LOCK_NB))
//            {
//                echo "file is locked\n";
//            }
//            else
//            {
//                echo "file is NOT locked\n";
//            }
//
//            fclose($fp);
//        }








    }
}