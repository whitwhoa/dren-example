<?php


namespace App\Controllers;



use App\Model\Entities\User;
use Dren\Controller;
use Dren\Response;


class HomeController extends Controller
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
        if($this->sessionManager->getUserId())
        {
            $user = new User();
            $user->find($this->sessionManager->getUserId());
        }

        return (new Response())->html($this->viewCompiler->compile('welcome', [
            'user' => $user
        ]));
    }

    public function arrayElementForm() : Response
    {
        // Return html response
        $user = null;
        if($this->sessionManager->getUserId())
        {
            $user = new User();
            $user->find($this->sessionManager->getUserId());

        }

        return (new Response())->html($this->viewCompiler->compile('welcome', [
            'user' => $user
        ]));
    }


}