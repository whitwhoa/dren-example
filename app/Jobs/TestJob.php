<?php

namespace App\Jobs;

use Dren\Job;
use Dren\Logger;

class TestJob extends Job
{
    public function preCondition(): bool
    {
        return true;
    }

    public function logic(): void
    {
        $stringVar = "I am being printed from the logic method of the TestJob class\n";
        $stringVar .= "Here is the contents of my data property: " . var_export($this->data, true) . "\n";

        //file_put_contents('/var/www/drencrom-test/test.log', $stringVar, FILE_APPEND);

        Logger::write($stringVar);

    }
}