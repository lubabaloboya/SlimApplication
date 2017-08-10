<?php

namespace App\Controllers\Auth;

    //use App\Models\User;
    use App\Entities\User;
    use App\Controllers\Controller;
    use App\Services\AuthService;
    use Respect\Validation\Validator as v;

class AuthController extends Controller {

  public function getSignOut($request, $response) {
    $this->auth->logout();
    return $response->withRedirect($this->router->pathFor('home'));
  }

  public function getSignIn($request, $response) { 
    return $this->view->render($response, 'auth/signin.twig');
  }

  public function postSignIn($request, $response) {

    $validation = $this->validator->validate($request, [
      'email'     => v::noWhitespace()->notEmpty(),
      'password'  => v::noWhitespace()->notEmpty()
    ]);

    if ($validation->failed()) {
      return $response->withRedirect($this->router->pathFor('auth.signin'));
    }

    $auth = $this->auth->attempt(
      $request->getParam('email'),
      $request->getParam('password')
    );

    if(!$auth) {
      $this->flash->addMessage('error', 'Could not sign you in with those details.');
      return $response->withRedirect($this->router->pathFor('auth.signin'));
    }

    return $response->withRedirect($this->router->pathFor('home'));
  }

  public function getSignUp($request, $response) {
    return $this->view->render($response, 'auth/signup.twig');
  }

  public function postSignUp($request, $response) {

    $validation = $this->validator->validate($request, [
      'email'     => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
      'name'      => v::notEmpty()->alpha(),
      'password'  => v::noWhitespace()->notEmpty()
    ]);

    if ($validation->failed()) {
      return $response->withRedirect($this->router->pathFor('auth.signup'));
    }

    $this->AuthService->sign_up($request);

    $this->flash->addMessage('info', 'You have been signed up!');

    return $response->withRedirect($this->router->pathFor('home'));
  }

}
