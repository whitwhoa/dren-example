<?php

namespace App\Jobs;

use Dren\Jobs\JobScheduler;

class Scheduler extends JobScheduler
{

    public function schedule(): void
    {
        //$this->addJob('* * * * *', 'TestJob', ['TestJob Data One', 'TestJob Data Two']);

//        $this->addAggregateJob('* * * * *', [
//            [
//                'TestJob',
//                ['TestJob Data One', 'TestJob Data Two']
//            ],
//            [
//                'TestJob2',
//                ['TestJob2 Data One', 'TestJob2 Data Two']
//            ]
//        ]);

    }
}