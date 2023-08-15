<?php

namespace App\Middleware;


use Dren\Middleware;
use Dren\Response;


class UserLoggedIn extends Middleware
{

    /**
     * Handle can either:
     *      > throw an exception which will be caught in Main
     *      > return a response (with redirect property)
     *
     * If no value returned, this middleware has passed
     *
     */
    public function handle()
    {
        // User is logged in, so we need to return a redirect response
        if(!$this->sessionManager->isAuthenticated())
            return (new Response())->redirect('/');
    }

}