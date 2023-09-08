<?php


namespace App\Http\Controllers;



use App\DAOs\UserDAO;
use Dren\App;
use Dren\Controller;
use Dren\Response;


class HomeController extends Controller
{
    private UserDAO $userDAO;

    public function __construct()
    {
        parent::__construct();

        $this->userDAO = new UserDAO();
    }

    public function welcome() : Response
    {
        // Return html response
        $user = null;
        if($this->sessionManager->isAuthenticated())
            $user = $this->userDAO->getUserById($this->sessionManager->getAccountId());

        return $this->response->html($this->viewCompiler->compile('welcome', [
            'user' => $user
        ]));
    }

    public function optionalFormElementExample() : Response
    {
        return $this->response->html($this->viewCompiler->compile('optional-form-element-example', [
            'user' => $this->userDAO->getUserById($this->sessionManager->getAccountId())
        ]));
    }

    public function optionalFormElementExampleSave() : Response
    {
        //dad($this->request);
        // do nothing, just return
        return $this->response->redirect($this->request->getReferrer());
    }

    public function arrayElementForm() : Response
    {
        return $this->response->html($this->viewCompiler->compile('form-array-element-example', [
            'user' => $this->userDAO->getUserById($this->sessionManager->getAccountId()),
            'userKeyVals' => $this->userDAO->getKeyValsWithNotes($this->sessionManager->getAccountId())
        ]));
    }

    public function arrayElementFormSave() : Response
    {
        $this->userDAO->setKeyValsWithNotes($this->sessionManager->getAccountId(), $this->request->getPostData()->keyValPair);
        return $this->response->redirect($this->request->getReferrer());
    }

    public function routeParameterExample() : Response
    {
        return $this->response->html($this->request->getRouteParam('id'));
    }

    public function httpClientExample() : Response
    {
        return $this->response
            ->setCode((int)App::get()->getHttpClient()->getHttpStatus())
            ->json(
            App::get()->getHttpClient()
                ->setUrl('https://dummyjson.com/products/1')
                ->send()
                ->getResponse()
        );
    }

    public function fileUploadExample() : Response
    {
        return $this->response->html($this->viewCompiler->compile('file-upload-example', [
            'user' => $this->userDAO->getUserById($this->sessionManager->getAccountId())
        ]));
    }

    public function fileUploadExampleSave() : Response
    {
        $images = $this->request->groupedFiles('images');

        if($this->request->hasFile('image1'))
            $images[] = $this->request->file('image1');

        if($this->request->hasFile('image2'))
            $images[] = $this->request->file('image2');

        foreach($images as $img)
            if(!$img->hasError()) // should be checking this in request validator not here, but this is simple example for time being
                $img->storeAs('/var/www/drencrom-test/storage/uploads', uuid_create_v4() . '.' . $img->getExt());


        return $this->response->redirect($this->request->getReferrer());
    }

    public function customHtmlElement() : Response
    {
        return $this->response->html($this->viewCompiler->compile('custom-html-element', []));
    }

    public function ajaxFormExample() : Response
    {
        return $this->response->html($this->viewCompiler->compile('ajax-form-example', [
            'user' => $this->userDAO->getUserById($this->sessionManager->getAccountId())
        ]));
    }

    public function ajaxFormExampleSave() : Response
    {
        return $this->response->json(["status" => "ok"]);
    }

}