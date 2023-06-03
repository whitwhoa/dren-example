<?php

namespace App\Middleware;


use Dren\App;
use Dren\Response;


class UserLoggedIn
{

    /**
     * Handle can either:
     *      > throw an exception which will be caught in Main
     *      > return a response (with redirect property)
     *
     * If no value returned, this middleware has passed
     *
     * @return mixed
     */
    public function handle()
    {
        // User is logged in so we need to return a redirect response
        if(!App::$sm->getUserId()){
            return (new Response())->redirect('/');
        }

    }

}