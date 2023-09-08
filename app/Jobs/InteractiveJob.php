<?php

namespace App\Jobs;

use Dren\Job;
use Dren\Jobs\ExecutionTypes\SequentialJob;


class InteractiveJob extends Job
{
    use SequentialJob;
    //use ConcurrentJob;

    public function preCondition(): bool
    {
        return true;
    }

    public function logic(): void
    {
        while (true)
        {
            // Print a message to the user
            echo "Enter a number (or 'exit' to quit): ";

            // Read user input
            $input = trim(fgets(STDIN));

            // If the user typed "exit", break out of the loop
            if ($input === 'exit')
                break;

            // Process the input (in this example, we'll just square the number)
            $squared = $input * $input;
            echo "The square of $input is $squared\n";
        }

        echo "Goodbye!\n";
    }
}