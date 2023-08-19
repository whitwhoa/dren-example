<?php

namespace App\Jobs;

use Dren\Job;

class TestJob extends Job
{

    function __construct(?string $data = null)
    {
        parent::__construct($data);
    }

    public function preCondition(): bool
    {
        return true;
    }

    public function logic(): void
    {
        echo "I am being printed from the logic method of the TestJob class\n";
        echo "Here is the contents of my data property: " . var_export($this->data, true) . "\n";
    }
}