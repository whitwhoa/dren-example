<?php


namespace App\Controllers;



use App\Model\Entities\User;
use Dren\Response;
use Dren\App;


class HomeController
{

    /**
     * @return Response
     * @throws \Exception
     *
     */
    public function welcome() : Response
    {
        // Return html response
        $user = null;
        if(App::$sm->getUserId()){
            $user = new User();
            $user->find(App::$sm->getUserId());
        }
        return (new Response())->html(App::$vc->compile('welcome', [
            'user' => $user
        ]));
    }



}